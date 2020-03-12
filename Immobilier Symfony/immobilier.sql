-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  jeu. 12 mars 2020 à 12:31
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `chauffage`
--

DROP TABLE IF EXISTS `chauffage`;
CREATE TABLE IF NOT EXISTS `chauffage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_chauffage` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chauffage`
--

INSERT INTO `chauffage` (`id`, `nom_chauffage`) VALUES
(1, 'Radiateur au gaz'),
(2, 'Radiateur électrique');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `email`, `bien`, `message`) VALUES
(1, 'tournon', 'kilian', 'tournon.kilian@gmail.com', 'maison', 'je veux acheter'),
(2, 'tournon', 'kilian', 'tournon.kilian@gmail.com', 'maison', 'je veux acheter'),
(3, 'tournon', 'kilian', 'tournon.kilian@gmail.com', 'maison', 'je veux acheter'),
(4, 'tournon', 'kilian', 'tournon.kilian@gmail.com', 'maison', 'je veux acheter !!');

-- --------------------------------------------------------

--
-- Structure de la table `eau_chaude`
--

DROP TABLE IF EXISTS `eau_chaude`;
CREATE TABLE IF NOT EXISTS `eau_chaude` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_eau_chaude` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `eau_chaude`
--

INSERT INTO `eau_chaude` (`id`, `nom_eau_chaude`) VALUES
(1, 'Ballon'),
(2, 'Ballon électrique');

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

DROP TABLE IF EXISTS `localisation`;
CREATE TABLE IF NOT EXISTS `localisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_localisation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `localisation`
--

INSERT INTO `localisation` (`id`, `nom_localisation`) VALUES
(1, 'Lille (59000)'),
(2, 'Loos (59120)'),
(3, 'Ronchin (59790)'),
(4, 'Tourcoing (59200)'),
(5, 'Wattignies (59139)');

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

DROP TABLE IF EXISTS `logement`;
CREATE TABLE IF NOT EXISTS `logement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_logement_id` int(11) NOT NULL,
  `localisation_id` int(11) NOT NULL,
  `chauffage_id` int(11) NOT NULL,
  `eau_chaude_id` int(11) NOT NULL,
  `nombre_piece` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `surface_totale` decimal(10,2) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `depot` decimal(10,0) NOT NULL,
  `proximite` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_logement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_vente_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F0FD445713B22EC4` (`type_logement_id`),
  KEY `IDX_F0FD4457C68BE09C` (`localisation_id`),
  KEY `IDX_F0FD4457C9BF5A6C` (`chauffage_id`),
  KEY `IDX_F0FD445781B13B0E` (`eau_chaude_id`),
  KEY `IDX_F0FD4457E88DD283` (`nom_vente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id`, `type_logement_id`, `localisation_id`, `chauffage_id`, `eau_chaude_id`, `nombre_piece`, `prix`, `surface_totale`, `description`, `depot`, `proximite`, `nom_logement`, `nom_vente_id`) VALUES
