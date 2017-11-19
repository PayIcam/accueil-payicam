-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 20 nov. 2017 à 00:54
-- Version du serveur :  10.2.7-MariaDB
-- Version de PHP :  7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shotgun_prod`
--

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='elections-BDE-2017';

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id`, `name`, `slug`, `date_start`, `date_end`, `description`) VALUES
(1, 'Elections BDE 2017', 'elections-bde-2017', '2017-11-23 08:00:00', '2017-11-23 20:00:00', '1');

-- --------------------------------------------------------

--
-- Structure de la table `vote_has_voters`
--

CREATE TABLE `vote_has_voters` (
  `vote_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `promo` varchar(100) NOT NULL,
  `choice` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vote_option`
--

CREATE TABLE `vote_option` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `vote_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vote_option`
--

INSERT INTO `vote_option` (`id`, `title`, `slug`, `vote_id`) VALUES
(1, 'SKY', 'sky', 1),
(2, 'SP\'ARROW', 'sp-arrow', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vote_has_voters`
--
ALTER TABLE `vote_has_voters`
  ADD KEY `fk_vote_id_voter` (`vote_id`);

--
-- Index pour la table `vote_option`
--
ALTER TABLE `vote_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vote_id` (`vote_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `vote_option`
--
ALTER TABLE `vote_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `vote_has_voters`
--
ALTER TABLE `vote_has_voters`
  ADD CONSTRAINT `fk_vote_id_voter` FOREIGN KEY (`vote_id`) REFERENCES `vote` (`id`);

--
-- Contraintes pour la table `vote_option`
--
ALTER TABLE `vote_option`
  ADD CONSTRAINT `fk_vote_id` FOREIGN KEY (`vote_id`) REFERENCES `vote` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
