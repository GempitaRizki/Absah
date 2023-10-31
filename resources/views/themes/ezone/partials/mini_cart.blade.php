<div class="header-cart">
    <a class="icon-cart-furniture" href="#">
        <i class="ti-shopping-cart"></i>
        <span class="shop-count-furniture green">02</span>
    </a>
    @if (!empty($cartItems))
        @php $subtotal = 0; @endphp
        <ul class="cart-dropdown">
            @foreach ($cartItems as $item)
                @php
                    $subtotal += $item['price'] * (isset($item['quantity']) ? $item['quantity'] : 0);
                @endphp
                
                <li class="single-product-cart">
                    <div class="cart-img">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['product_name'] }}"
                            style="width: 100px">
                    </div>
                    <div class="cart-title">
                        <h5><a href="{{ url('product/' . (isset($item['slug']) ? $item['slug'] : '')) }}">{{ $item['product_name'] }}</a></h5>
                        <span>{{ number_format($item['price']) }} x {{ isset($item['quantity']) ? $item['quantity'] : 0 }}</span>
                    </div>
                    <div class="cart-delete">
                        <a href="{{ url('carts/remove/' . (isset($item['item_id']) ? $item['item_id'] : '')) }}" class="delete"><i
                                class="ti-trash"></i></a>
                    </div>
                </li>
            @endforeach
            <li class="cart-space">
                <div class="cart-sub">
                    <h4>Subtotal</h4>
                </div>
                <div class="cart-price">
                    <h4>{{ number_format($subtotal) }}</h4>
                </div>
            </li>
            <li class="cart-btn-wrapper">
                <a class="cart-btn btn-hover" href="{{ url('carts') }}">Cart</a>
                <a class="cart-btn btn-hover" href="{{ url('orders/checkout') }}">Checkout</a>
            </li>
        </ul>
    @endif
</div>
