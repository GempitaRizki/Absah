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

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="provinsi"
                                                class="col-md-4 col-form-label text-md-end text-start required-label">Provinsi</label>
                                            <select class="form-control" id="provinsiDropdown" name="provinsi"
                                                value="{{ old('provinsi') }}" required>
                                                <option value="">Pilih Provinsi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="kota"
                                                class="col-md-4 col-form-label text-md-end text-start required-label">Kota/Kabupaten</label>
                                            <select class="form-control" id="kotaDropdown" name="kota"
                                                value="{{ old('kota') }}" required>
                                                <option value="">Pilih Kota/Kabupaten</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="kecamatan"
                                                class="col-md-4 col-form-label text-md-end text-start required-label">Kecamatan</label>
                                            <select class="form-control" id="kecamatanDropdown" name="kecamatan"
                                                value="{{ old('kecamatan') }}" required>
                                                <option value="">Pilih Kecamatan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="kelurahan"
                                                class="col-md-4 col-form-label text-md-end text-start required-label">Kelurahan/Desa</label>
                                            <select class="form-control" id="kelurahanDropdown" name="kelurahan"
                                                value="{{ old('kelurahan') }}" required>
                                                <option value="">Pilih Kelurahan/Desa</option>
                                            </select>
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


    <script>
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
            .then(response => response.json())
            .then(provinces => {
                var data = provinces;
                var tampung = '<option value="">Pilih</option>';
                data.forEach(element => {
                    tampung +=
                        `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('provinsiDropdown').innerHTML = tampung;
            });

        const selectProvinsi = document.getElementById('provinsiDropdown');
        const selectKota = document.getElementById('kotaDropdown');
        const selectKecamatan = document.getElementById('kecamatanDropdown');
        const selectKelurahan = document.getElementById('kelurahanDropdown');

        const selectedOptions = {
            provinsi: "",
            kota: "",
            kecamatan: "",
            kelurahan: ""
        };

        selectProvinsi.addEventListener('change', (e) => {
            var provinsi = e.target.options[e.target.selectedIndex].dataset.reg;
            var selectedProvinsi = e.target.options[e.target.selectedIndex].value;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
                .then(response => response.json())
                .then(regencies => {
                    var data = regencies;
                    var tampung = '<option value="">Kota/Kabupaten</option>';
                    selectKecamatan.innerHTML = '<option value="">Kecamatan</option>';
                    selectKelurahan.innerHTML = '<option value="">Kelurahan/Desa</option>';
                    data.forEach(element => {
                        tampung +=
                            `<option data-dist="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    selectKota.innerHTML = tampung;
                })
                .catch(error => console.error('Error fetching data:', error));
        });

        selectKota.addEventListener('change', (e) => {
            var kota = e.target.options[e.target.selectedIndex].dataset.dist;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
                .then(response => response.json())
                .then(districts => {
                    var data = districts;
                    var tampung = '<option value="">Kecamatan</option>';
                    selectKelurahan.innerHTML = '<option value="">Kelurahan/Desa</option>';
                    data.forEach(element => {
                        tampung +=
                            `<option data-vill="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    selectKecamatan.innerHTML = tampung;
                })
                .catch(error => console.error('Error fetching data:', error));
        });

        selectKecamatan.addEventListener('change', (e) => {
            var kecamatan = e.target.options[e.target.selectedIndex].dataset.vill;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
                .then(response => response.json())
                .then(villages => {
                    var data = villages;
                    var tampung = '<option value="">Kelurahan/Desa</option>';
                    data.forEach(element => {
                        tampung +=
                            `<option value="${element.name}">${element.name}</option>`;
                    });
                    selectKelurahan.innerHTML = tampung;
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>

    <script>
        document.getElementById('npwp_dinas').addEventListener('input', function(e) {
            var npwp = e.target.value.replace(/\D/g, '');
            npwp = npwp.substring(0, 15);

            if (npwp.length > 0) {
                npwp = npwp.match(new RegExp('.{1,3}', 'g')).join('.');
                npwp = npwp.substring(0, 17) + '-' + npwp.substring(17);
            }

            e.target.value = npwp;
        });
    </script>
@endsection
