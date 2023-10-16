@extends('cms.index')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalAll }}</h3>
                            <p>Total Produk</p>
                        </div>
                        <a href=# class="small-box-footer">Detail info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Add similar blocks for other statistics -->
            </div>

            <div class="product-index">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-success">Add Product</a>
                        <a href="#" class="btn btn-info">Add Product Puskurbuk</a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table text-nowrap table-striped table-bordered mb-0">
                            <tbody>
                                {{-- @foreach ($products as $product) --}}
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href=# class="btn btn-warning btn-xs">
                                            <span class="fa-fw fas fa-edit"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href=# class="btn btn-danger btn-xs"
                                            data-confirm="Apakah anda ingin menghapus produk ini?">
                                            <span class="fa-fw fas fa-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{-- {{ $dataProvider->summary }} --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
