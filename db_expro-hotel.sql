-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 03:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(10002, 'administrator', 'admin bro', 'p4ssw0rd', 'DyCsIlAe'),
(10013, 'madyan', 'Madyan Arashy', 'password', 'DyCsIlAe'),
(10014, 'root', 'my name is groot', 'iamgroot', 'DyCsIlAe');

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
(6, 'Standard Room', 800000, 'Kamar standar kami memiliki fasilitas mengagumkan, seperti tempat tidur empuk, <i>Air Conditioner</i>, TV, perlengkapan mandi mewah, air minum, dan kamar tidur ukuran Queen Size.', 'hotel-1.jpg', 'YaKf2', 5),
(7, 'Superior Room', 1500000, 'Kamar Superior kami akan membuat Anda merasa sangat istimewa, dirancang untuk wisatawan <i>trendi</i> yang menawarkan kenyamanan dan kemudahan dengan suasana modern dan penuh gaya.', 'hotel-2.jpg', '9nMrt', 2),
(8, 'Deluxe Room', 1800000, 'Kamar deluxe kami akan membuat Anda merasa seperti raja dengan ruang tamu yang luas dan kamar tidur berukuran King Size. Dengan fasilitas tercanggih dan dekorasi yang mengkilap, kami menyediakan pengalaman terbaik.', 'hotel-3.jpg', 'hG5KL', 4),
(10, 'Water Resort Room', 2100000, 'Water Resort Room semi-terpisah adalah akomodasi terbaik kami di Expro Hotel dalam kenyamanan dan keseruan. Vila Air yang megah ini cerah, luas, dan ditata dengan mewah.', 'hotel-6.jpg', 'w229q', 0);

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
(10, 7, 'Muhammad Hassan Yogi', '2024-07-03', '2024-07-06', '8356079540781', '1409618597813540', 1, '4500000', ''),
(11, 6, 'Silvia Gundur', '2024-07-22', '2024-07-23', '2539068374523', '5769760986542324', 30, '12000000', 'Selamat siang, Expro Hotel.\r\nKami dari BankAJAX ingin merayakan ulang tahun perusahaan kami, dan akan membuat sebuah perayaan. Kami berharap untuk menggunakan ruangan konferensi Anda. Tolong hubungi nomor telepon yang tertulis untuk permasalahan ini.\r\nSalam hangat, Silvia Gundur.'),
(12, 8, 'Gajah Mada', '2024-06-27', '2024-06-29', '7814501478914', '1946047912590121', 1, '3600000', ''),
(13, 8, 'Vergil', '2024-06-26', '2024-06-29', '0714162148921', '5912254782415482', 2, '10800000', 'Saya tidak akan mentoleransikan layanan yang kurang dari sempurna.'),
(14, 6, 'Winston Abrams', '2024-08-01', '2024-08-11', '1204869141615', '1240976094507912', 3, '24000000', 'Berikan layanan terbaik kalian...'),
(15, 6, 'Madyan Arashy', '2024-07-18', '2024-07-21', '1234567891011', '089650098411', 1, '2400000', 'mwah 😘');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

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
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10015;

--
-- AUTO_INCREMENT for table `jenis_kamar`
--
ALTER TABLE `jenis_kamar`
  MODIFY `kamar_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservasi_kamar`
--
ALTER TABLE `reservasi_kamar`
  MODIFY `reservasi_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
