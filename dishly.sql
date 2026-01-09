-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2026 at 05:13 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dishly`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int NOT NULL,
  `nama_category` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `nama_category`) VALUES
(1, 'Makanan'),
(2, 'Minuman'),
(3, 'Side Dish');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int NOT NULL,
  `order_date` date NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` enum('On Progress','Calling','Done') NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `order_date`, `name`, `status`, `total_price`) VALUES
(11, '2026-01-09', 'john', 'On Progress', 27000.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id_items` int NOT NULL,
  `id_order` int NOT NULL,
  `id_product` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id_items`, `id_order`, `id_product`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 27000.00),
(2, 1, 2, 1, 18000.00),
(3, 1, 6, 2, 7500.00),
(4, 2, 1, 1, 27000.00),
(5, 1, 4, 1, 34000.00),
(6, 2, 20, 1, 42000.00),
(7, 2, 21, 1, 50000.00),
(8, 3, 21, 1, 50000.00),
(9, 4, 4, 1, 34000.00),
(10, 5, 20, 1, 42000.00),
(11, 6, 6, 1, 7500.00),
(12, 6, 11, 1, 21000.00),
(13, 7, 1, 1, 27000.00),
(14, 8, 1, 1, 27000.00),
(15, 8, 4, 1, 34000.00),
(16, 8, 20, 21, 42000.00),
(17, 9, 1, 1, 27000.00),
(18, 9, 4, 1, 34000.00),
(19, 10, 1, 1, 27000.00),
(20, 10, 5, 1, 8000.00),
(21, 11, 1, 1, 27000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int NOT NULL,
  `id_category` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `id_category`, `name`, `description`, `price`, `image`, `stock`, `created_at`) VALUES
(1, 1, 'Burger Gokil', 'Perpaduan antara Beef dengan Double Cheesemelt', 27000.00, 'uploads/burger.jpg', 13, '2025-12-08 04:33:25'),
(2, 2, 'French Fries', 'Kentang Goreng pilihan terbaik ', 18000.00, 'uploads/kentang.jpg', 22, '2025-12-08 07:09:27'),
(3, 3, 'Dishly Donat', 'Paket 5 donat kesukaan kamu, pilih sebebasnya!', 20000.00, 'uploads/donat.jpg', 20, '2025-12-08 07:10:12'),
(4, 1, 'Ramen Bowl', 'Mie Ramen + Rumput Laut + Telur setengah matang terbaik', 34000.00, 'uploads/ramenbowl.jpg', 16, '2025-12-08 07:11:02'),
(5, 2, 'Pepsi', 'Soda Segar dengan tambahan Lemonade', 8000.00, 'uploads/pepsi.jpg', 27, '2025-12-08 07:11:40'),
(6, 2, 'Sprite', 'Minuman Lemon bersoda', 7500.00, 'uploads/sprite.jpg', 25, '2025-12-08 07:20:16'),
(7, 3, 'Dimsum', 'Dimsum 4 Pcs', 15000.00, 'uploads/dimsum.jpg', 20, '2025-12-08 13:12:00'),
(8, 3, 'Ice Cream Cup', 'Ice Cream Cup', 18000.00, 'uploads/icecreamcup.jpg', 30, '2025-12-08 13:13:16'),
(9, 3, 'Croissant', 'Croissant Original', 19000.00, 'uploads/croissant.jpg', 20, '2025-12-08 13:15:16'),
(10, 3, 'Pancakes', 'Pancakes Caramel', 44000.00, 'uploads/pancakes.jpg', 20, '2025-12-08 13:17:41'),
(11, 2, 'Ice Americano', '2 Shot Americano', 21000.00, 'uploads/americano.jpg', 19, '2025-12-08 13:18:13'),
(13, 2, 'Matcha Latte', 'Matcha', 33000.00, 'uploads/matchalatte.jpg', 20, '2025-12-08 13:19:17'),
(14, 2, 'Oreo Smoothie', 'Oreo + Cream', 32000.00, 'uploads/oreosmoothie.jpg', 20, '2025-12-08 13:21:58'),
(16, 2, 'Kopi Aren', 'Coffee + Milk + Aren Sugar', 30000.00, 'uploads/kopi gula aren.jpg', 20, '2025-12-08 13:23:14'),
(20, 1, 'Nasi Goreng', 'Nasi Goreng', 42000.00, 'uploads/nasigorengpattaya.jpg', -8, '2025-12-08 13:38:45'),
(21, 1, 'Chicken Wings', '8 Chicken Wings + Barbeque Sauce', 50000.00, 'uploads/chickenwings.jpg', 18, '2025-12-08 13:39:47'),
(23, 1, 'Dumplings', 'Dumplings', 36000.00, 'uploads/frieddumplings.jpg', 36, '2025-12-08 13:46:22'),
(27, 1, 'Nasi Goreng Pattaya', 'Nasi Goreng', 34000.00, 'uploads/spaghettibolognese.jpg', 20, '2025-12-17 12:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `created_at`) VALUES
(8, 'noval', 'noval@gmail.com', '$2y$10$5mzDwSyR9JdN/bMKnnCy7ut7TSn1QOMMCJUG/dIcXd2x.13E2cTNu', '2025-12-13 02:59:05'),
(10, 'rangga', 'rangga@gmail.com', '$2y$10$WoyOoyJl/XoyAuVbrXnyVe1SpjxVIGPhIHgfUrCK/epsAUWQGclDW', '2026-01-09 04:38:37'),
(11, 'bintang', 'bintang@gmail.com', '$2y$10$sZgHD8MofVxnTopqTx/BvOxp829wP56YJpqo/M1nrko.AIltHrKEG', '2026-01-09 04:39:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_items`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category_product` (`id_category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id_items` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `id_category_product` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
