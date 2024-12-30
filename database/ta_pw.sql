-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2024 at 11:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_pw`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `editMeja` (IN `p_id` INT(11), IN `p_noMeja` INT(11), IN `p_status` ENUM('ready','cleaning','used'))   BEGIN	

UPDATE meja SET meja.no_meja = p_noMeja, meja.status = p_status WHERE meja.id = p_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editPetugas` (IN `p_id` INT(11), IN `p_username` VARCHAR(255), IN `p_namaPetugas` VARCHAR(255), IN `p_level` ENUM('admin','petugas'), IN `p_password` VARCHAR(255))   BEGIN

UPDATE admin SET admin.username = p_username, admin.nama_petugas = p_namaPetugas,
admin.level = p_level, admin.password = p_password WHERE admin.id = p_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getLoginPetugas` (IN `p_username` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN

SELECT * FROM admin
WHERE admin.username = p_username
AND admin.password = p_password;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getMeja` ()   BEGIN

SELECT*FROM meja;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getMejaId` (IN `p_id` INT(11))   BEGIN	

SELECT*FROM	meja WHERE id = p_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getMenuId` (IN `p_id` INT(11))   BEGIN

SELECT * FROM menu WHERE id = p_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPesananId` (IN `p_id` INT)   BEGIN

SELECT*FROM pesanan WHERE id=p_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPetugas` ()   BEGIN

SELECT*FROM admin;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPetugasId` (IN `p_id` INT(11))   BEGIN

SELECT*FROM admin WHERE admin.id = p_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusMeja` (IN `p_id` INT(11))   BEGIN

DELETE FROM meja WHERE id = p_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusMenu` (IN `p_id` INT(11))   BEGIN
   DELETE FROM menu WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusPetugas` (IN `p_id` INT(11))   BEGIN

DELETE FROM admin WHERE admin.id = p_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahMeja` (IN `p_noMeja` INT(11), IN `p_status` ENUM('ready','cleaning','used'))   BEGIN

INSERT INTO meja (meja.no_meja, meja.status) VALUES (p_noMeja,p_status); 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahPetugas` (IN `p_username` VARCHAR(255), IN `p_namaPetugas` VARCHAR(255), IN `p_level` ENUM('admin','petugas'), IN `p_password` VARCHAR(255))   BEGIN

INSERT INTO admin(admin.username, admin.nama_petugas, admin.level, admin.password)
VALUES (p_username, p_namaPetugas, p_level, p_password);

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_petugas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `level` enum('admin','petugas') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `nama_petugas`, `level`, `password`) VALUES
(1, 'admin', 'sayaAdmin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'petugas', 'sayaPetugas', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c');

-- --------------------------------------------------------

--
-- Table structure for table `detall_pesanan`
--

CREATE TABLE `detall_pesanan` (
  `id` int NOT NULL,
  `ID_Pesanan` int DEFAULT NULL,
  `ID_Menu` int DEFAULT NULL,
  `kuantitas` int DEFAULT NULL,
  `hrg_peritem` int DEFAULT NULL,
  `subtil_item` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id` int NOT NULL,
  `no_meja` int NOT NULL,
  `status` enum('ready','cleaning','used') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id`, `no_meja`, `status`) VALUES
(1, 1, 'cleaning'),
(2, 2, 'cleaning'),
(5, 3, 'ready'),
(6, 4, 'ready'),
(7, 5, 'ready'),
(8, 6, 'cleaning'),
(9, 7, 'ready'),
(10, 8, 'ready');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `gambar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kategori` enum('Makanan','Minuman') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `gambar`, `nama`, `kategori`, `harga`) VALUES
(6, 'fried-chicken.png', 'Ayam Kremes', 'Makanan', 15000),
(8, 'rice-bowl.png', 'Nasi', 'Makanan', 4000),
(9, 'bbq-grill.png', 'Ayam BBQ', 'Makanan', 20000),
(11, 'orange-juice.png', 'Jus Jeruk', 'Minuman', 5000),
(13, 'juice.png', 'Jus Mangga', 'Minuman', 8000),
(14, 'watermelon-smoothie.png', 'Jus Semangka', 'Makanan', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `id_mtrns` int DEFAULT NULL,
  `nama_pign` varchar(255) DEFAULT NULL,
  `pesanan` varchar(255) DEFAULT NULL,
  `metode` varchar(255) DEFAULT NULL,
  `total` int DEFAULT NULL,
  `status_byr` enum('Sudah dibayar','Belum dibayar') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int NOT NULL,
  `id_pesanUser` int DEFAULT NULL,
  `tgl_pesan` datetime DEFAULT NULL,
  `uangBayar` int NOT NULL,
  `kembalian` int DEFAULT NULL,
  `metodeBayar` enum('qris','cash') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status_bayar` enum('Paid','Unpaid') NOT NULL,
  `noMeja` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_pesanUser`, `tgl_pesan`, `uangBayar`, `kembalian`, `metodeBayar`, `status_bayar`, `noMeja`) VALUES
(1, 1, '2024-12-24 21:55:05', 50000, 30000, 'cash', 'Paid', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pesananuser`
--

CREATE TABLE `pesananuser` (
  `id` int NOT NULL,
  `id_menu` int DEFAULT NULL,
  `id_meja` int NOT NULL,
  `pembayaran` enum('qris','cash') NOT NULL,
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesananuser`
--

INSERT INTO `pesananuser` (`id`, `id_menu`, `id_meja`, `pembayaran`, `total`) VALUES
(1, 9, 5, 'cash', 20000);

--
-- Triggers `pesananuser`
--
DELIMITER $$
CREATE TRIGGER `totalpembayaran` AFTER INSERT ON `pesananuser` FOR EACH ROW BEGIN
    DECLARE grand_total INT;
    
    SELECT total 
    INTO grand_total
    FROM pesananuser 
    WHERE id = NEW.id;
    
    UPDATE pesanan
    SET grand_total = total
    WHERE id = NEW.id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detall_pesanan`
--
ALTER TABLE `detall_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Pesanan` (`ID_Pesanan`),
  ADD KEY `ID_Menu` (`ID_Menu`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Menu` (`id_pesanUser`);

--
-- Indexes for table `pesananuser`
--
ALTER TABLE `pesananuser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `total` (`total`),
  ADD UNIQUE KEY `id_menu` (`id_menu`,`id_meja`),
  ADD KEY `id_meja` (`id_meja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detall_pesanan`
--
ALTER TABLE `detall_pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesananuser`
--
ALTER TABLE `pesananuser`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detall_pesanan`
--
ALTER TABLE `detall_pesanan`
  ADD CONSTRAINT `detall_pesanan_ibfk_1` FOREIGN KEY (`ID_Pesanan`) REFERENCES `pesanan` (`id`),
  ADD CONSTRAINT `detall_pesanan_ibfk_2` FOREIGN KEY (`ID_Menu`) REFERENCES `menu` (`id`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pesanUser`) REFERENCES `pesananuser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesananuser`
--
ALTER TABLE `pesananuser`
  ADD CONSTRAINT `pesananuser_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesananuser_ibfk_2` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
