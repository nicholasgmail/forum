<div>
    <form id="formMessag" method="POST" action="/set_message">
        @method('POST')
        <input type="hidden" id="tockenMessag" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" id="userMessag" name="_id_user" value="{{ auth()->user()->id  }}" />
        <input type="hidden" id="userNameMessag" name="_name_user" value="{{ auth()->user()->name  }}" />
        <input type="hidden" id="userTheme" name="_id_theme" value="{{ $themeId }}" />
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
        const $userNameMessag = document.querySelector("#userNameMessag");
        const $textForm = document.querySelector("#textForm");
        const $userTheme = document.querySelector("#userTheme");
        const $tockenMessag = document.querySelector("#tockenMessag");
        const $valueMeta = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


        const contentToggle = async function f() {
            const $data = {text: $textForm.value, user: $userMessag.value, theme: $userTheme.value, masseg: 0 };
            try {
                const response = await fetch(`/set_message`, {
            method: 'POST',
                    body: JSON.stringify($data),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $valueMeta
                    }
                });
                const $result = await response.json();
                if(response.status='200' && $result.success){
                    var $now = new Date();
                    $now = $now.toLocaleDateString('fr-CA') + ' ' + $now.toLocaleTimeString();
                    addMessag($userNameMessag.value, $textForm.value, $now );
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
                                                       ${$result.success}
                                            </div>
                                                </div> `
                $toastMain.insertAdjacentHTML('afterbegin', $messageToast);
                }else{
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
                                                       ${$result.errors.text['0']}
                                            </div>
                                                </div> `
                $toastMain.insertAdjacentHTML('afterbegin', $messageToast);
                }
                 toastClose();
                $textForm.value = '';
                return response.status;
            } catch (error) {
            console.log('Ошибка:', error);
            }

        }
         const toastClose = function f(){
             const $closeToast = document.querySelector(".toast");
             setTimeout(function(){
                $closeToast.remove();
             },5000)
            $closeToast.addEventListener("click", event=>{
                $elem = event.target;
                if($elem.classList.contains("btn-close")){
                        $closeToast.remove();
                }
            })
        }

        const addMessag = function f($user, $text, $date){
            const $addMessage = document.querySelector('#message')
            let $add = `<div class="card mb-3">
                <div class="card-header">
                   ${$user}
                </div>
                <div class="card-body">
                    <p class="card-text"> ${$text}</p>
                </div>
                <div class="card-footer text-muted">
                   ${$date}
                </div>
            </div>`
            $addMessage.insertAdjacentHTML('afterbegin', $add);
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
