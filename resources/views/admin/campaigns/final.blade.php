@extends('admin.layouts.master')

@section('title', 'Confirm Campaign')
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs  nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#home" role="tab">Campaign Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.campaigns.template', $campaign->code)}}" role="tab">Template</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"href="{{route('admin.campaigns.design', $campaign->code)}}" role="tab">Design</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.campaigns.audience', $campaign->code)}}" role="tab">Audience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin.campaigns.confirm', $campaign->code)}}"role="tab">Send</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class=" my-3 d-flex justify-content-between">
                <h4 class="fw-bold">Confirm and Send</h4>
                <a href="{{route('admin.campaigns.send', $campaign->code)}}" class="btn btn-primary">Send Now</a>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="border border-secondary p-2">
                        <h5 class="fw-bold">Details</h5>
                        <div class="group">
                            <h6 class="text-muted">Title</h6>
                            <p>{{$campaign->name}}</p>
                        </div>
                        <div class="group">
                            <h6 class="text-muted">Subject</h6>
                            <p>{{$campaign->subject}}</p>
                        </div>
                        <div class="group">
                            <h6 class="text-muted">Audience</h6>
                            <p>{{$campaign->group->subscribers->count()}}</p>
                        </div>
                        <hr>
                        <h5 class="fw-bold">Settings</h5>
                        <div class="group">
                            <h6 class="text-muted">Mail From</h6>
                            <p>{{$campaign->from_name}}</p>
                        </div>
                        <div class="group">
                            <h6 class="text-muted">Send Email</h6>
                            <p>{{$campaign->email}}</p>
                        </div>
                        <div class="group">
                            <h6 class="text-muted">Reply To</h6>
                            <p>{{$campaign->reply_to}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 border border-secondary p-2">
                    <h5 class="fw-bold">Preview</h5>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#previewModal" class="btn btn-primary">Preview Message</a>
                    <div class="modal fade" id="previewModal" tabindex="0" role="dialog">
                        <div class="modal-dialog modal-lg modal-dialog-centered" id="modal-size" role="document">
                            <div class="modal-content position-relative">
                                <div class="modal-header">
                                    <h5 class="modal-title">Preview Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {!!$campaign->body !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group mt-2">
                        <h6 class="text-muted">Email Sent At </h6>
                        <p>{{show_datetime($campaign->send_date)}}</p>
                    </div>
                    <div class="group">
                        <h6 class="text-muted mb-0">Status</h6>
                        @if($campaign->status == 1)
                            <span class="badge bg-success">Email Sent</span>
                        @elseif ($campaign->status == 2)
                            <span class="badge bg-warning">Not Sent</span>
                        @elseif ($campaign->status == 3)
                            <span class="badge bg-danger">Failed</span>
                        @else
                            <span class="badge bg-info">Not Sent</span>
                        @endif
                    </div>
                    <hr class="my">
                    <h5 class="fw-bold">Send Email</h5>
                    <form class="mb-2 row" method="POST" action="{{route('admin.campaigns.sendtest', $campaign->code)}}">
                        @csrf
                        <h6 class="text-muted">Send Test Email</h6>
                        <div class="col-9 col-md-10">
                            <input type="email" name="test_email" id="" required class="form-control" placeholder="Write Test Email">
                        </div>
                        <div class="col-3 col-md-2">
                            <button type="submit" class="btn btn-success">Send</button>
                        </div>
                    </form>
                    <div class="group">
                        <h6 class="text-muted">Send Email</h6>
                        <a href="{{route('admin.campaigns.send', $campaign->code)}}" class="btn btn-primary">Send to Subscribers</a>
                    </div>
                </div>
            </div>

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
    var selectElement = document.getElementById('subGroup');

    // Add event listener for 'change' event
    selectElement.addEventListener('change', function() {
      // Get the selected option
      var selectedOption = selectElement.options[selectElement.selectedIndex];

      // Get the data attributes of the selected option
      var subdate = selectedOption.getAttribute('data-subdate');
      var total = selectedOption.getAttribute('data-total');
      var name = selectedOption.getAttribute('data-name');
        // console.log(subdate, name, total)
      // Set the values to the input fields
      document.getElementById('groupDate').innerHTML = subdate;
      document.getElementById('groupName').innerHTML = name;
      document.getElementById('groupTotal').innerHTML = total;
    });
  </script>
@endsection
