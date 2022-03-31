

@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.basic_setting_favicon_head_title')}} @endif | {{trans('message.app_name')}}
@endsection
@section('style')

@endsection
@section('content')


            <div class="page-wrapper">
                <div class="page-content">
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">{{trans('message.basic_setting_title')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('message.basic_setting_favicon_head_title')}}</li>
                                </ol>
                            </nav>
                        </div>
                        
                    </div>
                     <div class="row">
                        <div class="col-xl-9 mx-auto">
                            <hr/>
                            <div class="card">
                                <div class="card-body ">
                                    @if(isset($favicon) && $favicon->favicon !=null)
                        
                                <img class="imagePreview" style="width: 180px; height: 180px;" id="output" src="{{$favicon->getFaviconImageUrl()}}"/>
                              
                                      @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-9 mx-auto">
                            <h6 class="mb-0 text-uppercase">{{trans('message.basic_setting_favicon_head_title')}}</h6>
                            <hr/>
                            <div class="card">
                              {{
                                      Form::open([
                                      'id'=>'FaviconUpdate',
                                      'class'=>'FromSubmit ',
                                       'url'=>route('admin.basic_setting.update_favicon'),
                                      'enctype' =>"multipart/form-data"
                                      ])
                                    }}
                                <div class="card-body">
                                  <div class="mb-3">
                                        <input class="form-control" onchange=loadFile(event) name="favicon" type="file">
                                    </div>
                                    
                                        {{-- <input id="image-uploadify" type="file"  multiple> --}}
   

                                </div>
                                 <div class="card-footer text-end">
                                  <button class="btn btn-primary" type="submit">Submit</button>
                                  <input class="btn btn-light" type="reset" value="Cancel">
                                </div>
                                    {{FOrm::close()}}

                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
@endsection
@section('javascript')
 <script>
                        var loadFile = function(event) {
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                            console.log(output.src);
                            output.onload = function() {
                                URL.revokeObjectURL(output.src) // free memory
                            }
                        };
                        </script>

@endsection
