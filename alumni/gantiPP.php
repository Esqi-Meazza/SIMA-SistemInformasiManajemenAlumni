<?php
session_start();
include "../service/koneksi.php";

$id = $_SESSION['id_alumni'];
$foto = $_FILES['foto']['name'];

if ($foto != '') {
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($ekstensi, $allowed)) {
        $rand = rand(1, 999);
        $namaBaru = $rand . '-' . date('YmdHis') . '.' . $ekstensi;
        $tmp = $_FILES['foto']['tmp_name'];

        // Hapus foto lama
        $getFoto = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM alumni WHERE id_alumni='$id'"));
        if ($getFoto['foto'] != '' && file_exists("../assets/img/" . $getFoto['foto'])) {
            unlink("../assets/img/" . $getFoto['foto']);
        }

        move_uploaded_file($tmp, "../assets/img/" . $namaBaru);
        mysqli_query($koneksi, "UPDATE alumni SET foto='$namaBaru' WHERE id_alumni='$id'");
    }
}

header("Location: pp-alumni.php");
