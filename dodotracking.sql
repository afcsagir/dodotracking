-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 16, 2021 at 06:41 PM
-- Server version: 10.3.28-MariaDB
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
-- Database: `bukakont_dodo`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_13_162314_add_is_active_to_users_table', 2),
(5, '2021_03_14_220055_add_phone_to_users_table', 3),
(6, '2021_03_15_142014_add_phone_to_orders_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `shipper_id` int(10) UNSIGNED NOT NULL,
  `shop_id` varchar(10) NOT NULL,
  `tracking_id` varchar(255) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `input_method` enum('manual','import') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phone` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `shipper_id`, `shop_id`, `tracking_id`, `buyer`, `input_method`, `date`, `time`, `updated_at`, `phone`) VALUES
(69, 1, 'jas', '9CVHZ19AH8', 'John Doe', 'manual', '2021-03-16', '14:17:20', '2021-03-16 07:17:20', '123456789'),
(70, 1, 'jas', '7XHJ53YRR6', 'John Doe', 'manual', '2021-03-16', '14:18:04', '2021-03-16 07:18:04', '123456789'),
(71, 2, 'jas', 'VWTEL1XRUO', 'John Doe', 'manual', '2021-03-16', '14:18:25', '2021-03-16 07:18:25', '123456789'),
(72, 3, 'jas', 'FIEG1FOQ2W', 'John Doe', 'manual', '2021-03-16', '14:18:45', '2021-03-16 07:18:45', '123456789'),
(73, 2, 'jas', 'KHST8NXE96', 'John Doe', 'manual', '2021-03-16', '14:19:03', '2021-03-16 07:19:03', '123456789'),
(74, 1, 'LXDS', 'LIKJCK22HA', 'Jane Doe', 'manual', '2021-03-16', '14:21:16', '2021-03-16 07:21:16', '0987654321'),
(75, 3, 'LXDS', 'WX3NQYFIXG', 'Jane Doe', 'manual', '2021-03-16', '14:21:37', '2021-03-16 07:21:37', '0987654321'),
(76, 2, 'LXDS', 'KRNCCOKSY9', 'Jane Doe', 'manual', '2021-03-16', '14:22:10', '2021-03-16 07:22:10', '0987654321'),
(77, 1, 'LXDS', '1I86U89OB4', 'Jane Doe', 'manual', '2021-03-16', '14:23:21', '2021-03-16 07:23:21', '0987654321'),
(78, 2, 'LXDS', 'N5PSA0IRKA', 'Jane Doe', 'manual', '2021-03-16', '14:25:47', '2021-03-16 07:25:47', '0987654321');

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
-- Table structure for table `shippers`
--

CREATE TABLE `shippers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shippers`
--

INSERT INTO `shippers` (`id`, `name`) VALUES
(1, 'Thailand Packing'),
(2, 'Jingjo Packaging'),
(3, 'Kerry Express');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('member','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `shop_id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `is_active`) VALUES
(1, '', 'admin', 'admin@mail.com', NULL, '$2y$10$nqvYnXJH4oOHpvyrru.Z1eSeOSJ1L7NZ6eL.riLX50a7fAf5MqVGG', 'admin', 'YYtpS4T7IFD7xW7EtMSo3yH90M84cigZouMayrZ40cawd81D9fp9Ffcgsug1', '2021-03-08 21:51:31', '2021-03-08 21:51:31', 1),
(9, 'jas', 'jbkjb', 'member@mail.com', NULL, '$2y$10$JThcKn8FMmDhauwJb6m8q.CuPevCvAO5QCMr8IknsafDjaiFl9Noe', 'member', NULL, '2021-03-16 03:41:36', '2021-03-16 08:01:52', 1),
(11, 'LXDS', 'Jane Doe', 'jane@mail.com', NULL, '$2y$10$XVncYfDlogfm0AyWX1NmvOp7qtX3hplaz/z7Zso.lLHjJdSUDA8Ay', 'member', NULL, '2021-03-16 07:20:36', '2021-03-16 07:59:24', 1);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipper_id` (`shipper_id`),
  ADD KEY `user` (`shop_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `shippers`
--
ALTER TABLE `shippers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `shop_id` (`shop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `shippers`
--
ALTER TABLE `shippers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`shipper_id`) REFERENCES `shippers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
