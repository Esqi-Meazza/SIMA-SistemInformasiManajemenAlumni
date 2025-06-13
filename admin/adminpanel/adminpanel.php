<?php
include '../../service/koneksi.php';
session_start();

// Cek apakah user sudah login dan memiliki role admin
if (!isset($_SESSION['loggedin']) || $_SESSION['hak'] != 1) {
    header("Location: ../login/index.php");
    exit;}

// Query untuk mendapatkan data alumni
$query = "SELECT a.*, j.nama_jurusan 
          FROM alumni a 
          LEFT JOIN jurusan j ON a.id_jurusan = j.id_jurusan 
          ORDER BY a.nama ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Account Management</title>
    <link rel="stylesheet" href="../../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <style>
        /* =============== MAIN CONTENT =============== */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            color: #a145df;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #a145df;
        }
        
        h2 {
            color: #a145df;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
        
        /* =============== BUTTON STYLES =============== */
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background: #a145df;
            color: white;
        }
        
        .btn-primary:hover {
            background: #8c3ac2;
        }
        
        .btn-success {
            background: #a145df;
            color: white;
        }
        
        .btn-success:hover {
            background: #8c3ac2;
        }
        
        /* =============== ACCOUNT TABLE STYLES =============== */
        .account-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .account-table th {
            background: #a145df;
            color: white;
            text-align: left;
            padding: 12px 15px;
            font-weight: 500;
        }
        
        .account-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .account-table tr:hover {
            background-color: #f8f9fa;
        }
        
        .account-status {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #2ecc71;
            color: white;
            text-align: center;
            line-height: 20px;
            font-size: 0.7rem;
            margin-right: 5px;
        }
        
        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 0.8rem;
            margin-right: 5px;
            transition: all 0.2s;
        }
        
        .edit-btn {
            background-image: linear-gradient(90deg, rgba(24, 232, 247, 1) 0%, rgba(27, 228, 30, 1) 100%);
            color: black;
            transition: background-image 0.3s ease;
        }

        .edit-btn:hover {
            background-image: linear-gradient(90deg, rgb(15, 136, 145) 0%, rgb(15, 128, 16) 100%);
        }

        .delete-btn {
          background: linear-gradient(90deg, rgba(247, 25, 136, 1) 0%, rgba(25, 136, 247, 1) 100%);
          color: white;
          transition: background-image 0.3s ease;
        }
        
        .delete-btn:hover {
          background: linear-gradient(90deg, rgb(153, 16, 84) 0%, rgb(14, 77, 141) 100%);
        }
        /* =============== MODAL STYLES =============== */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 25px;
            border-radius: 8px;
            width: 50%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            animation: modalopen 0.3s;
        }
        
        @keyframes modalopen {
            from {opacity: 0; transform: translateY(-50px);}
            to {opacity: 1; transform: translateY(0);}
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .modal-header h3 {
            color: #2c3e50;
            margin: 0;
        }
        
        .close-btn {
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close-btn:hover {
            color: #333;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }
        
        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        
        .form-actions button {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-gradient-custom py-3">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-purple" href="#">SIMA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center me-3 gap-4">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold active" href="adminpanel/index.php">Admin Panel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="../daftaralumni.php">Daftar Alumni</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="admin" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="../pp-admin.php">Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../../logout.php">Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">ADMIN PANEL</h1>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Account Management</h2>
            <a href="alumni_create.php" class="btn btn-primary">Tambah Alumni</a>
        </div>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="accountTable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Jenis Kelamin</th>
                        <th>Angkatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id_alumni']; ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_jurusan'] ?? '-'); ?></td>
                            <td><?php echo $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                            <td><?php echo $row['angkatan']; ?></td>
                            <td>
                                <a href="alumni_edit.php?id=<?php echo $row['id_alumni']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="alumni_delete.php?id=<?php echo $row['id_alumni']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#accountTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                }
            });
        });
    </script>
</body>
</html>

    