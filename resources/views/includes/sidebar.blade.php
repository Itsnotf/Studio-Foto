<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="">{{ env('APP_NAME') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href=""></a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Main Menu</li>
        <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span>
            </a>
        </li>
        {{-- <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i>
                <span>Dropdown Menu</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">Dropdown Item</a></li>
            </ul>
        </li> --}}

        @can('admin')
            <li class="menu-header">Administrator</li>
            <li class="{{ Route::is('user*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li class="{{ Route::is('product*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Manage Products</span>
                </a>
            </li>
            <li class="{{ Route::is('paket*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('paket.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Manage Paket</span>
                </a>
            </li>
            <li class="{{ Route::is('metode-pembayaran*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('metode-pembayaran.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Manage Pembayaran</span>
                </a>
            </li>
            <li class="{{ Route::is('transaksi*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('transaksi.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Manage Transaksi</span>
                </a>
            </li>
        @endcan
    </ul>
</aside>
