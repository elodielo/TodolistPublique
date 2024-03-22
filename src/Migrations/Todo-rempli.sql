-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 22 mars 2024 à 13:27
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todolist`
--
CREATE DATABASE IF NOT EXISTS `todolist` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `todolist`;

-- --------------------------------------------------------

--
-- Structure de la table `toliencategorie_tache`
--

DROP TABLE IF EXISTS `toliencategorie_tache`;
CREATE TABLE IF NOT EXISTS `toliencategorie_tache` (
  `ID_Taches` int NOT NULL,
  `ID_Categories` int NOT NULL,
  PRIMARY KEY (`ID_Taches`,`ID_Categories`),
  KEY `ID_Categories` (`ID_Categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `to_categories`
--

DROP TABLE IF EXISTS `to_categories`;
CREATE TABLE IF NOT EXISTS `to_categories` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `to_priorites`
--

DROP TABLE IF EXISTS `to_priorites`;
CREATE TABLE IF NOT EXISTS `to_priorites` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `to_priorites`
--

INSERT INTO `to_priorites` (`ID`, `nom`) VALUES
(1, 'Sans pression'),
(2, 'Important'),
(3, 'Urgent');

-- --------------------------------------------------------

--
-- Structure de la table `to_taches`
--

DROP TABLE IF EXISTS `to_taches`;
CREATE TABLE IF NOT EXISTS `to_taches` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jour` date DEFAULT NULL,
  `ID_Priorites` int NOT NULL,
  `ID_Utilisateurs` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_Priorites` (`ID_Priorites`),
  KEY `ID_Utilisateurs` (`ID_Utilisateurs`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `to_taches`
--

INSERT INTO `to_taches` (`ID`, `titre`, `description`, `jour`, `ID_Priorites`, `ID_Utilisateurs`) VALUES
(39, 'Faire la vaisselle', 'Demain', '2024-03-09', 0, 16),
(40, 'Le menage', 'Demain', '2024-02-24', 0, 16),
(43, 'Salut', 'SAlutsalut', '2024-02-22', 1, 13),
(48, 'Aller à la bibliothèque', 'Rendre 3 livres', '2024-03-22', 2, 51),
(50, 'Finir le brief ', '', '2024-03-22', 3, 52),
(51, 'Aller au lac', 'Se baigner', '2024-03-24', 1, 54),
(52, 'Ramasser des champignons', 'Comestibles si possible', '2024-03-28', 2, 54),
(53, 'Aller au cinéma', 'Savoir quel film regarder', '2024-03-22', 1, 51),
(54, 'Aller à la librairie', 'Acheter des livres', '2024-03-22', 2, 63);

-- --------------------------------------------------------

--
-- Structure de la table `to_utilisateurs`
--

DROP TABLE IF EXISTS `to_utilisateurs`;
CREATE TABLE IF NOT EXISTS `to_utilisateurs` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mdp` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `to_utilisateurs`
--

INSERT INTO `to_utilisateurs` (`ID`, `nom`, `prenom`, `mdp`, `mail`) VALUES
(51, 'Loeb', 'Elodie', '$2y$10$xtQwzge/0bSdHJY.MvyZZOEpegipqKx9Nx/c8wSTwkDkQZ8Gye8n2', 'elodielo20@gmail.com'),
(52, 'Bl', 'Sonia', '$2y$10$5SeuhYgZZLGTiAB6OqdnXeGvLeMjiitGeDUvd5pow9tMyeqZmRQRu', 'Bl.Sonia@gmail.com'),
(54, 'Le', 'Jus', '$2y$10$HyU0YAcQrzqezCprq/mhRewbPY1Yq0YX3/KLnXURulyUUf0LzL05W', 'Ju.Le@gmail.com'),
(55, 'Loeb', 'Elodie', '$2y$10$67BcvNM4audhJOxG/6PMeeZ4/OJ/jd2SrsFn/6je.nV78Ci8Wxnje', 'melodielo20@gmail.com'),
(56, 'Kev', '', '$2y$10$LmzB/wfQrZnM4601IX9y.ec2OJGvfjWlEmODP/dxuTta32VCK.cvm', 'keb@g'),
(57, '', '', '$2y$10$XJiu5NsA1bCosOcJKLDgJOG3Z8CeOi3eESdPi9RQgzfRn8sn83lJa', ''),
(63, 'Mi', 'M', '$2y$10$ZBejA1bR0ethDAmi3gnDlu7oZCvMqYWrb.Sm28wjn0Zk.klh5NhbG', 'M@m');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
