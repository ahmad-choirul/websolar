-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Agu 2019 pada 16.29
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
  `nama` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `nama`, `password`, `level`) VALUES
(1, 'admin', 'a', '21232F297A57A5A743894A0E4A801FC3', 'user'),
(2, 'user', 'a', 'ee11cbb19052e40b07aac0ca060c23ee', 'user'),
(3, 'ahmad', 'abcd', '', 'user'),
(4, 'asd', 'a', 'c4ca4238a0b923820dcc509a6f75849b', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabellog`
--

CREATE TABLE `tabellog` (
  `id` int(11) NOT NULL,
  `trvolt` varchar(11) NOT NULL,
  `trampere` varchar(11) NOT NULL,
  `trwatt` varchar(11) NOT NULL,
  `pavolt` varchar(11) NOT NULL,
  `paampere` varchar(11) NOT NULL,
  `pawatt` varchar(11) NOT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabellogtracker`
--

CREATE TABLE `tabellogtracker` (
  `id` int(11) NOT NULL,
  `rataatas` int(11) NOT NULL,
  `ratabawah` int(11) NOT NULL,
  `ratakiri` int(11) NOT NULL,
  `ratakanan` int(11) NOT NULL,
  `errorvert` int(11) NOT NULL,
  `errorhor` int(11) NOT NULL,
  `kd` int(11) NOT NULL,
  `tol` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabellogtracker`
--

INSERT INTO `tabellogtracker` (`id`, `rataatas`, `ratabawah`, `ratakiri`, `ratakanan`, `errorvert`, `errorhor`, `kd`, `tol`, `waktu`) VALUES
(1, 612, 430, 420, 514, 182, 94, 77, 35, '2019-06-10 15:22:03'),
(2, 465, 713, 406, 60, 248, 346, 70, 21, '2019-06-10 15:22:03'),
(3, 799, 98, 676, 823, 701, 147, 50, 2, '2019-06-10 15:22:03'),
(4, 701, 480, 332, 989, 221, 657, 90, 18, '2019-06-10 15:22:03'),
(5, 477, 47, 785, 837, 430, 52, 38, 19, '2019-06-10 15:22:03'),
(6, 605, 67, 239, 926, 538, 687, 79, 9, '2019-06-10 15:22:03'),
(7, 511, 933, 519, 620, 422, 101, 99, 49, '2019-06-10 15:22:03'),
(8, 18, 186, 328, 485, 168, 157, 91, 1, '2019-06-10 15:22:03'),
(9, 481, 814, 798, 643, 333, 155, 62, 4, '2019-06-10 15:22:03'),
(10, 189, 997, 465, 785, 808, 320, 90, 26, '2019-06-10 15:22:03'),
(11, 464, 897, 391, 179, 433, 212, 67, 20, '2019-06-10 15:22:03'),
(12, 1001, 163, 444, 668, 838, 224, 37, 11, '2019-06-10 15:22:03'),
(13, 824, 793, 689, 194, 31, 495, 73, 35, '2019-06-10 15:22:03'),
(14, 894, 1023, 260, 361, 129, 101, 2, 12, '2019-06-10 15:22:03'),
(15, 742, 526, 60, 948, 216, 888, 45, 13, '2019-06-10 15:22:03'),
(16, 723, 454, 887, 272, 269, 615, 10, 10, '2019-06-10 15:22:03'),
(17, 581, 993, 266, 173, 412, 93, 46, 25, '2019-06-10 15:22:03'),
(18, 573, 578, 739, 998, 5, 259, 42, 28, '2019-06-10 15:22:03'),
(19, 979, 617, 773, 495, 362, 278, 64, 5, '2019-06-10 15:22:03'),
(20, 391, 755, 94, 613, 364, 519, 40, 13, '2019-06-10 15:22:03'),
(21, 124, 218, 203, 784, 94, 581, 65, 36, '2019-06-10 15:22:03'),
(22, 837, 279, 547, 283, 558, 264, 36, 3, '2019-06-10 15:22:03'),
(23, 330, 857, 77, 232, 527, 155, 21, 12, '2019-06-10 15:22:03'),
(24, 722, 901, 900, 871, 179, 29, 11, 23, '2019-06-10 15:22:03'),
(25, 654, 168, 860, 764, 486, 96, 69, 0, '2019-06-10 15:22:03'),
(26, 526, 770, 386, 19, 244, 367, 63, 27, '2019-06-10 15:22:03'),
(27, 167, 955, 904, 739, 788, 165, 19, 4, '2019-06-10 15:22:03'),
(28, 882, 976, 696, 930, 94, 234, 5, 28, '2019-06-10 15:22:03'),
(29, 119, 417, 263, 769, 298, 506, 93, 49, '2019-06-10 15:22:03'),
(30, 300, 960, 565, 981, 660, 416, 89, 12, '2019-06-10 15:22:03'),
(31, 541, 778, 546, 227, 237, 319, 61, 15, '2019-06-10 15:22:03'),
(32, 400, 553, 881, 628, 153, 253, 33, 28, '2019-06-10 15:22:03'),
(33, 1022, 1007, 104, 993, 15, 889, 53, 7, '2019-06-10 15:22:03'),
(34, 554, 718, 864, 225, 164, 639, 85, 1, '2019-06-10 15:22:03'),
(35, 7, 673, 528, 961, 666, 433, 33, 28, '2019-06-10 15:22:03'),
(36, 445, 926, 955, 79, 481, 876, 98, 5, '2019-06-10 15:22:03'),
(37, 739, 684, 583, 875, 55, 292, 11, 46, '2019-06-10 15:22:03'),
(38, 889, 169, 148, 83, 720, 65, 72, 22, '2019-06-10 15:22:03'),
(39, 923, 213, 520, 12, 710, 508, 39, 14, '2019-06-10 15:22:03'),
(40, 976, 49, 969, 908, 927, 61, 75, 37, '2019-06-10 15:22:03'),
(41, 849, 910, 388, 784, 61, 396, 46, 18, '2019-06-10 15:22:03'),
(42, 710, 37, 843, 410, 673, 433, 37, 30, '2019-06-10 15:22:03'),
(43, 925, 80, 79, 1002, 845, 923, 37, 41, '2019-06-10 15:22:03'),
(44, 250, 939, 804, 990, 689, 186, 77, 11, '2019-06-10 15:22:03'),
(45, 761, 675, 798, 564, 86, 234, 50, 1, '2019-06-10 15:22:03'),
(46, 716, 627, 826, 696, 89, 130, 62, 30, '2019-06-10 15:22:03'),
(47, 309, 697, 477, 20, 388, 457, 73, 4, '2019-06-10 15:22:03'),
(48, 804, 120, 772, 773, 684, 1, 74, 23, '2019-06-10 15:22:03'),
(49, 211, 54, 858, 405, 157, 453, 62, 37, '2019-06-10 15:22:03'),
(50, 770, 276, 497, 438, 494, 59, 78, 9, '2019-06-10 15:22:03'),
(51, 286, 851, 648, 237, 565, 411, 62, 18, '2019-06-10 15:22:03'),
(52, 376, 897, 142, 850, 521, 708, 75, 30, '2019-06-10 15:22:03'),
(53, 698, 410, 156, 41, 288, 115, 35, 9, '2019-06-10 15:22:03'),
(54, 95, 628, 1003, 15, 533, 988, 62, 39, '2019-06-10 15:22:03'),
(55, 974, 801, 242, 204, 173, 38, 84, 1, '2019-06-10 15:22:03'),
(56, 377, 685, 38, 295, 308, 257, 38, 8, '2019-06-10 15:22:03'),
(57, 796, 45, 17, 738, 751, 721, 2, 35, '2019-06-10 15:22:03'),
(58, 83, 354, 948, 14, 271, 934, 96, 4, '2019-06-10 15:22:03'),
(59, 717, 341, 682, 747, 376, 65, 16, 17, '2019-06-10 15:22:03'),
(60, 42, 529, 875, 659, 487, 216, 53, 33, '2019-06-10 15:22:03'),
(61, 472, 80, 353, 848, 392, 495, 34, 7, '2019-06-10 15:22:03'),
(62, 613, 379, 754, 53, 234, 701, 2, 18, '2019-06-10 15:22:03'),
(63, 782, 326, 218, 82, 456, 136, 35, 9, '2019-06-10 15:22:03'),
(64, 487, 528, 466, 598, 41, 132, 4, 1, '2019-06-10 15:22:03'),
(65, 875, 765, 459, 278, 110, 181, 57, 31, '2019-06-10 15:22:03'),
(66, 745, 963, 766, 799, 218, 33, 60, 13, '2019-06-10 15:22:03'),
(67, 41, 743, 918, 281, 702, 637, 22, 31, '2019-06-10 15:22:03'),
(68, 331, 232, 774, 819, 99, 45, 66, 9, '2019-06-10 15:22:03'),
(69, 753, 849, 155, 830, 96, 675, 1, 35, '2019-06-10 15:22:03'),
(70, 666, 124, 420, 332, 542, 88, 24, 14, '2019-06-10 15:22:03');

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
(1, 66, 124, 420, 332, 542, 88, 24, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hitungmanual`
--

CREATE TABLE `tbl_hitungmanual` (
  `id` int(11) NOT NULL,
  `error` float NOT NULL,
  `deltaerror` float NOT NULL,
  `hasil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hitungmanual`
--

INSERT INTO `tbl_hitungmanual` (`id`, `error`, `deltaerror`, `hasil`) VALUES
(7, 200, 200, 100),
(8, 100, 100, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_simulasi`
--

CREATE TABLE `tbl_simulasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `watt` int(11) NOT NULL,
  `lama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_simulasi`
--

INSERT INTO `tbl_simulasi` (`id`, `nama`, `watt`, `lama`) VALUES
(2, 'kulkas', 100, 20);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tabellog`
--
ALTER TABLE `tabellog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tabellogtracker`
--
ALTER TABLE `tabellogtracker`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tabelupdate`
--
ALTER TABLE `tabelupdate`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_hitungmanual`
--
ALTER TABLE `tbl_hitungmanual`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_simulasi`
--
ALTER TABLE `tbl_simulasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tabellog`
--
ALTER TABLE `tabellog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tabellogtracker`
--
ALTER TABLE `tabellogtracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `tabelupdate`
--
ALTER TABLE `tabelupdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_hitungmanual`
--
ALTER TABLE `tbl_hitungmanual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_simulasi`
--
ALTER TABLE `tbl_simulasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
