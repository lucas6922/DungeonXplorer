-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2024 at 02:09 PM
-- Server version: 8.0.36
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dx08`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `CHA_ID` int NOT NULL,
  `LOO_ID` int DEFAULT NULL,
  `CHA_NAME` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `CHA_CONTENT` text COLLATE utf8mb4_general_ci NOT NULL,
  `CHA_IMAGE` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`CHA_ID`, `LOO_ID`, `CHA_NAME`, `CHA_CONTENT`, `CHA_IMAGE`) VALUES
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
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `CLA_ID` int NOT NULL,
  `CLA_NAME` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `CLA_DESCRIPTION` char(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CLA_BASE_PV` int NOT NULL,
  `CLA_BASE_MANA` int NOT NULL,
  `CLA_STRENGTH` int NOT NULL,
  `CLA_INITIATIVE` int NOT NULL,
  `CLA_MAX_ITEMS` int NOT NULL,
  `CLA_POID_MAX` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`CLA_ID`, `CLA_NAME`, `CLA_DESCRIPTION`, `CLA_BASE_PV`, `CLA_BASE_MANA`, `CLA_STRENGTH`, `CLA_INITIATIVE`, `CLA_MAX_ITEMS`, `CLA_POID_MAX`) VALUES
(0, 'Magicien', '', 25, 25, 3, 5, 10, 5),
(1, 'Guerrier', '', 30, 0, 15, 3, 10, 17),
(2, 'Voleur', '', 25, 15, 7, 10, 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `LOO_ID` int NOT NULL,
  `ITE_ID` int NOT NULL,
  `CON_QTE` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contains`
--

INSERT INTO `contains` (`LOO_ID`, `ITE_ID`, `CON_QTE`) VALUES
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
-- Table structure for table `encounter`
--

CREATE TABLE `encounter` (
  `CHA_ID` int NOT NULL,
  `MON_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `encounter`
--

INSERT INTO `encounter` (`CHA_ID`, `MON_ID`) VALUES
(4, 1),
(6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `hero`
--

CREATE TABLE `hero` (
  `HER_ID` int NOT NULL,
  `CLA_ID` int NOT NULL,
  `PLA_ID` int NOT NULL,
  `CHA_ID` int DEFAULT NULL,
  `HER_NAME` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `HER_IMAGE` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `HER_BIOGRAPHY` char(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `HER_PV` int NOT NULL,
  `HER_MANA` int NOT NULL,
  `HER_STRENGTH` int NOT NULL,
  `HER_INITIATIVE` int NOT NULL,
  `HER_ARMOR` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `HER_PRIM_WEAPON` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `HER_SEC_WEAPON` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `HER_SHIELD` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `HER_SPELL_LIST` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `HER_XP` int NOT NULL,
  `HER_CURRENT_LEVEL` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hero`
--

INSERT INTO `hero` (`HER_ID`, `CLA_ID`, `PLA_ID`, `CHA_ID`, `HER_NAME`, `HER_IMAGE`, `HER_BIOGRAPHY`, `HER_PV`, `HER_MANA`, `HER_STRENGTH`, `HER_INITIATIVE`, `HER_ARMOR`, `HER_PRIM_WEAPON`, `HER_SEC_WEAPON`, `HER_SHIELD`, `HER_SPELL_LIST`, `HER_XP`, `HER_CURRENT_LEVEL`) VALUES
(2, 0, 2, NULL, 's', NULL, '', 25, 25, 3, 5, NULL, NULL, NULL, NULL, NULL, 0, 1),
(8, 0, 2, NULL, 'test1983', NULL, 'eh frère marche', 25, 25, 3, 5, NULL, NULL, NULL, NULL, NULL, 0, 1),
(9, 0, 2, NULL, 'test1983', NULL, 'eh frère marche', 25, 25, 3, 5, NULL, NULL, NULL, NULL, NULL, 0, 1),
(11, 2, 2, NULL, 'fez', NULL, '', 25, 15, 7, 10, NULL, NULL, NULL, NULL, NULL, 0, 1),
(12, 1, 2, NULL, 'dhdhdhdhd', NULL, '', 30, 0, 15, 3, NULL, NULL, NULL, NULL, NULL, 0, 1),
(13, 1, 2, NULL, 'dhdhdhdhd', NULL, '', 30, 0, 15, 3, NULL, NULL, NULL, NULL, NULL, 0, 1),
(14, 1, 2, NULL, 'dhdhdhdhd', NULL, '', 30, 0, 15, 3, NULL, NULL, NULL, NULL, NULL, 0, 1),
(15, 1, 2, NULL, 'dhdhdhdhd', NULL, '', 30, 0, 15, 3, NULL, NULL, NULL, NULL, NULL, 0, 1),
(16, 1, 2, NULL, 'dhdhdhdhd', NULL, '', 30, 0, 15, 3, NULL, NULL, NULL, NULL, NULL, 0, 1),
(17, 1, 2, NULL, 'dhdhdhdhd', NULL, '', 30, 0, 15, 3, NULL, NULL, NULL, NULL, NULL, 0, 1),
(18, 1, 2, NULL, 'dhdhdhdhd', NULL, '', 30, 0, 15, 3, NULL, NULL, NULL, NULL, NULL, 0, 1),
(19, 0, 2, NULL, 'e', 'Images/perso_pp/OldMan02.jpg', '', 25, 25, 3, 5, NULL, NULL, NULL, NULL, NULL, 0, 1),
(20, 0, 2, NULL, 'lemons', 'Images/perso_pp/Magician01.jpg', '', 25, 25, 3, 5, NULL, NULL, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ITE_ID` int NOT NULL,
  `HER_ID` int NOT NULL,
  `INV_QTE` char(32) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ITE_ID` int NOT NULL,
  `TYP_ID` int NOT NULL,
  `ITE_NAME` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ITE_DESCRIPTION` text COLLATE utf8mb4_general_ci,
  `ITE_POIDS` int DEFAULT NULL,
  `ITE_VALUE` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ITE_ID`, `TYP_ID`, `ITE_NAME`, `ITE_DESCRIPTION`, `ITE_POIDS`, `ITE_VALUE`) VALUES
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
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `LEV_ID` int NOT NULL,
  `CLA_ID` int NOT NULL,
  `LEV_NUM` int NOT NULL,
  `LEV_REQUIRED_XP` int NOT NULL,
  `LEV_PV_BONUS` int NOT NULL,
  `LEV_MANA_BONUS` int NOT NULL,
  `LEV_STRENGTH_BONUS` int NOT NULL,
  `LEV_INITIATIVE_BONUS` int NOT NULL,
  `LEV_POID_BONUS` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`LEV_ID`, `CLA_ID`, `LEV_NUM`, `LEV_REQUIRED_XP`, `LEV_PV_BONUS`, `LEV_MANA_BONUS`, `LEV_STRENGTH_BONUS`, `LEV_INITIATIVE_BONUS`, `LEV_POID_BONUS`) VALUES
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
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `CHA_ID` int NOT NULL,
  `CHA_ID_1` int NOT NULL,
  `LIN_CONTENT` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`CHA_ID`, `CHA_ID_1`, `LIN_CONTENT`) VALUES
(1, 2, 'Si vous acceptez l\'aventure, rendez vous au chapitre 2.'),
(2, 3, 'Si vous empruntez le chemin sinueux, rendez-vous au chapitre 3.'),
(2, 4, 'Si vous choisissez le sentier couvert de ronces, rendez-vous au chapitre 4.\r\n'),
(3, 5, 'Si vous choisissez de rester prudent, rendez-vous au chapitre 5.'),
(3, 6, 'Si vous décidez d’ignorer les bruits et de poursuivre votre route, rendez-vous au chapitre 6.'),
(4, 8, 'Après avoir vaincu le sanglier, vous pourrez vous rendre au chapitre 8.'),
(4, 10, ' Sinon rendez-vous au chapitre 10.'),
(5, 7, 'Après l\'avoir écouté, vous pouvez continuer vers chapitre 7.'),
(6, 7, 'Si vous survivez au loup, rendez-vous au chapitre 7.'),
(6, 10, 'Si le loup vous terrasse, allez au chapitre 10.'),
(7, 8, 'Si vous décidez de prendre le sentier couvert de mousse, rendez-vous au chapitre 8.'),
(7, 9, 'Si vous choisissez de suivre le chemin tortueux à travers les racines, allez au chapitre 9.'),
(8, 9, 'Si vous ignorez cette curiosité et poursuivez votre route, allez au chapitre 9.'),
(8, 11, 'Si vous touchez la pierre gravée, allez au chapitre 11.'),
(10, 1, 'Si vous souhaitez reprendre l’aventure depuis le début, rendez-vous de nouveau au chapitre 1.'),
(11, 10, 'Rendez-vous sans perdre de temps au chapitre 10.');

-- --------------------------------------------------------

--
-- Table structure for table `loot`
--

CREATE TABLE `loot` (
  `LOO_ID` int NOT NULL,
  `LOO_NAME` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `LOO_QUANTITY` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loot`
--

INSERT INTO `loot` (`LOO_ID`, `LOO_NAME`, `LOO_QUANTITY`) VALUES
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
-- Table structure for table `monster`
--

CREATE TABLE `monster` (
  `MON_ID` int NOT NULL,
  `LOO_ID` int NOT NULL,
  `MON_NAME` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `MON_PV` int NOT NULL,
  `MON_MANA` int DEFAULT NULL,
  `MON_INITIATIVE` int NOT NULL,
  `MON_STRENGTH` int NOT NULL,
  `MON_ATTACK` char(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `MON_XP` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monster`
--

INSERT INTO `monster` (`MON_ID`, `LOO_ID`, `MON_NAME`, `MON_PV`, `MON_MANA`, `MON_INITIATIVE`, `MON_STRENGTH`, `MON_ATTACK`, `MON_XP`) VALUES
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
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `PLA_ID` int NOT NULL,
  `PLA_FIRSTNAME` char(32) COLLATE utf8mb4_general_ci NOT NULL,
  `PLA_SURNAME` char(32) COLLATE utf8mb4_general_ci NOT NULL,
  `PLA_MAIL` char(32) COLLATE utf8mb4_general_ci NOT NULL,
  `PLA_PSEUDO` char(32) COLLATE utf8mb4_general_ci NOT NULL,
  `PLA_PASSWD` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`PLA_ID`, `PLA_FIRSTNAME`, `PLA_SURNAME`, `PLA_MAIL`, `PLA_PSEUDO`, `PLA_PASSWD`) VALUES
(2, 'moi', 'moi', 'moi@mail.com', 'moi', '$2y$10$27lcdTFM2mr3OY4FmHSQDuVrqnfNmvlucQQcx16PheT3TyeuA41.a'),
(3, 'zsq', 'zs', 'ezs@s.c', 'ends', '$2y$10$EQWDxv8VhfZmpHVEDxhkQuaK.GODtDOHlqzHTAJ7WZ/ljf2APBMWi'),
(4, 'ds', 'ze', 'ds@mail.com', 'sd', '$2y$10$4NQhmV7CTqEgNq1PxOZesuOaD8Dr0I4J/emqJw4I3A6dyXWsKEKEy'),
(5, 'qs', 'dz', 'lu@lkn.com', 'q', '$2y$10$PVsXBUFcQWallDcTFkRD/ed00/bU/guFYqmh96Ssx5iVm242hTVX6'),
(6, 'qs', 'za', 'dqs@m.c', 'qd', '$2y$10$lJEyNisVtMQ/fG9gqA3hdO5ZhAaH5yRlUzCeXoekXWuokmmptEfC2'),
(7, 'ds', 'ez', 'ds@s.c', 'ds', '$2y$10$LAvwIk1mPMRzGJdxqMfgf.6KSEhN1my26pTy35FK3mO45AgzMSU5C'),
(8, 'fezcds', 'redczs', 'edcs@m.c', 'efdc', '$2y$10$Y65TzKojCkxva3U8Chl5s.qzZvz2/hHxoch50mLamueDpPgSE.7uO');

-- --------------------------------------------------------

--
-- Table structure for table `type_item`
--

CREATE TABLE `type_item` (
  `TYP_ID` int NOT NULL,
  `TYP_LIBELLE` varchar(64) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_item`
--

INSERT INTO `type_item` (`TYP_ID`, `TYP_LIBELLE`) VALUES
(0, 'sort'),
(1, 'arme'),
(2, 'autre'),
(3, 'potion');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`CHA_ID`),
  ADD KEY `I_FK_CHAPTER_LOOT` (`LOO_ID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`CLA_ID`);

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD PRIMARY KEY (`LOO_ID`,`ITE_ID`),
  ADD KEY `I_FK_CONTAINS_LOOT` (`LOO_ID`),
  ADD KEY `I_FK_CONTAINS_ITEMS` (`ITE_ID`);

--
-- Indexes for table `encounter`
--
ALTER TABLE `encounter`
  ADD PRIMARY KEY (`CHA_ID`,`MON_ID`),
  ADD KEY `I_FK_ENCOUNTER_CHAPTER` (`CHA_ID`),
  ADD KEY `I_FK_ENCOUNTER_MONSTER` (`MON_ID`);

--
-- Indexes for table `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`HER_ID`),
  ADD KEY `I_FK_HERO_CLASS` (`CLA_ID`),
  ADD KEY `I_FK_HERO_PLAYER` (`PLA_ID`),
  ADD KEY `fk_hero_chapter` (`CHA_ID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`ITE_ID`,`HER_ID`),
  ADD KEY `I_FK_INVENTORY_ITEMS` (`ITE_ID`),
  ADD KEY `I_FK_INVENTORY_HERO` (`HER_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ITE_ID`),
  ADD KEY `fk_TYPE_ITEM` (`TYP_ID`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`LEV_ID`),
  ADD KEY `I_FK_LEVEL_CLASS` (`CLA_ID`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`CHA_ID`,`CHA_ID_1`),
  ADD KEY `I_FK_LINK_CHAPTER` (`CHA_ID`),
  ADD KEY `I_FK_LINK_CHAPTER1` (`CHA_ID_1`);

--
-- Indexes for table `loot`
--
ALTER TABLE `loot`
  ADD PRIMARY KEY (`LOO_ID`);

--
-- Indexes for table `monster`
--
ALTER TABLE `monster`
  ADD PRIMARY KEY (`MON_ID`),
  ADD KEY `I_FK_MONSTER_LOOT` (`LOO_ID`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`PLA_ID`);

--
-- Indexes for table `type_item`
--
ALTER TABLE `type_item`
  ADD PRIMARY KEY (`TYP_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `CHA_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hero`
--
ALTER TABLE `hero`
  MODIFY `HER_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `LEV_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `loot`
--
ALTER TABLE `loot`
  MODIFY `LOO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `FK_CHAPTER_LOOT` FOREIGN KEY (`LOO_ID`) REFERENCES `loot` (`LOO_ID`);

--
-- Constraints for table `contains`
--
ALTER TABLE `contains`
  ADD CONSTRAINT `FK_CONTAINS_ITEMS` FOREIGN KEY (`ITE_ID`) REFERENCES `items` (`ITE_ID`),
  ADD CONSTRAINT `FK_CONTAINS_LOOT` FOREIGN KEY (`LOO_ID`) REFERENCES `loot` (`LOO_ID`);

--
-- Constraints for table `encounter`
--
ALTER TABLE `encounter`
  ADD CONSTRAINT `FK_ENCOUNTER_CHAPTER` FOREIGN KEY (`CHA_ID`) REFERENCES `chapter` (`CHA_ID`),
  ADD CONSTRAINT `FK_ENCOUNTER_MONSTER` FOREIGN KEY (`MON_ID`) REFERENCES `monster` (`MON_ID`);

--
-- Constraints for table `hero`
--
ALTER TABLE `hero`
  ADD CONSTRAINT `fk_hero_chapter` FOREIGN KEY (`CHA_ID`) REFERENCES `chapter` (`CHA_ID`),
  ADD CONSTRAINT `FK_HERO_CLASS` FOREIGN KEY (`CLA_ID`) REFERENCES `class` (`CLA_ID`),
  ADD CONSTRAINT `FK_HERO_PLAYER` FOREIGN KEY (`PLA_ID`) REFERENCES `player` (`PLA_ID`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `FK_INVENTORY_HERO` FOREIGN KEY (`HER_ID`) REFERENCES `hero` (`HER_ID`),
  ADD CONSTRAINT `FK_INVENTORY_ITEMS` FOREIGN KEY (`ITE_ID`) REFERENCES `items` (`ITE_ID`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_TYPE_ITEM` FOREIGN KEY (`TYP_ID`) REFERENCES `type_item` (`TYP_ID`);

--
-- Constraints for table `level`
--
ALTER TABLE `level`
  ADD CONSTRAINT `FK_LEVEL_CLASS` FOREIGN KEY (`CLA_ID`) REFERENCES `class` (`CLA_ID`);

--
-- Constraints for table `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `FK_LINK_CHAPTER` FOREIGN KEY (`CHA_ID`) REFERENCES `chapter` (`CHA_ID`),
  ADD CONSTRAINT `FK_LINK_CHAPTER1` FOREIGN KEY (`CHA_ID_1`) REFERENCES `chapter` (`CHA_ID`);

--
-- Constraints for table `monster`
--
ALTER TABLE `monster`
  ADD CONSTRAINT `FK_MONSTER_LOOT` FOREIGN KEY (`LOO_ID`) REFERENCES `loot` (`LOO_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
