@extends('admin.layouts.master')

@section('title', 'Campaign Audience')
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
                    <a class="nav-link active" href="{{route('admin.campaigns.audience', $campaign->code)}}" role="tab">Audience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.campaigns.confirm', $campaign->code)}}"role="tab">Send</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="text-center my-3">
                <h4 class="fw-bold">Select Subscribers Group</h4>
            </div>
            <div class="alert alert-danger m-2">
                Please select at least one subscribers group or segment that contains active subscribers.
            </div>
            <form class="mt-4 g-3 row" action="" method="post">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Select Subscribers Group</label>
                        <select name="group_id" id="subGroup" class="form-control" required>
                            <option value="">Select Group</option>
                            @foreach ($audience as $item)
                                <option data-name="{{$item->name}}" data-subdate="{{show_datetime($item->created_at)}}" data-total="{{$item->subscribers->count()}}" value="{{$item->id}}" @if($item->id == $campaign->group_id) selected @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold">Group Details</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Total</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span id="groupName"></span> </td>
                                <td><span id="groupTotal"></span> </td>
                                <td><span id="groupDate"></span> </td>
                            </tr>
                        </tbody>
                    </table>
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
