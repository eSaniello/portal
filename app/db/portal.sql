-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2020 at 05:04 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `user_id`, `activity`, `created_at`, `updated_at`) VALUES
(9, 12, 'Logged in', '2020-08-30 09:01:26', '2020-08-30 09:01:26'),
(10, 12, 'Uploaded a file', '2020-08-30 09:01:42', '2020-08-30 09:01:42'),
(11, 12, 'Updated data', '2020-08-30 09:02:03', '2020-08-30 09:02:03'),
(12, 12, 'Deleted data', '2020-08-30 09:02:07', '2020-08-30 09:02:07'),
(13, 12, 'Inserted new data', '2020-08-30 09:02:45', '2020-08-30 09:02:45'),
(14, 12, 'Exported to PDF and sent mail', '2020-08-30 09:03:22', '2020-08-30 09:03:22'),
(15, 12, 'Exported to WORD and sent mail', '2020-08-30 09:05:28', '2020-08-30 09:05:28'),
(16, 12, 'Logged in', '2020-08-30 09:08:45', '2020-08-30 09:08:45'),
(17, 12, 'Exported to PDF and sent mail', '2020-08-30 09:09:06', '2020-08-30 09:09:06'),
(19, 12, 'Exported to EXCEL and sent mail', '2020-08-30 09:10:32', '2020-08-30 09:10:32'),
(20, 12, 'Exported to CSV and sent mail', '2020-08-30 09:10:57', '2020-08-30 09:10:57'),
(21, 12, 'Exported to JSON and sent mail', '2020-08-30 09:11:14', '2020-08-30 09:11:14'),
(22, 12, 'Created new user', '2020-08-30 09:13:54', '2020-08-30 09:13:54'),
(23, 12, 'Updated a user', '2020-08-30 09:14:44', '2020-08-30 09:14:44'),
(24, 12, 'Deleted a user', '2020-08-30 09:16:03', '2020-08-30 09:16:03'),
(25, 17, 'Logged in', '2020-08-30 09:24:12', '2020-08-30 09:24:12'),
(26, 17, 'Inserted new data', '2020-08-30 09:24:28', '2020-08-30 09:24:28'),
(27, 17, 'Updated a user', '2020-08-30 09:24:58', '2020-08-30 09:24:58'),
(28, 12, 'Logged in', '2020-08-30 09:25:08', '2020-08-30 09:25:08'),
(29, 12, 'Logged in', '2020-08-30 09:26:44', '2020-08-30 09:26:44'),
(30, 12, 'Logged in', '2020-08-30 09:54:55', '2020-08-30 09:54:55'),
(31, 12, 'Logged in', '2020-08-31 09:55:09', '2020-08-30 09:55:09'),
(32, 12, 'Logged in', '2020-08-31 09:55:30', '2020-08-30 09:55:30'),
(35, 12, 'Updated a user', '2020-08-30 10:24:27', '2020-08-30 10:24:27'),
(36, 12, 'Logged in', '2020-08-30 10:24:32', '2020-08-30 10:24:32'),
(37, 12, 'Logged in', '2020-08-30 10:36:13', '2020-08-30 10:36:13'),
(38, 12, 'Logged in', '2020-08-30 10:36:37', '2020-08-30 10:36:37'),
(39, 17, 'Logged in', '2020-08-31 06:57:33', '2020-08-31 06:57:33'),
(40, 12, 'Logged in', '2020-08-31 07:14:03', '2020-08-31 07:14:03'),
(41, 12, 'Logged in', '2020-08-31 07:33:30', '2020-08-31 07:33:30'),
(42, 12, 'Logged in', '2020-08-31 07:37:17', '2020-08-31 07:37:17'),
(43, 12, 'Logged in', '2020-08-31 07:40:59', '2020-08-31 07:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `num1` int(11) NOT NULL,
  `percent` varchar(255) NOT NULL,
  `num2` int(11) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `user_id`, `number`, `code`, `start_date`, `end_date`, `num1`, `percent`, `num2`, `expiry_date`, `created_at`, `updated_at`) VALUES
(76, 12, 8500848, 'DQVG', '06/01/2018', '06/30/2018', 100, '%', 999, '06/30/2018', '2020-08-30 09:01:42', '2020-08-30 09:01:42'),
(77, 12, 8501689, 'DQVG', '06/01/2018', '06/30/2018', 100, '%', 999, '06/30/2018', '2020-08-30 09:01:42', '2020-08-30 09:01:42'),
(78, 12, 8501706, 'DQVG', '06/01/2018', '06/30/2018', 100, '%', 999, '06/30/2018', '2020-08-30 09:01:42', '2020-08-30 09:01:42'),
(79, 12, 8501869, 'DQVG', '06/01/2018', '06/30/2018', 100, '%', 999, '06/30/2018', '2020-08-30 09:01:42', '2020-08-30 09:01:42'),
(80, 12, 8503036, 'DQVG', '06/01/2018', '06/30/2018', 100, '%', 999, '06/30/2018', '2020-08-30 09:01:42', '2020-08-30 09:01:42'),
(81, 12, 8503679, 'DQVG', '06/01/2018', '06/30/2018', 100, '%', 999, '06/30/2018', '2020-08-30 09:01:42', '2020-08-30 09:01:42'),
(82, 12, 8504014, 'DQVG', '06/01/2018', '06/30/2018', 100, '%', 999, '06/30/2018', '2020-08-30 09:01:42', '2020-08-30 09:01:42'),
(83, 12, 8504089, 'DQVG', '06/01/2018', '06/30/2018', 100, '%', 999, '06/30/2018', '2020-08-30 09:01:42', '2020-08-30 09:01:42'),
(84, 12, 8504481, 'DQVG', '06/01/2018', '06/30/2018', 100, '%', 999, '06/30/2018', '2020-08-30 09:01:42', '2020-08-30 09:01:42'),
(85, 12, 8958112, 'DDDD', '06/01/2019', '06/30/2021', 122, '%', 333, '06/30/2023', '2020-08-30 09:02:45', '2020-08-30 09:02:45'),
(86, 17, 44545, '4eef', '06/01/2019', '06/30/2021', 444, '%', 444, '06/30/2023', '2020-08-30 09:24:28', '2020-08-30 09:24:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `admin`, `created_at`, `updated_at`) VALUES
(12, 'Shaniel Samadhan', 'shaniel', '$2y$10$ggU4S1tbtXxpydumYaSxw.tImLlSAp3zatJ5KtJDnzRv0TG4dSDYC', 1, '2020-08-29 06:10:51', '2020-08-30 10:24:27'),
(16, 'Test', 'test', '$2y$10$cdZI4clNzJokk8xVnffUHes0qsZ9fexux8E5eM4vtXateFocW.aku', 0, '2020-08-30 01:08:02', '2020-08-30 01:28:18'),
(17, 'Admin', 'admin', '$2y$10$Ed973dTL4eBrEkkh9wVf8egweyfnkpPQfrDmCqLv5AQE2zn/a/qza', 1, '2020-08-30 01:16:13', '2020-08-30 01:16:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
