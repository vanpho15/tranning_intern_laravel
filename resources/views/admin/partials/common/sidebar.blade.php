<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  USER
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="{{route('user.search')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User search</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('user.add')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User add</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  CATEGORY
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="{{route('category.list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Category search</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('category.add')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Category add</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  PRODUCT
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="{{route('product.list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product search</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('product.add')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product add</p>
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