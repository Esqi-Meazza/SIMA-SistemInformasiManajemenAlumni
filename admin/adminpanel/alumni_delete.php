<?php
include '../../service/koneksi.php';
session_start();

// Cek apakah user sudah login dan memiliki role admin
if (!isset($_SESSION['loggedin']) || $_SESSION['hak'] != 1) {
    header("Location: ../login/index.php");
    exit;}

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Ambil data foto untuk dihapus
    $query = "SELECT foto FROM alumni WHERE id_alumni = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Hapus foto jika ada
    if ($row && !empty($row['foto'])) {
        $file_path = "../assets/img" . $row['foto'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    
    // Hapus data dari database
    $delete_query = "DELETE FROM alumni WHERE id_alumni = $id";
    if (mysqli_query($koneksi, $delete_query)) {
        $_SESSION['message'] = "Data alumni berhasil dihapus!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($koneksi);
        $_SESSION['message_type'] = "danger";
    }
} else {
    $_SESSION['message'] = "ID tidak valid!";
    $_SESSION['message_type'] = "danger";
}

header("Location: adminpanel.php");
exit();
?>