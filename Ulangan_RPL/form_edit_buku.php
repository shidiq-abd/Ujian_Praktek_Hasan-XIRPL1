
<?php
require_once 'koneksi.php';

if (!isset($_GET['id_buku'])) {
    echo "<script>
        alert('ID buku tidak ditemukan');
        window.location.href = 'daftar_buku.php';
    </script>";
    exit();
}

$id_buku = $_GET['id_buku'];

$query = "SELECT * FROM buku WHERE id_buku = '$id_buku' LIMIT 1";
$result = mysqli_fetch_assoc(mysqli_query($koneksi, $query));

if (!$result) {
    echo "<script>
        alert('Data buku tidak ditemukan');
        window.location.href = 'daftar_buku.php';
    </script>";
    exit();
}
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Edit Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7 col-xl-6">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white p-4">
                    <h1 class="h4 mb-1">Form Edit Buku</h1>
                    <p class="text-secondary mb-0">
                        Ubah informasi data buku.
                    </p>
                </div>

                <div class="card-body p-4">

                    <form action="edit_buku.php" method="POST">

                        <input type="hidden" name="id_buku"
                            value="<?= $result['id_buku']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input
                                type="text"
                                name="judul"
                                class="form-control"
                                value="<?= htmlspecialchars($result['judul']); ?>"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <input
                                type="text"
                                name="penerbit"
                                class="form-control"
                                value="<?= htmlspecialchars($result['penerbit']); ?>"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Terbit</label>
                            <input
                                type="text"
                                name="tahun_terbit"
                                class="form-control"
                                value="<?= $result['tahun_terbit']; ?>"
                                step="1"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input
                                type="number"
                                name="stok"
                                class="form-control"
                                value="<?= $result['stok']; ?>"
                                min="0"
                                step="1"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Deskripsi</label>
                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="4"
                            ><?= htmlspecialchars($result['deskripsi']); ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" name="edit"
                                class="btn btn-primary">
                                Simpan Perubahan
                            </button>

                            <a href="daftar_buku.php"
                                class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
