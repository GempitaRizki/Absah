<!-- product area start -->
@if ($products)
<div class="product-style-area gray-bg-4 pb-105">
	<div class="container-fluid">
		<div class="section-title-furits bg-shape text-center mb-80">
			<img src="{{url('assets/img/icon-img/absah.png')}}" alt="">
			<h2>Product Terbaru</h2>
		</div>
		<div class="product-style">
			<div class="popular-product-active owl-carousel">
				@foreach ($products as $product)
				@php
				$product = $product->parent ?: $product;
				@endphp
				<div class="product-wrapper">
					<div class="section-title-furits bg-shape text-center mb-80">
						<a href="{{ url('product/'. $product->slug) }}">
							@if ($product->productImages->first())
							<img src="{{ $product->productImages->first()->image_url }}">
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
		</div>
	</div>
</div>
<!-- product area end -->
@endif
<!-- product area end -->