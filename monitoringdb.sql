-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 05:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoringdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(50) NOT NULL,
  `studentid` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `details` varchar(255) NOT NULL,
  `dateTimeCreated` datetime(6) NOT NULL,
  `dateTimeUpdated` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `studentid`, `date`, `file`, `details`, `dateTimeCreated`, `dateTimeUpdated`) VALUES
(1, '1903090', '2024-01-20', 'image_2024-01-22_130202017.jpeg', 'mukhang tite', '2024-01-22 13:02:08.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(100) NOT NULL,
  `description` varchar(225) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(50) NOT NULL,
  `studentid` varchar(225) NOT NULL,
  `date` varchar(200) NOT NULL,
  `day` varchar(100) NOT NULL,
  `clockIn` time NOT NULL,
  `clockOut` time(6) NOT NULL,
  `breakIn` time(6) NOT NULL,
  `breakOut` time(6) NOT NULL,
  `totalHrs` int(100) NOT NULL,
  `latitude` varchar(225) DEFAULT NULL,
  `longitude` varchar(225) DEFAULT NULL,
  `location` text NOT NULL,
  `dateTimeCreated` datetime(6) NOT NULL,
  `dateTimeUpdated` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `studentid`, `date`, `day`, `clockIn`, `clockOut`, `breakIn`, `breakOut`, `totalHrs`, `latitude`, `longitude`, `location`, `dateTimeCreated`, `dateTimeUpdated`) VALUES
(3, '1903090', 'Jan-20-2024', 'Saturday', '18:15:00', '19:13:00.000000', '18:45:00.000000', '18:56:00.000000', 8, '14.6083474', '121.0094661', 'Valdez Street, Barangay 584, Sampaloc, Fourth District, Manila, Capital District, Metro Manila, 1132, Philippines', '2024-01-20 18:15:28.000000', '0000-00-00 00:00:00.000000'),
(5, '1903090', 'Jan-22-2024', 'Monday', '12:08:00', '00:00:00.000000', '00:00:00.000000', '00:00:00.000000', 8, '14.6083577', '121.0094679', 'Valdez Street, Barangay 584, Sampaloc, Fourth District, Manila, Capital District, Metro Manila, 1132, Philippines', '2024-01-22 12:08:42.000000', '0000-00-00 00:00:00.000000'),
(6, '21-22-227', 'Sep-30-2024', 'Monday', '21:05:00', '15:22:00.000000', '08:01:00.000000', '08:01:00.000000', 2, '14.628160450914663', '120.97916583105065', 'Abad Santos Avenue, Gagalangin, Tondo, Second District, Manila, Capital District, Metro Manila, 1014, Philippines', '2024-09-30 21:05:16.000000', '0000-00-00 00:00:00.000000'),
(7, '21-22-227', 'Oct-03-2024', 'Thursday', '08:58:00', '15:22:00.000000', '08:01:00.000000', '08:01:00.000000', 0, '14.628160450914663', '120.97916583105065', 'Abad Santos Avenue, Gagalangin, Tondo, Second District, Manila, Capital District, Metro Manila, 1014, Philippines', '2024-10-03 08:58:58.000000', '0000-00-00 00:00:00.000000'),
(8, '21-22-227', 'Nov-07-2024', 'Thursday', '07:55:00', '15:22:00.000000', '08:01:00.000000', '08:01:00.000000', 0, '14.628160450914663', '120.97916583105065', 'Abad Santos Avenue, Gagalangin, Tondo, Second District, Manila, Capital District, Metro Manila, 1014, Philippines', '2024-11-07 07:55:25.000000', '0000-00-00 00:00:00.000000'),
(9, '21-22-231', 'Nov-07-2024', 'Thursday', '08:03:00', '08:05:00.000000', '08:04:00.000000', '08:05:00.000000', 0, '14.59206975448783', '120.98155569974713', 'Universidad de Manila, A. Villegas Street, 659, Ermita, Fifth District, Manila, Capital District, Metro Manila, 1000, Philippines', '2024-11-07 08:03:57.000000', '0000-00-00 00:00:00.000000'),
(10, '21-22-227', 'Nov-14-2024', 'Thursday', '10:44:00', '15:22:00.000000', '00:00:00.000000', '00:00:00.000000', 0, '14.628160450914663', '120.97916583105065', 'Abad Santos Avenue, Gagalangin, Tondo, Second District, Manila, Capital District, Metro Manila, 1014, Philippines', '2024-11-14 10:44:38.000000', '0000-00-00 00:00:00.000000'),
(11, '21-22-227', 'Nov-18-2024', 'Monday', '11:01:00', '15:22:00.000000', '00:00:00.000000', '00:00:00.000000', 0, '14.628160450914663', '120.97916583105065', 'Abad Santos Avenue, Gagalangin, Tondo, Second District, Manila, Capital District, Metro Manila, 1014, Philippines', '2024-11-18 11:01:50.000000', '0000-00-00 00:00:00.000000'),
(12, '21-22-227', 'Nov-23-2024', 'Saturday', '23:40:00', '15:22:00.000000', '00:00:00.000000', '00:00:00.000000', 0, '14.628160450914663', '120.97916583105065', 'Abad Santos Avenue, Gagalangin, Tondo, Second District, Manila, Capital District, Metro Manila, 1014, Philippines', '2024-11-23 23:40:16.000000', '0000-00-00 00:00:00.000000'),
(13, '21-22-227', 'Nov-25-2024', 'Monday', '15:13:00', '15:22:00.000000', '00:00:00.000000', '00:00:00.000000', 0, '14.628160450914663', '120.97916583105065', 'Abad Santos Avenue, Gagalangin, Tondo, Second District, Manila, Capital District, Metro Manila, 1014, Philippines', '2024-11-25 15:13:46.000000', '0000-00-00 00:00:00.000000'),
(17, '23-24-377', '2024-12-05', 'Thursday', '16:56:32', '00:00:00.000000', '00:00:00.000000', '00:00:00.000000', 0, '14.598144', '120.9991168', 'Location placeholder', '2024-12-05 23:56:34.000000', '0000-00-00 00:00:00.000000'),
(18, '23-24-377', '2024-12-05', 'Thursday', '17:04:34', '00:00:00.000000', '00:00:00.000000', '00:00:00.000000', 0, '14.598144', '120.9991168', 'Location placeholder', '2024-12-06 00:04:36.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(225) NOT NULL,
  `file_id` int(225) NOT NULL,
  `comment` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `id` int(50) NOT NULL,
  `announcements` varchar(100) NOT NULL,
  `attendanceReport` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(50) NOT NULL,
  `studentid` int(50) NOT NULL,
  `reqList` varchar(250) NOT NULL,
  `submissionDeadline` date NOT NULL,
  `subform` varchar(225) DEFAULT NULL,
  `dateTimeCreated` datetime(6) NOT NULL,
  `dateTimeUpdated` datetime(6) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `studentid`, `reqList`, `submissionDeadline`, `subform`, `dateTimeCreated`, `dateTimeUpdated`, `status`) VALUES
