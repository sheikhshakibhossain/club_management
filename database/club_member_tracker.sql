-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2024 at 01:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `club_member_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `name`) VALUES
(171, 'spring'),
(172, 'summer'),
(173, 'fall'),
(181, 'spring'),
(182, 'summer'),
(183, 'fall'),
(191, 'spring'),
(192, 'summer'),
(193, 'fall'),
(201, 'spring'),
(202, NULL),
(203, NULL),
(211, NULL),
(212, NULL),
(213, NULL),
(221, NULL),
(222, NULL),
(223, NULL),
(231, NULL),
(232, NULL),
(233, NULL),
(241, NULL),
(242, NULL),
(243, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Dhaka'),
(2, 'Khulna'),
(3, 'Padma'),
(4, 'Sylhet'),
(5, 'Barishal'),
(6, 'Jessore'),
(7, 'Chittaging'),
(8, 'Rongpur');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `room` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`id`, `name`, `room`, `description`) VALUES
(1, 'Robotics Club', '605', 'makes robots, hosts workshops, events and competetions'),
(2, 'Computer Club', '311', 'hosts workshops, events and competetions'),
(3, 'App Forum', '412', 'hosts events and competetions'),
(4, 'Sports Club', '211', 'Organizes sports events'),
(5, 'Cultural Club', '212', 'Connects people of all cultures'),
(6, 'ELECTRICAL & ELECTRONICS CLUB', '505', 'Focuses on VLSI design');

-- --------------------------------------------------------

--
-- Table structure for table `club_admin`
--

CREATE TABLE `club_admin` (
  `id` int(11) NOT NULL,
  `person_id` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club_admin`
--

