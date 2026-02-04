-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 07:54 PM
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
(1, 'TEST_ORDER_OMNI_999', 'TEST-SKU-001', '2026-02-04 11:26:09', 'Processing', 'Paid', 'Square', 15.50, 15.50, 0.00, 0.00, 0.00, 'NONE', 0, 'Zax Test', '555-0199', 'zax@test.com', '123 Developer Way', 'New York', 'NY', '10001', 'US', NULL, NULL, NULL, NULL, '2026-02-04 11:26:09');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
