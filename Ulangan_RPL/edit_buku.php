<?php

require 'koneksi.php';

$judul = $_POST['judul'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];

$sql = "UPDATE buku SET judul='$judul', penerbit='$penerbit', tahun_terbit='$tahun_terbit', stok='$stok', deskripsi='$deskripsi' WHERE id_buku='{$_POST['id_buku']}'";

if (mysqli_query($koneksi, $sql)) {
    header("Location: daftar_buku.php");
    exit();
} else {
    echo "Data buku gagal diperbarui: " . mysqli_error($koneksi);
}

?>