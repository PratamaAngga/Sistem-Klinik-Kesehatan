<?php
// Views/kelola-dokter.php
?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Kelola Dokter</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <!-- HEADER CARD -->
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title">Data Dokter</h4>
                    <button 
                        class="btn btn-primary btn-round ms-auto"
                        data-bs-toggle="modal"
                        data-bs-target="#addDokterModal">
                        <i class="fa fa-plus"></i> Tambah Dokter
                    </button>
                </div>

                <!-- TABLE DOKTER -->
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
                                    <th>Spesialisasi</th>
                                    <th>Nomor STR</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (!empty($dataDokter)): ?>
                                    <?php $no = 1; foreach ($dataDokter as $dokter): ?>

                                        <?php
                                            $namaDokter     = $dokter['nama'] ?? '';
                                            $namaSpesialis  = $dokter['nama_spesialisasi'] ?? '';
                                            $noStr          = $dokter['no_str'] ?? '';
                                            $noTelp         = $dokter['no_telp'] ?? '';
                                            $dokterId       = $dokter['dokter_id'] ?? '';
                                            $spesialisasiId = $dokter['spesialisasi_id'] ?? '';
                                        ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($namaDokter); ?></td>
                                            <td><?= htmlspecialchars($namaSpesialis); ?></td>
                                            <td><?= htmlspecialchars($noStr); ?></td>
                                            <td><?= htmlspecialchars($noTelp); ?></td>
                                            <td>
                                                <!-- EDIT BUTTON -->
                                                <button 
                                                    class="btn btn-warning btn-edit-dokter"
                                                    data-id_dokter="<?= $dokterId; ?>"
                                                    data-nama="<?= htmlspecialchars($namaDokter); ?>"
                                                    data-spesialisasi="<?= $spesialisasiId; ?>"
                                                    data-no_str="<?= htmlspecialchars($noStr); ?>"
                                                    data-no_telp="<?= htmlspecialchars($noTelp); ?>"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editDokterModal">
                                                    <i class="fas fa-pen"></i>
                                                </button>

                                                <!-- DELETE BUTTON -->
                                                <button 
                                                    class="btn btn-danger btn-delete-dokter"
                                                    data-id_dokter="<?= $dokterId; ?>"
                                                    data-nama="<?= htmlspecialchars($namaDokter); ?>"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteDokterModal">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Belum ada data dokter.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>

            <!-- TOMBOL LAPORAN -->
            <div class="mt-3 d-flex justify-content-end">
                <a href="index.php?page=laporan-pendapatan-dokter" class="btn btn-outline-primary">
                    <i class="fas fa-chart-bar"></i> Lihat Laporan Pendapatan Dokter
                </a>
            </div>

        </div>
    </div>
</div>

<!-- ========================= -->
<!-- MODAL TAMBAH DOKTER       -->
<!-- ========================= -->
<div class="modal fade" id="addDokterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="index.php?page=store-dokter" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Dokter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Dokter</label>
          <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Nomor STR</label>
          <input type="text" name="no_str" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Nomor Telepon</label>
          <input type="text" name="no_telp" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Spesialisasi</label>
          <select name="spesialisasi_id" class="form-control" required>
            <option value="">-- Pilih Spesialisasi --</option>
            <?php foreach ($dataSpecialization as $sp): ?>
              <option value="<?= $sp['spesialisasi_id']; ?>">
                <?= htmlspecialchars($sp['nama_spesialisasi']); ?>
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

<!-- ========================= -->
<!-- MODAL EDIT DOKTER         -->
<!-- ========================= -->
<div class="modal fade" id="editDokterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="index.php?page=update-dokter" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Dokter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="dokter_id" id="edit_dokter_id">

        <div class="mb-3">
          <label>Nama Dokter</label>
          <input type="text" name="nama" id="edit_name_dokter" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Nomor STR</label>
          <input type="text" name="no_str" id="edit_no_str_dokter" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Nomor Telepon</label>
          <input type="text" name="no_telp" id="edit_no_telp_dokter" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Spesialisasi</label>
          <select name="spesialisasi_id" id="edit_spesialisasi_dokter" class="form-control" required>
            <option value="">-- Pilih Spesialisasi --</option>
            <?php foreach ($dataSpecialization as $sp): ?>
              <option value="<?= $sp['spesialisasi_id']; ?>">
                <?= htmlspecialchars($sp['nama_spesialisasi']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- ========================= -->
<!-- MODAL HAPUS DOKTER        -->
<!-- ========================= -->
<div class="modal fade" id="deleteDokterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="index.php?page=delete-dokter" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Dokter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="dokter_id" id="delete_dokter_id">
        <p>Apakah Anda yakin ingin menghapus dokter <strong id="delete_name_dokter"></strong>?</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>
