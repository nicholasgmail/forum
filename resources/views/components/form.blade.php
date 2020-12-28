<div>
    <form id="formMessag" method="POST" action="/set_message">
        @method('POST')
        <input type="hidden" id="tockenMessag" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" id="userMessag" name="_id_user" value="{{ auth()->user()->id  }}" />
        <input type="hidden" id="userTheme" name="_id_theme" value="{{ $themeId }}" />
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
        const $toastMain = document.querySelector("main");
        const $formMessag = document.querySelector("#formMessag");
        const $userMessag = document.querySelector("#userMessag");
        const $titleForm = document.querySelector("#titleForm");
        const $textForm = document.querySelector("#textForm");
        const $userTheme = document.querySelector("#userTheme");
        const $tockenMessag = document.querySelector("#tockenMessag");
        const $valueMeta = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


        const contentToggle = async function f() {
            const $data = {title: $titleForm.value, text: $textForm.value, user: $userMessag.value, theme: $userTheme.value };
            try {
                const response = await fetch(`/set_message`, {
            method: 'POST',
                    body: JSON.stringify($data),
                    headers: {
            'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $valueMeta
                    }
                });
                if(response.status='200'){
                const $messageToast = ` <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" style="
                                            z-index: 2000;
                                            position: fixed;
                                            top: 1%;
                                            left: 1%;
                                        ">
                                                    <div class="toast-header">
                                                        <strong class="me-auto">Messag</strong>
                                                        <small class="text-muted">just now</small>
                                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                                    </div>
                                                    <div class="toast-body">
                                                        Adding messages.
                                            </div>
                                                </div> `
                $toastMain.insertAdjacentHTML('afterbegin', $messageToast);
                toastClose();
                $titleForm.value = '';
                $textForm.value = '';
                }
                return response.status;
            } catch (error) {
            console.log('Ошибка:', error);
            }

        }
         const toastClose = function f(){
             const $closeToast = document.querySelector(".toast");
            $closeToast.addEventListener("click", event=>{
                $elem = event.target;
                if($elem.classList.contains("btn-close")){
                        $closeToast.remove();
                }
            })
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
