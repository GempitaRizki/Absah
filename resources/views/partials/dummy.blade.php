@if ($productImages->count() > 0)
    <div class="container">
        <div class="product-wrapper">
            <div class="section-title-furits bg-shape text-center mb-80">
                <h2>Produk</h2>
            </div>
            <div class="product-style">
                <div class="popular-product-active owl-carousel">
                    @foreach ($productImages as $key => $productImage)
                        @if (isset($productSkus[$key]) && isset($productPrices[$key]) && $key < 2) 
                            <div class="product-wrapper">
                                <div class="product-image">
                                    <a href="{{ route('product.detail', ['slug' => $productSkus[$key]->slug]) }}">
                                        <img src="{{ asset('images/' . $productImage->path) }}" alt="Product Image" style="max-width: 200px; height: auto;">
                                    </a>
                                    <div class="product-action">
                                        <a class="animate-right quick-view" title="Quick View"
                                            product-slug="{{ $productSkus[$key]->slug }}" href=#>
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="funiture-product-content text-center">
                                    <h4>{{ $productSkus[$key]->name }}</h4>
                                    <span>Harga: Rp {{ number_format($productPrices[$key]->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
<style>
    .product-item {
        text-decoration: none;
        color: #000;
        display: block;
    }
</style>
