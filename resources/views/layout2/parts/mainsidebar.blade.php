<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{asset("images/zenicon.png")}}" alt="logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}} Inventory</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset("images/adminlte/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('zen.home') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('zen.inventory') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Inventory
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('zen.production') }}" class="nav-link">
              {{-- <i class="nav-icon fas fa-boxes"></i> --}}
              <i class="nav-icon fas fa-people-carry"></i>
              <p>
                Production
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('zen.records') }}" class="nav-link">
              {{-- <i class="nav-icon fas fa-clipboard"></i> --}}
              <i class="nav-icon fas fa-window-restore"></i>
              <p>
                Records
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('zen.request') }}" class="nav-link">
              <i class="nav-icon fas fa-phone-square-alt"></i>
              <p>
                Delivery Request
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('zen.delivery') }}" class="nav-link">
              {{-- <i class="nav-icon fa fa-truck"></i> --}}
              <i class="nav-icon fas fa-shipping-fast"></i>
              <p>
                Delivery
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('zen.users') }}" class="nav-link">
              {{-- <i class="nav-icon fa fa-truck"></i> --}}
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Users
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
