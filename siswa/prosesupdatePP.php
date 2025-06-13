<?php
session_start();
include "../service/koneksi.php";

// Ambil ID siswa dari sesi login
$id_siswa = $_SESSION['id_siswa'];

// Ambil data dari form
$nama = $_POST['nama'];
$id_jurusan = $_POST['jurusan'];           // Langsung ambil ID (1–4)
$jenis_kelamin = $_POST['jenis_kelamin'];  // Langsung ambil "L" atau "P"
$kelas = $_POST['kelas'];
$alamat = $_POST['alamat'];

// Validasi sederhana (optional tapi bagus)
if (!$id_jurusan || !$jenis_kelamin) {
    echo "<script>alert('Jurusan atau Jenis Kelamin tidak valid'); window.location='pp-siswa.php';</script>";
    exit;
}

// Proses update ke database
$sql = "UPDATE siswa SET 
            nama='$nama',
            id_jurusan='$id_jurusan',
            jenis_kelamin='$jenis_kelamin',
            kelas='$kelas',
            alamat='$alamat'
        WHERE id_siswa='$id_siswa'";

$eksekusi = mysqli_query($koneksi, $sql);

// Feedback ke user
if ($eksekusi) {
    echo "<script>alert('Data berhasil diubah'); window.location='pp-siswa.php';</script>";
} else {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>
