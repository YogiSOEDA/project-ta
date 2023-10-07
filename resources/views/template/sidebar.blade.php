<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="Alam Raya" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Alam Raya</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ 'dashboard' == request()->path() ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ 'request-material' == request()->path() || 'purchase-order' == request()->path() || 'purchase-order/create' == request()->path() ? 'menu-open' : 'menu' }}">
                    <a href="#"
                        class="nav-link {{ 'request-material' == request()->path() || 'purchase-order' == request()->path() || 'purchase-order/create' == request()->path() ? 'active' : '' }}">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Purchasing
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('requestMaterial') }}"
                                class="nav-link {{ 'request-material' == request()->path() ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Request Material</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/purchase-order"
                            {{-- <a href="{{ route('purchaseOrder') }}" --}}
                                class="nav-link {{ 'purchase-order' == request()->path() || 'purchase-order/create' == request()->path() ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchase Order</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ 'persediaan' == request()->path() || 'barang-masuk' == request()->path() || 'barang-keluar' == request()->path() ? 'menu-open' : 'menu' }}">
                    <a href="#"
                        class="nav-link {{ 'persediaan' == request()->path() || 'barang-masuk' == request()->path() || 'barang-keluar' == request()->path() ? 'active' : '' }}">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Gudang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('persediaan') }}"
                                class="nav-link {{ 'persediaan' == request()->path() ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Persediaan Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('barang-masuk') }}"
                                class="nav-link {{ 'barang-masuk' == request()->path() ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('barang-keluar') }}"
                                class="nav-link {{ 'barang-keluar' == request()->path() ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang Keluar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('prediksi') }}"
                        class="nav-link {{ 'prediksi' == request()->path() ? 'active' : '' }}">
                        <i class="nav-icon far fa-chart-bar"></i>
                        <p>Prediksi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan') }}"
                        class="nav-link {{ 'laporan' == request()->path() ? 'active' : '' }}">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ 'dataproyek' == request()->path() || 'databarang' == request()->path() ? 'menu-open' : 'menu' }}">
                    <a href="#"
                        class="nav-link {{ 'dataproyek' == request()->path() || 'databarang' == request()->path() ? 'active' : '' }}">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('databarang') }}"
                                class="nav-link {{ 'databarang' == request()->path() ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dataproyek') }}"
                                class="nav-link {{ 'dataproyek' == request()->path() ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Proyek</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
