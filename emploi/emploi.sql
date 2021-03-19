-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 11 mars 2021 à 13:31
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `emploi`
--

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `adresse` text NOT NULL,
  `specialite` int(11) NOT NULL,
  `niveau_etudes` int(11) NOT NULL,
  `exprience_professionnelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cv`
--

INSERT INTO `cv` (`id`, `iduser`, `age`, `adresse`, `specialite`, `niveau_etudes`, `exprience_professionnelle`) VALUES
(1, 5, 21, '<p>Sicap fann 8787</p>', 10, 4, '5 ans '),
(2, 6, 22, '<p>HLM FASS 8754</p>', 9, 4, '2 ANS');

-- --------------------------------------------------------

--
-- Structure de la table `niveau_etudes`
--

CREATE TABLE `niveau_etudes` (
  `id` int(11) NOT NULL,
  `niveau_etudes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `niveau_etudes`
--

INSERT INTO `niveau_etudes` (`id`, `niveau_etudes`) VALUES
(1, 'Sans niveau'),
(2, 'Primaire'),
(3, 'Secondaire'),
(4, 'Universitaire'),
(5, 'Formation professionnelle');

-- --------------------------------------------------------

--
-- Structure de la table `offre_emploi`
--

CREATE TABLE `offre_emploi` (
  `id` int(11) NOT NULL,
  `specialite` int(100) NOT NULL,
  `date_publication` date NOT NULL,
  `date_cloture` date NOT NULL,
  `entreprise` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `offre_emploi`
--

INSERT INTO `offre_emploi` (`id`, `specialite`, `date_publication`, `date_cloture`, `entreprise`, `description`) VALUES
(2, 9, '2021-03-11', '2021-04-30', 2, '<p>Offre emploi BTP pour travaux terrassement</p>'),
(3, 10, '2021-03-11', '2021-04-30', 2, '<p>Offre emploi Génie Chimique pour laboratoires internes</p>'),
(4, 9, '2021-03-11', '2021-05-28', 3, '<p>Emploi BTP chargé de promouvoir les travaux skjskjs</p>');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(3, 'Demandeur'),
(2, 'Entreprise');

-- --------------------------------------------------------

--
-- Structure de la table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `action_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role_permissions`
--

INSERT INTO `role_permissions` (`permission_id`, `role_id`, `page_name`, `action_name`) VALUES
(643, 1, 'users', 'list'),
(644, 1, 'users', 'view'),
(645, 1, 'users', 'add'),
(646, 1, 'users', 'edit'),
(647, 1, 'users', 'editfield'),
(648, 1, 'users', 'delete'),
(649, 1, 'users', 'import_data'),
(650, 1, 'users', 'userregister'),
(651, 1, 'users', 'accountedit'),
(652, 1, 'users', 'accountview'),
(653, 1, 'cv', 'list'),
(654, 1, 'niveau_etudes', 'list'),
(655, 1, 'niveau_etudes', 'add'),
(656, 1, 'niveau_etudes', 'edit'),
(657, 1, 'niveau_etudes', 'editfield'),
(658, 1, 'niveau_etudes', 'delete'),
(659, 1, 'offre_emploi', 'list'),
(660, 1, 'specialite', 'list'),
(661, 1, 'specialite', 'view'),
(662, 1, 'specialite', 'add'),
(663, 1, 'specialite', 'edit'),
(664, 1, 'specialite', 'editfield'),
(665, 1, 'specialite', 'delete'),
(666, 2, 'cv', 'list'),
(667, 2, 'cv', 'view'),
(668, 2, 'offre_emploi', 'add'),
(669, 2, 'offre_emploi', 'edit'),
(670, 2, 'offre_emploi', 'editfield'),
(671, 2, 'offre_emploi', 'creeroffres'),
(672, 3, 'cv', 'add'),
(673, 3, 'cv', 'edit'),
(674, 3, 'cv', 'editfield'),
(675, 3, 'offre_emploi', 'list'),
(676, 3, 'offre_emploi', 'view'),
(677, 3, 'cv', 'creercv');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id` int(11) NOT NULL,
  `specialite` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id`, `specialite`) VALUES
(1, 'Informatique'),
(2, 'Gestion comptabilité'),
(3, 'Banques Finances Assurances'),
(4, 'Infographie'),
(5, 'Electricité'),
(6, 'Froid'),
(7, 'Menuiserie'),
(8, 'Mécanique'),
(9, 'BTP Génie civil'),
(10, 'Chimie'),
(11, 'Biologie');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `identification` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo` blob NOT NULL,
  `emailuser` varchar(100) NOT NULL,
  `cellulaire` varchar(50) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2021-06-11 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `identification`, `login`, `password`, `photo`, `emailuser`, `cellulaire`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`, `user_role_id`) VALUES
(2, 'SOCETRA', 'socetra', '$2y$10$Ah9vAlYLGvawjFRrgoRIS.KCsKbfL.7dPw6nG/B3mIkmLO3DSk3Je', 0x687474703a2f2f6c6f63616c686f73742f656d706c6f692f75706c6f6164732f66696c65732f746735756966736d346e717a3032382e6a7067, 'socetra@gmail.com', '7754212121', NULL, NULL, '2021-06-11 00:00:00', NULL, 2),
(3, 'SOCOCIM', 'sococim', '$2y$10$9rU6G9OudJmYEUYQRdFh6eOeR2RZ7yswYAeL.Fsy4WzsfBFh8rn5S', 0x687474703a2f2f6c6f63616c686f73742f656d706c6f692f75706c6f6164732f66696c65732f36616f7068396b75796e6a336234652e6a7067, 'socoim@gmail.com', '7745122121', NULL, NULL, '2021-06-11 00:00:00', NULL, 2),
(5, 'Pape Ba', 'papeba', '$2y$10$tFXlrExiKfkYqx.sFP4rMe4SBjnGGUx6wWYdYs.gNj4MgSl25I0K.', 0x687474703a2f2f6c6f63616c686f73742f656d706c6f692f75706c6f6164732f66696c65732f306d73726f787664377535746762792e6a7067, 'papeba@gmail.com', '774512151', NULL, NULL, '2021-06-11 00:00:00', NULL, 3),
(6, 'Fatou Ba', 'fatou', '$2y$10$Un/zYYdgDRSvF96T2JtrlufmHRd54FV35j8Ci2Ya4GQbLx.REU5BG', 0x687474703a2f2f6c6f63616c686f73742f656d706c6f692f75706c6f6164732f66696c65732f677179655f686b7630387a326434312e6a7067, 'fatou@gmail.com', '7615488', NULL, NULL, '2021-06-11 00:00:00', NULL, 3),
(7, 'Fatou  Beye', 'mamy', '$2y$10$BeJ1Un02j0MV3hS0v/Akz.WIDIHhWecc8v3OLXofGsyLFZ4ByA90G', 0x687474703a2f2f6c6f63616c686f73742f656d706c6f692f75706c6f6164732f66696c65732f7667325f717379613563376b646a662e6a7067, 'mamy@yahooo.fr', '7787887', NULL, NULL, '2021-06-11 00:00:00', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `niveau_etudes`
--
ALTER TABLE `niveau_etudes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offre_emploi`
--
ALTER TABLE `offre_emploi`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Index pour la table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `niveau_etudes`
--
ALTER TABLE `niveau_etudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `offre_emploi`
--
ALTER TABLE `offre_emploi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=678;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
