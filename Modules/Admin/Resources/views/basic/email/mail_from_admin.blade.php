@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.mail_config_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.basic_setting_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($mail_config)) {{trans('message.mail_config_managment')}} @else {{trans('message.add_mail_config_breadcrum')}} @endif</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--end breadcrumb-->
                    <div class="row">
                        <div class="col-xl-6 mx-auto">
                            <hr/>
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div>
                                        </div>
                                        <h5 class="mb-0 text-primary">{{trans('message.mail_config')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($mail_config))
                                        {{ Form::model($mail_config,
                                          array(
                                          'id'                => 'AddEditUpdateMail',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.basic_setting.mail_config_update',$encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @endif

                                        <div class="col-md-8">
                                            <label for="from_mail" class="form-label">{{trans('message.from_mail_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('from_mail',null,['placeholder'=>trans('message.from_mail_placeholder'),'id'=>'from_mail','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="smtp_host" class="form-label">{{trans('message.smtp_host_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('smtp_host',null,['placeholder'=>trans('message.smtp_host_placeholder'),'id'=>'smtp_host','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="smtp_port" class="form-label">{{trans('message.smtp_port_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('smtp_port',null,['placeholder'=>trans('message.smtp_port_placeholder'),'id'=>'smtp_port','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="encryption" class="form-label">{{trans('message.encryption_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('encryption',null,['placeholder'=>trans('message.encryption_placeholder'),'id'=>'encryption','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="smtp_username" class="form-label">{{trans('message.smtp_username_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('smtp_username',null,['placeholder'=>trans('message.smtp_username_placeholder'),'id'=>'smtp_username ','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="smtp_password" class="form-label">{{trans('message.smtp_password_label')}}</label> <span class="text-danger">*</span>
                                            
                                            <input class="form-control" placeholder="{{trans('message.smtp_password_placeholder')}}" id="smtp_password" type="password" name="smtp_password" value="{{\Crypt::encryptString($mail_config->smtp_password)}}">

                                        </div>
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="smtp_status" id="inlineRadio1" value="1" {{ isset($mail_config)?($mail_config->smtp_status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="smtp_status" id="inlineRadio1" value="0" {{ isset($mail_config)?($mail_config->smtp_status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                       
                                        
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.basic_setting.mail_config')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
                                        </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                            <hr/>
                            
                        </div>
                        <div class="col-xl-6 mx-auto">
                            <hr/>
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div>
                                        </div>
                                        <h5 class="mb-0 text-primary">{{trans('message.send_mail')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($mail_config))
                                        {{ Form::model($mail_config,
                                          array(
                                          'id'                => 'AddEditSendMail',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.basic_setting.mail_config_send_mail',$encryptedId),
                                          'method'            => 'POST',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @endif

                                        <div class="col-md-8">
                                            <label for="to_mail" class="form-label">{{trans('message.to_mail_label')}}</label>
                                            {{ Form::text('to_mail',null,['placeholder'=>trans('message.to_mail_placeholder'),'id'=>'to_mail','class'=>'form-control'])}}
                                            <p>For Send Test Mail, Enter Email Here</p>
                                        </div>
                                        
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.send_mail')}}</button>
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

@endsection
