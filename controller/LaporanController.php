<?php
require_once __DIR__ . "/../models/FunctionModel.php";
class LaporanController
{
    private $model;

    public function __construct()
    {
        $this->model = new FunctionModel();
    }

    // CETAK TABEL 1
    public function jadwalPdf()
    {
        $tanggal = $_GET['tanggal'] ?? date('Y-m-d');

        $data['tanggal'] = $tanggal;
        $data['jadwal'] = $this->model->getJadwalDokterByTanggal($tanggal);

        include 'Views/jadwal_pdf.php';
    }

    // CETAK TABEL 2
    public function janjiPdf()
    {
        $status = $_GET['status'] ?? "";

        $data['status'] = $status;
        $data['janji'] = $this->model->getDaftarJanjiView($status);

        include 'Views/janji_pdf.php';
    }
}
