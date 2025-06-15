<?php
session_start();
include '../../config/konek.php';

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../index.html');
    exit();
}

// Add new warta
if (isset($_POST['add'])) {
    $judul_warta = mysqli_real_escape_string($conn, $_POST['judul_warta']);
    $tgl_warta = mysqli_real_escape_string($conn, $_POST['tgl_warta']);
    $ibadah_minggu = mysqli_real_escape_string($conn, $_POST['ibadah_minggu']);
    $info_kegiatan = isset($_POST['info_kegiatan']) ? mysqli_real_escape_string($conn, $_POST['info_kegiatan']) : null;
    $berita_duka = isset($_POST['berita_duka']) ? mysqli_real_escape_string($conn, $_POST['berita_duka']) : null;
    $berita_syukur = isset($_POST['berita_syukur']) ? mysqli_real_escape_string($conn, $_POST['berita_syukur']) : null;
    $laporan_keuangan = isset($_POST['laporan_keuangan']) ? mysqli_real_escape_string($conn, $_POST['laporan_keuangan']) : null;

    // Get max id_warta
    $max_id_result = mysqli_query($conn, "SELECT MAX(id_warta) AS max_id FROM tbl_warta");
    $max_id_row = mysqli_fetch_assoc($max_id_result);
    $new_id_warta = $max_id_row['max_id'] !== null ? intval($max_id_row['max_id']) + 1 : 1;

    $query = "INSERT INTO tbl_warta (id_warta, judul_warta, tgl_warta, ibadah_minggu, info_kegiatan, berita_duka, berita_syukur, laporan_keuangan) VALUES ($new_id_warta, '$judul_warta', '$tgl_warta', '$ibadah_minggu', " . 
        ($info_kegiatan !== null ? "'$info_kegiatan'" : "NULL") . ", " . 
        ($berita_duka !== null ? "'$berita_duka'" : "NULL") . ", " . 
        ($berita_syukur !== null ? "'$berita_syukur'" : "NULL") . ", " . 
        ($laporan_keuangan !== null ? "'$laporan_keuangan'" : "NULL") . ")";

    if (mysqli_query($conn, $query)) {
        header('Location: warta.php?success=Data berhasil ditambahkan');
    } else {
        header('Location: warta.php?error=Gagal menambahkan data');
    }
    exit();
}

// Update existing warta
if (isset($_POST['update'])) {
    $id_warta = intval($_POST['id_warta']);
    $judul_warta = mysqli_real_escape_string($conn, $_POST['judul_warta']);
    $tgl_warta = mysqli_real_escape_string($conn, $_POST['tgl_warta']);
    $ibadah_minggu = mysqli_real_escape_string($conn, $_POST['ibadah_minggu']);
    $info_kegiatan = isset($_POST['info_kegiatan']) ? mysqli_real_escape_string($conn, $_POST['info_kegiatan']) : null;
    $berita_duka = isset($_POST['berita_duka']) ? mysqli_real_escape_string($conn, $_POST['berita_duka']) : null;
    $berita_syukur = isset($_POST['berita_syukur']) ? mysqli_real_escape_string($conn, $_POST['berita_syukur']) : null;
    $laporan_keuangan = isset($_POST['laporan_keuangan']) ? mysqli_real_escape_string($conn, $_POST['laporan_keuangan']) : null;

    $query = "UPDATE tbl_warta SET 
        judul_warta = '$judul_warta',
        tgl_warta = '$tgl_warta',
        ibadah_minggu = '$ibadah_minggu',
        info_kegiatan = " . ($info_kegiatan !== null ? "'$info_kegiatan'" : "NULL") . ",
        berita_duka = " . ($berita_duka !== null ? "'$berita_duka'" : "NULL") . ",
        berita_syukur = " . ($berita_syukur !== null ? "'$berita_syukur'" : "NULL") . ",
        laporan_keuangan = " . ($laporan_keuangan !== null ? "'$laporan_keuangan'" : "NULL") . "
        WHERE id_warta = $id_warta";

    if (mysqli_query($conn, $query)) {
        header('Location: warta.php?success=Data berhasil diupdate');
    } else {
        header('Location: warta.php?error=Gagal mengupdate data');
    }
    exit();
}

// Delete warta
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $query = "DELETE FROM tbl_warta WHERE id_warta = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: warta.php?success=Data berhasil dihapus');
    } else {
        header('Location: warta.php?error=Gagal menghapus data');
    }
    exit();
}

// If no valid action, redirect back
header('Location: warta.php');
exit();
?>
