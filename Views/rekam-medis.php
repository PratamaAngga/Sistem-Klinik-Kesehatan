<div class="page-inner">
  <div
    class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
  >
    <div>
      <h3 class="fw-bold mb-1">Rekam Medis Pasien</h3>
      <p class="mb-0">
        <strong>Nama:</strong> <?= htmlspecialchars($pasien['nama']); ?><br>
        <strong>Tanggal Lahir:</strong> <?= htmlspecialchars($pasien['tanggal_lahir']); ?><br>
        <strong>Jenis Kelamin:</strong> <?= htmlspecialchars($pasien['jenis_kelamin']); ?><br>
        <strong>No. Telp:</strong> <?= htmlspecialchars($pasien['no_telp']); ?>
      </p>
    </div>

    <div class="ms-md-auto mt-3 mt-md-0">
      <a href="index.php?page=kelola-pasien" class="btn btn-secondary btn-round">
        &laquo; Kembali ke Kelola Pasien
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title mb-0">Daftar Rekam Medis</h4>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="display table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Periksa</th>
                  <th>Dokter</th>
                  <th>Diagnosis</th>
                  <th>Tindakan</th>
                </tr>
              </thead>

              <tbody>
                <?php if (empty($rekam_medis)): ?>
                  <tr>
                    <td colspan="5" class="text-center">
                      Belum ada rekam medis untuk pasien ini.
                    </td>
                  </tr>
                <?php else: ?>
                  <?php $no = 1; foreach ($rekam_medis as $rm): ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= htmlspecialchars($rm['tanggal_periksa']); ?></td>
                      <td><?= htmlspecialchars($rm['nama_dokter'] ?? ''); ?></td>
                      <td><?= nl2br(htmlspecialchars($rm['diagnosis'] ?? '')); ?></td>
                      <td><?= nl2br(htmlspecialchars($rm['tindakan'] ?? '')); ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <!-- Tidak ada tombol tambah rekam medis -->
        </div>
      </div>
    </div>
  </div>
</div>
