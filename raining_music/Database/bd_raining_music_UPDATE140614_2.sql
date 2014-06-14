-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 14 Juin 2014 à 12:39
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
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Flag_lecture` tinyint(1) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Login_membre` varchar(50) NOT NULL,
  PRIMARY KEY (`Flag_lecture`,`Type`),
  KEY `Id` (`Id`,`Login_membre`),
  KEY `Login_membre` (`Login_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `alerte`
--

INSERT INTO `alerte` (`Id`, `Titre`, `Description`, `Flag_lecture`, `Type`, `Login_membre`) VALUES
(13, 'demande', 'Membre1 demande à rejoindre coreanBand', 1, 'ASK_Membre1_coreanBand', 'Membre3'),
(19, 'demande', 'Membre1 demande à rejoindre groupe1', 1, 'ASK_Membre1_groupe1', 'Membre3'),
(23, 'demande', 'Membre1 demande à rejoindre salle1', 1, 'ASK_Membre1_salle1', 'Membre1'),
(16, 'demande', 'Membre2 demande à rejoindre coreanBand', 1, 'ASK_Membre2_coreanBand', 'Membre3'),
(17, 'demande', 'Membre4 demande à rejoindre coreanBand', 1, 'ASK_Membre4_coreanBand', 'Membre3'),
(27, 'Demande acceptee', 'votre demande de salle est acceptee', 1, 'demandeAccepte_salle', 'Membre1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
  `Description` mediumtext NOT NULL,
  `salle` varchar(11) NOT NULL,
  `salle_acceptee` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`Id`, `Nom`, `Popularite`, `ScoreTotal`, `NbVotes`, `DateCreation`, `description`) VALUES
(14, 'Vautour', NULL, 0, 0, '2014-06-13 17:54:29', NULL),
(15, 'Las de trèfle', NULL, 0, 0, '2014-06-13 22:24:42', NULL);

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
(15, 'Folk Rock'),
(14, 'Metal');

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
  `Departement` int(11) NOT NULL,
  `Image` varchar(70) NOT NULL,
  `Commentaire` varchar(100) NOT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `DateInscription` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Mail` (`Mail`),
  UNIQUE KEY `Login_2` (`Login`),
  KEY `Login` (`Login`,`Password`),
  FULLTEXT KEY `searchProfil` (`Login`,`Mail`,`Localisation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`Login`, `Password`, `Mail`, `Nom`, `Sexe`, `DoB`, `Localisation`, `Departement`, `Image`, `Commentaire`, `id`, `DateInscription`) VALUES
('Membre1', 'ae7be26cdaa742ca148068d5ac90eaca', 'm1@m1.com', ' Henry', 0, '1990-01-01', 'Paris ', 75, '', ' Hello, moi c''est Henry, j''aime le Rock et le café !', 12, '2014-06-13'),
('Membre2', 'aaf2f89992379705dac844c0a2a1d45f', 'm2@m2.com', ' Melanie ', 1, '1992-02-02', 'LYON  ', 69, '', ' Bonjour à tous, je suis Mélanie. Fan de Rock, je dispose de ma salle de concert (Falstaff). Je vous', 13, '2014-06-13'),
('Leopold En Carton', '0398a2cbcebe784d10360562c28a4b07', 'Leopold@carton.com', NULL, 0, '1988-03-18', 'Boulogne', 92, '', 'mdp = lec', 14, '2014-06-13'),
('La petite nouvelle', '04be3f29478fa952ad84aee74e0cff65', 'lanouvelle@new.com', NULL, 60, '1969-05-05', 'Beauvais', 1, '', 'mdp = lpn', 16, '2014-06-13'),
('Le petit nouveau', '04be3f29478fa952ad84aee74e0cff65', 'lenouveau@new.com', NULL, 30, '1996-02-02', 'Beau', 0, '', 'mdp = lpn', 17, '2014-06-13'),
('ekjezfgl', 'f71dbe52628a3f83a77ab494817525c6', 'yoyo@gh.com', NULL, 34, '1993-03-03', 'elkfh', 0, '', '', 28, '2014-06-14'),
('qsgeih', 'e358efa489f58062f10dd7316b65649e', 'kjfg@dhj.vom', NULL, 56, '1993-03-03', 'paris', 0, '', '', 29, '2014-06-14');

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
('Leopold En Carton', 'L''as de trèfle', 'Triangle', 1, 1),
('Membre1', 'Make Your Choice', 'Batteur', 1, 1),
('Membre1', 'Vautour', 'Chanteur', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `piste`
--

INSERT INTO `piste` (`ID`, `Nom`, `Duree`, `Groupe`, `Album`) VALUES
(1, 'Open my Eyes', NULL, 'Hey Dude !', 'Oooh');

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
  `Horaires` varchar(100) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Departement` varchar(50) NOT NULL,
  `Telephone` int(20) NOT NULL,
  `DateCreation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Nom`),
  KEY `Adresse` (`Adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`Adresse`, `NbPlaces`, `Proprietaire`, `Photo`, `Photo2`, `Horaires`, `Nom`, `Departement`, `Telephone`, `DateCreation`) VALUES
('zdfz', 2, 'Membre1', 'PhotoDefaut.png', 'PhotoDefaut.png', 'de 12 à 12', 'salle1', '2', 2147483647, '2014-06-14 11:18:21');

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
('Membre1', '1 rue du Lieu dit 95350 S', 'Le Grand Devoreur', 1, 1),
('Membre1', 'zdfz', 'salle1', 1, 1),
('Membre2', '25 chemin des Imposteurs', 'Falstaff', 1, 1);

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
(1, 2, 1, 'Topic1', '', 2, 1402311538, 1402699098),
(2, 3, 1, 'Topic0Cat1', 'Test de TEXT de TOPIC.', 2, 1402311750, 1402311997),
(2, 3, 2, '', '<strong>Puis-je reply ?</strong>', 2, 1402311770, 1402311770),
(2, 3, 3, '', '<span style="text-decoration:underline;">Visiblement</span> oui ! :)', 2, 1402311785, 1402311785),
(2, 4, 2, '', 'Je peux repondre en tant que membre 2 ?', 3, 1402311977, 1402311977),
(2, 3, 4, '', 'Que disais-tu ? :)', 3, 1402311997, 1402311997),
(1, 2, 2, '', 'reponse 1', 2, 1402312396, 1402312396),
(3, 5, 1, 'Topic1Cat03', 'Message In', 2, 1402318479, 1402318597),
(3, 5, 2, '', 'Message avec des accents sur certains mot ins&eacute;r&eacute;s expr&egrave;s ! :)', 2, 1402318597, 1402318597),
(1, 2, 3, '', 'L&agrave; je peux r&eacute;pondre &agrave; un message laiss&eacute; sur <strong>le Forum</strong>. Tu vois Ricou ?!', 2, 1402421738, 1402421738),
(1, 6, 1, 'J''essaie les accents éèà', 'Ce message est compos&eacute; des plusieurs accents. Ceci est utilis&eacute; pour conna&icirc;tre les failles de la conversion en base de donn&eacute;es. Voyons ce que cet essai donne !', 14, 1402699074, 1402699074),
(1, 2, 4, '', 'y&#039;a rien d&#039;&eacute;crit sur ton topic ? :O', 14, 1402699098, 1402699098);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

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

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `Relation_entre_vote_et_groupe_lien_IdGroupe` FOREIGN KEY (`IdGroupe`) REFERENCES `groupe` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Relation_entre_vote_et_membre_lien_LoginMembre` FOREIGN KEY (`LoginMembre`) REFERENCES `membre` (`Login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
