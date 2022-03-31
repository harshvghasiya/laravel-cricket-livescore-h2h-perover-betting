 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" @if(isset($setting) && $setting != null) href="{{$setting->getFaviconImageUrl()}}" @endif type="image/x-icon">
    <link rel="shortcut icon" @if(isset($setting) && $setting != null) href="{{$setting->getFaviconImageUrl()}}" @endif type="image/x-icon">
    <title> @yield('title')</title>
    <!-- Google font-->
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/app.css" rel="stylesheet">
    <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/date-picker.css">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/header-colors.css" />
    <link rel="stylesheet" type="text/css" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/toaster/toastr.css">
    

    @yield('style')
  </head>