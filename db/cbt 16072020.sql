-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2020 at 02:34 PM
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
(1, '12345678', 'Koro Sensei', 'korosensei@gmail.com', 1),
(3, '01234567', 'Tobirama Sensei', 'tobirama@gmail.com', 2),
(4, '90698721', 'Obet', 'obet@obet.com', 2),
(5, '12345679', 'irawati', 'irawati@email.com', 2);

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
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `h_ujian`
--

INSERT INTO `h_ujian` (`id`, `ujian_id`, `mahasiswa_id`, `list_soal`, `list_jawaban`, `jml_benar`, `nilai`, `nilai_bobot`, `tgl_mulai`, `tgl_selesai`, `status`) VALUES
(1, 1, 1, '1,2,3', '1:B:N,2:A:N,3:D:N', 3, '100.00', '100.00', '2019-02-16 08:35:05', '2019-02-16 08:36:05', 'N'),
(2, 2, 1, '3,2,1', '3:D:N,2:C:N,1:D:N', 1, '33.00', '100.00', '2019-02-16 10:11:14', '2019-02-16 10:12:14', 'N'),
(3, 3, 1, '5,6', '5:C:N,6:D:N', 2, '100.00', '100.00', '2019-02-16 11:06:25', '2019-02-16 11:07:25', 'N'),
(5, 5, 2, '8,7', '8:D:N,7:D:N', 1, '50.00', '350.00', '2020-01-26 11:19:56', '2020-01-26 11:39:56', 'N'),
(27, 4, 2, '7,8,9', '7:B:N,8:C:N,9:A:N', 1, '5.00', '5.00', '2020-07-14 17:12:19', '2020-07-14 18:42:19', 'N'),
(31, 6, 3, '1,2,3,5,6,7,8,9,10,11', '1:B:N,2:A:N,3:D:N,5:C:N,6:D:N,7:D:N,8:B:N,9:A:N,10:B:N,11:B:N', 9, '45.00', '45.00', '2020-07-15 08:16:04', '2020-07-15 09:46:04', 'N'),
(32, 2, 3, '0', '::N', 0, '0.00', '0.00', '2020-07-15 09:19:31', '2020-07-15 09:20:31', 'Y'),
(33, 6, 41, '1,2,3,5,6,7,8,9,10,11', '1:A:N,2:B:N,3:A:N,5:B:N,6:B:N,7:C:N,8:B:N,9:A:N,10:A:N,11:B:N', 4, '20.00', '20.00', '2020-07-16 13:18:57', '2020-07-16 14:48:57', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int(11) NOT NULL,
  `tipe` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `tipe`) VALUES
(1, 'TWK'),
(2, 'TIU'),
(3, 'TKP');

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
(1, 'Paket Soal'),
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
(1, 3, 1),
(2, 2, 1),
(3, 1, 1),
(11, 3, 4),
(15, 2, 3),
(16, 1, 3),
(18, 1, 5),
(19, 2, 5),
(20, 3, 5);

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
(17, '::1', 'copycut73@gmail.com', 1594872376),
(18, '::1', 'copycut79@gmail.com', 1594877311),
(19, '::1', 'copycut85@gmail.com', 1594879956),
(20, '::1', 'copycut85@gmail.com', 1594880038),
(21, '::1', 'copycut92@gmail.com1', 1594899031);

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
  `kelas_id` int(11) NOT NULL COMMENT 'kelas&jurusan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama`, `nim`, `email`, `jenis_kelamin`, `kelas_id`) VALUES
