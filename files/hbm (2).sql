-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 10:59 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hbm`
--

-- --------------------------------------------------------

--
-- Table structure for table `hopitaux`
--

CREATE TABLE `hopitaux` (
  `id_hopital` int(10) UNSIGNED NOT NULL,
  `nom_hopital` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hopitaux`
--

INSERT INTO `hopitaux` (`id_hopital`, `nom_hopital`, `username`, `password`) VALUES
(1, 'CHU Ibn Badis de Constantine', 'chu', 'chu'),
(2, 'EHS Psychiatrie de Djebel Ouahch', 'hopitalDjebelOuahch', 'hopitalDjebelOuahch'),
(3, 'Hôpital Mohamed Boudiaf El Khroub', 'hopitalElKhroub', 'hopitalElKhroub'),
(4, 'EH Didiouche Mourad', 'hopitalDidouche', 'hopitalDidouche'),
(5, 'Hôpital El Bir de Constantine', 'hopitalElBir', 'hopitalElBir');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id_patient` int(11) UNSIGNED NOT NULL,
  `id_hopital` int(10) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `dateDeNaissance` date NOT NULL,
  `sexe` enum('homme','femme') NOT NULL,
  `email` varchar(50) NOT NULL,
  `numtlp` varchar(50) NOT NULL,
  `dossierMed` varchar(50) NOT NULL,
  `dateDeReservation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateHospitalisation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id_patient`, `id_hopital`, `nom`, `prenom`, `dateDeNaissance`, `sexe`, `email`, `numtlp`, `dossierMed`, `dateDeReservation`, `dateHospitalisation`) VALUES
(145, 1, 'Hafdi', 'Mohamed Achraf', '2022-06-08', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-13 00:04:11', '2022-06-14'),
(146, 1, 'Hafdi', 'Mohamed Achraf', '2022-06-08', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-13 00:04:12', '2022-06-14'),
(147, 1, 'Hafdi', 'Mohamed Achraf', '2022-06-08', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-13 00:04:14', '2022-06-14'),
(148, 1, 'Hafdi', 'Mohamed Achraf', '2022-06-08', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-13 00:04:16', '2022-06-14'),
(149, 1, 'Hafdi', 'Mohamed Achraf', '2022-06-08', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-13 00:04:18', '2022-06-14'),
(150, 1, 'Hafdi', 'Mohamed Achraf', '2022-06-08', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-13 00:04:19', '2022-06-14'),
(151, 1, 'Hafdi', 'Mohamed Achraf', '2022-06-08', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-13 00:04:23', '2022-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `patients_admis`
--

CREATE TABLE `patients_admis` (
  `id_patient` int(11) UNSIGNED NOT NULL,
  `id_hopital` int(10) UNSIGNED NOT NULL,
  `service` varchar(50) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `dateDeNaissance` date NOT NULL,
  `sexe` enum('homme','femme') NOT NULL,
  `email` varchar(50) NOT NULL,
  `numtlp` varchar(15) NOT NULL,
  `dossierMed` varchar(50) NOT NULL,
  `dateDeReservation` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateHospitalisation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients_admis`
--

INSERT INTO `patients_admis` (`id_patient`, `id_hopital`, `service`, `nom`, `prenom`, `dateDeNaissance`, `sexe`, `email`, `numtlp`, `dossierMed`, `dateDeReservation`, `dateHospitalisation`) VALUES
(1, 1, 'service covid-19', 'Hafdi', 'Mohamed Achraf', '2022-06-21', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-12 17:56:31', '2022-06-03'),
(2, 1, 'service covid-19', 'Hafdi', 'Mohamed Achraf', '2022-06-21', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-12 17:56:35', '2022-06-03'),
(3, 1, 'service covid-19', 'Hafdi', 'Mohamed Achraf', '2022-06-15', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-12 22:37:15', '2022-06-16'),
(4, 1, 'service de cardiologie', 'Hafdi', 'Mohamed Achraf', '2022-06-15', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-12 22:37:17', '2022-06-16'),
(5, 1, 'service du maladie générale', 'Hafdi', 'Mohamed Achraf', '2022-06-15', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-12 22:37:19', '2022-06-16'),
(6, 1, 'service urgence', 'Hafdi', 'Mohamed Achraf', '2022-06-15', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-12 22:37:20', '2022-06-16'),
(7, 1, 'service urgence', 'Hafdi', 'Mohamed Achraf', '2022-06-15', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-12 22:37:22', '2022-06-16'),
(8, 1, 'service covid-19', 'Hafdi', 'Mohamed Achraf', '2022-06-15', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-12 22:37:24', '2022-06-16'),
(9, 1, 'service de cardiologie', 'Hafdi', 'Mohamed Achraf', '2022-06-15', 'homme', 'mohamed.hafdi@univ-constantine2.dz', '698969273', '', '2022-06-12 22:37:26', '2022-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `nom_service` varchar(50) NOT NULL,
  `id_hopital` int(10) UNSIGNED NOT NULL,
  `nbre_lit_tot` int(50) NOT NULL,
  `nbre_lit_occ` int(50) NOT NULL,
  `nbre_lit_vac` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`nom_service`, `id_hopital`, `nbre_lit_tot`, `nbre_lit_occ`, `nbre_lit_vac`) VALUES
('service chirugie générale', 5, 20, 5, 15),
('service covid-19', 1, 56, 44, 12),
('service covid-19', 2, 40, 20, 20),
('service covid-19', 3, 50, 0, 50),
('service covid-19', 4, 80, 0, 80),
('service covid-19', 5, 40, 20, 20),
('service de cardiologie', 1, 200, 12, 188),
('service de cardiologie', 3, 70, 0, 70),
('service de cardiologie', 4, 30, 0, 30),
('service de cardiologie', 5, 30, 10, 20),
('service de la médecine générale', 5, 26, 10, 16),
('service de médecine générale', 2, 40, 10, 30),
('service de pédiatrie', 1, 120, 0, 120),
('service de pédiatrie', 4, 30, 0, 30),
('service du maladie générale', 1, 100, 6, 94),
('service du maladie générale', 4, 50, 0, 50),
('service neurologie', 2, 10, 7, 3),
('service urgence', 1, 100, 3, 97),
('service urgence', 2, 50, 20, 30),
('service urgence', 3, 80, 0, 80),
('service urgence', 4, 50, 0, 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hopitaux`
--
ALTER TABLE `hopitaux`
  ADD PRIMARY KEY (`id_hopital`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id_patient`),
  ADD KEY `FK_PatientsHopitaux` (`id_hopital`);

--
-- Indexes for table `patients_admis`
--
ALTER TABLE `patients_admis`
  ADD PRIMARY KEY (`id_patient`),
  ADD KEY `FK_PatientsHopitaux` (`id_hopital`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`nom_service`,`id_hopital`),
  ADD KEY `FK_ServicesHopitaux` (`id_hopital`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hopitaux`
--
ALTER TABLE `hopitaux`
  MODIFY `id_hopital` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id_patient` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `patients_admis`
--
ALTER TABLE `patients_admis`
  MODIFY `id_patient` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id_hopital` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `FK_PatientsHopitaux` FOREIGN KEY (`id_hopital`) REFERENCES `hopitaux` (`id_hopital`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_ServicesHopitaux` FOREIGN KEY (`id_hopital`) REFERENCES `hopitaux` (`id_hopital`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
