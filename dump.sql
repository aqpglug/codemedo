-- MySQL dump 10.13  Distrib 5.1.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: codemedo
-- ------------------------------------------------------
-- Server version	5.1.49-3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Block`
--

DROP TABLE IF EXISTS `Block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext,
  `image` varchar(255) DEFAULT NULL,
  `metadata` longtext COMMENT '(DC2Type:array)',
  `published` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42DAB8268CDE5729` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Block`
--

LOCK TABLES `Block` WRITE;
/*!40000 ALTER TABLE `Block` DISABLE KEYS */;
INSERT INTO `Block` VALUES
(1,'page','inicio','inicio','<h1 style=\"text-align:center;font-size:60px;width:50%;float:left;margin-top:0;\">FLISOL 2012</h1>\r\n<p style=\"display:block;padding:20px;text-align:center;\">Es una oportunidad para todas aquellas personas interesadas en conocer más acerca del software libre, es posible entrar en contacto con el mundo del software libre, conocer a otros usuarios, resolver dudas e interrogantes, intercambiar opiniones y experiencias; asistir a charlas y otras actividades.</p>\r\n<div>[imagen]</div>',NULL,'N;',1,0,'2011-06-16 23:40:29','2011-06-16 23:40:29'),
(2,'project','Proyecto de software libre','proyecto-software-libre','Algún proyecto de software libre aqui',NULL,'N;',1,0,'2011-06-16 23:49:38','2011-06-16 23:49:38'),
(3,'article','¿Qué es software libre?','que-es-software-libre','La palabra \"libre\" en nuestro nombre no se refiere al precio; se refiere a la libertad. Primero, a la libertad de copiar y redistribuir un programa a tus vecinos, para que ellos al igual que tu, lo puedan usar también. Segundo, a la libertad de cambiar un programa, así podrás controlarlo en lugar que el programa te controle a ti; para esto, el código fuente tiene que estar disponible para ti',NULL,'N;',1,1,'2011-06-16 23:50:13','2011-06-16 23:50:13'),
(4,'page','Contacto','contacto','Página de contacto',NULL,'N;',1,0,'2011-06-17 00:48:50','2011-06-17 00:48:50'),
(5,'page','Software libre','software-libre','Algo es software libre',NULL,'N;',1,0,'2011-06-17 00:50:34','2011-06-17 00:50:34'),
(6,'member','Fulano activo','fulano-de-tal',NULL,NULL,'N;',1,1,'2011-06-17 10:29:40','2011-06-17 10:29:40'),
(7,'member','Fulano inactivo','fulano-inactivo',NULL,NULL,'N;',1,0,'2011-06-17 10:34:44','2011-06-17 10:34:44'),
(8,'member','Fulano pasivo','fulano-pasivo',NULL,NULL,'N;',1,0,'2011-06-17 10:56:45','2011-06-17 10:56:45'),
(9,'member','Mengano','mengano',NULL,NULL,'N;',1,0,'2011-06-17 10:57:05','2011-06-17 10:57:05'),
(10,'member','Otro fulano','otro-fulano',NULL,NULL,'N;',1,0,'2011-06-17 10:57:25','2011-06-17 10:57:25'),
(11,'member','Alguien más','alguien-ms','blah',NULL,'N;',1,1,'2011-06-17 10:59:38','2011-06-17 10:59:38'),
(12,'member','Más fulanos','ms-fulanos',NULL,NULL,'N;',1,0,'2011-06-17 11:00:20','2011-06-17 11:00:20'),
(13,'project','Otro proyecto','otro-proyecto','Proyecto de por ahi',NULL,'N;',1,0,'2011-06-17 11:08:55','2011-06-17 11:08:55'),
(14,'article','¿Qué es AQPGLUG?','qu-es-aqpglug','blah blah blah',NULL,'N;',1,1,'2011-06-17 11:55:19','2011-06-17 11:55:19'),
(15,'article','¿Qué es bla bla bla?','qu-es-bla-bla-bla','adasd',NULL,'N;',1,1,'2011-06-17 12:22:54','2011-06-17 12:22:54'),
(16,'article','¿Bla bla bla bla ...........?','bla-blah','A paragraph of <em>text</em>.\r\nA second <strong>row</strong> of text.',NULL,'N;',1,0,'2011-06-17 12:44:48','2011-06-17 12:44:48'),
(17,'project','Proyecto de software libre','proy','algo',NULL,'N;',1,0,'2011-06-17 13:23:27','2011-06-17 13:23:27'),
(18,'event','Reunión Aqpglug','reunion-aqpglug-14','En calle blah nro 314',NULL,'N;',1,0,'2011-06-17 13:52:03','2011-06-17 13:52:03'),
(19,'event','Reunión aqpglug','reunion-aqpglug-15','En calle blah nro 314',NULL,'N;',1,0,'2011-06-17 13:53:52','2011-06-17 13:53:52'),
(20,'event','Flisol 2012','flisol-2012','En el auditorio de blah blah blah',NULL,'N;',1,1,'2011-06-17 13:54:17','2011-06-17 13:54:17'),
(21,'member','Más fulanos','algo','funlano',NULL,'N;',1,1,'2011-06-17 14:07:58','2011-06-17 14:07:58'),
(22,'member','sultano','sultando','asdl',NULL,'N;',1,1,'2011-06-17 14:08:16','2011-06-17 14:08:16'),
(23,'member','Zangano','este-esta-mas-pendejo','asdlasld',NULL,'N;',1,1,'2011-06-17 14:09:15','2011-06-17 14:09:15');
/*!40000 ALTER TABLE `Block` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-06-17 14:10:03
