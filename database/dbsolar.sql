-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Apr 2019 pada 19.33
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsolar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232F297A57A5A743894A0E4A801FC3'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee'),
(3, 'ahmad', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabellog`
--

CREATE TABLE `tabellog` (
  `id` int(11) NOT NULL,
  `trvolt` int(11) NOT NULL,
  `trampere` int(11) NOT NULL,
  `trwatt` int(11) NOT NULL,
  `pavolt` int(11) NOT NULL,
  `paampere` int(11) NOT NULL,
  `pawatt` int(11) NOT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabelupdate`
--

CREATE TABLE `tabelupdate` (
  `id` int(11) NOT NULL,
  `rataatas` int(11) NOT NULL,
  `ratabawah` int(11) NOT NULL,
  `ratakiri` int(11) NOT NULL,
  `ratakanan` int(11) NOT NULL,
  `errorvert` int(11) NOT NULL,
  `errorhor` int(11) NOT NULL,
  `kd` int(11) NOT NULL,
  `tol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabelupdate`
--

INSERT INTO `tabelupdate` (`id`, `rataatas`, `ratabawah`, `ratakiri`, `ratakanan`, `errorvert`, `errorhor`, `kd`, `tol`) VALUES
(1, 942, 925, 938, 929, 17, 9, 25, 20);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tabellog`
--
ALTER TABLE `tabellog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tabelupdate`
--
ALTER TABLE `tabelupdate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tabellog`
--
ALTER TABLE `tabellog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tabelupdate`
--
ALTER TABLE `tabelupdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
