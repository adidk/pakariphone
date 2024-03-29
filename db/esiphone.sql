-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2021 pada 19.01
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
('GJL0001', 'iPhone Mati'),
('GJL0002', 'iPhone Menyala'),
('GJL0003', 'Tidak ada ampere masuk'),
('GJL0004', 'Ada tegangan masuk'),
('GJL0005', 'Tidak terhubung dengan komputer'),
('GJL0006', 'Terhubung dengan komputer'),
('GJL0007', 'iPhone bergetar atau berdering'),
('GJL0008', 'Tegangan masuk tidak stabil'),
('GJL0009', 'Dicharger turun % baterainya'),
('GJL0010', 'Baterai health dibawah 80%'),
('GJL0011', 'Meminta persetujuan iTunes');

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
('KR0001', 'Mati Total / Short', 'Kemungkinan Mati Total', 'iPhone mengalami shorot atau tegangan pendek pada bagian mesin ataupun bagian fleksible yang terjadi karena iPhone teratuh atau kemasukan air ataupun karena saat melakukan pengisian daya iPhone mengalami tegangan pendek'),
('KR0002', 'DFU Mode', 'Menyala tapi tidak masuk menu', 'iPhone dalam keadaan Recovery Mode atau DFU Mode, perlu melakukan proses install ulang/restore untuk mengetahui keruskan pasti apakah di software atau di hardware ( jika di restore masuk menu maka memang permasalahan software namun jika muncul eror maka tergantung memunculkan eror berapa untuk mengindikasikan di bagian hardware apa).'),
('KR0003', 'IC Display / Backlighit', 'Tampilan tidak muncul', 'iPhone mengalami kendala pada IC (Integrated Ciruit) Backlight atau IC Display . dimana sesuai namaua IC tersebut bertugas menampilkan cahaya dan menampilkan gambar sehingga ketika tidak dialiri tegangan dengan penuh maka iPhone menyla dengan kendala tidak memunculkan tampilan tapi masih dapat ditelfon atu masih bisa dicek getar tidaknya menggunakan switch getar.'),
('KR0004', 'Konektor Charger / IC Charger', 'Tidak bisa melakukan charging', 'iPhone tidak dapat di charger walaupun sudah berganti charger. kemungkinan kendala ada pada konektor charger atau yang paling parah pada IC (Integrated Circuit) Charger dimana itu dibagian mesin. Perlu melakukan pengecekan dengan bantuan teknisi profesional untuk mengetahui keruskaan pasti karena harus melakukan penggantian konektor charger terlebih dahulu.'),
('KR0005', 'Baterai Health', 'Baterai Health', 'iPhone dengan Baterai Health dibawah 80% dianjurkan untuk melakukan penggantian baterai sesegera mungkin jika tidak menginginkan terjadinya pengurangan performa oleh sistem karena mendeteksi bahwa performa baterai sudah tidak maksimal.'),
('KR0006', 'Baterai ', 'Baterai Drop', 'iPhone dengan permasalahan baterai dapat mengurangi performa dan tidak nyaman saat penggunaan. Disarankan segera mengganti baterai untuk kenyamanan pemakaian.'),
('KR0007', 'Baterai Gelembung Pemakaian Normal', 'LCD Mengangkat', 'iPhone dengan baterai gelembung namun pemakaian masih normal dan tidak terkendala pada Baterai Health. disarankan untuk segera mengganti baterai karena bisa berakibat ke LCD yang tertekan oleh tekanan baterai dan dapat merusak LCD.');

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
('PK0001', 'GJL0001', 'Apakah iPhone Anda Mati ?'),
('PK0002', 'GJL0002', 'Apakah iPhone Anda Menyala ?'),
('PK0003', 'GJL0003', 'Apakah setelah dicek dengan USB detector meter tidak memunculkan ampere sama sekali?\r\n*jika tidak memiliki USB detector meter langsung dicek ke tempat servis terdekat.'),
('PK0004', 'GJL0004', 'Apakah setelah dicek manggunakan USB detector meter ada amper masuk?'),
('PK0005', 'GJL0005', 'Apakah iPhone tidak dapat terhubung dengan iTunes dengan mode Recovery?'),
('PK0006', 'GJL0006', 'Apakah iPhone dapat terhubung dengan iTunes dengan mode Recovery?'),
('PK0007', 'GJL0007', 'Apakah iPhone dapat bergetar atau berdering saat di telfon?'),
('PK0008', 'GJL0008', 'Apakah tegangan USB detector meter tidak stabil dan cenderung dibawah 0,8 A?'),
('PK0009', 'GJL0009', 'Apakah saat di charge daya baterai menurun?'),
('PK0010', 'GJL0010', 'Apakah presentase baterai health di pengaturan dibawah 80%?'),
('PK0011', 'GJL0011', 'Apakah iTunes memunculkan pop up untuk persetujuan device terhubung?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_hasilkonsultasi`
--

CREATE TABLE `rekap_hasilkonsultasi` (
  `id_rekaphasilkonsultasi` int(6) NOT NULL,
  `id_konsultasirhk` varchar(6) NOT NULL,
  `id_kerusakanrhk` varchar(6) NOT NULL,
  `id_userrhk` varchar(50) NOT NULL,
  `id_devicerhk` varchar(6) NOT NULL,
  `datetime_rhk` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekap_hasilkonsultasi`
--

INSERT INTO `rekap_hasilkonsultasi` (`id_rekaphasilkonsultasi`, `id_konsultasirhk`, `id_kerusakanrhk`, `id_userrhk`, `id_devicerhk`, `datetime_rhk`) VALUES
(2, '5DA0C7', 'KR0001', '3810188989076022', 'IP0006', '2021-07-17 07:55:24'),
(3, 'F0AE13', 'KR0003', '3810188989076022', 'IP0011', '2021-07-17 08:27:00'),
(4, '311830', 'KR0001', '3810188989076022', 'IP0008', '2021-07-17 08:38:16');

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

--
-- Dumping data untuk tabel `riwayat_jawaban`
--

INSERT INTO `riwayat_jawaban` (`id_riwayatjawaban`, `id_konsultasirj`, `id_pertanyaanrj`, `id_userrj`, `datetime_rj`, `jawaban`) VALUES
(110, '5DA0C7', 'PK0001', '3810188989076022', '2021-07-17 07:55:20', 1),
(111, '5DA0C7', 'PK0003', '3810188989076022', '2021-07-17 07:55:23', 1),
(112, 'F0AE13', 'PK0001', '3810188989076022', '2021-07-17 08:26:27', 1),
(113, 'F0AE13', 'PK0003', '3810188989076022', '2021-07-17 08:26:34', 0),
(114, 'F0AE13', 'PK0004', '3810188989076022', '2021-07-17 08:26:39', 1),
(115, 'F0AE13', 'PK0006', '3810188989076022', '2021-07-17 08:26:48', 0),
(116, 'F0AE13', 'PK0007', '3810188989076022', '2021-07-17 08:26:52', 1),
(117, 'F0AE13', 'PK0011', '3810188989076022', '2021-07-17 08:26:59', 1),
(118, '311830', 'PK0001', '3810188989076022', '2021-07-17 08:38:13', 1),
(119, '311830', 'PK0003', '3810188989076022', '2021-07-17 08:38:15', 1);

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
('RU0001', 'PK0001,PK0003', 'KR0001'),
('RU0002', 'PK0001,PK0004,PK0006', 'KR0002'),
('RU0003', 'PK0001,PK0004,PK0007,PK0011', 'KR0003'),
('RU0004', 'PK0002,PK0004,PK0008,PK0009', 'KR0004'),
('RU0005', 'PK0002,PK0010', 'KR0005'),
('RU0006', 'PK0002,PK0004,PK0008,PK0010', 'KR0006');

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
  `gender` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `phone`, `password`, `role_id`, `gender`, `picture`, `link`, `created`, `modified`) VALUES
(21, 'facebook', '3810188989076022', 'Masadi Dwi', 'Kurniawan', 'masadikurniawandwi@gmail.com', '082324096160', '$2y$10$3f0jeMtypyjfOavp.d0D4ecLK9Z5SRsfidhdOsphxzyHDZRhWjWbO', 1, 'laki - laki', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=3810188989076022&height=50&width=50&ext=1629214068&hash=AeTpXSm2vewnd9sI_Ls', 'https://www.facebook.com/', '2021-07-18 17:27:23', '2021-07-18 17:27:23');

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
-- Indeks untuk tabel `rekap_hasilkonsultasi`
--
ALTER TABLE `rekap_hasilkonsultasi`
  ADD PRIMARY KEY (`id_rekaphasilkonsultasi`);

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
-- AUTO_INCREMENT untuk tabel `rekap_hasilkonsultasi`
--
ALTER TABLE `rekap_hasilkonsultasi`
  MODIFY `id_rekaphasilkonsultasi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `riwayat_jawaban`
--
ALTER TABLE `riwayat_jawaban`
  MODIFY `id_riwayatjawaban` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `rold_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
