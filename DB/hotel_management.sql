-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2023 at 07:58 PM
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
  `emp_ID` int(11) DEFAULT NULL,
  `booked_room` varchar(30) DEFAULT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `duration` int(11) NOT NULL,
  `booking_status` varchar(20) DEFAULT NULL,
  `total_payment` int(11) NOT NULL,
  `payment_option` varchar(10) DEFAULT NULL,
  `payment_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `customer_id`, `emp_ID`, `booked_room`, `date_in`, `date_out`, `duration`, `booking_status`, `total_payment`, `payment_option`, `payment_status`) VALUES
('b6492a41eeb485', '[\"c64639473b3a55\"]', 2, 'r645f9fcb6ad67', '2023-06-23', '2023-06-30', 7, 'Finished', 3500000, 'OnePay', 'Paid'),
('b64950a7a93bff', '[\"c64639473b3a55\"]', 2, 'r645fa058cf1e2', '2023-06-24', '2023-07-03', 10, 'Finished', 10000000, 'Cash', 'Paid'),
('b649eee1e368f7', '[\"c64589f6408656\"]', 2, 'r6485b71182519', '2023-06-30', '2023-07-02', 2, 'Cancelled', 2000000, 'Cash', 'Paid'),
('b64a427c9846ab', '[\"c645887aa707ad\"]', 2, 'r645f947e1df75', '2023-07-06', '2023-07-08', 2, 'Finished', 1000000, 'Cash', 'Paid'),
('b64a442269152f', '[\"c64589f6408656\"]', 2, 'r645fa1ac8cc62', '2023-07-05', '2023-07-08', 4, 'Finished', 2000000, 'OnePay', 'Paid'),
('b64a5813b6887e', '[\"c64589f6408656\",\"c6458aa2b43ead\"]', 2, 'r645fa41e4d89b', '2023-07-05', '2023-07-10', 5, 'Finished', 4000000, 'OnePay', 'Paid'),
('b64a65014ddcbb', '[\"c64589f6408656\"]', 2, 'r645fa058cf1e2', '2023-07-11', '2023-07-13', 2, 'Finished', 2000000, 'OnePay', 'Paid'),
('b64b2ae0fca97c', '[\"c6459d7400beb9\"]', 2, 'r645fa058cf1e2', '2023-07-15', '2023-07-18', 3, 'Finished', 3000000, 'Cash', 'Paid'),
('b64b545aea9608', '[\"c645887aa707ad\"]', 2, 'r645f947e1df75', '2023-07-17', '2023-07-19', 2, 'Finished', 1500000, 'Cash', 'Paid'),
('b64b5491dc360f', '[\"c64b5490417ba5\"]', 2, 'r645fa41e4d89b', '2023-07-16', '2023-07-19', 3, 'Finished', 2400000, 'Cash', 'Paid'),
('b64b7aa20c8a2c', '[\"c6459d7400beb9\"]', 2, 'r645fa1962c973', '2023-07-17', '2023-07-19', 2, 'Finished', 2400000, 'Cash', 'Paid'),
('b64b7c32fe31af', '[\"c64b5490417ba5\"]', 2, 'r645fa1ac8cc62', '2023-07-19', '2023-07-22', 3, 'Finished', 2400000, 'Cash', 'Paid'),
('b64b81e7480100', '[\"c64589f6408656\"]', 2, 'r645f9fcb6ad67', '2023-07-20', '2023-07-25', 5, 'Finished', 2500000, 'OnePay', 'Paid'),
('b64b821900a7cd', '[\"c6458aaab497b9\"]', 2, 'r645fa058cf1e2', '2023-07-21', '2023-07-23', 2, 'Cancelled', 2000000, '', 'Unpaid'),
('b64bece4c3d7bf', '[\"c6458a8283bd3d\"]', 2, 'r645fa0361833c', '2023-07-25', '2023-07-29', 4, 'Finished', 3200000, 'Cash', 'Paid'),
('b64c10753260e1', '[\"c64bfec4ddc3c6\"]', 5, 'r64c100a1a567b', '2023-07-26', '2023-07-31', 5, 'Staying', 2500000, 'Cash', 'Paid'),
('b64c107915b4da', '[\"c6458a8283bd3d\"]', 5, 'r64c100ed06d02', '2023-07-26', '2023-07-28', 2, 'Finished', 1000000, 'Cash', 'Paid'),
('b64c107c03f0f7', '[\"c6458aa2b43ead\"]', 5, 'r64c100f968893', '2023-07-27', '2023-07-29', 2, 'Finished', 1000000, 'Cash', 'Paid'),
('b64c107de1556d', '[\"c64b5490417ba5\"]', 2, 'r64c10294b5e2d', '2023-07-27', '2023-07-30', 3, 'Finished', 1500000, 'Cash', 'Paid'),
('b64c11009821c5', '[\"c645887aa707ad\"]', 1, 'r645fa1ac8cc62', '2023-07-26', '2023-07-31', 5, 'Staying', 4000000, 'Cash', 'Paid'),
('b64c110caaac9d', '[\"c645887aa707ad\"]', 1, 'r645fa41e4d89b', '2023-07-28', '2023-08-02', 5, 'Staying', 4000000, 'OnePay', 'Paid'),
('b64c1113f10573', '[\"c6458aa2b43ead\"]', 2, 'r64c103cdea3cf', '2023-07-28', '2023-07-31', 3, 'Staying', 2400000, 'Cash', 'Paid'),
('b64c11269ecbbb', '[\"c645887aa707ad\"]', 1, 'r64c10409bf04d', '2023-07-28', '2023-07-29', 1, 'Finished', 1000000, 'Cash', 'Paid'),
('b64c112ce1026e', '[\"c64c112b3bfc9a\"]', 5, 'r64c103d68336a', '2023-07-30', '2023-08-02', 3, 'Staying', 2400000, 'Cash', 'Deposit'),
('b64c1132e7465d', '[\"c6458aaab497b9\"]', 1, 'r64c103e7e092a', '2023-07-26', '2023-07-28', 2, 'Finished', 1600000, 'OnePay', 'Paid'),
('b64c1136d45605', '[\"c64589f6408656\"]', 2, 'r64c103eeaed3a', '2023-07-27', '2023-07-28', 1, 'Finished', 800000, 'Cash', 'Paid'),
('b64c1139911bee', '[\"c64bfec4ddc3c6\"]', 2, 'r64c10410ec048', '2023-07-29', '2023-07-31', 2, 'Staying', 2000000, 'Cash', 'Deposit'),
('b64c4dd1a3fbcb', '[\"c645887aa707ad\"]', 1, 'r645fa1962c973', '2023-07-29', '2023-07-31', 2, 'Staying', 1000000, 'Cash', 'Deposit');

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
('c64589f6408656', 'Your', 'Hell', '2023-05-06', '2332', 'eew@hb', '324324'),
('c6458a8283bd3d', 'AAA', 'HHH', '2023-07-12', '2355323', 'sdffd@fgs', '234fs3522'),
('c6458aa2b43ead', 'DD', 'FFF', '2023-05-03', '43234', 'dsd@ge', '323fds22'),
('c6458aaab497b9', 'SSSS', 'FFF', '', '23', 'd23@ga', 'fds342'),
('c64639473b3a55', 'Danny', 'Lee', '2023-05-08', '43234', 'danny@gmail.com', '1102383922'),
('c64b5490417ba5', 'Vanh', 'Keovilay', '2023-01-11', '2332', 'danny@gmail.com', '323fds22'),
('c64bfec4ddc3c6', 'Hitdach', 'Dello', '', '323', 'sd@dd', 'gda'),
('c64c112b3bfc9a', 'RT', 'Test', '2004-10-24', '33255323', 'dsd@ge', '2355332');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_ID` int(11) NOT NULL,
  `emp_Name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `emp_ID_Card` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `position` varchar(30) NOT NULL,
  `salary` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_ID`, `emp_Name`, `gender`, `emp_ID_Card`, `phone`, `email`, `position`, `salary`) VALUES
