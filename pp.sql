-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:8890
-- Generation Time: Jun 21, 2015 at 07:32 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pp`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
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
('2015_06_19_215836_create_files_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
('03cbb1be-6b28-460c-87c2-d2e08378c71d', 'view-users', 'View Users', 'See profile of other users registered on the site.', '2015-06-22 03:30:06', '2015-06-22 03:30:06'),
('2f82765e-b487-4753-9f66-dc30ff6853c2', 'edit-ingredients', 'Download and Delete files', 'Can download and delete.', '2015-06-22 03:30:06', '2015-06-22 03:30:06'),
('7a75c5df-c619-4ea9-af2f-937332018587', 'edit-users', 'Edit Users', 'Can add, edit and delete other users. Can assign roles.', '2015-06-22 03:30:06', '2015-06-22 03:30:06'),
('88d734e6-e207-4511-94db-3ee4b3b6b1a8', 'view-ingredients', 'View File List', 'Can view files index.', '2015-06-22 03:30:06', '2015-06-22 03:30:06'),
('fa662d4f-cb7b-4f13-8a30-1dddc8340a41', 'edit-profile', 'Edit Profile', 'Can modify own profile', '2015-06-22 03:30:06', '2015-06-22 03:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` char(36) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
('03cbb1be-6b28-460c-87c2-d2e08378c71d', '1e789c8a-045c-4ad5-a4be-c96bc03613de'),
('2f82765e-b487-4753-9f66-dc30ff6853c2', '1e789c8a-045c-4ad5-a4be-c96bc03613de'),
('88d734e6-e207-4511-94db-3ee4b3b6b1a8', '1e789c8a-045c-4ad5-a4be-c96bc03613de'),
('fa662d4f-cb7b-4f13-8a30-1dddc8340a41', '1e789c8a-045c-4ad5-a4be-c96bc03613de'),
('03cbb1be-6b28-460c-87c2-d2e08378c71d', '8e17e27c-3d9c-40d8-843d-42397f514499'),
('2f82765e-b487-4753-9f66-dc30ff6853c2', '8e17e27c-3d9c-40d8-843d-42397f514499'),
('7a75c5df-c619-4ea9-af2f-937332018587', '8e17e27c-3d9c-40d8-843d-42397f514499'),
('88d734e6-e207-4511-94db-3ee4b3b6b1a8', '8e17e27c-3d9c-40d8-843d-42397f514499'),
('fa662d4f-cb7b-4f13-8a30-1dddc8340a41', '8e17e27c-3d9c-40d8-843d-42397f514499'),
('88d734e6-e207-4511-94db-3ee4b3b6b1a8', 'fb3de294-2f24-4081-8fa4-44b3fd2f5725'),
('fa662d4f-cb7b-4f13-8a30-1dddc8340a41', 'fb3de294-2f24-4081-8fa4-44b3fd2f5725');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
('1e789c8a-045c-4ad5-a4be-c96bc03613de', 'merchant', 'Merchant', 'Merchant able to upload and modify files.', '2015-06-22 03:30:06', '2015-06-22 03:30:06'),
('8e17e27c-3d9c-40d8-843d-42397f514499', 'admin', 'Administrator', 'User with full access to site functionality.', '2015-06-22 03:30:06', '2015-06-22 03:30:06'),
('fb3de294-2f24-4081-8fa4-44b3fd2f5725', 'guest', 'Guest', 'Guest able to upload and modify files.', '2015-06-22 03:30:06', '2015-06-22 03:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` char(36) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
('2f956f83-579d-4f95-a27f-33783c45f441', '1e789c8a-045c-4ad5-a4be-c96bc03613de'),
('4a3174be-f20f-4899-ab1d-3edf8476cf2e', '1e789c8a-045c-4ad5-a4be-c96bc03613de'),
('5b045582-ac84-49bd-a939-cb805b3decca', '1e789c8a-045c-4ad5-a4be-c96bc03613de'),
('d6e5c0f8-7ad5-44a5-8682-db999cf4715a', '1e789c8a-045c-4ad5-a4be-c96bc03613de'),
('e54f926a-c6bc-4ba8-bb70-a0ca561883ed', '8e17e27c-3d9c-40d8-843d-42397f514499'),
('ee46756e-a952-47ed-8c24-b87de5d320a1', 'fb3de294-2f24-4081-8fa4-44b3fd2f5725');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
('2f956f83-579d-4f95-a27f-33783c45f441', 'myhealth', 'myhealth@pyramidpayments.com', NULL, '$2y$10$hOkYJdox8AxDxjw7/KO3B.Wg4YSNE7PtuQ0EQb18CXKFfAhPx1nmO', NULL, '2015-06-22 03:30:07', '2015-06-22 03:30:07', NULL),
('4a3174be-f20f-4899-ab1d-3edf8476cf2e', 'Yplo', 'yplo@pyramidpayments.com', NULL, '$2y$10$f/7VZpesJ4VJ/tPHqXCTIOdEtf43t5MfG7I2Rvu4QdZK4OvStJC8S', NULL, '2015-06-22 03:30:07', '2015-06-22 03:30:07', NULL),
('5b045582-ac84-49bd-a939-cb805b3decca', 'medisure', 'medisure@pyramidpayments.com', NULL, '$2y$10$wKV35bx0gsFeVpWa5OMBCuk6U2HJeoujJtA36vUCWQtbv0/a6yzgi', NULL, '2015-06-22 03:30:07', '2015-06-22 03:30:07', NULL),
('d6e5c0f8-7ad5-44a5-8682-db999cf4715a', 'Ypbo', 'ypbo@pyramidpayments.com', NULL, '$2y$10$UFBLF2mbD2GQUgj7ck1bgOK3cc9cL3joJq5oyRfcvusaNj5wQM9Wq', NULL, '2015-06-22 03:30:06', '2015-06-22 03:30:06', NULL),
('e54f926a-c6bc-4ba8-bb70-a0ca561883ed', 'Imran hossian', 'imran@pyramidpayments.com', NULL, '$2y$10$X7JsBDjhz6dWVqoJPNKYk.D/aRAHTNalQ8oHn1uw9l0RxYoK3B1lW', NULL, '2015-06-22 03:30:06', '2015-06-22 03:30:06', NULL),
('ee46756e-a952-47ed-8c24-b87de5d320a1', 'John', 'john@pyramidpayments.com', NULL, '$2y$10$gxitu6SHFE9sW/rsI8VmA.GyJBlaFTibjQUHsEDbzrYnnoztIA.sG', NULL, '2015-06-22 03:30:07', '2015-06-22 03:30:07', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
