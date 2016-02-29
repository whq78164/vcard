
-- ----------------------------
-- Table structure for tbhome_company
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_company`;
CREATE TABLE `tbhome_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `tpl` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbhome_company
-- ----------------------------
INSERT INTO `tbhome_company` VALUES ('1', '1', '捷微信息科技有限公司', '福建泉州丰泽', '', '1', 'Uploads/1/company/company_1456336043.jpg', null);

-- ----------------------------
-- Table structure for tbhome_company_department
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_company_department`;
CREATE TABLE `tbhome_company_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbhome_company_department
-- ----------------------------
INSERT INTO `tbhome_company_department` VALUES ('1', '1', '数字营销科');


-- ----------------------------
-- Table structure for tbhome_company_worker
-- ----------------------------
DROP TABLE IF EXISTS `tbhome_company_worker`;
CREATE TABLE `tbhome_company_worker` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `job_id` varchar(30) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `qq` int(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `head_img` varchar(255) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `task` varchar(255) DEFAULT NULL,
  `work_tel` varchar(30) DEFAULT NULL,
  `wechat_account` varchar(50) DEFAULT NULL,
  `wechat_qrcode` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `is_work` smallint(6) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbhome_company_worker
-- ----------------------------
INSERT INTO `tbhome_company_worker` VALUES ('1', '1', '123456', '1', '1', '李俊跃', '13788823901', '165479137', '165479137@qq.com', 'Uploads/1/company/workers/worker_img1456332698.png', '科长', '', '0595-12345678', 'chongchongwell', '', '0595-12345678', '0', '');
INSERT INTO `tbhome_company_worker` VALUES ('2', '1', '456789', '2', '2', '林远雷', '13599244282', '19481405', '19481405@qq.com', 'Uploads/1/company/workers/worker_img1456334953.png', '项目经理', '', '0595-87654321', 'yuanleilin', '', '0595-87654321', '10', '');
INSERT INTO `tbhome_company_worker` VALUES ('3', '1', '123458', '1', '1', '李俊跃1', '13599244282', '19481405', '165479137@qq.com', 'Uploads/1/company/workers/worker_img1456331091.png', '项目经理', '', '', '', '', '', '0', '');
INSERT INTO `tbhome_company_worker` VALUES ('4', '1', '456666', '1', '1', '李俊跃', '13599244282', '19481405', '165479137@qq.com', 'Uploads/1/company/workers/worker_img1456331355.jpg', '', '', '', '', '', '', '10', '');
