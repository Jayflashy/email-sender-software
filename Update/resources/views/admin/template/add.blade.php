@extends('admin.layouts.master')

@section('title', 'Add New Template')

@section('content')
<div class="col-12">
<div class="card">
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Template Title</label>
                        <input type="text" name="title" id="" class="form-control" required placeholder="Template title">
                    </div>
                    <div class="form-group">
                        <label for="">Preview Image</label>
                        <input onchange="preview_picture(event)" type="file" accept="image/*" name="preview" id="" class="form-control" placeholder="Template title">
                        <img id="pimage" class="d-none kyc-image mt-2"/>
                    </div>
                </div>
                <div class="col-md-6">
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
                                    <td>{site_name}</td>
                                    <td>Site Name</td>
                                </tr>
                                <tr>
                                    <td>{site_link}</td>
                                    <td>Site Link</td>
                                </tr>
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
            <div class="form-group">
                <label for="">Template Content</label>
                <textarea name="html" id="summernote" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
                <button class="btn-success btn w-100">Create Template</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('styles')
<style>
    .kyc-image{
        height: 300px;
        margin-bottom: 5px;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{static_asset('summer/summernote-lite.css')}}">
@endsection
@section('scripts')
<script>
    function preview_picture(event)
    {
        document.getElementById('pimage').classList.remove('d-none');
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('pimage');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ static_asset('summer/summernote-lite.js') }}"></script>
<script>
    $(document).ready(function() {
  $('#summernote').summernote({
    height:500
  });
});
</script>
<script src="{{static_asset('libs/dropzone/min/dropzone.min.js')}}"></script>
@endsection
