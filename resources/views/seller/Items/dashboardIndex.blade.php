@extends('cms.index')

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <a href="#">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fas fa-cart-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Order</span>
                    <span class="info-box-number" style="color: black;">10</span>
                    <span class="progress-description">
                        Total Order
                    </span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <a href="#">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="far fa-comments"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Komplain</span>
                    <span class="info-box-number" style="color: black;">66</span>
                    <span class="progress-description">
                        Total Komplain
                    </span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <a href="#">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-not-equal"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Nego</span>
                    <span class="info-box-number" style="color: black;">0</span>
                    <span class="progress-description">
                        Total Nego
                    </span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-credit-card"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Order Selesai</span>
                <span class="info-box-number" style="color: black;">66</span>
                <span class="progress-description">
                    Total Order Selesai
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Dokumen Toko</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0" style="display: block;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Your table data goes here --}}
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix" style="display: block;">
                <a href="#" class="btn btn-sm btn-secondary float-right">Detail Profil</a>
            </div>
        </div>
    </div>
</div>
@endsection
