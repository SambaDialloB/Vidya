-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2017 at 10:35 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Vidya`
--

-- --------------------------------------------------------

--
-- Table structure for table `Console`
--

CREATE TABLE IF NOT EXISTS `Console` (
  `consoleId` int(11) NOT NULL AUTO_INCREMENT,
  `consoleName` varchar(16) NOT NULL,
  PRIMARY KEY (`consoleId`),
  KEY `consoleId` (`consoleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Game`
--

CREATE TABLE IF NOT EXISTS `Game` (
  `gameId` int(11) NOT NULL AUTO_INCREMENT,
  `gameName` varchar(32) NOT NULL,
  `maturity` varchar(4) NOT NULL,
  `genre` varchar(16) NOT NULL,
  `releaseDate` int(16) NOT NULL,
  `rating` int(11) NOT NULL,
  `publisherId` int(11) NOT NULL,
  PRIMARY KEY (`gameId`),
  KEY `publisherId` (`publisherId`),
  KEY `publisherId_2` (`publisherId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `game_console`
--

CREATE TABLE IF NOT EXISTS `game_console` (
  `gameId` int(11) NOT NULL,
  `consoleId` int(11) NOT NULL,
  KEY `gameId` (`gameId`),
  KEY `consoleId` (`consoleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Publisher`
--

CREATE TABLE IF NOT EXISTS `Publisher` (
  `publisherId` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(64) NOT NULL,
  `phone` int(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  PRIMARY KEY (`publisherId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Game`
--
ALTER TABLE `Game`
  ADD CONSTRAINT `Game_ibfk_1` FOREIGN KEY (`publisherId`) REFERENCES `Publisher` (`publisherId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `game_console`
--
ALTER TABLE `game_console`
  ADD CONSTRAINT `game_console_ibfk_2` FOREIGN KEY (`consoleId`) REFERENCES `Console` (`consoleId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `game_console_ibfk_1` FOREIGN KEY (`gameId`) REFERENCES `Game` (`gameId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
