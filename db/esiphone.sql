-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2021 pada 04.18
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
-- Database: `esiphone`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `device_type`
--

CREATE TABLE `device_type` (
  `id_device` varchar(6) NOT NULL,
  `name_device` varchar(128) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `device_type`
--

INSERT INTO `device_type` (`id_device`, `name_device`, `image`) VALUES
('IP0001', 'iPhone 4G', 'default.png'),
('IP0002', 'iPhone 4S', 'default.png'),
('IP0003', 'iPhone 5G', 'default.png'),
('IP0004', 'iPhone 5S', 'default.png'),
('IP0005', 'iPhone 6G', 'default.png'),
('IP0006', 'iPhone 6 Plus', 'default.png'),
('IP0007', 'iPhone 6S', 'default.png'),
('IP0008', 'iPhone 6S Plus', 'default.png'),
('IP0009', 'iPhone 5SE', 'default.png'),
('IP0010', 'iPhone 7G', 'default.png'),
('IP0011', 'iPhone 7 Plus', 'default.png'),
('IP0012', 'iPhone 8G', 'default.png'),
('IP0013', 'iPhone 8 Plus', 'default.png'),
('IP0014', 'iPhone X', 'default.png'),
('IP0015', 'iPhone XS', 'default.png'),
('IP0016', 'iPhone XS Max', 'default.png'),
('IP0017', 'iPhone XR', 'default.png'),
('IP0018', 'iPhone 11', 'default.png'),
('IP0019', 'iPhone 11 Pro', 'default.png'),
('IP0020', 'iPhone 11 Pro Max', 'default.png'),
('IP0021', 'iPhone SE 2020', 'default.png'),
('IP0022', 'iPhone 12', 'default.png'),
('IP0023', 'iPhone 12 Mini', 'default.png'),
('IP0024', 'iPhone 12 Pro', 'default.png'),
('IP0025', 'iPhone 12 Pro Max', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala_device`
--

CREATE TABLE `gejala_device` (
  `id_gejala` varchar(7) NOT NULL,
  `nama_gejala` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gejala_device`
--

INSERT INTO `gejala_device` (`id_gejala`, `nama_gejala`) VALUES
('GJL0001', 'LCD Mati'),
('GJL0002', 'Mesin nyala LCD mati'),
('GJL0003', 'LCD menyala tapi redup sekali');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerusakan_device`
--

CREATE TABLE `kerusakan_device` (
  `id_kerusakan` varchar(6) NOT NULL,
  `nama_kerusakan` varchar(256) NOT NULL,
  `nama_konsultasi` varchar(256) NOT NULL,
  `deskripsi_kerusakan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kerusakan_device`
--

INSERT INTO `kerusakan_device` (`id_kerusakan`, `nama_kerusakan`, `nama_konsultasi`, `deskripsi_kerusakan`) VALUES
('KR0001', 'Mati Total / Konslet', 'Kemungkinan Mati Total', 'Merupakan kerusakan mesin dengan berbagai macam kemungkinan dimana kerusakan bisa termasuk kerusakan berat ataupun kerusakan ringan. Jika kerusakan termasuk kerusakan berat maka yang rusak dibagian IC (Integrated Circuit) atau chip , namun jika ringan kerusakan biasanya terjadi di kapsitor. Perlu dilakukan uji skematik jalur untuk menentukan dimana letak short.'),
('KR0002', 'Backlight (Cahaya Redup/Tidak Muncul Tampilan)', 'LCD Redup', 'Kerusakan yang berhubungan dengan tampilan layar dimana kerusakan berasal dari IC (Integrated Circuit) Backlight. sesuai dengan namanya yaitu cahaya belakang dimana sumber cahaya tidak memperoleh daya listrik yang maksimal sehingga mengakibatkan device tidak bisa menampilkan cahaya yang maksimal bahkan bisa tergolong mati.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan_kerusakan`
--

CREATE TABLE `pertanyaan_kerusakan` (
  `id_pertanyaankerusakan` varchar(6) NOT NULL,
  `id_gejala` varchar(7) NOT NULL,
  `pertanyaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pertanyaan_kerusakan`
--

INSERT INTO `pertanyaan_kerusakan` (`id_pertanyaankerusakan`, `id_gejala`, `pertanyaan`) VALUES
('PK0001', 'GJL0001', 'Apakah LCD tidak memunculkan tampilan ?'),
('PK0002', 'GJL0002', 'Apakah lcd mati namun device masih bergetar atau masih bisa menerima panggilan?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_jawaban`
--

CREATE TABLE `riwayat_jawaban` (
  `id_riwayatjawaban` int(6) NOT NULL,
  `id_konsultasirj` varchar(6) NOT NULL,
  `id_pertanyaanrj` varchar(6) NOT NULL,
  `id_userrj` varchar(50) NOT NULL,
  `datetime_rj` datetime NOT NULL,
  `jawaban` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rule_kerusakan`
--

CREATE TABLE `rule_kerusakan` (
  `id_rule` varchar(6) NOT NULL,
  `id_pertanyaankerusakan` text NOT NULL,
  `id_kerusakan` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rule_kerusakan`
--

INSERT INTO `rule_kerusakan` (`id_rule`, `id_pertanyaankerusakan`, `id_kerusakan`) VALUES
('RU0001', 'PK0001,PK0002', 'KR0002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` enum('facebook','google','twitter','') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `oauth_uid` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(14) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(1) NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `phone`, `password`, `role_id`, `gender`, `picture`, `link`, `created`, `modified`) VALUES
(1, 'facebook', '3810188989076022', 'Masadi', 'Kurniawan', 'masadikurniawandwi@gmail.com', '812343242134', '', 1, '', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=3810188989076022&height=50&width=50&ext=1627792880&hash=AeSUvM2aFORJQ8Bcl6I', 'https://www.facebook.com/', '2021-01-27 08:56:25', '2021-07-02 06:41:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `rold_id` int(1) NOT NULL,
  `role_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`rold_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `device_type`
--
ALTER TABLE `device_type`
  ADD PRIMARY KEY (`id_device`);

--
-- Indeks untuk tabel `gejala_device`
--
ALTER TABLE `gejala_device`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indeks untuk tabel `kerusakan_device`
--
ALTER TABLE `kerusakan_device`
  ADD PRIMARY KEY (`id_kerusakan`);

--
-- Indeks untuk tabel `pertanyaan_kerusakan`
--
ALTER TABLE `pertanyaan_kerusakan`
  ADD PRIMARY KEY (`id_pertanyaankerusakan`);

--
-- Indeks untuk tabel `riwayat_jawaban`
--
ALTER TABLE `riwayat_jawaban`
  ADD PRIMARY KEY (`id_riwayatjawaban`);

--
-- Indeks untuk tabel `rule_kerusakan`
--
ALTER TABLE `rule_kerusakan`
  ADD PRIMARY KEY (`id_rule`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`rold_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `riwayat_jawaban`
--
ALTER TABLE `riwayat_jawaban`
  MODIFY `id_riwayatjawaban` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `rold_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
