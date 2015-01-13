-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2015 at 08:23 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kiranastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `Name` varchar(50) NOT NULL,
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Name`, `ID`) VALUES
('grocery', 18),
('confectionary', 19),
('packed food', 20),
('personal care', 21),
('home care', 22),
('beverages', 23),
('farm fresh', 24),
('miscellaneous', 25);

-- --------------------------------------------------------

--
-- Table structure for table `category_subcategory_mapping`
--

CREATE TABLE IF NOT EXISTS `category_subcategory_mapping` (
  `Category` int(255) NOT NULL,
  `SubCategory` int(255) NOT NULL,
  `Mapping_ID` int(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Category`,`SubCategory`),
  UNIQUE KEY `Mapping_ID` (`Mapping_ID`),
  KEY `SubCategory` (`SubCategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `category_subcategory_mapping`
--

INSERT INTO `category_subcategory_mapping` (`Category`, `SubCategory`, `Mapping_ID`) VALUES
(18, 23, 23),
(18, 22, 24),
(18, 21, 25),
(18, 20, 26),
(19, 24, 27),
(19, 25, 28),
(19, 26, 29),
(20, 29, 30),
(20, 28, 31),
(20, 27, 32),
(21, 34, 33),
(21, 33, 34),
(21, 32, 35),
(21, 31, 36),
(21, 30, 37),
(22, 35, 38),
(22, 36, 39),
(22, 37, 40),
(22, 38, 41),
(23, 42, 42),
(23, 41, 43),
(23, 40, 44),
(23, 39, 45),
(24, 44, 46),
(24, 43, 47);

-- --------------------------------------------------------

--
-- Table structure for table `current_offers`
--

CREATE TABLE IF NOT EXISTS `current_offers` (
  `Item_ID` varchar(50) NOT NULL,
  `Discount_Percent` varchar(50) NOT NULL,
  `Off_Rs` varchar(50) NOT NULL,
  `From` date NOT NULL,
  `To` date NOT NULL,
  PRIMARY KEY (`Item_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_offers`
--

INSERT INTO `current_offers` (`Item_ID`, `Discount_Percent`, `Off_Rs`, `From`, `To`) VALUES
('5495cda36939e', '0', '2', '2014-12-21', '2014-12-23'),
('5495cdca3cec6', '0', '5', '2014-12-21', '2014-12-24'),
('5495ce82b4adb', '0', '2', '2014-12-21', '2014-12-24'),
('5495cf64780d8', '0', '3', '2014-12-21', '2014-12-24'),
('5495cf9a80438', '0', '6', '2014-12-21', '2014-12-30'),
('5495cfc6ef269', '0', '5', '2014-12-21', '2014-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `ID` varchar(255) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `ImagePath` varchar(1000) NOT NULL,
  `Price` varchar(50) NOT NULL,
  `Unit` varchar(50) NOT NULL,
  `MinQuantity` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `Description`, `ImagePath`, `Price`, `Unit`, `MinQuantity`) VALUES
('5495cda36939e', 'Amul Pure Cow Ghee', 'amul_pure_cow_ghee.jpg', '395', 'Kg', '0.25'),
('5495cda601a13', 'Amul Pure Ghee', 'amul_pure_ghee.jpg', '395', 'Kg', '0.25'),
('5495cdca3cec6', 'Britannia Cow Ghee ', 'britannia_cow_ghee.jpg', '380', 'Kg', '0.25'),
('5495ce2a03556', 'Eata Vanaspati Dalda', 'Eata Vanaspati Dalda.JPG', '80', 'Kg', '0.5'),
('5495ce2bcc8f6', 'Fortune Plus Soya Oil ', 'fortune_plus_soya_oil.jpg', '112', 'Kg', '0.5'),
('5495ce82b4adb', 'Britannia Bourbon', 'britannia_bourbon_cappuccino.jpg', '10', 'Pack', '1'),
('5495cea83492f', 'Britannia Bourbon Pack Of 5', 'Britannia Bourbon packof5.jpg', '100', 'Pack', '1'),
('5495cf263d795', 'LKS Apple Fuji ', 'apple_fuji.jpg', '155', 'Kg', '0.5'),
('5495cf289f06f', 'LKS Apple Royal Gala', 'apple_royalgala.jpg', '260', 'Kg', '0.5'),
('5495cf64780d8', 'LKS Black Grapes', 'grapes_black.jpg', '99', 'Kg', '0.5'),
('5495cf9a80438', 'LKS Robusta Banana 6 Pc', 'robust-banana-6pc.jpg', '35', 'Pack', '1'),
('5495cfc6ef269', 'LKS Guvava ', 'guvava-fruit.jpg', '85', 'Kg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `item_mapping`
--

CREATE TABLE IF NOT EXISTS `item_mapping` (
  `Mapping_ID` int(255) NOT NULL,
  `Item_ID` varchar(255) NOT NULL,
  PRIMARY KEY (`Mapping_ID`,`Item_ID`),
  KEY `Item_ID` (`Item_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_mapping`
--

INSERT INTO `item_mapping` (`Mapping_ID`, `Item_ID`) VALUES
(26, '5495cda36939e'),
(26, '5495cda601a13'),
(26, '5495cdca3cec6'),
(26, '5495ce2a03556'),
(26, '5495ce2bcc8f6'),
(27, '5495ce82b4adb'),
(27, '5495cea83492f'),
(47, '5495cf263d795'),
(47, '5495cf289f06f'),
(47, '5495cf64780d8'),
(47, '5495cf9a80438'),
(47, '5495cfc6ef269');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE IF NOT EXISTS `sub_category` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`ID`, `Name`) VALUES
(20, 'ghee and oils'),
(21, 'pulses and cereals'),
(22, 'flour'),
(23, 'dry fruits'),
(24, 'biscuit and cookies'),
(25, 'toffee and chocolates'),
(26, 'namkin and wafers'),
(27, 'ready to eat'),
(28, 'ready to cook'),
(29, 'branded food'),
(30, 'baby care'),
(31, 'men care'),
(32, 'women care'),
(33, 'deos and perfumes'),
(34, 'hair care'),
(35, 'laundary care'),
(36, 'toiletries'),
(37, 'pooja item'),
(38, 'shoe care'),
(39, 'coffee and tea'),
(40, 'colddrink'),
(41, 'mineral water'),
(42, 'energy drink'),
(43, 'fruits'),
(44, 'vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `User_ID` varchar(750) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(2000) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`Email`),
  UNIQUE KEY `User_ID` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `Email`, `Password`, `Created_Date`) VALUES
('54abd94e0b777', 'm@m.com', '044fef9e348ad5e33303bd10bf04b8d8', '2015-01-06 12:47:10'),
('54969a83c1117', 'nainy05@gmail.com', 'c0a40739d8c528bfc47ba4b502d28553', '2014-12-21 10:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE IF NOT EXISTS `user_address` (
  `Address_ID` int(50) NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(750) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address` varchar(2000) NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `Pin` varchar(50) NOT NULL,
  `Mobile` varchar(50) NOT NULL,
  PRIMARY KEY (`Address_ID`,`User_ID`),
  KEY `User_ID` (`User_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`Address_ID`, `User_ID`, `Name`, `Address`, `City`, `State`, `Country`, `Pin`, `Mobile`) VALUES
(25, '54969a83c1117', 'Umang POpli', 'B-33 Orchard Palace,Kolar road bhopal', 'Bhopal', 'Madhya Pradesh', 'India', '462042', '09407158747'),
(26, '54969a83c1117', '51 MIG Rishi Nagar Ext 1,Near mangalam apartment', 'B-33 Orchard Palace,Kolar road bhopal', 'ujjain', 'Madhya Pradesh', 'India', '456010', '09407158747'),
(27, '54abd94e0b777', 'M', 'M', 'M', 'M', 'India', '-1', '-1');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE IF NOT EXISTS `user_admin` (
  `User_ID` varchar(750) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(2000) NOT NULL,
  `Created_Date` date NOT NULL,
  `Last_Login` date NOT NULL,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`User_ID`, `Email`, `Password`, `Created_Date`, `Last_Login`) VALUES
('abcd', 'admin@kiranastore.com', 'a', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE IF NOT EXISTS `user_cart` (
  `User_ID` varchar(750) NOT NULL,
  `Item_ID` varchar(50) NOT NULL,
  `Quantity` varchar(50) NOT NULL,
  `Date_Added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`User_ID`,`Item_ID`),
  KEY `Item_ID` (`Item_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`User_ID`, `Item_ID`, `Quantity`, `Date_Added`) VALUES
('54abd94e0b777', '5495ce82b4adb', '3.00', '2015-01-05 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `User_ID` varchar(250) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `Mobile` varchar(100) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE IF NOT EXISTS `user_order` (
  `Order_ID` varchar(200) NOT NULL,
  `User_ID` varchar(200) NOT NULL,
  `Item_ID` varchar(200) NOT NULL,
  `Quantity` varchar(50) NOT NULL,
  `Address_ID` varchar(50) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Delivery_Date` date NOT NULL,
  `Market_Price` varchar(50) NOT NULL,
  `Off_Rs` varchar(50) NOT NULL,
  PRIMARY KEY (`Order_ID`,`User_ID`,`Item_ID`),
  KEY `Item_ID` (`Item_ID`),
  KEY `User_ID` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`Order_ID`, `User_ID`, `Item_ID`, `Quantity`, `Address_ID`, `Date`, `Delivery_Date`, `Market_Price`, `Off_Rs`) VALUES
('54969b22f29d7', '54969a83c1117', '5495cdca3cec6', '0.25', '25', '2014-12-20 18:30:00', '0000-00-00', '380', '5'),
('54969b22f29d7', '54969a83c1117', '5495ce82b4adb', '3.00', '25', '2014-12-20 18:30:00', '0000-00-00', '10', '2'),
('54969b22f29d7', '54969a83c1117', '5495cfc6ef269', '1.00', '25', '2014-12-20 18:30:00', '0000-00-00', '85', '5'),
('54abd972e6751', '54abd94e0b777', '5495cda36939e', '1.75', '27', '2015-01-05 18:30:00', '0000-00-00', '395', '2'),
('54abd972e6751', '54abd94e0b777', '5495cda601a13', '13.75', '27', '2015-01-05 18:30:00', '0000-00-00', '395', '0'),
('54abd972e6751', '54abd94e0b777', '5495cdca3cec6', '1.75', '27', '2015-01-05 18:30:00', '0000-00-00', '380', '5'),
('54abd972e6751', '54abd94e0b777', '5495cf64780d8', '7.00', '27', '2015-01-05 18:30:00', '0000-00-00', '99', '3'),
('54abd972e6751', '54abd94e0b777', '5495cf9a80438', '6.00', '27', '2015-01-05 18:30:00', '0000-00-00', '35', '6'),
('54abd972e6751', '54abd94e0b777', '5495cfc6ef269', '7.00', '27', '2015-01-05 18:30:00', '0000-00-00', '85', '5');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_subcategory_mapping`
--
ALTER TABLE `category_subcategory_mapping`
  ADD CONSTRAINT `category_subcategory_mapping_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `category` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_subcategory_mapping_ibfk_2` FOREIGN KEY (`SubCategory`) REFERENCES `sub_category` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `current_offers`
--
ALTER TABLE `current_offers`
  ADD CONSTRAINT `current_offers_ibfk_3` FOREIGN KEY (`Item_ID`) REFERENCES `items` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_mapping`
--
ALTER TABLE `item_mapping`
  ADD CONSTRAINT `item_mapping_ibfk_1` FOREIGN KEY (`Mapping_ID`) REFERENCES `category_subcategory_mapping` (`Mapping_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_mapping_ibfk_2` FOREIGN KEY (`Item_ID`) REFERENCES `items` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cart_ibfk_2` FOREIGN KEY (`Item_ID`) REFERENCES `items` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_order_ibfk_2` FOREIGN KEY (`Item_ID`) REFERENCES `items` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
