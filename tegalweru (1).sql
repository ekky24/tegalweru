-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2018 at 11:51 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tegalweru`
--

-- --------------------------------------------------------

--
-- Table structure for table `agamas`
--

CREATE TABLE `agamas` (
  `id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agamas`
--

INSERT INTO `agamas` (`id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'ISLAM', '2018-04-04 12:18:27', '2018-04-04 12:18:27'),
(2, 'KRISTEN', '2018-04-04 12:18:27', '2018-04-04 12:18:27'),
(3, 'KATOLIK', '2018-04-04 12:18:27', '2018-04-04 12:18:27'),
(4, 'HINDU', '2018-04-04 12:18:28', '2018-04-04 12:18:28'),
(5, 'BUDDHA', '2018-04-04 12:18:28', '2018-04-04 12:18:28'),
(6, 'KHONGHUCU', '2018-04-04 12:18:28', '2018-04-04 12:18:28'),
(7, 'KEPERCAYAAN', '2018-04-04 12:18:28', '2018-04-04 12:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pekerjaans`
--

CREATE TABLE `jenis_pekerjaans` (
  `id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_pekerjaans`
--

INSERT INTO `jenis_pekerjaans` (`id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'BELUM/TIDAK BEKERJA', '2018-04-04 12:18:29', '2018-04-04 12:18:29'),
(2, 'MENGURUS RUMAH TANGGA', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(3, 'PELAJAR/MAHASISWA', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(4, 'PENSIUNAN', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(5, 'PEGAWAI NEGERI SIPIL (PNs)', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(6, 'TENTARA NASIONAL INDONESIA (TNI)', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(7, 'KEPOLISIAN RI (POLRI)', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(8, 'PERDAGANGAN', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(9, 'PETANI/PERKEBUNAN', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(10, 'PETERNAK', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(11, 'NELAYAN/PERIKANAN', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(12, 'INDUSTRI', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(13, 'KONSTRUKSI', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(14, 'TRANSPORTASI', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(15, 'KARYAWAN SWASTA', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(16, 'KARYAWAN BUMN', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(17, 'KARYAWAN BUMD', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(18, 'KARYAWAN HONORER', '2018-04-04 12:18:30', '2018-04-04 12:18:30'),
(19, 'BURUH HARIAN LEPAS', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(20, 'BURUH TANI/PERKEBUNAN', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(21, 'BURUH NELAYAN/PERIKANAN', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(22, 'BURUH PETERNAKAN', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(23, 'PEMBANTU RUMAH TANGGA', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(24, 'TUKANG CUKUR', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(25, 'TUKANG LISTRIK', '2018-04-04 12:18:31', '2018-04-04 12:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `kartu_keluargas`
--

CREATE TABLE `kartu_keluargas` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepala_keluarga` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rukun_tetangga` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rukun_warga` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_terbit` date NOT NULL,
  `penerbit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kartu_keluargas`
--

INSERT INTO `kartu_keluargas` (`id`, `kepala_keluarga`, `alamat`, `rukun_tetangga`, `rukun_warga`, `kelurahan`, `kode_pos`, `tgl_terbit`, `penerbit`, `created_at`, `updated_at`) VALUES
('3425245245252451', '3573082819293719', 'GUNUNG RINJANI MALANG', '3', '1', '3507300006', '65151', '2018-05-31', 'YULIANTO', '2018-03-21 23:33:59', '2018-05-01 05:22:46'),
('3425245245253310', NULL, 'KLOJEN MALANG', '5', '2', '3507300006', '65151', '2018-03-05', 'SAMSUDIN', '2018-03-21 23:38:13', '2018-05-16 07:41:50');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `kota_id`, `nama`) VALUES
('3507300', '3507', 'DAU');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahans`
--

CREATE TABLE `kelurahans` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelurahans`
--

INSERT INTO `kelurahans` (`id`, `kecamatan_id`, `nama`) VALUES
('3507300006', '3507300', 'TEGALWERU');

-- --------------------------------------------------------

--
-- Table structure for table `kematians`
--

CREATE TABLE `kematians` (
  `penduduk_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_kematian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_kematian` datetime NOT NULL,
  `tempat_pemakaman` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kematians`
--

INSERT INTO `kematians` (`penduduk_id`, `tempat_kematian`, `waktu_kematian`, `tempat_pemakaman`, `created_at`, `updated_at`) VALUES
('3425245245245245', 'MALANG', '2018-05-05 01:03:00', 'MALANG', '2018-04-07 21:14:54', '2018-05-01 05:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `kotas`
--

CREATE TABLE `kotas` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kotas`
--

INSERT INTO `kotas` (`id`, `provinsi_id`, `nama`) VALUES
('1101', '11', 'KABUPATEN SIMEULUE'),
('1102', '11', 'KABUPATEN ACEH SINGKIL'),
('1103', '11', 'KABUPATEN ACEH SELATAN'),
('1104', '11', 'KABUPATEN ACEH TENGGARA'),
('1105', '11', 'KABUPATEN ACEH TIMUR'),
('1106', '11', 'KABUPATEN ACEH TENGAH'),
('1107', '11', 'KABUPATEN ACEH BARAT'),
('1108', '11', 'KABUPATEN ACEH BESAR'),
('1109', '11', 'KABUPATEN PIDIE'),
('1110', '11', 'KABUPATEN BIREUEN'),
('1111', '11', 'KABUPATEN ACEH UTARA'),
('1112', '11', 'KABUPATEN ACEH BARAT DAYA'),
('1113', '11', 'KABUPATEN GAYO LUES'),
('1114', '11', 'KABUPATEN ACEH TAMIANG'),
('1115', '11', 'KABUPATEN NAGAN RAYA'),
('1116', '11', 'KABUPATEN ACEH JAYA'),
('1117', '11', 'KABUPATEN BENER MERIAH'),
('1118', '11', 'KABUPATEN PIDIE JAYA'),
('1171', '11', 'KOTA BANDA ACEH'),
('1172', '11', 'KOTA SABANG'),
('1173', '11', 'KOTA LANGSA'),
('1174', '11', 'KOTA LHOKSEUMAWE'),
('1175', '11', 'KOTA SUBULUSSALAM'),
('1201', '12', 'KABUPATEN NIAS'),
('1202', '12', 'KABUPATEN MANDAILING NATAL'),
('1203', '12', 'KABUPATEN TAPANULI SELATAN'),
('1204', '12', 'KABUPATEN TAPANULI TENGAH'),
('1205', '12', 'KABUPATEN TAPANULI UTARA'),
('1206', '12', 'KABUPATEN TOBA SAMOSIR'),
('1207', '12', 'KABUPATEN LABUHAN BATU'),
('1208', '12', 'KABUPATEN ASAHAN'),
('1209', '12', 'KABUPATEN SIMALUNGUN'),
('1210', '12', 'KABUPATEN DAIRI'),
('1211', '12', 'KABUPATEN KARO'),
('1212', '12', 'KABUPATEN DELI SERDANG'),
('1213', '12', 'KABUPATEN LANGKAT'),
('1214', '12', 'KABUPATEN NIAS SELATAN'),
('1215', '12', 'KABUPATEN HUMBANG HASUNDUTAN'),
('1216', '12', 'KABUPATEN PAKPAK BHARAT'),
('1217', '12', 'KABUPATEN SAMOSIR'),
('1218', '12', 'KABUPATEN SERDANG BEDAGAI'),
('1219', '12', 'KABUPATEN BATU BARA'),
('1220', '12', 'KABUPATEN PADANG LAWAS UTARA'),
('1221', '12', 'KABUPATEN PADANG LAWAS'),
('1222', '12', 'KABUPATEN LABUHAN BATU SELATAN'),
('1223', '12', 'KABUPATEN LABUHAN BATU UTARA'),
('1224', '12', 'KABUPATEN NIAS UTARA'),
('1225', '12', 'KABUPATEN NIAS BARAT'),
('1271', '12', 'KOTA SIBOLGA'),
('1272', '12', 'KOTA TANJUNG BALAI'),
('1273', '12', 'KOTA PEMATANG SIANTAR'),
('1274', '12', 'KOTA TEBING TINGGI'),
('1275', '12', 'KOTA MEDAN'),
('1276', '12', 'KOTA BINJAI'),
('1277', '12', 'KOTA PADANGSIDIMPUAN'),
('1278', '12', 'KOTA GUNUNGSITOLI'),
('1301', '13', 'KABUPATEN KEPULAUAN MENTAWAI'),
('1302', '13', 'KABUPATEN PESISIR SELATAN'),
('1303', '13', 'KABUPATEN SOLOK'),
('1304', '13', 'KABUPATEN SIJUNJUNG'),
('1305', '13', 'KABUPATEN TANAH DATAR'),
('1306', '13', 'KABUPATEN PADANG PARIAMAN'),
('1307', '13', 'KABUPATEN AGAM'),
('1308', '13', 'KABUPATEN LIMA PULUH KOTA'),
('1309', '13', 'KABUPATEN PASAMAN'),
('1310', '13', 'KABUPATEN SOLOK SELATAN'),
('1311', '13', 'KABUPATEN DHARMASRAYA'),
('1312', '13', 'KABUPATEN PASAMAN BARAT'),
('1371', '13', 'KOTA PADANG'),
('1372', '13', 'KOTA SOLOK'),
('1373', '13', 'KOTA SAWAH LUNTO'),
('1374', '13', 'KOTA PADANG PANJANG'),
('1375', '13', 'KOTA BUKITTINGGI'),
('1376', '13', 'KOTA PAYAKUMBUH'),
('1377', '13', 'KOTA PARIAMAN'),
('1401', '14', 'KABUPATEN KUANTAN SINGINGI'),
('1402', '14', 'KABUPATEN INDRAGIRI HULU'),
('1403', '14', 'KABUPATEN INDRAGIRI HILIR'),
('1404', '14', 'KABUPATEN PELALAWAN'),
('1405', '14', 'KABUPATEN S I A K'),
('1406', '14', 'KABUPATEN KAMPAR'),
('1407', '14', 'KABUPATEN ROKAN HULU'),
('1408', '14', 'KABUPATEN BENGKALIS'),
('1409', '14', 'KABUPATEN ROKAN HILIR'),
('1410', '14', 'KABUPATEN KEPULAUAN MERANTI'),
('1471', '14', 'KOTA PEKANBARU'),
('1473', '14', 'KOTA D U M A I'),
('1501', '15', 'KABUPATEN KERINCI'),
('1502', '15', 'KABUPATEN MERANGIN'),
('1503', '15', 'KABUPATEN SAROLANGUN'),
('1504', '15', 'KABUPATEN BATANG HARI'),
('1505', '15', 'KABUPATEN MUARO JAMBI'),
('1506', '15', 'KABUPATEN TANJUNG JABUNG TIMUR'),
('1507', '15', 'KABUPATEN TANJUNG JABUNG BARAT'),
('1508', '15', 'KABUPATEN TEBO'),
('1509', '15', 'KABUPATEN BUNGO'),
('1571', '15', 'KOTA JAMBI'),
('1572', '15', 'KOTA SUNGAI PENUH'),
('1601', '16', 'KABUPATEN OGAN KOMERING ULU'),
('1602', '16', 'KABUPATEN OGAN KOMERING ILIR'),
('1603', '16', 'KABUPATEN MUARA ENIM'),
('1604', '16', 'KABUPATEN LAHAT'),
('1605', '16', 'KABUPATEN MUSI RAWAS'),
('1606', '16', 'KABUPATEN MUSI BANYUASIN'),
('1607', '16', 'KABUPATEN BANYU ASIN'),
('1608', '16', 'KABUPATEN OGAN KOMERING ULU SELATAN'),
('1609', '16', 'KABUPATEN OGAN KOMERING ULU TIMUR'),
('1610', '16', 'KABUPATEN OGAN ILIR'),
('1611', '16', 'KABUPATEN EMPAT LAWANG'),
('1612', '16', 'KABUPATEN PENUKAL ABAB LEMATANG ILIR'),
('1613', '16', 'KABUPATEN MUSI RAWAS UTARA'),
('1671', '16', 'KOTA PALEMBANG'),
('1672', '16', 'KOTA PRABUMULIH'),
('1673', '16', 'KOTA PAGAR ALAM'),
('1674', '16', 'KOTA LUBUKLINGGAU'),
('1701', '17', 'KABUPATEN BENGKULU SELATAN'),
('1702', '17', 'KABUPATEN REJANG LEBONG'),
('1703', '17', 'KABUPATEN BENGKULU UTARA'),
('1704', '17', 'KABUPATEN KAUR'),
('1705', '17', 'KABUPATEN SELUMA'),
('1706', '17', 'KABUPATEN MUKOMUKO'),
('1707', '17', 'KABUPATEN LEBONG'),
('1708', '17', 'KABUPATEN KEPAHIANG'),
('1709', '17', 'KABUPATEN BENGKULU TENGAH'),
('1771', '17', 'KOTA BENGKULU'),
('1801', '18', 'KABUPATEN LAMPUNG BARAT'),
('1802', '18', 'KABUPATEN TANGGAMUS'),
('1803', '18', 'KABUPATEN LAMPUNG SELATAN'),
('1804', '18', 'KABUPATEN LAMPUNG TIMUR'),
('1805', '18', 'KABUPATEN LAMPUNG TENGAH'),
('1806', '18', 'KABUPATEN LAMPUNG UTARA'),
('1807', '18', 'KABUPATEN WAY KANAN'),
('1808', '18', 'KABUPATEN TULANGBAWANG'),
('1809', '18', 'KABUPATEN PESAWARAN'),
('1810', '18', 'KABUPATEN PRINGSEWU'),
('1811', '18', 'KABUPATEN MESUJI'),
('1812', '18', 'KABUPATEN TULANG BAWANG BARAT'),
('1813', '18', 'KABUPATEN PESISIR BARAT'),
('1871', '18', 'KOTA BANDAR LAMPUNG'),
('1872', '18', 'KOTA METRO'),
('1901', '19', 'KABUPATEN BANGKA'),
('1902', '19', 'KABUPATEN BELITUNG'),
('1903', '19', 'KABUPATEN BANGKA BARAT'),
('1904', '19', 'KABUPATEN BANGKA TENGAH'),
('1905', '19', 'KABUPATEN BANGKA SELATAN'),
('1906', '19', 'KABUPATEN BELITUNG TIMUR'),
('1971', '19', 'KOTA PANGKAL PINANG'),
('2101', '21', 'KABUPATEN KARIMUN'),
('2102', '21', 'KABUPATEN BINTAN'),
('2103', '21', 'KABUPATEN NATUNA'),
('2104', '21', 'KABUPATEN LINGGA'),
('2105', '21', 'KABUPATEN KEPULAUAN ANAMBAS'),
('2171', '21', 'KOTA B A T A M'),
('2172', '21', 'KOTA TANJUNG PINANG'),
('3101', '31', 'KABUPATEN KEPULAUAN SERIBU'),
('3171', '31', 'KOTA JAKARTA SELATAN'),
('3172', '31', 'KOTA JAKARTA TIMUR'),
('3173', '31', 'KOTA JAKARTA PUSAT'),
('3174', '31', 'KOTA JAKARTA BARAT'),
('3175', '31', 'KOTA JAKARTA UTARA'),
('3201', '32', 'KABUPATEN BOGOR'),
('3202', '32', 'KABUPATEN SUKABUMI'),
('3203', '32', 'KABUPATEN CIANJUR'),
('3204', '32', 'KABUPATEN BANDUNG'),
('3205', '32', 'KABUPATEN GARUT'),
('3206', '32', 'KABUPATEN TASIKMALAYA'),
('3207', '32', 'KABUPATEN CIAMIS'),
('3208', '32', 'KABUPATEN KUNINGAN'),
('3209', '32', 'KABUPATEN CIREBON'),
('3210', '32', 'KABUPATEN MAJALENGKA'),
('3211', '32', 'KABUPATEN SUMEDANG'),
('3212', '32', 'KABUPATEN INDRAMAYU'),
('3213', '32', 'KABUPATEN SUBANG'),
('3214', '32', 'KABUPATEN PURWAKARTA'),
('3215', '32', 'KABUPATEN KARAWANG'),
('3216', '32', 'KABUPATEN BEKASI'),
('3217', '32', 'KABUPATEN BANDUNG BARAT'),
('3218', '32', 'KABUPATEN PANGANDARAN'),
('3271', '32', 'KOTA BOGOR'),
('3272', '32', 'KOTA SUKABUMI'),
('3273', '32', 'KOTA BANDUNG'),
('3274', '32', 'KOTA CIREBON'),
('3275', '32', 'KOTA BEKASI'),
('3276', '32', 'KOTA DEPOK'),
('3277', '32', 'KOTA CIMAHI'),
('3278', '32', 'KOTA TASIKMALAYA'),
('3279', '32', 'KOTA BANJAR'),
('3301', '33', 'KABUPATEN CILACAP'),
('3302', '33', 'KABUPATEN BANYUMAS'),
('3303', '33', 'KABUPATEN PURBALINGGA'),
('3304', '33', 'KABUPATEN BANJARNEGARA'),
('3305', '33', 'KABUPATEN KEBUMEN'),
('3306', '33', 'KABUPATEN PURWOREJO'),
('3307', '33', 'KABUPATEN WONOSOBO'),
('3308', '33', 'KABUPATEN MAGELANG'),
('3309', '33', 'KABUPATEN BOYOLALI'),
('3310', '33', 'KABUPATEN KLATEN'),
('3311', '33', 'KABUPATEN SUKOHARJO'),
('3312', '33', 'KABUPATEN WONOGIRI'),
('3313', '33', 'KABUPATEN KARANGANYAR'),
('3314', '33', 'KABUPATEN SRAGEN'),
('3315', '33', 'KABUPATEN GROBOGAN'),
('3316', '33', 'KABUPATEN BLORA'),
('3317', '33', 'KABUPATEN REMBANG'),
('3318', '33', 'KABUPATEN PATI'),
('3319', '33', 'KABUPATEN KUDUS'),
('3320', '33', 'KABUPATEN JEPARA'),
('3321', '33', 'KABUPATEN DEMAK'),
('3322', '33', 'KABUPATEN SEMARANG'),
('3323', '33', 'KABUPATEN TEMANGGUNG'),
('3324', '33', 'KABUPATEN KENDAL'),
('3325', '33', 'KABUPATEN BATANG'),
('3326', '33', 'KABUPATEN PEKALONGAN'),
('3327', '33', 'KABUPATEN PEMALANG'),
('3328', '33', 'KABUPATEN TEGAL'),
('3329', '33', 'KABUPATEN BREBES'),
('3371', '33', 'KOTA MAGELANG'),
('3372', '33', 'KOTA SURAKARTA'),
('3373', '33', 'KOTA SALATIGA'),
('3374', '33', 'KOTA SEMARANG'),
('3375', '33', 'KOTA PEKALONGAN'),
('3376', '33', 'KOTA TEGAL'),
('3401', '34', 'KABUPATEN KULON PROGO'),
('3402', '34', 'KABUPATEN BANTUL'),
('3403', '34', 'KABUPATEN GUNUNG KIDUL'),
('3404', '34', 'KABUPATEN SLEMAN'),
('3471', '34', 'KOTA YOGYAKARTA'),
('3501', '35', 'KABUPATEN PACITAN'),
('3502', '35', 'KABUPATEN PONOROGO'),
('3503', '35', 'KABUPATEN TRENGGALEK'),
('3504', '35', 'KABUPATEN TULUNGAGUNG'),
('3505', '35', 'KABUPATEN BLITAR'),
('3506', '35', 'KABUPATEN KEDIRI'),
('3507', '35', 'KABUPATEN MALANG'),
('3508', '35', 'KABUPATEN LUMAJANG'),
('3509', '35', 'KABUPATEN JEMBER'),
('3510', '35', 'KABUPATEN BANYUWANGI'),
('3511', '35', 'KABUPATEN BONDOWOSO'),
('3512', '35', 'KABUPATEN SITUBONDO'),
('3513', '35', 'KABUPATEN PROBOLINGGO'),
('3514', '35', 'KABUPATEN PASURUAN'),
('3515', '35', 'KABUPATEN SIDOARJO'),
('3516', '35', 'KABUPATEN MOJOKERTO'),
('3517', '35', 'KABUPATEN JOMBANG'),
('3518', '35', 'KABUPATEN NGANJUK'),
('3519', '35', 'KABUPATEN MADIUN'),
('3520', '35', 'KABUPATEN MAGETAN'),
('3521', '35', 'KABUPATEN NGAWI'),
('3522', '35', 'KABUPATEN BOJONEGORO'),
('3523', '35', 'KABUPATEN TUBAN'),
('3524', '35', 'KABUPATEN LAMONGAN'),
('3525', '35', 'KABUPATEN GRESIK'),
('3526', '35', 'KABUPATEN BANGKALAN'),
('3527', '35', 'KABUPATEN SAMPANG'),
('3528', '35', 'KABUPATEN PAMEKASAN'),
('3529', '35', 'KABUPATEN SUMENEP'),
('3571', '35', 'KOTA KEDIRI'),
('3572', '35', 'KOTA BLITAR'),
('3573', '35', 'KOTA MALANG'),
('3574', '35', 'KOTA PROBOLINGGO'),
('3575', '35', 'KOTA PASURUAN'),
('3576', '35', 'KOTA MOJOKERTO'),
('3577', '35', 'KOTA MADIUN'),
('3578', '35', 'KOTA SURABAYA'),
('3579', '35', 'KOTA BATU'),
('3601', '36', 'KABUPATEN PANDEGLANG'),
('3602', '36', 'KABUPATEN LEBAK'),
('3603', '36', 'KABUPATEN TANGERANG'),
('3604', '36', 'KABUPATEN SERANG'),
('3671', '36', 'KOTA TANGERANG'),
('3672', '36', 'KOTA CILEGON'),
('3673', '36', 'KOTA SERANG'),
('3674', '36', 'KOTA TANGERANG SELATAN'),
('5101', '51', 'KABUPATEN JEMBRANA'),
('5102', '51', 'KABUPATEN TABANAN'),
('5103', '51', 'KABUPATEN BADUNG'),
('5104', '51', 'KABUPATEN GIANYAR'),
('5105', '51', 'KABUPATEN KLUNGKUNG'),
('5106', '51', 'KABUPATEN BANGLI'),
('5107', '51', 'KABUPATEN KARANG ASEM'),
('5108', '51', 'KABUPATEN BULELENG'),
('5171', '51', 'KOTA DENPASAR'),
('5201', '52', 'KABUPATEN LOMBOK BARAT'),
('5202', '52', 'KABUPATEN LOMBOK TENGAH'),
('5203', '52', 'KABUPATEN LOMBOK TIMUR'),
('5204', '52', 'KABUPATEN SUMBAWA'),
('5205', '52', 'KABUPATEN DOMPU'),
('5206', '52', 'KABUPATEN BIMA'),
('5207', '52', 'KABUPATEN SUMBAWA BARAT'),
('5208', '52', 'KABUPATEN LOMBOK UTARA'),
('5271', '52', 'KOTA MATARAM'),
('5272', '52', 'KOTA BIMA'),
('5301', '53', 'KABUPATEN SUMBA BARAT'),
('5302', '53', 'KABUPATEN SUMBA TIMUR'),
('5303', '53', 'KABUPATEN KUPANG'),
('5304', '53', 'KABUPATEN TIMOR TENGAH SELATAN'),
('5305', '53', 'KABUPATEN TIMOR TENGAH UTARA'),
('5306', '53', 'KABUPATEN BELU'),
('5307', '53', 'KABUPATEN ALOR'),
('5308', '53', 'KABUPATEN LEMBATA'),
('5309', '53', 'KABUPATEN FLORES TIMUR'),
('5310', '53', 'KABUPATEN SIKKA'),
('5311', '53', 'KABUPATEN ENDE'),
('5312', '53', 'KABUPATEN NGADA'),
('5313', '53', 'KABUPATEN MANGGARAI'),
('5314', '53', 'KABUPATEN ROTE NDAO'),
('5315', '53', 'KABUPATEN MANGGARAI BARAT'),
('5316', '53', 'KABUPATEN SUMBA TENGAH'),
('5317', '53', 'KABUPATEN SUMBA BARAT DAYA'),
('5318', '53', 'KABUPATEN NAGEKEO'),
('5319', '53', 'KABUPATEN MANGGARAI TIMUR'),
('5320', '53', 'KABUPATEN SABU RAIJUA'),
('5321', '53', 'KABUPATEN MALAKA'),
('5371', '53', 'KOTA KUPANG'),
('6101', '61', 'KABUPATEN SAMBAS'),
('6102', '61', 'KABUPATEN BENGKAYANG'),
('6103', '61', 'KABUPATEN LANDAK'),
('6104', '61', 'KABUPATEN MEMPAWAH'),
('6105', '61', 'KABUPATEN SANGGAU'),
('6106', '61', 'KABUPATEN KETAPANG'),
('6107', '61', 'KABUPATEN SINTANG'),
('6108', '61', 'KABUPATEN KAPUAS HULU'),
('6109', '61', 'KABUPATEN SEKADAU'),
('6110', '61', 'KABUPATEN MELAWI'),
('6111', '61', 'KABUPATEN KAYONG UTARA'),
('6112', '61', 'KABUPATEN KUBU RAYA'),
('6171', '61', 'KOTA PONTIANAK'),
('6172', '61', 'KOTA SINGKAWANG'),
('6201', '62', 'KABUPATEN KOTAWARINGIN BARAT'),
('6202', '62', 'KABUPATEN KOTAWARINGIN TIMUR'),
('6203', '62', 'KABUPATEN KAPUAS'),
('6204', '62', 'KABUPATEN BARITO SELATAN'),
('6205', '62', 'KABUPATEN BARITO UTARA'),
('6206', '62', 'KABUPATEN SUKAMARA'),
('6207', '62', 'KABUPATEN LAMANDAU'),
('6208', '62', 'KABUPATEN SERUYAN'),
('6209', '62', 'KABUPATEN KATINGAN'),
('6210', '62', 'KABUPATEN PULANG PISAU'),
('6211', '62', 'KABUPATEN GUNUNG MAS'),
('6212', '62', 'KABUPATEN BARITO TIMUR'),
('6213', '62', 'KABUPATEN MURUNG RAYA'),
('6271', '62', 'KOTA PALANGKA RAYA'),
('6301', '63', 'KABUPATEN TANAH LAUT'),
('6302', '63', 'KABUPATEN KOTA BARU'),
('6303', '63', 'KABUPATEN BANJAR'),
('6304', '63', 'KABUPATEN BARITO KUALA'),
('6305', '63', 'KABUPATEN TAPIN'),
('6306', '63', 'KABUPATEN HULU SUNGAI SELATAN'),
('6307', '63', 'KABUPATEN HULU SUNGAI TENGAH'),
('6308', '63', 'KABUPATEN HULU SUNGAI UTARA'),
('6309', '63', 'KABUPATEN TABALONG'),
('6310', '63', 'KABUPATEN TANAH BUMBU'),
('6311', '63', 'KABUPATEN BALANGAN'),
('6371', '63', 'KOTA BANJARMASIN'),
('6372', '63', 'KOTA BANJAR BARU'),
('6401', '64', 'KABUPATEN PASER'),
('6402', '64', 'KABUPATEN KUTAI BARAT'),
('6403', '64', 'KABUPATEN KUTAI KARTANEGARA'),
('6404', '64', 'KABUPATEN KUTAI TIMUR'),
('6405', '64', 'KABUPATEN BERAU'),
('6409', '64', 'KABUPATEN PENAJAM PASER UTARA'),
('6411', '64', 'KABUPATEN MAHAKAM HULU'),
('6471', '64', 'KOTA BALIKPAPAN'),
('6472', '64', 'KOTA SAMARINDA'),
('6474', '64', 'KOTA BONTANG'),
('6501', '65', 'KABUPATEN MALINAU'),
('6502', '65', 'KABUPATEN BULUNGAN'),
('6503', '65', 'KABUPATEN TANA TIDUNG'),
('6504', '65', 'KABUPATEN NUNUKAN'),
('6571', '65', 'KOTA TARAKAN'),
('7101', '71', 'KABUPATEN BOLAANG MONGONDOW'),
('7102', '71', 'KABUPATEN MINAHASA'),
('7103', '71', 'KABUPATEN KEPULAUAN SANGIHE'),
('7104', '71', 'KABUPATEN KEPULAUAN TALAUD'),
('7105', '71', 'KABUPATEN MINAHASA SELATAN'),
('7106', '71', 'KABUPATEN MINAHASA UTARA'),
('7107', '71', 'KABUPATEN BOLAANG MONGONDOW UTARA'),
('7108', '71', 'KABUPATEN SIAU TAGULANDANG BIARO'),
('7109', '71', 'KABUPATEN MINAHASA TENGGARA'),
('7110', '71', 'KABUPATEN BOLAANG MONGONDOW SELATAN'),
('7111', '71', 'KABUPATEN BOLAANG MONGONDOW TIMUR'),
('7171', '71', 'KOTA MANADO'),
('7172', '71', 'KOTA BITUNG'),
('7173', '71', 'KOTA TOMOHON'),
('7174', '71', 'KOTA KOTAMOBAGU'),
('7201', '72', 'KABUPATEN BANGGAI KEPULAUAN'),
('7202', '72', 'KABUPATEN BANGGAI'),
('7203', '72', 'KABUPATEN MOROWALI'),
('7204', '72', 'KABUPATEN POSO'),
('7205', '72', 'KABUPATEN DONGGALA'),
('7206', '72', 'KABUPATEN TOLI-TOLI'),
('7207', '72', 'KABUPATEN BUOL'),
('7208', '72', 'KABUPATEN PARIGI MOUTONG'),
('7209', '72', 'KABUPATEN TOJO UNA-UNA'),
('7210', '72', 'KABUPATEN SIGI'),
('7211', '72', 'KABUPATEN BANGGAI LAUT'),
('7212', '72', 'KABUPATEN MOROWALI UTARA'),
('7271', '72', 'KOTA PALU'),
('7301', '73', 'KABUPATEN KEPULAUAN SELAYAR'),
('7302', '73', 'KABUPATEN BULUKUMBA'),
('7303', '73', 'KABUPATEN BANTAENG'),
('7304', '73', 'KABUPATEN JENEPONTO'),
('7305', '73', 'KABUPATEN TAKALAR'),
('7306', '73', 'KABUPATEN GOWA'),
('7307', '73', 'KABUPATEN SINJAI'),
('7308', '73', 'KABUPATEN MAROS'),
('7309', '73', 'KABUPATEN PANGKAJENE DAN KEPULAUAN'),
('7310', '73', 'KABUPATEN BARRU'),
('7311', '73', 'KABUPATEN BONE'),
('7312', '73', 'KABUPATEN SOPPENG'),
('7313', '73', 'KABUPATEN WAJO'),
('7314', '73', 'KABUPATEN SIDENRENG RAPPANG'),
('7315', '73', 'KABUPATEN PINRANG'),
('7316', '73', 'KABUPATEN ENREKANG'),
('7317', '73', 'KABUPATEN LUWU'),
('7318', '73', 'KABUPATEN TANA TORAJA'),
('7322', '73', 'KABUPATEN LUWU UTARA'),
('7325', '73', 'KABUPATEN LUWU TIMUR'),
('7326', '73', 'KABUPATEN TORAJA UTARA'),
('7371', '73', 'KOTA MAKASSAR'),
('7372', '73', 'KOTA PAREPARE'),
('7373', '73', 'KOTA PALOPO'),
('7401', '74', 'KABUPATEN BUTON'),
('7402', '74', 'KABUPATEN MUNA'),
('7403', '74', 'KABUPATEN KONAWE'),
('7404', '74', 'KABUPATEN KOLAKA'),
('7405', '74', 'KABUPATEN KONAWE SELATAN'),
('7406', '74', 'KABUPATEN BOMBANA'),
('7407', '74', 'KABUPATEN WAKATOBI'),
('7408', '74', 'KABUPATEN KOLAKA UTARA'),
('7409', '74', 'KABUPATEN BUTON UTARA'),
('7410', '74', 'KABUPATEN KONAWE UTARA'),
('7411', '74', 'KABUPATEN KOLAKA TIMUR'),
('7412', '74', 'KABUPATEN KONAWE KEPULAUAN'),
('7413', '74', 'KABUPATEN MUNA BARAT'),
('7414', '74', 'KABUPATEN BUTON TENGAH'),
('7415', '74', 'KABUPATEN BUTON SELATAN'),
('7471', '74', 'KOTA KENDARI'),
('7472', '74', 'KOTA BAUBAU'),
('7501', '75', 'KABUPATEN BOALEMO'),
('7502', '75', 'KABUPATEN GORONTALO'),
('7503', '75', 'KABUPATEN POHUWATO'),
('7504', '75', 'KABUPATEN BONE BOLANGO'),
('7505', '75', 'KABUPATEN GORONTALO UTARA'),
('7571', '75', 'KOTA GORONTALO'),
('7601', '76', 'KABUPATEN MAJENE'),
('7602', '76', 'KABUPATEN POLEWALI MANDAR'),
('7603', '76', 'KABUPATEN MAMASA'),
('7604', '76', 'KABUPATEN MAMUJU'),
('7605', '76', 'KABUPATEN MAMUJU UTARA'),
('7606', '76', 'KABUPATEN MAMUJU TENGAH'),
('8101', '81', 'KABUPATEN MALUKU TENGGARA BARAT'),
('8102', '81', 'KABUPATEN MALUKU TENGGARA'),
('8103', '81', 'KABUPATEN MALUKU TENGAH'),
('8104', '81', 'KABUPATEN BURU'),
('8105', '81', 'KABUPATEN KEPULAUAN ARU'),
('8106', '81', 'KABUPATEN SERAM BAGIAN BARAT'),
('8107', '81', 'KABUPATEN SERAM BAGIAN TIMUR'),
('8108', '81', 'KABUPATEN MALUKU BARAT DAYA'),
('8109', '81', 'KABUPATEN BURU SELATAN'),
('8171', '81', 'KOTA AMBON'),
('8172', '81', 'KOTA TUAL'),
('8201', '82', 'KABUPATEN HALMAHERA BARAT'),
('8202', '82', 'KABUPATEN HALMAHERA TENGAH'),
('8203', '82', 'KABUPATEN KEPULAUAN SULA'),
('8204', '82', 'KABUPATEN HALMAHERA SELATAN'),
('8205', '82', 'KABUPATEN HALMAHERA UTARA'),
('8206', '82', 'KABUPATEN HALMAHERA TIMUR'),
('8207', '82', 'KABUPATEN PULAU MOROTAI'),
('8208', '82', 'KABUPATEN PULAU TALIABU'),
('8271', '82', 'KOTA TERNATE'),
('8272', '82', 'KOTA TIDORE KEPULAUAN'),
('9101', '91', 'KABUPATEN FAKFAK'),
('9102', '91', 'KABUPATEN KAIMANA'),
('9103', '91', 'KABUPATEN TELUK WONDAMA'),
('9104', '91', 'KABUPATEN TELUK BINTUNI'),
('9105', '91', 'KABUPATEN MANOKWARI'),
('9106', '91', 'KABUPATEN SORONG SELATAN'),
('9107', '91', 'KABUPATEN SORONG'),
('9108', '91', 'KABUPATEN RAJA AMPAT'),
('9109', '91', 'KABUPATEN TAMBRAUW'),
('9110', '91', 'KABUPATEN MAYBRAT'),
('9111', '91', 'KABUPATEN MANOKWARI SELATAN'),
('9112', '91', 'KABUPATEN PEGUNUNGAN ARFAK'),
('9171', '91', 'KOTA SORONG'),
('9401', '94', 'KABUPATEN MERAUKE'),
('9402', '94', 'KABUPATEN JAYAWIJAYA'),
('9403', '94', 'KABUPATEN JAYAPURA'),
('9404', '94', 'KABUPATEN NABIRE'),
('9408', '94', 'KABUPATEN KEPULAUAN YAPEN'),
('9409', '94', 'KABUPATEN BIAK NUMFOR'),
('9410', '94', 'KABUPATEN PANIAI'),
('9411', '94', 'KABUPATEN PUNCAK JAYA'),
('9412', '94', 'KABUPATEN MIMIKA'),
('9413', '94', 'KABUPATEN BOVEN DIGOEL'),
('9414', '94', 'KABUPATEN MAPPI'),
('9415', '94', 'KABUPATEN ASMAT'),
('9416', '94', 'KABUPATEN YAHUKIMO'),
('9417', '94', 'KABUPATEN PEGUNUNGAN BINTANG'),
('9418', '94', 'KABUPATEN TOLIKARA'),
('9419', '94', 'KABUPATEN SARMI'),
('9420', '94', 'KABUPATEN KEEROM'),
('9426', '94', 'KABUPATEN WAROPEN'),
('9427', '94', 'KABUPATEN SUPIORI'),
('9428', '94', 'KABUPATEN MAMBERAMO RAYA'),
('9429', '94', 'KABUPATEN NDUGA'),
('9430', '94', 'KABUPATEN LANNY JAYA'),
('9431', '94', 'KABUPATEN MAMBERAMO TENGAH'),
('9432', '94', 'KABUPATEN YALIMO'),
('9433', '94', 'KABUPATEN PUNCAK'),
('9434', '94', 'KABUPATEN DOGIYAI'),
('9435', '94', 'KABUPATEN INTAN JAYA'),
('9436', '94', 'KABUPATEN DEIYAI'),
('9471', '94', 'KOTA JAYAPURA');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(362, '2014_10_12_000000_create_users_table', 1),
(363, '2014_10_12_100000_create_password_resets_table', 1),
(364, '2018_03_02_145431_create_penduduks_table', 1),
(365, '2018_03_02_152504_create_agamas_table', 1),
(366, '2018_03_02_152808_create_pendidikans_table', 1),
(367, '2018_03_02_153000_create_jenis_pekerjaans_table', 1),
(368, '2018_03_02_153043_create_status_nikahs_table', 1),
(369, '2018_03_02_153153_create_status_hubungans_table', 1),
(370, '2018_03_02_153404_create_kematians_table', 1),
(371, '2018_03_02_154212_create_kelurahans_table', 1),
(372, '2018_03_02_154323_create_kecamatans_table', 1),
(373, '2018_03_02_154409_create_kotas_table', 1),
(374, '2018_03_02_154520_create_provinsis_table', 1),
(375, '2018_03_03_113546_create_penerbits_table', 1),
(376, '2018_03_07_150311_create_kartu_keluargas_table', 1),
(377, '2018_03_07_150357_create_rukun_tetanggas_table', 1),
(378, '2018_03_07_150439_create_rukun_wargas_table', 1),
(379, '2018_03_30_030658_create_pindahs_table', 1),
(381, '2018_04_12_104903_create_surat_keterangan_tidak_mampus_table', 2),
(383, '2018_04_16_140545_create_surat_keterangan_usahas_table', 3),
(384, '2018_04_19_132019_create_surat_keterangan_kehilangans_table', 4),
(386, '2018_05_14_112736_create_surat_keterangan_kenal_lahirs_table', 5),
(387, '2018_05_17_061245_create_surat_keterangan_dukuns_table', 6),
(388, '2018_05_17_081653_create_surat_keterangan_wali_nikahs_table', 7),
(390, '2018_05_17_100245_create_surat_keterangan_lunas_pbbs_table', 8),
(391, '2018_05_17_142849_create_surat_keterangan_kelakuan_baiks_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikans`
--

CREATE TABLE `pendidikans` (
  `id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendidikans`
--

INSERT INTO `pendidikans` (`id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'TIDAK/BELUM SEKOLAH', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(2, 'BELUM TAMAT SD/SEDERAJAT', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(3, 'TAMAT SD/SEDERAJAT', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(4, 'SLTP/SEDERAJAT', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(5, 'SLTA/SEDERAJAT', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(6, 'DIPLOMA I/II', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(7, 'AKADEMI/DIPLOMA III/S. MUDA', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(8, 'DIPLOMA IV/STRATA I', '2018-04-04 12:18:31', '2018-04-04 12:18:31'),
(9, 'STRATA II', '2018-04-04 12:18:32', '2018-04-04 12:18:32'),
(10, 'STRATA III', '2018-04-04 12:18:32', '2018-04-04 12:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `penduduks`
--

CREATE TABLE `penduduks` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` int(11) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama_id` int(11) NOT NULL,
  `pendidikan_id` int(11) NOT NULL,
  `jenis_pekerjaan_id` int(11) NOT NULL,
  `status_nikah_id` int(11) NOT NULL,
  `status_hubungan_id` int(11) NOT NULL,
  `kewarganegaraan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_paspor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_kitas` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kk_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penduduks`
--

INSERT INTO `penduduks` (`id`, `nama`, `jk`, `tempat_lahir`, `tgl_lahir`, `agama_id`, `pendidikan_id`, `jenis_pekerjaan_id`, `status_nikah_id`, `status_hubungan_id`, `kewarganegaraan`, `no_paspor`, `no_kitas`, `ayah`, `ibu`, `kk_id`, `status`, `created_at`, `updated_at`) VALUES
('3425245245245245', 'ROY SUHERMAN', 'L', 3503, '1987-03-14', 6, 5, 11, 1, 9, 'WNI', NULL, NULL, 'CHRISTIAN SUHERMAN', 'VIONA', '3425245245253310', '1', '2018-03-17 07:08:49', '2018-04-07 21:14:54'),
('3573030311700003', 'DANI SULKRON', 'L', 9112, '1965-03-14', 1, 9, 13, 2, 1, 'WNI', '98234787489234', '45356246234653', 'YANTO', 'YANTI', '3425245245253310', '2', '2018-03-16 05:08:40', '2018-04-08 01:29:18'),
('3573030311700006', 'AMIRA SULASTRI', 'P', 8271, '1970-07-31', 7, 3, 3, 1, 4, 'WNI', NULL, NULL, 'HERU', 'SULASTRI', '3425245245253310', NULL, '2018-03-16 05:13:30', '2018-05-16 07:41:50'),
('3573030311700009', 'NIRA ALISAH', 'P', 1808, '2015-03-15', 7, 10, 2, 2, 3, 'WNA', '9832748237894', NULL, 'HARIYADI', 'RANI', '3425245245252451', NULL, '2018-03-16 05:11:46', '2018-05-01 05:22:46'),
('3573082819293719', 'HARI SUSANTO', 'L', 1501, '2018-04-04', 1, 8, 24, 3, 1, 'WNA', NULL, NULL, 'SUSANTO', 'YULI', '3425245245252451', NULL, '2018-04-29 03:49:09', '2018-05-01 05:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `penerbits`
--

CREATE TABLE `penerbits` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penerbits`
--

INSERT INTO `penerbits` (`id`, `nama`, `jabatan`, `created_at`, `updated_at`) VALUES
('1977002003004004', 'MUHAJIR', 'SEKRETARIS DESA', '2018-04-12 04:15:48', '2018-04-12 04:15:48'),
('1978001002002003', 'BUDI SANTOSO', 'KEPALA DESA', '2018-04-12 04:15:12', '2018-04-12 04:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `pindahs`
--

CREATE TABLE `pindahs` (
  `penduduk_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_asal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_tujuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pindahs`
--

INSERT INTO `pindahs` (`penduduk_id`, `alamat_asal`, `alamat_tujuan`, `alasan`, `created_at`, `updated_at`) VALUES
('3573030311700003', 'TEGALWERU', 'SURABAYA', 'MENEMPUH PENDIDIKAN', '2018-04-08 01:29:17', '2018-04-08 01:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `provinsis`
--

CREATE TABLE `provinsis` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinsis`
--

INSERT INTO `provinsis` (`id`, `nama`) VALUES
('11', 'ACEH'),
('12', 'SUMATERA UTARA'),
('13', 'SUMATERA BARAT'),
('14', 'RIAU'),
('15', 'JAMBI'),
('16', 'SUMATERA SELATAN'),
('17', 'BENGKULU'),
('18', 'LAMPUNG'),
('19', 'KEPULAUAN BANGKA BELITUNG'),
('21', 'KEPULAUAN RIAU'),
('31', 'DKI JAKARTA'),
('32', 'JAWA BARAT'),
('33', 'JAWA TENGAH'),
('34', 'DI YOGYAKARTA'),
('35', 'JAWA TIMUR'),
('36', 'BANTEN'),
('51', 'BALI'),
('52', 'NUSA TENGGARA BARAT'),
('53', 'NUSA TENGGARA TIMUR'),
('61', 'KALIMANTAN BARAT'),
('62', 'KALIMANTAN TENGAH'),
('63', 'KALIMANTAN SELATAN'),
('64', 'KALIMANTAN TIMUR'),
('65', 'KALIMANTAN UTARA'),
('71', 'SULAWESI UTARA'),
('72', 'SULAWESI TENGAH'),
('73', 'SULAWESI SELATAN'),
('74', 'SULAWESI TENGGARA'),
('75', 'GORONTALO'),
('76', 'SULAWESI BARAT'),
('81', 'MALUKU'),
('82', 'MALUKU UTARA'),
('91', 'PAPUA BARAT'),
('94', 'PAPUA');

-- --------------------------------------------------------

--
-- Table structure for table `rukun_tetanggas`
--

CREATE TABLE `rukun_tetanggas` (
  `id` int(10) UNSIGNED NOT NULL,
  `rukun_warga_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rukun_tetanggas`
--

INSERT INTO `rukun_tetanggas` (`id`, `rukun_warga_id`, `nama`, `ketua`, `created_at`, `updated_at`) VALUES
(1, '1', '001', 'RAKINEM', '2018-03-10 18:28:19', '2018-03-10 18:28:19'),
(2, '1', '002', 'SUKMAWAN', '2018-03-10 18:28:42', '2018-03-10 18:28:42'),
(3, '1', '003', 'YULIANTO', '2018-03-10 18:29:07', '2018-03-10 18:29:07'),
(4, '2', '001', 'ZAKARIA MAHMUD', '2018-03-10 18:29:38', '2018-03-10 18:29:38'),
(5, '2', '002', 'GUNTUR ADI', '2018-03-10 18:30:04', '2018-03-10 18:30:04'),
(6, '1', '004', 'HUSNI MUBAROK', '2018-04-29 04:11:28', '2018-04-29 04:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `rukun_wargas`
--

CREATE TABLE `rukun_wargas` (
  `id` int(10) UNSIGNED NOT NULL,
  `kelurahan_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rukun_wargas`
--

INSERT INTO `rukun_wargas` (`id`, `kelurahan_id`, `nama`, `ketua`, `created_at`, `updated_at`) VALUES
(1, '3507300006', '001', 'SUKIMAN', '2018-03-10 18:26:59', '2018-03-10 18:26:59'),
(2, '3507300006', '002', 'MUNIR LUKMAWAN', '2018-03-10 18:27:49', '2018-03-10 18:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `status_hubungans`
--

CREATE TABLE `status_hubungans` (
  `id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_hubungans`
--

INSERT INTO `status_hubungans` (`id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'KEPALA KELUARGA', '2018-04-04 12:18:28', '2018-04-04 12:18:28'),
(2, 'SUAMI', '2018-04-04 12:18:28', '2018-04-04 12:18:28'),
(3, 'ISTRI', '2018-04-04 12:18:28', '2018-04-04 12:18:28'),
(4, 'ANAK', '2018-04-04 12:18:28', '2018-04-04 12:18:28'),
(5, 'MENANTU', '2018-04-04 12:18:28', '2018-04-04 12:18:28'),
(6, 'CUCU', '2018-04-04 12:18:28', '2018-04-04 12:18:28'),
(7, 'ORANGTUA', '2018-04-04 12:18:29', '2018-04-04 12:18:29'),
(8, 'MERTUA', '2018-04-04 12:18:29', '2018-04-04 12:18:29'),
(9, 'FAMILI LAIN', '2018-04-04 12:18:29', '2018-04-04 12:18:29'),
(10, 'PEMBANTU', '2018-04-04 12:18:29', '2018-04-04 12:18:29'),
(11, 'LAINNYA', '2018-04-04 12:18:29', '2018-04-04 12:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `status_nikahs`
--

CREATE TABLE `status_nikahs` (
  `id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_nikahs`
--

INSERT INTO `status_nikahs` (`id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'BELUM KAWIN', '2018-04-04 12:18:29', '2018-04-04 12:18:29'),
(2, 'KAWIN', '2018-04-04 12:18:29', '2018-04-04 12:18:29'),
(3, 'CERAI HIDUP', '2018-04-04 12:18:29', '2018-04-04 12:18:29'),
(4, 'CERAI MATI', '2018-04-04 12:18:29', '2018-04-04 12:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_dukuns`
--

CREATE TABLE `surat_keterangan_dukuns` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_anak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_suami` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_lahir` datetime NOT NULL,
  `penerbit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_keterangan_dukuns`
--

INSERT INTO `surat_keterangan_dukuns` (`id`, `nomor`, `penduduk_id`, `nama_anak`, `nama_suami`, `waktu_lahir`, `penerbit_id`, `created_at`, `updated_at`) VALUES
(1, '140/1/35.07.2006/2018', '3573030311700009', 'SUSANTI', 'SUYANTO', '2018-05-01 20:00:00', '1978001002002003', '2018-05-17 00:14:04', '2018-05-17 00:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_kehilangans`
--

CREATE TABLE `surat_keterangan_kehilangans` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_keterangan_kehilangans`
--

INSERT INTO `surat_keterangan_kehilangans` (`id`, `nomor`, `penduduk_id`, `keperluan`, `penerbit_id`, `created_at`, `updated_at`) VALUES
(1, '140/1/35.07.2006/2018', '3573030311700006', 'KEHILANGAN STNK SEPEDA MOTOR', '1978001002002003', '2018-04-19 07:11:20', '2018-04-19 07:23:44'),
(2, '140/2/35.07.2006/2018', '3573082819293719', 'KEHILANGAN SMARTPHONE SAMSUNG NOTE 7\r\nUNTUK  MENERANGKAN   BAHWA  MENURUT  LAPORAN  ORANG     TERSEBUT\r\n                                                   DIATAS PADA HARI HARI MINGGU TANGGAL, 11 FEBRUARI 2018 PUKUL 05.00 WIB      TELAH    KEHILANGAN   STNK SEPEDA MOTOR MERK: HONDA TAHUN 2017 NOPOL N 5667  HM, NOMOR: BPKB N 00139862, NOMOR MESIN: JM2IE217590,NOMOR RANGKA: MIIJM211911K220193 WARNA BIRU ATASNAMA NURUL CANDRASASI    DAN HILANGNYA  SAAT  PERJALANAN PULANG DARI KENDAL PAYAK', '1977002003004004', '2018-04-29 04:27:22', '2018-04-29 04:41:55'),
(3, '140/3/35.07.2006/2018', '3573082819293719', 'BARANG HILANG', '1977002003004004', '2018-05-16 06:44:43', '2018-05-16 06:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_kelakuan_baiks`
--

CREATE TABLE `surat_keterangan_kelakuan_baiks` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir_ayah` date NOT NULL,
  `tgl_lahir_ibu` date NOT NULL,
  `agama_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_keterangan_kelakuan_baiks`
--

INSERT INTO `surat_keterangan_kelakuan_baiks` (`id`, `nomor`, `penduduk_id`, `nama_ayah`, `nama_ibu`, `tempat_lahir_ayah`, `tempat_lahir_ibu`, `tgl_lahir_ayah`, `tgl_lahir_ibu`, `agama_ayah`, `agama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `alamat_ayah`, `alamat_ibu`, `keperluan`, `penerbit_id`, `created_at`, `updated_at`) VALUES
(1, '721/1/421.633.006/2018', '3573030311700009', 'BASRI', 'HANI', 'MALANG', 'BOJONEGORO', '2018-05-05', '2018-05-29', 'BUDDHA', 'KRISTEN', 'TANI', 'IRT', 'MALANG', 'MALANG', 'SKCK POLISI', '1977002003004004', '2018-05-17 08:25:02', '2018-05-17 08:25:02'),
(2, '721/2/421.633.006/2018', '3573030311700006', 'MULYONO', 'YULIANTI', 'BANDUNG', 'MALANG', '2018-08-09', '2018-05-31', 'ISLAM', 'ISLAM', 'MANAJER', 'BERDAGANG DI TOKO', 'MALANG', 'MALANG', 'MENGURUS DATA PENDUDUK SENSUS', '1978001002002003', '2018-05-17 08:30:26', '2018-05-17 09:03:08');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_kenal_lahirs`
--

CREATE TABLE `surat_keterangan_kenal_lahirs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_keterangan_kenal_lahirs`
--

INSERT INTO `surat_keterangan_kenal_lahirs` (`id`, `nomor`, `penduduk_id`, `penerbit_id`, `created_at`, `updated_at`) VALUES
(1, '140/1/35.07.2006/2018', '3573082819293719', '1978001002002003', '2018-05-14 07:00:35', '2018-05-14 07:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_lunas_pbbs`
--

CREATE TABLE `surat_keterangan_lunas_pbbs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lunas` int(11) NOT NULL,
  `keperluan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_keterangan_lunas_pbbs`
--

INSERT INTO `surat_keterangan_lunas_pbbs` (`id`, `nomor`, `penduduk_id`, `tahun_lunas`, `keperluan`, `penerbit_id`, `created_at`, `updated_at`) VALUES
(1, '970/1/35.07.22.2006/2018', '3573030311700006', 3, 'BAHWA YANG BERSANGKUTAN TERSEBUT DI ATAS BENAR-BENAR PEMILIK SEBIDANG TANAH YANG TERLETAK DI DESA TEGALWERU DENGAN NOP 35.07.270.006.006.0071.0 ATAS NAMA  . NGATIAH', '1978001002002003', '2018-05-17 06:19:28', '2018-05-17 06:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_tidak_mampus`
--

CREATE TABLE `surat_keterangan_tidak_mampus` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_keterangan_tidak_mampus`
--

INSERT INTO `surat_keterangan_tidak_mampus` (`id`, `nomor`, `penduduk_id`, `keperluan`, `penerbit_id`, `created_at`, `updated_at`) VALUES
(1, '140/1/35.07.2006/2018', '3573030311700006', 'MENGAJUKAN BEASISWA', '1978001002002003', '2018-04-04 05:37:53', '2018-04-12 05:37:53'),
(4, '140/3/35.07.2006/2018', '3573030311700009', 'MENGAJUKAN KERINGANAN', '1977002003004004', '2018-02-20 05:52:25', '2018-04-12 05:52:25'),
(6, '140/2/35.07.2006/2018', '3573030311700009', 'MENGURUS BEASISWA', '1977002003004004', '2018-05-17 20:23:14', '2018-05-17 20:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_usahas`
--

CREATE TABLE `surat_keterangan_usahas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_usaha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sendiri_sawah` int(11) DEFAULT NULL,
  `sendiri_tegal` int(11) DEFAULT NULL,
  `sewa_sawah` int(11) DEFAULT NULL,
  `sewa_tegal` int(11) DEFAULT NULL,
  `keperluan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_keterangan_usahas`
--

INSERT INTO `surat_keterangan_usahas` (`id`, `nomor`, `penduduk_id`, `jenis_usaha`, `sendiri_sawah`, `sendiri_tegal`, `sewa_sawah`, `sewa_tegal`, `keperluan`, `penerbit_id`, `created_at`, `updated_at`) VALUES
(1, '140/1/35.07.2006/2018', '3573030311700009', 'DAGANG AYAM', 10, 50, 70, 15, 'KELENGKAPAN ADMINISTRASI DAN MENEBUS PINJAMAN', '1978001002002003', '2018-04-17 06:45:19', '2018-04-19 04:55:52'),
(2, '140/2/35.07.2006/2018', '3573030311700009', 'BERJUALAN JERUK', 0, 0, 35, 120, 'MENJUAL JERUK', '1978001002002003', '2018-05-16 06:58:46', '2018-05-16 06:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_wali_nikahs`
--

CREATE TABLE `surat_keterangan_wali_nikahs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_nikah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir_nikah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir_nikah` date NOT NULL,
  `agama_nikah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_nikah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_nikah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_keterangan_wali_nikahs`
--

INSERT INTO `surat_keterangan_wali_nikahs` (`id`, `nomor`, `penduduk_id`, `nama_nikah`, `tempat_lahir_nikah`, `tgl_lahir_nikah`, `agama_nikah`, `pekerjaan_nikah`, `alamat_nikah`, `penerbit_id`, `created_at`, `updated_at`) VALUES
(1, '140/1/35.07.2006/2018', '3573082819293719', 'PRISCILLA RAHAYU', 'KEDIRI', '2018-07-02', 'KRISTEN', 'PEGAWAI SWASTA', 'KEDIRI GG. 5', '1977002003004004', '2018-05-17 02:11:02', '2018-05-17 02:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'sample', '$2y$10$4.IEUUIQiPIf0UuO4JGqGux4o9Ni7u7kt4ZEgNTgbCEOFYeqv7mfO', 'bGOKOTrDh8itIlRURnHfLmwLqK6IKgP35tuvF4Uc4tZxThqJjPWpET3cBQ4G', '2018-04-17 10:00:00', '2018-04-17 10:00:00'),
(2, 'admin', '$2y$10$l9eLWVBpgaOx69P2W3MFyeKorTT/efYhZZA9DQQ4N7hHgB9/kQEza', 'batstQOz2vkl1zsCjeP47kG0eWgK7xoOByY0CXKMBZfHOU0RVlE3w34Dx9HX', NULL, '2018-04-22 03:57:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agamas`
--
ALTER TABLE `agamas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pekerjaans`
--
ALTER TABLE `jenis_pekerjaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kartu_keluargas`
--
ALTER TABLE `kartu_keluargas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelurahans`
--
ALTER TABLE `kelurahans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kematians`
--
ALTER TABLE `kematians`
  ADD PRIMARY KEY (`penduduk_id`);

--
-- Indexes for table `kotas`
--
ALTER TABLE `kotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pendidikans`
--
ALTER TABLE `pendidikans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penduduks`
--
ALTER TABLE `penduduks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerbits`
--
ALTER TABLE `penerbits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pindahs`
--
ALTER TABLE `pindahs`
  ADD PRIMARY KEY (`penduduk_id`);

--
-- Indexes for table `provinsis`
--
ALTER TABLE `provinsis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rukun_tetanggas`
--
ALTER TABLE `rukun_tetanggas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rukun_wargas`
--
ALTER TABLE `rukun_wargas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_hubungans`
--
ALTER TABLE `status_hubungans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_nikahs`
--
ALTER TABLE `status_nikahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_dukuns`
--
ALTER TABLE `surat_keterangan_dukuns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_kehilangans`
--
ALTER TABLE `surat_keterangan_kehilangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_kelakuan_baiks`
--
ALTER TABLE `surat_keterangan_kelakuan_baiks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_kenal_lahirs`
--
ALTER TABLE `surat_keterangan_kenal_lahirs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_lunas_pbbs`
--
ALTER TABLE `surat_keterangan_lunas_pbbs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_tidak_mampus`
--
ALTER TABLE `surat_keterangan_tidak_mampus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_usahas`
--
ALTER TABLE `surat_keterangan_usahas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_wali_nikahs`
--
ALTER TABLE `surat_keterangan_wali_nikahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agamas`
--
ALTER TABLE `agamas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenis_pekerjaans`
--
ALTER TABLE `jenis_pekerjaans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;

--
-- AUTO_INCREMENT for table `pendidikans`
--
ALTER TABLE `pendidikans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rukun_tetanggas`
--
ALTER TABLE `rukun_tetanggas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rukun_wargas`
--
ALTER TABLE `rukun_wargas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_hubungans`
--
ALTER TABLE `status_hubungans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `status_nikahs`
--
ALTER TABLE `status_nikahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_keterangan_dukuns`
--
ALTER TABLE `surat_keterangan_dukuns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_keterangan_kehilangans`
--
ALTER TABLE `surat_keterangan_kehilangans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat_keterangan_kelakuan_baiks`
--
ALTER TABLE `surat_keterangan_kelakuan_baiks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_keterangan_kenal_lahirs`
--
ALTER TABLE `surat_keterangan_kenal_lahirs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_keterangan_lunas_pbbs`
--
ALTER TABLE `surat_keterangan_lunas_pbbs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_keterangan_tidak_mampus`
--
ALTER TABLE `surat_keterangan_tidak_mampus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surat_keterangan_usahas`
--
ALTER TABLE `surat_keterangan_usahas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_keterangan_wali_nikahs`
--
ALTER TABLE `surat_keterangan_wali_nikahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
