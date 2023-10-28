@extends('cms.index')
@section('content')
    <div class="px-15px px-lg-25px">
        <div class="col-md-10 mx-auto">
            {!! Form::open(['url' => 'route_name', 'method' => 'post']) !!}
            <div class="product-form">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Info</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                @if (session()->has('uploaded_image'))
                                    <div class="card-body">
                                        <img src="{{ asset('images/' . session('uploaded_image')) }}"
                                            alt="Uploaded Image" style="max-width: 300px;">
                                    </div>
                            </div>
                            @endif
                            <div class="col-12 col-sm-6">
                                <div class="ps-product__variations">
                                    <figure>
                                        @if (session()->has('product_sku_name'))
                                            <span style="text-transform: capitalize; font-size: 23px;">
                                                {{ ucwords(session('product_sku_name')) }}
                                            </span>
                                        @endif
                                    </figure>
                                </div>
                                <div class="bg-gray py-2 px-3 mt-4">
                                    <h2 class="mb-0">
                                        @if (session()->has('product_price'))
                                            Rp. {{ number_format(session('product_price'), 0, ',', '.') }}
                                        @endif
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <nav class="w-100">
                                <div class="nav nav-tabs" id="product-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab"
                                        href="#product-desc" role="tab" aria-controls="product-desc"
                                        aria-selected="true">Description</a>
                                </div>
                            </nav>
                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                                    aria-labelledby="product-desc-tab">
                                    @if (session()->has('product_descriptions'))
                                        {{ session('product_descriptions') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Label</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            @if (session()->has('default_status'))
                                                {{ session('default_status')->name }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Warning</td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
