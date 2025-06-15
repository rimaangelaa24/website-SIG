<?php
session_start();
include '../../config/konek.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process update
    $kd_jadwal = $_POST['kd_jadwal'] ?? '';
    $hari_ibadah = $_POST['hari_ibadah'] ?? '';
    $nama_ibadah = $_POST['nama_ibadah'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';
    $jam_ibadah = $_POST['jam_ibadah'] ?? '';

    if ($kd_jadwal && $hari_ibadah && $nama_ibadah && $keterangan && $jam_ibadah) {
        $stmt = $conn->prepare("UPDATE tbl_jadwal SET hari_ibadah = ?, nama_ibadah = ?, keterangan = ?, jam_ibadah = ? WHERE kd_jadwal = ?");
        $stmt->bind_param("sssss", $hari_ibadah, $nama_ibadah, $keterangan, $jam_ibadah, $kd_jadwal);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: jadwal.php?status=success");
            exit();
        } else {
            $stmt->close();
            $conn->close();
            header("Location: jadwal.php?status=error");
            exit();
        }
    } else {
        $conn->close();
        header("Location: jadwal.php?status=error");
        exit();
    }
} else {
    // Show edit form
    $kd_jadwal = $_GET['id'] ?? '';
    if (!$kd_jadwal) {
        header("Location: jadwal.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT kd_jadwal, hari_ibadah, nama_ibadah, keterangan, jam_ibadah FROM tbl_jadwal WHERE kd_jadwal = ?");
    $stmt->bind_param("s", $kd_jadwal);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $stmt->close();
        $conn->close();
        header("Location: jadwal.php");
        exit();
    }

    $row = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Jadwal</title>
    <link href="../../assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body style="background-color: black; color: white;">
    <div class="container mt-5">
        <h2>Edit Jadwal</h2>
        <form action="jadwal_edit.php" method="POST" class="text-white">
            <div class="mb-3">
                <label for="kd_jadwal" class="form-label">Kode Jadwal</label>
                <input type="text" class="form-control" id="kd_jadwal" name="kd_jadwal" value="<?php echo htmlspecialchars($row['kd_jadwal']); ?>" readonly />
            </div>
            <div class="mb-3">
                <label for="hari_ibadah" class="form-label">Hari Ibadah</label>
                <select class="form-select" id="hari_ibadah" name="hari_ibadah" required>
                    <option value="" disabled>Pilih Hari Ibadah</option>
                    <option value="Senin" <?php if ($row['hari_ibadah'] == 'Senin') echo 'selected'; ?>>Senin</option>
                    <option value="Selasa" <?php if ($row['hari_ibadah'] == 'Selasa') echo 'selected'; ?>>Selasa</option>
                    <option value="Rabu" <?php if ($row['hari_ibadah'] == 'Rabu') echo 'selected'; ?>>Rabu</option>
                    <option value="Kamis" <?php if ($row['hari_ibadah'] == 'Kamis') echo 'selected'; ?>>Kamis</option>
                    <option value="Jumat" <?php if ($row['hari_ibadah'] == 'Jumat') echo 'selected'; ?>>Jumat</option>
                    <option value="Sabtu" <?php if ($row['hari_ibadah'] == 'Sabtu') echo 'selected'; ?>>Sabtu</option>
                    <option value="Minggu" <?php if ($row['hari_ibadah'] == 'Minggu') echo 'selected'; ?>>Minggu</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_ibadah" class="form-label">Nama Ibadah</label>
                <input type="text" class="form-control" id="nama_ibadah" name="nama_ibadah" value="<?php echo htmlspecialchars($row['nama_ibadah']); ?>" required />
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo htmlspecialchars($row['keterangan']); ?>" required />
            </div>
            <div class="mb-3">
                <label for="jam_ibadah" class="form-label">Jam Ibadah</label>
                <input type="text" class="form-control" id="jam_ibadah" name="jam_ibadah" value="<?php echo htmlspecialchars($row['jam_ibadah']); ?>" required />
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="jadwal.php" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
</body>

</html>
