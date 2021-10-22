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
-- Table structure for table `gacl_acl`
--

DROP TABLE IF EXISTS `gacl_acl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_acl` (
  `id` int NOT NULL DEFAULT '0',
  `section_value` varchar(150) NOT NULL DEFAULT 'system',
  `allow` int NOT NULL DEFAULT '0',
  `enabled` int NOT NULL DEFAULT '0',
  `return_value` text,
  `note` text,
  `updated_date` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gacl_enabled_acl` (`enabled`),
  KEY `gacl_section_value_acl` (`section_value`),
  KEY `gacl_updated_date_acl` (`updated_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_acl`
--

LOCK TABLES `gacl_acl` WRITE;
/*!40000 ALTER TABLE `gacl_acl` DISABLE KEYS */;
INSERT INTO `gacl_acl` VALUES (10,'system',1,1,'write','Administrators can do anything',1578146252),(11,'system',1,1,'view','Things that physicians can only read',1578146252),(12,'system',1,1,'addonly','Things that physicians can read and enter but not modify',1506688906),(13,'system',1,1,'wsome','Things that physicians can read and partly modify',1506688906),(14,'system',1,1,'write','Things that physicians can read and modify',1506688906),(15,'system',1,1,'view','Things that clinicians can only read',1578146252),(16,'system',1,1,'addonly','Things that clinicians can read and enter but not modify',1506688906),(17,'system',1,1,'wsome','Things that clinicians can read and partly modify',1506688906),(18,'system',1,1,'write','Things that clinicians can read and modify',1506688906),(19,'system',1,1,'view','Things that front office can only read',1578146252),(20,'system',1,1,'addonly','Things that front office can read and enter but not modify',1506688906),(21,'system',1,1,'wsome','Things that front office can read and partly modify',1506688906),(22,'system',1,1,'write','Things that front office can read and modify',1506688906),(23,'system',1,1,'view','Things that back office can only read',1578146252),(24,'system',1,1,'addonly','Things that back office can read and enter but not modify',1506688906),(25,'system',1,1,'wsome','Things that back office can read and partly modify',1506688906),(26,'system',1,1,'write','Things that back office can read and modify',1506688906),(27,'system',1,1,'write','Emergency Login user can do anything',1578146252),(28,'system',1,1,'write','',1551584992);
/*!40000 ALTER TABLE `gacl_acl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_acl_sections`
--

DROP TABLE IF EXISTS `gacl_acl_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_acl_sections` (
  `id` int NOT NULL DEFAULT '0',
  `value` varchar(150) NOT NULL,
  `order_value` int NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL,
  `hidden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gacl_value_acl_sections` (`value`),
  KEY `gacl_hidden_acl_sections` (`hidden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_acl_sections`
--

LOCK TABLES `gacl_acl_sections` WRITE;
/*!40000 ALTER TABLE `gacl_acl_sections` DISABLE KEYS */;
INSERT INTO `gacl_acl_sections` VALUES (1,'system',1,'System',0),(2,'user',2,'User',0);
/*!40000 ALTER TABLE `gacl_acl_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_acl_seq`
--

DROP TABLE IF EXISTS `gacl_acl_seq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_acl_seq` (
  `id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_acl_seq`
--

LOCK TABLES `gacl_acl_seq` WRITE;
/*!40000 ALTER TABLE `gacl_acl_seq` DISABLE KEYS */;
INSERT INTO `gacl_acl_seq` VALUES (28);
/*!40000 ALTER TABLE `gacl_acl_seq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aco`
--

DROP TABLE IF EXISTS `gacl_aco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aco` (
  `id` int NOT NULL DEFAULT '0',
  `section_value` varchar(150) NOT NULL DEFAULT '0',
  `value` varchar(150) NOT NULL,
  `order_value` int NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `hidden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gacl_section_value_value_aco` (`section_value`,`value`),
  KEY `gacl_hidden_aco` (`hidden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aco`
--

LOCK TABLES `gacl_aco` WRITE;
/*!40000 ALTER TABLE `gacl_aco` DISABLE KEYS */;
INSERT INTO `gacl_aco` VALUES (10,'acct','bill',10,'Billing (write optional)',0),(11,'acct','disc',10,'Price Discounting',0),(12,'acct','eob',10,'EOB Data Entry',0),(13,'acct','rep',10,'Financial Reporting - my encounters',0),(14,'acct','rep_a',10,'Financial Reporting - anything',0),(15,'admin','super',10,'Superuser',0),(16,'admin','calendar',10,'Calendar Settings',0),(17,'admin','database',10,'Database Reporting',0),(18,'admin','forms',10,'Forms Administration',0),(19,'admin','practice',10,'Practice Settings',0),(20,'admin','superbill',10,'Superbill Codes Administration',0),(21,'admin','users',10,'Users/Groups/Logs Administration',0),(22,'admin','batchcom',10,'Batch Communication Tool',0),(23,'admin','language',10,'Language Interface Tool',0),(24,'admin','drugs',10,'Pharmacy Dispensary',0),(25,'admin','acl',10,'ACL Administration',0),(26,'admin','multipledb',10,'Multipledb',0),(27,'admin','menu',10,'Menu',0),(28,'encounters','auth',10,'Authorize - my encounters',0),(29,'encounters','auth_a',10,'Authorize - any encounters',0),(30,'encounters','coding',10,'Coding - my encounters (write,wsome optional)',0),(31,'encounters','coding_a',10,'Coding - any encounters (write,wsome optional)',0),(32,'encounters','notes',10,'Notes - my encounters (write,addonly optional)',0),(33,'encounters','notes_a',10,'Notes - any encounters (write,addonly optional)',0),(34,'encounters','date_a',10,'Fix encounter dates - any encounters',0),(35,'encounters','relaxed',10,'Less-private information (write,addonly optional)',0),(36,'lists','default',10,'Default List (write,addonly optional)',0),(37,'lists','state',10,'State List (write,addonly optional)',0),(38,'lists','country',10,'Country List (write,addonly optional)',0),(39,'lists','language',10,'Language List (write,addonly optional)',0),(40,'lists','ethrace',10,'Ethnicity-Race List (write,addonly optional)',0),(41,'patientportal','portal',10,'Patient Portal',0),(42,'menus','modle',10,'Modules',0),(43,'patients','appt',10,'Appointments (write,wsome optional)',0),(44,'patients','demo',10,'Demographics (write,addonly optional)',0),(45,'patients','med',10,'Medical/History (write,addonly optional)',0),(46,'patients','trans',10,'Transactions (write optional)',0),(47,'patients','docs',10,'Documents (write,addonly optional)',0),(48,'patients','notes',10,'Patient Notes (write,addonly optional)',0),(49,'patients','sign',10,'Sign Lab Results (write,addonly optional)',0),(50,'patients','reminder',10,'Patient Reminders (write,addonly optional)',0),(51,'patients','alert',10,'Clinical Reminders/Alerts (write,addonly optional)',0),(52,'patients','disclosure',10,'Disclosures (write,addonly optional)',0),(53,'patients','rx',10,'Prescriptions (write,addonly optional)',0),(54,'patients','amendment',10,'Amendments (write,addonly optional)',0),(55,'patients','lab',10,'Lab Results (write,addonly optional)',0),(56,'groups','gadd',10,'View/Add/Update groups',0),(57,'groups','gcalendar',10,'View/Create/Update groups appointment in calendar',0),(58,'groups','glog',10,'Group encounter log',0),(59,'groups','gdlog',10,'Group detailed log of appointment in patient record',0),(60,'groups','gm',10,'Send message from the permanent group therapist to the personal therapist',0),(61,'sensitivities','normal',10,'Normal',0),(62,'sensitivities','high',20,'High',0),(63,'placeholder','filler',10,'Placeholder (Maintains empty ACLs)',0),(64,'nationnotes','nn_configure',10,'Nation Notes Configure',0),(65,'admin','manage_modules',10,'Manage modules',0),(66,'patients','docs_rm',10,'Documents Delete',0),(67,'ccof','ccof_add',10,'Add Credit Card',0),(68,'patients','pat_rep',10,'Patient Report',0);
/*!40000 ALTER TABLE `gacl_aco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aco_map`
--

DROP TABLE IF EXISTS `gacl_aco_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aco_map` (
  `acl_id` int NOT NULL DEFAULT '0',
  `section_value` varchar(150) NOT NULL DEFAULT '0',
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aco_map`
--

LOCK TABLES `gacl_aco_map` WRITE;
/*!40000 ALTER TABLE `gacl_aco_map` DISABLE KEYS */;
INSERT INTO `gacl_aco_map` VALUES (10,'acct','bill'),(10,'acct','disc'),(10,'acct','eob'),(10,'acct','rep'),(10,'acct','rep_a'),(10,'admin','acl'),(10,'admin','batchcom'),(10,'admin','calendar'),(10,'admin','database'),(10,'admin','drugs'),(10,'admin','forms'),(10,'admin','language'),(10,'admin','manage_modules'),(10,'admin','menu'),(10,'admin','multipledb'),(10,'admin','practice'),(10,'admin','super'),(10,'admin','superbill'),(10,'admin','users'),(10,'encounters','auth'),(10,'encounters','auth_a'),(10,'encounters','coding'),(10,'encounters','coding_a'),(10,'encounters','date_a'),(10,'encounters','notes'),(10,'encounters','notes_a'),(10,'encounters','relaxed'),(10,'groups','gadd'),(10,'groups','gcalendar'),(10,'groups','gdlog'),(10,'groups','glog'),(10,'groups','gm'),(10,'lists','country'),(10,'lists','default'),(10,'lists','ethrace'),(10,'lists','language'),(10,'lists','state'),(10,'menus','modle'),(10,'nationnotes','nn_configure'),(10,'patientportal','portal'),(10,'patients','alert'),(10,'patients','amendment'),(10,'patients','appt'),(10,'patients','demo'),(10,'patients','disclosure'),(10,'patients','docs'),(10,'patients','docs_rm'),(10,'patients','lab'),(10,'patients','med'),(10,'patients','notes'),(10,'patients','pat_rep'),(10,'patients','reminder'),(10,'patients','rx'),(10,'patients','sign'),(10,'patients','trans'),(10,'sensitivities','high'),(10,'sensitivities','normal'),(11,'patients','pat_rep'),(11,'placeholder','filler'),(12,'placeholder','filler'),(13,'placeholder','filler'),(14,'acct','disc'),(14,'acct','rep'),(14,'admin','drugs'),(14,'encounters','auth'),(14,'encounters','auth_a'),(14,'encounters','coding'),(14,'encounters','coding_a'),(14,'encounters','date_a'),(14,'encounters','notes'),(14,'encounters','notes_a'),(14,'encounters','relaxed'),(14,'groups','gcalendar'),(14,'groups','glog'),(14,'patients','alert'),(14,'patients','amendment'),(14,'patients','appt'),(14,'patients','demo'),(14,'patients','disclosure'),(14,'patients','docs'),(14,'patients','lab'),(14,'patients','med'),(14,'patients','notes'),(14,'patients','reminder'),(14,'patients','rx'),(14,'patients','sign'),(14,'patients','trans'),(14,'sensitivities','high'),(14,'sensitivities','normal'),(15,'patients','pat_rep'),(15,'placeholder','filler'),(16,'encounters','notes'),(16,'encounters','relaxed'),(16,'patients','alert'),(16,'patients','amendment'),(16,'patients','demo'),(16,'patients','disclosure'),(16,'patients','docs'),(16,'patients','lab'),(16,'patients','med'),(16,'patients','notes'),(16,'patients','reminder'),(16,'patients','rx'),(16,'patients','trans'),(16,'sensitivities','normal'),(17,'placeholder','filler'),(18,'admin','drugs'),(18,'encounters','coding'),(18,'groups','gcalendar'),(18,'groups','glog'),(18,'patients','appt'),(19,'patients','alert'),(19,'patients','pat_rep'),(20,'placeholder','filler'),(21,'placeholder','filler'),(22,'groups','gcalendar'),(22,'patients','appt'),(22,'patients','demo'),(22,'patients','notes'),(22,'patients','trans'),(23,'patients','alert'),(23,'patients','pat_rep'),(24,'placeholder','filler'),(25,'placeholder','filler'),(26,'acct','bill'),(26,'acct','disc'),(26,'acct','eob'),(26,'acct','rep'),(26,'acct','rep_a'),(26,'admin','practice'),(26,'admin','superbill'),(26,'encounters','auth_a'),(26,'encounters','coding_a'),(26,'encounters','date_a'),(26,'patients','appt'),(26,'patients','demo'),(27,'acct','bill'),(27,'acct','disc'),(27,'acct','eob'),(27,'acct','rep'),(27,'acct','rep_a'),(27,'admin','acl'),(27,'admin','batchcom'),(27,'admin','calendar'),(27,'admin','database'),(27,'admin','drugs'),(27,'admin','forms'),(27,'admin','language'),(27,'admin','manage_modules'),(27,'admin','menu'),(27,'admin','multipledb'),(27,'admin','practice'),(27,'admin','super'),(27,'admin','superbill'),(27,'admin','users'),(27,'encounters','auth'),(27,'encounters','auth_a'),(27,'encounters','coding'),(27,'encounters','coding_a'),(27,'encounters','date_a'),(27,'encounters','notes'),(27,'encounters','notes_a'),(27,'encounters','relaxed'),(27,'groups','gadd'),(27,'groups','gcalendar'),(27,'groups','gdlog'),(27,'groups','glog'),(27,'groups','gm'),(27,'lists','country'),(27,'lists','default'),(27,'lists','ethrace'),(27,'lists','language'),(27,'lists','state'),(27,'menus','modle'),(27,'nationnotes','nn_configure'),(27,'patientportal','portal'),(27,'patients','alert'),(27,'patients','amendment'),(27,'patients','appt'),(27,'patients','demo'),(27,'patients','disclosure'),(27,'patients','docs'),(27,'patients','docs_rm'),(27,'patients','lab'),(27,'patients','med'),(27,'patients','notes'),(27,'patients','pat_rep'),(27,'patients','reminder'),(27,'patients','rx'),(27,'patients','sign'),(27,'patients','trans'),(27,'sensitivities','high'),(27,'sensitivities','normal'),(28,'ccof','ccof_add');
/*!40000 ALTER TABLE `gacl_aco_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aco_sections`
--

DROP TABLE IF EXISTS `gacl_aco_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aco_sections` (
  `id` int NOT NULL DEFAULT '0',
  `value` varchar(150) NOT NULL,
  `order_value` int NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL,
  `hidden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gacl_value_aco_sections` (`value`),
  KEY `gacl_hidden_aco_sections` (`hidden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aco_sections`
--

LOCK TABLES `gacl_aco_sections` WRITE;
/*!40000 ALTER TABLE `gacl_aco_sections` DISABLE KEYS */;
INSERT INTO `gacl_aco_sections` VALUES (10,'acct',10,'Accounting',0),(11,'admin',10,'Administration',0),(12,'encounters',10,'Encounters',0),(13,'lists',10,'Lists',0),(14,'patients',10,'Patients',0),(15,'squads',10,'Squads',0),(16,'sensitivities',10,'Sensitivities',0),(17,'placeholder',10,'Placeholder',0),(18,'nationnotes',10,'Nation Notes',0),(19,'patientportal',10,'Patient Portal',0),(20,'menus',10,'Menus',0),(21,'groups',10,'Groups',0),(22,'ccof',10,'Credit Card Manager',0);
/*!40000 ALTER TABLE `gacl_aco_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aco_sections_seq`
--

DROP TABLE IF EXISTS `gacl_aco_sections_seq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aco_sections_seq` (
  `id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aco_sections_seq`
--

LOCK TABLES `gacl_aco_sections_seq` WRITE;
/*!40000 ALTER TABLE `gacl_aco_sections_seq` DISABLE KEYS */;
INSERT INTO `gacl_aco_sections_seq` VALUES (22);
/*!40000 ALTER TABLE `gacl_aco_sections_seq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gacl_aco_seq`
--

DROP TABLE IF EXISTS `gacl_aco_seq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gacl_aco_seq` (
  `id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gacl_aco_seq`
--

LOCK TABLES `gacl_aco_seq` WRITE;
/*!40000 ALTER TABLE `gacl_aco_seq` DISABLE KEYS */;
INSERT INTO `gacl_aco_seq` VALUES (68);
/*!40000 ALTER TABLE `gacl_aco_seq` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-29 10:48:22
