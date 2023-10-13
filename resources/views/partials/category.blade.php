<div class="all-products-area pt-115 pb-50">
    <div class="ps-top-categories" style="padding: 0px;">
        <div class="ps-container">
            <div class="section-title-3 text-center mb-50">
                <h2>Kategori Barang</h2>
            </div>
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6">
                    <div class="ps-block--category" style="border: none;padding:0px; text-align: center;">
                        <a class="ps-block__overlay" href="{{ url('products?category=' . $category->slug) }}"></a>
                        <a href="{{ url('products?category=' . $category->slug) }}">
                            <img src="{{ url('assets/img/product/' . $category->image) }}" style="max-width: 100%; height: auto;">
                        </a>
                        <div style="font-weight: bold; margin-top: 5px;">
                            <a href="{{ url('products?category=' . $category->slug) }}">{{ $category->name }}</a>
                        </div>
                        {{-- <p>Jumlah Produk: {{ $category->products->count() }}</p> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
