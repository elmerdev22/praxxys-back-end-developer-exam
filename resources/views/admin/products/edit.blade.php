@extends('admin.layout')
@section('title', 'Product Edit')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Products Edit',
            'breadcrumbs' => [
                ['url' => route('admin.products.index'), 'label' => 'Products'],
                ['url' => '', 'label' => 'Edit'],
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
                        <h3 class="card-title">Product Requirements</h3>
                    </div>
                    <div class="card-body">
                        <product-edit :categories='@json($categories)' :id="{{$id}}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection