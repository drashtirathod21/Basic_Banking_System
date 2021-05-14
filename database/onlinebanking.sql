-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2021 at 12:57 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onlinebanking`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `userid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `acc_number` int(20) NOT NULL,
  `ifsc` varchar(30) NOT NULL,
  `balance` int(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`userid`, `name`, `email`, `acc_number`, `ifsc`, `balance`) VALUES
(759274, 'Sumit Parmar', 'sumit@gmail.com', 64829472, 'HgU273', 31000),
(859183, 'Mahima Rathod', 'mahima@gmail.com', 27829173, 'njBh047', 19500),
(547282, 'Drashti Rathod', 'drashti@gmail.com', 28462819, 'barbo37280', 39000),
(352739, 'Riya Patel', 'riya@gmail.com', 75827194, 'ifhs27381', 9000),
(947204, 'Sneha Shah', 'sneha@gmail.com', 74829473, 'WJgd73', 11000),
(893628, 'Kevin Rathod', 'kevin@gmail.com', 94284929, 'BarB07', 33500),
(194729, 'Mittal Rathod', 'mittal@gmail.com', 95027564, 'sbi042', 27500),
(492719, 'Nilesh Shah', 'nilesh@gmail.com', 39274047, 'sbi928', 16000),
(682916, 'Divya Rathod', 'divya@gmail.com', 91848203, 'barb02', 30200),
(149038, 'Maulik Rathod', 'maulik@gmail.com', 28471938, 'canra72', 16700);

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE IF NOT EXISTS `transfer` (
  `s_name` varchar(50) NOT NULL,
  `s_accno` int(30) NOT NULL,
  `r_name` varchar(50) NOT NULL,
  `r_accno` int(30) NOT NULL,
  `amount` int(30) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`s_name`, `s_accno`, `r_name`, `r_accno`, `amount`, `date_time`) VALUES
('Drashti Rathod', 28462819, 'Sumit Parmar', 64829472, 1000, '2021-05-14 18:06:02'),
('Mahima Rathod', 27829173, 'Drashti Rathod', 28462819, 1000, '2021-05-14 16:39:00'),
('Sneha Shah', 74829473, 'Kevin Rathod', 94284929, 500, '2021-05-13 20:51:26'),
('Mahima Rathod', 27829173, 'Nilesh Shah', 39274047, 2500, '2021-05-13 20:50:04'),
('Mittal Rathod', 95027564, 'Divya Rathod', 91848203, 1500, '2021-05-13 20:49:11'),
('Nilesh Shah', 39274047, 'Divya Rathod', 91848203, 2500, '2021-05-13 20:47:46'),
('Drashti Rathod', 28462819, 'Kevin Rathod', 94284929, 2000, '2021-05-13 20:47:07'),
('Kevin Rathod', 94284929, 'Sneha Shah', 74829473, 500, '2021-05-13 20:46:33'),
('Riya Patel', 75827194, 'Sneha Shah', 74829473, 1000, '2021-05-13 20:45:58');
