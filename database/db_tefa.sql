/*
SQLyog Professional v13.1.1 (64 bit)
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `alat` */

insert  into `alat`(`id`,`id_kelompok`,`alat`,`jumlah`,`created_at`,`updated_at`) values 
(4,'20220706114937','Sendok',1,'2022-07-15 11:31:09','2022-07-15 15:33:32'),
(5,'20220706114937','Panci',1,'2022-07-15 15:33:47','2022-07-15 15:33:47'),
(6,'20220706114937','Baskom',1,'2022-07-15 15:34:01','2022-07-15 15:34:01'),
(7,'20220706114937','Food processor',1,'2022-07-15 15:34:44','2022-07-15 15:34:44'),
(8,'20220706114937','Meat Grinder',1,'2022-07-15 15:35:02','2022-07-15 15:35:02'),
(9,'20220706114937','Talenan',1,'2022-07-15 15:35:14','2022-07-15 15:35:14'),
(10,'20220706114937','Pisau',1,'2022-07-15 15:35:30','2022-07-15 15:35:30'),
(11,'20220718201935','Pisau',2,'2022-07-18 21:15:05','2022-07-18 21:15:24'),
(12,'20220718201935','Talenan',3,'2022-07-18 21:15:51','2022-07-18 21:15:51'),
(13,'20220718201935','meat gerinda',1,'2022-07-18 21:16:21','2022-07-18 21:16:21'),
(14,'20220718201935','food prosessing',1,'2022-07-18 21:16:45','2022-07-18 21:16:45');

/*Table structure for table `bahan` */

DROP TABLE IF EXISTS `bahan`;

CREATE TABLE `bahan` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_kelompok` varchar(225) NOT NULL,
  `bahan` varchar(225) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `jumlah` int(25) NOT NULL,
  `satuan` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `bahan` */

insert  into `bahan`(`id`,`id_kelompok`,`bahan`,`harga`,`jumlah`,`satuan`,`created_at`,`updated_at`) values 
(1,'20220706114937','Air es',1000.00,300,'ML','2022-07-15 14:16:02','2022-07-15 15:36:21'),
(3,'20220706114937','Telur',12000.00,2,'Butir','2022-07-15 14:57:44','2022-07-15 15:36:46'),
(4,'20220706114937','Garam',5000.00,100,'Gram','2022-07-15 15:37:14','2022-07-15 15:37:14'),
(5,'20220706114937','Lada',500.00,30,'Gram','2022-07-15 15:37:38','2022-07-15 15:37:38'),
(6,'20220706114937','Bawang merah',12000.00,125,'Gram','2022-07-15 15:38:01','2022-07-15 15:38:01'),
(7,'20220718201935','daging ikan kakap',12000.00,2,'kg','2022-07-18 21:17:40','2022-07-18 21:18:22'),
(8,'20220718201935','Tepung Terigu',5000.00,5,'kg','2022-07-18 21:19:08','2022-07-18 21:19:08'),
(9,'20220718201935','Tepung Tapioka',7500.00,8,'kg','2022-07-18 21:19:57','2022-07-18 21:19:57');

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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4;

/*Data for the table `d_logbook` */

insert  into `d_logbook`(`id`,`uuid`,`id_kelompok`,`files`,`created_at`,`updated_at`) values 
(72,'20220725213356','20220706114937','1929363987WhatsApp Image 2022-07-02 at 19.35.34 (1).jpeg','2022-07-28 10:45:29','2022-07-28 10:45:29'),
(73,'20220725213356','20220706114937','1672774863WhatsApp Video 2022-07-02 at 11.01.56.mp4','2022-07-28 10:52:18','2022-07-28 10:52:18'),
(74,'20220725213356','20220706114937','1332310075WhatsApp Image 2022-07-02 at 19.35.35 (1).jpeg','2022-07-28 10:53:01','2022-07-28 10:53:01'),
(75,'20220725213356','20220706114937','1644655281WhatsApp Image 2022-07-02 at 19.35.39.jpeg','2022-07-28 10:56:45','2022-07-28 10:56:45');

/*Table structure for table `langkah` */

DROP TABLE IF EXISTS `langkah`;

CREATE TABLE `langkah` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_kelompok` varchar(225) NOT NULL,
  `langkah` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `langkah` */

