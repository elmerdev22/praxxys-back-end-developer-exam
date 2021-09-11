@extends('admin.layout')
@section('title', 'Products')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Products',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Products'],
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
                        <h3 class="card-title">Product Lists</h3>
                        <div class="card-tools">
                            <a href="{{route('admin.products.create')}}" class="btn btn-success btn-sm"><span class="fas fa-plus"></span> Create</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <product-list v-bind:categories='@json($categories)' />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection