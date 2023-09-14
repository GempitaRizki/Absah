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
                                <form action="{{ route('infosekolah-submit') }}" method="POST">
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

                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select name="provinsi" id="provinsi">
                                            <option value="">Provinsi</option>
                                        </select>
                                        <input type="hidden" name="provinsi" value="">
                                    </div>

                                    <div class="form-group">
                                        <label>kota</label>
                                        <select name="kota" id="kota">
                                            <option>kota</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>kecamatan</label>
                                        <select name="kecamatan" id="kecamatan">
                                            <option>kecamatan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>kelurahan</label>
                                        <select name="kelurahan" id="kelurahan">
                                            <option>kelurahan</option>
                                        </select>
                                    </div>

                                    <!-- disini -->
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
                var tampung = '<option>Pilih</option>';
                data.forEach(element => {
                    tampung +=
                        `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('provinsi').innerHTML = tampung;
            });
    </script>
    <script>
        const selectProvinsi = document.getElementById('provinsi');
        const selectKota = document.getElementById('kota');
        const selectKecamatan = document.getElementById('kecamatan');
        const selectKelurahan = document.getElementById('kelurahan');
    
        const selectedOptions = {
            provinsi: "",
            kota: "",
            kecamatan: "",
            kelurahan: ""
        };
    
        selectProvinsi.addEventListener('change', (e) => {
            selectedOptions.provinsi = e.target.value;
            updateSelectedOptions();
        });
    
        selectKota.addEventListener('change', (e) => {
            selectedOptions.kota = e.target.value;
            updateSelectedOptions();
        });
    
        selectKecamatan.addEventListener('change', (e) => {
            selectedOptions.kecamatan = e.target.value;
            updateSelectedOptions();
        });
    
        selectKelurahan.addEventListener('change', (e) => {
            selectedOptions.kelurahan = e.target.value;
            updateSelectedOptions();
        });
    
        function updateSelectedOptions() {
            const selectedOptionsJSON = JSON.stringify(selectedOptions);
            document.getElementById('selectedOptions').value = selectedOptionsJSON;
        }
    </script>
<script>
    const selectProvinsi = document.getElementById('provinsi');
    selectProvinsi.addEventListener('change', (e) => {
        var provinsi = e.target.options[e.target.selectedIndex].dataset.reg;
        var selectedProvinsi = e.target.options[e.target.selectedIndex].value;
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
            .then(response => response.json())
            .then(regencies => {
                var data = regencies;
                var tampung = '<option>Pilih</option>';
                document.getElementById('kota').innerHTML = '<option>Pilih</option>';
                document.getElementById('kecamatan').innerHTML = '<option>Pilih</option>';
                document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                data.forEach(element => {
                    tampung +=
                        `<option data-dist="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('kota').innerHTML = tampung;
            })
            .catch(error => console.error('Error fetching data:', error)); 
    });
    const selectKota = document.getElementById('kota');
    selectKota.addEventListener('change', (e) => {
        var kota = e.target.options[e.target.selectedIndex].dataset.dist;
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
            .then(response => response.json())
            .then(districts => {
                var data = districts;
                var tampung = '<option>Pilih</option>';
                document.getElementById('kecamatan').innerHTML = '<option>Pilih</option>';
                document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                data.forEach(element => {
                    tampung +=
                        `<option data-vill="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('kecamatan').innerHTML = tampung;
            })
            .catch(error => console.error('Error fetching data:', error)); 
    });
    const selectKecamatan = document.getElementById('kecamatan');
    selectKecamatan.addEventListener('change', (e) => {
        var kecamatan = e.target.options[e.target.selectedIndex].dataset.vill;
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
            .then(response => response.json())
            .then(villages => {
                var data = villages;
                var tampung = '<option>Pilih</option>';
                document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                data.forEach(element => {
                    tampung +=
                        `<option value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('kelurahan').innerHTML = tampung;
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
