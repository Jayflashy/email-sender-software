<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Invoice Detail </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Jayflash" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{static_asset('user/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{static_asset('user/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{static_asset('user/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{static_asset('user/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    @yield('styles')

</head>

<body data-sidebar="dark">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">
        {{-- Header --}}
        @include('user.layouts.header')

        {{-- Sidebar --}}
        @include('user.layouts.side')
        {{-- Page Content --}}
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            ©
                            <script>document.write(new Date().getFullYear())</script> Fonik<span class="d-none d-sm-inline-block"> -
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by Jadesdev.</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>


    <!-- JAVASCRIPT -->
    <script src="{{static_asset('user/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{static_asset('user/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{static_asset('user/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{static_asset('user/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{static_asset('user/libs/node-waves/waves.min.js')}}"></script>

    <script src="{{static_asset('user/js/app.js')}}"></script>
    @yield('scripts')
</body>
</html>
