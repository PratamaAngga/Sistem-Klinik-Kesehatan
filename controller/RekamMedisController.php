<?php
require_once __DIR__ . "/../models/RekamMedisModel.php";
require_once __DIR__ . "/../models/PasienModel.php";

class RekamMedisController {
    private $rekamModel;
    private $pasienModel;

    public function __construct()
    {
        $this->rekamModel  = new RekamMedisModel();
        $this->pasienModel = new PasienModel();
    }

public function index($pasien_id)
{
    $pasien     = $this->pasienModel->getPasienById($pasien_id);
    $rekamMedis = $this->rekamModel->getByPasienId($pasien_id);

    // tambahkan daftar obat ke setiap rekam medis
    foreach ($rekamMedis as &$rm) {
        $rm['obat'] = $this->rekamModel->getObatByRekamId($rm['rekam_id']);
    }
    unset($rm); // supaya aman

    return [
        'pasien'      => $pasien,
        'rekam_medis' => $rekamMedis,
    ];
}

}
