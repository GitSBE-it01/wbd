-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 01:09 AM
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
-- Database: `formsparepart`
--

-- --------------------------------------------------------

--
-- Table structure for table `datapeminta`
--

CREATE TABLE `datapeminta` (
  `id` int(11) NOT NULL,
  `nama_peminta` varchar(100) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `account_code` int(11) NOT NULL,
  `keperluan` varchar(250) NOT NULL,
  `cost_center` varchar(100) NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `verifikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datapeminta`
--

INSERT INTO `datapeminta` (`id`, `nama_peminta`, `departemen`, `tanggal_awal`, `nama_barang`, `account_code`, `keperluan`, `cost_center`, `tanggal_akhir`, `verifikasi`) VALUES
(1, 'Alfons', 'IT', '2023-11-08', 'Testing', 1111, 'Test', '3112', '2023-11-10', 1),
(2, 'Justin', 'Business Intel', '2023-11-09', 'Isolasi', 231, 'Stok habis', '2221', '2023-11-17', 0),
(3, 'Jonathan', 'RnD', '2023-11-10', 'Laser', 1111, 'Keperluan developing barang', '3112', '2023-11-18', 0),
(4, 'Sam', 'IT', '2023-11-09', 'Kipas', 233, 'Panass', '211', '2023-11-15', 2),
(5, 'Linda', 'HRD', '2023-11-13', 'Komputer', 233, 'pribadi', '1112', '2023-11-17', 0),
(6, 'Eric', 'RnD', '2023-11-16', 'Moulding', 233, 'Alat lama rusak', '2221', '2023-11-23', 0),
(7, 'Elfira', 'Accounting', '2023-11-09', 'Map', 1111, 'Banyak file baru', '111', '2023-11-10', 0),
(8, 'Theo', 'Purchasing', '2023-11-08', 'Forklift', 233, 'Packing', '1112', '2023-11-09', 0),
(9, 'Jovan', 'QA', '2023-11-16', 'Meteran', 233, 'Alat sebelumnya rusak', '3112', '2023-11-17', 1),
(10, 'Ivan', 'HRD', '2023-11-10', 'Map', 233, 'pribadi', '3112', '2023-11-12', 0),
(11, 'Thomas', 'Marketing', '2023-11-07', 'Flyer', 233, 'Keperluan marketing', '1234', '2023-11-10', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datapeminta`
--
ALTER TABLE `datapeminta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datapeminta`
--
ALTER TABLE `datapeminta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
