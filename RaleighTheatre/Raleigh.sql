-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2015 at 09:31 AM
-- Server version: 5.1.73
-- PHP Version: 5.5.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Raleigh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
`bookingid` int(12) NOT NULL,
  `bookingdate` date NOT NULL,
  `customerfk` int(6) NOT NULL,
  `performancefk` int(5) NOT NULL,
  `seatfk` varchar(2) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingid`, `bookingdate`, `customerfk`, `performancefk`, `seatfk`) VALUES
(1, '2015-03-22', 1, 18, 'A1'),
(2, '2015-03-22', 2, 42, 'A1'),
(3, '2015-03-22', 2, 13, 'B6'),
(4, '2015-03-22', 3, 35, 'C4'),
(5, '2015-03-22', 4, 68, 'B3');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`customerid` int(6) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `town` varchar(30) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `phonenumber` varchar(13) DEFAULT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerid`, `firstname`, `lastname`, `street`, `town`, `postcode`, `phonenumber`, `email`) VALUES
(1, 'Maria', 'Diaz', 'Kignston Av', 'Kiingston', '11111A', '77777777777', 'maria@kingston.ac.uk'),
(2, 'Diego', 'Corrales', 'London Av', 'Kingston', '11111B', '88888888888', 'diego@kingston.ac.uk'),
(3, 'Azaher', 'Sarwar', 'Old Road Av', 'Kingston', '33333A', '99999999999', 'azaher@gmail.com'),
(4, 'Maria', 'Diaz', 'Church Av', 'Kingston', '55555C', '00000000001', 'maria@kingston.ac.uk');

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

