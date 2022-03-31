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
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($front_user)) {{trans('message.edit_front_user_breadcrum')}} @else {{trans('message.add_balance_front_user_breadcrum')}} @endif</li>
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
                                          'url'               => route('admin.front_user.balance_update', $encryptedId),
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
                                            <label for="code" class="form-label">{{trans('message.balance_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('balance',null,['placeholder'=>trans('message.balance_placeholder'),'id'=>'balance','class'=>'form-control'])}}
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

@endsection
