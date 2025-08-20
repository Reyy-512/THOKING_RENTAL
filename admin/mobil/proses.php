<?php
session_start();
require __DIR__ . '/../../koneksi/koneksi.php';

if (empty($_SESSION['USER']) || $_SESSION['USER']['level'] != 'admin') {
    header('Location: ../login.php');
    exit;
}

$aksi = $_GET['aksi'] ?? '';

switch ($aksi) {
    case 'tambah':
        tambahMobil();
        break;
    case 'edit':
        editMobil();
        break;
    case 'hapus':
        hapusMobil();
        break;
    case 'tambah_paket':
        tambahPaket();
        break;
    case 'edit_paket':
        editPaket();
        break;
    case 'hapus_paket':
        hapusPaket();
        break;
    default:
        header('Location: mobil.php');
        exit;
}

function tambahMobil() {
    global $koneksi;

    // Daftar field yang wajib diisi
    $fields = ['no_plat', 'merk', 'harga', 'deskripsi', 'status', 'tipe', 'warna', 'transmisi', 'kapasitas', 'jenis_bensin'];
    foreach ($fields as $f) {
        if (empty($_POST[$f])) {
            setFlash("Field $f wajib diisi.", 'danger');
            redirect('tambah.php');
        }
    }

    // Upload gambar
    $gambar = uploadGambar();
    if (!$gambar) redirect('tambah.php');

    try {
        // Persiapkan query untuk menyimpan data mobil
        $stmt = $koneksi->prepare("
            INSERT INTO mobil (no_plat, merk, harga, deskripsi, status, gambar, tipe, warna, transmisi, kapasitas, jenis_bensin) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            htmlspecialchars($_POST['no_plat']),
            htmlspecialchars($_POST['merk']),
            (float) $_POST['harga'],
            htmlspecialchars($_POST['deskripsi']),
            htmlspecialchars($_POST['status']),
            $gambar,
            htmlspecialchars($_POST['tipe']),
            htmlspecialchars($_POST['warna']),
            htmlspecialchars($_POST['transmisi']),
            (int) $_POST['kapasitas'], // Pastikan kapasitas disimpan sebagai integer
            htmlspecialchars($_POST['jenis_bensin'])
        ]);
        
        setFlash("Data mobil berhasil ditambahkan.", 'success');
        redirect('mobil.php');
    } catch (PDOException $e) {
        setFlash("Gagal menambahkan mobil: " . $e->getMessage(), 'danger');
        redirect('tambah.php');
    }
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
            htmlspecialchars($_POST['waktu_sewa'])
        ]);
        
        setFlash("Data paket berhasil ditambahkan.", 'success');
        redirect('paket_mobil.php');
    } catch (PDOException $e) {
        setFlash("Gagal menambahkan paket: " . $e->getMessage(), 'danger');
        redirect('tambah_paket.php');
    }
}

function editMobil() {
    global $koneksi;
    $id = $_GET['id'] ?? '';
    if (!$id) redirect('mobil.php');

    // Daftar field yang wajib diisi
    $fields = ['no_plat', 'merk', 'harga', 'deskripsi', 'status', 'tipe', 'warna', 'transmisi', 'kapasitas', 'jenis_bensin'];
    foreach ($fields as $f) {
        if (empty($_POST[$f])) {
            setFlash("Field $f wajib diisi.", 'danger');
            redirect("edit.php?id=$id");
        }
    }

    $gambar = $_POST['gambar_cek'] ?? '';
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
        $gambarUpload = uploadGambar();
        if ($gambarUpload) {
            if ($gambar && file_exists('../../assets/image/' . $gambar)) unlink('../../assets/image/' . $gambar);
            $gambar = $gambarUpload;
        }
    }

    try {
        $stmt = $koneksi->prepare("
            UPDATE mobil SET 
                no_plat=?, 
                merk=?, 
                harga=?, 
                deskripsi=?, 
                status=?, 
                gambar=?, 
                tipe=?, 
                warna=?, 
                transmisi=?, 
                kapasitas=?, 
                jenis_bensin=? 
            WHERE id_mobil=?
        ");
        $stmt->execute([
            htmlspecialchars($_POST['no_plat']),
            htmlspecialchars($_POST['merk']),
            (float) $_POST['harga'],
            htmlspecialchars($_POST['deskripsi']),
            htmlspecialchars($_POST['status']),
            $gambar,
            htmlspecialchars($_POST['tipe']),
            htmlspecialchars($_POST['warna']),
            htmlspecialchars($_POST['transmisi']),
            (int) $_POST['kapasitas'], // Pastikan kapasitas disimpan sebagai integer
            $id
        ]);
        setFlash("Data mobil berhasil diupdate.", 'success');
        redirect('mobil.php');
    } catch (PDOException $e) {
        setFlash("Gagal mengupdate mobil: " . $e->getMessage(), 'danger');
        redirect("edit.php?id=$id");
    }
}


