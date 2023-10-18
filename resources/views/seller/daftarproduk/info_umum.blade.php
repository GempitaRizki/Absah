@extends('cms.index')

@section('content')
    <style>
        .tag-editor {
            padding: .375rem .75rem;
            border: 1px solid #ced4da;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border-radius: .25rem;
            box-shadow: inset 0 0 0 transparent;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a href={{ route('index-awal') }}
                class="btn btn-app {{ request()->routeIs('product-awal') ? 'bg-secondary' : '' }}">
                <i class="fas fa-cog"></i> Info Awal
            </a>
            <a href={{ route('downloadtemplate') }}
                class="btn btn-app {{ request()->routeIs('product-download-template') ? 'bg-secondary' : '' }}">
                <i class="fa fa-info-circle"></i> Info Umum
            </a>
            <a href="#"
                class="btn btn-app {{ request()->routeIs('product-import-product') || request()->routeIs('product-proses-import') ? 'bg-secondary' : '' }}">
                <i class="fas fa-cloud-upload-alt"></i> Import Product
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-12 mx-auto">
            {!! Form::open(['route' => 'info-umum-store', 'method' => 'post']) !!}
            <div class="product-form">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Kategori</h5>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-warning" role="alert">
                                    <b>Path Kategori: Kategori belum dibuat</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">

                        
                            <div class="form-group">
                                {!! Form::label('tipe_kategori_id', 'Tipe Kategori', ['class' => 'mb-1 h6']) !!}
                                {!! Form::select('tipe_kategori_id', $tipeKategoriData, $tipeKategoriId, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih Tipe Kategori',
                                    'name' => 'tipe_kategori_id',
                                    'id' => 'tipe_kategori_id', 
                                ]) !!}
                            </div>
                            
                            </div>
                            
                            @if (!is_null($kategoriData))
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('kategori_id', 'Kategori', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('kategori_id', $kategoriData, null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Pilih Kategori',
                                        'name' => 'kategori_id',
                                        'id' => 'kategori_id',
                                    ]) !!}
                                </div>
                            </div>
                        @endif
                        
                        
                            
                                       
                        <div class="d-flex">
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('sub_category_satu', 'Sub Kategori Satu', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('sub_category_satu', [], null, [
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'name' => 'sub_category_satu',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('sub_category_dua', 'Sub Kategori Dua', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('sub_category_dua', [], null, [
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'name' => 'sub_category_dua',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('sub_category_tiga', 'Sub Kategori Tiga', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('sub_category_tiga', [], null, [
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'name' => 'sub_category_tiga',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('sub_category_empat', 'Sub Kategori Empat', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('sub_category_empat', [], null, [
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'name' => 'sub_category_empat',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('sub_category_lima', 'Sub Kategori Lima', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('sub_category_lima', [], null, [
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'name' => 'sub_category_lima',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('sub_category_enam', 'Sub Kategori enam', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('sub_category_enam', [], null, [
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'name' => 'sub_category_enam',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-form">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Info Umum</h5>
                        <hr>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Product Name', ['class' => 'mb-1 h6']) !!}
                                        {!! Form::text('name', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Nama Product',
                                            'name' => 'name',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('sku', 'SKU', ['class' => 'mb-1 h6']) !!}
                                        {!! Form::text('sku', null, [
                                            'class' => 'form-control',
                                            'style' => 'font-size: 0.85rem;',
                                            'placeholder' => 'SKU',
                                            'name' => 'sku',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('has_ppn', 'Has Ppn', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('has_ppn', [], null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Pilih Ppn',
                                        'name' => 'has_ppn',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('has_shipping', 'Has Shipping', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('has_shipping', [], null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Pilih Ongkos Kirim',
                                        'name' => 'has_shipping',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('produsen_type', 'Produsen Type', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('produsen_type', [], null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Pilih Produsen',
                                        'name' => 'produsen_type',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="product-form">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex">
                                        <div class="card-body">
                                            <div class="form-group">
                                                {!! Form::label('length', 'Length(cm)', ['class' => 'mb-1 h6']) !!}
                                                {!! Form::text('length', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => '0.00',
                                                    'name' => 'length',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                {!! Form::label('width', 'Width(cm)', ['class' => 'mb-1 h6']) !!}
                                                {!! Form::text('width', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => '0.00',
                                                    'name' => 'width',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                {!! Form::label('height', 'Height(cm)', ['class' => 'mb-1 h6']) !!}
                                                {!! Form::text('height', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => '0.00',
                                                    'name' => 'height',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                {!! Form::label('weight', 'Weight(cm)', ['class' => 'mb-1 h6']) !!}
                                                {!! Form::text('weight', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => '0.00',
                                                    'name' => 'weight',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="card-body">
                                            <div class="form-group">
                                                {!! Form::label('length_packing', 'Length Packing (cm)', ['class' => 'mb-1 h6']) !!}
                                                {!! Form::text('length_packing', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => '0.00',
                                                    'name' => 'length_packing',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                {!! Form::label('width_packing', 'Width Packing (cm)', ['class' => 'mb-1 h6']) !!}
                                                {!! Form::text('width_packing', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => '0.00',
                                                    'name' => 'width_packing',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                {!! Form::label('height_packing', 'Height Packing (cm)', ['class' => 'mb-1 h6']) !!}
                                                {!! Form::text('height_packing', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => '0.00',
                                                    'name' => 'height_packing',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                {!! Form::label('weight_packing', 'Weight Packing (g)', ['class' => 'mb-1 h6']) !!}
                                                {!! Form::text('weight_packing', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => '0.00',
                                                    'name' => 'weight_packing',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-form">
                            <div class="card">
                                <div class="d-flex">
                                    <div class="card-body" style="width: 25%;">
                                        <div class="form-group">
                                            {!! Form::label('madein', 'Made In', ['class' => 'mb-1 h6']) !!}
                                            {!! Form::select('madein', [], null, [
                                                'class' => 'form-control',
                                                'name' => 'madein',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="card-body" style="width: 25%;">
                                        <div class="form-group">
                                            {!! Form::label('garansi', 'Garansi', ['class' => 'mb-1 h6']) !!}
                                            {!! Form::select('garansi', [], null, [
                                                'class' => 'form-control',
                                                'name' => 'garansi',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="card-body" style="width: 25%;">
                                        <div class="form-group">
                                            {!! Form::label('brand', 'Brand', ['class' => 'mb-1 h6']) !!}
                                            {!! Form::select('brand', [], null, [
                                                'class' => 'form-control',
                                                'name' => 'brand',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="card-body" style="width: 25%;">
                                        <div class="form-group">
                                            {!! Form::label('kode_kbki', 'Kode KBKI', ['class' => 'mb-1 h6']) !!}
                                            {!! Form::text('kode_kbki', null, [
                                                'class' => 'form-control',
                                                'name' => 'kode_kbki',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="card-body" style="width: 25%;">
                                        <div class="form-group">
                                            {!! Form::label('cetakan', 'Cetakan', ['class' => 'mb-1 h6']) !!}
                                            {!! Form::text('cetakan', null, [
                                                'class' => 'form-control',
                                                'name' => 'cetakan',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="card-body" style="width: 25%;">
                                        <div class="form-group">
                                            {!! Form::label('nomorsk', 'Nomor SK', ['class' => 'mb-1 h6']) !!}
                                            {!! Form::text('nomorsk', null, [
                                                'class' => 'form-control',
                                                'name' => 'nomorsk',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="card-body" style="width: 25%;">
                                        <div class="form-group">
                                            {!! Form::label('tanggal_sk', 'Tanggal SK', ['class' => 'mb-1 h6']) !!}
                                            {!! Form::text('tanggal_sk', null, [
                                                'class' => 'form-control',
                                                'name' => 'tanggal_sk',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="card-body" style="width: 25%;">
                                        <div class="form-group">
                                            {!! Form::label('status_ongkir', 'Status Ongkir', ['class' => 'mb-1 h6']) !!}
                                            {!! Form::select('status_ongkir', [], null, [
                                                'class' => 'form-control',
                                                'placeholder' => 'Status Ongkir',
                                                'name' => 'status_ongkir',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('tkdn', 'TKDN(%)', ['class' => 'mb-1 h6']) !!}
                                                {!! Form::text('tkdn', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => '0.00',
                                                    'name' => 'tkdn',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('bmp', 'BMP(%)', ['class' => 'mb-1 h6']) !!}
                                                {!! Form::text('bmp', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => '0.00',
                                                    'name' => 'bmp',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="col-12 mx-auto">
                                        <div class="product-form">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0 h6">Stock & Qty</h5>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        {!! Form::label('stok', 'Stok', ['class' => 'mb-1 h6']) !!}
                                                                        {!! Form::text('stok', null, [
                                                                            'class' => 'form-control',
                                                                            'placeholder' => '0',
                                                                            'name' => 'stok',
                                                                        ]) !!}
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        {!! Form::label('limit', 'Limit', ['class' => 'mb-1 h6']) !!}
                                                                        {!! Form::text('limit', null, [
                                                                            'class' => 'form-control',
                                                                            'placeholder' => '0',
                                                                            'name' => 'Limit',
                                                                        ]) !!}
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        {!! Form::label('minqty', 'Min Qty', ['class' => 'mb-1 h6']) !!}
                                                                        {!! Form::text('minqty', null, [
                                                                            'class' => 'form-control',
                                                                            'placeholder' => '0',
                                                                            'name' => 'minqty',
                                                                        ]) !!}
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
                                <div class="container-fluid">
                                    <div class="col-12 mx-auto">
                                        <div class="product-form">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        {!! Form::label('tipe_kategori_id', 'Tipe Kategori', ['class' => 'mb-1 h6']) !!}
                                                        {!! Form::select('tipe_kategori_id', [], null, [
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Pilih Tipe Kategori',
                                                            'name' => 'tipe_kategori_id',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0 h6">Link Youtube Video & Etalase</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    {!! Form::label('url_video', 'Link Youtube Video', ['class' => 'mb-0 h6']) !!}
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">https://www.youtube.com/watch?v=
                                                            </span>
                                                        </div>
                                                        {!! Form::text('url_video', null, [
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Video ID',
                                                            'name' => 'url_video',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php
                                                $hintEtalase = "Daftar etalase tidak ditemukan ? <a href='" . url('etalase/add') . "'>Tambah etalase</a>";
                                                ?>
                                                <div class="form-group">
                                                    {!! Form::label('etalase_id', 'Etalase', ['class' => 'mb-0 h6']) !!}
                                                    {!! Form::select('etalase_id', [], null, [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Choose Etalase',
                                                        'name' => 'etalase_id',
                                                    ]) !!}
                                                    <small class="form-text text-muted">Daftar etalase tidak ditemukan ? <a
                                                            href="{{ url('etalase/add') }}">Tambah etalase</a></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0 h6">Deskripsi / Spesifikasi & Tags</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            {{ Form::textarea('descriptions', '', [
                                                'class' => 'form-control',
                                                'id' => 'descriptions',
                                                'rows' => 5,
                                            ]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
