<?php  
require_once __DIR__ . "/../models/ObatModel.php";

class ObatController {
    private $model;

    public function __construct()
    {
        $this->model = new ObatModel();
    }

    public function index()
    {
        return $this->model->getAllObat();
    }

    public function store($request)
    {
        $nama = $request['nama_obat'];
        $jenis = $request['jenis'];
        $stok = $request['stok'];
        $harga = $request['harga_satuan'];

        $this->model->insertObat($nama, $jenis, $stok, $harga);

        header("Location: index.php?page=kelola-obat");
    }
}
