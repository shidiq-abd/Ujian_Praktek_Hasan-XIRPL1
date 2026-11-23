
<?php

include 'koneksi.php';

if (!isset($_GET['id_user']) || !isset($_GET['role'])) {
    echo "<script>
        alert('ID atau role tidak ditemukan');
        window.location.href = 'daftar_user.php';
    </script>";
    exit();
}

$id = $_GET['id_user'];
$role = $_GET['role'];

/* =====================================================
   =====================================================
   ADMIN
   =====================================================
   ===================================================== */

if ($role === 'admin') {

    $query = "SELECT * FROM users WHERE id_user = '$id' LIMIT 1";

    $result = mysqli_fetch_assoc(mysqli_query($koneksi, $query));

    if (!$result) {
        echo "<script>
            alert('Data admin tidak ditemukan');
            window.location.href = 'daftar_user.php';
        </script>";
        exit();
    }

?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Form Edit Admin</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit User (Admin)</h4>
                </div>
                <div class="card-body">
                    <form action="edit_user.php" method="POST">
                        <h3>Data Kredensial Akun</h3>

                        <label>Nama Lengkap:</label>
                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="<?= htmlspecialchars($result['nama'] ?? '') ?>"
                            placeholder="Nama Lengkap"
                        >
                        <br>

                        <label>Email:</label>
                        <input
                            type="text"
                            name="email"
                            class="form-control"
                            value="<?= htmlspecialchars($result['email']) ?>"
                            placeholder="Email Akun"
                            required
                        >
                        <br>

                        <label>Password Akun:</label>
                        <input
                            type="password"
                            name="pass"
                            class="form-control"
                            placeholder="Kosongkan jika password tidak diubah"
                        >
                        <br>

                        <!-- data yang dibutuhkan edit_user.php -->
                        <input
                            type="hidden"
                            name="role"
                            value="admin"
                        >

                        <input
                            type="hidden"
                            name="id_user"
                            value="<?= $result['id_user'] ?>"
                        >

                        <button
                            type="submit"
                            name="edit"
                            class="btn btn-primary"
                        >
                            Simpan Data
                        </button>

                        <a
                            href="daftar_user.php"
                            class="btn btn-secondary"
                        >
                            Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php

/* =====================================================
   ANGGOTA
   ===================================================== */

} elseif ($role === 'anggota') {


    $queryanggota = "
        SELECT *
        FROM users
        WHERE id_user = '$id'
        LIMIT 1
    ";

    $resultanggota = mysqli_fetch_assoc(
        mysqli_query($koneksi, $queryanggota)
    );

    if (!$resultanggota) {
        echo "<script>
            alert('Data anggota tidak ditemukan');
            window.location.href = 'daftar_user.php';
        </script>";
        exit();
    }

?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Form Edit Anggota</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit User (Anggota)</h4>
                </div>
                <div class="card-body">
                    <form action="edit_user.php" method="POST">

                        <h3>Data Profil Anggota</h3>

                        <label>Nama Lengkap:</label>
                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="<?= htmlspecialchars($resultanggota['nama']) ?>"
                            placeholder="Nama Lengkap Anggota"
                            required
                        >
                        <br>

                        <label>Kelas:</label>
                        <input
                            type="text"
                            name="kelas"
                            class="form-control"
                            value="<?= htmlspecialchars($resultanggota['kelas'] ?? '') ?>"
                            placeholder="Contoh: XI-RPL-1"
                        >
                        <br>

                        <hr>

                        <h3>Data Kredensial Akun</h3>

                        <label>Email:</label>
                        <input
                            type="text"
                            name="email"
                            class="form-control"
                            value="<?= htmlspecialchars($resultanggota['email']) ?>"
                            placeholder="Email Akun"
                            required
                        >
                        <br>

                        <label>Password Akun:</label>
                        <input
                            type="password"
                            name="pass"
                            class="form-control"
                            placeholder="Kosongkan jika password tidak diubah"
                        >
                        <br>

                        <!-- data untuk proses update -->
                        <input
                            type="hidden"
                            name="role"
                            value="anggota"
                        >

                        <input
                            type="hidden"
                            name="id_user"
                            value="<?= $resultanggota['id_user'] ?>"
                        >

                        <button
                            type="submit"
                            name="edit"
                            class="btn btn-primary"
                        >
                            Simpan Data
                        </button>

                        <a
                            href="daftar_user.php"
                            class="btn btn-secondary"
                        >
                            Kembali
                        </a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php

/* =====================================================
   ROLE TIDAK DIKENAL
   ===================================================== */

} else {

    echo "<script>
        alert('Role tidak valid');
        window.location.href = 'daftar_user.php';
    </script>";

}

?>
