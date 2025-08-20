<?php
session_start();
require 'koneksi/koneksi.php';
$title_web = 'Paket Mobil';

include 'header.php';

// Ambil semua paket untuk dropdown
$paket_stmt = $koneksi->query("SELECT * FROM paket_mobil ORDER BY id_paket ASC");
$paket_list_all = $paket_stmt->fetchAll(PDO::FETCH_ASSOC);

// Cek apakah user memilih filter paket
$filter_tipe = $_GET['tipe'] ?? '';

if (!empty($filter_tipe)) {
    // Jika filter aktif, hanya ambil paket dengan tipe tersebut
    $paket_stmt = $koneksi->prepare("SELECT * FROM paket_mobil WHERE tipe = ? ORDER BY id_paket ASC");
    $paket_stmt->execute([$filter_tipe]);
} else {
    // Jika tidak, ambil semua paket
    $paket_stmt = $koneksi->query("SELECT * FROM paket_mobil ORDER BY id_paket ASC");
}
$paket_list = $paket_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Mobil - THO-KING RENTAL</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #bec7d436;
            color: #1e293b;
            line-height: 1.6;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 35vh;
            min-height: 300px;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            overflow: hidden;
        }

        .hero-content h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out;
        }

        .hero-content p {
            font-size: clamp(1.2rem, 3vw, 1.5rem);
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        /* Filter Section */
        .filter-section {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid rgba(30, 58, 138, 0.1);
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            justify-content: center;
        }

        .form-select-custom {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .form-select-custom:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .btn-filter {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-reset {
            background: #e2e8f0;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            color: #1e293b;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-reset:hover {
            background: #cbd5e1;
            transform: translateY(-2px);
        }

        /* Package Cards */
        .package-section {
            padding: 4rem 0;
        }

        .package-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(30, 58, 138, 0.1);
            height: 100%;
        }

        .package-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #1e3a8a;
        }

        .package-header {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .package-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .package-description {
            background: #e3e6ebff;
            padding: 1.5rem;
            border-radius: 0 0 20px 20px;
        }

        .car-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .car-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(30, 58, 138, 0.1);
        }

        .car-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #1e3a8a;
        }

        .car-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .car-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .car-card:hover .car-image {
            transform: scale(1.1);
        }

        .car-status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
        }

        .status-available {
            background: #10b981;
        }

        .status-rented {
            background: #f59f0b;
        }

        .status-unavailable {
            background: #ef4444;
        }

        .car-info {
            padding: 1.5rem;
        }

        .car-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .car-type {
            color: #64748b
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .car-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 1rem;
        }

        .car-price small {
            font-size: 0.8rem;
            color: #64748b
        }

        .car-actions {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .btn-action {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-book {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
        }

        .btn-book:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
        }

        .btn-detail {
            background: #d1d6dfff;
            color: #1e3a8a;
            border: 1px solid #1e3a8a;
        }

        .btn-detail:hover {
            background: #1e3a8a;
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #64748b
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                height: 40vh;
                min-height: 300px;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .form-select-custom,
            .btn-filter,
            .btn-reset {
                width: 100%;
            }

            .car-grid {
                grid-template-columns: 1fr;
            }

            .package-section {
                padding: 2rem 0;
            }
        }

        /* Animations */
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
            animation: fadeInUp 0.1s ease-out;
        }

        /* Scroll Progress */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: rgba(30, 58, 138, 0.2);
            z-index: 1000;
        }

        .scroll-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #1e3a8a, #3b82f6);
            width: 0%;
            transition: width 0.1s ease;
        }
    </style>
</head>
<body>

<!-- Scroll Progress Indicator -->
<div class="scroll-progress">
    <div class="scroll-progress-bar"></div>
</div>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1><i class="fas fa-layer-group"></i> Paket Mobil</h1>
        <p>Pilih paket mobil terbaik sesuai kebutuhan Anda</p>
    </div>
</section>

