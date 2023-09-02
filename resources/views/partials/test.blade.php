<div class="all-products-area pt-115 pb-50">
    <div class="pl-100 pr-100">
        <div class="container-fluid">
            <div class="section-title text-center mb-60">
                <h2>Kategori Barang</h2>
            </div>
            @forelse($categories as $category)
            <div class="product-style">
                <div class="tab-content">
                    <div class="custom-row">
                        @forelse($category->products as $product)
                        <div class="custom-col-5 custom-col-style mb-65">
                            <div class="product-wrapper">
                                <div class="product-img">
                                    <a href="#">
                                        <img src="{{url('assets/img/product/' . $category->image)}}" alt="">
                                    </a>
                                </div>
                                <div class="product-name">
                                    {{$category->name}}
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>No products found in this category.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            @empty
            <p>No categories found.</p>
            @endforelse
        </div>
    </div>
</div>