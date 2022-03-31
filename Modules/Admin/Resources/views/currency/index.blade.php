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
                  <h3>{{trans('message.manage')}} {{trans('message.currency')}}</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{trans('message.home')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('message.currency')}}</li>
                  </ol>
                </div>
                <div class="col-sm-6">
                </div>
              </div>
            </div>
  </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <div class="mt-3">
                      <a href="{{route('admin.currency.create')}}" class="btn btn-primary"> <i class="icofont icofont-ui-add"></i> &nbsp;{{trans('message.add')}} {{trans('message.currency')}}  </a>
                      <button class="btn btn-danger"><i class="icofont icofont-ui-delete"></i> &nbsp; {{trans('message.delete_all')}}</button>
                      <button class="btn btn-warning"><i class="icofont icofont-ui-laoding"></i> &nbsp;{{trans('message.status_all')}}</button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display datatables" id="dt-method">
                        <thead>
                          <tr>
                            <th><div class="checkbox">
                            <input id="select_all" type="checkbox">
                            <label for="select_all"></label>
                          </div></th>
                            <th>{{trans('message.name')}}</th>
                            <th>{{trans('message.code')}}</th>
                            <th>{{trans('message.status')}}</th>
                            <th>{{trans('message.action')}}</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
@section('javascript')
<script>
  var oTable = $('#dt-method').DataTable({
      processing: true,
      serverSide: true,
      searching:false,
      responsive: true,
      ajax: {
            url:'{!! route('admin.currency.any_data') !!}',
            // data: function (d) {
            //     d.name = $('input[name=name]').val();
            //     d.status = $('select[name=status]').val();
            //   }
          },
      columns: [
          { data: 'id',orderable: false,searchable: false},
          { data: 'name'},
          { data: 'code'},
          { data: 'status'},
          { data: 'action',name:'action', orderable: false, searchable: false}
      ]
  });
  
  $(document).on("click",".search_text",function(){
      oTable.draw();
      return false;
  });

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
                url:"{{route('admin.currency.single_status_change')}}",
                data:{"status":status,"id":id,"_token": "{{ csrf_token() }}"},
                success:function(data){
                         if (data.status == 0) {
                            cur.removeClass('btn-success');
                            cur.addClass('btn-danger');
                            cur.text('{{trans('message.inactive')}}');
                         }else{
                            cur.removeClass('btn-danger');
                            cur.addClass('btn-success');
                            cur.text('{{trans('message.active')}}');
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

  function RESET_FORM(){

    $("#search-form").trigger('reset'); 
        oTable.draw();
        return false;
  }
 

  
</script>
@endsection
