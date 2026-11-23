<?php

require 'koneksi.php';


$nama           =   $_POST['nama'];
$kelas          =   $_POST['kelas'];



$email       =   $_POST['email'];
$password       =   password_hash($_POST['pass'], PASSWORD_DEFAULT);
$role           =   $_POST['role'];

$sqluser = "INSERT INTO users (email, pass, role, nama, kelas) VALUES ('$email', '$password', '$role','$nama','$kelas')";
if (mysqli_query($koneksi, $sqluser)) {

    $user_id = mysqli_insert_id($koneksi);

    
    header("Location: daftar_user.php");
    exit();

} else {
    echo "Data user gagal: " . mysqli_error($koneksi);
}

?>