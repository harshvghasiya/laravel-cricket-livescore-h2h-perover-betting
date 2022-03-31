@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.contact_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.contact_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($contact)) {{trans('message.edit_contact_breadcrum')}} @else {{trans('message.add_contact_breadcrum')}} @endif</li>
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
                                        <h5 class="mb-0 text-primary">@if(isset($contact)) {{trans('message.edit')}} @else{{trans('message.add')}} @endif {{trans('message.contact')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($contact))
                                        {{ Form::model($contact,
                                          array(
                                          'id'                => 'AddEditCompanycontact',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.contact.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditCompanycontact',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.contact.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif

                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.contact_name_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('full_name',null,['placeholder'=>trans('message.name_placeholder'),'id'=>'name','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.phone_nulmber_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('phone_number',null,['placeholder'=>trans('message.phone_number'),'id'=>'name','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.second_phone_number')}}</label> 
                                            {{ Form::text('phone_number_2',null,['placeholder'=>trans('message.enter_phone'),'id'=>'phone_number_2','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.email_address')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('email_address',null,['placeholder'=>trans('message.email_address'),'id'=>'email_address','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.notes')}}</label> 
                                            {{ Form::textarea('notes',null,['placeholder'=>trans('message.notes'),'id'=>'notes','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8 form-check">
                                            {{ Form::checkbox('is_main_contact',1,null,['id'=>'is_main_contact','class'=>'form-check-input'])}}
                                            <label for="is_main_contact" class="form-check-label">{{trans('message.is_main_contact')}}</label>  <span class="text-danger">( Only One Main Contact Can Add, Your Main Contact Will Be Replaced )</span>
                                        </div>
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="status" id="inlineRadio1" value="1" {{ isset($contact)?($contact->status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" {{ isset($contact)?($contact->status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                       
                                        
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.contact.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
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
