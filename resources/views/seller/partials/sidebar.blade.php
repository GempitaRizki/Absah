<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block" style="font-size: 15px; color: rgb(252, 252, 252); text-align: center;">
                    {{ Auth::user()->username }}
                </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav {{ Route::currentRouteName() == 'dashboardseller' ? 'expand active' : '' }}">
                    <a href="{{ route('DashboardSeller') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt" style="min-width: 2.5rem;"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav {{ Route::currentRouteName() == 'orderseller' ? 'expand active' : '' }}">
                    <a href="{{ route('order.index') }}" class="nav-link">
                        <i class="fas fa-cart-plus" style="min-width: 2.5rem;"></i>
                        <p>
                            Order
                            <span class="badge badge-info right">0</span>
                        </p>
                    </a>
                </li>
                <li class="nav {{ Route::currentRouteName() == 'pembayaran.index' ? 'expand active' : '' }}" id="pembayaran-menu">
                    <a href="{{ route('pembayaran.index') }}" class="nav-link">
                        <i class="fas fa-money-check" style="min-width: 2.5rem;"></i>
                        <p>
                            Pembayaran
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/UI/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon" style="min-width: 2.5rem;"></i>
                                <p>Payment Seller</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/icons.html" class="nav-link">
                                <i class="far fa-circle nav-icon" style="min-width: 2.5rem;"></i>
                                <p>Bayar Full</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav {{ Route::currentRouteName() == 'pajak.index' ? 'expand active' : '' }}" id="pajak-menu">
                    <a href="{{ route('pajak.index') }}" class="nav-link">
                        <i class="fas fa-money-check" style="min-width: 2.5rem;"></i>
                        <p>
                            Pajak
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/forms/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon" style="min-width: 2.5rem;"></i>
                                <p>Nomor Faktur</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon" style="min-width: 2.5rem;"></i>
                                <p>E-Faktur</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/editors.html" class="nav-link">
                                <i class="far fa-circle nav-icon" style="min-width: 2.5rem;"></i>
                                <p>E-Billing</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav {{ Route::currentRouteName() == 'productseller' ? 'expand active' : '' }}">
                    <a href="{{ route('product.index') }}" class="nav-link">
                        <i class="fas fa-book" style="min-width: 2.5rem;"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav {{ Route::currentRouteName() == 'negoSeller' ? 'expand active' : '' }}">
                    <a href="{{ route('nego.index') }}" class="nav-link">
                        <i class="fas fa-hourglass" style="min-width: 2.5rem;"></i>
                        <p>Nego</p>
                    </a>
                </li>
                <li class="nav {{ Route::currentRouteName() == 'chatSeller' ? 'expand active' : '' }}">
                    <a href="{{ route('chat.index') }}" class="nav-link">
                        <i class="fas fa-phone-alt" style="min-width: 2.5rem;"></i>
                        <p>Chat</p>
                    </a>
                </li>
                <li class="nav {{ Route::currentRouteName() == 'komplainSeller' ? 'expand active' : '' }}">
                    <a href="{{ route('komplain.index') }}" class="nav-link">
                        <i class="fas fa-comments" style="min-width: 2.5rem;"></i>
                        <p>
                            Komplain
                            <span class="badge badge-info right">0</span>
                        </p>
                    </a>
                </li>
                <li class="nav {{ Route::currentRouteName() == 'daftarpenggunaSeller' ? 'expand active' : '' }}">
                    <a href="{{ route('daftarpengguna.index') }}" class="nav-link">
                        <i class="fas fa-users" style="min-width: 2.5rem;"></i>
                        <p>Daftar Pengguna</p>
                    </a>
                </li>
                <li class="nav {{ Route::currentRouteName() == 'aktivitaspengguna.index' ? 'expand active' : '' }}">
                    <a class="nav-link" href="{{ route('aktivitaspengguna.index') }}" >
                        <i class="fas fa-history" style="min-width: 2.5rem;"></i>
                        <p>Aktivitas Pengguna</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
