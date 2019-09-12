-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 12, 2019 at 05:16 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zensushi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `additionals`
--

CREATE TABLE `additionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `value` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `remove` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bones`
--

CREATE TABLE `bones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `value` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `remove` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Seafoods', '2019-09-11 19:25:57', NULL),
(2, 'Meats', '2019-09-11 19:25:57', NULL),
(3, 'Fresh', '2019-09-11 19:25:57', NULL),
(4, 'Dry Goods', '2019-09-11 19:25:57', NULL),
(5, 'Tea', '2019-09-11 19:25:57', NULL),
(6, 'Souces', '2019-09-11 19:25:57', NULL),
(7, 'Others', '2019-09-11 19:25:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `in_records`
--

CREATE TABLE `in_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `value` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `remove` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `in_records`
--

INSERT INTO `in_records` (`id`, `item_id`, `value`, `created_at`, `updated_at`, `user`, `remove`) VALUES
(1, 1, 10.00, '2019-09-11 19:26:20', '2019-09-11 19:26:20', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remove` tinyint(1) DEFAULT '0',
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `description`, `created_at`, `updated_at`, `remove`, `unit_id`, `category_id`, `item_type_id`, `user_id`) VALUES
(1, 'BEEF', '2019-09-11 19:25:57', NULL, 0, 4, 2, 1, 1),
(2, 'PORK', '2019-09-11 19:25:57', NULL, 0, 4, 2, 1, 1),
(3, 'PORK (80 Grams)', '2019-09-11 19:25:57', NULL, 0, 4, 2, 2, 2),
(4, 'Dish Washing Liquid', '2019-09-11 19:25:57', NULL, 0, 1, 7, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE `item_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Raw', '2019-09-11 19:25:57', NULL),
(2, 'Product', '2019-09-11 19:25:57', NULL),
(3, 'Other', '2019-09-11 19:25:57', NULL);

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
(144, '2019_07_19_183020_create_roles_table', 1),
(145, '2019_07_19_183233_create_users_table', 1),
(146, '2019_07_19_183420_create_password_resets_table', 1),
(147, '2019_07_19_183725_create_categories_table', 1),
(148, '2019_07_19_183747_create_item_types_table', 1),
(149, '2019_07_19_183835_create_units_table', 1),
(150, '2019_07_19_183857_create_items_table', 1),
(151, '2019_07_19_184204_create_raws_table', 1),
(152, '2019_07_19_184234_create_raw_products_table', 1),
(153, '2019_07_19_184305_create_not_raws_table', 1),
(154, '2019_07_19_184948_create_additionals_table', 1),
(155, '2019_07_19_185015_create_bones_table', 1),
(156, '2019_07_19_185034_create_scraps_table', 1),
(157, '2019_09_05_075320_create_in_records_table', 1),
(158, '2019_09_05_075449_create_out_records_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `not_raws`
--

CREATE TABLE `not_raws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remove` tinyint(1) DEFAULT '0',
  `item_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `not_raws`
--

INSERT INTO `not_raws` (`id`, `value`, `created_at`, `updated_at`, `remove`, `item_id`) VALUES
(1, NULL, '2019-09-11 19:25:57', NULL, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `out_records`
--

CREATE TABLE `out_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `value` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `remove` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `raws`
--

CREATE TABLE `raws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remove` tinyint(1) DEFAULT '0',
  `item_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raws`
--

INSERT INTO `raws` (`id`, `value`, `created_at`, `updated_at`, `remove`, `item_id`) VALUES
(1, 1000.00, '2019-09-11 19:25:57', NULL, 0, 1),
(2, 1000.00, '2019-09-11 19:25:57', NULL, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `raw_products`
--

CREATE TABLE `raw_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `raw_id` bigint(20) UNSIGNED NOT NULL,
  `value` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remove` tinyint(1) DEFAULT '0',
  `item_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raw_products`
--

INSERT INTO `raw_products` (`id`, `raw_id`, `value`, `created_at`, `updated_at`, `remove`, `item_id`) VALUES
(1, 2, 80.00, '2019-09-11 19:25:57', NULL, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2019-09-11 19:25:56', NULL),
(2, 'member', '2019-09-11 19:25:56', NULL),
(3, 'unconfirm', '2019-09-11 19:25:56', NULL),
(4, 'inactive', '2019-09-11 19:25:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scraps`
--

CREATE TABLE `scraps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `value` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `remove` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Pack', '2019-09-11 19:25:57', NULL),
(2, 'Tab', '2019-09-11 19:25:57', NULL),
(3, 'Roll', '2019-09-11 19:25:57', NULL),
(4, 'Kilo', '2019-09-11 19:25:57', NULL),
(5, 'Liter', '2019-09-11 19:25:57', NULL),
(6, 'Bottle', '2019-09-11 19:25:57', NULL),
(7, 'Box', '2019-09-11 19:25:57', NULL),
(8, 'Bar', '2019-09-11 19:25:57', NULL),
(9, 'Tray', '2019-09-11 19:25:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remove` tinyint(1) DEFAULT '0',
  `role_id` bigint(20) UNSIGNED DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `remove`, `role_id`) VALUES
(1, 'Admin Zensushi', 'admin@zensushi.com', '$2y$10$lmTtAKr9C0VV45blE66oo.4ehFlM3QD/SIy06tFKfawYVJfEQUGEO', NULL, NULL, '2019-09-11 19:25:56', NULL, 0, 1),
(2, 'Member Zensushi', 'member@zensushi.com', '$2y$10$1VtDwQo3NK1QBL9hJjYxpO99JeSewjVFuHFqKaTh31YyJI21hy9b6', NULL, NULL, '2019-09-11 19:25:57', NULL, 0, 2),
(3, 'AbingPj', 'abing.pj@gmail.com', '$2y$10$amsKAxTy8BLhhHql4F40euhFziQVtKu3fK71Hs7y3dO0nTzlpPKce', NULL, NULL, '2019-09-11 19:25:57', NULL, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additionals`
--
ALTER TABLE `additionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bones`
--
ALTER TABLE `bones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_records`
--
ALTER TABLE `in_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_types`
--
ALTER TABLE `item_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `not_raws`
--
ALTER TABLE `not_raws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `out_records`
--
ALTER TABLE `out_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `raws`
--
ALTER TABLE `raws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_products`
--
ALTER TABLE `raw_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scraps`
--
ALTER TABLE `scraps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additionals`
--
ALTER TABLE `additionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bones`
--
ALTER TABLE `bones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `in_records`
--
ALTER TABLE `in_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_types`
--
ALTER TABLE `item_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `not_raws`
--
ALTER TABLE `not_raws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `out_records`
--
ALTER TABLE `out_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raws`
--
ALTER TABLE `raws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `raw_products`
--
ALTER TABLE `raw_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scraps`
--
ALTER TABLE `scraps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
