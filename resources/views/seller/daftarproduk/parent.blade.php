@extends('cms.index')

@section('content')
<div class="card">
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
</div>  
@endsection          