-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2016 at 03:23 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bio`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `download_counter` bigint(20) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `files_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_06_04_144335_entrust_setup_tables', 1),
('2015_06_19_215836_create_files_table', 1),
('2015_06_24_191442_create_responses_table', 1),
('2015_06_24_191517_create_returns_table', 1),
('2015_06_24_191548_create_reports_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
('0b0d4450-b6b9-4e87-8681-74037b883243', 'edit-profile', 'Edit Profile', 'Can modify own profile', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('15fcbf71-8b72-4396-aa47-80e672c0cacd', 'view-return-files', 'View Return File List', 'Can only upload return file', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('2942035c-a132-414f-a921-cd4a7d019a36', 'upload-response-files', 'Upload Response File', 'Can only upload response file', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('3990d1f9-63d0-4e0e-9fc6-cb85fa67c716', 'delete-download-batch-files', 'Download and Delete batch files', 'Can download and delete batch files.', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('3c2f240a-cf03-49de-aa9e-adbfe20e5b2f', 'delete-response-files', 'Delete Response File', 'Can delete response file', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('56766bdc-fb79-472b-8425-7a7172a3c893', 'view-users', 'View Users', 'See profile of other users registered on the site.', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('5a90654c-fd3c-4894-9ab4-cac089468cf5', 'upload-batch-files', 'Upload Batch', 'Can upload batch', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('60d1b654-519a-41b4-a7d8-d4a8d91bb481', 'delete-return-files', 'delete Return File', 'Can delete return file', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('6a28838b-9d55-41a1-bf5d-610159cfc4f5', 'create-payout-report', 'Create Payout Report', 'Can create payout report', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('6cfbc76c-ef87-4ede-b1b7-ee06cbc6a116', 'edit-users', 'Edit Users', 'Can add, edit and delete other users. Can assign roles.', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('6e619e5d-6e7c-4fb8-bb21-0c3203261cc7', 'download-payout-report', 'Download Payout Report', 'Can download payout report', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('72e6536b-65b3-4fa8-9e97-59fb40890c1c', 'download-return-files', 'Download Return File', 'Can download return file', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('84852e82-3399-4033-b523-f81b49f7714e', 'view-response-files', 'View Response File List', 'Can only upload response file', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('a8bd48fc-5fa9-4b18-b16e-703b9e542724', 'view-payout-report', 'View Payout Report List', 'Can see the Payout Report', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('c6049f77-aa36-4e4e-bb58-1a7054c29c74', 'download-response-files', 'Download Response File', 'Can download response file', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('d56b1145-0026-4be1-bc73-1440c856a529', 'upload-return-files', 'Upload Return File', 'Can only upload return file', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('ec1a17f2-b7b8-40cd-9cc2-a8918308efe8', 'view-batch-files', 'View Batch File List', 'Can view batch files index.', '2016-02-17 00:54:13', '2016-02-17 00:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
('0b0d4450-b6b9-4e87-8681-74037b883243', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('15fcbf71-8b72-4396-aa47-80e672c0cacd', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('3990d1f9-63d0-4e0e-9fc6-cb85fa67c716', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('5a90654c-fd3c-4894-9ab4-cac089468cf5', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('6e619e5d-6e7c-4fb8-bb21-0c3203261cc7', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('72e6536b-65b3-4fa8-9e97-59fb40890c1c', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('84852e82-3399-4033-b523-f81b49f7714e', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('a8bd48fc-5fa9-4b18-b16e-703b9e542724', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('c6049f77-aa36-4e4e-bb58-1a7054c29c74', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('ec1a17f2-b7b8-40cd-9cc2-a8918308efe8', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('0b0d4450-b6b9-4e87-8681-74037b883243', '8ea50fd8-766c-4a2f-98fd-b94891af84a9'),
('15fcbf71-8b72-4396-aa47-80e672c0cacd', '8ea50fd8-766c-4a2f-98fd-b94891af84a9'),
('3990d1f9-63d0-4e0e-9fc6-cb85fa67c716', '8ea50fd8-766c-4a2f-98fd-b94891af84a9'),
('5a90654c-fd3c-4894-9ab4-cac089468cf5', '8ea50fd8-766c-4a2f-98fd-b94891af84a9'),
('6e619e5d-6e7c-4fb8-bb21-0c3203261cc7', '8ea50fd8-766c-4a2f-98fd-b94891af84a9'),
('72e6536b-65b3-4fa8-9e97-59fb40890c1c', '8ea50fd8-766c-4a2f-98fd-b94891af84a9'),
('a8bd48fc-5fa9-4b18-b16e-703b9e542724', '8ea50fd8-766c-4a2f-98fd-b94891af84a9'),
('ec1a17f2-b7b8-40cd-9cc2-a8918308efe8', '8ea50fd8-766c-4a2f-98fd-b94891af84a9'),
('0b0d4450-b6b9-4e87-8681-74037b883243', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('15fcbf71-8b72-4396-aa47-80e672c0cacd', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('2942035c-a132-414f-a921-cd4a7d019a36', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('3990d1f9-63d0-4e0e-9fc6-cb85fa67c716', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('3c2f240a-cf03-49de-aa9e-adbfe20e5b2f', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('56766bdc-fb79-472b-8425-7a7172a3c893', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('5a90654c-fd3c-4894-9ab4-cac089468cf5', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('60d1b654-519a-41b4-a7d8-d4a8d91bb481', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('6a28838b-9d55-41a1-bf5d-610159cfc4f5', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('6cfbc76c-ef87-4ede-b1b7-ee06cbc6a116', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('6e619e5d-6e7c-4fb8-bb21-0c3203261cc7', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('72e6536b-65b3-4fa8-9e97-59fb40890c1c', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('84852e82-3399-4033-b523-f81b49f7714e', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('a8bd48fc-5fa9-4b18-b16e-703b9e542724', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('c6049f77-aa36-4e4e-bb58-1a7054c29c74', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('d56b1145-0026-4be1-bc73-1440c856a529', 'ccac473a-1d7d-454d-acff-d85ba03b363c'),
('ec1a17f2-b7b8-40cd-9cc2-a8918308efe8', 'ccac473a-1d7d-454d-acff-d85ba03b363c');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `download_counter` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `reports_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `download_counter` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `responses_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE IF NOT EXISTS `returns` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `download_counter` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `returns_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
('01589f7a-1947-4b67-930b-cfc7e823703c', 'merchant', 'Merchant', 'Merchant able to upload and modify files.', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('8ea50fd8-766c-4a2f-98fd-b94891af84a9', 'guest', 'Guest', 'Guest able to upload and modify files.', '2016-02-17 00:54:13', '2016-02-17 00:54:13'),
('ccac473a-1d7d-454d-acff-d85ba03b363c', 'admin', 'Administrator', 'User with full access to site functionality.', '2016-02-17 00:54:13', '2016-02-17 00:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
('4b90972d-193f-4b95-83b8-d2c61cc044ba', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('7e734024-b7b4-4c57-84f0-0c4e63e34e5f', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('b928a314-4614-41e6-b6f3-b7f8c337fe1c', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('e9b50bcc-c7a1-488f-ad93-64c637a20b04', '01589f7a-1947-4b67-930b-cfc7e823703c'),
('710ec648-c8c9-45fe-95ea-ba34fd1580f0', '8ea50fd8-766c-4a2f-98fd-b94891af84a9'),
('ad967060-884b-4892-b5e4-13a684fba026', 'ccac473a-1d7d-454d-acff-d85ba03b363c');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
('4b90972d-193f-4b95-83b8-d2c61cc044ba', 'medisure', 'medisure@pyramidpayments.com', NULL, '$2y$10$BzHnG2QbtLoqAM.EO2Ker.p2xCHR982OY.bbWpcffsStC5Bb1Xxca', NULL, '2016-02-17 00:54:14', '2016-02-17 00:54:14', NULL),
('710ec648-c8c9-45fe-95ea-ba34fd1580f0', 'John', 'john@pyramidpayments.com', NULL, '$2y$10$EHUNsyb2fzFe2mYLOcVTu.MNz7luOnXB2viECpH5Iij/imJ5TFVBm', NULL, '2016-02-17 00:54:15', '2016-02-17 00:54:15', NULL),
('7e734024-b7b4-4c57-84f0-0c4e63e34e5f', 'Yplo', 'yplo@pyramidpayments.com', NULL, '$2y$10$CrabsuHxMYu4asK6B9vrju3H4QMkQEp2XNtla8ua8Z5l42IIH5JAG', NULL, '2016-02-17 00:54:14', '2016-02-17 00:54:14', NULL),
('ad967060-884b-4892-b5e4-13a684fba026', 'Imran hossian', 'imran@pyramidpayments.com', NULL, '$2y$10$mvXdqxR/9ugHg2lk2D/pMOkrYuLH9MJ0EC.uO5cOaX0Wd.AUj4AQO', NULL, '2016-02-17 00:54:14', '2016-02-17 00:54:14', NULL),
('b928a314-4614-41e6-b6f3-b7f8c337fe1c', 'myhealth', 'myhealth@pyramidpayments.com', NULL, '$2y$10$HjUR9ll1Ux2NDz3P/KJ66uOp5suUxxBADe/OZd3xaeLO14G6iBOcK', NULL, '2016-02-17 00:54:14', '2016-02-17 00:54:14', NULL),
('e9b50bcc-c7a1-488f-ad93-64c637a20b04', 'Ypbo', 'ypbo@pyramidpayments.com', NULL, '$2y$10$And65NaQbFvGtVaY7jq17.wziCJDS2wOXghfT1pIQb86uz1cOj0i.', NULL, '2016-02-17 00:54:14', '2016-02-17 00:54:14', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
