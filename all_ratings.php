<?php
// File: all_ratings.php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';

// Ambil semua data rating terbaru
$ratings_stmt = $koneksi->prepare("SELECT * FROM rating ORDER BY created_at DESC");
$ratings_stmt->execute();
$ratings = $ratings_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Rating Pengguna - THO-KING RENTAL</title>
    
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
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
        }
        
        /* Section Styling */
        .section-padding {
            padding: 30px 0;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .section-subtitle {
            font-size: 1.2rem;
            color: #64748b;
            text-align: center;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Rating Cards */
        .rating-card-modern {
            background: linear-gradient(135deg, #ffffff, rgba(30, 58, 138, 0.05));
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(30, 58, 138, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .rating-card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-color: #1e3a8a;
        }
        
        .rating-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(30, 58, 138, 0.1);
        }
        
        .user-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e3a8a;
            margin: 0;
        }
        
        .rating-stars {
            color: #fbbf24;
            font-size: 1.1rem;
        }
        
        .rating-comment {
            color: #374151;
            line-height: 1.6;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
        
        .rating-date {
            color: #6b7280;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .rating-date i {
            color: #1e3a8a;
        }
        
        /* Stats Section */
        .stats-card {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stats-label {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(30, 58, 138, 0.1);
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }
        
        .empty-state h4 {
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .empty-state p {
            color: #6b7280;
            margin-bottom: 2rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .section-padding {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .rating-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>

<!-- Stats Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4" data-aos="fade-up">
                <div class="stats-card">
                    <div class="stats-number">
                        <?php 
                        $total_stmt = $koneksi->query("SELECT COUNT(*) as total FROM rating");
                        echo $total_stmt->fetch()['total'];
                        ?>
                    </div>
                    <div class="stats-label">Total Rating</div>
                </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card">
                    <div class="stats-number">
                        <?php 
                        $avg_stmt = $koneksi->query("SELECT AVG(rating) as avg FROM rating");
                        $avg = $avg_stmt->fetch()['avg'];
                        echo $avg ? number_format($avg, 1) : '0.0';
                        ?>
                    </div>
                    <div class="stats-label">Rating Rata-rata</div>
                </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card">
                    <div class="stats-number">
                        <?php 
                        $user_stmt = $koneksi->query("SELECT COUNT(DISTINCT nama) as users FROM rating");
                        echo $user_stmt->fetch()['users'];
                        ?>
                    </div>
                    <div class="stats-label">Pengguna</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="section-padding">
    <div class="container">
        <h1 class="section-title" data-aos="fade-up">
            <i class="fas fa-star text-warning"></i>
            Semua Rating & Komentar Pengguna
        </h1>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Lihat pengalaman dan penilaian dari pelanggan kami
        </p>

        <?php if (count($ratings) === 0): ?>
            <div class="empty-state" data-aos="fade-up">
                <i class="fas fa-star"></i>
                <h4>Belum Ada Rating</h4>
                <p>Belum ada rating dari pengguna. Jadilah yang pertama memberikan penilaian!</p>
                <?php if (!empty($_SESSION['USER'])): ?>
                    <a href="dashboard.php" class="btn btn-primary btn-modern">
                        <i class="fas fa-plus me-2"></i>Berikan Rating
                    </a>
                <?php else: ?>
                    <a href="index.php" class="btn btn-primary btn-modern">
                        <i class="fas fa-sign-in-alt me-2"></i>Login untuk Rating
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($ratings as $index => $row): ?>
                    <div class="col-lg-6 col-xl-4" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        <div class="rating-card-modern">
                            <div class="rating-header">
                                <h5 class="user-name">
                                    <i class="fas fa-user-circle me-2 text-primary"></i>
                                    <?php echo htmlspecialchars($row['nama']); ?>
                                </h5>
                                <div class="rating-stars">
                                    <?php echo str_repeat('⭐', intval($row['rating'])); ?>
                                </div>
                            </div>
                            <p class="rating-comment">
                                <?php echo nl2br(htmlspecialchars($row['komentar'])); ?>
                            </p>
                            <div class="rating-date">
                                <i class="fas fa-clock"></i>
                                <?php echo date('d M Y H:i', strtotime($row['created_at'])); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
// Initialize AOS Animation
AOS.init({
    duration: 200,
    once: true,
    offset: 100
});

// Smooth Scrolling
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
