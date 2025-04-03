-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 01:10 AM
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
-- Database: `homework_9`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `description`) VALUES
(1, 'Apple', 'Fruit', 'High in fiber, vitamin C, potassium, and antioxidants.'),
(2, 'Banana', 'Fruit', 'Rich in potassium, vitamin B6, fiber, and magnesium.'),
(3, 'Orange', 'Fruit', 'Excellent source of vitamin C, folate, and antioxidants.'),
(4, 'Strawberry', 'Fruit', 'Packed with vitamin C, manganese, and antioxidants.'),
(5, 'Blueberry', 'Fruit', 'Rich in vitamin K, vitamin C, and anthocyanins.'),
(6, 'Mango', 'Fruit', 'Loaded with vitamin A, vitamin C, and folate.'),
(7, 'Pineapple', 'Fruit', 'High in vitamin C, manganese, and bromelain.'),
(8, 'Kiwi', 'Fruit', 'Full of vitamin C, vitamin K, and fiber.'),
(9, 'Grapes', 'Fruit', 'Good source of vitamin K, vitamin B1, and polyphenols.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
