-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2018 at 06:46 PM
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
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `answer` varchar(1024) DEFAULT NULL,
  `symbol` varchar(1) DEFAULT NULL,
  `q_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` int(11) NOT NULL,
  `question` varchar(1024) NOT NULL,
  `type` varchar(10) NOT NULL,
  `correct_answer` varchar(5) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `hidden` text,
  `visible` text,
  `name` varchar(20) NOT NULL,
  `question_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `hidden`, `visible`, `name`, `question_num`) VALUES
(4, 'a:1:{i:0;a:4:{s:3:\"top\";i:166;s:4:\"left\";i:178;s:5:\"width\";i:1371;s:6:\"height\";i:210;}}', 'a:0:{}', 'testTemp', 7),
(5, 'N;', 'N;', 'testTemp', 0),
(6, 'N;', 'N;', 'testTemp', 0),
(7, 'N;', 'N;', 'testTemp', 0),
(8, 'N;', 'N;', 'testTemp', 0),
(9, 'N;', 'N;', 'testTemp', 0),
(10, 'N;', 'N;', 'testTemp', 0),
(11, 'N;', 'N;', 'testTemp', 0),
(12, 'a:0:{}', 'a:1:{i:0;a:4:{s:3:\"top\";i:136;s:4:\"left\";i:173;s:5:\"width\";i:1402;s:6:\"height\";i:257;}}', 'testTemp', 0),
(20, 'a:1:{i:0;a:4:{s:3:\"top\";i:475;s:4:\"left\";i:327;s:5:\"width\";i:1144;s:6:\"height\";i:216;}}', 'a:1:{i:0;a:4:{s:3:\"top\";i:168;s:4:\"left\";i:178;s:5:\"width\";i:1374;s:6:\"height\";i:222;}}', 'testTemp', 7);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dirpath` varchar(260) DEFAULT NULL,
  `templateId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `name`, `dirpath`, `templateId`) VALUES
(1, 'a', 'asd', 1),
(2, 'testTemp', '../uploads/20_testTemp/test3.jpg', 20),
(3, 'testTemp', '../uploads/20_testTemp/test1.jpg', 20),
(4, 'testTemp', '../uploads/20_testTemp/test2.jpg', 20),
(5, 'testTemp', '../uploads/20_testTemp/test3.jpg', 20),
(6, 'testTemp', '../uploads/20_testTemp/test1.jpg', 20),
(7, 'testTemp', '../uploads/20_testTemp/test2.jpg', 20),
(8, 'testTemp', '../uploads/20_testTemp/test3.jpg', 20),
(9, 'dddd', '../uploads/1_dddd/test1.jpg', 1),
(10, 'dddd', '../uploads/1_dddd/test2.jpg', 1),
(11, 'dddd', '../uploads/1_dddd/test3.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` char(64) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `user_type`) VALUES
(1, 'Atanas Kurtakov', 'nasko', 'asdf', 'admin'),
(2, 'Ivan Ivanov', 'ivan', 'asdf', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD UNIQUE KEY `foreign key` (`q_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`),
  ADD UNIQUE KEY `foreign key` (`test_id`);

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
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_q_id` FOREIGN KEY (`q_id`) REFERENCES `questions` (`q_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_test_id` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
