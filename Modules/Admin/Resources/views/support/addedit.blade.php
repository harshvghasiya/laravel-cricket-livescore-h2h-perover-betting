@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.support_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.support_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($support)) {{trans('message.edit_support_breadcrum')}} @else {{trans('message.add_support_breadcrum')}} @endif</li>
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
                                        <h5 class="mb-0 text-primary">@if(isset($support)) {{trans('message.edit')}} @else{{trans('message.send')}} @endif {{trans('message.query')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($support))
                                        {{ Form::model($support,
                                          array(
                                          'id'                => 'AddEditCompanysupport',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.support.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditCompanysupport',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.support.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif
                                        
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.name_label')}}</label>
                                            {{ Form::text('name',null,['placeholder'=>trans('message.name_placeholder'),'id'=>'name','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="email" class="form-label">{{trans('message.email_label')}}</label>
                                            {{ Form::text('email',null,['placeholder'=>trans('message.email_placeholder'),'id'=>'email','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="mobile" class="form-label">{{trans('message.mobile_label')}}</label>
                                            {{ Form::text('mobile',null,['placeholder'=>trans('message.mobile_placeholder'),'id'=>'mobile','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="subject" class="form-label">{{trans('message.subject_label')}}</label>
                                            {{ Form::text('subject',null,['placeholder'=>trans('message.subject_placeholder'),'id'=>'subject','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">{{trans('message.description_label')}}</label>
                                            {{ Form::textarea('description',null,['placeholder'=>trans('message.description_placeholder'),'id'=>'description','class'=>'form-control editor-tinymce'])}}
                                        </div>
                                        
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.support.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
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
