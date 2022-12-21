-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2022 at 09:39 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penilaian_rekrutmen`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `alamat_email` varchar(50) DEFAULT NULL,
  `kata_sandi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_lengkap`, `nama_user`, `alamat_email`, `kata_sandi`) VALUES
(1, 'Chaerul Anwar', 'chanwar99', 'erulanwar93@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_tes_pelamar` int(11) DEFAULT NULL,
  `nilai_akhir` int(11) DEFAULT NULL,
  `nilai_maks` int(11) DEFAULT NULL,
  `nilai_persentase` double DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hasil`
--

INSERT INTO `tb_hasil` (`id_hasil`, `id_tes_pelamar`, `nilai_akhir`, `nilai_maks`, `nilai_persentase`, `keterangan`) VALUES
(11, 10, 4, 10, 40, 'Tidak Lulus'),
(12, 11, 3, 10, 30, 'Tidak Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelamar`
--

CREATE TABLE `tb_pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `nama_pelamar` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelamar`
--

INSERT INTO `tb_pelamar` (`id_pelamar`, `nama_pelamar`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat_email`) VALUES
(11, 'Adi Purnama', 'Pria', 'Kuningan', '1992-09-14', 'adi.purnama@widyatama.ac.id'),
(12, 'Chaerul Anwar', 'Pria', 'Bandung', '1999-05-30', 'erulanwar93@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE `tb_soal` (
  `id_soal` int(11) NOT NULL,
  `id_topik` int(11) DEFAULT NULL,
  `teks_soal` text,
  `pil_1` varchar(100) DEFAULT NULL,
  `pil_2` varchar(100) DEFAULT NULL,
  `pil_3` varchar(100) DEFAULT NULL,
  `pil_4` varchar(100) DEFAULT NULL,
  `kun_jaw` varchar(50) DEFAULT NULL,
  `poin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal`
--

INSERT INTO `tb_soal` (`id_soal`, `id_topik`, `teks_soal`, `pil_1`, `pil_2`, `pil_3`, `pil_4`, `kun_jaw`, `poin`) VALUES
(22, 3, 'HTML Merupakan singkatan dari ?', 'Hyper Link Markup Leaguage', 'Hyper Text Markup Laguage', 'Hyper Tool Markup Laguage', 'Hyper Test Markup Laguage', 'pil_2', '1'),
(23, 3, 'Untuk membuat baris baru menggunakan tag ?', '<br>', '<newline>', '<break>', ' <hr>', 'pil_1', '1'),
(24, 3, 'Sintak yang benar untuk menambah warna latar belakang?', '<body =’background:green’>', '<body style=’background-color:green’>', '<body color=’green’>', '<background>green</background>', 'pil_2', '1'),
(25, 3, 'Tag untuk membuat huruf tebal adalah', '<bold>', '<b>', '<i>', '<important>', 'pil_2', '1'),
(26, 3, 'Karakter yang digunakan untuk tag akhir ?', '<>', '/', '*', '\\', 'pil_2', '1'),
(27, 4, 'PHP Merupakan singkatan dari?', 'Private Home Page', 'Personal Hypertext Processor', 'PHP: Hypertext Processor', 'Program Hypertext Processor', 'pil_3', '1'),
(28, 4, 'Setiap variabel di PHP diawali dengan simbol?', '#', '$', '%', '*', 'pil_2', '1'),
(29, 4, 'Tipe data integer di PHP digunakan untuk data?', 'Bilangan bulat', 'Bilangan Pecahan', 'Boolean', 'NULL', 'pil_1', '1'),
(30, 4, 'Tipe data Boolean hanya memiliki nilai true dan false! Pernyataan ini', 'Benar', 'Salah', 'Jawaban a dan b benar', 'Tidak diketahui', 'pil_1', '1'),
(31, 4, 'Operator aritmatika digunakan untuk melakukan operasi?', 'Aritmatika', 'Pembanding', 'Relasi', 'Assignment', 'pil_1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tes`
--

CREATE TABLE `tb_tes` (
  `id_tes` int(11) NOT NULL,
  `judul_tes` varchar(100) DEFAULT NULL,
  `deskripsi_tes` text,
  `nilai_min_lulus` double DEFAULT NULL,
  `durasi_tes` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tes`
--

INSERT INTO `tb_tes` (`id_tes`, `judul_tes`, `deskripsi_tes`, `nilai_min_lulus`, `durasi_tes`) VALUES
(4, 'Baru', 'baru', 60, '01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tes_pelamar`
--

CREATE TABLE `tb_tes_pelamar` (
  `id_tes_pelamar` int(11) NOT NULL,
  `id_tes` int(11) DEFAULT NULL,
  `id_pelamar` int(11) DEFAULT NULL,
  `kode_tes` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tes_pelamar`
--

INSERT INTO `tb_tes_pelamar` (`id_tes_pelamar`, `id_tes`, `id_pelamar`, `kode_tes`, `status`) VALUES
(10, 4, 11, '2Y7vHco5', 'Selesai'),
(11, 4, 12, 'fVzcLMBH', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tes_topik`
--

CREATE TABLE `tb_tes_topik` (
  `id_tes_topik` int(11) NOT NULL,
  `id_tes` int(11) DEFAULT NULL,
  `id_topik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tes_topik`
--

INSERT INTO `tb_tes_topik` (`id_tes_topik`, `id_tes`, `id_topik`) VALUES
(7, 4, 3),
(8, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_topik`
--

CREATE TABLE `tb_topik` (
  `id_topik` int(11) NOT NULL,
  `judul_topik` varchar(100) DEFAULT NULL,
  `jmlh_topik_soal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_topik`
--

INSERT INTO `tb_topik` (`id_topik`, `judul_topik`, `jmlh_topik_soal`) VALUES
(3, 'HTML & CSS', 5),
(4, 'PHP', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_tes_pelamar` (`id_tes_pelamar`);

--
-- Indexes for table `tb_pelamar`
--
ALTER TABLE `tb_pelamar`
  ADD PRIMARY KEY (`id_pelamar`);

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_topik` (`id_topik`);

--
-- Indexes for table `tb_tes`
--
ALTER TABLE `tb_tes`
  ADD PRIMARY KEY (`id_tes`);

--
-- Indexes for table `tb_tes_pelamar`
--
ALTER TABLE `tb_tes_pelamar`
  ADD PRIMARY KEY (`id_tes_pelamar`),
  ADD KEY `id_tes` (`id_tes`),
  ADD KEY `id_pelamar` (`id_pelamar`);

--
-- Indexes for table `tb_tes_topik`
--
ALTER TABLE `tb_tes_topik`
  ADD PRIMARY KEY (`id_tes_topik`),
  ADD KEY `id_tes` (`id_tes`),
  ADD KEY `id_topik` (`id_topik`);

--
-- Indexes for table `tb_topik`
--
ALTER TABLE `tb_topik`
  ADD PRIMARY KEY (`id_topik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_pelamar`
--
ALTER TABLE `tb_pelamar`
  MODIFY `id_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_tes`
--
ALTER TABLE `tb_tes`
  MODIFY `id_tes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_tes_pelamar`
--
ALTER TABLE `tb_tes_pelamar`
  MODIFY `id_tes_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_tes_topik`
--
ALTER TABLE `tb_tes_topik`
  MODIFY `id_tes_topik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_topik`
--
ALTER TABLE `tb_topik`
  MODIFY `id_topik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD CONSTRAINT `FK_tb_hasil_tb_tes_pelamar` FOREIGN KEY (`id_tes_pelamar`) REFERENCES `tb_tes_pelamar` (`id_tes_pelamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD CONSTRAINT `FK_tb_soal_tb_topik` FOREIGN KEY (`id_topik`) REFERENCES `tb_topik` (`id_topik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_tes_pelamar`
--
ALTER TABLE `tb_tes_pelamar`
  ADD CONSTRAINT `FK_tb_tes_pelamar_tb_pelamar` FOREIGN KEY (`id_pelamar`) REFERENCES `tb_pelamar` (`id_pelamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tb_tes_pelamar_tb_tes` FOREIGN KEY (`id_tes`) REFERENCES `tb_tes` (`id_tes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_tes_topik`
--
ALTER TABLE `tb_tes_topik`
  ADD CONSTRAINT `FK_tb_tes_topik_tb_tes` FOREIGN KEY (`id_tes`) REFERENCES `tb_tes` (`id_tes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tb_tes_topik_tb_topik` FOREIGN KEY (`id_topik`) REFERENCES `tb_topik` (`id_topik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
