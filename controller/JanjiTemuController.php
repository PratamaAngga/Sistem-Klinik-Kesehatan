<?php
require_once __DIR__ . "/../models/JanjiTemuModel.php";
require_once __DIR__ . "/../models/ObatModel.php";
require_once __DIR__ . "/../models/PasienModel.php";
require_once __DIR__ . "/../models/DokterModel.php";
require_once __DIR__ . "/../models/JadwalModel.php";

class JanjiTemuController
{
    private $model;
    private $pasienModel;
    private $dokterModel;
    private $jadwalModel;
    private $obatModel;

    public function __construct()
    {
        $this->model = new JanjiTemuModel();
        $this->pasienModel = new PasienModel();
        $this->dokterModel = new DokterModel();
        $this->jadwalModel = new JadwalModel();
        $this->obatModel = new ObatModel();
    }

    public function index()
    {
        $data['janji'] = $this->model->getAll();
        $data['obatList'] = $this->obatModel->getAllObat();
        $data['pasien']  = $this->pasienModel->getAllPasien();
        $data['dokter']  = $this->dokterModel->getAllDokter();
        $data['jadwal']  = $this->jadwalModel->getAllJadwal();
        
        return $data;
    }

    public function store($request)
    {
        $result = $this->model->create([
            'pasien_id' => $request['pasien_id'],
            'dokter_id' => $request['dokter_id'],
            'jadwal_id' => $request['jadwal_id'],
            'tanggal'   => $request['tanggal'],
            'jam'       => $request['jam'],
        ]);

        if ($result === true) {
            $_SESSION['success'] = "Janji temu berhasil ditambahkan!";
        } else {
            $_SESSION['error'] = $result;
        }

        header("Location: index.php?page=janji-temu");
        exit;
    }

    public function update()
    {
        // ambil POST dan validasi singkat
        $post = $_POST;
        $ok = $this->model->update($post);
        if ($ok === true) {
            $_SESSION['success'] = "Janji temu berhasil diubah!";
        } else {
            $_SESSION['error'] = $ok;
        }
        header("Location: index.php?page=janji-temu");
        exit;
    }

    public function delete()
    {
        $id = $_POST['janji_id'] ?? null;
        if ($id) {
            $ok = $this->model->delete($id);
            if ($ok === true) {
                $_SESSION['success'] = "Janji temu berhasil dihapus!";
            } else {
                $_SESSION['error'] = $ok;
            }
        } else {
            $_SESSION['error'] = "Janji tidak ada atau tidak terdeteksi!";
        }
        header("Location: index.php?page=janji-temu");
        exit;
    }

    public function akhiri()
    {
        // Menerima POST dari modal akhiri janji
        $janji_id = intval($_POST['janji_id']);
        $pasien_id = intval($_POST['pasien_id']);
        $dokter_id = intval($_POST['dokter_id']);
        $tanggal_periksa = $_POST['tanggal_periksa'] ?? date('Y-m-d');
        $diagnosis = $_POST['diagnosis'] ?? '';
        $tindakan = $_POST['tindakan'] ?? '';

        // arrays obat
        $obat_ids = $_POST['obat_id'] ?? [];
        $jumlahs = $_POST['jumlah'] ?? [];
        $dosiss = $_POST['dosis'] ?? [];
        $total_biayas = $_POST['total_biaya'] ?? [];

        // cast arrays elements to appropriate types/clean
        $obat_ids = array_map('intval', $obat_ids);
        $jumlahs = array_map('intval', $jumlahs);
        $dosiss = array_map('trim', $dosiss);
        // total_biayas may be formatted; remove thousand separators
        $total_biayas = array_map(function($v){
            $v = str_replace(['.',','], ['',''], $v); // jika ada ribuan like "10.000"
            return is_numeric($v) ? $v : 0;
        }, $total_biayas);

        $res = $this->model->akhiriJanji(
            $janji_id,
            $pasien_id,
            $dokter_id,
            $tanggal_periksa,
            $diagnosis,
            $tindakan,
            $obat_ids,
            $jumlahs,
            $dosiss,
            $total_biayas
        );

        if ($res['success']) {
            $_SESSION['success-akhiri'] = [
                'type' => 'success',
                'message' => 'Janji temu berhasil diselesaikan!'
            ];
        } else {
            // kalau $result['message'] bisa array, ubah jadi string
            $msg = $res['message'];
            if (is_array($msg)) {
                $msg = implode(' | ', $msg); // atau json_encode($msg)
            }
            $_SESSION['error-akhiri'] = [
                'type' => 'danger',
                'message' => $msg
            ];
        }
        header("Location: index.php?page=janji-temu");
        exit;
    }
}
