@php
    $default_lang = $request->lang ?? \App\Facades\GlobalLanguage::default_slug();
@endphp
    <!-- Booking Two area end -->
<section class="attraction-area pat-50 pab-50">
    <div class="container">
        <div class="section-title center-text">
            <h2 class="title">{{$data['top_title']}} </h2>
            <div class="section-title-line"> </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="global-slick-init attraction-slider nav-style-one nav-color-two slider-inner-margin" data-rtl="{{get_user_lang_direction_bool()}}" data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="4" data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500" data-prevArrow='<div class="prev-icon radius-parcent-50"><i class="las la-angle-left"></i></div>'
                     data-nextArrow='<div class="next-icon radius-parcent-50"><i class="las la-angle-right"></i></div>' data-responsive=''>
                    @foreach($data['repeater_data']['repeater_title_'.get_user_lang()] ?? [] as $key => $title)
                        @php
                            $repeater_image = $data['repeater_data']['repeater_image_'.get_user_lang()][$key] ?? '';
                            $repeater_description = $data['repeater_data']['repeater_description_'.get_user_lang()][$key] ?? '';
                        @endphp
                    <div class="attraction-item">
                        <div class="single-attraction-two radius-20">
                            <div class="single-attraction-two-thumb">
                                <a href="{!! render_image_url_by_attachment_id($repeater_image) !!}" class="gallery-popup"> {!! render_image_markup_by_attachment_id($repeater_image) !!} </a>
                            </div>@php
                            $array_data = [
                                'title'=>$title,
                                'image_id' =>$repeater_image,
                                'description' =>$repeater_description,
                            ];
                            @endphp
                            <div class="single-attraction-two-contents">
                                <h4 class="single-attraction-two-contents-title"> <a href="{{route('tenant.frontend.single-attraction', ['title' => $title, 'image_id' => $repeater_image?$repeater_image:539, 'description' => urlencode($repeater_description)])}}"> {{$title}}</a> </h4>
                                <p class="single-attraction-two-contents-para">   {{ \Illuminate\Support\Str::limit($repeater_description, 70, $end='.......') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
