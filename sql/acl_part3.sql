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
-- Table structure for table `gacl_axo`
--

DROP TABLE IF EXISTS `gacl_axo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_axo` (
  `id` int NOT NULL DEFAULT '0',
  `section_value` varchar(150) NOT NULL DEFAULT '0',
  `value` varchar(150) NOT NULL,
  `order_value` int NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `hidden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gacl_section_value_value_axo` (`section_value`,`value`),
  KEY `gacl_hidden_axo` (`hidden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_axo`
--

LOCK TABLES `gacl_axo` WRITE;
/*!40000 ALTER TABLE `gacl_axo` DISABLE KEYS */;
/*!40000 ALTER TABLE `gacl_axo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_axo_groups`
--

DROP TABLE IF EXISTS `gacl_axo_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_axo_groups` (
  `id` int NOT NULL DEFAULT '0',
  `parent_id` int NOT NULL DEFAULT '0',
  `lft` int NOT NULL DEFAULT '0',
  `rgt` int NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`id`,`value`),
  UNIQUE KEY `gacl_value_axo_groups` (`value`),
  KEY `gacl_parent_id_axo_groups` (`parent_id`),
  KEY `gacl_lft_rgt_axo_groups` (`lft`,`rgt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_axo_groups`
--

LOCK TABLES `gacl_axo_groups` WRITE;
/*!40000 ALTER TABLE `gacl_axo_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `gacl_axo_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_axo_groups_map`
--

DROP TABLE IF EXISTS `gacl_axo_groups_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_axo_groups_map` (
  `acl_id` int NOT NULL DEFAULT '0',
  `group_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`acl_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_axo_groups_map`
--

LOCK TABLES `gacl_axo_groups_map` WRITE;
/*!40000 ALTER TABLE `gacl_axo_groups_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `gacl_axo_groups_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_axo_map`
--

DROP TABLE IF EXISTS `gacl_axo_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_axo_map` (
  `acl_id` int NOT NULL DEFAULT '0',
  `section_value` varchar(150) NOT NULL DEFAULT '0',
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_axo_map`
--

LOCK TABLES `gacl_axo_map` WRITE;
/*!40000 ALTER TABLE `gacl_axo_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `gacl_axo_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_axo_sections`
--

DROP TABLE IF EXISTS `gacl_axo_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_axo_sections` (
  `id` int NOT NULL DEFAULT '0',
  `value` varchar(150) NOT NULL,
  `order_value` int NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL,
  `hidden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gacl_value_axo_sections` (`value`),
  KEY `gacl_hidden_axo_sections` (`hidden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_axo_sections`
--

LOCK TABLES `gacl_axo_sections` WRITE;
/*!40000 ALTER TABLE `gacl_axo_sections` DISABLE KEYS */;
/*!40000 ALTER TABLE `gacl_axo_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_groups_aro_map`
--

DROP TABLE IF EXISTS `gacl_groups_aro_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_groups_aro_map` (
  `group_id` int NOT NULL DEFAULT '0',
  `aro_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`,`aro_id`),
  KEY `gacl_aro_id` (`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_groups_aro_map`
--

LOCK TABLES `gacl_groups_aro_map` WRITE;
/*!40000 ALTER TABLE `gacl_groups_aro_map` DISABLE KEYS */;
INSERT INTO `gacl_groups_aro_map` VALUES (11,10),(11,11),(11,13),(11,29),(12,12),(12,30),(12,32),(12,33),(12,34),(12,35),(12,37),(12,38),(13,12),(13,13),(13,14),(13,15),(13,16),(13,17),(13,18),(13,19),(13,20),(13,21),(13,22),(13,23),(13,24),(13,25),(13,26),(13,27),(13,28),(13,31),(13,35),(13,36),(13,38),(13,39),(13,40),(13,41),(14,12),(14,13),(14,22),(14,28),(14,30),(14,32),(14,33),(14,34),(14,37),(15,13),(15,30),(15,32),(15,33),(15,34),(15,37),(18,13),(18,28);
/*!40000 ALTER TABLE `gacl_groups_aro_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_groups_axo_map`
--

DROP TABLE IF EXISTS `gacl_groups_axo_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_groups_axo_map` (
  `group_id` int NOT NULL DEFAULT '0',
  `axo_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`,`axo_id`),
  KEY `gacl_axo_id` (`axo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_groups_axo_map`
--

LOCK TABLES `gacl_groups_axo_map` WRITE;
/*!40000 ALTER TABLE `gacl_groups_axo_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `gacl_groups_axo_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_phpgacl`
--

DROP TABLE IF EXISTS `gacl_phpgacl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_phpgacl` (
  `name` varchar(230) NOT NULL,
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_phpgacl`
--

LOCK TABLES `gacl_phpgacl` WRITE;
/*!40000 ALTER TABLE `gacl_phpgacl` DISABLE KEYS */;
INSERT INTO `gacl_phpgacl` VALUES ('version','3.3.7'),('schema_version','2.1');
/*!40000 ALTER TABLE `gacl_phpgacl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-29 10:56:55
