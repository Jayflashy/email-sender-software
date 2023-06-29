@extends('admin.layouts.master')

@section('title', 'Edit Campaign')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs  nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">Campaign Details</a>
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
                    <a class="nav-link" href="{{route('admin.campaigns.confirm', $campaign->code)}}"role="tab">Send</a>
                </li>
            </ul>
        </div>
        <form class="row" action="{{route('admin.campaigns.update', $campaign->id)}}" method="post">
            @csrf
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Campaign Setup</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Campaign Name</label>
                            <input type="text" name="name" value="{{$campaign->name}}" class="form-control" id="name" placeholder="Campaign Name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email Subject</label>
                            <input type="text" name="subject" value="{{$campaign->subject}}" class="form-control" id="subject" placeholder="Email Subject" required>
                        </div>
                        <div>
                            <h6 class="fw-bold">Shortcodes</h6>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ShortCodes</th>
                                        <th>Values</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{first_name}</td>
                                        <td>First Name</td>
                                    </tr>
                                    <tr>
                                        <td>{last_name}</td>
                                        <td>Last Name</td>
                                    </tr>
                                    <tr>
                                        <td>{email}</td>
                                        <td>Email Address</td>
                                    </tr>
                                    <tr>
                                        <td>{phone_number}</td>
                                        <td>Phone Number</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Domain Selection</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Select Domain</label>
                            <select name="domain_id" id="domainSelect" class="form-select">
                                <option value="">Select Domain</option>
                                @foreach ($domains as $key => $item)
                                    <option data-reply="{{$item->reply_to}}" data-email="{{$item->email}}" data-name="{{$item->from_name}}" value="{{$item->id}}" @if($campaign->domain_id == $item->id) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">From Name</label>
                            <input type="text" name="from_name" value="{{$campaign->from_name, old('from_name')}}" class="form-control" id="fromName" placeholder="Mail From Name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Sender Email Address</label>
                            <input type="email" name="email" value="{{$campaign->email, old('email')}}" class="form-control" id="senderEmail" placeholder="Sender Email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Reply To Email</label>
                            <input type="email" name="reply_to" value="{{$campaign->reply_to, old('reply_to')}}" class="form-control" id="replyTo" placeholder="Reply To Email" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group px-5">
                <button class="btn btn-lg btn-success w-100" type="submit">Save and Continue</button>
            </div>
        </form>
    </div>
</div>
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
