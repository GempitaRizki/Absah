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
    <div class="container-fluid">
        <div class="col-12 mx-auto">
            {!! Form::open(['route' => 'store-product', 'method' => 'post']) !!}
            <div class="product-form">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Kategori</h5>
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
                        <div class="form-group">
                            <label for="tipe_kategori_id" class="mb-1 h6">Tipe Kategori</label>
                            {!! Form::select('tipe_kategori_id', ['1' => 'Barang', '2' => 'Jasa'], null, [
                                'class' => 'form-control',
                                'id' => 'tipe_kategori_id',
                                'placeholder' => 'Pilih Tipe Kategori',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="mb-1 h6">Kategori</label>
                            {!! Form::select('category_id', $subCategories, null, [
                                'class' => 'form-control',
                                'id' => 'category_id',
                                'placeholder' => 'Pilih Kategori',
                            ]) !!}
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('sub_category_satu', 'Sub Kategori Satu', ['class' => 'mb-1 h6']) !!}
                                {!! Form::select('sub_category_satu', [], null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih Sub Kategori Satu',
                                    'name' => 'sub_category_satu',
                                    'id' => 'sub_category_satu',
                                ]) !!}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('sub_category_dua', 'Sub Kategori Dua', ['class' => 'mb-1 h6']) !!}
                                {!! Form::select('sub_category_dua', [], null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih Sub Kategori Dua',
                                    'id' => 'sub_category_dua',
                                ]) !!}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('sub_category_tiga', 'Sub Kategori Tiga', ['class' => 'mb-1 h6']) !!}
                                {!! Form::select('sub_category_tiga', [], null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih Sub Kategori Tiga',
                                    'id' => 'sub_category_tiga',
                                ]) !!}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('sub_category_empat', 'Sub Kategori Empat', ['class' => 'mb-1 h6']) !!}
                                {!! Form::select('sub_category_empat', [], null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih Sub Kategori Empat',
                                    'id' => 'sub_category_empat',
                                ]) !!}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('sub_category_lima', 'Sub Kategori Lima', ['class' => 'mb-1 h6']) !!}
                                {!! Form::select('sub_category_lima', [], null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih Sub Kategori Lima',
                                    'id' => 'sub_category_lima',
                                ]) !!}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('sub_category_enam', 'Sub Kategori Enam', ['class' => 'mb-1 h6']) !!}
                                {!! Form::select('sub_category_enam', [], null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih Sub Kategori Enam',
                                    'id' => 'sub_category_enam',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0 h6">Info Umum</h5>
                    </div>
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
                                    {!! Form::text('sku', $generatedSKU, [
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
                                {!! Form::select('has_ppn', \App\Models\MasterStatus::getListPpn(), null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih Ppn',
                                    'name' => 'has_ppn',
                                ]) !!}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('has_shipping', 'Has Shipping', ['class' => 'mb-1 h6']) !!}
                                {!! Form::select('has_shipping', $hasShipping, null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih Ongkos Kirim',
                                    'name' => 'has_shipping',
                                ]) !!}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('produsen_type', 'Produsen Type', ['class' => 'mb-1 h6']) !!}
                                {!! Form::select('produsen_type', \App\Models\MasterStatus::getProductProdusenType(), null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih Produsen',
                                    'name' => 'produsen_type',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="product-form">
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
                                    {!! Form::label('weight', 'Weight(g)', ['class' => 'mb-1 h6']) !!}
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
                                <div class= "form-group">
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
                    <div class="product-form">
                        <div class="d-flex">
                            <div class="card-body" style="width: 25%;">
                                <div class="form-group">
                                    {!! Form::label('madein', 'Made In', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::select('madein', $madeInTypes, null, [
                                        'placeholder' => 'Pilih Made In',
                                        'class' => 'form-control',
                                        'name' => 'madein',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="card-body" style="width: 25%;">
                                <div class="form-group">
                                    {!! Form::label('garansi', 'Garansi', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::text('garansi', null, [
                                        'class' => 'form-control',
                                        'name' => 'garansi',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="card-body" style="width: 25%;">
                                <div class="form-group">
                                    {!! Form::label('brand', 'Brand', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::text('brand', null, [
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
                                    {!! Form::select('status_ongkir', $statusOngkir, null, [
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
                        <div class="card-header">
                            <h5 class="mb-0 h6">Stock & Qty</h5>
                        </div>
                        <div class="d-flex">
                            <div class="card-body">
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
                                        {!! Form::label('limit_stock', 'Limit', ['class' => 'mb-1 h6']) !!}
                                        {!! Form::text('limit_stock', null, [
                                            'class' => 'form-control',
                                            'placeholder' => '0',
                                            'name' => 'limit_stock', 
                                        ]) !!}
                                    </div>
                                    <div class="col-md-4">
                                        {!! Form::label('qty_min', 'Min Qty', ['class' => 'mb-1 h6']) !!}
                                        {!! Form::text('qty_min', null, [
                                            'class' => 'form-control',
                                            'placeholder' => '0',
                                            'name' => 'qty_min',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('store_id', 'Store ID', ['class' => 'mb-1 h6']) !!}
                                {!! Form::select('store_id', $listStoreByLogin, null, [
                                    'class' => 'form-control',
                                    'name' => 'store_id',
                                ]) !!}
                            </div>
                        </div>
                    </div>
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
                                            <span class="input-group-text">https://www.youtube.com/watch?v=</span>
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
                                <div class="form-group">
                                    {!! Form::label('etalase_id', 'Etalase', ['class' => 'mb-0 h6']) !!}
                                    {!! Form::select('etalase_id', $listEtalase, null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Pilih Etalase',
                                        'name' => 'etalase_id',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h5 class="mb-0 h6">Deskripsi / Spesifikasi & Tags</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                {{ Form::textarea('descriptions', '', [
                                    'class' => 'form-control',
                                    'id' => 'descriptions',
                                ]) }}
                            </div>
                        </div>
                    </div>
                    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tipe_kategori_id').change(function() {
                loadSubCategories();
            });
            $('#category_id').change(function() {
                loadSubCategorySatu();
            });
            $('#sub_category_satu').change(function() {
                loadSubCategoryDua();
            });

            $('#sub_category_dua').change(function() {
                loadSubCategoryTiga();
            });

            $('#sub_category_tiga').change(function() {
                loadSubCategoryEmpat();
            });

            $('#sub_category_empat').change(function() {
                loadSubCategoryLima();
            });

            $('#sub_category_lima').change(function() {
                loadSubCategoryEnam();
            });
            loadSubCategories();
            loadSubCategorySatu();
            loadSubCategoryDua();
            loadSubCategoryTiga();
            loadSubCategoryEmpat();
            loadSubCategoryLima();
            loadSubCategoryEnam();
        });

        function loadSubCategories() {
            var parent_id = $('#tipe_kategori_id').val();
            var url = "{!! route('get-sub-categories') !!}";

            $.ajax({
                url: url,
                method: 'get',
                data: {
                    parent_id: parent_id
                },
                success: function(data) {
                    $('#category_id').empty().append(
                        '<option value="">Pilih Kategori</option>');
                    $.each(data.subCategories, function(id, name) {
                        $('#category_id').append('<option value="' + id + '">' +
                            name + '</option>');
                    });
                }
            });
        }

        function loadSubCategorySatu() {
            var selectedCategoryId = $('#category_id').val();

            $.ajax({
                url: '{{ route('get-sub-categories-satu') }}',
                method: 'get',
                data: {
                    category_id: selectedCategoryId
                },
                success: function(data) {
                    $('#sub_category_satu').empty().append(
                        '<option value="">Pilih Tipe Kategori</option>');
                    $.each(data.subCategorySatu, function(id, name) {
                        $('#sub_category_satu').append('<option value="' + id + '">' +
                            name + '</option>');
                    });
                }
            });
        }

        function loadSubCategoryDua() {
            var parent_id = $('#sub_category_satu').val();
            $.ajax({
                url: '{{ route('get-sub-categories-dua') }}',
                method: 'get',
                data: {
                    parent_id: parent_id
                },
                success: function(data) {
                    $('#sub_category_dua').empty().append(
                        '<option value="">Pilih Sub Kategori Dua</option>');
                    $.each(data.subCategoryDua, function(id, name) {
                        $('#sub_category_dua').append('<option value="' + id +
                            '">' +
                            name + '</option>');
                    });
                }
            });
        }

        function loadSubCategoryTiga() {
            var parent_id = $('#sub_category_dua').val();
            $.ajax({
                url: '{{ route('get-sub-categories-tiga') }}',
                method: 'get',
                data: {
                    parent_id: parent_id
                },
                success: function(data) {
                    $('#sub_category_tiga').empty().append(
                        '<option value="">Pilih Sub Kategori Tiga</option>');
                    $.each(data.subCategoryTiga, function(id, name) {
                        $('#sub_category_tiga').append('<option value="' + id +
                            '">' +
                            name + '</option>');
                    });
                }
            });
        }

        function loadSubCategoryEmpat() {
            var parent_id = $('#sub_category_tiga').val();
            $.ajax({
                url: '{{ route('get-sub-categories-empat') }}',
                method: 'get',
                data: {
                    parent_id: parent_id
                },
                success: function(data) {
                    $('#sub_category_empat').empty().append(
                        '<option value="">Pilih Sub Kategori Empat</option>');
                    $.each(data.subCategoryEmpat, function(id, name) {
                        $('#sub_category_empat').append('<option value="' + id +
                            '">' +
                            name + '</option>');
                    });
                }
            });
        }

        function loadSubCategoryLima() {
            var parent_id = $('#sub_category_empat').val();
            $.ajax({
                url: '{{ route('get-sub-categories-lima') }}',
                method: 'get',
                data: {
                    parent_id: parent_id
                },
                success: function(data) {
                    $('#sub_category_lima').empty().append(
                        '<option value="">Pilih Sub Kategori Lima</option>');
                    $.each(data.subCategoryLima, function(id, name) {
                        $('#sub_category_lima').append('<option value="' + id +
                            '">' +
                            name + '</option>');
                    });
                }
            });
        }

        function loadSubCategoryEnam() {
            var parent_id = $('#sub_category_lima').val();
            $.ajax({
                url: '{{ route('get-sub-categories-enam') }}',
                method: 'get',
                data: {
                    parent_id: parent_id
                },
                success: function(data) {
                    $('#sub_category_enam').empty().append(
                        '<option value="">Pilih Sub Kategori Enam</option>');
                    $.each(data.subCategoryEnam, function(id, name) {
                        $('#sub_category_enam').append('<option value="' + id +
                            '">' +
                            name + '</option>');
                    });
                }
            });
        }
    </script>
    <script>
        function loadSubCategories() {
            var parent_id = $('#tipe_kategori_id').val();
            var url = "{!! route('get-sub-categories') !!}";

            $.ajax({
                url: url,
                method: 'get',
                data: {
                    parent_id: parent_id
                },
                success: function(data) {
                    $('#category_id').empty().append(
                        '<option value="">Pilih Kategori</option>');
                    $.each(data.subCategories, function(id, name) {
                        $('#category_id').append('<option value="' + id + '">' +
                            name + '</option>');
                    });
                }
            });
        }
    </script>
@endsection
