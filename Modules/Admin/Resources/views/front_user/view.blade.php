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
                    <div class="breadcrumb-title pe-3">{{trans('message.front_user_view_managment')}} </div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{trans('message.index_front_user_view_breadcrum')}}</li>
                            </ol>
                        </nav>
                    </div>
                    
                </div>
                <!--end breadcrumb-->
                
                <div class="card">
                    <div class="card-body">
                        <div class="row m-4">
                            <div class="col-md-6">
                              <div class="btn-group ">
                                <a href="javascript:void();" id="sample_editable_1_new" class="btn btn-primary">
                                 Current Balance = {{$front_user->balance}}
                                </a>
                              
                              </div>
                              
                                <div class="btn-group ">
                                  <a class="btn btn-info" style="color: white;" >
                                 Top Up Balance = @if($front_user->signup_balance != null) {{$front_user->signup_balance}} @else 0 @endif

                                  </a>
                                </div>
                            
                              <div class="btn-group d-none">
                                <a class="btn btn-warning" style="color: white;" onclick="statusAll('table_form','{{route('admin.front_user.status_all')}}')">{{trans('message.status_all_label')}}
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
                            <table id="user-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                   <tr>
                                                    <th scope="col">Date/Time</th>
                                                    <th scope="col">Bet Value</th>
                                                    <th scope="col">Match Status</th>
                                                    <th scope="col">Winner</th>
                                                    <th scope="col">Wining/Loosing Amount</th>
                                                </tr>
                                </thead>
                                <tbody>
                                                {{-- {{liveMatch()}} --}}
                                                
                                                @if(isset($my_bets) && $my_bets != null )
                                                   

                                                @foreach($my_bets as $Key=>$value)
                                                 @php 
                                                    $match_id=matchDetail($value->eid);
                                                @endphp
                                                 @php 
                                                if ($value->win_lose==null && isset($match_id->live) && $match_id->live !=true) {
                                                    
                                                
                                                $bet_value=$value->bet_value;
                                                     $odd=$value->odd;
                                                     $add=($bet_value)*($odd);
                                                 if (isset($match_id->winner_team_id) && $match_id->winner_team_id == $value->team_id) {
                                                     $value->win_lose=1;
                                                     $value->win_amount=$add;
                                                     $value->save();

                                                     $user=\App\Models\FrontUser::where('id',$decrypted_id)->first();
                                                     $user->balance=($user->balance)+($add);
                                                     $user->save();
                                                 }else if(isset($match_id->live) && $match_id->live == false && $match_id->winner_team_id != $value->team_id){

                                                    $value->win_lose=0;
                                                    $value->loose_amount=$add;
                                                    $value->save();
                                                 }

                                                 }
                                                @endphp
                                                <tr>
                                                    <th scope="row">2021-01-07 16:33:53</th>
                                                    <td>{{$value->bet_value}} Rs</td>
                                                    @if($match_id != null)
                                                    <td>{{$match_id->status}}</td>
                                                    @else
                                                    <td>Not Found</td>
                                                    @endif
                                                    <td>
                                                       @if(isset($match_id->status) && $match_id->status=="Finished" && $match_id->live==false)
                                                        {!! teamData($match_id->winner_team_id)->name !!}
                                                       @else
                                                       Winner Not Yet
                                                       @endif
                                                   </td>
                                                   <td @if($value->win_lose==1) class="text-success" @else class="text-danger" @endif> @if($value->win_amount != null) +{{$value->win_amount}} @else -{{$value->loose_amount}}  @endif</td>
                                                   
                                                </tr>

                                               

                                                @endforeach
                                                @endif
                                                
                                            </tbody>
                            </table>
                            {{ Form::close() }}
                        </div>

                        <div class="table-responsive">
                             {{ Form::open([
                                  'id'=>'table_form',
                                  'class'=>'table_form',
                                  'name'=> 'form_data'
                                ])
                              }}
                            <table id="user-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                                <tr>
                                                    <th scope="col">Date/Time</th>
                                                    <th scope="col">Bet Value</th>
                                                    <th scope="col">Over Number</th>
                                                    <th scope="col">Winner</th>
                                                    <th scope="col">Wining/Loosing Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- {{liveMatch()}} --}}
                                                
                                                @if(isset($user_contest) && $user_contest != null )
                                                   

                                                @foreach($user_contest as $Key=>$value)

                                                 @php 
                                                 $match_detail=matchDetail($value->eid);
                                                 // dd($match_detail);
                                                 $is_valid=false;
                                                 $total_runs=0;
                                                 foreach ($match_detail->balls as $key => $val) {
                                                    $over=ceil($val->ball);

                                                     if ($val->bowler_id== $value->bowler_id && $over==$value->over_number ) {
                                                        if (isset($val->score) &&$val->score != null) {
                                                            $total_runs += $val->score->runs;
                                                            $is_valid=true;
                                                        }

                                                     }
                                                 }
                                                 // dd($total_runs);
                                                    $bet_value=$value->balance;
                                                     $odd=$value->odd;
                                                     $add=($bet_value)*($odd);
                                                 if ($total_runs==$value->run && $is_valid==true && $value->win_lose == Null ) {
                                                      $value->win_lose=1;
                                                     $value->win_amount=$add;
                                                     $value->save();
                                                     $you_win="You Win";
                                                     $user=\App\Models\FrontUser::where('id',\Auth::guard('front_user')->user()->id)->first();
                                                     $user->balance=($user->balance)+($add);
                                                     $user->save();
                                                 }else if($is_valid==true && $value->win_lose==null){
                                                     $you_win="You Lose";
                                                     $value->win_lose=2;
                                                    $value->loose_amount=$add;
                                                    $value->save();
                                                 }else{
                                                    $you_win='Result Not Yet';
                                                 }

                                                @endphp  
                                                <tr>
                                                    <th scope="row">{{$value->created_at}}</th>
                                                    <td>{{$value->balance}} Rs</td> 
                                                    <td>{{$value->over_number}} </td> 
                                                    <td>@if($value->win_lose==1)You Win @elseif($value->win_lose==2) You Loose @else Result Not Yet  @endif</td> 
                                                     <td @if($value->win_lose==1) class="text-success" @else class="text-danger" @endif> @if($value->win_amount != null) +{{$value->win_amount}} @else -{{$value->loose_amount}}  @endif</td>

                                                </tr>
                                                @endforeach
                                                @endif
                                                
                                            </tbody>
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
    <script>
 
  
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
                url:"{{route('admin.front_user.single_status_change')}}",
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
