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

    public function getDaftarJanjiView($status = "")
    {
        if ($status === "" || $status === null) {
            // tanpa filter
            $sql = "SELECT * FROM daftar_janji_view ORDER BY tanggal_janji DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        } else {
            // dengan filter
            $sql = "SELECT * FROM daftar_janji_view WHERE status = :status ORDER BY tanggal_janji DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status', $status);
            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAntrianDokterHariIni($tanggal)
    {
        $sql = "
            SELECT 
                d.nama as nama_dokter,
                p.nama as nama_pasien,
                j.jam_janji
            FROM janji_temu j
            JOIN dokter d ON d.dokter_id = j.dokter_id
            JOIN pasien p ON p.pasien_id = j.pasien_id
            WHERE j.status = 'Menunggu'
            AND j.tanggal_janji = :tanggal
            ORDER BY j.dokter_id, j.jam_janji
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':tanggal' => $tanggal]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExplainAnalyzeAntrian($tanggal)
    {
        $sql = "
            EXPLAIN ANALYZE
            SELECT 
                d.nama,
                p.nama,
                j.jam_janji
            FROM janji_temu j
            JOIN dokter d ON d.dokter_id = j.dokter_id
            JOIN pasien p ON p.pasien_id = j.pasien_id
            WHERE j.status = 'Menunggu'
            AND j.tanggal_janji = :tanggal
            ORDER BY j.dokter_id, j.jam_janji
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':tanggal' => $tanggal]);

        return implode("\n", $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public function getReminderJanjiHariIni()
    {
        $sql = "
            SELECT 
                j.*, 
                d.nama as nama_dokter,
                p.nama as nama_pasien
            FROM janji_temu j
            JOIN dokter d ON d.dokter_id = j.dokter_id
            JOIN pasien p ON p.pasien_id = j.pasien_id
            WHERE j.status = 'Menunggu'
            AND j.tanggal_janji = CURRENT_DATE
            ORDER BY j.jam_janji
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
