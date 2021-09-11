@extends('admin.layout')
@section('title', 'Videos')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Videos',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Videos'],
            ],
        ];
    @endphp
    @include('admin.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div>
                <div class="card card-default mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Videos</h3>
                    </div>
                    <div class="card-body">
                        <video-player url="{{url('videos/video1.mp4')}}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection