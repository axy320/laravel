-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_perpustakaan
CREATE DATABASE IF NOT EXISTS `db_perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_perpustakaan`;

-- Dumping structure for table db_perpustakaan.bukus
CREATE TABLE IF NOT EXISTS `bukus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_terbit` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_buku` int NOT NULL DEFAULT '0',
  `rak_buku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bukus_kode_buku_unique` (`kode_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.bukus: ~3 rows (approximately)
INSERT INTO `bukus` (`id`, `kode_buku`, `judul_buku`, `penulis`, `penerbit`, `tahun_terbit`, `kategori`, `stok_buku`, `rak_buku`, `created_at`, `updated_at`) VALUES
	(1, 'BPK11', 'laskar pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2005', 'Fiksi', 3, 'A-1', '2026-04-14 22:16:06', '2026-04-15 00:11:45'),
	(2, 'BPK12', 'Atomic Habits', 'James Clear', 'Gramedia Pustaka Utama', '2019', 'Non-Fiksi', 5, 'A-1', '2026-04-14 23:00:40', '2026-04-19 15:34:13'),
	(3, 'BPK13', 'Timun emas', 'Andrea Hirata', 'Bentang Pustaka', '2005', 'Cerita Rakyat', 3, 'A-1', '2026-04-15 16:48:44', '2026-04-15 17:06:36');

-- Dumping structure for table db_perpustakaan.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.cache: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.cache_locks: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.failed_jobs
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

-- Dumping data for table db_perpustakaan.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.jobs
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

-- Dumping data for table db_perpustakaan.jobs: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.job_batches
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

-- Dumping data for table db_perpustakaan.job_batches: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.migrations: ~16 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_02_09_105357_create_siswas_table', 1),
	(5, '2026_02_11_081058_create_kategoris_table', 1),
	(6, '2026_02_11_081154_create_bukus_table', 1),
	(7, '2026_02_11_081232_create_peminjamen_table', 1),
	(8, '2026_04_13_021612_alter_status_on_peminjamans_table', 1),
	(9, '2026_04_13_999999_add_role_to_users_table', 1),
	(10, '2026_04_15_000001_rebuild_siswas_table', 1),
	(11, '2026_04_15_000002_create_pengunjungs_table', 1),
	(12, '2026_04_15_000003_rebuild_bukus_table', 1),
	(13, '2026_04_15_000004_rebuild_peminjamans_table', 1),
	(14, '2026_04_15_062537_alter_peminjamans_table_use_nama_peminjam', 2),
	(15, '2026_04_15_063423_alter_peminjamans_for_flexible_lending', 2),
	(16, '2026_04_15_073116_create_notifications_table', 3);

-- Dumping structure for table db_perpustakaan.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
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

