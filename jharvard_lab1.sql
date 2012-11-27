-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2012 at 08:22 AM
-- Server version: 5.5.27
-- PHP Version: 5.3.16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jharvard_lab1`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `recipeID` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`recipeID`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`recipeID`, `username`) VALUES
(1, 'no'),
(2, 'what'),
(3, 'ja');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `username` varchar(50) COLLATE ascii_bin NOT NULL,
  `recipeID` int(10) NOT NULL,
  `rating` int(1) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`username`, `recipeID`, `rating`, `id`) VALUES
('user', 1, 5, 1),
('user', 3, 0, 3),
('t', 1, 8, 4),
('t', 3, 1000, 5),
('b', 3, 238945, 6),
('b', 1, 2, 7),
('b', 2, 3, 8),
('this', 1, 10, 9);

-- --------------------------------------------------------

--
-- Table structure for table `recently_viewed`
--

CREATE TABLE IF NOT EXISTS `recently_viewed` (
  `recipeID` int(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) COLLATE ascii_bin NOT NULL,
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `recently_viewed`
--

INSERT INTO `recently_viewed` (`recipeID`, `time`, `username`) VALUES
(1, '2012-11-27 13:19:43', 'what'),
(2, '2012-11-27 13:19:49', 'what');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes` (
  `recipeID` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE ascii_bin NOT NULL,
  `description` text COLLATE ascii_bin NOT NULL,
  `time` int(4) NOT NULL,
  `yield` int(2) NOT NULL,
  `ingredients` text COLLATE ascii_bin NOT NULL,
  `procedure` text COLLATE ascii_bin NOT NULL,
  PRIMARY KEY (`recipeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipeID`, `name`, `description`, `time`, `yield`, `ingredients`, `procedure`) VALUES
(1, 'Omelette', 'Pancake but with eggs.', 5, 2, '- 4 eggs', 'Bake eggs'),
(2, 'Rice', 'Delicious.', 15, 5, '- Lots of rice\r\n- Some salt\r\n- And water', 'Pour water on rice and cook. Scream at rice to become yummy.'),
(3, 'Name', 'Description', 1, 1, 'Ingredients', 'Procedure');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) COLLATE ascii_bin NOT NULL,
  `password` varchar(100) COLLATE ascii_bin NOT NULL,
  `identifier` int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`username`),
  UNIQUE KEY `identifier` (`identifier`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `identifier`) VALUES
('', '', 5),
('a', 'a', 6),
('arjen', 'therealdeal', 2),
('b', '92eb5ffee6ae2fec3ad71c777531578f', 9),
('ohman', 'thisissocool', 3),
('p', '83878c91171338902e0f', 8),
('t', 'ww', 4),
('this', 'f97c5d29941bfb1b2fdab0874906ab82', 10),
('user', 'pass', 1),
('what', 'c8d11180c956e5b5afc3d1970ce2193e', 11);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
