<?php
// Mulai session dan include koneksi di awal file
session_start();
require_once '../service/koneksi.php';

// Cek jika user sudah login
if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true){
    header("Location:../siswa/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMA - Registrasi Siswa</title>
    <link rel="stylesheet" href="style.css">
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
                <form class="register-form" method="POST" action="prosesregister.php" enctype="multipart/form-data">
                    <h2>Registrasi Siswa</h2>
                    <?php 
                        if(isset($_SESSION['pesan'])): 
                    ?>
                            <div class="error-message"><?= htmlspecialchars($_SESSION['pesan']); ?></div>
                    <?php 
                            unset($_SESSION['pesan']);
                        endif; 
                    ?>
                    
                    <?php 
                        if(isset($_SESSION['pesan_sukses'])): 
                    ?>
                            <div class="success-message"><?= htmlspecialchars($_SESSION['pesan_sukses']); ?></div>
                    <?php 
                            unset($_SESSION['pesan_sukses']);
                        endif; 
                    ?>
                    
                    <div class="form-group">
                        <input type="text" class="form-input" name="nama" placeholder="Nama Lengkap" required>
                        <span class="input-icon username-icon"></span>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-input" name="email" placeholder="Email" required>
                        <span class="input-icon username-icon"></span>
                    </div>

                    <div class="form-group">
                        <select class="form-input" name="id_jurusan" required>
                            <option value="">Pilih Jurusan</option>
                            <option value="1">RPL</option>
                            <option value="2">TKJ</option>
                            <option value="3">DKV</option>
                            <option value="4">Animasi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-input" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-input" name="kelas" placeholder="kelas" required>
                        <span class="input-icon username-icon"></span>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-input" name="password" placeholder="Password" required>
                        <span class="input-icon password-icon"></span>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-input" name="confirm_password" placeholder="Konfirmasi Password" required>
                        <span class="input-icon password-icon"></span>
                    </div>

                    <div class="form-group">
                        <label for="foto" class="file-label">Foto Profil (Opsional)</label>
                        <input type="file" class="file-input" name="foto" id="foto" accept="image/jpeg,image/jpg,image/png,image/gif">
                        <div class="preview-container" id="preview-container" style="display: none;">
                            <img id="preview-image" class="preview-image" src="#" alt="Preview Gambar"/>
                            <div id="preview-text" class="preview-text"></div>
                        </div>
                    </div>

                    <button type="submit" class="login-btn">Daftar</button>

                    <div class="register-link">
                        Sudah punya akun? <a href="../login/index.php">Login disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Preview gambar sebelum upload
        document.getElementById('foto').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            const previewText = document.getElementById('preview-text');
            
            if (this.files && this.files[0]) {
                const file = this.files[0];
                
                // Validasi ukuran file (max 2MB)
                if (file.size > 2097152) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    this.value = '';
                    previewContainer.style.display = 'none';
                    return;
                }
                
                // Validasi tipe file
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF.');
                    this.value = '';
                    previewContainer.style.display = 'none';
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.style.display = 'block';
                    previewImage.src = e.target.result;
                    previewText.textContent = file.name;
                    previewContainer.style.display = 'block';
                };
                
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    </script>
</body>
</html>