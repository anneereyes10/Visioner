-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2019 at 04:35 AM
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
(1, '2@2', 'None', '0000-00-00', '', '', '0000-00-00');

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
(4, 2, 'Category 1', '2019-02-17 04:51:20', 0),
(5, 2, 'Category 2', '2019-02-17 04:51:26', 0);

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
(19, 1, 1, 0, 5),
(20, 1, 1, 19, 0),
(21, 2, 1, 20, 0),
(23, 2, 1, 0, 3),
(24, 2, 1, 21, 0);

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
(15, '15.jpg', 'payment', 2, 'original', '2019-02-20 02:58:18', 0);

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
  `Material_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Material_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`Material_Id`, `Part_Id`, `Material_Name`, `Material_Description`, `Material_Price`, `Material_DateCreated`, `Material_Status`) VALUES
(17, 4, 'Material 2', ' Material 2 Description', '0', '2019-02-17 09:00:30', 0),
(19, 4, 'Material 1', ' Material Desciption', '123', '2019-02-17 09:10:39', 0),
(20, 4, 'Material 3', ' Material 3 Material 3Material 3', '3456', '2019-02-17 10:01:33', 0),
(21, 7, 'Material 1 - 3', ' Material 1 - 3 Material 1 - 3', '1307', '2019-02-18 05:39:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `Part_Id` int(11) NOT NULL,
  `Category_Id` int(11) NOT NULL,
  `Part_Name` varchar(100) NOT NULL,
  `Part_Area` decimal(10,2) NOT NULL,
  `Part_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Part_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`Part_Id`, `Category_Id`, `Part_Name`, `Part_Area`, `Part_DateCreated`, `Part_Status`) VALUES
(3, 4, 'Part 1', '1.00', '2019-02-17 07:14:13', 0),
(4, 2, 'Part 1', '0.00', '2019-02-17 07:25:42', 0),
(7, 2, 'Part 3', '5123.12', '2019-02-17 08:16:57', 0);

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
(2, 2, '2019-02-07', 4, 0, '0000-00-00', 0, 0, 0, '2019-02-20 02:58:18', 0);

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
(1, '2@2', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', '');

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
(2, 'Alabang', 0, '2019-02-18 21:44:50');

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
(2, 'Plan 2', 'Plan 2 description', 200, 201, 23, 24, 25, '2019-02-17 04:51:09', 0);

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
  `User_Id` int(11) NOT NULL,
  `Project_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Plan_Id` int(11) NOT NULL,
  `Project_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Project_Status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`Project_Id`, `User_Id`, `Project_Name`, `Plan_Id`, `Project_DateCreated`, `Project_Status`) VALUES
(1, 1, 'project 1', 1, '2019-02-18 10:13:39', 0),
(2, 1, 'Project 2', 1, '2019-02-20 02:57:46', 0);

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
(1, '2@2', '::1', 'None');

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
  `Upgrade_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Upgrade_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upgrade`
--

INSERT INTO `upgrade` (`Upgrade_Id`, `Part_Id`, `Upgrade_Name`, `Upgrade_Description`, `Upgrade_Price`, `Upgrade_DateCreated`, `Upgrade_Status`) VALUES
(3, 4, 'Upgrade 3', ' Upgrade 3 Description ', '340', '2019-02-17 09:53:50', 0),
(5, 4, 'Upgrade 1', ' Upgrade 1Upgrade 1', '123', '2019-02-17 10:01:13', 0);

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
(33, 1, 21, 0),
(34, 1, 0, 5),
(35, 1, 19, 0),
(42, 2, 20, 0),
(43, 2, 0, 3),
(44, 2, 21, 0);

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
(1, '::1', '2@2', '2', 'Jumarie', NULL, '', '', '');

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
  ADD PRIMARY KEY (`Upgrade_Id`),
  ADD KEY `Part_Id` (`Part_Id`);

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
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `finish`
--
ALTER TABLE `finish`
  MODIFY `Finish_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `finishitem`
--
ALTER TABLE `finishitem`
  MODIFY `FinishItem_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `Image_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `Material_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `Part_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paymenttype`
--
ALTER TABLE `paymenttype`
  MODIFY `PaymentType_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `Place_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `Plan_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plan_info`
--
ALTER TABLE `plan_info`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `Project_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `Upgrade_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userproject`
--
ALTER TABLE `userproject`
  MODIFY `UserProject_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_account_p`
--
ALTER TABLE `user_account_p`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`Plan_Id`) REFERENCES `plan` (`Plan_Id`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`Part_Id`) REFERENCES `part` (`Part_Id`);

--
-- Constraints for table `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `part_ibfk_1` FOREIGN KEY (`Category_Id`) REFERENCES `category` (`Category_Id`);

--
-- Constraints for table `upgrade`
--
ALTER TABLE `upgrade`
  ADD CONSTRAINT `upgrade_ibfk_1` FOREIGN KEY (`Part_Id`) REFERENCES `part` (`Part_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
