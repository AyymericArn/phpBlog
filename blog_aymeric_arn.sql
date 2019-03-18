-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 17 fév. 2019 à 20:31
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog_aymeric_arn`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `claps` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `text`, `author`, `date`, `claps`) VALUES
(1, 'The Mystery of Color', 'What do you know about color? You probably know some basics of color theory: Colors live in a circle, and they\'re made of light. Some are warm, and others cool, etc.\r\n\r\nIn my years as a designer, I\'ve often wondered how we came to take these peculiar ideas for granted. Color is often the most salient element of design and perhaps the least understood. How would you explain \"red\" to the uninitiated? That very question has befuddled philosophers for generation, and you can be sure that I don\'t have the answer. For something banal, it\'s terribly mysterious.\r\n\r\nThe first thing you need to know about color is that it\'s bigger than you. It\'s an ancient language, older than English or Fortran, and almost every creature on earth speaks it. The colors of a coral snake say \"I kill.\" The colors of a ripe fruit say \"I am sweet and nutritious.\" Your ancestors may have learned to see colors more than a hundred million years before their first steps on dry land-and they had their damn priorities straight. Colors are powerful symbols by which you live or die; they\'re worth paying attention to.', 'Ben Hersh', '2019-02-01', 3702),
(3, 'VR and the Problem of How We Talk About Tech', 'The first thing you learn, working with virtual reality (VR), is that your eyes aren\'t much like cameras and your ears aren\'t much like microphones. You don\'t perceive the world pristinely; instead, you perceive how your personal history, philosophy, culture, and cognitive habits mix with the world out there beyond your head. When people in VR social experiments respond to avatars, for instance, you can measure their racism. But you can also use VR to become more aware of how you perceive anything in the world.\r\n\r\nWhen I put on a VR headset, I don\'t just see a glowing digital world around me. I also get another show, because when I flash back through the years, especially to when I was in my twenties, in the 1980s. I remember what a psychedelic feeling it was the first time such a headset gained a color screen; being doubly disoriented the first time I woke up inside VR after attempting an all-nighter; feeling self-conscious being such a huge, unkempt, and hairy creature showing compact, well-mannered Japanese people how to design kitchens in VR when they visited a fancy Tokyo department store.\r\n\r\nSome of my happiest memories are of getting apps to work for the first time, like the first surgical simulator; of playing musical instruments inside VR that would have been at home in a Dr. Seuss book. Other memories recall the intense challenges and stresses, like the messy struggle to get the first assembly line for VR headsets going. That happened in the physical world. Why did we even have to go there?\r\n\r\nBut then there\'s another sphere of experience hovering beyond memory. This is a special sense of place that technologists experience — a sensation of being positioned on a cosmic ramp of progress.', 'Jaron Lanier', '2018-12-13', 1300),
(20, 'Denys Chomel s\'invite dans mon blog', 'Lundi matin, Ã  9 heures, j\'Ã©tais tranquillement en train de faire mon blog cake PHP sans le cake quand soudain! je m\'aperÃ§us que le grand Denys avec un y s\'Ã©tait introduit, lui et sa lÃ©gendaire horloge, sur mon blog afin de tester l\'import d\'images dans les articles. Quelle surprise ! new mofid', 'john', '2019-02-14', 13),
(21, 'I\'m writing an article as an administrator !!!!', 'Fuuf jaaj saas saaaas cheech brurb siis', 'bruno', '2019-02-17', 3);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_article`, `author`, `text`, `date`, `likes`) VALUES
(1, 1, 'Jean-Didier', 'J\'adore vraiment ce genre d\'article qui parle de la réalité des faits derrière le miroir. Un grand bravo !', '2019-02-02', 5),
(2, 1, 'Ron', 'Peu d\'objectivité ici... on sent quand même un certain parti pris de l\'auteur...', '2018-12-27', 2),
(3, 1, 'Steve', 'René Descartes was right when he told that cows were able to fly if you put enough elium into it', '2019-02-15', 92),
(6, 3, 'Cortex', 'Écoute mes disques c\'est mieux que Patrick Sébastien', '2019-01-23', 5),
(7, 1, 'john', 'wow jadore les carottes !', '2019-02-09', 0),
(10, 1, 'john', 'hohoho c\'est le pÃ¨re noÃ«l', '2019-02-09', 0),
(12, 3, 'john', 'hey\r\n', '2019-02-11', 0),
(13, 3, 'john', 'deed chooch', '2019-02-16', 0),
(14, 20, 'john', 'je commente direct', '2019-02-16', 0);

-- --------------------------------------------------------

--
-- Structure de la table `liked_entities`
--

DROP TABLE IF EXISTS `liked_entities`;
CREATE TABLE IF NOT EXISTS `liked_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_entity` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `entity_type` enum('article','comment') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `liked_entities`
--

INSERT INTO `liked_entities` (`id`, `id_entity`, `id_user`, `entity_type`) VALUES
(1, 21, 1, 'article'),
(6, 3, 2, 'comment'),
(8, 13, 2, 'comment');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inscription_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `pseudo`, `email`, `password`, `inscription_date`) VALUES
(1, 'john_doe', 'john@doe.fr', 'qslhdkf', '2019-02-06'),
(2, 'john', 'cena@gmail.com', 'rooone', '2019-02-07'),
(3, 'mlkdsfklmjsdfq', 'route@mlksfd.fdfqs', 'FSUC7tSo7ogFJTxLfy', '2019-02-08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
