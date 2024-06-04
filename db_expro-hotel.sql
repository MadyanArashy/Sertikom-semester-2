-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 08:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_expro-hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `db_password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `fullname`, `password`, `db_password`) VALUES
(10001, 'root', 'localhost root', 'admin123$#', 'DyCsIlAe'),
(10013, 'madyan', 'Madyan Arashy', 'pass', 'DyCsIlAe'),
(10017, 'Josh', 'Joshua Redwood', 'joshpass', 'DyCsIlAe');

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `aktivitas_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_fullname` varchar(255) NOT NULL,
  `perubahan` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`aktivitas_id`, `admin_username`, `admin_fullname`, `perubahan`, `waktu`) VALUES
(11, 'root', 'localhost root', '<span class=\"text-info\">Mengubah</span> data [Admin] \"Dani\"', '2024-06-04 11:33:08'),
(12, 'root', 'localhost root', '<span class=\"text-danger\">Menghapus</span> data [Admin] \"Dani\"', '2024-06-04 11:35:27'),
(13, 'root', 'localhost root', '<span class=\"text-danger\">Menghapus</span> data [Admin] \"Dandan\"', '2024-06-04 11:35:39'),
(14, 'root', 'localhost root', '<span class=\"text-success\">Menambahkan</span> data [Admin] \"Josh\"', '2024-06-04 11:35:58'),
(15, 'root', 'localhost root', '<span class=\"text-success\">Menambahkan</span> data [Jenis Kamar] \"Value Room\"', '2024-06-04 11:36:46'),
(17, 'root', 'localhost root', '<span class=\"text-info\">Mengubah</span> data [Jenis Kamar] \"Value Room\"', '2024-06-04 11:38:37'),
(18, 'madyan', 'Madyan Arashy', '<span class=\"text-info\">Mengubah</span> data [Admin] \"Josh\"', '2024-06-04 11:39:24'),
(19, 'madyan', 'Madyan Arashy', '<span class=\"text-danger\">Menghapus</span> data [Admin] \"administrator\"', '2024-06-04 11:39:53'),
(20, 'madyan', 'Madyan Arashy', '<span class=\"text-danger\">Menghapus</span> data [Reservasi Kamar] \"Johnny Bravo\"', '2024-06-04 11:40:07'),
(21, 'madyan', 'Madyan Arashy', '<span class=\"text-success\">Menambahkan</span> data [Admin] \"ABC\"', '2024-06-04 11:45:19'),
(22, 'ABC', 'DEF', '<span class=\"text-info\">Mengubah</span> data [Admin] \"madyan\"', '2024-06-04 11:45:52'),
(23, 'madyan', 'Madyan Arashy', '<span class=\"text-danger\">Menghapus</span> data [Admin] \"ABC\"', '2024-06-04 11:46:15'),
(24, 'madyan', 'Madyan Arashy', '<span class=\"text-danger\">Menghapus</span> data [Jenis Kamar] \"Value Room\"', '2024-06-04 11:46:29'),
(25, 'madyan', 'Madyan Arashy', '<span class=\"text-success\">Menambahkan</span> data [Jenis Kamar] \"Kamar\"', '2024-06-04 11:46:48'),
(26, 'madyan', 'Madyan Arashy', '<span class=\"text-success\">Menambahkan</span> data [Jenis Kamar] \"a\"', '2024-06-04 11:48:05'),
(27, 'madyan', 'Madyan Arashy', '<span class=\"text-info\">Mengubah</span> data [Jenis Kamar] \"Kamar\"', '2024-06-04 11:48:16'),
(28, 'madyan', 'Madyan Arashy', '<span class=\"text-danger\">Menghapus</span> data [Jenis Kamar] \"Kamar\"', '2024-06-04 11:48:21'),
(29, 'root', 'localhost root', '<span class=\"text-danger\">Menghapus</span> data [Reservasi Kamar] \"d\"', '2024-06-04 12:11:22'),
(30, 'root', 'localhost root', '<span class=\"text-success\">Menambahkan</span> data [Reservasi Kamar] \"Geee\"', '2024-06-04 13:10:47'),
(31, 'root', 'localhost root', '<span class=\"text-success\">Menambahkan</span> data [Reservasi Kamar] \"Geee\"', '2024-06-04 13:11:37'),
(32, 'root', 'localhost root', '<span class=\"text-danger\">Menghapus</span> data [Reservasi Kamar] \"Geee\"', '2024-06-04 13:13:09'),
(33, 'root', 'localhost root', '<span class=\"text-danger\">Menghapus</span> data [Reservasi Kamar] \"Geee\"', '2024-06-04 13:13:11'),
(34, 'root', 'localhost root', '<span class=\"text-danger\">Menghapus</span> data [Reservasi Kamar] \"Geee\"', '2024-06-04 13:13:14'),
(35, 'madyan', 'Madyan Arashy', '<span class=\"text-danger\">Menghapus</span> data [Jenis Kamar] \"a\"', '2024-06-04 13:25:12'),
(36, 'madyan', 'Madyan Arashy', '<span class=\"text-success\">Menambahkan</span> data [Reservasi Kamar] \"suu\"', '2024-06-04 13:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kamar`
--

