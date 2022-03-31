<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/fav.png" type="image/x-icon">
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/css/nice-select.css">
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/css/slick.css">
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/css/arafat-font.css">
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/css/animate.css">
    <link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/css/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/toaster/toastr.css">
    @yield('style')
</head>