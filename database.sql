-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 08:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tuinman`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'Tristan', 'admin'),
(2, 'Joran', 'admin'),
(3, 'Jaedyn', 'admin'),
(4, 'Jesse', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `hoofdpagina`
--

CREATE TABLE `hoofdpagina` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `persoon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoofdpagina`
--

INSERT INTO `hoofdpagina` (`id`, `foto`, `review`, `persoon`) VALUES
(1, 'tuin1.png', 'Heel erg bedankt voor de efficiënte service, je was heel snel klaar en ik zal je nummer zeker behouden om je weer te gebruiken.', 'Hella Hoes'),
(2, 'tuin2.png', 'Ga alsjeblieft door met de bezoeken aan het huis van mijn vader, want je doet geweldig werk!', 'Henk Haak'),
(3, 'tuin3.png', 'Zoals u weet ben ik altijd tevreden geweest met de service die u de afgelopen jaren heeft verleend. Vertel me alstublieft wanneer u klaar bent om volgend jaar weer te beginnen met het maaien van mijn gazons, aangezien ik graag uw diensten wil blijven ontvangen.', 'Hans Hogendijk'),
(4, 'tuin4.png', 'Bedankt voor de grondige opruimbeurt die u aan mijn tuin heeft uitgevoerd. De tuin is er enorm van opgeknapt en weer bruikbaar gemaakt. Nogmaals bedankt.', 'Hugo van Heren'),
(5, 'tuin5.png', 'Mijn tuin was een mijn jungle voor en achter. Ik ben zo blij met het resultaat; u heeft zo hard gewerkt en alles mooi en netjes achtergelaten. Aarzel niet om mijn opmerkingen te gebruiken in toekomstige advertenties. Nogmaals bedankt voor al je harde werk en efficiëntie!', 'Helga Hagel'),
(6, 'tuin6.png', 'We zijn erg blij met ons nieuwe dak van de schuur en het andere werk dat tot een zeer hoge standaard is voltooid. Heel erg bedankt voor uw medewerking!', 'Hopke Havermout'),
(7, 'tuin7.png', '', ''),
(8, 'tuin8.png', '', ''),
(9, 'tuin9.png', '', ''),
(10, 'tuin10.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `informatie`
--

CREATE TABLE `informatie` (
  `info_id` int(11) NOT NULL,
  `info_type` int(11) NOT NULL,
  `info_tekst` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informatie`
--

INSERT INTO `informatie` (`info_id`, `info_type`, `info_tekst`) VALUES
(1, 1, 'Tel: +31 6 12 34 56 78'),
(2, 1, 'Sms: 06 00 00 00 00'),
(3, 1, 'email: HendrikHogendijk@klantopdract.glu.nl'),
(4, 2, 'Maandag - vrijdag: 07.00 - 17.00 uur'),
(5, 2, 'Zaterdag: Op afspraak'),
(6, 2, 'Zondag: Gesloten');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'jesse', '$2y$10$kGwAneO6kVza25wESt11u.uNQTJGlJqAiI9XVz89GDRplkbrFMJTq'),
(2, 'dddd', '$2y$10$glMoD2I7FYGcOslC.h9zWub0TUGo6ymSacJDhSaiwefsZkX61vd.m');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoofdpagina`
--
ALTER TABLE `hoofdpagina`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informatie`
--
ALTER TABLE `informatie`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hoofdpagina`
--
ALTER TABLE `hoofdpagina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `informatie`
--
ALTER TABLE `informatie`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