insert  into `langkah`(`id`,`id_kelompok`,`langkah`,`created_at`,`updated_at`) values 
(1,'20220706114937','Haluskan daging ikan dengan menggunakan meat grinder','2022-07-15 15:19:09','2022-07-15 15:29:21'),
(3,'20220706114937','Tambahkan telur, bawang putih, bawang merah, lada garam campur hingga merata dengan menggunakan food processor','2022-07-15 15:32:30','2022-07-15 15:32:30'),
(4,'20220718201935','Haluskan daging ikan dengan menggunakan meat grinder','2022-07-18 21:20:39','2022-07-18 21:21:00'),
(6,'20220718201935','Tambahkan telur, bawang putih, bawang merah, lada garam campur hingga merata dengan menggunakan food processor','2022-07-18 21:21:37','2022-07-18 21:22:03');

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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `logbook` */

insert  into `logbook`(`id`,`uuid`,`id_kelompok`,`id_users`,`date`,`dari`,`sampai`,`aktivitas`,`keluaran`,`created_at`,`updated_at`) values 
(14,'20220725213356','20220706114937',2,'2022-07-01','21:33:00','21:34:00','sasa','dfdfdf','2022-07-25 21:35:54','2022-07-28 10:56:45');

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
  CONSTRAINT `map_pembimbing_ibfk_1` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `map_pembimbing_ibfk_2` FOREIGN KEY (`id_proposal`) REFERENCES `proposal` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `map_pembimbing` */

insert  into `map_pembimbing`(`id`,`id_pembimbing`,`id_kelompok`,`id_proposal`,`created_at`,`updated_at`) values 
(16,5,'20220706114937',23,'2022-07-23 10:40:38','2022-07-23 10:40:38'),
(17,5,'20220718201935',8,'2022-07-28 13:29:09','2022-07-28 13:29:09');

/*Table structure for table `pembimbing` */

DROP TABLE IF EXISTS `pembimbing`;

