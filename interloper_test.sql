/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.27-MariaDB : Database - interloper_test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`interloper_test` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `interloper_test`;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `comments` */

insert  into `comments`(`id`,`post_id`,`author_name`,`content`,`created_at`,`updated_at`) values 
(2,1,'Khadim','tsewer','2023-07-15 09:01:57','2023-07-15 09:01:57'),
(3,1,'Khadim','test','2023-07-15 10:36:17','2023-07-15 10:36:17'),
(4,1,'Khadim','tset','2023-07-15 10:38:24','2023-07-15 10:38:24'),
(5,1,'Khadim','hi','2023-07-15 10:39:01','2023-07-15 10:39:01'),
(7,2,'Khadim','hi','2023-07-15 12:25:44','2023-07-15 12:25:44'),
(8,2,'Khadim','asdfadsfs','2023-07-15 12:25:54','2023-07-15 12:25:54'),
(9,2,'Khadim','asdfa','2023-07-15 12:30:25','2023-07-15 12:30:25'),
(10,2,'Khadim','asdfa','2023-07-15 12:31:11','2023-07-15 12:31:11'),
(11,2,'Khadim','asdfa','2023-07-15 12:31:21','2023-07-15 12:31:21'),
(12,2,'Khadim','tesat','2023-07-15 12:33:27','2023-07-15 12:33:27'),
(13,2,'Khadim','tesat','2023-07-15 12:33:30','2023-07-15 12:33:30'),
(14,3,'Khadim','adfasfd','2023-07-15 12:34:29','2023-07-15 12:34:29'),
(15,3,'Khadim','asdsf','2023-07-15 12:34:53','2023-07-15 12:34:53'),
(16,3,'Khadim','nnnnnn','2023-07-15 12:35:29','2023-07-15 12:35:29'),
(17,3,'Khadim','nnnnnn','2023-07-15 12:35:31','2023-07-15 12:35:31'),
(18,3,'Khadim','test','2023-07-15 12:38:38','2023-07-15 12:38:38'),
(19,3,'Khadim','est','2023-07-15 12:39:07','2023-07-15 12:39:07');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_07_14_173851_create_posts_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `posts` */

insert  into `posts`(`id`,`title`,`content`,`created_at`,`updated_at`) values 
(2,'sfgdsf','sdgffds','2023-07-15 07:31:29','2023-07-15 07:31:29'),
(3,'Khadim','Test','2023-07-15 07:31:45','2023-07-15 11:43:34'),
(5,'hi iam khadim','hi khadim this is your content body','2023-07-15 08:35:50','2023-07-15 11:24:55'),
(6,'English','book','2023-07-15 08:36:13','2023-07-15 11:28:14'),
(7,'Englsih','book','2023-07-15 08:36:58','2023-07-15 11:28:43'),
(9,'Khadim','Khadidm','2023-07-15 08:37:43','2023-07-15 08:37:43'),
(10,'HELO','HELO','2023-07-15 08:38:12','2023-07-15 08:38:12');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Khadim','123moriokhan786@gmail.com',NULL,'$2y$10$XCNFWsx5EiYac5e1jJU2AOmzNo8.lAPerVg0Q.CJ/nV5DtY8LwyWm',NULL,'2023-07-15 03:14:41','2023-07-15 03:14:41'),
(2,'Khadim','admin@gmail.com',NULL,'$2y$10$Vsf6JjmWp0zmZxTIU/UCHuftDnajx0Po8uu2.7O4QZtFHJZI/mZuW',NULL,'2023-07-15 03:18:29','2023-07-15 03:18:29');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
