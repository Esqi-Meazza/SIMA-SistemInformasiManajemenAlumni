<!-- yang dari teteh -->

<?php
    session_start();
    include '../service/koneksi.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hakAkses = $_POST['status'];

    echo $hakAkses;
    
    if($hakAkses == 1 ){ // angka 1 untuk admin
        $sql = mysqli_query($koneksi, "SELECT * FROM admin WHERE  username='$username' AND password='$password'");
        $jumlahData = mysqli_num_rows($sql);
        $_SESSION['username'] = $username;
        $_SESSION['hak'] = $hakAkses;
        if($jumlahData > 0 ){
            $data = mysqli_fetch_assoc($sql); // ambil data admin
            $_SESSION['id_admin'] = $data['id_admin']; 
            $_SESSION['pesan'] = "";
            $_SESSION['loggedin'] = true;
            header("location:../admin/index.php");
}

        else{
             $_SESSION['pesan'] = "Username atau password salah !";
            header("location:index.php");
        }
       
    }else if($hakAkses == 2 ){ // angka 2 untuk alumni
    $sql = mysqli_query($koneksi, "SELECT * FROM alumni WHERE nama='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($sql);
    $jumlahData = mysqli_num_rows($sql);

    if($jumlahData > 0 ){
        $_SESSION['username'] = $data['nama'];
        $_SESSION['id_alumni'] = $data['id_alumni']; // <- SIMPAN id_alumni
        $_SESSION['hak'] = $hakAkses;
        $_SESSION['pesan'] = "";
        $_SESSION['loggedin'] = true;
        header("location:../alumni/index.php");
    }else{
        $_SESSION['pesan'] = "Username atau password salah !";
        header("location:index.php");
    }


    } else if($hakAkses == 3 ){ // angka 3 untuk siswa
    $sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nama='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($sql);
    $jumlahData = mysqli_num_rows($sql);

    if($jumlahData > 0 ){
        $_SESSION['username'] = $data['nama'];
        $_SESSION['id_siswa'] = $data['id_siswa']; // <- TAMBAHKAN INI
        $_SESSION['hak'] = $hakAkses;
        $_SESSION['pesan'] = "";
        $_SESSION['loggedin'] = true;
        header("location:../siswa/index.php");
    } else {
        $_SESSION['pesan'] = "Username atau password salah !";
        header("location:index.php");
    }
}
?>
