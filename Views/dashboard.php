<div class="page-inner">
            <div
              class="d-flex justify-content-between pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
              </div>
              <form method="POST" action="index.php?page=dashboard" class="row g-3 mb-4">
                <div class="col-auto">
                  <label class="col-form-label">Tanggal</label>
                </div>
                <div class="col-auto">
                  <input type="date" name="tanggal-antrian-per-dokter" class="form-control" value="<?= htmlspecialchars($tanggal); ?>" required>
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAntrian">Tampilkan Antrian per Tanggal</button>
                </div>
              </form>
            </div>

            <?php if (!empty($reminder)): ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card border-warning card-round">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="fw-bold mb-0">Reminder Janji Hari Ini</h6>
                        </div>
                        <div class="card-body">
                            <ul class="mb-0">
                                <?php foreach ($reminder as $r): ?>
                                    <li>
                                        Dokter: <strong><?= htmlspecialchars($r['nama_dokter']) ?></strong> |
                                        Pasien: <strong><?= htmlspecialchars($r['nama_pasien']) ?></strong> |
                                        Jam: <strong><?= htmlspecialchars($r['jam_janji']) ?></strong>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="row">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row d-flex justify-content-between">
                      <div class="card-title">Jadwal Dokter dan Janjinya</div>
                      <a href="index.php?page=laporan-jadwal&tanggal=<?= $tanggal ?>"
                        class="btn btn-primary" target="_blank">
                        Cetak
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="index.php?page=dashboard" class="row g-3 mb-4">
                      <div class="col-auto">
                        <label class="col-form-label">Tanggal Praktek</label>
                      </div>
                      <div class="col-auto">
                        <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($tanggal); ?>" required>
                      </div>
                      <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                      </div>
                    </form>

                    <div class="table-responsive">
                      <table class="display table table-striped table-hover">
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
                          <?php if (empty($jadwal)): ?>
                            <tr>
                              <td colspan="5" class="text-center">
                                Tidak ada jadwal / janji temu pada tanggal ini.
                              </td>
                            </tr>
                          <?php else: ?>
                            <?php foreach ($jadwal as $row): ?>
                              <tr>
                                <td><?= htmlspecialchars($row['nama_dokter']); ?></td>
                                <td><?= htmlspecialchars($row['spesialisasi']); ?></td>
                                <td><?= htmlspecialchars($row['jam_mulai']); ?></td>
                                <td><?= htmlspecialchars($row['jam_selesai']); ?></td>
                                <td><?= htmlspecialchars($row['jumlah_janji']); ?></td>
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
            <div class="row">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row d-flex justify-content-between">
                      <div class="card-title">Daftar Janji Temu</div>
                      <a href="index.php?page=laporan-janji&status=<?= $status ?>"
                        class="btn btn-primary" target="_blank">
                        Cetak
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="index.php?page=dashboard" class="row g-3 mb-4">
                      <div class="col-auto">
                        <label class="col-form-label">Status Janji</label>
                      </div>

                      <div class="col-auto">
                        <select name="status" class="form-control">
                          <option value="" <?= ($filterStatus == '' ? 'selected' : '') ?>>Semua</option>
                          <option value="Menunggu" <?= ($filterStatus == 'Menunggu' ? 'selected' : '') ?>>Menunggu</option>
                          <option value="Selesai"  <?= ($filterStatus == 'Selesai' ? 'selected' : '') ?>>Selesai</option>
                        </select>
                      </div>

                      <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                      </div>
                    </form>
                    <div class="table-responsive">
                      <table class="display table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Spesialisasi Dokter</th>
                            <th>Tanggal Janji</th>
                            <th>Jam Janji</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (empty($daftarJanji)): ?>
                            <tr>
                              <td colspan="5" class="text-center">
                                Tidak ada janji temu.
                              </td>
                            </tr>
                          <?php else: ?>
                            <?php foreach ($daftarJanji as $row): ?>
                              <tr>
                                <td><?= htmlspecialchars($row['nama_pasien']); ?></td>
                                <td><?= htmlspecialchars($row['nama_dokter']); ?></td>
                                <td><?= htmlspecialchars($row['nama_spesialisasi']); ?></td>
                                <td><?= htmlspecialchars($row['tanggal_janji']); ?></td>
                                <td><?= htmlspecialchars($row['jam_janji']); ?></td>
                                <td><?= htmlspecialchars($row['status']); ?></td>
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
            <!-- Modal Antrian Dokter -->
            <div class="modal fade" id="modalAntrian" tabindex="-1">
              <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title fw-bold">Antrian Per Tanggal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">

                    <h6 class="fw-bold mt-2 mb-3">Hasil Antrian</h6>
                    <p>Antrian untuk tanggal: <?= $tanggalAntrianPerDokter ?></p>
                    <div class="table-responsive mb-4">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Nama Dokter</th>
                            <th>Nama Pasien</th>
                            <th>Jam Janji</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (empty($antrian)): ?>
                            <tr><td colspan="3" class="text-center">Tidak ada antrian.</td></tr>
                          <?php else: ?>
                            <?php foreach ($antrian as $a): ?>
                              <tr>
                                <td><?= htmlspecialchars($a['nama_dokter']); ?></td>
                                <td><?= htmlspecialchars($a['nama_pasien']); ?></td>
                                <td><?= htmlspecialchars($a['jam_janji']); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </tbody>
                      </table>
                    </div>

                    <h6 class="fw-bold mt-4 mb-2">EXPLAIN ANALYZE</h6>
                    <pre class="bg-dark text-light p-3 rounded" style="max-height:300px; overflow:auto;">
            <?= htmlspecialchars($explain_antrian); ?>
                    </pre>

                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  </div>

                </div>
              </div>
            </div>

</div>