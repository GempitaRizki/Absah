@extends('cms.index')

@section('content')
    @include('seller.Items.wizard')
    <div class="container-fluid">
        <div class="px-15px px-lg-25px">
            <div class="col-12 mx-auto">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h2>Form Tambah Data Price</h2>
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('product-prices.store') }}">
                            @csrf
                            <div class="card">
                                <div class="d-flex">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="price" class="mb-1 h6">Harga</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" name="price" class="form-control" required value="{{ old('price') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for= "price_after_discount" class="mb-1 h6">Harga Setelah Diskon</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" name="price_after_discount" class="form-control" required value="{{ old('price_after_discount') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-3" style="margin-bottom: 10px;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>
@endsection
