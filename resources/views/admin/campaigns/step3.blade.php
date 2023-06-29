@extends('admin.layouts.master')

@section('title', 'Design Campaign')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs  nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#home" role="tab">Campaign Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.campaigns.template', $campaign->code)}}" role="tab">Template</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"href="{{route('admin.campaigns.design', $campaign->code)}}" role="tab">Design</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.campaigns.audience', $campaign->code)}}" role="tab">Audience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.campaigns.confirm', $campaign->code)}}"role="tab">Send</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <form class="mt-4 g-1 row" action="" method="post">
                @csrf
                <div class="text-center my-3">
                    <h4 class="fw-bold">Design Campaign</h4>
                </div>
                <div class="form-group">
                    <label for="">Email Subject</label>
                    <input type="text" name="subject" class="form-control" value="{{$campaign->subject}}">
                </div>
                <div class="form-group">
                    <label for="qq">Available Shortcodes</label>
                    <span class="form-control form-control-lg fw-bold"> {site_name}, {site_link}, {first_name}, {last_name}, {email}, {phone_number}, {unsubscribe_link}</span>
                </div>

                <div class="form-group">
                    <label for="">Email Content</label>
                    <textarea name="body" id="summernote" class="form-control" cols="30" rows="10">{!! $campaign->body !!}</textarea>
                </div>


                <div class="form-group px-5">
                    <button class="btn btn-lg btn-success w-100" type="submit">Save and Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{static_asset('summer/summernote-lite.css')}}">
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ static_asset('summer/summernote-lite.js') }}"></script>
<script>
    $(document).ready(function() {
  $('#summernote').summernote({
    height:500
  });
});
</script>
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
