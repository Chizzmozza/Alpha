-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2025 at 06:51 AM
-- Server version: 10.6.21-MariaDB-cll-lve
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsituccc_alphagl`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `name`, `time_in`, `time_out`, `user_id`) VALUES
(50, 'Ivan', '2025-04-24 16:38:58', '2025-04-24 16:39:24', 5),
(51, 'Ivan', '2025-04-24 16:44:41', '2025-04-24 16:50:16', 5),
(52, 'Auser', '2025-04-24 16:48:46', '2025-04-24 16:50:25', 13),
(53, 'Auser', '2025-04-24 16:52:22', '2025-04-24 16:52:36', 13),
(54, 'Ivan', '2025-04-24 16:52:50', '2025-04-24 16:53:57', 5),
(55, 'Ivan', '2025-04-24 16:54:08', '2025-04-24 16:54:19', 5),
(56, 'Ivan', '2025-04-24 16:58:34', '2025-04-24 17:04:13', 5),
(57, 'Ivan', '2025-04-24 17:04:13', '2025-04-24 17:04:23', 5),
(58, 'Ivan', '2025-04-24 17:04:23', '2025-04-24 17:06:13', 5),
(59, 'Ivan', '2025-04-24 17:06:13', '2025-04-24 17:06:25', 5),
(60, 'Ivan', '2025-04-24 17:06:25', '2025-04-24 17:09:07', 5),
(61, 'Auser', '2025-04-24 18:59:11', '2025-04-24 18:59:33', 13),
(62, 'Auser', '2025-04-24 19:37:51', '2025-04-24 19:40:04', 13),
(63, 'Auser', '2025-04-24 19:40:20', '2025-04-24 19:40:32', 13),
(64, 'Auser', '2025-04-24 19:47:58', '2025-04-24 19:48:11', 13),
(65, 'Auser', '2025-04-24 19:53:49', '2025-04-24 19:54:00', 13),
(66, 'Auser', '2025-04-24 20:22:12', '2025-04-24 20:23:28', 13),
(67, 'Ivan', '2025-04-24 20:24:31', '2025-04-24 20:24:42', 5);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `Booking_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `training` varchar(50) NOT NULL,
  `coach` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `price` varchar(255) NOT NULL,
  `paymentStatus` varchar(50) NOT NULL,
  `paymentMode` varchar(50) NOT NULL,
  `transactionID` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`Booking_id`, `fullname`, `email`, `contact`, `date`, `training`, `coach`, `session`, `price`, `paymentStatus`, `paymentMode`, `transactionID`, `status`) VALUES
(22, 'Ivan Dy', 'ivansolamo9@gmail.com', '9911129927', '2025-05-07', 'Basketball Training', 'Coach Darren', '12 Sessions', '₱5,500', 'Paid', 'Paypal', '97U761672H0479632', 'approved'),
(23, 'Ivan Dy', 'ivansolamo9@gmail.com', '9911129927', '2025-04-23', 'Basketball Training', 'Coach Darren', '12 Sessions', '₱5,500', 'Paid', 'Paypal', '1L581278JW1239129', 'approved'),
(24, 'Ivan Dy', 'ivansolamo9@gmail.com', '9911129927', '2025-04-24', 'Personal Training', 'Coach Kyle', '10', '₱8,500', 'Paid', 'Paypal', '1VC91980DD8778007', 'approved'),
(25, 'Ivan Dy', 'ivansolamo9@gmail.com', '9911129927', '2025-04-25', 'Personal Training', 'Coach Kyle', '10', '₱8,500', 'Paid', 'Paypal', '9AS42668584884456', 'approved'),
(26, 'Christian rafael', 'hexbyengineerings@gmail.com', '123', '2025-04-22', 'Personal Training', 'Coach Kyle', '10', '₱8,500', 'Paid', 'Paypal', '9LE85646JW807743T', 'approved'),
(27, 'jobert cerbito', 'cerbitojobert.bsit@gmail.com', '9295536730', '2025-04-16', 'Personal Training', 'Coach Kyle', '10', 'â‚±8,500', 'Paid', 'Paypal', '41391422XA390864Y', 'approved'),
(28, 'Ivan Dy', 'ivansolamo9@gmail.com', '9911129927', '2025-05-08', 'Personal Training', 'Coach JV', '10', 'â‚±8,500', 'Paid', 'Paypal', '2CK258095H258090N', 'approved'),
(29, 'Ivan Dy', 'ivansolamo9@gmail.com', '9911129927', '2025-04-17', 'Basketball Training', 'Coach Darren', '12 Sessions', 'â‚±5,500', 'Paid', 'Paypal', '5EE5431669967474E', 'pending'),
(30, 'Ivan Dy', 'ivansolamo9@gmail.com', '9911129927', '2025-05-09', 'Basketball Training', 'Coach Darren', '12 Sessions', 'â‚±5,500', 'Paid', 'Paypal', '82X5946708922062S', 'pending');

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
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `descriptions`
--

