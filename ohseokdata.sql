-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2019 at 05:13 AM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id4413815_ohseokdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `CustID` int(11) NOT NULL,
  `CustName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `CustContactLastName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `CustContactFirstName` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`CustID`, `CustName`, `CustContactLastName`, `CustContactFirstName`) VALUES
(111, 'University of Mississippi', 'Mike', 'Bianco'),
(222, 'Sonic Drive-In', 'Dana', 'Dalson');

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

CREATE TABLE `employee_list` (
  `EmpID` int(8) NOT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `birth` date NOT NULL,
  `Password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `EmpActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee_list`
--

INSERT INTO `employee_list` (`EmpID`, `last_name`, `first_name`, `email`, `phone`, `birth`, `Password`, `EmpActive`) VALUES
(1, 'Stad', 'Sallyyyy', 'SSal@gmail.com', '519-625-6125', '1992-03-23', '', 0),
(2, 'Petrick', 'Cold', 'pcold@gmail.com', '687-512-5234', '1989-08-17', '', 1),
(3, 'Jordon', 'Cindy', 'JC@gmail.com', '154-721-9315', '1989-05-01', 'bfd59291e825b5f2bbf1eb76569f8fe7', 1),
(9, 'Dow', 'John', 'jd@gmail.com', '784513545', '1968-08-13', 'e99a18c428cb38d5f260853678922e03', 1),
(10, 'Kee', 'jamson', 'jk@gmail.com', '751357945', '1987-05-14', '200820e3227815ed1756a6b531e7e0d2', 0),
(15, 'Falmer', 'Max', 'mf@gmail.com', '6684598715', '1980-04-17', '1adbb3178591fd5bb0c248518f39bf6d', 1),
(18, 'Timber', 'Kane', 'kt@gmail.com', '4462587153', '1976-06-01', 'cffbad68bb97a6c3f943538f119c992c', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Jobs`
--

CREATE TABLE `Jobs` (
  `JobID` int(11) NOT NULL,
  `JobName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `JobCustomerID` int(11) NOT NULL,
  `JobStartDate` date NOT NULL,
  `JobEndDate` date NOT NULL,
  `JobComplete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Jobs`
--

INSERT INTO `Jobs` (`JobID`, `JobName`, `JobCustomerID`, `JobStartDate`, `JobEndDate`, `JobComplete`) VALUES
(1, 'UM Baseball Concession Counter', 111, '2018-01-09', '2018-01-29', 1),
(2, 'Sonic-Dive-in Workbench', 222, '2018-01-29', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Labor_hours`
--

CREATE TABLE `Labor_hours` (
  `Date` date NOT NULL,
  `First_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Hours` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Labor_hours`
--

INSERT INTO `Labor_hours` (`Date`, `First_name`, `Email`, `Hours`) VALUES
('2018-04-29', 'John', 'jd@gmail.com', 4),
('2018-04-29', 'Sally', 'SSal@gmail.com', 3),
('2018-04-29', 'Cindy', 'JC@gmail.com', 4),
('2018-04-29', 'Cold', 'pcold@gmail.com', 6),
('2018-04-29', 'Jhon', 'jd@gmail.com', 2),
('2018-04-27', 'John', 'jd@gmail.com', 3),
('2018-04-27', 'Cindy', 'JC@gmail.com', 5),
('2018-04-27', 'Cold', 'pcold@gmail.com', 4),
('2018-04-27', 'Sally', 'Ssal@gmail.com', 4),
('2018-04-27', 'jamson', 'jk@gmail.com', 5),
('2018-04-29', 'Max', 'mf@gmail.com', 5),
('2018-04-29', 'Max', 'mf@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`CustID`);

--
-- Indexes for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD PRIMARY KEY (`EmpID`);

--
-- Indexes for table `Jobs`
--
ALTER TABLE `Jobs`
  ADD PRIMARY KEY (`JobID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `CustID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `employee_list`
--
ALTER TABLE `employee_list`
  MODIFY `EmpID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Jobs`
--
ALTER TABLE `Jobs`
  MODIFY `JobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
