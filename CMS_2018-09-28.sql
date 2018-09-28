# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.41)
# Database: CMS
# Generation Time: 2018-09-28 15:12:53 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table about
# ------------------------------------------------------------

DROP TABLE IF EXISTS `about`;

CREATE TABLE `about` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT 'NAME MISSING!',
  `title` varchar(255) DEFAULT 'TITLE MISSING!',
  `desc` varchar(255) DEFAULT 'DESCRIPTION MISSING!',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;

INSERT INTO `about` (`id`, `name`, `title`, `desc`)
VALUES
	(1,'DANIEL HOPTON','Full Stack Developer','My name is Dan, and I am a software developer living near Bath and Bristol. I have written a wide variety of applications, from video games to simple command line programs to backend and frontend web applications.');

/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table badges
# ------------------------------------------------------------

DROP TABLE IF EXISTS `badges`;

CREATE TABLE `badges` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `badges` WRITE;
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;

INSERT INTO `badges` (`id`, `value`)
VALUES
	(1,'devicon-csharp-plain'),
	(2,'devicon-csharp-html5'),
	(3,'devicon-css3-plain');

/*!40000 ALTER TABLE `badges` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contact
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `icon_id` int(11) unsigned NOT NULL,
  `link` varchar(255) NOT NULL DEFAULT 'todo: make page link to self in the event of no link',
  `text` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `icon_id` (`icon_id`),
  CONSTRAINT `icon_id` FOREIGN KEY (`icon_id`) REFERENCES `icons` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;

INSERT INTO `contact` (`id`, `icon_id`, `link`, `text`)
VALUES
	(1,2,'mailto:hoptond848@protonmail.com','hoptond848@protonmail.com'),
	(2,3,'https://github.com/hoptond','github.com/hoptond/'),
	(3,4,'https://www.linkedin.com/in/daniel-hopton-70476816b/','linkedin.com/in/daniel-hopton');

/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table icons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `icons`;

CREATE TABLE `icons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT 'fa fa-circle',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `icons` WRITE;
/*!40000 ALTER TABLE `icons` DISABLE KEYS */;

INSERT INTO `icons` (`id`, `name`)
VALUES
	(1,'fa fa-circle'),
	(2,'fa fa-at'),
	(3,'fa fa-github'),
	(4,'fa fa-linkedin'),
	(5,'fa fa-twitter');

/*!40000 ALTER TABLE `icons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT 'TITLE MISSING!',
  `type` varchar(100) DEFAULT '',
  `desc` varchar(400) NOT NULL DEFAULT 'DESCRIPTION MISSING!',
  `image` varchar(255) NOT NULL DEFAULT 'todo: add placeholder image for projects not provided',
  `link` varchar(255) NOT NULL DEFAULT 'https://github.com/hoptond',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;

INSERT INTO `projects` (`id`, `title`, `type`, `desc`, `image`, `link`)
VALUES
	(1,'MAGICIANS','A game for PC/Mac/Linux','Magicians is a role playing adventure game, written in C# and developed using the Monogame framework. This project, with the exception of testing, was produced independently: all code, art, writing, and audio was done myself. I maintained this project over a period of around 4 years: making a game is much harder than it looks!','magiprojectshowcase1.png','https://github.com/hoptond'),
	(2,'Portfolio','Web','This portfolio was the first web project I completed. todo: add more stuff','portfolioprojectshowcase.png','todo: link recursively');

/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
