<?php
session_start();
include "../service/koneksi.php";

$username   = $_POST['username'];
$email      = $_POST['email'];
$password   = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$hakAkses   = $_SESSION['hak'];

if ($password === $confirmPassword) {
    if (!empty($password)) {
        // update semuanya termasuk password
        $sql = "UPDATE admin SET username='$username', email='$email', password='$password' WHERE id_admin='$hakAkses'";
    } else {
        // update tanpa password
        $sql = "UPDATE admin SET username='$username', email='$email' WHERE id_admin='$hakAkses'";
    }

    $eksekusi = mysqli_query($koneksi, $sql);
    if ($eksekusi) {
        echo "<script>alert('Data berhasil diubah.'); window.location='pp-admin.php';</script>";
    } else {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }
} else {
    echo "<script>alert('Password tidak sama!'); window.location='pp-admin.php';</script>";
}
?>
