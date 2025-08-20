<?php
// File: perawatan.php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perawatan & Kondisi Mobil - THO-KING RENTAL</title>
    
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
        
        .hero-section {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('assets/image/background.jpg') center/cover;
            opacity: 0.1;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .section-padding {
            padding: 40px 0;
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
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .feature-icon-blue { color: #1e3a8a; }
        .feature-icon-green { color: #22c55e; }
        .feature-icon-orange { color: #f97316; }
        .feature-icon-purple { color: #8b5cf6; }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            height: 250px;
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(30, 58, 138, 0.8));
            display: flex;
            align-items: flex-end;
            padding: 20px;
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .maintenance-timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .maintenance-timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #1e3a8a;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            padding-left: 40px;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 8px;
            width: 16px;
            height: 16px;
            background: #1e3a8a;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #1e3a8a;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }
        
        .stats-card {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stats-label {
            font-size: 1rem;
            opacity: 0.9;
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">
                <i class="fas fa-tools me-3"></i>Perawatan & Kondisi Mobil
            </h1>
            <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                Kami selalu memastikan mobil dalam kondisi prima melalui perawatan rutin dan standar kualitas tinggi
            </p>
            <a href="#maintenance-gallery" class="btn btn-light btn-lg" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-arrow-down me-2"></i>Lihat Detail Perawatan
            </a>
        </div>
    </div>
</section>

<!-- Overview Section -->
<section class="section-padding" id="maintenance-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="stats-card">
                    <div class="stats-number">100%</div>
                    <div class="stats-label">Mobil Terawat</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card">
                    <div class="stats-number">24/7</div>
                    <div class="stats-label">Pemantauan Kondisi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card">
                    <div class="stats-number">5000+</div>
                    <div class="stats-label">Kilometer Service</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card">
                    <div class="stats-number">100%</div>
                    <div class="stats-label">Kebersihan Terjaga</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Maintenance Features -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Standar Perawatan Kami</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Setiap mobil mendapatkan perawatan berkala sesuai standar industri otomotif
        </p>
        
        <div class="row g-4 mt-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <div class="modern-card h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-oil-can feature-icon feature-icon-blue"></i>
                        <h4 class="card-title">Ganti Oli Rutin</h4>
                        <p class="card-text">
                            Penggantian oli mesin sesuai jadwal untuk menjaga performa optimal mesin mobil.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="modern-card h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-car-battery feature-icon feature-icon-green"></i>
                        <h4 class="card-title">Pengecekan Sistem</h4>
                        <p class="card-text">
                            Pemeriksaan menyeluruh sistem kelistrikan, rem, dan komponen penting lainnya.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="modern-card h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-wheelchair feature-icon feature-icon-orange"></i>
                        <h4 class="card-title">Perawatan Ban</h4>
                        <p class="card-text">
                            Pengecekan tekanan ban, rotasi, dan penggantian sesuai kondisi untuk keselamatan.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="modern-card h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-spray-can feature-icon feature-icon-purple"></i>
                        <h4 class="card-title">Pembersihan Interior</h4>
                        <p class="card-text">
                            Pembersihan menyeluruh interior mobil termasuk vacuum dan sterilisasi.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="modern-card h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-wind feature-icon feature-icon-blue"></i>
                        <h4 class="card-title">AC Service</h4>
                        <p class="card-text">
                            Perawatan sistem AC untuk kenyamanan berkendara dalam segala cuaca.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="modern-card h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-shield-alt feature-icon feature-icon-green"></i>
                        <h4 class="card-title">Safety Check</h4>
                        <p class="card-text">
                            Pemeriksaan keselamatan lengkap sebelum setiap penyewaan untuk keamanan maksimal.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Maintenance Timeline -->
<section class="section-padding">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Proses Perawatan</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Alur perawatan mobil dari awal hingga siap disewakan
        </p>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="maintenance-timeline" data-aos="fade-up" data-aos-delay="200">
                    <div class="timeline-item">
                        <h5 class="fw-bold text-primary">1. Inspeksi Awal</h5>
                        <p>Pemeriksaan kondisi mobil saat kembali dari penyewaan untuk menentukan jenis perawatan yang dibutuhkan.</p>
                    </div>
                    
                    <div class="timeline-item">
                        <h5 class="fw-bold text-primary">2. Pencucian & Pembersihan</h5>
                        <p>Pencucian eksterior dan pembersihan interior menyeluruh untuk menjaga kebersihan dan kenyamanan.</p>
                    </div>
                    
                    <div class="timeline-item">
                        <h5 class="fw-bold text-primary">3. Perawatan Teknis</h5>
                        <p>Pemeriksaan dan perawatan teknis seperti ganti oli, cek rem, tekanan ban, dan sistem kelistrikan.</p>
                    </div>
                    
                    <div class="timeline-item">
                        <h5 class="fw-bold text-primary">4. Quality Control</h5>
                        <p>Pemeriksaan akhir oleh teknisi ahli untuk memastikan semua standar terpenuhi sebelum disewakan kembali.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="section-padding bg-light" id="maintenance-gallery">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Dokumentasi Perawatan</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Lihat dokumentasi proses perawatan mobil kami
        </p>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="gallery-item">
                    <img src="assets/image/perawatan.jpg" alt="Pembersihan Eksterior">
                    <div class="gallery-overlay">
                        <h6>Pembersihan Eksterior</h6>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="gallery-item">
                    <img src="assets/image/perawatan1.jpg" alt="Ganti Oli Mesin">
                    <div class="gallery-overlay">
                        <h6>Pembersihan Eksterior</h6>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="gallery-item">
                    <img src="assets/image/Perawatan (1).jpg" alt="Pengecekan Rem">
                    <div class="gallery-overlay">
                        <h6>Penggantian Ban</h6>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="gallery-item">
                    <img src="assets/image/Perawatan (6).jpg" alt="Pembersihan Interior">
                    <div class="gallery-overlay">
                        <h6>Penggantian Ban</h6>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="gallery-item">
                    <img src="assets/image/Perawatan (4).jpg" alt="Perawatan AC">
                    <div class="gallery-overlay">
                        <h6>Penggantian Oli</h6>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="gallery-item">
                    <img src="assets/image/Perawatan (5).jpg" alt="Quality Control">
                    <div class="gallery-overlay">
                        <h6>Penggantian Oli</h6>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="gallery-item">
                    <img src="assets/image/Perawatan (2).jpg" alt="Pengecekan Ban">
                    <div class="gallery-overlay">
                        <h6>Service AC</h6>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
                <div class="gallery-item">
                    <img src="assets/image/Perawatan (3).jpg" alt="Final Inspection">
                    <div class="gallery-overlay">
                        <h6>Service AC</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="section-padding" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
    <div class="container text-center text-white">
        <h2 class="mb-4" data-aos="fade-up">Siap untuk Berkendara dengan Aman?</h2>
        <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
            Semua mobil kami telah melalui proses perawatan yang ketat untuk memastikan kenyamanan dan keselamatan Anda
        </p>
        <a href="blog.php" class="btn btn-light btn-lg" data-aos="fade-up" data-aos-delay="200">
            <i class="fas fa-car me-2"></i>Lihat Daftar Mobil
        </a>
    </div>
</section>

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