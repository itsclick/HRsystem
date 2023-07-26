-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2018 at 07:09 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuo_payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `award_id` int(100) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `head_dep_id` int(100) NOT NULL,
  `award_title` varchar(225) NOT NULL,
  `gift_item` varchar(225) NOT NULL,
  `award_amount` varchar(255) NOT NULL,
  `month` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `comp_id` int(100) NOT NULL,
  `comp_name` varchar(255) NOT NULL,
  `comp_logo` varchar(255) NOT NULL,
  `comp_email` varchar(255) NOT NULL,
  `comp_address` varchar(255) NOT NULL,
  `comp_city` varchar(255) NOT NULL,
  `comp_country` varchar(255) NOT NULL,
  `comp_tel` varchar(255) NOT NULL,
  `comp_mobile` varchar(255) NOT NULL,
  `comp_office_line` varchar(255) NOT NULL,
  `comp_fax` varchar(255) NOT NULL,
  `comp_website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dep_id` int(100) NOT NULL,
  `dep_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dep_id`, `dep_name`) VALUES
(8, 'Accounting'),
(9, 'Administration '),
(10, 'Human Resources'),
(11, 'Maintenance'),
(17, 'Sales &amp; Marketing'),
(18, 'Safety & Environment'),
(19, 'Showroom Branch'),
(20, 'Engineering '),
(21, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(100) NOT NULL,
  `emp_code` varchar(255) NOT NULL,
  `emp_joining_date` varchar(100) NOT NULL,
  `emp_fullname` varchar(255) NOT NULL,
  `emp_dob` varchar(100) NOT NULL,
  `emp_gender` varchar(255) NOT NULL,
  `emp_maratial_status` varchar(225) NOT NULL,
  `emp_mothers_mainden_name` varchar(225) NOT NULL,
  `emp_nationality` varchar(255) NOT NULL,
  `emp_tin_number` varchar(255) NOT NULL DEFAULT 'N/A',
  `emp_ssnit_number` varchar(255) NOT NULL DEFAULT 'N/A',
  `emp_present_address` varchar(255) NOT NULL,
  `emp_city` varchar(255) NOT NULL,
  `emp_country` varchar(255) NOT NULL,
  `emp_mobile` varchar(255) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_branch` varchar(250) NOT NULL,
  `bank_account_name` varchar(255) NOT NULL,
  `bank_account_no` int(100) NOT NULL,
  `emp_contact_fullname` varchar(255) NOT NULL,
  `emp_contact_housenumber` varchar(255) NOT NULL,
  `emp_contact_mobile` varchar(255) NOT NULL,
  `emp_contact_occupation` varchar(225) NOT NULL,
  `emp_contact_relationshipToEmp` varchar(225) NOT NULL,
  `position_id` int(100) NOT NULL,
  `head_dep_id` int(100) NOT NULL,
  `basic_salary` varchar(225) NOT NULL,
  `employment_type` varchar(225) NOT NULL,
  `emp_photo` varchar(255) NOT NULL,
  `emp_resume` varchar(255) NOT NULL,
  `emp_offerLetter` varchar(225) NOT NULL,
  `emp_joiningLetter` varchar(225) NOT NULL,
  `emp_contractPaper` varchar(225) NOT NULL,
  `emp_idProff` varchar(225) NOT NULL,
  `emp_otherDocument` varchar(225) NOT NULL,
  `status` int(100) NOT NULL,
  `annual_leave` int(100) NOT NULL,
  `sick_leave` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_code`, `emp_joining_date`, `emp_fullname`, `emp_dob`, `emp_gender`, `emp_maratial_status`, `emp_mothers_mainden_name`, `emp_nationality`, `emp_tin_number`, `emp_ssnit_number`, `emp_present_address`, `emp_city`, `emp_country`, `emp_mobile`, `emp_email`, `bank_name`, `bank_branch`, `bank_account_name`, `bank_account_no`, `emp_contact_fullname`, `emp_contact_housenumber`, `emp_contact_mobile`, `emp_contact_occupation`, `emp_contact_relationshipToEmp`, `position_id`, `head_dep_id`, `basic_salary`, `employment_type`, `emp_photo`, `emp_resume`, `emp_offerLetter`, `emp_joiningLetter`, `emp_contractPaper`, `emp_idProff`, `emp_otherDocument`, `status`, `annual_leave`, `sick_leave`) VALUES
