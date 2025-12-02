<div class="page-inner">
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
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
                  <th>Total Biaya Obat</th>
                  <th>Detail Obat</th>
                </tr>
              </thead>

              <tbody>
                <?php if (empty($rekam_medis)): ?>
                  <tr>
                    <td colspan="7" class="text-center">
                      Belum ada rekam medis untuk pasien ini.
                    </td>
                  </tr>
                <?php else: ?>
                  <?php $no = 1; foreach ($rekam_medis as $rm): ?>
                    <?php $modalId = 'modalDetailObat' . $rm['rekam_id']; ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= htmlspecialchars($rm['tanggal_periksa']); ?></td>
                      <td><?= htmlspecialchars($rm['nama_dokter'] ?? ''); ?></td>
                      <td><?= nl2br(htmlspecialchars($rm['diagnosis'] ?? '')); ?></td>
                      <td><?= nl2br(htmlspecialchars($rm['tindakan'] ?? '')); ?></td>
                      <td>Rp <?= number_format($rm['total_biaya_obat'] ?? 0, 0, ',', '.'); ?></td>
                      <td>
                        <button 
                          type="button"
                          class="btn btn-sm btn-info"
                          data-bs-toggle="modal"
                          data-bs-target="#<?= $modalId; ?>"
                        >
                          Detail Obat
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <?php if (!empty($rekam_medis)): ?>
            <?php foreach ($rekam_medis as $rm): ?>
              <?php $modalId = 'modalDetailObat' . $rm['rekam_id']; ?>

              <!-- =============== MODAL POPUP DETAIL OBAT =============== -->
              <div class="modal fade" id="<?= $modalId; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title">
                        Detail Obat – Tanggal Periksa <?= htmlspecialchars($rm['tanggal_periksa']); ?>
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <?php if (empty($rm['obat'])): ?>
                        <p class="mb-0"><em>Tidak ada obat untuk rekam medis ini.</em></p>
                      <?php else: ?>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Total Biaya</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($rm['obat'] as $o): ?>
                                <tr>
                                  <td><?= htmlspecialchars($o['nama_obat']); ?></td>
                                  <td><?= htmlspecialchars($o['jumlah']); ?></td>
                                  <td>Rp <?= number_format($o['total_biaya'], 0, ',', '.'); ?></td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      <?php endif; ?>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Tutup
                      </button>
                    </div>

                  </div>
                </div>
              </div>
              <!-- ============= END MODAL POPUP ============= -->
            <?php endforeach; ?>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</div>
