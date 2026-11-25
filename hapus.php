<?php
require_once "koneksi.php";

if (!isset($koneksi) || !$koneksi) {
    die("Koneksi database gagal. Periksa file koneksi.php.");
}

$id = $_POST['id'];

// Membuat query delete
$query = "DELETE FROM anggota WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id);

// Menjalankan query delete
if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location data_anggota.php");
    exit;
} else {
    die("Gagal menghapus data: " . mysqli_stmt_error($stmt));
}