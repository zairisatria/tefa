/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.21-MariaDB : Database - database_tefa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`database_tefa` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `database_tefa`;

/*Table structure for table `alat` */

DROP TABLE IF EXISTS `alat`;

CREATE TABLE `alat` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_kelompok` varchar(225) NOT NULL,
  `alat` varchar(225) NOT NULL,
  `jumlah` int(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `alat` */

insert  into `alat`(`id`,`id_kelompok`,`alat`,`jumlah`,`created_at`,`updated_at`) values 
(19,'20220706114937','Pisau',1,'2022-09-23 09:47:48','2022-09-23 09:47:48'),
(20,'20220706114937','Talenan',1,'2022-09-23 09:48:21','2022-09-23 09:48:21'),
(21,'20220706114937','Meat Grinder',1,'2022-09-23 09:53:02','2022-09-23 09:53:02'),
(22,'20220706114937','Food processor',1,'2022-09-23 09:53:16','2022-09-23 09:53:16'),
(23,'20220706114937','Baskom',1,'2022-09-23 09:53:29','2022-09-23 09:53:29'),
(24,'20220706114937','Panci',1,'2022-09-23 09:53:41','2022-09-23 09:53:41'),
(25,'20220706114937','Sendok',1,'2022-09-23 09:53:51','2022-09-23 09:53:51');

/*Table structure for table `bahan` */

DROP TABLE IF EXISTS `bahan`;

CREATE TABLE `bahan` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_kelompok` varchar(225) NOT NULL,
  `bahan` varchar(225) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `jumlah` decimal(10,1) NOT NULL,
  `satuan` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `bahan` */

insert  into `bahan`(`id`,`id_kelompok`,`bahan`,`harga`,`jumlah`,`satuan`,`created_at`,`updated_at`) values 
(13,'20220706114937','Daging ikan tenggiri',50000.00,2.0,'1','2022-09-23 10:12:33','2022-09-23 10:12:33'),
(14,'20220706114937','Tepung terigu',10000.00,0.5,'1','2022-09-23 10:15:12','2022-09-23 10:34:50'),
(15,'20220706114937','Tepung tapioka',15000.00,1.0,'1','2022-09-23 10:36:59','2022-09-23 10:36:59'),
(16,'20220706114937','Bawang putih',25000.00,1.5,'1','2022-09-23 10:37:54','2022-09-23 10:37:54');

/*Table structure for table `d_logbook` */

DROP TABLE IF EXISTS `d_logbook`;

CREATE TABLE `d_logbook` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(225) NOT NULL,
  `id_kelompok` varchar(225) NOT NULL,
  `files` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4;

/*Data for the table `d_logbook` */

insert  into `d_logbook`(`id`,`uuid`,`id_kelompok`,`files`,`created_at`,`updated_at`) values 
(80,'20220923110919','20220706114937','392212174WhatsApp Image 2022-07-02 at 19.35.34 (1).jpeg','2022-09-23 11:10:23','2022-09-23 11:10:23'),
(81,'20220923110919','20220706114937','710021052WhatsApp Image 2022-07-02 at 19.35.34.jpeg','2022-09-23 11:10:23','2022-09-23 11:10:23'),
(82,'20220923111038','20220706114937','256531411WhatsApp Image 2022-07-02 at 19.35.35 (1).jpeg','2022-09-23 11:11:25','2022-09-23 11:11:25'),
(83,'20220923111038','20220706114937','1685304828WhatsApp Image 2022-07-02 at 19.35.35.jpeg','2022-09-23 11:11:25','2022-09-23 11:11:25'),
(84,'20220923111130','20220706114937','1476000776WhatsApp Image 2022-07-02 at 19.35.36 (1).jpeg','2022-09-23 11:12:08','2022-09-23 11:12:08'),
(85,'20220923111130','20220706114937','863441789WhatsApp Image 2022-07-02 at 19.35.36.jpeg','2022-09-23 11:12:08','2022-09-23 11:12:08'),
(86,'20220923111218','20220706114937','1918159418WhatsApp Image 2022-07-02 at 19.35.37 (1).jpeg','2022-09-23 11:13:00','2022-09-23 11:13:00'),
(87,'20220923111218','20220706114937','1363846718WhatsApp Image 2022-07-02 at 19.35.37.jpeg','2022-09-23 11:13:00','2022-09-23 11:13:00');

/*Table structure for table `distribusi` */

DROP TABLE IF EXISTS `distribusi`;

CREATE TABLE `distribusi` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_proposal` int(25) DEFAULT NULL,
  `id_toko` int(25) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `jumlah` int(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `distribusi` */

/*Table structure for table `langkah` */

DROP TABLE IF EXISTS `langkah`;

CREATE TABLE `langkah` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_kelompok` varchar(225) NOT NULL,
  `langkah` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `langkah` */

