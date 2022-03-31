
<!doctype html>
<html lang="en">

@include('layout.head')

<body>
    <!-- start preloader -->
    {{-- <div class="preloader" id="preloader"></div> --}}
    <!-- end preloader -->

    <!-- Scroll To Top Start-->
    <a href="javascript:void(0)" class="scrollToTop"><i class="fas fa-angle-double-up"></i></a>
    <!-- Scroll To Top End -->

    <!-- header-section start -->
    @include('layout.header')
    <!-- header-section end -->

    @yield('content')

    <!-- Footer Area Start -->
    @include('layout.footer')
    <!-- Footer Area End -->

    <!--==================================================================-->
    @include('layout.javascript')
    @include('layout.flashmessage')
</body>

</html>