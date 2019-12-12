-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Čtv 12. pro 2019, 13:43
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `articles`
--

INSERT INTO `articles` (`id_article`, `approved`, `text`, `title`, `images`, `article_author`, `review1`, `review2`, `review3`, `introduction_image`, `reviewer1`, `reviewer2`, `reviewer3`) VALUES
(3, 1, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse sagittis ultrices augue. Integer malesuada. Duis viverra diam non justo. Etiam egestas wisi a erat. Aliquam ante. Aenean placerat. Aliquam in lorem sit amet leo accumsan lacinia. Fusce consectetuer risus a nunc. Phasellus et lorem id felis nonummy placerat. Aliquam erat volutpat. In sem justo, commodo ut, suscipit at, pharetra vitae, orci. Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Mauris metus.</p><p>Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Nulla quis diam. Fusce tellus. Morbi scelerisque luctus velit. Mauris tincidunt sem sed arcu. Aenean placerat. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Sed convallis magna eu sem. Suspendisse sagittis ultrices augue. Aliquam in lorem sit amet leo accumsan lacinia.</p>', 'LOREM IPSUM', 'Views/img/3-0.jpg,Views/img/3-1.jpg,Views/img/3-2.jpg,Views/img/3-3.jpg,Views/img/3-4.jpg', 2, 1, 2, 3, 'Views/img/header-image.jpg', 5, 6, 7),
(22, 0, '<p style=\"margin-right: 0px; margin-bottom: 8px; margin-left: 0px; text-indent: 20px; font-family: &quot;Trebuchet MS&quot;, &quot;Geneva CE&quot;, lucida, sans-serif; font-size: 13px; text-align: justify;\"><span style=\"font-family: Helvetica;\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus rhoncus. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Curabitur bibendum justo non orci. Etiam bibendum elit eget erat. Vivamus ac leo pretium faucibus. Nulla quis diam. Aenean placerat. Praesent id justo in neque elementum ultrices. Proin mattis lacinia justo. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Aliquam erat volutpat. Quisque tincidunt scelerisque libero. Fusce nibh. Et harum quidem rerum facilis est et expedita distinctio. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat.</span></p><p style=\"margin-right: 0px; margin-bottom: 8px; margin-left: 0px; text-indent: 20px; font-family: &quot;Trebuchet MS&quot;, &quot;Geneva CE&quot;, lucida, sans-serif; font-size: 13px; text-align: justify;\"><span style=\"font-family: Helvetica;\">Maecenas aliquet accumsan leo. Sed ac dolor sit amet purus malesuada congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer imperdiet lectus quis justo. Aliquam erat volutpat. Maecenas aliquet accumsan leo. Praesent vitae arcu tempor neque lacinia pretium. Vestibulum fermentum tortor id mi. Praesent dapibus. Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit. Morbi leo mi, nonummy eget tristique non, rhoncus non leo. Nulla pulvinar eleifend sem. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Donec quis nibh at felis congue commodo. Curabitur sagittis hendrerit ante.</span></p><p style=\"margin-right: 0px; margin-bottom: 8px; margin-left: 0px; text-indent: 20px; font-family: &quot;Trebuchet MS&quot;, &quot;Geneva CE&quot;, lucida, sans-serif; font-size: 13px; text-align: justify;\"><span style=\"font-family: Helvetica;\">&lt;script&gt;alert(\"OK\");&lt;/script&gt;</span></p>', 'Test article from test10', '', 11, 20, 21, 22, NULL, 6, 7, 10);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `reviews`
--

INSERT INTO `reviews` (`id_review`, `review_author`, `points`, `text`) VALUES
(1, 5, 8, 'Very nice'),
(2, 6, 4, 'Very nice'),
(3, 7, 3, 'Very nice'),
(19, 5, 5, '                        Text here...100'),
(20, 6, 5, 'test 3 says OK'),
(21, 7, 10, '                        Test 4 says OK'),
(22, 10, 1, '<p>                        test7 says OK</p>');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id_user`, `nick`, `name`, `surname`, `email`, `password`, `privilege`, `active`) VALUES
(2, 'test', 'testAdmin', 'test', 'test', 'test', 'admin', 1),
(5, 'test2', 'test', 'test', 'aitakaitov@gmail.com', 'test2', 'admin', 1),
(6, 'test3', 'test', 'test', 'aitakaitov@gmail.com', 'test3', 'reviewer', 1),
(7, 'test4', 'test4', 'test4', 'a@g.com', 'test4', 'reviewer', 1),
(9, 'A', 'A', 'A', 'A@A.A', 'a', 'user', 0),
(10, 'test7', 'test7', 'test7', 't@t.t', 'test7', 'reviewer', 1),
(11, 'test10', 'test', 'deset', 'test10@test10.test10', 'test10', 'user', 1);

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
