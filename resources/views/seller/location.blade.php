@extends('seller.topbar')

@section('content')
    <style>
        .required-label::after {
            content: " *";
            color: red;
        }
    </style>

    <div class="container mt-5" style="margin-bottom: 100px;">
        <form method="POST" action="{{ route('LocationServiceStore') }}">
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
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="address" class="form-control" id="address" name="address" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="postal_code">Kode Post</label>
                            <input type="postal_code" class="form-control" id="postal_code" name="postal_code" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary float-right" name="info-usaha">Berikutnya</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function populateProvinces() {
            var url = "{{ route('get-provinces') }}";

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
            var url = "{{ route('get-districts-by-province', ':provinceId') }}".replace(':provinceId', provinceId);

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
            var url = "{{ route('get-subdistricts-by-district', ':districtId') }}".replace(':districtId', districtId);

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
            var url = "{{ route('get-villages-by-subdistrict', ':subdistrictId') }}".replace(':subdistrictId',
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