CREATE TABLE IF NOT EXISTS `performance` (
`performanceid` int(5) NOT NULL,
  `performancedate` date NOT NULL,
  `productionfk` int(5) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=324 ;

--
-- Dumping data for table `performance`
--

INSERT INTO `performance` (`performanceid`, `performancedate`, `productionfk`) VALUES
(9, '2015-03-02', 1),
(8, '2015-02-11', 1),
(3, '2015-03-28', 1),
(7, '2015-03-27', 1),
(5, '2015-03-30', 2),
(6, '2015-03-31', 6),
(2, '2015-03-27', 1),
(11, '2015-05-08', 1),
(12, '2015-03-25', 2),
(13, '2015-04-29', 3),
(14, '2015-04-09', 4),
(15, '2015-03-24', 4),
(16, '2015-04-19', 5),
(17, '2015-03-01', 5),
(18, '2015-03-20', 6),
(19, '2015-03-26', 6),
(20, '2015-04-09', 6),
(21, '2015-03-24', 7),
(22, '2015-03-20', 7),
(23, '2015-03-27', 7),
(24, '2015-04-16', 7),
(29, '2015-03-31', 8),
(30, '2015-03-02', 8),
(31, '2015-04-17', 8),
(32, '2015-03-25', 9),
(35, '2015-04-16', 9),
(36, '2015-03-08', 10),
(37, '2015-03-31', 10),
(323, '2015-04-03', 10),
(40, '2015-05-22', 10),
(41, '2015-05-16', 11),
(42, '2015-05-16', 11),
(43, '2015-06-10', 13),
(44, '2015-03-06', 13),
(45, '2015-07-10', 14),
(46, '2015-09-18', 14),
(47, '2015-03-01', 14),
(50, '2015-09-10', 15),
(51, '2015-03-21', 15),
(53, '2015-08-06', 15),
(60, '2015-10-23', 15),
(61, '2015-03-19', 16),
(62, '2015-12-09', 16),
(63, '2015-05-25', 16),
(64, '2015-12-15', 17),
(65, '2016-01-14', 17),
(66, '2015-05-15', 18),
(67, '2015-03-23', 18),
(68, '2015-07-09', 20),
(69, '2015-06-06', 20),
(70, '2015-03-23', 20),
(71, '2015-09-22', 21),
(72, '2015-08-15', 21);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE IF NOT EXISTS `production` (
`productionid` int(5) NOT NULL,
  `productiontypefk` varchar(20) NOT NULL,
  `productionname` varchar(50) NOT NULL,
  `productiondate` date NOT NULL,
  `productionprice` float NOT NULL,
  `productionimage` varchar(200) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12131 ;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`productionid`, `productiontypefk`, `productionname`, `productiondate`, `productionprice`, `productionimage`) VALUES
(3, 'Classical Music', 'Vivaldi the four seasons - Chamber Orchestra', '2015-03-18', 60.8, 'https://m1.behance.net/rendition/modules/27863541/disp/29b57a61a42ce60f46da339c1e0cfcdc.jpg'),
(20, 'Comedy', 'Mrs. Brown''s Boys', '2015-03-16', 30, 'https://lh4.ggpht.com/RxdfDk9w85QGAIZQzoCFqQxUnzgZCKiP6xNNxhwj_2bxMnf0G7gR9ifZVJXIyK-FtITd=w300'),
(17, 'Comedy', 'Ross Noble', '2015-03-01', 10, 'http://www.thelowry.com/Images/Brochure45/ross-noble-_main.jpg'),
(18, 'Comedy', 'Lee Nelson', '0000-00-00', 15, 'http://www.femalefirst.co.uk/image-library/partners/bang/square/500/l/lee-nelson-2c2f0a582ea8e732bffc1b00d8e4fef64412ab8e.jpg'),
(5, 'Drama', 'American Buffalo', '2015-03-19', 45.5, 'http://s8.postimg.org/duzf1lkfp/AM_BUFF_SQUARE_front_copy.jpg'),
(6, 'Drama', 'Closer', '0000-00-00', 39, 'http://www.jayrecords.com/base/covers/CloserThanEverCover%20250.jpg'),
(4, 'Classical Music', 'Mozart in concert - Royal Philharmonic Orchestra', '2015-03-01', 55.4, 'http://fc02.deviantart.net/fs70/i/2010/210/8/f/Mozart_CD_Cover_by_Dicloniusx.jpg'),
(14, 'Ballet', 'The Nutcracker ', '2015-03-21', 36, 'http://cps-static.rovicorp.com/3/JPG_400/MI0002/028/MI0002028260.jpg'),
(13, 'Ballet', 'The Swan Lake', '0000-00-00', 50.7, 'http://ecx.images-amazon.com/images/I/51%2Bu2HLXxmL._SY300_.jpg'),
(9, 'Musical', 'Billy Elliot', '0000-00-00', 61.3, 'http://radiotimesdvds.co.uk/16252-large/billy-elliot-the-original-cast-recording.jpg'),
(10, 'Musical', 'The Lion King', '0000-00-00', 45, 'http://s23.postimg.org/p6mz1hmbv/image.jpg'),
(12, 'Drama', 'Behind the beautiful forever', '2015-03-03', 37.6, 'http://2.bp.blogspot.com/--cB-6qPXmdo/Tzm6zylJ_II/AAAAAAAABOc/MvT5phqS9tk/s1600/behind-the-beautiful-forevers.jpg'),
(7, 'Drama', 'The railway children', '0000-00-00', 25, 'http://s21.postimg.org/6dfesow7b/ndice.jpg'),
(16, 'Ballet', 'Cinderella', '2015-03-09', 30, 'http://s.cdon.com/media-dynamic/images/product/00/07/45/73/90/3/a28782d3-572f-4139-b9f9-5d522b098332.jpg'),
(11, 'Musical', 'Wicked', '0000-00-00', 38.2, 'http://s8.postimg.org/kndq3wq7p/image.jpg'),
(15, 'Ballet', 'Romeo and Juliet', '2015-03-03', 50.3, 'https://www.cballet.org/sites/www.cballet.org/files/imagecache/Medium/page/images/07/11/2012%20-%2009%3A51/1213_R%26J_5x5_IST_web.jpg'),
(8, 'Musical', 'Mamma Mia', '0000-00-00', 58.9, 'http://bigpondmusic.com/images/AlbumCoverArt/312/XXL/Mamma-Mia-The-Movie-Soundtrack3.jpg'),
(2, 'Classical Music', 'I just updated this', '2015-03-09', 40, 'http://www.cityoflondonsinfonia.co.uk/images/cache/%7BD8E06DCB-21C4-472C-8292-5C3FA4B49598%7D/main.jpg'),
(21, 'Comedy', 'Alan Carr', '2015-03-09', 27, 'http://hammersmithapollo.s3.amazonaws.com/img/Alan-Carr-hero-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE IF NOT EXISTS `seat` (
  `seatid` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seatid`) VALUES
('A1'),
('A2'),
('A3'),
('A4'),
('A5'),
('A6'),
('B1'),
('B2'),
('B3'),
('B4'),
('B5'),
('B6'),
('C1'),
('C2'),
('C3'),
('C4'),
('C5'),
('C6');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
`ticketid` int(5) NOT NULL,
  `performancefk` int(5) NOT NULL,
  `seatfk` varchar(2) NOT NULL,
  `bookingfk` int(12) NOT NULL,
  `ticketreference` varchar(15) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketid`, `performancefk`, `seatfk`, `bookingfk`, `ticketreference`) VALUES
(1, 18, 'A1', 1, '18A1'),
(2, 42, 'A1', 2, '42A1'),
(3, 13, 'B6', 3, '13B6'),
(4, 35, 'C4', 4, '35C4'),
(5, 68, 'B3', 5, '68B3');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `productiontypeid` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`productiontypeid`) VALUES
('Ballet'),
('Classical Music'),
('Comedy'),
('Drama'),
('Musical');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
 ADD PRIMARY KEY (`bookingid`), ADD KEY `customerfk` (`customerfk`), ADD KEY `performancefk` (`performancefk`), ADD KEY `seatfk` (`seatfk`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `performance`
--
ALTER TABLE `performance`
 ADD PRIMARY KEY (`performanceid`), ADD KEY `productionfk` (`productionfk`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
 ADD PRIMARY KEY (`productionid`), ADD KEY `productiontypefk` (`productiontypefk`), ADD FULLTEXT KEY `productionname` (`productionname`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
 ADD PRIMARY KEY (`seatid`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
 ADD PRIMARY KEY (`ticketid`), ADD KEY `performancefk` (`performancefk`), ADD KEY `seatfk` (`seatfk`), ADD KEY `bookingfk` (`bookingfk`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
 ADD PRIMARY KEY (`productiontypeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
MODIFY `bookingid` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `customerid` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `performance`
--
ALTER TABLE `performance`
MODIFY `performanceid` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=324;
--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
MODIFY `productionid` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12131;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
MODIFY `ticketid` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