<!-- Filter Section -->
<div class="container">
    <div class="filter-section" data-aos="fade-in-up">
        <form method="get" class="filter-form">
            <div>
                <label class="form-label fw-bold mb-2">Filter Paket:</label>
                <select name="tipe" class="form-select-custom">
                    <option value="">Semua Paket Mobil</option>
                    <?php foreach ($paket_list_all as $p): ?>
                        <option value="<?= htmlspecialchars($p['tipe']); ?>" 
                                <?= ($filter_tipe == $p['tipe']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($p['tipe']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn-filter">
                    <i class="fas fa-search"></i> Cari
                </button>
                <?php if (!empty($filter_tipe)): ?>
                    <a href="blog.php" class="btn-reset">
                        <i class="fas fa-sync"></i> Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<!-- Package Section -->
<div class="package-section">
    <div class="container">
        <?php if (count($paket_list) > 0): ?>
            <?php foreach ($paket_list as $paket): ?>
                <div class="mb-5" data-aos="fade-in-up">
                    <div class="package-card">
                        <div class="package-header">
                            <h3 class="package-title">
                                <i class="fas fa-car me-2"></i>
                                <?= htmlspecialchars($paket['tipe']); ?>
                            </h3>
                        </div>
                        <div class="package-description">
                            <p><?= nl2br(htmlspecialchars($paket['deskripsi'])); ?></p>
                        </div>
                    </div>

                    <?php
                    $mobil_stmt = $koneksi->prepare("SELECT * FROM mobil WHERE tipe = :tipe ORDER BY id_mobil DESC");
                    $mobil_stmt->execute([':tipe' => $paket['tipe']]);
                    $id_mobil = $mobil_stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php if (count($id_mobil) > 0): ?>
                        <div class="car-grid mt-4">
                            <?php foreach ($id_mobil as $m): ?>
                                <div class="car-card" data-aos="fade-in-up"<?= $m['id_mobil'] * 100 ?>">
                                    <div class="car-image-wrapper">
                                        <img src="assets/image/<?= htmlspecialchars($m['gambar']); ?>" 
                                             alt="<?= htmlspecialchars($m['merk']); ?>" 
                                             class="car-image">
                                        <?php
                                        $status = $m['status'];
                                        if (empty($status)) {
                                            $status = 'Tidak Tersedia';
                                        }
                                        
                                        $badge_class = '';
                                        $status_text = '';
                                        switch ($status) {
                                            case 'Tersedia':
                                                $badge_class = 'status-available';
                                                $status_text = 'Tersedia';
                                                break;
                                            case 'Dalam Masa Sewa':
                                                $badge_class = 'status-rented';
                                                $status_text = 'Dalam Sewa';
                                                break;
                                            default:
                                                $badge_class = 'status-unavailable';
                                                $status_text = 'Tidak Tersedia';
                                        }
                                        ?>
                                        <span class="car-status-badge <?= $badge_class ?>">
                                            <?= htmlspecialchars($status_text) ?>
                                        </span>
                                    </div>
                                    <div class="car-info">
                                        <h4 class="car-name"><?= htmlspecialchars($m['merk']); ?></h4>
                                        <p class="car-type">
                                            <i class="fas fa-tag"></i> <?= htmlspecialchars($m['tipe']); ?>
                                        </p>
                                        <div class="car-price">
                                            Rp <?= number_format($m['harga'], 0, ',', '.'); ?>
                                            <small>/ hari</small>
                                        </div>
                                        <div class="car-actions">
                                            <?php if ($m['status'] == 'Tersedia'): ?>
                                                <a href="booking.php?id=<?= (int) $m['id_mobil']; ?>" 
                                                   class="btn-action btn-book">
                                                    <i class="fas fa-car me-1"></i> Pesan
                                                </a>
                                            <?php else: ?>
                                                <button class="btn-action btn-book" disabled>
                                                    <i class="fas fa-ban me-1"></i> Dalam Penyewaan
                                                </button>
                                            <?php endif; ?>
                                            <a href="detail.php?id=<?= (int) $m['id_mobil']; ?>" 
                                               class="btn-action btn-detail">
                                                <i class="fas fa-info-circle me-1"></i> Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-car-side"></i>
                            <h4>Tidak ada mobil tersedia</h4>
                            <p>Mohon maaf, saat ini tidak ada mobil yang tersedia pada paket ini.</p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state" data-aos="fade-in-up">
                <i class="fas fa-layer-group"></i>
                <h4>Belum ada paket mobil</h4>
                <p>Mohon maaf, belum ada paket mobil yang tersedia saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>

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

// Scroll Progress Indicator
window.addEventListener('scroll', function() {
    const scrollProgress = document.querySelector('.scroll-progress-bar');
    const scrollTop = window.pageYOffset;
    const docHeight = document.body.offsetHeight;
    const winHeight = window.innerHeight;
    const scrollPercent = scrollTop / (docHeight - winHeight);
    const scrollPercentRounded = Math.round(scrollPercent * 100);
    scrollProgress.style.width = scrollPercentRounded + '%';
});

// Smooth scrolling for internal links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>

</body>
</html>
