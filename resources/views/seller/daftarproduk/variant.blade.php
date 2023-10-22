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
            <a href="{{ route('index-awal') }}" class="btn btn-app {{ Request::is('index-awal') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> Info Awal
            </a>
            <a href="{{ route('getInfoUmum') }}" class="btn btn-app {{ Request::is('info-umum') ? 'active' : '' }}">
                <i class="fa fa-info-circle"></i> Info Umum
            </a>
            <a href="{{ route('IndexVariant') }}" class="btn btn-app {{ Request::is('IndexVariant') ? 'active' : '' }}">
                <i class="fas fa-object-group"></i> Variant
            </a>
            <a href="#" class="btn btn-app {{ Request::is('file-gambar') ? 'active' : '' }}">
                <i class="fas fa-images"></i> File & Gambar
            </a>
            <a href=# class="btn btn-app {{ Request::is('import-product') ? 'active' : '' }}">
                <i class="fas fa-upload"></i> Import Product
            </a>
        </div>
    </div>
@endsection
