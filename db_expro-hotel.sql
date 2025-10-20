USE db_expro_hotel;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `admin_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(255) NOT NULL,
  `fullname` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `db_password` VARCHAR(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admins` (`admin_id`, `username`, `fullname`, `password`, `db_password`) VALUES
(10001, 'root', 'localhost root', 'admin123$#', 'DyCsIlAe'),
(10013, 'madyan', 'Madyan Arashy', 'pass', 'DyCsIlAe'),
(10017, 'Josh', 'Joshua Redwood', 'joshpass', 'DyCsIlAe');

DROP TABLE IF EXISTS `aktivitas`;
CREATE TABLE `aktivitas` (
  `aktivitas_id` INT AUTO_INCREMENT PRIMARY KEY,
  `admin_username` VARCHAR(255) NOT NULL,
  `admin_fullname` VARCHAR(255) NOT NULL,
  `perubahan` TEXT NOT NULL,
  `waktu` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `aktivitas` (`aktivitas_id`, `admin_username`, `admin_fullname`, `perubahan`, `waktu`) VALUES
(11, 'root', 'localhost root', '<span class="text-info">Mengubah</span> data [Admin] "Dani"', '2024-06-04 11:33:08'),
(12, 'root', 'localhost root', '<span class="text-danger">Menghapus</span> data [Admin] "Dani"', '2024-06-04 11:35:27'),
(13, 'root', 'localhost root', '<span class="text-danger">Menghapus</span> data [Admin] "Dandan"', '2024-06-04 11:35:39'),
(14, 'root', 'localhost root', '<span class="text-success">Menambahkan</span> data [Admin] "Josh"', '2024-06-04 11:35:58'),
(15, 'root', 'localhost root', '<span class="text-success">Menambahkan</span> data [Jenis Kamar] "Value Room"', '2024-06-04 11:36:46');

DROP TABLE IF EXISTS `jenis_kamar`;
CREATE TABLE `jenis_kamar` (
  `kamar_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
  `jenis_kamar` VARCHAR(255) NOT NULL,
  `harga` INT NOT NULL,
  `keterangan` TEXT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `halaman_id` VARCHAR(5) NOT NULL,
  `popularitas` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jenis_kamar` (`kamar_id`, `jenis_kamar`, `harga`, `keterangan`, `image`, `halaman_id`, `popularitas`) VALUES
(6, 'Standard Room', 800000, 'Kamar standar kami memiliki fasilitas mengagumkan...', 'hotel-1.jpg', 'YaKf2', 8),
(7, 'Superior Room', 1500000, 'Kamar Superior kami akan membuat Anda merasa sangat istimewa...', 'hotel-2.jpg', '9nMrt', 6),
(8, 'Deluxe Room', 1800000, 'Kamar deluxe kami akan membuat Anda merasa seperti raja...', 'hotel-3.jpg', 'hG5KL', 4);

DROP TABLE IF EXISTS `pesan`;
CREATE TABLE `pesan` (
  `nama` VARCHAR(255) NOT NULL,
  `no_hp` VARCHAR(16) NOT NULL,
  `pesan` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pesan` (`nama`, `no_hp`, `pesan`) VALUES
('Madyan Arashy', '0587956678967', 'Apakah Anda bisa tolong saya? Sepertinya toilet saya mampet. Saya di ruangan 667.');

DROP TABLE IF EXISTS `reservasi_kamar`;
CREATE TABLE `reservasi_kamar` (
  `reservasi_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
  `kamar_id` INT NOT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `cekin` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cekout` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no_identitas` VARCHAR(13) NOT NULL,
  `no_hp` VARCHAR(16) NOT NULL,
  `jumlah_kamar` INT NOT NULL,
  `total` VARCHAR(255) NOT NULL,
  `catatan` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `reservasi_kamar` (`reservasi_id`, `kamar_id`, `nama`, `cekin`, `cekout`, `no_identitas`, `no_hp`, `jumlah_kamar`, `total`, `catatan`) VALUES
(5, 6, 'Madyan Arashy', '2024-06-01 00:00:00', '2024-06-08 00:00:00', '5725825825787', '0587956678967', 1, '5600000', 'Halo mimin~ kan ak ini lagi maw travel, jadi tolong kasih kamarnya di lantai rendah ya, thx~');

COMMIT;
