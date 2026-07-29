<?php
require 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama_pelanggan = trim($_POST['nama_pelanggan']);
    $telepon = trim($_POST['telepon']);
    $alamat = trim($_POST['alamat']);

    $stmt = mysqli_prepare($conn, "INSERT INTO pelanggan (nama_pelanggan, telepon, alamat) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $nama_pelanggan, $telepon, $alamat);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: pelanggan.php");
        exit;
    } else {
        $error = "Gagal menambah pelanggan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <style>
        body{font-family:Arial;background:#f5f5f5;padding:30px}
        .box{max-width:500px;margin:auto;background:#fff;padding:24px;border-radius:12px}
        label{display:block;margin-top:12px;margin-bottom:6px}
        input,textarea,button{width:100%;padding:10px;border:1px solid #ccc;border-radius:8px}
        textarea{min-height:100px;resize:vertical}
        button{margin-top:18px;background:#8b5e34;color:#fff;border:none;cursor:pointer}
        .err{background:#fee2e2;color:#991b1b;padding:10px;border-radius:8px;margin-bottom:12px}
    </style>
</head>
<body>
<div class="box">
    <h2>Tambah Pelanggan</h2>

    <?php if (!empty($error)) : ?>
        <div class="err"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST">
        Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" required>

        Telepon</label>
        <input type="text" name="telepon">

        Alamat</label>
        <textarea name="alamat"></textarea>

        <button type="submit" name="simpan">Simpan</button>
    </form>
</div>
</body>
</html>