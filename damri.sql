-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 22, 2016 at 10:28 AM
-- Server version: 10.0.24-MariaDB-7
-- PHP Version: 7.0.4-7ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `damri`
--

-- --------------------------------------------------------

--
-- Table structure for table `bis`
--

CREATE TABLE `bis` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_bis_id` int(11) NOT NULL,
  `plat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bis`
--

INSERT INTO `bis` (`id`, `jenis_bis_id`, `plat`, `jumlah_kursi`, `created_at`) VALUES
(1, 1, '7629 SL', 23, '2016-05-18 17:00:00'),
(2, 1, '7526 SL', 23, '2016-05-19 17:00:00'),
(3, 2, '7780 A', 31, '2016-05-19 17:00:00'),
(4, 2, '7781 A', 31, '2016-05-19 17:00:00'),
(5, 3, '7631 SL', 23, '2016-05-19 17:00:00'),
(6, 3, '7630 SL', 23, '2016-05-19 17:00:00'),
(7, 4, '7576 S', 34, '2016-05-19 17:00:00'),
(8, 4, '7573 S', 34, '2016-05-19 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bis_berangkat`
--

CREATE TABLE `bis_berangkat` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_bis_trayek_id` int(11) NOT NULL,
  `kode_trayek` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_bis` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bis_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bis_berangkat`
--

INSERT INTO `bis_berangkat` (`id`, `jenis_bis_trayek_id`, `kode_trayek`, `nomor_bis`, `bis_id`, `tanggal`, `created_at`) VALUES
(1, 1, 'RYL-PTK-19-STG', 'Bis 1', 1, '2016-05-21', '2016-05-20 17:00:00'),
(2, 1, 'RYL-PTK-19-STG', 'Bis 2', 2, '2016-05-21', '2016-05-20 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bis_default`
--

CREATE TABLE `bis_default` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_bis_trayek_id` int(11) NOT NULL,
  `kode_trayek` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_bis` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bis_default`
--

INSERT INTO `bis_default` (`id`, `jenis_bis_trayek_id`, `kode_trayek`, `nomor_bis`, `jumlah_kursi`, `created_at`) VALUES
(1, 1, 'RYL-PTK-19-STG', 'Bis 1', 23, '2016-05-18 17:00:00'),
(2, 1, 'RYL-PTK-19-STG', 'Bis 2', 23, '2016-05-19 17:00:00'),
(3, 2, 'EKS-PTK-19-STG', 'Bis 1', 31, '2016-05-20 17:00:00'),
(4, 2, 'EKS-PTK-19-STG', 'Bis 2', 31, '2016-05-20 17:00:00'),
(5, 4, 'RYL-FRGN-PTK-21-KCH', 'Bis 1', 23, '2016-05-20 17:00:00'),
(6, 5, 'RYL-FRGN-PTK-21-KCH', 'Bis 1', 23, '2016-05-20 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_bis`
--

CREATE TABLE `jenis_bis` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug_jenis` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug_alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jenis_bis`
--

