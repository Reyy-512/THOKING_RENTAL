<?php
session_start();
require __DIR__ . '/../../koneksi/koneksi.php';
$title_web = 'Data Paket Mobil - Admin';

if (empty($_SESSION['USER']) || $_SESSION['USER']['level'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$paket = $koneksi->query("SELECT * FROM paket_mobil ORDER BY id_paket ASC")->fetchAll(PDO::FETCH_ASSOC);

// Hitung jumlah booking dengan status sedang di proses (kalau mau dipakai notifikasi sama seperti mobil.php)
$stmt = $koneksi->prepare("SELECT COUNT(*) FROM booking WHERE konfirmasi_pembayaran = 'sedang di proses'");
$stmt->execute();
$jumlah_notif_booking = $stmt->fetchColumn();

include '../layouts/sidebar_admin.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../../assets/image/Logo Tab Rental Mobil2.png" type="image/x-icon">
    <title><?= htmlspecialchars($title_web); ?> - THO-KING RENTAL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body {
    background-color: #ffffffff;
    font-family: 'Inter', sans-serif;
}

.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    background: #ffffffff;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.stats-card {
    position: relative;
    padding: 1.5rem;
    border-radius: 16px;
    overflow: hidden;
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: #0056b3;
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 1rem;
}

.stats-icon.mobil {
    background: #d97706;
    color: white;
}

.stats-icon.tersedia {
    background: #059669;
    color: white;
}

.stats-icon.dipinjam {
    background: #dc2626;
    color: white;
}

.stats-number {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.stats-label {
    color: #000002ff;
    font-size: 0.875rem;
    font-weight: 500;
}

.page-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #000000ff;
    margin-bottom: 1.5rem;
}

.table-container {
    background: #fdfdfdff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.table thead {
    background: linear-gradient(135deg, #0056b3, #007bff);
    color: white;
}

.table tbody tr:hover {
    background-color: rgba(59, 131, 246, 0.15);
}

.btn-custom {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-edit {
    background: #d97706;
    color: white;
}

.btn-delete {
    background: #dc2626;
    color: white;
}

.btn-add {
    background: #059669;
    color: white;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    border-radius: 15px;
}

.empty-state {
    text-align: center;
    padding: 3rem;
}

@media (max-width: 768px) {
    .stats-number {
        font-size: 1.5rem;
    }
    
    .stats-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
}
/* Navigation Pills */
.nav-pills .nav-link {
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    margin-right: 0.5rem;
    transition: all 0.3s ease;
}

.nav-pills .nav-link:hover {
    background-color: rgba(0, 86, 179, 0.1);
    color: #0056b3;
}

.nav-pills .nav-link.active {
    background-color: #0056b3;
    color: white;
}
</style>
</head>

<body>
<div id="main">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="mb-3 mb-md-0">
                <nav class="nav nav-pills">
                    <a class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], 'mobil.php') !== false && strpos($_SERVER['REQUEST_URI'], 'paket_mobil.php') === false) ? 'active' : '' ?>" 
                       href="mobil.php" 
                       style="font-weight: 600; font-size: 1.1rem;">
                        <i class="fas mr-2"></i>Data Mobil
                    </a>
                    <a class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], 'paket_mobil.php') !== false) ? 'active' : '' ?>" 
                       href="paket_mobil.php"
                       style="font-weight: 600; font-size: 1.1rem;">
                        <i class="fas mr-2"></i>Data Paket Mobil
                    </a>
                </nav>
            </div>

            <div>
                <a href="tambah_paket.php" class="btn btn-add">
                    <i class="fas fa-plus"></i> Tambah Paket Mobil
                </a>
            </div>
        </div>

        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert alert-<?= htmlspecialchars($_SESSION['flash']['type']) ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Tipe</th>
                            <th>Deskripsi</th>
                            <th>Waktu Sewa</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($paket): ?>
                            <?php foreach ($paket as $index => $p): ?>
                                <tr>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-light"><?= $index + 1 ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <strong><?= htmlspecialchars($p['tipe']) ?></strong>
                                    </td>
                                    <td class="align-middle">
                                        <small class="text-black">
                                            <?= strlen($p['deskripsi']) > 80 ? substr($p['deskripsi'], 0, 80) . '...' : $p['deskripsi'] ?>
                                        </small>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge badge-info"><?= htmlspecialchars($p['waktu_sewa']) ?></span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group" role="group">
                                            <a href="edit_paket.php?id=<?= $p['id_paket'] ?>" 
                                            class="btn btn-sm btn-custom btn-edit" 
                                            title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="proses.php?aksi=hapus_paket&id=<?= $p['id_paket'] ?>" 
                                            class="btn btn-sm btn-custom btn-delete" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?')" 
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="empty-state">
                                        <i class="fas fa-box-open fa-3x mb-3"></i>
                                        <h5>Belum ada data paket mobil</h5>
                                        <p class="text-muted">Tambahkan paket pertama Anda untuk memulai</p>
                                        <a href="tambah_paket.php" class="btn btn-addd mt-3">
                                            <i class="fas fa-plus"></i> Tambah Paket Mobil
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        $(alert).alert('close');
    });
}, 5000);
</script>

</body>
</html>