(34, 'KUO001', '06/05/2012', 'Mamadou Bah', '03/03/1983', 'Male', 'Single', 'Oumou Kantara', 'guinean', 'N/A', 'N/A', 'Darkuman', 'Accra', 'ghanaian', '0249141982', 'elhadji083@gmail.com', 'GT Bank', 'Ring Road', 'Mamadou Bah', 2147483647, 'Oumou Kantara', 'C12/110', '0264543454', 'Caterer', 'Wife', 15, 1, '800', 'Permanent', 'user_baah.jpeg', '', '', '', '', '', '61475b3866f6668a4.png', 1, 21, 5),
(35, 'KUO002', '09/01/2018', 'Belinda Boateng', '09/01/1992', 'Female', 'Single', 'Ama Boateng', 'ghanaian', 'C0245412454', '4A045421545', 'Achimota - Ma 7', 'Accra', 'ghanaian', '0245124542', 'belinda@gmail.com', 'GT Bank', 'Ring Road ', 'Belinda Boateng', 2147483647, 'Ama Boateng', 'C14/142', '2065432454', 'Banker', 'Sister', 14, 7, '800', 'Permanent', 'images (16).jpg', '', '', '', '', '', '', 1, 17, 5),
(36, 'KUO003', '05/01/2015', 'Prince Nii Lante Mills', '05/02/1985', 'Male', 'Married', 'Nana Mills', 'ghanaian', 'C421542224', 'H04544X000', 'Gbawe Mallam', 'Accra', 'ghanaian', '0277899767', 'mills_prince@gmail.com', 'GT Bank', 'Ring Road', 'Prince Nii Lante Mills', 2147483647, 'Nana MIlls', 'S21/457', '0245724575', 'Banker', 'Wife', 15, 1, '790', 'Permanent', 'download (6).jpg', '6776577a1607b5936.jpg', '8630577a2942aef20.jpg', '61475b3866f6668a4.png', 'camerasang4.jpg', '1434577a2e72d6e5f.jpg', '6776577a1607b5936.jpg', 1, 18, 5),
(37, 'KUO004', '03/04/2016', 'Abraham Tetteh', '09/02/1980', 'Male', 'Single', 'Kojo Ama', 'ghanaian', 'N/A', 'X02412400124', 'Niamekye', 'Accra', 'ghanaian', '0245651245', 'abraham@gmail.com', 'GT Bank', 'Ring Road', 'Abraham Tetteh', 2147483647, 'Kojo Ama', 'F58/021', '026542145', 'Businessman', 'Brother', 37, 8, '820', 'Permanent', 'images (5).jpg', '', '', '', '', '', '', 1, 15, 5),
(38, 'KUO005', '12/04/2013', 'Christine Oteng', '01/04/1986', 'Female', 'Single', '', 'ghanaian', 'N/A', 'N/A', 'Dansoman', 'Accra', 'Ghana', '0521454214', 'christine@kuo.com', 'GT bank', 'Ring Road', 'Chistine Oteng', 2147483647, 'George Oteng', 'H08/209', '0245124542', 'Banker ', 'Oncle', 2, 6, '600', 'Permanent', 'download (1).jpg', '', '', '', '', '', '', 1, 18, 5),
(39, 'KUO006', '10/02/2014', 'Franklin Osei', '12/02/1984', 'Male', 'Single', '', 'ghanaian', 'N/A', 'A09382747244', 'Mallam', 'Accra', 'Ghana', '0265424540', 'franklin@kuo.com', 'GT Bank', 'Ring Road', 'Franklin Osei', 2147483647, 'Micheal Osei', 'A20/210', '0245124540', 'Lawyer', 'Oncle', 2, 6, '650', 'Permanent', 'download (3).jpg', '', '', '', '', '', '', 1, 18, 5);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(1, 'All Day Event', '#40E0D0', '2016-01-01 00:00:00', '0000-00-00 00:00:00'),
(2, 'Long Event', '#FF0000', '2016-01-07 00:00:00', '2016-01-10 00:00:00'),
(3, 'Repeating Event', '#0071c5', '2016-01-09 16:00:00', '0000-00-00 00:00:00'),
(4, 'Conference', '#40E0D0', '2016-01-11 00:00:00', '2016-01-13 00:00:00'),
(5, 'Meeting', '#000', '2016-01-12 10:30:00', '2016-01-12 12:30:00'),
(6, 'Lunch', '#0071c5', '2016-01-12 12:00:00', '0000-00-00 00:00:00'),
(7, 'Happy Hour', '#0071c5', '2016-01-12 17:30:00', '0000-00-00 00:00:00'),
(8, 'Dinner', '#0071c5', '2016-01-12 20:00:00', '0000-00-00 00:00:00'),
(9, 'Birthday Party', '#FFD700', '2016-01-14 07:00:00', '2016-01-14 07:00:00'),
(10, 'Double click to change', '#008000', '2016-01-28 00:00:00', '0000-00-00 00:00:00'),
(15, 'Wedding at Kasoa', '#008000', '2018-04-22 00:00:00', '2018-04-23 00:00:00'),
(16, 'mmmm', '#FFD700', '2015-12-29 00:00:00', '2015-12-30 00:00:00'),
(17, 'chrismas days', '#0071c5', '2016-01-03 00:00:00', '2016-01-06 00:00:00'),
(18, 'meeting at mallah', '#008000', '2018-04-29 00:00:00', '2018-04-30 00:00:00'),
(19, 'Pay Date', '#008000', '2018-11-30 00:00:00', '2018-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `headofdepartments`
--

CREATE TABLE `headofdepartments` (
  `head_dep_id` int(100) NOT NULL,
  `dep_id` int(100) NOT NULL,
  `HeadOfDepartment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headofdepartments`
--

INSERT INTO `headofdepartments` (`head_dep_id`, `dep_id`, `HeadOfDepartment`) VALUES
(1, 8, 'Hamude'),
(2, 20, 'Ammar '),
(3, 20, 'Mosallam'),
(4, 20, 'Abdulatif'),
(5, 17, 'Tarek Marabe  '),
(6, 17, 'Mariam Beiruti'),
(7, 9, 'Mohammed Sangari'),
(8, 18, 'Mohammed Refaat');

-- --------------------------------------------------------

--
-- Table structure for table `leave_form`
--

CREATE TABLE `leave_form` (
  `leave_form_id` int(100) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `head_dep_id` int(100) NOT NULL,
  `start_date` varchar(225) NOT NULL,
  `end_date` varchar(225) NOT NULL,
  `total_days` int(100) NOT NULL,
  `resumption_date` varchar(225) NOT NULL,
  `leave_id` int(100) NOT NULL,
  `reason_explanation` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `Officer_taken_over` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_form`
--

INSERT INTO `leave_form` (`leave_form_id`, `emp_id`, `head_dep_id`, `start_date`, `end_date`, `total_days`, `resumption_date`, `leave_id`, `reason_explanation`, `contact_number`, `Officer_taken_over`) VALUES
(1, 34, 1, '05/11/2018', '05/11/2018', 1, '06/11/2018', 1, 'Personal for resting', '0249141982', 'Prince Mills'),
(2, 35, 7, '12/11/2018', '13/11/2018', 2, '14/11/2018', 1, 'Baby Sitting', '0245124542', 'Sabina'),
(3, 34, 1, '03/12/2018', '03/12/2018', 1, '04/12/2018', 2, 'Doctor report', '0249141982', 'Prince'),
(4, 34, 1, '05/12/2018', '05/12/2018', 1, '06/12/2018', 4, 'Personal', '0249141982', 'Prince'),
(5, 34, 1, '02/12/2018', '02/12/2018', 1, '03/12/2018', 5, 'Emmergency', '0249141982', 'Prince');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `leave_id` int(100) NOT NULL,
  `leave_types` varchar(255) NOT NULL,
  `reason_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`leave_id`, `leave_types`, `reason_id`) VALUES
(1, 'Annual Leave', 1),
(2, 'Sick Leave', 1),
(3, 'Maternity Leave', 1),
(4, 'Personal Leave ', 2),
(5, 'Emmergency Leave ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `loan_id` int(100) NOT NULL,
  `loan_date` varchar(255) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `loan_amount` varchar(225) NOT NULL,
  `loan_paid` varchar(225) NOT NULL,
  `loan_balance` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`loan_id`, `loan_date`, `emp_id`, `loan_amount`, `loan_paid`, `loan_balance`) VALUES
(1, '10/03/2018', 37, '500', '300', '200'),
(2, '10/09/2018', 36, '5000', '1500', '3500'),
(3, '10/03/2018', 34, '550', '250', '300'),
(4, '10/10/2018', 35, '1100', '100', '1000'),
(5, '10/11/2018', 35, '300', '250', '50'),
(6, '11/22/2018', 34, '500', '250', '250');

-- --------------------------------------------------------

--
-- Table structure for table `overtimes`
--

CREATE TABLE `overtimes` (
  `overtime_id` int(100) NOT NULL,
  `overtime_date` varchar(100) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `overtime_location` varchar(225) NOT NULL,
  `basic_salary` varchar(225) NOT NULL,
  `overtime_time` varchar(255) NOT NULL,
  `overtime_type` varchar(225) NOT NULL,
  `number_of_hrs_mns_hol` varchar(225) NOT NULL,
  `number_of_hrs_mns` varchar(225) NOT NULL,
  `overtime_period` varchar(255) NOT NULL,
  `overtime_paid` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtimes`
--

INSERT INTO `overtimes` (`overtime_id`, `overtime_date`, `emp_id`, `overtime_location`, `basic_salary`, `overtime_time`, `overtime_type`, `number_of_hrs_mns_hol`, `number_of_hrs_mns`, `overtime_period`, `overtime_paid`) VALUES
(1, '08/11/2018', 34, 'Fixing fire alarm at koala', '700', 'Hours		', 'Working Days		', '', '2', 'November 2018		', '11.28		'),
(2, '10/11/2018  ', 35, 'Tender at Head Office', '800	', 'Hours	', 'Working Days	', '', '3', 'November 2018	', '15.38	'),
(5, '17/11/2018 ', 37, 'Training at GIS School', '870', 'Hours', 'Holidays/WeekEnd', '', '3', 'November 2018', '22.31'),
(6, '17/11/2018 ', 34, 'Tender at head office & Cleaning office', '880', 'Hours', 'Both', '2', '2', 'November 2018', '26.32');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `pay_id` int(100) NOT NULL,
  `pay_date` varchar(225) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `basic_salary` int(100) NOT NULL,
  `loan_id` int(100) NOT NULL,
  `loan_balance` int(100) NOT NULL,
  `leave_paid` varchar(100) NOT NULL,
  `overtime_paid` varchar(225) NOT NULL,
  `sales_commission` varchar(225) NOT NULL,
  `perdiem` varchar(225) NOT NULL,
  `other_benefits` varchar(225) NOT NULL,
  `ssnit` varchar(225) NOT NULL,
  `paye` varchar(225) NOT NULL,
  `loan_paid` varchar(225) NOT NULL,
  `advance_taken` varchar(225) NOT NULL,
  `unpaid_leave` varchar(225) NOT NULL,
  `lateness` varchar(225) NOT NULL,
  `welfare` varchar(255) NOT NULL,
  `other_deductions` varchar(225) NOT NULL,
  `total_deductions` varchar(225) NOT NULL,
  `total_earnings` varchar(225) NOT NULL,
  `net_salary` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`pay_id`, `pay_date`, `emp_id`, `basic_salary`, `loan_id`, `loan_balance`, `leave_paid`, `overtime_paid`, `sales_commission`, `perdiem`, `other_benefits`, `ssnit`, `paye`, `loan_paid`, `advance_taken`, `unpaid_leave`, `lateness`, `welfare`, `other_deductions`, `total_deductions`, `total_earnings`, `net_salary`) VALUES
(65, '11/05/2018  ', 34, 800, 6, 0, '0  ', '0  ', '0  ', '0  ', '0  ', '0.00  ', '78.08  ', '250  ', '0  ', '0  ', '0  ', '0  ', '0', '328.08', '800', '471.92'),
(66, '11/14/2018', 35, 800, 4, 100, '0', '0', '0', '0', '0', '44.00', '70.38', '50', '0', '0', '0', '0', '0', '164.38', '800', '635.62'),
(67, '11/18/2018', 36, 790, 2, 4000, '0', '0', '0', '0', '0', '43.45', '68.72', '500', '0', '0', '0', '0', '0', '612.17', '790', '177.83'),
(68, '11/07/2018', 34, 800, 3, 300, '0', '0', '0', '0', '0', '0.00', '78.08', '50', '0', '0', '0', '0', '0', '128.08', '800', '671.92');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(100) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position`) VALUES
(1, 'Machinery Technician'),
(2, 'Sales Executive'),
(3, 'Technician'),
(4, 'Driver'),
(5, 'Senior Maintenance Officer'),
(7, 'Technical Supervisor'),
(8, 'Technician Assistant'),
(9, 'Dispatch Rider'),
(10, 'Mechanical Technician'),
(11, 'Mechanical Supervisor'),
(12, 'Mechanical And Fire Safety Engineer'),
(13, 'Sales Coordinator'),
(14, 'Office Assistant I'),
(15, 'Accounts Officer'),
(16, 'Senior Accounts Officer'),
(17, 'Sales Manager'),
(18, 'Customer Service Assistant'),
(19, 'Senior Technician'),
(20, 'Cleaner'),
(21, 'Showroom Manager'),
(22, 'Purchasing Manager'),
(23, 'Engineer'),
(24, 'Senior Supervisor'),
(25, 'HR Exe. Admin Assistant'),
(26, 'Sales Executive Showroom'),
(27, 'Chief Operations Officer'),
(28, 'Chief Executive Officer'),
(29, 'Office Assistant II'),
(30, 'Maintenance Officer Warehouse'),
(31, 'Senior Technician/Driver'),
(32, 'Engineering Consultant'),
(33, 'Warehouse Manager'),
(34, 'Junior Driver'),
(35, 'CCTV Engineer'),
(36, 'Warehouse Officer'),
(37, 'Safety Officer');

-- --------------------------------------------------------

--
-- Table structure for table `reason_codes`
--

CREATE TABLE `reason_codes` (
  `reason_id` int(100) NOT NULL,
  `reason_name` varchar(255) NOT NULL,
  `reason_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reason_codes`
--

INSERT INTO `reason_codes` (`reason_id`, `reason_name`, `reason_code`) VALUES
(1, 'Leave Paid', 'PL'),
(2, 'Leave Unpaid', 'PU ');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `supervisor_id` int(100) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `dep_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`supervisor_id`, `emp_id`, `dep_id`) VALUES
(1, 16, 9),
(2, 21, 20),
(9, 24, 20),
(10, 25, 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `emp_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_role`, `emp_id`) VALUES
(1, 'admin@kuo.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 0),
(2, 'hr@kuo.com', 'adab7b701f23bb82014c8506d3dc784e', 'hr', 0),
(3, 'accounts@kuo.com', '6c28185fb107c134db9a7ae1f170fd73', 'account', 0),
(4, 'user@kuo.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `working_days`
--

CREATE TABLE `working_days` (
  `work_id` int(100) NOT NULL,
  `work_days` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`award_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_id` (`emp_code`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headofdepartments`
--
ALTER TABLE `headofdepartments`
  ADD PRIMARY KEY (`head_dep_id`);

--
-- Indexes for table `leave_form`
--
ALTER TABLE `leave_form`
  ADD PRIMARY KEY (`leave_form_id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `overtimes`
--
ALTER TABLE `overtimes`
  ADD PRIMARY KEY (`overtime_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `reason_codes`
--
ALTER TABLE `reason_codes`
  ADD PRIMARY KEY (`reason_id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`supervisor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `working_days`
--
ALTER TABLE `working_days`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `award_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `comp_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dep_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `leave_form`
--
ALTER TABLE `leave_form`
  MODIFY `leave_form_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `leave_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `loan_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `overtimes`
--
ALTER TABLE `overtimes`
  MODIFY `overtime_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `pay_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `reason_codes`
--
ALTER TABLE `reason_codes`
  MODIFY `reason_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `supervisor_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `working_days`
--
ALTER TABLE `working_days`
  MODIFY `work_id` int(100) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
