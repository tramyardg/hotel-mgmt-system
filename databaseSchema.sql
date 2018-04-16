-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2018 at 11:05 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3
--
-- Database: `hotel`
--
CREATE DATABASE IF NOT EXISTS `hotel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hotel`;

-- --------------------------------------------------------

--
-- Database: `hotel`
--

-- --------------------------------------------------------
DROP TABLE IF EXISTS `booking`;
DROP TABLE IF EXISTS `customer`;
DROP TABLE IF EXISTS `reservation`;
--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `status` varchar(100) DEFAULT 'pending',
  `notes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `cid`, `rid`, `status`, `notes`) VALUES
  (1, 3, 2, 'confirmed', NULL),
  (2, 1, 3, 'pending', NULL),
  (3, 1, 4, 'pending', NULL),
  (4, 1, 5, 'confirmed', NULL),
  (5, 2, 6, 'pending', NULL),
  (6, 2, 7, 'cancelled', NULL),
  (7, 3, 8, 'pending', NULL),
  (8, 3, 9, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cid` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `fullname`, `email`, `password`, `phone`) VALUES
  (1, 'Leo Sudarma', 'leo@gmail.com', '$2y$10$3z2VJ3MrcgvzaD1Y7VgU8ut61BlyYQ9fdj2NzeLc4G1qqS5eNk2ru', '5148889999'),
  (2, 'Joe Smith', 'joe@gmail.com', '$2y$10$P4RLUqnXF94dEJhdiLMrauhKO8uD6wHoEN6f/fju7ZVddIemcYT6S', '4382221111'),
  (3, 'Kevin', 'kevs@me.com', '$2y$10$8TfZcj3XctGaCzRzi4O72emL0aGpN9GbboVuZm2yOPG53qhAC22jy', ''),
  (4, 'admin', 'admin@admin.com', '$2y$10$O8IXqRQcWLj2l3lDNhcRGOOu7puXTKSYKjjAX2yZcOzzyjkF4jePu', '');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `start` varchar(30) NOT NULL,
  `end` varchar(30) NOT NULL,
  `type` varchar(100) NOT NULL,
  `requirement` varchar(100) DEFAULT 'no preference',
  `adults` int(2) NOT NULL,
  `children` int(2) DEFAULT '0',
  `requests` varchar(500) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hash` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `cid`, `start`, `end`, `type`, `requirement`, `adults`, `children`, `requests`, `timestamp`, `hash`) VALUES
  (2, 3, '2018-04-16', '2018-04-21', 'deluxe', 'non smoking', 2, 1, '', '2018-04-16 12:44:50', '5ad49ac2daaf1'),
  (3, 1, '2018-04-22', '2018-04-24', 'double', 'non smoking', 2, 1, '', '2018-04-16 14:41:38', '5ad4b6222091a'),
  (4, 1, '2018-04-17', '2018-04-18', 'single', 'non smoking', 1, 1, '', '2018-04-16 14:42:12', '5ad4b644017b8'),
  (5, 1, '2018-04-19', '2018-04-22', 'deluxe', 'smoking', 2, 0, '', '2018-04-16 14:42:32', '5ad4b65830314'),
  (6, 2, '2018-04-17', '2018-04-20', 'single', 'no preference', 1, 0, '', '2018-04-16 14:44:10', '5ad4b6ba7be4d'),
  (7, 2, '2018-05-01', '2018-05-09', 'single', 'non smoking', 1, 0, '', '2018-04-16 14:44:39', '5ad4b6d781da1'),
  (8, 3, '2018-05-02', '2018-05-04', 'single', 'non smoking', 3, 0, '', '2018-04-16 14:45:34', '5ad4b70eb4e1a'),
  (9, 3, '2018-05-21', '2018-05-24', 'double', 'non smoking', 2, 1, '', '2018-04-16 14:45:57', '5ad4b72595694');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;