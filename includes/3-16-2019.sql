-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2019 at 02:09 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `designbuild3`
--
CREATE DATABASE IF NOT EXISTS `designbuild3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `designbuild3`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `email`, `password`) VALUES
(1, '2@2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `user_id` int(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `appointment_status` text NOT NULL,
  `appointment_date` date NOT NULL,
  `admin_msg` text NOT NULL,
  `user_msg` text NOT NULL,
  `appointment_made` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`user_id`, `user_email`, `appointment_status`, `appointment_date`, `admin_msg`, `user_msg`, `appointment_made`) VALUES
(1, '2@2', 'None', '0000-00-00', '', '', '0000-00-00'),
(2, '2@2', 'None', '0000-00-00', '', '', '0000-00-00'),
(3, '2@2', 'None', '0000-00-00', '', '', '0000-00-00'),
(4, '2@2', 'None', '0000-00-00', '', '', '0000-00-00'),
(5, '2@2', 'None', '0000-00-00', '', '', '0000-00-00'),
(6, '2@22', 'None', '0000-00-00', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `available_location`
--

CREATE TABLE `available_location` (
  `loc_city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bd_upload`
--

CREATE TABLE `bd_upload` (
  `user_id` int(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `upload_img` text NOT NULL,
  `upload_details` text NOT NULL,
  `upload_location` varchar(255) NOT NULL,
  `upload_status` text NOT NULL,
  `upload_date` date NOT NULL,
  `upload_fee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_Id` int(11) NOT NULL,
  `Plan_Id` int(11) NOT NULL,
  `Category_Name` varchar(100) NOT NULL,
  `Category_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Category_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_Id`, `Plan_Id`, `Category_Name`, `Category_DateCreated`, `Category_Status`) VALUES
(2, 1, 'category 1234', '2019-02-17 03:38:47', 0),
(3, 1, 'category 2', '2019-02-17 03:42:13', 0),
(4, 2, 'Ground Floor Flooring', '2019-02-17 04:51:20', 0),
(5, 2, 'Category 2', '2019-02-17 04:51:26', 0),
(6, 4, 'asd', '2019-02-25 01:55:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `finish`
--

CREATE TABLE `finish` (
  `Finish_Id` int(11) NOT NULL,
  `Finish_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finish`
--

INSERT INTO `finish` (`Finish_Id`, `Finish_Name`) VALUES
(1, 'Rough'),
(2, 'Semi'),
(3, 'Visioner'),
(4, 'Elegant');

-- --------------------------------------------------------

--
-- Table structure for table `finishitem`
--

CREATE TABLE `finishitem` (
  `FinishItem_Id` int(11) NOT NULL,
  `Finish_Id` int(11) NOT NULL,
  `Plan_Id` int(11) NOT NULL,
  `Material_Id` int(11) NOT NULL DEFAULT '0',
  `Upgrade_Id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finishitem`
--

INSERT INTO `finishitem` (`FinishItem_Id`, `Finish_Id`, `Plan_Id`, `Material_Id`, `Upgrade_Id`) VALUES
(14, 1, 1, 21, 0),
(21, 2, 1, 20, 0),
(23, 2, 1, 0, 3),
(24, 2, 1, 21, 0),
(25, 1, 1, 0, 6),
(29, 1, 1, 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `Image_Id` int(11) NOT NULL,
  `Image_Name` varchar(20) NOT NULL,
  `Image_Table` varchar(20) NOT NULL,
  `Image_TableId` int(11) NOT NULL,
  `Image_Size` varchar(10) NOT NULL,
  `Image_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Image_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`Image_Id`, `Image_Name`, `Image_Table`, `Image_TableId`, `Image_Size`, `Image_DateCreated`, `Image_Status`) VALUES