INSERT INTO `descriptions` (`description_id`, `membership_description`, `price`, `image`) VALUES
(1, 'Subscribe membership for 3 Months for as low as', 4500.00, '../images/baki-hanma-min - Copy.jpeg'),
(2, 'Subscribe membership for 6 Months for as low as', 7500.00, ''),
(11, 'Subscribe membership for 1 Year for as low as', 12500.00, '../pictures/smokeybg.png');

-- --------------------------------------------------------

--
-- Table structure for table `food_history`
--

CREATE TABLE `food_history` (
  `id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `calories` int(11) NOT NULL,
  `protein` decimal(10,2) NOT NULL,
  `fat` decimal(10,2) NOT NULL,
  `carbs` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_history`
--

INSERT INTO `food_history` (`id`, `food_name`, `calories`, `protein`, `fat`, `carbs`, `image_path`, `created_at`, `category`) VALUES
(32, 'shrimp', 2, 321.00, 123.00, 11.00, 'uploads/\'\' (2).png', '2025-04-17 09:58:20', NULL),
(33, 'shrimp', 22, 222.00, 222.00, 222.00, NULL, '2025-04-17 10:04:23', NULL),
(34, 'shrimp', 22, 222.00, 222.00, 222.00, 'uploads/2a (1).png', '2025-04-17 10:04:23', NULL),
(35, '22', 11, 2.00, 111.00, 22.00, NULL, '2025-04-17 10:04:45', NULL),
(36, '22', 11, 2.00, 111.00, 22.00, 'uploads/\'\' (2).png', '2025-04-17 10:04:45', NULL),
(37, 'apple', 12, 22.00, 11.00, 11.00, 'uploads/\'\' (2).png', '2025-04-17 10:06:51', NULL),
(38, 'chopsuey', 12, 23.00, 333.00, 11.00, 'uploads/au.jpg', '2025-04-17 10:24:04', NULL),
(39, 'pork', 123, 23.00, 232.00, 123.00, 'uploads/BINI (1).png', '2025-04-17 10:31:16', NULL),
(40, 'appleww', 111, 111.00, 111.00, 111.00, 'uploads/BINI POSTER.png', '2025-04-17 10:34:04', NULL),
(41, '2123', 123, 121.00, 11.00, 11.00, 'uploads/\'\' (3).png', '2025-04-17 10:41:44', 'breakfast'),
(42, '22', 123, 123.00, 1231.00, 1231.00, 'uploads/\'\' (2).png', '2025-04-17 10:42:11', NULL),
(43, 'rice', 123, 1231.00, 231231.00, 23123.00, 'uploads/BINI.png', '2025-04-17 10:42:50', NULL),
(44, '123', 23, 1231.00, 1231.00, 123.00, 'uploads/\'\' (3).png', '2025-04-17 10:43:26', NULL),
(45, '123', 123, 123.00, 123.00, 123.00, 'uploads/\'\' (3).png', '2025-04-17 10:44:04', NULL),
(46, 'asda', 121, 12.00, 23.00, 3.00, 'uploads/\'\' (3).png', '2025-04-17 10:50:27', 'lunch'),
(47, 'apple', 1223, 131.00, 1.00, 1.00, 'uploads/475021269_607390635232773_2621259165775685045_n.png', '2025-04-18 10:42:07', 'breakfast'),
(48, 'garlic rice', 150, 20.00, 8.00, 60.00, 'uploads/1745468539_buddha.jpg', '2025-04-24 04:22:19', 'lunch');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membership_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(65) DEFAULT NULL,
  `membership_type` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membership_id`, `full_name`, `email`, `membership_type`, `created_at`) VALUES
(1, NULL, NULL, NULL, '2025-04-19 20:40:31'),
(2, NULL, NULL, NULL, '2025-04-19 20:40:57'),
(3, NULL, NULL, NULL, '2025-04-19 20:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `membership_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `membership_type` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`membership_id`, `full_name`, `email`, `membership_type`, `status`, `created_at`, `user_id`) VALUES
(13, 'Auser Velasco', 'christianrafael0320@gmail.com', '3 Months', 'approved', '2025-04-20 13:28:19', 13),
(14, 'Ivan Dy', 'ivansolamo9@gmail.com', '3 Months', 'approved', '2025-04-20 13:35:21', 5),
(15, 'Ivan Dy', 'ivansolamo9@gmail.com', '3 Months', 'approved', '2025-04-20 13:45:51', 5),
(16, 'Auser Velasco', 'christianrafael0320@gmail.com', '6 Months', 'approved', '2025-04-20 14:38:23', 13),
(17, 'Christian rafael', 'hexbyengineerings@gmail.com', '3 Months', 'approved', '2025-04-20 20:29:17', 50),
(18, 'Auser Velasco', 'christianrafael0320@gmail.com', '3 Months', 'approved', '2025-04-20 21:36:08', 13),
(19, 'alphagrindlabgym@gmail.com alphagrindlabgym@gmail.com', 'alphagrindlabgym@gmail.com', '6 Months', 'approved', '2025-04-21 05:18:24', 54),
(20, 'Ivan Dy', 'ivansolamo9@gmail.com', '6 Months', 'approved', '2025-04-21 11:53:31', 5),
(21, 'Ivan Dy', 'ivansolamo9@gmail.com', '6 Months', 'pending', '2025-04-24 04:15:56', 5),
(22, 'John Joseph Belen', 'belenjohnjosephg.bsit@gmail.com', '3 Months', 'pending', '2025-04-25 07:54:53', 60),
(23, 'BONBON BONIFACIO', 'gonzaloseanruzzel.bsit@gmail.com', '9 Months', 'pending', '2025-04-25 07:59:33', 61);

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
  `product_type` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product`, `product_type`, `price`, `description`, `image`) VALUES
(22, 'hanma', 'Supplements', 12500.00, 'yujiro', '../pictures/alpha-logo.jpg'),
(23, 'bobo ka ', 'Supplements', 110.99, 'ba', '../pictures/alpha-logo.jpg'),
(24, 'tanga ', 'Supplements', 23.00, 'ka ', '../pictures/alpha-logo.jpg'),
(25, 'ako', 'Gear', 12500.00, 'dsdsd', '../pictures/alpha-logo.jpg'),
(26, 'gear', 'Gear', 2313.00, 'gear', '../pictures/alpha-logo.jpg');

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
  `membership_id` int(11) DEFAULT NULL,
  `points` varchar(1000) NOT NULL,
  `SerialCard` varchar(25) NOT NULL,
  `DateRegistered` date NOT NULL,
  `CardExpiration` date NOT NULL,
  `role_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `Fname`, `Lname`, `email`, `address`, `password`, `contact`, `role`, `image`, `status`, `code`, `membership_id`, `points`, `SerialCard`, `DateRegistered`, `CardExpiration`, `role_updated_at`) VALUES
