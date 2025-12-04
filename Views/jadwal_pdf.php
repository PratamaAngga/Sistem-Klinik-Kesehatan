<?php
require_once __DIR__ . '/../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();

ob_start();
?>

<h3 style="text-align:center;">Laporan Jadwal Dokter</h3>
<p>Tanggal: <?= htmlspecialchars($tanggal) ?></p>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>Nama Dokter</th>
      <th>Spesialisasi</th>
      <th>Jam Mulai</th>
      <th>Jam Selesai</th>
      <th>Jumlah Janji</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['jadwal'] as $row): ?>
    <tr>
      <td><?= $row['nama_dokter'] ?></td>
      <td><?= $row['spesialisasi'] ?></td>
      <td><?= $row['jam_mulai'] ?></td>
      <td><?= $row['jam_selesai'] ?></td>
      <td><?= $row['jumlah_janji'] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('jadwal_dokter.pdf', ['Attachment' => 1]);
