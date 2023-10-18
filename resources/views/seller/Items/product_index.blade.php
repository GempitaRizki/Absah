@extends('cms.index')

@section('content')
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info" style="height: 150px;">
                        <div class="inner">
                            <p>Total Produk</p>
                        </div>
                        <a href="#" class="small-box-footer">Detail info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success" style="height: 150px;">
                        <div class="inner">
                            <p>Produk Aktif</p>
                        </div>
                        <a href="#" class="small-box-footer">Detail info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning" style="height: 150px;">
                        <div class="inner">
                            <p>Total Produk Non-Aktif</p>
                        </div>
                        <a href="#" class="small-box-footer">Detail info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger" style="height: 150px;">
                        <div class="inner">
                            <p>Draft Produk</p>
                        </div>
                        <a href="#" class="small-box-footer">Detail info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="product-index">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('index-awal') }}" class="btn btn-success">Add Product</a>
                        <a href="#" class="btn btn-info">Add Product Puskurbuk</a>
                        <a href="#" class="btn btn-warning">Cari Bundle</a>

                    </div>
                    <div class="card-body p-0">
                        <table class="table text-nowrap table-striped table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Sku</th>
                                    <th>Product Type</th>
                                    <th>Condition Id</th>
                                    <th>Price Type</th>
                                    <th>Ppn</th>
                                    <th>Status</th>
                                    <th>Attribute</th>
                                    <th>Stok</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>
@endsection
