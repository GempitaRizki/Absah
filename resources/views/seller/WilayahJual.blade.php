@extends('seller.topbar')

@section('content')
<div class="container mt-5" style="margin-bottom: 100px;">
    <form method="POST" action="{{ route('StoreWilayahJualForm') }}">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button type="button" class="pull-right btn btn-primary"><i class="fa fa-plus"></i>Tambah
                            Wilayah
                            Jual</button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body container-items">
                        <div class="item panel panel-default">
                            <div class="panel-heading">
                                <span class="panel-title-address">Wilayah Jual: 1</span>
                                <button type="button" class="pull-right btn btn-danger"><i
                                        class="fa fa-minus"></i>Hapus</button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <input type="hidden" name="WilayahJual[0][id]">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p><b>Region Type</b></p>
                                        <select name="WilayahJual[0][region_type]"
                                            class="form-control form-control-lg">
                                            <option value="Regional">Regional</option>
                                            <option value="Nasional">Nasional</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row" id="showKota">
                                    <div class="col-sm-12">
                                        <p><b>Districts</b></p>
                                        <select name="WilayahJual[0][districts][]"
                                            class="form-control form-control-lg" multiple id="districtSelect"
                                            size="5" style="height: 200px; font-size: 16px;">
                                        </select>
                                        <div id="selectedOptions">
                                            <b>Data yang Disimpan:</b>
                                            <ul>
                                                @foreach (session('selectedDistricts', []) as $district)
                                                    <li>{{ isset($district['name']) ? $district['name'] : 'Nama Tidak Dapat Ditemukan' }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary float-right" name="info-usaha">Berikutnya</button>
            </div>
        </div>
    </form>
</div>
<script>
    const districtSelect = document.getElementById('districtSelect');

    function fetchRegenciesForProvince(provinceId) {
        const apiUrl = `https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinceId}.json`;

        return fetch(apiUrl)
            .then(response => response.json())
            .then(regencies => {
                regencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.id;
                    option.textContent = regency.name;
                    option.setAttribute('data-province-id', provinceId);
                    districtSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error(`Terjadi kesalahan saat mengambil data kabupaten untuk provinsi ${provinceId}:`,
                    error);
            });
    }

    for (let provinceId = 1; provinceId <= 94; provinceId++) {
        fetchRegenciesForProvince(provinceId);
    }

    districtSelect.addEventListener('change', () => {
        const selectedOptions = Array.from(districtSelect.selectedOptions).map(option => option.textContent);
        const selectedOptionsDiv = document.getElementById('selectedOptions');
        selectedOptionsDiv.innerHTML = '<b>Data yang dipilih:</b> ' + selectedOptions.join(', ');
    });
</script>
@endsection
