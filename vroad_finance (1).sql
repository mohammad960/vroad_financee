-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 03, 2022 at 08:52 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vroad_finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `boxes`
--

DROP TABLE IF EXISTS `boxes`;
CREATE TABLE IF NOT EXISTS `boxes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL,
  `market_id` int(11) NOT NULL,
  `removed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `boxes_market_id_foreign` (`market_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boxes`
--

INSERT INTO `boxes` (`id`, `name`, `number`, `type`, `balance`, `amount`, `market_id`, `removed`, `created_at`, `updated_at`) VALUES
(1, 'box1', 1, 'cahe', '10951', 1000, 1, 0, '2022-03-21 11:58:13', '2022-03-30 12:30:57'),
(2, 'box2', 2, 'cache', '190', 10000, 2, 0, '2022-03-24 08:37:38', '2022-03-27 05:46:08'),
(3, 'box3', 3, 'cache', '-905', 900000, 2, 0, '2022-03-24 08:38:27', '2022-03-30 08:51:10'),
(4, 'box4', 4, 'cache', '600', 2000, 1, 1, '2022-03-24 08:38:53', '2022-03-30 08:21:51'),
(5, 'box test', 231, 'asdad', NULL, 123, 1, 1, '2022-03-30 07:20:53', '2022-03-30 07:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `box_markets`
--

DROP TABLE IF EXISTS `box_markets`;
CREATE TABLE IF NOT EXISTS `box_markets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `market_id` int(11) NOT NULL,
  `box_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `box_markets_market_id_foreign` (`market_id`),
  KEY `box_markets_box_id_foreign` (`box_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

DROP TABLE IF EXISTS `costs`;
CREATE TABLE IF NOT EXISTS `costs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `removed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `costs_parent_id_foreign` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `name`, `type_id`, `parent_id`, `removed`, `created_at`, `updated_at`) VALUES
(1, 'direct', '3', 0, 0, '2022-03-21 12:22:20', '2022-03-21 12:30:53'),
(2, 'on hand', '3', 1, 0, '2022-03-21 12:22:52', '2022-03-21 12:31:02'),
(10, 'salary', '4', 10, 0, '2022-03-26 21:00:00', '2022-03-26 21:00:00'),
(5, 'a', '2', 0, 0, '2022-03-22 16:49:25', '2022-03-22 16:55:03'),
(7, 'adm', '2', 5, 0, '2022-03-22 16:55:46', '2022-03-22 16:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_hour` double NOT NULL,
  `market_id` int(11) NOT NULL,
  `removed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_market_id_foreign` (`market_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `full_name`, `number`, `phone`, `price_hour`, `market_id`, `removed`, `created_at`, `updated_at`) VALUES
(1, 'ali ibrahim', 2, '6413252', 5, 1, 0, '2022-03-21 14:44:20', '2022-03-22 10:28:33'),
(2, 'ahmad', 3, '96399619161', 3, 2, 0, '2022-03-24 09:18:26', '2022-03-24 09:18:26'),
(3, 'ahmad ali', 5, '937790237', 4, 1, 0, '2022-03-24 09:18:46', '2022-03-24 09:18:46'),
(4, 'dsadas', 232, '42423', 3, 1, 1, '2022-03-30 07:32:16', '2022-03-30 07:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
CREATE TABLE IF NOT EXISTS `goods` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `market_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `removed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `amount`, `user_id`, `market_id`, `time`, `removed`, `created_at`, `updated_at`) VALUES
(2, '100', '1', '1', '2022-03-29 11:25:00', 0, '2022-03-29 08:25:47', '2022-03-30 08:42:58'),
(3, '230', '1', '2', '2022-03-29 11:26:00', 0, '2022-03-29 08:26:28', '2022-03-29 08:26:28'),
(4, '100', '1', '1', '2022-03-29 11:26:00', 0, '2022-03-29 08:26:44', '2022-03-29 08:26:44'),
(5, '900', '2', '1', '2022-03-29 12:55:00', 1, '2022-03-29 09:55:50', '2022-03-30 08:32:20'),
(6, '90', '1', '1', '2022-03-30 11:29:00', 1, '2022-03-30 08:30:05', '2022-03-30 08:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

DROP TABLE IF EXISTS `histories`;
CREATE TABLE IF NOT EXISTS `histories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cost_id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `market_id` int(11) NOT NULL,
  `method` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `box_id` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL,
  `debit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `credit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `tax` int(11) DEFAULT NULL,
  `note` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `declared` int(11) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `image` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `removed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `histories_cost_id_foreign` (`cost_id`),
  KEY `histories_box_id_foreign` (`box_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `cost_id`, `type`, `market_id`, `method`, `box_id`, `user_id`, `amount`, `debit`, `credit`, `tax`, `note`, `declared`, `time`, `image`, `removed`, `created_at`, `updated_at`) VALUES
(39, 10, '4', 1, 'multi', 1, '2', 12, '0', '1', 0, 'no', 0, '2022-03-29 12:59:00', NULL, 1, '2022-03-29 09:59:21', '2022-03-29 09:59:21'),
(38, 2, '3', 1, 'check', 1, '2', 12000, '1', '0', 1, 'no', 1, '2022-03-29 12:55:00', NULL, 1, '2022-03-29 09:55:35', '2022-03-29 09:55:35'),
(37, 10, '4', 1, 'multi', 1, '2', 8, '0', '1', 0, 'no', 0, '2022-03-29 11:09:00', NULL, 1, '2022-03-29 08:09:09', '2022-03-29 08:09:09'),
(36, 2, '3', 1, 'cache', 4, '2', 1000, '1', '0', 0, 'no', NULL, '2022-03-28 11:08:00', NULL, 1, '2022-03-29 08:08:58', '2022-03-29 08:08:58'),
(35, 10, '4', 1, 'multi', 1, '2', 10, '0', '1', 0, 'no', 0, '2022-03-28 12:21:00', NULL, 1, '2022-03-28 09:21:07', '2022-03-28 09:21:07'),
(34, 2, '3', 1, 'cache', 1, '2', -1000, '0', '1', 1, 'no', 1, '2022-03-28 12:20:00', NULL, 1, '2022-03-28 09:20:37', '2022-03-30 05:49:33'),
(40, 2, '3', 2, 'check', 3, '1', -455, '0', '1', 1, 'no', 1, '2022-03-30 11:51:00', NULL, 0, '2022-03-30 08:51:10', '2022-03-30 08:51:10'),
(41, 2, '3', 1, 'cache', 1, '1', -90, '0', '1', 0, 'no', 0, '2022-03-30 15:30:00', NULL, 0, '2022-03-30 12:30:35', '2022-03-30 12:30:35'),
(42, 2, '3', 1, 'cache', 1, '1', -90, '0', '1', 0, 'no', 0, '2022-03-30 15:30:00', NULL, 0, '2022-03-30 12:30:45', '2022-03-30 12:30:45'),
(43, 2, '3', 1, 'cache', 1, '1', -90, '0', '1', 0, 'no', 0, '2022-03-30 15:30:00', '431 (3).PNG', 0, '2022-03-30 12:30:57', '2022-03-30 12:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

DROP TABLE IF EXISTS `markets`;
CREATE TABLE IF NOT EXISTS `markets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `removed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `markets_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `markets`
--

INSERT INTO `markets` (`id`, `name`, `number`, `owner_name`, `address`, `user_id`, `removed`, `created_at`, `updated_at`) VALUES
(1, 'market1', 1, 'market1', 'Syria - Damascus Countryside – Al-Assad Suburb', 2, 0, '2022-03-21 11:30:57', '2022-03-24 08:36:51'),
(2, 'market2', 2, 'market2', 'damas', 3, 0, '2022-03-24 08:36:35', '2022-03-24 08:36:35'),
(3, 'asda', 23123, 'market3', 'sadasd', 2, 1, '2022-03-30 07:19:37', '2022-03-30 07:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_04_27_131930_create_users_table', 1),
(2, '2021_05_22_142616_create_roles_table', 1),
(11, '2022_03_21_123332_create_boxes_table', 3),
(4, '2022_03_21_123400_create_markets_table', 1),
(5, '2022_03_21_123615_create_box_markets_table', 1),
(6, '2022_03_21_123646_create_type_costs_table', 1),
(7, '2022_03_21_123708_create_costs_table', 1),
(8, '2022_03_21_123743_create_histories_table', 1),
(12, '2022_03_21_125648_create_employees_table', 4),
(13, '2022_03_21_125712_create_works_table', 5),
(15, '2022_03_24_112313_create_salaries_table', 6),
(16, '2022_03_29_105014_create_goods_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'superAdmin', '2022-03-20 22:00:00', '2022-03-20 22:00:00'),
(2, 'store manager', '2022-03-20 22:00:00', '2022-03-20 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

DROP TABLE IF EXISTS `salaries`;
CREATE TABLE IF NOT EXISTS `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `time` timestamp NULL DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonous` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cache` int(11) DEFAULT '0',
  `chec` int(11) DEFAULT '0',
  `employee_id` int(11) NOT NULL,
  `market_id` int(11) NOT NULL,
  `box_id` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `removed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `time`, `amount`, `bonous`, `transfer`, `cache`, `chec`, `employee_id`, `market_id`, `box_id`, `user_id`, `note`, `removed`, `created_at`, `updated_at`) VALUES
(10, '2022-03-28 12:21:00', '10', '0', '0', 10, 0, 1, 1, 1, '2', 'no', 1, '2022-03-28 09:21:07', '2022-03-28 09:21:07'),
(11, '2022-03-29 11:09:00', '8', '0', '0', 8, 0, 1, 1, 1, '2', 'no', 1, '2022-03-29 08:09:09', '2022-03-29 08:09:09'),
(12, '2022-03-29 12:59:00', '12', '0', '0', 12, 0, 3, 1, 1, '2', 'no', 1, '2022-03-29 09:59:21', '2022-03-30 07:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `type_costs`
--

DROP TABLE IF EXISTS `type_costs`;
CREATE TABLE IF NOT EXISTS `type_costs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_amount` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `market_id` int(11) DEFAULT NULL,
  `is_expense` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'off',
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_costs`
--

INSERT INTO `type_costs` (`id`, `name`, `start_amount`, `market_id`, `is_expense`, `amount`, `created_at`, `updated_at`) VALUES
(3, 'Income', NULL, NULL, 'off', 0, '2022-03-21 12:13:08', '2022-03-21 12:13:08'),
(2, 'Expense', NULL, NULL, 'on', 0, '2022-03-21 12:11:56', '2022-03-21 12:11:56'),
(4, 'salary', NULL, NULL, 'on', 0, '2022-03-22 10:23:29', '2022-03-22 10:23:29'),
(7, 'goods', NULL, NULL, 'off', 0, '2022-03-24 11:14:18', '2022-03-24 11:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `removed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `removed`, `created_at`, `updated_at`) VALUES
(1, 'ali', '$2y$10$vAdL32L8M8C.c3cy.Ry8.em.faYooutb.zhumPIHLoy85G88xsS76', 1, 0, '2022-03-21 11:06:56', '2022-03-21 11:23:47'),
(2, 'market1', '$2y$10$.lvd2nFlwDxLqSNmz39wJey/.Ov7V1i0ZsQrj2Gk3cMUifOwGFYaq', 2, 0, '2022-03-24 08:33:51', '2022-03-24 08:33:51'),
(3, 'market2', '$2y$10$IUQ1cNBpANJIxQiqaj588eZ56EF4TPKkSZEY9Vv0vT/OnfgXdMukK', 2, 0, '2022-03-24 08:33:59', '2022-03-24 08:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

DROP TABLE IF EXISTS `works`;
CREATE TABLE IF NOT EXISTS `works` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `start_time` timestamp NOT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `hours_work` double DEFAULT '0',
  `is_pay` int(11) NOT NULL DEFAULT '0',
  `removed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `works_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `employee_id`, `start_time`, `end_time`, `hours_work`, `is_pay`, `removed`, `created_at`, `updated_at`) VALUES
(4, 1, '2022-03-24 13:26:00', '2022-03-24 19:23:00', 5, 1, 0, '2022-03-24 11:23:03', '2022-03-24 11:31:18'),
(3, 1, '2022-03-22 14:25:00', '2022-03-22 18:25:00', 6, 1, 0, '2022-03-22 10:25:13', '2022-03-22 10:25:28'),
(5, 2, '2022-03-24 13:31:00', '2022-03-24 14:31:00', 1, 0, 0, '2022-03-24 11:31:45', '2022-03-24 11:31:51'),
(6, 1, '2022-03-24 13:32:00', '2022-03-24 14:38:00', 1, 1, 0, '2022-03-24 11:32:04', '2022-03-24 11:32:12'),
(7, 2, '2022-03-24 13:32:00', '2022-03-24 15:34:00', 2.2, 0, 0, '2022-03-24 11:32:37', '2022-03-24 11:32:43'),
(8, 3, '2022-03-24 13:38:00', '2022-03-24 17:11:00', 3.33, 1, 0, '2022-03-24 11:38:04', '2022-03-24 11:38:13'),
(9, 1, '2022-03-26 13:07:00', '2022-03-26 14:07:00', 1, 1, 0, '2022-03-26 06:07:11', '2022-03-26 06:07:25'),
(10, 3, '2022-03-26 09:16:00', '2022-03-26 14:16:00', 5, 1, 0, '2022-03-26 06:16:43', '2022-03-26 06:16:50'),
(11, 1, '2022-03-26 11:37:00', '2022-03-26 11:37:00', 0, 1, 0, '2022-03-26 08:37:28', '2022-03-26 08:37:48'),
(12, 3, '2022-03-29 12:58:00', '2022-03-29 12:58:00', 0, 1, 0, '2022-03-29 09:58:10', '2022-03-29 09:58:19');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
