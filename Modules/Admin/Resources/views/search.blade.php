@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "")  {{$title}} |  @endif  {{trans('message.app_name')}}
@endsection
@section('style')

    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

@endsection
@section('content')
<div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">{{trans('message.search_result')}} </div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@if(isset($search_val) && $search_val !=null) {{$search_val}} @else - @endif</li>
                            </ol>
                        </nav>
                    </div>
                    
                </div>
                <!--end breadcrumb-->
                @if($activity != null)
                <div class="card">
                    <div class="card-body">
                        <div class="row m-2">
                            <div class="col-md-6">
                                <h3 class="text-dark"> Search Result - {{trans('message.activity')}}</h3>
                            </div>
                        </div>
                        <div class="table-responsive">
                             {{ Form::open([
                                  'id'=>'table_form',
                                  'class'=>'table_form',
                                  'name'=> 'form_data'
                                ])
                              }}
                            <table id="activity-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>{{trans('message.name')}}</th>
                                        <th>{{trans('message.action')}}</th>
                                    </tr>
                                </thead>
                            </table>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
@endsection
@section('javascript')
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script>
  var oTable = $('#activity-table').DataTable({
      processing: true,
      serverSide: true,
      searching:false,
      responsive: true,
      ajax: {
            url:'{!! route('admin.search.any_data',\App\Models\Activity::Model) !!}',
          },
      columns: [
          { data: 'name'},
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
                url:"{{route('admin.company_category.single_status_change')}}",
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
  
@endsection
