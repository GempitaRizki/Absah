@extends('cms.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 mx-auto">
                {!! Form::open(['route' => 'store-awal', 'method' => 'post']) !!}
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
                <div class="product-form">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">Info Awal</h5>
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

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-warning" role="alert">
                                        <b>Perhatian!</b> Pengaturan produk awal pada bagian ini, setelah disimpan <b>tidak
                                            dapat</b> diedit.
                                    </div>
                                </div>
                            </div>

                            <div id="more-category"></div>

                            <div class="form-group">
                                {!! Form::label('product_type_id', 'Product Type') !!}
                                {!! Form::select('product_type_id', $productTypeList, null, [
                                    'class' => 'form-control',
                                    'id' => 'product_type_id',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('price_type', 'Price Type') !!}
                                {!! Form::select('price_type', $priceTypeList, null, ['class' => 'form-control', 'id' => 'price_type']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('condition_id', 'Condition') !!}
                                {!! Form::select('condition_id', $conditionList, null, ['class' => 'form-control', 'id' => 'condition_id']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('attribute', 'Attribute') !!}
                                {!! Form::select('attribute', $attributeList, null, ['class' => 'form-control', 'id' => 'attribute']) !!}
                            </div>
                        </div>
                        <div class="card-footer">
                            {!! Form::submit('Save & Next Step', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
