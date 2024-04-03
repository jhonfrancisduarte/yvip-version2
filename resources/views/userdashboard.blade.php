@extends ('layout')


@section ('title')
    <title>My Dashboard</title>
@endsection

@section ('css')
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
@endsection


@section ('main-content')
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light navbar-pink">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                
                </ul>



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            
            <!-- Notifications Dropdown Menu -->

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
                </a>
            </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
            <img src="images/nyc-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">YIMS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <a href="#" class="d-block">Example User</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#dashboard" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#my-category" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        My Category
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#events-and-trainings" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Events and Trainings List
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#my-participations" class="nav-link">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>
                        My Participations
                    </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#my-volunteering-hours" class="nav-link">
                    <i class="nav-icon fas fa-clock"></i>
                    <p>
                        My Volunteering Hours
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#my-rewards" class="nav-link">
                    <i class="nav-icon fas fa-award"></i>
                    <p>
                        My Rewards
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#my-virtual-passport" class="nav-link">
                    <i class="nav-icon fas fa-passport"></i>
                    <p>
                        My Virtual Passport
                    </p>
                    </a>

                <li class="nav-item">
                    <a href="#volunteer-manual" class="nav-link">
                    <i class="nav-icon fas fa-book-open"></i>
                    <p>
                        Volunteer Manual
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#leaderboard" class="nav-link">
                    <i class="nav-icon fas fa-trophy"></i>
                    <p>
                        Leaderboard
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#my-messages" class="nav-link">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>
                        My Messages
                    </p>
                    </a>
                </li>
            
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                    </a>
                </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        <!-- Main content -->

        </div>

@endsection


@section ('footer')
  <footer class="main-footer">
    <strong><a href="">Youth Information Management System</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
@endsection


@section ('js')
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/chart.js/Chart.min.js"></script>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="js/dashboard.js"></script>
@endsection

