<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil THO-KING</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Clean CSS -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #6d7176ff;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow);
            padding: 0.75rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .navbar-brand img {
            max-height: 45px;
            width: auto;
            border-radius: 8px;
        }

        .brand-text {
            font-weight: 600;
            font-size: 1.4rem;
            color: #1e6798;
            margin-left: 0.75rem;
            letter-spacing: -0.5px;
        }

        .navbar-nav .nav-item {
            margin: 0 0.25rem;
        }

        .nav-link {
            font-weight: 500;
            color: #2c3e50;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-bottom: 2px solid transparent; /* garis bawah default transparan */
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: #1e6798;
            border-bottom: 2px solid #1e6798; /* garis muncul saat hover */
        }

        .nav-item.active .nav-link {
            color: #1e6798;
            border-bottom: 2px solid #1e6798; /* garis muncul saat aktif */
            background: none; /* hapus background */
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: #ffffff;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .navbar-brand img {
                max-height: 40px;
            }

            .brand-text {
                font-size: 1.25rem;
            }

            .navbar-collapse {
                background: #ffffff;
                border-radius: 12px;
                margin-top: 0.75rem;
                padding: 1rem;
                box-shadow: var(--shadow);
            }

            .nav-link {
                margin: 0.25rem 0;
                padding: 0.75rem 1rem;
            }
        }

        @media (max-width: 575.98px) {
            .brand-text {
                font-size: 1.1rem;
            }

            .navbar-brand img {
                max-height: 35px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
                <img src="assets/image/logo.jpg" alt="THO-KING RENTAL">
                <span class="brand-text">THO-KING RENTAL</span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo ($currentPage == 'dashboard.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item <?php echo ($currentPage == 'blog.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="blog.php">
                            <i class="fas fa-car"></i> Mobil
                        </a>
                    </li>
                    <li class="nav-item position-relative <?php echo ($currentPage == 'riwayat_pesanan.php') ? 'active' : ''; ?>">
                        <?php if (isset($_SESSION['USER'])): ?>
                            <?php
                            // Ambil data jumlah nota yang belum dibaca
                            require_once 'koneksi/koneksi.php';
                            $user_id = $_SESSION['USER']['id_login'];
                            
                            try {
                                $stmt = $koneksi->prepare("SELECT COUNT(*) FROM nota WHERE id_login = ? AND status = 'belum_dibaca'");
                                $stmt->execute([$user_id]);
                                $notifCount = $stmt->fetchColumn();
                            } catch(PDOException $e) {
                                // Silent fail for notification count
                                $notifCount = 0;
                            }
                            ?>
                            <a class="nav-link" href="riwayat_pesanan.php?id=<?= urlencode($lastBooking['kode_booking']); ?>" title="Pesanan">
                                <i class="fas fa-credit-card"></i> Pesanan
                                <?php if ($notifCount > 0): ?>
                                    <span class="notification-badge"><?= $notifCount; ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    </li>
                    <?php if (isset($_SESSION['USER'])): ?>
                        <li class="nav-item <?php echo ($currentPage == 'profil.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="profil.php">
                                <i class="fas fa-user"></i> Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="#" 
                            onclick="confirmLogout(); return false;">
                            <strong>Logout</strong>
                            </a>
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                function confirmLogout() {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Konfirmasi Logout',
                                        text: 'Apakah Anda yakin ingin logout?',
                                        showCancelButton: true,
                                        confirmButtonText: 'Ya, Logout',
                                        cancelButtonText: 'Batal',
                                        background: "#fff",
                                        color: "#161412ff",
                                        customClass: {
                                            popup: "animated fadeInDown" // Animasi kotak alert
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = 'admin/logout.php'; // Arahkan ke halaman logout
                                        }
                                    });
                                }
                                </script>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="index.php">
                                <strong>Login</strong>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
