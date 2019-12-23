<?php
@session_start();
?>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="logout.php" class="nav-link btn btn-success" style="color: white;">Log Out</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php?dashboard" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">EManager</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php print $_SESSION['name']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a id="dash" href="dashboard.php?dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a id="profile" href="dashboard.php?profile" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Manage Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a id="bookings" href="dashboard.php?bookings" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Manage Bookings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a id="payments" href="dashboard.php?payments" class="nav-link">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Payment History
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a id="payments" href="dashboard.php?user" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>