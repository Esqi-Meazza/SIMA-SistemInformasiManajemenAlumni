<?php
session_start();
include '../../service/koneksi.php';

// Ambil daftar jurusan untuk dropdown
$jurusan_query = "SELECT id_jurusan, nama_jurusan FROM jurusan ORDER BY nama_jurusan ASC";
$jurusan_result = mysqli_query($koneksi, $jurusan_query);

$jurusan_options = "";
if ($jurusan_result && mysqli_num_rows($jurusan_result) > 0) {
    while ($row = mysqli_fetch_assoc($jurusan_result)) {
        $jurusan_options .= "<option value='" . $row['id_jurusan'] . "'>" . htmlspecialchars($row['nama_jurusan']) . "</option>";
    }
}

$message = '';
$message_type = '';

// Proses form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan admin sudah login
    if (!isset($_SESSION['id_admin'])) {
        die("Admin belum login.");
    }

    $id_admin = $_SESSION['id_admin'];
    $id_jurusan = mysqli_real_escape_string($koneksi, $_POST['id_jurusan']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $pekerjaan = mysqli_real_escape_string($koneksi, $_POST['pekerjaan']);
    $angkatan = mysqli_real_escape_string($koneksi, $_POST['angkatan']);
    $foto = '';

    // Upload foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "../assets/img";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($imageFileType, $allowed_types)) {
            $message = "Maaf, hanya file JPG, JPEG, PNG, & GIF yang diizinkan.";
            $message_type = "danger";
        } elseif ($_FILES['foto']['size'] > 500000) {
            $message = "Maaf, ukuran file Anda terlalu besar.";
            $message_type = "danger";
        } else {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $foto = $new_file_name;
            } else {
                $message = "Terjadi kesalahan saat mengunggah file.";
                $message_type = "danger";
            }
        }
    }

    if (empty($message)) {
        // Query simpan alumni
        $sql = "INSERT INTO alumni (
                    id_admin, id_jurusan, nama, jenis_kelamin, email,
                    alamat, foto, password, tempat_lahir, tanggal_lahir,
                    pekerjaan, angkatan
                ) VALUES (
                    '$id_admin', '$id_jurusan', '$nama', '$jenis_kelamin', '$email',
                    '$alamat', '$foto', '$password', '$tempat_lahir', '$tanggal_lahir',
                    '$pekerjaan', '$angkatan'
                )";

        if (mysqli_query($koneksi, $sql)) {
            $_SESSION['message'] = "Data alumni berhasil ditambahkan!";
            $_SESSION['message_type'] = "success";
            header("Location: adminpanel.php");
            exit();
        } else {
            $message = "Error: " . mysqli_error($koneksi);
            $message_type = "danger";
        }
    }
}
?>

<!-- HTML FORM -->
<div class="container mx-auto p-4 mt-8">
    <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Tambah Alumni Baru</h2>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-lg p-6 card">
        <form action="alumni_create.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama Lengkap:</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir:</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="form-label">Alamat:</label>
                        <textarea id="alamat" name="alamat" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="pekerjaan" class="form-label">Pekerjaan:</label>
                        <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="angkatan" class="form-label">Angkatan:</label>
                        <input type="number" id="angkatan" name="angkatan" min="1900" max="2099" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="id_jurusan" class="form-label">Jurusan:</label>
                        <select id="id_jurusan" name="id_jurusan" class="form-select" required>
                            <option value="">Pilih Jurusan</option>
                            <?php echo $jurusan_options; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="foto" class="form-label">Foto Profil:</label>
                <input type="file" id="foto" name="foto" class="form-control">
                <div class="form-text">Ukuran maksimal 500KB. Format: JPG, JPEG, PNG, GIF</div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan
                </button>
                <a href="adminpanel.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
