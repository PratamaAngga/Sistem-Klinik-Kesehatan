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

        return [
            'pasien'      => $pasien,
            'rekam_medis' => $rekamMedis,
        ];
    }
}
