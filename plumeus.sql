-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 09 Juin 2017 à 13:26
-- Version du serveur: 5.5.52
-- Version de PHP: 5.5.38-1~dotdeb+7.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `plumeus`
--

-- --------------------------------------------------------

--
-- Structure de la table `blocs`
--

CREATE TABLE IF NOT EXISTS `blocs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `id_story` int(11) NOT NULL,
  `number_child_1` int(11) DEFAULT NULL,
  `number_child_2` int(11) DEFAULT NULL,
  `text_child_1` text,
  `text_child_2` text,
  `bloc_number` int(11) NOT NULL,
  `content` text,
  `end_bloc` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Contenu de la table `blocs`
--

INSERT INTO `blocs` (`id`, `title`, `id_story`, `number_child_1`, `number_child_2`, `text_child_1`, `text_child_2`, `bloc_number`, `content`, `end_bloc`) VALUES
(37, 'Incipit', 19, 2, 3, 'Vous décidez de vous venger, vous trouvez un couteau et décidez d’aller au contact, faisant confiance à vos talents de bretteur.', 'Vous choisissez raisonnablement de fuir, de vous cacher dans les ruines de bâtiments détruits par la guerre.', 1, 'Nous sommes en 2100 et le monde n’est plus tel que nous le connaissons, le réchauffement climatique a changé le sud de la planète en déserts, l’immigration s''est alors faite en masse ce qui entraina la disparition des frontières Nord / Sud telles que nous les connaissons.\n\nPlus de gouvernement, l’anarchie total dans les plus grandes villes du monde. \n\nVous incarnez un jeune homme dont la vie vient de basculer lorsque son foyer fut réduit en cendre par un groupe d’anarchiste. Vous seul avez survécu et votre survie ne tient qu’aux décisions qu’il vous faudra prendre. \nVous avez ouïe d’un groupe de résistants tentant tant bien que mal de calmer les choses de reprendre possession du pouvoir. Seul problème, la guérilla vous sépare de leur QG.\n\nCoups de feu, cris, sirènes, la rue n’est plus un endroit où il fait bon vivre. Vous êtes encore sous le choc devant les corps inertes de votre famille lorsque vous entendez un petit groupe d’extrémiste arme au point sillonnant les rues à la recherche de victimes.\n', 0),
(38, 'core', 19, 4, 5, 'Votre rage, votre soif de vengeance a pris le dessus et vous reprenez le combat', 'Vous capitulez et tentez de vous joindre à eux pensant que le chemin jusqu’au rebelles se fera sans soucis et de manière plus sûre', 2, 'Vous arrivez au contact, seul problème, après un bref échange de coups, vous vous rendez compte de votre bêtise, aucune chance de survie en continuant le combat. \nVos adversaires sont trop nombreux et bien plus équipés que vous, ils poussent des cris et vous provoquent, vous incitent à continuer le combat. Ils vous traitent de lâche et vous ordonnent de se soumettre ou de continuer le duel.', 0),
(39, 'core 2', 19, 7, 6, 'Vous accélérez le pas en tentant le tout pour le tout sachant qu’à la moindre erreur vous en payerai les conséquences.', 'Vous trouvez un abri afin de passer la journée sans prendre de risques.', 3, 'Se cacher était sans nul doute la meilleure solution, le groupe passe sans remarquer votre présence. Il ne vous reste qu’à continuer le chemin.\n\nVous déambulez entre les immeubles en feu, entre les échange de tir sans prendre part à la bataille, votre sens de la raison vous a permis de rester en vie. Par chance, dans une ruelle abandonnée vous trouvez une arme de poing. Soucis, le pistolet ne contient que deux balles vous êtes alors conscient qu’il vous faudra les utiliser à bon escient. Vous continuez votre chemin en vous frayant un passage entre les décombres. Chance pour vous, il fait nuit et votre silhouette passe inaperçu. La nuit permet de vous déplacez plus rapidement.\n\nLes lueurs du jour commencent à apparaître à l’horizon et vous n’êtes plus loin du campement des résistants mais les risques en pleins jours sont multipliés. Un choix s’impose alors.\n', 0),
(40, 'first end', 19, 1, 1, '', '', 4, 'Vous engagez le combat avec fougue, mais le nombre fait la force et vous vous faites rapidement surpasser. Vous vous rendez compte de votre imprudence et après plusieurs coups de couteau vous tombez à terre, immobile, allongé dans votre sang. Vous avez péri, le voyage fut de courte durée pour vous.\n', 1),
(41, 'rencontre avec les anarchistes', 19, 7, 3, 'Vous pensez avant tout à vous et sans hésiter vous prenez la vie du garçon.', 'Vous refusez de commettre un tel acte, en connaissance de cause vous acceptez les représailles.', 5, 'Les anarchistes acceptent votre reddition et vous somment de les suivre afin d’éliminer toute résistance. Après plusieurs heures de marche, dans une maison abandonnée, des pleures retentissent. Le groupe se jette à l’intérieur trouvant une mère et son fils en pleur dans ses bras. \nSans pitié, ils égorgèrent la mère et vous demande de faire vos preuves en tuant le petit garçon d’un coup de couteau au cœur. Vous n’avez pas prévu cette possibilité et vous êtes alors bloqué entre deux choix.', 0),
(42, 'Découverte d''un batiment', 19, 8, 5, 'Vous ne dites rien', 'Vous les suppliez de ne pas vous tuer', 6, 'Vous avez pris la décision d’attendre le crépuscule avant de continuer votre route. Un immeuble abandonné se tient devant vous, pressé par les rayons du soleil qui ne cessent de grandir vous y entrez sans réfléchir et tombez devant des ennemies, une véritable armée. Pris de panique vous vous agenouillez en sachant qu’en entrant dans cet immeuble vous avez signé votre arrêt de mort', 0),
(43, 'second end', 19, 1, 1, '', '', 7, 'Vous continuez alors votre route, vous rapprochant du but. \n\nEnfin, vous voyez à quelques rues d’ici un bâtiment aux fenêtres barricadés, aux portes blindés… Sans hésitez, vous courez à vive allure vers votre salut. Mais plusieurs groupes de scélérats vous ont vu vous enfuir et ont engagez la course poursuite. Les balles sifflent à quelque centimètre de vous. \n\nVous voyez votre heure arrivée lorsque qu’un groupe de résistant apparaît, armé jusqu’aux dents. Vous vous couchez à terre et le conflit éclate. Les balles, les grenades volent et ce pendant plusieurs minutes. Lorsque que le bruit cesse et que vous rouvrez les yeux, vous voyez un homme qui se tient devant vous et vous tend la main, vous vous relevez et observez la scène. Un nombre hallucinant de cadavre jonchent le sol et des cris de victoires retentissent. Ces cris venaient des résistants….', 1),
(44, 'third end', 19, 1, 1, '', '', 8, 'Les anarchistes vous assassinent sans pitié.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `gradient` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `gradient`) VALUES
(1, 'Fantaisie', 'fantaisie', '#ec407a, #6a1b9a'),
(2, 'Horreur', 'horreur', '#ab47bc, #4527a0'),
(3, 'Sci-Fi', 'sci-fi', '#006064, #64dd17'),
(4, 'Action', 'action', '#ffc107, #f4511e'),
(5, 'Drama', 'drama', '#5c6bc0, #673ab7'),
(6, 'Investigation', 'investigation', '#03a9f4, #3f51b5'),
(7, 'Autres', 'autres', '#ffca28, #ffa726');

-- --------------------------------------------------------

--
-- Structure de la table `choices`
--

CREATE TABLE IF NOT EXISTS `choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `bloc_nbr` int(11) NOT NULL,
  `next_bloc_nbr` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Structure de la table `dialogues`
