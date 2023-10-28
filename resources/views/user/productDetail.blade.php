@extends('themes.ezone.layout')

@section('content')
    <div class="ps-page--product ps-page--product-box">
        <div class="container">
            <div class="ps-product--detail ps-product--box">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="ps-product__header ps-product__box">
                            <div class="ps-product__thumbnail" data-vertical="true">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="product-details-large tab-content">
                                                    <div class="tab-pane active show fade" id="pro-details1"
                                                        role="tabpanel">
                                                        <a href="{{ asset('images/' . $imagePath) }}"
                                                            data-lightbox="image-1" data-title="{{ $productName }}">
                                                            <img src="{{ asset('images/' . $imagePath) }}"
                                                                alt="{{ $productName }}"
                                                                style="display: block; margin: 0 auto; max-width: 100%; height: auto;">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5>{{ $store->store_name }}</h5>
                                                <p>Alamat: {{ $store->address }}</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ps-product__box">
                                <div class="product-details-content w-100" style="padding: 0 10px;">
                                    <h3>{{ $productName }}</h3>
                                    <div class="details-price">
                                        <span>Harga: Rp
                                            {{ $price != 'Cie harganya tidak ada' ? number_format((float) $price, 0, ',', '.') : 'Harga tidak tersedia' }}</span>
                                    </div>
                                    <div class="quickview-plus-minus">
                                        <input type="number" class="cart-plus-minus" value="1" min="1"
                                            step="1">
                                        <button type="button" class="submit contact-btn btn-hover">Add to Cart</button>
                                    </div>
                                    <span>(Tersedia {{ $stock }})</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active show fade" id="pro-details1" role="tabpanel">
                                            <a href="{{ asset('images/' . $imagePath) }}" data-lightbox="image-1"
                                                data-title="{{ $productName }}">
                                                <img src="{{ asset('images/' . $imagePath) }}" alt="{{ $productName }}"
                                                    style="display: block; margin: 0 auto; max-width: 100%; height: auto;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5><b>Deskripsi</b></h5>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6><b>Info Produk</b></h6>
                            <div class="card">
                                <div class="card-body">
                                    <p><strong>SKU:</strong> {{ $sku }}</p>
                                    <p><strong>Kategori:</strong>
                                        @foreach ($categories as $category)
                                            {{ $category }}
                                            @if (!$loop->last)
                                                &gt;
                                            @endif
                                        @endforeach
                                    </p>
                                    <p><strong>Merek/Penerbit:</strong></p>
                                    <p><strong>Garansi:</strong> {{ $garansi }} </p>
                                    <p><strong>Dimensi (P x L x T):</strong></p>
                                    <p><strong>Dimensi Packing:</strong></p>
                                    <p><strong>Berat:</strong></p>
                                    <p><strong>Berat Packing:</strong></p>
                                    <p><strong>Cetakan:</strong></p>
                                    <p><strong>SK:</strong></p>
                                    <p><strong>Tanggal SK:</strong></p>
                                    <p><strong>UMKM:</strong></p>
                                    <p><strong>Buatan:</strong></p>
                                    <p><strong>KBKI:</strong></p>
                                    <p><strong>Waktu & Cara Pengiriman:</strong></p>
                                    <p><strong>Jaminan Pengiriman : -</strong></p>
                                    <p><strong>Status Ketersediaan:</strong></p>
                                    <p><strong>Tag PPN:</strong></p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5>Deskripsi</h5>
                                    <p>
                                        {{ $descriptions }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
