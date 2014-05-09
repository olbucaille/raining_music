-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 09 Mai 2014 à 10:00
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bd_raining_music`
--
CREATE DATABASE IF NOT EXISTS `bd_raining_music` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_raining_music`;

-- --------------------------------------------------------

--
-- Structure de la table `alerte`
--

CREATE TABLE IF NOT EXISTS `alerte` (
  `Id` int(11) NOT NULL,
  `Titre` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Flag_lecture` tinyint(1) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Login_membre` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Id` (`Id`,`Login_membre`),
  KEY `Login_membre` (`Login_membre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`Id`)
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
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Popularite` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Nom_3` (`Nom`),
  KEY `Nom` (`Nom`),
  KEY `Nom_2` (`Nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`Id`, `Nom`, `Popularite`) VALUES
(4, 'lrkgh', NULL),
(5, 'Un Groupe', NULL),
(6, 'ACDC', NULL),
(7, 'un autre groupe', NULL),
(8, 'billy talent', NULL),
(9, 'lorenzo', NULL),
(10, 'kilo', NULL);

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
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`Login`),
  UNIQUE KEY `Mail` (`Mail`),
  KEY `Login` (`Login`,`Password`),
  FULLTEXT KEY `searchProfil` (`Login`,`Mail`,`Localisation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`Login`, `Password`, `Mail`, `Nom`, `Sexe`, `DoB`, `Localisation`, `image`) VALUES
('Alison', '9c0f0b59a4cb6d6c59f6002bf3892a28', 'alison.jorre@isep.com', NULL, 1, '1993-05-05', 'Groslay', ''),
('chazinou', 'd6138a9db90fc41e5a5df76922f831f6', 'chazinou@g.com', NULL, NULL, '0000-00-00', 'null', './../upload/1549511_844539582228279_6883406971322837778_n.jpg'),
('Membre1', 'ae7be26cdaa742ca148068d5ac90eaca', 'm1@g.com', NULL, 0, '1111-01-01', 'Paris', './../upload/1549511_844539582228279_68834069713228'),
('Membre2', 'aaf2f89992379705dac844c0a2a1d45f', 'm2@g.com', NULL, 1, '2222-02-02', 'Lyon', ''),
('Membre3', '9678f7a7939f457fa0d9353761e189c7', 'm3@g.com', NULL, 0, '1993-03-03', 'Paris', ''),
('Membre4', 'fd6b6fc9220b72d21683ae8e4f50a210', 'm4@g.com', NULL, 1, '1993-04-04', 'Marseille', ''),
('Membre5', '7b1f6dff14d8c2dfeb7da9487be0612d', 'm5@g.com', NULL, 1, '1995-05-05', 'Paris', ''),
('membrealpha', '594f803b380a41396ed63dca39503542', 'aa@hh.fr', NULL, 1, '2014-04-10', 'Deuil-la-Barre', '');

-- --------------------------------------------------------

--
-- Structure de la table `membre_genre_musical`
--

