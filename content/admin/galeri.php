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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        body {
            background-color: black;
        }
        p {
            color: white;
        }
        .thumbnail-img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
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
                            <a class="nav-link" href="jadwal.php">Data Jadwal</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link active" aria-current="page" href="galeri.php">Data Galeri</a>
                        </li>
                        <div>
                            <button class="btn btn-danger" onclick="window.location.href='/config/logout.php'">Logout</button>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- konten utama -->

    <style>
        .thumbnail-img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
        .table thead th {
            color: white;
        }
        .table tbody td {
            color: white;
            vertical-align: middle;
        }
    </style>

    <main class="container mt-4">
                <h2 class="text-white mb-4">Data Galeri</h2>
                <table class="table table-dark table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama Ibadah</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, foto, nama_ibadah, tanggal FROM tbl_galeri ORDER BY tanggal DESC";
                        $result = $conn->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = htmlspecialchars($row['id']);
                                $foto = htmlspecialchars($row['foto']);
                                $nama_ibadah = htmlspecialchars($row['nama_ibadah']);
                                $tanggal = htmlspecialchars($row['tanggal']);
                                $foto_path = "../../gambar/" . $foto;
                                echo "<tr>";
                                echo "<td><img src='{$foto_path}' alt='{$nama_ibadah}' class='thumbnail-img' /></td>";
                                echo "<td><span style='text-decoration:none;'>{$nama_ibadah}</span></td>";
                                echo "<td><span style='text-decoration:none;'>{$tanggal}</span></td>";
                                echo "<td>";
                                echo "<a href='galeri_edit.php?id={$id}' class='btn btn-sm btn-primary me-2'><i class='bi bi-pencil-square'></i> Edit</a>";
                                echo "<a href='#' onclick='deleteGaleri(\"{$id}\"); return false;' class='btn btn-sm btn-danger'><i class='bi bi-trash'></i> Hapus</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Tidak ada data galeri.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>

    <hr class="my-4" style="border-color: white;" />

    <main class="container mb-5">
        <h2 class="text-white mb-4">Input Data Galeri</h2>
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'success'): ?>
                <div class="alert alert-success" role="alert">
                    Data berhasil disimpan.
                </div>
            <?php elseif ($_GET['status'] == 'error'): ?>
                <div class="alert alert-danger" role="alert">
                    Gagal menyimpan data.
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php
        // Reopen connection for next id query
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query("SELECT MAX(id) AS max_id FROM tbl_galeri");
        $row = $result->fetch_assoc();
        $next_id = $row['max_id'] ? $row['max_id'] + 1 : 1;
        ?>
        <form action="galeri_proses.php" method="POST" enctype="multipart/form-data" class="text-white">
            <div class="mb-3 d-flex align-items-center gap-3">
                <div style="flex:1;">
                    <label for="kd_ibadah" class="form-label">Jenis Ibadah</label>
                    <select class="form-select" id="kd_ibadah" name="kd_ibadah" required>
                        <option value="" selected disabled>Pilih Jenis Ibadah</option>
                        <option value="SM">SM</option>
                        <option value="REBUZA">REBUZA</option>
                        <option value="PEBUZA">PEBUZA</option>
                        <option value="PD">PD</option>
                        <option value="PRIBUZA">PRIBUZA</option>
                        <option value="WABUZA">WABUZA</option>
                    </select>
                </div>
                <div style="width: 100px;">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo $next_id; ?>" readonly />
                </div>
            </div>
            <div class="mb-3">
                <label for="nama_ibadah" class="form-label">Nama Ibadah</label>
                <input type="text" class="form-control" id="nama_ibadah" name="nama_ibadah" required />
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required />
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required />
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <br><br>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteGaleri(id) {
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
                    xhr.open('GET', 'galeri_delete.php?id=' + id, true);
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
</body>

</html>
