<?php
session_start();
include '../../config/konek.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_jadwal = $_POST['kd_jadwal'] ?? '';

    $nama_ibadah = $_POST['nama_ibadah'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';
    $jam_ibadah = $_POST['jam_ibadah'] ?? '';
    $hari_ibadah = $_POST['hari_ibadah'] ?? '';

    if ($kd_jadwal && $nama_ibadah && $keterangan && $jam_ibadah && $hari_ibadah) {
        $stmt = $conn->prepare("INSERT INTO tbl_jadwal (kd_jadwal, nama_ibadah, keterangan, jam_ibadah, hari_ibadah) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $kd_jadwal, $nama_ibadah, $keterangan, $jam_ibadah, $hari_ibadah);

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
    header("Location: jadwal.php");
    exit();
}
