<?php
require 'koneksi.php';

$query = mysqli_query($conn, "
    SELECT t.*, p.nama_pelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
    ORDER BY t.id_transaksi DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <style>
        body{margin:0;background:#f8f5f1;padding:30px;font-family:Poppins,sans-serif;color:#2d1b12}
        .box{background:#fff;border-radius:22px;box-shadow:0 10px 25px rgba(0,0,0,.08);padding:24px}
        .topbar{display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:20px}
        .btn{display:inline-block;padding:11px 16px;border-radius:12px;text-decoration:none;font-weight:600;border:none;cursor:pointer}
        .btn-primary{background:#b45309;color:#fff}
        table{width:100%;border-collapse:collapse}
        th{background:#2d1b12;color:#fff;padding:14px}
        td{padding:14px;border-bottom:1px solid #edf2f7;text-align:center}
    </style>
</head>
<body>
<div class="box">
    <div class="topbar">
        <h2>Data Transaksi</h2>
        <a class="btn btn-primary" href="#">+ Tambah Transaksi</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembali</th>
        </tr>
        <?php while ($t = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $t['id_transaksi']; ?></td>
            <td><?= htmlspecialchars($t['tanggal']); ?></td>
            <td><?= htmlspecialchars($t['nama_pelanggan'] ?? '-'); ?></td>
            <td>Rp <?= number_format((float)$t['total']); ?></td>
            <td>Rp <?= number_format((float)$t['bayar']); ?></td>
            <td>Rp <?= number_format((float)$t['kembali']); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>