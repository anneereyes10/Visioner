-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2019 at 11:28 AM
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
(1, 'visionertestemail@gmail.com', 'v'),
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
(16, 'alfer.coronel@gmail.com', 'None', '0000-00-00', '', '', '0000-00-00'),
(17, 'anneereyes10@gmail.com', 'None', '0000-00-00', '', '', '0000-00-00'),
(18, 'alfer.lance.coronel@gmail.com', 'None', '0000-00-00', '', '', '0000-00-00');

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
(24, 4, 'Flooring', '2019-04-08 17:31:04', 0),
(25, 4, 'Paint', '2019-04-08 17:49:17', 0),
(26, 4, 'Accent Walls', '2019-04-08 17:50:50', 0),
(27, 4, 'Doors', '2019-04-08 17:52:05', 0),
(28, 4, 'Windows', '2019-04-08 17:53:07', 0),
(29, 4, 'Ceiling', '2019-04-08 17:54:24', 0),
(30, 4, 'Stairs', '2019-04-08 17:55:36', 0),
(31, 4, 'Pin Lights', '2019-04-08 17:56:33', 0),
(32, 4, 'Light Switches', '2019-04-08 17:58:05', 0),
(33, 4, 'Cabinets', '2019-04-08 17:59:49', 0),
(34, 4, 'Roof', '2019-04-08 18:01:18', 0),
(35, 4, 'Toilet Options', '2019-04-08 18:02:16', 0);

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
(31, 1, 1, 17, 0),
(32, 1, 4, 36, 0),
(33, 1, 4, 26, 0),
(34, 1, 4, 30, 0),
(35, 2, 4, 37, 0),
(36, 2, 4, 27, 0),
(37, 2, 4, 31, 0),
(38, 3, 4, 38, 0),
(39, 3, 4, 28, 0),
(40, 3, 4, 32, 0),
(41, 3, 4, 34, 0),
(42, 4, 4, 39, 0),
(43, 4, 4, 29, 0),
(44, 4, 4, 33, 0),
(45, 4, 4, 35, 0),
(46, 1, 4, 44, 0),
(47, 1, 4, 48, 0),
(48, 1, 4, 53, 0),
(49, 1, 4, 57, 0),
(50, 2, 4, 45, 0),
(51, 2, 4, 49, 0),
(52, 2, 4, 54, 0),
(53, 2, 4, 58, 0),
(54, 3, 4, 55, 0),
(55, 3, 4, 59, 0),
(56, 3, 4, 50, 0),
(57, 3, 4, 46, 0),
(58, 4, 4, 47, 0),
(60, 4, 4, 51, 0),
(61, 4, 4, 56, 0),
(64, 4, 4, 60, 0),
(65, 1, 4, 61, 0),
(66, 1, 4, 40, 0),
(67, 1, 4, 71, 0),
(68, 1, 4, 67, 0),
(69, 1, 4, 63, 0),
(70, 1, 4, 75, 0),
(74, 1, 4, 83, 0),
(75, 1, 4, 87, 0),
(76, 1, 4, 85, 0),
(77, 1, 4, 89, 0),
(84, 1, 4, 102, 0),
(85, 1, 4, 104, 0),
(87, 1, 4, 108, 0),
(88, 1, 4, 110, 0),
(89, 1, 4, 116, 0),
(90, 1, 4, 111, 0),
(91, 1, 4, 113, 0),
(92, 1, 4, 115, 0),
(94, 2, 4, 84, 0),
(95, 2, 4, 88, 0),
(96, 2, 4, 86, 0),
(97, 2, 4, 90, 0),
(99, 2, 4, 92, 0),
(100, 2, 4, 95, 0),
(102, 2, 4, 97, 0),
(103, 2, 4, 99, 0),
(104, 2, 4, 101, 0),
(105, 2, 4, 103, 0),
(106, 2, 4, 105, 0),
(107, 2, 4, 107, 0),
(108, 2, 4, 109, 0),
(110, 2, 4, 117, 0),
(111, 2, 4, 112, 0),
(112, 2, 4, 114, 0),
(113, 2, 4, 115, 0),
(135, 1, 4, 106, 0),
(137, 1, 4, 81, 0),
(138, 1, 4, 91, 0),
(139, 1, 4, 94, 0),
(140, 1, 4, 93, 0),
(141, 1, 4, 96, 0),
(142, 1, 4, 98, 0),
(143, 1, 4, 100, 0),
(145, 2, 4, 93, 0),
(147, 2, 4, 110, 0),
(148, 3, 4, 118, 0),
(149, 3, 4, 120, 0),
(150, 3, 4, 123, 0),
(151, 3, 4, 125, 0),
(152, 3, 4, 127, 0),
(153, 3, 4, 133, 0),
(154, 3, 4, 150, 0),
(156, 3, 4, 152, 0),
(157, 3, 4, 130, 0),
(158, 3, 4, 140, 0),
(159, 3, 4, 101, 0),
(160, 3, 4, 138, 0),
(161, 3, 4, 134, 0),
(162, 3, 4, 107, 0),
(163, 3, 4, 109, 0),
(164, 3, 4, 136, 0),
(165, 3, 4, 148, 0),
(166, 3, 4, 142, 0),
(167, 3, 4, 145, 0),
(169, 3, 4, 147, 0),
(170, 4, 4, 119, 0),
(172, 4, 4, 121, 0),
(173, 4, 4, 124, 0),
(174, 4, 4, 126, 0),
(175, 4, 4, 128, 0),
(176, 4, 4, 133, 0),
(177, 4, 4, 151, 0),
(178, 4, 4, 153, 0),
(179, 4, 4, 131, 0),
(180, 4, 4, 141, 0),
(181, 4, 4, 129, 0),
(183, 4, 4, 139, 0),
(184, 4, 4, 135, 0),
(185, 4, 4, 132, 0),
(186, 4, 4, 109, 0),
(187, 4, 4, 137, 0),
(188, 4, 4, 149, 0),
(189, 4, 4, 143, 0),
(190, 4, 4, 146, 0),
(191, 4, 4, 147, 0),
(193, 2, 4, 118, 0);

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
(39, '39.jpg', 'payment', 7, 'original', '2019-03-05 21:34:53', 0),
(40, '40.png', 'payment', 11, 'original', '2019-03-16 23:35:27', 0),
(41, '41.png', 'payment', 12, 'original', '2019-03-16 23:53:27', 0),
(42, '42.jpg', 'payment', 13, 'original', '2019-03-19 16:09:45', 0),
(43, '43.jpg', 'payment', 14, 'original', '2019-03-19 16:11:53', 0),
(44, '44.jpg', 'payment', 15, 'original', '2019-03-19 16:34:35', 0),
(45, '45.jpg', 'payment', 16, 'original', '2019-03-21 12:50:18', 0),
(46, '46.jpg', 'payment', 18, 'original', '2019-03-21 16:40:31', 0),
(47, '47.jpg', 'payment', 19, 'original', '2019-03-21 16:42:03', 0),
(48, '48.jpg', 'payment', 20, 'original', '2019-03-21 16:46:01', 0),
(49, '49.jpg', 'payment', 21, 'original', '2019-03-21 16:48:19', 0),
(50, '50.jpg', 'payment', 22, 'original', '2019-03-22 03:24:00', 0),
(51, '51.jpg', 'payment', 23, 'original', '2019-03-22 03:25:55', 0),
(52, '52.jpg', 'payment', 24, 'original', '2019-03-22 14:45:29', 0),
(53, '53.jpg', 'payment', 25, 'original', '2019-03-22 15:36:01', 0),
(54, '54.jpg', 'payment', 26, 'original', '2019-04-01 04:22:48', 0),
(55, '55.jpg', 'payment', 27, 'original', '2019-04-01 04:43:45', 0),
(56, '56.jpg', 'plan', 4, 'original', '2019-04-01 18:18:12', 0),
(57, '57.jpg', 'plan', 4, 'original', '2019-04-01 18:18:31', 0),
(58, '58.jpg', 'material', 26, 'original', '2019-04-02 05:18:29', 0),
(59, '59.png', 'material', 27, 'original', '2019-04-02 05:21:35', 0),
(60, '60.png', 'material', 28, 'original', '2019-04-02 05:22:16', 0),
(61, '61.png', 'material', 29, 'original', '2019-04-02 05:23:20', 0),
(62, '62.jpg', 'upgrade', 9, 'original', '2019-04-02 05:25:18', 0),
(63, '63.jpg', 'upgrade', 10, 'original', '2019-04-02 05:28:49', 0),
(64, '64.jpg', 'upgrade', 11, 'original', '2019-04-02 05:30:04', 0),
(65, '65.jpg', 'material', 30, 'original', '2019-04-02 05:34:55', 0),
(66, '66.png', 'material', 31, 'original', '2019-04-02 05:35:27', 0),
(67, '67.png', 'material', 32, 'original', '2019-04-02 05:52:08', 0),
(68, '68.png', 'material', 33, 'original', '2019-04-02 05:52:44', 0),
(69, '69.jpg', 'upgrade', 12, 'original', '2019-04-02 05:56:12', 0),
(70, '70.jpg', 'upgrade', 13, 'original', '2019-04-02 05:57:30', 0),
(71, '71.jpg', 'material', 34, 'original', '2019-04-02 06:02:38', 0),
(72, '72.jpg', 'material', 35, 'original', '2019-04-02 06:04:25', 0),
(73, '73.jpg', 'material', 36, 'original', '2019-04-02 06:05:31', 0),
(74, '74.png', 'material', 37, 'original', '2019-04-02 06:05:56', 0),
(75, '75.png', 'material', 38, 'original', '2019-04-02 06:06:13', 0),
(76, '76.png', 'material', 39, 'original', '2019-04-02 06:06:26', 0),
(77, '77.png', 'material', 40, 'original', '2019-04-02 06:17:13', 0),
(78, '78.png', 'material', 40, 'original', '2019-04-02 06:17:53', 0),
(79, '79.png', 'material', 41, 'original', '2019-04-02 06:18:07', 0),
(80, '80.png', 'material', 42, 'original', '2019-04-02 06:18:31', 0),
(81, '81.png', 'material', 43, 'original', '2019-04-02 06:18:56', 0),
(82, '82.jpg', 'material', 44, 'original', '2019-04-02 06:24:31', 0),
(83, '83.jpg', 'material', 45, 'original', '2019-04-02 06:25:01', 0),
(84, '84.jpg', 'material', 46, 'original', '2019-04-02 06:25:22', 0),
(85, '85.jpg', 'material', 47, 'original', '2019-04-02 06:25:38', 0),
(86, '86.jpg', 'material', 48, 'original', '2019-04-02 06:26:33', 0),
(87, '87.jpg', 'material', 49, 'original', '2019-04-02 06:26:55', 0),
(88, '88.jpg', 'material', 50, 'original', '2019-04-02 06:27:07', 0),
(89, '89.jpg', 'material', 51, 'original', '2019-04-02 06:27:19', 0),
(90, '90.jpg', 'material', 52, 'original', '2019-04-02 06:27:34', 0),
(91, '91.jpg', 'material', 53, 'original', '2019-04-02 06:32:34', 0),
(92, '92.png', 'material', 54, 'original', '2019-04-02 06:32:53', 0),
(93, '93.jpg', 'material', 55, 'original', '2019-04-02 06:33:22', 0),
(94, '94.png', 'material', 56, 'original', '2019-04-02 06:33:32', 0),
(95, '95.jpg', 'material', 57, 'original', '2019-04-02 06:35:47', 0),
(96, '96.jpg', 'material', 58, 'original', '2019-04-02 06:36:01', 0),
(97, '97.jpg', 'material', 59, 'original', '2019-04-02 06:36:13', 0),
(98, '98.jpg', 'material', 60, 'original', '2019-04-02 06:36:23', 0),
(99, '99.png', 'payment', 28, 'original', '2019-04-02 13:06:23', 0),
(100, '100.jpg', 'payment', 29, 'original', '2019-04-02 13:10:01', 0),
(101, '101.png', 'material', 40, 'original', '2019-04-03 10:49:02', 0),
(102, '102.png', 'material', 17, 'original', '2019-04-03 13:41:25', 0),
(103, '103.jpg', 'material', 17, 'original', '2019-04-03 13:42:02', 0),
(104, '104.png', 'material', 40, 'original', '2019-04-03 15:35:19', 0),
(105, '105.jpg', 'material', 40, 'original', '2019-04-03 15:35:35', 0),
(106, '106.jpg', 'material', 40, 'original', '2019-04-03 15:35:35', 0),
(107, '107.jpg', 'material', 61, 'original', '2019-04-03 16:13:54', 0),
(108, '108.jpg', 'material', 62, 'original', '2019-04-03 16:14:10', 0),
(109, '109.png', 'material', 63, 'original', '2019-04-03 16:18:30', 0),
(110, '110.png', 'material', 64, 'original', '2019-04-03 16:18:40', 0),
(111, '111.png', 'material', 65, 'original', '2019-04-03 16:18:58', 0),
(112, '112.png', 'material', 66, 'original', '2019-04-03 16:19:20', 0),
(113, '113.png', 'material', 67, 'original', '2019-04-03 16:20:44', 0),
(114, '114.png', 'material', 68, 'original', '2019-04-03 16:20:53', 0),
(115, '115.png', 'material', 69, 'original', '2019-04-03 16:21:06', 0),
(116, '116.png', 'material', 70, 'original', '2019-04-03 16:21:19', 0),
(117, '117.png', 'material', 71, 'original', '2019-04-03 16:25:35', 0),
(118, '118.png', 'material', 72, 'original', '2019-04-03 16:25:50', 0),
(119, '119.png', 'material', 73, 'original', '2019-04-03 16:26:16', 0),
(120, '120.png', 'material', 74, 'original', '2019-04-03 16:26:35', 0),
(121, '121.png', 'payment', 30, 'original', '2019-04-03 17:40:11', 0),
(122, '122.png', 'material', 75, 'original', '2019-04-04 16:20:24', 0),
(123, '123.png', 'payment', 31, 'original', '2019-04-04 16:25:39', 0),
(124, '124.png', 'payment', 32, 'original', '2019-04-05 14:17:48', 0),
(125, '125.png', 'payment', 33, 'original', '2019-04-05 14:32:17', 0),
(126, '126.png', 'payment', 34, 'original', '2019-04-05 15:34:25', 0),
(127, '127.png', 'payment', 35, 'original', '2019-04-05 15:46:22', 0),
(128, '128.jpg', 'payment', 36, 'original', '2019-04-06 02:21:12', 0),
(129, '129.jpg', 'payment', 1, 'original', '2019-04-06 02:57:54', 0),
(130, '130.jpg', 'material', 76, 'original', '2019-04-08 16:44:28', 0),
(131, '131.jpg', 'material', 77, 'original', '2019-04-08 16:46:01', 0),
(132, '132.jpg', 'material', 78, 'original', '2019-04-08 16:47:11', 0),
(133, '133.png', 'material', 79, 'original', '2019-04-08 17:25:41', 0),
(134, '134.jpg', 'material', 80, 'original', '2019-04-08 17:28:01', 0),
(135, '135.jpg', 'material', 81, 'original', '2019-04-08 17:31:46', 0),
(136, '136.jpg', 'material', 82, 'original', '2019-04-08 17:32:29', 0),
(137, '137.jpg', 'material', 83, 'original', '2019-04-08 17:35:25', 0),
(138, '138.jpg', 'material', 84, 'original', '2019-04-08 17:46:09', 0),
(139, '139.jpg', 'material', 85, 'original', '2019-04-08 17:47:08', 0),
(140, '140.png', 'material', 86, 'original', '2019-04-08 17:47:29', 0),
(141, '141.jpg', 'material', 87, 'original', '2019-04-08 17:47:45', 0),
(142, '142.jpg', 'material', 88, 'original', '2019-04-08 17:48:13', 0),
(143, '143.png', 'material', 89, 'original', '2019-04-08 17:48:41', 0),
(144, '144.jpg', 'material', 90, 'original', '2019-04-08 17:49:04', 0),
(145, '145.jpg', 'material', 91, 'original', '2019-04-08 17:50:16', 0),
(146, '146.jpg', 'material', 92, 'original', '2019-04-08 17:50:34', 0),
(147, '147.jpg', 'material', 93, 'original', '2019-04-08 17:51:13', 0),
(148, '148.jpg', 'material', 94, 'original', '2019-04-08 17:51:29', 0),
(149, '149.png', 'material', 95, 'original', '2019-04-08 17:51:51', 0),
(150, '150.jpg', 'material', 96, 'original', '2019-04-08 17:52:37', 0),
(151, '151.png', 'material', 97, 'original', '2019-04-08 17:52:54', 0),
(152, '152.png', 'material', 98, 'original', '2019-04-08 17:53:37', 0),
(153, '153.png', 'material', 99, 'original', '2019-04-08 17:54:09', 0),
(154, '154.jpg', 'material', 100, 'original', '2019-04-08 17:55:06', 0),
(155, '155.png', 'material', 101, 'original', '2019-04-08 17:55:26', 0),
(156, '156.png', 'material', 102, 'original', '2019-04-08 17:56:02', 0),
(157, '157.png', 'material', 103, 'original', '2019-04-08 17:56:22', 0),
(158, '158.png', 'material', 104, 'original', '2019-04-08 17:57:10', 0),
(159, '159.png', 'material', 105, 'original', '2019-04-08 17:57:56', 0),
(160, '160.png', 'material', 106, 'original', '2019-04-08 17:58:42', 0),
(161, '161.png', 'material', 107, 'original', '2019-04-08 17:59:12', 0),
(162, '162.jpg', 'material', 108, 'original', '2019-04-08 18:00:14', 0),
(163, '163.png', 'material', 109, 'original', '2019-04-08 18:00:57', 0),
(164, '164.png', 'material', 110, 'original', '2019-04-08 18:01:48', 0),
(165, '165.jpg', 'material', 111, 'original', '2019-04-08 18:03:13', 0),
(166, '166.jpg', 'material', 111, 'original', '2019-04-08 18:03:40', 0),
(167, '167.png', 'material', 112, 'original', '2019-04-08 18:04:21', 0),
(168, '168.jpg', 'material', 113, 'original', '2019-04-08 18:04:47', 0),
(169, '169.png', 'material', 114, 'original', '2019-04-08 18:05:14', 0),
(170, '170.jpg', 'material', 115, 'original', '2019-04-08 18:05:32', 0),
(171, '171.jpg', 'material', 116, 'original', '2019-04-08 18:05:49', 0),
(172, '172.png', 'material', 117, 'original', '2019-04-08 18:06:16', 0),
(173, '173.jpg', 'payment', 2, 'original', '2019-04-22 22:24:17', 0),
(174, '174.jpg', 'payment', 3, 'original', '2019-05-15 06:35:27', 0),
(175, '175.png', 'payment', 4, 'original', '2019-06-02 04:53:01', 0),
(176, '176.png', 'payment', 5, 'original', '2019-06-02 16:01:34', 0),
(177, '177.jpg', 'payment', 6, 'original', '2019-06-05 17:27:19', 0),
(178, '178.jpg', 'material', 118, 'original', '2019-06-05 17:58:41', 0),
(179, '179.jpg', 'material', 119, 'original', '2019-06-05 17:59:20', 0),
(180, '180.jpg', 'upgrade', 14, 'original', '2019-06-05 18:00:29', 0),
(181, '181.jpg', 'material', 120, 'original', '2019-06-05 18:01:34', 0),
(182, '182.jpg', 'material', 121, 'original', '2019-06-05 18:02:20', 0),
(183, '183.jpg', 'material', 122, 'original', '2019-06-05 18:03:14', 0),
(184, '184.jpg', 'material', 123, 'original', '2019-06-05 18:05:17', 0),
(185, '185.jpg', 'material', 124, 'original', '2019-06-05 18:05:37', 0),
(186, '186.jpg', 'material', 125, 'original', '2019-06-05 18:07:36', 0),
(187, '187.png', 'material', 126, 'original', '2019-06-05 18:08:12', 0),
(188, '188.jpg', 'material', 127, 'original', '2019-06-05 18:09:43', 0),
(189, '189.jpg', 'material', 128, 'original', '2019-06-05 18:10:06', 0),
(190, '190.png', 'material', 129, 'original', '2019-06-05 18:14:43', 0),
(191, '191.png', 'material', 130, 'original', '2019-06-05 18:16:19', 0),
(192, '192.png', 'material', 131, 'original', '2019-06-05 18:16:37', 0),
(193, '193.png', 'material', 132, 'original', '2019-06-05 18:18:48', 0),
(194, '194.jpg', 'material', 133, 'original', '2019-06-05 18:20:17', 0),
(195, '195.png', 'material', 134, 'original', '2019-06-05 18:21:31', 0),
(196, '196.png', 'material', 135, 'original', '2019-06-05 18:21:56', 0),
(197, '197.png', 'material', 136, 'original', '2019-06-05 18:23:32', 0),
(198, '198.png', 'material', 137, 'original', '2019-06-05 18:23:47', 0),
(199, '199.png', 'material', 138, 'original', '2019-06-05 18:24:51', 0),
(200, '200.png', 'material', 139, 'original', '2019-06-05 18:25:00', 0),
(201, '201.png', 'material', 140, 'original', '2019-06-05 18:27:14', 0),
(202, '202.png', 'material', 141, 'original', '2019-06-05 18:27:26', 0),
(203, '203.png', 'material', 142, 'original', '2019-06-05 18:29:06', 0),
(204, '204.png', 'material', 143, 'original', '2019-06-05 18:29:20', 0),
(205, '205.jpg', 'material', 144, 'original', '2019-06-05 18:30:28', 0),
(206, '206.png', 'material', 145, 'original', '2019-06-05 18:32:52', 0),
(207, '207.png', 'material', 146, 'original', '2019-06-05 18:33:23', 0),
(208, '208.jpg', 'upgrade', 15, 'original', '2019-06-05 18:33:50', 0),
(209, '209.jpg', 'material', 147, 'original', '2019-06-05 18:35:02', 0),
(210, '210.png', 'material', 148, 'original', '2019-06-05 18:35:33', 0),
(211, '211.png', 'material', 149, 'original', '2019-06-05 18:35:53', 0),
(212, '212.png', 'material', 150, 'original', '2019-06-05 18:38:05', 0),
(213, '213.png', 'material', 151, 'original', '2019-06-05 18:38:40', 0),
(214, '214.png', 'material', 152, 'original', '2019-06-05 18:39:20', 0),
(215, '215.png', 'material', 153, 'original', '2019-06-05 18:39:33', 0),
(216, '216.jpg', 'plan', 4, 'original', '2019-06-05 18:46:38', 0),
(217, '217.jpg', 'plan', 6, 'original', '2019-06-05 18:49:13', 0),
(218, '218.jpg', 'plan', 6, 'original', '2019-06-05 18:49:32', 0),
(219, '219.jpg', 'plan', 6, 'original', '2019-06-05 18:49:39', 0),
(220, '220.png', 'payment', 7, 'original', '2019-06-06 02:04:46', 0),
(221, '221.jpg', 'payment', 8, 'original', '2019-06-06 02:53:46', 0),
(222, '222.jpg', 'payment', 9, 'original', '2019-06-06 03:23:26', 0),
(223, '223.jpg', 'payment', 10, 'original', '2019-06-06 08:46:50', 0),
(224, '224.jpg', 'payment', 11, 'original', '2019-06-06 08:56:24', 0),
(225, '225.jpg', 'payment', 12, 'original', '2019-06-09 07:49:39', 0),
(226, '226.jpg', 'payment', 13, 'original', '2019-06-09 08:07:58', 0),
(227, '227.jpg', 'payment', 14, 'original', '2019-06-09 08:22:27', 0),
(228, '228.jpg', 'payment', 15, 'original', '2019-06-09 08:23:43', 0),
(229, '229.jpg', 'payment', 16, 'original', '2019-06-09 08:24:15', 0),
(230, '230.jpg', 'payment', 17, 'original', '2019-06-09 08:26:09', 0),
(231, '231.jpg', 'payment', 18, 'original', '2019-06-09 08:26:46', 0),
(232, '232.jpg', 'payment', 19, 'original', '2019-06-09 08:27:59', 0),
(233, '233.jpg', 'payment', 20, 'original', '2019-06-09 08:28:32', 0),
(234, '234.jpg', 'payment', 21, 'original', '2019-06-09 08:28:48', 0),
(235, '235.jpg', 'payment', 22, 'original', '2019-06-09 08:30:17', 0),
(236, '236.jpg', 'payment', 23, 'original', '2019-06-09 08:32:34', 0),
(237, '237.jpg', 'payment', 24, 'original', '2019-06-09 08:33:58', 0),
(238, '238.jpg', 'material', 154, 'original', '2019-06-09 09:56:33', 0),
(239, '239.jpg', 'material', 155, 'original', '2019-06-09 09:56:53', 0),
(240, '240.jpg', 'material', 156, 'original', '2019-06-09 09:57:21', 0),
(241, '241.png', 'material', 95, 'original', '2019-06-09 10:02:40', 0),
(242, '242.png', 'material', 158, 'original', '2019-06-09 10:36:35', 0),
(243, '243.jpg', 'material', 160, 'original', '2019-06-25 13:57:30', 0),
(244, '244.jpg', 'upgrade', 18, 'original', '2019-06-25 15:26:33', 0),
(245, '245.jpg', 'upgrade', 17, 'original', '2019-06-25 15:27:10', 0);

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
  `Unit_Id` int(11) NOT NULL,
  `Material_Width` int(11) NOT NULL,
  `Material_Height` int(11) NOT NULL,
  `Material_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Material_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`Material_Id`, `Part_Id`, `Material_Name`, `Material_Description`, `Material_Price`, `Material_PriceType`, `Unit_Id`, `Material_Width`, `Material_Height`, `Material_DateCreated`, `Material_Status`) VALUES
(17, 4, 'Material 2', ' Material 2 Description', '1', 0, 1, 1, 1, '2019-02-17 09:00:30', 0),
(19, 4, 'Material 1', ' Material Desciption', '123', 0, 1, 1, 1, '2019-02-17 09:10:39', 0),
(20, 4, 'Material 3', ' Material 3 Material 3Material 3', '3456', 0, 1, 1, 1, '2019-02-17 10:01:33', 0),
(21, 7, 'Material 1 - 3', ' Material 1 - 3 Material 1 - 3', '1307', 0, 1, 1, 1, '2019-02-18 05:39:45', 0),
(23, 7, 'Material 4', ' Material 4 Piece', '43', 1, 1, 1, 1, '2019-03-05 21:03:22', 0),
(24, 9, 'mat1', ' asd', '12', 0, 1, 1, 1, '2019-03-06 11:20:43', 0),
(25, 9, 'mat2', ' ', '200', 1, 1, 1, 1, '2019-03-06 11:21:02', 0),
(26, 11, 'Default', 'Default selection. \r\n\r\nComes with Plumbing pipes ready for lavatory installation.', '100', 1, 1, 1, 1, '2019-04-02 05:18:29', 0),
(27, 11, 'Wall-hung', 'Uleya Brand\r\n\r\nColor(s): White', '990', 1, 1, 1, 1, '2019-04-02 05:21:35', 0),
(28, 11, 'Vessel 1', 'Uleya Brand. Color(s): White, Black', '1825', 1, 1, 1, 1, '2019-04-02 05:22:16', 0),
(29, 11, 'Vessel 2', ' Depot Brand. Color(s): White, Black', '4875', 1, 1, 1, 1, '2019-04-02 05:23:20', 0),
(30, 12, 'Default', ' Default selection. Comes with Plumbing pipes ready for shower installation.\r\n', '100', 1, 1, 1, 1, '2019-04-02 05:34:55', 0),
(31, 12, 'Shower Head', ' Depot Brand', '630', 1, 1, 1, 1, '2019-04-02 05:35:27', 0),
(32, 12, 'Shower Mixer Set 1', ' Depot Brand. Color(s): White, Black', '3500', 1, 1, 1, 1, '2019-04-02 05:52:08', 0),
(33, 12, 'Shower Mixer Set 2', ' Depot Brand. Color(s): White, Black', '15000', 1, 1, 1, 1, '2019-04-02 05:52:44', 0),
(34, 13, 'Aluminum Frame', ' ', '5800', 1, 1, 1, 1, '2019-04-02 06:02:38', 0),
(35, 13, 'Tempered Glass Enclosure (Frameless)', ' ', '9000', 1, 1, 1, 1, '2019-04-02 06:04:25', 0),
(36, 10, 'Default', ' Default selection. Comes with Plumbing pipes ready for Water Closet installation.\r\n', '100', 1, 1, 1, 1, '2019-04-02 06:05:31', 0),
(37, 10, 'Single Flush', ' ', '2850', 1, 1, 1, 1, '2019-04-02 06:05:56', 0),
(38, 10, 'Dual Flush 1', ' ', '4950', 1, 1, 1, 1, '2019-04-02 06:06:13', 0),
(39, 10, 'Dual Flush 2', ' ', '15800', 1, 1, 1, 1, '2019-04-02 06:06:26', 0),
(40, 14, 'Default', 'Main Door Included Only', '0', 0, 1, 1, 1, '2019-04-02 06:17:13', 0),
(41, 14, 'Flush Door', ' ', '1970', 1, 1, 1, 1, '2019-04-02 06:17:33', 0),
(42, 14, 'Solid Door 1', ' ', '3790', 1, 1, 1, 1, '2019-04-02 06:18:31', 0),
(43, 14, 'Solid Door 2', ' ', '6990', 1, 1, 1, 1, '2019-04-02 06:18:56', 0),
(44, 15, 'Default', ' Default Material', '0', 0, 1, 1, 1, '2019-04-02 06:24:31', 0),
(45, 15, 'Ceramic Tile', ' ', '40000', 0, 1, 1, 1, '2019-04-02 06:25:01', 0),
(46, 15, 'Granite Tile 1', ' ', '550', 0, 1, 1, 1, '2019-04-02 06:25:22', 0),
(47, 15, 'Granite Tile 2', ' ', '800', 0, 1, 1, 1, '2019-04-02 06:25:38', 0),
(48, 16, 'Default', ' Default Material', '0', 0, 1, 1, 1, '2019-04-02 06:26:33', 0),
(49, 16, 'Ceramic Tile', ' ', '35000', 0, 1, 1, 1, '2019-04-02 06:26:55', 0),
(50, 16, 'Granite Tile 1', ' ', '550', 0, 1, 1, 1, '2019-04-02 06:27:07', 0),
(51, 16, 'Granite Tile 2', ' ', '800', 1, 1, 1, 1, '2019-04-02 06:27:19', 0),
(52, 16, 'Natural Vinyl', ' ', '980', 0, 1, 1, 1, '2019-04-02 06:27:34', 0),
(53, 17, 'Default', ' Concrete Slab Ready for Tile Installation', '0', 0, 1, 1, 1, '2019-04-02 06:32:34', 0),
(54, 17, 'Rough Cement', ' ', '25000', 0, 1, 1, 1, '2019-04-02 06:32:53', 0),
(55, 17, 'Pebble Finish', ' ', '560', 0, 1, 1, 1, '2019-04-02 06:33:22', 0),
(56, 17, 'Stone Tile', ' ', '990', 0, 1, 1, 1, '2019-04-02 06:33:32', 0),
(57, 18, 'Default', ' Concrete Slab w/ Tubular Rail Ready for Tile Installation', '0', 0, 1, 1, 1, '2019-04-02 06:35:47', 0),
(58, 18, 'Ceramic Tile', ' ', '24000', 0, 1, 1, 1, '2019-04-02 06:36:01', 0),
(59, 18, 'Granite Tile 1', ' ', '550', 0, 1, 1, 1, '2019-04-02 06:36:13', 0),
(60, 18, 'Granite Tile 2', ' ', '800', 0, 1, 1, 1, '2019-04-02 06:36:23', 0),
(61, 19, 'Skim Coat', ' ', '400', 0, 1, 1, 1, '2019-04-03 16:13:54', 0),
(62, 19, 'Finished Paint', ' ', '500', 0, 1, 1, 1, '2019-04-03 16:14:10', 0),
(63, 21, 'Royu Switch 1', ' ', '20', 1, 1, 1, 1, '2019-04-03 16:18:30', 0),
(64, 21, 'Royu Switch 2', ' ', '90', 1, 1, 1, 1, '2019-04-03 16:18:40', 0),
(65, 21, 'Royu Modern Switch', ' ', '150', 1, 1, 1, 1, '2019-04-03 16:18:58', 0),
(66, 21, 'Panasonic Branded Switch', ' ', '350', 1, 1, 1, 1, '2019-04-03 16:19:20', 0),
(67, 20, 'Royu Switch 1', ' ', '20', 1, 1, 1, 1, '2019-04-03 16:20:44', 0),
(68, 20, 'Royu Switch 2', ' ', '90', 1, 1, 1, 1, '2019-04-03 16:20:53', 0),
(69, 20, 'Royu Moden Switch', ' ', '150', 1, 1, 1, 1, '2019-04-03 16:21:06', 0),
(70, 20, 'Panasonic Branded Switch', ' ', '350', 1, 1, 1, 1, '2019-04-03 16:21:19', 0),
(71, 22, 'Concrete Stairs', ' ', '350', 0, 1, 1, 1, '2019-04-03 16:25:35', 0),
(72, 22, 'Tile Floor Finish', ' ', '400', 0, 1, 1, 1, '2019-04-03 16:25:50', 0),
(73, 22, 'Wood Planks - Stainless', ' ', '450', 0, 1, 1, 1, '2019-04-03 16:26:16', 0),
(74, 22, 'Wood Planks - Glass', ' ', '450', 0, 1, 1, 1, '2019-04-03 16:26:35', 0),
(75, 24, 'Flush door', ' ', '500', 0, 1, 1, 1, '2019-04-04 16:20:24', 0),
(76, 25, 'Default', 'With Concrete Wall Ready for Tile Installation ', '0', 0, 1, 1, 1, '2019-04-08 16:44:28', 0),
(77, 26, 'Default', ' With Concrete Wall Ready for Tile Installation', '0', 0, 1, 1, 1, '2019-04-08 16:46:01', 0),
(78, 27, 'None', 'No Cabinets Included. ', '0', 0, 1, 1, 1, '2019-04-08 16:47:11', 0),
(79, 28, 'Default', ' Rough Cement Only', '0', 0, 1, 1, 1, '2019-04-08 17:25:41', 0),
(80, 28, 'Ceramic Tile', ' ', '10000', 0, 1, 1, 1, '2019-04-08 17:28:01', 0),
(81, 29, 'Default', ' Default flooring material', '0', 0, 1, 1, 1, '2019-04-08 17:31:46', 0),
(82, 29, 'Ceramic Tile', 'Mariwasa Brand Cream', '25000', 0, 1, 1, 1, '2019-04-08 17:32:29', 0),
(83, 30, 'Default', ' Default Material Used', '0', 0, 1, 1, 1, '2019-04-08 17:35:25', 0),
(84, 30, 'Ceramic Tile', ' ', '24000', 0, 1, 1, 1, '2019-04-08 17:46:09', 0),
(85, 32, 'Default', ' ', '0', 0, 1, 1, 1, '2019-04-08 17:47:08', 0),
(86, 32, 'Rough Cement', ' ', '25000', 0, 1, 1, 1, '2019-04-08 17:47:29', 0),
(87, 31, 'Default', ' ', '0', 0, 1, 1, 1, '2019-04-08 17:47:45', 0),
(88, 31, 'Ceramic Tile', ' with Tubular Railing', '10000', 0, 1, 1, 1, '2019-04-08 17:48:13', 0),
(89, 33, 'Default', ' Rough Cement Only', '0', 0, 1, 1, 1, '2019-04-08 17:48:41', 0),
(90, 33, 'Ceramic Tile', ' ', '10000', 0, 1, 1, 1, '2019-04-08 17:49:04', 0),
(91, 34, 'Default', ' Default Skim Coat', '0', 0, 1, 1, 1, '2019-04-08 17:50:16', 0),
(92, 34, 'Skim Coat With Primer', ' ', '50000', 0, 1, 1, 1, '2019-04-08 17:50:34', 0),
(93, 36, 'Default', ' ', '0', 0, 1, 1, 1, '2019-04-08 17:51:13', 0),
(94, 35, 'Default', ' ', '0', 0, 1, 1, 1, '2019-04-08 17:51:29', 0),
(95, 35, 'Concrete Molds', ' per piece', '75000', 1, 1, 1, 1, '2019-04-08 17:51:51', 0),
(96, 37, 'Main Door Only', ' ', '0', 0, 1, 1, 1, '2019-04-08 17:52:37', 0),
(97, 37, 'Flush Doors', ' ', '20000', 0, 1, 1, 1, '2019-04-08 17:52:54', 0),
(98, 38, 'Default', ' U-PVC White', '0', 0, 1, 1, 1, '2019-04-08 17:53:37', 0),
(99, 38, 'Aluminum', ' ', '85000', 0, 1, 1, 1, '2019-04-08 17:54:09', 0),
(100, 39, 'Default', 'WITH METAL FURRING READY FOR CEILING INSTALLATION', '0', 0, 1, 1, 1, '2019-04-08 17:55:06', 0),
(101, 39, 'Flat Ceiling', ' ', '160000', 0, 1, 1, 1, '2019-04-08 17:55:26', 0),
(102, 40, 'Default', 'Concrete Stairs ', '0', 0, 1, 1, 1, '2019-04-08 17:56:02', 0),
(103, 40, 'Tile Floor Finish', ' ', '35000', 0, 1, 1, 1, '2019-04-08 17:56:22', 0),
(104, 41, 'Default', 'Default Depot White ', '0', 0, 1, 1, 1, '2019-04-08 17:57:10', 0),
(105, 41, 'Pin Bulb', ' Depot Cool White', '2000', 0, 1, 1, 1, '2019-04-08 17:57:56', 0),
(106, 42, 'Default', 'Royu Brand Default', '0', 0, 1, 1, 1, '2019-04-08 17:58:42', 0),
(107, 42, 'Royu Brand Classic', ' ', '2500', 0, 1, 1, 1, '2019-04-08 17:59:12', 0),
(108, 43, 'Default', 'No Cabinets Included ', '0', 0, 1, 1, 1, '2019-04-08 18:00:14', 0),
(109, 43, 'Kitchen Area', 'Duco Finish - Kitchen Area', '10000', 0, 1, 1, 1, '2019-04-08 18:00:57', 0),
(110, 44, 'Default', 'G.I. Roof ', '50000', 0, 1, 1, 1, '2019-04-08 18:01:48', 0),
(111, 46, 'Default', 'W/ PLUMBIN PIPES READY FOR LAVATORY INSTALLATION', '0', 0, 1, 1, 1, '2019-04-08 18:03:13', 0),
(112, 46, 'Wall-hung', ' ', '5000', 0, 1, 1, 1, '2019-04-08 18:04:21', 0),
(113, 47, 'Default', ' W/ PLUMBING PIPES READY FOR SHOWER INSTALLATION', '0', 0, 1, 1, 1, '2019-04-08 18:04:47', 0),
(114, 47, 'Shower Head', ' ', '2200', 0, 1, 1, 1, '2019-04-08 18:05:14', 0),
(115, 48, 'Default', ' ', '0', 0, 1, 1, 1, '2019-04-08 18:05:32', 0),
(116, 45, 'Default', ' W/ PLUMBIN PIPES READY FOR WC INSTALLATION', '0', 0, 1, 1, 1, '2019-04-08 18:05:49', 0),
(117, 45, 'Single Flush', ' ', '10000', 0, 1, 1, 1, '2019-04-08 18:06:16', 0),
(118, 29, 'Granite Tile 1', ' ', '40000', 0, 1, 1, 1, '2019-06-05 17:58:27', 0),
(119, 29, 'Granite Tile 2', ' ', '56000', 0, 1, 1, 1, '2019-06-05 17:59:20', 0),
(120, 30, 'Granite Tile 1', ' ', '38000', 0, 1, 1, 1, '2019-06-05 18:01:34', 0),
(121, 30, 'Granite Tile 2', ' ', '55000', 0, 1, 1, 1, '2019-06-05 18:02:20', 0),
(122, 30, 'Natural Vinyl', ' ', '67000', 0, 1, 1, 1, '2019-06-05 18:03:14', 0),
(123, 31, 'Granite Tile 1', ' ', '15500', 0, 1, 1, 1, '2019-06-05 18:05:17', 0),
(124, 31, 'Granite Tile 2', ' ', '23000', 0, 1, 1, 1, '2019-06-05 18:05:37', 0),
(125, 32, 'Pebble Finish', ' ', '22000', 0, 1, 1, 1, '2019-06-05 18:07:36', 0),
(126, 32, 'Stone Tile', ' ', '39000', 0, 1, 1, 1, '2019-06-05 18:08:12', 0),
(127, 33, 'Granite Tile 1', ' ', '11000', 0, 1, 1, 1, '2019-06-05 18:09:43', 0),
(128, 33, 'Granite Tile 2', ' ', '16000', 0, 1, 1, 1, '2019-06-05 18:10:06', 0),
(129, 39, 'Drop Ceiling', ' ', '265500', 0, 1, 1, 1, '2019-06-05 18:14:43', 0),
(130, 37, 'Solid Door 1', ' ', '36000', 0, 1, 1, 1, '2019-06-05 18:16:19', 0),
(131, 37, 'Solid Door 2', ' ', '64000', 0, 1, 1, 1, '2019-06-05 18:16:37', 0),
(132, 42, 'Panasonic Brand', ' ', '4000', 0, 1, 1, 1, '2019-06-05 18:18:48', 0),
(133, 34, 'Finished Paint', ' ', '75000', 0, 1, 1, 1, '2019-06-05 18:20:17', 0),
(134, 41, 'Pin Light LED', ' ', '6500', 0, 1, 1, 1, '2019-06-05 18:21:31', 0),
(135, 41, 'Branded LED', ' ', '13000', 0, 1, 1, 1, '2019-06-05 18:21:56', 0),
(136, 44, 'Longspan G.I. Roof', ' ', '75000', 0, 1, 1, 1, '2019-06-05 18:23:32', 0),
(137, 44, 'Stone Chip', ' ', '100000', 0, 1, 1, 1, '2019-06-05 18:23:47', 0),
(138, 40, 'Wood Planks - Stainless', ' ', '45000', 0, 1, 1, 1, '2019-06-05 18:24:51', 0),
(139, 40, 'Wood Planks - Glass', ' ', '60000', 0, 1, 1, 1, '2019-06-05 18:25:00', 0),
(140, 38, 'U-PVC', ' ', '95000', 0, 1, 1, 1, '2019-06-05 18:27:14', 0),
(141, 38, 'Laminated U-PVC', ' ', '110000', 0, 1, 1, 1, '2019-06-05 18:27:26', 0),
(142, 46, 'Vessel 1', ' ', '10000', 0, 1, 1, 1, '2019-06-05 18:29:06', 0),
(143, 46, 'Vessel 2', ' ', '22000', 0, 1, 1, 1, '2019-06-05 18:29:20', 0),
(144, 46, 'Kohler Pedestal', 'Kohler', '45000', 0, 1, 1, 1, '2019-06-05 18:30:20', 0),
(145, 47, 'Shower Mixer Set 1', ' ', '12000', 0, 1, 1, 1, '2019-06-05 18:32:52', 0),
(146, 47, 'Shower Mixer Set 2', ' ', '22000', 0, 1, 1, 1, '2019-06-05 18:33:23', 0),
(147, 48, 'Glass Enclosure - Aluminum', ' ', '10000', 0, 1, 1, 1, '2019-06-05 18:35:02', 0),
(148, 45, 'Dual Flush 1', ' ', '15000', 0, 1, 1, 1, '2019-06-05 18:35:33', 0),
(149, 45, 'Dual Flush 2', ' ', '54000', 0, 1, 1, 1, '2019-06-05 18:35:53', 0),
(150, 35, 'Ceramic Tile 1', ' ', '110000', 0, 1, 1, 1, '2019-06-05 18:38:05', 0),
(151, 35, 'Ceramic Tile 2', ' ', '130000', 0, 1, 1, 1, '2019-06-05 18:38:40', 0),
(152, 36, 'Ceramic Tile 1', ' ', '110000', 0, 1, 1, 1, '2019-06-05 18:39:20', 0),
(153, 36, 'Ceramic Tile 2', ' ', '130000', 0, 1, 1, 1, '2019-06-05 18:39:33', 0),
(158, 36, 'Concrete', '123 ', '12', 1, 1, 1, 1, '2019-06-09 10:36:35', 0),
(159, 50, 'material 1', ' 2', '1', 0, 1, 1, 1, '2019-06-25 13:57:06', 0),
(160, 50, 'material 2', ' 4', '3', 1, 1, 1, 1, '2019-06-25 13:57:30', 0),
(163, 50, '1', ' 3', '2', 0, 1, 6, 7, '2019-06-25 14:15:03', 0),
(164, 50, 'Area Material', '30x20', '20', 0, 1, 30, 20, '2019-06-25 14:21:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `Part_Id` int(11) NOT NULL,
  `Category_Id` int(11) NOT NULL,
  `Part_Name` varchar(100) NOT NULL,
  `Part_Area` decimal(10,2) NOT NULL,
  `Unit_Id` int(11) NOT NULL,
  `Part_Piece` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Part_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Part_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`Part_Id`, `Category_Id`, `Part_Name`, `Part_Area`, `Unit_Id`, `Part_Piece`, `Part_DateCreated`, `Part_Status`) VALUES
(3, 4, 'Part 1', '1.00', 1, '0.00', '2019-02-17 07:14:13', 0),
(4, 2, 'Part 1', '1.00', 1, '0.00', '2019-02-17 07:25:42', 0),
(7, 2, 'Part 3', '1.00', 1, '1.00', '2019-02-17 08:16:57', 0),
(8, 2, 'Part 4', '120.00', 1, '20.00', '2019-03-05 20:53:02', 0),
(9, 2, 'try', '100.00', 1, '12.00', '2019-03-06 11:20:24', 0),
(10, 20, 'Water Closet', '1.00', 1, '3.00', '2019-04-02 05:13:15', 0),
(11, 20, 'Lavatory', '1.00', 1, '3.00', '2019-04-02 05:13:46', 0),
(12, 20, 'Shower', '1.00', 1, '3.00', '2019-04-02 05:13:55', 0),
(13, 20, 'Shower Enclosure', '1.00', 1, '3.00', '2019-04-02 05:14:13', 0),
(14, 10, 'Exterior', '1.00', 1, '1.00', '2019-04-02 06:15:45', 0),
(15, 7, 'Ground Floor', '70.00', 1, '0.00', '2019-04-02 06:21:29', 0),
(16, 7, 'Second Floor', '68.00', 1, '0.00', '2019-04-02 06:22:03', 0),
(17, 7, 'Garage Floor', '39.00', 1, '0.00', '2019-04-02 06:22:15', 0),
(18, 7, 'Balcony Floor', '28.00', 1, '0.00', '2019-04-02 06:22:24', 0),
(19, 8, 'Interior', '138.00', 1, '0.00', '2019-04-03 16:12:52', 0),
(20, 15, 'Interior', '1.00', 1, '11.00', '2019-04-03 16:17:46', 0),
(21, 15, 'Exterior', '1.00', 1, '4.00', '2019-04-03 16:17:58', 0),
(22, 13, 'Interior', '13.00', 1, '0.00', '2019-04-03 16:25:03', 0),
(23, 17, 'Exterior', '68.00', 1, '0.00', '2019-04-03 16:27:42', 0),
(25, 9, 'Exterior', '1.00', 1, '1.00', '2019-04-08 16:43:49', 0),
(26, 9, 'Interior', '1.00', 1, '1.00', '2019-04-08 16:43:52', 0),
(27, 16, 'Interior', '1.00', 1, '1.00', '2019-04-08 16:46:40', 0),
(28, 7, 'Porch', '1.00', 1, '1.00', '2019-04-08 17:24:41', 0),
(29, 24, 'Ground Floor', '5.00', 1, '6.00', '2019-04-08 17:31:24', 0),
(30, 24, 'Second Floor', '1.00', 1, '1.00', '2019-04-08 17:34:15', 0),
(31, 24, 'Balcony', '1.00', 1, '1.00', '2019-04-08 17:46:25', 0),
(32, 24, 'Garage', '1.00', 1, '1.00', '2019-04-08 17:46:39', 0),
(33, 24, 'Porch', '1.00', 1, '1.00', '2019-04-08 17:46:43', 0),
(34, 25, 'Overall', '1.00', 1, '1.00', '2019-04-08 17:49:55', 0),
(35, 26, 'Exterior', '1.00', 1, '1.00', '2019-04-08 17:50:59', 0),
(36, 26, 'Interior', '2.00', 1, '3.00', '2019-04-08 17:51:03', 0),
(37, 27, 'Overall', '1.00', 1, '1.00', '2019-04-08 17:52:14', 0),
(38, 28, 'Overall', '1.00', 1, '1.00', '2019-04-08 17:53:14', 0),
(39, 29, 'Overall', '1.00', 1, '1.00', '2019-04-08 17:54:43', 0),
(40, 30, 'Interior', '1.00', 1, '1.00', '2019-04-08 17:55:44', 0),
(41, 31, 'All', '1.00', 1, '1.00', '2019-04-08 17:56:42', 0),
(42, 32, 'All', '1.00', 1, '1.00', '2019-04-08 17:58:18', 0),
(43, 33, 'Interior', '1.00', 1, '1.00', '2019-04-08 17:59:56', 0),
(44, 34, 'All', '1.00', 1, '1.00', '2019-04-08 18:01:26', 0),
(45, 35, 'Watercloset', '1.00', 1, '1.00', '2019-04-08 18:02:28', 0),
(46, 35, 'Lavatory', '1.00', 1, '1.00', '2019-04-08 18:02:32', 0),
(47, 35, 'Shower', '1.00', 1, '1.00', '2019-04-08 18:02:35', 0),
(48, 35, 'Shower Enclosure', '1.00', 1, '1.00', '2019-04-08 18:02:39', 0),
(50, 26, 'part 2', '5.00', 2, '5.00', '2019-06-25 10:08:06', 0);

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
  `Payment_Message` varchar(1000) NOT NULL,
  `Place_Id` int(11) NOT NULL,
  `Payment_PlaceStatus` tinyint(1) NOT NULL DEFAULT '0',
  `Payment_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Payment_Status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_Id`, `Project_Id`, `Payment_ReceiptDate`, `PaymentType_Id`, `Payment_ReceiptStatus`, `Payment_AppointmentDate`, `Payment_AppointmentStatus`, `Payment_Message`, `Place_Id`, `Payment_PlaceStatus`, `Payment_DateCreated`, `Payment_Status`) VALUES
(6, 59, '2019-06-06', 4, 1, '2019-06-07', 1, 'See you at Starbucks, 2nd Floor at Glorietta at 3:00PM!', 7, 0, '2019-06-05 17:27:19', 0),
(7, 61, '2019-06-06', 4, 1, '2019-06-17', 0, '', 8, 0, '2019-06-06 02:04:46', 0),
(8, 63, '2019-06-06', 4, 2, '0000-00-00', 0, '', 0, 0, '2019-06-06 02:53:46', 0),
(9, 64, '2019-06-06', 2, 1, '0000-00-00', 0, '', 0, 0, '2019-06-06 03:23:26', 0),
(10, 67, '2019-06-05', 4, 1, '2019-06-21', 1, 'At Glorietta, JCO 4PM', 7, 0, '2019-06-06 08:46:50', 0),
(11, 68, '2019-06-21', 4, 1, '1111-11-11', 1, '', 12, 0, '2019-06-06 08:56:24', 0),
(12, 47, '2019-06-10', 2, 1, '2019-06-10', 0, '', 7, 0, '2019-06-09 07:49:39', 0),
(18, 49, '2019-06-06', 2, 1, '0000-00-00', 0, 'asdasd', 0, 0, '2019-06-09 08:26:46', 0),
(22, 53, '2019-06-19', 2, 2, '0000-00-00', 0, 'sorry', 0, 0, '2019-06-09 08:30:17', 0),
(23, 51, '2019-06-04', 2, 1, '2019-06-12', 1, '', 7, 0, '2019-06-09 08:32:34', 0),
(24, 50, '2019-06-05', 2, 1, '2019-06-06', 2, 'denied', 8, 0, '2019-06-09 08:33:57', 0);

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
(16, 'alfer.coronel@gmail.com', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', ''),
(17, 'anneereyes10@gmail.com', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', ''),
(18, 'alfer.lance.coronel@gmail.com', 'None', 'None', 'None', '0000-00-00', '0000-00-00', '', '');

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
(7, 'Makati City', 0, '2019-03-29 07:41:31'),
(8, 'Las Pinas City', 0, '2019-03-29 07:41:43'),
(9, 'Paranaque City', 0, '2019-03-29 07:41:53'),
(10, 'Muntinlupa City', 0, '2019-03-29 07:42:00'),
(11, 'Eastwood', 0, '2019-06-02 15:59:47');

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
(4, 'Autumn', 'Two-Storey House\r\n\r\n4 Bedrooms\r\n3 Bathrooms\r\n2 Car Garage', 180, 3272000, 4, 3, 2, '2019-04-01 18:18:12', 0),
(6, 'Summer', 'Two-Storey\r\n5 Bedrooms\r\n3 Bathrooms\r\n1 Car Garage\r\n\r\nTotal Flr Area - 153 SQM\r\nMinimum Lot Area - 120 SQM', 153, 2234000, 5, 3, 1, '2019-06-05 18:49:13', 0);

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
(36, 1, 2, 'Construction Coordination', 5, '2019-04-22 22:23:26', 0),
(37, 2, 2, 'sfdf', 13, '2019-04-22 22:38:01', 0),
(38, 1, 4, 'Construction Coordination', 5, '2019-04-23 07:31:57', 0),
(39, 1, 4, 'Construction Coordination', 5, '2019-04-23 07:33:33', 0),
(40, 1, 4, 'Construction Coordination', 5, '2019-04-23 07:37:39', 0),
(41, 1, 2, 'Construction Coordination', 5, '2019-04-30 06:42:30', 0),
(42, 1, 2, 'As-Built Plans', 6, '2019-05-01 19:07:11', 0),
(43, 1, 2, 'Construction Coordination', 5, '2019-05-07 09:54:43', 0),
(44, 1, 2, 'Construction Coordination', 5, '2019-05-07 10:15:31', 0),
(45, 1, 2, 'Site Visit and Inspections', 7, '2019-05-07 10:22:33', 0),
(46, 1, 2, 'Construction Coordination', 5, '2019-05-07 10:24:26', 0),
(47, 1, 1, 'Construction Coordination (ref: #47)', 5, '2019-05-11 12:37:05', 0),
(48, 1, 1, 'As-Built Plans (ref: #48)', 6, '2019-05-11 12:38:59', 0),
(49, 2, 1, 'asd', 14, '2019-05-11 12:40:52', 0),
(50, 1, 1, 'Site Visit and Inspections (ref: #50)', 7, '2019-05-11 12:42:36', 0),
(51, 1, 1, 'Construction Coordination (ref: #51)', 5, '2019-05-11 12:44:53', 0),
(52, 1, 1, 'Construction Coordination (ref: #52)', 5, '2019-05-11 12:46:28', 0),
(53, 1, 1, 'Construction Coordination (ref: #53)', 5, '2019-05-11 12:47:03', 0),
(54, 1, 1, 'Construction Coordination (ref: #54)', 5, '2019-05-11 12:47:28', 0),
(55, 1, 1, 'Site Visit and Inspections (ref: #55)', 7, '2019-05-11 12:47:41', 0),
(56, 1, 1, 'As-Built Plans (ref: #56)', 6, '2019-05-11 12:48:06', 0),
(57, 2, 14, 'asdasd', 15, '2019-06-02 04:52:26', 0),
(58, 1, 14, 'Construction Coordination (ref: #58)', 5, '2019-06-02 16:00:53', 0),
(59, 0, 16, 'My Project 1', 4, '2019-06-05 17:23:11', 0),
(60, 0, 16, 'My Project 2', 4, '2019-06-05 17:53:06', 0),
(61, 0, 17, 'House and Lot in Las Pinas', 4, '2019-06-06 01:17:33', 0),
(62, 1, 17, 'Construction Coordination (ref: #62)', 5, '2019-06-06 02:05:06', 0),
(63, 1, 17, 'As-Built Plans (ref: #63)', 6, '2019-06-06 02:06:57', 0),
(64, 2, 17, 'Uploaded Plan (Test)', 16, '2019-06-06 02:08:56', 0),
(65, 1, 18, 'Construction Coordination (ref: #65)', 5, '2019-06-06 02:52:43', 0),
(66, 1, 17, 'As-Built Plans (ref: #66)', 6, '2019-06-06 08:42:33', 0),
(67, 0, 17, 'Sample Project ', 4, '2019-06-06 08:43:08', 0),
(68, 2, 17, 'Sample Upload ', 17, '2019-06-06 08:55:37', 0),
(69, 0, 17, 'Sample2', 4, '2019-06-06 09:02:27', 0),
(70, 0, 1, 'project 1', 4, '2019-06-09 10:52:18', 0);

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
(5, 'Construction Coordination', '(meetings with consultants, other designers, contractors, suppliers and client)', 2500, 0, '2019-04-01 17:52:57'),
(6, 'As-Built Plans', '(Drawings produce after construction. Reflecting. changes done on site different from the initial plans)\r\n\r\nInitial payment = Php 1,200.00', 1200, 0, '2019-04-01 17:54:00'),
(7, 'Site Visit and Inspections', 'External evaluation team goes to an institution to evaluate verbal, written and visual evidence.', 2500, 0, '2019-04-01 17:55:29');

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
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `Unit_Id` int(11) NOT NULL,
  `Unit_Name` varchar(100) NOT NULL,
  `Unit_Nickname` varchar(50) NOT NULL,
  `Unit_Conversion` int(11) NOT NULL,
  `Unit_DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Unit_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`Unit_Id`, `Unit_Name`, `Unit_Nickname`, `Unit_Conversion`, `Unit_DateCreated`, `Unit_Status`) VALUES
