-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 06:50 PM
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
-- Database: `createx`
--
CREATE DATABASE IF NOT EXISTS `createx` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `createx`;

-- --------------------------------------------------------

--
-- Table structure for table `artefacts`
--

CREATE TABLE `artefacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `artisan_id` int(11) NOT NULL,
  `date_created` date DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `dimensions` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) DEFAULT 1,
  `sold` int(11) NOT NULL,
  `click` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artefacts`
--

INSERT INTO `artefacts` (`id`, `name`, `description`, `artist`, `artisan_id`, `date_created`, `material`, `dimensions`, `image_url`, `price`, `category`, `date_added`, `quantity`, `sold`, `click`) VALUES
(1, 'asdf', 'asdf', 'rajesh kumar', 2, '2024-12-01', 'rajesh kumar', '10cm 20cm 30cm', 'http://localhost/projects/createX%2024/new/src/artefacts_1.jpg', 234.00, 'decorative product ', '2024-12-09 07:19:51', 12, 0, 1),
(2, 'asdf', 'asdf', 'rajesh kumar', 2, '2024-12-03', 'asdf', '10cm 20cm 30cm', 'http://localhost/projects/createX%2024/new/src/artefacts_1.jpg', 124.00, 'asdfdecorative product ', '2024-12-09 07:21:10', 12, 0, 0),
(3, 'test', 'test', 'rajesh kumar', 2, '2024-12-04', 'wood', '10cm 20cm 30cm', 'http://localhost/projects/createX%2024/new/src/artefacts_3.jpg', 124.00, 'decorative product ', '2024-12-09 09:50:59', 10, 1, 0),
(4, 'music artist', 'A wooden decorative item of music artist.', 'yash', 4, '0000-00-00', 'wood', '50cm, 20cm, 20cm', 'http://localhost/projects/createX%2024/new/artefacts/artefacts_img/4.jpg', 250.00, 'decorative product ', '2024-12-11 16:48:15', 12, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `artisans`
--

CREATE TABLE `artisans` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pin_code` varchar(20) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive','closed','banned') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artisans`
--

INSERT INTO `artisans` (`id`, `username`, `first_name`, `last_name`, `birthdate`, `gender`, `email`, `phone`, `address`, `city`, `state`, `pin_code`, `profile_image`, `specialization`, `biography`, `website`, `date_added`, `status`) VALUES
(4, 'yash', 'yash', 'bhai', '2001-12-01', 'male', 'yash@gmail.com', 1234567890, 'pure poad, pratap nagar', 'bhilwara', 'Rajasthan', '311001', 'http://localhost/projects/createX%2024/new/profile/31.png', 'pottery ', 'I am a pottery maker in Bhilwara.', 'https://potterybhilwara.in', '2024-12-11 16:30:15', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `option_a` text NOT NULL,
  `option_b` text NOT NULL,
  `option_c` text NOT NULL,
  `option_d` text NOT NULL,
  `correct_option` char(1) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `description`, `status`) VALUES
(1, 'The term \'Kala-Purusha\' in Indian aesthetics refers to which concept in traditional art and architecture?', 'The divine artist', 'The cosmic time', 'The sculptor\'s soul', 'The eternal beauty', 'B', 'Kala-Purusha\' refers to the cosmic time in Indian aesthetics, symbolizing the concept of time and its impact on the creation and destruction of art and architecture.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reward_use_history`
--

CREATE TABLE `reward_use_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `reward_point` int(11) NOT NULL,
  `last_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `pin_code` int(6) NOT NULL,
  `state` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `community` int(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive','banned','closed') NOT NULL,
  `quiz_answered` tinyint(1) NOT NULL DEFAULT 1,
  `reward_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `first_name`, `last_name`, `birthdate`, `gender`, `pin_code`, `state`, `profile_image`, `updated_at`, `created_at`, `community`, `status`, `quiz_answered`, `reward_points`) VALUES
(31, 'yash', 'yash@gmail.com', '1234567890', '212ab9a46f19fa2dcfc7bad48a301b7bb39f2499403a577fad4f780cc38bf913', 'yash', 'bhai', '2001-12-01', 'male', 311001, 'Rajasthan', 'http://localhost/projects/createX%2024/new/profile/profile_img.png', '2024-12-11 17:40:49', '2024-12-11 14:09:02', 1, 'active', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artefacts`
--
ALTER TABLE `artefacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artisans`
--
ALTER TABLE `artisans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward_use_history`
--
ALTER TABLE `reward_use_history`
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
-- AUTO_INCREMENT for table `artefacts`
--
ALTER TABLE `artefacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `artisans`
--
ALTER TABLE `artisans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reward_use_history`
--
ALTER TABLE `reward_use_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
