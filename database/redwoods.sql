-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2018 at 07:23 AM
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
('2018-00001', 'Maco', 'Gallemit', 'Cortes', 1, 'Single', '1995-02-21', 1, NULL, NULL, './uploads/borrowers/2018-00001/2baf4d90fcf7e64bfb52d4255e13c718.jpg', '2018-02-19 20:42:10', '2018-02-27 17:44:53', 0),
('2018-00002', 'Eric', 'Test', 'Yap', 1, 'Single', '1975-07-23', 2, NULL, NULL, './uploads/borrowers/2018-00002/71fa8b15fa87852dbed878159b3f78f2.jpg', '2018-02-27 17:05:53', '2018-03-05 16:31:24', 0),
('2018-00003', 'sdasd', 'asdsadsa', 'dasdasdasd', 1, 'Widowed', '1998-08-07', 3, NULL, 7, NULL, '2018-02-28 01:08:24', '2018-02-27 17:48:19', 0),
('2018-00004', 'asdadas', 'dasdasd', 'asdasdas', 0, 'Widowed', '1994-06-22', 4, NULL, NULL, NULL, '2018-02-28 01:49:20', '2018-02-27 17:49:20', 0),
('2018-00005', 'cxzxzczxczxc', 'asdasdasd', 'asdasdasd', 1, 'Single', '1988-06-21', 5, NULL, 13, NULL, '2018-02-28 01:55:05', '2018-02-27 17:55:05', 0);

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
(3, '2018-00001', 2, 'Nahhh', 'Naaan', 'Naah', 'Dipolog City', '7100', 'Zamboanga del Norte', 'Philippines'),
(4, '2018-00002', 0, 'kjhhkjhkjh', 'kjhkj', 'hkj', 'hkjh', 'kjhjk', 'kjh', 'Philippines'),
(5, '2018-00002', 1, 'kjhjhkjhkhkhkj', 'hjhkjhkjhkj', 'hkjhkjh', 'khkjh', 'njhkjh', 'kjh', 'Philippines'),
(6, '2018-00002', 2, 'kjhjhkjhkhkhkj', 'hjhkjhkjhkj', 'hkjhkjh', 'khkjh', 'njhkjh', 'kjh', 'Philippines'),
(7, '2018-00003', 0, 'Markss', 'asdsad', 'asdsadsa', 'asdad', 'dsadsadas', 'dasdas', 'Philippines'),
(8, '2018-00003', 1, 'asdad', 'asdas', 'dasdas', 'asdasd', 'dasd', 'asdasd', 'Philippines'),
(9, '2018-00003', 2, 'asdad', 'asdas', 'dasdas', 'asdasd', 'dasd', 'asdasd', 'Philippineasdsas'),
(10, '2018-00004', 0, 'sadasd21312', 'adsad', 'sadasdsad', 'asdasdasdas', 'sadad', 'sadad', 'Philippines'),
(11, '2018-00004', 1, 'Camp Del Pilar', 'asdad', 'asdasd', 'asd', 'asd', 'asdas', 'Philippines'),
(12, '2018-00004', 2, 'Camp Del Pilar', 'asdad', 'asdasd', 'asd', 'asd', 'asdas', 'Philippines'),
(13, '2018-00005', 0, 'zxcxzczxc', 'xzcxzc', 'xzczcxzc', 'zxcxzc', 'zxcxzc', 'zxczxc', 'Philippines'),
(14, '2018-00005', 1, 'xcxzcxz', 'czxc', 'zxcxzc', 'zxczx', 'czxzxcczxc', 'czxcxz', 'Philippines'),
(15, '2018-00005', 2, 'xcxzcxz', 'czxc', 'zxcxzc', 'zxczx', 'czxzxcczxc', 'czxcxz', 'Philippines');

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
(2, '2018-00001', 1, 'maco.techdepot@gmail.com'),
(3, '2018-00002', 0, '(123) 456-7899'),
(4, '2018-00002', 1, 'test@test.com'),
(5, '2018-00002', 1, 'test@test.com'),
(6, '2018-00002', 1, 'test@test.com'),
(7, '2018-00003', 0, '(231) 231-2312'),
(8, '2018-00003', 1, 'asdasdsad@azsda.com'),
(9, '2018-00004', 0, '(123) 123-1231'),
(10, '2018-00004', 1, '1asdasdasd@gmail.com'),
(11, '2018-00004', 1, '1asdasdasd@gmail.com'),
(12, '2018-00004', 1, '1asdasdasd@gmail.com'),
(13, '2018-00005', 0, '(232) 131-2312'),
(14, '2018-00005', 1, 'zcxzzxc@zxc.com');

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
(1, '2018-00001', 2, 'STI Dipolog', 'BSCS', '2015'),
(2, '2018-00002', 3, 'STI Dipolog', 'TEST', '2012'),
(3, '2018-00003', 2, 'sadsad', 'asdas', '1234'),
(4, '2018-00004', 2, 'asdasd', 'asdasd', 'asd1'),
(5, '2018-00005', 2, 'xzczxczxc', 'zxcxzc', '4324');

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
(1, '2018-00001', 1, 'Naahh', 'nahh', 'nahh', '2010-02-03', NULL, '(988) 887-7777', 'naahh', 'naaahhh'),
(2, '2018-00002', 1, 'jhsjhjashdkjhas', 'kjjksadhkjadsh', '23457ujsdnjahdkjh', '2018-01-16', NULL, '(234) 567-8987', 'jhsdajhdskh', 'sfndsfhkjdshfdskjfh'),
(3, '2018-00003', 1, 'asda', 'dsadas', 'asdasdasdasd', '2017-05-17', NULL, '(231) 231-2312', 'asad', ''),
(4, '2018-00004', 1, 'asda', 'dasda', 'asdasd', '2010-02-09', NULL, '(123) 123-2131', 'asdasd', 'asdasdasd'),
(5, '2018-00005', 0, 'zxczxczxc', 'zxczxc', 'zxcxzc', '2015-07-23', NULL, '(123) 213-5456', 'xzczcxzc', 'zxczxczxc');

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
('bf3agrp8b6ssd5n7hua9lo7tan585j7o', '::1', 1519807508, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531393830373530333b6572726f727c733a31383a22596f75206e65656420746f206c6f67696e21223b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d737563636573737c733a31383a225061796d656e74205375626d697474656421223b7761726e696e677c613a313a7b693a303b733a35343a2254686520416d6f756e74206669656c64206d75737420636f6e7461696e2061206e756d6265722067726561746572207468616e20302e223b7d7061795f69647c733a31333a22504159323031382d3030303036223b),
('lk661e237n97t6pmcv7ral5qm0koh1rb', '::1', 1520158435, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303135383433353b),
('8al9c3b14464ngvk4cu0vksng2aoakp6', '::1', 1520267841, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303236373638333b737563636573737c733a33333a22596f752068617665207375636365737366756c6c79206c6f67676564206f757421223b),
('rmvckuev0ap35nmkppb7f1f20ugsi1o7', '192.168.1.4', 1520304992, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330343939323b),
('njq6onb8qt9a5oj31quvq9ir47e73v57', '192.168.1.4', 1520305123, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353132333b),
('r1bis5shj2isdbh41krgsmlklrfa8o4a', '192.168.1.4', 1520305156, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353135363b),
('lkrqdrd6hdisuvfkfnqhs10sbji80jj8', '192.168.1.4', 1520305191, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353139313b),
('cr5ddhjk75b51m5r8s70injhso3hiulp', '192.168.1.4', 1520305194, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353139343b),
('2cbsi1j7sp1fk6vj71g6v9f8f4m87u8d', '192.168.1.4', 1520305227, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353232373b),
('tbredjtoj2abaqhu7rqr6anp9809cm8h', '192.168.1.4', 1520305234, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353233343b),
('sniauak619uga9v4uv2rhkfqg4v9lsek', '192.168.1.4', 1520305239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353233393b),
('4rrsrfvlqhgkprtmntb5rr3q9s9bt92l', '192.168.1.4', 1520305253, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353235333b),
('dikvodljq60lq2166unb9k4jla5lrnn5', '192.168.1.4', 1520305318, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353331383b),
('ihulpn6ur9bj51eefun9ad3ma8h6fi5s', '192.168.1.4', 1520305432, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353433323b),
('0aip6vji694or5rrmah3povnj2dcrmha', '192.168.1.4', 1520305455, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353435353b),
('82144clicql4uack0c2egbuoooq0c0d8', '192.168.1.4', 1520305466, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353436363b),
('6c93e35fgj05pgaanpccgfvbjm81dnom', '192.168.1.4', 1520305476, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353437363b),
('rmap605n02jd2407bjvrsslbpumadaph', '192.168.1.4', 1520305506, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353530363b),
('l8gopeik0e9c2sgol3kn477aso70edfd', '192.168.1.4', 1520305512, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353531323b),
('aiec1fgh6llroukko1dj451o2b35dklg', '192.168.1.4', 1520305563, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353536323b),
('t9dfii35huc9k2iko3iqfg46f09iod6b', '192.168.1.4', 1520305664, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353636343b),
('hmg19q1pevch5jomnpul0goobcsmirlb', '192.168.1.4', 1520305674, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353637333b),
('hmg0m3rbtuv59rgi9ngarjumolo35ssi', '192.168.1.4', 1520305726, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353732363b),
('buf1ctf7v6nitktlvshhvv9u86ri5621', '192.168.1.4', 1520305728, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353732383b),
('hlk1qj47jo2np0ldqg4ticabogr2osrr', '192.168.1.4', 1520305803, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330353830323b),
('dev9ume1cj840r8713h1ek5hctm46m3m', '192.168.1.109', 1520308848, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330383834383b),
('o5lldrdg8p69ut45os6o7d9d5p6dqdse', '192.168.1.109', 1520309101, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393130313b),
('3gsi0t7ks0masute6hq51p31tg2ikm9g', '192.168.1.109', 1520309123, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393132333b),
('kjbftjijpmlgotm98mderqdke3mu0r20', '192.168.1.109', 1520309185, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393138353b),
('3rp510a21a427i5sddmiok5u7hq867d5', '192.168.1.109', 1520309190, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393139303b),
('umdan6k20sjgvj0ksi7tfjlv8tkbo8hb', '192.168.1.109', 1520309473, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393437333b),
('fgcujdepht4hmdlcln47vt93ru5dfouo', '192.168.1.109', 1520309484, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393438343b),
('9pkgkcir7tu8jtd1qk00l7brubs2refs', '192.168.1.109', 1520309494, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393439343b),
('kb1etr8tu90bv0t6beemmgusg69hpdv2', '192.168.1.109', 1520309529, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393532393b),
('6e24amsl47skcicoh68n9e9e0ltgfe56', '192.168.1.109', 1520309532, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393533323b),
('prbim952bbqqq43ovn3ad7qqdsdsefam', '192.168.1.109', 1520309540, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393534303b),
('e92155jqm2dffpp185j2v5mhn37cp9n5', '::1', 1520309704, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393632313b),
('0spbgkfhhf47p7o7lkkpnqtopnr2nvtm', '192.168.1.109', 1520309711, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393731313b),
('muraf676smdmkoek37tu6ku4dsrvrv9f', '192.168.1.109', 1520309737, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393733373b),
('jrgrsplll7c0s0cb5j6gl6lp4ge22rre', '192.168.1.109', 1520309737, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393733373b),
('ttmqeihilfd77j97dqklujtop7ii4b25', '192.168.1.109', 1520309863, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393836333b),
('03q4jejr9lqtfm5cussgekgg1v977arc', '192.168.1.109', 1520309871, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393837313b),
('lb1v8upa3bqnck0g82b5rhsid77g3pi6', '192.168.1.109', 1520309871, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393837313b),
('mulsoueoch7i6r4n9ahtfmu6e0dlrvsk', '192.168.1.109', 1520309969, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303330393936393b),
('il0rb28ca5s9inu7fle0tbtas9pgr9qi', '192.168.1.109', 1520310143, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303331303134333b),
('pdk2alrm5s9fa3d248cum607uq3prt4h', '::1', 1520315942, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303331353838383b737563636573737c733a33333a22596f752068617665207375636365737366756c6c79206c6f67676564206f757421223b);

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
(1, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/Felix.jpg', 'Felix.jpg', 'image/jpeg', '2018-02-20 12:58:52', NULL, 'admin'),
(2, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/IMG_1377.jpg', 'IMG_1377.jpg', 'image/jpeg', '2018-02-27 13:17:33', NULL, 'admin'),
(3, 'loan', '2018-00001-00001', './uploads/borrowers/2018-00001/loans/2018-00001-00001/03_LCD_Slide_Handout_1(3)_(1).pdf', '03_LCD_Slide_Handout_1(3)_(1).pdf', 'application/pdf', '2018-02-27 13:17:54', NULL, 'admin');

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

INSERT INTO `loans` (`id`, `borrower_id`, `borrowed_amount`, `due_days`, `due_date`, `borrowed_percentage`, `description`, `status`, `approved_at`, `created_at`, `updated_at`) VALUES
('2018-00001-00001', '2018-00001', '10000.00', 44, '2018-04-13', '8.50', NULL, 1, '2018-02-28 00:52:12', '2018-02-28 00:48:34', '2018-02-27 16:52:12'),
('2018-00002-00002', '2018-00002', '120000.00', 205, '2018-09-21', '8.50', NULL, 3, '2018-02-28 10:22:31', '2018-02-28 08:35:26', '2018-02-28 06:11:13');

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
(1, '2018-00001-00001', 'Test', 'asdasdsadasd', NULL, 'asdasasdasdasd'),
(3, NULL, 'Testss', 'Test', NULL, 'Test'),
(4, '2018-00002-00002', 'asdasd', 'asdasd', NULL, 'asdasd'),
(22, '2018-00002-00002', 'WOW', '', NULL, '');

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
(1, '2018-00001-00001', 1, '1540.00'),
(2, '2018-00001-00001', 2, '1520.00'),
(3, '2018-00001-00001', 3, '556.00'),
(4, '2018-00001-00001', 4, '1000.00'),
(5, '2018-00001-00001', 5, '1000.00'),
(6, '2018-00001-00001', 6, '1000.00'),
(7, '2018-00002-00002', 1, '2000.00'),
(8, '2018-00002-00002', 2, '100.00'),
(9, '2018-00002-00002', 3, '2000.00'),
(10, '2018-00002-00002', 4, '3500.00'),
(11, '2018-00002-00002', 5, '0.00'),
(12, '2018-00002-00002', 6, '0.00');

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
(3, '2018-00001-00001', 3, '1000.00'),
(4, '2018-00001-00001', 4, '100.00'),
(5, '2018-00001-00001', 5, '1000.00'),
(6, '2018-00002-00002', 1, '400.00'),
(7, '2018-00002-00002', 2, '6000.00'),
(8, '2018-00002-00002', 3, '3000.00'),
(9, '2018-00002-00002', 4, '200.00'),
(10, '2018-00002-00002', 5, '5100.00');

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
(1, '2018-00001-00001', 'DISB', 'Actual Disbursed: PHP 9,500.00', '10000.00', '0.00', '2018-02-28 01:58:45', 'admin'),
(2, '2018-00001-00001', 'INTR', 'Applied Standard Interests basing from 8.50% of PHP 10,000.00', '850.00', '0.00', '2018-02-28 01:58:45', 'admin'),
(3, '2018-00001-00001', 'SCHR', 'Standard Service Charge', '500.00', '0.00', '2018-02-28 01:58:45', 'admin'),
(4, '2018-00001-00001', 'SCHR', 'Service Charge Paid', '0.00', '500.00', '2018-02-28 01:58:45', 'admin'),
(5, '2018-00001-00001', 'CPAY', 'Payment #PAY2018-00001', '0.00', '1000.00', '2018-02-28 02:04:18', 'admin'),
(6, '2018-00001-00001', 'CPAY', 'Payment #PAY2018-00002', '0.00', '500.00', '2018-02-28 02:07:19', 'admin'),
(7, '2018-00001-00001', 'CPAY', 'Payment #PAY2018-00003', '0.00', '2500.00', '2018-02-28 02:07:32', 'admin'),
(8, '2018-00002-00002', 'DISB', 'Actual Disbursed: PHP 114,000.00', '120000.00', '0.00', '2018-02-28 12:36:22', 'admin'),
(9, '2018-00002-00002', 'INTR', 'Applied Standard Interests basing from 8.50% of PHP 120,000.00', '10200.00', '0.00', '2018-02-28 12:36:22', 'admin'),
(10, '2018-00002-00002', 'SCHR', 'Standard Service Charge', '6000.00', '0.00', '2018-02-28 12:36:22', 'admin'),
(11, '2018-00002-00002', 'SCHR', 'Service Charge Paid', '0.00', '6000.00', '2018-02-28 12:36:22', 'admin'),
(12, '2018-00002-00002', 'PNTY', 'Applied Penalties', '500.00', '0.00', '2018-02-28 13:02:03', 'admin'),
(15, '2018-00002-00002', 'CPAY', 'Payment #PAY2018-00006', '0.00', '130700.00', '2018-02-28 14:11:13', 'admin');

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
('PAY2018-00001', '2018-00001-00001', 'Maco Cortes', 'sfsdfsdf', 'asdsadasdasd', '1000.00', 'admin', '2018-02-28 02:04:18'),
('PAY2018-00002', '2018-00001-00001', 'Maco Cortes', '', '', '500.00', 'admin', '2018-02-28 02:07:19'),
('PAY2018-00003', '2018-00001-00001', 'Maco Cortes', '', '', '2500.00', 'admin', '2018-02-28 02:07:32'),
('PAY2018-00004', '2018-00002-00002', 'Eric Yap', '', '', '130700.00', 'admin', '2018-02-28 13:05:39'),
('PAY2018-00005', '2018-00002-00002', 'Eric Yap', '', 'asdasd', '130700.00', 'admin', '2018-02-28 14:10:26'),
('PAY2018-00006', '2018-00002-00002', 'Eric Yap', '', '', '130700.00', 'admin', '2018-02-28 14:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `loans_payments_schedule`
--

CREATE TABLE `loans_payments_schedule` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `amount` decimal(10,4) DEFAULT NULL,
  `paid_actual` decimal(10,4) DEFAULT NULL,
  `paid_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans_payments_schedule`
--

INSERT INTO `loans_payments_schedule` (`id`, `loan_id`, `schedule`, `amount`, `paid_actual`, `paid_date`) VALUES
(1, '2018-00001-00001', '2018-03-15', '3616.6700', '3616.6700', '2018-02-28 02:07:32'),
(2, '2018-00001-00001', '2018-03-30', '3616.6700', '383.3300', '2018-02-28 02:07:32'),
(3, '2018-00001-00001', '2018-04-13', '3616.6700', NULL, NULL),
(4, '2018-00002-00002', '2018-03-15', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(5, '2018-00002-00002', '2018-03-30', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(6, '2018-00002-00002', '2018-04-15', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(7, '2018-00002-00002', '2018-04-30', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(8, '2018-00002-00002', '2018-05-15', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(9, '2018-00002-00002', '2018-05-30', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(10, '2018-00002-00002', '2018-06-15', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(11, '2018-00002-00002', '2018-06-30', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(12, '2018-00002-00002', '2018-07-15', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(13, '2018-00002-00002', '2018-07-30', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(14, '2018-00002-00002', '2018-08-15', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(15, '2018-00002-00002', '2018-08-30', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(16, '2018-00002-00002', '2018-09-15', '9300.0000', '9300.0000', '2018-02-28 13:05:39'),
(17, '2018-00002-00002', '2018-09-21', '9300.0000', '9300.0000', '2018-02-28 13:05:39');

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
(21, 'admin', 'loan', '2018-00001-00001', 'Approved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-23 16:16:22'),
(22, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-26 13:50:28'),
(23, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-26 22:42:51'),
(24, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 04:25:01'),
(25, 'admin', 'user', 'admin', 'Updated User Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 04:42:33'),
(26, 'admin', 'user', 'admin', 'Updated User Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 04:42:40'),
(27, 'admin', 'user', 'admin', 'Updated User Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 04:42:53'),
(28, 'admin', 'loan', '2018-00001-00001', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 04:48:35'),
(29, 'admin', 'borrower', '2018-00001', 'Loan Application - ID:2018-00001-00001 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 04:48:35'),
(30, 'admin', 'loan', '2018-00001-00001', 'Approved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 04:49:36'),
(31, 'admin', 'loan', '2018-00001-00001', 'Processed Disbursement', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 04:54:16'),
(32, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 05:17:33'),
(33, 'admin', 'loan', '2018-00001-00001', 'Uploaded a File', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 05:17:54'),
(34, 'admin', 'loan', '2018-00001-00001', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 06:46:01'),
(35, 'admin', 'borrower', '2018-00001', 'Loan Application - ID:2018-00001-00001 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 06:46:01'),
(36, 'admin', 'loan', '2018-00001-00001', 'Approved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 06:46:26'),
(37, 'admin', 'borrower', '2018-00002', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 09:05:53'),
(38, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 12:56:16'),
(39, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 14:10:53'),
(40, 'admin', 'loan', '2018-00001-00001', 'Approved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 14:44:43'),
(41, 'admin', 'loan', '2018-00001-00001', 'Processed Disbursement', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 14:45:25'),
(42, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 14:45:35'),
(43, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 14:46:06'),
(44, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 14:49:07'),
(45, 'admin', 'loan', '2018-00001-00001', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 16:48:34'),
(46, 'admin', 'borrower', '2018-00001', 'Loan Application - ID:2018-00001-00001 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 16:48:34'),
(47, 'admin', 'loan', '2018-00001-00001', 'Approved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 16:52:12'),
(48, 'admin', 'loan', '2018-00001-00001', 'Processed Disbursement', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 16:52:18'),
(49, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 16:55:15'),
(50, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 16:55:47'),
(51, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 16:57:24'),
(52, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 16:58:31'),
(53, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:01:52'),
(54, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:02:35'),
(55, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:03:57'),
(56, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:04:16'),
(57, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:04:23'),
(58, 'admin', 'borrower', '2018-00003', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:08:24'),
(59, 'admin', 'borrower', '2018-00003', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:10:25'),
(60, 'admin', 'borrower', '2018-00003', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:11:14'),
(61, 'admin', 'borrower', '2018-00003', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:45:13'),
(62, 'admin', 'borrower', '2018-00003', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:45:19'),
(63, 'admin', 'borrower', '2018-00003', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:45:54'),
(64, 'admin', 'borrower', '2018-00003', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:46:59'),
(65, 'admin', 'borrower', '2018-00003', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:48:12'),
(66, 'admin', 'borrower', '2018-00003', 'Updated Personal Information', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:48:19'),
(67, 'admin', 'borrower', '2018-00004', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:49:20'),
(68, 'admin', 'borrower', '2018-00005', 'Account Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:55:05'),
(69, 'admin', 'loan', '2018-00001-00001', 'Processed Disbursement', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 17:58:45'),
(70, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 18:04:18'),
(71, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 18:07:19'),
(72, 'admin', 'loan', '2018-00001-00001', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-27 18:07:32'),
(73, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 00:34:30'),
(74, 'admin', 'loan', '2018-00002-00002', 'Loan Application - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 00:35:26'),
(75, 'admin', 'borrower', '2018-00002', 'Loan Application - ID:2018-00002-00002 - Pending', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 00:35:26'),
(76, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:36:18'),
(77, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:37:34'),
(78, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:38:46'),
(79, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:39:32'),
(80, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:39:48'),
(81, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:40:20'),
(82, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:40:56'),
(83, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:41:20'),
(84, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:42:24'),
(85, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:43:09'),
(86, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:44:36'),
(87, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:44:43'),
(88, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:45:09'),
(89, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:45:16'),
(90, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:45:37'),
(91, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:46:25'),
(92, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:46:50'),
(93, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:47:02'),
(94, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:47:41'),
(95, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:47:46'),
(96, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:48:16'),
(97, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:48:42'),
(98, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:48:57'),
(99, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:49:12'),
(100, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:49:31'),
(101, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:49:36'),
(102, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:50:03'),
(103, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:50:49'),
(104, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:50:53'),
(105, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:51:14'),
(106, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:51:21'),
(107, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:56:01'),
(108, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:56:16'),
(109, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:57:39'),
(110, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 01:58:43'),
(111, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:00:01'),
(112, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:01:28'),
(113, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:02:04'),
(114, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:04:19'),
(115, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:04:44'),
(116, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:04:52'),
(117, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:06:44'),
(118, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:06:54'),
(119, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:07:09'),
(120, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:07:25'),
(121, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:09:42'),
(122, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:09:58'),
(123, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:11:53'),
(124, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:12:19'),
(125, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:12:51'),
(126, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:13:11'),
(127, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:13:43'),
(128, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:13:55'),
(129, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:14:39'),
(130, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:15:06'),
(131, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:15:54'),
(132, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:16:10'),
(133, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:16:15'),
(134, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:16:45'),
(135, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:16:53'),
(136, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:16:58'),
(137, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:19:16'),
(138, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:19:21'),
(139, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:19:34'),
(140, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:20:18'),
(141, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:20:23'),
(142, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:20:30'),
(143, 'admin', 'loan', '2018-00002-00002', 'Updated Request Details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:20:35'),
(144, 'admin', 'loan', '2018-00002-00002', 'Approved Loan Request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 02:22:31'),
(145, 'admin', 'loan', '2018-00002-00002', 'Processed Disbursement', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 04:36:22'),
(146, 'admin', 'loan', '2018-00002-00002', 'Added a Debit Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 05:02:03'),
(147, 'admin', 'loan', '2018-00002-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 05:05:39'),
(148, 'admin', 'loan', '2018-00002-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 06:10:26'),
(149, 'admin', 'loan', '2018-00002-00002', 'Submitted a Payment', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', '2018-02-28 06:11:13'),
(150, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-05 16:29:42'),
(151, 'admin', 'expense', '1', 'Created an Expense Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-05 16:29:55'),
(152, 'admin', 'user', 'asdsdasda', 'User Registration', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-05 16:30:41'),
(153, 'admin', 'user', 'asdsdasda', 'Resetted Password to Default', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-05 16:30:54'),
(154, 'admin', 'borrower', '2018-00002', 'Updated Picture', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-05 16:31:24'),
(155, 'admin', 'expense', '2', 'Created an Expense Record', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-05 16:31:41'),
(156, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-05 16:32:32'),
(157, 'asdsdasda', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-05 16:32:51'),
(158, 'asdsdasda', '', '', 'Updated Personal Profile', '::1', '', '2018-03-05 16:37:03'),
(159, 'asdsdasda', '', '', 'Updated Access Pin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-05 16:37:12'),
(160, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-06 02:56:44'),
(161, 'collector', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-06 02:58:03'),
(162, 'admin', ' ', ' ', 'User Logged In', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-06 04:20:01');

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
(3, 'loan', '2018-00001-00001', NULL, 'admin: Approved this Loan Request. <br/> Remarks: dasdasdasdasdasdasdasdasd', '2018-02-24 00:16:22', NULL, NULL),
(4, 'loan', '2018-00001-00001', NULL, 'admin: Approved this Loan Request. <br/> Remarks: Test 123', '2018-02-27 12:49:36', NULL, NULL),
(5, 'loan', '2018-00001-00001', NULL, 'admin: Approved this Loan Request. <br/> Remarks: VOILA!', '2018-02-27 14:46:26', NULL, NULL),
(6, 'loan', '2018-00001-00001', NULL, 'admin: Approved this Loan Request. <br/> Remarks: Test', '2018-02-27 22:44:43', NULL, NULL),
(7, 'loan', '2018-00001-00001', NULL, 'admin: Approved this Loan Request. <br/> Remarks: aasdsadsa', '2018-02-28 00:52:12', NULL, NULL),
(8, 'loan', '2018-00002-00002', NULL, 'admin: Approved this Loan Request. <br/> Remarks: jhghjgh', '2018-02-28 10:22:31', NULL, NULL);

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

--
-- Dumping data for table `store_expenses`
--

INSERT INTO `store_expenses` (`id`, `payee`, `receipt`, `description`, `amount`, `created_at`, `user`) VALUES
(1, 'asdasd', 'asdasd', 'adsasd', '500.00', '2018-03-06 00:29:55', 'admin'),
(2, 'sdsdasdasd', 'adasdasd', 'asdasdasd', '200.00', '2018-03-06 00:31:41', 'admin');

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
('111111', 'admin', '$2y$10$mt9rqihNCu6CVMnAcyqOreGwmO4yh2rgD9zvODgvxcpcDHvMIMcm6', 'Administrator', 'Admin', 'admin@admin.com', '1234567890', 'Administrator', './uploads/users/admin/b770d94c8b5e5d9b17c109db881469d8.png', '2017-09-27 15:22:36', '2018-02-27 04:42:53', 0),
('a23asd', 'asdsdasda', '$2y$10$5oQqZydsy6ZvyUQL1Bk5nu5eZSg4vnmX2yySQLxAuwHAa84S.aXt6', 'HEHEHE', 'EHEHEH', 'maco.techdepot@gmail.com', '123123123', 'Collector', NULL, '2018-03-06 00:30:41', '2018-03-05 16:37:12', 0),
('qwertyu', 'collector', '$2y$10$5oQqZydsy6ZvyUQL1Bk5nu5eZSg4vnmX2yySQLxAuwHAa84S.aXt6', 'HEHEHE', 'EHEHEH', 'maco.techdepot@gmail.com', '123123123', 'Collector', NULL, '2018-03-06 00:30:41', '2018-03-06 03:00:20', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `borrowers_contacts`
--
ALTER TABLE `borrowers_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `borrowers_educ`
--
ALTER TABLE `borrowers_educ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `borrowers_spouse`
--
ALTER TABLE `borrowers_spouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `borrowers_work`
--
ALTER TABLE `borrowers_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `loans_creditors`
--
ALTER TABLE `loans_creditors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `loans_payments_schedule`
--
ALTER TABLE `loans_payments_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `store_expenses`
--
ALTER TABLE `store_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
