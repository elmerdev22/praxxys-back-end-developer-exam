@extends('admin.layout')
@section('title', 'Dashboard')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Dashboard',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Dashboard'],
            ],
        ];
    @endphp
    @include('admin.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{number_format($products_count, 0)}}</h3>
                    <p>Current Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <a href="{{route('admin.products.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection
