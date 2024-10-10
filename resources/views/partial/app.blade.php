<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>APP REPARATION</title>
        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
        <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon"/>
        <!-- Fonts and icons -->
        <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
        <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function () {
            sessionStorage.fonts = true;
            },
        });
        </script>
        <!-- CSS Files -->
        @include('partial.css')
        @include('partial.js')
    </head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('partial.sidebar')
        <!-- End Sidebar -->
        <div class="main-panel">
            <!-- main-header -->
            @include('partial.main_header')
            <!-- End main-header -->
            <!-- container -->
            <div class="container">
            @yield('content')
            {{-- <!-- End container --> --}}
            {{-- </div> --}}
            @include('partial.footer')
        </div>
        {{-- @include('partial.custome') --}}
    </div>

</body>
</html>
