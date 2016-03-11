/*
Navicat MySQL Data Transfer

Source Server         : localPHPStudy
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : vcardsbranch

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-11-05 01:04:14
*/



-- ----------------------------
-- Table structure for tbhome_anti_code
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_anti_code9999`;
CREATE TABLE `tbhome_anti_code9999` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `replyid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `traceabilityid` int(11) NOT NULL DEFAULT '1',
  `query_time` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `prize` text COLLATE utf8_unicode_ci NOT NULL,
 `remark` text COLLATE utf8_unicode_ci NOT NULL,
 `query_area` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_anti_code
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_anti_prize
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_anti_prize9999`;
CREATE TABLE `tbhome_anti_prize9999` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `share` smallint(6) NOT NULL DEFAULT '10',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade` smallint(6) NOT NULL,
  `hot` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `hot` (`hot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_anti_prize
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_anti_reply
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_anti_replyttttt`;
CREATE TABLE `tbhome_anti_replyttttt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tag` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `success` text COLLATE utf8_unicode_ci NOT NULL,
  `fail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `valid_clicks` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_anti_reply
-- ----------------------------
INSERT INTO `tbhome_anti_replyttttt` VALUES ('1', '1', '唯卡微防伪', '您好！您所查询的商品为{{产品品牌}}正品！<br/>产品名称：{{产品名称}}<br/>生产厂家：{{产品厂家}}<br/>之前已被查询：{{查询次数}}次，<br/>上次查询时间：{{查询时间}}', '您所查询的防伪码不存在，请谨防假冒', '该信息为DIY网页，用百度编辑器，设计精彩图文内容', '10');

-- ----------------------------
-- Table structure for tbhome_anti_setting
