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
    <title>Admin - Data Jadwal</title>
    <link href="../../assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        body {
            background-color: black;
        }
        p {
            color: white;
        }
        .table thead th {
            color: white;
        }
        .table tbody td {
            color: white;
            vertical-align: middle;
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
                            <a class="nav-link active" aria-current="page" href="jadwal.php">Data Jadwal</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="galeri.php">Data Galeri</a>
                        </li>
                        <div>
                            <button class="btn btn-danger" onclick="logout()">Logout</button>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- konten utama -->

    <main class="container mt-4">
        <h2 class="text-white mb-4">Data Jadwal</h2>
        <table class="table table-dark table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th>Hari Ibadah</th>
                    <th>Nama Ibadah</th>
                    <th>Keterangan</th>
                    <th>Jam Ibadah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT kd_jadwal, hari_ibadah, nama_ibadah, keterangan, jam_ibadah FROM tbl_jadwal ORDER BY kd_jadwal";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = htmlspecialchars($row['kd_jadwal']);
                        $hari_ibadah = htmlspecialchars($row['hari_ibadah']);
                        $nama_ibadah = htmlspecialchars($row['nama_ibadah']);
                        $keterangan = htmlspecialchars($row['keterangan']);
                        $jam_ibadah_raw = $row['jam_ibadah'];
                        $jam_ibadah_time = date("H:i", strtotime($jam_ibadah_raw));
                        $jam_ibadah = htmlspecialchars($jam_ibadah_time . " WIB");
                        echo "<tr>";
                        echo "<td>{$hari_ibadah}</td>";
                        echo "<td>{$nama_ibadah}</td>";
                        echo "<td>{$keterangan}</td>";
                        echo "<td>{$jam_ibadah}</td>";
                        echo "<td>";
                        echo "<a href='jadwal_edit.php?id={$id}' class='btn btn-sm btn-primary me-2'><i class='bi bi-pencil-square'></i> Edit</a>";
                        echo "<a href='#' onclick='deleteJadwal(\"{$id}\"); return false;' class='btn btn-sm btn-danger'><i class='bi bi-trash'></i> Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data jadwal.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>

    <hr class="my-4" style="border-color: white;" />

    <main class="container mb-5">
        <h2 class="text-white mb-4">Input Data Jadwal</h2>
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'success'): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil disimpan',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    });
                </script>
            <?php elseif ($_GET['status'] == 'error'): ?>
                <div class="alert alert-danger" role="alert">
                    Gagal menyimpan data.
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <form action="jadwal_proses.php" method="POST" class="text-white">
            <div class="mb-3">
                <label for="hari_ibadah" class="form-label">Hari Ibadah</label>
                <select class="form-select" id="hari_ibadah" name="hari_ibadah" required>
                    <option value="" selected disabled>Pilih Hari Ibadah</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="kd_jadwal" class="form-label">Kode Ibadah</label>
                <select class="form-select" id="kd_jadwal" name="kd_jadwal" required>
                    <option value="" selected disabled>Pilih Kode Ibadah</option>
                    <option value="PRIBZ">PRIBZ</option>
                    <option value="PEBZ">PEBZ</option>
                    <option value="REBZ">REBZ</option>
                    <option value="WABZ">WABZ</option>
                    <option value="PDBZ">PDBZ</option>
                    <option value="SMBZ">SMBZ</option>
                    <option value="PKBZ">PKBZ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_ibadah" class="form-label">Nama Ibadah</label>
                <input type="text" class="form-control" id="nama_ibadah" name="nama_ibadah" required />
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" required />
            </div>
            <div class="mb-3">
                <label for="jam_ibadah" class="form-label">Jam Ibadah</label>
                <input type="text" class="form-control" id="jam_ibadah" name="jam_ibadah" required />
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteJadwal(id) {
            Swal.fire({
                title: 'Hapus Data',
                text: 'Yakin ingin menghapus jadwal ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'jadwal_delete.php?id=' + id, true);
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
                                            console.log("Redirecting to /index.php");
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
