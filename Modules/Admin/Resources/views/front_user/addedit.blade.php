@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.front_user_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.front_user_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($front_user)) {{trans('message.edit_front_user_breadcrum')}} @else {{trans('message.add_front_user_breadcrum')}} @endif</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--end breadcrumb-->
                    <div class="row">
                        <div class="col-xl-11 mx-auto">
                            <hr/>
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div>
                                        </div>
                                        <h5 class="mb-0 text-primary">@if(isset($front_user)) {{trans('message.edit')}} @else{{trans('message.add')}} @endif {{trans('message.front_user')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($front_user))
                                        {{ Form::model($front_user,
                                          array(
                                          'id'                => 'AddEditfront_user',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.front_user.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditfront_user',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.front_user.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif

                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.front_user_name_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('name',null,['placeholder'=>trans('message.name_placeholder'),'id'=>'name','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.email_label')}}</label> 
                                            {{ Form::text('email',null,['placeholder'=>trans('message.email_placeholder'),'id'=>'email','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="code" class="form-label">{{trans('message.balance_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('balance',null,['placeholder'=>trans('message.balance_placeholder'),'id'=>'balance','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="code" class="form-label">{{trans('message.mobile_label')}}</label> 
                                            {{ Form::text('mobile',null,['placeholder'=>trans('message.mobile_placeholder'),'id'=>'mobile','class'=>'form-control'])}}
                                        </div>
                                         @if(!isset($front_user))
                                        <div class="col-md-8">
                                            <label for="password" class="form-label">{{trans('message.password_label')}}</label> <span class="text-danger">*</span>
                                           {{ Form::text('password',null,['placeholder'=>trans('message.password_placeholder'),'id'=>'password','class'=>'form-control'])}}
                                        </div>
                                        @endif
                                        <div class="col-md-8">
                                            <label for="code" class="form-label">{{trans('message.promo_code_label')}}</label> 
                                            {{ Form::text('promo_code',null,['placeholder'=>trans('message.promo_code_placeholder'),'id'=>'promo_code','class'=>'form-control'])}}
                                        </div>
                                         @if(isset($front_user))
                                        <div class="form-check">
                                                  {{ Form::checkbox('change_password',1,null,["class"=>"change_password form-check-input",'id'=>"flexCheckDefault"]) }}
                                                  <label class="form-check-label" for="flexCheckDefault">{{trans('message.change_password')}}</label>
                                        </div>
                                        <div class="col-md-8" style="display: none;" id="show_hide_password">
                                            <label for="password" class="form-label">{{trans('message.password_label')}}</label>
                                           {{ Form::password('password',['placeholder'=>trans('message.password_placeholder'),'id'=>'password','class'=>'form-control'])}}
                                        </div>
                                        @endif
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="status" id="inlineRadio1" value="1" {{ isset($front_user)?($front_user->status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" {{ isset($front_user)?($front_user->status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                       
                                        
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.front_user.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
                                        </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                            <hr/>
                            
                        </div>
                    </div>
                   
                </div>
            </div>
@endsection
@section('javascript')
 <script type="text/javascript">
        $(document).on("click",".change_password",function(){

          if ($(".change_password").prop("checked")) {

             $("#show_hide_password").show();

          }else{

            $("#show_hide_password").hide();

          }
    });
      </script>
@endsection