-- Dumping data for table db_perpustakaan.notifications: ~45 rows (approximately)
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
	('05d81693-9376-4aed-a226-79fd75062877', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 1, '{"id":4,"title":"Pengunjung Baru","message":"Pengunjung baru bernama \'Ayna\' telah mencatatkan kunjungan.","url":"http:\\/\\/127.0.0.1:8000\\/pengunjungs","icon":"fas fa-users","color":"var(--info)"}', NULL, '2026-04-15 16:45:20', '2026-04-15 16:45:20'),
	('0bcd4891-fe59-4c9d-8809-97f8a1c0ff87', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 4, '{"id":5,"title":"Siswa Baru Terdaftar","message":"Siswa baru bernama \'khanya\' (NIS: 1155) telah didaftarkan.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/5","icon":"fas fa-user-graduate","color":"var(--primary)"}', NULL, '2026-05-03 17:59:15', '2026-05-03 17:59:15'),
	('15beb28b-6012-4a62-ab36-a6978ca3e0e6', 'App\\Notifications\\DataUpdatedNotification', 'App\\Models\\User', 2, '{"id":2,"title":"Data Siswa Diubah","message":"Data siswa bernama \'Indra Purnama Putra\' telah diperbarui.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/2","icon":"fas fa-user-graduate","color":"var(--secondary)"}', NULL, '2026-04-15 00:16:26', '2026-04-15 00:16:26'),
	('1783ad9c-0149-438d-93c3-0a36696db07b', 'App\\Notifications\\DataUpdatedNotification', 'App\\Models\\User', 3, '{"id":2,"title":"Data Siswa Diubah","message":"Data siswa bernama \'Indra Purnama Putra\' telah diperbarui.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/2","icon":"fas fa-user-graduate","color":"var(--secondary)"}', NULL, '2026-04-15 00:16:26', '2026-04-15 00:16:26'),
	('26caf166-f5ba-4279-a5d3-2c1a2b882685', 'App\\Notifications\\DataUpdatedNotification', 'App\\Models\\User', 2, '{"id":1,"title":"Data Buku Diubah","message":"Informasi buku \'laskar pelangi\' telah diperbarui.","url":"http:\\/\\/127.0.0.1:8000\\/bukus","icon":"fas fa-book","color":"var(--secondary)"}', NULL, '2026-04-15 00:11:45', '2026-04-15 00:11:45'),
	('2d38a69f-5697-46f1-87a6-34d3fc87cc51', 'App\\Notifications\\NewLoanNotification', 'App\\Models\\User', 2, '{"id":7,"title":"Buku Dipinjam","message":"Peminjaman baru: Citra (Siswa) meminjam buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/7","icon":"fas fa-hand-holding-heart","color":"var(--primary)"}', NULL, '2026-04-15 17:07:08', '2026-04-15 17:07:08'),
	('2e691657-3da7-4e06-89d1-f357a19acff8', 'App\\Notifications\\DataUpdatedNotification', 'App\\Models\\User', 2, '{"id":4,"title":"Data Siswa Diubah","message":"Data siswa bernama \'Ahmad\' telah diperbarui.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/4","icon":"fas fa-user-graduate","color":"var(--secondary)"}', NULL, '2026-04-15 16:43:04', '2026-04-15 16:43:04'),
	('333bfdaf-e4df-4207-a41a-0a85b4300fac', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 4, '{"id":7,"title":"Buku Dikembalikan","message":"Buku dikembalikan: Citra (Siswa) telah mengembalikan buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/7","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-19 15:34:13', '2026-04-19 15:34:13'),
	('34209a5f-be4c-4b79-8b3f-f80f7a83374d', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 1, '{"id":6,"title":"Buku Dikembalikan","message":"Buku dikembalikan: Citra (Siswa) telah mengembalikan buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/6","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-15 17:07:28', '2026-04-15 17:07:28'),
	('36775df1-ca86-4e3c-862c-acba3223297a', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 4, '{"id":6,"title":"Buku Dikembalikan","message":"Buku dikembalikan: Citra (Siswa) telah mengembalikan buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/6","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-15 17:07:28', '2026-04-15 17:07:28'),
	('39bb4c06-9542-4c92-b4a4-46c4ebefa5b2', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 2, '{"id":6,"title":"Siswa Baru Terdaftar","message":"Siswa baru bernama \'Ahmadani\' (NIS: 12345) telah didaftarkan.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/6","icon":"fas fa-user-graduate","color":"var(--primary)"}', NULL, '2026-05-03 18:39:02', '2026-05-03 18:39:02'),
	('3d19ed4f-b24d-42af-aa1a-b8ab84e15ef1', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 1, '{"id":4,"title":"Buku Dikembalikan","message":"Buku dikembalikan: yono (Pengunjung) telah mengembalikan buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/4","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-15 16:52:53', '2026-04-15 16:52:53'),
	('3db6b711-37fc-4f3f-b17b-b08b4bfe1dfe', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 1, '{"id":3,"title":"Pengunjung Baru","message":"Pengunjung baru bernama \'Pororo\' telah mencatatkan kunjungan.","url":"http:\\/\\/127.0.0.1:8000\\/pengunjungs","icon":"fas fa-users","color":"var(--info)"}', '2026-04-15 00:02:31', '2026-04-15 00:02:19', '2026-04-15 00:02:31'),
	('409ed5b6-46f3-4253-90ac-88be76074fa4', 'App\\Notifications\\NewLoanNotification', 'App\\Models\\User', 1, '{"id":6,"title":"Buku Dipinjam","message":"Peminjaman baru: Citra (Siswa) meminjam buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/6","icon":"fas fa-hand-holding-heart","color":"var(--primary)"}', NULL, '2026-04-15 17:07:03', '2026-04-15 17:07:03'),
	('42e9cf1e-783f-4c96-a0fd-e907dc1d3c7c', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 2, '{"id":7,"title":"Buku Dikembalikan","message":"Buku dikembalikan: Citra (Siswa) telah mengembalikan buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/7","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-19 15:34:13', '2026-04-19 15:34:13'),
	('44aec5a5-95b4-4b87-9d61-1e546fd82f6a', 'App\\Notifications\\NewLoanNotification', 'App\\Models\\User', 1, '{"id":7,"title":"Buku Dipinjam","message":"Peminjaman baru: Citra (Siswa) meminjam buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/7","icon":"fas fa-hand-holding-heart","color":"var(--primary)"}', NULL, '2026-04-15 17:07:08', '2026-04-15 17:07:08'),
	('4e08bf30-1cfe-4322-bdb1-3cafbf2faf88', 'App\\Notifications\\NewLoanNotification', 'App\\Models\\User', 4, '{"id":6,"title":"Buku Dipinjam","message":"Peminjaman baru: Citra (Siswa) meminjam buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/6","icon":"fas fa-hand-holding-heart","color":"var(--primary)"}', NULL, '2026-04-15 17:07:03', '2026-04-15 17:07:03'),
	('4e91c949-efef-4ac0-8fca-8190b570f1eb', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 2, '{"id":3,"title":"Pengunjung Baru","message":"Pengunjung baru bernama \'Pororo\' telah mencatatkan kunjungan.","url":"http:\\/\\/127.0.0.1:8000\\/pengunjungs","icon":"fas fa-users","color":"var(--info)"}', NULL, '2026-04-15 00:02:19', '2026-04-15 00:02:19'),
	('4e9ffcf4-3387-40b0-a702-28e248d8d250', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 2, '{"id":3,"title":"Buku Baru Ditambahkan","message":"Buku baru judul \'Timun emas\' telah ditambahkan ke katalog.","url":"http:\\/\\/127.0.0.1:8000\\/bukus","icon":"fas fa-book","color":"var(--warning)"}', NULL, '2026-04-15 16:48:44', '2026-04-15 16:48:44'),
	('50d992ae-4122-4423-93e1-ca832e214f0d', 'App\\Notifications\\DataUpdatedNotification', 'App\\Models\\User', 1, '{"id":4,"title":"Data Siswa Diubah","message":"Data siswa bernama \'Ahmad\' telah diperbarui.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/4","icon":"fas fa-user-graduate","color":"var(--secondary)"}', NULL, '2026-04-15 16:43:04', '2026-04-15 16:43:04'),
	('523558ea-2366-4735-a3a9-f02e52949eba', 'App\\Notifications\\DataUpdatedNotification', 'App\\Models\\User', 3, '{"id":1,"title":"Data Buku Diubah","message":"Informasi buku \'laskar pelangi\' telah diperbarui.","url":"http:\\/\\/127.0.0.1:8000\\/bukus","icon":"fas fa-book","color":"var(--secondary)"}', NULL, '2026-04-15 00:11:45', '2026-04-15 00:11:45'),
	('575690ee-d8d7-4563-a5a5-d6702f170a46', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 4, '{"id":5,"title":"Buku Dikembalikan","message":"Buku dikembalikan: Ari Maulana (Siswa) telah mengembalikan buku Timun emas","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/5","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-15 17:06:36', '2026-04-15 17:06:36'),
	('5be4dd91-1154-4026-a5da-cd86939ffcd7', 'App\\Notifications\\NewLoanNotification', 'App\\Models\\User', 4, '{"id":7,"title":"Buku Dipinjam","message":"Peminjaman baru: Citra (Siswa) meminjam buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/7","icon":"fas fa-hand-holding-heart","color":"var(--primary)"}', NULL, '2026-04-15 17:07:08', '2026-04-15 17:07:08'),
	('5c7117a3-92c2-4653-ba27-6f0c218b336d', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 2, '{"id":5,"title":"Buku Dikembalikan","message":"Buku dikembalikan: Ari Maulana (Siswa) telah mengembalikan buku Timun emas","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/5","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-15 17:06:36', '2026-04-15 17:06:36'),
	('613ab9df-a836-4145-a83b-0246f70981ea', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 1, '{"id":4,"title":"User Baru Terdaftar","message":"User sistem baru bernama \'Yanto\' (petugas) telah ditambahkan.","url":"http:\\/\\/127.0.0.1:8000\\/users","icon":"fas fa-cog","color":"var(--primary)"}', NULL, '2026-04-15 16:56:22', '2026-04-15 16:56:22'),
	('6664b115-6f3b-4cb5-999a-bce720ed7e88', 'App\\Notifications\\DataUpdatedNotification', 'App\\Models\\User', 1, '{"id":1,"title":"Data Buku Diubah","message":"Informasi buku \'laskar pelangi\' telah diperbarui.","url":"http:\\/\\/127.0.0.1:8000\\/bukus","icon":"fas fa-book","color":"var(--secondary)"}', '2026-04-15 00:11:59', '2026-04-15 00:11:45', '2026-04-15 00:11:59'),
	('70b7b1a3-f16a-47f3-b345-e2486de3280b', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 4, '{"id":6,"title":"Siswa Baru Terdaftar","message":"Siswa baru bernama \'Ahmadani\' (NIS: 12345) telah didaftarkan.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/6","icon":"fas fa-user-graduate","color":"var(--primary)"}', NULL, '2026-05-03 18:39:02', '2026-05-03 18:39:02'),
	('828b4d08-dd74-4568-937b-18bf4f7fa0a7', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 1, '{"id":5,"title":"Siswa Baru Terdaftar","message":"Siswa baru bernama \'khanya\' (NIS: 1155) telah didaftarkan.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/5","icon":"fas fa-user-graduate","color":"var(--primary)"}', NULL, '2026-05-03 17:59:15', '2026-05-03 17:59:15'),
	('9642de32-0ad4-4fad-8fd3-1072b2e07219', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 2, '{"id":5,"title":"Siswa Baru Terdaftar","message":"Siswa baru bernama \'khanya\' (NIS: 1155) telah didaftarkan.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/5","icon":"fas fa-user-graduate","color":"var(--primary)"}', NULL, '2026-05-03 17:59:15', '2026-05-03 17:59:15'),
	('9c589cd6-21a8-4dc3-b82a-be008d2fbe26', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 1, '{"id":7,"title":"Buku Dikembalikan","message":"Buku dikembalikan: Citra (Siswa) telah mengembalikan buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/7","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-19 15:34:13', '2026-04-19 15:34:13'),
	('a219ddc7-6639-4272-9dec-3f49e3d92c74', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 1, '{"id":6,"title":"Siswa Baru Terdaftar","message":"Siswa baru bernama \'Ahmadani\' (NIS: 12345) telah didaftarkan.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/6","icon":"fas fa-user-graduate","color":"var(--primary)"}', NULL, '2026-05-03 18:39:02', '2026-05-03 18:39:02'),
	('a85eb211-a550-40fc-b3e9-f993c7ecea33', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 1, '{"id":3,"title":"Buku Baru Ditambahkan","message":"Buku baru judul \'Timun emas\' telah ditambahkan ke katalog.","url":"http:\\/\\/127.0.0.1:8000\\/bukus","icon":"fas fa-book","color":"var(--warning)"}', NULL, '2026-04-15 16:48:44', '2026-04-15 16:48:44'),
	('b12c8f6d-e25b-4b5b-9f78-25857c449cba', 'App\\Notifications\\DataUpdatedNotification', 'App\\Models\\User', 1, '{"id":2,"title":"Data Siswa Diubah","message":"Data siswa bernama \'Indra Purnama Putra\' telah diperbarui.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/2","icon":"fas fa-user-graduate","color":"var(--secondary)"}', '2026-04-15 00:16:52', '2026-04-15 00:16:26', '2026-04-15 00:16:52'),
	('b53762a6-c8bb-45db-98fa-404f48535f5f', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 2, '{"id":4,"title":"Siswa Baru Terdaftar","message":"Siswa baru bernama \'Ahmad\' (NIS: 1111) telah didaftarkan.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/4","icon":"fas fa-user-graduate","color":"var(--primary)"}', NULL, '2026-04-15 16:42:24', '2026-04-15 16:42:24'),
	('b556a732-e168-4492-8ec3-6f14ebe5e1af', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 2, '{"id":4,"title":"Pengunjung Baru","message":"Pengunjung baru bernama \'Ayna\' telah mencatatkan kunjungan.","url":"http:\\/\\/127.0.0.1:8000\\/pengunjungs","icon":"fas fa-users","color":"var(--info)"}', NULL, '2026-04-15 16:45:20', '2026-04-15 16:45:20'),
	('bafc4f50-7c3c-426c-beb0-d47af8c11ea0', 'App\\Notifications\\NewLoanNotification', 'App\\Models\\User', 1, '{"id":5,"title":"Buku Dipinjam","message":"Peminjaman baru: Ari Maulana (Siswa) meminjam buku Timun emas","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/5","icon":"fas fa-hand-holding-heart","color":"var(--primary)"}', NULL, '2026-04-15 16:52:41', '2026-04-15 16:52:41'),
	('c5472177-e8c6-460d-b94f-47af7ef5124f', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 1, '{"id":5,"title":"Buku Dikembalikan","message":"Buku dikembalikan: Ari Maulana (Siswa) telah mengembalikan buku Timun emas","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/5","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-15 17:06:36', '2026-04-15 17:06:36'),
	('c8f40ed9-7599-407c-b1a8-7dacf481b7c6', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 4, '{"id":4,"title":"User Baru Terdaftar","message":"User sistem baru bernama \'Yanto\' (petugas) telah ditambahkan.","url":"http:\\/\\/127.0.0.1:8000\\/users","icon":"fas fa-cog","color":"var(--primary)"}', NULL, '2026-04-15 16:56:22', '2026-04-15 16:56:22'),
	('d580f6d5-a594-45bb-91c5-3fcf356340a4', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 2, '{"id":4,"title":"User Baru Terdaftar","message":"User sistem baru bernama \'Yanto\' (petugas) telah ditambahkan.","url":"http:\\/\\/127.0.0.1:8000\\/users","icon":"fas fa-cog","color":"var(--primary)"}', NULL, '2026-04-15 16:56:22', '2026-04-15 16:56:22'),
	('d98aec13-3b6c-41df-a86b-d3f665fab735', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 1, '{"id":4,"title":"Siswa Baru Terdaftar","message":"Siswa baru bernama \'Ahmad\' (NIS: 1111) telah didaftarkan.","url":"http:\\/\\/127.0.0.1:8000\\/siswas\\/4","icon":"fas fa-user-graduate","color":"var(--primary)"}', NULL, '2026-04-15 16:42:24', '2026-04-15 16:42:24'),
	('df9df7e0-c4d5-46fb-a4e9-39846f6654cb', 'App\\Notifications\\NewLoanNotification', 'App\\Models\\User', 2, '{"id":5,"title":"Buku Dipinjam","message":"Peminjaman baru: Ari Maulana (Siswa) meminjam buku Timun emas","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/5","icon":"fas fa-hand-holding-heart","color":"var(--primary)"}', NULL, '2026-04-15 16:52:41', '2026-04-15 16:52:41'),
	('e1fbaf16-8e57-44f3-97a7-13fcc61dd58b', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 2, '{"id":6,"title":"Buku Dikembalikan","message":"Buku dikembalikan: Citra (Siswa) telah mengembalikan buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/6","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-15 17:07:28', '2026-04-15 17:07:28'),
	('e65b7d83-b93a-4018-817a-5e8d4349062e', 'App\\Notifications\\BookReturnedNotification', 'App\\Models\\User', 2, '{"id":4,"title":"Buku Dikembalikan","message":"Buku dikembalikan: yono (Pengunjung) telah mengembalikan buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/4","icon":"fas fa-undo-alt","color":"var(--success)"}', NULL, '2026-04-15 16:52:53', '2026-04-15 16:52:53'),
	('eda098e6-4ff5-437d-b6cc-d0049612fcf3', 'App\\Notifications\\NewLoanNotification', 'App\\Models\\User', 2, '{"id":6,"title":"Buku Dipinjam","message":"Peminjaman baru: Citra (Siswa) meminjam buku Atomic Habits","url":"http:\\/\\/127.0.0.1:8000\\/peminjamans\\/6","icon":"fas fa-hand-holding-heart","color":"var(--primary)"}', NULL, '2026-04-15 17:07:03', '2026-04-15 17:07:03'),
	('fb36f26b-5cd0-4ae1-a605-8db030dda5fa', 'App\\Notifications\\NewDataNotification', 'App\\Models\\User', 3, '{"id":3,"title":"Pengunjung Baru","message":"Pengunjung baru bernama \'Pororo\' telah mencatatkan kunjungan.","url":"http:\\/\\/127.0.0.1:8000\\/pengunjungs","icon":"fas fa-users","color":"var(--info)"}', NULL, '2026-04-15 00:02:19', '2026-04-15 00:02:19');

