/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50633
 Source Host           : 127.0.0.1
 Source Database       : miai

 Target Server Type    : MySQL
 Target Server Version : 50633
 File Encoding         : utf-8

 Date: 01/25/2019 09:41:00 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `tb_session3rd`
-- ----------------------------
DROP TABLE IF EXISTS `tb_session3rd`;
CREATE TABLE `tb_session3rd` (
  `id` varchar(32) NOT NULL,
  `session_key` varchar(255) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `expires_in` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tb_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nickName` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `sex` int(1) NOT NULL,
  `birthday` date NOT NULL,
  `height` int(4) DEFAULT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `marital` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `career` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `havecar` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `havehouse` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `referrer` int(6) DEFAULT NULL,
  `zodiac` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `constellation` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `livingArea` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `unitNature` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `province_code` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `city_code` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `annual_salary` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `createdAt` date DEFAULT NULL,
  `updatedAt` date DEFAULT NULL,
  `openid` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `wx_avatar` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `wx_nickname` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `is_finish` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Table structure for `tb_weixin`
-- ----------------------------
DROP TABLE IF EXISTS `tb_weixin`;
CREATE TABLE `tb_weixin` (
  `openId` varbinary(255) NOT NULL,
  `nickName` varchar(255) DEFAULT NULL,
  `avatarUrl` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`openId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
