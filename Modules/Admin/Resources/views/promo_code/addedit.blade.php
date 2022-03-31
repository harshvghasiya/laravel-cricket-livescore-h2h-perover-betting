@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.promo_code_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.promo_code_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($promo_code)) {{trans('message.edit_promo_code_breadcrum')}} @else {{trans('message.add_promo_code_breadcrum')}} @endif</li>
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
                                        <h5 class="mb-0 text-primary">@if(isset($promo_code)) {{trans('message.edit')}} @else{{trans('message.add')}} @endif {{trans('message.promo_code')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($promo_code))
                                        {{ Form::model($promo_code,
                                          array(
                                          'id'                => 'AddEditpromo_code',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.promo_code.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditpromo_code',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.promo_code.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif

                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.promo_code_name_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('name',null,['placeholder'=>trans('message.name_placeholder'),'id'=>'name','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="balance" class="form-label">{{trans('message.promo_code_balance_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('balance',null,['placeholder'=>trans('message.balance_placeholder'),'id'=>'balance','class'=>'form-control'])}}
                                        </div>
                                        
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="status" id="inlineRadio1" value="1" {{ isset($promo_code)?($promo_code->status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" {{ isset($promo_code)?($promo_code->status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                       
                                        
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.promo_code.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
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
