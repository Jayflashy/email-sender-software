<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{get_setting('title')}}</title>

    <meta name="title" content=" @yield('title') - {{get_setting('title')}}">
    <meta name="description" content="{{get_setting('description')}}">
    <meta name="keywords" content="{{get_setting('description')}}">
    <link rel="shortcut icon" href="{{ my_asset(get_setting('favicon'))}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ my_asset(get_setting('favicon'))}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="@yield('title') - {{get_setting('title')}}">
    @yield('meta')
    <!-- Bootstrap Css -->
    <link href="{{static_asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{static_asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{static_asset('css/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{static_asset('css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    {{-- custom files --}}
    @yield('styles')

</head>
<body class="account-bg">
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{static_asset('libs/jquery/jquery.min.js')}}"></script>
    <script src="{{static_asset('libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{static_asset('libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{static_asset('libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{static_asset('libs/node-waves/waves.min.js')}}"></script>

    <script src="{{static_asset('js/app.js')}}"></script>
    <script src="{{static_asset('js/snackbar.min.js')}}"></script>
    @yield('scripts')
    <script type="text/javascript">

        @if(Session::get('success'))
        Snackbar.show({
            text: '{{Session::get('success')}}',
            pos: 'top-right',
            backgroundColor: '#38c172'
        });
        @endif
        @if(Session::get('error'))
        Snackbar.show({
            text: '{{Session::get('error')}}',
            pos: 'top-right',
            backgroundColor: '#e3342f'
        });
        @endif
    </script>
</body>
</html>
