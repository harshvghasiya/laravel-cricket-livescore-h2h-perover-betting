@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.activity_title')}} @endif | {{trans('message.app_name')}}
@endsection
@section('style')
<style type="text/css">
    
</style>
 <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
  <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
  <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

@endsection
@section('content')

<div class="page-wrapper">
                <div class="page-content">
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">{{trans('message.activity_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($activity)) {{trans('message.edit_activity_breadcrum')}} @else {{trans('message.add_activity_breadcrum')}} @endif</li>
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
                                        <h5 class="mb-0 text-primary">@if(isset($activity)) {{trans('message.edit')}} @else{{trans('message.add')}} @endif {{trans('message.activity')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($activity))
                                        {{ Form::model($activity,
                                          array(
                                          'id'                => 'AddEditCompanyactivity',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.activity.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditCompanyactivity',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.activity.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif
                                      <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.activity_name')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('name',null,['placeholder'=>trans('message.name'),'id'=>'name','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="inputsubject" class="form-label">{{trans('message.activity_subject_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::select('activity_subject_id',\App\Models\ActivitySubject::getActivitySubjectDropDown(),null,['placeholder'=>trans('message.select_activity_subject_label'),'id'=>'inputsubject',"class"=>"form-select select2activity"])
                                            }}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="inputState" class="form-label">{{trans('message.location_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::select('location_id',\App\Models\Location::getLocationDropDown(),null,['placeholder'=>trans('message.select_location_label'),'id'=>'inputState',"class"=>"form-select select2"])
                                            }}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="inputStaff" class="form-label">{{trans('message.staff_member_lable')}}</label>
                                            {{ Form::select('staff_member_user_id',\App\Models\User::getStaffDropDown(),null,['placeholder'=>trans('message.select_staff_member'),'id'=>'inputStaff',"class"=>"form-select select2staff"])
                                            }}
                                        </div>
                                        
                                        <div class="col-md-8">
                                            <label for="start_date" class="form-label">{{trans('message.start_datetime')}}</label> <span class="text-danger">*</span>
                                           <div class='input-group date'  id="dt-minimum" data-target-input="nearest">
                                                 
                                                 {{ Form::text('start_datetime',null,['placeholder'=>trans('message.start_date_placeholder'),'id'=>'start-time','class'=>' result form-control']) }}
                                              </div>
                                        </div>

                                        <div class="col-md-8">
                                            <label for="end_date" class="form-label">{{trans('message.end_datetime')}}</label> <span class="text-danger">*</span> 
                                              {{ Form::text('end_datetime',null,['placeholder'=>trans('message.end_date_placeholder'),'id'=>'end-time','class'=>' result form-control']) }}
                                        </div>
                                        

                                         <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.notes')}}</label> 
                                            {{ Form::textarea('notes',null,['placeholder'=>trans('message.notes'),'id'=>'name','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="status" id="inlineRadio1" value="1" {{ isset($activity)?($activity->status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" {{ isset($activity)?($activity->status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                       
                                        
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.activity.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
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
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/js/legacy.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/js/picker.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/js/picker.time.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/js/picker.date.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>

  <script type="text/javascript">
    $('.select2').select2({
      theme: 'bootstrap4',
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.select2staff').select2({
      theme: 'bootstrap4',
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.select2activity').select2({
      theme: 'bootstrap4',
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });

     
  </script>
  <script>
    $('.datepicker').pickadate({
      selectMonths: true,
          selectYears: true
    }),
    $('.timepicker').pickatime()
  </script>
  <script>
    $(function () {
      $('#start-time').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm'
      });
       $('#end-time').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm'
      });
      $('#date').bootstrapMaterialDatePicker({
        time: false
      });
      $('#time').bootstrapMaterialDatePicker({
        date: false,
        format: 'HH:mm'
      });
    });
  </script>

@endsection
