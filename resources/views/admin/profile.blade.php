@extends('admin.layouts.master')
@section('title', 'Edit Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 form-label" for="name">{{__('Name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" value="{{Auth::user()->name}}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 form-label" for="name">Username</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Username" id="name" name="username" class="form-control" value="{{Auth::user()->username}}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 form-label" for="email">{{__('Email Address')}}</label>
                        <div class="col-sm-9">
                            <input type="email" placeholder="{{__('Email Address')}}" id="email" name="email" class="form-control" value="{{Auth::user()->email}}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 form-label" for="password">{{__('Password')}}</label>
                        <div class="col-sm-9">
                            <input type="password" placeholder="{{__('Password')}}" id="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group mb-3 text-end">
                        <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('breadcrumb')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">@yield('title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
@endsection
