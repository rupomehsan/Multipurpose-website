<div class="newsletter-area pat-50">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="newsletter-wrapper newsletter-bg radius-20 newsletter-wrapper-padding wow zoomIn" data-wow-delay=".3s">
                    <div class="newsletter-wrapper-shapes">
                        <img src="assets/img/newsletters/newsletter-shape1.png" alt="shapes">
                        <img src="assets/img/newsletters/newsletter-shape2.png" alt="shapes">
                    </div>
                    <div class="newsletter-contents center-text">
                        <h3 class="newsletter-contents-title"> {{$data['title']}} </h3>
                        <p class="newsletter-contents-para mt-3"> {{$data['description']}} </p>
                        <div class="newsletter-contents-form custom-form mt-4">
                            <x-error-msg/>
                            <x-flash-msg/>
                            <form action="{{route('tenant.admin.newsletter.new.add')}}" method="post">
                                @csrf
                                <div class="single-input">
                                    <input type="text" name="email" class="form--control" placeholder="{{__('Enter Email')}}">
                                    <button type="submit"> {{__('Submit')}} </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
