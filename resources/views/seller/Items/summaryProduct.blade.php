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
                                @if (!empty($productFiles))
                                    <h4>Files:</h4>
                                    <ul>
                                        @foreach ($productFiles as $file)
                                            <li>
                                                <a href="{{ asset('storage/product_files/' . $file->path) }}"
                                                    target="_blank">{{ $file->path }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No files found for this product SKU.</p>
                                @endif
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="ps-product__variations">
                                    <figure>
                                       {{session('product_sku_name')}} 
                                    </figure>
                                </div>
                                <div class="bg-gray py-2 px-3 mt-4">
                                    <h2 class="mb-0">
                                        Rp. {{ session('product_price') }}
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
