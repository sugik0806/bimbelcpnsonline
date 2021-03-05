-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2020 at 11:09 PM
-- Server version: 10.3.25-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bimbelcp_bimbelcpnsonline`
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
(1, 1, 1, '160,157,145,162,138,147,163,161,31,158,136,139,140,151,146,149,153,152,150,159,148,135,141,137,142,154,143,155,144,156,177,191,168,172,196,167,171,166,193,197,183,182,185,184,194,179,178,164,176,186,174,195,173,190,169,192,175,180,170,198,189,165,187,188,181,200,213,202,215,224,217,228,222,225,201,233,232,219,206,218,210,230,226,221,216,223,204,205,214,231,209,227,220,208,203,229,211,212,199,207', '160:C:N,157:C:N,145:D:N,162:C:N,138:B:N,147:D:N,163:D:N,161:C:N,31:B:N,158:D:N,136:C:N,139:C:N,140:B:N,151:B:N,146:D:N,149:B:N,153:B:N,152:D:N,150:B:N,159:D:N,148:C:N,135:C:N,141:B:N,137:C:N,142:E:N,154:A:N,143:C:N,155:C:N,144:C:N,156:D:N,177:C:N,191:B:N,168:D:N,172:B:N,196:A:N,167:E:N,171:E:N,166:D:N,193:E:N,197:D:N,183:C:N,182:B:N,185:D:N,184:C:N,194:C:N,179:B:N,178:A:N,164:C:N,176:B:N,186:D:N,174:B:N,195:A:N,173:D:N,190:E:N,169:D:N,192:D:N,175:E:N,180:D:N,170:C:N,198:D:N,189:E:N,165:D:N,187:E:N,188:D:N,181:E:N,200:D:N,213:C:N,202:E:N,215:E:N,224:D:N,217:E:N,228:D:N,222:E:N,225:D:N,201:C:N,233:E:N,232:D:N,219:C:N,206:C:N,218:D:N,210:C:N,230:D:N,226:E:N,221:D:N,216:D:N,223:E:N,204:E:N,205:D:N,214:E:N,231:D:N,209:E:N,227:D:N,220:D:N,208:E:N,203:E:N,229:E:N,211:E:N,212:E:N,199:E:N,207:D:N', 21, 178.00, 178.00, '2020-12-11 23:02:49', '2020-12-12 00:32:49', 'N', 'Y', 25, 45, 108);

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
(2, 'Paket Soal'),
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
  `jurusan_id` int(11) NOT NULL,
  `harga` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `jurusan_id`, `harga`) VALUES
(1, 'Kls. Paket Materi', 1, 150000),
(2, 'Kls. Paket Soal', 2, 250000),
(3, 'Kls. Paket Bimbel', 3, 350000);

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

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(254) NOT NULL,
  `email` varchar(254) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `kelas_id` int(11) NOT NULL COMMENT 'kelas&jurusan',
  `id_matkul` int(11) NOT NULL,
  `whatsapp` varchar(50) NOT NULL,
  `token` varchar(10) NOT NULL,
  `url_bukti` varchar(255) DEFAULT NULL,
  `angka_unik` int(3) NOT NULL,
  `tanggal_daftar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama`, `nim`, `email`, `jenis_kelamin`, `kelas_id`, `id_matkul`, `whatsapp`, `token`, `url_bukti`, `angka_unik`, `tanggal_daftar`) VALUES
(1, 'sugik', 'copycut7@gmail.com', 'copycut7@gmail.com', 'L', 3, 2, '', '', NULL, 1, NULL),
(2, 'arfan', 'arfan@email.com', 'arfan@email.com', 'L', 2, 2, '', '', NULL, 2, NULL),
(3, 'Wati', 'irawatirsmw@gmail.com', 'irawatirsmw@gmail.com', 'P', 1, 2, '', '', NULL, 3, NULL),
(4, 'bimbelcpnsonline', 'kusmanto.sugik@gmail.comx', 'kusmanto.sugik@gmail.comx', 'L', 1, 2, '345345', '', NULL, 4, NULL),
(7, 'sug', 'kusmanto.sugik@gmail.com', 'kusmanto.sugik@gmail.com', 'L', 3, 2, '08883005734', 'CULJS', NULL, 5, NULL),
(8, 'Arief nurbowo', 'ariefnurbo@gmail.com', 'ariefnurbo@gmail.com', 'L', 1, 2, '08563001184', 'TFWXT', NULL, 6, NULL),
(9, 'Wati', 'irawati01101988@gmail.com', 'irawati01101988@gmail.com', 'P', 2, 2, '082244795027', 'MUDWR', '90cf15d9f6f246d2bc238ed6434f370d.png', 940, NULL);

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
(10, 'Soal CPNS All New Tes CPNS 2018', 2, 2, 'Soal CPNS All New Tes CPNS 2018.pdf'),
(11, 'test update tiu 50', 2, 2, 'e6edc19821918356175167aa7c844850.pdf');

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
(1, 1, 2, 'Paket SKD 1', 100, 90, 'acak', '2020-11-24 18:52:56', '2020-12-31 20:09:30', 'EGTVS', 1),
(2, 1, 2, 'Paket SKD 2', 100, 90, 'acak', '2020-10-13 18:00:00', '2020-12-31 19:30:00', 'EKJTD', 1),
(3, 1, 1, 'Paket SKB 1', 100, 90, 'acak', '2020-08-25 18:00:00', '2020-08-29 19:30:00', 'TQLVQ', 0),
(4, 1, 2, 'Paket SKD 3', 100, 90, 'acak', '2020-08-25 08:38:34', '2020-08-25 10:09:30', 'QKJOC', 0),
(5, 1, 1, 'Paket SKB 2', 100, 90, 'acak', '2020-08-23 07:30:51', '2020-08-28 10:09:30', 'EGJSO', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_detail`
--

