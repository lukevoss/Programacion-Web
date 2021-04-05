-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Apr 2021 um 00:38
-- Server-Version: 10.4.18-MariaDB
-- PHP-Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `examinator`
--

DELIMITER $$
--
-- Prozeduren
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetXRandQuestionsForEachTopic` (IN `mycourse` VARCHAR(50), IN `NoQuestionsToReturn` INT)  READS SQL DATA
BEGIN
	DECLARE done INT DEFAULT 0;
	DECLARE mytopic VARCHAR(100);
	
	
	-- OK, lets get my topics
	DECLARE cur CURSOR
    FOR
		SELECT DISTINCT `questionsTopic` 
		FROM `questions`
		WHERE `questionsAsig` = mycourse
		ORDER by `questionsTopic`;
        
   	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	
	-- create a temp table for my randomly picked questions
	DROP TEMPORARY TABLE IF EXISTS tblPickedQuestions;
	CREATE TEMPORARY TABLE IF NOT EXISTS tblPickedQuestions  (
		  `questionsAsig` varchar(50) NOT NULL,
		  `questionsTopic` varchar(100) NOT NULL,
		  `questionsQuestion_id` int(11) NOT NULL,
		  `questionsQuestion` text NOT NULL,
		  `questionsAnswer_1` varchar(256) NOT NULL,
		  `questionsAnswer_2` varchar(256) NOT NULL,
		  `questionsAnswer_3` varchar(256) NOT NULL,
		  `questionsAnswer_4` varchar(256) NOT NULL,
		  `questionsCorrect_answer` smallint(6) NOT NULL
  );

	-- lets do it: fetch randomly selected question for each topic, but only NoQuestionsToReturn please ;)
	-- Oh, and put them to my tmp table
	OPEN cur;
	SET done = 0;
	REPEAT
    FETCH cur INTO mytopic;
       INSERT INTO tblPickedQuestions SELECT * FROM `questions` WHERE `questionsAsig` =  mycourse AND `questionsTopic` = mytopic ORDER BY rand() LIMIT NoQuestionsToReturn;
	UNTIL done END REPEAT;
    CLOSE cur;
  SELECT * FROM tblPickedQuestions;
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answers`
--