insert  into `langkah`(`id`,`id_kelompok`,`langkah`,`created_at`,`updated_at`) values 
(11,'20220706114937','Haluskan daging ikan dengan menggunakan meat grinder','2022-09-23 10:38:22','2022-09-23 10:38:22'),
(12,'20220706114937','Tambahkan telur, bawang putih, bawang merah, lada garam campur hingga merata dengan menggunakan food processor','2022-09-23 10:38:37','2022-09-23 10:38:37'),
(13,'20220706114937','Masukkan tepung tapioka, tepung terigu air es, aduk kembali hingga rata','2022-09-23 10:38:50','2022-09-23 10:38:50'),
(14,'20220706114937','Bulat-bulatkan adonan dengan menggunakan sendok lalu masukkan kedalam wadah yang berisi air es dan es batu','2022-09-23 10:39:01','2022-09-23 10:39:01'),
(15,'20220706114937','Rendam beberapa menit supaya hasilnya lembut dan kenyal','2022-09-23 10:39:14','2022-09-23 10:39:14'),
(16,'20220706114937','Rebus  bakso ikan dalam panci hingga mengapung','2022-09-23 10:39:27','2022-09-23 10:39:27'),
(17,'20220706114937','Angkat dan kemas bakso dengan plastik kemasan','2022-09-23 10:39:39','2022-09-23 10:39:39');

/*Table structure for table `logbook` */

DROP TABLE IF EXISTS `logbook`;

CREATE TABLE `logbook` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(225) NOT NULL,
  `id_kelompok` varchar(225) NOT NULL,
  `id_users` int(25) NOT NULL,
  `date` date NOT NULL,
  `dari` time NOT NULL,
  `sampai` time NOT NULL,
  `aktivitas` varchar(225) NOT NULL,
  `keluaran` varchar(225) NOT NULL,
  `jenis_aktifitas` enum('produksi','pengemasan','penjualan','persiapan','pengolahan') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `logbook` */

insert  into `logbook`(`id`,`uuid`,`id_kelompok`,`id_users`,`date`,`dari`,`sampai`,`aktivitas`,`keluaran`,`jenis_aktifitas`,`created_at`,`updated_at`) values 
(19,'20220923110919','20220706114937',2,'2022-09-20','11:09:00','11:10:00','Mempersiapkan perlatan','Alat Siap','persiapan','2022-09-23 11:10:23','2022-09-23 11:10:23'),
(20,'20220923111038','20220706114937',2,'2022-09-21','11:10:00','11:16:00','Mengolah Adonan','Adonan','pengolahan','2022-09-23 11:11:25','2022-09-23 11:11:25'),
(21,'20220923111130','20220706114937',2,'2022-09-22','11:12:00','11:16:00','Merebus Adonan','Bakso','produksi','2022-09-23 11:12:08','2022-09-23 11:12:08'),
(22,'20220923111218','20220706114937',2,'2022-09-23','11:14:00','11:18:00','Merebus Adonan Kedua','Bakso Kedua','produksi','2022-09-23 11:13:00','2022-09-23 11:13:00');

/*Table structure for table `m_satuan` */

DROP TABLE IF EXISTS `m_satuan`;

