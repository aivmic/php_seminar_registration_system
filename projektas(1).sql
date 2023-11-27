-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2023 at 10:56 PM
-- Server version: 5.7.35-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projektas`
--

-- --------------------------------------------------------

--
-- Table structure for table `Kursantai`
--

CREATE TABLE `Kursantai` (
  `kursanto_id` int(11) NOT NULL,
  `lektoriaus_id` int(11) DEFAULT NULL,
  `naudotojo_id` int(11) DEFAULT NULL,
  `seminaro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Naudotojai`
--

CREATE TABLE `Naudotojai` (
  `naudotojo_id` int(11) NOT NULL,
  `slapyvardis` varchar(255) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci DEFAULT NULL,
  `slaptazodis` varchar(255) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci DEFAULT NULL,
  `vardas` varchar(255) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci DEFAULT NULL,
  `pavarde` varchar(255) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci DEFAULT NULL,
  `el_pastas` varchar(255) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci DEFAULT NULL,
  `registracijos_data` date DEFAULT NULL,
  `tipas` varchar(255) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Naudotojai`
--

INSERT INTO `Naudotojai` (`naudotojo_id`, `slapyvardis`, `slaptazodis`, `vardas`, `pavarde`, `el_pastas`, `registracijos_data`, `tipas`) VALUES
(3, 'tomaitis', '$2y$10$gIf35IioeFGI.XREqlvcgOmyabII55QHwPVbhMmrrFEyr3qt7Qutq', 'Tomaitis', 'Tomas', 'jaleje6169@fesgrid.com', '2023-10-31', 'lektor'),
(4, 'aivmic2', '$2y$10$KZdFsbTAjr3Hi11SMfapeefDCclPDox4ypsNhWeefg3Bg/FRDH8j2', 'ads', 'asd', 'asd@gmail.com', '2023-10-29', 'regular'),
(5, 'asd', '$2y$10$zcvF2MWi0pkuWlocLN6wt.IecDNy6bthcldvzomb81EyI4MZEjr9S', 'asd', 'asd', 'tomas@gmail.com', '2023-11-07', 'regular'),
(6, 'sdf', '$2y$10$vDKH0vgo2CQ0wFOTH6.6zuQ6XNBHsny10Xd5S0clE60qjmkN0iTeK', 'sdf', 'sdf', 'jaleje6169@fesgrid.com', '2023-11-21', 'regular'),
(7, 'tomas', '$2y$10$6Qgn1vrKO8DBPHYvNY/73eL1EF0HHsIvMG9Okopb9Yi1tQm2oe9L.', 'Tomas', 'Tomaitis', 'jaleje6169@fesgrid.com', '2023-11-15', 'listener'),
(8, 'qweqeqwe', '$2y$10$aOcpYEL7Dx5TC0U4qgFbB.33Hgb2Zh1WW6CG/Gs9AXI5zUBWFimxG', 'qweqwe', 'qweqweq', 'qweqweqwe@gmail.com', '2023-11-15', 'admin'),
(9, 'lektorius', '$2y$10$YPyJpp5I2azgXqZsuTPosuc4aX/sZVBOSTOqJ8bFl4Oyszi6VnVzO', 'ads', 'asd', 'tomas@gmail.com', '2023-11-15', 'lektor'),
(10, 'jonasjablonskis', '$2y$10$JesSlvRJ2z.M5L.sTnHW6OBM5Eoecm1kngoJivsgXNrH1VqxmkROW', 'Jonas', 'Jablonskis', 'jaleje6169@fesgrid.com', '2023-11-15', 'lektor'),
(11, 'adminas', '$2y$10$muJ/6e0AkjPEQ/kFRXzUX.iRjbIJlBymIF4apezo2ghn1ylec2KQ6', 'adminas', 'adminas', 'jaleje6169@fesgrid.com', '2023-11-15', 'admin'),
(12, 'lenkas', '$2y$10$4uX9L3xCHG.pnsHDtiNnCOQAd//ephP18Ht8zQsfxO7Zu7vsNx8SO', 'lenkas', 'lenkas', 'aivaras@aivaras.com', '2023-11-15', 'admin'),
(13, 'administratorius', '$2y$10$s7sVkuBO2/8s1N3/pwNLkucXpyoYmFXM.ZMTOyOnEph8fYWMEA5Ny', 'administratorius', 'administratorius', 'tomas@gmail.com', '2023-11-16', 'admin'),
(14, 'studentas', '$2y$10$Z9kOiuf0nJVptqu6yb/2KuzdqQlRS2Bg.NrHsehIDiCq0spTw2aWa', 'studentas', 'studentas', 'jaleje6169@fesgrid.com', '2023-11-16', 'listener'),
(15, 'lektorius', '$2y$10$EfXFMVSClvRKmupJRK/5QOrpeskqFmVSz1ungv30TPcaX/lUumCw6', 'lektorius', 'lektorius', 'lektorius@gmail.com', '2023-11-16', 'lektor'),
(16, 'lektoriuss', '$2y$10$Ks.IQi03AF2H6Z1/4825UOFmTKugRWQW.2T.tBZzkbWGG7DzkFATO', 'lektoriuss', 'lektoriuss', 'tomas@gmail.com', '2023-11-16', 'lektor'),
(17, 'paprastassss', '$2y$10$t0E78WGYexEUln2TiV0kFefRCunJp.YfN44psC740/14RwVe3H9mK', 'paprastassss', 'paprastassss', 'aivaras@aivaras.com', '2023-11-16', 'listener'),
(18, 'adminnnnn', '$2y$10$gaKa6qo4/tNaHsrMHsV8Pu0wgP8hhpRz2As8HlZhienBvFFZ.ZxGi', 'adminnnnn', 'adminnnnn', 'tomas@gmail.com', '2023-11-16', 'admin'),
(19, 'studentassss', '$2y$10$rJk9I07wIgHMp7Q6sJxqxuZQqNJBg7i.hBe3rwIpiGEjHRID6GyI6', 'studentassss', 'studentassss', 'studentassss@gmail.com', '2023-11-16', 'listener'),
(20, 'lektoriussss', '$2y$10$2YJart3ONPhpsDEFFsCkF.Qne9Ebd5USez1v4wvRvFM2aioNLFEQW', 'lektoriussss', 'lektoriussss', 'tomas@gmail.com', '2023-11-16', 'lektor');

