@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.right_title')}} @endif | {{trans('message.app_name')}}
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
                        <div class="breadcrumb-title pe-3">{{trans('message.right_managment')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($right)) {{trans('message.edit_right_breadcrum')}} @else {{trans('message.add_right_breadcrum')}} @endif</li>
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
                                        <h5 class="mb-0 text-primary">{{trans('message.right')}} {{trans('message.info')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($right))
                                        {{ Form::model($right,
                                          array(
                                          'id'                => 'AddEditright',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.right.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditright',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.right.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif

                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.right_name_label')}}</label>
                                            {{ Form::text('name',null,['placeholder'=>trans('message.name_placeholder'),'id'=>'name','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                          <label for="email" class="form-label">{{trans('message.status_label')}}</label><br>

                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" {{ isset($right)?($right->status == 1)?'checked':'':'checked' }} type="radio" name="status" id="inlineRadio1" value="1">
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.active_label')}}</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" {{ isset($right)?($right->status == 0)?'checked':'':'' }}>
                                              <label class="form-check-label" for="inlineRadio1">{{trans('message.inactive_label')}}</label>
                                          </div>
                                        </div>
                                       
                                        <div class="card-body">
                                              <div class="card-title d-flex align-items-center mt-2">
                                                 <h5 class="mb-0 text-primary">{{trans('message.module')}} {{trans('message.list')}}</h5> 
                                                 <div class="form-check mx-4 pt-1">
                                                  <input type="checkbox" name="checke_all" id="checked_all" class="form-check-input">
                                                  <label class="form-check-label" for="checked_all">{{trans('message.check_all')}}</label>
                                                 </div> 
                                              </div>
                                              <hr>
                                        <div class="row">

                                          @if(\App\Models\Module::getModuleDropDown() != null)
                                         
                                          @foreach(\App\Models\Module::getModuleDropDown() as $key=>$value)
                                            <div class="col-md-4">
                                              @php
                                              $checked=""; 
                                              @endphp
                                              @if(isset($right) && $right->right_module !=null ) 
                                              @foreach($right->right_module as $k=>$val)
                                               @php 
                                                
                                                if($val->module_id==$key) {
                                                  $checked='checked';
                                                  break;
                                                }
                                               @endphp
                                              @endforeach
                                              <div class="form-check">
                                                  {{ Form::checkbox('module_id[]',$key,$checked,["class"=>"right_data form-check-input",'id'=>"flexCheckDefault$key"]) }}
                                                  <label class="form-check-label" for="flexCheckDefault{{$key}}">{{$value}}</label>
                                              </div>
                                              @else
                                              <div class="form-check">
                                                  {{ Form::checkbox('module_id[]',$key,null,["class"=>"right_data form-check-input",'id'=>"flexCheckDefault$key"]) }}
                                                  <label class="form-check-label" for="flexCheckDefault{{$key}}">{{$value}}</label>
                                              </div>
                                              @endif
                                            </div>
                                          @endforeach

                                          @endif
                                          </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.right.index')}}" class="btn btn-secondary">{{trans('message.cancle')}}</a>
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
<script type="text/javascript">
  $(document).ready(function() {
     if($("#checked_all").length>0)
    {
      $(document).on("click","#checked_all",function(){
        select_all_right();
      });
    }
    function select_all_right()
    {
      console.log("in");
      if($("#checked_all").prop("checked"))
      {
        $(".right_data").each(function(){
            $(this).prop("checked",true);
        });
      }
      else
      {
        $(".right_data").prop("checked",false);
      }
    }

  });
</script>
@endsection
