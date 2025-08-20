<?php
    session_start();
    require 'koneksi/koneksi.php';
    include 'header.php';
    $id = strip_tags($_GET['id']);
    $hasil = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $hasil['merk']; ?> - THO-KING RENTAL</title>
    
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
            background: #f8fafc;
            color: #1e293b;
        }

        .hero-section {
            height: 50vh;
            background: linear-gradient(rgba(30, 58, 138, 0.8), rgba(59, 130, 246, 0.8)), 
                        url('assets/image/<?php echo $hasil['gambar'];?>');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-5px);
        }

        .card-image {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .price-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #1e3a8a;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
        }

        .spec-item {
            display: flex;
            align-items: center;
            padding: 12px;
            margin-bottom: 8px;
            background: rgba(30, 58, 138, 0.05);
            border-radius: 8px;
        }

        .spec-icon {
            width: 20px;
            color: #1e3a8a;
            margin-right: 12px;
        }

        .btn-primary-custom {
            background: #0144faff;
            border: none;
            padding: 12px 32px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background: #3b82f6
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
<!-- judul besar -->
<section class="hero-section">
    <div>
        <h1 class="hero-title"><?php echo $hasil['merk'];?></h1>
        <p class="hero-subtitle">Detail Spesifikasi & Informasi Lengkap</p>
    </div>
</section>

<div class="container mt-4 mb-5">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="detail-card" data-aos="fade-up">
                <div class="card-image">
                    <img src="assets/image/<?php echo $hasil['gambar'];?>" alt="<?php echo $hasil['merk'];?>">
                    <div class="status-badge bg-<?php echo $hasil['status'] == 'Tersedia' ? 'success' : 'danger'; ?> text-white">
                        <i class="fas fa-<?php echo $hasil['status'] == 'Tersedia' ? 'check' : 'times'; ?>-circle me-1"></i>
                        <?php echo $hasil['status'];?>
                    </div>
                    <div class="price-badge">
                        Rp <?php echo number_format($hasil['harga']);?>/hari
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <h2 class="mb-3 fw-bold" style="color: #1e3a8a;">
                        <?php echo $hasil['merk'];?>
                    </h2>
                    
                    <div class="mb-4">
                        <h5 class="text-muted mb-3">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Deskripsi
                        </h5>
                        <p class="text-muted" style="line-height: 1.8;">
                            <?php echo nl2br($hasil['deskripsi']);?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- section spesifikasi -->
        <div class="col-lg-4">
            <!-- Specs Card -->
            <div class="detail-card mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header bg-primary text-white p-3">
                    <h5 class="mb-0">
                        <i class="fas fa-list-alt me-2"></i>
                        Spesifikasi
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div class="spec-item">
                        <i class="fas fa-car spec-icon"></i>
                        <span class="spec-label">Merk :</span>&nbsp;
                        <span class="spec-value"><?php echo $hasil['merk'];?></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-palette spec-icon"></i>
                        <span class="spec-label">Warna :</span>&nbsp;
                        <span class="spec-value"><?php echo $hasil['warna'];?></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-cog spec-icon"></i>
                        <span class="spec-label">Transmisi :</span>&nbsp;
                        <span class="spec-value"><?php echo $hasil['transmisi'];?></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-users spec-icon"></i>
                        <span class="spec-label">Kapasitas :</span>&nbsp;
                        <span class="spec-value"><?php echo $hasil['kapasitas'];?> Orang</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-gas-pump spec-icon"></i>
                        <span class="spec-label">Bahan Bakar :</span>&nbsp;
                        <span class="spec-value"><?php echo $hasil['jenis_bensin'];?></span>
                    </div>
                </div>
            </div>
            
            <!--kotak booking-->
            <div class="detail-card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-success text-white p-3">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-check me-2"></i>
                        Booking Sekarang
                    </h5>
                </div>
                <div class="card-body p-4 text-center">
                    <h3 class="text-primary fw-bold mb-2">
                        Rp <?php echo number_format($hasil['harga']);?>
                    </h3>
                    <p class="text-muted mb-4">Per hari</p>
                    
                    <?php if($hasil['status'] == 'Tersedia'):?>
                        <a href="booking.php?id=<?php echo $hasil['id_mobil'];?>" 
                           class="btn btn-primary-custom w-100 mb-3">
                            <i class="fas fa-calendar-check me-2"></i>
                            Booking Sekarang
                        </a>
                    <?php else:?>
                        <button class="btn btn-secondary w-100 mb-3" disabled>
                            <i class="fas fa-calendar-times me-2"></i>
                            Tidak Tersedia
                        </button>
                    <?php endif;?>
                    
                    <a href="blog.php" class="btn btn-outline-custom w-100">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
AOS.init({
    duration: 800,
    once: true,
    offset: 100
});
</script>

</body>
</html>
