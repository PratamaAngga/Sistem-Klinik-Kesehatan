<?php
require_once __DIR__ . "/../config/koneksi.php";

class DokterModel {
    private $db;

    public function __construct()
    {
        $this->db = (new Koneksi())->getKoneksi();
    }

    public function getAllDokter()
    {
        $query = $this->db->prepare("SELECT * FROM dokter ORDER BY dokter_id ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertDokter($nama, $no_str, $no_telp, $spesialisasi_id)
    {
        $query = $this->db->prepare("
            INSERT INTO dokter (nama, no_str, no_telp, spesialisasi_id)
            VALUES (:nama, :no_str, :no_telp, :spesialisasi_id)
        ");

        $query->execute([
            ':nama' => $nama,
            ':no_str' => $no_str,
            ':no_telp' => $no_telp,
            ':spesialisasi_id' => $spesialisasi_id
        ]);
    }

    public function updateDokter($id, $nama, $no_str, $no_telp, $spesialisasi_id)
    {
        $query = $this->db->prepare("
            UPDATE dokter
            SET nama = :nama,
                no_str = :no_str,
                no_telp = :no_telp,
                spesialisasi_id = :spesialisasi_id
            WHERE dokter_id = :id
        ");

        $query->execute([
            ':id' => $id,
            ':nama' => $nama,
            ':no_str' => $no_str,
            ':no_telp' => $no_telp,
            ':spesialisasi_id' => $spesialisasi_id
        ]);
    }

    public function deleteDokter($dokter_id)
    {
        $query = $this->db->prepare("DELETE FROM dokter WHERE dokter_id = :dokter_id");
        $query->execute([':dokter_id' => $dokter_id]);
    }

    public function getAllWithSpecialization()
    {
        $query = "
            SELECT d.*, s.nama_spesialisasi 
            FROM dokter d
            LEFT JOIN spesialisasi s ON d.spesialisasi_id = s.spesialisasi_id
            ORDER BY dokter_id ASC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
