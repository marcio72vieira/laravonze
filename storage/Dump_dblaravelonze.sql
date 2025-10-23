-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: laravelonze
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audits`
--

DROP TABLE IF EXISTS `audits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint unsigned NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audits`
--

LOCK TABLES `audits` WRITE;
/*!40000 ALTER TABLE `audits` DISABLE KEYS */;
INSERT INTO `audits` VALUES (1,'App\\Models\\User',1,'created','App\\Models\\Course',3,'[]','{\"name\":\"AULA DE TESTE\",\"price\":\"5.00\",\"id\":3}','http://localhost:8080/store-course','172.19.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:129.0) Gecko/20100101 Firefox/129.0',NULL,'2024-09-04 17:57:46','2024-09-04 17:57:46'),(2,'App\\Models\\User',1,'deleted','App\\Models\\Course',3,'{\"id\":3,\"name\":\"AULA DE TESTE\",\"price\":5}','[]','http://localhost:8080/destroy-course/3','172.19.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:129.0) Gecko/20100101 Firefox/129.0',NULL,'2024-09-04 17:58:30','2024-09-04 17:58:30'),(3,'App\\Models\\User',1,'created','App\\Models\\User',6,'[]','{\"name\":\"Pedro@celke.com.br\",\"email\":\"pedro@celke.com.br\",\"password\":\"$2y$12$7KQvvZemZJh7IgzMpmtpwuWk\\/MtiuzLN8zNOWUzw3RXhfUC3mhCom\",\"id\":6}','http://localhost:8080/store-user','172.19.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:129.0) Gecko/20100101 Firefox/129.0',NULL,'2024-09-05 15:47:54','2024-09-05 15:47:54'),(4,'App\\Models\\User',1,'updated','App\\Models\\User',6,'{\"name\":\"Pedro@celke.com.br\"}','{\"name\":\"Pedro\"}','http://localhost:8080/update-user/6','172.19.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:129.0) Gecko/20100101 Firefox/129.0',NULL,'2024-09-05 16:36:14','2024-09-05 16:36:14'),(5,'App\\Models\\User',1,'created','App\\Models\\User',7,'[]','{\"name\":\"Mario Gomes\",\"email\":\"mario@celke.com.br\",\"password\":\"$2y$12$OZ9f4EK3FaVOANYzVCrEF.uXv0o9Naoyt\\/RSytkLS4l6j85jZEoH6\",\"id\":7}','http://localhost:8080/store-user','172.19.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:130.0) Gecko/20100101 Firefox/130.0',NULL,'2024-09-25 18:43:28','2024-09-25 18:43:28'),(6,NULL,NULL,'created','App\\Models\\User',8,'[]','{\"name\":\"marciovieira\",\"email\":\"marcio@email.com.br\",\"password\":\"$2y$12$VJz\\/D6Ht4NpTpg7p0XZqY.PiD6xH8ETiBQmeBvtw.ypQzkqcTS9\\/W\",\"id\":8}','http://localhost:8080/store-user-login','172.19.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0',NULL,'2025-05-06 15:30:34','2025-05-06 15:30:34');
/*!40000 ALTER TABLE `audits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('spatie.permission.cache','a:3:{s:5:\"alias\";a:7:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:5:\"group\";s:1:\"c\";s:5:\"title\";s:1:\"d\";s:4:\"name\";s:1:\"e\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";s:1:\"j\";s:11:\"order_roles\";}s:11:\"permissions\";a:29:{i:0;a:6:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"CURSO\";s:1:\"c\";s:13:\"Listar cursos\";s:1:\"d\";s:12:\"index-course\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:2;i:1;i:3;i:2;i:4;}}i:1;a:6:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"CURSO\";s:1:\"c\";s:16:\"Visualizar curso\";s:1:\"d\";s:11:\"show-course\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:2;i:1;i:3;i:2;i:4;}}i:2;a:6:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"CURSO\";s:1:\"c\";s:11:\"Criar curso\";s:1:\"d\";s:13:\"create-course\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:3;a:6:{s:1:\"a\";i:4;s:1:\"b\";s:5:\"CURSO\";s:1:\"c\";s:12:\"Editar curso\";s:1:\"d\";s:11:\"edit-course\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:2;i:1;i:3;i:2;i:4;}}i:4;a:6:{s:1:\"a\";i:5;s:1:\"b\";s:5:\"CURSO\";s:1:\"c\";s:12:\"Apagar curso\";s:1:\"d\";s:14:\"destroy-course\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:5;a:6:{s:1:\"a\";i:6;s:1:\"b\";s:4:\"AULA\";s:1:\"c\";s:12:\"Listar aulas\";s:1:\"d\";s:12:\"index-classe\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:2;i:1;i:3;i:2;i:4;}}i:6;a:6:{s:1:\"a\";i:7;s:1:\"b\";s:4:\"AULA\";s:1:\"c\";s:15:\"Visualizar aula\";s:1:\"d\";s:11:\"show-classe\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:2;i:1;i:3;i:2;i:4;}}i:7;a:6:{s:1:\"a\";i:8;s:1:\"b\";s:4:\"AULA\";s:1:\"c\";s:10:\"Criar aula\";s:1:\"d\";s:13:\"create-classe\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:8;a:6:{s:1:\"a\";i:9;s:1:\"b\";s:4:\"AULA\";s:1:\"c\";s:11:\"Editar aula\";s:1:\"d\";s:11:\"edit-classe\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:2;i:1;i:3;i:2;i:4;}}i:9;a:6:{s:1:\"a\";i:10;s:1:\"b\";s:4:\"AULA\";s:1:\"c\";s:11:\"Apagar aula\";s:1:\"d\";s:14:\"destroy-classe\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:10;a:6:{s:1:\"a\";i:11;s:1:\"b\";s:8:\"USUÁRIO\";s:1:\"c\";s:16:\"Listar usuários\";s:1:\"d\";s:10:\"index-user\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:11;a:6:{s:1:\"a\";i:12;s:1:\"b\";s:8:\"USUÁRIO\";s:1:\"c\";s:19:\"Visualizar usuário\";s:1:\"d\";s:9:\"show-user\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:12;a:6:{s:1:\"a\";i:13;s:1:\"b\";s:8:\"USUÁRIO\";s:1:\"c\";s:14:\"Criar usuário\";s:1:\"d\";s:11:\"create-user\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:13;a:6:{s:1:\"a\";i:14;s:1:\"b\";s:8:\"USUÁRIO\";s:1:\"c\";s:15:\"Editar usuário\";s:1:\"d\";s:9:\"edit-user\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:14;a:5:{s:1:\"a\";i:15;s:1:\"b\";s:8:\"USUÁRIO\";s:1:\"c\";s:24:\"Editar senha do usuário\";s:1:\"d\";s:18:\"edit-user-password\";s:1:\"e\";s:3:\"web\";}i:15;a:5:{s:1:\"a\";i:16;s:1:\"b\";s:8:\"USUÁRIO\";s:1:\"c\";s:15:\"Apagar usuário\";s:1:\"d\";s:12:\"destroy-user\";s:1:\"e\";s:3:\"web\";}i:16;a:5:{s:1:\"a\";i:17;s:1:\"b\";s:8:\"USUÁRIO\";s:1:\"c\";s:23:\"Gerar PDF dos Usuários\";s:1:\"d\";s:17:\"generate-pdf-user\";s:1:\"e\";s:3:\"web\";}i:17;a:6:{s:1:\"a\";i:18;s:1:\"b\";s:5:\"PAPEL\";s:1:\"c\";s:14:\"Listar papéis\";s:1:\"d\";s:10:\"index-role\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:18;a:6:{s:1:\"a\";i:19;s:1:\"b\";s:5:\"PAPEL\";s:1:\"c\";s:16:\"Visualizar papel\";s:1:\"d\";s:9:\"show-role\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:19;a:5:{s:1:\"a\";i:20;s:1:\"b\";s:5:\"PAPEL\";s:1:\"c\";s:11:\"Criar papel\";s:1:\"d\";s:11:\"create-role\";s:1:\"e\";s:3:\"web\";}i:20;a:5:{s:1:\"a\";i:21;s:1:\"b\";s:5:\"PAPEL\";s:1:\"c\";s:12:\"Editar papel\";s:1:\"d\";s:9:\"edit-role\";s:1:\"e\";s:3:\"web\";}i:21;a:5:{s:1:\"a\";i:22;s:1:\"b\";s:5:\"PAPEL\";s:1:\"c\";s:12:\"Apagar papel\";s:1:\"d\";s:12:\"destroy-role\";s:1:\"e\";s:3:\"web\";}i:22;a:6:{s:1:\"a\";i:23;s:1:\"b\";s:5:\"PAPEL\";s:1:\"c\";s:27:\"Listar permissões do papel\";s:1:\"d\";s:21:\"index-role-permission\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:23;a:6:{s:1:\"a\";i:24;s:1:\"b\";s:5:\"PAPEL\";s:1:\"c\";s:26:\"Editar permissão do papel\";s:1:\"d\";s:22:\"update-role-permission\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:24;a:5:{s:1:\"a\";i:25;s:1:\"b\";s:10:\"PERMISSÃO\";s:1:\"c\";s:18:\"Listar Permissões\";s:1:\"d\";s:16:\"index-permission\";s:1:\"e\";s:3:\"web\";}i:25;a:5:{s:1:\"a\";i:26;s:1:\"b\";s:10:\"PERMISSÃO\";s:1:\"c\";s:21:\"Visualizar permissão\";s:1:\"d\";s:15:\"show-permission\";s:1:\"e\";s:3:\"web\";}i:26;a:5:{s:1:\"a\";i:27;s:1:\"b\";s:10:\"PERMISSÃO\";s:1:\"c\";s:16:\"Criar permissão\";s:1:\"d\";s:16:\"store-permission\";s:1:\"e\";s:3:\"web\";}i:27;a:5:{s:1:\"a\";i:28;s:1:\"b\";s:10:\"PERMISSÃO\";s:1:\"c\";s:17:\"Editar permissão\";s:1:\"d\";s:15:\"edit-permission\";s:1:\"e\";s:3:\"web\";}i:28;a:5:{s:1:\"a\";i:29;s:1:\"b\";s:10:\"PERMISSÃO\";s:1:\"c\";s:17:\"Apagar permissão\";s:1:\"d\";s:18:\"destroy-permission\";s:1:\"e\";s:3:\"web\";}}s:5:\"roles\";a:3:{i:0;a:4:{s:1:\"a\";i:2;s:1:\"d\";s:5:\"Admin\";s:1:\"e\";s:3:\"web\";s:1:\"j\";i:2;}i:1;a:4:{s:1:\"a\";i:3;s:1:\"d\";s:9:\"Professor\";s:1:\"e\";s:3:\"web\";s:1:\"j\";i:3;}i:2;a:4:{s:1:\"a\";i:4;s:1:\"d\";s:5:\"Tutor\";s:1:\"e\";s:3:\"web\";s:1:\"j\";i:4;}}}',1761244725);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_classe` int NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classes_course_id_foreign` (`course_id`),
  CONSTRAINT `classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (1,'Aula 1','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, aperiam ratione! Error repellendus commodi magnam eos expedita! Voluptas recusandae magni expedita, iste nihil dicta! Porro tenetur consectetur labore maiores nisi!',1,1,'2024-09-04 14:45:08','2024-09-04 14:45:08'),(2,'Aula 2','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, aperiam ratione! Error repellendus commodi magnam eos expedita! Voluptas recusandae magni expedita, iste nihil dicta! Porro tenetur consectetur labore maiores nisi!',2,1,'2024-09-04 14:45:08','2024-09-04 14:45:08'),(3,'Aula 3','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, aperiam ratione! Error repellendus commodi magnam eos expedita! Voluptas recusandae magni expedita, iste nihil dicta! Porro tenetur consectetur labore maiores nisi!',1,2,'2024-09-04 14:45:08','2024-09-04 14:45:08'),(4,'Aula 4','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, aperiam ratione! Error repellendus commodi magnam eos expedita! Voluptas recusandae magni expedita, iste nihil dicta! Porro tenetur consectetur labore maiores nisi!',2,2,'2024-09-04 14:45:08','2024-09-04 14:45:08');
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Curso de Laravel - T1',197.43,'2024-09-04 14:45:08','2024-09-04 14:45:08'),(2,'Curso de Laravel - T2',247.43,'2024-09-04 14:45:08','2024-09-04 14:45:08');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (13,'0001_01_01_000000_create_users_table',1),(14,'0001_01_01_000001_create_cache_table',1),(15,'0001_01_01_000002_create_jobs_table',1),(16,'2024_07_25_095343_create_courses_table',1),(17,'2024_07_27_172718_alter_courses_add_price_table',1),(18,'2024_07_29_093732_create_classes_table',1),(19,'2024_07_29_105523_alter_classes_add_order_classe_table',1),(20,'2024_08_01_160851_create_audits_table',1),(21,'2024_08_12_160931_create_permission_tables',1),(22,'2024_08_16_094810_alter_permissions_table_add_title_column',1),(23,'2024_08_17_113047_alter_roles_table_add_order_role_column',1),(24,'2024_08_23_144930_create_personal_access_tokens_table',1),(25,'2024_09_04_143600_alter_permissions_table_add_group_column',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
INSERT INTO `model_has_permissions` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',1),(3,'App\\Models\\User',1),(4,'App\\Models\\User',1),(5,'App\\Models\\User',1),(6,'App\\Models\\User',1),(7,'App\\Models\\User',1),(8,'App\\Models\\User',1),(9,'App\\Models\\User',1),(10,'App\\Models\\User',1),(11,'App\\Models\\User',1),(12,'App\\Models\\User',1),(13,'App\\Models\\User',1),(14,'App\\Models\\User',1),(15,'App\\Models\\User',1),(16,'App\\Models\\User',1),(17,'App\\Models\\User',1),(18,'App\\Models\\User',1),(19,'App\\Models\\User',1),(20,'App\\Models\\User',1),(21,'App\\Models\\User',1),(22,'App\\Models\\User',1),(23,'App\\Models\\User',1),(24,'App\\Models\\User',1),(25,'App\\Models\\User',1),(26,'App\\Models\\User',1),(27,'App\\Models\\User',1),(28,'App\\Models\\User',1),(29,'App\\Models\\User',1);
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(3,'App\\Models\\User',3),(4,'App\\Models\\User',4),(5,'App\\Models\\User',5),(3,'App\\Models\\User',6),(5,'App\\Models\\User',7),(5,'App\\Models\\User',8);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'CURSO','Listar cursos','index-course','web','2024-09-04 14:47:57','2024-09-04 14:47:57'),(2,'CURSO','Visualizar curso','show-course','web','2024-09-04 14:47:57','2024-09-04 14:47:57'),(3,'CURSO','Criar curso','create-course','web','2024-09-04 14:47:57','2024-09-04 14:47:57'),(4,'CURSO','Editar curso','edit-course','web','2024-09-04 14:47:58','2024-09-04 14:47:58'),(5,'CURSO','Apagar curso','destroy-course','web','2024-09-04 14:47:58','2024-09-04 14:47:58'),(6,'AULA','Listar aulas','index-classe','web','2024-09-04 14:47:58','2024-09-04 14:47:58'),(7,'AULA','Visualizar aula','show-classe','web','2024-09-04 14:47:59','2024-09-04 14:47:59'),(8,'AULA','Criar aula','create-classe','web','2024-09-04 14:48:00','2024-09-04 14:48:00'),(9,'AULA','Editar aula','edit-classe','web','2024-09-04 14:48:00','2024-09-04 14:48:00'),(10,'AULA','Apagar aula','destroy-classe','web','2024-09-04 14:48:00','2024-09-04 14:48:00'),(11,'USUÁRIO','Listar usuários','index-user','web','2024-09-04 14:48:01','2024-09-04 14:48:01'),(12,'USUÁRIO','Visualizar usuário','show-user','web','2024-09-04 14:48:01','2024-09-04 14:48:01'),(13,'USUÁRIO','Criar usuário','create-user','web','2024-09-04 14:48:01','2024-09-04 14:48:01'),(14,'USUÁRIO','Editar usuário','edit-user','web','2024-09-04 14:48:02','2024-09-04 14:48:02'),(15,'USUÁRIO','Editar senha do usuário','edit-user-password','web','2024-09-04 14:48:02','2024-09-04 14:48:02'),(16,'USUÁRIO','Apagar usuário','destroy-user','web','2024-09-04 14:48:02','2024-09-04 14:48:02'),(17,'USUÁRIO','Gerar PDF dos Usuários','generate-pdf-user','web','2024-09-04 14:48:03','2024-09-04 14:48:03'),(18,'PAPEL','Listar papéis','index-role','web','2024-09-04 14:48:03','2024-09-04 14:48:03'),(19,'PAPEL','Visualizar papel','show-role','web','2024-09-04 14:48:03','2024-09-04 14:48:03'),(20,'PAPEL','Criar papel','create-role','web','2024-09-04 14:48:04','2024-09-04 14:48:04'),(21,'PAPEL','Editar papel','edit-role','web','2024-09-04 14:48:04','2024-09-04 14:48:04'),(22,'PAPEL','Apagar papel','destroy-role','web','2024-09-04 14:48:04','2024-09-04 14:48:04'),(23,'PAPEL','Listar permissões do papel','index-role-permission','web','2024-09-04 14:48:04','2024-09-04 14:48:04'),(24,'PAPEL','Editar permissão do papel','update-role-permission','web','2024-09-04 14:48:05','2024-09-04 14:48:05'),(25,'PERMISSÃO','Listar Permissões','index-permission','web','2024-09-04 15:03:43','2024-09-04 15:04:34'),(26,'PERMISSÃO','Visualizar permissão','show-permission','web','2024-09-04 15:05:15','2024-09-04 15:11:11'),(27,'PERMISSÃO','Criar permissão','store-permission','web','2024-09-04 15:06:10','2024-09-04 15:28:53'),(28,'PERMISSÃO','Editar permissão','edit-permission','web','2024-09-04 15:07:06','2024-09-04 15:14:11'),(29,'PERMISSÃO','Apagar permissão','destroy-permission','web','2024-09-04 15:08:37','2024-09-04 16:15:39');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(18,2),(19,2),(23,2),(24,2),(1,3),(2,3),(3,3),(4,3),(5,3),(6,3),(7,3),(8,3),(9,3),(10,3),(11,3),(12,3),(1,4),(2,4),(4,4),(6,4),(7,4),(9,4);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_roles` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','web',1,'2024-09-04 14:48:05','2024-09-04 14:48:05'),(2,'Admin','web',2,'2024-09-04 14:48:05','2024-09-04 14:48:05'),(3,'Professor','web',3,'2024-09-04 14:48:06','2024-09-04 14:48:06'),(4,'Tutor','web',4,'2024-09-04 14:48:06','2024-09-04 14:48:06'),(5,'Aluno','web',5,'2024-09-04 14:48:06','2024-09-04 14:48:06');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('ZhHkThdayG2fwdvwxw8XiIXhUHAjMqOUuiPR8J7w',NULL,'172.19.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:144.0) Gecko/20100101 Firefox/144.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUExTcExDZ0hpems1ZWF4eWpoZmttbEVPRFpSdmV5TVhHOXFxQmdmMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1761161893);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Marcio','marcio@celke.com.br',NULL,'$2y$12$ZDMqdizFOsMv1ememuztceWfDy3E2yp3MqOqCTznyBdk7o9ZrF2ZG',NULL,'2024-09-04 14:48:07','2024-09-04 14:48:07'),(2,'Kelly','kelly@celke.com.br',NULL,'$2y$12$5BqxRIYz4f9xf81Mf.rIOOYdkMS7fOxB3t0.ePB7lp1wBsM6661ui',NULL,'2024-09-04 14:48:07','2024-09-04 14:48:07'),(3,'Jessica','jessica@celke.com.br',NULL,'$2y$12$IRpvt2ijgfSg9VWj7hfMd.ADxw1jH.miSXqEhB7cSkFuoWd9iDma2',NULL,'2024-09-04 14:48:08','2024-09-04 14:48:08'),(4,'Gabrielly','gabrielly@celke.com.br',NULL,'$2y$12$gJnlcFVf8AAcgyVHyTtOkeUyQNn4cX7PxezMMieJVTNppjwhBFVe2',NULL,'2024-09-04 14:48:08','2024-09-04 14:48:08'),(5,'Marccos','marccos@celke.com.br',NULL,'$2y$12$.VOA2CDhTe9GIfjU.1Ovo.VKiSsxDC3qhI6P/Gdd4mFluMHxtF1xW',NULL,'2024-09-04 14:48:08','2024-09-04 14:48:08'),(6,'Pedro','pedro@celke.com.br',NULL,'$2y$12$7KQvvZemZJh7IgzMpmtpwuWk/MtiuzLN8zNOWUzw3RXhfUC3mhCom',NULL,'2024-09-05 15:47:54','2024-09-05 16:36:14'),(7,'Mario Gomes','mario@celke.com.br',NULL,'$2y$12$OZ9f4EK3FaVOANYzVCrEF.uXv0o9Naoyt/RSytkLS4l6j85jZEoH6',NULL,'2024-09-25 18:43:28','2024-09-25 18:43:28'),(8,'marciovieira','marcio@email.com.br',NULL,'$2y$12$VJz/D6Ht4NpTpg7p0XZqY.PiD6xH8ETiBQmeBvtw.ypQzkqcTS9/W',NULL,'2025-05-06 15:30:33','2025-05-06 15:30:33');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'laravelonze'
--

--
-- Dumping routines for database 'laravelonze'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-23 14:39:54