(8, 1903090, 'OJT-Monitoring-System-1.pdf', '2024-01-22', 'OJT-Monitoring-System.pdf1903090', '2024-01-17 18:46:41.000000', '0000-00-00 00:00:00.000000', '2'),
(13, 12345678, 'VOLUNTEER-ACCEPTANCE-LETTER.pdf', '2024-01-30', NULL, '2024-01-23 02:58:11.000000', '0000-00-00 00:00:00.000000', '3');

-- --------------------------------------------------------

--
-- Table structure for table `practicuminfo`
--

CREATE TABLE `practicuminfo` (
  `id` int(50) NOT NULL,
  `studentid` varchar(225) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `compAddress` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `supervisorName` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contactNum` int(50) DEFAULT NULL,
  `ojtCoordinator` varchar(100) DEFAULT NULL,
  `practicumHrsreq` int(100) DEFAULT NULL,
  `hiredDate` date DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `dateTimeCreated` datetime(6) DEFAULT NULL,
  `dateTimeUpdated` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `practicuminfo`
--

INSERT INTO `practicuminfo` (`id`, `studentid`, `company`, `compAddress`, `department`, `supervisorName`, `position`, `email`, `contactNum`, `ojtCoordinator`, `practicumHrsreq`, `hiredDate`, `startDate`, `dateTimeCreated`, `dateTimeUpdated`) VALUES
(4, '21-22-227', 'UDM', 'udm@udm.edu.ph', 'IT', 'Ash Great', 'Assistant', 'mikael@gmail.com', 653745735, 'Mr. Ronald', 300, '2024-01-23', '2024-01-27', NULL, '2024-09-30 22:59:42.000000');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` varchar(50) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
('1', 'I have not started anything regarding OJT'),
('2', 'I have applied to HTEs but have not yet been accepted to one'),
('3', 'I have been accepted in an HTE but I am still fixing my requirements'),
('4', 'I have been accepted in an HTE and have started my training'),
('5', 'I am working student and waiting for approval'),
('6', 'I am working student and have recieved my credeting approval');

-- --------------------------------------------------------

--
-- Table structure for table `studentinfo`
--

CREATE TABLE `studentinfo` (
  `id` int(225) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `image` varchar(225) DEFAULT 'icon.jpg',
  `biometric_picture` varchar(225) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `middleName` varchar(100) DEFAULT NULL,
  `contactNum` bigint(225) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `college` varchar(100) DEFAULT NULL,
  `yearProg` varchar(100) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `otp` varchar(225) DEFAULT NULL,
  `dateTimeCreated` timestamp NULL DEFAULT current_timestamp(),
  `dateTimeUpdated` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentinfo`
--

INSERT INTO `studentinfo` (`id`, `studentid`, `image`, `biometric_picture`, `lastName`, `firstName`, `middleName`, `contactNum`, `email`, `college`, `yearProg`, `birthDate`, `gender`, `status`, `otp`, `dateTimeCreated`, `dateTimeUpdated`) VALUES
(8, '21-22-227', 'icon.jpg', NULL, 'Loria', 'Mikael', 'L.', 9348537265, 'loriamikael24@gmail.com', 'CET', '4th Year-BSIT', '2003-08-05', 'Male', '1', NULL, '2024-11-15 00:11:28', '2024-11-25 09:14:33'),
(16, '23-24-377', 'icon.jpg', '675099bce7528.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-04 18:04:45', '2024-12-04 18:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `usertype` int(50) NOT NULL DEFAULT 1,
  `studentid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `usertype`, `studentid`) VALUES
(1, 'admin1', '$2y$10$MUar52G9Zq9OyAcvksMpVu6mDZveLholtdQ7bu4WOgJH6gTWVCd9i', 2, 0),
(2, '1903090', '$2y$10$MX08j2.9DQ0Bjk6fIc10ue7ce1gL9WLeR59GrJ2/rsMby1QzMlexa', 1, 0),
(3, 'faculty1', '$2y$10$MUar52G9Zq9OyAcvksMpVu6mDZveLholtdQ7bu4WOgJH6gTWVCd9i', 3, 0),
(4, 'coordi1', '$2y$10$MUar52G9Zq9OyAcvksMpVu6mDZveLholtdQ7bu4WOgJH6gTWVCd9i', 4, 0),
(6, '21-22-231', '$2y$10$npdWIbsDAVagJ.jlD6x7eObjvgMSkVk/TC/Wag7kgENKTMC/mM2Nu', 1, 0),
(14, '21-22-225', '$2y$10$l5GYIdj94QURpYAVUUk1x.xYomWjAprDOIEd8szWUEDOmN9Bhf7yK', 1, 0),
(15, '21-22-227', '$2a$12$zAIAnKJJ.Y.SsPij9w3CRu4elGxepNMYSVCkMlRyb11OpR/q6wQg2', 1, 0),
(16, '21-22-229', '$2y$10$giRiBb0ubWxQ8LzXxzMcJeI39jiUqaTmEzQjNVORcOVdgIU91.56m', 1, 0),
(17, '21-22-235', '$2y$10$pNvuuc3pV1DaAEAJW1TMauK41wrlgxr4STxpVOrlhHwTmJ7Lk2CWa', 1, 0),
(18, '21-16-009', '$2y$10$b2VVD5ZU37cJ2RfKPqEEQOm8cJfewNQB1wve2uELD/LhTb4yc1Ueu', 1, 0),
(21, '23-24-377', '$2y$10$RPH9mVVnourMUAWmxi1HO.G0mg/wWFnwpDpAjViagj3xOzUcBmlmG', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `description`) VALUES
(2, 'admin'),
(3, 'faculty'),
(4, 'coordinator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentid` (`studentid`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `practicuminfo`
--
ALTER TABLE `practicuminfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `studentinfo`
--
ALTER TABLE `studentinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usertype` (`usertype`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `practicuminfo`
--
ALTER TABLE `practicuminfo`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `studentinfo`
--
ALTER TABLE `studentinfo`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentinfo`
--
ALTER TABLE `studentinfo`
  ADD CONSTRAINT `studentinfo_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usertype`
--
ALTER TABLE `usertype`
  ADD CONSTRAINT `usertype_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`usertype`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
