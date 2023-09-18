<div class="popular-product-active owl-carousel">
    @foreach ($products as $product)
        @php
            $product = $product->parent ?: $product;
            $productImage = $productImages->where('product_id', $product->id)->first(); 
        @endphp
        <div class="product-wrapper">
            <div class="section-title-furits bg-shape text-center mb-80">
                <a href="{{ url('product/' . $product->slug) }}" class="product-link">
                    @if ($productImage)
                        <img src="{{ asset('storage/' . $productImage->path) }}" alt="{{ $product->name }}"
                            class="product-image">
                    @else
                        <p>No image available for {{ $product->name }}</p>
                    @endif
                </a>
                <div class="product-action">
                    <a class="animate-left add-to-fav" title="Wishlist"  product-slug="{{ $product->slug }}" href="">
                        <i class="pe-7s-like"></i>
                    </a>
                    <a class="animate-top add-to-card" title="Add To Cart" href="" product-id="{{ $product->id }}" product-type="{{ $product->type }}" product-slug="{{ $product->slug }}">
                        <i class="pe-7s-cart"></i>
                    </a>
                    <a class="animate-right quick-view" title="Quick View" product-slug="{{ $product->slug }}" href="">
                        <i class="pe-7s-look"></i>
                    </a>
                </div>
            </div>
            <div class="funiture-product-content text-center">
                <h4><a href="{{ url('product/' . $product->slug) }}">{{ $product->name }}</a></h4>
                <span>Rp. {{ number_format($product->priceLabel()) }}</span>
            </div>
        </div>
    @endforeach
</div>
