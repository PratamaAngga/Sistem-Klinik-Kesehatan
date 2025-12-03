<div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Selamat Datang di Sistem Informasi Klinik Kesehatan</h6>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Jadwal Dokter dan Janjinya</div>
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
                    <div class="card-head-row">
                      <div class="card-title">Daftar Janji Temu</div>
                    </div>
                  </div>
                  <div class="card-body">
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
</div>