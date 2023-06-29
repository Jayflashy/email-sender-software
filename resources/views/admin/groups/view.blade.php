@extends('admin.layouts.master')

@section('title', 'View Groups')

@section('content')
<div class="col-12">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Group : {{$group->name}}</h5>
            <a href="{{route('admin.subscriber.groups.subscriber', $group->code)}}" class="btn btn-sm btn-primary">Add Subscriber</a>
        </div>
        <div class="card-body table-responsive">
            @if ($group->subscribers->count() > 0)
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($group->subscribers as $key => $item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->last_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>
                                <div class="div">
                                    <a href="#" data-bs-target="#editGroup{{$item->id}}" data-bs-toggle="modal" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> </a>
                                    <a href="{{route('admin.subscriber.groups.subscriber.del',[$group->code, $item->id])}}" title="Delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="editGroup{{$item->id}}" tabindex="0" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" id="modal-size" role="document">
                                <div class="modal-content position-relative">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Subscriber</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('admin.subscriber.edit', $item->id)}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input type="text" name="first_name" value="{{$item->first_name}}" class="form-control" placeholder="First Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <input type="text" name="last_name" value="{{$item->last_name}}" class="form-control" placeholder="LAst Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email Address</label>
                                                <input type="email" name="email" value="{{$item->email}}" class="form-control" placeholder="Email Address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phone Number</label>
                                                <input type="text" name="phone" value="{{$item->phone}}" class="form-control" placeholder="Phone Number">
                                            </div>
                                            <button class="btn btn-success w-100" type="submit">Update Subscriber</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="text-center">
                <img class="img-table" src="https://app.sender.net/img/undraw_blank_canvas.e0d12a7d.svg" alt="">
                <p>No Subscriber Found. Add New Subscriber Below</p>
                <a href="{{route('admin.subscriber.groups.subscriber', $group->code)}}" class="btn btn-lg btn-primary">Add Subscriber</a>
            </div>
            @endif

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
