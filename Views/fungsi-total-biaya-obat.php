<div class="page-inner">
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-1">Function Scalar: Total Biaya Obat</h3>
      <p class="mb-0">
        Menampilkan hasil function <code>hitung_total_biaya_obat(<?= htmlspecialchars($rekam_id); ?>)</code>
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <form method="GET" action="index.php">
            <input type="hidden" name="page" value="fungsi-total-biaya-obat">
            <div class="mb-3">
              <label class="form-label">ID Rekam Medis</label>
              <input type="number" name="rekam_id" class="form-control" value="<?= htmlspecialchars($rekam_id); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Hitung</button>
          </form>

          <hr>

          <h5>Hasil:</h5>
          <p>
            Total biaya obat untuk rekam_id <strong><?= htmlspecialchars($rekam_id); ?></strong><br>
            <span class="fs-4 fw-bold">
              Rp <?= number_format($total_biaya_obat, 0, ',', '.'); ?>
            </span>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
