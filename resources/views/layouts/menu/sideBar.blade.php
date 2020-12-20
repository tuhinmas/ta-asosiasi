<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="/template/dist/img/m-icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">

      <span class="brand-text font-weight-light">Toko Matahari</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Mining
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (Auth::check() && (Auth::user()->role_id == 2))
              <li class="nav-item">
                <a href="/parameter" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Parameter</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/data-train" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Train</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/order-of-item" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (Auth::check() && (Auth::user()->role_id == 2))
                <li class="nav-item">
                  <a href="{{ url('/users') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar User</p>
                  </a>
                </li> 
              @endif
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Kasir
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/transaksi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/riwayat-transaksi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat Transaksi</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/produk" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Produk</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/diskon" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Diskon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/customer" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>

              @if (Auth::check() && (Auth::user()->role_id == 2))
              <li class="nav-item">
                <a href="{{ url('/laporan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan</p>
                </a>
              </li> 
              @endif
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                About
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/petunjuk" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Petunjuk</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/about" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About</p>
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