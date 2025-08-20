<?php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';

// Ambil data mobil untuk ditampilkan
$querymobil = $koneksi->query('SELECT * FROM mobil ORDER BY id_mobil DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THO-KING RENTAL - Beranda</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="./assets/css/dashboard_user.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
        }
        
        /* Hero Section */
        .hero-section {
            position: relative;
            height: 70vh;
            min-height: 500px;
            overflow: hidden;

        }
        
        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        
        .hero-background img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.6);
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 0 20px;
        }
        
        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            animation: fadeInUp 1s ease-out;
        }
        
        .hero-subtitle {
            font-size: clamp(1.2rem, 3vw, 1.8rem);
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            animation: fadeInUp 1s ease-out 0.2s both;
        }
        
        .hero-cta {
            animation: fadeInUp 1s ease-out 0.4s both;
        }
        
        .btn-hero {
            padding: 15px 40px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }
        
        /* Card Enhancements */
        .modern-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(30, 58, 138, 0.1);
        }
        
        .modern-card:hover {
            transform: translateY(-8px);
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
        
        .card-image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 20px 20px 0 0;
        }
        
        .card-image-wrapper img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .modern-card:hover .card-image-wrapper img {
            transform: scale(1.1);
        }
        
        .card-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #1e3a8a;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        /* Section Styling */
        .section-padding {
            padding: 80px 0;
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
        
        /* Feature Cards */
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .feature-item {
            text-align: center;
            padding: 2rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(30, 58, 138, 0.1);
        }
        
        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-color: #1e3a8a;
        }
        
        .feature-iconD {
            font-size: 3rem;
            color: #cdbc29ff;
            margin-bottom: 1rem;
        }
      
        .feature-iconJ {
            font-size: 3rem;
            color: #3ed233ff;
            margin-bottom: 1rem;
        }
        
        .feature-iconC {
            font-size: 3rem;
            color: #c01414ff;
            margin-bottom: 1rem;
        }   
        
        .feature-iconM {
            font-size: 3rem;
            color: #1e3a8a;
            margin-bottom: 1rem;
        } 
        
        .feature-iconB {
            font-size: 3rem;
            color: #e9e223ff;
            margin-bottom: 1rem;
        }   
        
        .feature-iconP {
            font-size: 3rem;
            color: #4b4d54ff;
            margin-bottom: 1rem;
        }        
        
        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1e293b;
        }
        
        /* Rating Section */
        .rating-card {
            background: linear-gradient(135deg, #ffffff, rgba(30, 58, 138, 0.05));
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(30, 58, 138, 0.1);
        }
        
        .rating-display {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .rating-score {
            font-size: 3rem;
            font-weight: 700;
            color: #1e3a8a;
        }
        
        .rating-stars {
            font-size: 2rem;
            color: #3b82f6;
        }
        
        /* Location Cards */
        .location-card {
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border: 1px solid rgba(30, 58, 138, 0.1);
        }
        
        .location-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-color: #1e3a8a;
        }
        
        .location-map {
            width: 100%;
            height: 200px;
            border: none;
        }
        
        .location-info {
            padding: 1.5rem;
        }
        
        .location-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1e3a8a;
        }
        
        .location-address {
            color: #64748b;
            font-size: 0.9rem;
        }
        
        /* Contact Section */
        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .contact-item {
            text-align: center;
            padding: 1.5rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(30, 58, 138, 0.1);
            transition: all 0.3s ease;
        }
        
        .contact-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-color: #1e3a8a;
        }
        
        .contact-icon {
            font-size: 2.5rem;
            color: #1e3a8a;
            margin-bottom: 1rem;
        }
        
        .contact-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1e3a8a;
        }
        
        /* WhatsApp Float - Blue Theme */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #25D366, #128C7E);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            z-index: 1000;
            animation: pulse 2s infinite;
            border: none; /* Menghilangkan border */
            outline: none; /* Menghilangkan outline */
            text-decoration: none; /* Menghilangkan garis bawah */
        }

        .whatsapp-float i {
            color: white; /* Pastikan ikon berwarna putih */
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
            animation: fadeInUp 0.4s ease-out;
        }        
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(30, 58, 138, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(30, 58, 138, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(30, 58, 138, 0);
            }
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                height: 50vh;
                min-height: 400px;
            }
            
            .section-padding {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .feature-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }
        
        /* Welcome Alert */
        .welcome-alert {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        /* Button Enhancements */
        .btn-modern {
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }
        
        /* Scroll Progress Indicator */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: rgba(30, 58, 138, 0.2);
            z-index: 1001;
        }
        
        .scroll-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #1e3a8a, #3b82f6);
            width: 0%;
            transition: width 0.1s ease;
        }
        
        /* Additional Blue Accents */
        .text-primary {
            color: #1e3a8a;
        }
        
        .bg-primary {
            background-color: #1e3a8a ;
        }
        
        .border-primary {
            border-color: #1e3a8a;
        }
    </style>
