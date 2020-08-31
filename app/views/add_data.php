<?php
require '../../start.php';

use Controllers\Datas;
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

if (isset($_POST['add_data'])) {
    $uid = $_SESSION['user_id'];
    $number = !empty($_POST['number']) ? trim($_POST['number']) : null;
    $code = !empty($_POST['code']) ? trim($_POST['code']) : null;
    $start_date = !empty($_POST['start_date']) ? trim($_POST['start_date']) : null;
    $end_date = !empty($_POST['end_date']) ? trim($_POST['end_date']) : null;
    $num1 = !empty($_POST['num1']) ? trim($_POST['num1']) : null;
    $percent = !empty($_POST['percent']) ? trim($_POST['percent']) : null;
    $num2 = !empty($_POST['num2']) ? trim($_POST['num2']) : null;
    $expiry_date = !empty($_POST['expiry_date']) ? trim($_POST['expiry_date']) : null;

    $update = Datas::add_data($uid, $number, $code, $start_date, $end_date, $num1, $percent, $num2, $expiry_date);

    if ($update) {
        $msg = "Inserted new data";
        Audits::add_audit($_SESSION['user_id'], $msg);

        header("Location: home.php");
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
                            <h1 class="m-0 text-dark">Insert Data</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Insert Data</li>
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
                                        <i class="fas fa-edit mr-1"></i>
                                        Insert Data
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- FORM -->
                                    <form action='add_data.php' method='post'>
                                        <div class="input-group mb-3">
                                            <input name="number" type="number" class="form-control" placeholder="Number" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="code" type="text" class="form-control" placeholder="Code" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-id-badge"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="start_date" type="text" class="form-control" placeholder="Start Date" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-calendar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="end_date" type="text" class="form-control" placeholder="End Date" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-calendar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="num1" type="number" class="form-control" placeholder="Num 1" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-bacon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="percent" type="text" class="form-control" placeholder="Percent" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-percent"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="num2" type="number" class="form-control" placeholder="Num 2" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-bacon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="expiry_date" type="text" class="form-control" placeholder="Expiry Date" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-calendar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <button name="add_data" type="submit" class="btn btn-primary btn-block">Insert</button>
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