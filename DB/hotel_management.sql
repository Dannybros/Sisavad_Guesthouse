-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 02:33 PM
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
-- Database: `hotel_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` varchar(30) NOT NULL,
  `customer_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`customer_id`)),
  `date_check_in` date NOT NULL,
  `date_check_out` date NOT NULL,
  `duration` int(11) NOT NULL,
  `total_payment` int(11) NOT NULL,
  `payment_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `customer_id`, `date_check_in`, `date_check_out`, `duration`, `total_payment`, `payment_status`) VALUES
('b646ef0cdddace', '[\"c64589f6408656\"]', '2023-05-26', '2023-05-28', 2, 1000000, 'true'),
('b6474ac25b59ec', '[\"c645887aa707ad\",\"c6458aa2b43ead\"]', '2023-05-29', '2023-06-01', 3, 2400000, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `booking_log`
--

CREATE TABLE `booking_log` (
  `booking_log_id` int(11) NOT NULL,
  `booking_id` varchar(20) NOT NULL,
  `room_id` varchar(20) NOT NULL,
  `time` date DEFAULT NULL,
  `booking_status` varchar(20) NOT NULL,
  `memo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_log`
--

INSERT INTO `booking_log` (`booking_log_id`, `booking_id`, `room_id`, `time`, `booking_status`, `memo`) VALUES
(1, 'b646ef0cdddace', 'r645f947e1df75', '2023-05-25', 'Reserved', ''),
(2, 'b646ef0cdddace', 'r645f947e1df75', '2023-05-26', 'Checked In', ''),
(4, 'b646ef0cdddace', 'r645f9fcb6ad67', '2023-05-27', 'Moved', ''),
(7, 'b646ef0cdddace', 'r645f9fcb6ad67', '2023-05-28', 'Checked Out', ''),
(8, 'b6474ac25b59ec', 'r645fa0361833c', '2023-05-29', 'Reserved', ''),
(9, 'b6474ac25b59ec', 'r645fa0361833c', '2023-05-29', 'Checked In', ''),
(10, 'b6474ac25b59ec', 'r645fa0361833c', '2023-06-01', 'Checked Out', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` varchar(20) NOT NULL,
  `cust_name` varchar(30) NOT NULL,
  `cust_firstname` varchar(30) NOT NULL,
  `cust_bd` varchar(20) NOT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `passport` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_firstname`, `cust_bd`, `contact`, `email`, `passport`) VALUES
('c645887aa707ad', 'Testla', 'YOUR', '', '1232', 'tese@ds', 'tes123'),
('c64589f6408656', 'Holy', 'FUCK', '2023-05-06', '2332', 'eew@hb', '324324'),
('c6458a8283bd3d', 'as232', 'hhh', '', '2355323', 'sdffd@fgs', '234fs3522'),
('c6458aa2b43ead', 'DD', 'ff', '2023-05-03', '43234', 'dsd@ge', '323fds22'),
('c6458aaab497b9', 'adfa', 'fdwg', '', '23', 'd23@ga', 'fds342'),
('c6459d7400beb9', 'hers', 'das', '', '323', 'sd@dd', 'gda'),
('c64639473b3a55', 'Danny', 'Lee', '2023-05-08', '43234', 'danny@gmail.com', '1102383922');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` varchar(20) NOT NULL,
  `room_name` varchar(10) NOT NULL,
  `room_type_id` varchar(20) NOT NULL,
  `room_status` varchar(10) NOT NULL,
  `booking_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `room_type_id`, `room_status`, `booking_id`) VALUES
('r645f947e1df75', 'A-101', 'rt645e45c73d72b', 'Free', NULL),
('r645f9fcb6ad67', 'A-102', 'rt645e45c73d72b', 'Free', NULL),
('r645fa0361833c', 'A-103', 'rt645e45e74e5a9', 'Free', NULL),
('r645fa058cf1e2', 'A-104', 'rt645e45f9a305c', 'Free', NULL),
('r645fa1962c973', 'A-105', 'rt645e46045d1e2', 'Free', NULL),
('r645fa1ac8cc62', 'B-101', 'rt645e45c73d72b', 'Free', NULL),
('r645fa41e4d89b', 'B-102', 'rt645e45e74e5a9', 'Free', NULL),
('r645fa43bc824f', 'B-103', 'rt645e45e74e5a9', 'Free', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `room_type_id` varchar(20) NOT NULL,
  `room_type_name` varchar(30) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`room_type_id`, `room_type_name`, `price`) VALUES
('rt645e45c73d72b', 'Single Room', 500000),
('rt645e45e74e5a9', 'Double Room', 800000),
('rt645e45f9a305c', 'Deluxe Room', 1000000),
('rt645e46045d1e2', 'VIP Room', 1200000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `booking_log`
--
ALTER TABLE `booking_log`
  ADD PRIMARY KEY (`booking_log_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`room_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_log`
--
ALTER TABLE `booking_log`
  MODIFY `booking_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
