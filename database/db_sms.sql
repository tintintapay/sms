-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 24, 2024 at 03:46 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sms`
--
CREATE DATABASE IF NOT EXISTS `db_sms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_sms`;

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_schedules_id` int NOT NULL,
  `athlete_id` int NOT NULL,
  `evaluator_id` int NOT NULL,
  `evaluation_date` datetime NOT NULL,
  `comments` text,
  `status` enum('Pending','Accepted','Denied') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `game_schedules_id` (`game_schedules_id`),
  KEY `athlete_id` (`athlete_id`),
  KEY `evaluator_id` (`evaluator_id`),
  KEY `evaluation_date` (`evaluation_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `evaluations`
--

TRUNCATE TABLE `evaluations`;
-- --------------------------------------------------------

--
-- Table structure for table `game_schedules`
--

DROP TABLE IF EXISTS `game_schedules`;
CREATE TABLE IF NOT EXISTS `game_schedules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_title` varchar(255) NOT NULL,
  `schedule` datetime NOT NULL,
  `sport` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Inactive',
  `created_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_user` (`created_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `game_schedules`
--

TRUNCATE TABLE `game_schedules`;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `active` int NOT NULL DEFAULT '1' COMMENT '1:true, 0:false',
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `active`, `role`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@admin.com', '$2y$10$IYU34hPsTdMq3m8aiYzyPODAf27lzTqQ6hWHxzvXmKtLgAjICaR8K', 'active', '2024-09-20 12:04:19', '2024-09-20 20:04:37'),
(2, 1, 'coordinator', 'coor@coor.com', '$2y$10$IYU34hPsTdMq3m8aiYzyPODAf27lzTqQ6hWHxzvXmKtLgAjICaR8K', 'active', '2024-09-20 12:05:19', '2024-09-20 20:05:37'),
(3, 1, 'athlete', 'huxamal@mailinator.com', '$2y$10$d1uYX36StQLJ3XXX2QZUmuV0BpYFYmNA6M5JfBgGfsNXT6EidtKl.', 'active', '2024-09-20 12:17:04', '2024-09-21 15:51:36'),
(4, 1, 'athlete', 'menaqypybe@mailinator.com', '$2y$10$vKjY46S2x7SUPGewgOeG5uasXnGTk2.AJ5QMYG.7c8NjsfaXV4V0m', 'pending', '2024-09-20 12:17:26', '2024-09-20 20:17:26'),
(5, 1, 'athlete', 'dehilycic@mailinator.com', '$2y$10$mi/KbBjka09bbiYUntLYI.I6ZJ8ldXFJ5Cw29g3DYpy.m4CLdYJwu', 'pending', '2024-09-20 12:17:42', '2024-09-20 20:17:42'),
(6, 1, 'athlete', 'cupymifiw@mailinator.com', '$2y$10$A6Pok/UABm7asEYmWjAnfu4FOixcRw6pQ8ydqm0t443lW8lOH7WpG', 'pending', '2024-09-20 12:17:58', '2024-09-20 20:17:58'),
(7, 1, 'athlete', 'roqevapoqu@mailinator.com', '$2y$10$ZVevGrF7Eo.k/VLbrq0E0OR6j.KuJMY4fUWVIBqVexpE.uoghR.5G', 'active', '2024-09-20 12:18:17', '2024-09-21 12:21:34'),
(8, 1, 'athlete', 'jaduvoxydo@mailinator.com', '$2y$10$stGy56bO6MOXbL2sFi648ugM/DlNfLxLx.RPiflr1sxXctmSQJmpm', 'deleted', '2024-09-20 12:18:40', '2024-09-21 13:50:00'),
(9, 1, 'coordinator', 'jecawes@mailinator.com', '$2y$10$esPk47x2EdJ1GJyUwOq5duLMUt4QJu9IyF6pkQh2rIIkeW2yuI1R.', 'inactive', '2024-09-21 08:48:43', '2024-09-21 16:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `gender` varchar(6) NOT NULL,
  `year_level` varchar(10) NOT NULL,
  `course` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `guardian` varchar(50) NOT NULL,
  `age` int NOT NULL,
  `sport` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `cor` varchar(255) DEFAULT NULL COMMENT 'Certificate of Registration',
  `psa` varchar(255) DEFAULT NULL COMMENT 'Birth Certificate',
  `medical_cert` varchar(255) DEFAULT NULL COMMENT 'Medical Certification',
  `picture` varchar(255) DEFAULT NULL COMMENT 'Picture',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `user_info`
--

TRUNCATE TABLE `user_info`;
--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `first_name`, `last_name`, `middle_name`, `gender`, `year_level`, `course`, `address`, `school`, `guardian`, `age`, `sport`, `phone_number`, `cor`, `psa`, `medical_cert`, `picture`, `created_at`, `updated_at`) VALUES
(1, 1, 'Roanna', 'Barrett', '', 'male', '', '', 'Omnis accusamus rati', '', '', 30, '', '09116935294', NULL, NULL, NULL, NULL, '2024-09-20 12:04:19', '2024-09-20 20:05:13'),
(2, 2, 'Fin', 'Smill', '', 'male', '', '', 'Omnis accusamus rati', '', '', 30, '', '09116935294', NULL, NULL, NULL, NULL, '2024-09-20 12:05:19', '2024-09-20 20:10:45'),
(3, 3, 'Madaline', 'Barry', 'Abra Eaton', 'male', '2nd', 'Non et nihil et nisi', 'Nemo ipsum ad at ea ', 'Dolor corrupti dolo', 'Dignissimos itaque n', 18, 'soccer', '09547782036', 'b0108a782ac1628530c2947eaf0da2c1.png', 'f4cab839a8e5bb4ab45928592b6407e8.png', '5a2515728cedf1e41b1da2f6d0beaea6.png', '19da2ac05f73872ed0e004537faf981b.png', '2024-09-20 12:17:04', '2024-09-23 18:55:25'),
(4, 4, 'Bradley', 'Barrera', 'Cynthia Franks', 'male', '1st', 'Quisquam nulla aliqu', 'Pariatur Distinctio', 'In laudantium deser', 'Facilis qui est vol', 42, 'basket_ball', '09804430914', '23077630c91d38a5e59436f71c110e9d.png', '2e1f4f143a613b6415940deacdd1cbe4.png', '471b7b2050532af5d19579bcbf21ded5.png', '377563c42206e0642b657595b7dfbe08.png', '2024-09-20 12:17:26', '2024-09-23 18:55:33'),
(5, 5, 'Sopoline', 'Mcgowan', 'Stone Daugherty', 'male', '2nd', 'Molestiae repellendu', 'Laboris ullam odit q', 'Velit elit sit saep', 'Do et neque architec', 31, 'base_ball', '09613485704', '25a409fbcb7df98ccdb667fe12a5cbcd.png', '60891d3a4383e96612e97f96c2e9c5f4.png', '709d26dc42a7defeed7cdcffc47aeea2.png', '693f5e0a83a5543880a66b0e6c7568ae.png', '2024-09-20 12:17:42', '2024-09-23 18:55:39'),
(6, 6, 'Lana', 'Harrell', 'Maisie Tanner', 'female', '1st', 'Voluptas quas vero d', 'Sunt enim aperiam i', 'Eligendi qui consequ', 'Aspernatur quia vita', 30, 'base_ball', '09133025784', 'd1ff371044f6d9dc6d4b70e110dc5db8.png', 'b938e58e3034d2e3fcb7b6ee7a72f432.png', 'a836b6d275be28fb2706b050a12f6ce0.png', 'cca77c8971a703ae9af42c1069081dff.png', '2024-09-20 12:17:58', '2024-09-23 18:55:48'),
(7, 7, 'Hayley', 'Mccarthy', 'Maryam Coleman', 'male', '5th', 'Qui quidem velit sin', 'Cupidatat porro nequ', 'Dolor tenetur eos c', 'Modi dolor corrupti', 26, 'basket_ball', '09363299945', 'dc5d85cfb703e0451da0ac03dc2a02f2.png', 'b7c89fe241bae06b465e9b784c7b7f0c.png', 'a6c2ab88ff46701dcbb0819930799eb5.png', 'fb84e5739f573de66154f18f3bc2c459.png', '2024-09-20 12:18:17', '2024-09-23 18:55:53'),
(8, 8, 'Sonya', 'Oconnor', 'MacKenzie Mendez', 'female', '1st', 'Sed odio sapiente fu', 'Delectus qui et est', 'Sed nihil soluta qua', 'Architecto nemo quo ', 17, 'basket_ball', '09171164462', '3a0fabaa3e95bc15b3946c8069a2c20b.png', '41907b505a85676f820eac7909f52f8f.png', '1e275a23be7e21fdb8f6a8d598c532f7.png', '94556f33f94ba5573d16c95ca703e45d.png', '2024-09-20 12:18:40', '2024-09-23 18:55:57'),
(9, 9, 'Rudyard', 'Burch', 'Montana Pena', 'female', '', '', 'Nesciunt ut dolorem', '', '', 35, '', '09291659067', NULL, NULL, NULL, 'a0f695a7d44891ca7e34a2facf0a6ef8.png', '2024-09-21 08:48:43', '2024-09-21 16:48:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
