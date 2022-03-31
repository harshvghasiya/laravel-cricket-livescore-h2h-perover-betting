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
                  <h3>{{trans('message.basic_setting_basicinfo_head_title')}}</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">{{trans('message.base_setting_basicinfo_breadcrum')}}</li>
                  </ol>
                </div>
                <div class="col-sm-6">
                  <!-- Bookmark Start-->
                  <!-- Bookmark Ends-->
                </div>
              </div>
            </div>
          </div> 
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 ">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5>{{trans('message.basic_setting_basicinfo_head_title')}}</h5>
                      </div>
                      <div class="card-body">
                        {{-- <form class="theme-form mega-form"> --}}
                          {{ Form::model($lang->basic_extended,
                            array(
                            'id'                => 'BasicInfo',
                            'class'             => 'FromSubmit theme-form mega-form',
                            'url'               => route('admin.basic_setting.update_basicinfo', $encryptedId),
                            'method'            => 'PUT',
                            'enctype'           =>"multipart/form-data"
                            ))
                          }}
                          <div class="mb-3">
                            <label class="col-form-label">{{trans('message.website_title_label')}}</label>
                            {{ Form::text('website_title',$lang->basic_setting->website_title,['placeholder'=>trans('message.website_title'),'id'=>'webtitle','class'=>'form-control'])}}
                          </div>
                          
                          <div class="row">
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.base_currency_symbol_label')}}</label>
                                {{ Form::text('base_currency_symbol',$lang->basic_extra->base_currency_symbol,['placeholder'=>trans('message.base_currency_symbol'),'id'=>'sy','class'=>'form-control'])}}
                              </div>

                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.base_currency_symbol_position_label')}}</label>
                                {{ Form::select('base_currency_symbol_position',[''=>trans('message.base_currency_symbol_position')]+ getBaseCurrencySymbolPositionDropDown(),$lang->basic_extra->base_currency_symbol_position,['id'=>'',"class"=>"col-sm-12 js-example-basic-single"])
                            }}
                              </div>
                          </div>
                          <div class="row">
                              <div class="mb-3 col-md-4">
                                <label class="col-form-label">{{trans('message.base_currency_text_label')}}</label>
                                {{ Form::text('base_currency_text',$lang->basic_extra->base_currency_text,['placeholder'=>trans('message.base_currency_text'),'id'=>'te','class'=>'form-control'])}}
                              </div>

                              <div class="mb-3 col-md-4">
                                <label class="col-form-label">{{trans('message.base_currency_text_position_label')}}</label>
                                {{ Form::select('base_currency_text_position',[''=>trans('message.base_currency_text_position')]+ getBaseCurrencyTextPositionDropDown(),$lang->basic_extra->base_currency_text_position,['id'=>'',"class"=>"col-sm-12 js-example-basic-single"])
                                }}
                              </div>
                              <div class="mt-2 col-md-4">
                                <label class="form-label">{{trans('message.base_currency_rate_label')}}</label>
                                <div class="input-group pill-input-group"><span class="input-group-text">1$ =  </span>
                                {{ Form::text('base_currency_rate',$lang->basic_extra->base_currency_rate,['placeholder'=>trans('message.base_currency_rate'),'id'=>'rate','class'=>'form-control'])}}<span class="input-group-text">.00  </span>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.base_color_code_label')}}</label>
                                {{ Form::color('base_color',$lang->basic_setting->base_color,['placeholder'=>trans('message.base_color_code'),'id'=>'base_color_code','class'=>'form-control'])}}
                              </div>
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.secondory_base_color_code_label')}}</label>
                                {{ Form::color('secondary_base_color',$lang->basic_setting->secondary_base_color,['placeholder'=>trans('message.secondary_base_color_code'),'id'=>'secondary_base_color','class'=>'form-control'])}}
                              </div>
                          </div>
                          <div class="row">
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.hero_overlay_color_code_label')}}</label>
                                {{ Form::color('hero_overlay_color',null,['id'=>'gfh','class'=>'form-control'])}}
                              </div>
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.hero_overlay_opacity_label')}}</label>
                                {{ Form::text('hero_overlay_opacity',null,['placeholder'=>trans('message.opacity_placeholder'),'id'=>'heop','class'=>'form-control'])}}
                              </div>
                          </div>
                          <div class="row">
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.statistics_color_code_label')}}</label>
                                {{ Form::color('statistics_overlay_color',null,['id'=>'stco','class'=>'form-control'])}}
                              </div>
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.statistics_opacity_label')}}</label>
                                {{ Form::text('statistics_overlay_opacity',null,['placeholder'=>trans('message.opacity_placeholder'),'id'=>'fg','class'=>'form-control'])}}
                              </div>
                          </div>
                          <div class="row">
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.team_color_code_label')}}</label>
                                {{ Form::color('team_overlay_color',null,['class'=>'form-control'])}}
                              </div>
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.team_opacity_label')}}</label>
                                {{ Form::text('team_overlay_opacity',null,['placeholder'=>trans('message.opacity_placeholder'),'class'=>'form-control'])}}
                              </div>
                          </div>
                          <div class="row">
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.cta_color_code_label')}}</label>
                                {{ Form::color('cta_overlay_color',null,['class'=>'form-control'])}}
                              </div>
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.cta_opacity_label')}}</label>
                                {{ Form::text('cta_overlay_opacity',null,['placeholder'=>trans('message.opacity_placeholder'),'class'=>'form-control'])}}
                              </div>
                          </div>
                          <div class="row">
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.breadcrumb_color_code_label')}}</label>
                                {{ Form::color('breadcrumb_overlay_color',null,['class'=>'form-control'])}}
                              </div>
                              <div class="mb-3 col-md-6">
                                <label class="col-form-label">{{trans('message.breadcrumb_opacity_label')}}</label>
                                {{ Form::text('breadcrumb_overlay_opacity',null,['placeholder'=>trans('message.opacity_placeholder'),'class'=>'form-control'])}}
                              </div>
                          </div>
                          
                          
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button class="btn btn-secondary">Cancel</button>
                      </div>
                      {{Form::close()}}

                      </div>
                      
                    </div>
                  
               
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
@endsection
@section('javascript')