(1, 'Muhammad Ghifari Arfananda', '12183018', 'mghifariarfan@gmail.com', 'L', 1),
(2, 'sugik', '1630511000', 'copycut7@gmail.com', 'L', 2),
(3, 'arfan', '12345677', 'arfan@email.com', 'L', 3),
(7, 'user71', 'copycut71@gmail.com', 'copycut71@gmail.com', 'L', 1),
(8, 'user72', 'copycut72@gmail.com', 'copycut72@gmail.com', 'P', 1),
(21, 'user73', 'copycut73@gmail.com', 'copycut73@gmail.com', 'L', 1),
(22, 'user74', 'copycut74@gmail.com', 'copycut74@gmail.com', 'L', 1),
(24, 'user75', 'copycut75@gmail.com', 'copycut75@gmail.com', 'L', 1),
(25, 'user76', 'copycut76@gmail.com', 'copycut76@gmail.com', 'L', 1),
(27, 'user77', 'copycut77@gmail.com', 'copycut77@gmail.com', 'L', 1),
(28, 'user78', 'copycut78@gmail.com', 'copycut78@gmail.com', 'L', 1),
(30, 'user79', 'copycut79@gmail.com', 'copycut79@gmail.com', 'L', 1),
(31, 'user70', 'copycut70@gmail.com', 'copycut70@gmail.com', 'L', 1),
(33, 'user80', 'copycut80@gmail.com', 'copycut80@gmail.com', 'L', 1),
(35, 'user81', 'copycut81@gmail.com', 'copycut81@gmail.com', 'L', 1),
(36, 'user82', 'copycut82@gmail.com', 'copycut82@gmail.com', 'L', 1),
(37, 'user83', 'copycut83@gmail.com', 'copycut83@gmail.com', 'L', 1),
(39, 'user84', 'copycut84@gmail.com', 'copycut84@gmail.com', 'L', 1),
(40, 'user85', 'copycut85@gmail.com', 'copycut85@gmail.com', 'L', 1),
(41, 'user86', 'copycut86@gmail.com', 'copycut86@gmail.com', 'L', 1),
(42, 'user87', 'copycut87@gmail.com', 'copycut87@gmail.com', 'L', 1),
(43, 'user88', 'copycut88@gmail.com', 'copycut88@gmail.com', 'L', 1),
(44, 'user89', 'copycut89@gmail.com', 'copycut89@gmail.com', 'P', 3),
(45, 'user90', 'copycut90@gmail.com', 'copycut90@gmail.com', 'L', 1),
(47, 'user91', 'copycut91@gmail.com', 'copycut91@gmail.com', 'L', 2),
(51, 'user92', 'copycut92@gmail.com', 'copycut92@gmail.com', 'L', 2),
(52, 'user93', 'copycut93@gmail.com', 'copycut93@gmail.com', 'L', 3);

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
  `token` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_ujian`
--

INSERT INTO `m_ujian` (`id_ujian`, `dosen_id`, `matkul_id`, `nama_ujian`, `jumlah_soal`, `waktu`, `jenis`, `tgl_mulai`, `terlambat`, `token`) VALUES
(1, 1, 1, 'First Test', 3, 1, 'acak', '2020-07-14 23:52:56', '2020-07-16 23:53:02', '1'),
(2, 1, 1, 'Second Test', 3, 1, 'acak', '2020-07-14 23:52:56', '2020-07-16 23:53:02', '1'),
(3, 3, 2, 'Try Out 01', 2, 1, 'acak', '2020-07-14 23:52:56', '2020-07-16 23:53:02', '1'),
(4, 4, 2, 'Test Pertemuan 1', 3, 90, 'urut', '2020-07-14 23:52:56', '2020-07-16 23:53:02', '1'),
(5, 4, 2, 'UT', 2, 20, 'acak', '2020-07-14 23:52:56', '2020-07-16 23:53:02', '1'),
(6, 5, 2, 'test hasil belajar', 10, 90, 'urut', '2020-07-14 23:52:56', '2020-07-16 23:53:02', '1');

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
  `tipe` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_soal`
--

