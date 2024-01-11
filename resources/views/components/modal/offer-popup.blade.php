<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ url('assets/common/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/common/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ url('assets/common/css/popup.css') }}">


<div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="popupModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close d-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="ion-ios-close"></span>
                </button>
            </div>
            <div class="row no-gutters">
                <div class="col-md-5 d-flex">
                    <div class="modal-body p-5 color-1 d-flex">
                        <span class="icon-2 flaticon-snowflake"></span>
                        <div class="w-100 text text-center">
                            <span class="subheading">Winter</span>
                            <h3 class="sale">Sale
                                <span class="icon flaticon-snowflake"></span>
                            </h3>
                            <h2><span>40</span><sup>%</sup><sub>off</sub></h2>
                            <p class="upper">To all colorlib products</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 d-flex">
                    <div class="modal-body p-5 img d-flex align-items-center"
                        style="background-image: url({{ url('assets/img/pop-up-bg.jpg') }}); background-position:center center">
                        <div class="text w-100">
                            <a href="#" class="btn btn-primary d-block py-3"
                                style="background-color:#39bdc8; border-color:#39bdc8">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
