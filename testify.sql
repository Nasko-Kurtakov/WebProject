-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2018 at 06:06 PM
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
(17, 'a:4:{i:0;a:4:{s:3:\"top\";i:93;s:4:\"left\";i:214;s:5:\"width\";i:72;s:6:\"height\";i:107;}i:1;a:4:{s:3:\"top\";i:84;s:4:\"left\";i:293;s:5:\"width\";i:50;s:6:\"height\";i:118;}i:2;a:4:{s:3:\"top\";i:79;s:4:\"left\";i:353;s:5:\"width\";i:65;s:6:\"height\";i:130;}i:3;a:4:{s:3:\"top\";i:106;s:4:\"left\";i:668;s:5:\"width\";i:142;s:6:\"height\";i:147;}}', 'a:3:{i:0;a:4:{s:3:\"top\";i:81;s:4:\"left\";i:98;s:5:\"width\";i:109;s:6:\"height\";i:125;}i:1;a:4:{s:3:\"top\";i:80;s:4:\"left\";i:444;s:5:\"width\";i:45;s:6:\"height\";i:108;}i:2;a:4:{s:3:\"top\";i:85;s:4:\"left\";i:544;s:5:\"width\";i:83;s:6:\"height\";i:135;}}', 'rather test 2', 22, '2018-06-28 14:59:25'),
(20, 'a:1:{i:0;a:4:{s:3:\"top\";i:475;s:4:\"left\";i:327;s:5:\"width\";i:1144;s:6:\"height\";i:216;}}', 'a:1:{i:0;a:4:{s:3:\"top\";i:168;s:4:\"left\";i:178;s:5:\"width\";i:1374;s:6:\"height\";i:222;}}', 'testTemp', 7, '2018-06-28 12:17:19');

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
(15, 'testTemp', '../uploads/20_testTemp/test1.jpg', 20, NULL, NULL, NULL, 1),
(16, 'testTemp', '../uploads/20_testTemp/test2.jpg', 20, NULL, NULL, NULL, 2),
(17, 'testTemp', '../uploads/20_testTemp/test3.jpg', 19, NULL, NULL, NULL, 4),
(18, 'rather test 2', '../uploads/17_rather test 2/test1.jpg', 17, NULL, NULL, NULL, 1),
(19, 'rather test 2', '../uploads/17_rather test 2/test2.jpg', 17, NULL, NULL, NULL, 1),
(20, 'rather test 2', '../uploads/17_rather test 2/test3.jpg', 17, NULL, NULL, NULL, 1),
(21, 'rather test 2', '../uploads/17_rather test 2/test1.jpg', 17, NULL, NULL, NULL, 1),
(22, 'rather test 2', '../uploads/17_rather test 2/test1.jpg', 17, NULL, NULL, NULL, 1),
(23, 'rather test 2', '../uploads/17_rather test 2/test2.jpg', 17, NULL, NULL, NULL, 1),
(24, 'rather test 2', '../uploads/17_rather test 2/test3.jpg', 17, NULL, NULL, NULL, 1),
(25, 'rather test 2', '../uploads/17_rather test 2/test1.jpg', 17, NULL, NULL, NULL, 1),
(26, 'rather test 2', '../uploads/17_rather test 2/test2.jpg', 17, NULL, NULL, NULL, 1),
(27, 'rather test 2', '../uploads/17_rather test 2/test3.jpg', 17, NULL, NULL, NULL, 1),
(28, 'rather test 2', '../uploads/17_rather test 2/test1.jpg', 17, NULL, NULL, NULL, 1),
(29, 'rather test 2', '../uploads/17_rather test 2/test2.jpg', 17, NULL, NULL, NULL, 1),
(30, 'rather test 2', '../uploads/17_rather test 2/test3.jpg', 17, NULL, NULL, NULL, 1);

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
(1, 'Atanas Kurtakov', 'nasko', 'asdf', 'admin', 'admin', 'nasko.kurtakov@gmail.com'),
(2, 'Ivan Ivanov', 'ivan', 'asdf', 'student', 'SI_2015', 'nasko.kurtakov@gmail.com'),
(4, 'Atanas Kurtakov', 'petur', 'asdf', 'student', 'SI_2015', 'nasko.kurtakov@gmail.com'),
(5, 'Stamat Georgiev', 'stamat', 'asdf', 'student', 'KN_2015', 'nasko.kurtakov@gmail.com'),
(6, 'test', 'test', 'test', 'student', NULL, 'nasko.kurtakov@gmail.com');

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
  ADD PRIMARY KEY (`test_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
