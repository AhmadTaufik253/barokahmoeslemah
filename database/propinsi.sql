/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST V8
 Source Server Type    : MySQL
 Source Server Version : 80013
 Source Host           : localhost:3306
 Source Schema         : ecommerce

 Target Server Type    : MySQL
 Target Server Version : 80013
 File Encoding         : 65001

 Date: 16/07/2021 11:33:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for propinsi
-- ----------------------------
DROP TABLE IF EXISTS `propinsi`;
CREATE TABLE `propinsi`  (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`province_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of propinsi
-- ----------------------------
INSERT INTO `propinsi` VALUES (1, 'Bali');
INSERT INTO `propinsi` VALUES (2, 'Bangka Belitung');
INSERT INTO `propinsi` VALUES (3, 'Banten');
INSERT INTO `propinsi` VALUES (4, 'Bengkulu');
INSERT INTO `propinsi` VALUES (5, 'DI Yogyakarta');
INSERT INTO `propinsi` VALUES (6, 'DKI Jakarta');
INSERT INTO `propinsi` VALUES (7, 'Gorontalo');
INSERT INTO `propinsi` VALUES (8, 'Jambi');
INSERT INTO `propinsi` VALUES (9, 'Jawa Barat');
INSERT INTO `propinsi` VALUES (10, 'Jawa Tengah');
INSERT INTO `propinsi` VALUES (11, 'Jawa Timur');
INSERT INTO `propinsi` VALUES (12, 'Kalimantan Barat');
INSERT INTO `propinsi` VALUES (13, 'Kalimantan Selatan');
INSERT INTO `propinsi` VALUES (14, 'Kalimantan Tengah');
INSERT INTO `propinsi` VALUES (15, 'Kalimantan Timur');
INSERT INTO `propinsi` VALUES (16, 'Kalimantan Utara');
INSERT INTO `propinsi` VALUES (17, 'Kepulauan Riau');
INSERT INTO `propinsi` VALUES (18, 'Lampung');
INSERT INTO `propinsi` VALUES (19, 'Maluku');
INSERT INTO `propinsi` VALUES (20, 'Maluku Utara');
INSERT INTO `propinsi` VALUES (21, 'Nanggroe Aceh Darussalam (NAD)');
INSERT INTO `propinsi` VALUES (22, 'Nusa Tenggara Barat (NTB)');
INSERT INTO `propinsi` VALUES (23, 'Nusa Tenggara Timur (NTT)');
INSERT INTO `propinsi` VALUES (24, 'Papua');
INSERT INTO `propinsi` VALUES (25, 'Papua Barat');
INSERT INTO `propinsi` VALUES (26, 'Riau');
INSERT INTO `propinsi` VALUES (27, 'Sulawesi Barat');
INSERT INTO `propinsi` VALUES (28, 'Sulawesi Selatan');
INSERT INTO `propinsi` VALUES (29, 'Sulawesi Tengah');
INSERT INTO `propinsi` VALUES (30, 'Sulawesi Tenggara');
INSERT INTO `propinsi` VALUES (31, 'Sulawesi Utara');
INSERT INTO `propinsi` VALUES (32, 'Sumatera Barat');
INSERT INTO `propinsi` VALUES (33, 'Sumatera Selatan');
INSERT INTO `propinsi` VALUES (34, 'Sumatera Utara');

SET FOREIGN_KEY_CHECKS = 1;
