-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 30 jan 2023 om 10:39
-- Serverversie: 5.7.36
-- PHP-versie: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbblogoop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `body` text,
  PRIMARY KEY (`id`),
  KEY `idx_comments_photo_id` (`photo_id`),
  KEY `idx_comments_author` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `photo_id`, `author`, `body`) VALUES
(1, 19, 'Tom', 'Tom geeft commentaar op blog item 19'),
(2, 19, 'Tom', 'dit is een test'),
(3, 19, 'Tom', 'dit is een test'),
(4, 19, 'Tim', 'test'),
(5, 19, 'Thijs', 'in t\\\\\\\"e house'),
(6, 19, 'fdjlkdsjlm', 'dsflkjmjdsmljds'),
(7, 19, 'fdjlkdsjlm', 'dsflkjmjdsmljds'),
(8, 19, 'fdjlkdsjlm', 'dsflkjmjdsmljds');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `alternate_text` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `photos`
--

INSERT INTO `photos` (`id`, `title`, `description`, `filename`, `type`, `size`, `alternate_text`, `deleted_at`) VALUES
(19, 'Titel blogitem 19', 'description blog item 19', 'anonymous2023_01_23-14-06-34.png', 'image/png', 153333, 'bcd', NULL),
(20, 'dsfdsf', 'dsfdsf', 'gratis-stockfoto-honden2023_01_24-08-59-27.jpg', 'image/jpeg', 60754, 'dsfsdf', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `user_image`, `deleted_at`) VALUES
(1, 'admin', '123456', 'tom', 'IKKE', 'funavatar.jpg', NULL),
(2, 'tims', '123456', 'tims', 'vanhouttes', 'funavatar2.jpg', NULL),
(4, 'test', 'test', 'test', 'test', '', NULL),
(6, 'test2', 'test2', 'test2', 'test2', '', NULL),
(7, 'test2', 'test2', 'test2', 'test2', '', NULL),
(8, 'Toppiesssss', 'kjhjk', 'dsfdsfdsfsdfdsfdsdsfdfsdsfdsf', 'dddsfsdf', 'anonymous2023_01_23-14-06-342023_01_25-09-09-56.png', NULL),
(9, 'tester', 'tester', 'tester', 'tester', 'gratis-stockfoto-honden2023_01_24-08-59-272023_01_25-09-15-50.jpg', NULL),
(10, 'dfdsf', 'dsfdsf', 'dsfdsf', 'dsdfs', 'gratis-stockfoto-honden2023_01_24-08-59-272023_01_25-09-34-59.jpg', NULL),
(11, 'cvcxv', 'cxvcvx', 'cxcvx', 'cxcvx', 'gratis-stockfoto-honden2023_01_24-08-59-272023_01_25-09-35-40.jpg', NULL);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