(5, 'Ivan', 'Dy', 'ivansolamo9@gmail.com', 'dimasalang', '$2y$10$CzwKWJPm9CkY9CsfX6YXRONAhu4bU0WLf8QRcwODxCBtHuS5LhA8C', 9911129927, 'member', 'IMG_5115.jpeg', 'verified', 451226, NULL, '52', '67583703', '2025-04-25', '2025-07-25', '2025-04-25 11:28:59'),
(7, 'Christian', 'Rafael', 'panuganchristianrafael.bsit@gmail.com', 'weqeq', '$2y$10$ybVUlL6gctJo4HMmlAxUw.9sHQxnnRQUZbb6WmNJiR8CMnbNQvKFO', 212121, 'admin', 'baki-hanma-min.jpeg', 'verified', 404439, NULL, '100', 'E4ADC0E6', '2025-03-29', '2025-06-29', '2025-03-29 06:34:03'),
(9, 'prince ', 'garcia', 'princegarcia012@gmail.com', 'caloocan city', '$2y$10$.w2yNRADxEZIXaD/eNFYqe6NFmQ8t7qRuD0ghMGViNOtBSg31vyxu', 9930815011, 'member', '../pictures/userlogo.png', 'notverified', 119074, NULL, '99', 'CD4CC801', '2025-03-13', '2025-06-13', '2025-03-28 13:31:54'),
(11, 'Hford', 'Efondo', 'efondohford.bsit@gmail.com', 'sta. quiteria', '$2y$10$zcG0M4Ts1ist8./zkTAs5ukV67ydp6.kKGy.NDdhiMXzZ4DOEfRlK', 9295536730, 'member', '../pictures/userlogo.png', 'verified', 0, NULL, '0', '93976028', '2025-03-15', '2025-06-15', '2025-03-28 13:29:32'),
(13, 'Auser', 'Velasco', 'christianrafael0320@gmail.com', 'Raxabago tondo manila', '$2y$10$uRHoN7mlwtwLS4ZUmCA3pe9pgzONy3u3N4qbDeYzEyePpyPGEjwhm', 11111111111, 'member', '../pictures/userlogo.png', 'verified', 0, NULL, '33', 'A44DB3E6', '2025-03-28', '2025-09-28', '2025-04-24 20:23:28'),
(19, 'Ian', 'Chan', 'chaniankyron.bsit@gmail.com', 'Caloocan City', '$2y$10$jf3ucZZPhMG2XS42hv4QKuMoe3dDK3N.TRN9QpzesN512AEfQxNGe', 2222222222, 'admin', '../pictures/userlogo.png', 'verified', 0, NULL, '90', '4474BCE6', '2025-03-28', '2025-06-28', '2025-04-20 09:30:52'),
(50, 'Christian', 'rafael', 'hexbyengineerings@gmail.com', '123', '$2y$10$iN0o/Tm9y1nQ0JaoriV9TO8nrDEi8fHRrHvXO6uzIpOp1uFjB.8oO', 123, 'member', '../pictures/userlogo.png', 'verified', 0, NULL, '0', '64D0BBE6', '2025-04-21', '2025-10-21', '2025-04-21 12:41:19'),
(53, 'poseidon', 'great', 'poseidondgreat041921@gmail.com', '123', '$2y$12$jVX8zwS/M.d8wIYlNk.Mq.59.bxTpZBvoTSPPqXFDVs8tLA4EL4PG', 123, 'user', '../pictures/userlogo.png', 'notverified', 284214, NULL, '0', '', '0000-00-00', '0000-00-00', '2025-04-21 05:12:37'),
(54, 'alphagrindlabgym@gmail.com', 'alphagrindlabgym@gmail.com', 'alphagrindlabgym@gmail.com', '123', '$2y$12$DYw9g1eiTkzNo6cn.66E7e2KAcZ5GLozjOccn6VRjxX9eyVzJ.jwi', 123, 'member', '../pictures/userlogo.png', 'verified', 0, NULL, '0', 'CD4CC801', '2025-04-25', '2025-07-25', '2025-04-25 11:01:19'),
(55, 'ivan', 'ivan', 'dypangcoivan.bsit@gmail.com', '123', '$2y$12$tTv1mzqjppNKXOVQXLR3vuF0qc0TrdP9Y4TNPsBmBx1DFi2yD22bC', 123, 'user', '../pictures/userlogo.png', 'verified', 0, NULL, '0', '', '0000-00-00', '0000-00-00', '2025-04-21 05:40:45'),
(57, 'efondo', 'hford', 'hfordefondo862@gmail.com', '123', '$2y$12$TK.y5dkzYO188tmQiFc1/.dKzlOWCvkCfiU0Xw4msy2j0EMWr6y3y', 123, 'user', '../pictures/userlogo.png', 'verified', 0, NULL, '0', '', '0000-00-00', '0000-00-00', '2025-04-21 10:11:52'),
(59, 'jobert', 'cerbito', 'cerbitojobert.bsit@gmail.com', 'Caloocan City', '$2y$12$jowW1QMbYJWGDHyfgqOB/OQzZpf0l3ZEI.Fm8iTN.NMABwGBrfsey', 9295536730, 'user', '../pictures/userlogo.png', 'verified', 0, NULL, '0', '', '0000-00-00', '0000-00-00', '2025-04-21 11:26:06'),
(60, 'John Joseph', 'Belen', 'belenjohnjosephg.bsit@gmail.com', 'caloocan', '$2y$12$4JiMLBBwNcXB1snfpiHKn.5Ap0FlE7m/qoTwUZE4NKCVChqdwicbG', 9123456789, 'user', '../pictures/userlogo.png', 'verified', 0, NULL, '', '', '0000-00-00', '0000-00-00', '2025-04-25 07:53:40'),
(61, 'BONBON', 'BONIFACIO', 'gonzaloseanruzzel.bsit@gmail.com', 'Biglang Awa Street, Cor 11th Ave, Catleya, Caloocan, 1400 Metro Manila, Philippines', '$2y$12$1bN72U4evb5ZXdVO6MjhcuTpESfoJYpL/Nzp0C/t89LqXrxzZbWs.', 99999999, 'user', '../pictures/userlogo.png', 'verified', 0, NULL, '', '', '0000-00-00', '0000-00-00', '2025-04-25 07:54:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `fk_user_attendance` (`user_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`Booking_id`);

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
-- Indexes for table `food_history`
--
ALTER TABLE `food_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`membership_id`),
  ADD KEY `fk_user_id` (`user_id`);

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
  ADD KEY `membership_id` (`membership_id`),
  ADD KEY `membership_id_2` (`membership_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `Booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `description_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `food_history`
--
ALTER TABLE `food_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_user_attendance` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `memberships`
--
ALTER TABLE `memberships`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

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
