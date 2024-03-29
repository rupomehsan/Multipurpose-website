@if(!request()->is('/'))
@include('tenant.frontend.partials.topbar')
<header class="header-style-01">

    <div class="">
{{--        <div class="softwareFirm_header__shapes">--}}
{{--            <img src="{{global_asset('assets/tenant/frontend/themes/img/software-business/banner/software_banner_shape.png')}}" alt="">--}}
{{--        </div>--}}
        <!-- Menu area Starts -->
        <nav class="navbar softwareFirm_nav navbar-area navbar-padding navbar-expand-lg">
            <div class="container nav-container">
                <div class="responsive-mobile-menu">
                    <div class="logo-wrapper">
                        <a href="{{url('/')}}" class="logo">
                            {!! render_image_markup_by_attachment_id(get_static_option('site_logo'),'logo') !!}
                        </a>
                    </div>
                    <a href="javascript:void(0)" class="click-nav-right-icon">
                        <i class="fa-solid fa-ellipsis-v"></i>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#book_point_menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="book_point_menu">
                    <ul class="navbar-nav">
                        {!! render_frontend_menu($primary_menu) !!}
                    </ul>
                </div>
                <div class="navbar-right-content show-nav-content">
                    <div class="single-right-content">
                        <div class="navbar-right-btn">
                            <a href="{{ get_static_option('software_business_top_contact_button_'.get_user_lang().'_url') }}" class="softwareFirm_cmn_btn btn_bg_1 softwareFirm_cmn_btn-small radius-10">
                                     {{ get_static_option('software_business_top_contact_button_'.get_user_lang().'_text') ?? __('Contact') }}<i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
<div class="search-suggestion-overlay"></div>
@endif
