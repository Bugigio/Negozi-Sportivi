-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 22, 2023 alle 12:42
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
-- Struttura della tabella `acquistare`
--

CREATE TABLE `acquistare` (
  `cod_acquisto` int(11) NOT NULL,
  `id_articolo` int(11) NOT NULL,
  `email_utente` varchar(100) NOT NULL,
  `data_acquisto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Struttura della tabella `dipendenti`
--

CREATE TABLE `dipendenti` (
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(15) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL
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
  `negozio_ordinante` varchar(30) NOT NULL,
  `nome_fornitore` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `email` varchar(100) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(15) NOT NULL,
  `password` varchar(16) NOT NULL,
  `città` varchar(100) NOT NULL,
  `via` varchar(50) NOT NULL,
  `numero_civico` int(3) NOT NULL,
  `provincia` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `acquistare`
--
ALTER TABLE `acquistare`
  ADD PRIMARY KEY (`cod_acquisto`),
  ADD KEY `utente` (`email_utente`),
  ADD KEY `articolo` (`id_articolo`);

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`ID_articolo`),
  ADD KEY `magazzino` (`nome_magazzino`),
  ADD KEY `offerta` (`cod_offerta`);

--
-- Indici per le tabelle `bilancio`
--
ALTER TABLE `bilancio`
  ADD PRIMARY KEY (`cod_bilancio`);

--
-- Indici per le tabelle `dipendenti`
--
ALTER TABLE `dipendenti`
  ADD PRIMARY KEY (`username`);

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
  ADD PRIMARY KEY (`cod_ordine`),
  ADD KEY `nome_fornitore` (`nome_fornitore`),
  ADD KEY `nome_magazzino` (`negozio_ordinante`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `acquistare`
--
ALTER TABLE `acquistare`
  MODIFY `cod_acquisto` int(11) NOT NULL AUTO_INCREMENT;

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
-- Limiti per la tabella `acquistare`
--
ALTER TABLE `acquistare`
  ADD CONSTRAINT `articolo` FOREIGN KEY (`id_articolo`) REFERENCES `articolo` (`ID_articolo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `utente` FOREIGN KEY (`email_utente`) REFERENCES `utenti` (`email`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `articolo`
--
ALTER TABLE `articolo`
  ADD CONSTRAINT `magazzino` FOREIGN KEY (`nome_magazzino`) REFERENCES `magazzino` (`nome`) ON UPDATE CASCADE,
  ADD CONSTRAINT `offerta` FOREIGN KEY (`cod_offerta`) REFERENCES `offerte` (`ID_offerta`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `magazzino`
--
ALTER TABLE `magazzino`
  ADD CONSTRAINT `bilancio` FOREIGN KEY (`cod_bilancio`) REFERENCES `bilancio` (`cod_bilancio`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `nome_fornitore` FOREIGN KEY (`nome_fornitore`) REFERENCES `fornitori` (`nome`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nome_magazzino` FOREIGN KEY (`negozio_ordinante`) REFERENCES `magazzino` (`nome`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
