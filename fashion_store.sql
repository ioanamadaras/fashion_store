-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 24, 2025 at 08:44 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashion_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `size`, `quantity`, `created_at`) VALUES
(5, 3, 15, 'M', 1, '2025-11-23 03:01:06'),
(12, 3, 1, 'S', 1, '2025-11-24 15:49:41'),
(13, 3, 3, 'S', 1, '2025-11-24 15:49:58'),
(16, 3, 1, 'L', 1, '2025-11-24 15:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'paid',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `zipcode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `created_at`, `fullname`, `email`, `phone`, `country`, `city`, `street`, `zipcode`) VALUES
(1, 2, 139.80, 'Plătită', '2025-11-23 15:54:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 39.90, 'Plătită', '2025-11-23 15:58:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 99.90, 'Plătită', '2025-11-23 16:02:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 149.80, 'Plătită', '2025-11-23 16:05:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 79.90, 'Plătită', '2025-11-23 16:07:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, 39.90, 'Plătită', '2025-11-24 15:50:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 2, 99.90, 'Plătită', '2025-11-24 15:53:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 2, 39.90, 'Plătită', '2025-11-24 17:19:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `size`, `quantity`, `price`) VALUES
(1, 1, 1, 'M', 1, 39.90),
(2, 1, 2, 'L', 1, 99.90),
(3, 2, 1, 'S', 1, 39.90),
(4, 3, 2, 'L', 1, 99.90),
(5, 4, 3, 'S', 1, 59.90),
(6, 4, 4, 'L', 1, 89.90),
(7, 5, 6, 'XL', 1, 79.90),
(8, 6, 1, 'M', 1, 39.90),
(9, 7, 2, 'S', 1, 99.90),
(10, 8, 1, 'M', 1, 39.90);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `descriere` text,
  `categorie` varchar(255) DEFAULT NULL,
  `gender` varchar(20) DEFAULT 'Femei'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `image`, `price`, `descriere`, `categorie`, `gender`) VALUES
