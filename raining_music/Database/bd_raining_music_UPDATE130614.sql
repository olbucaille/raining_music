-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 13 Juin 2014 à 10:31
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bd_raining_music`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `alerte`
--

INSERT INTO `alerte` (`Id`, `Titre`, `Description`, `Flag_lecture`, `Type`, `Login_membre`) VALUES
(13, 'demande', 'Membre1 demande à rejoindre coreanBand', 1, 'ASK_Membre1_coreanBand', 'Membre3'),
(19, 'demande', 'Membre1 demande à rejoindre groupe1', 1, 'ASK_Membre1_groupe1', 'Membre3'),
(16, 'demande', 'Membre2 demande à rejoindre coreanBand', 1, 'ASK_Membre2_coreanBand', 'Membre3'),
(17, 'demande', 'Membre4 demande à rejoindre coreanBand', 1, 'ASK_Membre4_coreanBand', 'Membre3');

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

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `position`) VALUES
(1, 'Category0', 'By OlBucaille', 1),
(2, 'Category1', 'By AlJorre', 2),
(3, 'Cat03', '', 3);

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
  `Adresse` varchar(50) DEFAULT NULL,
  `salle_acceptee` int(11) NOT NULL,
  `salle` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
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
  `Role` varchar(50) DEFAULT NULL,
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
('Pop', NULL),
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
  KEY `Nom` (`Nom`),
  KEY `Nom_2` (`Nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`Id`, `Nom`, `Popularite`) VALUES
(1, 'coreanBand', 5),
(2, 'lkjngfslk', NULL),
(3, 'groupe1', 4),
(5, 'Obiwan', NULL),
(6, 'PetitGroupe0', 1),
(8, 'Arboratum', 2),
(9, 'Aaron', NULL),
(10, 'Hey Dude !', 5),
(11, 'ChaisPasKoi', 1);

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
(2, 'Blues'),
(3, 'Dancehall'),
(5, 'Dancehall'),
(6, 'Hip-Hop'),
(8, 'Hip-Hop'),
(9, 'J-Pop'),
(10, 'Rock'),
(11, 'Rock');

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
  `Image` varchar(70) NOT NULL,
  `Commentaire` varchar(100) NOT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Mail` (`Mail`),
  UNIQUE KEY `Login_2` (`Login`),
  KEY `Login` (`Login`,`Password`),
  FULLTEXT KEY `searchProfil` (`Login`,`Mail`,`Localisation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`Login`, `Password`, `Mail`, `Nom`, `Sexe`, `DoB`, `Localisation`, `Image`, `Commentaire`, `id`) VALUES
('chazinou', 'd6138a9db90fc41e5a5df76922f831f6', 'buca@gmail.com', NULL, NULL, '0000-00-00', 'paris', './../upload/pht1.png', '', 1),
('Membre1', 'ae7be26cdaa742ca148068d5ac90eaca', 'm1@m1.com', 'MembreOne', 1, '1993-05-01', 'Deuil-la-Barre', './../upload/20140503_181918.jpg', '', 2),
('Membre2', 'aaf2f89992379705dac844c0a2a1d45f', 'Membre2@m2.com', NULL, NULL, '0000-00-00', 'null', '', '', 3),
('Membre3', '9678f7a7939f457fa0d9353761e189c7', 'm3@m3.Com', NULL, NULL, '0000-00-00', 'null', '', '', 4),
('Membre4', 'fd6b6fc9220b72d21683ae8e4f50a210', 'm4@m4.com', NULL, NULL, '0000-00-00', 'null', '', '', 6),
('CaptainMurloc', 'ab334feeb31c05124cb73fa12571c2f6', 'captain@gmail.com', NULL, 1, '1989-06-05', 'Plessis', '', '', 7),
('Bullsheet', 'ab4f63f9ac65152575886860dde480a1', 'bs@bs.com', NULL, 0, '1985-08-05', 'Paris', '', '', 8),
('Aaaaargo', '4124bc0a9335c27f086f24ba207a4912', 'aa@hh.fr', NULL, 0, '1956-09-07', 'Parlà', '', '', 9);

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
  `Creator` tinyint(1) NOT NULL,
  PRIMARY KEY (`Login_membre`,`Nom_groupe`),
  KEY `Login_membre` (`Login_membre`,`Nom_groupe`),
  KEY `IdGroupe_dans_relation_a_groupe1` (`Nom_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre_groupe`
--

INSERT INTO `membre_groupe` (`Login_membre`, `Nom_groupe`, `Role`, `Valide`, `Creator`) VALUES
('Membre1', 'coreanBand', '', 1, 0),
('Membre1', 'groupe1', '', 1, 0),
('Membre2', 'coreanBand', '', 1, 0),
('Membre3', 'coreanBand', 'chef supreme', 1, 1),
('Membre3', 'groupe1', 'qkfjnb', 1, 1),
('Membre3', 'lkjngfslk', 'elfkzhjlkj', 1, 1),
('Membre4', 'coreanBand', '', 1, 0);

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
  `Photo` varchar(50) NOT NULL DEFAULT 'PhotoDefaut.png',
  `Photo2` varchar(50) NOT NULL DEFAULT 'PhotoDefaut.png',
  `Telephone` int(20) NOT NULL,
  `Horaires` varchar(25) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Departement` varchar(50) NOT NULL,
  PRIMARY KEY (`Nom`),
  KEY `Adresse` (`Adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`Adresse`, `NbPlaces`, `Proprietaire`, `Photo`, `Photo2`, `Telephone`, `Horaires`, `Nom`, `Departement`) VALUES
