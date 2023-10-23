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
            <a href=# class="btn btn-app {{ Request::is('file-gambar') ? 'active' : '' }}">
                <i class="fas fa-images"></i> File & Gambar
            </a>
            <a href=# class="btn btn-app {{ Request::is('import-product') ? 'active' : '' }}">
                <i class="fas fa-upload"></i> Import Product
            </a>
        </div>
    </div>
    <div class="px-15px px-lg-25px">
        <div class="col-md-10 mx-auto">
            <form>
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Variant Detail</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('name', 'Generate ', ['class' => 'mb-1 h6']) !!}
                                    {!! Form::text('name', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nama Product',
                                        'name' => 'name',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-warning btn-block btn-sm" name="form_variant" value="form_variant">
                                    Generate Form Variant
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
