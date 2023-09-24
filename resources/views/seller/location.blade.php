@extends('themes.ezone.footer')

@section('content')
    <div class="container mt-5" style="margin-bottom: 100px;">
        <form method="POST" action="{{ route('IndexSellerLocationStore') }}">
            @csrf 
            <div class="tab-pane" role="tabpanel" id="step4">
                <h3>Alamat Toko</h3>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="map" style="width: 100%; height: 480px;"></div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="lat">Latitude</label>
                            <input type="text" class="form-control" id="lat" name="latitude" readonly required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="lng">Longitude</label>
                            <input type="text" class="form-control" id="lng" name="longitude" readonly required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="province">Provinsi</label>
                            <select class="form-control" id="province" name="province" value="province" required>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="districts">Kabupaten</label>
                            <select class="form-control" id="districts" name="districts" value="districts" required>
                                <option>Pilih Kabupaten</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="subdistricts">Kecamatan</label>
                            <select class="form-control" id="subdistricts" name="subdistricts" required>
                                <option value="subdistricts">Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="village">Kelurahan / Desa</label>
                            <select class="form-control" id="village" name="village">
                                <option value="village">Pilih Kelurahan / Desa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label for="address">Nama Jalan</label>
                            <input type="text" class="form-control" id="address" name="address" maxlength="255" required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="postal_code">Kode Pos</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" maxlength="10">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary float-right" name="info-usaha">Berikutnya</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
            .then(response => response.json())
            .then(province => {
                var data = province;
                var dataTampung = '<option>Pilih Provinsi</option>';
                data.forEach(element => {
                    dataTampung +=
                        `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('province').innerHTML = dataTampung;
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
    <script>
        const selectProvince = document.getElementById('province');
    
        selectProvince.addEventListener('change', (e) => {
            var province = e.target.options[e.target.selectedIndex].getAttribute('data-reg');
    
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${province}.json`)
                .then(response => response.json())
                .then(districts => {
                    var data = districts;
                    var dataTampung = '<option>Pilih Kabupaten</option>';
                    document.getElementById('districts').innerHTML = '<option>Pilih</option>';
                    document.getElementById('subdistricts').innerHTML = '<option>Pilih</option>';
                    document.getElementById('village').innerHTML = '<option>Pilih</option>';
                    data.forEach(element => {
                        dataTampung +=
                            `<option data-dist="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById('districts').innerHTML = dataTampung;
                })
                .catch(error => console.error('Error fetching Data:', error));
        });
    
        const selectDistricts = document.getElementById('districts');
    
        selectDistricts.addEventListener('change', (e) => {
            var districts = e.target.options[e.target.selectedIndex].getAttribute('data-dist');
    
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${districts}.json`)
                .then(response => response.json())
                .then(DistrictData => {
                    var data = DistrictData;
                    var dataTampung = '<option>Pilih</option>';
                    document.getElementById('subdistricts').innerHTML = '<option>Pilih</option>';
                    document.getElementById('village').innerHTML = '<option>Pilih</option>';
                    data.forEach(element => {
                        dataTampung +=
                            `<option data-vill="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById('subdistricts').innerHTML = dataTampung;
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    
        const selectSubdistricts = document.getElementById('subdistricts');
    
        selectSubdistricts.addEventListener('change', (e) => {
            var subdistricts = e.target.options[e.target.selectedIndex].getAttribute('data-vill');
    
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${subdistricts}.json`)
                .then(response => response.json())
                .then(village => {
                    var data = village;
                    var dataTampung = '<option>Pilih</option>';
                    data.forEach(element => {
                        dataTampung += `<option value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById('village').innerHTML = dataTampung;
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
    
@endsection
