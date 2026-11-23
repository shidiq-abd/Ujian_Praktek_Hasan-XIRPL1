<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("location: form_login.php");
    exit;
}

$role = $_SESSION['role'] ?? '';

switch ($role) {
    case 'admin':
        header("location: daftar_user.php");
        exit;
    case 'anggota':
        header("location: dashboard_anggota.php");
        exit;
    default:
        session_destroy();
        header("location: form_login.php");
        exit;
}
?>