-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 04:23 AM
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
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `duration` int(11) NOT NULL,
  `booking_status` varchar(20) DEFAULT NULL,
  `total_payment` int(11) NOT NULL,
  `payment_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `customer_id`, `date_in`, `date_out`, `duration`, `booking_status`, `total_payment`, `payment_status`) VALUES
('b6485beb5c3810', '[\"c64589f6408656\"]', '2023-06-13', '2023-06-16', 4, 'Confirmed', 4000000, 'true'),
('b6485df41ac4c9', '[\"c64639473b3a55\"]', '2023-06-11', '2023-06-13', 3, 'Staying', 2400000, 'true');

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
('c645887aa707ad', 'Testla', 'YOUR', '2001-06-07', '1232', 'tese@ds', 'tes123'),
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
('r645fa0361833c', 'A-103', 'rt645e45e74e5a9', 'Occupied', 'b6485df41ac4c9'),
('r645fa058cf1e2', 'A-104', 'rt645e45f9a305c', 'Free', NULL),
('r645fa1962c973', 'A-105', 'rt645e46045d1e2', 'Booked', 'b6485beb5c3810'),
('r645fa1ac8cc62', 'B-101', 'rt645e45c73d72b', 'Free', NULL),
('r645fa41e4d89b', 'B-102', 'rt645e45e74e5a9', 'Free', NULL),
('r6485b71182519', 'B-103', 'rt645e45f9a305c', 'Free', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_log`
--

CREATE TABLE `room_log` (
  `room_log_id` int(11) NOT NULL,
  `booking_id` varchar(20) NOT NULL,
  `room_id` varchar(20) NOT NULL,
  `old_room_id` varchar(20) DEFAULT NULL,
  `time` date DEFAULT NULL,
  `action` varchar(20) NOT NULL,
  `memo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_log`
--

INSERT INTO `room_log` (`room_log_id`, `booking_id`, `room_id`, `old_room_id`, `time`, `action`, `memo`) VALUES
(65, 'b6485beb5c3810', 'r645fa058cf1e2', NULL, '2023-06-11', 'Reserved', ''),
(66, 'b6485df41ac4c9', 'r645fa0361833c', NULL, '2023-06-11', 'Reserved', ''),
(68, 'b6485df41ac4c9', 'r645fa0361833c', NULL, '2023-06-11', 'Checked In', '');

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
-- Indexes for table `room_log`
--
ALTER TABLE `room_log`
  ADD PRIMARY KEY (`room_log_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`room_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room_log`
--
ALTER TABLE `room_log`
  MODIFY `room_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
