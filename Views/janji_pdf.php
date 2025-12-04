<?php
require_once __DIR__ . '/../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();

ob_start();
?>

<h3 style="text-align:center;">Laporan Janji Temu</h3>
<p>Status: <?= !empty($status) ? $status : "Semua" ?></p>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>Nama Pasien</th>
      <th>Nama Dokter</th>
      <th>Spesialisasi</th>
      <th>Tanggal</th>
      <th>Jam</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['janji'] as $row): ?>
    <tr>
      <td><?= $row['nama_pasien'] ?></td>
      <td><?= $row['nama_dokter'] ?></td>
      <td><?= $row['nama_spesialisasi'] ?></td>
      <td><?= $row['tanggal_janji'] ?></td>
      <td><?= $row['jam_janji'] ?></td>
      <td><?= $row['status'] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('daftar_janji.pdf', ['Attachment' => 1]);
