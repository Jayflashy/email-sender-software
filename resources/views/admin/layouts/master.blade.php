<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{get_setting('title')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{get_setting('about')}}" name="description" />
    <meta content="Jayflash" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{static_asset('images/favicon.ico')}}">

    <!-- DataTables -->
    <link href="{{static_asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{static_asset('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{static_asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{static_asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{static_asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{static_asset('css/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{static_asset('css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    @yield('styles')
    <style>
        .form-group{margin-bottom: 15px}
    </style>
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
        @include('admin.layouts.header')

        {{-- Sidebar --}}
        @include('admin.layouts.side')
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
                            <script>document.write(new Date().getFullYear())</script> {{get_setting('title')}}<span class="d-none d-sm-inline-block"> -
                                Crafted with <i class="mdi mdi-heart text-danger"></i>.</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>


    <!-- JAVASCRIPT -->
    <script src="{{static_asset('libs/jquery/jquery.min.js')}}"></script>
    <script src="{{static_asset('libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{static_asset('libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{static_asset('libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{static_asset('libs/node-waves/waves.min.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{static_asset('libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{static_asset('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{static_asset('libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{static_asset('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{static_asset('js/app.js')}}"></script>
    <script src="{{static_asset('js/snackbar.min.js')}}"></script>
    <script src="{{static_asset('js/pages/datatables.init.js')}}"></script>
    @yield('scripts')
    <script type="text/javascript">
        @if(Session::get('success'))
        Snackbar.show({
          text: '{{Session::get('success')}}',
          pos: 'top-right',
          backgroundColor: '#38c172'
        });
        @endif
        @if(count($errors) > 0)
        Snackbar.show({
          @foreach($errors->all() as $error)
          text: '{{$error}}',
              @endforeach
          pos: 'top-right',
          backgroundColor: '#e3342f'
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
