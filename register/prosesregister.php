<?php
session_start();
require_once '../service/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $id_jurusan = $_POST['id_jurusan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas = trim($_POST['kelas']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input dasar
    if ( empty($nama) || empty($email) || empty($id_jurusan) || empty($password) || empty($confirm_password) || empty($jenis_kelamin) || empty($kelas)) {
        $_SESSION['pesan'] = "Semua field wajib diisi!";
        header("Location: index.php");
        exit();
    }

    // Validasi email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['pesan'] = "Format email tidak valid!";
        header("Location: index.php");
        exit();
    }

    // Validasi password
    if ($password !== $confirm_password) {
        $_SESSION['pesan'] = "Password dan konfirmasi password tidak cocok!";
        header("Location: index.php");
        exit();
    }

    // Validasi kekuatan password (minimal 8 karakter)
    if (strlen($password) < 8) {
        $_SESSION['pesan'] = "Password minimal 8 karakter!";
        header("Location: index.php");
        exit();
    }

    // Validasi id_jurusan (harus berupa angka dan ada di database)
    if (!is_numeric($id_jurusan) || $id_jurusan < 1 || $id_jurusan > 4) {
        $_SESSION['pesan'] = "Pilihan jurusan tidak valid!";
        header("Location: index.php");
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle upload foto
    $foto = null; // Default null jika tidak ada foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['foto']['tmp_name'];
        $file_name = $_FILES['foto']['name'];
        $file_size = $_FILES['foto']['size'];
        $file_type = $_FILES['foto']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        
        // Validasi ekstensi file
        if (!in_array($file_ext, $allowed_ext)) {
            $_SESSION['pesan'] = "Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF.";
            header("Location: index.php");
            exit();
        }
        
        // Validasi MIME type
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['pesan'] = "Tipe file tidak valid.";
            header("Location: index.php");
            exit();
        }
        
        // Validasi ukuran file (max 2MB)
        if ($file_size > 2097152) {
            $_SESSION['pesan'] = "Ukuran file terlalu besar. Maksimal 2MB.";
            header("Location: index.php");
            exit();
        }
        
        // Pastikan direktori upload ada
        $upload_dir = '../uploads/siswa/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        // Generate nama file unik
        $new_file_name = uniqid('siswa_', true) . '.' . $file_ext;
        $upload_path = $upload_dir . $new_file_name;
        
        // Upload file
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $foto = $new_file_name;
        } else {
            $_SESSION['pesan'] = "Gagal mengupload foto.";
            header("Location: index.php");
            exit();
        }
    }

    // Cek apakah nama atau email sudah ada di tabel siswa
    $check_query = "SELECT * FROM siswa WHERE nama = ? OR email = ?";
    $stmt = $koneksi->prepare($check_query);
    
    if (!$stmt) {
        $_SESSION['pesan'] = "Terjadi kesalahan sistem. Silakan coba lagi.";
        header("Location: index.php");
        exit();
    }
    
    $stmt->bind_param("ss", $nama, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $existing_user = $result->fetch_assoc();
        if ($existing_user['nama'] === $nama) {
            $_SESSION['pesan'] = "nama sudah terdaftar!";
        } else {
            $_SESSION['pesan'] = "Email sudah terdaftar!";
        }
        header("Location: index.php");
        exit();
    }

    // Validasi apakah jurusan exists di tabel jurusan
    $check_jurusan_query = "SELECT id_jurusan FROM jurusan WHERE id_jurusan = ?";
    $stmt_jurusan = $koneksi->prepare($check_jurusan_query);
    
    if (!$stmt_jurusan) {
        $_SESSION['pesan'] = "Terjadi kesalahan sistem. Silakan coba lagi.";
        header("Location: index.php");
        exit();
    }
    
    $stmt_jurusan->bind_param("i", $id_jurusan);
    $stmt_jurusan->execute();
    $result_jurusan = $stmt_jurusan->get_result();

    if ($result_jurusan->num_rows == 0) {
        $_SESSION['pesan'] = "Jurusan yang dipilih tidak valid!";
        header("Location: index.php");
        exit();
    }

    // Insert data ke tabel siswa (sesuai struktur database)
    $insert_query = "INSERT INTO siswa (id_jurusan, nama, jenis_kelamin, email, kelas, foto, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($insert_query);
    
    if (!$stmt) {
        $_SESSION['pesan'] = "Terjadi kesalahan sistem. Silakan coba lagi.";
        header("Location: index.php");
        exit();
    }
    
    // Set alamat sebagai empty string atau NULL
    $stmt->bind_param("issssss", $id_jurusan, $nama, $jenis_kelamin, $email, $kelas, $foto, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['pesan_sukses'] = "Registrasi berhasil! Silakan login.";
        header("Location: ../login/index.php");
        exit();
    } else {
        $_SESSION['pesan'] = "Registrasi gagal. Silakan coba lagi.";
        header("Location: index.php");
        exit();
    }
    
    $stmt->close();
    $stmt_jurusan->close();
    $koneksi->close();
} else {
    header("Location: index.php");
    exit();
}
?>