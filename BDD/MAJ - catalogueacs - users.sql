-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 19 août 2020 à 11:20
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `catalogueacs`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `dateNaissance` varchar(10) NOT NULL DEFAULT '01/01/2020',
  `numTel` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `login` varchar(12) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `dateNaissance`, `numTel`, `email`, `adresse`, `cp`, `ville`, `admin`, `login`, `mdp`) VALUES
(1, 'PERECHODOV', 'Philippe', '1979-03-24', '0606060606', 'p.perechodov@codeur.online', '665 impasse de l\'enfer', '03460', 'TREVOL', 1, 'phil', 'phil'),
(2, 'DE MARCH', 'Robin', '2000-08-08', '0707070707', 'r.demarch@codeur.online', '3 avenue du PHP', '89100', 'MALAY-LE-GRAND', 1, 'robin', 'robin'),
(3, 'SYED', 'Ali', '1996-03-21', '0607060706', 'a.syed@codeur.online', '32 Bis rue du dev', '58000', 'NEVERS', 1, 'ali', 'ali'),
(4, 'MINEUR', 'Kevin', '2005-10-15', '0706070607', 'kevin.lenoob@gmail.com', '12 allée du Noob', '75005', 'PARIS', 0, 'kev', 'kev'),
(5, 'MAJEUR', 'Robert', '1954-09-01', '0486219556', 'majeur.levieux@free.fr', '7892, chemin de la mer, 3eme etg, appt C', '13001', 'MARSEILLE', 0, 'bob', 'bob'),
(6, 'BON', 'Jean', '0001-01-01', '0123456789', 'jeanbon@boucherie.fr', '01 rue du Hachoir', '71120', 'CHAROLLES', 0, 'Jambon', 'Azerty12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
