-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: fitness
-- ------------------------------------------------------
-- Server version	9.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Clases`
--

DROP TABLE IF EXISTS `Clases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Clases` (
  `IDClase` int NOT NULL AUTO_INCREMENT,
  `NombreClase` varchar(255) NOT NULL,
  `DescripcionClase` text,
  `Horario` time NOT NULL,
  `Duracion` int NOT NULL,
  `Instructor` varchar(255) DEFAULT NULL,
  `CapacidadMaxima` int NOT NULL,
  `Nivel` varchar(50) DEFAULT NULL,
  `UbicacionSala` varchar(100) DEFAULT NULL,
  `EsActiva` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`IDClase`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clases`
--

LOCK TABLES `Clases` WRITE;
/*!40000 ALTER TABLE `Clases` DISABLE KEYS */;
INSERT INTO `Clases` VALUES (1,'Yoga para principiantes','Clase de yoga enfocada en posturas básicas y relajación.','08:30:00',60,'Ana Gómez',20,'Principiante','Sala A',1),(2,'Pilates intermedio','Fortalecimiento muscular y flexibilidad para nivel intermedio.','10:00:00',45,'Carlos Pérez',15,'Intermedio','Sala B',1),(3,'Cardio avanzado','Entrenamiento cardiovascular intenso para niveles avanzados.','18:00:00',50,'María López',25,'Avanzado','Sala C',1);
/*!40000 ALTER TABLE `Clases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Miembros`
--

DROP TABLE IF EXISTS `Miembros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Miembros` (
  `IDMiembro` int NOT NULL AUTO_INCREMENT,
  `NombreCompleto` varchar(255) NOT NULL,
  `CorreoElectronico` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `NumeroTelefono` varchar(20) DEFAULT NULL,
  `FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `EsAdmin` tinyint(1) DEFAULT '0',
  `Rol` varchar(20) DEFAULT 'usuario',
  PRIMARY KEY (`IDMiembro`),
  UNIQUE KEY `CorreoElectronico` (`CorreoElectronico`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Miembros`
--

LOCK TABLES `Miembros` WRITE;
/*!40000 ALTER TABLE `Miembros` DISABLE KEYS */;
INSERT INTO `Miembros` VALUES (1,'Juan Antonio Lopez','juanTony@gmail.com','contrasena123','99898988','2025-05-17 00:00:00',0,'usuario'),(2,'Martha Alcia Valladares','marth_Ali@gmail.com','contrasena123','32445323','2025-02-13 00:00:00',0,'usuario'),(3,'Andy Simon Oliva','Andy_simo@gmail.com','contrasena123','89876443','2025-02-10 00:00:00',0,'usuario'),(4,'Usuario Prueba','prueba@correo.com','$2y$10$8DtRmftOjETcZjV53PZyCualjJ5zM9ZLNs1wJZs0nE4ssaSlcCgUm',NULL,'2025-05-28 21:25:54',0,'usuario'),(23,'Breydi','pruebabreydi@correo.com','$2y$10$ZYs3YvAM0ppRQgNkjJwxyO..UrGo2kZDqNLq7CVgBHtL4CM5bNGlu',NULL,'2025-05-28 21:28:44',0,'usuario'),(24,'Erick Eduardo Bonilla','Erick3007@correo.com','$2y$10$XUdkrrLJ2csTK1hDypN5uuP/QF2kyvpHkgn0Ofict9lxCQ6Xu5Sl.','9753-4905','2025-05-28 00:00:00',0,'usuario'),(26,'Breydi','Erick30027@correo.com','$2y$10$RBkSdpOXx2JyFBvM1OtQfOWmVFAMUG78nLkWR1I9l.CFvARWKOmr6','9753-4905','2025-05-28 00:00:00',0,'usuario'),(27,'Jahir','JahirF8@prueba.com','$2y$10$J7bMdGEdph1NyOPdXWjoj.bNwLvru2NP7xOlONxngkkGpcCF3pmM.','0000000','2025-05-28 00:00:00',0,'usuario'),(28,'Mayte','Mayte@correo.com','$2y$10$nWT9lWQ3ZS7hVBywFtlEUOUiMJ11XDdhg3aEEMNXz8P7lNMk54HPK','0000000','2025-05-30 00:00:00',0,'usuario'),(34,'gregory','Gregory000@correo.com','$2y$10$dDWvZaHrSKCYkFI/3udJo.1bkCw56z5Gz6KDzBJiHip31GvKb1xji','0000000','2025-06-07 00:00:00',0,'usuario'),(35,'Erick','Erickbonilla@admin.com','$2y$10$QhuWOHqYVxqKzmqM5VKJN.XlkHqB3YA1rNLjyCAOZYqHPj64a5zdy','00000','2025-06-07 00:00:00',0,'admin'),(36,'Mayte','Mayte@correoprueba.com','$2y$10$0ejedLjCkucyA0D8vNxXb.t91UavhzFllXQY6LqQ2mNN2ClFK6Doq','00000000','2025-06-09 00:00:00',0,'usuario'),(37,'Gregory','gregoryaguacate@admin.com','$2y$10$vmj2RG1XiS2OYsBJaMk4ceLqDGzU6ebMGTcdwP5LSX4fHOvoXuA.C','0000000','2025-06-09 00:00:00',0,'admin'),(38,'Mayte','Mayte@admin.com','$2y$10$lFLo7.ulaVbqMz.TEETNf.fG5xg2qixARu8UJKFNFrHiQlAL79hke','0000000','2025-06-09 00:00:00',0,'admin');
/*!40000 ALTER TABLE `Miembros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pagos`
--

DROP TABLE IF EXISTS `Pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pagos` (
  `IDPago` int NOT NULL AUTO_INCREMENT,
  `IDMiembro` int NOT NULL,
  `DescripcionPago` varchar(255) NOT NULL,
  `Monto` decimal(10,2) NOT NULL,
  `FechaPago` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `MetodoPago` varchar(50) DEFAULT NULL,
  `EstadoPago` varchar(50) DEFAULT NULL,
  `IDTransaccion` varchar(255) DEFAULT NULL,
  `FechaInicioPeriodo` date DEFAULT NULL,
  `FechaFinPeriodo` date DEFAULT NULL,
  PRIMARY KEY (`IDPago`),
  KEY `IDMiembro` (`IDMiembro`),
  CONSTRAINT `Pagos_ibfk_1` FOREIGN KEY (`IDMiembro`) REFERENCES `Miembros` (`IDMiembro`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pagos`
--

LOCK TABLES `Pagos` WRITE;
/*!40000 ALTER TABLE `Pagos` DISABLE KEYS */;
INSERT INTO `Pagos` VALUES (14,24,'Matrícula',1000.00,'2025-06-05 00:00:00','Tarjeta','Declinado','451129507',NULL,NULL),(15,24,'Recuperación',1000.00,'2025-06-05 00:00:00','Transferencia','Pendiente','568560913',NULL,NULL),(18,34,'Reposición',1000.00,'2025-06-07 00:00:00','Tarjeta','Aprobado','566023806',NULL,NULL),(19,34,'Cuotas',1000.00,'2025-06-07 00:00:00','Tarjeta','Aprovado','907600831','2025-06-08','2025-06-09'),(20,34,'Matrícula',1000.00,'2025-06-07 00:00:00','Transferencia','Pendiente','593916659',NULL,NULL),(21,34,'Cuotas',1000.00,'2025-06-07 00:00:00','Tarjeta','Declinado','760503467',NULL,NULL),(22,34,'Cuotas',1000.00,'2025-06-07 00:00:00','Efectivo','Aprobado','739537675',NULL,NULL),(23,34,'Entrenador',1000.00,'2025-06-07 00:00:00','Transferencia','Pendiente','382748243',NULL,NULL),(24,34,'Matrícula',1000.00,'2025-06-07 00:00:00','Tarjeta','Declinado','687142720',NULL,NULL);
/*!40000 ALTER TABLE `Pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Progreso`
--

DROP TABLE IF EXISTS `Progreso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Progreso` (
  `IDProgreso` int NOT NULL AUTO_INCREMENT,
  `IDMiembro` int NOT NULL,
  `TipoMetrica` varchar(100) NOT NULL,
  `Valor` varchar(255) DEFAULT NULL,
  `FechaRegistroProgreso` date NOT NULL,
  `Notas` text,
  PRIMARY KEY (`IDProgreso`),
  KEY `IDMiembro` (`IDMiembro`),
  CONSTRAINT `Progreso_ibfk_1` FOREIGN KEY (`IDMiembro`) REFERENCES `Miembros` (`IDMiembro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Progreso`
--

LOCK TABLES `Progreso` WRITE;
/*!40000 ALTER TABLE `Progreso` DISABLE KEYS */;
INSERT INTO `Progreso` VALUES (1,26,'5ft 9','100','2025-07-30','subio de peso');
/*!40000 ALTER TABLE `Progreso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reserva`
--

DROP TABLE IF EXISTS `Reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Reserva` (
  `IDReserva` int NOT NULL AUTO_INCREMENT,
  `IDMiembro` int NOT NULL,
  `IDClase` int NOT NULL,
  `FechaHoraReserva` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `EstadoReserva` varchar(50) DEFAULT 'ACTIVA',
  PRIMARY KEY (`IDReserva`),
  KEY `IDMiembro` (`IDMiembro`),
  KEY `IDClase` (`IDClase`),
  CONSTRAINT `Reserva_ibfk_1` FOREIGN KEY (`IDMiembro`) REFERENCES `Miembros` (`IDMiembro`),
  CONSTRAINT `Reserva_ibfk_2` FOREIGN KEY (`IDClase`) REFERENCES `Clases` (`IDClase`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reserva`
--

LOCK TABLES `Reserva` WRITE;
/*!40000 ALTER TABLE `Reserva` DISABLE KEYS */;
INSERT INTO `Reserva` VALUES (1,1,2,'2025-03-16 10:00:00','ACTIVA'),(2,2,1,'2025-05-18 15:30:00','ACTIVA'),(3,3,3,'2025-06-01 09:45:00','ACTIVA'),(4,26,1,'2025-05-18 15:30:00','ACTIVA'),(5,26,2,'2025-05-28 23:05:00','ACTIVA'),(6,26,2,'2025-05-28 23:05:02','ACTIVA'),(7,26,3,'2025-05-28 23:05:15','ACTIVA'),(8,28,2,'2025-05-30 00:53:24','ACTIVA'),(9,34,1,'2025-06-07 04:05:55','ACTIVA'),(10,35,1,'2025-06-09 02:05:16','ACTIVA'),(11,35,1,'2025-06-09 02:06:11','ACTIVA'),(12,35,1,'2025-06-09 02:06:12','ACTIVA'),(13,35,2,'2025-06-09 02:06:14','ACTIVA'),(14,35,2,'2025-06-09 02:06:15','ACTIVA'),(15,35,3,'2025-06-09 02:06:17','ACTIVA');
/*!40000 ALTER TABLE `Reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'fitness'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-09 10:52:27
