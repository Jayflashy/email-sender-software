@extends('admin.layouts.master')

@section('title', 'Create Domains')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.domains.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Short Name" required>
                </div>
                <div class="form-group">
                    <label for="">Email Address</label>
                    <input type="email" class="form-control" name="email" id="name" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <label for="">Mail From</label>
                    <input type="text" name="from_name" class="form-control" id="name" placeholder="Mail From Name" required>
                </div>
                <div class="form-group">
                    <label for="">Reply Email</label>
                    <input type="email" name="reply_to" class="form-control" id="name" placeholder="Reply Email" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-success w-100" type="submit">Add Domain</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
