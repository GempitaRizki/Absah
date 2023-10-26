@extends('cms.index')

@section('content')
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary" style="height: 150px;">
                        <div class="inner">
                            <h3>{{ $totalProducts }}</h3>
                            <p>Total Produk</p>
                        </div>
                        <a href="#" class="small-box-footer text-black">Detail info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success" style="height: 150px;">
                        <div class="inner">
                            <h3>{{ $totalActiveProducts }}</h3>
                            <p>Produk Aktif</p>
                        </div>
                        <a href="#" class="small-box-footer text-black">Detail info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning" style="height: 150px;">
                        <div class="inner">
                            <h3>{{ $totalPendingProducs }}</h3>
                            <p>Produk Pending Review </p>
                        </div>
                        <a href="#" class="small-box-footer">Detail info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger" style="height: 150px;">
                        <div class="inner">
                            <h3> {{ $totalDraftProducts }}</h3>
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
                            <thead>
                                <tr>
                                    <th>#</th>
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
                            </thead>
                            <tbody>
                                @foreach ($productSkus as $productSku)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $productSku->name }}</td>
                                        <td>{{ $productSku->sku }}</td>
                                        <td>
                                            @php
                                                $iprProduct = \App\Models\IprProduct::find($productSku->product_id_reference);
                                                if ($iprProduct) {
                                                    echo $iprProduct->ProductType->name;
                                                }
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                if ($iprProduct) {
                                                    echo $iprProduct->Condition->name;
                                                }
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                if ($iprProduct) {
                                                    echo $iprProduct->PriceType->name;
                                                }
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                $status = \App\Models\MasterStatus::find($productSku->has_ppn);
                                                if ($status) {
                                                    echo $status->name;
                                                }
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                $statusId = $productSku->status_id;
                                                $statusName = '';
                                                switch ($statusId) {
                                                    case \App\Models\ProductSku::ENABLE_STATUS_ID:
                                                        $statusName = 'Enable';
                                                        break;
                                                    case \App\Models\ProductSku::DISABLE_STATUS_ID:
                                                        $statusName = 'Disable';
                                                        break;
                                                    case \App\Models\ProductSku::PENDING_REVIEW_STATUS_ID:
                                                        $statusName = 'Pending Review';
                                                        break;
                                                    default:
                                                        $statusName = 'Unknown';
                                                }
                                                echo $statusName;
                                            @endphp
                                        </td>
                                        <td>{{ $productSku->attribute_value ?? 'Non Set' }}</td>
                                        <td>
                                            @php
                                                $productStock = \App\Models\ProductStock::where('product_sku_id', $productSku->id)->first();
                                                if ($productStock) {
                                                    echo $productStock->stock;
                                                } else {
                                                    echo 'Non Set';
                                                }
                                            @endphp
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>
@endsection
