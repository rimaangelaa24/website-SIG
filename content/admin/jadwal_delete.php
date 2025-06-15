<?php
session_start();
include '../../config/konek.php';

if (isset($_GET['id'])) {
    $kd_jadwal = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM tbl_jadwal WHERE kd_jadwal = ?");
    $stmt->bind_param("s", $kd_jadwal);

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "0";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "0";
}
