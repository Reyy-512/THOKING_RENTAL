<?php
session_start();
require __DIR__ . '/../../koneksi/koneksi.php';
$title_web = 'Edit Paket Mobil';

// Pastikan hanya admin
if (empty($_SESSION['USER']) || $_SESSION['USER']['level'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Ambil ID paket
if (empty($_GET['id'])) {
    setFlash("ID paket tidak ditemukan.", 'danger');
    redirect('mobil.php');
}

$id_paket = intval($_GET['id']);

// Ambil data waktu sewa
$waktu_sewa_stmt = $koneksi->query("SELECT DISTINCT waktu_sewa FROM paket_mobil ORDER BY waktu_sewa ASC");
$waktu_sewa_list = $waktu_sewa_stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil data paket berdasarkan id
$stmt = $koneksi->prepare("SELECT * FROM paket_mobil WHERE id_paket = ?");
$stmt->execute([$id_paket]);
$paket = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$paket) {
    setFlash("Data paket tidak ditemukan.", 'danger');
    redirect('mobil.php');
}

// Proses edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    editPaket();
}

function editPaket() {
    global $koneksi;

    $fields = ['id_paket', 'tipe', 'deskripsi', 'waktu_sewa'];
    foreach ($fields as $f) {
        if (empty($_POST[$f])) {
            setFlash("Field $f wajib diisi.", 'danger');
            redirect('edit_paket.php?id=' . $_POST['id_paket']);
        }
    }

    try {
        $stmt = $koneksi->prepare("
            UPDATE paket_mobil 
            SET tipe = ?, deskripsi = ?, waktu_sewa = ?
            WHERE id_paket = ?
        ");
        $stmt->execute([
            htmlspecialchars($_POST['tipe']),
            htmlspecialchars($_POST['deskripsi']),
            htmlspecialchars($_POST['waktu_sewa']),
            intval($_POST['id_paket'])
        ]);

        setFlash("Data paket berhasil diperbarui.", 'success');
        redirect('mobil.php');
    } catch (PDOException $e) {
        setFlash("Gagal memperbarui paket: " . $e->getMessage(), 'danger');
        redirect('edit_paket.php?id=' . $_POST['id_paket']);
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
        }

        .page-title {
            font-size: 2rem; /* Ubah ukuran judul */
            font-weight: 700;
            color: #000001ff;
            margin-bottom: 2rem;
            text-align: center;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.4), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            background: #ffffff;
            max-width: 600px; /* Maksimal ukuran card */
            margin: auto; /* Pusatkan card */
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
            background: #004494;
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

        .container-dashboard {
            padding: 2rem;
            max-width: 600px; /* Ukuran maksimum container */
            margin: 0 auto; /* Pusatkan container */
        }
        
        /* Perbaiki style select agar teks tidak kepotong */
        select.form-control {
            height: auto !important; /* biar tinggi menyesuaikan */
            line-height: 1.5 !important; /* biar teks ada ruang */
            padding-right: 2rem; /* kasih ruang dropdown arrow */
            padding-left: 0.75rem; /* normal kiri */
            overflow: hidden; /* cegah kepotong */
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        select.form-control option {
            white-space: normal; /* supaya opsi di dropdown tetap bisa multiline */
        }
    </style>
</head>
<body>

<div id="main">
    <div class="container-dashboard">
<h1 class="page-title" style="margin-bottom: 20px; color: blue;" >Edit Paket Mobil</h1>

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
            <input type="hidden" name="id_paket" value="<?= htmlspecialchars($paket['id_paket']); ?>">

            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Tipe Paket</label>
                        <input type="text" name="tipe" class="form-control" 
                               value="<?= htmlspecialchars($paket['tipe']); ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Deskripsi Paket</label>
                        <textarea name="deskripsi" class="form-control" required><?= htmlspecialchars($paket['deskripsi']); ?></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Waktu Sewa</label>
                        <select name="waktu_sewa" class="form-control" required>
                            <option value="">-- Pilih Waktu Sewa --</option>
                            <?php foreach ($waktu_sewa_list as $waktu): ?>
                                <option value="<?= htmlspecialchars($waktu['waktu_sewa']); ?>"
                                    <?= ($waktu['waktu_sewa'] == $paket['waktu_sewa']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($waktu['waktu_sewa']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="paket_mobil.php" class="btn btn-secondary">Kembali</a>
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