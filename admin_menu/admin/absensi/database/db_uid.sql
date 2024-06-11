-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2024 pada 04.28
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uid`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id` varchar(50) NOT NULL,
  `masuk` varchar(15) NOT NULL,
  `keluar` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `Keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_id`
--

CREATE TABLE `tb_id` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `chatid` varchar(50) NOT NULL,
  `notifikasi` int(11) NOT NULL,
  `tahun_masuk` varchar(25) NOT NULL,
  `nisn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `no` int(10) NOT NULL,
  `username` varchar(22) NOT NULL,
  `password` varchar(22) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`no`, `username`, `password`, `level`) VALUES
(6, 'admin', 'admin', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rfid`
--

CREATE TABLE `tb_rfid` (
  `id` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_settings`
--

CREATE TABLE `tb_settings` (
  `masuk_mulai` time NOT NULL,
  `masuk_akhir` time NOT NULL,
  `keluar_mulai` time NOT NULL,
  `keluar_akhir` time NOT NULL,
  `libur1` varchar(10) NOT NULL,
  `libur2` varchar(10) NOT NULL,
  `timezone` varchar(22) NOT NULL,
  `admin_uid` varchar(50) NOT NULL,
  `bot_token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_settings`
--

INSERT INTO `tb_settings` (`masuk_mulai`, `masuk_akhir`, `keluar_mulai`, `keluar_akhir`, `libur1`, `libur2`, `timezone`, `admin_uid`, `bot_token`) VALUES
('00:00:00', '08:15:00', '16:00:00', '20:30:00', 'Rabu', 'Minggu', 'Asia/Jakarta', '338D3735', '6751977753:AAEwU5UFhwBbeIfupfrr7xg4_Utmbrnxefk');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_id`
--
ALTER TABLE `tb_id`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tb_rfid`
--
ALTER TABLE `tb_rfid`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
