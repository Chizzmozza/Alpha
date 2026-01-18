-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 09:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpha`
--

-- --------------------------------------------------------

--
-- Table structure for table `calculator`
--

CREATE TABLE `calculator` (
  `calculator_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `calorie` varchar(100) NOT NULL,
  `protein` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `coach_id` int(11) NOT NULL,
  `Fname` varchar(65) NOT NULL,
  `Lname` varchar(65) NOT NULL,
  `age` int(11) NOT NULL,
  `expertise` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `contact` bigint(15) DEFAULT NULL,
  `message` varchar(1005) NOT NULL,
  `date_sent` datetime DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Unread',
  `marked_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course` varchar(100) NOT NULL,
  `session` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `coach_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `descriptions`
--

CREATE TABLE `descriptions` (
  `description_id` int(11) NOT NULL,
  `membership_description` varchar(500) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `descriptions`
--

INSERT INTO `descriptions` (`description_id`, `membership_description`, `price`) VALUES
(1, 'Subscribe membership for 1 Months for as low as', 0.00),
(2, 'Subscribe membership for 3 Months for as low as', 0.00),
(3, 'Subscribe membership for 6 Months for as low as', 0.00),
(4, 'Subscribe membership for 1 Year for as low as', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membership_id` int(11) NOT NULL,
  `membership` varchar(65) NOT NULL,
  `status` varchar(65) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product` varchar(150) NOT NULL,
  `product_type` enum('Gear','Supplements') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product`, `product_type`, `price`, `description`, `image`) VALUES
(1, 'Gloves', 'Gear', 500.00, ' provide hand protection and grip support during weightlifting and other gym activities', ''),
(2, 'Gloves', 'Gear', 500.00, ' provide hand protection and grip support during weightlifting and other gym activities', ''),
(3, 'whey protein', 'Supplements', 500.00, 'Whey protein is a protein powder derived from milk that\'s high in amino acids. It\'s a popular supplement for building muscle and weight loss. ', '');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `program` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program`, `description`, `image`) VALUES
(1, 'yoga', ' a cardio-dance workout that uses Latin and international music and choreography to create a fun fitness experience. It\'s suitable for all fitness levels and ages. ', ''),
(2, 'basketball', 'a team sport where two teams try to score points by shooting a ball through a hoop. It\'s a fast-paced game that requires skill, agility, and balance. \r\n', ''),
(3, 'Zumba', 'a cardio-dance workout that uses Latin and international music and choreography to create a fun fitness experience. It\'s suitable for all fitness levels and ages. \r\n', ''),
(4, 'Team Building', ' a process that helps a group of people work together effectively and achieve a common goal. It involves activities that improve communication, trust, and problem-solving skills. ', '');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `coruse_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `status` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` bigint(12) NOT NULL,
  `role` enum('admin','user','member') NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `code` mediumint(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `points` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calculator`
--
ALTER TABLE `calculator`
  ADD PRIMARY KEY (`calculator_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`coach_id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `coach_id` (`coach_id`);

--
-- Indexes for table `descriptions`
--
ALTER TABLE `descriptions`
  ADD PRIMARY KEY (`description_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membership_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `membership_id` (`membership_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `coruse_id` (`coruse_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `coach_id` (`coach_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `membership_id` (`membership_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calculator`
--
ALTER TABLE `calculator`
  MODIFY `calculator_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `descriptions`
--
ALTER TABLE `descriptions`
  MODIFY `description_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `membership` (`membership_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
