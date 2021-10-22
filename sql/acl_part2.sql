-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: mindfulv6
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `gacl_aro`
--

DROP TABLE IF EXISTS `gacl_aro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aro` (
  `id` int NOT NULL DEFAULT '0',
  `section_value` varchar(150) NOT NULL DEFAULT '0',
  `value` varchar(150) NOT NULL,
  `order_value` int NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `hidden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gacl_section_value_value_aro` (`section_value`,`value`),
  KEY `gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aro`
--

LOCK TABLES `gacl_aro` WRITE;
/*!40000 ALTER TABLE `gacl_aro` DISABLE KEYS */;
INSERT INTO `gacl_aro` VALUES (10,'users','Sherwin',10,'Sherwin Gaddis',0),(11,'users','John',10,'John Jalbert',0),(12,'users','testuser1',10,'Ztest Zclinician',0),(13,'users','LJalbert',10,'Laura Jalbert',0),(14,'users','Allen4826',10,'Michelle S Allen',0),(15,'users','Cook3508',10,'Stacie C Cook',0),(16,'users','Greenberger1563',10,'Denise S Greenberger',0),(17,'users','Hartman4015',10,'Keith Hartman',0),(18,'users','Jenkins3275',10,'Jill C Jenkins',0),(19,'users','Lane3023',10,'Lynn Lane',0),(20,'users','Lantzman5569',10,'Irit Lantzman',0),(21,'users','Marder4133',10,'Rebecca Marder',0),(22,'users','McLeod5607',10,'Christina McLeod',0),(23,'users','Moody5449',10,'Andrea Moody',0),(24,'users','Powell5146',10,'Tina Powell',0),(25,'users','Raflo4831',10,'Robin Raflo',0),(26,'users','Shakur5390',10,'Marshalla Shakur',0),(27,'users','Walker4534',10,'Maria R Walker',0),(29,'users','Stephen',10,'Stephen Waite',0),(28,'users','Fisher5607',10,'Christina Fisher',0),(30,'users','KBrown',10,'Keith Brown',0),(31,'users','Sullivan3884',10,'Kristi Sullivan',0),(32,'users','JSanchez',10,'Josue Sanchez',0),(33,'users','SLee',10,'Stewart Lee',0),(34,'users','DRubin',10,'Danny Rubin',0),(35,'users','AMcwilliams',10,'Amy McWilliams',0),(36,'users','Beattie0295',10,'Alisa Beattie',0),(37,'users','shanebell00',10,'Shane Bell',0),(38,'users','Mardis2620',10,'Janie B Mardis',0),(39,'users','Ekmark6012',10,'Stacy S Ekmark',0),(40,'users','Jones0338',10,'Cynthia Jones',0),(41,'users','Kelly5108',10,'Jennifer Kelly',0);
/*!40000 ALTER TABLE `gacl_aro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aro_groups`
--

DROP TABLE IF EXISTS `gacl_aro_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aro_groups` (
  `id` int NOT NULL DEFAULT '0',
  `parent_id` int NOT NULL DEFAULT '0',
  `lft` int NOT NULL DEFAULT '0',
  `rgt` int NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`id`,`value`),
  UNIQUE KEY `gacl_value_aro_groups` (`value`),
  KEY `gacl_parent_id_aro_groups` (`parent_id`),
  KEY `gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aro_groups`
--

LOCK TABLES `gacl_aro_groups` WRITE;
/*!40000 ALTER TABLE `gacl_aro_groups` DISABLE KEYS */;
INSERT INTO `gacl_aro_groups` VALUES (10,0,1,16,'OpenEMR Users','users'),(11,10,2,3,'Administrators','admin'),(12,10,4,5,'Clinicians','clin'),(13,10,6,7,'Physicians','doc'),(14,10,8,9,'Front Office','front'),(15,10,10,11,'Accounting','back'),(16,10,12,13,'Emergency Login','breakglass'),(18,10,14,15,'Credit Card Management','ccof');
/*!40000 ALTER TABLE `gacl_aro_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aro_groups_id_seq`
--

DROP TABLE IF EXISTS `gacl_aro_groups_id_seq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aro_groups_id_seq` (
  `id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aro_groups_id_seq`
--

LOCK TABLES `gacl_aro_groups_id_seq` WRITE;
/*!40000 ALTER TABLE `gacl_aro_groups_id_seq` DISABLE KEYS */;
INSERT INTO `gacl_aro_groups_id_seq` VALUES (18);
/*!40000 ALTER TABLE `gacl_aro_groups_id_seq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aro_groups_map`
--

DROP TABLE IF EXISTS `gacl_aro_groups_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aro_groups_map` (
  `acl_id` int NOT NULL DEFAULT '0',
  `group_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`acl_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aro_groups_map`
--

LOCK TABLES `gacl_aro_groups_map` WRITE;
/*!40000 ALTER TABLE `gacl_aro_groups_map` DISABLE KEYS */;
INSERT INTO `gacl_aro_groups_map` VALUES (10,11),(11,13),(12,13),(13,13),(14,13),(15,12),(16,12),(17,12),(18,12),(19,14),(20,14),(21,14),(22,14),(23,15),(24,15),(25,15),(26,15),(27,16),(28,18);
/*!40000 ALTER TABLE `gacl_aro_groups_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aro_map`
--

DROP TABLE IF EXISTS `gacl_aro_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aro_map` (
  `acl_id` int NOT NULL DEFAULT '0',
  `section_value` varchar(150) NOT NULL DEFAULT '0',
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aro_map`
--

LOCK TABLES `gacl_aro_map` WRITE;
/*!40000 ALTER TABLE `gacl_aro_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `gacl_aro_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aro_sections`
--

DROP TABLE IF EXISTS `gacl_aro_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aro_sections` (
  `id` int NOT NULL DEFAULT '0',
  `value` varchar(150) NOT NULL,
  `order_value` int NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL,
  `hidden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gacl_value_aro_sections` (`value`),
  KEY `gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aro_sections`
--

LOCK TABLES `gacl_aro_sections` WRITE;
/*!40000 ALTER TABLE `gacl_aro_sections` DISABLE KEYS */;
INSERT INTO `gacl_aro_sections` VALUES (10,'users',10,'Users',0);
/*!40000 ALTER TABLE `gacl_aro_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aro_sections_seq`
--

DROP TABLE IF EXISTS `gacl_aro_sections_seq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aro_sections_seq` (
  `id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aro_sections_seq`
--

LOCK TABLES `gacl_aro_sections_seq` WRITE;
/*!40000 ALTER TABLE `gacl_aro_sections_seq` DISABLE KEYS */;
INSERT INTO `gacl_aro_sections_seq` VALUES (10);
/*!40000 ALTER TABLE `gacl_aro_sections_seq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aro_seq`
--

DROP TABLE IF EXISTS `gacl_aro_seq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aro_seq` (
  `id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aro_seq`
--

LOCK TABLES `gacl_aro_seq` WRITE;
/*!40000 ALTER TABLE `gacl_aro_seq` DISABLE KEYS */;
INSERT INTO `gacl_aro_seq` VALUES (41);
/*!40000 ALTER TABLE `gacl_aro_seq` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-29 10:53:48
