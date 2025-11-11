<?php
// File: koneksi.php
$host = "localhost";
$user = "root"; 
$pass = ""; // Kosongkan jika tidak ada password
$db   = "simaaa"; // Sesuaikan dengan nama database yang benar

// Membuat koneksi (gunakan nama variabel $conn untuk konsistensi)
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset
if (!mysqli_set_charset($koneksi, "utf8")) {
    die("Error setting character set: " . mysqli_error($conn));
}
?>