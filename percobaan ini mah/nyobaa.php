<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css"/>
  <title>Daftar Alumni</title>
  <style>
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    h1 {
      color: #2c3e50;
      text-align: center;
      margin: 20px 0 30px;
      padding-bottom: 15px;
      border-bottom: 2px solid #a145df;
    }

    .search-container {
      margin-bottom: 30px;
      display: flex;
      justify-content: center;
    }

    .search-box {
      width: 100%;
      max-width: 500px;
      position: relative;
    }

    .search-box input {
      width: 100%;
      padding: 10px 15px;
      border: 2px solid #a145df;
      border-radius: 25px;
      font-size: 1rem;
      outline: none;
    }

    .search-box i {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #a145df;
    }

    .alumni-list {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 15px;
      margin-bottom: 30px;
    }

    .alumni-item {
      display: block;
      background:  #a145df;
      color: white;
      padding: 15px;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.3s;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .alumni-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      background:  #7831a7;
    }

    .alumni-name {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .alumni-meta {
      font-size: 0.9rem;
      opacity: 0.9;
      display: flex;
      justify-content: space-between;
    }

    .alumni-detail-box {
      display: none;
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-top: 20px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .alumni-detail-box:target {
      display: block;
    }

    .detail-header {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
      align-items: center;
      border-bottom: 1px solid #eee;
      padding-bottom: 15px;
    }

    .alumni-photo {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #a145df;
    }

    .detail-info h2 {
      color: #2c3e50;
      margin-bottom: 5px;
    }

    .detail-meta {
      color: #7f8c8d;
      font-size: 0.9rem;
    }

    .detail-body {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .biodata-section, .loker-section {
      background: #f8f9fa;
      padding: 15px;
      border-radius: 5px;
    }

    .section-title {
      color:  #a145df;
      margin-bottom: 10px;
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .biodata-table {
      width: 100%;
    }

    .biodata-table tr td {
      padding: 8px 0;
      border-bottom: 1px dashed #eee;
    }

    .biodata-table tr td:first-child {
      font-weight: 500;
      color: #7f8c8d;
      width: 40%;
    }

    .loker-item {
      background: white;
      border-left: 3px solid  #a145df;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 0 5px 5px 0;
    }

    .loker-position {
      font-weight: 600;
      color:  #a145df;
      margin-bottom: 5px;
    }

    .loker-company {
      font-size: 0.9rem;
      color: #7f8c8d;
      margin-bottom: 8px;
    }

    .loker-desc {
      font-size: 0.9rem;
      margin-bottom: 10px;
      color: #555;
    }

    .loker-meta {
      display: flex;
      justify-content: space-between;
      font-size: 0.8rem;
      color: #95a5a6;
    }

    .no-loker {
      background: #fef9e7;
      color: #f39c12;
      padding: 10px;
      border-radius: 4px;
      font-size: 0.9rem;
      text-align: center;
    }

    @media (max-width: 992px) {
      .alumni-list {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .alumni-list {
        grid-template-columns: 1fr;
      }

      .detail-body {
        grid-template-columns: 1fr;
      }

      .detail-header {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-gradient-custom py-3">
    <div class="container-fluid px-4">
      <a class="navbar-brand fw-bold text-purple" href="#">SIMA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center me-3 gap-4">
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="admin-panel.html">Admin Panel</a>
          </li>

          <!-- Menu Daftar Alumni tanpa dropdown -->
          <li class="nav-item">
            <a class="nav-link fw-semibold active" href="daftar-alumni.html">Daftar Alumni</a>
          </li>

          <!--  Nav Login -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle fs-4"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
              <li><a class="dropdown-item" href="pp-admin.html">Profil Saya</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="../logout.php">Log out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <h1>Daftar Alumni SMKN 2 Bandung</h1>

    <!-- Search Box -->
    <div class="search-container">
      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Cari alumni...">
        <i class="bi bi-search"></i>
      </div>
    </div>

    <!-- tampilan sebelum detail alumni  -->
    <div class="alumni-list">
      <!-- Alumni Animasi -->
      <a href="#detail-budi-am" class="alumni-item">
        <div class="alumni-name">Budi Santoso</div>
        <div class="alumni-meta">
          <span>Angkatan 2018</span>
          <span>Animasi - Sutradara</span>
        </div>
      </a>
      <a href="#detail-ani-am" class="alumni-item">
        <div class="alumni-name">Ani Wijaya</div>
        <div class="alumni-meta">
          <span>Angkatan 2019</span>
          <span>Animasi - Desainer Character</span>
        </div>
      </a>
      <a href="#detail-citra-am" class="alumni-item">
        <div class="alumni-name">Citra Dewi</div>
        <div class="alumni-meta">
          <span>Angkatan 2020</span>
          <span>Animasi - Animator 2D</span>
        </div>
      </a>

      <!-- Alumni DKV -->
      <a href="#detail-budi-dkv" class="alumni-item">
        <div class="alumni-name">Budi Santoso</div>
        <div class="alumni-meta">
          <span>Angkatan 2018</span>
          <span>DKV - Desainer Grafis</span>
        </div>
      </a>
      <a href="#detail-ani-dkv" class="alumni-item">
        <div class="alumni-name">Ani Wijaya</div>
        <div class="alumni-meta">
          <span>Angkatan 2019</span>
          <span>DKV - UI/UX Desainer</span>
        </div>
      </a>
      <a href="#detail-citra-dkv" class="alumni-item">
        <div class="alumni-name">Citra Dewi</div>
        <div class="alumni-meta">
          <span>Angkatan 2020</span>
          <span>DKV - Fotografer</span>
        </div>
      </a>

      <!-- Alumni RPL -->
      <a href="#detail-budi-rpl" class="alumni-item">
        <div class="alumni-name">Budi Santoso</div>
        <div class="alumni-meta">
          <span>Angkatan 2018</span>
          <span>RPL - Developer IT</span>
        </div>
      </a>
      <a href="#detail-ani-rpl" class="alumni-item">
        <div class="alumni-name">Ani Wijaya</div>
        <div class="alumni-meta">
          <span>Angkatan 2019</span>
          <span>RPL - Database Engineer</span>
        </div>
      </a>
      <a href="#detail-citra-rpl" class="alumni-item">
        <div class="alumni-name">Citra Dewi</div>
        <div class="alumni-meta">
          <span>Angkatan 2020</span>
          <span>RPL - Fullstack Developer</span>
        </div>
      </a>

      <!-- Alumni TKJ -->
      <a href="#detail-budi-tkj" class="alumni-item">
        <div class="alumni-name">Budi Santoso</div>
        <div class="alumni-meta">
          <span>Angkatan 2018</span>
          <span>TKJ - Teknisi Komputer</span>
        </div>
      </a>
      <a href="#detail-ani-tkj" class="alumni-item">
        <div class="alumni-name">Ani Wijaya</div>
        <div class="alumni-meta">
          <span>Angkatan 2019</span>
          <span>TKJ - Teknisi Jaringan</span>
        </div>
      </a>
      <a href="#detail-citra-tkj" class="alumni-item">
        <div class="alumni-name">Citra Dewi</div>
        <div class="alumni-meta">
          <span>Angkatan 2020</span>
          <span>TKJ - IT Support</span>
        </div>
      </a>
    </div>

    <!-- Detail Alumni -->
    <!-- Alumni Animasi -->
    <div id="detail-budi-am" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Budi Santoso</h2>
          <div class="detail-meta">
            <div>Angkatan 2018 | Animasi</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Jakarta, 15 Mei 2000</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 123, Jakarta</td></tr>
            <tr><td>Email</td><td>budi.santoso@email.com</td></tr>
            <tr><td>Telepon</td><td>0812-3456-7890</td></tr>
            <tr><td>Pekerjaan</td><td>Sutradara Animasi</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="loker-item">
            <div class="loker-position">Asisten Animator</div>
            <div class="loker-company">Studio Animasi Kreatif</div>
            <p class="loker-desc">
              Dicari asisten animator untuk proyek film pendek. Pengalaman minimal 1 tahun di bidang animasi 2D.
            </p>
            <div class="loker-meta">
              <span>Deadline: 30 Juni 2024</span>
              <span>Bandung</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="detail-ani-am" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Ani Wijaya</h2>
          <div class="detail-meta">
            <div>Angkatan 2019 | Animasi</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Bandung, 10 Agustus 2001</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 456, Bandung</td></tr>
            <tr><td>Email</td><td>ani.wijaya@email.com</td></tr>
            <tr><td>Telepon</td><td>0812-9876-5432</td></tr>
            <tr><td>Pekerjaan</td><td>Desainer Character</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="no-loker">
            Belum ada lowongan yang dibagikan oleh alumni ini
          </div>
        </div>
      </div>
    </div>

    <div id="detail-citra-am" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/women/68.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Citra Dewi</h2>
          <div class="detail-meta">
            <div>Angkatan 2020 | Animasi</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Surabaya, 25 Desember 2002</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 789, Surabaya</td></tr>
            <tr><td>Email</td><td>citra.dewi@email.com</td></tr>
            <tr><td>Telepon</td><td>0813-1234-5678</td></tr>
            <tr><td>Pekerjaan</td><td>Animator 2D</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="loker-item">
            <div class="loker-position">Animator Freelance</div>
            <div class="loker-company">Studio Animasi Digital</div>
            <p class="loker-desc">
              Membuka lowongan untuk animator freelance proyek iklan. Pengalaman dengan After Effects dan Illustrator.
            </p>
            <div class="loker-meta            <div class="loker-meta">
              <span>Deadline: 15 Juli 2024</span>
              <span>Remote</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Alumni DKV -->
    <div id="detail-budi-dkv" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/men/33.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Budi Santoso</h2>
          <div class="detail-meta">
            <div>Angkatan 2018 | Desain Komunikasi Visual</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Jakarta, 15 Mei 2000</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 123, Jakarta</td></tr>
            <tr><td>Email</td><td>budi.santoso@email.com</td></tr>
            <tr><td>Telepon</td><td>0812-3456-7890</td></tr>
            <tr><td>Pekerjaan</td><td>Desainer Grafis</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="loker-item">
            <div class="loker-position">Desainer Grafis Junior</div>
            <div class="loker-company">Creative Design Agency</div>
            <p class="loker-desc">
              Dicari desainer grafis dengan pengalaman minimal 1 tahun menguasai Adobe Photoshop dan Illustrator.
            </p>
            <div class="loker-meta">
              <span>Deadline: 30 Juni 2024</span>
              <span>Bandung</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="detail-ani-dkv" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/women/45.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Ani Wijaya</h2>
          <div class="detail-meta">
            <div>Angkatan 2019 | Desain Komunikasi Visual</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Bandung, 10 Agustus 2001</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 456, Bandung</td></tr>
            <tr><td>Email</td><td>ani.wijaya@email.com</td></tr>
            <tr><td>Telepon</td><td>0812-9876-5432</td></tr>
            <tr><td>Pekerjaan</td><td>UI/UX Desainer</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="no-loker">
            Belum ada lowongan yang dibagikan oleh alumni ini
          </div>
        </div>
      </div>
    </div>

    <div id="detail-citra-dkv" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/women/69.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Citra Dewi</h2>
          <div class="detail-meta">
            <div>Angkatan 2020 | Desain Komunikasi Visual</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Surabaya, 25 Desember 2002</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 789, Surabaya</td></tr>
            <tr><td>Email</td><td>citra.dewi@email.com</td></tr>
            <tr><td>Telepon</td><td>0813-1234-5678</td></tr>
            <tr><td>Pekerjaan</td><td>Fotografer</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="loker-item">
            <div class="loker-position">Asisten Fotografer</div>
            <div class="loker-company">Studio Foto Indah</div>
            <p class="loker-desc">
              Membuka kesempatan magang untuk fotografer pemula. Durasi 3 bulan dengan kemungkinan diangkat sebagai karyawan.
            </p>
            <div class="loker-meta">
              <span>Deadline: 15 Juli 2024</span>
              <span>Bandung</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Alumni RPL -->
    <div id="detail-budi-rpl" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/men/34.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Budi Santoso</h2>
          <div class="detail-meta">
            <div>Angkatan 2018 | Rekayasa Perangkat Lunak</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Jakarta, 15 Mei 2000</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 123, Jakarta</td></tr>
            <tr><td>Email</td><td>budi.santoso@email.com</td></tr>
            <tr><td>Telepon</td><td>0812-3456-7890</td></tr>
            <tr><td>Pekerjaan</td><td>Developer IT</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="loker-item">
            <div class="loker-position">Backend Developer</div>
            <div class="loker-company">TechCorp Indonesia</div>
            <p class="loker-desc">
              Dicari backend developer dengan pengalaman minimal 2 tahun mengerjakan REST API menggunakan Node.js atau Go.
            </p>
            <div class="loker-meta">
              <span>Deadline: 30 Juni 2024</span>
              <span>Gede Bage</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="detail-ani-rpl" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/women/46.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Ani Wijaya</h2>
          <div class="detail-meta">
            <div>Angkatan 2019 | Rekayasa Perangkat Lunak</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Bandung, 10 Agustus 2001</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 456, Bandung</td></tr>
            <tr><td>Email</td><td>ani.wijaya@email.com</td></tr>
            <tr><td>Telepon</td><td>0812-9876-5432</td></tr>
            <tr><td>Pekerjaan</td><td>Database Engineer</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="no-loker">
            Belum ada lowongan yang dibagikan oleh alumni ini
          </div>
        </div>
      </div>
    </div>

    <div id="detail-citra-rpl" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/women/70.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Citra Dewi</h2>
          <div class="detail-meta">
            <div>Angkatan 2020 | Rekayasa Perangkat Lunak</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Surabaya, 25 Desember 2002</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 789, Surabaya</td></tr>
            <tr><td>Email</td><td>citra.dewi@email.com</td></tr>
            <tr><td>Telepon</td><td>0813-1234-5678</td></tr>
            <tr><td>Pekerjaan</td><td>Fullstack Developer</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="loker-item">
            <div class="loker-position">Frontend Developer</div>
            <div class="loker-company">Digital Solutions</div>
            <p class="loker-desc">
              Membuka lowongan untuk frontend developer dengan pengalaman React.js dan Vue.js minimal 1 tahun.
            </p>
            <div class="loker-meta">
              <span>Deadline: 15 Juli 2024</span>
              <span>Bandung</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Alumni TKJ -->
    <div id="detail-budi-tkj" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/men/35.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Budi Santoso</h2>
          <div class="detail-meta">
            <div>Angkatan 2018 | Teknik Komputer Dan Jaringan</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Jakarta, 15 Mei 2000</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 123, Jakarta</td></tr>
            <tr><td>Email</td><td>budi.santoso@email.com</td></tr>
            <tr><td>Telepon</td><td>0812-3456-7890</td></tr>
            <tr><td>Pekerjaan</td><td>Teknisi Komputer</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="loker-item">
            <div class="loker-position">Teknisi IT</div>
            <div class="loker-company">PT Solusi Teknologi</div>
            <p class="loker-desc">
              Dicari teknisi IT untuk maintenance hardware dan software di perusahaan. Pengalaman minimal 1 tahun.
            </p>
            <div class="loker-meta">
              <span>Deadline: 30 Juni 2024</span>
              <span>Bandung</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="detail-ani-tkj" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/women/47.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Ani Wijaya</h2>
          <div class="detail-meta">
            <div>Angkatan 2019 | Teknik Komputer Dan Jaringan</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Bandung, 10 Agustus 2001</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 456, Bandung</td></tr>
            <tr><td>Email</td><td>ani.wijaya@email.com</td></tr>
            <tr><td>Telepon</td><td>0812-9876-5432</td></tr>
            <tr><td>Pekerjaan</td><td>Teknisi Jaringan</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="no-loker">
            Belum ada lowongan yang dibagikan oleh alumni ini
          </div>
        </div>
      </div>
    </div>

    <div id="detail-citra-tkj" class="alumni-detail-box">
      <div class="detail-header">
        <img src="https://randomuser.me/api/portraits/women/71.jpg" class="alumni-photo" />
        <div class="detail-info">
          <h2>Citra Dewi</h2>
          <div class="detail-meta">
            <div>Angkatan 2020 | Teknik Komputer Dan Jaringan</div>
            <div>SMKN 2 Bandung</div>
          </div>
        </div>
      </div>
      <div class="detail-body">
        <div class="biodata-section">
          <h3 class="section-title">📋 Biodata Alumni</h3>
          <table class="biodata-table">
            <tr><td>Tempat/Tgl Lahir</td><td>Surabaya, 25 Desember 2002</td></tr>
            <tr><td>Alamat</td><td>Jl. Contoh No. 789, Surabaya</td></tr>
            <tr><td>Email</td><td>citra.dewi@email.com</td></tr>
            <tr><td>Telepon</td><td>0813-1234-5678</td></tr>
            <tr><td>Pekerjaan</td><td>IT Support</td></tr>
          </table>
        </div>
        <div class="loker-section">
          <h3 class="section-title">💼 Lowongan dari Alumni Ini</h3>
          <div class="no-loker">
            Belum ada lowongan yang dibagikan oleh alumni ini
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Sistem Search
    document.getElementById('searchInput').addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      const alumniItems = document.querySelectorAll('.alumni-item');

      alumniItems.forEach(item => {
        const name = item.querySelector('.alumni-name').textContent.toLowerCase();
        const meta = item.querySelector('.alumni-meta').textContent.toLowerCase();
        if (name.includes(searchTerm) || meta.includes(searchTerm)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>
