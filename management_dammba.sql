-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2020 at 08:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management_dammba`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_ID` int(11) NOT NULL,
  `USER_USERNAME` varchar(100) DEFAULT NULL,
  `USER_PASSWORD` varchar(100) DEFAULT NULL,
  `USER_LASTNAME` text DEFAULT NULL,
  `USER_FIRSTNAME` text DEFAULT NULL,
  `USER_ROLE` int(25) DEFAULT NULL,
  `SECRET_QUESTION` text DEFAULT NULL,
  `SECRET_ANSWER` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `USER_USERNAME`, `USER_PASSWORD`, `USER_LASTNAME`, `USER_FIRSTNAME`, `USER_ROLE`, `SECRET_QUESTION`, `SECRET_ANSWER`) VALUES
(1, 'ripcris', 'LxeIEcqKRRwsENP6Av3t9A==', 'Vladimir', 'Bargayo', 1, 'MMtjlavrLszt+sgfqw0E3PLMdYbwj+uSnZ1waKX6alM=', 'I7nIW4fmqDsZBhtBID2u/g=='),
(2, 'admin', 'SqP5O4pCX2Qqp50oPMqN3Q==', 'Admin', 'Admin', 1, 'MMtjlavrLszt+sgfqw0E3PLMdYbwj+uSnZ1waKX6alM=', 'I7nIW4fmqDsZBhtBID2u/g==');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
