@extends('tenant.frontend.frontend-page-master')
@php
    $post_img = null;
    $user_lang = get_user_lang();
@endphp

@section('page-title')
    title
@endsection

@section('title')
    {{--    {{ $blog_post->getTranslation('title',$user_lang) }}--}}
    title
@endsection

@section('meta-data')
    {{--    {!!  render_page_meta_data($blog_post) !!}--}}
@endsection

@section('style')
    <style>
        .singleBlog-details .blogCaption .cartTop {
            margin-bottom: 16px;
        }
        .singleBlog-details .blogCaption .cartTop .listItmes {
            display: inline-block;
            margin-right: 10px;
            font-size: 16px;
            font-weight: 300;
        }
        .singleBlog-details .blogCaption .cartTop .listItmes .icon {
            color: var(--peragraph-color);
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
    @php
        $lang_slug = request()->get('lang') ?? \App\Facades\GlobalLanguage::default_slug();
    @endphp
    <section class="blog-details-area pat-100 pab-100">
        <div class="container">
            <div class="shop-contents-wrapper">
                <div class="row gy-5">
                    <div class="col-xl-8 col-lg-8">
                        <div class="blog-details-wrapper">
                            <div class="single-blog-details">
                                <div class="single-blog-details-content pt-0">
                                    <h2 class="single-blog-details-content-title fw-500"> Do they have any other concerns or needs that we should keep in mind during the demo today? </h2>
                                    <div class="single-blog-details-content-tags mt-3">
                                        <span class="single-blog-details-content-tags-item"> <a href="javascript:void(0)"> Category </a> </span>
                                        <span class="single-blog-details-content-tags-item"> 28 Jun 2022 </span>
                                    </div>
                                    <div class="single-blog-details-thumb mt-4">
                                        <img class="radius-5" src="assets/img/blog/blog_details.jpg" alt="">
                                    </div>
                                    <p class="single-blog-details-content-para mt-4"> Mutley, you snickering, floppy eared hound. When courage is needed, you’re never around. Those medals you wear on your moth-eaten chest should be there for bungling at which you are best. So, stop that pigeon, stop
                                        that pigeon, stop that pigeon, stop that pigeon, stop that pigeon, stop that pigeon, stop that pigeon. Howwww! Nab him, jab him, tab him, grab him, stop that pigeon now. </p>
                                    <p class="single-blog-details-content-para mt-4"> One for all and all for one, Muskehounds are always ready. One for all and all for one, helping everybody. One for all and all for one, it’s a pretty story. Sharing everything with fun, that’s the way to be. One for
                                        all and all for one, Muskehounds are always ready. One for all and all for one, helping everybody. One for all and all for one, can sound pretty corny. If you’ve got a problem chum, think how it could be. </p>
                                    <blockquote class="section-bg-1 mt-4">
                                        <div class="blockquote-contents">
                                            <h3 class="blockquote-contents-title color-heading fw-500"> What do you currently do to manage? Do you feel that is getting the results you want?” </h3>
                                        </div>
                                    </blockquote>
                                    <p class="single-blog-details-content-para mt-4"> One for all and all for one, Muskehounds are always ready. One for all and all for one, helping everybody. One for all and all for one, it’s a pretty story. Sharing everything with fun, that’s the way to be. One for
                                        all and all for one, Muskehounds are always ready. One for all and all for one, helping everybody. One for all and all for one, can sound pretty corny. If you’ve got a problem chum, think how it could be. </p>
                                    <div class="blog-details-advertise center-text mt-4">
                                        <a href="javascript:void(0)"> <img class="radius-5" src="assets/img/blog/advertise.jpg" alt=""> </a>
                                    </div>
                                    <p class="single-blog-details-content-para mt-4"> Dolor sit amet, consectetur adipiscing elit. Semper cras elementum sit risus ornare ac. Sed donec malesuada elit vitae mollis cras quam. Ut risus euismod etiam vel imperdiet pellentesque. Tristique neque lacinia non
                                        interdum. Amet orci, neque, mauris, amet mattis ultrices iaculis eget lacus. Mi placerat sagittis malesuada enim etiam at tellus. Sed et vitae enim nam a lacinia tristique nunc. Ac posuere enim faucibus quis id
                                        tellus rutrum sed proin. Faucibus turpis in scelerisque elementum mauris vestibulum. </p>
                                    <p class="single-blog-details-content-para mt-4"> Sed donec malesuada elit vitae mollis cras quam. Ut risus euismod etiam vel imperdiet pellentesque. Tristique neque lacinia non interdum. Amet orci, neque, mauris, amet mattis ultrices iaculis eget lacus. Mi placerat
                                        sagittis malesuada enim etiam at tellus. Sed et vitae enim nam a lacinia tristique nunc. Ac posuere enim faucibus quis id tellus rutrum sed proin. Faucibus turpis in scelerisque elementum mauris vestibulum. </p>
                                </div>
                            </div>
                            <!-- Details Tag area starts -->
                            <div class="details-tag-area color-two pat-25 pab-50">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 mt-4">
                                        <div class="blog-details-share-content">
                                            <h4 class="blog-details-share-content-title"> Share: </h4>
                                            <ul class="blog-details-share-social list-style-none">
                                                <li class="blog-details-share-social-list">
                                                    <a class="blog-details-share-social-list-icon" href="javascript:void(0)"> <i class="lab la-facebook-f"></i> </a>
                                                </li>
                                                <li class="blog-details-share-social-list">
                                                    <a class="blog-details-share-social-list-icon" href="javascript:void(0)"> <i class="lab la-twitter"></i> </a>
                                                </li>
                                                <li class="blog-details-share-social-list">
                                                    <a class="blog-details-share-social-list-icon" href="javascript:void(0)"> <i class="lab la-pinterest-p"></i> </a>
                                                </li>
                                                <li class="blog-details-share-social-list">
                                                    <a class="blog-details-share-social-list-icon" href="javascript:void(0)"> <i class="lab la-youtube"></i> </a>
                                                </li>
                                                <li class="blog-details-share-social-list">
                                                    <a class="blog-details-share-social-list-icon" href="javascript:void(0)"> <i class="lab la-instagram"></i> </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-4">
                                        <div class="blog-details-share-content right-align">
                                            <h4 class="blog-details-share-content-title"> Tags: </h4>
                                            <ul class="blog-details-tag list-style-none">
                                                <li class="blog-details-tag-list"><a class="blog-details-tag-list-item" href="javascript:void(0)"> New </a></li>
                                                <li class="blog-details-tag-list"><a class="blog-details-tag-list-item" href="javascript:void(0)"> Luxurious </a></li>
                                                <li class="blog-details-tag-list"><a class="blog-details-tag-list-item" href="javascript:void(0)"> Simple </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Details Tag area end -->
                            <!-- Comment area Starts -->
                            <div class="comment-area color-two pat-50 pab-50">
                                <h3 class="details-section-title"> Comments(03) </h3>
                                <div class="row">
                                    <div class="col-lg-12 mt-2">
                                        <div class="comment-show-contents">
                                            <ul class="comment-list list-style-none wow fadeInLeft" data-wow-delay=".1s">
                                                <li>
                                                    <div class="blog-details-flex-content">
                                                        <div class="blog-details-thumb radius-10">
                                                            <img src="assets/img/blog/details-comment1.jpg" alt="">
                                                        </div>
                                                        <div class="blog-details-content">
                                                            <div class="blog-details-content-flex">
                                                                <div class="blog-details-content-item">
                                                                    <h5 class="blog-details-content-title"> <a href="javascript:void(0)"> Riyad Hossain </a> </h5>
                                                                    <span class="blog-details-content-date"> Jun 22, 2022 </span>
                                                                </div>
                                                                <a href="javascript:void(0)" class="btn-replay"> <i class="las la-reply-all"></i> Reply </a>
                                                            </div>
                                                            <p class="blog-details-content-para"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a egestas leo. Aliquam ut ante lobortis tellus cursus pellentesque. Praesent feugiat tellus quis aliquet </p>
                                                        </div>
                                                    </div>
                                                    <ul class="comment-list list-style-none wow fadeInLeft" data-wow-delay=".2s">
                                                        <li>
                                                            <div class="blog-details-flex-content">
                                                                <div class="blog-details-thumb radius-10">
                                                                    <img src="assets/img/blog/details-comment2.jpg" alt="">
                                                                </div>
                                                                <div class="blog-details-content">
                                                                    <div class="blog-details-content-flex">
                                                                        <div class="blog-details-content-item">
                                                                            <h5 class="blog-details-content-title"> <a href="javascript:void(0)"> Rajia Akter </a> </h5>
                                                                            <span class="blog-details-content-date"> Jun 23, 2022 </span>
                                                                        </div>
                                                                        <a href="javascript:void(0)" class="btn-replay"> <i class="las la-reply-all"></i> Reply </a>
                                                                    </div>
                                                                    <p class="blog-details-content-para"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a egestas leo. Aliquam ut ante lobortis tellus cursus pellentesque. Praesent feugiat tellus quis aliquet </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <ul class="comment-list list-style-none wow fadeInLeft" data-wow-delay=".3s">
                                                <li>
                                                    <div class="blog-details-flex-content">
                                                        <div class="blog-details-thumb radius-10">
                                                            <img src="assets/img/blog/details-comment1.jpg" alt="">
                                                        </div>
                                                        <div class="blog-details-content">
                                                            <div class="blog-details-content-flex">
                                                                <div class="blog-details-content-item">
                                                                    <h5 class="blog-details-content-title"> <a href="javascript:void(0)"> Bryn Colon </a> </h5>
                                                                    <span class="blog-details-content-date"> Jun 24, 2022 </span>
                                                                </div>
                                                                <a href="javascript:void(0)" class="btn-replay"> <i class="las la-reply-all"></i> Reply </a>
                                                            </div>
                                                            <p class="blog-details-content-para"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a egestas leo. Aliquam ut ante lobortis tellus cursus pellentesque. Praesent feugiat tellus quis aliquet </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="btn-wrapper mt-4">
                                                <a href="javascript:void(0)" class="btn-see-more"> Show More </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Comment area ends -->
                            <!-- Post Comment area Starts -->
                            <div class="comment-area color-two pat-50">
                                <h3 class="details-section-title"> Post Your Comment </h3>
                                <div class="row">
                                    <div class="col-lg-12 pat-20">
                                        <div class="details-comment-content">
                                            <div class="comments-flex-item">
                                                <div class="single-commetns">
                                                    <label class="comment-label"> Your Name </label>
                                                    <input type="text" class="form--control radius-5" name="name" placeholder="Type Name">
                                                </div>
                                                <div class="single-commetns">
                                                    <label class="comment-label"> Email Address </label>
                                                    <input type="text" class="form--control radius-5" name="email" placeholder="Type Email">
                                                </div>
                                            </div>
                                            <div class="single-commetns">
                                                <label class="comment-label"> Comment </label>
                                                <textarea name="message" class="form--control radius-5 form--message" placeholder="Post Comments"></textarea>
                                            </div>
                                            <button type="submit" class="submit-btn radius-5 mt-4"> Post Comment </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Post Comment area ends -->
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="blog-details-side">
                            <div class="blog-details-side-item radius-10">
                                <div class="blog-details-side-title open">
                                    <h5 class="title"> Recent Post </h5>
                                    <div class="blog-details-side-inner">
                                        <ul class="recent-list list-style-none">
                                            <li class="recent-list-item">
                                                <div class="recent-list-thumb">
                                                    <a href="#0"> <img class="lazyloads radius-5" src="assets/img/blog/recent-post1.jpg" alt=""> </a>
                                                </div>
                                                <div class="recent-list-contents">
                                                    <h6 class="recent-list-title fs-16"> <a href="#0"> Choose From a Wide Range of Properties </a> </h6>
                                                    <span class="recent-list-dates light-color fs-14 mt-2"> 21 Jun 2022 </span>
                                                </div>
                                            </li>
                                            <li class="recent-list-item">
                                                <div class="recent-list-thumb">
                                                    <a href="#0"> <img class="lazyloads radius-5" src="assets/img/blog/recent-post2.jpg" alt=""> </a>
                                                </div>
                                                <div class="recent-list-contents">
                                                    <h6 class="recent-list-title fs-16"> <a href="#0"> Choose From a Wide Range of Properties </a> </h6>
                                                    <span class="recent-list-dates light-color fs-14 mt-2"> 22 Jun 2022 </span>
                                                </div>
                                            </li>
                                            <li class="recent-list-item">
                                                <div class="recent-list-thumb">
                                                    <a href="#0"> <img class="lazyloads radius-5" src="assets/img/blog/recent-post3.jpg" alt=""> </a>
                                                </div>
                                                <div class="recent-list-contents">
                                                    <h6 class="recent-list-title fs-16"> <a href="#0"> Choose From a Wide Range of Properties </a> </h6>
                                                    <span class="recent-list-dates light-color fs-14 mt-2"> 24 Jun 2022 </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-details-side-item radius-10">
                                <div class="blog-details-side-title open">
                                    <h5 class="title"> Tags </h5>
                                    <div class="blog-details-side-inner">
                                        <ul class="tag-list list-style-none active-list">
                                            <li class="tag-list-item">
                                                <a class="tag-list-link" href="#0"> Low Price </a>
                                            </li>
                                            <li class="tag-list-item active">
                                                <a class="tag-list-link" href="#0"> High Price </a>
                                            </li>
                                            <li class="tag-list-item">
                                                <a class="tag-list-link" href="#0"> Big Room </a>
                                            </li>
                                            <li class="tag-list-item">
                                                <a class="tag-list-link" href="#0"> Small Room </a>
                                            </li>
                                            <li class="tag-list-item">
                                                <a class="tag-list-link" href="#0"> New </a>
                                            </li>
                                            <li class="tag-list-item">
                                                <a class="tag-list-link" href="#0"> Discount </a>
                                            </li>
                                            <li class="tag-list-item">
                                                <a class="tag-list-link" href="#0"> Luxurious </a>
                                            </li>
                                            <li class="tag-list-item">
                                                <a class="tag-list-link" href="#0"> Normal </a>
                                            </li>
                                            <li class="tag-list-item">
                                                <a class="tag-list-link" href="#0"> Sale </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    @yield("custom-ajax-scripts")
    <script>
        $(document).on('submit', '#checkoutForm', function (e) {
            e.preventDefault();
            var form = $(this);
            var formID = form.attr('id');
            var formSelector = document.getElementById(formID);
            var formData = new FormData(formSelector);

            $.ajax({
                url: "{{route('tenant.frontend.checkout')}}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                processData: false,
                contentType: false,
                data:formData,
                success: function (data) {
                    if (data.warning_msg)
                    {
                        CustomSweetAlertTwo.warning(data.warning_msg)
                    }
                    else{
                        window.location.href = data.redirect_url;
                    }

                }
            })
        });


        // Get today's date
        var today = new Date();

        // Calculate the date 14 days from today
        var sevenDaysFromToday = new Date(today);
        sevenDaysFromToday.setDate(today.getDate() + 13);


        flatpickr(".test-picker", {
            enableTime: false,
            minDate: "today",
            maxDate:sevenDaysFromToday,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            // Other options...
        });

        // flatpickr(".test-picker", {
        //     altInput: fl,
        //     altFormat: "F j, Y",
        //     dateFormat: "Y-m-d",
        // });
    </script>

@endsection
