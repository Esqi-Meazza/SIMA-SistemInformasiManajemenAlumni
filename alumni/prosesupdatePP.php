<?php
session_start();
include "../service/koneksi.php";

$id_alumni = $_SESSION['id_alumni'];

$nama = $_POST['nama'];
$angkatan = $_POST['angkatan'];
$jenis_kelamin = $_POST['jenis_kelamin']; // Sudah 'L' atau 'P' langsung
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$pekerjaan = $_POST['pekerjaan'];
$alamat = $_POST['alamat'];

// Validasi jenis kelamin
if ($jenis_kelamin != 'L' && $jenis_kelamin != 'P') {
    echo "<script>alert('Jenis Kelamin tidak valid'); window.location='pp-alumni.php';</script>";
    exit;
}

$sql = "UPDATE alumni SET 
          nama='$nama',
          angkatan='$angkatan',
          jenis_kelamin='$jenis_kelamin',
          tempat_lahir='$tempat_lahir',
          tanggal_lahir='$tanggal_lahir',
          pekerjaan='$pekerjaan',
          alamat='$alamat'
        WHERE id_alumni='$id_alumni'";

$eksekusi = mysqli_query($koneksi, $sql);

if ($eksekusi) {
    echo "<script>alert('Data berhasil diubah'); window.location='pp-alumni.php';</script>";
} else {
    die("Query gagal: " . mysqli_error($koneksi));
}
