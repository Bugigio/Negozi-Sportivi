-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 28, 2023 alle 18:37
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
  `id_articolo` int(11) NOT NULL,
  `email_utente` varchar(100) NOT NULL,
  `data/ora_acquisto` datetime NOT NULL,
  `carrello` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `acquistare`
--

INSERT INTO `acquistare` (`id_articolo`, `email_utente`, `data/ora_acquisto`, `carrello`) VALUES
(5, 'v@v', '2023-05-28 17:58:32', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo`
--

CREATE TABLE `articolo` (
  `quantita` int(3) NOT NULL,
  `tipo_articolo` varchar(25) NOT NULL,
  `percorso_immagine` varchar(200) NOT NULL,
  `nome_articolo` varchar(45) NOT NULL,
  `prezzo_acquisto` double(4,2) NOT NULL,
  `prezzo_vendita` double(4,2) NOT NULL,
  `rincaro` int(2) DEFAULT NULL,
  `ID_articolo` int(11) NOT NULL,
  `nome_magazzino` varchar(30) NOT NULL,
  `cod_offerta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `articolo`
--

INSERT INTO `articolo` (`quantita`, `tipo_articolo`, `percorso_immagine`, `nome_articolo`, `prezzo_acquisto`, `prezzo_vendita`, `rincaro`, `ID_articolo`, `nome_magazzino`, `cod_offerta`) VALUES
(32, 'pallone', 'img.jpg', 'carlo', 15.00, 20.00, NULL, 2, 'Pallavolo Everywhere', NULL),
(10, 'maglia', 'maglia.jpg', 'Maglia Calcio', 50.00, 80.00, 5, 3, 'Pallavolo Everywhere', NULL),
(5, 'racchetta', 'racchetta.jpg', 'Racchetta Tennis', 99.99, 99.99, NULL, 4, 'Pallavolo Everywhere', 2),
(15, 'pallone', 'pallone.jpg', 'Pallone Basket', 25.00, 35.00, 3, 5, 'Pallavolo Everywhere', 3),
(8, 'scarpe', 'scarpe.jpg', 'Scarpe Running', 99.99, 99.99, NULL, 6, 'Pallavolo Everywhere', 1);

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
  `reddito` double DEFAULT NULL,
  `nome_magazzino` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendenti`
--

CREATE TABLE `dipendenti` (
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitori`
--

CREATE TABLE `fornitori` (
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `fornitori`
--

INSERT INTO `fornitori` (`nome`) VALUES
('ciccio');

-- --------------------------------------------------------

--
-- Struttura della tabella `magazzino`
--

CREATE TABLE `magazzino` (
  `nome` varchar(30) NOT NULL,
  `capacita` int(3) NOT NULL DEFAULT 500
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `magazzino`
--

INSERT INTO `magazzino` (`nome`, `capacita`) VALUES
('Pallavolo Everywhere', 500);

-- --------------------------------------------------------

--
-- Struttura della tabella `newsletter`
--

CREATE TABLE `newsletter` (
  `email` varchar(100) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(15) NOT NULL,
  `citta` varchar(100) NOT NULL,
  `via` varchar(50) NOT NULL,
  `numero_civico` int(2) NOT NULL,
  `provincia` varchar(2) NOT NULL
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
  `citta` varchar(100) NOT NULL,
  `via` varchar(50) NOT NULL,
  `numero_civico` int(3) NOT NULL,
  `provincia` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`email`, `nome`, `cognome`, `password`, `citta`, `via`, `numero_civico`, `provincia`) VALUES
('v@v', 'v', 'v', 'v', 'v', 'v', 1, 'vv');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `acquistare`
--
ALTER TABLE `acquistare`
  ADD PRIMARY KEY (`id_articolo`,`email_utente`,`data/ora_acquisto`),
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
  ADD PRIMARY KEY (`cod_bilancio`),
  ADD KEY `bilancio_ibfk_1` (`nome_magazzino`);

--
-- Indici per le tabelle `dipendenti`
--
ALTER TABLE `dipendenti`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `fornitori`
--
ALTER TABLE `fornitori`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `magazzino`
--
ALTER TABLE `magazzino`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`email`);

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
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `ID_articolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `bilancio`
--
ALTER TABLE `bilancio`
  MODIFY `cod_bilancio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Limiti per la tabella `bilancio`
--
ALTER TABLE `bilancio`
  ADD CONSTRAINT `bilancio_ibfk_1` FOREIGN KEY (`nome_magazzino`) REFERENCES `magazzino` (`nome`) ON UPDATE CASCADE;

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
