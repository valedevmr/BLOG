# ************************************************************
# Antares - SQL Client
# Version 0.7.21
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: 127.0.0.1 (mariadb.org binary distribution 10.4.21)
# Database: blog
# Generation time: 2024-04-24T04:21:42-05:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table blogs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id_blog` int(10) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `autor` varchar(150) NOT NULL,
  `content` tinytext NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `publication_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` int(10) NOT NULL,
  PRIMARY KEY (`id_blog`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;

INSERT INTO `blogs` (`id_blog`, `title`, `autor`, `content`, `deleted`, `publication_date`, `updated_at`, `id_user`) VALUES
	(1, "title", "autor", "contenwwwwwwwwwwt", 1, "2024-04-24 01:34:20", "2024-04-24 02:55:53", 1),
	(2, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:18", 2),
	(3, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(4, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(5, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(6, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(7, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(8, "title", "valente", "content", 0, "2024-04-24 01:34:36", "2024-04-24 03:02:40", 1),
	(9, "title", "autor", "codeginiter", 0, "2024-04-24 01:34:36", "2024-04-24 03:02:50", 1),
	(10, "title", "autor", "contenwwwwwwwwwwt", 1, "2024-04-24 01:34:36", "2024-04-24 02:56:53", 1),
	(11, "title", "autor", "content", 1, "2024-04-24 01:34:36", "2024-04-24 02:56:23", 2),
	(12, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(13, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(14, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(15, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(16, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(17, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(18, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(19, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(20, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(21, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(22, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(23, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(24, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(25, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(26, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(27, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(28, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(29, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(30, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(31, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(32, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(33, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(34, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(35, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(36, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(37, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(38, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(39, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(40, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(41, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(42, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(43, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1),
	(44, "title", "autor", "content", 0, "2024-04-24 01:34:36", "2024-04-24 02:20:11", 1);

/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id_user`, `email`, `password`, `active`, `created_at`, `updated_at`) VALUES
	(1, "correotest@gmail.com", "$2y$10$ovmWoS5AqAFJ2.g5yYhuAO3ffg99d22d3V0cmWlXexuYd1V/V0tP6", 1, "2024-04-24 00:13:02", "2024-04-24 00:13:02");

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2024-04-24T04:21:42-05:00
