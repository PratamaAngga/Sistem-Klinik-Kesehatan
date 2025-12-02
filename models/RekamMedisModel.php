<?php
require_once __DIR__ . "/../config/koneksi.php";

class RekamMedisModel {
    private $db;

    public function __construct()
    {
        $this->db = (new Koneksi())->getKoneksi();
    }

    /**
     * Ambil semua rekam medis untuk satu pasien
     * + nama dokter
     * + total_biaya_obat dari FUNCTION scalar hitung_total_biaya_obat()
     */
    public function getByPasienId($pasien_id)
    {
        $sql = "
            SELECT 
                rm.rekam_id,
                rm.pasien_id,
                rm.dokter_id,
                rm.tanggal_periksa,
                rm.diagnosis,
                rm.tindakan,
                d.nama AS nama_dokter,
                -- panggil FUNCTION scalar
                hitung_total_biaya_obat(rm.rekam_id) AS total_biaya_obat
            FROM rekam_medis rm
            LEFT JOIN dokter d ON d.dokter_id = rm.dokter_id
            WHERE rm.pasien_id = :id
            ORDER BY rm.tanggal_periksa DESC, rm.rekam_id DESC
        ";

        $query = $this->db->prepare($sql);
        $query->execute([':id' => $pasien_id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Ambil daftar obat per rekam medis
     * dari tabel rekam_medis_obat + obat
     */
    public function getObatByRekamId($rekam_id)
    {
        $sql = "
            SELECT 
                o.nama_obat,
                rmo.jumlah,
                rmo.total_biaya
            FROM rekam_medis_obat rmo
            JOIN obat o ON o.obat_id = rmo.obat_id
            WHERE rmo.rekam_id = :id
        ";

        $query = $this->db->prepare($sql);
        $query->execute([':id' => $rekam_id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
