<div class="row gx-1 gy-4 ">
    <input type="hidden" name="theme_slug" class="theme_slug" value="">
    <input type="hidden" name="theme_code" class="theme_code" value="">
    @foreach ($themes as $theme)
        @php
            $theme_image = get_static_option_central($theme->slug . '_theme_image');
        @endphp
        <div class="col-md-3 theme_item">
            <img src="{{ $theme_image }}" alt="" class="img-fluid px-2 w-100 theme-image">
            <div class="active-button" data-slug="{{$theme->slug}}" data-code="{{$theme->theme_code}}">
                <button type="button" class="px-3 next">active</button>
            </div>
        </div>
    @endforeach
    <div class="col-md-3 ms-auto">
        {{-- {!! $themes->links() !!} --}}
    </div>
</div>

<script>
    $('.active-button').click(function(){
        var slug = $(this).data('slug');
        var code = $(this).data('code');

        $('.theme-image').removeClass('active-theme');

        $(this).closest('.theme_item').find('.theme-image').addClass('active-theme');
        $('.theme_slug').val(slug);
        $('.theme_code').val(code);
    })
</script>
