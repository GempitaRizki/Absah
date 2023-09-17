<div class="popular-product-active owl-carousel">
    @foreach ($products as $product)
    @php
    $product = $product->parent ?: $product;
    $productImage = $productImages->where('product_id', $product->id)->first(); // Mengambil gambar pertama untuk produk ini
    @endphp
    <div class="product-wrapper">
        <div class="section-title-furits bg-shape text-center mb-80">
            <a href="{{ url('product/'. $product->slug) }}" class="product-link">
                @if ($productImage)
                <img src="{{ asset('storage/' . $productImage->path) }}" alt="{{ $product->name }}" class="product-image">
                @else
                <p>No image available for {{ $product->name }}</p>
                @endif
            </a>
            <div class="product-action">
                <a class="animate-right quick-view" title="Quick View" product-slug="{{ $product->slug }}" href="{{ url('product/'. $product->slug) }}">
                    <i class="pe-7s-look"></i>
                </a>
            </div>
        </div>
        <div class="funiture-product-content text-center">
            <h4><a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a></h4>
            <span>Rp. {{number_format($product->priceLabel()) }}</span>
        </div>
    </div>
    @endforeach
</div>
