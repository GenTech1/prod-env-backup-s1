-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2026 at 06:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `domus_users`
--
CREATE DATABASE IF NOT EXISTS `domus_users` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `domus_users`;

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`id`, `name`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Default Business', '', '', '', '2025-12-16 09:26:57', '2025-12-16 09:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `business_id` int(11) DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `business_id`, `user_id`, `login_time`, `ip_address`) VALUES
(1, 1, 1, '2025-12-16 02:12:28', '::1'),
(2, 1, 2, '2025-12-16 02:13:08', '::1'),
(3, 1, 3, '2025-12-16 02:13:27', '::1'),
(4, 1, 1, '2025-12-16 02:24:28', '::1'),
(5, 1, 2, '2025-12-16 02:24:49', '::1'),
(6, 1, 2, '2025-12-16 02:27:41', '::1'),
(7, 1, 3, '2025-12-16 02:28:07', '::1'),
(8, 1, 1, '2025-12-16 02:28:34', '::1'),
(9, 1, 1, '2025-12-16 02:33:53', '::1'),
(10, 1, 3, '2025-12-16 02:34:20', '::1'),
(11, 1, 3, '2025-12-16 02:35:52', '::1'),
(12, 1, 3, '2025-12-16 02:42:52', '::1'),
(13, 1, 1, '2025-12-16 02:44:24', '::1'),
(14, 1, 2, '2025-12-16 02:44:54', '::1'),
(15, 1, 2, '2025-12-16 02:47:22', '::1'),
(16, 1, 3, '2025-12-16 02:47:36', '::1'),
(17, 1, 3, '2025-12-16 02:56:38', '::1'),
(18, 1, 3, '2025-12-16 02:57:16', '::1'),
(19, 1, 1, '2025-12-16 03:01:46', '::1'),
(20, 1, 2, '2025-12-16 03:03:19', '::1'),
(21, 1, 1, '2025-12-16 03:04:07', '::1'),
(22, 1, 2, '2025-12-16 03:04:46', '::1'),
(23, 1, 2, '2025-12-16 03:06:39', '::1'),
(24, 1, 3, '2025-12-16 03:27:34', '::1'),
(25, 1, 3, '2025-12-24 16:27:52', '::1'),
(26, 1, 1, '2025-12-24 16:34:43', '::1'),
(27, 1, 2, '2025-12-24 16:35:21', '::1'),
(28, 1, 3, '2025-12-24 16:55:19', '::1'),
(29, 1, 1, '2025-12-24 17:05:51', '::1'),
(30, 1, 3, '2025-12-24 17:11:45', '::1'),
(31, 1, 1, '2025-12-24 17:15:55', '::1'),
(32, 1, 5, '2025-12-24 17:17:11', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `business_id` int(11) DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('open','in_progress','resolved') NOT NULL DEFAULT 'open',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `business_id`, `user_id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Leaky faucet in kitchen', 'Kitchen sink leaks when faucet is turned on. Needs new washer or cartridge.', 'open', '2025-12-16 02:19:57', '2025-12-16 02:19:57'),
(2, 1, 3, 'AC not cooling', 'A/C cycles but only blows warm air. Filter already cleaned.', 'in_progress', '2025-12-14 02:19:57', '2025-12-15 02:19:57'),
(3, 1, 3, 'Broken bedroom window', 'Cracked pane after storm; needs replacement or temporary boarding.', 'resolved', '2025-12-06 02:19:57', '2025-12-11 02:19:57'),
(4, 1, 1, 'Replace hallway light bulbs', 'Multiple bulbs out on 3rd floor hallway — please replace with LED bulbs.', 'open', '2025-12-15 02:19:57', '2025-12-15 02:19:57'),
(5, 1, 2, 'Spare parts inventory needed', 'Requesting inventory check for spare faucets, filters, and bulbs.', 'resolved', '2025-12-13 02:19:57', '2025-12-16 02:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_notes`
--

CREATE TABLE `ticket_notes` (
  `id` int(11) NOT NULL,
  `business_id` int(11) DEFAULT 1,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `business_id` int(11) DEFAULT 1,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` enum('management','maintenance','tenant') NOT NULL DEFAULT 'tenant',
  `remember_token` varchar(255) DEFAULT NULL,
  `remember_expiry` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `business_id`, `email`, `password`, `name`, `user_type`, `remember_token`, `remember_expiry`, `created_at`, `updated_at`) VALUES
(1, 1, 'management@example.com', '$2y$10$NeRawDolITA1hIcmdnHO8eNI6XvWQhBwgse/6WZd9PE8MSHK54udG', 'Site Manager', 'management', NULL, NULL, '2025-12-16 08:06:09', '2025-12-24 22:27:16'),
(2, 1, 'maintenance@example.com', '$2y$10$NeRawDolITA1hIcmdnHO8eNI6XvWQhBwgse/6WZd9PE8MSHK54udG', 'Maintenance Tech', 'maintenance', NULL, NULL, '2025-12-16 08:06:09', '2025-12-24 22:27:29'),
(3, 1, 'tenant@example.com', '$2y$10$NeRawDolITA1hIcmdnHO8eNI6XvWQhBwgse/6WZd9PE8MSHK54udG', 'Tenant User', 'tenant', NULL, NULL, '2025-12-16 08:06:09', '2025-12-24 22:27:39'),
(5, 1, 'tenant2@example.com', '$2y$10$5q4dLZfyCq7JMA6NxsBx6elUOZi8Fy8yWNY0HcheEPQ6FMnmehCOy', 'John Doe', 'tenant', NULL, NULL, '2025-12-24 23:16:21', '2025-12-24 23:16:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `login_time` (`login_time`),
  ADD KEY `idx_login_logs_business_id` (`business_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_tickets_business_id` (`business_id`),
  ADD KEY `idx_tickets_business_status` (`business_id`,`status`);

--
-- Indexes for table `ticket_notes`
--
ALTER TABLE `ticket_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_ticket_notes_business_id` (`business_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_business_id` (`business_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticket_notes`
--
ALTER TABLE `ticket_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `fk_login_logs_business` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_tickets_business` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_notes`
--
ALTER TABLE `ticket_notes`
  ADD CONSTRAINT `fk_ticket_notes_business` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_notes_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_business` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;
--
-- Database: `oe_products`
--
CREATE DATABASE IF NOT EXISTS `oe_products` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `oe_products`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` char(36) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `subtotal_amount` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `shipping_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `shipped` tinyint(1) NOT NULL DEFAULT 0,
  `shipping_name` varchar(100) NOT NULL,
  `shipping_phone` varchar(20) NOT NULL,
  `shipping_email` varchar(100) NOT NULL,
  `shipping_address` text NOT NULL,
  `shipping_city` varchar(100) NOT NULL,
  `shipping_state` varchar(100) NOT NULL,
  `shipping_zip` varchar(20) NOT NULL,
  `shipping_country` varchar(100) NOT NULL,
  `shipping_method` varchar(50) DEFAULT NULL,
  `tracking_number` varchar(100) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `sku`, `order_date`, `status`, `payment_status`, `payment_method`, `total_amount`, `subtotal_amount`, `tax_amount`, `shipping_amount`, `discount_amount`, `coupon_code`, `shipped`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `shipping_method`, `tracking_number`, `delivery_date`, `notes`, `updated_at`) VALUES
(1, 'TEST_ORDER_OMNI_999', 'TEST-SKU-001', '2026-02-04 11:26:09', 'Processing', 'Paid', 'Square', 15.50, 15.50, 0.00, 0.00, 0.00, 'NONE', 0, 'Zax Test', '555-0199', 'zax@test.com', '123 Developer Way', 'New York', 'NY', '10001', 'US', NULL, NULL, NULL, NULL, '2026-02-04 11:26:09'),
(2, NULL, 'K34-LIDANDSTRAW', '2026-02-04 13:37:16', 'Pending', 'Paid', 'Square', 1.00, 1.00, 0.00, 0.00, 0.00, '', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', '3725 Iowa ave', 'St.louis', 'MO', '63118', 'US', NULL, NULL, NULL, NULL, '2026-02-04 13:37:16'),
(3, 'b5b34a458e21e2b89c7f09c4', 'K34-LIDANDSTRAW', '2026-02-04 13:44:12', 'Pending', 'Paid', 'Square', 1.00, 1.00, 0.00, 0.00, 0.00, '', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', '3725 Iowa ave', 'St.louis', 'MO', '63118', 'US', NULL, NULL, NULL, NULL, '2026-02-04 13:44:12'),
(4, 'c994131df7e6d65b7d2342dc', 'K34-LIDANDSTRAW', '2026-02-04 13:45:26', 'Pending', 'Paid', 'Square', 1.00, 1.00, 0.00, 0.00, 0.00, '', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', '3725 Iowa ave', 'St.louis', 'MO', '63118', 'US', NULL, NULL, NULL, NULL, '2026-02-04 13:45:26'),
(5, 'c994131df7e6d65b7d2342dc', 'K34-LIDANDSTRAW', '2026-02-04 13:45:26', 'Pending', 'Paid', 'Square', 1.00, 1.00, 0.00, 0.00, 0.00, '', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', '3725 Iowa ave', 'St.louis', 'MO', '63118', 'US', NULL, NULL, NULL, NULL, '2026-02-04 13:45:26'),
(6, 'aa6a431d729e48b965d5246f', 'K34-LIDANDSTRAW', '2026-02-04 13:48:51', 'Pending', 'Paid', 'Square', 1.00, 1.00, 0.00, 0.00, 0.00, '', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', '111 location ave ', 'St.louis', 'MO', '63118', 'US', NULL, NULL, NULL, NULL, '2026-02-04 13:48:51'),
(7, 'aa6a431d729e48b965d5246f', 'K34-LIDANDSTRAW', '2026-02-04 13:48:51', 'Pending', 'Paid', 'Square', 1.00, 1.00, 0.00, 0.00, 0.00, '', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', '111 location ave ', 'St.louis', 'MO', '63118', 'US', NULL, NULL, NULL, NULL, '2026-02-04 13:48:51'),
(8, '4b27a9435feabe2c91e4e07f', 'K34-LIDANDSTRAW', '2026-02-04 13:48:57', 'Pending', 'Paid', 'Square', 1.00, 1.00, 0.00, 0.00, 0.00, '', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', '111 location ave ', 'St.louis', 'MO', '63118', 'US', NULL, NULL, NULL, NULL, '2026-02-04 13:48:57'),
(9, '4b27a9435feabe2c91e4e07f', 'K34-LIDANDSTRAW', '2026-02-04 13:48:57', 'Pending', 'Paid', 'Square', 1.00, 1.00, 0.00, 0.00, 0.00, '', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', '111 location ave ', 'St.louis', 'MO', '63118', 'US', NULL, NULL, NULL, NULL, '2026-02-04 13:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `print` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `tags` text NOT NULL,
  `stock` varchar(255) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `time created` datetime NOT NULL,
  `time updated` datetime NOT NULL,
  `visible` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `print`, `price`, `currency`, `tags`, `stock`, `sku`, `time created`, `time updated`, `visible`) VALUES
(10, 'Double Wall Glass Mug', 'Insulated clear glass coffee mug.', './public/assets/GlassCan1.jpeg', './public/assets/GlassCan1.jpeg', 19.99, 'USD', 'mug,glass,insulated,featured', '20', 'K34-LIDANDSTRAW', '2025-12-01 13:19:15', '2025-12-01 13:19:15', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Database: `oe_users`
--
CREATE DATABASE IF NOT EXISTS `oe_users` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `oe_users`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'example@example.com', '$2a$12$shXVGUmxGirM98b5o1IvVuGIjsJl04Nohm6w6gobTbM41dtg0wsCe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------


-- Database: `tickets`
--
CREATE DATABASE IF NOT EXISTS `tickets` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tickets`;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `Parties` varchar(50) NOT NULL,
  `Categories` int(20) NOT NULL,
  `Updated` datetime NOT NULL,
  `Messages` varchar(100) NOT NULL,
  `Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `Parties`, `Categories`, `Updated`, `Messages`, `Status`) VALUES
(1, 'Customer A vs Support', 1, '2025-11-08 10:00:00', 'Issue with login functionality.', 'Open'),
(2, 'Client B vs Tech', 2, '2025-11-08 11:15:00', 'Requesting refund due to billing error.', 'In Progress'),
(3, 'User C vs Sales', 3, '2025-11-08 12:30:00', 'Inquiry about product features.', 'Closed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Database: `trc_memberships`
--
CREATE DATABASE IF NOT EXISTS `trc_memberships` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trc_memberships`;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `submitted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `dob`, `email`, `phone`, `submitted_at`) VALUES
(2, 'Emma', 'Taylor', '2025-11-06', 'quintontaylor29@gmail.com', '5555555555', '2025-11-19 23:23:55'),
(3, 'Emma', 'Taylor', '2025-11-06', 'quintontaylor29@gmail.com', '5555555555', '2025-11-19 23:24:32'),
(4, 'Emma', 'Taylor', '2025-11-20', 'quintontaylor29@gmail.com', '5555555555', '2025-11-19 23:25:41'),
(5, 'Emma', 'Taylor', '2025-11-20', 'quintontaylor29@gmail.com', '5555555555', '2025-11-19 23:26:46'),
(6, 'Emma', 'Taylor', '2025-11-05', 'quintontaylor29@gmail.com', '5555555555', '2025-11-19 23:27:22'),
(7, 'Emma', 'Taylor', '2025-11-20', 'quintontaylor29@gmail.com', '5555555555', '2025-11-19 23:28:28'),
(8, 'Emma', 'Taylor', '2025-11-20', 'quintontaylor29@gmail.com', '5555555555', '2025-11-19 23:47:11'),
(9, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:30:57'),
(10, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:39:25'),
(11, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:40:27'),
(12, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:41:26'),
(13, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:41:57'),
(14, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:45:25'),
(15, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:46:39'),
(16, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:49:38'),
(17, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:50:43'),
(18, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:52:58'),
(19, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:53:28'),
(20, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '5555555555', '2025-11-29 00:54:55'),
(21, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 00:56:39'),
(22, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 00:59:16'),
(23, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:02:26'),
(24, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:03:20'),
(25, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:04:40'),
(26, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:07:11'),
(27, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:10:10'),
(28, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:12:15'),
(29, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:13:43'),
(30, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:14:25'),
(31, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:15:02'),
(32, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:15:40'),
(33, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:19:13'),
(34, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:20:12'),
(35, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:22:35'),
(36, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:24:03'),
(37, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:26:18'),
(38, 'Emma', 'Taylor', '2025-11-27', 'quintont959@gmail.com', '3145034598', '2025-11-29 01:29:00'),
(39, 'Quinton ', 'Taylor', '2025-11-30', 'quintont@zax-online.com', '5555555555', '2025-11-29 18:36:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- Database: `trc_messages`
--
CREATE DATABASE IF NOT EXISTS `trc_messages` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trc_messages`;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `col1` varchar(255) DEFAULT NULL,
  `col2` varchar(255) DEFAULT NULL,
  `col3` varchar(255) DEFAULT NULL,
  `col4` varchar(255) DEFAULT NULL,
  `col5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `first_name`, `last_name`, `email`, `phone`, `message`, `submitted_at`, `col1`, `col2`, `col3`, `col4`, `col5`) VALUES
(70, 'Alice', 'Johnson', 'alice.johnson@example.com', '+1234567890', 'I would like more information about your services.', '2025-09-09 15:06:40', 'Value1', 'Value2', 'Value3', 'Value4', 'Value5'),
(71, 'Bob', 'Smith', 'bob.smith@example.com', '+1987654321', 'Can you provide a quote for a custom project?', '2025-09-09 15:06:40', NULL, 'DataB2', NULL, 'DataB4', NULL),
(72, 'Charlie', 'Brown', 'charlie.brown@example.com', NULL, 'Just testing the contact form functionality.', '2025-09-09 15:06:40', 'Extra1', NULL, 'Extra3', NULL, 'Extra5'),
(73, 'Quinton', 'Taylor', 'quintont@zax-online.com', '37485475443', 'hello', '2025-09-10 16:40:18', NULL, NULL, NULL, NULL, NULL),
(74, 'Quinton', 'Taylor', 'quintont@zax-online.com', '37485475443', 'hello', '2025-09-10 16:40:29', NULL, NULL, NULL, NULL, NULL),
(75, 'Quinton', 'Taylor', 'quintont@zax-online.com', '37485475443', 'hello', '2025-09-10 16:40:38', NULL, NULL, NULL, NULL, NULL),
(76, 'Quinton', 'Taylor', 'quintont@zax-online.com', '37485475443', 'hello', '2025-09-10 16:43:36', NULL, NULL, NULL, NULL, NULL),
(77, '', '', '', '', '', '2025-09-29 17:20:15', NULL, NULL, NULL, NULL, NULL),
(78, '', '', '', '', '', '2025-09-29 17:20:15', NULL, NULL, NULL, NULL, NULL),
(79, 'Quinton', 'Taylor', 'quintontaylor29@gmail.com', '5', 'ihouh', '2025-09-30 14:09:23', NULL, NULL, NULL, NULL, NULL),
(80, 'Quinton', 'Taylor', 'quintont@zax-online.com', '6', 'ljhljh', '2025-09-30 14:10:03', NULL, NULL, NULL, NULL, NULL),
(81, 'Quinton', 'Taylor', 'quintont959@gmail.com', '5', 'ljhljh', '2025-09-30 14:10:45', NULL, NULL, NULL, NULL, NULL),
(82, 'Quinton', 'Taylor', 'quintont@zax-online.com', '5', 'hello', '2025-09-30 14:12:59', NULL, NULL, NULL, NULL, NULL),
(83, 'Quinton', 'Taylor', 'quintontaylor29@gmail.com', '5', 'ljhljh', '2025-09-30 14:14:07', NULL, NULL, NULL, NULL, NULL),
(84, 'Quinton', 'Taylor', 'quintont959@gmail.com', '6', 'hello', '2025-09-30 14:14:34', NULL, NULL, NULL, NULL, NULL),
(85, 'Quinton', 'Taylor', 'quintont959@gmail.com', '5555555555', 'ljhljh', '2025-09-30 14:17:14', NULL, NULL, NULL, NULL, NULL),
(86, 'Quinton ', 'Taylor', 'quintontaylor29@gmail.com', '5555555555', 'hello', '2025-09-30 14:29:09', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customs`
--

CREATE TABLE `customs` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `services_requested` text DEFAULT NULL,
  `service_count` int(11) DEFAULT NULL,
  `meeting_date` char(10) DEFAULT NULL,
  `meeting_time` char(8) DEFAULT NULL,
  `design_info` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customs`
--

INSERT INTO `customs` (`id`, `first_name`, `last_name`, `file_path`, `email`, `phone`, `services_requested`, `service_count`, `meeting_date`, `meeting_time`, `design_info`, `submitted_at`) VALUES
(6, 'Emma', 'Williams', '/uploads/design1.pdf', 'emma.williams@example.com', '+1234567890', 'Website design, Logo creation', 2, '2025-09-15', '14:00:00', 'Client prefers minimalist style with blue accents.', '2025-09-09 15:08:34'),
(7, 'Liam', 'Johnson', NULL, 'liam.johnson@example.com', '+1987654321', 'Social media management', 1, '2025-09-18', '10:30:00', 'Focus on Instagram and TikTok campaigns.', '2025-09-09 15:08:34'),
(8, 'Sophia', 'Brown', '/uploads/branding_kit.zip', 'sophia.brown@example.com', NULL, 'Branding package, Business cards', 2, NULL, NULL, 'Use bold fonts and vibrant colors for branding.', '2025-09-09 15:08:34'),
(9, 'Quinton', 'Taylor', '[\"\\/uploads\\/Quinton_Taylor_20250909_1043_40537a75.jpg\"]', 'quintont@zax-online.com', '37485475443', 'sew', 4, '2025-09-10', '00:43', 'hekkoi', '2025-09-09 15:43:20'),
(10, '', '', '[]', '', '', '', 0, '', '', '', '2025-09-15 16:00:44'),
(11, '', '', '[]', '', '', '', 0, '', '', '', '2025-09-15 16:00:53'),
(12, '', '', '[]', '', '', '', 0, '', '', '', '2025-09-29 04:25:07'),
(13, 'Quinton', 'Taylor', '[\"\\/uploads\\/Quinton_Taylor_20250928_2325_1a812c13.jpg\"]', 'quintont@zax-online.com', '345756758654654', 'sew', 4, '2025-09-16', '23:29', 'hekkoi', '2025-09-29 04:25:41'),
(14, 'Quinton', 'Taylor', '[\"\\/uploads\\/Quinton_Taylor_20250928_2344_bb8a135a.jpg\"]', 'quintontaylor29@gmail.com', '345756758654654', 'sew', 4, '2025-09-19', '23:47', 'hekkoi', '2025-09-29 04:44:09'),
(15, 'Quinton', 'Taylor', '[\"\\/uploads\\/Quinton_Taylor_20250928_2344_efe7f308.jpg\"]', 'quintontaylor29@gmail.com', '345756758654654', 'sew', 4, '2025-09-19', '23:47', 'hekkoi', '2025-09-29 04:44:58'),
(16, 'Emma', 'Taylor', '[]', 'quintontaylor29@gmail.com', '5555555555', 'sew', 4, '2025-11-12', '23:14', 'fxcghzdgfgttchdtyh', '2025-11-20 05:11:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customs`
--
ALTER TABLE `customs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `customs`
--
ALTER TABLE `customs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Database: `trc_products`
--
CREATE DATABASE IF NOT EXISTS `trc_products` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trc_products`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` char(36) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `subtotal_amount` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `shipping_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `shipped` tinyint(1) NOT NULL DEFAULT 0,
  `shipping_name` varchar(100) NOT NULL,
  `shipping_phone` varchar(20) NOT NULL,
  `shipping_email` varchar(100) NOT NULL,
  `shipping_address` text NOT NULL,
  `shipping_city` varchar(100) NOT NULL,
  `shipping_state` varchar(100) NOT NULL,
  `shipping_zip` varchar(20) NOT NULL,
  `shipping_country` varchar(100) NOT NULL,
  `shipping_method` varchar(50) DEFAULT NULL,
  `tracking_number` varchar(100) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `sku`, `order_date`, `status`, `payment_status`, `payment_method`, `total_amount`, `subtotal_amount`, `tax_amount`, `shipping_amount`, `discount_amount`, `coupon_code`, `shipped`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `shipping_method`, `tracking_number`, `delivery_date`, `notes`, `updated_at`) VALUES
(17, NULL, '[\"TSHIRT-001-blue\",\"TSHIRT-001\"]', '2025-10-16 18:10:48', 'pending', 'paid', 'square', 79.98, 79.98, 0.00, 0.00, 0.00, 'not null', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', 'not null', 'not null', 'not null', 'not null', 'not null', 'not null', NULL, NULL, NULL, '2025-10-16 18:10:48'),
(18, NULL, '[\"TSHIRT-001-blue\",\"TSHIRT-001\"]', '2025-10-16 18:11:02', 'pending', 'paid', 'square', 79.98, 79.98, 0.00, 0.00, 0.00, 'not null', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', 'not null', 'not null', 'not null', 'not null', 'not null', 'not null', NULL, NULL, NULL, '2025-10-16 18:11:02'),
(19, NULL, '[\"TSHIRT-001-blue\",\"TSHIRT-001\"]', '2025-10-16 18:11:49', 'pending', 'paid', 'square', 79.98, 79.98, 0.00, 0.00, 0.00, 'not null', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', 'not null', 'not null', 'not null', 'not null', 'not null', 'not null', NULL, NULL, NULL, '2025-10-16 18:11:49'),
(20, NULL, '[\"TSHIRT-001-blue\",\"TSHIRT-001\"]', '2025-10-16 18:12:30', 'pending', 'paid', 'square', 79.98, 79.98, 0.00, 0.00, 0.00, 'not null', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', 'not null', 'not null', 'not null', 'not null', 'not null', 'not null', NULL, NULL, NULL, '2025-10-16 18:12:30'),
(21, NULL, '[\"TSHIRT-001-blue\",\"TSHIRT-001\"]', '2025-10-16 18:18:14', 'pending', 'paid', 'square', 79.98, 79.98, 0.00, 0.00, 0.00, 'not null', 0, 'quinton taylor', '5555555555', 'quintontaylor29@gmail.com', 'not null', 'not null', 'not null', 'not null', 'not null', 'not null', NULL, NULL, NULL, '2025-10-16 18:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Unique product ID',
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Description',
  `image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Image',
  `price` decimal(10,2) NOT NULL COMMENT 'Price',
  `currency` varchar(3) DEFAULT 'USD' COMMENT 'Currency code',
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Tags for searching and organizing',
  `stock` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '{   "XS": 0,   "S": 0,   "M": 0,   "L": 0,   "XL": 0,   "2XL": 0,   "3XL": 0 }',
  `sku` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Stock keeping unit',
  `time created` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Time created',
  `time updated` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Time updated',
  `visible/not visible` char(11) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `currency`, `tags`, `stock`, `sku`, `time created`, `time updated`, `visible/not visible`) VALUES
(6, 'Blue Denim Jacket', 'The “Truly HER” Tee features a bold front graphic of lips flashing a grill iced out with actual gemstone prints spelling TRULY RARE. On the back, a powerful illustration of a woman with an unapologetic stance ties the whole design together — a nod to culture, individuality, and confidence.\r\n\r\n\r\n\r\nSubtle yet elevated, the off-white colorway feels timeless and versatile. The slightly muted tone gives the gemstones and artwork a warmer, vintage-inspired finish while still keeping its modern streetwear edge.\r\n\r\n\r\n\r\nEach shirt is made to order and customized after purchase. Please allow 5–7 business days for production before shipping or pickup.\r\n\r\n\r\n\r\n✨ Details:\r\n\r\n• Premium 100% heavyweight cotton\r\n\r\n• Printed with high-definition artwork\r\n\r\n• Front: Gemstone “TRULY RARE” grills design\r\n\r\n• Back: Afro woman artwork with gold hoops & jewelry details\r\n\r\n• Fits slightly oversized with a structured feel\r\n\r\n• Limited edition release', '{ \"1\": \"assets\\\\\\\\denim.jpg\", \"2\": \"assets\\\\\\\\bwbanner.jpg\", \"3\": \"assets\\\\\\\\dlarge.jpg\", \"4\": \"assets\\\\\\\\logo1.png\", \"5\": \"assets\\\\\\\\logo2.png\", \"6\": \"assets\\\\\\\\paint.png\", \"7\": \"assets\\\\\\\\pinkGabs.png\" }', 5.99, 'USD', 'Custom designs', '{ \"XS\": 3, \"S\": 8, \"M\": 12, \"L\": 10, \"XL\": 6, \"2XL\": 4, \"3XL\": 0 }', 'TSHIRT-001-blue', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'yes'),
(7, 'Black Hoodie', 'Fleece-lined hoodie with adjustable drawstrings and kangaroo pocket.', '{\r\n  \"1\": \"assets\\\\dlarge.jpg\",\r\n  \"2\": \"assets\\\\paint.png\",\r\n  \"3\": \"assets\\\\logo1.png\",\r\n  \"4\": \"assets\\\\denim.jpg\",\r\n  \"5\": \"assets\\\\bwbanner.jpg\",\r\n  \"6\": \"assets\\\\pinkGabs.png\",\r\n  \"7\": \"assets\\\\logo2.png\"\r\n}\r\n', 39.99, 'USD', 'hoodie, sweatshirt, casual, black', '{ \"XS\": 5, \"S\": 12, \"M\": 20, \"L\": 18, \"XL\": 10, \"2XL\": 6, \"3XL\": 2 }', 'HOODIE-003', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'Yes'),
(8, 'upcoming event', 'have fun', '{\r\n  \"1\": \"assets\\\\paint.png\",\r\n  \"2\": \"assets\\\\logo2.png\",\r\n  \"3\": \"assets\\\\pinkGabs.png\",\r\n  \"4\": \"assets\\\\bwbanner.jpg\",\r\n  \"5\": \"assets\\\\dlarge.jpg\",\r\n  \"6\": \"assets\\\\denim.jpg\",\r\n  \"7\": \"assets\\\\logo1.png\"\r\n}\r\n', 49.99, 'USD', 'Event,', '{ \"XS\": 6, \"S\": 15, \"M\": 20, \"L\": 14, \"XL\": 8, \"2XL\": 3, \"3XL\": 1 }', 'DRESS-004', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'Yes'),
(9, 'Sneakers White', 'Comfortable everyday sneakers with rubber sole and breathable mesh.', '{\r\n  \"1\": \"assets\\\\bwbanner.jpg\",\r\n  \"2\": \"assets\\\\dlarge.jpg\",\r\n  \"3\": \"assets\\\\paint.png\",\r\n  \"4\": \"assets\\\\logo1.png\",\r\n  \"5\": \"assets\\\\denim.jpg\",\r\n  \"6\": \"assets\\\\logo2.png\",\r\n  \"7\": \"assets\\\\pinkGabs.png\"\r\n}\r\n', 74.99, 'USD', 'shoes, sneakers, footwear, white,Custom designs', '{ \"XS\": 0, \"S\": 0, \"M\": 25, \"L\": 30, \"XL\": 18, \"2XL\": 10, \"3XL\": 5 }', 'SHOES-SNEAKERS-005', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'Yes'),
(12, 'Custom Order', 'Custom Order', '', 20.00, 'USD', NULL, '{   \"XS\": 0,   \"S\": 0,   \"M\": 0,   \"L\": 0,   \"XL\": 0,   \"2XL\": 0,   \"3XL\": 0 }', 'custom-order-001', '2025-10-13 12:33:37', '2025-10-13 12:33:37', 'yes'),
(33, 'red shirt', 'red shirt', '[\"assets//redshirt.jpg\",\"assets//pexels-divinetechygirl-1181280.jpg\"]', 19.92, 'USD', 'tshirt, cotton, unisex, casual, cool', '{ \"XS\": 10, \"S\": 25, \"M\": 30, \"L\": 20, \"XL\": 15, \"2XL\": 5, \"3XL\": 2 }', 'TSHIRT-001-RED', '2025-11-10 16:19:13', '2025-11-10 16:19:13', 'yes'),
(34, 'upcoming event2', 'have fun', '{\r\n  \"1\": \"assets\\\\paint.png\",\r\n  \"2\": \"assets\\\\logo2.png\",\r\n  \"3\": \"assets\\\\pinkGabs.png\",\r\n  \"4\": \"assets\\\\bwbanner.jpg\",\r\n  \"5\": \"assets\\\\dlarge.jpg\",\r\n  \"6\": \"assets\\\\denim.jpg\",\r\n  \"7\": \"assets\\\\logo1.png\"\r\n}\r\n', 49.99, 'USD', 'Events,', '{ \"XS\": 6, \"S\": 15, \"M\": 20, \"L\": 14, \"XL\": 8, \"2XL\": 3, \"3XL\": 1 }', 'DRESS-004', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'Yes'),
(35, 'upcoming event2', 'have fun', '{\r\n  \"1\": \"assets\\\\paint.png\",\r\n  \"2\": \"assets\\\\logo2.png\",\r\n  \"3\": \"assets\\\\pinkGabs.png\",\r\n  \"4\": \"assets\\\\bwbanner.jpg\",\r\n  \"5\": \"assets\\\\dlarge.jpg\",\r\n  \"6\": \"assets\\\\denim.jpg\",\r\n  \"7\": \"assets\\\\logo1.png\"\r\n}\r\n', 49.99, 'USD', 'Events,', '{ \"XS\": 6, \"S\": 15, \"M\": 20, \"L\": 14, \"XL\": 8, \"2XL\": 3, \"3XL\": 1 }', 'DRESS-004', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'Yes'),
(36, 'upcoming event2', 'have fun', '{\r\n  \"1\": \"assets\\\\paint.png\",\r\n  \"2\": \"assets\\\\logo2.png\",\r\n  \"3\": \"assets\\\\pinkGabs.png\",\r\n  \"4\": \"assets\\\\bwbanner.jpg\",\r\n  \"5\": \"assets\\\\dlarge.jpg\",\r\n  \"6\": \"assets\\\\denim.jpg\",\r\n  \"7\": \"assets\\\\logo1.png\"\r\n}\r\n', 49.99, 'USD', 'Events,', '{ \"XS\": 6, \"S\": 15, \"M\": 20, \"L\": 14, \"XL\": 8, \"2XL\": 3, \"3XL\": 1 }', 'DRESS-004', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'Yes'),
(37, 'upcoming event2', 'have fun', '{\r\n  \"1\": \"assets\\\\paint.png\",\r\n  \"2\": \"assets\\\\logo2.png\",\r\n  \"3\": \"assets\\\\pinkGabs.png\",\r\n  \"4\": \"assets\\\\bwbanner.jpg\",\r\n  \"5\": \"assets\\\\dlarge.jpg\",\r\n  \"6\": \"assets\\\\denim.jpg\",\r\n  \"7\": \"assets\\\\logo1.png\"\r\n}\r\n', 49.99, 'USD', 'Events,', '{ \"XS\": 6, \"S\": 15, \"M\": 20, \"L\": 14, \"XL\": 8, \"2XL\": 3, \"3XL\": 1 }', 'DRESS-004', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'Yes'),
(38, 'Memberships', 'Memberships', '', 20.00, 'USD', NULL, '{   \"XS\": 0,   \"S\": 0,   \"M\": 0,   \"L\": 0,   \"XL\": 0,   \"2XL\": 0,   \"3XL\": 0 }', 'membership-order-001', '2025-10-13 12:33:37', '2025-10-13 12:33:37', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique product ID', AUTO_INCREMENT=39;
--
-- Database: `trc_site`
--
CREATE DATABASE IF NOT EXISTS `trc_site` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trc_site`;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(7) NOT NULL,
  `exp` date NOT NULL,
  `percent` int(3) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `code`, `exp`, `percent`, `amount`) VALUES
(1, 'test', '5468', '2026-02-12', 50, NULL),
(3, 'test 2', '65428', '2026-01-16', NULL, 20.00),
(4, 'test3', 'sdf458', '2025-12-27', 50, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `headers`
--

CREATE TABLE `headers` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Page` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `headers`
--

INSERT INTO `headers` (`id`, `Name`, `Page`) VALUES
(1, 'Truly Rare Collection', 'index'),
(2, 'Events', 'index'),
(3, 'Off The Rack Gear', 'shop'),
(4, 'Custom Designs', 'shop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headers`
--
ALTER TABLE `headers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `headers`
--
ALTER TABLE `headers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Database: `trc_users`
--
CREATE DATABASE IF NOT EXISTS `trc_users` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trc_users`;

-- --------------------------------------------------------

--
-- Table structure for table `internal_users`
--

CREATE TABLE `internal_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `department` varchar(100) NOT NULL,
  `permissions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `internal_users`
--

INSERT INTO `internal_users` (`id`, `username`, `password_hash`, `role`, `full_name`, `email`, `status`, `created_at`, `department`, `permissions`) VALUES
(2, 'Gwilliams', '$2a$12$rRCnMzXFfhpLnWTdLxZ6Au7wy0gm.Dr4nGj7GR13FOWWmwVzhlGS6', 'user', 'Gabrielle Williams', 'trulyrarecustoms@gmail.com', 'active', '2025-09-08 16:28:16', '', '{\"products\":1,\"messages\":1,\"site\":1,\"users\":1,\"orders\":1,\"discounts\":1}');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `mode` varchar(20) DEFAULT 'auto',
  `user_email` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `expires_at` datetime DEFAULT NULL,
  `used` tinyint(1) DEFAULT 0,
  `used_at` datetime DEFAULT NULL,
  `used_ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `purpose`, `mode`, `user_email`, `created_at`, `expires_at`, `used`, `used_at`, `used_ip`) VALUES
(253, '726b86f04e760c361e6149628627b0b77335e2b5c0d1e09514cbc960a25df86a', 'login', 'timed', 'user@email.com', '2025-09-08 11:52:09', '2025-09-08 12:07:09', 0, NULL, '::1'),
(254, 'c30d19f2ec5118c0e2fc0bc21ac985119f51e3862806767f4f64a75f1f3a09d5', 'login', 'timed', 'user@email.com', '2025-09-08 11:57:16', '2025-09-08 12:12:16', 0, NULL, '::1'),
(255, 'a76738c26ee9215cffa8e310248c61b4f225e21ca87db29177dab7be48a24a0f', 'login', 'timed', 'user@email.com', '2025-09-08 13:24:59', '2025-09-08 13:39:59', 0, NULL, '::1'),
(256, 'eaa5412a900d2a042feba41e12d5a39b3afbf6b85a3945054a72dd35dc5ca9a3', 'login', 'timed', 'user@email.com', '2025-09-09 10:09:26', '2025-09-09 10:24:26', 0, NULL, '::1'),
(257, 'ff3683e8b4e05dae35dd6f1b7b2e0f60d44bb9b09561f8f308d4b3a4e706dba8', 'login', 'timed', 'user@email.com', '2025-09-09 10:13:02', '2025-09-09 10:28:02', 0, NULL, '::1'),
(258, '781ffa688da84d0a5c13a02edb07ddd4457f55d6fb6ccc0c2f6be3e47def3614', 'login', 'timed', 'user@email.com', '2025-09-09 10:21:08', '2025-09-09 10:36:08', 0, NULL, '::1'),
(259, '6ec6e732dccd94c06787883434f610db9d6cf41fb77cada6cc28ed507d8a1efb', 'login', 'timed', 'user@email.com', '2025-09-09 10:46:40', '2025-09-09 11:01:40', 0, NULL, '::1'),
(260, '92b1a543a5b978d2d2631588f91a7a86b1ee06898abf26bf7967e296fa654ad2', 'login', 'timed', 'user@email.com', '2025-09-10 11:19:39', '2025-09-10 11:34:39', 0, NULL, '::1'),
(261, '492b9dc900a6cd7532b331e0e5ad5ae2e80dfec89f045611fd839dd1c6266620', 'login', 'timed', 'user@email.com', '2025-09-10 11:19:47', '2025-09-10 11:34:47', 0, NULL, '::1'),
(262, 'cb951c333c85aeb7f23def9cda323a4942a62d80bd9c295b61d74e4e97ad0c9f', 'login', 'timed', 'user@email.com', '2025-09-10 11:31:07', '2025-09-10 11:46:07', 0, NULL, '::1'),
(263, '534e2c7c5b01baaf09ed320987f34330f027226061acb81e7fc72b518643122f', 'login', 'timed', 'user@email.com', '2025-09-10 11:31:21', '2025-09-10 11:46:21', 0, NULL, '::1'),
(264, 'be82a33024255931bde85f18a2ca52ab15f8b31b7ca3c1d9dc510669182d6d6e', 'login', 'timed', 'user@email.com', '2025-09-10 11:39:20', '2025-09-10 11:54:20', 0, NULL, '::1'),
(265, '656f2b2c66431ae344ae27b14bae5b0352e33707ae6e7addcab548284f491192', 'login', 'timed', 'user@email.com', '2025-09-11 10:00:28', '2025-09-11 10:15:28', 0, NULL, '::1'),
(266, 'e09ee136d45501fa90c382eae3cabd5ad1dedd2fdb06975f225250e2cd1e60ae', 'login', 'timed', 'user@email.com', '2025-09-11 10:02:24', '2025-09-11 10:17:24', 0, NULL, '::1'),
(267, '2ac4baca43b67c7fcbe79342d2ab2bbccc86bf9c728bce08528420fee6b70a7a', 'login', 'timed', 'user@email.com', '2025-09-11 10:15:20', '2025-09-11 10:30:20', 0, NULL, '::1'),
(268, 'bdbe4b7739b5cd343c8bdcada21faadad0b62fbcccfc1f15577d57c5bc008be2', 'login', 'timed', 'user@email.com', '2025-09-11 10:22:28', '2025-09-11 10:37:28', 0, NULL, '::1'),
(269, '963868862215153b5c6554dd597aa2e866b1b850fec0f9ee055ec6541cef1edc', 'login', 'timed', 'user@email.com', '2025-09-11 10:34:52', '2025-09-11 10:49:52', 0, NULL, '::1'),
(270, '7305aea25b923d2352b8667b31da7e7a907d4a60de5273def4a48160f4c5c3d5', 'login', 'timed', 'user@email.com', '2025-09-11 10:35:28', '2025-09-11 10:50:28', 0, NULL, '::1'),
(271, 'f487809464da0006994c5c68a316cd7dd57c83e4e8d3937873655bc16c1f7948', 'login', 'timed', 'user@email.com', '2025-09-11 10:36:04', '2025-09-11 10:51:04', 0, NULL, '::1'),
(272, '0b5c464902ea5bc7a5ea932346684c18ee1de5936ba83c36a697e947761866d3', 'login', 'timed', 'user@email.com', '2025-09-11 10:36:40', '2025-09-11 10:51:40', 0, NULL, '::1'),
(273, '907595fd6a0724b588216e688ca3bda792fcd362018691669c55eecdf3178d1c', 'login', 'timed', 'user@email.com', '2025-09-11 10:39:08', '2025-09-11 10:54:08', 0, NULL, '::1'),
(274, 'e4ead20bcdcebf1baa0d52ebd88e635a0aba1916750c9ea3374f92fb4cf2f4c5', 'login', 'timed', 'user@email.com', '2025-09-11 10:39:57', '2025-09-11 10:54:57', 0, NULL, '::1'),
(275, 'a7de4e5159f314ccaa05fd34bb9c521b24ee4a35561496d86c6e759d2107646c', 'login', 'timed', 'user@email.com', '2025-09-11 10:40:47', '2025-09-11 10:55:47', 0, NULL, '::1'),
(276, '8f8aceb96d76c4f1bf9bdd0b549b6ccfa08ebeced3ee78483e2c838515a9c6f3', 'login', 'timed', 'user@email.com', '2025-09-11 10:42:07', '2025-09-11 10:57:07', 0, NULL, '::1'),
(277, '973bc924163b89017708767b5fdaf294e54fbe045e26b196dfa3a09c3fa4dd93', 'login', 'timed', 'user@email.com', '2025-09-11 11:07:23', '2025-09-11 11:22:23', 0, NULL, '::1'),
(278, '581595b396a944b20fe41a3b870e7d2832f4c08b45176958565bc158614c9782', 'login', 'timed', 'user@email.com', '2025-09-11 11:56:43', '2025-09-11 12:11:43', 0, NULL, '::1'),
(279, '6d1f26f9bef62570a3ebb1bd01991fe26614ac52da0e355dd22be658c04ffdee', 'login', 'timed', 'user@email.com', '2025-09-11 11:58:53', '2025-09-11 12:13:53', 0, NULL, '::1'),
(280, '12e3d76928f502d04b413d3c3e237e9bcb5061eb0d8d06febd67d6e459abc01d', 'login', 'timed', 'user@email.com', '2025-09-11 12:44:14', '2025-09-11 12:59:14', 0, NULL, '::1'),
(281, 'd99a0069b2e7430f9375dd4413f1778db5faa2d23aea6df681520e94720ecab9', 'login', 'timed', 'user@email.com', '2025-09-11 12:49:26', '2025-09-11 13:04:26', 0, NULL, '::1'),
(282, '50ae2b46d71850cf7dcb038caf9ba1799c89ac890ae542fe8baa862a087d2746', 'login', 'timed', 'user@email.com', '2025-09-15 09:41:22', '2025-09-15 09:56:22', 0, NULL, '::1'),
(283, 'f774b2a18d43a9e8dd0d62f644bafa97d25fc855bc10cef3f64182f4a9c7c8e1', 'login', 'timed', 'user@email.com', '2025-09-30 11:59:21', '2025-09-30 12:14:21', 0, NULL, '::1'),
(284, 'c0d431d45577b41975706174eb0e9ac7367e6b883447bd63ffbfdd1cdbf61d3c', 'login', 'timed', 'user@email.com', '2025-09-30 12:00:31', '2025-09-30 12:15:31', 0, NULL, '::1'),
(285, '838026b4b6c188b407c62846e90e830bd2301407437cac4765656dbb64f8f76c', 'login', 'timed', 'user@email.com', '2025-09-30 12:00:42', '2025-09-30 12:15:42', 0, NULL, '::1'),
(286, 'b588bb244347de7107437343b481a48e0728e3b38a1fc31d80f5412c425b7f81', 'login', 'timed', 'user@email.com', '2025-09-30 12:00:56', '2025-09-30 12:15:56', 0, NULL, '::1'),
(287, '50e4c3372133520f46b34cb48e9f9e43ceea2557952f01e6c5fd3d0cf768a62d', 'login', 'timed', 'user@email.com', '2025-09-30 12:01:10', '2025-09-30 12:16:10', 0, NULL, '::1'),
(288, 'a91562dc3ed3c9760f4f91c8f38d5e1f1c1bb41202e98848481af2bc2b22ff29', 'login', 'timed', 'user@email.com', '2025-10-06 11:14:59', '2025-10-06 11:29:59', 0, NULL, '::1'),
(289, '98ef8772783831f0e5072c8c7a633afae2cdc0ff237f55bcec0201af0f22723e', 'login', 'timed', 'user@email.com', '2025-10-06 11:16:12', '2025-10-06 11:31:12', 0, NULL, '::1'),
(290, '541069fe729199e5f5926a934af49a010a3d2f3b2b9d5aaa7c8121f6551e93d1', 'login', 'timed', 'user@email.com', '2025-10-06 11:16:20', '2025-10-06 11:31:20', 0, NULL, '::1'),
(291, 'e8f2da753159f6bc2abc783d1a38d4ecce58bcf9c55402112c8403af10b5064a', 'login', 'timed', 'user@email.com', '2025-10-06 11:16:40', '2025-10-06 11:31:40', 0, NULL, '::1'),
(292, 'cad852b39daf39d20afcbc1e68308f34545643112f70c374df2dffe5773ff7a9', 'login', 'timed', 'user@email.com', '2025-10-06 11:16:44', '2025-10-06 11:31:44', 0, NULL, '::1'),
(293, 'ecd979ad6051c017381f26fc78feb522a48370ea1b6fe44eb5a2f2b5bb3a786b', 'login', 'timed', 'user@email.com', '2025-10-06 13:45:08', '2025-10-06 14:00:08', 0, NULL, '::1'),
(294, '8f2ea859f4d126d7fa7c2f83c16e7553684c42de4ebf76de0e633885268af3d6', 'login', 'timed', 'user@email.com', '2025-10-06 13:54:47', '2025-10-06 14:09:47', 0, NULL, '::1'),
(295, 'fed06e4ec76958a1f701caaebf8c0a7e3f5e0c431bedc33e909c237ecc8b1476', 'login', 'timed', 'user@email.com', '2025-10-20 12:08:52', '2025-10-20 12:23:52', 0, NULL, '::1'),
(296, '394c5c48bc8810b698a45f2e45cda01e0dbff3a42886b953d30e96c58c417858', 'login', 'timed', 'user@email.com', '2025-10-20 12:21:05', '2025-10-20 12:36:05', 0, NULL, '::1'),
(297, '3858aa0b7218d565cc350b47c365e3693ba1c07823375889e79759a43cf481f9', 'login', 'timed', 'user@email.com', '2025-10-20 12:23:33', '2025-10-20 12:38:33', 0, NULL, '::1'),
(298, 'c9fb5251326fddd6eaaf22b9ecfec366a0e641e16d070bf00ff8b7b859cd128d', 'login', 'timed', 'user@email.com', '2025-10-20 12:27:33', '2025-10-20 12:42:33', 0, NULL, '::1'),
(299, 'c7ce5b7b62882de9e70113e7692059551cc78010bc5b6b564877a884adb2afbc', 'login', 'timed', 'user@email.com', '2025-10-20 12:42:31', '2025-10-20 12:57:31', 0, NULL, '::1'),
(300, '644049b53c1cd024a1bcef2d291034073d744b1ec00f202057400678f4cf2c0f', 'login', 'timed', 'user@email.com', '2025-10-20 13:16:15', '2025-10-20 13:31:15', 0, NULL, '::1'),
(301, '126f94611e5d5c8f9e2e12a29d17a9bc4e38c1e65d6547a65b82b7d12c758614', 'login', 'timed', 'user@email.com', '2025-10-20 13:18:07', '2025-10-20 13:33:07', 0, NULL, '::1'),
(302, 'e1de16219cf3f213383518db3f35f2540d034757a75a94fae8bff85a1c4f913c', 'login', 'timed', 'user@email.com', '2025-10-20 13:53:52', '2025-10-20 14:08:52', 0, NULL, '::1'),
(303, '5d2f9487d4cea130a199917482a49e1a9ab993483085708ba06981ba31db0cd2', 'login', 'timed', 'user@email.com', '2025-10-23 13:28:30', '2025-10-23 13:43:30', 0, NULL, '::1'),
(304, 'd6dbd00fcc33caabedb08361a09f92a72e46b0ef61d600894b33499b7c45ac25', 'login', 'timed', 'user@email.com', '2025-10-23 13:32:08', '2025-10-23 13:47:08', 0, NULL, '::1'),
(305, 'acb4bc4e37ac0be6a8e879fc0bd6f01fa5228c1841884c6fb39200a9bef3eb00', 'login', 'timed', 'user@email.com', '2025-10-31 01:02:18', '2025-10-31 01:17:18', 0, NULL, '::1'),
(306, '11dc53d0d917d98c8a219c9a4bb870f0752762b31d27a7c4ffad51007c397aa9', 'login', 'timed', 'user@email.com', '2025-11-03 10:03:48', '2025-11-03 10:18:48', 0, NULL, '::1'),
(307, 'e04d5656c6dcf38cc2d8df399170f58007dad3bbd7ff5a3378963090682d9b53', 'login', 'timed', 'user@email.com', '2025-11-03 10:08:30', '2025-11-03 10:23:30', 0, NULL, '::1'),
(308, '80b875b75c7a5c4c1e695e0c06d4c8499e11eb80108aebf246d3dea9554edb67', 'login', 'timed', 'user@email.com', '2025-11-03 10:13:14', '2025-11-03 10:28:14', 0, NULL, '::1'),
(309, 'a5ad307ace8ea3ac1d599f1508d347d40874cacd661b3d656d98081442b4f219', 'login', 'timed', 'user@email.com', '2025-11-03 10:20:19', '2025-11-03 10:35:19', 0, NULL, '::1'),
(310, '5429df6a4e31995a9d8d0bc2ac3c734ae9e3f6a3b7e60591006d1dde2904a473', 'login', 'timed', 'user@email.com', '2025-11-03 10:22:36', '2025-11-03 10:37:36', 0, NULL, '::1'),
(311, '168fb011585a2b56f5d752665cf4eaeef423947380487de828006cee41e29473', 'login', 'timed', 'user@email.com', '2025-11-03 10:24:56', '2025-11-03 10:39:56', 0, NULL, '::1'),
(312, '40f7720fa669d2a2e771f50fe2e6717479e514b8bd144e96f44272f00cf3f0dd', 'login', 'timed', 'user@email.com', '2025-11-03 10:28:23', '2025-11-03 10:43:23', 0, NULL, '::1'),
(313, 'ae1e016172141e70f2aa238c3c249e04c6edebc56dac78211f06277151675f4c', 'login', 'timed', 'user@email.com', '2025-11-03 10:31:48', '2025-11-03 10:46:48', 0, NULL, '::1'),
(314, '5d1874c491752bf1e242d52652d37e3c2582dc29c0995815de1ea83437cdd8f1', 'login', 'timed', 'user@email.com', '2025-11-03 10:35:01', '2025-11-03 10:50:01', 0, NULL, '::1'),
(315, 'd42ba85ed3419b7d8b16d99204eeccc42bd1892dafe8b50efefd3355ccac1ff7', 'login', 'timed', 'user@email.com', '2025-11-03 10:39:28', '2025-11-03 10:54:28', 0, NULL, '::1'),
(316, 'f4bd4df5ca027b40d57780cabb707f951c74929c8c4f6cef7b7d8a89594fb41c', 'login', 'timed', 'user@email.com', '2025-11-03 10:39:45', '2025-11-03 10:54:45', 0, NULL, '::1'),
(317, '87d7096d8355f5b1e1986a20a30c2eae300e909124f0e8b1807b5bdfd7e2428e', 'login', 'timed', 'user@email.com', '2025-11-03 10:56:20', '2025-11-03 11:11:20', 0, NULL, '::1'),
(318, '3aa0f2e2e11849516bb2ff2031ef8396ed84b3f9c8bd998b53a553c60b23d722', 'login', 'timed', 'user@email.com', '2025-11-03 13:43:57', '2025-11-03 13:58:57', 0, NULL, '::1'),
(319, '8cdac2113f09644d2bbe39db786004c5dbd22969e0357e3ee942ba3a02ac751d', 'login', 'timed', 'user@email.com', '2025-11-09 23:33:20', '2025-11-09 23:48:20', 0, NULL, '::1'),
(320, 'a7aa1416821e2a2518157398079bf7c3d553ef11b5e4202f9c5f693d2311693e', 'login', 'timed', 'user@email.com', '2025-11-09 23:39:35', '2025-11-09 23:54:35', 0, NULL, '::1'),
(321, '9519f3b5ef0a6eb7d8a545e16d6ffb372963ffbe6cae05e8d5aa83be9592a293', 'login', 'timed', 'user@email.com', '2025-11-09 23:43:23', '2025-11-09 23:58:23', 0, NULL, '::1'),
(322, '66343092a649ea889a2fffb0a3a0ac06c7b2587d75d7531a8c2c3088216cdf72', 'login', 'timed', 'user@email.com', '2025-11-09 23:46:25', '2025-11-10 00:01:25', 0, NULL, '::1'),
(323, 'f785766715f1b7bd6dca49c5acd9122f22374c3d56b7b6aae734cec2228b7a47', 'login', 'timed', 'user@email.com', '2025-11-09 23:49:15', '2025-11-10 00:04:15', 0, NULL, '::1'),
(324, 'dedbb28600b11d6119a56376965f0b44da786adda2b371fe302eecb76c20ed23', 'login', 'timed', 'user@email.com', '2025-11-09 23:51:39', '2025-11-10 00:06:39', 0, NULL, '::1'),
(325, '8f0bd6b3a2af829c8415ac5701476924438ea023969cd8c7d98fbb02c55c3a83', 'login', 'timed', 'user@email.com', '2025-11-09 23:54:10', '2025-11-10 00:09:10', 0, NULL, '::1'),
(326, 'bd2cf03e4a16b32f721aefc70141d7d66b8f844ecd4f607b66c0517afb90bff9', 'login', 'timed', 'user@email.com', '2025-11-09 23:56:50', '2025-11-10 00:11:50', 0, NULL, '::1'),
(327, 'bc3ed19fe906f15cade61bc3eb6992c95cf59491cd014469083d7fb29377682d', 'login', 'timed', 'user@email.com', '2025-11-10 00:02:34', '2025-11-10 00:17:34', 0, NULL, '::1'),
(328, '966d5c9b1c6de70f0b05ec003eec25c7e5b5bd42bda108d0ba593ab1c95a0632', 'login', 'timed', 'user@email.com', '2025-11-10 00:05:09', '2025-11-10 00:20:09', 0, NULL, '::1'),
(329, '963faa5453a1bbdda8e78a389ee626ffaf8b4bb463ea002927bbdfba445e3f09', 'login', 'timed', 'user@email.com', '2025-11-10 00:08:17', '2025-11-10 00:23:17', 0, NULL, '::1'),
(330, 'd9d629c6f9f3ccb2676e72ada27e5768a5f4d607aa563142b883f31cf9ca9cd7', 'login', 'timed', 'user@email.com', '2025-11-10 00:19:44', '2025-11-10 00:34:44', 0, NULL, '::1'),
(331, '266784183106841b8edd429e7eb275822b34d0c713684d2efb9337ef02258eb6', 'login', 'timed', 'user@email.com', '2025-11-10 00:24:15', '2025-11-10 00:39:15', 0, NULL, '::1'),
(332, '63f52d1f6ccd674d199a70faa2bf3dce0f63b8a43c151987c7660bef3ec2d647', 'login', 'timed', 'user@email.com', '2025-11-10 00:26:27', '2025-11-10 00:41:27', 0, NULL, '::1'),
(333, '857ad53b7fb7ce2d2e4a904ca829b0d7ca575a6f9a3f8234cb4df6efe1cb4486', 'login', 'timed', 'user@email.com', '2025-11-10 00:51:39', '2025-11-10 01:06:39', 0, NULL, '::1'),
(334, '91a031e05d7f6520f209fce8265b12c21f676001bf11f1a6d964d2e5f6babc08', 'login', 'timed', 'user@email.com', '2025-11-10 00:53:56', '2025-11-10 01:08:56', 0, NULL, '::1'),
(335, '7dc06503d4922605a362f97768abc3bbb0d287f4d8af5fcbed90be810e8a35ae', 'login', 'timed', 'user@email.com', '2025-11-10 01:00:18', '2025-11-10 01:15:18', 0, NULL, '::1'),
(336, '3f1861fd7936c5fd26db1162fa1f3525bb426220be0d686f5967c31615916af4', 'login', 'timed', 'user@email.com', '2025-11-10 14:54:28', '2025-11-10 15:09:28', 0, NULL, '::1'),
(337, 'a9d34e3833aeb65b1b709d2666b71c90e406917cd5360b0643e98f594d19d0c8', 'login', 'timed', 'user@email.com', '2025-11-10 14:56:51', '2025-11-10 15:11:51', 0, NULL, '::1'),
(338, 'd58a82e263d0ec839153a91e4f35e2b43d6122f4b0837903eec2b3481ef44c5e', 'login', 'timed', 'user@email.com', '2025-11-10 15:00:32', '2025-11-10 15:15:32', 0, NULL, '::1'),
(339, '668a7262cf8b6c2807dd1701fea7fb7b470b283c2ff2837abbb3023e38190759', 'login', 'timed', 'user@email.com', '2025-11-10 15:02:48', '2025-11-10 15:17:48', 0, NULL, '::1'),
(340, '96c7e6d3f74931cd4c54c9fb6bc946443c77adf7a12a0a01605d8417a2b6035a', 'login', 'timed', 'user@email.com', '2025-11-10 15:05:04', '2025-11-10 15:20:04', 0, NULL, '::1'),
(341, '3dc7246ce970efc55fbb5719d502e24b35424ddd0c3f8504b48aa7096a553b73', 'login', 'timed', 'user@email.com', '2025-11-10 15:21:43', '2025-11-10 15:36:43', 0, NULL, '::1'),
(342, '46087f7ccd34a204fdc45e4d6ed43b9c1ce14327bcc36249f3d0fe833ecaf627', 'login', 'timed', 'user@email.com', '2025-11-10 15:26:49', '2025-11-10 15:41:49', 0, NULL, '::1'),
(343, '63c229196be892399a929ce3b29c6f83a0391f46bebe21d6b0ac2385cee73872', 'login', 'timed', 'user@email.com', '2025-11-10 15:34:45', '2025-11-10 15:49:45', 0, NULL, '::1'),
(344, '96c057a0151883880086180772d6e3a1bed6226d58d3332c9c3841b23bf0334c', 'login', 'timed', 'user@email.com', '2025-11-10 15:37:16', '2025-11-10 15:52:16', 0, NULL, '::1'),
(345, '0a1ae356c5370a8ef6974ef91a9c53b8c8b04fc3504dddfc1ee6dea32df77366', 'login', 'timed', 'user@email.com', '2025-11-10 15:44:19', '2025-11-10 15:59:19', 0, NULL, '::1'),
(346, '486c5d51aa649d1555c78742b82f1fbce6c62d86a68c971f200fd1858e0a72d1', 'login', 'timed', 'user@email.com', '2025-11-10 15:46:56', '2025-11-10 16:01:56', 0, NULL, '::1'),
(347, '54333bfa405d3d827aacee34f64968d26046f12d0eea783cf5c5f6294255924b', 'login', 'timed', 'user@email.com', '2025-11-10 15:57:50', '2025-11-10 16:12:50', 0, NULL, '::1'),
(348, 'f5f04cb713269d88c7efc11728f323e3c2dcb3a0379905e8bf774fe1840415a3', 'login', 'timed', 'user@email.com', '2025-11-10 16:00:28', '2025-11-10 16:15:28', 0, NULL, '::1'),
(349, '36b543857ccf9dea5690477e4d2104993483a9d34a4ede4a8050a5835f84e3d7', 'login', 'timed', 'user@email.com', '2025-11-10 16:04:54', '2025-11-10 16:19:54', 0, NULL, '::1'),
(350, 'aefd6a0bc35f4701f7f2a610beb60ada76e7946a291204f45e11be562b4e5388', 'login', 'timed', 'user@email.com', '2025-11-10 16:06:55', '2025-11-10 16:21:55', 0, NULL, '::1'),
(351, 'f1f301582778b7cb98405e750a5b9d1b402eca412d6bb4ae55ea0f35d4854ba3', 'login', 'timed', 'user@email.com', '2025-11-10 16:15:51', '2025-11-10 16:30:51', 0, NULL, '::1'),
(352, 'e3ae1846b8d952fdd94ad3fbc4d161f18a234506c5d435d8528305d3e4c42997', 'login', 'timed', 'user@email.com', '2025-11-10 16:18:45', '2025-11-10 16:33:45', 0, NULL, '::1'),
(353, '326a3a74cadbb9d677817557aadb4b7f9ebc2922f33bcfd6e2ecbd0194fd7f96', 'login', 'timed', 'user@email.com', '2025-11-10 16:26:55', '2025-11-10 16:41:55', 0, NULL, '::1'),
(354, '6e19008a1f215b9895bc0763f89af072cbe30ac5451f7252b39c1d365e644a95', 'login', 'timed', 'user@email.com', '2025-11-10 16:31:38', '2025-11-10 16:46:38', 0, NULL, '::1'),
(355, '51b2ec98f0aee8be7f6252007116661cb8015c69d6239a2fd71056351d665b56', 'login', 'timed', 'user@email.com', '2025-11-10 16:38:53', '2025-11-10 16:53:53', 0, NULL, '::1'),
(356, '5ad4ef82368a5e139e059bc113d0a1ea47855ca0dbcbe63fdb47f62d1e14fcf7', 'login', 'timed', 'user@email.com', '2025-11-10 16:52:16', '2025-11-10 17:07:16', 0, NULL, '::1'),
(357, '480817527392fe68e1693ee3fe403b72f938e82d090616efe51ed61062b8b73c', 'login', 'timed', 'user@email.com', '2025-11-13 18:28:45', '2025-11-13 18:43:45', 0, NULL, '::1'),
(358, '5f68d591a486dc331edb8e6df724f8249ecfb5af82f776e17e45bbcf885f42b7', 'login', 'timed', 'user@email.com', '2025-11-13 18:29:28', '2025-11-13 18:44:28', 0, NULL, '::1'),
(359, '839ca138410418cbff3c5095c8d5b12aa44b2a5d0dd6305b5f68518afd68e443', 'login', 'timed', 'user@email.com', '2025-11-13 18:32:45', '2025-11-13 18:47:45', 0, NULL, '::1'),
(360, 'e51011b616914d3790324c6ff6fd2ffea43d5047226780542d6df10e684210f6', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-13 19:19:41', '2025-11-13 19:34:41', 0, NULL, '::1'),
(361, '99d9a64cf3eb7eee51a2ba4a18a6942c651515a8b4d48f3fb7f8aa38ea991133', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-13 19:21:37', '2025-11-13 19:36:37', 0, NULL, '::1'),
(362, 'a0ab17951c938a507f002df6e83d59d6ebabfbcb637dfe443dd929303d45d129', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-13 19:25:16', '2025-11-13 19:40:16', 0, NULL, '::1'),
(363, '33a9ff6df4d1dea86ec127fc6ebc29f05cd535080021d43ca4309bec8ce8b18b', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-15 00:21:45', '2025-11-15 00:36:45', 0, NULL, '::1'),
(364, 'c262687781915f2f8a8893550713733a8abffa39c24bcf0d1f55595798a2a62e', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-15 00:23:24', '2025-11-15 00:38:24', 0, NULL, '::1'),
(365, 'd1028d92dae66bd89a5bd7235351da04de9a3029367b031e4086198a20bc0acd', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-15 00:26:14', '2025-11-15 00:41:14', 0, NULL, '::1'),
(366, 'fc6dbb0c0a91c06a42134cdfaf6fe881a2aa72e8b213013ef83968529a9599dc', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-18 22:28:56', '2025-11-18 22:43:56', 0, NULL, '::1'),
(367, 'd987d383ddc33d99d7d4d72042d1eb6b9674bb0067d551f715fda084fbd50ea6', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-18 22:41:34', '2025-11-18 22:56:34', 0, NULL, '::1'),
(368, 'd2fec84f9005c83fc275feeb41d69c8d9138a87ab0c619700607a0615c637b82', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-18 22:45:19', '2025-11-18 23:00:19', 0, NULL, '::1'),
(369, '0ec00c8c3ee647d84cfbfcb1b4d294a9cf3c9674731887c3534502efe2a34bef', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-18 22:47:34', '2025-11-18 23:02:34', 0, NULL, '::1'),
(370, '463893d00f603c841a4bf8055e75da8c48c92079ae5c84bc11e2a959740e94fd', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-18 22:51:59', '2025-11-18 23:06:59', 0, NULL, '::1'),
(371, 'f6908897d9acb74b91b7ef52fc917fdae2a6971a4b5f0f399f4e6ac1e350fa14', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-18 22:55:07', '2025-11-18 23:10:07', 0, NULL, '::1'),
(372, 'fe41e7c6bcbaf78ec0973b56b45d54abde7f13559f7727584d1a58b13317d4b6', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-18 23:00:50', '2025-11-18 23:15:50', 0, NULL, '::1'),
(373, 'd466b37e0f2a17cf5a814d330664482618067279a33e7d6daab7223e763ede55', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-18 23:08:03', '2025-11-18 23:23:03', 0, NULL, '::1'),
(374, '061dac2146051d391691aada293ef12ff97b3ea450acb04d4458560398db36e8', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-18 23:10:54', '2025-11-18 23:25:54', 0, NULL, '::1'),
(375, 'd3b98c6d2a133b3acbc0a465cbbeea152059d2f6b941b549956bdf06597a13c9', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-11-18 23:13:06', '2025-11-18 23:28:06', 0, NULL, '::1'),
(376, '591445bb402b6b61dc5815d8ac1e7cf55deb49f48416709b77c61ae175206b9d', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 21:01:25', '2025-12-01 21:16:25', 0, NULL, '::1'),
(377, '271a17a82782a19092ff3384d506acf31d70a86a31f44c6b1f1d20821724838c', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 21:14:04', '2025-12-01 21:29:04', 0, NULL, '::1'),
(378, 'eb0a957fd76f6d403ef49eb4686644ee16e2c8f6628d22cd9fef16fb1efcc0d3', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 21:16:27', '2025-12-01 21:31:27', 0, NULL, '::1'),
(379, '8690eb6b4e5ac378d81997ff68acc50342fbea5d96e4b277955e407abece86b8', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 21:24:40', '2025-12-01 21:39:40', 0, NULL, '::1'),
(380, 'd212363e3f6d4f2ebc4e4c03ef56578e8afd64a943980bf5c32d91b6ce8cb750', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 21:27:11', '2025-12-01 21:42:11', 0, NULL, '::1'),
(381, '7e8d857929eb6b1a9715c13eb6fa4d7fd00d9b661c6cfac9370c3b889605c12e', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 21:32:29', '2025-12-01 21:47:29', 0, NULL, '::1'),
(382, 'c18560806ab432ea92f841ef494cd61b6de8e7d4fe970155a5b673fe924eb086', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 21:35:11', '2025-12-01 21:50:11', 0, NULL, '::1'),
(383, '10c5ed01af6ca0799c3eddc39e000d59512436094e0b1a134bde33c80a20e389', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 21:39:37', '2025-12-01 21:54:37', 0, NULL, '::1'),
(384, '0f437b6d3571300e304311f22745422be38857925caaed6b33e79c15f0f13d31', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 21:42:15', '2025-12-01 21:57:15', 0, NULL, '::1'),
(385, 'a8fb992fec9a592c15ad7ee178602051ced5247b411c2758a1dc4ad00cb260db', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 21:54:14', '2025-12-01 22:09:14', 0, NULL, '::1'),
(386, '52b36311155c9506e94989793504202216e67a832f77260b3274ba8e7be5cc08', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 22:00:34', '2025-12-01 22:15:34', 0, NULL, '::1'),
(387, '070be3e7938b420a2efab06512ee141e95f44b60fa5a35455023b14bd9cc381a', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-01 22:02:15', '2025-12-01 22:17:15', 0, NULL, '::1'),
(388, '88b64e848639cf6d1d0bdd2c136866055cb4641f9e791c16dfe4ac4527cc61d6', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-03 11:26:22', '2025-12-03 11:41:22', 0, NULL, '::1'),
(389, 'e98c0640224dcc43613bf49c33b319cbba3cbbe23f5edbb142b6e00c0314d47e', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-03 11:27:12', '2025-12-03 11:42:12', 0, NULL, '::1'),
(390, '4ef5ca3e15210d87fb2eeabece2f976867bb00d41ead4839e81aeb10b10b27b4', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-03 12:05:29', '2025-12-03 12:20:29', 0, NULL, '::1'),
(391, '1e2082ca32d580d2d44dfc99b425e948cab52d931084f79dbecdb225c41f8758', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-08 11:18:15', '2025-12-08 11:33:15', 0, NULL, '::1'),
(392, '57f916e41c7c97345c6bcd36517b9451e6c4e76a8c660e95a4bac7da6c54ee18', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-08 11:22:04', '2025-12-08 11:37:04', 0, NULL, '::1'),
(393, '25f5dceb1863546da86553f4eb92a6025d1352f21445d0e65419aa2fd3c5fd78', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-08 11:24:36', '2025-12-08 11:39:36', 0, NULL, '::1'),
(394, 'e844f8b0631d07ad2335472aaa12c0790837cc8bb1bd4f240570d3d3fb6cf68f', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2025-12-08 11:29:02', '2025-12-08 11:44:02', 0, NULL, '::1'),
(395, '0634bc565fbb097282f2d8ca05fcda588c9f98c2340d692edacb0989df89dcc7', 'login', 'timed', 'trulyrarecustoms@gmail.com', '2026-01-21 10:34:49', '2026-01-21 10:49:49', 0, NULL, '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `internal_users`
--
ALTER TABLE `internal_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `token_2` (`token`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `purpose` (`purpose`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `internal_users`
--
ALTER TABLE `internal_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;
--
-- Database: `zax_messages`
--
CREATE DATABASE IF NOT EXISTS `zax_messages` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `zax_messages`;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(13) NOT NULL,
  `date_time` datetime NOT NULL,
  `service_type` text NOT NULL,
  `submitted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `Name`, `Email`, `Phone`, `date_time`, `service_type`, `submitted_at`) VALUES
(1, 'Quinton', 'quintontaylor29@gmail.com', '5555555555', '2025-11-09 17:59:00', 'Workstations', '2025-11-13 18:10:34'),
(2, 'Quinton', 'quintontaylor29@gmail.com', '5555555555', '2025-11-09 17:59:00', 'Workstations', '2025-11-13 18:16:15'),
(3, 'Quinton', 'quintontaylor29@gmail.com', '5555555555', '2025-11-09 17:59:00', 'Workstations', '2025-11-13 18:18:01'),
(4, 'Quinton', 'test@example.com', '19', '2025-12-31 16:15:00', 'Development', '2025-12-29 12:12:10'),
(5, 'Quinton', 'test@example.com', '19', '2025-12-31 16:15:00', 'Development', '2025-12-29 12:12:10'),
(6, 'Quinton', 'test@example.com', '19', '2026-01-02 12:33:00', 'Gaming', '2025-12-29 12:29:57'),
(7, 'Quinton', 'test@example.com', '19', '2025-12-31 12:31:00', 'Gaming', '2025-12-29 12:31:25'),
(8, 'Quinton', 'test@example.com', '19', '2025-12-30 12:35:00', 'Gaming', '2025-12-29 12:32:01'),
(9, 'Quinton', 'test@example.com', '19', '2025-12-31 12:38:00', 'Gaming', '2025-12-29 12:33:32'),
(10, 'Quinton', 'test@example.com', '19', '2025-12-30 12:38:00', 'Gaming', '2025-12-29 12:33:52'),
(11, 'Quinton', 'test@example.com', '19', '2025-12-24 12:42:00', 'Gaming', '2025-12-29 12:37:37'),
(12, 'Que', 'test@example.com', '165-483-1545', '2026-01-01 12:46:00', 'Development', '2025-12-29 12:42:30'),
(13, 'Quinton', 'test@example.com', '135-254-6845', '2026-01-02 12:48:00', 'Workstations', '2025-12-29 12:45:00'),
(14, 'Quinton', 'test@example.com', '135-254-6845', '2025-12-31 13:36:00', 'Development', '2025-12-29 13:31:23'),
(15, 'Quinton', 'test@example.com', '3145034597', '2025-12-31 13:48:00', 'Development', '2025-12-29 13:49:11'),
(16, 'Quintonhh', 'test@example.com', '3145034597', '2025-12-11 13:57:00', 'Development', '2025-12-29 13:51:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Database: `zax_products`
--
CREATE DATABASE IF NOT EXISTS `zax_products` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `zax_products`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Unique product ID',
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Description',
  `image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Image',
  `price` decimal(10,2) NOT NULL COMMENT 'Price',
  `currency` varchar(3) DEFAULT 'USD' COMMENT 'Currency code',
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Tags for searching and organizing',
  `stock` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '{   "XS": 0,   "S": 0,   "M": 0,   "L": 0,   "XL": 0,   "2XL": 0,   "3XL": 0 }',
  `sku` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Stock keeping unit',
  `time created` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Time created',
  `time updated` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Time updated',
  `visible/not visible` char(11) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `currency`, `tags`, `stock`, `sku`, `time created`, `time updated`, `visible/not visible`) VALUES
(6, 'First', 'cool pc', '{ \"1\": \"assets\\\\oracle.jpg\", \"2\": \"assets\\\\bwbanner.jpg\", \"3\": \"assets\\\\dlarge.jpg\", \"4\": \"assets\\\\logo1.png\", \"5\": \"assets\\\\logo2.png\", \"6\": \"assets\\\\paint.png\", \"7\": \"assets\\\\pinkGabs.png\" }', 59.99, 'USD', 'gaming pc', '10', 'first-001', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'yes'),
(38, 'Second', 'cool pc', '{ \"1\": \"assets\\\\oracle.jpg\", \"2\": \"assets\\\\bwbanner.jpg\", \"3\": \"assets\\\\dlarge.jpg\", \"4\": \"assets\\\\logo1.png\", \"5\": \"assets\\\\logo2.png\", \"6\": \"assets\\\\paint.png\", \"7\": \"assets\\\\pinkGabs.png\" }', 59.99, 'USD', 'gaming pc', '10', 'second-002', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'yes'),
(39, 'Third', 'cool pc', '{ \"1\": \"assets\\\\oracle.jpg\", \"2\": \"assets\\\\bwbanner.jpg\", \"3\": \"assets\\\\dlarge.jpg\", \"4\": \"assets\\\\logo1.png\", \"5\": \"assets\\\\logo2.png\", \"6\": \"assets\\\\paint.png\", \"7\": \"assets\\\\pinkGabs.png\" }', 59.99, 'USD', 'gaming pc', '10', 'third-001', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique product ID', AUTO_INCREMENT=40;
--
-- Database: `zax_research_reports`
--
CREATE DATABASE IF NOT EXISTS `zax_research_reports` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `zax_research_reports`;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Preview` varchar(30) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `Image` varchar(500) DEFAULT NULL,
  `Slug` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `Name`, `Preview`, `Content`, `Image`, `Slug`) VALUES
(1, 'one', 'This is the first ', 'This is the first research report', 'images\\computerSet.jpg', 'First report'),
(2, 'two', 'This is the second', 'This is the second research report', 'images\\computerSet2.jpg', 'Second report'),
(3, 'Three', 'This is the third', 'This is the third research report', 'images\\computerSet3.jpg', 'Third report'),
(4, 'Forth', 'This is the forth', 'This is the forth research report', 'images\\computerSet4.jpg', 'Forth report'),
(6, 'Computer parts ', 'Data of computer parts sold', 'Let us show you are all our accomplishments and satisfaction after selling computer parts over the years.', 'images\\computerPart.jpg', 'Computer parts ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
