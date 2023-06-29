@extends('admin.layouts.master')

@section('title', 'Email Settings')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <h5 class="card-header">SMTP Settings</h5>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.setting.env_key') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="MAIL_MAILER">
                        <label class="col-md-4 col-form-label">Type</label>
                        <div class="col-md-8">
                            <select class="form-control form-select mb-2 mb-md-0" name="MAIL_MAILER" onchange="checkMailDriver()">
                                <option value="sendmail" @if(env('MAIL_MAILER') == 'sendmail') selected @endif>Sendmail</option>
                                <option value="smtp" @if(env('MAIL_MAILER') == 'smtp') selected @endif>SMTP</option>
                                <option value="mailgun" @if(env('MAIL_MAILER') == 'mailgun') selected @endif >Mailgun</option>
                            </select>
                        </div>
                    </div>
                    <div id="smtp">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_HOST">
                            <div class="col-md-4">
                                <label class="form-label">{{__('MAIL HOST')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MAIL_HOST" value="{{  env('MAIL_HOST') }}" placeholder="{{__('MAIL HOST')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_PORT">
                            <div class="col-md-4">
                                <label class="form-label">{{__('MAIL PORT')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MAIL_PORT" value="{{  env('MAIL_PORT') }}" placeholder="{{__('MAIL PORT')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_USERNAME">
                            <div class="col-md-4">
                                <label class="form-label">{{__('MAIL USERNAME')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MAIL_USERNAME" value="{{  env('MAIL_USERNAME') }}" placeholder="{{__('MAIL USERNAME')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                            <div class="col-md-4    ">
                                <label class="form-label">{{__('MAIL PASSWORD')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="MAIL_PASSWORD" value="{{  env('MAIL_PASSWORD') }}" placeholder="{{__('MAIL PASSWORD')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                            <div class="col-md-4">
                                <label class="form-label">{{__('MAIL ENCRYPTION')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{  env('MAIL_ENCRYPTION') }}" placeholder="{{__('MAIL ENCRYPTION')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                            <div class="col-md-4">
                                <label class="form-label">{{__('MAIL FROM ADDRESS')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{  env('MAIL_FROM_ADDRESS') }}" placeholder="{{__('MAIL FROM ADDRESS')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                            <div class="col-md-4">
                                <label class="form-label">{{__('MAIL FROM NAME')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{  env('MAIL_FROM_NAME') }}" placeholder="{{__('MAIL FROM NAME')}}">
                            </div>
                        </div>
                    </div>
                    <div id="mailgun">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                            <div class="col-md-4">
                                <label class="col-from-label">MAILGUN DOMAIN</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MAILGUN_DOMAIN" value="{{env('MAILGUN_DOMAIN')}}" placeholder="MAILGUN DOMAIN">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label">MAILGUN SECRET</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MAILGUN_SECRET" value="{{env('MAILGUN_SECRET')}}" placeholder="MAILGUN SECRET">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-end">
                        <button type="submit" class="btn btn-primary w-100">Save Configuration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{__('Test SMTP configuration')}}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.email.test') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="email" class="form-control" name="email"  placeholder="{{ __('Enter your email address') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Send test email') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{__('Test SMTP configuration')}}</h5>
                <p class="mb-0">Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver</p>
            </div>
            <div class="card-body">
                <b>{{ __('For Non-SSL') }}</b>
                <ul class="list-group">
                    <li class="list-group-item">{{__('Set Mail Host according to your server Mail Client Manual Settings')}}</li>
                    <li class="list-group-item">{{__("Set Mail port as 587")}}</li>
                    <li class="list-group-item">{{__("Set Mail Encryption as 'ssl' if you face issue with tls")}}</li>
                </ul>
                <br>
                <b>{{ __('For SSL') }}</b>
                <ul class="list-group">
                    <li class="list-group-item">{{__('Set Mail Host according to your server Mail Client Manual Settings')}}</li>
                    <li class="list-group-item">{{__('Set Mail port as 465')}}</li>
                    <li class="list-group-item">{{__('Set Mail Encryption as ssl')}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<style>
    .img-table{
        height: 300px;
        margin-bottom: 5px;
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
