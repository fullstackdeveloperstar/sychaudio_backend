-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2019 at 03:38 PM
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
-- Table structure for table `tbl_artist`
--

CREATE TABLE `tbl_artist` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(50) NOT NULL,
  `artist_bio` text NOT NULL,
  `artist_contact` varchar(256) DEFAULT NULL,
  `artist_from` varchar(100) DEFAULT NULL,
  `artist_status` tinyint(4) NOT NULL COMMENT '0: public, 1: private',
  `artist_key_writers` varchar(1024) NOT NULL,
  `artist_members` varchar(1024) NOT NULL,
  `artist_avatar` varchar(512) DEFAULT NULL,
  `artist_born` varchar(256) DEFAULT NULL,
  `artist_nationality` varchar(20) DEFAULT NULL,
  `artist_website_url` varchar(256) DEFAULT NULL,
  `artist_twitter` varchar(256) DEFAULT NULL,
  `artist_facebook` varchar(256) DEFAULT NULL,
  `artist_myspace` varchar(256) DEFAULT NULL,
  `artist_youtube` varchar(256) DEFAULT NULL,
  `artist_itunes` varchar(256) DEFAULT NULL,
  `artist_lastfm` varchar(256) DEFAULT NULL,
  `artist_soundcloud` varchar(256) DEFAULT NULL,
  `artist_bandcamp` varchar(256) DEFAULT NULL,
  `artist_instagram` varchar(256) DEFAULT NULL,
  `artist_spotify` varchar(256) DEFAULT NULL,
  `artist_otherurl1` varchar(256) DEFAULT NULL,
  `artist_otherurl2` varchar(256) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL COMMENT '0: not, 1: deleted',
  `deleted_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_artist`
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `news_id` int(11) NOT NULL,
  `news_title` varchar(256) NOT NULL,
  `news_thumb` varchar(512) DEFAULT NULL,
  `news_content` text NOT NULL,
  `news_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: public, 1: privated',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: not, 1: deleted',
  `deleted_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pace`
--

CREATE TABLE `tbl_pace` (
  `pace_id` int(11) NOT NULL,
  `pace_title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pace`
--

INSERT INTO `tbl_pace` (`pace_id`, `pace_title`) VALUES
(1, 'Fast'),
(2, 'Moderate'),
(3, 'Slow'),
(4, 'Zzz...');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_playlist`
--

CREATE TABLE `tbl_playlist` (
  `playlist_id` int(11) NOT NULL,
  `playlist_title` varchar(50) NOT NULL,
  `playlist_note` text NOT NULL,
  `playlist_thumb` varchar(256) DEFAULT NULL,
  `playlist_status` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_playlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_songs`
--

CREATE TABLE `tbl_songs` (
  `song_id` int(11) NOT NULL,
  `song_title` varchar(256) NOT NULL,
  `song_thumb` varchar(512) DEFAULT NULL,
  `song_music` varchar(512) NOT NULL,
  `song_artist` int(11) DEFAULT NULL,
  `song_performedby` varchar(100) DEFAULT NULL,
  `song_mood` varchar(20) DEFAULT NULL,
  `song_genre` varchar(20) DEFAULT NULL,
  `song_pace` varchar(20) DEFAULT NULL,
  `song_instrument` varchar(20) DEFAULT NULL,
  `song_key` varchar(20) DEFAULT NULL,
  `song_playlist` int(11) DEFAULT NULL,
  `song_vocals_inst` varchar(11) NOT NULL DEFAULT 'all' COMMENT 'all, vocals, instrumental',
  `song_duration` int(11) DEFAULT NULL,
  `song_bpm` int(11) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `deleted_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_songs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_avatar` varchar(512) NOT NULL,
  `user_token` varchar(512) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL COMMENT '0: not, 1: deleted',
  `is_verified` tinyint(4) NOT NULL COMMENT '0:not, 1: verified',
  `user_role` tinyint(11) NOT NULL DEFAULT '1' COMMENT '0: admin, 1: general',
  `deleted_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_avatar`, `user_token`, `is_deleted`, `is_verified`, `user_role`, `deleted_datetime`, `updated_datetime`, `created_datetime`) VALUES
(1, 'Administrator', 'test@mail.com', '$2y$10$RomlDgPWO2lNJeiPQELMMOb9r6i4h6h0ejl4kwuUCqKD5tJixfXl6', 'http://localhost/uploads/user/avatar/sq-face-220.jpg', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTAiLCJ1c2VyX25hbWUiOiJBZG1pbmlzdHJhdG9yIiwidXNlcl9lbWFpbCI6InRlc3RAbWFpbC5jb20iLCJ1c2VyX3Bhc3N3b3JkIjoiJDJ5JDEwJFJvbWxEZ1BXTzJsTkplaVBRRUxNTU9iOXI2aTRoNmgwZWpsNGt3dVVDcUtENXRKaXhmWGw2IiwidXNlcl9hdmF0YXIiOiJodHRwOlwvXC9sb2NhbGhvc3RcL3VwbG9hZHNcL3VzZXJcL2F2YXRhclwvc3EtZmFjZS0yMjAuanBnIiwidXNlcl90b2tlbiI6ImV5SjBlWEFpT2lKS1YxUWlMQ0poYkdjaU9pSklVekkxTmlKOS5leUoxYzJWeVgybGtJam9pTVRBaUxDSjFjMlZ5WDI1aGJXVWlPaUlpTENKMWMyVnlYMlZ0WVdsc0lqb2lkR1Z6ZEVCdFlXbHNMbU52YlN', 0, 0, 0, '2019-06-05 15:00:11', '2019-06-06 15:34:14', '0000-00-00 00:00:00');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_artist`
--
ALTER TABLE `tbl_artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `tbl_genre`
--
ALTER TABLE `tbl_genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `tbl_instruments`
--
ALTER TABLE `tbl_instruments`
  ADD PRIMARY KEY (`inst_id`);

--
-- Indexes for table `tbl_key`
--
ALTER TABLE `tbl_key`
  ADD PRIMARY KEY (`key_id`);

--
-- Indexes for table `tbl_mood`
--
ALTER TABLE `tbl_mood`
  ADD PRIMARY KEY (`mood_id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `tbl_pace`
--
ALTER TABLE `tbl_pace`
  ADD PRIMARY KEY (`pace_id`);

--
-- Indexes for table `tbl_playlist`
--
ALTER TABLE `tbl_playlist`
  ADD PRIMARY KEY (`playlist_id`);

--
-- Indexes for table `tbl_songs`
--
ALTER TABLE `tbl_songs`
  ADD PRIMARY KEY (`song_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_artist`
--
ALTER TABLE `tbl_artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `tbl_genre`
--
ALTER TABLE `tbl_genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_instruments`
--
ALTER TABLE `tbl_instruments`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_key`
--
ALTER TABLE `tbl_key`
  MODIFY `key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_mood`
--
ALTER TABLE `tbl_mood`
  MODIFY `mood_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `tbl_pace`
--
ALTER TABLE `tbl_pace`
  MODIFY `pace_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_playlist`
--
ALTER TABLE `tbl_playlist`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `tbl_songs`
--
ALTER TABLE `tbl_songs`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
