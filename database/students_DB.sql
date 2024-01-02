-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2023 at 08:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(60) NOT NULL,
  `user_type` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `user_type`) VALUES
(1, 'abhi', 'abhi@abhi.com', 'abhi', 'user'),
(2, 'admin', 'admin@admin.com', 'admin', 'admin'),
(4, 'user1', 'user1@user1.com', 'user1', 'user'),
(5, 'user2', 'user2@user2.com', 'user2', 'user'),
(6, 'dev', 'dev@dev.com', 'admin', 'admin'),
(27, 'ajin', 'ajin@ajin.com', 'ajin', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stu_enrollment_number` int(8) NOT NULL,
  `stu_name` varchar(50) NOT NULL,
  `stu_marks_status` varchar(20) NOT NULL,
  `stu_attendance` varchar(20) NOT NULL,
  `stu_fee_status` enum('Paid','Not Paid') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stu_enrollment_number`, `stu_name`, `stu_marks_status`, `stu_attendance`, `stu_fee_status`) VALUES
(22000214, 'Abhiraj Chaudhuri', '99%', '92%', 'Paid'),
(22000215, 'Abhishek Yadav', '92%', '69%', 'Paid'),
(22000216, 'Ajin K James', '95%', '87%', 'Paid'),
(22000269, 'Rohan Agarkar', '89%', '75%', 'Paid'),
(22000577, 'Sandra Maria Wilson', '94%', '87%', 'Paid'),
(22000781, 'Parita Tarvani', '92%', '91%', 'Paid'),
(22000782, 'Ruby Singh', '85%', '69%', 'Paid'),
(22000783, 'Riya Shah', '88%', '78%', 'Not Paid'),
(22000784, 'Rishi Agarwal', '92%', '61%', 'Paid'),
(22000785, 'Maya Jain', '87%', '59%', 'Paid'),
(22000786, 'Dev Patel', '91%', '60%', 'Not Paid'),
(22000787, 'Priya Sharma', '86%', '58%', 'Paid'),
(22000788, 'Rahul Singh', '89%', '59%', 'Paid'),
(22000789, 'Mon2 Sharma', '93%', '61%', 'Paid'),
(22000790, 'Anish Agarwal', '88%', '59%', 'Paid'),
(22000791, 'Nikita Jain', '92%', '60%', 'Not Paid'),
(22000792, 'Karan Patel', '87%', '58%', 'Paid'),
(22000793, 'Rishi Sharma', '91%', '59%', 'Paid'),
(22000794, 'Sonu Singh', '86%', '58%', 'Paid'),
(22000795, 'Anjali Patel', '89%', '59%', 'Paid'),
(22000796, 'Rajesh Agarwal', '93%', '61%', 'Paid'),
(22000797, 'Monisha Jain', '88%', '59%', 'Not Paid'),
(22000798, 'Vikram Patel', '92%', '60%', 'Paid'),
(22000799, 'Rakesh Sharma', '87%', '58%', 'Paid'),
(22000800, 'Sunil Singh', '91%', '59%', 'Paid'),
(22000801, 'Ajay Patel', '86%', '58%', 'Paid'),
(22000802, 'Ramesh Agarwal', '89%', '59%', 'Paid'),
(22000803, 'Suresh Jain', '93%', '61%', 'Paid'),
(22000804, 'Kamlesh Patel', '88%', '59%', 'Paid'),
(22000805, 'Suresh Sharma', '92%', '60%', 'Paid'),
(22000806, 'Rakesh Singh', '87%', '58%', 'Paid'),
(22000807, 'Sunil Patel', '91%', '59%', 'Not Paid'),
(22000808, 'Ajay Agarwal', '86%', '58%', 'Paid'),
(22000809, 'Ramesh Jain', '89%', '59%', 'Paid'),
(22000810, 'Suresh Patel', '93%', '61%', 'Paid'),
(22000811, 'Kamlesh Sharma', '88%', '59%', 'Paid'),
(22000812, 'Suresh Singh', '92%', '60%', 'Paid'),
(22000813, 'Rakesh Patel', '87%', '58%', 'Paid'),
(22000814, 'Sunil Agarwal', '91%', '59%', 'Paid'),
(22000815, 'Ajay Jain', '86%', '58%', 'Not Paid'),
(22000981, 'Yuvaraj Singh', '65%', '34%', 'Not Paid'),
(22000982, 'Riya Shah', '56%', '82%', 'Not Paid'),
(23000142, 'Keya Patel', '86%', '56%', 'Paid'),
(23000143, 'Anya Sharma', '90%', '60%', 'Paid'),
(23000144, 'Ishaan Singh', '85%', '58%', 'Paid'),
(23000145, 'Riya Patel', '88%', '59%', 'Paid'),
(23000146, 'Aryan Agarwal', '92%', '61%', 'Paid'),
(23000147, 'Maya Jain', '87%', '59%', 'Paid'),
(23000148, 'Dev Patel', '91%', '60%', 'Paid'),
(23000149, 'Priya Sharma', '86%', '58%', 'Paid'),
(23000150, 'Rahul Singh', '89%', '59%', 'Paid'),
(23000151, 'Neha Patel', '93%', '61%', 'Paid'),
(23000152, 'Anish Agarwal', '88%', '59%', 'Paid'),
(23000153, 'Nikita Jain', '92%', '60%', 'Paid'),
(23000154, 'Karan Patel', '87%', '58%', 'Paid'),
(23000155, 'Rishi Sharma', '91%', '59%', 'Paid'),
(23000156, 'Sonu Singh', '86%', '58%', 'Paid'),
(23000157, 'Anjali Patel', '89%', '59%', 'Paid'),
(23000158, 'Rajesh Agarwal', '93%', '61%', 'Paid'),
(23000159, 'Monisha Jain', '88%', '59%', 'Paid'),
(23000160, 'Vikram Patel', '92%', '60%', 'Paid'),
(23000161, 'Rakesh Sharma', '87%', '58%', 'Paid'),
(23000162, 'Sunil Singh', '91%', '59%', 'Paid'),
(23000163, 'Ajay Patel', '86%', '58%', 'Paid'),
(23000164, 'Ramesh Agarwal', '89%', '59%', 'Paid'),
(23000165, 'Suresh Jain', '93%', '61%', 'Paid'),
(23000166, 'Kamlesh Patel', '88%', '59%', 'Paid'),
(23000167, 'Suresh Sharma', '92%', '60%', 'Paid'),
(23000168, 'Rakesh Singh', '87%', '58%', 'Paid'),
(23000169, 'Sunil Patel', '91%', '59%', 'Paid'),
(23000170, 'Ajay Agarwal', '86%', '58%', 'Paid'),
(23000171, 'Ramesh Jain', '89%', '59%', 'Paid'),
(23000172, 'Suresh Patel', '93%', '61%', 'Paid'),
(23000174, 'Suresh Singh', '92%', '60%', 'Paid'),
(23000175, 'Rakesh Patel', '87%', '58%', 'Paid'),
(23000216, 'Keyan Engineer', '75%', '45%', 'Paid'),
(23000693, 'Kento Bento', '49%', '54%', 'Not Paid'),
(24000214, 'Vidhi Patel', '93%', '82%', 'Not Paid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stu_enrollment_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
