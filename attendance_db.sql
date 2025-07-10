-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 04:03 PM
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
-- Database: `attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent','Late','Excused') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `class_id`, `date`, `status`) VALUES
(5, 33, 3, '2025-03-10', 'Present'),
(6, 34, 3, '2025-03-10', 'Late'),
(7, 67, 3, '2025-03-10', 'Absent'),
(8, 33, 3, '2025-03-08', 'Present'),
(9, 34, 3, '2025-03-08', 'Present'),
(10, 67, 3, '2025-03-08', 'Present'),
(11, 64, 23, '2025-03-08', 'Absent'),
(12, 92, 23, '2025-03-08', 'Present'),
(13, 33, 1, '2025-03-08', 'Present'),
(14, 34, 1, '2025-03-08', 'Late'),
(15, 67, 1, '2025-03-08', 'Absent'),
(16, 64, 24, '2025-03-08', 'Absent'),
(17, 92, 24, '2025-03-08', 'Present'),
(18, 97, 24, '2025-03-08', 'Late'),
(38, 67, 3, '2025-03-05', 'Present'),
(39, 33, 3, '2025-03-05', 'Present'),
(40, 34, 3, '2025-03-05', 'Present'),
(41, 64, 3, '2025-03-05', 'Present'),
(42, 67, 3, '2025-03-05', 'Present'),
(43, 33, 3, '2025-03-05', 'Present'),
(44, 34, 3, '2025-03-05', 'Present'),
(45, 64, 3, '2025-03-05', 'Present'),
(46, 67, 3, '2025-03-05', 'Present'),
(47, 64, 23, '2025-03-19', 'Present'),
(48, 92, 23, '2025-03-19', 'Present'),
(49, 64, 23, '2025-03-19', 'Present'),
(50, 92, 23, '2025-03-19', 'Present'),
(51, 33, 3, '2025-03-11', 'Absent'),
(52, 34, 3, '2025-03-11', 'Present'),
(53, 64, 3, '2025-03-11', 'Late'),
(54, 67, 3, '2025-03-11', 'Present'),
(55, 33, 3, '2025-03-11', 'Absent'),
(56, 34, 3, '2025-03-11', 'Present'),
(57, 64, 3, '2025-03-11', 'Late'),
(58, 67, 3, '2025-03-11', 'Present'),
(59, 33, 3, '2025-03-11', 'Absent'),
(60, 34, 3, '2025-03-11', 'Present'),
(61, 64, 3, '2025-03-11', 'Late'),
(62, 67, 3, '2025-03-11', 'Present'),
(63, 33, 22, '2025-03-27', 'Absent'),
(64, 64, 22, '2025-03-27', 'Present'),
(65, 33, 3, '2025-03-28', 'Late'),
(66, 34, 3, '2025-03-28', 'Absent'),
(67, 64, 3, '2025-03-28', 'Present'),
(68, 67, 3, '2025-03-28', 'Present'),
(69, 33, 3, '2025-03-28', 'Late'),
(70, 34, 3, '2025-03-28', 'Absent'),
(71, 64, 3, '2025-03-28', 'Present'),
(72, 67, 3, '2025-03-28', 'Present'),
(73, 33, 22, '2025-03-26', 'Present'),
(74, 64, 22, '2025-03-26', 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `teacher_id`, `class_name`) VALUES
(1, 202, 'Networking (Div A)'),
(2, 201, 'C++ (Div A)'),
(3, 200, 'Operating System (Div A)'),
(5, 203, 'J Query (Div A)'),
(21, 202, 'Networking (Div B)'),
(22, 200, 'C++ (Div B)'),
(23, 200, 'Operating System (Div B)'),
(24, 202, 'Advance PHP (Div B)'),
(421, 200, 'C++ (Div A)'),
(423, 200, 'PHP'),
(424, 200, 'C++ (Div A)'),
(425, 200, 'css');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `class_id`) VALUES
(10, 33, 3),
(11, 34, 3),
(12, 67, 3),
(14, 64, 23),
(15, 92, 23),
(16, 33, 1),
(17, 34, 1),
(18, 67, 1),
(19, 64, 24),
(20, 92, 24),
(21, 97, 24),
(33, 64, 3),
(34, 33, 5),
(35, 34, 5),
(36, 64, 5),
(37, 67, 5),
(38, 92, 5),
(39, 97, 5),
(40, 33, 22),
(41, 64, 22),
(42, 34, 423),
(43, 64, 423),
(44, 92, 423);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('teacher','student','admin') NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved') DEFAULT 'pending',
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `profile_pic`, `status`, `approval_status`) VALUES
(33, 'Kunal Doke', 'kunal@asmedu.org', '$2y$10$aU6QZzYHfvjKW32Z9Yswf.MqpTU6LcQfVFUM0zek3S787BSknoMWu', 'student', NULL, 'approved', 'pending'),
(34, 'Samyak Dongre ', 'samyak@asmedu.org', '$2y$10$aXciySruXTjEkXBtfNLXBuEJah.TrCVhrfOj4y53uil9.Aak7AI2e', 'student', NULL, 'approved', 'pending'),
(64, 'Mahadev Koli', 'mahadev@asmedu.org', '$2y$10$HvY./6pO113FJVt9ozOJC.sVjJttT1UcpYqlRSVn8qg7JMYiSdZFW', 'student', NULL, 'approved', 'pending'),
(67, 'Shravani Kudale', 'shravani@asmedu.org', '$2y$10$bciDKGC6JSwlhZEAvlhwhe2DGdaeWiPZRskXDEckUh2h3NuIph2uq', 'student', NULL, 'approved', 'pending'),
(92, 'Sahil Parmar', 'sahil@asmedu.org', '$2y$10$3gcEfixJxIjG1yxtu1LS.usWkfDiB66mJ9RHBmCwFzBQAjSk3qGx2', 'student', NULL, 'approved', 'pending'),
(97, 'Aditya Pawar', 'adityapawar8570@gmail.com', '$2y$10$llk9VgBFoBt5iH78YYbhhOS/nnAHghWHdnuCZtYTuEw1ylV..4cuG', 'student', NULL, 'approved', 'pending'),
(200, 'Jyoti Tope', 'jyotitope@asmedu.org', '$2y$10$LjIkIB05JDhWEktIzYRAFugUxMexKXucTCmbb0ZTk6ge/Zmb6TtVK', 'teacher', NULL, 'approved', 'rejected'),
(201, 'Ahilya Patil', 'ahilyapatil@asmedu.org', '$2y$10$AAxdsE3KtfdPPpfmv4cGiuMczrFS7KovDM3Pi9Qnbf76gnDQUnBpq', 'teacher', NULL, 'approved', 'pending'),
(202, 'Amruta Joshi', 'amruta1@asmedu.org', '$2y$10$6JKePR5eWXVmzWGz9pqtguRK/dxgWs3rZ7HLfHfHeab4BoeXOhnvi', 'teacher', NULL, 'approved', 'pending'),
(203, 'Aditi Kharote', 'aditikharote@asmedu.org', '$2y$10$f5OeG2mLos8DMz0Ahh12hu5DQhlo4oOqy3JpTfgkkOpmmrLbZzbP6', 'teacher', NULL, 'approved', 'approved'),
(2222, 'Shree Kudale', 'shreekudale166@gmail.com', '$2y$10$S1zyHCxW76zDcduGsz2cHOFq26FfHLq2MHzAV8K3HmO8XiMn9mIZi', 'admin', 'I am admin', 'approved', 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2235;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