(63, 1, 3, 1, 1, 7, '350000.00', '322.15', 'Grande maison en bordure de ville', '0', 'Centre commerciaux - Ecoles - Epicerie', 'Maison1', 1),
(64, 1, 5, 2, 2, 10, '550000.00', '450.36', 'Grande maison à 3 étages', '0', 'Centre commerciaux - Vente d\'armes', 'Maison2', 1),
(65, 2, 1, 2, 2, 6, '200000.00', '145.56', 'Appartement en duplex', '450', 'Écoles - Épicerie', 'Appartement1', 2);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `logement_id` int(11) DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6A2CA10C58ABF955` (`logement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `nom_media`, `statut`, `logement_id`, `filename`, `updated_at`) VALUES
(34, 'Maison1', 1, 63, 'maison1-5e676abe18b53310220054.jpg', '2020-03-10 10:23:58'),
(35, 'Maison1.1', 1, 63, 'maison2-5e676ac63e204354593592.jpg', '2020-03-10 10:24:06'),
(36, 'Maison1.1.1', 1, 63, 'maison3-5e676acec15a3829727173.jpg', '2020-03-10 10:24:14'),
(37, 'Maison1.1.1.1', 1, 63, 'maison4-5e676ad7e7c7f132070066.jpg', '2020-03-10 10:24:23'),
(38, 'Maison2', 1, 64, 'maison2-5e676b242f543659291684.jpg', '2020-03-10 10:25:40'),
(39, 'Maison2.2', 1, 64, 'maison3-5e676b2e4d99f496725107.jpg', '2020-03-10 10:25:50'),
(40, 'Maison2.2.2', 1, 64, 'maison4-5e676b39cf762077343465.jpg', '2020-03-10 10:26:01'),
(41, 'Maison2.2.2.2', 1, 64, 'maison1-5e676b45c89fc868234083.jpg', '2020-03-10 10:26:13'),
(42, 'Appartement1', 1, 65, 'maison3-5e676b8a903ee805698397.jpg', '2020-03-10 10:27:22'),
(43, 'Appartement1.1', 1, 65, 'maison4-5e676b93e9efc293811306.jpg', '2020-03-10 10:27:31'),
(44, 'Appartement1.1.1', 1, 65, 'maison1-5e676b9c585d5511585964.jpg', '2020-03-10 10:27:40'),
(45, 'Appartement1.1.1.1', 1, 65, 'maison2-5e676ba3bbd45118721467.jpg', '2020-03-10 10:27:47');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recherche`
--

DROP TABLE IF EXISTS `recherche`;
CREATE TABLE IF NOT EXISTS `recherche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_logement_id` int(11) NOT NULL,
  `localisation_id` int(11) NOT NULL,
  `nombre_piece` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `surface_totale` decimal(10,2) NOT NULL,
  `nom_vente_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B4271B4613B22EC4` (`type_logement_id`),
  KEY `IDX_B4271B46C68BE09C` (`localisation_id`),
  KEY `IDX_B4271B46E88DD283` (`nom_vente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_logement`
--

DROP TABLE IF EXISTS `type_logement`;
CREATE TABLE IF NOT EXISTS `type_logement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type_logement` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_logement`
--

INSERT INTO `type_logement` (`id`, `nom_type_logement`) VALUES
(1, 'Maison '),
(2, 'Appartement');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(3, 'tournon.kilian@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$L0haR2Q4MnFkUk12cm1MVQ$64TYPYKA9BToctfnyuUAhMSZDAyTsNUWmo4cSb4twng'),
(4, 'tournon.kiki@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$evPBcAkZZUZT06vC2FMSke/rj6urxDkycDx9WktQVUjdzhWTx6vU2');

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_vente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`id`, `nom_vente`) VALUES
(1, 'Achat'),
(2, 'Location');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `logement`
--
ALTER TABLE `logement`
  ADD CONSTRAINT `FK_F0FD445713B22EC4` FOREIGN KEY (`type_logement_id`) REFERENCES `type_logement` (`id`),
  ADD CONSTRAINT `FK_F0FD445781B13B0E` FOREIGN KEY (`eau_chaude_id`) REFERENCES `eau_chaude` (`id`),
  ADD CONSTRAINT `FK_F0FD4457C68BE09C` FOREIGN KEY (`localisation_id`) REFERENCES `localisation` (`id`),
  ADD CONSTRAINT `FK_F0FD4457C9BF5A6C` FOREIGN KEY (`chauffage_id`) REFERENCES `chauffage` (`id`),
  ADD CONSTRAINT `FK_F0FD4457E88DD283` FOREIGN KEY (`nom_vente_id`) REFERENCES `vente` (`id`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_6A2CA10C58ABF955` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id`);

--
-- Contraintes pour la table `recherche`
--
ALTER TABLE `recherche`
  ADD CONSTRAINT `FK_B4271B4613B22EC4` FOREIGN KEY (`type_logement_id`) REFERENCES `type_logement` (`id`),
  ADD CONSTRAINT `FK_B4271B46C68BE09C` FOREIGN KEY (`localisation_id`) REFERENCES `localisation` (`id`),
  ADD CONSTRAINT `FK_B4271B46E88DD283` FOREIGN KEY (`nom_vente_id`) REFERENCES `vente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
