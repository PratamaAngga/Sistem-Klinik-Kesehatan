<?php
require_once __DIR__ . "/../config/koneksi.php";

class RekamMedisModel {
    private $db;

    public function __construct()
    {
        $this->db = (new Koneksi())->getKoneksi();
    }

    public function getByPasienId($pasien_id)
    {
        $query = $this->db->prepare("
            SELECT 
                rm.rekam_id,
                rm.pasien_id,
                rm.dokter_id,
                rm.tanggal_periksa,
                rm.diagnosis,
                rm.tindakan,
                d.nama AS nama_dokter
            FROM rekam_medis rm
            JOIN dokter d ON d.dokter_id = rm.dokter_id
            WHERE rm.pasien_id = :id
            ORDER BY rm.tanggal_periksa DESC, rm.rekam_id DESC
        ");
        $query->execute([':id' => $pasien_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
