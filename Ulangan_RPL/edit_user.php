
<?php

require 'koneksi.php';

$id_user  = $_POST['id_user'];
$email    = $_POST['email'];
$password = $_POST['pass'];
$role     = $_POST['role'];
$nama     = $_POST['nama'];
$kelas    = $_POST['kelas'] ?? '';

if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sqluser = "UPDATE users SET
                email='$email',
                pass='$hashed_password',
                role='$role',
                nama='$nama',
                kelas='$kelas'
                WHERE id_user='$id_user'";
} else {
    $sqluser = "UPDATE users SET
                email='$email',
                role='$role',
                nama='$nama',
                kelas='$kelas'
                WHERE id_user='$id_user'";
}

if (mysqli_query($koneksi, $sqluser)) {

    header("Location: daftar_user.php");
    exit();

} else {
    echo "Data user gagal diperbarui: " . mysqli_error($koneksi);
}

?>
