-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: Gimnasio
-- ------------------------------------------------------
-- Server version	10.1.29-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `Gimnasio`
--
DROP DATABASE IF EXISTS `Gimnasio`;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ `Gimnasio` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `Gimnasio`;

--
-- Table structure for table `Actividades`
--

DROP TABLE IF EXISTS `Actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Actividades` (
  `idActividad` int(11) NOT NULL AUTO_INCREMENT,
  `comienzo` time DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profesor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valido` int(11) DEFAULT NULL,
  `lunes` int(11) DEFAULT NULL,
  `martes` int(11) DEFAULT NULL,
  `miercoles` int(11) DEFAULT NULL,
  `jueves` int(11) DEFAULT NULL,
  `viernes` int(11) DEFAULT NULL,
  PRIMARY KEY (`idActividad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Actividades`
--

LOCK TABLES `Actividades` WRITE;
/*!40000 ALTER TABLE `Actividades` DISABLE KEYS */;
INSERT INTO `Actividades` VALUES (1,'12:00:00',50,'ZUMBA','FEDE',1,0,1,0,1,0),(2,'10:10:00',20,'sad','20',1,1,0,1,0,1),(3,'10:10:00',20,'asd','asd',1,0,1,1,1,1),(4,'10:10:00',32,'asd','32',1,1,0,0,0,0),(5,'02:01:00',21,'asd','asasdassad',1,0,1,0,0,0);
/*!40000 ALTER TABLE `Actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pagina`
--

DROP TABLE IF EXISTS `Pagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pagina` (
  `titulo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c1Titulo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c1Texto` text COLLATE utf8mb4_unicode_ci,
  `c2Titulo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c2Texto` text COLLATE utf8mb4_unicode_ci,
  `c3Ttitulo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c3Texto` text COLLATE utf8mb4_unicode_ci,
  `titulo2` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c4Ttitulo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c4Texto` text COLLATE utf8mb4_unicode_ci,
  `c5Ttitulo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c5Texto` text COLLATE utf8mb4_unicode_ci,
  `c6Ttitulo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c6Texto` text COLLATE utf8mb4_unicode_ci,
  `fTitulo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fTexto` text COLLATE utf8mb4_unicode_ci,
  `c1i` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c2i` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c3i` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c4i` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c5i` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c6i` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pagina`
--

LOCK TABLES `Pagina` WRITE;
/*!40000 ALTER TABLE `Pagina` DISABLE KEYS */;
INSERT INTO `Pagina` VALUES ('asd','asd','asd','asd','asd','','asd','asd','asd','asd','asd','asd','asd','asd','asd','asd','images/pic2.jpg','images/pic2.jpg','images/pic2.jpg','images/pic2.jpg','images/pic2.jpg','images/pic2.jpg');
/*!40000 ALTER TABLE `Pagina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pagos`
--

DROP TABLE IF EXISTS `Pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pagos` (
  `idUsuario` int(11) NOT NULL,
  `idPago` int(11) NOT NULL,
  `fechaPago` date NOT NULL,
  `tipoPago` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `valido` int(1) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idPago`),
  KEY `tipoPago` (`tipoPago`),
  CONSTRAINT `Pagos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`idUsuario`),
  CONSTRAINT `Pagos_ibfk_2` FOREIGN KEY (`tipoPago`) REFERENCES `TipoPago` (`tipoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pagos`
--

LOCK TABLES `Pagos` WRITE;
/*!40000 ALTER TABLE `Pagos` DISABLE KEYS */;
INSERT INTO `Pagos` VALUES (2,0,'0000-00-00',0,12000,0),(2,1,'2017-10-18',0,12000,1),(2,2,'1000-10-10',0,23000,0),(2,3,'1000-10-10',1,2100,1),(5,0,'2017-12-06',1,3250,0),(5,1,'2010-10-10',0,2354,0),(7,0,'2017-06-12',2,53,1);
/*!40000 ALTER TABLE `Pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Roles`
--

DROP TABLE IF EXISTS `Roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Roles` (
  `idRol` int(2) NOT NULL,
  `rol` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Roles`
--

LOCK TABLES `Roles` WRITE;
/*!40000 ALTER TABLE `Roles` DISABLE KEYS */;
INSERT INTO `Roles` VALUES (0,'ADMINISTRADOR'),(1,'WEBMASTER'),(2,'USUARIO'),(3,'PUBLICO');
/*!40000 ALTER TABLE `Roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rutinas`
--

DROP TABLE IF EXISTS `Rutinas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rutinas` (
  `idUsuario` int(11) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `idRutina` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idUsuario`,`idRutina`),
  CONSTRAINT `Rutinas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rutinas`
--

LOCK TABLES `Rutinas` WRITE;
/*!40000 ALTER TABLE `Rutinas` DISABLE KEYS */;
/*!40000 ALTER TABLE `Rutinas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Telefonos`
--

DROP TABLE IF EXISTS `Telefonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Telefonos` (
  `idUsuario` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`,`telefono`),
  CONSTRAINT `Telefonos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Telefonos`
--

LOCK TABLES `Telefonos` WRITE;
/*!40000 ALTER TABLE `Telefonos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Telefonos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoPago`
--

DROP TABLE IF EXISTS `TipoPago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoPago` (
  `tipoPago` int(11) NOT NULL,
  `descripcion` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duracion` int(11) NOT NULL,
  PRIMARY KEY (`tipoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoPago`
--

LOCK TABLES `TipoPago` WRITE;
/*!40000 ALTER TABLE `TipoPago` DISABLE KEYS */;
INSERT INTO `TipoPago` VALUES (0,'ANUAL',365),(1,'MENSUAL',31),(2,'SEMESTRAL',182);
/*!40000 ALTER TABLE `TipoPago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `socMedica` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emerMovil` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `antecedentes` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valido` int(1) DEFAULT NULL,
  `idRol` int(2) DEFAULT NULL,
  `contrasenia` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `idRol` (`idRol`),
  CONSTRAINT `Usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `Roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES (2,'asdasasdsaddsa','asd',2355,'asd','2000-10-10','asd','asd','','',1,2,'2354'),(3,'asdasd','asd',2365,'asd','2000-10-10','asd','asd','asd\r\nasd\r\nasd','asd\r\nasd\r\nasd',1,2,'2365'),(4,'pepito','perez',1234,'pepito','2000-10-10','Española','SEMM','antecedente 1\r\nantecedente 2\r\nantecedente 3','Observación 1\r\nObservación 2\r\nObservación 3',1,2,'1234'),(5,'Juan','Aparicio',1,'11300','1996-10-18','Española','SEMM','Fractura de meniscos','Ninguna',1,0,'1'),(6,'asdas','asd',2,'asdsa','2000-10-10','asd','asd','ant1\r\nant2','obs1\r\nobs2',1,2,'2'),(7,'Ariosto','Fernandez',4968220,'Uspallata 1490 (Barrio cheto)','1991-03-20','Hospital Británico','Tu vieja','Ha presentado últimamente una deuda con la cual está en la blacklist de jp, siendo la deuda de 53 pesos uruguayos correspondientes a una coca chica y un colet.','Deberá pagar a jp la módica suma de 33 pesos uruguayos.',1,2,'4968220'),(8,'3','3',3,'3','2003-03-03','3','3','3','3',1,1,'3');
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-22 11:52:51
