@extends('admin.layouts.master')

@section('title', 'Subscriber Groups')

@section('content')
<div class="col-12">

{{-- create Modal --}}
<div class="modal fade" id="createGroup" tabindex="0" role="dialog">
    <div class="modal-dialog modal-dialog-centered" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title">Create New Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.subscriber.groups.create')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Group Name</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="Group Name" required>
                    </div>
                    <button class="btn btn-success w-100" type="submit">Create Group</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>All Groups</h5>
            <a href="#" data-bs-toggle="modal" data-bs-target="#createGroup" class="btn btn-sm btn-primary">Add Group</a>
        </div>
        <div class="card-body table-responsive">
            @if ($groups->count() > 0)
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Subscribers</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $key => $item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->subscribers->count()}}</td>
                            <td>
                                <div class="div">
                                    <a href="#" data-bs-target="#editGroup{{$item->id}}" data-bs-toggle="modal" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> </a>
                                    <a href="{{route('admin.subscriber.groups.view', $item->code)}}" title="View" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> </a>
                                    <a href="{{route('admin.subscriber.groups.delete', $item->id)}}" title="Delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="editGroup{{$item->id}}" tabindex="0" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" id="modal-size" role="document">
                                <div class="modal-content position-relative">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Group</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('admin.subscriber.groups.edit', $item->id)}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Group Name</label>
                                                <input type="text" name="name" value="{{$item->name}}" class="form-control" placeholder="Group Name" required>
                                            </div>
                                            <button class="btn btn-success w-100" type="submit">Update Group</button>
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
                <p></p>
                <a href="#" data-bs-target="#createGroup" data-bs-toggle="modal" class="btn btn-lg btn-primary">Create New Group</a>
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
