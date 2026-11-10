/*
SQLyog Enterprise v13.1.5  (64 bit)
MySQL - 5.7.19 : Database - bonaire_atalaya_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bonaire_atalaya_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bonaire_atalaya_db`;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `category` */

insert  into `category`(`id`,`name`) values 
(1,'Noticias'),
(2,'Ofertas');

/*Table structure for table `comment` */

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `comment` */

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `brief` varchar(511) DEFAULT NULL,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `category_id` int(11) NOT NULL,
  `destination` smallint(1) DEFAULT '0' COMMENT '0=ambos, 1=atalaya, 2=bonaire',
  `publish_at` datetime DEFAULT NULL COMMENT 'Fecha de activacion (NULL=inmediata)',
  `expires_at` datetime DEFAULT NULL COMMENT 'Fecha de caducidad (NULL=nunca)',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `post` */

insert  into `post`(`id`,`title`,`brief`,`content`,`image`,`created_at`,`status`,`category_id`,`destination`) values 
(1,'Abrimos nueva zona de Spa','Abrimos nuestro nuevo SPA','Abrimos nueva zona de Spa en nuestro hotel, donde podrÃ¡ relajarse y disfrutar de nuestros masajes, nuestra coctelerÃ­a, entre otros muchos servicios','WhatsApp_Image_2019-07-19_at_20.40.04.jpeg','2019-08-01 09:12:16',1,1,0);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `kind` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`lastname`,`username`,`email`,`password`,`image`,`status`,`kind`,`created_at`) values 
(1,'Administrator','Administrador','admin','pruebas@bonairepaguera.com','90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad',NULL,1,1,'2019-08-01 08:55:04');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
