-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2024 at 09:05 AM
-- Server version: 8.0.36
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `draft-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `createdAt`, `updatedAt`) VALUES
(1, 'Clothing', 'All kinds of clothing items', '2024-08-30 16:16:12', '2024-08-30 16:16:12'),
(2, 'Food', 'Products related to food items.', '2024-08-30 16:21:29', '2024-08-30 16:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `photos` text COLLATE utf8mb4_general_ci,
  `price` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `quantity` int NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `categoryId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `photos`, `price`, `description`, `quantity`, `createdAt`, `updatedAt`, `categoryId`) VALUES
(1, 'T-Shirt', '[\"https://picsum.photos/200/300\"]', 1000, 'A beautiful T-Shirt', 10, '2024-08-30 16:17:48', '2024-08-30 16:17:48', 1),
(2, 'Pants', '[\"https://picsum.photos/500/600\"]', 1200, 'A stylish and comfortable pair of pants.', 30, '2024-08-30 16:30:00', '2024-08-30 16:30:00', 1),
(3, 'Sweater', '[\"https://picsum.photos/300/400\"]', 1500, 'A warm and cozy sweater', 20, '2024-08-30 16:20:09', '2024-08-30 16:20:09', 1),
(4, 'Jacket', '[\"https://picsum.photos/400/500\"]', 2000, 'A stylish and warm jacket for winter', 15, '2024-08-30 16:20:43', '2024-08-30 16:20:43', 1),
(5, 'Milk', '[\"https://example.com/milk.jpg\"]', 250, 'Fresh whole milk, sourced from local dairy farms.', 100, '2024-08-30 16:23:23', '2024-08-30 16:23:23', 2),
(6, 'Bread', '[\"https://example.com/bread.jpg\"]', 1, 'Freshly baked bread with a crispy crust.', 50, '2024-08-30 16:25:39', '2024-08-30 16:25:39', 2),
(7, 'Pant', '[\"https:\\/\\/picsum.photos\\/600\\/700\"]', 800, 'A trendy and comfortable cap.', 10000, '2024-08-30 16:35:00', '2024-08-30 16:35:00', 1),
(16, 'T-shirt', '[]', 1000, 'A T-shirt GREEN', 10, '2024-09-23 09:59:26', '2024-09-23 09:59:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
