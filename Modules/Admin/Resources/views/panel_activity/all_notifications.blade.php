@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.country_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.panel_activity')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('message.all_notification')}}</li>
                                    
                                </ol>
                            </nav>
                        </div>
                        
                    </div>
                    <!--end breadcrumb-->
                    <div class="row">
                        <div class="col-12 col-lg-9 mx-auto mt-3">
                            
                            @if(!$all_notifications->isEmpty())
                            @foreach($all_notifications as $Key=>$value)
                                <div class="card radius-10">
                                <div class="card-body">
                                  <div class="d-flex float-end">
                                   <a href="javascript:;"> {{\Carbon\Carbon::parse($value->created_at)->diffForHumans()}}</a>
                                      &nbsp;&nbsp;&nbsp;<button class="btn-sm btn-danger delete_record" data-route="{{route('admin.panel_activity.destroy',Crypt::encrypt($value->id))}}"><i class="fadeIn animated bx bx-trash-alt"></i></button>

                                  </div>

                                    <a href="{{route('admin.panel_activity.see_detail',$value->slug)}}" class="d-flex align-items-center">
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="mt-0">{{$value->name}}</h5>
                                            <p class="mb-0">{{$value->description}}</p>
                                            
                                        </div>

                                        
                                    </a>
                                </div>
                                </div>
                            @endforeach
                            @else
                            <div class="card radius-10">
                                <div class="card-body">
                                  <div class="d-flex float-end">
                                   

                                  </div>
                                  <h5>{{trans('message.no_notification_ava')}}</h5>
                                </div>
                                </div>
                            @endif
                            
                              <nav aria-label="Page navigation example">
                                <ul class="pagination round-pagination">
                                  {!! $all_notifications->links("pagination::bootstrap-4") !!}
                                </ul>
                            </nav>
                            
                           
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('javascript')

@endsection
