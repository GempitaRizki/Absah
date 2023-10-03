@extends('themes.ezone.footer')

@section('content')
    <div class="container mt-5" style="margin-bottom: 100px;">
        <h3>Informasi Pengguna Registrasi</h3>
        <div class="logo-2 furniture-logo ptb-30">
            <a href="/">
                <img src="{{ url('assets/img/logo/logo-3.png') }}" alt="">
            </a>
        </div>
        <div class="row">
            <div class="col-lg-12 text-right">
                <a href="{{ route('registrationSummary') }}" class="btn btn-primary" name="info-usaha">Preview Data</a>
                <a href="{{ route('uploadForm') }}" class="btn btn-secondary" name="info-usaha">Upload</a>
            </div>
        </div>

        <h4>Informasi Toko</h4>
        <ul>
            <li><strong>Surel:</strong> {{ session('storeSession.surel') }}</li>
            <li><strong>Seller Type:</strong> {{ session('storeSession.seller_type') }}</li>
            <li><strong>Nama Toko:</strong> {{ session('storeSession.store_name') }}</li>
        </ul>

        <h4>Informasi Toko (Form)</h4>
        <ul>
            <li><strong>Nama Toko:</strong> {{ session('storeFormSession.store_name') }}</li>
            <li><strong>Web Name:</strong> {{ session('storeFormSession.web_name') }}</li>
            <li><strong>Public Email:</strong> {{ session('storeFormSession.public_email') }}</li>
            <li><strong>Phone Number:</strong> {{ session('storeFormSession.phone_number') }}</li>
            <li><strong>Description:</strong> {{ session('storeFormSession.short_description') }}</li>
            <li><strong>About:</strong> {{ session('storeFormSession.about_us') }}</li>
            <li><strong>Facebook:</strong> {{ session('storeFormSession.fb_name') }}</li>
            <li><strong>Twitter:</strong> {{ session('storeFormSession.tw_name') }}</li>
            <li><strong>Linkedin:</strong> {{ session('storeFormSession.linked_name') }}</li>
            <li><strong>Instagram:</strong> {{ session('storeFormSession.inst_name') }}</li>
            <li><strong>Youtube:</strong> {{ session('storeFormSession.yt_name') }}</li>
            <li><strong>NIB:</strong> {{ session('storeFormSession.nib') }}</li>
            <li><strong>SKB:</strong> {{ session('storeFormSession.skb') }}</li>
            <li><strong>AKTA:</strong> {{ session('storeFormSession.akta') }}</li>
            <li><strong>SIUP:</strong> {{ session('storeFormSession.siup') }}</li>
            <li><strong>Akta Perusahaan:</strong> {{ session('storeFormSession.akta_perusahaan') }}</li>
            <li><strong>NPWP:</strong> {{ session('storeFormSession.npwp') }}</li>
            <li><strong>TDP:</strong> {{ session('storeFormSession.tdp') }}</li>
            <li><strong>KBLI:</strong> {{ session('storeFormSession.kbli') }}</li>
            <li><strong>Kekayaan Bersih:</strong> Rp.
                {{ number_format(session('storeFormSession.kekayaan_bersih'), 0, ',', '.') }}</li>
            <li><strong>Kategori Usaha:</strong> {{ session('storeFormSession.kategori_usaha') }}</li>

        </ul>

        <h4>Informasi TTD</h4>
        <ul>
            <li><strong>Nama:</strong> {{ session('ownerSession.nama') }}</li>
            <li><strong>Jabatan:</strong> {{ session('ownerSession.jabatan') }}</li>
            <li><strong>NIK:</strong> {{ session('ownerSession.NIK') }}</li>
            <li><strong>NPWP:</strong> {{ session('ownerSession.NPWP') }}</li>
            <li><strong>Phone Number:</strong> {{ session('ownerSession.phone_number') }}</li>

        </ul>

        <h4>Informasi Lokasi</h4>
        <ul>
            <li><strong>Provinsi:</strong> {{ isset($province) ? $province->name : 'Belum Dipilih' }}</li>
            <li><strong>Kabupaten:</strong> {{ isset($districts) ? $districts->name : 'Belum Dipilih' }}</li>
            <li><strong>Kecamatan:</strong> {{ isset($subdistricts) ? $subdistricts->name : 'Belum Dipilih' }}</li>
            <li><strong>Desa:</strong> {{ isset($villages) ? $villages->name : 'Belum Dipilih' }}</li>
        </ul>

        </ul>
        <h4>Wilayah Jual</h4>
        <ul>
            @if ($wilayahJualDistricts !== null && $wilayahJualDistricts->count() > 0)
                @foreach ($wilayahJualDistricts as $district)
                    <li>{{ $district->name }}</li>
                @endforeach
            @else
                <li>Tidak ada wilayah jual yang dipilih.</li>
            @endif
        </ul>
        
        

        <h4>Informasi Bank</h4>
        <ul>
            <li><strong>Bank:</strong> {{ session('bankSession.bank_id') }}</li>
            <li><strong>Nomor Rekening:</strong> {{ session('bankSession.number') }}</li>
            <li><strong>Nama Pemilik Rekening:</strong> {{ session('bankSession.name') }}</li>
        </ul>
        <hr>
        <button type="submit and checkbox" class="btn btn-primary float-right" name="info-usaha">Simpan & Lanjutkan</button>
    </div>
@endsection
