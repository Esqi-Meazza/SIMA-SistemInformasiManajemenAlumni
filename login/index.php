<?php
    // Mulai session dan include koneksi di awal file
    session_start();
    require_once '../service/koneksi.php';

    // Cek jika user sudah login
    if(isset($_SESSION['hak']) == 1 && isset( $_SESSION['loggedin']) === true){
        header("Location:../admin/index.php");
    } else if(isset($_SESSION['hak']) == 2 && isset( $_SESSION['loggedin']) === true){
        header("Location:../alumni/index.php");
    }else if(isset($_SESSION['hak']) == 3 && isset( $_SESSION['loggedin']) === true){
        header("Location:../siswa/index.php");
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMA - Login</title>
    <link rel="stylesheet" href="styles.css"/>    
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="logo">SIMA</div>
            <div class="illustration">
                <div class="background-card"></div>
                <div class="main-card">
                    <div class="profile-section">
                        <div class="profile-icon"></div>
                        <div class="checkmark"></div>
                    </div>
                    <div class="card-lines">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="lock"></div>
                <div class="key"></div>
            </div>
        </div>

        <div class="right-section">
            <div class="wrapper">
                <form class="login-form" method="POST" action="proseslogin.php">
                    <h2>Log in</h2>
                    <?php 
                        if(isset($_SESSION['pesan'])): 
                    ?>
                            <div class="error-message"><?= htmlspecialchars($_SESSION['pesan']); ?></div>
                    <?php 
                                unset($_SESSION['pesan']);
                        endif; 
                    ?>
                    <div class="form-group">
                        <input type="text" class="form-input" name="username" placeholder="Username" required>
                        <span class="input-icon username-icon"></span>
                    </div>
    
                    <div class="form-group">
                        <input type="password" class="form-input" name="password" placeholder="Password" required>
                        <span class="input-icon password-icon"></span>
                    </div>
    
                    <div class="form-group">
                        <select class="form-input" name="status" required>
                            <option value=""> Pilih Status </option>
                            <option value="1">Admin</option>
                            <option value="2">Alumni</option>
                            <option value="3">Siswa</option>
                        </select>
                    </div>
    
                    <button type="submit" class="login-btn">Log in</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>