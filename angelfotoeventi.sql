-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: 22 apr, 2012 at 01:23 PM
-- Versione MySQL: 5.1.36
-- Versione PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `angelfotoeventi`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin_pwd`
--

CREATE TABLE IF NOT EXISTS `admin_pwd` (
  `id_admin_pwd` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pwd` varchar(32) NOT NULL,
  PRIMARY KEY (`id_admin_pwd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `admin_pwd`
--

INSERT INTO `admin_pwd` (`id_admin_pwd`, `pwd`) VALUES
(1, '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Struttura della tabella `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id_album` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `id_categoria` int(32) unsigned NOT NULL,
  `indice_ordinamento` int(32) unsigned NOT NULL,
  PRIMARY KEY (`id_album`),
  KEY `fk_album_categorie` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dump dei dati per la tabella `album`
--

INSERT INTO `album` (`id_album`, `nome`, `id_categoria`, `indice_ordinamento`) VALUES
(10, 'primo', 8, 3),
(11, 'Secondo!!', 8, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categoria` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `indice_ordinamento` int(32) unsigned NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`id_categoria`, `nome`, `indice_ordinamento`) VALUES
(8, 'Alberi d''autunno!!', 3),
(11, 'altro 2', 5),
(12, 'quattro', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `foto`
--

CREATE TABLE IF NOT EXISTS `foto` (
  `id_foto` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `tag` varchar(250) NOT NULL,
  `id_album` int(32) unsigned NOT NULL,
  `indice_ordinamento` int(32) NOT NULL,
  PRIMARY KEY (`id_foto`),
  KEY `fk_foto_album1` (`id_album`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dump dei dati per la tabella `foto`
--

INSERT INTO `foto` (`id_foto`, `nome`, `tag`, `id_album`, `indice_ordinamento`) VALUES
(4, 'AJAJA po', 'TAG', 11, 1),
(5, 'POPO!!!?!?', 'TAG', 11, 2),
(7, 'prova_Prod.png', 'TAG IMMAGINe', 10, 8),
(8, 'prova_cat.png', 'TAG IMMAGINE', 10, 7),
(9, 'prova_cat - Copia.png', 'TAG IMMAGINE', 10, 6),
(10, 'prova_cat.png', 'TAG IMMAGINE', 10, 9),
(11, 'ultima', 'TAG IMMAGINE', 10, 10),
(13, 'prova_cat.png', 'TAG IMMAGINE', 11, 4),
(14, 'prova_prod.png', 'TAG IMMAGINE', 11, 5);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `fk_album_categorie` FOREIGN KEY (`id_categoria`) REFERENCES `categorie` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `fk_foto_album1` FOREIGN KEY (`id_album`) REFERENCES `album` (`id_album`) ON DELETE NO ACTION ON UPDATE NO ACTION;
