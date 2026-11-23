
<?php

require 'koneksi.php';
session_start();

$email = $_POST['email'];
$password = $_POST['pass'];

$sql = "SELECT * FROM users WHERE email = '$email'";

$result = mysqli_fetch_assoc(mysqli_query($koneksi, $sql));

if ($result && password_verify($password, $result['pass'])) {

    $_SESSION['id_user'] = $result['id_user'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['role'] = $result['role'];
    $_SESSION['nama'] = $result['nama'];
    $_SESSION['kelas'] = $result['kelas'];
    $_SESSION['login'] = true;

    header("Location: index.php");
    exit;

} else {

    echo "<script>
        alert('Email atau Password salah!');
        window.location='form_login.php';
    </script>";

}

?>
