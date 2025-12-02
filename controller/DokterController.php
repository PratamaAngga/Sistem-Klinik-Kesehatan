<?php  
require_once __DIR__ . "/../models/DokterModel.php";
require_once __DIR__ . "/../models/SpesialisasiModel.php";

class DokterController {
    private $model;
    private $spesialisasi;

    public function __construct()
    {
        $this->model = new DokterModel();
        $this->spesialisasi = new SpesialisasiModel();
    }

    public function index()
    {
        $dokters = $this->model->getAllWithSpecialization();
        $specializations = $this->spesialisasi->getAllSpesialisasi();

        return [
            'dataDokter' => $dokters,
            'dataSpecialization' => $specializations
        ];
    }

    public function store($request)
    {
        $nama = $request['nama'];
        $no_str = $request['no_str'];
        $no_telp = $request['no_telp'];
        $spesialisasi_id = $request['spesialisasi_id'];

        $this->model->insertDokter($nama, $no_str, $no_telp, $spesialisasi_id);

        header("Location: index.php?page=kelola-dokter");
    }

    public function update($request)
    {
        $this->model->updateDokter(
            $request['dokter_id'],
            $request['nama'],
            $request['no_str'],
            $request['no_telp'],
            $request['spesialisasi_id']
        );

        header("Location: index.php?page=kelola-dokter");
    }

    public function delete($request)
    {
        $this->model->deleteDokter($request['dokter_id']);
        header("Location: index.php?page=kelola-dokter");
    }

}
