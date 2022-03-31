<?php 
   
   $moduleData = \App\Models\RightModule::where('right_id',\Auth::user()->right_id)->pluck('module_id')->toArray();
?>
<div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div >
                    <img @if(isset($setting))src="{{$setting->getLogoImageUrl()}}"@endif style="height: 46px;" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h4 class="logo-text">@if(isset($setting)){{$setting->website_title}} @endif</h4>
                </div>
                
                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{route('admin.dashboard')}}" >
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">{{trans('message.dashboard')}}</div>
                    </a>
                </li>
                
                 @php
                  if (
                       \Route::is('admin.'.EMAIL_TEMPLATE_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.EMAIL_TEMPLATE_ROUTE_NAME().'create')||
                       \Route::is('admin.'.EMAIL_TEMPLATE_ROUTE_NAME().'edit') 
                   ) {
                      $mainliclass="mm-active";
                      $ulclass="mm-show mm-collapse";

                  }else{
                    $mainliclass="";
                    $ulclass="";
                  }
                @endphp 

                @if(
                    in_array(\App\Models\RightModule::CONST_LOGO_SETTING,$moduleData) || 
                    in_array(\App\Models\RightModule::CONST_FAVICON_SETTING,$moduleData) ||
                    in_array(\App\Models\RightModule::CONST_SCRIPT_SETTING,$moduleData) || 
                    in_array(\App\Models\RightModule::CONST_MAIL_SETTING,$moduleData) ||
                    in_array(\App\Models\RightModule::CONST_EMAIL_TEMPLATE_SETTING,$moduleData)
                   )
                 <li class="{{$mainliclass}}">
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">{{trans('message.basic_setting')}}</div>
                    </a>
                    <ul class="{{$ulclass}}">

                        @if(in_array(\App\Models\RightModule::CONST_LOGO_SETTING,$moduleData))
                            <li> <a href="{{ route('admin.basic_setting.logo') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.logo_setting')}}</a>
                            </li>
                        @endif
                        @if(in_array(\App\Models\RightModule::CONST_FAVICON_SETTING,$moduleData))
                        <li> <a href="{{ route('admin.basic_setting.favicon') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.favicon_setting')}}</a>
                        </li>
                        @endif
                        @if(in_array(\App\Models\RightModule::CONST_SCRIPT_SETTING,$moduleData))
                        <li> <a href="{{ route('admin.basic_setting.script') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.script_basic_settings')}}</a>
                        </li>   
                        @endif
                        @if(in_array(\App\Models\RightModule::CONST_MAIL_SETTING,$moduleData))
                        <li> <a href="{{ route('admin.basic_setting.mail_config') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.mail_config_settings')}}</a>
                        </li>
                        @endif
                        @if(in_array(\App\Models\RightModule::CONST_EMAIL_TEMPLATE_SETTING,$moduleData))
                        <li  @if(\Route::is('admin.'.EMAIL_TEMPLATE_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.EMAIL_TEMPLATE_ROUTE_NAME().'create')||
                       \Route::is('admin.'.EMAIL_TEMPLATE_ROUTE_NAME().'edit')) class="mm-active" @endif> <a href="{{ route('admin.email_template.index') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.email_template')}}</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @php
                  if ( \Route::is('admin.'.RIGHT_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.RIGHT_ROUTE_NAME().'create')||
                       \Route::is('admin.'.RIGHT_ROUTE_NAME().'edit') ||

                       \Route::is('admin.'.MODULE_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.MODULE_ROUTE_NAME().'create')||
                       \Route::is('admin.'.MODULE_ROUTE_NAME().'edit') ||

                       \Route::is('admin.'.ADMIN_USER_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.ADMIN_USER_ROUTE_NAME().'create')||
                       \Route::is('admin.'.ADMIN_USER_ROUTE_NAME().'edit') 
                   ) {
                      $mainliclass="mm-active";
                      $ulclass="mm-show mm-collapse";

                  }else{
                    $mainliclass="";
                    $ulclass="";
                  }
                @endphp 

                @if(\Auth::user()->is_admin==1)
                <li class="{{$mainliclass}}">
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-lock"></i>
                        </div>
                        <div class="menu-title">{{trans('message.admin_management')}}</div>
                    </a>
                    <ul class="{{$ulclass}}">
                        <li @if(\Route::is('admin.'.RIGHT_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.RIGHT_ROUTE_NAME().'create')||
                       \Route::is('admin.'.RIGHT_ROUTE_NAME().'edit')) class="mm-active" @endif> <a href="{{ route('admin.right.index') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.right_setting')}}</a>
                        </li>
                        <li @if(\Route::is('admin.'.MODULE_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.MODULE_ROUTE_NAME().'create')||
                       \Route::is('admin.'.MODULE_ROUTE_NAME().'edit')) class="mm-active" @endif> <a href="{{ route('admin.module.index') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.module_setting')}}</a>
                        </li>
                        <li @if(\Route::is('admin.'.ADMIN_USER_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.ADMIN_USER_ROUTE_NAME().'create')||
                       \Route::is('admin.'.ADMIN_USER_ROUTE_NAME().'edit')) class="mm-active" @endif> <a href="{{ route('admin.admin_user.index') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.admin_user_setting')}}</a>
                        </li>

                    </ul>
                </li>
                @endif
                 
                @php
                  if ( \Route::is('admin.'.MATCH_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.MATCH_ROUTE_NAME().'create')||
                       \Route::is('admin.'.MATCH_ROUTE_NAME().'edit') ||

                       \Route::is('admin.'.PROMOCODE_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.PROMOCODE_ROUTE_NAME().'create')||
                       \Route::is('admin.'.PROMOCODE_ROUTE_NAME().'edit') ||

                       \Route::is('admin.'.CONTEST_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.CONTEST_ROUTE_NAME().'create')||
                       \Route::is('admin.'.CONTEST_ROUTE_NAME().'edit') ||
    
                       \Route::is('admin.'.FRONTUSER_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.FRONTUSER_ROUTE_NAME().'create')||
                       \Route::is('admin.'.FRONTUSER_ROUTE_NAME().'edit') 

                   ) {
                      $mainliclass="mm-active";
                      $ulclass="mm-show mm-collapse";

                  }else{
                    $mainliclass="";
                    $ulclass="";
                  }
                @endphp 
                @if(
                    in_array(\App\Models\RightModule::CONST_COUNTRY_SETTING,$moduleData) || 
                    in_array(\App\Models\RightModule::CONST_STATE_SETTING,$moduleData) ||
                    in_array(\App\Models\RightModule::CONST_LOCATION_SETTING,$moduleData) ||
                    in_array(\App\Models\RightModule::CONST_CITY_SETTING,$moduleData) 
                   )
                <li  class="{{$mainliclass}}">
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-current-location"></i>
                        </div>
                        <div class="menu-title">{{trans('message.match_management')}}</div>
                    </a>
                    <ul class="{{$ulclass}}">
                        @if(in_array(\App\Models\RightModule::CONST_LOCATION_SETTING,$moduleData))
                        <li @if(\Route::is('admin.'.MATCH_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.MATCH_ROUTE_NAME().'create')||
                       \Route::is('admin.'.MATCH_ROUTE_NAME().'edit')) class="mm-active" @endif> <a href="{{ route('admin.match.index') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.match')}}</a>
                        </li>
                        @endif

                        @if(in_array(\App\Models\RightModule::CONST_LOCATION_SETTING,$moduleData))
                        <li @if(\Route::is('admin.'.UPCOMING_MATCH_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.UPCOMING_MATCH_ROUTE_NAME().'create')||
                       \Route::is('admin.'.UPCOMING_MATCH_ROUTE_NAME().'edit')) class="mm-active" @endif> <a href="{{ route('admin.upcoming_match.index') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.upcoming_match')}}</a>
                        </li>
                        @endif
                        @if(in_array(\App\Models\RightModule::CONST_COUNTRY_SETTING,$moduleData))
                        <li @if(\Route::is('admin.'.PROMOCODE_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.PROMOCODE_ROUTE_NAME().'create')||
                       \Route::is('admin.'.PROMOCODE_ROUTE_NAME().'edit')) class="mm-active" @endif> <a href="{{ route('admin.promo_code.index') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.promo_code')}}</a>
                        </li>
                        @endif
                        @if(in_array(\App\Models\RightModule::CONST_COUNTRY_SETTING,$moduleData))
                        <li @if(\Route::is('admin.'.CONTEST_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.CONTEST_ROUTE_NAME().'create')||
                       \Route::is('admin.'.CONTEST_ROUTE_NAME().'edit')) class="mm-active" @endif> <a href="{{ route('admin.contest.index') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.contest')}}</a>
                        </li>
                        @endif
                        @if(in_array(\App\Models\RightModule::CONST_CITY_SETTING,$moduleData))
                        <li @if(\Route::is('admin.'.FRONTUSER_ROUTE_NAME().'index') ||
                       \Route::is('admin.'.FRONTUSER_ROUTE_NAME().'create')||
                       \Route::is('admin.'.FRONTUSER_ROUTE_NAME().'edit')) class="mm-active"  @endif > <a href="{{ route('admin.front_user.index') }}"><i class="bx bx-right-arrow-alt"></i>{{trans('message.front_user')}}</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                

                

                @if(in_array(\App\Models\RightModule::CONST_SUPPORT_SETTING,$moduleData))
                <li>
                    <a href="{{route('admin.support.index')}}"  aria-expanded="true">
                        <div class="parent-icon"><i class="bx bx-support"></i>
                        </div>
                        <div class="menu-title">{{trans('message.support_title')}}</div>
                    </a>
                </li>
                @endif
               
            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->