<!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">
                        <div class="position-relative search-bar-box">
                            <form method="get" action="{{route('admin.search.search')}}">
                            <input type="text" name="search" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                            <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                            </form>
                        </div>
                    </div>
                   <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item mobile-search-icon">
                                <a class="nav-link" href="#">   <i class='bx bx-search'></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class='bx bx-category'></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="row row-cols-3 g-3 p-3">
                                        <div class="col text-center">
                                            <div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-group'></i>
                                            </div>
                                            <div class="app-title">Teams</div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bx-atom'></i>
                                            </div>
                                            <div class="app-title">Projects</div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="app-box mx-auto bg-gradient-lush text-white"><i class='bx bx-shield'></i>
                                            </div>
                                            <div class="app-title">Tasks</div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class='bx bx-notification'></i>
                                            </div>
                                            <div class="app-title">Feeds</div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
                                            </div>
                                            <div class="app-title">Files</div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="app-box mx-auto bg-gradient-moonlit text-white"><i class='bx bx-filter-alt'></i>
                                            </div>
                                            <div class="app-title">Alerts</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large ">
                                <a class="nav-link dropdown-toggle  dropdown-toggle-nocaret position-relative  "  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count not_co">@if($panel_activity != null && $panel_activity->count() <9){{$panel_activity->count()}}@else 9+ @endif</span>
                                    <i class='bx bx-bell '></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">{{trans('message.notifications')}}</p>
                                            <p class="msg-header-clear ms-auto notifications">{{trans('message.mark_all_as_read')}}</p>
                                        </div>
                                    </a>
                                    <div class="header-notifications-list">
                                        @if(isset($panel_activity) && !$panel_activity->isEmpty())
                                        @foreach($panel_activity as $key=>$value)
                                        <a class="dropdown-item" href="{{route('admin.panel_activity.see_detail',$value->slug)}}">
                                            <div class="d-flex align-items-center">
                                                @if($value->slug==MODULE_ROUTE_NAME())
                                                <div class="notify bg-light-primary text-success">
                                                    
                                                    <i class="bx bx-file"></i>
                                                    
                                                </div>
                                                @elseif($value->slug==COMPANY_ROUTE_NAME() || $value->slug==COMPANY_CATEGORY_ROUTE_NAME())
                                                <div class="notify bg-light-primary text-info">
                                                    
                                                    <i class="bx bx-category"></i>
                                                    
                                                </div>
                                                @elseif($value->slug==COUNTRY_ROUTE_NAME() || $value->slug ==STATE_ROUTE_NAME() || $value->slug == CITY_ROUTE_NAME())
                                                <div class="notify bg-light-primary text-danger">
                                                    
                                                    <i class="bx bx-map-alt"></i>
                                                    
                                                </div>
                                                @elseif($value->slug==EMAIL_TEMPLATE_ROUTE_NAME() )
                                                <div class="notify bg-light-primary text-warning">
                                                    
                                                    <i class="bx bx-mail-send"></i>
                                                    
                                                </div>
                                                @else
                                                <div class="notify bg-light-primary text-primary">
                                                    
                                                    <i class="bx bx-group"></i>
                                                    
                                                </div>
                                                @endif
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">{{$value->description}}<span class="msg-time float-end">{{\Carbon\Carbon::parse($value->created_at)->diffForHumans()}}</span></h6>
                                                    <p class="msg-info">{{trans('message.by')}} - {{$value->user_data->name}}</p>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                        @else
                                         <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">{{trans('message.no_notifications')}}</h6>
                                                   
                                                </div>
                                            </div>
                                        </a>
                                        @endif
                                    </div>
                                    <a href="{{route('admin.panel_activity.all_notifications')}}">
                                        <div class="text-center msg-footer">{{trans('message.view_all_notifications')}}</div>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">@if(isset($support_data) && $support_data != null && $support_data->count() <9){{$support_data->count()}}@else 9+ @endif</span>
                                    <i class='bx bx-comment'></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">{{trans('message.queries')}}</p>
                                            <p class="msg-header-clear ms-auto support_see">{{trans('message.mark_all_as_read')}}</p>
                                        </div>
                                    </a>
                                    <div class="header-message-list">
                                        @if(isset($support_data) && !$support_data->isEmpty() )

                                        @foreach($support_data as $key=>$value)
                                        <a class="dropdown-item" href="{{route('admin.support.view',Crypt::encrypt($value->id))}}">
                                            <div class="d-flex align-items-center">
                                                <div class="{{-- user-online --}}">
                                                    <img  src="{{$value->user_data->getAdminUserImageUrl()}}" class="msg-avatar" alt="{{$value->name}}">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">{{$value->user_data->name}} <span class="msg-time float-end">{{\Carbon\Carbon::parse($value->created_at)->diffForHumans()}}</span></h6>
                                                    <p class="msg-info">{!! $value->subject !!}</p>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                        @else
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">No Queries Found </h6>
                                                </div>
                                            </div>
                                        </a>
                                        @endif
                                       
                                    </div>
                                    <a href="{{route('admin.support.index')}}">
                                        <div class="text-center msg-footer">{{trans('message.view_all_queries')}}</div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user() != null)
                            <img src="{{AUth::user()->getAdminUserImageUrl()}}" class="user-img" alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{Auth::user()->name}}</p>
                                <p class="designattion mb-0">@if(Auth::user()->admin_right != null){{Auth::user()->admin_right->name}} @endif</p>
                            </div>
                            @endif
                        </a>

                        <?php 
   
                           $moduleData = \App\Models\RightModule::where('right_id',\Auth::user()->right_id)->pluck('module_id')->toArray();
                        ?>

                        <ul class="dropdown-menu dropdown-menu-end">
                            
                            @if(in_array(\App\Models\RightModule::CONST_PROFILE_SETTING,$moduleData))
                            <li><a class="dropdown-item" href="{{route('admin.admin_user.profile')}}"><i class="bx bx-user"></i><span>{{trans('message.profile')}}</span></a>
                            </li>
                            @endif
                            
                            @if(in_array(\App\Models\RightModule::CONST_CHANGE_PASSWORD_SETTING,$moduleData))
                            <li><a class="dropdown-item" href="{{route('admin.admin_user.change_password')}}"><i class="bx bx-lock"></i><span>{{trans('message.change_password')}}</span></a>
                            </li>
                            @endif

                            <li><a class="dropdown-item" href="{{route('admin.dashboard')}}"><i class='bx bx-home-circle'></i><span>{{trans('message.dashboard')}}</span></a>
                            </li>
                            
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class='bx bx-log-out-circle'></i><span>{{trans('message.logout')}}</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->