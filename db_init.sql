-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2019 at 02:17 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conference_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id_article` int(11) NOT NULL,
  `approved` tinyint(4) DEFAULT NULL,
  `text` varchar(3000) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `images` varchar(350) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `article_author` int(11) DEFAULT NULL,
  `review1` int(11) DEFAULT NULL,
  `review2` int(11) DEFAULT NULL,
  `review3` int(11) DEFAULT NULL,
  `introduction_image` varchar(80) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `reviewer1` int(11) DEFAULT NULL,
  `reviewer2` int(11) DEFAULT NULL,
  `reviewer3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id_review` int(11) NOT NULL,
  `review_author` int(11) DEFAULT NULL,
  `text` varchar(500) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `text_points` int(11) DEFAULT -1,
  `photo_points` int(11) DEFAULT -1,
  `location_points` int(11) DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nick` varchar(20) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `name` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `surname` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `privilege` varchar(10) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `article_author` (`article_author`),
  ADD KEY `review1` (`review1`),
  ADD KEY `review2` (`review2`),
  ADD KEY `review3` (`review3`),
  ADD KEY `reviewer1` (`reviewer1`),
  ADD KEY `reviewer2` (`reviewer2`),
  ADD KEY `reviewer3` (`reviewer3`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `review_author` (`review_author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `article_author` FOREIGN KEY (`article_author`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`reviewer1`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`reviewer2`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`reviewer3`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `review1` FOREIGN KEY (`review1`) REFERENCES `reviews` (`id_review`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `review2` FOREIGN KEY (`review2`) REFERENCES `reviews` (`id_review`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `review3` FOREIGN KEY (`review3`) REFERENCES `reviews` (`id_review`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `review_author` FOREIGN KEY (`review_author`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
