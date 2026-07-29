<?php
require 'koneksi.php';

$kategoriList = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");

if (isset($_POST['simpan'])) {
    $id_kategori = (int) $_POST['id_kategori'];
    $nama_produk = trim($_POST['nama_produk']);
    $harga = (float) $_POST['harga'];
    $stok = (int) $_POST['stok'];
    $deskripsi = trim($_POST['deskripsi']);
    $gambar = null;

    if (!empty($_FILES['gambar']['name'])) {
        if (!file_exists("img")) mkdir("img", 0777, true);

        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        $namaFile = time() . "_" . rand(1000, 9999) . "." . $ext;
        $target = "img/" . $namaFile;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            $gambar = $namaFile;
        } else {
            $error = "Upload gambar gagal.";
        }
    }

    if (empty($error)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO produk (id_kategori, nama_produk, harga, stok, gambar, deskripsi) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isdiss", $id_kategori, $nama_produk, $harga, $stok, $gambar, $deskripsi);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: produk.php");
            exit;
        } else {
            $error = "Gagal simpan produk.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <style>
        body{margin:0;background:#f8f5f1;padding:30px;font-family:Poppins,sans-serif;color:#2d1b12}
        .box{max-width:620px;background:#fff;padding:26px;border-radius:22px;margin:auto;box-shadow:0 10px 25px rgba(0,0,0,.08)}
        label{display:block;margin-top:14px;margin-bottom:8px;font-weight:600}
        input,textarea,select,button{width:100%;padding:12px 14px;border-radius:12px;border:1px solid #ddd}
        textarea{min-height:120px;resize:vertical}
        button{margin-top:18px;background:#b45309;color:#fff;border:none;font-weight:700;cursor:pointer}
        a{display:inline-block;margin-top:15px;text-decoration:none;color:#b45309}
        .err{background:#fee2e2;color:#991b1b;padding:12px 14px;border-radius:12px;margin-bottom:16px}
    </style>
</head>
<body>
<div class="box">
    <h2>Tambah Produk</h2>

    <?php if (!empty($error)) : ?>
        <div class="err"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Kategori</label>
        <select name="id_kategori" required>
            <option value="">Pilih kategori</option>
            <?php while ($k = mysqli_fetch_assoc($kategoriList)) { ?>
                <option value="<?= $k['id_kategori']; ?>"><?= htmlspecialchars($k['nama_kategori']); ?></option>
            <?php } ?>
        </select>

        <label>Nama Produk</label>
        <input type="text" name="nama_produk" required>

        <label>Harga</label>
        <input type="number" name="harga" required>

        <label>Stok</label>
        <input type="number" name="stok" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi"></textarea>

        <label>Foto Produk</label>
        <input type="file" name="gambar" accept="image/*">

        <button type="submit" name="simpan">Simpan</button>
    </form>

    <a href="produk.php">← Kembali</a>
</div>
</body>
</html>