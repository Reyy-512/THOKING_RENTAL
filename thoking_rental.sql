-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Agu 2025 pada 13.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thoking_rental`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `kode_booking` varchar(255) NOT NULL,
  `id_login` int(11) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `ktp` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `lama_sewa` int(11) NOT NULL,
  `waktu_sewa` varchar(50) DEFAULT NULL,
  `metode_pengambilan` enum('diantar','ambil_sendiri') NOT NULL,
  `total_harga` int(11) NOT NULL,
  `konfirmasi_pembayaran` varchar(255) NOT NULL,
  `status_admin` enum('belum_dibaca','dibaca') DEFAULT 'belum_dibaca',
  `tgl_input` varchar(255) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id_booking`, `kode_booking`, `id_login`, `id_mobil`, `ktp`, `nama`, `alamat`, `no_tlp`, `tanggal`, `lama_sewa`, `waktu_sewa`, `metode_pengambilan`, `total_harga`, `konfirmasi_pembayaran`, `status_admin`, `tgl_input`, `bukti_transfer`, `created_at`, `updated_at`) VALUES
(13, '1751959959', 9, 16, '8171051307054', 'Zindy Wattimena', 'Hutumuri', '081236252462', '2025-07-10', 1, NULL, 'diantar', 300823, 'Belum Bayar', 'belum_dibaca', '2025-07-08', '', '2025-08-12 13:46:46', NULL),
(14, '1751960910', 4, 16, '81710513070001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-07-10', 1, NULL, 'diantar', 300808, 'Belum Bayar', 'belum_dibaca', '2025-07-08', '', '2025-08-12 13:46:46', NULL),
(15, '1751961490', 11, 8, '81710513070001', 'Leonel Sariwating', 'Batu Meja', '08`236252462', '2025-07-10', 1, NULL, 'diantar', 400476, 'Pembayaran di terima', 'belum_dibaca', '2025-07-08', '', '2025-08-12 13:46:46', NULL),
(16, '1752124021', 5, 34, '817105130704', 'jessy', 'Hutumuri', '08123467848', '2025-07-10', 1, NULL, 'diantar', 850398, 'Belum Bayar', 'belum_dibaca', '2025-07-10', '', '2025-08-12 13:46:46', NULL),
(17, '1752124038', 5, 34, '817105130704', 'jessy', 'Hutumuri', '08123467848', '2025-07-10', 1, NULL, 'diantar', 850509, 'Pembayaran diterima', 'belum_dibaca', '2025-07-10', '', '2025-08-12 13:46:46', NULL),
(18, '1752125582', 9, 34, '817105130704', 'jessy', 'Hutumuri', '08123467848', '2025-07-10', 1, NULL, 'diantar', 850755, 'Belum Bayar', 'belum_dibaca', '2025-07-10', '', '2025-08-12 13:46:46', NULL),
(19, '1752566226', 15, 17, '81711203700002', 'Marthen', 'Hutumuri', '085392076394', '2025-07-16', 2, NULL, 'diantar', 700634, 'Pembayaran diterima', 'belum_dibaca', '2025-07-15', '', '2025-08-12 13:46:46', NULL),
(20, '1752566954', 9, 30, '8171056201050001', 'Zindy Wattimena', 'Hutumuri', '082198019354', '2025-07-16', 1, NULL, 'diantar', 350324, 'Belum Bayar', 'belum_dibaca', '2025-07-15', '', '2025-08-12 13:46:46', NULL),
(21, '1752587219', 15, 35, '81711203700002', 'Marthen', 'Hutumuri', '085392076394', '2025-07-16', 1, NULL, 'diantar', 850659, 'Belum Bayar', 'belum_dibaca', '2025-07-15', '', '2025-08-12 13:46:46', NULL),
(22, '1752587665', 15, 35, '81711203700002', 'Marthen', 'Hutumuri', '085392076394', '2025-07-16', 1, NULL, 'diantar', 850730, 'Belum Bayar', 'belum_dibaca', '2025-07-15', '', '2025-08-12 13:46:46', NULL),
(23, '1752590164', 15, 30, '81711203700002', 'Marthen', 'Hutumuri', '085392076394', '2025-07-16', 1, NULL, 'diantar', 350909, 'Belum Bayar', 'belum_dibaca', '2025-07-15', '', '2025-08-12 13:46:46', NULL),
(24, '1752594880', 15, 14, '81711203700002', 'Marthen', 'Hutumuri', '085392076394', '2025-07-17', 1, NULL, 'diantar', 350344, 'Sedang di proses', 'belum_dibaca', '2025-07-15', '', '2025-08-12 13:46:46', NULL),
(25, '1752598200', 4, 33, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-07-17', 1, NULL, 'diantar', 350865, 'Pembayaran diterima', 'belum_dibaca', '2025-07-15', '', '2025-08-12 13:46:46', NULL),
(26, '1752598929', 9, 29, '8171056201050001', 'Zindy Wattimena', 'Hutumuri', '082198019354', '2025-07-17', 1, NULL, 'diantar', 350766, 'Pembayaran diterima', 'belum_dibaca', '2025-07-15', '', '2025-08-12 13:46:46', NULL),
(27, '1752643138', 15, 26, '81711203700002', 'Marthen', 'Hutumuri', '085392076394', '2025-07-17', 1, NULL, 'diantar', 350545, 'Sedang di proses', 'belum_dibaca', '2025-07-16', '', '2025-08-12 13:46:46', NULL),
(28, '1752654209', 16, 22, '8171111200000211', 'Putri', 'Bos Silale', '082256066079', '2025-07-17', 1, NULL, 'diantar', 650734, 'Pembayaran diterima', 'belum_dibaca', '2025-07-16', '', '2025-08-12 13:46:46', NULL),
(29, '1752657553', 9, 7, '8171056201050001', 'Zindy Wattimena', 'Hutumuri', '082198019354', '2025-07-16', 1, NULL, 'diantar', 300558, 'Pembayaran diterima', 'belum_dibaca', '2025-07-16', '', '2025-08-12 13:46:46', NULL),
(30, '1752669030', 6, 15, '', 'reinzy', 'Hutumuri', '081245397955', '2025-07-16', 1, NULL, 'diantar', 350184, 'Pembayaran diterima', 'belum_dibaca', '2025-07-16', '', '2025-08-12 13:46:46', NULL),
(31, '1752683351', 6, 35, '81712711960001', 'reinzy', 'Hutumuri', '081245397955', '2025-07-16', 1, NULL, 'diantar', 850216, 'Pembayaran di terima', 'belum_dibaca', '2025-07-16', '', '2025-08-12 13:46:46', NULL),
(32, '1752732415', 15, 11, '81711203700002', 'Marthen', 'Hutumuri', '085392076394', '2025-07-17', 1, NULL, 'diantar', 350990, 'Pembayaran di terima', 'belum_dibaca', '2025-07-17', '', '2025-08-12 13:46:46', NULL),
(33, '1752763890', 5, 30, '8171051510030001', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-18', 1, NULL, 'diantar', 350950, 'Pembayaran di terima', 'belum_dibaca', '2025-07-17', '', '2025-08-12 13:46:46', NULL),
(34, '1752771814', 5, 25, '8171051510030001', 'jessy keiluhu', 'hutumuri', '0852447825', '2025-07-18', 1, NULL, 'diantar', 350482, 'Pembayaran di terima', 'belum_dibaca', '2025-07-17', '', '2025-08-12 13:46:46', NULL),
(35, '1752808103', 5, 35, '8171051510030001', 'jessy keiluhu', 'hutumuri', '0852447825', '2025-07-18', 1, NULL, 'diantar', 850965, 'Sedang di proses', 'belum_dibaca', '2025-07-18', '', '2025-08-12 13:46:46', NULL),
(36, '1752819649', 15, 23, '81711203700001', 'Marthen', 'Hutumuri', '085392076394', '2025-07-17', 1, NULL, 'diantar', 350888, 'Sedang di proses', 'belum_dibaca', '2025-07-18', '', '2025-08-12 13:46:46', NULL),
(37, '1752836413', 4, 35, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-07-17', 1, NULL, 'diantar', 850799, 'Pembayaran di terima', 'belum_dibaca', '2025-07-18', '', '2025-08-12 13:46:46', NULL),
(38, '1752884875', 9, 16, '8171056201050001', 'Zindy Wattimena', 'Hutumuri', '082198019354', '2025-07-17', 2, NULL, 'diantar', 700659, 'Pembayaran di terima', 'belum_dibaca', '2025-07-19', '', '2025-08-12 13:46:46', NULL),
(39, '1752892424', 15, 15, '81711203700001', 'Marthen', 'Hutumuri', '085392076394', '2025-07-19', 3, NULL, 'diantar', 1050842, 'Pembayaran di terima', 'belum_dibaca', '2025-07-19', '', '2025-08-12 13:46:46', NULL),
(40, '1753427653', 5, 35, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 1, 'disesuaikan', 'diantar', 850692, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(41, '1753427691', 5, 33, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 1, 'mingguan', 'diantar', 350359, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(42, '1753428044', 5, 33, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 1, 'mingguan', 'diantar', 350989, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(43, '1753428143', 5, 33, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 1, 'mingguan', 'diantar', 350438, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(44, '1753429040', 5, 16, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 1, 'harian', 'diantar', 350367, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(45, '1753429055', 5, 16, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 7, 'mingguan', 'diantar', 2450117, 'Pembayaran di terima', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(46, '1753438786', 5, 17, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 1, 'harian', 'diantar', 350102, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(47, '1753438799', 5, 17, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 7, 'mingguan', 'diantar', 2450298, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(48, '1753438809', 5, 17, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 30, 'bulanan', 'diantar', 10500977, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(49, '1753438852', 5, 19, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 1, '12_jam', 'diantar', 650483, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(50, '1753438864', 5, 19, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 1, '12_jam', 'diantar', 650335, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(51, '1753438875', 5, 19, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 1, '12_jam', 'diantar', 650410, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(52, '1753438887', 5, 19, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 7, 'mingguan', 'diantar', 4550937, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(53, '1753438925', 5, 24, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 5, 'harian', 'diantar', 1750332, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(54, '1753438937', 5, 24, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 7, 'mingguan', 'diantar', 2450645, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(55, '1753438949', 5, 24, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 30, 'bulanan', 'diantar', 10500602, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(56, '1753440255', 5, 33, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 7, 'mingguan', 'diantar', 2450312, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(57, '1753440264', 5, 33, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 30, 'bulanan', 'diantar', 10500438, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(58, '1753440293', 5, 19, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 1, '12 jam', 'diantar', 650236, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(59, '1753440313', 5, 34, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 1, 'disesuaikan', 'diantar', 850473, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(60, '1753443859', 5, 24, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 7, 'mingguan', 'diantar', 2450256, 'Belum Bayar', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(61, '1753448584', 5, 17, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 30, 'bulanan', 'diantar', 10500232, 'Pembayaran di terima', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(62, '1753449412', 5, 19, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-25', 1, '12 jam', 'diantar', 650369, 'Pembayaran di terima', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(63, '1753451280', 5, 32, '8171051510030002', 'jessy keiluhu', 'hutumuri', '0852447825', '2025-07-25', 1, 'harian', 'diantar', 350711, 'Pembayaran di terima', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(64, '1753452960', 5, 18, '8171051510030002', 'jessy keiluhu', 'Batu Meja', '0852447825', '2025-07-26', 7, 'mingguan', 'diantar', 6300467, 'Pembayaran di terima', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(65, '1753453101', 5, 8, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-07-26', 4, 'harian', 'diantar', 1200411, 'Pembayaran di terima', 'belum_dibaca', '2025-07-25', '', '2025-08-12 13:46:46', NULL),
(66, '1753770747', 4, 21, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-07-30', 1, '12 jam', 'diantar', 650601, 'Pembayaran di terima', 'belum_dibaca', '2025-07-29', '', '2025-08-12 13:46:46', NULL),
(67, '1754634489', 15, 13, '81711203700001', 'Marthen', 'ambon', '085392076394', '2025-08-09', 7, 'mingguan', 'diantar', 2450117, 'Pembayaran di terima', 'belum_dibaca', '2025-08-08', '', '2025-08-12 13:46:46', NULL),
(68, '1754635223', 5, 22, '8171051510030002', 'jessy keiluhu', 'Batu Meja', '0852447825', '2025-08-08', 1, '12 jam', 'diantar', 650983, 'Pembayaran di terima', 'belum_dibaca', '2025-08-08', '', '2025-08-12 13:46:46', NULL),
(69, '1754636192', 5, 14, '8171051510030002', 'jessy keiluhu', 'Laha', '0852447825', '2025-08-15', 1, 'harian', 'diantar', 350212, 'Pembayaran di terima', 'belum_dibaca', '2025-08-08', '', '2025-08-12 13:46:46', NULL),
(70, '1754669992', 5, 34, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-09', 1, 'hubungi wa tho-king', 'diantar', 850992, 'Sedang di proses', 'belum_dibaca', '2025-08-08', '', '2025-08-12 13:46:46', NULL),
(71, '1754673306', 4, 12, '8171051307030001', 'Geiny Wattimena', 'ambon', '081245397955', '2025-08-09', 3, 'harian', 'diantar', 1050959, 'Sedang di proses', 'belum_dibaca', '2025-08-08', '', '2025-08-12 13:46:46', NULL),
(72, '1754708417', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-11', 7, 'mingguan', 'diantar', 2450870, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(73, '1754709526', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-10', 4, 'harian', 'diantar', 1400746, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(74, '1754710238', 4, 12, '8171051307030001', 'Geiny Wattimena', 'ambon', '081245397955', '2025-08-09', 1, 'harian', 'diantar', 350937, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(75, '1754750171', 5, 12, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-09', 5, 'harian', 'diantar', 1750721, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(76, '1754750182', 5, 12, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-09', 7, 'mingguan', 'diantar', 2450510, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(77, '1754750190', 5, 12, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-09', 30, 'bulanan', 'diantar', 10500328, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(78, '1754751681', 5, 12, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-10', 7, 'mingguan', 'diantar', 2450401, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(79, '1754751690', 5, 12, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-10', 30, 'bulanan', 'diantar', 10500841, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(80, '1754751699', 5, 12, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-10', 6, 'harian', 'diantar', 2100144, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(81, '1754751762', 5, 34, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-11', 1, 'hubungi wa tho-king', 'diantar', 850359, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(82, '1754754318', 5, 12, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-10', 7, 'mingguan', 'diantar', 2450523, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(83, '1754754772', 5, 20, '8171051510030002', 'jessy keiluhu', 'Batu Meja', '0852447825', '2025-08-10', -7, 'mingguan', 'diantar', -4549643, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(84, '1754754815', 5, 20, '8171051510030002', 'jessy keiluhu', 'Batu Meja', '0852447825', '2025-08-11', 7, 'mingguan', 'diantar', 4550868, 'Belum Bayar', 'belum_dibaca', '2025-08-09', '', '2025-08-12 13:46:46', NULL),
(85, '1754811695', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Batu Meja', '081245397955', '2025-08-11', 7, 'mingguan', 'diantar', 2450382, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(86, '1754812157', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Batu Meja', '081245397955', '2025-08-11', 7, 'mingguan', 'diantar', 2450605, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(87, '1754812379', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Batu Meja', '081245397955', '2025-08-11', 1, 'harian', 'diantar', 350149, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(88, '1754813402', 4, 12, '8171051307030001', 'Geiny Wattimena', 'a', '081245397955', '2025-08-12', 1, 'harian', 'diantar', 350164, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(89, '1754813622', 4, 12, '8171051307030001', 'Geiny Wattimena', 'a', '081245397955', '2025-08-12', 1, 'harian', 'diantar', 350918, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(90, '1754813630', 4, 12, '8171051307030001', 'Geiny Wattimena', 'a', '081245397955', '2025-08-12', 1, 'harian', 'diantar', 350906, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(91, '1754813645', 4, 12, '8171051307030001', 'Geiny Wattimena', 'a', '081245397955', '2025-08-12', 1, 'harian', 'diantar', 350538, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(92, '1754813652', 4, 12, '8171051307030001', 'Geiny Wattimena', 'a', '081245397955', '2025-08-12', 1, 'harian', 'diantar', 350940, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(93, '1754813745', 4, 12, '8171051307030001', 'Geiny Wattimena', 'a', '081245397955', '2025-08-12', 1, 'harian', 'diantar', 350194, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(94, '1754813864', 4, 12, '8171051307030001', 'Geiny Wattimena', 'a', '081245397955', '2025-08-12', 1, 'harian', 'diantar', 350691, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(95, '1754814073', 4, 12, '8171051307030001', 'Geiny Wattimena', 'a', '081245397955', '2025-08-12', 1, 'harian', 'diantar', 350598, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(96, '1754814080', 4, 12, '8171051307030001', 'Geiny Wattimena', 'a', '081245397955', '2025-08-12', 1, 'harian', '', 350602, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(97, '1754814153', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-11', 2, 'harian', '', 700398, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(98, '1754814161', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-11', 2, 'harian', 'diantar', 700907, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(99, '1754814332', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-11', 2, 'harian', 'diantar', 700696, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(100, '1754814436', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-11', 2, 'harian', '', 700424, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(101, '1754814445', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-11', 2, 'harian', 'diantar', 700347, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(102, '1754814533', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-11', 1, 'harian', 'diantar', 350998, 'Pembayaran di terima', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(103, '1754814944', 4, 11, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-12', 1, 'harian', '', 350565, 'Pembayaran di terima', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(104, '1754816498', 5, 7, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-13', 7, 'mingguan', 'diantar', 2100317, 'Pembayaran di terima', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(105, '1754817454', 4, 21, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-12', 1, 'harian', 'diantar', 650298, 'Pembayaran di terima', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(106, '1754818189', 4, 30, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-13', 1, 'harian', 'diantar', 350297, 'Pembayaran di terima', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(107, '1754821985', 4, 21, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-12', 3, 'harian', 'diantar', 1950852, 'Pembayaran di terima', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(108, '1754845316', 4, 26, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-13', 1, 'harian', 'diantar', 350998, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(109, '1754845836', 4, 7, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 1, 'harian', 'diantar', 300981, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(110, '1754845846', 4, 7, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 1, 'harian', '', 300165, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(111, '1754847812', 4, 7, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-12', 3, 'harian', 'diantar', 900965, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(112, '1754847819', 4, 7, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-12', 3, 'harian', '', 900773, 'Belum Bayar', 'belum_dibaca', '2025-08-10', '', '2025-08-12 13:46:46', NULL),
(113, '1754890820', 4, 10, '8171051307030001', 'Geiny Wattimena', 'hutumuri', '081245397955', '2025-08-14', 2, 'harian', 'diantar', 600105, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(114, '1754891490', 4, 33, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 14, 'mingguan', 'diantar', 4900910, 'Pembayaran di terima', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(115, '1754893799', 23, 20, '1234567123451234', 'adrian asikin', 'Laha', '085240105249', '2025-08-14', 1, 'harian', '', 650678, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(116, '1754894105', 23, 31, '1234567123451234', 'Adrian Asikin', 'ambon', '085240105249', '2025-08-12', 1, 'harian', '', 350154, 'Pembayaran di terima', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(117, '1754899780', 4, 10, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 14, 'mingguan', 'diantar', 4200660, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(118, '1754911945', 4, 23, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-15', 3, 'harian', 'diantar', 1050381, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(119, '1754912409', 4, 24, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-12', 5, 'harian', 'diantar', 1750322, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(120, '1754924994', 4, 10, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 1, 'harian', 'diantar', 300875, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(121, '1754925019', 4, 35, '8171051307030001', 'Geiny Wattimena', 'w', '081245397955', '2025-08-12', 1, 'pengantin', 'diantar', 850869, 'Sedang di proses', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(122, '1754926951', 5, 23, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 7, 'mingguan', 'diantar', 2450349, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(123, '1754926970', 5, 23, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 7, 'mingguan', 'diantar', 2450894, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(124, '1754927038', 5, 23, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 7, 'mingguan', 'ambil_sendiri', 2450702, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(125, '1754927321', 5, 23, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 21, 'mingguan', 'ambil_sendiri', 7350410, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(126, '1754927334', 5, 23, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 21, 'mingguan', 'ambil_sendiri', 7350885, 'Belum Bayar', 'belum_dibaca', '2025-08-11', '', '2025-08-12 13:46:46', NULL),
(127, '1754976218', 4, 10, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 7, 'mingguan', 'diantar', 2100301, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 13:46:46', NULL),
(128, '1754977121', 4, 10, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 0, 'harian', 'diantar', 321, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 13:46:46', NULL),
(129, '1754977216', 4, 10, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 14, 'mingguan', 'diantar', 4200447, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 13:46:46', NULL),
(130, '1754977314', 4, 10, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 14, 'mingguan', 'diantar', 4200145, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 13:46:46', '2025-08-12 13:53:24'),
(131, '1754978025', 4, 10, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 3, 'harian', 'ambil_sendiri', 900993, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 13:53:45', '2025-08-12 14:20:29'),
(132, '1754980289', 4, 26, '8171051307030001', 'Geiny Wattimena', 'Batu Meja', '081245397955', '2025-08-13', 3, 'harian', 'diantar', 1050420, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 14:31:29', '2025-08-12 14:31:30'),
(133, '1754980524', 4, 24, '8171051307030001', 'Geiny Wattimena', 'hutumuri', '081245397955', '2025-08-13', 7, 'mingguan', 'diantar', 2450409, 'Pembayaran di terima', '', '2025-08-12', '', '2025-08-12 14:35:24', '2025-08-12 14:58:40'),
(134, '1754982281', 4, 23, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-12', 14, 'mingguan', 'diantar', 4900701, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 15:04:41', '2025-08-12 15:04:43'),
(135, '1754982552', 4, 20, '8171051307030001', 'Geiny Wattimena', 'Batu Meja', '081245397955', '2025-08-13', 7, 'harian', 'diantar', 4550943, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 15:09:12', '2025-08-12 15:09:14'),
(136, '1754999550', 5, 10, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-13', 4, 'harian', 'diantar', 1200944, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 19:52:30', '2025-08-12 19:52:32'),
(137, '1755000984', 4, 32, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 14, 'mingguan', 'ambil_sendiri', 4900953, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 20:16:24', '2025-08-12 20:18:33'),
(138, '1755001241', 4, 10, '8171051307030001', 'Geiny Wattimena', 'Batu Meja', '081245397955', '2025-08-13', 7, 'mingguan', 'diantar', 2100523, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 20:20:41', '2025-08-12 20:32:59'),
(139, '1755001396', 4, 20, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 7, 'mingguan', 'diantar', 4550416, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 20:23:16', '2025-08-12 20:23:17'),
(140, '1755002183', 4, 20, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 2, 'harian', 'diantar', 1300342, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 20:36:23', '2025-08-12 20:36:25'),
(141, '1755003170', 4, 10, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 2, 'harian', 'diantar', 600545, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 20:52:50', '2025-08-12 20:53:03'),
(142, '1755003245', 4, 20, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 1, 'harian', 'ambil_sendiri', 650677, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 20:54:05', '2025-08-12 20:54:07'),
(143, '1755006310', 5, 10, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 1, 'harian', 'diantar', 300684, 'Belum Bayar', 'belum_dibaca', '2025-08-12', '', '2025-08-12 21:45:10', NULL),
(144, '1755006543', 5, 10, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 1, 'harian', 'diantar', 300375, 'Pembayaran ditolak', 'belum_dibaca', '2025-08-12', '', '2025-08-12 21:49:03', '2025-08-14 17:24:18'),
(145, '1755007655', 5, 22, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 30, 'bulanan', 'ambil_sendiri', 19500607, 'Pembayaran di terima', 'belum_dibaca', '2025-08-12', '', '2025-08-12 22:07:35', '2025-08-12 22:08:13'),
(146, '1755015085', 4, 20, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 4, 'harian', 'ambil_sendiri', 2600744, 'Pembayaran di terima', 'belum_dibaca', '2025-08-12', '', '2025-08-13 00:11:25', '2025-08-13 00:14:00'),
(147, '1755051433', 5, 15, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 1, 'harian', 'diantar', 350662, 'Pembayaran di terima', 'belum_dibaca', '2025-08-13', '', '2025-08-13 10:17:13', '2025-08-14 17:24:41'),
(148, '1755051460', 5, 34, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-13', 1, 'pengantin', 'diantar', 850168, 'Pembayaran di terima', 'belum_dibaca', '2025-08-13', '', '2025-08-13 10:17:40', '2025-08-13 10:19:04'),
(149, '1755086547', 4, 17, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 2, 'harian', 'diantar', 700708, 'Pembayaran ditolak', 'belum_dibaca', '2025-08-13', '', '2025-08-13 20:02:27', '2025-08-13 20:06:33'),
(150, '1755091317', 5, 17, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 2, 'harian', 'diantar', 700128, 'Pembayaran di terima', 'belum_dibaca', '2025-08-13', '', '2025-08-13 21:21:57', '2025-08-13 21:28:20'),
(151, '1755092386', 5, 15, '8171051510030002', 'jessy keiluhu', 'Batu Meja', '0852447825', '2025-08-14', 14, 'mingguan', 'diantar', 4900315, 'Belum Bayar', 'belum_dibaca', '2025-08-13', '', '2025-08-13 21:39:46', NULL),
(152, '1755092454', 5, 15, '8171051510030002', 'jessy keiluhu', 'hutumuri', '0852447825', '2025-08-14', 30, 'bulanan', 'diantar', 10500178, 'Belum Bayar', 'belum_dibaca', '2025-08-13', '', '2025-08-13 21:40:54', NULL),
(153, '1755092498', 5, 15, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 7, 'mingguan', 'diantar', 2450870, 'Pembayaran di terima', 'belum_dibaca', '2025-08-13', '', '2025-08-13 21:41:38', '2025-08-13 21:44:27'),
(154, '1755092545', 5, 14, '8171051510030002', 'jessy keiluhu', 'hutumuri', '0852447825', '2025-08-14', 4, 'harian', 'diantar', 1400350, 'Pembayaran ditolak', 'belum_dibaca', '2025-08-13', '', '2025-08-13 21:42:25', '2025-08-13 21:46:15'),
(155, '1755093149', 5, 32, '8171051510030002', 'jessy keiluhu', 'Hutumuri', '0852447825', '2025-08-14', 7, 'mingguan', 'diantar', 2450522, 'Pembayaran di terima', 'belum_dibaca', '2025-08-13', '', '2025-08-13 21:52:29', '2025-08-13 21:53:02'),
(156, '1755094040', 15, 35, '81711203700001', 'Marthen', 'Hutumuri', '085392076394', '2025-08-13', 1, 'pengantin', 'diantar', 850170, 'Pembayaran ditolak', 'belum_dibaca', '2025-08-13', '', '2025-08-13 22:07:20', '2025-08-13 22:23:05'),
(157, '1755162858', 4, 18, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 30, 'bulanan', 'diantar', 27000609, 'Pembayaran ditolak', 'belum_dibaca', '2025-08-14', '', '2025-08-14 17:14:18', '2025-08-14 17:23:31'),
(158, '1755163552', 4, 21, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-15', 2, 'harian', 'diantar', 1300897, 'Pembayaran di terima', 'belum_dibaca', '2025-08-14', '', '2025-08-14 17:25:52', '2025-08-14 17:26:57'),
(159, '1755164199', 4, 12, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 1, 'harian', 'diantar', 350407, 'Pembayaran ditolak', 'belum_dibaca', '2025-08-14', '', '2025-08-14 17:36:39', '2025-08-14 17:41:26'),
(160, '1755164540', 4, 20, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-14', 3, 'harian', 'diantar', 1950149, 'Pembayaran di terima', 'belum_dibaca', '2025-08-14', '', '2025-08-14 17:42:20', '2025-08-14 17:44:57'),
(163, '1755237670', 4, 33, '8171051307030001', 'Geiny Wattimena', 'hutumuri', '081245397955', '2025-08-15', 1, 'harian', 'diantar', 350248, 'Belum Bayar', 'belum_dibaca', '2025-08-15', '', '2025-08-15 14:01:10', NULL),
(164, '1755237679', 4, 33, '8171051307030001', 'Geiny Wattimena', 'hutumuri', '081245397955', '2025-08-15', 2, 'harian', 'diantar', 700310, 'Belum Bayar', 'belum_dibaca', '2025-08-15', '', '2025-08-15 14:01:19', NULL),
(165, '1755237803', 4, NULL, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-15', 2, 'harian', 'diantar', 26912587, 'Pembayaran ditolak', 'belum_dibaca', '2025-08-15', '', '2025-08-15 14:03:23', '2025-08-15 14:05:09'),
(166, '1755238929', 4, NULL, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-15', 1, 'pengantin', 'diantar', 1010525, 'Sedang di proses', 'belum_dibaca', '2025-08-15', '', '2025-08-15 14:22:09', '2025-08-15 14:22:29'),
(167, '1755239130', 4, NULL, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-15', 7, 'mingguan', 'diantar', 700922, 'Sedang di proses', 'belum_dibaca', '2025-08-15', '', '2025-08-15 14:25:30', '2025-08-15 14:25:48'),
(168, '1755239176', 4, NULL, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-15', 30, 'bulanan', 'diantar', 403686797, 'Belum Bayar', 'belum_dibaca', '2025-08-15', '', '2025-08-15 14:26:16', NULL),
(169, '1755331565', 4, 14, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-17', 3, 'harian', 'diantar', 1050467, 'Pembayaran di terima', 'belum_dibaca', '2025-08-16', '', '2025-08-16 16:06:05', '2025-08-16 16:07:45'),
(170, '1755410992', 4, 35, '8171051307030001', 'Geiny Wattimena', 'Hutumuri', '081245397955', '2025-08-18', 1, 'pengantin', 'diantar', 850512, 'Pembayaran di terima', 'belum_dibaca', '2025-08-17', '', '2025-08-17 14:09:52', '2025-08-17 14:11:13'),
(171, '1755411571', 15, 23, '81711203700001', 'Marthen', 'Hutumuri', '085392076394', '2025-08-17', 7, 'mingguan', 'diantar', 2450834, 'Pembayaran di terima', 'belum_dibaca', '2025-08-17', '', '2025-08-17 14:19:31', '2025-08-17 14:20:04'),
(175, '1755411911', 15, 12, '81711203700001', 'Marthen', 'Hutumuri', '085392076394', '2025-08-18', 5, 'harian', 'diantar', 1750000, 'Pembayaran di terima', 'belum_dibaca', '2025-08-17', '', '2025-08-17 14:25:11', '2025-08-18 02:19:35'),
(176, '1755458863', 15, NULL, '81711203700001', 'Marthen', 'hutumuri', '085392076394', '2025-08-19', 1, 'pengantin', 'diantar', 3500, 'Pembayaran ditolak', 'belum_dibaca', '2025-08-17', '', '2025-08-18 03:27:43', '2025-08-18 03:28:42'),
(177, '1755496034', 15, NULL, '81711203700001', 'Marthen', 'Laha', '085392076394', '2025-08-19', 14, 'mingguan', 'diantar', 49000, 'Pembayaran ditolak', 'belum_dibaca', '2025-08-18', '', '2025-08-18 13:47:14', '2025-08-18 13:47:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `infoweb`
--

CREATE TABLE `infoweb` (
  `id` int(11) NOT NULL,
  `id_login` int(11) DEFAULT NULL,
  `nama_rental` varchar(255) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_rek` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `infoweb`
--

INSERT INTO `infoweb` (`id`, `id_login`, `nama_rental`, `telp`, `alamat`, `email`, `no_rek`, `updated_at`) VALUES
(1, NULL, 'THO-KING RENTAL', '082248559459 ', 'Jl. Kapten Piere Tendean, Hative Kecil, Kec. Sirimau, Kota Ambon, Maluku', 'cvthoking001@gmail.com', 'BRI 8822833834 A/N engky', '2022-01-23 20:57:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `nama_pengguna`, `username`, `password`, `nik`, `no_telepon`, `level`) VALUES
(1, 'Engki', 'THOKING', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 'admin'),
(4, 'Geiny Wattimena', 'geinyy', '16d222a5fac9d8d7a3ee790f9ee46af5', '8171051307030001', '081245397955', 'pengguna'),
(5, 'jessy keiluhu', 'jessy', 'ba9ce6abc7f38bf0649e9ba9a8de0e0c', '8171051510030002', '0852447825', 'pengguna'),
(6, 'reinzy', 'rey', '96035a131113e89c754800119cdca879', '81712711960001', '081245397955', 'pengguna'),
(7, 'Andhini', 'dini', '9015e536b1458c33bd7f595a7c832b5e', NULL, NULL, 'pengguna'),
(8, 'Giselle Thenu', 'icell', '7ada45f9f36defde8d1dbc4191c5043a', NULL, NULL, 'pengguna'),
(9, 'Zindy Wattimena', 'zindy', '480f529722ed931fb9b14eae7bd10722', '8171056201050001', '082198019354', 'pengguna'),
(10, 'Yensi Wattimena', 'yensi', '5401a6f7c90ed50d912159ddbec0bf6b', NULL, NULL, 'pengguna'),
(11, 'Leonel Sariwating', 'leonel', '5bf13ff38ede45abcae3772a86453444', NULL, NULL, 'pengguna'),
(12, 'Christ', 'christ', 'bfb3206155832047330e55a331d6734e', NULL, NULL, 'pengguna'),
(13, 'Necha Wattimena', 'necha', '6f7cd236cf8ce870cfb8f364915b9600', NULL, NULL, 'pengguna'),
(14, 'Hendrick', 'endiko', 'f165dce6707da9af8b309ea9eafaad5c', NULL, NULL, 'pengguna'),
(15, 'Marthen', 'margo', 'bd8553b8c52e04567c72881ad7d75b4f', '81711203700001', '085392076394', 'pengguna'),
(16, 'Putri', 'puput', '9c721b544e577c85f7e0d19b59824e12', '8171111200000211', '082256066079', 'pengguna'),
(17, 'hasan', 'dino', '9e309c08c5f50d20979d31ddb2b7c892', '8171060520030002', '081234567890', 'pengguna'),
(18, 'wilhelmina', 'yoan', 'a0c5e9b2920016a269c6cce10b582d0f', '8171052311690002', '081234567890', 'pengguna'),
(19, 'johanis', 'jo', 'd54d1702ad0f8326224b817c796763c9', '1111222233334444', '123443211234', 'pengguna'),
(20, 'barcelona', 'barca', '$2y$10$oxYC689/G1Wl.QFZu.SOougyMWSovsrxBrukntUQteoBtd2s3uPz.', '1307200313072003', '130720031307200', 'pengguna'),
(21, 'Getwinnn', 'admin2', 'c84258e9c39059a89ab77d846ddab909', NULL, NULL, 'admin'),
(23, 'Adrian Asikin', 'Adrian', '953e2f0a93a30221798d30c8f0050df4', '1234567123451234', '085240105249', 'pengguna'),
(24, 'casper', 'casper15', '308ee2da094d106db2f1754aec7af295', '1503202515032025', '123443211234', 'pengguna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `no_plat` varchar(25) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `tipe` varchar(100) DEFAULT NULL,
  `harga` int(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` enum('Tersedia','Tidak Tersedia','Sedang Dibooking') NOT NULL DEFAULT 'Tersedia',
  `gambar` text NOT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `transmisi` varchar(50) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `jenis_bensin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `id_paket`, `no_plat`, `merk`, `tipe`, `harga`, `deskripsi`, `status`, `gambar`, `warna`, `transmisi`, `kapasitas`, `jenis_bensin`) VALUES
(7, NULL, 'DE 1300 AH', 'Avansa All New', 'Avanza All New 24 Jam', 300000, 'Baik', 'Tersedia', '686cd3ed9cdee.png', 'Putih', 'Matic', 7, 'Pertalite'),
(8, NULL, 'DE 1105 AN', 'Avansa All New', 'Avanza All New 24 Jam', 300000, 'Baik', 'Tersedia', '686cd42c9fc81.png', 'Putih', 'Manual', 7, 'Pertalite'),
(10, NULL, 'DE 1019 G', 'Avansa All New', 'Avanza All New 24 Jam', 300000, 'Baik', 'Tersedia', '686cd465baf09.png', 'Hitam', 'Manual', 7, 'Pertalite'),
(11, NULL, 'DE 1317 AN', 'Avansa G ', 'Avanza G 24 Jam', 350000, 'Baik', 'Tersedia', '686cd4f3e01b1.png', 'Putih', 'Manual', 7, 'Pertalite'),
(12, NULL, 'DE 927 XX', 'Avansa G ', 'Avanza G 24 Jam', 350000, 'Baik', 'Tidak Tersedia', '686cd56810445.png', 'Hitam', 'Matic', 7, 'Pertalite'),
(13, NULL, 'DE 141 XX', 'Avansa G ', 'Avanza G 24 Jam', 350000, 'Baik', 'Tersedia', '686cd7985a633.png', 'Putih', 'Matic', 7, 'Pertalite'),
(14, NULL, 'DE 1514 AP', 'Avansa G ', 'Avanza G 24 Jam', 350000, 'Baik', 'Tersedia', '686cd655036c5.png', 'Hitam', 'Manual', 7, 'Pertalite'),
(15, NULL, 'DE 1929 AH', 'Avansa G ', 'Avanza G 24 Jam', 350000, 'Baik', 'Tidak Tersedia', '686cd69b15224.png', 'Hitam', 'Manual', 7, 'Pertalite'),
(16, NULL, 'DE 1615 AI', 'Avansa G ', 'Avanza G 24 Jam', 350000, 'Baik', 'Tersedia', '686cd70c7c698.png', 'Putih', 'Manual', 7, 'Pertalite'),
(17, NULL, 'DE 1159 AH', 'Avansa G ', 'Avanza G 24 Jam', 350000, 'Baik', 'Tidak Tersedia', '686cd7518fd5c.png', 'Putih', 'Manual', 7, 'Pertalite'),
(18, NULL, 'DE 817 XX', 'Inova Reborn ', 'Innova Reborn', 900000, 'Baik', 'Tersedia', '686cd86a3376c.png', 'Hitam', 'Manual', 8, 'Pertamax'),
(19, NULL, 'DE 1955 AN', 'Innova Reborn ', 'Innova Reborn', 650000, 'Baik', 'Tersedia', '686cd8ced1040.png', 'Hitam', 'Manual', 8, 'Pertamax'),
(20, NULL, 'DE 1924 LT', 'Innova Reborn ', 'Innova Reborn', 650000, 'Baik', 'Tidak Tersedia', '686cd91c26acf.png', 'Hitam', 'Manual', 8, 'Pertamax'),
(21, NULL, 'B 2968 SKW', 'Innova Reborn ', 'Innova Reborn', 650000, 'Baik', 'Tidak Tersedia', '686cd94aab9c4.png', 'Hitam', 'Manual', 8, 'Pertamax'),
(22, NULL, 'H 9036 QS', 'Innova Reborn ', 'Innova Reborn', 650000, 'Baik', 'Tersedia', '686cd9a1d8fc9.png', 'Hitam', 'Manual', 8, 'Pertamax'),
(23, NULL, 'DE 1548 B', 'Honda Br-V', 'Honda BR-V dan Mobilio', 350000, 'Baik', 'Tidak Tersedia', '686cda77eee6f.png', 'Hitam', 'Manual', 7, 'Pertalite'),
(24, NULL, 'DE 1611 AP', 'Honda Br-V', 'Honda BR-V dan Mobilio', 350000, 'Baik', 'Tersedia', '686cdab00b3a7.png', 'Merah', 'Manual', 7, 'Pertalite'),
(25, NULL, 'DE 1082 AO', 'Honda Brio ', 'Manual', 350000, 'Baik', 'Tersedia', '686cdb6ddb3bb.png', 'Hitam', 'Manual', 5, 'Pertalite'),
(26, NULL, 'DE 1926 LD', 'Honda Brio ', 'Matic', 350000, 'Baik', 'Tersedia', '686cdbd7183ed.png', 'Putih', 'Matic', 5, 'Pertalite'),
(29, NULL, 'DE 906 AG', 'Toyota Yaris ', 'Matic', 350000, 'Baik', 'Tersedia', '686cdcbb3eb63.png', 'Putih', 'Matic', 5, 'Pertalite'),
(30, NULL, 'DE 1611 AP', 'Honda Jazz ', 'Matic', 350000, 'Baik', 'Tersedia', '686cdd7ec5780.png', 'Merah', 'Matic', 5, 'Pertalite'),
(31, NULL, 'DE 1123 D', 'Mitsubishi Xpander', 'Matic', 350000, 'Baik', 'Tersedia', '686cddf48d664.png', 'merah', 'Matic', 7, 'Pertalite'),
(32, NULL, 'DE 1830 AP', 'Honda Brio ', 'Manual', 350000, 'Baik', 'Tidak Tersedia', '686cdf1dbf032.png', 'merah', 'Manual', 5, 'pertalite'),
(33, NULL, 'DE 1156 AO', 'Honda Brio ', 'Manual', 350000, 'Baik', 'Tersedia', '686ce0aa8ef66.png', 'merah', 'Manual', 5, 'pertalite'),
(34, NULL, 'DE 1911 AL', 'Honda Jazz', 'Mobil Pengantin', 850000, 'Baik', 'Tidak Tersedia', '686ce11eeb270.png', 'putih', 'Manual', 3, 'pertalite'),
(35, NULL, 'DE 1926 LD', 'Honda Jazz ', 'Mobil Pengantin', 850000, 'Baik', 'Tersedia', '686ce21476762.jpg', 'putih', 'Manual', 4, 'pertalite');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `id_login` int(11) DEFAULT NULL,
  `id_booking` int(11) DEFAULT NULL,
  `kode_booking` varchar(50) DEFAULT NULL,
  `total_harga` bigint(20) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status` enum('belum_dibaca','dibaca') DEFAULT 'belum_dibaca',
  `jenis` enum('diterima','ditolak') NOT NULL DEFAULT 'diterima'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`id_nota`, `id_login`, `id_booking`, `kode_booking`, `total_harga`, `tanggal`, `status`, `jenis`) VALUES
(1, 16, 28, '1752654209', 650734, '2025-07-16 11:18:08', 'belum_dibaca', 'diterima'),
(2, 9, 29, '1752657553', 300558, '2025-07-16 11:20:41', 'dibaca', 'diterima'),
(3, 9, 29, '1752657553', 300558, '2025-07-16 11:20:47', 'dibaca', 'diterima'),
(4, 6, 30, '1752669030', 350184, '2025-07-16 14:31:59', 'dibaca', 'diterima'),
(5, 5, 33, '1752763890', 350950, '2025-07-17 17:07:01', 'dibaca', 'diterima'),
(6, 5, 34, '1752771814', 350482, '2025-07-17 19:04:33', 'dibaca', 'diterima'),
(7, 6, 31, '1752683351', 850216, '2025-07-18 07:06:15', 'dibaca', 'diterima'),
(8, 4, 37, '1752836413', 850799, '2025-07-18 13:01:40', 'dibaca', 'diterima'),
(9, 9, 38, '1752884875', 700659, '2025-07-19 02:29:01', 'dibaca', 'diterima'),
(10, 15, 39, '1752892424', 1050842, '2025-07-19 04:36:29', 'dibaca', 'diterima'),
(11, 5, 45, '1753429055', 2450117, '2025-07-25 09:39:52', 'dibaca', 'diterima'),
(12, 5, 61, '1753448584', 10500232, '2025-07-25 15:09:22', 'dibaca', 'diterima'),
(13, 5, 62, '1753449412', 650369, '2025-07-25 15:25:22', 'dibaca', 'diterima'),
(14, 5, 63, '1753451280', 350711, '2025-07-25 15:49:56', 'dibaca', 'diterima'),
(15, 5, 64, '1753452960', 6300467, '2025-07-25 16:29:29', 'dibaca', 'diterima'),
(16, 4, 66, '1753770747', 650601, '2025-07-29 08:33:48', 'dibaca', 'diterima'),
(17, 15, 67, '1754634489', 2450117, '2025-08-08 08:31:05', 'dibaca', 'diterima'),
(18, 5, 68, '1754635223', 650983, '2025-08-08 08:42:54', 'dibaca', 'diterima'),
(19, 5, 69, '1754636192', 350212, '2025-08-08 09:01:44', 'dibaca', 'diterima'),
(20, 4, 102, '1754814533', 350998, '2025-08-10 10:41:09', 'dibaca', 'diterima'),
(21, 4, 103, '1754814944', 350565, '2025-08-10 10:41:21', 'dibaca', 'diterima'),
(22, 4, 106, '1754818189', 350297, '2025-08-10 11:31:50', 'dibaca', 'diterima'),
(23, 4, 107, '1754821985', 1950852, '2025-08-10 12:33:59', 'dibaca', 'diterima'),
(24, 4, 105, '1754817454', 650298, '2025-08-10 15:13:35', 'dibaca', 'diterima'),
(25, 5, 104, '1754816498', 2100317, '2025-08-11 05:35:52', 'dibaca', 'diterima'),
(26, 5, 65, '1753453101', 1200411, '2025-08-11 07:33:01', 'dibaca', 'diterima'),
(27, 4, 114, '1754891490', 4900910, '2025-08-11 07:53:54', 'dibaca', 'diterima'),
(28, 23, 116, '1754894105', 350154, '2025-08-11 09:00:05', 'dibaca', 'diterima'),
(29, 4, 121, '1754925019', 850869, '2025-08-11 17:22:48', 'dibaca', 'diterima'),
(30, 5, 145, '1755007655', 19500607, '2025-08-12 16:08:24', 'dibaca', 'diterima'),
(31, 4, 146, '1755015085', 2600744, '2025-08-12 18:14:13', 'dibaca', 'diterima'),
(32, 4, 146, '1755015085', 2600744, '2025-08-12 18:52:59', 'dibaca', 'diterima'),
(33, 4, 146, '1755015085', 2600744, '2025-08-12 19:01:08', 'dibaca', 'diterima'),
(34, 4, 146, '1755015085', 2600744, '2025-08-12 19:02:23', 'dibaca', 'diterima'),
(35, 4, 146, '1755015085', 2600744, '2025-08-12 19:06:05', 'dibaca', 'diterima'),
(36, 5, 148, '1755051460', 850168, '2025-08-13 04:19:09', 'dibaca', 'diterima'),
(37, 5, 147, '1755051433', 350662, '2025-08-13 04:19:32', 'dibaca', 'diterima'),
(38, 5, 147, '1755051433', 350662, '2025-08-13 04:44:42', 'dibaca', 'diterima'),
(39, 5, 147, '1755051433', 350662, '2025-08-13 04:51:15', 'dibaca', 'diterima'),
(40, 5, 147, '1755051433', 350662, '2025-08-13 04:53:07', 'dibaca', 'diterima'),
(41, 5, 147, '1755051433', 350662, '2025-08-13 04:53:28', 'dibaca', 'diterima'),
(42, 5, 147, '1755051433', 350662, '2025-08-13 05:02:33', 'dibaca', 'diterima'),
(43, 5, 147, '1755051433', 350662, '2025-08-13 05:03:32', 'dibaca', 'ditolak'),
(44, 5, 147, '1755051433', 350662, '2025-08-13 05:08:14', 'dibaca', 'diterima'),
(45, 5, 148, '1755051460', 850168, '2025-08-13 05:10:41', 'dibaca', 'diterima'),
(46, 5, 148, '1755051460', 850168, '2025-08-13 05:11:13', 'dibaca', 'ditolak'),
(47, 5, 150, '1755091317', 700128, '2025-08-13 15:28:26', 'dibaca', 'diterima'),
(48, 5, 153, '1755092498', 2450870, '2025-08-13 15:44:38', 'dibaca', 'diterima'),
(49, 5, 154, '1755092545', 1400350, '2025-08-13 15:46:20', 'dibaca', 'ditolak'),
(50, 5, 155, '1755093149', 2450522, '2025-08-13 15:53:07', 'dibaca', 'diterima'),
(51, 15, 156, '1755094040', 850170, '2025-08-13 16:08:17', 'dibaca', 'diterima'),
(52, 15, 156, '1755094040', 850170, '2025-08-13 16:08:41', 'dibaca', 'diterima'),
(53, 15, 156, '1755094040', 850170, '2025-08-13 16:13:36', 'dibaca', 'ditolak'),
(54, 15, 156, '1755094040', 850170, '2025-08-13 16:14:05', 'dibaca', 'diterima'),
(55, 15, 156, '1755094040', 850170, '2025-08-13 16:14:23', 'dibaca', 'ditolak'),
(56, 15, 156, '1755094040', 850170, '2025-08-13 16:18:35', 'dibaca', 'ditolak'),
(57, 15, 156, '1755094040', 850170, '2025-08-13 16:18:55', 'dibaca', 'diterima'),
(58, 15, 156, '1755094040', 850170, '2025-08-13 16:19:22', 'dibaca', 'ditolak'),
(59, 15, 156, '1755094040', 850170, '2025-08-13 16:21:29', 'dibaca', 'ditolak'),
(60, 15, 156, '1755094040', 850170, '2025-08-13 16:21:45', 'dibaca', 'ditolak'),
(61, 15, 156, '1755094040', 850170, '2025-08-13 16:22:51', 'dibaca', 'diterima'),
(62, 15, 156, '1755094040', 850170, '2025-08-13 16:23:09', 'dibaca', 'ditolak'),
(63, 4, 157, '1755162858', 27000609, '2025-08-14 11:19:37', 'dibaca', 'diterima'),
(64, 4, 157, '1755162858', 27000609, '2025-08-14 11:22:45', 'dibaca', 'ditolak'),
(65, 4, 158, '1755163552', 1300897, '2025-08-14 11:26:29', 'dibaca', 'ditolak'),
(66, 4, 158, '1755163552', 1300897, '2025-08-14 11:27:04', 'dibaca', 'diterima'),
(67, 4, 159, '1755164199', 350407, '2025-08-14 11:38:36', 'dibaca', 'diterima'),
(68, 4, 159, '1755164199', 350407, '2025-08-14 11:41:31', 'dibaca', 'ditolak'),
(69, 4, 160, '1755164540', 1950149, '2025-08-14 11:43:47', 'dibaca', 'ditolak'),
(70, 4, 160, '1755164540', 1950149, '2025-08-14 11:45:02', 'dibaca', 'diterima'),
(71, 4, 165, '1755237803', 26912587, '2025-08-15 08:05:31', 'dibaca', 'ditolak'),
(72, 4, 169, '1755331565', 1050467, '2025-08-16 10:06:52', 'dibaca', 'ditolak'),
(73, 4, 169, '1755331565', 1050467, '2025-08-16 10:07:49', 'dibaca', 'diterima'),
(74, 4, 170, '1755410992', 850512, '2025-08-17 08:10:36', 'dibaca', 'ditolak'),
(75, 4, 170, '1755410992', 850512, '2025-08-17 08:11:26', 'dibaca', 'diterima'),
(76, 15, 171, '1755411571', 2450834, '2025-08-17 08:20:08', 'dibaca', 'diterima'),
(77, 15, 175, '1755411911', 1750000, '2025-08-17 20:19:41', 'dibaca', 'diterima'),
(78, 15, 176, '1755458863', 3500, '2025-08-17 21:28:46', 'dibaca', 'ditolak'),
(79, 15, 177, '1755496034', 49000, '2025-08-18 07:47:50', 'dibaca', 'ditolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_mobil`
--

CREATE TABLE `paket_mobil` (
  `id_paket` int(11) NOT NULL,
  `tipe` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `waktu_sewa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `paket_mobil`
--

INSERT INTO `paket_mobil` (`id_paket`, `tipe`, `deskripsi`, `waktu_sewa`) VALUES
(1, 'Avanza G 24 Jam', 'Avanza G hadir dengan kabin luas, AC dingin, dan konsumsi BBM irit, cocok untuk perjalanan keluarga maupun dinas. Dilengkapi audio system dan bagasi lega untuk membawa barang bawaan Anda dengan nyaman. Pesan sekarang untuk perjalanan aman dan nyaman bersama Avanza G', 'Harian, Mingguan, Bulanan'),
(2, 'Avanza All New 24 Jam', 'Avanza All New hadir dengan desain modern, kabin lebih luas, serta suspensi nyaman untuk perjalanan jauh. Dilengkapi fitur keselamatan dan konsumsi BBM tetap irit, cocok untuk perjalanan keluarga maupun bisnis Anda. Sewa sekarang dan rasakan kenyamanan berkendara bersama Avanza All New', 'Harian, Mingguan, Bulanan'),
(3, 'Innova Reborn', 'Innova Reborn hadir dengan kabin luas dan nyaman, tersedia paket 12 Jam, Harian, Mingguan, dan Bulanan.', 'Harian, Mingguan, Bulanan'),
(5, 'Honda BR-V dan Mobilio', 'Honda BR-V hadir dengan desain sporty dan ground clearance tinggi untuk semua medan, sementara Mobilio menawarkan konsumsi BBM irit dengan kabin lega. Keduanya cocok untuk perjalanan keluarga, dinas, dan liburan dengan kenyamanan maksimal. Pesan sekarang dan nikmati perjalanan aman dan nyaman bersama Honda BR-V dan Mobilio', 'Harian, Mingguan, Bulanan'),
(6, 'Matic', 'Nikmati kemudahan berkendara tanpa repot oper gigi dengan pilihan mobil matic dari THO-KING. Cocok untuk perjalanan dalam kota maupun luar kota dengan kenyamanan maksimal, irit BBM, dan handling ringan untuk Anda yang ingin berkendara santai tanpa lelah. Pesan mobil matic sekarang untuk perjalanan praktis dan nyaman bersama keluarga maupun bisnis Anda', 'Harian, Mingguan, Bulanan'),
(7, 'Manual', 'Pilihan mobil manual dari THO-KING cocok untuk Anda yang menginginkan kontrol penuh dan performa stabil di berbagai kondisi jalan. Konsumsi BBM lebih hemat, perawatan mudah, dan cocok untuk perjalanan dinas, wisata luar kota, maupun aktivitas harian Anda. Pesan mobil manual sekarang untuk perjalanan yang tangguh, irit, dan nyaman bersama THO-KING', 'Harian, Mingguan, Bulanan'),
(8, 'Mobil Pengantin', 'THO-KING menyediakan mobil pengantin dengan tampilan bersih dan elegan untuk mempercantik momen pernikahan Anda. Dilengkapi pengemudi profesional, AC dingin, dan kabin nyaman untuk perjalanan menuju lokasi akad maupun resepsi. Tersedia dekorasi sesuai permintaan untuk menambah kesan mewah di hari bahagia Anda. Pesan sekarang dan rayakan hari spesial Anda bersama THO-KING dengan penuh kenyamanan dan keindahan', 'pengantin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `nama_rekening` varchar(255) NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `nominal` int(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `virtual_account` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_booking`, `no_rekening`, `nama_rekening`, `bukti_bayar`, `nominal`, `tanggal`, `status`, `virtual_account`) VALUES
(11, 15, '11223344', 'Leonel Sariwating', NULL, 0, '2025-07-08', 'Pending', NULL),
(12, 17, '11223344', 'jessy', NULL, 850509, '2025-07-10', 'Pending', NULL),
(13, 19, '11223344', 'Marthen', NULL, 700634, '2025-07-15', 'Pending', NULL),
(14, 24, '1234567890', 'Marthen', 'bukti_1752594924.jpg', 0, '', 'Pending', NULL),
(15, 25, '130703', 'Geiny Wattimena', 'bukti_1752598226.jpg', 0, '', 'Pending', NULL),
(16, 26, '22012005', 'Zindy Wattimena', 'bukti_1752598979.png', 0, '', 'Pending', NULL),
(17, 27, '2147483647', 'Marthen', 'bukti_1752643160.png', 0, '', 'Pending', NULL),
(18, 28, '77889933', 'melkichan', 'bukti_1752654235.png', 0, '', 'Validasi', NULL),
(19, 29, '66779900', 'Zindy Wattimena', 'bukti_1752657584.png', 0, '', 'Validasi', NULL),
(20, 30, '899900', 'reinzy', 'bukti_1752669074.png', 0, '', 'Validasi', NULL),
(21, 31, '899900', 'reinzy', 'bukti_1752683402.png', 0, '', 'Pending', NULL),
(22, 32, '123456', 'Marthen', 'bukti_1752732448.png', 0, '', 'Pending', NULL),
(23, 33, '273623633', 'jessy keiluhu', 'bukti_1752763911.png', 0, '', 'Validasi', NULL),
(24, 34, '11223344', 'Marthen', 'bukti_1752771829.png', 0, '', 'Validasi', NULL),
(25, 36, '11223344', 'Marthen', 'bukti_1752819663.png', 0, '', 'Pending', NULL),
(26, 37, '4545454', 'Geiny Wattimena', 'bukti_1752836430.png', 0, '', 'Pending', NULL),
(27, 38, '4545454', 'Zindy Wattimena', 'bukti_1752884903.png', 0, '', 'Validasi', NULL),
(28, 39, '12345677', 'Marthen', 'bukti_1752892538.png', 0, '', 'Pending', NULL),
(29, 45, '11223344', 'test', 'bukti_1753429140.png', 0, '', 'Pending', NULL),
(30, 62, 'BNI 21228890', 'jessy keiluhu', 'bukti_1753449822.png', 0, '', 'Pending', NULL),
(31, 63, 'BRI 644646466466', 'jessy keiluhu', 'bukti_1753451330.png', 0, '', 'Pending', NULL),
(32, 64, 'BRI 1119929299292', 'jessy keiluhu', 'bukti_1753452981.png', 0, '', 'Pending', NULL),
(33, 65, 'BRI 7747494949', 'jessy keiluhu', 'bukti_1753453123.png', 0, '', 'Pending', NULL),
(34, 66, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1753770774.png', 0, '', 'Pending', NULL),
(35, 67, 'BRI 217272728', 'Marthen', 'bukti_1754634540.png', 0, '', 'Pending', NULL),
(36, 68, 'BNI 21228890', 'jessy keiluhu', 'bukti_1754635279.png', 0, '', 'Pending', NULL),
(37, 69, 'BNI 21228890', 'Leonel Sariwating', 'bukti_1754636248.png', 0, '', 'Pending', NULL),
(38, 70, 'BNI 21228890', 'jessy keiluhu', 'bukti_1754670009.png', 0, '', 'Pending', NULL),
(39, 71, 'BRI 217272728', 'Marthen', 'bukti_1754673348.png', 0, '', 'Pending', NULL),
(40, 71, 'BRI 217272728', 'Marthen', 'bukti_1754673403.png', 0, '', 'Pending', NULL),
(41, 102, 'BRI 217272728', 'Marthen', 'bukti_1754814553.png', 0, '', 'Pending', NULL),
(42, 103, 'BNI 21228890', 'jessy keiluhu', 'bukti_1754814962.png', 0, '', 'Pending', NULL),
(43, 104, 'BRI 217272728', 'Marthen', 'bukti_1754816514.png', 0, '', 'Pending', NULL),
(44, 105, '11223344', 'Marthen', 'bukti_1754817471.png', 0, '', 'Pending', NULL),
(45, 106, '11223344', 'Marthen', 'bukti_1754818205.png', 0, '', 'Pending', NULL),
(46, 107, '11223344', 'Marthen', 'bukti_1754821997.png', 0, '', 'Pending', NULL),
(47, 114, 'BRI 217272728', 'Marthen', 'bukti_1754891520.png', 0, '', 'Pending', NULL),
(48, 116, 'BRI 217272728', 'adrian asikin', 'bukti_1754894137.jpg', 0, '', 'Pending', NULL),
(49, 121, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1754925256.png', 0, '', 'Pending', NULL),
(50, 131, '8888888', 'Geiny Wattimena', 'bukti_1754980076.png', 900993, '2025-08-12 14:27:56', 'Pending', NULL),
(51, 132, '1119929299292', 'Geiny Wattimena', 'bukti_1754980319.png', 1050420, '2025-08-12 14:31:59', 'Pending', NULL),
(52, 133, '8888888', 'tes dlo', 'bukti_1754980553.png', 2450409, '2025-08-12 14:35:53', 'Pending', NULL),
(53, 134, '1111111', 'yopi', 'bukti_1754982307.png', 4900701, '2025-08-12 15:05:07', 'Pending', NULL),
(54, 135, '8888888', 'yopi', 'bukti_1754982572.png', 4550943, '2025-08-12 15:09:32', 'Pending', NULL),
(55, 136, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755000272.jpg', 1200944, '2025-08-12 20:04:32', 'Pending', NULL),
(56, 144, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755007490.png', 0, '', 'Pending', 'VA1441359'),
(57, 145, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755007670.png', 0, '', 'Pending', 'VA1452778'),
(58, 146, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755015100.png', 0, '', 'Pending', 'VA1469082'),
(59, 147, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755051448.png', 0, '', 'Pending', 'VA1478112'),
(60, 148, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755051472.png', 0, '', 'Pending', 'VA1482336'),
(61, 150, 'BNI 21228890', 'Geiny Wattimena', 'bukti_1755091335.png', 0, '', 'Pending', 'VA1504559'),
(62, 153, 'BNI 21228890', 'jessy keiluhu', 'bukti_1755092516.png', 0, '', 'Pending', 'VA1537591'),
(63, 154, 'BNI 21228890', 'Geiny Wattimena', 'bukti_1755092563.png', 0, '', 'Pending', 'VA1542337'),
(64, 155, 'BRI 1119929299292', 'jessy keiluhu', 'bukti_1755093164.png', 0, '', 'Pending', 'VA1550360'),
(65, 156, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755094052.png', 0, '', 'Pending', 'VA1567691'),
(66, 157, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755163132.png', 0, '', 'Pending', 'VA1574607'),
(67, 158, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755163567.png', 0, '', 'Pending', 'VA1589027'),
(68, 159, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755164218.png', 0, '', 'Pending', 'VA1595429'),
(69, 160, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755164553.png', 0, '', 'Pending', 'VA1608999'),
(70, 166, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755238949.png', 0, '', 'Pending', 'VA1665350'),
(71, 167, 'BRI 217272728', 'Geiny Wattimena', 'bukti_1755239148.png', 0, '', 'Pending', 'VA1671253'),
(72, 169, 'BNI 21228890', 'Geiny Wattimena', 'bukti_1755331585.png', 0, '', 'Pending', 'VA1694602'),
(73, 170, 'BNI 21228890', 'Geiny Wattimena', 'bukti_1755411007.png', 0, '', 'Pending', 'VA1707105'),
(74, 171, 'BRI 1119929299292', 'Marthen', 'bukti_1755411589.png', 0, '', 'Pending', 'VA1713539'),
(75, 175, 'BNI 21228890', 'Marthen', 'bukti_1755411982.png', 0, '', 'Pending', 'VA1753447'),
(76, 176, 'BNI 21228890', 'Leonel Sariwating', 'bukti_1755458885.png', 0, '', 'Pending', 'VA1766536'),
(77, 177, 'BRI 1119929299292', 'Geiny Wattimena', 'bukti_1755496053.png', 0, '', 'Pending', 'VA1775659');

--
-- Trigger `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `pembayaran_before_insert` BEFORE INSERT ON `pembayaran` FOR EACH ROW BEGIN
    IF NEW.virtual_account IS NULL OR NEW.virtual_account = '' THEN
        SET NEW.virtual_account = CONCAT('VA', NEW.id_booking, LPAD(FLOOR(RAND() * 10000), 4, '0'));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `id_login` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rating`
--

INSERT INTO `rating` (`id`, `id_login`, `nama`, `komentar`, `rating`, `created_at`) VALUES
(1, NULL, 'Geiny Wattimena', 'bagus', 5, '2025-07-18 20:11:01'),
(2, NULL, 'jessy', 'mantap', 5, '2025-07-18 20:21:47'),
(3, NULL, 'dini', 'mantap', 4, '2025-07-18 20:28:22'),
(4, NULL, 'margo', 'keren', 5, '2025-07-18 20:33:42'),
(5, NULL, 'zindy', 'lebih baik lagi', 5, '2025-07-18 20:35:04'),
(6, NULL, 'christ', 'ya', 5, '2025-07-18 20:38:01'),
(7, NULL, 'christ', 'ya', 5, '2025-07-18 20:38:11'),
(8, NULL, 'christ', 'ya', 4, '2025-07-18 20:38:25'),
(9, NULL, 'endiko', 'bagus', 5, '2025-07-18 20:40:05'),
(10, NULL, 'barca', 'viscaaa', 5, '2025-07-18 20:54:06'),
(11, NULL, 'jessy', 'toppp', 5, '2025-07-18 21:05:04'),
(12, NULL, 'necha', 'kembangkan', 5, '2025-07-18 21:29:22'),
(13, NULL, 'wilhelmina', 'tingkatkan lagi sistemnya', 5, '2025-07-26 00:01:27'),
(14, 11, 'Leonel Sariwating', 'THO-KING TOP', 5, '2025-07-26 12:17:03'),
(15, 6, 'reinzy', 'Graciasss!!!!', 5, '2025-07-26 12:33:20'),
(16, 8, 'Giselle Thenu', '.', 5, '2025-07-26 12:34:54'),
(17, 5, 'jessy keiluhu', 'baik', 5, '2025-08-08 15:47:36'),
(18, 15, 'Marthen', 'baik', 5, '2025-08-08 22:30:05'),
(19, 23, 'adrian asikin', 'Manyala Batulll', 5, '2025-08-11 15:10:50'),
(20, 24, 'casper', 'bagusss', 5, '2025-08-18 15:05:05'),
(21, 13, 'Necha Wattimena', 'THO-KING terbaik', 4, '2025-08-18 15:12:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `idx_booking_id` (`id_booking`),
  ADD KEY `fk_booking_mobil` (`id_mobil`);

--
-- Indeks untuk tabel `infoweb`
--
ALTER TABLE `infoweb`
  ADD KEY `fk_infoweb_login` (`id_login`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `idx_mobil_id` (`id_mobil`),
  ADD KEY `fk_mobil_paket` (`id_paket`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_login` (`id_login`),
  ADD KEY `id_booking` (`id_booking`);

--
-- Indeks untuk tabel `paket_mobil`
--
ALTER TABLE `paket_mobil`
  ADD PRIMARY KEY (`id_paket`),
  ADD UNIQUE KEY `tipe` (`tipe`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `idx_pembayaran_id` (`id_pembayaran`),
  ADD KEY `fk_pembayaran_booking` (`id_booking`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rating_login` (`id_login`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `paket_mobil`
--
ALTER TABLE `paket_mobil`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_mobil` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `infoweb`
--
ALTER TABLE `infoweb`
  ADD CONSTRAINT `fk_infoweb_login` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `fk_mobil_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket_mobil` (`id_paket`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`),
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_booking` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_login` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
