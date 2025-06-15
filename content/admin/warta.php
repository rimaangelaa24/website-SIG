<?php
session_start();
include '../../config/konek.php';

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../index.html');
    exit();
}

// Fetch all warta data
$query = "SELECT * FROM tbl_warta ORDER BY id_warta DESC";
$result = mysqli_query($conn, $query);

// Initialize variables for form
$id_warta = '';
$judul_warta = '';
$tgl_warta = '';
$ibadah_minggu = '';
$info_kegiatan = '';
$berita_duka = '';
$berita_syukur = '';
$laporan_keuangan = '';
$edit_mode = false;

// If editing, fetch data for the given id
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id = intval($_GET['edit']);
    $edit_query = "SELECT * FROM tbl_warta WHERE id_warta = $id";
    $edit_result = mysqli_query($conn, $edit_query);
    if ($edit_result && mysqli_num_rows($edit_result) > 0) {
        $row = mysqli_fetch_assoc($edit_result);
        $id_warta = $row['id_warta'];
        $judul_warta = $row['judul_warta'];
        $tgl_warta = $row['tgl_warta'];
        $ibadah_minggu = $row['ibadah_minggu'];
        $info_kegiatan = $row['info_kegiatan'];
        $berita_duka = $row['berita_duka'];
        $berita_syukur = $row['berita_syukur'];
        $laporan_keuangan = $row['laporan_keuangan'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kelola Data Warta</title>
    <link href="../../assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body style="background-color: black; color: white;">
    <div class="container mt-4">
        <h2>Kelola Data Warta</h2>
        <a href="admin.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

        <!-- Warta Table -->
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Warta</th>
                    <th>Tanggal Warta</th>
                    <th>Ibadah Minggu</th>
                    <th>Info Kegiatan</th>
                    <th>Berita Duka</th>
                    <th>Berita Syukur</th>
                    <th>Laporan Keuangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_warta'] + 1) ?></td>
                        <td><?= htmlspecialchars($row['judul_warta']) ?></td>
                        <td><?= htmlspecialchars($row['tgl_warta']) ?></td>
                        <td><?= htmlspecialchars($row['ibadah_minggu']) ?></td>
                        <td><?= htmlspecialchars($row['info_kegiatan']) ?></td>
                        <td><?= htmlspecialchars($row['berita_duka']) ?></td>
                        <td><?= htmlspecialchars($row['berita_syukur']) ?></td>
                        <td><?= htmlspecialchars($row['laporan_keuangan']) ?></td>
                        <td>
                            <a href="warta.php?edit=<?= $row['id_warta'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="warta_proses.php?delete=<?= $row['id_warta'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Form for Add/Edit -->
        <h3><?= $edit_mode ? 'Edit Data Warta' : 'Tambah Data Warta' ?></h3>
        <form action="warta_proses.php" method="post" class="mb-5">
            <input type="hidden" name="id_warta" value="<?= htmlspecialchars($id_warta) ?>">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="judul_warta" class="form-label">Judul Warta</label>
                    <input type="text" class="form-control" id="judul_warta" name="judul_warta" required value="<?= htmlspecialchars($judul_warta) ?>">
                </div>
                <div class="col-md-6">
                    <label for="tgl_warta" class="form-label">Tanggal Warta</label>
                    <input type="date" class="form-control" id="tgl_warta" name="tgl_warta" required value="<?= htmlspecialchars($tgl_warta) ?>">
                </div>
            </div>
            <div class="mb-3">
                <label for="ibadah_minggu" class="form-label">Ibadah Minggu</label>
                <input type="text" class="form-control" id="ibadah_minggu" name="ibadah_minggu" required value="<?= htmlspecialchars($ibadah_minggu) ?>">
            </div>
            <div class="mb-3">
                <label for="info_kegiatan" class="form-label">Info Kegiatan</label>
                <input type="text" class="form-control" id="info_kegiatan" name="info_kegiatan" value="<?= htmlspecialchars($info_kegiatan) ?>">
            </div>
            <div class="mb-3">
                <label for="berita_duka" class="form-label">Berita Duka</label>
                <input type="text" class="form-control" id="berita_duka" name="berita_duka" value="<?= htmlspecialchars($berita_duka) ?>">
            </div>
            <div class="mb-3">
                <label for="berita_syukur" class="form-label">Berita Syukur</label>
                <input type="text" class="form-control" id="berita_syukur" name="berita_syukur" value="<?= htmlspecialchars($berita_syukur) ?>">
            </div>
            <div class="mb-3">
                <label for="laporan_keuangan" class="form-label">Laporan Keuangan</label>
                <textarea class="form-control" id="laporan_keuangan" name="laporan_keuangan" rows="4"><?= htmlspecialchars($laporan_keuangan) ?></textarea>
            </div>
            <button type="submit" name="<?= $edit_mode ? 'update' : 'add' ?>" class="btn btn-primary"><?= $edit_mode ? 'Update' : 'Tambah' ?></button>
            <?php if ($edit_mode): ?>
                <a href="warta.php" class="btn btn-secondary">Batal</a>
            <?php endif; ?>
            <br><br>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
