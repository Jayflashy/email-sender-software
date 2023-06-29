@extends('admin.layouts.master')

@section('title', 'Domains ')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-sm-flex justify-content-between">
            <h5>@yield('title')</h5>
            <a href="{{route('admin.domains.create')}}" class="btn btn-sm btn-primary">Add Domain</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mail From</th>
                        <th>Email Address</th>
                        <th>Reply To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($domains as $key => $item)
                        <tr>
                            <td>{{$key + 1}} </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->from_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->reply_to}}</td>
                            <td>
                                <div>
                                    <a href="{{route('admin.domains.edit', $item->id)}}" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> </a>
                                    <a href="{{route('admin.domains.delete', $item->id)}}" title="Delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
