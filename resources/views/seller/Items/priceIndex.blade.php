@extends('cms.index')

@section('content')
    @include('seller.Items.wizard')
    <div class="container-fluid">
        <div class="px-15px px-lg-25px">
            <div class="col-12 mx-auto">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                {{ Form::open(['method' => 'post', 'route' => 'product-prices.store']) }}
                                @csrf
                                <div class="form-group">
                                    {{ Form::label('hargaPpn', 'Harga Ppn', ['class' => 'mb-1 h6']) }}
                                    {{ Form::select('hargaPpn', ['1' => 'Harga Termasuk Ppn', '2' => 'Harga Diluar Ppn'], null, ['class' => 'form-control', 'placeholder' => 'Pilih Harga Ppn', 'required']) }}
                                </div>
                            </div>
                            <div class="d-flex">
                                @foreach ($productPrices as $productPrice)
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="price_{{ $productPrice->zona_id }}" class="mb-1 h6">Price {{ $productPrice->zona_id }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="price_{{ $productPrice->zona }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-right mt-3" style="margin-bottom: 10px;">
                                {{ Form::submit('Submit', ['class' => 'btn btn-primary mr-3']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
