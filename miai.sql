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

 Date: 02/27/2019 17:51:09 PM
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
--  Table structure for `tb_sms`
-- ----------------------------
DROP TABLE IF EXISTS `tb_sms`;
CREATE TABLE `tb_sms` (
  `id` varchar(255) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `code` varchar(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tb_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `county` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `year` varchar(5) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `month` varchar(5) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `day` varchar(5) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `height` varchar(5) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `marriage` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `income` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `openid` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `is_finish` int(1) DEFAULT '0',
  `createdAt` date DEFAULT NULL,
  `updatedAt` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Table structure for `tb_weixin`
-- ----------------------------
DROP TABLE IF EXISTS `tb_weixin`;
CREATE TABLE `tb_weixin` (
  `openId` varchar(255) NOT NULL,
  `nickName` varchar(255) DEFAULT NULL,
  `avatarUrl` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `countryCode` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`openId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
