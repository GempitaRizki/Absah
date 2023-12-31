@extends('themes.ezone.layout')

@section('content')
<style>
.custom-add-to-cart-button {
    background-color: #FF0000; 
    color: #FFF;
    border: none;
    padding: 13px 20px;
    cursor: pointer;
    transition: none;
}

</style>
    <div class="product-details ptb-100 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-3">
                    <div class="sidebar-active1 product-details7-content">
                        <div class="product-details-content">
                            <h3> {{ $product->name }} </h3>
                            <div class="rating-number">
                                <div class="quick-view-rating">
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                </div>
                                <div class="quick-view-number">
                                    <span>2 Ratting (S)</span>
                                </div>
                            </div>
                            <div class="details-price">
                                <span> Rp.
                                    {{ $price != 'Cie harganya tidak ada' ? number_format((float) $price, 0, ',', '.') : 'Harga tidak tersedia' }}</span>
                            </div>
                            <p>{{ $product->descriptions }} </p>
                            <div class="product-details5-social">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="icofont icofont-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icofont icofont-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icofont icofont-social-pinterest"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icofont icofont-social-flikr"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12 col-lg-6">
                    <div class="product-details-6">
                        <div class="scroll-single-product mb-30">
                            <img src="{{ asset('images/' . $imagePath) }}" alt="">
                            <a href="#" title="Wishlist"><i class="pe-7s-like"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12 col-lg-3">
                    <div class="sidebar-active3 product-details-content sidebar-details7">
                        <div class="product-color-2">
                            <h4 class="details-title">Color*</h4>
                            <div class="product-color-style2">
                                <ul>
                                    <li class="orange"></li>
                                    <li class="blue2"></li>
                                    <li class="pink"></li>
                                    <li class="yellow"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-size-2">
                            <h4 class="details-title">Size*</h4>
                            <div class="product-size-style2">
                                <ul>
                                    <li><a href="#">xl</a></li>
                                    <li><a href="#">ml</a></li>
                                    <li><a href="#">m</a></li>
                                    <li><a href="#">sl</a></li>
                                    <li><a href="#">ls</a></li>
                                </ul>
                            </div>
                        </div>
                        <form action="{{ route('product.detail.saveQtyToCartWithoutParams') }}" method="POST">
                            @csrf
                            <input type="hidden" name="qtybutton" value="02">
                            <div class="quickview-plus-minus">
                                <div class="cart-plus-minus">
                                    <input type="text" value="1" name="qty" class="cart-plus-minus-box">
                                </div>
                                <div class="quickview-btn-cart">
                                    <button type="submit" class="btn-hover-black custom-add-to-cart-button">Add To Cart</button>
                                </div>                                
                            </div>
                        </form>                                                                                                                
                        <div class="product-details-cati-tag mt-35">
                            <ul>
                                <li class="categories-title">Categories :</li>
                                <li><a href="#">fashion</a></li>
                                <li><a href="#">toys</a></li>
                                <li><a href="#">food</a></li>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Tags :</li>
                                <li><a href="#">fashion</a></li>
                                <li><a href="#">toys</a></li>
                                <li><a href="#">food</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="section-title-7 text-center">
                <h2>Deskripsi</h2>
            </div>
        </div>
    </div> 
@endsection
