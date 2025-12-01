-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2025 at 05:45 PM
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
-- Database: `trc_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` char(36) DEFAULT NULL,
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `status`, `payment_status`, `payment_method`, `total_amount`, `subtotal_amount`, `tax_amount`, `shipping_amount`, `discount_amount`, `coupon_code`, `shipped`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `shipping_method`, `tracking_number`, `delivery_date`, `notes`, `created_at`, `updated_at`) VALUES
(3, '123e4567-e89b-12d3-a456-426614174000', '2025-09-09 10:00:00', 'Processing', 'Paid', 'Credit Card', 120.00, 100.00, 10.00, 10.00, 0.00, '', 0, 'John Doe', '+1234567890', 'john.doe@example.com', '123 Main Street, Apt 4B', 'New York', 'NY', '10001', 'USA', 'Standard', NULL, NULL, 'Please leave package at the front desk', '2025-09-09 10:00:00', '2025-09-09 10:00:00');

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
  `visible/not visible` int(11) NOT NULL DEFAULT 1 COMMENT '1=v 2=nm'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `currency`, `tags`, `stock`, `sku`, `time created`, `time updated`, `visible/not visible`) VALUES
(5, 'Classic White T-Shirt', 'Soft cotton unisex t-shirt, breathable and lightweight.', 'assets\\bwbanner.jpg', 19.99, 'USD', 'tshirt, cotton, unisex, casual', '{ \"XS\": 10, \"S\": 25, \"M\": 30, \"L\": 20, \"XL\": 15, \"2XL\": 5, \"3XL\": 2 }', 'TSHIRT-WHITE-001', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 1),
(6, 'Blue Denim Jacket', 'Stylish denim jacket with button closure and front pockets.', 'assets\\denim.jpg', 59.99, 'USD', 'jacket, denim, outerwear, blue', '{ \"XS\": 3, \"S\": 8, \"M\": 12, \"L\": 10, \"XL\": 6, \"2XL\": 4, \"3XL\": 1 }', 'JACKET-DENIM-BLUE-002', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 1),
(7, 'Black Hoodie', 'Fleece-lined hoodie with adjustable drawstrings and kangaroo pocket.', 'assets\\dlarge.jpg', 39.99, 'USD', 'hoodie, sweatshirt, casual, black', '{ \"XS\": 5, \"S\": 12, \"M\": 20, \"L\": 18, \"XL\": 10, \"2XL\": 6, \"3XL\": 2 }', 'HOODIE-BLACK-003', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 1),
(8, 'Red Summer Dress', 'Flowy sleeveless dress made from lightweight fabric, perfect for summer.', 'assets\\logo1.png', 49.99, 'USD', 'dress, summer, women, casual, red', '{ \"XS\": 6, \"S\": 15, \"M\": 20, \"L\": 14, \"XL\": 8, \"2XL\": 3, \"3XL\": 1 }', 'DRESS-RED-004', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 1),
(9, 'Sneakers White', 'Comfortable everyday sneakers with rubber sole and breathable mesh.', 'assets\\logo2.PNG', 74.99, 'USD', 'shoes, sneakers, footwear, white', '{ \"XS\": 0, \"S\": 0, \"M\": 25, \"L\": 30, \"XL\": 18, \"2XL\": 10, \"3XL\": 5 }', 'SHOES-SNEAKERS-WHITE-005', '2025-09-08 14:12:13', '2025-09-08 14:12:13', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique product ID', AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
