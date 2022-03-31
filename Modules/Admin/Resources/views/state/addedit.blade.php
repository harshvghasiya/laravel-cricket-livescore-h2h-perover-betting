@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.state_title')}} @endif | {{trans('message.app_name')}}
@endsection
@section('style')
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
<style type="text/css">
    
</style>
@endsection
@section('content')

<div class="page-wrapper">
                <div class="page-content">
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">{{trans('message.state_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($state)) {{trans('message.edit_state_breadcrum')}} @else {{trans('message.add_state_breadcrum')}} @endif</li>
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
                                        <h5 class="mb-0 text-primary">@if(isset($state)) {{trans('message.edit')}} @else{{trans('message.add')}} @endif {{trans('message.state')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($state))
                                        {{ Form::model($state,
                                          array(
                                          'id'                => 'AddEditCompanyCategory',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.state.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditCompanyCategory',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.state.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif
                                        <div class="col-md-8">
                                            <label for="inputState" class="form-label">{{trans('message.country_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::select('country_id',\App\Models\Country::getCountryDropDown(),null,['placeholder'=>trans('message.select_country_label'),'id'=>'inputState',"class"=>"form-select select2"])
                                            }}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.state_name_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('name',null,['placeholder'=>trans('message.name_placeholder'),'id'=>'name','class'=>'form-control'])}}
                                        </div>

                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.state_code_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('code',null,['placeholder'=>trans('message.code_placeholder'),'id'=>'code','class'=>'form-control'])}}
                                        </div>

                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="status" id="inlineRadio1" value="1" {{ isset($state)?($state->status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" {{ isset($state)?($state->status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                       
                                        
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.state.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
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
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/select2/js/select2.min.js"></script>
  <script type="text/javascript">
    $('.select2').select2({
      theme: 'bootstrap4',
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  </script>
@endsection
