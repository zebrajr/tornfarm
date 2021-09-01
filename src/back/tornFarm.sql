-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mySqlBench
-- Generation Time: Sep 01, 2021 at 04:03 PM
-- Server version: 10.6.3-MariaDB-1:10.6.3+maria~focal
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tornFarm`
--
CREATE DATABASE IF NOT EXISTS `tornFarm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tornFarm`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`%` PROCEDURE `deletePrevious` (`idPlayer` BIGINT(20))  BEGIN
	DELETE FROM torn_list
    WHERE torn_list.playerid = idPlayer;
END$$

CREATE DEFINER=`root`@`%` PROCEDURE `tornRanks` (`searchStr` TEXT)  BEGIN
	SELECT * FROM torn_ranks WHERE rankname LIKE searchStr;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `torn_list`
--

CREATE TABLE `torn_list` (
  `id` bigint(20) NOT NULL COMMENT 'Unique ID',
  `rank` text NOT NULL COMMENT 'Rank',
  `role` text NOT NULL COMMENT 'Role',
  `level` int(11) NOT NULL COMMENT 'Level',
  `awards` int(11) NOT NULL COMMENT 'Awards',
  `age` int(11) NOT NULL COMMENT 'Age',
  `playerid` int(11) NOT NULL COMMENT 'PlayerID',
  `name` text NOT NULL COMMENT 'Name',
  `faction_name` text NOT NULL COMMENT 'Faction Name',
  `maximum_life` int(11) NOT NULL COMMENT 'Maximum Life',
  `last_action` text NOT NULL COMMENT 'Last Action',
  `attack_date` datetime NOT NULL COMMENT 'Date of last attack',
  `totalCrimes` bigint(20) NOT NULL,
  `totalNetworth` bigint(20) NOT NULL,
  `xanTaken` bigint(20) NOT NULL,
  `energyDrinkUsed` bigint(20) NOT NULL,
  `energyRefills` bigint(20) NOT NULL,
  `statEnhancersUsed` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='List from 2019/07/18 onwards';

-- --------------------------------------------------------

--
-- Table structure for table `torn_list_ignored`
--

CREATE TABLE `torn_list_ignored` (
  `id` bigint(20) NOT NULL COMMENT 'Unique ID',
  `playerid` int(11) NOT NULL COMMENT 'PlayerID'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='List from 2019/07/18 onwards';

-- --------------------------------------------------------

--
-- Table structure for table `torn_ranks`
--

CREATE TABLE `torn_ranks` (
  `rankid` int(11) NOT NULL,
  `rankname` varchar(64) NOT NULL,
  `triggersRequired` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `torn_ranks`
--

INSERT INTO `torn_ranks` (`rankid`, `rankname`, `triggersRequired`) VALUES
(1, 'Absolute beginner', 0),
(2, 'Beginner', 1),
(3, 'Inexperienced', 2),
(4, 'Rookie', 3),
(5, 'Novice', 4),
(6, 'Below Average', 5),
(7, 'Average', 6),
(8, 'Reasonable', 7),
(9, 'Above Average', 8),
(10, 'Competent', 9),
(11, 'Highly Competent', 10),
(12, 'Veteran', 11),
(13, 'Distinguished', 12),
(14, 'Highly Distinguished', 13),
(15, 'Professional', 14),
(16, 'Star', 15),
(17, 'Master', 16),
(18, 'Outstanding', 17),
(19, 'Celebrity', 18),
(20, 'Supreme', 19),
(21, 'Idolized', 20),
(22, 'Champion', 21),
(23, 'Heroic', 22),
(24, 'Legendary', 23),
(25, 'Elite', 24),
(26, 'Invincible', 25);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `ip` text NOT NULL COMMENT 'IP'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `torn_list`
--
ALTER TABLE `torn_list`
  ADD KEY `id` (`id`);

--
-- Indexes for table `torn_list_ignored`
--
ALTER TABLE `torn_list_ignored`
  ADD KEY `id` (`id`);

--
-- Indexes for table `torn_ranks`
--
ALTER TABLE `torn_ranks`
  ADD PRIMARY KEY (`rankid`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `torn_list`
--
ALTER TABLE `torn_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID';

--
-- AUTO_INCREMENT for table `torn_list_ignored`
--
ALTER TABLE `torn_list_ignored`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID';

--
-- AUTO_INCREMENT for table `torn_ranks`
--
ALTER TABLE `torn_ranks`
  MODIFY `rankid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
