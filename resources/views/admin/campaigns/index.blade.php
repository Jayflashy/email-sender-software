@extends('admin.layouts.master')

@section('title', 'Campaigns')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-sm-flex justify-content-between">
            <h5>@yield('title')</h5>
            <a href="{{route('admin.campaigns.create')}}" class="btn btn-sm btn-primary">Add Campaign</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Template</th>
                        <th>Group</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $key => $item)
                        <tr>
                            <td>{{$key + 1}} </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->template->title ?? "Null"}}</td>
                            <td>{{$item->group->name ?? "None"}}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @elseif ($item->status == 2)
                                    <span class="badge bg-warning">Not Sent</span>
                                @elseif ($item->status == 3)
                                    <span class="badge bg-danger">Failed</span>
                                @else
                                    <span class="badge bg-info">Not Sent</span>
                                @endif
                            </td>
                            <td>{{$item->created_at->diffForHumans()}}</td>
                            <td>
                                <div>
                                    <a href="{{route('admin.campaigns.edit', $item->code)}}" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> </a>
                                    <a href="{{route('admin.campaigns.delete', $item->id)}}" title="Delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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
