@extends('themes.ezone.register')

@section('content')
<style>
    .required-label::after {
        content: " *";
        color: red;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container mt-5">
    <div class="col-lg-12">
        <div class="d-flex justify-content-center">
            <img src="{{ url('assets/img/product/absahlogo.png') }}" alt="logoip.png" width="300px">
        </div>
        <div class="d-flex justify-content-center">
            <h2>Form Pendaftaran Sekolah</h2>
        </div>
    </div>
</div>
<div class="register-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-form">
                            <form method="POST" action="{{route('StoreBuyerSession')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-end text-start required-label"><b>Name</b></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ Session::get('userData.username') }}" required>
                                        @if ($errors->has('username'))
                                        <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-end text-start required-label"><b>Email Address</b></label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Session::get('userData.email') }}" required>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-end text-start required-label"><b>Password</b></label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start required-label"><b>Konfirmasi Password</b></label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jabatan" class="col-md-4 col-form-label text-md-end text-start required-label"><b>Jabatan</b></label>
                                    <div class="col-md-6">
                                        <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required>
                                            <option value="Kepala Sekolah" {{ Session::get('userData.jabatan') == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                                            <option value="Bendahara" {{ Session::get('userData.jabatan') == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                                        </select>
                                        @error('jabatan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="NIP" class="col-md-4 col-form-label text-md-end text-start required-label"><b>NIP/NIY</b></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('NIP') is-invalid @enderror" id="NIP" name="NIP" value="{{ Session::get('userData.NIP') }}" required>
                                        @error('NIP')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="NIK" class="col-md-4 col-form-label text-md-end text-start required-label"><b>NIK</b></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('NIK') is-invalid @enderror" id="NIK" name="NIK" value="{{ Session::get('userData.NIK') }}" required>
                                        @error('NIK')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Simpan">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection