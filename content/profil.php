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
    body {
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
                            <a class="nav-link active" aria-current="page" href="profil.php"> Profil </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="galeri.php"> Galeri </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="content/warta.php"> Warta </a>
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
    <img draggable="true" src="../gambar/p/pelayanan.jpg" class="mx-auto d-block img-fluid">

    <!-- Konten Utama -->
    <main class="container my-5">
        <div class="container my-5">
            <div class="row g-3 justify-content-center">
                <div class="col-md-6" style="border: 0; color: goldenrod;">
                    <h2>Sejarah Gereja PPIK Pontianak</h2>
                    <p class="text-justify">
                        GPPIK (Geredja Pekabaran Persatuan Iman Kristus) didirikan pada 17 Maret 1954 di Ansang dengan
                        Sinyor Mantar sebagai ketua pertamanya. Berubah menjadi Yayasan Gereja
                        Persekutuan Pemberitaan Injil Kristus pada 1973, dan terakhir menjadi Gereja Persekutuan
                        Pemberitaan Injil Kristus pada 1990.
                        <br><br>
                        Perkembangan GPPIK tidak hanya terbatas pada lokasi awal berdirinya. Ekspansi pelayanan membawa GPPIK ke berbagai wilayah, termasuk Pontianak. GPPIK di Pontianak secara resmi didirikan pada 22 April 1972. Ibadah perdana dilaksanakan di asrama Gamaliel, yang berlokasi di Jalan Nurali nomor 1, dengan Sakdian sebagai gembala pertama yang memimpin jemaat di sana. Pendirian di Pontianak ini menandai langkah penting dalam penyebaran dan pelayanan GPPIK di wilayah tersebut.
                        <br><br>
                        Gedung gereja ini kemudian diresmikan secara formal oleh Walikota Pontianak pada 30 Mei 1985, menjadi tonggak sejarah penting bagi GPPIK di kota tersebut. Sejak peresmian itu, GPPIK Bukit Zaitun tidak hanya melayani jemaat di Pontianak, tetapi juga memperluas jangkauan pelayanannya ke kota-kota lain di sekitarnya.
                    </p>
                </div>
                <div class="col-md-6 d-flex align-items-center" style="border: 0;">
                    <img src="../gambar/side.jpg" alt="Sejarah Gereja PPIK" class="img-fluid rounded">
                </div>
            </div>
        </div>
        </section>

        <hr class="my-4" style="border-color: white;" />

        <section>
            <h2 class="text-center mb-4" style="color: white;">Jadwal Ibadah</h2>
            <div class="container mb-4">
                <div class="row g-3 justify-content-center">
                    <div class="col-md-6">
                        <div class="card p-3 h-100" style="background-color: #222; color: white;">
                            <h5 class="card-title mb-2" style="color: goldenrod; text-decoration: underline;">Ibadah Minggu</h5>
                            <p class="card-text mb-1">Sesi 1, Jam 08:00 WIB</p>
                            <p class="card-text mb-0">Sesi 2, Jam 10:30 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-3">
                    <?php
                    include '../config/konek.php';
$sql = "SELECT nama_ibadah, keterangan, jam_ibadah, hari_ibadah FROM tbl_jadwal ORDER BY kd_jadwal";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $count = 0;
    while ($row = $result->fetch_assoc()) {
$nama_ibadah = htmlspecialchars($row['nama_ibadah']);
$keterangan = htmlspecialchars($row['keterangan']);
$jam_ibadah_raw = $row['jam_ibadah'];
$jam_ibadah_time = date("H:i", strtotime($jam_ibadah_raw));
$jam_ibadah = htmlspecialchars($jam_ibadah_time . " WIB");
$hari_ibadah = htmlspecialchars($row['hari_ibadah']);
echo '<div class="col-md-6">';
echo '<div class="card p-3 h-100">';
echo "<h5 class='card-title mb-1'>{$nama_ibadah}</h5>";
echo "<p class='card-text mb-1'>{$keterangan}</p>";
echo "<p class='card-text mb-1'>Hari: {$hari_ibadah}</p>";
echo "<p class='card-text mb-0'>{$jam_ibadah}</p>";
echo '</div>';
echo '</div>';
        $count++;
    }
} else {
    echo '<p class="text-white text-center">Tidak ada data jadwal.</p>';
}
$conn->close();
                    ?>
                </div>
            </div>
        </section>
    </main>
    <!-- konten utama selesai -->
<!-- Footer -->
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