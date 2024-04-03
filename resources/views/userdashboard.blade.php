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
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
                </a>
            </li>
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
                    <a href="dashboard.php" class="nav-link" style="background-color: #e83e8c; color: white;">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        My Category
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Events and Trainings List
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>
                        My Participations
                    </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-clock"></i>
                    <p>
                        My Volunteering Hours
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-trophy"></i>
                    <p>
                        My Rewards
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-passport"></i>
                    <p>
                        My Virtual Passport
                    </p>
                    </a>

                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-book-open"></i>
                    <p>
                        Volunteer Manual
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-shopping-bag"></i>
                    <p>
                        Leaderboard
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-message"></i>
                    <p>
                        My Messages
                    </p>
                    </a>
                </li>
            
                <li class="nav-item">
                    <a href="../index.php" class="nav-link">
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

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>

                                <p>Total Pets</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dog"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>545</h3>

                                <p>Total Pet Products</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shopping-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>1,322<sup style="font-size: 20px"></sup></h3>

                                <p>Total Services</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users-cog"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection


@section ('footer')
  <footer class="main-footer">
    <strong>Footer <a href="">Pet Shop Magement System</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Footer</b>
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
@endsection

