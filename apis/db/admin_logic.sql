-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 07:41 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it202004`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_logic`
--

CREATE TABLE `admin_logic` (
  `id` int(11) NOT NULL,
  `reward_pts` decimal(10,2) NOT NULL,
  `speed` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_logic`
--

INSERT INTO `admin_logic` (`id`, `reward_pts`, `speed`, `duration`, `level`) VALUES
(1, '1.00', 1, 30, 1),
(2, '2.00', 2, 20, 2),
(3, '6.00', 6, 45, 4),
(4, '3.00', 3, 30, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_logic`
--
ALTER TABLE `admin_logic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level` (`level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_logic`
--
ALTER TABLE `admin_logic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
