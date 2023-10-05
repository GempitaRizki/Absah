@extends('themes.ezone.footer')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <div class="d-flex justify-content-center">
        <img src="{{ url('assets/img/product/absahlogo.png') }}" alt="logoip.png" width="300px">
    </div>
    <div class="d-flex justify-content-center">
        <h2>Sekolah</h2>
    </div>
    </div>
    <div class="container mt-5" style="margin-bottom: 100px;">
        <div class="tab-pane" role="tabpanel" id="step4">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="login-form">
                                <form action="{{ route('index.infoSekolahStore') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="data_sekolah"
                                            class="col-md-4 col-form-label text-md-end text-start">Nama Sekolah</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('data_sekolah') is-invalid @enderror"
                                                id="data_sekolah" name="data_sekolah" value="data_sekolah">
                                            @if ($errors->has('data_sekolah'))
                                                <span class="text-danger">{{ $errors->first('data_sekolah') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="npsn"
                                            class="col-md-4 col-form-label text-md-end text-start">Npsn</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('npsn') is-invalid @enderror"
                                                id="npsn" name="npsn" value="npsn">
                                            @if ($errors->has('npsn'))
                                                <span class="text-danger">{{ $errors->first('npsn') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="npwp_dinas"
                                            class="col-md-4 col-form-label text-md-end text-start">Npwp</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('npwp_dinas') is-invalid @enderror"
                                                id="npwp_dinas" name="npwp_dinas" value="npwp_dinas">
                                            @if ($errors->has('npwp_dinas'))
                                                <span class="text-danger">{{ $errors->first('npwp_dinas') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bentuk_pendidikan"
                                            class="col-md-4 col-form-label text-md-end text-start">Jenjang</label>
                                        <div class="col-md-6">
                                            <select class="form-control @error('bentuk_pendidikan') is-invalid @enderror"
                                                id="bentuk_pendidikan" name="bentuk_pendidikan">
                                                <option value="MI">MI</option>
                                                <option value="MTs">MTs</option>
                                                <option value="MA">MA</option>
                                            </select>
                                            @if ($errors->has('bentuk_pendidikan'))
                                                <span class="text-danger">{{ $errors->first('bentuk_pendidikan') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status"
                                            class="col-md-4 col-form-label text-md-end text-start">Status</label>
                                        <div class="col-md-6">
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status">
                                                <option value="Negeri">Negeri</option>
                                                <option value="Swasta">Swasta</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="text-danger">{{ $errors->first('status') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email_sekolah"
                                            class="col-md-4 col-form-label text-md-end text-start">Email Sekolah</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('email_sekolah') is-invalid @enderror"
                                                id="email_sekolah" name="email_sekolah" value="email_sekolah">
                                            @if ($errors->has('email_sekolah'))
                                                <span class="text-danger">{{ $errors->first('email_sekolah') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_sekolah" class="col-md-4 col-form-label text-md-end text-start">Nomor
                                            Sekolah</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('no_sekolah') is-invalid @enderror"
                                                id="no_sekolah" name="no_sekolah" value="no_sekolah">
                                            @if ($errors->has('no_sekolah'))
                                                <span class="text-danger">{{ $errors->first('no_sekolah') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kepala_sekolah"
                                            class="col-md-4 col-form-label text-md-end text-start">Kepala Sekolah</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('kepala_sekolah') is-invalid @enderror"
                                                id="kepala_sekolah" name="kepala_sekolah" value="kepala_sekolah">
                                            @if ($errors->has('kepala_sekolah'))
                                                <span class="text-danger">{{ $errors->first('kepala_sekolah') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nip_kepala_sekolah"
                                            class="col-md-4 col-form-label text-md-end text-start">NIP / NIY Kepala
                                            Sekolah</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('nip_kepala_sekolah') is-invalid @enderror"
                                                id="nip_kepala_sekolah" name="nip_kepala_sekolah"
                                                value="nip_kepala_sekolah">
                                            @if ($errors->has('nip_kepala_sekolah'))
                                                <span
                                                    class="text-danger">{{ $errors->first('nip_kepala_sekolah') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bendahara_bos"
                                            class="col-md-4 col-form-label text-md-end text-start">Bendahara Bos</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('bendahara_bos') is-invalid @enderror"
                                                id="bendahara_bos" name="bendahara_bos" value="bendahara_bos">
                                            @if ($errors->has('bendahara_bos'))
                                                <span class="text-danger">{{ $errors->first('bendahara_bos') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nip_bendahara_bos"
                                            class="col-md-4 col-form-label text-md-end text-start">NIP / NIY Bendahara
                                            Bos</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('nip_bendahara_bos') is-invalid @enderror"
                                                id="nip_bendahara_bos" name="nip_bendahara_bos"
                                                value="nip_bendahara_bos">
                                            @if ($errors->has('nip_bendahara_bos'))
                                                <span class="text-danger">{{ $errors->first('nip_bendahara_bos') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="province" class="required-label">Provinsi</label>
                                                <select class="form-control" id="province" name="province" required>
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach($provinces as $province)
                                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="districts" class="required-label">Kabupaten</label>
                                                <select class="form-control" id="districts" name="districts" required>
                                                    <option value="">Pilih Kabupaten</option>
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="subdistricts" class="required-label">Kecamatan</label>
                                                <select class="form-control" id="subdistricts" name="subdistricts" required>
                                                    <option value="">Pilih Kecamatan</option>
                                                    @foreach($subdistricts as $subdistrict)
                                                        <option value="{{ $subdistrict->id }}">{{ $subdistrict->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="villages" class="required-label">Desa</label>
                                                <select class="form-control" id="villages" name="villages" required>
                                                    <option value="">Pilih Desa</option>
                                                    @foreach($villages as $village)
                                                        <option value="{{ $village->id }}">{{ $village->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat"
                                            class="col-md-4 col-form-label text-md-end text-start">Alamat</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('alamat') is-invalid @enderror"
                                                id="alamat" name="alamat"
                                                value="alamat">
                                            @if ($errors->has('alamat'))
                                                <span
                                                    class="text-danger">{{ $errors->first('alamat') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kode_pos"
                                            class="col-md-4 col-form-label text-md-end text-start">Kode Pos</label>
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control @error('kode_pos') is-invalid @enderror"
                                                id="kode_pos" name="kode_pos"
                                                value="kode_pos">
                                            @if ($errors->has('kode_pos'))
                                                <span
                                                    class="text-danger">{{ $errors->first('kode_pos') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    


                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <input type="submit" class="btn btn-primary" value="Berikutnya">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function populateProvinces() {
            var url = "{{ route('get-provinces-user') }}";

            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#province').empty();
                    $('#province').append('<option value="">Pilih Provinsi</option>');
                    $.each(data, function(key, value) {
                        $('#province').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                }
            });
        }

        $(document).ready(function() {
            populateProvinces();
        });

        function populateDistrictsByProvince(provinceId) {
            var url = "{{ route('get-districts-by-province-user', ':provinceId') }}".replace(':provinceId', provinceId);

            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#districts').empty();
                    $('#districts').append('<option value="">Pilih Kabupaten</option>');
                    $.each(data, function(key, value) {
                        $('#districts').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                }
            });
        }

        $('#province').change(function() {
            var provinceId = $(this).val();
            if (provinceId) {
                populateDistrictsByProvince(provinceId);
            } else {
                $('#districts').empty();
                $('#districts').append('<option value="">Pilih Kabupaten</option>');
            }
        });

        function populateSubDistrictsByDistrict(districtId) {
            var url = "{{ route('get-subdistricts-by-district-user', ':districtId') }}".replace(':districtId', districtId);

            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#subdistricts').empty();
                    $('#subdistricts').append('<option value="">Pilih Kecamatan</option>');
                    $.each(data, function(key, value) {
                        $('#subdistricts').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                }
            });
        }

        $('#districts').change(function() {
            var districtId = $(this).val();
            if (districtId) {
                populateSubDistrictsByDistrict(districtId);
            } else {
                $('#subdistricts').empty();
                $('#subdistricts').append('<option value="">Pilih Kecamatan</option>');
            }
        });

                function populateVillagesBySubDistrict(subdistrictId) {
            var url = "{{ route('get-villages-by-subdistrict-user', ':subdistrictId') }}".replace(':subdistrictId',
                subdistrictId);

            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#villages').empty();
                    $('#villages').append('<option value="">Pilih Desa</option>');
                    $.each(data, function(key, value) {
                        $('#villages').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                }
            });
        }

        $('#subdistricts').change(function() {
            var subdistrictId = $(this).val();
            if (subdistrictId) {
                populateVillagesBySubDistrict(subdistrictId);
            } else {
                $('#villages').empty();
                $('#villages').append('<option value="">Pilih Desa</option>');
            }
        });

        $(document).ready(function() {

            $('form').submit(function() {
                var province = $('#province').val();
                var districts = $('#districts').val();
                var subdistricts = $('#subdistricts').val();
                var villages = $('#villages').val();
                // var latitude = $('#lat').val();
                // var longitude = $('#lng').val();

                return true;
            });
        });
    </script>


@endsection
