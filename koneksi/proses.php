<?php
session_start();
require 'koneksi.php';

// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
$koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function showAlert($icon, $title, $text, $redirect = null) {
    $color = $icon === 'success' ? '#007bff' : '#dc3545'; // Biru untuk berhasil, Merah untuk gagal
    echo '
    <html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>
    <body style="background-color: #fdf9f4;">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: "' . $icon . '",
                title: "' . $title . '",
                text: "' . $text . '",
                timer: 5000,
                background: "#fff",
                color: "#161412ff",
                iconColor: "' . $color . '",
                customClass: {
                    popup: "animated fadeInDown" // Animasi kotak alert
                }
            }).then(() => {
                window.location = "' . $redirect . '";
            });
        </script>
    </body>
    </html>';
}

// === LOGIN ===
if ($_GET['id'] == 'login') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $row = $koneksi->prepare("SELECT * FROM login WHERE username = ? AND password = md5(?)");
    $row->execute([$user, $pass]);

    if ($row->rowCount() > 0) {
        $hasil = $row->fetch();
        $_SESSION['USER'] = $hasil;

        $redirect = ($_SESSION['USER']['level'] == 'admin') ? $url . 'admin/index.php' : $url . 'dashboard.php';

        showAlert('success', 'Selamat Datang!', 'Login berhasil. Selamat menggunakan layanan rental THO-KING.', $redirect);
    } else {
        showAlert('error', 'Login Gagal', 'Periksa kembali username dan password Anda.', $url . 'index.php');
    }
}

// === DAFTAR ===
if ($_GET['id'] == 'daftar') {
    $nama = trim($_POST['nama']);
    $user = trim($_POST['user']);
    $pass = md5(trim($_POST['pass']));
    $nik = trim($_POST['nik']);
    $no_telepon = trim($_POST['no_telepon']);
    $level = 'pengguna';

    if (empty($nik) || !preg_match('/^\d{16}$/', $nik)) {
        showAlert('warning', 'NIK Tidak Valid', 'NIK wajib diisi dengan 16 digit angka.', $url . 'index.php');
        exit;
    }

    if (empty($no_telepon) || !preg_match('/^\d{10,15}$/', $no_telepon)) {
        showAlert('warning', 'Nomor Telepon Tidak Valid', 'Nomor Telepon wajib diisi dengan 10-15 digit angka.', $url . 'index.php');
        exit;
    }

    $row = $koneksi->prepare("SELECT * FROM login WHERE username = ?");
    $row->execute([$user]);

    if ($row->rowCount() > 0) {
        showAlert('warning', 'Username Sudah Terdaftar', 'Gunakan username lain untuk melanjutkan.', $url . 'index.php');
    } else {
        $sql = "INSERT INTO login (nama_pengguna, username, password, nik, no_telepon, level) VALUES (?,?,?,?,?,?)";
        $insert = $koneksi->prepare($sql);
        $insert->execute([$nama, $user, $pass, $nik, $no_telepon, $level]);

        showAlert('success', 'Pendaftaran Berhasil', 'Pendaftaran berhasil, silakan login.', $url . 'index.php');
    }
}

// === BOOKING ===
if ($_GET['id'] == 'booking') {
    $unik = random_int(100, 999);
    $id_mobil = $_POST['id_mobil'];
    
    $stmt = $koneksi->prepare("SELECT harga FROM mobil WHERE id_mobil = ?");
    $stmt->execute([$id_mobil]);
    $mobil = $stmt->fetch();

    if (!$mobil) {
        showAlert('error', 'Mobil Tidak Ditemukan', 'Mobil tidak ditemukan.', $url . 'index.php');
        exit;
    }

    $harga_mobil = $mobil['harga'];
    $lama_sewa_input = intval($_POST['lama_sewa']);
    $waktu_sewa = $_POST['waktu_sewa'];

    $lama_sewa = match ($waktu_sewa) {
        'harian' => $lama_sewa_input * 1,
        'mingguan' => $lama_sewa_input * 7,
        'bulanan' => $lama_sewa_input * 30,
        '12_jam' => 0.5 * $lama_sewa_input,
        default => $lama_sewa_input,
    };

    $total_harga = ($harga_mobil * $lama_sewa);
    $data = [
        time(), $_POST['id_login'], $_POST['id_mobil'], $_POST['ktp'], 
        $_POST['nama'], $_POST['alamat'], $_POST['no_tlp'], 
        $_POST['tanggal'], $lama_sewa, $total_harga, 
        "Belum Bayar", date('Y-m-d'), $waktu_sewa
    ];

    $sql = "INSERT INTO booking (
                kode_booking, id_login, id_mobil, ktp, nama, alamat, no_tlp,
                tanggal, lama_sewa, total_harga, konfirmasi_pembayaran, tgl_input, waktu_sewa
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $insert = $koneksi->prepare($sql);
    $insert->execute($data);

    showAlert('success', 'Booking Berhasil', 'Booking berhasil, silakan melakukan pembayaran.', '../bayar.php?id=' . time());
}

