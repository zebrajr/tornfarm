-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-server
-- Generation Time: Jul 15, 2021 at 11:46 AM
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
  `id` int(11) NOT NULL,
  `rankid` int(11) NOT NULL,
  `rankname` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
