-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2025 at 01:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ritel`
--

-- --------------------------------------------------------

--
-- Table structure for table `brngkeluar`
--

CREATE TABLE `brngkeluar` (
  `id_keluar` int(30) NOT NULL,
  `id_brng_keluar` int(30) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nm_brng` varchar(30) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `penerima` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brngkeluar`
--

INSERT INTO `brngkeluar` (`id_keluar`, `id_brng_keluar`, `tgl`, `nm_brng`, `qty`, `penerima`) VALUES
(1, 1, '2025-09-04 10:49:00', 'milk', '5', '-');

-- --------------------------------------------------------

--
-- Table structure for table `brngmasuk`
--

CREATE TABLE `brngmasuk` (
  `id_masuk` int(30) NOT NULL,
  `id_brng_masuk` int(30) NOT NULL,
  `nm_brng` varchar(20) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ket` varchar(30) NOT NULL,
  `qty` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(20) NOT NULL,
  `nama_instansi` varchar(50) NOT NULL,
  `alamat_instansi` varchar(30) NOT NULL,
  `background` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `nama_instansi`, `alamat_instansi`, `background`) VALUES
(1, 'Toko Ritel', 'Jawa Timur', 'images/background.png');

-- --------------------------------------------------------

--
-- Table structure for table `stokbrng`
--

CREATE TABLE `stokbrng` (
  `id_brng` int(20) NOT NULL,
  `nm_brng` varchar(25) NOT NULL,
  `deskripsi` varchar(30) NOT NULL,
  `stock` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stokbrng`
--

INSERT INTO `stokbrng` (`id_brng`, `nm_brng`, `deskripsi`, `stock`) VALUES
(1, 'milk', '-', 12),
(2, 'wafer', '-', 1),
(3, 'kursi', '-', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `fullnama` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullnama`, `username`, `password`, `role`) VALUES
(1, 'administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'dia', '001', 'dc5c7986daef50c1e02ab09b442ee34f', ''),
(3, 'rudi', '003', 'bb97e651ac096eeb14d099758690c851', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brngkeluar`
--
ALTER TABLE `brngkeluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_brng_keluar` (`id_brng_keluar`);

--
-- Indexes for table `brngmasuk`
--
ALTER TABLE `brngmasuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_brng_masuk` (`id_brng_masuk`),
  ADD KEY `id_masuk` (`id_masuk`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stokbrng`
--
ALTER TABLE `stokbrng`
  ADD PRIMARY KEY (`id_brng`),
  ADD KEY `id_brng` (`id_brng`),
  ADD KEY `nm_brng` (`nm_brng`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brngkeluar`
--
ALTER TABLE `brngkeluar`
  MODIFY `id_keluar` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brngmasuk`
--
ALTER TABLE `brngmasuk`
  MODIFY `id_masuk` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stokbrng`
--
ALTER TABLE `stokbrng`
  MODIFY `id_brng` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brngkeluar`
--
ALTER TABLE `brngkeluar`
  ADD CONSTRAINT `brngkeluar_ibfk_1` FOREIGN KEY (`id_brng_keluar`) REFERENCES `stokbrng` (`id_brng`) ON UPDATE CASCADE;

--
-- Constraints for table `brngmasuk`
--
ALTER TABLE `brngmasuk`
  ADD CONSTRAINT `brngmasuk_ibfk_1` FOREIGN KEY (`id_masuk`) REFERENCES `stokbrng` (`id_brng`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
