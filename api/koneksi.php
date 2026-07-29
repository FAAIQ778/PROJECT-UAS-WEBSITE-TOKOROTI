<?php
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'Ik22474268.';
$db   = getenv('DB_NAME') ?: 'umkm_toko_roti';
$port = getenv('DB_PORT') ?: 3306;

// Inisialisasi koneksi dengan SSL khusus TiDB Cloud
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);

// Hubungkan ke database dengan timeout dan SSL
if (!mysqli_real_connect($conn, $host, $user, $pass, $db, (int)$port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$koneksi = $conn; // Alias
?>