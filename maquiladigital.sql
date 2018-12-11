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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `archivodir` */

insert  into `archivodir`(`idarchivodir`,`iddocumentodir`,`fecha_creacion`,`numero`,`iddirectorio`,`codigo`,`nombre`,`extension`,`tipo`,`tamaño`,`descripcion`,`comentarios`) values 
(39,3,'2018-12-05 14:37:09',3,1,7,'Factura8.pdf','pdf','application/pdf',394049,'FACTURA 8',NULL),
(40,4,'2018-12-05 14:45:07',4,1,32,'dsds.pdf','pdf','application/pdf',1970,'DSDSD',NULL),
(41,4,'2018-12-05 14:50:55',4,1,32,'96030503636773488595400190.pdf','pdf','application/pdf',272346,'AAAA',NULL),
(42,1,'2018-12-05 15:05:48',1,1,4,'Factura8 (1).pdf','pdf','application/pdf',394049,'FACTURA',NULL),
(43,1,'2018-12-05 15:11:41',1,1,4,'dsds.pdf','pdf','application/pdf',1970,'PRUEBA 2',NULL),
(44,1,'2018-12-05 15:12:04',1,1,4,'Factura8 (2).pdf','pdf','application/pdf',394049,'PRUEBA 3',NULL),
(45,4,'2018-12-05 15:12:40',4,1,32,'dsds.pdf','pdf','application/pdf',1970,'PRUEBA',NULL),
(46,2,'2018-12-05 15:16:01',2,1,2,'dsds.pdf','pdf','application/pdf',1970,'PRUEBA',NULL),
(47,5,'2018-12-05 15:23:01',5,1,28,'94932961636718189996652759 (1).pdf','pdf','application/pdf',271821,'PRUEBA',NULL),
(48,5,'2018-12-05 16:02:07',5,1,28,'dsds.pdf','pdf','application/pdf',1970,'PRUEBA',NULL),
(49,5,'2018-12-05 16:02:45',5,1,26,'dsds.pdf','pdf','application/pdf',1970,'PRUEBA',NULL),
(50,4,'2018-12-05 18:26:35',4,1,30,'dsds.pdf','pdf','application/pdf',1970,'PRUEBA',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `cliente` */

insert  into `cliente`(`idcliente`,`idtipo`,`cedulanit`,`dv`,`razonsocial`,`nombrecliente`,`apellidocliente`,`nombrecorto`,`direccioncliente`,`telefonocliente`,`celularcliente`,`emailcliente`,`contacto`,`telefonocontacto`,`celularcontacto`,`formapago`,`plazopago`,`iddepartamento`,`idmunicipio`,`nitmatricula`,`tiporegimen`,`autoretenedor`,`retencioniva`,`retencionfuente`,`observacion`,`fechaingreso`) values 
(2,1,70854409,8,'JOSE GREGORIO PULGARIN','JOSE GREGORIO','PULGARIN','JOSE GREGORIO PULGARIN','CL 45 -56 45','4545454','64564545','jose1@hotmail.com','AJAS DHASJDHASJDH','4545454','44545455','1',30,'05','05001','70854409','1',1,1,1,'ADASDASDAS','2018-11-05 11:33:58'),
(3,1,70855467,8,'WALTER PULGARIN MORALES','WALTER','PULGARIN','WALTER PULGARIN','CL 45 -56 45','4545454','64564545','jose2@hotmail.com','AJAS DHASJDHASJDH','4545454','44545455','1',30,'05','05001','70855467','1',1,1,1,'DKADA','2018-11-06 11:31:47'),
(24,5,1020304050,8,'FABRICATO SA','','','FABRICATO SA','CRA 86 # 96-69','258','301','fabricato@hotmail.com','PABLO','369','302','1',0,'05','05040','1020304050','2',0,1,1,'HOLA','2018-11-05 11:16:37'),
(25,1,71268830,6,'','PABLO ANDRES','ARANZAZU ATUESTA','PABLO ANDRES ARANZAZU ATUESTA','CRA 3','254','301','paul6126@hotmail.com','ABI','256','302','2',20,'05','05001','71268830','1',1,1,1,'HOLA','2018-11-05 10:19:43'),
(26,5,901189320,2,'TENNIS SA','','','TENNIS SA','CRA T','213','300','tennis@hotmail.com','TENNIS','234','231','2',15,'05','05001','901189320','1',1,1,1,'TENNIS','2018-11-13 14:20:58'),
(28,1,334343,5,'','PABLO AN','ARANZAZU A','PABLO AN ARANZAZU A','','222','','abi012444@hotmail.com','','','','1',NULL,'05','05001','334343','1',1,1,1,'','2018-11-20 09:45:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `consecutivo` */

insert  into `consecutivo`(`consecutivo_pk`,`nombre`,`consecutivo`) values 
(1,'FACTURA DE VENTA',10),
(2,'NOTA CREDITO',1),
(3,'RECIBO CAJA',6);

/*Table structure for table `costo_fijo` */

DROP TABLE IF EXISTS `costo_fijo`;

CREATE TABLE `costo_fijo` (
  `id_costo_fijo` int(11) NOT NULL AUTO_INCREMENT,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id_costo_fijo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `costo_fijo` */

insert  into `costo_fijo`(`id_costo_fijo`,`valor`) values 
(1,5028000);

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
(8,1,'CAJA MENOR',400000),
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
(1,0,1259960,1466600,24650000,25909900,17,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `costo_laboral_detalle` */

insert  into `costo_laboral_detalle`(`id_costo_laboral_detalle`,`id_costo_laboral`,`nro_empleados`,`salario`,`auxilio_transporte`,`tiempo_extra`,`bonificacion`,`arl`,`pension`,`caja`,`prestaciones`,`vacaciones`,`ajuste_vac`,`subtotal`,`admon`,`total`,`id_tipo_cargo`,`id_arl`) values 
(1,1,1,1000000,88211,1600000,100000,27144,312000,104000,474738,45000,1800,3752890,225174,3978070,1,2),
(2,1,16,800000,88211,0,0,8352,96000,32000,156858,36000,1440,19501800,1170110,20671900,1,2),
(3,1,1,781242,88211,0,0,4078,93749,31250,153545,35156,1406,1188640,71318,1259960,2,1);

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
(1,8,60,60,60,26,51730.6,6466.3,107.8,1.8);

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
(1,2,30,5650,'414d','414d',1,4.2,420,13.45,134.5,16.81,1541.54,6474.47);

/*Table structure for table `departamento` */

DROP TABLE IF EXISTS `departamento`;

CREATE TABLE `departamento` (
  `iddepartamento` varchar(15) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `documentodir` */

insert  into `documentodir`(`iddocumentodir`,`codigodocumento`,`nombre`) values 
(1,1,'FACTURA VENTA'),
(2,2,'RECIBO CAJA'),
(3,3,'NOTA CREDITO'),
(4,4,'ORDEN PRODUCCION'),
(5,5,'CLIENTE');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `facturaventa` */

insert  into `facturaventa`(`idfactura`,`nrofactura`,`fechainicio`,`fechavcto`,`fechacreacion`,`formapago`,`plazopago`,`porcentajeiva`,`porcentajefuente`,`porcentajereteiva`,`subtotal`,`retencionfuente`,`impuestoiva`,`retencioniva`,`saldo`,`totalpagar`,`valorletras`,`idcliente`,`idordenproduccion`,`usuariosistema`,`idresolucion`,`estado`,`autorizado`,`observacion`) values 
(3,1,'2018-11-05','2018-12-05','2018-11-05 11:36:15','1',30,19,3.5,15,837500,0,159125,0,0,996625,'-',2,30,'71268830',3,0,1,NULL),
(4,2,'2018-11-20','2018-12-20','2018-11-06 11:32:26','1',30,19,0,15,397785,0,75579.15,0,0,473364.15,'-',3,32,'71268830',3,0,1,NULL),
(5,3,'2018-11-21','2018-12-21','2018-11-07 10:44:46','1',30,19,0,15,704483,0,133851.77,0,0,838334.77,'-',3,33,'71268830',3,0,1,NULL),
(6,4,'2018-11-07','2018-12-07','2018-11-07 11:02:56','1',30,19,0,15,278616,0,52937.04,0,0,331553.04,'-',3,34,'71268830',3,0,1,NULL),
(7,5,'2018-11-12','2018-12-12','2018-11-12 20:03:30','1',30,19,0,15,397785,0,75579.15,0,428364.15,473364.15,'-',3,32,'71268830',3,1,1,NULL),
(8,6,'2018-11-13','2018-11-28','2018-11-13 14:32:03','2',15,19,3.5,15,1037000,36295,197030,29554.5,492280.5,1168180.5,'-',26,36,'71268830',3,1,1,'dsdsdsd'),
(9,7,'2018-11-14','2018-11-29','2018-11-14 16:54:16','2',15,19,3.5,15,18300,0,3477,522,20093.95,21255.45,'-',26,37,'71268830',3,1,1,'ddf'),
(10,8,'2018-10-24','2018-11-13','2018-11-28 18:09:20','2',20,19,0,15,55760,0,10594.4,1589.16,0,64765.24,'-',25,42,'71268830',3,2,1,'DFDF'),
(11,9,'2018-10-24','2018-11-13','2018-11-28 18:25:25','2',20,19,0,15,94400,0,17936,2690.4,0,109645.6,'-',25,43,'71268830',3,2,1,'FGF'),
(12,10,'2018-10-25','2018-11-09','2018-11-29 11:49:28','2',15,19,3.5,15,9713600,339976,1845584,276837.6,10942370.4,10942370.4,'-',26,45,'71268830',3,0,1,'');

/*Table structure for table `facturaventadetalle` */

DROP TABLE IF EXISTS `facturaventadetalle`;

CREATE TABLE `facturaventadetalle` (
  `iddetallefactura` int(11) NOT NULL AUTO_INCREMENT,
  `idfactura` int(15) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `codigoproducto` char(15) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciounitario` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`iddetallefactura`),
  KEY `idproducto` (`idproducto`),
  KEY `nrofactura` (`idfactura`),
  CONSTRAINT `facturaventadetalle_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`),
  CONSTRAINT `facturaventadetalle_ibfk_2` FOREIGN KEY (`idfactura`) REFERENCES `facturaventa` (`idfactura`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

/*Data for the table `facturaventadetalle` */

insert  into `facturaventadetalle`(`iddetallefactura`,`idfactura`,`idproducto`,`codigoproducto`,`cantidad`,`preciounitario`,`total`) values 
(37,3,6,'w34',2500,335,837500),
(38,4,7,'136',288,345,99360),
(39,4,10,'136',577,345,199065),
(40,4,11,'136',288,345,99360),
(41,5,7,'136',288,611,175968),
(42,5,10,'136',577,611,352547),
(43,5,11,'136',288,611,175968),
(44,6,7,'136',228,611,139308),
(45,6,10,'136',228,611,139308),
(46,7,9,'136',288,345,99360),
(47,7,10,'136',577,345,199065),
(48,7,11,'136',288,345,99360),
(49,8,12,'136',1000,610,610000),
(50,8,13,'136',350,610,213500),
(51,8,14,'136',350,610,213500),
(52,9,12,'136',10,610,6100),
(53,9,13,'136',10,610,6100),
(54,9,14,'136',10,610,6100),
(55,10,15,'sds',20,1255,25100),
(56,10,16,'a23',20,1500,30000),
(57,10,17,'5010w',20,33,660),
(58,11,15,'sds',50,1255,62750),
(59,11,17,'5010w',50,33,1650),
(60,11,16,'a23',20,1500,30000),
(61,12,25,'23',467,10400,4856800),
(62,12,26,'23',219,10400,2277600),
(63,12,27,'23',248,10400,2579200);

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
  `tiporegimen` varchar(100) NOT NULL,
  `declaracion` text NOT NULL,
  `tipocuenta` varchar(100) NOT NULL,
  `numerocuenta` int(30) NOT NULL,
  `banco` varchar(100) NOT NULL,
  PRIMARY KEY (`nitmatricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matriculaempresa` */

insert  into `matriculaempresa`(`nitmatricula`,`dv`,`razonsocialmatricula`,`nombrematricula`,`apellidomatricula`,`direccionmatricula`,`telefonomatricula`,`celularmatricula`,`emailmatricula`,`iddepartamento`,`idmunicipio`,`paginaweb`,`porcentajeiva`,`porcentajeretefuente`,`retefuente`,`porcentajereteiva`,`tiporegimen`,`declaracion`,`tipocuenta`,`numerocuenta`,`banco`) values 
('901189320',2,'MAQUILA DIGITAL SAS','JOSE GREGORIO','PULGARIN MORALES','CR 87 # 45 - 56','4448120','3105177348','jose@hotmail.com','05','05001','WWW-MAQUILA.COM',19,3.5,895000,15,'RÉGIMEN COMÚN','Según lo establecido en la ley 1231 de julio 17/08, esta factura se entiende irrevocablemente aceptada, y se asimila en todos sus efectos a\r\nuna letra de cambio según el artículo 774 del código de comercio. Autorizo a la entidad MAQUILA DIGITAL S.A.S o a quien represente la\r\ncalidad de acreedor, a reportar, procesar, solicitar o divulgar a cualquier entidad que maneje o administre base de datos la información\r\nreferente a mi comportamiento comercial.','CUENTA DE AHORROS',502217367,'BANCO AVVILLAS');

/*Table structure for table `municipio` */

DROP TABLE IF EXISTS `municipio`;

CREATE TABLE `municipio` (
  `idmunicipio` varchar(15) NOT NULL,
  `codigomunicipio` varchar(15) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `iddepartamento` varchar(15) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `notacredito` */

insert  into `notacredito`(`idnotacredito`,`idcliente`,`fecha`,`fechapago`,`idconceptonota`,`valor`,`iva`,`reteiva`,`retefuente`,`total`,`numero`,`autorizado`,`anulado`,`usuariosistema`,`observacion`) values 
(7,26,'2018-11-15 15:31:48','2018-11-26',1,200000,38000,5700,7000,225300,1,1,0,'71268830','sds');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `notacreditodetalle` */

insert  into `notacreditodetalle`(`iddetallenota`,`fecha`,`idfactura`,`nrofactura`,`valor`,`usuariosistema`,`idnotacredito`) values 
(10,'2018-11-15 15:31:57',8,6,200000,'0',7);

/*Table structure for table `ordenproduccion` */

DROP TABLE IF EXISTS `ordenproduccion`;

CREATE TABLE `ordenproduccion` (
  `idordenproduccion` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `fechallegada` datetime NOT NULL,
  `fechaprocesada` datetime NOT NULL,
  `fechaentrega` datetime NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `totalorden` float DEFAULT '0',
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
  PRIMARY KEY (`idordenproduccion`),
  KEY `idcliente` (`idcliente`),
  KEY `idtipo` (`idtipo`),
  CONSTRAINT `ordenproduccion_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `ordenproduccion_ibfk_2` FOREIGN KEY (`idtipo`) REFERENCES `ordenproducciontipo` (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `ordenproduccion` */

insert  into `ordenproduccion`(`idordenproduccion`,`idcliente`,`fechallegada`,`fechaprocesada`,`fechaentrega`,`cantidad`,`totalorden`,`valorletras`,`observacion`,`estado`,`ordenproduccion`,`idtipo`,`usuariosistema`,`autorizado`,`facturado`,`proceso_control`,`porcentaje_proceso`,`ponderacion`,`porcentaje_cantidad`,`ordenproduccionext`,`segundosficha`) values 
(30,2,'2018-11-05 00:00:00','2018-11-05 00:00:00','2018-11-05 00:00:00',5650,2178600,NULL,'dfdfd prueba de impresion de la orden de produccion de la fecha de entrada y salida de produccion etc',0,'414d',1,'71268830',1,0,0,0,0,0,'414d',858),
(32,3,'2018-11-20 00:00:00','2018-11-20 00:00:00','2018-11-20 00:00:00',500,397785,NULL,'dsd',0,'10879',1,'71268830',1,1,0,0,0,0,'10879',0),
(33,3,'2018-11-07 00:00:00','2018-11-07 00:00:00','2018-11-07 00:00:00',500,704483,NULL,'k',0,'l125',1,'71268830',1,0,0,0,0,0,'l125',0),
(34,3,'2018-10-29 00:00:00','2018-11-07 00:00:00','2018-11-20 00:00:00',500,278616,NULL,'fgfg',0,'5241ff',1,'71268830',1,0,0,0,0,0,'5241ff',0),
(35,3,'2018-10-29 00:00:00','2018-11-12 00:00:00','2018-11-12 00:00:00',500,2140.17,NULL,'cvfd',0,'414d',1,'71268830',1,0,0,0,0,0,'414d',0),
(36,26,'2018-10-29 00:00:00','2018-10-29 00:00:00','2018-11-29 00:00:00',500,703330,NULL,'as',0,'10879',1,'71268830',1,1,0,33,0,0,'10879',0),
(37,26,'2018-10-17 00:00:00','2018-10-17 00:00:00','2018-11-14 00:00:00',500,18300,NULL,'dfdf',0,'ddd3',1,'71268830',0,1,0,0,0,0,'ddd3',0),
(40,28,'2018-10-17 00:00:00','2018-10-17 00:00:00','2018-10-17 00:00:00',500,13200,NULL,'dfds',0,'414d',1,'71268830',0,0,0,0,10,0,'414d',0),
(41,26,'2018-10-29 00:00:00','2018-11-07 00:00:00','2018-11-21 00:00:00',500,2750000,NULL,'AS',0,'1545',1,'71268830',1,0,0,27.2727,10,2.27273,'1545',0),
(42,25,'2018-10-17 00:00:00','2018-10-17 00:00:00','2018-10-17 00:00:00',500,55760,NULL,'dgd',0,'414d',5,'71268830',1,1,0,0,10,0,'414d',0),
(43,25,'2018-10-17 00:00:00','2018-10-17 00:00:00','2018-10-17 00:00:00',500,94400,NULL,'dfd',0,'414d',1,'71268830',1,1,0,0,10,0,'414d',0),
(44,26,'2018-10-29 00:00:00','2018-11-07 00:00:00','2018-11-29 00:00:00',500,1.64,NULL,'sfks',0,'11533',5,'71268830',0,0,0,0,10,0,'11533',0),
(45,26,'2018-10-29 00:00:00','2018-11-07 00:00:00','2018-11-29 00:00:00',500,9713600,NULL,'asa',0,'11533',1,'71268830',1,1,0,0,10,0,'11533',858);

/*Table structure for table `ordenproducciondetalle` */

DROP TABLE IF EXISTS `ordenproducciondetalle`;

CREATE TABLE `ordenproducciondetalle` (
  `iddetalleorden` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL,
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
  KEY `idproducto` (`idproducto`),
  KEY `idordenproduccion` (`idordenproduccion`),
  CONSTRAINT `ordenproducciondetalle_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Data for the table `ordenproducciondetalle` */

insert  into `ordenproducciondetalle`(`iddetalleorden`,`idproducto`,`codigoproducto`,`cantidad`,`vlrprecio`,`subtotal`,`idordenproduccion`,`generado`,`facturado`,`porcentaje_proceso`,`ponderacion`,`porcentaje_cantidad`,`cantidad_efectiva`,`cantidad_operada`,`totalsegundos`,`segundosficha`) values 
(10,1,'5010',1000,500,500000,30,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(11,2,'5241dd',250,550,137500,30,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(12,3,'E453569',300,582,174600,30,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(13,4,'dfd4',1500,330,495000,30,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(14,5,'dfe45',100,340,34000,30,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(15,6,'w34',2500,335,837500,30,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(19,7,'136',288,345,99360,32,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(20,10,'136',577,345,199065,32,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(21,11,'136',288,345,99360,32,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(22,7,'136',288,611,175968,33,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(23,10,'136',577,611,352547,33,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(24,11,'136',288,611,175968,33,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(25,7,'136',228,611,139308,34,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(26,10,'136',228,611,139308,34,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(27,7,'136',3,611.555,1834.665,35,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(28,12,'136',288,610,175680,36,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(29,13,'136',577,610,351970,36,NULL,NULL,100,NULL,0,NULL,0,NULL,NULL),
(30,14,'136',288,610,175680,36,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(31,12,'136',10,610,6100,37,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(32,13,'136',10,610,6100,37,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(33,14,'136',10,610,6100,37,NULL,NULL,0,NULL,0,NULL,0,NULL,NULL),
(35,15,'sds',100,1255,125500,38,NULL,NULL,14,10,10,NULL,10,NULL,NULL),
(36,16,'a23',50,1500,75000,38,NULL,NULL,57,10,20,NULL,10,NULL,NULL),
(37,17,'5010w',500,33,16500,38,NULL,NULL,50,10,20,NULL,100,NULL,NULL),
(39,19,'aw2',11,1200,13200,40,NULL,NULL,0,10,0,NULL,0,NULL,NULL),
(40,20,'158',150,5000,750000,41,NULL,NULL,100,10,11.3208,600,50,3643.75,NULL),
(41,21,'158',400,5000,2000000,41,NULL,NULL,0,10,0,0,0,0,NULL),
(42,15,'sds',20,1255,25100,42,NULL,NULL,0,10,0,0,0,NULL,NULL),
(43,16,'a23',20,1500,30000,42,NULL,NULL,0,10,0,0,0,NULL,NULL),
(44,17,'5010w',20,33,660,42,NULL,NULL,0,10,0,0,0,NULL,NULL),
(45,15,'sds',50,1255,62750,43,NULL,NULL,0,10,0,0,0,NULL,NULL),
(46,17,'5010w',50,33,1650,43,NULL,NULL,0,10,0,0,0,NULL,NULL),
(47,16,'a23',20,1500,30000,43,NULL,NULL,0,10,0,0,0,NULL,NULL),
(51,25,'23',467,10400,4856800,45,NULL,NULL,0,10,0,0,0,0,286),
(52,26,'23',219,10400,2277600,45,NULL,NULL,0,10,0,0,0,0,286),
(53,27,'23',248,10400,2579200,45,NULL,NULL,0,10,0,0,0,0,286);

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
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `ordenproducciondetalleproceso` */

insert  into `ordenproducciondetalleproceso`(`iddetalleproceso`,`proceso`,`duracion`,`ponderacion`,`total`,`totalproceso`,`porcentajeproceso`,`idproceso`,`estado`,`iddetalleorden`,`cantidad_operada`) values 
(1,'UNIR CORTE PERRILLA',10,1,11,NULL,0,1,0,28,NULL),
(2,'CERRAR CORTE PERRILLA',20,2,22,NULL,0,2,0,28,NULL),
(3,'ARMAR CUELLO',30,3,33,NULL,0,3,0,28,NULL),
(4,'PRESPUNTAR PERILLA',10,2,12,NULL,0,5,1,29,NULL),
(5,'UNIR HOMBROS POR 2',10,2,12,NULL,NULL,6,1,29,NULL),
(6,'PRESPUNTAR PERILLA',10,5,50,NULL,NULL,5,0,30,NULL),
(7,'UNIR HOMBROS POR 2',20,1,21,NULL,NULL,6,0,30,NULL),
(8,'MONTAR MANGAS POR 2',30,5,150,NULL,NULL,7,0,30,NULL),
(9,'MONTAR CORTE BAJO',40,2,42,NULL,NULL,8,0,30,NULL),
(10,'UNIR CORTE PERRILLA',10,10,11,NULL,NULL,1,1,35,NULL),
(11,'CERRAR CORTE PERRILLA',20,10,22,NULL,NULL,2,0,35,NULL),
(13,'MONTAR PERILLA CUELLO',40,10,44,NULL,NULL,4,0,35,NULL),
(14,'UNIR CORTE PERRILLA',10,10,11,NULL,NULL,1,0,36,NULL),
(15,'CERRAR CORTE PERRILLA',20,10,22,NULL,NULL,2,0,36,NULL),
(17,'MONTAR PERILLA CUELLO',40,10,44,NULL,NULL,4,1,36,NULL),
(18,'UNIR CORTE PERRILLA',10,10,11,NULL,NULL,1,1,37,NULL),
(19,'CERRAR CORTE PERRILLA',20,10,22,NULL,NULL,2,0,37,NULL),
(20,'ARMAR CUELLO',30,10,33,NULL,NULL,3,0,37,NULL),
(21,'MONTAR PERILLA CUELLO',40,10,44,NULL,NULL,4,1,37,NULL),
(51,'UNIR CORTE PERRILLA',10,10,11,NULL,NULL,1,0,31,NULL),
(52,'CERRAR CORTE PERRILLA',20,10,22,NULL,NULL,2,0,31,NULL),
(53,'ARMAR CUELLO',30,10,33,NULL,NULL,3,0,31,NULL),
(54,'UNIR CORTE PERRILLA',10,10,11,NULL,NULL,1,0,32,NULL),
(55,'CERRAR CORTE PERRILLA',20,10,22,NULL,NULL,2,0,32,NULL),
(56,'ARMAR CUELLO',30,10,33,NULL,NULL,3,0,32,NULL),
(57,'UNIR CORTE PERRILLA',10,10,11,NULL,NULL,1,0,33,NULL),
(58,'CERRAR CORTE PERRILLA',20,10,22,NULL,NULL,2,0,33,NULL),
(59,'ARMAR CUELLO',30,10,33,NULL,NULL,3,0,33,NULL),
(164,'UNIR CORTE PERRILLA',90,10,99,14850,33.9623,1,1,40,50),
(165,'UNIR CORTE PERRILLA',90,10,99,39600,33.9623,1,0,41,0),
(166,'CERRAR CORTE PERRILLA',60,10,66,9900,22.6415,2,1,40,0),
(167,'ARMAR CUELLO',90,10,99,14850,33.9623,3,1,40,0),
(168,'MONTAR PERILLA CUELLO',25,10,27.5,4125,9.43396,4,1,40,0),
(169,'CERRAR CORTE PERRILLA',60,10,66,26400,22.6415,2,0,41,0),
(170,'ARMAR CUELLO',90,10,99,39600,33.9623,3,0,41,0),
(171,'MONTAR PERILLA CUELLO',25,10,27.5,11000,9.43396,4,0,41,0),
(211,'UNIR CORTE PERRILLA',20,10,22,10274,7.69231,1,0,51,0),
(212,'CERRAR CORTE PERRILLA',20,10,22,10274,7.69231,2,0,51,0),
(213,'ARMAR CUELLO',20,10,22,10274,7.69231,3,0,51,0),
(214,'MONTAR PERILLA CUELLO',20,10,22,10274,7.69231,4,0,51,0),
(215,'PRESPUNTAR PERILLA',20,10,22,10274,7.69231,5,0,51,0),
(216,'UNIR HOMBROS POR 2',20,10,22,10274,7.69231,6,0,51,0),
(217,'MONTAR MANGAS POR 2',20,10,22,10274,7.69231,7,0,51,0),
(218,'MONTAR CORTE BAJO',20,10,22,10274,7.69231,8,0,51,0),
(219,'ARMAR CORTE BAJO',20,10,22,10274,7.69231,9,0,51,0),
(220,'ARMAR SEGUNDA MANGA',20,10,22,10274,7.69231,10,0,51,0),
(221,'ARMAR CINTURON',20,10,22,10274,7.69231,11,0,51,0),
(222,'ARMAR PUÑO POR 2',20,10,22,10274,7.69231,12,0,51,0),
(223,'MONTAR PUÑO SEGUNDA MANGA',20,10,22,10274,7.69231,13,0,51,0),
(224,'UNIR CORTE PERRILLA',20,10,22,4818,7.69231,1,0,52,0),
(225,'CERRAR CORTE PERRILLA',20,10,22,4818,7.69231,2,0,52,0),
(226,'ARMAR CUELLO',20,10,22,4818,7.69231,3,0,52,0),
(227,'MONTAR PERILLA CUELLO',20,10,22,4818,7.69231,4,0,52,0),
(228,'PRESPUNTAR PERILLA',20,10,22,4818,7.69231,5,0,52,0),
(229,'UNIR HOMBROS POR 2',20,10,22,4818,7.69231,6,0,52,0),
(230,'MONTAR MANGAS POR 2',20,10,22,4818,7.69231,7,0,52,0),
(231,'MONTAR CORTE BAJO',20,10,22,4818,7.69231,8,0,52,0),
(232,'ARMAR CORTE BAJO',20,10,22,4818,7.69231,9,0,52,0),
(233,'ARMAR SEGUNDA MANGA',20,10,22,4818,7.69231,10,0,52,0),
(234,'ARMAR CINTURON',20,10,22,4818,7.69231,11,0,52,0),
(235,'ARMAR PUÑO POR 2',20,10,22,4818,7.69231,12,0,52,0),
(236,'MONTAR PUÑO SEGUNDA MANGA',20,10,22,4818,7.69231,13,0,52,0),
(237,'UNIR CORTE PERRILLA',20,10,22,5456,7.69231,1,0,53,0),
(238,'CERRAR CORTE PERRILLA',20,10,22,5456,7.69231,2,0,53,0),
(239,'ARMAR CUELLO',20,10,22,5456,7.69231,3,0,53,0),
(240,'MONTAR PERILLA CUELLO',20,10,22,5456,7.69231,4,0,53,0),
(241,'PRESPUNTAR PERILLA',20,10,22,5456,7.69231,5,0,53,0),
(242,'UNIR HOMBROS POR 2',20,10,22,5456,7.69231,6,0,53,0),
(243,'MONTAR MANGAS POR 2',20,10,22,5456,7.69231,7,0,53,0),
(244,'MONTAR CORTE BAJO',20,10,22,5456,7.69231,8,0,53,0),
(245,'ARMAR CORTE BAJO',20,10,22,5456,7.69231,9,0,53,0),
(246,'ARMAR SEGUNDA MANGA',20,10,22,5456,7.69231,10,0,53,0),
(247,'ARMAR CINTURON',20,10,22,5456,7.69231,11,0,53,0),
(248,'ARMAR PUÑO POR 2',20,10,22,5456,7.69231,12,0,53,0),
(249,'MONTAR PUÑO SEGUNDA MANGA',20,10,22,5456,7.69231,13,0,53,0);

/*Table structure for table `ordenproducciontipo` */

DROP TABLE IF EXISTS `ordenproducciontipo`;

CREATE TABLE `ordenproducciontipo` (
  `idtipo` int(15) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `ordenproducciontipo` */

insert  into `ordenproducciontipo`(`idtipo`,`tipo`,`activo`) values 
(1,'CONFECCIÓN',0),
(2,'ARMADO',0),
(3,'CORTE',0),
(4,'MAQUILA',0),
(5,'TERMINACION',0);

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
(1,88211,12,4,17.66,4.5,4,781242,1,6);

/*Table structure for table `prendatipo` */

DROP TABLE IF EXISTS `prendatipo`;

CREATE TABLE `prendatipo` (
  `idprendatipo` int(11) NOT NULL AUTO_INCREMENT,
  `prenda` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `idtalla` int(11) NOT NULL,
  PRIMARY KEY (`idprendatipo`),
  KEY `idtalla` (`idtalla`),
  CONSTRAINT `prendatipo_ibfk_1` FOREIGN KEY (`idtalla`) REFERENCES `talla` (`idtalla`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `prendatipo` */

insert  into `prendatipo`(`idprendatipo`,`prenda`,`idtalla`) values 
(1,'CAMISA',4),
(2,'PANTALON',16),
(5,'KIMONO ROSADO',2),
(6,'KIMONO ROSADO',4),
(7,'KIMONO ROSADO',3),
(8,'KIMONO TPI ROSADO',4),
(9,'KIMONO TPI ROSADO',2),
(10,'KIMONO TPI ROSADO',3),
(11,'KIMONO AZUL',3),
(12,'KIMONO AZUL',2);

/*Table structure for table `proceso_produccion` */

DROP TABLE IF EXISTS `proceso_produccion`;

CREATE TABLE `proceso_produccion` (
  `idproceso` int(11) NOT NULL AUTO_INCREMENT,
  `proceso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idproceso`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `proceso_produccion` */

insert  into `proceso_produccion`(`idproceso`,`proceso`,`estado`) values 
(1,'UNIR CORTE PERRILLA',0),
(2,'CERRAR CORTE PERRILLA',0),
(3,'ARMAR CUELLO',0),
(4,'MONTAR PERILLA CUELLO',0),
(5,'PRESPUNTAR PERILLA',0),
(6,'UNIR HOMBROS POR 2',0),
(7,'MONTAR MANGAS POR 2',0),
(8,'MONTAR CORTE BAJO',0),
(9,'ARMAR CORTE BAJO',0),
(10,'ARMAR SEGUNDA MANGA',0),
(11,'ARMAR CINTURON',0),
(12,'ARMAR PUÑO POR 2',0),
(13,'MONTAR PUÑO SEGUNDA MANGA',0);

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `codigoproducto` char(15) NOT NULL,
  `producto` char(40) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `costoconfeccion` float NOT NULL,
  `vlrventa` float NOT NULL,
  `idcliente` int(11) NOT NULL,
  `observacion` longtext NOT NULL,
  `activo` tinyint(1) DEFAULT '0',
  `fechaproceso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuariosistema` char(15) DEFAULT NULL,
  `idprendatipo` int(11) NOT NULL,
  `idtipo` int(15) NOT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `idcliente` (`idcliente`),
  KEY `idprendatipo` (`idprendatipo`),
  KEY `idtipo` (`idtipo`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idprendatipo`) REFERENCES `prendatipo` (`idprendatipo`),
  CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`idtipo`) REFERENCES `ordenproducciontipo` (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `producto` */

insert  into `producto`(`idproducto`,`codigoproducto`,`producto`,`cantidad`,`stock`,`costoconfeccion`,`vlrventa`,`idcliente`,`observacion`,`activo`,`fechaproceso`,`usuariosistema`,`idprendatipo`,`idtipo`) values 
(1,'5010','CAMISA',500,500,500.5,5000.5,2,'gfggfgf',1,'2018-10-15 19:47:06','ADMON',1,2),
(2,'5241dd','camisa',10,10,550,600,2,'SDSDDSDS',1,'2018-10-15 19:47:06','ADMON',1,1),
(3,'E453569','camisa',120,120,582,562,2,'SDSDSD',1,'2018-10-15 19:47:06','ADMON',1,1),
(4,'dfd4','camisa',33,33,33,33,2,'sdds',0,'0000-00-00 00:00:00','ADMON',1,1),
(5,'dfe45','camisa',34,34,34,34,2,'dsd',0,'0000-00-00 00:00:00','ADMON',1,1),
(6,'FGT554','camisa',35,35,335,355,2,'wwwww',0,'2018-10-22 21:59:38','ADMON',1,1),
(7,'136','KIMONO ROSADO',288,288,345,611,3,'dgdg',0,'2018-10-22 22:22:51','ADMON',7,1),
(8,'001','PANTALON',10,10,520,520,24,'hola 2',0,'2018-10-30 13:32:28',NULL,2,1),
(9,'002','PANTALON',15,0,1000,1000,24,'hola',0,'2018-10-30 13:33:36',NULL,2,1),
(10,'136','kimono rosado',577,0,345,611,3,'vhfh',0,'2018-11-04 13:05:26',NULL,5,1),
(11,'136','kimono rosado',288,0,345,611,3,'terminacion de prenda de vestir',0,'2018-11-06 11:26:41',NULL,6,1),
(12,'136','KIMONO TPI ROSADO',288,0,223,610,26,'',0,'2018-11-13 14:23:53',NULL,8,1),
(13,'136','KIMONO ROSADO',577,0,223,610,26,'',0,'2018-11-13 14:24:38',NULL,7,1),
(14,'136','KIMONO ROSADO',288,0,223,610,26,'',0,'2018-11-13 14:25:09',NULL,9,1),
(15,'sds','PANTALON',30,30,1255,1255,25,'eeee',0,'2018-11-14 17:09:58','71268830',2,1),
(16,'a23','PANTALON',10,10,1500,1500,25,'sfsf',0,'2018-11-17 18:35:10','71268830',5,1),
(17,'5010w','CAMISA',430,0,33,33,25,'ddddd',0,'2018-11-17 18:35:40','71268830',7,1),
(19,'aw2d4567','PRUEBA',11,11,1200,1200,28,'sdsd',0,'2018-11-20 16:09:33','71268830',1,1),
(20,'158','KIMONO AZUL',150,150,2000,5000,26,'',0,'2018-11-21 11:11:21','71268830',11,1),
(21,'158','KIMONO AZUL',400,400,2000,5000,26,'',0,'2018-11-21 11:12:09','71268830',12,1),
(22,'23','KIMONO AZUL',467,467,450,1203.82,26,'',0,'2018-11-29 11:34:41','71268830',11,1),
(23,'23','KIMONO AZUL',219,219,450,1203.82,26,'',0,'2018-11-29 11:35:27','71268830',12,1),
(24,'23','KIMONO AZUL',248,248,450,1203.82,26,'',0,'2018-11-29 11:36:13','71268830',6,1),
(25,'23','KIMONO AZUL',0,1,2500,10400,26,'',0,'2018-11-29 11:44:46','71268830',11,5),
(26,'23','KIMONO AZUL',0,1,2500,10400,26,'',0,'2018-11-29 11:45:46','71268830',12,5),
(27,'23','KIMONO AZUL',0,1,2500,10400,26,'',0,'2018-11-29 11:46:25','71268830',6,5);

/*Table structure for table `recibocaja` */

DROP TABLE IF EXISTS `recibocaja`;

CREATE TABLE `recibocaja` (
  `idrecibo` int(11) NOT NULL AUTO_INCREMENT,
  `fecharecibo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechapago` date DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `idtiporecibo` char(10) NOT NULL,
  `idmunicipio` varchar(15) NOT NULL,
  `valorpagado` double DEFAULT '0',
  `valorletras` longtext,
  `idcliente` int(11) NOT NULL,
  `observacion` longtext,
  `usuariosistema` char(15) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  `autorizado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idrecibo`),
  KEY `idcliente` (`idcliente`),
  KEY `idtiporecibo` (`idtiporecibo`),
  KEY `idmunicipio` (`idmunicipio`),
  CONSTRAINT `recibocaja_ibfk_1` FOREIGN KEY (`idtiporecibo`) REFERENCES `tiporecibo` (`idtiporecibo`),
  CONSTRAINT `recibocaja_ibfk_3` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `recibocaja_ibfk_4` FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `recibocaja` */

insert  into `recibocaja`(`idrecibo`,`fecharecibo`,`fechapago`,`numero`,`idtiporecibo`,`idmunicipio`,`valorpagado`,`valorletras`,`idcliente`,`observacion`,`usuariosistema`,`estado`,`autorizado`) values 
(2,'2018-11-05 12:12:34','2018-11-06',1,'1','05001',996625,'-',2,'ggg','71268830',0,1),
(6,'2018-11-06 14:33:46','2018-11-06',2,'31','05001',200000,'-',3,'DFG','71268830',0,1),
(7,'2018-11-06 14:35:27','2018-11-06',3,'1','05001',273364.15,'-',3,'SD','71268830',0,1),
(8,'2018-11-07 11:04:03','2018-11-07',4,'1','05001',1169887.81,'-',3,'fgfg','71268830',0,1),
(9,'2018-11-12 20:13:47',NULL,5,'1','05002',0,'-',3,'dsdsd','71268830',0,1),
(10,'2018-11-13 15:31:37','2018-11-13',6,'13','05001',300000,'-',26,'abono','71268830',0,1),
(11,'2018-11-28 18:14:30',NULL,NULL,'10','05002',0,'-',25,'FDFD','71268830',0,0),
(12,'2018-11-28 18:27:11','2018-11-29',6,'12','05002',109645.6,'-',25,'RTR','71268830',0,1);

/*Table structure for table `recibocajadetalle` */

DROP TABLE IF EXISTS `recibocajadetalle`;

CREATE TABLE `recibocajadetalle` (
  `iddetallerecibo` int(11) NOT NULL AUTO_INCREMENT,
  `idfactura` int(15) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `recibocajadetalle` */

insert  into `recibocajadetalle`(`iddetallerecibo`,`idfactura`,`vlrabono`,`vlrsaldo`,`retefuente`,`reteiva`,`reteica`,`idrecibo`,`observacion`) values 
(12,4,200000,-526635.85,0,0,NULL,6,NULL),
(13,4,273364.15,0,0,0,NULL,7,NULL),
(14,5,838334.77,0,0,0,NULL,8,NULL),
(15,6,331553.04,0,0,0,NULL,8,NULL),
(17,7,473364.15,473364.15,0,0,NULL,9,NULL),
(18,8,300000,853180.5,36295,29554.5,NULL,10,NULL),
(19,10,50000,0,0,1589.16,NULL,11,NULL),
(22,11,109645.6,0,0,2690.4,NULL,12,NULL);

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
  KEY `nitmatricula` (`nitmatricula`),
  CONSTRAINT `resolucion_ibfk_1` FOREIGN KEY (`nitmatricula`) REFERENCES `matriculaempresa` (`nitmatricula`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `resolucion` */

insert  into `resolucion`(`idresolucion`,`nroresolucion`,`desde`,`hasta`,`fechavencimiento`,`nitmatricula`,`activo`) values 
(3,'1112','1','1000','2018-10-10 00:00:00','901189320',1),
(6,'254','1001','2000','2018-10-10 00:00:00','901189320',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `stockdescargas` */

insert  into `stockdescargas`(`idstockorden`,`fecha`,`stock`,`idfactura`,`nrofactura`,`idordenproduccion`,`idproducto`,`observacion`) values 
(1,'2018-12-03 20:34:16',1,7,5,32,9,'sfsf'),
(2,'2018-12-04 09:28:07',33,4,2,32,7,'prueba');

/*Table structure for table `talla` */

DROP TABLE IF EXISTS `talla`;

CREATE TABLE `talla` (
  `idtalla` int(11) NOT NULL AUTO_INCREMENT,
  `talla` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtalla`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `talla` */

insert  into `talla`(`idtalla`,`talla`,`sexo`) values 
(1,'XS','HOMBRE'),
(2,'S','HOMBRE'),
(3,'M','HOMBRE'),
(4,'L','HOMBRE'),
(5,'XL','HOMBRE'),
(6,'4','MUJER'),
(7,'6','MUJER'),
(8,'8','MUJER'),
(9,'10','MUJER'),
(10,'12','MUJER'),
(11,'14','MUJER'),
(12,'16','MUJER'),
(13,'18','MUJER'),
(14,'28','HOMBRE'),
(15,'30','HOMBRE'),
(16,'32','HOMBRE'),
(17,'34','HOMBRE'),
(18,'36','HOMBRE'),
(19,'38','HOMBRE'),
(20,'40','HOMBRE'),
(21,'42','HOMBRE'),
(22,'44','HOMBRE'),
(23,'46','HOMBRE');

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
  `idtiporecibo` char(10) NOT NULL,
  `concepto` char(30) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtiporecibo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tiporecibo` */

insert  into `tiporecibo`(`idtiporecibo`,`concepto`,`activo`) values 
('1','RECIBO DE CAJA',0),
('10','ABONO ADE BANCO',0),
('11','TECERO',0),
('12','APORTES DE SOCIO',0),
('13','ABONO A FACTURAA',0),
('2','RECIBO DE CAJA',0),
('3','TERCERO',0),
('31','ABONO DE FACTURA',0),
('4','PRESTAMO BANACRIA',0),
('42','REGALO NAVIDEÑO',0),
('43','REGISTRO DE ENTRADA',0),
('44','TERCERO',0),
('5','TERCERO EN APORTES',0),
('6','PRUEBA PRUEBA',0),
('7','TERCERO',0),
('8','DADADA',0),
('9','RECIBO DE TEMPORALIDAD',0);

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
(11,2,'71268830','fsvcwST6rx8GU','71268830','Pablo Andres Aranzazu A','paul6126q@hotmail.com',1,'2018-11-07 20:50:15','bb602ba143bab0f2862a5fa73f6bb39d0c3ba78db764d8260da30233cab5f170ba6471b8796d4eb8e37b041dc36caec1c7fab951a9c312a926b173641a81a96021df5047278743f7c855401adff5016dfa2244ac13bad3a3c7576b1de2c6c8c820d3a66f','5d3ac1bd25b7f48f53f5ed81b5e2667ff5182d25e065ec4f329360a8a75f75fe0b65d6fb0a80217c6f8e502df81af1ca6f0fee2f810ad4f80ad79f01a643db05310754b167e2e5e2f39f3c42b3d9039e517e28a1aa2855295aa437e12dcea994df3259f0');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
