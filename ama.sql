-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2020 at 07:34 PM
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
-- Table structure for table `curriculum_list`
--

CREATE TABLE `curriculum_list` (
  `id` int(11) NOT NULL,
  `degree_id` int(11) DEFAULT NULL,
  `curriculum_year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_subj_prereq`
--

CREATE TABLE `curriculum_subj_prereq` (
  `id` int(11) NOT NULL,
  `curriculum_subj_id` int(11) NOT NULL,
  `preq_subj_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `degree_list`
--

CREATE TABLE `degree_list` (
  `id` int(11) NOT NULL,
  `degree_name` varchar(50) NOT NULL,
  `degree_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request_to_open_list`
--

CREATE TABLE `request_to_open_list` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request_to_open_student_list`
--

CREATE TABLE `request_to_open_student_list` (
  `id` int(11) NOT NULL,
  `req_to_open_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `section_list`
--

CREATE TABLE `section_list` (
  `id` int(11) NOT NULL,
  `section_code` varchar(20) DEFAULT NULL,
  `degree_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'MATH 101', 'SDFSDFSDF', 'SDFSDFSDFSDF', 1, 2, 1),
(2, 'CS 101', 'SDFSDFSDF', 'SDFSDFSDF', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trimester_list`
--

CREATE TABLE `trimester_list` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `trimester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `curriculum_list`
--
ALTER TABLE `curriculum_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curriculum_subject`
--
ALTER TABLE `curriculum_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curriculum_subj_prereq`
--
ALTER TABLE `curriculum_subj_prereq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `degree_list`
--
ALTER TABLE `degree_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_to_open_list`
--
ALTER TABLE `request_to_open_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_to_open_student_list`
--
ALTER TABLE `request_to_open_student_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section_list`
--
ALTER TABLE `section_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_subject_list`
--
ALTER TABLE `student_subject_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_list`
--
ALTER TABLE `subject_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trimester_list`
--
ALTER TABLE `trimester_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trimester_subject_list`
--
ALTER TABLE `trimester_subject_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `curriculum_subj_prereq_ibfk_2` FOREIGN KEY (`preq_subj_id`) REFERENCES `subject_list` (`id`) ON DELETE CASCADE;

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
