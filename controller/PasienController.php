<?php  
require_once __DIR__ . "/../models/PasienModel.php";

class PasienController {
    private $model;

    public function __construct()
    {
        $this->model = new PasienModel();
    }

    public function index()
    {
        return $this->model->getAllPasien();
    }

    public function store($request)
    {
        $nama = $request['nama'];
        $tanggal_lahir = $request['tanggal_lahir'];
        $jenis_kelamin = $request['jenis_kelamin'];
        $no_telp = $request['no_telp'];
        $alamat = $request['alamat'];

        $this->model->insertPasien($nama, $tanggal_lahir, $jenis_kelamin, $no_telp, $alamat);

        header("Location: index.php?page=kelola-pasien");
    }

    public function update($request)
    {
        $this->model->updatePasien(
            $request['pasien_id'],
            $request['nama'],
            $request['tanggal_lahir'],
            $request['jenis_kelamin'],
            $request['no_telp'],
            $request['alamat']
        );

        header("Location: index.php?page=kelola-pasien");
    }

    public function delete($request)
    {
        $this->model->deletePasien($request['pasien_id']);
        header("Location: index.php?page=kelola-pasien");
    }

}
