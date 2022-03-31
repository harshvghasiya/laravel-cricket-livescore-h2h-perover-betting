<!DOCTYPE html>
<html lang="en">
       @include('admin::layouts.head')
  <body>
    <div class="wrapper" >
        @include('admin::layouts.header')
            @include('admin::layouts.sidebar')
                @yield('content')
           @include('admin::layouts.footer')
    </div>
       @include('admin::layouts.javascript')
        @yield('javascript')
       @include('admin::layouts.flashmessage')
  </body>
</html>