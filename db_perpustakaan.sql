-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2023 at 04:25 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` bigint(5) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(50) NOT NULL,
  `cover_file` varchar(255) DEFAULT NULL,
  `book_file` varchar(255) DEFAULT NULL,
  `quantity` int(5) NOT NULL DEFAULT 0,
  `category_id` bigint(5) UNSIGNED NOT NULL,
  `user_id` bigint(5) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `description`, `cover_file`, `book_file`, `quantity`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'test1', 'description', NULL, NULL, 0, 1, 1, '2023-07-23 21:24:19', '2023-07-23 21:24:19'),
(2, 'test2', 'description', NULL, NULL, 0, 2, 2, '2023-07-23 21:24:19', '2023-07-23 21:24:19'),
(3, 'test3', 'description', NULL, NULL, 0, 3, 1, '2023-07-23 21:24:19', '2023-07-23 21:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(5) UNSIGNED NOT NULL,
  `category_name` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Novel', '2023-07-23 21:23:18', '2023-07-23 21:23:18'),
(2, 'Majalah', '2023-07-23 21:23:18', '2023-07-23 21:23:18'),
(3, 'Kamus', '2023-07-23 21:23:18', '2023-07-23 21:23:18'),
(4, 'Komik', '2023-07-23 21:23:18', '2023-07-23 21:23:18'),
(5, 'Manga', '2023-07-23 21:23:18', '2023-07-23 21:23:18'),
(6, 'Ensiklopedia', '2023-07-23 21:23:18', '2023-07-23 21:23:18'),
(7, 'Biografi', '2023-07-23 21:23:18', '2023-07-23 21:23:18'),
(8, 'Naskah', '2023-07-23 21:23:18', '2023-07-23 21:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(29, '2023-07-22-181621', 'App\\Database\\Migrations\\Roles', 'default', 'App', 1690122186, 1),
(30, '2023-07-22-181628', 'App\\Database\\Migrations\\Users', 'default', 'App', 1690122187, 1),
(31, '2023-07-22-181633', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1690122187, 1),
(32, '2023-07-22-181641', 'App\\Database\\Migrations\\Books', 'default', 'App', 1690122187, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` bigint(5) UNSIGNED NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-07-23 21:23:17', '2023-07-23 21:23:17'),
(2, 'user', '2023-07-23 21:23:17', '2023-07-23 21:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(5) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `role_id` bigint(5) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `user_name`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '$2y$10$XHUtlz6V4iNcpZi5IQSaUeMnZ.4LGojdBo7uLjDdVLrEeF/uyeZ.i', 'Admin', 1, '2023-07-23 21:24:19', '2023-07-23 21:24:19'),
(2, 'hafiz@user.com', '$2y$10$dXjQsz7hj3bu1EQiSU9JwekvFPrZvHclLFbBe3pVxgZi/b4GkVVt2', 'Hafiz Juansyah Putra', 2, '2023-07-23 21:24:19', '2023-07-23 21:24:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `user_id_fk_users` (`user_id`),
  ADD KEY `category_id_fk_categories` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id_fk_roles` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` bigint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `category_id_fk_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_id_fk_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
