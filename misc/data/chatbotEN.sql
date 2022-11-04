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
INSERT INTO `ejercicio` VALUES (1,'[{\"parte\": \"enunciado\", \"texto\": \"Visualizar la información de las columnas de la tabla Clientes.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"Debes usar la clausula describe para conocer los campos de la tabla que buscas\"}, {\"parte\": \"ayuda select\", \"texto\": \"\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"\"}]','2021-04-23 12:33:57','2022-03-16 16:03:26','describe clientes;',1,NULL),(2,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre todos los artículos\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2021-04-23 20:54:30','2022-03-24 16:48:56','select * from articulos;',1,NULL),(3,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre los nombres y apellidos de todos los clientes\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2021-05-06 22:49:39','2022-03-20 10:11:08','select clt_nom, clt_apell from clientes;',1,NULL),(4,'[{\"parte\": \"enunciado\", \"texto\": \"Listado de artículos cuyo peso sea 550 o cuyo color sea blanco\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Si no se especifica ninguna columna en concreto, muéstralas todas\"}, {\"parte\": \"ayuda where\", \"texto\": \"Según especifica el enunciado, debes unir las dos condiciones con OR\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona la tabla necesaria en este ejercicio\"}]','2021-05-06 22:54:49','2022-03-21 09:22:14','select * from articulos where art_peso = 550 or art_col = \'blanco\';',1,NULL),(5,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre todas las columnas de la tabla pesos, para aquellos registros cuyo peso mínimo sea menor a 500 o cuyo peso máximo sea mayor a 2500\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"Deberías usar la cláusula where para poder filtrar\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2021-05-06 23:30:02','2022-03-25 09:46:48','select * from pesos where peso_min < 500 or peso_max > 2500;',1,NULL),(6,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre los nombres de los artículos, sin repeticiones, cuyo peso no sea nulo\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"Deberías usar la cláusula where para poder filtrar\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2021-05-06 23:42:14','2022-03-22 09:51:23','select distinct art_nom from articulos where art_peso is not null;',1,NULL),(7,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre los clientes de la ciudad de Madrid en España.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Si no se especifica ninguna columna en concreto, muéstralas todas\"}, {\"parte\": \"ayuda where\", \"texto\": \"Deberías incluir dos condiciones de filtrado en la cláusula WHERE\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona la tabla necesaria en este ejercicio\"}]','2021-05-07 14:43:07','2022-03-20 10:06:35','select * from clientes where clt_pais = \'e\' and clt_pob = \'madrid\';',1,NULL),(8,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre el nombre de los proveedores ordenados ascendentemente\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"En SELECT muestra solo la única columna que se pide\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"Deberías usar la cláusula order by para poder ordenar el resultado\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona la tabla necesaria en este ejercicio\"}]','2021-05-07 15:07:48','2022-03-21 09:26:08','select prv_nom from proveedores order by prv_nom;',1,NULL),(9,'[{\"parte\": \"enunciado\", \"texto\": \"Listado de tiendas ordenadas descendentemente por nombre de gerente\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"Deberías usar la cláusula order by para poder ordenar el resultado\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2021-05-07 19:19:12','2022-03-24 19:51:05','select * from tiendas order by tda_ger desc;',1,NULL),(10,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre el nombre, peso, color y número de proveedor de los artículos cuyo número de proveedor es menor a 4, ordenados ascendentemente por el peso y descendentemente por el color. El peso debe ser no nulo\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"En SELECT muestra las columnas que se piden y en el orden en que aparecen en el enunciado.\"}, {\"parte\": \"ayuda where\", \"texto\": \"En WHERE filtra los proveedores por código y elimina los de peso nulo\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"Recuerda que si hay más de una columna de ordenación, debes separarlas con una coma\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona la tabla necesaria en este ejercicio\"}]','2021-05-07 19:32:40','2022-03-21 09:28:24','select art_nom, art_peso, art_col, art_prv from articulos where art_prv < 4 and art_peso is not null order by art_peso, art_col desc;',2,NULL),(11,'[{\"parte\": \"enunciado\", \"texto\": \"Listado de clientes cuyo apellido empiece por la letra d\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Si no se especifica ninguna columna en concreto, muéstralas todas\"}, {\"parte\": \"ayuda where\", \"texto\": \"Recuerda que para filtrar por un patrón de texto debes utilizar la cláusula LIKE\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tabla necesaria en este ejercicio\"}]','2021-05-09 15:37:17','2022-03-21 09:20:18','select * from clientes where clt_apell like \'d%\'',1,NULL),(12,'[{\"parte\": \"enunciado\", \"texto\": \"Listado de artículos cuyo color tenga cuatro letras\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"Deberías usar la cláusula where para poder filtrar\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2021-05-09 16:25:33','2022-03-21 09:35:17','select * from articulos where length(art_col) = 4;',2,NULL),(13,'[{\"parte\": \"enunciado\", \"texto\": \"Visualizar el precio de venta del artículo más barato y el más caro de todos los que hay en la tabla artículos. Utiliza los siguientes alias, respectivamente, para las columnas: \'precio más barato\' y \'precio más caro\'\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"En SELECT, introduce las dos funciones pedidas en el enunciado sobre la columna que precio de venta\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"En FROM solo es necesario incorporar la tabla que almacena los artículos\"}]','2021-05-09 16:51:23','2022-03-22 10:00:17','select min(art_pv) as \'precio más barato\', max(art_pv) as \'precio más caro\' from articulos;',2,NULL),(14,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre el nombre de cada artículo junto con la cantidad de artículos con ese nombre que hay. Para la columna del conteo de artículo, utiliza literalmente el siguiente alias: \'número de artículos\'\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"En SELECT, muestra el nombre de los artículos junto con la función necesaria para contar cuántas veces aparece ese artículo\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Deberías usar la cláusula GROUP BY para agrupar por la columna para la que se desea saber la cantidad de artículos que hay\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tabla necesaria en este ejercicio\"}]','2021-05-09 17:02:08','2022-03-22 10:02:39','select art_nom, count(*) as \'número de artículos\' from articulos group by art_nom;',2,NULL),(15,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre para cada nombre de artículo de los almacenados, su precio de coste y de venta medio con un redondeo de dos dígitos. Utiliza, respectivamente, los siguientes alias para estas dos últimas columnas: \'precio de coste medio\' y \'precio de venta medio\'\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Deberías usar la cláusula group by para poder agruparlos\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2021-05-10 11:33:21','2022-03-22 10:05:58','select art_nom, round(avg(art_pc),2) as \'precio de coste medio\', round(avg(art_pv),2) as \'precio de venta medio\' from articulos group by art_nom;',2,NULL),(16,'[{\"parte\": \"enunciado\", \"texto\": \"Visualizar la suma del precio de venta de cada producto en el que la suma es mayor a 2000. La suma debe estar ordenada ascendentemente.\"}, {\"parte\": \"show\", \"texto\": \"Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando\"}, {\"parte\": \"describe\", \"texto\": \"Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos\"}, {\"parte\": \"select\", \"texto\": \"Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"Ahora necesitas agrupar el resultado\"}, {\"parte\": \"having\", \"texto\": \"Ya lo tienes agrupados ahora necesitas aplicarle un filtro a esas agrupaciones\"}, {\"parte\": \"order\", \"texto\": \"Ahora tienes que ordenar el resultado obtenido\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos\"}, {\"parte\": \"ayuda describe\", \"texto\": \"debes usar la clausula describe para conocer los campos de la tabla que buscas\"}, {\"parte\": \"ayuda select\", \"texto\": \"con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Deberías usar la cláusula group by para poder agruparlos\"}, {\"parte\": \"ayuda having\", \"texto\": \"Deberías usar la cláusula having para poder filtrar dentro de los grupos\"}, {\"parte\": \"ayuda order by\", \"texto\": \"Deberías usar la cláusula order by para poder ordenar el resultado\"}]','2021-05-10 17:26:47','2022-03-16 15:53:09','select art_nom, sum(art_pv) as \'suma de precios de venta\' from articulos group by art_nom having sum(art_pv) > 2000 order by sum(art_pv);',2,'2022-03-16 15:53:09'),(17,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre para cada población el número de clientes cuyo nombre empieza por M\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Muestra solo dos columnas, la primera con el nombre de la población y la segunda con el conteo\"}, {\"parte\": \"ayuda where\", \"texto\": \"En WHERE introduce la condición para que solo se consideren los clientes cuyo nombre empieza por M\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Agrupa por la columna para la que se quiere hacer el conteo\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona la tabla necesaria en este ejercicio\"}]','2021-05-10 17:33:43','2022-03-21 09:52:43','select clt_pob, count(*) from clientes where clt_nom like \'m%\' group by clt_pob;',2,NULL),(18,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre el \'número de clientes\' (utilizar como alias) de cada país donde el número de clientes sea mayor que uno y cuyo apellido tenga seis o más letras. Debe estar ordenado por el país ascendentemente.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"Ten en cuenta que debes utilizar una función adecuada para saber el número de caracteres de una cadena. LENGTH() no te servirá porque devuelve el número de bytes de una cadena.\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Deberías usar la cláusula group by para poder agruparlos\"}, {\"parte\": \"ayuda having\", \"texto\": \"Deberías usar la cláusula having para poder filtrar dentro de los grupos\"}, {\"parte\": \"ayuda order by\", \"texto\": \"Deberías usar la cláusula order by para poder ordenar el resultado\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2021-05-10 19:52:42','2022-05-31 12:45:44','select count(*) \'número de clientes\', clt_pais from clientes where char_length(clt_apell) >= 6 group by clt_pais having count(*) > 1 order by clt_pais;',2,NULL),(19,'[{\"parte\": \"enunciado\", \"texto\": \"prueba\"}, {\"parte\": \"show\", \"texto\": \"Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando\"}, {\"parte\": \"describe\", \"texto\": \"Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos\"}, {\"parte\": \"select\", \"texto\": \"Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos\"}, {\"parte\": \"ayuda describe\", \"texto\": \"debes usar la clausula describe para conocer los campos de la tabla que buscas\"}, {\"parte\": \"ayuda select\", \"texto\": \"con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}]','2022-02-04 13:38:20','2022-02-04 13:40:40','select * from ventas;',3,'2022-02-04 13:40:40'),(20,'[{\"parte\": \"enunciado\", \"texto\": \"prueba2\"}, {\"parte\": \"show\", \"texto\": \"Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando\"}, {\"parte\": \"describe\", \"texto\": \"Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos\"}, {\"parte\": \"select\", \"texto\": \"Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos\"}, {\"parte\": \"ayuda describe\", \"texto\": \"debes usar la clausula describe para conocer los campos de la tabla que buscas\"}, {\"parte\": \"ayuda select\", \"texto\": \"con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}]','2022-02-04 13:39:01','2022-02-04 13:40:46','select * from pesos;',3,'2022-02-04 13:40:46'),(21,'[{\"parte\": \"enunciado\", \"texto\": \"prueba3\"}, {\"parte\": \"show\", \"texto\": \"Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando\"}, {\"parte\": \"describe\", \"texto\": \"Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos\"}, {\"parte\": \"select\", \"texto\": \"Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos\"}, {\"parte\": \"ayuda describe\", \"texto\": \"debes usar la clausula describe para conocer los campos de la tabla que buscas\"}, {\"parte\": \"ayuda select\", \"texto\": \"con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}]','2022-02-04 13:39:26','2022-02-04 13:40:49','select * from clientes;',3,'2022-02-04 13:40:49'),(22,'[{\"parte\": \"enunciado\", \"texto\": \"prueba\"}, {\"parte\": \"show\", \"texto\": \"Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando\"}, {\"parte\": \"describe\", \"texto\": \"Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos\"}, {\"parte\": \"select\", \"texto\": \"Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos\"}, {\"parte\": \"ayuda describe\", \"texto\": \"debes usar la clausula describe para conocer los campos de la tabla que buscas\"}, {\"parte\": \"ayuda select\", \"texto\": \"con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}]','2022-02-04 16:02:08','2022-02-04 16:03:00','select * from clientes;',3,'2022-02-04 16:03:00'),(23,'[{\"parte\": \"enunciado\", \"texto\": \"prueba2\"}, {\"parte\": \"show\", \"texto\": \"Escribe la consulta necesaria para mostrar las diferentes tablas en nuestra base dato, e identificar la que estamos buscando\"}, {\"parte\": \"describe\", \"texto\": \"Ahora que sabemos las tablas de las que se componen nuestra base datos, tienes que ver como esta compuesta la tabla que buscamos\"}, {\"parte\": \"select\", \"texto\": \"Ahora que conocemos los campos de los que se componen nuestra tabla tenemos que escoger aquellos que necesitamos\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"Debes escribir la consulta show seguido de tables para ver todas las tablas de la base de datos\"}, {\"parte\": \"ayuda describe\", \"texto\": \"debes usar la clausula describe para conocer los campos de la tabla que buscas\"}, {\"parte\": \"ayuda select\", \"texto\": \"con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}]','2022-02-04 16:02:28','2022-02-04 16:03:04','select * from pesos;',3,'2022-02-04 16:03:04'),(24,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre para cada artículo según su nombre, la suma de los precios de venta. Solo deben mostrarse aquellos cuya suma es mayor a 100. La suma debe estar ordenada ascendentemente\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"En SELECT incluir la columna que se refiere al nombre del artículo, y la función para calcular la suma\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Selecciona cuidadosamente la columna con la que agrupar. Piensa que todos los registros que estén dentro de u grupo deben tener el valor de dicha columna en común\"}, {\"parte\": \"ayuda having\", \"texto\": \"Utiliza HAVING para filtrar a nivel de grupo, en este caso por la suma\"}, {\"parte\": \"ayuda order by\", \"texto\": \"Ordena según la función suma\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona la tabla necesaria en este ejercicio\"}]','2022-03-16 15:55:14','2022-03-21 09:56:33','select art_nom, sum(art_pv) from articulos group by art_nom having sum(art_pv) > 100 order by sum(art_pv);',2,NULL),(25,'[{\"parte\": \"enunciado\", \"texto\": \"Listar los campos de las ventas de los artículos rojos\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"Deberías usar la cláusula where para poder filtrar\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"Deberías usar la cláusula join para hacer la consulta a múltiples tablas.\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2022-03-26 21:48:12','2022-03-26 21:48:12','select ventas.* from ventas inner join articulos on ventas.vnt_art = articulos.art_num where articulos.art_col = \"rojo\";',2,NULL),(26,'[{\"parte\": \"enunciado\", \"texto\": \"Listado de clientes que han comprado entre el 3 de febrero de 2020 y el 17 de febrero  de 2020. El listado deberá mostrar el nombre y apellido del clientes, además de la fecha de compra.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select muestra solo las 3 columnas que se piden, sin alias y en el orden especificado en el enunciado\"}, {\"parte\": \"ayuda where\", \"texto\": \"Deberías usar la cláusula where para poder filtrar. No te olvides de realizar correctamente la unión entre las tablas implicadas.\"}, {\"parte\": \"ayuda group by\", \"texto\": \"\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2022-04-20 07:05:51','2022-04-20 07:05:51','select clt_nom, clt_apell, vnt_fch from clientes, ventas where clt_num = vnt_clt and vnt_fch between \'2020-02-03\' and \'2020-02-17\';',3,NULL),(27,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre la cantidad de compras que ha hecho cada cliente. Se considera que un cliente ha hecho una compra por cada aparición en un registro de la tabla ventas. El listado deberá mostrar 4 columnas: código del cliente, nombre del cliente, apellido del cliente y cantidad de ventas. El listado deberá estar ordenado alfabéticamente por apellido y por nombre de cliente.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites, no se pide que especifiques ningún alias\"}, {\"parte\": \"ayuda where\", \"texto\": \"Deberías usar la cláusula where para poder filtrar y para realizar la unión\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Deberías usar la cláusula group by para poder agruparlos\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"Deberías usar la cláusula order by para poder ordenar el resultado\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2022-05-24 11:48:36','2022-05-24 11:48:36','select clt_num, clt_nom, clt_apell, count(*) from clientes, ventas where clt_num = vnt_clt group by clt_num, clt_nom, clt_apell order by clt_apell, clt_nom;',3,NULL),(28,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre la cantidad de compras que ha hecho cada cliente. Si un cliente no ha realizado ninguna compra, también deberá aparecer en el listado (con un 0 en la columna correspondiente al número de compras). Se considera que un cliente ha hecho una compra por cada aparición en un registro de la tabla ventas. El listado deberá mostrar 4 columnas: código del cliente, nombre del cliente, apellido del cliente y cantidad de ventas. El listado deberá estar ordenado alfabéticamente por apellido y por nombre de cliente.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites, no se pide que especifiques ningún alias\"}, {\"parte\": \"ayuda where\", \"texto\": \"\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Deberías usar la cláusula group by para poder agruparlos\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"Deberías usar la cláusula order by para poder ordenar el resultado\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"Deberías usar la cláusula LEFT OUTER JOIN para la unión externa\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio, pero ten en cuenta que se piden también aquellos clientes QUE NO han comprado\"}]','2022-05-24 11:53:22','2022-05-25 08:30:20','select clt_num, clt_nom, clt_apell, count(vnt_clt) from clientes left outer join ventas on clt_num = vnt_clt group by clt_num, clt_nom, clt_apell order by clt_apell, clt_nom;',3,NULL),(29,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestre aquellos artículos cuya suma de las cantidades vendidas es superior a la suma de las cantidades vendidas del artículo de color azul que más se ha vendido. El listado deberá mostrar 4 columnas: código del artículo, nombre del artículo, color del artículo y suma de las cantidades vendidas de dicho artículo.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites, no se pide que especifiques ningún alias\"}, {\"parte\": \"ayuda where\", \"texto\": \"Deberías usar la cláusula where para poder filtrar y para realizar la unión\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Deberías usar la cláusula group by para poder agruparlos\"}, {\"parte\": \"ayuda having\", \"texto\": \"Deberías usar la cláusula having para poder filtrar dentro de los grupos\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"Debes usar una consulta anidada en el HAVING para filtrar\"}, {\"parte\": \"ayuda join\", \"texto\": \"\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2022-05-24 12:00:13','2022-05-25 09:24:36','select art_num, art_nom, art_col, sum(vnt_cant) from articulos, ventas where art_num = vnt_art group by art_num, art_nom having sum(vnt_cant) > all (select sum(vnt_cant) from ventas, articulos where vnt_art = art_num and art_col = \'azul\' group by vnt_art)',3,NULL),(30,'[{\"parte\": \"enunciado\", \"texto\": \"Listado que muestra todos las columnas de los artículos que sean de color blanco o verde o que no tengan el color definido, junto con la última fecha en que fueron vendidos. Si un artículo no ha sido vendido, también deberá aparecer en listado. En la columna de la fecha de última venta, deberá aparecer \'SIN VENDER\' en caso de que un artículo no haya sido vendido nunca y esta columna deberá tener la cabecera FECHA. Para el resto de columnas, deje la cabecera que viene por defecto.\"}, {\"parte\": \"show\", \"texto\": \"\"}, {\"parte\": \"describe\", \"texto\": \"\"}, {\"parte\": \"select\", \"texto\": \"\"}, {\"parte\": \"where\", \"texto\": \"\"}, {\"parte\": \"group\", \"texto\": \"\"}, {\"parte\": \"having\", \"texto\": \"\"}, {\"parte\": \"order\", \"texto\": \"\"}]','[{\"parte\": \"ayuda show\", \"texto\": \"\"}, {\"parte\": \"ayuda describe\", \"texto\": \"\"}, {\"parte\": \"ayuda select\", \"texto\": \"Con la consulta select busca solo aquellos campos que necesites\"}, {\"parte\": \"ayuda where\", \"texto\": \"Deberías usar la cláusula where para poder filtrar\"}, {\"parte\": \"ayuda group by\", \"texto\": \"Deberías usar la cláusula group by para poder agruparlos\"}, {\"parte\": \"ayuda having\", \"texto\": \"\"}, {\"parte\": \"ayuda order by\", \"texto\": \"\"}, {\"parte\": \"ayuda union\", \"texto\": \"\"}, {\"parte\": \"ayuda anidada\", \"texto\": \"\"}, {\"parte\": \"ayuda join\", \"texto\": \"Deberías usar la cláusula join para hacer la consulta a múltiples tablas.\"}, {\"parte\": \"ayuda from\", \"texto\": \"Selecciona las tablas necesarias en este ejercicio\"}]','2022-05-24 12:17:00','2022-05-28 15:05:17','select articulos.*, ifnull(max(vnt_fch), \'sin vender\') fecha from articulos left outer join ventas on art_num = vnt_art where art_col in (\'blanco\', \'verde\') or art_col is null group by art_num;',3,NULL);
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
  UNIQUE KEY `users_email_unique` (`email`)
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
