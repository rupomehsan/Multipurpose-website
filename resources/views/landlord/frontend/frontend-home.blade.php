@extends('landlord.frontend.frontend-page-master')
@section('content')
    @include('tenant.frontend.partials.pages-portion.dynamic-page-builder-part',['page_post' => $page_post])
    <script>
     $(window).on('load',function(){
        setTimeout(function(){
            $('#popupModal').modal('show');
        },2000)
    });
</script>
@endsection
