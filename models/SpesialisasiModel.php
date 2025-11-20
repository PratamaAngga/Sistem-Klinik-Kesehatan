<?php
require_once __DIR__ . '/../config/koneksi.php';

class SpesialisasiModel {
    private $db;

    public function __construct()
    {
        $this->db = (new Koneksi())->getKoneksi();
    }

    public function getAllSpesialisasi()
    {
        $query = $this->db->prepare("SELECT * FROM spesialisasi ORDER BY spesialisasi_id ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertSpesialisasi($nama, $kode)
    {
        $query = $this->db->prepare("
            INSERT INTO spesialisasi (nama_spesialisasi, kode_spesialisasi)
            VALUES (:nama, :kode)
        ");

        $query->execute([
            ':nama' => $nama,
            ':kode' => $kode
        ]);
    }

    public function updateSpesialisasi($id, $nama, $kode)
    {
        $query = $this->db->prepare("
            UPDATE spesialisasi
            SET nama_spesialisasi = :nama,
                kode_spesialisasi = :kode
            WHERE spesialisasi_id = :id
        ");

        $query->execute([
            ':id'   => $id,
            ':nama' => $nama,
            ':kode' => $kode
        ]);
    }

    public function deleteSpesialisasi($id)
    {
        $query = $this->db->prepare("DELETE FROM spesialisasi WHERE spesialisasi_id = :id");
        $query->execute([':id' => $id]);
    }
}