(1, 'Inch', 'in', 25400, '2019-06-25 16:39:03', 0),
(2, 'Feet', 'ft', 304800, '2019-06-25 16:40:04', 0),
(3, 'Yard', 'yd', 914400, '2019-06-25 16:41:02', 0),
(4, 'Meter', 'm', 1000000, '2019-06-25 16:43:18', 0),
(5, 'Kilometer', 'km', 1000000000, '2019-06-25 16:43:55', 0),
(6, 'Centimeter', 'cm', 10000, '2019-06-25 16:44:21', 0),
(7, 'Millimeter', 'mm', 1000, '2019-06-25 16:44:49', 0);

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
  `Upgrade_Width` int(11) NOT NULL,
  `Upgrade_Height` int(11) NOT NULL,
  `Unit_Id` int(11) NOT NULL,
  `Upgrade_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Upgrade_Status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upgrade`
--

INSERT INTO `upgrade` (`Upgrade_Id`, `Part_Id`, `Upgrade_Name`, `Upgrade_Description`, `Upgrade_Price`, `Upgrade_PriceType`, `Upgrade_Width`, `Upgrade_Height`, `Unit_Id`, `Upgrade_DateCreated`, `Upgrade_Status`) VALUES
(3, 4, 'Upgrade 3', ' Upgrade 3 Description ', '111', 0, 1, 1, 1, '2019-02-17 09:53:50', 0),
(5, 4, 'Upgrade 1', ' Upgrade 1Upgrade 1', '123', 0, 1, 1, 1, '2019-02-17 10:01:13', 0),
(7, 7, 'Upgrade 1', ' Upgrade 1 desc', '123', 0, 1, 1, 1, '2019-03-05 21:12:34', 0),
(8, 7, 'Upgrade 2', ' Upgrade 2Upgrade 2', '234', 1, 1, 1, 1, '2019-03-05 21:12:52', 0),
(9, 11, 'Kohler Lavatory Pedestal', ' ', '16000', 1, 1, 1, 1, '2019-04-02 05:25:18', 0),
(10, 11, 'Kohler Undermount Sink with Cabinet', ' ', '25000', 1, 1, 1, 1, '2019-04-02 05:28:49', 0),
(11, 11, 'Kohler Undermount Sink', ' ', '20000', 1, 1, 1, 1, '2019-04-02 05:30:04', 0),
(12, 12, 'Centralized Water Heater', ' ', '3000', 1, 1, 1, 1, '2019-04-02 05:56:12', 0),
(13, 12, 'Kohler Portrait Digital Interface', ' ', '8300', 1, 1, 1, 1, '2019-04-02 05:57:30', 0),
(14, 29, 'Carpet Flooring', ' ', '105000', 0, 1, 1, 1, '2019-06-05 18:00:29', 0),
(15, 47, 'Centralized Water Heater', ' ', '8000', 0, 1, 1, 1, '2019-06-05 18:33:50', 0),
(16, 50, '12', ' 34', '23', 1, 45, 56, 3, '2019-06-25 14:19:55', 0),
(17, 50, 'area', ' 234', '666', 0, 999, 888, 5, '2019-06-25 15:22:06', 0),
(18, 50, 'piece', '444', '555', 1, 666, 777, 3, '2019-06-25 15:22:22', 0);

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
(16, 'Uploaded a Demo File for Testing purposes only. :)', '2019-06-06 02:08:56', 0),
(17, 'Ettc ', '2019-06-06 08:55:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `uploadplace`
--

CREATE TABLE `uploadplace` (
  `UploadPlace_Id` int(11) NOT NULL,
  `UploadPlace_Place` varchar(200) NOT NULL,
  `UploadPlace_DateTime` datetime NOT NULL,
  `UploadPlace_Used` tinyint(4) NOT NULL DEFAULT '0',
  `UploadPlace_DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UploadPlace_Status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploadplace`
--

INSERT INTO `uploadplace` (`UploadPlace_Id`, `UploadPlace_Place`, `UploadPlace_DateTime`, `UploadPlace_Used`, `UploadPlace_DateCreated`, `UploadPlace_Status`) VALUES
(12, 'Makati, Glorietta', '2019-06-06 14:32:00', 1, '2019-06-06 08:58:23', 0);

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
(1154, 59, 36, 0),
(1155, 59, 26, 0),
(1156, 59, 30, 0),
(1157, 59, 44, 0),
(1158, 59, 48, 0),
(1159, 59, 53, 0),
(1160, 59, 57, 0),
(1161, 59, 61, 0),
(1162, 59, 40, 0),
(1163, 59, 71, 0),
(1164, 59, 67, 0),
(1165, 59, 63, 0),
(1166, 59, 75, 0),
(1167, 59, 83, 0),
(1168, 59, 87, 0),
(1169, 59, 85, 0),
(1170, 59, 89, 0),
(1171, 59, 94, 0),
(1172, 59, 93, 0),
(1173, 59, 96, 0),
(1174, 59, 98, 0),
(1175, 59, 100, 0),
(1176, 59, 102, 0),
(1177, 59, 104, 0),
(1178, 59, 108, 0),
(1179, 59, 110, 0),
(1180, 59, 116, 0),
(1181, 59, 111, 0),
(1182, 59, 113, 0),
(1183, 59, 115, 0),
(1184, 59, 81, 0),
(1185, 59, 92, 0),
(1186, 59, 106, 0),
(1303, 60, 36, 0),
(1304, 60, 26, 0),
(1305, 60, 30, 0),
(1306, 60, 44, 0),
(1307, 60, 48, 0),
(1308, 60, 53, 0),
(1309, 60, 57, 0),
(1310, 60, 61, 0),
(1311, 60, 40, 0),
(1312, 60, 71, 0),
(1313, 60, 67, 0),
(1314, 60, 63, 0),
(1315, 60, 75, 0),
(1316, 60, 83, 0),
(1317, 60, 87, 0),
(1318, 60, 85, 0),
(1319, 60, 89, 0),
(1320, 60, 102, 0),
(1321, 60, 104, 0),
(1322, 60, 108, 0),
(1323, 60, 110, 0),
(1324, 60, 116, 0),
(1325, 60, 111, 0),
(1326, 60, 113, 0),
(1327, 60, 115, 0),
(1328, 60, 106, 0),
(1329, 60, 81, 0),
(1330, 60, 91, 0),
(1331, 60, 94, 0),
(1332, 60, 93, 0),
(1333, 60, 96, 0),
(1334, 60, 98, 0),
(1335, 60, 100, 0),
(1336, 61, 82, 0),
(1337, 61, 0, 14),
(1338, 61, 120, 0),
(1339, 61, 88, 0),
(1340, 61, 125, 0),
(1341, 61, 127, 0),
(1342, 61, 133, 0),
(1343, 61, 95, 0),
(1344, 61, 153, 0),
(1345, 61, 130, 0),
(1346, 61, 140, 0),
(1347, 61, 129, 0),
(1348, 61, 138, 0),
(1349, 61, 135, 0),
(1350, 61, 132, 0),
(1351, 61, 109, 0),
(1352, 61, 137, 0),
(1353, 61, 149, 0),
(1356, 61, 143, 0),
(1357, 61, 146, 0),
(1358, 61, 0, 15),
(1359, 61, 147, 0),
(1393, 67, 39, 0),
(1394, 67, 29, 0),
(1395, 67, 33, 0),
(1396, 67, 35, 0),
(1397, 67, 47, 0),
(1398, 67, 51, 0),
(1399, 67, 56, 0),
(1400, 67, 60, 0),
(1403, 67, 124, 0),
(1404, 67, 126, 0),
(1405, 67, 128, 0),
(1406, 67, 133, 0),
(1407, 67, 151, 0),
(1408, 67, 153, 0),
(1409, 67, 131, 0),
(1410, 67, 141, 0),
(1411, 67, 129, 0),
(1412, 67, 139, 0),
(1413, 67, 135, 0),
(1414, 67, 132, 0),
(1415, 67, 109, 0),
(1416, 67, 137, 0),
(1417, 67, 149, 0),
(1418, 67, 143, 0),
(1419, 67, 146, 0),
(1420, 67, 147, 0),
(1421, 67, 81, 0),
(1423, 67, 83, 0),
(1457, 69, 37, 0),
(1458, 69, 27, 0),
(1459, 69, 31, 0),
(1460, 69, 45, 0),
(1461, 69, 49, 0),
(1462, 69, 54, 0),
(1463, 69, 58, 0),
(1464, 69, 84, 0),
(1465, 69, 88, 0),
(1466, 69, 86, 0),
(1467, 69, 90, 0),
(1468, 69, 92, 0),
(1469, 69, 95, 0),
(1470, 69, 97, 0),
(1471, 69, 99, 0),
(1472, 69, 101, 0),
(1473, 69, 103, 0),
(1474, 69, 105, 0),
(1475, 69, 107, 0),
(1476, 69, 109, 0),
(1477, 69, 117, 0),
(1478, 69, 112, 0),
(1479, 69, 114, 0),
(1480, 69, 115, 0),
(1481, 69, 93, 0),
(1482, 69, 110, 0),
(1483, 69, 118, 0),
(1517, 70, 36, 0),
(1518, 70, 26, 0),
(1519, 70, 30, 0),
(1520, 70, 44, 0),
(1521, 70, 48, 0),
(1522, 70, 53, 0),
(1523, 70, 57, 0),
(1524, 70, 61, 0),
(1525, 70, 40, 0),
(1526, 70, 71, 0),
(1527, 70, 67, 0),
(1528, 70, 63, 0),
(1529, 70, 75, 0),
(1534, 70, 102, 0),
(1535, 70, 104, 0),
(1536, 70, 108, 0),
(1537, 70, 110, 0),
(1538, 70, 116, 0),
(1539, 70, 111, 0),
(1540, 70, 113, 0),
(1541, 70, 115, 0),
(1542, 70, 106, 0),
(1544, 70, 91, 0),
(1547, 70, 96, 0),
(1548, 70, 98, 0),
(1549, 70, 100, 0),
(1550, 70, 158, 0),
(1551, 70, 95, 0),
(1552, 70, 0, 14),
(1553, 70, 118, 0),
(1554, 70, 84, 0),
(1555, 70, 123, 0),
(1556, 70, 126, 0),
(1557, 70, 90, 0),
(1558, 69, 164, 0),
(1559, 69, 0, 17);

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
(16, '112.207.5.148', 'alfer.coronel@gmail.com', '123', 'Alfer Lance A. Coronel', '1996-02-14', 'male', '09568177846', 'Guadalupe Nuevo, Makati City'),
(17, '122.54.108.202', '2@2', '2', 'Anne Reyes', '1999-12-10', 'female', '09281236549', 'Las Pinas'),
(18, '112.207.5.148', 'alfer.lance.coronel@gmail.com', '123', 'Alfer Coronel', '1996-02-14', 'male', '9568177846', 'Cabanatuan City, Nueva Ecija');

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
  ADD PRIMARY KEY (`Services_Id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`Unit_Id`);

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
  ADD PRIMARY KEY (`UploadPlace_Id`);

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `finish`
--
ALTER TABLE `finish`
  MODIFY `Finish_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `finishitem`
--
ALTER TABLE `finishitem`
  MODIFY `FinishItem_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `Image_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `Material_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `Part_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `paymenttype`
--
ALTER TABLE `paymenttype`
  MODIFY `PaymentType_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `Place_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `Plan_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plan_info`
--
ALTER TABLE `plan_info`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `Project_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `Services_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `Unit_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `Upgrade_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `Upload_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `uploadplace`
--
ALTER TABLE `uploadplace`
  MODIFY `UploadPlace_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userproject`
--
ALTER TABLE `userproject`
  MODIFY `UserProject_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1560;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_account_p`
--
ALTER TABLE `user_account_p`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
