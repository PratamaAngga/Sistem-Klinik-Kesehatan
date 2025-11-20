<div class="page-inner">
  <div class="page-header">
    <h3 class="fw-bold mb-3">Kelola Spesialisasi</h3>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title">Kelola Spesialisasi</h4>
          <button
            class="btn btn-primary btn-round"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahSpesialisasi">
            + Tambah Spesialisasi
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table
              id="basic-datatables"
              class="display table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Spesialisasi</th>
                  <th>Kode</th>
                  <th style="width: 120px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php if (!empty($dataSpesialisasi)): ?>
                  <?php foreach ($dataSpesialisasi as $row): ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= htmlspecialchars($row['nama_spesialisasi']); ?></td>
                      <td><?= htmlspecialchars($row['kode_spesialisasi']); ?></td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-warning btn-sm btn-edit-spesialisasi"
                          data-bs-toggle="modal"
                          data-bs-target="#modalEditSpesialisasi"
                          data-id="<?= $row['spesialisasi_id']; ?>"
                          data-nama="<?= htmlspecialchars($row['nama_spesialisasi']); ?>"
                          data-kode="<?= htmlspecialchars($row['kode_spesialisasi']); ?>"
                        >
                          <i class="fa fa-pen"></i>
                        </button>

                        <button
                          type="button"
                          class="btn btn-danger btn-sm btn-delete-spesialisasi"
                          data-bs-toggle="modal"
                          data-bs-target="#modalDeleteSpesialisasi"
                          data-id="<?= $row['spesialisasi_id']; ?>"
                          data-nama="<?= htmlspecialchars($row['nama_spesialisasi']); ?>"
                        >
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahSpesialisasi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="index.php?page=store-spesialisasi" method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Spesialisasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Spesialisasi</label>
          <input type="text" name="nama_spesialisasi" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Kode Spesialis</label>
          <input type="text" name="kode_spesialis" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEditSpesialisasi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="index.php?page=update-spesialisasi" method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Spesialisasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="spesialisasi_id" id="edit_spesialisasi_id">
        <div class="form-group">
          <label>Nama Spesialisasi</label>
          <input type="text" name="nama_spesialisasi" id="edit_nama_spesialisasi" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Kode Spesialis</label>
          <input type="text" name="kode_spesialis" id="edit_kode_spesialis" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL DELETE -->
<div class="modal fade" id="modalDeleteSpesialisasi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="index.php?page=delete-spesialisasi" method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Spesialisasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="spesialisasi_id" id="delete_spesialisasi_id">
        <p>Yakin ingin menghapus spesialisasi
          <strong id="delete_spesialisasi_nama"></strong> ?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>
