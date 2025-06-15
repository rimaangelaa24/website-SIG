<?php
session_start();
 include '../../config/konek.php';
 ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin - Input Data Galeri dan Jadwal</title>
    <link href="../../assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
    <style>
        body {
            background-color: black;
        }
        p{
            color: white;
            font-size: 26px;
        }
    </style>
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
                            <a class="nav-link active" aria-current="page" href="admin.php">Dashboard</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="jadwal.php">Data Jadwal</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="galeri.php">Data Galeri</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="warta.php">Kelola Data Warta</a>
                        </li>
                        <div>
                    <?php if (isset($_SESSION['username'])): ?>
                        <button class="btn btn-danger" onclick="logout()">Logout</button>
                    <?php else: ?>
<button class="btn btn-danger" onclick="window.location.href='../index.html'">Login</button>
                    <?php endif; ?>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <h2 style="color: white; font-weight: bold;">Dashboard Admin</h2>
        <hr style="border: 1px solid white;">
<p>Selamat datang, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>!</p>
        <br><br>
        <p>
        
        </p>
        </div>

                <img draggable="false" src="../../gambar/admin.jpg" class="mx-auto d-block img-fluid">
<br><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteGaleri(nama_ibadah) {
            Swal.fire({
                title: 'Hapus Data',
                text: 'Yakin ingin menghapus foto ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'galeri_delete.php?id=' + nama_ibadah, true);
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText.trim() === "1") {
                                Swal.fire({
                                    title: 'Hapus Data',
                                    text: 'Data berhasil dihapus',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Hapus Data',
                                    text: 'Data gagal dihapus',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    };
                    xhr.send();
                }
            });
        }

        // Hide alert-success message after 3 seconds
        window.addEventListener('DOMContentLoaded', (event) => {
            const alertSuccess = document.querySelector('.alert-success');
            if (alertSuccess) {
                setTimeout(() => {
                    alertSuccess.style.display = 'none';
                }, 3000);
            }
        });
    </script>
    <script>
        function logout() {
            console.log("logout() called");
            Swal.fire({
                title: 'Log Out',
                text: 'Yakin ingin Log Out sekarang?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Log Out',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("User confirmed logout");
                    var xmlhttp2 = new XMLHttpRequest();
                    xmlhttp2.onreadystatechange = function() {
                        if (this.readyState == 4) {
                            console.log("AJAX response received", this.status, this.responseText);
                            if (this.status == 200) {
                                try {
                                    var response = JSON.parse(this.responseText);
                                    if(response.status === "success") {
                                        Swal.fire({
                                            title: 'Log Out',
                                            text: response.message,
                                            icon: 'success'
                                        }).then((result) => {
                                            console.log("Redirecting to /index.html");
                                            location.href = '/index.html';
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
                            } else {
                                Swal.fire({
                                    title: 'Log Out',
                                    text: 'Server error: ' + this.status,
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
</body>

</html>
