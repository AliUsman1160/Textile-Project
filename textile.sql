-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 05:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `textile`
--

-- --------------------------------------------------------

--
-- Table structure for table `brokers`
--

CREATE TABLE `brokers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brokers`
--

INSERT INTO `brokers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ali', '2024-02-10 04:17:58', '2024-02-10 04:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `fabricinventory`
--

CREATE TABLE `fabricinventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quality` varchar(255) NOT NULL,
  `meter` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fabricinventory`
--

INSERT INTO `fabricinventory` (`id`, `quality`, `meter`, `created_at`, `updated_at`) VALUES
(1, '(70 x 80) / (30 x 30) = 114 (CTN)', 50, '2024-03-01 11:19:06', '2024-03-01 12:18:05'),
(2, '(76 x 66) / (30 x 30) = 114 (CTN)', 100, '2024-03-01 12:19:32', '2024-03-01 12:25:14'),
(3, '(72 x 82) / (30 x 30) = 117 (CTN)', 1040, '2024-03-02 01:29:20', '2024-03-13 12:08:18'),
(5, '(60 x 80) / (30 x 30) = 120 (CTN)', 0, '2024-03-02 09:57:00', '2024-03-02 10:03:08');

-- --------------------------------------------------------

--
-- Table structure for table `fabricpurchases`
--

CREATE TABLE `fabricpurchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `weight` double(8,2) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `meter` float NOT NULL,
  `price_per_meter` double(8,2) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  `pay_price` double NOT NULL DEFAULT 0,
  `panding_price` double NOT NULL DEFAULT 0,
  `paymentStatus` varchar(255) NOT NULL,
  `addby` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fabricpurchases`
--

