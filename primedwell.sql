-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2026 at 11:53 AM
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
-- Database: `primedwell`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `seen`) VALUES
(1, 14, 0, 'hi', '2026-03-10 18:11:24', 0),
(2, 14, 0, '', '2026-03-10 18:11:25', 0),
(3, 14, 0, '', '2026-03-10 18:11:25', 0),
(4, 14, 0, 'hi i am neha', '2026-03-10 18:11:40', 0),
(5, 14, 0, '', '2026-03-10 18:11:43', 0),
(6, 14, 0, 'hlo', '2026-03-10 18:11:56', 0),
(7, 14, 0, 'hi', '2026-03-10 18:26:14', 0),
(8, 14, 0, '', '2026-03-10 18:26:16', 0),
(9, 14, 0, '', '2026-03-10 18:26:16', 0),
(10, 14, 0, '', '2026-03-10 18:26:16', 0),
(11, 14, 0, '', '2026-03-10 18:26:17', 0),
(12, 14, 0, 'hi', '2026-03-10 18:31:41', 0),
(13, 15, 0, 'hi', '2026-03-11 08:44:20', 0),
(14, 15, 0, '', '2026-03-11 08:44:20', 0),
(15, 15, 0, '', '2026-03-11 08:44:21', 0),
(16, 15, 0, '', '2026-03-11 08:44:21', 0),
(17, 15, 0, '', '2026-03-11 08:44:21', 0),
(18, 14, 15, 'hi', '2026-03-11 14:48:07', 1),
(19, 14, 15, 'hi', '2026-03-11 14:59:57', 1),
(20, 14, 15, 'hi', '2026-03-11 15:00:07', 1),
(21, 14, 14, 'hi', '2026-03-11 15:03:15', 1),
(22, 14, 14, 'hi', '2026-03-11 15:03:19', 1),
(23, 14, 14, 'hi', '2026-03-11 15:03:20', 1),
(24, 15, 14, 'hlo', '2026-03-11 15:16:28', 1),
(25, 15, 14, 'i\'m neha ,i want a 3bhk flat under 25k to 30k', '2026-03-11 15:17:21', 1),
(26, 14, 15, 'ok i will help you to find your dream property', '2026-03-11 15:42:58', 1),
(27, 15, 14, 'ok ', '2026-03-11 15:53:31', 1),
(28, 15, 14, 'hlo', '2026-03-11 16:19:05', 1),
(29, 14, 15, 'yes', '2026-03-11 16:21:20', 1),
(30, 15, 14, 'ok', '2026-03-11 16:24:03', 1),
(31, 14, 15, 'hi', '2026-03-11 16:52:39', 1),
(32, 15, 14, 'hlo ,Do you want any help?', '2026-03-11 16:53:34', 1),
(33, 14, 15, 'yes', '2026-03-11 16:55:09', 1),
(34, 14, 14, 'hlo , i want a flat in gomti nagar. is there is any 1bhk available', '2026-03-12 18:25:52', 0),
(35, 14, 14, 'hlo , i want a flat of 3bhk ,is there is any flat available', '2026-03-12 18:47:04', 0),
(36, 14, 14, 'hlo ,I want a 3bhk under 40k, Is there is any property available ', '2026-03-12 19:00:03', 0),
(37, 14, 14, 'hlo ,i want a flat of 2bhk under 20k ,Is there is any flat available?', '2026-03-12 19:06:15', 0),
(38, 14, 14, 'hlo', '2026-03-12 19:15:18', 0),
(39, 14, 14, 'hlo\r\n', '2026-03-12 19:15:57', 0),
(40, 14, 14, 'hlo', '2026-03-12 19:16:59', 0),
(41, 14, 14, 'hlo', '2026-03-12 19:18:38', 0),
(42, 15, 14, 'hi', '2026-03-15 14:38:11', 1),
(43, 14, 15, 'hlo', '2026-03-15 14:57:38', 1),
(44, 15, 14, 'i want a property of 2bhk', '2026-03-15 15:09:08', 1),
(45, 15, 14, 'i want a property of 2bhk', '2026-03-15 15:09:08', 1),
(46, 15, 14, 'i want a property of 2bhk', '2026-03-15 15:09:08', 1),
(47, 14, 15, 'ok i will help you', '2026-03-15 15:10:23', 1),
(48, 14, 15, 'ok i will help you', '2026-03-15 15:10:23', 1),
(49, 14, 15, 'ok i will help you', '2026-03-15 15:10:23', 1),
(50, 14, 15, 'hlo', '2026-03-15 15:17:34', 1),
(51, 14, 15, 'hlo', '2026-03-15 15:17:34', 1),
(52, 14, 15, 'hlo', '2026-03-15 15:17:34', 1),
(53, 15, 14, 'Hi', '2026-03-23 12:50:14', 1),
(54, 15, 14, 'Hi', '2026-03-23 12:50:14', 1),
(55, 15, 14, 'Hi', '2026-03-23 12:50:14', 1),
(56, 14, 15, 'hlo', '2026-03-23 12:50:47', 1),
(57, 14, 15, 'hlo', '2026-03-23 12:50:47', 1),
(58, 14, 15, 'hlo', '2026-03-23 12:50:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(100) NOT NULL,
  `bhk` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `rent` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `location`, `bhk`, `area`, `rent`, `description`, `image`, `created_at`, `owner_id`) VALUES
