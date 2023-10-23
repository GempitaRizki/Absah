@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('product.update', $model->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('product._wizard')

                @if ($model->product_type === \App\Models\Product::PRODUCT_TYPE_VARIANT || $model->product_type === \App\Models\Product::PRODUCT_TYPE_STANDAR)
                    @if (!empty($model->attribute))
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6">Variant Detail</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach (json_decode($model->attribute) as $key => $data)
                                        @php
                                            $optionDetail = \App\Models\Option::find($data);
                                            $labelName = $optionDetail->name;
                                        @endphp
                                        <div class="col-lg-12">
                                            @php
                                                $optionValueSelected = [];
                                                if ($combinations !== 'null') {
                                                    foreach ($combinations as $keyOption => $combinationsOption) {
                                                        foreach ($combinationsOption as $keyOptionDetail => $combinationsOptionDetail) {
                                                            $optionValue = \App\Models\OptionValue::find($combinationsOptionDetail);
                                                            if ($data == $optionValue->option_id && $optionValue->id == $combinationsOptionDetail) {
                                                                $optionValueSelected[] = $combinationsOptionDetail;
                                                            }
                                                        }
                                                        session([$data => $optionValueSelected]);
                                                    }
                                                }
                                            @endphp
                                            {!! Form::label($data, 'Choose ' . $labelName, ['class' => 'mb-1 h6']) !!}
                                            {!! Form::select(
                                                'attributeVariant[' . $data . '][]',
                                                \App\Models\OptionValue::getListOptionValue($data),
                                                session($data),
                                                [
                                                    'class' => 'form-control',
                                                    'multiple' => true,
                                                    'id' => $data,
                                                    'required' => true
                                                ]
                                            ) !!}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-warning btn-block btn-sm" name="form_variant" value="form_variant">
                                            Generate Form Variant
                                        </button>
                                    </div>
                                </div>
                                <br>
                                @if ($combinations !== 'null')
                                    <div class="row">
                                        @foreach ($combinations as $key => $combinations)
                                            @php
                                                $optionValueNameArr = [];
                                                $optionValueNameKeyAttribute = [];
                                            @endphp
                                            @foreach ($combinations as $keyDetail => $combinationsDetail)
                                                @php
                                                    $optionValue = \App\Models\OptionValue::find($combinationsDetail);
                                                    $optionValueName = $optionValue->name;
                                                    if ($optionValue->option_id === 1) {
                                                        $listAttributeValue[$optionValue->option_id][] = $optionValue->color_code;
                                                        $keyAttributeValue = $optionValue->color_code;
                                                    } else {
                                                        $listAttributeValue[$optionValue->option_id][] = $optionValue->name;
                                                        $keyAttributeValue = $optionValue->name;
                                                    }
                                                    $optionValueNameArr[] = $optionValueName;
                                                    $optionValueNameKeyAttribute[] = $keyAttributeValue;
                                                @endphp
                                            @endforeach
                                            @php
                                                $skuImplode = implode('-', $optionValueNameArr);
                                                $keyAttributeImplode = implode('-', $optionValueNameKeyAttribute);
                                                $skuDefault = $model->id . '-' . $skuImplode;
                                                $keyAttribute = $model->id . '-' . $keyAttributeImplode;
                                                $stockDefault = \App\Models\ProductStock::DEFAULT_STOCK;
                                                $checkCombineExist = \App\Models\ProductSku::where('key_attribute', $skuDefault)->first();
                                            @endphp
                                            @if ($checkCombineExist === null)
                                                <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0 h6">
                                                                {{ implode(' / ', $optionValueNameArr) }}
                                                            </h5>
                                                        </div>
                                                        <div class="card-body">
                                                            @if ($model->price_type === \App\Models\Product::PRODUCT_TYPE_PRICE_ZONASI)
                                                                @php
                                                                    $zona = \App\Models\Zona::where('label', \App\Models\Zona::ZONA_DIKBUD)->get();
                                                                @endphp
                                                                @foreach ($zona as $zona)
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                {!! Form::text(
                                                                                    'skuVariant[' . $skuDefault . '#' . $key . '][' . $zona->id . ']',
                                                                                    $skuDefault,
                                                                                    [
                                                                                        'readonly' => true,
                                                                                    ]
                                                                                ) !!}
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                {!! Form::text(
                                                                                    'priceVariant[' . $skuDefault . '#' . $key . '][' . $zona->id . ']',
                                                                                    null,
                                                                                    [
                                                                                        'addon' => ['prepend' => ['content' => 'Rp']],
                                                                                    ]
                                                                                ) !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                <div class="col-lg-6">
                                                                    {!! Form::hidden(
                                                                        'dataOption[' . $skuDefault . '#' . $key . ']',
                                                                        $data
                                                                    ) !!}
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    {!! Form::hidden(
                                                                        'key_attribute[' . $skuDefault . '#' . $key . ']',
                                                                        $keyAttribute
                                                                    ) !!}
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    {!! Form::text(
                                                                        'stockVariant[' . $skuDefault . '#' . $key . ']',
                                                                        $stockDefault,
                                                                    ) !!}
                                                                </div>
                                                            @endif
                                                            @if ($model->price_type === \App\Models\Product::PRODUCT_TYPE_PRICE_NASIONAL)
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            {!! Form::text(
                                                                                'skuVariant[' . $skuDefault . '#' . $key . '][]',
                                                                                $skuDefault,
                                                                                [
                                                                                    'readonly' => true,
                                                                                ]
                                                                            ) !!}
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            {!! Form::text(
                                                                                'stockVariant[' . $skuDefault . '#' . $key . ']',
                                                                                $stockDefault,
                                                                            ) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        {!! Form::text(
                                                                            'priceVariant[' . $skuDefault . '#' . $key . ']',
                                                                            null,
                                                                            [
                                                                                'addon' => ['prepend' => ['content' => 'Rp']],
                                                                            ]
                                                                        ) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    {!! Form::hidden(
                                                                        'dataOption[' . $skuDefault . '#' . $key . ']',
                                                                        $data
                                                                    ) !!}
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    {!! Form::text(
                                                                        'key_attribute[' . $skuDefault . '#' . $key . ']',
                                                                        $keyAttribute,
                                                                    ) !!}
                                                                </div>
                                                            @endif
                                                            @if ($model->price_type === \App\Models\Product::PRODUCT_TYPE_PRICE_GROSIR)
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            {!! Form::text(
                                                                                'skuVariant[' . $skuDefault . '#' . $key . ']',
                                                                                $skuDefault,
                                                                                [
                                                                                    'readonly' => true,
                                                                                ]
                                                                            ) !!}
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            {!! Form::text(
                                                                                'stockVariant[' . $skuDefault . '#' . $key . ']',
                                                                                $stockDefault,
                                                                            ) !!}
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            {!! Form::text(
                                                                                'priceVariant[' . $skuDefault . '#' . $key . ']',
                                                                                null,
                                                                                [
                                                                                    'addon' => ['prepend' => ['content' => 'Rp']],
                                                                                ]
                                                                            ) !!}
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            {!! Form::text(
                                                                                'qtyVariant[' . $skuDefault . '#' . $key . ']',
                                                                                null,
                                                                            ) !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @php
                                            $listAttributeFix = [];
                                            foreach ($listAttributeValue as $keylistAttributeValue => $valuelistAttributeValue) {
                                                $listAttributeFix[] = [
                                                    'attribute_id' => $keylistAttributeValue,
                                                    'values' => array_unique($valuelistAttributeValue)
                                                ];
                                            }
                                        @endphp
                                        {!! Form::hidden('attributeValueForProduct', json_encode($listAttributeFix)) !!}
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="alert alert-info alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-info"></i> Info Kombinasi Telah Dibuat</h5>
                                            @if (count($combinationsExist) >= 1)
                                                {{ implode(' / ', $combinationsExist) }}
                                            @endif
                                            <p>Menu edit kombinasi masih dalam tahap pengembangan. Mohon tunggu update selanjutnya.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endif

                @if (!empty($combinationReady) && $combinations !== 'null')
                    <button type="submit" class="btn btn-primary" name="save_variant" value="save_variant">
                        Save
                    </button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
