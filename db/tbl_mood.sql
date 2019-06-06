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
-- Table structure for table `tbl_mood`
--

CREATE TABLE `tbl_mood` (
  `mood_id` int(11) NOT NULL,
  `mood_title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mood`
--

INSERT INTO `tbl_mood` (`mood_id`, `mood_title`) VALUES
(1, 'Aggressive'),
(2, 'Angry'),
(3, 'Atmospheric'),
(4, 'Beautiful'),
(5, 'Bouncy'),
(6, 'Building'),
(7, 'Calm'),
(8, 'Carefree'),
(9, 'Chaotic'),
(10, 'Cheerful'),
(11, 'Childlike'),
(12, 'Chill'),
(13, 'Comforting'),
(14, 'Creepy'),
(15, 'Cruising'),
(16, 'Dancey'),
(17, 'Dark'),
(18, 'Delightful'),
(19, 'Depressing'),
(20, 'Dissonant'),
(21, 'Disturbing'),
(22, 'Dreamy'),
(23, 'Driving'),
(24, 'Dronning'),
(25, 'Dynamic'),
(26, 'Eerie'),
(27, 'Energetic'),
(28, 'Epic'),
(29, 'Ethereal'),
(30, 'Explosive'),
(31, 'Frantic'),
(32, 'Fun'),
(33, 'Happy'),
(34, 'Haunting'),
(35, 'Heart Warming'),
(36, 'Hopeful'),
(37, 'Inspiring'),
(38, 'Intense'),
(39, 'Joyful'),
(40, 'Melancholic'),
(41, 'Mellow'),
(42, 'Mysterious'),
(43, 'Ominous'),
(44, 'Optimistic'),
(45, 'Playful'),
(46, 'Powerful'),
(47, 'Quirky'),
(48, 'Rebellious'),
(49, 'Reflective'),
(50, 'Relaxing'),
(51, 'Retro'),
(52, 'Romantic'),
(53, 'Sad'),
(54, 'Scary'),
(55, 'Serene'),
(56, 'Soarting'),
(57, 'Soft'),
(58, 'Somber'),
(59, 'Soothing'),
(60, 'Soulful'),
(61, 'Spacious'),
(62, 'Suspenseful'),
(63, 'Tranquil'),
(64, 'Upbeat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_mood`
--
ALTER TABLE `tbl_mood`
  ADD PRIMARY KEY (`mood_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_mood`
--
ALTER TABLE `tbl_mood`
  MODIFY `mood_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
