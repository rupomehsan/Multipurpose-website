@extends('landlord.frontend.frontend-page-master')

@section('title')
    {{ __('Register') }}
@endsection

@section('page-title')
    {{ __('Register') }}
@endsection

@section('style')
    {{--
    <style>
        .nice-select {
            position: relative;
            z-index: 8;
            margin-bottom: 20px;
        }

        .nice-select:focus {
            outline: none;
            box-shadow: unset;
        }

        .loginArea .login-Wrapper .input-form .phone {
            padding-left: 15px;
        }
    </style>
     --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('assets/registration.css')}}">
@endsection

@section('content')
    @php
        $current_lang = \App\Facades\GlobalLanguage::user_lang_slug();
        $countries = \Modules\CountryManage\Entities\Country::select('id', 'name')->get();
        // $title = get_static_option('landlord_user_register_' . $current_lang . '_title');

        // if (str_contains($title, '{h}') && str_contains($title, '{/h}')) {
        //     $text = explode('{h}', $title);
        //     $highlighted_word = explode('{/h}', $text[1])[0];
        //     $highlighted_text = '<span class="color">' . $highlighted_word . '</span>';
        //     $final_title = '<h2 class="tittle wow fadeInUp" data-wow-delay="0.0s">' . str_replace('{h}' . $highlighted_word . '{/h}', $highlighted_text, $title) . '</h2>';
        // } else {
        //     $final_title = '<h2 class="tittle wow fadeInUp" data-wow-delay="0.0s">' . $title . '</h2>';
        // }

        $feature_show_hide_con = empty(get_static_option('landlord_frontend_register_feature_show_hide')) ? 'section-padding' : '';
    @endphp

    @if (!empty(get_static_option('landlord_frontend_register_feature_show_hide')))
        <section class="categoriesArea section-bg section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="singleCat text-center mb-24">
                            <div class="cat-icon">
                                {!! render_image_markup_by_attachment_id(get_static_option('landlord_user_register_feature_image_one')) !!}
                            </div>
                            <div class="cat-cap">
                                <h5><a href="#"
                                        class="tittle">{{ get_static_option('landlord_user_register_feature_' . $current_lang . '_title_one') }}</a>
                                </h5>
                                <p class="pera">
                                    {{ get_static_option('landlord_user_register_feature_' . $current_lang . '_description_one') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="singleCat text-center mb-24">
                            <div class="cat-icon">
                                {!! render_image_markup_by_attachment_id(get_static_option('landlord_user_register_feature_image_two')) !!}
                            </div>
                            <div class="cat-cap">
                                <h5><a href="#"
                                        class="tittle">{{ get_static_option('landlord_user_register_feature_' . $current_lang . '_title_two') }}</a>
                                </h5>
                                <p class="pera">
                                    {{ get_static_option('landlord_user_register_feature_' . $current_lang . '_description_two') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="singleCat text-center mb-24">
                            <div class="cat-icon">
                                {!! render_image_markup_by_attachment_id(get_static_option('landlord_user_register_feature_image_three')) !!}
                            </div>
                            <div class="cat-cap">
                                <h5><a href="#"
                                        class="tittle">{{ get_static_option('landlord_user_register_feature_' . $current_lang . '_title_three') }}</a>
                                </h5>
                                <p class="pera">
                                    {{ get_static_option('landlord_user_register_feature_' . $current_lang . '_description_three') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <div class="loginArea bottom-padding {{ $feature_show_hide_con }} register_page">
        <div class="container-fluid">
            <form action="{{ route('landlord.user.register.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-xxl-6 col-xl-7 col-lg-9">
                            <div class="row">
                                <x-error-msg />
                                <x-flash-msg />
                                {{--
                                <form action="{{ route('landlord.user.register.store') }}" method="post"
                                    enctype="multipart/form-data" class="contact-page-form style-01">
                                    @csrf

                                    <div class="col-lg-12 col-md-12">
                                        <div class="input-form input-form2">
                                            <input type="text" name="name" placeholder="{{ __('Name') }}"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="input-form input-form2">
                                            <input type="text" name="username" placeholder="{{ __('Username') }}"
                                                value="{{ old('username') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-form input-form2">
                                            <input type="text" name="email" placeholder="{{ __('Email') }}"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <!-- country Number Selector -->

                                    <div class="col-lg-12">
                                        <div class="input-form">
                                            <input name="mobile" type="number" placeholder="{{ __('Phone') }}" class="phone"
                                                value="{{ old('mobile') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-form input-form2">
                                            <input type="text" name="address" placeholder="{{ __('Address') }}"
                                                value="{{ old('address') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <select name="country" class="form-control register_countries niceSelect_active">
                                            <option disabled="" selected>{{ __('Select a country') }}</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-form input-form2">
                                            <input type="password" name="password" placeholder="{{ __('password') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-form input-form2">
                                            <input type="password" name="password_confirmation"
                                                placeholder="{{ __('Confirm Password') }}">
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="btn-wrapper text-center mt-20">
                                            <button type="submit" class="cmn-btn1 w-100 mb-40">{{ __('Register') }}</button>

                                            <p class="sinUp mb-20"><span>{{ __('Already have an account') }}?</span>
                                                <a href="{{ route('landlord.user.login') }}"
                                                    class="singApp">{{ __('Login') }}</a>
                                            </p>

                                            @if (!empty(get_static_option('landlord_frontend_login_google_show_hide')))
                                                <a href="{{ route('landlord.login.google.redirect') }}"
                                                    class="cmn-btn-outline0  mb-20 w-100">
                                                    <img src="{{ asset('assets/landlord/frontend/img/icon/googleIocn.svg') }}"
                                                        alt="image" class="icon">{{ __('Register With Google') }}</a>
                                            @endif

                                            @if (!empty(get_static_option('landlord_frontend_login_facebook_show_hide')))
                                                <a href="{{ route('landlord.login.facebook.redirect') }}"
                                                    class="cmn-btn-outline0 mb-20 w-100">
                                                    <img src="{{ asset('assets/landlord/frontend/img/icon/fbIcon.svg') }}"
                                                        alt="image" class="icon">{{ __('Register With Facebook') }}</a>
                                            @endif

                                        </div>
                                    </div>
                                </form>
                                --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="register-img" style=" background: url({{ url('assets/landlord/frontend/img/fluent-container.png') }}) lightgray 50% / cover no-repeat;">
                                <img class="img-fluid register-logo-img" src="{{ url('assets/landlord/frontend/img/multi_logo.png') }}" alt="logo">
                                <div class="particles-img">
                                    <img class="img-fluid" src="{{ url('assets/landlord/frontend/img/particles.png') }}" alt="">
                                </div>
                                <div class="person-img">
                                    <img class="img-fluid"
                                        src="{{ url('assets/landlord/frontend/img/person.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <h2> Get Better with Money</h2>
                                    <p>
                                        Overpay help you set saving goals, earn cash back offers. Go to disclaimer for more details
                                        and get
                                        paychecks up to two
                                        days early. Get a $20 bonus when you receive qualifying direct deposits
                                    </p>
                                </div>
                                <div class="slides">
                                    <div>
                                        <div
                                            style="width: 44px; height: 8px; left: 30px; top: 0px; position: absolute; background: white; border-radius: 4px">
                                        </div>
                                        <div
                                            style="width: 8px; height: 8px; left: 96px; top: 0px; position: absolute; background: rgba(244, 235, 255, 0.50); border-radius: 9999px">
                                        </div>
                                        <div
                                            style="width: 8px; height: 8px; left: 0px; top: 0px; position: absolute; background: rgba(244, 235, 255, 0.50); border-radius: 9999px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-12">
                                        <h2
                                            style="text-align: center; color: #101828; font-size: 36px; font-family: Inter; font-weight: 700;">
                                            Sign up for an account</h2>
                                        <p
                                            style="margin-top: 12px;text-align: center; color: #667085; font-size: 18px; font-family: Inter; font-weight: 400;">
                                            Send, spend and save smarter</p>
                                    </div>
                                    <div class="col-12" style="margin-top: 40px;">
                                        <div class="row"
                                            style=" box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); overflow: hidden;  justify-content: center; align-items: center; gap: 8px; display: flex">
                                            <div class="col-5">
                                                <div>
                                                    <button type="button"
                                                        style="outline:none;width: 256px; height: 52px; padding-left: 20px; padding-right: 20px; padding-top: 12px; padding-bottom: 12px; background: #F9FAFB; box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); border-radius: 8px; overflow: hidden; border: 1px #D0D5DD solid; justify-content: center; align-items: center; gap: 8px; display: inline-flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28"
                                                            height="28" viewBox="0 0 48 48">
                                                            <path fill="#FFC107"
                                                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                                                            </path>
                                                            <path fill="#FF3D00"
                                                                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                                                            </path>
                                                            <path fill="#4CAF50"
                                                                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                                                            </path>
                                                            <path fill="#1976D2"
                                                                d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                                                            </path>
                                                        </svg>
                                                        <div
                                                            style="color: #1D2939; font-size: 16px; font-family: Inter; font-weight: 600; line-height: 24px; word-wrap: break-word">
                                                            Sign Up with Google</div>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <button type="button"
                                                        style="outline:none; width: 256px; height: 52px; padding-left: 20px; padding-right: 20px; padding-top: 12px; padding-bottom: 12px; background: #F9FAFB; box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); border-radius: 8px; overflow: hidden; border: 1px #D0D5DD solid; justify-content: center; align-items: center; gap: 8px; display: inline-flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28"
                                                            height="28" viewBox="0 0 50 50">
                                                            <path
                                                                d="M 44.527344 34.75 C 43.449219 37.144531 42.929688 38.214844 41.542969 40.328125 C 39.601563 43.28125 36.863281 46.96875 33.480469 46.992188 C 30.46875 47.019531 29.691406 45.027344 25.601563 45.0625 C 21.515625 45.082031 20.664063 47.03125 17.648438 47 C 14.261719 46.96875 11.671875 43.648438 9.730469 40.699219 C 4.300781 32.429688 3.726563 22.734375 7.082031 17.578125 C 9.457031 13.921875 13.210938 11.773438 16.738281 11.773438 C 20.332031 11.773438 22.589844 13.746094 25.558594 13.746094 C 28.441406 13.746094 30.195313 11.769531 34.351563 11.769531 C 37.492188 11.769531 40.8125 13.480469 43.1875 16.433594 C 35.421875 20.691406 36.683594 31.78125 44.527344 34.75 Z M 31.195313 8.46875 C 32.707031 6.527344 33.855469 3.789063 33.4375 1 C 30.972656 1.167969 28.089844 2.742188 26.40625 4.78125 C 24.878906 6.640625 23.613281 9.398438 24.105469 12.066406 C 26.796875 12.152344 29.582031 10.546875 31.195313 8.46875 Z">
                                                            </path>
                                                        </svg>
                                                        <div
                                                            style="color: #1D2939; font-size: 16px; font-family: Inter; font-weight: 600; line-height: 24px; word-wrap: break-word">
                                                            Sign Up with Apple</div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" style="margin-top: 20px;">
                                        <div style=" display: flex; justify-content: center; align-items: center;">
                                            <div style="width: 192px; height: 0px; left: 0px; top: 12px; border: 1px #D9D9D9 solid">
                                            </div>
                                            <div
                                                style="width: 117px; left: 201px; top: 0px; text-align: center; color: #667085; font-size: 14px; font-family: Inter; font-weight: 400; line-height: 24px; word-wrap: break-word">
                                                or with e-mail</div>
                                            <div
                                                style="width: 192px; height: 0px; left: 320px; top: 11.75px; border: 1px #D9D9D9 solid">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-10 mx-auto">
                                        <div class="row">
                                            <div class="col-12 col-md-6 ">
                                                <div class="w-100"
                                                    style="height: 65px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px; background: white; box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); border-radius: 8px; overflow: hidden; border: 1px #D0D5DD solid; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                                                    <div
                                                        style="flex: 1 1 0; height: 24px; justify-content: flex-start; align-items: center; gap: 8px; display: flex">

                                                        <input type="text"
                                                            style="flex: 1 1 0; color: #667085; font-size: 16px; font-family: Inter; font-weight: 400; line-height: 24px; word-wrap: break-word; outline: none; border:none;"
                                                            name="first_name" placeholder="First Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="w-100"
                                                    style="height: 65px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px; background: white; box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); border-radius: 8px; overflow: hidden; border: 1px #D0D5DD solid; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                                                    <div
                                                        style="flex: 1 1 0; height: 24px; justify-content: flex-start; align-items: center; gap: 8px; display: flex">

                                                        <input type="text"
                                                            style="flex: 1 1 0; color: #667085; font-size: 16px; font-family: Inter; font-weight: 400; line-height: 24px; word-wrap: break-word; outline: none; border:none;"
                                                            name="last_name" placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-10 mx-auto" style="margin-top: 28px;">
                                        <div class="w-100"
                                            style="height: 65px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px; background: white; box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); border-radius: 8px; overflow: hidden; border: 1px #D0D5DD solid; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                                            <div
                                                style="flex: 1 1 0; height: 24px; justify-content: flex-start; align-items: center; gap: 8px; display: flex">
                                                <div style="width: 20px; height: 20px; position: relative">
                                                    <span style="font-weight: 300 !important;"><i class="far fa-envelope"
                                                            style="width: 16.67px; height: 13.33px; left: 1.67px; top: 3.33px; position: absolute;"></i></span>

                                                </div>
                                                <input type="text"
                                                    style="flex: 1 1 0; color: #667085; font-size: 16px; font-family: Inter; font-weight: 400; line-height: 24px; word-wrap: break-word; outline: none; border:none;"
                                                    name="username" placeholder="User Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 mx-auto" style="margin-top: 28px;">
                                        <div class="w-100"
                                            style="height: 65px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px; background: white; box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); border-radius: 8px; overflow: hidden; border: 1px #D0D5DD solid; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                                            <div
                                                style="flex: 1 1 0; height: 24px; justify-content: flex-start; align-items: center; gap: 8px; display: flex">
                                                <div style="width: 20px; height: 20px; position: relative">
                                                    <span style="font-weight: 300 !important;"><i class="far fa-envelope"
                                                            style="width: 16.67px; height: 13.33px; left: 1.67px; top: 3.33px; position: absolute;"></i></span>

                                                </div>
                                                <input type="email"
                                                    style="flex: 1 1 0; color: #667085; font-size: 16px; font-family: Inter; font-weight: 400; line-height: 24px; word-wrap: break-word; outline: none; border:none;"
                                                    name="email" placeholder="olivia@untitledui.com">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 mx-auto" style="margin-top: 28px;">
                                        <div class="w-100"
                                            style="height: 65px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px; background: white; box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); border-radius: 8px; overflow: hidden; border: 1px #D0D5DD solid; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                                            <div
                                                style="flex: 1 1 0; height: 24px; justify-content: flex-start; align-items: center; gap: 8px; display: flex">
                                                <input type="password"
                                                    style="flex: 1 1 0; color: #667085; font-size: 16px; font-family: Inter; font-weight: 400; line-height: 24px; word-wrap: break-word; outline: none; border:none;"
                                                    name="password" placeholder="Password " >
                                                <div style="width: 24px; height: 24px; position: relative">
                                                    <span
                                                        style="width: 22px; height: 22px; left: 1px; top: 1px; position: absolute;"><i
                                                            class="far fa-eye-slash"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 mx-auto" style="margin-top: 28px;">
                                        <div class="w-100"
                                            style="height: 65px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px; background: white; box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); border-radius: 8px; overflow: hidden; border: 1px #D0D5DD solid; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                                            <div
                                                style="flex: 1 1 0; height: 24px; justify-content: flex-start; align-items: center; gap: 8px; display: flex">
                                                <div style="width: 20px; height: 20px; position: relative">
                                                    <span style="font-weight: 300 !important;"><i class="far fa-user"
                                                            style="width: 16.67px; height: 13.33px; left: 1.67px; top: 3.33px; position: absolute;"></i></span>

                                                </div>
                                                <input type="text"
                                                    style="flex: 1 1 0; color: #667085; font-size: 16px; font-family: Inter; font-weight: 400; line-height: 24px; word-wrap: break-word; outline: none; border:none;"
                                                    name="refer_code" placeholder="Enter referral code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 mx-auto" style="margin-top: 28px;">
                                        <div style="text-align: left;">
                                            <p
                                                style="color: #667085; font-family: Inter; font-size: 16px; font-style: normal; font-weight: 400; line-height: 28px;">
                                                By creating an account, you agreeing to our <a href=""
                                                    style="color: #101828; font-family: Inter; font-size: 16px; font-style: normal; font-weight: 400; line-height: 28px;">Privacy
                                                    Policy</a>, and <a href=""
                                                    style="color: #101828; font-family: Inter; font-size: 16px; font-style: normal; font-weight: 400; line-height: 28px;">Electronics
                                                    Communication Policy.</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-10 mx-auto" style="margin-top: 30px;">
                                        <div
                                            style="width: 515px; height: 65px; padding-left: 28px; padding-right: 28px; padding-top: 16px; padding-bottom: 16px; background: #1B434D; box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); border-radius: 8px; overflow: hidden; border: 1px #1B434D solid; justify-content: center; align-items: center; gap: 8px; display: inline-flex">

                                            <button type="submit"
                                                style="background:none; color: white; font-size: 18px; font-family: Inter; font-weight: 600; line-height: 28px; border: none; outline: none;">
                                                Sign Up
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-10 mx-auto" style="margin-top: 33px;">
                                        <p
                                            style="color: #101828; text-align: center; font-family: Inter; font-size: 16px; font-style: normal; font-weight: 400; line-height: 32px; /* 200% */">
                                            Have an account? <a href="{{route('landlord.user.login')}}"
                                                style="color: #101828; font-family: Inter; font-size: 16px; font-style: normal; font-weight: 600; line-height: 32px;text-decoration: none;">Sign
                                                In</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://kit.fontawesome.com/6e9c638913.js" crossorigin="anonymous"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                <x-btn.custom :id = "'register'":title = "__('Please Wait..')"/>
            });
        })(jQuery);
    </script>
@endsection

{{--
<form action="{{ route('landlord.user.register.store') }}" method="post" enctype="multipart/form-data"
    class="contact-page-form style-01" id="msform">
    @csrf
    <fieldset>
        <h2 class="fs-title">Personal Details</h2>
        <div class="col-lg-12 col-md-12">
            <div class="input-form input-form2">
                <input type="text" name="name" placeholder="{{ __('Name') }}"
                    value="{{ old('name') }}">
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="input-form input-form2">
                <input type="text" name="username" placeholder="{{ __('Username') }}"
                    value="{{ old('username') }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="input-form input-form2">
                <input type="text" name="address" placeholder="{{ __('Address') }}"
                    value="{{ old('address') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="input-form input-form2">
                <select name="country" class="form-control register_countries niceSelect_active">
                    <option disabled="" selected>{{ __('Select a country') }}</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="input-form">
                <input name="mobile" type="tel" placeholder="{{ __('Phone') }}" class="phone"
                    value="{{ old('mobile') }}" id="phone">
            </div>
        </div>
        <div class="error text-danger" style="display:none"></div>
        <div id="recaptach-container"></div>
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Vefiry OTP </h2>
        <h3 class="fs-subtitle">Enter your OTP</h3>
        <div class="col-lg-12">
            <div class="input-form">
                <input name="otp" type="text" placeholder="{{ __('OTP') }}" class="otp"
                    id="verificationCode" style="padding-left:45px;">
            </div>
        </div>

        <div class="error text-danger" style="display:none"></div>
        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>

    <fieldset>
        <h2 class="fs-title">Create your account</h2>
        <h3 class="fs-subtitle">Fill in your credentials</h3>
        <div class="col-md-12">
            <div class="input-form input-form2">
                <input type="text" name="email" placeholder="{{ __('Email') }}"
                    value="{{ old('email') }}">
            </div>
        </div>
        <input type="password" name="pass" placeholder="Password" />
        <input type="password" name="cpass" placeholder="Confirm Password" />
        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
        <input type="submit" name="submit" class="submit action-button" value="Submit" />
    </fieldset>

</form>
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>
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
    </script>


    <script>
        var input = document.querySelector("#phone")

        var iti = intlTelInput(input);



        $("#phone").focusout(function(e, countryData) {
            let phone_number = $("#phone").val();
            phone_number = iti.getNumber(intlTelInputUtils.numberFormat);
            var selectedCountryData = iti.getSelectedCountryData().iso2;
        });
    </script>

    <script>
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(async function() {

            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            phone_number = $(current_fs).find('#phone').val()
            nextButton = current_fs.find('.next')
            if (phone_number != undefined) {
                if ($(current_fs).find('input[name="phone"]').val() == '') {
                    current_fs.find('.error').text('Please enter phone number').show();
                    current_fs.find('input[name="phone"]').focus();
                    current_fs = $(this).parent();
                    animating = false;
                    nextButton.removeAttr("disabled")
                    return;
                } else {
                    current_fs.find('.error').text('').hide();
                    var selectedCountryData = iti.getSelectedCountryData();

                    if (selectedCountryData.iso2 != 'bd') {

                        result = await sendOtp(phone_number, selectedCountryData.dialCode);
                        if (result && result.verificationId) {
                            next_fs = $(this).parent().next();
                            next_fs.show();
                        } else {
                            if (result && result.message) {
                                current_fs.find('.error').text(result.error).show();
                            } else {
                                current_fs.find('.error').text('Select Contry and enter Valid Number').show();
                            }
                            current_fs.find('input[name="phone"]').focus();
                            current_fs = $(this).parent();
                            animating = false;
                            return;
                        }
                    } else {
                        result = await sendOtpBd(phone_number)
                        if (result && result.message_id) {
                            next_fs = $(this).parent().next();
                            next_fs.show();
                        } else {
                            if (result && result.message) {
                                current_fs.find('.error').text(result.message).show();
                            } else {
                                current_fs.find('.error').text('Select Contry and enter Valid Number').show();
                            }
                            current_fs.find('input[name="phone"]').focus();
                            current_fs = $(this).parent();
                            animating = false;
                            return;
                        }
                        nextButton.removeAttr("disabled")
                    }
                }
            }

            otp = $(current_fs).find('input[name="otp"]').val()
            if (otp != undefined) {

                if (otp) {
                    result = await verifyBdOtp(otp);
                    if (!result) {
                        current_fs.find('.error').text('Invalid OTP').show();
                        current_fs.find('input[name="otp"]').focus();
                        current_fs = $(this).parent();
                        animating = false;
                        return;
                    } else {
                        if (!result.status) {
                            current_fs.find('.error').text(result.message).show();
                            current_fs.find('input[name="otp"]').focus();
                            current_fs = $(this).parent();
                            animating = false;
                            return;
                        }
                    }

                } else {

                    current_fs.find('.error').text('Please enter OTP').show();
                    current_fs.find('input[name="otp"]').focus();
                    current_fs = $(this).parent();
                    animating = false;
                    return;
                }

            }
            next_fs = $(this).parent().next();

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
@endsection
--}}
