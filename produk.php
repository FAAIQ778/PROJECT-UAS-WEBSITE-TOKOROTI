<?php
require 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    // Hapus detail transaksi yang pakai produk ini dulu
    mysqli_query($conn, "DELETE FROM detail_transaksi WHERE id_produk = $id");

    // Hapus gambar jika ada
    $cek = mysqli_query($conn, "SELECT gambar FROM produk WHERE id_produk = $id");
    $data = mysqli_fetch_assoc($cek);
    if ($data && !empty($data['gambar']) && file_exists("img/" . $data['gambar'])) {
        unlink("img/" . $data['gambar']);
    }

    mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id");
    header("Location: produk.php");
    exit;
}

$query = mysqli_query($conn, "
    SELECT p.*, k.nama_kategori
    FROM produk p
    LEFT JOIN kategori k ON p.id_kategori = k.id_kategori
    ORDER BY p.id_produk DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif}
        body{background:#f8f5f1;color:#2d1b12;padding:30px}
        .box{background:#fff;border-radius:22px;box-shadow:0 10px 25px rgba(0,0,0,.08);padding:24px}
        .topbar{display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:20px}
        .btn{display:inline-block;padding:11px 16px;border-radius:12px;text-decoration:none;font-weight:600;border:none;cursor:pointer}
        .btn-primary{background:#b45309;color:#fff}
        .btn-soft{background:#f1f5f9;color:#0f172a}
        .btn-danger{background:#dc2626;color:#fff}
        table{width:100%;border-collapse:collapse}
        th{background:#2d1b12;color:#fff;padding:14px}
        td{padding:14px;border-bottom:1px solid #edf2f7;text-align:center}
        .actions{display:flex;justify-content:center;gap:8px;flex-wrap:wrap}
        .img{width:70px;height:70px;object-fit:cover;border-radius:12px}
        .alert-error{background:#fee2e2;color:#991b1b;padding:12px 16px;border-radius:12px;margin-bottom:18px;font-size:14px}
    </style>
</head>
<body>
<div class="box">
    <div class="topbar">
        <h2>Data Produk</h2>
        <div>
            <a class="btn btn-primary" href="tambah_produk.php">+ Tambah Produk</a>
            <a class="btn btn-soft" href="index.php">Dashboard</a>
        </div>
    </div>

    <?php if (!empty($error_hapus)) : ?>
        <div class="alert-error"><?= htmlspecialchars($error_hapus); ?></div>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $row['id_produk']; ?></td>
            <td><img class="img" src="img/<?= htmlspecialchars($row['gambar'] ?? 'default.jpg'); ?>" alt=""></td>
            <td><?= htmlspecialchars($row['nama_produk']); ?></td>
            <td><?= htmlspecialchars($row['nama_kategori'] ?? '-'); ?></td>
            <td>Rp <?= number_format((float)$row['harga']); ?></td>
            <td><?= (int)$row['stok']; ?></td>
            <td>
                <div class="actions">
                    <a class="btn btn-soft" href="edit_produk.php?id=<?= $row['id_produk']; ?>">Edit</a>
                    <a class="btn btn-danger" href="produk.php?hapus=<?= $row['id_produk']; ?>" onclick="return confirm('Yakin hapus produk ini?')">Hapus</a>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>