function editPaket() {
    global $koneksi;

    // Daftar field yang wajib diisi
    $fields = ['id_paket', 'tipe', 'deskripsi', 'waktu_sewa'];
    foreach ($fields as $f) {
        if (empty($_POST[$f])) {
            setFlash("Field $f wajib diisi.", 'danger');
            redirect('edit_paket.php?id=' . $_POST['id_paket']);
        }
    }

    try {
        // Update data paket
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
        redirect('paket_mobil.php');
    } catch (PDOException $e) {
        setFlash("Gagal memperbarui paket: " . $e->getMessage(), 'danger');
        redirect('edit_paket.php?id=' . $_POST['id_paket']);
    }
}


function hapusMobil() {
    global $koneksi;
    $id = $_GET['id'] ?? '';
    $gambar = $_GET['gambar'] ?? '';
    if (!$id) redirect('mobil.php');

    if ($gambar && file_exists('../../assets/image/' . $gambar)) {
        unlink('../../assets/image/' . $gambar);
    }

    try {
        $stmt = $koneksi->prepare("DELETE FROM mobil WHERE id_mobil=?");
        $stmt->execute([$id]);
        setFlash("Data mobil berhasil dihapus.", 'success');
    } catch (PDOException $e) {
        setFlash("Gagal menghapus mobil: " . $e->getMessage(), 'danger');
    }
    redirect('mobil.php');
}

function hapusPaket() {
    global $koneksi;
    $id = $_GET['id'] ?? '';
    if (!$id) redirect('paket_mobil.php');

    try {
        $stmt = $koneksi->prepare("DELETE FROM paket_mobil WHERE id_paket=?");
        $stmt->execute([$id]);
        setFlash("Data paket berhasil dihapus.", 'success');
    } catch (PDOException $e) {
        setFlash("Gagal menghapus paket: " . $e->getMessage(), 'danger');
    }
    redirect('paket_mobil.php');
}


function uploadGambar() {
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] === UPLOAD_ERR_NO_FILE) {
        setFlash("Gambar wajib diupload.", 'danger');
        return false;
    }
    if ($_FILES['gambar']['size'] > 4 * 1024 * 1024) {
        setFlash("Ukuran gambar maksimal 4MB.", 'danger');
        return false;
    }
    $type = mime_content_type($_FILES['gambar']['tmp_name']);
    if (!isset($allowed[$type])) {
        setFlash("Format gambar tidak valid (jpg, png, webp).", 'danger');
        return false;
    }
    $ext = $allowed[$type];
    $name = uniqid() . ".$ext";
    if (!move_uploaded_file($_FILES['gambar']['tmp_name'], '../../assets/image/' . $name)) {
        setFlash("Gagal upload gambar.", 'danger');
        return false;
    }
    return $name;
}

function setFlash($msg, $type = 'success') {
    $_SESSION['flash'] = ['msg' => $msg, 'type' => $type];
}

function redirect($loc) {
    header("Location: $loc");
    exit;
}
?>