INSERT INTO `tb_soal` (`id_soal`, `dosen_id`, `matkul_id`, `bobot`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `file_a`, `file_b`, `file_c`, `file_d`, `file_e`, `jawaban`, `created_on`, `updated_on`, `tipe`) VALUES
(1, 5, 2, 5, '', '', '<p>Dian : The cake is scrumptious! I love i<br>Joni : … another piece?<br>Dian : Thank you. You should tell me the recipe.<br>Joni : I will.</p><p>Which of the following offering expressions best fill the blank?</p>', '<p>Do you mind if you have</p>', '<p>Would you like</p>', '<p>Shall you hav</p>', '<p>Can I have you</p>', '<p>I will bring you</p>', '', '', '', '', '', 'B', 1550225760, 1550225760, '1'),
(2, 5, 2, 5, '', '', '<p>Fitri : The French homework is really hard. I don’t feel like to do it.<br>Rahmat : … to help you?<br>Fitri : It sounds great. Thanks, Rahmat!</p><p><br></p><p>Which of the following offering expressions best fill the blank?</p>', '<p>Would you like me</p>', '<p>Do you mind if I</p>', '<p>Shall I</p>', '<p>Can I</p>', '<p>I will</p>', '', '', '', '', '', 'A', 1550225952, 1550225952, '1'),
(3, 5, 2, 5, 'd166959dabe9a81e4567dc44021ea503.jpg', 'image/jpeg', '<p>What is the picture describing?</p><p><small class=\"text-muted\">Sumber gambar: meros.jp</small></p>', '<p>The students are arguing with their lecturer.</p>', '<p>The students are watching their preacher.</p>', '<p>The teacher is angry with their students.</p>', '<p>The students are listening to their lecturer.</p>', '<p>The students detest the preacher.</p>', '', '', '', '', '', 'D', 1550226174, 1550226174, '1'),
(5, 5, 2, 5, '', '', '<p>(2000 x 3) : 4 x 0 = ...</p>', '<p>NULL</p>', '<p>NaN</p>', '<p>0</p>', '<p>1</p>', '<p>-1</p>', '', '', '', '', '', 'C', 1550289702, 1550289724, '1'),
(6, 5, 2, 5, '98a79c067fefca323c56ed0f8d1cac5f.png', 'image/png', '<p>Nomor berapakah ini?</p>', '<p>Sembilan</p>', '<p>Sepuluh</p>', '<p>Satu</p>', '<p>Tujuh</p>', '<p>Tiga</p>', '', '', '', '', '', 'D', 1550289774, 1550289774, '1'),
(7, 5, 2, 5, '', '', '<p>Dalam memanggil variabel nama pada sintaks PHP , manakah yang tepat ?</p>', '<p>&lt;!--?php cout var nama ?--&gt;<br></p>', '<p>&lt;!--? echo \"nama\" ?--&gt;<br></p>', '<p>&lt;!--?php $nama ?--&gt;<br></p>', '<p>&lt;!--?= $nama ?--&gt;<br></p>', '<p>&lt;!--?= $namao ?--&gt;<br></p>', '', '', '', '', '', 'D', 1578922768, 1594646990, '1'),
(8, 5, 2, 5, '', '', '<p>Pada bahasa pemrograman Python untuk membuat class mengunakan tag ? </p>', '<p>class</p>', '<p>def</p>', '<p>var</p>', '<p>get</p>', '<p>let</p>', '', '', '', '', '', 'B', 1578922867, 1594724004, '1'),
(9, 5, 2, 5, '1e5b315df133acc8c7ffcce5e54d92c7.jpg', 'image/jpeg', '<p>bunga apa ini</p>', '<p>angrek</p>', '<p>b</p>', '<p>c</p>', '<p>d</p>', '<p>e</p>', '781e1e52148fa55a3e5a316558d776cb.jpg', '', '', '', '', 'A:5,B:4,C:3,D:2,E:1', 1594644191, 1594805162, '3'),
(10, 5, 2, 5, '', '', '<p>1 + 1 =</p>', '<p>a</p>', '<p>b</p>', '<p>c</p>', '<p>d</p>', '<p>e</p>', '', '', '', '', '', 'A', 1594658293, 1594723907, '2'),
(11, 5, 2, 5, '', '', '<p>G</p>', '<p>J</p>', '<p>H</p>', '<p>J</p>', '<p>H</p>', '<p>J</p>', '', '', '', '', '', 'B', 1594725942, 1594725942, '2'),
(12, 5, 2, 5, '', '', '<p>5 x 2 =</p>', '<p>2</p>', '<p>4</p>', '<p>6</p>', '<p>8</p>', '<p>10</p>', '', '', '', '', '', 'E', 1594733674, 1594795514, '2'),
(15, 5, 2, 5, '', '', 'Makna dari semboyan Bhinneka Tunggal Ika adalah ...', 'Bersama dalam kemajemukan', 'Berbeda-beda tetapi tetap satu', 'Berbeda-beda suku bangsa', 'Berbeda-beda dalam keragaman', 'Bersama dalam perbedaan kebudayaan', '', '', '', '', '', 'B', 0, NULL, '1'),
(16, 4, 2, 5, '', '', 'Untuk mengambil keputusan dalam suatu rapat, banyak cara yang digunakan. Cara yang cocok untuk bangsa Indonesia adalah ...', 'Suara terbanyak', 'Aklamasi pada kuorum ', 'Musyawarah dan mufakat', 'Perwakilan dan utusan', 'Bergantung pada pemimpin', '', '', '', '', '', 'C', 0, NULL, '1'),
(35, 5, 2, 1, '', '', '<p>apa yang kamu lakukan juka sedih ?</p>', '<p>merenung</p>', '<p>memofivasi diri</p>', '<p>makan hingga kekenyangan</p>', '<p>jalan jalan</p>', '<p>tidur AJA</p>', '', '', '', '', '', 'A:1,B:5,C:2,D:4,E:3', 1594795839, 1594797036, '3'),
(36, 5, 2, 5, '', '', '<p>1</p>', '<p>2</p>', '<p>3</p>', '<p>4</p>', '<p>5</p>', '<p>6</p>', '', '', '', '', '', 'C', 1594796705, 1594804889, '2'),
(37, 5, 2, 5, 'ed187da7d4d711276efa622981a108c7.jpg', 'image/jpeg', '<p>a</p>', '<p>b</p>', '<p>c</p>', '<p>d</p>', '<p>e</p>', '<p>f</p>', 'cc16751710ac9498d46e5472a4cbb5e3.jpg', '', '', '', '', 'A', 1594805242, 1594806070, '2'),
(38, 5, 2, 5, 'e66b71786de51d79be4f1cf4510d1b49.jpg', 'image/jpeg', '<p>a</p>', '<p>b</p>', '<p>c</p>', '<p>d</p>', '<p>e</p>', '<p>f</p>', '8317a674c07f05e01453c5780e9a6d79.jpg', '6615db7fa8719994b897eb33995924d4.jpeg', '91dd9b1d66d95d3420af157a9a5b4e10.jpg', '0d14dffeb778b28e665d55657f2ad4f7.jpg', '550df5a20bf05a41543a286dbaf0f995.jpg', 'A:1,B:2,C:3,D:4,E:5', 1594806271, 1594817602, '3');

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
(1, '127.0.0.1', 'Administrator', '$2y$12$IyfdcEkURIwqqsnVgl.WCe6MrFSLkW0kJwRzaj89sifWfspXocRqW', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1594901789, 1, 'Admin', 'Istrator', 'ADMIN', '0'),
(3, '::1', '12183018', '$2y$10$BHEbsD3M73gACh3AkDGwo.2W5nCLtWCauJ9Sw5tEyIMpnOZV3UY8O', 'mghifariarfan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1550225511, 1550743572, 1, 'Muhammad', 'Arfananda', NULL, NULL),
(4, '::1', '12345678', '$2y$10$BHEbsD3M73gACh3AkDGwo.2W5nCLtWCauJ9Sw5tEyIMpnOZV3UY8O', 'korosensei@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1550226286, 1550743600, 1, 'Koro', 'Sensei', NULL, NULL),
(8, '::1', '01234567', '$2y$10$BHEbsD3M73gACh3AkDGwo.2W5nCLtWCauJ9Sw5tEyIMpnOZV3UY8O', 'tobirama@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1550289356, 1578922272, 1, 'Tobirama', 'Sensei', NULL, NULL),
(9, '::1', '1630511000', '$2y$10$BHEbsD3M73gACh3AkDGwo.2W5nCLtWCauJ9Sw5tEyIMpnOZV3UY8O', 'copycut7@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1578921390, 1594901842, 1, 'sugik', 'sugik', NULL, NULL),
(10, '::1', '90698721', '$2y$10$BHEbsD3M73gACh3AkDGwo.2W5nCLtWCauJ9Sw5tEyIMpnOZV3UY8O', 'obet@obet.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1578922398, 1594653530, 1, 'Obet', 'Obet', NULL, NULL),
(11, '::1', '12345679', '$2y$10$LfYd4TI3MmvtEeZG8OMmMe0nO5yYioL4HEmNP5g9FZ2xjqUCymk5C', 'irawati@email.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594651719, 1594820412, 1, 'irawati', 'irawati', NULL, NULL),
(12, '::1', '12345677', '$2y$10$wnr7WZgpQ2tjmqR.6Jm.h.Z3uwgkwx5JSonZtvaOUDOvxcF8zO8YS', 'arfan@email.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594739538, 1594777840, 1, 'arfan', 'arfan', NULL, NULL),
(13, '::1', 'copycut73@gmail.com', '$2y$10$Jlz40a5ZmcCjQ06bh7BhuOKc0yf9tOI9WIBlwnsp6SvfTOXsOwCKG', 'copycut73@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594872452, NULL, 1, 'ozil', 'ozil', NULL, NULL),
(14, '', 'copycut79@gmail.com', 'copycut79@gmail.com', 'copycut79@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'jambu', 'jambu', NULL, NULL),
(15, '', 'copycut70@gmail.com', 'copycut70@gmail.com', 'copycut70@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'badak2', 'badak2', NULL, NULL),
(16, '', 'copycut82@gmail.com', 'copycut82@gmail.com', 'copycut82@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'jambu', 'jambu', NULL, NULL),
(17, '', 'copycut84@gmail.com', '$2y$10$1aPjKUuByCxe9/1BAkrEp.q8P2Nm0bCXAP0..KHv0HJ6o0UWSsEaq', 'copycut84@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'jambu', 'jambu', NULL, NULL),
(18, '', 'copycut85@gmail.com', '79653446c8233a3992873e9c33cf67bd625628f634787d6d6f1d159b21f1f096f28069c18207811436e75f89a3d6cd50d52e75e9876014c928b95994484f0d57ls1dq1YHhYKev0pdCjENRQQs1QwAGqis6WMPFOeB49k9VKxDPY1C3%2FUwHMXTon0E', 'copycut85@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ozil', 'ozil', NULL, NULL),
(19, '::1', 'copycut86@gmail.com', '$2y$10$EwLB0taS4KDxjrcdUzwkTuECtPjNZ29xlcvzxTggRjKoQFrARkAL2', 'copycut86@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594880180, 1594880262, 1, 'ozil', 'ozil', NULL, NULL),
(20, '::1', 'copycut87@gmail.com', '$2y$10$IQhAuy9Dr8Sx6vxWNx/sbu0tyJaETP7FF7GFuYzYOSK6u8ZX3iIr6', 'copycut87@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594880827, 1594880839, 1, 'cahaya', 'cahaya', NULL, NULL),
(21, '::1', 'copycut88@gmail.com', '$2y$10$8GygT1x.ebJiWHcXnzP3VO8iUZNrCCtdOtCrlflOuScxTiY2ig3.C', 'copycut88@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594888581, 1594888707, 1, 'jambu', 'jambu', NULL, NULL),
(22, '::1', 'copycut89@gmail.com', '$2y$10$jh9zma6prM/0nYKgHqUQXecVfb2nwuEO1aldSo3MfB4gww3norIM.', 'copycut89@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594889109, 1594889264, 1, 'jambu', 'jambu', NULL, NULL),
(23, '::1', 'copycut90@gmail.com', '$2y$10$E/qk1AsBEFsfJruJKyoGHuWaL9vBbjYCGLaXLTbFswGRDP39ASP.e', 'copycut90@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594889712, NULL, 1, 'cahaya', 'cahaya', NULL, NULL),
(24, '::1', 'copycut91@gmail.com', '$2y$10$QwD9QYGsDoUMB/Jmq4nJ.ukoxvFlLIbZbBKqPD3xxToCxEnG.RoMm', 'copycut91@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594897642, NULL, 1, 'ozil', 'ozil', NULL, NULL),
(25, '::1', 'copycut92@gmail.com', '$2y$10$YptjOkLMLD94rZdz7ltPo.epfCTfozGm4wgRvIWFtPzYppwVrMKla', 'copycut92@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594898940, 1594899040, 1, 'jambu', 'jambu', NULL, NULL),
(26, '::1', 'copycut93@gmail.com', '$2y$10$0ME.oupO6N3P9msEtcRXUOiA8EP53JEi/yaXvRevfbbyRBstmB9iq', 'copycut93@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594899505, NULL, 1, 'user93', 'user93', NULL, NULL);

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
(23, 26, 3);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `h_ujian`
--
ALTER TABLE `h_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_ujian`
--
ALTER TABLE `m_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
