<?php
require_once '../service/koneksi.php';
// require_once '../includes/auth.php';

$title = 'Kelola Alumni';
$page = 'alumni';

// Get all jurusan for dropdown
$jurusan = query("SELECT * FROM jurusan ORDER BY nama");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $tahun_lulus = $_POST['tahun_lulus'];
    $jurusan_id = $_POST['jurusan_id'];
    $pekerjaan = $_POST['pekerjaan'];
    $perusahaan = $_POST['perusahaan'];
    
    // Handle file upload
    $foto = $_FILES['foto'];
    $foto_name = null;
    
    if ($foto['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $foto_name = uniqid() . '.' . $ext;
        move_uploaded_file($foto['tmp_name'], '../assets/uploads/' . $foto_name);
    }
    
    if ($id > 0) {
        // Update existing alumni
        $sql = "UPDATE alumni SET 
                nama = ?, 
                jenis_kelamin = ?, 
                alamat = ?, 
                email = ?, 
                telepon = ?, 
                tahun_lulus = ?, 
                jurusan_id = ?, 
                pekerjaan = ?, 
                perusahaan = ?";
        
        $params = [$nama, $jenis_kelamin, $alamat, $email, $telepon, $tahun_lulus, $jurusan_id, $pekerjaan, $perusahaan];
        
        if ($foto_name) {
            $sql .= ", foto = ?";
            $params[] = $foto_name;
        }
        
        $sql .= " WHERE id = ?";
        $params[] = $id;
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
        
        $_SESSION['message'] = 'Alumni berhasil diperbarui';
    } else {
        // Insert new alumni
        $sql = "INSERT INTO alumni (nama, jenis_kelamin, alamat, email, telepon, tahun_lulus, jurusan_id, pekerjaan, perusahaan, foto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssisss', $nama, $jenis_kelamin, $alamat, $email, $telepon, $tahun_lulus, $jurusan_id, $pekerjaan, $perusahaan, $foto_name);
        $stmt->execute();
        
        $_SESSION['message'] = 'Alumni berhasil ditambahkan';
    }
    
    header('Location: alumni.php');
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM alumni WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    
    $_SESSION['message'] = 'Alumni berhasil dihapus';
    header('Location: alumni.php');
    exit();
}

// Get all alumni
$alumni = query("SELECT a.*, j.nama as jurusan_nama FROM alumni a JOIN jurusan j ON a.jurusan_id = j.id ORDER BY a.nama");

// Get alumni for edit
$edit_alumni = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = query("SELECT * FROM alumni WHERE id = $id");
    $edit_alumni = $result->fetch_assoc();
}
?>
<!-- <?php include '../includes/header.php'; ?> -->

<main class="container py-4">
    <h1 class="mb-4">Kelola Data Alumni</h1>
    
    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <h5><?= $edit_alumni ? 'Edit Alumni' : 'Tambah Alumni Baru'; ?></h5>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $edit_alumni['id'] ?? 0; ?>">
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required 
                               value="<?= htmlspecialchars($edit_alumni['nama'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki" <?= isset($edit_alumni) && $edit_alumni['jenis_kelamin'] === 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?= isset($edit_alumni) && $edit_alumni['jenis_kelamin'] === 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required 
                               value="<?= htmlspecialchars($edit_alumni['email'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" 
                               value="<?= htmlspecialchars($edit_alumni['telepon'] ?? ''); ?>">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                        <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" required 
                               value="<?= $edit_alumni['tahun_lulus'] ?? ''; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="jurusan_id" class="form-label">Jurusan</label>
                        <select class="form-select" id="jurusan_id" name="jurusan_id" required>
                            <option value="">Pilih Jurusan</option>
                            <?php while($row = $jurusan->fetch_assoc()): ?>
                            <option value="<?= $row['id']; ?>" 
                                <?= isset($edit_alumni) && $edit_alumni['jurusan_id'] == $row['id'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($row['nama']); ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" 
                               value="<?= htmlspecialchars($edit_alumni['pekerjaan'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="perusahaan" class="form-label">Perusahaan</label>
                        <input type="text" class="form-control" id="perusahaan" name="perusahaan" 
                               value="<?= htmlspecialchars($edit_alumni['perusahaan'] ?? ''); ?>">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= htmlspecialchars($edit_alumni['alamat'] ?? ''); ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                    <?php if (isset($edit_alumni) && $edit_alumni['foto']): ?>
                    <div class="mt-2">
                        <img src="../assets/uploads/<?= $edit_alumni['foto']; ?>" alt="Foto Alumni" style="max-width: 150px;">
                    </div>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
                <?php if ($edit_alumni): ?>
                <a href="alumni.php" class="btn btn-secondary">Batal</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5>Daftar Alumni</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="alumniTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Tahun Lulus</th>
                            <th>Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while($row = $alumni->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['jurusan_nama']); ?></td>
                            <td><?= $row['tahun_lulus']; ?></td>
                            <td><?= htmlspecialchars($row['pekerjaan'] ?? '-'); ?></td>
                            <td>
                                <a href="alumni.php?edit=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="alumni.php?delete=<?= $row['id']; ?>" class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus alumni ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- <?php include '../includes/footer.php'; ?> -->