--

CREATE TABLE IF NOT EXISTS `dialogues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bloc` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

-- --------------------------------------------------------

--
-- Structure de la table `readings`
--

CREATE TABLE IF NOT EXISTS `readings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Structure de la table `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_author` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `category` int(11) NOT NULL,
  `layout` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `datetimepost` datetime NOT NULL,
  `datetimeedit` datetime NOT NULL,
  `image_format` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `stories`
--

INSERT INTO `stories` (`id`, `id_author`, `title`, `description`, `category`, `layout`, `status`, `datetimepost`, `datetimeedit`, `image_format`) VALUES
(19, 4, 'Apocalypse 2100', 'Nous sommes en 2100 et le monde n’est plus tel que nous le connaissons, le réchauffement climatique a changé le sud de la planète en déserts, l’immigration s''est alors faite en masse ce qui entraina la disparition des frontières Nord / Sud telles que nous les connaissons.', 3, 1, 1, '2017-06-09 12:59:16', '2017-06-09 13:18:21', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `language` varchar(255) DEFAULT NULL,
  `biography` text,
  `confirmed` int(1) DEFAULT NULL,
  `signupdate` datetime NOT NULL,
  `admin` int(1) DEFAULT NULL,
  `image_format` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `language`, `biography`, `confirmed`, `signupdate`, `admin`, `image_format`) VALUES
(3, 'PrimFX', 'primfxtuto@gmail.com', '9125d285ef5a0c40e5a1258fb97200e11704e2c169a6f6a9d3dbf0589bf5ed0a8e39f6fd1c4859a724621a8d92302ca7e8a7d477f91cebc6c3b570ef15a71081', NULL, NULL, 0, '2017-04-07 14:19:49', 1, '2'),
(4, 'vdotbach', 'vdotbach@gmail.com', '41dcb3af369ef50279652decdf81c7e7198bd39e496af0903bda900f9dcd61e0f8f9f7ee47a5726de9626ed8c8e83abadfe2354e635034dea6a6d2b8c38eb078', NULL, NULL, 0, '2017-04-07 14:40:42', 1, '2'),
(5, 'bb', 'bb@g.com', 'd0fa8f8245f16baec8e2b707e7679ca27949864694463c97afa3312b497f1f159699d11bdd91e262b4c7cb9b22619932ec47b50b4cce1c7e521022515875d2b1', NULL, NULL, 0, '2017-05-31 00:10:41', NULL, NULL),
(6, 'T', 'charasma18@gmail.com', 'a6b45763ce3e26b27cbb64bbe736044912e59b1ed1a8c6931d85439993388ccd1b14c9657cd02846e831e131d9acd2d41a39f19dbad822f782ad0a3995d94c22', NULL, NULL, 0, '2017-06-09 01:43:33', NULL, '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
