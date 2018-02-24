-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2018 at 05:45 PM
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
('2018-00001', 'Maco', 'Gallemit', 'Cortes', 1, 'Single', '1995-02-21', 1, NULL, NULL, './uploads/borrowers/2018-00001/2baf4d90fcf7e64bfb52d4255e13c718.jpg', '2018-02-19 20:42:10', '2018-02-20 07:03:20', 0);

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
(1, '2018-00001', 0, 'Naahh', 'Nahhh', 'Naahh', 'Dipolog City', '7100', 'Zamboanga del Norte', 'Philippines'),
(2, '2018-00001', 1, 'Nahhh', 'Naaan', 'Naah', 'Dipolog City', '7100', 'Zamboanga del Norte', 'Philippines'),
(3, '2018-00001', 2, 'Nahhh', 'Naaan', 'Naah', 'Dipolog City', '7100', 'Zamboanga del Norte', 'Philippines');

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
(2, '2018-00001', 1, 'maco.techdepot@gmail.com');

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
(1, '2018-00001', 2, 'STI Dipolog', 'BSCS', '2015');

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
(1, '2018-00001', 1, 'Naahh', 'nahh', 'nahh', '2010-02-03', NULL, '(988) 887-7777', 'naahh', 'naaahhh');

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
('uce6q6aqjhk5ujj6fqgqqdsa204db2p4', '::1', 1519294844, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531393239343734313b6572726f727c733a31383a22596f75206e65656420746f206c6f67696e21223b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d737563636573737c733a31393a2257656c636f6d65206261636b2061646d696e21223b7761726e696e677c613a333a7b693a303b733a35323a22546865204c6f616e20416d6f756e74206669656c64206d75737420636f6e7461696e206120646563696d616c206e756d6265722e223b693a313b733a33353a225468652044617973206f66204c6f616e206669656c642069732072657175697265642e223b693a323b733a33383a22546865204c6f616e2050657263656e74616765206669656c642069732072657175697265642e223b7d),
('v33gtvop4matrro5es9bc2vr8g2dgm2n', '::1', 1519370433, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531393336393539323b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d737563636573737c733a31393a2257656c636f6d65206261636b2061646d696e21223b),
('umnbi403ggg5ebs9vdgletuvf4c1upnq', '::1', 1519403622, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531393430333632323b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d737563636573737c733a32313a22417070726f766564204c6f616e2052657175657374223b);

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
(1, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/Felix.jpg', 'Felix.jpg', 'image/jpeg', '2018-02-20 12:58:52', NULL, 'admin');

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
  `due_days` int(10) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
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

INSERT INTO `loans` (`id`, `borrower_id`, `borrowed_amount`, `due_days`, `due_date`, `borrowed_percentage`, `description`, `status`, `approved_at`, `created_at`, `updated_at`) VALUES
('2018-00001-00001', '2018-00001', '50000.00', 150, '2018-07-24 00:00:00', '8.50', NULL, 0, '2018-02-24 00:16:22', '2018-02-23 22:42:18', '2018-02-23 16:17:24');

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
(1, '2018-00001-00001', '', '', '0.00', ''),
(2, '2018-00001-00001', 'WOW MAGIC', 'WOW', NULL, 'Magic');

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
(1, '2018-00001-00001', 1, '100.00'),
(2, '2018-00001-00001', 2, '10000.00'),
(3, '2018-00001-00001', 3, '100001.00'),
(4, '2018-00001-00001', 4, '111.00'),
(5, '2018-00001-00001', 5, '1000.00'),
(6, '2018-00001-00001', 6, '1001.00'),
(7, '2018-00001-00001', 1, '1000.00'),
(8, '2018-00001-00001', 2, '1000.00'),
(9, '2018-00001-00001', 3, '1000.00'),
(10, '2018-00001-00001', 4, '100.00'),
(11, '2018-00001-00001', 5, '1000.00'),
(12, '2018-00001-00001', 6, '1000.00');

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
(1, '2018-00001-00001', 1, '1000.00'),
(2, '2018-00001-00001', 2, '1000.00'),
(3, '2018-00001-00001', 3, '100.00'),
(4, '2018-00001-00001', 4, '100.00'),
(5, '2018-00001-00001', 5, '10000.00'),
(6, '2018-00001-00001', 1, '10000.00'),
(7, '2018-00001-00001', 2, '1000.00'),
(8, '2018-00001-00001', 3, '100.00'),
(9, '2018-00001-00001', 4, '1000.00'),
(10, '2018-00001-00001', 5, '100.00');

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
(1, '2018-00001-00001', 'DISB', 'Actual Disbursed: PHP 95,000.00', '100000.00', '0.00', '2018-02-19 21:40:14', 'admin'),
(2, '2018-00001-00001', 'INTR', 'Applied Standard Interests basing from 8.50% of PHP 100,000.00', '8500.00', '0.00', '2018-02-19 21:40:14', 'admin'),
(3, '2018-00001-00001', 'SCHR', 'Standard Service Charge', '5000.00', '0.00', '2018-02-19 21:40:14', 'admin'),
(4, '2018-00001-00001', 'SCHR', 'Service Charge Paid', '0.00', '5000.00', '2018-02-19 21:40:14', 'admin'),
(5, '2018-00001-00001', 'CPAY', 'Payment #PAY2018-00001', '0.00', '5000.00', '2018-02-19 21:40:58', 'admin');

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
('APAY', 'credit', 'App Payment'),
('CERR', 'credit', 'System Error'),
('CPAY', 'credit', 'Pay on Counter '),
('DERR', 'debit', 'System Error'),
('DISB', 'debit', 'Disbursement'),
('INTR', 'debit', 'Interest'),
('PNTY', 'debit', 'Penalty'),
('SCHR', 'credit', 'Service Charge');

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
('PAY2018-00001', '2018-00001-00001', 'Maco Cortes', '1000000', 'TESTING 123', '5000.00', 'admin', '2018-02-19 21:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `loans_payments_schedule`
--

CREATE TABLE `loans_payments_schedule` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `paid_actual` varchar(255) DEFAULT NULL,
  `paid_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans_payments_schedule`
--

INSERT INTO `loans_payments_schedule` (`id`, `loan_id`, `schedule`, `amount`, `paid_actual`, `paid_date`) VALUES
(1, '2018-00001-00001', '2018-03-15', '5425.00', NULL, NULL),
(2, '2018-00001-00001', '2018-03-30', '5425.00', NULL, NULL),
(3, '2018-00001-00001', '2018-04-15', '5425.00', NULL, NULL),
(4, '2018-00001-00001', '2018-04-30', '5425.00', NULL, NULL),
(5, '2018-00001-00001', '2018-05-15', '5425.00', NULL, NULL),
(6, '2018-00001-00001', '2018-05-30', '5425.00', NULL, NULL),
(7, '2018-00001-00001', '2018-06-15', '5425.00', NULL, NULL),
(8, '2018-00001-00001', '2018-06-30', '5425.00', NULL, NULL),
(9, '2018-00001-00001', '2018-07-15', '5425.00', NULL, NULL),
(10, '2018-00001-00001', '2018-07-24', '5425.00', NULL, NULL);

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
(1, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-17 04:56:16'),
(2, 'admin', ' ', ' ', 'User Logged In', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-19 12:38:55'),
(3, 'admin', 'borrower', '2018-00001', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-19 12:42:10'),
(4, 'admin', 'borrower', '2018-00001', 'Updated Picture', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-19 12:43:01'),
(5, 'admin', 'loan', '2018-00001-00001', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-19 13:39:45'),
(6, 'admin', 'borrower', '2018-00001', 'Loan Application - ID:2018-00001-00001 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-19 13:39:45'),
(7, 'admin', 'loan', '2018-00001-00001', 'Approved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-19 13:40:04'),
(8, 'admin', 'loan', '2018-00001-00001', 'Processed Disbursement', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-19 13:40:14'),
(9, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-19 13:40:58'),
(10, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-20 00:55:30'),
(11, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-20 04:58:52'),
(12, 'admin', 'borrower', '2018-00001', 'Updated Picture', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Mobile Safari/537.36', '2018-02-20 07:03:20'),
(13, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-20 14:16:08'),
(14, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-21 03:13:05'),
(15, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-22 09:22:01'),
(16, 'admin', ' ', ' ', 'User Logged In', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-23 03:58:58'),
(17, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-23 14:23:21'),
(18, 'admin', 'loan', '2018-00001-00001', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-23 14:42:18'),
(19, 'admin', 'borrower', '2018-00001', 'Loan Application - ID:2018-00001-00001 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-23 14:42:18'),
(20, 'admin', 'loan', '2018-00001-00001', 'Approved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-23 16:14:59'),
(21, 'admin', 'loan', '2018-00001-00001', 'Approved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-23 16:16:22');

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
(1, 'loan', '2018-00001-00001', NULL, 'admin: Approved this Loan Request. <br/> Remarks: askdjakjdkasjd', '2018-02-19 21:40:03', NULL, NULL),
(2, 'loan', '2018-00001-00001', NULL, 'admin: Approved this Loan Request. <br/> Remarks: Testing', '2018-02-24 00:14:59', NULL, NULL),
(3, 'loan', '2018-00001-00001', NULL, 'admin: Approved this Loan Request. <br/> Remarks: dasdasdasdasdasdasdasdasd', '2018-02-24 00:16:22', NULL, NULL);

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
  `pin` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
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

INSERT INTO `users` (`pin`, `username`, `password`, `firstname`, `lastname`, `email`, `contact`, `usertype`, `img`, `created_at`, `updated_at`, `is_deleted`) VALUES
('111111', 'admin', '$2y$10$mt9rqihNCu6CVMnAcyqOreGwmO4yh2rgD9zvODgvxcpcDHvMIMcm6', 'Administrator', '', 'admin@admin.com', '1234567890', 'Administrator', './uploads/users/admin/b770d94c8b5e5d9b17c109db881469d8.png', '2017-09-27 15:22:36', '2018-02-16 03:03:19', 0);

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
-- Indexes for table `loans_payments_schedule`
--
ALTER TABLE `loans_payments_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKLoanPaymentSched` (`loan_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `borrowers_contacts`
--
ALTER TABLE `borrowers_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `borrowers_educ`
--
ALTER TABLE `borrowers_educ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `borrowers_spouse`
--
ALTER TABLE `borrowers_spouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `borrowers_work`
--
ALTER TABLE `borrowers_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `loans_payments_schedule`
--
ALTER TABLE `loans_payments_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
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
-- Constraints for table `loans_payments_schedule`
--
ALTER TABLE `loans_payments_schedule`
  ADD CONSTRAINT `FKLoanPaymentSched` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
