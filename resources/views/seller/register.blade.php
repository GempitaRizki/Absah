@extends('seller.topbar')

@section('title', 'Pendaftaran')

@section('content')
    <h2 style="text-align: center">Form Pendaftaran User</h2>
    <style>
        .required-label::after {
            content: " *";
            color: red;
        }
    </style>
    <div class="register-area ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="login-form">
                                <form method="POST" action="{{ route('StoreSellerSession') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="surel"
                                            class="col-md-4 col-form-label text-md-end text-start required-label">Surel</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('surel') is-invalid @enderror"
                                                id="surel" name="surel"
                                                value="{{ old('surel', session('storeSession.surel')) }}" required>
                                            @if ($errors->has('surel'))
                                                <span class="text-danger">{{ $errors->first('surel') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-end text-start required-label">Password</label>
                                        <div class="col-md-6">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                name="password" placeholder="Password" required>
                                            <input type="hidden" name="original_password"
                                                value="{{ old('original_password', session('storeSession.password')) }}">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <select class="form-control" name="seller_type" id="seller_type">
                                            <option value="Individual"
                                                {{ old('seller_type', session('storeSession.seller_type')) === 'Individual' ? 'selected' : '' }}>
                                                Individual</option>
                                            <option value="Corporate"
                                                {{ old('seller_type', session('storeSession.seller_type')) === 'Corporate' ? 'selected' : '' }}>
                                                Corporate
                                            </option>
                                        </select>
                                    </div>
                                    <br><br>
                                    <div class="form-group row">
                                        <label for="store_name"
                                            class="col-md-4 col-form-label text-md-end text-start required-label">Nama
                                            Toko</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('store_name') is-invalid @enderror"
                                                id="store_name" name="store_name"
                                                value="{{ old('store_name', session('storeSession.store_name')) }}"
                                                required>
                                            @if ($errors->has('store_name'))
                                                <span class="text-danger">{{ $errors->first('store_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Simpan">
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
