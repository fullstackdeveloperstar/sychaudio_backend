-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2019 at 12:20 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `synchaudio`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_key`
--

CREATE TABLE `tbl_key` (
  `key_id` int(11) NOT NULL,
  `key_title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_key`
--

INSERT INTO `tbl_key` (`key_id`, `key_title`) VALUES
(1, 'Ab/G# Major'),
(2, 'Ab/G# Minor'),
(3, 'A Major'),
(4, 'A Minor'),
(5, 'Bb/A# Major'),
(6, 'Bb/A# Minor'),
(7, 'B Major'),
(8, 'B Minor'),
(9, 'C Major'),
(10, 'C Minor'),
(11, 'Db/C# Major'),
(12, 'Db/C# Minor'),
(13, 'D Major'),
(14, 'D Minor'),
(15, 'Eb/D# Major'),
(16, 'Eb/D# Minor'),
(17, 'E Major'),
(18, 'E Minor'),
(19, 'F Major'),
(20, 'F Minor'),
(21, 'Gb/F# Major'),
(22, 'Gb/F# Minor'),
(23, 'G Major'),
(24, 'G Minor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_key`
--
ALTER TABLE `tbl_key`
  ADD PRIMARY KEY (`key_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_key`
--
ALTER TABLE `tbl_key`
  MODIFY `key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
