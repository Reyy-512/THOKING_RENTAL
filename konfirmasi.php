<?php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';

if(empty($_SESSION['USER'])) {
    echo '<script>alert("Harap Login");window.location="index.php"</script>';
    exit;
}

$kode_booking = $_GET['id'];
$hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();

$id = $hasil['id_mobil'];
$isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran - <?php echo $hasil['kode_booking']; ?> | THO-KING RENTAL</title>
    
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

        .form-control {
            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
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

        .upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: #3b82f6;
            background: #f8fafc;
        }

        .upload-icon {
            font-size: 3rem;
            color: #9ca3af;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section">
    <div>
        <h1 class="hero-title">Konfirmasi Pembayaran</h1>
        <p class="hero-subtitle">Kode Booking: <?php echo $hasil['kode_booking']; ?></p>
    </div>
</section>

<div class="container mt-4 mb-5">
    <div class="row g-4">
        <!-- Main Content - Payment Confirmation -->
        <div class="col-lg-8">
            <div class="detail-card" data-aos="fade-up">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-upload me-2"></i>
                        Form Konfirmasi Pembayaran
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="koneksi/proses.php?id=konfirmasi" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="info-label">Kode Booking</span>
                                    <span class="info-value"><?php echo htmlspecialchars($hasil['kode_booking']); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Nama</span>
                                    <span class="info-value"><?php echo htmlspecialchars($hasil['nama']); ?></span>
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
                            </div>
                        </div>

                        <div class="total-price">
                            <h5 class="mb-2">Total Pembayaran</h5>
                            <div class="price-amount">
                                Rp <?php echo number_format($hasil['total_harga']); ?>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="no_rekening" class="form-label">
                                    <i class="fas fa-credit-card me-2"></i>
                                    No Rekening
                                </label>
                                <input type="text" name="no_rekening" id="no_rekening" required class="form-control" placeholder="Masukkan nomor rekening">
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="form-label">
                                    <i class="fas fa-user me-2"></i>
                                    Atas Nama
                                </label>
                                <input type="text" name="nama" id="nama" required class="form-control" placeholder="Masukkan nama pemilik rekening">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="bukti_bayar" class="form-label">
                                <i class="fas fa-file-upload me-2"></i>
                                Upload Bukti Bayar
                            </label>
                            <div class="upload-area" onclick="document.getElementById('bukti_bayar').click()">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p class="mb-2">Klik untuk upload atau drag & drop</p>
                                <small class="text-muted">Format: JPG, PNG, PDF (max 2MB)</small>
                            </div>
                            <input type="file" name="bukti_bayar" id="bukti_bayar" 
                                   accept="image/*,application/pdf" required class="d-none" 
                                   onchange="displayFileName(this)">
                            <div id="file-name" class="mt-2 text-success"></div>
                        </div>

                        <input type="hidden" name="id_booking" value="<?php echo $hasil['id_booking']; ?>">
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-paper-plane me-2"></i>
                                Kirim Konfirmasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Sidebar - Payment Info -->
        <div class="col-lg-4">
            <!-- Payment Method Card -->
            <div class="detail-card mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-credit-card me-2"></i>
                        Metode Pembayaran
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="payment-info" style="max-height: 200px; overflow-y: auto;">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-university me-2"></i>
                            Transfer Bank
                        </h6>
                        <div class="payment-bank d-flex justify-content-between align-items-center">
                            <div>
                                <strong>BRI</strong><br>
                                <span class="text-muted">882283383</span><br>
                                <small class="text-muted">A/N Engky</small>
                            </div>
                            <button class="btn btn-light btn-sm" onclick="copyToClipboard('BRI 882283383')">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <div class="payment-bank d-flex justify-content-between align-items-center">
                            <div>
                                <strong>BNI</strong><br>
                                <span class="text-muted">123456789</span><br>
                                <small class="text-muted">A/N Engky</small>
                            </div>
                            <button class="btn btn-light btn-sm" onclick="copyToClipboard('BNI 123456789')">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <div class="payment-bank d-flex justify-content-between align-items-center">
                            <div>
                                <strong>BCA</strong><br>
                                <span class="text-muted">123456789</span><br>
                                <small class="text-muted">A/N Engky</small>
                            </div>
                            <button class="btn btn-light btn-sm" onclick="copyToClipboard('BCA 123456789')">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <div class="payment-bank d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Mandiri</strong><br>
                                <span class="text-muted">123456789</span><br>
                                <small class="text-muted">A/N Engky</small>
                            </div>
                            <button class="btn btn-light btn-sm" onclick="copyToClipboard('Mandiri 123456789')">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>  
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>
                            Pastikan transfer sesuai dengan total pembayaran yang tertera untuk mempercepat proses konfirmasi.
                        </small>
                    </div>
                </div>
            </div>
            
            <!-- Car Info Card -->
            <div class="detail-card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-car me-2"></i>
                        Detail Mobil
                    </h5>
                </div>
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
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Nomor rekening telah disalin: ' + text);
        }, function(err) {
            alert('Gagal menyalin: ', err);
        });
    }
</script>

<script>
AOS.init({
    duration: 800,
    once: true,
    offset: 100
});

function displayFileName(input) {
    const fileName = input.files[0]?.name || '';
    const fileNameDiv = document.getElementById('file-name');
    if (fileName) {
        fileNameDiv.innerHTML = '<i class="fas fa-check-circle me-2"></i>File dipilih: ' + fileName;
    }
}
</script>

</body>
</html>
