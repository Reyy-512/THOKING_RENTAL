<?php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';

if (empty($_SESSION['USER'])) {
    echo '<script>alert("Harap login !");window.location="index.php"</script>';
    exit;
}

$id = $_GET['id'];
$isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();

// Ambil waktu_sewa dari paket_mobil berdasarkan tipe mobil
$paket = $koneksi->query("SELECT waktu_sewa FROM paket_mobil WHERE tipe = '{$isi['tipe']}'")->fetch();
$waktu_sewa_options = array_map('trim', explode(',', strtolower($paket['waktu_sewa'])));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking <?php echo $isi['merk']; ?> - THO-KING RENTAL</title>
    
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
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
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

        .card-image {
            position: relative;
            height: 250px;
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
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .btn-primary-custom {
            background: #0144faff;
            border: none;
            padding: 14px 32px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary-custom:hover {
            background: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .section-title {
            color: #1e3a8a;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: #3b82f6;
            border-radius: 2px;
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

        .form-label {
            font-weight: 600;
            color: #1e3a8a;
            margin-bottom: 0.5rem;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: #1e3a8a;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section">
    <div>
        <h1 class="hero-title">Booking <?php echo $isi['merk']; ?></h1>
        <p class="hero-subtitle">Form Pemesanan Mobil Premium</p>
    </div>
</section>

<div class="container mt-4 mb-5">
    <div class="row g-4">
        <!-- Detail Mobil -->
        <div class="col-lg-4">
            <div class="detail-card" data-aos="fade-up">
                <div class="card-image">
                    <img src="assets/image/<?php echo $isi['gambar']; ?>" alt="<?php echo $isi['merk']; ?>">
                    <div class="status-badge bg-<?php echo $isi['status'] == 'Tersedia' ? 'success' : 'danger'; ?> text-white">
                        <i class="fas fa-<?php echo $isi['status'] == 'Tersedia' ? 'check' : 'times'; ?>-circle me-1"></i>
                        <?php echo $isi['status']; ?>
                    </div>
                    <div class="price-badge">
                        Rp <?php echo number_format($isi['harga']); ?>/hari
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold text-primary"><?php echo $isi['merk']; ?></h5>
                    
                    <div class="spec-item">
                        <i class="fas fa-car spec-icon"></i>
                        <span>Tipe: <?php echo $isi['tipe']; ?></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-palette spec-icon"></i>
                        <span>Warna: <?php echo $isi['warna']; ?></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-cog spec-icon"></i>
                        <span>Transmisi: <?php echo $isi['transmisi']; ?></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-users spec-icon"></i>
                        <span>Kapasitas: <?php echo $isi['kapasitas']; ?> Orang</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Booking -->
        <div class="col-lg-8">
            <div class="detail-card" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header bg-primary text-white p-4">
                    <h4 class="mb-0">
                        <i class="fas fa-clipboard-list me-2"></i>
                        Form Booking
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="koneksi/proses.php?id=booking">
                        
                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" 
                                   value="<?php echo htmlspecialchars($_SESSION['USER']['nama_pengguna']); ?>" readonly>
                        </div>

                        <!-- NIK -->
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" name="ktp" class="form-control" 
                                   value="<?php echo htmlspecialchars($_SESSION['USER']['nik']); ?>" readonly>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <input type="text" name="alamat" id="alamat" required class="form-control" 
                                   placeholder="Masukkan alamat lengkap untuk pengantaran ke alamat">
                        </div>

                        <!-- Telepon -->
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="no_tlp" required class="form-control" 
                                   value="<?php echo htmlspecialchars($_SESSION['USER']['no_telepon']); ?>" 
                                   placeholder="Nomor yang bisa dihubungi">
                        </div>

                        <!-- Tanggal Sewa -->
                        <div class="mb-3">
                            <label class="form-label">Tanggal Sewa</label>
                            <input type="date" name="tanggal" required class="form-control" 
                                   min="<?php echo date('Y-m-d'); ?>" 
                                   max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
                        </div>

                        <!-- Waktu Sewa + Lama Sewa -->
                        <?php if (!in_array('pengantin', $waktu_sewa_options) && !in_array('12 jam', $waktu_sewa_options)) { ?>
                            <div class="mb-3">
                                <label class="form-label">Pilih Waktu Sewa</label>
                                <select name="waktu_sewa" class="form-select" required>
                                    <option value="">-- Pilih Waktu Sewa --</option>
                                    <?php foreach ($waktu_sewa_options as $option) { ?>
                                        <option value="<?php echo $option ?>"><?php echo ucfirst($option) ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Lama Sewa -->
                            <div class="mb-3" id="lamaSewaGroup" style="display:none;">
                                <label class="form-label">Lama Sewa</label>
                                <input type="number" name="lama_sewa" class="form-control" 
                                       placeholder="Masukkan jumlah (hari/minggu/bulan)">
                            </div>

                            <!-- Metode Pengambilan -->
                            <div class="mb-4">
                                <label class="form-label">Metode Pengambilan Mobil</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode_pengambilan" 
                                                   value="diantar" id="diantar">
                                            <label class="form-check-label" for="diantar">
                                                <i class="fas me-2"></i>Diantar ke Alamat
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode_pengambilan" 
                                                   value="ambil_sendiri" id="ambil_sendiri">
                                            <label class="form-check-label" for="ambil_sendiri">
                                                <i class="fas me-2"></i>Ambil di Rental
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } elseif (in_array('12 jam', $waktu_sewa_options)) { ?>
                            <input type="hidden" name="waktu_sewa" value="12 jam">
                            <input type="hidden" name="lama_sewa" value="1">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Mobil ini hanya tersedia untuk sewa 12 jam
                            </div>
                        <?php } elseif (in_array('pengantin', $waktu_sewa_options)) { ?>
                            <input type="hidden" name="waktu_sewa" value="pengantin">
                            <input type="hidden" name="lama_sewa" value="1">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Layanan pengantin - konfirmasi waktu via WhatsApp
                            </div>
                        <?php } ?>

                        <!-- Hidden Data -->
                        <input type="hidden" name="id_login" value="<?php echo $_SESSION['USER']['id_login']; ?>">
                        <input type="hidden" name="id_mobil" value="<?php echo $isi['id_mobil']; ?>">
                        <input type="hidden" name="total_harga" value="<?php echo $isi['harga']; ?>">

                        <!-- Tombol Submit -->
                        <?php if ($isi['status'] == 'Tersedia') { ?>
                            <button type="submit" class="btn btn-primary-custom w-100">
                                <i class="fas fa-calendar-check me-2"></i>
                                Booking Sekarang
                            </button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-secondary w-100" disabled>
                                <i class="fas fa-times-circle me-2"></i>
                                Mobil Tidak Tersedia
                            </button>
                        <?php } ?>
                    </form>
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

// Script untuk toggle lama sewa
const waktuSewaSelect = document.querySelector('select[name="waktu_sewa"]');
const lamaSewaGroup = document.getElementById('lamaSewaGroup');
const lamaSewaInput = document.querySelector('input[name="lama_sewa"]');

if (waktuSewaSelect) {
    waktuSewaSelect.addEventListener('change', function() {
        const value = this.value.toLowerCase();
        if (['harian', 'mingguan', 'bulanan'].includes(value)) {
            lamaSewaGroup.style.display = 'block';
            lamaSewaInput.required = true;
        } else {
            lamaSewaGroup.style.display = 'none';
            lamaSewaInput.required = false;
            lamaSewaInput.value = 1;
        }
    });
}

// Script untuk ambil lokasi
function ambilLokasi() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Browser Anda tidak mendukung Geolocation.");
    }
}

function showPosition(position) {
    let lat = position.coords.latitude;
    let lng = position.coords.longitude;

    fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=YOUR_API_KEY_HERE`)
        .then(response => response.json())
        .then(data => {
            if (data.status === "OK") {
                let alamat = data.results[0].formatted_address;
                document.getElementById("alamat").value = alamat;
            }
        })
        .catch(err => console.error("Error:", err));
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("Akses lokasi ditolak. Silakan isi alamat secara manual.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Informasi lokasi tidak tersedia.");
            break;
        case error.TIMEOUT:
            alert("Waktu pencarian lokasi habis.");
            break;
        default:
            alert("Terjadi kesalahan saat mengambil lokasi.");
            break;
    }
}
</script>

</body>
</html>