-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 19 déc. 2024 à 09:28
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dx08_bd`
--
CREATE DATABASE IF NOT EXISTS `dx08_bd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dx08_bd`;

-- --------------------------------------------------------

--
-- Structure de la table `CHAPTER`
--

CREATE TABLE `CHAPTER` (
  `CHA_ID` int(2) NOT NULL,
  `LOO_ID` int(2) DEFAULT NULL,
  `CHA_NAME` varchar(128) NOT NULL,
  `CHA_CONTENT` text NOT NULL,
  `CHA_IMAGE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CHAPTER`
--

INSERT INTO `CHAPTER` (`CHA_ID`, `LOO_ID`, `CHA_NAME`, `CHA_CONTENT`, `CHA_IMAGE`) VALUES
(1, 1, 'Introduction', 'Le ciel est lourd ce soir sur le village du Val Perdu, dissimulé entre les montagnes. La petite taverne, dernier refuge avant l’immense forêt, est étrangement calme quand le bourgmestre s’approche de vous. Homme d’apparence usée par les années et les soucis, il vous adresse un regard désespéré. « Ma fille… elle a disparu dans la forêt. Personne n’a osé la chercher… sauf vous, peut- être ? On raconte qu’un sorcier vit dans un château en ruines, caché au cœur des bois. Depuis des mois, des jeunes filles disparaissent… J’ai besoin de vous pour la retrouver. » Vous sentez le poids de la mission qui s’annonce, et un frisson parcourt votre échine. Bientôt, la forêt s’ouvre devant vous, sombre et menaçante. La quête commence.', ''),
(2, 2, 'L’orée de la forêt', 'Vous franchissez la lisière des arbres, la pénombre de la forêt avalant le sentier devant vous. Un vent froid glisse entre les troncs, et le bruissement des feuilles ressemble à un murmure menaçant. Deux chemins s’offrent à vous : l’un sinueux, bordé de vieux arbres noueux ; l’autre droit mais envahi par des ronces épaisses.', ''),
(3, 3, 'L’arbre aux corbeaux', 'Votre choix vous mène devant un vieux chêne aux branches tordues, grouillant de corbeaux noirs qui vous observent en silence. À vos pieds, des traces de pas légers, probablement récents, mènent plus loin dans les bois. Soudain, un bruit de pas feutrés se fait entendre. Vous ressentez la présence d’un prédateur.', ''),
(4, 4, 'Le sanglier enragé', 'En progressant, le calme de la forêt est soudain brisé par un grognement. Surgissant des buissons, un énorme sanglier, au pelage épais et aux yeux injectés de sang, se dirige vers vous. Sa rage est palpable, et il semble prêt à en découdre. Le voici qui décide brutalement de vous charger !', ''),
(5, 5, 'Rencontre avec le paysan', 'Tandis que vous progressez, une voix humaine s’élève, interrompant le silence de la forêt. Vous tombez sur un vieux paysan, accroupi près de champignons aux couleurs vives. Il sursaute en vous voyant, puis se détend, vous souriant tristement. « Vous devriez faire attention, étranger, murmure-t-il. La nuit, des cris terrifiants retentissent depuis le cœur de la forêt… Des créatures rôdent. »', ''),
(6, 6, 'Le loup noir', 'À mesure que vous avancez, un bruissement attire votre attention. Une silhouette sombre s’élance soudainement devant vous : un loup noir aux yeux perçants. Son poil est hérissé et sa gueule laisse entrevoir des crocs acérés. Vous sentez son regard fixé sur vous, prêt à bondir.', ''),
(7, 7, 'La clairière aux pierres anciennes', 'Après votre rencontre, vous atteignez une clairière étrange, entourée de pierres dressées, comme un ancien autel oublié par le temps. Une légère brume rampe au sol, et les ombres des pierres semblent danser sous la lueur de la lune.', ''),
(8, 8, 'Les murmures du ruisseau', 'Essoufflé mais déterminé, vous arrivez près d’un petit ruisseau qui serpente au milieu des arbres. Le chant de l’eau vous apaise quelque peu, mais des murmures étranges semblent émaner de la rive. Vous apercevez des inscriptions anciennes gravées dans une pierre moussue.', ''),
(9, 9, 'Au pied du château', 'La forêt se disperse enfin, et devant vous se dresse une colline escarpée. Au sommet, le château en ruines projette une ombre menaçante sous le clair de lune. Les murs effrités et les tours en partie effondrées ajoutent à la sinistre réputation du lieu. Vous sentez que la véritable aventure commence ici, et que l’influence du sorcier n’est peut-être pas qu’une légende…', ''),
(10, NULL, 'La lumière au bout du néant', 'Le monde se dérobe sous vos pieds, et une obscurité profonde vous enveloppe, glaciale et insondable. Vous ne sentez plus le poids de votre équipement, ni la morsure de la douleur. Juste un vide infini, vous aspirant lentement dans les ténèbres. Alors que vous perdez toute notion du temps, une lueur douce apparaît au loin, vacillante comme une flamme fragile dans l’obscurité. Au fur et à mesure que vous approchez, vous entendez une voix, faible mais bienveillante, qui murmure des mots oubliés, anciens. « Brave âme, ton chemin n’est pas achevé... À ceux qui échouent, une seconde chance est accordée. Mais les caprices du destin exigent un sacrifice. » La lumière s’intensifie, et vous sentez vos forces revenir, mais vos poches sont vides, votre sac allégé de tout trésor. Votre équipement, vos armes, tout a disparu, laissant place à une sensation de vulnérabilité', ''),
(11, NULL, 'La curiosité tua le chat', 'Qu’avez-vous fait, Malheureux !', '');

-- --------------------------------------------------------

--
-- Structure de la table `CLASS`
--

CREATE TABLE `CLASS` (
  `CLA_ID` int(2) NOT NULL,
  `CLA_NAME` varchar(50) NOT NULL,
  `CLA_DESCRIPTION` char(255) DEFAULT NULL,
  `CLA_BASE_PV` int(2) NOT NULL,
  `CLA_BASE_MANA` int(2) NOT NULL,
  `CLA_STRENGTH` int(2) NOT NULL,
  `CLA_INITIATIVE` int(2) NOT NULL,
  `CLA_MAX_ITEMS` int(2) NOT NULL,
  `CLA_POID_MAX` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CLASS`
