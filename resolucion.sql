/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 10.1.33-MariaDB : Database - maquiladigital
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`maquiladigital` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `maquiladigital`;

/*Table structure for table `resolucion` */

DROP TABLE IF EXISTS `resolucion`;

CREATE TABLE `resolucion` (
  `idresolucion` int(11) NOT NULL AUTO_INCREMENT,
  `nroresolucion` char(40) NOT NULL,
  `desde` char(10) NOT NULL,
  `hasta` char(10) NOT NULL,
  `fechavencimiento` datetime NOT NULL,
  `nitmatricula` char(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idresolucion`),
  KEY `nitmatricula` (`nitmatricula`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `resolucion` */

insert  into `resolucion`(`idresolucion`,`nroresolucion`,`desde`,`hasta`,`fechavencimiento`,`nitmatricula`,`activo`) values 
(3,'1112','1','1000','2018-10-10 00:00:00','901189320',1),
(6,'254','1001','2000','2018-10-10 00:00:00','901189320',0),
(8,'1451','10','20','2019-01-08 00:00:00','901189320',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
