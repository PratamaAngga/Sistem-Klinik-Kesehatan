<div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Kelola Jadwal Praktek Dokter</h4>
                      <button class="btn btn-primary btn-round ms-auto"
                              data-bs-toggle="modal"
                              data-bs-target="#addRowModal">
                        <i class="fa fa-plus"></i> Tambah Jadwal
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Tanggal Praktek</th>
                            <th>Dokter</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>Tanggal Praktek</th>
                            <th>Dokter</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        <?php $no = 1; foreach ($dataJadwal['dataJadwal'] as $jadwal): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $jadwal['tanggal_praktek']; ?></td>
                                <td><?= $jadwal['nama']; ?></td>
                                <td><?= $jadwal['jam_mulai']; ?></td>
                                <td><?= $jadwal['jam_selesai']; ?></td>
                                <td class="d-flex justify-content-around">
                                    <button 
                                        class="btn btn-warning btn-edit btn-edit-jadwal"
                                        data-id_jadwal="<?= $jadwal['jadwal_id']; ?>"
                                        data-tanggal="<?= $jadwal['tanggal_praktek']; ?>"
                                        data-dokter="<?= $jadwal['dokter_id']; ?>"
                                        data-jam_mulai="<?= $jadwal['jam_mulai']; ?>"
                                        data-jam_selesai="<?= $jadwal['jam_selesai']; ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editJadwalModal"
                                    >
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button 
                                        class="btn btn-danger btn-delete btn-delete-jadwal"
                                        data-id_jadwal="<?= $jadwal['jadwal_id']; ?>"
                                        data-tanggal="<?= $jadwal['tanggal_praktek']; ?>"
                                        data-dokter="<?= $jadwal['nama']; ?>"
                                        data-jam_mulai="<?= $jadwal['jam_mulai']; ?>"
                                        data-jam_selesai="<?= $jadwal['jam_selesai']; ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteJadwalModal"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                      <!-- MODAL TAMBAH JADWAL -->
                      <div class="modal fade" id="addRowModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold">Tambah Jadwal Praktek</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=store-jadwal" method="POST">
                              <div class="modal-body">

                                <div class="mb-3">
                                  <label class="form-label">Pilih Tanggal</label>
                                  <input type="date" name="tanggal_praktek" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Dokter</label>
                                  <select name="dokter_id" class="form-control" required>
                                        <option value="">Pilih Dokter</option>
                                        <?php foreach ($dataJadwal['dataDokter'] as $dokter): ?>
                                            <option value="<?= $dokter['dokter_id'] ?>">
                                                <?= $dokter['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                  </select>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Jam Mulai</label>
                                  <input type="text" id="jam_mulai" name="jam_mulai" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Jam Selesai</label>
                                  <input type="text" id="jam_selesai" name="jam_selesai" class="form-control" required>
                                </div>
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>

                            </form>

                          </div>
                        </div>
                      </div>

                      <!-- MODAL EDIT JADWAL -->
                      <div class="modal fade" id="editJadwalModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold">Edit Jadwal Praktek</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=update-jadwal" method="POST">
                              <input type="hidden" name="jadwal_id" id="edit_jadwal_id">

                              <div class="modal-body">

                                <div class="mb-3">
                                  <label class="form-label">Pilih Tanggal</label>
                                  <input type="date" id="edit_tanggal_praktek" name="tanggal_praktek" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Dokter</label>
                                  <select name="dokter_id" id="edit_dokter" class="form-control" required>
                                        <option value="">Pilih Dokter</option>
                                        <?php foreach ($dataJadwal['dataDokter'] as $dokter): ?>
                                            <option value="<?= $dokter['dokter_id'] ?>">
                                                <?= $dokter['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                  </select>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Jam Mulai</label>
                                  <input type="text" id="edit_jam_mulai" name="jam_mulai" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Jam Selesai</label>
                                  <input type="text" id="edit_jam_selesai" name="jam_selesai" class="form-control" required>
                                </div>
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                              </div>

                            </form>

                          </div>
                        </div>
                      </div>

                      <!-- MODAL DELETE JADWAL -->
                      <div class="modal fade" id="deleteJadwalModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold text-danger">Hapus Jadwal Praktek</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=delete-jadwal" method="POST">
                              <input type="hidden" name="jadwal_id" id="delete_jadwal_id">

                              <div class="modal-body">
                                <p class="mb-0 fs-6">
                                  Apa kamu yakin ingin menghapus jadwal ini?
                                </p>
                                <p class="text-danger fw-bold mt-1" id="delete_tanggal_praktek"></p>
                                <p class="text-danger fw-bold mt-1" id="delete_dokter"></p>
                                <p class="text-danger fw-bold mt-1" id="delete_jam"></p>
                                <small class="text-muted">Data yang sudah dihapus tidak bisa dikembalikan.</small>
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                  Batal
                                </button>
                                <button type="submit" class="btn btn-danger">
                                  Hapus
                                </button>
                              </div>
                            </form>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>