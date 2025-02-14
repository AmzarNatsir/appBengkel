<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="{{ route('home') }}" class="logo">
          <img src="{{ asset('assets/img/logo_new.png') }}" alt="navbar brand" class="navbar-brand" height="80" />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        @php
        $menu_common="";
        $menu_pengaturan="";
        $menu_manajemen_pekerjaan="";
        $menu_pemesanan="";
        $menu_penerimaan="";
        $menu_service="";
        $menu_stok="";
        @endphp
        @if(request()->routeIs('brand.*')==1 || request()->routeIs('model.*')==1 || request()->routeIs('type.*')==1 || request()->routeIs('color.*') == 1 || request()->routeIs('jenis.*') == 1 || request()->routeIs('satuan.*') == 1 || request()->routeIs('rak.*'))
        @php($menu_common=1)
        @endif
        @if(request()->routeIs('pengaturan.*')==1)
        @php($menu_pengaturan=1)
        @endif
        @if(request()->routeIs('manajemen_pekerjaan.kategori.*')==1 || request()->routeIs('manajemen_pekerjaan.pekerjaan.*')==1)
        @php($menu_manajemen_pekerjaan=1)
        @endif
        @if(request()->routeIs('pemesanan.*')==1)
        @php($menu_pemesanan=1)
        @endif
        @if(request()->routeIs('penerimaan.*')==1)
        @php($menu_penerimaan=1)
        @endif
        @if(request()->routeIs('service.*')==1)
        @php($menu_service=1)
        @endif
        @if(request()->routeIs('manajemen_stok.stok.*')==1 || request()->routeIs('manajemen_stok.kartu_stok.*')==1)
        @php($menu_stok=1)
        @endif
        <ul class="nav nav-secondary">
            <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                  <i class="fas fa-home"></i>
                  <p>Home</p>
                </a>
            </li>
            <li class="nav-item  {{ ($menu_common===1) ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#data_master">
                <i class="fas fa-layer-group"></i>
                <p>Data Master</p>
                <span class="caret"></span>
                </a>
                <div class="collapse {{ ($menu_common===1) ? 'show' : '' }}" id="data_master">
                <ul class="nav nav-collapse">
                    <li class="nav-item {{ request()->routeIs('brand.*') ? 'active' : '' }}">
                    <a href="{{ route('brand.index') }}"><span class="sub-item">Brand</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('model.*') ? 'active' : '' }}">
                    <a href="{{ route('model.index') }}"><span class="sub-item">Model</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('type.*') ? 'active' : '' }}">
                    <a href="{{ route('type.index') }}"><span class="sub-item">Type</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('color.*') ? 'active' : '' }}">
                    <a href="{{ route('color.index') }}"><span class="sub-item">Color</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('jenis.*') ? 'active' : '' }}">
                    <a href="{{ route('jenis.index') }}"><span class="sub-item">Jenis</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('satuan.*') ? 'active' : '' }}">
                    <a href="{{ route('satuan.index') }}"><span class="sub-item">Satuan</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('rak.*') ? 'active' : '' }}">
                        <a href="{{ route('rak.index') }}"><span class="sub-item">Rak</span></a>
                        </li>
                </ul>
                </div>
            </li>
            <li class="nav-item {{ ($menu_pengaturan==1) ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#pengaturan">
                <i class="fas fa-layer-group"></i>
                <p>Pengaturan</p>
                <span class="caret"></span>
                </a>
                <div class="collapse {{ ($menu_pengaturan==1) ? 'show' : '' }}" id="pengaturan">
                    <ul class="nav nav-collapse">
                        <li class="nav-item {{ request()->routeIs('pengaturan.ppn_marginhargajual') ? 'active' : '' }}">
                            <a href="{{ route('pengaturan.ppn_marginhargajual') }}"><span class="sub-item">Ppn & Margin Pricing</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($menu_manajemen_pekerjaan==1) ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#manajemen_pekerjaan">
                <i class="fas fa-layer-group"></i>
                <p>Manajemen Pekerjaan</p>
                <span class="caret"></span>
                </a>
                <div class="collapse {{ ($menu_manajemen_pekerjaan==1) ? 'show' : '' }}" id="manajemen_pekerjaan">
                    <ul class="nav nav-collapse">
                        <li class="nav-item {{ request()->routeIs('manajemen_pekerjaan.kategori.*') ? 'active' : '' }}">
                            <a href="{{ route('manajemen_pekerjaan.kategori.index') }}"><span class="sub-item">Kategori Pekerjaan</span></a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('manajemen_pekerjaan.pekerjaan.*') ? 'active' : '' }}">
                            <a href="{{ route('manajemen_pekerjaan.pekerjaan.index') }}"><span class="sub-item">Pekerjaan & Jasa</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($menu_stok==1) ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#manajemen_stok">
                <i class="fas fa-layer-group"></i>
                <p>Manajemen Stok</p>
                <span class="caret"></span>
                </a>
                <div class="collapse {{ ($menu_stok==1) ? 'show' : '' }}" id="manajemen_stok">
                    <ul class="nav nav-collapse">
                        <li class="nav-item {{ request()->routeIs('manajemen_stok.stok.create') ? 'active' : '' }}">
                            <a href="{{ route('manajemen_stok.stok.create') }}"><span class="sub-item">Stok Baru</span></a>
                        </li>
                        @php($submenu_manaj_stok="")
                        @if(request()->routeIs('manajemen_stok.stok.index')==1 || request()->routeIs('manajemen_stok.stok.show')==1 || request()->routeIs('manajemen_stok.stok.edit')==1)
                            @php($submenu_manaj_stok=1)
                        @endif
                        <li class="nav-item {{ ($submenu_manaj_stok==1) ? 'active' : '' }}">
                            <a href="{{ route('manajemen_stok.stok.index') }}"><span class="sub-item">Daftar Stok</span></a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('manajemen_stok.kartu_stok.*') ? 'active' : '' }}">
                            <a href="{{ route('manajemen_stok.kartu_stok.index') }}"><span class="sub-item">Kartu Stok</span></a>
                        </li>
                    </ul>
                </div>
            </li>


            {{-- <div class="dropdown-divider"></div> --}}
            <li class="nav-item {{ request()->routeIs('customer.*') ? 'active submenu' : '' }}">
                <a href="{{ route('customer.index') }}">
                <i class="fas fa-user"></i>
                <p>Customer</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('supplier.*') ? 'active submenu' : '' }}">
                <a href="{{ route('supplier.index') }}">
                <i class="fas fa-user"></i>
                <p>Supplier</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('vehicle.*') ? 'active submenu' : '' }}">
                <a href="{{ route('vehicle.index') }}">
                <i class="fas fa-car"></i>
                <p>Vehicle</p>
                </a>
            </li>

            {{-- purchase_order / pemesanan --}}
            <li class="nav-item {{ $menu_pemesanan==1 ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#submenu_pemesanan">
                <i class="fas fa-check-double"></i>
                <p>Pemesanan</p>
                <span class="caret"></span>
                </a>
                <div class="collapse {{ $menu_pemesanan==1 ? 'show' : '' }}" id="submenu_pemesanan">
                <ul class="nav nav-collapse">
                    <li class="nav-item {{ request()->routeIs('pemesanan.baru') ? 'active' : '' }}">
                        <a href="{{ route('pemesanan.baru') }}"><span class="sub-item">Baru</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('pemesanan.index') ? 'active' : '' }}">
                        <a href="{{ route('pemesanan.index') }}"><span class="sub-item">Daftar</span></a>
                    </li>
                </ul>
                </div>
            </li>
            {{-- penerimaan barang --}}
            <li class="nav-item {{ $menu_penerimaan==1 ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#submenu_penerimaan">
                <i class="fas fa-receipt"></i>
                <p>Penerimaan</p>
                <span class="caret"></span>
                </a>
                <div class="collapse {{ $menu_penerimaan==1 ? 'show' : '' }}" id="submenu_penerimaan">
                <ul class="nav nav-collapse">
                    <li class="nav-item {{ request()->routeIs('penerimaan.baru') ? 'active' : '' }}">
                        <a href="{{ route('penerimaan.baru') }}"><span class="sub-item">Baru</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('penerimaan.index') ? 'active' : '' }}">
                        <a href="{{ route('penerimaan.index') }}"><span class="sub-item">Daftar</span></a>
                    </li>
                </ul>
                </div>
            </li>
            {{-- Penjualan --}}
            <li class="nav-item {{ $menu_service==1 ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#submenu_service">
                <i class="fas fa-receipt"></i>
                <p>Service</p>
                <span class="caret"></span>
                </a>
                <div class="collapse {{ $menu_service==1 ? 'show' : '' }}" id="submenu_service">
                <ul class="nav nav-collapse">
                    <li class="nav-item {{ request()->routeIs('service.baru') ? 'active' : '' }}">
                        <a href="{{ route('service.baru') }}"><span class="sub-item">Baru</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('service.baru') ? 'daftar' : '' }}">
                        <a href="{{ route('service.daftar') }}"><span class="sub-item">Daftar</span></a>
                    </li>
                </ul>
                </div>
            </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->
