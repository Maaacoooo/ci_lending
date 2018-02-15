-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2018 at 11:11 AM
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
('2018-00001', 'Maco', 'Gallemit', 'Cortes', 1, 'Married', '1997-06-10', 1, 1, 1, './uploads/borrowers/2018-00001/fe6743eb2074556d20c9dcc7184e2620.jpg', '2018-02-08 20:37:15', '2018-02-13 06:19:44', 0),
('2018-00002', 'Eric', 'Test', 'Yap', 1, 'Single', '1994-06-14', 2, NULL, NULL, NULL, '2018-02-09 19:34:31', '2018-02-13 07:16:56', 1),
('2018-00003', 'asdasdasda', 'asdad', 'asdadasdsa', 1, 'Single', '2018-02-11', 3, NULL, NULL, NULL, '2018-02-11 10:33:26', '2018-02-13 07:16:59', 1),
('2018-00004', 'asdadasdas', 'sd', 'asdasd', 1, 'Single', '2018-02-11', 4, NULL, NULL, './uploads/borrowers/2018-00004/7abd192c50a516b340d75d25a6a0571a.jpg', '2018-02-11 16:24:00', '2018-02-11 08:24:00', 0),
('2018-00005', 'asdasdas', 'dasdasda', 'asdasdasd', 1, 'Single', '2018-02-11', 5, NULL, NULL, NULL, '2018-02-11 16:29:03', '2018-02-11 08:29:03', 0);

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
(1, '2018-00001', 0, 'Polanco Koi Farm', 'Nat\'l Highway', 'Lingasad', 'Polanco', '7101', 'Zamboanga del Norte', 'Philippines'),
(2, '2018-00001', 1, 'Cortes Residence', 'Purok Luz', 'Ipil Heights', 'Ipil', '7001', 'Zamboanga Sibugay', 'Philippines'),
(3, '2018-00001', 2, 'Polanco Koi', 'Nat\'l Highway', 'Lingasad', 'Polanco', '7101', 'Zamboanga del Norte', 'Philippines'),
(4, '2018-00002', 0, 'yadghas', 'hjghjgh', 'ghjghjg', 'Salug', '7101', 'Zamboanga del Norte', 'Philippines'),
(5, '2018-00002', 1, 'akldskjdkasjk', 'adlkjasjd', 'adlkjaskdj', 'adkljaskdj', '34567', 'aldkjaskldj', 'Philippines'),
(6, '2018-00002', 2, 'akldskjdkasjk', 'adlkjasjd', 'adlkjaskdj', 'adkljaskdj', '34567', 'aldkjaskldj', 'Philippines'),
(7, '2018-00003', 0, 'asdadasdas', 'sadsadas', 'dasdasd', 'asdad', '12312', 'sadsada', 'Philippines'),
(8, '2018-00003', 1, 'sadasdadada', 'adasdasd', 'asdasdsad', 'asdasdas', '3234', 'dasdasdsa', 'Philippines'),
(9, '2018-00003', 2, 'sadasdadada', 'adasdasd', 'asdasdsad', 'asdasdas', '3234', 'dasdasdsa', 'Philippines'),
(10, '2018-00004', 0, 'asdsa', 'dasdas', 'dasdasd', 'asdsad', 'dasdasd', 'asda', 'Philippines'),
(11, '2018-00004', 1, 'asdasd', 'asdad', 'asdasd', 'asdasd', 'asdas', 'dasd', 'Philippines'),
(12, '2018-00004', 2, 'asdasd', 'asdad', 'asdasd', 'asdasd', 'asdas', 'dasd', 'Philippines'),
(13, '2018-00005', 0, 'asdasd', 'sadad', 'adadas', 'dasdas', 'dsadas', 'dsada', 'Philippines'),
(14, '2018-00005', 1, 'asdas', 'dasdad', 'aafsadfa', 'cvxdvxc', '34', 'fdfd', 'Philippines'),
(15, '2018-00005', 2, 'asdas', 'dasdad', 'aafsadfa', 'cvxdvxc', '34', 'fdfd', 'Philippines');

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
(1, '2018-00001', 0, '(905) 820-8455'),
(2, '2018-00001', 0, '(905) 820-8455'),
(3, '2018-00001', 0, '(947) 517-2398'),
(4, '2018-00001', 1, 'maco.techdepot@gmail.com'),
(5, '2018-00001', 1, 'maco.techdepot@gmail.com'),
(6, '2018-00001', 1, 'maco.techdepot@gmail.com'),
(7, '2018-00002', 0, '(234) 567-8912'),
(8, '2018-00002', 0, '(905) 820-8455'),
(9, '2018-00002', 0, ''),
(10, '2018-00002', 1, 'maco.techdepot@gmail.com'),
(11, '2018-00002', 1, ''),
(12, '2018-00002', 1, ''),
(13, '2018-00003', 0, '(213) 123-123_'),
(14, '2018-00003', 0, ''),
(15, '2018-00003', 0, ''),
(16, '2018-00003', 1, '1asdasdasd@gmail.com'),
(17, '2018-00003', 1, '1asdasdasd@gmail.com'),
(18, '2018-00003', 1, '1asdasdasd@gmail.com'),
(19, '2018-00004', 0, '(123) 131-2312'),
(22, '2018-00004', 1, 'asdasdas@asd.com'),
(23, '2018-00004', 1, ''),
(24, '2018-00004', 1, ''),
(25, '2018-00005', 0, '(231) 231-2312'),
(26, '2018-00005', 1, 'dfadsasdsadasd@asd.com'),
(27, '2018-00005', 1, 'asdasdad@axc.com');

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
(1, '2018-00001', 3, 'STI Dipolog', 'BSCS', '2018'),
(2, '2018-00002', 0, 'STI', 'BSCS', '2018'),
(3, '2018-00003', 0, 'sadasdas', 'asdasdsa', '123'),
(4, '2018-00004', 2, 'STI Dipolog', 'BSCS', '2018'),
(5, '2018-00005', 1, 'STI Dipolog', 'BSCS', '2017');

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
(1, '2018-00001', 'Erika Jones', 'Padilla', 'Flores', '2018-02-18', 'Ipil, Zamboanga Sibugay', '(091) 785-2112', 'N/A', 'N/A');

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
(1, '2018-00001', NULL, 'Tech Depot', 'Tech Firm', 'Dipolog City', '2016-07-06', NULL, '(905) 820-8455', '', ''),
(2, '2018-00001', 0, 'Strategic Technologies', 'Regional Sales Representative', 'China Town, 999 Bldg, #64, Bacolod City', '2013-10-04', NULL, '(032) 221-5545', 'N/A', 'N/A'),
(3, '2018-00002', 1, 'BFP', 'Fire Officer I', 'asdasdasdasd', '2018-02-16', NULL, '(234) 567-8945', '', ''),
(4, '2018-00003', 1, 'sdadsa', 'dsadas', 'asdsadsad', '2010-02-09', NULL, '(213) 123-1231', 'asdadasd', ''),
(5, '2018-00004', 0, 'asdsadasdsad', 'asdada', 'sada', '2018-02-13', NULL, '(213) 123-1232', 'adasdas', ''),
(6, '2018-00005', 1, 'asdas', 'dasdas', 'asdasda', '2018-01-29', NULL, '(231) 232-1312', 'daasds', '');

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
('9dblsennp8o4ggdplt7cpds6t9402s61', '::1', 1518603027, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531383630323834353b6572726f727c733a31383a22596f75206e65656420746f206c6f67696e21223b737563636573737c733a31393a2257656c636f6d65206261636b2061646d696e21223b7761726e696e677c613a313a7b693a303b733a35343a2254686520416d6f756e74206669656c64206d75737420636f6e7461696e2061206e756d6265722067726561746572207468616e20302e223b7d61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `approved_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title`) VALUES
(1, 'Rice / Food'),
(2, 'Basic Bills(Total)'),
(3, 'Rent'),
(4, 'Tuition'),
(5, 'Loan from Banks(Total)'),
(6, 'Others(Total)');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag_id` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `tag`, `tag_id`, `url`, `title`, `description`, `created_at`, `updated_at`, `user`) VALUES
(1, 'loan', '2018-00001-00001', './uploads//d300ebca79403aaf6e4de3df4f7d12cb.jpg', 'test', 'test', '2018-02-10 07:11:41', NULL, 'admin'),
(4, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/d6aff1a689caafce4a2615f510bec858.jpg', 'd6aff1a689caafce4a2615f510bec858.jpg', '', '2018-02-10 07:22:32', NULL, 'admin'),
(5, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/537a59aa3a1ade2848156425058dd8c1.jpg', '537a59aa3a1ade2848156425058dd8c1.jpg', '', '2018-02-10 07:41:33', NULL, 'admin'),
(6, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/a71b56ff853bc85dea53a9435eeb36ad.jpg', 'worpppp', '', '2018-02-10 07:41:43', NULL, 'admin'),
(7, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/cab9b6ced104547e097cf4790e802327.jpg', 'cab9b6ced104547e097cf4790e802327.jpg', 'cab9b6ced104547e097cf4790e802327.jpg', '2018-02-10 07:43:52', NULL, 'admin'),
(8, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/d0752001b66d6bcacf5fb75164d1560f.jpg', 'd0752001b66d6bcacf5fb75164d1560f.jpg', 'image/jpeg', '2018-02-10 07:44:25', NULL, 'admin'),
(9, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/Joseph.jpg', 'Joseph.jpg', 'image/jpeg', '2018-02-10 07:46:37', NULL, 'admin'),
(10, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/Joseph1.jpg', 'Joseph1.jpg', 'image/jpeg', '2018-02-10 07:46:44', NULL, 'admin'),
(12, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/CCTV_Pricelist.xlsx', 'CCTV_Pricelist.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '2018-02-10 07:47:16', NULL, 'admin'),
(13, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/unfinished_story_.docx', 'unfinished_story_.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2018-02-10 07:47:32', NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `title`) VALUES
(1, 'Salary & Allowances(Net Take Home)'),
(2, 'Spouse Salary & Allowances(Net Take Home)'),
(3, 'Farming'),
(4, 'Allotment'),
(5, 'Others(Total)');

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
  `status` tinyint(1) DEFAULT '0' COMMENT '0 = pending; 1 = approved; 2 = disapprove; 3 = closed; 4 = cancelled',
  `approved_at` datetime NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `borrower_id`, `borrowed_amount`, `due_date`, `borrowed_percentage`, `description`, `status`, `approved_at`, `created_at`, `updated_at`) VALUES
('2018-00001-00001', '2018-00001', '50000.00', '2018-10-04', '12.00', NULL, 2, '2018-02-10 01:32:18', '2018-02-10 00:44:37', '2018-02-11 13:35:35'),
('2018-00001-00002', '2018-00001', '50000.00', '2018-10-04', '12.00', NULL, 1, '2018-02-11 21:35:02', '2018-02-11 21:35:02', '2018-02-11 13:35:46'),
('2018-00002-00003', '2018-00002', '50000.00', '2018-07-04', '20.00', NULL, 2, '0000-00-00 00:00:00', '2018-02-11 21:38:44', '2018-02-13 07:40:32');

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

--
-- Dumping data for table `loans_creditors`
--

INSERT INTO `loans_creditors` (`id`, `loan_id`, `fullname`, `address`, `amount`, `remarks`) VALUES
(1, '2018-00001-00001', 'Testing', 'Test', '500.00', 'test'),
(2, '2018-00002-00003', '', '', '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `loans_expense`
--

CREATE TABLE `loans_expense` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `expense_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans_expense`
--

INSERT INTO `loans_expense` (`id`, `loan_id`, `expense_id`, `amount`) VALUES
(1, '2018-00001-00001', 1, '5000.00'),
(2, '2018-00001-00001', 2, '5000.00'),
(3, '2018-00001-00001', 3, '1000.00'),
(4, '2018-00001-00001', 4, '500.00'),
(5, '2018-00001-00001', 5, '0.00'),
(6, '2018-00001-00001', 6, '500.00'),
(7, '2018-00002-00003', 1, '5000.00'),
(8, '2018-00002-00003', 2, '5000.00'),
(9, '2018-00002-00003', 3, '12000.00'),
(10, '2018-00002-00003', 4, '1200.00'),
(11, '2018-00002-00003', 5, '23000.00'),
(12, '2018-00002-00003', 6, '8000.00');

-- --------------------------------------------------------

--
-- Table structure for table `loans_income`
--

CREATE TABLE `loans_income` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `income_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans_income`
--

INSERT INTO `loans_income` (`id`, `loan_id`, `income_id`, `amount`) VALUES
(1, '2018-00001-00001', 1, '12000.00'),
(2, '2018-00001-00001', 2, '7000.00'),
(3, '2018-00001-00001', 3, '3000.00'),
(4, '2018-00001-00001', 4, '1000.00'),
(5, '2018-00001-00001', 5, '2500.00'),
(6, '2018-00002-00003', 1, '12000.00'),
(7, '2018-00002-00003', 2, '2000.00'),
(8, '2018-00002-00003', 3, '200.00'),
(9, '2018-00002-00003', 4, '2000.00'),
(10, '2018-00002-00003', 5, '3500.00');

-- --------------------------------------------------------

--
-- Table structure for table `loans_ledger`
--

CREATE TABLE `loans_ledger` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `debit` decimal(10,2) DEFAULT NULL,
  `credit` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans_ledger`
