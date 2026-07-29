<?php
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'Ik22474268.';
$db   = getenv('DB_NAME') ?: 'umkm_toko_roti';
$port = getenv('DB_PORT') ?: 3306;

$conn = mysqli_connect($host, $user, $pass, $db, $port);
$koneksi = $conn; // Alias agar file yang pakai $koneksi atau $conn sama-sama jalan

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>