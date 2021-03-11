-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 10, 2021 at 05:26 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simplesoa`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_user` int(15) NOT NULL,
  `namalengkap` varchar(256) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_user`, `namalengkap`, `username`, `password`) VALUES
(1, 'Vicktor Lambok Desrony', 'vldcreation', '123456'),
(2, 'Henny', 'henny', '123456'),
(3, 'Channi', 'chan', '123456'),
(4, 'Nursista', 'nursis', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(15) NOT NULL,
  `id_user` int(15) NOT NULL,
  `id_produk` int(15) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `tanggal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_produk`, `jumlah`, `tanggal`) VALUES
(1, 1, 2, 15, '2021-03-06'),
(2, 1, 3, 3, '2021-03-09'),
(3, 1, 8, 22, '2021-03-09'),
(4, 2, 6, 6, '2021-03-09'),
(5, 4, 1, 2, '2021-03-09'),
(6, 3, 2, 3, '2021-03-09'),
(7, 3, 3, 3, '2021-03-09'),
(9, 2, 1, 1, '2021-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `produk3`
--

CREATE TABLE `produk3` (
  `id_produk` int(15) NOT NULL,
  `nama_produk` varchar(256) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah_Produk` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk3`
--

INSERT INTO `produk3` (`id_produk`, `nama_produk`, `harga`, `jumlah_Produk`, `deskripsi`) VALUES
(1, 'Laptop', 120000, 42, 'Laptop Gaming'),
(2, 'handphone', 9000000, 99, 'Iphone X terbaru'),
(3, 'Gelas', 50000, 6, 'Gelas Duralex anti pecah'),
(5, 'Pulpen', 7000, 12, 'Pulpen Mantap sih'),
(6, 'Sendok', 15000, 7, 'Sendok Tebal Stainles'),
(8, 'Mouse', 500000, 77, 'Mouse gaming terbaru'),
(12, 'Pensil', 20000, 100, 'Pensil 2B'),
(14, 'Buku', 500000, 200, 'Buku Programming'),
(15, 'Bingkai', 150000, 30, 'Bingkai Foto Ukuran Persegi 4 x 4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk3`
--
ALTER TABLE `produk3`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_user` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk3`
--
ALTER TABLE `produk3`
  MODIFY `id_produk` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk3` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `akun` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
