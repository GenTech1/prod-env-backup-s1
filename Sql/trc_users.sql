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
-- Database: `trc_users`
--

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
(2, 'user', '$2y$10$L0AWUCXZ5cac8KYUWCWz6.maS8IKijoeoneM/tlM3MBE2yzJkbE9S', 'user', 'quinton taylor', 'user@email.com', 'active', '2025-09-08 16:28:16', '', '{\"products\":1,\"messages\":1,\"site\":1,\"users\":1,\"orders\":1}');

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
(259, '6ec6e732dccd94c06787883434f610db9d6cf41fb77cada6cc28ed507d8a1efb', 'login', 'timed', 'user@email.com', '2025-09-09 10:46:40', '2025-09-09 11:01:40', 0, NULL, '::1');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
