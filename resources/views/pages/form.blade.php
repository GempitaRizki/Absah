@extends('themes.ezone.footer')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container mt-5">
    <div class="col-lg-12">
        <div class="d-flex justify-content-center">
            <img src="{{url('assets/img/product/absahlogo.png')}}" alt="logoip.png" width="300pxs">
        </div>
        <div class="d-flex justify-content-center">
            <h2>Form Pendaftaran Sekolah</h2>
        </div>
    </div>
</div>
<!-- register-area start -->
<div class="register-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-form">
                            <form method="POST" action="{{ route('register.submit') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" value="{{ old('email') }}" name="email">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="form-label">password</label>
                                    <input type="text" class="form-control" id="password" value="{{ old('password') }}" name="password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <div class="form-check">
                                        <input class="form-check-input" value="kepala sekolah" type="radio" name="jabatan" id="jabatan" {{ old('jabatan') == 'kepalasekolah' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jabatan">Kepala Sekolah</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="bendahara" name="jabatan" id="jabatan" {{ old('jabatan') == 'bendahara' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jabatan">bendahara</label>
                                    </div>
                                    @error('bendahara')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="NIP" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="NIP" value="{{ old('NIP') }}" name="NIP">
                                    @error('NIP')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="NIK" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="NIK" value="{{ old('NIK') }}" name="NIK">
                                    @error('NIK')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" name="terms" id="terms">
                                    <label class="form-check-label" for="tc">Terms & Conditions</label><br>
                                    @error('terms')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        </div>
                        <div class="button-box">
                            <button type="submit" class="default-btn floatright">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection