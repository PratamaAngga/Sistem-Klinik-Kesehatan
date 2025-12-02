<?php  
require_once __DIR__ . "/../models/JadwalModel.php";
require_once __DIR__ . "/../models/DokterModel.php";

class JadwalController {
    private $model;
    private $dokter;

    public function __construct()
    {
        $this->model = new JadwalModel();
        $this->dokter = new DokterModel();
    }

    public function index()
    {
        $jadwal = $this->model->getAllWithDokter();
        $dokter = $this->dokter->getAllDokter();

        return [
            'dataJadwal' => $jadwal,
            'dataDokter' => $dokter
        ];
    }

    public function store($request)
    {
        $tanggal_praktek = $request['tanggal_praktek'];
        $dokter_id = $request['dokter_id'];
        $jam_mulai = $request['jam_mulai'];
        $jam_selesai = $request['jam_selesai'];

        $this->model->insertJadwal($dokter_id, $tanggal_praktek, $jam_mulai, $jam_selesai);

        header("Location: index.php?page=kelola-jadwal");
    }

    public function update($request)
    {
        $this->model->updateJadwal(
            $request['jadwal_id'],
            $request['dokter_id'],
            $request['tanggal_praktek'],
            $request['jam_mulai'],
            $request['jam_selesai']
        );

        header("Location: index.php?page=kelola-jadwal");
    }

    public function delete($request)
    {
        $this->model->deleteJadwal($request['jadwal_id']);
        header("Location: index.php?page=kelola-jadwal");
    }

}
