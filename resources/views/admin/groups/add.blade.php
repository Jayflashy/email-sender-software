@extends('admin.layouts.master')

@section('title', 'Add Subscribers to '.$group->name)

@section('content')
<div class="col-12">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" data-bs-toggle="tab" href="#importFile" role="tab" aria-selected="true">Import from File</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#addManual" role="tab" aria-selected="false" tabindex="-1">Add Manually</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane p-3 active show" id="importFile" role="tabpanel">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h5>Upload subscribers from file. </h5>
                                <p class="my-0"> Choose file from your computer.(csv, xlsx, txt) </p>
                                <form action="{{route('admin.subscriber.groups.subscriber', $group->code)}}" method="POST" enctype="multipart/form-data" class="text-center">
                                    @csrf
                                    <input type="hidden" name="add_type" value="file_upload">
                                    <div class="form-group">
                                        <label for="">Select File</label>
                                        <input class="form-control" accept=".csv,.xlsx,.txt" name="file" type="file" autocomplete="off" required>
                                    </div>
                                    <button type="submit" class="mb-0 btn btn-primary waves-effect waves-light">Import File</button>
                                </form>

                             </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                    <div class="card-body table-responsive">
                        <div class="card-title">
                           <h5> List example </h5>
                           <p class="my-0"> Each subscriber must be in a new row, subscriber fields must be in separate columns </p>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>A</th>
                                    <th>B</th>
                                    <th>C</th>
                                    <th>D</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Email address</td>
                                    <td>First name</td>
                                    <td>Last name</td>
                                    <td>Phone</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>charleslkelly@sender.net</td>
                                    <td>Charles</td>
                                    <td>Kelly</td>
                                    <td>1234567221</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>davidlambert@sender.net</td>
                                    <td>David</td>
                                    <td>Lambert</td>
                                    <td>0981231123</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane p-3" id="addManual" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Copy/Paste subscribers list</h5>
                        <p class="my-0">Paste your list below. <b> Each subscriber must be on a new line </b>
                        </p>
                        <p class="fw-bolder text-info">FORMAT: Email address, First Name, Last Name, Phone Number</p>
                    </div>
                    <form action="{{route('admin.subscriber.groups.subscriber', $group->code)}}" method="POST" enctype="multipart/form-data" class="">
                        @csrf
                        <input type="hidden" name="add_type" value="manual_upload">
                        <div class="form-group">
                            <textarea name="subscribers" class="form-control" id="" cols="30" rows="10" placeholder="Email address, First Name, Last Name,Phone Number
Email address, First Name, Last Name, Phone Number"></textarea>
                        </div>
                        <button class="btn btn-success btn-lg mt-2" type="submit">Submit</button>
                    </form>
                </div>
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

<script src="{{static_asset('libs/dropzone/min/dropzone.min.js')}}"></script>
@endsection