(16, 'Elegant 1BHK Apartment', 'Gomti Nagar', '1BHK', '500 sqft', 8000.00, 'Cozy 1BHK apartment in Gomti Nagar, near shopping malls and public transport. Ideal for small families or bachelors. The apartment is fully ventilated and has modern amenities including a small balcony, security, and power backup.', 'property1.jpg', '2025-11-20 11:24:41', 14),
(17, 'Spacious 2BHK Flat', 'Hazratganj', '2BHK', '1100 sqft', 15000.00, 'Well-ventilated 2BHK flat located in the heart of Hazratganj. The flat has two spacious bedrooms, a modular kitchen, and a balcony with city view. Close to schools, markets, and offices, making it perfect for families.', 'property2.jpg', '2025-11-20 11:24:41', 14),
(18, 'Luxury 3BHK Apartment', 'Aliganj', '3BHK', '1500 sqft', 25000.00, 'Modern 3BHK apartment in Aliganj with premium interiors, a modular kitchen, attached bathrooms, and dedicated parking. The complex has 24/7 security, lift facility, and a well-maintained garden. Ideal for families looking for comfort and style.', 'property3.jpg', '2025-11-20 11:24:41', 14),
(19, 'Affordable 1BHK Flat', 'Indira Nagar', '1BHK', '550 sqft', 9000.00, 'Budget-friendly 1BHK flat in Indira Nagar with all basic amenities. Safe neighborhood, easy access to markets, schools, and public transport. Suitable for small families or working professionals.', 'property4.jpg', '2025-11-20 11:24:41', 14),
(20, '2BHK Flat with Garden', 'Vikas Nagar', '2BHK', '1200 sqft', 16000.00, '2BHK flat in Vikas Nagar with a private garden. The apartment offers spacious living areas, modern kitchen, and 24/7 security. Located in a peaceful area with good connectivity to the city center.', 'property5.jpg', '2025-11-20 11:24:41', 14),
(21, 'Independent 3BHK House', 'Gomti Nagar', '3BHK', '1800 sqft', 27000.00, 'Spacious independent 3BHK house in Gomti Nagar with two floors, parking space, terrace, and a small garden. Perfect for large families seeking privacy and comfort. Close to schools, offices, and hospitals.', 'property6.jpg', '2025-11-20 11:24:41', 14),
(22, 'Compact Studio Apartment', 'Rajajipuram', 'Studio', '400 sqft', 7000.00, 'Studio apartment in Rajajipuram ideal for bachelors or single professionals. Compact yet fully functional with kitchenette, bathroom, and basic furnishings. Safe locality with good public transport connectivity.', 'property7.jpg', '2025-11-20 11:24:41', 14),
(23, 'Modern 2BHK Flat', 'Gomti Nagar', '2BHK', '1150 sqft', 15500.00, 'Fully furnished 2BHK apartment in Gomti Nagar with modular kitchen, lift, parking, and security. The flat is close to shopping centers, schools, and hospitals, offering convenience and comfort for small families.', 'property8.jpg', '2025-11-20 11:24:41', 14),
(24, 'Luxury 3BHK Villa', 'Vikas Nagar', '3BHK', '2000 sqft', 30000.00, '3BHK villa in Vikas Nagar with swimming pool, private garden, covered parking, and modern interiors. Ideal for families looking for luxury living. The villa is in a peaceful locality with excellent connectivity.', 'property9.jpg', '2025-11-20 11:24:41', 14),
(25, 'Cozy 1BHK Flat', 'Hazratganj', '1BHK', '500 sqft', 8500.00, '1BHK flat in Hazratganj with modern amenities, well-ventilated rooms, and a balcony. Perfect for singles or small families. The area is well-connected with markets, offices, and public transport.', 'property10.jpg', '2025-11-20 11:24:41', 14),
(26, 'Spacious 2BHK Apartment', 'Indira Nagar', '2BHK', '1250 sqft', 16500.00, '2BHK apartment in Indira Nagar with spacious bedrooms, modular kitchen, balcony, and security. The apartment is close to schools, parks, and shopping centers, making it convenient for families.', 'property11.jpg', '2025-11-20 11:24:41', 14),
(27, 'Independent 3BHK House', 'Aliganj', '3BHK', '1900 sqft', 28000.00, 'Independent 3BHK house in Aliganj with ample parking, terrace, and garden. Large living and dining areas with modern interiors. Safe neighborhood, close to offices, schools, and hospitals.', 'property12.jpg', '2025-11-20 11:24:41', 14),
(28, 'Affordable Studio', 'Rajajipuram', 'Studio', '450 sqft', 7500.00, 'Compact studio in Rajajipuram for students or young professionals. Includes kitchenette, bathroom, and basic furnishings. Affordable rent with easy access to public transport and markets.', 'property13.jpg', '2025-11-20 11:24:41', 14),
(29, 'Modern 2BHK Flat', 'Gomti Nagar', '2BHK', '1180 sqft', 15800.00, '2BHK flat in Gomti Nagar with modern interiors, lift, security, and covered parking. Well-connected locality with nearby shopping centers, schools, and hospitals. Perfect for small families.', 'property14.jpg', '2025-11-20 11:24:41', 14),
(30, 'Luxury 3BHK Apartment', 'Vikas Nagar', '3BHK', '1700 sqft', 29000.00, 'Premium 3BHK apartment in Vikas Nagar with balcony, parking, modular kitchen, and 24/7 security. The apartment is located in a peaceful area with good connectivity to main city roads.', 'property15.jpg', '2025-11-20 11:24:41', 14),
(31, '2 BHK Modern Apartment', 'Gomti Nagar, Lucknow', '2', '', 15000.00, 'Spacious 2 BHK apartment available for rent in Gomti Nagar. \r\nThe property has 2 bedrooms, 1 hall, kitchen, and balcony. \r\nLocated near market, school, and metro station. \r\n24/7 water supply and parking available.', 'home01.jpg', '2026-03-10 16:19:58', 14);

