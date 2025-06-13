<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SIMA</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css"/>
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
    <a class="nav-link fw-semibold" href="#home">Home</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link fw-semibold" href="#about">About</a>
  </li>
 
         <!-- Menu Daftar Alumni tanpa dropdown -->
          <li class="nav-item">
            <a class="nav-link fw-semibold active" href="daftaralumni.php">Daftar Alumni</a>
          </li>

        <!--  Nav Login -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-4"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="pp-alumni.php">Profil Saya</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../logout.php">Log out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

 <!-- Main Home -->
   <div id="home" class="home">
     <main class="main-content text-center py-5">
       <h1 class="welcome-text">WELCOME TO SIMA</h1>
       <h2 class="subtext">SISTEM INFORMASI MENEJEMEN ALUMNI</h2>
   
      <div class="monitor">
     <img src="../monitor.png" alt="monitor alumni" class="monitor-img">
   </div>
   </div>

 <!-- isi about -->
  <div class="about">
    <div id="about" class="container about-content py-5">
       <h1 class="text-center judul-about mb-5 text-purple"><span style="color: #9900ff;">TENTANG</span> SIMA</h1>
       <h2 class="text-center subjudul-about mb-5 text-purple"> Sistem Infomari Manajamen SMKN 2 Bandung</h2>
       <div class="row justify-content-center align-items-center">
         <!-- Foto di kiri -->
         <div class="col-md-5 mb-4 mb-md-0">
           <img src="../about.jpg" alt="SMKN 2 Bandung" class="img-fluid about-image rounded shadow">
         </div>
         
         <!-- Teks di kanan -->
         <div class="col-md-7">
           <p class="about-text">
             SMKN 2 Bandung telah mencetak lulusan-lulusan yang berperan aktif dalam berbagai bidang industri. Melalui Sistem Informasi Manajemen Alumni (SIMA), para alumni dapat saling terhubung dan mengakses informasi lowongan kerja, pelatihan, serta peluang karier terkini. SIMA menjadi ruang kolaborasi alumni dan sekolah dalam mendukung pengembangan karier dan kontribusi terhadap masyarakat. Mari ambil bagian dalam membangun jejaring profesional melalui SIMA demi kemajuan bersama.
           </p>
         </div>
       </div>
     </div>
  </div>




  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
