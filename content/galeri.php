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
                            <a class="nav-link active" aria-current="page" href="galeri.php"> Galeri </a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function logout() {
            Swal.fire({
                title: 'Log Out',
                text: 'Yakin ingin Log Out sekarang?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Log Out',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var xmlhttp2 = new XMLHttpRequest();
                    xmlhttp2.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            try {
                                var response = JSON.parse(this.responseText);
                                if(response.status === "success") {
                                    Swal.fire({
                                        title: 'Log Out',
                                        text: response.message,
                                        icon: 'success'
                                    }).then((result) => {
                                        location.href = '/index.php';
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Log Out',
                                        text: response.message || 'Gagal Logout',
                                        icon: 'error'
                                    });
                                }
                            } catch(e) {
                                Swal.fire({
                                    title: 'Log Out',
                                    text: 'Response tidak valid',
                                    icon: 'error'
                                });
                            }
                        }
                    };
                    xmlhttp2.open("POST", "/config/logout.php", true);
                    xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp2.send("action=logout");
                }
            });
        }
    </script>
        <img draggable="false" src="../gambar/galeri.JPG" class="mx-auto d-block img-fluid">
<br><br>
    <!-- <footer class="bg-light text-center p-3 mt-5"></footer> -->

    <div class="container mt-3">
        <center><h2>Galeri Gereja PPIK Bukit Zaitun Pontianak</h2></center>
        <br><br>

        <?php
        $gallery = [
            [
                'src' => '../gambar/p/pebuza.jpg',
                'alt' => 'PEBUZA',
                'title' => 'PEBUZA',
                'description' => 'PEMUDA Bukit Zaitun adalah perkumpulan pemuda/i dari Umur diatas 17 tahun yang ada di Gereja Bukit Zaitun Pontianak.'
            ],
            [
                'src' => '../gambar/p/rebuza.jpg',
                'alt' => 'Rebuza',
                'title' => 'REBUZA',
                'description' => 'REBUZA atau Remaja Bukit Zaitun adalah perkumpulan remaja dari remaja Sekolah Menengah Pertama dan Sekolah Menengah Atas Gereja PPIK Bukit Zaitun Pontianak'
            ],
            [
                'src' => '../gambar/p/pribuza.jpg',
                'alt' => 'PRIBUZA',
                'title' => 'PRIBUZA',
                'description' => 'PRIBUZA atau PRIA Bukit Zaitun adalah perkumpulan Laki-Laki atau Pria Gereja Bukit Zaitun Pontianak yang sudah menikah.'
            ],
            [
                'src' => '../gambar/p/wabuza.jpg',
                'alt' => 'WABUZA',
                'title' => 'WABUZA',
                'description' => 'WABUZA atau Wanita Bukit Zaitun adalah perkumpulan Wanita atau Ibu-Ibu Gereja PPIK Bukit Zaitun Pontiank.'
            ],
            [
                'src' => '../gambar/p/SM.jpg',
                'alt' => 'SM',
                'title' => 'SM',
                'description' => 'SM BZ atau Sekolah Minggu Bukit Zaitun adalah perkumpulan anak-anak Gereja PPIK Bukit Zaitun yang masih berada di sekolah dasar.'
            ],
            [
                'src' => '../gambar/p/pd.jpg',
                'alt' => 'PD',
                'title' => 'PD',
                'description' => 'PD atau Persekutuan Doa Bukit Zaitun adalah persekutuan ibadah yang berfokus pada Doa'
            ],
            // Add more images here as needed
        ];
        ?>

        <style>
            .gallery-box {
                border: 1px solid #ddd;
                padding: 0;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                background-color: #fff;
                transition: box-shadow 0.3s ease;
                overflow: hidden;
            }
            .gallery-box:hover {
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            }
            .gallery-box img {
                max-width: 100%;
                height: auto;
                border-radius: 0;
                display: block;
            }
            .gallery-text {
                padding: 15px;
            }
            .gallery-title {
                font-weight: 600;
                margin: 0;
                font-size: 1.1rem;
                text-decoration: none;
            }
            .gallery-description {
                font-size: 0.9rem;
                color: #555;
                margin-top: 5px;
                text-decoration: none;
            }
            a .gallery-description {
                text-decoration: none;
                color: inherit;
            }
            .equal-size {
                height: 400px;
            }
            .fixed-height {
                /* Removed fixed height styling for PRIBUZA and WABUZA to match other cards */
            }
            .fixed-height img {
                /* Removed image object-fit styling for PRIBUZA and WABUZA */
            }
        </style>
        <div class="row">
            <?php foreach ($gallery as $key => $item): ?>
<div class="col-md-6 mb-4 text-center <?php echo ($item['title'] === 'SM') ? 'd-flex justify-content-center' : ''; ?>">
    <div class="gallery-box">
                        <a href="<?php echo strtolower($item['title']); ?>.php">
                            <img src="<?php echo htmlspecialchars($item['src']); ?>"
                                alt="<?php echo htmlspecialchars($item['alt']); ?>" class="img-fluid mb-2" />
                            <div class="gallery-text">
                                <div class="gallery-title"><?php echo htmlspecialchars($item['title']); ?></div>
                                <div class="gallery-description"><?php echo htmlspecialchars($item['description']); ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
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