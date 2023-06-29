@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Campaigns</h4>
                <h4 class="mt-3 mb-2"><b>{{($campaigns->count())}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Subscribers</h4>
                <h4 class="mt-3 mb-2"><b>{{App\Models\Subscriber::where('status', 1)->count()}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Groups</h4>
                <h4 class="mt-3 mb-2"><b>{{App\Models\Group::where('status', 1)->count()}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Templates</h4>
                <h4 class="mt-3 mb-2"><b>{{App\Models\Template::count()}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
</div>
<div class="col-12">

    <div class="card">
        <h5 class="card-header">Recent Campaigns</h5>
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
