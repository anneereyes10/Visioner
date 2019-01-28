-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2019 at 03:52 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `designbuild`
--
CREATE DATABASE IF NOT EXISTS `designbuild` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `designbuild`;

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
(1, 'alfer.coronel@gmail.com', 'alfer'),
(2, '2@2', '2');

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
(41, 'alfer@gmail.com', 'None', '0000-00-00', '', '', '0000-00-00'),
(42, 'anne@gmail.com', 'None', '0000-00-00', '', '', '0000-00-00'),
(43, 'jaaj@gmail.com', 'None', '0000-00-00', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `available_location`
--

CREATE TABLE `available_location` (
  `loc_city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `available_location`
--

INSERT INTO `available_location` (`loc_city`) VALUES
('Makati'),
('Quezon'),
('Visioner Office');

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
  `Layout_Id` int(11) NOT NULL,
  `PartMaterial_Id` int(11) NOT NULL,
  `MaterialUpgrade_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finishitem`
--

INSERT INTO `finishitem` (`FinishItem_Id`, `Finish_Id`, `Layout_Id`, `PartMaterial_Id`, `MaterialUpgrade_Id`) VALUES
(54, 2, 5, 5, 0),
(55, 2, 5, 5, 10),
(57, 3, 5, 7, 0),
(58, 1, 5, 6, 0),
(59, 1, 5, 4, 0),
(60, 1, 5, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `Floor_Id` int(11) NOT NULL,
  `Floor_Name` varchar(100) NOT NULL,
  `Floor_Description` text NOT NULL,
  `Floor_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Floor_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`Floor_Id`, `Floor_Name`, `Floor_Description`, `Floor_DateCreated`, `Floor_Status`) VALUES
(4, 'Floor Name', 'Floor Des', '2018-11-09 21:59:18', 0),
(5, '2nd Floor', 'ssec', '2018-11-16 14:02:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `floorroom`
--

CREATE TABLE `floorroom` (
  `FloorRoom_Id` int(11) NOT NULL,
  `LayoutFloor_Id` int(11) NOT NULL,
  `Room_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `floorroom`
--

INSERT INTO `floorroom` (`FloorRoom_Id`, `LayoutFloor_Id`, `Room_Id`) VALUES
(1, 2, 7),
(2, 2, 8),
(5, 1, 8),
(6, 5, 5),
(7, 5, 5),
(8, 10, 4),
(9, 1, 9),
(10, 7, 9);

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
(1, '1.jpg', 'layout', 3, 'original', '2018-11-09 02:39:29', 0),
(2, '2.PNG', 'layout', 4, 'original', '2018-11-09 02:40:45', 0),
(3, '3.PNG', 'layout', 5, 'original', '2018-11-09 02:42:07', 0),
(4, '4.PNG', 'layout', 6, 'original', '2018-11-09 02:42:09', 0),
(5, '5.PNG', 'layout', 7, 'original', '2018-11-09 02:42:25', 0),
(6, '6.PNG', 'layout', 8, 'original', '2018-11-09 06:33:47', 0),
(7, '7.PNG', 'layout', 9, 'original', '2018-11-09 06:37:04', 0),
(8, '8.PNG', 'layout', 10, 'original', '2018-11-09 06:39:37', 0),
(9, '9.PNG', 'layout', 11, 'original', '2018-11-09 06:40:12', 0),
(10, '10.jpg', 'floor', 2, 'original', '2018-11-09 09:27:15', 0),
(11, '11.PNG', 'room', 2, 'original', '2018-11-09 09:49:33', 0),
(12, '12.PNG', 'parts', 2, 'original', '2018-11-09 10:01:13', 0),
(13, '13.PNG', 'parts', 3, 'original', '2018-11-09 10:02:05', 0),
(14, '14.PNG', 'parts', 4, 'original', '2018-11-09 10:03:44', 0),
(15, '15.PNG', 'material', 2, 'original', '2018-11-09 10:25:17', 0),
(16, '16.jpg', 'material', 2, 'original', '2018-11-09 10:25:33', 0),
(17, '17.jpg', 'upgrade', 1, 'original', '2018-11-09 10:30:52', 0),
(18, '18.PNG', 'upgrade', 1, 'original', '2018-11-09 10:31:15', 0),
(19, '19.PNG', 'material', 3, 'original', '2018-11-09 10:49:11', 0),
(20, '20.jpg', 'material', 4, 'original', '2018-11-09 10:58:04', 0),
(21, '21.jpg', 'upgrade', 2, 'original', '2018-11-09 11:09:49', 0),
(22, '22.PNG', 'floor', 1, 'original', '2018-11-09 17:14:34', 0),
(23, '23.jpg', 'layout', 4, 'original', '2018-11-09 21:58:50', 0),
(24, '24.PNG', 'floor', 4, 'original', '2018-11-09 21:59:18', 0),
(25, '25.jpg', 'room', 7, 'original', '2018-11-09 22:00:11', 0),
(26, '26.PNG', 'parts', 5, 'original', '2018-11-09 22:04:09', 0),
(27, '27.jpg', 'material', 4, 'original', '2018-11-09 22:05:27', 0),
(28, '28.PNG', 'upgrade', 2, 'original', '2018-11-09 22:06:01', 0),
(29, '29.jpg', 'layout', 5, 'original', '2018-11-16 12:12:15', 0),
(30, '30.png', 'layout', 6, 'original', '2018-11-16 12:12:31', 0),
(31, '31.jpg', 'layout', 7, 'original', '2018-11-16 12:58:21', 0),
(32, '32.png', 'floor', 4, 'original', '2018-11-16 13:44:45', 0),
(33, '33.png', 'floor', 5, 'original', '2018-11-16 14:02:16', 0),
(34, '34.jpg', 'layout', 8, 'original', '2018-11-20 01:56:16', 0),
(35, '35.png', 'payment', 1, 'original', '2018-12-04 00:07:01', 0),
(36, '36.png', 'payment', 2, 'original', '2018-12-04 00:12:05', 0),
(37, '37.png', 'payment', 3, 'original', '2018-12-04 00:33:16', 0),
(38, '38.png', 'payment', 4, 'original', '2018-12-04 00:33:58', 0),
(39, '39.png', 'room', 8, 'original', '2018-12-09 07:16:36', 0),
(40, '40.png', 'parts', 5, 'original', '2018-12-09 10:41:07', 0),
(41, '41.jpg', 'material', 4, 'original', '2018-12-09 15:15:46', 0),
(42, '42.png', 'upgrade', 1, 'original', '2018-12-09 15:37:39', 0),
(43, '43.png', 'payment', 5, 'original', '2018-12-17 22:13:30', 0),
(44, '44.png', 'payment', 6, 'original', '2018-12-18 04:14:24', 0),
(45, '45.png', 'room', 9, 'original', '2018-12-28 04:53:36', 0),
(46, '46.png', 'parts', 6, 'original', '2018-12-28 04:54:08', 0),
(47, '47.png', 'parts', 7, 'original', '2018-12-28 04:54:15', 0),
(48, '48.png', 'material', 5, 'original', '2018-12-28 04:54:56', 0),
(49, '49.png', 'material', 6, 'original', '2018-12-28 04:55:05', 0),
(50, '50.png', 'payment', 7, 'original', '2019-01-09 10:41:40', 0),
(51, '51.jpg', 'layout', 10, 'original', '2019-01-13 13:41:47', 0),
(52, '52.jpg', 'layout', 11, 'original', '2019-01-13 13:42:44', 0),
(53, '53.jpg', 'layout', 12, 'original', '2019-01-13 13:45:23', 0),
(54, '54.jpg', 'layout', 13, 'original', '2019-01-13 13:46:06', 0),
(55, '55.jpg', 'payment', 8, 'original', '2019-01-19 07:05:07', 0),
(56, '56.jpg', 'payment', 9, 'original', '2019-01-23 14:40:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `layout`
--

CREATE TABLE `layout` (
  `Layout_Id` int(11) NOT NULL,
  `Layout_Name` varchar(100) NOT NULL,
  `Layout_Description` text NOT NULL,
  `Layout_Size` int(11) NOT NULL,
  `Layout_Price` int(11) NOT NULL,
  `Layout_Bedroom` int(11) NOT NULL,
  `Layout_Bathroom` int(11) NOT NULL,
  `Layout_Parking` int(11) NOT NULL,
  `Layout_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Layout_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layout`
--

INSERT INTO `layout` (`Layout_Id`, `Layout_Name`, `Layout_Description`, `Layout_Size`, `Layout_Price`, `Layout_Bedroom`, `Layout_Bathroom`, `Layout_Parking`, `Layout_DateCreated`, `Layout_Status`) VALUES
(5, 'layout 1', 'desc', 1, 2, 3, 4, 5, '2018-11-16 12:12:15', 0),
(6, 'layout 2', 'sadawda', 0, 0, 0, 0, 0, '2018-11-16 12:12:31', 0),
(7, 'layout 3', 'test', 0, 0, 0, 0, 0, '2018-11-16 12:58:21', 0),
(8, 'test layout', 'sample', 0, 0, 0, 0, 0, '2018-11-20 01:56:16', 0),
(9, 'no image test', 'sdads', 0, 0, 0, 0, 0, '2018-11-20 01:56:25', 0),
(13, 'LayoutName', 'LayoutDescription', 500, 2, 3, 4, 5, '2019-01-13 13:46:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `layoutfloor`
--

CREATE TABLE `layoutfloor` (
  `LayoutFloor_Id` int(11) NOT NULL,
  `Layout_Id` int(11) NOT NULL,
  `Floor_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `layoutfloor`
--

INSERT INTO `layoutfloor` (`LayoutFloor_Id`, `Layout_Id`, `Floor_Id`) VALUES
(1, 5, 4),
(3, 1, 7),
(4, 6, 4),
(5, 7, 5),
(6, 6, 5),
(7, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `Material_Id` int(11) NOT NULL,
  `Material_Name` varchar(100) NOT NULL,
  `Material_Description` text NOT NULL,
  `Material_Price` decimal(10,0) NOT NULL,
  `Material_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Material_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`Material_Id`, `Material_Name`, `Material_Description`, `Material_Price`, `Material_DateCreated`, `Material_Status`) VALUES
(4, 'Material Name', 'Material Des', '4321', '2018-11-09 22:05:18', 0),
(5, 'material 1', 'test', '1', '2018-12-28 04:54:56', 0),
(6, 'material 2', 'test', '2', '2018-12-28 04:55:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `materialupgrade`
--

CREATE TABLE `materialupgrade` (
  `MaterialUpgrade_Id` int(11) NOT NULL,
  `PartMaterial_Id` int(11) NOT NULL,
  `Upgrade_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `materialupgrade`
--

INSERT INTO `materialupgrade` (`MaterialUpgrade_Id`, `PartMaterial_Id`, `Upgrade_Id`) VALUES
(9, 4, 1),
(10, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `partmaterial`
--

CREATE TABLE `partmaterial` (
  `PartMaterial_Id` int(11) NOT NULL,
  `RoomPart_Id` int(11) NOT NULL,
  `Material_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `partmaterial`
--

INSERT INTO `partmaterial` (`PartMaterial_Id`, `RoomPart_Id`, `Material_Id`) VALUES
(4, 10, 4),
(5, 10, 6),
(6, 14, 6),
(7, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `Parts_Id` int(11) NOT NULL,
  `Parts_Name` varchar(100) NOT NULL,
  `Parts_Description` text NOT NULL,
  `Parts_Area` decimal(10,2) NOT NULL,
  `Parts_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Parts_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`Parts_Id`, `Parts_Name`, `Parts_Description`, `Parts_Area`, `Parts_DateCreated`, `Parts_Status`) VALUES
(5, 'Parts Name', 'Parts Des', '0.00', '2018-11-09 22:03:53', 0),
(6, 'part 1', 'test', '0.00', '2018-12-28 04:54:08', 0),
(7, 'part 2', 'test', '0.00', '2018-12-28 04:54:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_Id` int(11) NOT NULL,
  `Project_Id` int(11) NOT NULL,
  `Payment_ReceiptDate` date NOT NULL,
  `Payment_ReceiptStatus` tinyint(4) NOT NULL DEFAULT '0',
  `Payment_AppointmentDate` date NOT NULL DEFAULT '0000-00-00',
  `Payment_AppointmentStatus` tinyint(4) NOT NULL DEFAULT '0',
  `Payment_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Payment_Status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_Id`, `Project_Id`, `Payment_ReceiptDate`, `Payment_ReceiptStatus`, `Payment_AppointmentDate`, `Payment_AppointmentStatus`, `Payment_DateCreated`, `Payment_Status`) VALUES
(2, 0, '0000-00-00', 0, '0000-00-00', 0, '2019-01-23 14:35:24', 0),
(8, 15, '2019-01-22', 1, '0003-01-02', 0, '2019-01-19 07:05:07', 0),
(9, 16, '0004-02-03', 1, '0004-02-03', 0, '2019-01-23 14:40:22', 0);

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
(41, 'alfer@gmail.com', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', ''),
(42, 'anne@gmail.com', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', ''),
(43, 'jaaj@gmail.com', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `type` varchar(255) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`type`, `details`) VALUES
('BDO', '<p>bdo number here</p>'),
('BPI', '<p>bpi number here dasdasdasd</p>'),
('Chinabank', '<p>accoutn detail here</p>'),
('PayPal', 'paypal number here');

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

--
-- Dumping data for table `plan_info`
--

INSERT INTO `plan_info` (`plan_id`, `plan_name`, `plan_details`, `no_of_rooms`, `no_of_bathrooms`, `plan_price`) VALUES
(1, 'Autumn', 'Details Here', 4, 3, 12345),
(2, 'Joaquin', 'Joaquin Details Here', 1, 2, 67890);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `Project_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Project_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Layout_Id` int(11) NOT NULL,
  `Project_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Project_Status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`Project_Id`, `User_Id`, `Project_Name`, `Layout_Id`, `Project_DateCreated`, `Project_Status`) VALUES
(15, 44, 'project 1', 5, '2019-01-19 07:04:16', 0),
(16, 44, 'Project 2', 5, '2019-01-23 14:40:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `Room_Id` int(11) NOT NULL,
  `Room_Name` varchar(100) NOT NULL,
  `Room_Description` text NOT NULL,
  `Room_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Room_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_Id`, `Room_Name`, `Room_Description`, `Room_DateCreated`, `Room_Status`) VALUES
(7, 'Room Name', 'Room Des', '2018-11-09 22:00:11', 0),
(8, 'room 2', 'asd', '2018-11-20 02:30:24', 0),
(9, 'room 1', 'test', '2018-12-28 04:53:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roompart`
--

CREATE TABLE `roompart` (
  `RoomPart_Id` int(11) NOT NULL,
  `FloorRoom_Id` int(11) NOT NULL,
  `Parts_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roompart`
--

INSERT INTO `roompart` (`RoomPart_Id`, `FloorRoom_Id`, `Parts_Id`) VALUES
(10, 5, 5),
(11, 1, 5),
(12, 10, 5),
(13, 9, 6),
(14, 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(50) NOT NULL,
  `service_name` text NOT NULL,
  `service_details` text NOT NULL,
  `serv_img` text NOT NULL,
  `total_serv_fee` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_details`, `serv_img`, `total_serv_fee`) VALUES
(1, '3D Rendering', 'Details 1 ', 'None', 123456),
(2, 'Construction Management', 'Details 2', 'None', 678901),
(3, 'Consultancy', '<p>details 3</p>', 'None', 12345);

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
(41, 'alfer@gmail.com', '::1', 'None'),
(42, 'anne@gmail.com', '::1', 'None'),
(43, 'jaaj@gmail.com', '::1', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `upgrade`
--

CREATE TABLE `upgrade` (
  `Upgrade_Id` int(11) NOT NULL,
  `Upgrade_Name` varchar(100) NOT NULL,
  `Upgrade_Description` text NOT NULL,
  `Upgrade_Price` decimal(10,0) NOT NULL,
  `Upgrade_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Upgrade_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upgrade`
--

INSERT INTO `upgrade` (`Upgrade_Id`, `Upgrade_Name`, `Upgrade_Description`, `Upgrade_Price`, `Upgrade_DateCreated`, `Upgrade_Status`) VALUES
(1, 'upgrade', 'desc', '123', '2018-12-09 15:37:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userproject`
--

CREATE TABLE `userproject` (
  `UserProject_Id` int(11) NOT NULL,
  `Project_Id` int(11) NOT NULL,
  `PartMaterial_Id` int(11) NOT NULL,
  `MaterialUpgrade_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userproject`
--

INSERT INTO `userproject` (`UserProject_Id`, `Project_Id`, `PartMaterial_Id`, `MaterialUpgrade_Id`) VALUES
(27, 8, 6, 0),
(50, 8, 5, 0),
(54, 13, 5, 0),
(55, 13, 6, 0),
(60, 14, 6, 0),
(61, 14, 5, 0),
(62, 14, 5, 10),
(68, 11, 6, 0),
(69, 11, 4, 0),
(70, 11, 4, 9),
(71, 15, 6, 0),
(72, 15, 4, 0),
(73, 15, 4, 9),
(74, 16, 6, 0),
(75, 16, 4, 0),
(76, 16, 4, 9);

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
(41, '::1', 'alfer@gmail.com', 'alfer', 'Alfer Coronel', '1996-02-14', 'male', '123', 'Makati City'),
(42, '::1', 'anne@gmail.com', 'anne', 'Anne Reyes', NULL, '', '', ''),
(43, '::1', 'jaaj@gmail.com', 'jaaj', 'Jaaj Almendra', NULL, '', '', ''),
(44, '', '2@2', '2', 'user test', '2018-12-12', 'M', '', '');

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
-- Indexes for table `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`Floor_Id`);

--
-- Indexes for table `floorroom`
--
ALTER TABLE `floorroom`
  ADD PRIMARY KEY (`FloorRoom_Id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`Image_Id`);

--
-- Indexes for table `layout`
--
ALTER TABLE `layout`
  ADD PRIMARY KEY (`Layout_Id`);

--
-- Indexes for table `layoutfloor`
--
ALTER TABLE `layoutfloor`
  ADD PRIMARY KEY (`LayoutFloor_Id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`Material_Id`);

--
-- Indexes for table `materialupgrade`
--
ALTER TABLE `materialupgrade`
  ADD PRIMARY KEY (`MaterialUpgrade_Id`);

--
-- Indexes for table `partmaterial`
--
ALTER TABLE `partmaterial`
  ADD PRIMARY KEY (`PartMaterial_Id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`Parts_Id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_Id`);

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
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`Room_Id`);

--
-- Indexes for table `roompart`
--
ALTER TABLE `roompart`
  ADD PRIMARY KEY (`RoomPart_Id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `upgrade`
--
ALTER TABLE `upgrade`
  ADD PRIMARY KEY (`Upgrade_Id`);

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
-- Indexes for table `user_service`
--
ALTER TABLE `user_service`
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `finish`
--
ALTER TABLE `finish`
  MODIFY `Finish_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `finishitem`
--
ALTER TABLE `finishitem`
  MODIFY `FinishItem_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `floor`
--
ALTER TABLE `floor`
  MODIFY `Floor_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `floorroom`
--
ALTER TABLE `floorroom`
  MODIFY `FloorRoom_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `Image_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `layout`
--
ALTER TABLE `layout`
  MODIFY `Layout_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `layoutfloor`
--
ALTER TABLE `layoutfloor`
  MODIFY `LayoutFloor_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `Material_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materialupgrade`
--
ALTER TABLE `materialupgrade`
  MODIFY `MaterialUpgrade_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `partmaterial`
--
ALTER TABLE `partmaterial`
  MODIFY `PartMaterial_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `Parts_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `plan_info`
--
ALTER TABLE `plan_info`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `Project_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `Room_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roompart`
--
ALTER TABLE `roompart`
  MODIFY `RoomPart_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `Upgrade_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userproject`
--
ALTER TABLE `userproject`
  MODIFY `UserProject_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
