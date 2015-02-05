-- phpMyAdmin SQL Dump
-- version 4.2.10.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2015 at 12:13 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `latansa`
--

-- --------------------------------------------------------

--
-- Table structure for table `bendahara1`
--

CREATE TABLE IF NOT EXISTS `bendahara1` (
  `nomor` int(2) NOT NULL,
  `pangkal` double DEFAULT NULL,
  `spp` double DEFAULT NULL,
  `buku_smp` double DEFAULT NULL,
  `buku_ext` double NOT NULL,
  `kalender` double DEFAULT NULL,
  `kasur` double DEFAULT NULL,
  `lemari` double DEFAULT NULL,
  `kaospa` double DEFAULT NULL,
  `kaospi` double NOT NULL,
  `osis` double DEFAULT NULL,
  `osispi` double NOT NULL,
  `jubah` double DEFAULT NULL,
  `ramadhan` double DEFAULT NULL,
  `tawab` double DEFAULT NULL,
  `total_pa_sd` double DEFAULT NULL,
  `total_pi_sd` double NOT NULL,
  `total_pa_smp` double NOT NULL,
  `total_pi_smp` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bendahara1`
--

INSERT INTO `bendahara1` (`nomor`, `pangkal`, `spp`, `buku_smp`, `buku_ext`, `kalender`, `kasur`, `lemari`, `kaospa`, `kaospi`, `osis`, `osispi`, `jubah`, `ramadhan`, `tawab`, `total_pa_sd`, `total_pi_sd`, `total_pa_smp`, `total_pi_smp`) VALUES
(1, 7000000, 800000, 1400000, 1200000, 150000, 325000, 430000, 815000, 855000, 500000, 500000, 125000, 550000, 220000, 12315000, 12230000, 12115000, 12030000);

-- --------------------------------------------------------

--
-- Table structure for table `bta1`
--

CREATE TABLE IF NOT EXISTS `bta1` (
`nomor` int(2) NOT NULL,
  `idsiswa` int(3) DEFAULT NULL,
  `pangkal` double DEFAULT NULL,
  `spp` double DEFAULT NULL,
  `buku` double DEFAULT NULL,
  `kalender` double DEFAULT NULL,
  `kasur` double DEFAULT NULL,
  `lemari` double DEFAULT NULL,
  `kaos` double DEFAULT NULL,
  `osis` double DEFAULT NULL,
  `jubah` double DEFAULT NULL,
  `ramadhan` double DEFAULT NULL,
  `tawab` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `sisa` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bta1`
--

INSERT INTO `bta1` (`nomor`, `idsiswa`, `pangkal`, `spp`, `buku`, `kalender`, `kasur`, `lemari`, `kaos`, `osis`, `jubah`, `ramadhan`, `tawab`, `total`, `sisa`) VALUES
(1, 1, 3500000, 400000, 700000, 75000, 162500, 215000, 407500, 250000, 62500, 275000, 110000, 6157500, 6157500),
(2, 2, 3500000, 400000, 700000, 75000, 162500, 215000, 427500, 250000, 0, 275000, 110000, 6115000, 6115000),
(3, 3, 3500000, 400000, 600000, 75000, 162500, 215000, 407500, 250000, 62500, 275000, 110000, 6057500, 6057500),
(4, 4, 3500000, 400000, 600000, 75000, 162500, 215000, 427500, 250000, 0, 275000, 110000, 6015000, 6015000),
(5, 5, 3500000, 400000, 700000, 75000, 162500, 100000, 407500, 250000, 62500, 275000, 110000, 6042500, 6272500);

-- --------------------------------------------------------

--
-- Table structure for table `bta2`
--

CREATE TABLE IF NOT EXISTS `bta2` (
`nomor` int(2) NOT NULL,
  `idsiswa` int(3) DEFAULT NULL,
  `pangkal` double DEFAULT NULL,
  `spp` double DEFAULT NULL,
  `buku` double DEFAULT NULL,
  `kalender` double DEFAULT NULL,
  `kasur` double DEFAULT NULL,
  `lemari` double DEFAULT NULL,
  `kaos` double DEFAULT NULL,
  `osis` double DEFAULT NULL,
  `jubah` double DEFAULT NULL,
  `ramadhan` double DEFAULT NULL,
  `tawab` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `sisa` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bta2`
--

INSERT INTO `bta2` (`nomor`, `idsiswa`, `pangkal`, `spp`, `buku`, `kalender`, `kasur`, `lemari`, `kaos`, `osis`, `jubah`, `ramadhan`, `tawab`, `total`, `sisa`) VALUES
(1, 5, 3500000, 200000, 700000, 75000, 162500, 330000, 407500, 250000, 62500, 275000, 110000, 6072500, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
`idsiswa` int(2) NOT NULL,
  `namasiswa` varchar(50) NOT NULL,
  `jk` enum('pa','pi') NOT NULL,
  `jenis` enum('smp','sma') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`idsiswa`, `namasiswa`, `jk`, `jenis`) VALUES
(1, 'Reza Nurfachmi Jr.', 'pa', 'smp'),
(2, 'Narulita Jr.', 'pi', 'smp'),
(3, 'Reza Nurfachmi Sr.', 'pa', 'sma'),
(4, 'Narulita Sr.', 'pi', 'sma'),
(5, 'Rizal Ghifari', 'pa', 'smp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bendahara1`
--
ALTER TABLE `bendahara1`
 ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `bta1`
--
ALTER TABLE `bta1`
 ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `bta2`
--
ALTER TABLE `bta2`
 ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`idsiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bta1`
--
ALTER TABLE `bta1`
MODIFY `nomor` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bta2`
--
ALTER TABLE `bta2`
MODIFY `nomor` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
MODIFY `idsiswa` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
