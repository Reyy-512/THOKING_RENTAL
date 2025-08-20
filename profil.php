<?php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';

if (empty($_SESSION['USER'])) {
    echo '<script>alert("Harap Login");window.location="index.php"</script>';
}

if (!empty($_POST['nama_pengguna'])) {
    // Siapkan data untuk update
    $data = [
        htmlspecialchars($_POST["nama_pengguna"]),
        htmlspecialchars($_POST["username"]),
        htmlspecialchars($_POST["nik"]),
        htmlspecialchars($_POST["no_telepon"]),
        $_SESSION['USER']['id_login']
    ];

    // Cek apakah password diisi
    if (!empty($_POST['password'])) {
        // Jika password diisi, update dengan password baru
        $sql = "UPDATE login SET nama_pengguna = ?, username = ?, password = ?, nik = ?, no_telepon = ? WHERE id_login = ?";
        array_splice($data, 2, 0, md5($_POST["password"])); // Sisipkan password baru
    } else {
        // Jika password tidak diisi, update tanpa password
        $sql = "UPDATE login SET nama_pengguna = ?, username = ?, nik = ?, no_telepon = ? WHERE id_login = ?";
    }

    $row = $koneksi->prepare($sql);
    $row->execute($data);

    echo '<script>alert("Update Data Profil Berhasil!");window.location="profil.php"</script>';
    exit;
}

// Ambil data user
$id = $_SESSION["USER"]["id_login"];
$sql = "SELECT * FROM login WHERE id_login = ?";
$row = $koneksi->prepare($sql);
$row->execute([$id]);
$edit_profil = $row->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - THO-KING RENTAL</title>
    
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
        
    /* Enhanced Hero Section */
    .hero-section {
        position: relative;
        height: 35vh;
        min-height: 300px;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
        margin-bottom: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        text-align: center;
        color: white;
    }
    
    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.5rem;
        opacity: 0.9;
        font-weight: 400;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        padding: 0 20px;
        max-width: 600px;
    }
    
    .hero-title {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        letter-spacing: -0.02em;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        opacity: 0.95;
        font-weight: 400;
        line-height: 1.5;
    }
    
    .hero-icon {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }
        
        /* Modern Card */
        .modern-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            overflow: hidden;
            border: 1px solid rgba(30, 58, 138, 0.1);
            position: relative;
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
        
        /* Form Styling */
        .form-label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        /* Button Styling */
        .btn-modern {
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            font-size: 1rem;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }
        
        /* Profile Header */
        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 2.5rem;
        }
        
        .profile-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 0.5rem;
        }
        
        .profile-subtitle {
            color: #64748b;
            font-size: 1.1rem;
        }
        
        /* Input Group Icons */
        .input-group-text {
            background: #f1f5f9;
            border: 2px solid #e2e8f0;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #1e3a8a;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
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
            
            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }
        }
        
        /* Animation */
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
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
    </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">
            <i class="fas fa-user-cog"></i> Edit Profil
        </h1>
        <p class="hero-subtitle">Kelola informasi akun Anda dengan mudah</p>
    </div>
</section>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="modern-card fade-in-up" data-aos="fade-up">
                <div class="card-body p-5">
                    <!-- Profile Header -->
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h2 class="profile-title">Edit Profil Pengguna</h2>
                        <p class="profile-subtitle">Perbarui informasi pribadi Anda</p>
                    </div>

                    <form action="" method="post">
                        <!-- Nama Lengkap -->
                        <div class="form-group">
                            <label class="form-label" for="nama_pengguna">
                                <i></i>Nama Lengkap
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" 
                                        class="form-control" 
                                        value="<?= htmlspecialchars($edit_profil->nama_pengguna); ?>" 
                                        name="nama_pengguna" 
                                        id="nama_pengguna" 
                                        required
                                        placeholder="Masukkan nama lengkap">
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="form-group">
                            <label class="form-label" for="username">
                                <i></i>Username
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user-circle text"></i>
                                </span>
                                <input type="text" 
                                       class="form-control" 
                                       value="<?= htmlspecialchars($edit_profil->username); ?>" 
                                       name="username" 
                                       id="username" 
                                       required
                                       placeholder="Masukkan username">
                            </div>
                        </div>

                        <!-- NIK -->
                        <div class="form-group">
                            <label class="form-label" for="nik">
                                <i></i>NIK
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-id-card"></i>
                                </span>
                                <input type="text" 
                                       class="form-control" 
                                       value="<?= htmlspecialchars($edit_profil->nik); ?>" 
                                       name="nik" 
                                       id="nik" 
                                       maxlength="16" 
                                       required
                                       placeholder="Masukkan 16 digit NIK">
                            </div>
                        </div>

                        <!-- No Telepon -->
                        <div class="form-group">
                            <label class="form-label" for="no_telepon">
                                <i></i>No. Telepon
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="text" 
                                       class="form-control" 
                                       value="<?= htmlspecialchars($edit_profil->no_telepon); ?>" 
                                       name="no_telepon" 
                                       id="no_telepon" 
                                       maxlength="15" 
                                       required
                                       placeholder="Masukkan nomor telepon">
                            </div>
                        </div>

                        <!-- Password Baru -->
                        <div class="form-group">
                            <label class="form-label" for="password">
                                <i></i>Password Baru
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" 
                                       class="form-control" 
                                       name="password" 
                                       id="password" 
                                       placeholder="Kosongkan jika tidak ingin mengubah password">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword" aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Minimal 6 karakter, kosongkan jika tidak ingin mengubah
                            </small>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn-modern">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

// Password visibility toggle
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    if (password && password.length < 6) {
        e.preventDefault();
        alert('Password minimal 6 karakter!');
        return false;
    }
    
    const nik = document.getElementById('nik').value;
    if (nik && !/^\d{16}$/.test(nik)) {
        e.preventDefault();
        alert('NIK harus 16 digit angka!');
        return false;
    }
});

// Real-time NIK validation
document.getElementById('nik').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Real-time phone validation
document.getElementById('no_telepon').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>