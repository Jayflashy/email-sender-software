@extends('layouts.auth')
@section('title', 'Registration')
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
            <h4 class="font-size-18 text-muted mt-2 text-center">Free Register</h4>
            <p class="text-muted text-center mb-4">Get your free {{get_setting('title')}} account now.</p>
            @include('alerts.alerts')
            <form class="form-horizontal" action="{{route('register')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="name" name="name" class="form-control" autofocus autocomplete="" required value="{{ old('name') }}" id="name" placeholder="Enter Full Name">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="useremail">Email Address</label>
                    <input type="email" class="form-control" required autocomplete="" name="email" value="{{ old('email') }}" id="useremail" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone">Phone Number</label>
                    <input type="tel" name="phone" autocomplete="" class="form-control" required value="{{ old('phone') }}" id="phone" placeholder="Enter Phone Number">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" class="form-control" name="username" required value="{{ old('username') }}" placeholder="Enter username">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="userpassword">Password</label>
                    <input type="password" class="form-control" name="password" required placeholder="Enter password">
                </div>

                <div class="mb-3 row mt-4">
                    <div class="col-12 text-end">
                        <button class="btn btn-primary w-100 waves-effect waves-light"
                            type="submit">Register</button>
                    </div>
                </div>

                <div class="mt-4 row">
                    <div class="col-12">
                        <p class="text-muted mb-0">By registering you agree to the {{get_setting('title')}} <a
                                href="#">Terms of Use</a></p>
                    </div>
                </div>
            </form>

        </div>

    </div>
</div>
<div class="mt-5 text-center">
    <p>Already have an account ? <a href="{{route('login')}}" class="fw-bold text-primary"> Login </a>
    </p>
    <p>©
        <script>document.write(new Date().getFullYear())</script> {{get_setting('title')}}.
    </p>
</div>

@endsection
@section('meta')
<!-- Open Graph / Facebook -->
    <meta property="og:type" content="Website" >
    <meta property="og:title" content="@yield('title') - {{get_setting('title')}}" >
    <meta property="og:image" content="{{my_asset(get_setting('logo'))}}" >
    <meta property="og:description" content="Create a new account" >
    <meta property="og:site_name" content="{{get_setting('title') }}" >

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title') - {{get_setting('title')}}">
    <meta name="twitter:description" content="Create a new account">
    <meta name="twitter:image" content="{{ my_asset(get_setting('logo')) }}">
@endsection
