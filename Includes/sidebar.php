<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="index.html" class="logo">
        <img
          src="assets/img/kaiadmin/Logo.png"
          alt="navbar brand"
          class="navbar-brand"
          height="50"
        />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-primary">
        <li class="nav-item <?= $page == 'dashboard' ? 'active' : '' ?>">
          <a href="index.php?page=dashboard">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item <?= $page == 'kelola-obat' ? 'active' : '' ?>">
          <a href="index.php?page=kelola-obat">
            <i class="fas fa-mortar-pestle"></i>
            <p>Kelola Obat</p>
          </a>
        </li>
        <li class="nav-item <?= $page == 'kelola-pasien' ? 'active' : '' ?>">
          <a href="index.php?page=kelola-pasien">
            <i class="fas fa-notes-medical"></i>
            <p>Kelola Pasien</p>
          </a>
        </li>
        <li class="nav-item <?= $page == 'kelola-spesialisasi' ? 'active' : '' ?>">
          <a href="index.php?page=kelola-spesialisasi">
            <i class="fas fa-medkit"></i>
            <p>Kelola Spesialisasi</p>
          </a>
        </li>
        <li class="nav-item <?= $page == 'kelola-dokter' ? 'active' : '' ?>">
          <a href="index.php?page=kelola-dokter">
            <i class="fas fa-user-md"></i>
            <p>Kelola Dokter</p>
          </a>
        </li>
        <li class="nav-item <?= $page == 'kelola-jadwal' ? 'active' : '' ?>">
          <a href="index.php?page=kelola-jadwal">
            <i class="fas fa-clipboard-list"></i>
            <p>Kelola Jadwal Praktek</p>
          </a>
        </li>
        <li class="nav-item <?= $page == 'janji-temu' ? 'active' : '' ?>">
          <a href="index.php?page=janji-temu">
            <i class="fas fa-clipboard-list"></i>
            <p>Janji Temu</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
