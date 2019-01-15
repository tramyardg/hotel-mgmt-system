-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2018 at 08:49 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) UNSIGNED NOT NULL,
  `cid` int(11) UNSIGNED NOT NULL,
  `status` varchar(100) DEFAULT 'pending',
  `notes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `cid`, `status`, `notes`) VALUES
  (12, 10, 'confirmed', NULL),
  (13, 10, 'confirmed', NULL),
  (14, 10, 'confirmed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cid` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `isadmin` int(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `fullname`, `email`, `password`, `phone`,`isadmin`) VALUES
  (10, 'Martha Smith', 'martha@hotmail.com', '$2y$10$L8elMrSO59YGZdGjnQxURuWK7FZUJpL8QgZPT7pKIwCu42PvU8Mm2', '5149991111',0),
  (11, 'admin@gmail.com', 'admin@gmail.com', '$2y$10$nfud5jYwEnMmqv8YgUF3p.wh3EVGAONlRUUiu2TqFiNW.GsU6QKGm', '',1),
  (12, 'admin@admin.com', 'admin@admin.com', '$2y$10$4FJtbVGCIpFnNxcDvSSXUueMESuDDoZvtygT/O4J9UHB1vfdO3Vza', '',1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) UNSIGNED NOT NULL,
  `start` varchar(30) NOT NULL,
  `end` varchar(30) NOT NULL,
  `type` varchar(100) NOT NULL,
  `requirement` varchar(100) DEFAULT 'no preference',
  `adults` int(2) NOT NULL,
  `children` int(2) DEFAULT '0',
  `requests` varchar(500) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hash` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `start`, `end`, `type`, `requirement`, `adults`, `children`, `requests`, `timestamp`, `hash`) VALUES
  (12, '2018-05-09', '2018-05-11', 'double', 'non smoking', 2, 0, '', '2018-04-19 22:04:42', '5ad9127abbdf6'),
  (13, '2018-04-24', '2018-04-25', 'deluxe', 'no preference', 1, 0, '', '2018-04-23 15:45:33', '5addff9dafa97'),
  (14, '2018-04-27', '2018-04-30', 'deluxe', 'no preference', 1, 0, '', '2018-04-24 05:27:13', '5adec03166177');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_id_uindex` (`id`),
  ADD KEY `booking_customer__fk` (`cid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `id_UNIQUE` (`cid`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_customer__fk` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_booking__fk` FOREIGN KEY (`id`) REFERENCES `booking` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
