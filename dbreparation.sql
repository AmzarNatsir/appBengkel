-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.20 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table dbreparation.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.cache: ~0 rows (lebih kurang)

-- membuang struktur untuk table dbreparation.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.cache_locks: ~0 rows (lebih kurang)

-- membuang struktur untuk table dbreparation.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Membuang data untuk tabel dbreparation.failed_jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table dbreparation.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
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

-- Membuang data untuk tabel dbreparation.jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table dbreparation.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
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

-- Membuang data untuk tabel dbreparation.job_batches: ~0 rows (lebih kurang)

-- membuang struktur untuk table dbreparation.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.migrations: ~24 rows (lebih kurang)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_10_10_004726_create_permission_tables', 2),
	(6, '2024_10_13_232554_create_table_tb_com_brand', 3),
	(7, '2024_10_14_010232_create_tb_com_model', 4),
	(8, '2024_10_17_024343_create_tb_com_type', 5),
	(10, '2024_10_23_234316_create_tb_com_ccunit', 6),
	(11, '2024_10_24_000907_create_tb_com_color', 7),
	(12, '2024_10_24_004953_create_tb_com_jenis', 8),
	(13, '2024_10_24_055019_create_tb_com_satuan', 9),
	(14, '2024_10_24_061955_create_tb_ms_customer', 10),
	(15, '2024_10_29_233514_create_tb_ms_supplier', 11),
	(17, '2024_10_29_235839_create_tb_ms_vehicle', 12),
	(21, '2024_11_03_234512_create_tb_ms_parts', 13),
	(23, '2024_11_07_002429_create_tb_purchase_order', 14),
	(24, '2024_11_12_011625_create_tb_purchase_order_detail', 15),
	(25, '2024_11_17_113456_add_new_field_deskripsi_gambar_table_tb_ms_parts', 16),
	(26, '2024_11_23_013724_create_tb_receive', 17),
	(27, '2024_11_23_013729_create_tb_receive_detail', 17),
	(28, '2024_12_17_122125_create_tb_set_kategori_pekerjaan', 18),
	(30, '2024_12_18_012118_create_tb_set_pekerjaan', 19),
	(34, '2024_12_21_030843_create_tb_service', 20),
	(35, '2024_12_21_030926_create_tb_service_pekerjaan', 20),
	(36, '2024_12_21_030932_create_tb_service_parts', 20),
	(37, '2024_12_31_005821_create_set_ppn_margin_harga_jual', 21),
	(38, '2025_01_01_063706_create_tb_ms_rak', 22),
	(39, '2025_01_01_071349_add_field_rak_id_table_tb_ms_parts', 23);

-- membuang struktur untuk table dbreparation.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.model_has_permissions: ~0 rows (lebih kurang)

-- membuang struktur untuk table dbreparation.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.model_has_roles: ~4 rows (lebih kurang)
REPLACE INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2),
	(3, 'App\\Models\\User', 3),
	(4, 'App\\Models\\User', 4);

