<?php
require_once __DIR__ . "/../config/koneksi.php";
class LaporanModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Koneksi())->getKoneksi();
    }

    // === TABEL 1 ===
    public function getJadwalByTanggal($tanggal)
    {
        $stmt = $this->db->prepare("
            SELECT d.nama AS nama_dokter, s.nama_spesialisasi AS spesialisasi,
                   j.jam_mulai, j.jam_selesai,
                   COUNT(jt.janji_id) AS jumlah_janji
            FROM jadwal_praktek j
            JOIN dokter d ON j.dokter_id = d.dokter_id
            JOIN spesialisasi s ON d.spesialisasi_id = s.spesialisasi_id
            LEFT JOIN janji_temu jt ON jt.jadwal_id = j.jadwal_id
              AND jt.tanggal_janji = :tanggal
            WHERE j.tanggal_praktek = :tanggal
            GROUP BY d.nama, s.nama_spesialisasi, j.jam_mulai, j.jam_selesai
            ORDER BY j.jam_mulai ASC
        ");

        $stmt->execute([':tanggal' => $tanggal]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // === TABEL 2 ===
    public function getJanjiFiltered($status)
    {
        $sql = "
            SELECT p.nama AS nama_pasien, d.nama AS nama_dokter,
                   s.nama_spesialisasi AS nama_spesialisasi,
                   jt.tanggal_janji, jt.jam_janji, jt.status
            FROM janji_temu jt
            JOIN pasien p ON jt.pasien_id = p.pasien_id
            JOIN jadwal_praktek j ON jt.jadwal_id = j.jadwal_id
            JOIN dokter d ON j.dokter_id = d.dokter_id
            JOIN spesialisasi s ON d.spesialisasi_id = s.spesialisasi_id
            WHERE 1=1
        ";

        $params = [];

        if (!empty($status)) {
            $sql .= " AND jt.status = :status";
            $params[':status'] = $status;
        }

        $sql .= " ORDER BY jt.tanggal_janji, jt.jam_janji";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
