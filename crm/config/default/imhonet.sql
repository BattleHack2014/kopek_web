-- MySQL dump 10.13  Distrib 5.5.29, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: imhonet
-- ------------------------------------------------------
-- Server version	5.5.29-0ubuntu0.12.04.2

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
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `resources` varchar(255) NOT NULL,
  `remember_hash` varchar(255) DEFAULT NULL,
  `project` varchar(255) NOT NULL,
  `current_promo_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user`
--

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` VALUES (23,'admin@gmail.com','21232f297a57a5a743894a0e4a801fc3','[\"Administration\",\"Sections\",\"Statistic\"]','638fa8992c08a137d118c4559940dd4e','cinema',1),(38,'user@imho.net','ee11cbb19052e40b07aac0ca060c23ee','[\"Sections\",\"Statistic\"]',NULL,'cinema',NULL),(40,'admin@imho.net','21232f297a57a5a743894a0e4a801fc3','[\"Administration\",\"Sections\",\"Statistic\"]',NULL,'cinema',NULL),(41,'user@gmail.com','ee11cbb19052e40b07aac0ca060c23ee','[\"Sections\",\"Statistic\"]','c0aebcfcf7ed02c1b4b51e7092966082','cinema',2);
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,'Чувак',0),(2,'Честер Аллан Артур',0),(3,'Джон До',0),(4,'Джон Смит',0),(5,'Джордж Вашингтон',0),(6,'Томас Джефферсон',0);
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `author` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL DEFAULT 'comment',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,'Neo','01-01-2013','The Fight for the Future Begins'),(2,0,'Artificial intelligence','02-12-2011','Reality is a thing of the past'),(3,0,'Artificial intelligence','14-04-2012','Believe the unbelievable'),(4,0,'Artificial intelligence','22-10-2012','Reality is a thing of the past'),(5,0,'Agent Smith','24-05-2011','Reality is a thing of the past'),(6,0,'Morpheus','06-06-2013','What is The Matrix?'),(7,0,'Artificial intelligence','17-09-2011','Reality is a thing of the past'),(8,0,'Agent Smith','06-04-2012','Free your mind'),(9,0,'Morpheus','10-11-2010','Reality is a thing of the past'),(10,0,'Trinity','06-09-2012','Free your mind'),(11,0,'Artificial intelligence','25-11-2010','The Fight for the Future Begins'),(12,0,'Agent Smith','08-12-2012','Believe the unbelievable'),(13,0,'Morpheus','20-12-2011','Free your mind'),(14,0,'Agent Smith','14-09-2010','Believe the unbelievable'),(15,0,'Trinity','27-02-2013','The Fight for the Future Begins'),(16,0,'Trinity','19-04-2011','Believe the unbelievable'),(17,0,'Agent Smith','20-06-2013','Believe the unbelievable'),(18,0,'Morpheus','05-05-2010','Free your mind'),(19,0,'Morpheus','04-09-2012','Reality is a thing of the past'),(20,0,'Neo','03-12-2012','Free your mind'),(21,0,'Neo','14-04-2012','The Fight for the Future Begins'),(22,0,'Artificial intelligence','14-08-2012','What is The Matrix?'),(23,0,'Artificial intelligence','04-10-2012','Believe the unbelievable'),(24,0,'Artificial intelligence','23-08-2010','What is The Matrix?'),(25,0,'Agent Smith','23-10-2010','Reality is a thing of the past'),(26,0,'Agent Smith','04-02-2013','The Fight for the Future Begins'),(27,0,'Agent Smith','28-03-2011','Free your mind'),(28,0,'Agent Smith','13-01-2010','Reality is a thing of the past'),(29,0,'Trinity','04-04-2013','Reality is a thing of the past'),(30,0,'Neo','18-10-2012','Reality is a thing of the past'),(31,0,'Morpheus','02-06-2011','Reality is a thing of the past'),(32,0,'Artificial intelligence','19-03-2011','What is The Matrix?'),(33,0,'Morpheus','01-02-2011','Reality is a thing of the past'),(34,0,'Agent Smith','05-12-2010','The Fight for the Future Begins'),(35,0,'Artificial intelligence','19-02-2011','The Fight for the Future Begins'),(36,0,'Morpheus','20-06-2012','The Fight for the Future Begins'),(37,0,'Artificial intelligence','25-02-2012','What is The Matrix?'),(38,0,'Agent Smith','25-02-2012','Reality is a thing of the past'),(39,0,'Agent Smith','18-01-2010','Free your mind'),(40,0,'Agent Smith','10-04-2010','The Fight for the Future Begins'),(41,0,'Artificial intelligence','24-07-2011','The Fight for the Future Begins'),(42,0,'Trinity','12-01-2012','What is The Matrix?'),(43,0,'Trinity','13-04-2013','The Fight for the Future Begins'),(44,0,'Trinity','17-03-2010','What is The Matrix?'),(45,0,'Morpheus','10-07-2013','Reality is a thing of the past'),(46,0,'Agent Smith','04-08-2011','Believe the unbelievable'),(47,0,'Trinity','16-03-2013','The Fight for the Future Begins'),(48,0,'Trinity','19-05-2012','What is The Matrix?'),(49,0,'Trinity','22-02-2013','Free your mind'),(50,0,'Trinity','12-01-2010','What is The Matrix?'),(51,0,'Agent Smith','20-04-2011','The Fight for the Future Begins'),(52,0,'Trinity','12-06-2011','Free your mind'),(53,0,'Artificial intelligence','29-12-2010','What is The Matrix?'),(54,0,'Agent Smith','10-01-2012','Free your mind'),(55,0,'Artificial intelligence','13-11-2010','Believe the unbelievable'),(56,0,'Artificial intelligence','27-02-2011','Free your mind'),(57,0,'Artificial intelligence','08-02-2013','Free your mind'),(58,0,'Neo','16-02-2013','What is The Matrix?'),(59,0,'Trinity','23-05-2013','What is The Matrix?'),(60,0,'Trinity','15-06-2013','Reality is a thing of the past'),(61,0,'Morpheus','05-10-2012','What is The Matrix?'),(62,0,'Trinity','22-09-2010','Free your mind'),(63,0,'Morpheus','28-03-2011','What is The Matrix?'),(64,0,'Agent Smith','28-02-2011','What is The Matrix?'),(65,0,'Agent Smith','10-05-2012','What is The Matrix?'),(66,0,'Morpheus','20-04-2011','Reality is a thing of the past'),(67,0,'Trinity','05-03-2013','What is The Matrix?'),(68,0,'Trinity','01-07-2013','Reality is a thing of the past'),(69,0,'Morpheus','14-06-2012','Free your mind'),(70,0,'Artificial intelligence','29-03-2012','Reality is a thing of the past'),(71,0,'Artificial intelligence','30-07-2011','Reality is a thing of the past'),(72,0,'Trinity','18-04-2013','Believe the unbelievable'),(73,0,'Agent Smith','21-10-2011','Believe the unbelievable'),(74,0,'Trinity','29-09-2012','Believe the unbelievable'),(75,0,'Agent Smith','25-07-2011','The Fight for the Future Begins'),(76,0,'Morpheus','27-06-2012','Believe the unbelievable'),(77,0,'Agent Smith','23-12-2010','What is The Matrix?'),(78,0,'Agent Smith','14-03-2010','The Fight for the Future Begins'),(79,0,'Agent Smith','18-10-2012','Believe the unbelievable'),(80,0,'Morpheus','11-03-2011','Believe the unbelievable'),(81,0,'Agent Smith','13-05-2012','Free your mind'),(82,0,'Agent Smith','02-02-2011','What is The Matrix?'),(83,0,'Morpheus','10-02-2013','Free your mind'),(84,0,'Agent Smith','03-05-2011','The Fight for the Future Begins'),(85,0,'Neo','21-11-2012','Believe the unbelievable'),(86,0,'Morpheus','18-10-2012','What is The Matrix?'),(87,0,'Morpheus','02-03-2012','Believe the unbelievable'),(88,0,'Agent Smith','15-01-2013','Believe the unbelievable'),(89,0,'Morpheus','21-04-2011','What is The Matrix?'),(90,0,'Trinity','19-11-2010','Reality is a thing of the past'),(91,0,'Artificial intelligence','12-06-2011','Free your mind'),(92,0,'Neo','14-12-2010','Believe the unbelievable'),(93,0,'Morpheus','24-10-2011','Believe the unbelievable'),(94,0,'Artificial intelligence','06-01-2010','The Fight for the Future Begins'),(95,0,'Agent Smith','07-08-2010','Believe the unbelievable'),(96,0,'Trinity','21-06-2012','Free your mind'),(97,0,'Agent Smith','03-03-2013','Reality is a thing of the past'),(98,0,'Artificial intelligence','15-01-2013','The Fight for the Future Begins'),(99,0,'Morpheus','11-02-2011','What is The Matrix?'),(100,0,'Agent Smith','31-03-2012','Believe the unbelievable'),(101,0,'Morpheus','20-04-2012','Free your mind'),(102,0,'Artificial intelligence','19-01-2010','Believe the unbelievable'),(103,0,'Morpheus','24-08-2012','Believe the unbelievable'),(104,0,'Morpheus','24-05-2010','Believe the unbelievable'),(105,0,'Artificial intelligence','06-08-2011','The Fight for the Future Begins'),(106,0,'Neo','09-03-2011','The Fight for the Future Begins'),(107,0,'Neo','12-01-2013','Free your mind'),(108,0,'Artificial intelligence','28-06-2012','Reality is a thing of the past'),(109,0,'Morpheus','16-08-2011','What is The Matrix?'),(110,0,'Trinity','05-03-2010','Free your mind'),(111,0,'Morpheus','07-12-2011','Reality is a thing of the past'),(112,0,'Neo','13-05-2011','The Fight for the Future Begins'),(113,0,'Morpheus','17-02-2011','Free your mind'),(114,0,'Agent Smith','06-07-2013','Free your mind'),(115,0,'Trinity','28-10-2010','What is The Matrix?'),(116,0,'Agent Smith','04-08-2012','Free your mind'),(117,0,'Agent Smith','08-09-2010','Believe the unbelievable'),(118,0,'Agent Smith','17-04-2011','Believe the unbelievable'),(119,0,'Neo','04-01-2013','What is The Matrix?'),(120,0,'Morpheus','24-08-2012','Believe the unbelievable'),(121,0,'Morpheus','07-09-2012','Free your mind'),(122,0,'Agent Smith','02-01-2010','What is The Matrix?'),(123,0,'Trinity','07-09-2012','Reality is a thing of the past'),(124,0,'Agent Smith','17-06-2013','What is The Matrix?'),(125,0,'Agent Smith','29-05-2010','Believe the unbelievable'),(126,0,'Neo','03-09-2010','What is The Matrix?'),(127,0,'Trinity','24-02-2013','Believe the unbelievable'),(128,0,'Neo','05-07-2011','What is The Matrix?'),(129,0,'Artificial intelligence','13-07-2013','Reality is a thing of the past'),(130,0,'Morpheus','03-07-2012','The Fight for the Future Begins'),(131,0,'Trinity','29-03-2012','What is The Matrix?'),(132,0,'Agent Smith','13-05-2012','Believe the unbelievable'),(133,0,'Agent Smith','10-09-2011','Free your mind'),(134,0,'Agent Smith','15-11-2012','What is The Matrix?'),(135,0,'Morpheus','06-04-2013','The Fight for the Future Begins'),(136,0,'Artificial intelligence','03-07-2012','Free your mind'),(137,0,'Trinity','06-12-2010','What is The Matrix?'),(138,0,'Artificial intelligence','27-12-2010','The Fight for the Future Begins'),(139,0,'Artificial intelligence','27-05-2010','Believe the unbelievable'),(140,0,'Morpheus','21-03-2010','Reality is a thing of the past'),(141,0,'Trinity','24-10-2011','What is The Matrix?'),(142,0,'Neo','08-07-2011','The Fight for the Future Begins'),(143,0,'Morpheus','12-08-2010','Believe the unbelievable'),(144,0,'Agent Smith','26-11-2012','The Fight for the Future Begins'),(145,0,'Morpheus','30-01-2013','Believe the unbelievable'),(146,0,'Trinity','05-01-2010','What is The Matrix?'),(147,0,'Artificial intelligence','22-09-2011','Free your mind'),(148,0,'Agent Smith','28-07-2011','Free your mind'),(149,0,'Agent Smith','03-09-2011','What is The Matrix?'),(150,0,'Neo','25-02-2011','Reality is a thing of the past'),(151,0,'Neo','26-05-2013','The Fight for the Future Begins'),(152,0,'Artificial intelligence','13-08-2013','Reality is a thing of the past'),(153,0,'Trinity','12-08-2013','The Fight for the Future Begins'),(154,0,'Agent Smith','29-06-2010','Free your mind'),(155,0,'Trinity','21-06-2013','Reality is a thing of the past'),(156,0,'Neo','18-01-2010','Believe the unbelievable'),(157,0,'Agent Smith','10-03-2012','What is The Matrix?'),(158,0,'Neo','12-09-2012','Reality is a thing of the past'),(159,0,'Agent Smith','09-08-2011','What is The Matrix?'),(160,0,'Agent Smith','29-11-2011','Believe the unbelievable'),(161,0,'Trinity','07-06-2013','Free your mind'),(162,0,'Trinity','02-05-2013','What is The Matrix?'),(163,0,'Morpheus','30-11-2012','What is The Matrix?'),(164,0,'Agent Smith','16-03-2010','Free your mind'),(165,0,'Morpheus','18-08-2010','Believe the unbelievable'),(166,0,'Trinity','02-06-2013','Believe the unbelievable'),(167,0,'Trinity','03-06-2013','The Fight for the Future Begins'),(168,0,'Morpheus','03-05-2012','Believe the unbelievable'),(169,0,'Trinity','14-06-2013','Believe the unbelievable'),(170,0,'Morpheus','28-02-2012','Reality is a thing of the past'),(171,0,'Neo','17-12-2010','Reality is a thing of the past'),(172,0,'Agent Smith','14-12-2012','Believe the unbelievable'),(173,0,'Neo','18-07-2011','Reality is a thing of the past'),(174,0,'Trinity','31-07-2010','What is The Matrix?'),(175,0,'Agent Smith','24-06-2012','The Fight for the Future Begins'),(176,0,'Neo','02-03-2012','Reality is a thing of the past'),(177,0,'Trinity','09-12-2010','Reality is a thing of the past'),(178,0,'Morpheus','12-07-2011','Believe the unbelievable'),(179,0,'Agent Smith','02-03-2012','The Fight for the Future Begins'),(180,0,'Trinity','01-12-2011','Reality is a thing of the past'),(181,0,'Neo','15-03-2012','Reality is a thing of the past'),(182,0,'Morpheus','19-05-2012','The Fight for the Future Begins'),(183,0,'Agent Smith','01-05-2013','Believe the unbelievable'),(184,0,'Morpheus','23-04-2012','The Fight for the Future Begins'),(185,0,'Morpheus','11-06-2010','Reality is a thing of the past'),(186,0,'Agent Smith','06-05-2012','Free your mind'),(187,0,'Artificial intelligence','27-02-2010','What is The Matrix?'),(188,0,'Morpheus','24-08-2011','Reality is a thing of the past'),(189,0,'Artificial intelligence','08-07-2013','Reality is a thing of the past'),(190,0,'Neo','12-06-2012','What is The Matrix?'),(191,0,'Morpheus','30-03-2013','Reality is a thing of the past'),(192,0,'Neo','13-01-2010','The Fight for the Future Begins'),(193,0,'Trinity','18-11-2012','What is The Matrix?'),(194,0,'Agent Smith','19-11-2011','The Fight for the Future Begins'),(195,0,'Neo','17-02-2013','The Fight for the Future Begins'),(196,0,'Morpheus','21-01-2013','What is The Matrix?'),(197,0,'Morpheus','02-10-2012','What is The Matrix?'),(198,0,'Morpheus','08-09-2011','Reality is a thing of the past'),(199,0,'Morpheus','15-02-2013','The Fight for the Future Begins'),(200,0,'Agent Smith','15-07-2013','Believe the unbelievable'),(201,0,'Agent Smith','16-11-2011','Believe the unbelievable'),(202,0,'Agent Smith','20-01-2011','Free your mind'),(203,0,'Agent Smith','24-01-2011','Believe the unbelievable'),(204,0,'Artificial intelligence','31-05-2013','What is The Matrix?'),(205,0,'Artificial intelligence','27-10-2010','Free your mind'),(206,0,'Artificial intelligence','04-01-2011','What is The Matrix?'),(207,0,'Trinity','01-04-2010','Reality is a thing of the past'),(208,0,'Trinity','18-10-2012','Free your mind'),(209,0,'Morpheus','24-12-2011','Free your mind'),(210,0,'Artificial intelligence','05-10-2010','The Fight for the Future Begins'),(211,0,'Artificial intelligence','28-02-2012','Reality is a thing of the past'),(212,0,'Morpheus','17-08-2013','Reality is a thing of the past'),(213,0,'Artificial intelligence','11-04-2012','Free your mind'),(214,0,'Trinity','02-05-2011','Reality is a thing of the past'),(215,0,'Trinity','22-10-2012','The Fight for the Future Begins'),(216,0,'Agent Smith','15-05-2012','Reality is a thing of the past'),(217,0,'Morpheus','18-06-2010','Reality is a thing of the past'),(218,0,'Trinity','03-12-2011','The Fight for the Future Begins'),(219,0,'Agent Smith','13-01-2010','Reality is a thing of the past'),(220,0,'Trinity','19-12-2010','The Fight for the Future Begins'),(221,0,'Trinity','29-09-2010','Free your mind'),(222,0,'Artificial intelligence','24-07-2013','The Fight for the Future Begins'),(223,0,'Morpheus','14-10-2010','Free your mind'),(224,0,'Morpheus','03-03-2013','Free your mind'),(225,0,'Artificial intelligence','16-11-2011','The Fight for the Future Begins'),(226,0,'Artificial intelligence','21-10-2011','Reality is a thing of the past'),(227,0,'Trinity','22-11-2012','Free your mind'),(228,0,'Neo','18-08-2013','What is The Matrix?'),(229,0,'Agent Smith','11-10-2010','The Fight for the Future Begins'),(230,0,'Agent Smith','27-04-2011','Reality is a thing of the past'),(231,0,'Morpheus','17-05-2012','Free your mind'),(232,0,'Artificial intelligence','16-06-2012','The Fight for the Future Begins'),(233,0,'Trinity','27-06-2013','Believe the unbelievable'),(234,0,'Neo','25-04-2011','Free your mind'),(235,0,'Agent Smith','17-09-2010','The Fight for the Future Begins'),(236,0,'Neo','06-08-2011','What is The Matrix?'),(237,0,'Morpheus','15-04-2013','What is The Matrix?'),(238,0,'Neo','22-10-2012','Believe the unbelievable'),(239,0,'Agent Smith','17-03-2011','Reality is a thing of the past'),(240,0,'Agent Smith','24-02-2011','The Fight for the Future Begins'),(241,0,'Morpheus','26-07-2012','Reality is a thing of the past'),(242,0,'Trinity','13-05-2011','Free your mind'),(243,0,'Morpheus','10-09-2011','What is The Matrix?'),(244,0,'Artificial intelligence','22-01-2013','What is The Matrix?'),(245,0,'Artificial intelligence','24-11-2011','What is The Matrix?'),(246,0,'Morpheus','25-08-2011','Free your mind'),(247,0,'Agent Smith','30-10-2011','What is The Matrix?'),(248,0,'Agent Smith','26-02-2010','Free your mind'),(249,0,'Agent Smith','09-01-2010','The Fight for the Future Begins'),(250,0,'Morpheus','12-11-2012','Free your mind'),(251,0,'Artificial intelligence','05-02-2013','The Fight for the Future Begins'),(252,0,'Trinity','27-08-2011','What is The Matrix?'),(253,0,'Morpheus','28-02-2011','What is The Matrix?'),(254,0,'Agent Smith','24-05-2012','The Fight for the Future Begins'),(255,0,'Agent Smith','07-07-2011','What is The Matrix?'),(256,0,'Trinity','20-05-2010','The Fight for the Future Begins'),(257,0,'Agent Smith','31-05-2010','What is The Matrix?'),(258,0,'Agent Smith','01-02-2013','Free your mind'),(259,0,'Morpheus','13-03-2012','Reality is a thing of the past'),(260,0,'Trinity','04-12-2011','Free your mind'),(261,0,'Trinity','29-12-2011','What is The Matrix?'),(262,0,'Neo','26-04-2012','What is The Matrix?'),(263,0,'Agent Smith','03-03-2011','Believe the unbelievable'),(264,0,'Neo','30-09-2012','Free your mind'),(265,0,'Agent Smith','01-01-2011','What is The Matrix?'),(266,0,'Neo','09-12-2012','Reality is a thing of the past'),(267,0,'Neo','19-07-2013','Reality is a thing of the past'),(268,0,'Neo','22-02-2011','Free your mind'),(269,0,'Artificial intelligence','27-08-2011','Free your mind'),(270,0,'Morpheus','29-04-2012','Reality is a thing of the past'),(271,0,'Neo','16-09-2011','Reality is a thing of the past'),(272,0,'Agent Smith','14-11-2010','What is The Matrix?'),(273,0,'Agent Smith','12-09-2012','What is The Matrix?'),(274,0,'Agent Smith','01-05-2013','The Fight for the Future Begins'),(275,0,'Morpheus','09-10-2010','Reality is a thing of the past'),(276,0,'Morpheus','21-03-2010','Free your mind'),(277,0,'Trinity','23-01-2011','Free your mind'),(278,0,'Morpheus','01-05-2013','Free your mind'),(279,0,'Morpheus','25-05-2010','Believe the unbelievable'),(280,0,'Artificial intelligence','12-12-2012','Free your mind'),(281,0,'Trinity','10-10-2012','Free your mind'),(282,0,'Artificial intelligence','13-07-2011','Free your mind'),(283,0,'Morpheus','24-01-2012','Believe the unbelievable'),(284,0,'Trinity','23-01-2010','The Fight for the Future Begins'),(285,0,'Agent Smith','14-02-2011','Free your mind'),(286,0,'Neo','07-08-2012','What is The Matrix?'),(287,0,'Morpheus','15-10-2011','Free your mind'),(288,0,'Trinity','10-08-2012','Believe the unbelievable'),(289,0,'Agent Smith','20-02-2012','Believe the unbelievable'),(290,0,'Trinity','04-02-2012','Believe the unbelievable'),(291,0,'Trinity','19-01-2011','Believe the unbelievable'),(292,0,'Artificial intelligence','03-08-2011','Believe the unbelievable'),(293,0,'Agent Smith','30-09-2012','Free your mind'),(294,0,'Trinity','16-01-2011','Reality is a thing of the past'),(295,0,'Trinity','24-02-2013','Reality is a thing of the past'),(296,0,'Neo','04-10-2010','The Fight for the Future Begins'),(297,0,'Neo','14-09-2011','Reality is a thing of the past'),(298,0,'Neo','15-04-2012','Free your mind'),(299,0,'Agent Smith','14-04-2012','What is The Matrix?'),(300,0,'Artificial intelligence','22-01-2012','Free your mind'),(301,0,'Artificial intelligence','17-03-2013','Reality is a thing of the past'),(302,0,'Morpheus','19-03-2013','What is The Matrix?'),(303,0,'Neo','03-10-2011','The Fight for the Future Begins'),(304,0,'Agent Smith','15-12-2011','The Fight for the Future Begins'),(305,0,'Agent Smith','17-05-2012','Believe the unbelievable'),(306,0,'Neo','08-01-2013','Believe the unbelievable'),(307,0,'Agent Smith','14-01-2013','Reality is a thing of the past'),(308,0,'Trinity','21-05-2012','Free your mind'),(309,0,'Morpheus','31-05-2013','The Fight for the Future Begins'),(310,0,'Artificial intelligence','26-09-2012','Reality is a thing of the past'),(311,0,'Morpheus','24-02-2012','Believe the unbelievable'),(312,0,'Agent Smith','19-06-2013','Reality is a thing of the past'),(313,0,'Trinity','05-06-2011','What is The Matrix?'),(314,0,'Morpheus','25-07-2011','Reality is a thing of the past'),(315,0,'Morpheus','28-07-2010','Reality is a thing of the past'),(316,0,'Morpheus','25-06-2013','The Fight for the Future Begins'),(317,0,'Morpheus','17-08-2010','The Fight for the Future Begins'),(318,0,'Agent Smith','11-07-2010','Reality is a thing of the past'),(319,0,'Morpheus','10-08-2011','The Fight for the Future Begins'),(320,0,'Trinity','21-07-2012','Believe the unbelievable'),(321,0,'Morpheus','29-05-2013','Believe the unbelievable'),(322,0,'Morpheus','20-06-2012','The Fight for the Future Begins'),(323,0,'Artificial intelligence','01-02-2013','Free your mind'),(324,0,'Neo','12-08-2012','Believe the unbelievable'),(325,0,'Morpheus','19-01-2013','The Fight for the Future Begins'),(326,0,'Agent Smith','17-02-2011','Reality is a thing of the past'),(327,0,'Agent Smith','13-01-2011','Free your mind'),(328,0,'Artificial intelligence','19-02-2010','Believe the unbelievable'),(329,0,'Artificial intelligence','12-12-2011','Believe the unbelievable'),(330,0,'Neo','01-01-2013','The Fight for the Future Begins'),(331,0,'Artificial intelligence','26-07-2010','What is The Matrix?'),(332,0,'Agent Smith','11-09-2010','The Fight for the Future Begins'),(333,0,'Morpheus','31-08-2010','Reality is a thing of the past'),(334,0,'Neo','28-10-2011','Free your mind'),(335,0,'Morpheus','06-05-2011','Free your mind'),(336,0,'Trinity','06-10-2010','Reality is a thing of the past'),(337,0,'Agent Smith','06-08-2011','Believe the unbelievable'),(338,0,'Neo','08-06-2010','Believe the unbelievable'),(339,0,'Morpheus','16-03-2011','Free your mind'),(340,0,'Agent Smith','10-04-2012','Reality is a thing of the past'),(341,0,'Trinity','01-09-2011','Reality is a thing of the past'),(342,0,'Trinity','05-07-2013','The Fight for the Future Begins'),(343,0,'Agent Smith','13-06-2013','Believe the unbelievable'),(344,0,'Trinity','14-09-2011','The Fight for the Future Begins'),(345,0,'Neo','07-04-2013','The Fight for the Future Begins'),(346,0,'Agent Smith','17-12-2012','The Fight for the Future Begins'),(347,0,'Trinity','08-04-2012','Believe the unbelievable'),(348,0,'Artificial intelligence','24-12-2010','What is The Matrix?'),(349,0,'Trinity','27-04-2013','The Fight for the Future Begins'),(350,0,'Artificial intelligence','17-06-2013','Reality is a thing of the past'),(351,0,'Artificial intelligence','20-12-2010','Reality is a thing of the past'),(352,0,'Morpheus','23-03-2010','The Fight for the Future Begins'),(353,0,'Neo','31-07-2010','Believe the unbelievable'),(354,0,'Agent Smith','25-07-2010','Believe the unbelievable'),(355,0,'Agent Smith','11-01-2011','The Fight for the Future Begins'),(356,0,'Morpheus','14-05-2011','Reality is a thing of the past'),(357,0,'Morpheus','24-11-2012','The Fight for the Future Begins'),(358,0,'Agent Smith','02-08-2012','Believe the unbelievable'),(359,0,'Neo','08-02-2012','The Fight for the Future Begins'),(360,0,'Agent Smith','17-11-2010','What is The Matrix?'),(361,0,'Neo','27-09-2011','Reality is a thing of the past'),(362,0,'Artificial intelligence','10-06-2011','What is The Matrix?'),(363,0,'Morpheus','14-01-2012','Reality is a thing of the past'),(364,0,'Morpheus','12-09-2010','Believe the unbelievable'),(365,0,'Neo','23-04-2011','What is The Matrix?'),(366,0,'Artificial intelligence','18-10-2011','Believe the unbelievable'),(367,0,'Artificial intelligence','25-06-2010','What is The Matrix?'),(368,0,'Morpheus','08-12-2010','Free your mind'),(369,0,'Morpheus','12-05-2010','Believe the unbelievable'),(370,0,'Neo','09-11-2012','Free your mind'),(371,0,'Morpheus','23-07-2012','What is The Matrix?'),(372,0,'Artificial intelligence','13-07-2013','Free your mind'),(373,0,'Neo','08-02-2013','Reality is a thing of the past'),(374,0,'Neo','02-01-2012','Reality is a thing of the past'),(375,0,'Morpheus','25-08-2010','What is The Matrix?'),(376,0,'Morpheus','23-04-2011','The Fight for the Future Begins'),(377,0,'Neo','03-01-2011','What is The Matrix?'),(378,0,'Artificial intelligence','31-01-2012','Reality is a thing of the past'),(379,0,'Neo','06-07-2013','The Fight for the Future Begins'),(380,0,'Trinity','28-06-2013','Reality is a thing of the past'),(381,0,'Artificial intelligence','01-12-2011','The Fight for the Future Begins'),(382,0,'Neo','23-06-2010','Believe the unbelievable'),(383,0,'Agent Smith','09-07-2013','Reality is a thing of the past'),(384,0,'Artificial intelligence','25-11-2012','Believe the unbelievable'),(385,0,'Trinity','09-12-2010','Believe the unbelievable'),(386,0,'Neo','10-01-2010','Believe the unbelievable'),(387,0,'Neo','27-02-2012','The Fight for the Future Begins'),(388,0,'Morpheus','26-06-2011','The Fight for the Future Begins'),(389,0,'Trinity','16-04-2012','The Fight for the Future Begins'),(390,0,'Trinity','06-10-2011','What is The Matrix?'),(391,0,'Neo','20-09-2012','What is The Matrix?'),(392,0,'Morpheus','27-12-2012','Free your mind'),(393,0,'Agent Smith','27-01-2011','What is The Matrix?'),(394,0,'Trinity','31-03-2011','Reality is a thing of the past'),(395,0,'Neo','18-01-2013','Free your mind'),(396,0,'Agent Smith','26-01-2012','Believe the unbelievable'),(397,0,'Neo','01-07-2011','Reality is a thing of the past'),(398,0,'Trinity','20-02-2013','Believe the unbelievable'),(399,0,'Artificial intelligence','20-10-2012','Free your mind'),(400,0,'Artificial intelligence','23-06-2012','Believe the unbelievable'),(401,0,'Morpheus','25-04-2012','What is The Matrix?'),(402,0,'Artificial intelligence','01-01-2013','Believe the unbelievable'),(403,0,'Agent Smith','17-06-2013','Free your mind'),(404,0,'Artificial intelligence','05-07-2012','The Fight for the Future Begins'),(405,0,'Neo','13-06-2010','Reality is a thing of the past'),(406,0,'Morpheus','12-11-2011','Believe the unbelievable'),(407,0,'Trinity','14-01-2011','The Fight for the Future Begins'),(408,0,'Artificial intelligence','12-04-2012','Believe the unbelievable'),(409,0,'Morpheus','08-12-2011','Believe the unbelievable'),(410,0,'Artificial intelligence','27-07-2012','Free your mind'),(411,0,'Morpheus','27-08-2010','The Fight for the Future Begins'),(412,0,'Artificial intelligence','28-01-2010','What is The Matrix?'),(413,0,'Agent Smith','20-01-2010','The Fight for the Future Begins'),(414,0,'Morpheus','01-07-2012','Believe the unbelievable'),(415,0,'Artificial intelligence','22-12-2011','Reality is a thing of the past'),(416,0,'Morpheus','21-04-2013','Free your mind'),(417,0,'Neo','04-11-2010','Reality is a thing of the past'),(418,0,'Trinity','09-11-2010','The Fight for the Future Begins'),(419,0,'Agent Smith','30-10-2012','Free your mind'),(420,0,'Morpheus','19-12-2012','What is The Matrix?'),(421,0,'Neo','24-03-2011','Free your mind'),(422,0,'Morpheus','22-04-2012','Believe the unbelievable'),(423,0,'Morpheus','18-11-2012','What is The Matrix?'),(424,0,'Artificial intelligence','27-10-2012','What is The Matrix?'),(425,0,'Agent Smith','05-08-2013','Believe the unbelievable'),(426,0,'Neo','31-05-2012','Believe the unbelievable'),(427,0,'Morpheus','11-08-2013','What is The Matrix?'),(428,0,'Neo','28-02-2011','Free your mind'),(429,0,'Agent Smith','26-03-2011','The Fight for the Future Begins'),(430,0,'Neo','15-03-2012','Reality is a thing of the past'),(431,0,'Morpheus','11-01-2011','Reality is a thing of the past'),(432,0,'Morpheus','28-09-2011','The Fight for the Future Begins'),(433,0,'Agent Smith','03-03-2010','The Fight for the Future Begins'),(434,0,'Agent Smith','15-11-2010','Believe the unbelievable'),(435,0,'Trinity','06-04-2010','Reality is a thing of the past'),(436,0,'Agent Smith','08-11-2012','What is The Matrix?'),(437,0,'Trinity','24-12-2010','The Fight for the Future Begins'),(438,0,'Trinity','03-02-2013','What is The Matrix?'),(439,0,'Artificial intelligence','20-12-2010','Believe the unbelievable'),(440,0,'Morpheus','22-12-2010','What is The Matrix?'),(441,0,'Artificial intelligence','29-05-2012','Free your mind'),(442,0,'Artificial intelligence','12-10-2010','Believe the unbelievable'),(443,0,'Agent Smith','26-12-2010','Reality is a thing of the past'),(444,0,'Neo','04-09-2011','The Fight for the Future Begins'),(445,0,'Artificial intelligence','20-05-2011','Believe the unbelievable'),(446,0,'Neo','31-03-2012','Free your mind'),(447,0,'Trinity','12-08-2013','The Fight for the Future Begins'),(448,0,'Artificial intelligence','06-06-2011','Reality is a thing of the past'),(449,0,'Neo','17-04-2010','Free your mind'),(450,0,'Agent Smith','19-01-2013','Free your mind'),(451,0,'Agent Smith','17-01-2013','Believe the unbelievable'),(452,0,'Neo','04-03-2012','The Fight for the Future Begins'),(453,0,'Morpheus','08-05-2013','Believe the unbelievable'),(454,0,'Neo','29-07-2010','Reality is a thing of the past'),(455,0,'Neo','02-08-2012','What is The Matrix?'),(456,0,'Neo','18-05-2010','Believe the unbelievable'),(457,0,'Neo','07-01-2012','Free your mind'),(458,0,'Trinity','23-04-2011','Reality is a thing of the past'),(459,0,'Artificial intelligence','25-01-2010','The Fight for the Future Begins'),(460,0,'Morpheus','15-08-2011','Believe the unbelievable'),(461,0,'Trinity','05-07-2010','Free your mind'),(462,0,'Trinity','19-08-2012','Reality is a thing of the past'),(463,0,'Neo','10-06-2012','What is The Matrix?'),(464,0,'Agent Smith','15-05-2012','Believe the unbelievable'),(465,0,'Morpheus','19-03-2011','Believe the unbelievable'),(466,0,'Morpheus','08-02-2010','Reality is a thing of the past'),(467,0,'Agent Smith','02-04-2010','What is The Matrix?'),(468,0,'Morpheus','03-12-2010','Reality is a thing of the past'),(469,0,'Morpheus','20-01-2011','Believe the unbelievable'),(470,0,'Agent Smith','16-01-2012','Free your mind'),(471,0,'Agent Smith','12-06-2010','The Fight for the Future Begins'),(472,0,'Trinity','13-01-2011','Believe the unbelievable'),(473,0,'Artificial intelligence','04-06-2012','Free your mind'),(474,0,'Agent Smith','11-05-2010','The Fight for the Future Begins'),(475,0,'Morpheus','10-11-2010','The Fight for the Future Begins'),(476,0,'Morpheus','30-12-2010','Free your mind'),(477,0,'Trinity','02-04-2012','What is The Matrix?'),(478,0,'Artificial intelligence','12-05-2013','What is The Matrix?'),(479,0,'Morpheus','26-02-2011','Believe the unbelievable'),(480,0,'Neo','02-12-2010','The Fight for the Future Begins'),(481,0,'Trinity','05-12-2012','What is The Matrix?'),(482,0,'Agent Smith','20-12-2012','Free your mind'),(483,0,'Neo','22-10-2012','Reality is a thing of the past'),(484,0,'Agent Smith','29-09-2012','The Fight for the Future Begins'),(485,0,'Agent Smith','18-05-2011','Reality is a thing of the past'),(486,0,'Trinity','17-03-2010','Reality is a thing of the past'),(487,0,'Neo','01-11-2011','Reality is a thing of the past'),(488,0,'Trinity','10-12-2012','The Fight for the Future Begins'),(489,0,'Agent Smith','18-08-2013','Believe the unbelievable'),(490,0,'Agent Smith','27-07-2011','Reality is a thing of the past'),(491,0,'Artificial intelligence','12-05-2013','Reality is a thing of the past'),(492,0,'Trinity','12-06-2013','Free your mind'),(493,0,'Artificial intelligence','22-12-2012','What is The Matrix?'),(494,0,'Agent Smith','14-10-2010','What is The Matrix?'),(495,0,'Morpheus','25-05-2013','What is The Matrix?'),(496,0,'Artificial intelligence','21-09-2010','Believe the unbelievable'),(497,0,'Morpheus','19-10-2011','The Fight for the Future Begins'),(498,0,'Artificial intelligence','16-09-2010','The Fight for the Future Begins'),(499,0,'Morpheus','06-06-2013','What is The Matrix?'),(500,0,'Artificial intelligence','11-05-2010','What is The Matrix?'),(501,0,'Morpheus','03-09-2010','Reality is a thing of the past'),(502,0,'Agent Smith','11-05-2012','What is The Matrix?'),(503,0,'Neo','09-02-2013','Reality is a thing of the past'),(504,0,'Agent Smith','17-06-2012','Reality is a thing of the past'),(505,0,'Trinity','27-12-2011','Believe the unbelievable'),(506,0,'Morpheus','20-04-2011','Believe the unbelievable'),(507,0,'Trinity','13-04-2010','Free your mind'),(508,0,'Trinity','06-09-2011','Reality is a thing of the past'),(509,0,'Trinity','01-09-2012','Free your mind'),(510,0,'Agent Smith','13-03-2012','Reality is a thing of the past'),(511,0,'Agent Smith','19-11-2011','The Fight for the Future Begins'),(512,0,'Morpheus','12-10-2011','Reality is a thing of the past'),(513,0,'Neo','20-06-2011','Believe the unbelievable'),(514,0,'Agent Smith','11-08-2010','What is The Matrix?'),(515,0,'Agent Smith','11-02-2012','Free your mind'),(516,0,'Neo','16-01-2011','What is The Matrix?'),(517,0,'Trinity','03-08-2012','Believe the unbelievable'),(518,0,'Artificial intelligence','18-03-2011','What is The Matrix?'),(519,0,'Trinity','18-08-2010','The Fight for the Future Begins'),(520,0,'Trinity','25-03-2013','Free your mind'),(521,0,'Artificial intelligence','22-02-2011','Believe the unbelievable'),(522,0,'Artificial intelligence','12-03-2013','What is The Matrix?'),(523,0,'Morpheus','20-07-2012','Believe the unbelievable'),(524,0,'Morpheus','28-12-2012','Reality is a thing of the past'),(525,0,'Trinity','05-05-2011','Free your mind'),(526,0,'Artificial intelligence','22-04-2010','The Fight for the Future Begins'),(527,0,'Agent Smith','04-04-2010','What is The Matrix?'),(528,0,'Neo','11-06-2010','The Fight for the Future Begins'),(529,0,'Agent Smith','06-12-2011','What is The Matrix?'),(530,0,'Neo','04-09-2012','Reality is a thing of the past'),(531,0,'Morpheus','04-07-2012','What is The Matrix?'),(532,0,'Morpheus','27-02-2011','The Fight for the Future Begins'),(533,0,'Artificial intelligence','24-06-2013','Believe the unbelievable'),(534,0,'Trinity','26-05-2010','What is The Matrix?'),(535,0,'Agent Smith','05-09-2011','What is The Matrix?'),(536,0,'Artificial intelligence','11-08-2011','Reality is a thing of the past'),(537,0,'Neo','04-02-2011','What is The Matrix?'),(538,0,'Artificial intelligence','11-08-2013','Believe the unbelievable'),(539,0,'Neo','20-11-2012','What is The Matrix?'),(540,0,'Morpheus','02-02-2010','Free your mind'),(541,0,'Artificial intelligence','18-08-2012','Reality is a thing of the past'),(542,0,'Morpheus','26-05-2012','Believe the unbelievable'),(543,0,'Morpheus','27-02-2012','What is The Matrix?'),(544,0,'Morpheus','11-05-2010','Free your mind'),(545,0,'Morpheus','11-03-2013','The Fight for the Future Begins'),(546,0,'Trinity','06-04-2013','Reality is a thing of the past'),(547,0,'Artificial intelligence','18-12-2010','Reality is a thing of the past'),(548,0,'Trinity','14-09-2010','Reality is a thing of the past'),(549,0,'Agent Smith','07-05-2013','The Fight for the Future Begins'),(550,0,'Morpheus','29-07-2013','Reality is a thing of the past'),(551,0,'Morpheus','11-08-2012','Believe the unbelievable'),(552,0,'Trinity','30-03-2011','The Fight for the Future Begins'),(553,0,'Morpheus','05-11-2011','Reality is a thing of the past'),(554,0,'Artificial intelligence','17-07-2012','Reality is a thing of the past'),(555,0,'Artificial intelligence','16-04-2011','Believe the unbelievable'),(556,0,'Morpheus','06-04-2010','The Fight for the Future Begins'),(557,0,'Trinity','23-11-2012','The Fight for the Future Begins'),(558,0,'Artificial intelligence','11-03-2011','The Fight for the Future Begins'),(559,0,'Agent Smith','21-04-2010','Reality is a thing of the past'),(560,0,'Artificial intelligence','12-07-2011','Free your mind'),(561,0,'Agent Smith','10-08-2011','What is The Matrix?'),(562,0,'Trinity','14-05-2012','Free your mind'),(563,0,'Trinity','17-02-2011','Reality is a thing of the past'),(564,0,'Agent Smith','29-04-2013','Free your mind'),(565,0,'Agent Smith','10-03-2012','Free your mind'),(566,0,'Morpheus','13-06-2013','Free your mind'),(567,0,'Trinity','06-06-2013','Believe the unbelievable'),(568,0,'Agent Smith','16-02-2012','Believe the unbelievable'),(569,0,'Morpheus','23-05-2013','The Fight for the Future Begins'),(570,0,'Trinity','30-12-2009','Reality is a thing of the past'),(571,0,'Artificial intelligence','26-05-2011','The Fight for the Future Begins'),(572,0,'Neo','06-07-2013','Free your mind'),(573,0,'Trinity','19-02-2012','What is The Matrix?'),(574,0,'Agent Smith','29-04-2010','What is The Matrix?'),(575,0,'Trinity','23-12-2011','Free your mind'),(576,0,'Neo','22-04-2010','Free your mind'),(577,0,'Agent Smith','26-10-2010','The Fight for the Future Begins'),(578,0,'Neo','20-08-2013','Believe the unbelievable'),(579,0,'Morpheus','01-01-2013','What is The Matrix?'),(580,0,'Artificial intelligence','25-09-2011','Reality is a thing of the past'),(581,0,'Neo','02-01-2010','Reality is a thing of the past'),(582,0,'Trinity','07-01-2010','Reality is a thing of the past'),(583,0,'Trinity','29-06-2010','Reality is a thing of the past'),(584,0,'Trinity','14-08-2010','What is The Matrix?'),(585,0,'Neo','02-02-2012','Free your mind'),(586,0,'Agent Smith','05-04-2013','What is The Matrix?'),(587,0,'Neo','19-03-2013','Believe the unbelievable'),(588,0,'Artificial intelligence','18-07-2012','Reality is a thing of the past'),(589,0,'Artificial intelligence','09-05-2010','Reality is a thing of the past'),(590,0,'Agent Smith','11-06-2013','What is The Matrix?'),(591,0,'Artificial intelligence','15-07-2013','The Fight for the Future Begins'),(592,0,'Artificial intelligence','03-05-2010','The Fight for the Future Begins'),(593,0,'Agent Smith','29-10-2010','Believe the unbelievable'),(594,0,'Trinity','04-06-2013','Believe the unbelievable'),(595,0,'Morpheus','09-12-2012','Free your mind'),(596,0,'Artificial intelligence','19-03-2013','Reality is a thing of the past'),(597,0,'Artificial intelligence','10-06-2010','The Fight for the Future Begins'),(598,0,'Artificial intelligence','30-07-2010','What is The Matrix?'),(599,0,'Artificial intelligence','01-02-2011','What is The Matrix?'),(600,0,'Trinity','13-05-2010','What is The Matrix?'),(601,0,'Artificial intelligence','03-08-2011','Believe the unbelievable'),(602,0,'Agent Smith','25-05-2011','The Fight for the Future Begins'),(603,0,'Morpheus','04-02-2013','What is The Matrix?'),(604,0,'Agent Smith','04-01-2011','Reality is a thing of the past'),(605,0,'Trinity','09-03-2011','Believe the unbelievable'),(606,0,'Artificial intelligence','05-04-2013','What is The Matrix?'),(607,0,'Artificial intelligence','04-05-2011','Free your mind'),(608,0,'Artificial intelligence','14-08-2011','Reality is a thing of the past'),(609,0,'Agent Smith','20-08-2011','The Fight for the Future Begins'),(610,0,'Agent Smith','25-09-2011','Reality is a thing of the past'),(611,0,'Morpheus','11-12-2010','Believe the unbelievable'),(612,0,'Artificial intelligence','26-06-2010','Free your mind'),(613,0,'Neo','30-06-2013','Reality is a thing of the past'),(614,0,'Trinity','23-06-2011','Believe the unbelievable'),(615,0,'Neo','26-07-2011','What is The Matrix?'),(616,0,'Neo','13-05-2011','What is The Matrix?'),(617,0,'Trinity','18-11-2011','Reality is a thing of the past'),(618,0,'Trinity','12-09-2011','Free your mind'),(619,0,'Trinity','15-01-2011','What is The Matrix?'),(620,0,'Trinity','19-07-2012','Free your mind'),(621,0,'Agent Smith','30-12-2010','What is The Matrix?'),(622,0,'Trinity','02-06-2013','Reality is a thing of the past'),(623,0,'Trinity','02-09-2012','Believe the unbelievable'),(624,0,'Trinity','05-07-2010','What is The Matrix?'),(625,0,'Morpheus','27-03-2013','What is The Matrix?'),(626,0,'Trinity','15-03-2012','The Fight for the Future Begins'),(627,0,'Morpheus','27-08-2010','What is The Matrix?'),(628,0,'Artificial intelligence','29-10-2010','The Fight for the Future Begins'),(629,0,'Trinity','19-11-2011','The Fight for the Future Begins'),(630,0,'Morpheus','18-09-2012','Believe the unbelievable'),(631,0,'Agent Smith','06-12-2011','Reality is a thing of the past'),(632,0,'Morpheus','12-08-2013','Believe the unbelievable'),(633,0,'Agent Smith','20-12-2012','The Fight for the Future Begins'),(634,0,'Artificial intelligence','08-07-2010','The Fight for the Future Begins'),(635,0,'Artificial intelligence','10-09-2010','Believe the unbelievable'),(636,0,'Morpheus','08-07-2013','The Fight for the Future Begins'),(637,0,'Neo','04-06-2013','Believe the unbelievable'),(638,0,'Neo','11-04-2010','The Fight for the Future Begins'),(639,0,'Agent Smith','31-03-2010','The Fight for the Future Begins'),(640,0,'Trinity','27-08-2010','Free your mind'),(641,0,'Artificial intelligence','29-12-2011','Free your mind'),(642,0,'Neo','12-03-2011','Reality is a thing of the past'),(643,0,'Trinity','27-01-2012','Believe the unbelievable'),(644,0,'Artificial intelligence','08-08-2010','Believe the unbelievable'),(645,0,'Morpheus','20-11-2012','Reality is a thing of the past'),(646,0,'Morpheus','27-08-2010','What is The Matrix?'),(647,0,'Artificial intelligence','06-03-2012','Free your mind'),(648,0,'Artificial intelligence','22-06-2013','Free your mind'),(649,0,'Neo','20-03-2011','Believe the unbelievable'),(650,0,'Neo','02-07-2011','Believe the unbelievable'),(651,0,'Morpheus','21-01-2012','Reality is a thing of the past'),(652,0,'Neo','10-04-2010','Free your mind'),(653,0,'Agent Smith','09-03-2011','Reality is a thing of the past'),(654,0,'Neo','12-02-2011','What is The Matrix?'),(655,0,'Trinity','09-05-2011','The Fight for the Future Begins'),(656,0,'Neo','19-01-2012','What is The Matrix?'),(657,0,'Morpheus','19-07-2011','Reality is a thing of the past'),(658,0,'Morpheus','07-05-2012','Free your mind'),(659,0,'Agent Smith','22-07-2011','Free your mind'),(660,0,'Artificial intelligence','13-06-2013','The Fight for the Future Begins'),(661,0,'Trinity','13-11-2012','The Fight for the Future Begins'),(662,0,'Agent Smith','29-07-2012','Reality is a thing of the past'),(663,0,'Agent Smith','26-04-2012','The Fight for the Future Begins'),(664,0,'Artificial intelligence','10-12-2010','The Fight for the Future Begins'),(665,0,'Neo','03-04-2010','Reality is a thing of the past'),(666,0,'Neo','02-01-2011','Believe the unbelievable'),(667,0,'Artificial intelligence','25-06-2011','Free your mind'),(668,0,'Agent Smith','08-02-2010','Reality is a thing of the past'),(669,0,'Artificial intelligence','25-07-2011','What is The Matrix?'),(670,0,'Morpheus','19-04-2012','Free your mind'),(671,0,'Artificial intelligence','05-05-2012','Free your mind'),(672,0,'Neo','21-01-2011','The Fight for the Future Begins'),(673,0,'Trinity','24-11-2011','Believe the unbelievable'),(674,0,'Trinity','09-01-2012','Believe the unbelievable'),(675,0,'Neo','28-09-2012','What is The Matrix?'),(676,0,'Artificial intelligence','01-02-2012','The Fight for the Future Begins'),(677,0,'Neo','28-10-2011','The Fight for the Future Begins'),(678,0,'Neo','14-03-2011','Believe the unbelievable'),(679,0,'Morpheus','04-05-2012','Free your mind'),(680,0,'Morpheus','22-04-2013','What is The Matrix?'),(681,0,'Artificial intelligence','03-02-2010','Free your mind'),(682,0,'Agent Smith','02-09-2012','The Fight for the Future Begins'),(683,0,'Trinity','12-08-2012','Free your mind'),(684,0,'Trinity','04-01-2013','Reality is a thing of the past'),(685,0,'Morpheus','01-12-2010','The Fight for the Future Begins'),(686,0,'Agent Smith','07-03-2010','The Fight for the Future Begins'),(687,0,'Artificial intelligence','21-03-2013','What is The Matrix?'),(688,0,'Trinity','25-04-2011','Believe the unbelievable'),(689,0,'Agent Smith','16-01-2013','The Fight for the Future Begins'),(690,0,'Neo','20-03-2010','Free your mind'),(691,0,'Trinity','31-12-2011','Reality is a thing of the past'),(692,0,'Agent Smith','24-02-2010','What is The Matrix?'),(693,0,'Artificial intelligence','26-05-2013','Believe the unbelievable'),(694,0,'Artificial intelligence','28-02-2010','The Fight for the Future Begins'),(695,0,'Morpheus','01-04-2012','What is The Matrix?'),(696,0,'Morpheus','12-04-2013','Free your mind'),(697,0,'Agent Smith','23-09-2010','What is The Matrix?'),(698,0,'Neo','09-11-2012','Believe the unbelievable'),(699,0,'Morpheus','23-10-2011','Free your mind'),(700,0,'Neo','14-09-2011','Free your mind'),(701,0,'Neo','21-11-2012','Reality is a thing of the past'),(702,0,'Neo','18-01-2012','The Fight for the Future Begins'),(703,0,'Trinity','04-05-2010','Believe the unbelievable'),(704,0,'Trinity','28-10-2012','What is The Matrix?'),(705,0,'Trinity','06-05-2011','Reality is a thing of the past'),(706,0,'Trinity','29-07-2010','What is The Matrix?'),(707,0,'Neo','17-12-2012','Reality is a thing of the past'),(708,0,'Agent Smith','17-04-2011','Believe the unbelievable'),(709,0,'Neo','21-04-2010','Free your mind'),(710,0,'Artificial intelligence','09-02-2013','Reality is a thing of the past'),(711,0,'Artificial intelligence','17-01-2012','Free your mind'),(712,0,'Agent Smith','11-11-2010','What is The Matrix?'),(713,0,'Morpheus','28-02-2012','Free your mind'),(714,0,'Neo','26-07-2011','Believe the unbelievable'),(715,0,'Neo','18-09-2012','Reality is a thing of the past'),(716,0,'Agent Smith','21-06-2013','The Fight for the Future Begins'),(717,0,'Morpheus','12-03-2010','Free your mind'),(718,0,'Artificial intelligence','12-08-2010','Free your mind'),(719,0,'Agent Smith','27-12-2010','Believe the unbelievable'),(720,0,'Artificial intelligence','11-12-2011','Reality is a thing of the past'),(721,0,'Morpheus','11-06-2010','What is The Matrix?'),(722,0,'Agent Smith','04-02-2013','Reality is a thing of the past'),(723,0,'Agent Smith','27-12-2011','What is The Matrix?'),(724,0,'Trinity','11-11-2011','Reality is a thing of the past'),(725,0,'Agent Smith','22-06-2013','What is The Matrix?'),(726,0,'Artificial intelligence','02-10-2012','Reality is a thing of the past'),(727,0,'Neo','23-09-2011','The Fight for the Future Begins'),(728,0,'Trinity','04-05-2013','Reality is a thing of the past'),(729,0,'Agent Smith','30-09-2010','What is The Matrix?'),(730,0,'Artificial intelligence','08-06-2012','Free your mind'),(731,0,'Neo','08-09-2011','Free your mind'),(732,0,'Morpheus','09-01-2011','Believe the unbelievable'),(733,0,'Agent Smith','12-02-2010','Free your mind'),(734,0,'Neo','28-02-2013','Believe the unbelievable'),(735,0,'Trinity','11-07-2011','Reality is a thing of the past'),(736,0,'Artificial intelligence','25-04-2012','Reality is a thing of the past'),(737,0,'Artificial intelligence','04-05-2010','Believe the unbelievable'),(738,0,'Agent Smith','29-06-2010','Believe the unbelievable'),(739,0,'Trinity','21-09-2012','Free your mind'),(740,0,'Morpheus','12-11-2011','Believe the unbelievable'),(741,0,'Trinity','22-12-2011','What is The Matrix?'),(742,0,'Morpheus','28-09-2012','Reality is a thing of the past'),(743,0,'Artificial intelligence','18-04-2011','Believe the unbelievable'),(744,0,'Artificial intelligence','05-06-2013','Free your mind'),(745,0,'Neo','16-02-2010','Free your mind'),(746,0,'Morpheus','29-10-2011','Believe the unbelievable'),(747,0,'Neo','13-05-2012','Believe the unbelievable'),(748,0,'Agent Smith','26-08-2011','The Fight for the Future Begins'),(749,0,'Trinity','29-08-2012','What is The Matrix?'),(750,0,'Morpheus','29-05-2012','Reality is a thing of the past'),(751,0,'Artificial intelligence','12-12-2011','Believe the unbelievable'),(752,0,'Neo','18-04-2010','What is The Matrix?'),(753,0,'Morpheus','11-01-2011','Free your mind'),(754,0,'Morpheus','20-01-2010','The Fight for the Future Begins'),(755,0,'Morpheus','10-07-2011','What is The Matrix?'),(756,0,'Neo','19-04-2011','What is The Matrix?'),(757,0,'Agent Smith','03-02-2013','Free your mind'),(758,0,'Artificial intelligence','26-01-2013','Free your mind'),(759,0,'Morpheus','30-09-2010','Reality is a thing of the past'),(760,0,'Agent Smith','14-02-2011','Free your mind'),(761,0,'Neo','23-04-2010','Reality is a thing of the past'),(762,0,'Trinity','18-05-2013','Believe the unbelievable'),(763,0,'Morpheus','08-02-2011','Believe the unbelievable'),(764,0,'Morpheus','17-09-2011','The Fight for the Future Begins'),(765,0,'Agent Smith','15-07-2010','Reality is a thing of the past'),(766,0,'Agent Smith','31-12-2011','Believe the unbelievable'),(767,0,'Agent Smith','02-04-2012','Free your mind'),(768,0,'Artificial intelligence','04-03-2013','What is The Matrix?'),(769,0,'Agent Smith','08-07-2012','The Fight for the Future Begins'),(770,0,'Trinity','11-10-2011','The Fight for the Future Begins'),(771,0,'Neo','11-01-2012','Reality is a thing of the past'),(772,0,'Agent Smith','27-02-2010','The Fight for the Future Begins'),(773,0,'Morpheus','09-03-2013','Free your mind'),(774,0,'Agent Smith','05-02-2010','What is The Matrix?'),(775,0,'Morpheus','01-02-2010','What is The Matrix?'),(776,0,'Neo','26-01-2010','Believe the unbelievable'),(777,0,'Neo','15-04-2011','Believe the unbelievable'),(778,0,'Trinity','14-06-2013','Free your mind'),(779,0,'Trinity','23-07-2011','Free your mind'),(780,0,'Agent Smith','14-03-2011','Believe the unbelievable'),(781,0,'Neo','11-01-2011','Free your mind'),(782,0,'Morpheus','06-12-2011','Free your mind'),(783,0,'Morpheus','12-06-2012','Believe the unbelievable'),(784,0,'Morpheus','06-01-2010','Free your mind'),(785,0,'Artificial intelligence','28-02-2011','Reality is a thing of the past'),(786,0,'Trinity','09-01-2012','Reality is a thing of the past'),(787,0,'Morpheus','07-08-2010','What is The Matrix?'),(788,0,'Trinity','05-02-2012','The Fight for the Future Begins'),(789,0,'Morpheus','03-04-2012','Reality is a thing of the past'),(790,0,'Artificial intelligence','10-02-2011','Free your mind'),(791,0,'Artificial intelligence','16-12-2012','What is The Matrix?'),(792,0,'Artificial intelligence','10-04-2010','Free your mind'),(793,0,'Artificial intelligence','22-01-2013','The Fight for the Future Begins'),(794,0,'Neo','17-01-2012','Believe the unbelievable'),(795,0,'Agent Smith','26-01-2010','Reality is a thing of the past'),(796,0,'Neo','13-02-2010','Believe the unbelievable'),(797,0,'Artificial intelligence','30-06-2010','Believe the unbelievable'),(798,0,'Morpheus','14-03-2012','The Fight for the Future Begins'),(799,0,'Trinity','12-07-2012','Reality is a thing of the past'),(800,0,'Artificial intelligence','03-10-2011','The Fight for the Future Begins'),(801,0,'Agent Smith','08-08-2010','Reality is a thing of the past'),(802,0,'Morpheus','14-10-2010','The Fight for the Future Begins'),(803,0,'Morpheus','17-11-2010','Believe the unbelievable'),(804,0,'Neo','19-06-2013','Believe the unbelievable'),(805,0,'Trinity','20-04-2010','Reality is a thing of the past'),(806,0,'Neo','19-06-2012','Reality is a thing of the past'),(807,0,'Neo','26-01-2012','The Fight for the Future Begins'),(808,0,'Neo','23-09-2011','Free your mind'),(809,0,'Trinity','27-12-2011','What is The Matrix?'),(810,0,'Trinity','19-10-2012','Believe the unbelievable'),(811,0,'Neo','17-04-2010','The Fight for the Future Begins'),(812,0,'Trinity','11-02-2012','What is The Matrix?'),(813,0,'Neo','01-08-2012','The Fight for the Future Begins'),(814,0,'Morpheus','24-10-2012','Free your mind'),(815,0,'Neo','29-06-2012','What is The Matrix?'),(816,0,'Morpheus','06-02-2011','What is The Matrix?'),(817,0,'Agent Smith','02-11-2010','What is The Matrix?'),(818,0,'Artificial intelligence','17-09-2011','Free your mind'),(819,0,'Trinity','12-11-2012','Reality is a thing of the past'),(820,0,'Agent Smith','15-08-2010','The Fight for the Future Begins'),(821,0,'Neo','18-12-2010','Believe the unbelievable'),(822,0,'Trinity','08-07-2010','Reality is a thing of the past'),(823,0,'Artificial intelligence','25-01-2011','What is The Matrix?'),(824,0,'Agent Smith','15-10-2010','Reality is a thing of the past'),(825,0,'Neo','17-09-2011','Believe the unbelievable'),(826,0,'Trinity','28-01-2012','The Fight for the Future Begins'),(827,0,'Agent Smith','22-03-2012','Free your mind'),(828,0,'Artificial intelligence','16-07-2013','Believe the unbelievable'),(829,0,'Agent Smith','01-01-2010','The Fight for the Future Begins'),(830,0,'Agent Smith','15-02-2010','Believe the unbelievable'),(831,0,'Trinity','06-05-2012','What is The Matrix?'),(832,0,'Artificial intelligence','13-09-2011','The Fight for the Future Begins'),(833,0,'Morpheus','15-11-2011','What is The Matrix?'),(834,0,'Neo','27-02-2011','Reality is a thing of the past'),(835,0,'Artificial intelligence','01-12-2012','The Fight for the Future Begins'),(836,0,'Trinity','07-11-2010','Free your mind'),(837,0,'Neo','09-08-2010','What is The Matrix?'),(838,0,'Morpheus','21-07-2012','Reality is a thing of the past'),(839,0,'Morpheus','06-08-2013','Believe the unbelievable'),(840,0,'Artificial intelligence','07-02-2011','What is The Matrix?'),(841,0,'Trinity','25-03-2012','Free your mind'),(842,0,'Trinity','07-07-2013','Free your mind'),(843,0,'Morpheus','20-03-2012','Free your mind'),(844,0,'Morpheus','02-10-2010','Believe the unbelievable'),(845,0,'Trinity','14-01-2010','Reality is a thing of the past'),(846,0,'Morpheus','04-06-2011','Reality is a thing of the past'),(847,0,'Trinity','01-02-2012','Reality is a thing of the past'),(848,0,'Neo','21-07-2013','Believe the unbelievable'),(849,0,'Artificial intelligence','22-01-2010','What is The Matrix?'),(850,0,'Artificial intelligence','07-10-2012','Free your mind'),(851,0,'Neo','13-01-2011','Free your mind'),(852,0,'Artificial intelligence','06-07-2010','Reality is a thing of the past'),(853,0,'Morpheus','10-11-2012','Free your mind'),(854,0,'Neo','16-04-2011','The Fight for the Future Begins'),(855,0,'Morpheus','14-05-2012','What is The Matrix?'),(856,0,'Trinity','02-09-2012','Free your mind'),(857,0,'Agent Smith','20-07-2013','Reality is a thing of the past'),(858,0,'Artificial intelligence','22-06-2013','Free your mind'),(859,0,'Artificial intelligence','11-04-2010','Reality is a thing of the past'),(860,0,'Agent Smith','14-01-2011','Reality is a thing of the past'),(861,0,'Agent Smith','11-09-2012','The Fight for the Future Begins'),(862,0,'Neo','23-01-2013','Free your mind'),(863,0,'Artificial intelligence','17-09-2011','Believe the unbelievable'),(864,0,'Agent Smith','05-01-2013','What is The Matrix?'),(865,0,'Neo','07-09-2012','What is The Matrix?'),(866,0,'Trinity','24-11-2012','Free your mind'),(867,0,'Agent Smith','09-11-2010','The Fight for the Future Begins'),(868,0,'Trinity','30-03-2013','What is The Matrix?'),(869,0,'Artificial intelligence','14-06-2010','What is The Matrix?'),(870,0,'Morpheus','14-05-2010','Believe the unbelievable'),(871,0,'Artificial intelligence','09-01-2011','The Fight for the Future Begins'),(872,0,'Agent Smith','06-11-2011','What is The Matrix?'),(873,0,'Agent Smith','09-01-2012','What is The Matrix?'),(874,0,'Neo','15-12-2011','Reality is a thing of the past'),(875,0,'Agent Smith','16-01-2010','Free your mind'),(876,0,'Artificial intelligence','03-10-2010','Reality is a thing of the past'),(877,0,'Morpheus','07-09-2010','Reality is a thing of the past'),(878,0,'Neo','26-05-2011','The Fight for the Future Begins'),(879,0,'Neo','22-03-2011','Believe the unbelievable'),(880,0,'Agent Smith','30-01-2010','Reality is a thing of the past'),(881,0,'Morpheus','20-06-2012','Reality is a thing of the past'),(882,0,'Artificial intelligence','20-07-2011','Reality is a thing of the past'),(883,0,'Morpheus','22-05-2012','What is The Matrix?'),(884,0,'Neo','07-10-2011','The Fight for the Future Begins'),(885,0,'Artificial intelligence','29-08-2010','Free your mind'),(886,0,'Trinity','05-06-2013','Reality is a thing of the past'),(887,0,'Artificial intelligence','18-03-2013','Reality is a thing of the past'),(888,0,'Morpheus','10-04-2012','The Fight for the Future Begins'),(889,0,'Trinity','17-04-2011','Believe the unbelievable'),(890,0,'Neo','05-08-2012','The Fight for the Future Begins'),(891,0,'Trinity','09-07-2011','What is The Matrix?'),(892,0,'Neo','19-07-2013','Free your mind'),(893,0,'Neo','16-04-2011','The Fight for the Future Begins'),(894,0,'Morpheus','28-01-2010','Reality is a thing of the past'),(895,0,'Agent Smith','14-08-2010','Believe the unbelievable'),(896,0,'Morpheus','19-01-2012','The Fight for the Future Begins'),(897,0,'Trinity','17-01-2013','Reality is a thing of the past'),(898,0,'Neo','12-05-2012','Free your mind'),(899,0,'Artificial intelligence','26-12-2011','The Fight for the Future Begins'),(900,0,'Trinity','12-05-2013','Reality is a thing of the past'),(901,0,'Morpheus','26-06-2013','What is The Matrix?'),(902,0,'Neo','09-03-2013','What is The Matrix?'),(903,0,'Agent Smith','22-08-2011','Reality is a thing of the past'),(904,0,'Morpheus','25-04-2010','Believe the unbelievable'),(905,0,'Morpheus','11-05-2011','Believe the unbelievable'),(906,0,'Artificial intelligence','04-10-2011','The Fight for the Future Begins'),(907,0,'Trinity','22-01-2011','What is The Matrix?'),(908,0,'Trinity','15-02-2012','Reality is a thing of the past'),(909,0,'Trinity','14-11-2010','Reality is a thing of the past'),(910,0,'Agent Smith','27-09-2012','Reality is a thing of the past'),(911,0,'Neo','18-07-2013','Reality is a thing of the past'),(912,0,'Morpheus','16-08-2011','The Fight for the Future Begins'),(913,0,'Morpheus','11-10-2010','The Fight for the Future Begins'),(914,0,'Artificial intelligence','11-09-2011','Free your mind'),(915,0,'Agent Smith','16-04-2013','Free your mind'),(916,0,'Neo','29-09-2010','The Fight for the Future Begins'),(917,0,'Artificial intelligence','24-08-2011','Believe the unbelievable'),(918,0,'Artificial intelligence','15-04-2013','Believe the unbelievable'),(919,0,'Neo','06-08-2013','Free your mind'),(920,0,'Agent Smith','31-03-2013','What is The Matrix?'),(921,0,'Artificial intelligence','21-03-2012','Free your mind'),(922,0,'Morpheus','30-01-2013','Believe the unbelievable'),(923,0,'Agent Smith','21-04-2012','Believe the unbelievable'),(924,0,'Agent Smith','18-02-2010','The Fight for the Future Begins'),(925,0,'Neo','26-01-2013','The Fight for the Future Begins'),(926,0,'Morpheus','07-02-2012','The Fight for the Future Begins'),(927,0,'Artificial intelligence','17-09-2012','What is The Matrix?'),(928,0,'Artificial intelligence','13-06-2012','Reality is a thing of the past'),(929,0,'Neo','13-12-2012','The Fight for the Future Begins'),(930,0,'Morpheus','11-03-2013','Reality is a thing of the past'),(931,0,'Trinity','28-08-2012','The Fight for the Future Begins'),(932,0,'Trinity','15-03-2011','What is The Matrix?'),(933,0,'Artificial intelligence','03-06-2012','Reality is a thing of the past'),(934,0,'Artificial intelligence','01-02-2010','Believe the unbelievable'),(935,0,'Neo','19-10-2011','Reality is a thing of the past'),(936,0,'Agent Smith','22-02-2010','What is The Matrix?'),(937,0,'Morpheus','27-03-2010','Free your mind'),(938,0,'Morpheus','05-12-2012','Reality is a thing of the past'),(939,0,'Agent Smith','14-08-2011','The Fight for the Future Begins'),(940,0,'Agent Smith','21-03-2011','Believe the unbelievable'),(941,0,'Artificial intelligence','09-08-2010','The Fight for the Future Begins'),(942,0,'Neo','21-10-2011','Free your mind'),(943,0,'Trinity','08-10-2011','What is The Matrix?'),(944,0,'Artificial intelligence','20-11-2010','What is The Matrix?'),(945,0,'Agent Smith','10-04-2012','Free your mind'),(946,0,'Trinity','16-03-2013','The Fight for the Future Begins'),(947,0,'Trinity','02-02-2010','Reality is a thing of the past'),(948,0,'Artificial intelligence','02-02-2011','What is The Matrix?'),(949,0,'Morpheus','04-03-2012','What is The Matrix?'),(950,0,'Neo','15-11-2010','Believe the unbelievable'),(951,0,'Trinity','13-07-2013','What is The Matrix?'),(952,0,'Morpheus','10-12-2011','What is The Matrix?'),(953,0,'Trinity','10-09-2012','The Fight for the Future Begins'),(954,0,'Neo','17-04-2011','What is The Matrix?'),(955,0,'Neo','20-08-2012','Believe the unbelievable'),(956,0,'Artificial intelligence','25-09-2011','Believe the unbelievable'),(957,0,'Morpheus','03-10-2010','Believe the unbelievable'),(958,0,'Morpheus','06-11-2011','Reality is a thing of the past'),(959,0,'Trinity','16-09-2010','Reality is a thing of the past'),(960,0,'Morpheus','29-07-2010','Believe the unbelievable'),(961,0,'Neo','25-05-2012','Believe the unbelievable'),(962,0,'Trinity','28-09-2011','The Fight for the Future Begins'),(963,0,'Trinity','15-11-2012','Free your mind'),(964,0,'Morpheus','29-05-2010','Reality is a thing of the past'),(965,0,'Artificial intelligence','26-11-2010','The Fight for the Future Begins'),(966,0,'Agent Smith','31-12-2011','Reality is a thing of the past'),(967,0,'Agent Smith','04-07-2011','Reality is a thing of the past'),(968,0,'Neo','06-05-2011','What is The Matrix?'),(969,0,'Trinity','20-04-2012','The Fight for the Future Begins'),(970,0,'Agent Smith','27-10-2011','The Fight for the Future Begins'),(971,0,'Morpheus','20-09-2011','Believe the unbelievable'),(972,0,'Artificial intelligence','05-09-2011','Reality is a thing of the past'),(973,0,'Artificial intelligence','11-07-2013','Free your mind'),(974,0,'Trinity','26-03-2012','Believe the unbelievable'),(975,0,'Morpheus','07-03-2013','Believe the unbelievable'),(976,0,'Neo','08-07-2011','The Fight for the Future Begins'),(977,0,'Morpheus','26-04-2013','What is The Matrix?'),(978,0,'Neo','10-06-2012','What is The Matrix?'),(979,0,'Agent Smith','29-01-2010','What is The Matrix?'),(980,0,'Trinity','20-10-2012','What is The Matrix?'),(981,0,'Neo','01-04-2012','The Fight for the Future Begins'),(982,0,'Morpheus','19-06-2013','Free your mind'),(983,0,'Trinity','03-01-2013','Free your mind'),(984,0,'Trinity','01-01-2012','Believe the unbelievable'),(985,0,'Trinity','16-09-2012','The Fight for the Future Begins'),(986,0,'Neo','14-11-2010','Free your mind'),(987,0,'Agent Smith','06-07-2012','Believe the unbelievable'),(988,0,'Neo','19-01-2011','Believe the unbelievable'),(989,0,'Agent Smith','18-08-2011','Reality is a thing of the past'),(990,0,'Neo','17-12-2012','Free your mind'),(991,0,'Trinity','23-11-2011','Free your mind'),(992,0,'Trinity','24-01-2010','What is The Matrix?'),(993,0,'Trinity','23-05-2011','The Fight for the Future Begins'),(994,0,'Trinity','30-08-2011','Reality is a thing of the past'),(995,0,'Artificial intelligence','20-08-2012','What is The Matrix?'),(996,0,'Artificial intelligence','25-12-2010','Reality is a thing of the past'),(997,0,'Trinity','27-07-2012','Believe the unbelievable'),(998,0,'Neo','19-08-2011','Reality is a thing of the past'),(999,0,'Agent Smith','02-10-2010','Reality is a thing of the past'),(1000,0,'Morpheus','08-04-2010','Free your mind');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mts_promo`
--

