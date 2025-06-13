<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../service/koneksi.php';

// Ambil semua data alumni + jurusan
$query = "SELECT a.*, j.nama_jurusan 
          FROM alumni a 
          LEFT JOIN jurusan j ON a.id_jurusan = j.id_jurusan 
          ORDER BY a.nama ASC";
$result = mysqli_query($koneksi, $query);

// Ambil semua data jurusan untuk filter
$jurusan_query = "SELECT id_jurusan, nama_jurusan FROM jurusan ORDER BY nama_jurusan ASC";
$jurusan_result = mysqli_query($koneksi, $jurusan_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Alumni</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
  .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    h1 {
      color: #2c3e50;
      text-align: center;
      margin: 20px 0 30px;
      padding-bottom: 15px;
      border-bottom: 2px solid #a145df;
    }

    .search-container {
      margin-bottom: 30px;
      display: flex;
      justify-content: center;
    }

    .search-box {
      width: 100%;
      max-width: 500px;
      position: relative;
    }

    .search-box input {
      width: 100%;
      padding: 10px 15px;
      border: 2px solid #a145df;
      border-radius: 25px;
      font-size: 1rem;
      outline: none;
    }

    .search-box i {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #a145df;
    }

    .alumni-list {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 15px;
      margin-bottom: 30px;
    }

    .alumni-item {
      display: block;
      background:  #a145df;
      color: white;
      padding: 15px;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.3s;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .alumni-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      background:  #7831a7;
    }

    .alumni-name {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .alumni-meta {
      font-size: 0.9rem;
      opacity: 0.9;
      display: flex;
      justify-content: space-between;
    }

    .alumni-detail-box {
      display: none;
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-top: 20px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .alumni-detail-box:target {
      display: block;
    }

    .detail-header {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
      align-items: center;
      border-bottom: 1px solid #eee;
      padding-bottom: 15px;
    }

    .alumni-photo {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #a145df;
    }

    .detail-info h2 {
      color: #2c3e50;
      margin-bottom: 5px;
    }

    .detail-meta {
      color: #7f8c8d;
      font-size: 0.9rem;
    }

    .detail-body {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .biodata-section, .loker-section {
      background: #f8f9fa;
      padding: 15px;
      border-radius: 5px;
    }

    .section-title {
      color:  #a145df;
      margin-bottom: 10px;
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .biodata-table {
      width: 100%;
    }

    .biodata-table tr td {
      padding: 8px 0;
      border-bottom: 1px dashed #eee;
    }

    .biodata-table tr td:first-child {
      font-weight: 500;
      color: #7f8c8d;
      width: 40%;
    }

    .loker-item {
      background: white;
      border-left: 3px solid  #a145df;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 0 5px 5px 0;
    }

    .loker-position {
      font-weight: 600;
      color:  #a145df;
      margin-bottom: 5px;
    }

    .loker-company {
      font-size: 0.9rem;
      color: #7f8c8d;
      margin-bottom: 8px;
    }

    .loker-desc {
      font-size: 0.9rem;
      margin-bottom: 10px;
      color: #555;
    }

    .loker-meta {
      display: flex;
      justify-content: space-between;
      font-size: 0.8rem;
      color: #95a5a6;
    }

    .no-loker {
      background: #fef9e7;
      color: #f39c12;
      padding: 10px;
      border-radius: 4px;
      font-size: 0.9rem;
      text-align: center;
    }

    @media (max-width: 992px) {
      .alumni-list {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .alumni-list {
        grid-template-columns: 1fr;
      }

      .detail-body {
        grid-template-columns: 1fr;
      }

      .detail-header {
        flex-direction: column;
        text-align: center;
      }
    }
    .alumni-detail-box { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; margin-top: 20px; }
    .alumni-photo { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #a145df; }
    .section-title { font-weight: bold; color: #a145df; margin-bottom: 10px; }
    .biodata-table td { padding: 5px; }
  </style>
</head>
<body>
  <div class="container mt-4">
    <h1 class="text-center mb-4">Daftar Alumni</h1>

    <!-- Search and Filter -->
    <div class="row mb-4">
      <div class="col-md-6">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari alumni...">
      </div>
      <div class="col-md-6">
        <select id="filterJurusan" class="form-select">
          <option value="">Semua Jurusan</option>
          <?php while ($jurusan = mysqli_fetch_assoc($jurusan_result)) {
            echo '<option value="' . htmlspecialchars($jurusan['nama_jurusan']) . '">' . htmlspecialchars($jurusan['nama_jurusan']) . '</option>';
          } ?>
        </select>
      </div>
    </div>

    <!-- List Alumni -->
    <div class="row" id="alumniList">
      <?php mysqli_data_seek($result, 0); while ($alumni = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 alumni-item mb-3" data-jurusan="<?php echo htmlspecialchars($alumni['nama_jurusan'] ?? ''); ?>">
          <div class="card">
            <div class="card-body">
              <div class="d-flex gap-3">
                <?php if (!empty($alumni['foto'])): ?>
                  <img src="../assets/img/<?php echo htmlspecialchars($alumni['foto']); ?>" alt="Foto" class="alumni-photo">
                <?php else: ?>
                  <div class="alumni-photo d-flex justify-content-center align-items-center bg-light">
                    <i class="bi bi-person fs-2 text-muted"></i>
                  </div>
                <?php endif; ?>
                <div>
                  <h5><?php echo htmlspecialchars($alumni['nama']); ?></h5>
                  <p class="mb-1"><?php echo htmlspecialchars($alumni['nama_jurusan']); ?> | Angkatan <?php echo $alumni['angkatan']; ?></p>
                  <p class="mb-2"><?php echo htmlspecialchars($alumni['pekerjaan']); ?></p>
                  <a href="#detail-<?php echo $alumni['id_alumni']; ?>" class="btn btn-outline-primary btn-sm">Detail</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Detail Box (Hidden until scrolled to) -->
        <div id="detail-<?php echo $alumni['id_alumni']; ?>" class="alumni-detail-box">
          <div class="d-flex gap-4 align-items-center mb-3">
            <?php if (!empty($alumni['foto'])): ?>
              <img src="../assets/img/<?php echo htmlspecialchars($alumni['foto']); ?>" alt="Foto" class="alumni-photo">
            <?php endif; ?>
            <div>
              <h4><?php echo htmlspecialchars($alumni['nama']); ?></h4>
              <p><?php echo htmlspecialchars($alumni['nama_jurusan']); ?> | Angkatan <?php echo $alumni['angkatan']; ?></p>
              <p><?php echo htmlspecialchars($alumni['pekerjaan']); ?></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="section-title">Biodata</div>
              <table class="table table-borderless biodata-table">
                <tr><td>Email</td><td><?php echo htmlspecialchars($alumni['email']); ?></td></tr>
                <tr><td>Tempat Lahir</td><td><?php echo htmlspecialchars($alumni['tempat_lahir']); ?></td></tr>
                <tr><td>Tanggal Lahir</td><td><?php echo htmlspecialchars($alumni['tanggal_lahir']); ?></td></tr>
                <tr><td>Alamat</td><td><?php echo htmlspecialchars($alumni['alamat']); ?></td></tr>
              </table>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- Script -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Filter pencarian
    $('#searchInput').on('keyup', function() {
      const text = $(this).val().toLowerCase();
      $('.alumni-item').each(function() {
        const content = $(this).text().toLowerCase();
        $(this).toggle(content.includes(text));
      });
    });

    // Filter jurusan
    $('#filterJurusan').on('change', function() {
      const selected = $(this).val();
      $('.alumni-item').each(function() {
        const jurusan = $(this).data('jurusan');
        $(this).toggle(selected === '' || jurusan === selected);
      });
    });
  </script>
</body>
</html>
