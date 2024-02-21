@extends('Theme/header')
@section('content')
    <h4 class="mb-3" id="line-variation">Web API (Services)</h4>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div>
                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#linktree" role="tab"
                            aria-controls="linktree" aria-selected="true">Links</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="linktree" role="tabpanel" aria-labelledby="home-line-tab">
                        <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group me-2" role="group" aria-label="First group">
                                <a href="https://github.com/Grynome/Web_API-Service-" target="_blank"
                                    rel="noopener noreferrer">
                                    <button type="button" class="btn btn-icon-text btn-github">
                                        <i class="btn-icon-prepend" data-feather="github"></i>
                                        Github
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-3">Collections</h4>
                                        <div class="cpy-crud-collection">
                                            <div
                                                class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                                                <div>
                                                    <h6>CRUD</h6>
                                                    <p>https://api.postman.com/collections/33078652-f53aff99-352e-4304-b48f-97847239c1ce?access_key=PMAT-01HQ4RR7E8MDBH3Z7M9DDRYFJZ
                                                    </p>
                                                </div>
                                                <div class="d-flex align-items-center flex-wrap text-nowrap">
                                                    <button type="button"
                                                        class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                                                        <i class="fa fa-clone"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cpy-final-collection">
                                            <div
                                                class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                                                <div>
                                                    <h6>Final Data Movie With Join</h6>
                                                    <p>https://api.postman.com/collections/33078652-d276e26d-82a3-4f03-bf01-7494d0f87686?access_key=PMAT-01HQ4TCX1DFNT6KW1HMBWDMT8S
                                                    </p>
                                                </div>
                                                <div class="d-flex align-items-center flex-wrap text-nowrap">
                                                    <button type="button"
                                                        class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                                                        <i class="fa fa-clone"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js-custom')
    <script>
        document.addEventListener("click", function(event) {
            if (event.target.closest('.cpy-crud-collection, .cpy-final-collection')) {
                let button = event.target.closest('button');
                if (button) {
                    copyToClipboard(button);
                }
            }
        });

        function copyToClipboard(button) {
            let copyText = button.closest('.cpy-crud-collection, .cpy-final-collection');
            let input = copyText.querySelector("p");
            let textArea = document.createElement("textarea");
            textArea.value = input.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy");
            document.body.removeChild(textArea);

            showSlidingAlert("Copied to clipboard");
        }

        function showSlidingAlert(message) {
            let alertContainer = document.createElement("div");
            alertContainer.className = "alert-container";
            alertContainer.innerHTML = message;
            document.body.appendChild(alertContainer);

            alertContainer.offsetHeight;

            alertContainer.classList.add("show");

            setTimeout(function() {
                hideSlidingAlert(alertContainer);
            }, 2500);
        }

        function hideSlidingAlert(alertContainer) {
            alertContainer.classList.remove("show");

            alertContainer.addEventListener("transitionend", function() {
                alertContainer.parentNode.removeChild(alertContainer);
            });
        }
    </script>
@endpush
