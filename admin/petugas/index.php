<?php
ob_start();
require '../request.php';

if(empty($_SESSION['USER']['tipe'] == "petugas")){
  die("Permission denied 666");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Aplikasi Dashboard Warung</title>

  <!-- Custom fonts for this template-->
  <link href="../template/SB Admin 2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../template/SB Admin 2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard <sup> Warung</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="?page=dashboard">
          <i class="fas fa-fw "></i>
          <span>Dashboard</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="?page=meja">
          <i class="fas fa-fw "></i>
          <span>Meja</span></a>
      </li>

      <?php
      if(!empty($_SESSION['USER']['level'] == "admin")){

      ?>
      <li class="nav-item active">
        <a class="nav-link" href="?page=menu">
        <i class="fas fa-fw" style="color: #ffffff;"></i>
          <span>Menu</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="?page=petugas">
          <i class="fas fa-fw "></i>
          <span>Petugas</span></a>
      </li>
      
      <?php
      }
      ?>

    <li class="nav-item active">
        <a class="nav-link" href="?page=pesanan">
          <i class="fas fa-fw "></i>
          <span>Pesanan</span></a>
      </li>

     <li class="nav-item active">
        <a class="nav-link" href="?page=pesananuser">
          <i class="fas fa-fw "></i>
          <span>Pesanan User</span></a>
      </li>

      
    
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

           

            <div class="topbar-divider d-none d-sm-block"></div>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['USER']['nama_petugas'] ?></span>
                <img class="img-profile rounded-circle" src="../template/SB Admin 2/img/boy.png">
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
     
        <div class="container-fluid">


       <?php

        if(empty($_POST['page'])){
            include ($_GET['page'].'.php');
        }else{
            include ("dashboard.php");
        }

        ?>

    </div>

  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../kontrol/kontrolLogin.php?aksi=logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <script src="../template/SB Admin 2/vendor/jquery/jquery.min.js"></script>
  <script src="../template/SB Admin 2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../template/SB Admin 2/vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="../template/SB Admin 2/js/sb-admin-2.min.js"></script>

  <script src="../template/SB Admin 2/vendor/chart.js/Chart.min.js"></script>

  <script src="../template/SB Admin 2/js/demo/chart-area-demo.js"></script>
  <script src="../template/SB Admin 2/js/demo/chart-pie-demo.js"></script>

</body>

</html>
