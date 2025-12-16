<div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Kelola Pasien</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Kelola Pasien</h4>
                      <button class="btn btn-primary btn-round ms-auto"
                              data-bs-toggle="modal"
                              data-bs-target="#addRowModal">
                        <i class="fa fa-plus"></i> Tambah Pasien
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
                            <th>Nama Pasien</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis kelamin</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis kelamin</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($dataPasien as $pasien): ?>
                            <tr>
                                <td><?= $pasien['pasien_id']; ?></td>
                                <td><?= $pasien['nama']; ?></td>
                                <td><?= $pasien['tanggal_lahir']; ?></td>
                                <td><?= $pasien['jenis_kelamin']; ?></td>
                                <td><?= $pasien['no_telp']; ?></td>
                                <td><?= $pasien['alamat']; ?></td>
                                <td class="d-flex justify-content-around">
                                    
                                    <?php if ($pasien['jumlah_rekam_medis'] > 0): ?>
                                        <a 
                                            href="index.php?page=rekam-medis&pasien_id=<?= $pasien['pasien_id']; ?>" 
                                            class="btn btn-info btn-rekam-medis"
                                            title="Lihat Rekam Medis (<?= $pasien['jumlah_rekam_medis']; ?> data)">
                                            <i class="fas fa-signature"></i> <a href="index.php?page=rekam-medis&pasien_id=1" ></a>
                                    <?php else: ?>
                                        <a 
                                            href="index.php?page=rekam-medis&pasien_id=<?= $pasien['pasien_id']; ?>" 
                                            class="btn btn-info btn-rekam-medis"
                                            title="Tambahkan Rekam Medis Baru">
                                            <i class="fas fa-signature"></i> <a href="index.php?page=rekam-medis&pasien_id=1" ></a>
                                    <?php endif; ?>
                                    <button 
                                        class="btn btn-warning btn-edit"
                                        data-id="<?= $pasien['pasien_id']; ?>"
                                        data-nama_pasien="<?= $pasien['nama']; ?>"
                                        data-tanggal_lahir="<?= $pasien['tanggal_lahir']; ?>"
                                        data-jenis_kelamin="<?= $pasien['jenis_kelamin']; ?>"
                                        data-no_telp="<?= $pasien['no_telp']; ?>"
                                        data-alamat="<?= $pasien['alamat']; ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editPasienModal"
                                    >
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button 
                                        class="btn btn-danger btn-delete"
                                        data-id="<?= $pasien['pasien_id']; ?>"
                                        data-nama_pasiem="<?= $pasien['nama']; ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deletePasienModal"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                      <!-- MODAL TAMBAH Pasien -->
                      <div class="modal fade" id="addRowModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold">Tambah Pasien</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=store-pasien" method="POST">
                              <div class="modal-body">

                                <div class="mb-3">
                                  <label class="form-label">Nama Pasien</label>
                                  <input type="text" name="nama" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Tanggal Lahir</label>
                                  <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Jenis Kelamin</label>
                                  <select name="jenis_kelamin" class="form-select" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="L">L</option>
                                    <option value="P">P</option>
                                  </select>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Nomor Telepon</label>
                                  <input type="int" name="no_telp" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Alamat</label>
                                  <input type="text" name="alamat" class="form-control" required>
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

                      <!-- MODAL EDIT Pasien -->
                      <div class="modal fade" id="editPasienModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold">Edit Pasien</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=update-pasien" method="POST">
                              <input type="hidden" name="pasien_id" id="edit_pasien_id">

                              <div class="modal-body">

                                <div class="mb-3">
                                  <label class="form-label">Nama Pasien</label>
                                  <input type="text" name="nama" id="edit_nama" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Tanggal Lahir</label>
                                  <input type="date" name="tanggal_lahir" id="edit_tanggal_lahir" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Jenis Kelamin</label>
                                  <select name="jenis_kelamin" id="edit_jenis_kelamin" class="form-select" required>
                                    <option value="L">L</option>
                                    <option value="P">P</option>
                                  </select>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Nomor Telepon</label>
                                  <input type="int" name="no_telp" id="edit_no_telp" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Alamat</label>
                                  <input type="text" name="alamat" class="form-control" required>
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

                      <!-- MODAL DELETE Pasien -->
                      <div class="modal fade" id="deletePasienModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold text-danger">Hapus Pasien</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=delete-pasien" method="POST">
                              <input type="hidden" name="pasien_id" id="delete_pasien_id">

                              <div class="modal-body">
                                <p class="mb-0 fs-6">
                                  Apa kamu yakin ingin menghapus pasien ini?
                                </p>
                                <p class="text-danger fw-bold mt-1" id="delete_pasien_nama"></p>
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