('PieuCroix', 60, 'Membre1', '', 'PhotoDefaut.png', 0, '2014-07-17 11:00:00', 'Alabasta', '74'),
('48, rue des chameaux', 40, 'Membre1', '', 'PhotoDefaut.png', 0, '2014-06-06 00:00:00', 'La Salle Des Vaches', '1'),
('66, avenue des bidons', NULL, 'Membre2', '', 'PhotoDefaut.png', 0, '2014-06-27 00:00:00', 'POP-UP', '77'),
('Adresse salle test BDD', NULL, NULL, '', 'PhotoDefaut.png', 0, '0000-00-00 00:00:00', 'Salle test BDD', '78'),
('6, rue de la bibine', 55, 'Membre3', '', 'PhotoDefaut.png', 0, '2014-06-12 08:21:12', 'Salle1 - Bière qui roule amass', '75'),
('Impasse boiscarre', 10, 'Membre1', '', 'PhotoDefaut.png', 0, '2014-06-26 07:00:00', 'Schtroumpfs', '60'),
('78, rue de la Pompe', 89, 'Irina', 'PhotoDefaut.png', 'PhotoDefaut.png', 278980210, 'Lundi - Samedi / 20h - 2h', 'Sky', 'Aix'),
('14, rue du Moulin', 97, 'Irina', 'PhotoDefaut.png', 'PhotoDefaut.png', 345730907, '', 'Techno', 'Ain');

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
  `Nom_Salle` varchar(50) NOT NULL,
  `Valide` tinyint(4) NOT NULL,
  `Creator` tinyint(4) NOT NULL,
  PRIMARY KEY (`Proprietaire_Salle`,`Nom_Salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `salle_memebre_possede`
--

INSERT INTO `salle_memebre_possede` (`Proprietaire_Salle`, `Adresse_Salle`, `Nom_Salle`, `Valide`, `Creator`) VALUES
('', '', '', 1, 1),
('', 'Adresse_Salle', 'Dingue', 1, 1),
('', 'Adresse_Salle', 'e', 1, 1),
('', '', 'rf', 1, 1),
('', 'Adresse salle test BDD', 'Salle test BDD', 1, 1),
('', 'Adresse_Salle', 'Salle1 - Bière qui roule amasse la mousse', 1, 1),
('Irina', '78, rue de la Pompe', 'Sky', 1, 1),
('Irina', '14, rue du Moulin', 'Techno', 1, 1);

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

--
-- Contenu de la table `topics`
--

INSERT INTO `topics` (`parent`, `id`, `id2`, `title`, `message`, `authorid`, `timestamp`, `timestamp2`) VALUES
(2, 4, 1, 'TestCreateWithM2', 'MEssage Test', 3, 1402311957, 1402311977),
(1, 2, 1, 'Topic1', '', 2, 1402311538, 1402312396),
(2, 3, 1, 'Topic0Cat1', 'Test de TEXT de TOPIC.', 2, 1402311750, 1402311997),
(2, 3, 2, '', '<strong>Puis-je reply ?</strong>', 2, 1402311770, 1402311770),
(2, 3, 3, '', '<span style="text-decoration:underline;">Visiblement</span> oui ! :)', 2, 1402311785, 1402311785),
(2, 4, 2, '', 'Je peux repondre en tant que membre 2 ?', 3, 1402311977, 1402311977),
(2, 3, 4, '', 'Que disais-tu ? :)', 3, 1402311997, 1402311997),
(1, 2, 2, '', 'reponse 1', 2, 1402312396, 1402312396),
(3, 5, 1, 'Topic1Cat03', 'Message In', 2, 1402318479, 1402318597),
(3, 5, 2, '', 'Message avec des accents sur certains mot ins&eacute;r&eacute;s expr&egrave;s ! :)', 2, 1402318597, 1402318597);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `concert`
--
ALTER TABLE `concert`
  ADD CONSTRAINT `Adresse_Salle_Concert` FOREIGN KEY (`Adresse`) REFERENCES `salle` (`Adresse`);

--
-- Contraintes pour la table `concert_genre_musical`
--
ALTER TABLE `concert_genre_musical`
  ADD CONSTRAINT `IdConcert_dans_relation_a_ConcertGenreMusical` FOREIGN KEY (`Id_concert`) REFERENCES `concert` (`Id`),
  ADD CONSTRAINT `NomGenreMusical_dans_relation_a_ConcertGenre` FOREIGN KEY (`Nom_genre`) REFERENCES `genre_musical` (`Nom`);

--
-- Contraintes pour la table `concert_membre_participe`
--
ALTER TABLE `concert_membre_participe`
  ADD CONSTRAINT `concertid_dans_relation_a_Concert` FOREIGN KEY (`Id_concert`) REFERENCES `concert` (`Id`);

--
-- Contraintes pour la table `groupe_genre_musical`
--
ALTER TABLE `groupe_genre_musical`
  ADD CONSTRAINT `Relation_IdGroupe_dans_GROUPE_GENRE_MUSICAL` FOREIGN KEY (`Id_groupe`) REFERENCES `groupe` (`Id`),
  ADD CONSTRAINT `Relation_Nom_genre_musical_dans_GROUPE_GENRE_MUSICAL` FOREIGN KEY (`Nom_genre_musical`) REFERENCES `genre_musical` (`Nom`);

--
-- Contraintes pour la table `membre_genre_musical`
--
ALTER TABLE `membre_genre_musical`
  ADD CONSTRAINT `nomgenremusical_dans_relation_a_genremusical` FOREIGN KEY (`Nom_genre_musical`) REFERENCES `genre_musical` (`Nom`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
