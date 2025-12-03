<?php
require_once __DIR__ . "/../config/koneksi.php";

class LaporanDokterModel {
    private $db;

    public function __construct()
    {
        $this->db = (new Koneksi())->getKoneksi();
    }

    // Ambil data dari materialized view
    public function getLaporanPendapatanDokter()
    {
        $sql = "SELECT * FROM laporan_pendapatan_dokter ORDER BY total_pendapatan DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Refresh materialized view
    public function refreshLaporanPendapatanDokter()
    {
        $sql = "REFRESH MATERIALIZED VIEW laporan_pendapatan_dokter";
        $this->db->exec($sql);
    }
}
