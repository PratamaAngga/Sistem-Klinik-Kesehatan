<?php
require_once __DIR__ . "/../config/koneksi.php";

class PasienModel {
    private $db;

    public function __construct()
    {
        $this->db = (new Koneksi())->getKoneksi();
    }

    public function getAllPasien()
    {
        $query = $this->db->prepare("
            SELECT 
                p.*, 
                COUNT(rm.rekam_id) AS jumlah_rekam_medis
            FROM 
                pasien p
            LEFT JOIN 
                rekam_medis rm ON p.pasien_id = rm.pasien_id
            GROUP BY 
                p.pasien_id
            ORDER BY 
                p.pasien_id ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertPasien($nama, $tanggal_lahir, $jenis_kelamin, $no_telp, $alamat)
    {
        $query = $this->db->prepare("
            INSERT INTO pasien (nama, tanggal_lahir, jenis_kelamin, no_telp, alamat)
            VALUES (:nama, :tanggal_lahir, :jenis_kelamin, :telp , :alamat)
        ");

        $query->execute([
            ':nama' => $nama,
            ':tanggal_lahir' => $tanggal_lahir,
            ':jenis_kelamin' => $jenis_kelamin,
            ':telp' => $no_telp,
            ':alamat' => $alamat
        ]);
    }

    public function updatePasien($id, $nama, $tanggal_lahir, $jenis_kelamin, $no_telp, $alamat)
    {
        $query = $this->db->prepare("
            UPDATE pasien
            SET nama = :nama,
                tanggal_lahir = :tanggal,
                jenis_kelamin = :kelamin,
                no_telp = :telp,
                alamat = :alamat
            WHERE pasien_id = :id
        ");

        $query->execute([
            ':id' => $id,
            ':nama' => $nama,
            ':tanggal' => $tanggal_lahir,
            ':kelamin' => $jenis_kelamin,
            ':telp' => $no_telp,
            ':alamat' => $alamat
        ]);
    }

    

    public function deletePasien($id)
    {
        $query = $this->db->prepare("DELETE FROM pasien WHERE pasien_id = :id");
        $query->execute([':id' => $id]);
    }
}
