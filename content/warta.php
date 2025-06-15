 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <title> GPPIK BUKIT ZAITUN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../gambar/bz.png" />
</head>
<style>
    header{
        background-color: black;
    }
</style>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Ninth navbar example">
            <div class="container-xl d-flex justify-content-center align-items-center">
                <a class="navbar-brand" id="logonavbar" href="#">
                    <img draggable="false" src="../gambar/bz.png" width="50" height="50" alt="bz">
                    <img draggable="false" src="../gambar/ppik.png" width="50" height="50" alt="ppik">
                </a>
                <a class="navbar-brand fw-bolder" id="textnavbar">
                    GPPIK <span class="lighttext"> BUKIT ZAITUN </span>
                </a>
                <div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarsExample07XL">
                    <ul class="navbar-nav col-lg-10 justify-content-center">
                        <li class="nav-item px-3">
<a class="nav-link" href="../index.html"> Beranda </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="profil.php"> Profil </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="galeri.php"> Galeri </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link active" aria-current="page" href="warta.php"> Warta </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="kontak.php"> Kontak </a>
                        </li>
                        <div>
                            <a href="../config/login.php" class="btn btn-danger">Login</a>
                        </div>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
<?php
include '../config/konek.php';

// Fetch all warta data ordered by date descending
$query = "SELECT * FROM tbl_warta ORDER BY tgl_warta DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Warta</title>
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body style="background-color: black; color: white;">
    <div class="container mt-4">
        <h2>Warta UMUM Persekutuan PPIK Bukit Zaitun Pontianak1</h2>
        <hr style="border-color: white;" />

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="list-group">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="list-group-item list-group-item-dark mb-3">
                        <h5><?= htmlspecialchars($row['judul_warta']) ?></h5>
                        <p><strong>Tanggal Warta:</strong> <?= htmlspecialchars($row['tgl_warta']) ?></p>
                        <p><strong>Ibadah Minggu:</strong> <?= htmlspecialchars($row['ibadah_minggu']) ?></p>
                        <?php if (!empty($row['info_kegiatan'])): ?>
                            <p><strong>Info Kegiatan:</strong> <?= htmlspecialchars($row['info_kegiatan']) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($row['berita_duka'])): ?>
                            <p><strong>Berita Duka:</strong> <?= htmlspecialchars($row['berita_duka']) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($row['berita_syukur'])): ?>
                            <p><strong>Berita Syukur:</strong> <?= htmlspecialchars($row['berita_syukur']) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($row['laporan_keuangan'])): ?>
                            <p><strong>Laporan Keuangan:</strong> <?= htmlspecialchars($row['laporan_keuangan']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Tidak ada informasi warta tersedia.</p>
        <?php endif; ?>
    </div>
    <br><br>
<footer class="mt-5 pt-5 text-white" style="background-color: black;">
    <div class="container">
        <h3 class="fw-bold mb-4">GPPIK BUKIT ZAITUN</h3>
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5>Contact Us</h5>
                <p>+62 813 5120 2859</p>
                <p><a href="mailto:gppikbukitzaitun@gmail.com" class="text-white">gppikbukitzaitun@gmail.com</a></p>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Location</h5>
                <p>Jl. WR. Supratman no. 40 </p>
                <p>Pontianak, Kalimantan Barat</p>
                <a href="https://maps.app.goo.gl/cTcSYsGVBurqJ7Z5A" class="text-white text-decoration-underline">Our Maps <i class="bi bi-chevron-right"></i></a>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Social</h5>
                <p><a href="https://www.instagram.com/ppikbukitzaitun/" class="text-white"><i class="bi bi-instagram"></i> Instagram</a></p>
                <p><a href="https://www.facebook.com/ppikbukitzaitun/" class="text-white"><i class="bi bi-facebook"></i> Facebook</a></p>
                <p><a href="https://www.youtube.com/@ppikbukitzaitunpontianak7780" class="text-white"><i class="bi bi-youtube"></i> YouTube</a></p>
            </div>
        </div>
        <hr style="border-color: #444;" />
        <div class="text-center pb-3">
            <small>&copy; 2025 GPPIK Bukit Zaitun Pontianak</small>
        </div>
    </div>
</footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/08f3c3a570.js" crossorigin="anonymous"></script>
    <script src="assets/js/bttindex.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
</body>

</html>