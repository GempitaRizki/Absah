<div class="row">
    <div class="col-md-6">
        <select name="kekayaan_bersih" id="kekayaan_bersih_dropdown" required>
            <option value="">Range Kekayaan Bersih</option>
            <option value="50000000">Kurang dari Rp. 50.000.000</option>
            <option value="500000000">Rp. 50.000.000 - Rp. 500.000.000</option>
            <option value="10000000000">Rp. 500.000.000 - Rp. 10.000.000.000</option>
        </select>
    </div>
    <div class="col-md-6">
        <div id="kategori_usaha_container">
            <select name="kategori_usaha" id="kategori_usaha_dropdown" disabled>
                <option value="">Kategori Usaha</option>
                <option value="Mikro">Mikro</option>
                <option value="Kecil">Kecil</option>
                <option value="Menengah">Menengah</option>
            </select>
        </div>
    </div>
</div>

<script>
    var kekayaanBersihDropdown = document.getElementById('kekayaan_bersih_dropdown');
    var kategoriUsahaDropdown = document.getElementById('kategori_usaha_dropdown');
    var kategoriUsahaContainer = document.getElementById('kategori_usaha_container');

    kekayaanBersihDropdown.addEventListener('change', function () {
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
        kategoriUsahaContainer.removeChild(kategoriUsahaDropdown);
    });
</script>
