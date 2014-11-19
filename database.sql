-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2014 at 09:31 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iluvproperty`
--
DROP DATABASE `iluvproperty`;
CREATE DATABASE IF NOT EXISTS `iluvproperty` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `iluvproperty`;

-- --------------------------------------------------------

--
-- Table structure for table `mo_apartmenttype_master`
--

DROP TABLE IF EXISTS `mo_apartmenttype_master`;
CREATE TABLE IF NOT EXISTS `mo_apartmenttype_master` (
`sn` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_iluv_sessions`
--

DROP TABLE IF EXISTS `mo_iluv_sessions`;
CREATE TABLE IF NOT EXISTS `mo_iluv_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mo_iluv_sessions`
--

INSERT INTO `mo_iluv_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('c71c59c4d7f6b4adf11f6d4810a2a778', '66.249.84.128', 'Mozilla/5.0 (Windows NT 6.1; rv:6.0) Gecko/20110814 Firefox/6.0 Google favicon', 1415559724, ''),
('e59cbe8b94efe7e349d661632ed194f0', '203.215.143.251', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415568089, 'a:3:{s:14:"logged_website";i:1415561449;s:22:"logged_website_user_id";s:1:"2";s:25:"logged_website_user_email";s:26:"sunmeet.singh247@gmail.com";}');

-- --------------------------------------------------------

--
-- Table structure for table `mo_regionlist`
--

DROP TABLE IF EXISTS `mo_regionlist`;
CREATE TABLE IF NOT EXISTS `mo_regionlist` (
`sn` int(11) NOT NULL,
  `regionName` varchar(50) NOT NULL,
  `regionTypeSN` int(11) NOT NULL,
  `regionListSN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_regiontype_master`
--

DROP TABLE IF EXISTS `mo_regiontype_master`;
CREATE TABLE IF NOT EXISTS `mo_regiontype_master` (
`sn` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_userenquiry`
--

