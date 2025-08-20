<?php
session_start();
require '../../koneksi/koneksi.php';
$title_web = 'Edit Mobil';

// Proteksi login & admin
if (empty($_SESSION['USER']) || $_SESSION['USER']['level'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Ambil data mobil
$id = $_GET['id'] ?? '';
$stmt = $koneksi->prepare("SELECT * FROM mobil WHERE id_mobil = ?");
$stmt->execute([$id]);
$mobil = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$mobil) {
    header("Location: mobil.php");
    exit;
}

// Ambil paket untuk select tipe
$paket_stmt = $koneksi->query("SELECT DISTINCT tipe FROM paket_mobil ORDER BY tipe ASC");
$paket_list = $paket_stmt->fetchAll(PDO::FETCH_COLUMN);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_plat = strip_tags($_POST['no_plat']);
    $merk = strip_tags($_POST['merk']);
    $tipe = strip_tags($_POST['tipe']);
    $harga = strip_tags($_POST['harga']);
    $status = strip_tags($_POST['status']);
    $warna = strip_tags($_POST['warna']);
    $jenis_bensin = strip_tags($_POST['jenis_bensin']);
    $deskripsi = strip_tags($_POST['deskripsi']);
    $transmisi = strip_tags($_POST['transmisi']);
    $kapasitas = strip_tags($_POST['kapasitas']);
    $gambar_lama = $_POST['gambar_lama'] ?? '';
    $gambar_baru = $gambar_lama;

    // Proses upload gambar jika ada
    if (!empty($_FILES['gambar']['name'])) {
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $file_name = $_FILES['gambar']['name'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_size = $_FILES['gambar']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_ext)) {
            if ($file_size <= 4 * 1024 * 1024) {
                $new_name = uniqid() . '.' . $file_ext;
                $upload_dir = '../../assets/image/';
                if (move_uploaded_file($file_tmp, $upload_dir . $new_name)) {
                    if ($gambar_lama && file_exists($upload_dir . $gambar_lama)) {
                        unlink($upload_dir . $gambar_lama);
                    }
                    $gambar_baru = $new_name;
                }
            }
        }
    }

    // Update database
    $stmt = $koneksi->prepare("UPDATE mobil SET no_plat = ?, merk = ?, tipe = ?, harga = ?, status = ?, warna = ?, jenis_bensin = ?, transmisi = ?, kapasitas = ?, deskripsi = ?, gambar = ? WHERE id_mobil = ?");
    $stmt->execute([$no_plat, $merk, $tipe, $harga, $status, $warna, $jenis_bensin, $transmisi, $kapasitas, $deskripsi, $gambar_baru, $id]);

    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Data mobil berhasil diperbarui.'];
    header("Location: mobil.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title_web); ?> | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8fafc;
        font-family: 'Inter', sans-serif;
    }

    #main {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
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
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.4),
                    0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        background: #ffffff;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4),
                    0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background: linear-gradient(135deg, #0056b3, #007bff);
        color: white;
        font-weight: 600;
        font-size: 1.125rem;
        padding: 1.25rem 1.5rem;
        border: none;
    }

    label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
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

    .form-control-file {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
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

    .img-preview {
        max-width: 200px;
        height: auto;
        margin-top: 10px;
        border-radius: 8px;
        box-shadow: 0 0 6px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
        #main {
            padding: 1rem;
        }
        .page-title {
            font-size: 1.5rem;
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
    <div id="sidebar-wrapper">
        <?php include '../layouts/sidebar_admin.php'; ?>
    </div>
<div id="main">
<h1 class="page-title" style="margin-bottom: 20px; color: blue;">Form Edit Mobil</h1>

    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['flash']['msg'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
<div class="row">
    <!-- Card Kiri -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg=#020efbff text-white">
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label>No Plat</label>
                    <input type="text" name="no_plat" class="form-control" 
                           value="<?= htmlspecialchars($mobil['no_plat']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label>Merk Mobil</label>
                    <input type="text" name="merk" class="form-control" 
                           value="<?= htmlspecialchars($mobil['merk']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="tipe">Tipe Mobil (Paket)</label>
                    <select name="tipe" class="form-control" id="tipe" required>
                        <option value="">-- Pilih Tipe Mobil/Paket --</option>
                        <?php foreach ($paket_list as $paket_tipe): ?>
                            <option value="<?= htmlspecialchars($paket_tipe); ?>" 
                                <?= $mobil['tipe'] == $paket_tipe ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($paket_tipe); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Harga per Hari</label>
                    <input type="number" name="harga" class="form-control" 
                           value="<?= htmlspecialchars($mobil['harga']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label>Status Mobil</label>
                    <select name="status" class="form-control" required>
                        <option value="Tersedia" <?= $mobil['status'] == 'Tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                        <option value="Tidak Tersedia" <?= $mobil['status'] == 'Tidak Tersedia' ? 'selected' : ''; ?>>Tidak Tersedia</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Upload Gambar Mobil</label>
                    <input type="file" name="gambar" class="form-control" accept=".jpg,.png,.jpeg">
                    <?php if ($mobil['gambar']): ?>
                        <img src="../../assets/image/<?= htmlspecialchars($mobil['gambar']); ?>" 
                             alt="Preview Gambar" class="img-preview mt-2">
                    <?php endif; ?>
                    <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($mobil['gambar']); ?>">
                    <small class="text-muted">Format: JPG, PNG, JPEG. Max 2MB</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Kanan -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-#020efbff text-white">
            </div>
            <div class="card-body">
                <!-- Warna -->
<div class="form-group mb-3">
    <label>Warna</label>
    <input type="text" name="warna" class="form-control" 
            value="<?= htmlspecialchars($mobil['warna']); ?>" placeholder="Contoh: Merah" required>
</div>

<!-- Kondisi Mobil -->
<div class="form-group mb-3">
    <label>Deskripsi Mobil</label>
    <input type="text" name="deskripsi" class="form-control"
            value="<?= htmlspecialchars($mobil['deskripsi']); ?>" placeholder="Masukkan deskripsi lengkap mobil" required>

</div>

<!-- Transmisi -->
<div class="form-group mb-3">
    <label>Transmisi</label>
    <select name="transmisi" class="form-control" required>
        <option value="Manual" <?= $mobil['transmisi'] == 'Manual' ? 'selected' : ''; ?>>Manual</option>
        <option value="Matic" <?= $mobil['transmisi'] == 'Matic' ? 'selected' : ''; ?>>Matic</option>
    </select>
</div>

<!-- Kapasitas -->
<div class="form-group mb-3">
    <label>Kapasitas (Orang)</label>
    <input type="number" name="kapasitas" class="form-control" 
           value="<?= htmlspecialchars($mobil['kapasitas']); ?>" placeholder="Contoh: 7" required>
</div>

<!-- Jenis Bensin -->
<div class="form-group mb-3">
    <label>Jenis Bensin</label>
    <input type="text" name="jenis_bensin" class="form-control" 
           value="<?= htmlspecialchars($mobil['jenis_bensin']); ?>" placeholder="Contoh: Pertalite" required>
</div>


                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update Data Mobil
                </button>
                <a href="mobil.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
