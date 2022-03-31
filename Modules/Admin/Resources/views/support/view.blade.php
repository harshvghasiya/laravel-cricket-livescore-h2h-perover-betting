@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.support_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.support')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('message.support_detail')}}</li>
                                </ol>
                            </nav>
                        </div>
                        
                    </div>
                        @if($support->mark_as_read == 1)
                        <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
                            <div class="d-flex align-items-center">
                                <div class="font-35 text-success">
                                    <i class="bx bxs-check-circle"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-success">{{trans('message.success_message')}}</h6>
                                    <div>{{trans('message.you_already_view_this_query')}}</div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    <!--end breadcrumb-->
                    <div class="card">
                        <div class="card-body">
                            <div id="invoice">
                                <div class="toolbar hidden-print">
                                  
                                    <div class="text-end">
                                        <button type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
                                        {{-- <button type="button" data-route="{{route('admin.support.destroy',Crypt::encrypt($support->id))}}" class="btn delete_record btn-danger"><i class="fa fa-file-pdf-o"></i> <i class="fadeIn animated bx bx-message-square-x"></i></button> --}}
                                    </div>
                                    <div class="">
                                    <h4>{{trans('message.user_detail')}}</h4>
                                  </div>
                                    <hr/>
                                    
                                </div>
                                <div class="invoice overflow-auto">
                                    <div style="min-width: 600px">
                                      @if($support->user_data != null)
                                        <header>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="javascript:;">
                                                        <img src="{{$support->user_data->getAdminUserImageUrl()}}" width="80" alt="{{$support->user_data->name}}" />
                                                    </a>
                                                </div>
                                                <div class="col company-details">
                                                    <h2 class="name">
                                                        <a target="_blank" href="javascript:;">
                                                            {{$support->user_data->name}}
                                                        </a>
                                                    </h2>
                                                    <div>@if(isset($support->user_data->admin_right)){{$support->user_data->admin_right->name}} @endif</div>
                                                    <div>{{$support->user_data->email}}</div>
                                                </div>
                                            </div>
                                        </header>
                                      @endif
                                        <main>
                                            <div class="row contacts">
                                                <div class="col invoice-to">
                                                    <h3 class="invoice-id">{{trans('message.query_detail')}}</h3>

                                                </div>
                                                <div class="col invoice-details">
                                                    <div class="date">{{trans('message.date_of_query')}}: {!! date("d-m-Y h:m:s",strtotime($support->created_at)) !!}</div>
                                                   
                                                </div>
                                            </div>
                                            <table>
                                                <thead>
                                                
                                                </thead>
                                                <tbody>
                                                <tr>    
                                                    <td class="text-left">
                                                      <strong> Name :</strong> &nbsp; {{$support->name}}
                                                    </td>   
                                                </tr>
                                                <tr>    
                                                    <td class="text-left">
                                                      <strong> Email :</strong> &nbsp; {{$support->email}}
                                                    </td>   
                                                </tr>
                                                <tr>    
                                                    <td class="text-left">
                                                      <strong> Mobile :</strong> &nbsp; {{$support->mobile}}
                                                    </td>   
                                                </tr>
                                                <tr>
                                                    
                                                    <td class="text-left">
                                                      <strong> Subject :</strong> &nbsp; {{$support->subject}}
                                                    </td>
                                                   
                                                </tr>
                                                <tr>    
                                                    <td class="text-left">
                                                      <strong > Description :</strong> &nbsp; {!! $support->description !!}
                                                    </td>  
                                                </tr>
                                               
                                                </tbody>
                                               
                                            </table>
                                            
                                        </main>
                                        
                                    </div>
                                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php 
            $support->mark_as_read=1;
            $support->save();
            @endphp
@endsection
@section('javascript')

@endsection
