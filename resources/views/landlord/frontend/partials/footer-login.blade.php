<script src="{{global_asset('assets/common/js/jquery-3.6.1.min.js')}}"></script>
<script src="{{asset('assets/landlord/frontend/js/popper.min.js')}}"></script>
<script src="{{asset('assets/landlord/frontend/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/landlord/common/js/axios.min.js')}}"></script>
<script src="{{asset('assets/landlord/frontend/js/plugin.js')}}"></script>
<script src="{{asset('assets/landlord/frontend/js/jquery.magnific-popup.js')}}"></script>
<script src="{{global_asset('assets/common/js/CustomLoader.js')}}"></script>
<script src="{{asset('assets/landlord/frontend/js/main.js')}}"></script>
<script src="{{asset('assets/landlord/frontend/js/dynamic-script.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<x-custom-js.lang-change-landlord/>
<x-custom-js.landlord-newsletter-store/>
<x-blog::frontend.custom-js.category-show/>

@php $site_google_captcha_v3_site_key = get_static_option('site_google_captcha_v3_site_key'); @endphp
@if(!empty($site_google_captcha_v3_site_key))
    <script src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function (token) {
                if(document.getElementById('gcaptcha_token') != null){
                    document.getElementById('gcaptcha_token').value = token;
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.dashboard-list .has-children a', function(e) {
            var sh = $(this).parent('.has-children');
            if (sh.hasClass('open')) {
                sh.removeClass('open');
                sh.find('.sub-menu').children('.has-children').removeClass("open"); //2nd children remove
                sh.find('.sub-menu').removeClass('open');
                sh.find('.sub-menu').slideUp(300);
            } else {
                sh.addClass('open');
                sh.children('.sub-menu').slideDown(300);
                sh.siblings('.has-children').children('.sub-menu').slideUp(300);
                sh.siblings('.has-children').removeClass('open');
                sh.siblings().find('.sub-menu').children('.has-children').removeClass('open'); //2nd Submenu children remove
                sh.siblings().find('.sub-menu').slideUp(300); //2nd Submenu children Slide Up Down
            }
        });
    </script>
    @endif


<script>
     if (window.top != window.self) {
        document.body.innerHTML += '<div class="external-website">' +
            '<p class="external-website-para">You are using this website under an external iframe!!</p>' +
            '<p  class="external-website-para mt-3">for a better experience, please browse directly instead of an external iframe.</p>' +
            '<a href="'+window.self.location+'" target="_blank" class="external-website-btn mt-3">Browse Directly</a>' +
            '</div>';
     }
</script>

    @include('landlord.frontend.partials.gdpr-cookie')
@yield('scripts')
</body>
</html>
