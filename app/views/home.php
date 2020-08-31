<?php
require '../../start.php';

use Controllers\Datas;

session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
  header("Location: ../../index.php");
  exit;
}

if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: ../../index.php");
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
              <h1 class="m-0 text-dark">Dashboard</h1>
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
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-10 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-database mr-1"></i>
                    Data
                  </h3>
                  <div class="card-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                        Export and E-mail
                        <i class="fas fa-file-export"></i></button>
                      <div class="dropdown-menu" role="menu">
                        <button class="dropdown-item" data-toggle="modal" data-target="#modal-pdf"><i class="fas fa-file-pdf"></i> Export to PDF</button>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" data-toggle="modal" data-target="#modal-word"><i class="fas fa-file-word"></i> Export to WORD</button>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" data-toggle="modal" data-target="#modal-excel"><i class="fas fa-file-excel"></i> Export to EXCEL</button>

                        <?php
                        if ($_SESSION['admin'] == 1) {
                          echo '<div class="dropdown-divider"></div>';
                          echo '<button class="dropdown-item" data-toggle="modal" data-target="#modal-csv"><i class="fas fa-file-csv"></i> Export to CSV</button>';
                          echo '<div class="dropdown-divider"></div>';
                          echo '<button class="dropdown-item" data-toggle="modal" data-target="#modal-json"><i class="fab fa-js"></i> Export to JSON</button>';
                        }
                        ?>

                      </div>
                    </div>
                    <button onclick="gotoAddPage()" type="button" class="btn btn-primary btn-sm">
                      Insert
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Number</th>
                        <th>Code</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Num 1</th>
                        <th>Percent</th>
                        <th>Num 2</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- INSERT DATA -->
                      <?php
                      $data = Datas::get_data_by_uid($_SESSION['user_id']);

                      foreach ($data as $d) {
                        echo "<tr>";
                        echo "<td>" . $d['number'] . "</td>";
                        echo "<td>" . $d['code'] . "</td>";
                        echo "<td>" . $d['start_date'] . "</td>";
                        echo "<td>" . $d['end_date'] . "</td>";
                        echo "<td>" . $d['num1'] . "</td>";
                        echo "<td>" . $d['percent'] . "</td>";
                        echo "<td>" . $d['num2'] . "</td>";
                        echo "<td>" . $d['expiry_date'] . "</td>";
                        echo "<td>
                          <button onclick='updateRecord(" . $d['id'] . ")' class='btn-xs btn-warning'><i class='fas fa-edit'></i></button>
                          <button onclick='deleteRecord(" . $d['id'] . ")' class='btn-xs btn-danger'><i class='fas fa-trash'></i></button>
                        </td>";
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </section>


            <div class="modal fade" id="modal-pdf">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Export and mail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <input name="from_pdf" type="email" class="form-control" placeholder="From:">
                    </div>
                    <div class="form-group">
                      <input name="to_pdf" type="email" class="form-control" placeholder="To:">
                    </div>
                    <div class="form-group">
                      <input name="subject_pdf" type="text" class="form-control" placeholder="Subject:">
                    </div>
                    <div class="form-group">
                      <textarea name="body_pdf" id="compose-textarea_pdf" class="form-control" style="height: 400px"></textarea>
                    </div>
                    <div class="form-group">
                      <div>
                        <i class="fas fa-paperclip"></i> Attachment
                        <p>data.pdf</p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button onclick="sendPdf()" type="button" class="btn btn-primary">Send</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


            <div class="modal fade" id="modal-word">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Export and mail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <input name="from_word" type="email" class="form-control" placeholder="From:">
                    </div>
                    <div class="form-group">
                      <input name="to_word" type="email" class="form-control" placeholder="To:">
                    </div>
                    <div class="form-group">
                      <input name="subject_word" type="text" class="form-control" placeholder="Subject:">
                    </div>
                    <div class="form-group">
                      <textarea name="body_word" id="compose-textarea_word" class="form-control" style="height: 400px"></textarea>
                    </div>
                    <div class="form-group">
                      <div>
                        <i class="fas fa-paperclip"></i> Attachment
                        <p>data.docx</p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button onclick="sendWord()" type="button" class="btn btn-primary">Send</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


            <div class="modal fade" id="modal-excel">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Export and mail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <input name="from_excel" type="email" class="form-control" placeholder="From:">
                    </div>
                    <div class="form-group">
                      <input name="to_excel" type="email" class="form-control" placeholder="To:">
                    </div>
                    <div class="form-group">
                      <input name="subject_excel" type="text" class="form-control" placeholder="Subject:">
                    </div>
                    <div class="form-group">
                      <textarea name="body_excel" id="compose-textarea_excel" class="form-control" style="height: 400px"></textarea>
                    </div>
                    <div class="form-group">
                      <div>
                        <i class="fas fa-paperclip"></i> Attachment
                        <p>data.xlsx</p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button onclick="sendExcel()" type="button" class="btn btn-primary">Send</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


            <div class="modal fade" id="modal-csv">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Export and mail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <input name="from_csv" type="email" class="form-control" placeholder="From:">
                    </div>
                    <div class="form-group">
                      <input name="to_csv" type="email" class="form-control" placeholder="To:">
                    </div>
                    <div class="form-group">
                      <input name="subject_csv" type="text" class="form-control" placeholder="Subject:">
                    </div>
                    <div class="form-group">
                      <textarea name="body_csv" id="compose-textarea_csv" class="form-control" style="height: 400px"></textarea>
                    </div>
                    <div class="form-group">
                      <div>
                        <i class="fas fa-paperclip"></i> Attachment
                        <p>data.csv</p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button onclick="sendCsv()" type="button" class="btn btn-primary">Send</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


            <div class="modal fade" id="modal-json">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Export and mail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <input name="from_json" type="email" class="form-control" placeholder="From:">
                    </div>
                    <div class="form-group">
                      <input name="to_json" type="email" class="form-control" placeholder="To:">
                    </div>
                    <div class="form-group">
                      <input name="subject_json" type="text" class="form-control" placeholder="Subject:">
                    </div>
                    <div class="form-group">
                      <textarea name="body_json" id="compose-textarea_json" class="form-control" style="height: 400px"></textarea>
                    </div>
                    <div class="form-group">
                      <div>
                        <i class="fas fa-paperclip"></i> Attachment
                        <p>data.json</p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button onclick="sendJson()" type="button" class="btn btn-primary">Send</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <div class="card bg-gradient-primary">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-upload mr-1"></i>
                    Upload Data
                  </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- PUT DRAG AND DROP HERE -->
                    <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                      <div id="drag_upload_file">
                        <p>*FILE MUST BE testdata.unl*</p>
                        <p>Drop file here</p>
                        <p>or</p>
                        <p><input type="button" class="btn-outline" value="Select File" onclick="file_explorer();"></p>
                        <input type="file" id="selectfile">
                      </div>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>
            <!-- right col -->
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

  <!-- Custom scripts -->
  <script src="../assets/js/drag_n_drop.js"></script>
  <script src="../assets/js/actions.js"></script>
  <script src="../assets/js/export.js"></script>

  <script>
    $(function() {
      //Add text editor
      $('#compose-textarea_pdf').summernote();
      $('#compose-textarea_word').summernote();
      $('#compose-textarea_excel').summernote();
      $('#compose-textarea_csv').summernote();
      $('#compose-textarea_json').summernote();
    })
  </script>
</body>

</html>