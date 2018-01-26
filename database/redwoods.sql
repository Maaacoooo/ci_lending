-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2018 at 10:05 PM
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
('2017-00001', 'Bryan', 'Fuente', 'Ayuban', 1, 'Married', '1993-10-05', NULL, 2, 15, './uploads/borrowers/2017-00001/04a463a6d82a063ace9f78f4bf3bfd95.jpg', '2017-12-01 16:23:34', '2018-01-26 01:23:08', 0),
('2017-00002', 'asdasdasd', 'adsasdasdasd', 'aasdasdasd', 1, 'Single', '2018-03-01', NULL, NULL, NULL, './uploads/borrowers/2017-00002/8f17637c92882ae7f70efc60edeb735c.jpg', '2017-12-01 16:24:44', '2018-01-14 08:23:17', 0),
('2017-00003', 'asdasdasd', 'adsasdasdasd', 'aasdasdasd', 1, '', '2018-03-01', 6, NULL, NULL, './uploads/borrowers/2017-00003/b543801b9bfbf2e32a8399262b37a7da.jpg', '2017-12-01 16:25:15', '2017-12-01 08:25:15', 0),
('2017-00004', 'NICE', 'MAH', 'BOI', 1, '', '2018-03-01', 12, NULL, NULL, './uploads/borrowers/2017-00004/b22c2dbf283b9e83bc836f7b64eb5bc2.jpg', '2017-12-01 16:30:00', '2017-12-01 08:30:00', 0),
('2017-00005', 'Ella', 'Gentella', 'Cruz', 0, 'Married', '1997-12-01', 1, 1, 7, NULL, '2017-12-01 16:32:34', '2018-01-07 10:04:38', 0),
('2018-00006', 'daasdasdasd', 'asdasdasdasd', 'dadasdasd', 1, 'Single', '1993-10-05', 2, NULL, NULL, './uploads/borrowers/2018-00006/b32970267d001adc2c74d29794fc89b2.jpg', '2018-01-26 16:14:57', '2018-01-26 08:14:57', 0);

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
(7, '2017-00005', 0, 'Cruz Residence', 'Gen. Luna St.', 'Agdao', 'Pagadian', '7200', 'Zamboanga Del Norte', 'Philippines'),
(8, '2017-00005', 1, 'asdasdas;ldasl;dk', 'asdsadasdasd', 'aklsjklasjdklasdj', 'asdlkjasdkljaskd', '123123', 'lkajdaklsjdkl', ''),
(9, '2017-00005', 3, 'Cruz Residence', 'Prk Luz', 'Ipil Heights', 'Ipil', '7001', 'Zamboanga Sibugay', 'Philippines'),
(10, '2017-00005', 3, 'Polanco Koi', 'Nat\'l Highway', 'Lingasad', 'Polanco', '7101', 'Zamboanga del Norte', ''),
(11, '2017-00001', 2, 'Camp Del Pilar', 'Tinangon', 'Del Pilar', 'Piñan', '7107', 'Zamboanga del Norte', 'Philippines'),
(12, '2017-00002', 3, 'WOPPP', '54as5d45as4d', 'as5d4as5', 'asd\'as;d', 'a;sldkas', 'al;dk', 'Philippines'),
(13, '2017-00005', 2, 'Bo\'s Coffee', 'Rizal Avenue', 'Central', 'Dipolog', '7100', 'Zamboanga del Norte', 'Philippines'),
(14, '2017-00002', 2, 'NIGGUH', 'ada', 'asdad', 'adasd', '4567', 'aafs', 'Philippines'),
(15, '2017-00001', 0, 'Lapu Lapu', 'Magellan', 'Lugdungan', 'Dipolog City', '7100', 'Zamboanga del Norte', 'Philippines'),
(16, '2017-00001', 3, 'Ayuban Residence', 'Purok Marang', 'Lugdungan', 'Dipolog', '7100', 'Zamboanga del Norte', 'Philippines'),
(17, '2018-00006', 0, 'asdasdas', 'adasdasd', 'addasdasd', 'asdsadasd', '123123', 'adasdasds', 'Philippines'),
(18, '2018-00006', 1, 'aSas', 'aSasaS', 'asASA', 'asAS', 'ASasASas', 'asASa', 'Philippines'),
(19, '2018-00006', 2, 'asdasdasd', 'asdasda', 'asdasd', 'asdasd', '323', 'asdasd', 'Philippines');

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
(3, '2017-00003', 0, '(456) 456-4645'),
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
(20, '2017-00005', 1, 'johntest@gmail.com'),
(21, '2017-00001', 0, '(545) 445-6456'),
(22, '2017-00001', 1, 'johndoe@jon.com'),
(23, '2018-00006', 0, '(131) 231-2321'),
(24, '2018-00006', 0, '(134) 354-5565'),
(26, '2018-00006', 1, '1asdasdasd@gmail.com'),
(27, '2018-00006', 1, '1asdasdasd@gmail.com'),
(28, '2018-00006', 1, '1asdasdasd@gmail.com');

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
(1, '2017-00005', 2, 'STI Dipolog', 'BSCS', '2017'),
(2, '2018-00006', 1, 'asdasdas', 'dasdasd', '2133');

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
(1, '2017-00005', 'John', 'Great', 'Doe', '1994-07-22', 'Dipolog Ciy', '(564) 564-5646', 'Programmer', 'Dipolog City'),
(2, '2017-00001', 'Malia', 'La Luna', 'Sangre', '1994-08-06', 'adasdasdasdasd', '(564) 564-5645', 'adasdsadasdasd', 'asdasdasdasdasdasdasd');

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
(5, '2017-00005', NULL, 'Botoy\'s', 'Food and Resto', 'Oroquieta City, Misamis Occidental', '2012-07-07', NULL, '(965) 545-4568', 'Ended', 'Ended due to financial error'),
(6, '2017-00005', 1, 'DPWH IX', 'Civil Engineer', 'Dipolog City', '2014-04-21', NULL, '(545) 645-6456', 'asdasda', 'asdasdasdasd'),
(7, '2017-00005', 0, 'Innova Systems', 'Software Developer', 'Dipolog City', '2014-04-21', NULL, '(545) 645-6456', 'asdasda', 'asdasdasdasd'),
(8, '2017-00005', NULL, 'Citi Hardware', 'Hardware', 'Dapitan', '2007-05-11', NULL, '(062) 333-5309', 'Currently Running', 'Wow Nice'),
(9, '2017-00005', NULL, 'CrownTech Machine Shop', 'Industrial Shop', 'Ipil, Zamboanga Sibugay', '1981-10-06', NULL, '(062) 333-5595', 'asdasdasd', 'asdasdasdasd'),
(10, '2017-00005', 1, 'PNP-CIDG 9', 'Agent', 'Pagadian City, Zamboanga del Sur', '0000-00-00', NULL, '(554) 545-4545', 'asdasdasdasd', 'asdasdasdsad'),
(11, '2017-00001', 0, 'Dipolgahdjash', 'qasddsadsda', 'ghhjghjghjgh', '2011-05-12', NULL, '(121) 231-2312', 'asdsadas', 'adasdasdasd'),
(12, '2017-00001', NULL, 'asdasdasda', 'asdasd', 'asdasd', '2018-09-01', NULL, '(556) 456-4564', 'asdasdasd', 'asdasdasdasd'),
(13, '2017-00001', 1, 'DICT Regional Office IX', 'Web Developer', 'Arellano St., Estaka, Dipolog City', '2010-03-02', NULL, '(065) 212-6605', 'Regular', 'Nice Pay'),
(14, '2017-00005', 0, 'Power Dimension Inc.', 'Safety Officer I', 'Aurora, Zamboanga Del Sur', '2017-06-01', NULL, '(656) 665-6565', 'Irregular', 'Nahhh'),
(20, '2017-00005', 0, 'Niles', 'asdasdasd', '01/06/2018', '2018-01-01', NULL, '(324) 234-3242', '453423', 'asdadasdasd'),
(21, '2018-00006', 1, 'asdasd', '213', 'aSAASD', '2010-10-02', NULL, '(432) 432-4324', 'ASAS', 'ADASDASDASDASD');

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
('p34557f86p5h7vvb4ic3u971be3p6t4p', '::1', 1517000592, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531373030303537343b6572726f727c733a37323a224163636f756e742044656163746976617465642e20506c6561736520636f6e7461637420796f75722041646d696e6973747261746f7220666f7220526561637469766174696f6e21223b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d737563636573737c733a34383a224c6f616e204170706c69636174696f6e205375626d6974746564212050656e64696e6720666f7220417070726f76616c223b7761726e696e677c613a313a7b693a303b733a35323a22546865204c6f616e20416d6f756e74206669656c64206d75737420636f6e7461696e206120646563696d616c206e756d6265722e223b7d);

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
  `status` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `borrower_id`, `borrowed_amount`, `due_date`, `borrowed_percentage`, `description`, `status`, `created_at`, `updated_at`) VALUES