-- --------------------------------------------------------

--
-- Table structure for table `Seminarai`
--

CREATE TABLE `Seminarai` (
  `seminaro_id` int(11) NOT NULL,
  `pavadinimas` varchar(255) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci DEFAULT NULL,
  `aprasymas` varchar(255) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci DEFAULT NULL,
  `laikas` datetime DEFAULT NULL,
  `kaina` decimal(10,2) DEFAULT NULL,
  `vietu_skaicius` int(11) DEFAULT NULL,
  `vedantis_lektorius` varchar(255) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci DEFAULT NULL,
  `perziuros` int(11) DEFAULT '0',
  `registracija_uzdaryta` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Seminarai`
--

INSERT INTO `Seminarai` (`seminaro_id`, `pavadinimas`, `aprasymas`, `laikas`, `kaina`, `vietu_skaicius`, `vedantis_lektorius`, `perziuros`, `registracija_uzdaryta`) VALUES
(1, 'Seminaras', 'Seminaras', '2023-11-09 13:48:00', '15.00', 20, 'Jonas Klebonas', 16, 1),
(2, 'Testavimas', 'Testavimas', '2023-11-08 15:39:00', '15.00', 15, 'Jonas Jonaitis', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Uzsiregistravimas`
--

CREATE TABLE `Uzsiregistravimas` (
  `uzsiregistravimo_id` int(11) NOT NULL,
  `seminaro_id` int(11) DEFAULT NULL,
  `naudotojo_id` int(11) DEFAULT NULL,
  `uzsiregistravimo_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Uzsiregistravimas`
--

INSERT INTO `Uzsiregistravimas` (`uzsiregistravimo_id`, `seminaro_id`, `naudotojo_id`, `uzsiregistravimo_data`) VALUES
(1, 1, 14, '2023-11-16'),
(2, 1, 14, '2023-11-16'),
(3, 1, 14, '2023-11-16'),
(4, 1, 14, '2023-11-16'),
(5, 1, 14, '2023-11-16'),
(6, 1, 14, '2023-11-16'),
(7, 2, 17, '2023-11-16'),
(8, 1, 17, '2023-11-16'),
(9, 1, 19, '2023-11-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Kursantai`
--
ALTER TABLE `Kursantai`
  ADD PRIMARY KEY (`kursanto_id`),
  ADD KEY `lektoriaus_id` (`lektoriaus_id`),
  ADD KEY `naudotojo_id` (`naudotojo_id`),
  ADD KEY `seminaro_id` (`seminaro_id`);

--
-- Indexes for table `Naudotojai`
--
ALTER TABLE `Naudotojai`
  ADD PRIMARY KEY (`naudotojo_id`);

--
-- Indexes for table `Seminarai`
--
ALTER TABLE `Seminarai`
  ADD PRIMARY KEY (`seminaro_id`);

--
-- Indexes for table `Uzsiregistravimas`
--
ALTER TABLE `Uzsiregistravimas`
  ADD PRIMARY KEY (`uzsiregistravimo_id`),
  ADD KEY `seminaro_id` (`seminaro_id`),
  ADD KEY `naudotojo_id` (`naudotojo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Kursantai`
--
ALTER TABLE `Kursantai`
  MODIFY `kursanto_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Naudotojai`
--
ALTER TABLE `Naudotojai`
  MODIFY `naudotojo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `Seminarai`
--
ALTER TABLE `Seminarai`
  MODIFY `seminaro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Uzsiregistravimas`
--
ALTER TABLE `Uzsiregistravimas`
  MODIFY `uzsiregistravimo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Kursantai`
--
ALTER TABLE `Kursantai`
  ADD CONSTRAINT `Kursantai_ibfk_1` FOREIGN KEY (`lektoriaus_id`) REFERENCES `Naudotojai` (`naudotojo_id`),
  ADD CONSTRAINT `Kursantai_ibfk_2` FOREIGN KEY (`naudotojo_id`) REFERENCES `Naudotojai` (`naudotojo_id`),
  ADD CONSTRAINT `Kursantai_ibfk_3` FOREIGN KEY (`seminaro_id`) REFERENCES `Seminarai` (`seminaro_id`);

--
-- Constraints for table `Uzsiregistravimas`
--
ALTER TABLE `Uzsiregistravimas`
  ADD CONSTRAINT `Uzsiregistravimas_ibfk_1` FOREIGN KEY (`seminaro_id`) REFERENCES `Seminarai` (`seminaro_id`),
  ADD CONSTRAINT `Uzsiregistravimas_ibfk_2` FOREIGN KEY (`naudotojo_id`) REFERENCES `Naudotojai` (`naudotojo_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
