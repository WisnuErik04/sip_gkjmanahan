-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2025 at 09:29 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim-paga`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint UNSIGNED NOT NULL,
  `tgl_rapat` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `tgl_rapat`, `created_at`, `updated_at`) VALUES
(1, '2025-04-01', '2025-03-25 03:03:39', '2025-03-25 03:03:39'),
(2, '2025-04-15', '2025-03-25 23:29:56', '2025-03-25 23:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `agenda_details`
--

CREATE TABLE `agenda_details` (
  `id` bigint UNSIGNED NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `dari` varchar(255) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `usulan_keputusan` text,
  `keterangan` text,
  `agenda_id` bigint UNSIGNED NOT NULL,
  `jenis_id` bigint UNSIGNED NOT NULL,
  `keterangan_id` bigint UNSIGNED NOT NULL,
  `request_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hasil_keputusan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agenda_details`
--

INSERT INTO `agenda_details` (`id`, `no_surat`, `perihal`, `dari`, `tanggal_masuk`, `usulan_keputusan`, `keterangan`, `agenda_id`, `jenis_id`, `keterangan_id`, `request_id`, `created_at`, `updated_at`, `hasil_keputusan`) VALUES
(1, '1', 'Permohonan Baptis Anak, nama; Erik ke 2', 'Erik ke 2', '2025-03-24', NULL, NULL, 1, 2, 1, 16, '2025-03-25 06:40:13', '2025-03-26 08:21:24', 'Setuju'),
(3, '3', 'aqwqw aqwqwaqwqwaqwqw aqwqw aqwqwaqwqwaqwqwaqwqw aqwqwaqwqw aqwqwaqwqwaqwqwaqwqw aqwqwaqwqwaqwqwaqwqw aqwqwaqwqwaqwqwaqwqwaqwqwaqwqwaqwqw aqwqwaqwqw', 'Asasas', '2025-03-26', 'qwqwqw', NULL, 1, 1, 3, NULL, '2025-03-25 22:15:34', '2025-03-25 23:39:26', NULL),
(4, '216', 'Permohonan ijin pemasangan poster mengenai fakultas Bioteknologi UKDW Yogyakarta', 'Universitas Kristen Duta Wacana Yogyakarta', '2025-03-08', 'Diterima', NULL, 1, 1, 2, NULL, '2025-03-26 21:23:01', '2025-03-26 21:23:01', NULL),
(5, '210', 'Permohonan pinjam ruangan untuk PD pada minggu, 9 Maret 2025 jam 10.00wib', 'Ketua PD Lovely Pink Solo', '2025-03-08', 'Diijinkan, koordinasi dengan pengurus RDMS', NULL, 1, 1, 2, NULL, '2025-03-26 21:27:14', '2025-03-28 09:22:23', NULL),
(6, '12', 'Permohonan Baptis Anak, nama; Ricky Ferdinan', 'Ricky Ferdinan', '2025-03-27', NULL, NULL, 1, 2, 1, 20, '2025-03-28 09:21:20', '2025-03-28 09:29:27', 'Diizinkan, Diagendakan'),
(7, '13', 'Permohonan Baptis Dewasa Dan Pengakuan Percaya (SIDI), nama; Calvin Verdonk', 'Calvin Verdonk', '2025-03-29', NULL, NULL, 2, 2, 1, 22, '2025-03-29 06:22:47', '2025-03-29 06:22:47', NULL),
(8, '14', 'Permohonan Baptis Dewasa Dan Pengakuan Percaya (SIDI), nama; Calvin Verdonk', 'Calvin Verdonk', '2025-03-29', NULL, NULL, 2, 2, 1, 22, '2025-03-29 06:34:19', '2025-03-29 06:34:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agenda_jenis`
--

