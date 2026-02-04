-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 09:55 PM
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
