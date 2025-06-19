-- MySQL dump 10.13  Distrib 8.0.41, for Linux (x86_64)
--
-- Host: localhost    Database: kgb
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `balita`
--

DROP TABLE IF EXISTS `balita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `balita` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_orang_tua` bigint unsigned NOT NULL,
  `id_desa` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `balita_nik_unique` (`nik`),
  KEY `balita_id_orang_tua_foreign` (`id_orang_tua`),
  KEY `balita_id_desa_foreign` (`id_desa`),
  KEY `balita_nama_nik_index` (`nama`,`nik`),
  CONSTRAINT `balita_id_desa_foreign` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id`) ON DELETE SET NULL,
  CONSTRAINT `balita_id_orang_tua_foreign` FOREIGN KEY (`id_orang_tua`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `balita`
--

LOCK TABLES `balita` WRITE;
/*!40000 ALTER TABLE `balita` DISABLE KEYS */;
INSERT INTO `balita` VALUES (1,'1201021','ucup','2025-05-25',4,1,'2025-06-03 16:26:38','2025-06-03 16:26:38');
/*!40000 ALTER TABLE `balita` ENABLE KEYS */;
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
INSERT INTO `cache` VALUES ('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3','i:2;',1749815278),('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer','i:1749815278;',1749815278);
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
-- Table structure for table `data_latih`
--

DROP TABLE IF EXISTS `data_latih`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_latih` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` int NOT NULL,
  `berat` decimal(4,2) NOT NULL,
  `tinggi` decimal(4,2) NOT NULL,
  `status` enum('stunting','underweight','normal','wasting','overweight') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_latih_nama_index` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_latih`
--

LOCK TABLES `data_latih` WRITE;
/*!40000 ALTER TABLE `data_latih` DISABLE KEYS */;
INSERT INTO `data_latih` VALUES (1,'Lafania',39,13.00,91.70,'normal',NULL,NULL),(2,'Syaidan',50,15.20,96.30,'underweight',NULL,NULL),(3,'Fzaizun',37,13.20,89.60,'normal',NULL,NULL),(4,'Kamila',48,13.60,95.70,'normal',NULL,NULL),(5,'Kayla',18,9.50,79.40,'wasting',NULL,NULL),(6,'Gibran',12,8.40,72.50,'overweight',NULL,NULL),(7,'Albais',49,14.50,95.60,'normal',NULL,NULL),(8,'Abizar',45,13.60,96.30,'stunting',NULL,NULL);
/*!40000 ALTER TABLE `data_latih` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desa`
--

DROP TABLE IF EXISTS `desa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `desa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desa`
--

LOCK TABLES `desa` WRITE;
/*!40000 ALTER TABLE `desa` DISABLE KEYS */;
INSERT INTO `desa` VALUES (1,'Papalia','2025-05-21 05:43:45','2025-05-21 05:43:45'),(2,'Anewoi','2025-05-21 05:43:45','2025-05-21 05:43:45');
/*!40000 ALTER TABLE `desa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exports`
--

DROP TABLE IF EXISTS `exports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `completed_at` timestamp NULL DEFAULT NULL,
  `file_disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exporter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_rows` int unsigned NOT NULL DEFAULT '0',
  `total_rows` int unsigned NOT NULL,
  `successful_rows` int unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exports_user_id_foreign` (`user_id`),
  CONSTRAINT `exports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exports`
--

LOCK TABLES `exports` WRITE;
/*!40000 ALTER TABLE `exports` DISABLE KEYS */;
/*!40000 ALTER TABLE `exports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_import_rows`
--

DROP TABLE IF EXISTS `failed_import_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_import_rows` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data` json NOT NULL,
  `import_id` bigint unsigned NOT NULL,
  `validation_error` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `failed_import_rows_import_id_foreign` (`import_id`),
  CONSTRAINT `failed_import_rows_import_id_foreign` FOREIGN KEY (`import_id`) REFERENCES `imports` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_import_rows`
--

LOCK TABLES `failed_import_rows` WRITE;
/*!40000 ALTER TABLE `failed_import_rows` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_import_rows` ENABLE KEYS */;
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
-- Table structure for table `imports`
--