CREATE TABLE `agenda_jenis` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agenda_jenis`
--

INSERT INTO `agenda_jenis` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Surat Informatif', '2025-03-25 03:02:05', '2025-03-25 03:02:05'),
(2, 'Surat Dibahas', '2025-03-25 03:02:06', '2025-03-25 03:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `agenda_keterangans`
--

CREATE TABLE `agenda_keterangans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agenda_keterangans`
--

INSERT INTO `agenda_keterangans` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kew', '2025-03-25 03:02:05', '2025-03-25 03:02:05'),
(2, 'Um', '2025-03-25 03:02:05', '2025-03-25 03:02:05'),
(3, 'Ibd', '2025-03-25 03:02:05', '2025-03-25 03:02:05'),
(4, 'Keu', '2025-03-25 03:02:05', '2025-03-25 03:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1743253585),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1743253585;', 1743253585),
('5c785c036466adea360111aa28563bfd556b5fba', 'i:3;', 1742788830),
('5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1742788830;', 1742788830),
('da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:2;', 1743175646),
('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1743175646;', 1743175646),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1743254577),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1743254577;', 1743254577),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:5:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";s:1:\"j\";s:21:\"level_verification_id\";}s:11:\"permissions\";a:168:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"view_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:13:\"view_any_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"create_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"update_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:12:\"restore_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:16:\"restore_any_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"replicate_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"reorder_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:11:\"delete_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"delete_any_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"force_delete_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:21:\"force_delete_any_form\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:24:\"view_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:28:\"view_any_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:26:\"create_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:26:\"update_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:27:\"restore_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:31:\"restore_any_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:29:\"replicate_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:27:\"reorder_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:26:\"delete_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:30:\"delete_any_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:32:\"force_delete_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:36:\"force_delete_any_level::verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:12:\"view_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:16:\"view_any_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:14:\"create_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:14:\"update_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:14:\"delete_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:18:\"delete_any_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:30;a:3:{s:1:\"a\";i:31;s:1:\"b\";s:15:\"publish_request\";s:1:\"c\";s:3:\"web\";}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:9:\"view_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:13:\"view_any_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:11:\"create_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:11:\"update_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:11:\"delete_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:15:\"delete_any_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:10:\"view_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:14:\"view_any_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:12:\"create_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:12:\"update_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:13:\"restore_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:17:\"restore_any_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:15:\"replicate_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:13:\"reorder_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:12:\"delete_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:16:\"delete_any_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:18:\"force_delete_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:22:\"force_delete_any_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:9:\"view_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:13:\"view_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:11:\"create_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:11:\"update_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:12:\"restore_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:16:\"restore_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:14:\"replicate_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:12:\"reorder_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:11:\"delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:15:\"delete_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:17:\"force_delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:21:\"force_delete_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:1:\"2\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:62;a:3:{s:1:\"a\";i:63;s:1:\"b\";s:1:\"2\";s:1:\"c\";s:5:\"web 2\";}i:63;a:3:{s:1:\"a\";i:64;s:1:\"b\";s:9:\"view_form\";s:1:\"c\";s:5:\"web 2\";}i:64;a:3:{s:1:\"a\";i:65;s:1:\"b\";s:13:\"view_any_form\";s:1:\"c\";s:5:\"web 2\";}i:65;a:3:{s:1:\"a\";i:66;s:1:\"b\";s:11:\"create_form\";s:1:\"c\";s:5:\"web 2\";}i:66;a:3:{s:1:\"a\";i:67;s:1:\"b\";s:11:\"update_form\";s:1:\"c\";s:5:\"web 2\";}i:67;a:3:{s:1:\"a\";i:68;s:1:\"b\";s:12:\"restore_form\";s:1:\"c\";s:5:\"web 2\";}i:68;a:3:{s:1:\"a\";i:69;s:1:\"b\";s:16:\"restore_any_form\";s:1:\"c\";s:5:\"web 2\";}i:69;a:3:{s:1:\"a\";i:70;s:1:\"b\";s:14:\"replicate_form\";s:1:\"c\";s:5:\"web 2\";}i:70;a:3:{s:1:\"a\";i:71;s:1:\"b\";s:12:\"reorder_form\";s:1:\"c\";s:5:\"web 2\";}i:71;a:3:{s:1:\"a\";i:72;s:1:\"b\";s:11:\"delete_form\";s:1:\"c\";s:5:\"web 2\";}i:72;a:3:{s:1:\"a\";i:73;s:1:\"b\";s:15:\"delete_any_form\";s:1:\"c\";s:5:\"web 2\";}i:73;a:3:{s:1:\"a\";i:74;s:1:\"b\";s:17:\"force_delete_form\";s:1:\"c\";s:5:\"web 2\";}i:74;a:3:{s:1:\"a\";i:75;s:1:\"b\";s:21:\"force_delete_any_form\";s:1:\"c\";s:5:\"web 2\";}i:75;a:3:{s:1:\"a\";i:76;s:1:\"b\";s:9:\"view_user\";s:1:\"c\";s:5:\"web 2\";}i:76;a:3:{s:1:\"a\";i:77;s:1:\"b\";s:13:\"view_any_user\";s:1:\"c\";s:5:\"web 2\";}i:77;a:3:{s:1:\"a\";i:78;s:1:\"b\";s:11:\"create_user\";s:1:\"c\";s:5:\"web 2\";}i:78;a:3:{s:1:\"a\";i:79;s:1:\"b\";s:11:\"update_user\";s:1:\"c\";s:5:\"web 2\";}i:79;a:3:{s:1:\"a\";i:80;s:1:\"b\";s:12:\"restore_user\";s:1:\"c\";s:5:\"web 2\";}i:80;a:3:{s:1:\"a\";i:81;s:1:\"b\";s:16:\"restore_any_user\";s:1:\"c\";s:5:\"web 2\";}i:81;a:3:{s:1:\"a\";i:82;s:1:\"b\";s:14:\"replicate_user\";s:1:\"c\";s:5:\"web 2\";}i:82;a:3:{s:1:\"a\";i:83;s:1:\"b\";s:12:\"reorder_user\";s:1:\"c\";s:5:\"web 2\";}i:83;a:3:{s:1:\"a\";i:84;s:1:\"b\";s:11:\"delete_user\";s:1:\"c\";s:5:\"web 2\";}i:84;a:3:{s:1:\"a\";i:85;s:1:\"b\";s:15:\"delete_any_user\";s:1:\"c\";s:5:\"web 2\";}i:85;a:3:{s:1:\"a\";i:86;s:1:\"b\";s:17:\"force_delete_user\";s:1:\"c\";s:5:\"web 2\";}i:86;a:3:{s:1:\"a\";i:87;s:1:\"b\";s:21:\"force_delete_any_user\";s:1:\"c\";s:5:\"web 2\";}i:87;a:3:{s:1:\"a\";i:88;s:1:\"b\";s:24:\"view_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:88;a:3:{s:1:\"a\";i:89;s:1:\"b\";s:28:\"view_any_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:89;a:3:{s:1:\"a\";i:90;s:1:\"b\";s:26:\"create_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:90;a:3:{s:1:\"a\";i:91;s:1:\"b\";s:26:\"update_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:91;a:3:{s:1:\"a\";i:92;s:1:\"b\";s:27:\"restore_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:92;a:3:{s:1:\"a\";i:93;s:1:\"b\";s:31:\"restore_any_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:93;a:3:{s:1:\"a\";i:94;s:1:\"b\";s:29:\"replicate_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:94;a:3:{s:1:\"a\";i:95;s:1:\"b\";s:27:\"reorder_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:95;a:3:{s:1:\"a\";i:96;s:1:\"b\";s:26:\"delete_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:96;a:3:{s:1:\"a\";i:97;s:1:\"b\";s:30:\"delete_any_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:97;a:3:{s:1:\"a\";i:98;s:1:\"b\";s:32:\"force_delete_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:98;a:3:{s:1:\"a\";i:99;s:1:\"b\";s:36:\"force_delete_any_level::verification\";s:1:\"c\";s:5:\"web 2\";}i:99;a:3:{s:1:\"a\";i:100;s:1:\"b\";s:12:\"view_request\";s:1:\"c\";s:5:\"web 2\";}i:100;a:3:{s:1:\"a\";i:101;s:1:\"b\";s:16:\"view_any_request\";s:1:\"c\";s:5:\"web 2\";}i:101;a:3:{s:1:\"a\";i:102;s:1:\"b\";s:14:\"create_request\";s:1:\"c\";s:5:\"web 2\";}i:102;a:3:{s:1:\"a\";i:103;s:1:\"b\";s:14:\"update_request\";s:1:\"c\";s:5:\"web 2\";}i:103;a:3:{s:1:\"a\";i:104;s:1:\"b\";s:14:\"delete_request\";s:1:\"c\";s:5:\"web 2\";}i:104;a:3:{s:1:\"a\";i:105;s:1:\"b\";s:18:\"delete_any_request\";s:1:\"c\";s:5:\"web 2\";}i:105;a:3:{s:1:\"a\";i:106;s:1:\"b\";s:15:\"publish_request\";s:1:\"c\";s:5:\"web 2\";}i:106;a:3:{s:1:\"a\";i:107;s:1:\"b\";s:9:\"view_role\";s:1:\"c\";s:5:\"web 2\";}i:107;a:3:{s:1:\"a\";i:108;s:1:\"b\";s:13:\"view_any_role\";s:1:\"c\";s:5:\"web 2\";}i:108;a:3:{s:1:\"a\";i:109;s:1:\"b\";s:11:\"create_role\";s:1:\"c\";s:5:\"web 2\";}i:109;a:3:{s:1:\"a\";i:110;s:1:\"b\";s:11:\"update_role\";s:1:\"c\";s:5:\"web 2\";}i:110;a:3:{s:1:\"a\";i:111;s:1:\"b\";s:11:\"delete_role\";s:1:\"c\";s:5:\"web 2\";}i:111;a:3:{s:1:\"a\";i:112;s:1:\"b\";s:15:\"delete_any_role\";s:1:\"c\";s:5:\"web 2\";}i:112;a:3:{s:1:\"a\";i:113;s:1:\"b\";s:10:\"view_roles\";s:1:\"c\";s:5:\"web 2\";}i:113;a:3:{s:1:\"a\";i:114;s:1:\"b\";s:14:\"view_any_roles\";s:1:\"c\";s:5:\"web 2\";}i:114;a:3:{s:1:\"a\";i:115;s:1:\"b\";s:12:\"create_roles\";s:1:\"c\";s:5:\"web 2\";}i:115;a:3:{s:1:\"a\";i:116;s:1:\"b\";s:12:\"update_roles\";s:1:\"c\";s:5:\"web 2\";}i:116;a:3:{s:1:\"a\";i:117;s:1:\"b\";s:13:\"restore_roles\";s:1:\"c\";s:5:\"web 2\";}i:117;a:3:{s:1:\"a\";i:118;s:1:\"b\";s:17:\"restore_any_roles\";s:1:\"c\";s:5:\"web 2\";}i:118;a:3:{s:1:\"a\";i:119;s:1:\"b\";s:15:\"replicate_roles\";s:1:\"c\";s:5:\"web 2\";}i:119;a:3:{s:1:\"a\";i:120;s:1:\"b\";s:13:\"reorder_roles\";s:1:\"c\";s:5:\"web 2\";}i:120;a:3:{s:1:\"a\";i:121;s:1:\"b\";s:12:\"delete_roles\";s:1:\"c\";s:5:\"web 2\";}i:121;a:3:{s:1:\"a\";i:122;s:1:\"b\";s:16:\"delete_any_roles\";s:1:\"c\";s:5:\"web 2\";}i:122;a:3:{s:1:\"a\";i:123;s:1:\"b\";s:18:\"force_delete_roles\";s:1:\"c\";s:5:\"web 2\";}i:123;a:3:{s:1:\"a\";i:124;s:1:\"b\";s:22:\"force_delete_any_roles\";s:1:\"c\";s:5:\"web 2\";}i:124;a:4:{s:1:\"a\";i:125;s:1:\"b\";s:1:\"1\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:125;a:4:{s:1:\"a\";i:126;s:1:\"b\";s:17:\"view_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:126;a:4:{s:1:\"a\";i:127;s:1:\"b\";s:21:\"view_any_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:127;a:4:{s:1:\"a\";i:128;s:1:\"b\";s:19:\"create_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:128;a:4:{s:1:\"a\";i:129;s:1:\"b\";s:19:\"update_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:129;a:4:{s:1:\"a\";i:130;s:1:\"b\";s:20:\"restore_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:130;a:4:{s:1:\"a\";i:131;s:1:\"b\";s:24:\"restore_any_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:131;a:4:{s:1:\"a\";i:132;s:1:\"b\";s:22:\"replicate_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:132;a:4:{s:1:\"a\";i:133;s:1:\"b\";s:20:\"reorder_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:133;a:4:{s:1:\"a\";i:134;s:1:\"b\";s:19:\"delete_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:134;a:4:{s:1:\"a\";i:135;s:1:\"b\";s:23:\"delete_any_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:135;a:4:{s:1:\"a\";i:136;s:1:\"b\";s:25:\"force_delete_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:136;a:4:{s:1:\"a\";i:137;s:1:\"b\";s:29:\"force_delete_any_verification\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:137;a:4:{s:1:\"a\";i:138;s:1:\"b\";s:1:\"3\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:138;a:4:{s:1:\"a\";i:139;s:1:\"b\";s:15:\"restore_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:139;a:4:{s:1:\"a\";i:140;s:1:\"b\";s:19:\"restore_any_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:140;a:4:{s:1:\"a\";i:141;s:1:\"b\";s:17:\"replicate_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:141;a:4:{s:1:\"a\";i:142;s:1:\"b\";s:15:\"reorder_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:142;a:4:{s:1:\"a\";i:143;s:1:\"b\";s:20:\"force_delete_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:143;a:4:{s:1:\"a\";i:144;s:1:\"b\";s:24:\"force_delete_any_request\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:144;a:4:{s:1:\"a\";i:145;s:1:\"b\";s:18:\"view_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:145;a:4:{s:1:\"a\";i:146;s:1:\"b\";s:22:\"view_any_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:146;a:4:{s:1:\"a\";i:147;s:1:\"b\";s:20:\"create_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:147;a:4:{s:1:\"a\";i:148;s:1:\"b\";s:20:\"update_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:148;a:4:{s:1:\"a\";i:149;s:1:\"b\";s:21:\"restore_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:149;a:4:{s:1:\"a\";i:150;s:1:\"b\";s:25:\"restore_any_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:150;a:4:{s:1:\"a\";i:151;s:1:\"b\";s:23:\"replicate_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:151;a:4:{s:1:\"a\";i:152;s:1:\"b\";s:21:\"reorder_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:152;a:4:{s:1:\"a\";i:153;s:1:\"b\";s:20:\"delete_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:153;a:4:{s:1:\"a\";i:154;s:1:\"b\";s:24:\"delete_any_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:154;a:4:{s:1:\"a\";i:155;s:1:\"b\";s:26:\"force_delete_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:155;a:4:{s:1:\"a\";i:156;s:1:\"b\";s:30:\"force_delete_any_verif::agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:156;a:4:{s:1:\"a\";i:157;s:1:\"b\";s:11:\"view_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:157;a:4:{s:1:\"a\";i:158;s:1:\"b\";s:15:\"view_any_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:158;a:4:{s:1:\"a\";i:159;s:1:\"b\";s:13:\"create_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:159;a:4:{s:1:\"a\";i:160;s:1:\"b\";s:13:\"update_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:160;a:4:{s:1:\"a\";i:161;s:1:\"b\";s:14:\"restore_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:161;a:4:{s:1:\"a\";i:162;s:1:\"b\";s:18:\"restore_any_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:162;a:4:{s:1:\"a\";i:163;s:1:\"b\";s:16:\"replicate_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:163;a:4:{s:1:\"a\";i:164;s:1:\"b\";s:14:\"reorder_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:164;a:4:{s:1:\"a\";i:165;s:1:\"b\";s:13:\"delete_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:165;a:4:{s:1:\"a\";i:166;s:1:\"b\";s:17:\"delete_any_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:166;a:4:{s:1:\"a\";i:167;s:1:\"b\";s:19:\"force_delete_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:167;a:4:{s:1:\"a\";i:168;s:1:\"b\";s:23:\"force_delete_any_agenda\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}}s:5:\"roles\";a:3:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";s:1:\"j\";i:1;}i:1;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"Ketua Sekretariat\";s:1:\"c\";s:3:\"web\";s:1:\"j\";i:3;}i:2;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:17:\"Admin Sekretariat\";s:1:\"c\";s:3:\"web\";s:1:\"j\";i:2;}}}', 1743326488);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `name`, `created_at`, `updated_at`, `content`) VALUES
(2, 'Baptis Anak', '2025-03-14 05:28:12', '2025-03-29 02:33:32', '<p>Bagi para orang tua yang hendak membaptiskan anaknya, harap mengisi Formulir Permohonan Baptis Anak secara <strong>digital</strong> dengan melampirkan berkas sebagai berikut:&nbsp;</p><ol><li>Akta Kelahiran Anak&nbsp;</li><li>Scan Surat Pengantar dari Gereja Asal (Jika kedua orangtua bukan anggota jemaat GKJ Manahan)</li></ol>'),
(3, 'Baptis Dewasa Dan Pengakuan Percaya (SIDI)', '2025-03-14 05:28:12', '2025-03-29 02:36:21', '<p>Jemaat maupun simpatisan Gereja yang sudah siap untuk mengikuti program Katekisasi ini, harap memperhatikan ketentuan sebagai berikut : &nbsp;</p><ol><li>Usia peserta minimal 16 tahun&nbsp;</li><li>Telah menyelesaikan katekisasi persiapan baptis dewasa/sidi.&nbsp;</li></ol><p>Selanjutnya, silakan mengisi Formulir Permohonan secara <strong>digital</strong> dengan melampirkan berkas sebagai berikut: &nbsp;</p><ol><li>&nbsp;Pasfoto ukuran 3x4 (berwarna)</li><li>&nbsp;Scan surat Baptis Anak (bagi yang sudah)&nbsp;</li><li>&nbsp;Surat pengantar dari Gereja asal (jika peserta dari gereja lain).&nbsp;</li></ol>'),
(4, 'Pernikahan', '2025-03-14 05:28:12', '2025-03-16 07:51:18', '<p>Anggota Jemaat GKJ Manahan maupun Simpatisan yang akan melangsungkan pernikahan di GKJ Manahan maupun di Gereja lain dimohon memperhatikan ketentuan tersebut di bawah ini: &nbsp;</p><ol><li>Kedua calon mempelai adalah anggota Jemaat GKJ atau seorang diantaranya adalah anggota Jemaat GKJ yang tidak berada di bawah penggembalaan khusus.&nbsp;</li><li>&nbsp;Mengajukan permohonan kepada Majelis GKJ Manahan minimal 3 bulan sebelum pelaksanaan pernikahan dengan menyerahkan dokumen &nbsp;<ul><li>&nbsp;Mengisi formulir yang tersedia&nbsp;</li><li>&nbsp;Surat Pengantar/Pelimpahan bagi yang bukan anggota GKJ Manahan&nbsp;</li><li>&nbsp;Fotocopy Surat Baptis atau Sidi&nbsp;</li><li>&nbsp;Fotocopy Sertifikat Pembinaan Pranikah&nbsp;</li><li>&nbsp;Pasphoto berwarna ukuran 4x6 (2 lembar posisi berdampingan)&nbsp;</li></ul></li><li>&nbsp;Ketentuan dalam butir 2 diatas, berlaku bagi setiap pemohon yang pernikahannya dilayani di GKJ Manahan atau MEMINTA DILAYANI DI GEREJA LAIN.&nbsp;</li><li>&nbsp;Formulir yang sudah lengkap diserahkan ke kantor Gereja dan kedua calon mempelai diwajibkan menghadap Pendeta untuk mendapatkan pengarahan.&nbsp;</li><li>&nbsp;Sebagai kewajiban dan sekaligus pembekalan bagi anggota jemaat yang akan menikah maka setiap pasangan diwajibkan mengikuti KATEKISASI PRANIKAH. Untuk Jadualnya Katekisasi bisa menyesuaikan jadual yang sudah diatur. &nbsp;</li><li>&nbsp;Jemaat yang menghendaki pelayanan Pendeta dapat mengajukan permohonan kepada Majelis GKJ Manahan.&nbsp;</li><li>&nbsp;Kebaktian pernikahan dapat dilaksanakan antara hari senin s/d sabtu. Apabila hari Minggu harus ada persetujuan dari pihak Majelis. &nbsp;</li><li>&nbsp;Penjelasan lengkap dan hal-hal lain yang berhubungan dengan pernikahan dapat ditanyakan melalui Kantor Gereja pada jam kerja &nbsp;</li><li>&nbsp;Bila menghadapi permasalahan, sebaiknya menemui pendeta agar mendapatkan bimbingan / pengarahan yang benar.&nbsp;</li><li>&nbsp;Untuk pelaksanaan pernikahan menurut ATURAN NEGARA (BS/Catatan Sipil), dipersilahkan Jemaat langsung datang ke Kantor Gereja Sipil (sesuai dengan domisili). &nbsp;</li></ol><p>&nbsp;Download/Ungguh: <a href=\"https://www.gkjmanahan.org/files/Permohonan_Pemberkatan_Nikah.doc\"><strong><em>Surat Permohonan Pemberkatan Pernikahan Gerejawi</em></strong></a></p>'),
(5, 'Pindah Anggota Jemaat Gereja Lain ke Gereja Manahan (Attestasi Masuk)', '2025-03-14 05:28:13', '2025-03-23 03:55:43', '<p>Jemaat Gereja lain yang ingin menjadi anggota GKJ Manahan supaya menyerahkan surat atestasinya kepada Majelis Jemaat melalui Kantor Gereja, dengan persyaratan :&nbsp;</p><ol><li>&nbsp;Membawa surat pindah/atestasi dari Gereja asal&nbsp;</li><li>&nbsp;Fotocopy surat Baptis/Sidi&nbsp;</li><li>&nbsp;Fotocopy surat nikah &amp; catatan sipil&nbsp;</li><li>&nbsp;Kartu Keluarga (KK)&nbsp;</li><li>&nbsp;Berkas kelengkapan diserahkan ke Kantor Gereja&nbsp;</li></ol><p>&nbsp;Download/Unduh: <a href=\"https://gkjmanahan.org/files/Blanko_Ingin_Menjadi_Warga_0.doc\"><strong><em>Formulir Menjadi Anggota GKJ Manahan</em></strong></a></p>'),
(6, 'Pindah Anggota Jemaat GKJ Manahan ke Gereja Lain (Attestasi Keluar)', '2025-03-14 05:28:13', '2025-03-23 03:58:21', '<p>Anggota Jemaat GKJ Manahan yang ingin pindah ke Gereja lain dimohon :&nbsp;</p><ol><li>Mengisi formulir pindah anggota (yang tersedia) sekaligus memberitahukan secara lisan kepindahannya kepada Majelis Bloknya.&nbsp;</li><li>Mengembalikan formulir tersebut kepada Kantor Gereja&nbsp;</li></ol><p>&nbsp;Download/Ungguh: <a href=\"https://gkjmanahan.org/files/Blanko_Attestasi.doc\"><strong><em>Surat Permohonan Attestasi Keluar</em></strong></a></p>');

-- --------------------------------------------------------

--
-- Table structure for table `form_pertanyaans`
--

CREATE TABLE `form_pertanyaans` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` bigint UNSIGNED NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `tipe_jawaban` enum('text','textarea','select','checkbox','radio','header') NOT NULL,
  `opsi_jawaban` json DEFAULT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_pertanyaans`
--

INSERT INTO `form_pertanyaans` (`id`, `form_id`, `pertanyaan`, `tipe_jawaban`, `opsi_jawaban`, `required`, `order`, `created_at`, `updated_at`) VALUES
(1, 2, 'Berkenaan dengan akan dilaksanakannya Sakaramen Baptis Anak besok pada :', 'header', NULL, 0, 1, '2025-03-27 00:26:59', '2025-03-27 00:54:50'),
(2, 2, 'Hari/Tanggal', 'text', NULL, 1, 2, '2025-03-27 00:28:23', '2025-03-27 00:28:23'),
(3, 2, 'Jam', 'text', NULL, 1, 3, '2025-03-27 00:28:36', '2025-03-27 00:28:36'),
(4, 2, 'Di', 'text', NULL, 1, 4, '2025-03-27 00:28:53', '2025-03-27 00:28:53'),
(5, 2, 'Perkenankanlah kami', 'header', NULL, 0, 5, '2025-03-27 00:29:04', '2025-03-27 00:57:00'),
(6, 2, 'Nama', 'text', NULL, 1, 6, '2025-03-27 00:29:21', '2025-03-27 00:57:04'),
(7, 2, 'Tempat/Tanggal Lahir', 'text', NULL, 1, 7, '2025-03-27 00:29:37', '2025-03-27 00:57:08'),
(8, 2, 'Pekerjaan', 'text', NULL, 1, 8, '2025-03-27 00:29:59', '2025-03-27 07:26:10'),
(9, 2, 'Alamat', 'textarea', NULL, 1, 9, '2025-03-27 01:21:53', '2025-03-27 01:21:53'),
(10, 2, 'HP/Telepon', 'text', '[{\"label\": \"Laki - laki\"}, {\"label\": \"Perempuan\"}]', 1, 11, '2025-03-27 02:10:19', '2025-03-27 07:53:26'),
(11, 2, 'Warga Blok/Pepanthan', 'text', '[{\"label\": \"1\"}, {\"label\": \"2\"}, {\"label\": \"3\"}]', 1, 10, '2025-03-27 02:40:26', '2025-03-27 07:53:31'),
(12, 2, 'Email', 'text', '[{\"label\": \"w\"}, {\"label\": \"a\"}]', 1, 12, '2025-03-27 02:41:17', '2025-03-27 07:26:26'),
(13, 2, 'Nama', 'text', NULL, 0, 14, '2025-03-27 07:33:37', '2025-03-27 07:56:03'),
(14, 2, 'Tempat/Tanggal Lahir', 'text', NULL, 1, 15, '2025-03-27 07:33:53', '2025-03-27 07:55:29'),
(15, 2, 'Pekerjaan', 'text', NULL, 1, 16, '2025-03-27 07:34:05', '2025-03-27 07:55:24'),
(16, 2, 'Alamat', 'textarea', NULL, 1, 17, '2025-03-27 07:35:12', '2025-03-27 07:55:20'),
(17, 2, 'Dengan ini saya mengajukan permohonan Sakramen Baptis Anak, atas diri anak kami.', 'header', NULL, 0, 18, '2025-03-27 07:35:30', '2025-03-27 07:55:16'),
(18, 2, 'Nama', 'text', NULL, 1, 19, '2025-03-27 07:35:57', '2025-03-27 07:55:11'),
(19, 2, 'Tempat/Tanggal Lahir', 'text', NULL, 1, 20, '2025-03-27 07:36:14', '2025-03-27 07:55:11'),
(20, 2, 'Jenis Kelamin', 'select', '[{\"label\": \"Laki - laki\"}, {\"label\": \"Perempuan\"}]', 1, 21, '2025-03-27 07:37:01', '2025-03-27 07:55:07'),
(21, 2, 'Besar harapan kami, Majelis GKJ Manahan berkenan atas permohonan kami ini.', 'header', NULL, 1, 22, '2025-03-27 07:37:42', '2025-03-27 07:55:07'),
(22, 2, 'Atas perhatian dan perkenaannya, kami ucapkan terima kasih.', 'header', NULL, 1, 23, '2025-03-27 07:37:59', '2025-03-27 07:55:02'),
(23, 2, 'Perkenankanlah kami Suami/Istri', 'header', NULL, 0, 13, '2025-03-27 07:54:38', '2025-03-27 07:55:45'),
(24, 3, 'Berkenaan dengan akan dilaksanakannya Sakaramen Baptis/Sidi*) besok pada :', 'header', NULL, 0, 1, '2025-03-27 00:26:59', '2025-03-29 02:37:02'),
(25, 3, 'Hari/Tanggal', 'text', NULL, 1, 2, '2025-03-27 00:28:23', '2025-03-27 00:28:23'),
(26, 3, 'Jam', 'text', NULL, 1, 3, '2025-03-27 00:28:36', '2025-03-27 00:28:36'),
(27, 3, 'Di', 'text', NULL, 1, 4, '2025-03-27 00:28:53', '2025-03-27 00:28:53'),
(28, 3, 'Perkenankanlah saya', 'header', NULL, 0, 5, '2025-03-27 00:29:04', '2025-03-29 04:46:56'),
(29, 3, 'Nama', 'text', NULL, 1, 6, '2025-03-27 00:29:21', '2025-03-27 00:57:04'),
(30, 3, 'Tempat/Tanggal Lahir', 'text', NULL, 1, 7, '2025-03-27 00:29:37', '2025-03-27 00:57:08'),
(31, 3, 'Oleh', 'text', NULL, 1, 21, '2025-03-27 00:29:59', '2025-03-29 05:03:44'),
(32, 3, 'Alamat', 'textarea', NULL, 1, 14, '2025-03-27 01:21:53', '2025-03-29 04:53:58'),
(33, 3, 'HP/Telepon', 'text', '[{\"label\": \"Laki - laki\"}, {\"label\": \"Perempuan\"}]', 1, 12, '2025-03-27 02:10:19', '2025-03-29 04:53:42'),
(34, 3, 'Warga Blok/Pepanthan', 'text', '[{\"label\": \"1\"}, {\"label\": \"2\"}, {\"label\": \"3\"}]', 1, 15, '2025-03-27 02:40:26', '2025-03-29 04:54:40'),
(35, 3, 'Email', 'text', '[{\"label\": \"w\"}, {\"label\": \"a\"}]', 1, 13, '2025-03-27 02:41:17', '2025-03-29 04:53:55'),
(36, 3, 'Nama Lengkap Ayah', 'text', NULL, 1, 10, '2025-03-27 07:33:37', '2025-03-29 05:01:03'),
(38, 3, 'Pekerjaan/Pendidikan', 'text', NULL, 1, 9, '2025-03-27 07:34:05', '2025-03-29 04:51:42'),
(40, 3, 'BAGI YANG SIDI', 'header', NULL, 0, 18, '2025-03-27 07:35:30', '2025-03-29 05:00:54'),
(41, 3, 'Nama Lengkap Ibu', 'text', NULL, 1, 11, '2025-03-27 07:35:57', '2025-03-29 04:53:09'),
(42, 3, 'Baptis Kecil tanggal', 'text', NULL, 1, 19, '2025-03-27 07:36:14', '2025-03-29 05:01:44'),
(43, 3, 'Jenis Kelamin', 'select', '[{\"label\": \"Laki - laki\"}, {\"label\": \"Perempuan\"}]', 1, 8, '2025-03-27 07:37:01', '2025-03-29 04:50:35'),
(44, 3, 'Di Gereja', 'text', NULL, 1, 20, '2025-03-27 07:37:42', '2025-03-29 05:02:49'),
(45, 3, 'Atas perhatian dan perkenaannya, kami ucapkan terima kasih.', 'header', NULL, 0, 24, '2025-03-27 07:37:59', '2025-03-29 05:05:27'),
(47, 3, 'Pengasuh/Tempat Katekisasi', 'text', NULL, 1, 16, '2025-03-29 04:56:55', '2025-03-29 04:58:40'),
(48, 3, 'Lama Katekisasi', 'text', NULL, 1, 17, '2025-03-29 04:57:56', '2025-03-29 04:58:44'),
(49, 3, 'Dengan ini saya mengajukan Baptis Dewasa/Sidi *)', 'header', NULL, 0, 22, '2025-03-29 05:04:18', '2025-03-29 05:05:18'),
(50, 3, 'Besar harapan saya, Majelis GKJ Manahan meluluskan permohonan saya ini.', 'header', NULL, 0, 23, '2025-03-29 05:04:41', '2025-03-29 05:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `form_pertanyaan_options`
--

CREATE TABLE `form_pertanyaan_options` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level_verifications`
--

