<?php
session_start();
include "../service/koneksi.php";

$id_siswa = $_SESSION['id_siswa']; // ganti dari $_SESSION['hak'] ke sini
$sql = "SELECT * FROM siswa WHERE id_siswa='$id_siswa'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Profil Alumni</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 col-lg-2 sidebar d-none d-md-block">
      <h5 class="text-center fw-bold mb-4">User Profile</h5>
      <a href="#" class="active">👤 User Info</a>
      <a href="index.php" class="text-danger mt-5"> Close</a>
    </div>

    <div class="col-12 col-md-9 col-lg-10 p-4">
      <div class="text-center mb-4">
        <img src="../assets/img/<?php echo $data['foto']; ?>" alt="Foto Profil" class="profile-pic mb-2">
        <h4 class="fw-bold"><?php echo $data['nama']; ?></h4>
        <form action="gantiPP.php" method="POST" enctype="multipart/form-data">
          <input type="file" class="form-control w-50 mx-auto mt-2" name="foto">
          <button type="submit" class="btn btn-primary mt-2">Ganti Foto</button>
        </form>
      </div>

      <form action="prosesupdatePP.php" method="POST" class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Nama</label>
          <input type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label">Jurusan</label>
          <select class="form-select" name="jurusan">
           <option value="1" <?= ($data['id_jurusan'] == 1) ? 'selected' : '' ?>>RPL</option>
           <option value="2" <?= ($data['id_jurusan'] == 2) ? 'selected' : '' ?>>TKJ</option>
           <option value="3" <?= ($data['id_jurusan'] == 3) ? 'selected' : '' ?>>DKV</option>
           <option value="4" <?= ($data['id_jurusan'] == 4) ? 'selected' : '' ?>>Animasi</option>
        </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Jenis Kelamin</label>
          <select class="form-select" name="jenis_kelamin">
           <option value="L" <?= ($data['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
           <option value="P" <?= ($data['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
        </select>

        </div>
      
        <div class="col-md-6">
          <label class="form-label">Kelas</label>
          <input type="text" class="form-control" name="kelas" value="<?php echo $data['kelas']; ?>">
        </div>

        <div class="col-md-12">
          <label class="form-label">Alamat</label>
          <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>">
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