</head>
<body>

<!-- garis progres -->
<div class="scroll-progress">
    <div class="scroll-progress-bar"></div>
</div>

<!-- WhatsApp -->
<a href="https://wa.me/6282248559459" target="_blank" class="whatsapp-float" aria-label="Chat WhatsApp">
    <i class="fab fa-whatsapp text-white" style="font-size: 35px;"></i>
</a>

<!-- judul besar -->
<section class="hero-section">
    <div class="hero-background">
        <img src="assets/image/index.jpg" alt="Background THO-KING RENTAL">
    </div>
    <div class="hero-content">
        <h1 class="hero-title">THO-KING RENTAL</h1>
        <p class="hero-subtitle">Sewa Mobil Terbaik di Kota Ambon dengan Harga Terjangkau</p>
        <div class="hero-cta">
            <?php if (empty($_SESSION['USER'])): ?>
                <a href="index.php" class="btn btn-hero">
                    <i class="fas fa-sign-in-alt me-2"></i>Login & Temukan Mobil Favoritmu
                </a>
            <?php else: ?>
                <a href="blog.php" class="btn btn-hero">
                    <i class="fas fa-car me-2"></i>Temukan Mobil Favoritmu
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- pesan selamat datang -->
<?php if (!empty($_SESSION['USER'])): ?>
<div class="container mt-4">
    <div class="alert welcome-alert" data-aos="fade-up">
        <h4 class="alert-heading mb-0">
            <i class="fas fa-user-circle me-2"></i>
            Selamat Datang, <?php echo htmlspecialchars($_SESSION['USER']['nama_pengguna'] ?? 'Pelanggan'); ?>!
        </h4>
    </div>
</div>
<?php endif; ?>

