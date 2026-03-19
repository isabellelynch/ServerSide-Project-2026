-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: grindsbookingsys
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `BookingRef` tinyint(4) NOT NULL AUTO_INCREMENT,
  `StudentID` tinyint(4) NOT NULL,
  `BookingDate` date NOT NULL,
  `ClassID` tinyint(4) NOT NULL,
  PRIMARY KEY (`BookingRef`),
  KEY `StudentID` (`StudentID`),
  KEY `ClassID` (`ClassID`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`),
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`ClassID`) REFERENCES `classes` (`ClassID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `ClassID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Day` char(1) NOT NULL,
  `Time` char(2) NOT NULL,
  `TutorID` tinyint(4) NOT NULL,
  `CurrentEnrollment` tinyint(4) NOT NULL DEFAULT 0,
  `RoomNo` char(1) NOT NULL,
  `SemesterNo` char(3) NOT NULL,
  PRIMARY KEY (`ClassID`),
  KEY `TutorID` (`TutorID`),
  KEY `RoomNo` (`RoomNo`),
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`TutorID`) REFERENCES `tutors` (`TutorID`),
  CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`RoomNo`) REFERENCES `rooms` (`RoomNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `RoomNo` char(1) NOT NULL,
  `Description` varchar(30) NOT NULL,
  `Capacity` tinyint(4) NOT NULL,
  PRIMARY KEY (`RoomNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES ('1','Computer Lab, Ground Floor',15),('2','Lecture Hall, Ground Floor',50),('3','Lecture Hall, Ground Floor',60);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `StudentID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(15) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNo` varchar(15) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`StudentID`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `PhoneNo` (`PhoneNo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Isabelle','Lynch','IsabelleLynch@gmail.com','086-0637500','A'),(2,'Brian','Hill','brianhill222@gmail.com','087-1234533','A'),(3,'Benson','Boone','bensonboone123@outlook.com','087-1231234','A'),(4,'Harry','Styles','harrystyles45@outlook.com','086-1237674','A'),(5,'Zach','Bryan','zachbryan76@gmail.com','086-1288874','A'),(6,'Gavin','Lynch','glynch08@hotmail.com','089-7657656','A'),(7,'Michael','Lynch','mgl12345@hotmail.com','086-7657999','A'),(8,'Michael','Buble','michaelbuble@hotmail.com','086-7123199','A'),(9,'Lewis','Capaldi','lewiscapaldi123@hotmail.com','085-1151239','A'),(10,'Gordon','Ramsay','ramsay456@hotmail.com','085-1167739','A');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `SubjectCode` char(3) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Level` varchar(50) NOT NULL,
  PRIMARY KEY (`SubjectCode`),
  UNIQUE KEY `SubjectCode` (`SubjectCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES ('ACC','Accountancy','Leaving Cert'),('APM','Applied Maths','Leaving Cert'),('HEJ','Home Economics','Junior Cert'),('HEL','Home Economics','Leaving Cert'),('HLE','Higher Level English','Junior Cert'),('HLM','Honours Maths','Junior Cert'),('OLE','Ordinary Level English','Junior Cert'),('OLM','Ordinary Level Maths','Junior Cert');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutorrates`
--

DROP TABLE IF EXISTS `tutorrates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutorrates` (
  `RateCode` char(3) NOT NULL,
  `HourlyRate` decimal(5,2) NOT NULL,
  `Description` varchar(100) NOT NULL,
  PRIMARY KEY (`RateCode`),
  UNIQUE KEY `RateCode` (`RateCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutorrates`
--

LOCK TABLES `tutorrates` WRITE;
/*!40000 ALTER TABLE `tutorrates` DISABLE KEYS */;
INSERT INTO `tutorrates` VALUES ('JNR',40.00,'40 euro per hour, junior tutor'),('NEW',30.00,'30 euro per hour, newly qualified tutor'),('SNR',50.00,'50 euro per hour, senior tutor');
/*!40000 ALTER TABLE `tutorrates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutors`
--

DROP TABLE IF EXISTS `tutors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutors` (
  `TutorID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(15) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNo` varchar(15) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  `RateCode` char(3) NOT NULL,
  `SubjectCode` char(3) NOT NULL,
  PRIMARY KEY (`TutorID`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `PhoneNo` (`PhoneNo`),
  KEY `RateCode` (`RateCode`),
  KEY `SubjectCode` (`SubjectCode`),
  CONSTRAINT `tutors_ibfk_1` FOREIGN KEY (`RateCode`) REFERENCES `tutorrates` (`RateCode`),
  CONSTRAINT `tutors_ibfk_2` FOREIGN KEY (`SubjectCode`) REFERENCES `subjects` (`SubjectCode`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutors`
--

LOCK TABLES `tutors` WRITE;
/*!40000 ALTER TABLE `tutors` DISABLE KEYS */;
INSERT INTO `tutors` VALUES (2,'Mohammed','Salah','mosalah123@gmail.com','086-7685433','A','SNR','ACC'),(3,'Bruno','Fernandez','fernandes345@gmail.com','086-7632311','A','JNR','APM'),(4,'Mel','Robbins','melrobbins123@outlook.com','089-7638811','A','NEW','HEL'),(5,'Timothy','Chalomet','timothy3344@hotmail.ie','089-5436144','A','SNR','OLM'),(6,'Billy','Joel','billyjoel123@gmail.com','087-1112133','A','JNR','APM'),(7,'Grace','Kelly','gracekelly@outlook.com','086-2214433','A','NEW','HEJ'),(8,'Phoebe','Lynch','phoebe1223@gmail.com','086-7655178','A','SNR','ACC'),(9,'Rachel','O Sullivan','rach456sull@hotmail.com','087-8901987','A','JNR','HLM'),(10,'Gavin','O Connor','gavin9988@gmail.com','086-7651155','A','NEW','APM'),(11,'Ralph','Lauren','ralphlauren@gmail.com','086-8119977','A','SNR','HEJ'),(12,'Louis','Thomlinson','louist55544@gmail.com','086-5512121','A','NEW','HEL'),(13,'Niall','Horan','niallh1222@outlook.com','086-0345567','A','SNR','HLE'),(14,'Lewis','Capaldi','lewiscapaldi@gmail.com','086-5537501','A','JNR','ACC'),(15,'Samantha','Quirke','squirke@outlook.com','086-0637551','A','NEW','OLE');
/*!40000 ALTER TABLE `tutors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-26 16:06:39
