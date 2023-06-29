@extends('admin.layouts.master')

@section('title', 'All Templates')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>All Templates</h5>
            <a href="{{route('admin.templates.create')}}" class="btn btn-sm btn-primary">Add Template</a>
        </div>
        <div class="p-3">
            @if ($templates->count() > 0)
            <div class="row {{ $templates->count() != 0 ? ' g-3' : '' }}">
                @foreach ($templates as $template)
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex ">
                            <img alt="{{ $template->title }}" class="w-10 h-10 rounded-full" src="{{ commonAvatar($template->title) }}">
                            <div class="ms-4 me-auto">
                                <a href="javascript:;" class="font-medium">{{ Str::upper($template->title) }}

                                </a>
                                <div class="flex text-gray-600 truncate text-xs mt-1">
                                  <span class="mx-1">•</span> {{ $template->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="dropdown ms-3">
                                <a href="javascript:;" class="dropdown-toggle btn-secondary btn my-auto" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu">
                                  <a href="{{ route('admin.templates.preview', $template->id) }}" target="_blank" class="dropdown-item">
                                    <i class="far fa-eye"></i> Preview
                                  </a>
                                  <a href="{{ route('admin.templates.edit', [$template->slug]) }}" class="dropdown-item">
                                    <i class="far fa-edit"></i> Edit Template
                                  </a>
                                  <a href="{{ route('admin.templates.delete', [$template->slug]) }}" class="dropdown-item">
                                    <i class="fa fa-trash"></i> Delete Template
                                  </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="rounded-md preview-template">
                                <div style="background-image: url('{{ my_asset($template->preview ?? notFound('no-preview.png')) }}');" class="preview-template"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{ $templates->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
            @else
            <div class="text-center">
                <img class="img-table" src="https://app.sender.net/img/undraw_blank_canvas.e0d12a7d.svg" alt="">
                <p>No Templates Found. Add New Below</p>
                <a href="{{route('admin.templates.create')}}" class="btn btn-lg btn-primary">Add Subscriber</a>
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
    .w-10 {
        width: 2.5rem;
    }
    .flex-none {
        flex: none;
    }
    .preview-template {
        width: 100%;
        height: 160px;
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
        overflow: hidden;
    }
    .image-fit {
        position: relative;
    }    .h-10 {
        height: 2.5rem;
    }
    .kyc-image{
        min-height: 300px;
        max-height:400px;
        width: auto;
        max-width: 100%;
    }
</style>
@endsection