<!-- kotak layanan -->
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="modern-card" data-aos="fade-up">
                    <div class="card-body p-5">
                        <h2 class="section-title">
                            <i class="fas fa-star feature-iconB"></i>
                            Nikmati Layanan Rental Mobil Terbaik di Kota Ambon
                        </h2>
                        <p class="section-subtitle">
                            THO-KING RENTAL adalah penyedia layanan rental mobil terkemuka di Kota Ambon dengan berbagai pilihan mobil berkualitas.
                        </p>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                                    <i class="fas fa-dollar-sign feature-iconD"></i>
                                    <h4 class="feature-title">Harga Kompetitif</h4>
                                    <p>Harga terjangkau dengan kualitas terbaik</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                                    <i class="fas fa-clock feature-iconJ"></i>
                                    <h4 class="feature-title">Layanan 24 Jam</h4>
                                    <p>Siap melayani kapan saja Anda butuhkan</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                                    <i class="fas fa-map-marker-alt feature-iconC"></i>
                                    <h4 class="feature-title">2 Cabang Strategis</h4>
                                    <p>Lokasi strategis untuk kemudahan akses</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item" data-aos="fade-up" data-aos-delay="400">
                                    <i class="fas fa-car feature-iconM"></i>
                                    <h4 class="feature-title">Mobil Terawat</h4>
                                    <p>Semua unit dalam kondisi prima dan bersih</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- pilihan Mobil -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Pilihan Mobil Berkualitas</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Pilih dari berbagai jenis mobil sesuai kebutuhan Anda
        </p>
        
        <div class="row g-4 mt-4">
            <?php
            $features = [
                [
                    'image' => 'assets/image/Inova_rebon_pengemudi.png',
                    'title' => 'Innova Reborn',
                    'description' => 'Mobil keluarga nyaman dengan kapasitas besar',
                    'badge' => 'Populer'
                ],
                [
                    'image' => 'assets/image/686ce11eeb270.png',
                    'title' => 'Mobil Pengantin',
                    'description' => 'Mobil pengantin berkelas untuk hari spesial',
                    'badge' => 'Premium'
                ],
                [
                    'image' => 'assets/image/686ce0aa8ef66.png',
                    'title' => 'Mobil Manual',
                    'description' => 'Pengalaman berkendara responsif dengan harga terjangkau',
                    'badge' => 'Ekonomis'
                ],
                [
                    'image' => 'assets/image/686cd4f3e01b1.png',
                    'title' => 'Mobil Matic',
                    'description' => 'Kenyamanan tanpa repot untuk perjalanan santai',
                    'badge' => 'Nyaman'
                ]
            ];
            
            foreach($features as $index => $feature): ?>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="modern-card">
                    <div class="card-image-wrapper">
                        <img src="<?php echo $feature['image']; ?>" alt="<?php echo $feature['title']; ?>">
                        <span class="card-badge"><?php echo $feature['badge']; ?></span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $feature['title']; ?></h5>
                        <p class="card-text text-muted"><?php echo $feature['description']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- perawatan dan kondisi -->
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="modern-card text-center" data-aos="fade-up">
                    <div class="card-body p-5">
                        <i class="fas fa-tools feature-iconP" style="font-size: 4rem;"></i>
                        <h3 class="section-title">
                            <a href="perawatan.php" style="text-decoration: none; color: inherit;">
                                Perawatan & Kondisi Mobil
                            </a>
                        </h3>
                        <p class="lead">
                            THO-KING RENTAL selalu memastikan setiap unit mobil dalam kondisi <strong>prima dan terawat</strong>. 
                            Semua kendaraan rutin menjalani servis berkala dan pengecekan komponen.
                        </p>
                        <a href="perawatan.php" class="btn btn-modern btn-primary">
                            <i class="fas fa-info-circle me-2"></i>Lihat Detail Perawatan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rating Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="rating-card" data-aos="fade-up">
                    <h3 class="section-title">
                        <i class="fas fa-star feature-iconB"></i>
                        <a href="all_ratings.php" style="text-decoration: none; color: inherit;">
                            Rating & Komentar
                        </a>
                    </h3>
                    
                    <?php
                    $rating_stmt = $koneksi->query("SELECT AVG(rating) as rata_rata, COUNT(*) as total FROM rating");
                    $rating_data = $rating_stmt->fetch();
                    $rata_rata = number_format($rating_data['rata_rata'], 1);
                    $total_rating = $rating_data['total'];
                    ?>
                    
                    <div class="rating-display">
                        <div class="rating-score"><?php echo $rata_rata; ?></div>
                        <div>
                            <div class="rating-stars">
                                <?php echo str_repeat('⭐', round($rata_rata)); ?>
                            </div>
                            <p class="text-muted">Dari <?php echo $total_rating; ?> pengguna</p>
                        </div>
                    </div>

                    <?php if (empty($_SESSION['USER'])): ?>
                        <div class="text-center">
                            <a href="index.php" class="btn btn-modern btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>Login untuk memberikan rating
                            </a>
                        </div>
                    <?php else: ?>
                        <?php
                        $hasRated = false;
                        if (!empty($_SESSION['USER']['nama_pengguna'])) {
                            $username = $_SESSION['USER']['nama_pengguna'];
                            $stmt = $koneksi->prepare("SELECT * FROM rating WHERE nama = ? LIMIT 1");
                            $stmt->execute([$username]);
                            $existingRating = $stmt->fetch(PDO::FETCH_ASSOC);
                            $hasRated = $existingRating ? true : false;
                        }
                        ?>
                        
                        <?php if ($hasRated): ?>
                            <div class="alert alert-info text-center">
                                <h5><i class="fas fa-check-circle me-2"></i>Terima kasih atas rating Anda!</h5>
                            </div>
                        <?php else: ?>
                            <form action="proses_rating.php" method="POST" id="ratingForm">
                                <div class="mb-3">
                                    <label class="form-label">Rating Anda</label>
                                    <div class="star-rating text-center" style="font-size: 2rem; cursor: pointer;">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="far fa-star" data-rating="<?php echo $i; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <input type="hidden" name="rating" id="ratingValue" required>
                                </div>
                                <div class="mb-3">
                                    <label for="komentar" class="form-label">Komentar</label>
                                    <textarea class="form-control" name="komentar" rows="3" 
                                              placeholder="Bagaimana pengalaman Anda dengan layanan kami?"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-modern btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Penilaian
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Section -->
<section class="section-padding">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">
            <i class="fas fa-map-marker-alt feature-iconC"></i>
            Lokasi Kami
        </h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Kunjungi salah satu cabang kami yang strategis
        </p>
        
        <div class="row g-4 mt-4">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="location-card">
                    <iframe class="location-map" 
                            src="https://www.google.com/maps?q=Jl.+Kapten+Piere+Tendean,+Hative+Kecil,+Kec.+Sirimau,+Kota+Ambon,+Maluku&output=embed"
                            allowfullscreen="" loading="lazy">
                    </iframe>
                    <div class="location-info">
                        <h4 class="location-title">
                            <i class="fas fa-building text-primary me-2"></i>Cabang Galala
                        </h4>
                        <p class="location-address">
                            Jl. Kapten Piere Tendean, Hative Kecil<br>
                            Kec. Sirimau, Kota Ambon, Maluku
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="location-card">
                    <iframe class="location-map" 
                            src="https://www.google.com/maps?q=Jl.+Baru,+Passo,+Kec.+Baguala,+Kota+Ambon,+Maluku&output=embed"
                            allowfullscreen="" loading="lazy">
                    </iframe>
                    <div class="location-info">
                        <h4 class="location-title">
                            <i class="fas fa-building text-primary me-2"></i>Cabang Passo
                        </h4>
                        <p class="location-address">
                            Jl. Baru, Passo<br>
                            Kec. Baguala, Kota Ambon, Maluku
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="modern-card text-center" data-aos="fade-up">
                    <div class="card-body p-5">
                        <h3 class="section-title">
                            <i class="fas fa-phone feature-icon"></i>
                            Hubungi Kami
                        </h3>
                        
                        <div class="contact-info">
                            <div class="contact-item" data-aos="fade-up" data-aos-delay="100">
                                <i class="fas fa-phone contact-icon"></i>
                                <h4 class="contact-title">Telepon</h4>
                                <p>
                                    <a href="tel:6282248559459" class="text-decoration-none">0822-4855-9459 a/n THO-KING</a><br>
                                    <a href="tel:6282299293363" class="text-decoration-none">0811-4792-151 a/n Engky</a>
                                </p>
                            </div>
                            
                            <div class="contact-item" data-aos="fade-up" data-aos-delay="200">
                                <i class="fas fa-envelope contact-icon"></i>
                                <h4 class="contact-title">Email</h4>
                                <p>
                                    <a href="mailto:cvthoking001@gmail.com" class="text-decoration-none">
                                        cvthoking001@gmail.com
                                    </a>
                                </p>
                            </div>
                            
                            <div class="contact-item" data-aos="fade-up" data-aos-delay="300">
                                <i class="fas fa-clock contact-icon"></i>
                                <h4 class="contact-title">Jam Operasional</h4>
                                <p>Senin - Minggu<br>24 Jam Nonstop</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Custom JavaScript -->
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

// Star Rating Interaction
document.addEventListener('DOMContentLoaded', function() {
    const starContainers = document.querySelectorAll('.star-rating');
    
    starContainers.forEach(container => {
        const stars = container.querySelectorAll('i');
        const ratingInput = container.parentElement.querySelector('input[type="hidden"]');
        
        stars.forEach((star, index) => {
            star.addEventListener('click', function() {
                const rating = index + 1;
                ratingInput.value = rating;
                
                stars.forEach((s, i) => {
                    s.className = i < rating ? 'fas fa-star text-warning' : 'far fa-star';
                });
            });
            
            star.addEventListener('mouseover', function() {
                const rating = index + 1;
                stars.forEach((s, i) => {
                    s.className = i < rating ? 'fas fa-star text-warning' : 'far fa-star';
                });
            });
        });
        
        container.addEventListener('mouseleave', function() {
            const currentRating = ratingInput.value || 0;
            stars.forEach((s, i) => {
                s.className = i < currentRating ? 'fas fa-star text-warning' : 'far fa-star';
            });
        });
    });
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

// Loading Animation
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
});
</script>
</body>
</html>