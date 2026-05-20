-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 12, 2026 at 03:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seaolympus`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `image`, `date_posted`, `created_at`, `updated_at`) VALUES
(8, 'Happy Birthday', 'Happy  Birthday! What an incredible milestone, years of memories, wisdom, love, and stories that have shaped everyone lucky enough to know you. May today be filled with warmth, laughter, and the deep appreciation you so richly deserve. Your life is a true gift, and your presence continues to inspire us all. Wishing you a day full of joy and a year surrounded by love.', 'announcements/hSxT9IJf5zXcFt3PNlqizS1ehVdtBpi2edaru0vJ.jpg', '2026-02-09 06:07:17', '2026-02-08 22:07:17', '2026-02-26 19:08:59'),
(9, 'Valentine\'s Day', 'A heartfelt celebration of love and admiration, typically marked by exchanging thoughtful gifts, cards, and warm, tender moments with partners, friends, and family on February 14th.', 'announcements/MCL7hFeLfQrY4n2dQcsCnQzMeFhlh1xLGfOGPFnI.png', '2026-02-12 08:08:43', '2026-02-12 00:08:43', '2026-02-26 19:08:07'),
(10, 'Fun Day', 'Sea Olympus Marketing Inc. Funday is a special day dedicated to celebrating teamwork, unity, and the hardworking individuals behind the company’s success. This exciting event brings employees together for a day filled with fun games, team-building activities, laughter, and unforgettable memories.', 'announcements/hb0rNItoBmhQZMlQ3HGsmSRKQC7mVckwSicvQJbh.jpg', '2026-02-12 08:46:29', '2026-02-12 00:46:29', '2026-02-26 19:07:51'),
(16, 'Year End Party', 'A Year End Party is a joyful celebration held during the holiday season, typically in December, to bring people together in the spirit of warmth, gratitude, and togetherness. Whether hosted at home, in the office, or at a festive venue, it’s an occasion filled with laughter, delicious food, music, and sparkling decorations.', 'announcements/3aVLqy418gk1eDWoirfbmsJeDJAv2n85PMEMjHbq.png', '2026-02-13 04:59:09', '2026-02-12 20:59:09', '2026-02-12 20:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `birthday_corner`
--

CREATE TABLE `birthday_corner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `birthdate` date NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `birthday_corner`
--

