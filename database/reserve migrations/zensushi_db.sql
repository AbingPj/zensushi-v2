-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2019 at 09:27 AM
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

--
-- Dumping data for table `additionals`
--

INSERT INTO `additionals` (`id`, `item_id`, `value`, `created_at`, `updated_at`, `user`, `remove`) VALUES
(1, 1, 88.00, '2019-09-11 09:26:52', NULL, 3, 0);

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
(1, 'Seafoods', '2019-09-11 01:26:14', NULL),
(2, 'Meats', '2019-09-11 01:26:14', NULL),
(3, 'Fresh', '2019-09-11 01:26:14', NULL),
(4, 'Dry Goods', '2019-09-11 01:26:14', NULL),
(5, 'Tea', '2019-09-11 01:26:14', NULL),
(6, 'Souces', '2019-09-11 01:26:14', NULL),
(7, 'Others', '2019-09-11 01:26:14', NULL);

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
(1, 'BEEF', '2019-09-11 01:26:15', NULL, 0, 4, 2, 1, 1),
(2, 'PORK', '2019-09-11 01:26:15', NULL, 0, 4, 2, 1, 1),
(3, 'PORK (80 Grams)', '2019-09-11 01:26:15', NULL, 0, 4, 2, 2, 2),
(4, 'Dish Washing Liquid', '2019-09-11 01:26:15', NULL, 0, 1, 7, 3, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `items_views`
-- (See below for the actual view)
--
CREATE TABLE `items_views` (
`id` bigint(20) unsigned
,`description` varchar(191)
,`unit` varchar(191)
,`category` varchar(191)
,`item_type` varchar(191)
,`created_at` timestamp
,`user_id` bigint(20) unsigned
,`category_id` bigint(20) unsigned
,`item_type_id` bigint(20) unsigned
,`unit_id` bigint(20) unsigned
,`IN` double(19,2)
,`OUT` double(19,2)
,`addi` double(19,2)
,`balance` varchar(19)
);

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
(1, 'Raw', '2019-09-11 01:26:14', NULL),
(2, 'Product', '2019-09-11 01:26:15', NULL),
(3, 'Other', '2019-09-11 01:26:15', NULL);

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
(128, '2019_07_19_183020_create_roles_table', 1),
(129, '2019_07_19_183233_create_users_table', 1),
(130, '2019_07_19_183420_create_password_resets_table', 1),
(131, '2019_07_19_183725_create_categories_table', 1),
(132, '2019_07_19_183747_create_item_types_table', 1),
(133, '2019_07_19_183835_create_units_table', 1),
(134, '2019_07_19_183857_create_items_table', 1),
(135, '2019_07_19_184204_create_raws_table', 1),
(136, '2019_07_19_184234_create_raw_products_table', 1),
(137, '2019_07_19_184305_create_not_raws_table', 1),
(138, '2019_07_19_184948_create_additionals_table', 1),
(139, '2019_07_19_185015_create_bones_table', 1),
(140, '2019_07_19_185034_create_scraps_table', 1),
(141, '2019_09_05_075320_create_in_records_table', 1),
(142, '2019_09_05_075449_create_out_records_table', 1),
(143, '2019_09_11_072140_create_items_display_view', 1);

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
(1, NULL, '2019-09-11 01:26:15', NULL, 0, 4);

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
(1, 1000.00, '2019-09-11 01:26:15', NULL, 0, 1),
(2, 1000.00, '2019-09-11 01:26:15', NULL, 0, 2);

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
(1, 2, 80.00, '2019-09-11 01:26:15', NULL, 0, 3);

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
(1, 'admin', '2019-09-11 01:26:14', NULL),
(2, 'member', '2019-09-11 01:26:14', NULL),
(3, 'unconfirm', '2019-09-11 01:26:14', NULL),
(4, 'inactive', '2019-09-11 01:26:14', NULL);

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
(1, 'Pack', '2019-09-11 01:26:14', NULL),
(2, 'Tab', '2019-09-11 01:26:14', NULL),
(3, 'Roll', '2019-09-11 01:26:14', NULL),
(4, 'Kilo', '2019-09-11 01:26:14', NULL),
(5, 'Liter', '2019-09-11 01:26:14', NULL),
(6, 'Bottle', '2019-09-11 01:26:14', NULL),
(7, 'Box', '2019-09-11 01:26:14', NULL),
(8, 'Bar', '2019-09-11 01:26:14', NULL),
(9, 'Tray', '2019-09-11 01:26:14', NULL);

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
(1, 'Admin Zensushi', 'admin@zensushi.com', '$2y$10$Bpqp4OgEnOT87fvC.YHI2.dz2RHcHSlDKqoNyRF8W.p11zchHdz7K', NULL, NULL, '2019-09-11 01:26:14', NULL, 0, 1),
(2, 'Member Zensushi', 'member@zensushi.com', '$2y$10$oF1UeNX1MUQ0B7NuI1g0R.wDnrOoEXh7rviuSvq2sCb4Yuw0aa3K.', NULL, NULL, '2019-09-11 01:26:14', NULL, 0, 2),
(3, 'AbingPj', 'abing.pj@gmail.com', '$2y$10$PD71PDcN1nIzFlYvBpMj3.9qCBb3lcYhJR8TCFtt1.o9YbtpHPF/W', NULL, NULL, '2019-09-11 01:26:14', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure for view `items_views`
--
DROP TABLE IF EXISTS `items_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `items_views`  AS  (select `items`.`id` AS `id`,`items`.`description` AS `description`,`units`.`description` AS `unit`,`categories`.`description` AS `category`,`item_types`.`description` AS `item_type`,`items`.`created_at` AS `created_at`,`items`.`user_id` AS `user_id`,`items`.`category_id` AS `category_id`,`items`.`item_type_id` AS `item_type_id`,`items`.`unit_id` AS `unit_id`,`item_in`.`IN` AS `IN`,`item_out`.`OUT` AS `OUT`,`addi`.`addi` AS `addi`,ifnull(((`item_in`.`IN` + ifnull(`addi`.`addi`,0)) - ifnull(`item_out`.`OUT`,0)),'0') AS `balance` from ((((((`items` join `categories` on((`categories`.`id` = `items`.`category_id`))) join `units` on((`units`.`id` = `items`.`unit_id`))) join `item_types` on((`item_types`.`id` = `items`.`item_type_id`))) left join (select `in_records`.`item_id` AS `item_id`,sum(`in_records`.`value`) AS `IN` from `in_records` group by `in_records`.`item_id`) `item_in` on((`item_in`.`item_id` = `items`.`id`))) left join (select `out_records`.`item_id` AS `item_id`,sum(`out_records`.`value`) AS `OUT` from `out_records` group by `out_records`.`item_id`) `item_out` on((`item_out`.`item_id` = `items`.`id`))) left join (select `additionals`.`item_id` AS `item_id`,sum(`additionals`.`value`) AS `addi` from `additionals` group by `additionals`.`item_id`) `addi` on((`addi`.`item_id` = `items`.`id`)))) ;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

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