CREATE TABLE `answers` (
  `answersUid` int(11) NOT NULL,
  `answersAsig` varchar(50) NOT NULL,
  `answersQuestion_id` int(11) DEFAULT NULL,
  `answersAnswer` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `courses`
--

CREATE TABLE `courses` (
  `coursesProfId` int(11) NOT NULL,
  `coursesAsig` varchar(50) NOT NULL,
  `coursesExam_running` tinyint(1) NOT NULL DEFAULT 0,
  `coursesNoQuestions` int(3) NOT NULL DEFAULT 20,
  `coursesFaculty` enum('Escuela de Ingeniería Naval y Oceánica','Escuela Politécnica Superior de Algeciras','Escuela Superior de Ingeniería','Facultad de Ciencias','Facultad de Ciencias de la Educación','Facultad de Ciencias del Mar y Ambientales','Facultad de Ciencias del Trabajo','Facultad de Ciencias Económicas y Empresariales','Escuela de Ingenierías Marina, Náutica y Radioelectrónica','Facultad de Ciencias Sociales y de la Comunicación','Facultad de Derecho','Facultad de Enfermería','Facultad de Enfermería y Fisioterapia','Facultad de Filosofía y Letras','Facultad de Medicina','Escuela de Doctorado de la Universidad de Cádiz','Escuela Internacional de Doctorado en Estudios del Mar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `courses`
--

INSERT INTO `courses` (`coursesProfId`, `coursesAsig`, `coursesExam_running`, `coursesNoQuestions`, `coursesFaculty`) VALUES
(16, 'Inteligencia Artificial', 1, 4, 'Escuela Superior de Ingeniería'),
(15, 'Programación Web', 0, 20, 'Escuela Superior de Ingeniería'),
(16, 'Sistemas Inteligentes', 0, 20, 'Escuela Superior de Ingeniería');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `questions`
--

CREATE TABLE `questions` (
  `questionsAsig` varchar(50) NOT NULL,
  `questionsTopic` varchar(100) NOT NULL,
  `questionsQuestion_id` int(11) NOT NULL,
  `questionsQuestion` text NOT NULL,
  `questionsAnswer_1` varchar(256) NOT NULL,
  `questionsAnswer_2` varchar(256) NOT NULL,
  `questionsAnswer_3` varchar(256) NOT NULL,
  `questionsAnswer_4` varchar(256) NOT NULL,
  `questionsCorrect_answer` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `questions`
--

INSERT INTO `questions` (`questionsAsig`, `questionsTopic`, `questionsQuestion_id`, `questionsQuestion`, `questionsAnswer_1`, `questionsAnswer_2`, `questionsAnswer_3`, `questionsAnswer_4`, `questionsCorrect_answer`) VALUES
('Inteligencia Artificial', 'C++', 9, 'Test Question about C++?', 'Yes', 'No', '', '', 1),
('Inteligencia Artificial', 'C++', 10, 'Another Question?', 'No', 'Yes', 'Maybe', 'No way', 2),
('Inteligencia Artificial', 'C++', 11, 'What does while() do?', 'it executes the code', 'it does nothing', 'its a type of loop', 'its a C++ Standard Libary', 3),
('Inteligencia Artificial', 'Algorithm', 12, 'What does a Brute Force Algorithm do?', 'It forces the Code to ignore mistakes', 'This algorithm doesnt exist', 'It uses a type of neuronal network', 'It calculates every possible state', 4),
('Inteligencia Artificial', 'Algorithm', 13, 'Question about Alorithm?', 'A', 'B', 'C', 'D', 1),
('Inteligencia Artificial', 'Algorithm', 14, 'What is a Algorithm?', 'nothing', 'something', 'an Algorithm', '', 3),
('Inteligencia Artificial', 'C++', 15, 'Can this be true?', 'Yes', 'No', 'Absolutly not', 'Maybe', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stud`
--

CREATE TABLE `stud` (
  `studId` int(11) NOT NULL,
  `studAsig` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `stud`
--

INSERT INTO `stud` (`studId`, `studAsig`) VALUES
(10, 'Datenbanken'),
(10, 'Lappenwerfen'),
(2, 'Programación Web'),
(9, 'Programación Web'),
(2, 'Inteligencia Artificial'),
(9, 'Inteligencia Artificial');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `usersPos` enum('Student','Professor','Admin') NOT NULL DEFAULT 'Student',
  `usersFaculty` enum('Escuela de Ingeniería Naval y Oceánica','Escuela Politécnica Superior de Algeciras','Escuela Superior de Ingeniería','Facultad de Ciencias','Facultad de Ciencias de la Educación','Facultad de Ciencias del Mar y Ambientales','Facultad de Ciencias del Trabajo','Facultad de Ciencias Económicas y Empresariales','Escuela de Ingenierías Marina, Náutica y Radioelectrónica','Facultad de Ciencias Sociales y de la Comunicación','Facultad de Derecho','Facultad de Enfermería','Facultad de Enfermería y Fisioterapia','Facultad de Filosofía y Letras','Facultad de Medicina','Escuela de Doctorado de la Universidad de Cádiz','Escuela Internacional de Doctorado en Estudios del Mar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`, `usersPos`, `usersFaculty`) VALUES
(2, 'Henri Smidt', 'henri.smidt@t-online.de', 'henri', '$2y$10$2j9NAz76Ktr0wG3fR4NPT.J0vkv0yruc/jSAiWGueKb5BpJYxgZ4i', 'Student', 'Escuela Superior de Ingeniería'),
(9, 'Luke Voß', 'luke@familievoss.net', 'luke', '$2y$10$GKPccqq.e2Y4EQwosB015.KKZPEvnSVkoAOs66RywgpkweTV2Gbi2', 'Student', 'Escuela Superior de Ingeniería'),
(10, 'Student Informaticas', 'student@gmail.com', 'student_si', '$2y$10$8Zk6IP9RrM9M2rhew54XQ.ts8AIPeKi5OdX75Znfqk6QNCM.ax1pu', 'Student', 'Escuela Superior de Ingeniería'),
(11, 'Administration: Escuela de Ingeniería Naval y Oceánica', 'ino@example.com', 'admin_ino', '$2y$10$sg2IlPlmD84TLPDa.OM9Wut28nHRRo261fh/zDMHa/To8grU2xpJO', 'Admin', 'Escuela de Ingeniería Naval y Oceánica'),
(12, 'Administration: Escuela Politécnica Superior de Algeciras', 'psa@example.com', 'admin_psa', '$2y$10$LoNCEBkF.KMW/oL9Yp1jy.Z4pojv2HHPGJaJPmuMw5HVH3udWC6Am', 'Admin', 'Escuela Politécnica Superior de Algeciras'),
(13, 'Administration: Escuela Superior de Ingeniería', 'si@example.com', 'admin_si', '$2y$10$dLcmFQP5SeEzIMXIskJiSOKlq.0AfmbzQ3irVtiFXl6xx72pbxDHW', 'Admin', 'Escuela Superior de Ingeniería'),
(14, 'Administration: Facultad de Ciencias', 'fc@example.com', 'admin_fc', '$2y$10$AT9Q8LRX5vsmaH0pDRp/zOHEjoI0K2bwVwm4rRmmw9H0nJnes4eq.', 'Admin', 'Facultad de Ciencias'),
(15, 'Ignacio Javier Pérez Gálvez', 'ignaciojavier.perez@uca.es', 'nacho', '$2y$10$QCbbuZd/7Py/yxMgsaoZiO1hSH3TByujfmtylD5F8/rf3w4R54.ky', 'Professor', 'Escuela Superior de Ingeniería'),
(16, 'Elisa Guerrero Vázquez', 'elisa.guerrero@uca.es', 'elisa', '$2y$10$2BgP7E3u6G4iUL0s8U4FRuUn2HyqUD8ZVFOY2P9Y3qSr83gjabXXy', 'Professor', 'Escuela Superior de Ingeniería');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `courses`
--
ALTER TABLE `courses`
  ADD UNIQUE KEY `coursesAsig` (`coursesAsig`);

--
-- Indizes für die Tabelle `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionsQuestion_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `questions`
--
ALTER TABLE `questions`
  MODIFY `questionsQuestion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
