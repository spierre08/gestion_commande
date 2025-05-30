-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 29 Décembre 2023 à 22:17
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `g_commande`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_article`
--

CREATE TABLE `t_article` (
  `id_article` int(10) UNSIGNED NOT NULL,
  `libelle` varchar(40) DEFAULT NULL,
  `type` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_article`
--

INSERT INTO `t_article` (`id_article`, `libelle`, `type`) VALUES
(1, 'Samsung A14', 1),
(2, 'Dell xps', 2),
(5, 'Tecno Camon 15', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie`
--

CREATE TABLE `t_categorie` (
  `id_type` int(10) UNSIGNED NOT NULL,
  `categorie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_categorie`
--

INSERT INTO `t_categorie` (`id_type`, `categorie`) VALUES
(1, 'Téléphone'),
(2, 'Ordinateur'),
(4, 'Ecouteurs'),
(7, 'Ménager'),
(8, 'électro');

-- --------------------------------------------------------

--
-- Structure de la table `t_client`
--

CREATE TABLE `t_client` (
  `id_client` int(10) UNSIGNED NOT NULL,
  `nom_client` varchar(255) DEFAULT NULL,
  `prenom_client` varchar(255) DEFAULT NULL,
  `tel_client` int(10) DEFAULT NULL,
  `email_client` varchar(255) DEFAULT NULL,
  `adresse_client` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_client`
--

INSERT INTO `t_client` (`id_client`, `nom_client`, `prenom_client`, `tel_client`, `email_client`, `adresse_client`) VALUES
(1, 'Grovogui', 'Bernard', 611425789, 'bernardcentro@gmail.com', 'Hafia'),
(2, 'Goumou', 'Jean Nicolas', 628594227, 'nico@gmail.com', 'Labé'),
(5, 'Dounamou', 'Daniel', 612351901, 'dani@gmail.com', 'Dubréka '),
(6, 'Kolié', 'Joseph Nazouo', 624941607, 'jos@gmail.com', 'Kindia');

-- --------------------------------------------------------

--
-- Structure de la table `t_commande`
--

CREATE TABLE `t_commande` (
  `id_commande` int(10) UNSIGNED NOT NULL,
  `client` int(10) UNSIGNED DEFAULT NULL,
  `date_cmd` date DEFAULT NULL,
  `etat` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_commande`
--

INSERT INTO `t_commande` (`id_commande`, `client`, `date_cmd`, `etat`) VALUES
(2, 2, '2023-12-12', 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_etat`
--

CREATE TABLE `t_etat` (
  `id_etat` int(10) UNSIGNED NOT NULL,
  `nom_etat` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_etat`
--

INSERT INTO `t_etat` (`id_etat`, `nom_etat`) VALUES
(1, 'Attente'),
(2, 'Livrée'),
(3, 'Transport'),
(4, 'Annulée');

-- --------------------------------------------------------

--
-- Structure de la table `t_ligne`
--

CREATE TABLE `t_ligne` (
  `id_ligne` int(10) UNSIGNED NOT NULL,
  `id_commande` int(10) UNSIGNED DEFAULT NULL,
  `id_article` int(10) UNSIGNED DEFAULT NULL,
  `prix_unittaire` bigint(20) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_ligne`
--

INSERT INTO `t_ligne` (`id_ligne`, `id_commande`, `id_article`, `prix_unittaire`, `qte`) VALUES
(4, 2, 1, 1300000, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_role`
--

CREATE TABLE `t_role` (
  `id_role` int(10) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateur`
--

CREATE TABLE `t_utilisateur` (
  `id_utilisateur` int(10) UNSIGNED NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role_user` enum('admin','user') DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_utilisateur`
--

INSERT INTO `t_utilisateur` (`id_utilisateur`, `pseudo`, `email`, `mot_de_passe`, `role_user`, `token`) VALUES
(3, 'Simon Pierre', 'simonpierresagno766@gmail.com', '87654321', 'admin', NULL),
(5, 'Simon', 'simonpierresagno08@gmail.com', '87654321', 'user', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_article`
--
ALTER TABLE `t_article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `fk_type` (`type`);

--
-- Index pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `t_client`
--
ALTER TABLE `t_client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `t_commande`
--
ALTER TABLE `t_commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `fk_id_client` (`client`),
  ADD KEY `fk_etat` (`etat`);

--
-- Index pour la table `t_etat`
--
ALTER TABLE `t_etat`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `t_ligne`
--
ALTER TABLE `t_ligne`
  ADD PRIMARY KEY (`id_ligne`),
  ADD KEY `fk_id_commande` (`id_commande`),
  ADD KEY `fk_id_article` (`id_article`);

--
-- Index pour la table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_article`
--
ALTER TABLE `t_article`
  MODIFY `id_article` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  MODIFY `id_type` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `t_client`
--
ALTER TABLE `t_client`
  MODIFY `id_client` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_commande`
--
ALTER TABLE `t_commande`
  MODIFY `id_commande` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_etat`
--
ALTER TABLE `t_etat`
  MODIFY `id_etat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `t_ligne`
--
ALTER TABLE `t_ligne`
  MODIFY `id_ligne` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `id_role` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  MODIFY `id_utilisateur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_article`
--
ALTER TABLE `t_article`
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`type`) REFERENCES `t_categorie` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_commande`
--
ALTER TABLE `t_commande`
  ADD CONSTRAINT `fk_etat` FOREIGN KEY (`etat`) REFERENCES `t_etat` (`id_etat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_client` FOREIGN KEY (`client`) REFERENCES `t_client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_ligne`
--
ALTER TABLE `t_ligne`
  ADD CONSTRAINT `fk_id_article` FOREIGN KEY (`id_article`) REFERENCES `t_article` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_commande` FOREIGN KEY (`id_commande`) REFERENCES `t_commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
