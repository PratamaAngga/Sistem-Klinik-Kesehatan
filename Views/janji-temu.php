<?php
// views/janji/janji-temu.php
// $data['janji'] contains rows
// $data['obatList'] contains obat untuk dropdown
?>
<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Kelola Janji Temu</h4>
            <button class="btn btn-primary ms-auto"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahJanji">
                <i class="fa fa-plus"></i> Tambah Janji Temu
            </button>
          </div>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="table-janji" class="display table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Janji</th>
                  <th>Nama Pasien</th>
                  <th>Nama Dokter</th>
                  <th>Jam</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach($data['janji'] as $row): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_janji'])); ?></td>
                    <td><?= htmlspecialchars($row['nama_pasien']); ?></td>
                    <td><?= htmlspecialchars($row['nama_dokter']); ?></td>
                    <td><?= htmlspecialchars($row['jam_janji']); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                    <td class="d-flex justify-content-around">
                      <!-- Edit -->
                      <button class="btn btn-warning btn-sm btn-edit-janji"
                              data-id="<?= $row['janji_id']; ?>"
                              data-tanggal="<?= $row['tanggal_janji']; ?>"
                              data-jam="<?= $row['jam_janji']; ?>"
                              data-pasien="<?= $row['pasien_id']; ?>"
                              data-dokter="<?= $row['dokter_id']; ?>"
                              data-status="<?= $row['status']; ?>"
                              data-bs-toggle="modal"
                              data-bs-target="#editJanjiModal"
                              <?= $row['status'] === 'Selesai' ? 'disabled' : '' ?>>
                        <i class="fas fa-edit"></i>
                      </button>

                      <!-- Delete -->
                      <button class="btn btn-danger btn-sm btn-delete-janji"
                              data-id="<?= $row['janji_id']; ?>"
                              data-nama="<?= htmlspecialchars($row['nama_pasien']); ?>"
                              data-bs-toggle="modal" data-bs-target="#deleteJanjiModal"
                              <?= $row['status'] === 'Selesai' ? 'disabled' : '' ?>>
                        <i class="fas fa-trash-alt"></i>
                      </button>

                      <!-- Akhiri -->
                      <button class="btn btn-success btn-sm btn-akhiri-janji"
                              data-id="<?= $row['janji_id']; ?>"
                              data-pasien_id="<?= $row['pasien_id']; ?>"
                              data-dokter_id="<?= $row['dokter_id']; ?>"
                              data-tanggal="<?= $row['tanggal_janji']; ?>"
                              data-jam="<?= $row['jam_janji']; ?>"
                              data-nama_pasien="<?= htmlspecialchars($row['nama_pasien']); ?>"
                              data-nama_dokter="<?= htmlspecialchars($row['nama_dokter']); ?>"
                              data-bs-toggle="modal"
                              data-bs-target="#akhiriJanjiModal"
                              <?= $row['status'] === 'Selesai' ? 'disabled' : '' ?>>
                        <i class="fas fa-check"></i>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Tanggal Janji</th>
                  <th>Nama Pasien</th>
                  <th>Nama Dokter</th>
                  <th>Jam</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahJanji" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Janji Temu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="index.php?page=store-janji" method="POST">
        <div class="modal-body">

          <!-- Pasien -->
          <div class="mb-3">
            <label class="form-label">Pasien</label>
            <select name="pasien_id" class="form-select" required>
              <option value="">-- Pilih Pasien --</option>
              <?php foreach ($pasien as $p): ?>
                <option value="<?= $p['pasien_id']; ?>">
                  <?= $p['nama']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Dokter -->
          <div class="mb-3">
            <label class="form-label">Dokter</label>
            <select name="dokter_id" class="form-select" required>
              <option value="">-- Pilih Dokter --</option>
              <?php foreach ($dokter as $d): ?>
                <option value="<?= $d['dokter_id']; ?>">
                  <?= $d['nama']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Jadwal Dokter -->
          <div class="mb-3">
            <label class="form-label">Jadwal Dokter</label>
            <select name="jadwal_id" class="form-select" required>
              <option value="">-- Pilih Jadwal --</option>
              <?php foreach ($jadwal as $j): ?>
                <option value="<?= $j['jadwal_id']; ?>">
                  <?= $j['hari'] . ' (' . $j['jam_mulai'] . ' - ' . $j['jam_selesai'] . ')'; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Tanggal -->
          <div class="mb-3">
            <label class="form-label">Tanggal Janji</label>
            <input type="date" name="tanggal" class="form-control" required>
          </div>

          <!-- Jam -->
          <div class="mb-3">
            <label class="form-label">Jam Janji</label>
            <input type="time" name="jam" class="form-control" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- MODAL EDIT JANJI (sederhana) -->
