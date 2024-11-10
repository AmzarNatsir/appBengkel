<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="index.html" class="logo">
          <img
            src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}"
            alt="navbar brand"
            class="navbar-brand"
            height="20"
          />
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
        <ul class="nav nav-secondary">
            <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                  <i class="fas fa-home"></i>
                  <p>Home</p>
                </a>
              </li>
            {{-- <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                <i class="far fa-chart-bar"></i><p>Dashboard</p><span class="caret"></span></a>
                <div id="dashboard" class="collapse {{ request()->routeIs('dashboard.*') ? 'show' : '' }}">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->routeIs('dashboard.karyawan') ? 'active' : '' }}">
                            <a href="{{ url('dashboard.karyawan') }}">
                            <span class="sub-item">Karyawan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                        <a href="{{ route('home') }}">
                            <span class="sub-item">Kontrak Kerja</span>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}">
                            <span class="sub-item">Cuti</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
            </li> --}}
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                <i class="fas fa-layer-group"></i>
                <p>Common</p>
                <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                <ul class="nav nav-collapse">
                    <li class="nav-item {{ request()->routeIs('brand.*') ? 'active submenu' : '' }}">
                    <a href="{{ route('brand.index') }}"><span class="sub-item">Brand</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('model.*') ? 'active submenu' : '' }}">
                    <a href="{{ route('model.index') }}"><span class="sub-item">Model</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('type.*') ? 'active submenu' : '' }}">
                    <a href="{{ route('type.index') }}"><span class="sub-item">Type</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('ccunit.*') ? 'active submenu' : '' }}">
                    <a href="{{ route('ccunit.index') }}"><span class="sub-item">CC Unit</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('color.*') ? 'active submenu' : '' }}">
                    <a href="{{ route('color.index') }}"><span class="sub-item">Color</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('jenis.*') ? 'active submenu' : '' }}">
                    <a href="{{ route('jenis.index') }}"><span class="sub-item">Jenis</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('satuan.*') ? 'active submenu' : '' }}">
                    <a href="{{ route('satuan.index') }}"><span class="sub-item">Satuan</span></a>
                    </li>
                </ul>
                </div>
            </li>
            <div class="dropdown-divider"></div>
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
            <li class="nav-item {{ request()->routeIs('karyawan.*') ? 'active submenu' : '' }}">
                <a href="{{ url('karyawan') }}">
                <i class="fas fa-user"></i>
                <p>Mekanik</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('parts.*') ? 'active submenu' : '' }}">
                <a href="{{ url('parts') }}">
                <i class="fas fa-edit"></i>
                <p>Parts</p>
                </a>
            </li>
            {{-- purchase_order --}}
            <li class="nav-item {{ request()->routeIs('purchaseOrder.*') ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#submenu">
                <i class="fas fa-check-double"></i>
                <p>Purchase Order</p>
                <span class="caret"></span>
                </a>
                <div class="collapse" id="submenu">
                <ul class="nav nav-collapse">
                    <li class="nav-item {{ request()->routeIs('purchaseOrder.create') ? 'active submenu' : '' }}">
                        <a href="{{ route('purchaseOrder.create') }}"><span class="sub-item">New</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('users') }}"><span class="sub-item">List</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('users') }}"><span class="sub-item">Summary</span></a>
                    </li>
                </ul>
                </div>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#submenu">
                <i class="fas fa-bars"></i>
                <p>User Management</p>
                <span class="caret"></span>
                </a>
                <div class="collapse" id="submenu">
                <ul class="nav nav-collapse">
                    <li class="nav-item">
                        <a href="{{ url('roles') }}"><span class="sub-item">Roles</span></a>
                        <a href="{{ url('users') }}"><span class="sub-item">Users</span></a>
                    </li>
                </ul>
                </div>
            </li>
            {{--
            <div class="dropdown-divider"></div>
            <li class="nav-item {{ request()->routeIs('karyawan.*') ? 'active submenu' : '' }}">
                <a href="{{ url('karyawan') }}">
                <i class="fas fa-user"></i>
                <p>Karyawan</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('contact.*') ? 'active submenu' : '' }}">
                <a href="{{ url('contract') }}">
                <i class="fas fa-hands-helping"></i>
                <p>Kontrak Kerja</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('cuti.*') ? 'active submenu' : '' }}">
                <a href="{{ url('cuti') }}">
                <i class="fas fa-hands-helping"></i>
                <p>Cuti</p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('report.*') ? 'active submenu' : '' }}">
                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-file"></i>
                <p>Report</p>
                <span class="caret"></span>
                </a>
                <div class="collapse" {{ request()->routeIs('report.*') ? 'show' : '' }} id="sidebarLayouts">
                <ul class="nav nav-collapse">
                    <li class="nav-item"><a href="#"><span class="sub-item">Karyawan</span></a></li>
                    <li class="nav-item"><a href="#"><span class="sub-item">Kontrak Kerja</span></a></li>
                    <li class="nav-item"><a href="#"><span class="sub-item">Cuti</span></a></li>
                    <li class="nav-item {{ request()->routeIs('report.bpjsKesehatan') ? 'active' : '' }}"><a href="{{ url('report.bpjsKesehatan') }}"><span class="sub-item">BPJS Kesehatan</span></a></li>
                    <li class="nav-item"><a href="#"><span class="sub-item">BPJS Ketenagakerjaan</span></a></li>
                </ul>
                </div>
            </li> --}}
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->
