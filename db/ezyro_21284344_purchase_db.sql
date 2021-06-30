/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.11 : Database - ezyro_21284344_purchase_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ezyro_21284344_purchase_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ezyro_21284344_purchase_db`;

/*Table structure for table `pr_activity_log` */

DROP TABLE IF EXISTS `pr_activity_log`;

CREATE TABLE `pr_activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `content_type` varchar(72) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `action` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `data` text COLLATE utf8mb4_unicode_ci,
  `language_key` tinyint(1) NOT NULL DEFAULT '0',
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `developer` tinyint(1) NOT NULL DEFAULT '0',
  `ip_address` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pr_activity_log` */

insert  into `pr_activity_log`(`id`,`user_id`,`content_type`,`content_id`,`action`,`description`,`details`,`data`,`language_key`,`public`,`developer`,`ip_address`,`user_agent`,`created_at`,`updated_at`) values (1,1,'backups',8,'Create','Create row table backups','create backups field id=8',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-12 08:18:27','2018-02-12 08:18:27'),(2,1,'users',13,'Create','Ceate new row table users','create new row table users id=13',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-13 13:02:20','2018-02-13 13:02:20'),(3,1,'users',3,'Update','Update table users','update table users id=3',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-13 13:31:37','2018-02-13 13:31:37'),(4,1,'users',3,'Update','Update table users','update table users id=3',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-13 13:31:44','2018-02-13 13:31:44'),(5,1,'users',3,'Update','Update table users','update table users id=3',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-13 13:31:51','2018-02-13 13:31:51'),(6,1,'users',11,'Reset','Reset password user','reset password user id=11',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 05:13:16','2018-02-14 05:13:16'),(7,1,'users',3,'Reset','Reset password user','reset password user id=3',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 05:14:01','2018-02-14 05:14:01'),(8,1,'users',1,'Update','user change profile info','user change profile info',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 08:15:55','2018-02-14 08:15:55'),(9,1,'users',1,'Update','user change profile info','user change profile info',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 08:16:15','2018-02-14 08:16:15'),(10,1,'users',1,'Update','user change profile info','user change profile info',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 08:16:23','2018-02-14 08:16:23'),(11,1,'users',1,'Update','user change profile info','user change profile info',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 08:24:08','2018-02-14 08:24:08'),(12,1,'users',1,'Update','user change profile info','user change profile info',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 08:35:10','2018-02-14 08:35:10'),(13,1,'users',1,'Update','user change profile info','user change profile info',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 08:46:09','2018-02-14 08:46:09'),(14,1,'users',1,'Update','user change profile info','user change profile info',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 08:47:41','2018-02-14 08:47:41'),(15,1,'users',1,'Update','user change image','user change image',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 08:55:36','2018-02-14 08:55:36'),(16,1,'users',1,'Update','user change image','user change image',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 09:03:17','2018-02-14 09:03:17'),(17,1,'users',1,'Update','user change image','user change image',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 09:04:15','2018-02-14 09:04:15'),(18,1,'users',1,'Update','user change image','user change image',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 09:05:27','2018-02-14 09:05:27'),(19,1,'users',1,'Update','user change profile info','user change profile info',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 09:27:59','2018-02-14 09:27:59'),(20,1,'users',1,'Update','user change profile info','user change profile info',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 09:32:02','2018-02-14 09:32:02'),(21,1,'users',1,'Update','user change password','user change password',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 09:35:05','2018-02-14 09:35:05'),(22,1,'users',1,'Update','user change password','user change password',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 09:52:38','2018-02-14 09:52:38'),(23,1,'users',1,'Update','user change image','user change image',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 10:42:47','2018-02-14 10:42:47'),(24,1,'users',1,'Update','user change image','user change image',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 13:01:44','2018-02-14 13:01:44'),(25,1,'users',1,'Update','user change image','user change image',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 13:02:00','2018-02-14 13:02:00'),(26,1,'users',1,'Update','user change image','user change image',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 13:03:24','2018-02-14 13:03:24'),(27,1,'users',1,'Update','user change image','user change image',NULL,0,0,0,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36','2018-02-14 13:06:58','2018-02-14 13:06:58');

/*Table structure for table `pr_approve_orders` */

DROP TABLE IF EXISTS `pr_approve_orders`;

CREATE TABLE `pr_approve_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `approved_by` int(11) NOT NULL DEFAULT '0',
  `signature_id` bigint(20) NOT NULL DEFAULT '0',
  `approved_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `pr_approve_orders` */

insert  into `pr_approve_orders`(`id`,`po_id`,`role_id`,`approved_by`,`signature_id`,`approved_date`) values (1,1,10,1,0,'2017-11-22 07:32:36');

/*Table structure for table `pr_approve_requests` */

DROP TABLE IF EXISTS `pr_approve_requests`;

CREATE TABLE `pr_approve_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pr_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `approved_by` int(11) NOT NULL DEFAULT '0',
  `signature_id` bigint(20) NOT NULL DEFAULT '0',
  `approved_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `pr_approve_requests` */

insert  into `pr_approve_requests`(`id`,`pr_id`,`role_id`,`approved_by`,`signature_id`,`approved_date`) values (1,1,10,1,0,'2017-11-22 07:32:36');

/*Table structure for table `pr_backups` */

DROP TABLE IF EXISTS `pr_backups`;

CREATE TABLE `pr_backups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pr_backups` */

insert  into `pr_backups`(`id`,`path`,`created_at`,`updated_at`) values (1,'db-backup-2018-02-12-07-40-02.zip','2018-02-12 07:40:05',NULL),(2,'db-backup-2018-02-12-07-41-03.zip','2018-02-12 07:41:07',NULL),(3,'db-backup-2018-02-12-07-46-53.zip','2018-02-12 07:46:57',NULL),(4,'db-backup-2018-02-12-07-48-02.zip','2018-02-12 07:48:06',NULL),(5,'db-backup-2018-02-12-07-48-46.zip','2018-02-12 07:48:50',NULL),(6,'db-backup-2018-02-12-08-12-00.zip','2018-02-12 08:12:04',NULL),(7,'db-backup-2018-02-12-08-14-12.zip','2018-02-12 08:14:15',NULL),(8,'db-backup-2018-02-12-08-18-24.zip','2018-02-12 08:18:27',NULL);

/*Table structure for table `pr_boq_items` */

DROP TABLE IF EXISTS `pr_boq_items`;

CREATE TABLE `pr_boq_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `boq_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `qty_std` int(11) NOT NULL,
  `qty_add` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `pr_boq_items` */

insert  into `pr_boq_items`(`id`,`boq_id`,`house_id`,`item_id`,`unit`,`qty_std`,`qty_add`,`updated_by`,`updated_at`) values (1,18,4,1,'កេស',100,50,NULL,NULL),(2,18,4,4,'ប្រអប់',100,20,NULL,NULL),(3,18,4,5,'ប្រអប់',100,21,NULL,NULL),(4,18,4,6,'ប្រអប់',100,22,NULL,NULL),(6,19,4,16,'កំប៉ុង',12,0,NULL,NULL),(7,19,4,17,'កំប៉ុង',12,0,NULL,NULL),(8,19,4,19,'សន្លឹក',12,0,NULL,NULL),(9,22,1,1,'កេស',100,50,NULL,NULL),(11,22,1,4,'ប្រអប់',100,20,NULL,NULL),(13,22,1,5,'ប្រអប់',100,21,NULL,NULL),(14,23,4,5,'ប្រអប់',100,30,NULL,NULL),(15,22,1,6,'ប្រអប់',100,22,NULL,NULL),(16,23,4,6,'ប្រអប់',100,20,NULL,NULL),(17,24,1,1,'កំប៉ុង',13,2,NULL,NULL),(18,24,1,15,'សន្លឹក',13,2,NULL,NULL),(19,24,1,16,'កំប៉ុង',13,2,NULL,NULL),(24,26,1,15,'សន្លឹក',10,0,NULL,NULL),(25,26,1,16,'កំប៉ុង',10,0,NULL,NULL),(23,26,1,1,'កំប៉ុង',10,0,NULL,NULL),(26,27,1,1,'កំប៉ុង',100,0,NULL,NULL),(27,27,1,15,'សន្លឹក',100,0,NULL,NULL),(28,28,4,1,'កំប៉ុង',100,0,NULL,NULL),(29,28,4,15,'សន្លឹក',100,0,NULL,NULL),(30,30,1,21,'CC',100,100,NULL,NULL),(31,31,2,21,'CC',100,100,NULL,NULL),(32,32,3,21,'CC',100,100,NULL,NULL);

/*Table structure for table `pr_boqs` */

DROP TABLE IF EXISTS `pr_boqs`;

CREATE TABLE `pr_boqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `house_id` int(11) NOT NULL,
  `line_no` varchar(3) DEFAULT '001',
  `trans_date` date DEFAULT NULL,
  `trans_by` int(11) NOT NULL,
  `trans_type` varchar(10) DEFAULT NULL COMMENT 'Entry,Import',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `pr_boqs` */

insert  into `pr_boqs`(`id`,`house_id`,`line_no`,`trans_date`,`trans_by`,`trans_type`) values (1,1,'001','2017-12-20',1,'Import'),(2,1,'002','2017-12-20',1,'Import'),(3,2,'001','2017-12-20',1,'Import'),(4,2,'002','2017-12-20',1,'Entry'),(5,3,'001','2017-12-20',1,'Entry'),(6,3,'002','2017-12-20',1,'Entry'),(7,13,'001','2017-12-20',1,'Import'),(8,10,'001','2017-12-20',1,'Import'),(9,13,'002','2017-12-20',1,'Import'),(10,13,'003','2017-12-20',1,'Import'),(26,1,'005','2017-12-23',1,'Entry'),(27,1,'006','2017-12-23',1,'Entry'),(15,4,'001','2017-12-20',1,'Import'),(16,4,'002','2017-12-20',1,'Import'),(17,4,'003','2017-12-20',1,'Import'),(18,4,'004','2017-12-20',1,'Import'),(19,4,'005','2017-12-21',1,'Import'),(20,2,'003','2017-12-21',1,'Import'),(21,3,'003','2017-12-21',1,'Import'),(22,1,'003','2017-12-21',1,'Import'),(23,4,'006','2017-12-21',1,'Import'),(24,1,'004','2017-12-21',1,'Import'),(25,4,'007','2017-12-21',1,'Import'),(28,4,'008','2017-12-23',1,'Entry'),(29,4,'009','2018-01-20',1,'Import'),(30,1,'007','2018-01-20',1,'Import'),(31,2,'004','2018-01-20',1,'Import'),(32,3,'004','2018-01-20',1,'Import');

/*Table structure for table `pr_constructors` */

DROP TABLE IF EXISTS `pr_constructors`;