INSERT INTO `club_admin` (`id`, `person_id`, `password`) VALUES
(1, '011191001', 'admin'),
(2, '011183040', 'admin'),
(4, '011221031', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `club_mentor`
--

CREATE TABLE `club_mentor` (
  `id` int(11) NOT NULL,
  `person_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club_mentor`
--

INSERT INTO `club_mentor` (`id`, `person_id`) VALUES
(1, '111'),
(2, '112');

-- --------------------------------------------------------

--
-- Table structure for table `club_position`
--

CREATE TABLE `club_position` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club_position`
--

INSERT INTO `club_position` (`id`, `name`) VALUES
(1, 'President'),
(2, 'Vice President'),
(3, 'General Secretary'),
(4, 'Treasurer'),
(5, 'Secretary, Research and Development'),
(6, 'Secretary, Event Management'),
(7, 'Secretary, Branding and promotion'),
(8, 'Secretary, Public Relations'),
(9, 'Secretary, Graphic Designs'),
(10, 'Joint Secretary, Research and Development'),
(11, 'Joint Secretary, Event Management'),
(12, 'Joint Secretary, Branding and Promotions'),
(13, 'Webmaster'),
(14, 'Consultant, Technical'),
(15, 'Executive, Research and Development'),
(16, 'Mentor'),
(17, 'General Member');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Bangladesh'),
(2, 'India'),
(3, 'Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `members_info`
--

CREATE TABLE `members_info` (
  `id` int(11) NOT NULL,
  `person_id` varchar(20) DEFAULT NULL,
  `sessions` int(11) DEFAULT NULL,
  `club_mentor` int(11) DEFAULT NULL,
  `club` int(11) DEFAULT NULL,
  `club_position` int(11) DEFAULT NULL,
  `session` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members_info`
--

INSERT INTO `members_info` (`id`, `person_id`, `sessions`, `club_mentor`, `club`, `club_position`, `session`) VALUES
(1, '011183040', 4, 1, 1, 13, NULL),
(2, '011191101', 5, 2, 1, 14, NULL),
(3, '011191001', 5, 1, 1, 2, NULL),
(5, '011221031', 4, NULL, 1, 15, NULL),
(6, '111', 4, NULL, 1, 16, NULL),
(7, '112', 4, NULL, 2, 16, NULL),
(8, '011221049', 4, NULL, 2, 13, NULL),
(9, '021201001', 2, NULL, 4, 17, NULL),
(10, '011201288', 4, NULL, 5, 2, NULL),
(11, '0212310041', 5, NULL, 6, 17, NULL),
(16, '011221036', 4, NULL, 3, 3, NULL),
(17, '011221032', 4, NULL, 2, 4, NULL),
(18, '011221033', 4, NULL, 3, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `current_work` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `batch` int(11) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `name`, `email`, `address`, `phone`, `current_work`, `dob`, `city`, `country`, `batch`, `passwd`) VALUES
('011183040', 'Abdullah Al Masud', 'amasud183040@bscse.uiu.ac.bd', NULL, '0191231213123', 'Student', '0001-01-01', 5, 1, 183, '1234'),
('011191001', 'Md, Abid Hossain', 'mhossain191001@bseee.uiu.ac.bd', NULL, '01823131313', 'Student', '2001-01-10', 5, 1, 191, '1234'),
('011191101', 'MD Yasin', 'myasin191101@bscse.uiu.ac.bd', NULL, '01863278482', 'Student', '2024-03-18', 2, 1, 191, '1234'),
('011201288', 'Shahriar Hosen', 'mhosen201288@bscse.uiu.ac.bd', NULL, '0197863243', 'Student', '2001-08-11', 2, 1, 201, '1234'),
('011203069', 'Miftahul Islam Mozumder', 'mmozumder203069@bscse.uiu.ac.bd', NULL, '0191111111111', 'Student', '2024-03-17', 3, 1, 203, '1234'),
('011221031', 'Sheikh Shakib Hossain', 'shossain221031@bscse.uiu.ac.bd', NULL, '01920589868', 'Student', '2002-11-20', 5, 1, 221, 'admin'),
('011221032', 'Afrina Riana', 'riana@gmail.com', NULL, '019231223', 'Student', '2001-02-10', 1, 1, 201, '1234'),
('011221033', 'Tanisha Zaman', 'tanisha@gmail.com', NULL, '019231243', 'Student', '2001-03-10', 1, 1, 201, '1234'),
('011221036', 'Saif Al Shad', 'saif@gmail.com', NULL, '019231233', 'Student', '2001-01-10', 3, 1, 201, '1234'),
('011221049', 'Sauda Binti Noor', 'snoor221049@bscse.uiu.ac.bd', NULL, '0188728134', 'Student', '2002-02-01', 1, 1, 201, '1234'),
('021201001', 'Gabriel Gomez', 'gab@gmail.com', NULL, '0199990367', 'Student', '1998-11-22', 2, 1, 201, '1234'),
('0212310041', 'Mushfiq Rahman', 'mrahman2310041@bseee.uiu.ac.bd', NULL, '0178876772', 'Student', '1988-05-23', 5, 1, 231, '1234'),
('111', 'Akib Zaman', 'akib@cse.uiu.ac.bd', NULL, '01623123123', 'Lecturer', '1997-11-29', 2, 1, NULL, '1234'),
('112', 'Abir Hossain', 'abir@cse.uiu.ac.bd', NULL, '01687897979', 'Lecturer', '1997-03-13', 5, 1, NULL, '1234');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `name`) VALUES
(1, 'sept. 2019 - sept. 2020'),
(2, 'sept. 2020 - sept. 2021'),
(3, 'sept. 2021 - sept. 2022'),
(4, 'sept. 2022 - sept. 2023'),
(5, 'sept. 2023 - sept. 2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_admin`
--
ALTER TABLE `club_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `club_mentor`
--
ALTER TABLE `club_mentor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `club_position`
--
ALTER TABLE `club_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_info`
--
ALTER TABLE `members_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `club_position` (`club_position`),
  ADD KEY `club_mentor` (`club_mentor`),
  ADD KEY `club` (`club`),
  ADD KEY `session` (`session`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city` (`city`),
  ADD KEY `country` (`country`),
  ADD KEY `batch` (`batch`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `club_admin`
--
ALTER TABLE `club_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `club_mentor`
--
ALTER TABLE `club_mentor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `club_position`
--
ALTER TABLE `club_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members_info`
--
ALTER TABLE `members_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `club_admin`
--
ALTER TABLE `club_admin`
  ADD CONSTRAINT `club_admin_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`);

--
-- Constraints for table `club_mentor`
--
ALTER TABLE `club_mentor`
  ADD CONSTRAINT `club_mentor_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`);

--
-- Constraints for table `members_info`
--
ALTER TABLE `members_info`
  ADD CONSTRAINT `members_info_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `members_info_ibfk_2` FOREIGN KEY (`club_mentor`) REFERENCES `club_mentor` (`id`),
  ADD CONSTRAINT `members_info_ibfk_3` FOREIGN KEY (`club_position`) REFERENCES `club_position` (`id`),
  ADD CONSTRAINT `members_info_ibfk_4` FOREIGN KEY (`club_mentor`) REFERENCES `club_mentor` (`id`),
  ADD CONSTRAINT `members_info_ibfk_5` FOREIGN KEY (`club`) REFERENCES `club` (`id`),
  ADD CONSTRAINT `members_info_ibfk_6` FOREIGN KEY (`session`) REFERENCES `session` (`id`);

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`city`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `person_ibfk_2` FOREIGN KEY (`country`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `person_ibfk_3` FOREIGN KEY (`batch`) REFERENCES `batch` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
