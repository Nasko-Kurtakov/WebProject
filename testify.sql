-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2018 at 05:10 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.28

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
CREATE DATABASE IF NOT EXISTS `testify` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `testify`;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `hidden` text,
  `visible` text,
  `name` varchar(20) NOT NULL,
  `question_num` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `hidden`, `visible`, `name`, `question_num`, `date_created`) VALUES
(23, 'a:1:{i:0;a:4:{s:3:\"top\";i:83;s:4:\"left\";i:87;s:5:\"width\";i:783;s:6:\"height\";i:143;}}', 'a:7:{i:0;a:4:{s:3:\"top\";i:292;s:4:\"left\";i:95;s:5:\"width\";i:741;s:6:\"height\";i:45;}i:1;a:4:{s:3:\"top\";i:430;s:4:\"left\";i:131;s:5:\"width\";i:450;s:6:\"height\";i:39;}i:2;a:4:{s:3:\"top\";i:516;s:4:\"left\";i:91;s:5:\"width\";i:521;s:6:\"height\";i:46;}i:3;a:4:{s:3:\"top\";i:637;s:4:\"left\";i:124;s:5:\"width\";i:145;s:6:\"height\";i:27;}i:4;a:4:{s:3:\"top\";i:709;s:4:\"left\";i:85;s:5:\"width\";i:805;s:6:\"height\";i:227;}i:5;a:4:{s:3:\"top\";i:952;s:4:\"left\";i:86;s:5:\"width\";i:772;s:6:\"height\";i:93;}i:6;a:4:{s:3:\"top\";i:1295;s:4:\"left\";i:136;s:5:\"width\";i:366;s:6:\"height\";i:39;}}', 'Botev', 4, '2018-06-30 13:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dirpath` varchar(260) NOT NULL,
  `templateId` int(11) NOT NULL,
  `correct_answers` varchar(255) DEFAULT NULL,
  `comments` varchar(5000) DEFAULT NULL,
  `mark` varchar(255) DEFAULT NULL,
  `assigned_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `name`, `dirpath`, `templateId`, `correct_answers`, `comments`, `mark`, `assigned_to`) VALUES
(69, 'Botev', '../uploads/23_Botev/test1 2.jpg', 23, NULL, NULL, NULL, 1),
(70, 'Botev', '../uploads/23_Botev/test1 3.jpg', 23, NULL, NULL, NULL, 1),
(71, 'Botev', '../uploads/23_Botev/test1.jpg', 23, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` char(64) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `user_group` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `user_type`, `user_group`, `email`) VALUES
(1, 'Милен Петров', 'admin', 'admin', 'admin', 'admin', 'nasko.kurtakov@gmail.com'),
(2, 'Иван Иванов', 'student', 'student', 'student', 'SI_2015', 'nasko.kurtakov@gmail.com'),
(4, 'Георги Георгиев', 'georgi', 'georgi', 'student', 'SI_2015', 'nasko.kurtakov@gmail.com'),
(5, 'Стамат Петров', 'stamat', 'stamat', 'student', 'KN_2015', 'nasko.kurtakov@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `foreign key-template` (`templateId`) USING BTREE,
  ADD KEY `foreign key-user` (`assigned_to`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`templateId`) REFERENCES `template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_ibfk_2` FOREIGN KEY (`assigned_to`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
