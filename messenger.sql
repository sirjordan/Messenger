-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2014 at 08:56 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `messenger`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `user_name` varchar(100) NOT NULL,
  `contact_user_name` varchar(100) NOT NULL,
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`user_name`, `contact_user_name`, `contact_id`) VALUES
('sirjordan', 'martinski', 1),
('sirjordan', 'vankata', 2);

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE IF NOT EXISTS `invitations` (
  `invitation_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `resever_id` int(11) NOT NULL,
  `is_approved` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`invitation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`invitation_id`, `sender_id`, `resever_id`, `is_approved`) VALUES
(3, 11, 10, 0),
(2, 10, 12, 0),
(4, 13, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE IF NOT EXISTS `msgs` (
  `sender` varchar(100) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_pwd` varchar(200) NOT NULL,
  `user_first_name` varchar(200) NOT NULL,
  `user_surname` varchar(200) NOT NULL,
  `user_photo` text NOT NULL,
  `user_contacts` int(11) NOT NULL DEFAULT '0',
  `is_logged` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pwd`, `user_first_name`, `user_surname`, `user_photo`, `user_contacts`, `is_logged`) VALUES
(11, 'martinski', '8f1966742adf6de379245e6d9ea5b0cea5c64f60', 'ivan', 'ivanov', '', 0, 0),
(12, 'vankata', '657e66f8af291d7270107316c4657a6bb8e82891', 'baiiiiii', 'ivannnnn', '', 0, 0),
(10, 'sirjordan', '3e545b9894d3fd9fe0d46d481444d39a578607ea', 'marto', 'marinov', '', 0, 1),
(13, 'kokimir', 'e837a32d8fbd12a7783da2d62a7f76615f2254db', 'kokimir', 'kokimir', '', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
