<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'anggota') {
    header("Location: form_login.php");
    exit();
}

$sql = "SELECT * FROM buku WHERE stok > 0 ORDER BY judul ASC";
$query = mysqli_query($koneksi, $sql);

require_once 'navbar.php';
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Peminjaman Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white p-4">
                    <h2 class="h4 mb-1">Form Peminjaman Buku</h2>
                    <p class="text-secondary mb-0">
                        Silakan isi data peminjaman buku.
                    </p>
                </div>

                <div class="card-body p-4">
                    <form action="proses_pinjam.php" method="POST">

                        <label class="form-label">Pilih Buku:</label>
                        <select name="id_buku" class="form-select" required>
                            <option value="">-- Pilih Buku --</option>

                            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                <option value="<?= $row['id_buku']; ?>">
                                    <?= htmlspecialchars($row['judul']); ?>
                                    (Stok: <?= $row['stok']; ?>)
                                </option>
                            <?php } ?>
                        </select>
                        <br>

                        <label class="form-label">Jumlah Pinjam:</label>
                        <input
                            type="number"
                            name="jml_pinjam"
                            class="form-control"
                            min="1"
                            required
                        >
                        <br>

                        <label class="form-label">Tanggal Pinjam:</label>
                        <input
                            type="date"
                            name="tgl_pinjam"
                            class="form-control"
                            value="<?= date('Y-m-d'); ?>"
                            min="<?= date('Y-m-d'); ?>"
                            required
                        >
                        <br>

                        <label class="form-label">Tanggal Kembali:</label>
                        <input
                            type="date"
                            name="tgl_kembali"
                            class="form-control"
                            min="<?= date('Y-m-d'); ?>"
                            required
                        >
                        <br>

                        <button
                            type="submit"
                            name="pinjam"
                            class="btn btn-primary"
                        >
                            Pinjam Buku
                        </button>

                        <a href="pinjam_buku.php" class="btn btn-secondary">
                            Kembali
                        </a>

                    </form>
                </div>

            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>