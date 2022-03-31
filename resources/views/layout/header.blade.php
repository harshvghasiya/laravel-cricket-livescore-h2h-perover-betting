<header class="header-section">
        <div class="overlay">
            <div class="container">
                <div class="row d-flex header-area">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{route('front.home')}}">
                            {{-- <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/logo.png" class="logo" alt="logo"> --}}
                            <p>Khelo Indian</p>
                        </a>
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbar-content">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbar-content">
                            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{route('front.home')}}">Home</a>
                                </li>
                                
                                
                                @if(Auth::guard('front_user')->user() !=null)
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{route('front.match.upcoming_match')}}">Schedule</a>
                                </li>
                                <li class="nav-item dropdown main-navbar">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                        data-bs-toggle="dropdown" data-bs-auto-close="outside">Dashboard</a>
                                    <ul class="dropdown-menu main-menu shadow">
                                        <li><a class="nav-link" href="{{route('front.auth.dashboard')}}">Dashboard</a></li>
                                        <li><a class="nav-link" href="{{route('front.auth.dashboard')}}">Top Up History</a></li>
                                        <li class="dropend sub-navbar">
                                            <a href="javascript:void(0)" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown"
                                              data-bs-auto-close="outside">Setting</a>
                                            <ul class="dropdown-menu sub-menu shadow">
                                                <li><a class="nav-link" href="{{route('front.auth.change_password')}}">Change Password</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('front.logout')}}">Logout</a>
                                </li>
                                @endif
                            </ul>
                            @if(Auth::guard('front_user')->user() ==null)
                            <div class="right-area header-action d-flex align-items-center max-un">
                                <button type="button" class="login cmn-btn" data-bs-toggle="modal" data-bs-target="#loginMod">
                                    Login
                                </button>
                                
                            </div>
                           
                            
                            @endif
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

      <!-- Login Registration start -->
    <div class="log-reg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="modal fade" id="loginMod">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <ul class="nav log-reg-btn justify-content-around">
                                    
                                    <li class="bottom-area" role="presentation">
                                        <button class="nav-link active" id="loginArea-tab" data-bs-toggle="tab"
                                            data-bs-target="#loginArea" type="button" role="tab"
                                            aria-controls="loginArea" aria-selected="true">
                                            LOGIN
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="loginArea" role="tabpanel"
                                        aria-labelledby="loginArea-tab">
                                        <div class="login-reg-content">
                                            <div class="modal-body">
                                                <div class="head-area">
                                                    <h6 class="title">Login To Bet</h6>
                                                    
                                                </div>
                                                <div class="form-area">
                                                    <form action="{{route('front.login')}}" class="FromSubmit">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="single-input">
                                                                    <label for="logemail">User Name</label>
                                                                    <input type="text" name="name" id="logemail"
                                                                        placeholder="User Name">
                                                                </div>
                                                                <div class="single-input">
                                                                    <label for="logpassword">Password</label>
                                                                    <input type="text" name="password" id="logpassword"
                                                                        placeholder="Email Password">
                                                                </div>
                                                            </div>
                                                            
                                                            <span class="btn-border w-100">
                                                                <button class="cmn-btn w-100">LOGIN</button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                    <div class="bottom-area text-center">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Registration end -->