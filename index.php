<?php
require 'koneksi.php';

$page = $_GET['page'] ?? 'dashboard';

function activeMenu($current, $page) {
    return $current === $page ? 'active' : '';
}

$totalProduk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM produk"));
$totalPelanggan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pelanggan"));
$totalTransaksi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM transaksi"));

$produkTerbaru = mysqli_query($conn, "
    SELECT p.*, k.nama_kategori
    FROM produk p
    LEFT JOIN kategori k ON p.id_kategori = k.id_kategori
    ORDER BY p.id_produk DESC
    LIMIT 4
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Toko Roti</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif}
        body{background:#f8f5f1;color:#2d1b12}
        .navbar{width:100%;background:#2d1b12;padding:18px 40px;display:flex;justify-content:space-between;align-items:center;position:sticky;top:0;z-index:1000}
        .logo{font-size:28px;font-weight:700;color:#facc15}
        .menu{display:flex;gap:12px;flex-wrap:wrap}
        .menu a{color:#fff;text-decoration:none;padding:10px 18px;border-radius:10px;transition:.3s;font-weight:500}
        .menu a:hover,.menu a.active{background:#4a2c1d}
        .main{padding:30px}
        .hero{min-height:360px;border-radius:28px;overflow:hidden;position:relative;margin-bottom:30px;background:url('https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=1600&auto=format&fit=crop') center/cover;display:flex;align-items:center;padding:50px}
        .hero::before{content:'';position:absolute;inset:0;background:rgba(0,0,0,.45)}
        .hero-content{position:relative;z-index:2;color:#fff;max-width:620px}
        .hero-content h1{font-size:52px;margin-bottom:14px}
        .hero-content p{font-size:18px;line-height:1.7;margin-bottom:22px}
        .hero-btn{display:inline-block;padding:14px 24px;background:#facc15;color:#2d1b12;font-weight:700;border-radius:14px;text-decoration:none}
        .cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-bottom:30px}
        .card{background:#fff;padding:24px;border-radius:22px;box-shadow:0 10px 25px rgba(0,0,0,.08)}
        .card h2{font-size:18px;margin-bottom:10px;color:#78716c}
        .card p{font-size:40px;font-weight:700;color:#b45309}
        .section-title{font-size:30px;margin-bottom:20px;font-weight:700}
        .produk-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:22px}
        .produk-card{background:#fff;border-radius:22px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,.08);transition:.25s}
        .produk-card:hover{transform:translateY(-4px)}
        .produk-card img{width:100%;height:220px;object-fit:cover;display:block}
        .produk-content{padding:18px}
        .produk-content h3{font-size:20px;margin-bottom:10px}
        .produk-content p{margin-bottom:6px;color:#57534e}
        .harga{font-size:22px;font-weight:700;color:#b45309}
        .table-container{background:#fff;padding:24px;border-radius:22px;box-shadow:0 10px 25px rgba(0,0,0,.08);overflow:auto}
        .table-head{display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:18px}
        .btn{display:inline-block;padding:11px 16px;border-radius:12px;text-decoration:none;font-weight:600;border:none;cursor:pointer}
        .btn-primary{background:#b45309;color:#fff}
        .btn-soft{background:#f1f5f9;color:#0f172a}
        .btn-danger{background:#dc2626;color:#fff}
        table{width:100%;border-collapse:collapse}
        th{background:#2d1b12;color:#fff;padding:14px}
        td{padding:14px;border-bottom:1px solid #e5e7eb;text-align:center}
        .table-img{width:70px;height:70px;object-fit:cover;border-radius:12px}
        .actions{display:flex;justify-content:center;gap:8px;flex-wrap:wrap}
        .section{display:none}
        .section.active{display:block}
        @media(max-width:768px){
            .hero{min-height:auto;padding:32px 24px}
            .hero-content h1{font-size:34px}
            .navbar{padding:18px 20px;flex-direction:column;gap:12px}
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="logo">🍞 Toko Roti</div>
    <div class="menu">
        <a class="<?= activeMenu('dashboard',$page) ?>" href="index.php?page=dashboard">Dashboard</a>
        <a class="<?= activeMenu('produk',$page) ?>" href="index.php?page=produk">Produk</a>
        <a class="<?= activeMenu('pelanggan',$page) ?>" href="index.php?page=pelanggan">Pelanggan</a>
        <a class="<?= activeMenu('transaksi',$page) ?>" href="index.php?page=transaksi">Transaksi</a>
        <a href="about.php">About Us</a>
    </div>
</nav>

<main class="main">

<!-- ===== DASHBOARD ===== -->
<section class="section <?= $page==='dashboard' ? 'active' : '' ?>">
    <div class="hero">
        <div class="hero-content">
            <h1>Fresh Bakery Every Day</h1>
            <a href="index.php?page=produk" class="hero-btn">Lihat Produk</a>
        </div>
    </div>

    <div class="cards">
        <div class="card"><h2>Total Produk</h2><p><?= $totalProduk; ?></p></div>
        <div class="card"><h2>Total Pelanggan</h2><p><?= $totalPelanggan; ?></p></div>
        <div class="card"><h2>Total Transaksi</h2><p><?= $totalTransaksi; ?></p></div>
    </div>

    <h2 class="section-title">Produk Terbaru</h2>
    <div class="produk-grid">
        <?php while ($d = mysqli_fetch_assoc($produkTerbaru)) { ?>
            <div class="produk-card">
                <img src="img/<?= htmlspecialchars($d['gambar'] ?? 'default.jpg'); ?>" alt="produk">
                <div class="produk-content">
                    <h3><?= htmlspecialchars($d['nama_produk']); ?></h3>
                    <p>Kategori: <?= htmlspecialchars($d['nama_kategori'] ?? '-'); ?></p>
                    <p class="harga">Rp <?= number_format((float)$d['harga']); ?></p>
                    <p>Stok: <?= (int)$d['stok']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<!-- ===== PRODUK ===== -->
<section class="section <?= $page==='produk' ? 'active' : '' ?>">
    <div class="table-container">
        <div class="table-head">
            <h2>Data Produk</h2>
            <a class="btn btn-primary" href="tambah_produk.php">+ Tambah Produk</a>
        </div>
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
            <?php
            $q = mysqli_query($conn, "
                SELECT p.*, k.nama_kategori
                FROM produk p
                LEFT JOIN kategori k ON p.id_kategori = k.id_kategori
                ORDER BY p.id_produk DESC
            ");
            while ($row = mysqli_fetch_assoc($q)) { ?>
            <tr>
                <td><?= $row['id_produk']; ?></td>
                <td><img class="table-img" src="img/<?= htmlspecialchars($row['gambar'] ?? 'default.jpg'); ?>" alt=""></td>
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
</section>

<!-- ===== PELANGGAN ===== -->
<section class="section <?= $page==='pelanggan' ? 'active' : '' ?>">
    <div class="table-container">
        <div class="table-head">
            <h2>Data Pelanggan</h2>
            <a class="btn btn-primary" href="tambah_pelanggan.php">+ Tambah Pelanggan</a>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Telepon</th>
                <th>Alamat</th>
            </tr>
            <?php
            $qp = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");
            while ($p = mysqli_fetch_assoc($qp)) { ?>
            <tr>
                <td><?= $p['id_pelanggan']; ?></td>
                <td><?= htmlspecialchars($p['nama_pelanggan']); ?></td>
                <td><?= htmlspecialchars($p['telepon'] ?? '-'); ?></td>
                <td><?= htmlspecialchars($p['alamat'] ?? '-'); ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</section>

<!-- ===== TRANSAKSI ===== -->
<section class="section <?= $page==='transaksi' ? 'active' : '' ?>">
    <div class="table-container">
        <div class="table-head">
            <h2>Data Transaksi</h2>
            <a class="btn btn-primary" href="tambah_transaksi.php">+ Tambah Transaksi</a>
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
            <?php
            $qt = mysqli_query($conn, "
                SELECT t.*, p.nama_pelanggan
                FROM transaksi t
                LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
                ORDER BY t.id_transaksi DESC
            ");
            while ($t = mysqli_fetch_assoc($qt)) { ?>
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
</section>

</main>
</body>
</html>