<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <link rel="icon"  @if(isset($setting) && $setting !=null) href="{{$setting->getFaviconImageUrl()}}" @endif type="image/png" />
    <!-- loader-->
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/pace.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/app.css" rel="stylesheet">
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/toaster/toastr.css">
    
    <title>{{trans('message.login')}}</title>
  </head>

<body class="bg-login">
  <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            @if(isset($setting) && $setting !=null)<img  src="{{$setting->getLogoImageUrl()}}" width="180" height="120px;" alt="{{$setting->website_title}}" />@endif 
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">{{trans('message.login')}}</h3>
                                        
                                    </div>

                                    <div class="form-body">
                                            {{
                                          Form::open([
                                          'id'=>'FaviconUpdate',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.postlogin'),
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">{{trans('message.email_address_label')}}</label>
                                                <input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="{{trans('message.email_address_label')}}">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">{{trans('message.password_label')}}</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="{{trans('message.password_label')}}"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            @if(isset($setting->is_recaptcha) && $setting->is_recaptcha==1)
                                            <div class="col-12">
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
                                            </div>
                                            @endif
                                            <div class="col-md-12 text-end"> <a href="{{ route('admin.forgot_password_form') }}">{{trans('message.forgot_password_label')}}</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>{{trans('message.login_button_text')}}</button>
                                                </div>
                                            </div>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
  <!--end wrapper-->

  <!--plugins-->

  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/jquery.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/pace.min.js"></script>

     <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/toaster/toastr.min.js"></script>

  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/login_common.js"></script>
    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
       @include('admin::layouts.flashmessage')
    
    <script type="text/javascript">
        $(function(){
            function rescaleCaptcha(){
              var width = $('.g-recaptcha').parent().width();
              var scale;
              if (width < 302) {
                scale = width / 302;
              } else{
                scale = 1.0; 
              }

              $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
              $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
              $('.g-recaptcha').css('transform-origin', '0 0');
              $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
            }

            rescaleCaptcha();
            $( window ).resize(function() { rescaleCaptcha(); });

        });
    </script>
    
</body>

</html>
