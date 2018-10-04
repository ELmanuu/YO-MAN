-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Okt 2018 um 20:40
-- Server-Version: 10.1.28-MariaDB
-- PHP-Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `yoman`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `automobile`
--

CREATE TABLE `automobile` (
  `id` int(11) NOT NULL,
  `kennzeichen` varchar(11) NOT NULL,
  `marke` varchar(30) NOT NULL,
  `modell` varchar(50) NOT NULL,
  `besitzer` varchar(50) NOT NULL,
  `erstzulassung` date NOT NULL,
  `letzter_tuev` date NOT NULL,
  `notizen` varchar(200) NOT NULL,
  `service` tinyint(1) NOT NULL,
  `version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `automobile`
--

INSERT INTO `automobile` (`id`, `kennzeichen`, `marke`, `modell`, `besitzer`, `erstzulassung`, `letzter_tuev`, `notizen`, `service`, `version`) VALUES
(1, 'K-YT 1989', 'BMW', '325e', 'Matthias', '1989-10-09', '2016-10-08', 'Tolle Karre', 0, 1),
(2, 'K-OT 733 H', 'BMW', '2002tii', 'Hans-Günther', '1973-10-10', '2016-12-21', 'Hans sein tii', 1, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `automobile`
--
ALTER TABLE `automobile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `automobile`
--
ALTER TABLE `automobile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
