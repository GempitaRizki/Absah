<aside class="left-sidebar bg-sidebar">
    <div class="app-brand" style="font-size: 14px;">
        <a href="{{ url('seller/dashboard') }}">
            <span class="brand-name">Seller Dashboard</span>
        </a>
    </div>
    <br>
    <div class="container-fluid">
        <h1 style="font-size: 15px; color: rgb(252, 252, 252); text-align: center;">{{ Auth::user()->username }}</h1>
    </div>
    <div class="sidebar-scrollbar">
        <ul class="nav sidebar-inner" id="sidebar-menu">
            <li class="has-sub {{ Route::currentRouteName() == 'DashboardSeller' ? 'expand active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('DashboardSeller') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>            
            <li class="has-sub {{ Route::currentRouteName() == 'order.index' ? 'expand active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('order.index') }}">
                    <i class="fas fa-cart-plus"></i>
                    <span class="nav-text">Order</span>
                </a>
            </li>
            <li class="has-sub {{ Route::currentRouteName() == 'pembayaran.index' ? 'expand active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('pembayaran.index') }}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span class="nav-text">Pembayaran</span>
                </a>
            </li>
            <li class="has-sub {{ Route::currentRouteName() == 'pajak.index' ? 'expand active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('pajak.index') }}">
                    <i class="fas fa-money-check"></i>
                    <span class="nav-text">Pajak</span>
                </a>
            </li>
            <li class="has-sub {{ Route::currentRouteName() == 'product.index' ? 'expand active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('product.index') }}">
                    <i class="fas fa-book"></i>
                    <span class="nav-text">Product</span>
                </a>
            </li>
            <li class="has-sub {{ Route::currentRouteName() == 'nego.index' ? 'expand active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('nego.index') }}">
                    <i class="fas fa-hourglass"></i>
                    <span class="nav-text">Nego</span>
                </a>
            </li>
            <li class="has-sub {{ Route::currentRouteName() == 'chat.index' ? 'expand active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('chat.index') }}">
                    <i class="fas fa-phone-alt"></i>
                    <span class="nav-text">Chat</span>
                </a>
            </li>
            <li class="has-sub {{ Route::currentRouteName() == 'komplain.index' ? 'expand active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('komplain.index') }}">
                    <i class="fas fa-comments"></i>
                    <span class="nav-text">Komplain</span>
                </a>
            </li>
            <li class="has-sub {{ Route::currentRouteName() == 'daftarpengguna.index' ? 'expand active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('daftarpengguna.index') }}">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Daftar Pengguna</span>
                </a>
            </li>
            <li class="has-sub {{ Route::currentRouteName() == 'aktivitaspengguna.index' ? 'expand active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('aktivitaspengguna.index') }}">
                    <i class="fas fa-history"></i>
                    <span class="nav-text">Aktifitas Pengguna</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
