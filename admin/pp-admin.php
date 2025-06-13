<?php
session_start();
include "../service/koneksi.php";

// Tambahkan pengecekan session
if (!isset($_SESSION['hak'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.'); window.location='../login.php';</script>";
    exit;
}

$hakAkses = $_SESSION['hak'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css"/>
  <style>
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
    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 sidebar d-none d-md-block">
      <h5 class="text-center fw-bold mb-4">User Profile</h5>
      <a href="" class="active">👤 User Info</a>
      <a href="index.php" class="text-danger mt-5">Close</a>
    </div>

    <!-- Main content -->
    <div class="col-12 col-md-9 col-lg-10 p-4">
      <?php
        $hakAkses = $_SESSION['hak'];
        $sql = "SELECT * FROM admin WHERE id_admin='$hakAkses'";
        $eksekusi = mysqli_query($koneksi, $sql);
        while ($data = mysqli_fetch_assoc($eksekusi)) {
      ?>
      <div class="text-center mb-4">
        <img src="../assets/img/<?php echo $data['foto']; ?>" alt="Foto Profil" class="profile-pic mb-2">
        <h4 class="fw-bold">Admin</h4>
      </div>

      <form class="row g-3" action="proseseditPP.php" method="POST">
        <div class="col-md-6">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password">
        </div>

        <div class="col-md-6">
          <label class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" name="confirmPassword">
        </div>

        <input type="submit" value="Edit Data" class="form-control btn save-btn">
      </form>
      <?php } ?>
    </div>
  </div>
</div>

</body>
</html>