// === KONFIRMASI PEMBAYARAN ===
if (!isset($_GET['id'])) {
    die("Parameter 'id' tidak ditemukan.");
}

if ($_GET['id'] === 'konfirmasi') {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Akses tidak valid.");
    }

    $id_booking = $_POST['id_booking'] ?? '';
    $no_rekening = $_POST['no_rekening'] ?? '';
    $nama_rekening = $_POST['nama'] ?? '';

    if (empty($id_booking) || empty($no_rekening) || empty($nama_rekening)) {
        die("Data form tidak lengkap.");
    }

    // Upload bukti bayar
    $bukti_bayar = '';
    if (isset($_FILES['bukti_bayar']) && $_FILES['bukti_bayar']['error'] === UPLOAD_ERR_OK) {
        $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];
        $file_name = $_FILES['bukti_bayar']['name'];
        $file_tmp = $_FILES['bukti_bayar']['tmp_name'];
        $file_size = $_FILES['bukti_bayar']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_ext)) {
            showAlert('error', 'Format File Tidak Valid', 'Hanya JPG/JPEG/PNG/PDF yang diperbolehkan.', $url . 'index.php');
            exit;
        }
        if ($file_size > 2097152) {
            showAlert('error', 'Ukuran File Terlalu Besar', 'Ukuran file melebihi 2MB.', $url . 'index.php');
            exit;
        }

        $upload_dir = _DIR_ . '/../assets/bukti_bayar/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $new_name = 'bukti_' . time() . '.' . $file_ext;
        if (!move_uploaded_file($file_tmp, $upload_dir . $new_name)) {
            showAlert('error', 'Gagal Mengunggah File', 'Gagal mengunggah file.', $url . 'index.php');
            exit;
        }
        $bukti_bayar = $new_name;
    } else {
        showAlert('error', 'Upload Bukti Bayar', 'Harap upload bukti bayar.', $url . 'index.php');
        exit;
    }

    // Simpan data pembayaran
    $sql = "INSERT INTO pembayaran (id_booking, no_rekening, nama_rekening, bukti_bayar) VALUES (?,?,?,?)";
    $insert = $koneksi->prepare($sql);
    $insert->execute([$id_booking, $no_rekening, $nama_rekening, $bukti_bayar]);

    // Update status booking
    $update = $koneksi->prepare("UPDATE booking SET konfirmasi_pembayaran = ? WHERE id_booking = ?");
    $update->execute(['Sedang di proses', $id_booking]);

    // Update status mobil jadi 'Disewa'
    $stmt = $koneksi->prepare("SELECT id_mobil FROM booking WHERE id_booking = ?");
    $stmt->execute([$id_booking]);
    $id_mobil = $stmt->fetchColumn();

    if ($id_mobil) {
        $updateMobil = $koneksi->prepare("UPDATE mobil SET status = 'Disewa' WHERE id_mobil = ?");
        $updateMobil->execute([$id_mobil]);
    }

    showAlert('success', 'Konfirmasi Berhasil', 'Konfirmasi berhasil, mohon tunggu nota booking.', '../dashboard.php');
}

// === LOGOUT ===
if ($_GET['id'] == 'logout') {
    session_destroy();
    showAlert('success', 'Logout Berhasil', 'Anda berhasil logout.', $url . 'index.php');
}
?>
