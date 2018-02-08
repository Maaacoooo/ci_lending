-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2018 at 01:30 PM
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
-- Table structure for table `loans_expense`
--

CREATE TABLE `loans_expense` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `expense_id` int(11) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `loans_ledger_codes`
--

CREATE TABLE `loans_ledger_codes` (
  `code` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
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
  `user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
('admin', '$2y$10$mt9rqihNCu6CVMnAcyqOreGwmO4yh2rgD9zvODgvxcpcDHvMIMcm6', 'Administrator', 'admin@admin.com', '1234567890', 'Administrator', './uploads/users/admin/b770d94c8b5e5d9b17c109db881469d8.png', '2017-09-27 15:22:36', '2018-02-05 14:35:29', 0),
('test', '$2y$10$L/bwEx4n7YP2.JlGciB22.VM9q3xxb/um1EvFi2eUN4GzA3uamUsS', 'NICE OBNE ', 'nice.nice@nice.com', '1132101223', '2nd Account', './uploads/users/Maikoo/4e828ac7e7d00fa179d8bb9a2553b183.png', '2017-11-22 22:41:23', '2017-12-01 16:48:58', 0);

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
('2nd Account', 8),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `borrowers_contacts`
--
ALTER TABLE `borrowers_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `borrowers_educ`
--
ALTER TABLE `borrowers_educ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `borrowers_spouse`
--
ALTER TABLE `borrowers_spouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `borrowers_work`
--
ALTER TABLE `borrowers_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `loans_creditors`
--
ALTER TABLE `loans_creditors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loans_expense`
--
ALTER TABLE `loans_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loans_income`
--
ALTER TABLE `loans_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loans_ledger`
--
ALTER TABLE `loans_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
