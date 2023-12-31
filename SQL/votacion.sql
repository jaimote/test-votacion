/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : votacion

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-12-30 22:30:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for candidato
-- ----------------------------
DROP TABLE IF EXISTS `candidato`;
CREATE TABLE `candidato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of candidato
-- ----------------------------
INSERT INTO `candidato` VALUES ('1', 'jaime', 'salazar');
INSERT INTO `candidato` VALUES ('2', 'benjamin', 'rebolledo');
INSERT INTO `candidato` VALUES ('3', 'cristina', 'oliva');
INSERT INTO `candidato` VALUES ('4', 'felipe', 'avello');

-- ----------------------------
-- Table structure for comuna
-- ----------------------------
DROP TABLE IF EXISTS `comuna`;
CREATE TABLE `comuna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `region_id_fk` (`region_id`),
  CONSTRAINT `region_id_fk` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of comuna
-- ----------------------------
INSERT INTO `comuna` VALUES ('1', '1', 'puente alto');
INSERT INTO `comuna` VALUES ('2', '1', 'la florida');
INSERT INTO `comuna` VALUES ('3', '1', 'la pintana');
INSERT INTO `comuna` VALUES ('4', '1', 'san bernardo');
INSERT INTO `comuna` VALUES ('5', '1', 'el bosque');
INSERT INTO `comuna` VALUES ('6', '1', 'la granja');
INSERT INTO `comuna` VALUES ('7', '2', 'arica');
INSERT INTO `comuna` VALUES ('8', '3', 'iquique');
INSERT INTO `comuna` VALUES ('9', '4', 'antofagasta');
INSERT INTO `comuna` VALUES ('10', '5', 'la serena');
INSERT INTO `comuna` VALUES ('11', '6', 'coquimbo');
INSERT INTO `comuna` VALUES ('12', '8', 'rancagua');
INSERT INTO `comuna` VALUES ('13', '9', 'talca');

-- ----------------------------
-- Table structure for region
-- ----------------------------
DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of region
-- ----------------------------
INSERT INTO `region` VALUES ('1', 'metropolitana');
INSERT INTO `region` VALUES ('2', 'arica');
INSERT INTO `region` VALUES ('3', 'tarapaca');
INSERT INTO `region` VALUES ('4', 'antofagasta');
INSERT INTO `region` VALUES ('5', 'atacama');
INSERT INTO `region` VALUES ('6', 'serena');
INSERT INTO `region` VALUES ('7', 'valparaiso');
INSERT INTO `region` VALUES ('8', 'ohiggins');
INSERT INTO `region` VALUES ('9', 'maule');
INSERT INTO `region` VALUES ('10', 'biobio');

-- ----------------------------
-- Table structure for votacion
-- ----------------------------
DROP TABLE IF EXISTS `votacion`;
CREATE TABLE `votacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rut` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `comuna_id` int(11) DEFAULT NULL,
  `candidato_id` int(11) DEFAULT NULL,
  `nosotros` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `comuna_id_fk` (`comuna_id`),
  KEY `candidato_id_fk` (`candidato_id`),
  CONSTRAINT `candidato_id_fk` FOREIGN KEY (`candidato_id`) REFERENCES `candidato` (`id`),
  CONSTRAINT `comuna_id_fk` FOREIGN KEY (`comuna_id`) REFERENCES `comuna` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of votacion
-- ----------------------------
