<?php
require_once __DIR__ . "/../config/koneksi.php";
class JanjiTemuModel
{
    private $db; // PDO

    public function __construct()
    {
        // Koneksi::getConnection() diasumsikan mengembalikan PDO (Postgres)
        $this->db = (new Koneksi())->getKoneksi();
    }

    // Ambil semua janji temu (join pasien + dokter)
    public function getAll()
    {
        $sql = "
            SELECT
                jt.janji_id,
                jt.tanggal_janji,
                jt.jam_janji,
                jt.status,
                p.pasien_id,
                p.nama as nama_pasien,
                d.dokter_id,
                d.nama AS nama_dokter
            FROM janji_temu jt
            JOIN pasien p ON jt.pasien_id = p.pasien_id
            JOIN dokter d ON jt.dokter_id = d.dokter_id
            ORDER BY jt.tanggal_janji DESC, jt.jam_janji DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($janji_id)
    {
        $sql = "
            SELECT jt.*, p.nama as nama_pasien, d.nama AS nama_dokter
            FROM janji_temu jt
            JOIN pasien p ON jt.pasien_id = p.pasien_id
            JOIN dokter d ON jt.dokter_id = d.dokter_id
            WHERE jt.janji_id = :jid
            LIMIT 1
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':jid' => $janji_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        try {
            $stmt = $this->db->prepare("
               INSERT INTO janji_temu (pasien_id, dokter_id, jadwal_id, tanggal_janji, jam_janji)
               VALUES (:pasien_id, :dokter_id, :jadwal_id, :tanggal_janji, :jam_janji)
           ");
   
           return $stmt->execute([
               ':pasien_id'     => $data['pasien_id'],
               ':dokter_id'     => $data['dokter_id'],
               ':jadwal_id'     => $data['jadwal_id'],
               ':tanggal_janji' => $data['tanggal'],
               ':jam_janji'     => $data['jam'],
           ]);
        } catch (PDOException $e) {
            $fullMsg = $e->getMessage();

            // Ambil yang setelah "ERROR:"
            $posErr = strpos($fullMsg, "ERROR:");
            if ($posErr !== false) {
                $cleanMsg = trim(substr($fullMsg, $posErr + 6));
            } else {
                $cleanMsg = $fullMsg;
            }

            // Hapus bagian mulai "CONTEXT:"
            $posContext = strpos($cleanMsg, "CONTEXT:");
            if ($posContext !== false) {
                $cleanMsg = trim(substr($cleanMsg, 0, $posContext));
            }

            return $cleanMsg;
        }
    }

    public function update($data)
    {
        try {
            $sql = "UPDATE janji_temu
                    SET tanggal_janji = :tanggal_janji,
                        jam_janji = :jam_janji
                    WHERE janji_id = :janji_id";
    
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':tanggal_janji' => $data['tanggal_janji'],
                ':jam_janji'     => $data['jam_janji'],
                ':janji_id'      => $data['janji_id']
            ]);
        } catch (PDOException $e) {
            $fullMsg = $e->getMessage();

            // Ambil yang setelah "ERROR:"
            $posErr = strpos($fullMsg, "ERROR:");
            if ($posErr !== false) {
                $cleanMsg = trim(substr($fullMsg, $posErr + 6));
            } else {
                $cleanMsg = $fullMsg;
            }

            // Hapus bagian mulai "CONTEXT:"
            $posContext = strpos($cleanMsg, "CONTEXT:");
            if ($posContext !== false) {
                $cleanMsg = trim(substr($cleanMsg, 0, $posContext));
            }

            return $cleanMsg;
        }
    }

    public function delete($janji_id)
    {
        try {
            $sql = "DELETE FROM janji_temu WHERE janji_id = :jid";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':jid' => $janji_id]);
        } catch (PDOException $e) {
            $fullMsg = $e->getMessage();

            // Ambil yang setelah "ERROR:"
            $posErr = strpos($fullMsg, "ERROR:");
            if ($posErr !== false) {
                $cleanMsg = trim(substr($fullMsg, $posErr + 6));
            } else {
                $cleanMsg = $fullMsg;
            }

            // Hapus bagian mulai "CONTEXT:"
            $posContext = strpos($cleanMsg, "CONTEXT:");
            if ($posContext !== false) {
                $cleanMsg = trim(substr($cleanMsg, 0, $posContext));
            }

            return $cleanMsg;
        }
    }

    // Helper: convert PHP array to Postgres array literal, e.g. [1,2] -> '{1,2}'
    private function toPgArrayLiteral(array $arr)
    {
        // escape strings and numbers properly
        $escaped = array_map(function($v) {
            if (is_null($v)) return 'NULL';
            // if numeric, return as-is
            if (is_numeric($v)) return $v;
            // escape quotes/backslashes
            $s = str_replace(['\\','"'], ['\\\\','\"'], $v);
            // wrap with double quotes for PG text array elements
            return '"' . $s . '"';
        }, $arr);
        return '{' . implode(',', $escaped) . '}';
    }

    public function akhiriJanji(
        int $janji_id,
        int $pasien_id,
        int $dokter_id,
        string $tanggal_periksa,
        string $diagnosis,
        string $tindakan,
        array $obat_ids,
        array $jumlahs,
        array $dosiss,
        array $total_biayas
    ) {
        $pg_obat_ids     = $this->toPgArrayLiteral($obat_ids);
        $pg_jumlahs      = $this->toPgArrayLiteral($jumlahs);
        $pg_dosiss       = $this->toPgArrayLiteral($dosiss);
        $pg_total_biayas = $this->toPgArrayLiteral($total_biayas);

        try {
            // === A & I: Atomicity + Isolation ===
            $this->db->beginTransaction();

            // Isolation level sederhana & aman
            $this->db->exec("SET TRANSACTION ISOLATION LEVEL READ COMMITTED");

            $sql = "
                CALL update_status_janji_selesai(
                    :p_janji_id,
                    :p_pasien_id,
                    :p_dokter_id,
                    :p_tanggal_periksa,
                    :p_diagnosis,
                    :p_tindakan,
                    :p_obat_ids,
                    :p_jumlahs,
                    :p_dosiss,
                    :p_total_biayas
                )
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':p_janji_id'        => $janji_id,
                ':p_pasien_id'       => $pasien_id,
                ':p_dokter_id'       => $dokter_id,
                ':p_tanggal_periksa' => $tanggal_periksa,
                ':p_diagnosis'       => $diagnosis,
                ':p_tindakan'        => $tindakan,
                ':p_obat_ids'        => $pg_obat_ids,
                ':p_jumlahs'         => $pg_jumlahs,
                ':p_dosiss'          => $pg_dosiss,
                ':p_total_biayas'    => $pg_total_biayas
            ]);

            // === COMMIT ===
            $this->db->commit();

            return ['success' => true];

        } catch (PDOException $e) {
            // === ROLLBACK ===
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            return [
                'success' => false,
                'message' => 'Transaksi gagal: ' . $e->getMessage()
            ];
        }
    }
}
