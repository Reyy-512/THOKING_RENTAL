<?php 
require '../../koneksi/koneksi.php';
session_start();

// Proteksi login admin
if (empty($_SESSION['USER']) || $_SESSION['USER']['level'] != 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); window.location="../login.php";</script>';
    exit;
}

$id_booking = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$jenis = isset($_GET['jenis']) ? htmlspecialchars($_GET['jenis']) : 'diterima'; // ambil jenis dari URL

if (empty($id_booking)) {
    echo '<script>alert("ID booking tidak ditemukan.");window.location="booking.php";</script>';
    exit;
}

// Ambil data booking
$stmt = $koneksi->prepare("SELECT * FROM booking WHERE id_booking = ?");
$stmt->execute([$id_booking]);
$booking = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$booking) {
    echo '<script>alert("Data booking tidak ditemukan.");window.location="booking.php";</script>';
    exit;
}

$id_login = $booking['id_login'];
$kode_booking = $booking['kode_booking'];
$total_harga = $booking['total_harga'];
$tanggal = date('Y-m-d H:i:s');

try {
    // Simpan nota ke database
    $insert = $koneksi->prepare("
        INSERT INTO nota (id_login, id_booking, kode_booking, total_harga, tanggal, status, jenis) 
        VALUES (?, ?, ?, ?, ?, 'belum_dibaca', ?)
    ");
    $insert->execute([$id_login, $id_booking, $kode_booking, $total_harga, $tanggal, $jenis]);

    echo '<script>alert("Nota booking berhasil dikirim ke pengguna."); window.history.back();</script>';
} catch (PDOException $e) {
    echo '<script>alert("Gagal mengirim nota: ' . $e->getMessage() . '"); window.history.back();</script>';
}
?>
