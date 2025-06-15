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
                                text: response.message,
                                icon: 'success'
                            }).then((result) => {
                                location.href = '../../index.html';
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
            xmlhttp2.open("GET", "../logout.php", true);
            xmlhttp2.send();
        }
    });
}
