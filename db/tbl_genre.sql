-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2019 at 12:19 PM
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
-- Table structure for table `tbl_genre`
--

CREATE TABLE `tbl_genre` (
  `genre_id` int(11) NOT NULL,
  `genre_title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_genre`
--

INSERT INTO `tbl_genre` (`genre_id`, `genre_title`) VALUES
(1, '8-bit'),
(2, 'Acoustic'),
(3, 'African'),
(4, 'Ambient'),
(5, 'Ballad'),
(6, 'Big Band'),
(7, 'Blues'),
(8, 'Bollywood'),
(9, 'Celtic'),
(10, 'Cinematic'),
(11, 'Classical'),
(12, 'Corporate'),
(13, 'Country'),
(14, 'Drama'),
(15, 'Drum and Bass'),
(16, 'Dub Step'),
(17, 'EDM'),
(18, 'Electronic'),
(19, 'Electropop'),
(20, 'Emo'),
(21, 'Ethnic'),
(22, 'Folk'),
(23, 'Funk'),
(24, 'Hip Hop'),
(25, 'Indie'),
(26, 'Jazz'),
(27, 'Latin'),
(28, 'Modern Orchestral'),
(29, 'Orchestral'),
(30, 'Pop'),
(31, 'Power Ballad'),
(32, 'Rap'),
(33, 'Rock'),
(34, 'Score'),
(35, 'Trip Hop'),
(36, 'Underscore'),
(37, 'World');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_genre`
--
ALTER TABLE `tbl_genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_genre`
--
ALTER TABLE `tbl_genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
