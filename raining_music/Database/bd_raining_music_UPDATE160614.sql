-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 17 Juin 2014 à 18:02
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
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Flag_lecture` tinyint(1) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Login_membre` varchar(50) NOT NULL,
  PRIMARY KEY (`Flag_lecture`,`Type`),
  KEY `Id` (`Id`,`Login_membre`),
  KEY `Login_membre` (`Login_membre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `alerte2`
--

CREATE TABLE IF NOT EXISTS `alerte2` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Flag_lecture` tinyint(1) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Login_membre` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` smallint(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `position` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `concert`
--

CREATE TABLE IF NOT EXISTS `concert` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Date` varchar(50) NOT NULL,
  `Heure` varchar(50) NOT NULL,
  `Cout` float DEFAULT NULL,
  `Adresse` varchar(100) DEFAULT NULL,
  `Description` mediumtext NOT NULL,
  `salle` varchar(50) NOT NULL,
  `Groupe` varchar(50) NOT NULL,
  `salle_acceptee` int(11) NOT NULL,
  `Concert_accepte` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Adresse` (`Adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `concert_membre_organise`
--

CREATE TABLE IF NOT EXISTS `concert_membre_organise` (
  `Organisateur` varchar(50) NOT NULL COMMENT 'Login_membre',
  `Id_concert` varchar(50) NOT NULL,
  `Role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Organisateur`,`Id_concert`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `genre_musical`
--

CREATE TABLE IF NOT EXISTS `genre_musical` (
  `Nom` varchar(50) NOT NULL,
  PRIMARY KEY (`Nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `genre_musical`
--

INSERT INTO `genre_musical` (`Nom`) VALUES
('Afro beat'),
('Ambient'),
('Blues'),
('Chanson francaise'),
('Chants populaires'),
('Chorale'),
('Comedie Musicale'),
('Country'),
('Dance'),
('Disco'),
('Dub'),
('Electro, Clubbing'),
('Emo rock'),
('Folk'),
('Folk Rock'),
('Funk'),
('Glam Rock'),
('Gospel'),
('Grind'),
('Groove, RNB'),
('Grunge'),
('Hard rock'),
('Hip-Hop'),
('House'),
('Humour'),
('Indie Rock'),
('Indus'),
('Jazz'),
('Jazz Manouche'),
('Latino'),
('Lounge'),
('Metal'),
('Musique Classique'),
('Musique Contemporaine'),
('Musique gitane'),
('Musique Orientale'),
('Musique traditionnelle'),
('Musiques de films'),
('New Age'),
('New Wave'),
('Opera'),
('Pop'),
('Power Metal'),
('Punk'),
('Ragga, Dancehall'),
('Rap'),
('Reggae'),
('Reggaeton'),
('Rock'),
('Rock Alternatif'),
('Rock Francais'),
('Rock progressif'),
('Rock-ska'),
('RockNroll'),
('RythmNblues'),
('Salsa'),
('Scene française'),
('Ska'),
('Slam'),
('Slow'),
('Soul'),
('Swing'),
('Techno'),
('Varietes'),
('World'),
('Zouk');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Popularite` float DEFAULT NULL,
  `ScoreTotal` int(11) NOT NULL,
  `NbVotes` int(11) NOT NULL,
  `DateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` longtext,
  PRIMARY KEY (`Id`),
  KEY `Nom` (`Nom`),
  KEY `Nom_2` (`Nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `Login` varchar(50) NOT NULL,
  `Password` varchar(500) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Sexe` tinyint(1) NOT NULL,
  `DoB` date NOT NULL,
  `Localisation` varchar(50) DEFAULT NULL,
  `Departement` int(11) NOT NULL,
  `Image` varchar(70) NOT NULL,
  `Commentaire` varchar(100) NOT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `DateInscription` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Mail` (`Mail`),
  UNIQUE KEY `Login_2` (`Login`),
  KEY `Login` (`Login`,`Password`),
  FULLTEXT KEY `searchProfil` (`Login`,`Mail`,`Localisation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Structure de la table `membre_groupe`
--

CREATE TABLE IF NOT EXISTS `membre_groupe` (
  `Login_membre` varchar(50) NOT NULL,
  `Nom_groupe` varchar(50) NOT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `Valide` tinyint(1) NOT NULL,
  `Creator` tinyint(1) NOT NULL,
  PRIMARY KEY (`Login_membre`,`Nom_groupe`),
  KEY `Login_membre` (`Login_membre`,`Nom_groupe`),
  KEY `IdGroupe_dans_relation_a_groupe1` (`Nom_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre_groupe_pref`
--

CREATE TABLE IF NOT EXISTS `membre_groupe_pref` (
  `Id_membre` int(11) NOT NULL,
  `Id_groupe` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `Adresse` varchar(100) NOT NULL,
  `NbPlaces` int(20) DEFAULT NULL,
  `Proprietaire` varchar(25) DEFAULT NULL,
  `Photo` varchar(200) NOT NULL DEFAULT 'PhotoDefaut.png',
  `Photo2` varchar(200) NOT NULL DEFAULT 'PhotoDefaut.png',
  `Horaires` varchar(100) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Departement` varchar(50) NOT NULL,
  `Telephone` int(20) NOT NULL,
  `DateCreation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Adresse`,`Nom`),
  KEY `Adresse` (`Adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `salle_memebre_possede`
--

CREATE TABLE IF NOT EXISTS `salle_memebre_possede` (
  `Proprietaire_Salle` varchar(25) NOT NULL,
  `Adresse_Salle` varchar(25) NOT NULL,
  `Nom_Salle` varchar(50) NOT NULL,
  `Valide` tinyint(4) NOT NULL,
  `Creator` tinyint(4) NOT NULL,
  PRIMARY KEY (`Proprietaire_Salle`,`Nom_Salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `parent` smallint(6) NOT NULL,
  `id` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `message` longtext NOT NULL,
  `authorid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `timestamp2` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `IdRelation` int(11) NOT NULL AUTO_INCREMENT,
  `IdGroupe` int(11) NOT NULL,
  `LoginMembre` varchar(50) NOT NULL,
  UNIQUE KEY `IdRelation` (`IdRelation`),
  KEY `IdGroupe` (`IdGroupe`),
  KEY `LoginMembre` (`LoginMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `concert`
--
ALTER TABLE `concert`
  ADD CONSTRAINT `Adresse_Salle_Concert` FOREIGN KEY (`Adresse`) REFERENCES `salle` (`Adresse`);

--
-- Contraintes pour la table `groupe_genre_musical`
--
ALTER TABLE `groupe_genre_musical`
  ADD CONSTRAINT `Relation_IdGroupe_dans_GROUPE_GENRE_MUSICAL` FOREIGN KEY (`Id_groupe`) REFERENCES `groupe` (`Id`),
  ADD CONSTRAINT `Relation_Nom_genre_musical_dans_GROUPE_GENRE_MUSICAL` FOREIGN KEY (`Nom_genre_musical`) REFERENCES `genre_musical` (`Nom`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `Relation_entre_vote_et_groupe_lien_IdGroupe` FOREIGN KEY (`IdGroupe`) REFERENCES `groupe` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Relation_entre_vote_et_membre_lien_LoginMembre` FOREIGN KEY (`LoginMembre`) REFERENCES `membre` (`Login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
