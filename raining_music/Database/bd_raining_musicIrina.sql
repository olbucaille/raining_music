-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 24 Mai 2014 à 17:30
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bd_raining_music`
--

-- --------------------------------------------------------

--
-- Structure de la table `alerte`
--

CREATE TABLE IF NOT EXISTS `alerte` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Flag_lecture` tinyint(1) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Login_membre` varchar(50) NOT NULL,
  PRIMARY KEY (`Flag_lecture`,`Type`),
  KEY `Id` (`Id`,`Login_membre`),
  KEY `Login_membre` (`Login_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `alerte`
--

INSERT INTO `alerte` (`Id`, `Titre`, `Description`, `Flag_lecture`, `Type`, `Login_membre`) VALUES
(13, 'demande', 'Membre1 demande à rejoindre coreanBand', 1, 'ASK_Membre1_coreanBand', 'Membre3'),
(16, 'demande', 'Membre2 demande à rejoindre coreanBand', 1, 'ASK_Membre2_coreanBand', 'Membre3'),
(17, 'demande', 'Membre4 demande à rejoindre coreanBand', 1, 'ASK_Membre4_coreanBand', 'Membre3');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `Id` int(11) NOT NULL,
  `Nom_auteur` varchar(50) NOT NULL COMMENT 'LoginMembre',
  `Cible` int(11) NOT NULL,
  PRIMARY KEY (`Id`,`Nom_auteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `concert`
--

CREATE TABLE IF NOT EXISTS `concert` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  `Cout` float DEFAULT NULL,
  `Adresse` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Adresse` (`Adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `concert_genre_musical`
--

CREATE TABLE IF NOT EXISTS `concert_genre_musical` (
  `Id_concert` int(11) NOT NULL,
  `Nom_genre` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_concert`,`Nom_genre`),
  KEY `Nom_genre` (`Nom_genre`),
  KEY `Id_concert` (`Id_concert`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `concert_groupe`
--

CREATE TABLE IF NOT EXISTS `concert_groupe` (
  `Id_concert` int(11) NOT NULL,
  `Id_groupe` int(11) NOT NULL,
  PRIMARY KEY (`Id_concert`),
  KEY `Id_concert` (`Id_concert`),
  KEY `Id_groupe` (`Id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `concert_membre_organise`
--

CREATE TABLE IF NOT EXISTS `concert_membre_organise` (
  `Organisateur` varchar(50) NOT NULL COMMENT 'Login_membre',
  `Id_concert` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL,
  PRIMARY KEY (`Organisateur`,`Id_concert`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `concert_membre_participe`
--

CREATE TABLE IF NOT EXISTS `concert_membre_participe` (
  `Login_membre` varchar(50) NOT NULL,
  `Id_concert` int(11) NOT NULL,
  PRIMARY KEY (`Login_membre`,`Id_concert`),
  KEY `concertid_dans_relation_a_Concert` (`Id_concert`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `disque`
--

CREATE TABLE IF NOT EXISTS `disque` (
  `ID` varchar(25) NOT NULL,
  `Titre_album` varchar(25) NOT NULL,
  `NbChansons` int(25) NOT NULL,
  `Annee` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `disque_piste`
--

CREATE TABLE IF NOT EXISTS `disque_piste` (
  `ID_Disque` varchar(25) NOT NULL,
  `ID_Piste` int(20) NOT NULL,
  PRIMARY KEY (`ID_Disque`,`ID_Piste`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `genre_musical`
--

CREATE TABLE IF NOT EXISTS `genre_musical` (
  `Nom` varchar(50) NOT NULL,
  `Epoque` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `genre_musical`
--

INSERT INTO `genre_musical` (`Nom`, `Epoque`) VALUES
('Blues', NULL),
('Dancehall', NULL),
('Hip-Hop', NULL),
('J-Pop', NULL),
('Rock', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Popularite` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Nom` (`Nom`),
  KEY `Nom_2` (`Nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`Id`, `Nom`, `Popularite`) VALUES
(0, 'coreanBand', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupe_disque`
--

CREATE TABLE IF NOT EXISTS `groupe_disque` (
  `ID_Disque` int(15) NOT NULL AUTO_INCREMENT,
  `ID_Groupe` int(11) NOT NULL,
  PRIMARY KEY (`ID_Disque`,`ID_Groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_genre_musical`
--

CREATE TABLE IF NOT EXISTS `groupe_genre_musical` (
  `Id_groupe` int(11) NOT NULL,
  `Nom_genre_musical` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_groupe`,`Nom_genre_musical`),
  KEY `Nom_groupe` (`Id_groupe`,`Nom_genre_musical`),
  KEY `nomgenremusical_dans_relation_a_groupe` (`Nom_genre_musical`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe_genre_musical`
--

INSERT INTO `groupe_genre_musical` (`Id_groupe`, `Nom_genre_musical`) VALUES
(1, 'Blues'),
(0, 'Dancehall'),
(4, 'J-Pop'),
(2, 'Rock'),
(3, 'Rock');

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE IF NOT EXISTS `medias` (
  `ID` varchar(25) NOT NULL,
  `Nom` varchar(25) NOT NULL,
  `Chemin` varchar(25) NOT NULL,
  `Type` varchar(25) NOT NULL,
  `Abus` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medias_concert`
--

CREATE TABLE IF NOT EXISTS `medias_concert` (
  `ID_Medias` varchar(25) NOT NULL,
  `Id_Concert` int(11) NOT NULL,
  PRIMARY KEY (`ID_Medias`,`Id_Concert`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medias_disque`
--

CREATE TABLE IF NOT EXISTS `medias_disque` (
  `ID_Medias` varchar(25) NOT NULL,
  `ID_Disque` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_Medias`,`ID_Disque`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medias_groupe`
--

CREATE TABLE IF NOT EXISTS `medias_groupe` (
  `ID_Medias` varchar(25) NOT NULL,
  `ID_Groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medias_membre`
--

CREATE TABLE IF NOT EXISTS `medias_membre` (
  `Login_Membre` varchar(50) NOT NULL,
  `ID_Medias` varchar(25) NOT NULL,
  PRIMARY KEY (`Login_Membre`,`ID_Medias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medias_piste`
--

CREATE TABLE IF NOT EXISTS `medias_piste` (
  `ID_Medias` varchar(25) NOT NULL,
  `ID_Piste` int(20) NOT NULL,
  PRIMARY KEY (`ID_Medias`,`ID_Piste`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medias_salle`
--

CREATE TABLE IF NOT EXISTS `medias_salle` (
  `ID_Medias` varchar(25) NOT NULL,
  `Adresse_Salle` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_Medias`,`Adresse_Salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `Login` varchar(50) NOT NULL,
  `Password` varchar(500) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Sexe` tinyint(1) DEFAULT NULL,
  `DoB` date NOT NULL,
  `Localisation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Login`),
  UNIQUE KEY `Mail` (`Mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `Nom` varchar(50) NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `NbPlaces` int(20) DEFAULT NULL,
  `Proprietaire` varchar(30) DEFAULT NULL,
  `Photo` varchar(25) NOT NULL,
  `Horaire` datetime NOT NULL,
  PRIMARY KEY (`Nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `salle_membre_possede`
--

CREATE TABLE IF NOT EXISTS `salle_membre_possede` (
  `Proprietaire_Salle` varchar(25) NOT NULL,
  `Nom_Salle` varchar(30) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Valide` tinyint(1) NOT NULL,
  `Create` tinyint(1) NOT NULL,
  PRIMARY KEY (`Proprietaire_Salle`,`Nom_Salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
