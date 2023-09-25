@extends('seller.topbar')

@section('content')
    <style>
        .required-label::after {
            content: " *";
            color: red;
        }
    </style>
    <div class="container mt-5" style="margin-bottom: 100px;">
        <div class="row">
            <div class="col-lg-12">
                <h2 style="text-align: center">Informasi Toko</h2>
                <hr>
            </div>
        </div>
        <form method="POST" action="{{ route('StoreSellerIndex') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="store_name" class="col-md-4 col-form-label text-md-end text-start required-label">Nama Toko</label>
                        <input type="text" class="form-control" name="store_name" id="store_name" required
                            value="{{ old('store_name', session('storeSession.store_name')) }}" placeholder="Store Name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="web_name">Laman Website</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">https://</span>
                            </div>
                            <input type="text" class="form-control" name="web_name" id="web_name"
                                value="{{ old('web_name', session('sellerData.web_name')) }}" placeholder="Laman Website">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="public_email" class="col-md-4 col-form-label text-md-end text-start required-label">Email Public</label>
                        <input type="text" class="form-control" name="public_email" id="public_email" required
                            value="{{ old('public_email', session('sellerData.public_email')) }}"
                            placeholder="Email Publik">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-end text-start required-label">No Hp</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number" required
                            value="{{ old('phone_number', session('sellerData.phone_number')) }}"
                            placeholder="Nomor Telepon">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="short_description">Short Description</label>
                <input type="text" class="form-control" name="short_description" id="short_description"
                    value="{{ old('short_description', session('sellerData.short_description')) }}"
                    placeholder="Short Description">
            </div>

            <div class="form-group">
                <label for="about_us">Description</label>
                <textarea class="form-control" name="about_us" id="about_us" rows="6">{{ old('about_us', session('sellerData.about_us')) }}</textarea>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="fb_name">Facebook Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">https://facebook.com/</span>
                            </div>
                            <input type="text" class="form-control" name="fb_name" id="fb_name"
                                value="{{ old('fb_name', session('sellerData.fb_name')) }}" placeholder="Facebook Name">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tw_name">Twitter Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">https://twitter.com/</span>
                            </div>
                            <input type="text" class="form-control" name="tw_name" id="tw_name"
                                value="{{ old('tw_name', session('sellerData.tw_name')) }}" placeholder="Twitter Name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="linked_name">LinkedIn Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">https://linkedin.com/in/</span>
                            </div>
                            <input type="text" class="form-control" name="linked_name" id="linked_name"
                                value="{{ old('linked_name', session('sellerData.linked_name')) }}"
                                placeholder="LinkedIn Name">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="yt_name">YouTube Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">https://youtube.com/c/</span>
                            </div>
                            <input type="text" class="form-control" name="yt_name" id="yt_name"
                                value="{{ old('yt_name', session('sellerData.yt_name')) }}" placeholder="YouTube Name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inst_name">Instagram Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">https://instagram.com/</span>
                            </div>
                            <input type="text" class="form-control" name="inst_name" id="inst_name"
                                value="{{ old('inst_name', session('sellerData.inst_name')) }}"
                                placeholder="Instagram Name">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <h2 style="text-align: center">Informasi Toko Detail</h2>
                    <br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nib" class="col-md-4 col-form-label text-md-end text-start required-label">NIB</label>
                        <input type="text" class="form-control" name="nib" id="nib" required
                            value="{{ old('nib') }}" placeholder="NIB">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="skb">SKB</label>
                        <input type="text" class="form-control" name="skb" id="skb"
                            value="{{ old('skb') }}" placeholder="SKB">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="kepemilikan_usaha">Kepemilikan Usaha</label>
                        <select class="form-control" name="kepemilikan_usaha" id="kepemilikan_usaha">
                            <option value="Firma" {{ old('kepemilikan_usaha') === 'Firma' ? 'selected' : '' }}>Firma
                            </option>
                            <option value="CV" {{ old('kepemilikan_usaha') === 'CV' ? 'selected' : '' }}>CV</option>
                            <option value="PT" {{ old('kepemilikan_usaha') === 'PT' ? 'selected' : '' }}>PT</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="pkp" class="col-md-4 col-form-label text-md-end text-start required-label">PKP</label>
                        <select class="form-control" name="pkp" id="pkp" required>
                            <option value="PKP" {{ old('pkp') === 'pkp' ? 'selected' : '' }}>PKP</option>
                            <option value="Non PKP" {{ old('pkp') === 'pkp' ? 'selected' : '' }}>Non PKP</option>
                        </select>     
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select name="kekayaan_bersih" id="kekayaan_bersih_dropdown" required>
                        <option value="">Range Kekayaan Bersih</option>
                        <option value="50000000">Kurang dari Rp. 50.000.000</option>
                        <option value="500000000">Rp. 50.000.000 - Rp. 500.000.000</option>
                        <option value="10000000000">Rp. 500.000.000 - Rp. 10.000.000.000</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <select name="kategori_usaha" id="kategori_usaha_dropdown" disabled>
                        <option value="">Kategori Usaha</option>
                        <option value="Mikro">Mikro</option>
                        <option value="Kecil">Kecil</option>
                        <option value="Menengah">Menengah</option>
                    </select>
                </div>
            </div>            
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="akta">Akta</label>
                        <input type="text" class="form-control" name="akta" id="akta"
                            value="{{ old('akta') }}" placeholder="Akta">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="akta_perusahaan">Akta Perusahaan</label>
                        <input type="text" class="form-control" name="akta_perusahaan" id="akta_perusahaan"
                            value="{{ old('akta_perusahaan') }}" placeholder="Akta Perusahaan">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="npwp" class="col-md-4 col-form-label text-md-end text-start required-label">NPWP</label>
                        <input type="text" class="form-control" name="npwp" id="npwp" required
                            value="{{ old('npwp') }}" placeholder="NPWP">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="siup">SIUP</label>
                        <input type="text" class="form-control" name="siup" id="siup"
                            value="{{ old('siup') }}" placeholder="SIUP">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tdp">TDP</label>
                        <input type="text" class="form-control" name="tdp" id="tdp"
                            value="{{ old('tdp') }}" placeholder="TDP">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="kbli">KBLI</label>
                        <input type="text" class="form-control" name="kbli" id="kbli"
                            value="{{ old('kbli') }}" placeholder="KBLI">
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
        var kekayaanBersihDropdown = document.getElementById('kekayaan_bersih_dropdown');
        var kategoriUsahaDropdown = document.getElementById('kategori_usaha_dropdown');
    
        kekayaanBersihDropdown.addEventListener('change', function() {
            var selectedValue = this.value;
    
            var kategoriUsaha = '';
            if (selectedValue === '50000000') {
                kategoriUsaha = 'Mikro';
            } else if (selectedValue === '500000000') {
                kategoriUsaha = 'Kecil';
            } else if (selectedValue === '10000000000') {
                kategoriUsaha = 'Menengah';
            }
    
            kategoriUsahaDropdown.value = kategoriUsaha;
            kategoriUsahaDropdown.disabled = false;
        });
    </script>
    
@endsection