-- --------------------------------------------------------

--
-- Table structure for table `property_ratings`
--

CREATE TABLE `property_ratings` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_ratings`
--

INSERT INTO `property_ratings` (`id`, `property_id`, `user_id`, `rating`, `created_at`) VALUES
(1, 30, 14, 5, '2026-03-12 18:46:00'),
(2, 31, 14, 4, '2026-03-15 16:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `tenant_requests`
--

CREATE TABLE `tenant_requests` (
  `id` int(11) NOT NULL,
  `tenant_name` varchar(100) DEFAULT NULL,
  `tenant_email` varchar(100) DEFAULT NULL,
  `tenant_phone` varchar(15) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `owner_response` text DEFAULT NULL,
  `status` enum('pending','responded') DEFAULT 'pending',
  `property_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `request_type` enum('general','property') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant_requests`
--

INSERT INTO `tenant_requests` (`id`, `tenant_name`, `tenant_email`, `tenant_phone`, `message`, `owner_response`, `status`, `property_id`, `owner_id`, `request_type`, `created_at`) VALUES
(1, 'TEST1', 'test1234@gmail.com', '7232983615', 'hlo i AM PRIYA I WANT A PROPERTY OF 1 BHK UNDER 5000RS', NULL, 'responded', 1, 1, 'general', '2026-01-29 16:46:43'),
(2, 'TEST', 'test123@gmail.com', '7348278568', 'HLO I AM NEH YADAV WILL YOU HELP ME FIND MY HOME', NULL, 'responded', NULL, NULL, 'general', '2026-01-29 16:50:01'),
(3, 'sanju', 'sy457383@gmail.com', '7232983615', 'hi\r\n', NULL, 'responded', 1, 1, 'general', '2026-02-12 05:51:02'),
(4, 'NEHA YADAV', 'yneha0834@gmail.com', '7232983615', 'hlo i am neha , i want a property og 3bhk under 20k', NULL, 'responded', 0, 0, 'general', '2026-03-10 15:44:01'),
(5, 'NEHA YADAV', 'yneha0834@gmail.com', '7232983615', 'hlo ', NULL, 'responded', 16, 0, 'general', '2026-03-10 16:29:51'),
(6, 'NEHA YADAV', 'yneha0834@gmail.com', '7232983615', 'hlo i\'m Neha yadav , I want a property of 2bhk under 15k', 'yes\\', 'responded', 31, 14, 'general', '2026-03-11 09:47:14'),
(7, 'NEHA YADAV', 'yneha0834@gmail.com', '7348278568', 'HI ,I\'M NEHA , WANT A FLAT OF 1BHK', 'YES , 1BHK FLAT IS AVAILALE', 'responded', 16, 14, 'general', '2026-03-13 16:25:52'),
(8, 'Ar. Singh', 'ro001234ck@gmail.com', '7379769792', 'hey buddy', NULL, 'responded', NULL, NULL, 'general', '2026-03-16 17:29:23'),
(9, 'NEHA YADAV', 'yneha0834@gmail.com', '7232983615', 'hlo', 'yes', 'responded', 16, 14, 'general', '2026-03-16 17:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','owner','tenant') NOT NULL,
  `last_active` datetime DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `last_active`, `profile_pic`) VALUES
(2, 'Owner User', 'owner@example.com', '$2y$10$WqBZxQd/KjF8xQx0Kq2KaeWZOup7x7KZVps4ZP/qLfMC7bI0n9bN6', 'owner', NULL, 'default.png'),
(3, 'Tenant User', 'tenant@example.com', '$2y$10$WqBZxQd/KjF8xQx0Kq2KaeWZOup7x7KZVps4ZP/qLfMC7bI0n9bN6', 'tenant', NULL, 'default.png'),
(4, 'TEST', 'test123@gmail.com', '$2y$10$VMK1n.eu6uAFHBH/2ia8hub9YWUfmEMmULEbqlH0LTlYlLzaKCqhi', 'owner', NULL, 'default.png'),
(5, 'TEST1', 'test1234@gmail.com', '$2y$10$hWBIgq3CYOXy8DfzesAXlu6g5JJYRdEcLRba7ZsD0hhAA04YMGFEa', 'tenant', NULL, 'default.png'),
(10, 'sanju', 'sy457383@gmail.com', '$2y$10$3iLCkxx.9dQdFBtkSdc6nuneSjboTTCbkZ9w.1O2V122PcRBj56wy', 'tenant', NULL, 'default.png'),
(13, 'TEST', 'test1235@gmail.com', '$2y$10$NtqwrZZapia0XJOUBWu9Q.6aSlqDg.a/bbTzrc/VkCKqUqMnQN4Xm', 'tenant', NULL, 'default.png'),
(14, 'hane', 'hane123@gmail.com', '$2y$10$UJYbKwo2v7YsAnmAGiqmW.I5iPzUF2Gt2FRF6igkRRgrl.YK7T4sy', 'owner', '2026-03-23 18:27:40', 'default.png'),
(15, 'NEHA YADAV', 'yneha0834@gmail.com', '$2y$10$10g/Eyd6IaqFFcqBzABXi.IdUUd1tSw1FiBHVo5zvLPUVHqxsihd2', 'tenant', '2026-04-10 14:04:30', 'default.png'),
(16, 'Admin', 'admin@gmail.com', '123456', 'admin', NULL, 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_ratings`
--
ALTER TABLE `property_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_requests`
--
ALTER TABLE `tenant_requests`
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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `property_ratings`
--
ALTER TABLE `property_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tenant_requests`
--
ALTER TABLE `tenant_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
