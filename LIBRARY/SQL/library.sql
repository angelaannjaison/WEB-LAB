-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 14, 2021 at 08:25 AM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `ACCESS_NO` int NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(100) NOT NULL,
  `AUTHOR` varchar(100) NOT NULL,
  `EDITION` int NOT NULL DEFAULT '1',
  `PUBLICATION` varchar(100) NOT NULL,
  `STATUS` varchar(3) DEFAULT 'IN',
  PRIMARY KEY (`ACCESS_NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

DROP TABLE IF EXISTS `checkin`;
CREATE TABLE IF NOT EXISTS `checkin` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `CHECKOUT_ID` int NOT NULL,
  `APPROVAL_STATUS` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CHECKOUT_ID` (`CHECKOUT_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE IF NOT EXISTS `checkout` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `STUDENT_ID` int NOT NULL,
  `ACCESS_NO` int NOT NULL,
  `DUE` date DEFAULT NULL,
  `RETURN_STATUS` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'N',
  `RETURN_DATE` date DEFAULT NULL,
  `ISSUE_DATE` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `STUDENT_ID` (`STUDENT_ID`),
  KEY `ACCESS_NO` (`ACCESS_NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `USER_ID` int NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `USER_TYPE` varchar(7) NOT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`USER_ID`, `PASSWORD`, `USER_TYPE`) VALUES
(1, 'admin', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `STUDENT_ID` int NOT NULL AUTO_INCREMENT,
  `USER_ID` int NOT NULL,
  `NAME` varchar(40) NOT NULL,
  `COURSE` varchar(100) NOT NULL,
  `YEAR` int NOT NULL,
  `APPROVAL_STATUS` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`STUDENT_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
