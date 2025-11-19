<?php
require_once __DIR__ . "/../config/koneksi.php";

class ObatModel {
    private $db;

    public function __construct()
    {
        $this->db = (new Koneksi())->getKoneksi();
    }

    public function getAllObat()
    {
        $query = $this->db->prepare("SELECT * FROM obat ORDER BY obat_id ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertObat($nama, $jenis, $stok, $harga)
    {
        $query = $this->db->prepare("
            INSERT INTO obat (nama_obat, jenis_obat, stok, harga_satuan)
            VALUES (:nama, :jenis, :stok, :harga)
        ");

        $query->execute([
            ':nama' => $nama,
            ':jenis' => $jenis,
            ':stok' => $stok,
            ':harga' => $harga
        ]);
    }

    public function updateObat($id, $nama, $jenis, $stok, $harga)
    {
        $query = $this->db->prepare("
            UPDATE obat
            SET nama_obat = :nama,
                jenis_obat = :jenis,
                stok = :stok,
                harga_satuan = :harga
            WHERE obat_id = :id
        ");

        $query->execute([
            ':id' => $id,
            ':nama' => $nama,
            ':jenis' => $jenis,
            ':stok' => $stok,
            ':harga' => $harga
        ]);
    }

    public function deleteObat($id)
    {
        $query = $this->db->prepare("DELETE FROM obat WHERE obat_id = :id");
        $query->execute([':id' => $id]);
    }
}
