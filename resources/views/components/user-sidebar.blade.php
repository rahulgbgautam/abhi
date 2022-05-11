<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/logo2.png')}}" alt="Logo" / style="height: 70px;width: 100%;">
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="{{url('sales-person/dashboard')}}" class="nav-link @yield('dashboard_select')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="{{url('sales-person/customer')}}" class="nav-link @yield('customer_select')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Customer
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="{{url('sales-person/sale')}}" class="nav-link @yield('sale_select')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sale
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
    