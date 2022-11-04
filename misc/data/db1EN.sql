-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.20.04.2

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `ART_NUM` int NOT NULL,
  `ART_NAME` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `ART_WEI` int DEFAULT NULL,
  `ART_COL` varchar(7) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `ART_PP` int NOT NULL,
  `ART_SP` int NOT NULL,
  `ART_PRV` int DEFAULT NULL,
  PRIMARY KEY (`ART_NUM`),
  KEY `ART_PRV` (`ART_PRV`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`ART_PRV`) REFERENCES `proveedores` (`PRV_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES
(1, 'printer', 150, 'red', 400, 580, 4),
(2, 'calculator', 150, 'black', 10, 20, 1),
(3, 'calendar', 100, 'white', 1, 4, 4),
(4, 'lamp', 550, 'red', 20, 33, 5),
(5, 'lamp', 550, 'white', 20, 34, 5),
(6, 'lamp', 550, 'blue', 25, 36, 5),
(7, 'lamp', 550, 'green', 25, 37, 5),
(8, 'letter scale 1-500', NULL, NULL, 1, 4, 3),
(9, 'letter scale 1-1000', NULL, NULL, 2, 9, 3),
(10, 'pen', 20, 'red', 0.5, 1, 2),
(11, 'pen', 20, 'blue', 0.5, 1, 2),
(12, 'luxury pen', 20, 'red', 0.6, 3, 2),
(13, 'luxury pen', 20, 'green', 1.99, 3.99, 2),
(14, 'luxury pen', 20, 'blue', 1.99, 4.99, 2),
(15, 'luxury pen', 20, 'black', 1.99, 4.99, 2),
(16, 'paper', 5000, 'pink', 3, 6, 2),
(17, 'stapler', 1000, 'green', 12, 15.60, 3),
(18, 'printer', 200, 'purple', 390, 540, 3),
(19, 'calendar', 110, 'black', 0.6, 2.5, 4),
(20, 'blanket', NULL, 'mauve', 15, 25, 10),
(69, 'paper', NULL, 'pink', 3.15, 5.25, NULL),
(99, 'paper', 800, 'purple', 3.18, 5.98, 1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `CUS_NUM` int NOT NULL,
  `CUS_LN` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `CUS_FN` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `CUS_COU` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `CUS_CITY` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`CUS_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES
(1, 'Borrás', 'Margarita', 'e', 'Madrid'),
(2, 'Pérez', 'Miguel', 'e', 'Madrid'),
(3, 'Dupont', 'Jean', 'f', 'Paris'),
(4, 'Dupreit', 'Michel', 'f', 'Lyon'),
(5, 'Llopis', 'Antoni', 'e', 'Barcelona'),
(6, 'Souris', 'Marcel', 'f', 'Paris'),
(7, 'Gómez', 'Pablo', 'e', 'Pamplona'),
(8, 'Courbon', 'Gerard', 'f', 'Marseille'),
(9, 'Román', 'Consuelo', 'e', 'Jaen'),
(10, 'Roca', 'Pau', 'e', 'Gerona'),
(11, 'Mancha', 'Jorge', 'e', 'Valencia'),
(12, 'Curro', 'Pablo', 'e', 'Barcelona'),
(13, 'Cortés', 'Diego', 'e', 'Madrid'),
(14, 'Fernández', 'Joaquín', 'c', 'Madrid'),
(15, 'Durán', 'Jacinto', 'e', 'Pamplona'),
(16, 'Minguín', 'Pedro', 'e', 'Pamplona'),
(17, 'Ubrique', 'Jesús', 'e', 'Pamplona'),
(18, 'Mazapato', 'Sophie', 'e', 'Madrid'),
(19, 'Bigote', 'Jose Mari', 'p', 'Oporto'),
(20, 'Dalima', 'Romualdo', 'b', 'San Jose'),
(21, 'Clavel rojo', 'Paco', 'e', 'Oviedo'),
(22, 'Alonso', 'Fernando', 'e', 'Gijon'),
(23, 'Rodríguez', 'Pedrito', 'e', 'Arico'),
(24, 'Florero', 'Mar', 'e', 'Madrid'),
(25, 'Florero', 'Mar', 'e', 'Barcelona'),
(26, 'Peralta', 'Leo', 'a', 'Rosario');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `EMP_ID` int NOT NULL AUTO_INCREMENT,
  `EMP_LN` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `EMP_FN` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `EMP_ADDR1` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `EMP_ADDR2` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `EMP_CITY` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `EMP_PROV` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `EMP_COU` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `EMP_ZIP` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `EMP_SEX` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `EMP_BIRTH` date DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Polly','Parrot','42 The Lane',NULL,'Some Town','Noshire','gb','AB1 2XY','female','1970-12-31'),(2,'Mabel','Canary','24 The Street','Some Village','Some Town','Noshire','gb','AB1 2YZ','other','1968-01-23'),(3,'Zöe','Zebra','856 The Avenue',NULL,'Some City','CA','us','123456','female','1989-07-16'),(4,'José','Arara','Nenhuma Rua',NULL,'São Paulo',NULL,'br','123457','male','1991-05-30'),(5,'Dickie','Duck','1 The Street','Another Village','Some City','Imagineshire','gb','YZ1 2AB','male','1952-11-25'),(6,'Fred','Canary','24 The Street','Some Village','Some Town','Noshire','gb','AB1 2YZ','male','1967-08-04');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paises` (
  `COU_ID` int NOT NULL AUTO_INCREMENT,
  `COU_ISO` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `COU_NAME` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`COU_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'AF','Afghanistan'),(2,'AX','Aland Islands'),(3,'AL','Albania'),(4,'DE','Germany'),(5,'AD','Andorra'),(6,'AO','Angola'),(7,'AI','Anguilla'),(8,'AQ','Antarctica'),(9,'AG','Antigua and Barbuda'),(10,'AN','Netherlands Antilles'),(11,'SA','Saudi Arabia'),(12,'DZ','Argelia'),(13,'AR','Argentina'),(14,'AM','Armenia'),(15,'AW','Aruba'),(16,'AU','Australia'),(17,'AT','Austria'),(18,'AZ','Azerbaijan'),(19,'BS','Bahamas'),(20,'BH','Bahrain'),(21,'BD','Bangladesh'),(22,'BB','Barbados'),(23,'BY','Belarus'),(24,'BE','Belgium'),(25,'BZ','Belize'),(26,'BJ','Benin'),(27,'BM','Bermuda'),(28,'BT','Bhutan'),(29,'BO','Bolivia'),(30,'BA','Bosnia and Herzegovina'),(31,'BW','Botswana'),(32,'BV','Bouvet Island'),(33,'BR','Brazil'),(34,'BN','Brunei'),(35,'BG','Bulgaria'),(36,'BF','Burkina Faso'),(37,'BI','Burundi'),(38,'CV','Cabo Verde'),(39,'KY','Cayman Islands'),(40,'KH','Cambodia'),(41,'CM','Cameroon'),(42,'CA','Canada'),(43,'CF','Central African Republic'),(44,'TD','Chad'),(45,'CZ','Czech Republic'),(46,'CL','Chile'),(47,'CN','China'),(48,'CY','Cyprus'),(49,'CX','Christmas Island'),(50,'VA','Holy See'),(51,'CC','Cocos Island'),(52,'CO','Colombia'),(53,'KM','Comoros'),(54,'CD','Democratic Republic of the Congo'),(55,'CG','Congo'),(56,'CK','Cook Islands'),(57,'KP','DPR Korea'),(58,'KR','Republic of Korea'),(59,'CI','Ivory Coast'),(60,'CR','Costa Rica'),(61,'HR','Croatia'),(62,'CU','Cuba'),(63,'DK','Denmark'),(64,'DM','Dominica'),(65,'DO','Dominican Republic'),(66,'EC','Ecuador'),(67,'EG','Egypt'),(68,'SV','El Salvador'),(69,'AE','EUnited Arab Emirates'),(70,'ER','Eritrea'),(71,'SK','Slovakia'),(72,'SI','Slovenia'),(73,'ES','Spain'),(74,'UM','United States Minor Outlying Islands'),(75,'US','United States'),(76,'EE','Estonia'),(77,'ET','Ethiopia'),(78,'FO','Faroe Islands'),(79,'PH','Philippines'),(80,'FI','Finland'),(81,'FJ','Fiji'),(82,'FR','France'),(83,'GA','Gabon'),(84,'GM','Gambia'),(85,'GE','Georgia'),(86,'GS','South Georgia and the South Sandwich Islands'),(87,'GH','Ghana'),(88,'GI','Gibraltar'),(89,'GD','Grenada'),(90,'GR','Greece'),(91,'GL','Greenland'),(92,'GP','Guadeloupe'),(93,'GU','Guam'),(94,'GT','Guatemala'),(95,'GF','French Guiana'),(96,'GN','Guinea'),(97,'GQ','Equatorial Guinea'),(98,'GW','Guinea-Bissau'),(99,'GY','Guyana'),(100,'HT','Haiti'),(101,'HM','Heard Island and McDonald Islands'),(102,'HN','Honduras'),(103,'HK','Hong Kong'),(104,'HU','Hungary'),(105,'IN','India'),(106,'ID','Indonesia'),(107,'IR','Iran'),(108,'IQ','Iraq'),(109,'IE','Ireland'),(110,'IS','Iceland'),(111,'IL','Israel'),(112,'IT','Italia'),(113,'JM','Jamaica'),(114,'JP','Japan'),(115,'JO','Jordan'),(116,'KZ','Kazakhstan'),(117,'KE','Kenya'),(118,'KG','Kyrgyztan'),(119,'KI','Kiribati'),(120,'KW','Kuwait'),(121,'LA','Laos'),(122,'LS','Lesotho'),(123,'LV','Latvia'),(124,'LB','Lebanon'),(125,'LR','Liberia'),(126,'LY','Libya'),(127,'LI','Liechtenstein'),(128,'LT','Lithuania'),(129,'LU','Luxembourg'),(130,'MO','Macao'),(131,'MK','North Macedonia'),(132,'MG','Madagascar'),(133,'MY','Malaysia'),(134,'MW','Malawi'),(135,'MV','Maldives'),(136,'ML','Mali'),(137,'MT','Malta'),(138,'FK','Falkland Islands (Malvinas)'),(139,'MP','Northern Mariana Islands'),(140,'MA','Morocco'),(141,'MH','Marshall Islands'),(142,'MQ','Martinique'),(143,'MU','Mauritius'),(144,'MR','Mauritania'),(145,'YT','Mayotte'),(146,'MX','Mexico'),(147,'FM','Micronesia'),(148,'MD','Moldova'),(149,'MC','Monaco'),(150,'MN','Mongolia'),(151,'MS','Montserrat'),(152,'MZ','Mozambique'),(153,'MM','Myanmar'),(154,'NA','Namibia'),(155,'NR','Nauru'),(156,'NP','Nepal'),(157,'NI','Nicaragua'),(158,'NE','Niger'),(159,'NG','Nigeria'),(160,'NU','Niue'),(161,'NF','Norfolk Island'),(162,'NO','Norway'),(163,'NC','New Caledonia'),(164,'NZ','New Zealand'),(165,'OM','Oman'),(166,'NL','Netherlands'),(167,'PK','Pakistan'),(168,'PW','Palau'),(169,'PS','Palestine'),(170,'PA','Panama'),(171,'PG','Papua New Guinea'),(172,'PY','Paraguay'),(173,'PE','Peru'),(174,'PN','Pitcairn'),(175,'PF','French Polynesia'),(176,'PL','Poland'),(177,'PT','Portugal'),(178,'PR','Puerto Rico'),(179,'QA','Qatar'),(180,'GB','United Kingdom'),(181,'RE','Réunion'),(182,'RW','Rwanda'),(183,'RO','Romania'),(184,'RU','Russia'),(185,'EH','Western Sahara'),(186,'SB','Solomon Islands'),(187,'WS','Samoa'),(188,'AS','American Samoa'),(189,'KN','Saint Kitts and Nevis'),(190,'SM','San Marino'),(191,'PM','Saint Pierre y Miquelon'),(192,'VC','Saint Vincent and the Grenadines'),(193,'SH','Saint Helena'),(194,'LC','Saint Lucia'),(195,'ST','Sao Tome and Principe'),(196,'SN','Senegal'),(197,'RS','Serbia'),(198,'SC','Seychelles'),(199,'SL','Sierra Leone'),(200,'SG','Singapore'),(201,'SY','Syria'),(202,'SO','Somalia'),(203,'LK','Sri Lanka'),(204,'SZ','Suazilandia'),(205,'ZA','Sudáfrica'),(206,'SD','Sudan'),(207,'SE','Sweden'),(208,'CH','Switzerland'),(209,'SR','Suriname'),(210,'SJ','Svalbard and Jan Mayen'),(211,'TH','Thailand'),(212,'TW','Taiwan'),(213,'TZ','Tanzania'),(214,'TJ','Tajikistan'),(215,'IO','British Indian Ocean Territory'),(216,'TF','French Southern Territories'),(217,'TL','Timor-Leste'),(218,'TG','Togo'),(219,'TK','Tokelau'),(220,'TO','Tonga'),(221,'TT','Trinidad and Tobago'),(222,'TN','Tunisia'),(223,'TC','Turks and Caicos Islands'),(224,'TM','Turkmenistan'),(225,'TR','Turkey'),(226,'TV','Tuvalu'),(227,'UA','Ukraine'),(228,'UG','Uganda'),(229,'UY','Uruguay'),(230,'UZ','Uzbekistan'),(231,'VU','Vanuatu'),(232,'VE','Venezuela'),(233,'VN','Vietnam'),(234,'VG','Virgin Islands (UK)'),(235,'VI','Virgin Islands (US)'),(236,'WF','Wallis and Futuna'),(237,'YE','Yemen'),(238,'DJ','Djibouti'),(239,'ZM','Zambia'),(240,'ZW','Zimbabwe');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weights`
--

DROP TABLE IF EXISTS `weights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `weights` (
  `WEI_NAME` varchar(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `WEI_MIN` int NOT NULL,
  `WEI_MAX` int NOT NULL,
  PRIMARY KEY (`WEI_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weights`
--

LOCK TABLES `weights` WRITE;
/*!40000 ALTER TABLE `weights` DISABLE KEYS */;
INSERT INTO `pesos` VALUES ('extremely light', 1, 100),('light', 101, 500),('medium', 501, 2500),('heavy', 2501, 5000),('weightless', 0, 0);
/*!40000 ALTER TABLE `weights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `PRV_NUM` int NOT NULL,
  `PRV_NAME` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`PRV_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `providers`
--

LOCK TABLES `providers` WRITE;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` VALUES (1,'Catio Electronic'),(2,'United Styles'),(3,'Technohit'),(4,'Sanjita'),(5,'electrolamp'),(6,'CopyShop'),(7,'Armanzon'),(8,'Mercadiz'),(9,'Fedmarket'),(10,'Sonyk');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stores` (
  `STO_NUM` int NOT NULL,
  `STO_CITY` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `STO_BOSS` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`STO_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES
(1, 'Madrid-1', 'Contesfosques, Jordi'),
(2, 'Madrid-2', 'Martinez, Juan'),
(3, 'Pamplona', 'Dominguez, Julian'),
(4, 'Barcelona', 'Pega, Jose Maria'),
(5, 'Trujillo', 'Mendez, Pedro'),
(6, 'Jaen', 'Marin, Raquel'),
(7, 'Valencia', 'Petit, Joan'),
(8, 'Requena', 'Marcos, Pilar'),
(9, 'Palencia', 'Castroviejo, Lozano'),
(10, 'Gerona', 'Gomez, Gabriel'),
(11, 'Lyon', 'Madoux, Jean'),
(12, 'Paris', 'Fouet, Paul'),
(13, 'Jerez', 'Peralta, Leo');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `SAL_CUS` int NOT NULL,
  `SAL_STO` int NOT NULL,
  `SAL_ART` int NOT NULL,
  `SAL_QUA` int DEFAULT NULL,
  `SAL_PRI` int DEFAULT NULL,
  `SAL_DATE` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  KEY `SAL_CUS` (`VNT_CUS`),
  KEY `SAL_STO` (`VNT_STO`),
  KEY `SAL_ART` (`VNT_ART`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`SAL_CUS`) REFERENCES `customers` (`CUS_NUM`),
  CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`SAL_STO`) REFERENCES `stores` (`STO_NUM`),
  CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`SAL_ART`) REFERENCES `articles` (`ART_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES
(22, 10, 17, 1,  '20191006'),
(5, 4, 4, 1, '20191015'), 
(7, 3, 10, 1, '20191015'),
(7, 3, 11, 2, '20191015'),
(7, 3, 14, 3, '20191016'),
(8, 11, 2, 1, '20191025'),
(6, 12, 3, 2, '20191030'),
(6, 12, 15, 2, '20191102'),
(13, 1, 4, 1, '20191102'),
(13, 1, 3, 1, '20191105'),
(1, 2, 2, 1, '20191109'),
(1, 2, 12, 1, '20191202'),
(1, 2, 13, 10, '20191212'),
(4, 11, 1, 8, '20191222'),
(4, 11, 10, 7, '20191223'),
(3, 7, 6, 1, '20200111'),
(3, 7, 9, 2, '20200111'),
(1, 2, 3, 3, '20200120'),
(7, 8, 3, 1, '20200203'),
(4, 5, 3, 6, '20200204'),
(10, 11, 3, 1, '20200206'),
(6, 7, 3, 1, '20200211'),
(3, 4, 3, 2, '20200216'),
(9, 10, 3, 1, '20200221'),
(2, 3, 3, 4, '20200222'),
(8, 9, 3, 1, '20200229'),
(5, 6, 3, 3, '20200229'),
(26, 4, 17, 2, '20200302'),
(19, 7, 3, 1, '20200303'),
(17, 4, 3, 10, '20200303'),
(18, 1, 3, 1, '20200303'),
(10, 4, 2, NULL, '20200303'),
(3, 13, 3, NULL, '20200303');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-06 11:16:26
