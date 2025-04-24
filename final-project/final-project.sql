-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 03:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT '',
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Aldin', 'ahot@fordham.edu', 'Hello', 'test', '2025-04-23 02:07:23'),
(2, 'Aldin', 'ahot@fordham.edu', 'Hello', 'test', '2025-04-23 02:09:52'),
(3, 'Aldin', 'aldin100@gmail.com', 'Hi', 'Test', '2025-04-23 02:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `email`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ahot3@fordham.edu', '', '2025-04-23 15:55:30', NULL),
(2, 'aldin100@example.com', '', '2025-04-23 16:14:52', NULL),
(3, 'aldin@example.com', 'Aldin', '2025-04-23 16:17:49', NULL),
(4, 'john@example.com', 'John', '2025-04-23 17:46:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `reviewer_name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `stars` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `destination`, `reviewer_name`, `comment`, `stars`, `created_at`) VALUES
(1, 'japan', 'Aldin', 'Fun', 5, '2025-04-22 21:18:27'),
(2, 'turkey', 'Al Reet', 'loved it', 5, '2025-04-22 21:19:29'),
(3, 'montenegro', 'Pendu', 'amazing trip', 5, '2025-04-22 21:20:13'),
(4, 'japan', 'John', 'Loved it', 4, '2025-04-23 02:06:01'),
(5, 'turkey', 'Patrick', 'Fun city', 4, '2025-04-23 02:06:43'),
(6, 'japan', 'Pinecone', 'Amazing country', 5, '2025-04-23 17:03:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'traveler1', 'traveler1@example.com', '$2y$10$6KFucV1nPTR8tBgs1o.Bse7zZBUWJDCx8inZL/fzPBk1TgvFTmyXy', '2025-03-10 09:15:22'),
(2, 'adventurer', 'adventurer@example.com', '$2y$10$6KFucV1nPTR8tBgs1o.Bse7zZBUWJDCx8inZL/fzPBk1TgvFTmyXy', '2025-03-15 14:30:45'),
(3, 'worldexplorer', 'explorer@example.com', '$2y$10$6KFucV1nPTR8tBgs1o.Bse7zZBUWJDCx8inZL/fzPBk1TgvFTmyXy', '2025-04-01 11:20:33'),
(4, 'aldin10', 'aldin100@example.com', '$2y$10$mvJiK5R5B7s70QRy4DnC0./LDfTKRvVlx0.VPqk181x3c8dtmBrr6', '2025-04-23 21:22:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