INSERT INTO `birthday_corner` (`id`, `employee_id`, `birthdate`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, 23, '2026-02-27', 'birthday_profiles/ADAV7UISqehfOVXcZbisoscH6xE7abQnYQgfRgpN.jpg', '2026-02-24 19:05:23', '2026-02-24 19:05:23'),
(2, 25, '2026-03-01', 'birthday_profiles/Om4Xh8IW3tTwCubOaoHm4xh5l4n8XYESx5FKAZgW.jpg', '2026-02-24 19:06:44', '2026-02-24 19:06:44'),
(3, 24, '2026-02-24', NULL, '2026-02-24 19:12:29', '2026-02-24 19:12:29'),
(4, 12, '2026-02-01', NULL, '2026-02-24 19:15:29', '2026-02-24 19:15:29'),
(6, 15, '2026-02-17', NULL, '2026-02-24 19:16:01', '2026-02-24 19:16:01'),
(7, 11, '2026-02-07', NULL, '2026-02-24 20:24:35', '2026-02-24 20:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `company_holidays`
--

CREATE TABLE `company_holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `type` enum('holiday','non_operating') NOT NULL DEFAULT 'holiday',
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_holidays`
--

INSERT INTO `company_holidays` (`id`, `date`, `type`, `title`, `description`, `created_at`, `updated_at`) VALUES
(31, '2026-02-14', 'holiday', 'Valentines\' Day', NULL, '2026-02-12 17:37:08', '2026-02-12 20:59:12'),
(32, '2026-02-17', 'non_operating', 'Lunar New Year', NULL, '2026-02-12 17:37:20', '2026-02-12 17:37:20'),
(36, '2026-02-18', 'non_operating', 'Ramadan', NULL, '2026-02-12 19:31:40', '2026-02-12 19:31:40'),
(37, '2026-02-25', 'holiday', 'People Power Anniversary', NULL, '2026-02-12 19:32:01', '2026-02-12 20:57:58'),
(38, '2026-03-20', 'holiday', 'Eid al-Fitr', NULL, '2026-02-12 19:33:57', '2026-02-12 19:33:57'),
(39, '2026-04-02', 'holiday', 'Maundy Thursday', NULL, '2026-02-12 19:35:07', '2026-02-12 19:35:07'),
(40, '2026-04-03', 'holiday', 'Good Friday', NULL, '2026-02-12 19:36:05', '2026-02-12 19:36:05'),
(42, '2026-04-04', 'holiday', 'Black Saturday', NULL, '2026-02-12 20:24:26', '2026-02-12 20:24:26'),
(43, '2026-05-01', 'holiday', 'Labor Day', NULL, '2026-02-12 21:28:41', '2026-02-12 21:28:41'),
(44, '2026-06-12', 'holiday', 'Independence Day', NULL, '2026-02-12 21:29:14', '2026-02-12 21:29:14'),
(45, '2026-08-31', 'holiday', 'National Heroes Day', NULL, '2026-02-12 21:33:21', '2026-02-12 21:33:21'),
(46, '2026-08-21', 'non_operating', 'Ninoy Aquino Day', NULL, '2026-02-12 21:33:48', '2026-02-12 21:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Marketing', 'Handles branding and promotions', '2026-02-14 00:25:55', '2026-02-14 00:25:55'),
(2, 'Sales', 'Handles company revenue and client acquisition', '2026-02-14 00:25:55', '2026-02-14 00:25:55'),
(3, 'Human Resources', 'Employee management and recruitment', '2026-02-14 00:25:55', '2026-02-14 00:25:55'),
(4, 'MIS', 'Technical support and infrastructure', '2026-02-14 00:25:55', '2026-02-14 00:25:55'),
(5, 'Finance', 'Accounting and financial operations', '2026-02-14 00:25:55', '2026-02-14 00:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `salary` decimal(12,2) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `first_name`, `last_name`, `email`, `phone`, `position`, `hire_date`, `salary`, `status`, `created_at`, `updated_at`) VALUES
(2, 4, 'Jane', 'Doe', 'janedoe@seaolympus.com', '09123459876', 'IT Support', '2026-02-13', 20000.00, 'active', '2026-02-13 17:04:13', '2026-02-13 17:09:10'),
(3, 1, 'John', 'Doe', 'john.doe@seaolympus.com', '09123456789', 'Marketing Manager', '2024-01-10', 45000.00, 'active', '2026-02-14 01:08:34', '2026-02-14 01:08:34'),
(4, 2, 'Jane', 'Smith', 'jane.smith@seaolympus.com', '09987654321', 'Sales Executive', '2023-06-15', 40000.00, 'active', '2026-02-14 01:08:34', '2026-02-14 01:08:34'),
(5, 1, 'Alice', 'Johnson', 'alice.johnson@seaolympus.com', '09234567890', 'Content Specialist', '2024-02-05', 38000.00, 'active', '2026-02-14 01:08:34', '2026-02-14 01:08:34'),
(6, 3, 'Bob', 'Williams', 'bob.williams@seaolympus.com', '09345678901', 'Finance Analyst', '2023-08-20', 42000.00, 'active', '2026-02-14 01:08:34', '2026-02-14 01:08:34'),
(7, 2, 'Eve', 'Davis', 'eve.davis@seaolympus.com', '09456789012', 'Sales Associate', '2024-01-25', 36000.00, 'active', '2026-02-14 01:08:34', '2026-02-14 01:08:34'),
(8, 1, 'Juan', 'Dela Cruz', 'juan.delacruz@seaolympus.com', '09171234567', 'Marketing Assistant', '2024-02-01', 35000.00, 'active', '2026-02-14 02:43:10', '2026-02-14 02:43:10'),
(9, 2, 'Maria', 'Santos', 'maria.santos@seaolympus.com', '09281234567', 'Sales Associate', '2023-07-20', 38000.00, 'active', '2026-02-14 02:43:10', '2026-02-14 02:43:10'),
(10, 1, 'Jose', 'Ramos', 'jose.ramos@seaolympus.com', '09391234567', 'Content Specialist', '2024-01-15', 36000.00, 'active', '2026-02-14 02:43:10', '2026-02-14 02:43:10'),
(11, 3, 'Ana', 'Lopez', 'ana.lopez@seaolympus.com', '09401234567', 'HR Coordinator', '2022-11-05', 40000.00, 'active', '2026-02-14 02:43:10', '2026-02-14 02:43:10'),
(12, 2, 'Mark', 'Reyes', 'mark.reyes@seaolympus.com', '09501234567', 'Sales Manager', '2023-03-12', 45000.00, 'active', '2026-02-14 02:43:10', '2026-02-14 02:43:10'),
(13, 1, 'Kristine', 'Cruz', 'kristine.cruz@seaolympus.com', '09601234567', 'Marketing Analyst', '2024-01-28', 37000.00, 'active', '2026-02-14 02:43:10', '2026-02-14 02:43:10'),
(14, 3, 'Miguel', 'Torres', 'miguel.torres@seaolympus.com', '09701234567', 'HR Specialist', '2022-12-10', 39000.00, 'active', '2026-02-14 02:43:10', '2026-02-14 02:43:10'),
(15, 2, 'Lea', 'Villanueva', 'lea.villanueva@seaolympus.com', '09801234567', 'Account Executive', '2023-05-18', 41000.00, 'active', '2026-02-14 02:43:10', '2026-02-14 02:43:10'),
(16, 1, 'Patrick', 'Garcia', 'patrick.garcia@seaolympus.com', '09901234567', 'Content Writer', '2024-02-10', 34000.00, 'active', '2026-02-14 02:43:10', '2026-02-14 02:43:10'),
(17, 3, 'Grace', 'De Guzman', 'grace.deguzman@seaolympus.com', '09011234567', 'Recruiter', '2022-10-20', 40000.00, 'active', '2026-02-14 02:43:10', '2026-02-14 02:43:10'),
(18, 5, 'Ramon', 'Del Rosario', 'ramon.delrosario@seaolympus.com', '09171234568', 'Finance Manager', '2023-03-01', 55000.00, 'active', '2026-02-14 02:45:16', '2026-02-14 02:45:16'),
(19, 5, 'Cristina', 'Navarro', 'cristina.navarro@seaolympus.com', '09271234568', 'Accountant', '2023-04-15', 40000.00, 'active', '2026-02-14 02:45:16', '2026-02-14 02:45:16'),
(20, 5, 'Miguel', 'Cordero', 'miguel.cordero@seaolympus.com', '09371234568', 'Financial Analyst', '2023-05-10', 42000.00, 'active', '2026-02-14 02:45:16', '2026-02-14 02:45:16'),
(21, 5, 'Liza', 'Mendoza', 'liza.mendoza@seaolympus.com', '09471234568', 'Payroll Specialist', '2023-06-01', 39000.00, 'active', '2026-02-14 02:45:16', '2026-02-14 02:45:16'),
(22, 5, 'Erwin', 'Reyes', 'erwin.reyes@seaolympus.com', '09571234568', 'Budget Officer', '2023-07-05', 41000.00, 'active', '2026-02-14 02:45:16', '2026-02-14 02:45:16'),
(23, 4, 'Jonas', 'Santos', 'jonas.santos@seaolympus.com', '09671234568', 'MIS Manager', '2023-02-20', 50000.00, 'active', '2026-02-14 02:45:16', '2026-02-14 02:45:16'),
(24, 4, 'Karen', 'Cruz', 'karen.cruz@seaolympus.com', '09771234568', 'System Administrator', '2023-03-12', 42000.00, 'active', '2026-02-14 02:45:16', '2026-02-17 17:06:16'),
(25, 4, 'Alvin', 'Torres', 'alvin.torres@seaolympus.com', '09871234568', 'Network Engineer', '2023-04-01', 43000.00, 'active', '2026-02-14 02:45:16', '2026-02-14 02:45:16'),
(26, 4, 'Monica', 'De Leon', 'monica.deleon@seaolympus.com', '09971234568', 'Database Administrator', '2023-05-15', 44000.00, 'active', '2026-02-14 02:45:16', '2026-02-14 02:45:16'),
(27, 4, 'Patrick', 'Villanueva', 'patrick.villanueva@seaolympus.com', '09021234568', 'IT Support Specialist', '2023-06-20', 38000.00, 'active', '2026-02-14 02:45:16', '2026-02-14 02:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--
-- Error reading structure for table seaolympus.transfers: #1932 - Table &#039;seaolympus.transfers&#039; doesn&#039;t exist in engine
-- Error reading data for table seaolympus.transfers: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `seaolympus`.`transfers`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@email.com', 'admin', '$2y$12$Y0pOV64Lj6SSzeDKTll/e.Is85ERhzdIjWcGdZn4ZoiqpzQtilrtC', NULL, '2026-02-08 17:52:51', '2026-02-08 17:52:51'),
(4, 'MIS Officer', 'mis@email.com', 'admin', '$2y$12$jIYbnPofB80Sr6g7Sdbq/.0nfVkDZ8hONC6J.ahu9g/usNKUGzZYK', NULL, '2026-02-11 16:52:47', '2026-02-11 16:52:47'),
(5, 'HR Mod', 'hrmod@email.com', 'moderator', '$2y$12$H5Q.CNWFlaDJTmEXVUK3K.2IfRd9yHIAVSVaTBBlDTFib/l70YDym', NULL, '2026-02-11 18:37:27', '2026-02-11 18:37:27'),
(11, 'Levin', 'torregosalevin347@gmail.com', 'admin', '$2y$12$cXuKFToFkCgWFg9y3Lz4UuSd8Q9SUx4ck3cptjWzWhFR.H1JjfMkC', 'YSkD5i5tFXGLLKFilkwdxaXvel232OtWZsBX5PR2Gsf62TUbGwE5vSmgyupz', '2026-02-13 16:39:39', '2026-02-13 16:39:39'),
(12, 'Jino Estillore', 'jinoestillore@email.com', 'user', '$2y$12$2DR9gdTdZ2UZc0b66K3oHuPRna1P5pXL8Ttf8vGg3YtxF8ny7flua', NULL, '2026-02-17 19:04:29', '2026-02-17 19:04:29'),
(14, 'User 1', 'user1@email.com', 'user', '$2y$12$neOezDuNfsBGzqW5TU/Wp.3ZG0l2j5NxGwhOYk/Q.2rw15V5AGNxq', NULL, '2026-02-17 19:12:06', '2026-02-17 19:12:06'),
(18, 'Mock up Admin', 'mockupadmin@email.com', 'admin', '$2y$12$GVIPx7QesO8De7p4Fe2bG.BV6FHmkvihI21qGGHRmVdA/TM6ESL2e', NULL, '2026-02-25 18:37:16', '2026-02-25 18:37:16'),
(21, 'Moderator', 'moderator@email.com', 'moderator', '$2y$12$LOPjbW3Bn4cSySJKZdKEJet2IWhsFI6a.3Ab2xIP171IvId6vZc8W', NULL, '2026-02-25 18:46:34', '2026-02-25 18:46:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `birthday_corner`
--
ALTER TABLE `birthday_corner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_employee_birthday` (`employee_id`);

--
-- Indexes for table `company_holidays`
--
ALTER TABLE `company_holidays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_employee_department` (`department_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `birthday_corner`
--
ALTER TABLE `birthday_corner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company_holidays`
--
ALTER TABLE `company_holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `birthday_corner`
--
ALTER TABLE `birthday_corner`
  ADD CONSTRAINT `fk_birthday_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_employee_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
