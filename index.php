<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sistem Manajemen Informasi Alumni</title>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
  scroll-behavior: smooth;
}

body {
  overflow-x: hidden;
}

/* Navigasi */
.bg-gradient-custom {
  background: linear-gradient(135deg, #fceabb 0%, #f8b6e0 100%);
  box-shadow: 0 4px 20px rgba(161, 69, 223, 0.15);
  backdrop-filter: blur(10px);
}

.navbar {
  padding: 1.2rem 0;
}

.navbar-brand {
  font-size: 32px;
  font-weight: 800;
  letter-spacing: 2px;
  color: #a145df !important;
  text-shadow: 2px 2px 4px rgba(161, 69, 223, 0.2);
}

.nav-link {
  color: #a145df !important;
  font-weight: 500;
  font-size: 16px;
  padding: 8px 16px !important;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.nav-link:hover {
  background-color: rgba(161, 69, 223, 0.1);
  transform: translateY(-2px);
}

.text-purple {
  color: #a145df;
}

.btn-purple {
  background: linear-gradient(135deg, #d58cf7 0%, #a145df 100%);
  border: none;
  border-radius: 25px;
  padding: 10px 30px;
  font-weight: 600;
  box-shadow: 0 6px 20px rgba(213, 140, 247, 0.4);
  transition: all 0.3s ease;
}

.btn-purple:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 30px rgba(213, 140, 247, 0.6);
}

.btn-white {
  background: white;
  border: 2px solid #a145df;
  border-radius: 25px;
  padding: 10px 30px;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-white:hover {
  background: linear-gradient(135deg, #a145df 0%, #d58cf7 100%);
  color: white !important;
  transform: translateY(-3px);
  box-shadow: 0 10px 30px rgba(161, 69, 223, 0.4);
}

/* Home Section */
.home {
  background: linear-gradient(165deg, #fafafa 0%, #fceabb 50%, #f8b6e0 100%);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 60px 20px;
  position: relative;
}

.main-content {
  z-index: 2;
}

.welcome-text {
  font-size: 3.5rem;
  font-weight: 800;
  letter-spacing: 8px;
  background: linear-gradient(135deg, #a145df 0%, #d58cf7 100%);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 10px;
  text-shadow: 0 4px 10px rgba(161, 69, 223, 0.1);
}

.subtext {
  font-size: 1.3rem;
  color: #a145df;
  letter-spacing: 3px;
  font-weight: 500;
  margin-bottom: 50px;
}

.monitor {
  text-align: center;
  margin-top: 60px;
  position: relative;
}

.monitor-img {
  max-width: 100%;
  height: auto;
  width: 600px;
  filter: drop-shadow(0 20px 40px rgba(161, 69, 223, 0.3));
  transition: all 0.5s ease;
}

.monitor-img:hover {
  transform: scale(1.05);
  filter: drop-shadow(0 25px 50px rgba(161, 69, 223, 0.4));
}

/* Decorative Elements */
.decoration-circle {
  position: absolute;
  border-radius: 50%;
  opacity: 0.15;
}

.circle-1 {
  width: 300px;
  height: 300px;
  background: linear-gradient(135deg, #a145df, #d58cf7);
  top: 10%;
  left: 5%;
}

.circle-2 {
  width: 200px;
  height: 200px;
  background: linear-gradient(135deg, #fceabb, #f8b6e0);
  bottom: 15%;
  right: 8%;
}

/* About Section */
.about {
  background: linear-gradient(165deg, #ffffff 0%, #f8b6e0 50%, #fceabb 100%);
  min-height: 100vh;
  padding: 80px 0;
  position: relative;
}

.about-content {
  position: relative;
  z-index: 2;
}

.judul-about {
  font-size: 3rem;
  font-weight: 800;
  letter-spacing: 6px;
  margin-bottom: 20px;
  text-transform: uppercase;
}

.judul-about span {
  background: linear-gradient(135deg, #a145df 0%, #d58cf7 100%);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.subjudul-about {
  font-size: 1.2rem;
  color: #a145df;
  letter-spacing: 2px;
  font-weight: 500;
  margin-bottom: 60px;
}

.about-image {
  max-height: 100%;
  object-fit: cover;
  border-radius: 30px;
  border: 6px solid #a145df;
  box-shadow: 0 20px 60px rgba(161, 69, 223, 0.3);
  transition: all 0.5s ease;
}

.about-image:hover {
  transform: scale(1.03) rotate(-2deg);
  box-shadow: 0 25px 70px rgba(161, 69, 223, 0.4);
}

.about-text {
  font-size: 1.15rem;
  line-height: 2;
  text-align: justify;
  color: #444;
  font-weight: 400;
  padding: 30px;
  background: rgba(255, 255, 255, 0.7);
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
  border-left: 5px solid #a145df;
}

/* Card Enhancement */
.feature-card {
  background: white;
  border-radius: 20px;
  padding: 30px;
  box-shadow: 0 10px 40px rgba(161, 69, 223, 0.15);
  transition: all 0.4s ease;
  border: 2px solid transparent;
}

.feature-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 60px rgba(161, 69, 223, 0.25);
  border-color: #d58cf7;
}

/* Responsive */
@media (max-width: 768px) {
  .welcome-text {
    font-size: 2rem;
    letter-spacing: 4px;
  }
  
  .subtext {
    font-size: 1rem;
    letter-spacing: 2px;
  }
  
  .judul-about {
    font-size: 2rem;
    letter-spacing: 3px;
  }
  
  .subjudul-about {
    font-size: 1rem;
  }
  
  .about-text {
    font-size: 1rem;
    padding: 20px;
  }
  
  .monitor-img {
    width: 400px;
  }
}

@media (max-width: 576px) {
  .welcome-text {
    font-size: 1.5rem;
    letter-spacing: 2px;
  }
  
  .monitor-img {
    width: 300px;
  }
}
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-gradient-custom">
  <div class="container-fluid px-4">
    <a class="navbar-brand">SIMA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center me-3 gap-3">
        <li class="nav-item">
          <a class="nav-link" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
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

<!-- Decorative circles -->
<div class="decoration-circle circle-1"></div>
<div class="decoration-circle circle-2"></div>

<!-- Main Home -->    
<div id="home" class="home">
  <main class="main-content text-center">
    <h1 class="welcome-text">WELCOME TO SIMA</h1>
    <h2 class="subtext">SISTEM INFORMASI MANAJEMEN ALUMNI</h2>
   
    <div class="monitor">
      <img src="monitor.png" alt="monitor alumni" class="monitor-img">
    </div>
  </main>
</div>

<!-- About Section -->
<div class="about">
  <div id="about" class="container about-content">
    <h1 class="text-center judul-about mb-3"><span>TENTANG</span> SIMA</h1>
    <h2 class="text-center subjudul-about">Sistem Informasi Manajemen Alumni SMKN 2 Bandung</h2>
    
    <div class="row justify-content-center align-items-center g-5">
      <!-- Foto di kiri -->
      <div class="col-md-5">
        <img src="about.jpg" alt="SMKN 2 Bandung" class="img-fluid about-image">
      </div>
      
      <!-- Teks di kanan -->
      <div class="col-md-7">
        <p class="about-text">
          Sistem Informasi Manajemen Alumni (SIMA) SMKN 2 Bandung merupakan platform yang menghubungkan alumni dengan sekolah dan dunia industri. Melalui SIMA, alumni dapat mengakses informasi lowongan kerja, pelatihan, dan peluang karier terkini. Platform ini juga mendorong kolaborasi dan jejaring profesional guna mendukung pengembangan karier serta kontribusi alumni di berbagai bidang industri.
        </p>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>