
create database designbuild
CREATE TABLE `admin_account` (
  `id` int(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `email`, `password`) VALUES
(1, 'alfer.coronel@gmail.com', 'alfer');

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
(43, '::1', 'jaaj@gmail.com', 'jaaj', 'Jaaj Almendra', NULL, '', '', '');

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;