<?php

require 'koneksi.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    $user = "DELETE FROM users WHERE id_user = $id_user";
    if (mysqli_query($koneksi, $user)) {
        echo "<script>alert('Data user berhasil dihapus.'); window.location.href = 'daftar_user.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data user: " . mysqli_error($koneksi) . "'); window.location.href = 'daftar_user.php';</script>";
}
} else {
    echo "<script>alert('ID user tidak ditemukan.'); window.location.href = 'daftar_user.php';</script>";
}
?>