CREATE TABLE `m_satuan` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `satuan` varchar(225) NOT NULL,
  `konversi_satuan` varchar(225) NOT NULL,
  `nilai_konversi` int(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `m_satuan` */

insert  into `m_satuan`(`id`,`satuan`,`konversi_satuan`,`nilai_konversi`,`created_at`,`updated_at`) values 
(1,'Kg','Gram',10,'2022-09-03 21:18:29','2022-09-03 21:18:29');

/*Table structure for table `map_pembimbing` */

DROP TABLE IF EXISTS `map_pembimbing`;

CREATE TABLE `map_pembimbing` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_pembimbing` int(25) NOT NULL,
  `id_kelompok` varchar(225) NOT NULL,
  `id_proposal` int(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pembimbing` (`id_pembimbing`),
  KEY `id_proposal` (`id_proposal`),
  CONSTRAINT `map_pembimbing_ibfk_2` FOREIGN KEY (`id_proposal`) REFERENCES `proposal` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

/*Data for the table `map_pembimbing` */

insert  into `map_pembimbing`(`id`,`id_pembimbing`,`id_kelompok`,`id_proposal`,`created_at`,`updated_at`) values 
(28,7,'20220706114937',26,'2022-10-22 11:44:34','2022-10-22 11:44:34');

/*Table structure for table `penilaian` */

DROP TABLE IF EXISTS `penilaian`;

CREATE TABLE `penilaian` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_kelompok` varchar(225) NOT NULL,
  `inovasi` enum('0','1') NOT NULL,
  `bentuk` enum('0','1') NOT NULL,
  `rasa` enum('0','1') NOT NULL,
  `kemasan` enum('0','1') NOT NULL,
  `kelayakan` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penilaian` */

insert  into `penilaian`(`id`,`id_kelompok`,`inovasi`,`bentuk`,`rasa`,`kemasan`,`kelayakan`,`created_at`,`updated_at`) values 
(7,'20220706114937','1','1','1','1','1','2022-10-22 12:19:16','2022-10-22 12:19:16');

/*Table structure for table `prodi` */

DROP TABLE IF EXISTS `prodi`;

CREATE TABLE `prodi` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `prodi` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `prodi` */

insert  into `prodi`(`id`,`prodi`,`created_at`,`updated_at`) values 
(1,'Program Studi 1','2022-07-20 21:17:37','2022-07-20 21:27:07'),
(3,'Program Studi 2','2022-07-20 21:20:45','2022-07-20 22:14:20'),
(4,'Program Studi 3','2022-07-20 21:59:36','2022-07-20 22:14:12');

/*Table structure for table `proposal` */

DROP TABLE IF EXISTS `proposal`;

CREATE TABLE `proposal` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_users` int(25) NOT NULL,
  `id_kelompok` varchar(225) NOT NULL,
  `files` varchar(225) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `status_proposal` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0 untuk pengajuan baru, 1 untuk diterima, 2 untuk ditolak',
  `status_perbaikan` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 untuk tidak ada perbaikan, 1 untuk sudah diperbaiki',
  `catatan_perbaikan` varchar(255) NOT NULL,
  `id_users_verifikasi` int(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

/*Data for the table `proposal` */

insert  into `proposal`(`id`,`id_users`,`id_kelompok`,`files`,`judul`,`status_proposal`,`status_perbaikan`,`catatan_perbaikan`,`id_users_verifikasi`,`created_at`,`updated_at`) values 
(26,2,'20220706114937','1663734923_15009fcd26c25e955d22.pdf','BAKSO IKAN TENGGIRI','1','0','',3,'2022-09-21 11:35:23','2022-10-22 11:44:34');

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `batas_proposal` int(25) NOT NULL COMMENT 'batas waktu dalam satuan jam',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `setting` */

insert  into `setting`(`id`,`batas_proposal`,`created_at`,`updated_at`) values 
(1,72,'2022-07-15 00:04:18','2022-07-15 00:04:18');

/*Table structure for table `toko` */

DROP TABLE IF EXISTS `toko`;

CREATE TABLE `toko` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `toko` */

insert  into `toko`(`id`,`nama`,`created_at`,`updated_at`) values 
(1,'Retail Modern','2022-08-15 21:10:25','2022-08-15 21:10:25'),
(2,'Pasar Tradisional','2022-08-15 21:10:25','2022-08-15 21:10:25');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_users` int(25) NOT NULL AUTO_INCREMENT,
  `id_kelompok` varchar(225) NOT NULL,
  `id_prodi` int(25) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `roles` enum('admin','peserta','pemasaran','kaprodi','kepala','quality','pembimbing') NOT NULL,
  `token_kelompok` varchar(225) NOT NULL,
  `status_kelompok` enum('1','2','0') NOT NULL COMMENT '0 untuk bukan peserta, 1 untuk ketua, 2 untuk anggota kelompok',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_users`),
  KEY `id_users` (`id_users`),
  KEY `id_prodi` (`id_prodi`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id_users`,`id_kelompok`,`id_prodi`,`nama`,`username`,`password`,`email`,`telepon`,`photo`,`roles`,`token_kelompok`,`status_kelompok`,`created_at`,`updated_at`) values 