--

INSERT INTO `loans_ledger` (`id`, `loan_id`, `code`, `description`, `debit`, `credit`, `created_at`, `user`) VALUES
(1, '2018-00001-00002', 'DISB', 'asdasdasdasdasdasd', '500.00', '0.00', '2018-02-10 01:41:11', 'admin'),
(2, '2018-00001-00002', NULL, 'DISB', '500.00', '0.00', '2018-02-13 16:36:17', 'admin'),
(3, '2018-00001-00002', 'DISB', 'TEST', '500.00', '0.00', '2018-02-13 16:36:51', 'admin'),
(4, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00002', '0.00', '500.00', '2018-02-13 16:45:48', 'admin'),
(5, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00003', '0.00', '100.00', '2018-02-13 17:15:16', 'admin'),
(6, '2018-00001-00002', 'DISB', 'Disbursement 2', '10000.00', '0.00', '2018-02-13 17:18:36', 'admin'),
(7, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00004', '0.00', '5000.00', '2018-02-13 17:18:53', 'admin'),
(8, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00005', '0.00', '500.00', '2018-02-13 23:49:50', 'admin'),
(9, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00006', '0.00', '500.00', '2018-02-13 23:51:11', 'admin'),
(10, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00007', '0.00', '100.00', '2018-02-13 23:52:04', 'admin'),
(11, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00008', '0.00', '0.00', '2018-02-13 23:53:22', 'admin'),
(12, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00009', '0.00', '500.00', '2018-02-13 23:53:31', 'admin'),
(13, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00010', '0.00', '1111.00', '2018-02-13 23:53:59', 'admin'),
(14, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00011', '0.00', '1111.00', '2018-02-13 23:55:04', 'admin'),
(15, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00012', '0.00', '111.00', '2018-02-13 23:55:47', 'admin'),
(16, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00013', '0.00', '100.00', '2018-02-13 23:58:33', 'admin'),
(17, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00014', '0.00', '500.00', '2018-02-13 23:59:41', 'admin'),
(18, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00015', '0.00', '100.00', '2018-02-14 00:04:31', 'admin'),
(19, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00016', '0.00', '100.00', '2018-02-14 00:05:01', 'admin'),
(20, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00017', '0.00', '0.00', '2018-02-14 00:05:26', 'admin'),
(21, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00018', '0.00', '1000.00', '2018-02-14 00:05:55', 'admin'),
(22, '2018-00001-00002', 'CPAY', 'Payment #PAY2018-00019', '0.00', '1000.00', '2018-02-14 00:06:34', 'admin'),
(23, '2018-00001-00002', 'DISB', 'Final Disbursement', '35000.00', '0.00', '2018-02-14 13:40:38', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `loans_ledger_codes`
--

CREATE TABLE `loans_ledger_codes` (
  `code` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans_ledger_codes`
--

INSERT INTO `loans_ledger_codes` (`code`, `type`, `description`) VALUES
('CPAY', 'credit', 'Pay on Counter '),
('DISB', 'debit', 'Disbursement');

-- --------------------------------------------------------

--
-- Table structure for table `loans_payments`
--

CREATE TABLE `loans_payments` (
  `id` varchar(255) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `payee` varchar(255) DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `loans_payments`
--

INSERT INTO `loans_payments` (`id`, `loan_id`, `payee`, `receipt`, `description`, `amount`, `user`, `created_at`) VALUES
('PAY2018-00001', '2018-00001-00002', 'Maco Cortes', NULL, 'TEST', '500.00', 'admin', '2018-02-13 16:44:28'),
('PAY2018-00002', '2018-00001-00002', 'Maco Cortes', '1234567890', 'TEST', '500.00', 'admin', '2018-02-13 16:45:48'),
('PAY2018-00003', '2018-00001-00002', 'Maco Cortes', '1234567891111', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio quaerat, error, consequatur cum voluptatem eum. Veniam iste maiores, inventore mollitia est temporibus, harum reprehenderit omnis quis quaerat consequuntur fugiat nemo.', '100.00', 'admin', '2018-02-13 17:15:16'),
('PAY2018-00004', '2018-00001-00002', 'Maco Cortes', '098765434567', 'CHAROOOTTT', '5000.00', 'admin', '2018-02-13 17:18:53'),
('PAY2018-00005', '2018-00001-00002', 'Maco Cortes', '937738472', '', '500.00', 'admin', '2018-02-13 23:49:50'),
('PAY2018-00006', '2018-00001-00002', 'Maco Cortes', '', '', '500.00', 'admin', '2018-02-13 23:51:11'),
('PAY2018-00007', '2018-00001-00002', 'Maco Cortes', '', '', '100.00', 'admin', '2018-02-13 23:52:04'),
('PAY2018-00008', '2018-00001-00002', 'Maco Cortes', '', 'qweqe', '0.00', 'admin', '2018-02-13 23:53:22'),
('PAY2018-00009', '2018-00001-00002', 'Maco Cortes', '', 'asdasd', '500.00', 'admin', '2018-02-13 23:53:31'),
('PAY2018-00010', '2018-00001-00002', 'Maco Cortes', '', '', '1111.00', 'admin', '2018-02-13 23:53:59'),
('PAY2018-00011', '2018-00001-00002', 'Maco Cortes', 'd', 'sddd', '1111.00', 'admin', '2018-02-13 23:55:04'),
('PAY2018-00012', '2018-00001-00002', 'Maco Cortes', '', '', '111.00', 'admin', '2018-02-13 23:55:47'),
('PAY2018-00013', '2018-00001-00002', 'Lorra', '', '', '100.00', 'admin', '2018-02-13 23:58:33'),
('PAY2018-00014', '2018-00001-00002', 'Lorem Ipsum', 'TEST', 'TEST', '500.00', 'admin', '2018-02-13 23:59:41'),
('PAY2018-00015', '2018-00001-00002', 'Maco Cortes', '', '', '100.00', 'admin', '2018-02-14 00:04:31'),
('PAY2018-00016', '2018-00001-00002', 'Maco Cortes', '', '', '100.00', 'admin', '2018-02-14 00:05:01'),
('PAY2018-00017', '2018-00001-00002', 'Maco Cortes', '', '', '0.00', 'admin', '2018-02-14 00:05:26'),
('PAY2018-00018', '2018-00001-00002', 'Maco Cortes', '', '', '1000.00', 'admin', '2018-02-14 00:05:55'),
('PAY2018-00019', '2018-00001-00002', 'Maco Cortes', '3456789', 'ssdasdsd', '1000.00', 'admin', '2018-02-14 00:06:34');

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

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user`, `tag`, `tag_id`, `action`, `ip_address`, `user_agent`, `date_time`) VALUES
(1, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:30:44'),
(2, 'admin', 'borrower', '2018-00001', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:37:15'),
(3, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:38:29'),
(4, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:38:55'),
(5, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:39:25'),
(6, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:39:57'),
(7, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:40:11'),
(8, 'admin', 'borrower', '2018-00001', 'Updated a Spouse Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:40:18'),
(9, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:40:37'),
(10, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:40:49'),
(11, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:41:07'),
(12, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 12:41:16'),
(13, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 22:49:12'),
(14, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 22:50:20'),
(15, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 22:50:26'),
(16, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Mobile Safari/537.36', '2018-02-08 22:52:11'),
(17, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Mobile Safari/537.36', '2018-02-08 22:52:17'),
(18, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 06:08:09'),
(19, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 06:31:48'),
(20, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 06:32:10'),
(21, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 06:32:22'),
(22, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 06:32:49'),
(23, 'admin', 'borrower', '2018-00001', 'Updated a Spouse Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 06:33:36'),
(24, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 10:21:48'),
(25, 'admin', 'borrower', '2018-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 10:35:41'),
(26, 'admin', 'borrower', '2018-00002', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 11:34:32'),
(27, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 16:42:18'),
(28, 'admin', 'loan', '2018-00001-00001', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 16:44:37'),
(29, 'admin', 'borrower', '2018-00001', 'Loan Application - ID:2018-00001-00001 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 16:44:37'),
(30, 'admin', 'loan', '2018-00001-00001', 'Approved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 17:32:18'),
(31, 'admin', 'loan', '2018-00001-00001', 'Added a Debit Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 17:41:11'),
(32, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 22:51:37'),
(33, 'admin', 'loan', '2018-00001-00001', 'Created a Note', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:10:51'),
(34, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:11:41'),
(35, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:19:34'),
(36, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:20:44'),
(37, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:22:32'),
(38, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:41:33'),
(39, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:41:43'),
(40, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:43:52'),
(41, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:44:25'),
(42, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:46:37'),
(43, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:46:44'),
(44, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:46:51'),
(45, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:47:16'),
(46, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:47:32'),
(47, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 23:54:38'),
(48, 'admin', 'loan', '2018-00001-00001', 'Deleted a file: 03_LCD_Slide_Handout_1(3).pdf', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-10 00:56:57'),
(49, 'admin', 'loan', '2018-00001-00001', 'Deleted a file: ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-10 00:57:10'),
(50, 'admin', 'loan', '2018-00001-00001', 'Deleted a file: ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-10 00:57:31'),
(51, 'admin', 'loan', '2018-00001-00001', 'Deleted a file: Joseph2.jpg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-10 00:57:40'),
(52, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-11 01:31:43'),
(53, 'admin', 'borrower', '2018-00003', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-11 02:33:26'),
(54, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-11 08:16:42'),
(55, 'admin', 'borrower', '2018-00004', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-11 08:24:00'),
(56, 'admin', 'borrower', '2018-00004', 'Deleted Contact Information: ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-11 08:24:15'),
(57, 'admin', 'borrower', '2018-00004', 'Deleted Contact Information: ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-11 08:24:18'),
(58, 'admin', 'borrower', '2018-00005', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-11 08:29:03'),
(59, 'admin', 'loan', '2018-00002-00003', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-11 13:38:44'),
(60, 'admin', 'borrower', '2018-00002', 'Loan Application - ID:2018-00002-00003 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-11 13:38:44'),
(61, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-12 15:33:57'),
(62, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-12 22:04:34'),
(63, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 02:48:42'),
(64, 'admin', 'borrower', '2018-00001', 'Updated Picture', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 05:52:49'),
(65, 'admin', 'borrower', '2018-00001', 'Updated Picture', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 05:54:15'),
(66, 'admin', 'borrower', '2018-00001', 'Removed Picture', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 06:00:38'),
(67, 'admin', 'borrower', '2018-00001', 'Updated Picture', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 06:00:48'),
(68, 'admin', ' ', ' ', 'User Logged In', '192.168.254.174', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-13 06:24:33'),
(69, 'admin', 'user', 'roxanne', 'User Registration', '192.168.254.174', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-13 06:29:01'),
(70, 'admin', ' ', ' ', 'User Logged In', '192.168.254.174', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-13 06:29:38'),
(71, 'roxanne', ' ', ' ', 'User Logged In', '192.168.254.174', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-13 06:31:11'),
(72, 'admin', 'borrower', '2018-00002', 'Updated Picture', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 07:03:07'),
(73, 'admin', 'borrower', '2018-00002', 'Removed Picture', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 07:03:12'),
(74, 'admin', 'borrower', '2018-00003', 'Activated Borrower Account', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 07:05:04'),
(75, 'admin', 'borrower', '2018-00003', 'Deactivated Borrower Account', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 07:05:10'),
(76, 'admin', 'borrower', '2018-00003', 'Activated Borrower Account', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 07:05:14'),
(77, 'admin', 'loan', '2018-00002-00003', 'Disapproved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 07:40:32'),
(78, 'admin', 'loan', '2018-00001-00002', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 07:49:07'),
(79, 'admin', 'loan', '2018-00001-00002', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 07:49:24'),
(80, 'admin', 'loan', '2018-00001-00002', 'Deleted a file: 03_LCD_Slide_Handout_1(3).pdf', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 07:55:44'),
(81, 'admin', 'loan', '2018-00001-00002', 'Deleted a file: Joseph2.jpg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 07:55:55'),
(82, 'admin', 'loan', '2018-00001-00002', 'Added a Debit Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 08:36:17'),
(83, 'admin', 'loan', '2018-00001-00002', 'Added a Debit Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 08:36:51'),
(84, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 08:45:48'),
(85, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 09:15:16'),
(86, 'admin', 'loan', '2018-00001-00002', 'Added a Debit Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 09:18:36'),
(87, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 09:18:53'),
(88, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 14:30:49'),
(89, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 15:49:50'),
(90, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 15:51:11'),
(91, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 15:52:04'),
(92, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 15:53:22'),
(93, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 15:53:31'),
(94, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 15:53:59'),
(95, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 15:55:04'),
(96, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 15:55:47'),
(97, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 15:58:33'),
(98, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 15:59:41'),
(99, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 16:04:31'),
(100, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 16:05:01'),
(101, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 16:05:26'),
(102, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 16:05:55'),
(103, 'admin', 'loans', '2018-00001-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 16:06:34'),
(104, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-13 23:12:18'),
(105, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-14 03:25:16'),
(106, 'admin', 'loan', '2018-00001-00002', 'Added a Debit Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-14 05:40:38'),
(107, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', '2018-02-14 09:51:49');

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
  `user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `tag`, `tag_id`, `title`, `description`, `created_at`, `updated_at`, `user`) VALUES
(1, 'loan', '2018-00001-00001', NULL, 'admin: Approved this Loan Request. <br/> Remarks: Naaaaaaaahhh', '2018-02-10 01:32:18', NULL, NULL),
(2, 'loan', '2018-00001-00001', 'Testing test', 'test', '2018-02-10 07:10:51', NULL, 'admin'),
(3, 'loan', '2018-00002-00003', NULL, 'admin: Disapproved this Loan Request. <br/> Remarks: Naaaaaaaaaaaaaaaahhh', '2018-02-13 15:40:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` varchar(255) NOT NULL,
  `setting_grp` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_grp`, `value`, `desc`) VALUES
('API_KEY_AUTH', 'AUTH', 'RedWoodsAuth', 'API Key for Redwoods');

-- --------------------------------------------------------

--
-- Table structure for table `store_expenses`
--

CREATE TABLE `store_expenses` (
  `id` int(11) NOT NULL,
  `payee` varchar(255) DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `description` text,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('admin', '$2y$10$mt9rqihNCu6CVMnAcyqOreGwmO4yh2rgD9zvODgvxcpcDHvMIMcm6', 'Administrator', 'admin@admin.com', '1234567890', 'Administrator', './uploads/users/admin/b770d94c8b5e5d9b17c109db881469d8.png', '2017-09-27 15:22:36', '2018-02-14 10:08:03', 0),
('roxanne', '$2y$10$6CiCt9aZYXxSXg/SbZqAROpLMMJX6PCYb8JEKtH/BrgwK3bRkkof.', 'mananquil', 'roxannemananquil14@gmail.com', '09124835154', 'Teller', './uploads/users/roxanne/405fe948e3c13ead014260d6702c63d8.JPG', '2018-02-13 14:29:01', '2018-02-13 06:29:01', 0),
('test', '$2y$10$L/bwEx4n7YP2.JlGciB22.VM9q3xxb/um1EvFi2eUN4GzA3uamUsS', 'NICE OBNE ', 'nice.nice@nice.com', '1132101223', 'Teller', './uploads/users/Maikoo/4e828ac7e7d00fa179d8bb9a2553b183.png', '2017-11-22 22:41:23', '2017-12-01 16:48:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_pin`
--

CREATE TABLE `users_pin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('Administrator', 10),
('Collector', 6),
('Teller', 8);

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
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKCollectionLoan` (`loan_id`),
  ADD KEY `FKCollectionUser` (`user`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fknoteuser` (`user`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
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
-- Indexes for table `loans_expense`
--
ALTER TABLE `loans_expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKLoanFees` (`loan_id`),
  ADD KEY `FKExpense` (`expense_id`) USING BTREE;

--
-- Indexes for table `loans_income`
--
ALTER TABLE `loans_income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKLoanFees` (`loan_id`),
  ADD KEY `FKIncome` (`income_id`) USING BTREE;

--
-- Indexes for table `loans_ledger`
--
ALTER TABLE `loans_ledger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKledger_loan` (`loan_id`),
  ADD KEY `FKledger_user` (`user`),
  ADD KEY `FKledget_codes` (`code`);

--
-- Indexes for table `loans_ledger_codes`
--
ALTER TABLE `loans_ledger_codes`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `loans_payments`
--
ALTER TABLE `loans_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKLoanPayments` (`loan_id`),
  ADD KEY `FKPaymentUser` (`user`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fknoteuser` (`user`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_expenses`
--
ALTER TABLE `store_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkExpensesUser` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `FKUsertype` (`usertype`);

--
-- Indexes for table `users_pin`
--
ALTER TABLE `users_pin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKPinuser` (`username`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `borrowers_contacts`
--
ALTER TABLE `borrowers_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `borrowers_educ`
--
ALTER TABLE `borrowers_educ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `borrowers_spouse`
--
ALTER TABLE `borrowers_spouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `borrowers_work`
--
ALTER TABLE `borrowers_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `loans_creditors`
--
ALTER TABLE `loans_creditors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loans_expense`
--
ALTER TABLE `loans_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `loans_income`
--
ALTER TABLE `loans_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `loans_ledger`
--
ALTER TABLE `loans_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `store_expenses`
--
ALTER TABLE `store_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_pin`
--
ALTER TABLE `users_pin`
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
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `FKCollectionLoan` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `FKCollectionUser` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

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
-- Constraints for table `loans_expense`
--
ALTER TABLE `loans_expense`
  ADD CONSTRAINT `loans_expense_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `loans_expense_id` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`);

--
-- Constraints for table `loans_income`
--
ALTER TABLE `loans_income`
  ADD CONSTRAINT `loans_income_ibfk_2` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `loans_income_id` FOREIGN KEY (`income_id`) REFERENCES `income` (`id`);

--
-- Constraints for table `loans_ledger`
--
ALTER TABLE `loans_ledger`
  ADD CONSTRAINT `FKledger_loan` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `FKledger_user` FOREIGN KEY (`user`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `FKledget_codes` FOREIGN KEY (`code`) REFERENCES `loans_ledger_codes` (`code`);

--
-- Constraints for table `loans_payments`
--
ALTER TABLE `loans_payments`
  ADD CONSTRAINT `FKLoanPayments` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `FKPaymentUser` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `FKUserlogs` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `Fknoteuser` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

--
-- Constraints for table `store_expenses`
--
ALTER TABLE `store_expenses`
  ADD CONSTRAINT `fkExpensesUser` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FKUsertype` FOREIGN KEY (`usertype`) REFERENCES `usertypes` (`title`) ON UPDATE CASCADE;

--
-- Constraints for table `users_pin`
--
ALTER TABLE `users_pin`
  ADD CONSTRAINT `FKPinuser` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
