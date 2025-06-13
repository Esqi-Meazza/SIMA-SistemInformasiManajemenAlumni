<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"/>
    <title>Sistem Manajeen Informasi Alumni</title>
</head>
<body>
<!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-gradient-custom py-3">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold text-purple">SIMA</a>
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
  
  <!--  Nav Login -->
  <li>
    <a href="login/index.php" class="btn btn-sm btn-purple text-white">Log in</a>
  </li>
  <li class="nav-item">
    <a class="btn btn-sm btn-white text-purple fw-bold" href="register/index.php">Register</a>
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
     <img src="monitor.png" alt="monitor alumni" class="monitor-img">
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
           <img src="about.jpg" alt="SMKN 2 Bandung" class="img-fluid about-image rounded shadow">
         </div>
         
         <!-- Teks di kanan -->
         <div class="col-md-7">
           <p class="about-text">
Sistem Informasi Manajemen Alumni (SIMA) SMKN 2 Bandung merupakan platform yang menghubungkan alumni dengan sekolah dan dunia industri. Melalui SIMA, alumni dapat mengakses informasi lowongan kerja, pelatihan, dan peluang karier terkini. Platform ini juga mendorong kolaborasi dan jejaring profesional guna mendukung pengembangan karier serta kontribusi alumni di berbagai bidang industri.           </p>
         </div>
       </div>
     </div>
  </div>