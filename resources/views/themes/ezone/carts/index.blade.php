@extends('themes.ezone.layout')

@section('content')
    <img src="{{ url('/assets/img/logo/Absah-logo.png') }}" alt="Logo"
        style="display: block; margin: 40px auto 0; max-width: 100%; height: auto;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Keranjang</h2>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
            </ul>
        </div>
    </div>
    <div class="shop-page-wrapper shop-page-padding ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    @include('admin.partials.flash')
                    <div class="shop-product-wrapper res-xl">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Images</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ Auth::user()->name }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->product->image }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price * $item->quantity }}</td>
                                            <td class="product-remove">
                                                <a href="{{ url('carts/remove/' . $item->id) }}" class="delete"><i
                                                        class="pe-7s-close"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