CREATE TABLE `jenis_kamar` (
  `kamar_id` int(255) NOT NULL,
  `jenis_kamar` varchar(255) NOT NULL,
  `harga` int(100) NOT NULL,
  `keterangan` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `halaman_id` varchar(5) NOT NULL,
  `popularitas` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_kamar`
--

INSERT INTO `jenis_kamar` (`kamar_id`, `jenis_kamar`, `harga`, `keterangan`, `image`, `halaman_id`, `popularitas`) VALUES
(6, 'Standard Room', 800000, 'Kamar standar kami memiliki fasilitas mengagumkan, seperti tempat tidur empuk, <i>Air Conditioner</i>, TV, perlengkapan mandi mewah, air minum, dan kamar tidur ukuran Queen Size.', 'hotel-1.jpg', 'YaKf2', 8),
(7, 'Superior Room', 1500000, 'Kamar Superior kami akan membuat Anda merasa sangat istimewa, dirancang untuk wisatawan <i>trendi</i> yang menawarkan kenyamanan dan kemudahan dengan suasana modern dan penuh gaya.', 'hotel-2.jpg', '9nMrt', 6),
(8, 'Deluxe Room', 1800000, 'Kamar deluxe kami akan membuat Anda merasa seperti raja dengan ruang tamu yang luas dan kamar tidur berukuran King Size. Dengan fasilitas tercanggih dan dekorasi yang mengkilap, kami menyediakan pengalaman terbaik.', 'hotel-3.jpg', 'hG5KL', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`nama`, `no_hp`, `pesan`) VALUES
('Madyan Arashy', '0587956678967', 'Apakah Anda bisa tolong saya? Sepertinya toilet saya mampet. Saya di ruangan 667.');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi_kamar`
--

CREATE TABLE `reservasi_kamar` (
  `reservasi_id` int(255) NOT NULL,
  `kamar_id` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `cekin` date NOT NULL DEFAULT current_timestamp(),
  `cekout` date NOT NULL DEFAULT current_timestamp(),
  `no_identitas` varchar(13) NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `jumlah_kamar` int(4) NOT NULL,
  `total` varchar(255) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservasi_kamar`
--

INSERT INTO `reservasi_kamar` (`reservasi_id`, `kamar_id`, `nama`, `cekin`, `cekout`, `no_identitas`, `no_hp`, `jumlah_kamar`, `total`, `catatan`) VALUES
(5, 6, 'Madyan Arashy', '2024-06-01', '2024-06-08', '5725825825787', '0587956678967', 1, '5600000', 'Halo mimin~ kan ak ini lagi maw travel, jadi tolong kasih kamarnya di lantai rendah ya, thx~'),
(6, 7, ' Cass Shanon Blue ', '2024-06-10', '2024-06-14', '9614012975612', '5180914054122081', 3, '18000000', ''),
(7, 8, ' Ariel Dallas Avery ', '2024-06-02', '2024-06-03', '3298473392502', '0812485114792412', 2, '3600000', 'Tolong sediakan tempat untuk membawa kursi roda'),
(8, 6, 'Johnny Silverhand', '2025-03-21', '2025-03-25', '0230149853109', '5710597619092438', 2, '6400000', 'We&#039;re gonna burn this city'),
(9, 8, 'Bobby Fischer', '2024-06-24', '2024-06-26', '9853691350791', '1489126407191825', 2, '7200000', 'Tolong berikan kamar yang memiliki pemandangan kota'),
(11, 6, 'Silvia Gundur', '2024-07-22', '2024-07-23', '2539068374523', '5769760986542324', 30, '24000000', 'Selamat siang, Expro Hotel.\r\nKami dari BankAJAX ingin merayakan ulang tahun perusahaan kami, dan akan membuat sebuah perayaan. Kami berharap untuk menggunakan ruangan konferensi Anda. Tolong hubungi nomor telepon yang tertulis untuk permasalahan ini.\r\nSalam hangat, Silvia Gundur.'),
(14, 6, 'Winston Abrams', '2024-08-01', '2024-08-11', '1204869141615', '1240976094507912', 3, '24000000', 'Berikan layanan terbaik kalian...'),
(17, 7, 'Dani Karlson', '2024-07-04', '2024-07-06', '6411174601948', '10476440578140', 2, '6000000', 'berikan kasur yang paling empuk'),
(19, 7, 'Nana Kurumi', '2024-09-01', '2024-09-18', '7809416414890', '392417955091', 1, '25500000', 'Tidak ada'),
(21, 6, 'David Harley', '2024-09-09', '2024-09-15', '7451023801764', '1098126414', 2, '9600000', 'nggak ada'),
(22, 6, 'Marley Austin', '2024-09-09', '2024-09-15', '6721023801212', '249812109', 2, '9600000', 'tidak'),
(23, 6, 'Justin Marvel', '2025-04-07', '2025-06-09', '5710471904814', '148171014102', 1, '50400000', 'Saya ingin menginap lumayan lama'),
(24, 7, 'Charlie Wang', '2024-06-26', '2024-06-29', '7891401549182', '016541683157', 5, '22500000', 'Party'),
(25, 6, 'Aku', '2024-06-19', '2024-06-21', '1089419084717', '1548913467981126', 1, '1600000', 'Halo'),
(26, 8, 'Yugi', '2024-08-01', '2024-08-15', '7681310934622', '08941541325', 5, '126000000', 'a'),
(27, 17, 'ABC', '2024-06-04', '2024-06-06', '1234123412341', '123', 2, '40', 'abc'),
(32, 8, 'CBA', '2024-06-26', '2024-06-27', '9831290836379', '712063718', 1, '1800000', 'abc'),
(37, 7, 'aabcd', '2024-06-06', '2024-06-02', '1084714121321', '01478125489', 3, '18000000', '11'),
(38, 7, 'suu', '2024-06-05', '2024-06-06', '4189361098370', '123123123123', 5, '7500000', 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`aktivitas_id`);

--
-- Indexes for table `jenis_kamar`
--
ALTER TABLE `jenis_kamar`
  ADD PRIMARY KEY (`kamar_id`);

--
-- Indexes for table `reservasi_kamar`
--
ALTER TABLE `reservasi_kamar`
  ADD PRIMARY KEY (`reservasi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10019;

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `aktivitas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `jenis_kamar`
--
ALTER TABLE `jenis_kamar`
  MODIFY `kamar_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reservasi_kamar`
--
ALTER TABLE `reservasi_kamar`
  MODIFY `reservasi_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
