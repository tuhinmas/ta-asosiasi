<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">Beranda</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/transaksi') }}" class="nav-link">Transaksi</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/diskon') }}" class="nav-link">Diskon</a>
      </li>
      
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/petunjuk') }}" class="nav-link">Petunjuk</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/about') }}" class="nav-link">About</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Cari" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}
    <ul class="navbar-nav ml-auto">
      @if (Auth::check())
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link">User: {{ Auth::user()->name }}</a>
      </li>  
      @endif
      
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          {{-- <i class="fas fa-th-large"></i> --}}
        </a>
      </li>
    </ul>
  </nav>