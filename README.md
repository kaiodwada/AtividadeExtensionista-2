Script para criar as tabelas utilizadas:

-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: projetouninter
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aluno` (
  `id_aluno` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idade` int DEFAULT NULL,
  `tipoEnsino` varchar(50) DEFAULT NULL,
  `nivelAcesso` int NOT NULL,
  `id_turma` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_aluno`),
  UNIQUE KEY `matricula` (`matricula`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  KEY `id_turma` (`id_turma`),
  CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE SET NULL,
  CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comunicados`
--

DROP TABLE IF EXISTS `comunicados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comunicados` (
  `id_comunicado` int NOT NULL AUTO_INCREMENT,
  `id_professor` int NOT NULL,
  `id_turma` int NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `info_status` enum('Informativo','Importante') DEFAULT NULL,
  `texto_comunicado` text NOT NULL,
  `data_envio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comunicado`),
  KEY `id_professor` (`id_professor`),
  KEY `id_turma` (`id_turma`),
  CONSTRAINT `comunicados_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`) ON DELETE CASCADE,
  CONSTRAINT `comunicados_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `desempenhoprovas`
--

DROP TABLE IF EXISTS `desempenhoprovas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `desempenhoprovas` (
  `id_desempenho` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int NOT NULL,
  `id_turma` int NOT NULL,
  `id_materia` int NOT NULL,
  `nota_primeira_prova` decimal(5,2) DEFAULT NULL,
  `nota_segunda_prova` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id_desempenho`),
  KEY `id_aluno` (`id_aluno`),
  KEY `id_turma` (`id_turma`),
  KEY `id_materia` (`id_materia`),
  CONSTRAINT `desempenhoprovas_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE,
  CONSTRAINT `desempenhoprovas_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE CASCADE,
  CONSTRAINT `desempenhoprovas_ibfk_3` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `diretor`
--

DROP TABLE IF EXISTS `diretor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diretor` (
  `id_diretor` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nivelAcesso` int NOT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_diretor`),
  UNIQUE KEY `matricula` (`matricula`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `diretor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias` (
  `id_materia` int NOT NULL AUTO_INCREMENT,
  `nomeMateria` varchar(50) NOT NULL,
  `id_professor` int DEFAULT NULL,
  PRIMARY KEY (`id_materia`),
  KEY `id_professor` (`id_professor`),
  CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professor` (
  `id_professor` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nivelAcesso` int NOT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_professor`),
  UNIQUE KEY `matricula` (`matricula`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `turma`
--

DROP TABLE IF EXISTS `turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turma` (
  `id_turma` int NOT NULL AUTO_INCREMENT,
  `nomeTurma` varchar(50) NOT NULL,
  `id_professor` int DEFAULT NULL,
  PRIMARY KEY (`id_turma`),
  KEY `id_professor` (`id_professor`),
  CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `matricula_usuario` varchar(50) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `tipo_usuario` enum('Aluno','Professor','Diretor') NOT NULL,
  `status_conta` tinyint DEFAULT '1',
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login_identificador` (`matricula_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