('2018-00001-00001', '2017-00001', '10000.00', '2018-03-12', '2.00', NULL, NULL, '2018-01-27 01:55:48', NULL),
('2018-00004-00003', '2017-00004', '200000.00', '2018-05-26', '1.20', NULL, 0, '2018-01-27 02:36:13', NULL),
('2018-00004-00004', '2017-00004', '200000.00', '2018-05-26', '1.20', NULL, 0, '2018-01-27 02:36:44', NULL),
('2018-00006-00002', '2018-00006', '12000.00', '2018-03-22', '2.20', NULL, 0, '2018-01-27 02:33:20', NULL);

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
(5, '2018-00006-00002', 'Maco Cortes', 'Dipolog City', '500.00', 'Hehehe'),
(6, '2018-00006-00002', 'Erika Cortes', 'Dipolog City', '500.00', 'Hehehe'),
(7, '2018-00004-00003', 'asdasdadasda', 'asdasdasd', '5600.00', 'assad'),
(8, '2018-00004-00003', 'asdasdadasdazczxcxz', 'asdasdasdxccx', '5600.00', 'assadxcx'),
(9, '2018-00004-00004', 'asdasdadasda', 'asdasdasd', '5600.00', 'assad');

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
(1, '2018-00004-00004', 1, '2121.00'),
(2, '2018-00004-00004', 2, '21.00'),
(3, '2018-00004-00004', 3, '12.00'),
(4, '2018-00004-00004', 4, '121.00'),
(5, '2018-00004-00004', 5, '21.00'),
(6, '2018-00004-00004', 6, '212.00');

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
(2, '2018-00001-00001', 2, '100.00'),
(3, '2018-00001-00001', 3, '10000.00'),
(4, '2018-00001-00001', 4, '11000.00'),
(5, '2018-00001-00001', 5, '100010.00'),
(6, '2018-00006-00002', 1, '1111.00'),
(7, '2018-00006-00002', 2, '222.00'),
(8, '2018-00006-00002', 3, '333.00'),
(9, '2018-00006-00002', 4, '444.00'),
(10, '2018-00006-00002', 5, '55.00'),
(11, '2018-00004-00003', 1, '111.00'),
(12, '2018-00004-00003', 2, '222.00'),
(13, '2018-00004-00003', 3, '6666.00'),
(14, '2018-00004-00003', 4, '1111.00'),
(15, '2018-00004-00003', 5, '1222.00'),
(16, '2018-00004-00004', 1, '111.00'),
(17, '2018-00004-00004', 2, '222.00'),
(18, '2018-00004-00004', 3, '6666.00'),
(19, '2018-00004-00004', 4, '1111.00'),
(20, '2018-00004-00004', 5, '1222.00');

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

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user`, `tag`, `tag_id`, `action`, `ip_address`, `user_agent`, `date_time`) VALUES
(1, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', '2017-12-04 07:20:58'),
(2, 'admin', 'borrower', '2017-00005', 'Added New Address', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', '2017-12-04 07:43:22'),
(3, 'admin', 'borrower', '2017-00001', 'Added New Address', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', '2017-12-04 07:51:37'),
(4, 'admin', 'borrower', '2017-00002', 'Added New Address', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', '2017-12-04 07:57:14'),
(5, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', '2017-12-05 04:08:51'),
(6, 'admin', 'borrower', '2017-00005', 'Added New Address', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', '2017-12-05 04:20:22'),
(7, 'admin', 'borrower', '2017-00002', 'Added New Address', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', '2017-12-05 05:22:41'),
(8, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-04 03:59:55'),
(9, 'admin', 'borrower', '2017-00001', 'Added New Contact Number', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-04 04:00:33'),
(10, 'admin', 'borrower', '2017-00001', 'Added a New Employer', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-04 04:01:00'),
(11, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 06:11:07'),
(12, 'admin', 'borrower', '2017-00001', 'Added New Email Address', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 06:11:29'),
(13, 'admin', 'borrower', '2017-00001', 'Added a New Business', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 06:13:34'),
(14, 'admin', 'borrower', '2017-00001', 'Added a New Employer', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 06:52:29'),
(15, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 09:38:20'),
(16, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 15:59:39'),
(17, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:14:17'),
(18, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:14:43'),
(19, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:16:08'),
(20, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:16:33'),
(21, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:16:42'),
(22, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:17:12'),
(23, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:19:07'),
(24, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:19:39'),
(25, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:25:10'),
(26, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:31:58'),
(27, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:32:49'),
(28, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:33:22'),
(29, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:34:32'),
(30, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 16:35:00'),
(31, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 18:23:35'),
(32, 'admin', 'borrower', '2017-00001', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 18:23:51'),
(33, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 01:00:07'),
(34, 'admin', 'borrower', '2017-00005', 'Updated a Business Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:11:15'),
(35, 'admin', 'borrower', '2017-00005', 'Updated a Business Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:14:09'),
(36, 'admin', 'borrower', '2017-00005', 'Updated a Business Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:14:41'),
(37, 'admin', 'borrower', '2017-00005', 'Updated a Business Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:14:53'),
(38, 'admin', 'borrower', '2017-00005', 'Added a New Employer', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:19:59'),
(39, 'admin', 'borrower', '2017-00005', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:20:34'),
(40, 'admin', 'borrower', '2017-00005', 'Updated an Employment Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:20:43'),
(41, 'admin', 'borrower', '2017-00005', 'Added a New Employer', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:22:46'),
(42, 'admin', 'borrower', '2017-00005', 'Added a New Employer', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:29:32'),
(43, 'admin', 'borrower', '2017-00005', 'Added a New Employer', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:29:52'),
(44, 'admin', 'borrower', '2017-00005', 'Added a New Employer', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 02:37:48'),
(45, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 06:25:23'),
(46, 'admin', 'borrower', '2017-00005', 'Deleted an Employer Record -ZXzzxzxZxxZX', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:05:55'),
(47, 'admin', 'borrower', '2017-00005', 'Deleted an Employer Record - ZXzzxzxZxxZX', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:06:15'),
(48, 'admin', 'borrower', '2017-00005', 'Deleted an Employer Record - dsfdsfsdf', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:06:25'),
(49, 'admin', 'borrower', '2017-00005', 'Deleted an Employer Record - adasdas', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:06:33'),
(50, 'admin', 'borrower', '2017-00005', 'Deleted an Employer Record - asdasd', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:06:42'),
(51, 'admin', 'borrower', '2017-00005', 'Added a New Employer', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:06:56'),
(52, 'admin', 'borrower', '2017-00005', 'Updated an Employer Information: asdasd', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:14:55'),
(53, 'admin', 'borrower', '2017-00005', 'Updated an Employer Information: asdasd -> Niles', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:15:06'),
(54, 'admin', 'borrower', '2017-00005', 'Added a New Employer - WBHA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:15:36'),
(55, 'admin', 'borrower', '2017-00005', 'Deleted an Employer Record - WBHA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:15:46'),
(56, 'admin', 'borrower', '2017-00005', 'Added a New Business - asdasdas', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:16:00'),
(57, 'admin', 'borrower', '2017-00005', 'Updated a Business Information: asdasdas -> So nice', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:16:08'),
(58, 'admin', 'borrower', '2017-00005', 'Deleted a Business Record - So nice', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 07:16:18'),
(59, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 14:37:43'),
(60, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-06 17:00:25'),
(61, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 03:19:07'),
(62, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 06:43:34'),
(63, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 07:25:13'),
(64, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 07:25:31'),
(65, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 07:25:57'),
(66, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 07:26:25'),
(67, 'admin', 'borrower', '2017-00001', 'Updated Personal Information-- Changed name from John Lorem Doe to Bryan Fuente Ayuban', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 07:28:06'),
(68, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 07:28:37'),
(69, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 07:29:14'),
(70, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 09:45:12'),
(71, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 09:52:12'),
(72, 'admin', 'borrower', '2017-00001', 'Added New Address', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 09:53:12'),
(73, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 09:54:33'),
(74, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 09:54:33'),
(75, 'admin', 'borrower', '2017-00005', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 10:04:21'),
(76, 'admin', 'borrower', '2017-00005', 'Updated Personal Information-- Changed name from Ella Bonifacio Cruz to Ella Gentella Cruz', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 10:04:38'),
(77, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 16:01:42'),
(78, 'admin', 'borrower', '2017-00005', 'Updated Educational Background', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 16:12:27'),
(79, 'admin', 'borrower', '2017-00005', 'Updated Educational Background', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 16:12:34'),
(80, 'admin', 'borrower', '2017-00005', 'Updated Educational Background', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 16:12:40'),
(81, 'admin', 'borrower', '2017-00005', 'Updated Educational Background', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-07 16:12:50'),
(82, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-08 06:52:24'),
(83, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-08 10:44:25'),
(84, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 08:22:28'),
(85, 'admin', 'borrower', '2017-00002', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 08:23:17'),
(86, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 08:23:44'),
(87, 'admin', 'borrower', '2017-00001', 'Created a Spouse Record. Married to Malia Sangre', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 08:30:40'),
(88, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 08:31:15'),
(89, 'admin', 'borrower', '2017-00001', 'Updated a Spouse Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 08:32:37'),
(90, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 08:33:00'),
(91, 'admin', 'borrower', '2017-00001', 'Updated Educational Background', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 08:33:27'),
(92, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 11:21:48'),
(93, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:31:29'),
(94, 'admin', 'borrower', NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:44:06'),
(95, 'admin', 'borrower', '2017-00001', 'Updated Contact Information: (221) 212-1212 to (545) 44_-____', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:51:09'),
(96, 'admin', 'borrower', '2017-00001', 'Updated Contact Information: (545) 44_-____ to (545) 445-6456', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:51:16'),
(97, 'admin', 'borrower', '2017-00001', 'Added New Contact Number', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:51:21'),
(98, 'admin', 'borrower', '2017-00001', 'Updated Contact Information: (564) 654-5646 to (___) ___-____', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:51:26'),
(99, 'admin', 'borrower', '2017-00001', 'Updated Contact Information: (___) ___-____ to (654) 564-4545', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:51:58'),
(100, 'admin', 'borrower', '2017-00001', 'Deleted Contact Information: (654) 564-4545', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:52:32'),
(101, 'admin', 'borrower', '2017-00001', 'Added New Email Address', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:54:53'),
(102, 'admin', 'borrower', '2017-00001', 'Updated Contact Information: asdasdasd@asd.com to hehehe@asd.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:55:02'),
(103, 'admin', 'borrower', '2017-00001', 'Deleted Contact Information: hehehe@asd.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 13:55:13'),
(104, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 16:29:16'),
(105, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 16:41:16'),
(106, 'admin', 'borrower', '2017-00001', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-14 16:41:21'),
(107, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-15 00:44:29'),
(108, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-17 01:11:30'),
(109, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-17 06:22:40'),
(110, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-18 01:21:41'),
(111, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-18 08:19:28'),
(112, 'admin', 'borrower', '2017-00001', 'Changed Current Address from  to ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-18 08:28:08'),
(113, 'admin', 'borrower', '2017-00001', 'Changed Current Address from  to ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-18 08:29:38'),
(114, 'admin', 'borrower', '2017-00001', 'Changed Current Address from  to ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-18 08:30:33'),
(115, 'admin', 'borrower', '2017-00001', 'Changed Current Address from  to ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-18 08:31:14'),
(116, 'admin', 'borrower', '2017-00001', 'Changed Current Address from  to ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-18 08:31:44'),
(117, 'admin', 'borrower', '2017-00001', 'Changed Current Address from Camp Del Pilar, asdsadasd, asdasda, asdasd, dsadas, 7000, Philippines to Camp Del Pilar, asdsadasd, asdasda, asdasd, dsadas, 7000, Philippines', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-18 08:32:34'),
(118, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-19 01:26:23'),
(119, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-25 08:07:10'),
(120, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-25 15:25:32'),
(121, 'admin', 'borrower', NULL, 'Updated House, asdjakjdkasjd, dsadads, adas, asdasdas, 5678, Philippines to Housexxx, asdjakjdkasjd, dsadads, adas, asdasdas, 5678, Philippines', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-25 15:41:08'),
(122, 'admin', 'borrower', NULL, 'Updated Housexxx, asdjakjdkasjd, dsadads, adas, asdasdas, 5678, Philippines to Housexxx, asdjakjdkasjd, dsadads, adas, asdasdas, 5678, Philippines', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-25 15:41:18'),
(123, 'admin', 'borrower', '2017-00001', 'Updated Housexxx, asdjakjdkasjd, dsadads, adas, asdasdas, 5678, Philippines to Ayuban Residence, Purok Marang, Lugdungan, Dipolog, Zamboanga del Norte, 7100, Philippines', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-25 15:42:31'),
(124, 'admin', 'borrower', '2017-00001', 'Updated Address: Ayuban Residence, Purok Marang, Lugdungan, Dipolog, Zamboanga del Norte, 7100, Philippines to Ayuban Residence, Purok Marang, Lugdungan, Dipolog, Zamboanga del Norte, 7100, Philippines', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-25 15:42:57'),
(125, 'admin', 'borrower', '2017-00001', 'Updated Address: Camp Del Pilar, asdsadasd, asdasda, asdasd, dsadas, 7000, Philippines to Camp Del Pilar, asdsadasd, asdasda, asdasd, dsadas, 7000, Philippines', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-25 15:43:06'),
(126, 'admin', 'borrower', '2017-00001', 'Updated Camp Del Pilar, asdsadasd, asdasda, asdasd, dsadas, 7000, Philippines as Current Address', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-25 15:48:00'),
(127, 'admin', 'borrower', '2017-00001', 'Updated Address: Camp Del Pilar, asdsadasd, asdasda, asdasd, dsadas, 7000, Philippines to Camp Del Pilar, Tinangon, Del Pilar, Piñan, Zamboanga del Norte, 7107, Philippines', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-25 15:48:48'),
(128, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 01:05:11'),
(129, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 05:18:32'),
(130, 'admin', 'borrower', '2018-00006', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 08:14:57'),
(131, 'admin', 'borrower', '2018-00006', 'Deleted Contact Information: (876) 867-3532', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 08:15:56'),
(132, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 13:34:14'),
(133, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 15:39:57'),
(134, 'admin', 'loan', '2018-00001-00001', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 17:55:48'),
(135, 'admin', 'borrower', '2017-00001', 'Loan Application - ID:2018-00001-00001 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 17:55:48'),
(136, 'admin', 'loan', '2018-00006-00002', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 18:33:20'),
(137, 'admin', 'borrower', '2018-00006', 'Loan Application - ID:2018-00006-00002 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 18:33:20'),
(138, 'admin', 'loan', '2018-00004-00003', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 18:36:14'),
(139, 'admin', 'borrower', '2017-00004', 'Loan Application - ID:2018-00004-00003 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 18:36:14'),
(140, 'admin', 'loan', '2018-00004-00004', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 18:36:44'),
(141, 'admin', 'borrower', '2017-00004', 'Loan Application - ID:2018-00004-00004 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-26 18:36:44');

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
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `loans_fee`
--
ALTER TABLE `loans_fee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKLoanFees` (`loan_id`),
  ADD KEY `FKFee` (`fee_id`);

--
-- Indexes for table `loans_income`
--
ALTER TABLE `loans_income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKLoanFees` (`loan_id`),
  ADD KEY `FKIncome` (`income_id`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `borrowers_contacts`
--
ALTER TABLE `borrowers_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `borrowers_educ`
--
ALTER TABLE `borrowers_educ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `borrowers_spouse`
--
ALTER TABLE `borrowers_spouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `borrowers_work`
--
ALTER TABLE `borrowers_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `loans_creditors`
--
ALTER TABLE `loans_creditors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `loans_expense`
--
ALTER TABLE `loans_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `loans_fee`
--
ALTER TABLE `loans_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loans_income`
--
ALTER TABLE `loans_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
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
-- Constraints for table `loans_expense`
--
ALTER TABLE `loans_expense`
  ADD CONSTRAINT `loans_expense_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `loans_expense_id` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`);

--
-- Constraints for table `loans_fee`
--
ALTER TABLE `loans_fee`
  ADD CONSTRAINT `FKFee` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`id`),
  ADD CONSTRAINT `FKLoanFees` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`);

--
-- Constraints for table `loans_income`
--
ALTER TABLE `loans_income`
  ADD CONSTRAINT `loans_income_ibfk_2` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `loans_income_id` FOREIGN KEY (`income_id`) REFERENCES `income` (`id`);

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
