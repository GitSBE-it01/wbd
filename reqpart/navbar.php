<?php
include 'checklogin.php';
include('conn_list_user.php');
$user_login = $_SESSION['username'];


$sql = "SELECT * FROM user WHERE username='".$user_login."'";
$data_login = $conn_list_user->query($sql);
$result_data_login = $data_login->fetch_assoc();
echo '
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Sinar Baja Electric</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">'.$result_data_login['nama'].'</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span >Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
  

  </header><!-- End Header -->





  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Permintaan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="pinjamspareparts.php">
              <i class="bi bi-circle"></i><span>Create</span>
            </a>
          </li>
          <li>
            <a href="historyminta.php">
              <i class="bi bi-circle"></i><span>Browse</span>
            </a>
          </li>
		  <li>
            <a href="closed.php">
              <i class="bi bi-circle"></i><span>Closed</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->

    </ul>

  </aside><!-- End Sidebar-->
';
  ?>