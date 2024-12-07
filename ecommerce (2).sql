-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 10:31 AM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderz`
--

CREATE TABLE `orderz` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderz`
--

INSERT INTO `orderz` (`id`, `user_id`, `product_name`, `quantity`, `price`, `total_price`, `purchase_date`) VALUES
(1, 8, 'Eggs', 1, 1.99, 1.99, '2024-12-06 08:37:48'),
(2, 10, 'Keyboard', 1, 41.00, 41.00, '2024-12-06 08:57:42'),
(3, 11, 'Laptop', 1, 799.99, 799.99, '2024-12-06 08:58:57'),
(4, 11, 'Headphones', 1, 99.99, 99.99, '2024-12-06 08:58:57'),
(5, 12, 'Headphones', 1, 99.99, 99.99, '2024-12-06 09:51:53'),
(6, 12, 'Keyboard', 1, 41.00, 41.00, '2024-12-06 09:51:53'),
(7, 12, 'Smartphone', 1, 499.99, 499.99, '2024-12-06 09:51:53'),
(8, 12, 'Headphones', 1, 99.99, 99.99, '2024-12-06 16:19:51'),
(9, 12, 'Headphones', 1, 99.99, 99.99, '2024-12-06 16:21:20'),
(10, 11, 'Keyboard', 1, 41.00, 41.00, '2024-12-06 16:59:53'),
(11, 11, 'Keyboard', 1, 41.00, 41.00, '2024-12-06 17:02:46'),
(12, 11, 'Keyboard', 1, 41.00, 41.00, '2024-12-06 17:03:03'),
(13, 11, 'Keyboard', 1, 41.00, 41.00, '2024-12-06 17:04:09'),
(14, 11, 'Smartphone', 1, 499.99, 499.99, '2024-12-06 17:05:30'),
(15, 10, 'Keyboard', 1, 41.00, 41.00, '2024-12-07 08:14:59'),
(16, 8, 'Notebook', 3, 1.99, 5.97, '2024-12-07 08:18:16'),
(17, 8, 'Pen', 1, 0.50, 0.50, '2024-12-07 08:18:16'),
(18, 8, 'Pencil', 1, 0.20, 0.20, '2024-12-07 08:18:16'),
(19, 8, 'Milk', 1, 2.99, 2.99, '2024-12-07 08:18:16'),
(20, 13, 'Bread', 1, 1.50, 1.50, '2024-12-07 08:39:21'),
(21, 10, 'Milk', 1, 2.99, 2.99, '2024-12-07 09:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `description`, `price`, `image`) VALUES
(1, 'grocery', 'Milk', 'Fresh organic milk', 2.99, 'milk.jpg'),
(2, 'stationary', 'Notebook', 'College ruled notebook', 1.99, 'notebook.jpg'),
(3, 'electronics', 'Smartphone', 'Latest smartphone with great features', 499.99, 'phone.jpg'),
(4, 'grocery', 'Milk', 'Fresh organic milk', 2.99, 'milk.webp'),
(5, 'stationary', 'Notebook', 'College ruled notebook', 1.99, 'noteb.jpg'),
(6, 'electronics', 'Laptop', 'High-performance laptop', 799.99, 'laptop.jpg'),
(7, 'electronics', 'Keyboard', '61% mechanical keyboard.\r\n', 41.00, 'keyboard.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'minhazuddinbhuiyan', 'minhazuddin235@gmail.com', '$2y$10$CO0uCiqbh3/a1V7ffXABIeaXVbAHEVyJbLDnf3DJ1EsfPli57HqtK', 'user', '2024-11-30 21:07:29'),
(2, 'Kalo', 'minhazuddin3rd@gmail.com', '$2y$10$UQayH5iXk9o4UzLYAEOUVuaqVRHli6R614CwnWZlxJ1CUkm9J60J6', 'user', '2024-11-30 21:21:10'),
(3, 'Gazi', 'gazi@gmail.com', '$2y$10$DRHyPkpzOr9EADDXfVB64.E4yjS2tqPTeFqf6cp7q9pS5pDjYiaim', 'user', '2024-11-30 21:37:27'),
(4, 'Kollok', 'kg@gmail.com', '$2y$10$4lTo4pYAdhrY8vVDpi9G9.3Mr6NVW9/wwG/herGj13l6jOSOXLteG', 'user', '2024-11-30 21:39:39'),
(5, 'faruk', 'faruk@gmail.com', '$2y$10$HrzDg4ljb9Shm7HnQ5JPle//MIgIY9XmRdKwMSXL5vvXoapxByzji', 'user', '2024-11-30 21:40:08'),
(6, 'Kamal', 'kamal@gmail.com', '$2y$10$v0Leo4bVEKExTTp0d0VIBO2JI.TxQm28Y75Fnf/rXAAAYlMiGPx6G', 'user', '2024-11-30 21:41:30'),
(7, 'Rabbi', 'rabbi@gmail.com', '$2y$10$DKzrygJNHAWuuoOFaVs72u2MSgq7gv83LmuaP5PyyaGCQPi/XvheW', 'user', '2024-11-30 21:42:13'),
(8, 'Zaka', 'zaka@gmail.com', '$2y$10$dFfrgBVgkDL0s9HvHaYnHenF3eWfqyNcO5v9C9/fdkF.sU5gBYIre', 'user', '2024-12-06 08:07:48'),
(9, 'Minhaz', 'minhazuddin@gmail.com', '$2y$10$3NbGYtSZJ5jDUr4eR/Hvi.ysA32uY6xDb.ikL1fNH0X6n0PGOcweS', 'user', '2024-12-06 08:45:48'),
(10, 'mad', 'mad@gmail.com', '$2y$10$TEeP.3EPfdyOjVfzw8.CBujIewBtfj6YNIGZHDVJzUgbTyO3AY62S', 'user', '2024-12-06 08:46:55'),
(11, 'rafi', 'rafi@gmail.com', '$2y$10$udHu3GhjA2kIY7fWOpbKD.aCQgs30V7NBtWSqo.ITyQj4C4XPUDeO', 'user', '2024-12-06 08:51:40'),
(12, 'kafi', 'kafi@gmail.com', '$2y$10$FlQAh.arFz2PtR.ZQkf2rOMcBNEFba2KBvNzt.BCJD/09bv3yLkc.', 'user', '2024-12-06 08:54:10'),
(13, 'Admin', 'admin@gmail.com', '$2y$10$ne8tzEa548.pnRPsWxB8/.GnfOuwJ17vIdm1GSYCMqRbIJLU6X32y', 'user', '2024-12-07 08:38:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderz`
--
ALTER TABLE `orderz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderz`
--
ALTER TABLE `orderz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
