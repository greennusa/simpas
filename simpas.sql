-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2023 at 11:39 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpas`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(25) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `spesifikasi` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `status_barang` varchar(50) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `kategori_id`, `merek`, `spesifikasi`, `lokasi`, `status_barang`, `total`) VALUES
('BRG-0001', 'fsdfsd', 1, 'sfd', 'sdf', 'sdf', 'sf', 58);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Elektronik'),
(4, 'fsad'),
(11, 'W23423543fsddsfsf'),
(14, 'fsd'),
(16, 'gdf');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(200) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `semester` int(11) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `prodi`, `password`) VALUES
(3, 'Hadi', '123', 1, 'Gizi', '202cb962ac59075b964b07152d234b70'),
(4, 'Budi', '1234', 1, 'Farmasi', '81dc9bdb52d04dc20036dbd8313ed055'),
(5, 'Romeo', '12345', 2, 'Farmasi', '827ccb0eea8a706c4c34a16891f84e7b'),
(6, 'satu', '234', 6, 'MB', '202cb962ac59075b964b07152d234b70'),
(7, '4123', '32', 6, 'MB', '202cb962ac59075b964b07152d234b70'),
(8, '234', '564', 8, 'HI', '202cb962ac59075b964b07152d234b70'),
(9, 'Kaka', '321', 2, 'Gizi', 'caf1a3dfb505ffed0d024130f58c5cfa');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_barang`
--

CREATE TABLE `peminjaman_barang` (
  `id_peminjaman_barang` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `barang_kd` varchar(25) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `tujuan` text NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('Returned','Approved','Disapproved','Pending') DEFAULT 'Pending',
  `pj` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman_barang`
--

INSERT INTO `peminjaman_barang` (`id_peminjaman_barang`, `mahasiswa_id`, `barang_kd`, `jumlah_barang`, `tujuan`, `tanggal_peminjaman`, `tanggal_selesai`, `status`, `pj`, `created_at`, `user_id`) VALUES
(1, 3, 'BRG-0001', 2, 'acara', '2023-09-05', '2023-09-13', 'Approved', 'Pak Budi', '2023-09-10 09:36:36', 2);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_ruangan`
--

CREATE TABLE `peminjaman_ruangan` (
  `id_peminjaman_ruangan` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `tujuan` text NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('Approved','Disapproved','Pending') NOT NULL DEFAULT 'Pending',
  `pj` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman_ruangan`
--

INSERT INTO `peminjaman_ruangan` (`id_peminjaman_ruangan`, `mahasiswa_id`, `ruangan_id`, `tujuan`, `tanggal_peminjaman`, `tanggal_selesai`, `status`, `pj`, `created_at`, `user_id`) VALUES
(1, 3, 3, 'Acara', '2023-09-08', '2023-09-20', 'Approved', 'Pak Nanang', '2023-09-10 09:32:28', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `status` enum('Selesai','Pending') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `mahasiswa_id`, `judul`, `isi`, `status`, `created_at`, `user_id`) VALUES
(2, 3, 'judul', 'isi', 'Selesai', '2023-08-31 05:36:08', 2),
(3, 3, 'sdfs', 'huihui', 'Selesai', '2023-08-31 06:23:15', 2),
(4, 9, 'hehe', '123', 'Selesai', '2023-09-06 20:21:28', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `lokasi`) VALUES
(1, 'Lab', 'sdf'),
(3, 'Lab Komputer', 'lt 2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `level` enum('Super Admin','Admin') NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `level`, `password`) VALUES
(2, 'Super Admin', 'superadmin@email.com', 'superadmin', 'Super Admin', '202cb962ac59075b964b07152d234b70'),
(3, 'Admin', 'admin@email.com', 'admin', 'Admin', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  ADD PRIMARY KEY (`id_peminjaman_barang`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `barang_kd` (`barang_kd`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD PRIMARY KEY (`id_peminjaman_ruangan`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `ruangan_id` (`ruangan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  MODIFY `id_peminjaman_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  MODIFY `id_peminjaman_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  ADD CONSTRAINT `peminjaman_barang_ibfk_1` FOREIGN KEY (`barang_kd`) REFERENCES `barang` (`kd_barang`),
  ADD CONSTRAINT `peminjaman_barang_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `peminjaman_barang_ibfk_3` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id_mahasiswa`);

--
-- Constraints for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD CONSTRAINT `peminjaman_ruangan_ibfk_1` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id_ruangan`),
  ADD CONSTRAINT `peminjaman_ruangan_ibfk_2` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `peminjaman_ruangan_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `pengaduan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
