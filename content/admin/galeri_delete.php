<?php
session_start();
include '../../config/konek.php';

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    // First, get the filename of the photo to delete the file
    $sql_select = "SELECT foto FROM tbl_galeri WHERE id = '$id'";
    $result = $conn->query($sql_select);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $foto = $row['foto'];
        $foto_path = '../../gambar/' . $foto;

        // Delete the file if it exists
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }
    }

    // Delete the record from the database
    $sql_delete = "DELETE FROM tbl_galeri WHERE id = '$id'";
    if ($conn->query($sql_delete) === TRUE) {
        echo "1"; // success
    } else {
        echo "0"; // failure
    }
} else {
    echo "0"; // failure
}
$conn->close();
?>
