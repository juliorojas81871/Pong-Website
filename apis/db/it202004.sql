-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 07:40 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `public` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `public`, `admin`, `level`) VALUES
(9, 'soothing_lives', 'dsd@co.in', '6ef42f8c21193524485c0ce8acfeda9f78e7c834b71820370cdb8ec17f2123e529efd857f938b87dac509efbfa4f83f333b9899828055dd8d95cd5b3345740f7', 1, 1, 1),
(10, 'rupesh', 'rupeshdarimisetti@gmail.com', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', 1, 0, 1),
(11, 'eagle', 'rd@gmail.com', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', 1, 0, 1),
(14, 'eagle2', 'man1@gmail.com', 'cb1284fbe067ea856756816ea1887f4940f0e5c101db955f4afff4a689350e9473ba3b05e5a72a3c84a753790dcb87979d76dc6f3560bee7f35415a75715e7de', 1, 0, 1);

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
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_logic`
--
ALTER TABLE `admin_logic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
