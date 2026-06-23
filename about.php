<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Toko Roti</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif}
        body{background:#f8f5f1;color:#2d1b12}

        /* NAVBAR */
        .navbar{width:100%;background:#2d1b12;padding:18px 40px;display:flex;justify-content:space-between;align-items:center;position:sticky;top:0;z-index:1000}
        .logo{font-size:28px;font-weight:700;color:#facc15;text-decoration:none}
        .menu{display:flex;gap:12px;flex-wrap:wrap}
        .menu a{color:#fff;text-decoration:none;padding:10px 18px;border-radius:10px;transition:.3s;font-weight:500}
        .menu a:hover,.menu a.active{background:#4a2c1d}

        /* HERO */
        .hero{min-height:380px;border-radius:28px;overflow:hidden;position:relative;margin:30px 40px 0;background:url('https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=1600&auto=format&fit=crop') center/cover;display:flex;align-items:flex-end;padding:50px}
        .hero::before{content:'';position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,.7) 0%, rgba(0,0,0,.2) 60%)}
        .hero-content{position:relative;z-index:2;color:#fff}
        .hero-content .tag{display:inline-block;background:#facc15;color:#2d1b12;font-size:13px;font-weight:700;padding:6px 16px;border-radius:50px;margin-bottom:14px;letter-spacing:.5px}
        .hero-content h1{font-size:48px;font-weight:700;line-height:1.15;margin-bottom:10px}
        .hero-content p{font-size:17px;opacity:.85;max-width:500px;line-height:1.7}

        /* MAIN */
        main{padding:40px}

        /* PROFIL SECTION */
        .profil{display:grid;grid-template-columns:1fr 1fr;gap:40px;background:#fff;border-radius:28px;padding:40px;box-shadow:0 10px 25px rgba(0,0,0,.07);margin-bottom:30px;align-items:center}
        .profil img{width:100%;height:340px;object-fit:cover;border-radius:18px}
        .profil-teks h2{font-size:32px;font-weight:700;margin-bottom:16px;color:#2d1b12}
        .profil-teks p{font-size:15px;line-height:1.85;color:#57534e;margin-bottom:14px}

        /* STATS */
        .stats{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:30px}
        .stat{background:#fff;border-radius:22px;padding:28px 24px;box-shadow:0 10px 25px rgba(0,0,0,.07);text-align:center}
        .stat-num{font-size:44px;font-weight:700;color:#b45309;margin-bottom:6px}
        .stat-label{font-size:14px;color:#78716c;font-weight:500}

        /* INFO CARDS */
        .info-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:22px;margin-bottom:30px}
        .info-card{background:#fff;border-radius:22px;padding:28px;box-shadow:0 10px 25px rgba(0,0,0,.07)}
        .info-icon{font-size:36px;margin-bottom:16px}
        .info-card h3{font-size:18px;font-weight:700;margin-bottom:10px;color:#2d1b12}
        .info-card p{font-size:14px;line-height:1.75;color:#57534e}

        /* LOKASI */
        .lokasi{background:#2d1b12;border-radius:28px;padding:36px;color:#fff;display:flex;gap:40px;align-items:center;flex-wrap:wrap}
        .lokasi-teks{flex:1;min-width:220px}
        .lokasi-teks h3{font-size:24px;font-weight:700;margin-bottom:16px;color:#facc15}
        .lokasi-teks p{font-size:14px;line-height:1.85;opacity:.85;margin-bottom:8px}
        .lokasi-teks .jam{margin-top:18px}
        .lokasi-teks .jam p{opacity:1;font-weight:600;font-size:15px;color:#facc15;margin-bottom:6px}
        .lokasi-teks .jam span{display:block;font-size:14px;opacity:.75;font-weight:400}
        .lokasi-map{flex:1;min-width:220px;border-radius:18px;overflow:hidden;height:220px;background:#4a2c1d;display:flex;align-items:center;justify-content:center;font-size:14px;color:#facc15;font-weight:600;letter-spacing:.5px}

        /* BACK LINK */
        .back{display:inline-block;margin-bottom:24px;color:#b45309;font-weight:600;text-decoration:none;font-size:14px}
        .back:hover{text-decoration:underline}

        @media(max-width:768px){
            .navbar{padding:18px 20px;flex-direction:column;gap:12px}
            .hero{margin:20px 20px 0;padding:30px 24px}
            .hero-content h1{font-size:32px}
            main{padding:24px 20px}
            .profil{grid-template-columns:1fr}
            .stats{grid-template-columns:1fr}
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a class="logo" href="index.php">🍞 Toko Roti</a>
    <div class="menu">
        <a href="index.php?page=dashboard">Dashboard</a>
        <a href="index.php?page=produk">Produk</a>
        <a href="index.php?page=pelanggan">Pelanggan</a>
        <a href="index.php?page=transaksi">Transaksi</a>
        <a href="about.php" class="active">About Us</a>
    </div>
</nav>

<div class="hero">
    <div class="hero-content">
        <span class="tag">About Us</span>
        <h1>Roti Buatan Hati,<br>Dinikmati Setiap Hari</h1>
        <p>Kami menghadirkan roti segar berkualitas dengan bahan pilihan dan resep turun-temurun.</p>
    </div>
</div>

<main>
    <a class="back" href="index.php?page=dashboard">← Kembali ke Dashboard</a>

    <!-- PROFIL -->
    <div class="profil">
        
        <div class="profil-teks">
            <h2>Info</h2>
            <p>
                Toko Roti adalah usaha bakeri rumahan yang berdiri sejak 2015. Berawal dari dapur kecil dengan tekad besar, kami kini telah melayani ratusan pelanggan setia setiap harinya.
            </p>
            <p>
                Setiap produk kami dibuat dengan bahan-bahan segar pilihan tanpa pengawet buatan. Kami percaya bahwa roti yang baik bukan hanya soal rasa — tapi juga soal kehangatan dan ketulusan yang ada di setiap adonannya.
            </p>
            <p>
                Dari roti tawar klasik, croissant lembut, hingga kue ulang tahun spesial — semua tersedia dengan harga yang bersahabat dan kualitas yang tidak pernah kami kompromikan.
            </p>
        </div>
    </div>

    <!-- STATS -->
    <div class="stats">
        <div class="stat">
            <div class="stat-num">50+</div>
            <div class="stat-label">Varian Produk</div>
        </div>
    </div>

    <!-- INFO CARDS -->
    <div class="info-grid">
        <div class="info-card">
            <div class="info-icon">🌾</div>
            <h3>Bahan Berkualitas</h3>
            <p>Kami hanya menggunakan tepung terigu premium, mentega pilihan, dan bahan-bahan alami segar tanpa bahan pengawet tambahan.</p>
        </div>
        <div class="info-card">
            <div class="info-icon">🔥</div>
            <h3>Dipanggang Setiap Hari</h3>
            <p>Semua produk kami dipanggang fresh setiap pagi sehingga anda selalu mendapatkan roti yang hangat dan lembut setiap saat.</p>
    </div>

    <!-- LOKASI & JAM -->
    <div class="lokasi">
        <div class="lokasi-teks">
            <h3>📍 Temukan Kami</h3>
            <p>Jl. Raya Bakeri No. 88, Kel. Harum Manis,<br>Kec. Sari Roti, Jakarta Selatan 12345</p>
            <p>📞 (021) 8888-1234</p>
            <p>📧 tokoroti@email.com</p>
            <div class="jam">
                <p>🕐 Jam Operasional</p>
                <span>Senin – Sabtu: 07.00 – 20.00 WIB</span>
                <span>Minggu: 08.00 – 17.00 WIB</span>
            </div>
        </div>
        <div class="lokasi-map">
            🗺️ &nbsp; Lihat di Google Maps
        </div>
    </div>
</main>

</body>
</html>