<div class="modal fade" id="editJanjiModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="index.php?page=update-janji" method="POST">
        <input type="hidden" name="janji_id" id="edit_janji_id">
        <div class="modal-header">
          <h5 class="modal-title">Edit Janji</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal_janji" id="edit_tanggal" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Jam</label>
            <input type="time" name="jam_janji" id="edit_jam" class="form-control" required>
          </div>
          <!-- kalau perlu pasien/dokter bisa diubah -->
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL DELETE -->
<div class="modal fade" id="deleteJanjiModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="index.php?page=delete-janji" method="POST">
        <input type="hidden" name="janji_id" id="delete_janji_id">
        <div class="modal-header">
          <h5 class="modal-title text-danger">Hapus Janji</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus janji untuk <strong id="delete_janji_name"></strong> ?</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
          <button class="btn btn-danger" type="submit">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL AKHIRI JANJI (modal sederhana dengan dynamic obat rows) -->
<div class="modal fade" id="akhiriJanjiModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <form action="index.php?page=akhiri-janji" method="POST" id="formAkhiriJanji">
        <input type="hidden" name="janji_id" id="akhiri_janji_id">
        <input type="hidden" name="pasien_id" id="akhiri_pasien_id">
        <input type="hidden" name="dokter_id" id="akhiri_dokter_id">

        <div class="modal-header">
          <h5 class="modal-title">Akhiri / Proses Janji</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <!-- Rekam Medis -->
          <div class="mb-3">
            <label>Diagnosis</label>
            <textarea name="diagnosis" class="form-control" required></textarea>
          </div>
          <div class="mb-3">
            <label>Tindakan</label>
            <textarea name="tindakan" class="form-control" required></textarea>
          </div>
          <div class="mb-3">
            <label>Tanggal Periksa</label>
            <input type="date" name="tanggal_periksa" id="tanggal_periksa" class="form-control" value="<?=date('Y-m-d')?>" required>
          </div>

          <hr>

          <!-- Obat dynamic rows -->
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h6>Resep Obat</h6>
            <button type="button" class="btn btn-sm btn-outline-primary" id="tambahBarisObat">Tambah Obat</button>
          </div>

          <div id="containerObatRows">
            <!-- default 1 row -->
            <div class="obat-row row g-2 align-items-end mb-2">
              <div class="col-md-4">
                <label>Obat</label>
                <select name="obat_id[]" class="form-select obat-select" required>
                  <option value="">Pilih Obat</option>
                  <?php foreach($data['obatList'] as $ob): ?>
                    <option value="<?= $ob['obat_id'] ?>" data-harga="<?= $ob['harga_satuan'] ?>" data-stok="<?= $ob['stok'] ?>">
                      <?= htmlspecialchars($ob['nama_obat']) ?> (<?= htmlspecialchars($ob['jenis_obat']) ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-2">
                <label>Jumlah</label>
                <input type="number" name="jumlah[]" min="1" value="1" class="form-control jumlah-input" required>
              </div>
              <div class="col-md-2">
                <label>Dosis</label>
                <input type="text" name="dosis[]" class="form-control" placeholder="mis: 3x1" required>
              </div>
              <div class="col-md-3">
                <label>Total Biaya</label>
                <input type="text" name="total_biaya[]" class="form-control total-bayar-input" placeholder="0" required>
              </div>
              <div class="col-md-1 text-end">
                <button type="button" class="btn btn-outline-danger btn-sm btn-hapus-row" title="Hapus baris">×</button>
              </div>
            </div>
          </div>
          <!-- end container obat -->
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
          <button class="btn btn-success" type="submit">Simpan & Akhiri Janji</button>
        </div>
      </form>
    </div>
  </div>
</div>
