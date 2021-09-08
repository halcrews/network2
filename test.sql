-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 08, 2021 at 03:16 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` int(11) UNSIGNED NOT NULL,
  `domain_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `domain_name`) VALUES
(2, 'Domain-1'),
(1, 'Domain-2');

-- --------------------------------------------------------

--
-- Table structure for table `pc`
--

CREATE TABLE `pc` (
  `id` int(11) UNSIGNED NOT NULL,
  `pcid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_architect` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pc_role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proccesses_list` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `servicies_list` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_topology` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin_list` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pc`
--

INSERT INTO `pc` (`id`, `pcid`, `net_architect`, `os_version`, `domain_name`, `pc_role`, `user_name`, `pc_name`, `ram`, `proc`, `os_language`, `proccesses_list`, `servicies_list`, `disks`, `net_topology`, `bin_list`) VALUES
(1, 'PC2', 'Star-Bus', 'Windows7', 'Domain-2', 'Local User', 'User2', 'PC-User2', '32Gb', 'Intel Core i5-11500HE', 'English', 'wsappx, Registry, System', 'cbdhsvc, CscService, defragsvc', 'cbdhsvc, CscService, defragsvc', '192.168.0.37', 'wab.exe, wordpad.exe'),
(2, 'PC1', 'Star-Bus', 'Windows10', 'Domain-1', 'Local Admin', 'User1', 'PC-User1', '16Gb', 'Intel Core i5-9400F BOX', 'English', 'Chromium, NVIDIA Container, Windows Security Health Service', 'autotimesvc, bthserv, camsvc, ClipSVC', 'autotimesvc, bthserv, camsvc, ClipSVC', '192.168.0.35', 'iexplorer.exe, MpCmdRun.exe'),
(3, 'PC21', 'Star-Ring', 'Windows8', 'Domain-2', 'Local User', 'User12', 'PC-User12', '8Gb', 'Intel Core i3-2100', 'English', 'User OOBE Broker, Office Background Task Host, COM Surrogate', 'CDPSVc, cbdhsvc, ClipSVC', 'CDPSVc, cbdhsvc, ClipSVC', '192.168.1.25', 'ie4uinit.exe, ieUnatt.exe, iexpress.exe'),
(4, 'PC-22', 'Star-Ring', 'Windows8', 'Domain-2', 'Local User', 'User-22', 'PC-User-22', '8Gb', 'Intel Core i3-2100', 'English', 'User OOBE Broker, Office Background Task Host, COM Surrogate', 'CDPSVc, cbdhsvc, ClipSVC', 'CDPSVc, cbdhsvc, ClipSVC', '192.168.10.95', 'ie4uinit.exe, ieUnatt.exe, iexpress.exe'),
(9, 'PC-25', 'Star-Ring', 'Windows8', 'Domain-2', 'Local User', 'User-25', 'PC-User-25', '2Gb', 'Intel Core i3-2100', 'English', 'User OOBE Broker, Office Background Task Host, COM Surrogate', 'CDPSVc, cbdhsvc, ClipSVC', 'CDPSVc, cbdhsvc, ClipSVC', '192.168.11.07', 'ie4uinit.exe, ieUnatt.exe, iexpress.exe'),
(10, 'PC-77', 'Star-Ring', 'Windows8', 'Domain-1', 'Local User', 'User-77', 'PC-User-77', '2Gb', 'Intel Core i3-2100', 'English', 'User OOBE Broker, Office Background Task Host, COM Surrogate', 'CDPSVc, cbdhsvc, ClipSVC', 'CDPSVc, cbdhsvc, ClipSVC', '192.168.11.07', 'ie4uinit.exe, ieUnatt.exe, iexpress.exe'),
(11, 'PC-17', 'Star-Ring', 'Windows8', 'Domain-1', 'Local User', 'User-17', 'PC-User-17', '2Gb', 'Intel Core i3-2100', 'English', 'User OOBE Broker, Office Background Task Host, COM Surrogate', 'CDPSVc, cbdhsvc, ClipSVC', 'CDPSVc, cbdhsvc, ClipSVC', '192.168.11.07', 'ie4uinit.exe, ieUnatt.exe, iexpress.exe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `domain_name` (`domain_name`),
  ADD UNIQUE KEY `domain_name_2` (`domain_name`),
  ADD UNIQUE KEY `domain_name_3` (`domain_name`),
  ADD UNIQUE KEY `domain_name_4` (`domain_name`),
  ADD UNIQUE KEY `domain_name_5` (`domain_name`),
  ADD UNIQUE KEY `domain_name_6` (`domain_name`),
  ADD UNIQUE KEY `domain_name_7` (`domain_name`),
  ADD UNIQUE KEY `domain_name_8` (`domain_name`),
  ADD UNIQUE KEY `domain_name_9` (`domain_name`),
  ADD UNIQUE KEY `domain_name_10` (`domain_name`),
  ADD UNIQUE KEY `domain_name_11` (`domain_name`);

--
-- Indexes for table `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pcid` (`pcid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pc`
--
ALTER TABLE `pc`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