(1, 'Top din tricot fin', 'Z001', 'Z001.jpg', 39.90, 'Top tricotat cu fundă', 'Tricouri', 'Femei'),
(2, 'Rochie', 'Z002', 'Z002.jpg', 99.90, 'Rochie elegantă', 'Rochii', 'Femei'),
(3, 'Cămașă albă fluidă', 'Z003', 'Z003.jpg', 59.90, 'Cămașă oversized', 'Tricouri', 'Femei'),
(4, 'Pantaloni wide leg', 'Z004', 'Z004.jpg', 89.90, 'Pantaloni largi, talie înaltă', 'Pantaloni', 'Femei'),
(5, 'Top satin cu bretele', 'Z005', 'Z005.jpg', 49.90, 'Top satinat', 'Tricouri', 'Femei'),
(6, 'Hanorac oversized', 'Z006', 'Z006.jpg', 79.90, 'Hanorac oversized', 'Hanorace', 'Femei'),
(7, 'Tricou basic alb', 'Z007', 'Z007.jpg', 29.90, 'Tricou simplu din bumbac 100%', 'Tricouri', 'Femei'),
(8, 'Hanorac minimalist', 'Z008', 'Z008.jpg', 89.90, 'Hanorac fără imprimeu', 'Hanorace', 'Femei'),
(9, 'Cămașă slim fit', 'Z009', 'Z009.jpg', 69.90, 'Cămașă slim fit', 'Tricouri', 'Femei'),
(10, 'Blugi', 'Z010', 'Z010.jpg', 99.90, 'Blugi', 'Pantaloni', 'Femei'),
(11, 'Geacă neagră', 'Z011', 'Z011.jpg', 149.90, 'Geacă', 'Jachete', 'Femei'),
(12, 'Pulover gri structurat', 'Z012', 'Z012.jpg', 79.90, 'Pulover bumbac', 'Tricouri', 'Femei'),
(13, 'Tricou simplu negru', 'M001', 'M001.jpg', 39.90, 'Tricou basic', 'Tricouri', 'Barbati'),
(14, 'Cămașă clasică albă', 'M002', 'M002.jpg', 89.90, 'Cămașă slim', 'Cămăși', 'Barbati'),
(15, 'Pantaloni bej', 'M003', 'M003.jpg', 119.90, 'Pantaloni casual', 'Pantaloni', 'Barbati'),
(16, 'Hanorac simplu gri', 'M004', 'M004.jpg', 99.90, 'Hanorac lejer', 'Hanorace', 'Barbati'),
(17, 'Pulover bleu', 'M005', 'M005.jpg', 79.90, 'Pulover subțire', 'Pulovere', 'Barbati'),
(18, 'Geacă neagră', 'M006', 'M006.jpg', 199.90, 'Geacă ', 'Jachete', 'Barbati'),
(19, 'Blugi slim fit', 'M007', 'M007.jpg', 149.90, 'Blugi slim', 'Pantaloni', 'Barbati'),
(20, 'Sacou bleumarin', 'M008', 'M008.jpg', 249.90, 'Sacou elegant', 'Sacouri', 'Barbati'),
(21, 'Pantaloni scurți sport', 'M009', 'M009.jpg', 59.90, 'Short sport', 'Shorts', 'Barbati'),
(22, 'Tricou polo alb', 'M010', 'M010.jpg', 69.90, 'Polo simplu', 'Tricouri', 'Barbati');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size`) VALUES
(6, 2, 'S'),
(7, 2, 'M'),
(8, 2, 'L'),
(9, 3, 'XS'),
(10, 3, 'S'),
(11, 3, 'L'),
(12, 4, 'XS'),
(13, 4, 'S'),
(14, 4, 'M'),
(15, 4, 'L'),
(16, 4, 'XL'),
(17, 5, 'S'),
(18, 5, 'M'),
(19, 5, 'L'),
(20, 5, 'XL'),
(21, 6, 'XS'),
(22, 6, 'M'),
(23, 6, 'L'),
(24, 6, 'XL'),
(25, 7, 'XS'),
(26, 7, 'S'),
(27, 7, 'L'),
(28, 8, 'XS'),
(29, 8, 'S'),
(30, 8, 'L'),
(31, 8, 'XL'),
(32, 9, 'XS'),
(33, 9, 'S'),
(34, 9, 'M'),
(35, 9, 'L'),
(36, 10, 'XS'),
(37, 10, 'S'),
(38, 10, 'L'),
(39, 10, 'XL'),
(40, 11, 'XS'),
(41, 11, 'S'),
(42, 11, 'M'),
(43, 11, 'L'),
(44, 11, 'XL'),
(45, 12, 'S'),
(46, 12, 'M'),
(47, 12, 'L'),
(48, 13, 'XS'),
(49, 13, 'S'),
(50, 13, 'M'),
(51, 13, 'L'),
(52, 14, 'XS'),
(53, 14, 'S'),
(54, 14, 'M'),
(55, 14, 'L'),
(56, 14, 'XL'),
(57, 22, 'S'),
(58, 22, 'M'),
(59, 22, 'XL'),
(60, 21, 'XS'),
(61, 21, 'M'),
(62, 21, 'L'),
(63, 21, 'XL'),
(64, 20, 'S'),
(65, 20, 'M'),
(66, 20, 'L'),
(67, 19, 'S'),
(68, 19, 'M'),
(69, 19, 'XL'),
(70, 18, 'XS'),
(71, 18, 'S'),
(72, 18, 'M'),
(73, 15, 'XS'),
(74, 15, 'M'),
(75, 15, 'L'),
(76, 17, 'XS'),
(77, 17, 'S'),
(78, 17, 'M'),
(79, 16, 'XS'),
(80, 16, 'S'),
(81, 16, 'M'),
(82, 16, 'L'),
(83, 16, 'XL'),
(84, 1, 'XS'),
(85, 1, 'M'),
(86, 1, 'L'),
(87, 1, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(2, 'ma.io0221045s', 'ioanamadaras2000@gmail.com', '$2y$10$BjehEOGtP6NeOyBUkK4d0uwd9jPv9.teZReRa9UL/Enrn3qvOp/e.', 'user'),
(3, 'admin', 'admin@gmail.com', '$2y$10$h50CKFLYpKzm26vEuK9F2OfPXqkSDkZjS52CoVU4uNoujQCJo9qkq', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
