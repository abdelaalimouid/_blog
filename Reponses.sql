-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2023 at 11:56 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `Reponses`
--

CREATE TABLE `Reponses` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `response` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Reponses`
--

INSERT INTO `Reponses` (`id`, `user_id`, `question_id`, `response`, `date`) VALUES
(6, 8, 4, 'Violet and blue light have the shortest wavelengths and red light has the longest. Therefore, blue light is scattered more than red light and the sky appears blue during the day.', '2023-11-21 23:49:25'),
(7, 8, 5, 'A cloudless sky in the daytime, appears blue to the human eye.', '2023-11-21 23:53:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Reponses`
--
ALTER TABLE `Reponses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Reponses`
--
ALTER TABLE `Reponses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Reponses`
--
ALTER TABLE `Reponses`
  ADD CONSTRAINT `Reponses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Reponses_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;