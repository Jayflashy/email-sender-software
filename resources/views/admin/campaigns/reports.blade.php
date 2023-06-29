@extends('admin.layouts.master')

@section('title', 'Campaign Reports')

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
                        <th>Sent</th>
                        <th>Delivered</th>
                        <th>Opened Rate</th>
                        <th>Opened</th>
                        <th>Clicks</th>
                        <th>Unique CLicks</th>
                        <th>Date Sent</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $key => $item)
                    @if($item->tracker->count() !=  0)
                        <tr>
                            <td>{{$key + 1}} </td>
                            <td>{{$item->name}}</td>
                            <td>{{ campaignEmailNotOpenedAndNotOpen($item->id) }}</td>
                            <td>
                                <div class="progress" style="height: 30px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{campaignDeliveryRate($item->id) }}%;" aria-valuenow="{{campaignDeliveryRate($item->id) }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ campaignEmailDelivered($item->id) }}/{{ campaignEmailNotOpenedAndNotOpen($item->id) }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="progress " style="height: 30px; color:black;" >
                                    <span class="progress-bar" role="progressbar" style="width: {{ campaignOpenRate($item->id) }}%;" aria-valuenow="{{ campaignOpenRate($item->id) }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ campaignEmailClicked($item->id) }}/{{ campaignEmailNotOpenedAndNotOpen($item->id) }}
                                    </span>
                                </div>
                            </td>
                            <td>{{$item->tracker->sum('open') ?? "0"}}</td>
                            <td>{{$item->tracker->sum('total_clicks') ?? "None"}}</td>
                            <td>{{ campaignEmailUniqueClicks($item->id) }}</td>
                            <td>{{show_datetime($item->send_date)}}</td>
                            <td>
                                <div>
                                    <a href="{{route('admin.campaigns.edit', $item->code)}}" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> </a>
                                    <a href="{{route('admin.campaigns.delete', $item->id)}}" title="Delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
