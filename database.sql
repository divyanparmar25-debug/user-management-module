-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2026 at 09:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('ADMIN','OPERATOR') NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@test.com', '$2y$10$PbgdDbxjz43x0PrExFbUtu6ZdUMtZQ/V.ikO9vDgyjJouvz75Rhsq', 'ADMIN', 'ACTIVE', '2026-09-23 21:16:58', '2026-09-23 21:16:58'),
(2, 'Operator', 'operator@test.com', '$2y$10$ApPzT9d3QNaT6dLlvqFASe/2yIOpNdBoyE/Mef4i6MhXdN4R3favO', 'OPERATOR', 'ACTIVE', '2026-09-23 21:16:58', '2026-09-23 21:16:58'),
(3, 'Divya', 'divya@test.com', '$2y$10$1X9SI2KopEKqAWRgXZ11guEfYYqtGDS3XxM3LecCueCV32vpJGzs6', 'ADMIN', 'ACTIVE', '2026-09-23 22:55:25', '2026-09-23 22:55:25'),
(4, 'TestO', 'test@gmail.com', '$2y$10$9AIaMJCvlAKWD1y7dXjVZ.TAKbBfNQYkEMqGaRn1AHfCRUfGOMb6m', 'OPERATOR', 'INACTIVE', '2026-09-23 23:01:58', '2026-09-23 23:49:59'),
(5, 'John', 'john@test.com', '$2y$10$7Kai7aT8QSN9HYGBeSXhVOsJN7wHTGnWlKQ630aQRcOAngXnEHcnu', 'ADMIN', 'INACTIVE', '2026-09-24 00:36:20', '2026-09-24 00:36:20'),
(6, 'Riya', 'riya@test.com', '$2y$10$SCpqQ1XAYFKGs.oOkLl69.qTEBcbrI19AxWMFFnQA0SrnNC1t4Zue', 'OPERATOR', 'INACTIVE', '2026-09-24 00:36:47', '2026-09-24 00:36:47'),
(7, 'Ritika', 'ritika@test.com', '$2y$10$EDO9g1AIkZfZ292HZkwbJ.Uiay5UtR2mh2H/xxj2HISciDYw/vJKa', 'ADMIN', 'ACTIVE', '2026-09-24 00:37:09', '2026-09-24 00:37:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
