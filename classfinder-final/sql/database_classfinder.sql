-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 03:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classfinder_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `default_schedules`
--

CREATE TABLE `default_schedules` (
  `id_schedule` int(11) NOT NULL,
  `id_room` int(11) DEFAULT NULL,
  `id_subject` int(11) NOT NULL,
  `day_of_week` enum('sunday','monday','tuesday','wednesday','thursday','friday','saturday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `default_schedules`
--

INSERT INTO `default_schedules` (`id_schedule`, `id_room`, `id_subject`, `day_of_week`, `start_time`, `end_time`) VALUES
(1, 15, 1, 'monday', '12:00:00', '14:00:00'),
(2, 14, 2, 'tuesday', '11:00:00', '13:00:00'),
(3, 15, 3, 'tuesday', '16:00:00', '20:00:00'),
(4, 12, 4, 'wednesday', '07:00:00', '11:00:00'),
(5, 15, 5, 'thursday', '08:00:00', '12:00:00'),
(6, 12, 6, 'thursday', '15:00:00', '19:00:00'),
(7, 15, 7, 'friday', '07:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id_notification`, `id_user`, `message`, `status`) VALUES
(1, 5, 'Your Request has been approved', 'read'),
(2, 4, 'ID User: user is requested room E11 - 109 (Computer Lab) ', 'read'),
(4, 5, 'Your request for room E11 - 109 (Computer Lab) has been successfully submitted', 'read'),
(5, 5, 'Your Request has been rejected', 'read'),
(12, 4, 'ID User: user is requested room E11 - 109 (Computer Lab)', 'read'),
(13, 5, 'Your request for room E11 - 109 (Computer Lab) has been successfully submitted', 'read'),
(14, 5, 'Your request for room E11 - 109 (Computer Lab) has been approved', 'read'),
(15, 4, 'ID User: user is requested room E11 - 111 (Classroom)', 'read'),
(16, 5, 'Your request for room E11 - 111 (Classroom) has been successfully submitted', 'read'),
(17, 5, 'Your request for room E11 - 111 (Classroom) has been rejected', 'read'),
(18, 4, 'ID User: user is requested room E11 - 111 (Classroom)', 'read'),
(19, 5, 'Your request for room E11 - 111 (Classroom) has been successfully submitted', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id_request` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id_request`, `id_user`, `id_room`, `request_date`, `status`, `description`) VALUES
(1, 5, 1, '2023-12-14 01:02:43', 'approved', 'For education purpose'),
(2, 5, 1, '2023-12-14 02:44:00', 'rejected', 'Belajar'),
(6, 5, 1, '2023-12-15 02:55:00', 'approved', 'untuk belajar'),
(7, 5, 2, '2023-12-22 02:56:00', 'rejected', 'untuk belajar mingguan'),
(8, 5, 2, '2023-12-14 05:49:00', 'pending', 'oke');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id_room` int(11) NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `type` enum('Classroom','Computer Lab') NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id_room`, `room_name`, `type`, `capacity`, `status`) VALUES
(1, 'E11 - 109', 'Computer Lab', 30, 'Booked'),
(2, 'E11 - 111', 'Classroom', 40, 'Available'),
(3, 'E11 - 112', 'Classroom', 35, 'Available'),
(4, 'E11 - 201', 'Computer Lab', 20, 'Booked'),
(5, 'E11 - 202', 'Computer Lab', 25, 'Available'),
(6, 'E11 - 205', 'Classroom', 35, 'Available'),
(7, 'E11 - 206', 'Classroom', 35, 'Booked'),
(8, 'E11 - 207', 'Classroom', 35, 'Available'),
(9, 'E11 - 209', 'Classroom', 35, 'Available'),
(10, 'E11 - 210', 'Classroom', 40, 'Available'),
(11, 'E11 - 301', 'Computer Lab', 25, 'Booked'),
(12, 'E11 - 302', 'Computer Lab', 30, 'Available'),
(13, 'E11 - 305', 'Classroom', 35, 'Booked'),
(14, 'E11 - 306', 'Computer Lab', 25, 'Available'),
(15, 'E11 - 307', 'Classroom', 30, 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `lecturer` varchar(255) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id_subject`, `subject_name`, `lecturer`, `sks`) VALUES
(1, 'Organization and Computer Organization', 'Dr. Hari Wibawanto, M.T.', 2),
(2, 'Instructional Media of Informatics', 'Dr. Hari Wibawanto, M.T.', 2),
(3, 'Object-Oriented Programming', 'Alfa Faridh Suni, S.T., M.T.', 3),
(4, 'Web Programming', 'Anggraini Mulwinda, S.T., M.Eng.', 3),
(5, 'Information Technology Project Management', 'Dr. Anan Nugroho, S.T., M.Eng.', 3),
(6, 'Database System', 'Ahmad Fashiha Hastawan, S.T., M.Eng.', 3),
(7, 'Numerical Methods', 'Uswatun Hasanah, S.Kom., M.Eng.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(4, 'admin', '$2y$10$2DwNSBYkQK3r7sRnwGEiNOE/ddkmRct8pwwBjrFEph09O5ICmMz8q', 'admin'),
(5, 'user', '$2y$10$KzDq6QjDindGuRGAYxY7t.2HBp1LXkhKL2HsYC9SpXi3ounsJfbuK', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `default_schedules`
--
ALTER TABLE `default_schedules`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_subject` (`id_subject`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id_subject`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `default_schedules`
--
ALTER TABLE `default_schedules`
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `default_schedules`
--
ALTER TABLE `default_schedules`
  ADD CONSTRAINT `default_schedules_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`),
  ADD CONSTRAINT `default_schedules_ibfk_2` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id_subject`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