CREATE TABLE `level_verifications` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `level_verifications`
--

INSERT INTO `level_verifications` (`id`, `name`, `order`, `created_at`, `updated_at`) VALUES
(1, 'None', 0, '2025-03-12 23:59:48', '2025-03-12 23:59:48'),
(2, 'Verifikator 1', 1, '2025-03-12 23:59:48', '2025-03-12 23:59:48'),
(3, 'Verifikator 2', 2, '2025-03-12 23:59:48', '2025-03-12 23:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `list_upload_forms`
--

CREATE TABLE `list_upload_forms` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `upload_type` varchar(255) NOT NULL,
  `is_required` char(255) NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_upload_forms`
--

INSERT INTO `list_upload_forms` (`id`, `form_id`, `name`, `order`, `created_at`, `updated_at`, `upload_type`, `is_required`, `deleted_at`) VALUES
(2, 2, 'Scan Formulir', 1, '2025-03-14 05:28:13', '2025-03-29 02:32:18', 'pdf', '1', '2025-03-29 09:32:18'),
(3, 2, 'Scan Akta Kelahiran Anak', 2, '2025-03-14 05:28:13', '2025-03-14 06:48:05', 'pdf', '1', NULL),
(4, 2, 'Scan Akta Pernikahan Gerejawi', 3, '2025-03-14 05:28:13', '2025-03-26 22:28:58', 'pdf', '1', '2025-03-27 05:28:58'),
(5, 2, 'Scan Catatan Sipil Kedua Orang Tua', 4, '2025-03-14 05:28:13', '2025-03-26 22:28:58', 'pdf', '1', '2025-03-27 05:28:58'),
(6, 2, 'Scan Surat Pengantar dari Gereja Asal (Jika kedua orangtua bukan anggota jemaat GKJ Manahan)', 3, '2025-03-14 05:28:13', '2025-03-26 21:53:26', 'pdf', '', NULL),
(7, 3, 'Scan Formulir', 1, '2025-03-14 05:28:13', '2025-03-29 05:29:45', 'pdf', '1', '2025-03-29 12:29:45'),
(8, 3, 'Pasfoto Berwarna Ukuran 3x4', 2, '2025-03-14 05:28:13', '2025-03-23 04:00:53', 'image', '1', NULL),
(9, 3, 'Scan Surat Baptis Anak (Bagi yang sudah)', 3, '2025-03-14 05:28:14', '2025-03-14 05:28:14', 'pdf', '', NULL),
(10, 3, 'Scan Surat Pengantar dari Gereja Asal (Jika peserta dari gereja lain)', 4, '2025-03-14 05:28:14', '2025-03-14 05:28:14', 'pdf', '', NULL),
(11, 4, 'Scan Formulir', 1, '2025-03-14 05:28:14', '2025-03-23 03:59:39', 'pdf', '1', NULL),
(12, 4, 'Scan Surat Pengantar/Pelimpahan (Bagi yang bukan anggota GKJ Manahan)', 2, '2025-03-14 05:28:14', '2025-03-14 05:28:14', 'pdf', '', NULL),
(13, 4, 'Scan Surat Baptis atau Sidi', 3, '2025-03-14 05:28:14', '2025-03-23 03:59:40', 'pdf', '1', NULL),
(14, 4, 'Scan Sertifikat Pembinaan Pranikah', 4, '2025-03-14 05:28:14', '2025-03-23 03:59:40', 'pdf', '1', NULL),
(15, 4, 'Pasfoto Berwarna Ukuran 4x6 ', 5, '2025-03-14 05:28:14', '2025-03-23 03:59:40', 'image', '1', NULL),
(16, 5, 'Scan Formulir', 1, '2025-03-14 05:28:14', '2025-03-14 22:30:31', 'pdf', '1', NULL),
(17, 5, 'Scan Surat Pindah/Atestasi dari Gereja Asal ', 2, '2025-03-14 05:28:14', '2025-03-14 22:30:31', 'pdf', '1', NULL),
(18, 5, 'Scan Surat Baptis/Sidi ', 3, '2025-03-14 05:28:15', '2025-03-14 22:30:32', 'pdf', '1', NULL),
(19, 5, 'Scan Surat Nikah', 4, '2025-03-14 05:28:15', '2025-03-14 05:28:15', 'pdf', '', NULL),
(20, 5, 'Scan Catatan Sipil ', 5, '2025-03-14 05:28:15', '2025-03-14 05:28:15', 'pdf', '', NULL),
(21, 5, 'Scan Kartu Keluarga (KK)  ', 6, '2025-03-14 05:28:15', '2025-03-14 22:30:32', 'pdf', '1', NULL),
(22, 6, 'Scan Formulir', 1, '2025-03-14 05:28:15', '2025-03-23 03:58:19', 'pdf', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '0_1_2025_03_02_144608_create_level_verifications_table', 1),
(5, '0_3_2025_03_02_144618_create_forms_table', 1),
(6, '0_4_2025_03_02_144628_create_request_statuses_table', 1),
(7, '0_5_2025_03_02_144651_create_verification_statuses_table', 1),
(8, '0_6_2025_03_02_144706_create_users_table', 1),
(9, '0_7_2025_03_02_144638_create_requests_table', 1),
(10, '0_8_2025_03_02_144706_create_verifications_table', 1),
(11, '2025_03_031_120348_create_list_upload_forms_table', 1),
(12, '2025_03_033_144735_create_upload_files_table', 1),
(13, '2025_03_04_081934_remove_field_from_forms', 1),
(14, '2025_03_04_104920_edit_field_from_list_upload_forms', 1),
(15, '2025_03_05_083816_edit_tabel_upload_files', 1),
(16, '2025_03_10_140007_edit__list_upload_form', 1),
(17, '2025_03_12_140804_add_column_to_roles_table', 1),
(20, '0_2_2025_03_12_134950_create_permission_tables', 2),
(22, '2025_03_14_034509_edit_forms_table', 3),
(24, '2025_03_14_125613_update_form_id_cascade_on_list_upload_forms', 4),
(27, '2025_03_15_080609_update_verifications', 5),
(28, '2025_03_22_103459_edit_request', 6),
(49, '2025_03_25_045635_create_agendas_table', 7),
(50, '2025_03_25_045715_create_agenda_keterangans_table', 7),
(51, '2025_03_25_062827_create_agenda_jenis_table', 7),
(52, '2025_03_25_072827_create_agenda_details_table', 7),
(53, '2025_03_25_133508_edit__request__form', 8),
(54, '2025_03_26_131610_edit__agendadetail__form', 9),
(55, '2025_03_27_052229_edit__list__upload__form', 10),
(58, '2025_03_27_070211_create_form_pertanyaans_table', 11),
(59, '2025_03_27_070430_create_form_pertanyaan_options_table', 11),
(61, '2025_03_27_102433_edit__request', 12),
(62, '2025_03_28_150903_edit__request', 13);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_form', 'web', '2025-03-13 00:18:07', '2025-03-13 00:18:07'),
(2, 'view_any_form', 'web', '2025-03-13 00:18:08', '2025-03-13 00:18:08'),
(3, 'create_form', 'web', '2025-03-13 00:18:08', '2025-03-13 00:18:08'),
(4, 'update_form', 'web', '2025-03-13 00:18:08', '2025-03-13 00:18:08'),
(5, 'restore_form', 'web', '2025-03-13 00:18:08', '2025-03-13 00:18:08'),
(6, 'restore_any_form', 'web', '2025-03-13 00:18:08', '2025-03-13 00:18:08'),
(7, 'replicate_form', 'web', '2025-03-13 00:18:08', '2025-03-13 00:18:08'),
(8, 'reorder_form', 'web', '2025-03-13 00:18:08', '2025-03-13 00:18:08'),
(9, 'delete_form', 'web', '2025-03-13 00:18:08', '2025-03-13 00:18:08'),
(10, 'delete_any_form', 'web', '2025-03-13 00:18:09', '2025-03-13 00:18:09'),
(11, 'force_delete_form', 'web', '2025-03-13 00:18:09', '2025-03-13 00:18:09'),
(12, 'force_delete_any_form', 'web', '2025-03-13 00:18:09', '2025-03-13 00:18:09'),
(13, 'view_level::verification', 'web', '2025-03-13 00:18:09', '2025-03-13 00:18:09'),
(14, 'view_any_level::verification', 'web', '2025-03-13 00:18:10', '2025-03-13 00:18:10'),
(15, 'create_level::verification', 'web', '2025-03-13 00:18:10', '2025-03-13 00:18:10'),
(16, 'update_level::verification', 'web', '2025-03-13 00:18:10', '2025-03-13 00:18:10'),
(17, 'restore_level::verification', 'web', '2025-03-13 00:18:10', '2025-03-13 00:18:10'),
(18, 'restore_any_level::verification', 'web', '2025-03-13 00:18:10', '2025-03-13 00:18:10'),
(19, 'replicate_level::verification', 'web', '2025-03-13 00:18:10', '2025-03-13 00:18:10'),
(20, 'reorder_level::verification', 'web', '2025-03-13 00:18:10', '2025-03-13 00:18:10'),
(21, 'delete_level::verification', 'web', '2025-03-13 00:18:10', '2025-03-13 00:18:10'),
(22, 'delete_any_level::verification', 'web', '2025-03-13 00:18:11', '2025-03-13 00:18:11'),
(23, 'force_delete_level::verification', 'web', '2025-03-13 00:18:11', '2025-03-13 00:18:11'),
(24, 'force_delete_any_level::verification', 'web', '2025-03-13 00:18:11', '2025-03-13 00:18:11'),
(25, 'view_request', 'web', '2025-03-13 00:18:11', '2025-03-13 00:18:11'),
(26, 'view_any_request', 'web', '2025-03-13 00:18:11', '2025-03-13 00:18:11'),
(27, 'create_request', 'web', '2025-03-13 00:18:11', '2025-03-13 00:18:11'),
(28, 'update_request', 'web', '2025-03-13 00:18:12', '2025-03-13 00:18:12'),
(29, 'delete_request', 'web', '2025-03-13 00:18:12', '2025-03-13 00:18:12'),
(30, 'delete_any_request', 'web', '2025-03-13 00:18:12', '2025-03-13 00:18:12'),
(31, 'publish_request', 'web', '2025-03-13 00:18:12', '2025-03-13 00:18:12'),
(32, 'view_role', 'web', '2025-03-13 00:18:12', '2025-03-13 00:18:12'),
(33, 'view_any_role', 'web', '2025-03-13 00:18:12', '2025-03-13 00:18:12'),
(34, 'create_role', 'web', '2025-03-13 00:18:13', '2025-03-13 00:18:13'),
(35, 'update_role', 'web', '2025-03-13 00:18:13', '2025-03-13 00:18:13'),
(36, 'delete_role', 'web', '2025-03-13 00:18:13', '2025-03-13 00:18:13'),
(37, 'delete_any_role', 'web', '2025-03-13 00:18:13', '2025-03-13 00:18:13'),
(38, 'view_roles', 'web', '2025-03-13 00:18:13', '2025-03-13 00:18:13'),
(39, 'view_any_roles', 'web', '2025-03-13 00:18:14', '2025-03-13 00:18:14'),
(40, 'create_roles', 'web', '2025-03-13 00:18:14', '2025-03-13 00:18:14'),
(41, 'update_roles', 'web', '2025-03-13 00:18:14', '2025-03-13 00:18:14'),
(42, 'restore_roles', 'web', '2025-03-13 00:18:14', '2025-03-13 00:18:14'),
(43, 'restore_any_roles', 'web', '2025-03-13 00:18:14', '2025-03-13 00:18:14'),
(44, 'replicate_roles', 'web', '2025-03-13 00:18:14', '2025-03-13 00:18:14'),
(45, 'reorder_roles', 'web', '2025-03-13 00:18:15', '2025-03-13 00:18:15'),
(46, 'delete_roles', 'web', '2025-03-13 00:18:15', '2025-03-13 00:18:15'),
(47, 'delete_any_roles', 'web', '2025-03-13 00:18:15', '2025-03-13 00:18:15'),
(48, 'force_delete_roles', 'web', '2025-03-13 00:18:15', '2025-03-13 00:18:15'),
(49, 'force_delete_any_roles', 'web', '2025-03-13 00:18:15', '2025-03-13 00:18:15'),
(50, 'view_user', 'web', '2025-03-13 00:18:15', '2025-03-13 00:18:15'),
(51, 'view_any_user', 'web', '2025-03-13 00:18:16', '2025-03-13 00:18:16'),
(52, 'create_user', 'web', '2025-03-13 00:18:16', '2025-03-13 00:18:16'),
(53, 'update_user', 'web', '2025-03-13 00:18:16', '2025-03-13 00:18:16'),
(54, 'restore_user', 'web', '2025-03-13 00:18:16', '2025-03-13 00:18:16'),
(55, 'restore_any_user', 'web', '2025-03-13 00:18:16', '2025-03-13 00:18:16'),
(56, 'replicate_user', 'web', '2025-03-13 00:18:16', '2025-03-13 00:18:16'),
(57, 'reorder_user', 'web', '2025-03-13 00:18:16', '2025-03-13 00:18:16'),
(58, 'delete_user', 'web', '2025-03-13 00:18:17', '2025-03-13 00:18:17'),
(59, 'delete_any_user', 'web', '2025-03-13 00:18:17', '2025-03-13 00:18:17'),
(60, 'force_delete_user', 'web', '2025-03-13 00:18:17', '2025-03-13 00:18:17'),
(61, 'force_delete_any_user', 'web', '2025-03-13 00:18:17', '2025-03-13 00:18:17'),
(62, '2', 'web', '2025-03-13 00:19:35', '2025-03-13 00:19:35'),
(63, '2', 'web 2', '2025-03-13 07:49:08', '2025-03-13 07:49:08'),
(64, 'view_form', 'web 2', '2025-03-13 07:49:08', '2025-03-13 07:49:08'),
(65, 'view_any_form', 'web 2', '2025-03-13 07:49:08', '2025-03-13 07:49:08'),
(66, 'create_form', 'web 2', '2025-03-13 07:49:08', '2025-03-13 07:49:08'),
(67, 'update_form', 'web 2', '2025-03-13 07:49:08', '2025-03-13 07:49:08'),
(68, 'restore_form', 'web 2', '2025-03-13 07:49:08', '2025-03-13 07:49:08'),
(69, 'restore_any_form', 'web 2', '2025-03-13 07:49:08', '2025-03-13 07:49:08'),
(70, 'replicate_form', 'web 2', '2025-03-13 07:49:09', '2025-03-13 07:49:09'),
(71, 'reorder_form', 'web 2', '2025-03-13 07:49:09', '2025-03-13 07:49:09'),
(72, 'delete_form', 'web 2', '2025-03-13 07:49:09', '2025-03-13 07:49:09'),
(73, 'delete_any_form', 'web 2', '2025-03-13 07:49:09', '2025-03-13 07:49:09'),
(74, 'force_delete_form', 'web 2', '2025-03-13 07:49:09', '2025-03-13 07:49:09'),
(75, 'force_delete_any_form', 'web 2', '2025-03-13 07:49:09', '2025-03-13 07:49:09'),
(76, 'view_user', 'web 2', '2025-03-13 07:49:09', '2025-03-13 07:49:09'),
(77, 'view_any_user', 'web 2', '2025-03-13 07:49:09', '2025-03-13 07:49:09'),
(78, 'create_user', 'web 2', '2025-03-13 07:49:09', '2025-03-13 07:49:09'),
(79, 'update_user', 'web 2', '2025-03-13 07:49:10', '2025-03-13 07:49:10'),
(80, 'restore_user', 'web 2', '2025-03-13 07:49:10', '2025-03-13 07:49:10'),
(81, 'restore_any_user', 'web 2', '2025-03-13 07:49:10', '2025-03-13 07:49:10'),
(82, 'replicate_user', 'web 2', '2025-03-13 07:49:10', '2025-03-13 07:49:10'),
(83, 'reorder_user', 'web 2', '2025-03-13 07:49:10', '2025-03-13 07:49:10'),
(84, 'delete_user', 'web 2', '2025-03-13 07:49:10', '2025-03-13 07:49:10'),
(85, 'delete_any_user', 'web 2', '2025-03-13 07:49:10', '2025-03-13 07:49:10'),
(86, 'force_delete_user', 'web 2', '2025-03-13 07:49:10', '2025-03-13 07:49:10'),
(87, 'force_delete_any_user', 'web 2', '2025-03-13 07:49:10', '2025-03-13 07:49:10'),
(88, 'view_level::verification', 'web 2', '2025-03-13 08:26:30', '2025-03-13 08:26:30'),
(89, 'view_any_level::verification', 'web 2', '2025-03-13 08:26:30', '2025-03-13 08:26:30'),
(90, 'create_level::verification', 'web 2', '2025-03-13 08:26:30', '2025-03-13 08:26:30'),
(91, 'update_level::verification', 'web 2', '2025-03-13 08:26:30', '2025-03-13 08:26:30'),
(92, 'restore_level::verification', 'web 2', '2025-03-13 08:26:30', '2025-03-13 08:26:30'),
(93, 'restore_any_level::verification', 'web 2', '2025-03-13 08:26:31', '2025-03-13 08:26:31'),
(94, 'replicate_level::verification', 'web 2', '2025-03-13 08:26:31', '2025-03-13 08:26:31'),
(95, 'reorder_level::verification', 'web 2', '2025-03-13 08:26:31', '2025-03-13 08:26:31'),
(96, 'delete_level::verification', 'web 2', '2025-03-13 08:26:31', '2025-03-13 08:26:31'),
(97, 'delete_any_level::verification', 'web 2', '2025-03-13 08:26:31', '2025-03-13 08:26:31'),
(98, 'force_delete_level::verification', 'web 2', '2025-03-13 08:26:31', '2025-03-13 08:26:31'),
(99, 'force_delete_any_level::verification', 'web 2', '2025-03-13 08:26:31', '2025-03-13 08:26:31'),
(100, 'view_request', 'web 2', '2025-03-13 08:26:32', '2025-03-13 08:26:32'),
(101, 'view_any_request', 'web 2', '2025-03-13 08:26:32', '2025-03-13 08:26:32'),
(102, 'create_request', 'web 2', '2025-03-13 08:26:32', '2025-03-13 08:26:32'),
(103, 'update_request', 'web 2', '2025-03-13 08:26:32', '2025-03-13 08:26:32'),
(104, 'delete_request', 'web 2', '2025-03-13 08:26:32', '2025-03-13 08:26:32'),
(105, 'delete_any_request', 'web 2', '2025-03-13 08:26:32', '2025-03-13 08:26:32'),
(106, 'publish_request', 'web 2', '2025-03-13 08:26:32', '2025-03-13 08:26:32'),
(107, 'view_role', 'web 2', '2025-03-13 08:26:32', '2025-03-13 08:26:32'),
(108, 'view_any_role', 'web 2', '2025-03-13 08:26:32', '2025-03-13 08:26:32'),
(109, 'create_role', 'web 2', '2025-03-13 08:26:33', '2025-03-13 08:26:33'),
(110, 'update_role', 'web 2', '2025-03-13 08:26:33', '2025-03-13 08:26:33'),
(111, 'delete_role', 'web 2', '2025-03-13 08:26:33', '2025-03-13 08:26:33'),
(112, 'delete_any_role', 'web 2', '2025-03-13 08:26:33', '2025-03-13 08:26:33'),
(113, 'view_roles', 'web 2', '2025-03-13 08:26:33', '2025-03-13 08:26:33'),
(114, 'view_any_roles', 'web 2', '2025-03-13 08:26:33', '2025-03-13 08:26:33'),
(115, 'create_roles', 'web 2', '2025-03-13 08:26:33', '2025-03-13 08:26:33'),
(116, 'update_roles', 'web 2', '2025-03-13 08:26:33', '2025-03-13 08:26:33'),
(117, 'restore_roles', 'web 2', '2025-03-13 08:26:33', '2025-03-13 08:26:33'),
(118, 'restore_any_roles', 'web 2', '2025-03-13 08:26:34', '2025-03-13 08:26:34'),
(119, 'replicate_roles', 'web 2', '2025-03-13 08:26:34', '2025-03-13 08:26:34'),
(120, 'reorder_roles', 'web 2', '2025-03-13 08:26:34', '2025-03-13 08:26:34'),
(121, 'delete_roles', 'web 2', '2025-03-13 08:26:34', '2025-03-13 08:26:34'),
(122, 'delete_any_roles', 'web 2', '2025-03-13 08:26:34', '2025-03-13 08:26:34'),
(123, 'force_delete_roles', 'web 2', '2025-03-13 08:26:34', '2025-03-13 08:26:34'),
(124, 'force_delete_any_roles', 'web 2', '2025-03-13 08:26:34', '2025-03-13 08:26:34'),
(125, '1', 'web', '2025-03-14 08:28:31', '2025-03-14 08:28:31'),
(126, 'view_verification', 'web', '2025-03-14 08:28:32', '2025-03-14 08:28:32'),
(127, 'view_any_verification', 'web', '2025-03-14 08:28:32', '2025-03-14 08:28:32'),
(128, 'create_verification', 'web', '2025-03-14 08:28:32', '2025-03-14 08:28:32'),
(129, 'update_verification', 'web', '2025-03-14 08:28:32', '2025-03-14 08:28:32'),
(130, 'restore_verification', 'web', '2025-03-14 08:28:32', '2025-03-14 08:28:32'),
(131, 'restore_any_verification', 'web', '2025-03-14 08:28:32', '2025-03-14 08:28:32'),
(132, 'replicate_verification', 'web', '2025-03-14 08:28:32', '2025-03-14 08:28:32'),
(133, 'reorder_verification', 'web', '2025-03-14 08:28:32', '2025-03-14 08:28:32'),
(134, 'delete_verification', 'web', '2025-03-14 08:28:32', '2025-03-14 08:28:32'),
(135, 'delete_any_verification', 'web', '2025-03-14 08:28:33', '2025-03-14 08:28:33'),
(136, 'force_delete_verification', 'web', '2025-03-14 08:28:33', '2025-03-14 08:28:33'),
(137, 'force_delete_any_verification', 'web', '2025-03-14 08:28:33', '2025-03-14 08:28:33'),
(138, '3', 'web', '2025-03-15 03:29:32', '2025-03-15 03:29:32'),
(139, 'restore_request', 'web', '2025-03-15 03:29:33', '2025-03-15 03:29:33'),
(140, 'restore_any_request', 'web', '2025-03-15 03:29:33', '2025-03-15 03:29:33'),
(141, 'replicate_request', 'web', '2025-03-15 03:29:33', '2025-03-15 03:29:33'),
(142, 'reorder_request', 'web', '2025-03-15 03:29:33', '2025-03-15 03:29:33'),
(143, 'force_delete_request', 'web', '2025-03-15 03:29:33', '2025-03-15 03:29:33'),
(144, 'force_delete_any_request', 'web', '2025-03-15 03:29:34', '2025-03-15 03:29:34'),
(145, 'view_verif::agenda', 'web', '2025-03-25 00:14:33', '2025-03-25 00:14:33'),
(146, 'view_any_verif::agenda', 'web', '2025-03-25 00:14:34', '2025-03-25 00:14:34'),
(147, 'create_verif::agenda', 'web', '2025-03-25 00:14:34', '2025-03-25 00:14:34'),
(148, 'update_verif::agenda', 'web', '2025-03-25 00:14:34', '2025-03-25 00:14:34'),
(149, 'restore_verif::agenda', 'web', '2025-03-25 00:14:34', '2025-03-25 00:14:34'),
(150, 'restore_any_verif::agenda', 'web', '2025-03-25 00:14:35', '2025-03-25 00:14:35'),
(151, 'replicate_verif::agenda', 'web', '2025-03-25 00:14:35', '2025-03-25 00:14:35'),
(152, 'reorder_verif::agenda', 'web', '2025-03-25 00:14:35', '2025-03-25 00:14:35'),
(153, 'delete_verif::agenda', 'web', '2025-03-25 00:14:35', '2025-03-25 00:14:35'),
(154, 'delete_any_verif::agenda', 'web', '2025-03-25 00:14:35', '2025-03-25 00:14:35'),
(155, 'force_delete_verif::agenda', 'web', '2025-03-25 00:14:35', '2025-03-25 00:14:35'),
(156, 'force_delete_any_verif::agenda', 'web', '2025-03-25 00:14:35', '2025-03-25 00:14:35'),
(157, 'view_agenda', 'web', '2025-03-25 20:33:36', '2025-03-25 20:33:36'),
(158, 'view_any_agenda', 'web', '2025-03-25 20:33:36', '2025-03-25 20:33:36'),
(159, 'create_agenda', 'web', '2025-03-25 20:33:36', '2025-03-25 20:33:36'),
(160, 'update_agenda', 'web', '2025-03-25 20:33:36', '2025-03-25 20:33:36'),
(161, 'restore_agenda', 'web', '2025-03-25 20:33:36', '2025-03-25 20:33:36'),
(162, 'restore_any_agenda', 'web', '2025-03-25 20:33:36', '2025-03-25 20:33:36'),
(163, 'replicate_agenda', 'web', '2025-03-25 20:33:37', '2025-03-25 20:33:37'),
(164, 'reorder_agenda', 'web', '2025-03-25 20:33:37', '2025-03-25 20:33:37'),
(165, 'delete_agenda', 'web', '2025-03-25 20:33:37', '2025-03-25 20:33:37'),
(166, 'delete_any_agenda', 'web', '2025-03-25 20:33:37', '2025-03-25 20:33:37'),
(167, 'force_delete_agenda', 'web', '2025-03-25 20:33:37', '2025-03-25 20:33:37'),
(168, 'force_delete_any_agenda', 'web', '2025-03-25 20:33:37', '2025-03-25 20:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint UNSIGNED NOT NULL,
  `pemohon_nama` varchar(255) NOT NULL,
  `pemohon_hp_telepon` varchar(255) NOT NULL,
  `pemohon_email` varchar(255) NOT NULL,
  `pemohon_warga_blok` varchar(255) NOT NULL,
  `pemohon_alamat` text NOT NULL,
  `form_id` bigint UNSIGNED NOT NULL,
  `request_status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telah_dijadwalkan_sidang` char(255) NOT NULL,
  `form_answers` json DEFAULT NULL,
  `form_file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `pemohon_nama`, `pemohon_hp_telepon`, `pemohon_email`, `pemohon_warga_blok`, `pemohon_alamat`, `form_id`, `request_status_id`, `created_at`, `updated_at`, `telah_dijadwalkan_sidang`, `form_answers`, `form_file_path`) VALUES
