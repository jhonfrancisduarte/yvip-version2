
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Medical Equipment Tracking System</title>
  <!-- Google Font: Source Sans Pro -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->

  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->

  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="file.css">

<script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=-7eSns8llm-RMrRDsxHMEIf7RLOedtIl6ZakLhKnAVIi-rbZhzluH4rAXuSX_8wNGEWusUgzMC9IkFMaNASdxErVoYrB2Z8hTL1irKOppalmPhXlsdexC0odXcoEnuLC" charset="UTF-8"></script>

</head>


<body class="hold-transition sidebar-mini">
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
      <img src="../dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Pet Shop Management</span>
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
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
             <a href="#" class="nav-link" >
              <i class="nav-icon fas fa-paw"></i>
              <p>
                Pet
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="petcategory.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="petmanagement.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Management</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="productcategory.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="product.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
             <a href="#" class="nav-link"  style="background-color: #e83e8c; color: white;">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Management
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="clientform.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Client Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="services.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="vendor.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vendor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="user.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="payment.php" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Payment
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="orderdetail.php" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Order Detail
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="usergroup.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Group
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Client Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Management</a></li>
              <li class="breadcrumb-item active">Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
       

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Client Form Data table</h3> 
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add" style="margin-left:77%"><i class="fa fa-plus">Add</i>
                </button>
                <div class="modal fade" id="add">
                        <div class="modal-dialog modal-lg">
                           <form action=".php" method="post" >
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Add Client</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="card card-primary">
                              <div class="card-body">
                                <div class="row">
                            <div class="col-4">
                              <div class="form-group">
                                  <label>First Name</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter First Name..">
                                </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                                  <label>Middle Name</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Middle Name..">
                                </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                                  <label>Last Name</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Last Name..">
                                </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                  <label>Complete Address</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="-    Street/Purok      -          City          -       Province     - ">
                                </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label>Email Address</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Email Address ..">
                                </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                                  <label>Contact Number</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Contact Number ..">
                                </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                                  <label>Civil Status</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Civil Status">
                                </div>
                              </div>
                               <div class="col-4">
                              <div class="form-group">
                                  <label>Birth Date</label>
                                  <input type="date" class="form-control" row="5" id="" name="" >
                                </div>
                              </div>
                               <div class="col-3">
                              <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Username ..">
                                </div>
                              </div>
                              
                               <div class="col-3">
                              <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" class="form-control" row="5" id="" name="" placeholder="Enter Password ..">
                                </div>
                              </div>
                              <div class="col-3">
                              <div class="form-group">
                                  <label>Status</label>
                                  <input type="password" class="form-control" row="5" id="" name="" placeholder="Enter Account Status ..">
                                </div>
                              </div>
                               <div class="col-3" style="margin-top:1%">
                                <div class="form-group">
                                 <label>Gender</label>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio1" checked="">
                                <label class="form-check-label">Male</label>
                                <input class="form-check-input" type="radio" name="radio1" style="margin-left:4%">
                                <label class="form-check-label" style="margin-left:14%">Female</label>
                              </div>
                              </div>
                            </div>
                            
                             <div class="col-3">
                              <div class="form-group">
                                   <input type="file" id="file" />
                                    <label for="file" class="btn-2"><i class="fa fa-file-image"></i> Profile</label>
                                </div>
                              </div>
                                </div>
                              
                              </div>
                          </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                            </div>
                          </div>
                          </form>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="12%">Profile</th>
                    <th>First Name</th>
                    <th>Middle</th>
                    <th>Last</th>
                    <th>Comple Address</th>
                    <th>Contact Number</th>
                    <th>Email Address</th>
                    <th>Gender</th>
                    <th>Civil Status</th>
                    <th>Birth Date</th>
                    <th>Age</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Account Status</th>
                    <th width="7%"></th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><img src="../dist/img/cat.jpg" alt="AdminLTE Logo" class="brand-image img-square elevation-3" width="70" style="opacity: .8"></td>
                      <td>Data</td>
                      <td>Data</td>
                      <td>Data</td>
                      <td>Data</td>
                      <td>+999-9699-999</td>
                      <td><i style="color: blue"><u>Data</u></i></td>
                      <td>Male</td>
                      <td>Data</td>
                      <td>10/12/20</td>
                      <td>43</td>
                      <td>Data</td>
                      <td>*********</td>
                      <td><span class="right badge badge-danger">Data</span></td>
                       <td>
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#update"><i class="fa fa-pencil-alt"></i> 
                        </button>
                        <button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i> 
                        </button>
                        </td>
                    </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th width="12%">Profile</th>
                    <th>First Name</th>
                    <th>Middle</th>
                    <th>Last</th>
                    <th>Comple Address</th>
                    <th>Contact Number</th>
                    <th>Email Address</th>
                    <th>Gender</th>
                    <th>Civil Status</th>
                    <th>Birth Date</th>
                    <th>Age</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Account Status</th>
                    <th width="7%"></th>
                  </tr>
                  </tfoot>
                </table>
            <div class="modal fade" id="update">
                        <div class="modal-dialog modal-lg">
                           <form action=".php" method="post" >
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Update Client</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="card card-primary">
                              <div class="card-body">
                                <div class="row">
                            <div class="col-4">
                              <div class="form-group">
                                  <label>First Name</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter First Name..">
                                </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                                  <label>Middle Name</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Middle Name..">
                                </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                                  <label>Last Name</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Last Name..">
                                </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                  <label>Complete Address</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="-    Street/Purok      -          City          -       Province     - ">
                                </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label>Email Address</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Email Address ..">
                                </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                                  <label>Contact Number</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Contact Number ..">
                                </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                                  <label>Civil Status</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Civil Status">
                                </div>
                              </div>
                               <div class="col-4">
                              <div class="form-group">
                                  <label>Birth Date</label>
                                  <input type="date" class="form-control" row="5" id="" name="" >
                                </div>
                              </div>
                               <div class="col-3">
                              <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Username ..">
                                </div>
                              </div>
                              
                               <div class="col-3">
                              <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" class="form-control" row="5" id="" name="" placeholder="Enter Password ..">
                                </div>
                              </div>
                              <div class="col-3">
                              <div class="form-group">
                                  <label>Status</label>
                                  <input type="password" class="form-control" row="5" id="" name="" placeholder="Enter Account Status ..">
                                </div>
                              </div>
                               <div class="col-3" style="margin-top:1%">
                                <div class="form-group">
                                 <label>Gender</label>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio1" checked="">
                                <label class="form-check-label">Male</label>
                                <input class="form-check-input" type="radio" name="radio1" style="margin-left:4%">
                                <label class="form-check-label" style="margin-left:14%">Female</label>
                              </div>
                              </div>
                            </div>
                            
                             <div class="col-3">
                              <div class="form-group">
                                   <input type="file" id="file" />
                                    <label for="file" class="btn-2"><i class="fa fa-file-image"></i> Profile</label>
                                </div>
                              </div>
                                </div>
                              
                              </div>
                          </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                            </div>
                          </div>
                          </form>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Footer <a href="">Pet Shop Magement System</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Footer</b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [""]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
