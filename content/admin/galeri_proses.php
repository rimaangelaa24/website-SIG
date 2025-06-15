<?php
session_start();
include '../../config/konek.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : 'insert';
    $kd_ibadah = isset($_POST['kd_ibadah']) ? $conn->real_escape_string($_POST['kd_ibadah']) : '';
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $nama_ibadah = isset($_POST['nama_ibadah']) ? $conn->real_escape_string($_POST['nama_ibadah']) : '';
    $tanggal = isset($_POST['tanggal']) ? $conn->real_escape_string($_POST['tanggal']) : '';

    if ($action === 'edit') {
        $original_id = isset($_POST['original_id']) ? $conn->real_escape_string($_POST['original_id']) : '';

        // Check if a new file is uploaded
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['foto']['tmp_name'];
            $fileName = basename($_FILES['foto']['name']);
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($fileExtension, $allowedfileExtensions)) {
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = '../../gambar/';
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Update with new photo
                    $sql = "UPDATE tbl_galeri SET kd_ibadah='$kd_ibadah', nama_ibadah='$nama_ibadah', tanggal='$tanggal', foto='$newFileName' WHERE id='$original_id'";
                } else {
                    header("Location: galeri.php?status=error");
                    exit();
                }
            } else {
                header("Location: galeri.php?status=error");
                exit();
            }
        } else {
            // Update without changing photo
            $sql = "UPDATE tbl_galeri SET kd_ibadah='$kd_ibadah', nama_ibadah='$nama_ibadah', tanggal='$tanggal' WHERE id='$original_id'";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: galeri.php?status=success");
            exit();
        } else {
            header("Location: galeri.php?status=error");
            exit();
        }
    } else {
        // Insert new record
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['foto']['tmp_name'];
            $fileName = basename($_FILES['foto']['name']);
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($fileExtension, $allowedfileExtensions)) {
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = '../../gambar/';
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $sql = "INSERT INTO tbl_galeri (id, kd_ibadah, nama_ibadah, tanggal, foto) VALUES ($id, '$kd_ibadah', '$nama_ibadah', '$tanggal', '$newFileName')";
                    if ($conn->query($sql) === TRUE) {
                        header("Location: galeri.php?status=success");
                        exit();
                    } else {
                        header("Location: galeri.php?status=error");
                        exit();
                    }
                } else {
                    header("Location: galeri.php?status=error");
                    exit();
                }
            } else {
                header("Location: galeri.php?status=error");
                exit();
            }
        } else {
            header("Location: galeri.php?status=error");
            exit();
        }
    }
} else {
    header("Location: galeri.php");
    exit();
}
?>
