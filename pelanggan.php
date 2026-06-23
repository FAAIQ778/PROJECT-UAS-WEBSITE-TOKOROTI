<?php
require 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <style>
        body{margin:0;background:#f8f5f1;padding:30px;font-family:Poppins,sans-serif;color:#2d1b12}
        .box{background:#fff;border-radius:22px;box-shadow:0 10px 25px rgba(0,0,0,.08);padding:24px}
        .topbar{display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:20px}
        .btn{display:inline-block;padding:11px 16px;border-radius:12px;text-decoration:none;font-weight:600;border:none;cursor:pointer}
        .btn-primary{background:#b45309;color:#fff}
        .btn-soft{background:#f1f5f9;color:#0f172a}
        table{width:100%;border-collapse:collapse}
        th{background:#2d1b12;color:#fff;padding:14px}
        td{padding:14px;border-bottom:1px solid #edf2f7;text-align:center}
    </style>
</head>
<body>
<div class="box">
    <div class="topbar">
        <h2>Data Pelanggan</h2>
        <a class="btn btn-primary" href="#">+ Tambah Pelanggan</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Telepon</th>
            <th>Alamat</th>
        </tr>
        <?php while ($p = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $p['id_pelanggan']; ?></td>
            <td><?= htmlspecialchars($p['nama_pelanggan']); ?></td>
            <td><?= htmlspecialchars($p['telepon'] ?? '-'); ?></td>
            <td><?= htmlspecialchars($p['alamat'] ?? '-'); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>