@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.company_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.company_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($company)) {{trans('message.edit_company_breadcrum')}} @else {{trans('message.add_company_breadcrum')}} @endif</li>
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
                                        <h5 class="mb-0 text-primary">@if(isset($company)) {{trans('message.edit')}} @else{{trans('message.add')}} @endif {{trans('message.company')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($company))
                                        {{ Form::model($company,
                                          array(
                                          'id'                => 'AddEditCompanycompany',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.company.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditCompanycompany',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.company.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif

                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.company_name_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('name',null,['placeholder'=>trans('message.name_placeholder'),'id'=>'name','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="notes" class="form-label">{{trans('message.company_notes_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::textarea('notes',null,['placeholder'=>trans('message.notes_placeholder'),'id'=>'notes','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="status" id="inlineRadio1" value="1" {{ isset($company)?($company->status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" {{ isset($company)?($company->status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                         @php
                                          $selectedData = array();
                                            if(isset($company) && $company->company_activity != null)
                                            {
                                              foreach($company->company_activity as $v)
                                              {
                                                $selectedData[] = $v->activity_id;
                                              }
                                            }
                                          @endphp
                                        <div class="col-md-8">
                                            <label for="activity" class="form-label">{{trans('message.company_activity_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::select('activity_id[]',\App\Models\Activity::getActivityDropDown(),$selectedData,['id'=>'activity',"class"=>"form-select select2activity" , 'multiple'=>'multiple'])
                                            }}
                                        </div>

                                         <div class="col-md-8">
                                            <label for="inputState" class="form-label">{{trans('message.company_category_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::select('company_category_id',\App\Models\CompanyCategory::CompanyCategoryDropDown(),null,['placeholder'=>trans('message.select_company_category_label'),'id'=>'inputState',"class"=>"form-select select2"])
                                            }}
                                        </div>
                                        @php
                                          $selectedData = array();
                                            if(isset($company) && $company->company_location != null)
                                            {
                                              foreach($company->company_location as $v)
                                              {
                                                $selectedData[] = $v->location_id;
                                              }
                                            }
                                          @endphp
                                        <div class="col-md-8">
                                            <label for="inputLocation" class="form-label">{{trans('message.location_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::select('location_id[]',\App\Models\Location::getLocationDropDown(),$selectedData,['id'=>'inputLocation',"class"=>"form-select select2location",'multiple'=>"multiple"])
                                            }}
                                        </div>
                                        @php
                                          $selectedData = array();
                                            if(isset($company) && $company->company_contact != null)
                                            {
                                              foreach($company->company_contact as $v)
                                              {
                                                $selectedData[] = $v->contact_id;
                                              }
                                            }
                                          @endphp
                                        <div class="col-md-8">
                                            <label for="inputContact" class="form-label">{{trans('message.contact_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::select('contact_id[]',\App\Models\Contact::getContactDropDown(),$selectedData,['id'=>'inputContact',"class"=>"form-select select2contact",'multiple'=>"multiple"])
                                            }}
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.company.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
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
  <script type="text/javascript">
    $('.select2location').select2({
      theme: 'bootstrap4',
      multiple:true,
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
     
    });
  </script>
  <script type="text/javascript">
    $('.select2contact').select2({
      theme: 'bootstrap4',
      multiple:true,
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
     
    });
  </script>
  <script type="text/javascript">
    $('.select2activity').select2({
      theme: 'bootstrap4',
      multiple:true,
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
     
    });
  </script>

@endsection
