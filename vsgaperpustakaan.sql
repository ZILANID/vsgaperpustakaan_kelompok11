-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Agu 2022 pada 03.11
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vsgaperpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbanggota`
--

CREATE TABLE `tbanggota` (
  `id_anggota` varchar(5) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `foto` varchar(10) NOT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbanggota`
--

INSERT INTO `tbanggota` (`id_anggota`, `nama`, `foto`, `jenis_kelamin`, `alamat`, `status`) VALUES
('A001', 'ZILAN ID', 'A001.jpg', 'laki laki', 'Pesawaran - Lampung', 'Meminjam'),
('A002', 'Fildzah', 'A002.jpg', 'perempuan', '-', 'Tidak Meminjam'),
('A003', 'Maman', 'A003.jpg', 'laki laki', '-', 'Meminjam'),
('A004', 'Test01', 'A004.PNG', 'Pria', '-', 'Tidak Meminjam'),
('A005', 'Test02', 'A005.jpg', 'Pria', '-', 'Tidak Meminjam'),
('A006', 'Test03', 'A006.jpg', 'Pria', '-', 'Tidak Meminjam'),
('A007', 'Test04', 'A007.jpg', 'Wanita', '-', 'Tidak Meminjam'),
('A008', 'Test05', 'A008.jpg', 'Pria', '-', 'Tidak Meminjam'),
('A009', 'Test05', 'A009.jpg', 'Wanita', '-', 'Tidak Meminjam'),
('A010', 'Test05', 'A010.jpg', 'Pria', '-', 'Tidak Meminjam'),
('A011', 'fcdsafdasTest05', 'A011.jpg', 'Pria', '-', 'Tidak Meminjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbbuku`
--

CREATE TABLE `tbbuku` (
  `id_buku` varchar(5) NOT NULL,
  `judul_buku` varchar(75) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbbuku`
--

INSERT INTO `tbbuku` (`id_buku`, `judul_buku`, `kategori`, `penulis`, `penerbit`, `status`) VALUES
('B001', 'Belajar PHP', 'Pemograman', '-', 'Erlangga', 'Dipinjam'),
('B002', 'Laravel', 'Pemograman', 'Aminudin', 'Lokomedia', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbtransaksi`
--

CREATE TABLE `tbtransaksi` (
  `id_transaksi` varchar(5) NOT NULL,
  `id_anggota` varchar(5) NOT NULL,
  `id_buku` varchar(5) NOT NULL,
  `tanggal_pinjam` datetime NOT NULL,
  `tanggal_kembali` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbtransaksi`
--

INSERT INTO `tbtransaksi` (`id_transaksi`, `id_anggota`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
('T001', 'A001', 'B002', '2022-08-22 02:47:46', '2022-08-28 02:47:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbuser`
--

CREATE TABLE `tbuser` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbuser`
--

INSERT INTO `tbuser` (`id_user`, `username`, `email`, `password`, `level`, `created`) VALUES
(1, 'admin@perpus.com', 'admin@perpus.com', '202cb962ac59075b964b07152d234b70', 'Admin', NULL),
(2, 'admin2@perpus.com', 'admin2@perpus.com', '202cb962ac59075b964b07152d234b70', 'Admin', NULL),
(3, 'admin3@perpus.com', 'admin3@perpus.com', '202cb962ac59075b964b07152d234b70', 'Admin', NULL),
(4, 'anggota1@perpus.com', 'anggota1@perpus.com', '202cb962ac59075b964b07152d234b70', 'Anggota', NULL),
(5, 'anggota2@perpus.com', 'anggota2@perpus.com', '202cb962ac59075b964b07152d234b70', 'Anggota', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbanggota`
--
ALTER TABLE `tbanggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tbbuku`
--
ALTER TABLE `tbbuku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `tbtransaksi`
--
ALTER TABLE `tbtransaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
