<div class="header-cart">
    <a class="icon-cart-furniture" href="{{ url('carts') }}">
        <i class="ti-shopping-cart"></i>
        @if (isset($cartTotalQuantity))
            <span class="shop-count-furniture green">{{ $cartTotalQuantity }}</span>
        @endif
    </a>
    @if (!empty($cartItems))
        <ul class="cart-dropdown">
            @foreach ($cartItems as $item)
                <li class="single-product-cart">
                    <div class="cart-img">
                        <img src="{{ asset('storage/' . $cartItem['image']) }}" alt="{{ $cartItem['product_name'] }}"
                            style="width:50px">
                        </a>
                    </div>
                    <div class="cart-title">
                        <h5><a href="{{ url('product/' . $item['slug']) }}">{{ $item['product_name'] }}</a></h5>
                        <span>{{ number_format($item['price']) }} x {{ $item['quantity'] }}</span>
                    </div>
                    <div class="cart-delete">
                        <a href="{{ url('carts/remove/' . $item['item_id']) }}" class="delete"><i
                                class="ti-trash"></i></a>
                    </div>
                </li>
            @endforeach
            <li class="cart-space">
                <div class="cart-sub">
                    <h4>Subtotal</h4>
                </div>
                <div class="cart-price">
                    <h4>{{ number_format($cartSubtotal) }}</h4>
                </div>
            </li>
            <li class="cart-btn-wrapper">
                <a class="cart-btn btn-hover" href="{{ url('carts') }}">Cart</a>
                <a class="cart-btn btn-hover" href="{{ url('orders/checkout') }}">Checkout</a>
            </li>
        </ul>
    @endif
</div>
