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
-- Table structure for table `tbl_instruments`
--

CREATE TABLE `tbl_instruments` (
  `inst_id` int(11) NOT NULL,
  `inst_title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_instruments`
--

INSERT INTO `tbl_instruments` (`inst_id`, `inst_title`) VALUES
(1, 'Accordion'),
(2, 'Acoustic'),
(3, 'Ambient Tones'),
(4, 'Banjo'),
(5, 'Bells'),
(6, 'Big Drums'),
(7, 'Cello'),
(8, 'Claps / Snaps / Stom'),
(9, 'Electric Guitar'),
(10, 'Fiddle'),
(11, 'Harmonica'),
(12, 'Horns / Brass'),
(13, 'Humming'),
(14, 'Organ'),
(15, 'Piano'),
(16, 'Rhodes'),
(17, 'Saxophone'),
(18, 'Steel Guitar'),
(19, 'Strings'),
(20, 'Synth'),
(21, 'Techo Drums'),
(22, 'Toy Piano / Glockens'),
(23, 'Ukelele'),
(24, 'Upright Bass'),
(25, 'Violin'),
(26, 'Vocal Harmony'),
(27, 'Woodwinds');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_instruments`
--
ALTER TABLE `tbl_instruments`
  ADD PRIMARY KEY (`inst_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_instruments`
--
ALTER TABLE `tbl_instruments`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
