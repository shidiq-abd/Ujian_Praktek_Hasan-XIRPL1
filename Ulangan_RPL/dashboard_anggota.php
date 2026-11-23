
<?php
require_once 'koneksi.php';
require_once 'navbar.php';

$sql =
    "SELECT users.*
    FROM users
    WHERE users.role = 'anggota'
    ORDER BY users.id_user DESC
    ";

$query = mysqli_query($koneksi, $sql);
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Data Anggota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<main class="container py-5">
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h2 class="h4 mb-1">Daftar Data Anggota</h2>
                    <p class="text-secondary mb-0">
                        Data anggota yang terdaftar di sistem.
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
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($query && mysqli_num_rows($query) > 0) { ?>

                            <?php $no = 1; ?>

                            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>

                                    <td>
                                        <?= htmlspecialchars($row['email']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['pass']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['role']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(($row['nama'] ?? '') ?: '-'); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(($row['kelas'] ?? '') ?: '-'); ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        <?php } else { ?>

                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">
                                    Belum ada data anggota.
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
