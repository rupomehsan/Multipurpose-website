@extends(route_prefix().'admin.admin-master')

@section('style')
    <x-datatable.css/>
    <x-media-upload.css/>
    <style>
        .all_donation_info_column li{
            list-style-type: none;
        }
    </style>
@endsection

@section('title')
    {{__('All Jobs')}}
@endsection

@section('content')
   
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <x-error-msg/>
                        <x-flash-msg/>
                        <x-admin.header-wrapper>
                            <x-slot name="left">
                                <h4 class="card-title mb-5">{{__('All Jobs')}}</h4>
                                <x-bulk-action permissions="donation-delete"/>
                            </x-slot>
                            <x-slot name="right" class="d-flex">
                               
                                <p></p>
                                <a href="{{route('tenant.admin.job.new')}}"
                                   class="btn btn-info btn-sm mb-3">{{__('Add New')}}</a>
                            </x-slot>
                        </x-admin.header-wrapper>

                        <div class="table-wrap table-responsive">
                            <table class="table table-default table-striped table-bordered">
                                <thead class="text-white">
                                <th class="no-sort">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Info')}}</th>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   <x-media-upload.markup/>
@endsection

@section('scripts')
    @include('components.datatable.yajra-scripts',['only_js' => true])
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                <x-bulk-action-js :url="route('tenant.admin.job.bulk.action')"/>
            })
        })(jQuery)
    </script>
    <x-media-upload.js/>

    <script type="text/javascript">
        $(function () {
           

            $(document).on('change','select[name="lang"]',function (e){
                $(this).closest('form').trigger('submit');
                $('input[name="lang"]').val($(this).val());
            });

        });
    </script>
@endsection
