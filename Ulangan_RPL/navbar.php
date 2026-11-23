<?php
// Pastikan session login sudah dimulai di file utama sebelum navbar dipanggil.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sesuaikan 'role' dengan nama session yang digunakan pada proses login kamu.
$role = strtolower($_SESSION['role'] ?? '');
$namaUser = $_SESSION['nama'] ?? $_SESSION['email'] ?? 'Pengguna';

$isAdmin = ($role === 'admin');
$isSiswa = ($role === 'anggota');
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar-sipn { background: #f8f9fa; box-shadow: 0 2px 10px rgba(0,0,0,.06); }
    .navbar-sipn .navbar-brand { font-weight: 700; color: #174ea6; }
    .navbar-sipn .nav-link { border-radius: .5rem; margin: .15rem; }
    .navbar-sipn .nav-link:hover,
    .navbar-sipn .nav-link:focus { background: #e7efff; color: #174ea6; }
    .navbar-sipn .dropdown-menu { border: 0; box-shadow: 0 8px 24px rgba(0,0,0,.12); }
    @media (min-width: 992px) {
      .navbar-sipn .dropdown-menu { margin-top: .35rem; }
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-sipn px-3">
  <div class="container-fluid">
    <a class="navbar-brand me-4" href="#"></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#menuSIPN" aria-controls="menuSIPN"
            aria-expanded="false" aria-label="Buka navigasi">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menuSIPN">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       

        <?php if ($isAdmin): ?>
        <li class="nav-item">
          <a class="nav-link" href="daftar_user.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">User</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="daftar_user.php">Daftar User</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="form_tambah_user.php">Tambah User </a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Buku</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="daftar_buku.php">Daftar Buku</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="form_tambah_buku.php">Tambah Buku</a></li>
          </ul>
        </li>

        <?php endif; ?>

        <?php if ($isSiswa): ?>
        <li class="nav-item">
          <a class="nav-link" href="dashboard_anggota.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pinjam_buku.php">Pinjam Buku</a>
        </li>
        <?php endif; ?>

      </ul>

      <div class="d-flex align-items-center">
        <?php if ($role !== ''): ?>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="menuAkun" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
              <?= htmlspecialchars(ucfirst($namaUser), ENT_QUOTES, 'UTF-8') ?>
              (<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>)
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="menuAkun">
              <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

</body>
</html>
