-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2018 at 03:52 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ofms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(10) NOT NULL,
  `ausername` varchar(25) NOT NULL,
  `aemail` varchar(30) NOT NULL,
  `amob` int(10) NOT NULL,
  `apassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `ausername`, `aemail`, `amob`, `apassword`) VALUES
(4, 'anya', 'anya1213@gmail.com', 2147483647, 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'dhanya', 'dhanush12@gmail.com', 2147483647, 'd1e3383be26d516002ff71a535b12c5b'),
(10, 'weee', 'anya1312@gmail.com', 2323432, '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eid` int(20) NOT NULL,
  `aid` int(20) NOT NULL,
  `ename` varchar(25) NOT NULL,
  `edate` date NOT NULL,
  `edesc` mediumtext NOT NULL,
  `cname` varchar(50) NOT NULL,
  `caddress` mediumtext NOT NULL,
  `cphone` bigint(11) NOT NULL,
  `cemail` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `cstate` varchar(20) NOT NULL,
  `cpincode` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eid`, `aid`, `ename`, `edate`, `edesc`, `cname`, `caddress`, `cphone`, `cemail`, `city`, `cstate`, `cpincode`) VALUES
(2, 9, 'DSF', '2018-12-28', 'ewteukjza', 'bms colllege', 'dekfqoieqr', 6645675, ' dfshfj@gmail.com', 'mysore', 'karntaka', 232435);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `aname` (`ausername`),
  ADD UNIQUE KEY `aemail` (`aemail`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `event_admin` (`aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_admin` FOREIGN KEY (`aid`) REFERENCES `admin` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
