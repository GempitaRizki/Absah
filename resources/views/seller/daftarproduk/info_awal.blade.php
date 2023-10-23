@extends('cms.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 mx-auto">
                {!! Form::open(['route' => 'store-index-awal', 'method' => 'post']) !!}
                @include('seller.Items.wizard')
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
                                {!! Form::select('product_type_id', $productTypes, null, [
                                    'class' => 'form-control',
                                    'id' => 'product_type_id',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('price_types_id', 'Price Type') !!}
                                {!! Form::select('price_types_id', [], null, [
                                    'class' => 'form-control',
                                    'id' => 'price_types_id',
                                    'required' => 'required',
                                    'disabled' => true,
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('condition_id', 'Condition') !!}
                                {!! Form::select('condition_id', $productConditionType, null, [
                                    'class' => 'form-control',
                                    'id' => 'condition_id',
                                    'required' => 'required',
                                ]) !!}
                            </div>

                            <div class="form-group" id="attributes-group">
                                {!! Form::label('attributes_id', 'Attribute') !!}
                                {!! Form::select('attributes_id', $listOptions, null, [
                                    'class' => 'form-control',
                                    'id' => 'attributes_id',
                                ]) !!}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product_type_id').on('change', function() {
                var productTypeId = $(this).val();
                var priceTypesSelect = $('#price_types_id');
                var attributesGroup = $('#attributes-group');

                if (productTypeId === '31') {
                    attributesGroup.show();
                } else {
                    attributesGroup.hide();
                }
                var priceTypeData = [];
                if (productTypeId === '32') {
                    priceTypeData = [{
                            id: '37',
                            name: 'Zonasi'
                        },
                        {
                            id: '38',
                            name: 'General / Nasional'
                        },
                        {
                            id: '39',
                            name: 'Grosir'
                        }
                    ];
                } else if (productTypeId === '31') {
                    priceTypeData = [{
                            id: '38',
                            name: 'General / Nasional'
                        },
                        {
                            id: '39',
                            name: 'Grosir'
                        }
                    ];
                } else if (productTypeId === '30') {
                    priceTypeData = [{
                            id: '37',
                            name: 'Zonasi'
                        },
                        {
                            id: '38',
                            name: 'General / Nasional / Berdasarkan Item'
                        }
                    ];
                }
                priceTypesSelect.empty();
                priceTypesSelect.append('<option value="">Pilih Price Type</option>');
                $.each(priceTypeData, function(index, option) {
                    priceTypesSelect.append('<option value="' + option.id + '">' + option.name +
                        '</option>');
                });
                priceTypesSelect.prop('disabled', false);
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product_type_id').on('change', function() {
                var productTypeId = $(this).val();
                var $wizardSteps = $('#wizard-steps');
                var $productType32 = $('#product-type-32');
                var $productTypeOther = $('#product-type-other');
                $wizardSteps.hide();
                $productType32.hide();
                $productTypeOther.hide();

                if (productTypeId === '32') {
                    $productType32.show();
                } else {
                    $productTypeOther.show();
                }
            });
        });
    </script>
@endsection
