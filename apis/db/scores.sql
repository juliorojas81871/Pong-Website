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
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` decimal(10,2) NOT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `user_id`, `score`, `time`, `level`) VALUES
(1, 9, '2.00', '2021-05-08 13:06:51', 0),
(3, 9, '2.00', '2021-05-08 13:06:51', 0),
(4, 9, '5.00', '2021-05-08 13:05:27', 1),
(5, 9, '5.00', '2021-05-08 13:05:27', 1),
(6, 9, '6.00', '2021-05-08 13:05:27', 1),
(8, 9, '2.00', '2021-05-08 13:06:51', 0),
(10, 9, '10.00', '2021-05-08 13:06:51', 0),
(11, 9, '2.00', '2021-05-08 13:06:51', 0),
(12, 9, '2.00', '2021-05-08 13:06:51', 0),
(13, 9, '13.00', '2021-05-08 13:05:27', 1),
(14, 9, '7.00', '2021-05-05 11:43:14', 0),
(15, 9, '8.00', '2021-04-17 11:44:36', 3),
(17, 11, '17.00', '2021-05-08 22:35:17', 0),
(18, 11, '3.00', '2021-05-08 22:36:05', 0),
(19, 9, '9.00', '2021-03-18 11:45:16', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
