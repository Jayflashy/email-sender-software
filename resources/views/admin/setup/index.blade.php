@extends('admin.layouts.master')

@section('title', 'Settings')

@section('content')
<div class="card">
    <div class="card-header h4">Website Information </div>
    <div class="card-body">
        <form action="{{route('admin.setting.update')}}" method="post" class="row">
            @csrf
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Website Name')</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value="{{ get_setting('title') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Website Email')</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" value="{{ get_setting('email') }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Website Phone')</label>
                    <div class="col-sm-9">
                        <input type="tel" name="phone" class="form-control" value="{{ get_setting('phone') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Website About')</label>
                    <div class="col-sm-9">
                        <textarea name="description" rows="3" class="form-control">{{ get_setting('description') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-group mb-0 text-end">
                <button class="btn-success btn btn-block" type="submit">Save Settings</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header h4">Logo/Image Settings</div>
    <div class="card-body">
        <form class="row" action="{{route('admin.setting.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-lg-6">
                <label class="form-label">@lang('Site Logo')</label>
                <div class="col-sm-12 row">
                    <input type="file" class="form-control" name="logo" accept="image/*"/>
                    <img class="primage mt-2" src="{{ my_asset(get_setting('logo'))}}" alt="Site Logo" >
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="form-label">@lang('Favicon')</label>
                <div class="col-sm-12">
                    <input type="file" class="form-control" name="favicon" accept="image/*"/>
                    <img class="primage mt-2" src="{{ my_asset(get_setting('favicon'))}}" alt="Favicon" >
                </div>
            </div>
            {{-- <div class="form-group col-lg-6">
                <label class="form-label">@lang('Touch Icon') <small>(App icon)</small></label>
                <div class="col-sm-12">
                    <input type="file" class="form-control" name="touch_icon" accept="image/*"/>
                    <img class="primage mt-2" src="{{ my_asset(get_setting('touch_icon'))}}" alt="Favicon" >
                </div>
            </div> --}}
            <div class="text-end">
                <button class="btn btn-success btn-block" type="submit">@lang('Update Setting')</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('styles')
<style>
    .img-table{
        height: 300px;
        margin-bottom: 5px;
    }
    .btn-block{
        width: 100%
    }
</style>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        checkMailDriver();
    });
    function checkMailDriver(){
        if($('select[name=MAIL_MAILER]').val() == 'mailgun'){
            $('#mailgun').show();
            $('#smtp').hide();
        }
        else{
            $('#mailgun').hide();
            $('#smtp').show();
        }
    }
</script>
@endsection