DROP TABLE IF EXISTS `imports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `completed_at` timestamp NULL DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `importer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_rows` int unsigned NOT NULL DEFAULT '0',
  `total_rows` int unsigned NOT NULL,
  `successful_rows` int unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `imports_user_id_foreign` (`user_id`),
  CONSTRAINT `imports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imports`
--

LOCK TABLES `imports` WRITE;
/*!40000 ALTER TABLE `imports` DISABLE KEYS */;
/*!40000 ALTER TABLE `imports` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000001_create_cache_table',1),(2,'0001_01_01_000002_create_jobs_table',1),(3,'0001_01_02_000000_create_desa_table',1),(4,'0001_01_03_000000_create_users_table',1),(5,'2025_03_22_104956_create_balita_table',1),(6,'2025_03_22_114428_create_riwayat_pemeriksaan_table',1),(7,'2025_03_24_133256_create_data_latih_table',1),(8,'2025_03_26_104851_create_standar_berat_who_table',1),(9,'2025_03_29_104231_create_notifications_table',1),(10,'2025_03_29_104332_create_imports_table',1),(11,'2025_03_29_104333_create_exports_table',1),(12,'2025_03_29_104334_create_failed_import_rows_table',1),(13,'2025_04_01_111322_create_standar_tinggi_who_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
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
-- Table structure for table `riwayat_pemeriksaan`
--

DROP TABLE IF EXISTS `riwayat_pemeriksaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `riwayat_pemeriksaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_balita` bigint unsigned NOT NULL,
  `berat` double NOT NULL,
  `tinggi` double NOT NULL,
  `umur` int NOT NULL,
  `status_gizi` enum('Stunting','Underweight','Normal','Wasting','Overweight') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `riwayat_pemeriksaan_id_balita_foreign` (`id_balita`),
  CONSTRAINT `riwayat_pemeriksaan_id_balita_foreign` FOREIGN KEY (`id_balita`) REFERENCES `balita` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat_pemeriksaan`
--

LOCK TABLES `riwayat_pemeriksaan` WRITE;
/*!40000 ALTER TABLE `riwayat_pemeriksaan` DISABLE KEYS */;
INSERT INTO `riwayat_pemeriksaan` VALUES (1,1,21,21,1,'Overweight','2025-06-03 16:27:15','2025-06-03 16:27:15');
/*!40000 ALTER TABLE `riwayat_pemeriksaan` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('1CXFN5Ip1mRT5W0MS7dS7QDeMYyjCugbUJVEopel',2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:138.0) Gecko/20100101 Firefox/138.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoidVM3ZGFtOHh4TFJ3MEwzNGM1bnE5MWVRMVcwalVYaFg0dzB5dVhCYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkRHhXaUx4bmFwdkRFcWl6WXFQVE1QdXpTbFV4SWVjNERtLmZSamFRUjViNmFORUs3RjdLT08iO30=',1749642541),('JBSVhorOnrZPYxHU4NngfpDAwEroNxactVwBUlba',2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:138.0) Gecko/20100101 Firefox/138.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNExhTGF0bmQyMk1JRkhQVGFmQXlONnByOFo3SzdSUlRiQTVMRHFseiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMS9hZG1pbi9kZXNhcy8xL2VkaXQiO31zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJER4V2lMeG5hcHZERXFpellxUFRNUHV6U2xVeEllYzREbS5mUmphUVI1YjZhTkVLN0Y3S09PIjt9',1749815263);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `standar_berat_who`
--

DROP TABLE IF EXISTS `standar_berat_who`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `standar_berat_who` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SD3neg` double NOT NULL,
  `SD2neg` double NOT NULL,
  `SD1neg` double NOT NULL,
  `SD0` double NOT NULL,
  `SD1` double NOT NULL,
  `SD2` double NOT NULL,
  `SD3` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `standar_berat_who_bulan_unique` (`bulan`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `standar_berat_who`
--

LOCK TABLES `standar_berat_who` WRITE;
/*!40000 ALTER TABLE `standar_berat_who` DISABLE KEYS */;
INSERT INTO `standar_berat_who` VALUES (1,'0',2.1,2.5,2.9,3.3,3.9,4.4,5,NULL,NULL),(2,'1',2.9,3.4,3.9,4.5,5.1,5.8,6.6,NULL,NULL),(3,'2',3.8,4.3,4.9,5.6,6.3,7.1,8,NULL,NULL),(4,'3',4.4,5,5.7,6.4,7.2,8,9,NULL,NULL),(5,'4',4.9,5.6,6.2,7,7.8,8.7,9.7,NULL,NULL),(6,'5',5.3,6,6.7,7.5,8.4,9.3,10.4,NULL,NULL),(7,'6',5.7,6.4,7.1,7.9,8.8,9.8,10.9,NULL,NULL),(8,'7',5.9,6.7,7.4,8.3,9.2,10.3,11.4,NULL,NULL),(9,'8',6.2,6.9,7.7,8.6,9.6,10.7,11.9,NULL,NULL),(10,'9',6.4,7.1,8,8.9,9.9,11,12.3,NULL,NULL),(11,'10',6.6,7.4,8.2,9.2,10.2,11.4,12.7,NULL,NULL),(12,'11',6.8,7.6,8.4,9.4,10.5,11.7,13,NULL,NULL),(13,'12',6.9,7.7,8.6,9.6,10.8,12,13.3,NULL,NULL),(14,'13',7.1,7.9,8.8,9.9,11,12.3,13.7,NULL,NULL),(15,'14',7.2,8.1,9,10.1,11.3,12.6,14,NULL,NULL),(16,'15',7.4,8.3,9.2,10.3,11.5,12.8,14.3,NULL,NULL),(17,'16',7.5,8.4,9.4,10.5,11.7,13.1,14.6,NULL,NULL),(18,'17',7.7,8.6,9.6,10.7,12,13.4,14.9,NULL,NULL),(19,'18',7.8,8.8,9.8,10.9,12.2,13.7,15.3,NULL,NULL),(20,'19',8,8.9,10,11.1,12.5,13.9,15.6,NULL,NULL),(21,'20',8.1,9.1,10.1,11.3,12.7,14.2,15.9,NULL,NULL),(22,'21',8.2,9.2,10.3,11.5,12.9,14.5,16.2,NULL,NULL),(23,'22',8.4,9.4,10.5,11.8,13.2,14.7,16.5,NULL,NULL),(24,'23',8.5,9.5,10.7,12,13.4,15,16.8,NULL,NULL),(25,'24',8.6,9.7,10.8,12.2,13.6,15.3,17.1,NULL,NULL),(26,'25',8.8,9.8,11,12.4,13.9,15.5,17.5,NULL,NULL),(27,'26',8.9,10,11.2,12.5,14.1,15.8,17.8,NULL,NULL),(28,'27',9,10.1,11.3,12.7,14.3,16.1,18.1,NULL,NULL),(29,'28',9.1,10.2,11.5,12.9,14.5,16.3,18.4,NULL,NULL),(30,'29',9.2,10.4,11.7,13.1,14.8,16.6,18.7,NULL,NULL),(31,'30',9.4,10.5,11.8,13.3,15,16.9,19,NULL,NULL),(32,'31',9.5,10.7,12,13.5,15.2,17.1,19.3,NULL,NULL),(33,'32',9.6,10.8,12.1,13.7,15.4,17.4,19.6,NULL,NULL),(34,'33',9.7,10.9,12.3,13.8,15.6,17.6,19.9,NULL,NULL),(35,'34',9.8,11,12.4,14,15.8,17.8,20.2,NULL,NULL),(36,'35',9.9,11.2,12.6,14.2,16,18.1,20.4,NULL,NULL),(37,'36',10,11.3,12.7,14.3,16.2,18.3,20.7,NULL,NULL),(38,'37',10.1,11.4,12.9,14.5,16.4,18.6,21,NULL,NULL),(39,'38',10.2,11.5,13,14.7,16.6,18.8,21.3,NULL,NULL),(40,'39',10.3,11.6,13.1,14.8,16.8,19,21.6,NULL,NULL),(41,'40',10.4,11.8,13.3,15,17,19.3,21.9,NULL,NULL),(42,'41',10.5,11.9,13.4,15.2,17.2,19.5,22.1,NULL,NULL),(43,'42',10.6,12,13.6,15.3,17.4,19.7,22.4,NULL,NULL),(44,'43',10.7,12.1,13.7,15.5,17.6,20,22.7,NULL,NULL),(45,'44',10.8,12.2,13.8,15.7,17.8,20.2,23,NULL,NULL),(46,'45',10.9,12.4,14,15.8,18,20.5,23.3,NULL,NULL),(47,'46',11,12.5,14.1,16,18.2,20.7,23.6,NULL,NULL),(48,'47',11.1,12.6,14.3,16.2,18.4,20.9,23.9,NULL,NULL),(49,'48',11.2,12.7,14.4,16.3,18.6,21.2,24.2,NULL,NULL),(50,'49',11.3,12.8,14.5,16.5,18.8,21.4,24.5,NULL,NULL),(51,'50',11.4,12.9,14.7,16.7,19,21.7,24.8,NULL,NULL),(52,'51',11.5,13.1,14.8,16.8,19.2,21.9,25.1,NULL,NULL),(53,'52',11.6,13.2,15,17,19.4,22.2,25.4,NULL,NULL),(54,'53',11.7,13.3,15.1,17.2,19.6,22.4,25.7,NULL,NULL),(55,'54',11.8,13.4,15.2,17.3,19.8,22.7,26,NULL,NULL),(56,'55',11.9,13.5,15.4,17.5,20,22.9,26.3,NULL,NULL),(57,'56',12,13.6,15.5,17.7,20.2,23.2,26.6,NULL,NULL),(58,'57',12.1,13.7,15.6,17.8,20.4,23.4,26.9,NULL,NULL),(59,'58',12.2,13.8,15.8,18,20.6,23.7,27.2,NULL,NULL),(60,'59',12.3,14,15.9,18.2,20.8,23.9,27.6,NULL,NULL),(61,'60',12.4,14.1,16,18.3,21,24.2,27.9,NULL,NULL);
/*!40000 ALTER TABLE `standar_berat_who` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `standar_tinggi_who`
--

DROP TABLE IF EXISTS `standar_tinggi_who`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `standar_tinggi_who` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SD3neg` double NOT NULL,
  `SD2neg` double NOT NULL,
  `SD1neg` double NOT NULL,
  `SD0` double NOT NULL,
  `SD1` double NOT NULL,
  `SD2` double NOT NULL,
  `SD3` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `standar_tinggi_who_bulan_unique` (`bulan`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `standar_tinggi_who`
--

LOCK TABLES `standar_tinggi_who` WRITE;
/*!40000 ALTER TABLE `standar_tinggi_who` DISABLE KEYS */;
INSERT INTO `standar_tinggi_who` VALUES (1,'0',44.2,46.1,48,49.9,51.8,53.7,55.6,NULL,NULL),(2,'1',48.9,50.8,52.8,54.7,56.7,58.6,60.6,NULL,NULL),(3,'2',52.4,54.4,56.4,58.4,60.4,62.4,64.4,NULL,NULL),(4,'3',55.3,57.3,59.4,61.4,63.5,65.5,67.6,NULL,NULL),(5,'4',57.6,59.7,61.8,63.9,66,68,70.1,NULL,NULL),(6,'5',59.6,61.7,63.8,65.9,68,70.1,72.2,NULL,NULL),(7,'6',61.2,63.3,65.5,67.6,69.8,71.9,74,NULL,NULL),(8,'7',62.7,64.8,67,69.2,71.3,73.5,75.7,NULL,NULL),(9,'8',64,66.2,68.4,70.6,72.8,75,77.2,NULL,NULL),(10,'9',65.2,67.5,69.7,72,74.2,76.5,78.7,NULL,NULL),(11,'10',66.4,68.7,71,73.3,75.6,77.9,80.1,NULL,NULL),(12,'11',67.6,69.9,72.2,74.5,76.9,79.2,81.5,NULL,NULL),(13,'12',68.6,71,73.4,75.7,78.1,80.5,82.9,NULL,NULL),(14,'13',69.6,72.1,74.5,76.9,79.3,81.8,84.2,NULL,NULL),(15,'14',70.6,73.1,75.6,78,80.5,83,85.5,NULL,NULL),(16,'15',71.6,74.1,76.6,79.1,81.7,84.2,86.7,NULL,NULL),(17,'16',72.5,75,77.6,80.2,82.8,85.4,88,NULL,NULL),(18,'17',73.3,76,78.6,81.2,83.9,86.5,89.2,NULL,NULL),(19,'18',74.2,76.9,79.6,82.3,85,87.7,90.4,NULL,NULL),(20,'19',75,77.7,80.5,83.2,86,88.8,91.5,NULL,NULL),(21,'20',75.8,78.6,81.4,84.2,87,89.8,92.6,NULL,NULL),(22,'21',76.5,79.4,82.3,85.1,88,90.9,93.8,NULL,NULL),(23,'22',77.2,80.2,83.1,86,89,91.9,94.9,NULL,NULL),(24,'23',78,81,83.9,86.9,89.9,92.9,95.9,NULL,NULL),(25,'24',78.7,81.7,84.8,87.8,90.9,93.9,97,NULL,NULL),(26,'25',78.6,81.7,84.9,88,91.1,94.2,97.3,NULL,NULL),(27,'26',79.3,82.5,85.6,88.8,92,95.2,98.3,NULL,NULL),(28,'27',79.9,83.1,86.4,89.6,92.9,96.1,99.3,NULL,NULL),(29,'28',80.5,83.8,87.1,90.4,93.7,97,100.3,NULL,NULL),(30,'29',81.1,84.5,87.8,91.2,94.5,97.9,101.2,NULL,NULL),(31,'30',81.7,85.1,88.5,91.9,95.3,98.7,102.1,NULL,NULL),(32,'31',82.3,85.7,89.2,92.7,96.1,99.6,103,NULL,NULL),(33,'32',82.8,86.4,89.9,93.4,96.9,100.4,103.9,NULL,NULL),(34,'33',83.4,86.9,90.5,94.1,97.6,101.2,104.8,NULL,NULL),(35,'34',83.9,87.5,91.1,94.8,98.4,102,105.6,NULL,NULL),(36,'35',84.4,88.1,91.8,95.4,99.1,102.7,106.4,NULL,NULL),(37,'36',85,88.7,92.4,96.1,99.8,103.5,107.2,NULL,NULL),(38,'37',85.5,89.2,93,96.7,100.5,104.2,108,NULL,NULL),(39,'38',86,89.8,93.6,97.4,101.2,105,108.8,NULL,NULL),(40,'39',86.5,90.3,94.2,98,101.8,105.7,109.5,NULL,NULL),(41,'40',87,90.9,94.7,98.6,102.5,106.4,110.3,NULL,NULL),(42,'41',87.5,91.4,95.3,99.2,103.2,107.1,111,NULL,NULL),(43,'42',88,91.9,95.9,99.9,103.8,107.8,111.7,NULL,NULL),(44,'43',88.4,92.4,96.4,100.4,104.5,108.5,112.5,NULL,NULL),(45,'44',88.9,93,97,101,105.1,109.1,113.2,NULL,NULL),(46,'45',89.4,93.5,97.5,101.6,105.7,109.8,113.9,NULL,NULL),(47,'46',89.8,94,98.1,102.2,106.3,110.4,114.6,NULL,NULL),(48,'47',90.3,94.4,98.6,102.8,106.9,111.1,115.2,NULL,NULL),(49,'48',90.7,94.9,99.1,103.3,107.5,111.7,115.9,NULL,NULL),(50,'49',91.2,95.4,99.7,103.9,108.1,112.4,116.6,NULL,NULL),(51,'50',91.6,95.9,100.2,104.4,108.7,113,117.3,NULL,NULL),(52,'51',92.1,96.4,100.7,105,109.3,113.6,117.9,NULL,NULL),(53,'52',92.5,96.9,101.2,105.6,109.9,114.2,118.6,NULL,NULL),(54,'53',93,97.4,101.7,106.1,110.5,114.9,119.2,NULL,NULL),(55,'54',93.4,97.8,102.3,106.7,111.1,115.5,119.9,NULL,NULL),(56,'55',93.9,98.3,102.8,107.2,111.7,116.1,120.6,NULL,NULL),(57,'56',94.3,98.8,103.3,107.8,112.3,116.7,121.2,NULL,NULL),(58,'57',94.7,99.3,103.8,108.3,112.8,117.4,121.9,NULL,NULL),(59,'58',95.2,99.7,104.3,108.9,113.4,118,122.6,NULL,NULL),(60,'59',95.6,100.2,104.8,109.4,114,118.6,123.2,NULL,NULL),(61,'60',96.1,100.7,105.3,110,114.6,119.2,123.9,NULL,NULL);
/*!40000 ALTER TABLE `standar_tinggi_who` ENABLE KEYS */;
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
  `id_desa` bigint unsigned DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$2y$12$82lY5b6m16YKQNdf0Z9BVujuOMFjNCwFJreXv8QU1sLdbM.Er8FW.',
  `role` enum('Admin','Ahli Gizi','Pimpinan','Orang Tua') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_nik_unique` (`nik`),
  KEY `users_id_desa_foreign` (`id_desa`),
  CONSTRAINT `users_id_desa_foreign` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Sofhia',1,NULL,NULL,'ahligizi@gmail.com',NULL,'$2y$12$xQar/QeGLEbtwffULx4eXOH7x.Ttn8l8J2lBgiym90eFpGW3Y5/2.','Ahli Gizi','TejPb01o5zEHKKXdcaXJrTGTnUvCaAo87awG8iXPPiuVkgVYxVOeAbcwKG3N','2025-05-21 05:43:46','2025-06-03 16:25:46'),(2,'Akmal',NULL,NULL,NULL,'admin@gmail.com',NULL,'$2y$12$DxWiLxnapvDEqizYqPTMPuzSlUxIec4Dm.fRjaQR5b6aNEK7F7KOO','Admin',NULL,'2025-05-21 05:43:46','2025-05-21 05:43:46'),(3,'Burhan S.Kom',NULL,NULL,NULL,'pimpinan@gmail.com',NULL,'$2y$12$rX54MHuzxqpE3rQ1SiIx9eFWER8qmHQjvPreqEsMXDg3bmUELahN.','Pimpinan',NULL,'2025-05-21 05:43:46','2025-05-21 05:43:46'),(4,'Ania',1,'1201102','fdka','orangtua@gmail.com',NULL,'$2y$12$82lY5b6m16YKQNdf0Z9BVujuOMFjNCwFJreXv8QU1sLdbM.Er8FW.','Orang Tua',NULL,'2025-05-24 05:53:34','2025-05-24 05:53:34'),(5,'Citra Wulandari',NULL,'102010021','Popalia','citra@gmail.com',NULL,'$2y$12$82lY5b6m16YKQNdf0Z9BVujuOMFjNCwFJreXv8QU1sLdbM.Er8FW.','Orang Tua',NULL,'2025-06-03 16:23:40','2025-06-03 16:23:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-17 12:23:31
