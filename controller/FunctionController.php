<?php
require_once __DIR__ . "/../models/FunctionModel.php";

class FunctionController {
    private $model;

    public function __construct()
    {
        $this->model = new FunctionModel();
    }

    // Halaman untuk function scalar
    public function totalBiayaObat($rekam_id)
    {
        $total = $this->model->getTotalBiayaObat($rekam_id);

        // data yang akan dipakai di view
        return [
            'rekam_id' => $rekam_id,
            'total_biaya_obat' => $total,
        ];
    }

    // Halaman untuk function table
    public function jadwalDokterByTanggal($request)
    {
        $tanggal = $request['tanggal'];
        $data = $this->model->getJadwalDokterByTanggal($tanggal);

        return [
            'tanggal' => $tanggal,
            'jadwal'  => $data,
        ];
    }

    public function getDaftarJanji($status = "")
    {
        $model = new FunctionModel();
        $data = $model->getDaftarJanjiView($status);

        return ['daftarJanji' => $data];
    }
}
