-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 18 Mars 2018 à 12:05
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `tchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_message` int(11) NOT NULL,
  `id_person` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_message` (`id_message`),
  KEY `id_person` (`id_person`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`id`, `id_message`, `id_person`) VALUES
(1, 7, 2),
(2, 8, 1),
(3, 9, 2),
(4, 12, 6),
(5, 13, 6),
(6, 14, 6),
(7, 15, 6),
(8, 16, 6),
(9, 17, 6);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `sending_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `text`, `sending_date`) VALUES
(7, 'un text du 7', '2018-03-17 19:03:06'),
(8, 'un text du 8', '2018-03-17 20:03:53'),
(9, 'un text du 9', '2018-03-17 18:03:53'),
(10, 'un text du 10', '2018-03-17 16:03:53'),
(11, 'ismailoText', '2018-03-18 10:57:21'),
(12, 'komayo', '2018-03-18 11:00:41'),
(13, 'fffd', '2018-03-18 11:49:51'),
(14, 'papa', '2018-03-18 11:51:07'),
(15, 'stiktik', '2018-03-18 11:58:25'),
(16, 'gg', '2018-03-18 11:59:05'),
(17, 'sksj', '2018-03-18 11:59:21');

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `subscribe_date` datetime NOT NULL,
  `last_disconnect_date` datetime DEFAULT NULL,
  `last_connect_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `person`
--

INSERT INTO `person` (`id`, `name`, `password`, `subscribe_date`, `last_disconnect_date`, `last_connect_date`) VALUES
(1, 'user1', 'user1', '2018-03-17 00:00:00', '2018-03-17 01:00:00', '2018-03-17 05:00:00'),
(2, 'user2', '7e58d63b60197ceb55a1c487989a3720', '2018-03-17 20:00:00', NULL, '2018-03-17 20:00:06'),
(3, 'cc', '1aabac6d068eef6a7bad3fdf50a05cc8', '2018-03-18 02:32:47', '0000-00-00 00:00:00', '2018-03-18 02:32:47'),
(5, 'dd', '1aabac6d068eef6a7bad3fdf50a05cc8', '2018-03-18 02:35:40', NULL, '2018-03-18 02:35:40'),
(6, 'ss', '3691308f2a4c2f6983f2880d32e29c84', '2018-03-18 02:40:29', NULL, '2018-03-18 02:40:29'),
(7, 'ff', '633de4b0c14ca52ea2432a3c8a5c4c31', '2018-03-18 02:42:16', NULL, '2018-03-18 02:42:16'),
(8, 'tt', 'accc9105df5383111407fd5b41255e23', '2018-03-18 02:43:21', NULL, '2018-03-18 02:43:21'),
(9, 'qq', '099b3b060154898840f0ebdfb46ec78f', '2018-03-18 02:44:47', NULL, '2018-03-18 02:44:47'),
(10, 'a', '0cc175b9c0f1b6a831c399e269772661', '2018-03-18 09:05:25', NULL, '2018-03-18 09:05:25'),
(11, 'xx', '9336ebf25087d91c818ee6e9ec29f8c1', '2018-03-18 10:42:31', NULL, '2018-03-18 10:42:31');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`id_message`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`id_person`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
