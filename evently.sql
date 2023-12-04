-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 09:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evently`
--

-- --------------------------------------------------------

--
-- Table structure for table `e_users`
--

CREATE TABLE `e_users` (
  `ID` int(250) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `TIcket_ID` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_users`
--

INSERT INTO `e_users` (`ID`, `Name`, `TIcket_ID`) VALUES
(1, 'HACKEINSTEIN', 'EUP1009'),
(2, 'stein30', 'tinko'),
(3, 'hackeinstein victor', ''),
(4, 'hackeinstein victor', 'EUP56765'),
(5, 'hot pablo', 'EUP11617'),
(6, 'pablo venz', 'EUP28325'),
(7, 'obloa', 'EUP78385');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `e_users`
--
ALTER TABLE `e_users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `e_users`
--
ALTER TABLE `e_users`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
