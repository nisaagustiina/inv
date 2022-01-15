-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jan 2022 pada 15.53
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inv`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_category`
--

CREATE TABLE `p_category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `p_category`
--

INSERT INTO `p_category` (`id_category`, `name_category`) VALUES
(1, 'Part Elektronik'),
(2, 'PCB'),
(3, 'Mechanical Part'),
(4, 'LED'),
(5, 'Mounting'),
(6, 'Packing Case'),
(7, 'Power Supply'),
(8, 'Bahan Kimia'),
(9, 'Label-Ribbon\r\n'),
(10, 'Material Support'),
(12, 'Barang Jadi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_group`
--

CREATE TABLE `p_group` (
  `id_group` int(11) NOT NULL,
  `name_group` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `p_group`
--

INSERT INTO `p_group` (`id_group`, `name_group`) VALUES
(1, 'Bulb Lamp'),
(2, 'Tube Lamp'),
(3, 'Showcase'),
(4, 'High Bay'),
(5, 'Street Lamp'),
(6, 'Flood Light'),
(7, 'All\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_item`
--

CREATE TABLE `p_item` (
  `id_item` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `code_item` varchar(20) NOT NULL,
  `name_item` text NOT NULL,
  `id_unit` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `id_vendor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `p_item`
--

INSERT INTO `p_item` (`id_item`, `id_group`, `id_category`, `code_item`, `name_item`, `id_unit`, `stock`, `id_vendor`) VALUES
(17, 1, 1, 'PBD.ELP.TAI.005', 'Lead R1 - 100 OHM Wirewound\r\n(KNP2BJX101)', 1, 0, 52),
(18, 1, 1, 'PBD.ELP.TAI.002', 'Chip R2 - 510K/470 Kohm Carbon\r\n(RM12JT514/RM12JT474)', 1, 0, 52),
(19, 1, 2, 'PBD.PCB.LCL.001', 'PCB Bulb Lamp\r\n(PWBE124P)', 1, 0, 31),
(20, 1, 3, 'PBD.MCC.DNS.003', 'PC Cover Bulb Lamp', 1, 0, 53),
(21, 1, 10, 'PBD.MSP.FDI.005', 'AC Lead Wire \r\n(TRW (B)-050 0.5mm L50mm)', 1, 0, 43),
(22, 1, 10, 'PBD.MSP.RLC.001', 'Solder Wire 0.6 mm \r\n(SN 100C)', 1, 0, 47),
(23, 1, 10, 'PBD.ELP.TAI.004', 'Chip R3 - 220 OHM \r\n(RM12JT221)', 1, 0, 52),
(25, 2, 2, 'PBD.ELP.TAI.005', 'mm', 2, 0, 47);

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_unit`
--

CREATE TABLE `p_unit` (
  `id_unit` int(11) NOT NULL,
  `name_unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `p_unit`
--

INSERT INTO `p_unit` (`id_unit`, `name_unit`) VALUES
(1, 'pcs'),
(2, 'm'),
(3, 'roll');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_stock`
--

CREATE TABLE `t_stock` (
  `id_stock` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `po` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_stock`
--

INSERT INTO `t_stock` (`id_stock`, `id_item`, `po`, `qty`, `date`, `id_user`, `type`, `note`) VALUES
(1, 18, '', 12, '2022-01-15', 3, 'in', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name`, `username`, `password`, `level`) VALUES
(3, 'Nisa', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(4, 'user', 'user', '12dea96fec20593566ab75692c9949596833adc9', 2),
(5, 'caca', 'caca', 'a16358be6e2306b153b1f071477e68837266075e', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(11) NOT NULL,
  `name_vendor` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `name_vendor`, `address`, `phone`, `email`) VALUES
(31, 'PT. ATA International', '\"Kawasan Industri Gobel Jl. Teuku Umar Km 44', '', ''),
(32, 'PT. Ohtomi', '\"MM2100 Industrial Town', '', ''),
(33, 'PT. BEST (Baut Elektra Solusi Teknik)', '\"Komplek Prima Sentra Blok C No. 10 Gandasari', '', ''),
(34, 'PT. Jase Jaya Indonesia', '\"Rawa Bancet RT 01 Rw 01 Wantilan\nCipeundeuy Subang 41272\"', '', ''),
(35, 'PT. Hibex Indonesia', 'Jl. Jababeka II Blok C18 E Bekasi', '', ''),
(36, 'PT. Kahar Duta Sarana', '\"Ruko Kopo Plaza Blok D-5', '', ''),
(37, 'Nichia Chemical Pte. Ltd', '\"78 Shenton Way', '', ''),
(38, '\"PT. Celebit Circuit\nTechnology Indonesia\"', '\"Jl. Buah Dua Np. 168 RT 01/RW. 04\nRancaekek-Bandung Indonesia 40394\"', '', ''),
(39, 'PT. Indonesia Chemicon', '\"EJIP Industrial Park Plot 4C', '', ''),
(40, 'CSI Chemical', '\"D1-U5-11', '', ''),
(41, 'CV. Abrosah', '\"Lingkar Talun Tengah No. 06 RT. 02/03\nKel. Talun', '', ''),
(42, 'PT. Endota Sinar Indonesia', '\"Cluster 1KM', '', ''),
(43, 'PT. FD Industri Indonesia', '\"Kawasan Berikat Besland Pertiwi\nKota Bukit Indah Blok AII No. 29 ST-4E', '', ''),
(44, 'PT. Kuroda Electric Indonesia', '\"Cikarang TechnoPark Building - 3A\nJl. Inti 1 Blok C1 No. 7', '', ''),
(45, 'PT. GSK Electronics Indonesia', '\"Ruko Mutiara Bekasi Center Blok B No. 23', '', ''),
(46, 'Arrow Electronics', '\"750E Chai Chee Road #07-01/02 Viva\nBussiness Park Singapore 469005\"', '', ''),
(47, 'PT. RLC', '\"Jl. Jababeka XVII B Block U20 Kawasan\nIndustri Jababeka Bekasi 17530\nJawa barat Indonesia\"', '', ''),
(48, 'WellySun Inc.', '\"6F-3', '', ''),
(49, 'PT. Global Jaya Elektronik', '\"Kawasan Industri Tristate', '', ''),
(50, 'PT. Hana Master Jaya', '\"Jl. Cibingbin No. 99 RT. 03/03\nDesa Laksana Mekar', '', ''),
(52, 'PT. TAI Electronics Indonesia', '', '', ''),
(53, 'PT. Dong San Indonesia\r\n', '\"Cikarang Industrial Estate Jl. Jababeka III G Blok C - 17 AS Cikarang - Bekasi 17550\"', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `p_category`
--
ALTER TABLE `p_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `p_group`
--
ALTER TABLE `p_group`
  ADD PRIMARY KEY (`id_group`);

--
-- Indeks untuk tabel `p_item`
--
ALTER TABLE `p_item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_unit` (`id_unit`),
  ADD KEY `id_vendor` (`id_vendor`);

--
-- Indeks untuk tabel `p_unit`
--
ALTER TABLE `p_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indeks untuk tabel `t_stock`
--
ALTER TABLE `t_stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `p_category`
--
ALTER TABLE `p_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `p_group`
--
ALTER TABLE `p_group`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `p_item`
--
ALTER TABLE `p_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `p_unit`
--
ALTER TABLE `p_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `t_stock`
--
ALTER TABLE `t_stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `p_item`
--
ALTER TABLE `p_item`
  ADD CONSTRAINT `p_item_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `p_category` (`id_category`),
  ADD CONSTRAINT `p_item_ibfk_2` FOREIGN KEY (`id_group`) REFERENCES `p_group` (`id_group`),
  ADD CONSTRAINT `p_item_ibfk_3` FOREIGN KEY (`id_unit`) REFERENCES `p_unit` (`id_unit`),
  ADD CONSTRAINT `p_item_ibfk_4` FOREIGN KEY (`id_vendor`) REFERENCES `vendor` (`id_vendor`);

--
-- Ketidakleluasaan untuk tabel `t_stock`
--
ALTER TABLE `t_stock`
  ADD CONSTRAINT `t_stock_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `p_item` (`id_item`),
  ADD CONSTRAINT `t_stock_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
