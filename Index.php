<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem</title>
  <link rel="stylesheet" href="Assets/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  
  <div class="d-flex">
    <!-- Sidebar tetap -->
    <?php include 'Includes/sidebar.php'; ?>
    
    <!-- Area Konten -->
    <div class="content flex-grow-1" id="content-area">
      <!-- Header -->
      <?php include 'Includes/header.php'; ?>
      <?php include 'views/dashboard.php'; // halaman default ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <script>
    // Script untuk load konten dinamis
    $(document).ready(function() {
      // Saat klik menu di sidebar
      $('.sidebar a').on('click', function(e) {
        e.preventDefault();

        let url = $(this).attr('href');
        let pageName = url.split('/').pop(); // ambil nama file misal "dashboard.php"

        // Load konten tanpa reload halaman
        $('#content-area').load('views/' + pageName);

        // Update active menu
        $('.sidebar a').removeClass('active');
        $(this).addClass('active');
      });
    });
  </script>

</body>
</html>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CMS</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="" alt="">
            </div>
            <div class="menu">
                <ul>
                    <li><a href="views/dashboard.php">Dashboard</a></li>
                    <li><a href="views/manage-member.php">Kelola Member Lab</a></li>
                    <li><a href="views/manage-product.php">Kelola Produk</a></li>
                    <button class="drupdown">Hasil Karya Ilmiah</button>
                    <div class="dropdown-container">
                        <li><a href="views/publikasi.php">Publikasi</a></li>
                        <li><a href="views/riset.php">Riset</a></li>
                        <li><a href="views/kekayaan-intelektual.php">Kekayaan Intelektual</a></li>
                        <li><a href="views/ppm.php">PPM</a></li>
                    </div>
                    <li><a href="views/manage-facility.php">Kelola Fasilitas</a></li>
                    <li><a href="views/manage-specialization.php">Kelola Spesialisasi</a></li>
                </ul>
            </div>
        </div>
        
    </div>
</body>
</html> -->