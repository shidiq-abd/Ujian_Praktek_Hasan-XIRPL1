
<?php
require_once 'koneksi.php';
require_once 'navbar.php';

$sql = "SELECT * FROM buku ORDER BY id_buku DESC";

$query = mysqli_query($koneksi, $sql);
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Data Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<main class="container py-5">
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h2 class="h4 mb-1">Daftar Data Buku</h2>
                    <p class="text-secondary mb-0">
                        Data Buku yang terdaftar di sistem.
                    </p>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0 text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>penerbit</th>
                            <th>Tahun Terbit </th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($query && mysqli_num_rows($query) > 0) { ?>

                            <?php $no = 1; ?>

                            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>

                                    <td>
                                        <?= htmlspecialchars($row['judul']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['penerbit']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['tahun_terbit']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['stok']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['deskripsi']); ?>
                                    </td>

                                    <td>
                                        <a href="form_edit_buku.php?id_buku=<?= $row['id_buku']; ?>"
                                           class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>

                                     <a href="hapus_buku.php?id_buku=<?php echo $row['id_buku']; ?>"
                                         class="btn btn-sm btn-outline-danger"
                                         onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                          Hapus
                                       </a>
                                </tr>
                            <?php } ?>

                        <?php } else { ?>

                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">
                                    Belum ada data Buku.
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