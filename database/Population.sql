-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 19, 2021 alle 01:42
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comodei`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `Utente` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`Utente`, `Password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struttura della tabella `attivita`
--

CREATE TABLE `attivita` (
  `Codice` int(11) NOT NULL AUTO_INCREMENT,
  `Titolo` varchar(80) NOT NULL,
  `Descrizione` varchar(1024) NOT NULL,
  `Link` varchar(80) DEFAULT NULL,
  `AltImmagine` varchar(600) NOT NULL,
  `Immagine` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `attivita` (`Titolo`, `Descrizione`, `Link`, `AltImmagine`, `Immagine`) VALUES 
('Mountain bike', 'La casa, essendo situata a Teolo, dista circa 15 minuti di macchina dai famosi Colli Euganei, meta molto ambita dagli appassionati di <span xml:lang="en"> mountain bike</span>. Nei colli padovani, infatti, vi sono numerosi sentieri e percorsi destinati ai ciclisti. 
Quest\'ultimi variano di difficoltà, garantendo divertimento sia ai principianti che ai maggiori esperti di questo sport.
In seguito presentiamo un <span xml:lang="en">link</span>ad un sito che riporta tutti i percorsi più conosciuti e frequentati.', 'https://www.ombremtb.it/category/itinerari-colli-euganei/percorsi-consigliati/', 'Immagine raffigurante una donna che pratica mountain bike in un sentiero montuoso', '../images/mtb.jpg'),
('Golf', 'Il golf è uno sport che consente di rilassarsi in mezzo alla natura, per questo i migliori campi da golf si trovano immersi in paesaggi idilliaci e offrono pace e tranquillità. Lo straordinario scenario delle colline euganee fa da cornice a tutti i campi, ciascuno dei quali gode di una particolare ed esclusiva prospettiva panoramica sui monti circostanti. La vicinanza tra i vari golf club e alle terme euganee, che tra loro distano solo pochi chilometri, consente ai turisti e ai visitatori di passaggio di giocare ogni giorno in un campo diverso. 
Tutti i campi da gioco sono curati nei minimi dettagli e offrono prati incantevoli e servizi d\'eccellenza.', 'https://www.collieuganei.it/golf/golf-club-frassanelle/', 'piedi di un uomo oppure donna mentre sta lanciando una pallina da golf dentro la buca', '../images/golf.jpg'),
('Parchi Avventura', 'Se siete amanti di vacanze più eccitanti, i Parchi Avventura presenti 
nell\'area boschiva dei Colli Euganei rappresentano la soluzione adatta a voi. Persone esperte vi guideranno attraverso percorsi di varia difficoltà per mettere alla prova le vostre abilità, ma senza prendersi troppo sul serio. Luoghi affascinanti e adrenalinici, in cui è possibile cimentarsi con il Tarzaning in un\'atmosfera di sicurezza e divertimento, i parchi avventura sono tutti differenti tra loro e ognuno con le proprie peculiarità.', 'https://www.collieuganei.it/parco-avventura/parco-avventura-le-fiorine/', 'Immagine con due bambine e un 
bambino che stanno attraversando un percorso in aria da un\'albero all\'altro', '../images/parco.jpg'),
('Ciclismo', 'Le principali attrattive offerte dal territorio possono essere apprezzate anche in sella 
della propria bicicletta:l\'Anello Ciclabile dei Colli Euganei (E2) propone itinerari facili che possono essere affrontati anche da chi è poco allenato, mentre addentrandosi nel comprensorio si incontrano itinerari caratterizzati da salite più impegnative e particolarmente amate dai ciclisti della zona.', 'https://www.collieuganei.it/ciclovie/anello-colli-euganei/', 'ciclista vestito di giallo che sta pedalando velocemente, nello sfondo si vede il mare', '../images/ciclismo.jpg'),
('Arrampicata', 'Se trekking e percorsi ciclistici non dovessero bastare, 
l\'arrampicata è quello che ci vuole! La palestra di Rocca Pendice a Teolo rappresenta un punto di riferimento per gli esperti scalatori e luogo di allenamento per le scuole di alpinismo presenti in tutta la provincia di Padova. Le arrampicate più o meno impegnative possono essere affrontate in totale sicurezza, grazie alla predisposizione di protezioni fisse e mobili.', 'https://www.collieuganei.it/parchi-aree-naturalistiche/rocca-pendice/', 'immagine di una donna che si sta arrampicando in un monte in una bella giornata di sole, si vede il cielo azzurro con qualche nuvola.', '../images/arrampicata.jpg');
-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `CodiceFiscale` varchar(16) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Cellulare` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Carta` varchar(16) NOT NULL,
  `DataNascita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`CodiceFiscale`, `Nome`, `Cognome`, `Cellulare`, `Email`, `Carta`, `DataNascita`) VALUES 
('ASDBDG99B14G361V', 'Piero', 'Pierino', '3471231231', 'pieropierino@gmail.com', '4943321930301210', '1999-12-12'),
('ASDBDF99B14G361V', 'Mario', 'Marietto','3472231231', 'mariomarietto@gmail.com', '4943321930301211', '1999-12-11'),
('ASDBDH99B14G361V', 'Lucia', 'Aldini', '3474231231', 'aldoaldini@gmail.com', '4943321930301212', '1999-12-13'),
('ASDBDV99B14G361V', 'Luca', 'Luchino', '3475231231', 'lucaluchino@gmail.com', '4943321930301213', '1999-12-14'),
('ASDBDP99B14G361V', 'Cesare', 'Cesarini', '3476231231', 'cesarecesarini@gmail.com', '4943321930301214', '1999-12-15'),
('ASDBDL99B14G361V', 'Sciok', 'Sciokkino', '3477231231', 'scioksciokkino@gmail.com', '4943321930301215', '1999-12-16');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `Codice` int(11) NOT NULL AUTO_INCREMENT,
  `DataCheckIn` date NOT NULL,
  `DataCheckOut` date NOT NULL,
  `Richieste` varchar(600) DEFAULT NULL,
  `CodiceFiscale` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `prenotazione`
--

INSERT INTO `prenotazione` (`DataCheckIn`, `DataCheckOut`, `Richieste`, `CodiceFiscale`) VALUES 
('2021-01-20', '2021-01-21', 'No', 'ASDBDF99B14G361V'),
('2021-02-20', '2021-02-21', 'No grazie', 'ASDBDH99B14G361V'),
('2021-03-20', '2021-03-21', '', 'ASDBDF99B14G361V'),
('2021-04-20', '2021-04-21', '', 'ASDBDH99B14G361V'),
('2021-05-20', '2021-05-21', '', 'ASDBDV99B14G361V'),
('2021-06-20', '2021-06-21', '', 'ASDBDV99B14G361V'),
('2021-07-20', '2021-07-21', '', 'ASDBDF99B14G361V'),
('2021-08-20', '2021-08-21', '', 'ASDBDL99B14G361V');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Utente`);

--
-- Indici per le tabelle `attivita`
--
ALTER TABLE `attivita`
  ADD PRIMARY KEY (`Codice`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CodiceFiscale`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`Codice`),
  ADD KEY `CodiceFiscale` (`CodiceFiscale`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `attivita`
--
ALTER TABLE `attivita`
  MODIFY `Codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `Codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `Prenotazione_ibfk_1` FOREIGN KEY (`CodiceFiscale`) REFERENCES `cliente` (`CodiceFiscale`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
