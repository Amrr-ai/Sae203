-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql-saesql.alwaysdata.net
-- Generation Time: Jun 22, 2026 at 04:42 PM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 8.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saesql_203`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `auteur_id` int(11) DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `chapo` longtext NOT NULL,
  `contenu` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp() COMMENT '(DC2Type:datetime_immutable)',
  `lien_yt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `auteur_id`, `titre`, `chapo`, `contenu`, `image`, `date_creation`, `lien_yt`) VALUES
(1, 2, 'Mise en ligne du site web', 'Projet web dynamique réalisé dans le cadre de la SAÉ 203.', 'Ce site web a été réalisé dans le cadre de la SAÉ 203 afin de mettre en pratique la création d’un front-office et d’un back-office connectés à une base de données.\r\n\r\n', 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2026-07-19 20:53:00', ''),
(2, 1, 'Développement de l’administration', 'Une administration pensée pour gérer les contenus du site.', 'La partie administration permet de gérer les contenus du site, notamment les articles et les auteurs, grâce aux formulaires et à la base de données.', 'https://images.unsplash.com/photo-1554098415-788601c80aef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2026-07-19 20:53:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `auteur`
--

CREATE TABLE `auteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `lien_twitter` varchar(255) NOT NULL,
  `lien_avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auteur`
--

INSERT INTO `auteur` (`id`, `nom`, `prenom`, `lien_twitter`, `lien_avatar`) VALUES
(1, 'Osei-Mohamend', 'Ammar', 'https://twitter.com/universitecergy', 'https://pplx-res.cloudinary.com/image/upload/pplx_search_images/59349aabd4160ac20fa20db81448dfa5e2b0f947.jpg\r\n'),
(2, 'Mbumba', 'Emmanuel', 'https://twitter.com/universitecergy', 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png'),
(3, 'Thomas', 'Martin', 'https://twitter.com/universitecergy', 'https://cdn.pixabay.com/photo/2018/11/13/21/43/avatar-3814049_1280.png'),
(4, 'Martin', 'Pauline', 'https://twitter.com/universitecergy', 'https://cdn.pixabay.com/photo/2016/03/31/17/33/avatar-1293744_1280.png'),
(5, 'Dupont', 'Jean', 'https://twitter.com/universitecergy', 'https://cdn.pixabay.com/photo/2017/01/10/03/54/avatar-1968236_1280.png\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp() COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `nom`, `prenom`, `email`, `contenu`, `type`, `date_creation`) VALUES
(1, 'Martin', 'Thomas', 'm.thomas43@yopmail.com', 'Je suis intéressé par la formation.', 'etudiant', '2022-04-13 08:28:01'),
(2, 'Despoux', 'Helena', 'h.despoux@foo.fr', 'Je suis intéressé par la formation.', 'etudiant', '2022-04-13 08:28:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E6660BB6FE6` (`auteur_id`);

--
-- Indexes for table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E6660BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
