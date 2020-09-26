-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2020 at 12:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dumbways`
--

-- --------------------------------------------------------

--
-- Table structure for table `importir_tb`
--

CREATE TABLE `importir_tb` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `importir_tb`
--

INSERT INTO `importir_tb` (`id`, `name`, `address`, `phone`) VALUES
(1, 'PT.DumbWays', 'Jln. Jenderal Sentosa No. 32', '08277000111'),
(2, 'PT.Github', 'Jln. Silicon Valley No. 666', '08277000222'),
(6, 'PT. Indonesia Sejahtera Raya', 'Jln. Raya Karangnunggal No. 22', '08933211191'),
(7, 'CV. The Impostor', 'Electrical No. 7', '08922122210'),
(8, 'PT. Emergency Meeting', 'Roadway to Cafetaria No. 8', '082123556777');

-- --------------------------------------------------------

--
-- Table structure for table `produk_tb`
--

CREATE TABLE `produk_tb` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `importir_id` int(11) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_tb`
--

INSERT INTO `produk_tb` (`id`, `name`, `importir_id`, `Photo`, `qty`, `price`) VALUES
(1, 'Specialized', 1, 'specialized.jpg', 5, '11000000.00'),
(2, 'Trek45', 1, '5f6ee37c50f69.jpg', 12, '14000000.00'),
(3, 'Pinarello', 6, 'pinarello.jpg', 20, '30000000.00'),
(4, 'Cervelo', 6, 'cervelo.jpg', 90, '12000000.00'),
(5, 'Diamondback', 2, 'diamondback.jpg', 19, '19000000.00'),
(9, 'Wimcycle', 8, '5f6f15b120c00.jpg', 65, '9000000.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `importir_tb`
--
ALTER TABLE `importir_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_tb`
--
ALTER TABLE `produk_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_importir_id` (`importir_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `importir_tb`
--
ALTER TABLE `importir_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk_tb`
--
ALTER TABLE `produk_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk_tb`
--
ALTER TABLE `produk_tb`
  ADD CONSTRAINT `fk_importir_id` FOREIGN KEY (`importir_id`) REFERENCES `importir_tb` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_tb_ibfk_1` FOREIGN KEY (`importir_id`) REFERENCES `importir_tb` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
