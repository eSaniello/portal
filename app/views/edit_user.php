<?php
require '../../start.php';

use Controllers\Users;
use Controllers\Audits;

session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    header("Location: ../../index.php");
    exit;
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../../index.php");
}

if (isset($_GET['user_id'])) {
    $d = Users::get_user_by_id($_GET['user_id']);
}

if (isset($_POST['update_user'])) {
    $id = !empty($_POST['user_id']) ? trim($_POST['user_id']) : null;
    $fullname = !empty($_POST['fullname']) ? trim($_POST['fullname']) : null;
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $admin = !empty($_POST['admin']) ? trim($_POST['admin']) : null;

    $update = Users::update($id, $fullname, $username, $admin);

    if ($update) {
        $msg = "Updated a user";
        Audits::add_audit($_SESSION['user_id'], $msg);

        header("Location: users.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- include nav.php -->
    <?php include "../assets/includes/meta.php"; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- include nav.php -->
        <?php include "../assets/includes/nav.php"; ?>


        <!-- include sidebar.php -->
        <?php include "../assets/includes/sidebar.php"; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Edit User</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit User</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-5 connectedSortable">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-user mr-1"></i>
                                        Edit User
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- FORM -->
                                    <form action='edit_user.php' method='post'>
                                        <input name="user_id" type="hidden" value="<?php echo $d[0]['id']; ?>">
                                        <div class="input-group mb-3">
                                            <input name="fullname" type="text" class="form-control" placeholder="Fullname" required value="<?php echo $d[0]['fullname']; ?>">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="username" type="text" class="form-control" placeholder="Username" required value="<?php echo $d[0]['username']; ?>">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- select -->
                                        <div class="input-group mb-3">
                                            <label>Admin</label>
                                            <select name="admin" class="form-control">
                                                <option value="1" <?php if ($d[0]['admin'] == 1) echo "selected"; ?>>Yes</option>
                                                <option value="0" <?php if ($d[0]['admin'] == 0) echo "selected"; ?>>No</option>
                                            </select>
                                        </div>
                                        <button name="update_user" type="submit" class="btn btn-primary btn-block">Update</button>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </section>
                        <!-- /.Left col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.5
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
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../assets/plugins/moment/moment.min.js"></script>
    <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/js/adminlte.js"></script>


    <script src="../assets/js/drag_n_drop.js"></script>
    <script src="../assets/js/actions.js"></script>
</body>

</html>