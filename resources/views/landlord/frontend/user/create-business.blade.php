@extends('landlord.frontend.frontend-page-master')

@section('title')
    {{ __('Create Business') }}
@endsection

@section('page-title')
    <span class="page-title">{{ __('Enter Your Phone') }}</span>
@endsection
@section('style')
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/registration.css') }}">
@endsection
@section('content')
    <div class="container">
        <form name='create_business_form' action="" method="post" enctype="multipart/form-data">
            <div class="mt-3">
                <div class="row">

                    <fieldset>
                        <div class="col-md-6 mx-auto">
                            <div class="otp-container"
                                style="background: url({{ url('assets/landlord/frontend/img/fluent-container.png') }}) lightgray 50% / cover no-repeat;">
                                <img class="img-fluid logo-img"
                                    src="{{ url('assets/landlord/frontend/img/multi_logo.png') }}" alt="">
                                <div style="position: absolute; top:38px; right: 59px">
                                    <img class="img-fluid" src="{{ url('assets/landlord/frontend/img/particles.png') }}"
                                        alt="">
                                </div>
                                <div class="country-select" style="width: 100%;">
                                    <h2>Select Payment Method</h2>
                                    <h5>Send, spend and save smarter</h5>
                                    <div class="d-flex justify-content-center">
                                        <div class="search-container">
                                            <div class="mt-4 payment_container">
                                             {!! render_payment_gateway_for_form() !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-container" style="width: 95%;">
                                        <div class="error text-danger"
                                            style="text-align:center; margin-top: 20px; display:none"></div>
                                        <button type="button" class="domain-search next" name="payment">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="col-md-6 mx-auto">
                            <div class="otp-container"
                                style="background: url({{ url('assets/landlord/frontend/img/fluent-container.png') }}) lightgray 50% / cover no-repeat;">
                                <img class="img-fluid logo-img"
                                    src="{{ url('assets/landlord/frontend/img/multi_logo.png') }}" alt="">
                                <div style="position: absolute; top:38px; right: 59px">
                                    <img class="img-fluid" src="{{ url('assets/landlord/frontend/img/particles.png') }}"
                                        alt="">
                                </div>
                                <div class="country-select" style="width: 100%;">
                                    <h2>Search Your Busness</h2>
                                    <h5>Send, spend and save smarter</h5>
                                    <div class="d-flex justify-content-center">
                                        <div class="search-container">
                                            <div class="w-100">
                                                <div style="width: 20px; height: 20px; position: relative">
                                                    <span style="font-weight: 300 !important;"><i class="far fa-envelope"
                                                            style="width: 16.67px; height: 13.33px; left: 1.67px; top: 3.33px; position: absolute;"></i></span>
                                                </div>
                                                <input type="text"
                                                    style="flex: 1 1 0; color: #667085; font-size: 16px; font-family: Inter; font-weight: 400; line-height: 24px; word-wrap: break-word; outline: none; border:none;"
                                                    name="domain" placeholder="Enter Your Domain Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-container" style="width: 95%;">
                                        <div class="error text-danger"
                                            style="text-align:center; margin-top: 20px; display:none"></div>
                                        <button class='gpt' data-bs-toggle="modal" data-bs-target="#gptModal">Search with
                                            GPT</button>
                                        <button type="button" class="domain-search next" name="search">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="col-md-11 mx-auto theme-list-conainter">
                            <div class="otp-container" style="background: url({{ url('assets/landlord/frontend/img/fluent-container.png') }}) lightgray 50% / cover no-repeat;">
                                <img class="img-fluid logo-img" src="{{ url('assets/landlord/frontend/img/multi_logo.png') }}" alt=""
                                    style="top: -20px;">
                                <div style="position: absolute; top:38px; right: 59px">
                                    <img class="img-fluid" src="{{ url('assets/landlord/frontend/img/particles.png') }}" alt="">
                                </div>
                                <div class="theme-container" style="width: 100%;">
                                    <h5 class="text-center">Chose you Theme</h5>
                                    <div class="theme_item_container"></div>
                                    <div class="btn-container" style="width: 95%;">
                                        <div class="error text-danger"
                                            style="text-align:center; margin-top: 20px; display:none"></div>
                                        <button type="button" class="theme-select next" name="theme">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="col-md-10 mx-auto ">
                            <div class="otp-container" style="background: url({{ url('assets/landlord/frontend/img/fluent-container.png') }}) lightgray 50% / cover no-repeat;">
                                <img class="img-fluid logo-img" src="{{ url('assets/landlord/frontend/img/multi_logo.png') }}" alt="">
                                <div style="position: absolute; top:38px; right: 59px">
                                    <img class="img-fluid" src="{{ url('assets/landlord/frontend/img/particles.png') }}" alt="">
                                </div>
                                <div class="domain-list-conainter">
                                </div>
                                <div class="btn-container" style="width: 95%;">
                                    <div class="error text-danger"
                                            style="text-align:center; margin-top: 20px; display:none"></div>
                                        <button type="submit" class="theme-select next" name="domain">Create</button>
                                    </div>
                            </div>
                        </div>
                    </fieldset>
                    
                    <fieldset>
                        <div class="col-md-6 mx-auto">
                            <div class="otp-container"
                                style="background: url({{ url('assets/landlord/frontend/img/fluent-container.png') }}) lightgray 50% / cover no-repeat;">
                                <img class="img-fluid logo-img"
                                    src="{{ url('assets/landlord/frontend/img/multi_logo.png') }}" alt="">
                                <div style="position: absolute; top:38px; right: 59px">
                                    <img class="img-fluid" src="{{ url('assets/landlord/frontend/img/particles.png') }}"
                                        alt="">
                                </div>
                                <div class="country-select">
                                    <h2>Choice Your Country</h2>
                                    <select name="country" id="country">
                                    </select>
                                    <div class="w-100 phone-input-container">
                                        <div>
                                            <div>
                                                <span class="country-code">
                                                    <span class="code">+00 </span>|
                                                </span>
                                            </div>
                                            <input type="tel" class="phone-input" name="phone" id="phone"
                                                placeholder="" style="outline:none; border:none">
                                        </div>
                                    </div>
                                    <div class="w-100 mt-3">
                                        <div id="recaptach-container"></div>
                                    </div>
                                    <div class="btn-container">
                                        <div class="error text-danger"
                                            style="text-align:center; margin-top: 20px; display:none"></div>
                                        <button type="button" name="phone" class="next action-button">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="col-md-6 mx-auto">
                            <div class="otp-container"
                                style="background: url({{ url('assets/landlord/frontend/img/fluent-container.png') }}) lightgray 50% / cover no-repeat;">
                                <img class="img-fluid logo-img"
                                    src="{{ url('assets/landlord/frontend/img/multi_logo.png') }}" alt="">
                                <div style="position: absolute; top:38px; right: 59px">
                                    <img class="img-fluid" src="{{ url('assets/landlord/frontend/img/particles.png') }}"
                                        alt="">
                                </div>
                                <div class="country-select">
                                    <h2>Verification Code</h2>
                                    <h5>Send, spend and save smarter</h5>
                                    <div
                                        class="w-100 d-flex justify-content-center align-items-center verification-code digit-group">
                                        <input type="text" id="digit-1" class="otp-digit" name="digit-1"
                                            data-next="digit-2">
                                        <input type="text" id="digit-2" class="otp-digit" name="digit-2"
                                            data-next="digit-3" data-previous="digit-1" />
                                        <input type="text" id="digit-3" class="otp-digit" name="digit-3"
                                            data-next="digit-4" data-previous="digit-2" />
                                        <input type="text" id="digit-4" class="otp-digit" name="digit-4"
                                            data-next="digit-5" data-previous="digit-3" />
                                        <input type="text" id="digit-5" class="otp-digit" name="digit-5"
                                            data-next="digit-6" data-previous="digit-4" />
                                        <input type="text" id="digit-6" class="otp-digit" name="digit-6"
                                            data-previous="digit-5" />
                                    </div>
                                    <div class="">
                                        <p style="text-align:right; margin-top: 20px;"><a href="#">Send Again</a>
                                        </p>
                                        <div class="error text-danger"
                                            style="text-align:center; margin-top: 20px; display:none"></div>
                                        <div class="d-block w-100 btn-container">
                                            <button class="w-100 d-block next action-button" type="button"
                                                name="varify_otp" name='otp'>Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>


    {{-- GPT Modal --}}

    <div class="modal fade" id="gptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gptModalTitle" style="padding:15px 20px;">Search Your Business</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="position:relative">
                    <div class="w-100" style="overflow:hidden">
                        <input type="text"
                            style="flex: 1 1 0; color: #667085; font-size: 16px; font-family: Inter; font-weight: 400; line-height: 24px; word-wrap: break-word; outline: none; border:none;margin: 10px 20px; width:100%"
                            name="search-text" placeholder="Search with gpt">
                        <div class="error text-danger" style="display:none"></div>
                        <div class="search-reasult" style="margin-left: 20px;">
                            <ul>
                                <li
                                    style="color:#1B434D  !important;background: #ddd; padding: 10px;display: flex;justify-content: space-between;">
                                    <span>lorem ipsum</span>
                                    <span style="color: #1B434D; cursor: pointer;" class="select-business">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary gpt-search"
                        style="background: #1B434D !important;border-color: #1B434D !important;">Search</button>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://kit.fontawesome.com/6e9c638913.js" crossorigin="anonymous"></script>
    <script src="{{ url('assets/common/jquery-3.6.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    {{-- Country phone number --}}
    <script>
        $(document).ready(function() {
            const url = "{{ url('assets/countries.json') }}"
            // 'https://gist.githubusercontent.com/devhammed/78cfbee0c36dfdaa4fce7e79c0d39208/raw/07df5ed443941c504c65e81c83e6313473409d4c/countries.json'
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let options = ''
                    options += `<option value="" selected disabled>Choice Your Country</option>`
                    data.forEach(element => {
                        options +=
                            `<option value="${element.name}" data-dial="${element.dial_code}" data-code="${element.code}">${element.flag} ${element.name}</option>`
                    });
                    $('#country').append(options)
                }
            })

            $("#country").change(function() {
                let dialCode = $(this).children("option:selected").data('dial');
                console.log(dialCode);

                $('.code').text(dialCode + " ");
            })
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.2/build/js/utils.js"></script>


    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-firestore-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-auth-compat.js"></script>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                // <x-btn.custom :id = "'register'" :title = "__('Please Wait..')" />
            });
        })(jQuery);
    </script>
    <script type="module">
        const firebaseConfig = {
            apiKey: "AIzaSyCGWkbvSK5Xgijq3kmR8MkXQZFxKAoyBA0",
            authDomain: "multipurc-41235.firebaseapp.com",
            databaseURL: "https://multipurc-41235-default-rtdb.firebaseio.com/",
            projectId: "multipurc-41235",
            storageBucket: "multipurc-41235.appspot.com",
            messagingSenderId: "427189561381",
            appId: "1:427189561381:web:975c6b1eb7fccd47e377cc",
        }
        firebase.initializeApp(firebaseConfig);
    </script>
    {{-- all functions --}}
    <script>
        window.onload = function() {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptach-container');
            recaptchaVerifier.render();
        }

        async function sendOtp(number, code) {
            if (!code) {
                return {
                    error: 'Please select country code'
                };
            }

            try {
                // Check if the code exists at the beginning of the number
                if (number && number.indexOf(`+${code}`) === 0) {
                    number = number;
                } else {
                    number = `+${code}${number}`;
                }

                const confirmationResult = await firebase.auth().signInWithPhoneNumber(number, window
                    .recaptchaVerifier);
                window.confirmationResult = confirmationResult;

                return confirmationResult;
            } catch (error) {
                return {
                    error: error.message || 'An error occurred during OTP verification.'
                };
            }
        }

        async function verifyOtp() {
            try {
                const result = await coderesult.confirm($('#verificationCode').val());
                return result;
            } catch (error) {
                return false;
            }
        }

        async function sendOtpBd(number) {
            const url = "{{ route('send.otp') }}";

            let response = await fetch(url, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    phone: number
                })
            })

            response = await response.json();
            return response;
        }

        async function verifyBdOtp(otp) {
            const url = "{{ route('verify.otp') }}";

            let response = await fetch(url, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    otp: otp
                })
            })

            response = await response.json();
            if (response.status) {
                return response;
            } else {
                return verifyOtp();
            }
        }
        async function fetchDomains(domain) {
            const url = "{{ route('check.domain.status') }}"
            let response = await fetch(url, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    domain: domain
                })
            })
            response = await response.json();
            if (response.status == "success") {
                $('.domain-list-conainter').html(response.data);
            }
            return response;
        }
    </script>


    <script>
        // var input = document.querySelector("#phone")

        // var iti = intlTelInput(input);



        // $("#phone").focusout(function(e, countryData) {
        //     let phone_number = $("#phone").val();
        //     phone_number = iti.getNumber(intlTelInputUtils.numberFormat);
        //     var selectedCountryData = iti.getSelectedCountryData().iso2;
        // });
    </script>

    {{-- controll fieldsets --}}
    <script>
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(async function() {
            let buttonName = $(this).attr("name")
            if (animating) return false;
            animating = true;

            current_fs = $(this).closest('fieldset');

            phone_number = $(current_fs).find('#phone').val()
            nextButton = current_fs.find('.next')

            code = $('#country option:selected').data('code');
            if (code) {
                nextButton.prop('disabled', true).text('Sending...');
            }
            dial_code = $('#country option:selected').data('dial');
            if (buttonName == "phone") {
                console.log('phone');
                if ($(current_fs).find('input[name="phone"]').val() == '') {
                    current_fs.find('.error').text('Please enter phone number').show();
                    current_fs.find('input[name="phone"]').focus();
                    current_fs = $(this).parent();
                    animating = false;
                    nextButton.removeAttr("disabled")
                    return;
                } else {
                    current_fs.find('.error').text('').hide();
                    if (code != 'BD') {
                        result = await sendOtp(phone_number, selectedCountryData.dialCode);
                        if (result && result.verificationId) {
                            nextButton.reset();
                            // next_fs = $(current_fs).next();
                            // next_fs.show();
                        } else {
                            if (result && result.message) {
                                current_fs.find('.error').text(result.error).show();
                            } else {
                                current_fs.find('.error').text('Select Contry and enter Valid Number').show();
                            }
                            current_fs.find('input[name="phone"]').focus();
                            current_fs = $(current_fs);
                            animating = false;
                            return;
                        }
                    } else {
                        result = await sendOtpBd(phone_number)
                        if (result && result.message_id) {
                            console.log(result.message_id)
                            $('.page-title').text("Verify Your Phone Number")
                            next_fs = $(current_fs).next();
                            next_fs.show();
                        } else {
                            if (result && result.message) {
                                current_fs.find('.error').text(result.message).show();
                            } else {
                                current_fs.find('.error').text('Select Contry and enter Valid Number').show();
                            }
                            current_fs.find('input[name="phone"]').focus();
                            current_fs = $(current_fs);
                            animating = false;
                            return;
                        }
                        nextButton.removeAttr("disabled")
                    }

                }
            }


            otp = $(current_fs).find('.otp-digit')
            const verify_otp = $(this).attr('name','varify_otp')
            if (buttonName == 'otp') {
                console.log('otp');
                nextButton.text("Verify");
                var otpValues = $('.otp-digit').map(function() {
                    return $(this).val();
                }).get();
                const otpVal = otpValues.join('');
                if (otpVal) {
                    nextButton.prop('disabled', true).text('Verifing...');
                    result = await verifyBdOtp(otp);
                    if (!result) {
                        current_fs.find('.error').text('Invalid OTP').show();
                        nextButton.removeAttr("disabled");
                        nextButton.text("Verify");
                        current_fs.find('input[name="otp"]').focus();
                        current_fs = $(this).closest('fieldset');
                        animating = false;
                        return;
                    } else {
                        if (!result.status) {
                            nextButton.removeAttr("disabled");
                            nextButton.text("Verify");
                            current_fs.find('.error').text(result.message).show();
                            current_fs.find('input[name="otp"]').focus();
                            current_fs = $(this).closest('fieldset');
                            animating = false;
                            return;
                        }
                    }
                } else {
                    current_fs.hide();
                    current_fs = $(this).closest('fieldset');
                    animating = false;
                    return;
                }
            }



            if (buttonName == 'search') {
                let domainValue = $(current_fs).find('[name="domain"]')
                if (domainValue.val()) {
                    // nextButton.prop('disabled', true).text('Searching...');
                    console.log(domainValue.val())
                    const res = await fetchDomains(domainValue.val())
                    if(!res.status){
                        current_fs.find('.error').text('Please enter your Business idea').show();
                        current_fs.find('input[name="domain"]').focus();
                        current_fs = $(this).closest('fieldset');
                        animating = false;
                        return;
                    }
                } else {
                    current_fs.find('.error').text('Please enter your Business idea').show();
                    current_fs.find('input[name="domain"]').focus();
                    current_fs = $(this).closest('fieldset');
                    animating = false;
                    return;
                }
            }
            if(buttonName == 'theme'){
                let themeSlug = $(current_fs).find('[name="theme_slug"]').val()
                let themeCode = $(current_fs).find('[name="theme_code"]').val()

                if(!themeSlug && !themeCode){
                    current_fs.find('.error').text('Please Select a theme').show();
                    current_fs = $(this).closest('fieldset');
                    animating = false;
                    return;
                }
            }
            // current_fs = $(this).closest('fieldset');
            // animating = false;
            // return;
            next_fs = $(this).closest('fieldset').next();

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {
                    scale = 1 - (1 - now) * 0.2;
                    left = (now * 50) + "%";
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'position': 'absolute'
                    });
                    next_fs.css({
                        'left': left,
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },
                easing: 'easeInOutBack'
            });
        });

        $(".previous").click(function() {
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();

            previous_fs = $(this).parent().prev();
            $(previous_fs).removeAttr("style");
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1 - now) * 50) + "%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'left': left
                    });
                    previous_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });
    </script>
    <script>
        $('.digit-group').find('input').each(function() {
            $(this).attr('maxlength', 1);
            $(this).on('keyup', function(e) {
                var parent = $($(this).parent());

                if (e.keyCode === 8 || e.keyCode === 37) {
                    var prev = parent.find('input#' + $(this).data('previous'));

                    if (prev.length) {
                        $(prev).select();
                    }
                } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (
                        e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                    var next = parent.find('input#' + $(this).data('next'));

                    if (next.length) {
                        $(next).select();
                    } else {
                        if (parent.data('autosubmit')) {
                            parent.submit();
                        }
                    }
                }
            });
        });
    </script>
    <script>
        // ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.gpt-search').click(function() {
            const parent = $(this).closest('.modal-content')
            const domainSuggest = parent.find('[name="search-text"]').val()
            if (domainSuggest == '') {
                $('.modal-body .error').text('Please enter your Business idea').show();
                return;
            }
            $.ajax({
                url: '{{ route('get.business.name') }}',
                method: "post",
                data: {
                    prompt: domainSuggest
                },
                success: function(data) {
                    $('.search-reasult ul').html(data);
                }
            });
        })
        $(document).ready(function(){
            const url = "{{route('get.all.themes')}}";
            $.ajax({
                url,
                method: "post",
                success: function(data) {
                    $('.theme_item_container').html(data)
                }
            });
        })
    </script>
@endsection
