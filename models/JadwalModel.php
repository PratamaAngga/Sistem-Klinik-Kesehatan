<?php
require_once __DIR__ . "/../config/koneksi.php";

class JadwalModel {
    private $db;

    public function __construct()
    {
        $this->db = (new Koneksi())->getKoneksi();
    }

    public function getAllJadwal()
    {
        $query = $this->db->prepare("SELECT * FROM jadwal_praktek ORDER BY jadwal_id ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertJadwal($dokter_id, $tanggal_praktek, $jam_mulai, $jam_selesai)
    {
        $query = $this->db->prepare("
            INSERT INTO jadwal_praktek (dokter_id, tanggal_praktek, jam_mulai, jam_selesai)
            VALUES (:dokter_id, :tanggal_praktek, :jam_mulai, :jam_selesai)
        ");

        $query->execute([
            ':dokter_id' => $dokter_id,
            ':tanggal_praktek' => $tanggal_praktek,
            ':jam_mulai' => $jam_mulai,
            ':jam_selesai' => $jam_selesai
        ]);
    }

    public function updateJadwal($jadwal_id, $dokter_id, $tanggal_praktek, $jam_mulai, $jam_selesai)
    {
        $query = $this->db->prepare("
            UPDATE jadwal_praktek
            SET dokter_id = :dokter_id,
                tanggal_praktek = :tanggal_praktek,
                jam_mulai = :jam_mulai,
                jam_selesai = :jam_selesai
            WHERE jadwal_id = :jadwal_id
        ");

        $query->execute([
            ':jadwal_id' => $jadwal_id,
            ':dokter_id' => $dokter_id,
            ':tanggal_praktek' => $tanggal_praktek,
            ':jam_mulai' => $jam_mulai,
            ':jam_selesai' => $jam_selesai
        ]);
    }

    public function deleteJadwal($jadwal_id)
    {
        $query = $this->db->prepare("DELETE FROM jadwal_praktek WHERE jadwal_id = :jadwal_id");
        $query->execute([':jadwal_id' => $jadwal_id]);
    }

    public function getAllWithDokter()
    {
        $query = "
            SELECT j.*, d.nama 
            FROM jadwal_praktek j
            LEFT JOIN dokter d ON d.dokter_id = j.dokter_id
            ORDER BY jadwal_id ASC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