CREATE TABLE IF NOT EXISTS `membre_genre_musical` (
  `Login_membre` varchar(50) NOT NULL,
  `Nom_genre_musical` varchar(50) NOT NULL,
  PRIMARY KEY (`Login_membre`,`Nom_genre_musical`),
  KEY `Login_membre` (`Login_membre`,`Nom_genre_musical`),
  KEY `nomgenremusical_dans_relation_a_genremusical` (`Nom_genre_musical`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre_groupe`
--

CREATE TABLE IF NOT EXISTS `membre_groupe` (
  `Login_membre` varchar(50) NOT NULL,
  `Nom_groupe` varchar(50) NOT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `Valide` tinyint(1) NOT NULL,
  PRIMARY KEY (`Login_membre`,`Nom_groupe`),
  KEY `Login_membre` (`Login_membre`,`Nom_groupe`),
  KEY `IdGroupe_dans_relation_a_groupe1` (`Nom_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre_groupe`
--

INSERT INTO `membre_groupe` (`Login_membre`, `Nom_groupe`, `Role`, `Valide`) VALUES
('chazinou', 'ACDC', 'vchef', 0),
('chazinou', 'billy talent', 'NWS', 0),
('chazinou', 'lorenzo', 'lsdkjg', 1),
('chazinou', 'un autre groupe', 'chef supreme', 0),
('chazinou', 'Un Groupe', 'chef', 0),
('Membre1', 'ACDC', '', 0),
('Membre1', 'lrkgh', 'sdlgkn', 0),
('Membre2', 'kilo', 'Chef', 1),
('Membre3', 'ACDC', '', 0),
('Membre3', 'kilo', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `piste`
--

CREATE TABLE IF NOT EXISTS `piste` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) NOT NULL,
  `Duree` time DEFAULT NULL,
  `Groupe` varchar(25) NOT NULL,
  `Album` varchar(25) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `Adresse` varchar(25) NOT NULL,
  `NbPlaces` int(20) DEFAULT NULL,
  `Proprietaire` varchar(25) DEFAULT NULL,
  `Photo` varchar(25) NOT NULL,
  `Horaire` datetime NOT NULL,
  PRIMARY KEY (`Adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `salle_membre_note`
--

CREATE TABLE IF NOT EXISTS `salle_membre_note` (
  `Login_Membre` varchar(50) NOT NULL,
  `Adresse_Salle` varchar(25) NOT NULL,
  PRIMARY KEY (`Login_Membre`,`Adresse_Salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `salle_memebre_possede`
--

CREATE TABLE IF NOT EXISTS `salle_memebre_possede` (
  `Proprietaire_Salle` varchar(25) NOT NULL,
  `Adresse_Salle` varchar(25) NOT NULL,
  `Role` varchar(25) NOT NULL,
  PRIMARY KEY (`Proprietaire_Salle`,`Adresse_Salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `ID` varchar(25) NOT NULL,
  `Auteur` varchar(25) NOT NULL,
  `Date_Publication` date NOT NULL,
  `Titre` varchar(25) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Categorie` varchar(20) NOT NULL,
  `Abus` tinyint(1) NOT NULL,
  `Login_Membre` varchar(25) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Login_Membre` (`Login_Membre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `topic_groupe`
--

CREATE TABLE IF NOT EXISTS `topic_groupe` (
  `ID_Groupe` varchar(25) NOT NULL,
  `ID_Topic` varchar(40) NOT NULL,
  PRIMARY KEY (`ID_Groupe`,`ID_Topic`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `topic_salle`
--

CREATE TABLE IF NOT EXISTS `topic_salle` (
  `ID_Topic` varchar(40) NOT NULL,
  `Adresse_Salle` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_Topic`,`Adresse_Salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD CONSTRAINT `loginmembre_dans_relation_a_Alerte` FOREIGN KEY (`Login_membre`) REFERENCES `membre` (`Login`);

--
-- Contraintes pour la table `concert_membre_participe`
--
ALTER TABLE `concert_membre_participe`
  ADD CONSTRAINT `concertid_dans_relation_a_Concert` FOREIGN KEY (`Id_concert`) REFERENCES `concert` (`Id`),
  ADD CONSTRAINT `loginmembre_dans_relation_a_Membre` FOREIGN KEY (`Login_membre`) REFERENCES `membre` (`Login`);

--
-- Contraintes pour la table `groupe_genre_musical`
--
ALTER TABLE `groupe_genre_musical`
  ADD CONSTRAINT `nomgenremusical_dans_relation_a_groupe` FOREIGN KEY (`Nom_genre_musical`) REFERENCES `genre_musical` (`Nom`);

--
-- Contraintes pour la table `membre_genre_musical`
--
ALTER TABLE `membre_genre_musical`
  ADD CONSTRAINT `loginmembre_dans_relation_a_genremusical` FOREIGN KEY (`Login_membre`) REFERENCES `membre` (`Login`),
  ADD CONSTRAINT `nomgenremusical_dans_relation_a_genremusical` FOREIGN KEY (`Nom_genre_musical`) REFERENCES `genre_musical` (`Nom`);

--
-- Contraintes pour la table `membre_groupe`
--
ALTER TABLE `membre_groupe`
  ADD CONSTRAINT `login` FOREIGN KEY (`Login_membre`) REFERENCES `membre` (`Login`),
  ADD CONSTRAINT `nomgroupe dans membre_grouep` FOREIGN KEY (`Nom_groupe`) REFERENCES `groupe` (`Nom`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