--

INSERT INTO `CLASS` (`CLA_ID`, `CLA_NAME`, `CLA_DESCRIPTION`, `CLA_BASE_PV`, `CLA_BASE_MANA`, `CLA_STRENGTH`, `CLA_INITIATIVE`, `CLA_MAX_ITEMS`, `CLA_POID_MAX`) VALUES
(0, 'Magicien', '', 25, 25, 3, 5, 10, 5),
(1, 'Guerrier', '', 30, 0, 15, 3, 10, 17),
(2, 'Voleur', '', 25, 15, 7, 10, 7, 9);

-- --------------------------------------------------------

--
-- Structure de la table `CONTAINS`
--

CREATE TABLE `CONTAINS` (
  `LOO_ID` int(2) NOT NULL,
  `ITE_ID` int(2) NOT NULL,
  `CON_QTE` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CONTAINS`
--

INSERT INTO `CONTAINS` (`LOO_ID`, `ITE_ID`, `CON_QTE`) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 1, 1),
(2, 4, 1),
(3, 7, 1),
(3, 8, 1),
(4, 1, 1),
(4, 4, 1),
(4, 15, 1),
(5, 5, 1),
(6, 9, 1),
(6, 12, 1),
(7, 3, 2),
(7, 8, 1),
(8, 1, 2),
(8, 13, 1),
(9, 8, 2),
(9, 9, 1),
(9, 11, 1),
(10, 1, 1),
(11, 8, 1),
(12, 1, 1),
(12, 2, 1),
(13, 7, 1),
(13, 15, 2),
(14, 5, 1),
(14, 8, 1),
(15, 1, 2),
(15, 13, 1),
(16, 1, 1),
(16, 4, 1),
(17, 3, 1),
(17, 8, 2),
(18, 1, 2),
(18, 11, 1),
(19, 1, 2),
(19, 12, 1),
(20, 5, 1),
(20, 8, 2),
(21, 1, 2),
(21, 7, 1),
(22, 9, 1),
(22, 15, 2),
(23, 10, 1),
(23, 12, 1),
(24, 1, 3),
(24, 8, 1),
(24, 12, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ENCOUNTER`
--

CREATE TABLE `ENCOUNTER` (
  `CHA_ID` int(2) NOT NULL,
  `MON_ID` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ENCOUNTER`
--

INSERT INTO `ENCOUNTER` (`CHA_ID`, `MON_ID`) VALUES
(4, 1),
(6, 4);

-- --------------------------------------------------------

--
-- Structure de la table `HERO`
--

CREATE TABLE `HERO` (
  `HER_ID` int(2) NOT NULL,
  `CLA_ID` int(2) NOT NULL,
  `PLA_ID` int(2) NOT NULL,
  `HER_NAME` varchar(50) NOT NULL,
  `HER_IMAGE` varchar(255) DEFAULT NULL,
  `HER_BIOGRAPHY` char(255) DEFAULT NULL,
  `HER_PV` int(2) NOT NULL,
  `HER_MANA` int(2) NOT NULL,
  `HER_STRENGTH` int(2) NOT NULL,
  `HER_INITIATIVE` int(2) NOT NULL,
  `HER_ARMOR` varchar(50) DEFAULT NULL,
  `HER_PRIM_WEAPON` varchar(50) DEFAULT NULL,
  `HER_SEC_WEAPON` varchar(50) DEFAULT NULL,
  `HER_SHIELD` varchar(50) DEFAULT NULL,
  `HER_SPELL_LIST` varchar(128) DEFAULT NULL,
  `HER_XP` int(2) NOT NULL,
  `HER_CURRENT_LEVEL` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `INVENTORY`
--

CREATE TABLE `INVENTORY` (
  `ITE_ID` int(2) NOT NULL,
  `HER_ID` int(2) NOT NULL,
  `INV_QTE` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ITEMS`
--

CREATE TABLE `ITEMS` (
  `ITE_ID` int(2) NOT NULL,
  `TYP_ID` int(11) NOT NULL,
  `ITE_NAME` varchar(50) NOT NULL,
  `ITE_DESCRIPTION` text DEFAULT NULL,
  `ITE_POIDS` int(2) DEFAULT NULL,
  `ITE_VALUE` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ITEMS`
--

INSERT INTO `ITEMS` (`ITE_ID`, `TYP_ID`, `ITE_NAME`, `ITE_DESCRIPTION`, `ITE_POIDS`, `ITE_VALUE`) VALUES
(1, 3, 'Potion de vie', 'Restaure 50 points de vie', 2, 20),
(2, 1, 'Épée rouillée', 'Une épée usée, inflige des dégâts bas', 8, 8),
(3, 0, 'Sort de feu', 'Permet de lancer une boule de feu', 0, 20),
(4, 2, 'Bouclier en bois', 'Augmente la défense', 3, 15),
(5, 2, 'Anneau magique', 'Augmente la mana maximale de 10 points', 1, 10),
(6, 1, 'Lance de voyageur', '', 10, 15),
(7, 1, 'Couteau furtif', '', 3, 5),
(8, 3, 'Potion de mana', 'Restaure 30 points de mana', 1, 25),
(9, 1, 'Épée en fer', 'Une épée solide avec une lame tranchante', 8, 15),
(10, 0, 'Sort de glace', 'Permet de lancer une boule de glace', 0, 15),
(11, 2, 'Bouclier en fer', 'Augmente considérablement la défense', 6, 20),
(12, 2, 'Anneau de force', 'Augmente la force de l’utilisateur de 5 points', 1, 5),
(13, 0, 'Sort d’éclair', 'Lance un puissant éclair électrique', 0, 25),
(14, 1, 'Arc en bois', 'Arme à distance infligeant des dégâts modérés', 5, 8),
(15, 2, 'Viande contaminée', 'Pas ouf', 2, -1);

-- --------------------------------------------------------

--
-- Structure de la table `LEVEL`
--

CREATE TABLE `LEVEL` (
  `LEV_ID` int(2) NOT NULL,
  `CLA_ID` int(2) NOT NULL,
  `LEV_NUM` int(2) NOT NULL,
  `LEV_REQUIRED_XP` int(2) NOT NULL,
  `LEV_PV_BONUS` int(2) NOT NULL,
  `LEV_MANA_BONUS` int(2) NOT NULL,
  `LEV_STRENGTH_BONUS` int(2) NOT NULL,
  `LEV_INITIATIVE_BONUS` int(2) NOT NULL,
  `LEV_POID_BONUS` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `LEVEL`
--

INSERT INTO `LEVEL` (`LEV_ID`, `CLA_ID`, `LEV_NUM`, `LEV_REQUIRED_XP`, `LEV_PV_BONUS`, `LEV_MANA_BONUS`, `LEV_STRENGTH_BONUS`, `LEV_INITIATIVE_BONUS`, `LEV_POID_BONUS`) VALUES
(1, 0, 1, 100, 7, 4, 1, 1, 1),
(2, 0, 2, 300, 7, 7, 2, 3, 2),
(3, 0, 3, 600, 8, 12, 4, 5, 4),
(4, 1, 1, 100, 10, 0, 3, 1, 2),
(5, 1, 2, 300, 10, 0, 6, 2, 4),
(6, 1, 3, 600, 15, 0, 11, 4, 7),
(7, 2, 1, 100, 7, 2, 2, 2, 1),
(8, 2, 2, 300, 7, 5, 4, 4, 2),
(9, 2, 3, 600, 10, 9, 6, 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `LINK`
--

CREATE TABLE `LINK` (
  `CHA_ID` int(2) NOT NULL,
  `CHA_ID_1` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `LINK`
--

INSERT INTO `LINK` (`CHA_ID`, `CHA_ID_1`) VALUES
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 8),
(4, 10),
(5, 7),
(6, 7),
(6, 10),
(7, 8),
(7, 9),
(8, 9),
(8, 11),
(10, 1),
(11, 10);

-- --------------------------------------------------------

--
-- Structure de la table `LOOT`
--

CREATE TABLE `LOOT` (
  `LOO_ID` int(2) NOT NULL,
  `LOO_NAME` varchar(50) NOT NULL,
  `LOO_QUANTITY` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `LOOT`
--

INSERT INTO `LOOT` (`LOO_ID`, `LOO_NAME`, `LOO_QUANTITY`) VALUES
(1, 'Loot de départ', 1),
(2, 'Butin de l’éclaireur', 1),
(3, 'Trésor du corbeau noir', 1),
(4, 'Butin du sanglier sauvage', 1),
(5, 'Offrande du voyageur', 1),
(6, 'Butin du prédateur nocture', 1),
(7, 'Trésor des pierres anciennes ', 1),
(8, 'Butin de l’archer perdu', 1),
(9, 'Trésor du guerrier d’élite', 1),
(10, 'Butin des égouts', 1),
(11, 'Butin des ténèbres', 1),
(12, 'Butin du gobelin', 1),
(13, 'Butin du prédateur', 1),
(14, 'Trésor du spectre', 1),
(15, 'Butin du brigand', 1),
(16, 'Trésor de Noé', 1),
(17, 'Butin du mage novice', 1),
(18, 'Butin du chevalier déchu', 1),
(19, 'Trésor du labyrinthe', 1),
(20, 'Butin du spectre magique', 1),
(21, 'Butin de l’ombre', 1),
(22, 'Coeur de pierre', 1),
(23, 'Trésor du dragonnet', 1),
(24, 'Trésor du chef des voleurs', 1);

-- --------------------------------------------------------

--
-- Structure de la table `MONSTER`
--

CREATE TABLE `MONSTER` (
  `MON_ID` int(2) NOT NULL,
  `LOO_ID` int(2) NOT NULL,
  `MON_NAME` varchar(50) NOT NULL,
  `MON_PV` int(3) NOT NULL,
  `MON_MANA` int(3) DEFAULT NULL,
  `MON_INITIATIVE` int(3) NOT NULL,
  `MON_STRENGTH` int(3) NOT NULL,
  `MON_ATTACK` char(32) DEFAULT NULL,
  `MON_XP` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `MONSTER`
--

INSERT INTO `MONSTER` (`MON_ID`, `LOO_ID`, `MON_NAME`, `MON_PV`, `MON_MANA`, `MON_INITIATIVE`, `MON_STRENGTH`, `MON_ATTACK`, `MON_XP`) VALUES
(1, 10, 'Sanglier enragé', 20, 0, 5, 3, 'Morsure rapide', 30),
(2, 11, 'Chauve-souris géante', 25, 10, 7, 4, 'Griffe empoisonnée', 35),
(3, 12, 'Gobelin faible', 30, 5, 6, 5, 'Coup de gourdin', 40),
(4, 13, 'Loup noir', 45, 0, 8, 10, 'Crocs acérés', 60),
(5, 14, 'Fantôme errant', 35, 20, 10, 6, 'Toucher spectral', 70),
(6, 15, 'Bandit', 50, 0, 6, 8, 'Coup de dague', 80),
(7, 16, 'Noé Brault', 80, 0, 5, 12, 'Charge brutale', 120),
(8, 17, 'Mage noir faible', 40, 30, 6, 5, 'Éclair ténébreux', 100),
(9, 18, 'Chevalier maudit', 70, 10, 4, 10, 'Épée lourde', 150),
(10, 19, 'Minotaure', 120, 0, 6, 15, 'Frappe puissante', 200),
(11, 20, 'Spectre de mana', 60, 50, 12, 8, 'Rayon magique', 180),
(12, 21, 'Assassin des ombres', 70, 20, 15, 9, 'Attaque furtive', 190),
(13, 22, 'Golem de pierre', 150, 0, 3, 20, 'Écrasement', 250),
(14, 23, 'Dragonnet de feu', 100, 40, 8, 12, 'Souffle de feu', 300),
(15, 24, 'Seigneur des bandits', 110, 10, 10, 15, 'Lame du chef', 280);

-- --------------------------------------------------------

--
-- Structure de la table `PLAYER`
--

CREATE TABLE `PLAYER` (
  `PLA_ID` int(2) NOT NULL,
  `PLA_FIRSTNAME` char(32) NOT NULL,
  `PLA_SURNAME` char(32) NOT NULL,
  `PLA_MAIL` char(32) NOT NULL,
  `PLA_PSEUDO` char(32) NOT NULL,
  `PLA_PASSWD` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `PLAYER`
--

INSERT INTO `PLAYER` (`PLA_ID`, `PLA_FIRSTNAME`, `PLA_SURNAME`, `PLA_MAIL`, `PLA_PSEUDO`, `PLA_PASSWD`) VALUES
(2, 'moi', 'moi', 'moi@mail.com', 'moi', '$2y$10$27lcdTFM2mr3OY4FmHSQDuVrqnfNmvlucQQcx16PheT3TyeuA41.a');

-- --------------------------------------------------------

--
-- Structure de la table `QUEST`
--

CREATE TABLE `QUEST` (
  `CHA_ID` int(2) NOT NULL,
  `HER_ID` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `TYPE_ITEM`
--

CREATE TABLE `TYPE_ITEM` (
  `TYP_ID` int(11) NOT NULL,
  `TYP_LIBELLE` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `TYPE_ITEM`
--

INSERT INTO `TYPE_ITEM` (`TYP_ID`, `TYP_LIBELLE`) VALUES
(0, 'sort'),
(1, 'arme'),
(2, 'autre'),
(3, 'potion');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CHAPTER`
--
ALTER TABLE `CHAPTER`
  ADD PRIMARY KEY (`CHA_ID`),
  ADD KEY `I_FK_CHAPTER_LOOT` (`LOO_ID`);

--
-- Index pour la table `CLASS`
--
ALTER TABLE `CLASS`
  ADD PRIMARY KEY (`CLA_ID`);

--
-- Index pour la table `CONTAINS`
--
ALTER TABLE `CONTAINS`
  ADD PRIMARY KEY (`LOO_ID`,`ITE_ID`),
  ADD KEY `I_FK_CONTAINS_LOOT` (`LOO_ID`),
  ADD KEY `I_FK_CONTAINS_ITEMS` (`ITE_ID`);

--
-- Index pour la table `ENCOUNTER`
--
ALTER TABLE `ENCOUNTER`
  ADD PRIMARY KEY (`CHA_ID`,`MON_ID`),
  ADD KEY `I_FK_ENCOUNTER_CHAPTER` (`CHA_ID`),
  ADD KEY `I_FK_ENCOUNTER_MONSTER` (`MON_ID`);

--
-- Index pour la table `HERO`
--
ALTER TABLE `HERO`
  ADD PRIMARY KEY (`HER_ID`),
  ADD KEY `I_FK_HERO_CLASS` (`CLA_ID`),
  ADD KEY `I_FK_HERO_PLAYER` (`PLA_ID`);

--
-- Index pour la table `INVENTORY`
--
ALTER TABLE `INVENTORY`
  ADD PRIMARY KEY (`ITE_ID`,`HER_ID`),
  ADD KEY `I_FK_INVENTORY_ITEMS` (`ITE_ID`),
  ADD KEY `I_FK_INVENTORY_HERO` (`HER_ID`);

--
-- Index pour la table `ITEMS`
--
ALTER TABLE `ITEMS`
  ADD PRIMARY KEY (`ITE_ID`),
  ADD KEY `fk_TYPE_ITEM` (`TYP_ID`);

--
-- Index pour la table `LEVEL`
--
ALTER TABLE `LEVEL`
  ADD PRIMARY KEY (`LEV_ID`),
  ADD KEY `I_FK_LEVEL_CLASS` (`CLA_ID`);

--
-- Index pour la table `LINK`
--
ALTER TABLE `LINK`
  ADD PRIMARY KEY (`CHA_ID`,`CHA_ID_1`),
  ADD KEY `I_FK_LINK_CHAPTER` (`CHA_ID`),
  ADD KEY `I_FK_LINK_CHAPTER1` (`CHA_ID_1`);

--
-- Index pour la table `LOOT`
--
ALTER TABLE `LOOT`
  ADD PRIMARY KEY (`LOO_ID`);

--
-- Index pour la table `MONSTER`
--
ALTER TABLE `MONSTER`
  ADD PRIMARY KEY (`MON_ID`),
  ADD KEY `I_FK_MONSTER_LOOT` (`LOO_ID`);

--
-- Index pour la table `PLAYER`
--
ALTER TABLE `PLAYER`
  ADD PRIMARY KEY (`PLA_ID`);

--
-- Index pour la table `QUEST`
--
ALTER TABLE `QUEST`
  ADD PRIMARY KEY (`CHA_ID`,`HER_ID`),
  ADD KEY `I_FK_QUEST_CHAPTER` (`CHA_ID`),
  ADD KEY `I_FK_QUEST_HERO` (`HER_ID`);

--
-- Index pour la table `TYPE_ITEM`
--
ALTER TABLE `TYPE_ITEM`
  ADD PRIMARY KEY (`TYP_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CHAPTER`
--
ALTER TABLE `CHAPTER`
  MODIFY `CHA_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `HERO`
--
ALTER TABLE `HERO`
  MODIFY `HER_ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `LEVEL`
--
ALTER TABLE `LEVEL`
  MODIFY `LEV_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `LOOT`
--
ALTER TABLE `LOOT`
  MODIFY `LOO_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `CHAPTER`
--
ALTER TABLE `CHAPTER`
  ADD CONSTRAINT `FK_CHAPTER_LOOT` FOREIGN KEY (`LOO_ID`) REFERENCES `LOOT` (`LOO_ID`);

--
-- Contraintes pour la table `CONTAINS`
--
ALTER TABLE `CONTAINS`
  ADD CONSTRAINT `FK_CONTAINS_ITEMS` FOREIGN KEY (`ITE_ID`) REFERENCES `ITEMS` (`ITE_ID`),
  ADD CONSTRAINT `FK_CONTAINS_LOOT` FOREIGN KEY (`LOO_ID`) REFERENCES `LOOT` (`LOO_ID`);

--
-- Contraintes pour la table `ENCOUNTER`
--
ALTER TABLE `ENCOUNTER`
  ADD CONSTRAINT `FK_ENCOUNTER_CHAPTER` FOREIGN KEY (`CHA_ID`) REFERENCES `CHAPTER` (`CHA_ID`),
  ADD CONSTRAINT `FK_ENCOUNTER_MONSTER` FOREIGN KEY (`MON_ID`) REFERENCES `MONSTER` (`MON_ID`);

--
-- Contraintes pour la table `HERO`
--
ALTER TABLE `HERO`
  ADD CONSTRAINT `FK_HERO_CLASS` FOREIGN KEY (`CLA_ID`) REFERENCES `CLASS` (`CLA_ID`),
  ADD CONSTRAINT `FK_HERO_PLAYER` FOREIGN KEY (`PLA_ID`) REFERENCES `PLAYER` (`PLA_ID`);

--
-- Contraintes pour la table `INVENTORY`
--
ALTER TABLE `INVENTORY`
  ADD CONSTRAINT `FK_INVENTORY_HERO` FOREIGN KEY (`HER_ID`) REFERENCES `HERO` (`HER_ID`),
  ADD CONSTRAINT `FK_INVENTORY_ITEMS` FOREIGN KEY (`ITE_ID`) REFERENCES `ITEMS` (`ITE_ID`);

--
-- Contraintes pour la table `ITEMS`
--
ALTER TABLE `ITEMS`
  ADD CONSTRAINT `fk_TYPE_ITEM` FOREIGN KEY (`TYP_ID`) REFERENCES `TYPE_ITEM` (`TYP_ID`);

--
-- Contraintes pour la table `LEVEL`
--
ALTER TABLE `LEVEL`
  ADD CONSTRAINT `FK_LEVEL_CLASS` FOREIGN KEY (`CLA_ID`) REFERENCES `CLASS` (`CLA_ID`);

--
-- Contraintes pour la table `LINK`
--
ALTER TABLE `LINK`
  ADD CONSTRAINT `FK_LINK_CHAPTER` FOREIGN KEY (`CHA_ID`) REFERENCES `CHAPTER` (`CHA_ID`),
  ADD CONSTRAINT `FK_LINK_CHAPTER1` FOREIGN KEY (`CHA_ID_1`) REFERENCES `CHAPTER` (`CHA_ID`);

--
-- Contraintes pour la table `MONSTER`
--
ALTER TABLE `MONSTER`
  ADD CONSTRAINT `FK_MONSTER_LOOT` FOREIGN KEY (`LOO_ID`) REFERENCES `LOOT` (`LOO_ID`);

--
-- Contraintes pour la table `QUEST`
--
ALTER TABLE `QUEST`
  ADD CONSTRAINT `FK_QUEST_CHAPTER` FOREIGN KEY (`CHA_ID`) REFERENCES `CHAPTER` (`CHA_ID`),
  ADD CONSTRAINT `FK_QUEST_HERO` FOREIGN KEY (`HER_ID`) REFERENCES `HERO` (`HER_ID`);
--
-- Base de données : `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
