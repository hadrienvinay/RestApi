-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 27 août 2019 à 14:11
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bank`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bic_fi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_use` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cash_account_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `psu_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iban` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `accounts`
--

INSERT INTO `accounts` (`id`, `resource_id`, `bic_fi`, `name`, `account_use`, `cash_account_type`, `currency`, `psu_status`, `iban`) VALUES
(1, 'Alias1', 'BNKAFRPPXXZ', 'Compte de Mr et Mme Dupont', 'PRIV', 'CACC', 'EUR', 'Co-account Holder', 'XX13RDHN98392489481620896668799742'),
(2, 'Alias2', 'BNKAFRPPXXZ', 'Compte de Mr Dupont', 'PRIV', 'CACC', 'EUR', 'Account Holder', 'YY13RDHN98392489481620896668799742'),
(3, 'Alias3', 'BNKAFRPPXXY', 'Compte de Mme Dupont', 'PRIV', 'CACC', 'EUR', 'Account Holder', 'ZZ13RDHN98392489481620896668799742');

-- --------------------------------------------------------

--
-- Structure de la table `balance`
--

DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` float NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastTransaction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `lastChangeDateTime` date DEFAULT NULL,
  `referenceDate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ACF41FFE9B6B5FBA` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `balance`
--

INSERT INTO `balance` (`id`, `amount`, `currency`, `type`, `lastTransaction`, `account_id`, `lastChangeDateTime`, `referenceDate`) VALUES
(1, 156.56, 'EUR', 'CLBD', 'A452CH', 2, '2019-03-21', '2019-03-22'),
(2, 12.25, 'EUR', 'CLBD', 'A452CH', 2, '2019-03-19', '2019-03-22'),
(3, 105.3, 'EUR', 'XPCD', 'A452CH', 1, '2019-03-18', '2019-03-21');

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requestDate` datetime NOT NULL,
  `transactionAmount` double NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `originatorIban` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `beneficiaryIban` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `payment`
--

INSERT INTO `payment` (`id`, `requestDate`, `transactionAmount`, `description`, `originatorIban`, `beneficiaryIban`) VALUES
(1, '2019-05-16 10:00:00', 0, 'Paiement 0', 'FR78 5695 5996 8457 4521 6598 562', 'FR78 1123 9743 4465 9989 4512 111'),
(19, '2019-05-16 14:09:22', 0, 'Paiement 1', 'FR78 5695 5996 8457 4521 6598 492', 'FR76 4623 9856 5623 4856 6598 562'),
(20, '2019-06-06 12:28:00', 111111111, NULL, 'FR7625498569741253625149898', '111111111111111111111111111'),
(21, '2019-06-06 12:29:25', 999, NULL, 'FR7625498569741253625149898', '999999999999999999999999999'),
(22, '2019-06-06 12:30:17', 999, NULL, 'FR7625498569741253625149898', '999999999999999999999999999'),
(23, '2019-06-06 12:37:56', 111111111, NULL, 'FR7625498569741253625149898', '111111111111111111111111111'),
(24, '2019-06-06 12:39:38', 66, NULL, 'FR7625498569741253625149898', '666666666666666666666666666'),
(25, '2019-06-07 08:22:05', 2, NULL, 'FR7625498569741253625149898', 'FR5522222222222222222222222'),
(26, '2019-06-07 08:22:28', 2, NULL, 'FR7625498569741253625149898', 'FR5522222222222222222222222'),
(27, '2019-06-07 08:23:29', 2, NULL, 'FR7625498569741253625149898', 'FR7622222222222222222222222'),
(28, '2019-06-07 08:25:13', 3333333333, NULL, 'FR7625498569741253625149898', '333333333333333333333333333'),
(29, '2019-06-07 08:26:29', 45, NULL, 'FR7625498569741253625149898', '222222222222222222222222222'),
(30, '2019-06-07 08:31:42', 4556656565656, NULL, 'FR7625498569741253625149898', '222222222222222222222222222'),
(31, '2019-06-07 08:32:04', 45521522, NULL, 'FR7625498569741253625149898', '222222222222222222222222222'),
(32, '2019-06-07 08:35:31', 45521522, NULL, 'FR7625498569741253625149898', '222222222222222222222222222'),
(33, '2019-06-07 08:35:41', 45521522222, NULL, 'FR7625498569741253625149898', '222222222222222222222222222'),
(34, '2019-06-07 08:42:23', 123456789, NULL, 'FR7625498569741253625149898', '222222222222222222222222222'),
(35, '2019-06-07 08:42:44', 1234567890, NULL, 'FR7625498569741253625149898', '333333333333333333333333333'),
(36, '2019-06-07 08:46:06', 1234567890, NULL, 'FR7625498569741253625149898', '333333333333333333333333333'),
(37, '2019-06-07 08:46:15', 1.2345678905555556e16, NULL, 'FR7625498569741253625149898', '333333333333333333333333333'),
(38, '2019-06-07 09:07:46', 560, NULL, 'FR7625498569741253625149898', 'FR7656985632541286744657112'),
(39, '2019-06-07 09:28:38', 33333, NULL, 'FR7625498569741253625149898', '333333333333333333333333333'),
(40, '2019-06-07 09:29:08', 33333, NULL, 'FR7625498569741253625149898', '333333333333333333333333333'),
(41, '2019-06-07 09:31:32', 33333, NULL, 'FR7625498569741253625149898', '333333333333333333333333333'),
(42, '2019-06-07 09:32:12', 33333, NULL, 'FR7625498569741253625149898', '333333333333333333333333333');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `entryReference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creditDebitIndicator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bookingDate` date NOT NULL,
  `remittanceInformation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valueDate` date DEFAULT NULL,
  `transactionDate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_723705D19B6B5FBA` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id`, `account_id`, `entryReference`, `amount`, `currency`, `creditDebitIndicator`, `status`, `bookingDate`, `remittanceInformation`, `valueDate`, `transactionDate`) VALUES
(1, 2, 'AF5T2', 1225, 'EUR', 'DBIT', 'BOOK', '2019-03-21', 'Chèque n°XXXXXXX', '2019-03-12', '2019-03-13'),
(2, 2, 'AF5T3', 6638, 'EUR', 'DBIT', 'BOOK', '2019-03-22', 'Prélèvement ICS XXXXXXX', '2019-03-20', '2019-03-20'),
(3, 1, 'AF5T4', 6000, 'EUR', 'DBIT', 'BOOK', '2019-03-19', 'Retrait Carte', '2019-03-19', '2019-03-21');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `FK_ACF41FFE9B6B5FBA` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_723705D19B6B5FBA` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
