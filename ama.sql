-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2020 at 03:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ama`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_list`
--

CREATE TABLE `account_list` (
  `id` int(11) NOT NULL,
  `account_type` varchar(15) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_list`
--

INSERT INTO `account_list` (`id`, `account_type`, `student_id`, `name`, `username`, `password`) VALUES
(1, 'Admin', NULL, 'Socrates Binos', 'socrates', '2920852soc'),
(7, 'Student', 1, 'Socrates Binos', '15001372000', '2920852soc'),
(8, 'Student', 2, 'Ralph Ryan Fulgueras', '15001373000', '2920852soc');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_list`
--

CREATE TABLE `curriculum_list` (
  `id` int(11) NOT NULL,
  `degree_id` int(11) DEFAULT NULL,
  `curriculum_year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `curriculum_list`
--

INSERT INTO `curriculum_list` (`id`, `degree_id`, `curriculum_year`) VALUES
(1, 1, '2014-2015'),
(2, 2, '2017-2018');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_subject`
--

CREATE TABLE `curriculum_subject` (
  `id` int(11) NOT NULL,
  `curriculum_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `trimester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `curriculum_subject`
--

INSERT INTO `curriculum_subject` (`id`, `curriculum_id`, `subject_id`, `year`, `trimester`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 6, 1, 2),
(3, 1, 13, 1, 3),
(4, 1, 22, 2, 1),
(5, 1, 3, 1, 1),
(6, 1, 9, 1, 2),
(7, 1, 15, 1, 3),
(8, 1, 19, 2, 1),
(9, 1, 12, 1, 1),
(10, 1, 17, 1, 2),
(11, 1, 4, 1, 1),
(12, 1, 10, 1, 2),
(13, 1, 21, 2, 1),
(14, 1, 2, 1, 1),
(15, 1, 7, 1, 2),
(16, 1, 8, 1, 2),
(17, 1, 14, 1, 3),
(18, 1, 18, 2, 1),
(19, 1, 5, 1, 1),
(20, 1, 11, 1, 2),
(21, 1, 16, 1, 3),
(22, 1, 20, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_subj_prereq`
--

CREATE TABLE `curriculum_subj_prereq` (
  `id` int(11) NOT NULL,
  `curriculum_subj_id` int(11) NOT NULL,
  `preq_subj_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `curriculum_subj_prereq`
--

INSERT INTO `curriculum_subj_prereq` (`id`, `curriculum_subj_id`, `preq_subj_id`) VALUES
(1, 1, NULL),
(2, 2, NULL),
(3, 3, NULL),
(4, 4, NULL),
(5, 5, NULL),
(6, 6, NULL),
(7, 7, NULL),
(8, 8, NULL),
(9, 9, NULL),
(10, 10, NULL),
(11, 11, NULL),
(12, 12, NULL),
(13, 13, NULL),
(14, 14, NULL),
(15, 15, NULL),
(16, 16, NULL),
(17, 17, NULL),
(18, 18, NULL),
(19, 19, NULL),
(20, 20, NULL),
(21, 21, NULL),
(22, 22, NULL),
(23, 2, 1),
(24, 6, 5),
(25, 10, 9),
(26, 12, 11),
(27, 15, 14),
(28, 16, 14),
(29, 20, 19),
(30, 3, 1),
(31, 3, 2),
(32, 7, 5),
(33, 7, 6),
(34, 17, 15),
(35, 17, 16),
(36, 21, 19),
(37, 21, 20),
(38, 4, 1),
(39, 4, 2),
(40, 4, 3),
(41, 8, 5),
(42, 8, 6),
(43, 8, 7),
(44, 13, 3),
(45, 18, 17),
(46, 18, 15),
(47, 18, 16),
(48, 22, 20),
(49, 22, 21);

-- --------------------------------------------------------

--
-- Table structure for table `degree_list`
--

CREATE TABLE `degree_list` (
  `id` int(11) NOT NULL,
  `degree_name` varchar(50) NOT NULL,
  `degree_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `degree_list`
--

INSERT INTO `degree_list` (`id`, `degree_name`, `degree_desc`) VALUES
(1, 'BSIT', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY'),
(2, 'BSCS', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE');

-- --------------------------------------------------------

--
-- Table structure for table `request_to_open_list`
--

CREATE TABLE `request_to_open_list` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_to_open_list`
--

INSERT INTO `request_to_open_list` (`id`, `subject_id`, `status`) VALUES
(1, 22, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `request_to_open_student_list`
--

CREATE TABLE `request_to_open_student_list` (
  `id` int(11) NOT NULL,
  `req_to_open_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_to_open_student_list`
--

INSERT INTO `request_to_open_student_list` (`id`, `req_to_open_id`, `student_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section_list`
--

CREATE TABLE `section_list` (
  `id` int(11) NOT NULL,
  `section_code` varchar(20) DEFAULT NULL,
  `degree_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section_list`
--

INSERT INTO `section_list` (`id`, `section_code`, `degree_id`) VALUES
(1, '23AF', 1),
(2, '23AL', 1),
(3, '23AF', 2),
(4, '23AL', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `id` int(11) NOT NULL,
  `usn` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `curriculum_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `usn`, `name`, `curriculum_id`) VALUES
(1, '15001372000', 'Socrates Binos', 1),
(2, '15001373000', 'Ralph Ryan Fulgueras', 1),
(3, '17001372000', 'Shinea Esteban', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_list`
--

CREATE TABLE `student_subject_list` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `add_info` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_subject_list`
--

INSERT INTO `student_subject_list` (`id`, `student_id`, `subject_id`, `grade`, `status`, `add_info`) VALUES
(1, 1, 1, 'A+', 'PASS', ''),
(2, 1, 2, 'A+', 'PASS', ''),
(3, 1, 5, 'A+', 'PASS', ''),
(4, 1, 11, 'A+', 'PASS', ''),
(5, 1, 14, 'A+', 'PASS', ''),
(6, 2, 1, 'A+', 'PASS', ''),
(7, 2, 5, 'A+', 'PASS', ''),
(8, 2, 2, 'A+', 'PASS', ''),
(9, 2, 19, 'A+', 'PASS', ''),
(10, 2, 11, 'A+', 'PASS', ''),
(11, 2, 3, 'A+', 'PASS', ''),
(12, 2, 15, 'C+', 'PASS', ''),
(13, 2, 16, 'B+', 'PASS', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject_list`
--

CREATE TABLE `subject_list` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `subject_desc` varchar(50) NOT NULL,
  `subject_status` tinyint(1) NOT NULL,
  `lec_unit` int(11) NOT NULL,
  `lab_unit` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_list`
--

INSERT INTO `subject_list` (`id`, `subject_code`, `subject_name`, `subject_desc`, `subject_status`, `lec_unit`, `lab_unit`) VALUES
(1, 'CS 101', 'PROGRAMMING 1', 'PROGRAMMING 12', 1, 2, 1),
(2, 'MATH 101', 'MATHEMATICS 1', 'MATHEMATICS 1', 1, 3, 0),
(3, 'ENGL 101', 'ENGLISH 1', 'ENGLISH 1', 1, 3, 0),
(4, 'FILI 101', 'FILIPINO 1', 'FILIPINO 1', 1, 3, 0),
(5, 'PE 101', 'PHYSICAL EDUCATION 1', 'PHYSICAL EDUCATION 1', 1, 3, 0),
(6, 'CS 201', 'PROGRAMMING 2', 'PROGRAMMING 2', 1, 2, 1),
(7, 'MATH 111', 'TRIGONOMETRY', 'TRIGONOMETRY', 1, 3, 0),
(8, 'MATH 113', 'GEOMETRY', 'GEOMETRY', 1, 3, 0),
(9, 'ENGL 201', 'SPEECH COMMUNICATION 1', 'SPEECH COMMUNICATION 1', 1, 3, 0),
(10, 'FILI 201', 'FILIPINO 2', 'FILIPINO 2', 1, 3, 0),
(11, 'PE 111', 'RHYTHMIC ACTIVITIES', 'RHYTHMIC ACTIVITIES', 1, 3, 0),
(12, 'EUTH 101', 'EUTHENICS 1', 'EUTHENICS 1', 1, 1, 0),
(13, 'CS 202', 'ADVANCE PROGRAMMING(OOP)', 'ADVANCE PROGRAMMING(OOP)', 1, 2, 1),
(14, 'MATH 211', 'DIFFERENTIAL CALCULUS', 'DIFFERENTIAL CALCULUS', 1, 3, 0),
(15, 'ENGL 202', 'SPEECH COMMUNICATION 2', 'SPEECH COMMUNICATION 2', 1, 3, 0),
(16, 'PE 113', 'INDIVIDUAL SPORTS', 'INDIVIDUAL SPORTS', 1, 3, 0),
(17, 'EUTH 102', 'EUTHENICS 2', 'EUTHENICS 2', 1, 1, 0),
(18, 'MATH 212', 'INTEGRAL CALCULUS', 'INTEGRAL CALCULUS', 1, 4, 0),
(19, 'ENGL 311', 'BUSINESS ENGLISH', 'BUSINESS ENGLISH', 1, 3, 0),
(20, 'PE 114', 'TEAM SPORTS', 'TEAM SPORTS', 1, 3, 0),
(21, 'IT 311', 'WEB DEVELOPMENT', 'WEB DEVELOPMENT', 1, 3, 0),
(22, 'CS 241', 'DATA STRUCTURES', 'DATA STRUCTURES', 0, 3, 0),
(23, 'MATH 006', 'GEOMETRY', 'BASIC GEOMETRY 1', 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trimester_list`
--

CREATE TABLE `trimester_list` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `trimester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trimester_list`
--

INSERT INTO `trimester_list` (`id`, `year`, `trimester`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trimester_subject_list`
--

CREATE TABLE `trimester_subject_list` (
  `id` int(11) NOT NULL,
  `trimester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `room` varchar(20) DEFAULT NULL,
  `days` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `professor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trimester_subject_list`
--

INSERT INTO `trimester_subject_list` (`id`, `trimester_id`, `subject_id`, `section_id`, `room`, `days`, `time`, `professor`) VALUES
(2, 1, 1, 2, 'room 135', 'Tue', '10:00-12:00 am', 'Shinea Esteban'),
(5, 1, 6, 1, 'room 135', 'Tue', '8:00am-9:30am', ''),
(6, 1, 6, 4, 'room 135', 'Wed - Thu', '8:00am-9:30am', ''),
(7, 1, 21, 1, 'room 135', 'Mon - Sat', '8:00am-9:30am', ''),
(8, 1, 21, 2, 'room 136', 'Tue - Thu', '8:00am-9:30am', ''),
(10, 1, 3, 4, 'room 136', 'Tue - Wed', '8:00am-9:30am', ''),
(11, 1, 7, 3, 'room 136', 'Tue - Wed', '8:00am-9:30am', ''),
(12, 3, 1, 1, 'room 135', 'Mon - Thu', '8:00am-9:30am', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_list`
--
ALTER TABLE `account_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE,
  ADD UNIQUE KEY `student_id` (`student_id`) USING BTREE;

--
-- Indexes for table `curriculum_list`
--
ALTER TABLE `curriculum_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `degree_id` (`degree_id`);

--
-- Indexes for table `curriculum_subject`
--
ALTER TABLE `curriculum_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curriculum_id` (`curriculum_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `curriculum_subj_prereq`
--
ALTER TABLE `curriculum_subj_prereq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curriculum_subj_id` (`curriculum_subj_id`),
  ADD KEY `preq_subj_id` (`preq_subj_id`);

--
-- Indexes for table `degree_list`
--
ALTER TABLE `degree_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_to_open_list`
--
ALTER TABLE `request_to_open_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_to_open_student_list`
--
ALTER TABLE `request_to_open_student_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_to_open_id` (`req_to_open_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `section_list`
--
ALTER TABLE `section_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `degree_id` (`degree_id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usn` (`usn`),
  ADD KEY `curriculum_id` (`curriculum_id`);

--
-- Indexes for table `student_subject_list`
--
ALTER TABLE `student_subject_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subject_list`
--
ALTER TABLE `subject_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_code` (`subject_code`);

--
-- Indexes for table `trimester_list`
--
ALTER TABLE `trimester_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trimester_subject_list`
--
ALTER TABLE `trimester_subject_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_id` (`trimester_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `section_id` (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_list`
--
ALTER TABLE `account_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `curriculum_list`
--
ALTER TABLE `curriculum_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `curriculum_subject`
--
ALTER TABLE `curriculum_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `curriculum_subj_prereq`
--
ALTER TABLE `curriculum_subj_prereq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `degree_list`
--
ALTER TABLE `degree_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_to_open_list`
--
ALTER TABLE `request_to_open_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request_to_open_student_list`
--
ALTER TABLE `request_to_open_student_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `section_list`
--
ALTER TABLE `section_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_subject_list`
--
ALTER TABLE `student_subject_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subject_list`
--
ALTER TABLE `subject_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `trimester_list`
--
ALTER TABLE `trimester_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trimester_subject_list`
--
ALTER TABLE `trimester_subject_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_list`
--
ALTER TABLE `account_list`
  ADD CONSTRAINT `account_list_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `curriculum_list`
--
ALTER TABLE `curriculum_list`
  ADD CONSTRAINT `curriculum_list_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degree_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `curriculum_subject`
--
ALTER TABLE `curriculum_subject`
  ADD CONSTRAINT `curriculum_subject_ibfk_1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curriculum_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `curriculum_subj_prereq`
--
ALTER TABLE `curriculum_subj_prereq`
  ADD CONSTRAINT `curriculum_subj_prereq_ibfk_1` FOREIGN KEY (`curriculum_subj_id`) REFERENCES `curriculum_subject` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curriculum_subj_prereq_ibfk_2` FOREIGN KEY (`preq_subj_id`) REFERENCES `curriculum_subject` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `request_to_open_student_list`
--
ALTER TABLE `request_to_open_student_list`
  ADD CONSTRAINT `request_to_open_student_list_ibfk_1` FOREIGN KEY (`req_to_open_id`) REFERENCES `request_to_open_list` (`id`),
  ADD CONSTRAINT `request_to_open_student_list_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `section_list`
--
ALTER TABLE `section_list`
  ADD CONSTRAINT `section_list_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degree_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_list`
--
ALTER TABLE `student_list`
  ADD CONSTRAINT `student_list_ibfk_1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_subject_list`
--
ALTER TABLE `student_subject_list`
  ADD CONSTRAINT `student_subject_list_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_subject_list_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `curriculum_subject` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trimester_subject_list`
--
ALTER TABLE `trimester_subject_list`
  ADD CONSTRAINT `trimester_subject_list_ibfk_1` FOREIGN KEY (`trimester_id`) REFERENCES `trimester_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trimester_subject_list_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trimester_subject_list_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `section_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