(1, '1.jpg', 'plan', 1, 'original', '2019-02-17 01:05:32', 0),
(2, '2.jpg', 'plan', 2, 'original', '2019-02-17 04:51:10', 0),
(3, '3.jpg', 'material', 16, 'original', '2019-02-17 08:59:55', 0),
(4, '4.jpg', 'material', 17, 'original', '2019-02-17 09:00:30', 0),
(5, '5.jpg', 'material', 19, 'original', '2019-02-17 09:31:13', 0),
(6, '6.jpg', 'upgrade', 1, 'original', '2019-02-17 09:47:41', 0),
(7, '7.jpg', 'upgrade', 2, 'original', '2019-02-17 09:53:42', 0),
(8, '8.jpg', 'upgrade', 3, 'original', '2019-02-17 09:53:50', 0),
(9, '9.jpg', 'upgrade', 3, 'original', '2019-02-17 09:59:57', 0),
(10, '10.jpg', 'upgrade', 3, 'original', '2019-02-17 10:00:43', 0),
(11, '11.jpg', 'upgrade', 5, 'original', '2019-02-17 10:01:13', 0),
(12, '12.jpg', 'material', 20, 'original', '2019-02-17 10:01:33', 0),
(13, '13.jpg', 'material', 21, 'original', '2019-02-18 05:39:45', 0),
(14, '14.jpg', 'payment', 1, 'original', '2019-02-18 13:19:42', 0),
(15, '15.jpg', 'payment', 2, 'original', '2019-02-20 02:58:18', 0),
(16, '16.jpg', 'services', 1, 'original', '2019-02-25 03:06:34', 0),
(17, '17.jpg', 'services', 2, 'original', '2019-02-25 03:44:23', 0),
(18, '18.jpg', 'services', 3, 'original', '2019-02-25 05:54:17', 0),
(19, '19.jpg', 'services', 0, 'original', '2019-02-25 06:02:01', 0),
(20, '20.jpg', 'services', 2, 'original', '2019-02-25 06:04:50', 0),
(21, '21.jpg', 'payment', 4, 'original', '2019-02-25 06:48:43', 0),
(22, '22.jpg', 'payment', 5, 'original', '2019-02-25 07:32:20', 0),
(23, '23.jpg', 'plan', 1, 'original', '2019-02-25 07:51:26', 0),
(24, '24.jpg', 'plan', 1, 'original', '2019-02-25 08:03:18', 0),
(25, '25.jpg', 'upload', 1, 'original', '2019-03-02 06:56:50', 0),
(26, '26.jpg', 'upload', 2, 'original', '2019-03-02 06:58:12', 0),
(27, '27.jpg', 'payment', 2, 'original', '2019-03-03 00:46:59', 0),
(28, '28.jpg', 'payment', 3, 'original', '2019-03-03 00:57:14', 0),
(29, '29.jpg', 'services', 3, 'original', '2019-03-03 01:17:05', 0),
(30, '30.jpg', 'services', 3, 'original', '2019-03-03 01:17:16', 0),
(31, '31.jpg', 'upload', 3, 'original', '2019-03-03 09:18:24', 0),
(32, '32.jpg', 'payment', 4, 'original', '2019-03-03 09:18:50', 0),
(33, '33.jpg', 'material', 22, 'original', '2019-03-05 21:02:13', 0),
(34, '34.jpg', 'material', 23, 'original', '2019-03-05 21:03:22', 0),
(35, '35.jpg', 'upgrade', 7, 'original', '2019-03-05 21:12:34', 0),
(36, '36.jpg', 'upgrade', 8, 'original', '2019-03-05 21:12:52', 0),
(37, '37.jpg', 'payment', 5, 'original', '2019-03-05 21:24:54', 0),
(38, '38.jpg', 'payment', 6, 'original', '2019-03-05 21:31:59', 0),
(39, '39.jpg', 'payment', 7, 'original', '2019-03-05 21:34:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `Material_Id` int(11) NOT NULL,
  `Part_Id` int(11) NOT NULL,
  `Material_Name` varchar(100) NOT NULL,
  `Material_Description` text NOT NULL,
  `Material_Price` decimal(10,0) NOT NULL,
  `Material_PriceType` tinyint(1) NOT NULL DEFAULT '0',
  `Material_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Material_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`Material_Id`, `Part_Id`, `Material_Name`, `Material_Description`, `Material_Price`, `Material_PriceType`, `Material_DateCreated`, `Material_Status`) VALUES
(17, 4, 'Material 2', ' Material 2 Description', '0', 0, '2019-02-17 09:00:30', 0),
(19, 4, 'Material 1', ' Material Desciption', '123', 0, '2019-02-17 09:10:39', 0),
(20, 4, 'Material 3', ' Material 3 Material 3Material 3', '3456', 0, '2019-02-17 10:01:33', 0),
(21, 7, 'Material 1 - 3', ' Material 1 - 3 Material 1 - 3', '1307', 1, '2019-02-18 05:39:45', 0),
(23, 7, 'Material 4', ' Material 4 Piece', '43', 1, '2019-03-05 21:03:22', 0),
(24, 9, 'mat1', ' asd', '12', 0, '2019-03-06 11:20:43', 0),
(25, 9, 'mat2', ' ', '200', 1, '2019-03-06 11:21:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `Part_Id` int(11) NOT NULL,
  `Category_Id` int(11) NOT NULL,
  `Part_Name` varchar(100) NOT NULL,
  `Part_Area` decimal(10,2) NOT NULL,
  `Part_Piece` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Part_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Part_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`Part_Id`, `Category_Id`, `Part_Name`, `Part_Area`, `Part_Piece`, `Part_DateCreated`, `Part_Status`) VALUES
(3, 4, 'Part 1', '1.00', '0.00', '2019-02-17 07:14:13', 0),
(4, 2, 'Part 1', '0.00', '0.00', '2019-02-17 07:25:42', 0),
(7, 2, 'Part 3', '320.00', '13.00', '2019-02-17 08:16:57', 0),
(8, 2, 'Part 4', '120.00', '20.00', '2019-03-05 20:53:02', 0),
(9, 2, 'try', '100.00', '12.00', '2019-03-06 11:20:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_Id` int(11) NOT NULL,
  `Project_Id` int(11) NOT NULL,
  `Payment_ReceiptDate` date NOT NULL,
  `PaymentType_Id` int(11) NOT NULL,
  `Payment_ReceiptStatus` tinyint(4) NOT NULL DEFAULT '0',
  `Payment_AppointmentDate` date DEFAULT NULL,
  `Payment_AppointmentStatus` tinyint(4) NOT NULL DEFAULT '0',
  `Place_Id` int(11) NOT NULL,
  `Payment_PlaceStatus` tinyint(1) NOT NULL DEFAULT '0',
  `Payment_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Payment_Status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_Id`, `Project_Id`, `Payment_ReceiptDate`, `PaymentType_Id`, `Payment_ReceiptStatus`, `Payment_AppointmentDate`, `Payment_AppointmentStatus`, `Place_Id`, `Payment_PlaceStatus`, `Payment_DateCreated`, `Payment_Status`) VALUES
