-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2020 at 01:43 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbt`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `dashboard_peserta`
-- (See below for the actual view)
--
CREATE TABLE `dashboard_peserta` (
`id` int(11)
,`mahasiswa_id` int(11)
,`box` char(0)
,`total` decimal(10,2)
,`title` varchar(200)
,`icon` char(0)
,`url` char(0)
,`matkul_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nip` char(12) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `matkul_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nip`, `nama_dosen`, `email`, `matkul_id`) VALUES
(1, '12345678', 'irawati', 'irawati@email.com', 2);

--
-- Triggers `dosen`
--
DELIMITER $$
CREATE TRIGGER `edit_user_dosen` BEFORE UPDATE ON `dosen` FOR EACH ROW UPDATE `users` SET `email` = NEW.email, `username` = NEW.nip WHERE `users`.`username` = OLD.nip
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_user_dosen` BEFORE DELETE ON `dosen` FOR EACH ROW DELETE FROM `users` WHERE `users`.`username` = OLD.nip
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'dosen', 'Pembuat Soal dan ujian'),
(3, 'mahasiswa', 'Peserta Ujian');

-- --------------------------------------------------------

--
-- Table structure for table `h_ujian`
--

CREATE TABLE `h_ujian` (
  `id` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `list_soal` longtext NOT NULL,
  `list_jawaban` longtext NOT NULL,
  `jml_benar` int(11) NOT NULL,
  `nilai` decimal(10,2) NOT NULL,
  `nilai_bobot` decimal(10,2) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `review` enum('Y','N') DEFAULT NULL,
  `twk` decimal(10,0) DEFAULT NULL,
  `tiu` decimal(10,0) DEFAULT NULL,
  `tkp` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `h_ujian`
--

INSERT INTO `h_ujian` (`id`, `ujian_id`, `mahasiswa_id`, `list_soal`, `list_jawaban`, `jml_benar`, `nilai`, `nilai_bobot`, `tgl_mulai`, `tgl_selesai`, `status`, `review`, `twk`, `tiu`, `tkp`) VALUES
(31, 6, 1, '1,2,3,5,6,7,8,9,10,11', '1:B:N,2:A:N,3:D:N,5:C:N,6:D:N,7:D:N,8:B:N,9:A:N,10:B:N,11:B:N', 9, '45.00', '45.00', '2020-07-15 08:16:04', '2020-07-15 09:46:04', 'N', NULL, NULL, NULL, NULL),
(52, 9, 1, '3,35,38,16,1,49,37,9,51,10,8,40,48,7,2,5,41,45,6,36,44,39,46,42,11,50,12,47,15,43,70,69,56,65,64,53,79,80,77,61,82,85,87,81,60,76,55,67,63,78,59,68,73,58,57,54,62,74,83,66,72,86,84,75,71,92,89,97,104,112,108,111,110,117,95,121,120,114,88,90,115,116,101,94,107,93,91,102,109,118,98,105,106,100,122,99,96,103,113,119', '3:C:N,35:B:N,38:C:N,16:D:N,1:D:N,49:C:N,37:C:N,9:B:N,51:A:N,10:D:N,8:D:N,40:A:N,48:B:N,7:C:N,2:C:N,5:A:N,41:E:N,45:A:N,6:A:N,36:C:N,44:D:N,39:D:N,46:D:N,42:D:N,11:E:N,50:C:N,12:A:N,47:B:N,15:A:N,43:B:N,70:E:N,69:A:N,56:E:N,65:A:N,64:E:N,53::N,79::N,80::N,77::N,61::N,82::N,85::N,87::N,81::N,60::N,76::N,55::N,67::N,63::N,78::N,59::N,68::N,73::N,58::N,57::N,54::N,62::N,74::N,83::N,66::N,72::N,86::N,84::N,75::N,71::N,92::N,89::N,97::N,104::N,112::N,108::N,111::N,110::N,117::N,95::N,121::N,120::N,114::N,88::N,90::N,115::N,116::N,101::N,94::N,107::N,93::N,91::N,102::N,109::N,118::N,98::N,105::N,106::N,100::N,122::N,99::N,96::N,103::N,113::N,119:A:N', 36, '180.00', '180.00', '2020-07-19 22:39:30', '2020-07-23 00:09:30', 'N', 'Y', NULL, NULL, NULL),
(62, 7, 1, '50,7,40,45,51,11,3,8,5,35,44,1,46,15,38,39,36,43,37,47,52,16,12,42,41,2,9,48,10,49,61,59,54,86,74,75,58,77,62,73,57,72,76,87,69,71,85,83,60,84,80,66,56,81,55,82,53,67,79,78,65,70,63,64,68,101,102,117,103,115,109,107,118,95,99,91,88,113,93,120,96,105,94,111,98,104,110,114,116,106,108,97,112,89,119,121,92,122,90,100', '50:D:N,7:C:N,40:A:N,45:A:N,51:A:N,11:E:N,3:C:N,8:D:N,5:A:N,35:B:N,44:D:N,1:D:N,46:D:N,15:A:N,38:C:N,39:D:N,36:C:N,43:B:N,37:C:N,47:B:N,52:E:N,16:D:N,12:A:N,42:D:N,41:E:N,2:C:N,9:B:N,48:B:N,10:D:N,49:C:N,61:C:N,59:B:N,54:B:N,86:A:N,74:A:N,75:D:N,58:A:N,77:D:N,62:A:N,73:B:N,57:D:N,72:C:N,76:C:N,87:D:N,69:A:N,71:B:N,85:C:N,83:B:N,60:C:N,84:E:N,80:A:N,66:C:N,56:E:N,81:B:N,55:B:N,82:C:N,53:C:N,67:A:N,79:E:N,78:B:N,65:A:N,70:E:N,63:D:N,64:E:N,68:D:N,101:B:N,102:B:N,117:D:N,103:A:N,115:D:N,109:B:N,107:A:N,118:B:N,95:B:N,99:E:N,91:A:N,88:D:N,113:E:N,93:B:N,120:C:N,96:B:N,105:D:N,94:E:N,111:D:N,98:D:N,104:A:N,110:E:N,114:A:N,116:D:N,106:D:N,108:D:N,97:B:N,112:A:N,89:B:N,119:A:N,121:B:N,92:A:N,122:D:N,90:C:N,100:D:N', 97, '487.00', '487.00', '2020-07-20 23:03:13', '2020-07-23 00:33:13', 'N', 'Y', '145', '170', '172'),
(63, 6, 2, '50,7,40,45,51,11,3,8,5,35,44,1,46,15,38,39,36,43,37,47,52,16,12,42,41,2,9,48,10,49,61,59,54,86,74,75,58,77,62,73,57,72,76,87,69,71,85,83,60,84,80,66,56,81,55,82,53,67,79,78,65,70,63,64,68,101,102,117,103,115,109,107,118,95,99,91,88,113,93,120,96,105,94,111,98,104,110,114,116,106,108,97,112,89,119,121,92,122,90,100', '50:C:N,7:C:N,40:C:N,45::N,51::N,11::N,3::N,8::N,5::N,35::N,44::N,1::N,46::N,15::N,38::N,39::N,36::N,43::N,37::N,47::N,52::N,16::N,12::N,42::N,41::N,2::N,9::N,48::N,10::N,49::N,61:D:N,59:B:N,54:A:N,86::N,74::N,75::N,58::N,77::N,62::N,73::N,57::N,72::N,76::N,87::N,69::N,71::N,85::N,83::N,60::N,84::N,80::N,66::N,56::N,81::N,55::N,82::N,53::N,67::N,79::N,78::N,65::N,70::N,63::N,64::N,68::N,101::N,102::N,117::N,103::N,115::N,109::N,107::N,118::N,95::N,99::N,91::N,88::N,113::N,93::N,120::N,96::N,105::N,94::N,111::N,98::N,104::N,110::N,114::N,116::N,106::N,108::N,97::N,112::N,89::N,119::N,121:B:N,92:A:N,122:D:N,90:C:N,100:A:N', 8, '41.00', '41.00', '2020-07-21 17:19:47', '2020-07-23 18:49:47', 'N', 'Y', '10', '10', '21'),
(64, 8, 1, '134,127,138,133,149,145,130,143,125,123,128,141,142,139,148,126,150,140,131,135,144,136,132,147,129,137', '134:A:N,127:C:N,138:C:N,133:B:N,149:D:N,145:B:N,130:B:N,143:D:N,125:A:N,123:A:N,128:A:N,141:A:N,142:B:N,139:C:N,148:D:N,126:A:N,150:B:N,140:C:N,131:B:N,135:A:N,144:A:N,136:A:N,132:B:N,147:A:N,129:B:N,137:A:N', 12, '60.00', '60.00', '2020-07-22 13:26:20', '2020-07-22 14:56:20', 'N', 'Y', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int(11) NOT NULL,
  `tipe` varchar(10) DEFAULT NULL,
  `jumlah` varchar(10) DEFAULT NULL,
  `id_matkul` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `tipe`, `jumlah`, `id_matkul`) VALUES
(1, 'TWK', '30', 2),
(2, 'TIU', '35', 2),
(3, 'TKP', '35', 2),
(4, 'SKB', '100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Paket Materi'),
(2, 'Paket Tryout'),
(3, 'Paket Bimbel');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan_matkul`
--

CREATE TABLE `jurusan_matkul` (
  `id` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jurusan_matkul`
--

INSERT INTO `jurusan_matkul` (`id`, `matkul_id`, `jurusan_id`) VALUES
(15, 2, 3),
(16, 2, 1),
(17, 2, 2),
(18, 1, 3),
(19, 1, 1),
(20, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(30) NOT NULL,
  `jurusan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `jurusan_id`) VALUES
(1, 'Kls. Paket Soal', 1),
(2, 'Kls. Paket Tryout', 2),
(3, 'Kls. Paket Bimbel', 3);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_dosen`
--

CREATE TABLE `kelas_dosen` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas_dosen`
--

INSERT INTO `kelas_dosen` (`id`, `kelas_id`, `dosen_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(3, '::1', '12183018', 1595472877);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` char(20) NOT NULL,
  `email` varchar(254) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `kelas_id` int(11) NOT NULL COMMENT 'kelas&jurusan',
  `id_matkul` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama`, `nim`, `email`, `jenis_kelamin`, `kelas_id`, `id_matkul`) VALUES
(1, 'sugik', '1630511000', 'copycut7@gmail.com', 'L', 3, 2),
(2, 'arfan', '12345677', 'arfan@email.com', 'L', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(11) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `nama_matkul`) VALUES
(1, 'SKB'),
(2, 'SKD');

-- --------------------------------------------------------

--
-- Table structure for table `m_dokumen`
--

CREATE TABLE `m_dokumen` (
  `id_dokumen` int(255) NOT NULL,
  `nama_dokumen` varchar(255) DEFAULT NULL,
  `id_jenis` int(255) DEFAULT NULL,
  `id_matkul` int(255) DEFAULT NULL,
  `file_dokumen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_dokumen`
--

INSERT INTO `m_dokumen` (`id_dokumen`, `nama_dokumen`, `id_jenis`, `id_matkul`, `file_dokumen`) VALUES
(2, 'Soal-CPNS-Paket-1', 2, 2, 'Soal-CPNS-Paket-1.pdf'),
(3, 'Soal-CPNS-Paket-2', 2, 2, 'Soal-CPNS-Paket-2.pdf'),
(4, 'Soal-CPNS-Paket-3', 2, 2, 'Soal-CPNS-Paket-3.pdf'),
(5, 'Soal-CPNS-Paket-4', 2, 2, 'Soal-CPNS-Paket-4.pdf'),
(6, 'Soal-CPNS-Paket-5', 2, 2, 'Soal-CPNS-Paket-5.pdf'),
(7, 'Soal-CPNS-Paket-6', 2, 2, 'Soal-CPNS-Paket-6.pdf'),
(8, 'Soal-CPNS-Paket-7', 2, 2, 'Soal-CPNS-Paket-7.pdf'),
(9, '4560_DOC-20170922-WA0005', 2, 2, '4560_DOC-20170922-WA0005.pdf'),
(10, 'Soal CPNS All New Tes CPNS 2018', 2, 2, 'Soal CPNS All New Tes CPNS 2018.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `m_ujian`
--

CREATE TABLE `m_ujian` (
  `id_ujian` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `nama_ujian` varchar(200) NOT NULL,
  `jumlah_soal` int(11) NOT NULL,
  `waktu` int(11) NOT NULL,
  `jenis` enum('acak','urut') NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `terlambat` datetime NOT NULL,
  `token` varchar(5) NOT NULL,
  `terbit` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_ujian`
--

INSERT INTO `m_ujian` (`id_ujian`, `dosen_id`, `matkul_id`, `nama_ujian`, `jumlah_soal`, `waktu`, `jenis`, `tgl_mulai`, `terlambat`, `token`, `terbit`) VALUES
(6, 1, 2, 'Paket SKD 1', 100, 90, 'acak', '2020-07-14 23:52:56', '2020-07-25 23:53:02', 'EGTVS', 1),
(7, 1, 2, 'Paket SKD 2', 100, 90, 'acak', '2020-07-18 16:09:23', '2020-07-31 16:09:30', 'EKJTD', 1),
(8, 1, 1, 'Paket SKB 1', 100, 90, 'acak', '2020-07-19 20:04:39', '2020-07-31 20:04:45', 'TQLVQ', 1),
(9, 1, 2, 'Paket SKD 3', 100, 90, 'acak', '2020-07-19 22:38:34', '2020-07-31 22:38:36', 'QKJOC', 0),
(10, 1, 1, 'Paket SKB 2', 100, 90, 'acak', '2020-07-23 07:23:51', '2020-07-31 07:23:54', 'EGJSO', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE `tb_soal` (
  `id_soal` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `bobot` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tipe_file` varchar(50) NOT NULL,
  `soal` longtext NOT NULL,
  `opsi_a` longtext NOT NULL,
  `opsi_b` longtext NOT NULL,
  `opsi_c` longtext NOT NULL,
  `opsi_d` longtext NOT NULL,
  `opsi_e` longtext NOT NULL,
  `file_a` varchar(255) NOT NULL,
  `file_b` varchar(255) NOT NULL,
  `file_c` varchar(255) NOT NULL,
  `file_d` varchar(255) NOT NULL,
  `file_e` varchar(255) NOT NULL,
  `jawaban` varchar(40) NOT NULL,
  `created_on` int(11) NOT NULL,
  `updated_on` int(11) DEFAULT NULL,
  `tipe` varchar(10) DEFAULT NULL,
  `id_ujian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_soal`
--

INSERT INTO `tb_soal` (`id_soal`, `dosen_id`, `matkul_id`, `bobot`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `file_a`, `file_b`, `file_c`, `file_d`, `file_e`, `jawaban`, `created_on`, `updated_on`, `tipe`, `id_ujian`) VALUES
(1, 1, 2, 5, '', '', 'Pemerintah didasarkan atas sistem konstitusi (hukum dasar). Dapat disimpulkan bahwa pemerintah tidak bersifat absolutisme. Yang dimaksud dengan absolutisme adalah kekuasaan yang D', 'Terbatas', 'Sangat terbatas', ' Tidak terlalu terbatas', 'Tidak terbatas', 'Terlalu terbatas', '', '', '', '', '', 'D', 1550225760, 1550225760, '1', 7),
(2, 1, 2, 5, '', '', 'Presiden adalah bagian penyelenggara pemerintah Negara yang tertinggi. Meskpun demikian, kedudukan presiden berada di bawah… C', 'Ketua MPR', 'Ketua DPR', 'MPR', 'DPR', 'Partai politik', '', '', '', '', '', 'C', 1550225952, 1550225952, '1', 7),
(3, 1, 2, 5, '', '', 'Presiden sebagai Kepala Negara tidak bertanggungjawab kepada Dewan Perwakilan Rakyat. Namun, Presiden juga bukan “diktator”. Pernyataan tersebut dapat berarti… C', ' Kekuasaan Presiden terbatas', 'Kekuasaan Presiden tidak terbatas', ' Kekuasaan Presiden tidak tak terbatas', 'Kekuasaan Presiden Kurang Terbatas', 'Semua jawaban salah', '', '', '', '', '', 'C', 1550226174, 1550226174, '1', 7),
(5, 1, 2, 5, '', '', 'Bagian batang tubuh UUD 1945 memiliki keterkaitan dengan Pembukaan. Pada hakikatnya, bagian batang tubuh adalah… A', 'Penjabaran rinci pokok-pokok pikiran dari pembukaan', 'Norma-norma dasar kehidupan bernegara bagi bangsa Indonesia', 'Dua dokumen historis dalam kehidupan berbangsa dan bernegara bangsa Indonesia', 'Penjabaran seluruh konsepsi tentang Negara yang terkandung dalam Pembukaan', 'Dasar negara', '', '', '', '', '', 'A', 1550289702, 1594945554, '1', 7),
(6, 1, 2, 5, '', '', 'Ciri utama yang membedakan antara negara kesatuan dengan negara serikat adalah… A', 'Negara kesatuan memiliki konstitusi yang tertulis', 'Negara kesatuan memiliki kepala negara yang dipilih rakyat', 'Pemerintahaan Negara kesatuan bersifat demokratis', 'Negara kesatuan terbagi-bagi dalam bagian-bagian negara', 'Negara Kesatuan Bersifat Otoriter', '', '', '', '', '', 'A', 1550289774, 1550289774, '1', 7),
(7, 1, 2, 5, '', '', 'Berikut ini merupakan cakupan pada bidang hukum privat, kecuali… C', 'Pengadaan perjanjian jual beli sepetak tanah', 'Seseorang tidak menepati perjanjian menyewa rumah', 'Tindakan menipu orang lain secara sengaja', 'Penuntutan hak waris dari orang tua', 'Berjualan Online', '', '', '', '', '', 'C', 1578922768, 1594646990, '1', 7),
(8, 1, 2, 5, '', '', 'Mahkamah Agung (MA) memiliki hak untuk menguji peraturan perundang-undangan yang berlaku. Hal tersebut berlaku kecuali pada… D', 'Peraturan Pemerintah', 'Keputusan Presiden', 'Keputusan Menteri', 'Peraturan Daerah', 'Peraturan Wilayah', '', '', '', '', '', 'D', 1578922867, 1594724004, '1', 7),
(9, 1, 2, 5, '', '', 'Pada pasal 118 ayat 1 Konstitusi Republik Indonesia Serikat, dinyatakan bahwa kedudukan Presiden tidak dapat diganggu gugat. Pernyataan tersebut mengandung makna bahwa Presiden… B', ' Memiliki kekuasaan yang cukup luas', 'Berkedudukan sebagai kepala Negara', 'Berkedudukan sebagai kepala pemerintahan', 'Merupakan lembaga tertinggi Negara', 'Berkedudukan sebagai perdana menteri', '', '', '', '', '', 'B', 1594644191, 1594912450, '1', 7),
(10, 1, 2, 5, '', '', 'Berdasarkan peraturan perundang-undangan yang berlaku, di antara orang-orang berikut yang berstatus sebagai Warga Negara Indonesia adalah… D', 'Wanita Indonesia yang menikah dengan laki-laki Warga Negara Asing', 'Seseorang yang diangkat sebagai anak oleh Warga Negara Asing', 'Orang Indonesia yang tinggal di luar negeri selama tiga tahun', 'Wanita asing yang putus perkawinan dengan laki-laki Indonesia', 'Wanita asing yang putus perkawinan dengan laki-laki Indonesia', '', '', '', '', '', 'D', 1594658293, 1594723907, '1', 7),
(11, 1, 2, 5, '', '', 'Tindakan paksa mengeluarkan Orang Asing dari Wilayah Indonesia disebut dengan E', 'Extradisi', 'Remunerasi', 'Suaka', 'Transgenerasi', 'Deportasi', '', '', '', '', '', 'E', 1594725942, 1594725942, '1', 7),
(12, 1, 2, 5, '', '', 'Suku Mentawai mendiami daerah.. A', 'Sumatera Barat', 'Riau', 'Sumatera Selatan', 'Kalimantan Timur', 'Kalimantan Barat', '', '', '', '', '', 'A', 1594733674, 1594795514, '1', 7),
(15, 1, 2, 5, '', '', 'Ibukota negara Indonesia sempat dipindahkan ke Yogyakarta pada tanggal.. A', '4 Januari 1946', '14 Januari 1946', '4 Januari 1947', '14 Januari 1947', '11 Januari 1948', '', '', '', '', '', 'A', 0, 0, '1', 7),
(16, 1, 2, 5, '', '', 'Panitia Pemilu Pusat 2009 adalah ... D', 'KPK', 'MPR', 'DPR', 'KPU', 'PRESIDEN', '', '', '', '', '', 'D', 0, 0, '1', 7),
(35, 1, 2, 5, '', '', 'Sistem pemerintahan Indonesia pada masa negara Indonesia Serikat yang dipimpin oleh perdana menteri, hal itu menunjukkan sistem pemerintahannya adalah ....\r\n B', 'Presidensial', 'Parlementer', 'Perdana Menteri', 'Ekstra Parlementer', 'Konstitusiaonal\r\n\r\n\r\nArtikel ini telah tayang di tribun-timur.com dengan judul 30 Contoh Soal TWK SKD CPNS 2019 Resmi dari Portal CAT BKN, Lengkap dengan Jawaban dan Pembahasan, https://makassar.tribunnews.com/2020/01/26/30-contoh-soal-twk-skd-cpns-2019-resmi-dari-portal-cat-bkn-lengkap-dengan-jawaban-dan-pembahasan?page=4.\r\n\r\nEditor: Sakinah Sudin', '', '', '', '', '', 'B', 1594795839, 1594797036, '1', 7),
(36, 1, 2, 5, '', '', 'Dalam kebijakan nasional, pejabat pemerintah tingkat daerah (lokal) berkewajiban menetapkan kebijakan C', 'Sosial ekonomi', 'Politik', 'Teknis operasional', 'Eksekutif', 'Administratif', '', '', '', '', '', 'C', 1594796705, 1594804889, '1', 7),
(37, 1, 2, 5, '', '', 'Suatu Konsepsi yang eksplisit khas dari perorangan atau kelompok mengenai sesuatu yang didambakan merupakan pengertian dari nilai menurut .... C', 'Max Scheller', 'Nursal Luth', 'Kluckhoorn', 'Kamus Ilmiah Populer', 'Nietzche', '', '', '', '', '', 'C', 1594805242, 1594806070, '1', 7),
(38, 1, 2, 5, '', '', 'Di bawah ini yang bukan merupakan pahlawan pergerakan nasional Indonesia ialah : C', 'Dewi Sartika', 'Hasyim Asy’ari', 'Untung Surapati', 'Cipto Mangunkusumo', 'Danudirja Setiabudi', '', '', '', '', '', 'C', 1594806271, 1594817602, '1', 7),
(39, 1, 2, 5, '', '', 'Di Indonesia, lembaga yang berhak melakukan constitutional review adalah D', 'DPR', 'MPR', 'KY', 'MK', 'MA', '', '', '', '', '', 'D', 0, 0, '1', 7),
(40, 1, 2, 5, '', '', 'Pada tanggal 27 - 28 Oktober 1928 diadakan Kongres Pemuda II di Jalan Kramat No. 106 Jakarta dipimpin oleh . . . . A', 'Sugondo Joyopuspito', 'Muhammad Yamin', 'A.K. Gani', 'Tjio Djien Kwie', 'Wonsonegoro', '', '', '', '', '', 'A', 0, 0, '1', 7),
(41, 1, 2, 5, '', '', 'BPUPKI membentuk panitia kecil yang beranggotakan sembilan orang pada tanggal 22 Juni 1945. Berikut termasuk anggota panitia sembilan, kecuali. . . E', 'Mr. Achmad Soebardjo', 'Mohammad Yamin', 'Agus Salim', 'Abikusno Cokrosuyoso', 'Supomo', '', '', '', '', '', 'E', 0, 0, '1', 7),
(42, 1, 2, 5, '', '', 'Nilai - nilai Pancasila yang dilaksanakan dalam kehidupan sehari - hari disebut juga ....D', 'Nilai dasar', 'Nilai Fleksibilitas', 'Nilai Instrumental', 'Nilai Praksis', 'Nilai Kehidupan', '', '', '', '', '', 'D', 0, 0, '1', 7),
(43, 1, 2, 5, '', '', 'Jika dibandingkan dengan kabinet parlementer kelebihan kabinet presidensiil adalah dalam hal B', 'Pembentukan kabinet sangat demokratis', 'Jalannya pemerintahan lebih stabil', 'Para menteri bertanggung jawab secara kolektif', 'Para menteri dapat diganti sewaktu-waktu', 'Pemerintahan lebih mencerminkan aspirasi rakyat', '', '', '', '', '', 'B', 0, 0, '1', 7),
(44, 1, 2, 5, '', '', 'Di bawah ini Undang-Undang tentang pemerintah Daerah yang pernah berlaku di Indonesia, kecuali D', 'Undang - Undang Nomor 1 tahun 1957', 'Undang - Undang Nomor 5 tahun 1975', 'Undang - Undang Nomor 18 tahun 1965', 'Undang - Undang Nomor 25 Tahun 1999', 'Undang - Undang Nomor 22 tahun 1948', '', '', '', '', '', 'D', 0, 0, '1', 7),
(45, 1, 2, 5, '', '', 'Pertunjukkan tradisional yang berasal dari DKI Jakarta adalah ? A', 'Lenong', 'Mamanda', 'Ludruk', 'Kethoprak', 'Makyong', '', '', '', '', '', 'A', 0, 0, '1', 7),
(46, 1, 2, 5, '', '', 'Pemberantasan tindak korupsi di Indonesia saat ini payung hukumnya adalah D', 'UU No. 31 Tahun 1999', 'UU No. 20 Tahun 2001', 'UU No. 15 Tahun 2002', 'UU No. 30 Tahun 2002', 'UU No. 7 Tahun 2006', '', '', '', '', '', 'D', 0, 0, '1', 7),
(47, 1, 2, 5, '', '', 'Konferensi Asia Afrika atau yang dikenal KAA dilaksanakan pertama kali di Bandung pada tahun .... B', '1945', '1955', '1959', '1965', '1995', '', '', '', '', '', 'B', 0, 0, '1', 7),
(48, 1, 2, 5, '', '', 'Pernyataan untuk memilih kewarganegaraan disampaikan dalam waktu paling lambat ... setelah anak berusia 18 (delapan belas) tahun atau sudah kawin. B', '1 tahun', '3 tahun', '5 tahun', '7 tahun', '9 tahun', '', '', '', '', '', 'B', 0, 0, '1', 7),
(49, 1, 2, 5, '', '', 'Suatu fakta yang diurutkan secara kronologis sesuai dengan waktu terjadinya merupakan pengertian dari.. C', 'fakta', 'priodisasi', 'kronik', 'kronologi', 'sumber', '', '', '', '', '', 'C', 0, 0, '1', 7),
(50, 1, 2, 5, '', '', 'Perjanjian antar dua negara atau lebih menyangkut bidang ekonomi dan politik disebut .. C', 'custom', 'jurisprudensi', 'treaty', 'doktrin', 'adat', '', '', '', '', '', 'C', 0, 0, '1', 7),
(51, 1, 2, 5, '', '', 'Republik Indonesia Serikat yang merdeka dan berdaulat ialah suatu negara hukum yang demokrasi dan berbentuk Federasi.Merupakan bunyi Konstitusi RIS 1949 Pasal .. A', '1 ayat 1', '2 ayat 1', '1 ayat 2', '2 ayat 2', '1 ayat', '', '', '', '', '', 'A', 0, 0, '1', 7),
(52, 1, 2, 5, '', '', 'Perjanjian bilateral dan multilateral memiliki beberapa perbedaan, salah satunya adalah .... E', 'objeknya', 'sifat instrumennya', 'strukturnya', 'cara berlakunya', 'jumlah pesertanya', '', '', '', '', '', 'E', 0, 0, '1', 6),
(53, 1, 2, 5, '', '', 'Berapakah 25% dari 150 = C', '0.375', '3.75', ' 37.5', '375', '3750', '', '', '', '', '', 'C', 0, 0, '2', 7),
(54, 1, 2, 5, '', '', '4,036 : 0,04 = B', '1,009', '100,9', '10,9', '10,09', '109', '', '', '', '', '', 'B', 0, 0, '2', 7),
(55, 1, 2, 5, '', '', '(55 + 30)^2 B', '7175', '7225', '7125', '8025', '9025', '', '', '', '', '', 'B', 0, 0, '2', 7),
(56, 1, 2, 5, '', '', '28 adalah …. persen dari 70 E', '20', '25', '30', '35', '40', '', '', '', '', '', 'E', 0, 0, '2', 7),
(57, 1, 2, 5, '', '', 'KULMINASI = D', 'Panas terik matahari', 'Poros bumi', 'Tempat yang digunakan untuk mendinginkan', 'Tingkatan tertinggi', 'Kondisi emosi seseorang', '', '', '', '', '', 'D', 0, 0, '2', 7),
(58, 1, 2, 5, '', '', 'RESIDU = A', 'Sisa', 'Rasa duka', 'Kesedihan', 'Alat penyaring', 'Gangguan', '', '', '', '', '', 'A', 0, 0, '2', 7),
(59, 1, 2, 5, '', '', 'NUANSA B', 'Keseimbangan', 'Perbedaan unsur makna', 'Perbedaan massa', 'Nada', 'Kelangsungan', '', '', '', '', '', 'B', 0, 0, '2', 7),
(60, 1, 2, 5, '', '', 'MONOTON >< C', 'Terus-menerus', 'Berselang-seling', 'Berubah-ubah', 'Bergerak-gerak', 'Berulang-ulang', '', '', '', '', '', 'C', 0, 0, '2', 7),
(61, 1, 2, 5, '', '', 'MAKAR >< D', 'Boleh', 'Jujur', 'Tidak adil', 'Muslihat', 'Menutupi', '', '', '', '', '', 'D', 0, 0, '2', 7),
(62, 1, 2, 5, '', '', 'SPORADIS >< A', 'Jarang', 'Sering', 'Laten', 'Mirip', 'Seperti', '', '', '', '', '', 'A', 0, 0, '2', 7),
(63, 1, 2, 5, '', '', 'Fakta-fakta berikut ini berdasarkan bacaan tersebut di atas benar, kecuali: D', 'Tidak seharusnya orang tua menganggap anaknya tidak mungkin terjerumus ke dalam hal-hal yang negatif dan tercela', 'Sangat disayangkan jika orang tua biasanya menjadi sosok terakhir yang mengetahui anaknya terjerumus ke dalam hal-hal yang negatif dan tercela', 'Perhatian orang tua sudah seharusnya diberikan untuk anaknya', 'Pengamatan orang tua pada anaknya akan menyebabkan anak tidak mungkin melakukan hal-hal yang negatif dan tercela', 'Kenyataan adanya seorang anak yang terjerumus ke dalam hal-hal yang negatif dan tercela akan sangat memukul perasaan orang tua', '', '', '', '', '', 'D', 0, 0, '2', 7),
(64, 1, 2, 5, '', '', 'Fakta-fakta berikut ini berdasarkan bacaan tersebut di atas salah, kecuali: E', 'Dibandingkan anak lelaki, anak perempuan lebih mengedepankan perasaan dibandingkan pemikirannya sehingga lebih mudah menjadi pecandu narkoba', 'Pengamatan orang tua yang baik pada anaknya membuat anaknya tidak mungkin menjadi pecandu narkoba', 'Anak perempuan yang tidak mendapat pengamatan yang baik dari orang tuanya pasti akan menjadi pecandu narkoba', 'Anak lelaki mempunyai ketahanan tubuh yang lebih baik dibanding anak perempuan sehingga mereka tidak mungkin menjadi pecandu narkoba', 'Pemikiran yang salah dan lemahnya pengamatan bisa menjadi penyebab anak menjadi pecandu narkoba', '', '', '', '', '', 'E', 0, 0, '2', 7),
(65, 1, 2, 5, '', '', 'Fakta-fakta berikut ini berdasarkan bacaan tersebut di atas benar, kecuali: A', 'Bagi sebagian kecil remaja putri yang disurvei, narkoba dan alkohol membantu masalah yang mereka hadapi di rumah', 'Bagi sebagian besar remaja putri yang disurvei, narkoba dan alkohol mempunyai manfaat bagi mereka', 'Bagi sebagian besar remaja putri yang disurvei, narkoba dan alkohol membatu mereka untuk melupakan masalah yang tengah mereka hadapi', 'Bagi sebagian remaja laki-laki, narkoba dan alkohol membantu mereka dapat lebih santai dalam menghadapi masalah sosial yang mereka hadapi', 'Bagi sebagian kecil remaja putri yang disurvei, menggunakan alkohol dan narkoba tidak membantu menangani masalah anak-anak di dalam rumah', '', '', '', '', '', 'A', 0, 0, '2', 7),
(66, 1, 2, 5, '', '', 'KERIS : JAWA C', 'Badik : Bali', 'Madura : Celurit', 'Kujang : Sunda', 'Pisau : Dapur', 'Aceh : Rencong', '', '', '', '', '', 'C', 0, 0, '2', 7),
(67, 1, 2, 5, '', '', 'BECAK : KENDARAAN A', 'Gadis : Orang', 'Bengawan : Sungai', 'Guru : Murid', 'Baja : Belati', 'Kapal : Perahu', '', '', '', '', '', 'A', 0, 0, '2', 7),
(68, 1, 2, 5, '', '', 'LELAH : ISTIRAHAT D', 'Gadis : Orang', 'Makan : Lapar', 'Berolahraga : Sehat', 'Haus : Minum', 'Sakit : Obat', '', '', '', '', '', 'D', 0, 0, '2', 7),
(69, 1, 2, 5, '', '', '2, 6, 11, 17, 24, 32, ...., .... A', '41 dan 51', '40 dan 50', '40 dan 51', '41 dan 50', '41 dan 52', '', '', '', '', '', 'A', 0, 0, '2', 7),
(70, 1, 2, 5, '', '', '23, 26, 19, 22, 15, 18, ...., .... E', '21 dan 14', '21 dan 24', '11 dan 18', '11 dan 4', '11 dan 14', '', '', '', '', '', 'E', 0, 0, '2', 7),
(71, 1, 2, 5, '', '', '9, 15, 8, 15, 7, 15, ...., .... B', '6 dan 16', '6 dan 15', '7 dan 15', '7 dan 16', '6 dan 14', '', '', '', '', '', 'B', 0, 0, '2', 7),
(72, 1, 2, 5, '9c9ff7ab96b55feb18e1705795a51523.jpg', 'image/jpeg', '<p>huruf apa yang ada di kotak tanda tanya ? C</p>', '<p>X dan V</p>', '<p>Y dan Z</p>', '<p>Y dan X</p>', '<p>X dan Z</p>', '<p>Z dan X</p>', '', '', '', '', '', 'C', 1594967033, 1594967033, '2', 7),
(73, 1, 2, 5, '13a2a192077d75f3ac28655bcf761a1b.jpg', 'image/jpeg', '<p>Tentukan  angka-angka selanjutnya dari  barisan angka di bawah ini. B</p>', '', '', '', '', '', '7630d5f05aa9dddb437d660becc4d072.jpg', 'fb32ca9d68c4b60c69fe5d4296744ff0.jpg', '17fbd8763c8841fe73dd86e1ea75cfff.jpg', '14387462ddce055dfa5532f2e0b49370.jpg', '588a0f1ddd992680544c2b9b21df044a.jpg', 'B', 1594968292, 1594968292, '2', 7),
(74, 1, 2, 5, '13a8327d08cf816c7fc6520f2e46acd3.jpg', 'image/jpeg', '<p>Tentukan  angka-angka selanjutnya dari  barisan angka di bawah ini. A</p>', '<p>3.12</p>', '<p>3.22</p>', '<p>3.52</p>', '<p>4.12</p>', '<p>3.72</p>', '', '', '', '', '', 'A', 1594968801, 1594968801, '2', 7),
(75, 1, 2, 5, 'ba3f68041c854a1387dcb9106d7b9dec.jpg', 'image/jpeg', '<p>Tentukan  angka-angka selanjutnya dari  barisan angka di bawah ini. D</p>', '<p>6.6</p>', '<p>5.6</p>', '<p>4.6</p>', '<p>3.6</p>', '<p>2.6</p>', '', '', '', '', '', 'D', 1594969073, 1594969073, '2', 7),
(76, 1, 2, 5, '', '', '(27 + 34)2 – 2345 = …… C', '1176', '1276', '1376', '1367', '1267', '', '', '', '', '', 'C', 0, 0, '2', 7),
(77, 1, 2, 5, '', '', 'Berapa persen (%)-kah 36 dari 80? D', '30', '35', '40', '45', '48', '', '', '', '', '', 'D', 0, 0, '2', 7),
(78, 1, 2, 5, '', '', '4.	Jika	a = 4,5 dan b = 5,4\r\nc = a + b2\r\nmaka, hasil (a2 × b) – c adalah ……\r\n B', '76.59', '75.69', '75.96', '75.95', '74.59', '', '', '', '', '', 'B', 0, 0, '2', 7),
(79, 1, 2, 5, '', '', 'Seorang penjual buah membeli buah dengan harga Rp450.000,00, dan pedagang tersebut berhasil menjual semuanya dengan harga Rp573.750,00. Berapakah persentase keuntungan yang didapat oleh penjual buah itu? E', '20%', '22.5%', '25%', '25.5%', '27.5%', '', '', '', '', '', 'E', 0, 0, '2', 7),
(80, 1, 2, 5, '', '', 'Seseorang mendapatkan hadiah mobil dalam suatu program televisi. Di pasaran umum, harga mobil tersebut adalah Rp150.000.000,00.Adapun pajak ditetapkan 2/3 dari harga tersebut. Jika ia diharuskan membayar pajak sebesar Rp450,00 per Rp1.000,00, berapakah besarnya pajak yang harus dibayarnya? A', 'Rp. 45.000.000', 'Rp.37.500.000', 'Rp. 30.000.000', 'Rp. 25.750.000', 'Rp. 25.000.000', '', '', '', '', '', 'A', 0, 0, '2', 7),
(81, 1, 2, 5, '', '', 'Dari pembagiannya dengan Budi, Ahmad mendapatkan bagian 62,5%, yakni sebesar Rp3.200.000,00.\r\nBerapakah selisih uang Ahmad dan Budi?\r\n B', 'Rp1.380.000,00', 'Rp1.280.000,00', 'Rp1.180.000,00', 'Rp1.080.000,00', 'Rp980.000,00', '', '', '', '', '', 'B', 0, 0, '2', 7),
(82, 1, 2, 5, '', '', 'Keseluruhan jumlah televisi dagangan Rudi adalah 56 buah. Di dalam gudang terdapat 24 buah televisi lebih banyak dibandingkan televisi-televisi yang dipajang di etalase toko.\r\nBerapakah jumlah televisi di dalam gudang Rudi?\r\n C', '36', '38', '40', '42', '44', '', '', '', '', '', 'C', 0, 0, '2', 7),
(83, 1, 2, 5, '', '', 'Jika keliling sebuah lingkaran 34,53 meter, berapakah jari-jarinya?  B', '4.5 m', '5,5 m', '6,5 m', '7,5 m', '8,5  m', '', '', '', '', '', 'B', 0, 0, '2', 7),
(84, 1, 2, 5, '', '', 'Hanya anak keturunan Ken Arok yang menjadi raja di Singasari.\r\nKertanegara adalah raja terakhir Singasari. Gajah Mada bukan anak keturunan Ken Arok.\r\nPernyataan yang sesuai dengan pernyataan di atas adalah …\r\n E', 'Gajah Mada menjabat Patih Singasari.', 'Kertanegara bukan keturunan Ken Arok namun menjadi raja Singasari.', 'Gajah Mada bukan Patih Singasari tetapi Patih Majapahit.', 'Meski bukan anak keturunan Ken Arok, Gajah Mada menjadi raja Singasari.', 'Ken Arok merupakan leluhur Kertanegara.', '', '', '', '', '', 'E', 0, 0, '2', 7),
(85, 1, 2, 5, '', '', 'Suatu keluarga mempunyai empat orang anak yang bergelar sarjana. A memperoleh gelar sarjana sesudah C, B menjadi sarjana sebelum D dan bersamaan dengan A. Siapakah yang menjadi sarjana yang paling awal? C', 'A', 'B', 'C', 'D', 'A DAN B', '', '', '', '', '', 'C', 0, 0, '2', 7),
(86, 1, 2, 5, '', '', '<p>Perhatikan gambar-gambar berikut di bawah ini, kemudian tentukan satu gambar yang tidak mempunyai persamaan dengan gambar-gambar lainnya. A</p>', '<p><img src=\"blob:http://localhost:81/fad39cea-0c00-45d9-859c-99a987d4ae13\" alt=\"\" class=\"fr-fic fr-dii\"></p>', '', '', '', '', 'e6321a6e9a35b5a70d05ce2cc2377133.jpg', '7e56daee91ddd0f524f3c4b367d95fe4.jpg', '8fea3d098f6b58d2219284f12e6af8ed.jpg', 'fdd6009260acfc6cfde6ee3a587f3153.jpg', '4d8872c354cc139abdddb9862309580a.jpg', 'A', 0, 1594972964, '2', 7),
(87, 1, 2, 5, '7576f9844cd8c09979e273e96fdbba0a.jpg', 'image/jpeg', '<p>Tentukan satu gambar yang mempunyai persamaan dengan gambar yang menjadi soal atau pertanyaan. D</p>', '', '', '', '', '', '04b83e3591691c84bc64c19c656fd076.jpg', '977efe126e3bd3cc86eadea6f0f97c1c.jpg', '1b0c7b42bff9f4662ce640df9222efa6.jpg', 'eef8556f5cf359877dc73eef0df0fe6e.jpg', 'ec445b3e09ae9ee39cd5543c17168281.jpg', 'D', 0, 1594974951, '2', 7),
(88, 1, 2, 1, '', '', '<p>Orang tua saya tiba tiba mengalami kesulitan ekonomi sehingga uang spp tidak terbayar bulan ini D</p>', '<p>mengatakan kepada guru bahwa orang tua kesulitan ekonomi</p>', '<p>tidak mau sekolah lagi</p>', '<p>kecewa karna orang tua tidak memahami kebutuhan saya</p>', '<p>mohon dispensasi menunda pembayaran</p>', '<p>mencari pinjaman dan meminta orang tua menggantinya</p>', '', '', '', '', '', 'A:4,B:1,C:3,D:5,E:2', 1594976791, 1594976791, '3', 7),
(89, 1, 2, 0, '', '', '<p>Bagi saya, kelemahan merupakan ... B</p>', '<p>Isyarat    tegas    bahwa    saya    harus  berhenti </p>', '<p>Justru  meningkatkan     ketangguhan  saya  untuk  mencoba  sesuatu  dengan  lebih baik </p>', '<p>Sering menjatuhkan mental saya </p>', '<p>Hal  yang  saya  upayakan  untuk  tidak  mengurangi semangat saya </p>', '<p>Mungkin   ada   unsur   kekeliruan   dari  anggota tim saya </p>', '', '', '', '', '', 'A:2,B:5,C:3,D:4,E:1', 1594989692, 1595057469, '3', 7),
(90, 1, 2, 1, '', '', '<p>Menurut anda mementingkan kepentingan  umum  adalah ... C</p>', '<p>Melihat skala prioritas kepentingan</p>', '<p>Melihat budi kebaikan yang pernah kita  terima dari orang lain</p>', '<p>Membantu  dengan  tulus  kepada  yang  membutuhkan</p>', '<p>Kebaikan</p>', '<p>Perbuatan    yang    perlu    ditanamkan  sejak dini</p>', '', '', '', '', '', 'A:2,B:1,C:5,D:3,E:4', 1595057964, 1595057988, '3', 7),
(91, 1, 2, 1, '', '', '<p>Jika  anda  mendapatkan  suatu  pekerjaan  yang   bayarannya   sangat   besar,   maka  anda akan ... A</p>', '<p>Bertanggung  jawab  dalam  melakukan  pekerjaan anda </p>', '<p>Lebih bersemangat </p>', '<p>Takut </p>', '<p>Merasa terharu </p>', '<p>Biasa saja </p>', '', '', '', '', '', 'A:5,B:4,C:1,D:3,E:2', 1595058444, 1595058444, '3', 7),
(92, 1, 2, 1, '', '', '<p>Jika  anda  mendapatkan  suatu  pekerjaan  dengan gaji yang sangat kecil, maka anda  akan ... A</p>', '<p>Bertanggung  jawab  dalam  melakukan  pekerjaan anda </p>', '<p>Malas  </p>', '<p>Keluar dari pekerjaan tersebut </p>', '<p>Merasa sedih </p>', '<p>Biasa saja </p>', '', '', '', '', '', 'A:5,B:2,C:1,D:3,E:4', 1595058642, 1595058642, '3', 7),
(93, 1, 2, 1, '', '', '<p>Menurut   saya   orang   tua   saya   sukses  dalam bekerja dan berkarya karena ... B</p>', '<p>Mereka menempuh berbagai rintangan  untuk mencapai kesuksesan </p>', '<p>Mereka  berusaha keras  dalam  hidupnya untuk sukses </p>', '<p>Mereka mendapatkan kesempatan dan  fasilitas sehingga bisa sukses </p>', '<p>Mereka   adalah   pribadi   yang   patut  dicontoh </p>', '<p>Mereka  orang  yang  sangat  beruntung  dan membuat anaknya bangga </p>', '', '', '', '', '', 'A:4,B:5,C:2,D:3,E:1', 1595058751, 1595058751, '3', 7),
(94, 1, 2, 1, '', '', '<p>Anda  diminta  untuk  memberikan  materi  training di  suatu  forum  yang  pesertanya  kebanyakan    adalah    mahasiswa    dari  kampus    ternama.   Maka    reaksi    anda  adalah... E</p>', '<p>Meminta orang lain saja untuk memberi  materi  training </p>', '<p>Mengkomunikasikan  pada  penyelanggara  acara  agar  sesi  materi  ditunda </p>', '<p>Mencoba menjelaskan sebisanya </p>', '<p>Meminta  bantuan  rekan  untuk  menyusun materi </p>', '<p>Berusaha   tenang   dan   fokus   pada  materi yang akan disampaikan </p>', '', '', '', '', '', 'A:1,B:2,C:4,D:3,E:5', 1595058866, 1595058866, '3', 7),
(95, 1, 2, 1, '', '', '<p>Tawaran beasiswa begitu banyak, namun  pasangan  anda  tidak  mengizinkan  anda  untuk mengambil beasiswa dengan alasan  anda tidak bisa fokus pada  pekerjaan dan  keluarga, maka anda akan ... B</p>', '<p>Marah kepada keadaaan </p>', '<p>Memakluminya </p>', '<p>Meminta  pasangan  untuk  mempertimbangkannya </p>', '<p>Keluar dari pekerjaan </p>', '<p>Sedih </p>', '', '', '', '', '', 'A:2,B:5,C:4,D:1,E:3', 1595059019, 1595059019, '3', 7),
(96, 1, 2, 1, '', '', '<p>Mengangkat   telepon pada   saat  rapat menurut saya ... B</p>', '<p>Boleh saja </p>', '<p>Tidak boleh </p>', '<p>Boleh asal pimpinan meyetujui </p>', '<p>Boleh asal sudah memberi usulan atau  kontribusi ide dalam rapat </p>', '<p>Boleh asal tidak ketahuan </p>', '', '', '', '', '', 'A:1,B:5,C:4,D:3,E:2', 1595059140, 1595059140, '3', 7),
(97, 1, 2, 1, '', '', '<p>Karena  sebagian  besar  pegawai  pulang  kampung dan saya diminta menunda cuti  lebaran oleh pimpinan. Saya berjanji pada  orang  tua  untuk  mudik  di  hari  lebaran,  sikap saya ... B</p>', '<p>Tetap mengambil cuti </p>', '<p>Memberi pengertian kepada orang tua </p>', '<p>Memberi  pengertian  kepada  pimpinan  agar diperbolehkan pulang kampung </p>', '<p>Meminta  anggota  keluarga  lain  untuk  membujuk orang tua </p>', '<p>Meminta  teman  untuk  menggantikan  penundaan  cuti </p>', '', '', '', '', '', 'A:1,B:5,C:3,D:4,E:2', 1595059264, 1595059264, '3', 7),
(98, 1, 2, 1, '', '', '<p>Anda adalah ketua bidang kewirausahaan  di  sebuah  organisasi.  Pada  suatu  saat  anda  ditegur  oleh  pimpinan  karena  ada  program - program  yang  belum  terlaksana  sampai pada akhir periode kepengurusan.  Maka yang akan anda lakukan adalah ... D</p>', '<p>Mencari alasan agar tidak dimarahi </p>', '<p>Menerima resiko </p>', '<p>Meminta maaf pada jajaran pengurus </p>', '<p>Segera  mengurus  kelanjutan  programnya </p>', '<p>Mengatakan   bahwa   hal   yang   harus  anda  kerjakan  sangat  banyak,  sehingga    membutuhkan   </p>', '', '', '', '', '', 'A:1,B:3,C:4,D:5,E:2', 1595059391, 1595059391, '3', 7),
(99, 1, 2, 1, '', '', '<p>Anda sedang berada di kendaraan umum  yang  penuh  sesak  dengan  penumpang,  tiba - tiba  pimpinan  anda   menelpon  dan  anda kesulitan untuk menjawab panggilan  tersebut, maka sikap anda ... E</p>', '<p>Marah  pada  orang  yang  ada  di  dekat  anda </p>', '<p>Menggerutu </p>', '<p>Biasa saja </p>', '<p>Turun dari kendaraan umum </p>', '<p>Bersabar </p>', '', '', '', '', '', 'A:1,B:2,C:4,D:3,E:5', 1595059522, 1595059522, '3', 7),
(100, 1, 2, 1, '', '', '<p>Bagaimana  sikap    anda    jika    diminta  melakukan   investigasi   ke   tempat   yang  anda sama sekali belum pernah datangi ... D</p>', '<p>Mundur </p>', '<p>Menolaknya secara tegas </p>', '<p>Meminta pertimbangan ulang </p>', '<p>Antusias </p>', '<p>Menyanggupinya dengan sedikit ragu </p>', '', '', '', '', '', 'A:1,B:2,C:3,D:5,E:4', 1595059639, 1595059639, '3', 7),
(101, 1, 2, 1, '', '', '<p>Anda  diminta  menggantikan  rekan  yang  bekerja   di   gudang,   sedangkan   kondisi  gudang yang pengap dan panas tentunya  berbeda  dengan  ruang  kerja  anda,  maka  anda akan ... A</p>', '<p>Tertantang untuk mengerjakan dengan  baik </p>', '<p>Merasa takut </p>', '<p>Bekerja seperti biasa </p>', '<p>Menerima dengan berat hati </p>', '<p>Menyiapkan alasan apabila tidak tuntas </p>', '', '', '', '', '', 'A:5,B:2,C:4,D:3,E:1', 1595059763, 1595059763, '3', 7),
(102, 1, 2, 1, '', '', '<p>Pada    saat    anda    sedang    melakukan  wawancara dengan narasumber, tiba - tiba  tetangga  anda  menelpon  dan  memberi  tahu bahwa baru saja terjadi pencurian di  rumah anda, sikap anda ... B</p>', '<p>Segera kembali ke rumah </p>', '<p>Memohon  maaf  dan  minta  izin pada  narasumber tersebut untuk kembali ke  rumah </p>', '<p>Mengabaikan   urusan   rumah   karena  masih sibuk  </p>', '<p>Kembali setelah wawancara selesai </p>', '<p>Menelpon  meminta  kerabat  mengurusinya dulu </p>', '', '', '', '', '', 'A:2,B:5,C:3,D:4,E:1', 1595059890, 1595059890, '3', 7),
(103, 1, 2, 1, '', '', '<p>Program   yang   diusung   oleh   tim   saya  sering  tidak  berjalan  dengan  baik,  saya  sebaiknya ... A</p>', '<p>Memberi   kritik   dan   tetap   berusaha  memberi  semangat tim  saya  sekuat  tenaga </p>', '<p>Tetap   berfikir   positif   walau   hanya  dengan berdiam diri saja </p>', '<p>Pura - pura tidak paham masalahnya </p>', '<p>Menyarankan agar melakukan evaluasi  dan segera melakukan perbaikan </p>', '<p>Menyaranka n agar  beberapa rekan tim  diganti saja karena selalu tidak beres </p>', '', '', '', '', '', 'A:5,B:3,C:2,D:4,E:1', 1595060036, 1595060036, '3', 7),
(104, 1, 2, 1, '', '', '<p>Ketika  hendak  berangkat  ke  kantor,  tiba - tiba   motor   yang   anda   parkir   didepan  rumah hilang, sikap anda ... A</p>', '<p>Melaporkan  kehilangan  sambil  menyampaikan ke atasan </p>', '<p>Meminta  kerabat  dan  para  tetangga  untuk  mencarinya </p>', '<p>Membiarkan polisi yang mengurusnya </p>', '<p>Tetap  berangkat  ke  kantor  karena  itu  lebih penting </p>', '<p>Berangkat ke kantor dengan pikiran tak  karuan </p>', '', '', '', '', '', 'A:5,B:2,C:4,D:1,E:3', 1595060122, 1595060122, '3', 7),
(105, 1, 2, 1, '', '', '<p>Suatu    ketika    anda    mengikuti    lomba  menulis   esai   namun   hanya   mendapat  juara ketiga, maka sikap anda ... D</p>', '<p>Menyesal  kesalahan </p>', '<p>Mempersiapkan   diri   lebih   baik   lagi  untuk ikut lomba menulis selanjutnya </p>', '<p>Menyalahkan keadaan </p>', '<p>Puas dan bangga </p>', '<p>Biasa saja </p>', '', '', '', '', '', 'A:2,B:4,C:1,D:5,E:3', 1595060317, 1595060317, '3', 7),
(106, 1, 2, 1, '', '', '<p>Ada   tamu   yang   terlibat   pertengkaran  dengan   tamu   lain   di   penginapan   milik  anda. Melihat hal tersebut yang akan anda  lakukan adalah ... D</p>', '<p>Mengusir mereka </p>', '<p>Meminta  satpam  agar  melerai  keduanya </p>', '<p>Langsung    melaporkan    pada    pihak  berwajib </p>', '<p>Mengajak  mereka  untuk  menyelesaikan   masalah   di   ruangan  tertentu </p>', '<p>Meminta    ganti    rugi    karena    telah  membuat kegaduhan dan kerugian </p>', '', '', '', '', '', 'A:1,B:4,C:3,D:5,E:2', 1595060456, 1595060456, '3', 7),
(107, 1, 2, 1, '', '', '<p>Dalam suatu seleksi bidang, anda lulus di  bagian  penjualan,  padahal  bagian  yang  anda    inginkan    adalah    bagian    Diklat  keuangan. Maka yang akan anda lakukan  adalah ... A</p>', '<p>Berusaha bekerja secara optimal </p>', '<p>Menolak pekerjaan tersebut </p>', '<p>Berusaha    agar    anda  tetap    dapat  mengerjakan  urusan  di  bagian  keuangan </p>', '<p>Mempertimbangkan tawaran tersebut </p>', '<p>Meminta  bayaran  lebih  mahal  untuk  pekerjaan di bagian penjualan </p>', '', '', '', '', '', 'A:5,B:3,C:2,D:4,E:1', 1595060554, 1595060554, '3', 7),
(108, 1, 2, 1, '', '', '<p>Agar  semua  staf  di  kantor  anda  bekerja  dengan   rajin,   maka   sebagai   pimpinan  kantor anda akan ... D</p>', '<p>Memberikan  penghargaan kepada staf  yang paling rajin </p>', '<p>Menempel  tulisan  Kerja  itu di  berbagai tempat yang strategis </p>', '<p>Memberikan sanksi yang tegas kepada  setiap    staf    yang    bekerja    malas - malasan </p>', '<p>Lebih  rajin  bekerja  sembari  mengajak  para staf anda untuk turut serta dengan  anda </p>', '<p>Membentuk  sebuah  komisi  penegakkan disiplin </p>', '', '', '', '', '', 'A:2,B:4,C:1,D:5,E:3', 1595060636, 1595060636, '3', 7),
(109, 1, 2, 1, '', '', '<p>Anda  tidak  diterima  di  perusahaan  yang  anda  inginkan.  Istri  anda  meminta  anda  meminta  pada   anda  agar  melamar  ke  perusahaan  lain.  Maka  yang  akan  anda  lakukan  adalah ... B</p>', '<p>Mencoba lagi kalau ada kesempatan </p>', '<p>Mengikuti pelatihan agar dapat diterima </p>', '<p>Melamar kerja dimana saja asal dapat  pekerjaan </p>', '<p>Mengikuti saran istri  </p>', '<p>Mencoba   lagi   nanti   dengan   bidang  yang   sama   namun   di   perusahaan  berbeda </p>', '', '', '', '', '', 'A:4,B:5,C:1,D:2,E:3', 1595060750, 1595060750, '3', 7),
(110, 1, 2, 1, '', '', '<p>Anda tidak lolos mengikuti  seleksi pegawai  kementrian luar negeri, maka anda akan... E</p>', '<p>Sedih </p>', '<p>Putus asa </p>', '<p>Lelah </p>', '<p>Merasa  tertantang  untuk  mengikutinya lagi periode mendatang </p>', '<p>Belajar  dari  kesalahan  dan  mempersiapkan diri lebih baik lagi </p>', '', '', '', '', '', 'A:3,B:1,C:2,D:4,E:5', 1595060868, 1595060868, '3', 7),
(111, 1, 2, 1, '', '', '<p>Saat  anda   dinyatakan  belum  lolos  tes  kenaikan    pangkat    dan    teman    anda  menyarankan  untuk  mengikuti  beberapa  pelatihan  agar  bisa  lolos  saat  mencoba  lagi tes tersebut, maka anda ... D</p>', '<p>Mencoba lagi tes </p>', '<p>Mengikuti  pelatihan  agar  teman  tidak  kecewa </p>', '<p>Mencoba melamar pekerjaan di tempat  lain </p>', '<p>Mengikuti  saran  teman  dan  mencoba  belajar dengan giat </p>', '<p>Mengikuti pelatihan diam - diam </p>', '', '', '', '', '', 'A:2,B:4,C:1,D:5,E:3', 1595060960, 1595060960, '3', 7),
(112, 1, 2, 1, '', '', '<p xss=removed>Anda  sedang  sibuk  mengerjakan  tugas dan melihat bahwa rekan dalam tim anda sedang     mengalami     kesulitan     dalam  mengerjakan  pekerjaannya, maka  anda  akan ... A</p>', '<p>Menghiraukannya </p>', '<p>Melihat dulu jenis pekerjaanya apakah  bisa membantu atau tidak </p>', '<p>Memintanya bekerja sendiri </p>', '<p>Memarahinya </p>', '<p>Merekomendasikan rekan yang lain </p>', '', '', '', '', '', 'A:5,B:4,C:3,D:2,E:1', 1595061115, 1595061932, '3', 7),
(113, 1, 2, 1, '', '', '<p>Anda  bertugas  mengelola  bagian  input  database  pusat.  Rekan  anda  seringkali  terlambat memasukkan datanya  sehingga  anda    sering    ditegur    atasan    karena  mencapai   waktu   deadline,   maka   anda  akan ... E</p>', '<p>Menunggu saja </p>', '<p>Mengambil  alih  pekerjaan  pada  bagiannya itu </p>', '<p>Memintanya  untuk  lebih  cepat  dalam  bekerja </p>', '<p>Melaporkannya kepada atasan </p>', '<p>Bertanya  apa  kesulitannya  dan  membantu sebisa anda </p>', '', '', '', '', '', 'A:3,B:1,C:4,D:2,E:5', 1595062053, 1595062053, '3', 7),
(114, 1, 2, 1, '', '', '<p>Anda terbiasa tepat waktu datang bekerja  dan menyelesaikan pekerjaan. Ada rekan  tim   anda   yang   melakukan   sebaliknya,  sehingga  rekan - rekan  yang  lain  kurang  menyukainya. Maka anda akan ... A</p>', '<p>Mengingatkan  rekan  tersebut  dengan  halus agar tidak tersinggung </p>', '<p>Diam saja, nanti takut dibilang membela rekan yang tidak patut dicontoh</p>', '<p>Menegur  di  depan  rekan - rekan  yang  lain </p>', '<p>Melakukan  rapat  tim  untuk  bermusyawarah  atas  suka  dan  ketidaksukaan antar rekan dalam tim </p>', '<p>Merekomendasikan   rekan   yang   lain  untuk  menggantikan rekan tersebut </p>', '', '', '', '', '', 'A:5,B:2,C:3,D:4,E:1', 1595062199, 1595062199, '3', 7),
(115, 1, 2, 1, '', '', '<p>Jika suatu saat nanti anda  terpilih menjadi  seorang  pimpinan  organisasi  terbesar  di  indonesia, hal   pertama   yang   saudara  lakukan adalah ... D</p>', '<p>Membuat perubahan organisasi besar - besaran </p>', '<p>Memperbaiki kualitas SDM para anggota organisasi </p>', '<p>Merenovasi gedung sekertariat supaya  lebih bagus </p>', '<p>Menciptakan  suatu  inovasi  baru  yang  dapat memajukan masa depan bangsa </p>', '<p>Menerapkan  manajemen  modern  seperti  yang  telah  diterapkan  di  luar  negeri </p>', '', '', '', '', '', 'A:3,B:4,C:1,D:5,E:2', 1595062306, 1595062306, '3', 7),
(116, 1, 2, 1, '', '', '<p>Agar semua penghuni baru  di lingkungan  anda  dapat  bersosialisasi  dengan  baik,  maka  anda  sebagai  penghuni  lama  akan  ... D</p>', '<p>Menawarkan   dari   kepada   ketua   RT  untuk membimbing para peghuni baru </p>', '<p>Mencoba mencairkan suasana dengan  penghuni baru </p>', '<p>Memperkenalkan  diri  terlebih  dahulu  dengan penghuni baru </p>', '<p>Menyelenggarakan  acara  santai  yang  dapat mempertemukan penghuni lama  dengan penghuni baru  </p>', '<p>Cuek    saja    karena    saya    banyak  pekerjaan  yang  harus  segera  diselesaikan </p>', '', '', '', '', '', 'A:4,B:2,C:3,D:5,E:1', 1595062417, 1595062417, '3', 7),
(117, 1, 2, 1, '', '', '<p>Agar semua pegawai di kantor anda dapat  mengikuti   acara   kursus   bahasa   asing  untuk  meningkatkan  kemampuan  SDM,  maka  sebagai  panitia  kegiatan  tersebut  anda akan ... D</p>', '<p>Menyelenggarakan kursus di hari libur </p>', '<p>Menyelenggarakan  kursus  pada  jam  istirahat </p>', '<p>Menyelenggarakan kursus setelah jam  kantor selesai </p>', '<p>Menyelenggarakan  kursus  secara  bertahap  sehingga  tidak  mengganggu  kinerja instansi anda </p>', '<p>Meminta  pendapat  rekan-rekan  anda  kapan sebaiknya  kursus dilaksanakan </p>', '', '', '', '', '', 'A:2,B:1,C:3,D:5,E:4', 1595062502, 1595062502, '3', 7),
(118, 1, 2, 1, '', '', '<p>Adik  anda  kesulitan  untuk  mengerjakan  tugas   sekolahnya   dan   kebetulan   anda  menguasai materi tersebut ... B</p>', '<p>Memberikan buku - buku referensi </p>', '<p>Membagi  ilmu  dan  mungkin  memberikan referensi buku </p>', '<p>Membantu jika diminta </p>', '<p>Berpura - pura tidak tahu </p>', '<p>Menyarankan agar konsultasi pada guru </p>', '', '', '', '', '', 'A:4,B:5,C:2,D:1,E:3', 1595062612, 1595062612, '3', 7),
(119, 1, 2, 1, '', '', '<p>Jika     teman     anda     ingin     meminjam  kendaraan    pribadi    yang    biasa    anda  gunakan   ke   kantor,   maka  yang   anda  lakukan adalah ... A</p>', '<p>Meminjamkannya </p>', '<p>Meminta  teman  agar  mengisi  bensinnya </p>', '<p>Meminta biaya sewa </p>', '<p>Meminta    maaf    karena    tidak    bisa  meminjamkannya </p>', '<p>Meminjamkannya   dengan   parasaan  was - was </p>', '', '', '', '', '', 'A:5,B:3,C:1,D:2,E:4', 1595062777, 1595062777, '3', 7),
(120, 1, 2, 1, '', '', '<p>Dalam perjalan berangkat ke kantor, Anda  ditelpon    oleh    tetangga  anda    untuk  menjemputnya di halte karena ia baru saja  kecopetan, maka anda akan ... C</p>', '<p>Menolaknya secara halus </p>', '<p>Menolaknya  karena  anda  pasti  akan  terlambat ke kantor </p>', '<p>Segera menuruti permintaannya </p>', '<p>Menjemputnya sambil mengeluh </p>', '<p>Menolak secara  halus, kemudian  mematikan handphone </p>', '', '', '', '', '', 'A:3,B:2,C:5,D:4,E:1', 1595062886, 1595062886, '3', 7),
(121, 1, 2, 1, '', '', '<p>Setiap   pagi   dalam   perjalanan   menuju  kantor saya sering merasa ... B</p>', '<p>Banyak tugas yang menanti saya </p>', '<p>Bersemangat    untuk    melaksanakan  aktifitas sehari - hari </p>', '<p>Pusing memikirkan susana kantor yang  kurang nyaman </p>', '<p>Merasa tertantang akan apa yang saya  hadapi kedepan </p>', '<p>Berharap semoga hari ini hari baik saya </p>', '', '', '', '', '', 'A:3,B:5,C:1,D:4,E:2', 1595062972, 1595062972, '3', 7),
(122, 1, 2, 1, '', '', '<p>Rumah   kost   yang   baru   anda   tempati  merupakan    bangunan    lama    dengan  dekorasi  yang  sudah  ketinggalan  jaman,  banyak barang - barang tua yang tidak lagi  dapat  digunakan  dengan  baik.  mengenai  hal ini saya ... D</p>', '<p>Biasa   saja   karena   tak   mau   ambil  pusing </p>', '<p>Saya  kumpulkan  barang - barang  tersebut  kemudian  saya  jual  ke  pasar  barang bekas </p>', '<p>Saya  meminta  pemilik  agar  memperbaharui dekorasi rumah </p>', '<p>Saya coba dekorasi sendiri sedemikian  rupa agar terlihat lebih  baik </p>', '<p>Saya  kumpulkan  barang  mana  yang  masih  dapat  dipakai  dan  mana  yang  tidak </p>', '', '', '', '', '', 'A:2,B:1,C:3,D:5,E:4', 1595063075, 1595063075, '3', 7),
(123, 1, 1, 5, 'c903261c6feca8643f4c4ea15b0eb04a.jpg', 'image/jpeg', '<p>b</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '66ed74bcd2ac067c352bb90648d70f46.jpg', 'b0eb3b780b1b3b5fd0b4f388fb043754.jpg', '3e4103c00b05c7a28cfc8ec30ca18f47.jpg', 'a1880a204818171d7a418974ef79d07a.jpg', '131fbb4aa5fa3a0fe0c7c298a6a6c244.jpg', 'A', 1595169947, 1595171636, '4', 8),
(125, 1, 1, 5, '', '', 'a', 'a', 'a', 'a', 'a', 'a', '', '', '', '', '', 'A', 0, 0, '4', 8),
(126, 1, 1, 5, '', '', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '', '', '', '', '', 'A', 0, 1595206991, '4', 8),
(127, 1, 1, 5, '', '', '<p>isi</p>', '', '', '', '', '', '', '', '', '', '', 'A', 1595212250, 1595219907, '4', 8),
(128, 1, 1, 5, '', '', '<p>ad</p>', '<p>ad</p>', '<p>ad</p>', '<p>ad</p>', '<p>ad</p>', '<p>ad</p>', '', '', '', '', '', 'A', 1595212596, 1595212596, '4', 8),
(129, 1, 1, 5, '', '', '<p>af</p>', '<p>af</p>', '<p>af</p>', '<p>af</p>', '<p>af</p>', '<p>af</p>', '', '', '', '', '', 'B', 1595212755, 1595212755, '4', 8),
(130, 1, 1, 5, '', '', '<p>ag</p>', '<p>ag</p>', '<p>ag</p>', '<p>ag</p>', '<p>ag</p>', '<p>ag</p>', '', '', '', '', '', 'B', 1595212939, 1595212939, '4', 8),
(131, 1, 1, 5, '', '', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '', '', '', '', '', 'D', 1595213120, 1595213120, '4', 8),
(132, 1, 1, 5, '', '', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '', '', '', '', '', 'D', 1595213290, 1595213290, '4', 8),
(133, 1, 1, 5, '', '', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '', '', '', '', '', 'D', 1595213364, 1595213364, '4', 8),
(134, 1, 1, 5, '', '', '<p>soal</p>', '<p>jawab a</p>', '<p>jawab  aa</p>', '<p>jawab  aa</p>', '<p>jawab aa</p>', '<p>jawab aa</p>', '', '', '', '', '', 'E', 1595213583, 1595219637, '4', 8),
(135, 1, 1, 5, '', '', '<p>aoasa</p>', '<p>ao</p>', '<p>ao</p>', '<p>ao</p>', '<p>ao</p>', '<p>ao</p>', '', '', '', '', '', 'D', 1595213633, 1595215286, '4', 8),
(136, 1, 1, 5, '', '', '<p>test kosong</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '', '', '', '', '', 'A', 1595220458, 1595220458, '4', 8),
(137, 1, 1, 5, '', '', '<p>skb1</p>', '<p>1</p>', '<p>2</p>', '<p>3</p>', '<p>4</p>', '<p>5</p>', '', '', '', '', '', 'A', 1595234935, 1595235265, '4', 8),
(138, 1, 1, 5, '', '', '<p>skd2</p>', '<p>2</p>', '<p>2</p>', '<p>2</p>', '<p>2</p>', '<p>2</p>', '', '', '', '', '', 'D', 1595236081, 1595399782, '4', 8),
(139, 1, 1, 5, '', '', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '', '', '', '', '', 'A', 1595236284, 1595236284, '4', 8),
(140, 1, 1, 5, '', '', '<p>dy</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '', '', '', '', '', 'A', 1595236308, 1595236308, '4', 8),
(141, 1, 1, 5, '', '', '<p>dyfg</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '', '', '', '', '', 'A', 1595236316, 1595236316, '4', 8),
(142, 1, 1, 5, '', '', '<p>ok</p>', '<p>ok</p>', '<p>ok</p>', '<p>ok</p>', '<p>ok</p>', '<p>ok</p>', '', '', '', '', '', 'B', 1595236504, 1595243274, '4', 8),
(143, 1, 1, 5, '', '', '<p>sss</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '', '', '', '', '', 'A', 1595249883, 1595249883, '4', 8),
(144, 1, 1, 5, '', '', '<p>sso</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '', '', '', '', '', 'A', 1595249898, 1595249898, '4', 8),
(145, 1, 1, 5, '', '', '<p>b</p>', '', '', '', '', '', '', '', '', '', '', 'A', 1595255849, 1595255849, '4', 8),
(146, 1, 2, 5, '', '', '<p>test warga</p>', '<p>a</p>', '<p>d</p>', '<p>f</p>', '<p>g</p>', '<p>h</p>', '', '', '', '', '', 'A', 1595256649, 1595256649, '1', 9),
(147, 1, 1, 5, '', '', '<p>ds</p>', '<p>df</p>', '<p>sdf</p>', '<p>sdf</p>', '<p>dsf</p>', '<p>sdf</p>', '', '', '', '', '', 'A', 1595257365, 1595257365, '4', 8),
(148, 1, 1, 5, '', '', '<p>24</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '', '', '', '', '', 'A', 1595257481, 1595257481, '4', 8),
(149, 1, 1, 5, '', '', '<p>25</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '', '', '', '', '', 'A', 1595257504, 1595257504, '4', 8),
(150, 1, 1, 5, '', '', '<p>asdf</p>', '<p>d</p>', '<p>f</p>', '<p>g</p>', '<p>h</p>', '<p>j</p>', '', '', '', '', '', 'A', 1595259824, 1595259824, '4', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'Administrator', '$2y$12$CHD8TezvDMZd2mf.HML9nONJuNJbSFXAQTvE9ToMN0Q45P5g4RiQu', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1595503549, 1, 'Admin', NULL, 'ADMIN', NULL),
(3, '::1', '1630511000', '$2y$10$FUXElo31Mwt6lvWRSMQdY.MQeb295HcyCvND/tO59vbYRJqiiq4nC', 'copycut7@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1595490020, 1595503366, 1, 'sugik', 'sugik', NULL, NULL),
(4, '::1', '12345678', '$2y$10$BG5EsOJKQ4Q1GAHawUvEC.h2D.Dh87fjV2Eb.bx0HDsJK5Yp..Ile', 'irawati@email.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1595503013, 1595503168, 1, 'irawati', 'irawati', NULL, NULL),
(5, '::1', '12345677', '$2y$10$aKcD/G/dO2a//7ifeqyWWezSfVDdQGtqA/Szib3XoMMTlFrltM0Ge', 'arfan@email.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1595504232, NULL, 1, 'arfan', 'arfan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3, 1, 1),
(5, 3, 3),
(6, 4, 2),
(34, 5, 3),
(10, 8, 2),
(11, 9, 3),
(12, 10, 2),
(13, 11, 2),
(14, 12, 3),
(15, 13, 3),
(16, 19, 3),
(17, 20, 3),
(18, 21, 3),
(19, 22, 3),
(20, 23, 3),
(21, 24, 3),
(22, 25, 3),
(23, 26, 3),
(25, 28, 3),
(26, 29, 3),
(27, 30, 3),
(28, 31, 3),
(29, 32, 3),
(30, 33, 3);

-- --------------------------------------------------------

--
-- Structure for view `dashboard_peserta`
--
DROP TABLE IF EXISTS `dashboard_peserta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_peserta`  AS  select `h_ujian`.`id` AS `id`,`h_ujian`.`mahasiswa_id` AS `mahasiswa_id`,'' AS `box`,`h_ujian`.`nilai_bobot` AS `total`,`m_ujian`.`nama_ujian` AS `title`,'' AS `icon`,'' AS `url`,`m_ujian`.`matkul_id` AS `matkul_id` from (((`h_ujian` join `mahasiswa` on((`h_ujian`.`mahasiswa_id` = `mahasiswa`.`id_mahasiswa`))) join `kelas` on((`mahasiswa`.`kelas_id` = `kelas`.`id_kelas`))) join `m_ujian` on((`h_ujian`.`ujian_id` = `m_ujian`.`id_ujian`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `matkul_id` (`matkul_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `h_ujian`
--
ALTER TABLE `h_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ujian_id` (`ujian_id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fjenis` (`id_matkul`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `jurusan_matkul`
--
ALTER TABLE `jurusan_matkul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusan_id` (`jurusan_id`),
  ADD KEY `matkul_id` (`matkul_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `kelas_dosen`
--
ALTER TABLE `kelas_dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `m_dokumen`
--
ALTER TABLE `m_dokumen`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indexes for table `m_ujian`
--
ALTER TABLE `m_ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `matkul_id` (`matkul_id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `matkul_id` (`matkul_id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`),
  ADD UNIQUE KEY `uc_email` (`email`) USING BTREE;

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `h_ujian`
--
ALTER TABLE `h_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurusan_matkul`
--
ALTER TABLE `jurusan_matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas_dosen`
--
ALTER TABLE `kelas_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_dokumen`
--
ALTER TABLE `m_dokumen`
  MODIFY `id_dokumen` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `m_ujian`
--
ALTER TABLE `m_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id_matkul`);

--
-- Constraints for table `h_ujian`
--
ALTER TABLE `h_ujian`
  ADD CONSTRAINT `h_ujian_ibfk_1` FOREIGN KEY (`ujian_id`) REFERENCES `m_ujian` (`id_ujian`),
  ADD CONSTRAINT `h_ujian_ibfk_2` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id_mahasiswa`);

--
-- Constraints for table `jenis`
--
ALTER TABLE `jenis`
  ADD CONSTRAINT `fjenis` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`);

--
-- Constraints for table `jurusan_matkul`
--
ALTER TABLE `jurusan_matkul`
  ADD CONSTRAINT `jurusan_matkul_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id_jurusan`),
  ADD CONSTRAINT `jurusan_matkul_ibfk_2` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id_matkul`);

--
-- Constraints for table `kelas_dosen`
--
ALTER TABLE `kelas_dosen`
  ADD CONSTRAINT `kelas_dosen_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id_dosen`),
  ADD CONSTRAINT `kelas_dosen_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `m_ujian`
--
ALTER TABLE `m_ujian`
  ADD CONSTRAINT `m_ujian_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id_dosen`),
  ADD CONSTRAINT `m_ujian_ibfk_2` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id_matkul`);

--
-- Constraints for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD CONSTRAINT `tb_soal_ibfk_1` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id_matkul`),
  ADD CONSTRAINT `tb_soal_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id_dosen`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
