/*
SQLyog Community v12.2.1 (64 bit)
MySQL - 10.1.9-MariaDB : Database - maquiladigital
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`maquiladigital` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `maquiladigital`;

/*Table structure for table `banco` */

DROP TABLE IF EXISTS `banco`;

CREATE TABLE `banco` (
  `idbanco` char(10) NOT NULL,
  `nitbanco` char(15) NOT NULL,
  `entidad` char(40) NOT NULL,
  `direccionbanco` char(40) NOT NULL,
  `telefonobanco` char(15) NOT NULL,
  `producto` char(15) NOT NULL,
  `numerocuenta` char(15) NOT NULL,
  `nitmatricula` char(15) NOT NULL,
  `activo` char(2) NOT NULL,
  PRIMARY KEY (`idbanco`),
  KEY `nitmatricula` (`nitmatricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `banco` */

insert  into `banco`(`idbanco`,`nitbanco`,`entidad`,`direccionbanco`,`telefonobanco`,`producto`,`numerocuenta`,`nitmatricula`,`activo`) values 
('1015','900456778','BANCO DAVIVIEND','CL 45 -56 56','4448120','CORRIENTE','257-41830918','901189320','SI'),
('10154545','ADADA','ADASD','ADASDAS','4545545','AHORRO','SDASDASD','901189320','SI'),
('1020','8909212121','BANCOLOMBIA SA','CL 45 -56 -56','4448120','AHORROO','102045645645','901189320','SI');

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
  `direccioncliente` varchar(40) NOT NULL,
  `telefonocliente` char(15) NOT NULL,
  `celularcliente` char(15) NOT NULL,
  `emailcliente` char(40) NOT NULL,
  `contacto` char(40) NOT NULL,
  `telefonocontacto` char(15) NOT NULL,
  `celularcontacto` char(15) NOT NULL,
  `formapago` char(15) NOT NULL,
  `plazopago` int(11) DEFAULT NULL,
  `iddepartamento` char(10) NOT NULL,
  `idmunicipio` char(10) NOT NULL,
  `nitmatricula` char(15) NOT NULL,
  `tiporegimen` char(15) NOT NULL,
  `autoretenedor` char(2) NOT NULL,
  `retencioniva` char(2) NOT NULL,
  `retencionfuente` char(2) NOT NULL,
  `observacion` longtext NOT NULL,
  `fechaingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcliente`),
  KEY `idepartamento` (`iddepartamento`),
  KEY `nitmatricula` (`nitmatricula`),
  KEY `idmunicipio` (`idmunicipio`),
  KEY `idtipo` (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `cliente` */

insert  into `cliente`(`idcliente`,`idtipo`,`cedulanit`,`dv`,`razonsocial`,`nombrecliente`,`apellidocliente`,`nombrecorto`,`direccioncliente`,`telefonocliente`,`celularcliente`,`emailcliente`,`contacto`,`telefonocontacto`,`celularcontacto`,`formapago`,`plazopago`,`iddepartamento`,`idmunicipio`,`nitmatricula`,`tiporegimen`,`autoretenedor`,`retencioniva`,`retencionfuente`,`observacion`,`fechaingreso`) values 
(2,1,70854409,8,'JOSE GREGORIO PULGARIN','','','JOSE GREGORIO PULGARIN','CL 45 -56 45','4545454','64564545','jose@hotmail.com','AJAS DHASJDHASJDH','4545454','44545455','CONTADO',30,'05','17','901189320','COMUN','SI','SI','SI','ADASDASDAS','2018-10-05 11:16:00'),
(3,1,70855467,8,'WALTER PULGARIN MORALES','','','WALTER PULGARIN MORALES','CL 45 -56 45','4545454','64564545','jose@hotmail.com','AJAS DHASJDHASJDH','4545454','44545455','CONTADO',30,'05','16','901189320','SIMPLIFICADO','NO','NO','NO','DKADA','2018-10-05 11:16:05'),
(4,1,2147483647,1,'EL DINERO PUNTO COM','','','EL DINERO PUNTO COM','CK 45 - 565 454','2524545','6454545','jose@hotmail.com','454545454','45454545','54545454','CONTADO',0,'05','16','901189320','SIMPLIFICADO','NO','NO','NO','FDFSDFSD','2018-10-05 11:16:12'),
(6,1,71268830,0,'pollos pablo','pablo an','aranzazu a','pollos pablo','cra 34','222','2227','paul6126@hotmail.com','adadasdasss sds','222','444','1',12,'02','1','123','1','si','1','1','','2018-10-05 11:16:21'),
(9,1,712688304,0,NULL,'pablo an','aranzazu a','aaaaaaaaaaaaaaaa','cra 34','222','2227','paul612662@hotmail.com','adadasda','222','444','1',NULL,'05','10','1232','1','si','1','1','','2018-10-06 08:45:33'),
(10,5,2147483647,0,'abi y asociados','','','abi y asociados','cra 34','222','2227','abi01@hotmail.com','adadasda','222','444','1',NULL,'05','10','2234','1','si','1','1','','2018-10-06 11:09:31'),
(11,5,36525525,1,'pablo y asociados','','','pablo y asociados','cra 34','222','300','abi012@hotmail.com','adadasda','222','444','1',4,'02','10','1232444','1','si','1','1','','2018-10-06 11:22:26'),
(12,5,365255235,8,'pablo y asociados','','','pablo y asociados','cra 34','222','300','abi3012@hotmail.com','adadasda','222','444','1',4,'05','10','12324443','1','si','1','1','aaaaaaa','2018-10-06 11:17:13'),
(13,1,5648755,9,'','jotge daniel','aranzazu a','jotge daniel aranzazu a','cra 34','222','300','ppaul6126@hotmail.com','adadasda','222','4444','2',15,'05','27','1232445','1','si','1','1','asdasdasd','2018-10-06 11:24:12'),
(14,1,712688308,9,'','juan jose','perea lopez','juan jose perea lopez','cra 34','2222222','2227','paul61333326@hotmail.com','adadasda','222','444','1',10,'05','10','123222','2','si','1','1','hola','2018-10-07 14:55:06');

/*Table structure for table `departamento` */

DROP TABLE IF EXISTS `departamento`;

CREATE TABLE `departamento` (
  `iddepartamento` char(10) NOT NULL,
  `nombredepartamento` char(40) NOT NULL,
  `activo` char(2) NOT NULL,
  PRIMARY KEY (`iddepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `departamento` */

insert  into `departamento`(`iddepartamento`,`nombredepartamento`,`activo`) values 
('02','CORDOBA','SI'),
('05','ANTIOQUIA','SI'),
('06','RISARALDAS','SI'),
('07','CALDAS','SI'),
('10','MANIZALES','SI'),
('15','SUCRE','SI'),
('19','VAUPEZ','SI'),
('25','CUNDINAMARCA','SI'),
('26','GUAJIRA','SI'),
('36','rio hacha','SI');

/*Table structure for table `detallefacturaventa` */

DROP TABLE IF EXISTS `detallefacturaventa`;

CREATE TABLE `detallefacturaventa` (
  `idetallefactura` int(11) NOT NULL AUTO_INCREMENT,
  `nrofactura` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `codigoproducto` char(15) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciounitario` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`idetallefactura`),
  KEY `idproducto` (`idproducto`),
  KEY `nrofactura` (`nrofactura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detallefacturaventa` */

/*Table structure for table `detalleordenproduccion` */

DROP TABLE IF EXISTS `detalleordenproduccion`;

CREATE TABLE `detalleordenproduccion` (
  `idetalleorden` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `vlrprecio` double NOT NULL,
  `subtotal` double NOT NULL,
  `idordenproduccion` int(11) NOT NULL,
  PRIMARY KEY (`idetalleorden`),
  KEY `idproducto` (`idproducto`),
  KEY `idordenproduccion` (`idordenproduccion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detalleordenproduccion` */

/*Table structure for table `detallerecibocaja` */

DROP TABLE IF EXISTS `detallerecibocaja`;

CREATE TABLE `detallerecibocaja` (
  `idetallerecibo` int(11) NOT NULL AUTO_INCREMENT,
  `idfactura` int(11) NOT NULL,
  `vlrabono` double NOT NULL,
  `vlrsaldo` double NOT NULL,
  `retefuente` double NOT NULL,
  `reteiva` double NOT NULL,
  `reteica` double NOT NULL,
  `idrecibo` int(11) NOT NULL,
  `observacion` longtext NOT NULL,
  PRIMARY KEY (`idetallerecibo`),
  KEY `idfactura` (`idfactura`),
  KEY `idrecibo` (`idrecibo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detallerecibocaja` */

/*Table structure for table `facturaventa` */

DROP TABLE IF EXISTS `facturaventa`;

CREATE TABLE `facturaventa` (
  `nrofactura` int(11) NOT NULL AUTO_INCREMENT,
  `fechainicio` date NOT NULL,
  `fechavcto` date NOT NULL,
  `formapago` char(15) NOT NULL,
  `plazopago` int(11) NOT NULL,
  `porcentajeiva` double NOT NULL,
  `porcentajefuente` double NOT NULL,
  `porcentajereteiva` double NOT NULL,
  `subtotal` double NOT NULL,
  `retencionfuente` double NOT NULL,
  `impuestoiva` double NOT NULL,
  `retencioniva` double NOT NULL,
  `totalpagar` double NOT NULL,
  `valorletras` longtext NOT NULL,
  `idcliente` int(15) NOT NULL,
  `idordenproduccion` int(11) NOT NULL,
  `usuariosistema` char(15) NOT NULL,
  PRIMARY KEY (`nrofactura`),
  KEY `idordenproduccion` (`idordenproduccion`),
  KEY `idcliente` (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturaventa` */

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
  `iddepartamento` char(10) NOT NULL,
  `idmunicipio` char(10) NOT NULL,
  `paginaweb` char(40) NOT NULL,
  PRIMARY KEY (`nitmatricula`),
  KEY `iddepartamento` (`iddepartamento`),
  KEY `idmunicipio` (`idmunicipio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matriculaempresa` */

insert  into `matriculaempresa`(`nitmatricula`,`dv`,`razonsocialmatricula`,`nombrematricula`,`apellidomatricula`,`direccionmatricula`,`telefonomatricula`,`celularmatricula`,`emailmatricula`,`iddepartamento`,`idmunicipio`,`paginaweb`) values 
('901189320',2,'MAQUILA DIGITAL SAS','JOSE GREGORIO','PULGARIN MORALES','CR 87 # 45 - 56','4448120','3105177348','jose@hotmail.com','05','16','WWW-MAQUILA.COM');

/*Table structure for table `municipio` */

DROP TABLE IF EXISTS `municipio`;

CREATE TABLE `municipio` (
  `idmunicipio` char(10) NOT NULL,
  `municipio` char(40) NOT NULL,
  `iddepartamento` char(10) NOT NULL,
  `activo` char(2) NOT NULL,
  PRIMARY KEY (`idmunicipio`),
  KEY `iddepartameto` (`iddepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `municipio` */

insert  into `municipio`(`idmunicipio`,`municipio`,`iddepartamento`,`activo`) values 
('1','SABANETAASDA','05','NO'),
('10','MEDELLIN','05','NO'),
('15','CALDASSDASD','06','NO'),
('16','ENVIGADO','07','SI'),
('17','LA INVACACION','06','SI'),
('2','COPACABANA','07','SI'),
('25','CALI','06','SI'),
('26','PEREIRA','07','SI'),
('27','CALDAS','05','SI'),
('28','VENECIA','05','SI'),
('29','AMAGA','05','SI'),
('30','FREDONIA','05','SI');

/*Table structure for table `ordenproduccion` */

DROP TABLE IF EXISTS `ordenproduccion`;

CREATE TABLE `ordenproduccion` (
  `idordeproduccion` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `fechallegada` date NOT NULL,
  `fechaprocesada` date NOT NULL,
  `fechaentrega` date NOT NULL,
  `totalorden` char(15) NOT NULL,
  `valorletras` longtext NOT NULL,
  `observacion` longtext NOT NULL,
  `estado` char(15) NOT NULL,
  `usuariosistema` char(15) NOT NULL,
  PRIMARY KEY (`idordeproduccion`),
  KEY `idcliente` (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ordenproduccion` */

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `codigoproducto` char(15) NOT NULL,
  `producto` char(40) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `costoconfeccion` int(11) NOT NULL,
  `vlrventa` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `observacion` longtext NOT NULL,
  `activo` char(2) NOT NULL,
  `fechaproceso` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usuariosistema` char(15) DEFAULT 'ADMON',
  PRIMARY KEY (`idproducto`),
  KEY `idcliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `producto` */

insert  into `producto`(`idproducto`,`codigoproducto`,`producto`,`cantidad`,`stock`,`costoconfeccion`,`vlrventa`,`idcliente`,`observacion`,`activo`,`fechaproceso`,`usuariosistema`) values 
(1,'1015','CAMISA MUESTRA TEXLAB',125,125,1500,3000,3,'ADAS','SI','2018-07-05 00:00:00','ADMON'),
(2,'1020','BLUSA DE CHALIS',10,10,1500,3000,3,'1212','SI','2018-07-05 00:00:00','ADMON'),
(6,'3015','CAMISA DE CHALIS LINDA',150,150,2000,5500,3,'ADAS','SI','2018-07-01 00:00:00','ADMON'),
(7,'20410','CAMISA DE BISTES',150,150,1500,3000,2,'SON DE CAMISA BANCA','NO','2018-07-06 00:00:00','ADMON'),
(8,'152525','ADJHASJ ASJDAJ SDJAS',350,350,250,2500,2,'ASDA','NO','2018-07-06 00:00:00','ADMON'),
(9,'4545','ASD,ASDA',25,25,25,25,2,'ASDA','NO','2018-07-06 00:00:00','ADMON'),
(10,'4545','ASD,ASDA',25,25,25,25,2,'ASDA','NO','2018-07-06 00:00:00','ADMON'),
(11,'2121','MUESTRAS',25,25,25,25,2,'ASDA','SI','2018-07-06 00:00:00','ADMON'),
(12,'2222','DBASDBABASNDNABDA',10,10,25000,25000,2,'ASD','SI','2018-07-06 00:00:00','ADMON'),
(13,'1515454','10QASDASDA',10,10,1500,5000,3,'54545','SI','2018-07-06 00:00:00','ADMON'),
(14,'25454411','CAMISA DE CUADROS',10,10,1500,3000,3,'ASDAS','SI','2018-08-12 00:00:00','ADMON'),
(15,'252','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(16,'256656','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(17,'5659','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(18,'6565','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(19,'76554','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(20,'856556','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(21,'E4545','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(22,'98989','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(23,'412012','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(24,'452447','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(25,'452447','ADJHASJDHAJ',41,41,1500,15000,2,'','SI','2018-08-12 00:00:00','ADMON'),
(26,'454545','ADFAFAFDAJFH',10,10,15000,15000,2,'ADASDASDAS','SI','2018-08-16 00:00:00','ADMON'),
(27,'5454545','MUESTRAS',25,25,1500,15000,3,'ASDAS','SI','2018-08-16 19:28:12','ADMON'),
(28,'151515','ADADASD',250,250,1262,4490,2,'ADASDASASDASD','SI','2018-08-16 19:53:43','ADMON'),
(29,'121212','MUESTRAS',10,10,1500,3000,3,'ADASDASDAS','SI','2018-08-16 20:00:02','ADMON');

/*Table structure for table `recibocaja` */

DROP TABLE IF EXISTS `recibocaja`;

CREATE TABLE `recibocaja` (
  `idrecibo` int(11) NOT NULL AUTO_INCREMENT,
  `fecharecibo` date NOT NULL,
  `fechapago` date NOT NULL,
  `idtiporecibo` char(10) NOT NULL,
  `idciudad` int(11) NOT NULL,
  `valorpagado` double NOT NULL,
  `valorletras` longtext NOT NULL,
  `idcliente` int(11) NOT NULL,
  `observacion` longtext NOT NULL,
  `usuariosistema` char(15) NOT NULL,
  PRIMARY KEY (`idrecibo`),
  KEY `idcliente` (`idcliente`),
  KEY `idciudad` (`idciudad`),
  KEY `idtiporecibo` (`idtiporecibo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `recibocaja` */

/*Table structure for table `resolucion` */

DROP TABLE IF EXISTS `resolucion`;

CREATE TABLE `resolucion` (
  `idresolucion` int(11) NOT NULL AUTO_INCREMENT,
  `nroresolucion` char(40) NOT NULL,
  `desde` char(10) NOT NULL,
  `hasta` char(10) NOT NULL,
  `fechavencimiento` date NOT NULL,
  `nitmatricula` char(11) NOT NULL,
  `activo` char(2) NOT NULL,
  PRIMARY KEY (`idresolucion`),
  KEY `nitmatricula` (`nitmatricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `resolucion` */

/*Table structure for table `tipodocumento` */

DROP TABLE IF EXISTS `tipodocumento`;

CREATE TABLE `tipodocumento` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` char(10) NOT NULL,
  `descripcion` char(40) NOT NULL,
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
  `idtiporecibo` char(10) NOT NULL,
  `concepto` char(30) NOT NULL,
  `activo` char(2) NOT NULL,
  PRIMARY KEY (`idtiporecibo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tiporecibo` */

insert  into `tiporecibo`(`idtiporecibo`,`concepto`,`activo`) values 
('1','RECIBO DE CAJA','NO'),
('10','TERCERO','NO'),
('11','TERCERO EN APORTES','NO'),
('12','PRUEBA PRUEBA','NO'),
('13','ABONO A FACTURAA','NO'),
('14','TERCERO','SI'),
('145','RECIBO DE CAJA','SI'),
('15','ADAJDHASJD','SI'),
('16','ADASDA','SI'),
('17','AJDHASDAS','SI'),
('18','ADASDAS','SI'),
('19','DADADA','SI'),
('2','RECIBO DE CAJA','NO'),
('3','ABONO A AFACTURAA','NO'),
('30','RECIBO DE TEMPORALIDAD','SI'),
('31','RECIVO DE CAJA','SI'),
('33','ABONO ADE BANCO','SI'),
('39','TECERO','SI'),
('4','PRESTAMO BANACRIA','NO'),
('40','APORTES DE SOCIO','SI'),
('42',' REGALO NAVIDEÑO','SI'),
('43','REGISTRO DE ENTRADA','SI'),
('44','TERCERO','SI'),
('454545','ASDASDASDASD','SI'),
('5','JHJHJHJHJ','SI'),
('5454','DFDSFSDF','SI'),
('54545','ASDASD','SI'),
('55','ADASJ','SI'),
('565656','DFDSFSDF','SI'),
('56855','CUARTO','SI'),
('6','ADASKDJASK','SI'),
('7','SDFSDKFSDF','SI'),
('8','AJDHASDHASJDAJ','SI'),
('9','TERCERO DEL','SI'),
('ADASD','DASDASDAS','SI');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`codusuario`,`role`,`username`,`password`,`documentousuario`,`nombrecompleto`,`emailusuario`,`activo`,`fechaproceso`,`authKey`,`accessToken`) values 
(11,1,'71268830','fsvcwST6rx8GU','71268830','pablo','paul6126q@hotmail.com',1,'2018-10-05 10:07:23','bb602ba143bab0f2862a5fa73f6bb39d0c3ba78db764d8260da30233cab5f170ba6471b8796d4eb8e37b041dc36caec1c7fab951a9c312a926b173641a81a96021df5047278743f7c855401adff5016dfa2244ac13bad3a3c7576b1de2c6c8c820d3a66f','5d3ac1bd25b7f48f53f5ed81b5e2667ff5182d25e065ec4f329360a8a75f75fe0b65d6fb0a80217c6f8e502df81af1ca6f0fee2f810ad4f80ad79f01a643db05310754b167e2e5e2f39f3c42b3d9039e517e28a1aa2855295aa437e12dcea994df3259f0');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
