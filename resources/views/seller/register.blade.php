@extends('themes.ezone.footer')

@section('title', 'Pendaftaran')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="ps-page__header text-center" style="padding-bottom: 0px !important;">
                    <a class="ps-logo" href="https://absah.id/">
                        <img src="https://absah.id/storage/web/logoip.png" class="img img-reponsive" style="width: 250px;">
                    </a>
                </div>

                <hr>
                <h2 style="text-align: center">Form Pendaftaran User</h2>

                <div class="register-area ptb-100">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
                                <div class="login">
                                    <div class="login-form-container">
                                        <div class="login-form">
                                            <form method="POST" action="{{route('StoreSellerSession')}}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="surel"
                                                        class="col-md-4 col-form-label text-md-end text-start">Surel</label>
                                                    <div class="col-md-6">
                                                        <input type="text"
                                                            class="form-control @error('surel') is-invalid @enderror"
                                                            id="surel" name="surel"
                                                            value="{{ Session::get('sellerData.surel') }}">
                                                        @if ($errors->has('surel'))
                                                            <span class="text-danger">{{ $errors->first('surel') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="password"
                                                        class="col-md-4 col-form-label text-md-end text-start">Password</label>
                                                    <div class="col-md-6">
                                                        <input type="text"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            id="password" name="password"
                                                            value="{{ Session::get('sellerData.password') }}">
                                                        @if ($errors->has('password'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('password') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <select class="form-control @error('seller_type') is-invalid @enderror"
                                                        id="seller_type" name="seller_type">
                                                        <option value="Corporate"
                                                            {{ Session::get('sellerData.seller_type') == 'Corporate' ? 'selected' : '' }}>
                                                            Corporate</option>
                                                        <option value="Individual"
                                                            {{ Session::get('sellerData.seller_type') == 'Individual' ? 'selected' : '' }}>
                                                            Individual</option>
                                                    </select>
                                                    @error('seller_type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="store_name"
                                                        class="col-md-4 col-form-label text-md-end text-start">Nama
                                                        Toko</label>
                                                    <div class="col-md-6">
                                                        <input type="text"
                                                            class="form-control @error('store_name') is-invalid @enderror"
                                                            id="store_name" name="store_name"
                                                            value="{{ Session::get('sellerData.store_name') }}">
                                                        @if ($errors->has('store_name'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('store_name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary"
                                                        value="Simpan">
                                                </div>
                                            </form>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
