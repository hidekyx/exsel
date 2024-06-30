-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: spk_ahp_ci_3
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `alternatif`
--

DROP TABLE IF EXISTS `alternatif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alternatif` (
  `id_alternatif` int NOT NULL AUTO_INCREMENT,
  `id_batch` int DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `catatan` text,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternatif`
--

LOCK TABLES `alternatif` WRITE;
/*!40000 ALTER TABLE `alternatif` DISABLE KEYS */;
INSERT INTO `alternatif` VALUES (9,1,'Devina Alby','Peserta merupakan pemenang Final Showcase. Peserta memiliki kemampuan leadership yang sangat baik.'),(10,1,'Celine Hartono','tes'),(11,1,'Rahma Eka Tantri','tes'),(12,1,'Kalindra Yasmin Putri','tes'),(13,1,'Kyla Taleetha Savina','tes'),(14,1,'Felix Adji Kurniawan','tes'),(15,1,'Andar Petra Subagyo','tes'),(16,1,'Inshira Ahmad','tes'),(17,1,'Ghani Marik Atariq','tes'),(18,1,'Putra Fadillah Wijayanto','tes'),(20,1,'Peserta Baru','tes'),(28,3,'Eleonora Jovita Halim Lam','tes'),(29,3,'Sima Maulina','tes'),(30,4,'Sugma','tes'),(40,2,'Devina Alby','Pemenang Final showcase'),(41,2,'Celine Hartono','tes'),(42,2,'Rahma Eka Tantri','tes'),(43,2,'Kalindra Yasmin Putri','tes'),(44,2,'Kyla Taleetha Savina','tes'),(45,2,'Felix Adji Kurniawan','tes'),(46,2,'Andar Petra Subagyo','tes'),(47,2,'Inshira Ahmad','tes'),(48,2,'Ghani Marik Atariq','tes'),(49,2,'Putra Fadillah Wijayanto','tes'),(64,2,'Peserta Tes','Tes catatan'),(254,2,'Peserta 26',NULL),(285,2,'Peserta Baru',NULL),(286,2,'Eleonora Jovita Halim Lam',NULL),(287,2,'Sima Maulina',NULL),(288,2,'Sugma',NULL),(289,2,'Peserta 27',NULL),(290,2,'Peserta 28',NULL),(291,2,'Peserta 29',NULL),(292,2,'Peserta 30',NULL),(293,2,'Peserta 31',NULL),(294,2,'Peserta 32',NULL),(295,2,'Peserta 33',NULL),(296,2,'Peserta 34',NULL),(297,2,'Afgan',NULL);
/*!40000 ALTER TABLE `alternatif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aspek_kriteria`
--

DROP TABLE IF EXISTS `aspek_kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aspek_kriteria` (
  `id_aspek_kriteria` int NOT NULL AUTO_INCREMENT,
  `id_kriteria` int NOT NULL,
  `id_batch` int NOT NULL,
  `nama_aspek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_aspek_kriteria`),
  KEY `sub_kriteria_label_FK` (`id_kriteria`),
  KEY `sub_kriteria_label_FK_1` (`id_batch`),
  CONSTRAINT `sub_kriteria_label_FK` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  CONSTRAINT `sub_kriteria_label_FK_1` FOREIGN KEY (`id_batch`) REFERENCES `batch` (`id_batch`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aspek_kriteria`
--

LOCK TABLES `aspek_kriteria` WRITE;
/*!40000 ALTER TABLE `aspek_kriteria` DISABLE KEYS */;
INSERT INTO `aspek_kriteria` VALUES (1,17,2,'Final Project'),(2,17,2,'Showcase'),(3,17,2,'Communication Skill'),(4,17,2,'Teamwork'),(5,18,2,'Problem Solving'),(6,18,2,'Social Intelligence'),(7,18,2,'Creativity'),(8,18,2,'Leadership'),(9,19,2,'Critical Thinking'),(10,19,2,'Design System'),(11,19,2,'Prototype'),(12,25,2,'Live Session'),(13,25,2,'Jamming Time'),(14,25,2,'Career Preparation'),(15,26,2,'Kecepatan Menjawab'),(16,26,2,'Akurasi Jawaban'),(17,26,2,'Pemahaman Materi');
/*!40000 ALTER TABLE `aspek_kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aspek_kriteria_hasil`
--

DROP TABLE IF EXISTS `aspek_kriteria_hasil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aspek_kriteria_hasil` (
  `id_aspek_kriteria_hasil` int NOT NULL AUTO_INCREMENT,
  `id_kriteria` int NOT NULL,
  `id_aspek_kriteria` int NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_aspek_kriteria_hasil`),
  KEY `aspek_kriteria_hasil_FK` (`id_kriteria`),
  KEY `aspek_kriteria_hasil_FK_1` (`id_aspek_kriteria`),
  CONSTRAINT `aspek_kriteria_hasil_FK` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  CONSTRAINT `aspek_kriteria_hasil_FK_1` FOREIGN KEY (`id_aspek_kriteria`) REFERENCES `aspek_kriteria` (`id_aspek_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aspek_kriteria_hasil`
--

LOCK TABLES `aspek_kriteria_hasil` WRITE;
/*!40000 ALTER TABLE `aspek_kriteria_hasil` DISABLE KEYS */;
INSERT INTO `aspek_kriteria_hasil` VALUES (1,17,1,1),(2,17,2,0.630309),(3,17,3,0.42242),(4,17,4,0.223929),(5,18,5,1),(6,18,6,0.411431),(7,18,7,0.220157),(8,18,8,0.167031),(9,19,9,1),(10,19,10,0.636273),(11,19,11,0.162525),(12,25,12,1),(13,25,13,0.411305),(14,25,14,0.167612),(15,26,15,1),(16,26,16,0.411305),(17,26,17,0.167612);
/*!40000 ALTER TABLE `aspek_kriteria_hasil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aspek_kriteria_nilai`
--

DROP TABLE IF EXISTS `aspek_kriteria_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aspek_kriteria_nilai` (
  `id_aspek_kriteria_nilai` int NOT NULL AUTO_INCREMENT,
  `id_kriteria` int NOT NULL,
  `aspek_kriteria_id_dari` int NOT NULL,
  `aspek_kriteria_id_tujuan` int NOT NULL,
  `nilai` int NOT NULL,
  PRIMARY KEY (`id_aspek_kriteria_nilai`),
  KEY `aspek_kriteria_nilai_FK` (`id_kriteria`),
  KEY `aspek_kriteria_nilai_FK_1` (`aspek_kriteria_id_dari`),
  KEY `aspek_kriteria_nilai_FK_2` (`aspek_kriteria_id_tujuan`),
  CONSTRAINT `aspek_kriteria_nilai_FK` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  CONSTRAINT `aspek_kriteria_nilai_FK_1` FOREIGN KEY (`aspek_kriteria_id_dari`) REFERENCES `aspek_kriteria` (`id_aspek_kriteria`),
  CONSTRAINT `aspek_kriteria_nilai_FK_2` FOREIGN KEY (`aspek_kriteria_id_tujuan`) REFERENCES `aspek_kriteria` (`id_aspek_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aspek_kriteria_nilai`
--

LOCK TABLES `aspek_kriteria_nilai` WRITE;
/*!40000 ALTER TABLE `aspek_kriteria_nilai` DISABLE KEYS */;
INSERT INTO `aspek_kriteria_nilai` VALUES (1,17,1,2,2),(2,17,1,3,3),(3,17,1,4,3),(4,17,2,3,2),(5,17,2,4,3),(6,17,3,4,3),(7,18,5,6,3),(8,18,5,7,5),(9,18,5,8,5),(10,18,6,7,3),(11,18,6,8,2),(12,18,7,8,2),(13,19,9,10,2),(14,19,9,11,5),(15,19,10,11,5),(16,25,12,13,3),(17,25,12,14,5),(18,25,13,14,3),(19,26,15,16,3),(20,26,15,17,5),(21,26,16,17,3);
/*!40000 ALTER TABLE `aspek_kriteria_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batch`
--

DROP TABLE IF EXISTS `batch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `batch` (
  `id_batch` int NOT NULL AUTO_INCREMENT,
  `nama_batch` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_batch`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batch`
--

LOCK TABLES `batch` WRITE;
/*!40000 ALTER TABLE `batch` DISABLE KEYS */;
INSERT INTO `batch` VALUES (2,'Batch 1','2024-07-01','2024-07-10','Aktif');
/*!40000 ALTER TABLE `batch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hasil`
--

DROP TABLE IF EXISTS `hasil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hasil` (
  `id_hasil` int NOT NULL AUTO_INCREMENT,
  `id_alternatif` int NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_hasil`),
  KEY `id_alternatif` (`id_alternatif`),
  CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hasil`
--

LOCK TABLES `hasil` WRITE;
/*!40000 ALTER TABLE `hasil` DISABLE KEYS */;
INSERT INTO `hasil` VALUES (1,40,0.953157),(2,41,0.80772),(3,42,0.666642),(4,43,0.544112),(5,44,0.502455),(6,45,0.372481),(7,46,0.45327),(8,47,0.327265),(9,48,0.175829),(10,49,0.313183),(11,64,0.151289),(12,254,0),(13,285,0),(14,286,0),(15,287,0),(16,288,0),(17,289,0),(18,290,0),(19,291,0),(20,292,0),(21,293,0),(22,294,0),(23,295,0),(24,296,0),(25,297,0);
/*!40000 ALTER TABLE `hasil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kriteria` (
  `id_kriteria` int NOT NULL AUTO_INCREMENT,
  `id_batch` int DEFAULT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `kode_kriteria` varchar(100) NOT NULL,
  `tipe_kriteria` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria`
--

LOCK TABLES `kriteria` WRITE;
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` VALUES (17,2,'Kinerja','K1','Numeric'),(18,2,'ICI','K2','Numeric'),(19,2,'Evaluasi','K3','Numeric'),(25,2,'Kehadiran','K4','Numeric'),(26,2,'Quiz','K5','Numeric');
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kriteria_hasil`
--

DROP TABLE IF EXISTS `kriteria_hasil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kriteria_hasil` (
  `id_kriteria_hasil` int NOT NULL AUTO_INCREMENT,
  `id_kriteria` int NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_kriteria_hasil`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `kriteria_hasil_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria_hasil`
--

LOCK TABLES `kriteria_hasil` WRITE;
/*!40000 ALTER TABLE `kriteria_hasil` DISABLE KEYS */;
INSERT INTO `kriteria_hasil` VALUES (59,17,0.483528),(60,18,0.230531),(61,19,0.132002),(70,25,0.0901552),(71,26,0.063784);
/*!40000 ALTER TABLE `kriteria_hasil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kriteria_nilai`
--

DROP TABLE IF EXISTS `kriteria_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kriteria_nilai` (
  `id_kriteria_nilai` int NOT NULL AUTO_INCREMENT,
  `kriteria_id_dari` int NOT NULL,
  `kriteria_id_tujuan` int NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_kriteria_nilai`),
  KEY `kriteria_id_dari` (`kriteria_id_dari`),
  KEY `kriteria_id_tujuan` (`kriteria_id_tujuan`),
  CONSTRAINT `kriteria_nilai_ibfk_1` FOREIGN KEY (`kriteria_id_dari`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kriteria_nilai_ibfk_2` FOREIGN KEY (`kriteria_id_tujuan`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria_nilai`
--

LOCK TABLES `kriteria_nilai` WRITE;
/*!40000 ALTER TABLE `kriteria_nilai` DISABLE KEYS */;
INSERT INTO `kriteria_nilai` VALUES (148,17,18,3),(149,17,19,5),(150,18,19,3),(174,17,25,5),(175,17,26,5),(176,18,25,3),(177,18,26,3),(178,19,25,2),(179,19,26,3),(180,25,26,2);
/*!40000 ALTER TABLE `kriteria_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penilaian`
--

DROP TABLE IF EXISTS `penilaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penilaian` (
  `id_penilaian` int NOT NULL AUTO_INCREMENT,
  `id_alternatif` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `id_sub_kriteria` int NOT NULL,
  `nilai_mentah` varchar(100) NOT NULL,
  PRIMARY KEY (`id_penilaian`),
  KEY `id_alternatif` (`id_alternatif`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_sub_kriteria` (`id_sub_kriteria`),
  CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=339 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penilaian`
--

LOCK TABLES `penilaian` WRITE;
/*!40000 ALTER TABLE `penilaian` DISABLE KEYS */;
INSERT INTO `penilaian` VALUES (231,40,17,90,'100'),(232,40,18,126,'99'),(233,40,19,138,'98'),(234,40,25,150,'30'),(235,40,26,163,'98'),(236,41,17,91,'98'),(237,41,18,128,'97'),(238,41,19,138,'98'),(239,41,25,152,'28'),(240,41,26,163,'98'),(241,42,17,96,'97'),(242,42,18,129,'95'),(243,42,19,139,'97'),(244,42,25,151,'29'),(245,42,26,164,'96'),(246,43,17,117,'92'),(247,43,18,129,'95'),(248,43,19,140,'94'),(249,43,25,152,'28'),(250,43,26,165,'94'),(251,44,17,119,'88'),(252,44,18,128,'97'),(253,44,19,140,'94'),(254,44,25,151,'29'),(255,44,26,166,'92'),(256,45,17,120,'87'),(257,45,18,130,'92'),(258,45,19,141,'92'),(259,45,25,156,'24'),(260,45,26,166,'92'),(261,46,17,121,'84'),(262,46,18,128,'96'),(263,46,19,141,'92'),(264,46,25,153,'27'),(265,46,26,164,'96'),(266,47,17,121,'84'),(267,47,18,131,'90'),(268,47,19,146,'85'),(269,47,25,153,'27'),(270,47,26,166,'93'),(271,48,17,123,'80'),(272,48,18,135,'80'),(273,48,19,147,'82'),(274,48,25,160,'20'),(275,48,26,171,'82'),(276,49,17,122,'82'),(277,49,18,131,'90'),(278,49,19,142,'91'),(279,49,25,155,'25'),(280,49,26,167,'90'),(329,64,17,124,'100'),(330,64,18,136,'99.23'),(332,64,25,161,'70.51'),(334,64,17,124,'100'),(335,64,18,136,'99.23'),(336,64,19,149,'50.45'),(337,64,25,161,'70.51'),(338,64,26,173,'29.3');
/*!40000 ALTER TABLE `penilaian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_kriteria`
--

DROP TABLE IF EXISTS `sub_kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int NOT NULL AUTO_INCREMENT,
  `id_kriteria` int NOT NULL,
  `id_batch` int DEFAULT NULL,
  `nama_sub_kriteria` text NOT NULL,
  PRIMARY KEY (`id_sub_kriteria`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `sub_kriteria_FK` (`id_batch`),
  CONSTRAINT `sub_kriteria_FK` FOREIGN KEY (`id_batch`) REFERENCES `batch` (`id_batch`),
  CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_kriteria`
--

LOCK TABLES `sub_kriteria` WRITE;
/*!40000 ALTER TABLE `sub_kriteria` DISABLE KEYS */;
INSERT INTO `sub_kriteria` VALUES (90,17,2,'100'),(91,17,2,'98 - 99'),(96,17,2,'96 - 97'),(97,17,2,'94 - 95'),(117,17,2,'92 - 93'),(118,17,2,'90 - 91'),(119,17,2,'88 - 89'),(120,17,2,'86 - 87'),(121,17,2,'84 - 85'),(122,17,2,'82 - 83'),(123,17,2,'80 - 81'),(124,17,2,'< 79'),(125,18,2,'100'),(126,18,2,'99'),(127,18,2,'98'),(128,18,2,'96 - 97'),(129,18,2,'94 - 95'),(130,18,2,'92 - 93'),(131,18,2,'90 - 91'),(132,18,2,'87 - 89'),(133,18,2,'84 - 86'),(134,18,2,'82  - 83'),(135,18,2,'80 - 81'),(136,18,2,'< 79'),(137,19,2,'100'),(138,19,2,'98 - 99'),(139,19,2,'96 - 97'),(140,19,2,'94 - 95'),(141,19,2,'93 - 92'),(142,19,2,'90 - 91'),(143,19,2,'88 - 89'),(144,19,2,'86 - 87'),(146,19,2,'84 - 85'),(147,19,2,'82 - 83'),(148,19,2,'80 - 81'),(149,19,2,'< 79'),(150,25,2,'30'),(151,25,2,'29'),(152,25,2,'28'),(153,25,2,'27'),(154,25,2,'26'),(155,25,2,'25'),(156,25,2,'24'),(157,25,2,'23'),(158,25,2,'22'),(159,25,2,'21'),(160,25,2,'20 - 19'),(161,25,2,'< 18'),(162,26,2,'100'),(163,26,2,'98 - 99'),(164,26,2,'96 - 97'),(165,26,2,'94 - 95'),(166,26,2,'92 - 93'),(167,26,2,'90 - 91'),(168,26,2,'88 - 89'),(169,26,2,'86 - 87'),(170,26,2,'84 - 85'),(171,26,2,'82 - 83'),(172,26,2,'80 - 81'),(173,26,2,'< 79');
/*!40000 ALTER TABLE `sub_kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_kriteria_hasil`
--

DROP TABLE IF EXISTS `sub_kriteria_hasil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_kriteria_hasil` (
  `id_sub_kriteria_hasil` int NOT NULL AUTO_INCREMENT,
  `id_kriteria` int NOT NULL,
  `id_sub_kriteria` int NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_sub_kriteria_hasil`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_sub_kriteria` (`id_sub_kriteria`),
  CONSTRAINT `sub_kriteria_hasil_nilai_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_kriteria_hasil_nilai_ibfk_2` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_kriteria_hasil`
--

LOCK TABLES `sub_kriteria_hasil` WRITE;
/*!40000 ALTER TABLE `sub_kriteria_hasil` DISABLE KEYS */;
INSERT INTO `sub_kriteria_hasil` VALUES (239,17,90,1),(240,17,91,0.814372),(241,17,96,0.64156),(242,17,97,0.550903),(243,17,117,0.462257),(244,17,118,0.377281),(245,17,119,0.316659),(246,17,120,0.255334),(247,17,121,0.214932),(248,17,122,0.192353),(249,17,123,0.151574),(250,17,124,0.13736),(263,18,125,1),(264,18,126,0.870212),(265,18,127,0.870212),(266,18,128,0.693954),(267,18,129,0.524897),(268,18,130,0.454587),(269,18,131,0.409461),(270,18,132,0.345138),(271,18,133,0.236808),(272,18,134,0.211502),(273,18,135,0.187423),(274,18,136,0.164455),(275,19,137,1),(276,19,138,0.951468),(277,19,139,0.810969),(278,19,140,0.621873),(279,19,141,0.578978),(280,19,142,0.439252),(281,19,143,0.383645),(282,19,144,0.351992),(283,19,146,0.281097),(284,19,147,0.228882),(285,19,148,0.165149),(286,19,149,0.167933),(326,25,150,1),(327,25,151,0.833101),(328,25,152,0.833101),(329,25,153,0.661898),(330,25,154,0.59344),(331,25,155,0.461071),(332,25,156,0.395207),(333,25,157,0.311025),(334,25,158,0.266849),(335,25,159,0.208544),(336,25,160,0.182175),(337,25,161,0.160126),(338,26,162,1),(339,26,163,0.835113),(340,26,164,0.835113),(341,26,165,0.664675),(342,26,166,0.504309),(343,26,167,0.411252),(344,26,168,0.377971),(345,26,169,0.3105),(346,26,170,0.274046),(347,26,171,0.199036),(348,26,172,0.162352),(349,26,173,0.162352);
/*!40000 ALTER TABLE `sub_kriteria_hasil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subkriteria_nilai`
--

DROP TABLE IF EXISTS `subkriteria_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subkriteria_nilai` (
  `id_subkriteria_nilai` int NOT NULL AUTO_INCREMENT,
  `id_kriteria` int NOT NULL,
  `subkriteria_id_dari` int NOT NULL,
  `subkriteria_id_tujuan` int NOT NULL,
  `nilai` int NOT NULL,
  PRIMARY KEY (`id_subkriteria_nilai`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `subkriteria_id_dari` (`subkriteria_id_dari`),
  KEY `subkriteria_id_tujuan` (`subkriteria_id_tujuan`),
  CONSTRAINT `subkriteria_nilai_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subkriteria_nilai_ibfk_2` FOREIGN KEY (`subkriteria_id_dari`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subkriteria_nilai_ibfk_3` FOREIGN KEY (`subkriteria_id_tujuan`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=816 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subkriteria_nilai`
--

LOCK TABLES `subkriteria_nilai` WRITE;
/*!40000 ALTER TABLE `subkriteria_nilai` DISABLE KEYS */;
INSERT INTO `subkriteria_nilai` VALUES (394,18,125,126,1),(395,18,125,127,1),(396,18,125,128,2),(397,18,125,129,3),(398,18,125,130,3),(399,18,125,131,3),(400,18,125,132,3),(401,18,125,133,5),(402,18,125,134,5),(403,18,125,135,5),(404,18,125,136,5),(405,18,126,127,1),(406,18,126,128,2),(407,18,126,129,3),(408,18,126,130,3),(409,18,126,131,3),(410,18,126,132,3),(411,18,126,133,3),(412,18,126,134,3),(413,18,126,135,3),(414,18,126,136,3),(415,18,127,128,2),(416,18,127,129,3),(417,18,127,130,3),(418,18,127,131,3),(419,18,127,132,3),(420,18,127,133,3),(421,18,127,134,3),(422,18,127,135,3),(423,18,127,136,3),(424,18,128,129,3),(425,18,128,130,3),(426,18,128,131,3),(427,18,128,132,3),(428,18,128,133,3),(429,18,128,134,3),(430,18,128,135,3),(431,18,128,136,3),(432,18,129,130,2),(433,18,129,131,3),(434,18,129,132,3),(435,18,129,133,3),(436,18,129,134,3),(437,18,129,135,3),(438,18,129,136,3),(439,18,130,131,2),(440,18,130,132,3),(441,18,130,133,3),(442,18,130,134,3),(443,18,130,135,3),(444,18,130,136,3),(445,18,131,132,3),(446,18,131,133,3),(447,18,131,134,3),(448,18,131,135,3),(449,18,131,136,3),(450,18,132,133,3),(451,18,132,134,3),(452,18,132,135,3),(453,18,132,136,3),(454,18,133,134,2),(455,18,133,135,2),(456,18,133,136,2),(457,18,134,135,2),(458,18,134,136,2),(459,18,135,136,2),(460,19,137,138,1),(461,19,137,139,1),(462,19,137,140,2),(463,19,137,141,3),(464,19,137,142,3),(465,19,137,143,3),(466,19,137,144,3),(467,19,137,146,5),(468,19,137,147,5),(469,19,137,148,5),(470,19,137,149,5),(471,19,138,139,1),(472,19,138,140,2),(473,19,138,141,2),(474,19,138,142,3),(475,19,138,143,9),(476,19,138,144,3),(477,19,138,146,3),(478,19,138,147,3),(479,19,138,148,3),(480,19,138,149,3),(481,19,139,140,2),(482,19,139,141,2),(483,19,139,142,3),(484,19,139,143,2),(485,19,139,144,3),(486,19,139,146,3),(487,19,139,147,3),(488,19,139,148,3),(489,19,139,149,3),(490,19,140,141,2),(491,19,140,142,3),(492,19,140,143,2),(493,19,140,144,3),(494,19,140,146,3),(495,19,140,147,2),(496,19,140,148,3),(497,19,140,149,3),(498,19,141,142,3),(499,19,141,143,3),(500,19,141,144,3),(501,19,141,146,3),(502,19,141,147,3),(503,19,141,148,3),(504,19,141,149,3),(505,19,142,143,3),(506,19,142,144,2),(507,19,142,146,3),(508,19,142,147,3),(509,19,142,148,3),(510,19,142,149,3),(511,19,143,144,2),(512,19,143,146,3),(513,19,143,147,3),(514,19,143,148,3),(515,19,143,149,3),(516,19,144,146,3),(517,19,144,147,3),(518,19,144,148,3),(519,19,144,149,3),(520,19,146,147,3),(521,19,146,148,3),(522,19,146,149,3),(523,19,147,148,3),(524,19,147,149,2),(525,19,148,149,1),(678,25,150,151,1),(679,25,150,152,1),(680,25,150,153,2),(681,25,150,154,2),(682,25,150,155,3),(683,25,150,156,3),(684,25,150,157,5),(685,25,150,158,5),(686,25,150,159,5),(687,25,150,160,5),(688,25,150,161,5),(689,25,151,152,1),(690,25,151,153,2),(691,25,151,154,2),(692,25,151,155,3),(693,25,151,156,3),(694,25,151,157,3),(695,25,151,158,3),(696,25,151,159,3),(697,25,151,160,3),(698,25,151,161,3),(699,25,152,153,2),(700,25,152,154,2),(701,25,152,155,3),(702,25,152,156,3),(703,25,152,157,3),(704,25,152,158,3),(705,25,152,159,3),(706,25,152,160,3),(707,25,152,161,3),(708,25,153,154,2),(709,25,153,155,3),(710,25,153,156,3),(711,25,153,157,3),(712,25,153,158,3),(713,25,153,159,3),(714,25,153,160,3),(715,25,153,161,3),(716,25,154,155,3),(717,25,154,156,3),(718,25,154,157,3),(719,25,154,158,3),(720,25,154,159,3),(721,25,154,160,3),(722,25,154,161,3),(723,25,155,156,3),(724,25,155,157,3),(725,25,155,158,3),(726,25,155,159,3),(727,25,155,160,3),(728,25,155,161,3),(729,25,156,157,3),(730,25,156,158,3),(731,25,156,159,3),(732,25,156,160,3),(733,25,156,161,3),(734,25,157,158,2),(735,25,157,159,3),(736,25,157,160,3),(737,25,157,161,3),(738,25,158,159,2),(739,25,158,160,3),(740,25,158,161,3),(741,25,159,160,2),(742,25,159,161,2),(743,25,160,161,2),(744,26,162,163,1),(745,26,162,164,1),(746,26,162,165,2),(747,26,162,166,3),(748,26,162,167,3),(749,26,162,168,3),(750,26,162,169,5),(751,26,162,170,5),(752,26,162,171,5),(753,26,162,172,5),(754,26,162,173,5),(755,26,163,164,1),(756,26,163,165,2),(757,26,163,166,3),(758,26,163,167,3),(759,26,163,168,3),(760,26,163,169,3),(761,26,163,170,3),(762,26,163,171,3),(763,26,163,172,3),(764,26,163,173,3),(765,26,164,165,2),(766,26,164,166,3),(767,26,164,167,3),(768,26,164,168,3),(769,26,164,169,3),(770,26,164,170,3),(771,26,164,171,3),(772,26,164,172,3),(773,26,164,173,3),(774,26,165,166,3),(775,26,165,167,3),(776,26,165,168,3),(777,26,165,169,3),(778,26,165,170,3),(779,26,165,171,3),(780,26,165,172,3),(781,26,165,173,3),(782,26,166,167,3),(783,26,166,168,2),(784,26,166,169,3),(785,26,166,170,3),(786,26,166,171,3),(787,26,166,172,3),(788,26,166,173,3),(789,26,167,168,2),(790,26,167,169,2),(791,26,167,170,3),(792,26,167,171,3),(793,26,167,172,3),(794,26,167,173,3),(795,26,168,169,2),(796,26,168,170,3),(797,26,168,171,3),(798,26,168,172,3),(799,26,168,173,3),(800,26,169,170,2),(801,26,169,171,3),(802,26,169,172,3),(803,26,169,173,3),(804,26,170,171,3),(805,26,170,172,3),(806,26,170,173,3),(807,26,171,172,2),(808,26,171,173,2),(809,26,172,173,1);
/*!40000 ALTER TABLE `subkriteria_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `id_user_level` int NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `batch_active` int DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_user_level` (`id_user_level`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_user_level`) REFERENCES `user_level` (`id_user_level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'Admin','admin@gmail.com','admin','21232f297a57a5a743894a0e4a801fc3',2),(7,2,'User','user@gmail.com','user','ee11cbb19052e40b07aac0ca060c23ee',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_level`
--

DROP TABLE IF EXISTS `user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_level` (
  `id_user_level` int NOT NULL AUTO_INCREMENT,
  `user_level` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user_level`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_level`
--

LOCK TABLES `user_level` WRITE;
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` VALUES (1,'Administrator'),(2,'User');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'spk_ahp_ci_3'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-01  0:20:05
