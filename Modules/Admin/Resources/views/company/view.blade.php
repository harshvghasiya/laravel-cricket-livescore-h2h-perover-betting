@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.company_category_title')}} @endif | {{trans('message.app_name')}}
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
          <div class="breadcrumb-title pe-3">{{trans('message.company_detail')}}</div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$company->name}}</li>
              </ol>
            </nav>
          </div>
          
        </div>
        <!--end breadcrumb-->

         <div class="card">
          <div class="row g-0">
            <div class="border-end">
            
            </div>
            <div class="col-md-10">
            <div class="card-body">
              <h4 class="card-title">{{$company->name}}</h4>
              <div class="d-flex gap-3 py-3">

              </div>
              
              <p class="card-text fs-6">{{$company->notes}}</p>
              <dl class="row">
                  <dt class="col-sm-3">{{trans('message.company_category')}}</dt>
                  <dd class="col-sm-9">@if($company->company_category && $company->company_category != null) {{$company->company_category->name}}  @else No Company Category Found @endif
                  </dd>

                  <dt class="col-sm-3">{{trans('message.company_location')}}</dt>
                  <dd class="col-sm-9">
                    @if(isset($company->company_location) && $company->company_location != null)
                       @foreach($company->company_location as $key=>$value)
                          @if($value->location != null)
                           {{$value->location->name}} @if($key !=$company->company_location->keys()->last()) , @endif
                          @endif
                       @endforeach
                    @else
                    No Company Location Found
                    @endif
                  </dd>

                  <dt class="col-sm-3">{{trans('message.company_contact')}}</dt>
                  <dd class="col-sm-9">
                    @if(isset($company->company_contact) && $company->company_contact != null)
                       @foreach($company->company_contact as $key=>$value)
                          @if($value->contact != null)
                           {{$value->contact->full_name}} @if($key !=$company->company_contact->keys()->last()) , @endif
                          @endif
                       @endforeach
                    @else
                    No Company Contact Found
                    @endif
                  </dd>
              </dl>
            </div>
            </div>
          </div>
           <hr/>
          <div class="card-body">
            <div class="card-title mb-3">
              <h4>{{trans('message.activity_details')}}</h4>
            </div>
            <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
              @if(isset($company->company_activity) && $company->company_activity != null)
              @foreach($company->company_activity as $key=>$value)
              <li class="nav-item" role="presentation">
                <a  @if($key== $company->company_activity->keys()->first())  class="nav-link active" @else class="nav-link "  @endif   data-bs-toggle="tab" href="#activity{{$value->activity_id}}" role="tab" aria-selected="true">
                  
                  <div class="d-flex align-items-center">
                    <div class="tab-icon"><i class='bx bx-palette font-18 me-1'></i>
                    </div>
                    <div class="tab-title"> @if($value->activity != null) {{$value->activity->name}} @endif </div>
                  </div>
                </a>
              </li>
              @endforeach
              @else
              No Activity Data Found
              @endif
            </ul>
            <div class="tab-content pt-3">
              @if(isset($company->company_activity) && $company->company_activity != null)
              @foreach($company->company_activity as $key=>$value)
              <div @if($key== $company->company_activity->keys()->first())  class="tab-pane fade show active"  @else  class="tab-pane fade  " @endif id="activity{{$value->activity_id}}" role="tabpanel">
                  <dl class="row mx-3">
                 

                  <dt class="col-sm-2">{{trans('message.name')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->activity->name}}
                  </dd>

                   <dt class="col-sm-2">{{trans('message.activity_subject')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->activity->activity_subject_detail->title}}
                  </dd>

                  <dt class="col-sm-2">{{trans('message.activity_start_date')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->activity->start_datetime}}
                  </dd>

                  <dt class="col-sm-2">{{trans('message.activity_end_date')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->activity->end_datetime}}
                  </dd>
                  @php 
                   $start = \Carbon\Carbon::parse($value->activity->start_datetime);
                   $end=\Carbon\Carbon::parse($value->activity->end_datetime);
                     $duration_hours=$start->diffInHours($end);
                     $duration_days=$start->diffInDays($end);
                  @endphp                   
                  <dt class="col-sm-2">{{trans('message.activity_duration')}}</dt>
                  <dd class="col-sm-9">
                     {{$duration_hours}} Hours ({{$duration_days}} Days)
                  </dd>    

                </dl>
                @if(isset($value->activity->staff_member_detail) && $value->activity->staff_member_detail != null)
                <dt class="col-sm-3">
                  {{trans('message.staff_member_detail')}}
                </dt>
                <dd class="col-sm-9">
                  <div class="mx-4 mt-2  row">
                    <div class="col-sm-2">
                      <span class="fw-bold">{{trans('message.staff_member_name')}}</span>
                    </div>
                    <div class="col-sm-9">
                      {{$value->activity->staff_member_detail->name}}
                    </div>

                    <div class="col-sm-2">
                      <span class="fw-bold">{{trans('message.email')}}</span>
                    </div>
                    <div class="col-sm-9">
                      {{$value->activity->staff_member_detail->email}}
                    </div>
                  </div>
                </dd>
                @endif

                @if(isset($value->activity->location_detail) && $value->activity->location_detail != null)
                <dt class="col-sm-3">
                  {{trans('message.activity_location_detail')}}
                </dt>
                <dd class="col-sm-9">
                  <div class="mx-4 mt-2  row">
                    <div class="col-sm-2">
                      <span class="fw-bold">{{trans('message.name')}}</span>
                    </div>
                    <div class="col-sm-9">
                      {{$value->activity->location_detail->name}}
                    </div>

                    <div class="col-sm-2">
                      <span class="fw-bold">{{trans('message.address_1')}}</span>
                    </div>
                    <div class="col-sm-9">
                      {{$value->activity->location_detail->address_1}}
                    </div>
                    <div class="col-sm-2">
                      <span class="fw-bold">{{trans('message.address_2')}}</span>
                    </div>
                    <div class="col-sm-9">
                      {{$value->activity->location_detail->address_2}}
                    </div>
                  </div>
                </dd>
                @endif
              </div>
              @endforeach
              @else
              No Location Detail Found  
              @endif
            </div>
          </div>
                    <hr/>
          <div class="card-body">
            <div class="card-title mb-3">
              <h4>{{trans('message.location_detail')}}</h4>
            </div>
            <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
              @if(isset($company->company_location) && $company->company_location != null)
              @foreach($company->company_location as $key=>$value)
              <li class="nav-item" role="presentation">
                <a  @if($key== $company->company_location->keys()->first())  class="nav-link active" @else class="nav-link "  @endif   data-bs-toggle="tab" href="#location{{$value->location_id}}" role="tab" aria-selected="true">
                  @php
                   $main_location="";
                   if ($value->location != null) {
                     if ($value->location->is_main_location==1) {
                       $main_location="text-success";
                     }
                   }
                  @endphp
                  <div class="d-flex align-items-center {{$main_location}}">
                    <div class="tab-icon"><i class='bx bx-current-location font-18 me-1'></i>
                    </div>
                    <div class="tab-title"> @if($value->location != null) {{$value->location->name}} @endif </div>
                  </div>
                </a>
              </li>
              @endforeach
              @else
              No Location Data Found
              @endif
            </ul>
            <div class="tab-content pt-3">
              @if(isset($company->company_location) && $company->company_location != null)
              @foreach($company->company_location as $key=>$value)
              <div @if($key== $company->company_location->keys()->first())  class="tab-pane fade show active"  @else  class="tab-pane fade  " @endif id="location{{$value->location_id}}" role="tabpanel">
                 <dl class="row mx-3">
                 @if($value->location->is_main_location ==1)
                  <dt class="col-sm-2">{{trans('message.main_location')}}</dt>
                  <dd class="col-sm-9">
                    @if($value->location->is_main_location ==1) <p class="text-success">Yes</p> @endif
                  </dd>
                  @endif

                  <dt class="col-sm-2">{{trans('message.address_1')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->location->address_1}}
                  </dd>

                  <dt class="col-sm-2">{{trans('message.address_2')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->location->address_1}}
                  </dd>

                  <dt class="col-sm-2">{{trans('message.postal_address')}}</dt>
                  <dd class="col-sm-9">
                      @if($value->location != null)
                       @if(isset($value->location->city_location) && $value->location->city_location != null && isset($value->location->city_location->state_name) && $value->location->city_location->state_name != null && isset($value->location->city_location->state_name->country_name) && $value->location->city_location->state_name->country_name != null ) 
                        {{$value->location->city_location->name}} , {{$value->location->city_location->state_name->name}} ,
                        {{$value->location->city_location->state_name->country_name->name}} , {{$value->location->city_location->pin_code}}
                        @endif
                        @else
                        Data Not Found !
                      @endif
                  </dd>
                  
                  </dl>
                  <dt class="col-sm-3 mt-4">{{trans('message.location_contact_details')}}</dt>
                  <dd class="col-sm-9">
                      @if($value->location != null)
                       @if($value->location->contact != null ) 
                          <div class="mx-4 mt-2 row">
                            <div class="col-sm-2">
                              <span class="fw-bold"> {{trans('message.full_name')}} </span>
                            </div>
                            <div class="col-sm-9">
                              {{$value->location->contact->full_name}} 
                            </div>
                          </div>

                          <div class="mx-4 mt-2 row">
                            <div class="col-sm-2">
                              <span class="fw-bold"> {{trans('message.phone_number_1')}} </span>
                            </div>
                            <div class="col-sm-9">
                              {{$value->location->contact->phone_number}} 
                            </div>
                          </div>
                          <div class="mx-4 mt-2 row">
                            <div class="col-sm-2">
                              <span class="fw-bold"> {{trans('message.phone_number_2')}} </span>
                            </div>
                            <div class="col-sm-9">
                              {{$value->location->contact->phone_number_2}} 
                            </div>
                          </div>
                          <div class="mx-4 mt-2 row">
                            <div class="col-sm-2">
                              <span class="fw-bold"> {{trans('message.email_address')}} </span>
                            </div>
                            <div class="col-sm-9">
                              {{$value->location->contact->email_address}} 
                            </div>
                          </div>
                          @if($value->location->contact->is_main_contact ==1)
                          <div class="mx-4 mt-2 row text-success">
                            <div class="col-sm-2">
                              <span class="fw-bold"> {{trans('message.main_contact')}} </span>
                            </div>
                            <div class="col-sm-9">
                              YES
                            </div>
                          </div>
                          @endif
                        @endif
                        @else
                        Data Not Found !
                      @endif
                  </dd>
              </div>
              @endforeach
              @else
              No Location Detail Found  
              @endif
            </div>
          </div>
                   <hr/>
          <div class="card-body">
            <div class="card-title mb-3">
              <h4>{{trans('message.contact_details')}}</h4>
            </div>
            <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
              @if(isset($company->company_contact) && $company->company_contact != null)
              @foreach($company->company_contact as $key=>$value)
              <li class="nav-item" role="presentation">
                <a  @if($key== $company->company_contact->keys()->first())  class="nav-link active" @else class="nav-link "  @endif   data-bs-toggle="tab" href="#contact{{$value->contact_id}}" role="tab" aria-selected="true">
                  @php
                   $main_contact="";
                   if ($value->contact != null) {
                     if ($value->contact->is_main_contact==1) {
                       $main_contact="text-success";
                     }
                   }
                  @endphp
                  <div class="d-flex align-items-center {{$main_contact}}">
                    <div class="tab-icon"><i class='bx bx-phone-call font-18 me-1'></i>
                    </div>
                    <div class="tab-title"> @if($value->contact != null) {{$value->contact->full_name}} @endif </div>
                  </div>
                </a>
              </li>
              @endforeach
              @else
              No Contact Data Found
              @endif
            </ul>
            <div class="tab-content pt-3">
              @if(isset($company->company_contact) && $company->company_contact != null)
              @foreach($company->company_contact as $key=>$value)
              <div @if($key== $company->company_contact->keys()->first())  class="tab-pane fade show active"  @else  class="tab-pane fade  " @endif id="contact{{$value->contact_id}}" role="tabpanel">
                  <dl class="row mx-3">
                 @if(isset($value->contact) && $value->contact->is_main_contact ==1)
                  <dt class="col-sm-2">{{trans('message.main_contact')}}</dt>
                  <dd class="col-sm-9">
                    @if( isset($value->contact) && $value->contact->is_main_contact ==1) <p class="text-success">Yes</p> @endif
                  </dd>
                  @endif

                  <dt class="col-sm-2">{{trans('message.full_name')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->contact->full_name}}
                  </dd>

                  <dt class="col-sm-2">{{trans('message.phone_number_1')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->contact->phone_number}}
                  </dd>

                  <dt class="col-sm-2">{{trans('message.phone_number_2')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->contact->phone_number_2}}
                  </dd>

                  <dt class="col-sm-2">{{trans('message.email_address')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->contact->email_address}}
                  </dd>
                  <dt class="col-sm-2">{{trans('message.notes')}}</dt>
                  <dd class="col-sm-9">
                     {{$value->contact->notes }}
                  </dd>

                </dl>
              </div>
              @endforeach
              @else
              No Location Detail Found  
              @endif
            </div>
          </div>

          </div>

                   
          
      </div>
    </div>
@endsection
@section('javascript')

@endsection
