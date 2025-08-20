<?php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';

// Pastikan user login
if (empty($_SESSION['USER'])) {
    echo '<script>alert("Harap login !");window.location="index.php"</script>';
    exit;
}

// Ambil kode booking dari URL dan amankan
$kode_booking = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
if (!$kode_booking) {
    echo '<script>alert("Kode booking tidak ditemukan");window.location="index.php"</script>';
    exit;
}

// Ambil data booking
$stmt = $koneksi->prepare("SELECT * FROM booking WHERE kode_booking = ?");
$stmt->execute([$kode_booking]);
$hasil = $stmt->fetch();

if (!$hasil) {
    echo '<script>alert("Data booking tidak ditemukan");window.location="index.php"</script>';
    exit;
}

// Ambil data mobil
$stmtMobil = $koneksi->prepare("SELECT * FROM mobil WHERE id_mobil = ?");
$stmtMobil->execute([$hasil['id_mobil']]);
$isi = $stmtMobil->fetch();

// Update total harga hanya jika belum ada
if (empty($hasil['total_harga']) || $hasil['total_harga'] == 0) {
    $lama_sewa = intval($hasil['lama_sewa']);
    $harga_mobil = intval($isi['harga']);
    $kode_unik = random_int(100, 999);
    $total_harga = ($harga_mobil * $lama_sewa) + $kode_unik;

    $update = $koneksi->prepare("UPDATE booking SET total_harga = ? WHERE kode_booking = ?");
    $update->execute([$total_harga, $kode_booking]);

    // Refresh data booking
    $stmt->execute([$kode_booking]);
    $hasil = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - <?php echo $hasil['kode_booking']; ?> | THO-KING RENTAL</title>
    
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
            height: 40vh;
            background: linear-gradient(rgba(30, 58, 138, 0.8), rgba(59, 130, 246, 0.8)), 
                        url('assets/image/<?php echo $isi['gambar'];?>');
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
            border: none;
        }

        .detail-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            border: none;
            padding: 1.5rem;
        }

        .payment-info {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .payment-bank {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .payment-bank:hover {
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .btn-primary-custom {
            background: #1e3a8a;
            border: none;
            padding: 12px 32px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            background: #3b82f6;
            transform: translateY(-2px);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid #1e3a8a;
            color: #1e3a8a;
            padding: 12px 32px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-custom:hover {
            background: #1e3a8a;
            color: white;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #374151;
        }

        .info-value {
            color: #6b7280;
            text-align: right;
        }

        .total-price {
            background: #fef3c7;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            margin: 1rem 0;
        }

        .price-amount {
            font-size: 2rem;
            font-weight: 700;
            color: #1e3a8a;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

<!-- Judul Besar -->
<section class="hero-section">
    <div>
        <h1 class="hero-title">Pembayaran</h1>
        <p class="hero-subtitle">Kode Booking: <?php echo $hasil['kode_booking']; ?></p>
    </div>
</section>

<div class="container mt-4 mb-5">
    <div class="row g-4">
        <!-- Main Content - Payment Details -->
        <div class="col-lg-8">
            <div class="detail-card p-4" data-aos="fade-up">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-file-invoice me-2"></i>
                        Detail Pembayaran
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">Kode Booking</span>
                                <span class="info-value"><?php echo $hasil['kode_booking']; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Nama</span>
                                <span class="info-value"><?php echo $hasil['nama']; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">KTP</span>
                                <span class="info-value"><?php echo $hasil['ktp']; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Telepon</span>
                                <span class="info-value"><?php echo $hasil['no_tlp']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">Tanggal Sewa</span>
                                <span class="info-value"><?php echo date('d/m/Y', strtotime($hasil['tanggal'])); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Lama Sewa</span>
                                <span class="info-value"><?php echo $hasil['lama_sewa']; ?> hari</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Waktu Sewa</span>
                                <span class="info-value"><?php echo ucfirst($hasil['waktu_sewa']); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Metode Pengambilan</span>
                                <span class="info-value">
                                    <?php 
                                    if ($hasil['metode_pengambilan'] == 'diantar') {
                                        echo "Diantar ke Alamat";
                                    } elseif ($hasil['metode_pengambilan'] == 'ambil_sendiri') {
                                        echo "Jemput Di Rental";
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="total-price">
                        <h5 class="mb-2">Total Pembayaran</h5>
                        <div class="price-amount">
                            Rp <?php echo number_format($hasil['total_harga']); ?>
                        </div>
                    </div>

                    <div class="text-center">
                        <span class="status-badge bg-<?php echo $hasil['konfirmasi_pembayaran'] == 'Belum Bayar' ? 'danger' : 'success'; ?> text-white">
                            <i class="fas fa-<?php echo $hasil['konfirmasi_pembayaran'] == 'Belum Bayar' ? 'clock' : 'check'; ?> me-1"></i>
                            <?php echo $hasil['konfirmasi_pembayaran']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Detail Mobil -->
            <div class="detail-card mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-credit-card me-2"></i>
                        Detail Mobil
                    </h5>
                </div>
                <div class="card-body p-4">
                                    <div class="card-body p-4 text-center">
                    <img src="assets/image/<?php echo $isi['gambar']; ?>" 
                         alt="<?php echo $isi['merk']; ?>" 
                         class="img-fluid rounded mb-3" 
                         style="max-height: 150px; object-fit: cover;">
                    <h5 class="text-primary mb-2"><?php echo $isi['merk']; ?></h5>
                    <p class="text-muted mb-3"><?php echo $isi['warna']; ?> • <?php echo $isi['transmisi']; ?></p>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Kapasitas:</span>
                        <span class="fw-bold"><?php echo $isi['kapasitas']; ?> Orang</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Harga/Hari:</span>
                        <span class="fw-bold text-primary">Rp <?php echo number_format($isi['harga']); ?></span>
                    </div>
                </div>
                    
                    <?php if($hasil['konfirmasi_pembayaran'] == 'Belum Bayar'): ?>
                        <a href="konfirmasi.php?id=<?php echo $kode_booking; ?>" 
                           class="btn btn-primary-custom w-100 mb-3">
                            <i class="fas fa-upload me-2"></i>
                            Konfirmasi Pembayaran
                        </a>
                    <?php else: ?>
                        <button class="btn btn-success w-100 mb-3" disabled>
                            <i class="fas fa-check-circle me-2"></i>
                            Pembayaran Terkonfirmasi
                        </button>
                    <?php endif; ?>
                    
                    <a href="index.php" class="btn btn-outline-custom w-100">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
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