-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2018 at 01:43 PM
-- Server version: 5.6.25-enterprise-commercial-advanced-log
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testify`
--

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `testId` int(11) NOT NULL,
  `hidden` text,
  `visible` text,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `testId`, `hidden`, `visible`, `name`) VALUES
(1, 420, 'a:1:{i:0;a:4:{s:3:\"top\";i:475;s:4:\"left\";i:327;s:5:\"width\";i:1144;s:6:\"height\";i:216;}}', 'a:1:{i:0;a:4:{s:3:\"top\";i:168;s:4:\"left\";i:178;s:5:\"width\";i:1374;s:6:\"height\";i:222;}}', 'testTemp'),
(4, 714, 'a:1:{i:0;a:4:{s:3:\"top\";i:166;s:4:\"left\";i:178;s:5:\"width\";i:1371;s:6:\"height\";i:210;}}', 'a:0:{}', 'testTemp'),
(5, 5464, 'N;', 'N;', 'testTemp'),
(6, 1190, 'N;', 'N;', 'testTemp'),
(7, 7782, 'N;', 'N;', 'testTemp'),
(8, 6173, 'N;', 'N;', 'testTemp'),
(9, 5456, 'N;', 'N;', 'testTemp'),
(10, 6314, 'N;', 'N;', 'testTemp'),
(11, 7958, 'N;', 'N;', 'testTemp'),
(12, 982, 'a:0:{}', 'a:1:{i:0;a:4:{s:3:\"top\";i:136;s:4:\"left\";i:173;s:5:\"width\";i:1402;s:6:\"height\";i:257;}}', 'testTemp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `testId` (`testId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
