@extends('themes.ezone.layout')

@section('content')
    <img src="{{ url('/assets/img/logo/Absah-logo.png') }}" alt="Logo"
        style="display: block; margin: 40px auto 0; max-width: 100%; height: auto;">
    <script type="module" src="{{ asset('js/cart.js') }}"></script>

    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Keranjang</h2>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
            </ul>
        </div>
    </div>
    <!-- shopping-cart-area start -->
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="cart-heading">Cart</h1>
                    @if (!empty($cartItems))
                        {!! Form::open(['url' => 'carts/update']) !!}
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>remove</th>
                                        <th>images</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $cartItem)
                                        <tr>
                                            <td class="product-remove">
                                                <a href="{{ route('cart.remove', $cartItem['item_id']) }}" class="delete"><i
                                                        class="pe-7s-close"></i></a>
                                            </td>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('storage/' . $cartItem['image']) }}"
                                                    alt="{{ $cartItem['product_name'] }}" style="width:100px">
                                                </a>
                                            </td>

                                            <td class="product-name"><a
                                                    href="{{ url('product/' . $cartItem['slug']) }}">{{ $cartItem['product_name'] }}</a>
                                            </td>
                                            <td class="product-price-cart"><span
                                                    class="amount">{{ number_format($cartItem['price']) }}</span></td>
                                            <input type="hidden" class="product_id" value="{{ $cartItem['item_id'] }}" >
                                            <td class="product-quantity">
                                                <input type="number" name="items[{{ $cartItem['item_id'] }}][quantity]"
                                                    value="{{ $cartItem['quantity'] }}" min="1" required>
                                            </td>
                                            <td class="product-subtotal">{{ number_format($cartItem['total']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    <ul>
                                        <li>Subtotal<span>{{ number_format($cartSubtotal) }}</span></li>
                                        <li>Total<span>{{ number_format($cartTotal) }}</span></li>
                                    </ul>
                                    <a href="{{ url('orders/checkout') }}">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    @else
                        <div class="empty-cart">
                            <p>Your cart is currently empty.</p>
                            <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- shopping-cart-area end -->
@endsection