-- membuang struktur untuk table dbreparation.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.password_reset_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table dbreparation.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.permissions: ~10 rows (lebih kurang)
REPLACE INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'create-role', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(2, 'edit-role', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(3, 'delete-role', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(4, 'create-user', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(5, 'edit-user', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(6, 'delete-user', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(7, 'view-product', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(8, 'create-product', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(9, 'edit-product', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(10, 'delete-product', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23');

-- membuang struktur untuk table dbreparation.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.roles: ~4 rows (lebih kurang)
REPLACE INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(2, 'Admin', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(3, 'Product Manager', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23'),
	(4, 'User', 'web', '2024-10-09 17:04:23', '2024-10-09 17:04:23');

-- membuang struktur untuk table dbreparation.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.role_has_permissions: ~10 rows (lebih kurang)
REPLACE INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(4, 2),
	(5, 2),
	(6, 2),
	(8, 2),
	(9, 2),
	(10, 2),
	(8, 3),
	(9, 3),
	(10, 3),
	(7, 4);

-- membuang struktur untuk table dbreparation.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
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

-- Membuang data untuk tabel dbreparation.sessions: ~7 rows (lebih kurang)
REPLACE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('8BenpwebuZUj5IFM7FavnpgS5pOoYsjWb2O08sHA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieVhrYUgyY0Y2ekJBMFJMZTBqdTllNkoyaHlSZHVQTnRZNTFvTk44biI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1735715864),
	('Amw7LNL2nwfxaYXQfW1Tw3timfabOczRvMLAp8vl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjUwNzVDUzd4eXJnQ3pUNHVSZGxJUkUxeVV4bHppTVBqS2NNM2I1RCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BlbmVyaW1hYW4vYmFydSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGVuZXJpbWFhbi9iYXJ1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1735712644),
	('FvO9FVdfOKd300cMwpxHG11B1ZJABU6ClJHMVVCP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic1dmNVc0SUE4dDdrVmllODF1WEV6R2N2bTREUlRhbG5aVXBYdXVMVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1735712644),
	('INWfbKPGB6hB547SZtXgakPpUFBVQOvzZvn3s5Rl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUNTMml2V25FYW5oUVE2YmpxNFpHb2d3OWE1TnAyRXlNMHZmdUJDdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1735710650),
	('ONRCCddlZl2Bxu5LzZC51oMTSUzcMopwLOvmpFVQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSndZT3lCd3FrVUl0blhvRlNkeTJ0MUl0dlN3ZVB1RlJMdDhrVzlRQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1735718721),
	('OsncHuFe1QyW5ZbZYRONTUxQK8Yq12aaisWgcyEb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaHNPQm94SjRJOG1DMlFkQ2lDYlNYQ3plMGU2OVdQdGhWbXJmemI1SCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BlbmVyaW1hYW4vYmFydSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGVuZXJpbWFhbi9iYXJ1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1735710650),
	('pDbnl8rCJsV9dPJpEKWljvdOm48AwrqZvNF9AueW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid0RXdEdJM0Z6WTdjN1dxU0RIdnVBdVhHeGl5S3VQWEp4RkVNdzg1USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1735711965),
	('RTMJ8orThunL30EwavEOQE1TgI7HfGH3P6ajZGKH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUGhxNVR6YjNMV2t5RjZod1hMT3RTSHFGQkxJWVVsR1U3WXM2NTZPUiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BlbmVyaW1hYW4vYmFydSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGVuZXJpbWFhbi9iYXJ1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1735711965),
	('VewucLPOCdIYKQibsXHUfEhIFtMOLybZ4gkNb33E', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieml5QTBJbmhpdjYyU29DTktRSVlKeWRPUXRYak4yWElsaGllU2kxeiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BhcnRzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYXJ0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1735715864);

-- membuang struktur untuk table dbreparation.set_ppn_margin_harga_jual
CREATE TABLE IF NOT EXISTS `set_ppn_margin_harga_jual` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ppn` double DEFAULT NULL,
  `margin` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.set_ppn_margin_harga_jual: ~1 rows (lebih kurang)
REPLACE INTO `set_ppn_margin_harga_jual` (`id`, `ppn`, `margin`, `created_at`, `updated_at`) VALUES
	(2, 11, 0.2, NULL, '2024-12-31 22:02:45');

-- membuang struktur untuk table dbreparation.tb_com_brand
CREATE TABLE IF NOT EXISTS `tb_com_brand` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_brand` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_com_brand: ~2 rows (lebih kurang)
REPLACE INTO `tb_com_brand` (`id`, `oid_brand`, `brand_name`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(1, 'BR-001', 'Toyota', 'I', 1, NULL, NULL, '2024-10-13 16:24:36', '2024-10-13 16:43:59'),
	(2, 'BR-002', 'Daihatsu', 'U', 1, NULL, NULL, '2024-10-13 16:04:49', '2024-10-16 18:38:27');

-- membuang struktur untuk table dbreparation.tb_com_ccunit
CREATE TABLE IF NOT EXISTS `tb_com_ccunit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_ccunit` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc_unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_com_ccunit: ~2 rows (lebih kurang)
REPLACE INTO `tb_com_ccunit` (`id`, `oid_ccunit`, `cc_unit`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(1, 'CC-001', '800', 'I', 1, NULL, NULL, '2024-10-23 16:11:04', NULL),
	(2, 'CC-002', '1000', 'I', 1, NULL, NULL, '2024-10-23 16:01:05', NULL);

-- membuang struktur untuk table dbreparation.tb_com_color
CREATE TABLE IF NOT EXISTS `tb_com_color` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_color` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_idn` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_eng` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_com_color: ~2 rows (lebih kurang)
REPLACE INTO `tb_com_color` (`id`, `oid_color`, `color_idn`, `color_eng`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(1, 'CL-001', 'Putih', 'White', 'I', 1, NULL, NULL, '2024-10-23 16:01:38', '2024-10-23 16:41:20');

-- membuang struktur untuk table dbreparation.tb_com_jenis
CREATE TABLE IF NOT EXISTS `tb_com_jenis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_jenis` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_com_jenis: ~2 rows (lebih kurang)
REPLACE INTO `tb_com_jenis` (`id`, `oid_jenis`, `jenis`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(1, 'JS-001', 'SVP', 'I', 1, NULL, NULL, '2024-10-23 17:06:00', NULL);

-- membuang struktur untuk table dbreparation.tb_com_model
CREATE TABLE IF NOT EXISTS `tb_com_model` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_model` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oid_brand` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_com_model: ~2 rows (lebih kurang)
REPLACE INTO `tb_com_model` (`id`, `oid_model`, `oid_brand`, `model_name`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(1, 'ML-001', 'BR-001', 'Fortuner', 'I', 1, NULL, NULL, '2024-10-16 18:32:10', NULL),
	(2, 'ML-002', 'BR-002', 'Xenia', 'U', 1, NULL, NULL, '2024-10-16 18:22:19', '2024-10-16 18:33:30');

-- membuang struktur untuk table dbreparation.tb_com_satuan
CREATE TABLE IF NOT EXISTS `tb_com_satuan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_satuan` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_com_satuan: ~2 rows (lebih kurang)
REPLACE INTO `tb_com_satuan` (`id`, `oid_satuan`, `satuan`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(2, 'ST-001', 'PCS', 'I', 1, NULL, NULL, '2024-10-23 22:32:03', NULL),
	(3, 'ST-002', 'BOX', 'I', 1, NULL, NULL, '2024-10-23 22:48:03', NULL);

-- membuang struktur untuk table dbreparation.tb_com_type
CREATE TABLE IF NOT EXISTS `tb_com_type` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_type` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oid_brand` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oid_model` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_com_type: ~1 rows (lebih kurang)
REPLACE INTO `tb_com_type` (`id`, `oid_type`, `type_name`, `oid_brand`, `oid_model`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(2, 'TU-001', '4x2 2.8 VRZ AT DSL', 'BR-001', 'ML-001', 'U', 1, NULL, NULL, '2024-10-20 17:49:03', '2024-10-23 15:14:40');

-- membuang struktur untuk table dbreparation.tb_ms_customer
CREATE TABLE IF NOT EXISTS `tb_ms_customer` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_customer` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_ms_customer: ~0 rows (lebih kurang)
REPLACE INTO `tb_ms_customer` (`id`, `oid_customer`, `customer_name`, `customer_address`, `customer_email`, `customer_phone`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(2, 'CS-001', 'Customer 1', 'Jl. Customer 1', 'customer1@mail.com', '08737283723', 'I', 1, NULL, NULL, '2024-10-29 15:48:30', NULL);

-- membuang struktur untuk table dbreparation.tb_ms_parts
CREATE TABLE IF NOT EXISTS `tb_ms_parts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_part` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_satuan` int NOT NULL,
  `id_jenis` int NOT NULL,
  `id_brand` int NOT NULL,
  `stok_awal` int DEFAULT NULL,
  `stok_akhir` int DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_rak` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_ms_parts: ~7 rows (lebih kurang)
REPLACE INTO `tb_ms_parts` (`id`, `oid_part`, `part_name`, `id_satuan`, `id_jenis`, `id_brand`, `stok_awal`, `stok_akhir`, `harga_beli`, `harga_jual`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`, `deleted_at`, `deskripsi`, `gambar`, `id_rak`) VALUES
	(1, 'PR-001', 'Shell Helix', 2, 1, 1, 10, 22, 70000, 0, 'U', 1, 1, NULL, '2024-11-05 16:06:12', '2024-12-31 23:18:23', NULL, 'Salah satu produknya yang terus-menerus dikembangkan mengikuti perkembangan zaman dan kebutuhan kendaraan adalah oli Shell Helix untuk mobil. Menjadi produk unggulan Shell, tentunya seri oli mesin Shell Helix memiliki banyak varian, mulai dari oli full sintetik, semi sintetik, hingga oli mineral yang tentunya memiliki varian kekentalan yang berbeda-beda juga. Namun, banyak orang menggolongkan oli Shell ini dalam oli Shell kuning dan biru, padahal tidak dibenarkan membedakannya berdasarkan warna kemasan saja. Selain itu, ada baiknya untuk mempelajari perbedaan oli palsu dan asli agar tidak tertipu dan malah merusak mesin mobil. Harus jeli untuk memilih toko oli terpercaya agar tidak mendapatkan oli palsu.', '1731848714_hx3_compressed.jpg', 3),
	(2, 'PR-002', 'Castrol Magnatec', 3, 1, 2, 100, 108, 150000, 160000, 'U', 1, 1, NULL, '2024-11-05 16:36:24', '2024-12-31 23:35:25', NULL, 'Oli mesin Castrol MAGNATEC, dilengkapi dengan Teknologi DUALOCK, dibuat khusus untuk lingkungan urban masa kini dan dirancang untuk melindungi mesin dari keausan akibat seringnya berhenti-jalan dikondisi lalu lintas yang padat.', '1731848853_no-brand_no-brand_full02.jpg', 1),
	(3, 'PR-003', 'sds ds', 2, 1, 1, 1, 1, 0, 0, 'I', 1, NULL, NULL, '2024-11-05 17:39:23', '2024-11-05 17:23:50', '2024-11-05 17:23:50', NULL, NULL, NULL),
	(12, 'PR-003', 'Silinder Block', 2, 1, 1, 0, 3, 500000, 0, 'U', 1, 1, NULL, '2024-11-17 04:25:39', '2024-12-31 21:16:25', NULL, 'Jika berbicara tentang otomotif, salah satu komponen yang nggak terlihat tetapi memiliki peran yang sangat vital dalam menentukan performa dan efisiensi mesin adalah blok silinder. Blok silinder merupakan jantung dari mesin kendaraan, tempat di mana proses pembakaran bahan bakar dan udara berlangsung, mengubah energi kimia menjadi tenaga mekanik yang menggerakkan roda kendaraan.', '1731848376_Cara-Kerja-Blok-Silinder-Mobi-dan-Fungsinya-yang-Cukup-Penting.jpg', NULL),
	(13, 'PR-004', 'Bantal Jok', 2, 1, 1, 0, 10, 100000, 133200, 'I', 1, NULL, NULL, '2024-12-31 21:35:34', '2024-12-31 22:34:57', NULL, 'Salah satu aksesoris mobil yang lagi trend adalah bantal jok. Sebenarnya, aksesoris ini bukanlah hal yang baru. Bantal jok bisa dibilang adalah aksesoris yang wajib ada di mobil. Banyak pemilik mobil yang menambahkan bantal jok untuk menambah kenyamanan selama berkendara.', '1735709675_bantal jok.jpg', NULL),
	(14, 'PR-005', 'Phone holder', 2, 1, 1, 0, 10, 50000, 66600, 'I', 1, NULL, NULL, '2024-12-31 21:30:35', '2024-12-31 22:34:57', NULL, 'Aksesoris mobil yang lagi trend selanjutnya adalah phone holder. Dengan penggunaan gadget yang semakin dominan, khususnya ponsel, phone holder menjadi aksesoris mobil yang sangat penting.', '1735709730_phone holder.jpg', NULL),
	(15, 'PR-005', 'ssdsd', 2, 1, 1, 0, 0, 0, 0, 'I', 1, NULL, NULL, '2024-12-31 23:51:15', NULL, NULL, 'sd sds dsd', NULL, 1);

-- membuang struktur untuk table dbreparation.tb_ms_rak
CREATE TABLE IF NOT EXISTS `tb_ms_rak` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_ms_rak: ~0 rows (lebih kurang)
REPLACE INTO `tb_ms_rak` (`id`, `nama_rak`, `created_at`, `updated_at`) VALUES
	(1, 'Rak A-1', '2024-12-31 22:22:54', '2024-12-31 22:55:05'),
	(3, 'Rak A-2', '2024-12-31 22:19:55', NULL);

-- membuang struktur untuk table dbreparation.tb_ms_supplier
CREATE TABLE IF NOT EXISTS `tb_ms_supplier` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_supplier` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_ms_supplier: ~1 rows (lebih kurang)
REPLACE INTO `tb_ms_supplier` (`id`, `oid_supplier`, `supplier_name`, `supplier_address`, `supplier_email`, `supplier_phone`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(2, 'SP-001', 'Supplier 1', 'Jl. Supplier 1', 'supplier1@mail.com', '232323232', 'I', 1, NULL, NULL, '2024-10-29 15:43:51', NULL),
	(3, 'SP-002', 'Carozza', 'Jl. Sultan Alaudin, Makassar', 'carozza@gmail.com', '0816767667', 'I', 1, NULL, NULL, '2024-12-31 21:34:31', NULL);

-- membuang struktur untuk table dbreparation.tb_ms_vehicle
CREATE TABLE IF NOT EXISTS `tb_ms_vehicle` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oid_vehicle` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plat_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oid_brand` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oid_model` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oid_type` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oid_jenis` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oid_color` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oid_customer` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_ms_vehicle: ~0 rows (lebih kurang)
REPLACE INTO `tb_ms_vehicle` (`id`, `oid_vehicle`, `plat_number`, `oid_brand`, `oid_model`, `oid_type`, `oid_jenis`, `oid_color`, `oid_customer`, `year`, `crud`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(2, 'VH-001', 'DD 5410 BZ', 'BR-001', 'ML-001', 'TU-001', 'JS-001', 'CL-001', 'CS-001', '2010', 'I', 1, NULL, NULL, '2024-11-03 15:18:34', NULL),
	(3, 'VH-002', 'DD 7896 AX', 'BR-001', 'ML-001', 'TU-001', 'JS-001', 'CL-001', 'CS-001', '2002', 'I', 1, NULL, NULL, '2024-12-22 22:46:33', NULL);

-- membuang struktur untuk table dbreparation.tb_purchase_order
CREATE TABLE IF NOT EXISTS `tb_purchase_order` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `po_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `po_date` date NOT NULL,
  `po_delivery_order` date DEFAULT NULL,
  `id_supplier` int NOT NULL,
  `po_remark` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_total` double DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_purchase_order: ~3 rows (lebih kurang)
REPLACE INTO `tb_purchase_order` (`id`, `po_number`, `po_date`, `po_delivery_order`, `id_supplier`, `po_remark`, `po_total`, `status`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(12, 'PO-001', '2024-11-17', '2024-11-18', 2, 'Testing Store PO Head', 2200000, 'Receive', 1, NULL, NULL, '2024-11-17 03:14:21', '2024-12-22 22:56:42', NULL),
	(13, 'PO-002', '2024-11-18', '2024-11-19', 2, 'Testing Store PO Head baru', 810000, 'Receive', 1, NULL, NULL, '2024-11-17 15:49:44', '2024-11-23 23:56:13', NULL),
	(14, 'PO-003', '2024-11-24', '2024-11-25', 2, 'Pemesanan pembelian part', 2500000, 'Receive', 1, NULL, NULL, '2024-11-23 23:41:59', '2024-11-24 00:09:08', NULL),
	(15, 'PO-004', '2024-12-23', '2024-12-23', 2, 'Pembelian Material Aksesoris', 8500000, 'Purchase Order', 1, NULL, NULL, '2024-12-22 22:08:50', '2024-12-22 22:50:47', NULL),
	(16, 'PO-005', '2025-01-01', '2025-01-01', 3, 'Pemesanan stok assesoris', 1500000, 'Receive', 1, NULL, NULL, '2024-12-31 21:26:32', '2024-12-31 22:34:57', NULL);

-- membuang struktur untuk table dbreparation.tb_purchase_order_detail
CREATE TABLE IF NOT EXISTS `tb_purchase_order_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_head` int NOT NULL,
  `id_part` int NOT NULL,
  `qty` int NOT NULL,
  `harga_satuan` double NOT NULL,
  `sub_total` double NOT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_purchase_order_detail: ~9 rows (lebih kurang)
REPLACE INTO `tb_purchase_order_detail` (`id`, `id_head`, `id_part`, `qty`, `harga_satuan`, `sub_total`, `status`, `created_at`, `updated_at`) VALUES
	(11, 12, 1, 10, 70000, 700000, NULL, NULL, NULL),
	(12, 12, 2, 10, 150000, 1500000, NULL, NULL, NULL),
	(13, 13, 2, 2, 150000, 300000, NULL, NULL, '2024-11-17 15:51:05'),
	(14, 13, 1, 5, 100000, 500000, NULL, NULL, NULL),
	(16, 14, 12, 5, 500000, 2500000, NULL, NULL, '2024-11-24 00:08:18'),
	(17, 15, 12, 12, 500000, 6000000, NULL, NULL, NULL),
	(18, 15, 12, 5, 500000, 2500000, NULL, NULL, NULL),
	(19, 16, 13, 10, 100000, 1000000, NULL, NULL, NULL),
	(21, 16, 14, 10, 50000, 500000, NULL, NULL, NULL);

-- membuang struktur untuk table dbreparation.tb_receive
CREATE TABLE IF NOT EXISTS `tb_receive` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_receive` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_receive` date NOT NULL,
  `ket_receive` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_reff` int NOT NULL,
  `cara_bayar` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uang_muka` double DEFAULT NULL,
  `biaya_lain` double DEFAULT NULL,
  `ppn` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `total_net` double DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_receive: ~3 rows (lebih kurang)
REPLACE INTO `tb_receive` (`id`, `nomor_receive`, `tanggal_receive`, `ket_receive`, `po_reff`, `cara_bayar`, `uang_muka`, `biaya_lain`, `ppn`, `total`, `total_net`, `status`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'RV-001', '2024-11-24', 'Testing Store Penerimaan Barang', 13, 'Cash', 0, 0, 125000, 1250000, 1375000, 'Receive', 1, NULL, NULL, '2024-11-23 23:12:56', NULL, NULL),
	(4, 'RV-002', '2024-11-24', 'Penerimaan Barang dari supplier 1 via Cash', 14, 'Cash', 0, 0, 0, 2500000, 2500000, 'Receive', 1, NULL, NULL, '2024-11-24 00:08:09', NULL, NULL),
	(5, 'RV-003', '2024-12-23', 'Testing Store PO Head', 12, 'Cash', 0, 0, 0, 2130000, 2130000, 'Receive', 1, NULL, NULL, '2024-12-22 22:42:56', NULL, NULL),
	(6, 'RV-004', '2025-01-01', 'Penerimaan pemesanan barang no: PO-005 (CASH)', 16, 'Cash', 0, 0, 0, 1500000, 1500000, 'Receive', 1, NULL, NULL, '2024-12-31 22:57:34', NULL, NULL);

-- membuang struktur untuk table dbreparation.tb_receive_detail
CREATE TABLE IF NOT EXISTS `tb_receive_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_head` int NOT NULL,
  `id_part` int NOT NULL,
  `terima` int NOT NULL,
  `order` int NOT NULL,
  `harga_satuan` double NOT NULL,
  `diskon` double NOT NULL,
  `sub_total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_receive_detail: ~7 rows (lebih kurang)
REPLACE INTO `tb_receive_detail` (`id`, `id_head`, `id_part`, `terima`, `order`, `harga_satuan`, `diskon`, `sub_total`, `created_at`, `updated_at`) VALUES
	(3, 2, 2, 5, 2, 150000, 0, 750000, '2024-11-23 23:56:13', '2024-11-23 23:56:13'),
	(4, 2, 1, 5, 5, 100000, 0, 500000, '2024-11-23 23:56:13', '2024-11-23 23:56:13'),
	(6, 4, 12, 5, 5, 500000, 0, 2500000, '2024-11-24 00:09:08', '2024-11-24 00:09:08'),
	(7, 5, 1, 9, 10, 70000, 0, 630000, '2024-12-22 22:56:42', '2024-12-22 22:56:42'),
	(8, 5, 2, 10, 10, 150000, 0, 1500000, '2024-12-22 22:56:42', '2024-12-22 22:56:42'),
	(9, 6, 13, 10, 10, 100000, 0, 1000000, '2024-12-31 22:34:57', '2024-12-31 22:34:57'),
	(10, 6, 14, 10, 10, 50000, 0, 500000, '2024-12-31 22:34:57', '2024-12-31 22:34:57');

-- membuang struktur untuk table dbreparation.tb_service
CREATE TABLE IF NOT EXISTS `tb_service` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tgl_service` date NOT NULL,
  `no_service` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` bigint unsigned NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cara_bayar` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_pekerjaan` double NOT NULL,
  `total_parts` double NOT NULL,
  `total_pekerjaa_parts` double NOT NULL,
  `diskon` double DEFAULT NULL,
  `ppn_persen` int DEFAULT NULL,
  `ppn_rupiah` double DEFAULT NULL,
  `total_net` double NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_service_unit_id_foreign` (`unit_id`),
  CONSTRAINT `tb_service_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `tb_ms_vehicle` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_service: ~3 rows (lebih kurang)
REPLACE INTO `tb_service` (`id`, `tgl_service`, `no_service`, `unit_id`, `deskripsi`, `cara_bayar`, `total_pekerjaan`, `total_parts`, `total_pekerjaa_parts`, `diskon`, `ppn_persen`, `ppn_rupiah`, `total_net`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(9, '2024-12-21', 'INV-001', 2, 'Testing service (Pekerjaan + Parts)', 'Cash', 920000, 950000, 1870000, 0, 0, 0, 1870000, 1, NULL, NULL, '2024-12-20 21:17:18', NULL),
	(10, '2024-12-21', 'INV-002', 2, 'sd ds dsd sd', 'Cash', 0, 160000, 160000, 0, 0, 0, 160000, 1, NULL, NULL, '2024-12-20 21:56:23', NULL),
	(11, '2024-12-23', 'INV-003', 3, 'Perbaikan Sarung Jok Belakang', 'Cash', 570000, 950000, 1520000, 0, 0, 0, 1520000, 1, NULL, NULL, '2024-12-22 22:18:47', NULL),
	(12, '2025-01-01', 'INV-004', 3, 'sd sd sd sd sd', 'Cash', 850000, 310000, 1160000, 200, 12, 139200, 1299000, 1, NULL, NULL, '2024-12-31 21:24:16', NULL);

-- membuang struktur untuk table dbreparation.tb_service_parts
CREATE TABLE IF NOT EXISTS `tb_service_parts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint unsigned NOT NULL,
  `part_id` bigint unsigned NOT NULL,
  `jumlah` int NOT NULL,
  `harga` double NOT NULL,
  `sub_total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_service_parts_service_id_foreign` (`service_id`),
  KEY `tb_service_parts_part_id_foreign` (`part_id`),
  CONSTRAINT `tb_service_parts_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `tb_ms_parts` (`id`),
  CONSTRAINT `tb_service_parts_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `tb_service` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_service_parts: ~7 rows (lebih kurang)
REPLACE INTO `tb_service_parts` (`id`, `service_id`, `part_id`, `jumlah`, `harga`, `sub_total`, `created_at`, `updated_at`) VALUES
	(6, 9, 12, 1, 450000, 450000, '2024-12-20 21:18:17', '2024-12-20 21:18:17'),
	(7, 9, 1, 1, 500000, 500000, '2024-12-20 21:18:17', '2024-12-20 21:18:17'),
	(8, 10, 2, 1, 160000, 160000, '2024-12-20 21:23:56', '2024-12-20 21:23:56'),
	(9, 11, 1, 1, 200000, 200000, '2024-12-22 22:47:18', '2024-12-22 22:47:18'),
	(10, 11, 2, 5, 150000, 750000, '2024-12-22 22:47:18', '2024-12-22 22:47:18'),
	(11, 12, 12, 1, 150000, 150000, '2024-12-31 21:16:25', '2024-12-31 21:16:25'),
	(12, 12, 2, 1, 160000, 160000, '2024-12-31 21:16:25', '2024-12-31 21:16:25');

-- membuang struktur untuk table dbreparation.tb_service_pekerjaan
CREATE TABLE IF NOT EXISTS `tb_service_pekerjaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint unsigned NOT NULL,
  `pekerjaan_id` bigint unsigned NOT NULL,
  `biaya` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_service_pekerjaan_service_id_foreign` (`service_id`),
  KEY `tb_service_pekerjaan_pekerjaan_id_foreign` (`pekerjaan_id`),
  CONSTRAINT `tb_service_pekerjaan_pekerjaan_id_foreign` FOREIGN KEY (`pekerjaan_id`) REFERENCES `tb_set_pekerjaan` (`id`),
  CONSTRAINT `tb_service_pekerjaan_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `tb_service` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_service_pekerjaan: ~5 rows (lebih kurang)
REPLACE INTO `tb_service_pekerjaan` (`id`, `service_id`, `pekerjaan_id`, `biaya`, `created_at`, `updated_at`) VALUES
	(16, 9, 3, 70000, '2024-12-20 21:18:17', '2024-12-20 21:18:17'),
	(17, 9, 1, 850000, '2024-12-20 21:18:17', '2024-12-20 21:18:17'),
	(18, 11, 5, 500000, '2024-12-22 22:47:18', '2024-12-22 22:47:18'),
	(19, 11, 3, 70000, '2024-12-22 22:47:18', '2024-12-22 22:47:18'),
	(20, 12, 1, 850000, '2024-12-31 21:16:25', '2024-12-31 21:16:25');

-- membuang struktur untuk table dbreparation.tb_set_kategori_pekerjaan
CREATE TABLE IF NOT EXISTS `tb_set_kategori_pekerjaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_pekerjaan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_set_kategori_pekerjaan: ~7 rows (lebih kurang)
REPLACE INTO `tb_set_kategori_pekerjaan` (`id`, `kategori_pekerjaan`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(1, 'Reparasi Mekanik', 1, NULL, NULL, '2024-12-17 04:06:46', '2024-12-20 17:55:58'),
	(3, 'Reparasi Elektrik', 1, NULL, NULL, '2024-12-20 17:17:59', NULL),
	(4, 'Reparasi Sistem Injeksi Elektronik', 1, NULL, NULL, '2024-12-20 17:39:59', NULL),
	(5, 'Reparasi Badan Mobil', 1, NULL, NULL, '2024-12-20 18:01:00', NULL),
	(6, 'Reparasi Bagian Kendaraan Bermotor', 1, NULL, NULL, '2024-12-20 18:30:00', NULL),
	(7, 'Penyemprotan dan Pengecatan', 1, NULL, NULL, '2024-12-20 18:47:00', NULL),
	(8, 'Reparasi Kaca dan Jendela', 1, NULL, NULL, '2024-12-20 18:04:01', NULL),
	(9, 'Reparasi Tempat Duduk Kendaraan Bermotor', 1, NULL, NULL, '2024-12-20 18:28:01', NULL);

-- membuang struktur untuk table dbreparation.tb_set_pekerjaan
CREATE TABLE IF NOT EXISTS `tb_set_pekerjaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint unsigned NOT NULL,
  `nama_pekerjaan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` double NOT NULL DEFAULT '0',
  `aktif` tinyint NOT NULL DEFAULT '1',
  `user_at` int NOT NULL,
  `user_up` int DEFAULT NULL,
  `user_del` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_set_pekerjaan_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `tb_set_pekerjaan_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `tb_set_kategori_pekerjaan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.tb_set_pekerjaan: ~3 rows (lebih kurang)
REPLACE INTO `tb_set_pekerjaan` (`id`, `kategori_id`, `nama_pekerjaan`, `biaya`, `aktif`, `user_at`, `user_up`, `user_del`, `created_at`, `updated_at`) VALUES
	(1, 9, 'Sarung Jok Mobil Universal XI7 Xpander (3 Baris)', 850000, 1, 1, NULL, NULL, '2024-12-17 17:54:49', '2024-12-20 18:08:35'),
	(2, 1, 'asa asasas', 22220, 2, 1, NULL, NULL, '2024-12-17 17:27:55', '2024-12-19 00:59:53'),
	(3, 9, 'Sarung Jok Kursi Mobil High Back Cover Jok Belakang', 70000, 1, 1, NULL, NULL, '2024-12-20 18:39:35', NULL),
	(4, 9, 'Sarung Jok Mobil 2 Baris Agya', 1400000, 1, 1, NULL, NULL, '2024-12-20 18:49:48', NULL),
	(5, 9, 'Pergantian Sarung Jok belang', 500000, 1, 1, NULL, NULL, '2024-12-22 22:15:30', NULL);

-- membuang struktur untuk table dbreparation.users
CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel dbreparation.users: ~4 rows (lebih kurang)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'admin@admin.com', NULL, '$2y$12$cITajCP5WpGSaPkNaj0Tn.M.yn7g58Z9GTDtyBN.KncXXr0eHyOgK', NULL, '2024-10-09 17:04:24', '2024-10-09 17:04:24'),
	(2, 'Syed Ahsan Kamal', 'ahsan@allphptricks.com', NULL, '$2y$12$gQ5lKnLjS0JxcM3UsNPrseDFOUl0rwOkV3sza6/30VAbhJyrlPZ/.', NULL, '2024-10-09 17:04:24', '2024-10-09 17:04:24'),
	(3, 'Abdul Muqeet', 'muqeet@allphptricks.com', NULL, '$2y$12$lsD7krX4iWco9Vdif2PYKuBQLzThNU/Z5gq544Sv5rQu/VtfDXLw2', NULL, '2024-10-09 17:04:24', '2024-10-09 17:04:24'),
	(4, 'Naghman Ali', 'naghman@allphptricks.com', NULL, '$2y$12$2J7zng36d1Gw1MjHzODupuhM37NH3nU4LEv8YDfUkAzSYReCEqo0q', NULL, '2024-10-09 17:04:25', '2024-10-09 17:04:25');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
