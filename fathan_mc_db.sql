-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jul 2020 pada 20.12
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fathan_mc_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_acara` int(11) NOT NULL,
  `id_pemesan` int(11) NOT NULL,
  `id_mc` int(11) NOT NULL,
  `tanggal_jam` datetime NOT NULL,
  `jam_acara` int(11) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `profil_peserta` varchar(128) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `budget` int(11) NOT NULL,
  `di_terima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id_booking`, `id_acara`, `id_pemesan`, `id_mc`, `tanggal_jam`, `jam_acara`, `jumlah_peserta`, `profil_peserta`, `alamat`, `keterangan`, `budget`, `di_terima`) VALUES
(2, 3, 5, 4, '2020-07-27 15:00:00', 5, 800, 'Keluarga', 'Gedung serba guna Medan', '', 2000000, 1),
(3, 3, 5, 2, '2020-07-27 15:00:00', 5, 800, 'Keluarga', 'Gedung serba guna Medan', '', 2000000, 1),
(4, 2, 2, 2, '2020-07-27 22:00:00', 2, 50, 'Anak - Anak', 'Jl. Mangga Dua. No. 50 kec. Nebula kab. Asgardia, Asgard', '', 1000000, 1),
(5, 2, 5, 3, '2020-07-23 22:00:00', 1, 200, 'Mahasiswa', 'Apa aja', '', 10000000, 1),
(6, 2, 5, 4, '2020-07-23 22:00:00', 4, 200, 'Mahasiswa', 'Apa aja', '', 10000000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_acara`
--

CREATE TABLE `jenis_acara` (
  `id_jenis_acara` int(11) NOT NULL,
  `jenis_acara` varchar(128) NOT NULL,
  `kode_warna` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_acara`
--

INSERT INTO `jenis_acara` (`id_jenis_acara`, `jenis_acara`, `kode_warna`) VALUES
(1, 'Seminar', '#ED1717'),
(2, 'Ulang Tahun', '#F74CBE'),
(3, 'Pernikahan', '#E235FF'),
(4, 'Peresmian', '#1659FF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id_kota` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `nama_kota` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
('1101', 'KABUPATEN SIMEULUE'),
('1102', 'KABUPATEN ACEH SINGKIL'),
('1103', 'KABUPATEN ACEH SELATAN'),
('1104', 'KABUPATEN ACEH TENGGARA'),
('1105', 'KABUPATEN ACEH TIMUR'),
('1106', 'KABUPATEN ACEH TENGAH'),
('1107', 'KABUPATEN ACEH BARAT'),
('1108', 'KABUPATEN ACEH BESAR'),
('1109', 'KABUPATEN PIDIE'),
('1110', 'KABUPATEN BIREUEN'),
('1111', 'KABUPATEN ACEH UTARA'),
('1112', 'KABUPATEN ACEH BARAT DAYA'),
('1113', 'KABUPATEN GAYO LUES'),
('1114', 'KABUPATEN ACEH TAMIANG'),
('1115', 'KABUPATEN NAGAN RAYA'),
('1116', 'KABUPATEN ACEH JAYA'),
('1117', 'KABUPATEN BENER MERIAH'),
('1118', 'KABUPATEN PIDIE JAYA'),
('1171', 'KOTA BANDA ACEH'),
('1172', 'KOTA SABANG'),
('1173', 'KOTA LANGSA'),
('1174', 'KOTA LHOKSEUMAWE'),
('1175', 'KOTA SUBULUSSALAM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `route` varchar(128) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu_id`, `menu`, `icon`, `route`, `is_active`) VALUES
(1, 'Pengaturan', 'fas fa-cog', 'Pengaturan', 1),
(6, 'MC Area', 'fas fa-cogs', 'MC', 1),
(7, 'Area Pelanggan', 'fas fa-cogs', 'Pelanggan', 1),
(8, 'Profil', 'fas fa-user', 'Profil', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `promosi`
--

CREATE TABLE `promosi` (
  `id_promosi` int(11) NOT NULL,
  `id_mc` int(11) NOT NULL,
  `id_jenis_acara` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `promosi`
--

INSERT INTO `promosi` (`id_promosi`, `id_mc`, `id_jenis_acara`) VALUES
(1, 2, 1),
(2, 3, 4),
(5, 4, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_menu`
--

CREATE TABLE `sub_menu` (
  `sub_menu_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sub_menu` varchar(128) NOT NULL,
  `sub_route` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_menu`
--

INSERT INTO `sub_menu` (`sub_menu_id`, `menu_id`, `sub_menu`, `sub_route`) VALUES
(1, 1, 'Pengaturan Menu', 'menu'),
(2, 1, 'Pengaturan Sub Menu', 'sub_menu'),
(4, 1, 'Validasi User', 'validasi_user'),
(5, 1, 'Pengaturan Menu User', 'user_menu'),
(8, 6, 'Booking', 'booking'),
(9, 6, 'Kalender Acara', 'kalender'),
(10, 7, 'Pesanan Saya', 'pesanan'),
(13, 8, 'Profil Saya', 'profil_saya'),
(15, 1, 'Jenis Acara', 'jenis_acara'),
(16, 6, 'Promosi', 'promosi'),
(17, 6, 'Pesanan Saya', 'pesanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `create_at` datetime NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`users_id`, `role_id`, `name`, `gender`, `email`, `password`, `image`, `phone`, `create_at`, `is_active`) VALUES
(1, 1, 'Admin', 'Laki - Laki', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '', '', '2020-06-24 08:27:44', 1),
(2, 2, 'Users', 'Laki - Laki', 'user@gmail.com', '85064efb60a9601805dcea56ec5402f7', 'user8-128x128.jpg', '085258839713', '2020-07-09 13:36:52', 1),
(3, 2, 'Mc Fathan', 'Laki - Laki', 'fathan.mc@gmail.com', '93f824c70a1efc4ae3614a5ab181a5cc', '', '+6285362367044', '2020-07-12 11:57:11', 1),
(4, 2, 'Jhon Alpha ', 'Laki - Laki', 'JA.voicer@gmail.com', '116db60f10e4506b47a9cc5b37ab9daf', '', '+6288772455506', '2020-07-12 12:00:25', 1),
(5, 3, 'Mina Ayunda', 'Perempuan', 'mina@gmail.com', '85064efb60a9601805dcea56ec5402f7', 'user3-128x128.jpg', '081275301288', '2020-07-18 23:55:03', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `user_menu_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`user_menu_id`, `menu_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 0, 0),
(4, 0, 0),
(7, 5, 2),
(9, 6, 2),
(10, 7, 3),
(13, 8, 1),
(14, 8, 2),
(15, 8, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL,
  `route` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`role_id`, `role`, `route`) VALUES
(1, 'Administrator', '/admin'),
(2, 'Master Of Ceremony', '/mc'),
(3, 'Customers', '/pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indeks untuk tabel `jenis_acara`
--
ALTER TABLE `jenis_acara`
  ADD PRIMARY KEY (`id_jenis_acara`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indeks untuk tabel `promosi`
--
ALTER TABLE `promosi`
  ADD PRIMARY KEY (`id_promosi`);

--
-- Indeks untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`sub_menu_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`user_menu_id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jenis_acara`
--
ALTER TABLE `jenis_acara`
  MODIFY `id_jenis_acara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `promosi`
--
ALTER TABLE `promosi`
  MODIFY `id_promosi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `sub_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `user_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
