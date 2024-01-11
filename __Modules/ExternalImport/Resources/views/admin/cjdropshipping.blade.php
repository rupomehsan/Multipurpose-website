@extends(route_prefix().'admin.admin-master')

@section('style')
    <x-datatable.css/>
    <x-media-upload.css/>
    <style>
        .all_donation_info_column li{
            list-style-type: none;
        }
        .importedproduct .importedForm{
            z-index: 2;
            cursor: pointer;
            background-color: rgba(21,27,30,.853);
            bottom: -100%;
            transition: 400ms;
        }
        .importedproduct:hover .importedForm{
            bottom: 0;
        }
        /* .f-img{height: 350px;} */
        @media only screen and (max-width:414px){
            /* .f-img{height: 130px;} */
            .catName{
                letter-spacing: -0.5px;
                font-size: 12px;
                line-height: 14px;
            }
            .card-title {
                font-size: 13px;
                min-height: 35px;
                letter-spacing: -0.7px;
            }
            .card-footer {
                padding: 10px 5px !important;
            }
            .mb-xs-2{
                margin-bottom: 2px;
            }
            .pr-0{
                padding-right: 0;
            }
        }
        </style>
@endsection

@section('title')
    {{__('CJ Dropshipping Products')}}
@endsection

@section('content')
   
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <x-error-msg/>
                        <x-flash-msg/>
                        <div class="header">
                            <div class="mb-3">
                                <form class="form" method="get">
                                    <div class="w-100 d-block">
                                        <div class="row w-100">
                                            <div class="col-md-5 align-items-center mb-2 mx-w-50 w-40 pr-5">
                                                <div class="input-group align-items-center">
                                                    <label class="mr-5" style="margin-right: 10px;" for="pagesize">{{__('Product in each page')}}</label>
                                                    <input type="number" id="pagesize" min="10" step="1" value="{{  $request->pagesize ?? 10 }}" class="form-control d-block ml-3" name="pagesize" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-5 mb-2 w-40 pl-5">
                                                <div class="input-group align-items-center">
                                                    <label class="mr-5" style="margin-right: 10px;" for="pagesize">{{__('Page Number')}}</label>
                                                    <input type="number" min="1" step="1" class="form-control ml-3" name="pagenum" autocomplete="off" value="{{ $request->pagenum ?? 1 }}">
                                                </div>
                                            </div>
                                            <div class="align-items-center col-md-2 col-2 col-sm-2 w-10">
                                                {{-- <div class="d-grid">                                             --}}
                                                    <button class="btn btn-block lg-button btn-lg btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                                {{-- </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                        </div>

                        <div class="table-wrap table-responsive">
                            <div class="row">
                                @if($returnError)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{$returnError}}
                                    </div>
                                @endif
                                @foreach($products as $product)
                                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                    <div class="card importedproduct">
                                      <div class="card-body p-0 text-center overflow-hidden d-flex max-auto m-auto justify-center">
                                        <img class="img-thumbnail border-0 p-0 max-auto d-block object-fit-fill f-img" style="object-fit:cover;" src="{{$product->productImage}}" alt="{{$product->productNameEn}}" srcset="">
                                      </div>
                                      <div class="card-footer" style="position: relative; overflow:hidden;">
            
                                        <h6 class="card-title font-size-base font-weight-normal" style="letter-spacing: -0.1px; font-size: 15px;">{{ Illuminate\Support\Str::limit($product->productNameEn, 35)}}</h6>
                                        <div class="row">
                                            <ul class="list-group list-style-none w-100 pr-0" style="padding: 0">
                                                <li class="list-group-item d-block pb-0 flex-row pl-3 pr-3 justify-content-between align-items-center active">
                                                    <p class="d-block text-center w-100 mb-0 catName">{{$product->categoryName}}</p>
                                                </li>
                                                <li class="list-group-item text-center d-block pt-0 flex-row pl-3 pr-3 justify-content-between align-items-center active">
                                                    <p class="badge bg-secondary text-center mb-0 badge-pill">${{$product->sellPrice}}</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="form importedForm w-100" style="position: absolute; left: 0">
                                            @if(!in_array($product->productNameEn, $ex_products))
                                            <form method="post" action="{{ route('externalimport.storeproduct') }}" class="regular-form-submit">
                                                @csrf
                                                <div class="pl-3 pr-3 row pb-3 pt-3">
                                                    <div class="col mb-2">
                                                        <input type="number" class="form-control pl-1 pr-1 mb-xs-2"  name="price" id="price" value="{{ (float) $product->sellPrice }}">   
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-grid">
                                                            <input class="btn w-100 btn-primary d-block btn-basic" type="submit" value="{{__('Import')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="name" value="{{$product->productNameEn}}">
                                                <input type="hidden" name="categories" value="{{$product->categoryName}}">
                                                <input type="hidden" name="sku" value="{{$product->productSku}}">
                                                <input type="hidden" id="preview" name="preview" value="{{ $product->productImage }}">
                                                <input type="hidden" name="weight" value="{{$product->productWeight}}">
                                                <input type="hidden" name="source" value="cj">
                                                <input type="hidden" name="pid" value="{{$product->pid}}">
                                            </form>
                                            @else
                                                <div class="text-center">
                                                    <h5 class="mt-3 pt-3 pb-3 text-white">{{__('Product already Imported!!!')}}</h5>
                                                </div>
                                            @endif
                                          </div>
                                      </div>
            
                                     
                                    </div>
                                  </div>
                                @endforeach
                            </div>
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
            
        });
    </script>
@endsection
