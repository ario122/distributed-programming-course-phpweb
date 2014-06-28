-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2013 at 04:32 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dpproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

DROP TABLE IF EXISTS `trains`;
CREATE TABLE IF NOT EXISTS `trains` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `arr` varchar(20) NOT NULL,
  `dep` varchar(20) NOT NULL,
  `arrtime` datetime NOT NULL,
  `deptime` datetime NOT NULL,
  `trainnumber` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `trains`
--

INSERT INTO `trains` (`ID`, `arr`, `dep`, `arrtime`, `deptime`, `trainnumber`) VALUES
(7, 'Milan', 'Turin', '2013-06-12 20:00:00', '2013-06-12 18:00:01', 'ST0012'),
(8, 'Venice', 'Milan', '2013-06-13 01:00:00', '2013-06-12 23:00:00', 'ST0013'),
(9, 'Genoa', 'Turin', '2013-06-12 19:00:00', '2013-06-12 18:00:00', 'ST0013'),
(10, 'Bologna', 'Milan', '2013-06-12 17:00:00', '2013-06-12 15:00:00', 'ST0014'),
(11, 'Firenze', 'Bologna', '2013-06-12 22:00:00', '2013-06-12 17:00:00', 'ST0015');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
CREATE TABLE IF NOT EXISTS `trips` (
  `userID` int(11) NOT NULL,
  `trainID` int(11) NOT NULL,
  `tripID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`tripID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`userID`, `trainID`, `tripID`) VALUES
(5, 7, 1),
(5, 8, 2),
(5, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `changed` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `ID` (`ID`),
  KEY `ID_2` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `password`, `ID`, `username`, `changed`) VALUES
('ADMIN', 'admin@admin.com', 'ADMIN', 1, 'admin', NULL),
('afshin', 'a@a.com', '123', 2, 'afshin', NULL),
('Ario Sadafi', 'ario.sadafi@gmail.co', '123', 5, 'ario122', NULL),
('jashimd', 'j@j.com', '123', 6, 'jj002', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
