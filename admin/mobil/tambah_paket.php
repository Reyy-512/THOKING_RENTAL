<?php
session_start();
require __DIR__ . '/../../koneksi/koneksi.php';
$title_web = 'Tambah Paket Mobil';

// Ambil data waktu sewa dari database
$waktu_sewa_stmt = $koneksi->query("SELECT DISTINCT waktu_sewa FROM paket_mobil ORDER BY waktu_sewa ASC");
$waktu_sewa_list = $waktu_sewa_stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($_SESSION['USER']) || $_SESSION['USER']['level'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    tambahPaket();
}

function tambahPaket() {
    global $koneksi;

    // Daftar field yang wajib diisi
    $fields = ['tipe', 'deskripsi', 'waktu_sewa'];
    foreach ($fields as $f) {
        if (empty($_POST[$f])) {
            setFlash("Field $f wajib diisi.", 'danger');
            redirect('tambah_paket.php');
        }
    }

    try {
        // Persiapkan query untuk menyimpan data paket
        $stmt = $koneksi->prepare("
            INSERT INTO paket_mobil (tipe, deskripsi, waktu_sewa) 
            VALUES (?, ?, ?)
        ");
        $stmt->execute([
            htmlspecialchars($_POST['tipe']),
            htmlspecialchars($_POST['deskripsi']),
            htmlspecialchars($_POST['waktu_sewa'])  // Pastikan ini adalah string
        ]);
        
        setFlash("Data paket berhasil ditambahkan.", 'success');
        redirect('mobil.php');
    } catch (PDOException $e) {
        setFlash("Gagal menambahkan paket: " . $e->getMessage(), 'danger');
        redirect('tambah_paket.php');
    }
}

function setFlash($msg, $type = 'success') {
    $_SESSION['flash'] = ['msg' => $msg, 'type' => $type];
}

function redirect($loc) {
    header("Location: $loc");
    exit;
}

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
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .container-dashboard {
        width: 100%;
        max-width: 600px; /* Ubah ukuran maksimal lebih besar */
        margin: auto; /* Pusatkan konten */
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 2rem;
        text-align: center;
    }

    .card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
        background: #ffffff;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 20px -5px rgba(0, 0, 0, 0.25);
    }

    .card-header {
        background: linear-gradient(135deg, #0056b3, #007bff);
        color: white;
        font-weight: 600;
        font-size: 1.25rem;
        padding: 1.5rem;
        border: none;
        border-radius: 18px 18px 0 0;
        text-align: center;
    }

    .card-body {
        padding: 2rem; /* perbesar padding dalam */
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #d1d5db;
        padding: 0.85rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s;
    }

    .form-control:focus {
        border-color: #0056b3;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }

    .btn-primary {
        background: #0056b3;
        border: none;
        border-radius: 10px;
        padding: 0.85rem 1.6rem;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.2s;
    }

    .btn-primary:hover {
        background: #004494;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(59, 130, 246, 0.45);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        border-radius: 10px;
        padding: 0.85rem 1.6rem;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.2s;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(108, 117, 125, 0.4);
    }

    label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
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
<h1 class="page-title" style="margin-bottom: 20px; color: blue;">Form Tambah Paket Mobil Baru</h1>
        
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['flash']['msg'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Tipe Paket</label>
                        <input type="text" name="tipe" class="form-control" placeholder="Nama Tipe Mobil" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Deskripsi Paket</label>
                        <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi paket" required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Waktu Sewa</label>
                        <select name="waktu_sewa" class="form-control" required>
                            <option value="">-- Pilih Waktu Sewa --</option>
                            <?php foreach ($waktu_sewa_list as $waktu): ?>
                                <option value="<?= htmlspecialchars($waktu['waktu_sewa']); ?>">
                                    <?= htmlspecialchars($waktu['waktu_sewa']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Paket
                    </button>
                    <a href="mobil.php" class="btn btn-secondary">Kembali</a>
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