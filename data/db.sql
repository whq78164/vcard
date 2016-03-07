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

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbhome_anti_code
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_anti_code`;
CREATE TABLE `tbhome_anti_code` (
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
DROP TABLE IF EXISTS `tbhome_anti_prize`;
CREATE TABLE `tbhome_anti_prize` (
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
DROP TABLE IF EXISTS `tbhome_anti_reply`;
CREATE TABLE `tbhome_anti_reply` (
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
INSERT INTO `tbhome_anti_reply` VALUES ('1', '1', '唯卡微防伪', '您好！您所查询的商品为{{产品品牌}}正品！<br/>产品名称：{{产品名称}}<br/>生产厂家：{{产品厂家}}<br/>之前已被查询：{{查询次数}}次，<br/>上次查询时间：{{查询时间}}', '您所查询的防伪码不存在，请谨防假冒', '该信息为DIY网页，用百度编辑器，设计精彩图文内容', '10');

-- ----------------------------
-- Table structure for tbhome_anti_setting
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_anti_setting`;
CREATE TABLE `tbhome_anti_setting` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_select` smallint(6) NOT NULL DEFAULT '10',
  `api_parameter` smallint(6) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_anti_setting
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_card_info
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_card_info`;
CREATE TABLE `tbhome_card_info` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `card_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `face_box` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business` text COLLATE utf8_unicode_ci NOT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `wechat_account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `wechat_qrcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `work_tel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_card_info
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_label
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_label`;
CREATE TABLE `tbhome_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `card_label` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `card_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_label
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_microlink
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_microlink`;
CREATE TABLE `tbhome_microlink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `link_title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_microlink
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_micropage
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_micropage`;
CREATE TABLE `tbhome_micropage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `page_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `page_content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_micropage
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_migration
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_migration`;
CREATE TABLE `tbhome_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbhome_migration
-- ----------------------------
INSERT INTO `tbhome_migration` VALUES ('m000000_000000_base', '1446651340');
INSERT INTO `tbhome_migration` VALUES ('m130524_201442_init', '1446651541');
INSERT INTO `tbhome_migration` VALUES ('m130524_201443_init', '1446651541');
INSERT INTO `tbhome_migration` VALUES ('m151011_060939_newColumn', '1446651542');

-- ----------------------------
-- Table structure for tbhome_module
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_module`;
CREATE TABLE `tbhome_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `module_label` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `module_des` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_module
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_product
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_product`;
CREATE TABLE `tbhome_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `share` smallint(6) NOT NULL DEFAULT '10',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `factory` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `describe` text COLLATE utf8_unicode_ci NOT NULL,
  `specification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `traceability` int(11) NOT NULL,
  `hot` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `hot` (`hot`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_product
-- ----------------------------
INSERT INTO `tbhome_product` VALUES ('1', '1', '10', 'http://www.vcards.top/Uploads/default_face.jpg', '二维码轻工厂', '二维码贴纸', '百度编辑器，编辑产品精彩图文详情', '50mm*70mm', '张', '唯卡', '0.10', '1', '0');

-- ----------------------------
-- Table structure for tbhome_relation
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_relation`;
CREATE TABLE `tbhome_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid1` int(11) NOT NULL,
  `uid2` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid1` (`uid1`,`uid2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_relation
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_setting
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_setting`;
CREATE TABLE `tbhome_setting` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `bg_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tpl` int(11) NOT NULL,
  `vip` smallint(6) NOT NULL DEFAULT '10',
  `upline` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `leader` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_setting
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_sys
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_sys`;
CREATE TABLE `tbhome_sys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '123456789',
  `sitetitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '123456789',
  `company` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '123456789',
  `tel` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '123456789',
  `qq` int(11) NOT NULL DEFAULT '798904845',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '798904845',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '798904845',
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '798904845',
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '798904845',
  `siteurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '798904845',
  `copyright` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '798904845',
  `icp` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '798904845',
  `ip` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '798904845',
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `admin_user` (`admin_user`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_sys
-- ----------------------------
INSERT INTO `tbhome_sys` VALUES ('1', 'admin', '', '唯卡微名片', '通宝科技', '', '798904845', 'admin@tbhome.com.cn', '', '', '', 'http://www.vcards.top', '', '', '127.0.0.1', '10');

-- ----------------------------
-- Table structure for tbhome_tel
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_tel`;
CREATE TABLE `tbhome_tel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tel_label` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tel_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_tel
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_traceability_data
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_traceability_data`;
CREATE TABLE `tbhome_traceability_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `productid` int(11) NOT NULL,
  `traceabilityid` int(11) NOT NULL,
  `query_time` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `localremark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_traceability_data
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_traceability_info
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_traceability_info`;
CREATE TABLE `tbhome_traceability_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `describe` text COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_traceability_info
-- ----------------------------

-- ----------------------------
-- Table structure for tbhome_user
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_user`;
CREATE TABLE `tbhome_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `qq` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `login` int(11) NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `created_ip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_ip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_user
-- ----------------------------
INSERT INTO `tbhome_user` VALUES ('1', 'admin', 'www.vcards.top', '15980016080', '798904845', 'admin@tbhome.com.cn', '$2y$13$SlenslU25pIng3zGfdPdNus8um0U3yim5Z/I7a3GN47gPKj0xsmsW', '', '10', '0', null, '100', '', '', '0', '0');

-- ----------------------------
-- Table structure for tbhome_usermodule
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_usermodule`;
CREATE TABLE `tbhome_usermodule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `moduleid` int(11) NOT NULL,
  `module_status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `moduleid` (`moduleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tbhome_anti_log`;
CREATE TABLE `tbhome_anti_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startid` int(11) NOT NULL,
  `endid` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbhome_usermodule
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_wechatgh`;
CREATE TABLE `tbhome_wechatgh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `appsecret` varchar(255) DEFAULT NULL,
  `mchid` varchar(255) DEFAULT NULL,
  `mchsecret` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `aeskey` varchar(255) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `appid` (`appid`),
  KEY `mchid` (`mchid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;