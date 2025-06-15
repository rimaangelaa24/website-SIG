<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'logout') {
    // Handle logout request
    session_unset();
    session_destroy();

    header('Content-Type: application/json');
    $response = [
        'status' => 'success',
        'message' => 'Berhasil Logout'
    ];
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
    function logout() {
        Swal.fire({
            title: 'Log Out',
            text: 'Yakin ingin Log Out sekarang?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Log Out',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var xmlhttp2 = new XMLHttpRequest();
                xmlhttp2.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        try {
                            var response = JSON.parse(this.responseText);
                            if(response.status === "success") {
                                Swal.fire({
                                    title: 'Log Out',
                                    text: 'Berhasil Log Out',
                                    icon: 'success'
                                    }).then((result) => {
                                        console.log("Redirecting to /index.php");
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
                    }
                };
                xmlhttp2.open("POST", "logout.php", true);
                xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp2.send("action=logout");
            }
        });
    }
    window.onload = logout;
    </script>
</body>
</html>