CREATE TABLE `pr_constructors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT 'for id-card',
  `id_card` varchar(50) DEFAULT NULL COMMENT 'for name',
  `address` varchar(200) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `type` char(1) DEFAULT '1' COMMENT '1=engineer, 2=sub constructor',
  `status` char(1) DEFAULT '1' COMMENT '1=active, 0=disable',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `pr_constructors` */

insert  into `pr_constructors`(`id`,`name`,`id_card`,`address`,`tel`,`type`,`status`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'0838792','Sok Chea','Phnom Penh','098665422','2','1',1,'2017-12-05 02:31:12',1,'2018-01-26 07:42:44'),(3,'0838791','Ra Sovann','Phnom Penh','098667512','2','1',2,'2017-12-05 14:53:53',2,'2017-12-05 15:22:10'),(4,'0838794','Khan Savath','Kampong Spue','0976665555','1','1',2,'2017-12-05 14:59:51',2,'2017-12-05 15:16:56'),(5,'0838793','Ra Sovann','Kampong cham','0976665555','2','1',2,'2017-12-05 15:15:49',1,'2018-01-26 07:42:52'),(6,'8387945','Khan Savath','Kampong Spue','0976665555','1','1',NULL,NULL,2,'2017-12-05 23:53:13'),(7,'8387932','Ra Sovann','Kampong cham','0976665555','1','1',NULL,NULL,2,'2017-12-05 23:53:13'),(8,'08387922','HS','Phnom Penh, Porsen chey','0976665555','1','1',2,'2017-12-09 01:28:59',1,'2018-01-26 07:42:13');

/*Table structure for table `pr_deliveries` */

DROP TABLE IF EXISTS `pr_deliveries`;

CREATE TABLE `pr_deliveries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL DEFAULT '0',
  `po_id` int(11) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `trans_date` date NOT NULL,
  `sub_total` float NOT NULL DEFAULT '0',
  `disc_perc` float NOT NULL DEFAULT '0',
  `disc_usd` float NOT NULL DEFAULT '0',
  `grand_total` float NOT NULL DEFAULT '0',
  `note` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `delete` char(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `pr_deliveries` */

insert  into `pr_deliveries`(`id`,`pro_id`,`po_id`,`sup_id`,`ref_no`,`trans_date`,`sub_total`,`disc_perc`,`disc_usd`,`grand_total`,`note`,`photo`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,2,1,1,'DEL-1802/001','2018-02-06',100,10,10,90,'Testing delivery items',NULL,'0',1,'2018-02-06 19:23:23',NULL,NULL),(2,2,3,1,'DEL-1802/002','2018-02-08',12000,10,1200,10800,'Testing delivery items','picture_2018_02_08_07_28_57_2017-11-03 08.51.03.jpg','1',1,'2018-02-08 07:28:57',1,'2018-02-10 05:25:23'),(3,2,3,1,'DEL-1802/003','2018-02-08',11960,10,1196,10764,'Testing delivery items',NULL,'1',1,'2018-02-08 07:32:13',1,'2018-02-09 01:40:01'),(4,2,6,1,'DEL-1802/004','2018-02-08',4340,10,884,3456,'Testing delivery stocks',NULL,'1',1,'2018-02-08 07:35:20',1,'2018-02-09 01:39:58'),(5,2,9,1,'DEL-1802/005','2018-02-08',5810,4,472.4,5337.6,'Testing delivery stock',NULL,'1',1,'2018-02-08 09:42:32',1,'2018-02-09 01:39:55'),(6,2,12,1,'DEL-1802/006','2018-02-08',12810,5,340.5,12469.5,'Testing delivery',NULL,'1',1,'2018-02-08 12:40:29',1,'2018-02-08 13:31:29'),(7,2,12,1,'DEL-1802/007','2018-02-08',7000,0,0,7000,NULL,NULL,'1',1,'2018-02-08 13:39:09',1,'2018-02-08 13:40:16'),(8,2,6,1,'DEL-1802/008','2018-02-09',8820,4,352.8,8467.2,'Testing delivery items','picture_2018_02_09_01_25_56_2017-11-03 08.51.03.jpg','1',1,'2018-02-09 01:23:39',1,'2018-02-09 01:39:10'),(9,2,3,1,'DEL-1802/009','2018-02-09',8880,5,294,8586,'testing delivery items','picture_2018_02_09_01_41_00_2017-11-03 08.51.03.jpg','1',1,'2018-02-09 01:41:00',1,'2018-02-09 01:41:53'),(10,2,3,1,'DEL-1802/010','2018-02-09',5880,10,588,5292,'dde',NULL,'1',1,'2018-02-09 01:46:27',1,'2018-02-09 01:57:28'),(11,2,3,1,'DEL-1802/011','2018-02-09',11760,10,1176,10584,'sadf',NULL,'1',1,'2018-02-09 01:59:23',1,'2018-02-09 01:59:42');

/*Table structure for table `pr_delivery_items` */

DROP TABLE IF EXISTS `pr_delivery_items`;

CREATE TABLE `pr_delivery_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `del_id` int(11) NOT NULL DEFAULT '0',
  `warehouse_id` int(11) NOT NULL,
  `line_no` varchar(5) NOT NULL DEFAULT '001',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `unit` varchar(10) NOT NULL,
  `qty` float NOT NULL DEFAULT '0',
  `return_qty` float NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `disc_perc` float NOT NULL DEFAULT '0',
  `disc_usd` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `pr_delivery_items` */

insert  into `pr_delivery_items`(`id`,`del_id`,`warehouse_id`,`line_no`,`item_id`,`unit`,`qty`,`return_qty`,`price`,`amount`,`disc_perc`,`disc_usd`,`total`,`desc`) values (1,1,6,'001',1,'កេស',100,67,10.5,1050,10,105,945,NULL),(2,1,6,'002',5,'ប្រអប់',100,7.5,2,200,10,20,180,NULL),(3,2,6,'001',1,'កេស',100,0,50,5000,1,0,5000,'testing'),(4,3,6,'001',1,'កេស',100,0,50,5000,1,0,5000,NULL),(5,3,6,'002',4,'ប្រអប់',100,0,20,2000,2,40,1960,NULL),(6,3,6,'003',1,'កេស',100,0,50,5000,3,0,5000,NULL),(7,4,6,'001',4,'ប្រអប់',50,0,20,1000,1,20,980,'testing'),(8,4,6,'002',1,'កេស',50,0,50,2500,2,100,2400,'testing'),(9,4,6,'003',4,'ប្រអប់',50,0,20,1000,2,40,960,'testing'),(10,5,6,'001',1,'កេស',50,0,50,2500,1,0,2500,'testing'),(11,5,6,'002',4,'ប្រអប់',50,0,20,1000,2,40,960,'testing'),(12,5,6,'003',1,'កេស',50,0,50,2500,3,150,2350,'testing'),(13,6,6,'001',4,'ដុំ',200,0,20,4000,1,10,3990,'null'),(14,6,6,'002',1,'កន្លះ',50,0,50,2500,2,50,2450,'null'),(15,6,6,'003',4,'ដុំ',200,0,20,4000,3,30,3970,'null'),(16,6,6,'004',1,'កន្លះ',50,0,50,2500,4,100,2400,'null'),(17,7,6,'001',4,'ប្រអប់',50,0,20,1000,0,0,1000,'dd'),(18,7,6,'002',1,'កេស',50,0,50,2500,0,0,2500,'dd'),(19,7,6,'003',4,'ប្រអប់',50,0,20,1000,0,0,1000,'dd'),(20,7,6,'004',1,'កេស',50,0,50,2500,0,0,2500,'dd'),(21,8,6,'001',4,'ប្រអប់',100,0,20,2000,1,20,1980,'ss'),(22,8,6,'002',1,'កេស',100,0,50,5000,2,100,4900,'ss'),(23,8,6,'003',4,'ប្រអប់',100,0,20,2000,3,60,1940,'ss'),(24,9,6,'001',1,'កន្លះ',50,0,50,2500,1,25,2475,'aa'),(25,9,6,'002',4,'ដុំ',200,0,20,4000,2,20,3980,'bb'),(26,9,6,'003',1,'កន្លះ',50,0,50,2500,3,75,2425,'cc'),(27,10,6,'001',1,'កេស',50,0,50,2500,1,25,2475,'ds'),(28,10,6,'002',4,'ប្រអប់',50,0,20,1000,2,20,980,'ssd'),(29,10,6,'003',1,'កេស',50,0,50,2500,3,75,2425,'s'),(30,11,6,'001',1,'កេស',100,0,50,5000,1,50,4950,'ee'),(31,11,6,'002',4,'ប្រអប់',100,0,20,2000,2,40,1960,'ee'),(32,11,6,'003',1,'កេស',100,0,50,5000,3,150,4850,'ee');

/*Table structure for table `pr_format_invoices` */

DROP TABLE IF EXISTS `pr_format_invoices`;

CREATE TABLE `pr_format_invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `format_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `format_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` int(11) NOT NULL,
  `prefix` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subfix` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_from` int(11) NOT NULL,
  `interval` int(11) NOT NULL,
  `example` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_round` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M',
  `type` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pr_format_invoices` */

insert  into `pr_format_invoices`(`id`,`format_code`,`format_name`,`length`,`prefix`,`subfix`,`start_from`,`interval`,`example`,`duration_round`,`type`,`user_create`,`user_update`,`status`,`created_at`,`updated_at`) values (1,'FRM-ENT','Stock Entry',3,'ENT-!YY!!MM!/','',1,1,'ENT-1801/001','M','ENT',1,1,'1','2018-01-18 19:09:12','2018-01-18 19:09:14'),(2,'FRM-IMP','Stock Import Excel',3,'IMP-!YY!!MM!/','',1,1,'IMP-1801/001','M','IMP',1,2,'1','2018-01-20 09:20:37','2018-01-20 09:20:39'),(3,'FRM-ADJ','Stock Adjustment',3,'ADJ-!YY!!MM!/','',1,1,'ADJ-1801/001','M','ADJ',1,1,'1','2018-01-22 13:46:21','2018-02-02 14:16:27'),(4,'FRM-MOV','Stock movement',3,'MOV-!YY!!MM!/','',1,1,'MOV-1801/001','M','MOV',1,1,'1','2018-01-25 14:50:50','2018-02-02 14:16:25'),(5,'FRM-USE','Usage items',3,'USE-!YY!!MM!/','',1,1,'USE-1801/001','M','USE',1,1,'1','2018-01-26 15:26:33','2018-02-02 14:16:23'),(6,'FRM-REU','Return usage items',3,'REU-!YY!!MM!/','',1,1,'REU-1801/001','M','REU',1,1,'1','2018-01-27 17:49:14','2018-02-02 14:16:21'),(7,'FRM-PR','Purchase requests',3,'PR-!YY!!MM!/','',1,1,'PR-1801/001','M','PR',1,1,'1','2018-01-29 20:17:31','2018-02-02 14:16:19'),(8,'FRM-PO','purchase order',3,'PO-!YY!!MM!/','',1,1,'PO-1802/001','M','PO',1,1,'1','2018-02-02 14:16:14','2018-02-02 14:16:16'),(9,'FRM-DEL','delivery stocks',3,'DEL-!YY!!MM!/','',1,1,'DEL-1802/001','M','DEL',1,1,'1','2018-02-07 19:22:31','2018-02-07 19:22:34'),(10,'FRM-RED','return delivery stock',3,'RED-!YY!!MM!/','',1,1,'RED-1802/001','M','RED',1,1,'1','2018-02-09 14:01:14','2018-02-09 14:01:18');

/*Table structure for table `pr_houses` */

DROP TABLE IF EXISTS `pr_houses`;

CREATE TABLE `pr_houses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `house_no` varchar(50) DEFAULT NULL,
  `house_desc` varchar(150) DEFAULT NULL,
  `house_type` int(11) NOT NULL DEFAULT '0',
  `pro_id` int(11) NOT NULL DEFAULT '0',
  `zone_id` int(11) NOT NULL DEFAULT '0',
  `block_id` int(11) NOT NULL DEFAULT '0',
  `street_id` int(11) NOT NULL DEFAULT '0',
  `status` char(1) DEFAULT '1' COMMENT '1=Start,2=Finish,3=Stop',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `pr_houses` */

insert  into `pr_houses`(`id`,`house_no`,`house_desc`,`house_type`,`pro_id`,`zone_id`,`block_id`,`street_id`,`status`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'No.167','House number 167',15,2,18,21,24,'1',NULL,NULL,1,'2017-12-14 16:06:42'),(2,'No.165','House Number 165',13,2,18,21,24,'1',1,'2017-12-14 02:38:06',1,'2017-12-14 16:11:21'),(3,'No.166','House Number 166',13,2,18,21,24,'1',1,'2017-12-14 02:38:06',NULL,NULL),(4,'No.168','House Number 167',15,2,18,21,24,'1',1,'2017-12-14 02:40:44',1,'2017-12-14 16:11:48'),(6,'No.1672','House number 167',15,2,18,21,24,'2',1,'2017-12-14 17:19:13',NULL,NULL),(7,'No.1652','House Number 165',13,2,18,21,24,'2',1,'2017-12-14 17:19:13',NULL,NULL),(8,'No.1662','House Number 166',13,2,18,21,24,'2',1,'2017-12-14 17:19:13',NULL,NULL),(9,'No.1682','House Number 167',15,2,18,21,24,'2',1,'2017-12-14 17:19:13',NULL,NULL),(10,'No.1673','House number 167',15,2,18,21,24,'3',1,'2017-12-14 17:27:13',NULL,NULL),(11,'No.1653','House Number 165',13,2,18,21,24,'3',1,'2017-12-14 17:27:13',NULL,NULL),(12,'No.1663','House Number 166',13,2,18,21,24,'3',1,'2017-12-14 17:27:13',NULL,NULL),(13,'No.1683','House Number 167',15,2,18,21,24,'3',1,'2017-12-14 17:27:13',NULL,NULL);

/*Table structure for table `pr_items` */

DROP TABLE IF EXISTS `pr_items`;

CREATE TABLE `pr_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `desc` varchar(200) DEFAULT NULL,
  `unit_stock` varchar(10) NOT NULL,
  `unit_usage` varchar(10) NOT NULL,
  `unit_purch` varchar(10) NOT NULL,
  `cost_purch` float NOT NULL DEFAULT '0',
  `status` char(1) DEFAULT '1',
  `photo` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `pr_items` */

insert  into `pr_items`(`id`,`cat_id`,`code`,`name`,`desc`,`unit_stock`,`unit_usage`,`unit_purch`,`cost_purch`,`status`,`photo`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,7,'B01','ABC','ABC','កំប៉ុង','កំប៉ុង','កេស',50,'1','',NULL,NULL,NULL,NULL),(4,9,'P01','A3','A3','សន្លឹក','សន្លឹក','ប្រអប់',20,'1','',NULL,NULL,NULL,NULL),(5,9,'P02','A4','A4','សន្លឹក','សន្លឹក','ប្រអប់',21,'1','',NULL,NULL,NULL,NULL),(6,9,'P03','A5','A5','សន្លឹក','សន្លឹក','ប្រអប់',22,'1','',NULL,NULL,NULL,NULL),(15,7,'KB-40x40','ការ៉ូបាត 40x40','ការ៉ូបាត 40x40','សន្លឹក','សន្លឹក','សន្លឹក',12,'1','picture_2018_01_02_13_16_48_Purchase.PNG',1,'2017-12-19 01:02:13',1,'2018-01-02 13:16:48'),(16,7,'KB-30x60','ការ៉ូបាត 30x60','ការ៉ូបាត៣០x៦០','កំប៉ុង','កំប៉ុង','កេស',50,'1',NULL,1,'2017-12-19 01:03:04',1,'2018-01-02 13:15:31'),(17,7,'KB-50x50','ការ៉ូបាត 50x50','ការ៉ូបាត៥០x៥០','កំប៉ុង','កំប៉ុង','កំប៉ុង',123,'1',NULL,1,'2017-12-19 01:03:04',1,'2018-01-02 13:15:48'),(18,7,'KB-60x60','ការ៉ូបាត 60x60','ការ៉ូបាត៦០x៦០','សន្លឹក','សន្លឹក','ប្រអប់',20,'1',NULL,1,'2017-12-19 01:03:04',1,'2018-01-02 13:16:11'),(19,7,'KB-30x30','ការ៉ូបាត 30x30','ការ៉ូបាត៣០x៣០','សន្លឹក','សន្លឹក','ប្រអប់',21,'1','picture_2018_01_02_13_17_06_IMG_6153 copy.jpg',1,'2017-12-19 01:03:04',1,'2018-01-02 13:17:06'),(21,40,'AA','BB','BB import from excel file','AB','AB','BA',1,'1',NULL,1,'2018-01-20 02:07:43',NULL,NULL),(22,41,'Iphone8','Iphone 8','Iphone 8 import from excel file','គ្រឿង','គ្រឿង','គ្រឿង',250,'1',NULL,1,'2018-01-20 04:06:32',NULL,NULL),(23,42,'PC-01','Acer','Acer import from excel file','Unit','Unit','Unit',500,'1',NULL,1,'2018-01-22 06:19:47',NULL,NULL),(24,42,'PC-02','Dell','Dell import from excel file','Unit','Unit','Unit',500,'1',NULL,1,'2018-01-22 06:28:54',NULL,NULL);

/*Table structure for table `pr_migrations` */

DROP TABLE IF EXISTS `pr_migrations`;

CREATE TABLE `pr_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pr_migrations` */

insert  into `pr_migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_11_29_040152_create_activity_log_table',2),(4,'2018_01_18_121427_create_stock_entries_table',3),(5,'2018_01_19_100704_create_stock_imports_table',4),(6,'2018_01_22_050615_create_stock_adjusts_table',5),(7,'2018_01_22_061428_create_stock_adjust_details_table',6),(8,'2018_01_25_072309_create_stock_moves_table',7),(9,'2018_01_25_074329_create_stock_move_details_table',8),(10,'2018_01_26_044441_create_usages_table',9),(11,'2018_01_26_044733_create_usate_details_table',10),(12,'2018_01_26_115225_create_return_usages_table',11),(13,'2018_01_26_115314_create_return_usage_details_table',12),(14,'2013_09_12_234559_create_activity_log_table',13),(15,'2016_05_12_142519_alter_activity_log_table_add_additional_fields',13),(16,'2018_02_10_131130_create_backups_table',14);

/*Table structure for table `pr_order_items` */

DROP TABLE IF EXISTS `pr_order_items`;

CREATE TABLE `pr_order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL DEFAULT '0',
  `line_no` varchar(3) DEFAULT '001',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `unit` varchar(15) NOT NULL,
  `qty` float NOT NULL DEFAULT '0',
  `deliv_qty` float NOT NULL DEFAULT '0',
  `closed_qty` float NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `disc_perc` float NOT NULL,
  `disc_usd` float NOT NULL,
  `total` float NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

/*Data for the table `pr_order_items` */

insert  into `pr_order_items`(`id`,`po_id`,`line_no`,`item_id`,`unit`,`qty`,`deliv_qty`,`closed_qty`,`price`,`amount`,`disc_perc`,`disc_usd`,`total`,`desc`) values (1,1,'001',1,'កេស',100,-100,0,50,0,0,0,0,NULL),(2,1,'002',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(3,1,'003',1,'កេស',100,0,0,50,0,0,0,0,NULL),(4,2,'001',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(5,2,'002',1,'កេស',100,0,0,50,0,0,0,0,NULL),(6,2,'003',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(7,3,'001',1,'កេស',100,-300,0,50,0,0,0,0,NULL),(8,3,'002',4,'ប្រអប់',100,-200,0,20,0,0,0,0,NULL),(9,3,'003',1,'កេស',100,-200,0,50,0,0,0,0,NULL),(10,4,'001',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(11,4,'002',1,'កេស',100,0,0,50,0,0,0,0,NULL),(12,4,'003',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(13,5,'001',1,'កេស',100,0,0,50,0,0,0,0,NULL),(14,5,'002',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(15,5,'003',1,'កេស',100,0,0,50,0,0,0,0,NULL),(16,6,'001',4,'ប្រអប់',100,-40000,0,20,0,0,0,0,NULL),(17,6,'002',1,'កេស',100,-2400,0,50,0,0,0,0,NULL),(18,6,'003',4,'ប្រអប់',100,-40000,0,20,0,0,0,0,NULL),(19,7,'001',1,'កេស',100,0,0,50,0,0,0,0,NULL),(20,7,'002',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(21,7,'003',1,'កេស',100,0,0,50,0,0,0,0,NULL),(22,8,'001',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(23,8,'002',1,'កេស',100,0,0,50,0,0,0,0,NULL),(24,8,'003',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(25,9,'001',1,'កេស',100,-2300,0,50,0,0,0,0,NULL),(26,9,'002',4,'ប្រអប់',100,-39900,0,20,0,0,0,0,NULL),(27,9,'003',1,'កេស',100,-2300,0,50,0,0,0,0,NULL),(28,10,'001',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(29,10,'002',1,'កេស',100,0,0,50,0,0,0,0,NULL),(30,10,'003',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(31,11,'001',1,'កេស',100,0,0,50,0,0,0,0,NULL),(32,11,'002',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(33,11,'003',1,'កេស',100,0,0,50,0,0,0,0,NULL),(34,12,'001',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(35,12,'002',1,'កេស',100,0,0,50,0,0,0,0,NULL),(36,12,'003',4,'ប្រអប់',100,0,0,20,0,0,0,0,NULL),(37,12,'004',1,'កេស',100,0,0,50,0,0,0,0,NULL),(38,15,'001',1,'កន្លះ',100,0,0,50,5000,0,0,5000,NULL),(39,15,'002',4,'ដុំ',100,0,0,20,2000,0,0,2000,NULL),(40,15,'003',1,'កន្លះ',100,0,0,50,5000,0,0,5000,NULL),(41,16,'001',1,'កន្លះ',50,0,0,50,2500,0,0,2500,NULL),(42,16,'002',4,'ដុំ',100,0,0,20,2000,0,0,2000,NULL),(43,16,'003',1,'កន្លះ',50,0,0,50,2500,0,0,2500,NULL),(44,17,'001',4,'ប្រអប់',100,0,0,20,2000,0,0,2000,NULL),(45,17,'002',1,'កេស',100,0,0,50,5000,0,0,5000,NULL),(46,17,'003',4,'ប្រអប់',100,0,0,20,2000,0,0,2000,NULL),(47,18,'001',1,'កេស',50,0,0,50,2500,0,0,2500,NULL),(48,18,'002',4,'ប្រអប់',8,0,0,20,150,0,0,150,NULL),(49,18,'003',1,'កេស',5,0,0,50,250,0,0,250,NULL),(50,19,'001',1,'កន្លះ',1,0,0,50,50,0,0,50,NULL),(51,19,'002',4,'ប្រអប់',1,0,0,20,20,0,0,20,NULL),(52,19,'003',1,'កន្លះ',1,0,0,50,50,0,0,50,NULL),(53,20,'001',1,'កេស',0,0,0,50,0,0,0,0,NULL),(54,20,'002',4,'ប្រអប់',0,0,0,20,0,0,0,0,NULL),(55,20,'003',1,'កេស',0,0,0,50,0,0,0,0,NULL),(56,21,'001',1,'កេស',10,0,0,50,500,1,5,495,'testing'),(57,21,'002',4,'ប្រអប់',10,0,0,20,200,2,4,196,'testing'),(58,21,'003',1,'កេស',10,0,0,50,500,3,15,485,'testing'),(59,22,'002',4,'ដុំ',200,0,0,20,4000,1,10,3990,'testing'),(60,22,'003',1,'កន្លះ',50,0,0,50,2500,2,50,2450,'testing'),(61,22,'004',4,'ដុំ',200,0,0,20,4000,3,30,3970,'testing'),(62,22,'005',1,'កន្លះ',50,0,0,50,2500,4,100,2400,'testing');

/*Table structure for table `pr_orders` */

DROP TABLE IF EXISTS `pr_orders`;

CREATE TABLE `pr_orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL DEFAULT '0',
  `pr_id` int(11) NOT NULL DEFAULT '0',
  `dep_id` int(11) NOT NULL DEFAULT '0',
  `sup_id` int(11) NOT NULL DEFAULT '0',
  `ref_no` varchar(30) NOT NULL,
  `trans_date` date NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_address` int(11) NOT NULL DEFAULT '0',
  `trans_status` char(1) NOT NULL DEFAULT '1' COMMENT '1=padding,2=approving,3=completed,4=rejected,0=trash',
  `sub_total` float NOT NULL DEFAULT '0',
  `disc_perc` float NOT NULL DEFAULT '0',
  `disc_usd` float NOT NULL DEFAULT '0',
  `grand_total` float NOT NULL DEFAULT '0',
  `ordered_by` int(11) NOT NULL DEFAULT '0',
  `note` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `pr_orders` */

insert  into `pr_orders`(`id`,`pro_id`,`pr_id`,`dep_id`,`sup_id`,`ref_no`,`trans_date`,`delivery_date`,`delivery_address`,`trans_status`,`sub_total`,`disc_perc`,`disc_usd`,`grand_total`,`ordered_by`,`note`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,2,1,1,1,'PO-1117/001','2017-11-20','2018-02-01',6,'1',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(2,2,1,2,1,'PO-1117/002','2017-11-20','2018-02-01',6,'2',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(3,2,1,3,1,'PO-1117/003','2017-11-20','2018-02-01',6,'3',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(4,2,1,4,1,'PO-1117/004','2017-11-20','2018-02-01',6,'1',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(5,2,1,1,1,'PO-1117/005','2017-11-20','2018-02-01',6,'2',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(6,2,1,2,1,'PO-1117/006','2017-11-20','2018-02-01',6,'3',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(7,2,1,3,1,'PO-1117/007','2017-11-20','2018-02-01',6,'1',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(8,2,1,4,1,'PO-1117/008','2017-11-20','2018-02-01',6,'2',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(9,2,1,1,1,'PO-1117/009','2017-11-20','2018-02-01',6,'3',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(10,2,1,2,1,'PO-1117/010','2017-11-20','2018-02-01',6,'1',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(11,2,1,3,1,'PO-1117/011','2017-11-20','2018-02-01',6,'2',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(12,2,1,4,1,'PO-1117/012','2017-11-20','2018-02-01',6,'3',0,0,0,0,1,NULL,NULL,NULL,NULL,NULL),(13,2,6,0,1,'PO-1802/001','2018-02-05','2018-02-05',6,'1',9000,10,900,8100,3,'testing purchase order',1,'2018-02-05 08:06:05',NULL,NULL),(14,2,6,0,1,'PO-1802/002','2018-02-05','2018-02-05',6,'1',9000,0,0,9000,1,'dd',1,'2018-02-05 08:09:35',NULL,NULL),(15,2,9,0,2,'PO-1802/003','2018-02-05','2018-02-05',6,'1',12000,10,1200,10800,3,'testing purchase order',1,'2018-02-05 08:15:18',NULL,NULL),(16,2,9,0,1,'PO-1802/004','2018-02-05','2018-02-05',6,'1',6750,10,675,6075,1,NULL,1,'2018-02-05 08:18:43',NULL,NULL),(17,2,6,0,1,'PO-1802/005','2018-02-05','2018-02-05',6,'1',9000,0,0,9000,1,NULL,1,'2018-02-05 08:21:46',NULL,NULL),(18,2,9,0,1,'PO-1802/006','2018-02-05','2018-02-05',6,'1',9250,0,0,2900,1,NULL,1,'2018-02-05 08:22:20',NULL,NULL),(19,2,9,0,1,'PO-1802/007','2018-02-05','2018-02-05',6,'0',6350,0,0,120,3,NULL,1,'2018-02-05 08:23:08',1,'2018-02-06 10:23:45'),(20,2,9,0,1,'PO-1802/008','2018-02-05','2018-02-05',6,'0',6230,0,0,0,1,NULL,1,'2018-02-05 08:23:59',1,'2018-02-06 10:23:36'),(21,2,9,0,1,'PO-1802/009','2018-02-08','2018-02-08',6,'1',1176,4,47.04,1128.96,4,'Testing purchase order',1,'2018-02-08 12:35:27',NULL,NULL),(22,2,12,0,1,'PO-1802/010','2018-02-08','2018-02-08',6,'0',6810,5,340.5,12469.5,1,NULL,1,'2018-02-08 12:47:03',1,'2018-02-08 13:12:03');

/*Table structure for table `pr_permissions` */

DROP TABLE IF EXISTS `pr_permissions`;

CREATE TABLE `pr_permissions` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `order` char(1) DEFAULT 'Y',
  `request` char(1) DEFAULT 'Y',
  `usage` char(1) DEFAULT 'Y',
  `return` char(1) DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `pr_permissions` */

/*Table structure for table `pr_projects` */

DROP TABLE IF EXISTS `pr_projects`;

CREATE TABLE `pr_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` varchar(150) DEFAULT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `status` char(1) DEFAULT '1' COMMENT '1=active,0=trash',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `pr_projects` */

insert  into `pr_projects`(`id`,`name`,`desc`,`tel`,`email`,`url`,`address`,`profile`,`cover`,`status`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'Kampu Borey','project head office','093 884 283','admin@kampu.com','www.kampu.com','#23, St2004, Sangkat Cham chov, Khan Porsen chey, Phnom Penh','assets/pages/img/avatars/team7.jpg','assets/pages/img/background/32.jpg','2',1,'2017-11-28 01:36:42',NULL,NULL),(2,'Kampu Borey2','sub project kampu borey','012 555 877','admin@kampu.com','www.kampu.com','#23, St2004, Sangkat Cham chov, Khan Porsen chey, Phnom Penh','assets/pages/img/avatars/team16.jpg','assets/pages/img/background/33.jpg','1',2,'2017-11-28 03:10:44',NULL,NULL);

/*Table structure for table `pr_request_items` */

DROP TABLE IF EXISTS `pr_request_items`;

CREATE TABLE `pr_request_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `line_no` varchar(3) DEFAULT '001',
  `pr_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `unit` varchar(15) NOT NULL,
  `qty` float NOT NULL DEFAULT '0',
  `boq_set` float NOT NULL DEFAULT '0',
  `ordered_qty` float NOT NULL DEFAULT '0',
  `closed_qty` float NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*Data for the table `pr_request_items` */

insert  into `pr_request_items`(`id`,`line_no`,`pr_id`,`item_id`,`unit`,`qty`,`boq_set`,`ordered_qty`,`closed_qty`,`price`,`desc`) values (1,'001',1,1,'កេស',100,0,0,0,50,NULL),(2,'002',1,4,'ប្រអប់',100,0,0,0,20,NULL),(3,'003',1,1,'កេស',100,0,0,0,50,NULL),(4,'001',2,4,'ប្រអប់',100,0,0,0,20,NULL),(5,'002',2,1,'កេស',100,0,0,0,50,NULL),(6,'003',2,4,'ប្រអប់',100,0,0,0,20,NULL),(7,'001',3,1,'កេស',100,0,95,5,50,NULL),(8,'002',3,4,'ប្រអប់',100,0,95,5,20,NULL),(9,'003',3,1,'កេស',100,0,95,5,50,NULL),(10,'001',4,4,'ប្រអប់',100,0,0,0,20,NULL),(11,'002',4,1,'កេស',100,0,0,0,50,NULL),(12,'003',4,4,'ប្រអប់',100,0,0,0,20,NULL),(13,'001',5,1,'កេស',100,0,0,0,50,NULL),(14,'002',5,4,'ប្រអប់',100,0,0,0,20,NULL),(15,'003',5,1,'កេស',100,0,0,0,50,NULL),(16,'001',6,4,'ប្រអប់',100,0,100,0,20,NULL),(17,'002',6,1,'កេស',100,0,100,0,50,NULL),(18,'003',6,4,'ប្រអប់',100,0,100,0,20,NULL),(19,'001',7,1,'កេស',100,0,0,0,50,NULL),(20,'002',7,4,'ប្រអប់',100,0,0,0,20,NULL),(21,'003',7,1,'កេស',100,0,0,0,50,NULL),(22,'001',8,4,'ប្រអប់',100,0,0,0,20,NULL),(23,'002',8,1,'កេស',100,0,0,0,50,NULL),(24,'003',8,4,'ប្រអប់',100,0,0,0,20,NULL),(25,'001',9,1,'កេស',100,0,85,0,50,NULL),(26,'002',9,4,'ប្រអប់',100,0,31,0,20,NULL),(27,'003',9,1,'កេស',100,0,40.5,0,50,NULL),(28,'001',10,4,'ប្រអប់',100,0,0,0,20,NULL),(29,'002',10,1,'កេស',100,0,0,0,50,NULL),(30,'003',10,4,'ប្រអប់',100,0,0,0,20,NULL),(31,'001',11,1,'កេស',100,0,0,0,50,NULL),(32,'002',11,4,'ប្រអប់',100,0,0,0,20,NULL),(33,'003',11,1,'កេស',100,0,0,0,50,NULL),(34,'002',12,4,'ប្រអប់',100,0,0,0,20,NULL),(35,'003',12,1,'កេស',100,0,0,0,50,NULL),(36,'004',12,4,'ប្រអប់',100,0,0,0,20,NULL),(37,'005',12,1,'កេស',100,0,0,0,50,NULL),(38,'001',13,16,'កេស',1,1.54167,0,0,50,'testing'),(39,'002',13,15,'សន្លឹក',1,225,0,0,12,'testing'),(40,'001',14,15,'សន្លឹក',1,224,0,0,12,'invoice IVN-002'),(41,'002',14,16,'កំប៉ុង',1,13,0,0,50,'testing');

/*Table structure for table `pr_requests` */

DROP TABLE IF EXISTS `pr_requests`;

CREATE TABLE `pr_requests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(30) NOT NULL,
  `trans_date` date NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `trans_status` char(1) NOT NULL DEFAULT '1' COMMENT '1=pendding,2=approving,3=completed,4=rejected,0=trash',
  `request_by` int(11) NOT NULL DEFAULT '0',
  `pro_id` int(11) NOT NULL DEFAULT '0',
  `dep_id` int(11) NOT NULL DEFAULT '0',
  `note` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `pr_requests` */

insert  into `pr_requests`(`id`,`ref_no`,`trans_date`,`delivery_date`,`trans_status`,`request_by`,`pro_id`,`dep_id`,`note`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'PR-1117/001','2017-11-20','2018-01-29','1',1,2,1,'Testing enter',NULL,NULL,NULL,NULL),(2,'PR-1117/002','2017-11-20','2018-01-29','2',1,2,2,'Testing enter',NULL,NULL,NULL,NULL),(3,'PR-1117/003','2017-11-20','2018-01-29','3',1,2,3,'Testing enter',NULL,NULL,NULL,NULL),(4,'PR-1117/004','2017-11-20','2018-01-29','0',1,2,4,'Testing enter',NULL,NULL,1,'2018-02-01 11:53:11'),(5,'PR-1117/005','2017-11-20','2018-01-29','0',1,2,1,'Testing enter',NULL,NULL,1,'2018-02-01 11:52:40'),(6,'PR-1117/006','2017-11-20','2018-01-29','3',1,2,2,'Testing enter',NULL,NULL,NULL,NULL),(7,'PR-1117/007','2017-11-20','2018-01-29','1',1,2,3,'Testing enter',NULL,NULL,NULL,NULL),(8,'PR-1117/008','2017-11-20','2018-01-29','2',1,2,4,'Testing enter',NULL,NULL,NULL,NULL),(9,'PR-1117/009','2017-11-20','2018-01-29','3',1,2,1,'Testing enter',NULL,NULL,NULL,NULL),(10,'PR-1117/010','2017-11-20','2018-01-29','1',1,2,2,'Testing enter',NULL,NULL,NULL,NULL),(11,'PR-1117/011','2017-11-20','2018-01-29','2',1,2,3,'Testing enter',NULL,NULL,NULL,NULL),(12,'PR-1117/012','2017-11-20','2018-01-29','3',1,2,4,'Testing enter',NULL,NULL,NULL,NULL),(13,'PR-1802/001','2018-02-01','2018-02-01','0',1,2,0,'testing purchase requests',1,'2018-02-01 10:50:17',1,'2018-02-06 10:26:56'),(14,'PR-1802/002','2018-02-01','2018-02-01','0',4,2,0,'testing purchase requests',1,'2018-02-01 10:52:59',1,'2018-02-06 10:25:26');

/*Table structure for table `pr_return_deliveries` */

DROP TABLE IF EXISTS `pr_return_deliveries`;

CREATE TABLE `pr_return_deliveries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `del_id` int(11) NOT NULL DEFAULT '0',
  `sup_id` int(11) NOT NULL DEFAULT '0',
  `ref_no` varchar(50) NOT NULL,
  `trans_date` date NOT NULL,
  `sub_total` float NOT NULL DEFAULT '0',
  `refund` float NOT NULL DEFAULT '0',
  `grand_total` float NOT NULL DEFAULT '0',
  `desc` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `delete` char(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `pr_return_deliveries` */

insert  into `pr_return_deliveries`(`id`,`pro_id`,`del_id`,`sup_id`,`ref_no`,`trans_date`,`sub_total`,`refund`,`grand_total`,`desc`,`photo`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,2,1,1,'RED-1802/001','2018-02-01',100,10,90,NULL,NULL,'0',NULL,NULL,NULL,NULL),(2,2,1,1,'RED-1802/002','2018-02-09',81,5,76,'Testing return delivery items','picture_2018_02_09_12_39_33_20161222_064435.jpg','1',1,'2018-02-09 12:39:33',1,'2018-02-10 05:25:15');

/*Table structure for table `pr_return_delivery_items` */

DROP TABLE IF EXISTS `pr_return_delivery_items`;

CREATE TABLE `pr_return_delivery_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL DEFAULT '0',
  `warehouse_id` int(11) NOT NULL DEFAULT '0',
  `line_no` varchar(3) NOT NULL DEFAULT '001',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `unit` varchar(10) NOT NULL,
  `qty` float NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `refund` float NOT NULL,
  `total` float NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `pr_return_delivery_items` */

insert  into `pr_return_delivery_items`(`id`,`return_id`,`warehouse_id`,`line_no`,`item_id`,`unit`,`qty`,`price`,`amount`,`refund`,`total`,`note`) values (1,1,1,'001',1,'កេស',2,50,100,10,90,'testing'),(2,1,1,'002',4,'ប្រអប់',10,9,90,10,80,'testing'),(4,2,6,'001',1,'កេស',20,5,100,20,80,'testing'),(5,2,6,'002',5,'ប្រអប់',2,3,6,5,1,'testing');

/*Table structure for table `pr_return_usage_details` */

DROP TABLE IF EXISTS `pr_return_usage_details`;

CREATE TABLE `pr_return_usage_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL DEFAULT '0',
  `warehouse_id` int(11) NOT NULL DEFAULT '0',
  `street_id` int(11) NOT NULL DEFAULT '0',
  `house_id` int(11) NOT NULL DEFAULT '0',
  `line_no` varchar(3) NOT NULL DEFAULT '001',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `unit` varchar(10) NOT NULL,
  `qty` float NOT NULL,
  `usage_qty` float NOT NULL,
  `boq_set` float NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `delete` char(1) DEFAULT '0',
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `pr_return_usage_details` */

insert  into `pr_return_usage_details`(`id`,`return_id`,`warehouse_id`,`street_id`,`house_id`,`line_no`,`item_id`,`unit`,`qty`,`usage_qty`,`boq_set`,`note`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (3,1,6,24,1,'001',1,'កេស',1,0,0,'Testing','1',NULL,NULL,1,'2018-01-29 09:37:46'),(4,1,6,24,1,'001',4,'ប្រអប់',5,0,0,'testing','1',NULL,NULL,1,'2018-01-29 09:37:46'),(6,2,6,24,1,'001',1,'កេស',1,1,1,'testing','0',1,'2018-01-29 08:46:36',1,'2018-01-29 09:37:38'),(7,2,6,24,1,'002',5,'ប្រអប់',1,1,1,'testing','0',1,'2018-01-29 08:46:36',1,'2018-01-29 09:37:38');

/*Table structure for table `pr_return_usages` */

DROP TABLE IF EXISTS `pr_return_usages`;

CREATE TABLE `pr_return_usages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL DEFAULT '0',
  `ref_no` varchar(50) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `trans_date` date NOT NULL,
  `eng_return` int(11) NOT NULL DEFAULT '0',
  `sub_return` int(11) NOT NULL DEFAULT '0',
  `desc` varchar(255) DEFAULT NULL,
  `delete` char(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `pr_return_usages` */

insert  into `pr_return_usages`(`id`,`pro_id`,`ref_no`,`reference`,`trans_date`,`eng_return`,`sub_return`,`desc`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,2,'REU-1801/001','INV-001','2018-01-27',1,5,'Testing','1',1,'2018-01-27 11:26:18',1,'2018-01-29 09:37:46'),(2,2,'REU-1801/002','INV-001','2018-01-29',4,1,'Testing return items','0',1,'2018-01-29 08:46:36',1,'2018-01-29 09:37:38');

/*Table structure for table `pr_roles` */

DROP TABLE IF EXISTS `pr_roles`;

CREATE TABLE `pr_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `zone` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=PR,2=PO',
  `level` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=Top,2=Department',
  `dep_id` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `pr_roles` */

insert  into `pr_roles`(`id`,`name`,`amount`,`zone`,`level`,`dep_id`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'PR-CEO',10001,1,1,0,NULL,NULL,NULL,NULL),(2,'PR-PM',10000,1,1,0,NULL,NULL,NULL,NULL),(3,'PR-SM',2000,1,1,0,NULL,NULL,NULL,NULL),(4,'PR-DEP-ACC',0,1,1,1,NULL,NULL,NULL,NULL),(5,'PR-DEP-HR',0,1,1,2,NULL,NULL,NULL,NULL),(6,'PR-DEP-IT',0,1,1,3,NULL,NULL,NULL,NULL),(7,'PR-DEP-PUR',0,1,1,4,NULL,NULL,NULL,NULL),(8,'PR-ACC-L1',3000,1,2,4,NULL,NULL,NULL,NULL),(9,'PR-ACC-L2',1000,1,2,4,NULL,NULL,NULL,NULL),(10,'PR-ACC-L3',100,1,2,4,NULL,NULL,NULL,NULL),(11,'PR-HR-L1',2000,1,2,5,NULL,NULL,NULL,NULL),(12,'PR-HR-L2',1000,1,2,5,NULL,NULL,NULL,NULL),(13,'PR-IT-L1',1000,1,2,6,NULL,NULL,NULL,NULL),(14,'PR-PUR-L1',4000,1,2,7,NULL,NULL,NULL,NULL),(15,'PR-PUR-L2',2000,1,2,7,NULL,NULL,NULL,NULL),(16,'PR-PUR-L3',1000,1,2,7,NULL,NULL,NULL,NULL);

/*Table structure for table `pr_settings` */

DROP TABLE IF EXISTS `pr_settings`;

CREATE TABLE `pr_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_name` varchar(100) DEFAULT NULL,
  `report_header` varchar(100) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_phone` varchar(100) DEFAULT NULL,
  `company_email` varchar(100) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `app_icon` varchar(255) DEFAULT NULL,
  `app_logo` varchar(255) DEFAULT NULL,
  `allow_zone` char(1) DEFAULT '1' COMMENT '1=allow zone, 0=not allow',
  `allow_block` char(1) DEFAULT '1' COMMENT '1=allow block, 0=not allow',
  `theme_color` varchar(20) DEFAULT 'default',
  `theme_style` varchar(20) DEFAULT 'square',
  `theme_layout` varchar(20) DEFAULT 'fluid',
  `page_header` varchar(20) DEFAULT 'fixed',
  `top_menu_dropdown` varchar(20) DEFAULT 'light',
  `sidebar_mode` varchar(20) DEFAULT 'fixed',
  `sidebar_menu` varchar(20) DEFAULT 'accordion',
  `sidebar_style` varchar(20) DEFAULT 'default',
  `sidebar_position` varchar(20) DEFAULT 'left',
  `page_footer` varchar(20) DEFAULT 'default',
  `request_photo` char(1) DEFAULT '1' COMMENT '1=select photo,0=notselect photo',
  `order_photo` char(1) DEFAULT '1' COMMENT '1=select photo,0=notselect photo',
  `delivery_photo` char(1) DEFAULT '1' COMMENT '1=select photo,0=notselect photo',
  `return_delivery_photo` char(1) DEFAULT '1' COMMENT '1=select photo,0=notselect photo',
  `usage_photo` char(1) DEFAULT '1' COMMENT '1=select photo,0=notselect photo',
  `return_usage_photo` char(1) DEFAULT '1' COMMENT '1=select photo,0=notselect photo',
  `usage_constructor` char(1) DEFAULT '1' COMMENT '1=sub constructor & engineer, 0=contructor',
  `return_constructor` char(1) DEFAULT '1',
  `round_number` smallint(1) DEFAULT '2',
  `round_dollar` smallint(1) DEFAULT '2',
  `modal_header_color` varchar(30) DEFAULT '#2d699e',
  `modal_title_color` varchar(30) DEFAULT '#ffffff',
  `format_date` varchar(20) DEFAULT 'dd-mm-yyyy',
  `image_size` varchar(20) DEFAULT '0,0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `pr_settings` */

insert  into `pr_settings`(`id`,`app_name`,`report_header`,`company_name`,`company_phone`,`company_email`,`company_address`,`app_icon`,`app_logo`,`allow_zone`,`allow_block`,`theme_color`,`theme_style`,`theme_layout`,`page_header`,`top_menu_dropdown`,`sidebar_mode`,`sidebar_menu`,`sidebar_style`,`sidebar_position`,`page_footer`,`request_photo`,`order_photo`,`delivery_photo`,`return_delivery_photo`,`usage_photo`,`return_usage_photo`,`usage_constructor`,`return_constructor`,`round_number`,`round_dollar`,`modal_header_color`,`modal_title_color`,`format_date`,`image_size`) values (1,'ប្រព័ន្ធបញ្ជាទិញ','របាយការណ៍','ក្រុមហ៊ុន ដឹកជញ្ជូន អន្តរជាតិ','093 884 283','bon168.an@gmail.com','Udongk district, Kampong speu province, Cambodia',NULL,NULL,'1','1','blue','square','fluid','fixed','light','default','accordion','default','left','default','1','1','1','1','1','1','1','1',2,4,'#2d699e','#ffffff','dd-mm-yyyy','0,0');

/*Table structure for table `pr_stock_adjust_details` */

DROP TABLE IF EXISTS `pr_stock_adjust_details`;

CREATE TABLE `pr_stock_adjust_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adjust_id` int(11) unsigned NOT NULL DEFAULT '0',
  `warehouse_id` int(11) unsigned NOT NULL DEFAULT '0',
  `line_no` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '001',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `unit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_qty` float NOT NULL DEFAULT '0',
  `current_qty` float NOT NULL DEFAULT '0',
  `adjust_qty` float NOT NULL DEFAULT '0',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pr_stock_adjust_details` */

insert  into `pr_stock_adjust_details`(`id`,`adjust_id`,`warehouse_id`,`line_no`,`item_id`,`unit`,`stock_qty`,`current_qty`,`adjust_qty`,`note`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,1,6,'001',1,'កេស',15,5,-10,NULL,'0',1,'2018-01-25 07:57:50',1,'2018-01-27 09:33:45'),(2,1,6,'002',4,'ដុំ',2,2,0,NULL,'0',1,'2018-01-25 07:57:50',1,'2018-01-27 09:33:45'),(3,2,6,'001',1,'កេស',451,450,-1,'dd','1',1,'2018-02-12 10:39:07',1,'2018-02-12 10:39:13');

/*Table structure for table `pr_stock_adjusts` */

DROP TABLE IF EXISTS `pr_stock_adjusts`;

CREATE TABLE `pr_stock_adjusts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL DEFAULT '0',
  `ref_no` varchar(20) NOT NULL,
  `trans_date` date NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `delete` char(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `pr_stock_adjusts` */

insert  into `pr_stock_adjusts`(`id`,`pro_id`,`ref_no`,`trans_date`,`reference`,`desc`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,2,'ADJ-1801/001','2018-01-25','INV-001','Testing edit adjustment','0',1,'2018-01-25 07:57:50',1,'2018-01-27 09:33:45'),(2,2,'ADJ-1802/001','2018-02-12','INV-001',NULL,'1',1,'2018-02-12 10:39:07',1,'2018-02-12 10:39:13');

/*Table structure for table `pr_stock_entries` */

DROP TABLE IF EXISTS `pr_stock_entries`;

CREATE TABLE `pr_stock_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL DEFAULT '0',
  `ref_no` varchar(20) NOT NULL,
  `trans_date` date NOT NULL,
  `sup_id` int(11) NOT NULL DEFAULT '0',
  `desc` varchar(255) DEFAULT NULL,
  `delete` char(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `pr_stock_entries` */

insert  into `pr_stock_entries`(`id`,`pro_id`,`ref_no`,`trans_date`,`sup_id`,`desc`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,2,'ENT-1801/001','2018-01-25',1,'Testing stock entry','0',1,'2018-01-25 03:25:42',1,'2018-01-25 03:27:38'),(2,2,'ENT-1801/002','2018-01-25',2,'testing entry','0',1,'2018-01-25 03:26:23',NULL,NULL),(3,2,'ENT-1801/003','2018-01-25',2,NULL,'0',1,'2018-01-25 03:28:45',NULL,NULL),(4,2,'ENT-1802/001','2018-02-12',1,NULL,'1',1,'2018-02-12 10:04:57',1,'2018-02-12 10:05:04');

/*Table structure for table `pr_stock_imports` */

DROP TABLE IF EXISTS `pr_stock_imports`;

CREATE TABLE `pr_stock_imports` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `ref_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_date` date NOT NULL,
  `file_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pr_stock_imports` */

/*Table structure for table `pr_stock_move_details` */

DROP TABLE IF EXISTS `pr_stock_move_details`;

CREATE TABLE `pr_stock_move_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `move_id` int(11) NOT NULL DEFAULT '0',
  `from_warehouse_id` int(11) NOT NULL DEFAULT '0',
  `to_warehouse_id` int(11) NOT NULL DEFAULT '0',
  `line_no` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '001',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `unit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` float NOT NULL DEFAULT '0',
  `stock_qty` float DEFAULT '0',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pr_stock_move_details` */

insert  into `pr_stock_move_details`(`id`,`move_id`,`from_warehouse_id`,`to_warehouse_id`,`line_no`,`item_id`,`unit`,`qty`,`stock_qty`,`note`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,1,6,7,'001',1,'កេស',1,0,'testing','0',NULL,NULL,NULL,NULL),(2,1,6,5,'002',4,'កេស',1,0,'testing','0',NULL,NULL,NULL,NULL),(3,4,6,9,'001',1,'កេស',2,0,'testing','1',1,'2018-01-25 10:53:54',1,'2018-01-25 12:24:21'),(4,4,6,9,'002',4,'ប្រអប់',2,0,'testing','1',1,'2018-01-25 10:53:54',1,'2018-01-25 12:24:21'),(5,4,6,9,'003',5,'ប្រអប់',2,0,'testing','1',1,'2018-01-25 10:53:54',1,'2018-01-25 12:24:21'),(6,5,6,9,'001',1,'កេស',2,3,'testing2','0',1,'2018-01-25 12:23:30',1,'2018-01-27 09:15:12'),(7,5,6,9,'002',4,'ប្រអប់',2,3,'testing2','0',1,'2018-01-25 12:23:30',1,'2018-01-27 09:15:12'),(8,5,6,9,'003',5,'ប្រអប់',2,13,'testing2','0',1,'2018-01-25 12:23:30',1,'2018-01-27 09:15:12');

/*Table structure for table `pr_stock_moves` */

DROP TABLE IF EXISTS `pr_stock_moves`;

CREATE TABLE `pr_stock_moves` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL DEFAULT '0',
  `ref_no` varchar(20) NOT NULL,
  `trans_date` date NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `delete` char(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `pr_stock_moves` */

insert  into `pr_stock_moves`(`id`,`pro_id`,`ref_no`,`trans_date`,`reference`,`desc`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (3,2,'MOV-1801/001','2018-01-25','INV-001','testing','1',NULL,NULL,1,'2018-01-25 12:24:16'),(4,2,'MOV-1801/002','2018-01-25','INV-001','Testing move stocks','1',1,'2018-01-25 10:53:54',1,'2018-01-25 12:24:21'),(5,2,'MOV-1801/003','2018-01-25','INV-0012','Testing 2','0',1,'2018-01-27 09:15:12',NULL,NULL);

/*Table structure for table `pr_stocks` */

DROP TABLE IF EXISTS `pr_stocks`;

CREATE TABLE `pr_stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) unsigned NOT NULL DEFAULT '1',
  `ref_id` int(10) unsigned NOT NULL,
  `ref_no` varchar(20) NOT NULL,
  `ref_type` varchar(50) NOT NULL COMMENT 'stock entry, stock import, stock move, return usage, stock adjust, usage items, return usage, stock delivery, return delivery',
  `line_no` varchar(4) NOT NULL DEFAULT '001',
  `item_id` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `qty` float NOT NULL DEFAULT '0',
  `warehouse_id` int(11) NOT NULL,
  `trans_date` date NOT NULL,
  `trans_ref` char(1) NOT NULL DEFAULT 'I' COMMENT 'I=in,O=out',
  `alloc_ref` varchar(53) DEFAULT NULL COMMENT '0001001',
  `reference` varchar(255) DEFAULT NULL,
  `delete` char(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

/*Data for the table `pr_stocks` */

insert  into `pr_stocks`(`id`,`pro_id`,`ref_id`,`ref_no`,`ref_type`,`line_no`,`item_id`,`unit`,`qty`,`warehouse_id`,`trans_date`,`trans_ref`,`alloc_ref`,`reference`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,2,1,'ENT-1801/001','stock entry','001',1,'កេស',5,6,'2018-01-25','I','ENT-1801/001',NULL,'0',1,'2018-01-25 03:25:42',1,'2018-01-25 03:27:38'),(2,2,1,'ENT-1801/001','stock entry','002',4,'ប្រអប់',5,6,'2018-01-25','I','ENT-1801/001',NULL,'0',1,'2018-01-25 03:25:42',1,'2018-01-25 03:27:38'),(3,2,1,'ENT-1801/001','stock entry','003',5,'ប្រអប់',5,6,'2018-01-25','I','ENT-1801/001',NULL,'0',1,'2018-01-25 03:25:42',1,'2018-01-25 03:27:38'),(4,2,1,'ENT-1801/001','stock entry','004',6,'ប្រអប់',5,6,'2018-01-25','I','ENT-1801/001',NULL,'0',1,'2018-01-25 03:25:42',1,'2018-01-25 03:27:38'),(5,2,2,'ENT-1801/002','stock entry','001',15,'សន្លឹក',100,6,'2018-01-25','I','ENT-1801/002',NULL,'0',1,'2018-01-25 03:26:23',NULL,NULL),(6,2,2,'ENT-1801/002','stock entry','002',16,'កេស',100,6,'2018-01-25','I','ENT-1801/002',NULL,'0',1,'2018-01-25 03:26:23',NULL,NULL),(7,2,2,'ENT-1801/002','stock entry','003',17,'កំប៉ុង',100,6,'2018-01-25','I','ENT-1801/002',NULL,'0',1,'2018-01-25 03:26:23',NULL,NULL),(8,2,3,'ENT-1801/003','stock entry','001',1,'កេស',10,6,'2018-01-25','I','ENT-1801/003',NULL,'0',1,'2018-01-25 03:28:45',NULL,NULL),(9,2,3,'ENT-1801/003','stock entry','002',4,'ប្រអប់',10,6,'2018-01-25','I','ENT-1801/003',NULL,'0',1,'2018-01-25 03:28:45',NULL,NULL),(10,2,3,'ENT-1801/003','stock entry','003',5,'ប្រអប់',10,6,'2018-01-25','I','ENT-1801/003',NULL,'0',1,'2018-01-25 03:28:45',NULL,NULL),(11,2,3,'ENT-1801/003','stock entry','004',6,'ប្រអប់',10,6,'2018-01-25','I','ENT-1801/003',NULL,'0',1,'2018-01-25 03:28:45',NULL,NULL),(16,2,4,'MOV-1801/002','stock move','001',1,'កេស',2,9,'2018-01-25','I','MOV-1801/002','testing','1',1,'2018-01-25 10:53:54',1,'2018-01-25 12:24:21'),(17,2,4,'MOV-1801/002','stock move','001',1,'កំប៉ុង',-48,6,'2018-01-25','O','ENT-1801/0030003','testing','1',1,'2018-01-25 10:53:54',1,'2018-01-25 12:24:21'),(18,2,4,'MOV-1801/002','stock move','002',4,'ប្រអប់',2,9,'2018-01-25','I','MOV-1801/002','testing','1',1,'2018-01-25 10:53:54',1,'2018-01-25 12:24:21'),(19,2,4,'MOV-1801/002','stock move','002',4,'សន្លឹក',-800,6,'2018-01-25','O','ENT-1801/0030004','testing','1',1,'2018-01-25 10:53:54',1,'2018-01-25 12:24:21'),(20,2,4,'MOV-1801/002','stock move','003',5,'ប្រអប់',2,9,'2018-01-25','I','MOV-1801/002','testing','1',1,'2018-01-25 10:53:54',1,'2018-01-25 12:24:21'),(21,2,4,'MOV-1801/002','stock move','003',5,'សន្លឹក',-800,6,'2018-01-25','O','ENT-1801/0010003','testing','1',1,'2018-01-25 10:53:54',1,'2018-01-25 12:24:21'),(57,2,2,'REU-1801/002','return usage','001',1,'កេស',1,6,'2018-01-29','I','REU-1801/002','testing','0',1,'2018-01-29 08:46:36',1,'2018-01-29 09:37:38'),(56,2,1,'ADJ-1801/001','stock adjust','002',4,'ដុំ',0,6,'2018-01-25','I','ADJ-1801/001',NULL,'0',1,'2018-01-27 09:33:45',NULL,NULL),(55,2,1,'ADJ-1801/001','stock adjust','001',1,'កំប៉ុង',-120,6,'2018-01-25','O','ENT-1801/0030018',NULL,'0',1,'2018-01-27 09:33:45',NULL,NULL),(54,2,1,'ADJ-1801/001','stock adjust','001',1,'កំប៉ុង',-120,6,'2018-01-25','O','ENT-1801/0010013',NULL,'0',1,'2018-01-27 09:33:45',NULL,NULL),(26,2,5,'MOV-1801/003','stock move','001',1,'កេស',2,9,'2018-01-25','I','MOV-1801/003','testing2','0',1,'2018-01-25 12:02:49',1,'2018-01-27 09:15:12'),(49,2,5,'MOV-1801/003','stock move','002',4,'សន្លឹក',-800,6,'2018-01-25','O','ENT-1801/0030016','testing2','0',1,'2018-01-27 09:15:12',NULL,NULL),(28,2,5,'MOV-1801/003','stock move','002',4,'ប្រអប់',2,9,'2018-01-25','I','MOV-1801/003','testing2','0',1,'2018-01-25 12:02:49',1,'2018-01-27 09:15:12'),(30,2,5,'MOV-1801/003','stock move','003',5,'ប្រអប់',2,9,'2018-01-25','I','MOV-1801/003','testing2','0',1,'2018-01-25 12:02:49',1,'2018-01-27 09:15:12'),(58,2,2,'REU-1801/002','return usage','002',5,'ប្រអប់',1,6,'2018-01-29','I','REU-1801/002','testing','0',1,'2018-01-29 08:46:36',1,'2018-01-29 09:37:38'),(48,2,5,'MOV-1801/003','stock move','001',1,'កំប៉ុង',-48,6,'2018-01-25','O','ENT-1801/0030015','testing2','0',1,'2018-01-27 09:15:12',NULL,NULL),(50,2,5,'MOV-1801/003','stock move','003',5,'សន្លឹក',-800,6,'2018-01-25','O','ENT-1801/0010011','testing2','0',1,'2018-01-27 09:15:12',NULL,NULL),(35,2,3,'USE-1801/003','usage items','001',1,'កំប៉ុង',-48,6,'2018-01-27','O','ENT-1801/0030009','testing','0',1,'2018-01-27 07:11:46',NULL,NULL),(36,2,3,'USE-1801/003','usage items','002',4,'សន្លឹក',-800,6,'2018-01-27','O','ENT-1801/0030010','testing','0',1,'2018-01-27 07:11:46',NULL,NULL),(37,2,4,'USE-1801/004','usage items','001',15,'សន្លឹក',-2,6,'2018-01-27','O','ENT-1801/0020001','dd','1',1,'2018-01-27 07:59:29',1,'2018-01-29 08:51:49'),(38,2,4,'USE-1801/004','usage items','002',16,'កំប៉ុង',-24,6,'2018-01-27','O','ENT-1801/0020002','dd','1',1,'2018-01-27 07:59:29',1,'2018-01-29 08:51:49'),(39,2,5,'USE-1801/005','usage items','001',6,'សន្លឹក',-400,6,'2018-01-27','O','ENT-1801/0010007','121','1',1,'2018-01-27 08:15:18',1,'2018-01-27 09:45:29'),(40,2,5,'USE-1801/005','usage items','002',4,'សន្លឹក',-400,6,'2018-01-27','O','ENT-1801/0030011','111','1',1,'2018-01-27 08:15:18',1,'2018-01-27 09:45:29'),(53,2,1,'USE-1801/001','usage items','003',5,'សន្លឹក',-400,6,'2018-01-26','O','ENT-1801/0010012','Testing','0',1,'2018-01-27 09:15:39',NULL,NULL),(52,2,1,'USE-1801/001','usage items','002',4,'ប្រអប់',-1,6,'2018-01-26','O','USE-1801/0010001','Testing','0',1,'2018-01-27 09:15:39',NULL,NULL),(51,2,1,'USE-1801/001','usage items','001',1,'កំប៉ុង',-24,6,'2018-01-26','O','ENT-1801/0030017','Testing','0',1,'2018-01-27 09:15:39',NULL,NULL),(59,2,5,'DEL-1802/005','stock delivery','001',1,'កេស',50,6,'2018-02-08','I','DEL-1802/005','testing','0',1,'2018-02-08 09:42:32',1,'2018-02-08 09:45:52'),(60,2,5,'DEL-1802/005','stock delivery','002',4,'ប្រអប់',50,6,'2018-02-08','I','DEL-1802/005','testing','0',1,'2018-02-08 09:42:32',1,'2018-02-08 09:45:52'),(61,2,5,'DEL-1802/005','stock delivery','003',1,'កេស',50,6,'2018-02-08','I','DEL-1802/005','testing','0',1,'2018-02-08 09:42:32',1,'2018-02-08 09:45:52'),(62,2,6,'DEL-1802/006','stock delivery','001',4,'ដុំ',200,6,'2018-02-08','I','DEL-1802/006','null','1',1,'2018-02-08 12:40:29',1,'2018-02-08 12:42:10'),(63,2,6,'DEL-1802/006','stock delivery','002',1,'កន្លះ',50,6,'2018-02-08','I','DEL-1802/006','null','1',1,'2018-02-08 12:40:29',1,'2018-02-08 12:42:10'),(64,2,6,'DEL-1802/006','stock delivery','003',4,'ដុំ',200,6,'2018-02-08','I','DEL-1802/006','null','1',1,'2018-02-08 12:40:29',1,'2018-02-08 12:42:10'),(65,2,6,'DEL-1802/006','stock delivery','004',1,'កន្លះ',50,6,'2018-02-08','I','DEL-1802/006','null','1',1,'2018-02-08 12:40:29',1,'2018-02-08 12:42:10'),(66,2,7,'DEL-1802/007','stock delivery','001',4,'ប្រអប់',50,6,'2018-02-08','I','DEL-1802/007','dd','0',1,'2018-02-08 13:39:09',1,'2018-02-08 13:39:37'),(67,2,7,'DEL-1802/007','stock delivery','002',1,'កេស',50,6,'2018-02-08','I','DEL-1802/007','dd','0',1,'2018-02-08 13:39:09',1,'2018-02-08 13:39:37'),(68,2,7,'DEL-1802/007','stock delivery','003',4,'ប្រអប់',50,6,'2018-02-08','I','DEL-1802/007','dd','0',1,'2018-02-08 13:39:09',1,'2018-02-08 13:39:37'),(69,2,7,'DEL-1802/007','stock delivery','004',1,'កេស',50,6,'2018-02-08','I','DEL-1802/007','dd','0',1,'2018-02-08 13:39:09',1,'2018-02-08 13:39:37'),(70,2,8,'DEL-1802/008','stock delivery','001',4,'ប្រអប់',100,6,'2018-02-09','I','DEL-1802/008','ss','0',1,'2018-02-09 01:23:39',1,'2018-02-09 01:25:56'),(71,2,8,'DEL-1802/008','stock delivery','002',1,'កេស',100,6,'2018-02-09','I','DEL-1802/008','ss','0',1,'2018-02-09 01:23:39',1,'2018-02-09 01:25:56'),(72,2,8,'DEL-1802/008','stock delivery','003',4,'ប្រអប់',100,6,'2018-02-09','I','DEL-1802/008','ss','0',1,'2018-02-09 01:23:39',1,'2018-02-09 01:25:56'),(73,2,9,'DEL-1802/009','stock delivery','001',1,'កន្លះ',50,6,'2018-02-09','I','DEL-1802/009','aa','0',1,'2018-02-09 01:41:00',1,'2018-02-09 01:41:29'),(74,2,9,'DEL-1802/009','stock delivery','002',4,'ដុំ',200,6,'2018-02-09','I','DEL-1802/009','bb','0',1,'2018-02-09 01:41:00',1,'2018-02-09 01:41:29'),(75,2,9,'DEL-1802/009','stock delivery','003',1,'កន្លះ',50,6,'2018-02-09','I','DEL-1802/009','cc','0',1,'2018-02-09 01:41:00',1,'2018-02-09 01:41:29'),(76,2,10,'DEL-1802/010','stock delivery','001',1,'កេស',50,6,'2018-02-09','I','DEL-1802/010','ds','0',1,'2018-02-09 01:46:27',NULL,NULL),(77,2,10,'DEL-1802/010','stock delivery','002',4,'ប្រអប់',50,6,'2018-02-09','I','DEL-1802/010','ssd','0',1,'2018-02-09 01:46:27',NULL,NULL),(78,2,10,'DEL-1802/010','stock delivery','003',1,'កេស',50,6,'2018-02-09','I','DEL-1802/010','s','0',1,'2018-02-09 01:46:27',NULL,NULL),(79,2,11,'DEL-1802/011','stock delivery','001',1,'កេស',100,6,'2018-02-09','I','DEL-1802/011','ee','1',1,'2018-02-09 01:59:23',1,'2018-02-09 01:59:42'),(80,2,11,'DEL-1802/011','stock delivery','002',4,'ប្រអប់',100,6,'2018-02-09','I','DEL-1802/011','ee','1',1,'2018-02-09 01:59:23',1,'2018-02-09 01:59:42'),(81,2,11,'DEL-1802/011','stock delivery','003',1,'កេស',100,6,'2018-02-09','I','DEL-1802/011','ee','1',1,'2018-02-09 01:59:23',1,'2018-02-09 01:59:42'),(110,2,4,'ENT-1802/001','stock entry','002',4,'ប្រអប់',11,6,'2018-02-12','I','ENT-1802/001','ff','1',1,'2018-02-12 10:04:57',1,'2018-02-12 10:05:04'),(109,2,4,'ENT-1802/001','stock entry','001',1,'កេស',11,6,'2018-02-12','I','ENT-1802/001','ss','1',1,'2018-02-12 10:04:57',1,'2018-02-12 10:05:04'),(108,2,2,'RED-1802/002','return delivery','002',5,'សន្លឹក',-800,6,'2018-02-09','O','ENT-1801/0010014','testing','1',1,'2018-02-10 04:48:16',1,'2018-02-10 05:25:15'),(107,2,2,'RED-1802/002','return delivery','001',1,'កំប៉ុង',-456,6,'2018-02-09','O','DEL-1802/0050001','testing','1',1,'2018-02-10 04:48:16',1,'2018-02-10 05:25:15'),(106,2,2,'RED-1802/002','return delivery','001',1,'កំប៉ុង',-24,6,'2018-02-09','O','REU-1801/0020001','testing','1',1,'2018-02-10 04:48:16',1,'2018-02-10 05:25:15'),(111,2,2,'ADJ-1802/001','stock adjust','001',1,'កំប៉ុង',-24,6,'2018-02-12','O','REU-1801/0020001','dd','1',1,'2018-02-12 10:39:07',1,'2018-02-12 10:39:13');

/*Table structure for table `pr_supplier_items` */

DROP TABLE IF EXISTS `pr_supplier_items`;

CREATE TABLE `pr_supplier_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sup_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` float(20,4) NOT NULL,
  `status` char(1) DEFAULT '1' COMMENT '1=active,0=trash',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `pr_supplier_items` */

insert  into `pr_supplier_items`(`id`,`sup_id`,`item_id`,`unit`,`price`,`status`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (2,1,1,'កេស',16.0000,'1',1,'2017-12-13 01:41:23',NULL,NULL),(3,2,1,'កេស',15.0000,'1',1,'2017-12-13 01:41:23',NULL,NULL);

/*Table structure for table `pr_suppliers` */

DROP TABLE IF EXISTS `pr_suppliers`;

CREATE TABLE `pr_suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` varchar(150) DEFAULT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `status` char(1) DEFAULT '1' COMMENT '1=active,0=trash',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `pr_suppliers` */

insert  into `pr_suppliers`(`id`,`name`,`desc`,`tel`,`email`,`address`,`status`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'HS','Heng Seng','0976665555','heng-seng@gmail.com','Phnom Penh','1',2,'2017-12-09 01:40:44',NULL,NULL),(2,'KM','Kang Mong','0976665555','info@gmail.com','Phnom Penh','1',2,'2017-12-09 01:45:11',NULL,NULL),(4,'HS2','Heng Seng2','0976665555','heng-seng@gmail.com','Phnom Penh','1',2,'2017-12-09 01:59:22',NULL,NULL),(5,'KM2','Kang Mong2','0976665555','info@gmail.com','Phnom Penh','1',2,'2017-12-09 01:59:22',NULL,NULL);

/*Table structure for table `pr_system_datas` */

DROP TABLE IF EXISTS `pr_system_datas`;

CREATE TABLE `pr_system_datas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `desc` varchar(200) DEFAULT NULL,
  `type` char(2) NOT NULL COMMENT 'IT=item type,GU=group user,HT=House Type,ZN=zone,BK=block,ST=street,DP=department',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=trash',
  `parent_id` int(11) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*Data for the table `pr_system_datas` */

insert  into `pr_system_datas`(`id`,`name`,`desc`,`type`,`status`,`parent_id`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'ACC','Accounting','DP','1',2,NULL,NULL,NULL,NULL),(2,'HR','Human Resource','DP','1',2,NULL,NULL,NULL,NULL),(3,'IT','Information Technology','DP','1',2,NULL,NULL,NULL,NULL),(4,'PUR','Purchase','DP','1',2,NULL,NULL,NULL,NULL),(5,'ENG','Engineer','DP','1',2,NULL,NULL,NULL,NULL),(6,'ST','Stock Control','DP','1',2,NULL,NULL,NULL,NULL),(7,'Tille','Tille-ប្រភេទការរ៉ូ','IT','1',2,NULL,NULL,1,'2017-12-04 16:02:24'),(8,'Wood','Wood-ប្រភេទឈើ','IT','1',2,NULL,NULL,1,'2017-12-04 16:01:52'),(9,'Steel','Steel-ប្រភេទដែក','IT','1',2,NULL,NULL,1,'2017-12-04 16:02:06'),(10,'Queen','house type queen','HT','1',0,NULL,NULL,NULL,NULL),(11,'Link','house type link','HT','1',0,NULL,NULL,NULL,NULL),(12,'Tween','house type tween','HT','1',0,NULL,NULL,NULL,NULL),(13,'King','house type ling','HT','1',2,NULL,NULL,2,'2017-12-03 05:10:10'),(14,'NM','Normal house type','HT','1',2,2,'2017-12-02 01:20:25',2,'2017-12-02 02:29:40'),(15,'VL','Villa house type','HT','1',2,2,'2017-12-02 01:24:50',NULL,NULL),(18,'ZN-A','Zone A','ZN','1',2,2,'2017-12-04 15:12:28',NULL,NULL),(17,'SH','shop house','HT','1',2,2,'2017-12-02 16:09:09',2,'2017-12-02 16:10:54'),(19,'ZN-B','Zone B','ZN','1',2,2,'2017-12-04 15:18:55',NULL,NULL),(20,'ZN-C','Zone C','ZN','1',2,2,'2017-12-04 15:19:29',NULL,NULL),(21,'BK-L','Block L','BK','1',2,1,'2017-12-04 15:33:27',NULL,NULL),(22,'BK-M','Block M','BK','1',2,1,'2017-12-04 15:33:56',NULL,NULL),(23,'BK-S','Block S','BK','1',2,1,'2017-12-04 15:34:17',NULL,NULL),(24,'St-8M','Street width 8m','ST','1',2,1,'2017-12-04 15:44:31',NULL,NULL),(25,'St-7M','Street width 7m','ST','1',2,1,'2017-12-04 15:45:03',NULL,NULL),(26,'St-5M','Street width 5m','ST','1',2,1,'2017-12-04 15:45:35',NULL,NULL),(27,'St-MID','Street middle project','ST','1',2,1,'2017-12-04 15:46:10',NULL,NULL),(28,'St-K','Street King','ST','1',2,1,'2017-12-04 15:46:42',NULL,NULL),(29,'Electric','Electric-គ្រឿងភ្លើង','IT','1',2,1,'2017-12-04 16:04:03',NULL,NULL),(30,'Water Tool','Water Tools-គ្រឿងបំពាក់ទឹក','IT','1',2,1,'2017-12-04 16:05:14',NULL,NULL),(32,'ADMIN','Group Administrator','GU','1',2,2,'2017-12-05 14:49:49',NULL,NULL),(33,'STOCK','Group Stock Controller','GU','1',2,2,'2017-12-05 14:50:39',NULL,NULL),(34,'PURCH','Group Purchasing','GU','1',2,2,'2017-12-05 14:51:09',NULL,NULL),(35,'GIT','Group Information Technology','GU','1',2,2,'2017-12-05 14:51:48',NULL,NULL),(36,'Flat','Flat house type','HT','1',2,2,'2017-12-05 16:39:26',NULL,NULL),(37,'ZN-MO','Zone Modern','ZN','1',2,2,'2017-12-09 00:04:24',NULL,NULL),(38,'BK-BS','Block bast size','BK','1',2,2,'2017-12-09 00:05:10',NULL,NULL),(39,'St-MO','Street modern','ST','1',2,2,'2017-12-09 00:06:02',NULL,NULL),(40,'CC','CC info','IT','1',2,1,'2018-01-20 02:04:24',NULL,NULL),(41,'Phone','Phone info','IT','1',2,1,'2018-01-20 04:06:32',NULL,NULL),(42,'Computer','Computer info','IT','1',2,1,'2018-01-22 06:19:47',NULL,NULL);

/*Table structure for table `pr_units` */

DROP TABLE IF EXISTS `pr_units`;

CREATE TABLE `pr_units` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `from_code` varchar(10) NOT NULL,
  `from_desc` varchar(15) DEFAULT NULL,
  `to_code` varchar(10) NOT NULL,
  `to_desc` varchar(15) DEFAULT NULL,
  `factor` float NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` char(1) DEFAULT '1' COMMENT '1=active,0=trush',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `pr_units` */

insert  into `pr_units`(`id`,`from_code`,`from_desc`,`to_code`,`to_desc`,`factor`,`created_by`,`created_at`,`updated_by`,`updated_at`,`status`) values (1,'កំប៉ុង','កំប៉ុង','កំប៉ុង','កំប៉ុង',1,NULL,NULL,2,'2017-12-08 23:20:39','1'),(2,'យួ','យួ','កំប៉ុង','កំប៉ុង',6,NULL,NULL,2,'2017-12-08 23:16:51','1'),(3,'កន្លះ','កន្លះ','កំប៉ុង','កំប៉ុង',12,NULL,NULL,NULL,NULL,'1'),(4,'កេស','កេស','កំប៉ុង','កំប៉ុង',24,NULL,NULL,NULL,NULL,'1'),(5,'សន្លឹក','សន្លឹក','សន្លឹក','សន្លឹក',1,NULL,NULL,NULL,NULL,'1'),(6,'ដុំ','ដុំ','សន្លឹក','សន្លឹក',50,NULL,NULL,NULL,NULL,'1'),(7,'ប្រអប់','ប្រអប់','សន្លឹក','សន្លឹក',400,NULL,NULL,NULL,NULL,'1'),(8,'គ្រាប់','គ្រាប់','គ្រាប់','គ្រាប់',1,NULL,NULL,NULL,NULL,'1'),(9,'ឈុត','ឈុត','ឈុត','ឈុត',1,NULL,NULL,NULL,NULL,'1'),(10,'ដើម','ដើម','ដើម','ដើម',1,NULL,NULL,NULL,NULL,'1'),(24,'Unit','Unit','Unit','Unit',1,2,'2017-12-08 02:43:23',2,'2017-12-08 23:23:29','1'),(28,'Mid','Middle Case','Unit','Unit',12,2,'2017-12-08 23:38:36',NULL,NULL,'1'),(30,'BA','BA excel','AB','AB excel',1,1,'2018-01-20 02:07:43',NULL,NULL,'1'),(31,'គ្រឿង','គ្រឿង excel','គ្រឿង','គ្រឿង excel',1,1,'2018-01-20 04:06:32',NULL,NULL,'1');

/*Table structure for table `pr_usage_details` */

DROP TABLE IF EXISTS `pr_usage_details`;

CREATE TABLE `pr_usage_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `use_id` int(11) NOT NULL DEFAULT '0',
  `warehouse_id` int(11) NOT NULL DEFAULT '0',
  `street_id` int(11) NOT NULL DEFAULT '0',
  `house_id` int(11) NOT NULL DEFAULT '0',
  `line_no` varchar(3) NOT NULL DEFAULT '001',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `unit` varchar(10) NOT NULL,
  `qty` float NOT NULL,
  `stock_qty` float NOT NULL,
  `boq_set` float NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `delete` char(1) DEFAULT '0',
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `pr_usage_details` */

insert  into `pr_usage_details`(`id`,`use_id`,`warehouse_id`,`street_id`,`house_id`,`line_no`,`item_id`,`unit`,`qty`,`stock_qty`,`boq_set`,`note`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,1,6,24,1,'001',1,'កេស',1,11,153.208,'Testing','0',1,'2018-01-26 14:58:02',1,'2018-01-27 09:15:39'),(2,1,6,24,1,'002',4,'ប្រអប់',1,10,117,'Testing','0',1,'2018-01-26 14:59:13',1,'2018-01-27 09:15:39'),(3,1,6,24,1,'003',5,'ប្រអប់',1,23,131,'Testing','0',1,'2018-01-27 10:57:18',1,'2018-01-27 09:15:39'),(4,3,6,24,1,'001',1,'កេស',2,3,145.208,'testing','0',1,'2018-01-27 07:11:46',NULL,NULL),(5,3,6,24,1,'002',4,'ប្រអប់',2,3,110,'testing','0',1,'2018-01-27 07:11:46',NULL,NULL),(6,4,6,24,1,'001',15,'សន្លឹក',2,100,125,'dd','1',1,'2018-01-27 07:59:29',1,'2018-01-29 08:51:49'),(7,4,6,24,1,'002',16,'កេស',1,100,1.04167,'dd','1',1,'2018-01-27 07:59:29',1,'2018-01-29 08:51:49'),(8,5,6,24,1,'001',6,'ប្រអប់',1,15,122,'121','1',1,'2018-01-27 08:15:18',1,'2018-01-27 09:45:29'),(9,5,6,24,1,'002',4,'ប្រអប់',1,1,108,'111','1',1,'2018-01-27 08:15:18',1,'2018-01-27 09:45:29');

/*Table structure for table `pr_usages` */

DROP TABLE IF EXISTS `pr_usages`;

CREATE TABLE `pr_usages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL DEFAULT '0',
  `ref_no` varchar(50) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `trans_date` date NOT NULL,
  `eng_usage` int(11) NOT NULL DEFAULT '0',
  `sub_usage` int(11) NOT NULL DEFAULT '0',
  `desc` varchar(255) DEFAULT NULL,
  `delete` char(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `pr_usages` */

insert  into `pr_usages`(`id`,`pro_id`,`ref_no`,`reference`,`trans_date`,`eng_usage`,`sub_usage`,`desc`,`delete`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,2,'USE-1801/001','INV-001','2018-01-26',4,1,'Testing usage items','0',NULL,NULL,1,'2018-01-27 09:15:39'),(2,2,'USE-1801/002','INV-001','2018-01-27',4,0,NULL,'1',1,'2018-01-27 06:50:02',1,'2018-01-27 09:44:07'),(3,2,'USE-1801/003','INV-001','2018-01-27',4,0,'testing','0',1,'2018-01-27 07:11:46',NULL,NULL),(4,2,'USE-1801/004','INV-0012','2018-01-27',4,0,'tesss','1',1,'2018-01-27 07:59:29',1,'2018-01-29 08:51:49'),(5,2,'USE-1801/005','12','2018-01-27',4,1,'tess','1',1,'2018-01-27 08:15:18',1,'2018-01-27 09:45:29');

/*Table structure for table `pr_user_assign_roles` */

DROP TABLE IF EXISTS `pr_user_assign_roles`;

CREATE TABLE `pr_user_assign_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `pr_user_assign_roles` */

insert  into `pr_user_assign_roles`(`id`,`user_id`,`role_id`,`created_by`,`created_at`) values (1,4,8,NULL,NULL),(2,5,9,NULL,NULL),(3,6,10,NULL,NULL),(4,7,11,NULL,NULL),(5,8,12,NULL,NULL),(6,9,13,NULL,NULL),(7,10,14,NULL,NULL),(8,11,15,NULL,NULL),(9,12,16,NULL,NULL);

/*Table structure for table `pr_users` */

DROP TABLE IF EXISTS `pr_users`;

CREATE TABLE `pr_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dep_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `delete` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `create_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pr_users` */

insert  into `pr_users`(`id`,`dep_id`,`name`,`email`,`tel`,`remember_token`,`password`,`photo`,`signature`,`status`,`delete`,`create_by`,`created_at`,`update_by`,`updated_at`) values (1,1,'owner','owner@gmail.com','093884283','5oieAlNPzap07N79psxAI1y09e6o9WYnDrQILweMU7GpcOubaMNJO9MvNTUV','$2y$10$md790GnqSa5nHrNLKuVn7uTyw0PI5GDF8E9fXorDk4uCWt1QvrnCa','picture_2018_02_14_09_05_27_FB_IMG_1482290271790.jpg','5655a843472871b3.png','1','0',NULL,NULL,NULL,'2018-02-14 09:32:02'),(11,4,'pr-l2','pr-l2@gmail.com','093884283','5BwEuo0vUAXZuSTguzoF57jFtS13uw1XOBuQTmTlp8kjBf0cJzzhlen3MWSV','$2y$10$kszRNcHEeBqrfMfk6Cr1G.Lsk1V7mT3hXUNNIJwpOL0s1l2OgVxXu','',NULL,'1','0',NULL,NULL,NULL,NULL),(2,0,'admin','admin@gmail.com','093884283','SeHXvIY1lpEpPKpLvCLG8sw70IKOCDbvZukNUeIwDQ0IUNqdkudvHuUyIUVe','$2y$10$5UY2RMRGMAw6bO9SdkfEZuTS68hDsEF/plqvDzzLKJvcTBdfBNXEC','',NULL,'1','0',NULL,NULL,NULL,NULL),(3,1,'bonneang','bon168.an@gmail.com','093884283','AtWMHBsASrWOEyJoCc6ONiKNY0TakFg2JTLWkcV3olXdLGG8Xi7UcfA6GdHX','$2y$10$OkSS3RCitmoO7/73cFxhHOjo1W8zfMx9h5oLFkCxJBPO00ho5ZeZK','',NULL,'1','0',NULL,NULL,NULL,'2018-02-13 13:31:51'),(4,1,'acc-l1','acc-l1@gmail.com','093884283','SeHXvIY1lpEpPKpLvCLG8sw70IKOCDbvZukNUeIwDQ0IUNqdkudvHuUyIUVe','$2y$10$RFyw9fd80a9yKjNfrary6.7Wy/cstjLQ0V1lmWKHhH5jKM2AijUpG','',NULL,'1','0',NULL,NULL,NULL,NULL),(5,1,'acc-l2','acc-l2@gmail.com','093884283','SeHXvIY1lpEpPKpLvCLG8sw70IKOCDbvZukNUeIwDQ0IUNqdkudvHuUyIUVe','$2y$10$ELq9BrocqipHi/NvXTb5YObS3ul8BdPGeL5PBYiaxBWTgjVZFcVTq','',NULL,'1','0',NULL,NULL,NULL,NULL),(6,1,'acc-l3','acc-l3@gmail.com','093884283','SeHXvIY1lpEpPKpLvCLG8sw70IKOCDbvZukNUeIwDQ0IUNqdkudvHuUyIUVe','$2y$10$VMs8y3DKqBGXcXVeTTcjUOpsAdKFOx52RJ.ae3SL/AZUc94VL7aT2','',NULL,'1','0',NULL,NULL,NULL,NULL),(7,2,'hr-l1','hr-l1@gmail.com','093884283','SeHXvIY1lpEpPKpLvCLG8sw70IKOCDbvZukNUeIwDQ0IUNqdkudvHuUyIUVe','$2y$10$9Z0f6sheUNszvg3e34KfIOssk2e2DKA7Ve3ezXcJp5YMXznTBtnuG','',NULL,'1','0',NULL,NULL,NULL,NULL),(8,2,'hr-l2','hr-l2@gmail.com','093884283','SeHXvIY1lpEpPKpLvCLG8sw70IKOCDbvZukNUeIwDQ0IUNqdkudvHuUyIUVe','$2y$10$huyzN8M3b9kRDwokWBfS6uNOJnKUI98gGvdsPaDP68vVnae/UESje','',NULL,'1','0',NULL,NULL,NULL,NULL),(9,3,'it-l1','it-l1@gmail.com','093884283','SeHXvIY1lpEpPKpLvCLG8sw70IKOCDbvZukNUeIwDQ0IUNqdkudvHuUyIUVe','$2y$10$Cu6m6gy.v03KtrH3.BAI1erQ.d.1b973msuAofhv0G63irOq.oVZ.','',NULL,'1','0',NULL,NULL,NULL,NULL),(10,4,'pr-l1','pr-l1@gmail.com','093884283','SeHXvIY1lpEpPKpLvCLG8sw70IKOCDbvZukNUeIwDQ0IUNqdkudvHuUyIUVe','$2y$10$WIBq4W8NLtSpHoL7mrLzseZF8i7Ydqu3ER1xkWW86isMl7F8KME6e','',NULL,'1','0',NULL,NULL,NULL,NULL),(12,4,'pr-l3','pr-l3@gmailcom','093884283','SeHXvIY1lpEpPKpLvCLG8sw70IKOCDbvZukNUeIwDQ0IUNqdkudvHuUyIUVe','$2y$10$WIBq4W8NLtSpHoL7mrLzseZF8i7Ydqu3ER1xkWW86isMl7F8KME6e','',NULL,'1','0',NULL,NULL,NULL,NULL),(13,1,'An Bonneang','vannak-fucker@7mpro.com','093884283',NULL,'$2y$10$YTsr9Y5bg1rNffF4xqQh2egTwrQkFy.rBlSQXHuHz0FFFlqMhwq0e','picture_2018_02_13_13_02_20_FB_IMG_1482290239130.jpg',NULL,'1','0',NULL,'2018-02-13 13:02:20',NULL,NULL);

/*Table structure for table `pr_warehouses` */

DROP TABLE IF EXISTS `pr_warehouses`;

CREATE TABLE `pr_warehouses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `user_control` int(11) NOT NULL DEFAULT '0',
  `tel` varchar(20) DEFAULT NULL,
  `status` char(1) DEFAULT '1' COMMENT '1=active,0=trash',
  `pro_id` int(11) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `pr_warehouses` */

insert  into `pr_warehouses`(`id`,`name`,`address`,`user_control`,`tel`,`status`,`pro_id`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'Main Warehouse','#23, str.255, Sangkat Tekthla, khan Sensok, Phnom penh',1,'0978886655','1',1,NULL,NULL,NULL,NULL),(2,'Center Warehouse','Sangkat Bayab, khan Tolkork, Phnom Penh',3,'0976665555','1',1,1,'2017-12-05 18:13:08',NULL,NULL),(3,'Branh','Phnom Penh',2,'097444666','1',1,1,'2017-12-05 18:17:18',1,'2017-12-05 18:17:51'),(5,'Middle Warehouse','Kampong Cham',2,'0976665555','1',1,2,'2017-12-05 23:19:50',NULL,NULL),(6,'Main Warehouse','Phnom Penh',2,'0976665555','1',2,2,'2017-12-05 23:23:05',NULL,NULL),(7,'Branh2','Phnom Penh',2,'097444666','1',1,2,'2017-12-06 00:00:51',NULL,NULL),(8,'Middle Warehouse2','Kampong Cham',2,'0976665555','1',1,2,'2017-12-06 00:00:51',NULL,NULL),(9,'Center Warehouse','khan Tolkork, Phnom Penh',3,'0976665555','1',2,2,'2017-12-07 15:22:24',1,'2017-12-14 16:25:16'),(10,'Branh','Phnom Penh',2,'097444666','1',2,2,'2017-12-07 15:22:24',NULL,NULL),(11,'Middle Warehouse','Kampong Cham',2,'0976665555','1',2,2,'2017-12-07 15:22:24',NULL,NULL),(12,'Branh2','Phnom Penh',2,'097444666','1',2,2,'2017-12-07 15:22:24',NULL,NULL),(13,'Middle Warehouse2','Kampong Cham',2,'0976665555','1',2,2,'2017-12-07 15:22:24',NULL,NULL),(14,'W001','Phnom Penh',1,'0976665555','1',2,2,'2017-12-09 00:28:19',2,'2017-12-09 00:28:36'),(15,'HS','Phnom Penh',1,'0976665555','1',2,2,'2017-12-09 01:29:23',1,'2017-12-14 16:25:34'),(16,'Main','upload excel file',1,'N/A','1',2,1,'2018-01-20 04:06:32',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
