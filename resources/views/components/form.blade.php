<div>
    <form id="formMessag" method="POST" action="/set_message">
        @method('POST')
        <input type="hidden" id="tockenMessag" name="_token" value="{{ csrf_token() }}" />
        <div class="mb-3">
            <label for="titleForm" class="form-label">Тitle</label>
            <input type="text" name="title" class="form-control" id="titleForm" placeholder="title">
        </div>
        <div class="mb-3">
            <label for="textForm" class="form-label">Text</label>
            <textarea class="form-control" name="text" id="textForm" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-submit">Submit</button>
    </form>
</div>
@section('script')
<script>
    var $ready = (callback) => {
        if (document.readyState != "loading") callback();
        else document.addEventListener("DOMContentLoaded", callback);
    }
    $ready(() => {
        const $formMessag = document.querySelector("#formMessag");
        const $titleForm = document.querySelector("#titleForm");
        const $textForm = document.querySelector("#textForm");
        const $tockenMessag = document.querySelector("#tockenMessag");
        const $valueMeta = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const contentToggle = async function f() {
            const $data = { title: $titleForm.value, text: $textForm.value, tocken: $tockenMessag.value };
            try {
                const response = await fetch(`/set_message`, {
                    method: 'POST',
                    body: JSON.stringify($data),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $valueMeta
                    }
                });
                const $json = await response.json();
                return $json;
            } catch (error) {
                console.log('Ошибка:', error);
            }

        }
    $formMessag.addEventListener('click', (event) => {
        event.preventDefault();
        const $elem = event.target;
        if ($elem.classList.contains("btn-submit")) {
            contentToggle();
        }
    })
})
</script>
@endsection
