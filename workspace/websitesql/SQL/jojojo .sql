-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 15 mrt 2018 om 22:20
-- Serverversie: 5.5.57-0ubuntu0.14.04.1
-- PHP-versie: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `jojojo`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `beschikbaar`
--

CREATE TABLE IF NOT EXISTS `beschikbaar` (
  `beschikbaar_id` int(11) NOT NULL AUTO_INCREMENT,
  `broodjes_id` int(11) NOT NULL,
  `klant_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`beschikbaar_id`),
  KEY `ID` (`beschikbaar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Gegevens worden uitgevoerd voor tabel `beschikbaar`
--

INSERT INTO `beschikbaar` (`beschikbaar_id`, `broodjes_id`, `klant_id`) VALUES
(1, 4, '5'),
(3, 1, NULL),
(4, 1, '2'),
(5, 1, ''),
(6, 1, '2'),
(7, 2, '4'),
(8, 2, '2'),
(9, 2, '2'),
(10, 2, '2'),
(11, 3, NULL),
(12, 3, '2'),
(13, 3, '2'),
(14, 3, '2'),
(15, 8, '2'),
(16, 8, '2'),
(17, 8, '2');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Broodjes`
--

CREATE TABLE IF NOT EXISTS `Broodjes` (
  `broodjes_id` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(50) NOT NULL,
  `Vegetarisch` int(11) NOT NULL,
  `prijs` int(11) NOT NULL,
  PRIMARY KEY (`broodjes_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Gegevens worden uitgevoerd voor tabel `Broodjes`
--

INSERT INTO `Broodjes` (`broodjes_id`, `Naam`, `Vegetarisch`, `prijs`) VALUES
(1, 'Broodje Mexicano', 0, 100),
(2, 'Broodje Worst', 0, 100),
(3, 'Saucijzen Broodje', 0, 100),
(4, 'Broodje Brie', 1, 100),
(5, 'Broodje Gezond', 1, 100),
(6, 'Broodje Kaas', 1, 100),
(7, 'Broodje Hamburger', 0, 100),
(8, 'Groentesoep', 0, 60),
(9, 'Tomatensoep', 0, 60),
(10, 'Mosterdsoep', 1, 60),
(11, 'Kippensoep', 0, 60),
(12, 'Champignonsoep', 1, 60);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leerlingnummer` varchar(50) NOT NULL,
  `wachtwoord` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Gegevens worden uitgevoerd voor tabel `login`
--

INSERT INTO `login` (`id`, `leerlingnummer`, `wachtwoord`) VALUES
(1, '149902', 'ikbenmatteo1'),
(2, '147320', 'ikbenbram1'),
(3, '148158', 'maartjexx'),
(4, '147021', 'kaas'),
(5, '.', '.'),
(6, '148166', 'ikbenhannah1'),
(7, '148742', 'ikbenmaud1'),
(8, '148510', 'ikbendaan1'),
(9, '148473', 'ikbenjens1'),
(10, '148165', 'ikbenstijn1'),
(11, '147301', 'ikbenleon1'),
(12, '146860', 'ikbenarthur1'),
(13, 'vnr', 'vnr');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Profiel`
--

CREATE TABLE IF NOT EXISTS `Profiel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Voornaam` varchar(50) NOT NULL,
  `Achternaam` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Gegevens worden uitgevoerd voor tabel `Profiel`
--

INSERT INTO `Profiel` (`id`, `Voornaam`, `Achternaam`) VALUES
(1, 'Matteo', 'Mazza'),
(2, 'Bram', 'Zijlstra'),
(3, 'Maartje', 'Tjeerdsma'),
(4, 'Sjoerd', 'Buitjes'),
(5, '.', '.'),
(6, 'Hannah', 'van Weerden'),
(7, 'Maud', 'Mulder'),
(8, 'Daan', 'Kahmann'),
(9, 'Jens', 'Oosting'),
(10, 'Stijn', 'Wardenaar'),
(11, 'León', 'van Dorp'),
(12, 'Arthur', 'List'),
(13, 'Rene', 'van der Veen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Rating`
--

CREATE TABLE IF NOT EXISTS `Rating` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `broodjes_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Gegevens worden uitgevoerd voor tabel `Rating`
--

INSERT INTO `Rating` (`rating_id`, `broodjes_id`, `rating`) VALUES
(1, 1, 2667),
(2, 2, 2667),
(3, 3, 2333),
(4, 4, 3667),
(5, 5, 3333),
(6, 6, 0),
(7, 7, 0),
(8, 8, 2667),
(9, 9, 3667),
(10, 10, 1333),
(11, 11, 3667),
(12, 12, 2333);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Soepen`
--

CREATE TABLE IF NOT EXISTS `Soepen` (
  `soep_id` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(50) NOT NULL,
  `Vegetarisch` int(11) NOT NULL,
  `Prijs` int(11) NOT NULL,
  PRIMARY KEY (`soep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `Soepen`
--

INSERT INTO `Soepen` (`soep_id`, `Naam`, `Vegetarisch`, `Prijs`) VALUES
(1, 'Groentesoep', 0, 1),
(2, 'Tomatensoep', 0, 1),
(3, 'Mosterdsoep', 1, 1),
(4, 'Kippensoep', 0, 1),
(5, 'Championsoep', 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `voorkeurslijst`
--

CREATE TABLE IF NOT EXISTS `voorkeurslijst` (
  `voorkeur_id` int(11) NOT NULL AUTO_INCREMENT,
  `leerlingnummer` varchar(11) NOT NULL,
  `broodjes_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`voorkeur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Gegevens worden uitgevoerd voor tabel `voorkeurslijst`
--

INSERT INTO `voorkeurslijst` (`voorkeur_id`, `leerlingnummer`, `broodjes_id`, `rating`) VALUES
(1, '149902', 1, 5),
(2, '149902', 2, 3),
(3, '149902', 3, 3),
(4, '149902', 4, 2),
(5, '149902', 5, 1),
(6, '149902', 8, 2),
(7, '149902', 9, 5),
(8, '149902', 10, 1),
(9, '149902', 11, 3),
(10, '149902', 12, 1),
(11, '147320', 1, 1),
(12, '147320', 2, 2),
(13, '147320', 3, 3),
(14, '147320', 4, 4),
(15, '147320', 5, 5),
(16, '147320', 8, 4),
(17, '147320', 9, 3),
(18, '147320', 10, 2),
(19, '147320', 11, 4),
(20, '147320', 12, 1),
(21, '147021', 1, 2),
(22, '147021', 2, 3),
(23, '147021', 3, 1),
(24, '147021', 4, 5),
(25, '147021', 5, 4),
(26, '147021', 8, 2),
(27, '147021', 9, 3),
(28, '147021', 10, 1),
(29, '147021', 11, 4),
(30, '147021', 12, 5);

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `Profiel`
--
ALTER TABLE `Profiel`
  ADD CONSTRAINT `Profiel_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `login` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
