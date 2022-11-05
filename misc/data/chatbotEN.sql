-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: chatbotbd
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
-- Table structure for table `conversaciones`
--

DROP TABLE IF EXISTS `conversaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conversaciones` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idWorkspace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensajes` int NOT NULL,
  `request_timestamp` datetime NOT NULL,
  `response_timestamp` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `conversaciones_conversation_id_unique` (`conversation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversaciones`
--

LOCK TABLES `conversaciones` WRITE;
/*!40000 ALTER TABLE `conversaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ejercicio`
--

DROP TABLE IF EXISTS `ejercicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ejercicio` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `enunciado` json NOT NULL,
  `ayuda` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `solucionQuery` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dificultad` tinyint NOT NULL DEFAULT '1' COMMENT '1 - principiante / 2 - media / 3 - alta',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ejercicio`
--

LOCK TABLES `ejercicio` WRITE;
/*!40000 ALTER TABLE `ejercicio` DISABLE KEYS */;
INSERT INTO `ejercicio` VALUES (1,'[{\"parte\": \"enunciado\", \"texto\": \"Display the information in the columns of the table Customers.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"Use the DESCRIBE clause to solve this exercise\"}, {\"parte\": \"ayuda select\", \"texto\": \"\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"\"}]','2021-04-23 12:33:57','2022-03-16 16:03:26','describe customers;',1,NULL),(2,'[{\"parte\": \"enunciado\", \"texto\": \"List all the articles\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Use the SELECT statement to select data from the database.\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Specify the tables with \'FROM\'\"}]','2021-04-23 20:54:30','2022-03-24 16:48:56','select * from articles;',1,NULL),(3,'[{\"parte\": \"enunciado\", \"texto\": \"List the first name and the last name of all customers.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Use the SELECT statement to select data from the database.\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Specify the tables with \'FROM\'\"}]','2021-05-06 22:49:39','2022-03-20 10:11:08','select cus_fn, cus_ln from customers;',1,NULL),(4,'[{\"parte\": \"enunciado\", \"texto\": \"List all the customers whose last name starts with \'D\'\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Select all columns with \'*\'\"}, {\"parte\": \"ayuda where\", \"texto\": \"Use the LIKE clause to solve the exercise. If you don\'t know how to use it, ask me.\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Specify the tables with \'FROM\'\"}]','2021-05-09 15:37:17','2022-03-21 09:20:18','select * from customers where cus_ln like \'d%\'',1,NULL),(5,'[{\"parte\": \"enunciado\", \"texto\": \"List the articles whose colour has four letters\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Select all columns with \'*\'\"}, {\"parte\": \"ayuda where\", \"texto\": \"You should use a function to count the letters of the colours.\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Specify the tables with \'FROM\'\"}]','2021-05-09 16:25:33','2022-03-21 09:35:17','select * from articles where length(art_col) = 4;',2,NULL),(6,'[{\"parte\": \"enunciado\", \"texto\": \"List the number of purchases for each customer. The result-set should have 4 columns: ID, first name, last name and number of purchases. The list must be sorted alphabetically by last name and by first name.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Use the SELECT statement to select data from the database. Don\'t use aliases\"}, {\"parte\": \"ayuda where\", \"texto\": \"You should use the WHERE clause to filter the query.\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Group the rows by cus_num, cus_fn and cus_ln\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"Sort the result-set with the ORDER BY statement.\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Specify the tables with \'FROM\'\"}]','2022-05-24 11:48:36','2022-05-24 11:48:36','select cus_num, cus_fn, cus_ln, count(*) from customers, sales where cus_num = sal_cus group by cus_num, cus_fn, cus_ln order by cus_ln, cus_fn;',3,NULL);
/*!40000 ALTER TABLE `ejercicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuidIntento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ejercicio_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `mensajes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consultas` json DEFAULT NULL,
  `errores` json DEFAULT NULL,
  `conversacion` json DEFAULT NULL,
  `completado` tinyint NOT NULL DEFAULT '1' COMMENT '1 - Sin completar / 2 - Completado',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_ejercicio_id_foreign` (`ejercicio_id`),
  KEY `logs_user_id_foreign` (`user_id`),
  CONSTRAINT `logs_ejercicio_id_foreign` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicio` (`id`),
  CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=431 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mensajes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `log_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `conver_id` int unsigned DEFAULT NULL,
  `textoPregunta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IntencionSeleccionada` json NOT NULL,
  `confianza` double(8,6) NOT NULL,
  `textoRespuesta` json NOT NULL,
  `IntencionesCandidatas` json NOT NULL,
  `error` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensajeLog` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jsonLog` json NOT NULL,
  `request_timestamp` datetime NOT NULL,
  `response_timestamp` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mensajes_log_id_unique` (`log_id`),
  KEY `mensajes_conver_id_foreign` (`conver_id`),
  CONSTRAINT `mensajes_conver_id_foreign` FOREIGN KEY (`conver_id`) REFERENCES `conversaciones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_05_04_151841_creacion_table_ejercicio',1),(4,'2019_07_10_171147_add_solucion_to_ejercicio',1),(5,'2019_08_19_000000_create_failed_jobs_table',1),(6,'2019_08_25_173912_create_conversaciones_table',1),(7,'2019_08_25_173927_create_mensajes_table',1),(8,'2019_10_10_161055_add_es_profesor_to_users',1),(9,'2020_03_28_113530_add_dificultad_to_ejercicio',1),(10,'2020_03_28_120705_add_soft_deletes_to_ejercicio',1),(11,'2020_04_05_165105_add_ejercicios_resuelto_to_user',1),(12,'2020_04_09_174731_add_tutorial_to_users',1),(13,'2020_04_19_095854_create_log_table',1),(14,'2020_05_01_094827_add_alias_to_users',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modolibrelogs`
--

DROP TABLE IF EXISTS `modolibrelogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modolibrelogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuidIntento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `mensajes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consultas` json DEFAULT NULL,
  `errores` json DEFAULT NULL,
  `conversacion` json DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modolibrelogs_user_id_foreign` (`user_id`),
  CONSTRAINT `modolibrelogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `esProfesor` tinyint NOT NULL DEFAULT '0',
  `ejerciciosResueltos` json DEFAULT NULL,
  `tutorial` tinyint NOT NULL DEFAULT '0' COMMENT '0 - no visto tutorial / 1 - visto tutorial',
  `alias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Anonymous User',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=476 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-06 11:14:16
