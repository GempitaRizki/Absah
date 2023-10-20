<div class="form-group">
    <label for="tipe_kategori_id" class="mb-1 h6">Tipe Kategori</label>
    <select id="tipe_kategori_id" class="form-control" name="tipe_kategori_id">
        <option value="1">Barang</option>
        <option value="2">Jasa</option>
    </select>
</div>

<div class="form-group">
    <label for="kategori_id" class="mb-1 h6">Kategori</label>
    <select id="kategori_id" class="form-control" name="kategori_id">
    </select>
</div>
<script>
    var kategoriData = {
        1: ['Kategori 1A', 'Kategori 1B', 'Kategori 1C'],
        2: ['Kategori 2A', 'Kategori 2B', 'Kategori 2C']
    };

    var tipeKategoriSelect = document.getElementById('tipe_kategori_id');
    var kategoriSelect = document.getElementById('kategori_id');

    tipeKategoriSelect.addEventListener('change', function() {
        var selectedValue = this.value;
        var kategoriOptions = kategoriData[selectedValue];

        kategoriSelect.innerHTML = '';

        kategoriOptions.forEach(function(kategori) {
            var option = document.createElement('option');
            option.value = kategori;
            option.text = kategori;
            kategoriSelect.appendChild(option);
        });
    });
</script>
