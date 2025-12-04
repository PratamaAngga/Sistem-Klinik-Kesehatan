<?php
// Views/kelola-dokter.php
?>
<div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Kelola Dokter</h4>
                      <button class="btn btn-primary btn-round ms-auto"
                              data-bs-toggle="modal"
                              data-bs-target="#addRowModal">
                        <i class="fa fa-plus"></i> Tambah Dokter
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
                            <th>Nama Dokter</th>
                            <th>No STR</th>
                            <th>No Telp</th>
                            <th>Spesialisasi</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>No STR</th>
                            <th>No Telp</th>
                            <th>Spesialisasi</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        <?php $no = 1; foreach ($dataDokter['dataDokter'] as $dokter): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $dokter['nama']; ?></td>
                                <td><?= $dokter['no_str']; ?></td>
                                <td><?= $dokter['no_telp']; ?></td>
                                <td><?= $dokter['nama_spesialisasi']; ?></td>
                                <td class="d-flex justify-content-around">
                                    <button 
                                        class="btn btn-warning btn-edit btn-edit-dokter"
                                        data-id_dokter="<?= $dokter['dokter_id']; ?>"
                                        data-nama="<?= $dokter['nama']; ?>"
                                        data-no_str="<?= $dokter['no_str']; ?>"
                                        data-no_telp="<?= $dokter['no_telp']; ?>"
                                        data-spesialisasi="<?= $dokter['spesialisasi_id']; ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editDokterModal"
                                    >
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button 
                                        class="btn btn-danger btn-delete btn-delete-dokter"
                                        data-id_dokter="<?= $dokter['dokter_id']; ?>"
                                        data-nama="<?= $dokter['nama']; ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteDokterModal"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                      <!-- MODAL TAMBAH DOKTER -->
                      <div class="modal fade" id="addRowModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold">Tambah Dokter</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=store-dokter" method="POST">
                              <div class="modal-body">

                                <div class="mb-3">
                                  <label class="form-label">Nama Dokter</label>
                                  <input type="text" name="nama" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">No STR (Surat Tanda Registrasi)</label>
                                  <input type="text" name="no_str" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Nomor Telepon</label>
                                  <input type="text" name="no_telp" class="form-control" required>
                                </div>
                                <!-- SPESIALISASI -->
                                 <div class="mb-3">
                                   <label class="form-label">Spesialisasi</label>
                                    <select name="spesialisasi_id" class="form-control" required>
                                        <option value="">Pilih Spesialisasi</option>
                                        <?php foreach ($dataDokter['dataSpecialization'] as $spec): ?>
                                            <option value="<?= $spec['spesialisasi_id'] ?>">
                                                <?= $spec['nama_spesialisasi'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
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

                      <!-- MODAL EDIT DOKTER -->
                      <div class="modal fade" id="editDokterModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold">Edit Dokter</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=update-dokter" method="POST">
                              <input type="hidden" name="dokter_id" id="edit_dokter_id">

                              <div class="modal-body">

                                <div class="mb-3">
                                  <label class="form-label">Nama Dokter</label>
                                  <input type="text" name="nama" id="edit_name_dokter" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label">No STR</label>
                                  <input type="text" name="no_str" id="edit_no_str_dokter" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label">No Telepon</label>
                                  <input type="text" name="no_telp" id="edit_no_telp_dokter" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Spesialisasi</label>
                                    <select name="spesialisasi_id" id="edit_spesialisasi_dokter" class="form-select" required>
                                        <option value="">Pilih Spesialisasi</option>
                                        <?php foreach ($dataDokter['dataSpecialization'] as $spec): ?>
                                            <option value="<?= $spec['spesialisasi_id'] ?>">
                                                <?= $spec['nama_spesialisasi'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
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

                      <!-- MODAL DELETE DOKTER -->
                      <div class="modal fade" id="deleteDokterModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title fw-bold text-danger">Hapus Dokter</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="index.php?page=delete-dokter" method="POST">
                              <input type="hidden" name="dokter_id" id="delete_dokter_id">

                              <div class="modal-body">
                                <p class="mb-0 fs-6">
                                  Apa kamu yakin ingin menghapus dokter ini?
                                </p>
                                <p class="text-danger fw-bold mt-1" id="delete_name_dokter"></p>
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
                <div class="mt-3 d-flex justify-content-end">
                    <a href="index.php?page=laporan-pendapatan-dokter" class="btn btn-outline-primary">
                        <i class="fas fa-chart-bar"></i> Lihat Laporan Pendapatan Dokter
                    </a>
                </div>
              </div>
            </div>
      </div>
