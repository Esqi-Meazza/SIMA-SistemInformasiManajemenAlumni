<?php
session_start();
include "../service/koneksi.php";
$id = $_SESSION['id_alumni'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM alumni WHERE id_alumni='$id'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Profil Alumni</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 col-lg-2 sidebar d-none d-md-block">
      <h5 class="text-center fw-bold mb-4">User Profile</h5>
      <a href="#" class="active">👤 User Info</a>
      <a href="index.php" class="text-danger mt-5"> Close </a>
    </div>

    <div class="col-12 col-md-9 col-lg-10 p-4">
      <div class="text-center mb-4">
        <img src="../assets/img/<?php echo $data['foto']; ?>" alt="Foto Profil" class="profile-pic mb-2" style="width:120px; height:120px; border-radius:50%;">
        <h4 class="fw-bold"><?php echo $data['nama']; ?></h4>
        <p class="text-muted"><?php echo $data['pekerjaan']; ?></p>
        <form action="gantiPP.php" method="POST" enctype="multipart/form-data">
          <input type="file" name="foto" class="form-control w-50 mx-auto mt-2">
          <button class="btn btn-sm btn-primary mt-2" type="submit">Ganti Foto</button>
        </form>
      </div>

      <form class="row g-3" action="prosesupdatePP.php" method="POST">
        <div class="col-md-6">
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label">Angkatan</label>
          <input type="text" name="angkatan" class="form-control" value="<?php echo $data['angkatan']; ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label">Jenis Kelamin</label>
          <select class="form-select" name="jenis_kelamin">
            <option value="L" <?php if($data['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
            <option value="P" <?php if($data['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Tempat Lahir</label>
          <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $data['tempat_lahir']; ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $data['tanggal_lahir']; ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" value="<?php echo $data['pekerjaan']; ?>">
        </div>

        <div class="col-md-12">
          <label class="form-label">Alamat</label>
          <input type="text" name="alamat" class="form-control" value="<?php echo $data['alamat']; ?>">
        </div>

        <div class="col-12 text-center mt-4">
          <button type="submit" class="btn btn-success px-5 py-2">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>



<style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
      background-color: white;
      border-right: 1px solid #ddd;
      padding-top: 30px;
      height: 100vh;
    }

    .sidebar a {
      display: block;
      padding: 10px 20px;
      color: #555;
      text-decoration: none;
    }

    .sidebar a:hover,
    .sidebar a.active {
      color: #a145df;
      font-weight: bold;
    }

    .profile-pic {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid #fff;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    .save-btn {
      background-color: #a145df;
      color: white;
      transition: all 0.3s ease-in;
    }

    .save-btn:hover {
      box-shadow: 0 0 8px #a145df;
      background: transparent;
      color: #303030;
    }

    .form-label {
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }
    }
  </style>