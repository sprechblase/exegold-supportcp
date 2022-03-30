-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Erstellungszeit: 11. Mrz 2022 um 13:31
-- Server-Version: 5.7.36
-- PHP-Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `support`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `docs`
--

DROP TABLE IF EXISTS `docs`;
CREATE TABLE IF NOT EXISTS `docs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iframelink` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `docs`
--

INSERT INTO `docs` (`id`, `description`, `iframelink`, `access`, `created_at`, `updated_at`) VALUES
(1, 'Leitfaden Banzeiten', '<iframe style=\"display:block;width:100%; height: 100vh;\" src=\"\"></iframe>', 'SB', '2018-05-17 15:56:22', '2022-03-05 17:28:36'),
(2, 'Leitfaden Whitelist', '<iframe style=\"display:block;width:100%; height: 100vh;\" src=\"\"></iframe>', 'SB', '2018-05-17 16:48:24', '2022-03-05 17:28:09');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataold` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datanew` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=323 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2018_05_09_230416_create_permission_tables', 1),
(11, '2018_05_10_091353_create_positions_table', 1),
(13, '2018_05_10_160212_create_supportcases_table', 2),
(15, '2018_05_12_112451_create_logs_table', 3),
(16, '2018_05_17_124913_create_docs_table', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(5) UNSIGNED NOT NULL,
  `model_id` int(5) UNSIGNED NOT NULL,
  `model_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_id`, `model_type`) VALUES
(1, 1, 'App\\User'),
(2, 1, 'App\\User'),
(3, 1, 'App\\User'),
(4, 1, 'App\\User'),
(5, 1, 'App\\User'),
(6, 1, 'App\\User'),
(7, 1, 'App\\User'),
(8, 1, 'App\\User'),
(9, 1, 'App\\User'),
(10, 1, 'App\\User'),
(11, 1, 'App\\User'),
(12, 1, 'App\\User'),
(13, 1, 'App\\User'),
(14, 1, 'App\\User'),
(15, 1, 'App\\User'),
(16, 1, 'App\\User'),
(17, 1, 'App\\User'),
(18, 1, 'App\\User'),
(19, 1, 'App\\User'),
(20, 1, 'App\\User'),
(21, 1, 'App\\User');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(5) UNSIGNED NOT NULL,
  `model_id` int(5) UNSIGNED NOT NULL,
  `model_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabellenstruktur für Tabelle `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Supportfall lesen', 'web', '2018-05-12 09:20:32', '2018-05-12 09:20:32'),
(2, 'Supportfall bearbeiten', 'web', '2018-05-12 09:20:32', '2018-05-12 09:20:32'),
(3, 'Supportfall löschen', 'web', '2018-05-12 09:20:32', '2018-05-12 09:20:32'),
(4, 'Supportfall erstellen', 'web', '2018-05-12 09:20:32', '2018-05-12 09:20:32'),
(5, 'Log lesen', 'web', '2018-05-12 10:03:09', '2018-05-12 10:03:09'),
(6, 'Benutzerverwaltung lesen', 'web', '2018-05-12 10:20:43', '2018-05-12 10:20:43'),
(7, 'Benutzerverwaltung bearbeiten', 'web', '2018-05-12 10:20:43', '2018-05-12 10:20:43'),
(8, 'Benutzerverwaltung löschen', 'web', '2018-05-12 10:20:43', '2018-05-12 10:20:43'),
(9, 'Benutzerverwaltung erstellen', 'web', '2018-05-12 10:20:43', '2018-05-12 10:20:43'),
(10, 'Position lesen', 'web', '2018-05-12 12:24:12', '2018-05-12 12:24:12'),
(11, 'Position bearbeiten', 'web', '2018-05-12 12:24:12', '2018-05-12 12:24:12'),
(12, 'Position löschen', 'web', '2018-05-12 12:24:12', '2018-05-12 12:24:12'),
(13, 'Position erstellen', 'web', '2018-05-12 12:24:12', '2018-05-12 12:24:12'),
(14, 'Banprotokoll lesen', 'web', '2018-05-14 21:07:00', '2018-05-14 21:07:00'),
(15, 'Banprotokoll bearbeiten', 'web', '2018-05-14 21:07:00', '2018-05-14 21:07:00'),
(16, 'Banprotokoll löschen', 'web', '2018-05-14 21:07:00', '2018-05-14 21:07:00'),
(17, 'Banprotokoll erstellen', 'web', '2018-05-14 21:07:00', '2018-05-14 21:07:00'),
(18, 'Docs lesen', 'web', '2018-05-17 12:09:29', '2018-05-17 12:09:29'),
(19, 'Docs bearbeiten', 'web', '2018-05-17 12:09:29', '2018-05-17 12:09:29'),
(20, 'Docs löschen', 'web', '2018-05-17 12:09:29', '2018-05-17 12:09:29'),
(21, 'Docs erstellen', 'web', '2018-05-17 12:09:29', '2018-05-17 12:09:29');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `positions`
--

INSERT INTO `positions` (`id`, `position`, `position_description`, `priority`, `created_at`, `updated_at`) VALUES
(1, 'SB', 'SB', 99999, '2022-03-05 16:23:06', '2022-03-05 16:23:06');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `supportcases`
--

DROP TABLE IF EXISTS `supportcases`;
CREATE TABLE IF NOT EXISTS `supportcases` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sonstiges',
  `casetype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Support',
  `supporter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spieler` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `geschehen` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Beweise` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Entscheidung` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `done` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonnummer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `position_id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_status` enum('LOCKED','FREE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FREE',
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `telefonnummer`, `position_id`, `email`, `account_status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sprechblase', '', '1', 'sprechblase@sprechblase.de', 'FREE', '$2y$10$OK4Mn1zmHroVppb1LhIIre1wWXNGljj6eLpip0Kpavc3mrd6VJvyi', '', '2018-05-12 15:31:48', '2022-03-07 18:56:36');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `banprotokolle`
--

DROP TABLE IF EXISTS `banprotokolls`;
CREATE TABLE IF NOT EXISTS `banprotokolls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supporter` varchar(255) NOT NULL,
  `spieler` varchar(100) NOT NULL,
  `forumname` varchar(100) NOT NULL,
  `von` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bis` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `supportfallid` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