-- Dumping structure for table db_perpustakaan.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.peminjamans
CREATE TABLE IF NOT EXISTS `peminjamans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned DEFAULT NULL,
  `pengunjung_id` bigint unsigned DEFAULT NULL,
  `buku_id` bigint unsigned NOT NULL,
  `jumlah_pinjam` int NOT NULL DEFAULT '1',
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan','terlambat') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dipinjam',
  `denda` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `peminjamans_siswa_id_foreign` (`siswa_id`),
  KEY `peminjamans_buku_id_foreign` (`buku_id`),
  KEY `peminjamans_pengunjung_id_foreign` (`pengunjung_id`),
  CONSTRAINT `peminjamans_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `peminjamans_pengunjung_id_foreign` FOREIGN KEY (`pengunjung_id`) REFERENCES `pengunjungs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `peminjamans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.peminjamans: ~4 rows (approximately)
INSERT INTO `peminjamans` (`id`, `siswa_id`, `pengunjung_id`, `buku_id`, `jumlah_pinjam`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_dikembalikan`, `status`, `denda`, `created_at`, `updated_at`) VALUES
	(2, 1, NULL, 1, 1, '2026-04-15', '2026-04-22', '2026-04-15', 'dikembalikan', 0, '2026-04-14 22:18:02', '2026-04-14 23:16:02'),
	(3, NULL, 1, 1, 1, '2026-04-15', '2026-04-22', '2026-04-15', 'dikembalikan', 0, '2026-04-14 22:41:46', '2026-04-14 23:15:56'),
	(4, NULL, 2, 2, 1, '2026-04-15', '2026-04-16', '2026-04-16', 'dikembalikan', 0, '2026-04-14 23:16:34', '2026-04-15 16:52:53'),
	(5, 1, NULL, 3, 3, '2026-04-16', '2026-04-20', '2026-04-16', 'dikembalikan', 0, '2026-04-15 16:52:41', '2026-04-15 17:06:36');

-- Dumping structure for table db_perpustakaan.pengunjungs
CREATE TABLE IF NOT EXISTS `pengunjungs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_pengunjung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.pengunjungs: ~3 rows (approximately)
INSERT INTO `pengunjungs` (`id`, `nama_pengunjung`, `alamat`, `no_hp`, `keperluan`, `tanggal_kunjungan`, `created_at`, `updated_at`) VALUES
	(1, 'santoso', 'jl baipas', '085792584079', 'meminjam buku', '2026-04-15', '2026-04-14 22:12:00', '2026-04-14 22:12:00'),
	(2, 'yono', 'jl keboiwe', '0851234567', 'meminjam buku', '2026-04-15', '2026-04-14 23:15:36', '2026-04-14 23:15:36'),
	(3, 'Pororo', 'jalan raya ayam', '052637737627', 'meminjam buku', '2026-04-15', '2026-04-15 00:02:19', '2026-04-15 00:02:19'),
	(4, 'Ayna', 'jl raya canggu', '073663882', 'meminjam buku', '2026-04-16', '2026-04-15 16:45:20', '2026-04-15 16:45:20');

-- Dumping structure for table db_perpustakaan.sessions
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

-- Dumping data for table db_perpustakaan.sessions: ~0 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('R7eAlIkwFdWFBXMfMg1dAWzFNsbap6hx0Fm1m7dR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiUmYxalJDSklpZVdMTnpLcGhFYXZZUnFLcXgxYXR2aGdUMFBwcWhRTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1776232999);

-- Dumping structure for table db_perpustakaan.siswas
CREATE TABLE IF NOT EXISTS `siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswas_nis_unique` (`nis`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.siswas: ~3 rows (approximately)
INSERT INTO `siswas` (`id`, `nama_siswa`, `nis`, `kelas`, `jenis_kelamin`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
	(1, 'Ari Maulana', '1188', 'XI PPLG1', 'Laki-laki', 'jl raya canggu no 37', '085792584079', '2026-04-14 22:11:05', '2026-04-14 22:11:05'),
	(2, 'Indra Purnama Putra', '1199', 'XI PPLG1', 'Laki-laki', 'gang uma diiwang', '08123456789', '2026-04-14 23:21:33', '2026-04-15 00:16:25'),
	(5, 'khanya', '1155', 'XI PPLG1', 'Perempuan', 'jl mana aja', '085787277663', '2026-05-03 17:59:15', '2026-05-03 17:59:15');

-- Dumping structure for table db_perpustakaan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','petugas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'petugas',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
	(1, 'Admin Perpustakaan', 'admin@perpustakaan.com', NULL, '$2y$12$6xXEZb5CG2pZIDKvOqMzmur44RabqEpQCLePdFOdS65827nNRv3.u', 'urhz8CD6dHCzUEZdZyd0I8ukcFgEIVgzKgJPTzjOVYuYZRvjEL4xRY7yX6ds', '2026-04-14 22:01:33', '2026-04-14 22:01:33', 'admin'),
	(2, 'Petugas Perpustakaan', 'petugas@perpustakaan.com', NULL, '$2y$12$UEipBB7I6RGv7V//xW0vTuS92Uqyy0MeJpjStaw8lnrm31j5lVcV.', NULL, '2026-04-14 22:01:34', '2026-04-14 22:01:34', 'petugas'),
	(4, 'Yanto', 'petugas2@perpustakaan.com', NULL, '$2y$12$T2oyI9WanyGMUpnHW9NwqeI4z8p5SIjiMBMOZj/LREco7VafqV4WC', NULL, '2026-04-15 16:56:22', '2026-04-15 16:56:22', 'petugas');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
