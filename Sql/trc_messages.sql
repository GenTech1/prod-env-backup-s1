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
-- Database: `trc_messages`
--

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
(72, 'Charlie', 'Brown', 'charlie.brown@example.com', NULL, 'Just testing the contact form functionality.', '2025-09-09 15:06:40', 'Extra1', NULL, 'Extra3', NULL, 'Extra5');

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
(9, 'Quinton', 'Taylor', '[\"\\/uploads\\/Quinton_Taylor_20250909_1043_40537a75.jpg\"]', 'quintont@zax-online.com', '37485475443', 'sew', 4, '2025-09-10', '00:43', 'hekkoi', '2025-09-09 15:43:20');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `customs`
--
ALTER TABLE `customs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
