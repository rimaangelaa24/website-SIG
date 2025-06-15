<?php
session_start();
include '../../config/konek.php';

if (!isset($_GET['id'])) {
    header("Location: galeri.php");
    exit();
}

$id = $conn->real_escape_string($_GET['id']);
$sql = "SELECT * FROM tbl_galeri WHERE id = '$id'";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    header("Location: galeri.php");
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Data Galeri</title>
    <link href="../../assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        body {
            background-color: black;
        }
        p, label {
            color: white;
        }
        .thumbnail-img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Admin navbar">
            <div class="container-xl d-flex justify-content-center align-items-center">
                <a class="navbar-brand" id="logonavbar" href="#">
                    <img draggable="false" src="../../gambar/bz.png" width="50" height="50" alt="bz" />
                    <img draggable="false" src="../../gambar/ppik.png" width="50" height="50" alt="ppik" />
                </a>
                <a class="navbar-brand fw-bolder" id="textnavbar">
                    GPPIK <span class="lighttext"> BUKIT ZAITUN </span>
                </a>
                <div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarsAdmin" aria-controls="navbarsAdmin" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarsAdmin">
                    <ul class="navbar-nav col-lg-10 justify-content-center">
                        <li class="nav-item px-3">
                            <a class="nav-link" href="admin.php">Dashboard</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="jadwal.php">Data Jadwal</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="galeri.php">Data Galeri</a>
                        </li>
                        <div>
                            <button class="btn btn-danger" onclick="window.location.href='../config/logout.php'">Logout</button>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <h2 class="text-white mb-4">Edit Data Galeri</h2>
        <form action="galeri_proses.php" method="POST" enctype="multipart/form-data" class="text-white">
            <input type="hidden" name="action" value="edit" />
            <input type="hidden" name="original_kd_ibadah" value="<?php echo htmlspecialchars($row['id']); ?>" />
            <div class="mb-3">
                <label for="kd_ibadah" class="form-label">Jenis Ibadah</label>
                <select class="form-select" id="kd_ibadah" name="kd_ibadah" required>
                    <option value="" disabled>Pilih Jenis Ibadah</option>
                    <?php
                    $options = ["SM", "REBUZA", "PEBUZA", "PD", "PRIBUZA", "WABUZA"];
                    foreach ($options as $option) {
                        $selected = ($row['kd_ibadah'] === $option) ? "selected" : "";
                        echo "<option value=\"$option\" $selected>$option</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_ibadah" class="form-label">Nama Ibadah</label>
                <input type="text" class="form-control" id="nama_ibadah" name="nama_ibadah" value="<?php echo htmlspecialchars($row['nama_ibadah']); ?>" required />
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($row['tanggal']); ?>" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Saat Ini</label><br />
                <img src="../../gambar/ibadah<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto Galeri" class="thumbnail-img" />
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Ganti Foto (Opsional)</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" />
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="galeri.php" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
