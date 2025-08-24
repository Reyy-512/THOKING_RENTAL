<?php
session_start();
require 'koneksi/koneksi.php';

// Cek jika pengguna sudah login
if (!isset($_SESSION['USER'])) {
    echo '<script>alert("Silakan login terlebih dahulu."); window.location="login.php";</script>';
    exit;
}

$id_login = $_SESSION['USER']['id_login'];

// Ambil data riwayat booking
$riwayat_stmt = $koneksi->prepare("SELECT * FROM booking WHERE id_login=? ORDER BY tanggal DESC");
$riwayat_stmt->execute([$id_login]);
$riwayat_booking = $riwayat_stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil data nota
$nota = $koneksi->prepare("SELECT * FROM nota WHERE id_login=? ORDER BY tanggal DESC");
$nota->execute([$id_login]);
$data = $nota->fetchAll(PDO::FETCH_ASSOC);

// Update status menjadi 'dibaca'
$koneksi->prepare("UPDATE nota SET status='dibaca' WHERE id_login=? AND status='belum_dibaca'")->execute([$id_login]);

include 'header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan - THO-KING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
        }
        
        .hero-section {
            position: relative;
            height: 40vh;
            min-height: 300px;
            overflow: hidden;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .hero-content h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(249, 248, 248, 0.3);
            animation: fadeInUp 1s ease-out;
        }

        .hero-content p {
            font-size: clamp(1.2rem, 3vw, 1.5rem);
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.2s both;
        }
        
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .section-padding {
            padding: 60px 0;
        }
        
        .modern-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(30, 58, 138, 0.1);
            margin-bottom: 2rem;
        }
        
        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #1e3a8a;
        }
        
        .modern-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1e3a8a, #3b82f6);
        }
        
        .card-header-modern {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            border: none;
            padding: 1.5rem;
        }
        
        .card-header-modern h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1.25rem;
        }
        
        .info-box {
            background: rgba(30, 58, 138, 0.05);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #1e3a8a;
        }
        
        .info-label {
            font-weight: 600;
            color: #1e3a8a;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-status {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
        }
        
        .btn-modern {
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            color: white;
        }
        
        .btn-success-modern {
            background: linear-gradient(135deg, #059669, #10b981);
        }
        
        .btn-success-modern:hover {
            background: linear-gradient(135deg, #10b981, #34d399);
        }
        
        .btn-danger-modern {
            background: linear-gradient(135deg, #dc2626, #ef4444);
        }
        
        .btn-danger-modern:hover {
            background: linear-gradient(135deg, #ef4444, #f87171);
        }
        
        .no-data {
            text-align: center;
            padding: 4rem 2rem;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }
        
        .no-data i {
            color: #1e3a8a;
            margin-bottom: 1rem;
        }
        
        .no-data h4 {
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 2rem;
            text-align: center;
        }
        .hero-subtitle {
            color: #f4f6f8ff;
            font-size: 1.1rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                height: 30vh;
                min-height: 200px;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .section-padding {
                padding: 40px 0;
            }
            
            .modern-card {
                margin-bottom: 1.5rem;
            }
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">
            <i class="fas fa-file-invoice me-3"></i>Riwayat Pesanan Anda
        </h1>
    </div>
</section>

<div class="container">
    <?php if ($riwayat_booking): ?>
        <div class="row">
            <?php foreach ($riwayat_booking as $index => $riwayat): ?>
                <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $index * 100; ?>">
                    <div class="modern-card">
                        <div class="card-header-modern">
                            <h5 class="d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-receipt me-2"></i>
                                    Kode Booking: <?= htmlspecialchars($riwayat['kode_booking']); ?>
                                </span>
                                <span> <i class="fas fa-calendar me-2"></i>
                                    <?= date('d M Y'); ?>
                                </span>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <p>Nama: <?= htmlspecialchars($riwayat['nama']); ?></p>
                            <p>Total Bayar: Rp <?= number_format($riwayat['total_harga'], 0, ',', '.'); ?></p>
                            <p>Status: 
                                <strong>
                                    <?php 
                                    $status = htmlspecialchars($riwayat['konfirmasi_pembayaran']);
                                    $statusClass = '';

                                    switch ($status) {
                                        case 'Pembayaran di terima':
                                            $statusClass = 'text-success'; // Green
                                            break;
                                        case 'Pembayaran ditolak':
                                            $statusClass = 'text-danger'; // Red
                                            break;
                                        case 'Belum Bayar':
                                            $statusClass = 'text-warning'; // Red
                                            break;
                                        default:
                                            $statusClass = 'text-muted'; // Default or unknown status
                                            break;
                                    }
                                    ?>
                                    <span class="<?= $statusClass; ?>"><?= $status; ?></span>
                                </strong>
                            </p>
                            
                            <!-- Tombol Cek Status Pesanan dan Cetak Nota -->
                            <div class="d-flex justify-content-between mt-3">
                                <!-- Tombol Cek Status Pesanan -->
                                <a href="bayar.php?id=<?= urlencode($riwayat['kode_booking']); ?>" class="btn btn-modern w-50 me-2">
                                    <i class="fas fa-credit-card me-2"></i> Cek Detail Pesanan
                                </a>

                                <!-- Tombol Cetak Nota -->
                                <?php
                                $nota_stmt = $koneksi->prepare("SELECT * FROM nota WHERE kode_booking = ?");
                                $nota_stmt->execute([$riwayat['kode_booking']]);
                                $nota_data = $nota_stmt->fetch();

                                if ($nota_data): // Memeriksa apakah ada nota
                                    $jenis = strtolower($nota_data['jenis']);
                                    $isRejected = ($jenis === 'ditolak');
                                    $btnClass = $isRejected ? 'btn-danger-modern' : 'btn-success-modern';
                                    $btnLabel = $isRejected ? 'Cetak Nota Penolakan' : 'Cetak Nota Pesanan';
                                    $btnIcon = $isRejected ? 'fas fa-print' : 'fas fa-print';
                                ?>
                                <a href="cetak_nota.php?id=<?= $nota_data['id_nota']; ?>" 
                                   target="_blank" 
                                   class="btn-modern <?= $btnClass; ?> w-50">
                                    <i class="<?= $btnIcon; ?> me-2"></i><?= $btnLabel; ?>
                                </a>
                                <?php endif; // Tutup pemeriksaan nota ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-data fade-in-up">
            <i class="fas fa-file-excel fa-4x mb-4"></i>
            <h4>Belum ada riwayat booking</h4>
            <p class="text-muted">Anda belum melakukan booking mobil sebelumnya.</p>
            <a href="blog.php" class="btn-modern mt-3">
                <i class="fas fa-car me-2"></i>Lihat Daftar Mobil
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
// Initialize AOS Animation
AOS.init({
    duration: 800,
    once: true,
    offset: 100
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>
