-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 30 Octobre 2013 à 23:11
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `mpv`
--

-- --------------------------------------------------------

--
-- Structure de la table `body`
--

DROP TABLE IF EXISTS `body`;
CREATE TABLE IF NOT EXISTS `body` (
  `nid` int(11) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `carrousel`
--

DROP TABLE IF EXISTS `carrousel`;
CREATE TABLE IF NOT EXISTS `carrousel` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `alt` varchar(100) NOT NULL,
  `weight` int(1) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `node`
--

DROP TABLE IF EXISTS `node`;
CREATE TABLE IF NOT EXISTS `node` (
  `nid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du node',
  `type` varchar(20) NOT NULL COMMENT 'Type du node (page, article, ...)',
  `title` varchar(255) NOT NULL COMMENT 'Le titre du node',
  `uid` int(11) NOT NULL COMMENT 'Identifiant de l''auteur',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'État de publication',
  `promote` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Promu en page d''accueil',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Annuaire de la base' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `router`
--

DROP TABLE IF EXISTS `router`;
CREATE TABLE IF NOT EXISTS `router` (
  `nid` int(11) NOT NULL COMMENT 'Identifiant du node',
  `alias` varchar(255) NOT NULL COMMENT 'Nom machine',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`uid`, `nom`, `prenom`, `pseudo`, `password`, `role`) VALUES
(1, 'Admin', 'Admin', 'admin', '8d385c43a93e4809eb3f6cd2354b7169', 'admin'),
(2, 'Demo', 'Demo', 'demo', '09a03d30dbf215253f9ab8bf245dd42d', 'contributor'),
(3, 'Guest', 'Guest', 'guest', '62f94a9d4f0cf2335f3b9557aa6416d9', 'Subscriber');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
