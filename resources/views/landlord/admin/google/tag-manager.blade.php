@extends(route_prefix().'admin.admin-master')
@section('title') {{__('Google Settings')}} @endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-error-msg/>
                <x-flash-msg/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Google Settings")}}</h4>
                        <form action="{{route(route_prefix().'admin.google.settings.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="google_tag_manager">{{__('Google Tag Manager')}}</label>
                                <textarea type="text" name="google_tag_manager"  class="form-control" cols="30" rows="10"  id="google_tag_manager">{!! get_static_option('google_tag_manager') !!}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection