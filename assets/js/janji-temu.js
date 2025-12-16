// views/janji/janji-temu.js (or inline <script>)
document.addEventListener('DOMContentLoaded', function() {
  // init DataTables
  $('#table-janji').DataTable();

  // Bind edit modal prefill
  $(document).on('click', '.btn-edit-janji', function() {
    const id = $(this).data('id');
    $('#edit_janji_id').val(id);
    $('#edit_tanggal').val($(this).data('tanggal'));
    $('#edit_jam_janji').val($(this).data('jam'));
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
  const addBtn = document.getElementById('addObat');
    const container = document.getElementById('spec-container');

    // Template untuk clone (ROW PERTAMA DI MODAL)
    const template = container.querySelector('.spec-item');

    // Tambah baris obat
    addBtn.addEventListener('click', function () {
        let newField = template.cloneNode(true);

        // reset semua field dalam clone
        newField.querySelector('.obat-select').value = "";
        newField.querySelector('.jumlah-input').value = 1;
        newField.querySelector('.total-bayar-input').value = "";
        newField.querySelector('input[name="dosis[]"]').value = "";

        // tampilkan tombol remove
        newField.querySelector('.btn-remove-spec').style.display = "block";

        container.appendChild(newField);
    });

    // Remove baris obat
    container.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove-spec')) {
            // kalau cuma 1 row, jangan hapus, cukup reset
            if (container.querySelectorAll('.spec-item').length === 1) {
                template.querySelector('.obat-select').value = "";
                template.querySelector('.jumlah-input').value = 1;
                template.querySelector('.total-bayar-input').value = "";
                template.querySelector('input[name="dosis[]"]').value = "";
                return;
            }

            e.target.closest('.spec-item').remove();
        }
    });

    // Auto hitung total biaya
    container.addEventListener('input', function (e) {
        if (e.target.classList.contains('obat-select') ||
            e.target.classList.contains('jumlah-input')) {

            const row = e.target.closest('.spec-item');
            const selected = row.querySelector('.obat-select option:checked');

            const harga = parseFloat(selected.dataset.harga || 0);
            const jumlah = parseInt(row.querySelector('.jumlah-input').value || 0);

            const total = harga * jumlah;

            row.querySelector('.total-bayar-input').value =
                total > 0 ? total : "";
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

  const dokterSelect = document.getElementById('dokterSelect');
  const jadwalSelect = document.getElementById('jadwalSelect');
  jadwalSelect.disabled = true;

  dokterSelect.addEventListener('change', function () {
    const dokterId = this.value;
    jadwalSelect.disabled = !dokterId;
    jadwalSelect.value = '';

    Array.from(jadwalSelect.options).forEach(opt => {
      if (!opt.value) {
        opt.style.display = 'block';
        return;
      }

      opt.style.display = (opt.dataset.dokter === dokterId)
        ? 'block'
        : 'none';
    });
  });

  // optional: format total_bayar on blur (thousand separator) - but keep raw numeric when submit
});