CREATE TABLE `pembimbing` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pembimbing` */

insert  into `pembimbing`(`id`,`nama`,`created_at`,`updated_at`) values 
(5,'Pembimbing 1','2022-07-18 09:36:14','2022-07-18 09:36:14'),
(6,'Pembimbing 2','2022-07-18 09:36:28','2022-07-18 09:36:28');

/*Table structure for table `penilaian` */

DROP TABLE IF EXISTS `penilaian`;

CREATE TABLE `penilaian` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_kelompok` varchar(225) NOT NULL,
  `inovasi` varchar(225) NOT NULL,
  `bentuk` varchar(225) NOT NULL,
  `rasa` varchar(225) NOT NULL,
  `kemasan` varchar(225) NOT NULL,
  `kelayakan` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penilaian` */

insert  into `penilaian`(`id`,`id_kelompok`,`inovasi`,`bentuk`,`rasa`,`kemasan`,`kelayakan`,`created_at`,`updated_at`) values 
(4,'20220718201935','Ada','Bagus','Enak','Menarik','Layak','2022-07-31 11:00:18','2022-07-31 11:00:18');

/*Table structure for table `prodi` */

DROP TABLE IF EXISTS `prodi`;

CREATE TABLE `prodi` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `prodi` varchar(225) NOT NULL,
  `id_users_kaprodi` int(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_users_kaprodi` (`id_users_kaprodi`),
  CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`id_users_kaprodi`) REFERENCES `users` (`id_users`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `prodi` */

insert  into `prodi`(`id`,`prodi`,`id_users_kaprodi`,`created_at`,`updated_at`) values 
(1,'Program Studi 1',4,'2022-07-20 21:17:37','2022-07-20 21:27:07'),
(3,'Program Studi 2',19,'2022-07-20 21:20:45','2022-07-20 22:14:20'),
(4,'Program Studi 3',4,'2022-07-20 21:59:36','2022-07-20 22:14:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `proposal` */

insert  into `proposal`(`id`,`id_users`,`id_kelompok`,`files`,`judul`,`status_proposal`,`status_perbaikan`,`catatan_perbaikan`,`id_users_verifikasi`,`created_at`,`updated_at`) values 
(7,9,'20220706114938','1657094991_3015111f824f3500d49e.pdf','SAMOSA IKAN','2','0','',3,'2022-07-06 15:09:51','2022-07-28 13:29:31'),
(8,17,'20220718201935','1658151649_bf89bd2abe62f4325fbb.pdf','Pembuatan Bakso Ikan Kakap','1','0','',3,'2022-07-18 20:40:49','2022-07-28 13:29:09'),
(23,2,'20220706114937','1658163613_afc9b31ea22b02709b31.pdf','Bakso Ikan Tenggiri','1','0','',3,'2022-07-19 00:00:13','2022-07-23 10:40:38');

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
(1,72,'0000-00-00 00:00:00','2022-07-15 00:04:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id_users`,`id_kelompok`,`id_prodi`,`nama`,`username`,`password`,`email`,`telepon`,`photo`,`roles`,`token_kelompok`,`status_kelompok`,`created_at`,`updated_at`) values 
(2,'20220706114937',3,'nama user1 zairi','user1','24c9e15e52afc47c225b757e7bee1f9d','zairi@gmail.com','081318739245','default.png','peserta','92da604d76d7eac1','1','2022-07-05 19:44:45','2022-07-30 18:24:05'),
(3,'',0,'nama admin 1','admin','21232f297a57a5a743894a0e4a801fc3','admin@gmail.com','081318739244','default.png','admin','','0','2022-07-05 19:44:45','2022-07-30 19:09:25'),
(4,'',0,'nama kaprodi 1','kaprodi','3c13922905d2bc454cc35e665335e2fd','kaprodi@gmail.com','','default.png','kaprodi','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(5,'',0,'nama kepala','kepala','870f669e4bbbfa8a6fde65549826d1c4','kepala@gmail.com','','default.png','kepala','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(6,'',0,'nama pemasaran','pemasaran','229eaac0894a3379d759a720e0e3410c','pemasaran@gmail.com','','default.png','pemasaran','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(7,'',0,'nama pembimbing','pembimbing','9d98460ff5d64814e7d341a965f38db1','pembimbing@gmail.com','','default.png','pembimbing','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(8,'',0,'nama quality','quality','d66636b253cb346dbb6240e30def3618','quality@gmail.com','','default.png','quality','','0','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(9,'20220706114938',4,'nama user2','user2','7e58d63b60197ceb55a1c487989a3720','user2@gmail.com','','default.png','peserta','83fd1dce1cc5ad31','2','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(10,'20220706114937',3,'nama user3','user3','92877af70a45fd6a2ed7fe81e1236b78','user3@gmail.com','','default.png','peserta','','1','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(11,'20220706114937',3,'nama user4','user4','3f02ebe3d7929b091e3d8ccfde2f3bc6','user4@gmail.com','','default.png','peserta','','1','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(12,'20220706114938',3,'nama user5','user5','0a791842f52a0acfbb3a783378c066b8','user5@gmail.com','','default.png','peserta','','1','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(13,'20220706114938',4,'nama user6','user6','affec3b64cf90492377a8114c86fc093','user6@gmail.com','','default.png','peserta','','1','2022-07-05 19:44:45','2022-07-05 19:44:45'),
(17,'20220718201935',4,'isnendar','iispurnama','78f6492e8160853edaf17cf31941f237','isnendarpontianak@gmail.com','','default.png','peserta','5ed3e46f2f521279','1','2022-07-18 20:19:35','2022-07-18 20:19:35'),
(18,'20220718201935',4,'purnama','bulanpurnama','19dd865ed8e07ed6021fbe7d5746720f','purnama@gmail.com','','default.png','peserta','5ed3e46f2f521279','2','2022-07-18 20:24:23','2022-07-18 20:24:23'),
(19,'',4,'nama kaprodi 2','kaprodi2','532963cad8d210a8a2f84e40fcbe0ba6','kaprodi2@gmail.com','','default.png','kaprodi','','0','2022-07-20 21:43:10','2022-07-20 21:43:10'),
(20,'20220720223957',4,'cobadaftarketua','cobadaftarketua','0e3166091a341c4b0469b91e4046dc24','cobadaftarketua@gmail.com','','default.png','peserta','82f82ff65c045c04','1','2022-07-20 22:39:57','2022-07-20 22:39:57');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
