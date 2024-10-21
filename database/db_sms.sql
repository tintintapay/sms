-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2024 at 10:42 AM
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
-- Table structure for table `allowances`
--

DROP TABLE IF EXISTS `allowances`;
CREATE TABLE IF NOT EXISTS `allowances` (
  `id` int NOT NULL AUTO_INCREMENT,
  `athlete_id` int NOT NULL,
  `message` text NOT NULL,
  `status` enum('available','received') NOT NULL,
  `created_user` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `allowances`
--

TRUNCATE TABLE `allowances`;
--
-- Dumping data for table `allowances`
--

INSERT INTO `allowances` (`id`, `athlete_id`, `message`, `status`, `created_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, 'Your allowance is now available for collection at the accounting department. Please ensure that you claim it within the next 5 days to avoid any inconvenience. Thank you', 'available', 1, '2024-10-15 11:42:12', '2024-10-15 11:42:12', NULL),
(2, 7, 'Your allowance is now available for collection at the accounting department. Please ensure that you claim it within the next 5 days to avoid any inconvenience. Thank you', 'available', 1, '2024-10-15 11:42:12', '2024-10-15 11:42:12', NULL),
(3, 6, 'Your allowance is now available for collection at the accounting department. Please ensure that you claim it within the next 5 days to avoid any inconvenience. Thank you', 'available', 1, '2024-10-15 11:42:12', '2024-10-15 11:42:12', NULL),
(4, 5, 'Your allowance is now available for collection at the accounting department. Please ensure that you claim it within the next 5 days to avoid any inconvenience. Thank you', 'available', 1, '2024-10-15 11:42:12', '2024-10-15 11:42:12', NULL),
(5, 4, 'Your allowance is now available for collection at the accounting department. Please ensure that you claim it within the next 5 days to avoid any inconvenience. Thank you', 'available', 1, '2024-10-15 11:42:12', '2024-10-15 11:42:12', NULL),
(6, 3, 'Your allowance is now available for collection at the accounting department. Please ensure that you claim it within the next 5 days to avoid any inconvenience. Thank you', 'received', 1, '2024-10-15 11:42:12', '2024-10-15 13:14:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `created_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `announcements`
--

TRUNCATE TABLE `announcements`;
--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `created_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ex quae qui sunt mai', 'Odio dolor facere officiis quibusdam anim veniam, libero voluptate obcaecati est qui sit, natus recusandae. Dicta fuga. Cum eos amet, qui eiusmod nulla suscipit eos, officia voluptatem, ea ut voluptate est optio, qui amet, necessitatibus autem dolore occaecat qui ut velit aut sint harum occaecat sim.', 1, '2024-10-04 04:04:53', '2024-10-04 04:04:53', NULL),
(2, 'Officiis ipsa lauda', 'Id nostrud nulla libero deserunt mollitia iure ad et molestiae voluptatibus aut molestias accusamus non accusamus qui aliqua. Dolor ut rerum fugiat, anim qui vel laboris consequatur? Ducimus, est, voluptas rerum eos, aspernatur nesciunt, autem est, vero irure delectus, repellendus. Dolorem pariatur.', 1, '2024-10-04 04:08:36', '2024-10-04 04:08:36', NULL),
(3, 'Assumenda commodi vo', 'Cum rerum illum, dolores odio consequatur, ab adipisicing perspiciatis, inventore proident, irure consequatur? Sed duis aliqua. Fugit, in pariatur? Facilis reprehenderit, adipisicing tempor voluptate mollitia praesentium non voluptate quam eum exercitation qui qui exercitation ea magnam laudantium, .&#039;alert(&quot;hacked&quot;)', 1, '2024-10-04 04:09:32', '2024-10-04 05:53:20', NULL),
(4, 'Uniform Available', 'Ut excepturi repudiandae adipisci ea sint est, minim temporibus aut ea occaecat magnam consectetur, ea Nam tenetur hic officiis eligendi est sunt, ullam deleniti omnis aperiam necessitatibus consequat. Unde impedit, culpa, deserunt illo perspiciatis, et tempor sit, nesciunt, est aliquip voluptates q.', 1, '2024-10-04 11:44:49', '2024-10-04 11:44:49', NULL),
(5, 'sample', 'Consequuntur distinctio. In placeat, porro odit aute placeat, eligendi consequatur? Minim vero odio cupiditate cillum nemo omnis ut et exercitation laboriosam, in hic error do ad nisi perspiciatis, facere qui nesciunt, odio ex dolorem laborum cillum pariatur. Velit unde ut non incididunt optio, sit .', 2, '2024-10-04 13:21:28', '2024-10-04 13:21:28', NULL),
(6, 'samples', 'Consequuntur distinctio. In placeat, porro odit aute placeat, eligendi consequatur? Minim vero odio cupiditate cillum nemo omnis ut et exercitation laboriosam, in hic error do ad nisi perspiciatis, facere qui nesciunt, odio ex dolorem laborum cillum pariatur. Velit unde ut non incididunt optio, sit .', 2, '2024-10-08 00:44:11', '2024-10-08 00:44:11', NULL),
(7, 'Officia architecto a', 'Aut assumenda aspernatur nostrud iusto explicabo. Aut debitis laborum. Ut dolor reiciendis sit, in hic nulla dolorem consequatur, doloremque saepe voluptatum adipisicing voluptatem voluptas culpa, et rerum voluptate saepe similique et distinctio. Ut delectus, aliquip quibusdam totam sequi aut atque .', 2, '2024-10-09 12:22:24', '2024-10-09 12:22:24', NULL),
(8, 'Officia architecto a', 'sample', 2, '2024-10-09 12:22:41', '2024-10-09 12:22:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `athletes_ratings`
--

DROP TABLE IF EXISTS `athletes_ratings`;
CREATE TABLE IF NOT EXISTS `athletes_ratings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `athlete_id` int NOT NULL,
  `game_id` int NOT NULL,
  `teamwork` int NOT NULL,
  `sportsmanship` int NOT NULL,
  `technical_skills` int NOT NULL,
  `adaptability` int NOT NULL,
  `game_sense` int NOT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `created_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `athletes_ratings`
--

TRUNCATE TABLE `athletes_ratings`;
--
-- Dumping data for table `athletes_ratings`
--

INSERT INTO `athletes_ratings` (`id`, `athlete_id`, `game_id`, `teamwork`, `sportsmanship`, `technical_skills`, `adaptability`, `game_sense`, `remarks`, `created_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, 1, 10, 10, 10, 10, 'sample remarks', 2, '2024-10-08 13:12:04', '2024-10-09 13:46:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_schedules_id` int NOT NULL,
  `athlete_id` int NOT NULL,
  `evaluator_id` int DEFAULT NULL,
  `evaluation_date` datetime DEFAULT NULL,
  `comments` text,
  `contract_date` date DEFAULT NULL,
  `eligibility_form` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tryout_form` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `med_cert` varchar(255) DEFAULT NULL,
  `cor` varchar(255) DEFAULT NULL,
  `grades` varchar(255) DEFAULT NULL,
  `status` enum('submitted','pending','approved','disapproved') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `game_schedules_id` (`game_schedules_id`),
  KEY `athlete_id` (`athlete_id`),
  KEY `evaluator_id` (`evaluator_id`),
  KEY `evaluation_date` (`evaluation_date`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `evaluations`
--

TRUNCATE TABLE `evaluations`;
--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `game_schedules_id`, `athlete_id`, `evaluator_id`, `evaluation_date`, `comments`, `contract_date`, `eligibility_form`, `tryout_form`, `med_cert`, `cor`, `grades`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2024-09-28 06:12:25', '2024-10-01 13:25:20', NULL),
(2, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2024-09-28 06:12:36', '2024-10-01 13:25:37', NULL),
(3, 1, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2024-09-28 06:12:36', '2024-10-01 13:25:37', NULL),
(6, 1, 3, NULL, NULL, NULL, '2024-10-23', '6dacd47880746495f6c988840cde6807.docx', 'ad97e34864e457ccc0fa31fd02736db6.docx', '6c4f18ce92d58cc44185a913443cdaab.docx', '975dafd0ffa007dd8df4af46c5c995cc.docx', '3a8c65fb35c0919596bf8152963307de.docx', 'approved', '2024-09-30 12:33:28', '2024-10-10 14:52:06', NULL),
(10, 3, 6, NULL, NULL, NULL, '2024-10-30', 'ac541824d45e3a3137b4577eb5941b17.docx', 'db1ec21075b3d63b0482e8f91d140866.docx', '5455d48127588525edd235e4f327e120.docx', '2840093df324cec2efe870004309345c.docx', '425d3448d47e9dd3b92cd42585894c34.docx', 'approved', '2024-10-04 02:15:44', '2024-10-10 14:52:00', NULL),
(9, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2024-10-04 02:15:44', '2024-10-04 02:15:44', NULL),
(11, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2024-10-11 15:01:08', '2024-10-13 12:52:26', NULL),
(12, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2024-10-13 10:57:41', '2024-10-13 12:52:28', NULL),
(13, 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2024-10-13 11:45:16', '2024-10-13 12:52:31', NULL),
(14, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2024-10-13 11:47:07', '2024-10-13 12:52:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `game_schedules`
--

DROP TABLE IF EXISTS `game_schedules`;
CREATE TABLE IF NOT EXISTS `game_schedules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_title` varchar(255) NOT NULL,
  `schedule` date NOT NULL,
  `sport` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `status` enum('active','inactive','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'inactive',
  `created_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_user` (`created_user`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `game_schedules`
--

TRUNCATE TABLE `game_schedules`;
--
-- Dumping data for table `game_schedules`
--

INSERT INTO `game_schedules` (`id`, `game_title`, `schedule`, `sport`, `venue`, `status`, `created_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Regional meet', '2024-10-02', 'basket_ball', 'Pearl Sports Arena', 'completed', 2, '2024-09-28 06:12:25', '2024-10-13 12:23:50', NULL),
(3, 'Intramural', '2024-11-02', 'base_ball', 'Gym', 'active', 2, '2024-10-04 02:15:44', '2024-10-11 14:57:16', NULL),
(4, 'Qui impedit fugit ', '2024-11-09', 'basket_ball', 'Court', 'active', 2, '2024-10-11 15:01:08', '2024-10-11 15:50:38', NULL),
(5, 'Pinnacle Match', '2024-10-25', 'basket_ball', 'Metro Sports Plaza', 'completed', 2, '2024-10-13 10:57:41', '2024-10-13 11:50:22', NULL),
(6, 'Victory Showdown', '2024-11-01', 'basket_ball', 'Riverside Sports Complex', 'completed', 2, '2024-10-13 11:45:16', '2024-10-13 11:50:25', NULL),
(7, 'Pro Cup Final', '2025-04-07', 'basket_ball', 'Metro Sports Plaza', 'completed', 2, '2024-10-13 11:47:07', '2024-10-13 11:50:28', NULL);

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
  `code` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `active`, `role`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@admin.com', '$2y$10$IYU34hPsTdMq3m8aiYzyPODAf27lzTqQ6hWHxzvXmKtLgAjICaR8K', 'active', '2024-09-20 12:04:19', '2024-09-20 20:04:37'),
(2, 1, 'coordinator', 'coor@coor.com', '$2y$10$vCsqgCr9HeiT020byWwuUe00LReYNyd1KRwvgLgy1X6t0h62Fx97K', 'active', '2024-09-20 12:05:19', '2024-10-14 20:45:39'),
(3, 1, 'athlete', 'athlete@athlete.com', '$2y$10$d1uYX36StQLJ3XXX2QZUmuV0BpYFYmNA6M5JfBgGfsNXT6EidtKl.', 'active', '2024-09-20 12:17:04', '2024-10-06 20:03:42'),
(4, 1, 'athlete', 'menaqypybe@mailinator.com', '$2y$10$vKjY46S2x7SUPGewgOeG5uasXnGTk2.AJ5QMYG.7c8NjsfaXV4V0m', 'active', '2024-09-20 12:17:26', '2024-09-24 19:28:59'),
(5, 1, 'athlete', 'dehilycic@mailinator.com', '$2y$10$mi/KbBjka09bbiYUntLYI.I6ZJ8ldXFJ5Cw29g3DYpy.m4CLdYJwu', 'active', '2024-09-20 12:17:42', '2024-09-24 19:29:06'),
(6, 1, 'athlete', 'cupymifiw@mailinator.com', '$2y$10$A6Pok/UABm7asEYmWjAnfu4FOixcRw6pQ8ydqm0t443lW8lOH7WpG', 'active', '2024-09-20 12:17:58', '2024-09-24 19:29:13'),
(7, 1, 'athlete', 'roqevapoqu@mailinator.com', '$2y$10$ZVevGrF7Eo.k/VLbrq0E0OR6j.KuJMY4fUWVIBqVexpE.uoghR.5G', 'active', '2024-09-20 12:18:17', '2024-09-21 12:21:34'),
(8, 1, 'athlete', 'jaduvoxydo@mailinator.com', '$2y$10$stGy56bO6MOXbL2sFi648ugM/DlNfLxLx.RPiflr1sxXctmSQJmpm', 'active', '2024-09-20 12:18:40', '2024-09-24 20:57:03'),
(9, 1, 'coordinator', 'qipowy@mailinator.com', '$2y$10$XyJFB520/rgvFztjKCsKGeoSdX61VDcj0OOfTQ6Nnk1LRb2pyH5Nm', 'active', '2024-09-21 08:48:43', '2024-10-14 21:05:37'),
(12, 1, 'athlete', 'bujinuxop@mailinator.com', '$2y$10$G/sVGqFdTx/ors8.lRKDJOvmAmer6Tsj1mPS/AddTlLEsFMnAEX7.', 'pending', '2024-10-10 12:36:28', '2024-10-10 20:36:28');

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
  `birthday` date NOT NULL,
  `sport` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `cor` varchar(255) DEFAULT NULL COMMENT 'Certificate of Registration',
  `psa` varchar(255) DEFAULT NULL COMMENT 'Birth Certificate',
  `medical_cert` varchar(255) DEFAULT NULL COMMENT 'Medical Certification',
  `picture` varchar(255) DEFAULT NULL COMMENT 'Picture',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `user_info`
--

TRUNCATE TABLE `user_info`;
--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `first_name`, `last_name`, `middle_name`, `gender`, `year_level`, `course`, `address`, `school`, `guardian`, `age`, `birthday`, `sport`, `phone_number`, `cor`, `psa`, `medical_cert`, `picture`, `created_at`, `updated_at`) VALUES
(1, 1, 'Roanna', 'Barrett', '', 'male', '', '', 'Omnis accusamus rati', '', '', 30, '2000-06-22', '', '09116935294', NULL, NULL, NULL, NULL, '2024-09-20 12:04:19', '2024-10-10 22:35:46'),
(2, 2, 'Fin', 'Smill', '', 'female', '', '', 'Omnis accusamus rati', '', '', 30, '2000-06-22', '', '09116935294', NULL, NULL, NULL, '4251d39851e791dfcce566816c4488b9.jpg', '2024-09-20 12:05:19', '2024-10-14 20:56:52'),
(3, 3, 'Madaline', 'Barry', 'Abra Eaton', 'male', '2nd', 'Non et nihil et nisi', 'Nemo ipsum ad at ea ', 'Dolor corrupti dolo', 'Dignissimos itaque n', 18, '2000-06-22', 'basket_ball', '09547782036', 'b0108a782ac1628530c2947eaf0da2c1.png', 'f4cab839a8e5bb4ab45928592b6407e8.png', '5a2515728cedf1e41b1da2f6d0beaea6.png', '19da2ac05f73872ed0e004537faf981b.png', '2024-09-20 12:17:04', '2024-10-10 22:35:29'),
(4, 4, 'Bradley', 'Barrera', 'Cynthia Franks', 'male', '1st', 'Quisquam nulla aliqu', 'Pariatur Distinctio', 'In laudantium deser', 'Facilis qui est vol', 42, '2000-06-22', 'basket_ball', '09804430914', '23077630c91d38a5e59436f71c110e9d.png', '2e1f4f143a613b6415940deacdd1cbe4.png', '471b7b2050532af5d19579bcbf21ded5.png', '377563c42206e0642b657595b7dfbe08.png', '2024-09-20 12:17:26', '2024-10-10 22:35:46'),
(5, 5, 'Sopoline', 'Mcgowan', 'Stone Daugherty', 'male', '2nd', 'Molestiae repellendu', 'Laboris ullam odit q', 'Velit elit sit saep', 'Do et neque architec', 31, '2000-06-22', 'base_ball', '09613485704', '25a409fbcb7df98ccdb667fe12a5cbcd.png', '60891d3a4383e96612e97f96c2e9c5f4.png', '709d26dc42a7defeed7cdcffc47aeea2.png', '693f5e0a83a5543880a66b0e6c7568ae.png', '2024-09-20 12:17:42', '2024-10-10 22:35:46'),
(6, 6, 'Lana', 'Harrell', 'Maisie Tanner', 'female', '1st', 'Voluptas quas vero d', 'Sunt enim aperiam i', 'Eligendi qui consequ', 'Aspernatur quia vita', 30, '2000-06-22', 'base_ball', '09133025784', 'd1ff371044f6d9dc6d4b70e110dc5db8.png', 'b938e58e3034d2e3fcb7b6ee7a72f432.png', 'a836b6d275be28fb2706b050a12f6ce0.png', 'cca77c8971a703ae9af42c1069081dff.png', '2024-09-20 12:17:58', '2024-10-10 22:35:46'),
(7, 7, 'Hayley', 'Mccarthy', 'Maryam Coleman', 'male', '5th', 'Qui quidem velit sin', 'Cupidatat porro nequ', 'Dolor tenetur eos c', 'Modi dolor corrupti', 26, '2000-06-22', 'basket_ball', '09363299945', 'dc5d85cfb703e0451da0ac03dc2a02f2.png', 'b7c89fe241bae06b465e9b784c7b7f0c.png', 'a6c2ab88ff46701dcbb0819930799eb5.png', 'fb84e5739f573de66154f18f3bc2c459.png', '2024-09-20 12:18:17', '2024-10-10 22:35:46'),
(8, 8, 'Sonya', 'Oconnor', 'MacKenzie Mendez', 'female', '1st', 'Sed odio sapiente fu', 'Delectus qui et est', 'Sed nihil soluta qua', 'Architecto nemo quo ', 17, '2000-06-22', 'basket_ball', '09171164462', '3a0fabaa3e95bc15b3946c8069a2c20b.png', '41907b505a85676f820eac7909f52f8f.png', '1e275a23be7e21fdb8f6a8d598c532f7.png', '94556f33f94ba5573d16c95ca703e45d.png', '2024-09-20 12:18:40', '2024-10-10 22:35:46'),
(9, 9, 'Maryam', 'Chan', 'Lane Bridges', 'male', '', '', 'Quo qui sed molestia', '', '', 18, '2000-06-22', '', '09167025106', NULL, NULL, NULL, 'a0f695a7d44891ca7e34a2facf0a6ef8.png', '2024-09-21 08:48:43', '2024-10-14 21:05:37'),
(10, 12, 'Hamish', 'Wagner', 'Hayfa Tillman', 'male', '2nd', 'Quo aut eveniet est', 'Suscipit laboris fac', 'In autem nulla reici', 'Minima libero expedi', 25, '2000-06-22', 'swimming', '09699733268', '5dc073477b86d8e99a6e922ee7bfec4f.pdf', 'e7af1a4f81ddc3d162b43269600d8960.pdf', '461ab4a716e85726420b65e0a7d16fd7.pdf', '674d61ff2660b1711c00bbb35f5de10e.jpg', '2024-10-10 12:36:28', '2024-10-10 22:35:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
