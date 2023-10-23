@extends('cms.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <a href="{{ route('index-awal') }}" class="btn btn-app {{ Request::is('index-awal') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> Info Awal
            </a>
            <a href="{{ route('downloadtemplate') }}" class="btn btn-app {{ Request::is('download-template') ? 'active' : '' }}">
                <i class="fas fa-cloud-download-alt"></i> Download
            </a>
            <a href="{{ route('downloadtemplate') }}" class="btn btn-app {{ Request::is('import-product') ? 'active' : '' }}">
                <i class="fas fa-cloud-upload-alt"></i> Import Product
            </a>
        </div>
    </div>
    <div class="col-md-10 mx-auto">
        <div class="product-form">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0 h6">Download Template</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <p><a href="{{ route('download', ['type' => 'produk-umum']) }}">1. Produk Umum</a></p>
                        </div>
                        <div class="col-lg-12">
                            <p><a href="{{ route('download', ['type' => 'master-kategori']) }}">2. Master Kategori</a></p>
                        </div>
                        <div class="col-lg-12">
                            <p><a href="{{ route('download', ['type' => 'master-tag-ppn']) }}">3. Master Tag PPN</a></p>
                        </div>
                        <div class="col-lg-12">
                            <p><a href="{{ route('download', ['type' => 'master-tipe-ongkir']) }}">4. Master Tipe Ongkir</a></p>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
