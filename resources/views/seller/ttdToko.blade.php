@extends('themes.ezone.footer')

@section('content')
    <div class="container mt-5" style="margin-bottom: 100px;">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-form">
                            <form method="POST" action="{{ route('StoreSellerIndexForm') }}">
                                @csrf
                                 <div class="col-lg-12">
                                    <div>
                                        <br>
                                        <h3>Penandatangan Toko</h3>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="nama" class="col-md-4 col-form-label text-md-end text-start">nama</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    id="nama" name="nama"
                                                    value="{{ Session::get('ownerSession.nama') }}">
                                                @if ($errors->has('nama'))
                                                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                                                @endif
                                            </div>
                                            <label for="jabatan" class="col-md-4 col-form-label text-md-end text-start">jabatan</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('jabatan') is-invalid @enderror"
                                                    id="jabatan" name="jabatan"
                                                    value="{{ Session::get('ownerSession.jabatan') }}">
                                                @if ($errors->has('jabatan'))
                                                    <span class="text-danger">{{ $errors->first('jabatan') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="NIK" class="col-md-4 col-form-label text-md-end text-start">NIK</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('NIK') is-invalid @enderror"
                                                    id="NIK" name="NIK"
                                                    value="{{ Session::get('ownerSession.NIK') }}">
                                                @if ($errors->has('NIK'))
                                                    <span class="text-danger">{{ $errors->first('NIK') }}</span>
                                                @endif
                                            </div>
                                            <label for="NPWP" class="col-md-4 col-form-label text-md-end text-start">NPWP</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('NPWP') is-invalid @enderror"
                                                    id="NPWP" name="NPWP"
                                                    value="{{ Session::get('ownerSession.NPWP') }}">
                                                @if ($errors->has('NPWP'))
                                                    <span class="text-danger">{{ $errors->first('NPWP') }}</span>
                                                @endif
                                            </div>
                                            <label for="phone_number" class="col-md-4 col-form-label text-md-end text-start">phone_number</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    id="phone_number" name="phone_number"
                                                    value="{{ Session::get('ownerSession.phone_number') }}">
                                                @if ($errors->has('phone_number'))
                                                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="checkbox" id="ownerCheckbox">
                                        <label for="ownerCheckbox">Penandatangan sama dengan penanggung jawab</label>
                                        <br>
                                        <div class="form-group row">
                                            <label for="nama" class="col-md-4 col-form-label text-md-end text-start">nama</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    id="nama" name="nama"
                                                    value="{{ Session::get('ownerSession.nama') }}">
                                                @if ($errors->has('nama'))
                                                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                                                @endif
                                            </div>
                                            <label for="jabatan" class="col-md-4 col-form-label text-md-end text-start">jabatan</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('jabatan') is-invalid @enderror"
                                                    id="jabatan" name="jabatan"
                                                    value="{{ Session::get('ownerSession.jabatan') }}">
                                                @if ($errors->has('jabatan'))
                                                    <span class="text-danger">{{ $errors->first('jabatan') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="NIK" class="col-md-4 col-form-label text-md-end text-start">NIK</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('NIK') is-invalid @enderror"
                                                    id="NIK" name="NIK"
                                                    value="{{ Session::get('ownerSession.NIK') }}">
                                                @if ($errors->has('NIK'))
                                                    <span class="text-danger">{{ $errors->first('NIK') }}</span>
                                                @endif
                                            </div>
                                            <label for="NPWP" class="col-md-4 col-form-label text-md-end text-start">NPWP</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('NPWP') is-invalid @enderror"
                                                    id="NPWP" name="NPWP"
                                                    value="{{ Session::get('ownerSession.NPWP') }}">
                                                @if ($errors->has('NPWP'))
                                                    <span class="text-danger">{{ $errors->first('NPWP') }}</span>
                                                @endif
                                            </div>
                                            <label for="phone_number" class="col-md-4 col-form-label text-md-end text-start">phone_number</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    id="phone_number" name="phone_number"
                                                    value="{{ Session::get('ownerSession.phone_number') }}">
                                                @if ($errors->has('phone_number'))
                                                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                                @endif
                                            </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary float-right"
                                    name="info-usaha">Berikutnya</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
