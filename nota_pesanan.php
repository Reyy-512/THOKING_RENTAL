<?php
session_start();
require 'koneksi/koneksi.php';

if (!isset($_SESSION['USER'])) {
    echo '<script>alert("Silakan login terlebih dahulu."); window.location="login.php";</script>';
    exit;
}

$id_login = $_SESSION['USER']['id_login'];
$nota = $koneksi->prepare("SELECT * FROM nota WHERE id_login=? ORDER BY tanggal DESC");
$nota->execute([$id_login]);
$data = $nota->fetchAll(PDO::FETCH_ASSOC);

// update status menjadi 'dibaca' setelah diakses
$koneksi->prepare("UPDATE nota SET status='dibaca' WHERE id_login=?")->execute([$id_login]);
include 'header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pesanan - THO-KING</title>
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
        
        .hero-content {
            text-align: center;
            color: white;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
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
            <i class="fas fa-file-invoice me-3"></i>Nota Pesanan Anda
        </h1>
        <p class="lead">Kelola dan pantau semua pesanan rental mobil Anda</p>
    </div>
</section>

<div class="container section-padding">
    <div class="row">
        <div class="col-12">
            <h2 class="section-title" data-aos="fade-up">
                <i class="fas fa-history me-2"></i>Riwayat Pesanan
            </h2>
        </div>
    </div>

    <?php if ($data): ?>
        <div class="row">
            <?php foreach ($data as $index => $row): ?>
                <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <div class="modern-card">
                        <div class="card-header-modern">
                            <h5>
                                <i class="fas fa-receipt me-2"></i>
                                Kode Booking: <?= htmlspecialchars($row['kode_booking']); ?>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <div class="info-label">
                                            <i class="fas fa-money-bill-wave me-2"></i>Total Harga
                                        </div>
                                        <div class="h5 mb-0 text-primary">
                                            Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <div class="info-label">
                                            <i class="fas fa-calendar-alt me-2"></i>Tanggal Nota
                                        </div>
                                        <div class="h6 mb-0">
                                            <?= date('d M Y', strtotime($row['tanggal'])); ?>
                                            <br>
                                            <small class="text-muted"><?= date('H:i', strtotime($row['tanggal'])); ?> WIB</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="info-label me-2">
                                                <i class="fas fa-info-circle me-1"></i>Status:
                                            </span>
                                            <?php if ($row['status'] == 'dibaca'): ?>
                                                <span class="badge bg-success badge-status">
                                                    <i class="fas fa-check-circle me-1"></i>Dibaca
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark badge-status">
                                                    <i class="fas fa-clock me-1"></i>Belum Dibaca
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-12">
                                    <?php
                                    $jenis = strtolower($row['jenis']);
                                    $isRejected = ($jenis === 'ditolak');
                                    $btnClass = $isRejected ? 'btn-danger-modern' : 'btn-success-modern';
                                    $btnLabel = $isRejected ? 'Cetak Nota Penolakan' : 'Cetak Nota Pesanan';
                                    $btnIcon = $isRejected ? 'fas fa-times-circle' : 'fas fa-print';
                                    ?>
                                    
                                    <a href="cetak_nota.php?id=<?= $row['id_nota']; ?>" 
                                       target="_blank" 
                                       class="btn-modern <?= $btnClass; ?> w-100">
                                        <i class="<?= $btnIcon; ?> me-2"></i><?= $btnLabel; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="no-data fade-in-up">
                    <i class="fas fa-file-excel fa-4x mb-4"></i>
                    <h4>Belum ada nota pesanan</h4>
                    <p class="text-muted">Anda belum memiliki nota pesanan dari admin. Silakan melakukan booking mobil terlebih dahulu.</p>
                    <a href="blog.php" class="btn-modern mt-3">
                        <i class="fas fa-car me-2"></i>Lihat Daftar Mobil
                    </a>
                </div>
            </div>
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

// Real-time clock update
function updateClock() {
    const now = new Date();
    const options = { 
        day: '2-digit', 
        month: 'short', 
        year: 'numeric', 
        hour: '2-digit', 
        minute: '2-digit',
        second: '2-digit'
    };
    const timeString = now.toLocaleString('id-ID', options);
    
    // Update all clock elements
    document.querySelectorAll('.jam-realtime').forEach(el => {
        el.textContent = timeString;
    });
}

// Update clock every second
setInterval(updateClock, 1000);
updateClock();
</script>

<?php include 'footer.php'; ?>
</body>
</html>
