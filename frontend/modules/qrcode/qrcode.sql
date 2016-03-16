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
--
-- ----------------------------
-- Records of tbhome_anti_prize
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_anti_reply
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_anti_replyttcccccccttt7777777`;
CREATE TABLE `tbhome_anti_replyttcccccccttt7777777` (
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
INSERT INTO `tbhome_anti_replyttcccccccttt7777777` VALUES ('1', '1', '唯卡微防伪', '您好！您所查询的商品为{{产品品牌}}正品！<br/>产品名称：{{产品名称}}<br/>生产厂家：{{产品厂家}}<br/>之前已被查询：{{查询次数}}次，<br/>上次查询时间：{{查询时间}}', '您所查询的防伪码不存在，请谨防假冒', '该信息为DIY网页，用百度编辑器，设计精彩图文内容', '10');

-- ----------------------------
-- Table structure for tbhome_anti_setting
