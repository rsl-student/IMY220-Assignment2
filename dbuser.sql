-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 28, 2020 at 01:27 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbuser`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbgallery`
--

CREATE TABLE `tbgallery` (
  `image_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `filename` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbgallery`
--

INSERT INTO `tbgallery` (`image_id`, `user_id`, `filename`) VALUES
(1, 3, '1_3_bk6uw3y9jjx41.png'),
(2, 3, '2_3_4tn03p8q25x41.png'),
(3, 3, '3_3_r1xb7o8cuuw41.jpg'),
(4, 3, '4_3_destiny-2-pixel-art-hunter-minimal.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbusers`
--

CREATE TABLE `tbusers` (
  `user_id` int(11) NOT NULL,
  `name` char(100) NOT NULL,
  `surname` char(100) NOT NULL,
  `password` char(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbusers`
--

INSERT INTO `tbusers` (`user_id`, `name`, `surname`, `password`, `email`, `birthday`) VALUES
(1, 'Ronald', 'Looi', '', 'ronald.chinaboi.looi@gmail.com', '1994-11-08'),
(2, 'Jasper', 'Dolty', '', 'arlooi@mweb.co.za', '1994-10-05'),
(3, 'Orga', 'Istuka', '54321edcba', 'bravemaxx@gmail.com', '1995-05-25'),
(4, 'Ronald', 'Looi', 'r1o2n3a4l5d6', 'ronald.chinaboi.looi@gmail.com', '1994-11-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbgallery`
--
ALTER TABLE `tbgallery`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `tbusers`
--
ALTER TABLE `tbusers`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbgallery`
--
ALTER TABLE `tbgallery`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbusers`
--
ALTER TABLE `tbusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
