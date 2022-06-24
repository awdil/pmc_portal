<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration | Admin Page</title>
    @include('layouts.header_scripts')
</head>
    <body class="">
        <div id="wrapper">
            @include('layouts.side_nav')
            <div id="page-wrapper" class="gray-bg">
                @include('layouts.top_bar')
                @yield('header')
                <div class="wrapper wrapper-content">
                     @include('layouts.flash-message')
                    @yield('content')
                </div>
                @include('layouts.footer')
            </div>
        </div>
        @include('layouts.footer_scripts')
        @stack('footer_scripts')
    </body>
</html>
