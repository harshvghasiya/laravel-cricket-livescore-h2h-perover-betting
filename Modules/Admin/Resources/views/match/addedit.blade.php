@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.match_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.match_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($match)) {{trans('message.edit_match_breadcrum')}} @else {{trans('message.add_match_breadcrum')}} @endif</li>
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
                                        <h5 class="mb-0 text-primary">@if(isset($match)) {{trans('message.edit')}} @else{{trans('message.add')}} @endif {{trans('message.match')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($match))
                                        {{ Form::model($match->match_contest,
                                          array(
                                          'id'                => 'AddEditmatch',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.match.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                        <input type="hidden" name="eid" value="{{$match->eid}}">
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditmatch',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.match.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif

                                         
                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{$match->team_name1}} Winning Rate</label> <span class="text-danger">*</span>
                                            @if($match->team_1_odd == null)
                                            {{ Form::text('team_1_odd',$setting->default_odd,['placeholder'=>trans('message.team_1_winning_rate_label'),'id'=>'team_name1','class'=>'form-control'])}}
                                            @else
                                            {{ Form::text('team_1_odd',$match->team_1_odd,['placeholder'=>trans('message.team_1_winning_rate_label'),'id'=>'team_name1','class'=>'form-control'])}}

                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <label for="team_2_winning_rate_label" class="form-label">{{$match->team_name2}} Winning Rate</label> <span class="text-danger">*</span>
                                            @if($match->team_2_odd ==null)
                                            {{ Form::text('team_2_odd',$setting->default_odd,['placeholder'=>trans('message.team_2_winning_rate_label'),'id'=>'team_2_odd','class'=>'form-control'])}}
                                            @else
                                            {{ Form::text('team_2_odd',$match->team_2_odd,['placeholder'=>trans('message.team_2_winning_rate_label'),'id'=>'team_2_odd','class'=>'form-control'])}}

                                            @endif
                                          </div>
                                        <div class="col-md-8">
                                            <label for="draw_rate_label" class="form-label">{{trans('message.draw_rate_label')}}</label> <span class="text-danger">*</span>
                                            @if($match->draw ==null)
                                            {{ Form::text('draw',$setting->default_odd,['placeholder'=>trans('message.draw_rate_label'),'id'=>'draw','class'=>'form-control'])}}
                                            @else
                                            {{ Form::text('draw',$match->draw,['placeholder'=>trans('message.draw_rate_label'),'id'=>'draw','class'=>'form-control'])}}

                                            @endif
                                        </div>

                                        <hr>

                                        <div class="col-md-8">
                                            <label for="over_run_rate_label" class="form-label">{{trans('message.over_run_rate_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('over_run',null,['placeholder'=>trans('message.over_run_rate_label'),'id'=>'over_run','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="over_run_odd_rate_label" class="form-label">{{trans('message.over_run_odd_rate_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('over_run_odd',null,['placeholder'=>trans('message.over_run_odd_rate_label'),'id'=>'over_run_odd','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="over_run_status" id="inlineRadio1" value="1" {{ isset($match->match_contest)?($match->match_contest->over_run_status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="over_run_status" id="inlineRadio1" value="0" {{ isset($match->match_contest)?($match->match_contest->over_run_status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                        <hr>

                                        <div class="col-md-8">
                                            <label for="six_over_run_rate_label" class="form-label">{{trans('message.six_over_run_rate_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('six_over_run',null,['placeholder'=>trans('message.six_over_run_rate_label'),'id'=>'six_over_run','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="six_over_run_odd_rate_label" class="form-label">{{trans('message.six_over_run_odd_rate_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('six_over_run_odd',null,['placeholder'=>trans('message.six_over_run_odd_rate_label'),'id'=>'six_over_run_odd','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="six_over_status" id="inlineRadio1" value="1" {{ isset($match->match_contest)?($match->match_contest->six_over_status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="six_over_status" id="inlineRadio1" value="0" {{ isset($match->match_contest)?($match->match_contest->six_over_status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                        <hr>


                                        <div class="col-md-8">
                                            <label for="ten_over_run_rate_label" class="form-label">{{trans('message.ten_over_run_rate_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('ten_over_run',null,['placeholder'=>trans('message.ten_over_run_rate_label'),'id'=>'ten_over_run','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="ten_over_run_odd_rate_label" class="form-label">{{trans('message.ten_over_run_odd_rate_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('ten_over_run_odd',null,['placeholder'=>trans('message.ten_over_run_odd_rate_label'),'id'=>'ten_over_run_odd','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="ten_over_status" id="inlineRadio1" value="1" {{ isset($match->match_contest)?($match->match_contest->ten_over_status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="ten_over_status" id="inlineRadio1" value="0" {{ isset($match->match_contest)?($match->match_contest->ten_over_status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                        <hr>

                                        <div class="col-md-8">
                                            <label for="fifteen_over_run_rate_label" class="form-label">{{trans('message.fifteen_over_run_rate_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('fifteen_over_run',null,['placeholder'=>trans('message.fifteen_over_run_rate_label'),'id'=>'ten_over_run','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="fifteen_over_run_odd_rate_label" class="form-label">{{trans('message.fifteen_over_run_odd_rate_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('fifteen_over_run_odd',null,['placeholder'=>trans('message.fifteen_over_run_odd_rate_label'),'id'=>'fifteen_over_run_odd','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="fifteen_over_status" id="inlineRadio1" value="1" {{ isset($match->match_contest)?($match->match_contest->fifteen_over_status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="fifteen_over_status" id="inlineRadio1" value="0" {{ isset($match->match_contest)?($match->match_contest->fifteen_over_status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                        <hr>

                                         <div class="col-md-8">
                                            <label for="twenty_over_run_rate_label" class="form-label">{{trans('message.twenty_over_run_rate_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('twenty_over_run',null,['placeholder'=>trans('message.twenty_over_run_rate_label'),'id'=>'ten_over_run','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="twenty_over_run_odd_rate_label" class="form-label">{{trans('message.twenty_over_run_odd_rate_label')}}</label> <span class="text-danger">*</span>
                                            {{ Form::text('twenty_over_run_odd',null,['placeholder'=>trans('message.twenty_over_run_odd_rate_label'),'id'=>'twenty_over_run_odd','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" checked type="radio" name="twenty_over_status" id="inlineRadio1" value="1" {{ isset($match->match_contest)?($match->match_contest->twenty_over_status == 1)?'checked':'':'checked' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="twenty_over_status" id="inlineRadio1" value="0" {{ isset($match->match_contest)?($match->match_contest->twenty_over_status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>


                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.match.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
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

@endsection
