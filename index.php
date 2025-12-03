<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/controller/ObatController.php";
require_once __DIR__ . "/controller/PasienController.php";
require_once __DIR__ . "/controller/SpesialisasiController.php";
require_once __DIR__ . "/controller/RekamMedisController.php";
require_once __DIR__ . "/controller/DokterController.php";
require_once __DIR__ . "/controller/JadwalController.php";
require_once __DIR__ . "/controller/FunctionController.php";
require_once __DIR__ . "/controller/LaporanDokterController.php";
require_once __DIR__ . "/controller/JanjiTemuController.php";

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

    // ==========================
    // KELOLA PASIEN
    // ==========================
} elseif ($page === 'kelola-pasien') {
    $controller = new PasienController();
    $dataPasien = $controller->index();
    $view = "Views/kelola-pasien.php";

    // ==========================
    // KELOLA DOKTER
    // ==========================
} elseif ($page === 'kelola-dokter') {

    $controller = new DokterController();
    $data = $controller->index();

    $dataDokter         = $data['dataDokter'];
    $dataSpecialization = $data['dataSpecialization'];

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

    // ==========================
    // CRUD DOKTER (STORE/UPDATE/DELETE)
    // ==========================
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

} elseif ($page === 'kelola-jadwal') {
    $controller = new JadwalController();
    $dataJadwal = $controller->index();
    $view = "Views/kelola-jadwal.php";

} elseif ($page === 'store-jadwal') {
    $controller = new JadwalController();
    $controller->store($_POST);
    exit;

} elseif ($page === 'update-jadwal') {
    $controller = new JadwalController();
    $controller->update($_POST);
    exit;

} elseif ($page === 'delete-jadwal') {
    $controller = new JadwalController();
    $controller->delete($_POST);
    exit;

} elseif ($page === 'rekam-medis') {

    $pasien_id = $_GET['pasien_id'] ?? null;

    if (!$pasien_id) {
        header("Location: index.php?page=kelola-pasien");
        exit;
    }

    $controller = new RekamMedisController();
    $data = $controller->index($pasien_id);

    $pasien      = $data['pasien'];
    $rekam_medis = $data['rekam_medis'];

    $view = "Views/rekam-medis.php";

} elseif ($page === 'fungsi-total-biaya-obat') {

    $rekam_id   = $_GET['rekam_id'] ?? 1;
    $controller = new FunctionController();
    $data       = $controller->totalBiayaObat($rekam_id);

    $rekam_id         = $data['rekam_id'];
    $total_biaya_obat = $data['total_biaya_obat'];

    $view = "Views/fungsi-total-biaya-obat.php";

} elseif ($page === 'laporan-pendapatan-dokter') {

    $controller  = new LaporanDokterController();
    $dataLaporan = $controller->index();
    $view        = "Views/laporan-pendapatan-dokter.php";

} elseif ($page === 'refresh-laporan-pendapatan-dokter') {

    $controller = new LaporanDokterController();
    $controller->refresh();
    exit;

} elseif ($page === 'janji-temu') {

    $controller = new JanjiTemuController();
    $data       = $controller->index();
    $view       = "Views/janji-temu.php";

} elseif ($page === 'store-janji') {

    $controller = new JanjiTemuController();
    $controller->store($_POST);
    exit;

} elseif ($page === 'update-janji') {

    $controller = new JanjiTemuController();
    $controller->update($_POST);
    exit;

} elseif ($page === 'delete-janji') {

    $controller = new JanjiTemuController();
    $controller->delete($_POST);
    exit;

} else {
    $controller = new FunctionController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tanggal = $_POST['tanggal'];
    } else {
        $tanggal = date("Y-m-d");
    }

    $jadwalData = $controller->jadwalDokterByTanggal(['tanggal' => $tanggal]);
    $janjiData  = $controller->getDaftarJanji();

    $tanggal    = $jadwalData['tanggal'];
    $jadwal     = $jadwalData['jadwal'];
    $daftarJanji= $janjiData['daftarJanji'];

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <?php include 'Includes/sidebar.php'; ?>
      <!-- End Sidebar -->

      <div class="main-panel">
        <?php include 'Includes/header.php'; ?>

        <div class="container" id="content-area">
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
    <script src="assets/js/plugin/jsvec
