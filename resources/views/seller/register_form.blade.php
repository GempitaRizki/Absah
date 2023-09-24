@extends('themes.ezone.footer')

@section('content')
    <div class="container mt-5" style="margin-bottom: 100px;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Informasi Toko</h3>
                <hr>
            </div>
        </div>
        <form method="POST" action="{{route('StoreSellerIndex')}}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="store_name">Store Name</label>
                        <input type="text" class="form-control" name="store_name" id="store_name"
                            value="{{ old('store_name', session('sellerData.store_name')) }}" placeholder="Store Name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="web_name">Web Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">https://</span>
                            </div>
                            <input type="text" class="form-control" name="web_name" id="web_name"
                                value="{{ old('web_name', session('sellerData.web_name')) }}" placeholder="Web Name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="public_email">Public Email</label>
                        <input type="text" class="form-control" name="public_email" id="public_email"
                            value="{{ old('public_email', session('sellerData.public_email')) }}"
                            placeholder="Public Email">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            value="{{ old('phone_number', session('sellerData.phone_number')) }}"
                            placeholder="Phone Number">
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
                    <!-- Empty column -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h3>Informasi Toko Detail</h3>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nib">NIB</label>
                        <input type="text" class="form-control" name="nib" id="nib"
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
                        <label for="pkp">Jenis PKP</label>
                        <select class="form-control" name="pkp" id="pkp">
                            <option value="PKP" {{ old('pkp') === 'PKP' ? 'selected' : '' }}>PKP</option>
                            <option value="Non_Pkp" {{ old('pkp') === 'Non_Pkp' ? 'selected' : '' }}>Non PKP</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <select name="kekayaan_bersih" id="kekayaan_bersih_dropdown">
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
                        <label for="npwp">NPWP</label>
                        <input type="text" class="form-control" name="npwp" id="npwp"
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
        document.addEventListener("DOMContentLoaded", function() {
            var kekayaanBersihDropdown = document.getElementById("kekayaan_bersih_dropdown");
            var kategoriUsahaDropdown = document.getElementById("kategori_usaha_dropdown");

            kekayaanBersihDropdown.addEventListener("change", function() {
                var kekayaanBersih = parseInt(kekayaanBersihDropdown.value);
                var kategoriUsaha = "";

                if (kekayaanBersih < 50000000) {
                    kategoriUsaha = "Mikro";
                } else if (kekayaanBersih >= 50000000 && kekayaanBersih <= 500000000) {
                    kategoriUsaha = "Kecil";
                } else if (kekayaanBersih > 500000000 && kekayaanBersih <= 10000000000) {
                    kategoriUsaha = "Menengah";
                }

                for (var i = 0; i < kategoriUsahaDropdown.options.length; i++) {
                    kategoriUsahaDropdown.options[i].removeAttribute("selected");
                }

                var selectedOption = document.querySelector("#kategori_usaha_dropdown option[value='" +
                    kategoriUsaha + "']");
                selectedOption.setAttribute("selected", "selected");

                kategoriUsahaDropdown.disabled = true;
            });
        });
    </script>
@endsection
