-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 09:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sigereja`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galeri`
--

CREATE TABLE `tbl_galeri` (
  `kd_ibadah` varchar(20) NOT NULL,
  `nama_ibadah` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `foto` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_galeri`
--

INSERT INTO `tbl_galeri` (`kd_ibadah`, `nama_ibadah`, `tanggal`, `keterangan`, `foto`) VALUES
('SEKOLAH MINGGU', 'Natal Sekolah Minggu 2024', '2024-12-14', '', 0x66326438356135326562383366336531393161343564356438656132356161642e6a7067),
('PEBUZA', 'Natal PEBUZA & REBUZA 2024', '2024-12-15', '', 0x32663339653239303536373262356564623630363262353261356539356332382e6a7067),
('PRIBUZA', 'Ibadah di rumah Pak Pdt. Johny', '2025-05-30', '', 0x36303130346163653263303736323638346235306366636431353264363162332e6a7067),
('PERSEKUTUAN DOA', 'Persekutuan Doa Pebuza & Rebuza event PRP', '2025-04-02', '', 0x30633334386335333666393438333735396466316361316632313730643530342e6a7067),
('WABUZA', 'Ibadah Padang di Singkawang 2024', '2024-11-23', '', 0x65306130666366386162393963643130323966313634616436353464393238342e6a7067),
('REBUZA', 'Natal PEBUZA & REBUZA 2024', '2024-12-15', '', 0x62373933343135633531326434303463363830393264653463333261626331312e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `kd_jadwal` varchar(10) NOT NULL,
  `nama_ibadah` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jam_ibadah` time(1) NOT NULL,
  `hari_ibadah` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`kd_jadwal`, `nama_ibadah`, `keterangan`, `jam_ibadah`, `hari_ibadah`) VALUES
('PDBZ', 'PD', 'PD atau Persekutuan Doa Gereja PPIK Bukit Zaitun Pontianak', '18:30:00.0', 'Rabu'),
('PEBZ', 'PEBUZA', 'Persekutuan Pemuda/i Gereja PPIK Bukit Zaitun Pontianak', '18:30:00.0', 'Minggu'),
('PRIBZ', 'PRIBUZA', 'Persekutuan Pria Gereja PPIK Bukit Zaitun Pontianak', '19:00:00.0', 'Selasa'),
('REBZ', 'REBUZA', 'Persekutuan Remaja Gereja PPIK Bukit Zaitun Pontianak', '19:00:00.0', 'Sabtu'),
('SMBZ', 'SEKOLAH MINGGU', 'Persekutuan Sekolah Minggu Gereja PPIK Bukit Zaitun Pontianak', '10:30:00.0', 'Minggu'),
('WABZ', 'WABUZA', 'Persekutuan Wanita Gereja PPIK Bukit Zaitun Pontianak', '19:00:00.0', 'Jumat');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(5) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `email`) VALUES
(1, 'imnotjey', 'admin321', 'admin', 'bgjeeminzZ@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`kd_jadwal`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