(2,'20220706114937',3,'Zairi','user1','24c9e15e52afc47c225b757e7bee1f9d','zairi@gmail.com','081318739245','default.png','peserta','92da604d76d7eac1','1','2022-07-05 19:44:45','2022-07-30 18:24:05'),
(3,'',0,'nama admin 1','admin','21232f297a57a5a743894a0e4a801fc3','admin@gmail.com','081318739244','default.png','admin','','0','2022-07-05 19:44:45','2022-07-30 19:09:25'),
(4,'',0,'nama kaprodi 1','kaprodi','3c13922905d2bc454cc35e665335e2fd','kaprodi@gmail.com','','default.png','kaprodi','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(5,'',0,'nama kepala','kepala','870f669e4bbbfa8a6fde65549826d1c4','kepala@gmail.com','','default.png','kepala','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(6,'',0,'nama pemasaran','pemasaran','229eaac0894a3379d759a720e0e3410c','pemasaran@gmail.com','','default.png','pemasaran','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(7,'',1,'nama pembimbing 1','pembimbing','9d98460ff5d64814e7d341a965f38db1','pembimbing@gmail.com','','default.png','pembimbing','','0','2022-07-05 19:44:45','2022-09-05 15:41:13'),
(8,'',0,'nama quality','quality','d66636b253cb346dbb6240e30def3618','quality@gmail.com','','default.png','quality','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(9,'20220706114938',4,'nama user2','user2','7e58d63b60197ceb55a1c487989a3720','user2@gmail.com','','default.png','peserta','83fd1dce1cc5ad31','1','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(10,'20220706114937',3,'nama user3','user3','92877af70a45fd6a2ed7fe81e1236b78','user3@gmail.com','','default.png','peserta','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(11,'20220706114937',3,'nama user4','user4','3f02ebe3d7929b091e3d8ccfde2f3bc6','user4@gmail.com','','default.png','peserta','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(12,'20220706114938',3,'nama user5','user5','0a791842f52a0acfbb3a783378c066b8','user5@gmail.com','','default.png','peserta','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(13,'20220706114938',4,'nama user6','user6','affec3b64cf90492377a8114c86fc093','user6@gmail.com','','default.png','peserta','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(17,'20220718201935',4,'Isnendar','iispurnama','78f6492e8160853edaf17cf31941f237','isnendarpontianak@gmail.com','','default.png','peserta','5ed3e46f2f521279','1','2022-07-18 20:19:35','2022-07-18 20:19:35'),
(18,'20220718201935',4,'Purnama','bulanpurnama','19dd865ed8e07ed6021fbe7d5746720f','purnama@gmail.com','','default.png','peserta','','0','2022-07-18 20:24:23','2022-07-18 20:24:23'),
(19,'',4,'nama kaprodi 2','kaprodi2','532963cad8d210a8a2f84e40fcbe0ba6','kaprodi2@gmail.com','','default.png','kaprodi','','0','2022-07-20 21:43:10','2022-07-20 21:43:10'),
(20,'20220720223957',4,'cobadaftarketua','cobadaftarketua','0e3166091a341c4b0469b91e4046dc24','cobadaftarketua@gmail.com','','default.png','peserta','82f82ff65c045c04','1','2022-07-20 22:39:57','2022-07-20 22:39:57'),
(22,'',4,'pembimbing 2','pembimbing2','101d61856b331eb50b36d31d04a0f608','pembimbing2@gmail.com','','default.png','pembimbing','','0','2022-09-05 15:43:20','2022-09-05 15:43:20');

/*Table structure for table `relasi_proposal_users` */

DROP TABLE IF EXISTS `relasi_proposal_users`;

/*!50001 DROP VIEW IF EXISTS `relasi_proposal_users` */;
/*!50001 DROP TABLE IF EXISTS `relasi_proposal_users` */;

/*!50001 CREATE TABLE  `relasi_proposal_users`(
 `nama` varchar(255) ,
 `id` int(25) ,
 `id_users` int(25) ,
 `id_kelompok` varchar(225) ,
 `files` varchar(225) ,
 `judul` varchar(225) ,
 `status_proposal` enum('0','1','2') ,
 `status_perbaikan` enum('0','1') ,
 `catatan_perbaikan` varchar(255) ,
 `id_users_verifikasi` int(25) ,
 `created_at` datetime ,
 `updated_at` datetime 
)*/;

/*View structure for view relasi_proposal_users */

/*!50001 DROP TABLE IF EXISTS `relasi_proposal_users` */;
/*!50001 DROP VIEW IF EXISTS `relasi_proposal_users` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `relasi_proposal_users` AS (select `b`.`nama` AS `nama`,`a`.`id` AS `id`,`a`.`id_users` AS `id_users`,`a`.`id_kelompok` AS `id_kelompok`,`a`.`files` AS `files`,`a`.`judul` AS `judul`,`a`.`status_proposal` AS `status_proposal`,`a`.`status_perbaikan` AS `status_perbaikan`,`a`.`catatan_perbaikan` AS `catatan_perbaikan`,`a`.`id_users_verifikasi` AS `id_users_verifikasi`,`a`.`created_at` AS `created_at`,`a`.`updated_at` AS `updated_at` from (`proposal` `a` join `users` `b` on(`a`.`id_users` = `b`.`id_users` and `a`.`id_kelompok` = `b`.`id_kelompok`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
