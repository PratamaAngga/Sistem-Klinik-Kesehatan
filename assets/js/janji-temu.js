// views/janji/janji-temu.js (or inline <script>)
document.addEventListener('DOMContentLoaded', function() {
  // init DataTables
  $('#table-janji').DataTable();

  // Bind edit modal prefill
  $(document).on('click', '.btn-edit-janji', function() {
    const id = $(this).data('id');
    $('#edit_janji_id').val(id);
    $('#edit_tanggal').val($(this).data('tanggal'));
    $('#edit_jam').val($(this).data('jam'));
  });

  // Bind delete modal
  $(document).on('click', '.btn-delete-janji', function() {
    const id = $(this).data('id');
    const nama = $(this).data('nama');
    $('#delete_janji_id').val(id);
    $('#delete_janji_name').text(nama);
  });

  // Bind akhiri modal: prefill hidden fields
  $(document).on('click', '.btn-akhiri-janji', function() {
    $('#akhiri_janji_id').val($(this).data('id'));
    $('#akhiri_pasien_id').val($(this).data('pasien_id'));
    $('#akhiri_dokter_id').val($(this).data('dokter_id'));
    // reset form fields
    $('#formAkhiriJanji')[0].reset();
    // ensure there's at least 1 row; remove extras then re-add default
    $('#containerObatRows').empty();
    addObatRow(); // function declared below
  });

  // Add / remove obat rows
  function addObatRow() {
    // clone template from the first default structure (build via JS)
    const row = `
      <div class="obat-row row g-2 align-items-end mb-2">
        <div class="col-md-4">
          <label>Obat</label>
          <select name="obat_id[]" class="form-select obat-select" required>
            <option value="">Pilih Obat</option>
            <?php foreach($data['obatList'] as $ob): ?>
              <option value="<?= $ob['obat_id'] ?>" data-harga="<?= $ob['harga_satuan'] ?>" data-stok="<?= $ob['stok'] ?>">
                <?= addslashes($ob['nama_obat']) ?> (<?= addslashes($ob['jenis_obat']) ?>)
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
    `;
    $('#containerObatRows').append(row);
  }

  // initial row when page loads
  if ($('#containerObatRows .obat-row').length === 0) {
    addObatRow();
  }

  // click handler tambah
  $('#tambahBarisObat').on('click', function() { addObatRow(); });

  // delegate hapus row
  $(document).on('click', '.btn-hapus-row', function() {
    // jika tinggal 1 row, jangan dihapus (atau bisa pilih untuk allow)
    if ($('#containerObatRows .obat-row').length > 1) {
      $(this).closest('.obat-row').remove();
    } else {
      // kosongkan isian jika cuma 1 row
      $(this).closest('.obat-row').find('select').val('');
      $(this).closest('.obat-row').find('input').val('');
    }
  });

  // auto-fill total_biaya berdasarkan obat selected * jumlah (opsional)
  $(document).on('change', '.obat-select, .jumlah-input', function() {
    const row = $(this).closest('.obat-row');
    const selected = row.find('.obat-select option:selected');
    const harga = parseFloat(selected.data('harga') || 0);
    const jumlah = parseInt(row.find('.jumlah-input').val() || 0);
    const total = harga * jumlah;
    row.find('.total-bayar-input').val(total ? total : '');
  });

  // optional: format total_bayar on blur (thousand separator) - but keep raw numeric when submit
});
