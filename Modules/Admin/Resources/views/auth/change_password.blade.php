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
                        <div class="breadcrumb-title pe-3">{{trans('message.admin')}} {{trans('message.change_password')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('message.admin')}} {{trans('message.change_password')}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--end breadcrumb-->
                    <div class="container">
                        <div class="main-body">
                            <div class="row">
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-8 mt-3">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{
                                              Form::open([
                                              'id'=>'AddEditpassword',
                                              'class'=>'FromSubmit',
                                              'url'=>route('admin.admin_user.password_update',Crypt::encrypt(Auth::user()->id)),
                                              'name'=>'updatePass',
                                              'enctype' =>"multipart/form-data"
                                              ])
                                            }}
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="d-flex align-items-center mb-3">{{trans('message.change_password')}}</h5>
                                                    <div class="row mb-3">
                                                         <label for="inputState" class="form-label">{{trans('message.current_password')}}</label>
                                                        <div class="col-sm-9 text-secondary">
                                                            {{ Form::text('current_password',null,['placeholder'=>trans('message.current_placeholder'),'id'=>'password','class'=>'form-control'])}}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                         <label for="inputState" class="form-label">{{trans('message.new_password_label')}}</label>
                                                        <div class="col-sm-9 text-secondary">
                                                            {{ Form::text('password',null,['placeholder'=>trans('message.change_password_placeholder'),'id'=>'password','class'=>'form-control'])}}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                         <label for="inputState" class="form-label">{{trans('message.confirm_new_password_label')}}</label>
                                                        <div class="col-sm-9 text-secondary">
                                                            {{ Form::text('password_confirmation',null,['placeholder'=>trans('message.confirm_new_password_label'),'id'=>'password','class'=>'form-control'])}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-10 text-secondary">
                                                            <button type="submit" class="btn btn-primary px-4" style="color: white;" >{{trans('message.update_password')}}</button>
                                                        </div>
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
