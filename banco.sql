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

/*Table structure for table `banco` */

DROP TABLE IF EXISTS `banco`;

CREATE TABLE `banco` (
  `idbanco` int(11) NOT NULL AUTO_INCREMENT,
  `nitbanco` varchar(15) NOT NULL,
  `entidad` varchar(40) NOT NULL,
  `direccionbanco` varchar(40) NOT NULL,
  `telefonobanco` int(15) NOT NULL,
  `producto` varchar(50) NOT NULL,
  `numerocuenta` varchar(25) NOT NULL,
  `nitmatricula` char(15) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idbanco`)
) ENGINE=InnoDB AUTO_INCREMENT=1022 DEFAULT CHARSET=latin1;

/*Data for the table `banco` */

insert  into `banco`(`idbanco`,`nitbanco`,`entidad`,`direccionbanco`,`telefonobanco`,`producto`,`numerocuenta`,`nitmatricula`,`activo`) values 
(1015,'900456778','BANCO DAVIVIEND','CL 45 -56 56',4448120,'CORRIENTE','257-41830918','901189320',0),
(1020,'8909212121','BANCOLOMBIA SA','CL 45 -56 -56',4448120,'AHORROO','102045645645','901189320',0),
(1021,'14141','AVVILLAS','CRA 44',258,'AHORROS','555888','901189320',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
