<?php
require_once __DIR__ . "/controller/ObatController.php";
require_once __DIR__ . "/controller/SpesialisasiController.php";

$page = $_GET['page'] ?? 'dashboard';

if ($page === 'kelola-obat') {
    $controller = new ObatController();
    $dataObat = $controller->index();
    $view = "Views/kelola-obat.php";

} elseif ($page === 'store-obat') {
    $controller = new ObatController();
    $controller->store($_POST);
    exit;

} elseif ($page === 'update-obat') {
    $controller = new ObatController();
    $controller->update($_POST);
    exit;

} elseif ($page === 'delete-obat') {
    $controller = new ObatController();
    $controller->delete($_POST);
    exit;

} elseif ($page === 'kelola-spesialisasi') {
    $controller = new SpesialisasiController();
    $dataSpesialisasi = $controller->index();
    $view = "Views/kelola-spesialisasi.php";

} elseif ($page === 'store-spesialisasi') {
    $controller = new SpesialisasiController();
    $controller->store($_POST);
    exit;

} elseif ($page === 'update-spesialisasi') {
    $controller = new SpesialisasiController();
    $controller->update($_POST);
    exit;

} elseif ($page === 'delete-spesialisasi') {
    $controller = new SpesialisasiController();
    $controller->delete($_POST);
    exit;

} else {
    $view = "Views/dashboard.php";
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sistem Informasi Klinik Kesehatan</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.css" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <?php include 'Includes/sidebar.php'; ?>
      <!-- End Sidebar -->

      <div class="main-panel">
        <?php include 'Includes/header.php'; ?>
        

        <div class="container"  id="content-area">
          <?php include $view; ?>
        </div>

        <!-- Footer -->
        <?php include 'Includes/footer.php'; ?>
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>
    <script>
      $(document).ready(function() {
        if ($("#basic-datatables").length) {
            $("#basic-datatables").DataTable();
        }
    });
    </script>
    <script>
      $(document).on('click', '.btn-edit', function () {

          $("#edit_obat_id").val($(this).data('id'));
          $("#edit_nama").val($(this).data('nama'));
          $("#edit_jenis").val($(this).data('jenis')).change();
          $("#edit_stok").val($(this).data('stok'));
          $("#edit_harga").val($(this).data('harga'));

      });
      $(document).on('click', '.btn-delete', function () {

          $("#delete_obat_id").val($(this).data('id'));
          $("#delete_obat_nama").text($(this).data('nama'));

      });
    </script>

    <script>
      $(document).on('click', '.btn-edit-spesialisasi', function () {
          $("#edit_spesialisasi_id").val($(this).data('id'));
          $("#edit_nama_spesialisasi").val($(this).data('nama'));
          $("#edit_kode_spesialis").val($(this).data('kode'));
          $("#edit_deskripsi").val($(this).data('deskripsi'));
      });

      $(document).on('click', '.btn-delete-spesialisasi', function () {
          $("#delete_spesialisasi_id").val($(this).data('id'));
          $("#delete_spesialisasi_nama").text($(this).data('nama'));
      });
    </script>


    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
  </body>
</html>
