-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2020 at 10:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssranz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `name`, `email`, `contact`, `username`, `password`) VALUES
(8, 'Lorenzo', 'lorenzolowrince@gmail.com', '014-6793125', 'lorenzo', '97fc6b4ca33ff77af52b0df424da93c7'),
(9, 'Mosses', 'mossesPA@gmail.com', '+61 413 388 131', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tblarchived`
--

CREATE TABLE `tblarchived` (
  `id` int(11) NOT NULL,
  `profilePic` blob DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `ic` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `joinedSince` date NOT NULL,
  `maritalStatus` varchar(100) NOT NULL,
  `fbLink` varchar(200) DEFAULT NULL,
  `statusVISA` varchar(100) NOT NULL,
  `regNum` varchar(200) NOT NULL,
  `statusInvolvement` varchar(100) NOT NULL,
  `homelandAdd` varchar(200) DEFAULT NULL,
  `currentAdd` varchar(200) NOT NULL,
  `homelandPostcode` varchar(200) DEFAULT NULL,
  `currentPostcode` varchar(200) NOT NULL,
  `homelandCity` varchar(200) DEFAULT NULL,
  `currentCity` varchar(200) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `emergencyNumber` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbldiary`
--

CREATE TABLE `tbldiary` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `label` varchar(200) DEFAULT NULL,
  `submitDate` date NOT NULL,
  `updateDate` date DEFAULT NULL,
  `note` text NOT NULL,
  `document` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbllastknownbackup`
--

CREATE TABLE `tbllastknownbackup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbllastknownrestore`
--

CREATE TABLE `tbllastknownrestore` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblregister`
--

CREATE TABLE `tblregister` (
  `id` int(11) NOT NULL,
  `profilePic` blob DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `ic` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `joinedSince` date DEFAULT NULL,
  `maritalStatus` varchar(100) DEFAULT NULL,
  `fbLink` varchar(200) DEFAULT NULL,
  `statusVISA` varchar(100) DEFAULT NULL,
  `regNum` varchar(200) DEFAULT NULL,
  `statusInvolvement` varchar(100) DEFAULT NULL,
  `homelandAdd` varchar(200) DEFAULT NULL,
  `currentAdd` varchar(200) DEFAULT NULL,
  `homelandPostcode` varchar(200) DEFAULT NULL,
  `currentPostcode` varchar(200) DEFAULT NULL,
  `homelandCity` varchar(200) DEFAULT NULL,
  `currentCity` varchar(200) DEFAULT NULL,
  `phoneNumber` varchar(100) DEFAULT NULL,
  `emergencyNumber` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblarchived`
--
ALTER TABLE `tblarchived`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldiary`
--
ALTER TABLE `tbldiary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllastknownbackup`
--
ALTER TABLE `tbllastknownbackup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllastknownrestore`
--
ALTER TABLE `tbllastknownrestore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblregister`
--
ALTER TABLE `tblregister`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblarchived`
--
ALTER TABLE `tblarchived`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbldiary`
--
ALTER TABLE `tbldiary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbllastknownbackup`
--
ALTER TABLE `tbllastknownbackup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbllastknownrestore`
--
ALTER TABLE `tbllastknownrestore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblregister`
--
ALTER TABLE `tblregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
