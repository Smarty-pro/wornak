-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Dim 27 déc. 2020 à 22:51
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP : 7.3.12

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Wornak`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin`
(
    `id`        int(11) NOT NULL,
    `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `mail`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `tel`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password`  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `address`   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id`   int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company`
(
    `id`               int(11) NOT NULL,
    `roles`            longtext COLLATE utf8mb4_unicode_ci     NOT NULL COMMENT '(DC2Type:json)',
    `employees_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `company_name`     varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description`      longtext COLLATE utf8mb4_unicode_ci     NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`id`, `roles`, `employees_number`, `company_name`, `description`)
VALUES (3, '[]', '0-100', 'test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions`
(
    `version`        varchar(191) COLLATE utf8_unicode_ci NOT NULL,
    `executed_at`    datetime DEFAULT NULL,
    `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`)
VALUES ('App\\Migrations\\Version20201220152725', '2020-12-20 16:32:45', 7132),
       ('App\\Migrations\\Version20201226103637', '2020-12-26 11:37:13', 833),
       ('App\\Migrations\\Version20201226110807', '2020-12-26 12:08:24', 571),
       ('App\\Migrations\\Version20201226111005', '2020-12-26 12:10:23', 2258),
       ('App\\Migrations\\Version20201227211936', '2020-12-27 22:19:55', 2471),
       ('App\\Migrations\\Version20201227214525', '2020-12-27 22:45:29', 757),
       ('App\\Migrations\\Version20201227214734', '2020-12-27 22:47:38', 1883);

-- --------------------------------------------------------

--
-- Structure de la table `job_post`
--

CREATE TABLE `job_post`
(
    `id`                   int(11) NOT NULL,
    `company`              varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `job_title`            varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description`          longtext COLLATE utf8mb4_unicode_ci     NOT NULL,
    `reference`            varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `exp_date`             date                                    NOT NULL,
    `job_zone`             varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `training`             varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `contract_type`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `published_at`         datetime                                NOT NULL,
    `salary`               int(11) NOT NULL,
    `sector`               varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `study_level_required` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `job_post`
--

INSERT INTO `job_post` (`id`, `company`, `job_title`, `description`, `reference`, `exp_date`, `job_zone`, `training`,
                        `contract_type`, `published_at`, `salary`, `sector`, `study_level_required`)
VALUES (1, 'test', 'test', 'test', 'test', '2020-09-10', 'test', 'test', 'test', '2020-09-10 15:33:32', 0, '', ''),
       (2, 'Anapec', 'Conseiller en emploi', 'pas de description', '07A07D61CS6', '2020-09-10', 'Casablanca', 'pas d\'exp requise', 'CDI', '2020-09-10 15:33:32', 0, '', ''),
(3, 'Federal Bureau of Investigation', 'Special Agent', 'no description', 'Z048054V7', '2020-09-11', 'New York', 'no training needed', 'CDI', '2020-09-11 15:47:28', 0, '', ''),
(4, 'Amazon', 'Secretary', 'secretary of Amazon', '0F47D0V8', '2020-09-17', 'Silicon Valley, California', 'no training needed', 'CDI', '2020-09-11 15:50:43', 0, '', ''),
(5, 'Activision', 'Senior Developper', 'senior developer of the studio Treyarch', '07F5ZD64', '2020-09-11', 'Los Angeles,
        California', '3 years of developement in any studio', 'CDI', '2020-09-11 15:52:55', 0, '', ''),
(6, 'Maroc Telecom', 'Telephone Operator', 'telephone operator of Maroc Telecom', '05F98ZA\r\n', '2020-09-11', 'Marrakech', 'no training needed', 'CDI', '2020-09-11 15:54:49', 0, '', ''),
(7, 'DECATHLON', 'Cashier', 'Cashier of Decathlon-Nantes', '08REC64D', '2020-09-01', 'Nantes, France', 'no training needed', 'CDD', '2020-09-11 15:56:33', 0, '', ''),
(8, 'Athwab Hanane', 'Assistant', 'no description', '0DF68ZF\r\n', '2020-09-11', 'BenGuerir, Morocco', 'no training needed', 'CDD', '2020-09-11 16:03:15', 0, '', ''),
(9, 'OCP', 'Engineer', 'engineer in the biggest company in Morocco', '0F84FZ49F9', '2020-09-11', 'BenGuerir, Morocco', '5 years of experience', 'CDI', '2020-09-11 16:04:58', 0, '', ''),
(10, 'Renault', 'Presenter of cars', 'no description', 'FEF886B', '2020-09-30', 'Casablanca, Morocco', 'no training needed', 'CDD', '2020-09-11 16:30:00', 0, '', ''),
(11, 'Alphabet Inc.', 'Secretary', 'no description', 'F44VE8R', '2020-09-29', 'Silicon Valley, California ', 'no training needed', 'CDI', '2020-09-11 16:33:04', 0, '', ''),
(12, 'Alstom', 'Engineer', 'engineer in Alstom-Paris', '7F5ZD84V', '2020-10-07', 'Paris, France', 'no training needed', 'CDD', '2020-09-12 21:43:21', 0, '', ''),
(13, 'Alsa', 'Bus Driver', 'Bus driver in Casablanca', '4D9VE3B8T', '2020-09-22', 'Casablanca, Morocco', 'no training needed', 'CDI', '2020-09-02 21:44:49', 0, '', ''),
(14, 'Africom', 'Computer Scientist', 'no description', 'F6FC48A', '2020-09-29', ' Stuttgart, Germany', '10 years of exp', 'CDI', '2020-09-11 21:56:42', 0, '', ''),
(15, 'Marjane Holding', 'Cashier', 'cashier in Marjane', 'Z2D457DC', '2020-09-29', 'Tangier, Morocco', 'no training needed', 'CDD', '2020-09-13 11:26:47', 6000, '', ''),
(16, 'test', 'Engineer', 'no description', '418e441898d7045dde986836c62c33a3', '2021-01-01', 'Morocco', 'no', 'CDI', '2020-12-18 23:40:20', 20000, '18', 'Bac+4'),
(17, 'test', 'Engineer', 'no description', 'd4830e65651bc2365f0e0b6d8508e94b', '2021-01-01', 'Morocco', 'no', 'CDI', '2020-12-26 11:53:18', 20000, '10', 'Bac+3'),
(18, 'test', 'Engineer', 'no description', '000d0d1f0abb40909c7d89380e7a1dc0', '2021-01-01', 'Morocco', 'no', 'CDI', '2020-12-26 12:12:40', 20000, '01', 'Bac+2'),
(19, 'test', 'Engineer', 'no description', '88d6a658013827806ed6773627d1c110', '2021-01-01', 'Morocco', 'no', 'CDI', '2020-12-26 12:16:26', 20000, '01', 'Bac'),
(20, 'test', 'Engineer', 'no description', 'd12e79f614c8e66a3b973693f9d0a2c9', '2021-01-01', 'Morocco', 'no', 'CDI', '2020-12-26 16:43:21', 20000, '01', 'Bac'),
(21, 'test', 'Engineer', 'no description', 'eb8de89f1e382b1a66d046cb15ff3e30', '2021-01-01', 'Morocco', 'no', 'CDI', '2020-12-26 16:47:54', 20000, '01', 'Bac'),
(22, 'test', 'Engineer', 'no description', 'db967d0f7992ceba375bd5d00835e5d4', '2021-01-01', 'Morocco', 'no', 'CDI', '2020-12-26 16:49:15', 20000, '01', 'Bac');

-- --------------------------------------------------------

--
-- Structure de la table `job_seeker`
--

CREATE TABLE `job_seeker` (
  `id` int(11) NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday_date` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobility` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handicap` tinyint(1) NOT NULL,
  `diploma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `job_seeker`
--

INSERT INTO `job_seeker` (`id`, `roles`, `first_name`, `last_name`, `gender`, `birthday_date`, `address`, `mobility`, `handicap`, `diploma`, `skills`) VALUES
(28, '[]', 'test', 'test', 'male', '1900-01-01', 'test', 'local', 1, 'test', 'test'),
(29, '[]', 'Adnane', 'Lourhzal', 'male', '2007-01-11', 'Marrakech', 'international', 1, 'nope', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `search_bar`
--

CREATE TABLE `search_bar` (
  `id` int(11) NOT NULL,
  `search_content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `search_bar`
--

INSERT INTO `search_bar` (`id`, `search_content`) VALUES
(1, 'test'),
(2, 'Cash'),
(3, 'Cashier'),
(4, 't'),
(5, 't'),
(6, 't'),
(7, 't'),
(8, 't'),
(9, 't'),
(10, 'o'),
(11, 'Cash'),
(12, 'Co'),
(13, 'S'),
(14, 'Agent'),
(15, 'empl'),
(16, 'agent'),
(17, 'c'),
(18, 'e'),
(19, 'c'),
(20, 'cdi'),
(21, 'CDI'),
(22, 'c');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `companies_id` int(11) DEFAULT NULL,
  `jobseeker_id` int(11) DEFAULT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:json)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `activation_token`, `tel`, `companies_id`, `jobseeker_id`, `uuid`, `roles`) VALUES
(38, 'test@test.test', '$argon2id$v=19$m=65536, t = 4,
        p = 1$iyhhHtpy + sA3GFGLGV75VQ$87lkpckfxhXf5QzJyKLWtZR4Pn3uR9pX7PTY9h2HTNk', '508e26791d837d017d4691072f15646f', 7, 3, NULL, '5f943fa05dbab', '[\"ROLE_EM\"]'),
(39, 'test@test.test', '$argon2id$v=19$m=65536,t=4,p=1$CPdjL3VTxdK8FWoxApzZmg$kK+DGhc1RZ09wU0Nir+SoKwlWPBc0HJ/wE7yAey5WWQ', '58cbf106c92b167e74961cfb9b234635', 7, NULL, NULL, '5f944041eca2c', NULL),
        (40, 'test@test.test',
         '$argon2id$v=19$m=65536,t=4,p=1$DdehmrGVfQCR9D6+kJbvVA$kpl0D3Ekd+1+r1auGWija/7OeSjamjfb0jqO4b0uPb0',
         '188c782eb9aef696cf7bc62865f772f1', 7, NULL, 28, '5f944070863c4', '[\"ROLE_JOS\"]'),
        (42, 'lourhzaladnane@gmail.com',
         '$argon2id$v=19$m=65536,t=4,p=1$bLKPf2xDhUJWuhE4XvapDA$WIbHoXipLCF8/2ut5w/B/zb/bKpwm9RbXoHfVFQ64GE',
         'd5ff49329cda6aabf026e20568e1b4f3', 770444209, NULL, 29, '5fb8e872893e4', '[\"ROLE_JOS\"]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_880E0D76A76ED395` (`user_id`);

--
-- Index pour la table `company`
--
ALTER TABLE `company`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
    ADD PRIMARY KEY (`version`);

--
-- Index pour la table `job_post`
--
ALTER TABLE `job_post`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `job_seeker`
--
ALTER TABLE `job_seeker`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `search_bar`
--
ALTER TABLE `search_bar`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649D17F50A6` (`uuid`),
  ADD KEY `IDX_8D93D6496AE4741E` (`companies_id`),
  ADD KEY `IDX_8D93D6494CF2B5A9` (`jobseeker_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `job_post`
--
ALTER TABLE `job_post`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `job_seeker`
--
ALTER TABLE `job_seeker`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `search_bar`
--
ALTER TABLE `search_bar`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
    ADD CONSTRAINT `FK_880E0D76A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
    ADD CONSTRAINT `FK_8D93D6494CF2B5A9` FOREIGN KEY (`jobseeker_id`) REFERENCES `job_seeker` (`id`),
  ADD CONSTRAINT `FK_8D93D6496AE4741E` FOREIGN KEY (`companies_id`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
