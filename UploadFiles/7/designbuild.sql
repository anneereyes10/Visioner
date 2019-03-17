-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 03:50 AM
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
-- Database: `designbuild`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `Floor_Id` int(11) NOT NULL,
  `Floor_Name` varchar(100) NOT NULL,
  `Floor_Description` text NOT NULL,
  `Floor_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Floor_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `floorroom`
--

CREATE TABLE `floorroom` (
  `FloorRoom_Id` int(11) NOT NULL,
  `LayoutFloor_Id` int(11) NOT NULL,
  `Room_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `layout`
--

CREATE TABLE `layout` (
  `Layout_Id` int(11) NOT NULL,
  `Layout_Name` varchar(100) NOT NULL,
  `Layout_Description` text NOT NULL,
  `Layout_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Layout_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `layoutfloor`
--

CREATE TABLE `layoutfloor` (
  `LayoutFloor_Id` int(11) NOT NULL,
  `Layout_Id` int(11) NOT NULL,
  `Floor_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `materialupgrade`
--

CREATE TABLE `materialupgrade` (
  `MaterialUpgrade_Id` int(11) NOT NULL,
  `PartMaterial_Id` int(11) NOT NULL,
  `Upgrade_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partmaterial`
--

CREATE TABLE `partmaterial` (
  `PartMaterial_Id` int(11) NOT NULL,
  `RoomPart_Id` int(11) NOT NULL,
  `Material_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_Id` int(11) NOT NULL,
  `Project_Id` int(11) NOT NULL,
  `Payment_ReceiptDate` date NOT NULL,
  `Payment_ReceiptStatus` tinyint(4) NOT NULL DEFAULT '0',
  `Payment_AppointmentDate` date DEFAULT NULL,
  `Payment_AppointmentStatus` tinyint(4) NOT NULL DEFAULT '0',
  `Payment_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Payment_Status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `Project_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Project_Status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `roompart`
--

CREATE TABLE `roompart` (
  `RoomPart_Id` int(11) NOT NULL,
  `FloorRoom_Id` int(11) NOT NULL,
  `Parts_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floor`
--
ALTER TABLE `floor`
  MODIFY `Floor_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floorroom`
--
ALTER TABLE `floorroom`
  MODIFY `FloorRoom_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `Image_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layout`
--
ALTER TABLE `layout`
  MODIFY `Layout_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layoutfloor`
--
ALTER TABLE `layoutfloor`
  MODIFY `LayoutFloor_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `Material_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materialupgrade`
--
ALTER TABLE `materialupgrade`
  MODIFY `MaterialUpgrade_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partmaterial`
--
ALTER TABLE `partmaterial`
  MODIFY `PartMaterial_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `Parts_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plan_info`
--
ALTER TABLE `plan_info`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `Project_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `Room_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roompart`
--
ALTER TABLE `roompart`
  MODIFY `RoomPart_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `Upgrade_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userproject`
--
ALTER TABLE `userproject`
  MODIFY `UserProject_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
