-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2018 at 05:44 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lhr` date NOT NULL,
  `tmp_lhr` varchar(30) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `status` varchar(15) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `ket` varchar(15) NOT NULL,
  `saldo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `alamat`, `tgl_lhr`, `tmp_lhr`, `jk`, `status`, `no_tlp`, `ket`, `saldo`) VALUES
('A0001', 'Muhammad Ramdan', 'Bogor Barat', '1999-12-25', 'Bogor', 'L', 'AKTIF', '083811941421', 'Meminjam', 30000),
('A0002', 'Zidun', 'ciaiw', '1973-02-04', 'Bogor', 'L', 'AKTIF', '08342112', 'Meminjam', 30000),
('A0003', 'dun', 'vogor', '2016-11-30', 'Bogor', 'L', 'AKTIF', '12312', 'Meminjam', 60000),
('A0004', 'Muhammad Ramdan', 'Bogor', '1999-12-25', 'Bogor', 'L', 'AKTIF', '083811941421', 'Meminjam', 0),
('A0005', 'a', 'sdf', '2017-12-30', 'asdf', 'L', 'AKTIF', '083811941421', 'Meminjam', 0);

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE IF NOT EXISTS `angsuran` (
  `id_angsuran` varchar(10) NOT NULL,
  `id_kategori` varchar(5) NOT NULL,
  `id_anggota` varchar(5) NOT NULL,
  `id_petugas` varchar(5) NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `besar_angsuran` double NOT NULL,
  `denda` double NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`id_angsuran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_angsuran`
--

CREATE TABLE IF NOT EXISTS `detail_angsuran` (
  `id_detail_angsuran` varchar(5) NOT NULL,
  `id_angsuran` varchar(5) NOT NULL,
  `angsuran_ke` int(3) NOT NULL,
  `tgl_angsuran` date NOT NULL,
  `besar_angsuran` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_angsuran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pinjaman`
--

CREATE TABLE IF NOT EXISTS `kategori_pinjaman` (
  `id_kategori` varchar(5) NOT NULL,
  `nama_pinjaman` varchar(30) NOT NULL,
  `max_pinjaman` int(11) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_pinjaman`
--

INSERT INTO `kategori_pinjaman` (`id_kategori`, `nama_pinjaman`, `max_pinjaman`) VALUES
('K0001', 'Pinjaman Bisnis', 10000000),
('K0003', 'Pinjaman Ekonomi', 5000000),
('K0004', 'Pinjaman Personal', 3000000);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE IF NOT EXISTS `pengajuan` (
  `id_pengajuan` varchar(10) NOT NULL,
  `nama_jaminan` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `ktp` varchar(10) NOT NULL,
  `kk` varchar(10) NOT NULL,
  `ket` enum('Lengkap','Belum Lengkap','','') NOT NULL,
  PRIMARY KEY (`id_pengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `nama_jaminan`, `foto`, `ktp`, `kk`, `ket`) VALUES
('AJN00001', '', '', '', '', 'Belum Lengkap'),
('AJN00002', 'BPKB Motor', '', '1', '', 'Belum Lengkap'),
('AJN00003', 'BPKB MOTOR', '1449303360_youtube_circle.png', '1', '1', 'Lengkap'),
('AJN00004', '', '', '', '', 'Belum Lengkap'),
('AJN00005', 'motor', '1449302856_phone.png', '1', '1', 'Belum Lengkap');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE IF NOT EXISTS `petugas` (
  `id_petugas` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tmp_lhr` varchar(30) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `ket` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `akses` varchar(20) NOT NULL,
  PRIMARY KEY (`id_petugas`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `alamat`, `no_tlp`, `tmp_lhr`, `tgl_lhr`, `ket`, `username`, `password`, `akses`) VALUES
('P0001', 'Muhammad Radman', 'Bogor', '091231', 'Bogor', '1984-01-01', 'AKTIF', 'petugas', 'petugas123', 'PETUGAS'),
('P0002', 'Muhammad Ramdan', 'ciawi', '092123324234234', 'Bogor', '2000-11-15', 'AKTIF', 'kepala', 'kepala123', 'KEPALA PETUGAS');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE IF NOT EXISTS `pinjaman` (
  `id_pinjaman` varchar(10) NOT NULL,
  `id_pengajuan` varchar(10) NOT NULL,
  `id_kategori` varchar(5) NOT NULL,
  `id_anggota` varchar(5) NOT NULL,
  `besar_pinjaman` int(11) NOT NULL,
  `tgl_pengajuan_pinjaman` date NOT NULL,
  `tgl_acc_pinjaman` date NOT NULL,
  `tgl_pinjaman` date NOT NULL,
  `tgl_pelunasan` date NOT NULL,
  `id_angsuran` varchar(5) NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`id_pinjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `id_pengajuan`, `id_kategori`, `id_anggota`, `besar_pinjaman`, `tgl_pengajuan_pinjaman`, `tgl_acc_pinjaman`, `tgl_pinjaman`, `tgl_pelunasan`, `id_angsuran`, `ket`) VALUES
('PJN00001', 'AJN00001', 'K0001', 'A0002', 10000000, '2018-01-11', '0000-00-00', '0000-00-00', '0000-00-00', '', 'Disetujui'),
('PJN00002', 'AJN00002', 'K0003', 'A0001', 4000000, '2018-01-11', '0000-00-00', '0000-00-00', '0000-00-00', '', 'Meminjam'),
('PJN00003', 'AJN00003', 'K0003', 'A0003', 4000000, '2018-01-14', '0000-00-00', '0000-00-00', '0000-00-00', '', 'Pending'),
('PJN00004', 'AJN00004', 'K0004', 'A0005', 2500000, '2018-01-14', '0000-00-00', '0000-00-00', '0000-00-00', '', 'Ditolak'),
('PJN00005', 'AJN00005', 'K0003', 'A0004', 3500000, '2018-01-14', '0000-00-00', '0000-00-00', '0000-00-00', '', 'Lengkapi Persyaratan');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE IF NOT EXISTS `simpanan` (
  `id_simpanan` varchar(10) NOT NULL,
  `nm_simpanan` varchar(30) NOT NULL,
  `id_anggota` varchar(5) NOT NULL,
  `tgl_simpanan` date NOT NULL,
  `besar_simpanan` int(11) NOT NULL,
  `ket` text,
  PRIMARY KEY (`id_simpanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id_simpanan`, `nm_simpanan`, `id_anggota`, `tgl_simpanan`, `besar_simpanan`, `ket`) VALUES
('S0002', 'Simpanan Wajib', 'A0003', '2017-12-14', 30000, NULL),
('S0003', 'Simpanan Wajib', 'A0003', '2018-01-09', 30000, NULL),
('S0004', 'Simpanan Wajib', 'A0002', '2018-01-10', 30000, NULL),
('S0005', 'Simpanan Wajib', 'A0001', '2018-01-11', 30000, NULL);

--
-- Triggers `simpanan`
--
DROP TRIGGER IF EXISTS `hapus_simpanan`;
DELIMITER //
CREATE TRIGGER `hapus_simpanan` AFTER DELETE ON `simpanan`
 FOR EACH ROW UPDATE anggota SET saldo = saldo-OLD.besar_simpanan WHERE id_anggota = OLD.id_anggota
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tambah_simpanan`;
DELIMITER //
CREATE TRIGGER `tambah_simpanan` AFTER INSERT ON `simpanan`
 FOR EACH ROW UPDATE anggota SET saldo = saldo+NEW.besar_simpanan WHERE id_anggota = NEW.id_anggota
//
DELIMITER ;
DROP TRIGGER IF EXISTS `ubah_simpanan`;
DELIMITER //
CREATE TRIGGER `ubah_simpanan` AFTER UPDATE ON `simpanan`
 FOR EACH ROW UPDATE anggota SET saldo = (saldo-OLD.besar_simpanan)+ NEW.besar_simpanan WHERE id_anggota = NEW.id_anggota
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
