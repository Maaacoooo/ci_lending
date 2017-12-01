-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2017 at 05:51 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redwoods`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `sex` tinyint(1) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `education` int(11) DEFAULT NULL COMMENT 'related to borrowers_educ',
  `spouse` int(11) DEFAULT NULL COMMENT 'related to borrowers_spouse',
  `bplace` int(11) DEFAULT NULL COMMENT 'related to borrowers_address',
  `img` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowers`
--

INSERT INTO `borrowers` (`id`, `firstname`, `middlename`, `lastname`, `sex`, `civil_status`, `birthdate`, `education`, `spouse`, `bplace`, `img`, `created_at`, `updated_at`, `is_deleted`) VALUES
('2017-00001', 'John', 'Lorem', 'Doe', 1, 'Single', '2018-03-01', NULL, NULL, NULL, './uploads/borrowers/2017-00001/04a463a6d82a063ace9f78f4bf3bfd95.jpg', '2017-12-01 16:23:34', '2017-12-01 09:34:59', 0),
('2017-00002', 'asdasdasd', 'adsasdasdasd', 'aasdasdasd', 1, '', '2018-03-01', NULL, NULL, NULL, './uploads/borrowers/2017-00002/8f17637c92882ae7f70efc60edeb735c.jpg', '2017-12-01 16:24:44', '2017-12-01 08:24:44', 0),
('2017-00003', 'asdasdasd', 'adsasdasdasd', 'aasdasdasd', 1, '', '2018-03-01', 6, NULL, NULL, './uploads/borrowers/2017-00003/b543801b9bfbf2e32a8399262b37a7da.jpg', '2017-12-01 16:25:15', '2017-12-01 08:25:15', 0),
('2017-00004', 'NICE', 'MAH', 'BOI', 1, '', '2018-03-01', 12, NULL, NULL, './uploads/borrowers/2017-00004/b22c2dbf283b9e83bc836f7b64eb5bc2.jpg', '2017-12-01 16:30:00', '2017-12-01 08:30:00', 0),
('2017-00005', 'Ella', 'Bonifacio', 'Cruz', 0, 'Married', '1997-12-01', 1, 1, 7, NULL, '2017-12-01 16:32:34', '2017-12-01 13:47:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrowers_address`
--

CREATE TABLE `borrowers_address` (
  `id` int(11) NOT NULL,
  `borrower_id` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '0 = bplace; 1 = home; 2 = current; 3 = other',
  `building` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowers_address`
--

INSERT INTO `borrowers_address` (`id`, `borrower_id`, `type`, `building`, `street`, `barangay`, `city`, `zip`, `province`, `country`) VALUES
(1, '2017-00003', 0, 'asdasdasd', 'hjkj', 'asasdasdasd', 'hjk', '456456', 'jhhj', ''),
(2, '2017-00003', 1, 'asdasdas;ldasl;dk', 'asdsadasdasd', 'aklsjklasjdklasdj', 'asdlkjasdkljaskd', '123123', 'lkajdaklsjdkl', ''),
(3, '2017-00003', 2, 'Cortes Residenceasdasd', 'asdasdasd', 'asdad', 'aldkjaskldjaskldj', '456456', 'lkajssdkljasdklj', ''),
(4, '2017-00004', 0, 'asdasdasd', 'hjkj', 'asasdasdasd', 'hjk', '456456', 'jhhj', ''),
(5, '2017-00004', 1, 'asdasdas;ldasl;dk', 'asdsadasdasd', 'aklsjklasjdklasdj', 'asdlkjasdkljaskd', '123123', 'lkajdaklsjdkl', ''),
(6, '2017-00004', 2, 'Cortes Residenceasdasd', 'asdasdasd', 'asdad', 'aldkjaskldjaskldj', '456456', 'lkajssdkljasdklj', ''),
(7, '2017-00005', 0, 'Nice', 'huhju', 'Nice', 'Pagadian', '7200', 'Zamboanga Del Norte', 'Philippines'),
(8, '2017-00005', 1, 'asdasdas;ldasl;dk', 'asdsadasdasd', 'aklsjklasjdklasdj', 'asdlkjasdkljaskd', '123123', 'lkajdaklsjdkl', ''),
(9, '2017-00005', 2, 'Cruz Residence', 'Prk Luz', 'Ipil Heights', 'Ipil', '7001', 'Zamboanga Sibugay', 'Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `borrowers_contacts`
--

CREATE TABLE `borrowers_contacts` (
  `id` int(11) NOT NULL,
  `borrower_id` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowers_contacts`
--

INSERT INTO `borrowers_contacts` (`id`, `borrower_id`, `type`, `value`) VALUES
(1, '2017-00003', 0, '(212) 121-2121'),
(2, '2017-00003', 0, '(212) 121-2121'),
(3, '2017-00003', 0, '(121) 212-1212'),
(4, '2017-00003', 1, '1asdasdasd@gmail.com'),
(5, '2017-00003', 1, '1asdasdasd@gmail.com'),
(6, '2017-00003', 1, '1asdasdasd@gmail.com'),
(7, '2017-00004', 0, '(212) 121-2121'),
(8, '2017-00004', 0, '(212) 121-2121'),
(9, '2017-00004', 0, '(121) 212-1212'),
(10, '2017-00004', 1, '1asdasdasd@gmail.com'),
(11, '2017-00004', 1, '1asdasdasd@gmail.com'),
(12, '2017-00004', 1, '1asdasdasd@gmail.com'),
(13, '2017-00005', 0, '(212) 121-2121'),
(14, '2017-00005', 0, '(212) 121-2121'),
(15, '2017-00005', 0, '(121) 212-1212'),
(16, '2017-00005', 1, '1asdasdasd@gmail.com'),
(17, '2017-00005', 1, '1asdasdasd@gmail.com'),
(18, '2017-00005', 1, '1asdasdasd@gmail.com'),
(19, '2017-00005', 0, '(905) 820-8455'),
(20, '2017-00005', 1, 'johntest@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `borrowers_educ`
--

CREATE TABLE `borrowers_educ` (
  `id` int(11) NOT NULL,
  `borrower_id` varchar(255) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL COMMENT '0 = elem; 1 = hs; 2 = col; 3 = under',
  `school` varchar(255) DEFAULT NULL,
  `course` varchar(255) NOT NULL,
  `year` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `borrowers_educ`
--

INSERT INTO `borrowers_educ` (`id`, `borrower_id`, `level`, `school`, `course`, `year`) VALUES
(1, '2017-00005', 2, 'STI Dipolog', 'BSCS', '2017');

-- --------------------------------------------------------

--
-- Table structure for table `borrowers_spouse`
--

CREATE TABLE `borrowers_spouse` (
  `id` int(11) NOT NULL,
  `borrower_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `bplace` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `work_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `borrowers_spouse`
--

INSERT INTO `borrowers_spouse` (`id`, `borrower_id`, `fname`, `mname`, `lname`, `bdate`, `bplace`, `contact`, `occupation`, `work_address`) VALUES
(1, '2017-00005', 'John', 'Great', 'Doe', '1994-07-22', 'Dipolog Ciy', '(564) 564-5646', 'Programmer', 'Dipolog City');

-- --------------------------------------------------------

--
-- Table structure for table `borrowers_work`
--

CREATE TABLE `borrowers_work` (
  `id` int(11) NOT NULL,
  `borrower_id` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '0 =private ; 1 = government; NULL = self-employed',
  `employer_business` varchar(255) DEFAULT NULL,
  `position_nature` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date_started` date DEFAULT NULL,
  `date_ended` date DEFAULT NULL,
  `tel_no` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowers_work`
--

INSERT INTO `borrowers_work` (`id`, `borrower_id`, `type`, `employer_business`, `position_nature`, `address`, `date_started`, `date_ended`, `tel_no`, `status`, `remarks`) VALUES
(1, '2017-00003', NULL, 'adasdasdasda', 'asdasdasdasd', 'hjkj', '2016-02-00', NULL, '(965) 545-4568', 'as56d456as4d56as4d564asd', 'asdadadasdas'),
(2, '2017-00003', 1, 'Dipolgahdjash', 'qasddsadsda', 'asdasdasd', '0000-00-00', NULL, '(545) 645-6456', 'asdasda', 'asdasdasdasd'),
(3, '2017-00004', NULL, 'adasdasdasda', 'asdasdasdasd', 'hjkj', '0000-00-00', NULL, '(965) 545-4568', 'as56d456as4d56as4d564asd', 'asdadadasdas'),
(4, '2017-00004', 1, 'Dipolgahdjash', 'qasddsadsda', 'asdasdasd', '0000-00-00', NULL, '(545) 645-6456', 'asdasda', 'asdasdasdasd'),
(5, '2017-00005', NULL, 'Botoy\'s', 'Food and Resto', 'Oroquieta City, Misamis Occidental', '2012-07-07', NULL, '(965) 545-4568', 'as56d456as4d56as4d564asd', 'asdadadasdas'),
(6, '2017-00005', 1, 'DPWH IX', 'Civil Engineer', 'Dipolog City', '2014-04-21', NULL, '(545) 645-6456', 'asdasda', 'asdasdasdasd'),
(7, '2017-00005', 0, 'Innova Systems', 'Software Developer', 'Dipolog City', '2014-04-21', NULL, '(545) 645-6456', 'asdasda', 'asdasdasdasd'),
(8, '2017-00005', NULL, 'Citi Hardware', 'Hardware', 'Dapitan', '0000-00-00', NULL, '(062) 333-5309', 'Working', 'Wow Nice'),
(9, '2017-00005', NULL, 'CrownTech', 'Industrial Shop', 'Dipolog', '2010-09-06', NULL, '(454) 545-4564', 'asdasdasd', 'asdasdasdasd'),
(10, '2017-00005', 1, 'PNP-CIDG 9', 'Agent', 'Pagadian City, Zamboanga del Sur', '0000-00-00', NULL, '(554) 545-4545', 'asdasdasdasd', 'asdasdasdsad');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('n7u1u4j110d81nsu262mek8rfknfmtl9', '::1', 1512146979, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531323134363837303b6572726f727c733a33313a224572726f72204f63637572656421204e6f2066696c652075706c6f61646564223b737563636573737c733a31393a2257656c636f6d65206261636b2061646d696e21223b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` varchar(255) NOT NULL,
  `borrower_id` varchar(255) DEFAULT NULL,
  `borrowed_amount` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `borrowed_percentage` decimal(10,2) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loans_creditors`
--

CREATE TABLE `loans_creditors` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loans_fee`
--

CREATE TABLE `loans_fee` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `fee_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loans_payment`
--

CREATE TABLE `loans_payment` (
  `id` varchar(255) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `payee` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `official_receipt` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag_id` varchar(225) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `ip_address` varchar(15) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `email`, `contact`, `usertype`, `img`, `created_at`, `updated_at`, `is_deleted`) VALUES
('admin', '$2y$10$mt9rqihNCu6CVMnAcyqOreGwmO4yh2rgD9zvODgvxcpcDHvMIMcm6', 'Administrator', 'admin@admin.com', '1234567890', 'Administrator', './uploads/users/admin/b770d94c8b5e5d9b17c109db881469d8.png', '2017-09-27 15:22:36', '2017-11-22 14:37:41', 0),
('test', '$2y$10$L/bwEx4n7YP2.JlGciB22.VM9q3xxb/um1EvFi2eUN4GzA3uamUsS', 'NICE OBNE ', 'nice.nice@nice.com', '1132101223', '2nd Account', './uploads/users/Maikoo/4e828ac7e7d00fa179d8bb9a2553b183.png', '2017-11-22 22:41:23', '2017-12-01 16:48:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `title` varchar(255) NOT NULL,
  `user_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`title`, `user_level`) VALUES
('2nd Account', 5),
('Administrator', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowers_address`
--
ALTER TABLE `borrowers_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_borrowerAddr` (`borrower_id`);

--
-- Indexes for table `borrowers_contacts`
--
ALTER TABLE `borrowers_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKBorrowerContact` (`borrower_id`);

--
-- Indexes for table `borrowers_educ`
--
ALTER TABLE `borrowers_educ`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKBorrowersEduc` (`borrower_id`);

--
-- Indexes for table `borrowers_spouse`
--
ALTER TABLE `borrowers_spouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKBorrowersSpouse` (`borrower_id`);

--
-- Indexes for table `borrowers_work`
--
ALTER TABLE `borrowers_work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKBorrowerWork` (`borrower_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKBorrowerLoan` (`borrower_id`);

--
-- Indexes for table `loans_creditors`
--
ALTER TABLE `loans_creditors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKLoanCreditors` (`loan_id`);

--
-- Indexes for table `loans_fee`
--
ALTER TABLE `loans_fee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKLoanFees` (`loan_id`),
  ADD KEY `FKFee` (`fee_id`);

--
-- Indexes for table `loans_payment`
--
ALTER TABLE `loans_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKLoans` (`loan_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKUserlogs` (`user`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `FKUsertype` (`usertype`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowers_address`
--
ALTER TABLE `borrowers_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `borrowers_contacts`
--
ALTER TABLE `borrowers_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `borrowers_educ`
--
ALTER TABLE `borrowers_educ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `borrowers_spouse`
--
ALTER TABLE `borrowers_spouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `borrowers_work`
--
ALTER TABLE `borrowers_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loans_creditors`
--
ALTER TABLE `loans_creditors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loans_fee`
--
ALTER TABLE `loans_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowers_address`
--
ALTER TABLE `borrowers_address`
  ADD CONSTRAINT `FK_borrowerAddr` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `borrowers_contacts`
--
ALTER TABLE `borrowers_contacts`
  ADD CONSTRAINT `FKBorrowerContact` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `borrowers_educ`
--
ALTER TABLE `borrowers_educ`
  ADD CONSTRAINT `FKBorrowersEduc` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`);

--
-- Constraints for table `borrowers_spouse`
--
ALTER TABLE `borrowers_spouse`
  ADD CONSTRAINT `FKBorrowersSpouse` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`);

--
-- Constraints for table `borrowers_work`
--
ALTER TABLE `borrowers_work`
  ADD CONSTRAINT `FKBorrowerWork` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `FKBorrowerLoan` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `loans_creditors`
--
ALTER TABLE `loans_creditors`
  ADD CONSTRAINT `FKLoanCreditors` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`);

--
-- Constraints for table `loans_fee`
--
ALTER TABLE `loans_fee`
  ADD CONSTRAINT `FKFee` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`id`),
  ADD CONSTRAINT `FKLoanFees` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`);

--
-- Constraints for table `loans_payment`
--
ALTER TABLE `loans_payment`
  ADD CONSTRAINT `FKLoans` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `FKUserlogs` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FKUsertype` FOREIGN KEY (`usertype`) REFERENCES `usertypes` (`title`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
