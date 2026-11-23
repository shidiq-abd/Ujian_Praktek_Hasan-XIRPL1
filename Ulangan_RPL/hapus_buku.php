<?php

require 'koneksi.php';

if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];

    $buku = "DELETE FROM buku WHERE id_buku = $id_buku";
    if (mysqli_query($koneksi, $buku)) {
        echo "<script>alert('Data buku berhasil dihapus.'); window.location.href = 'daftar_buku.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data buku: " . mysqli_error($koneksi) . "'); window.location.href = 'daftar_buku.php';</script>";
}
} else {
    echo "<script>alert('ID buku tidak ditemukan.'); window.location.href = 'daftar_buku.php';</script>";
}
?>