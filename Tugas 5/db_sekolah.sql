-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2026 at 02:14 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id_guru` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama`) VALUES
(1, 'Budi Santoso, S.Pd'),
(2, 'Siti Aminah, M.Si'),
(3, 'Joko Anwar, S.Kom');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE IF NOT EXISTS `mata_pelajaran` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `id_guru` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  PRIMARY KEY (`id_mapel`),
  KEY `id_guru` (`id_guru`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mapel`, `id_guru`, `nama_mapel`) VALUES
(1, 1, 'Matematika'),
(2, 2, 'Fisika'),
(3, 3, 'Pemrograman Web');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id_siswa` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `nilai_akhir` int(11) NOT NULL,
  PRIMARY KEY (`id_siswa`,`id_mapel`),
  KEY `id_mapel` (`id_mapel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_siswa`, `id_mapel`, `nilai_akhir`) VALUES
(1, 1, 85),
(1, 3, 90),
(2, 2, 88),
(3, 3, 95);

-- --------------------------------------------------------

--
-- Table structure for table `profil_siswa`
--

CREATE TABLE IF NOT EXISTS `profil_siswa` (
  `id_siswa` int(11) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_hp` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil_siswa`
--

INSERT INTO `profil_siswa` (`id_siswa`, `alamat`, `no_hp`) VALUES
(1, 'Jl. Merdeka No. 1, Padang', '081122334455'),
(2, 'Jl. Sudirman No. 5, Padang', '082233445566'),
(3, 'Jl. Gajah Mada No. 10, Padang', '083344556677');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_siswa`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama`, `email`) VALUES
(1, 'Andi Saputra', 'andi@mail.com'),
(2, 'Rina Melati', 'rina@mail.com'),
(3, 'Doni Wahyudi', 'doni@mail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