CREATE TABLE `pertanyaan_detail` (
  `id_pertanyaan` int(255) NOT NULL,
  `pertanyaan` text DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `id_soal` int(255) DEFAULT NULL,
  `id_test` int(255) DEFAULT NULL,
  `id_mahasiswa` int(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `answer_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_ujian` int(11) DEFAULT NULL,
  `pembahasan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_soal`
--

INSERT INTO `tb_soal` (`id_soal`, `dosen_id`, `matkul_id`, `bobot`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `file_a`, `file_b`, `file_c`, `file_d`, `file_e`, `jawaban`, `created_on`, `updated_on`, `tipe`, `id_ujian`, `pembahasan`) VALUES
(1, 1, 2, 5, '', '', 'Pemerintah didasarkan atas sistem konstitusi (hukum dasar). Dapat disimpulkan bahwa pemerintah tidak bersifat absolutisme. Yang dimaksud dengan absolutisme adalah kekuasaan yang', 'Terbatas', 'Sangat terbatas', ' Tidak terlalu terbatas', 'Tidak terbatas', 'Terlalu terbatas', '', '', '', '', '', 'D', 1550225760, 1550225760, '1', 2, ''),
(2, 1, 2, 5, '', '', 'Presiden adalah bagian penyelenggara pemerintah Negara yang tertinggi. Meskpun demikian, kedudukan presiden berada di bawah…', 'Ketua MPR', 'Ketua DPR', 'MPR', 'DPR', 'Partai politik', '', '', '', '', '', 'C', 1550225952, 1550225952, '1', 2, ''),
(3, 1, 2, 5, '', '', 'Presiden sebagai Kepala Negara tidak bertanggungjawab kepada Dewan Perwakilan Rakyat. Namun, Presiden juga bukan “diktator”. Pernyataan tersebut dapat berarti…', ' Kekuasaan Presiden terbatas', 'Kekuasaan Presiden tidak terbatas', ' Kekuasaan Presiden tidak tak terbatas', 'Kekuasaan Presiden Kurang Terbatas', 'Semua jawaban salah', '', '', '', '', '', 'C', 1550226174, 1550226174, '1', 2, ''),
(4, 1, 2, 5, '', '', 'Bagian batang tubuh UUD 1945 memiliki keterkaitan dengan Pembukaan. Pada hakikatnya, bagian batang tubuh adalah…', 'Penjabaran rinci pokok-pokok pikiran dari pembukaan', 'Norma-norma dasar kehidupan bernegara bagi bangsa Indonesia', 'Dua dokumen historis dalam kehidupan berbangsa dan bernegara bangsa Indonesia', 'Penjabaran seluruh konsepsi tentang Negara yang terkandung dalam Pembukaan', 'Dasar negara', '', '', '', '', '', 'A', 1550289702, 1594945554, '1', 2, ''),
(5, 1, 2, 5, '', '', 'Ciri utama yang membedakan antara negara kesatuan dengan negara serikat adalah…', 'Negara kesatuan memiliki konstitusi yang tertulis', 'Negara kesatuan memiliki kepala negara yang dipilih rakyat', 'Pemerintahaan Negara kesatuan bersifat demokratis', 'Negara kesatuan terbagi-bagi dalam bagian-bagian negara', 'Negara Kesatuan Bersifat Otoriter', '', '', '', '', '', 'A', 1550289774, 1550289774, '1', 2, ''),
(6, 1, 2, 5, '', '', 'Berikut ini merupakan cakupan pada bidang hukum privat, kecuali…', 'Pengadaan perjanjian jual beli sepetak tanah', 'Seseorang tidak menepati perjanjian menyewa rumah', 'Tindakan menipu orang lain secara sengaja', 'Penuntutan hak waris dari orang tua', 'Berjualan Online', '', '', '', '', '', 'C', 1578922768, 1594646990, '1', 2, ''),
(7, 1, 2, 5, '', '', 'Mahkamah Agung (MA) memiliki hak untuk menguji peraturan perundang-undangan yang berlaku. Hal tersebut berlaku kecuali pada…', 'Peraturan Pemerintah', 'Keputusan Presiden', 'Keputusan Menteri', 'Peraturan Daerah', 'Peraturan Wilayah', '', '', '', '', '', 'D', 1578922867, 1594724004, '1', 2, ''),
(8, 1, 2, 5, '', '', 'Pada pasal 118 ayat 1 Konstitusi Republik Indonesia Serikat, dinyatakan bahwa kedudukan Presiden tidak dapat diganggu gugat. Pernyataan tersebut mengandung makna bahwa Presiden…', ' Memiliki kekuasaan yang cukup luas', 'Berkedudukan sebagai kepala Negara', 'Berkedudukan sebagai kepala pemerintahan', 'Merupakan lembaga tertinggi Negara', 'Berkedudukan sebagai perdana menteri', '', '', '', '', '', 'B', 1594644191, 1594912450, '1', 2, ''),
(9, 1, 2, 5, '', '', 'Berdasarkan peraturan perundang-undangan yang berlaku, di antara orang-orang berikut yang berstatus sebagai Warga Negara Indonesia adalah…', 'Wanita Indonesia yang menikah dengan laki-laki Warga Negara Asing', 'Seseorang yang diangkat sebagai anak oleh Warga Negara Asing', 'Orang Indonesia yang tinggal di luar negeri selama tiga tahun', 'Wanita asing yang putus perkawinan dengan laki-laki Indonesia', 'Wanita asing yang putus perkawinan dengan laki-laki Indonesia', '', '', '', '', '', 'D', 1594658293, 1594723907, '1', 2, ''),
(10, 1, 2, 5, '', '', 'Tindakan paksa mengeluarkan Orang Asing dari Wilayah Indonesia disebut dengan', 'Extradisi', 'Remunerasi', 'Suaka', 'Transgenerasi', 'Deportasi', '', '', '', '', '', 'E', 1594725942, 1594725942, '1', 2, ''),
(11, 1, 2, 5, '', '', 'Suku Mentawai mendiami daerah..', 'Sumatera Barat', 'Riau', 'Sumatera Selatan', 'Kalimantan Timur', 'Kalimantan Barat', '', '', '', '', '', 'A', 1594733674, 1594795514, '1', 2, ''),
(12, 1, 2, 5, '', '', 'Ibukota negara Indonesia sempat dipindahkan ke Yogyakarta pada tanggal..', '4 Januari 1946', '14 Januari 1946', '4 Januari 1947', '14 Januari 1947', '11 Januari 1948', '', '', '', '', '', 'A', 0, 0, '1', 2, ''),
(13, 1, 2, 5, '', '', 'Panitia Pemilu Pusat 2009 adalah ...', 'KPK', 'MPR', 'DPR', 'KPU', 'PRESIDEN', '', '', '', '', '', 'D', 0, 0, '1', 2, ''),
(14, 1, 2, 5, '', '', 'Sistem pemerintahan Indonesia pada masa negara Indonesia Serikat yang dipimpin oleh perdana menteri, hal itu menunjukkan sistem pemerintahannya adalah ....\r\n', 'Presidensial', 'Parlementer', 'Perdana Menteri', 'Ekstra Parlementer', 'Konstitusiaonal\r\n\r\n\r\nArtikel ini telah tayang di tribun-timur.com dengan judul 30 Contoh Soal TWK SKD CPNS 2019 Resmi dari Portal CAT BKN, Lengkap dengan Jawaban dan Pembahasan, https://makassar.tribunnews.com/2020/01/26/30-contoh-soal-twk-skd-cpns-2019-resmi-dari-portal-cat-bkn-lengkap-dengan-jawaban-dan-pembahasan?page=4.\r\n\r\nEditor: Sakinah Sudin', '', '', '', '', '', 'B', 1594795839, 1594797036, '1', 2, ''),
(15, 1, 2, 5, '', '', 'Dalam kebijakan nasional, pejabat pemerintah tingkat daerah (lokal) berkewajiban menetapkan kebijakan', 'Sosial ekonomi', 'Politik', 'Teknis operasional', 'Eksekutif', 'Administratif', '', '', '', '', '', 'C', 1594796705, 1594804889, '1', 2, ''),
(16, 1, 2, 5, '', '', 'Suatu Konsepsi yang eksplisit khas dari perorangan atau kelompok mengenai sesuatu yang didambakan merupakan pengertian dari nilai menurut ....', 'Max Scheller', 'Nursal Luth', 'Kluckhoorn', 'Kamus Ilmiah Populer', 'Nietzche', '', '', '', '', '', 'C', 1594805242, 1594806070, '1', 2, ''),
(17, 1, 2, 5, '', '', 'Di bawah ini yang bukan merupakan pahlawan pergerakan nasional Indonesia ialah :', 'Dewi Sartika', 'Hasyim Asy’ari', 'Untung Surapati', 'Cipto Mangunkusumo', 'Danudirja Setiabudi', '', '', '', '', '', 'C', 1594806271, 1594817602, '1', 2, ''),
(18, 1, 2, 5, '', '', 'Di Indonesia, lembaga yang berhak melakukan constitutional review adalah', 'DPR', 'MPR', 'KY', 'MK', 'MA', '', '', '', '', '', 'D', 0, 0, '1', 2, ''),
(19, 1, 2, 5, '', '', 'Pada tanggal 27 - 28 Oktober 1928 diadakan Kongres Pemuda II di Jalan Kramat No. 106 Jakarta dipimpin oleh . . . .', 'Sugondo Joyopuspito', 'Muhammad Yamin', 'A.K. Gani', 'Tjio Djien Kwie', 'Wonsonegoro', '', '', '', '', '', 'A', 0, 0, '1', 2, ''),
(20, 1, 2, 5, '', '', 'BPUPKI membentuk panitia kecil yang beranggotakan sembilan orang pada tanggal 22 Juni 1945. Berikut termasuk anggota panitia sembilan, kecuali. . .', '<p>Mr. Achmad Soebardjo</p>', '<p>Mohammad Yamin</p>', '<p>Agus Salim</p>', '<p>Abikusno Cokrosuyoso</p>', '<p>Supomo</p>', '', '', '', '', '', 'E', 0, 1607653329, '1', 2, ''),
(21, 1, 2, 5, '', '', 'Nilai - nilai Pancasila yang dilaksanakan dalam kehidupan sehari - hari disebut juga ...', 'Nilai dasar', 'Nilai Fleksibilitas', 'Nilai Instrumental', 'Nilai Praksis', 'Nilai Kehidupan', '', '', '', '', '', 'D', 0, 0, '1', 2, ''),
(22, 1, 2, 5, '', '', 'Jika dibandingkan dengan kabinet parlementer kelebihan kabinet presidensiil adalah dalam hal', 'Pembentukan kabinet sangat demokratis', 'Jalannya pemerintahan lebih stabil', 'Para menteri bertanggung jawab secara kolektif', 'Para menteri dapat diganti sewaktu-waktu', 'Pemerintahan lebih mencerminkan aspirasi rakyat', '', '', '', '', '', 'B', 0, 0, '1', 2, ''),
(23, 1, 2, 5, '', '', 'Di bawah ini Undang-Undang tentang pemerintah Daerah yang pernah berlaku di Indonesia, kecuali', 'Undang - Undang Nomor 1 tahun 1957', 'Undang - Undang Nomor 5 tahun 1975', 'Undang - Undang Nomor 18 tahun 1965', 'Undang - Undang Nomor 25 Tahun 1999', 'Undang - Undang Nomor 22 tahun 1948', '', '', '', '', '', 'D', 0, 0, '1', 2, ''),
(24, 1, 2, 5, '', '', 'Pertunjukkan tradisional yang berasal dari DKI Jakarta adalah ?', 'Lenong', 'Mamanda', 'Ludruk', 'Kethoprak', 'Makyong', '', '', '', '', '', 'A', 0, 0, '1', 2, ''),
(25, 1, 2, 5, '', '', 'Pemberantasan tindak korupsi di Indonesia saat ini payung hukumnya adalah', 'UU No. 31 Tahun 1999', 'UU No. 20 Tahun 2001', 'UU No. 15 Tahun 2002', 'UU No. 30 Tahun 2002', 'UU No. 7 Tahun 2006', '', '', '', '', '', 'D', 0, 0, '1', 2, ''),
(26, 1, 2, 5, '', '', 'Konferensi Asia Afrika atau yang dikenal KAA dilaksanakan pertama kali di Bandung pada tahun ....', '1945', '1955', '1959', '1965', '1995', '', '', '', '', '', 'B', 0, 0, '1', 2, ''),
(27, 1, 2, 5, '', '', 'Pernyataan untuk memilih kewarganegaraan disampaikan dalam waktu paling lambat ... setelah anak berusia 18 (delapan belas) tahun atau sudah kawin.', '1 tahun', '3 tahun', '5 tahun', '7 tahun', '9 tahun', '', '', '', '', '', 'B', 0, 0, '1', 2, ''),
(28, 1, 2, 5, '', '', 'Suatu fakta yang diurutkan secara kronologis sesuai dengan waktu terjadinya merupakan pengertian dari..', 'fakta', 'priodisasi', 'kronik', 'kronologi', 'sumber', '', '', '', '', '', 'C', 0, 0, '1', 2, ''),
(29, 1, 2, 5, '', '', 'Perjanjian antar dua negara atau lebih menyangkut bidang ekonomi dan politik disebut ..', 'custom', 'jurisprudensi', 'treaty', 'doktrin', 'adat', '', '', '', '', '', 'C', 0, 0, '1', 2, ''),
(30, 1, 2, 5, '', '', 'Republik Indonesia Serikat yang merdeka dan berdaulat ialah suatu negara hukum yang demokrasi dan berbentuk Federasi.Merupakan bunyi Konstitusi RIS 1949 Pasal ..', '1 ayat 1', '2 ayat 1', '1 ayat 2', '2 ayat 2', '1 ayat', '', '', '', '', '', 'A', 0, 0, '1', 2, ''),
(31, 1, 2, 5, '', '', 'Perjanjian bilateral dan multilateral memiliki beberapa perbedaan, salah satunya adalah ...', '<p>objeknya</p>', '<p>sifat instrumennya</p>', '<p>strukturnya</p>', '<p>cara berlakunya</p>', '<p>jumlah pesertanya</p>', '', '', '', '', '', 'E', 0, 1598494002, '1', 1, ''),
(32, 1, 2, 5, '', '', 'Berapakah 25% dari 150', '0.375', '3.75', ' 37.5', '375', '3750', '', '', '', '', '', 'C', 0, 0, '2', 2, ''),
(33, 1, 2, 5, '', '', '4,036 : 0,04 ', '1,009', '100,9', '10,9', '10,09', '109', '', '', '', '', '', 'B', 0, 0, '2', 2, ''),
(34, 1, 2, 5, '', '', '(55 + 30)^2 ', '<p>7175</p>', '<p>7225</p>', '<p>7125</p>', '<p>8025</p>', '<p>9025</p>', '', '', '', '', '', 'B', 0, 1598595574, '2', 2, ''),
(35, 1, 2, 5, '', '', '28 adalah …. persen dari 70 ', '20', '25', '30', '35', '40', '', '', '', '', '', 'E', 0, 0, '2', 2, ''),
(36, 1, 2, 5, '', '', 'KULMINASI =', '<p>Panas terik matahari</p>', '<p>Poros bumi</p>', '<p>Tempat yang digunakan untuk mendinginkan</p>', '<p>Tingkatan tertinggi</p>', '<p>Kondisi emosi seseorang</p>', '', '', '', '', '', 'D', 0, 1598609179, '2', 2, ''),
(37, 1, 2, 5, '', '', 'RESIDU =', '<p>Sisa</p>', '<p>Rasa duka</p>', '<p>Kesedihan</p>', '<p>Alat penyaring</p>', '<p>Gangguan</p>', '', '', '', '', '', 'A', 0, 1598609220, '2', 2, ''),
(38, 1, 2, 5, '', '', 'NUANSA', 'Keseimbangan', 'Perbedaan unsur makna', 'Perbedaan massa', 'Nada', 'Kelangsungan', '', '', '', '', '', 'B', 0, 0, '2', 2, ''),
(39, 1, 2, 5, '', '', 'MONOTON >< ', 'Terus-menerus', 'Berselang-seling', 'Berubah-ubah', 'Bergerak-gerak', 'Berulang-ulang', '', '', '', '', '', 'C', 0, 0, '2', 2, ''),
(40, 1, 2, 5, '', '', 'MAKAR >< ', 'Boleh', 'Jujur', 'Tidak adil', 'Muslihat', 'Menutupi', '', '', '', '', '', 'D', 0, 0, '2', 2, ''),
(41, 1, 2, 5, '', '', 'SPORADIS >< ', 'Jarang', 'Sering', 'Laten', 'Mirip', 'Seperti', '', '', '', '', '', 'A', 0, 0, '2', 2, ''),
(42, 1, 2, 5, '', '', 'Fakta-fakta berikut ini berdasarkan bacaan tersebut di atas benar, kecuali:', 'Tidak seharusnya orang tua menganggap anaknya tidak mungkin terjerumus ke dalam hal-hal yang negatif dan tercela', 'Sangat disayangkan jika orang tua biasanya menjadi sosok terakhir yang mengetahui anaknya terjerumus ke dalam hal-hal yang negatif dan tercela', 'Perhatian orang tua sudah seharusnya diberikan untuk anaknya', 'Pengamatan orang tua pada anaknya akan menyebabkan anak tidak mungkin melakukan hal-hal yang negatif dan tercela', 'Kenyataan adanya seorang anak yang terjerumus ke dalam hal-hal yang negatif dan tercela akan sangat memukul perasaan orang tua', '', '', '', '', '', 'D', 0, 0, '2', 2, ''),
(43, 1, 2, 5, '', '', 'Fakta-fakta berikut ini berdasarkan bacaan tersebut di atas salah, kecuali:', 'Dibandingkan anak lelaki, anak perempuan lebih mengedepankan perasaan dibandingkan pemikirannya sehingga lebih mudah menjadi pecandu narkoba', 'Pengamatan orang tua yang baik pada anaknya membuat anaknya tidak mungkin menjadi pecandu narkoba', 'Anak perempuan yang tidak mendapat pengamatan yang baik dari orang tuanya pasti akan menjadi pecandu narkoba', 'Anak lelaki mempunyai ketahanan tubuh yang lebih baik dibanding anak perempuan sehingga mereka tidak mungkin menjadi pecandu narkoba', 'Pemikiran yang salah dan lemahnya pengamatan bisa menjadi penyebab anak menjadi pecandu narkoba', '', '', '', '', '', 'E', 0, 0, '2', 2, ''),
(44, 1, 2, 5, '', '', 'Fakta-fakta berikut ini berdasarkan bacaan tersebut di atas benar, kecuali:', 'Bagi sebagian kecil remaja putri yang disurvei, narkoba dan alkohol membantu masalah yang mereka hadapi di rumah', 'Bagi sebagian besar remaja putri yang disurvei, narkoba dan alkohol mempunyai manfaat bagi mereka', 'Bagi sebagian besar remaja putri yang disurvei, narkoba dan alkohol membatu mereka untuk melupakan masalah yang tengah mereka hadapi', 'Bagi sebagian remaja laki-laki, narkoba dan alkohol membantu mereka dapat lebih santai dalam menghadapi masalah sosial yang mereka hadapi', 'Bagi sebagian kecil remaja putri yang disurvei, menggunakan alkohol dan narkoba tidak membantu menangani masalah anak-anak di dalam rumah', '', '', '', '', '', 'A', 0, 0, '2', 2, ''),
(45, 1, 2, 5, '', '', 'KERIS : JAWA', 'Badik : Bali', 'Madura : Celurit', 'Kujang : Sunda', 'Pisau : Dapur', 'Aceh : Rencong', '', '', '', '', '', 'C', 0, 0, '2', 2, ''),
(46, 1, 2, 5, '', '', 'BECAK : KENDARAAN', 'Gadis : Orang', 'Bengawan : Sungai', 'Guru : Murid', 'Baja : Belati', 'Kapal : Perahu', '', '', '', '', '', 'A', 0, 0, '2', 2, ''),
(47, 1, 2, 5, '', '', 'LELAH : ISTIRAHAT', 'Gadis : Orang', 'Makan : Lapar', 'Berolahraga : Sehat', 'Haus : Minum', 'Sakit : Obat', '', '', '', '', '', 'D', 0, 0, '2', 2, ''),
(48, 1, 2, 5, '', '', '2, 6, 11, 17, 24, 32, ...., ....', '41 dan 51', '40 dan 50', '40 dan 51', '41 dan 50', '41 dan 52', '', '', '', '', '', 'A', 0, 0, '2', 2, ''),
(49, 1, 2, 5, '', '', '23, 26, 19, 22, 15, 18, ...., ....', '21 dan 14', '21 dan 24', '11 dan 18', '11 dan 4', '11 dan 14', '', '', '', '', '', 'E', 0, 0, '2', 2, ''),
(50, 1, 2, 5, '', '', '9, 15, 8, 15, 7, 15, ...., ....', '6 dan 16', '6 dan 15', '7 dan 15', '7 dan 16', '6 dan 14', '', '', '', '', '', 'B', 0, 0, '2', 2, ''),
(51, 1, 2, 5, 'f9efab197ceaa741d7acbaa8490ab5f7.png', 'image/png', 'huruf apa yang ada di kotak tanda tanya ?', '<p>X dan V</p>', '<p>Y dan Z</p>', '<p>Y dan X</p>', '<p>X dan Z</p>', '<p>Z dan X</p>', '', '', '', '', '', 'C', 1594967033, 1598493848, '2', 2, ''),
(52, 1, 2, 5, '6af40b68b594c9de0f46d261691566c1.png', 'image/png', 'Tentukan angka-angka selanjutnya dari barisan angka di bawah ini.', '', '', '', '', '', 'b521c8777042413c56dae4b9c7712cdb.png', '377202fa9c3d3ae3ef27de02fd179cae.png', '00b24b9c6d7786cbe30a94262ea09806.png', '77e1efac00e4c91f165cd94cc2905acc.png', '622fc46e8480b22cf9e0a019406590bb.png', 'B', 1594968292, 1598493941, '2', 2, ''),
(53, 1, 2, 5, 'f2eeb8bf4a75d79ec3ef1f6211b85c64.png', 'image/png', 'Tentukan angka-angka selanjutnya dari barisan angka di bawah ini.', '<p>3.12</p>', '<p>3.22</p>', '<p>3.52</p>', '<p>4.12</p>', '<p>3.72</p>', '', '', '', '', '', 'A', 1594968801, 1598493915, '2', 2, ''),
(54, 1, 2, 5, '60476fd5726717c59c7b91741e4f69d3.png', 'image/png', 'Tentukan angka-angka selanjutnya dari barisan angka di bawah ini.', '<p>6.6</p>', '<p>5.6</p>', '<p>4.6</p>', '<p>3.6</p>', '<p>2.6</p>', '', '', '', '', '', 'D', 1594969073, 1598493889, '2', 2, ''),
(55, 1, 2, 5, '', '', '(27 + 34)2 – 2345 = ……', '1176', '1276', '1376', '1367', '1267', '', '', '', '', '', 'C', 0, 0, '2', 2, ''),
(56, 1, 2, 5, '', '', 'Berapa persen (%)-kah 36 dari 80?', '<p>30</p>', '<p>35</p>', '<p>40</p>', '<p>45</p>', '<p>48</p>', '', '', '', '', '', 'D', 0, 1598593215, '2', 2, '<p>36 x 100 / 80 = 45</p>'),
(57, 1, 2, 5, '', '', '4.	Jika	a = 4,5 dan b = 5,4\r\nc = a + b2\r\nmaka, hasil (a2 × b) – c adalah …', '<p>76.59</p>', '<p>75.69</p>', '<p>75.96</p>', '<p>75.95</p>', '<p>74.59</p>', '', '', '', '', '', 'B', 0, 1598595246, '2', 2, ''),
(58, 1, 2, 5, '', '', 'Seorang penjual buah membeli buah dengan harga Rp450.000,00, dan pedagang tersebut berhasil menjual semuanya dengan harga Rp573.750,00. Berapakah persentase keuntungan yang didapat oleh penjual buah itu?', '<p>20%</p>', '<p>22.5%</p>', '<p>25%</p>', '<p>25.5%</p>', '<p>27.5%</p>', '', '', '', '', '', 'E', 0, 1598592614, '2', 2, ''),
(59, 1, 2, 5, '', '', 'Seseorang mendapatkan hadiah mobil dalam suatu program televisi. Di pasaran umum, harga mobil tersebut adalah Rp150.000.000,00.Adapun pajak ditetapkan 2/3 dari harga tersebut. Jika ia diharuskan membayar pajak sebesar Rp450,00 per Rp1.000,00, berapakah besarnya pajak yang harus dibayarnya?', 'Rp. 45.000.000', 'Rp.37.500.000', 'Rp. 30.000.000', 'Rp. 25.750.000', 'Rp. 25.000.000', '', '', '', '', '', 'A', 0, 0, '2', 2, ''),
(60, 1, 2, 5, '', '', 'Dari pembagiannya dengan Budi, Ahmad mendapatkan bagian 62,5%, yakni sebesar Rp3.200.000,00.\r\nBerapakah selisih uang Ahmad dan Budi?\r\n', 'Rp1.380.000,00', 'Rp1.280.000,00', 'Rp1.180.000,00', 'Rp1.080.000,00', 'Rp980.000,00', '', '', '', '', '', 'B', 0, 0, '2', 2, ''),
(61, 1, 2, 5, '', '', 'Keseluruhan jumlah televisi dagangan Rudi adalah 56 buah. Di dalam gudang terdapat 24 buah televisi lebih banyak dibandingkan televisi-televisi yang dipajang di etalase toko.\r\nBerapakah jumlah televisi di dalam gudang Rudi?\r\n', '36', '38', '40', '42', '44', '', '', '', '', '', 'C', 0, 0, '2', 2, ''),
(62, 1, 2, 5, '', '', 'Jika keliling sebuah lingkaran 34,53 meter, berapakah jari-jarinya?', '4.5 m', '5,5 m', '6,5 m', '7,5 m', '8,5  m', '', '', '', '', '', 'B', 0, 0, '2', 2, ''),
(63, 1, 2, 5, '', '', 'Hanya anak keturunan Ken Arok yang menjadi raja di Singasari.\r\nKertanegara adalah raja terakhir Singasari. Gajah Mada bukan anak keturunan Ken Arok.\r\nPernyataan yang sesuai dengan pernyataan di atas adalah …\r\n', 'Gajah Mada menjabat Patih Singasari.', 'Kertanegara bukan keturunan Ken Arok namun menjadi raja Singasari.', 'Gajah Mada bukan Patih Singasari tetapi Patih Majapahit.', 'Meski bukan anak keturunan Ken Arok, Gajah Mada menjadi raja Singasari.', 'Ken Arok merupakan leluhur Kertanegara.', '', '', '', '', '', 'E', 0, 0, '2', 2, ''),
(64, 1, 2, 5, '', '', 'Suatu keluarga mempunyai empat orang anak yang bergelar sarjana. A memperoleh gelar sarjana sesudah C, B menjadi sarjana sebelum D dan bersamaan dengan A. Siapakah yang menjadi sarjana yang paling awal?', 'A', 'B', 'C', 'D', 'A DAN B', '', '', '', '', '', 'C', 0, 0, '2', 2, ''),
(65, 1, 2, 5, '', '', 'Perhatikan gambar-gambar berikut di bawah ini, kemudian tentukan satu gambar yang tidak mempunyai persamaan dengan gambar-gambar lainnya.', '<p><img src=\"blob:http://localhost:81/fad39cea-0c00-45d9-859c-99a987d4ae13\" alt=\"\" class=\"fr-fic fr-dii\"></p>', '', '', '', '', 'd3e256832ea1fb6a929fa13398ec1622.png', 'af334ebe7f425700d79da9ad8e932324.png', 'b983593a018470bc3efe8a562b700a89.png', '0386e85fcfa07d6409d2c694a35516c5.png', 'a86478bf85746b5ec454a8adc34928fd.png', 'A', 0, 1598494885, '2', 2, ''),
(66, 1, 2, 5, '8f61018af79ff2dc1abebef804116276.png', 'image/png', 'Tentukan satu gambar yang mempunyai persamaan dengan gambar yang menjadi soal atau pertanyaan.', '', '', '', '', '', '324b40089af6103a65c366d9530cd1c3.jpg', '044adc54210d18d249003678f4930c0e.jpg', '060bf0e453f1cf333c81be5bf88b78a1.jpg', '9e5412e64b710dd3dbc1cbbcfd3b05bd.jpg', '39cbe7f13298a5fa4b3c360c82f02913.jpg', 'D', 0, 1598494077, '2', 2, ''),
(67, 1, 2, 5, '', '', 'Orang tua saya tiba tiba mengalami kesulitan ekonomi sehingga uang spp tidak terbayar bulan ini', '<p>mengatakan kepada guru bahwa orang tua kesulitan ekonomi</p>', '<p>tidak mau sekolah lagi</p>', '<p>kecewa karna orang tua tidak memahami kebutuhan saya</p>', '<p>mohon dispensasi menunda pembayaran</p>', '<p>mencari pinjaman dan meminta orang tua menggantinya</p>', '', '', '', '', '', 'A:4,B:1,C:3,D:5,E:2', 1594976791, 1598495013, '3', 2, ''),
(68, 1, 2, 5, '', '', 'Bagi saya, kelemahan merupakan ...', '<p>Isyarat    tegas    bahwa    saya    harus  berhenti </p>', '<p>Justru  meningkatkan     ketangguhan  saya  untuk  mencoba  sesuatu  dengan  lebih baik </p>', '<p>Sering menjatuhkan mental saya </p>', '<p>Hal  yang  saya  upayakan  untuk  tidak  mengurangi semangat saya </p>', '<p>Mungkin   ada   unsur   kekeliruan   dari  anggota tim saya </p>', '', '', '', '', '', 'A:2,B:5,C:3,D:4,E:1', 1594989692, 1595057469, '3', 2, ''),
(69, 1, 2, 5, '', '', 'Menurut anda mementingkan kepentingan umum adalah ...', '<p>Melihat skala prioritas kepentingan</p>', '<p>Melihat budi kebaikan yang pernah kita  terima dari orang lain</p>', '<p>Membantu  dengan  tulus  kepada  yang  membutuhkan</p>', '<p>Kebaikan</p>', '<p>Perbuatan    yang    perlu    ditanamkan  sejak dini</p>', '', '', '', '', '', 'A:2,B:1,C:5,D:3,E:4', 1595057964, 1595057988, '3', 2, ''),
(70, 1, 2, 5, '', '', 'Jika anda mendapatkan suatu pekerjaan yang bayarannya sangat besar, maka anda akan ...', '<p>Bertanggung  jawab  dalam  melakukan  pekerjaan anda </p>', '<p>Lebih bersemangat </p>', '<p>Takut </p>', '<p>Merasa terharu </p>', '<p>Biasa saja </p>', '', '', '', '', '', 'A:5,B:4,C:1,D:3,E:2', 1595058444, 1595058444, '3', 2, ''),
(71, 1, 2, 5, '', '', 'Jika anda mendapatkan suatu pekerjaan dengan gaji yang sangat kecil, maka anda akan ...', '<p>Bertanggung  jawab  dalam  melakukan  pekerjaan anda </p>', '<p>Malas  </p>', '<p>Keluar dari pekerjaan tersebut </p>', '<p>Merasa sedih </p>', '<p>Biasa saja </p>', '', '', '', '', '', 'A:5,B:2,C:1,D:3,E:4', 1595058642, 1595058642, '3', 2, ''),
(72, 1, 2, 5, '', '', 'Menurut saya orang tua saya sukses dalam bekerja dan berkarya karena ...', '<p>Mereka menempuh berbagai rintangan  untuk mencapai kesuksesan </p>', '<p>Mereka  berusaha keras  dalam  hidupnya untuk sukses </p>', '<p>Mereka mendapatkan kesempatan dan  fasilitas sehingga bisa sukses </p>', '<p>Mereka   adalah   pribadi   yang   patut  dicontoh </p>', '<p>Mereka  orang  yang  sangat  beruntung  dan membuat anaknya bangga </p>', '', '', '', '', '', 'A:4,B:5,C:2,D:3,E:1', 1595058751, 1595058751, '3', 2, ''),
(73, 1, 2, 5, '', '', 'Anda diminta untuk memberikan materi training di suatu forum yang pesertanya kebanyakan adalah mahasiswa dari kampus ternama. Maka reaksi anda adalah...', '<p>Meminta orang lain saja untuk memberi  materi  training </p>', '<p>Mengkomunikasikan  pada  penyelanggara  acara  agar  sesi  materi  ditunda </p>', '<p>Mencoba menjelaskan sebisanya </p>', '<p>Meminta  bantuan  rekan  untuk  menyusun materi </p>', '<p>Berusaha   tenang   dan   fokus   pada  materi yang akan disampaikan </p>', '', '', '', '', '', 'A:1,B:2,C:4,D:3,E:5', 1595058866, 1595058866, '3', 2, ''),
(74, 1, 2, 5, '', '', 'Tawaran beasiswa begitu banyak, namun pasangan anda tidak mengizinkan anda untuk mengambil beasiswa dengan alasan anda tidak bisa fokus pada pekerjaan dan keluarga, maka anda akan ...', '<p>Marah kepada keadaaan </p>', '<p>Memakluminya </p>', '<p>Meminta  pasangan  untuk  mempertimbangkannya </p>', '<p>Keluar dari pekerjaan </p>', '<p>Sedih </p>', '', '', '', '', '', 'A:2,B:5,C:4,D:1,E:3', 1595059019, 1595059019, '3', 2, ''),
(75, 1, 2, 5, '', '', 'Mengangkat telepon pada saat rapat menurut saya ...', '<p>Boleh saja </p>', '<p>Tidak boleh </p>', '<p>Boleh asal pimpinan meyetujui </p>', '<p>Boleh asal sudah memberi usulan atau  kontribusi ide dalam rapat </p>', '<p>Boleh asal tidak ketahuan </p>', '', '', '', '', '', 'A:1,B:5,C:4,D:3,E:2', 1595059140, 1595059140, '3', 2, ''),
(76, 1, 2, 5, '', '', 'Karena sebagian besar pegawai pulang kampung dan saya diminta menunda cuti lebaran oleh pimpinan. Saya berjanji pada orang tua untuk mudik di hari lebaran, sikap saya ...', '<p>Tetap mengambil cuti </p>', '<p>Memberi pengertian kepada orang tua </p>', '<p>Memberi  pengertian  kepada  pimpinan  agar diperbolehkan pulang kampung </p>', '<p>Meminta  anggota  keluarga  lain  untuk  membujuk orang tua </p>', '<p>Meminta  teman  untuk  menggantikan  penundaan  cuti </p>', '', '', '', '', '', 'A:1,B:5,C:3,D:4,E:2', 1595059264, 1595059264, '3', 2, ''),
(77, 1, 2, 5, '', '', 'Anda adalah ketua bidang kewirausahaan di sebuah organisasi. Pada suatu saat anda ditegur oleh pimpinan karena ada program - program yang belum terlaksana sampai pada akhir periode kepengurusan. Maka yang akan anda lakukan adalah ...', '<p>Mencari alasan agar tidak dimarahi </p>', '<p>Menerima resiko </p>', '<p>Meminta maaf pada jajaran pengurus </p>', '<p>Segera  mengurus  kelanjutan  programnya </p>', '<p>Mengatakan   bahwa   hal   yang   harus  anda  kerjakan  sangat  banyak,  sehingga    membutuhkan   </p>', '', '', '', '', '', 'A:1,B:3,C:4,D:5,E:2', 1595059391, 1595059391, '3', 2, ''),
(78, 1, 2, 5, '', '', 'Anda sedang berada di kendaraan umum yang penuh sesak dengan penumpang, tiba - tiba pimpinan anda menelpon dan anda kesulitan untuk menjawab panggilan tersebut, maka sikap anda ...', '<p>Marah  pada  orang  yang  ada  di  dekat  anda </p>', '<p>Menggerutu </p>', '<p>Biasa saja </p>', '<p>Turun dari kendaraan umum </p>', '<p>Bersabar </p>', '', '', '', '', '', 'A:1,B:2,C:4,D:3,E:5', 1595059522, 1595059522, '3', 2, ''),
(79, 1, 2, 5, '', '', 'Bagaimana sikap anda jika diminta melakukan investigasi ke tempat yang anda sama sekali belum pernah datangi ...', '<p>Mundur </p>', '<p>Menolaknya secara tegas </p>', '<p>Meminta pertimbangan ulang </p>', '<p>Antusias </p>', '<p>Menyanggupinya dengan sedikit ragu </p>', '', '', '', '', '', 'A:1,B:2,C:3,D:5,E:4', 1595059639, 1595059639, '3', 2, ''),
(80, 1, 2, 5, '', '', 'Anda diminta menggantikan rekan yang bekerja di gudang, sedangkan kondisi gudang yang pengap dan panas tentunya berbeda dengan ruang kerja anda, maka anda akan ...', '<p>Tertantang untuk mengerjakan dengan  baik </p>', '<p>Merasa takut </p>', '<p>Bekerja seperti biasa </p>', '<p>Menerima dengan berat hati </p>', '<p>Menyiapkan alasan apabila tidak tuntas </p>', '', '', '', '', '', 'A:5,B:2,C:4,D:3,E:1', 1595059763, 1595059763, '3', 2, ''),
(81, 1, 2, 5, '', '', 'Pada saat anda sedang melakukan wawancara dengan narasumber, tiba - tiba tetangga anda menelpon dan memberi tahu bahwa baru saja terjadi pencurian di rumah anda, sikap anda ...', '<p>Segera kembali ke rumah </p>', '<p>Memohon  maaf  dan  minta  izin pada  narasumber tersebut untuk kembali ke  rumah </p>', '<p>Mengabaikan   urusan   rumah   karena  masih sibuk  </p>', '<p>Kembali setelah wawancara selesai </p>', '<p>Menelpon  meminta  kerabat  mengurusinya dulu </p>', '', '', '', '', '', 'A:2,B:5,C:3,D:4,E:1', 1595059890, 1595059890, '3', 2, ''),
(82, 1, 2, 5, '', '', 'Program yang diusung oleh tim saya sering tidak berjalan dengan baik, saya sebaiknya ...', '<p>Memberi   kritik   dan   tetap   berusaha  memberi  semangat tim  saya  sekuat  tenaga </p>', '<p>Tetap   berfikir   positif   walau   hanya  dengan berdiam diri saja </p>', '<p>Pura - pura tidak paham masalahnya </p>', '<p>Menyarankan agar melakukan evaluasi  dan segera melakukan perbaikan </p>', '<p>Menyaranka n agar  beberapa rekan tim  diganti saja karena selalu tidak beres </p>', '', '', '', '', '', 'A:5,B:3,C:2,D:4,E:1', 1595060036, 1595060036, '3', 2, ''),
(83, 1, 2, 5, '', '', 'Ketika hendak berangkat ke kantor, tiba - tiba motor yang anda parkir didepan rumah hilang, sikap anda ...', '<p>Melaporkan  kehilangan  sambil  menyampaikan ke atasan </p>', '<p>Meminta  kerabat  dan  para  tetangga  untuk  mencarinya </p>', '<p>Membiarkan polisi yang mengurusnya </p>', '<p>Tetap  berangkat  ke  kantor  karena  itu  lebih penting </p>', '<p>Berangkat ke kantor dengan pikiran tak  karuan </p>', '', '', '', '', '', 'A:5,B:2,C:4,D:1,E:3', 1595060122, 1595060122, '3', 2, ''),
(84, 1, 2, 5, '', '', 'Suatu ketika anda mengikuti lomba menulis esai namun hanya mendapat juara ketiga, maka sikap anda ...', '<p>Menyesal  kesalahan </p>', '<p>Mempersiapkan   diri   lebih   baik   lagi  untuk ikut lomba menulis selanjutnya </p>', '<p>Menyalahkan keadaan </p>', '<p>Puas dan bangga </p>', '<p>Biasa saja </p>', '', '', '', '', '', 'A:2,B:4,C:1,D:5,E:3', 1595060317, 1595060317, '3', 2, ''),
(85, 1, 2, 5, '', '', 'Ada tamu yang terlibat pertengkaran dengan tamu lain di penginapan milik anda. Melihat hal tersebut yang akan anda lakukan adalah ...', '<p>Mengusir mereka </p>', '<p>Meminta  satpam  agar  melerai  keduanya </p>', '<p>Langsung    melaporkan    pada    pihak  berwajib </p>', '<p>Mengajak  mereka  untuk  menyelesaikan   masalah   di   ruangan  tertentu </p>', '<p>Meminta    ganti    rugi    karena    telah  membuat kegaduhan dan kerugian </p>', '', '', '', '', '', 'A:1,B:4,C:3,D:5,E:2', 1595060456, 1595060456, '3', 2, ''),
(86, 1, 2, 5, '', '', 'Dalam suatu seleksi bidang, anda lulus di bagian penjualan, padahal bagian yang anda inginkan adalah bagian Diklat keuangan. Maka yang akan anda lakukan adalah ...', '<p>Berusaha bekerja secara optimal </p>', '<p>Menolak pekerjaan tersebut </p>', '<p>Berusaha    agar    anda  tetap    dapat  mengerjakan  urusan  di  bagian  keuangan </p>', '<p>Mempertimbangkan tawaran tersebut </p>', '<p>Meminta  bayaran  lebih  mahal  untuk  pekerjaan di bagian penjualan </p>', '', '', '', '', '', 'A:5,B:3,C:2,D:4,E:1', 1595060554, 1595060554, '3', 2, ''),
(87, 1, 2, 5, '', '', 'Agar semua staf di kantor anda bekerja dengan rajin, maka sebagai pimpinan kantor anda akan ...', '<p>Memberikan  penghargaan kepada staf  yang paling rajin </p>', '<p>Menempel  tulisan  Kerja  itu di  berbagai tempat yang strategis </p>', '<p>Memberikan sanksi yang tegas kepada  setiap    staf    yang    bekerja    malas - malasan </p>', '<p>Lebih  rajin  bekerja  sembari  mengajak  para staf anda untuk turut serta dengan  anda </p>', '<p>Membentuk  sebuah  komisi  penegakkan disiplin </p>', '', '', '', '', '', 'A:2,B:4,C:1,D:5,E:3', 1595060636, 1595060636, '3', 2, ''),
(88, 1, 2, 5, '', '', 'Anda tidak diterima di perusahaan yang anda inginkan. Istri anda meminta anda meminta pada anda agar melamar ke perusahaan lain. Maka yang akan anda lakukan adalah ...', '<p>Mencoba lagi kalau ada kesempatan </p>', '<p>Mengikuti pelatihan agar dapat diterima </p>', '<p>Melamar kerja dimana saja asal dapat  pekerjaan </p>', '<p>Mengikuti saran istri  </p>', '<p>Mencoba   lagi   nanti   dengan   bidang  yang   sama   namun   di   perusahaan  berbeda </p>', '', '', '', '', '', 'A:4,B:5,C:1,D:2,E:3', 1595060750, 1595060750, '3', 2, ''),
(89, 1, 2, 5, '', '', 'Anda tidak lolos mengikuti seleksi pegawai kementrian luar negeri, maka anda akan...', '<p>Sedih </p>', '<p>Putus asa </p>', '<p>Lelah </p>', '<p>Merasa  tertantang  untuk  mengikutinya lagi periode mendatang </p>', '<p>Belajar  dari  kesalahan  dan  mempersiapkan diri lebih baik lagi </p>', '', '', '', '', '', 'A:3,B:1,C:2,D:4,E:5', 1595060868, 1595060868, '3', 2, ''),
(90, 1, 2, 5, '', '', 'Saat anda dinyatakan belum lolos tes kenaikan pangkat dan teman anda menyarankan untuk mengikuti beberapa pelatihan agar bisa lolos saat mencoba lagi tes tersebut, maka anda ...', '<p>Mencoba lagi tes </p>', '<p>Mengikuti  pelatihan  agar  teman  tidak  kecewa </p>', '<p>Mencoba melamar pekerjaan di tempat  lain </p>', '<p>Mengikuti  saran  teman  dan  mencoba  belajar dengan giat </p>', '<p>Mengikuti pelatihan diam - diam </p>', '', '', '', '', '', 'A:2,B:4,C:1,D:5,E:3', 1595060960, 1595060960, '3', 2, ''),
(91, 1, 2, 5, '', '', 'Anda sedang sibuk mengerjakan tugas dan melihat bahwa rekan dalam tim anda sedang mengalami kesulitan dalam mengerjakan pekerjaannya, maka anda akan ...', '<p>Menghiraukannya </p>', '<p>Melihat dulu jenis pekerjaanya apakah  bisa membantu atau tidak </p>', '<p>Memintanya bekerja sendiri </p>', '<p>Memarahinya </p>', '<p>Merekomendasikan rekan yang lain </p>', '', '', '', '', '', 'A:5,B:4,C:3,D:2,E:1', 1595061115, 1595061932, '3', 2, ''),
(92, 1, 2, 5, '', '', 'Anda bertugas mengelola bagian input database pusat. Rekan anda seringkali terlambat memasukkan datanya sehingga anda sering ditegur atasan karena mencapai waktu deadline, maka anda akan ...', '<p>Menunggu saja </p>', '<p>Mengambil  alih  pekerjaan  pada  bagiannya itu </p>', '<p>Memintanya  untuk  lebih  cepat  dalam  bekerja </p>', '<p>Melaporkannya kepada atasan </p>', '<p>Bertanya  apa  kesulitannya  dan  membantu sebisa anda </p>', '', '', '', '', '', 'A:3,B:1,C:4,D:2,E:5', 1595062053, 1595062053, '3', 2, ''),
(93, 1, 2, 5, '', '', 'Anda terbiasa tepat waktu datang bekerja dan menyelesaikan pekerjaan. Ada rekan tim anda yang melakukan sebaliknya, sehingga rekan - rekan yang lain kurang menyukainya. Maka anda akan ...', '<p>Mengingatkan  rekan  tersebut  dengan  halus agar tidak tersinggung </p>', '<p>Diam saja, nanti takut dibilang membela rekan yang tidak patut dicontoh</p>', '<p>Menegur  di  depan  rekan - rekan  yang  lain </p>', '<p>Melakukan  rapat  tim  untuk  bermusyawarah  atas  suka  dan  ketidaksukaan antar rekan dalam tim </p>', '<p>Merekomendasikan   rekan   yang   lain  untuk  menggantikan rekan tersebut </p>', '', '', '', '', '', 'A:5,B:2,C:3,D:4,E:1', 1595062199, 1595062199, '3', 2, ''),
(94, 1, 2, 5, '', '', 'Jika suatu saat nanti anda terpilih menjadi seorang pimpinan organisasi terbesar di indonesia, hal pertama yang saudara lakukan adalah ...', '<p>Membuat perubahan organisasi besar - besaran </p>', '<p>Memperbaiki kualitas SDM para anggota organisasi </p>', '<p>Merenovasi gedung sekertariat supaya  lebih bagus </p>', '<p>Menciptakan  suatu  inovasi  baru  yang  dapat memajukan masa depan bangsa </p>', '<p>Menerapkan  manajemen  modern  seperti  yang  telah  diterapkan  di  luar  negeri </p>', '', '', '', '', '', 'A:3,B:4,C:1,D:5,E:2', 1595062306, 1595062306, '3', 2, ''),
(95, 1, 2, 5, '', '', 'Agar semua penghuni baru di lingkungan anda dapat bersosialisasi dengan baik, maka anda sebagai penghuni lama akan ...', '<p>Menawarkan   dari   kepada   ketua   RT  untuk membimbing para peghuni baru </p>', '<p>Mencoba mencairkan suasana dengan  penghuni baru </p>', '<p>Memperkenalkan  diri  terlebih  dahulu  dengan penghuni baru </p>', '<p>Menyelenggarakan  acara  santai  yang  dapat mempertemukan penghuni lama  dengan penghuni baru  </p>', '<p>Cuek    saja    karena    saya    banyak  pekerjaan  yang  harus  segera  diselesaikan </p>', '', '', '', '', '', 'A:4,B:2,C:3,D:5,E:1', 1595062417, 1595062417, '3', 2, ''),
(96, 1, 2, 5, '', '', 'Agar semua pegawai di kantor anda dapat mengikuti acara kursus bahasa asing untuk meningkatkan kemampuan SDM, maka sebagai panitia kegiatan tersebut anda akan ...', '<p>Menyelenggarakan kursus di hari libur </p>', '<p>Menyelenggarakan  kursus  pada  jam  istirahat </p>', '<p>Menyelenggarakan kursus setelah jam  kantor selesai </p>', '<p>Menyelenggarakan  kursus  secara  bertahap  sehingga  tidak  mengganggu  kinerja instansi anda </p>', '<p>Meminta  pendapat  rekan-rekan  anda  kapan sebaiknya  kursus dilaksanakan </p>', '', '', '', '', '', 'A:2,B:1,C:3,D:5,E:4', 1595062502, 1595062502, '3', 2, ''),
(97, 1, 2, 5, '', '', 'Adik anda kesulitan untuk mengerjakan tugas sekolahnya dan kebetulan anda menguasai materi tersebut ...', '<p>Memberikan buku - buku referensi </p>', '<p>Membagi  ilmu  dan  mungkin  memberikan referensi buku </p>', '<p>Membantu jika diminta </p>', '<p>Berpura - pura tidak tahu </p>', '<p>Menyarankan agar konsultasi pada guru </p>', '', '', '', '', '', 'A:4,B:5,C:2,D:1,E:3', 1595062612, 1595062612, '3', 2, ''),
(98, 1, 2, 5, '', '', 'Jika teman anda ingin meminjam kendaraan pribadi yang biasa anda gunakan ke kantor, maka yang anda lakukan adalah ...', '<p>Meminjamkannya </p>', '<p>Meminta  teman  agar  mengisi  bensinnya </p>', '<p>Meminta biaya sewa </p>', '<p>Meminta    maaf    karena    tidak    bisa  meminjamkannya </p>', '<p>Meminjamkannya   dengan   parasaan  was - was </p>', '', '', '', '', '', 'A:5,B:3,C:1,D:2,E:4', 1595062777, 1595062777, '3', 2, ''),
(99, 1, 2, 5, '', '', 'Dalam perjalan berangkat ke kantor, Anda ditelpon oleh tetangga anda untuk menjemputnya di halte karena ia baru saja kecopetan, maka anda akan ...', '<p>Menolaknya secara halus </p>', '<p>Menolaknya  karena  anda  pasti  akan  terlambat ke kantor </p>', '<p>Segera menuruti permintaannya </p>', '<p>Menjemputnya sambil mengeluh </p>', '<p>Menolak secara  halus, kemudian  mematikan handphone </p>', '', '', '', '', '', 'A:3,B:2,C:5,D:4,E:1', 1595062886, 1595062886, '3', 2, ''),
(100, 1, 2, 5, '', '', 'Setiap pagi dalam perjalanan menuju kantor saya sering merasa ...', '<p>Banyak tugas yang menanti saya </p>', '<p>Bersemangat    untuk    melaksanakan  aktifitas sehari - hari </p>', '<p>Pusing memikirkan susana kantor yang  kurang nyaman </p>', '<p>Merasa tertantang akan apa yang saya  hadapi kedepan </p>', '<p>Berharap semoga hari ini hari baik saya </p>', '', '', '', '', '', 'A:3,B:5,C:1,D:4,E:2', 1595062972, 1595062972, '3', 2, ''),
(101, 1, 2, 5, '', '', 'Rumah kost yang baru anda tempati merupakan bangunan lama dengan dekorasi yang sudah ketinggalan jaman, banyak barang - barang tua yang tidak lagi dapat digunakan dengan baik. mengenai hal ini saya ...', '<p>Biasa   saja   karena   tak   mau   ambil  pusing </p>', '<p>Saya  kumpulkan  barang - barang  tersebut  kemudian  saya  jual  ke  pasar  barang bekas </p>', '<p>Saya  meminta  pemilik  agar  memperbaharui dekorasi rumah </p>', '<p>Saya coba dekorasi sendiri sedemikian  rupa agar terlihat lebih  baik </p>', '<p>Saya  kumpulkan  barang  mana  yang  masih  dapat  dipakai  dan  mana  yang  tidak </p>', '', '', '', '', '', 'A:2,B:1,C:3,D:5,E:4', 1595063075, 1595063075, '3', 2, ''),
(102, 1, 1, 5, '', '', '<p>b</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '', '', '', '', '', 'A', 1595169947, 1595171636, '4', 3, ''),
(103, 1, 1, 5, '', '', 'a', 'a', 'a', 'a', 'a', 'a', '', '', '', '', '', 'A', 0, 0, '4', 3, ''),
(104, 1, 1, 5, '', '', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '', '', '', '', '', 'A', 0, 1595206991, '4', 3, ''),
(105, 1, 1, 5, '', '', '<p>isi</p>', '', '', '', '', '', '', '', '', '', '', 'A', 1595212250, 1595219907, '4', 3, ''),
(106, 1, 1, 5, '', '', '<p>ad</p>', '<p>ad</p>', '<p>ad</p>', '<p>ad</p>', '<p>ad</p>', '<p>ad</p>', '', '', '', '', '', 'A', 1595212596, 1595212596, '4', 3, ''),
(107, 1, 1, 5, '', '', '<p>af</p>', '<p>af</p>', '<p>af</p>', '<p>af</p>', '<p>af</p>', '<p>af</p>', '', '', '', '', '', 'B', 1595212755, 1595212755, '4', 3, ''),
(108, 1, 1, 5, '', '', '<p>ag</p>', '<p>ag</p>', '<p>ag</p>', '<p>ag</p>', '<p>ag</p>', '<p>ag</p>', '', '', '', '', '', 'B', 1595212939, 1595212939, '4', 3, ''),
(109, 1, 1, 5, '', '', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '', '', '', '', '', 'D', 1595213120, 1595213120, '4', 3, ''),
(110, 1, 1, 5, '', '', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '', '', '', '', '', 'D', 1595213290, 1595213290, '4', 3, ''),
(111, 1, 1, 5, '', '', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '<p>aa</p>', '', '', '', '', '', 'D', 1595213364, 1595213364, '4', 3, ''),
(112, 1, 1, 5, '', '', '<p>soal</p>', '<p>jawab a</p>', '<p>jawab  aa</p>', '<p>jawab  aa</p>', '<p>jawab aa</p>', '<p>jawab aa</p>', '', '', '', '', '', 'E', 1595213583, 1595219637, '4', 3, ''),
(113, 1, 1, 5, '', '', '<p>aoasa</p>', '<p>ao</p>', '<p>ao</p>', '<p>ao</p>', '<p>ao</p>', '<p>ao</p>', '', '', '', '', '', 'D', 1595213633, 1595215286, '4', 3, ''),
(114, 1, 1, 5, '', '', '<p>test kosong</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '', '', '', '', '', 'A', 1595220458, 1595220458, '4', 3, ''),
(115, 1, 1, 5, '', '', '<p>skb1</p>', '<p>1</p>', '<p>2</p>', '<p>3</p>', '<p>4</p>', '<p>5</p>', '', '', '', '', '', 'A', 1595234935, 1595235265, '4', 3, ''),
(116, 1, 1, 5, '', '', '<p>skd2</p>', '<p>2</p>', '<p>2</p>', '<p>2</p>', '<p>2</p>', '<p>2</p>', '', '', '', '', '', 'D', 1595236081, 1595399782, '4', 3, ''),
(117, 1, 1, 5, '', '', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '', '', '', '', '', 'A', 1595236284, 1595236284, '4', 3, ''),
(118, 1, 1, 5, '', '', '<p>dy</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '', '', '', '', '', 'A', 1595236308, 1595236308, '4', 3, ''),
(119, 1, 1, 5, '', '', '<p>dyfg</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '<p>d</p>', '', '', '', '', '', 'A', 1595236316, 1595236316, '4', 3, ''),
(120, 1, 1, 5, '', '', '<p>ok</p>', '<p>ok</p>', '<p>ok</p>', '<p>ok</p>', '<p>ok</p>', '<p>ok</p>', '', '', '', '', '', 'B', 1595236504, 1595243274, '4', 3, ''),
(121, 1, 1, 5, '', '', '<p>sss</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '', '', '', '', '', 'A', 1595249883, 1595249883, '4', 3, ''),
(122, 1, 1, 5, '', '', '<p>sso</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '<p>s</p>', '', '', '', '', '', 'A', 1595249898, 1595249898, '4', 3, ''),
(123, 1, 1, 5, '', '', '<p>b</p>', '', '', '', '', '', '', '', '', '', '', 'A', 1595255849, 1595255849, '4', 3, ''),
(124, 1, 2, 5, '', '', '<p>test warga</p>', '<p>a</p>', '<p>d</p>', '<p>f</p>', '<p>g</p>', '<p>h</p>', '', '', '', '', '', 'A', 1595256649, 1595565142, '1', 4, ''),
(125, 1, 1, 5, '', '', '<p>ds</p>', '<p>df</p>', '<p>sdf</p>', '<p>sdf</p>', '<p>dsf</p>', '<p>sdf</p>', '', '', '', '', '', 'A', 1595257365, 1595257365, '4', 3, ''),
(126, 1, 1, 5, '', '', '<p>24</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '', '', '', '', '', 'A', 1595257481, 1595257481, '4', 3, ''),
(127, 1, 1, 5, '', '', '<p>25</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '<p>24</p>', '', '', '', '', '', 'A', 1595257504, 1595257504, '4', 3, ''),
(128, 1, 1, 5, '', '', '<p>asdf</p>', '<p>d</p>', '<p>f</p>', '<p>g</p>', '<p>h</p>', '<p>j</p>', '', '', '', '', '', 'A', 1595259824, 1595259824, '4', 3, ''),
(129, 1, 1, 5, '', '', '<p>tl</p>', '<p>tl</p>', '<p>tl</p>', '<p>tl</p>', '<p>tl</p>', '<p>tl</p>', '', '', '', '', '', 'B', 1595551485, 1595551485, '4', 3, ''),
(130, 1, 1, 5, '', '', '<p>nn</p>', '<p>n</p>', '<p>n</p>', '<p>n</p>', '<p>n</p>', '<p>n</p>', '', '', '', '', '', 'B', 1595551675, 1595554799, '4', 3, ''),
(131, 1, 1, 5, '', '', '<p>a</p>', '<p>a</p>', '<p>s</p>', '<p>a</p>', '<p>s</p>', '<p>d</p>', '', '', '', '', '', 'B', 1595562022, 1595562022, '4', 3, ''),
(132, 1, 1, 5, '', '', '<p>u</p>', '<p>u</p>', '<p>u</p>', '<p>u</p>', '<p>u</p>', '<p>u</p>', '', '', '', '', '', 'C', 1595562180, 1595562180, '4', 3, ''),
(133, 1, 1, 5, '', '', '<p>yo</p>', '<p>yo</p>', '<p>yo</p>', '<p>yo</p>', '<p>yo</p>', '<p>yo</p>', '', '', '', '', '', 'A', 1595583789, 1595583789, '4', 3, ''),
(134, 1, 1, 5, '', '', '<p>dd</p>', '<p>dd</p>', '<p>dd</p>', '<p>dd</p>', '<p>dd</p>', '<p>dd</p>', '', '', '', '', '', 'A', 1595584012, 1595584012, '4', 3, ''),
(135, 1, 2, 5, '', '', 'Peraturan yang dianggap sebagai suara hati manusia. Aturan hidup tentang perilaku baik dan buruk berdasarkan kebenaran dan keadilan, disebut ...', '<p>Norma Agama</p>', '<p>Norma Kesusilaan</p>', '<p>Norma Kesopanan</p>', '<p>Norma Keadilan</p>', '<p>Norma Hukum</p>', '', '', '', '', '', 'B', 1598416967, 1598417682, '1', 1, '<p>Norma Kesusilaan yaitu norma atau peraturan yang dianggap sebagai suara hati manusia. Aturan hidup tentang perilaku baik dan buruk berdasarkan kebenaran dan keadilan.</p>'),
(136, 1, 2, 5, '', '', 'Monarkisme merupakan paham dimana kerajaan merupakan sumber utama dari kesejahteraan negaranya. Negara yang menerapkan ideologi ini adalah ... ', '<p>Amerika Serikat </p>', '<p>Australia </p>', '<p>Brunei Darussalam </p>', '<p>Rusia </p>', '<p>Jerman </p>', '', '', '', '', '', 'C', 1598417830, 1598417830, '1', 1, '<p><br>               Monarkisme  merupakan  paham  dimana  kerajaan  merupakan  sumber  utama  dari  kesejahteraan  negaranya.  Saat  ini  masih  ada    banyak    negara    yang    menganut  paham     monarki,     diantaranya     adalah  Brunei   Darussalam,   Arab   Saudi   dan  lainnya.  Jadi  pusat  kekuasaan  tertinggi  adalah raja    yang    memerintah    dan  segenap keturunannya.               </p>'),
(137, 1, 2, 5, '', '', 'Secara harfiah, pancasila itu diartikan ... ', '<p>Lima pedoman kebangsaan </p>', '<p>Dasar yang memiliki lima unsur </p>', '<p>Lima komponen penting </p>', '<p>Lima unsur hidup manusia </p>', '<p>Falsafah yang memiliki lima pedoman bernegara </p>', '', '', '', '', '', 'B', 1598424343, 1598424343, '1', 1, '<p>Secara   harfiah,   pancasila   itu   diartikan  sebagai  dasar  yang  memiliki  lima  unsur.               </p>'),
(138, 1, 2, 5, '', '', 'Judul pidato yang disampaikan oleh Soekarno dalam sidang Dokuritsu Junbi Cosakai (bahasa Indonesia: \"Badan Penyelidik Usaha Persiapan Kemerdekaan\") pada tanggal 1 Juni 1945, adalah ... ', '<p>Lahirnya bangsa Indonesia</p>', '<p>Kesaktian Pancasila</p>', '<p>Lahirnya pancasila</p>', '<p>Pedoman hidup berbangsa</p>', '<p>Falsafah hidup pancasila</p>', '', '', '', '', '', 'C', 1598424529, 1598424529, '1', 1, '<p xss=removed>Lahirnya  Pancasila adalah  judul  pidato  yang  disampaikan  oleh  Soekarno  dalam  sidang  Dokuritsu  Junbi  Cosakai  (bahasa  Indonesia:  “Badan  Penyelidik  Usaha  Persiapan Kemerdekaan”) pada tanggal 1  Juni   1945.   Pidato   ini   pada   awalnya  disampaikan     oleh     Soekarno     secara  aklamasi  tanpa  judul  dan  baru  mendapat  sebutan   “Lahirnya   Pancasila”   oleh  mantan   Ketua   BPUPKI   Dr.   Radjiman  Wedyodiningrat dalam   kata   pengantar  buku  yang  berisi  pidato  yang  kemudian  dibukukan oleh BPUPKI tersebut.</p>'),
(139, 1, 2, 5, '', '', 'Suka memberi pertolongan kepada orang lain agar dapat berdiri sendiri, merupakan nilai yang terkandung dalam Pancasila sila ... ', '<p>Pertama</p>', '<p>Kedua</p>', '<p>Ketiga</p>', '<p>Keempat</p>', '<p>Kelima</p>', '', '', '', '', '', 'E', 1598424696, 1598424696, '1', 1, '<p xss=removed>Suka memberi pertolongan kepada orang  lain agar dapat berdiri sendiri, merupakan  nilai  yang  terkandung  dalam  Pancasila  sila kelima.</p>'),
(140, 1, 2, 5, '', '', 'Tanggal 10 Januari 1950 dibentuk Panitia Teknis yang ditugaskan Presiden Soekarno untuk merencanakan, merancang dan merumuskan gambar lambang negara, yang dinamakan .. ', '<p>Panitia Delapan </p>', '<p>Panitia Sembilan </p>', '<p>Panitia Lencana Negara </p>', '<p>Panitia Pembangunan </p>', '<p>Panitia Lambang Negara </p>', '', '', '', '', '', 'C', 1598424785, 1598424785, '1', 1, '<p xss=removed>Tanggal 10 Januari 1950  dibentuk Panitia  Teknis   dengan   nama   Panitia   Lencana  Negara   di   bawah   koordinator   Menteri  Negara  Zonder  Porto  Folio  Sultan  Hamid  II   yang   ditugaskan   Presiden   Soekarno  untuk   merencanakan,   merancang   dan  merumuskan gambar lambang negara.</p>'),
(141, 1, 2, 5, '', '', 'Rancangan lambang negara karya Sultan Hamid II akhirnya disetujui oleh Presiden Soekano pada tanggal 10 Februari 1950 dan diresmikan pemakaiannya dalam .. ', '<p>Sidang PBB </p>', '<p>Konferensi Asia - Afrika </p>', '<p>Sidang Kabinet RIS </p>', '<p>Kraton Kadriyah Pontianak </p>', '<p>Konferensi Meja Bundar </p>', '', '', '', '', '', 'C', 1598424887, 1598424887, '1', 1, '<p xss=removed>Rancangan lambang negara karya Sultan  Hamid  II  akhirnya  disetujui  oleh  Presiden  Soekano  pada  tanggal  10  Februari  1950  dan    diresmikan    pemakaiannya    dalam  Sidang   Kabinet   RIS   pada   tanggal   11  Februari 1950.               </p>'),
(142, 1, 2, 5, '', '', '<p>Dalam penjelasan UUD 1945 dinyatakan bahwa “negara Indonesia berdasarkan atas hukum (“rechsstaat”) tidak berdasarkan atas kekuasaan belaka (“machsstaat”). Oleh karena itu, negara dalam menjalankan aktivitasnya harus ....</p>', '<p>Berdasarkan pemerintah</p>', '<p>Berdasarkan hukum</p>', '<p>Mengacu pda kebutuhan</p>', '<p>Merujuk pada kepentingan</p>', '<p>Menuruti keinginan penguasa</p>', '', '', '', '', '', 'B', 1598425200, 1598425200, '1', 1, '<p xss=removed>Dalam  penjelasan  UUD  1945  dinyatakan  bahwa  “negara  Indonesia  berdasarkan  atas    hukum    (“rechsstaat”)    tidak  berdasarkan    atas    kekuasaan    belaka (“machsstaat”).  Oleh  karena  itu,  negara  dalam   menjalankan   aktivitasnya   harus  berdasarkan hukum. </p>'),
(143, 1, 2, 5, '', '', '<p>Segala Sesuatu permasalahan yang terjadi dan menyangkut pidana harus diselesaikan secara hukum, hal ini sesuai dengan pasal ... UUD 1945.</p>', '<p>2</p>', '<p>3</p>', '<p>1</p>', '<p>5</p>', '<p>4</p>', '', '', '', '', '', 'C', 1598425352, 1598425352, '1', 1, '<p xss=removed>Pasal 1 ayat 3 “ Negara  Indonesia  adalah  negara hukum “.</p>'),
(144, 1, 2, 5, '', '', 'Terbentuknya negara melalui adanya kelebihan dan dominasi seseorang atas orang lain, pemahaman itu merupakan intisari dari ...', '<p>Teori perjanjian</p>', '<p>Teori perjanjian</p>', '<p>Teori politik  </p>', '<p>Teori yuridis</p>', '<p>Teori kekuasaan</p>', '', '', '', '', '', 'E', 1598425667, 1598525038, '1', 1, '<p>Teori  kekuasaan  yang  bersifat  fisik:  yaitu  yang kuatlah yang berkuasa (ajaran yang  dianut oleh Machiaveli).</p>'),
(145, 1, 2, 5, '', '', 'Sepanjang sejarah Indonesia, telah diselenggarakan pemilu sebanyak ...', '<p>10 kali</p>', '<p>11 kali</p>', '<p>9 kali</p>', '<p>4 kali</p>', '<p>6 kali</p>', '', '', '', '', '', 'B', 1598425977, 1598525013, '1', 1, '<p>Sepanjang     sejarah     Indonesia,     telah  diselenggarakan pemilu sebanyak 11 kali.</p>');
INSERT INTO `tb_soal` (`id_soal`, `dosen_id`, `matkul_id`, `bobot`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `file_a`, `file_b`, `file_c`, `file_d`, `file_e`, `jawaban`, `created_on`, `updated_on`, `tipe`, `id_ujian`, `pembahasan`) VALUES
(146, 1, 2, 5, '', '', 'Lembaga yang menjalankan pemerintahan daerah dan melaksanakan tugas mengatur rumah tangga daerahnya saat Indonesia baru merdeka adalah ...', '<p>Komite Nasional Indonesia Daerah</p>', '<p>Komite Nasional Indonesia Merdeka</p>', '<p>Komite Nasional Perbantuan Daerah</p>', '<p>Komite Daerah</p>', '<p>Komite Daerah Perbantuan Nasional</p>', '', '', '', '', '', 'A', 1598426238, 1598524983, '1', 1, '<p>Kalau   di   pusat   ada   Komite   Nasional  Indonesia   Pusat   (KNIP),   untuk   daerah  dibentuklah  Komite   Nasional   Indonesia  Daerah.</p>'),
(147, 1, 2, 5, '', '', 'Negara yang mengakui kedaulatan Negara Republik Indonesia yang pertama kali adalah ...', '<p>Jepang</p>', '<p>Jepang</p>', '<p>Thailand</p>', '<p>Amerika Serikat</p>', '<p>Mesir</p>', '', '', '', '', '', 'E', 1598426698, 1598524939, '1', 1, '<p>Pengakuan kedaulatan diawali oleh perjanjian kerjasama antara Indonesia dan Mesir.</p>'),
(148, 1, 2, 5, '', '', 'Nama raja kerajaan Ternate - Tidore adalah sebagai berikut, kecuali ...', '<p>Pangeran Nuku</p>', '<p>Zainal abidin</p>', '<p>Sultan Baabullah</p>', '<p>Sultan Agung</p>', '<p>Sultan Hairun</p>', '', '', '', '', '', 'D', 1598426919, 1598524923, '1', 1, '<p>Nama raja kerajaan Ternate - Tidore adalah Zainal Abidin, Sultan Baabullah, Sultan Hairun, Pangeran Nuku, Sultan Mansur</p>'),
(149, 1, 2, 5, '', '', 'Tiga tuntutan rakyat (Tritura) disampaikan oleh ...', '<p>Indische Partij</p>', '<p>KAMI</p>', '<p>Jong Celebes</p>', '<p>Tiga Serangkai</p>', '<p>Jong Java</p>', '', '', '', '', '', 'B', 1598427955, 1598524895, '1', 1, '<p>Tiga tuntutan kepada pemerintah yang diserukan para mahasiswa yang tergabung dalam Kesatuan Aksi Mahasiswa Indonesia (KAMI) disampaikan oleh Tritura. Isinya adalah bubarkan PKI dan ormasnya, perombakan kabinet Dwikora, dan turunkan harga sandang-pangan.</p>'),
(150, 1, 2, 5, '', '', 'APBN ditetapkan dengan persetujuan ...', '<p>DPR</p>', '<p>Presiden</p>', '<p>MA</p>', '<p>MPR</p>', '<p>Kejaksaan Agung</p>', '', '', '', '', '', 'A', 1598428094, 1598524876, '1', 1, '<p>Anggaran Pendapatan dan Belanja Negara atau disingkat APBN, adalah rencana keuangan tahunan pemerintahan Negara Indonesia yang disetujui oleh Dewan Perwakilan Rakyat. APBN berisi daftar sistematis dan terperinci yang memuat rencana penerimaan dan pengeluaran Negara selama satu tahun anggaran (1 Januari – 31 Desember). APBN, Perubahan APBN dan Pertanggungjawaban APBN setiap tahun ditetapkan dengan Undang - Undang.</p>'),
(151, 1, 2, 5, '', '', 'Gadjah Mada yang terkenal dengan sumpah Palapa nya berasal dari kerajaan ...', '<p>Singosari</p>', '<p>Majapahit</p>', '<p>Samudera Pasai</p>', '<p>Kutai</p>', '<p>Sriwijaya</p>', '', '', '', '', '', 'B', 1598428341, 1598524856, '1', 1, '<p>Gadjah Mada merupakan seorang patih dari kerajaan yang dipimpin oleh raja Hayam Wuruk yakni Kerajaan Majapahit.</p>'),
(152, 1, 2, 5, '', '', 'Bila Presiden dan Wakil Presiden mangkat dalam waktu bersamaan, maka tugas kenegaraan digantikan oleh ...', '<p>Ketua MPR</p>', '<p>Menteri dalam Negeri</p>', '<p>Menteri Dalam Negeri, Menteri Luar Negeri, Menteri Pertahanan</p>', '<p>Menteri Luar Negeri</p>', '<p>Menteri Pertahanan</p>', '', '', '', '', '', 'C', 1598428530, 1598520759, '1', 1, '<p>Sesuai dengan pasal 8 ayat 3 UUD 1945, “Jika Presiden dan Wakil Presiden mangkat, berhenti, diberhentikan, atau tidak dapat melakukan kewajibannya dalam masa jabatannya secara bersamaan, pelaksana tugas kepresidenan adalah Menteri Luar Negeri, Menteri Dalam Negeri dan Menteri Pertahanan secara bersama - sama.</p>'),
(153, 1, 2, 5, '', '', 'Berikut Ini yang merupakan tugas dan wewenang Makamah Agung adalah ...', '<p>Memeriksa dan memutus permohonan di tingkat banding</p>', '<p>Memeriksa dan memutus permohonan peninjauan kembali putusan yang belum memperoleh status hokum tetap</p>', '<p>Memberikan nasihat kepada presiden dalam pemberian dan penolakan abolisi</p>', '<p>Menguji secara material terhadap peraturan perundang-undangan di atas undang-undang</p>', '<p>Memberikan pertimbangan dalam bidang hukum kepada lembaga tinggi Negara</p>', '', '', '', '', '', 'E', 1598428715, 1598524809, '1', 1, '<p>Diminta ataupun tidak, MA dapat memberikan pertimbangan dalam bidang hukum kepada lembaga tinggi negara.</p>'),
(154, 1, 2, 5, '', '', 'Pemisahan kekuasaan pada tiga lembaga yang berbeda (legislatif, yudikatif, eksekutif) disebut ...', '<p>Trias Politika</p>', '<p>Triumvirat</p>', '<p>Magnum Opus</p>', '<p>Monarki</p>', '<p>Tirani</p>', '', '', '', '', '', 'A', 1598428851, 1598524791, '1', 1, '<p>Pemisahan kekuasaan pada 3 lembaga yang berbeda (legislative, yudikatif, eksekutif) disebut Trias Politika.</p>'),
(155, 1, 2, 5, '', '', 'Hukum yang mengatur hubungan antara negara dengan alat - alat perlengkapannya atau hubungan antara negara dengan warga negara, termasuk dalam ...', '<p>Hukum privat  </p>', '<p>Hukum pidana  </p>', '<p>Hukum perdata  </p>', '<p>Hukum administrasi negara  </p>', '<p>Hukum publik</p>', '', '', '', '', '', 'E', 1598429066, 1598524770, '1', 1, '<p>Hukum yang mengatur hubungan antara negara dengan alat - alat perlengkapannya atau hubungan antara negara dengan warga negara, termasuk dalam Hukum Publik.</p>'),
(156, 1, 2, 5, '', '', 'Berikut ini lembaga Negara yang tidak dipilih langsung oleh rakyat adalah ...', '<p>Anggota DPR</p>', '<p>Anggota DPD</p>', '<p>Presiden</p>', '<p>Wakil Presiden</p>', '<p>Anggota BPK</p>', '', '', '', '', '', 'E', 1598429333, 1598524752, '1', 1, '<p>Anggota BPK dipilih oleh DPR atas pertimbangan DPD.</p>'),
(157, 1, 2, 5, '', '', 'Di antara negara - negara berikut ini, yang menerapkan sistem pemerintahan referendum adalah ...', '<p>Swiss</p>', '<p>Inggris</p>', '<p>Italia</p>', '<p>Belanda</p>', '<p>Belgia</p>', '', '', '', '', '', 'A', 1598429591, 1598524725, '1', 1, '<p>Swiss menganut sistem pemerintahan referendum (parlementer dan presidensil) yang berarti diketuai oleh presiden dan parlemen. Referendum berasal dari kata refer (mengembalikan) yang berarti pelaksanaan pemerintahan dikembalikan / diawasi oleh masyarakatnya . Di Swiss, parlemen sepenuhnya mengatur pemerintahan dalam negara, dan mereka selalu berusaha mencapai keseimbangan dinamika di antara badan legislatif dan eksekutif. Ada dua jenis referendum yang diterapkan di Negara Swiss, yaitu facultative referendum dan obligatory referendum . Facultative referendum adalah ketika Jika penduduk menolak suatu hukum, mereka harus bisa mendapatkan 50.000 tanda tangan yang tidak menyetujui hukum tersebut dalam waktu 100 hari. Jika sudah didapati demikian, maka akan diadakan suatu pemilihan nasional untuk menentukan apakah para penduduk lainnya juga menyetujui atau menolak hukum tersebut. Ini adalah tipe referendum yang sering digunakan. Obligatory referendum adalah suatu kewenangan untuk penduduk agar dapat membuat suatu amandemen konstitusi apabila mereka mendapatkan 100.000 tanda tangan yang menyetujuinya dalam waktu 18 bulan.</p>'),
(158, 1, 2, 5, '', '', 'Lembaga kekuasaan kehakiman yang berwenang memeriksa dan memutus permohonan banding adalah ...', '<p>Komisi Yudisial</p>', '<p>Pengadilan Tinggi</p>', '<p>Pengadilan Negeri</p>', '<p>Mahkamah Agung</p>', '<p>Mahkamah Konstitusi</p>', '', '', '', '', '', 'B', 1598429695, 1598524686, '1', 1, '<p>Pengadilan Tinggi adalah pengadilan tingkat banding, yaitu pengadilan yang memeriksa kembali perkara yang telah diputuskan pengadilan negeri. Tempat kedudukan pengadilan tinggi di ibukota provinsi.</p>'),
(159, 1, 2, 5, '', '', 'Suatu model atau pola berpikir sebagai upaya untuk melaksanakan perubahan yang direncanakan disebut ...', '<p>Rencana pembangunan</p>', '<p>Paradigma pembangunan</p>', '<p>Strategi pembangunan</p>', '<p>Pola pembangunan</p>', '<p>Upaya pembangunan</p>', '', '', '', '', '', 'B', 1598429843, 1598520838, '1', 1, '<p>Pengertian Paradigma Pembangunan adalah suatu model, pola yang merupakan sistem berfikir sebagai upaya mewujudkan perubahan yang direncanakan sesuai dengan cita - cita kehidupan bermasyarakat menuju hari esok yang lebih baik secara kuantitas maupun kualitasnya. Hakekat kedudukan Pancasila sebagai paradgima pembangunan nasional mengandung suatu konsekuensi bahwa di dalam semua aspek pembangunan, niai - nilai Pancasila harus mewarnai jiwa pembangunan baik dalam perencanaan, pelaksanaan, pengorganisasian, pengawasan maupun dalam evaluasinya . Pembangunan yang dilakukan di berbagai bidang kehidupan ini adalah untuk meningkatkan harkat dan martabat masyarakat Indonesia berdasarkan nilai kodrat manusia</p>'),
(160, 1, 2, 5, '', '', 'Perang Tapanuli di Sumatera Utara dipimpin oleh ...', '<p>Panglima Polim</p>', '<p>Thomas Matulessi</p>', '<p>Mohammad Shahab</p>', '<p>Sisingamangaraja XII  </p>', '<p>Peto Syarif</p>', '', '', '', '', '', 'D', 1598429983, 1598524597, '1', 1, '<p>Perang Tapanuli di Sumatera Utara dipimpin oleh Sisingamangaraja XII.</p>'),
(161, 1, 2, 5, '', '', 'Hasil keputusan sidang II PPKI pada 19 Agustus 1945 adalah ...', '<p>Pemilihan presiden dan wakil presiden</p>', '<p>Penetapan dan pengesahan UUD 1945</p>', '<p>Pembentukan Badan Komite Nasional sebagai pembantu presiden</p>', '<p>Penetapan 12 menteri untuk membantu tugas presiden</p>', '<p>Penetapan dan pengesahan pembukaan UUD 1945</p>', '', '', '', '', '', 'D', 1598430110, 1598570240, '1', 1, '<p>Hasil keputusan sidang II PPKI pada 19 Agustus 1945: </p><ol><li>Pembagian wilayah, terdiri atas 8 provinsi; </li><li>Membentuk Komite Nasional (Daerah);</li><li>Menetapkan 12 departemen dengan menterinya yang mengepalai departemen dan 4 menteri negara.</li></ol>'),
(162, 1, 2, 5, '', '', 'Rumah adat Tongkonan berasal dari Provinsi ...', '<p>Sulawesi Selatan</p>', '<p>Sulawesi Utara</p>', '<p>Sulawesi Tengah</p>', '<p>Sulawesi Tenggara</p>', '<p>Maluku</p>', '', '', '', '', '', 'A', 1598430228, 1598524559, '1', 1, '<p>Rumah adat Sulawesi Selatan (Rumah Tongkonan); Rumah adat Sulawesi Utara (Rumah Mongondow); Rumah adat Sulawesi Tengah (Rumah Saoraja); Rumah adat Sulawesi Tenggara (Rumah Istana Buton); Rumah adat Maluku (Rumah Baileo).</p>'),
(163, 1, 2, 5, '', '', 'Sebagai akibat diterapkannya politik ekonomi liberal pada akhir abad ke - 19 terjadi pemindahan penduduk ke industri seperti di bawah ini, kecuali ...', '<p>Industri gula  </p>', '<p>Industri kelapa sawit  </p>', '<p>Industri teh</p>', '<p>Industri kopi</p>', '<p>Industri tembakau  </p>', '', '', '', '', '', 'A', 1598430316, 1598524548, '1', 1, '<p>Sebagai akibat diterapkannya politik ekonomi liberal pada akhir abad ke - 19 terjadi pemindahan penduduk ke industri : Perkebunan tembakau di Deli, Sumatra Utara; Perkebunan tebu di Jawa Tengah dan Jawa Timur; Perkebunan kina di Jawa Barat; Perkebunan karet di Sumatra Timur; Perkebunan kelapa sawit di Sumatera Utara; Perkebunan teh di Jawa Barat dan Sumatera Utara.</p>'),
(164, 1, 2, 5, '', '', 'Dispensasi : ...', '<p>Pelarangan</p>', '<p>Kelonggaran</p>', '<p>Perizinan</p>', '<p>Pencegahan  </p>', '<p>Hadiah  </p>', '', '', '', '', '', 'B', 1598430428, 1598524527, '2', 1, '<p>Dengan menggunakan trik pergunakan kalimat umum, kata <strong>dispensasi </strong>di atas dapat dibuat kalimat umumnya menjadi, Seorang karyawan wanita diberi <strong>dispensasi </strong>dari pekerjaan berat karena sedang hamil. </p><p>Sehingga arti kata dispensasi adalah kelonggaran.</p>'),
(165, 1, 2, 5, '', '', 'Siklus', '<p>Daur</p>', '<p>Baur</p>', '<p>Tingkatan</p>', '<p>Proses  </p>', '<p>Kelas </p>', '', '', '', '', '', 'A', 1598431115, 1598524512, '2', 1, '<p>Siklus = Daur</p>'),
(166, 1, 2, 5, '', '', '<p>TERKATUNG >&lt; ... </p>', '<p>Melayang </p>', '<p>Pasti </p>', '<p>Ombak </p>', '<p>Terperosok </p>', '<p>Terbenam </p>', '', '', '', '', '', 'E', 1598431913, 1598431913, '2', 1, '<p>Biasanya karena tergesa-gesa banyak yang secara tidak sadar menjawab MELAYANG, padahal yang dicari adalah lawan kata dari terkatung, yaitu TERBENAM.</p>'),
(167, 1, 2, 5, '', '', 'ES : AIR', '<p>Didih  </p>', '<p>Uap  </p>', '<p>Cair  </p>', '<p>Sublim  </p>', '<p>Beku  </p>', '', '', '', '', '', 'C', 1598432142, 1598524478, '2', 1, '<p>Padanan kata di atas memiliki hubungan <strong>cair</strong>. Es mencair menjadi air.</p>'),
(168, 1, 2, 5, '', '', 'Mana yang berbeda dari kendaraan di bawah ini ?', '<p>Mobil</p>', '<p>Motor</p>', '<p>Bus</p>', '<p>Kereta </p>', '<p>Kapal</p>', '', '', '', '', '', 'E', 1598432486, 1598524468, '2', 1, '<p>Saya bepergian menggunakan kendaraan darat seperti mobil, motor, bus, atau kereta. Kapal bukan dalam kelompok kata kendaraan darat sehingga kapal adalah jawabannya.</p>'),
(169, 1, 2, 5, '', '', '<p>Jika -2 ≤ x ≤ 7 dan 4 ≤ y ≤ 9, maka hubungan x dan y adalah ....</p>', '<p>x < y', '<p>x > y </p>', '<p>x = y </p>', '<p>tidak dapat ditentukan   </p>', '<p>semua jawaban salah</p>', '', '', '', '', '', 'D', 1598433003, 1598433003, '2', 1, '<p>lnterval / daerah pada soal dapat kita gambarkan posisinya di garis bilangan.  </p><p><img src=\"https://2.bp.blogspot.com/-M_J8jybz0O8/WxO1B5QhJwI/AAAAAAAAAE0/vXoq7_3AheouO2IJInyIhPzOVxXSvddtQCLcBGAs/s1600/Capture.JPG\" xss=removed class=\"fr-fic fr-dii\"> </p><p>Terlihat bahwa hubungan x dan y tidak dapat ditentukan.</p>'),
(170, 1, 2, 5, '', '', 'Semua murid pandai berhitung dan sopan.Asnan tidak sopan, tetapi pandai berhitung. Kesimpulan ...', '<p>Asnan adalah seorang murid yang pandai berhitung.  </p>', '<p>Asnan adalah seorang murid yang tidak sopan.  </p>', '<p>Asnan adalah seorang murid yang pandai berhitung dan tidak sopan.  </p>', '<p>Asnan adalah bukan seorang murid meskipun pandai berhitung.  </p>', '<p>Asnan adalah bukan seorang murid yang sopan.  </p>', '', '', '', '', '', 'D', 1598433471, 1598524338, '2', 1, '<p>Sangat jelas bahwa Asnan adalah bukan seorang murid meskipun pandai berhitung.  </p><p>Terlihat pada Diagram Venn berikut.</p><p><img src=\"https://3.bp.blogspot.com/-u0n180v140Y/WxPPZyWZXDI/AAAAAAAAAF0/kxmhI-MvNGUHZ8Zeh-GNr48EpRuWPCExgCLcBGAs/s1600/8f.JPG\" class=\"fr-fic fr-dii\"></p><p><br>A= sifat pandai berhitung  </p><p>B = sifat sopan</p><p>C =  murid yang bersikap pandai berhitung dan sopan</p><p>Daerah arsiran menunjukkan posisi Asnan sehingga Asnan adalah bukan seorang murid meskipun pandai berhitung.  </p>'),
(171, 1, 2, 5, '', '', 'Ada lima mahasiswa P, Q, R, S, dan T yang mengikuti sebuah seminar. Mahasiswa P dan Q berasal dari fakultas yang sama, dan S dan T juga berasal dari fakultas yang sama. Bila mahasiswa yang berasal dari fakultas yang sama tidak boleh duduk berdekatan, kemungkinan posisi tempat duduk mereka dalam satu deretan adalah ...', '<p>P, S, T, Q, R</p>', '<p>P, Q, R, S, T</p>', '<p>T, R, S, P, Q</p>', '<p>P, R, T, S, Q</p>', '<p>S, R, P, T, Q</p>', '', '', '', '', '', 'E', 1598433618, 1598524303, '2', 1, '<p>Pergunakan TRIK melihat jawaban. Jawaban A, B, C, dan D sangat tidak mungkin karena P berdekatan dengan Q dan S berdekatan dengan T. Jadi jelas bahwa E adalah jawaban paling tepat.</p>'),
(172, 1, 2, 5, '', '', 'Jika √x + √y = 11 dan √x - √y = 3 , maka x – y = ...', '<p>8</p>', '<p>33</p>', '<p>9</p>', '<p>14</p>', '<p>66</p>', '', '', '', '', '', 'B', 1598434501, 1598594951, '2', 1, '<p>x - y = (√x + √y)(√x - √y)  </p><p>x - y = 11 x 3 = 33</p>'),
(173, 1, 2, 5, '', '', '<p>JIka X = 1234 x 1232 – 1233<sup>2 </sup>+ 1 dan y = 300<sup>2</sup> - 301 x 299, maka</p>', '<p>X > Y</p>', 'X < Y', '<p>X = Y</p>', '<p>hubunga X dan Y tidak bisa di tentukan</p>', '2X < Y', '', '', '', '', '', 'B', 1598435476, 1598436523, '2', 1, '<p>X = 1234 x 1232 - 1233<sup>2</sup><sup> </sup>+ 1</p><p>   =(1233  + 1 )(1233 - 1 ) - (1233<sup>2 </sup>- 1)</p><p>   =(1233<sup>2</sup> - 1) - (1233<sup>2 </sup>- 1) = 0</p><p>Y = 300<sup>2 </sup>- 301 x 299</p><p>   = 300<sup>2  </sup>- (300 + 1) (300 - 1)</p><p>   = 300<sup>2  </sup>- 300<sup>2 </sup>- 1 = 1</p><p><br></p><p>Jadi Nilai X < Y'),
(174, 1, 2, 5, '', '', 'Q/17,5% = 280/Q, Nilai Q pada persamaan di atas adalah', '<p>8</p>', '<p>3</p>', '<p>5</p>', '<p>4</p>', '<p>7</p>', '', '', '', '', '', 'E', 1598435862, 1598594892, '2', 1, '<p>Q/17,5% = 280/Q</p><p>Q<sup>2  </sup>= 17,5% x 280</p><p>Q<sup>2  </sup>= 17,5/100 x 280</p><p>Q<sup>2 </sup> =  4900/100</p><p>Q<sup>2 </sup>= 49</p><p>Q  = 7</p>'),
(175, 1, 2, 5, '', '', 'Seorang anak bernama Intan setiap pagi selalu berolah raga memutari sebuah lapangan dengan keliling 0,5 km. Apabila dengan kecepatan lari 5 km/jam Intan mampu memutari lapangan sebanyak 5 kali, berapa lamakah Intan lari setiap paginya ?', '<p>10 menit</p>', '<p>30 menit</p>', '<p>50 menit</p>', '<p>40 menit</p>', '<p>20 menit</p>', '', '', '', '', '', 'B', 1598437087, 1598524164, '2', 1, '<ul><li>Setiap hari Intan berlari dengan jarak 2,5 km (0,5 x 5)</li><li>waktu=  jarak/kecepatan=  (2,5 km)/(5 km/jam)=0,5 jam</li><li>maka Intan setiap hari berlari selama 30 menit.</li></ul>'),
(176, 1, 2, 5, '', '', 'Seorang anak bernama Intan dalam 1 menit dapat membuat 10 simpul pita, sedangkan Joko dapat membuat dua kali lipatnya. Jika Intan mulai bekerja 15 menit lebih awal dari Joko, dan keduanya selesai setelah Joko bekerja selama 1 jam maka banyak simpul yang dihasilkan keduanya adalah ...', '<p>450</p>', '<p>1950</p>', '<p>2700</p>', '<p>2250</p>', '<p>1800</p>', '', '', '', '', '', 'B', 1598437296, 1598524125, '2', 1, '<p>S<sub>total</sub> = S<sub>Intan</sub> + S<sub>Joko</sub><br>S<sub>total</sub> = (10 x 75 menit) + (20 + 60 menit) = 1.950</p>'),
(177, 1, 2, 5, '948ab5088b58f3ff2227142acd525d2b.png', 'image/png', 'Median dari hasil ujian matematika tersebut adalah ...', '<p>50</p>', '<p>80</p>', '<p>60</p>', '<p>70</p>', '<p>90</p>', '', '', '', '', '', 'B', 1598437757, 1598524096, '2', 1, '<p>Dari jumlah siswa sebanyak 150 orang, maka nilai tengahnya berada pada urutan antara 75-76. Jika diurutkan maka urutan tersebut memiliki nilai 80.</p>'),
(178, 1, 2, 5, 'e2deb6c3dcf38d081c3a06c460b4f6de.png', 'image/png', 'Range dari hasil ujian matematika tersebut adalah ...', '<p>50</p>', '<p>40</p>', '<p>45</p>', '<p>55</p>', '<p>60</p>', '', '', '', '', '', 'A', 1598437945, 1598524058, '2', 1, '<p>Selisih nilai tertinggi dan terendah adalah 50 (100 – 50).</p>'),
(179, 1, 2, 5, '', '', 'Seorang anak bernama Intan membeli baju seharga Rp. 100.000,00 dengan diskon 25% + 40% celana seharga Rp 100.000,00 dengan diskon 55%. Jika m adalah harga baju setelah diskon dan n adalah harga celana setelah diskon maka ...', '<p>m > n</p>', '<p>m − m = 10.000</p>', '<p>m + n = 100.000</p>', '<p>m < n>', '<p>m = n</p>', '', '', '', '', '', 'E', 1598438197, 1598523987, '2', 1, '<ul><li>m = 100.000 x (1 – 25%) x (1 – 40%)<br>m = 100.000 x 75% x 60%<br>m = 45.000</li><li>n = 100.000 x (1 – 55%)<br>n = 100.000 x 45%<br>n = 45.000</li><li>maka m = n</li></ul>'),
(180, 1, 2, 5, '', '', 'Seorang anak bernama Intan membeli 27 kg minyak dengan total harga Rp 351.000. Jika sepertiga minyak dijual dengan harga Rp 15.000/kg dan sisanya dijual dengan harga Rp 14.000/kg, berapa persen keuntungan yang diperoleh intan ? ', '<p>10,26% </p>', '<p>12,06% </p>', '<p>16,02% </p>', '<p>12,6% </p>', '<p>10,62% </p>', '', '', '', '', '', 'A', 1598438710, 1598438710, '2', 1, '<ul>\r\n<li>Penjualan sepertiga minyak (9kg) = Rp 15.000 x 9 = Rp 135.000</li>\r\n<li>Penjualan dua pertiga minyak (18kg) = Rp 14.000 x 18 = Rp 252.000</li>\r\n<li>Total penjualan minyak Rp 387.000 dan keuntungannya Rp 36.000</li>\r\n<li>Maka persentase keuntungan Intan adalah 10,26% (36.000/351.000 x 100%)</li>\r\n</ul>'),
(181, 1, 2, 5, '', '', 'Seorang pengusaha berencana untuk menghasilkan keuntungan setelah pajak pada tahun 2014 sebesar 30 % dari penjualan. Jika besarnya pajak adalah 20 % dari keuntungan sebelum pajak dan semua biaya sebesar Rp 500 juta, berapa minimal penjualan yang harus dicapai untuk memperoleh keuntungan seperti yang direncanakan ?', '<p>Rp 1,6 miliar</p>', '<p>Rp 1,5 miliar</p>', '<p>Rp 1,2 miliar</p>', '<p>Rp 1 miliar</p>', '<p>Rp 800 juta</p>', '', '', '', '', '', 'E', 1598439008, 1598523837, '2', 1, '<ul><li>misalnya U = untung, B = biaya, P = penjualan</li><li>U = P – B<br>U = P – 500 (sebelum pajak)</li><li>setelah pajak<br>U = 80% (P – 500)<br>30%P = 80% (P – 500)<br>3P = 8 (P – 500) = 8P – 4000<br>5P = 4000<br>P = 800</li><li>maka penjualan minimal yang harus dicapai adalah 800 juta.</li></ul>'),
(182, 1, 2, 5, '', '', 'Pak Bandi memancing di kolam dengan membayar Rp 30.000/jam. Setiap 10 menit ia mampu mendapatkan 0,4 kg ikan. Ia hanya membawa pulang ikan sebanyak 1 kg dan sisanya ia jual dengan harga Rp 20.000/kg. Jika pak Bandi hanya membawa uang Rp 50.000 saat memancing dan ia hanya memancing selama satu jam, maka uang yang dibawanya pulang sebesar ...', '<p>Rp 2.000</p>', '<p>Rp 20.000</p>', '<p>Rp 28.000</p>', '<p>Rp 32.000</p>', '<p>Rp 48.000</p>', '', '', '', '', '', 'E', 1598439144, 1598523427, '2', 1, '<ul><li>Dalam satu jam pak Bandi mendapat ikan sebanyak 2,4 kg (0,4 x 6).</li><li>Jumlah ikan yang dijualnya sebanyak 1,4 kg dengan harga Rp 28.000 (1,4 x 20.000)</li><li>Maka jumlah uang yang dibawa pulang pak Bandi adalah Rp 48.000 (50.000 – 30.000 + 28.000)</li></ul>'),
(183, 1, 2, 5, '', '', '<p>Seorang anak bernama Intan memiliki sebuah pohon jati yang mengalami pertambahan tinggi per hari 1/8 kali dari tinggi sebelumnya. Pohon tersebut diukur seminggu sekali. Jika tinggi pohon jati 23 cm pada pengukuran awal, maka berapakah tinggi pohon jati pada pengukuran berikutnya ? </p>', '<p>16,1 cm </p>', '<p>49,05 cm </p>', '<p>52,45 cm </p>', '<p>50,07 cm </p>', '<p>32,2 cm </p>', '', '', '', '', '', 'C', 1598439449, 1598439449, '2', 1, '<p><img src=\"https://4.bp.blogspot.com/-2Sokdn5Pm0M/XMVcz1tqvrI/AAAAAAAABFY/_cXXksZoTigY_NAs959_kxo3RDV3JoSIQCLcBGAs/s1600/aritmetika17.PNG\" alt=\"\" width=\"300\" height=\"187\" class=\"fr-fic fr-dii\"></p>'),
(184, 1, 2, 5, '', '', '<p>Sebuah bola dijatuhkan ke lantai dari ketinggian 2 meter. Setiap kali setelah memantul, bola itu mencapai ketinggian tiga perempat dari ketinggian yang dicapai sebelumnya. Panjang lintasan bola tersebut dari pantulan ketiga sampai berhenti adalah ... meter. </p>', '<p>3,38 </p>', '<p>4,26 </p>', '<p>5,50 </p>', '<p>6,75 </p>', '<p>8,00 </p>', '', '', '', '', '', 'D', 1598439660, 1598439660, '2', 1, '<p><img src=\"https://4.bp.blogspot.com/-ljYkBhTXTIw/XMVcz1yQNZI/AAAAAAAABFc/gMhoJMuTT6UKNcxRELDNnW966hvdC9B5ACLcBGAs/s1600/aritmetika18.PNG\" alt=\"\" width=\"300\" height=\"224\" class=\"fr-fic fr-dii\"></p><p>bila kita memantulkan sebuah bola, maka bola tersebut akan naik dan kemudian turun dengan tinggi yang sama pula, lalu pada pantulan berikutnya akan semakin menurun, sehingga panjang lintasan totalnya adalah 2 kali (naik dan turun), sehingga panjang lintasan total pada soal diatas adalah S<sub>∞ </sub>= 27/8  x 2 = 27/4 = 6,75 meter.</p>'),
(185, 1, 2, 5, '', '', '</span>Jika diketahui m<sup>2</sup>n<sup>4</sup> = 64 dan mn = 4 maka nilai 2m – 8 = ...', '<p>2</p>', '<p>0</p>', '<p>4</p>', '<p>-4</p>', '<p>-16</p>', '', '', '', '', '', 'D', 1598439938, 1598439938, '2', 1, '<p>Jawab :<br>m<sup>2</sup> . n<sup>4</sup> = 64<br>m<sup>2</sup> . n<sup>2</sup> . n<sup>2</sup> = 64<br>(mn)<sup>2</sup> . n<sup>2</sup> = 64<br>(4)<sup>2</sup> . n<sup>2</sup> = 64<br>n<sup>2</sup> = 4 → n = 2<br><strong>maka 2m – 8 = 2(2) – 8 = -4</strong></p>'),
(186, 1, 2, 5, '', '', '<p>Jika 3<sup>x<sup>3</sup></sup>= 6561 dan 4<sup>y</sup> = 1024 maka ...</p>', 'x<y', 'x=y', 'x=2y', 'x>y', 'Hubungan x dan y tidak dapat ditentukan', '', '', '', '', '', 'A', 1598440492, 1598440492, '2', 1, '<p>Jawab :<br>3<sup>x<sup>3 </sup></sup>= 6561 = 3<sup>8</sup><br>x<sup>3</sup> = 8 → x<sup>3</sup> = 2<sup>3</sup> → <strong>x = 2</strong></p><p>4<sup>y</sup> = 1024 = 4<sup>5</sup><br><strong>y = 5</strong></p><p>maka x < y'),
(187, 1, 2, 5, '', '', 'Di sebuah pasar, harga daging lokal lebih mahal dari harga beras, harga beras lebih mahal dari harga sayur-mayur, dan daging impor adalah yang paling mahal, jika demikian dapat disimpulkan ..... ', '<p>Sayur-mayur lebih mahal dari daging lokal.  </p>', '<p>Daging lokal lebih mahal dari daging impor </p>', '<p>Daging impor lebih mahal dari daging lokal.  </p>', '<p>Beras lebih mahal dari daging impor.  </p>', '<p>Sayur-mayur lebih mahal dari daging impor.  </p>', '', '', '', '', '', 'C', 1598441298, 1598441298, '2', 1, '<div class=\"jawaban\"><div class=\"jawab\">Keterangan: </div><ul><li>Harga daging lokal > harga beras </li><li>Harga beras > harga sayur-mayur </li><li>Harga daging impor paling mahal </li></ul><p>Diperoleh: Harga daging impor > harga daging lokal > harga beras > harga sayur-mayur.</p><p>Dari pilihan jawaban, yang benar adalah<strong> daging impor lebih mahal dari daging lokal.</strong></p></div>'),
(188, 1, 2, 5, '', '', 'Seseorang mengendarai motornya sejauh 40 km ke tempat kerjanya setiap hari dalam waktu 55 menit. Pada suatu hari ia berangkat terlambat 7 menit. Dengan kecepatan berapakah ia harus berkendaraan agar sampai pada waktu yang sama dengan waktu biasanya? ', '<p>48 km/jam </p>', '<p>50 km/jam </p>', '<p>80 km/jam</p>', '<p>60 km/jam </p>', '<p>65 km/jam </p>', '', '', '', '', '', 'B', 1598441541, 1598441541, '2', 1, '<div class=\"jawaban\"><div class=\"jawab\">Terlambat 7 menit berarti waktu tempuh tinggal 48 menit, sehingga:</div>v = 40 : (48/60) = (40 x 60) : 48 = 50 km/jam.</div>'),
(189, 1, 2, 5, '', '', 'Sebuah survey yang dilakukan pada 50 orang di sebuah toko kaset menghasilkan: 25 Orang suka musik pop, 27 Orang suka musik rock 4 Orang tidak suka musil pop atau rock, Berapa orang yang hanya suka satu jenis musik ?', '<p>6</p>', '<p>52</p>', '<p>40</p>', '<p>46</p>', '<p>12</p>', '', '', '', '', '', 'C', 1598441713, 1598525808, '2', 1, '<div class=\"jawaban\"><div class=\"jawab\">S + D = L</div>50 + D = 25 + 27 + 4<br>50 + D = 56<br>D = 6<br>Jadi, jumlah orang yang suka musik pop saja = 25 orang – 6 = 21 orang<br>Jumlah orang yang hanya suka satu jenis musik = 19 + 21 = 40 orang.</div>'),
(190, 1, 2, 5, '', '', 'Diba kakaknya Sarah namun adiknya Gari. Dini juga adik Diba dan lebih tua usianya dibandingkan Sarah. Sebutkan urutan keempat saudara itu dimulai dari yang paling muda usianya!', '<p>Diba – Sarah – Dini – Gari. </p>', '<p>Gari – Diba – Dini – Sarah. </p>', '<p> Gari – Diba – Sarah – Dini. </p>', '<p> Gari – Dini – Diba – Sarah. </p>', '<p>Diba – Gari – Dini – Sarah. </p>', '', '', '', '', '', 'B', 1598441827, 1598520171, '2', 1, '<div class=\"jawaban\"><div class=\"jawab\">Gari – Diba – Dini – Sarah </div></div>'),
(191, 1, 2, 5, '', '', 'A, B, C, F, E, D, G, H, I, L, K, J, M, .....', '<p>O dan M</p>', '<p>O dan U</p>', '<p>P dan U</p>', '<p>N dan O</p>', '<p>O dan U</p>', '', '', '', '', '', 'D', 1598441936, 1598520404, '2', 1, '<div class=\"jawaban\"><div class=\"jawab\">ABC <u>FED</u> GHI <u>LKJ</u> MNO</div>Pola setiap tiga huruf, urutannya dibalik (lihat huruf yang bergaris bawah).</div>'),
(192, 1, 2, 5, '', '', 'Sebuah perusahan penyewaan mobil mengenakan sewa Rp350.000 setiap pemakaian 24 jam untuk jam pertama, ditambah Rp50.000 untuk setiap 6 jam atau bagian dari 6 jam setelah 72 jam pertama. Jika sebuah mobil diambil pada pukul 08.00 hari senin dan dikembalikan pada hari kamis pukul 21.45 di minggu yang sama, berapakah jumlah sewa yang harus dibayar?', '<p>Rp1.150.000</p>', '<p>Rp1.200.000</p>', '<p>Rp450.000</p>', '<p>Rp500.000</p>', '<p>Rp1.250.000</p>', '', '', '', '', '', 'B', 1598442108, 1598520466, '2', 1, '<div class=\"jawaban\"><div class=\"jawab\">Waktu pinjam 93 jam 45 menit</div>= 72 jam + 18 jam + 3 jam 45 menit<br>= 3 (350 rb) + 3 (50 rb) × x<br>= Rp 1.050.000 + Rp 150.000<br>= Rp 1.200.000</div>'),
(193, 1, 2, 5, '', '', 'GAJAH : GADING = HARIMAU : ...', '<p>Kuku</p>', '<p>Kulit</p>', '<p>Taring</p>', '<p>Gigi</p>', '<p>Geraham</p>', '', '', '', '', '', 'C', 1598442271, 1598520506, '2', 1, '<div class=\"jawaban\"><div class=\"jawab\"><span>Gajah mati meninggalkan gading. Sebagaimana </span><strong>harimau</strong><span> mati meninggalkan </span><strong>taring</strong><span>. </span></div></div>'),
(194, 1, 2, 5, '', '', 'Jika keliling sebuah lingkaran 34,53 meter, berapakah jari-jarinya? ', '<p>4,5 m</p>', '<p>5,5 m</p>', '<p>6,5 m</p>', '<p>7,5 m</p>', '<p>8,5 m</p>', '', '', '', '', '', 'B', 1598442735, 1598442735, '2', 1, '<p>Keliling lingkaran = 2 × π × r</p><p>34,54 = 2 × 3,14 × r</p><p>\r\nr = 34,54/6,28 = 5,5 meter</p>'),
(195, 1, 2, 5, '914fdc9931f0fc581ef5f203ae7fa5d5.png', 'image/png', 'Perhatikan gambar-gambar berikut di bawah ini, kemudian tentukan satu gambar yang merupakan kelanjutan dari gambar-gambar yang menjadi soal. ', '', '', '', '', '', 'e7c302a3065c904076b00f54c60a8e8e.png', 'c92971b91d5eb402376b8fedc15dd562.png', '4b4089a22734c73751da587b030d3e0b.png', '8055152e4a475382c5b62496809b435e.png', '912e2add8b3e3d621f9ef6b6649ae3ad.png', 'C', 1598443288, 1598463041, '2', 1, ''),
(196, 1, 2, 5, 'e8b133b1dc3ca3a36cc562a7c725ceec.png', 'image/png', 'Tentukan satu gambar yang mempunyai persamaan dengan gambar yang menjadi soal atau pertanyaan. ', '', '', '', '', '', '955ffdf16a86840b236f735887988819.png', '5133b000eceb0fe22a3a72ab837e0122.png', '1765cd1c2c2313b3d125db5d4ae958d9.png', '03a76e5144df289924aebca749c64ba4.png', '490bd46361763e17c99b9fae359a7270.png', 'B', 1598443663, 1598463270, '2', 1, ''),
(197, 1, 2, 5, '', '', 'Jika dari satu pak kartu bridge diambil satu kartu secara acak, berapakah peluang yang terambil tersebut kartu berangka 2? ', '1/11 ', '1/12 ', '1/13 ', '1/14 ', '1/15 ', '', '', '', '', '', 'C', 1598445316, 1598463155, '2', 1, 'Banyaknya kartu dalam 1 pak, yakni n(S) = 52 \r\nBanyaknya kartu angka 2, yaitu n(A) = 4 \r\nPeluang terambilnya kartu angka 2 = n(A)/ n (S) = 4/52 = 1/13'),
(198, 1, 2, 5, '527e2d424263595814b786ab6bb944d1.png', 'image/png', 'Perhatikan gambar soal Jika a = 4 cm, c = 2 cm, dan d = 20 cm, berapakah panjang b?', '12 cm ', '11 cm ', '10 cm ', '9 cm ', '8 cm ', '', '', '', '', '', 'D', 1598445802, 1598462503, '2', 1, 'a/b = c/d-c\r\n4/x = 2/20-2\r\n4/x = 2/18\r\nx = 9 cm'),
(199, 1, 2, 5, '', '', 'Menurut anda mementingkan kepentingan umum adalah ... ', '<p>Melihat skala prioritas kepentingan </p>', '<p>Melihat budi kebaikan yang pernah kita  terima dari orang lain </p>', '<p>Membantu  dengan  tulus  kepada  yang  membutuhkan </p>', '<p>Kebaikan </p>', '<p>Perbuatan yang perlu ditanamkan sejak dini </p>', '', '', '', '', '', 'A:2,B:1,C:5,D:3,E:4', 1598456296, 1598456296, '3', 1, ''),
(200, 1, 2, 5, '', '', 'Jika anda mendapatkan suatu pekerjaan yang bayarannya sangat besar, maka anda akan ... ', '<p>Bertanggung  jawab  dalam  melakukan  pekerjaan anda </p>', '<p>Lebih bersemangat </p>', '<p>Takut </p>', '<p>Merasa terharu </p>', '<p>Biasa saja </p>', '', '', '', '', '', 'A:5,B:4,C:1,D:3,E:2', 1598456425, 1598456425, '3', 1, ''),
(201, 1, 2, 5, '', '', 'Menurut saya orang tua saya sukses dalam bekerja dan berkarya karena ...', 'Mereka menempuh berbagai rintangan  untuk mencapai kesuksesan ', 'Mereka  berusaha keras  dalam  hidupnya untuk sukses ', 'Mereka mendapatkan kesempatan dan  fasilitas sehingga bisa sukses ', 'Mereka   adalah   pribadi   yang   patut  dicontoh ', 'Mereka  orang  yang sangat beruntung  dan membuat anaknya bangga ', '', '', '', '', '', 'A:4,B:5,C:2,D:3,E:1', 1598456747, 1598461638, '3', 1, ''),
(202, 1, 2, 5, '', '', 'Ketika sedang memimpin sebuah rapat ada seorang teman yang selalu membuat gaduh. Yang saya lakukan ... ', '<p>Marah dan menegurnya dengan keras </p>', '<p>Memintanya untuk menjaga sikap </p>', '<p>Marah   dan   meninggalkan   ruangan  rapat </p>', '<p>Mengeluarkannya dari rapat </p>', '<p>Tetap melanjutkan rapat </p>', '', '', '', '', '', 'A:4,B:5,C:2,D:3,E:1', 1598527254, 1598527254, '3', 1, ''),
(203, 1, 2, 5, '', '', 'Sahabat lama saya datang ke rumah saya dan ingin menginap di rumah saya. Ia sedang bermasalah dengan keluarganya. Yang saya lakukan ... ', '<p>Menolak keinginannya untuk menginap  dan melapor pada keluarganya </p>', '<p>Membiarkannya tenang dulu </p>', '<p>Mengajaknya  ngobrol  dan  membantunya menyelesaikan masalah </p>', '<p>Menasihatinya   untuk   menyelesaikan  masalahnya  sendiri  tanpa  melibatkan  orang lain </p>', '<p>Menyediakan  fasilitas  untuk  mengalihkannya dari masalah </p>', '', '', '', '', '', 'A:1,B:4,C:5,D:3,E:2', 1598527424, 1598527424, '3', 1, ''),
(204, 1, 2, 5, '', '', 'Teman - teman senang menceritakan masalah mereka kepada saya, karena menurut mereka saya ... ', '<p>Mampu menjaga rahasia </p>', '<p>Pendengar yang baik </p>', '<p>Memberikan solusi terbaik </p>', '<p>Bisa    melihat    masalah    dari    sudut  pandang </p>', '<p>Mampu  menumbuhkan  semangat  mereka </p>', '', '', '', '', '', 'A:3,B:5,C:4,D:1,E:2', 1598527574, 1598527574, '3', 1, ''),
(205, 1, 2, 5, '', '', 'Pada suatu hari libur, handphone saya berbunyi, tampak panggilan dari atasan. Biasanya atasan akan mengajak bermain tenis. Padahal saya sudah merencanakan untuk pergi piknik bersama keluarga. Saya ...', '<p>Membiarkan saja panggilan itu </p>', '<p>Mengangkat  panggilan  itu,  siapa  tahu  ada sesuatu yang penting </p>', '<p>Membiarkan  panggilan  itu,  dan  menelfon balik ketika sudah sampai di  tempat piknik </p>', '<p>Menyuruh  orang  lain  untuk  mengangkat panggilan itu </p>', '<p>Mengangkat  panggilan  dan  mengajak  atasan untuk piknik bersama </p>', '', '', '', '', '', 'A:2,B:5,C:3,D:1,E:4', 1598527894, 1598527894, '3', 1, ''),
(206, 1, 2, 5, '', '', 'Rekan team kerja anda dimarahi oleh atasan pada saat mengumpulkan tugas team karena sudah telat beberapa menit mengumpulkan tugasnya. Hal ini disebabkan karena rekan anda tersebut harus meng asembbly pekerjaan tersebut terlebih dahulu sebelum dikumpulkan ditambah lagi semua rekan anggota team mengumpulkan tugas pribadi mereka juga terlambat, sehingga rekan anda yang bertugas untuk mengasembbly setiap pekerjaan jadi tidak menyelesaikan pekerjaannya tepat waktu, sikap anda', '<p>Mendengarkan saja rekan anda dimarahi setelah itu memberikan semangat untuk tidak dimasukkan kehati ucapan atasan </p>', '<p>Minta maaf kepada teman karena keterlambatan juga disebabkan oleh anggota team yang lain </p>', '<p>Mengakui kesalahan kepada atasan jika anda juga turut berkontribusi pada masalah tersebut </p>', '<p>Mengakui kesalahan kepada teman dan berjanji tidak akan mengulanginya lagi </p>', '<p>Mengajak rekan anda untuk membicarakannya dan menghiburnya rekan yang dimarahi atasan </p>', '', '', '', '', '', 'A:1,B:3,C:5,D:4,E:2', 1598529273, 1598529273, '3', 1, ''),
(207, 1, 2, 5, '', '', 'Bulan ini anda menerima berbagai macam keluhan dari pelanggan anda terkait pelayanan dari perusahaan terhadap mereka. Sebagai perusahaan yang memberikan layanan anda sudah sepatutnya mengerti akan kebutuhan pelanggan agar mereka tetap menggunakan jasa perusahaan anda, ketika ada seorang pelanggan yang datang menyampaikan keluhannya, yang anda lakukan ', '<p>Meminta pelanggan tersebut untuk menyampaikan keluhannya </p>', '<p>Menanyakan keluhan pelanggan tersebut dan menjadikan bagian dari solusi </p>', '<p>Mendengarkan setiap keluhan yang masuk kepada anda dengan seksama </p>', '<p>Mengatasi keluhan yang masuk dengan tetap tenang dan fokus </p>', '<p>Mencoba mengerti keluhan pelanggan terhadap perusahaan  </p>', '', '', '', '', '', 'A:2,B:5,C:3,D:4,E:1', 1598529474, 1598529474, '3', 1, ''),
(208, 1, 2, 5, '', '', 'Suatu saat anda diberi tanggung jawab menjadi pemegang uang simpan pinjam di organisasi dimana anda tinggal. Iwan mendatangi anda untuk mengetahui simpanan uang yang dipunyai oleh Marwis. Hal dilakukan oleh Iwan dengan Alasan Marwis mempunyai hutang ke Iwan dan terkesan tidak mau membayar dengan alasan tidak mempunyai uang padahal ia sangat membutuhkan uang tersebut untuk membayar uang sekolah anaknya. Jika saya pada kondisi tersebut yang akan saya lakukan dalam menghadapi Iwan adalah : ', '<p>Mencoba menasehati Marwis untuk membayar ke Iwan langsung </p>', '<p>Member gambaran tentang keuangan Marwis tanpa menyebutkan jumlah minimalnya </p>', '<p>Saya tidak akan member tahu jumlah uang Marwis karena bersifat rahasia (menjaga rahasia) </p>', '<p>Memberitahu Iwan jumlah uang Marwis dengan pwertimbangan Iwan betul-betul membutuhkan uang tersebut </p>', '<p>Mendorong Iwan untuk menagih karena saya tahu Marwis mempunyai uang di simpanan </p>', '', '', '', '', '', 'A:2,B:3,C:5,D:1,E:4', 1598529672, 1598529672, '3', 1, ''),
(209, 1, 2, 5, '', '', 'Kinerja organisasi berjalan cukup efisien, namun pimpinan terkesan mengontrol situasi dengan sangat ketat. Sikap saya adalah ...', '<p>Tidak bertindak apapun, cukup dengan mengikuti jalannya arus </p>', '<p>Mengusahakan keterlibatan pegawai dalam pengambilan keputusan </p>', '<p>Mengabaikan saja </p>', '<p>Melakukan apa saja yang dapat dikerjakan utuk membuat pegawai merasa penting dan dilibatkan. </p>', '<p>Mengingatkan pentingnya batas waktu dan tugas kepada atasan. </p>', '', '', '', '', '', 'A:2,B:4,C:1,D:5,E:3', 1598534118, 1598534118, '3', 1, '<p>A. Tidak bertindak apapun, cukup dengan mengikuti jalannya arus (skor 2)<br>B. Mengusahakan keterlibatan pegawai dalam pengambilan keputusan (skor 4)<br>C. Mengabaikan saja (skor 1)<br>D. Melakukan apa saja yang dapat dikerjakan utuk membuat pegawai merasa penting dan dilibatkan. (skor 5)<br>E. Mengingatkan pentingnya batas waktu dan tugas kepada atasan. (skor 3) </p>'),
(210, 1, 2, 5, '', '', 'Saya mengajukan suatu usulan untuk atasan saya namun usulan tersebut menurut atasan saya kurang tepat. Sikap saya adalah . ', '<p>Merasa sangat kecewa </p>', '<p>Mencoba mencari alternatif usulan lain yang lebih tepat untuk diajukan lagi </p>', '<p>Merasa kecewa tetapi berusaha melupakan penolakan tersebut </p>', '<p>Bersikeras memberikan alasan dan pembenaran atas usulan tersebut sampai dapat meyakinkan atasan saya .</p>', '<p>Membiarkan saja </p>', '', '', '', '', '', 'A:1,B:5,C:4,D:3,E:2', 1598534349, 1598534349, '3', 1, '<p>A. Merasa sangat kecewa (skor 1)<br>B. Mencoba mencari alternatif usulan lain yang lebih tepat untuk diajukan lagi (5)<br>C. Merasa kecewa tetapi berusaha melupakan penolakan tersebut (skor 4)<br>D. Bersikeras memberikan alasan dan pembenaran atas usulan tersebut sampai dapat meyakinkan atasan saya (skor 3)<br>E. Membiarkan saja (skor 2)</p><p><br></p>'),
(211, 1, 2, 5, '', '', 'Hari ini rekan kerja di kantor Anda ayahnya sakit keras dan rekan anda tak punya biaya untuk membawanya ke Rumah Sakit. ', '<p>Saya menasehatinya untuk lain kali mencari fasilitas Jamkesmas </p>', '<p>Saya menganjurkannya untuk mengikuti asuransi kesehatan </p>', '<p>Saya memberinya bantuan semampu saya </p>', '<p>Saya mengkoordinir rekan-rekan lain untuk turut membantu </p>', '<p>Saya melaporkan kepada atasan tentang hal ini </p>', '', '', '', '', '', 'A:1,B:2,C:4,D:5,E:3', 1598534485, 1598534485, '3', 1, '<p>A. Saya menasehatinya untuk lain kali mencari fasilitas Jamkesmas (skor 1)<br>B. Saya menganjurkannya untuk mengikuti asuransi kesehatan (skor 2)<br>C. Saya memberinya bantuan semampu saya (skor 4)<br>D. Saya mengkoordinir rekan-rekan lain untuk turut membantu (skor 5)<br>E. Saya melaporkan kepada atasan tentang hal ini (skor 3) </p>'),
(212, 1, 2, 5, '', '', 'Ayah sahabat anda mengalami serangan jantung dan masuk Rumah Sakit. ', '<p>Saya percaya dokter RS mampu menangani dengan baik </p>', '<p>Saya akan menjenguknya ketika ada waktu yang benar-benar longgar </p>', '<p>Saya akan menjenguknya </p>', '<p>Saya menanyakan apakah kondisinya memang parah </p>', '<p>Saya berharap semoga lekas sembuh </p>', '', '', '', '', '', 'A:1,B:3,C:5,D:4,E:2', 1598534622, 1598534622, '3', 1, '<p>A. Saya percaya dokter RS mampu menangani dengan baik (skor 1)<br>B. Saya akan menjenguknya ketika ada waktu yang benar-benar longgar (skor 3)<br>C. Saya akan menjenguknya (skor 5)<br>D. Saya menanyakan apakah kondisinya memang parah (skor 4)<br>E. Saya berharap semoga lekas sembuh (skor 2) </p>'),
(213, 1, 2, 5, '', '', 'Saya ditugaskan untuk memimpin tim kerja dengan batas waktu yang sangat ketat. Anggota tim kerja memperlihatkan sikap tidak peduli dengan tugas yang diemban. Sikap saya adalah : ', '<p>Bekerja sendiri yang penting tugas selesai </p>', '<p>Mengancam mengeluarkan anggota yang tidak serius dari tim kerja </p>', '<p>Melaporkan mereka pada pimpinan agar diberi sanksi </p>', '<p>Membagi tugas secara adil dan memotivasi serta menegur anggota untuk menyelesaikannya </p>', '<p>Menasehati mereka agar sadar akan penyelesaian tugas yang diembannya. </p>', '', '', '', '', '', 'A:3,B:2,C:1,D:5,E:4', 1598534810, 1598534810, '3', 1, '<p>A. Bekerja sendiri yang penting tugas selesai (Skor 3)<br>B. Mengancam mengeluarkan anggota yang tidak serius dari tim kerja (Skor 2)<br>C. Melaporkan mereka pada pimpinan agar diberi sanksi (Skor 1)<br>D. Membagi tugas secara adil dan memotivasi serta menegur anggota untuk menyelesaikannya (Skor 5)<br>E. Menasehati mereka agar sadar akan penyelesaian tugas yang diembannya. (Skor 4) </p>'),
(214, 1, 2, 5, '', '', 'Saya dipercayakan mengelola kegiatan yang belum dipublikasikan dan masih harus dijaga keharasiaannya. Ketika saya berada di antara teman teman dekat dikantor, saya&hellip; ', '<p>Suka menerima masukan demi masukan dalam rangka pengembangan tugas baru saya </p>', '<p>Tetap menjaga kerahasiaan meskipun teman-teman mendesak bertanya </p>', '<p>Hanya menceritakan sebagian kecil saja demi pertemanan </p>', '<p>Akan merasa gelisah dan kurang senang bila mereka mulai membicarakan tugas baru saya </p>', '<p>Akan marah jika ditanya tentang tugas baru </p>', '', '', '', '', '', 'A:4,B:5,C:3,D:2,E:1', 1598534898, 1598534898, '3', 1, '<p>A. Suka menerima masukan demi masukan dalam rangka pengembangan tugas baru saya (Skor 4)<br>B. Tetap menjaga kerahasiaan meskipun teman-teman mendesak bertanya (Skor 5)<br>C. Hanya menceritakan sebagian kecil saja demi pertemanan (Skor 3)<br>D. Akan merasa gelisah dan kurang senang bila mereka mulai membicarakan tugas baru saya (Skor 2)<br>E. Akan marah jika ditanya tentang tugas baru (Skor 1) </p>'),
(215, 1, 2, 5, '', '', 'Draft laporan yang dibuat oleh tim kerja saya ditolak oleh atasan karena dianggap kurang layak. Sikap saya adalah &hellip; ', '<p>Segera melakukan perbaikan draft laporan tersebut dan mengajukan kembali </p>', '<p>Menyalahkan rekan sejawat yang sama sama mengerjakannya </p>', '<p>Menerima penolakan tetapi tidak melakukan tindak lanjut </p>', '<p>Berusaha mencari alasan seperti sedikitnya waktu untuk mengerjakannya </p>', '<p>Tidak menerima penolakan tersebut dan berusaha memperbaiki seadanya. </p>', '', '', '', '', '', 'A:5,B:2,C:3,D:1,E:4', 1598535020, 1598535020, '3', 1, '<p>A. Segera melakukan perbaikan draft laporan tersebut dan mengajukan kembali (Skor 5)<br>B. Menyalahkan rekan sejawat yang sama sama mengerjakannya (Skor 2)<br>C. Menerima penolakan tetapi tidak melakukan tindak lanjut (Skor 3)<br>D. Berusaha mencari alasan seperti sedikitnya waktu untuk mengerjakannya (Skor 1)<br>E. Menerima penolakan tersebut dan berusaha memperbaiki seadanya. (Skor 4) </p>'),
(216, 1, 2, 5, '', '', 'Dalam suatu kelompok kerja, biasanya anggota kelompok terdiri dari berbagai latar belakang budaya, dan saya merasa ...', '<p>Sebagian orang menerima saya jika saya dapat mengikuti aturan dalam kelompok. </p>', '<p>Perlu berhati-hati akan apa yang bisa saya katakan atau saya perbuat didalam kelompok kerja. </p>', '<p> Benar-benar aman menjadi diri sendiri, dan saya tidak pernah berkonflik dengan anggota kerja yang lain. </p>', '<p>Tidak pernah menjadi diri sendiri dalam kelompok kerja. </p>', '<p>Tidak cukup berani untuk menjadi diri sendiri dalam kelompok kerja.  </p>', '', '', '', '', '', 'A:4,B:3,C:5,D:1,E:2', 1598535116, 1598535116, '3', 1, '<p>A. Sebagian orang menerima saya jika saya dapat mengikuti aturan dalam kelompok. (skor 4)<br>B. Perlu berhati-hati akan apa yang bisa saya katakan atau saya perbuat didalam kelompok kerja. (skor 3)<br>C. Benar-benar aman menjadi diri sendiri, dan saya tidak pernah berkonflik dengan anggota kerja yang lain. (skor 5)<br>D. Tidak pernah menjadi diri sendiri dalam kelompok kerja. (skor 1)<br>E. Tidak cukup berani untuk menjadi diri sendiri dalam kelompok kerja. (skor 2) </p>'),
(217, 1, 2, 5, '', '', 'Jika dalam suatu rapat, rekan kantor memiliki pendapat yang berbeda, padahal Anda lah yang menjadi pemimpin rapat, maka : ', '<p>Saya teguh mempertahankan pendapat saya </p>', '<p>Beda pendapat bukanlah masalah serius </p>', '<p>Saya pertimbangkan pendapat tersebut </p>', '<p>Melihat dulu siapa dia </p>', '<p>Menanyakan sebab dan alasan pendapatnya tersebut dan mempertimbangkannya jika memang pendapatnya itu ide yang baik. </p>', '', '', '', '', '', 'A:1,B:3,C:4,D:2,E:5', 1598535262, 1598535262, '3', 1, '<p>A. Saya teguh mempertahankan pendapat saya (Skor 1)<br>B. Beda pendapat bukanlah masalah serius (Skor 3)<br>C. Saya pertimbangkan pendapat tersebut (Skor 4)<br>D. Melihat dulu siapa dia (Skor 2)<br>E. Menanyakan sebab dan alasan pendapatnya tersebut dan mempertimbangkannya jika memang pendapatnya itu ide yang baik. (Skor 5) </p>'),
(218, 1, 2, 5, '', '', 'Dalam rapat staf dan pimpinan, pendapat saya dikritik keras oleh peserta rapat lainnya. Respon saya adalah ', '<p>Mencoba sekuat tenaga mempertahankan pendapat saya </p>', '<p>Menyerang semua peserta yang mengeritik pendapat saya </p>', '<p>Mencoba mempelajari kritikan tersebut dan berbalik mengkritik dengan tajam </p>', '<p>Menerima kritikan tersebut sebagai masukan </p>', '<p>Diam saja </p>', '', '', '', '', '', 'A:4,B:1,C:3,D:5,E:2', 1598535333, 1598535333, '3', 1, '<p>A. Mencoba sekuat tenaga mempertahankan pendapat saya (Skor 4)<br>B. Menyerang semua peserta yang mengeritik pendapat saya (Skor 1)<br>C. Mencoba mempelajari kritikan tersebut dan berbalik mengkritik dengan tajam (Skor 3)<br>D. Menerima kritikan tersebut sebagai masukan (Skor 5)<br>E. Diam saja (Skor 2) </p>'),
(219, 1, 2, 5, '', '', 'Saya telah mempersiapkan diri dengan baik sebelum melakukan presentasi di kantor besok pagi. Sikap saya adalah&hellip;. ', '<p>Saya yakin besok presentasi saya berjalan dengan baik, namun saya tetap mempersiapkan dengan maksimal. </p>', '<p>Meski begitu saya cemas kalau-kalau ternyata besok presentasi saya kurang lancar </p>', '<p>Saya pasrah jika ada kendala </p>', '<p>Tak mungkin presentasi saya tidak lancar </p>', '<p>Tapi Mungkin saja presentasi saya terganggu hal lain </p>', '', '', '', '', '', 'A:5,B:1,C:3,D:2,E:4', 1598536379, 1598536379, '3', 1, '<p>A. Saya yakin besok presentasi saya berjalan dengan baik, namun saya tetap mempersiapkan dengan maksimal. (Skor 5)<br>B. Meski begitu saya cemas kalau-kalau ternyata besok presentasi saya kurang lancar (Skor 1)<br>C. Saya pasrah jika ada kendala (Skor 3)<br>D. Tak mungkin presentasi saya tidak lancar (Skor 2)<br>E. Tapi Mungkin saja presentasi saya terganggu hal lain (Skor 4) </p>'),
(220, 1, 2, 5, '', '', 'Dalam setiap pekerjaan pasti memiliki job description masing-masing, dan saya telah melakukan sesuai dengan job description tersebut. Kinerja saya adalah ...', '<p>Ditengah-tengah kesibukan pekerjaan, saya tetap mau membantu teman menyelesaikan pekerjaannya yang tertunda </p>', '<p>Saya akan membantu kawan saya yang lain jika diminta. </p>', '<p>Saya mau mempelajari hal lain diluar deskripsi jabatan saya. </p>', '<p>Saya hanya akan melakukan pekerjaan diluar deskripsi jabatan jika diminta oleh atasan. </p>', '<p>Enggan berkontribusi lebih dari apa yang telah dikerjakan saat ini. </p>', '', '', '', '', '', 'A:5,B:4,C:3,D:2,E:1', 1598536491, 1598536491, '3', 1, '<p>A. Ditengah-tengah kesibukan pekerjaan, saya tetap mau membantu teman menyelesaikan pekerjaannya yang tertunda (skor 5)<br>B. Saya akan membantu kawan saya yang lain jika diminta. (skor 4)<br>C. Saya mau mempelajari hal lain diluar deskripsi jabatan saya. (skor 3)<br>D. Saya hanya akan melakukan pekerjaan diluar deskripsi jabatan jika diminta oleh atasan. (skor 2)<br>E. Enggan berkontribusi lebih dari apa yang telah dikerjakan saat ini. (skor 1) </p>'),
(221, 1, 2, 5, '', '', 'Bila ada rekan kerja yang salah memanggil nama saya, apa yang akan saya lakukan ...', '<p>Saya sedikit tersinggung, karena nama adalah kehormatan seseorang </p>', '<p>Saya tak boleh tersinggung </p>', '<p>Saya mengingatkannya dengan baik-baik </p>', '<p> Saya mengingatkannya dengan keras agar tidak diulang </p>', '<p>Itu tidak menjadi masalah </p>', '', '', '', '', '', 'A:2,B:3,C:5,D:2,E:1', 1598536685, 1598536685, '3', 1, '<p>A. Saya sedikit tersinggung, karena nama adalah kehormatan seseorang (skor 2)<br>B. Saya tak boleh tersinggung (skor 3)<br>C. Saya mengingatkannya dengan baik-baik (skor 5)<br>D. Saya mengingatkannya dengan keras agar tidak diulang (skor 2)<br>E. Itu tidak menjadi masalah (skor 4) </p>'),
(222, 1, 2, 5, '', '', 'Reko kali ini lupa belum mengembalikan bolpoin yang dipinjamnya, yang saya lakukan adalah ...', '<p>Saya akan menegurnya dengan keras agar tidak terulang lagi </p>', '<p>Saya membiarkannya terlebih dulu sebab ini yang pertama kalinya dia lupa </p>', '<p>Saya mengikhlaskan bolpoin tersebut, toh harganya murah </p>', '<p>Saya mengingatkannya </p>', '<p>Saya menyindirnya agar ingat kelalaiannya </p>', '', '', '', '', '', 'A:2,B:1,C:3,D:5,E:4', 1598536778, 1598536778, '3', 1, '<p>A. Saya akan menegurnya dengan keras agar tidak terulang lagi (skor 2)<br>B. Saya membiarkannya terlebih dulu sebab ini yang pertama kalinya dia lupa (skor 1)<br>C. Saya mengikhlaskan bolpoin tersebut, toh harganya murah (skor 3)<br>D. Saya mengingatkannya (skor 5)<br>E. Saya menyindirnya agar ingat kelalaiannya (skor 4) </p>');
INSERT INTO `tb_soal` (`id_soal`, `dosen_id`, `matkul_id`, `bobot`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `file_a`, `file_b`, `file_c`, `file_d`, `file_e`, `jawaban`, `created_on`, `updated_on`, `tipe`, `id_ujian`, `pembahasan`) VALUES
(223, 1, 2, 5, '', '', 'Di lingkungan kerja saya yang baru, yang harus saya lakukan adalah ...', '<p>Saya perlu waktu untuk mengenal rekan-rekan kerja </p>', '<p>Saya menunggu rekan kerja yang ingin berkenalan </p>', '<p>Saya langsung mampu akrab dengan rekan kerja </p>', '<p>Jika saya membutuhkan bantuan baru saya akan berkenalan </p>', '<p> Jika ada yang ingin berkenalan tentunya saya senang sekali </p>', '', '', '', '', '', 'A:3,B:2,C:5,D:1,E:4', 1598537243, 1598537243, '3', 1, '<p>A. Saya perlu waktu untuk mengenal rekan-rekan kerja (skor 3)<br>B. Saya menunggu rekan kerja yang ingin berkenalan (skor 2)<br>C. Saya langsung mampu akrab dengan rekan kerja (skor 5)<br>D. Jika saya membutuhkan bantuan baru saya akan berkenalan (skor 1)<br>E. Jika ada yang ingin berkenalan tentunya saya senang sekali (skor 4) </p>'),
(224, 1, 2, 5, '', '', 'Berpindah-pindah pekerjaan adalah hal yang wajar ...', '<p>Saya tidak berpendapat bahwa karyawan harus setia terhadap perusahaannya </p>', '<p>Saya meyakini nilai-nilai yang mengatakan bahwa loyalitas terhadap pekerjaan adalah sikap yang terpuji </p>', '<p>Pekerjaan saya saat ini tidak dapat menjamin masa depan saya. </p>', '<p>Saya meyakini bahwa loyalitas itu penting, sehingga saya merasakan pentingnya tanggung jawab moral karyawan. </p>', '<p>Saya menyukai pekerjaan saya, tetapi jika ada pekerjaan yang lebih baik saya tidak ragu untuk pindah </p>', '', '', '', '', '', 'A:1,B:4,C:2,D:3,E:5', 1598537450, 1598537450, '3', 1, '<p>A. Saya tidak berpendapat bahwa karyawan harus setia terhadap perusahaanny (skor 1)<br>B. Saya meyakini nilai-nilai yang mengatakan bahwa loyalitas terhadap pekerjaan adalah sikap yang terpuji. (skor 4)<br>C. Pekerjaan saya saat ini tidak dapat menjamin masa depan saya. (skor 2)<br>D. Saya meyakini bahwa loyalitas itu penting, sehingga saya merasakan pentingnya tanggung jawab moral karyawan. (skor 3)<br>E. Saya menyukai pekerjaan saya, tetapi jika ada pekerjaan yang lebih baik saya tidak ragu untuk pindah (skor 5) </p>'),
(225, 1, 2, 5, '', '', 'Setiap hari, saya masuk kantor paling cepat dibandingkan pegawai lainnya. Yang saya lakukan setelah tiba adalah ...', '<p>Masuk ke ruangan dan membaca koran </p>', '<p>Santai di luar gedung kantor untuk menikmati udara pagi </p>', '<p>Masuk ke ruangan dan mengobrol dengan rekan sejawat </p>', '<p>Masuk ke ruangan dan membuat rencana kerja </p>', '<p>Masuk ke ruangan dan memulai pekerjaan yang tertunda kemarin. </p>', '', '', '', '', '', 'A:3,B:1,C:2,D:4,E:5', 1598537768, 1598537768, '3', 1, '<p>A. Masuk ke ruangan dan membaca koran (skor 3)<br>B. Santai di luar gedung kantor untuk menikmati udara pagi (skor 1)<br>C. Masuk ke ruangan dan mengobrol dengan rekan sejawat (skor 2)<br>D. Masuk ke ruangan dan membuat rencana kerja (skor 4)<br>E. Masuk ke ruangan dan memulai pekerjaan yang tertunda kemarin. (skor 5) </p>'),
(226, 1, 2, 5, '', '', 'Saya diminta untuk lembur kerja sedangkan saya sudah berjanji kepada anak saya untuk mengantarnya ke pesta ulang tahun sahabatnya. Sikap saya..', '<p>Pulang dengan diam diam, tanpa sepengetahuan pimpinan </p>', '<p>Berpura pura sakit agar dapat diizinkan untuk segera pulang </p>', '<p>Menghubungi anak saya menjelaskan agar naik taksi saja </p>', '<p>Bekerja lembur, karena yakin anak saya pasti memaklumi </p>', '<p>Meminta izin pimpinan mengantar anak saya kemudian kembali ke kantor untuk bekerja lembur </p>', '', '', '', '', '', 'A:1,B:2,C:4,D:3,E:5', 1598537884, 1598537884, '3', 1, '<p>A. Pulang dengan diam diam, tanpa sepengetahuan pimpinan (skor 1)<br>B. Berpura pura sakit agar dapat diizinkan untuk segera pulang (skor 2)<br>C. Menghubungi anak saya menjelaskan agar naik taksi saja (skor 4)<br>D. Bekerja lembur, karena yakin anak saya pasti memaklumi (skor 3)<br>E. Meminta izin pimpinan mengantar anak saya kemudian kembali ke kantor untuk bekerja lembur (skor 5) </p>'),
(227, 1, 2, 5, '', '', 'Atasan anda menetapkan target tugas harus selesai pada deadline tanggal 27 bulan ini, maka ', '<p>Saya akan selesaikan tepat pada tanggal 27 </p>', '<p>Kalau tugas lain menumpuk, saya akan minta ijin untuk menyelesaikan barang satu atau dua hari sesudah deadline </p>', '<p>Saya mencoba menyelesaikan tanggal 26 jika memungkinkan </p>', '<p>Saya meminta tolong rekan lain agar tidak terlambat deadline </p>', '<p>Saya menegosiasikan deadline yang ditetapkan atasan tersebut dengan baikbaik agar tidak terlalu memberatkan </p>', '', '', '', '', '', 'A:5,B:1,C:4,D:3,E:2', 1598538136, 1598538136, '3', 1, '<p>A. Saya akan selesaikan tepat pada tanggal 27 (skor 5)<br>B. Kalau tugas lain menumpuk, saya akan minta ijin untuk menyelesaikan barang satu atau dua hari sesudah deadline (skor 1)<br>C. Saya mencoba menyelesaikan tanggal 26 jika memungkinkan (skor 4)<br>D. Saya meminta tolong rekan lain agar tidak terlambat deadline (skor 3)<br>E. Saya menegosiasikan deadline yang ditetapkan atasan tersebut dengan baikbaik agar tidak terlalu memberatkan (skor 2) </p>'),
(228, 1, 2, 5, '', '', 'Bulan depan ada kesempatan untuk ikut kompetisi dalam bidang yang saya senangi, maka saya ', '<p>Tidak ikut kompetisi </p>', '<p>Mempersiapkan diri guna memenangkan persaingan </p>', '<p>Ikut jika ada kemungkinan saya menang. </p>', '<p> Tidak ikut saja daripada kalah </p>', '<p>Saya ikut, karena saya pasti memenangkan persaingan </p>', '', '', '', '', '', 'A:2,B:5,C:3,D:1,E:4', 1598538234, 1598538234, '3', 1, '<p>A. Tidak ikut kompetisi (skor 2)<br>B. Mempersiapkan diri guna memenangkan persaingan (skor 5)<br>C. Ikut jika ada kemungkinan saya menang. (skor 3)<br>D. Tidak ikut saja daripada kalah (skor 1)<br>E. Saya ikut, karena saya pasti memenangkan persaingan (skor 4) </p>'),
(229, 1, 2, 5, '', '', 'Hampir semua pegawai di kantor instansi saya meminta uang tanda terimakasih atas pengurusan surat ijin tertentu. Namun menurut peraturan kantor, hal itu tidaklah diperbolehkan, maka saya ...', '<p>Ikut melakukannya karena bagaimanapun juga kawan-kawan kantor juga melakukannya </p>', '<p>Melakukannya hanya jika terpaksa membutuhkan uang tambahan untuk keperluan keluarga, sebab gaji kantor memang kecil </p>', '<p>Terkadang saja melakukan hal tersebut </p>', '<p>Berusaha semampunya untuk tidak melakukannya </p>', '<p>Tidak ingin melakukannya sama sekali. </p>', '', '', '', '', '', 'A:1,B:2,C:3,D:4,E:5', 1598538380, 1598538380, '3', 1, '<p>A. Ikut melakukannya karena bagaimanapun juga kawan-kawan kantor juga melakukannya (skor 1)<br>B. Melakukannya hanya jika terpaksa membutuhkan uang tambahan untuk keperluan keluarga, sebab gaji kantor memang kecil (skor 2)<br>C. Terkadang saja melakukan hal tersebut (skor 3)<br>D. Berusaha semampunya untuk tidak melakukannya (skor 4)<br>E. Tidak ingin melakukannya sama sekali. (skor 5) </p>'),
(230, 1, 2, 5, '', '', 'Anda adalah seorang karyawan apotek. Seorang pembeli ingin membeli obatobatan tertentu yang harus menggunakan resep dokter karena bisa membahayakan kesehatan. Dia tidak mempunyai resep itu. Namun pembeli tersebut memaksa ingin membelinya dan dia memberikan sejumlah uang kepada Anda agar mau memberikan obat tersebut. Apa yang Anda lakukan ? ', '<p>Saya memberikan obat tersebut kepadanya, toh tak ada yang tahu </p>', '<p>Saya ragu-ragu keputusan apa yang saya ambil </p>', '<p>Saya berkonsultasi kepada rekan sejawat dulu </p>', '<p>Saya menolaknya dengan mantap </p>', '<p>Saya menerima uang tersebut dan memberikan obatnya </p>', '', '', '', '', '', 'A:1,B:3,C:4,D:5,E:2', 1598538456, 1598538456, '3', 1, '<p>A. Saya memberikan obat tersebut kepadanya, toh tak ada yang tahu (skor 1)<br>B. Saya ragu-ragu keputusan apa yang saya ambil (skor 3)<br>C. Saya berkonsultasi kepada rekan sejawat dulu (skor 4)<br>D. Saya menolaknya dengan mantap (skor 5)<br>E. Saya menerima uang tersebut dan memberikan obatnya (skor 2) </p>'),
(231, 1, 2, 5, '', '', 'Atasan Anda melakukan rekayasa laporan keuangan kantor, maka Anda ', '<p> Dalam hati tidak menyetujui hal tersebut </p>', '<p>Hal tersebut sering terjadi di kantor manapun </p>', '<p>Mengingatkan dan melaporkan kepada yang berwenang </p>', '<p>Tidak ingin terlibat dalam proses rekayasa tersebut </p>', '<p>Hal semacam itu memang sudah menjadi tradisi yang tidak baik di Indonesia </p>', '', '', '', '', '', 'A:3,B:1,C:4,D:5,E:2', 1598538527, 1598538527, '3', 1, '<p>A. Dalam hati tidak menyetujui hal tersebut (skor 3)<br>B. Hal tersebut sering terjadi di kantor manapun (skor 1)<br>C. Mengingatkan dan melaporkan kepada yang berwenang (skor 4)<br>D. Tidak ingin terlibat dalam proses rekayasa tersebut (skor 5)<br>E. Hal semacam itu memang sudah menjadi tradisi yang tidak baik di Indonesia (skor 2) </p>'),
(232, 1, 2, 5, '', '', 'Setelah mematangkan rencana, Sikap saya adalah..', '<p>Saya masih khawatir apakah rencana tersebut bisa berhasil </p>', '<p>Berhasil tidaknya tak lepas dari pihak lain juga </p>', '<p>Manusia berusaha sebaik-baiknya dan Tuhan yang menentukan </p>', '<p>Bagaimanapun caranya rencana harus berhasil </p>', '<p>Saya minta pendapat orang lain terlebih dulu, sebab pendapat banyak orang lebih baik daripada pendapat satu orang </p>', '', '', '', '', '', 'A:1,B:3,C:5,D:2,E:4', 1598538635, 1598538635, '3', 1, '<p>A. Saya masih khawatir apakah rencana tersebut bisa berhasil (Skor 1)<br>B. Berhasil tidaknya tak lepas dari pihak lain juga (Skor 3)<br>C. Manusia berusaha sebaik-baiknya dan Tuhan yang menentukan (Skor 5)<br>D. Bagaimanapun caranya rencana harus berhasil (Skor 2)<br>E. Saya minta pendapat orang lain terlebih dulu, sebab pendapat banyak orang lebih baik daripada pendapat satu orang (Skor 4) </p>'),
(233, 1, 2, 5, '', '', 'Saya baru saja dimutasikan ke unit lain yang sama sekali baru bagi saya. Sikap saya adalah...', '<p>Berusaha memahami mekanisme kerja unit melalui arsip dan aturan kebijakan</p>', '<p>Jarang masuk karena belum jelas apa yang harus dikerjakan</p>', '<p>Duduk duduk saja sambil menunggu perintah atasan</p>', '<p>Berusaha mempelajari dan memahami mekanisme kerja unit melalui rekan sejawat</p>', '<p>Mengamati proses pekerjaan yang dilakukan rekan sejawat</p>', '', '', '', '', '', 'A:4,B:1,C:2,D:5,E:3', 1598538704, 1598538763, '3', 1, '<p>A. Berusaha memahami mekanisme kerja unit melalui arsip dan aturan kebijakan (skor 4)<br>B. Jarang masuk karena belum jelas apa yang harus dikerjakan (skor 1)<br>C. Duduk duduk saja sambil menunggu perintah atasan (skor 2)<br>D. Berusaha mempelajari dan memahami mekanisme kerja unit melalui rekan sejawat (skor 5)<br>E. Mengamati proses pekerjaan yang dilakukan rekan sejawat (skor 3)</p>'),
(234, 1, 2, 5, '567b51fff96efca6767485c9e8592799.png', 'image/png', 'abcd', '<p>aaa</p>', '<p>bbb</p>', '<p>ccc</p>', '<p>ddd</p>', '<p>eee</p>', '', '', '', '', '', 'B', 1605875685, 1607702511, '1', 4, '<p>ppp</p>');

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
(1, '127.0.0.1', 'Administrator', '$2y$12$CHD8TezvDMZd2mf.HML9nONJuNJbSFXAQTvE9ToMN0Q45P5g4RiQu', 'info@bimbelcpnsonline.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1607587247, 1, 'Admin', NULL, 'ADMIN', NULL),
(2, '::1', 'copycut7@gmail.com', '$2y$10$qRRyvunZBLGVqitN0RmmG.U2zpdgw2u.el8gVzMGLAnGBuM5rhEIi', 'copycut7@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1595513249, 1607702532, 1, 'sugik', 'sugik', NULL, NULL),
(3, '::1', '12345678', '$2y$10$QaXdAWQ9YqWCA6kTMcB7iujot5bL74C7vBN0aCE5YjX4DaX39zQJK', 'irawati@email.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1595555735, 1607701303, 1, 'irawati', 'irawati', NULL, NULL),
(5, '::1', 'arfan@email.com', '$2y$10$6fguq2QrChRdomxkc.8tpexB54IE67k/1yWM39RoTAUDgItX90Som', 'arfan@email.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1598020980, 1598585120, 1, 'arfan', 'arfan', NULL, NULL),
(6, '36.90.186.21', 'irawatirsmw@gmail.co', '$2y$10$qackJ7HY.p4iutCZJz7hd.LPSaUNnKn/aq8Zog6Uk4/FOleCbKcp.', 'irawatirsmw@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1606360917, NULL, 1, 'Wati', 'Wati', NULL, NULL),
(7, '36.90.171.3', 'irawati01101988@gmail.com', '$2y$10$teBO38X058RKt0QI6lpzhuVEn9TepI7Kn3TzLrIJPYaFZ5SAcjGXC', 'irawati01101988@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1607241424, 1607480019, 1, 'Wati', 'Wati', NULL, NULL);

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
(36, 2, 3),
(37, 3, 2),
(39, 5, 3),
(40, 6, 3),
(41, 7, 3),
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

CREATE ALGORITHM=UNDEFINED DEFINER=`bimbelcp_bimbelcpnsonline`@`%` SQL SECURITY DEFINER VIEW `dashboard_peserta`  AS  select `h_ujian`.`id` AS `id`,`h_ujian`.`mahasiswa_id` AS `mahasiswa_id`,'' AS `box`,`h_ujian`.`nilai_bobot` AS `total`,`m_ujian`.`nama_ujian` AS `title`,'' AS `icon`,'' AS `url`,`m_ujian`.`matkul_id` AS `matkul_id` from (((`h_ujian` join `mahasiswa` on(`h_ujian`.`mahasiswa_id` = `mahasiswa`.`id_mahasiswa`)) join `kelas` on(`mahasiswa`.`kelas_id` = `kelas`.`id_kelas`)) join `m_ujian` on(`h_ujian`.`ujian_id` = `m_ujian`.`id_ujian`)) ;

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
  ADD UNIQUE KEY `angka_unik` (`angka_unik`) USING BTREE,
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
-- Indexes for table `pertanyaan_detail`
--
ALTER TABLE `pertanyaan_detail`
  ADD PRIMARY KEY (`id_pertanyaan`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_dokumen`
--
ALTER TABLE `m_dokumen`
  MODIFY `id_dokumen` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `m_ujian`
--
ALTER TABLE `m_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pertanyaan_detail`
--
ALTER TABLE `pertanyaan_detail`
  MODIFY `id_pertanyaan` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
