<?php
include '../config/konek.php';

$kd_ibadah = 'SM';

$sql = "SELECT nama_ibadah, foto, tanggal, keterangan FROM tbl_galeri WHERE kd_ibadah = '$kd_ibadah' ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Galeri <?php echo $kd_ibadah; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
        body {
            background-color: black;
            color: white;
        }
        .gallery-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        .gallery-card {
            background-color: #222;
            border: none;
            margin-bottom: 2rem;
            padding: 1rem;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Main navbar">
            <div class="container-xl d-flex justify-content-center align-items-center">
                <a class="navbar-brand" href="#">
                    <img draggable="false" src="../gambar/bz.png" width="50" height="50" alt="bz" />
                    <img draggable="false" src="../gambar/ppik.png" width="50" height="50" alt="ppik" />
                </a>
                <a class="navbar-brand fw-bolder">
                    GPPIK <span class="lighttext"> BUKIT ZAITUN </span>
                </a>
                <div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav col-lg-10 justify-content-center">
                        <li class="nav-item px-3">
<a class="nav-link" href="../index.html">Beranda</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="profil.php">Profil</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="galeri.php">Galeri</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="content/warta.php"> Warta </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="kontak.php">Kontak</a>
                        </li>
                        <div>
                            <a href="../config/login.php" class="btn btn-danger">Login</a>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <h2 class="text-center mb-4">Galeri <?php echo $kd_ibadah; ?></h2>
        <div class="row">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
<div class="gallery-card">
    <img src="../../gambar/<?php echo htmlspecialchars($row['foto']); ?>" alt="<?php echo htmlspecialchars($row['nama_ibadah']); ?>" class="gallery-img" />
    <h5><?php echo htmlspecialchars($row['keterangan']); ?></h5>
    <p><strong><?php echo htmlspecialchars($row['nama_ibadah']); ?></strong></p>
    <p><?php echo htmlspecialchars($row['tanggal']); ?></p>
</div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">Tidak ada data galeri untuk <?php echo $kd_ibadah; ?>.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="../content/galeri.php" class="btn btn-secondary">Kembali ke Galeri</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
