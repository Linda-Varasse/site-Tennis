-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 28 juin 2023 à 07:08
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `aceprotennis`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` text NOT NULL,
  `email` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `objet` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `pseudo`, `email`, `objet`, `message`, `created_at`) VALUES
(1, 'toto', 'toto@toto.fr', 'erreur', 'bonjour, je n&#039;ai pas reçu ma commande', '2023-06-16'),
(2, '', 'linda.varasse@outlook.fr', '123', 'bonjour', '2023-06-16');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image_url` varchar(100) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `quantité` int NOT NULL,
  `categorie` varchar(25) NOT NULL,
  `catégorie_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `image_url`, `nom`, `description`, `prix`, `quantité`, `categorie`, `catégorie_id`) VALUES
(1, '../img/raquette-orange.jpg', 'Raquette orange', 'Raquette orange édition limitée', '60.99', 10, 'raquette', 1),
(2, '../img/tshirt-homme-product.jpg', 'T-shirt Homme', 'T-shirt bleu pour Hommes', '25.99', 5, 'vetement', 2),
(3, '../img/chaussures-orange-product.jpg', 'Sneakers', 'Sneakers oranges pour Hommes', '39.99', 8, 'chaussures-hommes', 3),
(4, '../img/raquette-bleu-product.jpg', 'Raquette bleue', 'Raquette bleue enfant', '45.50', 3, 'raquette', 1),
(5, '../img/chaussures-blanche-product.jpg', 'Sneakers', 'Sneakers blanches pour Femmes', '35.50', 12, 'chaussures-femmes', 4),
(6, '../img/chaussures-grise-product.jpg', 'Sneakers', 'Sneakers grises pour Femmes', '55.99', 20, 'chaussures-femmes', 4),
(7, '../img/tshirt-bleu-femme-3-product.jpg', 'T-shirt Femme', 'T-shirt bleu pour Femmes', '25.99', 4, 'vetement', 2),
(8, '../img/tshirt-orange-homme-2-product.jpg', 'T-shirt Homme', 'T-shirt bleu pour Hommes', '25.99', 9, 'vetement', 2),
(9, '../img/raquette_rouge.jpg', 'Raquette rouge', 'Raquette rouge', '55.50', 19, 'raquette', 1),
(10, '../img/tshirt_blanc_femme_produit.jpg', 'T-shirt Femme', 'T-shirt blanc pour femmes', '20.99', 3, 'vetement', 2),
(11, '../img/tshirt_blanc_homme_produit.jpg', 'T-shirt Homme', 'T-shirt blanc pour Hommes', '25.99', 0, 'vetement', 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` int NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL,
  `email` varchar(160) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `email`, `password`, `created_at`, `role_id`) VALUES
(1, 'toto', 'toto@toto.fr', '$2y$10$IaQFPLjkPJGXV3nXYS.xWeF1y0K5FocWhju49e9D/R7FxBb6hYS0e', '2023-06-16', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
