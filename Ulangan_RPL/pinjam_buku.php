
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'anggota') {
    header("Location: form_login.php");
    exit();
}

$sql = "
    SELECT
        pinjam.*,
        buku.judul,
        users.nama,
        users.kelas
    FROM pinjam
    JOIN buku ON pinjam.id_buku = buku.id_buku
    JOIN users ON pinjam.id_user = users.id_user
    ORDER BY pinjam.id_pinjam DESC
";

$query = mysqli_query($koneksi, $sql);

require_once 'navbar.php';

?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<main class="container py-5">
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h2 class="h4 mb-1">Daftar Peminjaman Buku</h2>
                    <p class="text-secondary mb-0">
                        Data seluruh anggota yang meminjam buku.
                    </p>
                </div>

                <a href="form_pinjam.php" class="btn btn-primary">
                    Pinjam Buku
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0 text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Kelas</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Jumlah Pinjam</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($query && mysqli_num_rows($query) > 0) { ?>

                            <?php $no = 1; ?>

                            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>

                                    <td>
                                        <?= htmlspecialchars($row['nama'] ?? '-'); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(($row['kelas'] ?? '') ?: '-'); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['judul']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['tgl_pinjam']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['tgl_kembali']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['jml_pinjam']); ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        <?php } else { ?>

                            <tr>
                                <td colspan="7" class="text-center text-secondary py-4">
                                    Belum ada data peminjaman.
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
