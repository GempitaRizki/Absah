@extends('themes.ezone.detaillayout')
@section('content')
    <div class="cart-main-area pt-95 pb-100 wishlist">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="cart-heading" style="font-size: 20px;"><b>{{ $storeName }}</b></h1>
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Remove</th>
                                        <th>Image</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="product-remove"><a href="#"><i class="pe-7s-close"></i></a></td>
                                        <td class="product-thumbnail">
                                            <a href="#">
                                                <img src="{{ asset('images/' . $imagePath) }}" alt=""
                                                    style="width: 185px; height: 112px;">
                                            </a>
                                        </td>
                                        <td class="product-name"><a href="#">{{ $productName }}</a></td>
                                        <td class="product-price-cart"><span class="amount">Rp.
                                                {{ number_format($price, 0, ',', '.') }} </span></td>
                                        <td class="product-quantity">
                                            <input value="{{ $qty }}" type="number" name="qty"
                                                class="cart-plus-minus-box" id="qty"
                                                style="margin: 0 auto; text-align: center;">
                                        </td>
                                        <td class="product-subtotal">Rp.
                                            {{ number_format( $qty * $price, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="sumber_dana_id">Sumber Dana</label>
                                        <select class="form-control" id="sumber_dana_id" name="sumberDana">
                                            <option value="">Pilih Sumber Dana</option>
                                            @foreach ($sumberDanas as $sumberDana)
                                                <option value="{{ $sumberDana->id }}">{{ $sumberDana->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="shipping_method">Metode Pengiriman</label>
                                        <select class="form-control" id="shipping_method" name="partnerCourier">
                                            <option value="">Pilih Metode Pengiriman</option>
                                            @foreach ($partnerCouriers as $partnerCourier)
                                                <option value="{{ $partnerCourier->id }}">{{ $partnerCourier->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="denda">Denda</label>
                                        <input type="text" class="form-control" id="denda"
                                            placeholder="Masukan Jumlah Denda" name="denda">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="etimasi_pebayaran">Estimasi Pembayaran</label>
                                        <input type="text" class="form-control" id="etimasi_pebayaran"
                                            placeholder="Masukan tanggal estimasi Pembayaran" name="etimasi_pebayaran">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="payment_method">Metode Pembayaran</label>
                                        <select class="form-control" id="payment_method" name="payment_method">
                                            <option value="">Pilih Metode Pembayaran</option>
                                            @foreach ($metodePembayaran as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h1 class="cart-heading" style="font-size: 20px;"><b>Lengkapi Data Anda</b></h1>
                        <div class="d-flex">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" placeholder="Sumber Dana"
                                        name="sumberDana">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="name" placeholder="Sumber Dana"
                                        name="sumberDana">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">NPWP</label>
                                    <input type="text" class="form-control" id="name" placeholder="Sumber Dana"
                                        name="sumberDana">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">No Telepon Sekolah</label>
                                    <input type="text" class="form-control" id="name" placeholder="Sumber Dana"
                                        name="sumberDana">
                                </div>
                            </div>
                        </div>
                        <div class=d-flex>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="province" class="required-label">Provinsi</label>
                                    <select class="form-control" id="province" name="province" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="districts" class="required-label">Kabupaten</label>
                                    <select class="form-control" id="districts" name="districts" required>
                                        <option value="">Pilih Kabupaten</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="subdistricts" class="required-label">Kecamatan</label>
                                    <select class="form-control" id="subdistricts" name="subdistricts" required>
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach ($subdistricts as $subdistrict)
                                            <option value="{{ $subdistrict->id }}">{{ $subdistrict->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="villages" class="required-label">Desa</label>
                                    <select class="form-control" id="villages" name="villages" required>
                                        <option value="">Pilih Desa</option>
                                        @foreach ($villages as $village)
                                            <option value="{{ $village->id }}">{{ $village->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Jalan</label>
                                <input type="text" class="form-control" id="name" placeholder="Sumber Dana"
                                    name="sumberDana">
                            </div>
                        </div>
                        <div class="card-body">
                            <label for="name"><strong>Pengiriman Yang Dipilih</strong></label>
                            <p>Metode Kirim : Kirim Sendiri Oleh Penyedia</p>
                            <p>Estimasi Kirim : 0</p>
                            <p>Biaya Kirim :</p>
                            <p>Catatan Pengiriman : -</p>
                        </div>
                    </form>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Buat Pesanan Sekaligus dapat dilakukan setelah informasi yang di minta pada masing - masing penjual
                        terpenuhi.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 bg-light text-left">
                                <button type="button" class="btn btn-primary">Buat Pesanan</button>
                                <button type="button" class="btn btn-warning ml-2">Perbarui Keranjang</button>
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
