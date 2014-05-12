-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 12 Mai 2014 à 07:55
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

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
(0, 'RainingGroup', 5),
(1, 'HelloWorld', 5),
(2, 'Popopow', 4),
(3, 'Sunday Morning', NULL),
(4, 'Coucou Olivier !', 1);

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
  UNIQUE KEY `Mail` (`Mail`),
  KEY `Login` (`Login`,`Password`),
  FULLTEXT KEY `searchProfil` (`Login`,`Mail`,`Localisation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`Login`, `Password`, `Mail`, `Nom`, `Sexe`, `DoB`, `Localisation`) VALUES
('Alison', '9c0f0b59a4cb6d6c59f6002bf3892a28', 'alison.jorre@isep.com', NULL, 1, '1993-05-05', 'Groslay'),
('Membre1', 'ae7be26cdaa742ca148068d5ac90eaca', 'm1@g.com', NULL, 0, '1111-01-01', 'Paris'),
('Membre2', 'aaf2f89992379705dac844c0a2a1d45f', 'm2@g.com', NULL, 1, '2222-02-02', 'Lyon'),
('Membre3', '9678f7a7939f457fa0d9353761e189c7', 'm3@g.com', NULL, 0, '1993-03-03', 'Paris'),
('Membre4', 'fd6b6fc9220b72d21683ae8e4f50a210', 'm4@g.com', NULL, 1, '1993-04-04', 'Marseille'),
('Membre5', '7b1f6dff14d8c2dfeb7da9487be0612d', 'm5@g.com', NULL, 1, '1995-05-05', 'Paris'),
('membrealpha', '594f803b380a41396ed63dca39503542', 'aa@hh.fr', NULL, 1, '2014-04-10', 'Deuil-la-Barre');

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
  `Id_groupe` int(11) NOT NULL,
  `Role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Login_membre`,`Id_groupe`),
  KEY `Login_membre` (`Login_membre`,`Id_groupe`),
  KEY `IdGroupe_dans_relation_a_groupe1` (`Id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`Adresse`),
  KEY `Adresse` (`Adresse`)
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

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD CONSTRAINT `loginmembre_dans_relation_a_Alerte` FOREIGN KEY (`Login_membre`) REFERENCES `membre` (`Login`);

--
-- Contraintes pour la table `concert`
--
ALTER TABLE `concert`
  ADD CONSTRAINT `Adresse_Salle_Concert` FOREIGN KEY (`Adresse`) REFERENCES `salle` (`Adresse`);

--
-- Contraintes pour la table `concert_genre_musical`
--
ALTER TABLE `concert_genre_musical`
  ADD CONSTRAINT `NomGenreMusical_dans_relation_a_ConcertGenre` FOREIGN KEY (`Nom_genre`) REFERENCES `genre_musical` (`Nom`),
  ADD CONSTRAINT `IdConcert_dans_relation_a_ConcertGenreMusical` FOREIGN KEY (`Id_concert`) REFERENCES `concert` (`Id`);

--
-- Contraintes pour la table `concert_groupe`
--
ALTER TABLE `concert_groupe`
  ADD CONSTRAINT `IdGroupe_dans_relation_a_ConcertGroupe` FOREIGN KEY (`Id_groupe`) REFERENCES `groupe` (`Id`),
  ADD CONSTRAINT `IdConcert_dans_relation_a_ConcertGroupe` FOREIGN KEY (`Id_concert`) REFERENCES `concert` (`Id`);

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
  ADD CONSTRAINT `IdGroupe_dans_relation_a_groupe` FOREIGN KEY (`Id_groupe`) REFERENCES `groupe` (`Id`),
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
  ADD CONSTRAINT `IdGroupe_dans_relation_a_groupe1` FOREIGN KEY (`Id_groupe`) REFERENCES `groupe` (`Id`),
  ADD CONSTRAINT `loginmembre_dans_relation_a_groupe` FOREIGN KEY (`Login_membre`) REFERENCES `membre` (`Login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