INSERT INTO `fabricpurchases` (`id`, `weight`, `quality`, `meter`, `price_per_meter`, `supplier`, `total_price`, `pay_price`, `panding_price`, `paymentStatus`, `addby`, `created_at`, `updated_at`) VALUES
(7, 5.00, '', 0, 6.00, 'Ali usman', 10000, 3000, 7000, 'pending', '', '2024-02-15 07:01:02', '2024-02-15 07:05:52'),
(9, 2.00, '', 0, 3.00, 'Ali', 1, 1, 0, 'payed', '', '2024-02-15 08:28:51', '2024-02-15 08:29:13'),
(10, 294.00, '', 0, 300.00, 'Ali usman', 10000, 1, 9999, 'pending', '', '2024-02-17 04:04:06', '2024-02-17 04:04:06'),
(11, 4.00, '', 0, 5.00, 'Arslan', 1000, 0, 1000, 'pending', 'Ali', '2024-02-22 10:17:26', '2024-02-24 03:28:29'),
(13, 10.00, '(70 x 80) / (30 x 30) = 114 (CTN)', 30, 10.00, 'Ali', 300, 0, 300, 'pending', 'Ali', '2024-03-01 11:19:06', '2024-03-01 11:37:37'),
(15, 1.00, '(76 x 66) / (30 x 30) = 114 (CTN)', 100, 1.00, 'Ali usman', 100, 0, 100, 'pending', 'Ali', '2024-03-01 12:19:31', '2024-03-01 12:19:31'),
(18, 1.00, '(72 x 82) / (30 x 30) = 117 (CTN)', 200, 1.00, 'Ali usman', 200, 0, 200, 'pending', 'Ali', '2024-03-02 01:29:54', '2024-03-02 01:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `fabricsales`
--

CREATE TABLE `fabricsales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quality` varchar(255) NOT NULL,
  `meter` double NOT NULL,
  `weight` double(8,2) NOT NULL,
  `price_per_meter` double(8,2) NOT NULL,
  `purchaser` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  `received_price` double NOT NULL DEFAULT 0,
  `panding_price` double NOT NULL DEFAULT 0,
  `paymentStatus` varchar(255) NOT NULL,
  `addby` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fabricsales`
--

INSERT INTO `fabricsales` (`id`, `quality`, `meter`, `weight`, `price_per_meter`, `purchaser`, `total_price`, `received_price`, `panding_price`, `paymentStatus`, `addby`, `created_at`, `updated_at`) VALUES
(7, '', 0, 89.00, 1000.00, 'Ali usman', 10000, 2000, 8000, 'pending', '', '2024-02-15 06:20:05', '2024-02-15 06:30:53'),
(10, '(70 x 80) / (30 x 30) = 114 (CTN)', 0, 3.00, 1.00, 'Ali', 1, 1, 0, 'received', '', '2024-02-15 08:26:11', '2024-02-15 08:26:11'),
(11, '', 0, 4.00, 4.00, 'Ali usman', 99, 0, 99, 'pending', 'Ali', '2024-02-22 10:13:09', '2024-02-22 10:13:09'),
(12, '', 0, 1.00, 11.00, 'Ali usman', 100, 0, 100, 'pending', 'Ali', '2024-02-23 10:07:40', '2024-02-23 10:07:40'),
(13, '', 0, 2.00, 2.00, 'Ali', 100, 0, 100, 'pending', 'Ali', '2024-02-23 10:18:59', '2024-02-23 10:18:59'),
(14, '', 0, 22.00, 2.00, 'Ali', 500, 0, 500, 'pending', 'Ali', '2024-02-23 10:21:29', '2024-02-23 10:21:29'),
(15, '', 0, 10.00, 100.00, 'Ali', 500, 0, 500, 'pending', 'Ali', '2024-02-23 10:23:01', '2024-02-23 10:23:01'),
(16, '', 0, 1.00, 2.00, 'Ahmad', 500, 0, 500, 'pending', 'Ali', '2024-02-23 10:24:33', '2024-02-24 03:27:41'),
(17, '(70 x 80) / (30 x 30) = 114 (CTN)', 20, 1.00, 100.00, 'Ali usman', 2000, 0, 2000, 'pending', 'Ali', '2024-03-01 12:03:51', '2024-03-01 12:18:05'),
(19, '(72 x 82) / (30 x 30) = 117 (CTN)', 60, 1.00, 1.00, 'Taimoor', 60, 0, 60, 'pending', 'Ali', '2024-03-02 01:30:47', '2024-03-02 01:31:01'),
(21, '(72 x 82) / (30 x 30) = 117 (CTN)', 100, 1.00, 1.00, 'saad', 100, 0, 100, 'pending', 'Ali', '2024-03-13 12:08:18', '2024-03-13 12:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `fabrictosuits`
--

CREATE TABLE `fabrictosuits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quality` varchar(255) NOT NULL,
  `sendtodyeing` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `reject` int(11) NOT NULL,
  `pass` int(11) NOT NULL,
  `varity` varchar(255) NOT NULL,
  `addby` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fabrictosuits`
--

INSERT INTO `fabrictosuits` (`id`, `quality`, `sendtodyeing`, `cost`, `reject`, `pass`, `varity`, `addby`, `created_at`, `updated_at`) VALUES
(2, '(72 x 82) / (30 x 30) = 117 (CTN)', 400, 100.00, 50, 50, 'Slik', 'Ali', '2024-02-22 12:48:19', '2024-02-22 12:48:19'),
(6, '(72 x 82) / (30 x 30) = 117 (CTN)', 77, 100.00, 0, 50, 'test article', 'Ali', '2024-02-23 08:59:16', '2024-02-23 08:59:16'),
(7, '(72 x 82) / (30 x 30) = 117 (CTN)', 500, 100.00, 0, 500, 'test article', 'Ali', '2024-02-23 09:00:35', '2024-02-23 09:00:35'),
(8, '(60 x 80) / (30 x 30) = 120 (CTN)', 600, 100.00, 0, 500, 'test article', 'Ali', '2024-02-23 09:01:23', '2024-02-23 09:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_28_055959_create_yarnsales_table', 1),
(6, '2024_01_28_094731_create_yarnpurchases_table', 2),
(7, '2024_01_31_070019_create_fabricsales_table', 3),
(8, '2024_01_31_093039_create_fabricpurchase_table', 4),
(9, '2024_01_31_130934_create_suitsales_table', 5),
(10, '2024_01_31_140443_create_suitpurchases_table', 6),
(11, '2024_01_31_144334_create_yarnsales_table', 7),
(12, '2024_01_31_155555_create_yarnsales_table', 8),
(13, '2024_02_01_080251_create_yarnpurchases_table', 9),
(14, '2024_02_10_083211_create_suppliers_table', 10),
(15, '2024_02_10_090145_create_purchasers_table', 11),
(16, '2024_02_10_091444_create_brokers_table', 12),
(17, '2024_02_11_101733_create_qualities_table', 13),
(18, '2024_02_17_142806_create_varieties_table', 14),
(19, '2024_01_31_130934_create_suitsales1_table', 15),
(20, '2024_02_20_123339_create_suitsale_table', 15),
(21, '2024_02_20_141911_create_purchasertransactions_table', 16),
(22, '2024_02_20_160800_create_suppliertransactions_table', 17),
(23, '2024_02_21_130131_create_yarntofabrics_table', 18),
(24, '2024_02_22_163830_create_fabrictosuits_table', 19),
(25, '2024_03_01_135441_create_yarninventory_table', 20),
(26, '2024_03_01_161033_create_fabricinventory_table', 21);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchasers`
--

CREATE TABLE `purchasers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `panding_price` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchasers`
--

INSERT INTO `purchasers` (`id`, `name`, `panding_price`, `created_at`, `updated_at`) VALUES
(1, 'Ali', 10100, '2024-02-10 04:06:35', '2024-02-23 10:23:01'),
(2, 'Ali usman', 48997, '2024-02-10 04:06:50', '2024-03-02 01:31:40'),
(3, 'Taimoor', 4503600, '2024-02-15 09:28:39', '2024-03-05 11:27:01'),
(4, 'Ahmad', 0, '2024-02-24 03:26:00', '2024-03-02 10:12:38'),
(5, 'saad', 1901, '2024-03-11 09:17:17', '2024-03-13 12:08:18'),
(6, 'xyz', 0, '2024-03-15 07:14:57', '2024-03-15 07:14:57'),
(7, 'Arslan', 100, '2024-03-15 07:18:18', '2024-03-15 07:20:31'),
(8, 'Hassan', 2000, '2024-03-15 07:28:57', '2024-03-15 07:30:36'),
(9, 'Zain', 1000, '2024-03-15 07:33:42', '2024-03-15 07:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchasertransactions`
--

CREATE TABLE `purchasertransactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchaser` varchar(255) NOT NULL,
  `debt` decimal(10,2) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `pending` decimal(10,2) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `addby` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchasertransactions`
--

INSERT INTO `purchasertransactions` (`id`, `purchaser`, `debt`, `credit`, `pending`, `note`, `addby`, `created_at`, `updated_at`) VALUES
(2, 'Ali usman', 31501.00, 501.00, 31000.00, 'some thing', '', '2024-02-20 09:40:30', '2024-02-20 09:40:30'),
(3, 'Ali usman', 31000.00, 1000.00, 30000.00, 'some thing', '', '2024-02-20 09:40:44', '2024-02-20 09:40:44'),
(4, 'Taimoor', 2500.00, 500.00, 2000.00, '500 rupes received.', '', '2024-02-20 10:43:12', '2024-02-20 10:43:12'),
(5, 'Taimoor', 2000.00, 0.00, 2000.00, NULL, '', '2024-02-20 11:35:43', '2024-02-20 11:35:43'),
(8, 'Taimoor', 4499000.00, 100.00, 4498900.00, NULL, 'Ali', '2024-02-24 03:15:27', '2024-02-24 03:15:27'),
(10, 'Ahmad', 1600.00, 1600.00, 0.00, NULL, 'Ali', '2024-03-02 10:12:39', '2024-03-02 10:12:39'),
(12, 'Zain', 2000.00, 1000.00, 1000.00, 'payen received in bank', 'Ali', '2024-03-15 07:37:00', '2024-03-15 07:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `qualities`
--

CREATE TABLE `qualities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `read` decimal(8,2) NOT NULL,
  `pick` decimal(8,2) NOT NULL,
  `warpcount` decimal(8,2) NOT NULL,
  `weftcount` decimal(8,2) NOT NULL,
  `width` decimal(8,2) NOT NULL,
  `nameofyarn` varchar(255) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qualities`
--

INSERT INTO `qualities` (`id`, `read`, `pick`, `warpcount`, `weftcount`, `width`, `nameofyarn`, `quality`, `created_at`, `updated_at`) VALUES
(1, 70.00, 80.00, 30.00, 30.00, 114.00, 'CTN', '(70 x 80) / (30 x 30) = 114 (CTN)', '2024-02-11 05:23:19', '2024-02-11 05:23:19'),
(2, 76.00, 66.00, 30.00, 30.00, 114.00, 'CTN', '(76 x 66) / (30 x 30) = 114 (CTN)', '2024-02-11 06:56:19', '2024-02-11 06:56:19'),
(3, 72.00, 82.00, 30.00, 30.00, 117.00, 'CTN', '(72 x 82) / (30 x 30) = 117 (CTN)', '2024-02-11 07:25:46', '2024-02-11 07:25:46'),
(4, 60.00, 80.00, 30.00, 30.00, 120.00, 'CTN', '(60 x 80) / (30 x 30) = 120 (CTN)', '2024-02-11 07:27:45', '2024-02-11 07:27:45'),
(5, 40.00, 50.00, 20.00, 20.00, 114.00, 'CTN', '(40 x 50) / (20 x 20) = 114 (CTN)', '2024-02-17 04:12:44', '2024-02-17 04:12:44'),
(6, 84.00, 78.00, 52.00, 52.00, 61.00, 'CTN', '(84 x 78) / (52 x 52) = 61 (CTN)', '2024-02-17 05:21:15', '2024-02-17 05:21:15'),
(7, 84.00, 78.00, 52.00, 52.00, 61.00, 'CTN', '(84 x 78) / (52 x 52) = 61 (CTN)', '2024-02-17 05:22:37', '2024-02-17 05:22:37'),
(8, 1.00, 2.00, 3.00, 4.00, 114.00, 'CTN', '(1 x 2) / (35,warp mill x 46,weft mill) = 114 (CTN)', '2024-02-18 07:07:23', '2024-02-18 07:07:23'),
(9, 1.00, 2.00, 3.00, 4.00, 114.00, 'CTN', '(1 x 2) / (3(warp thread,warp mill) x 4(weft thread,weft mill)) = 114 (CTN)', '2024-02-18 07:10:13', '2024-02-18 07:10:13'),
(10, 10.00, 10.00, 20.00, 20.00, 114.00, 'CTN', '(10 x 10) / (20() x 20()) = 114 (CTN)', '2024-03-01 09:47:04', '2024-03-01 09:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `suitpurchases`
--

CREATE TABLE `suitpurchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variety` varchar(255) NOT NULL,
  `meter` int(255) NOT NULL,
  `price` double NOT NULL,
  `pay_price` double NOT NULL DEFAULT 0,
  `panding_price` double NOT NULL DEFAULT 0,
  `supplier` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suitpurchases`
--

INSERT INTO `suitpurchases` (`id`, `variety`, `meter`, `price`, `pay_price`, `panding_price`, `supplier`, `payment_status`, `created_at`, `updated_at`) VALUES
(10, 'test article', 100, 500, 0, 500, 'Arslan', 'pending', '2024-01-04 08:52:01', '2024-02-24 03:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `suitsale`
--

CREATE TABLE `suitsale` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchaser` varchar(32) NOT NULL,
  `variety` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `meter` int(11) NOT NULL,
  `totalPrice` double NOT NULL,
  `thaanMeter` int(11) NOT NULL,
  `totalThaan` int(11) NOT NULL,
  `billid` varchar(255) NOT NULL,
  `addby` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suitsale`
--

INSERT INTO `suitsale` (`id`, `purchaser`, `variety`, `price`, `meter`, `totalPrice`, `thaanMeter`, `totalThaan`, `billid`, `addby`, `created_at`, `updated_at`) VALUES
(19, 'Ali usman', 'invontry', 1000, 10, 10000, 0, 0, '8', 'Ali', '2024-01-10 08:43:32', '2024-02-23 08:43:32'),
(25, 'Ahmad', 'My new article', 1, 100, 100, 0, 0, '11', 'Ali', '2024-02-24 03:29:01', '2024-02-24 03:29:01'),
(26, 'Taimoor', 'New Silk', 600, 5, 2700, 5, 1, '12', 'Ali', '2024-03-05 11:27:01', '2024-03-05 11:27:01'),
(27, 'saad', 'XYZ Silk', 3, 200, 600, 0, 0, '13', 'Ali', '2024-03-11 09:19:58', '2024-03-11 09:19:58'),
(28, 'saad', 'New Silk', 3, 100, 300, 0, 0, '14', 'Ali', '2024-03-13 11:42:16', '2024-03-13 11:42:16'),
(29, 'saad', 'invontry', 10, 90, 900, 0, 0, '14', 'Ali', '2024-03-13 11:42:16', '2024-03-13 11:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `suitsales`
--

CREATE TABLE `suitsales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `received_price` double NOT NULL,
  `panding_price` double NOT NULL,
  `purchaser` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `panding_price` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `panding_price`, `created_at`, `updated_at`) VALUES
(1, 'Ali', 300, '2024-02-10 03:46:10', '2024-03-01 11:37:37'),
(3, 'Ali usman', 13013, '2024-02-10 04:07:05', '2024-03-02 08:58:55'),
(4, 'Arslan', 401, '2024-02-24 03:24:41', '2024-03-05 11:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `suppliertransactions`
--

CREATE TABLE `suppliertransactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `debt` decimal(10,2) NOT NULL,
  `pay` decimal(10,2) NOT NULL,
  `pending` decimal(10,2) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `addby` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliertransactions`
--

INSERT INTO `suppliertransactions` (`id`, `supplier`, `debt`, `pay`, `pending`, `note`, `addby`, `created_at`, `updated_at`) VALUES
(1, 'Ali usman', 30999.00, 9999.00, 21000.00, 'some', '', '2024-02-20 11:13:40', '2024-02-20 11:13:40'),
(2, 'Ali usman', 21000.00, 1000.00, 20000.00, 'some', '', '2024-02-20 11:14:44', '2024-02-20 11:14:44'),
(3, 'Ali', 9999.00, 999.00, 9000.00, 'some', '', '2024-02-20 11:29:04', '2024-02-20 11:29:04'),
(4, 'Ali', 9000.00, 9000.00, 0.00, 'some', '', '2024-02-20 11:29:49', '2024-02-20 11:29:49'),
(7, 'Ali usman', 21500.00, 100.00, 21400.00, NULL, 'Ali', '2024-02-24 03:11:26', '2024-02-24 03:11:26'),
(8, 'Arslan', 2400.00, 2000.00, 400.00, NULL, 'Ali', '2024-02-24 03:31:44', '2024-02-24 03:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT 0,
  `phone` varchar(15) NOT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `activate`, `phone`, `super_user`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Ali', 'admin@gmail.com', NULL, '$2y$12$rPU92oEUP0FnbWgNOPIOreSY6Ws0ip6sLM9rh8hGXsR2hokjPtaO.', 1, '', 1, NULL, '2024-01-28 08:40:24', '2024-01-28 08:40:24'),
(3, 'Ali', 'ali@gmail.com', NULL, '$2y$12$IFiDtJhWih8kUa76SBwRyeuhQq3/x7ZzO49A5gQK5FKYb2kAUiuoK', 0, '03001234567', 0, NULL, '2024-01-29 06:50:17', '2024-01-29 09:00:36'),
(6, 'usman', 'usman@gmail.com', NULL, '$2y$12$oOyMoIkt8lsQVpm3NZLLzeQcdw4anWiZjVVSy9buJ6SzmRPoFQnkS', 0, '03331234567', 0, NULL, '2024-01-29 07:01:14', '2024-01-29 09:04:48'),
(7, 'worker', 'worker@gmail.com', NULL, '$2y$12$7df7AzjyZexOqGILg7JjT.BLXMFPa865jGEkM8dJI42V4dnPitbNC', 1, '03001234567', 0, NULL, '2024-01-29 09:06:14', '2024-01-29 09:07:44'),
(8, 'worker2', 'worker2@gmail.com', NULL, '$2y$12$HLv/K2W79EnNL8tdZhqbpOAy18o6L.dj6paAK3T/7yT4XKeTIbe.C', 0, '03001234567', 0, NULL, '2024-02-01 09:02:44', '2024-02-01 09:02:44'),
(9, 'Worker 2', 'worker123@gmail.com', NULL, '$2y$12$/lzEQgWDENbSPvnygpLW3O4/7bWf867aSYwPsaHu3pTTahCZNujCe', 0, '03001234567', 0, NULL, '2024-02-06 10:17:07', '2024-02-06 10:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `varieties`
--

CREATE TABLE `varieties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,0) NOT NULL,
  `meter` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `varieties`
--

INSERT INTO `varieties` (`id`, `name`, `price`, `meter`, `created_at`, `updated_at`) VALUES
(2, 'Other silk', 5000, 1690, '2024-02-17 09:33:29', '2024-02-23 10:39:28'),
(3, 'New Silk', 3000, 2396, '2024-02-17 10:53:28', '2024-03-13 11:42:16'),
(4, 'XYZ Silk', 3000, 1800, '2024-02-17 10:55:11', '2024-03-11 09:19:58'),
(5, 'My new article', 10000, 0, '2024-02-23 05:23:41', '2024-02-24 03:29:01'),
(6, 'invontry', 1000, 0, '2024-02-23 07:04:36', '2024-03-13 11:42:16'),
(7, 'test article', 100, 1000, '2024-02-23 08:50:31', '2024-02-24 03:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `yarninventory`
--

CREATE TABLE `yarninventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bag` int(11) NOT NULL,
  `cones` varchar(255) NOT NULL,
  `count` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yarninventory`
--

INSERT INTO `yarninventory` (`id`, `bag`, `cones`, `count`, `type`, `brand`, `created_at`, `updated_at`) VALUES
(1, 50, '20', '30', 'test', 'Brand', '2024-03-01 09:03:03', '2024-03-01 09:19:38'),
(2, 7, '30', '30', 'new test', 'new Brand', '2024-03-01 09:20:34', '2024-03-01 10:03:48'),
(3, 10, '60', '30', 'test', 'Brand', '2024-03-02 05:38:08', '2024-03-02 05:38:08'),
(4, 3, '60', '40', 'test1', 'Brand', '2024-03-02 08:58:55', '2024-03-15 07:35:22'),
(5, 5, '40', '50', 'cotton test', 'Brand', '2024-03-05 11:24:29', '2024-03-15 07:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `yarnpurchases`
--

CREATE TABLE `yarnpurchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bag` int(11) NOT NULL,
  `cones` int(11) NOT NULL,
  `count` double(8,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `price_bag` int(11) NOT NULL,
  `broker` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  `pay_price` double NOT NULL DEFAULT 0,
  `panding_price` double NOT NULL DEFAULT 0,
  `payment_status` varchar(255) NOT NULL,
  `addby` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yarnpurchases`
--

INSERT INTO `yarnpurchases` (`id`, `bag`, `cones`, `count`, `type`, `brand`, `supplier`, `price_bag`, `broker`, `total_price`, `pay_price`, `panding_price`, `payment_status`, `addby`, `created_at`, `updated_at`) VALUES
(8, 1, 34, 5.00, 'cotton', 'Brand', 'Ali usman', 1000, 'Ali', 10000, 4000, 6000, 'pending', '', '2024-02-14 11:58:31', '2024-02-15 06:46:06'),
(10, 10, 16, 10.00, 'cotton', 'Brand', 'Ali usman', 100, 'Ali', 19, 19, 0, 'payed', '', '2024-02-15 08:18:51', '2024-02-15 08:21:53'),
(11, 1, 3, 4.00, 'cotton', 'Brand', 'Ali', 1, 'Ali', 100, 100, 0, 'payed', '', '2024-02-15 08:21:33', '2024-02-15 08:21:33'),
(12, 10, 15, 2.00, 'cotton', 'Brand', 'Ali', 1000, 'Ali', 10000, 1, 9999, 'pending', '', '2024-02-20 11:28:20', '2024-02-20 11:28:20'),
(13, 10, 1, 7.00, '8', 'Brand', 'Arslan', 888, 'Ali', 900, 0, 900, 'pending', 'Ali', '2024-02-22 10:08:26', '2024-02-24 03:25:41'),
(14, 10, 20, 30.00, 'test', 'Brand', 'Ali usman', 1000, 'Ali', 1000, 0, 1000, 'pending', 'Ali', '2024-03-01 09:03:03', '2024-03-01 09:03:03'),
(15, 30, 20, 30.00, 'test', 'Brand', 'Ali usman', 100, 'Ali', 100, 0, 100, 'pending', 'Ali', '2024-03-01 09:03:40', '2024-03-01 09:19:38'),
(16, 9, 30, 30.00, 'new test', 'new Brand', 'Ali usman', 11, 'Ali', 11, 0, 11, 'pending', 'Ali', '2024-03-01 09:20:34', '2024-03-01 09:20:58'),
(18, 10, 60, 30.00, 'test', 'Brand', 'Ali usman', 1, 'Ali', 1, 0, 1, 'pending', 'Ali', '2024-03-02 05:38:07', '2024-03-02 05:38:07'),
(19, 20, 60, 40.00, 'test1', 'Brand', 'Ali usman', 11, 'Ali', 1, 0, 1, 'pending', 'Ali', '2024-03-02 08:58:55', '2024-03-02 08:58:55'),
(20, 20, 40, 50.00, 'cotton test', 'Brand', 'Arslan', 10, 'Ali', 1, 0, 1, 'pending', 'Ali', '2024-03-05 11:24:29', '2024-03-05 11:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `yarnsales`
--

CREATE TABLE `yarnsales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bag` int(11) NOT NULL,
  `cones` int(11) NOT NULL,
  `count` double(8,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `purchaser` varchar(255) NOT NULL,
  `price_bag` int(11) NOT NULL,
  `broker` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  `received_price` double NOT NULL DEFAULT 0,
  `panding_price` double NOT NULL DEFAULT 0,
  `payment_status` varchar(255) NOT NULL,
  `addby` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yarnsales`
--

INSERT INTO `yarnsales` (`id`, `bag`, `cones`, `count`, `type`, `brand`, `purchaser`, `price_bag`, `broker`, `total_price`, `received_price`, `panding_price`, `payment_status`, `addby`, `created_at`, `updated_at`) VALUES
(19, 12, 3, 3.00, 'cotton', 'Brand', 'Ali usman', 1000, 'Ali', 10000, 5000, 5000, 'pending', '', '2024-02-14 10:31:15', '2024-02-15 06:38:43'),
(20, 10, 15, 30.00, 'cotton', 'Brand', 'Ali', 10000, 'Ali', 10, 10, 0, 'received', '', '2024-02-15 08:15:45', '2024-02-15 08:16:27'),
(21, 10, 20, 30.00, 'cotton', 'Brand', 'Ali', 1000, 'Ali', 10000, 1000, 9000, 'pending', '', '2024-02-17 03:51:30', '2024-02-17 03:51:30'),
(23, 10, 9, 3.00, '9', 'Brand', 'Ali usman', 1000, 'Ali', 99, 0, 99, 'pending', 'Ali', '2024-02-22 10:03:45', '2024-02-22 10:03:45'),
(25, 10, 10, 30.00, 'type', 'Brand', 'Ali usman', 100, 'Ali', 100, 0, 100, 'pending', 'Ali', '2024-02-23 10:01:11', '2024-02-23 10:01:11'),
(26, 10, 10, 1.00, 'cotton', 'Brand', 'Ali usman', 100, 'Ali', 100, 0, 100, 'pending', 'Ali', '2024-02-23 10:03:00', '2024-02-23 10:03:00'),
(27, 1, 2, 2.00, '3', 'Brand', 'Ahmad', 1000, 'Ali', 1000, 0, 1000, 'pending', 'Ali', '2024-02-23 10:20:52', '2024-02-24 04:47:45'),
(29, 1, 1, 2.00, '2', '2', 'Taimoor', 22, 'Ali', 3000, 0, 3000, 'pending', 'Ali', '2024-02-24 03:40:29', '2024-02-24 04:47:01'),
(30, 1, 1, 11.00, 'cotton', 'Brand', 'Ali usman', 100, 'Ali', 10000, 0, 10000, 'pending', 'Ali', '2024-02-24 04:48:23', '2024-02-24 04:48:51'),
(32, 2, 30, 30.00, 'new test', 'new Brand', 'Ali usman', 1, 'Ali', 1, 0, 1, 'pending', 'Ali', '2024-03-01 10:00:01', '2024-03-01 10:03:48'),
(33, 10, 40, 50.00, 'cotton test', 'Brand', 'saad', 100, 'Ali', 1, 0, 1, 'pending', 'Ali', '2024-03-13 12:01:15', '2024-03-13 12:01:15'),
(34, 5, 40, 50.00, 'cotton test', 'Brand', 'Arslan', 100, 'Ali', 100, 0, 100, 'pending', 'Ali', '2024-03-15 07:20:31', '2024-03-15 07:20:31'),
(35, 20, 60, 40.00, 'test1', 'Brand', 'Hassan', 100, 'Ali', 2000, 0, 2000, 'pending', 'Ali', '2024-03-15 07:30:36', '2024-03-15 07:30:36'),
(36, 20, 60, 40.00, 'test1', 'Brand', 'Zain', 100, 'Ali', 2000, 0, 2000, 'pending', 'Ali', '2024-03-15 07:35:22', '2024-03-15 07:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `yarntofabrics`
--

CREATE TABLE `yarntofabrics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_date` date NOT NULL,
  `contractee` varchar(255) NOT NULL,
  `broker` varchar(255) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `order_meter` int(11) NOT NULL,
  `rate_per_meter` double(8,2) NOT NULL,
  `warp_yarn_count` double(8,2) NOT NULL,
  `weft_yarn_count` double(8,2) NOT NULL,
  `warp_rate` double(8,2) NOT NULL,
  `weft_rate` double(8,2) NOT NULL,
  `warpthread` varchar(255) NOT NULL,
  `weftthread` varchar(255) NOT NULL,
  `conv_pick` double(8,2) NOT NULL,
  `conv_meter` double(8,2) NOT NULL,
  `gst` double(8,2) NOT NULL,
  `warp_weight_per_meter` double(8,2) NOT NULL,
  `weft_weight_per_meter` double(8,2) NOT NULL,
  `required_warp_bags` double(8,2) NOT NULL,
  `required_weft_bags` double(8,2) NOT NULL,
  `total_required_bags` double(8,2) NOT NULL,
  `payment` double(10,2) NOT NULL,
  `payment_include_gst` double(10,2) NOT NULL,
  `send_bags` double(8,2) DEFAULT NULL,
  `due_bags` double(8,2) DEFAULT NULL,
  `delivery_instruction` text DEFAULT NULL,
  `payment_instruction` text DEFAULT NULL,
  `quality_instruction` text DEFAULT NULL,
  `other_instruction` text DEFAULT NULL,
  `addby` varchar(255) NOT NULL,
  `yarnbrand` varchar(255) NOT NULL,
  `yarncones` double NOT NULL,
  `yarncount` double NOT NULL,
  `yarntype` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yarntofabrics`
--

INSERT INTO `yarntofabrics` (`id`, `delivery_date`, `contractee`, `broker`, `quality`, `order_meter`, `rate_per_meter`, `warp_yarn_count`, `weft_yarn_count`, `warp_rate`, `weft_rate`, `warpthread`, `weftthread`, `conv_pick`, `conv_meter`, `gst`, `warp_weight_per_meter`, `weft_weight_per_meter`, `required_warp_bags`, `required_weft_bags`, `total_required_bags`, `payment`, `payment_include_gst`, `send_bags`, `due_bags`, `delivery_instruction`, `payment_instruction`, `quality_instruction`, `other_instruction`, `addby`, `yarnbrand`, `yarncones`, `yarncount`, `yarntype`, `created_at`, `updated_at`) VALUES
(1, '2024-02-24', 'Mubeen Textile', 'Ali', '1.00,2.00,114.00', 1000, 350.00, 30.00, 30.00, 370.00, 370.00, 'warp thread', 'weft thread', 70.00, 370.00, 5.00, 0.01, 0.01, 0.10, 0.10, 0.20, 370000.00, 370005.00, 0.00, 0.00, NULL, NULL, NULL, NULL, '', '0', 0, 0, '', '2024-02-21 08:34:07', '2024-02-21 08:34:07'),
(2, '2024-02-24', 'Mubeen Textile', 'Ali', '(1 x 2) / (3(warp thread,warp mill) x 4(weft thread,weft mill)) = 114 (CTN)', 1000, 350.00, 30.00, 30.00, 370.00, 370.00, 'thread', 'thread', 7.00, 370.00, 5.00, 0.01, 0.01, 0.10, 0.10, 0.20, 370000.00, 370005.00, 0.00, 0.00, NULL, NULL, NULL, NULL, '', '0', 0, 0, '', '2024-02-21 09:04:19', '2024-02-21 09:04:19'),
(4, '2024-02-24', 'Mubeen Textile', 'Ali', '(76 x 66) / (30 x 30) = 114 (CTN)', 9000, 45.00, 30.00, 30.00, 370.00, 370.00, 'thread', 'thread', 70.00, 370.00, 5.00, 0.39, 0.34, 35.10, 30.60, 65.70, 3330000.00, 3496500.00, 65.00, 0.70, NULL, NULL, NULL, NULL, 'Ali', '0', 0, 0, '', '2024-02-22 10:31:17', '2024-02-22 10:31:17'),
(5, '2024-03-03', 'Textile', 'Ali', '(72 x 82) / (30 x 30) = 117 (CTN)', 200, 350.00, 30.00, 30.00, 370.00, 370.00, 'thread', 'thread', 70.00, 370.00, 5.00, 0.38, 0.44, 0.76, 0.88, 1.64, 74000.00, 77700.00, 1.64, 0.00, NULL, NULL, NULL, NULL, 'Ali', '0', 0, 0, '', '2024-03-02 03:30:55', '2024-03-02 03:30:55'),
(7, '2024-03-16', 'Textile', 'Ali', '(72 x 82) / (30 x 30) = 117 (CTN)', 1000, 350.00, 30.00, 30.00, 370.00, 370.00, 'thread', 'thread', 70.00, 370.00, 5.00, 0.38, 0.44, 3.80, 4.40, 8.20, 370000.00, 388500.00, 1.00, 7.20, NULL, NULL, NULL, NULL, 'Ali', '0', 0, 0, '', '2024-03-02 09:40:59', '2024-03-02 09:40:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brokers`
--
ALTER TABLE `brokers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fabricinventory`
--
ALTER TABLE `fabricinventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fabricpurchases`
--
ALTER TABLE `fabricpurchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fabricsales`
--
ALTER TABLE `fabricsales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fabrictosuits`
--
ALTER TABLE `fabrictosuits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchasers`
--
ALTER TABLE `purchasers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchasers_name_unique` (`name`);

--
-- Indexes for table `purchasertransactions`
--
ALTER TABLE `purchasertransactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualities`
--
ALTER TABLE `qualities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suitpurchases`
--
ALTER TABLE `suitpurchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suitsale`
--
ALTER TABLE `suitsale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suitsales`
--
ALTER TABLE `suitsales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `suppliertransactions`
--
ALTER TABLE `suppliertransactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `varieties`
--
ALTER TABLE `varieties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `varieties_name_unique` (`name`);

--
-- Indexes for table `yarninventory`
--
ALTER TABLE `yarninventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yarnpurchases`
--
ALTER TABLE `yarnpurchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yarnsales`
--
ALTER TABLE `yarnsales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yarntofabrics`
--
ALTER TABLE `yarntofabrics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brokers`
--
ALTER TABLE `brokers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fabricinventory`
--
ALTER TABLE `fabricinventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fabricpurchases`
--
ALTER TABLE `fabricpurchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `fabricsales`
--
ALTER TABLE `fabricsales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `fabrictosuits`
--
ALTER TABLE `fabrictosuits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchasers`
--
ALTER TABLE `purchasers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchasertransactions`
--
ALTER TABLE `purchasertransactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `qualities`
--
ALTER TABLE `qualities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suitpurchases`
--
ALTER TABLE `suitpurchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suitsale`
--
ALTER TABLE `suitsale`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `suitsales`
--
ALTER TABLE `suitsales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliertransactions`
--
ALTER TABLE `suppliertransactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `varieties`
--
ALTER TABLE `varieties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `yarninventory`
--
ALTER TABLE `yarninventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `yarnpurchases`
--
ALTER TABLE `yarnpurchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `yarnsales`
--
ALTER TABLE `yarnsales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `yarntofabrics`
--
ALTER TABLE `yarntofabrics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
