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

/*Table structure for table `matriculaempresa` */

DROP TABLE IF EXISTS `matriculaempresa`;

CREATE TABLE `matriculaempresa` (
  `nitmatricula` char(15) NOT NULL,
  `dv` int(1) NOT NULL,
  `razonsocialmatricula` char(40) NOT NULL,
  `nombrematricula` char(40) NOT NULL,
  `apellidomatricula` char(40) NOT NULL,
  `direccionmatricula` char(40) NOT NULL,
  `telefonomatricula` char(15) NOT NULL,
  `celularmatricula` char(15) NOT NULL,
  `emailmatricula` char(40) NOT NULL,
  `iddepartamento` varchar(15) NOT NULL,
  `idmunicipio` varchar(15) NOT NULL,
  `paginaweb` char(40) NOT NULL,
  `porcentajeiva` double NOT NULL DEFAULT '0',
  `porcentajeretefuente` double NOT NULL DEFAULT '0',
  `retefuente` double NOT NULL DEFAULT '0',
  `porcentajereteiva` double NOT NULL DEFAULT '0',
  `id_tipo_regimen` int(11) NOT NULL,
  `declaracion` text NOT NULL,
  `id_banco_factura` int(11) DEFAULT NULL,
  `idresolucion` int(11) NOT NULL,
  PRIMARY KEY (`nitmatricula`),
  KEY `id_banco_factura` (`id_banco_factura`),
  KEY `id_tipo_regimen` (`id_tipo_regimen`),
  KEY `iddepartamento` (`iddepartamento`),
  KEY `idmunicipio` (`idmunicipio`),
  KEY `idresolucion` (`idresolucion`),
  CONSTRAINT `matriculaempresa_ibfk_1` FOREIGN KEY (`id_banco_factura`) REFERENCES `banco` (`idbanco`),
  CONSTRAINT `matriculaempresa_ibfk_2` FOREIGN KEY (`id_tipo_regimen`) REFERENCES `tipo_regimen` (`id_tipo_regimen`),
  CONSTRAINT `matriculaempresa_ibfk_3` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`),
  CONSTRAINT `matriculaempresa_ibfk_4` FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`),
  CONSTRAINT `matriculaempresa_ibfk_5` FOREIGN KEY (`idresolucion`) REFERENCES `resolucion` (`idresolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matriculaempresa` */

insert  into `matriculaempresa`(`nitmatricula`,`dv`,`razonsocialmatricula`,`nombrematricula`,`apellidomatricula`,`direccionmatricula`,`telefonomatricula`,`celularmatricula`,`emailmatricula`,`iddepartamento`,`idmunicipio`,`paginaweb`,`porcentajeiva`,`porcentajeretefuente`,`retefuente`,`porcentajereteiva`,`id_tipo_regimen`,`declaracion`,`id_banco_factura`,`idresolucion`) values 
('901189320',2,'MAQUILA DIGITAL SAS','JOSE GREGORIO','PULGARIN MORALES','CL 75A # 64D-15 INT 201','2575082','3013861052','jgpmorales1975@hotmail.com','05','05001','WWW-MAQUILA.COM',19,4,895000,15,1,'Según lo establecido en la ley 1231 de julio 17/08, esta factura se entiende irrevocablemente aceptada, y se asimila en todos sus efectos a\r\nuna letra de cambio según el artículo 774 del código de comercio. Autorizo a la entidad MAQUILA DIGITAL S.A.S o a quien represente la\r\ncalidad de acreedor, a reportar, procesar, solicitar o divulgar a cualquier entidad que maneje o administre base de datos la información\r\nreferente a mi comportamiento comercial.',1015,3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
