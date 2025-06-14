-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2025 at 08:51 AM
-- Server version: 10.6.22-MariaDB
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capitalholdingco_appapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$RoAOpKttF8FlxQiUYtdDbeJ5LINPXSuOf1ntiC0q7szeU.IHgS9l2', '2025-05-14 18:03:17', '2025-05-14 18:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `app_versions`
--

CREATE TABLE `app_versions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `android_app_version` varchar(255) NOT NULL,
  `android_app_link` varchar(255) NOT NULL,
  `ios_app_version` varchar(255) NOT NULL,
  `ios_app_link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_versions`
--

INSERT INTO `app_versions` (`id`, `android_app_version`, `android_app_link`, `ios_app_version`, `ios_app_link`, `created_at`, `updated_at`) VALUES
(1, '1.0.0', 'https://play.google.com/', '1.0.0', 'https://apps.apple.com/', '2024-06-13 16:09:59', '2024-06-13 16:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `lottery_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `contact_id`, `lottery_id`, `created_at`, `updated_at`) VALUES
(1, 9, 12, 10, '2025-06-02 19:03:31', '2025-06-02 19:03:31'),
(2, 10, 12, 11, '2025-06-02 19:04:22', '2025-06-02 19:04:22'),
(3, 13, 12, 12, '2025-06-02 19:04:54', '2025-06-02 19:04:54'),
(4, 9, 10, 10, '2025-06-02 19:05:08', '2025-06-02 19:05:08'),
(5, 13, 10, 12, '2025-06-02 19:05:15', '2025-06-02 19:05:15'),
(6, 12, 13, 9, '2025-06-02 19:08:08', '2025-06-02 19:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gateway_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `trx_id` varchar(255) DEFAULT NULL,
  `fee` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','rejected','completed') NOT NULL DEFAULT 'pending',
  `block_reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `firebase_config`
--

CREATE TABLE `firebase_config` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `server_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `firebase_config`
--

INSERT INTO `firebase_config` (`id`, `server_key`, `created_at`, `updated_at`) VALUES
(1, 'BFYAycefjYqA6yuZjYF_hiWJYdgt4oV6e70O3NogG2Pt7gFNhWi0-HP5Tjhz59lpnF7d-amgPSREH5ENaf4PSmA', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gateway_fileds`
--

CREATE TABLE `gateway_fileds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_gateway_id` bigint(20) UNSIGNED NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateway_fileds`
--

INSERT INTO `gateway_fileds` (`id`, `payment_gateway_id`, `field_name`, `field_value`, `created_at`, `updated_at`) VALUES
(1, 1, 'public_key', 'pk_test_78408d4ede8d226d3564a7cdfb52e95bc3ec987e', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(2, 1, 'secret_key', 'sk_test_17d69e40bf069cfd9845426e66f4f9b73f4c50b3', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(3, 1, 'isSandbox', '1', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(4, 2, 'merchant_name', 'Programming Wormhole', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(5, 2, 'country_code', 'US', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(6, 2, 'secret_key', 'sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(7, 2, 'publishable_key', 'pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(8, 2, 'isSandbox', '1', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(9, 3, 'store_id', 'progr64e57b00841a0', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(10, 3, 'store_password', 'progr64e57b00841a0@ssl', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(11, 3, 'isSandbox', '1', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(12, 4, 'key_id', 'rzp_test_kiOtejPbRZU90E', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(13, 4, 'key_secret', 'osRDebzEqbsE1kbyQJ4y0re7', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(14, 4, 'isSandbox', '1', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(15, 5, 'public_key', 'FLWPUBK_TEST-e0787ab2e5b0b6fcb3d32ce465ad44d0-X', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(16, 5, 'sk_key', 'FLWSECK_TEST-af1af523da3f141f894a26be4b071230-X', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(17, 5, 'isSandbox', '1', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(18, 6, 'panel_url', 'https://sandbox.uddoktapay.com', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(19, 6, 'sk_key', '982d381360a69d419689740d9f2e26ce36fb7a50', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(20, 6, 'isSandbox', '1', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(21, 7, 'receiver_upi_id', 'programmingwormhole@upi', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(22, 7, 'receiver_name', 'Programming Wormhole', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(23, 7, 'isSandbox', '1', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(24, 8, 'client_id', 'client_id', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(25, 8, 'secret_key', 'secret_key', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(26, 8, 'isSandbox', '1', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(27, 9, 'api_key', 'api_key', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(28, 9, 'api_secret', 'api_secret', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(29, 9, 'isSandbox', '1', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(30, 10, 'api_key', '49518450465f9bc020a98d2.46084142', '2024-06-13 16:09:59', '2024-06-13 16:37:06'),
(31, 10, 'site_id', '5873406', '2024-06-13 16:09:59', '2024-06-13 16:37:06'),
(32, 10, 'notify_url', 'https://programmingwormhole.com', '2024-06-13 16:09:59', '2024-06-13 16:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_registration` tinyint(1) NOT NULL DEFAULT 1,
  `email_verification` tinyint(1) NOT NULL DEFAULT 0,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT 0,
  `maintenance_message` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `currency_symbol` varchar(255) NOT NULL DEFAULT '$',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `user_registration`, `email_verification`, `maintenance_mode`, `maintenance_message`, `currency`, `currency_symbol`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, NULL, 'INR', '₹', '2024-06-13 16:09:59', '2025-05-17 14:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `logo_favicon_settings`
--

CREATE TABLE `logo_favicon_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) NOT NULL,
  `fav_icon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logo_favicon_settings`
--

INSERT INTO `logo_favicon_settings` (`id`, `logo`, `fav_icon`, `created_at`, `updated_at`) VALUES
(1, '/storage/logo/logo.png', '/storage/logo/favicon.png', '2024-06-13 16:09:59', '2025-06-06 17:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `lotteries`
--

CREATE TABLE `lotteries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `lottery_image` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` enum('active','finished','inactive') NOT NULL DEFAULT 'active',
  `total_ticket` varchar(255) NOT NULL,
  `total_winner` varchar(255) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `draw_date` timestamp NULL DEFAULT NULL,
  `winner_bonuses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`winner_bonuses`)),
  `type` enum('auto','manual') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lotteries`
--

INSERT INTO `lotteries` (`id`, `created_by`, `name`, `lottery_image`, `price`, `status`, `total_ticket`, `total_winner`, `start_date`, `draw_date`, `winner_bonuses`, `type`, `created_at`, `updated_at`) VALUES
(9, 12, 'ramesh contest', '/lottery_images/lottery_683da7142fbb36.18580529.jpg', '120.0', 'finished', '15', '1', '2025-06-02 00:00:00', '2025-06-02 00:00:00', '[{\"bonus\":\"5\",\"image\":null}]', 'auto', '2025-06-02 18:58:52', '2025-06-02 19:05:31'),
(10, 9, 'Simar Contest', '/lottery_images/lottery_683da788463b26.04906291.jpg', '15.0', 'finished', '10', '1', '2025-06-02 00:00:00', '2025-06-02 00:00:00', '[{\"bonus\":\"50\",\"image\":null}]', 'auto', '2025-06-02 19:00:48', '2025-06-02 19:05:31'),
(11, 10, 'Suresh contest', '/lottery_images/lottery_683da7ac1827a4.52521084.jpg', '500.0', 'active', '5', '2', '2025-06-02 00:00:00', '2025-06-02 00:00:00', '\"[{\\\"bonus\\\":\\\"car\\\",\\\"image\\\":\\\"\\\\\\/winner_bonus_images\\\\\\/winner_683da7ac183714.38254049.jpg\\\"},{\\\"bonus\\\":\\\"bike\\\",\\\"image\\\":\\\"\\\\\\/winner_bonus_images\\\\\\/winner_683da7ac184969.63618941.jpg\\\"}]\"', 'auto', '2025-06-02 19:01:24', '2025-06-02 19:01:38'),
(12, 13, 'Geet', '/lottery_images/lottery_683da7ff2c4097.22309694.jpg', '120.0', 'active', '10', '1', '2025-06-02 00:00:00', '2025-06-02 00:00:00', '\"[{\\\"bonus\\\":\\\"10\\\",\\\"image\\\":null}]\"', 'manual', '2025-06-02 19:02:47', '2025-06-02 19:03:00'),
(13, 2, 'Buy n get malaysia', '/lottery_images/lottery_683dd02ae1b1b7.47059471.jpg', '10.0', 'inactive', '100', '5', '2025-06-02 00:00:00', '2025-06-03 00:00:00', '\"[{\\\"bonus\\\":\\\"car\\\",\\\"image\\\":\\\"\\\\\\/winner_bonus_images\\\\\\/winner_683dd02ae1c170.42696156.jpg\\\"},{\\\"bonus\\\":\\\"10000\\\",\\\"image\\\":\\\"\\\\\\/winner_bonus_images\\\\\\/winner_683dd02ae1e252.33137642.jpg\\\"},{\\\"bonus\\\":\\\"5000\\\",\\\"image\\\":null},{\\\"bonus\\\":\\\"phone\\\",\\\"image\\\":null},{\\\"bonus\\\":\\\"100\\\",\\\"image\\\":null}]\"', 'auto', '2025-06-02 21:54:10', '2025-06-02 21:54:10'),
(14, 2, 'test auto', '/lottery_images/lottery_684af45b3bd020.61738691.jpg', '5.0', 'finished', '5', '3', '2025-06-12 00:00:00', '2025-06-12 00:00:00', '\"[{\\\"bonus\\\":\\\"500\\\",\\\"image\\\":null},{\\\"bonus\\\":\\\"200\\\",\\\"image\\\":null},{\\\"bonus\\\":\\\"100\\\",\\\"image\\\":null}]\"', 'auto', '2025-06-12 21:08:03', '2025-06-13 16:07:01'),
(15, 2, 'testwun', '/lottery_images/lottery_684c4c9f527555.19441242.jpg', '10.0', 'active', '7', '3', '2025-06-13 00:00:00', '2025-06-13 00:00:00', '\"[{\\\"bonus\\\":\\\"1000\\\",\\\"image\\\":null},{\\\"bonus\\\":\\\"590\\\",\\\"image\\\":null},{\\\"bonus\\\":\\\"100\\\",\\\"image\\\":null}]\"', 'auto', '2025-06-13 21:36:55', '2025-06-13 21:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `lottery_tickets`
--

CREATE TABLE `lottery_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lottery_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `status` enum('win','lose','pending') NOT NULL DEFAULT 'pending' COMMENT 'win, lose, pending',
  `rank` varchar(255) DEFAULT NULL,
  `prize` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lottery_tickets`
--

INSERT INTO `lottery_tickets` (`id`, `lottery_id`, `user_id`, `ticket_number`, `status`, `rank`, `prize`, `created_at`, `updated_at`) VALUES
(1, 9, 9, '1069959915', 'lose', NULL, NULL, '2025-06-02 19:00:02', '2025-06-02 19:05:31'),
(2, 10, 12, '1014100933', 'lose', NULL, NULL, '2025-06-02 19:03:31', '2025-06-02 19:05:31'),
(3, 9, 10, '1088573282', 'lose', '1', '{\"bonus\":\"5\",\"image\":null}', '2025-06-02 19:03:42', '2025-06-02 19:05:31'),
(4, 11, 12, '1001404617', 'lose', NULL, NULL, '2025-06-02 19:04:22', '2025-06-02 19:05:31'),
(5, 12, 12, '1071140540', 'lose', NULL, NULL, '2025-06-02 19:04:54', '2025-06-02 19:05:31'),
(6, 10, 10, '1034293983', 'win', '1', '{\"bonus\":\"50\",\"image\":null}', '2025-06-02 19:05:08', '2025-06-02 19:05:31'),
(7, 12, 10, '1066074665', 'lose', NULL, NULL, '2025-06-02 19:05:15', '2025-06-02 19:05:31'),
(8, 9, 13, '1013338680', 'pending', NULL, NULL, '2025-06-02 19:08:08', '2025-06-02 19:08:08'),
(9, 14, 2, '1000999085', 'lose', '1', '500', '2025-06-12 21:13:02', '2025-06-13 16:07:01'),
(10, 14, 2, '1064681533', 'lose', '2', '200', '2025-06-12 21:13:02', '2025-06-13 16:07:01'),
(11, 14, 26, '1027046804', 'win', '1', '500', '2025-06-12 21:13:53', '2025-06-13 16:07:01'),
(12, 14, 27, '1042828066', 'win', '2', '200', '2025-06-12 21:14:29', '2025-06-13 16:07:01'),
(13, 14, 27, '1039145060', 'win', '3', '100', '2025-06-12 21:14:29', '2025-06-13 16:07:01'),
(14, 15, 2, '1053322782', 'pending', NULL, NULL, '2025-06-13 21:37:43', '2025-06-13 21:37:43');

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
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_10_30_045831_create_payment_gateways_table', 1),
(4, '2023_10_30_091317_create_admins_table', 1),
(5, '2023_12_16_170650_create_general_settings_table', 1),
(6, '2024_02_10_181638_create_queues_table', 1),
(7, '2024_03_26_081012_create_lotteries_table', 1),
(8, '2024_03_26_094157_create_lottery_tickets_table', 1),
(9, '2024_03_26_175416_create_deposits_table', 1),
(10, '2024_03_28_174408_create_firebase_config_table', 1),
(11, '2024_03_29_112528_create_gateway_fileds_table', 1),
(12, '2024_03_30_023614_create_withdraw_gateways_table', 1),
(13, '2024_03_30_023823_create_withdraw_gateway_dynamic_fields_table', 1),
(14, '2024_03_30_060755_create_withdraws_table', 1),
(15, '2024_03_30_080647_create_withdraw_dynamic_fields_table', 1),
(16, '2024_03_30_155342_create_app_versions_table', 1),
(17, '2024_03_30_185612_create_logo_favicon_settings_table', 1),
(18, '2024_03_31_120434_create_payment_gateway_dynamic_fields_table', 1),
(19, '2024_03_31_151443_create_payment_dynamic_fields_table', 1),
(20, '2024_04_09_124536_create_sliders_table', 1),
(21, '2024_04_28_234559_create_referrals_table', 1),
(22, '2024_04_29_005641_create_refer_settings_table', 1),
(23, '2024_04_29_033247_add_refer_code_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_dynamic_fields`
--

CREATE TABLE `payment_dynamic_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deposit_id` bigint(20) UNSIGNED NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `type` enum('manual','auto') NOT NULL DEFAULT 'manual',
  `fee` varchar(255) NOT NULL,
  `min` varchar(255) NOT NULL,
  `max` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `instruction` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `logo`, `type`, `fee`, `min`, `max`, `currency`, `rate`, `instruction`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PayStack', '/storage/gateways/automatic/paystack.png', 'auto', '2', '20', '10000', 'USD', '1', NULL, 'active', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(2, 'Stripe', '/storage/gateways/automatic/stripe.webp', 'auto', '2', '20', '10000', 'USD', '1', NULL, 'active', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(3, 'SSLCOMMERZ', '/storage/gateways/automatic/SSLCOMMERZ.png', 'auto', '2', '20', '10000', 'BDT', '1', NULL, 'active', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(4, 'RazorPay', '/storage/gateways/automatic/razorpay.png', 'auto', '2', '20', '10000', 'INR', '1', NULL, 'active', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(5, 'Flutterwave', '/storage/gateways/automatic/flutterwave.png', 'auto', '2', '20', '10000', 'NGN', '1240', NULL, 'active', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(6, 'UddoktaPay', '/storage/gateways/automatic/UddoktaPay.png', 'auto', '2', '20', '10000', 'BDT', '108', NULL, 'active', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(7, 'UPI', '/storage/gateways/automatic/upi.webp', 'auto', '2', '20', '10000', 'INR', '100', NULL, 'active', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(8, 'PayPal', '/storage/gateways/automatic/paypal.png', 'auto', '2', '20', '10000', 'USD', '100', NULL, 'active', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(9, 'Binance', '/storage/gateways/automatic/binance.png', 'auto', '2', '20', '10000', 'USD', '100', NULL, 'active', '2024-06-13 16:09:59', '2024-06-13 16:09:59'),
(10, 'CinetPay', '/storage/gateways/automatic/cinetpay.webp', 'auto', '2', '20', '10000', 'USD', '100', NULL, 'active', '2024-06-13 16:09:59', '2024-06-13 16:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_dynamic_fields`
--

CREATE TABLE `payment_gateway_dynamic_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_gateway_id` bigint(20) UNSIGNED NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(100) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth', 'f8c56089feeb23aae246cae4e4ee6e43eb4b116033875c5c7c43d338dabfd4d0', '[\"*\"]', '2024-06-13 17:05:15', NULL, '2024-06-13 16:35:43', '2024-06-13 17:05:15'),
(2, 'App\\Models\\User', 1, 'auth', 'f2d4c367b1c5648eb61e3e46aa4b701152c2467eba77d38aac3ebbdc6464de11', '[\"*\"]', '2025-05-15 15:28:27', NULL, '2025-05-15 15:25:24', '2025-05-15 15:28:27'),
(3, 'App\\Models\\User', 2, 'auth', 'fc9c2303d364cf9ccba0bad1f8e26d1dde29f36445c1e611a867b744aea8114c', '[\"*\"]', '2025-05-15 19:15:06', NULL, '2025-05-15 19:07:50', '2025-05-15 19:15:06'),
(4, 'App\\Models\\User', 2, 'auth', '106e02aab962af34fababd5476f15a4ed3d273989a69fe3e42c48ee525f50a87', '[\"*\"]', '2025-05-17 09:04:09', NULL, '2025-05-15 19:16:08', '2025-05-17 09:04:09'),
(5, 'App\\Models\\User', 3, 'auth', 'd11fd9a6b4f4c4a2a4b79b672139c0d88bcae258c85c53b38eb04f7572b8f2f0', '[\"*\"]', '2025-06-07 01:36:59', NULL, '2025-05-17 14:52:09', '2025-06-07 01:36:59'),
(6, 'App\\Models\\User', 4, 'auth', 'de81e1b89a2eaf2fc49fc2c935e600ea0cbeec142e9d47f84e7563ce4e4b4e91', '[\"*\"]', '2025-05-18 17:58:40', NULL, '2025-05-18 17:58:38', '2025-05-18 17:58:40'),
(7, 'App\\Models\\User', 4, 'auth', '6269b2ccfd077d77f015877b3c75c94c2f9d97646faff2ec7044f23b439fc3ac', '[\"*\"]', '2025-05-18 17:59:51', NULL, '2025-05-18 17:59:08', '2025-05-18 17:59:51'),
(8, 'App\\Models\\User', 5, 'auth', '6cc5ba2fd84c7cf6ca3ad6dafd10faa429cc492ead23d82b536d416a0e6f20b2', '[\"*\"]', '2025-05-29 07:51:11', NULL, '2025-05-19 05:13:47', '2025-05-29 07:51:11'),
(9, 'App\\Models\\User', 2, 'auth', '5415cea7d8e5f6e46ff2a9f8be2a452b98006f85450627f4525190b1af76e697', '[\"*\"]', '2025-06-13 13:49:36', NULL, '2025-05-29 07:51:56', '2025-06-13 13:49:36'),
(10, 'App\\Models\\User', 1, 'auth', '9944a5cc96c48ff7b2a092cf0751990e18d078ba52dc4e53acee659e7dc99d5f', '[\"*\"]', NULL, NULL, '2025-06-02 13:05:09', '2025-06-02 13:05:09'),
(11, 'App\\Models\\User', 1, 'auth', 'a9fb480e823a50d548f5926db3fdad30712a6aa773904ab7d9d9e91cca817751', '[\"*\"]', NULL, NULL, '2025-06-02 13:14:23', '2025-06-02 13:14:23'),
(12, 'App\\Models\\User', 6, 'auth', '0aa5b354b229f0b2e3022c85025abb00853f5c1a6ee4553d11c75fa7fc373cc6', '[\"*\"]', NULL, NULL, '2025-06-02 15:00:21', '2025-06-02 15:00:21'),
(13, 'App\\Models\\User', 7, 'auth', 'e9c6ea2ecde9768c9ed982f24975842edde4a8611ba0e97b63b3160ee5ea2a27', '[\"*\"]', NULL, NULL, '2025-06-02 15:01:52', '2025-06-02 15:01:52'),
(14, 'App\\Models\\User', 6, 'auth', '0e282693a96e1b3da5760047be396c8ecdd84256899646d90039b41312aea894', '[\"*\"]', '2025-06-02 15:10:07', NULL, '2025-06-02 15:04:44', '2025-06-02 15:10:07'),
(15, 'App\\Models\\User', 8, 'auth', '927b31eb6b78b92b5bde19fae9ed69dd9f5641bdb1134bb80743833b1b5089e0', '[\"*\"]', NULL, NULL, '2025-06-02 15:09:41', '2025-06-02 15:09:41'),
(16, 'App\\Models\\User', 9, 'auth', '61b876b415184085e3b466929fadff0c819d15c0cec746b41547aa40cb56f024', '[\"*\"]', '2025-06-02 15:14:13', NULL, '2025-06-02 15:11:29', '2025-06-02 15:14:13'),
(17, 'App\\Models\\User', 9, 'auth', '2a464837621d0dd6ff59da72235f9ce0ecdf4cce1add0d2a68dc94993d1600b9', '[\"*\"]', '2025-06-02 16:09:36', NULL, '2025-06-02 15:17:00', '2025-06-02 16:09:36'),
(18, 'App\\Models\\User', 9, 'auth', '751200022aba844ddb311bae8a2d7b31790684676fac636a3668fe960c393925', '[\"*\"]', NULL, NULL, '2025-06-02 15:20:38', '2025-06-02 15:20:38'),
(19, 'App\\Models\\User', 10, 'auth', '87c9eb95c883bd0d6c6018246c0821c9831fa496d8d42e4a53c3421da367e63e', '[\"*\"]', '2025-06-02 16:00:58', NULL, '2025-06-02 15:40:46', '2025-06-02 16:00:58'),
(20, 'App\\Models\\User', 10, 'auth', '3020a6bcea953bdae4b102b4c4d125302cc6deacde4d762d639409aa056f99ee', '[\"*\"]', '2025-06-02 16:24:07', NULL, '2025-06-02 16:01:17', '2025-06-02 16:24:07'),
(21, 'App\\Models\\User', 10, 'auth', '884534f49b775e6dff33aa2d660bc1086add822c949315d589206c7fa22888f4', '[\"*\"]', '2025-06-02 19:06:49', NULL, '2025-06-02 16:05:09', '2025-06-02 19:06:49'),
(22, 'App\\Models\\User', 9, 'auth', '5dee3e82a37948b9c3d824decaa1b317033a7b54b45ae0354b33c23b3487f050', '[\"*\"]', '2025-06-02 19:09:51', NULL, '2025-06-02 16:22:30', '2025-06-02 19:09:51'),
(23, 'App\\Models\\User', 10, 'auth', '1ecf7a45d89016cfeacb8d13506ccd6a8eae8c8489d4f8b191afcbf3be2dcb8a', '[\"*\"]', '2025-06-02 19:27:40', NULL, '2025-06-02 16:24:21', '2025-06-02 19:27:40'),
(24, 'App\\Models\\User', 11, 'auth', '4d1fdeb6b1b0afdec26cde5bd9ee2fbb34a94be01ca65c576536ddd18719b96c', '[\"*\"]', '2025-06-02 18:52:59', NULL, '2025-06-02 18:15:30', '2025-06-02 18:52:59'),
(25, 'App\\Models\\User', 12, 'auth', '509cc31196d46aef2ed1a3a8b4d796f5da5c2e0ce1cd5b6dc46ae466799bd383', '[\"*\"]', '2025-06-02 18:54:54', NULL, '2025-06-02 18:36:34', '2025-06-02 18:54:54'),
(26, 'App\\Models\\User', 12, 'auth', '4d087896b87f2c254941a86dc3f5e2bb1ab09cd770c89f95cb8d2299ba0c9e3f', '[\"*\"]', '2025-06-14 11:16:29', NULL, '2025-06-02 18:57:34', '2025-06-14 11:16:29'),
(27, 'App\\Models\\User', 13, 'auth', '0e99969cfcd0f7c84b966aa7ae638e6c51fd68082478e2988c7c517972177ec4', '[\"*\"]', '2025-06-02 19:09:13', NULL, '2025-06-02 18:57:57', '2025-06-02 19:09:13'),
(28, 'App\\Models\\User', 9, 'auth', 'd4357e23f810c5e80623c027f48dc4f61fec8bf4df3edeb05efcc908b5894eed', '[\"*\"]', '2025-06-03 12:13:59', NULL, '2025-06-02 18:59:54', '2025-06-03 12:13:59'),
(29, 'App\\Models\\User', 2, 'auth', 'a00997e942098421ee658970645c0857b1efe28f7a5f4e45b8ba7db5ab764129', '[\"*\"]', '2025-06-02 21:54:10', NULL, '2025-06-02 21:28:11', '2025-06-02 21:54:10'),
(30, 'App\\Models\\User', 14, 'auth', '7d3a0ede74b0431feead439997d6b350ab346baf7a9a74487885180ab8762417', '[\"*\"]', '2025-06-03 12:03:58', NULL, '2025-06-03 12:03:42', '2025-06-03 12:03:58'),
(31, 'App\\Models\\User', 9, 'auth', '603d663aab2d0a023140651e1aac35a1dfbe621a7f53158344c6a00c22e73537', '[\"*\"]', '2025-06-03 12:29:27', NULL, '2025-06-03 12:21:26', '2025-06-03 12:29:27'),
(32, 'App\\Models\\User', 9, 'auth', '2aa86788de443e5c0fa3329e8228f19f08146a0a9bfd6fc1104896205140ec11', '[\"*\"]', '2025-06-03 14:30:02', NULL, '2025-06-03 14:29:58', '2025-06-03 14:30:02'),
(33, 'App\\Models\\User', 9, 'auth', 'deb502ff5501314ab1998f9dd95fac04a69de6c283e6343203ecc0b37819f7e2', '[\"*\"]', '2025-06-03 14:53:48', NULL, '2025-06-03 14:40:21', '2025-06-03 14:53:48'),
(34, 'App\\Models\\User', 9, 'auth', '364c408615b7c6611142320ddbec971eec14909f2b979b135f07143719db6f15', '[\"*\"]', '2025-06-03 15:14:54', NULL, '2025-06-03 14:57:53', '2025-06-03 15:14:54'),
(35, 'App\\Models\\User', 9, 'auth', '0bfa2c1169b04a2a9af7ae66cb5e516d6c662af2441d7b46d155305039072081', '[\"*\"]', '2025-06-03 16:31:12', NULL, '2025-06-03 16:31:10', '2025-06-03 16:31:12'),
(36, 'App\\Models\\User', 9, 'auth', '85effa70c99d73c65b224ddf492f4a0e667dea324c200de0f877998218f6d422', '[\"*\"]', '2025-06-03 16:54:44', NULL, '2025-06-03 16:54:44', '2025-06-03 16:54:44'),
(37, 'App\\Models\\User', 9, 'auth', '5d13523368d9024f270a5062652db4470a83592e32f30a3600be37abd88955b0', '[\"*\"]', '2025-06-03 17:19:13', NULL, '2025-06-03 17:16:08', '2025-06-03 17:19:13'),
(38, 'App\\Models\\User', 15, 'auth', 'ac0dcd4b49f19820822abee8268e4ebed819f8eca31b77d00720b7329c765f08', '[\"*\"]', '2025-06-10 18:57:02', NULL, '2025-06-03 17:59:14', '2025-06-10 18:57:02'),
(39, 'App\\Models\\User', 10, 'auth', '004d3a965ebae15eead1ef711914dc39b4407039dd59eda7f7e7fffb56fc0d8c', '[\"*\"]', '2025-06-03 18:08:45', NULL, '2025-06-03 18:06:47', '2025-06-03 18:08:45'),
(40, 'App\\Models\\User', 9, 'auth', '7d2601881e5a903082e56085a7203348524d059c0b17502dae83c439a5c2cbf3', '[\"*\"]', '2025-06-05 12:44:37', NULL, '2025-06-05 12:44:27', '2025-06-05 12:44:37'),
(41, 'App\\Models\\User', 2, 'auth', 'a40428bcc85a03fddacbb4ff48abdd60771043089930b1f85f70e4847e0b9d66', '[\"*\"]', '2025-06-05 16:08:09', NULL, '2025-06-05 16:08:04', '2025-06-05 16:08:09'),
(42, 'App\\Models\\User', 16, 'auth', '67d66a2931f148836083aa4450130fcdec88763c51a0b1600dc79b31e2fa68ae', '[\"*\"]', '2025-06-05 19:35:23', NULL, '2025-06-05 16:09:05', '2025-06-05 19:35:23'),
(43, 'App\\Models\\User', 2, 'auth', 'e501af80558843e33d8af058ec0840c33993901a6b5e62316babd8bfe3a4d593', '[\"*\"]', NULL, NULL, '2025-06-05 19:35:39', '2025-06-05 19:35:39'),
(44, 'App\\Models\\User', 2, 'auth', '2742e3b5c9c22020560d90a6eea3d580eb175183d9bdd7535b795a64ce9913f6', '[\"*\"]', NULL, NULL, '2025-06-05 19:38:25', '2025-06-05 19:38:25'),
(45, 'App\\Models\\User', 2, 'auth', 'c2e871e07bc1669207cd92b6d642803086d079cbfba843b0f0d7d2dff7769c53', '[\"*\"]', NULL, NULL, '2025-06-05 19:38:25', '2025-06-05 19:38:25'),
(46, 'App\\Models\\User', 17, 'auth', '528c1b07668fd2256ecd5309a00099610e38f5b1a6954a9b52f4e9480937cb20', '[\"*\"]', '2025-06-05 21:42:05', NULL, '2025-06-05 21:41:17', '2025-06-05 21:42:05'),
(47, 'App\\Models\\User', 17, 'auth', '072435af4a55a026e1aa063ed3a5d4ea37c7db1ea9497399053b8dc687752acc', '[\"*\"]', NULL, NULL, '2025-06-05 21:42:13', '2025-06-05 21:42:13'),
(48, 'App\\Models\\User', 16, 'auth', '45da5ef74eb6b79360d6730442fd05d5bb2d4af128361666452cea80e9f70686', '[\"*\"]', '2025-06-06 17:28:49', NULL, '2025-06-06 17:08:02', '2025-06-06 17:28:49'),
(49, 'App\\Models\\User', 2, 'auth', '14cd0dd3a8caa973412413fffc9bfa721beab052fe88a6ac8343db46a8841010', '[\"*\"]', NULL, NULL, '2025-06-06 23:44:47', '2025-06-06 23:44:47'),
(50, 'App\\Models\\User', 2, 'auth', '222bfc3596ca6fd533867cfa86f3d51cdc809e7ea6ad6fed8afa8eb642c33fec', '[\"*\"]', '2025-06-06 23:48:20', NULL, '2025-06-06 23:46:19', '2025-06-06 23:48:20'),
(51, 'App\\Models\\User', 18, 'auth', '334fdccb3fa8a1aa693de82a1669da032544b8c6071c344dfd901a273a5a269b', '[\"*\"]', '2025-06-06 23:49:07', NULL, '2025-06-06 23:49:03', '2025-06-06 23:49:07'),
(52, 'App\\Models\\User', 4, 'auth', '3a15e658359a347d944bf8f6d7f16f6d46460df0f21d141a824b07bc37a7b6c5', '[\"*\"]', '2025-06-07 01:49:44', NULL, '2025-06-07 01:37:22', '2025-06-07 01:49:44'),
(53, 'App\\Models\\User', 4, 'auth', 'c75cb156a1fd9508222a63f870605677715cd4c3f18eb1dff5f2aa6efa045c5b', '[\"*\"]', '2025-06-07 01:42:23', NULL, '2025-06-07 01:42:22', '2025-06-07 01:42:23'),
(54, 'App\\Models\\User', 4, 'auth', 'fba9fdf53d7a3475de87e846e99223548effc6f501770d4675ed02588f9f9a14', '[\"*\"]', '2025-06-08 15:38:31', NULL, '2025-06-08 15:35:52', '2025-06-08 15:38:31'),
(55, 'App\\Models\\User', 9, 'auth', 'd006995d6a2dc74c21b43fef336be636a5e2d99f4d13a594fbd03cca66da049b', '[\"*\"]', '2025-06-09 18:04:35', NULL, '2025-06-09 11:23:13', '2025-06-09 18:04:35'),
(56, 'App\\Models\\User', 10, 'auth', '13af92c2757230a023d24b8a67f543809992d3e1be1a18265a3a2fa880db5c21', '[\"*\"]', NULL, NULL, '2025-06-09 13:02:23', '2025-06-09 13:02:23'),
(57, 'App\\Models\\User', 10, 'auth', '526e462e07f8dd678ef12892cd14bc9c39f5ba13fe9ff849e5d6b18673644448', '[\"*\"]', NULL, NULL, '2025-06-09 13:05:11', '2025-06-09 13:05:11'),
(58, 'App\\Models\\User', 10, 'auth', '1a118b9661b2d6685c2dbf261e288f52b411a01dd30c659aa2ac72153ea03b35', '[\"*\"]', NULL, NULL, '2025-06-09 13:06:39', '2025-06-09 13:06:39'),
(59, 'App\\Models\\User', 10, 'auth', 'b7e75bd119df15a5b7f82120524608e6c71fa6c64387003f33ea502730431dae', '[\"*\"]', '2025-06-11 15:11:52', NULL, '2025-06-09 13:19:38', '2025-06-11 15:11:52'),
(60, 'App\\Models\\User', 10, 'auth', 'f5e4f102e30d6cd7978ec8990eb84c14fbfeb001e1762b5ed8ca799880ac2829', '[\"*\"]', NULL, NULL, '2025-06-09 14:07:41', '2025-06-09 14:07:41'),
(61, 'App\\Models\\User', 10, 'auth', '357150132675ee0f2f79562dda33e2ebff5d88641c9d738d9c262c4e11ed8d04', '[\"*\"]', NULL, NULL, '2025-06-09 14:37:44', '2025-06-09 14:37:44'),
(62, 'App\\Models\\User', 10, 'auth', 'fb0ecf3167318fcbe95b250b6698c683b799e26b4c71787df8bcaf38a869634d', '[\"*\"]', NULL, NULL, '2025-06-09 14:40:52', '2025-06-09 14:40:52'),
(63, 'App\\Models\\User', 10, 'auth', '03165cd8c4ad786acd8d85ef6f77bbadb146eb30e8b6da505818062182dd14ce', '[\"*\"]', NULL, NULL, '2025-06-09 14:42:37', '2025-06-09 14:42:37'),
(64, 'App\\Models\\User', 10, 'auth', 'dfaecb19918501ec7987ec2aff4cecbe8783cb13969f8875182e09c3f7c5a569', '[\"*\"]', NULL, NULL, '2025-06-09 14:46:12', '2025-06-09 14:46:12'),
(65, 'App\\Models\\User', 10, 'auth', 'e21d46a98b5f27dfa1bf8056cd9889fdab9e312827a2d97306643aa2258fcc96', '[\"*\"]', NULL, NULL, '2025-06-09 14:48:51', '2025-06-09 14:48:51'),
(66, 'App\\Models\\User', 10, 'auth', '0c8bebb9d08d298685636364ddc16813cbb4e296768635fc88b67616199eadae', '[\"*\"]', NULL, NULL, '2025-06-09 14:56:38', '2025-06-09 14:56:38'),
(67, 'App\\Models\\User', 10, 'auth', '3c832e68a86a8503e388768de525bdc7f9266e5679c9fd86215440644663013e', '[\"*\"]', NULL, NULL, '2025-06-09 14:58:21', '2025-06-09 14:58:21'),
(68, 'App\\Models\\User', 10, 'auth', '1084ed6ea59d5132246d3c1f59dd7a2aa0da2ca160840d55ce3f154f9b3dbce2', '[\"*\"]', NULL, NULL, '2025-06-09 15:03:45', '2025-06-09 15:03:45'),
(69, 'App\\Models\\User', 10, 'auth', 'f0e5a1a6a3c963519f5b154cb57c2376fe4ef5bd456a5fad26b806c83a3e5844', '[\"*\"]', NULL, NULL, '2025-06-09 15:06:44', '2025-06-09 15:06:44'),
(70, 'App\\Models\\User', 10, 'auth', '95ab478cd75bdb50eefeefd257071280d5a711126111ae78ee7eada91387aadc', '[\"*\"]', NULL, NULL, '2025-06-09 15:14:30', '2025-06-09 15:14:30'),
(71, 'App\\Models\\User', 10, 'auth', '5b67c742dbcb4d11e0e9104668f71627e11e5999e09daa29cdb9c79f7cab8475', '[\"*\"]', NULL, NULL, '2025-06-09 15:16:09', '2025-06-09 15:16:09'),
(72, 'App\\Models\\User', 10, 'auth', 'f4edd763ab0713cf7b055db8476fc17635911c4b5f02f975816d23e7230ce05c', '[\"*\"]', NULL, NULL, '2025-06-09 15:20:33', '2025-06-09 15:20:33'),
(73, 'App\\Models\\User', 10, 'auth', 'a1c796a45f269c6bf9daa5d9c2ca8e1170864f86c6abb85857dbced07d8c0e2d', '[\"*\"]', NULL, NULL, '2025-06-09 15:25:42', '2025-06-09 15:25:42'),
(74, 'App\\Models\\User', 19, 'auth', 'b7088bd16db8d96f3f1dbf8b42ea8f83c3f266ff428f0d54947e9e9f74378572', '[\"*\"]', NULL, NULL, '2025-06-09 15:28:06', '2025-06-09 15:28:06'),
(75, 'App\\Models\\User', 20, 'auth', '2ef66e37ce6fb9988d5cf84ac38c18f3f0375ca4ba5f64914adabaafa7a195c9', '[\"*\"]', NULL, NULL, '2025-06-09 15:29:44', '2025-06-09 15:29:44'),
(76, 'App\\Models\\User', 10, 'auth', '0b75d9348dbd5a9e882852b627472f2f04456e7762f7c254fbc9104419f5e36a', '[\"*\"]', NULL, NULL, '2025-06-09 15:30:57', '2025-06-09 15:30:57'),
(77, 'App\\Models\\User', 10, 'auth', 'd25483ebaf2d53ed7fc600aa3fb4363702e67509e960f929a0d88ee16781a1ba', '[\"*\"]', NULL, NULL, '2025-06-09 15:32:17', '2025-06-09 15:32:17'),
(78, 'App\\Models\\User', 10, 'auth', '8b603dc2a2fa3034a36ebbdb5c4638dfee9a2cd51baf609d2bce5517bd6fee44', '[\"*\"]', NULL, NULL, '2025-06-09 15:38:33', '2025-06-09 15:38:33'),
(79, 'App\\Models\\User', 10, 'auth', '4307f612e32a3eba7eaeac8a563e8a9b157dac3c31c6b0793ea5ac65dca339d2', '[\"*\"]', NULL, NULL, '2025-06-09 15:55:10', '2025-06-09 15:55:10'),
(80, 'App\\Models\\User', 10, 'auth', '05452aaafa99971786adf0fccc8cf844f6bccc6749b2f402bee2385f421a9ccb', '[\"*\"]', NULL, NULL, '2025-06-09 16:00:43', '2025-06-09 16:00:43'),
(81, 'App\\Models\\User', 10, 'auth', '3aee2ba7e4682d65b2f3c6f54f9d3787896fc55591461b6be99af7f40e90eace', '[\"*\"]', NULL, NULL, '2025-06-09 16:02:34', '2025-06-09 16:02:34'),
(82, 'App\\Models\\User', 10, 'auth', '1c7f821ae09ec1d67762587c67722d61382d3933d8fc52235b4457e57f44ed29', '[\"*\"]', NULL, NULL, '2025-06-09 16:04:26', '2025-06-09 16:04:26'),
(83, 'App\\Models\\User', 10, 'auth', '566f2c9ef24407777417af814cb0a86b61cfdb746aa6fec2e5492962ccd21677', '[\"*\"]', NULL, NULL, '2025-06-09 16:07:08', '2025-06-09 16:07:08'),
(84, 'App\\Models\\User', 10, 'auth', '2d0d6af3fa572f7831ddd4fe55a2e1b09bd65cdff18a89e278baf053976b9556', '[\"*\"]', '2025-06-09 16:37:33', NULL, '2025-06-09 16:07:48', '2025-06-09 16:37:33'),
(85, 'App\\Models\\User', 21, 'auth', '04807fe62b6dd3ee12477f8fb4568da011380406e7b17cfc1b8d261c97925e4f', '[\"*\"]', '2025-06-09 16:08:39', NULL, '2025-06-09 16:08:35', '2025-06-09 16:08:39'),
(86, 'App\\Models\\User', 22, 'auth', '5975bb750711f2261771162c87e2b4972774db47df3e1ef80500af71fcfb4a89', '[\"*\"]', '2025-06-09 16:12:04', NULL, '2025-06-09 16:12:01', '2025-06-09 16:12:04'),
(87, 'App\\Models\\User', 23, 'auth', 'd7b141a7736a6757f0bd17a21df10a10e38ab03607ca271ea387349165013d8e', '[\"*\"]', '2025-06-09 16:19:53', NULL, '2025-06-09 16:16:48', '2025-06-09 16:19:53'),
(88, 'App\\Models\\User', 10, 'auth', '643551d3e71777ac3f32a56cae3b9ae97d7a35fd02ffcbe6e8fe1ac589b079a7', '[\"*\"]', NULL, NULL, '2025-06-09 16:36:24', '2025-06-09 16:36:24'),
(89, 'App\\Models\\User', 24, 'auth', '314fe53aa0ef219af366f20d3f6ba27907d4365b2f132936df5f1002a9d13084', '[\"*\"]', '2025-06-09 16:40:27', NULL, '2025-06-09 16:37:18', '2025-06-09 16:40:27'),
(90, 'App\\Models\\User', 25, 'auth', '314e6faad4891b7244272405a99ca5f359cd1c8a69d572cab6e46147d5fb16fa', '[\"*\"]', '2025-06-09 16:42:57', NULL, '2025-06-09 16:42:05', '2025-06-09 16:42:57'),
(91, 'App\\Models\\User', 25, 'auth', 'ce5ddf70e1ff0250331b18105035760d26d7720d4934666641485ad868e52fb9', '[\"*\"]', '2025-06-09 16:48:29', NULL, '2025-06-09 16:46:44', '2025-06-09 16:48:29'),
(92, 'App\\Models\\User', 25, 'auth', '3b341127178ec7af029a2629f7daa0bc279af5cfdc06298f02c829b8b401e925', '[\"*\"]', '2025-06-10 11:43:35', NULL, '2025-06-09 16:48:53', '2025-06-10 11:43:35'),
(93, 'App\\Models\\User', 25, 'auth', '22cfeaa5e82408488472200e8e12f3acce2ff332622894cf8b6dcd254aee631f', '[\"*\"]', '2025-06-10 18:30:25', NULL, '2025-06-10 11:47:56', '2025-06-10 18:30:25'),
(94, 'App\\Models\\User', 18, 'auth', '96238a09a03d3e363c2845f0761b2f46c9c26e68bab2dc66f641a35a3b26ec18', '[\"*\"]', '2025-06-10 18:04:55', NULL, '2025-06-10 17:49:03', '2025-06-10 18:04:55'),
(95, 'App\\Models\\User', 18, 'auth', '7f5674edc2af27756113934149d5387b15f36eac7f36348931eb290d31bf5229', '[\"*\"]', '2025-06-11 13:11:08', NULL, '2025-06-10 18:32:06', '2025-06-11 13:11:08'),
(96, 'App\\Models\\User', 18, 'auth', '377b46a5520cb010126a5b4d45e1633524b9d801ec3974b4009faeca9f489293', '[\"*\"]', '2025-06-11 11:07:33', NULL, '2025-06-10 19:04:04', '2025-06-11 11:07:33'),
(97, 'App\\Models\\User', 2, 'auth', 'd323325ac23b11929577f63c1a43625864295c8bf8fcb30de10a9d582dcade00', '[\"*\"]', '2025-06-10 20:34:55', NULL, '2025-06-10 20:22:33', '2025-06-10 20:34:55'),
(98, 'App\\Models\\User', 2, 'auth', 'e41960a8f8cb914552bd92169dda7866650ea5bcd85a3428ffd53d488f697af6', '[\"*\"]', NULL, NULL, '2025-06-10 20:35:24', '2025-06-10 20:35:24'),
(99, 'App\\Models\\User', 2, 'auth', '7f4f5000861f74a62179f42451ba325af9f886a8e5ac09caca6a1ef9a53b3682', '[\"*\"]', '2025-06-10 20:36:39', NULL, '2025-06-10 20:35:24', '2025-06-10 20:36:39'),
(100, 'App\\Models\\User', 26, 'auth', 'd7045723f206d292acb0802dbaa5867abef7c894a42738414cb96ad1da1c9825', '[\"*\"]', '2025-06-10 20:37:36', NULL, '2025-06-10 20:37:26', '2025-06-10 20:37:36'),
(101, 'App\\Models\\User', 2, 'auth', '022ef2a9ec7ac9c3e02d72eb5a677853d8c011392156ea36902c8eed54e3d72d', '[\"*\"]', '2025-06-10 20:41:05', NULL, '2025-06-10 20:38:08', '2025-06-10 20:41:05'),
(102, 'App\\Models\\User', 26, 'auth', '3d31be17fc00618e5e071f54494da3da1ffd2a9785c19affd6653582970c0ea7', '[\"*\"]', '2025-06-11 12:39:44', NULL, '2025-06-10 20:43:47', '2025-06-11 12:39:44'),
(103, 'App\\Models\\User', 18, 'auth', '293087b8d540a64f42f3f8d26777dae61fb0bb5e92011673e8b95980d44c6903', '[\"*\"]', '2025-06-11 11:10:40', NULL, '2025-06-11 11:08:42', '2025-06-11 11:10:40'),
(104, 'App\\Models\\User', 25, 'auth', '367b764e6ea74db09ea10443c3ac8e59a12274f271fba5755e4e1ec207128a9f', '[\"*\"]', '2025-06-11 11:15:57', NULL, '2025-06-11 11:15:36', '2025-06-11 11:15:57'),
(105, 'App\\Models\\User', 25, 'auth', '60bd4e3d29d2249544897a033f3cd40a6818865a1bf7d2c2a464115dc5150f44', '[\"*\"]', '2025-06-11 11:22:02', NULL, '2025-06-11 11:16:09', '2025-06-11 11:22:02'),
(106, 'App\\Models\\User', 18, 'auth', 'cbd06a09e72768cc269fedcb547916e7bc094ec5bc9bce981b7e21e4ac3aef01', '[\"*\"]', '2025-06-11 11:55:49', NULL, '2025-06-11 11:20:20', '2025-06-11 11:55:49'),
(107, 'App\\Models\\User', 18, 'auth', '1ef98323b253077bc4677814d3d6f4ab70f4562df936d6b6549066bbaa94953b', '[\"*\"]', '2025-06-11 12:30:55', NULL, '2025-06-11 11:25:49', '2025-06-11 12:30:55'),
(108, 'App\\Models\\User', 25, 'auth', 'd212adfefd489fa5c72142ed0f854e7072b82a402860d76c0d658411c98088c0', '[\"*\"]', '2025-06-11 16:12:51', NULL, '2025-06-11 11:56:01', '2025-06-11 16:12:51'),
(109, 'App\\Models\\User', 18, 'auth', 'd4dfb80138ebceec312f9d760627bf60b1818f005e8a054456b517ec0a3ce42a', '[\"*\"]', '2025-06-11 13:10:25', NULL, '2025-06-11 12:40:11', '2025-06-11 13:10:25'),
(110, 'App\\Models\\User', 25, 'auth', '119ef92948dab2506fbf5c8a243fefec46f2d76426eb75e84f28f77ff6ccad62', '[\"*\"]', '2025-06-11 13:10:42', NULL, '2025-06-11 13:10:37', '2025-06-11 13:10:42'),
(111, 'App\\Models\\User', 25, 'auth', '83f940c66d1e600b65099ae32c9fee93b2983cfcab3e0f7594a27d6efd85a592', '[\"*\"]', '2025-06-11 13:39:38', NULL, '2025-06-11 13:15:22', '2025-06-11 13:39:38'),
(112, 'App\\Models\\User', 18, 'auth', 'd71748b4d39ed5e2c2e522441544571dd9613313a6523944c5d561e336fd250d', '[\"*\"]', '2025-06-11 18:39:03', NULL, '2025-06-11 13:40:09', '2025-06-11 18:39:03'),
(113, 'App\\Models\\User', 18, 'auth', '11b47a5da58a2cd265c4ac3152f6d651379429199d6045b7408a1c5217f2fcff', '[\"*\"]', '2025-06-12 17:20:23', NULL, '2025-06-11 14:16:08', '2025-06-12 17:20:23'),
(114, 'App\\Models\\User', 2, 'auth', '7bd23ef34170cdfb275cc6b6eb49edd3a5ddc0b3ef24b20343ca6b75fba27af5', '[\"*\"]', '2025-06-11 14:26:03', NULL, '2025-06-11 14:22:24', '2025-06-11 14:26:03'),
(115, 'App\\Models\\User', 27, 'auth', 'd22a447d71717c1bda173b63dd9467ec0799a7fc2abfcbaf444d12e24f4db331', '[\"*\"]', '2025-06-11 14:29:47', NULL, '2025-06-11 14:27:04', '2025-06-11 14:29:47'),
(116, 'App\\Models\\User', 2, 'auth', '4e477bb05b3836a6a5b01275cc97a540c85c1c40c17068ef82395a4138588cea', '[\"*\"]', '2025-06-11 15:32:17', NULL, '2025-06-11 14:30:12', '2025-06-11 15:32:17'),
(117, 'App\\Models\\User', 25, 'auth', '3eaffec3c06f11d3d0049eafe7bb1fec52a96268d1102a0f9f766d1c797b78a4', '[\"*\"]', '2025-06-11 14:50:13', NULL, '2025-06-11 14:37:24', '2025-06-11 14:50:13'),
(118, 'App\\Models\\User', 18, 'auth', '4ab6d6bbd9fa745f76a56f895832b5a3375897f6dc4cc02a132be9a58ef5e7ac', '[\"*\"]', NULL, NULL, '2025-06-11 14:49:37', '2025-06-11 14:49:37'),
(119, 'App\\Models\\User', 18, 'auth', '49723802a62c54553310c6eca4b8a4bdc375b38bf5061ff8eb56e58f6b064c67', '[\"*\"]', '2025-06-11 15:14:10', NULL, '2025-06-11 14:50:51', '2025-06-11 15:14:10'),
(120, 'App\\Models\\User', 25, 'auth', 'f38d3e7209d30aec592b7647de551099a29d5a0f5af111932d0fe09ad07d4bd7', '[\"*\"]', '2025-06-12 18:13:19', NULL, '2025-06-11 15:13:35', '2025-06-12 18:13:19'),
(121, 'App\\Models\\User', 18, 'auth', '7635e1d5fe9657869c44517a2ab6e74eca749c244dd258023bd37c322e6949cf', '[\"*\"]', '2025-06-11 15:38:08', NULL, '2025-06-11 15:21:46', '2025-06-11 15:38:08'),
(122, 'App\\Models\\User', 27, 'auth', '7647a976389877b3699775a8dd8486073b752ec4e94e822405db35a129846608', '[\"*\"]', '2025-06-11 15:33:21', NULL, '2025-06-11 15:32:31', '2025-06-11 15:33:21'),
(123, 'App\\Models\\User', 2, 'auth', '54fe94aa8335fedae6ae477f885007c875968535f0bdc9c3bfa8b57688a6c599', '[\"*\"]', '2025-06-11 15:34:40', NULL, '2025-06-11 15:34:03', '2025-06-11 15:34:40'),
(124, 'App\\Models\\User', 27, 'auth', '8820ccc5a076907c312da5f6d76e3f4caee3a12fac9b970acca2e8da1722e773', '[\"*\"]', '2025-06-11 16:26:58', NULL, '2025-06-11 15:34:49', '2025-06-11 16:26:58'),
(125, 'App\\Models\\User', 25, 'auth', '13d0acb3b6e4c8ca9ae92370712d3b0b0296f55992963a268b405d3734c99ab5', '[\"*\"]', '2025-06-11 18:17:57', NULL, '2025-06-11 15:38:24', '2025-06-11 18:17:57'),
(126, 'App\\Models\\User', 2, 'auth', 'f8e362c8131e0f9e3867a858a699bd3fc51738482ef4cad3cfddb3bf92804e2d', '[\"*\"]', '2025-06-11 16:30:00', NULL, '2025-06-11 16:27:38', '2025-06-11 16:30:00'),
(127, 'App\\Models\\User', 27, 'auth', 'f39fe5fdb08b47fd139f76409ee0d76853c116562a79824a5d802bf01602d45c', '[\"*\"]', '2025-06-11 16:32:14', NULL, '2025-06-11 16:30:12', '2025-06-11 16:32:14'),
(128, 'App\\Models\\User', 25, 'auth', '880c4fb77bdc6756cbbd2dd078de05fd83647ba9be81646b6c1684a2a5a42b85', '[\"*\"]', '2025-06-11 16:52:01', NULL, '2025-06-11 16:51:58', '2025-06-11 16:52:01'),
(129, 'App\\Models\\User', 18, 'auth', 'ccd07b42d8da51f2ed6dea26748c1ef7da6ac2361ca287e5164dddd91d8feab2', '[\"*\"]', '2025-06-11 17:06:49', NULL, '2025-06-11 16:52:14', '2025-06-11 17:06:49'),
(130, 'App\\Models\\User', 18, 'auth', 'c432cdfd8bb8b6fcb3a45b4dd3d47e8cf2cd234600b5ed6f07bbec5e7d486d5a', '[\"*\"]', '2025-06-11 17:07:43', NULL, '2025-06-11 17:07:22', '2025-06-11 17:07:43'),
(131, 'App\\Models\\User', 25, 'auth', 'b0b0a8fbf66ff583169a06778de3d227ec47bdd4cc38d5ed382442c729e9a12a', '[\"*\"]', '2025-06-11 18:31:54', NULL, '2025-06-11 17:08:07', '2025-06-11 18:31:54'),
(132, 'App\\Models\\User', 10, 'auth', '26464abe2114973c47751c29f08c461d4ec9a53242b2c6d0b8ea043d629733af', '[\"*\"]', '2025-06-11 19:24:59', NULL, '2025-06-11 18:34:38', '2025-06-11 19:24:59'),
(133, 'App\\Models\\User', 18, 'auth', '7064b59417ac3a12386839629a223f734bf948d39725c4bfb2978a79fdac55ed', '[\"*\"]', '2025-06-12 17:03:14', NULL, '2025-06-11 18:35:28', '2025-06-12 17:03:14'),
(134, 'App\\Models\\User', 25, 'auth', '2fc54051e43c2cca7ef64efc8dc8e45b6242046d03055f737b498317e90c7f00', '[\"*\"]', '2025-06-12 16:08:28', NULL, '2025-06-11 19:25:40', '2025-06-12 16:08:28'),
(135, 'App\\Models\\User', 25, 'auth', 'dd39d49b0c266e5f52c0cf16142260a185f1dd2a1747edd699ca6858e36c35e6', '[\"*\"]', '2025-06-11 19:37:25', NULL, '2025-06-11 19:32:10', '2025-06-11 19:37:25'),
(136, 'App\\Models\\User', 25, 'auth', 'e7b9812d46c80487af8a9f74da515d0597b475c9d9d3c23e01f73670a9585868', '[\"*\"]', '2025-06-12 10:58:51', NULL, '2025-06-12 10:58:26', '2025-06-12 10:58:51'),
(137, 'App\\Models\\User', 18, 'auth', 'b8e10c1add4c1d7608b4c35555b7222fd5143679d2025fdbc78e132d71c137aa', '[\"*\"]', '2025-06-12 11:25:25', NULL, '2025-06-12 11:24:53', '2025-06-12 11:25:25'),
(138, 'App\\Models\\User', 25, 'auth', '681ce7c2c4170578ada9fc1193c276c3e34edbe557842ad0fdc5d65fc9e9515a', '[\"*\"]', '2025-06-12 11:27:25', NULL, '2025-06-12 11:26:00', '2025-06-12 11:27:25'),
(139, 'App\\Models\\User', 25, 'auth', 'b0e170a35eb47aa0c2ffefd7eb806826aaafbf8a15aa9ef4c5dc8e0788910615', '[\"*\"]', '2025-06-12 11:28:00', NULL, '2025-06-12 11:27:45', '2025-06-12 11:28:00'),
(140, 'App\\Models\\User', 18, 'auth', '2d7f223f4bbd3ea51ecc21ec0fe120dc5e622e0c259f6d4b60598b22aa5e63c1', '[\"*\"]', '2025-06-12 11:29:04', NULL, '2025-06-12 11:28:27', '2025-06-12 11:29:04'),
(141, 'App\\Models\\User', 18, 'auth', 'abc2fbba337605a17c2117e2493b3c35122bf9202a487fe2cbb53f11e683e6d6', '[\"*\"]', '2025-06-12 11:31:41', NULL, '2025-06-12 11:31:37', '2025-06-12 11:31:41'),
(142, 'App\\Models\\User', 25, 'auth', 'ef8023e2c3921cb21ad3564867b5cc24022942d2063071be42a0050c880faceb', '[\"*\"]', '2025-06-12 11:32:24', NULL, '2025-06-12 11:32:07', '2025-06-12 11:32:24'),
(143, 'App\\Models\\User', 18, 'auth', '7c73d74ddf9062553c0606a3ad9c7c6e5b8ae3a434f1133dfda6a9574857cb00', '[\"*\"]', '2025-06-12 11:40:14', NULL, '2025-06-12 11:32:39', '2025-06-12 11:40:14'),
(144, 'App\\Models\\User', 25, 'auth', '765a2f4931e8abd003375164a78cf37d6def493775dfa55edbc5bf87a98ce619', '[\"*\"]', '2025-06-12 12:09:29', NULL, '2025-06-12 11:40:40', '2025-06-12 12:09:29'),
(145, 'App\\Models\\User', 25, 'auth', '50ddc75e00ffb6b34278c6e8f75ebfc6ea88b0398e4a345efb3db78e264271ef', '[\"*\"]', '2025-06-12 12:24:33', NULL, '2025-06-12 12:23:01', '2025-06-12 12:24:33'),
(146, 'App\\Models\\User', 2, 'auth', '99bea4df6ed4697de48c13054a3c50893ed5c97bd63337f230008f2f2fe6e079', '[\"*\"]', '2025-06-12 14:14:18', NULL, '2025-06-12 14:08:41', '2025-06-12 14:14:18'),
(147, 'App\\Models\\User', 27, 'auth', 'e315827a7175b6512c42e0880d5bc74f88c24e9dcd6fa6cd5c8c4c6cf42132ea', '[\"*\"]', '2025-06-12 14:19:29', NULL, '2025-06-12 14:15:05', '2025-06-12 14:19:29'),
(148, 'App\\Models\\User', 2, 'auth', '738f039a92fd4ac415341979a137563b29e496a4bf385fdb45bd04a58511406e', '[\"*\"]', '2025-06-12 14:38:52', NULL, '2025-06-12 14:20:34', '2025-06-12 14:38:52'),
(149, 'App\\Models\\User', 25, 'auth', 'cf3274bae7aa5689882fc529faee3e906715c5db9a9dc8dddad683df4a5b3d5a', '[\"*\"]', '2025-06-12 14:54:04', NULL, '2025-06-12 14:53:43', '2025-06-12 14:54:04'),
(150, 'App\\Models\\User', 10, 'auth', '8b23f1ef149b7be74aaecf1e2a19cca059a9d4d45ae5213e5a7871e1db79e540', '[\"*\"]', '2025-06-12 18:50:57', NULL, '2025-06-12 14:56:35', '2025-06-12 18:50:57'),
(151, 'App\\Models\\User', 18, 'auth', 'ac46bb3354a295be44bc38638fbcae4b764209654bb0d97df7c66b966ffb2c7b', '[\"*\"]', '2025-06-12 16:11:47', NULL, '2025-06-12 16:08:22', '2025-06-12 16:11:47'),
(152, 'App\\Models\\User', 25, 'auth', 'cca3ecb1c4d70ca43732e0adeebeb0d6b61bd34828d98ac417347c94983b7c8c', '[\"*\"]', '2025-06-12 16:12:52', NULL, '2025-06-12 16:12:36', '2025-06-12 16:12:52'),
(153, 'App\\Models\\User', 18, 'auth', '41a271122bd7da4fdd14142fdc71b3e9c4f991e975d5651657cd821c8cf7e79f', '[\"*\"]', '2025-06-12 16:13:35', NULL, '2025-06-12 16:13:29', '2025-06-12 16:13:35'),
(154, 'App\\Models\\User', 10, 'auth', 'f2a0ff7b915037e13ca966187048ccd6cd4f2a2b988ee20f1e14dbfa14f3332f', '[\"*\"]', '2025-06-12 17:39:33', NULL, '2025-06-12 16:17:06', '2025-06-12 17:39:33'),
(155, 'App\\Models\\User', 18, 'auth', '5f00a6d36f9f4b8fe6188583d69bd984f8b7bc813640b6cc1092a5ee332aee24', '[\"*\"]', '2025-06-12 19:07:37', NULL, '2025-06-12 16:18:31', '2025-06-12 19:07:37'),
(156, 'App\\Models\\User', 2, 'auth', '9b5fc5769b9f5483e584733ebf8b8ab40f8007021f0df346a3304f70eb99309f', '[\"*\"]', '2025-06-12 18:06:28', NULL, '2025-06-12 18:05:53', '2025-06-12 18:06:28'),
(157, 'App\\Models\\User', 27, 'auth', '044362663a6318d86ff2d81082d3ffcfccde221fb433c045cea5d599499d398c', '[\"*\"]', '2025-06-12 18:09:45', NULL, '2025-06-12 18:06:42', '2025-06-12 18:09:45'),
(158, 'App\\Models\\User', 2, 'auth', 'c78f7c6fb2d3fe1b5f36dd4dcbc205b28013118012fb59b21bcd1dfaa53946af', '[\"*\"]', '2025-06-12 18:13:00', NULL, '2025-06-12 18:09:57', '2025-06-12 18:13:00'),
(159, 'App\\Models\\User', 27, 'auth', '161b7d495d4ecd3fd19a98f58a51c8e3d0a309bcb1faa92ade50e452023f9b88', '[\"*\"]', '2025-06-12 18:13:40', NULL, '2025-06-12 18:13:09', '2025-06-12 18:13:40'),
(160, 'App\\Models\\User', 2, 'auth', '5dac888feb35e3bac02832faa7daf0f14e2140ea49f2d9fea7891dfedfbfd1e9', '[\"*\"]', '2025-06-12 18:14:10', NULL, '2025-06-12 18:13:51', '2025-06-12 18:14:10'),
(161, 'App\\Models\\User', 27, 'auth', '952d6da7ac0de957084ba990f37274aeb4eb9c74452e0e8e3ac396dc7cb14f19', '[\"*\"]', '2025-06-12 18:14:55', NULL, '2025-06-12 18:14:20', '2025-06-12 18:14:55'),
(162, 'App\\Models\\User', 2, 'auth', '7b304958075a5af5d15ec6fb266cef82d1126c020236d207b39fddf10fb91d64', '[\"*\"]', '2025-06-12 18:15:17', NULL, '2025-06-12 18:15:04', '2025-06-12 18:15:17'),
(163, 'App\\Models\\User', 27, 'auth', '2b571359e3de432ced8eaf4603b6ecf921df26b2c53dc2d1ddbcb4727a0297a0', '[\"*\"]', '2025-06-12 18:15:44', NULL, '2025-06-12 18:15:27', '2025-06-12 18:15:44'),
(164, 'App\\Models\\User', 2, 'auth', '996d2732557aa8c12fba6a45a8585d73e54724de3d1d498dfd51e4bf83ff1f3f', '[\"*\"]', '2025-06-12 18:16:16', NULL, '2025-06-12 18:15:53', '2025-06-12 18:16:16'),
(165, 'App\\Models\\User', 27, 'auth', '273064c6bf22c90007c390880212f74f65d791fdd5873884a9e5ef55e8153e5d', '[\"*\"]', '2025-06-12 18:28:25', NULL, '2025-06-12 18:16:26', '2025-06-12 18:28:25'),
(166, 'App\\Models\\User', 25, 'auth', 'a7763b68474ab811ecbab411d173e128098b38ea284836d40f0872df4336b9c3', '[\"*\"]', '2025-06-12 18:28:25', NULL, '2025-06-12 18:26:49', '2025-06-12 18:28:25'),
(167, 'App\\Models\\User', 2, 'auth', '972b720406675493b49659257f2c122df5d963585f7dc1139d3b7af093d227e0', '[\"*\"]', '2025-06-12 19:05:20', NULL, '2025-06-12 18:28:39', '2025-06-12 19:05:20'),
(168, 'App\\Models\\User', 18, 'auth', 'f78e30f585643371b78629357b823e16179c39016b166a82e8eb9fc7e13eac9e', '[\"*\"]', '2025-06-12 18:50:48', NULL, '2025-06-12 18:28:45', '2025-06-12 18:50:48'),
(169, 'App\\Models\\User', 25, 'auth', 'd0bc8724642aa1f3cbd87e613d3f415f0997dd86ca5ae21143e2408e67d9be2f', '[\"*\"]', '2025-06-13 11:09:13', NULL, '2025-06-12 18:51:02', '2025-06-13 11:09:13'),
(170, 'App\\Models\\User', 2, 'auth', '9866c524dfed94eb846e3393814d7e9b3d4c9db0aa34d30e087e0a90b6582f24', '[\"*\"]', '2025-06-12 19:41:44', NULL, '2025-06-12 19:40:40', '2025-06-12 19:41:44'),
(171, 'App\\Models\\User', 27, 'auth', '34497612f18d1ba516c8c5fc56245101919dfe05d09d08b61812bf045912625f', '[\"*\"]', '2025-06-12 19:42:16', NULL, '2025-06-12 19:41:58', '2025-06-12 19:42:16'),
(172, 'App\\Models\\User', 2, 'auth', 'e930d6f5f65077f6174947e9941b25c28f4da2ee0f42360a28fd99b23149e8d3', '[\"*\"]', '2025-06-12 19:43:31', NULL, '2025-06-12 19:42:31', '2025-06-12 19:43:31'),
(173, 'App\\Models\\User', 27, 'auth', 'ad5f53e15a0ebcccdacb421b603ed0fcf30cf658ccf70033f015732bdfd3c8ab', '[\"*\"]', '2025-06-12 19:44:00', NULL, '2025-06-12 19:43:39', '2025-06-12 19:44:00'),
(174, 'App\\Models\\User', 2, 'auth', '4f54d633b3a7ae5c19bf180489d9506170ec8187edbc40f0dbb818d70820fccf', '[\"*\"]', '2025-06-12 19:45:33', NULL, '2025-06-12 19:44:10', '2025-06-12 19:45:33'),
(175, 'App\\Models\\User', 27, 'auth', 'ab03df4e2bde1fd6eb977f4f90788ab04f3755759163c027c81ab56a89fdc97a', '[\"*\"]', '2025-06-12 21:00:21', NULL, '2025-06-12 19:45:51', '2025-06-12 21:00:21'),
(176, 'App\\Models\\User', 2, 'auth', '630859e5293459b31246983af5339eb732eb1afc8aed7c04b14fa1fc3f69a5db', '[\"*\"]', '2025-06-12 21:01:51', NULL, '2025-06-12 21:00:36', '2025-06-12 21:01:51'),
(177, 'App\\Models\\User', 26, 'auth', '502e97e076c243bdda60bc056926677f0e4871109def788cb3f9b7845f84010c', '[\"*\"]', '2025-06-12 21:02:48', NULL, '2025-06-12 21:02:01', '2025-06-12 21:02:48'),
(178, 'App\\Models\\User', 2, 'auth', 'c0b615772397a68aaa3dc731184990817cb3afdc7dd13b376cee3e3e8aca8932', '[\"*\"]', '2025-06-12 21:03:27', NULL, '2025-06-12 21:03:05', '2025-06-12 21:03:27'),
(179, 'App\\Models\\User', 26, 'auth', '70d3d7334ef27e6dfea25a44b9d4a2a79c1f13c4d08a2bcf4b5fa56eae874c42', '[\"*\"]', '2025-06-12 21:03:53', NULL, '2025-06-12 21:03:34', '2025-06-12 21:03:53'),
(180, 'App\\Models\\User', 2, 'auth', 'b7181d38948895506b1b758b35f0591605cb29a5cfed2acc1e3a424cf6267809', '[\"*\"]', '2025-06-12 21:13:36', NULL, '2025-06-12 21:04:03', '2025-06-12 21:13:36'),
(181, 'App\\Models\\User', 26, 'auth', 'ea4f20304998c6c0b643f22ba2c0293013e2c878948e0d0ab9696066d6b23168', '[\"*\"]', '2025-06-12 21:13:57', NULL, '2025-06-12 21:13:45', '2025-06-12 21:13:57'),
(182, 'App\\Models\\User', 27, 'auth', '5f6d942e8c8d41787a60e858cd73dc396677b71e9069ca4fb25fa32a7dd69906', '[\"*\"]', '2025-06-13 12:37:09', NULL, '2025-06-12 21:14:11', '2025-06-13 12:37:09'),
(183, 'App\\Models\\User', 25, 'auth', '89d6538cac6a649989e7d5ec45a6cb4e1dc5f9ae23b5a9eb1b483268de65086a', '[\"*\"]', '2025-06-13 11:11:54', NULL, '2025-06-13 11:09:31', '2025-06-13 11:11:54'),
(184, 'App\\Models\\User', 2, 'auth', 'ae00d4dfe98993b53e7847be3366fd38d08b4e50ea0cd0876aff01dd197764ff', '[\"*\"]', '2025-06-13 21:28:29', NULL, '2025-06-13 12:38:11', '2025-06-13 21:28:29'),
(185, 'App\\Models\\User', 18, 'auth', '4a609d239cfacd038cef0ed1ced21a7109d0af88e44361d39efe9d0ffacb0a7a', '[\"*\"]', '2025-06-13 19:22:27', NULL, '2025-06-13 13:16:13', '2025-06-13 19:22:27'),
(186, 'App\\Models\\User', 2, 'auth', '99427bb7280ced63df9d8b353bb5dd1048070bb1d970b018a831a864129e961c', '[\"*\"]', '2025-06-13 19:17:13', NULL, '2025-06-13 19:13:41', '2025-06-13 19:17:13'),
(187, 'App\\Models\\User', 2, 'auth', '93acbd366f3846b2dc3295dd8dcc70267c3c2fa0b1657a12f6c67dffe76b519e', '[\"*\"]', '2025-06-14 12:28:38', NULL, '2025-06-13 19:26:51', '2025-06-14 12:28:38'),
(188, 'App\\Models\\User', 2, 'auth', '4a6feb7f9da1b4f4ed048bf108d4c965d3555ee7f2ae5f55828bde9422a43221', '[\"*\"]', '2025-06-13 21:29:01', NULL, '2025-06-13 21:28:42', '2025-06-13 21:29:01'),
(189, 'App\\Models\\User', 26, 'auth', 'ef13958cf6ffb3ec46fc96bcc11c4663849a28621b33eca46c445b76f747b97d', '[\"*\"]', '2025-06-13 21:29:58', NULL, '2025-06-13 21:29:24', '2025-06-13 21:29:58'),
(190, 'App\\Models\\User', 27, 'auth', '6a24acc01c6b2b3f60723975cbd8b42d123c3e56cae3bdfe6f71e2d1f78ae76d', '[\"*\"]', '2025-06-13 21:31:47', NULL, '2025-06-13 21:30:16', '2025-06-13 21:31:47'),
(191, 'App\\Models\\User', 2, 'auth', 'd1d403fed5ea3cad27ce6ebffda43f1124b1f9bc53460f68b260459027233e1a', '[\"*\"]', '2025-06-14 11:17:51', NULL, '2025-06-13 21:32:01', '2025-06-14 11:17:51'),
(192, 'App\\Models\\User', 27, 'auth', '3d0b6628c80b1c569064b2015b9b10c44d6fc923980f8e76baf03f2988965077', '[\"*\"]', '2025-06-14 11:18:13', NULL, '2025-06-14 11:18:09', '2025-06-14 11:18:13'),
(193, 'App\\Models\\User', 27, 'auth', 'bcc55ac89e951597400d50bbbe8db61a26994a522dd26e444f6b1086ac9f722f', '[\"*\"]', '2025-06-14 12:17:18', NULL, '2025-06-14 12:15:32', '2025-06-14 12:17:18'),
(194, 'App\\Models\\User', 2, 'auth', 'b02a1b6fa2cdfb527a136c4919cb5786fe155b3c80e9e01d7baab5541cae543d', '[\"*\"]', '2025-06-14 12:19:20', NULL, '2025-06-14 12:17:28', '2025-06-14 12:19:20'),
(195, 'App\\Models\\User', 26, 'auth', '9b7c27f9f9d094910a3967e535e91802e867f59022573e88e1d78ec69a498b57', '[\"*\"]', '2025-06-14 14:00:46', NULL, '2025-06-14 12:19:27', '2025-06-14 14:00:46'),
(196, 'App\\Models\\User', 27, 'auth', 'fb9baa74ebb1ffa120935df99bb6b30acb5cd3b2538b78be44234285de0b36c7', '[\"*\"]', '2025-06-14 12:33:33', NULL, '2025-06-14 12:30:12', '2025-06-14 12:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `queues`
--

CREATE TABLE `queues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `queues`
--

INSERT INTO `queues` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"8c114329-584e-4ce9-bc56-18374bf942fd\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"0908nisham@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1747631639, 1747631639),
(2, 'default', '{\"uuid\":\"d10c6c93-1f16-4e24-b33d-b6cf927d9449\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"0908nisham@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1747665865, 1747665865),
(3, 'default', '{\"uuid\":\"5c3f138a-cde7-444d-8c60-a5532e77a2eb\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:13:\\\"sim@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748863325, 1748863325),
(4, 'default', '{\"uuid\":\"f1ed8143-adb4-4a07-a8ea-8c41e94cf5b3\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:13:\\\"sim@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748863722, 1748863722),
(5, 'default', '{\"uuid\":\"69c384ef-82c6-49a6-845c-add77529c407\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:13:\\\"sim@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748864245, 1748864245),
(6, 'default', '{\"uuid\":\"e001e456-5d77-49ff-9686-654d42df41b6\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1748865095, 1748865095),
(7, 'default', '{\"uuid\":\"633d86c4-167f-4821-b5d1-3827294adb98\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1748865095, 1748865095),
(8, 'default', '{\"uuid\":\"6ca9ceaf-0f5d-463a-8311-4d918fac2060\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"roshanbust@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748869266, 1748869266),
(9, 'default', '{\"uuid\":\"b86564fc-d722-468e-8ad1-af47ee5869e6\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"roshanbust@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748869755, 1748869755),
(10, 'default', '{\"uuid\":\"8aafd587-fb08-4bfa-b5de-1a38762e4e5e\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:13:\\\"sim@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748869773, 1748869773),
(11, 'default', '{\"uuid\":\"59cfa956-5e22-467d-b8d9-30cc7163f685\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748869951, 1748869951),
(12, 'default', '{\"uuid\":\"b82b2294-f10c-464e-87da-048543a848b0\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1748870363, 1748870363),
(13, 'default', '{\"uuid\":\"01d9d876-00e3-4eef-977a-5e251874732c\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1748870363, 1748870363),
(14, 'default', '{\"uuid\":\"06109830-7909-4b61-b50e-f2b55aef239b\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1748870363, 1748870363),
(15, 'default', '{\"uuid\":\"3603a54a-9008-4bfa-9226-dc9d0b945b7c\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:13:\\\"sim@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748871002, 1748871002),
(16, 'default', '{\"uuid\":\"affcdb97-09b5-4957-8959-55a0846b09e9\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:13:\\\"sim@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748871211, 1748871211),
(17, 'default', '{\"uuid\":\"a64c3730-5a1f-4d24-98c2-12f7b0f73687\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748871222, 1748871222),
(18, 'default', '{\"uuid\":\"8091881c-0acd-423a-9be3-08dc7d6bfc69\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:3;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748871262, 1748871262),
(19, 'default', '{\"uuid\":\"e91143be-8e65-4f67-8a68-9d16d15c5b9c\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"vijay@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748871294, 1748871294),
(20, 'default', '{\"uuid\":\"db2d0109-2306-441d-a6d6-f054f07e3734\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:13:\\\"sim@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748871308, 1748871308),
(21, 'default', '{\"uuid\":\"f9bb355f-54ed-40f1-bae3-bcb212fac896\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"vijay@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748871315, 1748871315),
(22, 'default', '{\"uuid\":\"e877bae1-1f08-49a1-b589-311277a3434c\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1748871331, 1748871331),
(23, 'default', '{\"uuid\":\"6b840f91-d8b2-4e5c-ad8a-60c05ef3902d\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1748871331, 1748871331),
(24, 'default', '{\"uuid\":\"6bda4eb0-7fe5-4516-859d-b0b46158d18b\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:18:\\\"ramesh@yopmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1748871488, 1748871488),
(25, 'default', '{\"uuid\":\"b8e24458-4c54-4013-b70e-6d6cf7ee5e56\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:185712;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"nishammpm@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749132339, 1749132339),
(26, 'default', '{\"uuid\":\"ea32ca7b-0cee-435a-82e9-15d4caf17e7f\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:527921;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"nishammpm@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749132505, 1749132505),
(27, 'default', '{\"uuid\":\"0c5433fc-f6d3-41c3-85da-d552332062bc\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:400846;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"nishammpm@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749132505, 1749132505),
(28, 'default', '{\"uuid\":\"9fd0dab7-f96a-4a27-800e-7e10d5a4e435\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:282730;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:18:\\\"youngtet@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749139933, 1749139933),
(29, 'default', '{\"uuid\":\"ed351796-02bb-4697-87c7-4f99f6811967\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:174679;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"nishammpm@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749233687, 1749233687),
(30, 'default', '{\"uuid\":\"a0295e3d-9f16-4853-b4be-6be16a68e9fb\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:116403;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749458261, 1749458261),
(31, 'default', '{\"uuid\":\"e6908633-e15c-4ee6-871f-4fbd24875d85\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:377743;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749460064, 1749460064),
(32, 'default', '{\"uuid\":\"8825df56-6b56-4f85-9ef9-11c8df4a3dc8\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:715918;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749460252, 1749460252),
(33, 'default', '{\"uuid\":\"fe98261e-4b7e-4da3-89eb-c49fb00d84be\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:969975;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749460357, 1749460357),
(34, 'default', '{\"uuid\":\"574e56be-7b4d-4c17-b08c-6b467181d3ea\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:720969;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749460572, 1749460572),
(35, 'default', '{\"uuid\":\"e4296484-f13a-49d3-b98c-a38ad402fe58\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";s:6:\\\"123456\\\";s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749460656, 1749460656);
INSERT INTO `queues` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(36, 'default', '{\"uuid\":\"6db1f9ab-f62b-4f71-b372-6942f7c6129b\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:598251;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749460731, 1749460731),
(37, 'default', '{\"uuid\":\"c48eebd6-2b01-4114-8e2a-f1527a8ce704\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";s:6:\\\"123456\\\";s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:24:\\\"rakeshkaithvas@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749460738, 1749460738),
(38, 'default', '{\"uuid\":\"29e072cd-6281-4702-89a2-37ef974d8aaa\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";s:6:\\\"123456\\\";s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:24:\\\"rakeshkaithvas@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749461101, 1749461101),
(39, 'default', '{\"uuid\":\"d45430f9-4de8-4af1-84bf-0a7af81be8bf\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:223886;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749461198, 1749461198),
(40, 'default', '{\"uuid\":\"dfd490b1-56f5-4e7c-8c4a-7a650a7fdfae\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:712022;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749461301, 1749461301),
(41, 'default', '{\"uuid\":\"b1d6b1f2-14db-44ac-b1da-90f1373dbd5b\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:255705;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749461625, 1749461625),
(42, 'default', '{\"uuid\":\"ea893fef-aa80-4f2a-a49b-60902d9c5bd1\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:527350;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749461804, 1749461804),
(43, 'default', '{\"uuid\":\"48be190b-5cdf-4fb8-a7a0-d7012bc08ece\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:317456;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749462270, 1749462270),
(44, 'default', '{\"uuid\":\"06f41346-c5f9-4f3d-871c-37f09eb509f8\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:856633;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749462369, 1749462369),
(45, 'default', '{\"uuid\":\"418fc177-aff3-40ed-a7f0-576dfdbaec34\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:784555;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749462633, 1749462633),
(46, 'default', '{\"uuid\":\"6690f1a9-b907-48d1-8b41-ea92c1258b30\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:742336;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:24:\\\"rakeshkaithvas@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749462942, 1749462942),
(47, 'default', '{\"uuid\":\"843cb613-6408-4c40-a55b-713c5b18dc42\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:360362;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:24:\\\"rakeshkaithvas@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749463257, 1749463257),
(48, 'default', '{\"uuid\":\"7e319f19-a831-4305-a281-41add7fbb5c5\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:133863;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749463337, 1749463337),
(49, 'default', '{\"uuid\":\"246ffcfb-3a4f-47b2-8729-0e5a27ff5dff\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:232518;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749463713, 1749463713),
(50, 'default', '{\"uuid\":\"6a68f4c7-fec2-43e2-a608-e5c6590f9c35\",\"displayName\":\"App\\\\Mail\\\\EmailVerificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\EmailVerificationMail\\\":4:{s:3:\\\"otp\\\";i:731962;s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749464710, 1749464710),
(51, 'default', '{\"uuid\":\"8e2c6a46-2877-4831-a623-4e17aaedade7\",\"displayName\":\"App\\\\Mail\\\\PasswordChangedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:28:\\\"App\\\\Mail\\\\PasswordChangedMail\\\":3:{s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749466280, 1749466280),
(52, 'default', '{\"uuid\":\"9209dd3f-19fd-4b1d-acb0-599e2e0de755\",\"displayName\":\"App\\\\Mail\\\\PasswordChangedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:28:\\\"App\\\\Mail\\\\PasswordChangedMail\\\":3:{s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"sureshvermaaa@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749467253, 1749467253),
(53, 'default', '{\"uuid\":\"3ff08406-a410-4cfd-8c8a-fd8d2988715b\",\"displayName\":\"App\\\\Mail\\\\PasswordChangedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:28:\\\"App\\\\Mail\\\\PasswordChangedMail\\\":3:{s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:30:\\\"rohit.natrajinfotech@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749467909, 1749467909),
(54, 'default', '{\"uuid\":\"ea5e488c-9e5d-4f9a-b971-d2d45bc936a8\",\"displayName\":\"App\\\\Mail\\\\PasswordChangedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:28:\\\"App\\\\Mail\\\\PasswordChangedMail\\\":3:{s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"nishammpm@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749567998, 1749567998),
(55, 'default', '{\"uuid\":\"b76bb3c2-c86e-4b9b-a829-268c3eb99010\",\"displayName\":\"App\\\\Mail\\\\PasswordChangedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:28:\\\"App\\\\Mail\\\\PasswordChangedMail\\\":3:{s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"nishammpm@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749567999, 1749567999),
(56, 'default', '{\"uuid\":\"51e747dd-bdbd-481c-9b26-a91bed46b435\",\"displayName\":\"App\\\\Mail\\\\PasswordChangedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:28:\\\"App\\\\Mail\\\\PasswordChangedMail\\\":3:{s:7:\\\"appName\\\";s:8:\\\"Luckybox\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:30:\\\"rohit.natrajinfotech@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749620757, 1749620757),
(57, 'default', '{\"uuid\":\"d21cc5ba-6ff4-448d-855c-fdb065572a2b\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:2;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"nishammpm@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749742982, 1749742982),
(58, 'default', '{\"uuid\":\"a09e6a3d-debe-40ae-ad16-8e3f13180de3\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"nisha@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749743033, 1749743033),
(59, 'default', '{\"uuid\":\"2fa79ca7-b26a-48f0-95bf-b92196d09c56\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:2;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:12:\\\"nn@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749743069, 1749743069),
(60, 'default', '{\"uuid\":\"fb9efca9-4de3-4f16-9155-558ff34f1108\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809216, 1749809216),
(61, 'default', '{\"uuid\":\"eded04ef-c337-4523-b8f5-74846e37a18a\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809216, 1749809216),
(62, 'default', '{\"uuid\":\"ca64c453-e342-48d5-b07a-dd9d3505a8fb\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809216, 1749809216),
(63, 'default', '{\"uuid\":\"974acf5e-e43e-4dcf-b7e1-d53fabfe96ae\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809554, 1749809554),
(64, 'default', '{\"uuid\":\"5d8abf9c-1388-4403-a306-632cdf1f6c94\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809554, 1749809554),
(65, 'default', '{\"uuid\":\"5a99ed0f-5abd-428f-b501-6b12ee029c6f\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809554, 1749809554),
(66, 'default', '{\"uuid\":\"91bbed63-932c-4dc2-988a-8c88e056db5d\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809557, 1749809557),
(67, 'default', '{\"uuid\":\"26a328bf-0631-4564-8d0b-859655b021bc\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809557, 1749809557),
(68, 'default', '{\"uuid\":\"f999ff63-f1a0-44e9-b689-675495d162b7\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809557, 1749809557),
(69, 'default', '{\"uuid\":\"7fb807ed-4470-43c4-b715-90f4a8a84d42\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809622, 1749809622),
(70, 'default', '{\"uuid\":\"e5ad7226-7306-4d99-84e9-38678192cfaf\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809622, 1749809622),
(71, 'default', '{\"uuid\":\"dd1cb90f-7475-4c8b-8211-4e4580b39e81\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809622, 1749809622),
(72, 'default', '{\"uuid\":\"1a186f3b-d720-4017-9f17-63fc8532392d\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809625, 1749809625),
(73, 'default', '{\"uuid\":\"3e69f76d-3414-46ee-93d5-0485200e2990\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809625, 1749809625),
(74, 'default', '{\"uuid\":\"ee4e37c3-4af8-4078-83ae-c4599b6e090f\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809625, 1749809625);
INSERT INTO `queues` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(75, 'default', '{\"uuid\":\"e2de379d-99e2-43c9-9a5a-5afd661b7383\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809820, 1749809820),
(76, 'default', '{\"uuid\":\"e548a11a-8ee4-4314-9573-54e5ebd2587e\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809820, 1749809820),
(77, 'default', '{\"uuid\":\"0ea1bdfc-1ac4-4aca-9fb6-723b79be5d49\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809820, 1749809820),
(78, 'default', '{\"uuid\":\"39f7b67d-5dec-410f-838e-4ce7283532d4\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809955, 1749809955),
(79, 'default', '{\"uuid\":\"a95e6c23-7c2a-430f-b30a-7b1d5d2752d3\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809955, 1749809955),
(80, 'default', '{\"uuid\":\"52959a49-e0c4-4046-9985-1a17183c0414\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749809955, 1749809955),
(81, 'default', '{\"uuid\":\"281085d4-fbc1-4e81-8790-27a6a1d36489\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749811021, 1749811021),
(82, 'default', '{\"uuid\":\"b72ace93-5a43-4563-8b30-76f52d218075\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749811021, 1749811021),
(83, 'default', '{\"uuid\":\"64984458-e740-4b20-9e8d-7f844a417be2\",\"displayName\":\"App\\\\Listeners\\\\LotteryWinnerListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:35:\\\"App\\\\Listeners\\\\LotteryWinnerListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:29:\\\"App\\\\Events\\\\LotteryWinnerEvent\\\":1:{s:11:\\\"lotteryData\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\LotteryTicket\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1749811021, 1749811021),
(84, 'default', '{\"uuid\":\"ef1d6649-51d4-448d-8598-37598a207a53\",\"displayName\":\"App\\\\Mail\\\\LotteryBuyMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\LotteryBuyMail\\\":5:{s:7:\\\"lottery\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Lottery\\\";s:2:\\\"id\\\";i:15;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"quantity\\\";i:1;s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"nishammpm@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1749830863, 1749830863);

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referrer_id` bigint(20) UNSIGNED NOT NULL,
  `referred_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `referrer_id`, `referred_id`, `created_at`, `updated_at`) VALUES
(4, 2, 27, '2025-06-11 14:27:04', '2025-06-11 14:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `refer_settings`
--

CREATE TABLE `refer_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `joining_bonus` tinyint(1) NOT NULL DEFAULT 0,
  `joining_bonus_amount` varchar(255) NOT NULL DEFAULT '10',
  `deposit_bonus` tinyint(1) NOT NULL DEFAULT 1,
  `deposit_percentage` varchar(255) NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refer_settings`
--

INSERT INTO `refer_settings` (`id`, `joining_bonus`, `joining_bonus_amount`, `deposit_bonus`, `deposit_percentage`, `created_at`, `updated_at`) VALUES
(1, 1, '10', 1, '1', '2024-06-13 16:09:59', '2025-05-15 09:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `scratches`
--

CREATE TABLE `scratches` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `no_cards` int(10) NOT NULL,
  `gift` varchar(500) NOT NULL,
  `status` enum('active','finished','inactive') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scratches`
--

INSERT INTO `scratches` (`id`, `created_by`, `no_cards`, `gift`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 'bike', 'active', '2025-06-12 19:41:09', '2025-06-12 19:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `scratch_card_assigns`
--

CREATE TABLE `scratch_card_assigns` (
  `id` int(11) NOT NULL,
  `normal_user_scan_qr_id` int(11) NOT NULL,
  `verified_user_id` int(11) NOT NULL,
  `scratch_id` int(11) NOT NULL,
  `status` enum('finished','running','pending') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scratch_card_assigns`
--

INSERT INTO `scratch_card_assigns` (`id`, `normal_user_scan_qr_id`, `verified_user_id`, `scratch_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 27, 2, 2, 'finished', '2025-06-12 19:43:20', '2025-06-12 19:43:51'),
(2, 27, 2, 2, 'finished', '2025-06-12 19:43:20', '2025-06-12 19:46:19'),
(3, 26, 2, 2, 'finished', '2025-06-12 21:01:42', '2025-06-12 21:02:23'),
(4, 26, 2, 2, 'finished', '2025-06-12 21:01:42', '2025-06-12 21:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `scratch_card_user_progress`
--

CREATE TABLE `scratch_card_user_progress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `scratch_id` bigint(20) UNSIGNED NOT NULL,
  `scratch_date` date NOT NULL,
  `scratched_today` int(11) DEFAULT 0,
  `total_scratched` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scratch_card_user_progress`
--

INSERT INTO `scratch_card_user_progress` (`id`, `user_id`, `scratch_id`, `scratch_date`, `scratched_today`, `total_scratched`, `created_at`, `updated_at`) VALUES
(1, 27, 2, '2025-06-12', 2, 2, '2025-06-12 19:43:51', '2025-06-12 19:46:19'),
(2, 26, 2, '2025-06-12', 2, 2, '2025-06-12 21:02:23', '2025-06-12 21:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `created_at`, `updated_at`) VALUES
(5, 'uploads/sliders/1747413068.png', '2025-05-16 16:31:08', '2025-05-16 16:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(155) NOT NULL,
  `phone` varchar(155) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `user_image` text DEFAULT NULL,
  `user_document` text DEFAULT NULL,
  `user_qr` text DEFAULT NULL,
  `fcm_token` text DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','blocked') NOT NULL COMMENT 'pending',
  `user_status` enum('normal','wait_for_verification','verified','rejected') NOT NULL,
  `block_reason` varchar(255) DEFAULT NULL,
  `refer_code` varchar(255) DEFAULT NULL,
  `otp_verified` tinyint(1) NOT NULL DEFAULT 0,
  `otp_expiry` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `shop_name` varchar(500) DEFAULT NULL,
  `shop_image` text DEFAULT NULL,
  `shop_category` varchar(500) DEFAULT NULL,
  `shop_address` text DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `balance`, `user_image`, `user_document`, `user_qr`, `fcm_token`, `otp`, `status`, `user_status`, `block_reason`, `refer_code`, `otp_verified`, `otp_expiry`, `remember_token`, `shop_name`, `shop_image`, `shop_category`, `shop_address`, `discount`, `created_at`, `updated_at`) VALUES
(1, 'chapanu', 'richlabstech@gmail.com', '+918074751102', '$2y$10$oCPH09XGub8LKbqb2.yYd.mtMmmdFm3dL1qg457caxVVR4df3XpMC', '0', NULL, NULL, NULL, 'eTH3odPORTCl7HhRgWtZoW:APA91bHGPglPRPWhklUjeoDXLBT66-sWN8-zHPLpcvqB9MkQSwL7nFopt2lP0zuAe1Q4Xxla6tU-3tjbv7V-ZeCDDqaEqObWPBuS3YiC1hcdbmaWg7hKxRI', '396757', 'approved', 'normal', NULL, 'MAJWNC6T', 0, '2025-05-15 15:35:24', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-15 15:25:24', '2025-05-15 15:25:24'),
(2, 'nisham', 'nishammpm@gmail.com', '+919447677776', '$2y$10$0A3i5XKFnAfaF8gDaRYU/O55cLcjLgoi0pQfre8YlU7FBMtSgGlES', '2', 'user_image/userimage_684846c9d637c.jpg', 'user_documents/doc_683dcbde75227.jpg', NULL, 'dWkTMySeSQ6GuDykWFhCan:APA91bFb3QQCxPqNvjgSx2kZtJS0SJVd_DHhhHXSHjJucMx4B_mfq6Ti_l57ccQts2-mbEykGSW1xlnSy-fqXuX5MO7eRxNmhgursw2IKJrVH8vsW6uDIPc', '358682', 'approved', 'verified', NULL, '3BFUT9M8', 1, '2025-06-10 20:45:24', NULL, 'Yash', 'shop_image/shopimage_683dcbde75163.jpg', 'pub', 'Calicut', 10, '2025-05-15 19:07:50', '2025-06-14 12:17:28'),
(3, 'chapanu', 'chapanu@gmail.com', '+1+15197746724', '$2y$10$LxAJ5Lf0PTV46hEcKPRd6eZj.wKoaNu2bKccH5vQe2nz6V.NSdVcS', '0', NULL, NULL, NULL, 'dyfvcICfRsieZ9VoTGCYUx:APA91bE5ZoZ1kKawb6reJ10J6tbHH7hty9cP6_Mg_uwM2bK72sXR-K-As7AtHejbrYNvXUQINwEujHf-c770FAWb9QQ5lmAu-aG5ofCd7pZ1rWvCWRDoe3I', '197640', 'approved', 'normal', NULL, '16EVR2QG', 0, '2025-05-17 15:02:09', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-17 14:52:09', '2025-05-17 14:52:09'),
(4, 'dinesh', 'dish@gmail.com', '+919989945854', '$2y$10$2cXk/RLRxsPd4c7rTRWdTuFh1zqtEFlQd6XI58DMex2W/vXQBS2NC', '0', NULL, NULL, NULL, 'C38ABCA9A29606E9D44E9B8DA57A17E455ED91A943CCAEA358B1E1A0AF41767A', '977848', 'approved', 'normal', NULL, 'JQ3WDPB8', 0, '2025-05-18 18:08:38', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-18 17:58:38', '2025-06-08 15:37:15'),
(5, 'nisham', '0908nisham@gmail.com', '+91+919447677776', '$2y$10$2QfGG8BvNlVm.rtfIOGH.usxZn8DVVKVh8f0peZ3qFN9iIHFkp2Ia', '0', NULL, NULL, NULL, '64726EFB0BD0F2E3BFDC982C979D96EFC89B9230197439B8516B1EBB5B008A18', '764635', 'approved', 'normal', NULL, 'F0RVWGHN', 0, '2025-05-19 05:23:47', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-19 05:13:47', '2025-05-19 05:13:47'),
(9, 'rajesh11 verma', 'sim@gmail.com', '+919893285547', '$2y$10$2IReCtO20caZMeNh1/e3qODFMtRxK07sRfA1xEVN1RXXjcd9fOefq', '535', 'user_image/userimage_6846ae53e2939.jpg', 'user_documents/doc_6846ae04b995b.jpg', 'qr_a5o1usg18P.png', 'e8prGEfIS-GX_GdcySH_Ch:APA91bGGebMhxX1J7Jth1A_VXKN2UnV7IG_VsIIYVlJbnLptbYLK_CEVocIjMNbiifCeXcz41_R6FA_O8-MFe6ZeLfDPvFqg5M9yTf_gE4DZTQ3rvzmNnTA', '719377', 'approved', 'wait_for_verification', NULL, 'U12Q48K9', 0, '2025-06-02 15:21:29', NULL, 'my Shop', 'shop_image/shopimage_68469ed0dd4e5.jpg', 'Electronics', 'new era hills  bhopal', 10, '2025-06-02 15:11:29', '2025-06-09 16:08:35'),
(10, 'Suresh verma', 'sureshvermaaa@gmail.com', '+919977358147', '$2y$10$c/ZrM3AcgaHsSzRcbtehG.ZwpLn1M2dnINI1Zq8WhwZmddXmpeTL6', '250', 'user_image/userimage_6846929f21876.jpg', 'user_documents/doc_683d790b46a42.jpg', 'qr_ivKGDcJMp6.png', 'dcpVnvCiR3GMUmdD4m-7uO:APA91bHjHzedJxmD6UWB0kr2pLOjkNRUo1N73OT00FeTVPgJ5dCo_9QrB0qiN5umGAthPGrvM28sTlsZ5gqikuO_EreU7qW8WuMoRRKME9HJmvemaZDAOWY', '435716', 'approved', 'verified', NULL, 'BK1USQ6N', 0, '2025-06-09 16:46:24', NULL, 'Electronics', 'shop_image/shopimage_683d790b468ac.jpg', 'Pearl', 'new  area  hills  bhopal', 10, '2025-06-02 15:40:46', '2025-06-11 18:34:38'),
(11, 'Titu', 'roshanbust@gmail.com', '+919893247047', '$2y$10$D3MZkZocPODKrHNxzIJFCeak0o..tLk4gxNygwXmQL2dbXO8VSDlu', '480', NULL, 'user_documents/doc_683d9cfd2ea84.jpg', 'qr_8h8mF8oJsH.png', 'eQHr-TtHTXShtzoi2-FXkC:APA91bHSgUlqYQOxXOaLzBfDFCIOmCM54_ICHde6aUUvLOZz9VaaD5acjWk1SYX2w5LwYVRHO50gkqsWe6IXZBFxGB4GDNHzbgo3CBMAW9go7BawZ5GYpHs', '857735', 'approved', 'verified', NULL, '8QJA79YZ', 0, '2025-06-02 18:25:30', NULL, 'Leera Toys', 'shop_image/shopimage_683da10de572d.jpg', 'Toys', 'indore', 10, '2025-06-02 18:15:30', '2025-06-02 18:33:32'),
(12, 'ramesh', 'ramesh@yopmail.com', '+918109784437', '$2y$10$cOEmW02I.wru/ztY7JHDfeyoeelO17X3snny7yvYxJxAnj6R8rs4.', '0', NULL, 'user_documents/doc_683da22c113cb.jpg', 'qr_TLxsWd3M0E.png', 'feiQm1CqTgynngkIeV6Sm5:APA91bE-KHg0A2x3xJ1zGoR-hlMccQYPIWQithnFhVcmaV0OWAMcKQPyZwN4PJEy-VvFakTzddfPrYdXU2I2eHuEbB67e7AjtN77QRcxx-ZYVEVRavVCiLI', '223394', 'approved', 'verified', NULL, 'BM25OL4R', 0, '2025-06-02 18:46:34', NULL, 'shop1', 'shop_image/shopimage_683da22c111dd.jpg', 'fashion', 'indore', 5, '2025-06-02 18:36:34', '2025-06-02 18:57:34'),
(13, 'Vijay', 'vijay@gmail.com', '+919893247046', '$2y$10$PNV/lEMvmvv5ug9HbXQQnO7xnLC.WF6ubs5R5ftH4FVj4tWp/t4GG', '0', NULL, 'user_documents/doc_683da720929ff.jpg', 'qr_Jd3VSsQ9tP.png', 'd-YncGx1QJ-mhwGYB7f1-T:APA91bEGhs2fLI1pJj86e9e26yhRQLZYpBWJnpAVW-bFgw6FE5vKW9eWKubJ8QHKo6fsm85ptGGMf26QHjiLmi7zkNF7AbDNzFYHtqNHB1N33ej7WP7TvOM', '889692', 'approved', 'verified', NULL, '47YXKFM5', 0, '2025-06-02 19:07:57', NULL, 'Muskan Store', 'shop_image/shopimage_683da7125b398.jpg', 'Toys', 'Indore', 10, '2025-06-02 18:57:57', '2025-06-02 18:59:20'),
(14, 'Rakesh', 'rakeshnatsol@gmail.com', '+919340614804', '$2y$10$1ZDPs2jCp3c5jwjEidZTGepPMdXj3Asv8t/SnS37Z1dQPg2TEyNdq', '0', NULL, NULL, 'qr_66kbcoZoBN.png', 'dQX0l3xEQp-23kszfCBBwE:APA91bF4X3BuocenF3xh5-jCwk0NH5VmXzQTnfmiaHHSAGaZR6UcTqoM_3feeaVBf4Uo4dqiul65ruFfoT7tKmM6HRNx9kR_7oYfOd1BqgWnYmLOR3cn8Bc', '251347', 'approved', 'normal', NULL, 'QCD9YKLG', 0, '2025-06-03 12:13:42', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-03 12:03:42', '2025-06-03 12:03:42'),
(15, 'Sr', 'gagan@gmail.com', '+919993446820', '$2y$10$ntx1oT0G6EzDN5c6EK1ZIOLZNx2Kr3JdGPRK8qc6ozU1Htzg5n.p2', '0', NULL, NULL, 'qr_vbtqQoh7KM.png', 'fsS-5osWQ1KEd5OtnqcFXA:APA91bGeBCF-G9IFVp75vfqtbPqzhEaOZLvSIcCgkj-PDu-_923gjbP83WhwqlDCMSouRQEc_dr5VF4k4b6sz-5-ZUtRjiUbCZCwY0_UEV0EE2_JmyzMKpw', '701218', 'approved', 'normal', NULL, 'DH6PGNEX', 0, '2025-06-03 18:09:14', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-03 17:59:14', '2025-06-03 17:59:15'),
(16, 'nish', 'nisham@gmail.com', '+919778467776', '$2y$10$PZ2roYHBPNj1hfigsSv51OpgCYGVadkFf/Xg0l62I6SgkUBh96HDK', '0', NULL, 'user_documents/doc_6842d3440edc5.jpg', 'qr_9kaIAU9Nmx.png', 'dysxHMy5SHOHGNWKDsXmMm:APA91bGHl6I6w-SUonIatzB9Qvsl6rCM3pTCYKf74ZrNNPG-sEnl2sjYbWP5rlRsxmCaYSz-QQAHhGsshMVpeHAoAKTlQ1z7Dn5lInKS5YB92wUx7voM7fE', '957475', 'approved', 'wait_for_verification', NULL, 'P03JXSI6', 0, '2025-06-05 16:19:05', NULL, NULL, NULL, NULL, NULL, 0, '2025-06-05 16:09:05', '2025-06-06 17:08:44'),
(17, 'youngtet', 'youngtet@gmail.com', '+91623044153', '$2y$10$d3yL1MBMuTYIV8DUt2WzwuAotp/a1K3CsU.2a3lK6RU758JCNHZb2', '0', NULL, NULL, 'qr_sSVRSyJLP5.png', 'dysxHMy5SHOHGNWKDsXmMm:APA91bGHl6I6w-SUonIatzB9Qvsl6rCM3pTCYKf74ZrNNPG-sEnl2sjYbWP5rlRsxmCaYSz-QQAHhGsshMVpeHAoAKTlQ1z7Dn5lInKS5YB92wUx7voM7fE', '282730', 'approved', 'normal', NULL, 'YCP418NU', 0, '2025-06-05 21:52:13', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-05 21:41:17', '2025-06-05 21:42:13'),
(18, 'rifa', 'rifa@gmail.com', '+919562677776', '$2y$10$c/ZrM3AcgaHsSzRcbtehG.ZwpLn1M2dnINI1Zq8WhwZmddXmpeTL6', '10', NULL, NULL, 'qr_uC6LM2jlaM.png', 'd_5t4DSSQrWP6q_WxyiRb-:APA91bHFuKOIc2TFJofSHh2ZRuIW88u1fhIV5f7_KIOCEhLO8w0XDVkHZepg_g6ALRlry1ptY94AwueJmMbg94tmogqoVZjhkYBBKwzF7PrObHApat9zFp8', '353083', 'approved', 'normal', NULL, 'RUB4ETFQ', 0, '2025-06-06 23:59:03', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-06 23:49:03', '2025-06-13 13:16:13'),
(25, 'Kapil', 'rohit.natrajinfotech@gmail.com', '+917354719771', '$2y$10$hDaoUL6Zko7ws6xphngLT.BJoB/76HWyRUQeCTfbEnoqBq/i9bOnK', '490', 'user_image/userimage_684a6fe7464ed.jpg', 'user_documents/doc_6847c9a9bb4ae.jpg', 'qr_9Koe8YgIHp.png', 'dDqn2S-6Sn2dwqONw3Gc4u:APA91bGFvQ1WaL2StwXlT8K0g1_HpZQxxa977x488EZDkdQyGdjSUb-ihjKD2t7276_YfltPAynuY3L5zEsVlm0MButl0BF-c19S4OSQMa3J8Ju60ZNpLLU', '749828', 'approved', 'verified', NULL, 'TVXMIZSQ', 1, '2025-06-11 11:25:36', NULL, 'Veerum PVT', 'shop_image/shopimage_684a703958e27.jpg', 'Metals', '123, Abc', 10, '2025-06-09 16:42:05', '2025-06-12 18:26:49'),
(26, '8086323456', 'nisha@gmail.com', '+91123456', '$2y$10$MxcQVsrWRyWi73XvhI7sjeBanQg/6f/Amfh.a9Wa55Kc58i1kDftW', '30', NULL, NULL, 'qr_N2nfxGvLQy.png', 'dWkTMySeSQ6GuDykWFhCan:APA91bFb3QQCxPqNvjgSx2kZtJS0SJVd_DHhhHXSHjJucMx4B_mfq6Ti_l57ccQts2-mbEykGSW1xlnSy-fqXuX5MO7eRxNmhgursw2IKJrVH8vsW6uDIPc', '305759', 'approved', 'normal', NULL, 'EWZP85NA', 0, '2025-06-10 20:47:26', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 20:37:26', '2025-06-14 12:19:27'),
(27, 'nisham02', 'nn@gmail.com', '+918086323456', '$2y$10$fDG2T.7cLhyZwhsWITsLkO3zkKCX57129Ln464S2r/69f26jaBlne', '43', NULL, NULL, 'qr_DdqTk0QXOH.png', 'dWkTMySeSQ6GuDykWFhCan:APA91bFb3QQCxPqNvjgSx2kZtJS0SJVd_DHhhHXSHjJucMx4B_mfq6Ti_l57ccQts2-mbEykGSW1xlnSy-fqXuX5MO7eRxNmhgursw2IKJrVH8vsW6uDIPc', '787105', 'approved', 'normal', NULL, 'I4OAYM5L', 0, '2025-06-11 14:37:04', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 14:27:04', '2025-06-14 12:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `wallettransaction`
--

CREATE TABLE `wallettransaction` (
  `id` bigint(20) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `inv_amount` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallettransaction`
--

INSERT INTO `wallettransaction` (`id`, `sender_id`, `receiver_id`, `inv_amount`, `amount`, `type`, `comments`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 26, 100.00, 10.00, 'transfer', NULL, 'completed', '2025-06-10 20:40:52', '2025-06-10 20:40:52'),
(2, 2, 26, 100.00, 10.00, 'transfer', NULL, 'completed', '2025-06-11 14:25:48', '2025-06-11 14:25:48'),
(3, 2, 26, 150.00, 15.00, 'transfer', NULL, 'completed', '2025-06-11 15:32:09', '2025-06-11 15:32:09'),
(4, 2, 27, 110.00, 11.00, 'transfer', NULL, 'completed', '2025-06-11 15:34:32', '2025-06-11 15:34:32'),
(5, 2, 27, 120.00, 12.00, 'transfer', NULL, 'completed', '2025-06-11 16:29:55', '2025-06-11 16:29:55'),
(6, 25, 18, 100.00, 10.00, 'transfer', '10 Rupees bonus', 'completed', '2025-06-12 11:56:23', '2025-06-12 11:56:23'),
(7, 2, 27, 0.00, 15.00, 'transfer', NULL, 'completed', '2025-06-12 14:13:29', '2025-06-12 14:13:29'),
(8, 2, 27, 0.00, 15.00, 'transfer', NULL, 'completed', '2025-06-12 14:13:30', '2025-06-12 14:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `gateway_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL,
  `getable_amount` varchar(255) NOT NULL,
  `fee` varchar(255) NOT NULL,
  `status` enum('pending','completed','rejected') NOT NULL DEFAULT 'pending',
  `block_reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_dynamic_fields`
--

CREATE TABLE `withdraw_dynamic_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_id` bigint(20) UNSIGNED NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_gateways`
--

CREATE TABLE `withdraw_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `min` decimal(8,2) NOT NULL,
  `max` decimal(8,2) NOT NULL,
  `fee` decimal(8,2) NOT NULL,
  `instruction` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_gateways`
--

INSERT INTO `withdraw_gateways` (`id`, `name`, `logo`, `currency`, `rate`, `min`, `max`, `fee`, `instruction`, `status`, `created_at`, `updated_at`) VALUES
(2, 'sddas', 'uploads/sliders/1747413280.png', 'das', 1.00, 11.00, 11.00, 11.00, '111', 'active', '2025-05-16 16:34:40', '2025-05-16 16:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_gateway_dynamic_fields`
--

CREATE TABLE `withdraw_gateway_dynamic_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_gateway_id` bigint(20) UNSIGNED NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_gateway_dynamic_fields`
--

INSERT INTO `withdraw_gateway_dynamic_fields` (`id`, `withdraw_gateway_id`, `field_name`, `field_type`, `created_at`, `updated_at`) VALUES
(1, 2, 'sda', 'text', '2025-05-16 16:34:40', '2025-05-16 16:34:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `app_versions`
--
ALTER TABLE `app_versions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firebase_config`
--
ALTER TABLE `firebase_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway_fileds`
--
ALTER TABLE `gateway_fileds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gateway_fileds_payment_gateway_id_foreign` (`payment_gateway_id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo_favicon_settings`
--
ALTER TABLE `logo_favicon_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lotteries`
--
ALTER TABLE `lotteries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lottery_tickets`
--
ALTER TABLE `lottery_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lottery_tickets_ticket_number_unique` (`ticket_number`),
  ADD KEY `lottery_tickets_lottery_id_foreign` (`lottery_id`),
  ADD KEY `lottery_tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_dynamic_fields`
--
ALTER TABLE `payment_dynamic_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateway_dynamic_fields`
--
ALTER TABLE `payment_gateway_dynamic_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_gateway_dynamic_fields_payment_gateway_id_foreign` (`payment_gateway_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `queues_queue_index` (`queue`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrals_referrer_id_foreign` (`referrer_id`),
  ADD KEY `referrals_referred_id_foreign` (`referred_id`);

--
-- Indexes for table `refer_settings`
--
ALTER TABLE `refer_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scratches`
--
ALTER TABLE `scratches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scratch_card_assigns`
--
ALTER TABLE `scratch_card_assigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scratch_card_user_progress`
--
ALTER TABLE `scratch_card_user_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_scratch_date_unique` (`user_id`,`scratch_id`,`scratch_date`),
  ADD KEY `scratch_card_user_progress_scratch_id_foreign` (`scratch_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_refer_code_unique` (`refer_code`);

--
-- Indexes for table `wallettransaction`
--
ALTER TABLE `wallettransaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_dynamic_fields`
--
ALTER TABLE `withdraw_dynamic_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_gateways`
--
ALTER TABLE `withdraw_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_gateway_dynamic_fields`
--
ALTER TABLE `withdraw_gateway_dynamic_fields`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_versions`
--
ALTER TABLE `app_versions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firebase_config`
--
ALTER TABLE `firebase_config`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gateway_fileds`
--
ALTER TABLE `gateway_fileds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logo_favicon_settings`
--
ALTER TABLE `logo_favicon_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lotteries`
--
ALTER TABLE `lotteries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lottery_tickets`
--
ALTER TABLE `lottery_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payment_dynamic_fields`
--
ALTER TABLE `payment_dynamic_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_gateway_dynamic_fields`
--
ALTER TABLE `payment_gateway_dynamic_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `queues`
--
ALTER TABLE `queues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `refer_settings`
--
ALTER TABLE `refer_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scratches`
--
ALTER TABLE `scratches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scratch_card_assigns`
--
ALTER TABLE `scratch_card_assigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scratch_card_user_progress`
--
ALTER TABLE `scratch_card_user_progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `wallettransaction`
--
ALTER TABLE `wallettransaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_dynamic_fields`
--
ALTER TABLE `withdraw_dynamic_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_gateways`
--
ALTER TABLE `withdraw_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdraw_gateway_dynamic_fields`
--
ALTER TABLE `withdraw_gateway_dynamic_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gateway_fileds`
--
ALTER TABLE `gateway_fileds`
  ADD CONSTRAINT `gateway_fileds_payment_gateway_id_foreign` FOREIGN KEY (`payment_gateway_id`) REFERENCES `payment_gateways` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lottery_tickets`
--
ALTER TABLE `lottery_tickets`
  ADD CONSTRAINT `lottery_tickets_lottery_id_foreign` FOREIGN KEY (`lottery_id`) REFERENCES `lotteries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lottery_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_gateway_dynamic_fields`
--
ALTER TABLE `payment_gateway_dynamic_fields`
  ADD CONSTRAINT `payment_gateway_dynamic_fields_payment_gateway_id_foreign` FOREIGN KEY (`payment_gateway_id`) REFERENCES `payment_gateways` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_referred_id_foreign` FOREIGN KEY (`referred_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referrals_referrer_id_foreign` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
