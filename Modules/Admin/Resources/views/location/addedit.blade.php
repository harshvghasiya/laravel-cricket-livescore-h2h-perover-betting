@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.location_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.location_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($location)) {{trans('message.edit_location_breadcrum')}} @else {{trans('message.add_location_breadcrum')}} @endif</li>
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
                                        <h5 class="mb-0 text-primary">@if(isset($location)) {{trans('message.edit')}} @else{{trans('message.add')}} @endif {{trans('message.location')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($location))
                                        {{ Form::model($location,
                                          array(
                                          'id'                => 'AddEditLocation',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.location.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditLocation',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.location.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif
                                        <div class="col-md-8">
                                            <label for="inputlocation" class="form-label">{{trans('message.contact_label')}}</label> <span class="text-danger">*</span>
                                            {{-- @if(isset($location))
                                            {{ Form::select('contact_id',\App\Models\Contact::getContactDropDown(),$location->state_name->country_id,['placeholder'=>trans('message.select_country_label'),'id'=>'inputlocation',"class"=>"form-select select2contact contact"])
                                            }}
                                            @else --}}
                                            {{ Form::select('contact_id',\App\Models\Contact::getContactDropDown(),null,['placeholder'=>trans('message.select_contact_label'),'id'=>'inputlocation',"class"=>"form-select select2contact contact"])
                                            }}

                                            {{-- @endif --}}
                                        </div>
                                       
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.location_name_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('name',null,['placeholder'=>trans('message.name_placeholder'),'id'=>'name','class'=>'form-control'])}}
                                        </div>

                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.location_address_1_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::textarea('address_1',null,['placeholder'=>trans('message.address_placeholder'),'rows'=>'4','id'=>'address','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.location_address_2_label')}}</label>
                                            {{ Form::textarea('address_2',null,['placeholder'=>trans('message.address_placeholder'),'rows'=>'4','id'=>'address','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.notes')}}</label>
                                            {{ Form::textarea('notes',null,['placeholder'=>trans('message.notes'),'id'=>'address','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.pin_code_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('pin_code',null,['placeholder'=>trans('message.pin_code_placeholder'),'id'=>'pin_code','class'=>'pin_code form-control'])}}
                                        </div>

                                        <div class="col-md-8">
                                            <label for="cou" class="form-label">{{trans('message.country_label')}}</label> <span class="text-danger">*</span>
                                            {{-- @if(isset($location))
                                            {{ Form::select('country_id',\App\Models\Country::getCountryDropDown(),$location->state_name->country_id,['placeholder'=>trans('message.select_country_label'),'id'=>'cou',"class"=>"form-select select2country country"])
                                            }}
                                            @else --}}
                                            {{ Form::select('country_id',\App\Models\Country::getCountryDropDown(),null,['placeholder'=>trans('message.select_country_label'),'id'=>'cou',"class"=>"form-select select2country country"])
                                            }}

                                            {{-- @endif --}}
                                        </div>

                                        <div class="col-md-8">
                                            <label for="sta" class="form-label">{{trans('message.state_label')}}</label> <span class="text-danger">*</span>
                                            {{-- @if(isset($location))
                                            {{ Form::select('state_id',\App\Models\State::allStateDropDown(),$location->state_name->country_id,['placeholder'=>trans('message.select_state_label'),'id'=>'sta',"class"=>"form-select select2state state"])
                                            }}
                                            @else --}}
                                            {{ Form::select('state_id',\App\Models\State::allStateDropDown(),null,['placeholder'=>trans('message.select_state_label'),'id'=>'sta',"class"=>"form-select select2state state"])
                                            }}

                                            {{-- @endif --}}
                                        </div>

                                        <div class="col-md-8">
                                            <label for="cit" class="form-label">{{trans('message.city_label')}}</label> <span class="text-danger">*</span>
                                           {{--  @if(isset($location))
                                            {{ Form::select('city_id',\App\Models\City::getCityDropDown(),$location->state_name->country_id,['placeholder'=>trans('message.select_country_label'),'id'=>'cit',"class"=>"form-select select2city city"])
                                            }}
                                            @else --}}
                                            {{ Form::select('city_id',\App\Models\City::getCityDropDown(),null,['placeholder'=>trans('message.select_city_label'),'id'=>'cit',"class"=>"form-select select2city city"])
                                            }}

                                            {{-- @endif --}}
                                        </div>
                                        <div class="col-md-8 form-check">
                                            {{ Form::checkbox('is_main_location',1,null,['id'=>'is_main_location','class'=>'form-check-input'])}}
                                            <label for="is_main_location" class="form-check-label">{{trans('message.is_main_location')}}</label>  <span class="text-danger">( Only One Main Location Can Add, Your Main Location Will Be Replaced )</span>
                                        </div>

                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="status" id="inlineRadio1" value="1" {{ isset($location)?($location->status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" {{ isset($location)?($location->status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                       
                                        
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.location.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
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
   
  </script>

    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/select2/js/select2.min.js"></script>
  <script type="text/javascript">
    $('.select2contact').select2({
      theme: 'bootstrap4',
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.select2country').select2({
      theme: 'bootstrap4',
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.select2state').select2({
      theme: 'bootstrap4',
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.select2city').select2({
      theme: 'bootstrap4',
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });

    $(document).ready(function() {
      $('.pin_code').keyup(function(event) {
          var pin_code=$(this).val();

          $.ajax({
            url: '{{route('admin.location.auto_complete')}}',
            type: 'post',
            
            data: {pin_code: pin_code},
            success:function(response) {
              if (response.country_name != null) {
                $('.country').change().val(response.country_name);
              }
              if (response.city_name != null) {
                $('.city').change().val(response.city_name);
              }
              if (response.state_name != null) {
                $('.state').change().val(response.state_name);
              }
            }
          });
          
      });
    });
  </script>
@endsection
