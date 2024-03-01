  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
          <a href="{{ url('/admin/change_password') }}" class="dropdown-item">
            <i class="fas fa-key mr-2"></i>Change Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/admin/logout') }}" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>Logout
          </a>
         
        </div>
      </li>
     
     
    </ul>
  </nav>
  <!-- /.navbar -->
