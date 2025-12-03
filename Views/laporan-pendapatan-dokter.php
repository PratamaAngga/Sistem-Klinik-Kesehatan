<div class="page-inner">
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-1">Laporan Pendapatan Dokter</h3>
      <p class="mb-0">
        Data diambil dari <code>materialized view laporan_pendapatan_dokter</code>.<br>
        Klik tombol <strong>Refresh</strong> jika ada data rekam medis baru.
      </p>
    </div>

    <div class="ms-md-auto mt-3 mt-md-0">
      <a href="index.php?page=refresh-laporan-pendapatan-dokter" 
         class="btn btn-primary"
         onclick="return confirm('Refresh materialized view? Proses ini akan menghitung ulang laporan.');">
        Refresh Laporan
      </a>
    </div>
  </div>

  <?php if (isset($_GET['refreshed'])): ?>
    <div class="alert alert-success">
      Materialized view <strong>laporan_pendapatan_dokter</strong> berhasil di-refresh.
    </div>
  <?php endif; ?>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title mb-0">Data Pendapatan per Dokter</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="display table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Dokter</th>
                  <th>Spesialisasi</th>
                  <th>Jumlah Rekam Medis</th>
                  <th>Total Pendapatan</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($dataLaporan)): ?>
                  <tr>
                    <td colspan="5" class="text-center">
                      Belum ada data laporan pendapatan dokter.
                    </td>
                  </tr>
                <?php else: ?>
                  <?php $no = 1; foreach ($dataLaporan as $row): ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= htmlspecialchars($row['nama_dokter']); ?></td>
                      <td><?= htmlspecialchars($row['nama_spesialisasi']); ?></td>
                      <td><?= htmlspecialchars($row['jumlah_rekam']); ?></td>
                      <td>Rp <?= number_format($row['total_pendapatan'], 0, ',', '.'); ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
