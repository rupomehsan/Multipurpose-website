@include('landlord.frontend.partials.header')
<section class="sliderAreaInner sectionBg1 @if((in_array(request()->route()->getName(),['landlord.homepage','landlord.dynamic.page']) && $page_post->breadcrumb == 0 ))
     d-none
@endif">
    <!-- Shape -->
    <div class="shapeHero wow fadeInLeft" data-wow-delay="1s">

        {!! render_image_markup_by_attachment_id(get_static_option('breadcrumb_left_image'),'bouncingAnimation') !!}
    </div>
    <div class="shapeHero2 wow fadeInRight" data-wow-delay="1s">

        {!! render_image_markup_by_attachment_id(get_static_option('breadcrumb_right_image'),'bouncingAnimation') !!}
    </div>
</section>

@yield('content')
@include('landlord.frontend.partials.footer')
