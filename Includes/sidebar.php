<div class="sidebar bg-sidebar" style="min-height:100vh; width:250px;">
  <div class="logo text-center" style="border: none;">
      <img src="assets/dark-transparent-bg.png" alt="logo" class="img-fluid logo-img">
  </div>
  <ul class="nav flex-column">
    <li class="nav-item">
      <a href="views/dashboard.php" class="nav-link active">Dashboard</a>
    </li>
    <li class="nav-item">
      <a href="views/manage-member.php" class="nav-link">Kelola Member</a>
    </li>
    <li class="nav-item">
      <a href="views/manage-product.php" class="nav-link">Kelola Produk</a>
    </li>
    <li class="nav-item">
      <button class="nav-link dropdown-toggle w-100 text-start" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#hasilKarya" 
            aria-expanded="false" 
            aria-controls="hasilKarya">
        Hasil Karya Ilmiah
    </button>
      <div class="collapse ms-3" id="hasilKarya">
        <a href="views/publikasi.php" class="nav-link">Publikasi</a>
        <a href="views/riset.php" class="nav-link">Riset</a>
        <a href="views/kekayaan-intelektual.php" class="nav-link">Kekayaan Intelektual</a>
        <a href="views/ppm.php" class="nav-link">PPM</a>
      </div>
    </li>
    <li class="nav-item">
      <a href="views/manage-facility.php" class="nav-link">Kelola Fasilitas</a>
    </li>
    <li class="nav-item">
      <a href="views/manage-specialization.php" class="nav-link">Kelola Spesialisasi</a>
    </li>
  </ul>
</div>
