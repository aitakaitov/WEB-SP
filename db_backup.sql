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

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id_article`, `approved`, `text`, `title`, `images`, `article_author`, `review1`, `review2`, `review3`, `introduction_image`, `reviewer1`, `reviewer2`, `reviewer3`) VALUES
(21, 1, '                <p style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Trebuchet MS&amp;quot;,&amp;quot;Geneva CE&amp;quot;,lucida,sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; margin-bottom: 8px; margin-left: 0px; margin-right: 0px; margin-top: 0px; orphans: 2; text-align: justify; text-decoration: none; text-indent: 20px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam commodo dui eget wisi. Nunc auctor. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Vestibulum fermentum tortor id mi. Integer vulputate sem a nibh rutrum consequat. Maecenas sollicitudin. Curabitur sagittis hendrerit ante. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Nunc auctor. Morbi scelerisque luctus velit. Nulla quis diam. Aenean fermentum risus id tortor. Ut tempus purus at lorem. Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede. Curabitur sagittis hendrerit ante. Morbi imperdiet, mauris ac auctor dictum, nisl ligula egestas nulla, et sollicitudin sem purus in lacus. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Nulla non lectus sed nisl molestie malesuada.\r\n</p><span style=\'display: inline !important; float: none; background-color: rgb(252, 249, 232); color: rgb(0, 0, 0); font-family: \"Trebuchet MS\",\"Geneva CE\",lucida,sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\'>\r\n</span><p style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Trebuchet MS&amp;quot;,&amp;quot;Geneva CE&amp;quot;,lucida,sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; margin-bottom: 8px; margin-left: 0px; margin-right: 0px; margin-top: 0px; orphans: 2; text-align: justify; text-decoration: none; text-indent: 20px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">\r\n	In convallis. Praesent id justo in neque elementum ultrices. Mauris metus. Nullam eget nisl. Integer malesuada. Praesent id justo in neque elementum ultrices. Integer lacinia. Aliquam in lorem sit amet leo accumsan lacinia. Nullam faucibus mi quis velit. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.\r\n</p>            ', 'Lorem Ipsum dolor', '/web/Views/img/1d9aebbdbab11c201e1296adc21ca4c71c4dacb6.jpg,/web/Views/img/e5dd5aec8ea76ea4a4b51e1c26ea672f1c19a13e.jpg,/web/Views/img/4cf2f3e1c23cbd36f90af952a3a8d6bd949c790d.jpg,/web/Views/img/7342f7569cceada3aa4d16c426fbc9ac1901a5f1.jpg', 6, 22, 20, 21, '/web/Views/img/1d9aebbdbab11c201e1296adc21ca4c71c4dacb6.jpg', 11, 7, 10),
(22, 1, '<p style=\"margin-right: 0px; margin-bottom: 8px; margin-left: 0px; text-indent: 20px; font-family: &quot;Trebuchet MS&quot;, &quot;Geneva CE&quot;, lucida, sans-serif; font-size: 13px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam quis quam. Etiam posuere lacus quis dolor. Fusce tellus. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Curabitur vitae diam non enim vestibulum interdum. Duis risus. Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit. In enim a arcu imperdiet malesuada. Integer lacinia. Vestibulum fermentum tortor id mi. Aliquam ante. Nam sed tellus id magna elementum tincidunt. Curabitur vitae diam non enim vestibulum interdum. Vivamus ac leo pretium faucibus. Nunc dapibus tortor vel mi dapibus sollicitudin.</p><p style=\"margin-right: 0px; margin-bottom: 8px; margin-left: 0px; text-indent: 20px; font-family: &quot;Trebuchet MS&quot;, &quot;Geneva CE&quot;, lucida, sans-serif; font-size: 13px; text-align: justify;\">Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Vestibulum fermentum tortor id mi. Vivamus porttitor turpis ac leo. Duis condimentum augue id magna semper rutrum. Fusce nibh. Pellentesque sapien. Maecenas ipsum velit, consectetuer eu lobortis ut, dictum at dui. Integer tempor. Vivamus ac leo pretium faucibus. Fusce wisi.</p>', 'Lorem ipsum', '/web/Views/img/52db65a01b88a5b4f7026247f73190e015ab95eb.jpg,/web/Views/img/4094e215e87bc3016bbbab57528d69eae49d0872.jpg,/web/Views/img/4a196c952a8026a810440e22b1c8372b6aadf800.jpg,/web/Views/img/235eda115e03a8f8ad111c14a93589fac417c5cb.jpg', 15, 28, 24, 25, '/web/Views/img/52db65a01b88a5b4f7026247f73190e015ab95eb.jpg', 12, 13, 14),
(23, 1, '<b>lorem ipsum</b>', 'sdfghjkl', '/web/Views/img/1d9aebbdbab11c201e1296adc21ca4c71c4dacb6.jpg,/web/Views/img/e5dd5aec8ea76ea4a4b51e1c26ea672f1c19a13e.jpg,/web/Views/img/4cf2f3e1c23cbd36f90af952a3a8d6bd949c790d.jpg,/web/Views/img/7342f7569cceada3aa4d16c426fbc9ac1901a5f1.jpg,/web/Views/img/b0470b6edc4fb2a11ce9b7264104be582d9e99cd.jpg,', 17, 29, 30, 31, '/web/Views/img/1d9aebbdbab11c201e1296adc21ca4c71c4dacb6.jpg', 12, 13, 14);

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

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id_review`, `review_author`, `text`, `text_points`, `photo_points`, `location_points`) VALUES
(20, 7, 'test4 says yes', 1, 2, 3),
(21, 10, '                        test7 says yes', 4, 5, 6),
(22, 11, '                        test 10 approves', 7, 8, 9),
(24, 13, '                        approved', 6, 7, 8),
(25, 14, '                        approved', 1, 5, 4),
(28, 12, '                        Text here...\r\n                    ', 10, 10, 10),
(29, 12, 'approved', 10, 10, 10),
(30, 13, '                        Text here...\r\n                    ', 1, 1, 1),
(31, 14, '                        Text here...\r\n                    ', 2, 2, 2);

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nick`, `name`, `surname`, `email`, `password`, `privilege`, `active`) VALUES
(5, 'test2', 'test', 'test', 'aitakaitov@gmail.com', 'test2', 'admin', 0),
(6, 'test3', 'test', 'test', 'aitakaitov@gmail.com', 'test3', 'reviewer', 0),
(7, 'test4', 'test4', 'test4', 'a@g.com', 'test4', 'reviewer', 0),
(9, 'A', 'A', 'A', 'A@A.A', 'a', 'user', 0),
(10, 'test7', 'test7', 'test7', 't@t.t', 'test7', 'reviewer', 0),
(11, 'test10', 'test', 'deset', 'test10@test10.test10', 'test10', 'reviewer', 0),
(12, 'reviewer1', 'reviewer1', 'reviewer', 'a@a.a', 'reviewer1', 'reviewer', 1),
(13, 'reviewer2', 'reviewer2', 'reviewer', 'a@a.a', 'reviewer2', 'reviewer', 1),
(14, 'reviewer3', 'reviewer3', 'reviewer', 'a@a.a', 'reviewer3', 'reviewer', 1),
(15, 'user1', 'user1', 'user ', 'a@a.aaa', 'user1', 'user', 1),
(16, 'admin', 'admin', 'admin', 'a@a.a', 'admin', 'admin', 1),
(17, 'user2', 'user2', 'user2', 'a@a.a', 'user2', 'user', 1);

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
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
