-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: ejemplo
-- ------------------------------------------------------
-- Server version	5.7.37

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
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20220407154641','2022-04-07 15:46:49',69),('DoctrineMigrations\\Version20220407164841','2022-04-07 16:48:49',116),('DoctrineMigrations\\Version20220415110953','2022-04-15 11:10:05',159),('DoctrineMigrations\\Version20220420140450','2022-04-20 14:05:05',104),('DoctrineMigrations\\Version20220420141808','2022-04-20 14:18:12',118),('DoctrineMigrations\\Version20220421140000','2022-04-21 14:00:11',524),('DoctrineMigrations\\Version20220421142510','2022-04-21 14:25:14',709),('DoctrineMigrations\\Version20220421175815','2022-04-21 17:58:18',43),('DoctrineMigrations\\Version20220422180107','2022-04-22 18:01:15',115),('DoctrineMigrations\\Version20220513182606','2022-05-13 18:26:16',1106);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'rexinacho@hotmail.es','[]','$2y$13$Hk8Q0u43cy1Dk14m22ktcOMRAknii7E.4FWqvP9jKt/mCQkW6rLV2','Adrian'),(3,'adrian.perez.anguita@hotmail.com','[]','$2y$13$DbirQexOg5iStJvHL6evPe3gzE6KkU7eVGVbpsc0HmIkQbCY4jk1a','Adrian'),(4,'dasdasd@asdadda.com','[]','$2y$13$y078rS3vcfCc69WJ6eKMdeLONtOHKRvK6E.h96B3r/ukI/xQZN.KO','Adrian'),(5,'re','[]','$2y$13$3zT3POfGXdPlaOukVLmG3.eFE17e1ckPhasFAPPAq1rmjR7.sFCla','Adr'),(6,'s','[]','$2y$13$7B6g9CK/NDzwIuKTjRh3wOKoYGSdUwSkT7y1Xk/wVrDwGfVo/0bIe','Adrian'),(7,'rexinacho@asdads','[]','$2y$13$gsmygsaK7q6hw4wSPMj5veQv7C3BmaWznARJt2ceVobQmaT7C0kje','Adrian'),(8,'2113@13123.com','[]','$2y$13$FaDVuWQgfRs2SpAYIAcF2ewW3gv2vuTjSZuB9HpsWj3/wR2BqPnkO','Adrian'),(9,'ejemplo@ejemoplo.com','[]','$2y$13$8S9KKBfWdEDLJExJIFysMOK5MNwWSKagu2bXNl4.FfPtCBMjKCG46','Ejemplo');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiimer`
--

DROP TABLE IF EXISTS `tiimer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiimer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checked` int(11) NOT NULL,
  `unchecked` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_15F39440FE6E88D7` (`idUser`),
  CONSTRAINT `FK_15F39440FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiimer`
--

LOCK TABLES `tiimer` WRITE;
/*!40000 ALTER TABLE `tiimer` DISABLE KEYS */;
INSERT INTO `tiimer` VALUES (43,2,'09:40:15','09:41:15','2022-05-14','adasdf',2,1),(44,2,'09:58:16','09:58:19','2022-05-14','fasdfasdf',0,2),(45,2,'17:30:28','17:30:31','2022-05-14','afsdfasdf',1,2),(46,2,'17:33:05','17:33:15','2022-05-14','adfasdfa',2,2),(47,2,'14:28:52','14:29:52','2022-05-16','asdfasdf',0,0),(48,2,'16:10:05','16:10:07','2022-05-16','fasdfasf',1,2),(49,2,'20:01:56','20:02:27','2022-05-16','fasdfasdf',2,3),(50,2,'16:25:47','16:26:48','2022-05-17','Aplicacion',1,1),(51,2,'14:33:23','14:33:36','2022-05-18','afdsdfasdf',1,2),(52,2,'14:36:32','14:36:34','2022-05-18','afsdfasdf',0,0),(53,2,'14:39:12','14:40:12','2022-05-18','fasdfasdf',0,0),(54,2,'14:23:16','14:23:19','2022-05-19','asdasd',1,1),(55,2,'14:42:18','14:42:21','2022-05-19','ddadffgsfg',2,2),(56,2,'22:13:12','22:13:26','2022-05-20','fasdfasdf',2,4),(57,2,'22:18:16','22:19:16','2022-05-20','sadsd',0,0),(58,2,'22:19:57','22:20:41','2022-05-20','Bacana',1,1),(59,2,'11:55:56','11:57:55','2022-05-23','cvjhc',0,0),(60,2,'12:01:05','12:04:03','2022-05-23','Prueba nuevo dia',2,3),(61,2,'11:46:14','11:49:12','2022-05-24','Prueba nuevo dia',0,1),(62,2,'11:51:31','11:51:33','2022-05-24','dfafd',0,0),(63,2,'12:01:03','12:01:05','2022-05-24','afadf',0,0),(64,2,'14:49:14','14:50:16','2022-05-24','Video',1,2),(65,9,'08:56:34','08:56:36','2022-05-26','fsdfsdf',0,0),(66,9,'08:57:04','08:57:28','2022-05-26','dasdasd',2,3);
/*!40000 ALTER TABLE `tiimer` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping routines for database 'ejemplo'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-28 12:51:59