DROP TABLE IF EXISTS `mo_userenquiry`;
CREATE TABLE IF NOT EXISTS `mo_userenquiry` (
`sn` int(11) NOT NULL,
  `userAgentSN` int(11) NOT NULL,
  `userListingSN` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_userlistingimages`
--

DROP TABLE IF EXISTS `mo_userlistingimages`;
CREATE TABLE IF NOT EXISTS `mo_userlistingimages` (
`sn` int(11) NOT NULL,
  `userListingSN` int(11) NOT NULL,
  `imageName` varchar(50) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_userlistingopentimings`
--

DROP TABLE IF EXISTS `mo_userlistingopentimings`;
CREATE TABLE IF NOT EXISTS `mo_userlistingopentimings` (
`sn` int(11) NOT NULL,
  `userListingSN` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `date` date NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_userlistings`
--

DROP TABLE IF EXISTS `mo_userlistings`;
CREATE TABLE IF NOT EXISTS `mo_userlistings` (
`sn` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `suburbSN` int(11) NOT NULL,
  `citySN` int(11) NOT NULL,
  `countrySN` int(11) NOT NULL,
  `typeSN` int(11) NOT NULL,
  `statusSN` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `beds` int(11) NOT NULL,
  `bath` int(11) NOT NULL,
  `carpark` int(11) NOT NULL,
  `sqFt` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `features` text NOT NULL,
  `customId` int(11) NOT NULL,
  `userAgentSN` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_userlistingvideos`
--

DROP TABLE IF EXISTS `mo_userlistingvideos`;
CREATE TABLE IF NOT EXISTS `mo_userlistingvideos` (
`sn` int(11) NOT NULL,
  `userListingSN` int(11) NOT NULL,
  `videoURL` varchar(100) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_usertype_master`
--

DROP TABLE IF EXISTS `mo_usertype_master`;
CREATE TABLE IF NOT EXISTS `mo_usertype_master` (
`sn` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_userwishlist`
--

DROP TABLE IF EXISTS `mo_userwishlist`;
CREATE TABLE IF NOT EXISTS `mo_userwishlist` (
`sn` int(11) NOT NULL,
  `userAgentSN` int(11) NOT NULL,
  `userListingSN` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_websiteowners`
--

DROP TABLE IF EXISTS `mo_websiteowners`;
CREATE TABLE IF NOT EXISTS `mo_websiteowners` (
`sn` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `countrySN` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_websiteplans`
--

DROP TABLE IF EXISTS `mo_websiteplans`;
CREATE TABLE IF NOT EXISTS `mo_websiteplans` (
`sn` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `listingIncluded` int(11) NOT NULL,
  `creditsIncluded` int(11) NOT NULL,
  `emailEnabled` enum('Y','N') NOT NULL DEFAULT 'Y',
  `smsEnabled` enum('Y','N') NOT NULL DEFAULT 'N',
  `appEnabled` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mo_websiteuseragents`
--

DROP TABLE IF EXISTS `mo_websiteuseragents`;
CREATE TABLE IF NOT EXISTS `mo_websiteuseragents` (
`sn` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `agencyName` varchar(100) NOT NULL,
  `licensedNo` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `mobileNo` varchar(20) NOT NULL,
  `phoneNo` varchar(20) NOT NULL,
  `imageName` varchar(100) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `dateCreated` datetime NOT NULL,
  `dateModifiied` datetime NOT NULL,
  `websiteUserSN` int(11) NOT NULL,
  `userTypeSN` int(11) NOT NULL,
  `countrySN` int(11) NOT NULL,
  `emailApproval` enum('Y','N') NOT NULL DEFAULT 'N',
  `activationNo` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mo_websiteuseragents`
--

INSERT INTO `mo_websiteuseragents` (`sn`, `firstName`, `lastName`, `email`, `agencyName`, `licensedNo`, `password`, `mobileNo`, `phoneNo`, `imageName`, `status`, `dateCreated`, `dateModifiied`, `websiteUserSN`, `userTypeSN`, `countrySN`, `emailApproval`, `activationNo`) VALUES
(1, 'Sunmeet', 'Singh', 'test@test.com', '', '', '098f6bcd4621d373cade4e832627b4f6', '', '', '', 'Y', '2014-11-04 20:36:24', '0000-00-00 00:00:00', 0, 0, 0, 'N', '00kCB8GgZy5kHRiY'),
(2, 'Sunmeet', 'Singh', 'sunmeet.singh247@gmail.com', '', '', 'ea5111d42a1597b838de276570513905', '', '', '', 'Y', '2014-11-04 20:44:03', '0000-00-00 00:00:00', 0, 0, 0, 'Y', 'ZEhj9pFU7Hf3umEZ'),
(3, 'farooq', 'usman', 'farooqusman@gmail.com', '', '', '373e57a6d14f8ca9f66d84820650f38d', '', '', '', 'Y', '2014-11-04 20:58:39', '0000-00-00 00:00:00', 0, 0, 0, 'Y', 'kT8vlAbHjkf6QbwE'),
(4, 'tet', 'test', 'test1@test.com', '', '', '098f6bcd4621d373cade4e832627b4f6', '', '', 'logo.png', 'Y', '2014-11-08 23:27:01', '0000-00-00 00:00:00', 0, 0, 0, 'N', 'tN862JCV8ITw1Rz2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mo_apartmenttype_master`
--
ALTER TABLE `mo_apartmenttype_master`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_iluv_sessions`
--
ALTER TABLE `mo_iluv_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `mo_regionlist`
--
ALTER TABLE `mo_regionlist`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_regiontype_master`
--
ALTER TABLE `mo_regiontype_master`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_userenquiry`
--
ALTER TABLE `mo_userenquiry`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_userlistingimages`
--
ALTER TABLE `mo_userlistingimages`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_userlistingopentimings`
--
ALTER TABLE `mo_userlistingopentimings`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_userlistings`
--
ALTER TABLE `mo_userlistings`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_userlistingvideos`
--
ALTER TABLE `mo_userlistingvideos`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_usertype_master`
--
ALTER TABLE `mo_usertype_master`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_userwishlist`
--
ALTER TABLE `mo_userwishlist`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_websiteowners`
--
ALTER TABLE `mo_websiteowners`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_websiteplans`
--
ALTER TABLE `mo_websiteplans`
 ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `mo_websiteuseragents`
--
ALTER TABLE `mo_websiteuseragents`
 ADD PRIMARY KEY (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mo_apartmenttype_master`
--
ALTER TABLE `mo_apartmenttype_master`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_regionlist`
--
ALTER TABLE `mo_regionlist`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_regiontype_master`
--
ALTER TABLE `mo_regiontype_master`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_userenquiry`
--
ALTER TABLE `mo_userenquiry`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_userlistingimages`
--
ALTER TABLE `mo_userlistingimages`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_userlistingopentimings`
--
ALTER TABLE `mo_userlistingopentimings`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_userlistings`
--
ALTER TABLE `mo_userlistings`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_userlistingvideos`
--
ALTER TABLE `mo_userlistingvideos`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_usertype_master`
--
ALTER TABLE `mo_usertype_master`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_userwishlist`
--
ALTER TABLE `mo_userwishlist`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_websiteowners`
--
ALTER TABLE `mo_websiteowners`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_websiteplans`
--
ALTER TABLE `mo_websiteplans`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mo_websiteuseragents`
--
ALTER TABLE `mo_websiteuseragents`
MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;