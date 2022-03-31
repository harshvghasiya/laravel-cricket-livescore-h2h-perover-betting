@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.basic_setting_basicinfo_head_title')}} @endif | {{trans('message.app_name')}}
@endsection
@section('style')
<style type="text/css">
  /*.col-form-label{
    color: white ! important;
  }*/
</style>
@endsection
@section('content')
<div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>{{trans('message.basic_setting_basicinfo_head_title')}}</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">{{trans('message.base_setting_basicinfo_breadcrum')}}</li>
                  </ol>
                </div>
                <div class="col-sm-6">
                  <!-- Bookmark Start-->
                  <!-- Bookmark Ends-->
                </div>
              </div>
            </div>
          </div> 
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 ">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5>{{trans('message.basic_setting_basicinfo_head_title')}}</h5>
                      </div>
                      <div class="card-body">
                        {{-- <form class="theme-form mega-form"> --}}
                          @if(isset($currency))
                            {{ Form::model($currency,
                              array(
                              'id'                => 'AddEditCurrency',
                              'class'             => 'FromSubmit theme-form mega-form',
                              'url'               => route('admin.currency.update', $encryptedId),
                              'method'            => 'PUT',
                              'enctype'           =>"multipart/form-data"
                              ))
                            }}
                          @else
                            {{
                              Form::open([
                              'id'=>'AddEditCurrency',
                              'class'=>'FromSubmit theme-form mega-form',
                              'url'=>route('admin.currency.store'),
                              'name'=>'socialMedia',
                              'enctype' =>"multipart/form-data"
                              ])
                            }}
                          @endif
                          <div class="mb-3">
                            <label class="col-form-label">{{trans('message.currency_name_label')}}</label>
                            {{ Form::text('name',null,['placeholder'=>trans('message.currency_name'),'id'=>'e','class'=>'form-control'])}}
                          </div>
                          <div class="mb-3">
                            <label class="col-form-label">{{trans('message.currency_code_label')}}</label>
                            {{ Form::text('code',null,['placeholder'=>trans('message.currency_code'),'id'=>'ne','class'=>'form-control'])}}
                          </div>
                          <div class="col-sm-12">
                              {{-- <h5>Inline checkbox</h5> --}}
                            <label class="col-form-label">{{trans('message.status_label')}}</label>

                          </div>
                          <div class="col mb-3">
                            <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                              <div class="radio radio-primary">
                                <input id="radioinline1" type="radio" name="status" value="1" checked>
                                <label class="mb-0" for="radioinline1">{{trans('message.active')}}</label>
                              </div>
                              <div class="radio radio-primary">
                                <input id="radioinline2" type="radio" name="status" value="0">
                                <label class="mb-0" for="radioinline2">{{trans('message.inactive')}}</label>
                              </div>
                            </div>
                          </div>
                         
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{trans('message.submit')}}</button>
                        <a href="{{route('admin.currency.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
                      </div>
                      {{Form::close()}}

                      </div>
                      
                    </div>
                  
               
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
@endsection
@section('javascript')

