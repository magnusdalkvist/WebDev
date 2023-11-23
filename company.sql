-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 10:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_users` ()   SELECT * FROM users ORDER BY user_name LIMIT 5$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `the_users_email` VARCHAR(100) CHARSET utf8mb4)   SELECT user_password, user_id, user_name, user_email
FROM users 
WHERE user_email = the_users_email$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `user_employee_fk` bigint(20) UNSIGNED NOT NULL,
  `employee_salaray` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `user_partner_fk` bigint(20) UNSIGNED NOT NULL,
  `partner_geo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(5, 'user'),
(6, 'partner'),
(7, 'employee'),
(8, 'admin'),
(9, 'user'),
(10, 'partner'),
(11, 'employee'),
(12, 'admin'),
(13, 'user'),
(14, 'partner'),
(15, 'employee'),
(16, 'admin'),
(17, 'user'),
(18, 'partner'),
(19, 'employee'),
(20, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `total_users` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`total_users`) VALUES
(4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_last_name` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` varchar(20) NOT NULL,
  `user_created_at` char(10) NOT NULL,
  `user_updated_at` char(10) NOT NULL,
  `user_deleted_at` char(10) NOT NULL,
  `user_is_blocked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_last_name`, `user_email`, `user_address`, `user_password`, `user_role`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `user_is_blocked`) VALUES
(91, 'Carmela', 'Morissette', 'x@x.com', '899 Cassin Vista\nEast Lurline, CA 35652-4079', '$2y$10$1N.1fZvmvCz6UpVmb7Ey3eOVWsvr.6U1GkYazMLlaeuD33jlov48q', 'user', '1696417116', '0', '0', 0),
(92, 'Lonnie', 'Heller', 'reina73@prosacco.biz', '19299 Vanessa Trace\nNew Claudeland, FL 50257', '$2y$10$LHCLmqDy2kyV/xpHz7b1seuZX2VhyxjlDrfMnhorTkHV.Xowl./IC', 'user', '1696417116', '0', '0', 1),
(93, 'Malcolm', 'Barton', 'gschuster@kris.com', '114 Joseph Camp Apt. 808\nLake Ashlee, MD 28326-9108', '$2y$10$gvznwzMSL7qA0BeVPNa/R.EGrn0/XMD9Wt6xKJd6/iaINc31sGwZu', 'user', '1696417116', '0', '0', 0),
(94, 'Katelynn', 'Wilkinson', 'mckenzie.joesph@mcglynn.info', '2494 Sanford Overpass\nLuettgenshire, MO 44993', '$2y$10$kr7tMpgotxbAgR7nwXVktuIfOqj5y95a227usbsaVcK8FGeNRLcHu', 'user', '1696417116', '0', '0', 0),
(95, 'Courtney', 'Wolff', 'delfina.medhurst@hotmail.com', '83738 Prosacco Tunnel Suite 361\nSouth Otisborough, WY 09080-0497', '$2y$10$UonGdMtt//bMVZHce4OMr.edp7b9fWVMzTiyz.jTXp6jIwSsY76ba', 'user', '1696417116', '0', '0', 0),
(96, 'Beau', 'Thompson', 'myron.gottlieb@bauch.com', '8714 Aaron Turnpike\nFranzfurt, UT 70756-0300', '$2y$10$Zdio/OyvfaAYe5rwAfiq5O1a1B8b/gYF0.TQ1lM6aOLQwDq2o7Xg2', 'user', '1696417116', '0', '0', 1),
(97, 'Nathan', 'Conroy', 'bkunde@zulauf.com', '5324 Johnson Trace\nNew Maciehaven, MI 77679', '$2y$10$athjczkiyeJIkeYLlijHHOFTA2GLZljQbmUjZQGSChdQ2HeSJ/FZW', 'user', '1696417116', '0', '0', 1),
(98, 'Roderick', 'Heidenreich', 'wgrant@stark.net', '77356 Verdie Light\nWatersside, CA 35415', '$2y$10$YVEMkp5E7cLOTwXhnBFExuwXHWKhqQcN9CwhABOT0.qO7Y7GQXHVC', 'user', '1696417117', '0', '0', 1),
(99, 'Kacey', 'Hane', 'janis.bernier@hotmail.com', '173 Emil Inlet Suite 201\nWest Tobinland, AZ 38871-2085', '$2y$10$1TjzgannMU8SqU4sP2WGYeh4tLUvWQlRq4KCqnbaFQawv2F1FhmVW', 'user', '1696417117', '0', '0', 0),
(100, 'Ova', 'Mitchell', 'peter06@gmail.com', '841 Franecki Landing Apt. 479\nBrekkeberg, AL 11597', '$2y$10$Xz5ojbuVqeFFIa7WV1K9BeHxeVyPqbw6cIzEC7xX3l7Q1D5xxT0.e', 'user', '1696417117', '0', '0', 1),
(101, 'Marielle', 'Monahan', 'akuvalis@gmail.com', '99286 Layla Meadow\nEast Sophiastad, IA 96293-2365', '$2y$10$EJSxe9rnmdYdO2KBCYl/Hu0qIQkyLGxB922m/1ptUz/3lcyX7G2fm', 'user', '1696417260', '0', '0', 0),
(102, 'Hardy', 'Wolff', 'hintz.meghan@morar.com', '818 Vaughn Land\nEast Mathilde, GA 77361-0928', '$2y$10$2pCfMBp739EIvUGyU5BqT.QlGtNSIZTFBAMS99EGCi.xwPUb58Tx.', 'user', '1696417428', '0', '0', 1),
(103, 'Loyce', 'Turcotte', 'hschowalter@yahoo.com', '10855 Emard Passage\nPort Kade, NH 41610', '$2y$10$zyZT228OjQQXkkKl3p7weuvzE4tEQowLt6hItoiP5ruMTPloBgbpu', 'user', '1696417442', '0', '0', 1),
(104, 'Josianne', 'Conroy', 'toby.jenkins@littel.net', '7171 Tanner Key\nBalistreritown, VT 24891-0736', '$2y$10$9rI2KNlaCQ6OiFtQmMmp5uKhYPOAEJEM1P5B3LmOhhS8raXQIdeFS', 'user', '1696417465', '0', '0', 1),
(105, 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', 0),
(108, 'SantiagoDonoso', 'Schiller', 'sand@kea.dk', '213 Quigley Wall Suite 985\nAdelbertmouth, PA 38055-4023', '$2y$10$FPEcWrryYmy/ToWn.W9no.tsuy7EjyIWcBM/.2A9RQsIvRNOERY7u', 'user', '1696494384', '0', '0', 1);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `increase_user_count` AFTER INSERT ON `users` FOR EACH ROW UPDATE stats
SET	total_users = total_users + 1
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`user_employee_fk`,`employee_salaray`),
  ADD UNIQUE KEY `user_employee_fk` (`user_employee_fk`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD UNIQUE KEY `user_partner_fk` (`user_partner_fk`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD UNIQUE KEY `role_id` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `user_last_name` (`user_last_name`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `user_address` (`user_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`user_employee_fk`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `partners`
--
ALTER TABLE `partners`
  ADD CONSTRAINT `partners_ibfk_1` FOREIGN KEY (`user_partner_fk`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
