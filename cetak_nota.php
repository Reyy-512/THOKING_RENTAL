<?php
ob_start();
require 'koneksi/koneksi.php';
require 'assets/tcpdf/tcpdf.php';

session_start();

if (empty($_SESSION['USER'])) {
    echo '<script>alert("Silakan login terlebih dahulu."); window.location="login.php";</script>';
    exit;
}

$id_nota = $_GET['id'] ?? null;
if (!$id_nota) {
    echo '<script>alert("ID nota tidak ditemukan."); window.history.back();</script>';
    exit;
}

$nota = $koneksi->query("SELECT n.*, l.nama_pengguna, b.tanggal as tanggal_sewa, b.lama_sewa, m.merk, m.no_plat 
                        FROM nota n 
                        JOIN login l ON n.id_login = l.id_login 
                        JOIN booking b ON n.kode_booking = b.kode_booking
                        JOIN mobil m ON b.id_mobil = m.id_mobil
                        WHERE n.id_nota = '$id_nota'")->fetch();

if (!$nota) {
    echo '<script>alert("Data nota tidak ditemukan."); window.history.back();</script>';
    exit;
}

$tanggal_sewa = new DateTime($nota['tanggal_sewa']);
$tanggal_kembali = clone $tanggal_sewa;
$tanggal_kembali->add(new DateInterval('P'.$nota['lama_sewa'].'D'));

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(15, 20, 15);
$pdf->AddPage();

$logo = 'assets/image/logo_thoking.jpg';
$ttd  = 'assets/image/signature.jpg';

// Cek jenis nota
$jenis = strtolower($nota['jenis']);
if ($jenis === 'ditolak') {
    $judul = 'NOTA PENOLAKAN - THO-KING RENTAL';
    $warnaJudul = '#c0392b'; // Merah
} else {
    $judul = 'NOTA PESANAN - THO-KING RENTAL';
    $warnaJudul = '#1e6798'; // Biru
}

$html = '
<div style="text-align:center;">
    <img src="'.$logo.'" height="70"><br>
    <h2 style="color:'.$warnaJudul.'; margin-top:5px;">'.$judul.'</h2>
</div>
<br>
<table cellpadding="8" cellspacing="0" border="1" align="center" width="100%">
    <tr style="background-color:#f5f5f5;">
        <td width="35%"><strong>Nama Pelanggan</strong></td>
        <td width="65%">'.$nota['nama_pengguna'].'</td>
    </tr>
    <tr>
        <td><strong>Kode Booking</strong></td>
        <td>'.$nota['kode_booking'].'</td>
    </tr>
    <tr>
        <td><strong>Merk Mobil</strong></td>
        <td>'.$nota['merk'].'</td>
    </tr>
    <tr>
        <td><strong>Nomor Plat</strong></td>
        <td>'.$nota['no_plat'].'</td>
    </tr>
    <tr>
        <td><strong>Tanggal Sewa</strong></td>
        <td>'.$nota['tanggal_sewa'].'</td>
    </tr>
    <tr>
        <td><strong>Lama Sewa</strong></td>
        <td>'.$nota['lama_sewa'].' hari</td>
    </tr>
    <tr>
        <td><strong>Tanggal Pengembalian</strong></td>
        <td>'.$tanggal_kembali->format('Y-m-d').'</td>
    </tr>
    <tr>
        <td><strong>Total Harga</strong></td>
        <td>Rp '.number_format($nota['total_harga'],0,',','.').'</td>
    </tr>
</table>
<br><br>
';

// Konten tambahan berdasarkan jenis
if ($jenis === 'ditolak') {
    $html .= '
    <div style="text-align:center; font-size:12px;">
        <strong style="color:red">Pemesanan Anda telah DITOLAK</strong>
        <br><strong style="color:black">
        Mohon maaf, pemesanan tidak dapat diproses karena pembayaran tidak sesuai, kirim nota booking ke wa admin agar bisa diproses lebih lanjut<br></strong>
        <em>'.$nota['keterangan'].'</em><br><br></strong>
    </div>
    <br><br>
    <div style="text-align:center; margin-center:50px;">Terima kasih telah menggunakan jasa <strong>THO-KING RENTAL.</div>
        
            <div style="text-align:right; margin-right:50px;">
        <p>Hormat Kami,</p>
        <img src="'.$ttd.'" height="70"><br>

    </div>
    ';
} else {
    $html .= '
    <div style="text-align:center; font-size:12px;">
        <i style="color:red">Diwajibkan membawa KTP saat pengambilan mobil</i><br>
        <strong>Ketentuan Pengembalian:</strong><br>
        - Pengembalian mobil sesuai tanggal yang telah ditentukan<br>
        - Mobil harus dikembalikan dalam kondisi sama seperti pada saat pengambilan,<br> 
        &nbsp;&nbsp;apabila ada kerusakan maka menjadi tanggung jawab penyewa<br><br>
        Terima kasih telah menggunakan jasa <strong>THO-KING RENTAL</strong>.<br>
    </div>
    <br><br>
    <div style="text-align:right; margin-right:50px;">
        <p>Hormat Kami,</p>
        <img src="'.$ttd.'" height="70"><br>
    </div>
    ';
}

$pdf->writeHTML($html, true, false, true, false, '');

ob_end_clean();
$pdf->Output('Nota_Booking_'.$nota['kode_booking'].'.pdf', 'I');
?>