(1, 'Erik Wisnu', '0812212212', 'erik@gmail.com', '4', 'gjhg', 2, 3, '2025-03-14 06:57:19', '2025-03-15 05:56:38', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(3, 'Erik Wisnu', '12', 'q@e.e', '1', 'ww', 6, 4, '2025-03-15 06:08:17', '2025-03-15 07:13:56', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(10, 'eRIK', 's@ew', 'erikwnugroho@gmail.com', 's@ew', 's@ew', 6, 1, '2025-03-19 22:30:45', '2025-03-19 22:30:45', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(11, '{{ $upload->upload_type }}', '{{ $upload->upload_type }}', 's2s.q@2s.s', '{{ $upload->upload_type }}', '{{ $upload->upload_type }}', 6, 4, '2025-03-19 22:53:17', '2025-03-22 08:32:04', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(12, 'ERIK', 'ewr', 'erikwnugroho@gmail.com', 'asd', 'asd', 6, 4, '2025-03-20 01:21:28', '2025-03-23 07:32:12', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(13, 'Erik Wisnu Nugroho', '0881212', 'erikwnugroho@gmail.com', '4', 'Solo', 6, 4, '2025-03-20 09:01:30', '2025-03-21 19:28:18', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(14, 'Frederica Titis Nugraheni', 'o81902468333', 'endahpary@gmail.com', 'IV', 'Nusukan Bonorejo', 3, 4, '2025-03-23 03:29:12', '2025-03-23 03:32:58', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(15, 'Erik Wisnu', '081', 'erikwnugroho@gmail.com', '4', 'Surakarta', 2, 4, '2025-03-23 21:00:08', '2025-03-23 21:13:47', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(16, 'Erik ke 2', '0', 'erikwnugroho@gmail.com', '4', 'Surakarta', 2, 3, '2025-03-23 21:16:51', '2025-03-26 08:24:27', '1', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(17, '2 Mar 25', 'q', 'erikwnugroho@gmail.com', '1', '1', 6, 1, '2025-03-25 07:52:06', '2025-03-25 07:52:06', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(18, 'qq', 'qw', 'q@q.q', 'q', 'q', 2, 1, '2025-03-27 03:30:01', '2025-03-27 03:30:01', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(19, 'mmm', 'm', 'm@m.d', 'dw', 'dw', 2, 1, '2025-03-27 03:32:12', '2025-03-27 03:32:12', '0', '{\"2\": \"mm\", \"3\": \"m\", \"4\": \"m\", \"6\": \"m\", \"7\": \"m\", \"8\": null, \"9\": \"m\", \"10\": \"Laki - laki\", \"11\": true, \"12\": null}', NULL),
(20, 'Ricky Ferdinan', '081227717471', 'erikwnugroho@gmail.com', '5', 'Jl. Brwaijaya II, Pasar Kliwon, Surakarta', 2, 3, '2025-03-27 08:03:03', '2025-03-28 09:41:00', '1', '{\"2\": \"Minggu / 6 April 2025\", \"3\": \"08.30\", \"4\": \"GKJ MANAHAN SURAKARTA\", \"6\": \"Ricky Ferdinan\", \"7\": \"Surakarta / 9 Mei 1996\", \"8\": \"Swasta\", \"9\": \"Jl. Brwaijaya II, Pasar Kliwon, Surakarta\", \"10\": \"5\", \"11\": \"081227717471\", \"12\": \"erikwnugroho@gmail.com\", \"14\": \"Michella Gracia\", \"15\": \"Banten / 26 Agustus1999\", \"16\": \"Swasta\", \"17\": \"Jl. Brwaijaya II, Pasar Kliwon, Surakarta\", \"19\": \"Noel Ferdinan\", \"20\": \"Surakarta / 2 Februari 2025\", \"21\": \"Laki - laki\"}', NULL),
(21, 'Bayu Prassetyo', '081227717471', 'erikwnugroho@gmail.com', '6', 'Surakarta', 2, 1, '2025-03-28 08:26:45', '2025-03-28 08:26:45', '0', '{\"2\": \"14 April 2025\", \"3\": \"08.30\", \"4\": \"GKJ Manahan Surakarta\", \"6\": \"Bayu Prassetyo\", \"7\": \"Yogyakarta / 4 Agustus 1990\", \"8\": \"Pengacara\", \"9\": \"Surakarta\", \"10\": \"6\", \"11\": \"081227717471\", \"12\": \"erikwnugroho@gmail.com\", \"14\": \"Nella Putri\", \"15\": \"Surakarta / 1 Desember 1996\", \"16\": \"Swasta\", \"17\": \"Surakarta\", \"19\": \"Yosephin Putri\", \"20\": \"Surakarta / 12 Maret 2025\", \"21\": \"Perempuan\"}', 'uploads/form_permohonan/form_permohonan_21.pdf'),
(22, 'Calvin Verdonk', '081227717471', 'erikwnugroho@gmail.com', '6', 'Surakarta', 3, 9, '2025-03-29 06:05:41', '2025-03-29 06:34:19', '1', '{\"2\": \"Minggu / 4 Juni 2025\", \"3\": \"06.30\", \"4\": \"Surakarta\", \"6\": \"Calvin Verdonk\", \"7\": \"Surakarta/3 November 2007\", \"8\": \"Laki - laki\", \"9\": \"Pelajar\", \"10\": \"Sucipto Nugroho\", \"11\": \"Tanti \", \"12\": \"081227717471\", \"13\": \"erikwnugroho@gmail.com\", \"14\": \"Surakarta\", \"15\": \"6\", \"16\": \"Bp. Winarno/GKJ Manahan Surakarta\", \"17\": \"4 bulan\", \"19\": \"12 Januari 2008\", \"20\": \"GKJ Manahan Surakarta\", \"21\": \"Pdt. Fritz\"}', 'uploads/form_permohonan/form_permohonan_22.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `request_statuses`
--

CREATE TABLE `request_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_statuses`
--

INSERT INTO `request_statuses` (`id`, `name`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Pengajuan', 1, '2025-03-12 23:59:50', '2025-03-12 23:59:50'),
(2, 'Diproses', 2, '2025-03-12 23:59:50', '2025-03-12 23:59:50'),
(3, 'Disetujui', 4, '2025-03-12 23:59:50', '2025-03-12 23:59:50'),
(4, 'Ditolak', 5, '2025-03-12 23:59:50', '2025-03-12 23:59:50'),
(9, 'Agenda', 3, '2025-03-24 23:27:47', '2025-03-24 23:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `level_verification_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `level_verification_id`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', 1, '2025-03-13 00:18:09', '2025-03-13 00:18:09'),
(2, 'Admin Sekretariat', 'web', 2, '2025-03-13 00:19:34', '2025-03-13 08:39:00'),
(3, 'Ketua Sekretariat', 'web', 3, '2025-03-15 03:27:47', '2025-03-15 03:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(50, 2),
(51, 2),
(53, 2),
(54, 2),
(55, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(145, 2),
(146, 2),
(147, 2),
(148, 2),
(149, 2),
(150, 2),
(151, 2),
(152, 2),
(153, 2),
(154, 2),
(155, 2),
(156, 2),
(157, 2),
(158, 2),
(159, 2),
(160, 2),
(161, 2),
(162, 2),
(163, 2),
(164, 2),
(165, 2),
(166, 2),
(167, 2),
(168, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(126, 3),
(127, 3),
(128, 3),
(129, 3),
(130, 3),
(131, 3),
(132, 3),
(133, 3),
(134, 3),
(135, 3),
(136, 3),
(137, 3),
(138, 3),
(139, 3),
(140, 3),
(141, 3),
(142, 3),
(143, 3),
(144, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('i3T2lhxgqhG8zUzAx9kMuhp7NFaQFDVpHNaCgTW6', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiOGM4UlZ4bVgyaXdWck1ReTFSN05XbnJVNnVvMkJIZ2FsaU1jZ09DdiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vc2ltLXBhZ2EudGVzdDo4MDgwL2FkbWluL3ZlcmlmaWNhdGlvbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkSndFL3pVOE9hREpNbTVWQmNjdWZrZWd3cnhuanYxY3g3eENCMnhhLmR3TnF4aWlnUWV2Ni4iO30=', 1743254534),
('rXSFn9yEER0qegaOJ1UqANmXHBpPUqfdrkl9SGsX', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRm9IdThVeU5oYmJFRWVNblJGOThQcm9VQnNPT0VFMGFoTnNac0c0MiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9zaW0tcGFnYS50ZXN0OjgwODAvZm9ybS1zdWNjZXNzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJFR0clhqZjk2VmREckJKMEtZa2drN08uNTFjU3UvOVp0SnZXTDhZMFQxZVEuTURlTTBKdTR5IjtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e319', 1743255324);

-- --------------------------------------------------------

--
-- Table structure for table `upload_files`
--

CREATE TABLE `upload_files` (
  `id` bigint UNSIGNED NOT NULL,
  `request_id` bigint UNSIGNED NOT NULL,
  `list_upload_form_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upload_files`
--

INSERT INTO `upload_files` (`id`, `request_id`, `list_upload_form_id`, `created_at`, `updated_at`, `file_path`, `file_name`, `file_type`, `file_size`) VALUES
(1, 1, 2, '2025-03-14 06:57:19', '2025-03-14 06:57:19', 'uploads/form_permohonan/01JPAF3WSP0RRJNHR17KWS6SH0.pdf', '01JPAF3WSP0RRJNHR17KWS6SH0.pdf', 'pdf', 260588),
(2, 1, 3, '2025-03-14 06:57:20', '2025-03-14 06:57:20', 'uploads/form_permohonan/01JPAF3WXQXVZHPTV5MZGEQYKP.pdf', '01JPAF3WXQXVZHPTV5MZGEQYKP.pdf', 'pdf', 217172),
(3, 1, 4, '2025-03-14 06:57:20', '2025-03-14 06:57:20', 'uploads/form_permohonan/01JPAF3WY3YQ5DHEPS69FYTF5E.pdf', '01JPAF3WY3YQ5DHEPS69FYTF5E.pdf', 'pdf', 384848),
(4, 1, 5, '2025-03-14 06:57:20', '2025-03-14 06:57:20', 'uploads/form_permohonan/01JPAF3WYF86FZJ0GDYGZ3ZANH.pdf', '01JPAF3WYF86FZJ0GDYGZ3ZANH.pdf', 'pdf', 633926),
(5, 10, 22, '2025-03-19 22:30:45', '2025-03-19 22:30:45', 'uploads/form_permohonan/VWsRauTD7KGtMyUfT0RTskLKETduYuzLOj2vaR4L.jpg', 'Scan Formulir', 'jpg', 5),
(6, 12, 22, '2025-03-20 01:21:28', '2025-03-20 01:21:28', 'uploads/form_permohonan/BvxmW4N32PZfgFk9caDZ5oLhFNKsPQukiMhcbQO3.pdf', 'Scan Formulir', 'pdf', 376),
(7, 13, 22, '2025-03-20 09:01:31', '2025-03-20 09:01:31', 'uploads/form_permohonan/CPTLp00kyDuIda69tS7oqcgl52IWVBakQR0szwbN.pdf', 'Scan Formulir', 'pdf', 619),
(8, 15, 2, '2025-03-23 21:00:08', '2025-03-23 21:00:08', 'uploads/form_permohonan/hvYc3Iqa6DVQ6oKsvo1zuYozmIDaqvzlGxOMWjZn.pdf', 'Scan Formulir', 'pdf', 60),
(9, 15, 3, '2025-03-23 21:00:08', '2025-03-23 21:00:08', 'uploads/form_permohonan/CYMHd2rMbKtqhkONzGg9Cq1sCPYIhMndvYOuaPsC.pdf', 'Scan Akta Kelahiran Anak', 'pdf', 28),
(10, 15, 4, '2025-03-23 21:00:09', '2025-03-23 21:00:09', 'uploads/form_permohonan/e2ojDLvLbSuNNQHkHlHUulegVuKEGe1gaX1DYGLz.pdf', 'Scan Akta Pernikahan Gerejawi', 'pdf', 28),
(11, 15, 5, '2025-03-23 21:00:09', '2025-03-23 21:00:09', 'uploads/form_permohonan/AHT7GuwUKf5EtZHqqDVkRqBPAfbrUBs2Tyy6Ahwx.pdf', 'Scan Catatan Sipil Kedua Orang Tua', 'pdf', 28),
(12, 16, 2, '2025-03-23 21:16:51', '2025-03-23 21:16:51', 'uploads/form_permohonan/g5AKBvj7VyCeeYpDdr0EUi8DV2dDOm5iDBNthUnU.pdf', 'Scan Formulir', 'pdf', 60),
(13, 16, 3, '2025-03-23 21:16:51', '2025-03-23 21:16:51', 'uploads/form_permohonan/rTsTaG2ywOIwyfEtndGn3LlhIM0KlGXIKFXto5Hk.pdf', 'Scan Akta Kelahiran Anak', 'pdf', 28),
(14, 16, 4, '2025-03-23 21:16:51', '2025-03-23 21:16:51', 'uploads/form_permohonan/dzg8Q4wgVTDFGm8t2cQqH2L6sYKD4Se88rZQJ3Ky.pdf', 'Scan Akta Pernikahan Gerejawi', 'pdf', 28),
(15, 16, 5, '2025-03-23 21:16:51', '2025-03-23 21:16:51', 'uploads/form_permohonan/6qWJQbOWAGAQ1V6KRgfDI5dQ6PcklCl74iLRqBn8.pdf', 'Scan Catatan Sipil Kedua Orang Tua', 'pdf', 28),
(16, 17, 22, '2025-03-25 07:52:06', '2025-03-25 07:52:06', 'uploads/form_permohonan/SgCwZWhOzWnKhKA2txdnYBQpjQpveWhpAgvvOkAz.pdf', 'Scan Formulir', 'pdf', 107),
(17, 18, 2, '2025-03-27 03:30:01', '2025-03-27 03:30:01', 'uploads/form_permohonan/FWBLOyNv5xMX8Nm30srefmDq7O6QqTlXcR2h8qD3.pdf', 'Scan Formulir', 'pdf', 60),
(18, 18, 3, '2025-03-27 03:30:02', '2025-03-27 03:30:02', 'uploads/form_permohonan/YJH9PfPvk1OcsNsDInPDyXnGRqhahR1669EaY7MQ.pdf', 'Scan Akta Kelahiran Anak', 'pdf', 28),
(19, 19, 2, '2025-03-27 03:32:12', '2025-03-27 03:32:12', 'uploads/form_permohonan/0zRNB6WHJMZLRyy9jYdJjBhuuIctLmuDMN1P3wv4.pdf', 'Scan Formulir', 'pdf', 28),
(20, 19, 3, '2025-03-27 03:32:12', '2025-03-27 03:32:12', 'uploads/form_permohonan/mDKxCKzbLeXq7LhvJj17HcZ7YbLWLMuTyUXXNgOJ.pdf', 'Scan Akta Kelahiran Anak', 'pdf', 60),
(21, 20, 2, '2025-03-27 08:03:03', '2025-03-27 08:03:03', 'uploads/form_permohonan/z4bxWYAeD2Hz8MZbCBIvZ6lYzraMLikaEoVYPmK4.pdf', 'Scan Formulir', 'pdf', 60),
(22, 20, 3, '2025-03-27 08:03:04', '2025-03-27 08:03:04', 'uploads/form_permohonan/OixRhVhejlMJryxj7cpbQc8AY2XBA8HN2n2unGoh.pdf', 'Scan Akta Kelahiran Anak', 'pdf', 28),
(23, 21, 2, '2025-03-28 08:26:45', '2025-03-28 08:26:45', 'uploads/form_permohonan/osCzhRp2banlx0WtAjoXefwiszKuRNkt6ALGZrrL.pdf', 'Scan Formulir', 'pdf', 28),
(24, 21, 3, '2025-03-28 08:26:45', '2025-03-28 08:26:45', 'uploads/form_permohonan/JZ51aa96Jn6AY3jxQfm2tGyn9Uub1gI7TOlDRAxt.pdf', 'Scan Akta Kelahiran Anak', 'pdf', 28),
(25, 22, 8, '2025-03-29 06:05:41', '2025-03-29 06:05:41', 'uploads/form_permohonan/W8DLuA5LELsQBYss6OdjtprsM53vjpcvwT109aMb.jpg', 'Pasfoto Berwarna Ukuran 3x4', 'jpg', 10),
(26, 22, 9, '2025-03-29 06:05:41', '2025-03-29 06:05:41', 'uploads/form_permohonan/3I9qvCmqNDyFQdwZzTBNsvgSvOHmIqaLb7Af0375.pdf', 'Scan Surat Baptis Anak (Bagi yang sudah)', 'pdf', 28);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Erik - Super Admin', 'erik@supadmin.com', NULL, '$2y$12$Dzk/EdzwkV0cx7EUcTHOG.BRIeLEWL4lteVXHqwELYtLTXz1lsyrG', NULL, 1, '2025-03-12 23:59:50', '2025-03-12 23:59:50'),
(2, 'Admin Sekretariat', 'admin@admin.com', NULL, '$2y$12$TtrXjf96VdDrBJ0KYkgk7O.51cSu/9ZtJvWL8Y0T1eQ.MDeM0Ju4y', NULL, 2, '2025-03-13 00:21:30', '2025-03-23 08:03:38'),
(4, 'Ketua', 'admin1@admin.com', NULL, '$2y$12$JwE/zU8OaDJMm5VBccufkegwrxnjv1cx7xCB2xa.dwNqxiigQev6.', NULL, 3, '2025-03-13 08:46:44', '2025-03-23 07:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE `verifications` (
  `id` bigint UNSIGNED NOT NULL,
  `request_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `verification_status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notes` text,
  `approved_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verifications`
--

INSERT INTO `verifications` (`id`, `request_id`, `user_id`, `verification_status_id`, `created_at`, `updated_at`, `notes`, `approved_by`) VALUES
(5, 1, 2, 1, '2025-03-15 03:08:01', '2025-03-15 03:08:01', NULL, ''),
(6, 1, 4, 1, '2025-03-15 05:56:37', '2025-03-15 05:56:37', NULL, ''),
(9, 3, 2, 2, '2025-03-15 07:13:56', '2025-03-15 07:13:56', 'Dokumen tidak lengkap\n', 'Admin Sekretariat'),
(15, 13, 2, 1, '2025-03-21 19:27:41', '2025-03-21 19:27:41', 'fvfdg', 'Admin Sekretariat'),
(16, 13, 2, 2, '2025-03-21 19:28:18', '2025-03-21 19:28:18', 'Tidak lengkap\n', 'Admin Sekretariat'),
(17, 11, 2, 2, '2025-03-22 08:32:04', '2025-03-22 08:32:04', NULL, 'Admin Sekretariat'),
(18, 14, 2, 1, '2025-03-23 03:31:34', '2025-03-23 03:31:34', NULL, 'Admin Sekretariat'),
(19, 14, 4, 2, '2025-03-23 03:32:58', '2025-03-23 03:32:58', NULL, 'Ketua'),
(20, 12, 2, 2, '2025-03-23 07:32:11', '2025-03-23 07:32:11', 'Test gagal', 'Admin Sekretariat'),
(21, 15, 2, 2, '2025-03-23 21:13:45', '2025-03-23 21:13:45', 'Pengisian formulir tidak lengkap, agar dilengkapi kembali.', 'Admin Sekretariat'),
(22, 16, 2, 1, '2025-03-23 21:17:55', '2025-03-23 21:17:55', NULL, 'Admin Sekretariat'),
(23, 16, 4, 1, '2025-03-25 01:23:07', '2025-03-25 01:23:07', 'Setuju', 'Ketua'),
(24, 1, 2, 1, '2025-03-26 08:21:44', '2025-03-26 08:21:44', 'Sip', 'Admin Sekretariat'),
(25, 1, 2, 1, '2025-03-26 08:24:27', '2025-03-26 08:24:27', 'Sippp\n', 'Admin Sekretariat'),
(26, 20, 2, 1, '2025-03-28 09:18:43', '2025-03-28 09:18:43', NULL, 'Admin Sekretariat'),
(27, 20, 4, 1, '2025-03-28 09:19:15', '2025-03-28 09:19:15', NULL, 'Ketua'),
(31, 20, 2, 1, '2025-03-28 09:41:00', '2025-03-28 09:41:00', NULL, 'Admin Sekretariat'),
(32, 22, 2, 1, '2025-03-29 06:21:35', '2025-03-29 06:21:35', NULL, 'Admin Sekretariat'),
(33, 22, 4, 1, '2025-03-29 06:22:11', '2025-03-29 06:22:11', NULL, 'Ketua');

-- --------------------------------------------------------

--
-- Table structure for table `verification_statuses`
--

CREATE TABLE `verification_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verification_statuses`
--

INSERT INTO `verification_statuses` (`id`, `name`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Disetujui', 1, '2025-03-12 23:59:50', '2025-03-12 23:59:50'),
(2, 'Ditolak', 2, '2025-03-12 23:59:51', '2025-03-12 23:59:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agenda_details`
--
ALTER TABLE `agenda_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_details_agenda_id_foreign` (`agenda_id`),
  ADD KEY `agenda_details_jenis_id_foreign` (`jenis_id`),
  ADD KEY `agenda_details_keterangan_id_foreign` (`keterangan_id`),
  ADD KEY `agenda_details_request_id_foreign` (`request_id`);

--
-- Indexes for table `agenda_jenis`
--
ALTER TABLE `agenda_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agenda_keterangans`
--
ALTER TABLE `agenda_keterangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_pertanyaans`
--
ALTER TABLE `form_pertanyaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_pertanyaans_form_id_foreign` (`form_id`);

--
-- Indexes for table `form_pertanyaan_options`
--
ALTER TABLE `form_pertanyaan_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_verifications`
--
ALTER TABLE `level_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_upload_forms`
--
ALTER TABLE `list_upload_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_upload_forms_form_id_foreign` (`form_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_form_id_foreign` (`form_id`),
  ADD KEY `requests_request_status_id_foreign` (`request_status_id`);

--
-- Indexes for table `request_statuses`
--
ALTER TABLE `request_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `roles_level_verification_id_foreign` (`level_verification_id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `upload_files`
--
ALTER TABLE `upload_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upload_files_request_id_foreign` (`request_id`),
  ADD KEY `upload_files_list_upload_form_id_foreign` (`list_upload_form_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verifications_request_id_foreign` (`request_id`),
  ADD KEY `verifications_user_id_foreign` (`user_id`),
  ADD KEY `verifications_verification_status_id_foreign` (`verification_status_id`);

--
-- Indexes for table `verification_statuses`
--
ALTER TABLE `verification_statuses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agenda_details`
--
ALTER TABLE `agenda_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `agenda_jenis`
--
ALTER TABLE `agenda_jenis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agenda_keterangans`
--
ALTER TABLE `agenda_keterangans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `form_pertanyaans`
--
ALTER TABLE `form_pertanyaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `form_pertanyaan_options`
--
ALTER TABLE `form_pertanyaan_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level_verifications`
--
ALTER TABLE `level_verifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `list_upload_forms`
--
ALTER TABLE `list_upload_forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `request_statuses`
--
ALTER TABLE `request_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `upload_files`
--
ALTER TABLE `upload_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `verification_statuses`
--
ALTER TABLE `verification_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda_details`
--
ALTER TABLE `agenda_details`
  ADD CONSTRAINT `agenda_details_agenda_id_foreign` FOREIGN KEY (`agenda_id`) REFERENCES `agendas` (`id`),
  ADD CONSTRAINT `agenda_details_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `agenda_jenis` (`id`),
  ADD CONSTRAINT `agenda_details_keterangan_id_foreign` FOREIGN KEY (`keterangan_id`) REFERENCES `agenda_keterangans` (`id`),
  ADD CONSTRAINT `agenda_details_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `form_pertanyaans`
--
ALTER TABLE `form_pertanyaans`
  ADD CONSTRAINT `form_pertanyaans_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `list_upload_forms`
--
ALTER TABLE `list_upload_forms`
  ADD CONSTRAINT `list_upload_forms_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`),
  ADD CONSTRAINT `requests_request_status_id_foreign` FOREIGN KEY (`request_status_id`) REFERENCES `request_statuses` (`id`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_level_verification_id_foreign` FOREIGN KEY (`level_verification_id`) REFERENCES `level_verifications` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `upload_files`
--
ALTER TABLE `upload_files`
  ADD CONSTRAINT `upload_files_list_upload_form_id_foreign` FOREIGN KEY (`list_upload_form_id`) REFERENCES `list_upload_forms` (`id`),
  ADD CONSTRAINT `upload_files_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `verifications`
--
ALTER TABLE `verifications`
  ADD CONSTRAINT `verifications_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`),
  ADD CONSTRAINT `verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `verifications_verification_status_id_foreign` FOREIGN KEY (`verification_status_id`) REFERENCES `verification_statuses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
