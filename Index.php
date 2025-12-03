<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/controller/ObatController.php";
require_once __DIR__ . "/controller/PasienController.php";
require_once __DIR__ . "/controller/SpesialisasiController.php";
require_once __DIR__ . "/controller/RekamMedisController.php";
require_once __DIR__ . "/controller/DokterController.php";
require_once __DIR__ . "/controller/FunctionController.php";
require_once __DIR__ . "/controller/LaporanDokterController.php";


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

} elseif ($page === 'kelola-dokter') {

    require_once __DIR__ . "/controller/DokterController.php";

    $controller = new DokterController();
    $data       = $controller->index();

    // ambil isi array yang dikembalikan controller
    $dataDokter          = $data['dataDokter'];
    $dataSpecialization  = $data['dataSpecialization'];

    $view = "Views/kelola-dokter.php";


} elseif ($page === 'store-pasien') {
    $controller = new PasienController();
    $controller->store($_POST);
    exit;

} elseif ($page === 'update-pasien') {
    $controller = new PasienController();
    $controller->update($_POST);
    exit;

} elseif ($page === 'delete-pasien') {
    $controller = new PasienController();
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
} elseif ($page === 'kelola-dokter') {
    $controller = new DokterController();
    $dataDokter = $controller->index();
    $view = "Views/kelola-dokter.php";

} elseif ($page === 'store-dokter') {
    $controller = new DokterController();
    $controller->store($_POST);
    exit;

} elseif ($page === 'update-dokter') {
    $controller = new DokterController();
    $controller->update($_POST);
    exit;

} elseif ($page === 'delete-dokter') {
    $controller = new DokterController();
    $controller->delete($_POST);
    exit;

} elseif ($page === 'rekam-medis') { // << BLOK BARU

    $pasien_id = $_GET['pasien_id'] ?? null;

    if (!$pasien_id) {
        header("Location: index.php?page=kelola-pasien");
        exit;
    }

    $controller = new RekamMedisController();
    $data = $controller->index($pasien_id);

    // variabel yang dipakai di view
    $pasien      = $data['pasien'];
    $rekam_medis = $data['rekam_medis'];

    $view = "Views/rekam-medis.php";

} elseif ($page === 'fungsi-total-biaya-obat') {

    $rekam_id = $_GET['rekam_id'] ?? 1; // default 1 biar gampang test
    $controller = new FunctionController();
    $data = $controller->totalBiayaObat($rekam_id);

    $rekam_id = $data['rekam_id'];
    $total_biaya_obat = $data['total_biaya_obat'];

    $view = "Views/fungsi-total-biaya-obat.php";

} elseif ($page === 'fungsi-jadwal-dokter') {

    $tanggal = $_GET['tanggal'] ?? date('Y-m-d');
    $controller = new FunctionController();
    $data = $controller->jadwalDokterByTanggal($tanggal);

    $tanggal = $data['tanggal'];
    $jadwal  = $data['jadwal'];

    $view = "Views/fungsi-jadwal-dokter.php";

} elseif ($page === 'laporan-pendapatan-dokter') {

    $controller = new LaporanDokterController();
    $dataLaporan = $controller->index();
    $view = "Views/laporan-pendapatan-dokter.php";

} elseif ($page === 'refresh-laporan-pendapatan-dokter') {

    $controller = new LaporanDokterController();
    $controller->refresh(); // akan redirect, jadi tidak butuh $view
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
      $(document).on('click', '.btn-edit', function () {

          $("#edit_pasien_id").val($(this).data('id'));
          $("#edit_nama").val($(this).data('nama'));
          $("#edit_tanggal_lahir").val($(this).data('tanggal')).change();
          $("#edit_jenis_kelamin").val($(this).data('kelamin'));
          $("#edit_no_telp").val($(this).data('telp'));
          $("#edit_alamat").val($(this).data('alamat'));

      });
      $(document).on('click', '.btn-delete', function () {

          $("#delete_pasien_id").val($(this).data('id'));
          $("#delete_pasien_nama").text($(this).data('nama'));

      });
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

      $(document).on('click', '.btn-edit-dokter', function () {
          $("#edit_dokter_id").val($(this).data('id_dokter'));
          $("#edit_name_dokter").val($(this).data('nama'));
          $("#edit_no_str_dokter").val($(this).data('no_str'));
          $("#edit_no_telp_dokter").val($(this).data('no_telp'));
          $("#edit_spesialisasi_dokter").val($(this).data('spesialisasi'));
      });

      $(document).on('click', '.btn-delete-dokter', function () {
          $("#delete_dokter_id").val($(this).data('id_dokter'));
          $("#delete_name_dokter").text($(this).data('nama'));
      });
    </script>
  </body>
</html>
