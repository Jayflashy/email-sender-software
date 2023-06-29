@extends('layouts.auth')
@section('title', 'Login to Account')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-center mt-4">
            <div class="mb-3">
                <a href="{{route('index')}}" class="auth-logo">
                    <img src="{{my_asset(get_setting('logo'))}}" height="30" class="logo-dark mx-auto"
                        alt="">
                    <img src="{{my_asset(get_setting('logo'))}}" height="30" class="logo-light mx-auto"
                        alt="">
                </a>
            </div>
        </div>
        <div class="p-3">
            <h4 class="font-size-18 text-muted mt-2 text-center">Welcome Back !</h4>
            <p class="text-muted text-center mb-4">Sign in to continue to {{get_setting('title')}}.</p>
            @include('alerts.alerts')
            <form class="form-horizontal" action="{{route('login')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="username">Username / Email Address</label>
                    <input type="text" required class="form-control" name="username" value="{{ old('username') }}" autofocus placeholder="Enter username or Email">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="userpassword">Password</label>
                    <input type="password" required class="form-control" name="password" placeholder="Enter password">
                </div>

                <div class="mb-3 row mt-4">
                    <div class="col-sm-6">
                        <div class="form-checkbox">
                            <input type="checkbox" class="form-check-input me-1" name="remember" id="customControlInline" {{ old('remember') ? 'checked' : '' }}">
                            <label class="form-label" class="form-check-label"
                                for="customControlInline">Remember me</label>
                        </div>
                    </div>
                    <div class="col-sm-6 text-end">
                        <button class="btn btn-primary w-100 waves-effect waves-light"
                            type="submit">Log In</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-4">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-muted"><i
                                class="mdi mdi-lock"></i> Forgot your password?</a>
                        @endif

                    </div>
                </div>
            </form>

        </div>

    </div>
</div>
<div class="mt-5 text-center">
    {{-- <p>Don't have an account ? <a href="{{route('register')}}" class="fw-bold text-primary"> Signup
            Now </a> </p> --}}
    <p>©
        <script>document.write(new Date().getFullYear())</script> {{get_setting('title')}}
    </p>
</div>

@endsection
@section('meta')
<!-- Open Graph / Facebook -->
    <meta property="og:type" content="Website" >
    <meta property="og:title" content="@yield('title') - {{get_setting('title')}}" >
    <meta property="og:image" content="{{my_asset(get_setting('logo'))}}" >
    <meta property="og:description" content="Login to your account" >
    <meta property="og:site_name" content="{{get_setting('title') }}" >

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title') - {{get_setting('title')}}">
    <meta name="twitter:description" content="Login to your account">
    <meta name="twitter:image" content="{{ my_asset(get_setting('logo')) }}">
@endsection
