@extends('admin.layouts.master')

@section('title', 'Select Campaign Template')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs  nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#home" role="tab">Campaign Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#template" role="tab">Template</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#design" role="tab">Design</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#audience" role="tab">Audience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#confirm" role="tab">Send</a>
                </li>
            </ul>
        </div>
        <form class="mt-4 g-1 payments" action="" method="post">
            @csrf
            <div class="text-center my-3">
                <h4 class="fw-bold">Select Template</h4>
            </div>
            <div class="row">
                @foreach ($templates as $template)
                <div class="col-md-6 col-lg-4">
                    <label class="mb-2 pay-option" data-toggle="tooltip" title="{{ $template->title }}">
                        <input type="radio" id="{{$template->slug}}" name="template_id" value="{{ $template->id }}" {{ $campaign->template_id == $template->id ? 'checked' : '' }}>
                        <span>
                            <img class="pay-method tem-img" src="{{ my_asset($template->preview) }}">
                        </span>
                    </label>
                </div>
                @endforeach
            </div>
            <div class="form-group px-5">
                <button class="btn btn-lg btn-success w-100" type="submit">Save and Continue</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('styles')
<style>
    .payments {
        margin-top: 1px;
    }
    .tem-img{
        height: 200px;
        width: 100%;
    }
    .payments>hr {
        margin-bottom: 0;
        margin-top: 0;
    }

    .pay-option {
        position: relative;
        cursor: pointer;
    }

    label.pay-option input {
        opacity: 0;
        /*position: fixed;*/
    }

    label.pay-option {
        position: relative;
        cursor: pointer;
    }

    label.pay-option span {
        display: inline-block;
        border-radius: 9px;
        background: #f6f6f6;
        position: relative;
    }

    .pay-method {
        display: block;
        width: 100%;
    }

    label.pay-option input:checked+span:before {
        position: absolute;
        height: 100%;
        width: 100%;
        background: rgba(255, 255, 255, 0.8);
        content: "";
        top: 0;
        left: 0;
    }

    label.pay-option input:checked+span:after {
        position: absolute;
        content: "";
        left: calc(50% - 6px);
        top: calc(50% - 12px);
        width: 12px;
        height: 24px;
        border: solid #28a745;
        border-width: 0 4px 4px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        box-shadow: 2px 3px 5px rgb(94, 146, 106);
    }

</style>
@endsection
@section('scripts')
<script>
    // Get the select element
    var selectElement = document.getElementById('domainSelect');

    // Add event listener for 'change' event
    selectElement.addEventListener('change', function() {
      // Get the selected option
      var selectedOption = selectElement.options[selectElement.selectedIndex];

      // Get the data attributes of the selected option
      var email = selectedOption.getAttribute('data-email');
      var name = selectedOption.getAttribute('data-name');
      var reply = selectedOption.getAttribute('data-reply');

      // Set the values to the input fields
      document.getElementById('replyTo').value = reply;
      document.getElementById('fromName').value = name;
      document.getElementById('senderEmail').value = email;
    });
  </script>
@endsection
