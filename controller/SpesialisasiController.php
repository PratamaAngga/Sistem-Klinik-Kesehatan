<?php
require_once __DIR__ . '/../models/SpesialisasiModel.php';

class SpesialisasiController
{
    private $model;

    public function __construct()
    {
        $this->model = new SpesialisasiModel();
    }

    public function index()
    {
        // dikirim ke View sebagai $dataSpesialisasi
        return $this->model->getAllSpesialisasi();
    }

    public function store($post)
    {
        $nama = $post['nama_spesialisasi'] ?? '';
        $kode = $post['kode_spesialis'] ?? '';

        $this->model->insertSpesialisasi($nama, $kode);

        header("Location: index.php?page=kelola-spesialisasi");
        exit;
    }

    public function update($post)
    {
        $id   = $post['spesialisasi_id'] ?? null;
        $nama = $post['nama_spesialisasi'] ?? '';
        $kode = $post['kode_spesialis'] ?? '';

        if ($id) {
            $this->model->updateSpesialisasi($id, $nama, $kode);
        }

        header("Location: index.php?page=kelola-spesialisasi");
        exit;
    }

    public function delete($post)
    {
        $id = $post['spesialisasi_id'] ?? null;

        if ($id) {
            $this->model->deleteSpesialisasi($id);
        }

        header("Location: index.php?page=kelola-spesialisasi");
        exit;
    }
}