INSERT INTO `jenis_bis` (`id`, `jenis`, `slug_jenis`, `alias`, `slug_alias`, `created_at`) VALUES
(1, 'Royal', 'royal', 'RYL', 'ryl', '2016-05-15 17:00:00'),
(2, 'Executive', 'executive', 'EKS', 'eks', '2016-05-15 17:00:00'),
(3, 'Royal (Foreign)', 'royal-foreign', 'RYL-FRGN', 'ryl-rfgn', '2016-05-15 17:00:00'),
(4, 'Executive (Foreign)', 'executive-foreign', 'EKS-FRGN', 'eks-frgn', '2016-05-15 17:00:00'),
(5, 'Executive (Bandara)', 'executive-bandara', 'EKS-BDR', 'eks-bdr', '2016-05-15 17:00:00'),
(6, 'Ekonomi', 'ekonomi', 'EKN', 'ekn', '2016-05-15 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_bis_trayek`
--

CREATE TABLE `jenis_bis_trayek` (
  `id` int(10) UNSIGNED NOT NULL,
  `trayek_id` int(11) NOT NULL,
  `jenis_bis_id` int(11) NOT NULL,
  `harga` double NOT NULL,
  `jadwal` time NOT NULL,
  `stasiun_asal` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `stasiun_tujuan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kode_trayek` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jenis_bis_trayek`
--

INSERT INTO `jenis_bis_trayek` (`id`, `trayek_id`, `jenis_bis_id`, `harga`, `jadwal`, `stasiun_asal`, `stasiun_tujuan`, `kode_trayek`, `created_at`) VALUES
(1, 1, 1, 200000, '19:00:00', 'Jl. Pahlawan (Pontianak)', 'Jl. Tugu BI & Sei. Durian (Sintang)', 'RYL-PTK-19-STG', '2016-05-19 17:00:00'),
(2, 1, 2, 160000, '19:00:00', 'Jl. Pahlawan (Pontianak)', 'Jl. Tugu BI & Sei. Durian (Sintang)', 'EKS-PTK-19-STG', '2016-05-19 17:00:00'),
(3, 1, 2, 160000, '08:00:00', 'Jl. Pahlawan (Pontianak)', 'Jl. Tugu BI & Sei. Durian (Sintang)', 'EKS-PTK-08-STG', '2016-05-19 17:00:00'),
(4, 4, 3, 275000, '21:00:00', 'Jl. Pahlawan (Pontianak)', 'Jl. Ntah dimana (Kuching)', 'RYL-FRGN-PTK-21-KCH', '2016-05-20 17:00:00'),
(5, 4, 3, 210000, '21:00:00', 'Jl. Pahwalan (Pontianak)', 'Jl. Perbatasan (Entikong)', 'RYL-FRGN-PTK-21-KCH', '2016-05-20 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_05_14_145201_create_trayek_table', 1),
('2016_05_15_210725_create_jenis_bis_table', 1),
('2016_05_15_211417_create_bis_table', 1),
('2016_05_15_211705_create_jenis_trayek_bis_table', 1),
('2016_05_15_211932_create_bis_default_table', 1),
('2016_05_15_212744_create_bis_berangkat_table', 1),
('2016_05_15_214542_create_petugas_table', 1),
('2016_05_15_214828_create_pesanan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(10) UNSIGNED NOT NULL,
  `penumpang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passport` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numeratur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `petugas_id` int(11) NOT NULL,
  `jenis_bis_trayek_id` int(11) NOT NULL,
  `kode_trayek` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_bis` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_kursi` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bis_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `penumpang`, `telephone`, `passport`, `tanggal`, `status`, `keterangan`, `numeratur`, `petugas_id`, `jenis_bis_trayek_id`, `kode_trayek`, `nomor_bis`, `nomor_kursi`, `bis_id`, `created_at`, `updated_at`) VALUES
(7, 'adi', '123', '', '2016-05-21', 'cash', '', '', 1, 1, 'RYL-PTK-19-STG', 'Bis 1', '1A', 0, '2016-05-21 05:49:06', '2016-05-21 05:49:06'),
(8, 'budi', '234', '', '2016-05-21', 'booking', '', '', 1, 1, 'RYL-PTK-19-STG', 'Bis 1', '1B', 0, '2016-05-21 05:59:50', '2016-05-21 05:59:50'),
(9, 'erwin', '345', '', '2016-05-21', 'cash', '', '', 1, 2, 'EKS-PTK-19-STG', 'Bis 1', '1A', 0, '2016-05-21 06:01:24', '2016-05-21 06:01:24'),
(10, 'zuhri', '456', '', '2016-05-21', 'booking', '', '', 1, 1, 'RYL-PTK-19-STG', 'Bis 2', '1A', 0, '2016-05-21 06:02:29', '2016-05-21 06:02:29'),
(12, 'udin', '987', '', '2016-05-21', 'cash', '', '', 1, 1, 'RYL-PTK-19-STG', 'Bis 1', '1C', 0, '2016-05-21 06:40:38', '2016-05-21 06:40:38'),
(14, 'heri', '876', '', '2016-05-21', 'booking', '', '', 1, 1, 'RYL-PTK-19-STG', 'Bis 1', '2A', 1, '2016-05-21 07:06:05', '2016-05-21 07:06:05'),
(15, 'boang', '756', '', '2016-05-22', 'cash', '', '', 1, 1, 'RYL-PTK-19-STG', 'Bis 1', '1A', 0, '2016-05-21 07:06:46', '2016-05-21 07:06:46'),
(16, 'Rizki', '675', '4324', '2016-05-21', 'cash', '', '', 1, 4, 'RYL-FRGN-PTK-21-KCH', 'Bis 1', '1A', 0, '2016-05-21 08:25:19', '2016-05-21 08:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `petugas` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trayek`
--

CREATE TABLE `trayek` (
  `id` int(10) UNSIGNED NOT NULL,
  `asal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tujuan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias_asal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias_tujuan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug_alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trayek`
--

INSERT INTO `trayek` (`id`, `asal`, `tujuan`, `alias_asal`, `alias_tujuan`, `alias`, `slug_alias`, `created_at`) VALUES
(1, 'Pontianak', 'Sintang', 'ptk', 'stg', 'Pontianak - Sintang', 'pontianak-sintang', '2016-05-19 17:00:00'),
(2, 'Sintang', 'Pontianak', 'stg', 'ptk', 'Sintang - Pontianak', 'sintang-pontianak', '2016-05-19 17:00:00'),
(3, 'Pontianak', 'Melawi', 'ptk', 'mlwi', 'Pontianak - Melawi', 'pontianak-melawi', '2016-05-19 17:00:00'),
(4, 'Pontianak', 'Kuching', 'ptk', 'kch', 'Pontianak - Kuching', 'pontianak-kuching', '2016-05-19 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bis`
--
ALTER TABLE `bis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bis_berangkat`
--
ALTER TABLE `bis_berangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bis_default`
--
ALTER TABLE `bis_default`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_bis`
--
ALTER TABLE `jenis_bis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_bis_trayek`
--
ALTER TABLE `jenis_bis_trayek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trayek`
--
ALTER TABLE `trayek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trayek_slug_alias_index` (`slug_alias`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bis`
--
ALTER TABLE `bis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `bis_berangkat`
--
ALTER TABLE `bis_berangkat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bis_default`
--
ALTER TABLE `bis_default`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jenis_bis`
--
ALTER TABLE `jenis_bis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jenis_bis_trayek`
--
ALTER TABLE `jenis_bis_trayek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trayek`
--
ALTER TABLE `trayek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
