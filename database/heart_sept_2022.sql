-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 06:19 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heart_sept_2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `con_id` int(11) NOT NULL,
  `emp_mob1` varchar(13) DEFAULT NULL,
  `emp_mob2` varchar(13) DEFAULT NULL,
  `emp_email` varchar(200) DEFAULT NULL,
  `emp_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(200) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_status`
--

CREATE TABLE `doctor_status` (
  `status_id` int(11) NOT NULL,
  `status_title` varchar(200) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(200) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `emp_age` int(11) DEFAULT NULL,
  `emp_gender` enum('male','female') DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `exam_id` int(11) NOT NULL,
  `exam_name` varchar(200) DEFAULT NULL,
  `exam_price` float DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `pat_id` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `invoice_time` time DEFAULT NULL,
  `invoice_total` float DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `detail_id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `amount` float GENERATED ALWAYS AS (`price` - `discount`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(200) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `pat_id` int(11) NOT NULL,
  `pat_name` varchar(200) DEFAULT NULL,
  `pat_phone` varchar(13) DEFAULT NULL,
  `pat_age` int(11) DEFAULT NULL,
  `pat_gender` enum('male','female') DEFAULT NULL,
  `treat_id` int(11) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(200) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treat_doctors`
--

CREATE TABLE `treat_doctors` (
  `treat_id` int(11) NOT NULL,
  `treat_name` varchar(200) DEFAULT NULL,
  `treat_address` varchar(200) DEFAULT NULL,
  `treat_phone` varchar(13) DEFAULT NULL,
  `treat_gender` enum('male','female') DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_userid` int(11) NOT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `user_username` varchar(200) DEFAULT NULL,
  `uer_password` varchar(200) DEFAULT NULL,
  `user_usertype` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`),
  ADD KEY `dept_user` (`user_userid`);

--
-- Indexes for table `doctor_status`
--
ALTER TABLE `doctor_status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `sttus_user` (`user_userid`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `emp_job` (`job_id`),
  ADD KEY `emp_dept` (`dept_id`),
  ADD KEY `emp_user` (`user_userid`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `exam_user` (`user_userid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invo_pat` (`pat_id`),
  ADD KEY `invo_emp` (`emp_id`),
  ADD KEY `invo_user` (`user_userid`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `detail_invo` (`invoice_id`),
  ADD KEY `detail_exam` (`exam_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `job_user` (`user_userid`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`pat_id`),
  ADD KEY `pat_treat` (`treat_id`),
  ADD KEY `pat_user` (`user_userid`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `section_user` (`user_userid`);

--
-- Indexes for table `treat_doctors`
--
ALTER TABLE `treat_doctors`
  ADD PRIMARY KEY (`treat_id`),
  ADD UNIQUE KEY `treat_phone` (`treat_phone`),
  ADD KEY `section_treat` (`section_id`),
  ADD KEY `status_treat` (`status_id`),
  ADD KEY `treat_user` (`user_userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_userid`),
  ADD UNIQUE KEY `user_username` (`user_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_status`
--
ALTER TABLE `doctor_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treat_doctors`
--
ALTER TABLE `treat_doctors`
  MODIFY `treat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_userid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `dept_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_status`
--
ALTER TABLE `doctor_status`
  ADD CONSTRAINT `sttus_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `emp_dept` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_job` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `examinations`
--
ALTER TABLE `examinations`
  ADD CONSTRAINT `exam_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invo_emp` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invo_pat` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`pat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invo_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `detail_exam` FOREIGN KEY (`exam_id`) REFERENCES `examinations` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_invo` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `job_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `pat_treat` FOREIGN KEY (`treat_id`) REFERENCES `treat_doctors` (`treat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pat_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `section_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `treat_doctors`
--
ALTER TABLE `treat_doctors`
  ADD CONSTRAINT `section_treat` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_treat` FOREIGN KEY (`status_id`) REFERENCES `doctor_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `treat_user` FOREIGN KEY (`user_userid`) REFERENCES `users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
