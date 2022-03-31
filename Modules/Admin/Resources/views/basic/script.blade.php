@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.basic_setting_logo_head_title')}} @endif | {{trans('message.app_name')}}
@endsection
@section('style')
<style type="text/css">
     .form-check-input{
        width: 6.5em !important;
        height: 30px !important;
    }
</style>
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
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('message.script_setting_title')}}s</li>
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
                                        <h5 class="mb-0 text-primary">{{trans('message.update')}} {{trans('message.script')}}</h5>
                                    </div>
                                    <hr>
                                    {{ Form::model($script,
                                        array(
                                        'id'                => 'BasicInfo',
                                        'class'             => 'FromSubmit row g-3',
                                        'url'               => route('admin.basic_setting.update_script', $encryptedId),
                                        'method'            => 'PUT',
                                        'enctype'           =>"multipart/form-data"
                                        ))
                                      }}
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">{{trans('message.recaptcha_secret_key')}}</label>
                                            {{ Form::text('google_recaptcha_secret_key',null,['placeholder'=>trans('message.recaptcha_secret_key'),'id'=>'webtitle','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputLastName" class="form-label">{{trans('message.recaptcha_site_key')}}</label>
                                           {{ Form::text('google_recaptcha_site_key',null,['placeholder'=>trans('message.recaptcha_site_key'),'id'=>'webtitle','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputLastName" class="form-label">{{trans('message.recaptcha_enabled_disabled_label')}}</label>
                                            <div class="form-check form-switch">
                                               <input class="form-check-input" @if($script->is_recaptcha==1) checked @endif type="checkbox"  name="is_recaptcha"  id="flexSwitchCheckDefault">
                                           </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">{{trans('message.google_analytics_script')}}</label>
                                            {{ Form::textarea('google_analytics_script',null,['placeholder'=>trans('message.google_analytics_script'),'id'=>'webtitle','class'=>'form-control'])}}
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="inputLastName" class="form-label">{{trans('message.is_analytics_label')}}</label>
                                            <div class="form-check form-switch">
                                               <input class="form-check-input" @if($script->is_analytics==1) checked @endif type="checkbox" name="is_analytics" id="flexSwitchCheckDefault">
                                           </div>
                                        </div>

                                        <div class="card-title d-flex align-items-center ">
                                            <div>
                                            </div>
                                            <h5 class="mb-0 text-primary mt-4">{{trans('message.basic')}} {{trans('message.setting')}}</h5>
                                        </div>
                                        <hr>

                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">{{trans('message.default_sign_up_balance')}}</label>
                                            {{ Form::text('default_balance',null,['placeholder'=>trans('message.default_sign_up_balance'),'id'=>'webtitle','class'=>'form-control'])}}
                                        </div>
                                         <div class="col-md-12">
                                            <label for="inputLastName" class="form-label">{{trans('message.default_signup_disabled_label')}}</label>
                                            <div class="form-check form-switch">
                                               <input class="form-check-input" @if($script->is_default_balance==1) checked @endif type="checkbox"  name="is_default_balance"  id="flexSwitchCheckDefault">
                                           </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">{{trans('message.default_odd')}}</label>
                                            {{ Form::text('default_odd',null,['placeholder'=>trans('message.default_odd'),'id'=>'default_odd','class'=>'form-control'])}}
                                        </div>

                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.dashboard')}}" class="btn btn-secondary">Cancle</a>
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

  <script>
</script>
@endsection
