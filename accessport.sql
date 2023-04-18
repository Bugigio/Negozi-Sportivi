-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 18, 2023 alle 12:56
-- Versione del server: 10.4.25-MariaDB
-- Versione PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accessport`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo`
--

CREATE TABLE `articolo` (
  `quantità` int(3) NOT NULL,
  `tipo_articolo` varchar(25) NOT NULL,
  `nome_articolo` varchar(45) NOT NULL,
  `prezzo_acquisto` double(4,2) NOT NULL,
  `prezzo_vendita` double(4,2) NOT NULL,
  `rincaro` int(2) DEFAULT NULL,
  `ID_articolo` int(11) NOT NULL,
  `nome_magazzino` varchar(30) NOT NULL,
  `cod_offerta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `bilancio`
--

CREATE TABLE `bilancio` (
  `costi` double DEFAULT NULL,
  `ricavi` double DEFAULT NULL,
  `profitti` double DEFAULT NULL,
  `rincaro_20` tinyint(1) NOT NULL,
  `cod_bilancio` int(11) NOT NULL,
  `reddito` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `esaudire`
--

CREATE TABLE `esaudire` (
  `cod_esaudimento` int(11) NOT NULL,
  `cod_ordine` int(11) NOT NULL,
  `nome_fornitore` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitori`
--

CREATE TABLE `fornitori` (
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `magazzino`
--

CREATE TABLE `magazzino` (
  `nome` varchar(30) NOT NULL,
  `capacita` int(3) NOT NULL DEFAULT 500,
  `cod_bilancio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `offerte`
--

CREATE TABLE `offerte` (
  `ID_offerta` int(11) NOT NULL,
  `percentuale_sconto` int(2) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `nome_articolo` varchar(50) NOT NULL,
  `quantità` int(2) NOT NULL,
  `costo` int(5) NOT NULL,
  `data_ordine` date NOT NULL,
  `tipo_articolo` varchar(50) NOT NULL,
  `cod_ordine` int(11) NOT NULL,
  `negozio_ordinante` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`ID_articolo`);

--
-- Indici per le tabelle `bilancio`
--
ALTER TABLE `bilancio`
  ADD PRIMARY KEY (`cod_bilancio`);

--
-- Indici per le tabelle `esaudire`
--
ALTER TABLE `esaudire`
  ADD PRIMARY KEY (`cod_esaudimento`),
  ADD KEY `fornitore` (`nome_fornitore`),
  ADD KEY `ordine` (`cod_ordine`);

--
-- Indici per le tabelle `fornitori`
--
ALTER TABLE `fornitori`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `magazzino`
--
ALTER TABLE `magazzino`
  ADD PRIMARY KEY (`nome`),
  ADD KEY `bilancio` (`cod_bilancio`);

--
-- Indici per le tabelle `offerte`
--
ALTER TABLE `offerte`
  ADD PRIMARY KEY (`ID_offerta`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`cod_ordine`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `ID_articolo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `bilancio`
--
ALTER TABLE `bilancio`
  MODIFY `cod_bilancio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `offerte`
--
ALTER TABLE `offerte`
  MODIFY `ID_offerta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `cod_ordine` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `esaudire`
--
ALTER TABLE `esaudire`
  ADD CONSTRAINT `fornitore` FOREIGN KEY (`nome_fornitore`) REFERENCES `fornitori` (`nome`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ordine` FOREIGN KEY (`cod_ordine`) REFERENCES `ordini` (`cod_ordine`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `magazzino`
--
ALTER TABLE `magazzino`
  ADD CONSTRAINT `bilancio` FOREIGN KEY (`cod_bilancio`) REFERENCES `bilancio` (`cod_bilancio`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
