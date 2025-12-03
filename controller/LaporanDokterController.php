<?php
require_once __DIR__ . "/../models/LaporanDokterModel.php";

class LaporanDokterController {
    private $model;

    public function __construct()
    {
        $this->model = new LaporanDokterModel();
    }

    public function index()
    {
        $data = $this->model->getLaporanPendapatanDokter();
        return $data;
    }

    public function refresh()
    {
        $this->model->refreshLaporanPendapatanDokter();
        // balik ke halaman laporan dengan query string biar bisa tampil pesan
        header("Location: index.php?page=laporan-pendapatan-dokter&refreshed=1");
        exit;
    }
}