DROP TABLE IF EXISTS `mts_promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mts_promo` (
  `id` int(10) NOT NULL,
  `imhonet_user_id` int(10) DEFAULT NULL,
  `user_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `notifications` tinyint(1) NOT NULL DEFAULT '1',
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_sms_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `element_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mts_promo_promo_sms_push_status1` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mts_promo`
--

LOCK TABLES `mts_promo` WRITE;
/*!40000 ALTER TABLE `mts_promo` DISABLE KEYS */;
/*!40000 ALTER TABLE `mts_promo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_brand`
--

DROP TABLE IF EXISTS `promo_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_brand_company` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_brand`
--

LOCK TABLES `promo_brand` WRITE;
/*!40000 ALTER TABLE `promo_brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_brand_user`
--

DROP TABLE IF EXISTS `promo_brand_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_brand_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(10) unsigned NOT NULL,
  `imhonet_user_id` int(10) unsigned DEFAULT NULL,
  `company_user_id` int(10) unsigned NOT NULL,
  `user_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `contacted_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brand_user` (`imhonet_user_id`,`brand_id`,`user_key`),
  KEY `fk_brand_user` (`brand_id`),
  KEY `fk_brand_company_user` (`company_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_brand_user`
--

LOCK TABLES `promo_brand_user` WRITE;
/*!40000 ALTER TABLE `promo_brand_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_brand_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_campaign`
--

DROP TABLE IF EXISTS `promo_campaign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_campaign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_campaign_brand` (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_campaign`
--

LOCK TABLES `promo_campaign` WRITE;
/*!40000 ALTER TABLE `promo_campaign` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_campaign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_campaign_code`
--

DROP TABLE IF EXISTS `promo_campaign_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_campaign_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `campaign_user_id` int(10) unsigned DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_campaign_code`
--

LOCK TABLES `promo_campaign_code` WRITE;
/*!40000 ALTER TABLE `promo_campaign_code` DISABLE KEYS */;
INSERT INTO `promo_campaign_code` VALUES (1,'IMHO1',1,'Загружен','2013-03-10 00:00:00'),(2,'IMHO2',NULL,'Активен','2013-02-10 00:00:00');
/*!40000 ALTER TABLE `promo_campaign_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_campaign_user`
--

DROP TABLE IF EXISTS `promo_campaign_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_campaign_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(10) unsigned NOT NULL,
  `brand_user_id` int(10) unsigned NOT NULL,
  `imhonet_user_id` int(10) unsigned DEFAULT NULL,
  `user_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `contacted_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `gender` enum('men','women','unknown') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unknown',
  `age` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `campaign_user` (`campaign_id`,`imhonet_user_id`,`user_key`),
  KEY `fk_cu_brand_user` (`brand_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_campaign_user`
--

LOCK TABLES `promo_campaign_user` WRITE;
/*!40000 ALTER TABLE `promo_campaign_user` DISABLE KEYS */;
INSERT INTO `promo_campaign_user` VALUES (1,1,1,1,'test user key','Test User 1',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',22),(2,2,2,2,'test user key','Test User 2',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',68),(3,3,3,3,'test user key','Test User 3',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',59),(4,4,4,4,'test user key','Test User 4',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',28),(5,5,5,5,'test user key','Test User 5',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',52),(6,6,6,6,'test user key','Test User 6',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',95),(7,7,7,7,'test user key','Test User 7',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',98),(8,8,8,8,'test user key','Test User 8',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',92),(9,9,9,9,'test user key','Test User 9',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',76),(10,10,10,10,'test user key','Test User 10',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',18),(11,11,11,11,'test user key','Test User 11',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',91),(12,12,12,12,'test user key','Test User 12',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',95),(13,13,13,13,'test user key','Test User 13',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',91),(14,14,14,14,'test user key','Test User 14',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',12),(15,15,15,15,'test user key','Test User 15',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',3),(16,16,16,16,'test user key','Test User 16',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',33),(17,17,17,17,'test user key','Test User 17',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',17),(18,18,18,18,'test user key','Test User 18',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',14),(19,19,19,19,'test user key','Test User 19',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',25),(20,20,20,20,'test user key','Test User 20',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',57),(21,21,21,21,'test user key','Test User 21',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',74),(22,22,22,22,'test user key','Test User 22',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',67),(23,23,23,23,'test user key','Test User 23',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',86),(24,24,24,24,'test user key','Test User 24',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',29),(25,25,25,25,'test user key','Test User 25',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',53),(26,26,26,26,'test user key','Test User 26',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',59),(27,27,27,27,'test user key','Test User 27',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',67),(28,28,28,28,'test user key','Test User 28',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',81),(29,29,29,29,'test user key','Test User 29',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',9),(30,30,30,30,'test user key','Test User 30',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',20),(31,31,31,31,'test user key','Test User 31',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',82),(32,32,32,32,'test user key','Test User 32',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',41),(33,33,33,33,'test user key','Test User 33',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',1),(34,34,34,34,'test user key','Test User 34',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',70),(35,35,35,35,'test user key','Test User 35',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',15),(36,36,36,36,'test user key','Test User 36',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',60),(37,37,37,37,'test user key','Test User 37',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',15),(38,38,38,38,'test user key','Test User 38',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',80),(39,39,39,39,'test user key','Test User 39',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',29),(40,40,40,40,'test user key','Test User 40',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',85),(41,41,41,41,'test user key','Test User 41',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',29),(42,42,42,42,'test user key','Test User 42',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',29),(43,43,43,43,'test user key','Test User 43',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',61),(44,44,44,44,'test user key','Test User 44',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',83),(45,45,45,45,'test user key','Test User 45',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',23),(46,46,46,46,'test user key','Test User 46',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',42),(47,47,47,47,'test user key','Test User 47',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',42),(48,48,48,48,'test user key','Test User 48',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',91),(49,49,49,49,'test user key','Test User 49',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',11),(50,50,50,50,'test user key','Test User 50',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',17),(51,51,51,51,'test user key','Test User 51',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',93),(52,52,52,52,'test user key','Test User 52',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',35),(53,53,53,53,'test user key','Test User 53',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',48),(54,54,54,54,'test user key','Test User 54',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',48),(55,55,55,55,'test user key','Test User 55',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',49),(56,56,56,56,'test user key','Test User 56',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',37),(57,57,57,57,'test user key','Test User 57',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',67),(58,58,58,58,'test user key','Test User 58',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',61),(59,59,59,59,'test user key','Test User 59',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',36),(60,60,60,60,'test user key','Test User 60',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',50),(61,61,61,61,'test user key','Test User 61',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',3),(62,62,62,62,'test user key','Test User 62',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',13),(63,63,63,63,'test user key','Test User 63',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',72),(64,64,64,64,'test user key','Test User 64',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',48),(65,65,65,65,'test user key','Test User 65',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',74),(66,66,66,66,'test user key','Test User 66',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',100),(67,67,67,67,'test user key','Test User 67',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',7),(68,68,68,68,'test user key','Test User 68',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',48),(69,69,69,69,'test user key','Test User 69',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',79),(70,70,70,70,'test user key','Test User 70',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',63),(71,71,71,71,'test user key','Test User 71',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',80),(72,72,72,72,'test user key','Test User 72',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',13),(73,73,73,73,'test user key','Test User 73',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',84),(74,74,74,74,'test user key','Test User 74',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',46),(75,75,75,75,'test user key','Test User 75',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',62),(76,76,76,76,'test user key','Test User 76',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',35),(77,77,77,77,'test user key','Test User 77',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',75),(78,78,78,78,'test user key','Test User 78',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',29),(79,79,79,79,'test user key','Test User 79',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',87),(80,80,80,80,'test user key','Test User 80',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',33),(81,81,81,81,'test user key','Test User 81',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',82),(82,82,82,82,'test user key','Test User 82',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',66),(83,83,83,83,'test user key','Test User 83',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',39),(84,84,84,84,'test user key','Test User 84',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',51),(85,85,85,85,'test user key','Test User 85',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',60),(86,86,86,86,'test user key','Test User 86',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',51),(87,87,87,87,'test user key','Test User 87',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',100),(88,88,88,88,'test user key','Test User 88',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',89),(89,89,89,89,'test user key','Test User 89',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',39),(90,90,90,90,'test user key','Test User 90',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',18),(91,91,91,91,'test user key','Test User 91',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',13),(92,92,92,92,'test user key','Test User 92',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',47),(93,93,93,93,'test user key','Test User 93',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',54),(94,94,94,94,'test user key','Test User 94',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',56),(95,95,95,95,'test user key','Test User 95',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',38),(96,96,96,96,'test user key','Test User 96',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',68),(97,97,97,97,'test user key','Test User 97',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',83),(98,98,98,98,'test user key','Test User 98',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','men',78),(99,99,99,99,'test user key','Test User 99',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','unknown',28),(100,100,100,100,'test user key','Test User 100',1,'2013-03-01 00:00:00','2013-03-07 00:00:00','women',7);
/*!40000 ALTER TABLE `promo_campaign_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_campaign_user_action`
--

DROP TABLE IF EXISTS `promo_campaign_user_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_campaign_user_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wave_id` int(10) unsigned NOT NULL,
  `campaign_user_id` int(10) unsigned NOT NULL,
  `action_type_id` int(10) unsigned NOT NULL,
  `score` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cu_action` (`campaign_user_id`),
  KEY `fk_cu_action_type` (`action_type_id`),
  KEY `fk_cu_action_wave` (`wave_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_campaign_user_action`
--

LOCK TABLES `promo_campaign_user_action` WRITE;
/*!40000 ALTER TABLE `promo_campaign_user_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_campaign_user_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_campaign_user_action_type`
--

DROP TABLE IF EXISTS `promo_campaign_user_action_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_campaign_user_action_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(10) unsigned NOT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `score` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `campaign_code_uniq` (`campaign_id`,`code`),
  KEY `fk_cu_action_type_campaign` (`campaign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_campaign_user_action_type`
--

LOCK TABLES `promo_campaign_user_action_type` WRITE;
/*!40000 ALTER TABLE `promo_campaign_user_action_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_campaign_user_action_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_campaign_user_feedback`
--

DROP TABLE IF EXISTS `promo_campaign_user_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_campaign_user_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(10) unsigned NOT NULL,
  `feedback_type_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `campaign_user_id` int(10) unsigned NOT NULL,
  `imhonet_user_id` int(10) DEFAULT NULL,
  `user_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value_text` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_type` (`feedback_type_id`),
  KEY `fk_feedback_cu_object` (`object_id`),
  KEY `fk_feedback_parent` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_campaign_user_feedback`
--

LOCK TABLES `promo_campaign_user_feedback` WRITE;
/*!40000 ALTER TABLE `promo_campaign_user_feedback` DISABLE KEYS */;
INSERT INTO `promo_campaign_user_feedback` VALUES (4,1,2,1,21,1,'key','The Fight for the Future Begins','approved','2013-04-01 09:19:44'),(5,1,2,1,83,1,'key','Free your mind','pending','2013-03-31 18:00:00'),(6,1,2,1,12,1,'key','Reality is a thing of the past','pending','2013-03-31 18:00:00'),(7,1,2,1,51,1,'key','What is The Matrix?','pending','2013-03-31 18:00:00'),(8,1,2,1,4,1,'key','Believe the unbelievable','pending','2013-03-31 18:00:00'),(9,1,2,1,63,1,'key','Who watches the watchmen?','pending','2013-03-31 18:00:00'),(10,1,2,1,84,1,'key','Who watches the watchmen?','rejected','2013-04-01 09:19:52'),(11,1,2,1,52,1,'key','Believe the unbelievable','pending','2013-03-31 18:00:00'),(12,1,2,1,5,1,'key','Believe the unbelievable','pending','2013-03-31 18:00:00'),(13,1,2,1,26,1,'key','Matrix has you','pending','2013-03-31 18:00:00'),(14,1,2,1,87,1,'key','Matrix has you','pending','2013-03-31 18:00:00'),(15,1,2,1,87,1,'key','Believe the unbelievable','pending','2013-03-31 18:00:00'),(16,1,2,1,12,1,'key','Believe the unbelievable','pending','2013-03-31 18:00:00');
/*!40000 ALTER TABLE `promo_campaign_user_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_campaign_user_object`
--

DROP TABLE IF EXISTS `promo_campaign_user_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_campaign_user_object` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_user_id` int(10) unsigned NOT NULL,
  `type_id` int(10) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `value_int` int(10) DEFAULT NULL,
  `value_string` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_text` text COLLATE utf8_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_object_type` (`type_id`),
  KEY `fk_object_cu` (`campaign_user_id`),
  KEY `fk_object_parent` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_campaign_user_object`
--

LOCK TABLES `promo_campaign_user_object` WRITE;
/*!40000 ALTER TABLE `promo_campaign_user_object` DISABLE KEYS */;
INSERT INTO `promo_campaign_user_object` VALUES (9,10,3,1,NULL,NULL,NULL,'pending','2013-03-29 00:00:00','2013-03-29 00:00:00'),(10,10,3,1,NULL,NULL,NULL,'pending','2013-03-29 00:00:00','2013-03-29 00:00:00'),(11,10,2,1,NULL,NULL,NULL,'pending','2013-03-29 00:00:00','2013-03-29 00:00:00'),(12,5,2,1,NULL,NULL,NULL,'pending','2013-03-19 00:00:00','2013-03-25 00:00:00'),(13,10,2,1,NULL,NULL,NULL,'pending','2013-03-25 00:00:00','2013-03-15 00:00:00'),(14,40,2,1,NULL,NULL,NULL,'pending','2013-03-15 00:00:00','2013-03-16 00:00:00'),(15,40,2,1,NULL,NULL,NULL,'pending','2013-03-19 00:00:00','2013-03-15 00:00:00'),(16,40,2,1,NULL,NULL,NULL,'pending','2013-03-22 00:00:00','2013-03-12 00:00:00'),(17,40,2,1,NULL,NULL,NULL,'pending','2013-03-18 00:00:00','2013-03-20 00:00:00'),(18,45,2,1,NULL,NULL,NULL,'pending','2013-03-18 00:00:00','2013-03-12 00:00:00'),(19,50,2,1,NULL,NULL,NULL,'pending','2013-03-23 00:00:00','2013-03-13 00:00:00'),(20,50,2,1,NULL,NULL,NULL,'pending','2013-03-24 00:00:00','2013-03-10 00:00:00'),(21,50,2,1,NULL,NULL,NULL,'pending','2013-03-20 00:00:00','2013-03-15 00:00:00'),(22,50,2,1,NULL,NULL,NULL,'approved','2013-03-18 00:00:00','2013-03-24 00:00:00');
/*!40000 ALTER TABLE `promo_campaign_user_object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_campaign_user_object_wave`
--

DROP TABLE IF EXISTS `promo_campaign_user_object_wave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_campaign_user_object_wave` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(10) unsigned NOT NULL,
  `wave_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cuo_object` (`object_id`),
  KEY `fk_cuo_wave` (`wave_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_campaign_user_object_wave`
--

LOCK TABLES `promo_campaign_user_object_wave` WRITE;
/*!40000 ALTER TABLE `promo_campaign_user_object_wave` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_campaign_user_object_wave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_campaign_wave`
--

DROP TABLE IF EXISTS `promo_campaign_wave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_campaign_wave` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(10) unsigned NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wave_campaign` (`campaign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_campaign_wave`
--

LOCK TABLES `promo_campaign_wave` WRITE;
/*!40000 ALTER TABLE `promo_campaign_wave` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_campaign_wave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_campaign_wave_score`
--

DROP TABLE IF EXISTS `promo_campaign_wave_score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_campaign_wave_score` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wave_id` int(10) unsigned NOT NULL,
  `campaign_user_id` int(10) unsigned NOT NULL,
  `score` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `object_id` int(10) unsigned NOT NULL,
  `position` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_wave_score_wave` (`wave_id`),
  KEY `fk_wave_score_user` (`campaign_user_id`),
  KEY `fk_wave_object` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_campaign_wave_score`
--

LOCK TABLES `promo_campaign_wave_score` WRITE;
/*!40000 ALTER TABLE `promo_campaign_wave_score` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_campaign_wave_score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_company`
--

DROP TABLE IF EXISTS `promo_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_company`
--

LOCK TABLES `promo_company` WRITE;
/*!40000 ALTER TABLE `promo_company` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_company_user`
--

DROP TABLE IF EXISTS `promo_company_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_company_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imhonet_user_id` int(10) unsigned DEFAULT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `user_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_user` (`imhonet_user_id`,`company_id`,`user_key`),
  KEY `fk_company_user` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_company_user`
--

LOCK TABLES `promo_company_user` WRITE;
/*!40000 ALTER TABLE `promo_company_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_company_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_feedback_type`
--

DROP TABLE IF EXISTS `promo_feedback_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_feedback_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_feedback_type`
--

LOCK TABLES `promo_feedback_type` WRITE;
/*!40000 ALTER TABLE `promo_feedback_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_feedback_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_object_counter`
--

DROP TABLE IF EXISTS `promo_object_counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_object_counter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(10) unsigned NOT NULL,
  `feedback_type_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `object_feedback` (`object_id`,`feedback_type_id`),
  KEY `fk_counter_feedback_type` (`feedback_type_id`),
  KEY `fk_counter_cu_object` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_object_counter`
--

LOCK TABLES `promo_object_counter` WRITE;
/*!40000 ALTER TABLE `promo_object_counter` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_object_counter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_object_type`
--

DROP TABLE IF EXISTS `promo_object_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_object_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_object_type`
--

LOCK TABLES `promo_object_type` WRITE;
/*!40000 ALTER TABLE `promo_object_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_object_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_participant_relation`
--

DROP TABLE IF EXISTS `promo_participant_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_participant_relation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_campaign_user_id` int(10) unsigned NOT NULL,
  `to_campaign_user_id` int(10) unsigned NOT NULL,
  `relation_type_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cu_relation_from` (`from_campaign_user_id`),
  KEY `fk_cu_relation_to` (`to_campaign_user_id`),
  KEY `fk_cu_relation_type` (`relation_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_participant_relation`
--

LOCK TABLES `promo_participant_relation` WRITE;
/*!40000 ALTER TABLE `promo_participant_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_participant_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_participant_relation_type`
--

DROP TABLE IF EXISTS `promo_participant_relation_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_participant_relation_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_participant_relation_type`
--

LOCK TABLES `promo_participant_relation_type` WRITE;
/*!40000 ALTER TABLE `promo_participant_relation_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_participant_relation_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_prize`
--

DROP TABLE IF EXISTS `promo_prize`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(10) unsigned DEFAULT NULL,
  `wave_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(10) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prizes_wave` (`wave_id`),
  KEY `fk_prizes_campaign` (`campaign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_prize`
--

LOCK TABLES `promo_prize` WRITE;
/*!40000 ALTER TABLE `promo_prize` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_prize` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_prize_campaign_user`
--

DROP TABLE IF EXISTS `promo_prize_campaign_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_prize_campaign_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prize_id` int(10) unsigned NOT NULL,
  `campaign_id` int(10) unsigned DEFAULT NULL,
  `wave_id` int(10) unsigned DEFAULT NULL,
  `campaign_user_id` int(10) unsigned NOT NULL,
  `position` smallint(5) unsigned NOT NULL,
  `is_notified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prize_cu_prize` (`prize_id`),
  KEY `fk_prize_cu_wave` (`wave_id`),
  KEY `fk_prize_cu_campaign_user` (`campaign_user_id`),
  KEY `fk_prize_cu_campaign` (`campaign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_prize_campaign_user`
--

LOCK TABLES `promo_prize_campaign_user` WRITE;
/*!40000 ALTER TABLE `promo_prize_campaign_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_prize_campaign_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_sms_push`
--

DROP TABLE IF EXISTS `promo_sms_push`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_sms_push` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_user_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `object_id` int(10) unsigned NOT NULL,
  `service_sms_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sms_push_cu` (`campaign_user_id`),
  KEY `fk_sms_push_status` (`status_id`),
  KEY `fk_sms_push_cu_object` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_sms_push`
--

LOCK TABLES `promo_sms_push` WRITE;
/*!40000 ALTER TABLE `promo_sms_push` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_sms_push` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_sms_push_property`
--

DROP TABLE IF EXISTS `promo_sms_push_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_sms_push_property` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sms_push_id` int(10) unsigned NOT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `value_int` int(10) DEFAULT NULL,
  `value_string` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_property_sms_push` (`sms_push_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_sms_push_property`
--

LOCK TABLES `promo_sms_push_property` WRITE;
/*!40000 ALTER TABLE `promo_sms_push_property` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_sms_push_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_sms_push_status`
--

DROP TABLE IF EXISTS `promo_sms_push_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_sms_push_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_sms_push_status`
--

LOCK TABLES `promo_sms_push_status` WRITE;
/*!40000 ALTER TABLE `promo_sms_push_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_sms_push_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_answer`
--

DROP TABLE IF EXISTS `question_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_answer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `score` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_answer`
--

LOCK TABLES `question_answer` WRITE;
/*!40000 ALTER TABLE `question_answer` DISABLE KEYS */;
INSERT INTO `question_answer` VALUES (1,1,1,1),(2,1,2,99),(3,1,3,0),(4,1,4,0);
/*!40000 ALTER TABLE `question_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionnaire`
--

DROP TABLE IF EXISTS `questionnaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionnaire` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `status` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionnaire`
--

LOCK TABLES `questionnaire` WRITE;
/*!40000 ALTER TABLE `questionnaire` DISABLE KEYS */;
INSERT INTO `questionnaire` VALUES (1,'Кто был 21-ым президентом США?','draft'),(2,'Упс','draft'),(3,'Йоу','draft');
/*!40000 ALTER TABLE `questionnaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'Назовите 21-ого президента США',0);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz`
--

LOCK TABLES `quiz` WRITE;
/*!40000 ALTER TABLE `quiz` DISABLE KEYS */;
INSERT INTO `quiz` VALUES (1,'Викторина','2013-03-14 19:14:03','2013-03-21 19:14:04','черновик');
/*!40000 ALTER TABLE `quiz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_questions`
--

DROP TABLE IF EXISTS `quiz_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_questions`
--

LOCK TABLES `quiz_questions` WRITE;
/*!40000 ALTER TABLE `quiz_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_group_criteria`
--

DROP TABLE IF EXISTS `stat_group_criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_group_criteria` (
  `id` smallint(5) unsigned NOT NULL,
  `title` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_group_criteria`
--

LOCK TABLES `stat_group_criteria` WRITE;
/*!40000 ALTER TABLE `stat_group_criteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_group_criteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report`
--

DROP TABLE IF EXISTS `stat_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report` (
  `id` smallint(6) NOT NULL,
  `handler` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `campaign_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report`
--

LOCK TABLES `stat_report` WRITE;
/*!40000 ALTER TABLE `stat_report` DISABLE KEYS */;
INSERT INTO `stat_report` VALUES (1,'UniqueSex','Unique sex',0),(2,'UniqueSocialNetwork','Auth via Social Networks',0),(3,'Register','Register',0),(4,'UniqueAge','UniqueAge',0),(5,'UniqueActivity','UniqueActivity',0),(6,'UniqueWorks','UniqueWorks',0),(7,'UniqueVotes','UniqueVotes',0),(8,'UniqueCodes','UniqueCodes',0),(9,'TestResults','TestResults',0),(10,'WorksStatuses','WorksStatuses',0),(11,'WorksRatings','WorksRatings',0),(12,'InvitationsStatuses','InvitationsStatuses',0),(13,'CodesStatuses','CodesStatuses',0),(14,'ContentLikesSocialNetworks','ContentLikesSocialNetworks',0),(15,'WinnersByPrize','WinnersByPrize',0),(16,'WorksCommentsStatuses','WorksCommentsStatuses',0),(17,'RejectionRequests','RejectionRequests',0);
/*!40000 ALTER TABLE `stat_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_codes_statuses`
--

DROP TABLE IF EXISTS `stat_report_codes_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_codes_statuses` (
  `date` date NOT NULL,
  `dimention` enum('Верные','Неверные','Повторные') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_codes_statuses`
--

LOCK TABLES `stat_report_codes_statuses` WRITE;
/*!40000 ALTER TABLE `stat_report_codes_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_codes_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_content_likes_social_networks`
--

DROP TABLE IF EXISTS `stat_report_content_likes_social_networks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_content_likes_social_networks` (
  `date` date NOT NULL,
  `dimention` enum('FB','VK','OK') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_content_likes_social_networks`
--

LOCK TABLES `stat_report_content_likes_social_networks` WRITE;
/*!40000 ALTER TABLE `stat_report_content_likes_social_networks` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_content_likes_social_networks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_counter`
--

DROP TABLE IF EXISTS `stat_report_counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_counter` (
  `id` smallint(5) unsigned NOT NULL,
  `title` varchar(45) NOT NULL,
  `stat_group_criteria_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_counter`
--

LOCK TABLES `stat_report_counter` WRITE;
/*!40000 ALTER TABLE `stat_report_counter` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_counter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_counter_value`
--

DROP TABLE IF EXISTS `stat_report_counter_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_counter_value` (
  `stat_report_counter_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `day` int(10) unsigned NOT NULL,
  `week` int(10) unsigned DEFAULT NULL,
  `month` int(10) unsigned DEFAULT NULL,
  UNIQUE KEY `unique_counter` (`stat_report_counter_id`,`date`) USING BTREE,
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_counter_value`
--

LOCK TABLES `stat_report_counter_value` WRITE;
/*!40000 ALTER TABLE `stat_report_counter_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_counter_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_invitations_statuses`
--

DROP TABLE IF EXISTS `stat_report_invitations_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_invitations_statuses` (
  `date` date NOT NULL,
  `dimention` enum('Всего отправлено','Принято','Ожидает') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_invitations_statuses`
--

LOCK TABLES `stat_report_invitations_statuses` WRITE;
/*!40000 ALTER TABLE `stat_report_invitations_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_invitations_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_register`
--

DROP TABLE IF EXISTS `stat_report_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_register` (
  `date` date NOT NULL,
  `dimention` enum('Новые','Всего') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_register`
--

LOCK TABLES `stat_report_register` WRITE;
/*!40000 ALTER TABLE `stat_report_register` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_register` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_rejection_requests`
--

DROP TABLE IF EXISTS `stat_report_rejection_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_rejection_requests` (
  `date` date NOT NULL,
  `dimention` enum('Отказов от рассылок','Отказов от участия') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_rejection_requests`
--

LOCK TABLES `stat_report_rejection_requests` WRITE;
/*!40000 ALTER TABLE `stat_report_rejection_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_rejection_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_tests_results`
--

DROP TABLE IF EXISTS `stat_report_tests_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_tests_results` (
  `date` date NOT NULL,
  `dimention` enum('0-10 правильных ответов','11-30 правильных ответов','31-50 правильных ответов') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_tests_results`
--

LOCK TABLES `stat_report_tests_results` WRITE;
/*!40000 ALTER TABLE `stat_report_tests_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_tests_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_unique_activities`
--

DROP TABLE IF EXISTS `stat_report_unique_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_unique_activities` (
  `date` date NOT NULL,
  `dimention` enum('Отправили работу','Проголосовали','Комментировали','Пригласили друга','Лайкали') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_unique_activities`
--

LOCK TABLES `stat_report_unique_activities` WRITE;
/*!40000 ALTER TABLE `stat_report_unique_activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_unique_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_unique_age`
--

DROP TABLE IF EXISTS `stat_report_unique_age`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_unique_age` (
  `date` date NOT NULL,
  `dimention` enum('До 18','18-24','25-34','35-44','45+') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_unique_age`
--

LOCK TABLES `stat_report_unique_age` WRITE;
/*!40000 ALTER TABLE `stat_report_unique_age` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_unique_age` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_unique_codes`
--

DROP TABLE IF EXISTS `stat_report_unique_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_unique_codes` (
  `date` date NOT NULL,
  `dimention` enum('0','1','2','3-10','10+') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_unique_codes`
--

LOCK TABLES `stat_report_unique_codes` WRITE;
/*!40000 ALTER TABLE `stat_report_unique_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_unique_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_unique_sex`
--

DROP TABLE IF EXISTS `stat_report_unique_sex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_unique_sex` (
  `date` date NOT NULL,
  `dimention` enum('Мужчины','Женщины','Неизвестно') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_unique_sex`
--

LOCK TABLES `stat_report_unique_sex` WRITE;
/*!40000 ALTER TABLE `stat_report_unique_sex` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_unique_sex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_unique_social_network`
--

DROP TABLE IF EXISTS `stat_report_unique_social_network`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_unique_social_network` (
  `date` date NOT NULL,
  `dimention` enum('FB','VK','OK') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_unique_social_network`
--

LOCK TABLES `stat_report_unique_social_network` WRITE;
/*!40000 ALTER TABLE `stat_report_unique_social_network` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_unique_social_network` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_unique_votes`
--

DROP TABLE IF EXISTS `stat_report_unique_votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_unique_votes` (
  `date` date NOT NULL,
  `dimention` enum('0','1','2-10','11-50','50+') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_unique_votes`
--

LOCK TABLES `stat_report_unique_votes` WRITE;
/*!40000 ALTER TABLE `stat_report_unique_votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_unique_votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_unique_works`
--

DROP TABLE IF EXISTS `stat_report_unique_works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_unique_works` (
  `date` date NOT NULL,
  `dimention` enum('0','1','2-5','6-10','10+') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_unique_works`
--

LOCK TABLES `stat_report_unique_works` WRITE;
/*!40000 ALTER TABLE `stat_report_unique_works` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_unique_works` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_winners_by_prize`
--

DROP TABLE IF EXISTS `stat_report_winners_by_prize`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_winners_by_prize` (
  `date` date NOT NULL,
  `dimention` enum('2 билета','Книга','DVD') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_winners_by_prize`
--

LOCK TABLES `stat_report_winners_by_prize` WRITE;
/*!40000 ALTER TABLE `stat_report_winners_by_prize` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_winners_by_prize` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_works_comments_statuses`
--

DROP TABLE IF EXISTS `stat_report_works_comments_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_works_comments_statuses` (
  `date` date NOT NULL,
  `dimention` enum('Всего отправлено','Принято','Ожидает') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_works_comments_statuses`
--

LOCK TABLES `stat_report_works_comments_statuses` WRITE;
/*!40000 ALTER TABLE `stat_report_works_comments_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_works_comments_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_works_ratings`
--

DROP TABLE IF EXISTS `stat_report_works_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_works_ratings` (
  `date` date NOT NULL,
  `dimention` enum('1','2','3','4','5') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_works_ratings`
--

LOCK TABLES `stat_report_works_ratings` WRITE;
/*!40000 ALTER TABLE `stat_report_works_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_works_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_works_statuses`
--

DROP TABLE IF EXISTS `stat_report_works_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_works_statuses` (
  `date` date NOT NULL,
  `dimention` enum('Всего отправлено','Опубликовано','Отклонено') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_works_statuses`
--

LOCK TABLES `stat_report_works_statuses` WRITE;
/*!40000 ALTER TABLE `stat_report_works_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_works_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_report_x`
--

DROP TABLE IF EXISTS `stat_report_x`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_report_x` (
  `id` smallint(6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `campaign_id` smallint(6) NOT NULL,
  `is_group` tinyint(1) NOT NULL DEFAULT '0',
  `counter_json` varchar(255) NOT NULL,
  `header_json` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_report_x`
--

LOCK TABLES `stat_report_x` WRITE;
/*!40000 ALTER TABLE `stat_report_x` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_report_x` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_unique_user_events`
--

DROP TABLE IF EXISTS `stat_unique_user_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_unique_user_events` (
  `user_id` int(10) unsigned NOT NULL,
  `last_events` tinytext NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_unique_user_events`
--

LOCK TABLES `stat_unique_user_events` WRITE;
/*!40000 ALTER TABLE `stat_unique_user_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_unique_user_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_content`
--

DROP TABLE IF EXISTS `user_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) DEFAULT '',
  `type` char(1) DEFAULT NULL,
  `user` varchar(256) DEFAULT '',
  `resource` text,
  `preview` text,
  `date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_content`
--

LOCK TABLES `user_content` WRITE;
/*!40000 ALTER TABLE `user_content` DISABLE KEYS */;
INSERT INTO `user_content` VALUES (1,'Updated!','i','Stranger','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-11 15:25:50',1),(2,'Updated!','i','Dude','https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSvS6cBb6v39lMzNVGlLmA7PwKpWFgaDMBFGpkPkbB299LW4LPUNg','https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSvS6cBb6v39lMzNVGlLmA7PwKpWFgaDMBFGpkPkbB299LW4LPUNg','2013-02-10 01:39:42',0),(3,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(4,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 02:19:42',2),(5,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',1),(6,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(7,'Hail Caesar','m','AC/DC','/Resources/dc.mp3','http://www.bestmusique.com/demande/pictures/az_B722386_Ballbreaker_ACDC.jpg','2013-02-10 01:39:42',0),(8,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:20',1),(10,'All Along The Watchtower','m','Jimi Hendrix','/Resources/jimi.mp3','/Resources/jimi.jpg','2013-02-10 05:39:42',0),(11,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(12,'The Dude\'s World','v','Dude','/Resources/Big_Buck_Bunny_Trailer.m4v','http://4.bp.blogspot.com/-t0PHPmHSfn0/UNMl1kRoJ0I/AAAAAAAAAxI/Qs-BngZg0XY/s1600/Bolshoy_Bak_Big_Buck_Bunny_2006_DVDRip_1293779284-161361.jpg','2013-02-10 01:39:42',0),(13,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(14,'The Dude\'s World','i','Dude','http://userserve-ak.last.fm/serve/_/65549826/Jeff+Bridges+jeffmusic.jpg','http://userserve-ak.last.fm/serve/_/65549826/Jeff+Bridges+jeffmusic.jpg','2013-02-10 01:39:42',0),(15,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(16,'The Dude\'s World','v','Dude','/Resources/Incredibles_Teaser.m4v','https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcS0RYry8FpFataGf4xAKDvkEZ9YA8HfC2piP8zDQTam6G8-g3f_Iw','2013-02-10 01:29:42',0),(17,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',1),(18,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(19,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(20,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(21,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(22,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(23,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(24,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-12 14:14:35',1),(25,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(26,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(27,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(28,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(29,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(30,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(31,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(32,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(33,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0),(34,'The Dude\'s World','i','Dude','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg','http://bluraymedia.ign.com/bluray/image/article/118/1186178/the-big-lebowski-20110804022636399-000.jpg\n','2013-02-10 01:39:42',0);
/*!40000 ALTER TABLE `user_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_properties`
--

DROP TABLE IF EXISTS `user_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_properties` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `relation` tinyint(1) unsigned DEFAULT NULL,
  `creed` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `description` text,
  `icq` varchar(15) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `critic_company` varchar(255) DEFAULT NULL,
  `know_about_us` varchar(255) DEFAULT NULL,
  `livejournal_login` varchar(255) DEFAULT NULL,
  `livejournal_password` varchar(255) DEFAULT NULL,
  `liveinternet_login` varchar(255) DEFAULT NULL,
  `liveinternet_password` varchar(255) DEFAULT NULL,
  `afisha_city` int(10) unsigned DEFAULT NULL,
  `invite_key` varchar(32) NOT NULL,
  `vkontakte_id` int(11) DEFAULT NULL,
  `moymir_id` bigint(20) unsigned DEFAULT NULL,
  `facebook_id` bigint(20) unsigned DEFAULT NULL,
  `open_id` varchar(127) DEFAULT NULL,
  `rcmd_filter_level` varchar(1024) NOT NULL DEFAULT '',
  `rcmd_filter_styles` varchar(1024) NOT NULL DEFAULT '',
  `rcmd_filter_countries` varchar(1024) NOT NULL DEFAULT '',
  `merge_user_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `vkontakte_id` (`vkontakte_id`),
  UNIQUE KEY `moymir_id` (`moymir_id`),
  UNIQUE KEY `facebook_id` (`facebook_id`),
  UNIQUE KEY `open_id` (`open_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Дополнительные свойства пользователя';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_properties`
--

LOCK TABLES `user_properties` WRITE;
/*!40000 ALTER TABLE `user_properties` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_properties` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-03 15:00:12
