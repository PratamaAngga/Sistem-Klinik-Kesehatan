<div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Kelola Obat</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Kelola Obat</h4>
                      <button class="btn btn-primary btn-round ms-auto"
                              data-bs-toggle="modal"
                              data-bs-target="#addRowModal">
                        <i class="fa fa-plus"></i> Tambah Obat
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
                            <th>Nama Obat</th>
                            <th>Jenis</th>
                            <th>Stok</th>
                            <th>Harga Satuan</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Jenis</th>
                            <th>Stok</th>
                            <th>Harga Satuan</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($dataObat as $obat): ?>
                            <tr>
                                <td><?= $obat['obat_id']; ?></td>
                                <td><?= $obat['nama_obat']; ?></td>
                                <td><?= $obat['jenis_obat']; ?></td>
                                <td><?= $obat['stok']; ?></td>
                                <td><?= number_format($obat['harga_satuan'], 0, ',', '.'); ?></td>
                                <td class="d-flex justify-content-around">
                                    <button 
                                        class="btn btn-warning btn-edit"
                                        data-id="<?= $obat['obat_id']; ?>"
                                        data-nama="<?= $obat['nama_obat']; ?>"
                                        data-jenis="<?= $obat['jenis_obat']; ?>"
                                        data-stok="<?= $obat['stok']; ?>"
                                        data-harga="<?= $obat['harga_satuan']; ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editObatModal"
                                    >
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button 
                                        class="btn btn-danger btn-delete"
                                        data-id="<?= $obat['obat_id']; ?>"
                                        data-nama="<?= $obat['nama_obat']; ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteObatModal"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                      <!-- MODAL TAMBAH OBAT -->
                      <div class="modal fade" id="addRowModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold">Tambah Obat</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=store-obat" method="POST">
                              <div class="modal-body">

                                <div class="mb-3">
                                  <label class="form-label">Nama Obat</label>
                                  <input type="text" name="nama_obat" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Jenis Obat</label>
                                  <select name="jenis" class="form-select" required>
                                    <option value="" disabled selected>Pilih jenis obat</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Kapsul">Kapsul</option>
                                    <option value="Cair">Cair</option>
                                  </select>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Stok</label>
                                  <input type="number" name="stok" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Harga Satuan</label>
                                  <input type="number" name="harga_satuan" class="form-control" required>
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

                      <!-- MODAL EDIT OBAT -->
                      <div class="modal fade" id="editObatModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold">Edit Obat</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=update-obat" method="POST">
                              <input type="hidden" name="obat_id" id="edit_obat_id">

                              <div class="modal-body">

                                <div class="mb-3">
                                  <label class="form-label">Nama Obat</label>
                                  <input type="text" name="nama_obat" id="edit_nama" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Jenis Obat</label>
                                  <select name="jenis" id="edit_jenis" class="form-select" required>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Kapsul">Kapsul</option>
                                    <option value="Cair">Cair</option>
                                  </select>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Stok</label>
                                  <input type="number" name="stok" id="edit_stok" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Harga Satuan</label>
                                  <input type="number" name="harga_satuan" id="edit_harga" class="form-control" required>
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

                      <!-- MODAL DELETE OBAT -->
                      <div class="modal fade" id="deleteObatModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold text-danger">Hapus Obat</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=delete-obat" method="POST">
                              <input type="hidden" name="obat_id" id="delete_obat_id">

                              <div class="modal-body">
                                <p class="mb-0 fs-6">
                                  Apa kamu yakin ingin menghapus obat ini?
                                </p>
                                <p class="text-danger fw-bold mt-1" id="delete_obat_nama"></p>
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