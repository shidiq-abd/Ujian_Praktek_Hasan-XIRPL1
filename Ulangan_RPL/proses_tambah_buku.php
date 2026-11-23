<?php

require 'koneksi.php';


$deskripsi              =   $_POST['deskripsi'];
$stok                   =   $_POST['stok'];
$judul                  =   $_POST['judul'];
$penerbit               =   $_POST['penerbit'];
$tahun_terbit           =   $_POST['tahun_terbit'];

$sqluser = "INSERT INTO buku (judul, penerbit, tahun_terbit, deskripsi, stok) VALUES ('$judul', '$penerbit', '$tahun_terbit','$deskripsi','$stok')";
if (mysqli_query($koneksi, $sqluser)) {

    $user_id = mysqli_insert_id($koneksi);

    
    header("Location: daftar_buku.php");
    exit();

} else {
    echo "Data buku gagal: " . mysqli_error($koneksi);
}

?>