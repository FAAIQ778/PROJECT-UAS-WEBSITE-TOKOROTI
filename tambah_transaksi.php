<?php
require 'koneksi.php';

$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
$produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY nama_produk ASC");

if (isset($_POST['simpan'])) {
    $id_pelanggan = (int) $_POST['id_pelanggan'];
    $tanggal = date('Y-m-d');
    $total = 0;
    $bayar = (float) $_POST['bayar'];

    $id_produk = (int) $_POST['id_produk'];
    $qty = (int) $_POST['qty'];

    $dataProduk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga, stok FROM produk WHERE id_produk = $id_produk"));
    if (!$dataProduk) {
        $error = "Produk tidak ditemukan.";
    } elseif ($qty > (int)$dataProduk['stok']) {
        $error = "Stok tidak mencukupi.";
    } else {
        $harga = (float) $dataProduk['harga'];
        $subtotal = $harga * $qty;
        $total = $subtotal;
        $kembali = $bayar - $total;

        mysqli_begin_transaction($conn);

        try {
            $stmt1 = mysqli_prepare($conn, "INSERT INTO transaksi (id_pelanggan, tanggal, total, bayar, kembali) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt1, "isddd", $id_pelanggan, $tanggal, $total, $bayar, $kembali);
            mysqli_stmt_execute($stmt1);

            $id_transaksi = mysqli_insert_id($conn);

            $stmt2 = mysqli_prepare($conn, "INSERT INTO detail_transaksi (id_transaksi, id_produk, qty, harga, subtotal) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt2, "iiidd", $id_transaksi, $id_produk, $qty, $harga, $subtotal);
            mysqli_stmt_execute($stmt2);

            $stokBaru = $dataProduk['stok'] - $qty;
            mysqli_query($conn, "UPDATE produk SET stok = $stokBaru WHERE id_produk = $id_produk");

            mysqli_commit($conn);
            header("Location: transaksi.php");
            exit;
        } catch (Throwable $e) {
            mysqli_rollback($conn);
            $error = "Gagal menyimpan transaksi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <style>
        body{font-family:Arial;background:#f5f5f5;padding:30px}
        .box{max-width:600px;margin:auto;background:#fff;padding:24px;border-radius:12px}
        label{display:block;margin-top:12px;margin-bottom:6px}
        input,select,button{width:100%;padding:10px;border:1px solid #ccc;border-radius:8px}
        button{margin-top:18px;background:#8b5e34;color:#fff;border:none;cursor:pointer}
        .err{background:#fee2e2;color:#991b1b;padding:10px;border-radius:8px;margin-bottom:12px}
    </style>
</head>
<body>
<div class="box">
    <h2>Tambah Transaksi</h2>

    <?php if (!empty($error)) : ?>
        <div class="err"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST">
        Pelanggan</label>
        <select name="id_pelanggan" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php while ($p = mysqli_fetch_assoc($pelanggan)) : ?>
                <option value="<?= $p['id_pelanggan']; ?>"><?= htmlspecialchars($p['nama_pelanggan']); ?></option>
            <?php endwhile; ?>
        </select>

        Produk</label>
        <select name="id_produk" required>
            <option value="">-- Pilih Produk --</option>
            <?php while ($pr = mysqli_fetch_assoc($produk)) : ?>
                <option value="<?= $pr['id_produk']; ?>"><?= htmlspecialchars($pr['nama_produk']); ?></option>
            <?php endwhile; ?>
        </select>

        Qty</label>
        <input type="number" name="qty" min="1" required>

        Bayar</label>
        <input type="number" name="bayar" min="0" required>

        <button type="submit" name="simpan">Simpan</button>
    </form>
</div>
</body>
</html>