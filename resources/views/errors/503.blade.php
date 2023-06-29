@extends('errors.layouts')
@section('title', "Site Under Maintenance")
@section('content')
<div class="col-lg-12">
    <div class="text-center my-5">
        <h1 class="fw-bold text-error">5 <span class="error-text">0<img src="{{static_asset('img/error-img.png')}}" alt="error-img" class="error-img"></span> 3</h1>
        <h3 class="text-uppercase">Site Under Maintenance</h3>
        <p>
            We're currently performing scheduled maintenance on our website. We apologize for any inconvenience this may cause.
          </p>
          <p>
            We expect to be back up and running within the hour. In the meantime, you can check our social media pages for updates.
          </p>
          <p>
            Thank you for your patience.
          </p>
        <div class="mt-5 text-center">
            <a class="btn btn-primary waves-effect waves-light" href="{{route('index')}}">Back to Homepage</a>
        </div>
    </div>
</div>
@endsection
