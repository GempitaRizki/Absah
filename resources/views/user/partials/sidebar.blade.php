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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('order.user') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt" style="min-width: 2.5rem;"></i>
                        <p>Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('komplain.user') }}" class="nav-link">
                        <i class="fas fa-cart-plus" style="min-width: 2.5rem;"></i>
                        <p>
                            Komplain
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=# class="nav-link">
                        <i class="fas fa-tachometer-alt" style="min-width: 2.5rem;"></i>
                        <p>Daftar Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=#  class="nav-link">
                        <i class="fas fa-tachometer-alt" style="min-width: 2.5rem;"></i>
                        <p>Aktifitas Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=#  class="nav-link">
                        <i class="fas fa-book" style="min-width: 2.5rem;"></i>
                        <p>PPBJ (RKAS)</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=#  class="nav-link">
                        <i class="fas fa-hourglass" style="min-width: 2.5rem;"></i>
                        <p>Sumber Dana</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=#  class="nav-link">
                        <i class="fas fa-phone-alt" style="min-width: 2.5rem;"></i>
                        <p>E-Meterai</p>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a href={{ route('dashboard.index') }} class="btn btn-warning btn-block"
                        style="color: #ffffff">Beli Produk Lain</a>
                </li>
        </nav>
    </div>
</aside>