(1, 1, '2019-02-07', 0, 1, '2019-02-09', 1, 2, 0, '2019-02-18 13:19:42', 0),
(3, 5, '2019-03-04', 4, 0, '0000-00-00', 0, 0, 0, '2019-03-03 00:57:14', 0),
(4, 11, '2019-03-13', 2, 0, '0000-00-00', 0, 0, 0, '2019-03-03 09:18:50', 0),
(7, 3, '2019-03-11', 2, 0, '0000-00-00', 0, 0, 0, '2019-03-05 21:34:53', 0),
(8, 14, '2019-03-06', 4, 1, '2019-03-07', 1, 1, 0, '2019-03-06 11:11:19', 0),
(9, 2, '2019-03-14', 2, 1, '0000-00-00', 0, 0, 0, '2019-03-06 11:19:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `paymenttype`
--

CREATE TABLE `paymenttype` (
  `PaymentType_Id` int(11) NOT NULL,
  `PaymentType_Name` varchar(100) NOT NULL,
  `PaymentType_Status` tinyint(1) NOT NULL,
  `PaymentType_DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymenttype`
--

INSERT INTO `paymenttype` (`PaymentType_Id`, `PaymentType_Name`, `PaymentType_Status`, `PaymentType_DateCreated`) VALUES
(2, 'BPI', 0, '2019-02-20 09:44:07'),
(4, 'BDO', 0, '2019-02-20 10:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `user_id` int(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `type_selected` varchar(255) NOT NULL,
  `pay_status` text NOT NULL,
  `payment_image` text NOT NULL,
  `image_date` date NOT NULL,
  `date_paid` date NOT NULL,
  `admin_comments` text NOT NULL,
  `user_comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`user_id`, `user_email`, `type_selected`, `pay_status`, `payment_image`, `image_date`, `date_paid`, `admin_comments`, `user_comments`) VALUES
(1, '2@2', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', ''),
(2, '2@2', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', ''),
(3, '2@2', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', ''),
(4, '2@2', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', ''),
(5, '2@2', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', ''),
(6, '2@22', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `type` varchar(255) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `Place_Id` int(11) NOT NULL,
  `Place_Name` varchar(500) NOT NULL,
  `Place_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Place_DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`Place_Id`, `Place_Name`, `Place_Status`, `Place_DateCreated`) VALUES
(1, 'Makati', 0, '2019-02-18 21:44:50'),
(2, 'Alabang', 0, '2019-02-18 21:44:50'),
(4, 'Ayala', 0, '2019-03-06 04:19:02'),
(5, 'aasd', 0, '2019-03-06 19:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `Plan_Id` int(11) NOT NULL,
  `Plan_Name` varchar(100) NOT NULL,
  `Plan_Description` text NOT NULL,
  `Plan_Size` int(11) NOT NULL,
  `Plan_Price` int(11) NOT NULL,
  `Plan_Bedroom` int(11) NOT NULL,
  `Plan_Bathroom` int(11) NOT NULL,
  `Plan_Parking` int(11) NOT NULL,
  `Plan_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Plan_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`Plan_Id`, `Plan_Name`, `Plan_Description`, `Plan_Size`, `Plan_Price`, `Plan_Bedroom`, `Plan_Bathroom`, `Plan_Parking`, `Plan_DateCreated`, `Plan_Status`) VALUES
(1, 'Plan 123', 'Plan 123 Description', 111, 1111, 15, 16, 17, '2019-02-17 01:05:32', 0),
(2, 'Plan 2', 'Plan 2 description\r\nline 2\r\nline 3\r\nline 4', 200, 201, 23, 24, 25, '2019-02-17 04:51:09', 0),
(3, 'Bahay ni Jaaj', 'Bahay', 1200, 1500000, 20, 20, 20, '2019-02-21 04:57:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `plan_info`
--

CREATE TABLE `plan_info` (
  `plan_id` int(11) NOT NULL,
  `plan_name` text NOT NULL,
  `plan_details` text NOT NULL,
  `no_of_rooms` int(11) NOT NULL,
  `no_of_bathrooms` int(11) NOT NULL,
  `plan_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `Project_Id` int(11) NOT NULL,
  `Project_Type` int(11) NOT NULL DEFAULT '0',
  `User_Id` int(11) NOT NULL,
  `Project_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Plan_Id` int(11) NOT NULL,
  `Project_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Project_Status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`Project_Id`, `Project_Type`, `User_Id`, `Project_Name`, `Plan_Id`, `Project_DateCreated`, `Project_Status`) VALUES
(1, 0, 1, 'project 1', 1, '2019-02-18 10:13:39', 0),
(2, 0, 1, 'Project 2', 1, '2019-02-20 02:57:46', 0),
(3, 0, 1, '123', 1, '2019-02-21 04:45:16', 0),
(7, 2, 1, 'Upload 1 Project', 1, '2019-03-02 06:56:50', 0),
(8, 2, 1, 'Upload 1 Project 1', 2, '2019-03-02 06:58:12', 0),
(10, 1, 1, 'Service 1', 1, '2019-03-03 00:49:46', 0),
(11, 2, 1, 'proj', 3, '2019-03-03 09:18:23', 0),
(12, 1, 1, 'Service 1', 1, '2019-03-05 20:21:47', 0),
(13, 0, 1, 'test bahay 123', 1, '2019-03-06 11:04:15', 0),
(14, 2, 1, 'Bahay ni Jaaj', 4, '2019-03-06 11:05:17', 0),
(15, 0, 1, 'test1', 1, '2019-03-14 13:21:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `Services_Id` int(11) NOT NULL,
  `Services_Name` varchar(200) NOT NULL,
  `Services_Description` varchar(1000) NOT NULL,
  `Services_Price` double NOT NULL,
  `Services_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Services_DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`Services_Id`, `Services_Name`, `Services_Description`, `Services_Price`, `Services_Status`, `Services_DateCreated`) VALUES
(1, 'Service 1', 'Service 1 Description\r\nasd\r\nasd\r\nasda\r\naasdasd\r\nasdasfqwf', 12, 0, '2019-02-25 11:06:34'),
(2, 'Service 2', 'Service 2 Description', 12, 0, '2019-02-25 13:53:45'),
(3, 'Service 3', 'Service 3 Description', 12, 0, '2019-02-25 13:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `user_id` int(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `transaction_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_type`
--

INSERT INTO `transaction_type` (`user_id`, `user_email`, `ip_address`, `transaction_type`) VALUES
(1, '2@2', '::1', 'None'),
(2, '2@2', '::1', 'None'),
(3, '2@2', '::1', 'None'),
(4, '2@2', '::1', 'None'),
(5, '2@2', '::1', 'None'),
(6, '2@22', '::1', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `upgrade`
--

CREATE TABLE `upgrade` (
  `Upgrade_Id` int(11) NOT NULL,
  `Part_Id` int(11) NOT NULL,
  `Upgrade_Name` varchar(100) NOT NULL,
  `Upgrade_Description` text NOT NULL,
  `Upgrade_Price` decimal(10,0) NOT NULL,
  `Upgrade_PriceType` tinyint(1) NOT NULL DEFAULT '0',
  `Upgrade_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Upgrade_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upgrade`
--

INSERT INTO `upgrade` (`Upgrade_Id`, `Part_Id`, `Upgrade_Name`, `Upgrade_Description`, `Upgrade_Price`, `Upgrade_PriceType`, `Upgrade_DateCreated`, `Upgrade_Status`) VALUES
(3, 4, 'Upgrade 3', ' Upgrade 3 Description ', '340', 0, '2019-02-17 09:53:50', 0),
(5, 4, 'Upgrade 1', ' Upgrade 1Upgrade 1', '123', 0, '2019-02-17 10:01:13', 0),
(7, 7, 'Upgrade 1', ' Upgrade 1 desc', '123', 0, '2019-03-05 21:12:34', 0),
(8, 7, 'Upgrade 2', ' Upgrade 2Upgrade 2', '234', 1, '2019-03-05 21:12:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `Upload_Id` int(11) NOT NULL,
  `Upload_Description` text NOT NULL,
  `Upload_DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Upload_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`Upload_Id`, `Upload_Description`, `Upload_DateCreated`, `Upload_Status`) VALUES
(1, 'Upload 1', '2019-03-02 14:56:50', 0),
(2, 'Upload 1', '2019-03-02 14:58:12', 0),
(3, 'description line1\r\nline 2\r\nline 3\r\nline 4', '2019-03-03 17:18:24', 0),
(4, 'testing lang to', '2019-03-06 19:05:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `uploadplace`
--

CREATE TABLE `uploadplace` (
  `Uploadplace_Id` int(11) NOT NULL,
  `Uploadplace_Place` varchar(200) NOT NULL,
  `Uploadplace_DateTime` datetime NOT NULL,
  `Uploadplace_Used` tinyint(4) NOT NULL DEFAULT '0',
  `Uploadplace_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Uploadplace_Status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userproject`
--

CREATE TABLE `userproject` (
  `UserProject_Id` int(11) NOT NULL,
  `Project_Id` int(11) NOT NULL,
  `Material_Id` int(11) NOT NULL,
  `Upgrade_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userproject`
--

INSERT INTO `userproject` (`UserProject_Id`, `Project_Id`, `Material_Id`, `Upgrade_Id`) VALUES
(42, 2, 20, 0),
(43, 2, 0, 3),
(44, 2, 21, 0),
(95, 1, 21, 0),
(100, 1, 17, 0),
(102, 3, 0, 6),
(103, 3, 20, 0),
(108, 3, 23, 0),
(109, 3, 0, 8),
(111, 13, 25, 0),
(112, 15, 21, 0),
(113, 15, 0, 6),
(114, 15, 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_id` int(50) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `ip_address`, `user_email`, `user_pass`, `full_name`, `birthdate`, `gender`, `contact`, `address`) VALUES
(1, '::1', '2@2', '2', 'Jumarie', '2019-03-28', '', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `user_account_p`
--

CREATE TABLE `user_account_p` (
  `user_id` int(50) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `hashcode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account_p`
--

INSERT INTO `user_account_p` (`user_id`, `ip_address`, `user_email`, `user_pass`, `full_name`, `birthdate`, `gender`, `contact`, `address`, `hashcode`) VALUES
(1, '::1', 'a@a', 'a', 'akfer', '0000-00-00', 'male', '12345', 'asdasd', 'e666a59d0cd3ba9f9c730aeb4deb759e'),
(2, '::1', '2@2222', '2', 'jamun', '0000-00-00', 'male', '129818264', 'add', '4692e578eac2cf22cb684a7bbfc25b99');

-- --------------------------------------------------------

--
-- Table structure for table `user_service`
--

CREATE TABLE `user_service` (
  `user_email` varchar(255) NOT NULL,
  `service_name` text NOT NULL,
  `service_location` varchar(255) NOT NULL,
  `service_fee` int(50) NOT NULL,
  `service_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `available_location`
--
ALTER TABLE `available_location`
  ADD UNIQUE KEY `loc_city` (`loc_city`);

--
-- Indexes for table `bd_upload`
--
ALTER TABLE `bd_upload`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_Id`),
  ADD KEY `Plan_Id` (`Plan_Id`);

--
-- Indexes for table `finish`
--
ALTER TABLE `finish`
  ADD PRIMARY KEY (`Finish_Id`);

--
-- Indexes for table `finishitem`
--
ALTER TABLE `finishitem`
  ADD PRIMARY KEY (`FinishItem_Id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`Image_Id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`Material_Id`),
  ADD KEY `Part_Id` (`Part_Id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`Part_Id`),
  ADD KEY `Category_Id` (`Category_Id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_Id`),
  ADD KEY `Project_Id` (`Project_Id`);

--
-- Indexes for table `paymenttype`
--
ALTER TABLE `paymenttype`
  ADD PRIMARY KEY (`PaymentType_Id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`Place_Id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`Plan_Id`);

--
-- Indexes for table `plan_info`
--
ALTER TABLE `plan_info`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`Project_Id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`Services_Id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `upgrade`
--
ALTER TABLE `upgrade`
  ADD PRIMARY KEY (`Upgrade_Id`),
  ADD KEY `Part_Id` (`Part_Id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`Upload_Id`);

--
-- Indexes for table `uploadplace`
--
ALTER TABLE `uploadplace`
  ADD PRIMARY KEY (`Uploadplace_Id`);

--
-- Indexes for table `userproject`
--
ALTER TABLE `userproject`
  ADD PRIMARY KEY (`UserProject_Id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_account_p`
--
ALTER TABLE `user_account_p`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `finish`
--
ALTER TABLE `finish`
  MODIFY `Finish_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `finishitem`
--
ALTER TABLE `finishitem`
  MODIFY `FinishItem_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `Image_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `Material_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `Part_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `paymenttype`
--
ALTER TABLE `paymenttype`
  MODIFY `PaymentType_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `Place_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `Plan_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plan_info`
--
ALTER TABLE `plan_info`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `Project_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `Services_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `Upgrade_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `Upload_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uploadplace`
--
ALTER TABLE `uploadplace`
  MODIFY `Uploadplace_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userproject`
--
ALTER TABLE `userproject`
  MODIFY `UserProject_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_account_p`
--
ALTER TABLE `user_account_p`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
