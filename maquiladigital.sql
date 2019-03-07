/*
SQLyog Community v12.2.1 (64 bit)
MySQL - 10.1.37-MariaDB : Database - maquiladigital
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

/*Table structure for table `archivodir` */

DROP TABLE IF EXISTS `archivodir`;

CREATE TABLE `archivodir` (
  `idarchivodir` int(11) NOT NULL AUTO_INCREMENT,
  `iddocumentodir` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `numero` int(11) DEFAULT NULL,
  `iddirectorio` int(11) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `extension` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tamaño` float DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `comentarios` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idarchivodir`),
  KEY `iddocumentodir` (`iddocumentodir`),
  KEY `iddirectorio` (`iddirectorio`),
  CONSTRAINT `archivodir_ibfk_1` FOREIGN KEY (`iddocumentodir`) REFERENCES `documentodir` (`iddocumentodir`),
  CONSTRAINT `archivodir_ibfk_2` FOREIGN KEY (`iddirectorio`) REFERENCES `directorio` (`iddirectorio`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `archivodir` */

insert  into `archivodir`(`idarchivodir`,`iddocumentodir`,`fecha_creacion`,`numero`,`iddirectorio`,`codigo`,`nombre`,`extension`,`tipo`,`tamaño`,`descripcion`,`comentarios`) values 
(14,4,'2019-01-11 15:45:45',4,1,7,'OrdenProduccion14201.pdf','pdf','application/pdf',435045,'ORDEN PRODUCCION 14201',NULL),
(15,4,'2019-01-12 15:59:16',4,1,8,'OPExterna13031.pdf','pdf','application/pdf',11508,'ORDEN TERMINACION',NULL),
(16,1,'2019-01-12 16:05:00',1,1,5,'Factura20.pdf','pdf','application/pdf',394268,'FACTURA 20',NULL),
(17,1,'2019-01-12 16:14:27',1,1,6,'Factura21.pdf','pdf','application/pdf',394271,'ORDEN DE TERMINACION 13031',NULL),
(18,4,'2019-01-17 16:47:39',4,1,9,'OrdeConfeccion227.pdf','pdf','application/pdf',254916,'ORDEN DE CONFECCION 227',NULL),
(19,4,'2019-01-17 17:16:41',4,1,10,'OrdeConfeccion527.pdf','pdf','application/pdf',433232,'ORDEN DE CONFECCION 527',NULL),
(20,1,'2019-01-19 15:22:26',1,1,7,'Factura22.pdf','pdf','application/pdf',394294,'FACTURA 22',NULL),
(21,4,'2019-01-19 15:35:50',4,1,11,'OrdenTerminacion13340.pdf','pdf','application/pdf',11533,'ORDEN DE TERMINACION 13340',NULL),
(22,1,'2019-01-19 15:40:51',1,1,8,'Factura23.pdf','pdf','application/pdf',394303,'FACTURA 23',NULL),
(23,5,'2019-01-20 18:28:53',5,1,1,'CuentaBancaria.pdf','pdf','application/pdf',55301,'CUENTA BANCARIA',NULL),
(24,5,'2019-01-20 18:29:10',5,1,1,'RUT DE TENNIS S.A.en Reorganizacion .pdf','pdf','application/pdf',683429,'RUT',NULL),
(25,4,'2019-01-24 09:31:08',4,1,12,'OrdenTerminacion14341.pdf','pdf','application/pdf',17209,'ORDEN TERMINACION 14341',NULL),
(26,1,'2019-01-24 09:37:19',1,1,9,'Factura24.pdf','pdf','application/pdf',394235,'FACTURA 24',NULL),
(27,1,'2019-01-24 09:42:15',1,1,10,'Factura25.pdf','pdf','application/pdf',394249,'FACTURA 25',NULL),
(28,1,'2019-01-28 11:45:22',1,1,1,'Factura16.pdf','pdf','application/pdf',394305,'FACTURA 16',NULL),
(29,1,'2019-01-28 11:46:28',1,1,2,'Factura17.pdf','pdf','application/pdf',394288,'FACTURA 17',NULL),
(30,4,'2019-01-28 12:28:50',4,1,2,'OrdenProduccion2.pdf','pdf','application/pdf',393138,'ORDEN PRODUCCION 2',NULL),
(31,4,'2019-01-28 12:29:28',4,1,3,'OrdenProduccion3.pdf','pdf','application/pdf',393124,'ORDEN DE CONFECCION 3',NULL),
(32,4,'2019-01-28 12:39:39',4,1,4,'OrdenProduccion4.pdf','pdf','application/pdf',393115,'ORDEN DE CONFECCION 4',NULL),
(33,4,'2019-01-28 12:40:34',4,1,5,'OrdenProduccion5 (1).pdf','pdf','application/pdf',393153,'ORDEN DE CONFECCION 5',NULL),
(34,4,'2019-01-28 12:41:37',4,1,6,'OrdenProduccion6.pdf','pdf','application/pdf',393133,'ORDEN DE CONFECCION 6',NULL),
(35,4,'2019-01-29 12:36:03',4,1,13,'OrdenConfecciion14962.pdf','pdf','application/pdf',309009,'ORDEN DE CONFECCION 14962',NULL),
(36,1,'2019-01-29 14:07:08',1,1,11,'Factura26.pdf','pdf','application/pdf',394295,'FACTURA 26',NULL),
(37,4,'2019-01-29 14:51:52',4,1,14,'OrdeTerminacio527.pdf','pdf','application/pdf',11539,'ORDEN DE TERMINACION 527',NULL),
(38,1,'2019-01-29 15:04:05',1,1,12,'Factura27.pdf','pdf','application/pdf',394269,'FACTURA 27',NULL),
(39,5,'2019-03-03 15:51:06',5,1,6,'Remision5.pdf','pdf','application/pdf',393743,'PRUEBA',NULL),
(40,5,'2019-03-03 15:53:28',5,1,6,'Remision2 (4).pdf','pdf','application/pdf',395501,'PRUEBA',NULL),
(41,1,'2019-03-03 18:00:50',1,1,13,'Factura31 (4).pdf','pdf','application/pdf',394181,'PRUEBA',NULL);

/*Table structure for table `arl` */

DROP TABLE IF EXISTS `arl`;

CREATE TABLE `arl` (
  `id_arl` int(11) NOT NULL AUTO_INCREMENT,
  `arl` float NOT NULL,
  PRIMARY KEY (`id_arl`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `arl` */

insert  into `arl`(`id_arl`,`arl`) values 
(1,0.522),
(2,1.044),
(3,2.436);

/*Table structure for table `banco` */

DROP TABLE IF EXISTS `banco`;

CREATE TABLE `banco` (
  `idbanco` int(11) NOT NULL AUTO_INCREMENT,
  `nitbanco` char(15) NOT NULL,
  `entidad` char(40) NOT NULL,
  `direccionbanco` char(40) NOT NULL,
  `telefonobanco` char(15) NOT NULL,
  `producto` char(30) NOT NULL,
  `numerocuenta` char(20) NOT NULL,
  `nitmatricula` char(15) NOT NULL,
  `activo` char(2) NOT NULL,
  PRIMARY KEY (`idbanco`),
  KEY `nitmatricula` (`nitmatricula`)
) ENGINE=InnoDB AUTO_INCREMENT=1023 DEFAULT CHARSET=latin1;

/*Data for the table `banco` */

insert  into `banco`(`idbanco`,`nitbanco`,`entidad`,`direccionbanco`,`telefonobanco`,`producto`,`numerocuenta`,`nitmatricula`,`activo`) values 
(1,'5555','TGGG','TTG','555','CUENTA CORRIENTE','5555','','1'),
(1021,'860035827','BANCO AVVILLAS SA','CC LOS SAUCES MEDELLIN','8672359','CUENTA DE AHORROS','502217367','901189320','1'),
(1022,'5555','5545RRFF','FFF','444','CUENTA DE AHORROS','44444','901189320','1');

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `idtipo` int(11) NOT NULL,
  `cedulanit` int(15) NOT NULL,
  `dv` int(1) NOT NULL,
  `razonsocial` varchar(40) DEFAULT NULL,
  `nombrecliente` varchar(30) DEFAULT NULL,
  `apellidocliente` varchar(30) DEFAULT NULL,
  `nombrecorto` varchar(200) DEFAULT NULL,
  `direccioncliente` varchar(40) DEFAULT NULL,
  `telefonocliente` char(15) DEFAULT NULL,
  `celularcliente` char(15) DEFAULT NULL,
  `emailcliente` char(40) NOT NULL,
  `contacto` char(40) NOT NULL,
  `telefonocontacto` char(15) NOT NULL,
  `celularcontacto` char(15) NOT NULL,
  `formapago` char(15) NOT NULL,
  `plazopago` int(11) DEFAULT NULL,
  `iddepartamento` varchar(15) NOT NULL,
  `idmunicipio` varchar(15) NOT NULL,
  `nitmatricula` char(15) NOT NULL,
  `tiporegimen` char(15) NOT NULL,
  `autoretenedor` tinyint(1) DEFAULT '0',
  `retencioniva` tinyint(1) DEFAULT '0',
  `retencionfuente` tinyint(1) DEFAULT '0',
  `observacion` longtext,
  `fechaingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcliente`),
  KEY `nitmatricula` (`nitmatricula`),
  KEY `idtipo` (`idtipo`),
  KEY `iddepartamento` (`iddepartamento`),
  KEY `idmunicipio` (`idmunicipio`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idtipo`) REFERENCES `tipodocumento` (`idtipo`),
  CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`),
  CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `cliente` */

insert  into `cliente`(`idcliente`,`idtipo`,`cedulanit`,`dv`,`razonsocial`,`nombrecliente`,`apellidocliente`,`nombrecorto`,`direccioncliente`,`telefonocliente`,`celularcliente`,`emailcliente`,`contacto`,`telefonocontacto`,`celularcontacto`,`formapago`,`plazopago`,`iddepartamento`,`idmunicipio`,`nitmatricula`,`tiporegimen`,`autoretenedor`,`retencioniva`,`retencionfuente`,`observacion`,`fechaingreso`) values 
(1,5,890920043,3,'TENNIS SA  EN REORGANIZACION','','','TENNIS SA  EN REORGANIZACION','CALLE 39 SUR # 26-09','3390000','3207880793','fvillegas@tennis.com.co','FREDY VILLEGAS','3390000','3207880793','2',15,'05','05250','901189320','1',1,1,1,'ESTE CLIENTE LE MAQUILAMOS Y LE REALIZAMOS TERMINACIÓN','2019-02-25 21:54:02'),
(2,5,3333333,8,'SSSSSS.','AAAAA','AA','SSSSSS.','CALLE 39 SUR # 26-09','4444','301','fvillegase@tennis.com.co','DDDD','3333','433','1',0,'05','05001','901189320','1',1,1,1,'EEEE','2019-02-06 17:19:05');

/*Table structure for table `color` */

DROP TABLE IF EXISTS `color`;

CREATE TABLE `color` (
  `color` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`color`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `color` */

insert  into `color`(`color`) values 
('Amarillo'),
('Azul'),
('Blanco'),
('Naranja'),
('Negro'),
('Rojo'),
('Rosado'),
('Verde');

/*Table structure for table `compra` */

DROP TABLE IF EXISTS `compra`;

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra_concepto` int(11) NOT NULL,
  `porcentajeiva` double DEFAULT '0',
  `porcentajefuente` double DEFAULT '0',
  `porcentajereteiva` double DEFAULT '0',
  `porcentajeaiu` double DEFAULT '0',
  `subtotal` double DEFAULT '0',
  `retencionfuente` double DEFAULT '0',
  `impuestoiva` double DEFAULT '0',
  `retencioniva` double DEFAULT '0',
  `base_aiu` double DEFAULT NULL,
  `saldo` double DEFAULT '0',
  `total` double DEFAULT '0',
  `id_proveedor` int(11) DEFAULT NULL,
  `usuariosistema` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) DEFAULT '0',
  `autorizado` tinyint(1) DEFAULT '0',
  `observacion` text COLLATE utf8_spanish_ci,
  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechainicio` date DEFAULT NULL,
  `fechavencimiento` date DEFAULT NULL,
  `numero` int(11) NOT NULL DEFAULT '0',
  `factura` int(11) NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_compra_concepto` (`id_compra_concepto`),
  CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`idproveedor`),
  CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`id_compra_concepto`) REFERENCES `compra_concepto` (`id_compra_concepto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `compra` */

insert  into `compra`(`id_compra`,`id_compra_concepto`,`porcentajeiva`,`porcentajefuente`,`porcentajereteiva`,`porcentajeaiu`,`subtotal`,`retencionfuente`,`impuestoiva`,`retencioniva`,`base_aiu`,`saldo`,`total`,`id_proveedor`,`usuariosistema`,`estado`,`autorizado`,`observacion`,`fechacreacion`,`fechainicio`,`fechavencimiento`,`numero`,`factura`) values 
(2,1,19,4,15,0,10915686,436627,2073980,311097,NULL,12241942,12241942,6,'71268830',0,1,'hola','2019-02-25 00:00:00','2019-02-27','2019-02-27',2,123),
(3,1,19,4,15,0,3000000,120000,570000,85500,NULL,3364500,3364500,6,'71268830',0,0,'ffff','2019-02-27 22:30:30','2019-02-27','2019-02-28',0,145),
(4,3,19,1,0,10,20366082,20366,386956,0,2036608,20732672,20732672,3,'71268830',0,0,'hola','2019-03-01 11:46:05','2019-03-01','2019-02-28',0,5258);

/*Table structure for table `compra_concepto` */

DROP TABLE IF EXISTS `compra_concepto`;

CREATE TABLE `compra_concepto` (
  `id_compra_concepto` int(11) NOT NULL AUTO_INCREMENT,
  `concepto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cuenta` int(11) NOT NULL,
  `id_compra_tipo` int(11) NOT NULL,
  `base_retencion` double DEFAULT '0',
  `porcentaje_iva` double DEFAULT '0',
  `porcentaje_retefuente` double DEFAULT '0',
  `porcentaje_reteiva` double DEFAULT '0',
  `base_aiu` double DEFAULT '0',
  PRIMARY KEY (`id_compra_concepto`),
  KEY `id_compra_tipo` (`id_compra_tipo`),
  CONSTRAINT `compra_concepto_ibfk_1` FOREIGN KEY (`id_compra_tipo`) REFERENCES `compra_tipo` (`id_compra_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `compra_concepto` */

insert  into `compra_concepto`(`id_compra_concepto`,`concepto`,`cuenta`,`id_compra_tipo`,`base_retencion`,`porcentaje_iva`,`porcentaje_retefuente`,`porcentaje_reteiva`,`base_aiu`) values 
(1,'COMPRAS OTROS',1111,2,925000,19,4,15,10),
(2,'SERVICIOS OTROS',2222,1,0,19,0,0,0),
(3,'TEMPORALES',452,2,925000,19,1,0,10);

/*Table structure for table `compra_tipo` */

DROP TABLE IF EXISTS `compra_tipo`;

CREATE TABLE `compra_tipo` (
  `id_compra_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_compra_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `compra_tipo` */

insert  into `compra_tipo`(`id_compra_tipo`,`tipo`) values 
(1,'SERVICIOS'),
(2,'COMPRAS');

/*Table structure for table `comprobante_egreso` */

DROP TABLE IF EXISTS `comprobante_egreso`;

CREATE TABLE `comprobante_egreso` (
  `id_comprobante_egreso` int(11) NOT NULL AUTO_INCREMENT,
  `id_municipio` varchar(15) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_comprobante` date NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `id_comprobante_egreso_tipo` int(11) NOT NULL,
  `valor` double DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `observacion` text,
  `usuariosistema` varchar(30) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `autorizado` tinyint(1) DEFAULT NULL,
  `libre` tinyint(1) DEFAULT NULL,
  `id_banco` int(11) NOT NULL,
  PRIMARY KEY (`id_comprobante_egreso`),
  KEY `id_municipio` (`id_municipio`),
  KEY `id_comprobante_egreso_tipo` (`id_comprobante_egreso_tipo`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_banco` (`id_banco`),
  CONSTRAINT `comprobante_egreso_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`idmunicipio`),
  CONSTRAINT `comprobante_egreso_ibfk_2` FOREIGN KEY (`id_comprobante_egreso_tipo`) REFERENCES `comprobante_egreso_tipo` (`id_comprobante_egreso_tipo`),
  CONSTRAINT `comprobante_egreso_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`idproveedor`),
  CONSTRAINT `comprobante_egreso_ibfk_4` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`idbanco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `comprobante_egreso` */

/*Table structure for table `comprobante_egreso_detalle` */

DROP TABLE IF EXISTS `comprobante_egreso_detalle`;

CREATE TABLE `comprobante_egreso_detalle` (
  `id_comprobante_egreso_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) DEFAULT NULL,
  `id_comprobante_egreso` int(11) NOT NULL,
  `vlr_abono` double DEFAULT '0',
  `vlr_saldo` double DEFAULT '0',
  `retefuente` double DEFAULT '0',
  `reteiva` double DEFAULT '0',
  `reteica` double DEFAULT '0',
  `iva` double DEFAULT '0',
  `base_aiu` double DEFAULT '0',
  `observacion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_comprobante_egreso_detalle`),
  KEY `id_compra` (`id_compra`),
  KEY `id_comprobante_egreso` (`id_comprobante_egreso`),
  CONSTRAINT `comprobante_egreso_detalle_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`),
  CONSTRAINT `comprobante_egreso_detalle_ibfk_2` FOREIGN KEY (`id_comprobante_egreso`) REFERENCES `comprobante_egreso` (`id_comprobante_egreso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `comprobante_egreso_detalle` */

/*Table structure for table `comprobante_egreso_tipo` */

DROP TABLE IF EXISTS `comprobante_egreso_tipo`;

CREATE TABLE `comprobante_egreso_tipo` (
  `id_comprobante_egreso_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `concepto` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_comprobante_egreso_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `comprobante_egreso_tipo` */

/*Table structure for table `conceptonota` */

DROP TABLE IF EXISTS `conceptonota`;

CREATE TABLE `conceptonota` (
  `idconceptonota` int(11) NOT NULL AUTO_INCREMENT,
  `concepto` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idconceptonota`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `conceptonota` */

insert  into `conceptonota`(`idconceptonota`,`concepto`,`estado`) values 
(1,'NOTA CREDITO',0);

/*Table structure for table `consecutivo` */

DROP TABLE IF EXISTS `consecutivo`;

CREATE TABLE `consecutivo` (
  `consecutivo_pk` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `consecutivo` int(20) NOT NULL,
  PRIMARY KEY (`consecutivo_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `consecutivo` */

insert  into `consecutivo`(`consecutivo_pk`,`nombre`,`consecutivo`) values 
(1,'FACTURA DE VENTA',31),
(2,'NOTA CREDITO',1),
(3,'RECIBO CAJA',9),
(4,'REMISION',4),
(5,'COMPRAS',2);

/*Table structure for table `costo_fijo` */

DROP TABLE IF EXISTS `costo_fijo`;

CREATE TABLE `costo_fijo` (
  `id_costo_fijo` int(11) NOT NULL AUTO_INCREMENT,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id_costo_fijo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `costo_fijo` */

insert  into `costo_fijo`(`id_costo_fijo`,`valor`) values 
(1,5628000);

/*Table structure for table `costo_fijo_detalle` */

DROP TABLE IF EXISTS `costo_fijo_detalle`;

CREATE TABLE `costo_fijo_detalle` (
  `id_detalle_costo_fijo` int(11) NOT NULL AUTO_INCREMENT,
  `id_costo_fijo` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `valor` float NOT NULL,
  PRIMARY KEY (`id_detalle_costo_fijo`),
  KEY `id_costo_fijo` (`id_costo_fijo`),
  CONSTRAINT `costo_fijo_detalle_ibfk_1` FOREIGN KEY (`id_costo_fijo`) REFERENCES `costo_fijo` (`id_costo_fijo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `costo_fijo_detalle` */

insert  into `costo_fijo_detalle`(`id_detalle_costo_fijo`,`id_costo_fijo`,`descripcion`,`valor`) values 
(4,1,'ARRIENDO LOCAL',2050000),
(6,1,'INTERNET Y TELEFONíA',140000),
(7,1,'SERVICIOS PUBLICOS',450000),
(8,1,'CAJA MENOR',1000000),
(9,1,'CONTADORA',600000),
(10,1,'TRANSPORTE',300000),
(11,1,'MANTENIMIENTOS MAQUINAS',100000),
(12,1,'SERVICIO DE EMPAQUES',988000);

/*Table structure for table `costo_laboral` */

DROP TABLE IF EXISTS `costo_laboral`;

CREATE TABLE `costo_laboral` (
  `id_costo_laboral` int(11) NOT NULL AUTO_INCREMENT,
  `total_otros` float DEFAULT NULL,
  `total_administrativo` float DEFAULT NULL,
  `total_administracion` float DEFAULT NULL,
  `total_operativo` float DEFAULT NULL,
  `total_general` float DEFAULT NULL,
  `empleados_operativos` int(11) DEFAULT NULL,
  `empleados_administrativos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_costo_laboral`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `costo_laboral` */

insert  into `costo_laboral`(`id_costo_laboral`,`total_otros`,`total_administrativo`,`total_administracion`,`total_operativo`,`total_general`,`empleados_operativos`,`empleados_administrativos`) values 
(1,0,2779290,1589560,25302900,28082200,16,2);

/*Table structure for table `costo_laboral_detalle` */

DROP TABLE IF EXISTS `costo_laboral_detalle`;

CREATE TABLE `costo_laboral_detalle` (
  `id_costo_laboral_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_costo_laboral` int(11) NOT NULL DEFAULT '1',
  `nro_empleados` int(11) NOT NULL DEFAULT '0',
  `salario` float NOT NULL DEFAULT '0',
  `auxilio_transporte` float NOT NULL DEFAULT '0',
  `tiempo_extra` float NOT NULL DEFAULT '0',
  `bonificacion` float NOT NULL DEFAULT '0',
  `arl` float NOT NULL DEFAULT '0',
  `pension` float NOT NULL DEFAULT '0',
  `caja` float NOT NULL DEFAULT '0',
  `prestaciones` float NOT NULL DEFAULT '0',
  `vacaciones` float NOT NULL DEFAULT '0',
  `ajuste_vac` float NOT NULL DEFAULT '0',
  `subtotal` float NOT NULL DEFAULT '0',
  `admon` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `id_tipo_cargo` int(11) NOT NULL DEFAULT '1',
  `id_arl` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_costo_laboral_detalle`),
  KEY `id_costo_laboral` (`id_costo_laboral`),
  KEY `id_tipo_cargo` (`id_tipo_cargo`),
  KEY `id_arl` (`id_arl`),
  CONSTRAINT `costo_laboral_detalle_ibfk_1` FOREIGN KEY (`id_costo_laboral`) REFERENCES `costo_laboral` (`id_costo_laboral`),
  CONSTRAINT `costo_laboral_detalle_ibfk_2` FOREIGN KEY (`id_tipo_cargo`) REFERENCES `tipo_cargo` (`id_tipo_cargo`),
  CONSTRAINT `costo_laboral_detalle_ibfk_3` FOREIGN KEY (`id_arl`) REFERENCES `arl` (`id_arl`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `costo_laboral_detalle` */

insert  into `costo_laboral_detalle`(`id_costo_laboral_detalle`,`id_costo_laboral`,`nro_empleados`,`salario`,`auxilio_transporte`,`tiempo_extra`,`bonificacion`,`arl`,`pension`,`caja`,`prestaciones`,`vacaciones`,`ajuste_vac`,`subtotal`,`admon`,`total`,`id_tipo_cargo`,`id_arl`) values 
(1,1,1,1000000,88211,2600000,0,37584,432000,144000,651338,45000,1800,4999930,299996,5299930,1,2),
(2,1,15,828116,88211,0,0,8646,99374,33125,161823,37265,1491,18870800,1132250,20003000,1,2),
(3,1,1,828116,88211,0,0,8646,99374,33125,161823,37265,1491,1258050,75483,1333530,2,2),
(4,1,1,900000,97032,0,0,4698,108000,36000,176076,40500,1620,1363930,81836,1445760,2,1);

/*Table structure for table `costo_laboral_hora` */

DROP TABLE IF EXISTS `costo_laboral_hora`;

CREATE TABLE `costo_laboral_hora` (
  `id_costo_laboral_hora` int(11) NOT NULL AUTO_INCREMENT,
  `dia` int(11) NOT NULL DEFAULT '0',
  `hora` int(11) NOT NULL DEFAULT '0',
  `minutos` int(11) NOT NULL DEFAULT '0',
  `segundos` int(11) NOT NULL DEFAULT '0',
  `dia_mes` int(11) NOT NULL DEFAULT '0',
  `valor_dia` float NOT NULL DEFAULT '0',
  `valor_hora` float NOT NULL DEFAULT '0',
  `valor_minuto` float NOT NULL DEFAULT '0',
  `valor_segundo` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_costo_laboral_hora`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `costo_laboral_hora` */

insert  into `costo_laboral_hora`(`id_costo_laboral_hora`,`dia`,`hora`,`minutos`,`segundos`,`dia_mes`,`valor_dia`,`valor_hora`,`valor_minuto`,`valor_segundo`) values 
(1,8,60,60,60,26,52170,6521.3,108.7,1.8);

/*Table structure for table `costo_produccion_diaria` */

DROP TABLE IF EXISTS `costo_produccion_diaria`;

CREATE TABLE `costo_produccion_diaria` (
  `id_costo_produccion_diaria` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL,
  `idordenproduccion` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `ordenproduccion` char(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ordenproduccionext` char(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idtipo` int(15) DEFAULT NULL,
  `cantidad_x_hora` float DEFAULT NULL,
  `cantidad_diaria` float DEFAULT NULL,
  `tiempo_entrega_dias` float DEFAULT NULL,
  `nro_horas` float DEFAULT NULL,
  `dias_entrega` float DEFAULT NULL,
  `costo_muestra_operaria` float DEFAULT NULL,
  `costo_x_hora` float DEFAULT NULL,
  PRIMARY KEY (`id_costo_produccion_diaria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `costo_produccion_diaria` */

insert  into `costo_produccion_diaria`(`id_costo_produccion_diaria`,`idcliente`,`idordenproduccion`,`cantidad`,`ordenproduccion`,`ordenproduccionext`,`idtipo`,`cantidad_x_hora`,`cantidad_diaria`,`tiempo_entrega_dias`,`nro_horas`,`dias_entrega`,`costo_muestra_operaria`,`costo_x_hora`) values 
(1,1,14,1171,'14633','13695',2,6.77,609.3,1.92,19.2,2,964,6526);

/*Table structure for table `departamento` */

DROP TABLE IF EXISTS `departamento`;

CREATE TABLE `departamento` (
  `iddepartamento` varchar(15) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`iddepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `departamento` */

insert  into `departamento`(`iddepartamento`,`departamento`,`activo`) values 
('05','ANTIOQUIA',1),
('08','ATLÁNTICO',1),
('11','D.C.',1),
('13','BOLIVAR',1),
('15','BOYACÁ',1),
('17','CALDAS',1),
('18','CAQUETÁ',1),
('19','CAUCA',1),
('20','CESAR',1),
('23','CÓRDOBA',1),
('25','CUNDINAMARCA',1),
('27','CHOCÓ',1),
('41','HUILA',1),
('44','LA GUAJIRA',1),
('47','MAGDALENA',1),
('50','META',1),
('52','NARIÑO',1),
('54','NORTE DE SANTANDER',1),
('63','QUINDIO',1),
('66','RISARALDA',1),
('68','SANTANDER',1),
('70','SUCRE',1),
('73','TOLIMA',1),
('76','VALLE DEL CAUCA',1),
('81','ARAUCA',1),
('85','CASANARE',1),
('86','PUTUMAYO',1),
('88','ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA',1),
('91','AMAZONAS',1),
('94','GUAINÍA',1),
('95','GUAVIARE',1),
('97','VAUPÉS',1),
('99','VICHADA',1);

/*Table structure for table `directorio` */

DROP TABLE IF EXISTS `directorio`;

CREATE TABLE `directorio` (
  `iddirectorio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `numeroarchivos` int(11) DEFAULT NULL,
  `ruta` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`iddirectorio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `directorio` */

insert  into `directorio`(`iddirectorio`,`nombre`,`numero`,`numeroarchivos`,`ruta`) values 
(1,'DOCUMENTOS',0,0,'Documentos/');

/*Table structure for table `documentodir` */

DROP TABLE IF EXISTS `documentodir`;

CREATE TABLE `documentodir` (
  `iddocumentodir` int(15) NOT NULL AUTO_INCREMENT,
  `codigodocumento` int(11) DEFAULT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`iddocumentodir`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `documentodir` */

insert  into `documentodir`(`iddocumentodir`,`codigodocumento`,`nombre`) values 
(1,1,'FACTURA VENTA'),
(2,2,'RECIBO CAJA'),
(3,3,'NOTA CREDITO'),
(4,4,'ORDEN PRODUCCION'),
(5,5,'CLIENTE'),
(6,6,'PROVEEDOR'),
(7,7,'COMPRAS');

/*Table structure for table `empleado` */

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado_tipo` int(11) DEFAULT NULL,
  `identificacion` int(15) NOT NULL,
  `dv` tinyint(1) DEFAULT NULL,
  `nombre1` varchar(20) DEFAULT NULL,
  `nombre2` varchar(20) DEFAULT NULL,
  `apellido1` varchar(20) DEFAULT NULL,
  `apellido2` varchar(20) DEFAULT NULL,
  `nombrecorto` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `iddepartamento` varchar(15) DEFAULT NULL,
  `idmunicipio` varchar(15) DEFAULT NULL,
  `contrato` tinyint(1) DEFAULT NULL,
  `observacion` text,
  `fechaingreso` date DEFAULT NULL,
  `fecharetiro` date DEFAULT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_empleado`),
  KEY `id_empleado_tipo` (`id_empleado_tipo`),
  KEY `iddepartamento` (`iddepartamento`),
  KEY `idmunicipio` (`idmunicipio`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_empleado_tipo`) REFERENCES `empleado_tipo` (`id_empleado_tipo`),
  CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`),
  CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `empleado` */

insert  into `empleado`(`id_empleado`,`id_empleado_tipo`,`identificacion`,`dv`,`nombre1`,`nombre2`,`apellido1`,`apellido2`,`nombrecorto`,`direccion`,`telefono`,`celular`,`email`,`iddepartamento`,`idmunicipio`,`contrato`,`observacion`,`fechaingreso`,`fecharetiro`,`fechacreacion`) values 
(1,1,71268830,6,'PABLO','ANDRES','ARANZAZU','ATUESTA','PABLO ANDRES ARANZAZU ATUESTA','CALLE DD','258896','3013333','paul6126@hotmail.com','05','05001',1,'AAA','2019-02-13','2019-02-14','2019-02-12 22:33:49'),
(2,1,71268831,3,'JUAN','PEDRO','LOPEZ','GALEANO','JUAN PEDRO LOPEZ GALEANO','CRA2','1','2','f@hotmail.com','50','50350',1,'HOLA HOLA HOLA','2019-02-15','2019-02-16','2019-02-12 23:11:20'),
(3,1,2147483647,3,'DSDSD','DDD','SDD','SDSD','DSDSD DDD SDD SDSD','CRA23','1','2222','fff@hotmail.com','50','50330',1,'AAZSX','2019-02-26',NULL,'2019-02-25 20:54:02');

/*Table structure for table `empleado_tipo` */

DROP TABLE IF EXISTS `empleado_tipo`;

CREATE TABLE `empleado_tipo` (
  `id_empleado_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_empleado_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `empleado_tipo` */

insert  into `empleado_tipo`(`id_empleado_tipo`,`tipo`) values 
(1,'OPERATIVO'),
(2,'ADMINISTRATIVO');

/*Table structure for table `facturaventa` */

DROP TABLE IF EXISTS `facturaventa`;

CREATE TABLE `facturaventa` (
  `idfactura` int(15) NOT NULL AUTO_INCREMENT,
  `nrofactura` int(20) DEFAULT NULL,
  `fechainicio` date NOT NULL,
  `fechavcto` date DEFAULT NULL,
  `fechacreacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `formapago` char(15) DEFAULT NULL,
  `plazopago` int(11) DEFAULT NULL,
  `porcentajeiva` double DEFAULT NULL,
  `porcentajefuente` double DEFAULT NULL,
  `porcentajereteiva` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `retencionfuente` double DEFAULT NULL,
  `impuestoiva` double DEFAULT NULL,
  `retencioniva` double DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `totalpagar` double DEFAULT NULL,
  `valorletras` longtext,
  `idcliente` int(15) NOT NULL,
  `idordenproduccion` int(11) NOT NULL,
  `usuariosistema` char(50) DEFAULT NULL,
  `idresolucion` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT '0' COMMENT 'estado 0 = abieto, estado 1 = abono, estado 2 = pagada, estado 3 = anulada por notacredito (saldo 0 en la factura), estado 4 = descuento por nota credito',
  `autorizado` tinyint(1) DEFAULT '0',
  `observacion` text,
  PRIMARY KEY (`idfactura`),
  KEY `idordenproduccion` (`idordenproduccion`),
  KEY `idcliente` (`idcliente`),
  KEY `idresolucion` (`idresolucion`),
  CONSTRAINT `facturaventa_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `facturaventa_ibfk_2` FOREIGN KEY (`idordenproduccion`) REFERENCES `ordenproduccion` (`idordenproduccion`),
  CONSTRAINT `facturaventa_ibfk_3` FOREIGN KEY (`idresolucion`) REFERENCES `resolucion` (`idresolucion`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `facturaventa` */

insert  into `facturaventa`(`idfactura`,`nrofactura`,`fechainicio`,`fechavcto`,`fechacreacion`,`formapago`,`plazopago`,`porcentajeiva`,`porcentajefuente`,`porcentajereteiva`,`subtotal`,`retencionfuente`,`impuestoiva`,`retencioniva`,`saldo`,`totalpagar`,`valorletras`,`idcliente`,`idordenproduccion`,`usuariosistema`,`idresolucion`,`estado`,`autorizado`,`observacion`) values 
(1,16,'2018-12-22','2018-12-22','2018-12-20 16:54:53','1',0,19,4,15,16813785,672551,3194619,479193,-37713323,18856660,'-',1,1,'71268830',3,2,1,'ENTREGA TOTAL DE LA REFERENCIA 108, SEGúN REMISIóN DE ENTREGA N° 00009'),
(2,0,'2018-12-22','2018-12-22','2019-01-03 14:03:13','1',0,19,4,15,1015101,40604.04,192869.19,28930.3785,1138435.7715,1138435.7715,'-',1,2,'71268830',3,0,0,'ENTREGA TOTAL DE LA REFERENCIA 108, SEGúN REMISIóN DE ENTREGA # 00009'),
(3,18,'2019-01-08','2019-01-08','2019-01-07 16:00:29','1',0,19,4,15,9556039,382242,1815647,272347,10717097,10717097,'-',1,3,'71268830',3,0,1,'SE ENTREGA LA REFENCIA N 133 EN LA REMISION DE ENTREGA N 00010'),
(4,19,'2019-01-08','2019-01-08','2019-01-08 15:10:49','1',0,19,4,15,2662338.638,106493.54552,505844.34122,75876.651183,0,2985812.782517,'-',1,4,'71268830',3,2,1,'SE ENTREGA LA REFERENCIA N. 133 EN LA REMISION DE ENTREGA N.00010'),
(5,20,'2019-01-13','2019-01-13','2019-01-11 12:55:16','1',0,19,4,15,10473572.52,418942.9008,1989978.7788,298496.81682,11746111.58118,11746111.58118,'-',1,5,'ADMINISTRADOR',3,0,1,'SE ENTREGA REFERENCIA 536 EN LA REMISION DE ENTREGA NRO 00011'),
(6,21,'2019-01-13','2019-01-13','2019-01-12 16:07:40','1',0,19,4,15,1092821.25,43712.85,207636.0375,31145.405625,1225599.031875,1225599.031875,'-',1,8,'ADMINISTRADOR',3,0,1,'SE ENTREGA LA TERMINACION DE LA REF. 536 EN LA REMISION DE ENTREGA 00011'),
(7,22,'2019-01-19','2019-01-19','2019-01-19 15:19:58','1',0,19,4,15,11280039,451202,2143207,321481,0,12650563,'-',1,7,'ADMINISTRADOR',3,2,1,'SE ENTREGA REFE. 271 EN LA REMISION DE ENTREGA NO 00012'),
(8,23,'2019-01-19','2019-01-19','2019-01-19 15:39:12','1',0,19,4,15,1059439,42378,201293,30194,0,1188160,'-',1,11,'ADMINISTRADOR',3,2,1,'SE HACE ENTREGA DE TERMINACION DE LA REFERENCIA NO 271 EN LA REMISION DE ENTREGA NO 00012'),
(9,24,'2019-01-24','2019-02-08','2019-01-24 09:33:13','2',15,19,0,15,515496.5678,0,97944.347882,14691.6521823,0,598749.2634997,'-',1,12,'ADMINISTRADOR',3,2,1,'SE ENTREGA REFERENCIA 147 EN LA ORDEN DE REMISION NO 00013'),
(10,25,'2019-01-24','2019-02-08','2019-01-24 09:39:55','2',15,19,4,15,5632774,225311,1070227,160534,6317156,6317156,'-',1,6,'ADMINISTRADOR',3,0,1,'SE ENTREGA REFERENCIA 147 EN LA ORDEN DE REMISION NO 00013'),
(11,26,'2019-01-29','2019-02-13','2019-01-29 14:05:03','2',15,19,4,15,8482958,339318,1611762,241764,9513638,9513638,'-',1,10,'ADMINISTRADOR',3,0,1,'SE ENTREGA LA REFERENCIA 527 EN LA ORDEN DE REMSION DE ENTREGA N  0014'),
(12,27,'2019-01-29','2019-02-13','2019-01-29 14:53:01','2',15,19,4,15,717639,0,136351,20453,-1,833537,'-',1,14,'ADMINISTRADOR',3,2,1,'SE ENTREGA LA TERMINACION DE LA REFERENCIA 527'),
(13,31,'2019-01-30','2019-02-14','2019-01-30 15:03:35','2',15,19,4,15,10915686,436627,2073980,311097,0,12241942,'-',1,9,'71268830',3,2,1,'ASAS');

/*Table structure for table `facturaventadetalle` */

DROP TABLE IF EXISTS `facturaventadetalle`;

CREATE TABLE `facturaventadetalle` (
  `iddetallefactura` int(11) NOT NULL AUTO_INCREMENT,
  `idfactura` int(15) NOT NULL,
  `idproductodetalle` int(11) NOT NULL,
  `codigoproducto` char(15) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciounitario` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`iddetallefactura`),
  KEY `nrofactura` (`idfactura`),
  KEY `idproductodetalle` (`idproductodetalle`),
  CONSTRAINT `facturaventadetalle_ibfk_1` FOREIGN KEY (`idproductodetalle`) REFERENCES `productodetalle` (`idproductodetalle`),
  CONSTRAINT `facturaventadetalle_ibfk_2` FOREIGN KEY (`idfactura`) REFERENCES `facturaventa` (`idfactura`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

/*Data for the table `facturaventadetalle` */

insert  into `facturaventadetalle`(`iddetallefactura`,`idfactura`,`idproductodetalle`,`codigoproducto`,`cantidad`,`preciounitario`,`total`) values 
(6,1,1,'108',459,8526.26,3913553.34),
(7,1,2,'108',611,8526.26,5209544.86),
(8,1,3,'108',510,8526.26,4348392.6),
(9,1,4,'108',240,8526.26,2046302.4),
(10,1,5,'108',152,8526.26,1295991.52),
(12,2,2,'108',611,514.757,314516.527),
(13,2,3,'108',510,514.757,262526.07),
(14,2,4,'108',240,514.757,123541.68),
(15,2,5,'108',152,514.757,78243.064),
(16,3,11,'133',227,4848.32,1100568.64),
(17,3,12,'133',511,4848.32,2477491.52),
(18,3,13,'133',638,4848.32,3093228.16),
(19,3,14,'133',595,4848.32,2884750.4),
(20,4,11,'133',227,1351.441,306777.107),
(21,4,12,'133',511,1351.441,690586.351),
(22,4,13,'133',638,1351.441,862219.358),
(23,4,14,'133',594,1351.441,802755.954),
(29,5,19,'536',392,8106.48,3177740.16),
(30,5,23,'536',393,8106.48,3185846.64),
(31,5,22,'536',125,8106.48,1013310),
(32,5,21,'536',234,8106.48,1896916.32),
(33,5,20,'536',148,8106.48,1199759.04),
(34,6,20,'536',148,845.836,125183.728),
(35,6,21,'536',234,845.836,197925.624),
(36,6,22,'536',125,845.83,105728.75),
(37,6,23,'536',393,845.836,332413.548),
(38,6,19,'536',392,845.836,331567.712),
(39,7,31,'271',141,9527.06,1343315.46),
(40,7,28,'271',313,9527.06,2981969.78),
(41,7,29,'271',92,9527.06,876489.52),
(42,7,30,'271',365,9527.06,3477376.9),
(43,7,32,'271',273,9527.06,2600887.38),
(44,8,31,'271',141,894.796,126166.236),
(45,8,28,'271',313,894.7968,280071.3984),
(46,8,29,'271',365,894.796,326600.54),
(47,8,30,'271',92,894.7968,82321.3056),
(48,8,32,'271',273,894.7968,244279.5264),
(49,9,26,'147',285,519.655,148101.675),
(50,9,25,'147',367,519.6544,190713.1648),
(51,9,27,'147',246,519.6544,127834.9824),
(52,9,24,'147',94,519.6544,48847.5136),
(53,10,26,'147',285,5678.2,1618287),
(54,10,25,'147',367,5678.2,2083899.4),
(55,10,27,'147',246,5678.2,1396837.2),
(56,10,24,'147',94,5678.2,533750.8),
(57,11,44,'527',96,7244.2,695443.2),
(58,11,45,'527',363,7244.2,2629644.6),
(59,11,46,'527',267,7244.2,1934201.4),
(60,11,47,'527',305,7244.2,2209481),
(61,11,48,'527',140,7244.2,1014188),
(67,12,45,'527',267,612.843,163629.081),
(68,12,46,'527',96,612.843,58832.928),
(69,12,47,'527',363,612.843,222462.009),
(70,12,48,'527',305,612.843,186917.115),
(71,12,44,'527',140,612.843,85798.02),
(72,13,38,'227',296,9659.9,2859330.4),
(73,13,39,'227',296,9659.9,2859330.4),
(74,13,40,'227',538,9659.9,5197026.2),
(75,2,1,'108',459,514.757,236273.463);

/*Table structure for table `fichatiempo` */

DROP TABLE IF EXISTS `fichatiempo`;

CREATE TABLE `fichatiempo` (
  `id_ficha_tiempo` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `cumplimiento` float DEFAULT NULL,
  `observacion` text COLLATE utf8_spanish_ci,
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `desde` date DEFAULT NULL,
  `hasta` date DEFAULT NULL,
  `referencia` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_ficha_tiempo`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `fichatiempo_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `fichatiempo` */

insert  into `fichatiempo`(`id_ficha_tiempo`,`id_empleado`,`cumplimiento`,`observacion`,`fechacreacion`,`desde`,`hasta`,`referencia`,`estado`) values 
(1,1,85.14,'Cumple con el perfil de la empresa','2019-02-13 22:36:05','2019-02-14','2019-02-15','001',0),
(2,2,5.56,'No cumple con el perfil de la empresa','2019-02-17 19:00:26','2019-02-27','2019-02-27','002',0),
(3,3,NULL,NULL,'2019-02-27 23:06:29',NULL,NULL,'555',0);

/*Table structure for table `fichatiempocalificacion` */

DROP TABLE IF EXISTS `fichatiempocalificacion`;

CREATE TABLE `fichatiempocalificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rango1` float NOT NULL,
  `rango2` float NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `fichatiempocalificacion` */

insert  into `fichatiempocalificacion`(`id`,`rango1`,`rango2`,`observacion`) values 
(1,0,80,'No cumple con el perfil de la empresa'),
(2,80,90,'Cumple con el perfil de la empresa'),
(3,90,100,'Gana bonificacion de 15000 pesos mensual'),
(4,100,10000,'Su Salario es 850,000 mil pesos mensuales');

/*Table structure for table `fichatiempodetalle` */

DROP TABLE IF EXISTS `fichatiempodetalle`;

CREATE TABLE `fichatiempodetalle` (
  `id_ficha_tiempo_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_ficha_tiempo` int(11) DEFAULT NULL,
  `dia` date DEFAULT NULL,
  `desde` time DEFAULT NULL,
  `hasta` time DEFAULT NULL,
  `total_segundos` float DEFAULT NULL,
  `total_operacion` float DEFAULT NULL,
  `realizadas` float DEFAULT NULL,
  `cumplimiento` float DEFAULT NULL,
  `observacion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_ficha_tiempo_detalle`),
  KEY `id_ficha_tiempo` (`id_ficha_tiempo`),
  CONSTRAINT `fichatiempodetalle_ibfk_1` FOREIGN KEY (`id_ficha_tiempo`) REFERENCES `fichatiempo` (`id_ficha_tiempo`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `fichatiempodetalle` */

insert  into `fichatiempodetalle`(`id_ficha_tiempo_detalle`,`id_ficha_tiempo`,`dia`,`desde`,`hasta`,`total_segundos`,`total_operacion`,`realizadas`,`cumplimiento`,`observacion`) values 
(1,1,'2019-02-14','23:00:00','01:00:00',30.1,119.6,100,83.61,'Cumple con el perfil de la empresa'),
(2,1,'2019-02-15','23:00:00','01:00:00',31.2,115.38,100,86.67,'Cumple con el perfil de la empresa'),
(17,2,'2019-02-27','01:00:00','02:00:00',20,180,10,5.56,'No cumple con el perfil de la empresa'),
(18,2,'2019-02-27','00:00:00','00:00:00',0,0,0,0,''),
(19,3,'2019-02-27','00:00:00','00:00:00',0,0,0,0,''),
(20,3,'2019-03-03','20:47:03','20:47:03',0,0,0,0,''),
(21,3,'2019-03-03','12:00:00','12:00:00',0,0,0,0,'');

/*Table structure for table `matriculaempresa` */

DROP TABLE IF EXISTS `matriculaempresa`;

CREATE TABLE `matriculaempresa` (
  `id` int(11) NOT NULL,
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
  `agente_retenedor` tinyint(1) NOT NULL DEFAULT '0',
  `gran_contribuyente` tinyint(1) NOT NULL DEFAULT '0',
  `declaracion` text NOT NULL,
  `id_banco_factura` int(11) DEFAULT NULL,
  `idresolucion` int(11) NOT NULL,
  `nombresistema` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_banco_factura` (`id_banco_factura`),
  KEY `id_tipo_regimen` (`id_tipo_regimen`),
  KEY `iddepartamento` (`iddepartamento`),
  KEY `idmunicipio` (`idmunicipio`),
  KEY `idresolucion` (`idresolucion`),
  CONSTRAINT `matriculaempresa_ibfk_2` FOREIGN KEY (`id_tipo_regimen`) REFERENCES `tipo_regimen` (`id_tipo_regimen`),
  CONSTRAINT `matriculaempresa_ibfk_3` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`),
  CONSTRAINT `matriculaempresa_ibfk_4` FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`),
  CONSTRAINT `matriculaempresa_ibfk_5` FOREIGN KEY (`idresolucion`) REFERENCES `resolucion` (`idresolucion`),
  CONSTRAINT `matriculaempresa_ibfk_6` FOREIGN KEY (`id_banco_factura`) REFERENCES `banco` (`idbanco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matriculaempresa` */

insert  into `matriculaempresa`(`id`,`nitmatricula`,`dv`,`razonsocialmatricula`,`nombrematricula`,`apellidomatricula`,`direccionmatricula`,`telefonomatricula`,`celularmatricula`,`emailmatricula`,`iddepartamento`,`idmunicipio`,`paginaweb`,`porcentajeiva`,`porcentajeretefuente`,`retefuente`,`porcentajereteiva`,`id_tipo_regimen`,`agente_retenedor`,`gran_contribuyente`,`declaracion`,`id_banco_factura`,`idresolucion`,`nombresistema`) values 
(1,'901189320',2,'MAQUILA DIGITAL SAS','MAQUILA','MAQUILA','CL 75A # 64D-15 INT 201','2575082','3013861052','jgpmorales1975@hotmail.com','05','05001','WWW.MAQUILA.COM',19,4,925000,15,1,1,1,'Según lo establecido en la ley 1231 de julio 17/08, esta factura se entiende irrevocablemente aceptada, y se asimila en todos sus efectos a\r\nuna letra de cambio según el artículo 774 del código de comercio. Autorizo a la entidad MAQUILA DIGITAL S.A.S o a quien represente la\r\ncalidad de acreedor, a reportar, procesar, solicitar o divulgar a cualquier entidad que maneje o administre base de datos la información\r\nreferente a mi comportamiento comercial.',1021,3,'SYSTIME');

/*Table structure for table `municipio` */

DROP TABLE IF EXISTS `municipio`;

CREATE TABLE `municipio` (
  `idmunicipio` varchar(15) NOT NULL,
  `codigomunicipio` varchar(15) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `iddepartamento` varchar(15) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmunicipio`),
  KEY `iddepartamento` (`iddepartamento`),
  CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `municipio` */

insert  into `municipio`(`idmunicipio`,`codigomunicipio`,`municipio`,`iddepartamento`,`activo`) values 
('05001','001','MEDELLIN','05',1),
('05002','002','ABEJORRAL','05',1),
('05004','004','ABRIAQUI','05',1),
('05021','021','ALEJANDRIA','05',1),
('05030','030','AMAGA','05',1),
('05031','031','AMALFI','05',1),
('05034','034','ANDES','05',1),
('05036','036','ANGELOPOLIS','05',1),
('05038','038','ANGOSTURA','05',1),
('05040','040','ANORI','05',1),
('05042','042','SANTAFE DE ANTIOQUIA','05',1),
('05044','044','ANZA','05',1),
('05045','045','APARTADO','05',1),
('05051','051','ARBOLETES','05',1),
('05055','055','ARGELIA','05',1),
('05059','059','ARMENIA','05',1),
('05079','079','BARBOSA','05',1),
('05086','086','BELMIRA','05',1),
('05088','088','BELLO','05',1),
('05091','091','BETANIA','05',1),
('05093','093','BETULIA','05',1),
('05101','101','CIUDAD BOLIVAR','05',1),
('05107','107','BRICEÑO','05',1),
('05113','113','BURITICA','05',1),
('05120','120','CACERES','05',1),
('05125','125','CAICEDO','05',1),
('05129','129','CALDAS','05',1),
('05134','134','CAMPAMENTO','05',1),
('05138','138','CAÑASGORDAS','05',1),
('05142','142','CARACOLI','05',1),
('05145','145','CARAMANTA','05',1),
('05147','147','CAREPA','05',1),
('05148','148','EL CARMEN DE VIBORAL','05',1),
('05150','150','CAROLINA','05',1),
('05154','154','CAUCASIA','05',1),
('05172','172','CHIGORODO','05',1),
('05190','190','CISNEROS','05',1),
('05197','197','COCORNA','05',1),
('05206','206','CONCEPCION','05',1),
('05209','209','CONCORDIA','05',1),
('05212','212','COPACABANA','05',1),
('05234','234','DABEIBA','05',1),
('05237','237','DON MATIAS','05',1),
('05240','240','EBEJICO','05',1),
('05250','250','EL BAGRE','05',1),
('05264','264','ENTRERRIOS','05',1),
('05266','266','ENVIGADO','05',1),
('05282','282','FREDONIA','05',1),
('05284','284','FRONTINO','05',1),
('05306','306','GIRALDO','05',1),
('05308','308','GIRARDOTA','05',1),
('05310','310','GOMEZ PLATA','05',1),
('05313','313','GRANADA','05',1),
('05315','315','GUADALUPE','05',1),
('05318','318','GUARNE','05',1),
('05321','321','GUATAPE','05',1),
('05347','347','HELICONIA','05',1),
('05353','353','HISPANIA','05',1),
('05360','360','ITAGUI','05',1),
('05361','361','ITUANGO','05',1),
('05364','364','JARDIN','05',1),
('05368','368','JERICO','05',1),
('05376','376','LA CEJA','05',1),
('05380','380','LA ESTRELLA','05',1),
('05390','390','LA PINTADA','05',1),
('05400','400','LA UNION','05',1),
('05411','411','LIBORINA','05',1),
('05425','425','MACEO','05',1),
('05440','440','MARINILLA','05',1),
('05467','467','MONTEBELLO','05',1),
('05475','475','MURINDO','05',1),
('05480','480','MUTATA','05',1),
('05483','483','NARIÑO','05',1),
('05490','490','NECOCLI','05',1),
('05495','495','NECHI','05',1),
('05501','501','OLAYA','05',1),
('05541','541','PEÐOL','05',1),
('05543','543','PEQUE','05',1),
('05576','576','PUEBLORRICO','05',1),
('05579','579','PUERTO BERRIO','05',1),
('05585','585','PUERTO NARE','05',1),
('05591','591','PUERTO TRIUNFO','05',1),
('05604','604','REMEDIOS','05',1),
('05607','607','RETIRO','05',1),
('05615','615','RIONEGRO','05',1),
('05628','628','SABANALARGA','05',1),
('05631','631','SABANETA','05',1),
('05642','642','SALGAR','05',1),
('05647','647','SAN ANDRES DE CUERQUIA','05',1),
('05649','649','SAN CARLOS','05',1),
('05652','652','SAN FRANCISCO','05',1),
('05656','656','SAN JERONIMO','05',1),
('05658','658','SAN JOSE DE LA MONTAÑA','05',1),
('05659','659','SAN JUAN DE URABA','05',1),
('05660','660','SAN LUIS','05',1),
('05664','664','SAN PEDRO','05',1),
('05665','665','SAN PEDRO DE URABA','05',1),
('05667','667','SAN RAFAEL','05',1),
('05670','670','SAN ROQUE','05',1),
('05674','674','SAN VICENTE','05',1),
('05679','679','SANTA BARBARA','05',1),
('05686','686','SANTA ROSA DE OSOS','05',1),
('05690','690','SANTO DOMINGO','05',1),
('05697','697','EL SANTUARIO','05',1),
('05736','736','SEGOVIA','05',1),
('05756','756','SONSON','05',1),
('05761','761','SOPETRAN','05',1),
('05789','789','TAMESIS','05',1),
('05790','790','TARAZA','05',1),
('05792','792','TARSO','05',1),
('05809','809','TITIRIBI','05',1),
('05819','819','TOLEDO','05',1),
('05837','837','TURBO','05',1),
('05842','842','URAMITA','05',1),
('05847','847','URRAO','05',1),
('05854','854','VALDIVIA','05',1),
('05856','856','VALPARAISO','05',1),
('05858','858','VEGACHI','05',1),
('05861','861','VENECIA','05',1),
('05873','873','VIGIA DEL FUERTE','05',1),
('05885','885','YALI','05',1),
('05887','887','YARUMAL','05',1),
('05890','890','YOLOMBO','05',1),
('05893','893','YONDO','05',1),
('05895','895','ZARAGOZA','05',1),
('08001','001','BARRANQUILLA','08',1),
('08078','078','BARANOA','08',1),
('08137','137','CAMPO DE LA CRUZ','08',1),
('08141','141','CANDELARIA','08',1),
('08296','296','GALAPA','08',1),
('08372','372','JUAN DE ACOSTA','08',1),
('08421','421','LURUACO','08',1),
('08433','433','MALAMBO','08',1),
('08436','436','MANATI','08',1),
('08520','520','PALMAR DE VARELA','08',1),
('08549','549','PIOJO','08',1),
('08558','558','POLONUEVO','08',1),
('08560','560','PONEDERA','08',1),
('08573','573','PUERTO COLOMBIA','08',1),
('08606','606','REPELON','08',1),
('08634','634','SABANAGRANDE','08',1),
('08638','638','SABANALARGA','08',1),
('08675','675','SANTA LUCIA','08',1),
('08685','685','SANTO TOMAS','08',1),
('08758','758','SOLEDAD','08',1),
('08770','770','SUAN','08',1),
('08832','832','TUBARA','08',1),
('08849','849','USIACURI','08',1),
('11001','001','BOGOTA, D.C.','11',1),
('13001','001','CARTAGENA','13',1),
('13006','006','ACHI','13',1),
('13030','030','ALTOS DEL ROSARIO','13',1),
('13042','042','ARENAL','13',1),
('13052','052','ARJONA','13',1),
('13062','062','ARROYOHONDO','13',1),
('13074','074','BARRANCO DE LOBA','13',1),
('13140','140','CALAMAR','13',1),
('13160','160','CANTAGALLO','13',1),
('13188','188','CICUCO','13',1),
('13212','212','CORDOBA','13',1),
('13222','222','CLEMENCIA','13',1),
('13244','244','EL CARMEN DE BOLIVAR','13',1),
('13248','248','EL GUAMO','13',1),
('13268','268','EL PEÑON','13',1),
('13300','300','HATILLO DE LOBA','13',1),
('13430','430','MAGANGUE','13',1),
('13433','433','MAHATES','13',1),
('13440','440','MARGARITA','13',1),
('13442','442','MARIA LA BAJA','13',1),
('13458','458','MONTECRISTO','13',1),
('13468','468','MOMPOS','13',1),
('13473','473','MORALES','13',1),
('13490','490','NOROSI','13',1),
('13549','549','PINILLOS','13',1),
('13580','580','REGIDOR','13',1),
('13600','600','RIO VIEJO','13',1),
('13620','620','SAN CRISTOBAL','13',1),
('13647','647','SAN ESTANISLAO','13',1),
('13650','650','SAN FERNANDO','13',1),
('13654','654','SAN JACINTO','13',1),
('13655','655','SAN JACINTO DEL CAUCA','13',1),
('13657','657','SAN JUAN NEPOMUCENO','13',1),
('13667','667','SAN MARTIN DE LOBA','13',1),
('13670','670','SAN PABLO','13',1),
('13673','673','SANTA CATALINA','13',1),
('13683','683','SANTA ROSA','13',1),
('13688','688','SANTA ROSA DEL SUR','13',1),
('13744','744','SIMITI','13',1),
('13760','760','SOPLAVIENTO','13',1),
('13780','780','TALAIGUA NUEVO','13',1),
('13810','810','TIQUISIO','13',1),
('13836','836','TURBACO','13',1),
('13838','838','TURBANA','13',1),
('13873','873','VILLANUEVA','13',1),
('13894','894','ZAMBRANO','13',1),
('15001','001','TUNJA','15',1),
('15022','022','ALMEIDA','15',1),
('15047','047','AQUITANIA','15',1),
('15051','051','ARCABUCO','15',1),
('15087','087','BELEN','15',1),
('15090','090','BERBEO','15',1),
('15092','092','BETEITIVA','15',1),
('15097','097','BOAVITA','15',1),
('15104','104','BOYACA','15',1),
('15106','106','BRICEÑO','15',1),
('15109','109','BUENAVISTA','15',1),
('15114','114','BUSBANZA','15',1),
('15131','131','CALDAS','15',1),
('15135','135','CAMPOHERMOSO','15',1),
('15162','162','CERINZA','15',1),
('15172','172','CHINAVITA','15',1),
('15176','176','CHIQUINQUIRA','15',1),
('15180','180','CHISCAS','15',1),
('15183','183','CHITA','15',1),
('15185','185','CHITARAQUE','15',1),
('15187','187','CHIVATA','15',1),
('15189','189','CIENEGA','15',1),
('15204','204','COMBITA','15',1),
('15212','212','COPER','15',1),
('15215','215','CORRALES','15',1),
('15218','218','COVARACHIA','15',1),
('15223','223','CUBARA','15',1),
('15224','224','CUCAITA','15',1),
('15226','226','CUITIVA','15',1),
('15232','232','CHIQUIZA','15',1),
('15236','236','CHIVOR','15',1),
('15238','238','DUITAMA','15',1),
('15244','244','EL COCUY','15',1),
('15248','248','EL ESPINO','15',1),
('15272','272','FIRAVITOBA','15',1),
('15276','276','FLORESTA','15',1),
('15293','293','GACHANTIVA','15',1),
('15296','296','GAMEZA','15',1),
('15299','299','GARAGOA','15',1),
('15317','317','GUACAMAYAS','15',1),
('15322','322','GUATEQUE','15',1),
('15325','325','GUAYATA','15',1),
('15332','332','GsICAN','15',1),
('15362','362','IZA','15',1),
('15367','367','JENESANO','15',1),
('15368','368','JERICO','15',1),
('15377','377','LABRANZAGRANDE','15',1),
('15380','380','LA CAPILLA','15',1),
('15401','401','LA VICTORIA','15',1),
('15403','403','LA UVITA','15',1),
('15407','407','VILLA DE LEYVA','15',1),
('15425','425','MACANAL','15',1),
('15442','442','MARIPI','15',1),
('15455','455','MIRAFLORES','15',1),
('15464','464','MONGUA','15',1),
('15466','466','MONGUI','15',1),
('15469','469','MONIQUIRA','15',1),
('15476','476','MOTAVITA','15',1),
('15480','480','MUZO','15',1),
('15491','491','NOBSA','15',1),
('15494','494','NUEVO COLON','15',1),
('15500','500','OICATA','15',1),
('15507','507','OTANCHE','15',1),
('15511','511','PACHAVITA','15',1),
('15514','514','PAEZ','15',1),
('15516','516','PAIPA','15',1),
('15518','518','PAJARITO','15',1),
('15522','522','PANQUEBA','15',1),
('15531','531','PAUNA','15',1),
('15533','533','PAYA','15',1),
('15537','537','PAZ DE RIO','15',1),
('15542','542','PESCA','15',1),
('15550','550','PISBA','15',1),
('15572','572','PUERTO BOYACA','15',1),
('15580','580','QUIPAMA','15',1),
('15599','599','RAMIRIQUI','15',1),
('15600','600','RAQUIRA','15',1),
('15621','621','RONDON','15',1),
('15632','632','SABOYA','15',1),
('15638','638','SACHICA','15',1),
('15646','646','SAMACA','15',1),
('15660','660','SAN EDUARDO','15',1),
('15664','664','SAN JOSE DE PARE','15',1),
('15667','667','SAN LUIS DE GACENO','15',1),
('15673','673','SAN MATEO','15',1),
('15676','676','SAN MIGUEL DE SEMA','15',1),
('15681','681','SAN PABLO DE BORBUR','15',1),
('15686','686','SANTANA','15',1),
('15690','690','SANTA MARIA','15',1),
('15693','693','SANTA ROSA DE VITERBO','15',1),
('15696','696','SANTA SOFIA','15',1),
('15720','720','SATIVANORTE','15',1),
('15723','723','SATIVASUR','15',1),
('15740','740','SIACHOQUE','15',1),
('15753','753','SOATA','15',1),
('15755','755','SOCOTA','15',1),
('15757','757','SOCHA','15',1),
('15759','759','SOGAMOSO','15',1),
('15761','761','SOMONDOCO','15',1),
('15762','762','SORA','15',1),
('15763','763','SOTAQUIRA','15',1),
('15764','764','SORACA','15',1),
('15774','774','SUSACON','15',1),
('15776','776','SUTAMARCHAN','15',1),
('15778','778','SUTATENZA','15',1),
('15790','790','TASCO','15',1),
('15798','798','TENZA','15',1),
('15804','804','TIBANA','15',1),
('15806','806','TIBASOSA','15',1),
('15808','808','TINJACA','15',1),
('15810','810','TIPACOQUE','15',1),
('15814','814','TOCA','15',1),
('15816','816','TOGsI','15',1),
('15820','820','TOPAGA','15',1),
('15822','822','TOTA','15',1),
('15832','832','TUNUNGUA','15',1),
('15835','835','TURMEQUE','15',1),
('15837','837','TUTA','15',1),
('15839','839','TUTAZA','15',1),
('15842','842','UMBITA','15',1),
('15861','861','VENTAQUEMADA','15',1),
('15879','879','VIRACACHA','15',1),
('15897','897','ZETAQUIRA','15',1),
('17001','001','MANIZALES','17',1),
('17013','013','AGUADAS','17',1),
('17042','042','ANSERMA','17',1),
('17050','050','ARANZAZU','17',1),
('17088','088','BELALCAZAR','17',1),
('17174','174','CHINCHINA','17',1),
('17272','272','FILADELFIA','17',1),
('17380','380','LA DORADA','17',1),
('17388','388','LA MERCED','17',1),
('17433','433','MANZANARES','17',1),
('17442','442','MARMATO','17',1),
('17444','444','MARQUETALIA','17',1),
('17446','446','MARULANDA','17',1),
('17486','486','NEIRA','17',1),
('17495','495','NORCASIA','17',1),
('17513','513','PACORA','17',1),
('17524','524','PALESTINA','17',1),
('17541','541','PENSILVANIA','17',1),
('17614','614','RIOSUCIO','17',1),
('17616','616','RISARALDA','17',1),
('17653','653','SALAMINA','17',1),
('17662','662','SAMANA','17',1),
('17665','665','SAN JOSE','17',1),
('17777','777','SUPIA','17',1),
('17867','867','VICTORIA','17',1),
('17873','873','VILLAMARIA','17',1),
('17877','877','VITERBO','17',1),
('18001','001','FLORENCIA','18',1),
('18029','029','ALBANIA','18',1),
('18094','094','BELEN DE LOS ANDAQUIES','18',1),
('18150','150','CARTAGENA DEL CHAIRA','18',1),
('18205','205','CURILLO','18',1),
('18247','247','EL DONCELLO','18',1),
('18256','256','EL PAUJIL','18',1),
('18410','410','LA MONTAÑITA','18',1),
('18460','460','MILAN','18',1),
('18479','479','MORELIA','18',1),
('18592','592','PUERTO RICO','18',1),
('18610','610','SAN JOSE DEL FRAGUA','18',1),
('18753','753','SAN VICENTE DEL CAGUAN','18',1),
('18756','756','SOLANO','18',1),
('18785','785','SOLITA','18',1),
('18860','860','VALPARAISO','18',1),
('19001','001','POPAYAN','19',1),
('19022','022','ALMAGUER','19',1),
('19050','050','ARGELIA','19',1),
('19075','075','BALBOA','19',1),
('19100','100','BOLIVAR','19',1),
('19110','110','BUENOS AIRES','19',1),
('19130','130','CAJIBIO','19',1),
('19137','137','CALDONO','19',1),
('19142','142','CALOTO','19',1),
('19212','212','CORINTO','19',1),
('19256','256','EL TAMBO','19',1),
('19290','290','FLORENCIA','19',1),
('19300','300','GUACHENE','19',1),
('19318','318','GUAPI','19',1),
('19355','355','INZA','19',1),
('19364','364','JAMBALO','19',1),
('19392','392','LA SIERRA','19',1),
('19397','397','LA VEGA','19',1),
('19418','418','LOPEZ','19',1),
('19450','450','MERCADERES','19',1),
('19455','455','MIRANDA','19',1),
('19473','473','MORALES','19',1),
('19513','513','PADILLA','19',1),
('19517','517','PAEZ','19',1),
('19532','532','PATIA','19',1),
('19533','533','PIAMONTE','19',1),
('19548','548','PIENDAMO','19',1),
('19573','573','PUERTO TEJADA','19',1),
('19585','585','PURACE','19',1),
('19622','622','ROSAS','19',1),
('19693','693','SAN SEBASTIAN','19',1),
('19698','698','SANTANDER DE QUILICHAO','19',1),
('19701','701','SANTA ROSA','19',1),
('19743','743','SILVIA','19',1),
('19760','760','SOTARA','19',1),
('19780','780','SUAREZ','19',1),
('19785','785','SUCRE','19',1),
('19807','807','TIMBIO','19',1),
('19809','809','TIMBIQUI','19',1),
('19821','821','TORIBIO','19',1),
('19824','824','TOTORO','19',1),
('19845','845','VILLA RICA','19',1),
('20001','001','VALLEDUPAR','20',1),
('20011','011','AGUACHICA','20',1),
('20013','013','AGUSTIN CODAZZI','20',1),
('20032','032','ASTREA','20',1),
('20045','045','BECERRIL','20',1),
('20060','060','BOSCONIA','20',1),
('20175','175','CHIMICHAGUA','20',1),
('20178','178','CHIRIGUANA','20',1),
('20228','228','CURUMANI','20',1),
('20238','238','EL COPEY','20',1),
('20250','250','EL PASO','20',1),
('20295','295','GAMARRA','20',1),
('20310','310','GONZALEZ','20',1),
('20383','383','LA GLORIA','20',1),
('20400','400','LA JAGUA DE IBIRICO','20',1),
('20443','443','MANAURE','20',1),
('20517','517','PAILITAS','20',1),
('20550','550','PELAYA','20',1),
('20570','570','PUEBLO BELLO','20',1),
('20614','614','RIO DE ORO','20',1),
('20621','621','LA PAZ','20',1),
('20710','710','SAN ALBERTO','20',1),
('20750','750','SAN DIEGO','20',1),
('20770','770','SAN MARTIN','20',1),
('20787','787','TAMALAMEQUE','20',1),
('23001','001','MONTERIA','23',1),
('23068','068','AYAPEL','23',1),
('23079','079','BUENAVISTA','23',1),
('23090','090','CANALETE','23',1),
('23162','162','CERETE','23',1),
('23168','168','CHIMA','23',1),
('23182','182','CHINU','23',1),
('23189','189','CIENAGA DE ORO','23',1),
('23300','300','COTORRA','23',1),
('23350','350','LA APARTADA','23',1),
('23417','417','LORICA','23',1),
('23419','419','LOS CORDOBAS','23',1),
('23464','464','MOMIL','23',1),
('23466','466','MONTELIBANO','23',1),
('23500','500','MOÑITOS','23',1),
('23555','555','PLANETA RICA','23',1),
('23570','570','PUEBLO NUEVO','23',1),
('23574','574','PUERTO ESCONDIDO','23',1),
('23580','580','PUERTO LIBERTADOR','23',1),
('23586','586','PURISIMA','23',1),
('23660','660','SAHAGUN','23',1),
('23670','670','SAN ANDRES SOTAVENTO','23',1),
('23672','672','SAN ANTERO','23',1),
('23675','675','SAN BERNARDO DEL VIENTO','23',1),
('23678','678','SAN CARLOS','23',1),
('23686','686','SAN PELAYO','23',1),
('23807','807','TIERRALTA','23',1),
('23855','855','VALENCIA','23',1),
('25001','001','AGUA DE DIOS','25',1),
('25019','019','ALBAN','25',1),
('25035','035','ANAPOIMA','25',1),
('25040','040','ANOLAIMA','25',1),
('25053','053','ARBELAEZ','25',1),
('25086','086','BELTRAN','25',1),
('25095','095','BITUIMA','25',1),
('25099','099','BOJACA','25',1),
('25120','120','CABRERA','25',1),
('25123','123','CACHIPAY','25',1),
('25126','126','CAJICA','25',1),
('25148','148','CAPARRAPI','25',1),
('25151','151','CAQUEZA','25',1),
('25154','154','CARMEN DE CARUPA','25',1),
('25168','168','CHAGUANI','25',1),
('25175','175','CHIA','25',1),
('25178','178','CHIPAQUE','25',1),
('25181','181','CHOACHI','25',1),
('25183','183','CHOCONTA','25',1),
('25200','200','COGUA','25',1),
('25214','214','COTA','25',1),
('25224','224','CUCUNUBA','25',1),
('25245','245','EL COLEGIO','25',1),
('25258','258','EL PEÑON','25',1),
('25260','260','EL ROSAL','25',1),
('25269','269','FACATATIVA','25',1),
('25279','279','FOMEQUE','25',1),
('25281','281','FOSCA','25',1),
('25286','286','FUNZA','25',1),
('25288','288','FUQUENE','25',1),
('25290','290','FUSAGASUGA','25',1),
('25293','293','GACHALA','25',1),
('25295','295','GACHANCIPA','25',1),
('25297','297','GACHETA','25',1),
('25299','299','GAMA','25',1),
('25307','307','GIRARDOT','25',1),
('25312','312','GRANADA','25',1),
('25317','317','GUACHETA','25',1),
('25320','320','GUADUAS','25',1),
('25322','322','GUASCA','25',1),
('25324','324','GUATAQUI','25',1),
('25326','326','GUATAVITA','25',1),
('25328','328','GUAYABAL DE SIQUIMA','25',1),
('25335','335','GUAYABETAL','25',1),
('25339','339','GUTIERREZ','25',1),
('25368','368','JERUSALEN','25',1),
('25372','372','JUNIN','25',1),
('25377','377','LA CALERA','25',1),
('25386','386','LA MESA','25',1),
('25394','394','LA PALMA','25',1),
('25398','398','LA PEÑA','25',1),
('25402','402','LA VEGA','25',1),
('25407','407','LENGUAZAQUE','25',1),
('25426','426','MACHETA','25',1),
('25430','430','MADRID','25',1),
('25436','436','MANTA','25',1),
('25438','438','MEDINA','25',1),
('25473','473','MOSQUERA','25',1),
('25483','483','NARIÑO','25',1),
('25486','486','NEMOCON','25',1),
('25488','488','NILO','25',1),
('25489','489','NIMAIMA','25',1),
('25491','491','NOCAIMA','25',1),
('25506','506','VENECIA','25',1),
('25513','513','PACHO','25',1),
('25518','518','PAIME','25',1),
('25524','524','PANDI','25',1),
('25530','530','PARATEBUENO','25',1),
('25535','535','PASCA','25',1),
('25572','572','PUERTO SALGAR','25',1),
('25580','580','PULI','25',1),
('25592','592','QUEBRADANEGRA','25',1),
('25594','594','QUETAME','25',1),
('25596','596','QUIPILE','25',1),
('25599','599','APULO','25',1),
('25612','612','RICAURTE','25',1),
('25645','645','SAN ANTONIO DEL TEQUENDAMA','25',1),
('25649','649','SAN BERNARDO','25',1),
('25653','653','SAN CAYETANO','25',1),
('25658','658','SAN FRANCISCO','25',1),
('25662','662','SAN JUAN DE RIO SECO','25',1),
('25718','718','SASAIMA','25',1),
('25736','736','SESQUILE','25',1),
('25740','740','SIBATE','25',1),
('25743','743','SILVANIA','25',1),
('25745','745','SIMIJACA','25',1),
('25754','754','SOACHA','25',1),
('25758','758','SOPO','25',1),
('25769','769','SUBACHOQUE','25',1),
('25772','772','SUESCA','25',1),
('25777','777','SUPATA','25',1),
('25779','779','SUSA','25',1),
('25781','781','SUTATAUSA','25',1),
('25785','785','TABIO','25',1),
('25793','793','TAUSA','25',1),
('25797','797','TENA','25',1),
('25799','799','TENJO','25',1),
('25805','805','TIBACUY','25',1),
('25807','807','TIBIRITA','25',1),
('25815','815','TOCAIMA','25',1),
('25817','817','TOCANCIPA','25',1),
('25823','823','TOPAIPI','25',1),
('25839','839','UBALA','25',1),
('25841','841','UBAQUE','25',1),
('25843','843','VILLA DE SAN DIEGO DE UBATE','25',1),
('25845','845','UNE','25',1),
('25851','851','UTICA','25',1),
('25862','862','VERGARA','25',1),
('25867','867','VIANI','25',1),
('25871','871','VILLAGOMEZ','25',1),
('25873','873','VILLAPINZON','25',1),
('25875','875','VILLETA','25',1),
('25878','878','VIOTA','25',1),
('25885','885','YACOPI','25',1),
('25898','898','ZIPACON','25',1),
('25899','899','ZIPAQUIRA','25',1),
('27001','001','QUIBDO','27',1),
('27006','006','ACANDI','27',1),
('27025','025','ALTO BAUDO','27',1),
('27050','050','ATRATO','27',1),
('27073','073','BAGADO','27',1),
('27075','075','BAHIA SOLANO','27',1),
('27077','077','BAJO BAUDO','27',1),
('27099','099','BOJAYA','27',1),
('27135','135','EL CANTON DEL SAN PABLO','27',1),
('27150','150','CARMEN DEL DARIEN','27',1),
('27160','160','CERTEGUI','27',1),
('27205','205','CONDOTO','27',1),
('27245','245','EL CARMEN DE ATRATO','27',1),
('27250','250','EL LITORAL DEL SAN JUAN','27',1),
('27361','361','ISTMINA','27',1),
('27372','372','JURADO','27',1),
('27413','413','LLORO','27',1),
('27425','425','MEDIO ATRATO','27',1),
('27430','430','MEDIO BAUDO','27',1),
('27450','450','MEDIO SAN JUAN','27',1),
('27491','491','NOVITA','27',1),
('27495','495','NUQUI','27',1),
('27580','580','RIO IRO','27',1),
('27600','600','RIO QUITO','27',1),
('27615','615','RIOSUCIO','27',1),
('27660','660','SAN JOSE DEL PALMAR','27',1),
('27745','745','SIPI','27',1),
('27787','787','TADO','27',1),
('27800','800','UNGUIA','27',1),
('27810','810','UNION PANAMERICANA','27',1),
('41001','001','NEIVA','41',1),
('41006','006','ACEVEDO','41',1),
('41013','013','AGRADO','41',1),
('41016','016','AIPE','41',1),
('41020','020','ALGECIRAS','41',1),
('41026','026','ALTAMIRA','41',1),
('41078','078','BARAYA','41',1),
('41132','132','CAMPOALEGRE','41',1),
('41206','206','COLOMBIA','41',1),
('41244','244','ELIAS','41',1),
('41298','298','GARZON','41',1),
('41306','306','GIGANTE','41',1),
('41319','319','GUADALUPE','41',1),
('41349','349','HOBO','41',1),
('41357','357','IQUIRA','41',1),
('41359','359','ISNOS','41',1),
('41378','378','LA ARGENTINA','41',1),
('41396','396','LA PLATA','41',1),
('41483','483','NATAGA','41',1),
('41503','503','OPORAPA','41',1),
('41518','518','PAICOL','41',1),
('41524','524','PALERMO','41',1),
('41530','530','PALESTINA','41',1),
('41548','548','PITAL','41',1),
('41551','551','PITALITO','41',1),
('41615','615','RIVERA','41',1),
('41660','660','SALADOBLANCO','41',1),
('41668','668','SAN AGUSTIN','41',1),
('41676','676','SANTA MARIA','41',1),
('41770','770','SUAZA','41',1),
('41791','791','TARQUI','41',1),
('41797','797','TESALIA','41',1),
('41799','799','TELLO','41',1),
('41801','801','TERUEL','41',1),
('41807','807','TIMANA','41',1),
('41872','872','VILLAVIEJA','41',1),
('41885','885','YAGUARA','41',1),
('44001','001','RIOHACHA','44',1),
('44035','035','ALBANIA','44',1),
('44078','078','BARRANCAS','44',1),
('44090','090','DIBULLA','44',1),
('44098','098','DISTRACCION','44',1),
('44110','110','EL MOLINO','44',1),
('44279','279','FONSECA','44',1),
('44378','378','HATONUEVO','44',1),
('44420','420','LA JAGUA DEL PILAR','44',1),
('44430','430','MAICAO','44',1),
('44560','560','MANAURE','44',1),
('44650','650','SAN JUAN DEL CESAR','44',1),
('44847','847','URIBIA','44',1),
('44855','855','URUMITA','44',1),
('44874','874','VILLANUEVA','44',1),
('47001','001','SANTA MARTA','47',1),
('47030','030','ALGARROBO','47',1),
('47053','053','ARACATACA','47',1),
('47058','058','ARIGUANI','47',1),
('47161','161','CERRO SAN ANTONIO','47',1),
('47170','170','CHIBOLO','47',1),
('47189','189','CIENAGA','47',1),
('47205','205','CONCORDIA','47',1),
('47245','245','EL BANCO','47',1),
('47258','258','EL PIÑON','47',1),
('47268','268','EL RETEN','47',1),
('47288','288','FUNDACION','47',1),
('47318','318','GUAMAL','47',1),
('47460','460','NUEVA GRANADA','47',1),
('47541','541','PEDRAZA','47',1),
('47545','545','PIJIÑO DEL CARMEN','47',1),
('47551','551','PIVIJAY','47',1),
('47555','555','PLATO','47',1),
('47570','570','PUEBLOVIEJO','47',1),
('47605','605','REMOLINO','47',1),
('47660','660','SABANAS DE SAN ANGEL','47',1),
('47675','675','SALAMINA','47',1),
('47692','692','SAN SEBASTIAN DE BUENAVISTA','47',1),
('47703','703','SAN ZENON','47',1),
('47707','707','SANTA ANA','47',1),
('47720','720','SANTA BARBARA DE PINTO','47',1),
('47745','745','SITIONUEVO','47',1),
('47798','798','TENERIFE','47',1),
('47960','960','ZAPAYAN','47',1),
('47980','980','ZONA BANANERA','47',1),
('50001','001','VILLAVICENCIO','50',1),
('50006','006','ACACIAS','50',1),
('50110','110','BARRANCA DE UPIA','50',1),
('50124','124','CABUYARO','50',1),
('50150','150','CASTILLA LA NUEVA','50',1),
('50223','223','CUBARRAL','50',1),
('50226','226','CUMARAL','50',1),
('50245','245','EL CALVARIO','50',1),
('50251','251','EL CASTILLO','50',1),
('50270','270','EL DORADO','50',1),
('50287','287','FUENTE DE ORO','50',1),
('50313','313','GRANADA','50',1),
('50318','318','GUAMAL','50',1),
('50325','325','MAPIRIPAN','50',1),
('50330','330','MESETAS','50',1),
('50350','350','LA MACARENA','50',1),
('50370','370','URIBE','50',1),
('50400','400','LEJANIAS','50',1),
('50450','450','PUERTO CONCORDIA','50',1),
('50568','568','PUERTO GAITAN','50',1),
('50573','573','PUERTO LOPEZ','50',1),
('50577','577','PUERTO LLERAS','50',1),
('50590','590','PUERTO RICO','50',1),
('50606','606','RESTREPO','50',1),
('50680','680','SAN CARLOS DE GUAROA','50',1),
('50683','683','SAN JUAN DE ARAMA','50',1),
('50686','686','SAN JUANITO','50',1),
('50689','689','SAN MARTIN','50',1),
('50711','711','VISTAHERMOSA','50',1),
('52001','001','PASTO','52',1),
('52019','019','ALBAN','52',1),
('52022','022','ALDANA','52',1),
('52036','036','ANCUYA','52',1),
('52051','051','ARBOLEDA','52',1),
('52079','079','BARBACOAS','52',1),
('52083','083','BELEN','52',1),
('52110','110','BUESACO','52',1),
('52203','203','COLON','52',1),
('52207','207','CONSACA','52',1),
('52210','210','CONTADERO','52',1),
('52215','215','CORDOBA','52',1),
('52224','224','CUASPUD','52',1),
('52227','227','CUMBAL','52',1),
('52233','233','CUMBITARA','52',1),
('52240','240','CHACHAGsI','52',1),
('52250','250','EL CHARCO','52',1),
('52254','254','EL PEÑOL','52',1),
('52256','256','EL ROSARIO','52',1),
('52258','258','EL TABLON DE GOMEZ','52',1),
('52260','260','EL TAMBO','52',1),
('52287','287','FUNES','52',1),
('52317','317','GUACHUCAL','52',1),
('52320','320','GUAITARILLA','52',1),
('52323','323','GUALMATAN','52',1),
('52352','352','ILES','52',1),
('52354','354','IMUES','52',1),
('52356','356','IPIALES','52',1),
('52378','378','LA CRUZ','52',1),
('52381','381','LA FLORIDA','52',1),
('52385','385','LA LLANADA','52',1),
('52390','390','LA TOLA','52',1),
('52399','399','LA UNION','52',1),
('52405','405','LEIVA','52',1),
('52411','411','LINARES','52',1),
('52418','418','LOS ANDES','52',1),
('52427','427','MAGsI','52',1),
('52435','435','MALLAMA','52',1),
('52473','473','MOSQUERA','52',1),
('52480','480','NARIÑO','52',1),
('52490','490','OLAYA HERRERA','52',1),
('52506','506','OSPINA','52',1),
('52520','520','FRANCISCO PIZARRO','52',1),
('52540','540','POLICARPA','52',1),
('52560','560','POTOSI','52',1),
('52565','565','PROVIDENCIA','52',1),
('52573','573','PUERRES','52',1),
('52585','585','PUPIALES','52',1),
('52612','612','RICAURTE','52',1),
('52621','621','ROBERTO PAYAN','52',1),
('52678','678','SAMANIEGO','52',1),
('52683','683','SANDONA','52',1),
('52685','685','SAN BERNARDO','52',1),
('52687','687','SAN LORENZO','52',1),
('52693','693','SAN PABLO','52',1),
('52694','694','SAN PEDRO DE CARTAGO','52',1),
('52696','696','SANTA BARBARA','52',1),
('52699','699','SANTACRUZ','52',1),
('52720','720','SAPUYES','52',1),
('52786','786','TAMINANGO','52',1),
('52788','788','TANGUA','52',1),
('52835','835','SAN ANDRES DE TUMACO','52',1),
('52838','838','TUQUERRES','52',1),
('52885','885','YACUANQUER','52',1),
('54001','001','CUCUTA','54',1),
('54003','003','ABREGO','54',1),
('54051','051','ARBOLEDAS','54',1),
('54099','099','BOCHALEMA','54',1),
('54109','109','BUCARASICA','54',1),
('54125','125','CACOTA','54',1),
('54128','128','CACHIRA','54',1),
('54172','172','CHINACOTA','54',1),
('54174','174','CHITAGA','54',1),
('54206','206','CONVENCION','54',1),
('54223','223','CUCUTILLA','54',1),
('54239','239','DURANIA','54',1),
('54245','245','EL CARMEN','54',1),
('54250','250','EL TARRA','54',1),
('54261','261','EL ZULIA','54',1),
('54313','313','GRAMALOTE','54',1),
('54344','344','HACARI','54',1),
('54347','347','HERRAN','54',1),
('54377','377','LABATECA','54',1),
('54385','385','LA ESPERANZA','54',1),
('54398','398','LA PLAYA','54',1),
('54405','405','LOS PATIOS','54',1),
('54418','418','LOURDES','54',1),
('54480','480','MUTISCUA','54',1),
('54498','498','OCAÑA','54',1),
('54518','518','PAMPLONA','54',1),
('54520','520','PAMPLONITA','54',1),
('54553','553','PUERTO SANTANDER','54',1),
('54599','599','RAGONVALIA','54',1),
('54660','660','SALAZAR','54',1),
('54670','670','SAN CALIXTO','54',1),
('54673','673','SAN CAYETANO','54',1),
('54680','680','SANTIAGO','54',1),
('54720','720','SARDINATA','54',1),
('54743','743','SILOS','54',1),
('54800','800','TEORAMA','54',1),
('54810','810','TIBU','54',1),
('54820','820','TOLEDO','54',1),
('54871','871','VILLA CARO','54',1),
('54874','874','VILLA DEL ROSARIO','54',1),
('63001','001','ARMENIA','63',1),
('63111','111','BUENAVISTA','63',1),
('63130','130','CALARCA','63',1),
('63190','190','CIRCASIA','63',1),
('63212','212','CORDOBA','63',1),
('63272','272','FILANDIA','63',1),
('63302','302','GENOVA','63',1),
('63401','401','LA TEBAIDA','63',1),
('63470','470','MONTENEGRO','63',1),
('63548','548','PIJAO','63',1),
('63594','594','QUIMBAYA','63',1),
('63690','690','SALENTO','63',1),
('66001','001','PEREIRA','66',1),
('66045','045','APIA','66',1),
('66075','075','BALBOA','66',1),
('66088','088','BELEN DE UMBRIA','66',1),
('66170','170','DOSQUEBRADAS','66',1),
('66318','318','GUATICA','66',1),
('66383','383','LA CELIA','66',1),
('66400','400','LA VIRGINIA','66',1),
('66440','440','MARSELLA','66',1),
('66456','456','MISTRATO','66',1),
('66572','572','PUEBLO RICO','66',1),
('66594','594','QUINCHIA','66',1),
('66682','682','SANTA ROSA DE CABAL','66',1),
('66687','687','SANTUARIO','66',1),
('68001','001','BUCARAMANGA','68',1),
('68013','013','AGUADA','68',1),
('68020','020','ALBANIA','68',1),
('68051','051','ARATOCA','68',1),
('68077','077','BARBOSA','68',1),
('68079','079','BARICHARA','68',1),
('68081','081','BARRANCABERMEJA','68',1),
('68092','092','BETULIA','68',1),
('68101','101','BOLIVAR','68',1),
('68121','121','CABRERA','68',1),
('68132','132','CALIFORNIA','68',1),
('68147','147','CAPITANEJO','68',1),
('68152','152','CARCASI','68',1),
('68160','160','CEPITA','68',1),
('68162','162','CERRITO','68',1),
('68167','167','CHARALA','68',1),
('68169','169','CHARTA','68',1),
('68176','176','CHIMA','68',1),
('68179','179','CHIPATA','68',1),
('68190','190','CIMITARRA','68',1),
('68207','207','CONCEPCION','68',1),
('68209','209','CONFINES','68',1),
('68211','211','CONTRATACION','68',1),
('68217','217','COROMORO','68',1),
('68229','229','CURITI','68',1),
('68235','235','EL CARMEN DE CHUCURI','68',1),
('68245','245','EL GUACAMAYO','68',1),
('68250','250','EL PEÑON','68',1),
('68255','255','EL PLAYON','68',1),
('68264','264','ENCINO','68',1),
('68266','266','ENCISO','68',1),
('68271','271','FLORIAN','68',1),
('68276','276','FLORIDABLANCA','68',1),
('68296','296','GALAN','68',1),
('68298','298','GAMBITA','68',1),
('68307','307','GIRON','68',1),
('68318','318','GUACA','68',1),
('68320','320','GUADALUPE','68',1),
('68322','322','GUAPOTA','68',1),
('68324','324','GUAVATA','68',1),
('68327','327','GsEPSA','68',1),
('68344','344','HATO','68',1),
('68368','368','JESUS MARIA','68',1),
('68370','370','JORDAN','68',1),
('68377','377','LA BELLEZA','68',1),
('68385','385','LANDAZURI','68',1),
('68397','397','LA PAZ','68',1),
('68406','406','LEBRIJA','68',1),
('68418','418','LOS SANTOS','68',1),
('68425','425','MACARAVITA','68',1),
('68432','432','MALAGA','68',1),
('68444','444','MATANZA','68',1),
('68464','464','MOGOTES','68',1),
('68468','468','MOLAGAVITA','68',1),
('68498','498','OCAMONTE','68',1),
('68500','500','OIBA','68',1),
('68502','502','ONZAGA','68',1),
('68522','522','PALMAR','68',1),
('68524','524','PALMAS DEL SOCORRO','68',1),
('68533','533','PARAMO','68',1),
('68547','547','PIEDECUESTA','68',1),
('68549','549','PINCHOTE','68',1),
('68572','572','PUENTE NACIONAL','68',1),
('68573','573','PUERTO PARRA','68',1),
('68575','575','PUERTO WILCHES','68',1),
('68615','615','RIONEGRO','68',1),
('68655','655','SABANA DE TORRES','68',1),
('68669','669','SAN ANDRES','68',1),
('68673','673','SAN BENITO','68',1),
('68679','679','SAN GIL','68',1),
('68682','682','SAN JOAQUIN','68',1),
('68684','684','SAN JOSE DE MIRANDA','68',1),
('68686','686','SAN MIGUEL','68',1),
('68689','689','SAN VICENTE DE CHUCURI','68',1),
('68705','705','SANTA BARBARA','68',1),
('68720','720','SANTA HELENA DEL OPON','68',1),
('68745','745','SIMACOTA','68',1),
('68755','755','SOCORRO','68',1),
('68770','770','SUAITA','68',1),
('68773','773','SUCRE','68',1),
('68780','780','SURATA','68',1),
('68820','820','TONA','68',1),
('68855','855','VALLE DE SAN JOSE','68',1),
('68861','861','VELEZ','68',1),
('68867','867','VETAS','68',1),
('68872','872','VILLANUEVA','68',1),
('68895','895','ZAPATOCA','68',1),
('70001','001','SINCELEJO','70',1),
('70110','110','BUENAVISTA','70',1),
('70124','124','CAIMITO','70',1),
('70204','204','COLOSO','70',1),
('70215','215','COROZAL','70',1),
('70221','221','COVEÑAS','70',1),
('70230','230','CHALAN','70',1),
('70233','233','EL ROBLE','70',1),
('70235','235','GALERAS','70',1),
('70265','265','GUARANDA','70',1),
('70400','400','LA UNION','70',1),
('70418','418','LOS PALMITOS','70',1),
('70429','429','MAJAGUAL','70',1),
('70473','473','MORROA','70',1),
('70508','508','OVEJAS','70',1),
('70523','523','PALMITO','70',1),
('70670','670','SAMPUES','70',1),
('70678','678','SAN BENITO ABAD','70',1),
('70702','702','SAN JUAN DE BETULIA','70',1),
('70708','708','SAN MARCOS','70',1),
('70713','713','SAN ONOFRE','70',1),
('70717','717','SAN PEDRO','70',1),
('70742','742','SAN LUIS DE SINCE','70',1),
('70771','771','SUCRE','70',1),
('70820','820','SANTIAGO DE TOLU','70',1),
('70823','823','TOLU VIEJO','70',1),
('73001','001','IBAGUE','73',1),
('73024','024','ALPUJARRA','73',1),
('73026','026','ALVARADO','73',1),
('73030','030','AMBALEMA','73',1),
('73043','043','ANZOATEGUI','73',1),
('73055','055','ARMERO','73',1),
('73067','067','ATACO','73',1),
('73124','124','CAJAMARCA','73',1),
('73148','148','CARMEN DE APICALA','73',1),
('73152','152','CASABIANCA','73',1),
('73168','168','CHAPARRAL','73',1),
('73200','200','COELLO','73',1),
('73217','217','COYAIMA','73',1),
('73226','226','CUNDAY','73',1),
('73236','236','DOLORES','73',1),
('73268','268','ESPINAL','73',1),
('73270','270','FALAN','73',1),
('73275','275','FLANDES','73',1),
('73283','283','FRESNO','73',1),
('73319','319','GUAMO','73',1),
('73347','347','HERVEO','73',1),
('73349','349','HONDA','73',1),
('73352','352','ICONONZO','73',1),
('73408','408','LERIDA','73',1),
('73411','411','LIBANO','73',1),
('73443','443','MARIQUITA','73',1),
('73449','449','MELGAR','73',1),
('73461','461','MURILLO','73',1),
('73483','483','NATAGAIMA','73',1),
('73504','504','ORTEGA','73',1),
('73520','520','PALOCABILDO','73',1),
('73547','547','PIEDRAS','73',1),
('73555','555','PLANADAS','73',1),
('73563','563','PRADO','73',1),
('73585','585','PURIFICACION','73',1),
('73616','616','RIOBLANCO','73',1),
('73622','622','RONCESVALLES','73',1),
('73624','624','ROVIRA','73',1),
('73671','671','SALDAÑA','73',1),
('73675','675','SAN ANTONIO','73',1),
('73678','678','SAN LUIS','73',1),
('73686','686','SANTA ISABEL','73',1),
('73770','770','SUAREZ','73',1),
('73854','854','VALLE DE SAN JUAN','73',1),
('73861','861','VENADILLO','73',1),
('73870','870','VILLAHERMOSA','73',1),
('73873','873','VILLARRICA','73',1),
('76001','001','CALI','76',1),
('76020','020','ALCALA','76',1),
('76036','036','ANDALUCIA','76',1),
('76041','041','ANSERMANUEVO','76',1),
('76054','054','ARGELIA','76',1),
('76100','100','BOLIVAR','76',1),
('76109','109','BUENAVENTURA','76',1),
('76111','111','GUADALAJARA DE BUGA','76',1),
('76113','113','BUGALAGRANDE','76',1),
('76122','122','CAICEDONIA','76',1),
('76126','126','CALIMA','76',1),
('76130','130','CANDELARIA','76',1),
('76147','147','CARTAGO','76',1),
('76233','233','DAGUA','76',1),
('76243','243','EL AGUILA','76',1),
('76246','246','EL CAIRO','76',1),
('76248','248','EL CERRITO','76',1),
('76250','250','EL DOVIO','76',1),
('76275','275','FLORIDA','76',1),
('76306','306','GINEBRA','76',1),
('76318','318','GUACARI','76',1),
('76364','364','JAMUNDI','76',1),
('76377','377','LA CUMBRE','76',1),
('76400','400','LA UNION','76',1),
('76403','403','LA VICTORIA','76',1),
('76497','497','OBANDO','76',1),
('76520','520','PALMIRA','76',1),
('76563','563','PRADERA','76',1),
('76606','606','RESTREPO','76',1),
('76616','616','RIOFRIO','76',1),
('76622','622','ROLDANILLO','76',1),
('76670','670','SAN PEDRO','76',1),
('76736','736','SEVILLA','76',1),
('76823','823','TORO','76',1),
('76828','828','TRUJILLO','76',1),
('76834','834','TULUA','76',1),
('76845','845','ULLOA','76',1),
('76863','863','VERSALLES','76',1),
('76869','869','VIJES','76',1),
('76890','890','YOTOCO','76',1),
('76892','892','YUMBO','76',1),
('76895','895','ZARZAL','76',1),
('81001','001','ARAUCA','81',1),
('81065','065','ARAUQUITA','81',1),
('81220','220','CRAVO NORTE','81',1),
('81300','300','FORTUL','81',1),
('81591','591','PUERTO RONDON','81',1),
('81736','736','SARAVENA','81',1),
('81794','794','TAME','81',1),
('85001','001','YOPAL','85',1),
('85010','010','AGUAZUL','85',1),
('85015','015','CHAMEZA','85',1),
('85125','125','HATO COROZAL','85',1),
('85136','136','LA SALINA','85',1),
('85139','139','MANI','85',1),
('85162','162','MONTERREY','85',1),
('85225','225','NUNCHIA','85',1),
('85230','230','OROCUE','85',1),
('85250','250','PAZ DE ARIPORO','85',1),
('85263','263','PORE','85',1),
('85279','279','RECETOR','85',1),
('85300','300','SABANALARGA','85',1),
('85315','315','SACAMA','85',1),
('85325','325','SAN LUIS DE PALENQUE','85',1),
('85400','400','TAMARA','85',1),
('85410','410','TAURAMENA','85',1),
('85430','430','TRINIDAD','85',1),
('85440','440','VILLANUEVA','85',1),
('86001','001','MOCOA','86',1),
('86219','219','COLON','86',1),
('86320','320','ORITO','86',1),
('86568','568','PUERTO ASIS','86',1),
('86569','569','PUERTO CAICEDO','86',1),
('86571','571','PUERTO GUZMAN','86',1),
('86573','573','LEGUIZAMO','86',1),
('86749','749','SIBUNDOY','86',1),
('86755','755','SAN FRANCISCO','86',1),
('86757','757','SAN MIGUEL','86',1),
('86760','760','SANTIAGO','86',1),
('86865','865','VALLE DEL GUAMUEZ','86',1),
('86885','885','VILLAGARZON','86',1),
('88001','001','SAN ANDRES','88',1),
('88564','564','PROVIDENCIA','88',1),
('91001','001','LETICIA','91',1),
('91263','263','EL ENCANTO','91',1),
('91405','405','LA CHORRERA','91',1),
('91407','407','LA PEDRERA','91',1),
('91430','430','LA VICTORIA','91',1),
('91460','460','MIRITI - PARANA','91',1),
('91530','530','PUERTO ALEGRIA','91',1),
('91536','536','PUERTO ARICA','91',1),
('91540','540','PUERTO NARIÑO','91',1),
('91669','669','PUERTO SANTANDER','91',1),
('91798','798','TARAPACA','91',1),
('94001','001','INIRIDA','94',1),
('94343','343','BARRANCO MINAS','94',1),
('94663','663','MAPIRIPANA','94',1),
('94883','883','SAN FELIPE','94',1),
('94884','884','PUERTO COLOMBIA','94',1),
('94885','885','LA GUADALUPE','94',1),
('94886','886','CACAHUAL','94',1),
('94887','887','PANA PANA','94',1),
('94888','888','MORICHAL','94',1),
('95001','001','SAN JOSE DEL GUAVIARE','95',1),
('95015','015','CALAMAR','95',1),
('95025','025','EL RETORNO','95',1),
('95200','200','MIRAFLORES','95',1),
('97001','001','MITU','97',1),
('97161','161','CARURU','97',1),
('97511','511','PACOA','97',1),
('97666','666','TARAIRA','97',1),
('97777','777','PAPUNAUA','97',1),
('97889','889','YAVARATE','97',1),
('99001','001','PUERTO CARREÑO','99',1),
('99524','524','LA PRIMAVERA','99',1),
('99624','624','SANTA ROSALIA','99',1),
('99773','773','CUMARIBO','99',1);

/*Table structure for table `notacredito` */

DROP TABLE IF EXISTS `notacredito`;

CREATE TABLE `notacredito` (
  `idnotacredito` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `fechapago` date DEFAULT NULL,
  `idconceptonota` int(11) NOT NULL,
  `valor` double DEFAULT '0',
  `iva` double DEFAULT NULL,
  `reteiva` double DEFAULT NULL,
  `retefuente` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `numero` int(11) DEFAULT '0',
  `autorizado` tinyint(1) DEFAULT '0',
  `anulado` tinyint(1) DEFAULT '0',
  `usuariosistema` char(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observacion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idnotacredito`),
  KEY `idcliente` (`idcliente`),
  KEY `idconceptonota` (`idconceptonota`),
  CONSTRAINT `notacredito_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `notacredito_ibfk_2` FOREIGN KEY (`idconceptonota`) REFERENCES `conceptonota` (`idconceptonota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `notacredito` */

/*Table structure for table `notacreditodetalle` */

DROP TABLE IF EXISTS `notacreditodetalle`;

CREATE TABLE `notacreditodetalle` (
  `iddetallenota` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `idfactura` int(15) DEFAULT NULL,
  `nrofactura` int(11) DEFAULT '0',
  `valor` double DEFAULT '0',
  `usuariosistema` char(50) COLLATE utf8_spanish_ci DEFAULT '0',
  `idnotacredito` int(11) NOT NULL,
  PRIMARY KEY (`iddetallenota`),
  KEY `idfactura` (`idfactura`),
  KEY `idnotacredito` (`idnotacredito`),
  CONSTRAINT `notacreditodetalle_ibfk_1` FOREIGN KEY (`idfactura`) REFERENCES `facturaventa` (`idfactura`),
  CONSTRAINT `notacreditodetalle_ibfk_2` FOREIGN KEY (`idnotacredito`) REFERENCES `notacredito` (`idnotacredito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `notacreditodetalle` */

/*Table structure for table `ordenproduccion` */

DROP TABLE IF EXISTS `ordenproduccion`;

CREATE TABLE `ordenproduccion` (
  `idordenproduccion` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `codigoproducto` varchar(25) NOT NULL,
  `fechallegada` datetime NOT NULL,
  `fechaprocesada` datetime NOT NULL,
  `fechaentrega` datetime NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `totalorden` double DEFAULT '0',
  `valorletras` longtext,
  `observacion` longtext NOT NULL,
  `estado` tinyint(1) DEFAULT '0',
  `ordenproduccion` char(25) DEFAULT NULL,
  `idtipo` int(15) NOT NULL,
  `usuariosistema` varchar(50) DEFAULT NULL,
  `autorizado` tinyint(1) DEFAULT '0',
  `facturado` tinyint(1) DEFAULT '0',
  `proceso_control` tinyint(1) DEFAULT '0',
  `porcentaje_proceso` float DEFAULT '0',
  `ponderacion` int(11) DEFAULT '0',
  `porcentaje_cantidad` float DEFAULT '0',
  `ordenproduccionext` char(25) DEFAULT NULL,
  `segundosficha` float DEFAULT '0',
  `duracion` float DEFAULT NULL,
  PRIMARY KEY (`idordenproduccion`),
  KEY `idcliente` (`idcliente`),
  KEY `idtipo` (`idtipo`),
  CONSTRAINT `ordenproduccion_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `ordenproduccion_ibfk_2` FOREIGN KEY (`idtipo`) REFERENCES `ordenproducciontipo` (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `ordenproduccion` */

insert  into `ordenproduccion`(`idordenproduccion`,`idcliente`,`codigoproducto`,`fechallegada`,`fechaprocesada`,`fechaentrega`,`cantidad`,`totalorden`,`valorletras`,`observacion`,`estado`,`ordenproduccion`,`idtipo`,`usuariosistema`,`autorizado`,`facturado`,`proceso_control`,`porcentaje_proceso`,`ponderacion`,`porcentaje_cantidad`,`ordenproduccionext`,`segundosficha`,`duracion`) values 
(1,1,'','2018-12-11 00:00:00','2018-12-11 00:00:00','2018-12-22 00:00:00',1972,16813785,NULL,'este lote fue recogido en un cliente, y no lleva lavandería',0,'12679',1,'71268830',1,1,0,0,0,0,'11091',0,NULL),
(2,1,'','2018-12-21 00:00:00','2018-12-21 00:00:00','2018-12-22 00:00:00',1972,1015101,NULL,'Lote recogido en el cliente',0,'12679',2,'71268830',1,1,0,0,0,0,'12517',0,NULL),
(3,1,'','2018-12-13 00:00:00','2018-12-26 00:00:00','2019-01-08 00:00:00',1971,9556039,NULL,'este lote lleva lavanderia',0,'12676',1,'71268830',1,1,0,0,0,30.1877,'10676',2944,NULL),
(4,1,'','2019-01-03 00:00:00','2019-01-03 00:00:00','2019-01-09 00:00:00',1970,2662338.559,NULL,'Esta prenda llevo lavanderia',0,'12676',2,'71268830',1,1,0,0,0,0,'12902',0,NULL),
(5,1,'','2018-12-27 00:00:00','2019-01-03 00:00:00','2019-01-11 00:00:00',1293,10481679,NULL,'Esta referencia no lleva lavanderia',0,'13980',1,'ADMINISTRADOR',1,1,0,11.092,0,11.092,'12233',5830,NULL),
(6,1,'','2019-01-11 00:00:00','2019-01-14 00:00:00','2019-01-19 00:00:00',992,5632774,NULL,'Esta orden de produccion no lleva lavanderia',0,'14341',1,'ADMINISTRADOR',1,1,0,36.996,0,0,'12971',2688,NULL),
(7,1,'','2018-12-28 00:00:00','2019-01-09 00:00:00','2019-01-19 00:00:00',1184,11280039,NULL,'ESTA PRENDA NO MANEJA LAVANDERIA',0,'14201',1,'ADMINISTRADOR',1,1,0,12.6113,0,12.6113,'12696',6100,NULL),
(8,1,'','2019-01-09 00:00:00','2019-01-09 00:00:00','2019-01-14 00:00:00',1292,1092820,NULL,'la talla m vino incompleta',0,'13980',2,'ADMINISTRADOR',1,1,0,0,0,0,'13031',0,NULL),
(9,1,'','2019-01-17 00:00:00','2019-01-23 00:00:00','2019-01-29 00:00:00',1130,10915687,NULL,'esta prenda no lleva lavanderia',0,'14634',1,'facturacion',1,1,0,8.73155,0,8.73155,'13223',600,NULL),
(10,1,'','2019-01-17 00:00:00','2019-01-23 00:00:00','2019-01-29 00:00:00',1171,8482958,NULL,'no lleva lavanderia',0,'14633',1,'facturacion',1,1,0,0,0,0,'13224',0,NULL),
(11,1,'','2019-01-19 00:00:00','2019-01-19 00:00:00','2019-01-19 00:00:00',1184,1059438.6464,NULL,'proceso de terminacion',0,'14201',2,'ADMINISTRADOR',1,1,0,0,0,0,'13340',0,NULL),
(12,1,'','2019-01-21 00:00:00','2019-01-21 00:00:00','2019-01-24 00:00:00',992,515497,NULL,'Terminacion de prenda',0,'14341',2,'ADMINISTRADOR',1,1,0,0,0,0,'13468',0,NULL),
(13,1,'220','2019-01-29 00:00:00','2019-02-05 00:00:00','2019-02-09 00:00:00',1090,8215439,NULL,'esta prenda lleva lavanderia',0,'14962',1,'ADMINISTRADOR',1,0,0,6.2103,0,6.2103,'13659',650,29.42),
(14,1,'527','2019-01-24 00:00:00','2019-01-24 00:00:00','2019-01-29 00:00:00',1131,693125.381,NULL,'terminacion',0,'14633',2,'ADMINISTRADOR',1,0,0,0,0,0,'13695',60,2.6);

/*Table structure for table `ordenproducciondetalle` */

DROP TABLE IF EXISTS `ordenproducciondetalle`;

CREATE TABLE `ordenproducciondetalle` (
  `iddetalleorden` int(11) NOT NULL AUTO_INCREMENT,
  `idproductodetalle` int(11) NOT NULL,
  `codigoproducto` char(15) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `vlrprecio` double NOT NULL,
  `subtotal` double DEFAULT NULL,
  `idordenproduccion` int(11) NOT NULL,
  `generado` tinyint(1) DEFAULT NULL,
  `facturado` tinyint(1) DEFAULT NULL,
  `porcentaje_proceso` float DEFAULT '0',
  `ponderacion` int(11) DEFAULT '0',
  `porcentaje_cantidad` float DEFAULT '0',
  `cantidad_efectiva` int(11) DEFAULT '0',
  `cantidad_operada` int(11) DEFAULT '0',
  `totalsegundos` float DEFAULT NULL,
  `segundosficha` float DEFAULT '0',
  PRIMARY KEY (`iddetalleorden`),
  KEY `idproductodetalle` (`idproductodetalle`),
  CONSTRAINT `ordenproducciondetalle_ibfk_1` FOREIGN KEY (`idproductodetalle`) REFERENCES `productodetalle` (`idproductodetalle`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

/*Data for the table `ordenproducciondetalle` */

insert  into `ordenproducciondetalle`(`iddetalleorden`,`idproductodetalle`,`codigoproducto`,`cantidad`,`vlrprecio`,`subtotal`,`idordenproduccion`,`generado`,`facturado`,`porcentaje_proceso`,`ponderacion`,`porcentaje_cantidad`,`cantidad_efectiva`,`cantidad_operada`,`totalsegundos`,`segundosficha`) values 
(1,1,'108',459,8526.26,3913553.34,1,NULL,NULL,0,0,0,0,0,NULL,0),
(2,2,'108',611,8526.26,5209544.86,1,NULL,NULL,0,0,0,0,0,NULL,0),
(3,3,'108',510,8526.26,4348392.6,1,NULL,NULL,0,0,0,0,0,NULL,0),
(4,4,'108',240,8526.26,2046302.4,1,NULL,NULL,0,0,0,0,0,NULL,0),
(5,5,'108',152,8526.26,1295991.52,1,NULL,NULL,0,0,0,0,0,NULL,0),
(11,1,'108',459,514.757,236273.463,2,NULL,NULL,0,0,0,0,0,NULL,0),
(12,2,'108',611,514.757,314516.527,2,NULL,NULL,0,0,0,0,0,NULL,0),
(13,3,'108',510,514.757,262526.07,2,NULL,NULL,0,0,0,0,0,NULL,0),
(14,4,'108',240,514.757,123541.68,2,NULL,NULL,0,0,0,0,0,NULL,0),
(15,5,'108',152,514.757,78243.064,2,NULL,NULL,0,0,0,0,0,NULL,0),
(20,11,'133',227,4848.32,1100568.64,3,NULL,NULL,100,0,0,3178,0,0,736),
(21,12,'133',511,4848.32,2477491.52,3,NULL,NULL,100,0,0,7154,0,0,736),
(22,13,'133',638,4848.32,3093228.16,3,NULL,NULL,100,0,0,8932,0,0,736),
(23,14,'133',595,4848.32,2884750.4,3,NULL,NULL,0,0,1400,0,8330,437920,736),
(24,11,'133',227,1351.441,306777.107,4,NULL,NULL,0,0,0,0,0,NULL,0),
(25,12,'133',511,1351.441,690586.351,4,NULL,NULL,0,0,0,0,0,NULL,0),
(26,13,'133',638,1351.44,862218.72,4,NULL,NULL,0,0,0,0,0,NULL,0),
(27,14,'133',594,1351.441,802755.954,4,NULL,NULL,0,0,0,0,0,NULL,0),
(28,19,'536',393,8106.48,3185846.64,5,NULL,NULL,0,0,0,0,0,0,1262),
(29,23,'536',393,8106.48,3185846.64,5,NULL,NULL,0,0,0,0,0,0,1142),
(30,22,'536',125,8106.48,1013310,5,NULL,NULL,0,0,0,0,0,0,1142),
(31,21,'536',234,8106.48,1896916.32,5,NULL,NULL,0,0,0,0,0,0,1142),
(32,20,'536',148,8106.48,1199759.04,5,NULL,NULL,100,0,100,2812,148,169016,1142),
(33,26,'147',285,5678.2,1618287,6,NULL,NULL,0,0,0,0,0,0,672),
(34,25,'147',367,5678.2,2083899.4,6,NULL,NULL,100,0,0,4771,0,0,672),
(35,27,'147',246,5678.2,1396837.2,6,NULL,NULL,100,0,0,3198,0,0,672),
(36,24,'147',94,5678.2,533750.8,6,NULL,NULL,100,0,0,1222,0,0,672),
(37,31,'271',141,9527.06,1343315.46,7,NULL,NULL,40.9016,0,0,1128,0,161927,1220),
(38,29,'271',313,9527.06,2981969.78,7,NULL,NULL,100,0,0,6886,0,445300,1220),
(39,29,'271',92,9527.06,876489.52,7,NULL,NULL,0,0,0,0,0,0,1220),
(40,30,'271',365,9527.06,3477376.9,7,NULL,NULL,0,0,0,0,0,0,1220),
(41,32,'271',273,9527.06,2600887.38,7,NULL,NULL,0,0,0,0,0,0,1220),
(42,20,'536',148,845.836,125183.728,8,NULL,NULL,0,0,0,0,0,NULL,0),
(43,21,'536',234,845.836,197925.624,8,NULL,NULL,0,0,0,0,0,NULL,0),
(44,22,'536',125,845.836,105729.5,8,NULL,NULL,0,0,0,0,0,NULL,0),
(45,23,'536',393,845.836,332413.548,8,NULL,NULL,0,0,0,0,0,NULL,0),
(46,19,'536',392,845.836,331567.712,8,NULL,NULL,0,0,0,0,0,NULL,0),
(47,38,'227',296,9659.9,2859330.4,9,NULL,NULL,33.3333,0,33.3333,296,296,59200,600),
(48,39,'227',296,9659.9,2859330.4,9,NULL,NULL,0,0,0,0,0,0,600),
(49,40,'227',538,9659.9,5197026.2,9,NULL,NULL,0,0,0,0,0,0,600),
(50,44,'527',96,7244.2,695443.2,10,NULL,NULL,0,0,0,0,0,NULL,0),
(51,45,'527',363,7244.2,2629644.6,10,NULL,NULL,0,0,0,0,0,NULL,0),
(52,46,'527',267,7244.2,1934201.4,10,NULL,NULL,0,0,0,0,0,NULL,0),
(53,47,'527',305,7244.2,2209481,10,NULL,NULL,0,0,0,0,0,NULL,0),
(54,48,'527',140,7244.2,1014188,10,NULL,NULL,0,0,0,0,0,NULL,0),
(55,31,'271',141,894.796,126166.236,11,NULL,NULL,0,0,0,0,0,NULL,0),
(56,28,'271',313,894.7968,280071.3984,11,NULL,NULL,0,0,0,0,0,NULL,0),
(57,29,'271',365,894.796,326600.54,11,NULL,NULL,0,0,0,0,0,NULL,0),
(58,30,'271',92,894.7968,82321.3056,11,NULL,NULL,0,0,0,0,0,NULL,0),
(59,32,'271',273,894.7968,244279.5264,11,NULL,NULL,0,0,0,0,0,NULL,0),
(60,26,'147',285,519.654,148101.39,12,NULL,NULL,0,0,0,0,0,NULL,0),
(61,25,'147',367,519.654,190713.018,12,NULL,NULL,0,0,0,0,0,NULL,0),
(62,27,'147',246,519.654,127834.884,12,NULL,NULL,0,0,0,0,0,NULL,0),
(63,24,'147',94,519.654,48847.476,12,NULL,NULL,0,0,0,0,0,NULL,0),
(64,49,'220',440,7537.1,3316324,13,NULL,NULL,15.3846,0,15.3846,440,440,71500,650),
(65,50,'220',423,7537.1,3188193.3,13,NULL,NULL,0,0,0,0,0,0,650),
(66,51,'220',227,7537.1,1710921.7,13,NULL,NULL,0,0,0,0,0,0,650),
(74,46,'527',96,612.843,58832.928,14,NULL,NULL,0,0,0,0,0,0,60),
(75,47,'527',363,612.843,222462.009,14,NULL,NULL,0,0,0,0,0,0,60),
(76,48,'527',305,612.843,186917.115,14,NULL,NULL,0,0,0,0,0,0,60),
(78,44,'527',100,612.843,61284.3,14,NULL,NULL,0,0,0,0,0,0,60),
(79,45,'527',267,612.843,163629.081,14,NULL,NULL,0,0,0,0,0,0,60);

/*Table structure for table `ordenproducciondetalleproceso` */

DROP TABLE IF EXISTS `ordenproducciondetalleproceso`;

CREATE TABLE `ordenproducciondetalleproceso` (
  `iddetalleproceso` int(11) NOT NULL AUTO_INCREMENT,
  `proceso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `duracion` int(15) DEFAULT '0',
  `ponderacion` int(11) DEFAULT '0',
  `total` float DEFAULT '0',
  `totalproceso` float DEFAULT NULL,
  `porcentajeproceso` float DEFAULT NULL,
  `idproceso` int(11) NOT NULL,
  `estado` tinyint(1) DEFAULT '0',
  `iddetalleorden` int(11) NOT NULL,
  `cantidad_operada` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleproceso`),
  KEY `idproceso` (`idproceso`),
  KEY `iddetalleorden` (`iddetalleorden`),
  CONSTRAINT `ordenproducciondetalleproceso_ibfk_1` FOREIGN KEY (`idproceso`) REFERENCES `proceso_produccion` (`idproceso`),
  CONSTRAINT `ordenproducciondetalleproceso_ibfk_2` FOREIGN KEY (`iddetalleorden`) REFERENCES `ordenproducciondetalle` (`iddetalleorden`)
) ENGINE=InnoDB AUTO_INCREMENT=387 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `ordenproducciondetalleproceso` */

insert  into `ordenproducciondetalleproceso`(`iddetalleproceso`,`proceso`,`duracion`,`ponderacion`,`total`,`totalproceso`,`porcentajeproceso`,`idproceso`,`estado`,`iddetalleorden`,`cantidad_operada`) values 
(1,'ENRESORTAR ESPALDA',72,0,72,16344,9.78261,1,1,20,0),
(2,'ARMAR TIRA LIBRE',37,0,37,8399,5.02717,2,1,20,0),
(3,'ASENTAR TIRA LIBRE',51,0,51,11577,6.92935,3,1,20,0),
(4,'SESGAR ESPALDA',16,0,16,3632,2.17391,14,1,20,0),
(5,'SESGAR FRENTE X 2',23,0,23,5221,3.125,15,1,20,0),
(6,'SESGAR SISAS X 2',32,0,32,7264,4.34783,16,1,20,0),
(7,'ASENTAR PERILLA',83,0,83,18841,11.2772,17,1,20,0),
(8,'CERRAR COSTADOS X 2',54,0,54,12258,7.33696,18,1,20,0),
(9,'MONTAR TIRAS A HOMBRO X 4',68,0,68,15436,9.23913,19,1,20,0),
(10,'ASENTAR COMPLETO',115,0,115,26105,15.625,20,1,20,0),
(11,'PINZA ESPALDA',10,0,10,2270,1.3587,21,1,20,0),
(12,'MARQUILLA ESPALDA',17,0,17,3859,2.30978,22,1,20,0),
(13,'RUEDO BAJO',100,0,100,22700,13.587,23,1,20,0),
(14,'OJAL X 8',58,0,58,13166,7.88043,24,1,20,0),
(15,'ENRESORTAR ESPALDA',72,0,72,36792,9.78261,1,1,21,0),
(16,'ARMAR TIRA LIBRE',37,0,37,18907,5.02717,2,1,21,0),
(17,'ASENTAR TIRA LIBRE',51,0,51,26061,6.92935,3,1,21,0),
(18,'SESGAR ESPALDA',16,0,16,8176,2.17391,14,1,21,0),
(19,'SESGAR FRENTE X 2',23,0,23,11753,3.125,15,1,21,0),
(20,'SESGAR SISAS X 2',32,0,32,16352,4.34783,16,1,21,0),
(21,'ASENTAR PERILLA',83,0,83,42413,11.2772,17,1,21,0),
(22,'CERRAR COSTADOS X 2',54,0,54,27594,7.33696,18,1,21,0),
(23,'MONTAR TIRAS A HOMBRO X 4',68,0,68,34748,9.23913,19,1,21,0),
(24,'ASENTAR COMPLETO',115,0,115,58765,15.625,20,1,21,0),
(25,'PINZA ESPALDA',10,0,10,5110,1.3587,21,1,21,0),
(26,'MARQUILLA ESPALDA',17,0,17,8687,2.30978,22,1,21,0),
(27,'RUEDO BAJO',100,0,100,51100,13.587,23,1,21,0),
(28,'OJAL X 8',58,0,58,29638,7.88043,24,1,21,0),
(29,'ENRESORTAR ESPALDA',72,0,72,45936,9.78261,1,1,22,0),
(30,'ARMAR TIRA LIBRE',37,0,37,23606,5.02717,2,1,22,0),
(31,'ASENTAR TIRA LIBRE',51,0,51,32538,6.92935,3,1,22,0),
(32,'SESGAR ESPALDA',16,0,16,10208,2.17391,14,1,22,0),
(33,'SESGAR FRENTE X 2',23,0,23,14674,3.125,15,1,22,0),
(34,'SESGAR SISAS X 2',32,0,32,20416,4.34783,16,1,22,0),
(35,'ASENTAR PERILLA',83,0,83,52954,11.2772,17,1,22,0),
(36,'CERRAR COSTADOS X 2',54,0,54,34452,7.33696,18,1,22,0),
(37,'MONTAR TIRAS A HOMBRO X 4',68,0,68,43384,9.23913,19,1,22,0),
(38,'ASENTAR COMPLETO',115,0,115,73370,15.625,20,1,22,0),
(39,'PINZA ESPALDA',10,0,10,6380,1.3587,21,1,22,0),
(40,'MARQUILLA ESPALDA',17,0,17,10846,2.30978,22,1,22,0),
(41,'RUEDO BAJO',100,0,100,63800,13.587,23,1,22,0),
(42,'OJAL X 8',58,0,58,37004,7.88043,24,1,22,0),
(43,'ENRESORTAR ESPALDA',72,0,72,42840,9.78261,1,0,23,595),
(44,'ARMAR TIRA LIBRE',37,0,37,22015,5.02717,2,0,23,595),
(45,'ASENTAR TIRA LIBRE',51,0,51,30345,6.92935,3,0,23,595),
(46,'SESGAR ESPALDA',16,0,16,9520,2.17391,14,0,23,595),
(47,'SESGAR FRENTE X 2',23,0,23,13685,3.125,15,0,23,595),
(48,'SESGAR SISAS X 2',32,0,32,19040,4.34783,16,0,23,595),
(49,'ASENTAR PERILLA',83,0,83,49385,11.2772,17,0,23,595),
(50,'CERRAR COSTADOS X 2',54,0,54,32130,7.33696,18,0,23,595),
(51,'MONTAR TIRAS A HOMBRO X 4',68,0,68,40460,9.23913,19,0,23,595),
(52,'ASENTAR COMPLETO',115,0,115,68425,15.625,20,0,23,595),
(53,'PINZA ESPALDA',10,0,10,5950,1.3587,21,0,23,595),
(54,'MARQUILLA ESPALDA',17,0,17,10115,2.30978,22,0,23,595),
(55,'RUEDO BAJO',100,0,100,59500,13.587,23,0,23,595),
(56,'OJAL X 8',58,0,58,34510,7.88043,24,0,23,595),
(57,'ASENTAR COMPLETO',60,0,60,23580,4.75436,20,0,28,0),
(58,'PREPARAR BANDA CUELLO',41,0,41,16113,3.24881,25,0,28,0),
(59,'ARMAR CUELLO',50,0,50,19650,3.96197,27,0,28,0),
(60,'ASENTAR COMPLETO',60,0,60,23580,5.25394,20,0,29,0),
(61,'PREPARAR BANDA CUELLO',41,0,41,16113,3.59019,25,0,29,0),
(62,'ARMAR CUELLO',50,0,50,19650,4.37828,27,0,29,0),
(63,'ASENTAR COMPLETO',60,0,60,7500,5.25394,20,0,30,0),
(64,'PREPARAR BANDA CUELLO',41,0,41,5125,3.59019,25,0,30,0),
(65,'ARMAR CUELLO',50,0,50,6250,4.37828,27,0,30,0),
(66,'ASENTAR COMPLETO',60,0,60,14040,5.25394,20,0,31,0),
(67,'PREPARAR BANDA CUELLO',41,0,41,9594,3.59019,25,0,31,0),
(68,'ARMAR CUELLO',50,0,50,11700,4.37828,27,0,31,0),
(69,'ASENTAR COMPLETO',60,0,60,8880,5.25394,20,1,32,148),
(70,'PREPARAR BANDA CUELLO',41,0,41,6068,3.59019,25,1,32,148),
(71,'ARMAR CUELLO',50,0,50,7400,4.37828,27,1,32,148),
(72,'ARMAR PUÑO POR 2',58,0,58,22794,4.59588,12,0,28,0),
(73,'PREPARAR BANDA PUñO',30,0,30,11790,2.37718,28,0,28,0),
(74,'ARMAR PUÑO POR 2',58,0,58,22794,5.07881,12,0,29,0),
(75,'PREPARAR BANDA PUñO',30,0,30,11790,2.62697,28,0,29,0),
(76,'ARMAR PUÑO POR 2',58,0,58,7250,5.07881,12,0,30,0),
(77,'PREPARAR BANDA PUñO',30,0,30,3750,2.62697,28,0,30,0),
(78,'ARMAR PUÑO POR 2',58,0,58,13572,5.07881,12,0,31,0),
(79,'PREPARAR BANDA PUñO',30,0,30,7020,2.62697,28,0,31,0),
(80,'ARMAR PUÑO POR 2',58,0,58,8584,5.07881,12,1,32,148),
(81,'PREPARAR BANDA PUñO',30,0,30,4440,2.62697,28,1,32,148),
(82,'MONTAR MANGAS POR 2',87,0,87,34191,6.89382,7,0,28,0),
(83,'CERRAR COSTADOS X 2',82,0,82,32226,6.49762,18,0,28,0),
(84,'ACENTAR PUñO',170,0,170,66810,13.4707,29,0,28,0),
(85,'MONTAR MANGAS POR 2',87,0,87,34191,7.61821,7,0,29,0),
(86,'CERRAR COSTADOS X 2',82,0,82,32226,7.18039,18,0,29,0),
(87,'ACENTAR PUñO',50,0,50,19650,4.37828,29,0,29,0),
(88,'MONTAR MANGAS POR 2',87,0,87,10875,7.61821,7,0,30,0),
(89,'CERRAR COSTADOS X 2',82,0,82,10250,7.18039,18,0,30,0),
(90,'ACENTAR PUñO',50,0,50,6250,4.37828,29,0,30,0),
(91,'MONTAR MANGAS POR 2',87,0,87,20358,7.61821,7,0,31,0),
(92,'CERRAR COSTADOS X 2',82,0,82,19188,7.18039,18,0,31,0),
(93,'ACENTAR PUñO',50,0,50,11700,4.37828,29,0,31,0),
(94,'MONTAR MANGAS POR 2',87,0,87,12876,7.61821,7,1,32,148),
(95,'CERRAR COSTADOS X 2',82,0,82,12136,7.18039,18,1,32,148),
(96,'ACENTAR PUñO',50,0,50,7400,4.37828,29,1,32,148),
(97,'MONTAR CUELLO A CUERPO',75,0,75,29475,5.94295,30,0,28,0),
(98,'ACENTAR CUELLO A CUERPO',63,0,63,24759,4.99208,31,0,28,0),
(99,'MONTAR CUELLO A CUERPO',75,0,75,29475,6.56743,30,0,29,0),
(100,'ACENTAR CUELLO A CUERPO',63,0,63,24759,5.51664,31,0,29,0),
(101,'MONTAR CUELLO A CUERPO',75,0,75,9375,6.56743,30,0,30,0),
(102,'ACENTAR CUELLO A CUERPO',63,0,63,7875,5.51664,31,0,30,0),
(103,'MONTAR CUELLO A CUERPO',75,0,75,17550,6.56743,30,0,31,0),
(104,'ACENTAR CUELLO A CUERPO',63,0,63,14742,5.51664,31,0,31,0),
(105,'MONTAR CUELLO A CUERPO',75,0,75,11100,6.56743,30,1,32,148),
(106,'ACENTAR CUELLO A CUERPO',63,0,63,9324,5.51664,31,1,32,148),
(107,'SESGAR FRENTE X 2',36,0,36,14148,2.85261,15,0,28,0),
(108,'MARQUILLA ESPALDA',13,0,13,5109,1.03011,22,0,28,0),
(109,'RUEDO BAJO',182,0,182,71526,14.4216,23,0,28,0),
(110,'PUNTEAR X4',25,0,25,9825,1.98098,26,0,28,0),
(111,'SESGAR MANGA X 2',34,0,34,13362,2.69414,32,0,28,0),
(112,'PINZA A PUñO',30,0,30,11790,2.37718,33,0,28,0),
(113,'BOTON X 4',56,0,56,22008,4.4374,34,0,28,0),
(114,'OJAL X 4',45,0,45,17685,3.56577,35,0,28,0),
(115,'MONTAR PUñO X 2',125,0,125,49125,9.90491,36,0,28,0),
(116,'SESGAR FRENTE X 2',36,0,36,14148,3.15236,15,0,29,0),
(117,'MARQUILLA ESPALDA',13,0,13,5109,1.13835,22,0,29,0),
(118,'RUEDO BAJO',182,0,182,71526,15.937,23,0,29,0),
(119,'PUNTEAR X4',25,0,25,9825,2.18914,26,0,29,0),
(120,'SESGAR MANGA X 2',34,0,34,13362,2.97723,32,0,29,0),
(121,'PINZA A PUñO',30,0,30,11790,2.62697,33,0,29,0),
(122,'BOTON X 4',56,0,56,22008,4.90368,34,0,29,0),
(123,'OJAL X 4',45,0,45,17685,3.94046,35,0,29,0),
(124,'MONTAR PUñO X 2',125,0,125,49125,10.9457,36,0,29,0),
(125,'SESGAR FRENTE X 2',36,0,36,4500,3.15236,15,0,30,0),
(126,'MARQUILLA ESPALDA',13,0,13,1625,1.13835,22,0,30,0),
(127,'RUEDO BAJO',182,0,182,22750,15.937,23,0,30,0),
(128,'PUNTEAR X4',25,0,25,3125,2.18914,26,0,30,0),
(129,'SESGAR MANGA X 2',34,0,34,4250,2.97723,32,0,30,0),
(130,'PINZA A PUñO',30,0,30,3750,2.62697,33,0,30,0),
(131,'BOTON X 4',56,0,56,7000,4.90368,34,0,30,0),
(132,'OJAL X 4',45,0,45,5625,3.94046,35,0,30,0),
(133,'MONTAR PUñO X 2',125,0,125,15625,10.9457,36,0,30,0),
(134,'SESGAR FRENTE X 2',36,0,36,8424,3.15236,15,0,31,0),
(135,'MARQUILLA ESPALDA',13,0,13,3042,1.13835,22,0,31,0),
(136,'RUEDO BAJO',182,0,182,42588,15.937,23,0,31,0),
(137,'PUNTEAR X4',25,0,25,5850,2.18914,26,0,31,0),
(138,'SESGAR MANGA X 2',34,0,34,7956,2.97723,32,0,31,0),
(139,'PINZA A PUñO',30,0,30,7020,2.62697,33,0,31,0),
(140,'BOTON X 4',56,0,56,13104,4.90368,34,0,31,0),
(141,'OJAL X 4',45,0,45,10530,3.94046,35,0,31,0),
(142,'MONTAR PUñO X 2',125,0,125,29250,10.9457,36,0,31,0),
(143,'SESGAR FRENTE X 2',36,0,36,5328,3.15236,15,1,32,0),
(144,'MARQUILLA ESPALDA',13,0,13,1924,1.13835,22,1,32,148),
(145,'RUEDO BAJO',182,0,182,26936,15.937,23,1,32,0),
(146,'PUNTEAR X4',25,0,25,3700,2.18914,26,1,32,0),
(147,'SESGAR MANGA X 2',34,0,34,5032,2.97723,32,1,32,0),
(148,'PINZA A PUñO',30,0,30,4440,2.62697,33,1,32,148),
(149,'BOTON X 4',56,0,56,8288,4.90368,34,1,32,148),
(150,'OJAL X 4',45,0,45,6660,3.94046,35,1,32,148),
(151,'MONTAR PUñO X 2',125,0,125,18500,10.9457,36,1,32,148),
(152,'ACENTAR PUñO',50,0,50,18250,4.09836,29,1,37,0),
(153,'ARMAR CUELLO',50,0,50,18250,4.09836,27,1,37,0),
(154,'ARMAR PERILLA A FRENTE DOBLE',71,0,71,25915,5.81967,39,1,37,0),
(155,'ARMAR PERILLA A FRENTE SEGUNDA PARTE',62,0,62,22630,5.08197,40,1,37,0),
(156,'ARMAR PUÑO POR 2',58,0,58,21170,4.7541,12,1,37,0),
(157,'BOTON X 9',47,0,47,17155,3.85246,42,0,37,0),
(158,'CERRAR COSTADOS X 2',64,0,64,23360,5.2459,18,0,37,0),
(159,'MARQUILLA ESPALDA',13,0,13,4745,1.06557,22,0,37,0),
(160,'MONTAR CUELLO A CUERPO',60,0,60,21900,4.91803,30,0,37,0),
(161,'MONTAR MANGAS POR 2',57,0,57,20805,4.67213,7,0,37,0),
(162,'OJAL X 9',58,0,58,21170,4.7541,41,0,37,0),
(163,'PREPARAR BANDA CUELLO',41,0,41,14965,3.36066,25,0,37,0),
(164,'PREPARAR BANDA PUñO',30,0,30,10950,2.45902,28,0,37,0),
(165,'RUEDO BAJO',82,0,82,29930,6.72131,23,0,37,0),
(166,'RUEDO BOLSILLO',20,0,20,7300,1.63934,37,0,37,0),
(167,'SESGAR MANGA X 2',34,0,34,12410,2.78689,32,0,37,0),
(168,'UNIR HOMBROS POR 2',25,0,25,9125,2.04918,6,0,37,0),
(169,'ACENTAR PUñO',50,0,50,18250,4.09836,29,1,38,0),
(170,'ARMAR CUELLO',50,0,50,18250,4.09836,27,1,38,0),
(171,'ARMAR PERILLA A FRENTE DOBLE',71,0,71,25915,5.81967,39,1,38,0),
(172,'ARMAR PERILLA A FRENTE SEGUNDA PARTE',62,0,62,22630,5.08197,40,1,38,0),
(173,'ARMAR PUÑO POR 2',58,0,58,21170,4.7541,12,1,38,0),
(174,'BOTON X 9',47,0,47,17155,3.85246,42,1,38,0),
(175,'CERRAR COSTADOS X 2',64,0,64,23360,5.2459,18,1,38,0),
(176,'MARQUILLA ESPALDA',13,0,13,4745,1.06557,22,1,38,0),
(177,'MONTAR CUELLO A CUERPO',60,0,60,21900,4.91803,30,1,38,0),
(178,'MONTAR MANGAS POR 2',57,0,57,20805,4.67213,7,1,38,0),
(179,'OJAL X 9',58,0,58,21170,4.7541,41,1,38,0),
(180,'PREPARAR BANDA CUELLO',41,0,41,14965,3.36066,25,1,38,0),
(181,'PREPARAR BANDA PUñO',30,0,30,10950,2.45902,28,1,38,0),
(182,'RUEDO BAJO',82,0,82,29930,6.72131,23,1,38,0),
(183,'RUEDO BOLSILLO',20,0,20,7300,1.63934,37,1,38,0),
(184,'SESGAR MANGA X 2',34,0,34,12410,2.78689,32,1,38,0),
(185,'UNIR HOMBROS POR 2',25,0,25,9125,2.04918,6,1,38,0),
(186,'ACENTAR PUñO',50,0,50,18250,4.09836,29,0,39,0),
(187,'ARMAR CUELLO',50,0,50,18250,4.09836,27,0,39,0),
(188,'ARMAR PERILLA A FRENTE DOBLE',71,0,71,25915,5.81967,39,0,39,0),
(189,'ARMAR PERILLA A FRENTE SEGUNDA PARTE',62,0,62,22630,5.08197,40,0,39,0),
(190,'ARMAR PUÑO POR 2',58,0,58,21170,4.7541,12,0,39,0),
(191,'BOTON X 9',47,0,47,17155,3.85246,42,0,39,0),
(192,'CERRAR COSTADOS X 2',64,0,64,23360,5.2459,18,0,39,0),
(193,'MARQUILLA ESPALDA',13,0,13,4745,1.06557,22,0,39,0),
(194,'MONTAR CUELLO A CUERPO',60,0,60,21900,4.91803,30,0,39,0),
(195,'MONTAR MANGAS POR 2',57,0,57,20805,4.67213,7,0,39,0),
(196,'OJAL X 9',58,0,58,21170,4.7541,41,0,39,0),
(197,'PREPARAR BANDA CUELLO',41,0,41,14965,3.36066,25,0,39,0),
(198,'PREPARAR BANDA PUñO',30,0,30,10950,2.45902,28,0,39,0),
(199,'RUEDO BAJO',82,0,82,29930,6.72131,23,0,39,0),
(200,'RUEDO BOLSILLO',20,0,20,7300,1.63934,37,0,39,0),
(201,'SESGAR MANGA X 2',34,0,34,12410,2.78689,32,0,39,0),
(202,'UNIR HOMBROS POR 2',25,0,25,9125,2.04918,6,0,39,0),
(203,'ACENTAR PUñO',50,0,50,18250,4.09836,29,0,40,0),
(204,'ARMAR CUELLO',50,0,50,18250,4.09836,27,0,40,0),
(205,'ARMAR PERILLA A FRENTE DOBLE',71,0,71,25915,5.81967,39,0,40,0),
(206,'ARMAR PERILLA A FRENTE SEGUNDA PARTE',62,0,62,22630,5.08197,40,0,40,0),
(207,'ARMAR PUÑO POR 2',58,0,58,21170,4.7541,12,0,40,0),
(208,'BOTON X 9',47,0,47,17155,3.85246,42,0,40,0),
(209,'CERRAR COSTADOS X 2',64,0,64,23360,5.2459,18,0,40,0),
(210,'MARQUILLA ESPALDA',13,0,13,4745,1.06557,22,0,40,0),
(211,'MONTAR CUELLO A CUERPO',60,0,60,21900,4.91803,30,0,40,0),
(212,'MONTAR MANGAS POR 2',57,0,57,20805,4.67213,7,0,40,0),
(213,'OJAL X 9',58,0,58,21170,4.7541,41,0,40,0),
(214,'PREPARAR BANDA CUELLO',41,0,41,14965,3.36066,25,0,40,0),
(215,'PREPARAR BANDA PUñO',30,0,30,10950,2.45902,28,0,40,0),
(216,'RUEDO BAJO',82,0,82,29930,6.72131,23,0,40,0),
(217,'RUEDO BOLSILLO',20,0,20,7300,1.63934,37,0,40,0),
(218,'SESGAR MANGA X 2',34,0,34,12410,2.78689,32,0,40,0),
(219,'UNIR HOMBROS POR 2',25,0,25,9125,2.04918,6,0,40,0),
(220,'ACENTAR PUñO',50,0,50,18250,4.09836,29,0,41,0),
(221,'ARMAR CUELLO',50,0,50,18250,4.09836,27,0,41,0),
(222,'ARMAR PERILLA A FRENTE DOBLE',71,0,71,25915,5.81967,39,0,41,0),
(223,'ARMAR PERILLA A FRENTE SEGUNDA PARTE',62,0,62,22630,5.08197,40,0,41,0),
(224,'ARMAR PUÑO POR 2',58,0,58,21170,4.7541,12,0,41,0),
(225,'BOTON X 9',47,0,47,17155,3.85246,42,0,41,0),
(226,'CERRAR COSTADOS X 2',64,0,64,23360,5.2459,18,0,41,0),
(227,'MARQUILLA ESPALDA',13,0,13,4745,1.06557,22,0,41,0),
(228,'MONTAR CUELLO A CUERPO',60,0,60,21900,4.91803,30,0,41,0),
(229,'MONTAR MANGAS POR 2',57,0,57,20805,4.67213,7,0,41,0),
(230,'OJAL X 9',58,0,58,21170,4.7541,41,0,41,0),
(231,'PREPARAR BANDA CUELLO',41,0,41,14965,3.36066,25,0,41,0),
(232,'PREPARAR BANDA PUñO',30,0,30,10950,2.45902,28,0,41,0),
(233,'RUEDO BAJO',82,0,82,29930,6.72131,23,0,41,0),
(234,'RUEDO BOLSILLO',20,0,20,7300,1.63934,37,0,41,0),
(235,'SESGAR MANGA X 2',34,0,34,12410,2.78689,32,0,41,0),
(236,'UNIR HOMBROS POR 2',25,0,25,9125,2.04918,6,0,41,0),
(237,'ARMAR  CUELLO CON BANDA',87,0,87,31755,7.13115,43,1,37,0),
(238,'ASENTAR CUELLO',60,0,60,21900,4.91803,44,1,37,0),
(239,'ASENTAR CUELLO CON BANDA',61,0,61,22265,5,47,1,37,0),
(240,'MONTAR PUñO A MANGA',70,0,70,25550,5.7377,45,0,37,0),
(241,'ARMAR  CUELLO CON BANDA',87,0,87,31755,7.13115,43,1,38,0),
(242,'ASENTAR CUELLO',60,0,60,21900,4.91803,44,1,38,0),
(243,'ASENTAR CUELLO CON BANDA',61,0,61,22265,5,47,1,38,0),
(244,'MONTAR PUñO A MANGA',70,0,70,25550,5.7377,45,1,38,0),
(245,'ARMAR  CUELLO CON BANDA',87,0,87,31755,7.13115,43,0,39,0),
(246,'ASENTAR CUELLO',60,0,60,21900,4.91803,44,0,39,0),
(247,'ASENTAR CUELLO CON BANDA',61,0,61,22265,5,47,0,39,0),
(248,'MONTAR PUñO A MANGA',70,0,70,25550,5.7377,45,0,39,0),
(249,'ARMAR  CUELLO CON BANDA',87,0,87,31755,7.13115,43,0,40,0),
(250,'ASENTAR CUELLO',60,0,60,21900,4.91803,44,0,40,0),
(251,'ASENTAR CUELLO CON BANDA',61,0,61,22265,5,47,0,40,0),
(252,'MONTAR PUñO A MANGA',70,0,70,25550,5.7377,45,0,40,0),
(253,'ARMAR  CUELLO CON BANDA',87,0,87,31755,7.13115,43,0,41,0),
(254,'ASENTAR CUELLO',60,0,60,21900,4.91803,44,0,41,0),
(255,'ASENTAR CUELLO CON BANDA',61,0,61,22265,5,47,0,41,0),
(256,'MONTAR PUñO A MANGA',70,0,70,25550,5.7377,45,0,41,0),
(257,'ASENTAR PUñO A MANGA',120,0,120,43800,9.83607,46,0,37,0),
(258,'ASENTAR PUñO A MANGA',120,0,120,43800,9.83607,46,1,38,0),
(259,'ASENTAR PUñO A MANGA',120,0,120,43800,9.83607,46,0,39,0),
(260,'ASENTAR PUñO A MANGA',120,0,120,43800,9.83607,46,0,40,0),
(261,'ASENTAR PUñO A MANGA',120,0,120,43800,9.83607,46,0,41,0),
(262,'ARMAR TIRA X 2',21,0,21,5985,3.125,48,0,33,0),
(263,'ASENTAR ELASTICO ESPALDA',56,0,56,15960,8.33333,53,0,33,0),
(264,'ASENTAR ELASTICO FRENTE',47,0,47,13395,6.99405,54,0,33,0),
(265,'ASENTAR SISAS X 2',78,0,78,22230,11.6071,55,0,33,0),
(266,'ASENTAR TIRA X 2',41,0,41,11685,6.10119,49,0,33,0),
(267,'CERRAR COSTADOS X 2',80,0,80,22800,11.9048,18,0,33,0),
(268,'ENTALEGAR TITAS X 4',80,0,80,22800,11.9048,52,0,33,0),
(269,'MARQUILLA ESPALDA',17,0,17,4845,2.52976,22,0,33,0),
(270,'MONTAR ELASTICO ESPALDA',68,0,68,19380,10.119,51,0,33,0),
(271,'MONTAR ELASTICO FRENTE',29,0,29,8265,4.31548,50,0,33,0),
(272,'RUEDO BAJO',73,0,73,20805,10.8631,23,0,33,0),
(273,'SESGAR SISAS X 2',56,0,56,15960,8.33333,16,0,33,0),
(274,'ARMAR TIRA X 2',21,0,21,7707,3.125,48,1,34,0),
(275,'ASENTAR ELASTICO ESPALDA',56,0,56,20552,8.33333,53,1,34,0),
(276,'ASENTAR ELASTICO FRENTE',47,0,47,17249,6.99405,54,1,34,0),
(277,'ASENTAR SISAS X 2',78,0,78,28626,11.6071,55,1,34,0),
(278,'ASENTAR TIRA X 2',41,0,41,15047,6.10119,49,1,34,0),
(279,'CERRAR COSTADOS X 2',80,0,80,29360,11.9048,18,1,34,0),
(280,'ENTALEGAR TITAS X 4',80,0,80,29360,11.9048,52,1,34,0),
(281,'MARQUILLA ESPALDA',17,0,17,6239,2.52976,22,1,34,0),
(282,'MONTAR ELASTICO ESPALDA',68,0,68,24956,10.119,51,1,34,0),
(283,'MONTAR ELASTICO FRENTE',29,0,29,10643,4.31548,50,1,34,0),
(284,'RUEDO BAJO',73,0,73,26791,10.8631,23,1,34,0),
(285,'SESGAR SISAS X 2',56,0,56,20552,8.33333,16,1,34,0),
(286,'ARMAR TIRA X 2',21,0,21,5166,3.125,48,1,35,0),
(287,'ASENTAR ELASTICO ESPALDA',56,0,56,13776,8.33333,53,1,35,0),
(288,'ASENTAR ELASTICO FRENTE',47,0,47,11562,6.99405,54,1,35,0),
(289,'ASENTAR SISAS X 2',78,0,78,19188,11.6071,55,1,35,0),
(290,'ASENTAR TIRA X 2',41,0,41,10086,6.10119,49,1,35,0),
(291,'CERRAR COSTADOS X 2',80,0,80,19680,11.9048,18,1,35,0),
(292,'ENTALEGAR TITAS X 4',80,0,80,19680,11.9048,52,1,35,0),
(293,'MARQUILLA ESPALDA',17,0,17,4182,2.52976,22,1,35,0),
(294,'MONTAR ELASTICO ESPALDA',68,0,68,16728,10.119,51,1,35,0),
(295,'MONTAR ELASTICO FRENTE',29,0,29,7134,4.31548,50,1,35,0),
(296,'RUEDO BAJO',73,0,73,17958,10.8631,23,1,35,0),
(297,'SESGAR SISAS X 2',56,0,56,13776,8.33333,16,1,35,0),
(298,'ARMAR TIRA X 2',21,0,21,1974,3.125,48,1,36,0),
(299,'ASENTAR ELASTICO ESPALDA',56,0,56,5264,8.33333,53,1,36,0),
(300,'ASENTAR ELASTICO FRENTE',47,0,47,4418,6.99405,54,1,36,0),
(301,'ASENTAR SISAS X 2',78,0,78,7332,11.6071,55,1,36,0),
(302,'ASENTAR TIRA X 2',41,0,41,3854,6.10119,49,1,36,0),
(303,'CERRAR COSTADOS X 2',80,0,80,7520,11.9048,18,1,36,0),
(304,'ENTALEGAR TITAS X 4',80,0,80,7520,11.9048,52,1,36,0),
(305,'MARQUILLA ESPALDA',17,0,17,1598,2.52976,22,1,36,0),
(306,'MONTAR ELASTICO ESPALDA',68,0,68,6392,10.119,51,1,36,0),
(307,'MONTAR ELASTICO FRENTE',29,0,29,2726,4.31548,50,1,36,0),
(308,'RUEDO BAJO',73,0,73,6862,10.8631,23,1,36,0),
(309,'SESGAR SISAS X 2',56,0,56,5264,8.33333,16,1,36,0),
(310,'UNIR ESPALDA',26,0,26,7410,3.86905,56,0,33,0),
(311,'UNIR ESPALDA',26,0,26,9542,3.86905,56,1,34,0),
(312,'UNIR ESPALDA',26,0,26,6396,3.86905,56,1,35,0),
(313,'UNIR ESPALDA',26,0,26,2444,3.86905,56,1,36,0),
(351,'ARMAR  CUELLO CON BANDA',200,0,200,59200,33.3333,43,1,47,296),
(352,'ARMAR CINTURON',250,0,250,74000,41.6667,11,0,47,0),
(353,'ARMAR CORTE BAJO',150,0,150,44400,25,9,0,47,0),
(354,'ARMAR  CUELLO CON BANDA',200,0,200,59200,33.3333,43,0,48,0),
(355,'ARMAR CINTURON',250,0,250,74000,41.6667,11,0,48,0),
(356,'ARMAR CORTE BAJO',150,0,150,44400,25,9,0,48,0),
(357,'ARMAR  CUELLO CON BANDA',200,0,200,59200,33.3333,43,0,49,0),
(358,'ARMAR CINTURON',250,0,250,74000,41.6667,11,0,49,0),
(359,'ARMAR CORTE BAJO',150,0,150,44400,25,9,0,49,0),
(360,'ARMAR  CUELLO CON BANDA',100,0,100,44000,15.3846,43,1,64,440),
(361,'ARMAR CINTURON',200,0,200,88000,30.7692,11,0,64,0),
(362,'ARMAR CORTE BAJO',250,0,250,110000,38.4615,9,0,64,0),
(363,'ARMAR CUELLO',100,0,100,44000,15.3846,27,0,64,0),
(364,'ARMAR  CUELLO CON BANDA',100,0,100,44000,15.3846,43,0,65,0),
(365,'ARMAR CINTURON',200,0,200,88000,30.7692,11,0,65,0),
(366,'ARMAR CORTE BAJO',250,0,250,110000,38.4615,9,0,65,0),
(367,'ARMAR CUELLO',100,0,100,44000,15.3846,27,0,65,0),
(368,'ARMAR  CUELLO CON BANDA',100,0,100,44000,15.3846,43,0,66,0),
(369,'ARMAR CINTURON',200,0,200,88000,30.7692,11,0,66,0),
(370,'ARMAR CORTE BAJO',250,0,250,110000,38.4615,9,0,66,0),
(371,'ARMAR CUELLO',100,0,100,44000,15.3846,27,0,66,0),
(372,'ARMAR  CUELLO CON BANDA',20,0,20,1920,33.3333,43,0,74,0),
(373,'ARMAR CINTURON',20,0,20,1920,33.3333,11,0,74,0),
(374,'ARMAR CORTE BAJO',20,0,20,1920,33.3333,9,0,74,0),
(375,'ARMAR  CUELLO CON BANDA',20,0,20,7260,33.3333,43,0,75,0),
(376,'ARMAR CINTURON',20,0,20,7260,33.3333,11,0,75,0),
(377,'ARMAR CORTE BAJO',20,0,20,7260,33.3333,9,0,75,0),
(378,'ARMAR  CUELLO CON BANDA',20,0,20,6100,33.3333,43,0,76,0),
(379,'ARMAR CINTURON',20,0,20,6100,33.3333,11,0,76,0),
(380,'ARMAR CORTE BAJO',20,0,20,6100,33.3333,9,0,76,0),
(381,'ARMAR  CUELLO CON BANDA',20,0,20,2000,33.3333,43,0,78,0),
(382,'ARMAR CINTURON',20,0,20,2000,33.3333,11,0,78,0),
(383,'ARMAR CORTE BAJO',20,0,20,2000,33.3333,9,0,78,0),
(384,'ARMAR  CUELLO CON BANDA',20,0,20,5340,33.3333,43,0,79,0),
(385,'ARMAR CINTURON',20,0,20,5340,33.3333,11,0,79,0),
(386,'ARMAR CORTE BAJO',20,0,20,5340,33.3333,9,0,79,0);

/*Table structure for table `ordenproducciontipo` */

DROP TABLE IF EXISTS `ordenproducciontipo`;

CREATE TABLE `ordenproducciontipo` (
  `idtipo` int(15) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `ordenproducciontipo` */

insert  into `ordenproducciontipo`(`idtipo`,`tipo`,`activo`) values 
(1,'CONFECCIÓN',0),
(2,'TERMINACION',0);

/*Table structure for table `parametros` */

DROP TABLE IF EXISTS `parametros`;

CREATE TABLE `parametros` (
  `id_parametros` int(11) NOT NULL AUTO_INCREMENT,
  `auxilio_transporte` float NOT NULL,
  `pension` float NOT NULL,
  `caja` float NOT NULL,
  `prestaciones` float NOT NULL,
  `vacaciones` float NOT NULL,
  `ajuste` float NOT NULL,
  `salario_minimo` float NOT NULL,
  `id_arl` int(11) NOT NULL,
  `admon` float NOT NULL,
  PRIMARY KEY (`id_parametros`),
  KEY `id_arl` (`id_arl`),
  CONSTRAINT `parametros_ibfk_1` FOREIGN KEY (`id_arl`) REFERENCES `arl` (`id_arl`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `parametros` */

insert  into `parametros`(`id_parametros`,`auxilio_transporte`,`pension`,`caja`,`prestaciones`,`vacaciones`,`ajuste`,`salario_minimo`,`id_arl`,`admon`) values 
(1,97032,12,4,17.66,4.5,4,828116,2,6);

/*Table structure for table `permisos` */

DROP TABLE IF EXISTS `permisos`;

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `modulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `menu_operacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `permisos` */

insert  into `permisos`(`id_permiso`,`permiso`,`modulo`,`menu_operacion`) values 
(1,'BANCO','ADMINISTRACION','ADMINISTRACION'),
(2,'ARL','ADMINISTRACION','ADMINISTRACION'),
(3,'TIPO DOCUMENTO','ADMINISTRACION','ADMINISTRACION'),
(4,'TIPO RECIBO','CONTABILIDAD','ADMINISTRACION'),
(5,'DEPARTAMENTO','ADMINISTRACION','ADMINISTRACION'),
(6,'MUNICIPIO','ADMINISTRACION','ADMINISTRACION'),
(7,'RESOLUCION','ADMINISTRACION','ADMINISTRACION'),
(8,'CONCEPTOS NOTAS','FACTURACION','ADMINISTRACION'),
(9,'TIPO CARGO','ADMINISTRACION','ADMINISTRACION'),
(10,'PRENDA','PRODUCCION','ADMINISTRACION'),
(11,'TALLA','PRODUCCION','ADMINISTRACION'),
(12,'OPERACION PRODUCCION','PRODUCCION','ADMINISTRACION'),
(13,'TIPO ORDEN PRODUCCION','PRODUCCION','ADMINISTRACION'),
(14,'CLIENTE','ADMINISTRACION','ADMINISTRACION'),
(15,'PROVEEDOR','CONTABILIDAD','ADMINISTRACION'),
(16,'PRODUCTO','PRODUCCION','ADMINISTRACION'),
(17,'COSTO LABORAL','PRODUCCION','UTILIDADES'),
(18,'COSTO LABORAL HORA','PRODUCCION','UTILIDADES'),
(19,'COSTO FIJO','PRODUCCION','UTILIDADES'),
(20,'COSTO PRODUCCION DIARIA','PRODUCCION','UTILIDADES'),
(21,'DESCARGAR STOCK','PRODUCCION','UTILIDADES'),
(22,'RESUMEN COSTOS','PRODUCCION','UTILIDADES'),
(23,'RECIBO DE CAJA','CONTABILIDAD','MOVIMIENTOS'),
(24,'COMPROBANTE DE EGRESO','CONTABILIDAD','MOVIMIENTOS'),
(25,'ORDEN DE PRODUCCION','PRODUCCION','MOVIMIENTOS'),
(26,'FACTURA DE VENTA','FACTURACION','MOVIMIENTOS'),
(27,'NOTA CREDITO','FACTURACION','MOVIMIENTOS'),
(28,'FICHA OPERACIONES','PRODUCCION','MOVIMIENTOS'),
(29,'CONFIGURACION','GENERAL','GENERAL'),
(30,'EMPRESA','GENERAL','GENERAL'),
(31,'EMPLEADO','ADMINISTRACION','ADMINISTRACION'),
(32,'FICHA TIEMPO','PRODUCCION','UTILIDADES'),
(33,'SEGUIMIENTO PRODUCCION','PRODUCCION','UTILIDADES'),
(34,'COMPRA TIPO','CONTABILIDAD','ADMINISTRACION'),
(35,'COMPRA','CONTABILIDAD','MOVIMIENTOS'),
(36,'COMPRA CONCEPTO','CONTABILIDAD','ADMINISTRACION');

/*Table structure for table `prendatipo` */

DROP TABLE IF EXISTS `prendatipo`;

CREATE TABLE `prendatipo` (
  `idprendatipo` int(11) NOT NULL AUTO_INCREMENT,
  `prenda` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `idtalla` int(11) NOT NULL,
  PRIMARY KEY (`idprendatipo`),
  KEY `idtalla` (`idtalla`),
  CONSTRAINT `prendatipo_ibfk_1` FOREIGN KEY (`idtalla`) REFERENCES `talla` (`idtalla`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `prendatipo` */

insert  into `prendatipo`(`idprendatipo`,`prenda`,`idtalla`) values 
(1,'KIMONO LARGO BLANCO',1),
(2,'KIMONO LARGO BLANCO',2),
(3,'KIMONO LARGO BLANCO',3),
(4,'KIMONO LARGO BLANCO',4),
(5,'KIMONO LARGO BLANCO',5),
(6,'VESTIDOS CORTO ESTAMPADO',4),
(7,'VESTIDOS CORTO ESTAMPADO',3),
(8,'VESTIDOS CORTO ESTAMPADO',2),
(9,'VESTIDOS CORTO ESTAMPADO',1),
(10,'CAMISA ENTERO LARGA',3),
(11,'CAMISA ENTERO LARGA',2),
(12,'CAMISA ENTERO LARGA',5),
(13,'CAMISA ENTERO LARGA',1),
(14,'CAMISA ENTERO LARGA',4),
(15,'VESTIDO LARGO ESTAMPADO',1),
(16,'VESTIDO LARGO ESTAMPADO',2),
(17,'VESTIDO LARGO ESTAMPADO',3),
(18,'VESTIDO LARGO ESTAMPADO',4),
(19,'CAMISAS ENTERO MANGA',4),
(20,'CAMISAS ENTERO MANGA',3),
(21,'CAMISAS ENTERO MANGA',2),
(22,'CAMISAS ENTERO MANGA',5),
(23,'CAMISAS ENTERO MANGA',1),
(26,'KIMONO ESTAMPADO FLORES',4),
(27,'KIMONO ESTAMPADO FLORES	',2),
(28,'KIMONO ESTAMPADO FLORES	',3),
(29,'CAMISA ESTAMPADA MANGA',5),
(30,'CAMISA ESTAMPADA MANGA',2),
(31,'CAMISA ESTAMPADA MANGA',1),
(32,'CAMISA ESTAMPADA MANGA',3),
(33,'CAMISA ESTAMPADA MANGA',4),
(34,'ESTAMPADO ANIMAL PRINT',2),
(35,'ESTAMPADO ANIMAL PRINT',3),
(36,'ESTAMPADO ANIMAL PRINT',4),
(37,'PRUEBA',1);

/*Table structure for table `proceso_produccion` */

DROP TABLE IF EXISTS `proceso_produccion`;

CREATE TABLE `proceso_produccion` (
  `idproceso` int(11) NOT NULL AUTO_INCREMENT,
  `proceso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idproceso`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `proceso_produccion` */

insert  into `proceso_produccion`(`idproceso`,`proceso`,`estado`) values 
(1,'ENRESORTAR ESPALDA',0),
(2,'ARMAR TIRA LIBRE',0),
(3,'ASENTAR TIRA LIBRE',0),
(4,'MONTAR PERILLA CUELLO',0),
(5,'PRESPUNTAR PERILLA',0),
(6,'UNIR HOMBROS POR 2',0),
(7,'MONTAR MANGAS POR 2',0),
(8,'MONTAR CORTE BAJO',0),
(9,'ARMAR CORTE BAJO',0),
(10,'ARMAR SEGUNDA MANGA',0),
(11,'ARMAR CINTURON',0),
(12,'ARMAR PUÑO POR 2',0),
(13,'MONTAR PUÑO SEGUNDA MANGA',0),
(14,'SESGAR ESPALDA',0),
(15,'SESGAR FRENTE X 2',0),
(16,'SESGAR SISAS X 2',0),
(17,'ASENTAR PERILLA',0),
(18,'CERRAR COSTADOS X 2',0),
(19,'MONTAR TIRAS A HOMBRO X 4',0),
(20,'ASENTAR COMPLETO',0),
(21,'PINZA ESPALDA',0),
(22,'MARQUILLA ESPALDA',0),
(23,'RUEDO BAJO',0),
(24,'OJAL X 8',0),
(25,'PREPARAR BANDA CUELLO',0),
(26,'PUNTEAR X4',0),
(27,'ARMAR CUELLO',0),
(28,'PREPARAR BANDA PUñO',0),
(29,'ASENTAR PUñO',0),
(30,'MONTAR CUELLO A CUERPO',0),
(31,'ASENTAR CUELLO A CUERPO',0),
(32,'SESGAR MANGA X 2',0),
(33,'PINZA A PUñO',0),
(34,'BOTON X 4',0),
(35,'OJAL X 4',0),
(36,'MONTAR PUñO X 2',0),
(37,'RUEDO BOLSILLO',0),
(38,'RUEDO BANDA CUELLO',0),
(39,'ARMAR PERILLA A FRENTE DOBLE',0),
(40,'ARMAR PERILLA A FRENTE SEGUNDA PARTE',0),
(41,'OJAL X 9',0),
(42,'BOTON X 9',0),
(43,'ARMAR  CUELLO CON BANDA',0),
(44,'ASENTAR CUELLO',0),
(45,'MONTAR PUñO A MANGA',0),
(46,'ASENTAR PUñO A MANGA',0),
(47,'ASENTAR CUELLO CON BANDA',0),
(48,'ARMAR TIRA X 2',0),
(49,'ASENTAR TIRA X 2',0),
(50,'MONTAR ELASTICO FRENTE',0),
(51,'MONTAR ELASTICO ESPALDA',0),
(52,'ENTALEGAR TITAS X 4',0),
(53,'ASENTAR ELASTICO ESPALDA',0),
(54,'ASENTAR ELASTICO FRENTE',0),
(55,'ASENTAR SISAS X 2',0),
(56,'UNIR ESPALDA',0);

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `observacion` longtext NOT NULL,
  `activo` tinyint(1) DEFAULT '0',
  `fechaproceso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuariosistema` char(15) DEFAULT NULL,
  `codigo` varchar(20) NOT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `idcliente` (`idcliente`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `producto` */

insert  into `producto`(`idproducto`,`idcliente`,`observacion`,`activo`,`fechaproceso`,`usuariosistema`,`codigo`) values 
(7,1,'referencia 108',0,'2019-01-26 15:00:00',NULL,'108'),
(8,1,'108',0,'2019-01-28 09:55:53',NULL,'133'),
(9,1,'536',0,'2019-01-28 10:12:10',NULL,'536'),
(10,1,'147',0,'2019-01-28 10:15:27',NULL,'147'),
(11,1,'271',0,'2019-01-28 10:19:18',NULL,'271'),
(12,1,'227',0,'2019-01-28 10:33:04',NULL,'227'),
(13,1,'527',0,'2019-01-28 10:40:45',NULL,'527'),
(14,1,'ESTA PRENDA LLEVA LAVANDERIA',0,'2019-01-29 12:19:59',NULL,'220');

/*Table structure for table `productodetalle` */

DROP TABLE IF EXISTS `productodetalle`;

CREATE TABLE `productodetalle` (
  `idproductodetalle` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `fechaproceso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuariosistema` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idprendatipo` int(11) NOT NULL,
  PRIMARY KEY (`idproductodetalle`),
  KEY `idproducto` (`idproducto`),
  KEY `idprendatipo` (`idprendatipo`),
  CONSTRAINT `productodetalle_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`),
  CONSTRAINT `productodetalle_ibfk_2` FOREIGN KEY (`idprendatipo`) REFERENCES `prendatipo` (`idprendatipo`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `productodetalle` */

insert  into `productodetalle`(`idproductodetalle`,`idproducto`,`observacion`,`activo`,`fechaproceso`,`usuariosistema`,`idprendatipo`) values 
(1,7,'.',1,'2019-01-28 09:39:31',NULL,2),
(2,7,'.',1,'2019-01-28 09:39:31',NULL,1),
(3,7,'.',1,'2019-01-28 09:39:31',NULL,3),
(4,7,'.',1,'2019-01-28 09:39:31',NULL,4),
(5,7,'.',1,'2019-01-28 09:39:31',NULL,5),
(11,8,'.',1,'2019-01-28 10:04:24',NULL,6),
(12,8,'.',1,'2019-01-28 10:04:24',NULL,8),
(13,8,'.',1,'2019-01-28 10:04:24',NULL,9),
(14,8,'.',1,'2019-01-28 10:04:24',NULL,7),
(19,9,'.',1,'2019-01-28 10:12:52',NULL,10),
(20,9,'.',1,'2019-01-28 10:12:52',NULL,14),
(21,9,'.',1,'2019-01-28 10:12:52',NULL,13),
(22,9,'.',1,'2019-01-28 10:12:52',NULL,12),
(23,9,'.',1,'2019-01-28 10:12:52',NULL,11),
(24,10,'.',1,'2019-01-28 10:15:45',NULL,6),
(25,10,'.',1,'2019-01-28 10:15:45',NULL,8),
(26,10,'.',1,'2019-01-28 10:15:45',NULL,9),
(27,10,'.',1,'2019-01-28 10:15:45',NULL,7),
(28,11,'.',1,'2019-01-28 10:18:26',NULL,20),
(29,11,'.',1,'2019-01-28 10:18:26',NULL,21),
(30,11,'.',1,'2019-01-28 10:18:26',NULL,22),
(31,11,'.',1,'2019-01-28 10:18:26',NULL,19),
(32,11,'.',1,'2019-01-28 10:18:26',NULL,23),
(38,12,'.',1,'2019-01-28 10:33:40',NULL,28),
(39,12,'.',1,'2019-01-28 10:33:41',NULL,27),
(40,12,'.',1,'2019-01-28 10:33:41',NULL,26),
(44,13,'.',1,'2019-01-28 10:41:55',NULL,33),
(45,13,'.',1,'2019-01-28 10:41:55',NULL,31),
(46,13,'.',1,'2019-01-28 10:41:55',NULL,29),
(47,13,'.',1,'2019-01-28 10:41:55',NULL,30),
(48,13,'.',1,'2019-01-28 10:41:55',NULL,32),
(49,14,'.',1,'2019-01-29 12:20:41',NULL,34),
(50,14,'.',1,'2019-01-29 12:20:41',NULL,35),
(51,14,'.',1,'2019-01-29 12:20:41',NULL,36),
(52,14,'.',1,'2019-02-05 20:56:23','71268830',11),
(53,14,'.',1,'2019-02-05 20:57:16','71268830',13),
(54,14,'.',1,'2019-02-05 20:58:49','71268830',30);

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `idtipo` int(11) NOT NULL,
  `cedulanit` int(15) NOT NULL,
  `dv` int(1) NOT NULL,
  `razonsocial` varchar(40) DEFAULT NULL,
  `nombreproveedor` varchar(30) DEFAULT NULL,
  `apellidoproveedor` varchar(30) DEFAULT NULL,
  `nombrecorto` varchar(200) DEFAULT NULL,
  `direccionproveedor` varchar(40) DEFAULT NULL,
  `telefonoproveedor` char(15) DEFAULT NULL,
  `celularproveedor` char(15) DEFAULT NULL,
  `emailproveedor` char(40) NOT NULL,
  `contacto` char(40) NOT NULL,
  `telefonocontacto` char(15) NOT NULL,
  `celularcontacto` char(15) NOT NULL,
  `formapago` char(15) NOT NULL,
  `plazopago` int(11) DEFAULT NULL,
  `iddepartamento` varchar(15) NOT NULL,
  `idmunicipio` varchar(15) NOT NULL,
  `nitmatricula` char(15) NOT NULL,
  `tiporegimen` char(15) NOT NULL,
  `autoretenedor` tinyint(1) DEFAULT '0',
  `naturaleza` tinyint(1) DEFAULT '0',
  `sociedad` tinyint(1) DEFAULT '0',
  `observacion` longtext,
  `fechaingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `banco` varchar(50) DEFAULT NULL,
  `tipocuenta` tinyint(1) DEFAULT NULL,
  `cuentanumero` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idproveedor`),
  KEY `nitmatricula` (`nitmatricula`),
  KEY `idtipo` (`idtipo`),
  KEY `iddepartamento` (`iddepartamento`),
  KEY `idmunicipio` (`idmunicipio`),
  CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`idtipo`) REFERENCES `tipodocumento` (`idtipo`),
  CONSTRAINT `proveedor_ibfk_2` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`),
  CONSTRAINT `proveedor_ibfk_3` FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `proveedor` */

insert  into `proveedor`(`idproveedor`,`idtipo`,`cedulanit`,`dv`,`razonsocial`,`nombreproveedor`,`apellidoproveedor`,`nombrecorto`,`direccionproveedor`,`telefonoproveedor`,`celularproveedor`,`emailproveedor`,`contacto`,`telefonocontacto`,`celularcontacto`,`formapago`,`plazopago`,`iddepartamento`,`idmunicipio`,`nitmatricula`,`tiporegimen`,`autoretenedor`,`naturaleza`,`sociedad`,`observacion`,`fechaingreso`,`banco`,`tipocuenta`,`cuentanumero`) values 
(2,5,11111111,6,'PRUEBA','PRUEBA','PRUEBA','PRUEBA','CRA DF','258','300','prueba@hotmail.com','PRUEBA','333','300','1',0,'05','05001','11111111','1',1,1,1,'PROVEEDOR DE PRUEBA','2019-02-27 17:28:30','',NULL,NULL),
(3,5,14141414,1,'PABLO Y ASOCIADOS','','','PABLO Y ASOCIADOS','CRA F','258','301','sd@hotmail.com','DD','214','23622','1',0,'05','05001','14141414','1',1,1,2,'FFFFFF','2019-02-27 17:03:22',NULL,NULL,NULL),
(4,1,43274332,2,'','FELIPE ANDRES','DIAS LOPERA','FELIPE ANDRES DIAS LOPERA','CRA DF','254','302','fel@hotmail.com','PRUEBA','333','300','1',0,'05','05001','43274332','1',1,2,1,'PRUEBA','2019-02-27 17:33:36','AVVVILLAS',0,'2121121'),
(5,5,33333,1,'GRUAS SA','','','GRUAS SA','CRA DF','3390000','300','gra@hotmail.com','PRUEBA','333','300','2',0,'05','05002','33333','2',0,1,1,'FDFDFDF','2019-02-27 22:29:59','AVVVILLAS',0,'2121121'),
(6,1,25874552,5,'','PEDRO PABLO','LEON JARRA','PEDRO PABLO LEON JARRA','CRA DF','258','300','pp@hotmail.com','PRUEBA','333','300','2',0,'05','05001','25874552','1',1,1,2,'FFDFDF','2019-02-27 22:22:42','AVVVILLAS',0,'2525');

/*Table structure for table `recibocaja` */

DROP TABLE IF EXISTS `recibocaja`;

CREATE TABLE `recibocaja` (
  `idrecibo` int(11) NOT NULL AUTO_INCREMENT,
  `fecharecibo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechapago` date DEFAULT NULL,
  `numero` int(11) DEFAULT '0',
  `idtiporecibo` int(10) NOT NULL,
  `idmunicipio` varchar(15) NOT NULL,
  `valorpagado` double DEFAULT '0',
  `valorletras` longtext,
  `idcliente` int(11) DEFAULT NULL,
  `observacion` longtext,
  `usuariosistema` char(15) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  `autorizado` tinyint(1) DEFAULT '0',
  `libre` tinyint(1) DEFAULT '0',
  `telefono` int(20) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `nitcedula` int(20) DEFAULT NULL,
  `clienterazonsocial` varchar(60) DEFAULT NULL,
  `idbanco` int(11) DEFAULT NULL,
  PRIMARY KEY (`idrecibo`),
  KEY `idcliente` (`idcliente`),
  KEY `idtiporecibo` (`idtiporecibo`),
  KEY `idmunicipio` (`idmunicipio`),
  KEY `idbanco` (`idbanco`),
  CONSTRAINT `recibocaja_ibfk_3` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `recibocaja_ibfk_4` FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`),
  CONSTRAINT `recibocaja_ibfk_5` FOREIGN KEY (`idtiporecibo`) REFERENCES `tiporecibo` (`idtiporecibo`),
  CONSTRAINT `recibocaja_ibfk_6` FOREIGN KEY (`idbanco`) REFERENCES `banco` (`idbanco`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `recibocaja` */

insert  into `recibocaja`(`idrecibo`,`fecharecibo`,`fechapago`,`numero`,`idtiporecibo`,`idmunicipio`,`valorpagado`,`valorletras`,`idcliente`,`observacion`,`usuariosistema`,`estado`,`autorizado`,`libre`,`telefono`,`direccion`,`nitcedula`,`clienterazonsocial`,`idbanco`) values 
(3,'2019-01-30 15:32:21','2019-01-30',2,1,'05001',2985812.782517,'-',1,'AAA','71268830',0,1,0,NULL,NULL,NULL,NULL,1022),
(4,'2019-01-30 18:15:22','2019-01-30',8,1,'05001',18856661,NULL,1,'',NULL,0,1,0,NULL,NULL,NULL,NULL,1021),
(5,'2019-01-30 18:18:21','2019-01-30',9,1,'05001',27512952.2635,'-',1,'AAA','71268830',0,1,0,NULL,NULL,NULL,NULL,1),
(6,'2019-01-30 21:30:04','2019-01-30',3,13,'05002',20000,'-',1,'PRUEBA 2','71268830',0,1,1,123456,'cra prueba',123,'prueba recibo',1),
(7,'2019-02-01 11:33:43','2019-02-01',4,1,'05001',250000,'-',1,'FDF','71268830',0,1,1,222,'cra 3',147,'prueba 3',1),
(8,'2019-02-05 18:48:30','2019-02-06',5,11,'05001',222332,'-',1,'AAAAA','71268830',0,1,1,NULL,NULL,NULL,NULL,1),
(9,'2019-02-11 19:30:51','2019-02-11',0,1,'05001',0,'-',1,'DSDSDSD','71268830',0,0,1,NULL,NULL,NULL,NULL,1),
(10,'2019-02-12 09:02:47','2019-02-12',0,3,'05001',0,'-',2,'FFFF','71268830',0,0,1,NULL,NULL,NULL,NULL,1022),
(11,'2019-02-12 09:05:27','2019-02-12',0,6,'05001',0,'-',2,'CCCC','71268830',0,0,0,NULL,NULL,NULL,NULL,1);

/*Table structure for table `recibocajadetalle` */

DROP TABLE IF EXISTS `recibocajadetalle`;

CREATE TABLE `recibocajadetalle` (
  `iddetallerecibo` int(11) NOT NULL AUTO_INCREMENT,
  `idfactura` int(15) DEFAULT NULL,
  `vlrabono` double DEFAULT NULL,
  `vlrsaldo` double DEFAULT NULL,
  `retefuente` double DEFAULT NULL,
  `reteiva` double DEFAULT NULL,
  `reteica` double DEFAULT NULL,
  `idrecibo` int(11) NOT NULL,
  `observacion` longtext,
  PRIMARY KEY (`iddetallerecibo`),
  KEY `idrecibo` (`idrecibo`),
  KEY `idfactura` (`idfactura`),
  CONSTRAINT `recibocajadetalle_ibfk_2` FOREIGN KEY (`idrecibo`) REFERENCES `recibocaja` (`idrecibo`),
  CONSTRAINT `recibocajadetalle_ibfk_3` FOREIGN KEY (`idfactura`) REFERENCES `facturaventa` (`idfactura`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `recibocajadetalle` */

insert  into `recibocajadetalle`(`iddetallerecibo`,`idfactura`,`vlrabono`,`vlrsaldo`,`retefuente`,`reteiva`,`reteica`,`idrecibo`,`observacion`) values 
(1,4,2985812.782517,0,106493.54552,75876.651183,NULL,3,NULL),
(3,NULL,20000,0,0,0,0,6,NULL),
(4,NULL,250000,0,0,0,0,7,NULL),
(5,12,833538,-1,0,20453,NULL,5,NULL),
(6,13,12241942,0,436627,311097,NULL,5,NULL),
(7,7,12650563,0,451202,321481,NULL,5,NULL),
(8,8,1188160,0,42378,30194,NULL,5,NULL),
(9,9,598749.2634997,0,0,14691.6521823,NULL,5,NULL),
(10,NULL,222332,0,0,0,0,8,NULL),
(11,1,18856661,-37713323,672551,479193,NULL,4,NULL);

/*Table structure for table `remision` */

DROP TABLE IF EXISTS `remision`;

CREATE TABLE `remision` (
  `id_remision` int(11) NOT NULL AUTO_INCREMENT,
  `idordenproduccion` int(11) DEFAULT NULL,
  `numero` int(20) DEFAULT '0',
  `total_tulas` int(11) DEFAULT NULL,
  `total_exportacion` float DEFAULT NULL,
  `totalsegundas` float DEFAULT NULL,
  `total_colombia` float DEFAULT NULL,
  `total_confeccion` float DEFAULT NULL,
  `total_despachadas` float DEFAULT NULL,
  `fechacreacion` date DEFAULT NULL,
  `color` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_remision`),
  KEY `idordenproduccion` (`idordenproduccion`),
  CONSTRAINT `remision_ibfk_1` FOREIGN KEY (`idordenproduccion`) REFERENCES `ordenproduccion` (`idordenproduccion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `remision` */

insert  into `remision`(`id_remision`,`idordenproduccion`,`numero`,`total_tulas`,`total_exportacion`,`totalsegundas`,`total_colombia`,`total_confeccion`,`total_despachadas`,`fechacreacion`,`color`) values 
(2,14,2,25,568,156,705,1273,1273,'2019-02-05','Rojo'),
(3,1,0,0,0,0,0,0,0,'2019-02-15','Rojo'),
(4,13,3,1,0,0,10,10,10,'2019-02-13','Amarillo'),
(5,8,4,1,0,0,10,10,10,'2019-03-01','Negro');

/*Table structure for table `remisiondetalle` */

DROP TABLE IF EXISTS `remisiondetalle`;

CREATE TABLE `remisiondetalle` (
  `id_remision_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_remision` int(11) DEFAULT NULL,
  `color` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `oc` tinyint(1) DEFAULT NULL,
  `tula` int(2) DEFAULT '0',
  `xs` int(2) DEFAULT '0',
  `s` int(2) DEFAULT '0',
  `m` int(2) DEFAULT '0',
  `l` int(2) DEFAULT '0',
  `xl` int(2) DEFAULT '0',
  `28` int(2) DEFAULT '0',
  `30` int(2) DEFAULT '0',
  `32` int(2) DEFAULT '0',
  `34` int(2) DEFAULT '0',
  `38` int(2) DEFAULT '0',
  `40` int(2) DEFAULT '0',
  `42` int(2) DEFAULT '0',
  `44` int(2) DEFAULT '0',
  `estado` tinyint(1) DEFAULT NULL,
  `unidades` int(10) DEFAULT '0',
  PRIMARY KEY (`id_remision_detalle`),
  KEY `id_remision` (`id_remision`),
  CONSTRAINT `remisiondetalle_ibfk_1` FOREIGN KEY (`id_remision`) REFERENCES `remision` (`id_remision`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `remisiondetalle` */

insert  into `remisiondetalle`(`id_remision_detalle`,`id_remision`,`color`,`oc`,`tula`,`xs`,`s`,`m`,`l`,`xl`,`28`,`30`,`32`,`34`,`38`,`40`,`42`,`44`,`estado`,`unidades`) values 
(5,2,'Rojo',1,1,120,60,7,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,187),
(6,2,'Rojo',1,1,120,67,107,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,294),
(7,2,'Rojo',1,1,27,0,0,60,0,0,0,0,0,0,0,0,0,0,87),
(8,2,'Rojo',0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
(9,2,'Rojo',0,1,0,0,0,80,0,0,0,0,0,0,0,0,0,0,80),
(10,2,'Rojo',0,1,0,0,120,0,0,0,0,0,0,0,0,0,0,0,120),
(11,2,'Rojo',0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
(12,2,'Rojo',0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
(13,2,'Rojo',0,1,0,0,33,0,0,0,0,0,0,0,0,0,0,0,33),
(14,2,'Rojo',0,1,0,120,0,0,0,0,0,0,0,0,0,0,0,0,120),
(15,2,'Rojo',0,1,0,94,0,0,0,0,0,0,0,0,0,0,0,0,94),
(16,2,'Rojo',0,5,0,22,38,0,96,0,0,0,0,0,0,0,0,1,156),
(19,4,'Amarillo',0,1,0,10,0,0,0,0,0,0,0,0,0,0,0,0,10),
(20,2,'Rojo',0,1,0,22,0,0,0,0,0,0,0,0,0,0,0,0,22),
(21,2,'Rojo',0,1,0,0,10,0,0,0,0,0,0,0,0,0,0,0,10),
(22,2,'Rojo',0,1,0,10,0,0,0,0,0,0,0,0,0,0,0,0,10),
(23,2,'Rojo',0,1,0,0,0,10,0,0,0,0,0,0,0,0,0,0,10),
(24,2,'Rojo',0,1,0,0,10,0,0,0,0,0,0,0,0,0,0,0,10),
(25,2,'Rojo',0,1,0,0,10,0,0,0,0,0,0,0,0,0,0,0,10),
(26,2,'Rojo',0,1,0,0,0,0,10,0,0,0,0,0,0,0,0,0,10),
(27,2,'Rojo',0,1,10,0,0,0,0,0,0,0,0,0,0,0,0,0,10),
(28,2,'Rojo',0,1,0,10,0,0,0,0,0,0,0,0,0,0,0,0,10),
(29,5,'Negro',0,1,10,0,0,0,0,0,0,0,0,0,0,0,0,0,10);

/*Table structure for table `resolucion` */

DROP TABLE IF EXISTS `resolucion`;

CREATE TABLE `resolucion` (
  `idresolucion` int(11) NOT NULL AUTO_INCREMENT,
  `id_matriculaempresa` int(11) NOT NULL,
  `nroresolucion` char(40) CHARACTER SET latin1 NOT NULL,
  `desde` char(10) CHARACTER SET latin1 NOT NULL,
  `hasta` char(10) CHARACTER SET latin1 NOT NULL,
  `fechavencimiento` datetime NOT NULL,
  `nitmatricula` char(11) CHARACTER SET latin1 NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `fechacreacion` date DEFAULT NULL,
  `codigoactividad` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `descripcion` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`idresolucion`),
  KEY `id_matriculaempresa` (`id_matriculaempresa`),
  CONSTRAINT `resolucion_ibfk_1` FOREIGN KEY (`id_matriculaempresa`) REFERENCES `matriculaempresa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `resolucion` */

insert  into `resolucion`(`idresolucion`,`id_matriculaempresa`,`nroresolucion`,`desde`,`hasta`,`fechavencimiento`,`nitmatricula`,`activo`,`fechacreacion`,`codigoactividad`,`descripcion`) values 
(3,1,'18762009830025','1','1000','2020-08-23 00:00:00','901189320',1,'2018-08-24','1410','Confección de prendas de vestir');

/*Table structure for table `resumen_costos` */

DROP TABLE IF EXISTS `resumen_costos`;

CREATE TABLE `resumen_costos` (
  `id_resumen_costos` int(11) NOT NULL AUTO_INCREMENT,
  `costo_laboral` float DEFAULT NULL,
  `costo_fijo` float DEFAULT NULL,
  `total_costo` float DEFAULT NULL,
  `costo_diario` float DEFAULT NULL,
  PRIMARY KEY (`id_resumen_costos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `resumen_costos` */

insert  into `resumen_costos`(`id_resumen_costos`,`costo_laboral`,`costo_fijo`,`total_costo`,`costo_diario`) values 
(1,28082200,5628000,33710200,1296550);

/*Table structure for table `seguimiento_produccion` */

DROP TABLE IF EXISTS `seguimiento_produccion`;

CREATE TABLE `seguimiento_produccion` (
  `id_seguimiento_produccion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio_produccion` date NOT NULL,
  `hora_inicio` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idordenproduccion` int(11) NOT NULL,
  `minutos` float DEFAULT NULL,
  `horas_a_trabajar` float DEFAULT NULL,
  `operarias` float DEFAULT NULL,
  `prendas_reales` float DEFAULT NULL,
  `descanso` int(11) DEFAULT '0',
  PRIMARY KEY (`id_seguimiento_produccion`),
  KEY `idcliente` (`idcliente`),
  KEY `idordenproduccion` (`idordenproduccion`),
  CONSTRAINT `seguimiento_produccion_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `seguimiento_produccion_ibfk_2` FOREIGN KEY (`idordenproduccion`) REFERENCES `ordenproduccion` (`idordenproduccion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `seguimiento_produccion` */

insert  into `seguimiento_produccion`(`id_seguimiento_produccion`,`fecha_inicio_produccion`,`hora_inicio`,`idcliente`,`idordenproduccion`,`minutos`,`horas_a_trabajar`,`operarias`,`prendas_reales`,`descanso`) values 
(1,'2019-03-05','06:30 AM',1,13,29.42,9,8,0,0),
(2,'2019-02-23','07:00:00',1,14,2.6,9,8,167,10);

/*Table structure for table `seguimiento_produccion_detalle` */

DROP TABLE IF EXISTS `seguimiento_produccion_detalle`;

CREATE TABLE `seguimiento_produccion_detalle` (
  `id_seguimiento_produccion_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_seguimiento_produccion` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `hora_inicio` tinytext COLLATE utf8_spanish_ci,
  `fecha_consulta` date DEFAULT NULL,
  `hora_consulta` tinytext COLLATE utf8_spanish_ci,
  `minutos` float DEFAULT '0',
  `horas_a_trabajar` float DEFAULT '0',
  `cantidad_por_hora` float DEFAULT '0',
  `cantidad_total_por_hora` float DEFAULT '0',
  `operarias` float DEFAULT '0',
  `total_unidades_por_dia` float DEFAULT '0',
  `total_unidades_por_hora` float DEFAULT '0',
  `prendas_sistema` float DEFAULT '0',
  `prendas_reales` float DEFAULT '0',
  `porcentaje_produccion` float DEFAULT '0',
  PRIMARY KEY (`id_seguimiento_produccion_detalle`),
  KEY `id_seguimiento_produccion` (`id_seguimiento_produccion`),
  CONSTRAINT `seguimiento_produccion_detalle_ibfk_1` FOREIGN KEY (`id_seguimiento_produccion`) REFERENCES `seguimiento_produccion` (`id_seguimiento_produccion`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `seguimiento_produccion_detalle` */

insert  into `seguimiento_produccion_detalle`(`id_seguimiento_produccion_detalle`,`id_seguimiento_produccion`,`fecha_inicio`,`hora_inicio`,`fecha_consulta`,`hora_consulta`,`minutos`,`horas_a_trabajar`,`cantidad_por_hora`,`cantidad_total_por_hora`,`operarias`,`total_unidades_por_dia`,`total_unidades_por_hora`,`prendas_sistema`,`prendas_reales`,`porcentaje_produccion`) values 
(13,1,'2019-02-18','08:15:00','2019-02-18','13:44:12',26,9,2.31,20.79,8,166.32,18.48,94.6,167,176.53),
(14,1,'2019-02-18','08:15:00','2019-02-18','14:22:28',26,9,2.31,20.79,8,166.32,18.48,116.1,167,143.84),
(15,2,'2019-02-23','07:00:00','2019-02-18','19:12:13',2,9,30,270,8,2160,240,2911.2,167,5.74),
(16,1,'2019-02-25','18:00:00','2019-02-18','19:59:28',26,9,2.31,20.79,8,166.32,18.48,29.4,22,74.83),
(17,1,'2019-02-25','18:00:00','2019-02-18','20:04:17',26,8,2.31,18.48,8,147.84,18.48,44.4,8,18.02),
(18,1,'2019-02-25','18:00:00','2019-02-18','20:04:17',26,8,2.31,18.48,8,147.84,18.48,44.4,8,18.02),
(19,1,'2019-02-25','18:00:00','2019-02-18','22:51:14',26,9,2.31,20.79,8,166.32,18.48,83.3,11,13.21),
(20,2,'2019-02-23','07:00:00','2019-02-18','23:00:19',2,9,30,270,8,2160,240,3840,22,0.57),
(21,2,'2019-02-23','07:00:00','2019-02-18','23:00:48',2,9,30,270,8,2160,240,3840,3500,91.15),
(22,2,'2019-02-23','07:00:00','2019-02-18','23:02:30',8,9,7.5,67.5,8,540,60,972,3500,360.08),
(23,1,'2019-02-25','18:00:00','2019-02-18','23:29:56',10,9,6,54,8,432,48,253.9,167,65.77),
(26,1,'2019-02-25','18:00:00','2019-02-18','10:52:58',26,9,2.31,20.79,8,166.32,18.48,142,167,117.61),
(27,1,'2019-02-25','18:00:00','2019-02-18','11:33:04',26,9,2.31,20.79,8,166.32,18.48,115.7,167,144.34),
(28,1,'2019-03-05','06:30 AM','2019-03-06','14:41:17',29.42,9,2.04,18.36,8,146.88,16.32,132.4,0,0);

/*Table structure for table `seguimiento_produccion_detalle2` */

DROP TABLE IF EXISTS `seguimiento_produccion_detalle2`;

CREATE TABLE `seguimiento_produccion_detalle2` (
  `id_seguimiento_produccion_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_seguimiento_produccion` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `hora_inicio` tinytext COLLATE utf8_spanish_ci,
  `fecha_consulta` date DEFAULT NULL,
  `hora_consulta` tinytext COLLATE utf8_spanish_ci,
  `minutos` float DEFAULT '0',
  `horas_a_trabajar` float DEFAULT '0',
  `cantidad_por_hora` float DEFAULT '0',
  `cantidad_total_por_hora` float DEFAULT '0',
  `operarias` float DEFAULT '0',
  `total_unidades_por_dia` float DEFAULT '0',
  `total_unidades_por_hora` float DEFAULT '0',
  `prendas_sistema` float DEFAULT '0',
  `prendas_reales` float DEFAULT '0',
  `porcentaje_produccion` float DEFAULT '0',
  PRIMARY KEY (`id_seguimiento_produccion_detalle`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `seguimiento_produccion_detalle2` */

insert  into `seguimiento_produccion_detalle2`(`id_seguimiento_produccion_detalle`,`id_seguimiento_produccion`,`fecha_inicio`,`hora_inicio`,`fecha_consulta`,`hora_consulta`,`minutos`,`horas_a_trabajar`,`cantidad_por_hora`,`cantidad_total_por_hora`,`operarias`,`total_unidades_por_dia`,`total_unidades_por_hora`,`prendas_sistema`,`prendas_reales`,`porcentaje_produccion`) values 
(1,NULL,'2019-03-05','06:30 AM','2019-03-06','14:41:17',29.42,9,2.04,18.36,8,146.88,16.32,132.4,0,0);

/*Table structure for table `stockdescargas` */

DROP TABLE IF EXISTS `stockdescargas`;

CREATE TABLE `stockdescargas` (
  `idstockorden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stock` int(11) DEFAULT NULL,
  `idfactura` int(15) DEFAULT NULL,
  `nrofactura` int(20) DEFAULT NULL,
  `idordenproduccion` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `observacion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idstockorden`),
  KEY `idfactura` (`idfactura`),
  KEY `idordenproduccion` (`idordenproduccion`),
  KEY `idproducto` (`idproducto`),
  CONSTRAINT `stockdescargas_ibfk_1` FOREIGN KEY (`idfactura`) REFERENCES `facturaventa` (`idfactura`),
  CONSTRAINT `stockdescargas_ibfk_2` FOREIGN KEY (`idordenproduccion`) REFERENCES `ordenproduccion` (`idordenproduccion`),
  CONSTRAINT `stockdescargas_ibfk_3` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `stockdescargas` */

/*Table structure for table `talla` */

DROP TABLE IF EXISTS `talla`;

CREATE TABLE `talla` (
  `idtalla` int(11) NOT NULL AUTO_INCREMENT,
  `talla` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtalla`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `talla` */

insert  into `talla`(`idtalla`,`talla`,`sexo`) values 
(1,'XS','MUJER'),
(2,'S','MUJER'),
(3,'M','MUJER'),
(4,'L','MUJER'),
(5,'XL','MUJER');

/*Table structure for table `tipo_cargo` */

DROP TABLE IF EXISTS `tipo_cargo`;

CREATE TABLE `tipo_cargo` (
  `id_tipo_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tipo_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tipo_cargo` */

insert  into `tipo_cargo`(`id_tipo_cargo`,`tipo`) values 
(1,'OPERATIVO'),
(2,'ADMINISTRATIVO');

/*Table structure for table `tipo_regimen` */

DROP TABLE IF EXISTS `tipo_regimen`;

CREATE TABLE `tipo_regimen` (
  `id_tipo_regimen` int(11) NOT NULL AUTO_INCREMENT,
  `regimen` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_regimen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tipo_regimen` */

insert  into `tipo_regimen`(`id_tipo_regimen`,`regimen`) values 
(1,'RÉGIMEN COMÚN'),
(2,'RÉGIMEN SIMPLIFICADO');

/*Table structure for table `tipodocumento` */

DROP TABLE IF EXISTS `tipodocumento`;

CREATE TABLE `tipodocumento` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(10) NOT NULL,
  `descripcion` varchar(40) NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tipodocumento` */

insert  into `tipodocumento`(`idtipo`,`tipo`,`descripcion`) values 
(1,'CC','CEDULA DE CIUDADANIA'),
(2,'CE','CEDULA EXTRANJERIA'),
(3,'RC','REGISTRO CIVIL'),
(4,'PS','PASAPORTE'),
(5,'NIT','NUMERO DE IDENTIFICACION TRIBUTARIA');

/*Table structure for table `tiporecibo` */

DROP TABLE IF EXISTS `tiporecibo`;

CREATE TABLE `tiporecibo` (
  `idtiporecibo` int(10) NOT NULL AUTO_INCREMENT,
  `concepto` char(30) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtiporecibo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `tiporecibo` */

insert  into `tiporecibo`(`idtiporecibo`,`concepto`,`activo`) values 
(1,'RECIBO DE CAJA',0),
(2,'RECIBO DE CAJA',0),
(3,'TERCERO',0),
(4,'PRESTAMO BANACRIA',0),
(5,'TERCERO EN APORTES',0),
(6,'PRUEBA PRUEBA',0),
(7,'TERCERO',0),
(9,'RECIBO DE TEMPORALIDAD',0),
(10,'ABONO DE BANCO',0),
(11,'ABONO DE FACTURA',0),
(12,'APORTES DE SOCIO',0),
(13,'REGALO NAVIDEÑO',0),
(14,'REGISTRO DE ENTRADA',0);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `codusuario` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL DEFAULT '1',
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `documentousuario` varchar(15) NOT NULL,
  `nombrecompleto` varchar(60) NOT NULL,
  `emailusuario` varchar(80) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `fechaproceso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `authKey` varchar(250) NOT NULL,
  `accessToken` varchar(250) NOT NULL,
  PRIMARY KEY (`codusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`codusuario`,`role`,`username`,`password`,`documentousuario`,`nombrecompleto`,`emailusuario`,`activo`,`fechaproceso`,`authKey`,`accessToken`) values 
(1,2,'71268830','fsvcwST6rx8GU','71268830','Pablo Andres Aranzazu A','paul6126q@hotmail.com',1,'2019-01-08 19:52:50','bb602ba143bab0f2862a5fa73f6bb39d0c3ba78db764d8260da30233cab5f170ba6471b8796d4eb8e37b041dc36caec1c7fab951a9c312a926b173641a81a96021df5047278743f7c855401adff5016dfa2244ac13bad3a3c7576b1de2c6c8c820d3a66f','5d3ac1bd25b7f48f53f5ed81b5e2667ff5182d25e065ec4f329360a8a75f75fe0b65d6fb0a80217c6f8e502df81af1ca6f0fee2f810ad4f80ad79f01a643db05310754b167e2e5e2f39f3c42b3d9039e517e28a1aa2855295aa437e12dcea994df3259f0'),
(2,2,'ADMINISTRADOR','fsNzvvKC7dV0Y','70854409','JOSE GREGORIO PULGARIN','jgpmorales1975@hotmail.com',1,'2019-01-08 19:54:11','777d588d9d8b1f2d719f8b87cf44477a646620bf0cb2e10451f3462531d60ccc4836eec751bf99c2283df7a8795da705f1eb72b58ba22675c45e7ff197ab27139176ec799c6a9aff5754dc309bef8e0816e74d238319e45ecf302f5575f9bbd2613f73b3','509e13940de3484035f9dd93a36c8f2a030919bf328b4721dbced629ba7f8166ac4a05c14c093ce8578ab596b86959981b70d6a92d6ef885b91c79e99b3807a0607d8e66f3a899f80194142145edac9e9b601c0a90c820512fe29530e4791652ac298f93'),
(3,1,'facturacion','fsoeOgaYDvnqM','43186015','SandraMilenaGonzalez','jgpmoralles1975@hotmail.com',1,'2019-01-17 16:19:35','9cc88d44740f40a458256c40d4f69ee5e32f924f1379343a4eb32071229832a289d316b81042873ea39f4301de9724dd9df6e77e7b78389056e9d3fff8f58467fe671793340d37407681b14b60b0424ece36a4165bffa46fe587fef436ca6e93eb73aff7','d1407febc1fba81c6a41e746770ef935b4fea8b5fcbda182fc27bf485107a0e2050b3efd95ed0756ed6af5b7a85ec5eda46513948b6bcb873b0c99845e133945a13e6688e057fe17e70b9baf51260a0c0c6417eaa3917e05f169fb38c3973921c5f926aa');

/*Table structure for table `usuario_detalle` */

DROP TABLE IF EXISTS `usuario_detalle`;

CREATE TABLE `usuario_detalle` (
  `codusuario_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `codusuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codusuario_detalle`),
  KEY `codusuario` (`codusuario`),
  KEY `id_permiso` (`id_permiso`),
  CONSTRAINT `usuario_detalle_ibfk_1` FOREIGN KEY (`codusuario`) REFERENCES `usuario` (`codusuario`),
  CONSTRAINT `usuario_detalle_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuario_detalle` */

insert  into `usuario_detalle`(`codusuario_detalle`,`codusuario`,`id_permiso`,`activo`) values 
(121,1,1,0),
(122,1,2,0),
(123,1,3,0),
(124,1,4,0),
(125,1,5,0),
(126,1,6,0),
(127,1,7,0),
(128,1,8,0),
(129,1,9,0),
(130,1,10,0),
(131,1,11,0),
(132,1,12,0),
(133,1,13,0),
(134,1,14,0),
(135,1,15,0),
(136,1,16,0),
(137,1,17,0),
(138,1,18,0),
(139,1,19,0),
(140,1,20,0),
(141,1,21,0),
(142,1,22,0),
(143,1,23,0),
(144,1,24,0),
(145,1,25,0),
(146,1,26,0),
(147,1,27,0),
(148,1,28,0),
(149,1,29,0),
(150,1,30,0),
(151,2,1,0),
(152,2,2,0),
(153,2,3,0),
(154,2,4,0),
(155,2,5,0),
(156,2,6,0),
(157,2,7,0),
(158,2,8,0),
(159,2,9,0),
(160,2,10,0),
(161,2,11,0),
(162,2,12,0),
(163,2,13,0),
(164,2,14,0),
(165,2,15,0),
(166,2,16,0),
(167,2,17,0),
(168,2,18,0),
(169,2,19,0),
(170,2,20,0),
(171,2,21,0),
(172,2,22,0),
(173,2,23,0),
(174,2,24,0),
(175,2,25,0),
(176,2,26,0),
(177,2,27,0),
(178,2,28,0),
(179,2,29,0),
(180,2,30,0),
(181,1,31,0),
(182,1,32,0),
(183,1,33,0),
(184,1,34,0),
(185,1,35,0),
(186,1,36,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
