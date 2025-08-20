<?php
session_start();
require __DIR__ . '/../../koneksi/koneksi.php';
$title_web = 'Tambah Mobil';

if (empty($_SESSION['USER']) || $_SESSION['USER']['level'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Ambil data tipe paket mobil untuk select
$paket_stmt = $koneksi->query("SELECT tipe FROM paket_mobil ORDER BY tipe ASC");
$paket_list = $paket_stmt->fetchAll(PDO::FETCH_ASSOC);

include '../layouts/sidebar_admin.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title_web); ?> | THO-KING RENTAL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #000001ff;
            margin-bottom: 2rem;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.4), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            background: #ffffff;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background: linear-gradient(135deg, #0056b3, #007bff);
            color: white;
            font-weight: 600;
            font-size: 1.125rem;
            padding: 1.25rem 1.5rem;
            border: none;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-primary {
            background: #0056b3;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.4);
        }

        label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .container-dashboard {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .container-dashboard {
                padding: 1rem;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
        }

        .card {
            max-width: none;
            margin: 0;
        }

        .form-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-col {
            flex: 1;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 1.5rem;
            }
        }
            /* Perbaiki style select agar teks tidak kepotong */
    select.form-control {
        height: auto !important;       /* biar tinggi menyesuaikan */
        line-height: 1.5 !important;   /* biar teks ada ruang */
        padding-right: 2rem;           /* kasih ruang dropdown arrow */
        padding-left: 0.75rem;         /* normal kiri */
        overflow: hidden;              /* cegah kepotong */
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    select.form-control option {
        white-space: normal;      /* supaya opsi di dropdown tetap bisa multiline */
    }

    </style>
</head>
<body>

<div id="main">
    <div class="container-dashboard">
        <h1 class="page-title" style="margin-bottom: 20px; color: blue;">Form Tambah Mobil Baru</h1>
        
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['flash']['msg'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

<form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
<div class="row">
    <!-- Card Kiri -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg=#020efbff text-white">
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label>No Plat</label>
                    <input type="text" name="no_plat" class="form-control" placeholder="Contoh: B 1234 XYZ" required>
                </div>

                <div class="form-group mb-3">
                    <label>Merk Mobil</label>
                    <input type="text" name="merk" class="form-control" placeholder="Contoh: Toyota Avanza" required>
                </div>

                <div class="form-group mb-3">
                    <label for="tipe">Tipe Mobil (Paket)</label>
                    <select name="tipe" class="form-control" id="tipe" required>
                        <option value="">-- Pilih Tipe Mobil/Paket --</option>
                        <?php foreach ($paket_list as $paket): ?>
                            <option value="<?= htmlspecialchars($paket['tipe']); ?>"><?= htmlspecialchars($paket['tipe']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Harga per Hari</label>
                    <input type="number" name="harga" class="form-control" placeholder="Contoh: 350000" required>
                </div>

                <div class="form-group mb-3">
                    <label>Status Mobil</label>
                    <select name="status" class="form-control" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Upload Gambar Mobil</label>
                    <input type="file" name="gambar" class="form-control" accept=".jpg,.png,.jpeg" required>
                    <small class="text-muted">Format: JPG, PNG, JPEG. Max 2MB</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Kanan -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg=#020efbff text-white">
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label>Warna</label>
                    <input type="text" name="warna" class="form-control" placeholder="Contoh: Merah" required>
                </div>
                
                <div class="form-group mb-3">
                    <label>Deskripsi Mobil</label>
                    <textarea type="text" name="deskripsi" class="form-control" placeholder="Masukkan deskripsi lengkap mobil" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label>Transmisi</label>
                    <select name="transmisi" class="form-control" required>
                        <option value="Manual">Manual</option>
                        <option value="Matic">Matic</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Kapasitas (Orang)</label>
                    <input type="number" name="kapasitas" class="form-control" placeholder="Contoh: 7" required>
                </div>

                <div class="form-group mb-3">
                    <label>Jenis Bensin</label>
                    <input type="text" name="jenis_bensin" class="form-control" placeholder="Contoh: Pertalite" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Simpan Data Mobil
                </button>
                <a href="mobil.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</form>

    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
