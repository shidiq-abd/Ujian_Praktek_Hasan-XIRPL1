<?php

require 'koneksi.php';
session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'anggota') {
    header("Location: form_login.php");
    exit();
}

$id_user = $_SESSION['id_user'];
$id_buku = (int) ($_POST['id_buku'] ?? 0);
$tgl_pinjam = $_POST['tgl_pinjam'] ?? '';
$tgl_kembali = $_POST['tgl_kembali'] ?? '';
$jml_pinjam = (int) ($_POST['jml_pinjam'] ?? 0);

// cek data yang dikirim
if ($id_buku <= 0 || $jml_pinjam <= 0 || empty($tgl_pinjam) || empty($tgl_kembali)) {
    echo "<script>
        alert('Data peminjaman belum lengkap!');
        window.location='form_pinjam.php';
    </script>";
    exit();
}

// cek tanggal kembali
if ($tgl_kembali < $tgl_pinjam) {
    echo "<script>
        alert('Tanggal kembali tidak boleh sebelum tanggal pinjam!');
        window.location='form_pinjam.php';
    </script>";
    exit();
}

// mulai transaksi database
mysqli_begin_transaction($koneksi);

try {

    // cek stok buku
    $sqlstok = "SELECT stok FROM buku WHERE id_buku = ? FOR UPDATE";
    $stmtstok = mysqli_prepare($koneksi, $sqlstok);
    mysqli_stmt_bind_param($stmtstok, "i", $id_buku);
    mysqli_stmt_execute($stmtstok);

    $resultstok = mysqli_stmt_get_result($stmtstok);
    $data = mysqli_fetch_assoc($resultstok);

    if (!$data) {
        throw new Exception("Buku tidak ditemukan!");
    }

    if ($data['stok'] < $jml_pinjam) {
        throw new Exception("Stok buku tidak mencukupi!");
    }

    // simpan data peminjaman
    $sql = "INSERT INTO pinjam
            (id_user, id_buku, tgl_pinjam, tgl_kembali, jml_pinjam)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "iissi",
        $id_user,
        $id_buku,
        $tgl_pinjam,
        $tgl_kembali,
        $jml_pinjam
    );

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Data peminjaman gagal disimpan!");
    }

    // kurangi stok buku
    $sqlupdate = "UPDATE buku SET stok = stok - ? WHERE id_buku = ?";
    $stmtupdate = mysqli_prepare($koneksi, $sqlupdate);
    mysqli_stmt_bind_param($stmtupdate, "ii", $jml_pinjam, $id_buku);

    if (!mysqli_stmt_execute($stmtupdate)) {
        throw new Exception("Stok buku gagal diperbarui!");
    }

    // simpan perubahan
    mysqli_commit($koneksi);

    echo "<script>
        alert('Buku berhasil dipinjam!');
        window.location='pinjam_buku.php';
    </script>";

} catch (Exception $e) {

    mysqli_rollback($koneksi);

    echo "<script>
        alert(" . json_encode($e->getMessage()) . ");
        window.location='form_pinjam.php';
    </script>";

}

?>