<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <link rel="icon" href="{{$setting->getFaviconImageUrl()}}" type="image/png" />
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
                            <img src="{{$setting->getLogoImageUrl()}}" width="180" height="120px;" alt="{{$setting->website_title}}" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">{{trans('message.forget_password')}}</h3>
                                        
                                    </div>

                                    <div class="form-body">
                                            {{
                                          Form::open([
                                          'id'=>'resetPassword',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.forgot_password'),
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">{{trans('message.email_address_label')}}</label>
                                                <input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="{{trans('message.email_address_label')}}">
                                            </div>
                                            @if(isset($setting->is_recaptcha) && $setting->is_recaptcha==1)
                                            <div class="col-12">
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
                                            </div>
                                            @endif
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>{{trans('message.send_reset_link')}}</button>
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
        
    </script>
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
       @include('admin::layouts.flashmessage')
    

</body>

</html>
