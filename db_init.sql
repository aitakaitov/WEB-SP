-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Čtv 12. pro 2019, 13:44
-- Verze serveru: 5.7.26
-- Verze PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `conference_db`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `approved` tinyint(4) DEFAULT NULL,
  `text` varchar(3000) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `images` varchar(250) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `article_author` int(11) DEFAULT NULL,
  `review1` int(11) DEFAULT NULL,
  `review2` int(11) DEFAULT NULL,
  `review3` int(11) DEFAULT NULL,
  `introduction_image` varchar(60) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `reviewer1` int(11) DEFAULT NULL,
  `reviewer2` int(11) DEFAULT NULL,
  `reviewer3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_article`),
  KEY `article_author` (`article_author`),
  KEY `review1` (`review1`),
  KEY `review2` (`review2`),
  KEY `review3` (`review3`),
  KEY `reviewer1` (`reviewer1`),
  KEY `reviewer2` (`reviewer2`),
  KEY `reviewer3` (`reviewer3`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id_review` int(11) NOT NULL AUTO_INCREMENT,
  `review_author` int(11) DEFAULT NULL,
  `points` float DEFAULT NULL,
  `text` varchar(500) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id_review`),
  KEY `review_author` (`review_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(20) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `name` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `surname` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `privilege` varchar(10) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `articles`
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
-- Omezení pro tabulku `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `review_author` FOREIGN KEY (`review_author`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
