@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "")  {{$title}} |  @endif  {{trans('message.app_name')}}
@endsection
@section('style')

    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
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
                    <div class="breadcrumb-title pe-3">{{trans('message.activity_managment')}} </div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{trans('message.index_activity_breadcrum')}}</li>
                            </ol>
                        </nav>
                    </div>
                    
                </div>
                <!--end breadcrumb-->
                <div class="card">
                    
                    <div class="card-body">
                        <div class="card-title">
                          <h4 class="panel-title"><i class="fadeIn animated bx bx-search-alt"></i> {{trans('message.custome_filter')}}</h4>
                        </div>    
                        <div class="card-body">
                            <form method="POST" id="search-form" class="form-inline" role="form">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-3">
                                         <div class='input-group date'  id="dt-minimum" data-target-input="nearest">
                                                 
                                                 {{ Form::text('start_datetime',null,['placeholder'=>trans('message.start_date_placeholder'),'id'=>'start-time','class'=>' result form-control']) }}
                                              </div>
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::text('end_datetime',null,['placeholder'=>trans('message.end_date_placeholder'),'id'=>'end-time','class'=>' result form-control']) }}
                                    </div>
                                    <div class="col-md-3">
                                        <select name="activity_subject" id="activity_subject" class="form-control activity_subject">
                                            <option value="">Select Activity Subject</option>

                                            @foreach(\App\Models\ActivitySubject::getActivitySubjectDropDown() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                     <div class="col-md-3">
                                         <button type="button" class="btn btn-primary search_text">{{trans('message.search_label')}}</button>
                                         <a href="javascript:void(0);" onclick="RESET_FORM();" class="btn btn-danger  btn-flat" id="reset_data_table">{{trans('message.reset_label')}}</a>
                                    </div>
                                    
                                </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row m-4">
                            <div class="col-md-6">
                              <div class="btn-group ">
                                <a href="{{route('admin.activity.create')}}" id="sample_editable_1_new" class="btn btn-primary">
                                {{trans('message.add_new')}} 
                                </a>
                              </div>
                              
                                <div class="btn-group d-none">
                                  <a class="btn btn-danger" onclick="deleteAll('table_form','{{route('admin.activity.delete_all')}}')">{{trans('message.delete_all_label')}}
                                  </a>
                                </div>
                            
                              <div class="btn-group d-none">
                                <a class="btn btn-warning" style="color: white;" onclick="statusAll('table_form','{{route('admin.activity.status_all')}}')">{{trans('message.status_all_label')}}
                                </a>
                              </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                             {{ Form::open([
                                  'id'=>'table_form',
                                  'class'=>'table_form',
                                  'name'=> 'form_data'
                                ])
                              }}
                            <table id="users-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="checkbox[]"  value="1" id="select_all" /></th>
                                        <th>{{trans('message.activity_name')}}</th>
                                        <th>{{trans('message.activity_subject')}}</th>
                                        <th>{{trans('message.location')}}</th>
                                        {{-- <th>{{trans('message.staff_member_lable')}}</th> --}}
                                        <th>{{trans('message.date')}}</th>
                                        <th>{{trans('message.duration')}}</th>
                                        <th>{{trans('message.status')}}</th>
                                        <th>{{trans('message.action')}}</th>
                                    </tr>
                                </thead>
                            </table>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
@endsection
@section('javascript')
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/js/legacy.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/js/picker.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/js/picker.time.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datetimepicker/js/picker.date.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>

    <script>
  var oTable = $('#users-table').DataTable({
      processing: true,
      serverSide: true,
      searching:false,
      responsive: true,
      ajax: {
            url:'{!! route('admin.activity.any_data') !!}',
            data: function (d) {
                d.start_date = $('input[name=start_datetime]').val();
                d.activity_subject = $('#activity_subject').val();
                d.end_date = $('input[name=end_datetime]').val();
              }
          },
      columns: [
          { data: 'id',orderable: false,searchable: false},
          { data: 'name'},
          { data: 'activity_subject'},
          { data: 'location'},
          // { data: 'staff_member'},
          { data: 'start_date'},
          { data: 'duration'},
          { data: 'status'},
          { data: 'action',name:'action', orderable: false, searchable: false}
      ]
  });
  
  $(document).on("click",".search_text",function(){
      oTable.draw();
      return false;
  });

  function RESET_FORM(){

    $("#search-form").trigger('reset'); 
        oTable.draw();
        return false;
  }
  $(document).ready(function(){
      
    $(document).on("click","#active_inactive",function(){
        
      swal({
        title: "{{trans('message.are_you_sure_want_change_status_label')}}",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
              var status = $(this).attr('status');
              var id = $(this).attr('data-id');
              var cur =$(this);
              $.ajax({
                type:"POST",
                url:"{{route('admin.activity.single_status_change')}}",
                data:{"status":status,"id":id,"_token": "{{ csrf_token() }}"},
                success:function(data){
                         if (data.status == 0) {
                            cur.removeClass('btn-success');
                            cur.addClass('btn-danger');
                            cur.text('{{trans('message.inactive_label')}}');
                         }else{
                            cur.removeClass('btn-danger');
                            cur.addClass('btn-success');
                            cur.text('{{trans('message.active_label')}}');
                         }
                  }
              })
          swal("{{trans('message.status_has_been_successfully_changed_label')}}", {
                      icon: "success",
          });
        } 
      });
    })
  });

  
</script>
  <script type="text/javascript">
    $('.activity_subject').select2({
      theme: 'bootstrap4',
      multiple:true,
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
     
    });
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
