@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.basic_setting_logo_head_title')}} @endif | {{trans('message.app_name')}}
@endsection
@section('style')
<style type="text/css">
    
</style>
@endsection
@section('content')
  <div class="page-wrapper">
                <div class="page-content">
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">{{trans('message.admin')}} {{trans('message.profile')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('message.admin')}} {{trans('message.profile')}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--end breadcrumb-->
                    <div class="container">
                        <div class="main-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <img src="{{Auth::user()->getAdminUserImageUrl()}}" alt="Admin" class=" p-1 bg-primary" width="110">
                                                <div class="mt-3">
                                                    <h4>{{Auth::user()->name}}</h4>
                                                    <p class="text-secondary mb-1">@if(Auth::user()->admin_right !=null){{Auth::user()->admin_right->name}} @endif</p>
                                                    
                                                </div>
                                            </div>
                                            <hr class="my-4" />
                                             <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    Email::<h6 class="mb-0">{{\Auth::user()->email}}</h6>  
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    Username::<h6 class="mb-0"> {{\Auth::user()->name}}</h6>  
                                                </li>
                                                
                                                
                                                
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card">
                                         {{ Form::model(Auth::user(),
                                          array(
                                          'id'                => 'AddEditAdmin',
                                          'class'             => 'FromSubmit',
                                          'url'               => route('admin.admin_user.profile_update',Crypt::encrypt(Auth::user()->id)),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">{{trans('message.user_name_label')}}</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ Form::text('name',null,['placeholder'=>trans('message.name_placeholder'),'id'=>'name','class'=>'form-control'])}}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">{{trans('message.email_address_label')}}</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ Form::text('email',null,['placeholder'=>trans('message.email_placeholder'),'id'=>'email','class'=>'form-control'])}}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">{{trans('message.image_label')}}</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">   
                                                    <input class="form-control" onchange=loadFile(event) name="image" type="file">
                                                </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-xl-4  mx-auto">
                                              <div class="card">
                                                  <div class="card-body ">
                                                      
                                                        <img class="imagePreview" style="width: 180px; height: 180px;" id="output" src="{{Auth::user()->getAdminUserImageUrl()}}"/>
                                                  </div>
                                              </div>
                                          </div>
                                       </div>
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-10 text-secondary">
                                                    <button type="submit" class="btn btn-primary px-4" >{{trans('message.save_changes')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
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
