-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2023 at 10:47 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `benuanta`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_kategori`
--

CREATE TABLE `master_kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_kategori`
--

INSERT INTO `master_kategori` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Operasional', 1, NULL, NULL),
(2, 'Pendidikan', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_partai`
--

CREATE TABLE `master_partai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_partai`
--

INSERT INTO `master_partai` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Partai GL', 1, NULL, NULL),
(2, 'Partai GR', 1, NULL, NULL),
(3, 'Partai HN', 1, NULL, NULL),
(4, 'Partai NS', 1, NULL, NULL),
(5, 'Partai PD', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_store`
--

CREATE TABLE `master_store` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_store`
--

INSERT INTO `master_store` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Lotus Panaya', 1, NULL, NULL),
(2, 'Simpang Raya', 1, NULL, NULL),
(3, 'Pelangi Digital', 1, NULL, NULL),
(4, 'Grand Pangeran', 1, NULL, NULL),
(5, 'CV Budaya', 1, NULL, NULL),
(6, 'Mahkota Coffe', 1, NULL, NULL),
(7, 'Abadi Jaya', 1, NULL, NULL),
(8, 'Cinday Mart', 1, NULL, NULL),
(9, 'Sinar Kawijaya', 1, NULL, NULL),
(10, 'Pelangi Mart', 1, NULL, NULL),
(11, 'Ratio Coffee', 1, NULL, NULL),
(12, 'RM Sehati', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_detail`
--

CREATE TABLE `trx_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_trx` int(100) NOT NULL,
  `tokok` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` int(100) NOT NULL DEFAULT 0,
  `ispkp` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trx_detail`
--

INSERT INTO `trx_detail` (`id`, `id_trx`, `tokok`, `total`, `ispkp`, `created_at`, `updated_at`) VALUES
(22, 5, 'Susi Air', 559010, 0, NULL, NULL),
(23, 5, 'Grand Pangeran', 350000, 0, NULL, NULL),
(24, 5, '', 200000, 0, NULL, NULL),
(25, 5, 'PT Telekomunikasi', 354500, 0, NULL, NULL),
(26, 5, 'PT Telekomunikasi', 357700, 0, NULL, NULL),
(27, 4, 'Sinar Kawi Jaya', 174000, 0, NULL, NULL),
(28, 4, 'Pelangi Mart', 110000, 0, NULL, NULL),
(29, 4, 'Ratio Coffe', 337000, 0, NULL, NULL),
(30, 6, 'Sinar Kawi Jaya', 174000, 0, NULL, NULL),
(31, 6, 'Pelangi Mart', 110000, 0, NULL, NULL),
(32, 6, 'Ratio Coffe', 337000, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_proses`
--

CREATE TABLE `trx_proses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_partai` int(100) NOT NULL,
  `id_kategori` int(100) NOT NULL,
  `total` int(100) NOT NULL DEFAULT 0,
  `filespj` varchar(100) NOT NULL,
  `total_kwi` int(100) NOT NULL DEFAULT 0,
  `kwi_suc` int(100) NOT NULL DEFAULT 0,
  `kwi_tot` int(100) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_proceed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trx_proses`
--

INSERT INTO `trx_proses` (`id`, `id_partai`, `id_kategori`, `total`, `filespj`, `total_kwi`, `kwi_suc`, `kwi_tot`, `is_active`, `is_proceed`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 621000, 'Bukti_Partai_GL_Operasional.pdf', 0, 0, 0, 0, 0, NULL, NULL),
(2, 1, 1, 621000, 'Bukti_Partai_GL_Operasional.pdf', 0, 0, 0, 0, 0, NULL, NULL),
(3, 1, 1, 621000, 'Bukti_Partai_GL_Operasional.pdf', 0, 0, 0, 0, 0, NULL, NULL),
(4, 1, 1, 621000, 'Bukti_Partai_GL_Operasional.pdf', 0, 0, 621000, 1, 1, NULL, NULL),
(5, 1, 2, 1821210, 'Bukti_Partai_GL_Pendidikan_Politik.pdf', 0, 0, 1821210, 1, 1, NULL, NULL),
(6, 4, 1, 19, 'Bukti_Partai_GL_Operasional.pdf', 0, 0, 621000, 1, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_kategori`
--
ALTER TABLE `master_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_partai`
--
ALTER TABLE `master_partai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_store`
--
ALTER TABLE `master_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_detail`
--
ALTER TABLE `trx_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_proses`
--
ALTER TABLE `trx_proses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_kategori`
--
ALTER TABLE `master_kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_partai`
--
ALTER TABLE `master_partai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_store`
--
ALTER TABLE `master_store`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trx_detail`
--
ALTER TABLE `trx_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `trx_proses`
--
ALTER TABLE `trx_proses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