(1, 'Indian Jones', 'Male', '239204', '30294453', 'diso@gmail.com', 'Manager', 8000000),
(2, 'Hello World', 'Male', '209422', '30980923', 'uisle@gmail.com', 'Receptionist', 4000000),
(5, 'Tess Dewin', 'Female', '233902', '3902d34', 'dkak@gmail.com', 'Receptionist', 3500000),
(7, 'Italio HE', 'Female', 's23234', '23425323', 'ada@gnn', 'Receptionist', 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` varchar(20) NOT NULL,
  `room_name` varchar(10) NOT NULL,
  `room_type_id` varchar(20) NOT NULL,
  `room_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `room_type_id`, `room_status`) VALUES
('r645f947e1df75', 'A-101', 'rt645e45c73d72b', 'Free'),
('r645f9fcb6ad67', 'A-102', 'rt645e45c73d72b', 'Free'),
('r645fa0361833c', 'A-103', 'rt645e45c73d72b', 'Free'),
('r645fa058cf1e2', 'A-104', 'rt645e45c73d72b', 'Free'),
('r645fa1962c973', 'A-105', 'rt645e45c73d72b', 'Occupied'),
('r645fa1ac8cc62', 'B-101', 'rt645e45e74e5a9', 'Occupied'),
('r645fa41e4d89b', 'B-102', 'rt645e45e74e5a9', 'Occupied'),
('r6485b71182519', 'B-103', 'rt645e45e74e5a9', 'Reserved'),
('r64c100a1a567b', 'A-106', 'rt645e45c73d72b', 'Occupied'),
('r64c100ed06d02', 'A-107', 'rt645e45c73d72b', 'Free'),
('r64c100f968893', 'A-108', 'rt645e45c73d72b', 'Free'),
('r64c10294b5e2d', 'A-109', 'rt645e45c73d72b', 'Free'),
('r64c103cdea3cf', 'B-104', 'rt645e45e74e5a9', 'Occupied'),
('r64c103d68336a', 'B-105', 'rt645e45e74e5a9', 'Occupied'),
('r64c103e7e092a', 'B-106', 'rt645e45e74e5a9', 'Free'),
('r64c103eeaed3a', 'B-107', 'rt645e45e74e5a9', 'Free'),
('r64c10409bf04d', 'C-101', 'rt645e45f9a305c', 'Free'),
('r64c10410ec048', 'C-102', 'rt645e45f9a305c', 'Occupied');

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

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `booking_id` varchar(20) NOT NULL,
  `room_id` varchar(20) NOT NULL,
  `old_room_id` varchar(20) DEFAULT NULL,
  `time` date DEFAULT NULL,
  `action` varchar(20) NOT NULL,
  `memo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `booking_id`, `room_id`, `old_room_id`, `time`, `action`, `memo`) VALUES
(71, 'b6492a41eeb485', 'r645f9fcb6ad67', NULL, '2023-06-21', 'Reserved', ''),
(72, 'b64950a7a93bff', 'r645fa058cf1e2', NULL, '2023-06-23', 'Reserved', ''),
(73, 'b6492a41eeb485', 'r645f9fcb6ad67', NULL, '2023-06-23', 'Checked In', ''),
(74, 'b64950a7a93bff', 'r645fa058cf1e2', NULL, '2023-06-24', 'Checked In', ''),
(75, 'b6492a41eeb485', 'r645f9fcb6ad67', NULL, '2023-06-30', 'Checked Out', ''),
(76, 'b649eee1e368f7', 'r6485b71182519', NULL, '2023-06-30', 'Reserved', ''),
(77, 'b649eee1e368f7', 'r6485b71182519', NULL, '2023-07-02', 'Cancelled', ''),
(78, 'b64950a7a93bff', 'r645fa058cf1e2', NULL, '2023-07-03', 'Checked Out', ''),
(79, 'b64a427c9846ab', 'r645f947e1df75', NULL, '2023-07-04', 'Reserved', ''),
(82, 'b64a442269152f', 'r645fa1ac8cc62', NULL, '2023-07-04', 'Reserved', ''),
(83, 'b64a442269152f', 'r645fa1ac8cc62', NULL, '2023-07-05', 'Checked In', ''),
(84, 'b64a5813b6887e', 'r645fa41e4d89b', NULL, '2023-07-05', 'Reserved', ''),
(89, 'b64a5813b6887e', 'r645fa41e4d89b', NULL, '2023-07-05', 'Checked In', ''),
(90, 'b64a427c9846ab', 'r645f947e1df75', NULL, '2023-07-06', 'Checked In', ''),
(93, 'b64a65014ddcbb', 'r645fa058cf1e2', NULL, '2023-07-06', 'Reserved', ''),
(95, 'b64a427c9846ab', 'r645f947e1df75', NULL, '2023-07-08', 'Checked Out', ''),
(96, 'b64a442269152f', 'r645fa1ac8cc62', NULL, '2023-07-08', 'Checked Out', ''),
(97, 'b64a65014ddcbb', 'r645fa058cf1e2', NULL, '2023-07-11', 'Checked In', ''),
(98, 'b64a65014ddcbb', 'r645fa058cf1e2', NULL, '2023-07-13', 'Checked Out', ''),
(99, 'b64a5813b6887e', 'r645fa41e4d89b', NULL, '2023-07-10', 'Checked Out', ''),
(100, 'b64b2ae0fca97c', 'r6485b71182519', NULL, '2023-07-15', 'Reserved', ''),
(101, 'b64b2ae0fca97c', 'r6485b71182519', NULL, '2023-07-15', 'Checked In', ''),
(104, 'b64b2ae0fca97c', 'r6485b71182519', NULL, '2023-07-18', 'Checked Out', ''),
(106, 'b64a653bf37557', 'r645f9fcb6ad67', NULL, '2023-07-17', 'Checked In', ''),
(107, 'b64b545aea9608', 'r645f947e1df75', NULL, '2023-07-17', 'Reserved', ''),
(108, 'b64b545aea9608', 'r645f947e1df75', NULL, '2023-07-17', 'Checked In', ''),
(109, 'b64b5491dc360f', 'r645fa0361833c', NULL, '2023-07-12', 'Reserved', ''),
(110, 'b64b5491dc360f', 'r645fa0361833c', NULL, '2023-07-16', 'Checked In', ''),
(111, 'b64b5491dc360f', 'r645fa41e4d89b', 'r645fa0361833c', '2023-07-17', 'Moved', ''),
(112, 'b64b5491dc360f', 'r645fa41e4d89b', NULL, '2023-07-19', 'Checked Out', ''),
(113, 'b64b7aa20c8a2c', 'r645fa1962c973', NULL, '2023-07-15', 'Reserved', ''),
(114, 'b64b7aa20c8a2c', 'r645fa1962c973', NULL, '2023-07-17', 'Checked In', ''),
(115, 'b64b7aa20c8a2c', 'r645fa1962c973', NULL, '2023-07-19', 'Checked Out', ''),
(120, 'b64b545aea9608', 'r645f947e1df75', NULL, '2023-07-19', 'Checked Out', ''),
(121, 'b64b7c32fe31af', 'r645fa1ac8cc62', NULL, '2023-07-19', 'Reserved', ''),
(122, 'b64b7c32fe31af', 'r645fa1ac8cc62', NULL, '2023-07-19', 'Checked In', ''),
(123, 'b64b81e7480100', 'r645f9fcb6ad67', NULL, '2023-07-19', 'Reserved', ''),
(126, 'b64b81e7480100', 'r645f9fcb6ad67', NULL, '2023-07-20', 'Checked In', ''),
(127, 'b64b821900a7cd', 'r645fa058cf1e2', NULL, '2023-07-19', 'Reserved', ''),
(128, 'b64b821900a7cd', 'r645fa058cf1e2', NULL, '2023-07-20', 'Cancelled', 'Changed to new hotel'),
(129, 'b64b7c32fe31af', 'r645fa1ac8cc62', NULL, '2023-07-22', 'Checked Out', ''),
(130, 'b64bece4c3d7bf', 'r645fa0361833c', NULL, '2023-07-24', 'Reserved', ''),
(131, 'b64bece4c3d7bf', 'r645fa0361833c', NULL, '2023-07-25', 'Checked In', ''),
(132, 'b64b81e7480100', 'r645f9fcb6ad67', NULL, '2023-07-25', 'Checked Out', ''),
(133, 'b64c10753260e1', 'r64c100a1a567b', NULL, '2023-07-26', 'Reserved', ''),
(134, 'b64c107915b4da', 'r64c100ed06d02', NULL, '2023-07-26', 'Reserved', ''),
(135, 'b64c107c03f0f7', 'r64c100f968893', NULL, '2023-07-26', 'Reserved', ''),
(136, 'b64c107de1556d', 'r64c10294b5e2d', NULL, '2023-07-26', 'Reserved', ''),
(137, 'b64c11009821c5', 'r645fa1ac8cc62', NULL, '2023-07-26', 'Reserved', ''),
(138, 'b64c110caaac9d', 'r645fa41e4d89b', NULL, '2023-07-26', 'Reserved', ''),
(139, 'b64c110db82212', 'r6485b71182519', NULL, '2023-07-26', 'Reserved', ''),
(140, 'b64c10753260e1', 'r64c100a1a567b', NULL, '2023-07-26', 'Checked In', ''),
(141, 'b64c107915b4da', 'r64c100ed06d02', NULL, '2023-07-26', 'Checked In', ''),
(142, 'b64c11009821c5', 'r645fa1ac8cc62', NULL, '2023-07-26', 'Checked In', ''),
(143, 'b64c1113f10573', 'r64c103cdea3cf', NULL, '2023-07-26', 'Reserved', ''),
(144, 'b64c11269ecbbb', 'r64c10409bf04d', NULL, '2023-07-26', 'Reserved', ''),
(145, 'b64c112ce1026e', 'r64c103d68336a', NULL, '2023-07-26', 'Reserved', ''),
(146, 'b64c1132e7465d', 'r64c103e7e092a', NULL, '2023-07-26', 'Reserved', ''),
(147, 'b64c1136d45605', 'r64c103eeaed3a', NULL, '2023-07-26', 'Reserved', ''),
(148, 'b64c1139911bee', 'r64c10410ec048', NULL, '2023-07-26', 'Reserved', ''),
(149, 'b64c1132e7465d', 'r64c103e7e092a', NULL, '2023-07-26', 'Checked In', ''),
(150, 'b64c107c03f0f7', 'r64c100f968893', NULL, '2023-07-27', 'Checked In', ''),
(151, 'b64c107de1556d', 'r64c10294b5e2d', NULL, '2023-07-27', 'Checked In', ''),
(152, 'b64c1136d45605', 'r64c103eeaed3a', NULL, '2023-07-27', 'Checked In', ''),
(153, 'b64c110caaac9d', 'r645fa41e4d89b', NULL, '2023-07-28', 'Checked In', ''),
(154, 'b64c1113f10573', 'r64c103cdea3cf', NULL, '2023-07-28', 'Checked In', ''),
(155, 'b64c107915b4da', 'r64c100ed06d02', NULL, '2023-07-28', 'Checked Out', ''),
(156, 'b64c1132e7465d', 'r64c103e7e092a', NULL, '2023-07-28', 'Checked Out', ''),
(157, 'b64c1136d45605', 'r64c103eeaed3a', NULL, '2023-07-28', 'Checked Out', ''),
(158, 'b64c11269ecbbb', 'r64c10409bf04d', NULL, '2023-07-28', 'Checked In', ''),
(159, 'b64bece4c3d7bf', 'r645fa0361833c', NULL, '2023-07-29', 'Checked Out', ''),
(160, 'b64c107c03f0f7', 'r64c100f968893', NULL, '2023-07-29', 'Checked Out', ''),
(161, 'b64c11269ecbbb', 'r64c10409bf04d', NULL, '2023-07-29', 'Checked Out', ''),
(162, 'b64c1139911bee', 'r64c10410ec048', NULL, '2023-07-29', 'Checked In', ''),
(163, 'b64c4dd1a3fbcb', 'r645fa1962c973', NULL, '2023-07-29', 'Reserved', ''),
(164, 'b64c4dd1a3fbcb', 'r645fa1962c973', NULL, '2023-07-29', 'Checked In', ''),
(165, 'b64c107de1556d', 'r64c10294b5e2d', NULL, '2023-07-30', 'Checked Out', ''),
(166, 'b64c112ce1026e', 'r64c103d68336a', NULL, '2023-07-30', 'Checked In', '');

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
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_ID`);

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
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
