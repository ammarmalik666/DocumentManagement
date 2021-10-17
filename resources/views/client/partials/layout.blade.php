<html lang="en">
    <head>
        <meta charset="utf-8" />
        @yield('meta')
        <base href="/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        @include('client.partials.head_css')
        @yield('extra_css')
    </head>
    <body data-sidebar="dark">
        <div id="layout-wrapper">
            @include('client.partials.header')
            @include('client.partials.sidebar')

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('main_content')
                    </div>
                </div>
                @include('client.partials.footer')
            </div>
        </div>
        <script src="/assets/libs/jquery/jquery.min.js"></script>
        @include('client.partials.scripts')
        @yield('extra_js')
        <script src="/assets/js/app.js"></script>
    </body>
</html>