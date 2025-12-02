<?php
require_once __DIR__ . "/../config/koneksi.php";

class FunctionModel {
    private $db;

    public function __construct()
    {
        $this->db = (new Koneksi())->getKoneksi();
    }

    /**
     * Memanggil function scalar hitung_total_biaya_obat(p_rekam_id)
     */
    public function getTotalBiayaObat($rekam_id)
    {
        $sql = "SELECT hitung_total_biaya_obat(:id) AS total_biaya_obat";
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $rekam_id]);

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['total_biaya_obat'] : 0;
    }

    /**
     * Memanggil function table get_jadwal_dokter_by_tanggal(p_tanggal)
     */
    public function getJadwalDokterByTanggal($tanggal)
    {
        $sql = "SELECT * FROM get_jadwal_dokter_by_tanggal(:tgl)";
        $query = $this->db->prepare($sql);
        $query->execute([':tgl' => $tanggal]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
