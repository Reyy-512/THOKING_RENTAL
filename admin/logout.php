<!-- <?php
    session_start();
    session_destroy();

    echo '<script>alert("Anda Telah Logout");window.location="../dashboard.php";</script>';
?> -->

<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: #fdf9f4; /* Warna latar belakang seperti yang diinginkan */
        }
    </style>
</head>
<body>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Logout',
            text: 'Anda telah keluar dari sistem.',
            showConfirmButton: false,
            timer: 2000,
            background: "#fff",
            color: "#161412ff",
            iconColor: "#3928a7ff", // Warna ikon hijau untuk sukses
            customClass: {
                popup: "animated fadeInDown" // Animasi kotak alert
            }
        }).then(() => {
            window.location = "../dashboard.php"; // Redirect setelah timer selesai
        });
    </script>
</body>
</html>
