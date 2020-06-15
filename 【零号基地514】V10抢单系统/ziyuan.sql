/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : ziyuan

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-04-20 18:48:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mirrormx_customer_chat_data
-- ----------------------------
DROP TABLE IF EXISTS `mirrormx_customer_chat_data`;
CREATE TABLE `mirrormx_customer_chat_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `data_type_ix` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mirrormx_customer_chat_data
-- ----------------------------
INSERT INTO `mirrormx_customer_chat_data` VALUES ('1', 'canned_message', '你好呀', '你好!');

-- ----------------------------
-- Table structure for mirrormx_customer_chat_department
-- ----------------------------
DROP TABLE IF EXISTS `mirrormx_customer_chat_department`;
CREATE TABLE `mirrormx_customer_chat_department` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mirrormx_customer_chat_department
-- ----------------------------

-- ----------------------------
-- Table structure for mirrormx_customer_chat_message
-- ----------------------------
DROP TABLE IF EXISTS `mirrormx_customer_chat_message`;
CREATE TABLE `mirrormx_customer_chat_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `talk_id` int(10) unsigned NOT NULL,
  `extra` text,
  PRIMARY KEY (`id`),
  KEY `message_fk_talk` (`talk_id`),
  KEY `message_from_id_ix` (`from_id`),
  KEY `message_to_id_ix` (`to_id`),
  KEY `message_datetime_ix` (`datetime`),
  CONSTRAINT `message_fk_talk` FOREIGN KEY (`talk_id`) REFERENCES `mirrormx_customer_chat_talk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mirrormx_customer_chat_message
-- ----------------------------

-- ----------------------------
-- Table structure for mirrormx_customer_chat_shared_file
-- ----------------------------
DROP TABLE IF EXISTS `mirrormx_customer_chat_shared_file`;
CREATE TABLE `mirrormx_customer_chat_shared_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `original_name` varchar(255) NOT NULL,
  `name` varchar(32) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(10) unsigned DEFAULT NULL,
  `upload_id` int(10) unsigned NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shared_file_fk_upload` (`upload_id`),
  CONSTRAINT `shared_file_fk_upload` FOREIGN KEY (`upload_id`) REFERENCES `mirrormx_customer_chat_upload` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mirrormx_customer_chat_shared_file
-- ----------------------------

-- ----------------------------
-- Table structure for mirrormx_customer_chat_talk
-- ----------------------------
DROP TABLE IF EXISTS `mirrormx_customer_chat_talk`;
CREATE TABLE `mirrormx_customer_chat_talk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state` varchar(32) DEFAULT NULL,
  `department_id` smallint(5) unsigned DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `last_activity` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `extra` text,
  PRIMARY KEY (`id`),
  KEY `talk_fk_department` (`department_id`),
  KEY `talk_owner_ix` (`owner`),
  KEY `talk_last_activity_ix` (`last_activity`),
  CONSTRAINT `talk_fk_department` FOREIGN KEY (`department_id`) REFERENCES `mirrormx_customer_chat_department` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mirrormx_customer_chat_talk
-- ----------------------------

-- ----------------------------
-- Table structure for mirrormx_customer_chat_upload
-- ----------------------------
DROP TABLE IF EXISTS `mirrormx_customer_chat_upload`;
CREATE TABLE `mirrormx_customer_chat_upload` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(10) unsigned NOT NULL,
  `state` varchar(16) NOT NULL,
  `files_info` text,
  `size` int(10) unsigned DEFAULT NULL,
  `progress` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_fk_message` (`message_id`),
  CONSTRAINT `upload_fk_message` FOREIGN KEY (`message_id`) REFERENCES `mirrormx_customer_chat_message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mirrormx_customer_chat_upload
-- ----------------------------

-- ----------------------------
-- Table structure for mirrormx_customer_chat_user
-- ----------------------------
DROP TABLE IF EXISTS `mirrormx_customer_chat_user`;
CREATE TABLE `mirrormx_customer_chat_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `info` text,
  `roles` varchar(128) DEFAULT NULL,
  `last_activity` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_mail_ix` (`mail`),
  KEY `user_last_activity_ix` (`last_activity`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mirrormx_customer_chat_user
-- ----------------------------
INSERT INTO `mirrormx_customer_chat_user` VALUES ('1', 'admin', 'admin', 'e86e685ea0ff10e1ea942ba647e63fea2383fa0b', null, '{\"ip\":\"127.0.0.1\"}', 'ADMIN,OPERATOR', '2020-01-18 00:06:34');
INSERT INTO `mirrormx_customer_chat_user` VALUES ('2', 'anonymous-1576222526', 'no@e.mail.provided', 'x', null, '{\"ip\":\"113.98.116.92\",\"referer\":\"http:\\/\\/qd2.hskj2016.com\\/customlivechat\\/php\\/app.php?widget-test\",\"userAgent\":\"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/78.0.3904.108 Safari\\/537.36\",\"browserName\":\"chrome\",\"browserVersion\":\"78.0\",\"os\":\"windows\",\"engine\":\"webkit\",\"language\":\"zh\",\"geoloc\":{\"countryCode\":\"CN\",\"countryName\":\"China\",\"regionCode\":\"44\",\"regionName\":\"Guangdong\",\"city\":\"Guangzhou\",\"zipCode\":null,\"timeZone\":\"Asia\\/Shanghai\",\"latitude\":23.1167,\"longitude\":113.25,\"metroCode\":null,\"utcOffset\":-480}}', 'GUEST', '2019-12-13 16:13:03');

-- ----------------------------
-- Table structure for mirrormx_customer_chat_user_department
-- ----------------------------
DROP TABLE IF EXISTS `mirrormx_customer_chat_user_department`;
CREATE TABLE `mirrormx_customer_chat_user_department` (
  `user_id` int(11) NOT NULL,
  `department_id` smallint(5) unsigned NOT NULL,
  UNIQUE KEY `user_department_uq` (`user_id`,`department_id`),
  KEY `user_department_fk_department` (`department_id`),
  CONSTRAINT `user_department_fk_department` FOREIGN KEY (`department_id`) REFERENCES `mirrormx_customer_chat_department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_department_fk_user` FOREIGN KEY (`user_id`) REFERENCES `mirrormx_customer_chat_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mirrormx_customer_chat_user_department
-- ----------------------------

-- ----------------------------
-- Table structure for system_auth
-- ----------------------------
DROP TABLE IF EXISTS `system_auth`;
CREATE TABLE `system_auth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL COMMENT '权限名称',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '权限状态',
  `sort` bigint(20) unsigned DEFAULT '0' COMMENT '排序权重',
  `desc` varchar(255) DEFAULT '' COMMENT '备注说明',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_system_auth_status` (`status`) USING BTREE,
  KEY `index_system_auth_title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='系统-权限';

-- ----------------------------
-- Records of system_auth
-- ----------------------------
INSERT INTO `system_auth` VALUES ('1', '测试账号', '1', '0', '拥有全部权限', '2019-10-17 14:04:15');
INSERT INTO `system_auth` VALUES ('2', '代理', '1', '0', '代理', '2020-02-06 17:09:03');

-- ----------------------------
-- Table structure for system_auth_node
-- ----------------------------
DROP TABLE IF EXISTS `system_auth_node`;
CREATE TABLE `system_auth_node` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth` bigint(20) unsigned DEFAULT NULL COMMENT '角色',
  `node` varchar(200) DEFAULT NULL COMMENT '节点',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_system_auth_auth` (`auth`) USING BTREE,
  KEY `index_system_auth_node` (`node`(191)) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1431 DEFAULT CHARSET=utf8mb4 COMMENT='系统-权限-授权';

-- ----------------------------
-- Records of system_auth_node
-- ----------------------------
INSERT INTO `system_auth_node` VALUES ('1204', '2', 'admin');
INSERT INTO `system_auth_node` VALUES ('1205', '2', 'admin/deal');
INSERT INTO `system_auth_node` VALUES ('1206', '2', 'admin/deal/order_list');
INSERT INTO `system_auth_node` VALUES ('1207', '2', 'admin/deal/user_recharge');
INSERT INTO `system_auth_node` VALUES ('1208', '2', 'admin/deal/deposit_list');
INSERT INTO `system_auth_node` VALUES ('1209', '2', 'admin/users');
INSERT INTO `system_auth_node` VALUES ('1210', '2', 'admin/users/index');
INSERT INTO `system_auth_node` VALUES ('1211', '2', 'admin/users/edit_users_ewm');
INSERT INTO `system_auth_node` VALUES ('1321', '1', 'admin');
INSERT INTO `system_auth_node` VALUES ('1322', '1', 'admin/auth');
INSERT INTO `system_auth_node` VALUES ('1323', '1', 'admin/auth/index');
INSERT INTO `system_auth_node` VALUES ('1324', '1', 'admin/auth/apply');
INSERT INTO `system_auth_node` VALUES ('1325', '1', 'admin/auth/add');
INSERT INTO `system_auth_node` VALUES ('1326', '1', 'admin/auth/edit');
INSERT INTO `system_auth_node` VALUES ('1327', '1', 'admin/auth/refresh');
INSERT INTO `system_auth_node` VALUES ('1328', '1', 'admin/auth/forbid');
INSERT INTO `system_auth_node` VALUES ('1329', '1', 'admin/auth/resume');
INSERT INTO `system_auth_node` VALUES ('1330', '1', 'admin/auth/remove');
INSERT INTO `system_auth_node` VALUES ('1331', '1', 'admin/config');
INSERT INTO `system_auth_node` VALUES ('1332', '1', 'admin/config/info');
INSERT INTO `system_auth_node` VALUES ('1333', '1', 'admin/config/config');
INSERT INTO `system_auth_node` VALUES ('1334', '1', 'admin/config/file');
INSERT INTO `system_auth_node` VALUES ('1335', '1', 'admin/deal');
INSERT INTO `system_auth_node` VALUES ('1336', '1', 'admin/deal/order_list');
INSERT INTO `system_auth_node` VALUES ('1337', '1', 'admin/deal/deal_console');
INSERT INTO `system_auth_node` VALUES ('1338', '1', 'admin/deal/goods_list');
INSERT INTO `system_auth_node` VALUES ('1339', '1', 'admin/deal/goods_cate');
INSERT INTO `system_auth_node` VALUES ('1340', '1', 'admin/deal/add_goods');
INSERT INTO `system_auth_node` VALUES ('1341', '1', 'admin/deal/add_cate');
INSERT INTO `system_auth_node` VALUES ('1342', '1', 'admin/deal/edit_goods');
INSERT INTO `system_auth_node` VALUES ('1343', '1', 'admin/deal/edit_cate');
INSERT INTO `system_auth_node` VALUES ('1344', '1', 'admin/deal/edit_goods_status');
INSERT INTO `system_auth_node` VALUES ('1345', '1', 'admin/deal/del_goods');
INSERT INTO `system_auth_node` VALUES ('1346', '1', 'admin/deal/del_cate');
INSERT INTO `system_auth_node` VALUES ('1347', '1', 'admin/deal/user_recharge');
INSERT INTO `system_auth_node` VALUES ('1348', '1', 'admin/deal/edit_recharge');
INSERT INTO `system_auth_node` VALUES ('1349', '1', 'admin/deal/deposit_list');
INSERT INTO `system_auth_node` VALUES ('1350', '1', 'admin/deal/do_deposit');
INSERT INTO `system_auth_node` VALUES ('1351', '1', 'admin/deal/do_deposit2');
INSERT INTO `system_auth_node` VALUES ('1352', '1', 'admin/deal/daochu');
INSERT INTO `system_auth_node` VALUES ('1353', '1', 'admin/deal/do_deposit3');
INSERT INTO `system_auth_node` VALUES ('1354', '1', 'admin/deal/do_commission');
INSERT INTO `system_auth_node` VALUES ('1355', '1', 'admin/deal/order_log');
INSERT INTO `system_auth_node` VALUES ('1356', '1', 'admin/deal/team_reward');
INSERT INTO `system_auth_node` VALUES ('1357', '1', 'admin/help');
INSERT INTO `system_auth_node` VALUES ('1358', '1', 'admin/help/message_ctrl');
INSERT INTO `system_auth_node` VALUES ('1359', '1', 'admin/help/add_message');
INSERT INTO `system_auth_node` VALUES ('1360', '1', 'admin/help/edit_message');
INSERT INTO `system_auth_node` VALUES ('1361', '1', 'admin/help/del_message');
INSERT INTO `system_auth_node` VALUES ('1362', '1', 'admin/help/home_msg');
INSERT INTO `system_auth_node` VALUES ('1363', '1', 'admin/help/edit_home_msg');
INSERT INTO `system_auth_node` VALUES ('1364', '1', 'admin/help/banner');
INSERT INTO `system_auth_node` VALUES ('1365', '1', 'admin/help/edit_banner');
INSERT INTO `system_auth_node` VALUES ('1366', '1', 'admin/help/add_banner');
INSERT INTO `system_auth_node` VALUES ('1367', '1', 'admin/index');
INSERT INTO `system_auth_node` VALUES ('1368', '1', 'admin/index/main');
INSERT INTO `system_auth_node` VALUES ('1369', '1', 'admin/index/clearruntime');
INSERT INTO `system_auth_node` VALUES ('1370', '1', 'admin/index/buildoptimize');
INSERT INTO `system_auth_node` VALUES ('1371', '1', 'admin/menu');
INSERT INTO `system_auth_node` VALUES ('1372', '1', 'admin/menu/index');
INSERT INTO `system_auth_node` VALUES ('1373', '1', 'admin/menu/add');
INSERT INTO `system_auth_node` VALUES ('1374', '1', 'admin/menu/edit');
INSERT INTO `system_auth_node` VALUES ('1375', '1', 'admin/menu/resume');
INSERT INTO `system_auth_node` VALUES ('1376', '1', 'admin/menu/forbid');
INSERT INTO `system_auth_node` VALUES ('1377', '1', 'admin/menu/remove');
INSERT INTO `system_auth_node` VALUES ('1378', '1', 'admin/oplog');
INSERT INTO `system_auth_node` VALUES ('1379', '1', 'admin/oplog/index');
INSERT INTO `system_auth_node` VALUES ('1380', '1', 'admin/oplog/clear');
INSERT INTO `system_auth_node` VALUES ('1381', '1', 'admin/oplog/remove');
INSERT INTO `system_auth_node` VALUES ('1382', '1', 'admin/pay');
INSERT INTO `system_auth_node` VALUES ('1383', '1', 'admin/pay/index');
INSERT INTO `system_auth_node` VALUES ('1384', '1', 'admin/pay/edit');
INSERT INTO `system_auth_node` VALUES ('1385', '1', 'admin/queue');
INSERT INTO `system_auth_node` VALUES ('1386', '1', 'admin/queue/index');
INSERT INTO `system_auth_node` VALUES ('1387', '1', 'admin/queue/redo');
INSERT INTO `system_auth_node` VALUES ('1388', '1', 'admin/queue/processstart');
INSERT INTO `system_auth_node` VALUES ('1389', '1', 'admin/queue/processstop');
INSERT INTO `system_auth_node` VALUES ('1390', '1', 'admin/queue/remove');
INSERT INTO `system_auth_node` VALUES ('1391', '1', 'admin/shop');
INSERT INTO `system_auth_node` VALUES ('1392', '1', 'admin/shop/order_list');
INSERT INTO `system_auth_node` VALUES ('1393', '1', 'admin/shop/goods_list');
INSERT INTO `system_auth_node` VALUES ('1394', '1', 'admin/shop/goods_cate');
INSERT INTO `system_auth_node` VALUES ('1395', '1', 'admin/shop/add_goods');
INSERT INTO `system_auth_node` VALUES ('1396', '1', 'admin/shop/add_cate');
INSERT INTO `system_auth_node` VALUES ('1397', '1', 'admin/shop/edit_goods');
INSERT INTO `system_auth_node` VALUES ('1398', '1', 'admin/shop/edit_cate');
INSERT INTO `system_auth_node` VALUES ('1399', '1', 'admin/shop/edit_goods_status');
INSERT INTO `system_auth_node` VALUES ('1400', '1', 'admin/shop/del_goods');
INSERT INTO `system_auth_node` VALUES ('1401', '1', 'admin/shop/del_cate');
INSERT INTO `system_auth_node` VALUES ('1402', '1', 'admin/shop/daochu');
INSERT INTO `system_auth_node` VALUES ('1403', '1', 'admin/shop/do_deposit3');
INSERT INTO `system_auth_node` VALUES ('1404', '1', 'admin/user');
INSERT INTO `system_auth_node` VALUES ('1405', '1', 'admin/user/index');
INSERT INTO `system_auth_node` VALUES ('1406', '1', 'admin/user/add');
INSERT INTO `system_auth_node` VALUES ('1407', '1', 'admin/user/edit');
INSERT INTO `system_auth_node` VALUES ('1408', '1', 'admin/user/pass');
INSERT INTO `system_auth_node` VALUES ('1409', '1', 'admin/user/forbid');
INSERT INTO `system_auth_node` VALUES ('1410', '1', 'admin/user/resume');
INSERT INTO `system_auth_node` VALUES ('1411', '1', 'admin/user/remove');
INSERT INTO `system_auth_node` VALUES ('1412', '1', 'admin/users');
INSERT INTO `system_auth_node` VALUES ('1413', '1', 'admin/users/index');
INSERT INTO `system_auth_node` VALUES ('1414', '1', 'admin/users/level');
INSERT INTO `system_auth_node` VALUES ('1415', '1', 'admin/users/add_users');
INSERT INTO `system_auth_node` VALUES ('1416', '1', 'admin/users/edit_users');
INSERT INTO `system_auth_node` VALUES ('1417', '1', 'admin/users/edit_users_ankou');
INSERT INTO `system_auth_node` VALUES ('1418', '1', 'admin/users/edit_users_status');
INSERT INTO `system_auth_node` VALUES ('1419', '1', 'admin/users/edit_users_status2');
INSERT INTO `system_auth_node` VALUES ('1420', '1', 'admin/users/edit_users_ewm');
INSERT INTO `system_auth_node` VALUES ('1421', '1', 'admin/users/caiwu');
INSERT INTO `system_auth_node` VALUES ('1422', '1', 'admin/users/tuandui');
INSERT INTO `system_auth_node` VALUES ('1423', '1', 'admin/users/open');
INSERT INTO `system_auth_node` VALUES ('1424', '1', 'admin/users/cs_list');
INSERT INTO `system_auth_node` VALUES ('1425', '1', 'admin/users/add_cs');
INSERT INTO `system_auth_node` VALUES ('1426', '1', 'admin/users/edit_cs_status');
INSERT INTO `system_auth_node` VALUES ('1427', '1', 'admin/users/edit_cs');
INSERT INTO `system_auth_node` VALUES ('1428', '1', 'admin/users/cs_code');
INSERT INTO `system_auth_node` VALUES ('1429', '1', 'admin/users/edit_users_bk');
INSERT INTO `system_auth_node` VALUES ('1430', '1', 'admin/users/edit_users_level');

-- ----------------------------
-- Table structure for system_auth_node_copy
-- ----------------------------
DROP TABLE IF EXISTS `system_auth_node_copy`;
CREATE TABLE `system_auth_node_copy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth` bigint(20) unsigned DEFAULT NULL COMMENT '角色',
  `node` varchar(200) DEFAULT NULL COMMENT '节点',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_system_auth_auth` (`auth`) USING BTREE,
  KEY `index_system_auth_node` (`node`(191)) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=765 DEFAULT CHARSET=utf8mb4 COMMENT='系统-权限-授权';

-- ----------------------------
-- Records of system_auth_node_copy
-- ----------------------------
INSERT INTO `system_auth_node_copy` VALUES ('608', '1', 'admin');
INSERT INTO `system_auth_node_copy` VALUES ('609', '1', 'admin/auth');
INSERT INTO `system_auth_node_copy` VALUES ('610', '1', 'admin/auth/index');
INSERT INTO `system_auth_node_copy` VALUES ('611', '1', 'admin/auth/apply');
INSERT INTO `system_auth_node_copy` VALUES ('612', '1', 'admin/auth/add');
INSERT INTO `system_auth_node_copy` VALUES ('613', '1', 'admin/auth/edit');
INSERT INTO `system_auth_node_copy` VALUES ('614', '1', 'admin/auth/refresh');
INSERT INTO `system_auth_node_copy` VALUES ('615', '1', 'admin/auth/forbid');
INSERT INTO `system_auth_node_copy` VALUES ('616', '1', 'admin/auth/resume');
INSERT INTO `system_auth_node_copy` VALUES ('617', '1', 'admin/auth/remove');
INSERT INTO `system_auth_node_copy` VALUES ('618', '1', 'admin/config');
INSERT INTO `system_auth_node_copy` VALUES ('619', '1', 'admin/config/info');
INSERT INTO `system_auth_node_copy` VALUES ('620', '1', 'admin/config/config');
INSERT INTO `system_auth_node_copy` VALUES ('621', '1', 'admin/config/file');
INSERT INTO `system_auth_node_copy` VALUES ('622', '1', 'admin/deal');
INSERT INTO `system_auth_node_copy` VALUES ('623', '1', 'admin/deal/order_list');
INSERT INTO `system_auth_node_copy` VALUES ('624', '1', 'admin/deal/deal_console');
INSERT INTO `system_auth_node_copy` VALUES ('625', '1', 'admin/deal/goods_list');
INSERT INTO `system_auth_node_copy` VALUES ('626', '1', 'admin/deal/add_goods');
INSERT INTO `system_auth_node_copy` VALUES ('627', '1', 'admin/deal/edit_goods');
INSERT INTO `system_auth_node_copy` VALUES ('628', '1', 'admin/deal/edit_goods_status');
INSERT INTO `system_auth_node_copy` VALUES ('629', '1', 'admin/deal/del_goods');
INSERT INTO `system_auth_node_copy` VALUES ('630', '1', 'admin/deal/user_recharge');
INSERT INTO `system_auth_node_copy` VALUES ('631', '1', 'admin/deal/edit_recharge');
INSERT INTO `system_auth_node_copy` VALUES ('632', '1', 'admin/deal/deposit_list');
INSERT INTO `system_auth_node_copy` VALUES ('633', '1', 'admin/deal/do_deposit');
INSERT INTO `system_auth_node_copy` VALUES ('634', '1', 'admin/deal/do_commission');
INSERT INTO `system_auth_node_copy` VALUES ('635', '1', 'admin/deal/order_log');
INSERT INTO `system_auth_node_copy` VALUES ('636', '1', 'admin/deal/team_reward');
INSERT INTO `system_auth_node_copy` VALUES ('637', '1', 'admin/help');
INSERT INTO `system_auth_node_copy` VALUES ('638', '1', 'admin/help/message_ctrl');
INSERT INTO `system_auth_node_copy` VALUES ('639', '1', 'admin/help/add_message');
INSERT INTO `system_auth_node_copy` VALUES ('640', '1', 'admin/help/edit_message');
INSERT INTO `system_auth_node_copy` VALUES ('641', '1', 'admin/help/del_message');
INSERT INTO `system_auth_node_copy` VALUES ('642', '1', 'admin/help/home_msg');
INSERT INTO `system_auth_node_copy` VALUES ('643', '1', 'admin/help/edit_home_msg');
INSERT INTO `system_auth_node_copy` VALUES ('644', '1', 'admin/index');
INSERT INTO `system_auth_node_copy` VALUES ('645', '1', 'admin/index/main');
INSERT INTO `system_auth_node_copy` VALUES ('646', '1', 'admin/index/clearruntime');
INSERT INTO `system_auth_node_copy` VALUES ('647', '1', 'admin/index/buildoptimize');
INSERT INTO `system_auth_node_copy` VALUES ('648', '1', 'admin/menu');
INSERT INTO `system_auth_node_copy` VALUES ('649', '1', 'admin/menu/index');
INSERT INTO `system_auth_node_copy` VALUES ('650', '1', 'admin/menu/add');
INSERT INTO `system_auth_node_copy` VALUES ('651', '1', 'admin/menu/edit');
INSERT INTO `system_auth_node_copy` VALUES ('652', '1', 'admin/menu/resume');
INSERT INTO `system_auth_node_copy` VALUES ('653', '1', 'admin/menu/forbid');
INSERT INTO `system_auth_node_copy` VALUES ('654', '1', 'admin/menu/remove');
INSERT INTO `system_auth_node_copy` VALUES ('655', '1', 'admin/oplog');
INSERT INTO `system_auth_node_copy` VALUES ('656', '1', 'admin/oplog/index');
INSERT INTO `system_auth_node_copy` VALUES ('657', '1', 'admin/oplog/clear');
INSERT INTO `system_auth_node_copy` VALUES ('658', '1', 'admin/oplog/remove');
INSERT INTO `system_auth_node_copy` VALUES ('659', '1', 'admin/pay');
INSERT INTO `system_auth_node_copy` VALUES ('660', '1', 'admin/pay/index');
INSERT INTO `system_auth_node_copy` VALUES ('661', '1', 'admin/pay/edit');
INSERT INTO `system_auth_node_copy` VALUES ('662', '1', 'admin/pay/forbid');
INSERT INTO `system_auth_node_copy` VALUES ('663', '1', 'admin/pay/resume');
INSERT INTO `system_auth_node_copy` VALUES ('664', '1', 'admin/queue');
INSERT INTO `system_auth_node_copy` VALUES ('665', '1', 'admin/queue/index');
INSERT INTO `system_auth_node_copy` VALUES ('666', '1', 'admin/queue/redo');
INSERT INTO `system_auth_node_copy` VALUES ('667', '1', 'admin/queue/processstart');
INSERT INTO `system_auth_node_copy` VALUES ('668', '1', 'admin/queue/processstop');
INSERT INTO `system_auth_node_copy` VALUES ('669', '1', 'admin/queue/remove');
INSERT INTO `system_auth_node_copy` VALUES ('670', '1', 'admin/user');
INSERT INTO `system_auth_node_copy` VALUES ('671', '1', 'admin/user/index');
INSERT INTO `system_auth_node_copy` VALUES ('672', '1', 'admin/user/add');
INSERT INTO `system_auth_node_copy` VALUES ('673', '1', 'admin/user/edit');
INSERT INTO `system_auth_node_copy` VALUES ('674', '1', 'admin/user/pass');
INSERT INTO `system_auth_node_copy` VALUES ('675', '1', 'admin/user/forbid');
INSERT INTO `system_auth_node_copy` VALUES ('676', '1', 'admin/user/resume');
INSERT INTO `system_auth_node_copy` VALUES ('677', '1', 'admin/user/remove');
INSERT INTO `system_auth_node_copy` VALUES ('678', '1', 'admin/users');
INSERT INTO `system_auth_node_copy` VALUES ('679', '1', 'admin/users/index');
INSERT INTO `system_auth_node_copy` VALUES ('680', '1', 'admin/users/level');
INSERT INTO `system_auth_node_copy` VALUES ('681', '1', 'admin/users/add_users');
INSERT INTO `system_auth_node_copy` VALUES ('682', '1', 'admin/users/edit_users');
INSERT INTO `system_auth_node_copy` VALUES ('683', '1', 'admin/users/edit_users_ankou');
INSERT INTO `system_auth_node_copy` VALUES ('684', '1', 'admin/users/edit_users_status');
INSERT INTO `system_auth_node_copy` VALUES ('685', '1', 'admin/users/edit_users_ewm');
INSERT INTO `system_auth_node_copy` VALUES ('686', '1', 'admin/users/cs_list');
INSERT INTO `system_auth_node_copy` VALUES ('687', '1', 'admin/users/add_cs');
INSERT INTO `system_auth_node_copy` VALUES ('688', '1', 'admin/users/edit_cs_status');
INSERT INTO `system_auth_node_copy` VALUES ('689', '1', 'admin/users/edit_cs');
INSERT INTO `system_auth_node_copy` VALUES ('690', '1', 'admin/users/cs_code');
INSERT INTO `system_auth_node_copy` VALUES ('691', '1', 'admin/users/edit_users_bk');
INSERT INTO `system_auth_node_copy` VALUES ('692', '1', 'admin/users/edit_users_level');
INSERT INTO `system_auth_node_copy` VALUES ('756', '2', 'admin');
INSERT INTO `system_auth_node_copy` VALUES ('757', '2', 'admin/deal');
INSERT INTO `system_auth_node_copy` VALUES ('758', '2', 'admin/deal/order_list');
INSERT INTO `system_auth_node_copy` VALUES ('759', '2', 'admin/deal/user_recharge');
INSERT INTO `system_auth_node_copy` VALUES ('760', '2', 'admin/deal/deposit_list');
INSERT INTO `system_auth_node_copy` VALUES ('761', '2', 'admin/users');
INSERT INTO `system_auth_node_copy` VALUES ('762', '2', 'admin/users/index');
INSERT INTO `system_auth_node_copy` VALUES ('763', '2', 'admin/users/edit_users_ewm');
INSERT INTO `system_auth_node_copy` VALUES ('764', '2', 'admin/users/edit_users_level');

-- ----------------------------
-- Table structure for system_config
-- ----------------------------
DROP TABLE IF EXISTS `system_config`;
CREATE TABLE `system_config` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '' COMMENT '配置名',
  `value` varchar(500) DEFAULT '' COMMENT '配置值',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_system_config_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COMMENT='系统-配置';

-- ----------------------------
-- Records of system_config
-- ----------------------------
INSERT INTO `system_config` VALUES ('1', 'app_name', '5G云资源网');
INSERT INTO `system_config` VALUES ('2', 'site_name', '5G云资源网测试');
INSERT INTO `system_config` VALUES ('3', 'app_version', 'V10');
INSERT INTO `system_config` VALUES ('4', 'site_copy', '©版权所有 5G云资源网');
INSERT INTO `system_config` VALUES ('5', 'site_icon', 'http://www.yunziyuan.com.cn/Public/Home/res/images/favicon.ico');
INSERT INTO `system_config` VALUES ('7', 'miitbeian', '暂无');
INSERT INTO `system_config` VALUES ('8', 'storage_type', 'local');
INSERT INTO `system_config` VALUES ('9', 'storage_local_exts', 'doc,gif,icon,jpg,mp3,mp4,p12,pem,png,rar');
INSERT INTO `system_config` VALUES ('10', 'storage_qiniu_bucket', 'https');
INSERT INTO `system_config` VALUES ('11', 'storage_qiniu_domain', '用你自己的吧');
INSERT INTO `system_config` VALUES ('12', 'storage_qiniu_access_key', '用你自己的吧');
INSERT INTO `system_config` VALUES ('13', 'storage_qiniu_secret_key', '用你自己的吧');
INSERT INTO `system_config` VALUES ('14', 'storage_oss_bucket', 'cuci-mytest');
INSERT INTO `system_config` VALUES ('15', 'storage_oss_endpoint', 'oss-cn-hangzhou.aliyuncs.com');
INSERT INTO `system_config` VALUES ('16', 'storage_oss_domain', '用你自己的吧');
INSERT INTO `system_config` VALUES ('17', 'storage_oss_keyid', '用你自己的吧');
INSERT INTO `system_config` VALUES ('18', 'storage_oss_secret', '用你自己的吧');
INSERT INTO `system_config` VALUES ('36', 'storage_oss_is_https', 'http');
INSERT INTO `system_config` VALUES ('43', 'storage_qiniu_region', '华东');
INSERT INTO `system_config` VALUES ('44', 'storage_qiniu_is_https', 'https');
INSERT INTO `system_config` VALUES ('45', 'wechat_mch_id', '1332187001');
INSERT INTO `system_config` VALUES ('46', 'wechat_mch_key', 'A82DC5BD1F3359081049C568D8502BC5');
INSERT INTO `system_config` VALUES ('47', 'wechat_mch_ssl_type', 'p12');
INSERT INTO `system_config` VALUES ('48', 'wechat_mch_ssl_p12', '65b8e4f56718182d/1bc857ee646aa15d.p12');
INSERT INTO `system_config` VALUES ('49', 'wechat_mch_ssl_key', 'cc2e3e1345123930/c407d033294f283d.pem');
INSERT INTO `system_config` VALUES ('50', 'wechat_mch_ssl_cer', '966eaf89299e9c95/7014872cc109b29a.pem');
INSERT INTO `system_config` VALUES ('51', 'wechat_token', 'mytoken');
INSERT INTO `system_config` VALUES ('52', 'wechat_appid', 'wx60a43dd8161666d4');
INSERT INTO `system_config` VALUES ('53', 'wechat_appsecret', '9978422e0e431643d4b42868d183d60b');
INSERT INTO `system_config` VALUES ('54', 'wechat_encodingaeskey', '');
INSERT INTO `system_config` VALUES ('55', 'wechat_push_url', '消息推送地址：http://127.0.0.1:8000/wechat/api.push');
INSERT INTO `system_config` VALUES ('56', 'wechat_type', 'thr');
INSERT INTO `system_config` VALUES ('57', 'wechat_thr_appid', 'wx60a43dd8161666d4');
INSERT INTO `system_config` VALUES ('58', 'wechat_thr_appkey', '5caf4b0727f6e46a7e6ccbe773cc955d');
INSERT INTO `system_config` VALUES ('60', 'wechat_thr_appurl', '消息推送地址：http://127.0.0.1:2314/wechat/api.push');
INSERT INTO `system_config` VALUES ('61', 'component_appid', 'wx28b58798480874f9');
INSERT INTO `system_config` VALUES ('62', 'component_appsecret', '8d0e1ec14ea0adc5027dd0ad82c64bc9');
INSERT INTO `system_config` VALUES ('63', 'component_token', 'P8QHTIxpBEq88IrxatqhgpBm2OAQROkI');
INSERT INTO `system_config` VALUES ('64', 'component_encodingaeskey', 'L5uFIa0U6KLalPyXckyqoVIJYLhsfrg8k9YzybZIHsx');
INSERT INTO `system_config` VALUES ('65', 'system_message_state', '0');
INSERT INTO `system_config` VALUES ('66', 'sms_zt_username', '可以找CUCI申请');
INSERT INTO `system_config` VALUES ('67', 'sms_zt_password', '可以找CUCI申请');
INSERT INTO `system_config` VALUES ('68', 'sms_reg_template', '您的验证码为{code}，请在十分钟内完成操作！');
INSERT INTO `system_config` VALUES ('69', 'sms_secure', '可以找CUCI申请');
INSERT INTO `system_config` VALUES ('70', 'store_title', '测试商城');
INSERT INTO `system_config` VALUES ('71', 'store_order_wait_time', '0.50');
INSERT INTO `system_config` VALUES ('72', 'store_order_clear_time', '24.00');
INSERT INTO `system_config` VALUES ('73', 'store_order_confirm_time', '60.00');
INSERT INTO `system_config` VALUES ('74', 'sms_zt_username2', '可以找CUCI申请2');
INSERT INTO `system_config` VALUES ('75', 'sms_zt_password2', '可以找CUCI申请2');
INSERT INTO `system_config` VALUES ('76', 'sms_secure2', '可以找CUCI申请2');
INSERT INTO `system_config` VALUES ('77', 'sms_reg_template2', '您的验证码为{code}，请在十分钟内完成操作！2');
INSERT INTO `system_config` VALUES ('78', 'michat_appid', '2882303761518074614');
INSERT INTO `system_config` VALUES ('79', 'michat_appkey', '5861807470614');
INSERT INTO `system_config` VALUES ('80', 'michat_appsecert', 'CP/WUTUgDuyOxgLQ5ztesg==');

-- ----------------------------
-- Table structure for system_data
-- ----------------------------
DROP TABLE IF EXISTS `system_data`;
CREATE TABLE `system_data` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '配置名',
  `value` longtext COMMENT '配置值',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_system_data_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='系统-数据';

-- ----------------------------
-- Records of system_data
-- ----------------------------
INSERT INTO `system_data` VALUES ('1', 'menudata', '[{\"name\":\"请输入名称\",\"type\":\"scancode_push\",\"key\":\"scancode_push\"}]');

-- ----------------------------
-- Table structure for system_log
-- ----------------------------
DROP TABLE IF EXISTS `system_log`;
CREATE TABLE `system_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `node` varchar(200) NOT NULL DEFAULT '' COMMENT '当前操作节点',
  `geoip` varchar(15) NOT NULL DEFAULT '' COMMENT '操作者IP地址',
  `action` varchar(200) NOT NULL DEFAULT '' COMMENT '操作行为名称',
  `content` varchar(1024) NOT NULL DEFAULT '' COMMENT '操作内容描述',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '操作人用户名',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='系统-日志';

-- ----------------------------
-- Records of system_log
-- ----------------------------

-- ----------------------------
-- Table structure for system_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_menu`;
CREATE TABLE `system_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) unsigned DEFAULT '0' COMMENT '父ID',
  `title` varchar(100) DEFAULT '' COMMENT '名称',
  `node` varchar(200) DEFAULT '' COMMENT '节点代码',
  `icon` varchar(100) DEFAULT '' COMMENT '菜单图标',
  `url` varchar(400) DEFAULT '' COMMENT '链接',
  `params` varchar(500) DEFAULT '' COMMENT '链接参数',
  `target` varchar(20) DEFAULT '_self' COMMENT '打开方式',
  `sort` int(11) unsigned DEFAULT '0' COMMENT '菜单排序',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_system_menu_node` (`node`(191)) USING BTREE,
  KEY `index_system_menu_status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COMMENT='系统-菜单';

-- ----------------------------
-- Records of system_menu
-- ----------------------------
INSERT INTO `system_menu` VALUES ('1', '0', '后台首页', '', '', 'admin/index/main', '', '_self', '500', '1', '2018-09-05 17:59:38');
INSERT INTO `system_menu` VALUES ('2', '0', '系统管理', '', '', '#', '', '_self', '0', '1', '2018-09-05 18:04:52');
INSERT INTO `system_menu` VALUES ('3', '4', '系统菜单管理', '', 'layui-icon layui-icon-layouts', 'admin/menu/index', '', '_self', '1', '1', '2018-09-05 18:05:26');
INSERT INTO `system_menu` VALUES ('4', '2', '系统配置', '', '', '#', '', '_self', '20', '1', '2018-09-05 18:07:17');
INSERT INTO `system_menu` VALUES ('5', '12', '系统用户管理', '', 'layui-icon layui-icon-username', 'admin/user/index', '', '_self', '1', '1', '2018-09-06 11:10:42');
INSERT INTO `system_menu` VALUES ('7', '12', '访问权限管理', '', 'layui-icon layui-icon-vercode', 'admin/auth/index', '', '_self', '2', '1', '2018-09-06 15:17:14');
INSERT INTO `system_menu` VALUES ('11', '4', '系统参数配置', '', 'layui-icon layui-icon-set', 'admin/config/info', '', '_self', '4', '1', '2018-09-06 16:43:47');
INSERT INTO `system_menu` VALUES ('12', '2', '权限管理', '', '', '#', '', '_self', '10', '1', '2018-09-06 18:01:31');
INSERT INTO `system_menu` VALUES ('62', '0', '角色', '', 'layui-icon layui-icon-username', '#', '', '_self', '19', '1', '2019-10-17 13:43:53');
INSERT INTO `system_menu` VALUES ('63', '62', '会员管理', '', '', '#', '', '_self', '0', '1', '2019-10-17 13:44:17');
INSERT INTO `system_menu` VALUES ('64', '63', '会员列表', '', 'layui-icon layui-icon-username', 'admin/users/index', '', '_self', '0', '1', '2019-10-17 13:44:45');
INSERT INTO `system_menu` VALUES ('65', '0', '帮助中心', '', 'fa fa-flag-o', '#', '', '_self', '2', '1', '2019-10-18 10:42:54');
INSERT INTO `system_menu` VALUES ('66', '67', '公告管理', '', 'layui-icon layui-icon-speaker', 'admin/help/message_ctrl', '', '_self', '0', '1', '2019-10-18 10:45:12');
INSERT INTO `system_menu` VALUES ('67', '65', '首页文本', '', '', '#', '', '_self', '0', '1', '2019-10-18 14:50:42');
INSERT INTO `system_menu` VALUES ('68', '67', '文本管理', '', 'fa fa-book', 'admin/help/home_msg', '', '_self', '0', '1', '2019-10-18 15:13:53');
INSERT INTO `system_menu` VALUES ('69', '0', '交易', '', 'fa fa-balance-scale', '#', '', '_self', '18', '1', '2019-10-19 14:38:16');
INSERT INTO `system_menu` VALUES ('70', '69', '商品管理', '', '', '#', '', '_self', '1', '1', '2019-10-19 14:39:55');
INSERT INTO `system_menu` VALUES ('71', '70', '商品列表', '', 'fa fa-shopping-cart', 'admin/deal/goods_list', '', '_self', '0', '1', '2019-10-19 14:40:50');
INSERT INTO `system_menu` VALUES ('72', '69', '交易管理', '', '', '#', '', '_self', '2', '1', '2019-10-19 15:31:16');
INSERT INTO `system_menu` VALUES ('73', '72', '交易控制', '', 'layui-icon layui-icon-console', 'admin/deal/deal_console', '', '_self', '1', '1', '2019-10-19 15:32:25');
INSERT INTO `system_menu` VALUES ('74', '72', '充值管理', '', 'layui-icon layui-icon-chart-screen', 'admin/deal/user_recharge', '', '_self', '3', '1', '2019-10-22 14:15:27');
INSERT INTO `system_menu` VALUES ('75', '72', '订单列表', '', 'layui-icon layui-icon-cart-simple', 'admin/deal/order_list', '', '_self', '4', '1', '2019-10-24 16:10:29');
INSERT INTO `system_menu` VALUES ('76', '72', '提现管理', '', 'fa fa-legal', 'admin/deal/deposit_list', '', '_self', '2', '1', '2019-10-24 16:44:52');
INSERT INTO `system_menu` VALUES ('77', '62', '客服管理', '', '', '#', '', '_self', '0', '1', '2019-10-25 10:01:53');
INSERT INTO `system_menu` VALUES ('78', '77', '客服列表', '', 'layui-icon layui-icon-group', 'admin/users/cs_list', '', '_self', '0', '1', '2019-10-25 10:07:17');
INSERT INTO `system_menu` VALUES ('79', '77', '客服代码', '', 'layui-icon layui-icon-fonts-code', 'admin/users/cs_code', '', '_self', '0', '1', '2019-10-29 13:53:55');
INSERT INTO `system_menu` VALUES ('82', '67', '首页轮播图', '', 'layui-icon layui-icon-carousel', 'admin/help/banner', '', '_self', '0', '1', '2019-12-11 11:21:29');
INSERT INTO `system_menu` VALUES ('83', '70', '商品分类', '', '', '/admin/deal/goods_cate', '', '_self', '0', '1', '2020-01-05 11:16:29');
INSERT INTO `system_menu` VALUES ('84', '4', '支付方式管理', '', '', '/admin/pay/index', '', '_self', '0', '1', '2020-01-14 20:50:29');
INSERT INTO `system_menu` VALUES ('85', '63', '会员等级', '', '', '/admin/users/level', '', '_self', '0', '1', '2020-02-05 16:55:18');
INSERT INTO `system_menu` VALUES ('88', '69', '利息宝', '', '', '#', '', '_self', '0', '1', '2020-02-25 02:33:56');
INSERT INTO `system_menu` VALUES ('89', '88', '利息宝选项', '', '', '/admin/deal/lixibao_list', '', '_self', '0', '1', '2020-02-25 02:34:53');
INSERT INTO `system_menu` VALUES ('90', '88', '利息宝记录', '', '', '/admin/deal/lixibao_log', '', '_self', '0', '1', '2020-02-25 02:35:19');
INSERT INTO `system_menu` VALUES ('91', '0', '商城', '', '', '#', '', '_self', '0', '1', '2020-03-05 11:42:10');
INSERT INTO `system_menu` VALUES ('92', '91', '商城管理', '', '', '#', '', '_self', '0', '1', '2020-03-05 11:42:29');
INSERT INTO `system_menu` VALUES ('93', '92', '商品分类', '', '', '/admin/shop/goods_cate', '', '_self', '0', '1', '2020-03-05 11:42:54');
INSERT INTO `system_menu` VALUES ('94', '92', '商品列表', '', '', '/admin/shop/goods_list', '', '_self', '0', '1', '2020-03-05 11:43:06');
INSERT INTO `system_menu` VALUES ('95', '92', '订单列表', '', '', '/admin/shop/order_list', '', '_self', '0', '1', '2020-03-05 11:43:16');

-- ----------------------------
-- Table structure for system_queue
-- ----------------------------
DROP TABLE IF EXISTS `system_queue`;
CREATE TABLE `system_queue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '任务名称',
  `data` longtext NOT NULL COMMENT '执行参数',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '任务状态(1新任务,2处理中,3成功,4失败)',
  `preload` varchar(500) DEFAULT '' COMMENT '执行内容',
  `time` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '执行时间',
  `double` tinyint(1) DEFAULT '1' COMMENT '单例模式',
  `desc` varchar(500) DEFAULT '' COMMENT '状态描述',
  `start_at` varchar(20) DEFAULT '' COMMENT '开始时间',
  `end_at` varchar(20) DEFAULT '' COMMENT '结束时间',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_system_queue_double` (`double`) USING BTREE,
  KEY `index_system_queue_time` (`time`) USING BTREE,
  KEY `index_system_queue_title` (`title`) USING BTREE,
  KEY `index_system_queue_create_at` (`create_at`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统-任务';

-- ----------------------------
-- Records of system_queue
-- ----------------------------

-- ----------------------------
-- Table structure for system_user
-- ----------------------------
DROP TABLE IF EXISTS `system_user`;
CREATE TABLE `system_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT '' COMMENT '用户账号',
  `password` varchar(32) DEFAULT '' COMMENT '用户密码',
  `qq` varchar(16) DEFAULT '' COMMENT '联系QQ',
  `mail` varchar(32) DEFAULT '' COMMENT '联系邮箱',
  `phone` varchar(16) DEFAULT '' COMMENT '联系手机',
  `login_at` datetime DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(255) DEFAULT '' COMMENT '登录IP',
  `login_num` bigint(20) unsigned DEFAULT '0' COMMENT '登录次数',
  `authorize` varchar(255) DEFAULT '' COMMENT '权限授权',
  `tags` varchar(255) DEFAULT '' COMMENT '用户标签',
  `desc` varchar(255) DEFAULT '' COMMENT '备注说明',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT '删除(1删除,0未删)',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_system_user_username` (`username`) USING BTREE,
  KEY `index_system_user_status` (`status`) USING BTREE,
  KEY `index_system_user_deleted` (`is_deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10002 DEFAULT CHARSET=utf8mb4 COMMENT='系统-用户';

-- ----------------------------
-- Records of system_user
-- ----------------------------
INSERT INTO `system_user` VALUES ('10000', 'admin', '9974a7099607a27f1d86353298bcf71d', '22222222', '', '', '2020-04-20 11:40:43', '127.0.0.1', '891', '', '', '', '1', '0', '2015-11-13 15:14:22');
INSERT INTO `system_user` VALUES ('10001', 'test', '6bdbfb1701f3d52dc6a0c0feb6a67657', '', '', '13800000000', '2020-02-06 19:06:52', '127.0.0.1', '5', '2', '', '', '1', '0', '2020-02-06 17:08:45');

-- ----------------------------
-- Table structure for xy_balance_log
-- ----------------------------
DROP TABLE IF EXISTS `xy_balance_log`;
CREATE TABLE `xy_balance_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `sid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '交易对象id',
  `oid` char(18) NOT NULL COMMENT '交易单号',
  `num` decimal(10,2) NOT NULL COMMENT '交易金额',
  `type` int(2) NOT NULL COMMENT '交易类型 0系统 1充值 2交易 3返佣 4强制交易 5推广返佣 6下级交易返佣  7提现',
  `status` int(1) DEFAULT '1' COMMENT '收入1 支出2',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `f_lv` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oid` (`oid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='会员-收支明细表';

-- ----------------------------
-- Records of xy_balance_log
-- ----------------------------
INSERT INTO `xy_balance_log` VALUES ('1', '20', '0', 'SP2003291138308901', '1.00', '11', '1', '1585453110', null);
INSERT INTO `xy_balance_log` VALUES ('2', '20', '0', 'SP2003291140513132', '1.00', '11', '1', '1585453251', null);
INSERT INTO `xy_balance_log` VALUES ('3', '20', '0', 'SP2003291141221124', '1.00', '11', '1', '1585453282', null);
INSERT INTO `xy_balance_log` VALUES ('4', '20', '0', 'UB2003300159471543', '45.40', '2', '2', '1585504826', null);
INSERT INTO `xy_balance_log` VALUES ('5', '20', '0', 'UB2003300159471543', '0.18', '3', '1', '1585504826', null);
INSERT INTO `xy_balance_log` VALUES ('6', '20', '0', 'UB2003311159366848', '99.00', '2', '2', '1585627193', null);
INSERT INTO `xy_balance_log` VALUES ('7', '20', '0', 'UB2003311159366848', '0.40', '3', '1', '1585627193', null);

-- ----------------------------
-- Table structure for xy_bankinfo
-- ----------------------------
DROP TABLE IF EXISTS `xy_bankinfo`;
CREATE TABLE `xy_bankinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '会员ID',
  `bankname` varchar(100) NOT NULL DEFAULT '' COMMENT '银行名称',
  `cardnum` varchar(50) NOT NULL DEFAULT '' COMMENT '卡号',
  `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名',
  `site` varchar(255) NOT NULL DEFAULT '' COMMENT '开户行地址',
  `tel` varchar(20) NOT NULL COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态，1启用，0禁用',
  `address` varchar(255) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Uid` (`uid`),
  KEY `Cardnum` (`cardnum`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='会员-银行卡信息表';

-- ----------------------------
-- Records of xy_bankinfo
-- ----------------------------
INSERT INTO `xy_bankinfo` VALUES ('1', '20', '中国银行', '11111111111111111111', '11', '111111111', '13800000000', '1', '1111111', '111111');

-- ----------------------------
-- Table structure for xy_bank_list
-- ----------------------------
DROP TABLE IF EXISTS `xy_bank_list`;
CREATE TABLE `xy_bank_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(15) NOT NULL COMMENT '银行编号',
  `bankname` varchar(255) NOT NULL COMMENT '银行名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COMMENT='提现银行编码表';

-- ----------------------------
-- Records of xy_bank_list
-- ----------------------------
INSERT INTO `xy_bank_list` VALUES ('1', 'ICBC', '工商银行');
INSERT INTO `xy_bank_list` VALUES ('2', 'ABC', '农业银行');
INSERT INTO `xy_bank_list` VALUES ('3', 'CMB', '招商银行');
INSERT INTO `xy_bank_list` VALUES ('4', 'BCM', '交通银行');
INSERT INTO `xy_bank_list` VALUES ('5', 'CCB', '建设银行');
INSERT INTO `xy_bank_list` VALUES ('6', 'CMBC', '民生银行');
INSERT INTO `xy_bank_list` VALUES ('7', 'CIB', '兴业银行');
INSERT INTO `xy_bank_list` VALUES ('8', 'BOC', '中国银行');
INSERT INTO `xy_bank_list` VALUES ('9', 'SPDB', '浦发银行');
INSERT INTO `xy_bank_list` VALUES ('10', 'CEB ', '光大银行');
INSERT INTO `xy_bank_list` VALUES ('11', 'PSBC', '邮政储蓄银行');
INSERT INTO `xy_bank_list` VALUES ('12', 'PAB', '平安银行');
INSERT INTO `xy_bank_list` VALUES ('13', 'HXB', '华夏银行');
INSERT INTO `xy_bank_list` VALUES ('14', 'CGB', '广发银行');
INSERT INTO `xy_bank_list` VALUES ('15', 'HKBEA', '东亚银行');
INSERT INTO `xy_bank_list` VALUES ('16', 'NBCB', '宁波银行');
INSERT INTO `xy_bank_list` VALUES ('17', 'CITIC', '中信银行');
INSERT INTO `xy_bank_list` VALUES ('18', 'CBHB', '渤海银行');
INSERT INTO `xy_bank_list` VALUES ('19', 'BOB', '北京银行');
INSERT INTO `xy_bank_list` VALUES ('20', 'BJCB', '南京银行');
INSERT INTO `xy_bank_list` VALUES ('21', 'SHB', '上海银行');
INSERT INTO `xy_bank_list` VALUES ('22', 'GZYH', '广州银行');
INSERT INTO `xy_bank_list` VALUES ('23', 'HZYH', '杭州银行');
INSERT INTO `xy_bank_list` VALUES ('24', 'HZLHNCSYYH', '杭州联合商业银行');

-- ----------------------------
-- Table structure for xy_banner
-- ----------------------------
DROP TABLE IF EXISTS `xy_banner`;
CREATE TABLE `xy_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='首页轮播图';

-- ----------------------------
-- Records of xy_banner
-- ----------------------------
INSERT INTO `xy_banner` VALUES ('3', '', null, 'http://www.yunziyuan.com.cn');

-- ----------------------------
-- Table structure for xy_convey
-- ----------------------------
DROP TABLE IF EXISTS `xy_convey`;
CREATE TABLE `xy_convey` (
  `id` char(18) NOT NULL,
  `uid` int(10) NOT NULL COMMENT '会员ID',
  `num` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易金额',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '下单时间',
  `endtime` int(10) NOT NULL DEFAULT '0' COMMENT '完成交易时间',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '订单状态 0待付款 1交易完成 2用户取消  3强制完成 4强制取消  5交易冻结',
  `commission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '佣金',
  `c_status` int(1) NOT NULL DEFAULT '0' COMMENT '佣金发放状态 0未发放 1已发放 2账号冻结',
  `add_id` int(11) NOT NULL COMMENT '收货地址',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `goods_count` int(2) NOT NULL DEFAULT '1' COMMENT '商品数量',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员-订单表';

-- ----------------------------
-- Records of xy_convey
-- ----------------------------
INSERT INTO `xy_convey` VALUES ('UB2003241049575765', '20', '59.00', '1585018197', '1585018285', '1', '0.24', '1', '1', '78', '1');
INSERT INTO `xy_convey` VALUES ('UB2003241049575766', '20', '59.00', '1585018197', '1585018285', '1', '0.24', '1', '1', '78', '1');
INSERT INTO `xy_convey` VALUES ('UB2003241107099713', '20', '200.00', '1585019229', '1585019312', '1', '0.80', '1', '1', '58', '4');
INSERT INTO `xy_convey` VALUES ('UB2003241107099716', '20', '200.00', '1585019229', '1585019312', '1', '0.80', '1', '1', '58', '4');
INSERT INTO `xy_convey` VALUES ('UB2003241107431765', '20', '59.40', '1585019263', '1585019343', '1', '0.24', '1', '1', '118', '6');
INSERT INTO `xy_convey` VALUES ('UB2003241107431768', '20', '59.40', '1585019263', '1585019343', '1', '0.24', '1', '1', '118', '6');
INSERT INTO `xy_convey` VALUES ('UB2003241108135932', '20', '198.00', '1585019293', '1585019371', '1', '0.79', '1', '1', '88', '2');
INSERT INTO `xy_convey` VALUES ('UB2003241108135934', '20', '198.00', '1585019293', '1585019371', '1', '0.79', '1', '1', '88', '2');
INSERT INTO `xy_convey` VALUES ('UB2003241109164037', '20', '108.00', '1585019356', '1585019956', '0', '0.43', '0', '1', '156', '4');
INSERT INTO `xy_convey` VALUES ('UB2003241109164038', '20', '108.00', '1585019356', '1585019956', '0', '0.43', '0', '1', '156', '4');
INSERT INTO `xy_convey` VALUES ('UB2003241117592442', '20', '107.40', '1585019879', '1585020175', '1', '0.43', '1', '1', '52', '3');
INSERT INTO `xy_convey` VALUES ('UB2003241117592449', '20', '107.40', '1585019879', '1585020175', '1', '0.43', '1', '1', '52', '3');
INSERT INTO `xy_convey` VALUES ('UB2003241130158864', '20', '89.70', '1585020615', '1585020693', '1', '0.36', '1', '1', '42', '3');
INSERT INTO `xy_convey` VALUES ('UB2003241130158867', '20', '89.70', '1585020615', '1585020693', '1', '0.36', '1', '1', '42', '3');
INSERT INTO `xy_convey` VALUES ('UB2003241130569032', '20', '126.42', '1585020656', '1585020734', '1', '0.51', '1', '1', '76', '1');
INSERT INTO `xy_convey` VALUES ('UB2003241130569035', '20', '126.42', '1585020656', '1585020734', '1', '0.51', '1', '1', '76', '1');
INSERT INTO `xy_convey` VALUES ('UB2003241131527264', '20', '100.00', '1585020712', '1585020795', '1', '0.40', '1', '1', '58', '2');
INSERT INTO `xy_convey` VALUES ('UB2003241131527265', '20', '100.00', '1585020712', '1585020795', '5', '0.40', '1', '1', '58', '2');
INSERT INTO `xy_convey` VALUES ('UB2003241132268251', '20', '190.00', '1585020746', '1585020823', '1', '0.76', '1', '1', '103', '2');
INSERT INTO `xy_convey` VALUES ('UB2003241132268252', '20', '190.00', '1585020746', '1585020823', '1', '0.76', '1', '1', '103', '2');
INSERT INTO `xy_convey` VALUES ('UB2003241132522732', '20', '79.00', '1585020772', '1585020850', '1', '0.32', '1', '1', '93', '1');
INSERT INTO `xy_convey` VALUES ('UB2003241132522736', '20', '79.00', '1585020772', '1585020850', '1', '0.32', '1', '1', '93', '1');
INSERT INTO `xy_convey` VALUES ('UB2003241133302581', '20', '98.00', '1585020810', '1585020917', '1', '0.39', '1', '1', '105', '1');
INSERT INTO `xy_convey` VALUES ('UB2003241133302582', '20', '98.00', '1585020810', '1585020917', '1', '0.39', '1', '1', '105', '1');
INSERT INTO `xy_convey` VALUES ('UB2003241411179862', '20', '150.00', '1585030277', '1585030500', '1', '0.60', '1', '1', '58', '3');
INSERT INTO `xy_convey` VALUES ('UB2003241414267659', '20', '207.00', '1585030466', '1585031066', '0', '0.83', '0', '1', '64', '3');
INSERT INTO `xy_convey` VALUES ('UB2003242120308856', '20', '250.00', '1585056030', '1585056630', '0', '1.00', '0', '1', '49', '10');
INSERT INTO `xy_convey` VALUES ('UB2003250150298920', '20', '179.70', '1585072229', '1585072320', '1', '0.72', '1', '1', '127', '3');
INSERT INTO `xy_convey` VALUES ('UB2003250151122348', '20', '150.00', '1585072272', '1585072351', '1', '0.60', '1', '1', '46', '2');
INSERT INTO `xy_convey` VALUES ('UB2003250151435387', '20', '245.00', '1585072303', '1585072387', '1', '0.98', '1', '1', '57', '5');
INSERT INTO `xy_convey` VALUES ('UB2003250152289202', '20', '150.00', '1585072348', '1585072426', '1', '0.60', '1', '1', '46', '2');
INSERT INTO `xy_convey` VALUES ('UB2003250152562976', '20', '170.00', '1585072376', '1585072468', '1', '0.68', '1', '1', '41', '2');
INSERT INTO `xy_convey` VALUES ('UB2003250210036810', '20', '252.84', '1585073403', '1585073481', '1', '1.01', '1', '1', '76', '2');
INSERT INTO `xy_convey` VALUES ('UB2003300159471543', '20', '45.40', '1585504787', '1585504886', '1', '0.18', '1', '2', '123', '2');
INSERT INTO `xy_convey` VALUES ('UB2003311159366848', '20', '99.00', '1585627176', '1585627253', '1', '0.40', '1', '2', '74', '1');

-- ----------------------------
-- Table structure for xy_cs
-- ----------------------------
DROP TABLE IF EXISTS `xy_cs`;
CREATE TABLE `xy_cs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel` varchar(20) NOT NULL COMMENT '手机号',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `pwd` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(255) NOT NULL DEFAULT '' COMMENT '盐',
  `qq` varchar(20) NOT NULL COMMENT 'QQ号',
  `wechat` varchar(150) NOT NULL COMMENT '微信号',
  `qr_code` varchar(150) NOT NULL COMMENT '微信二维码',
  `btime` char(5) NOT NULL DEFAULT '0' COMMENT '上班时间',
  `etime` char(5) NOT NULL COMMENT '下班时间',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '账号状态 1启用 2禁用',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='客服-用户表';

-- ----------------------------
-- Records of xy_cs
-- ----------------------------
INSERT INTO `xy_cs` VALUES ('1', '13112343213', '客服一号', '12346578', '', '98765431', '13800000000', 'http://www.kkugea.cn/upload/8d8974e94ea71793/ef08b1ba42a6f787.jpg', '08:01', '18:00', '1', '1571970644', '/hf');
INSERT INTO `xy_cs` VALUES ('2', '13142134213', '客服二号', '12345678', '', '1122334455', 'weixinhao2', 'http://www.kkugea.cn/upload/8d8974e94ea71793/ef08b1ba42a6f787.jpg', '10:00', '20:00', '1', '1571971118', null);
INSERT INTO `xy_cs` VALUES ('3', '13800000000', '首次提现需审核（个人安全信息）', 'c123456789.', '', '0', '客服MChat号： wxid_ihdylt5333', 'http://www.kkugea.cn/upload/278cce429f71e443/f55c41cf04b35a6f.jpg', '10:00', '22:00', '1', '1575521614', '');
INSERT INTO `xy_cs` VALUES ('4', '13800000000', '平台审核客服MChat（请咨询在线客服下载）', 'queen123456', '', '674956258', '客服MChat号：q333', 'http://qd.cn/upload/f8a252173a9d2e87/a14ecf487cc2fe1c.png', '09:00', '22:00', '1', '1575595897', 'https://qd2.251zy.com/customlivechat/php/app.php?widget-mobile');

-- ----------------------------
-- Table structure for xy_deal_elog
-- ----------------------------
DROP TABLE IF EXISTS `xy_deal_elog`;
CREATE TABLE `xy_deal_elog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oid` char(18) NOT NULL COMMENT '相关订单',
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `errmsg` varchar(255) NOT NULL COMMENT '错误信息',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `oid` (`oid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='交易错误日志表';

-- ----------------------------
-- Records of xy_deal_elog
-- ----------------------------

-- ----------------------------
-- Table structure for xy_deposit
-- ----------------------------
DROP TABLE IF EXISTS `xy_deposit`;
CREATE TABLE `xy_deposit` (
  `id` char(18) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '提现用户',
  `bk_id` int(11) NOT NULL COMMENT '银行卡信息',
  `num` decimal(12,2) NOT NULL COMMENT '提现金额',
  `addtime` int(10) NOT NULL COMMENT '提交时间',
  `endtime` int(10) NOT NULL DEFAULT '0' COMMENT '审核时间',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '订单状态 1待处理 2审核通过 3审核不通过',
  `type` varchar(36) DEFAULT NULL,
  `real_num` decimal(12,2) DEFAULT NULL,
  `shouxu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员-余额提现表';

-- ----------------------------
-- Records of xy_deposit
-- ----------------------------
INSERT INTO `xy_deposit` VALUES ('CO2003250210434626', '20', '1', '11.00', '1585073443', '1585493625', '3', 'card', '10.67', '0.03');

-- ----------------------------
-- Table structure for xy_goods_cate
-- ----------------------------
DROP TABLE IF EXISTS `xy_goods_cate`;
CREATE TABLE `xy_goods_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '商店名称',
  `bili` varchar(255) NOT NULL COMMENT '商品名称',
  `cate_info` varchar(255) DEFAULT '' COMMENT '商品描述',
  `goods_price` decimal(10,2) DEFAULT NULL COMMENT '商品价格',
  `cate_pic` varchar(120) DEFAULT '' COMMENT '商品展示图片',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `status` int(1) DEFAULT '0' COMMENT '上架状态 0不上架 1上架',
  `min` varchar(255) DEFAULT NULL COMMENT '最小金额限制',
  `level_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';

-- ----------------------------
-- Records of xy_goods_cate
-- ----------------------------
INSERT INTO `xy_goods_cate` VALUES ('1', '拼多多', '0.002', '白银会员专属通道', null, '/static_new6/img/vip_1a.b5838bd.png', '1579586171', '0', '110', '1');
INSERT INTO `xy_goods_cate` VALUES ('2', '淘宝', '0.003', '黄金会员专属通道', null, '/static_new6/img/vip_2a.be0ead6.png', '1578196081', '0', '110', '2');
INSERT INTO `xy_goods_cate` VALUES ('3', '天猫', '0.004', '铂金会员专属通道', null, '/static_new6/img/vip_3a.90bd5b6.png', '1578196305', '0', '110', '3');
INSERT INTO `xy_goods_cate` VALUES ('4', '京东', '0.005', '钻石会员专属通道', null, '/static_new6/img/vip_4a.fe406d7.png', '1578196305', '0', '110', '4');

-- ----------------------------
-- Table structure for xy_goods_list
-- ----------------------------
DROP TABLE IF EXISTS `xy_goods_list`;
CREATE TABLE `xy_goods_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) NOT NULL COMMENT '商店名称',
  `goods_name` varchar(255) NOT NULL COMMENT '商品名称',
  `goods_info` varchar(255) DEFAULT '' COMMENT '商品描述',
  `goods_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `goods_pic` varchar(120) DEFAULT '' COMMENT '商品展示图片',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '上架状态 0不上架 1上架',
  `cid` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=641 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';

-- ----------------------------
-- Records of xy_goods_list
-- ----------------------------
INSERT INTO `xy_goods_list` VALUES ('1', '信酷小米专营店', '小米/MIUI 小米电视4S 43英寸人工智能语音网络平板电视 1GB+8GB HDR 4K超高清', '金属机身', '1.00', '/upload/goods_img/大家电/5db3b89a8d174.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('2', '邮乐安阳馆', '【汤阴县积分用户专享】洗衣机XpB—126-9896S', '', '1.00', '/upload/goods_img/大家电/5db3b89a9f288.jpg', '1578206762', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('3', '海信电器旗舰店', '海信（Hisense）HZ39E35A 39英寸高清手机交互 轻薄金属 WIFI人工智能液晶电视机', '', '1.00', '/upload/goods_img/大家电/5db3b89ab61bd.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('4', '邮滋味如皋馆专柜', '创维9公斤变频滚筒洗衣机  型号：F9015NC-炫金   如皋免费送货上门，南通包邮，华东地区配货', '创维洗衣机，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89b52437.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('5', '邮滋味如皋馆专柜', '创维2P定频立式柜机，型号：KFR-50LW/F2DA1A-3（限如皋地区免费送货上门安装）', '创维定频空调，免费上门安装，绝对优惠，每月更有现场特惠活动', '4.00', '/upload/goods_img/大家电/5db3b89b6e95e.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('6', '创维电视官方旗舰店', '创维/SKYWORTH 58H8M 58英寸4K超高清全面屏防蓝光人工智能语音HDR超薄网络液晶电视', '4K超高清，声像自然，一场声觉革新，视觉体验，光学防蓝光，护眼不偏色', '3.00', '/upload/goods_img/大家电/5db3b89b79d10.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('7', '邮乐洛阳', '【洛阳金融积分兑换】TCL 205升 三门电冰箱 （星空银） BC（邮政网点配送）', '', '1.00', '/upload/goods_img/大家电/5db3b89bc11c1.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('8', '邮滋味如皋馆专柜', '创维9公斤全自动波轮洗衣机，型号XQB90-52BAS淡雅银如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，夏季特惠；每月现场有特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89bcfc24.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('9', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】家用洗衣机，图片仅供参考', '', '1.00', '/upload/goods_img/大家电/5db3b89be0d98.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('10', '邮乐安阳馆', '【滑县积分用户专享】创维电器洗衣机9公斤波轮安阳', '', '1.00', '/upload/goods_img/大家电/5db3b89bee474.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('11', '邮乐安阳馆', '美菱3开门冰箱BCD-209M3CX【汤阴县积分兑换专用，其他下单不发货】', '', '1.00', '/upload/goods_img/大家电/5db3b89c06586.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('12', '邮乐安阳馆', '美菱电冰箱209L3CS【安阳县积分兑换用户专用，其他地区发】', '', '1.00', '/upload/goods_img/大家电/5db3b89c16f2a.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('13', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】自动洗衣机 家用洗衣机，图片仅供参考', '', '2.00', '/upload/goods_img/大家电/5db3b89c22e95.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('14', '邮乐安阳馆', '【滑县积分用户专享】创维电器电视50寸4K智能安阳', '', '3.00', '/upload/goods_img/大家电/5db3b89c2bb37.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('15', '邮乐安阳馆', '【安阳县积分用户专享】长虹液晶电视55U1', '', '3.00', '/upload/goods_img/大家电/5db3b89f48109.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('16', '海信电器旗舰店', '海信（Hisense）HZ32E30D 32英寸蓝光高清平板液晶电视机 酒店宾馆卧室推荐', '【海信今日限时特惠-到手价788元！】限量200台！抢完即止！', '749.00', '/upload/goods_img/大家电/5db3b89f51194.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('17', '邮滋味如皋馆专柜', '邮乐特卖：庭美家用消毒柜    型号：YTP-280    如皋免费送货上门，南通包邮，华东地区配送', '庭美消毒柜，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '755.00', '/upload/goods_img/大家电/5db3b89f5ec57.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('18', '吉舜诚商城专柜', '飞利浦（PHILIPS）  19英寸液晶电视机 显示器两用 hdmi高清接口', '19PFF2650', '799.00', '/upload/goods_img/大家电/5db3b89fb14ba.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('19', '创维集团官方旗舰店', '创维/SKYWORTH 32X3 32英寸窄边非智能老人机蓝光高清节能LED平板液晶电视机工程机', '蓝光高清，经典窄边，节能液晶，简单好用，谁用谁知道，实用耐用款', '799.00', '/upload/goods_img/大家电/5db3b89fc8fa8.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('20', '吉舜诚商城专柜', '飞利浦（PHILIPS）22英寸LED高清液晶平板电视机含底座 黑色', '22PFF2650/T3', '899.00', '/upload/goods_img/大家电/5db3b89fd917b.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('21', '创维集团官方旗舰店', '创维/SKYWORTH 32X6 32英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠，高清智能电视，WIFI，酷开系统，10核处理器', '899.00', '/upload/goods_img/大家电/5db3b89fe6086.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('22', '海信电器旗舰店', '海信 (Hisense) HZ32E35A 32英寸AI智能WIFI 轻薄金属 卧室神器高清电视机', '', '899.00', '/upload/goods_img/大家电/5db3b8a0004c2.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('23', '邮滋味如皋馆专柜', '创维邮乐特卖： 32寸液晶电视机，型号：32E381S   如皋免费送货上门，南通包邮，华东地区配货', '创维液晶电视大品牌，夏季特惠；每月现场有特惠活动', '899.00', '/upload/goods_img/大家电/5db3b8a01be30.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('24', '琥麟电器专柜', '海信 XQB60-H3568 6公斤全自动波轮洗衣机', '', '749.00', '/upload/goods_img/大家电/5db3b8a0279b3.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('25', '邮滋味如皋馆专柜', '创维7公斤全自动波轮洗衣机，型号：XQB70-21C淡雅银，如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '928.00', '/upload/goods_img/大家电/5db3b8a0367fe.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('26', '邮滋味如皋馆专柜', '创维单冷冰柜，型号：BD/C-160雅白，如皋地区免费送货上门安装，南通地区包邮，华东地区配货', '创维冰柜，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '999.00', '/upload/goods_img/大家电/5db3b8a042f39.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('27', '创维集团官方旗舰店', '创维（SKYWORTH）32H5 32英寸高清HDR 护眼全面屏 AI人工智能语音 网络WIFI 卧', '高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '999.00', '/upload/goods_img/大家电/5db3b8a0511cd.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('28', '邮滋味如皋馆专柜', '创维/SKYWORTH热水器，型号：DSZF-D5501-80，如皋免费送货上门，南通包邮 创维/', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '999.00', '/upload/goods_img/大家电/5db3b8a07389d.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('29', '琥麟电器专柜', 'Hisense/海信 HB80DA332G8KG公斤大容量家用全自动节能波轮洗衣机', '', '899.00', '/upload/goods_img/大家电/5db3b8a386615.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('30', '琥麟电器专柜', '海信 BCD-163N/B 冰柜冷藏冷冻双温家用商用小型卧式', '', '999.00', '/upload/goods_img/大家电/5db3b8a390a27.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('31', '吉舜诚商城专柜', '东芝（TOSHIBA）  32英寸 蓝光液晶电视 高清平板电视机 东芝电视机', '32L1500C', '1.00', '/upload/goods_img/大家电/5db3b8a69aafd.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('32', '创维集团官方旗舰店', '创维/SKYWORTH 40X6 40英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠！高清智能，10核处理器，可以WIFI上网', '1.00', '/upload/goods_img/大家电/5db3b8a9a6b14.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('33', '甲子商城旗舰店', '康佳/KONKA  LED39E330C 39英寸卧室电视高清蓝光节能平板液晶电视', '', '949.00', '/upload/goods_img/大家电/5db3b8a9b22ae.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('34', '邮乐赣州馆', '【不支持邮乐卡支付】创维-彩电-40E1C 40英寸全高清HDR 护眼全面屏 AI人工智能语音', '', '1.00', '/upload/goods_img/大家电/5db3b8a9cf38d.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('35', '琥麟电器专柜', '海信 BCD-177F/Q 177升 双门冰箱', '', '1.00', '/upload/goods_img/大家电/5db3b8a9f0abd.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('36', '创维集团官方旗舰店', '创维/SKYWORTH 43X6 43英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '【买电视选创维】高清智能，10核处理器，质量上乘，价格厚道，可以Wifi上网', '1.00', '/upload/goods_img/大家电/5db3b8aa1b4b4.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('37', '创维集团官方旗舰店', '创维（SKYWORTH）40H5 40英寸全高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '全高清HDR 护眼全面屏 AI人工智能语音', '1.00', '/upload/goods_img/大家电/5db3b8aa26c4f.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('38', '邮乐安阳馆', '市区积分用户专享】创维平板电视32X6', '', '1.00', '/upload/goods_img/大家电/5db3b8aa31c19.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('39', '吉舜诚商城专柜', '飞利浦（PHILIPS）32英寸新品高清LED电视 接口丰富窄边高清LED液晶平板电视机', '32PHF3282/T3', '1.00', '/upload/goods_img/大家电/5db3b8aa3b85c.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('40', '琥麟电器专柜', '海信 BD/BC-308NU/A 冰柜家用 顶开式卧式商用冷藏冷冻柜', '', '1.00', '/upload/goods_img/大家电/5db3b8aa4931f.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('41', '明凰服饰专营店', '男女冲锋衣工装棉服外套修身加厚款', '邮乐支持微信，支付宝，网银，邮储卡和银联卡支付。（不同商品请分开下单）', '85.00', '/upload/goods_img/户外服饰/5db3b8b22c022.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('42', '户外途量工厂专卖店', '春夏季运动风衣钓鱼防晒衣男女超薄透气皮肤衣防风外套户外速干潮流衣服情侣款皮肤衣', '大码骑行长袖', '29.90', '/upload/goods_img/户外服饰/5db3b8b23604c.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('43', '探路者正江专卖店', '探路者/TOREAD 冲锋裤 运动裤 秋冬户外软壳裤男透气防风保暖徒步裤KAMG91159', '', '428.00', '/upload/goods_img/户外服饰/5db3b8b25312b.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('44', '探路者正江专卖店', '探路者运动服 探路者冲锋衣 19秋冬户外女式防水透湿套绒冲锋衣TAWH92285', '', '839.00', '/upload/goods_img/户外服饰/5db3b8b25d925.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('45', '好看哒专营店', '防晒衣女中长款薄款防晒服', 'FSY-6387', '45.00', '/upload/goods_img/户外服饰/5db3b8b56628b.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('46', '宝仕母婴专营店专柜', 'L户外皮肤衣防紫外线防晒衣男女夏季超薄透气防晒服运动风衣', '', '75.00', '/upload/goods_img/户外服饰/5db3b8b573966.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('47', '好看哒专营店', '防晒衣女夏季新款韩版连帽系带长袖防晒衣糖果色沙滩户外披肩防晒衣', 'FSY-54', '19.90', '/upload/goods_img/户外服饰/5db3b8b88f380.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('48', '户外途量工厂专卖店', '户外速干T恤男 女休闲跑步运动健身短袖大码情侣快干衣排汗透气', '', '22.80', '/upload/goods_img/户外服饰/5db3b8b8abc8f.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('49', '好看哒专营店', '防晒衣 户外薄款防紫外线印花防晒衣', 'FSY-1736', '25.00', '/upload/goods_img/户外服饰/5db3b8b8c0c84.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('50', '好看哒专营店', '防晒衣夏季女蝙蝠袖连帽拉链短款防晒衣', 'FSY-5423', '35.00', '/upload/goods_img/户外服饰/5db3b8b9b16a1.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('51', '好看哒专营店', '防晒衣男士薄款纯色连帽防晒衣', 'FSY-4167', '35.00', '/upload/goods_img/户外服饰/5db3b8b9bbe9c.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('52', '户外途量工厂专卖店', '城徒 户外春夏单层冲锋衣女防晒衣男轻薄防风钓鱼服透气速干外套长袖衫', '', '35.80', '/upload/goods_img/户外服饰/5db3b8ba1b847.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('53', '好看哒专营店', '防晒衣韩版短款薄款连帽长袖防晒衣', 'FSY-5439', '36.00', '/upload/goods_img/户外服饰/5db3b8ba72314.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('54', '好看哒专营店', '防晒衣女中长款涂鸦薄款防晒衣', 'FSY-5282', '36.00', '/upload/goods_img/户外服饰/5db3b8ba99fd5.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('55', '好看哒专营店', '防晒衣女中长款薄款防晒衣', 'FSY-5456', '37.90', '/upload/goods_img/户外服饰/5db3b8baa8e20.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('56', '户外途量工厂专卖店', '秋冬户外男抓绒衣摇粒绒女外套保暖冲锋衣内胆开衫卫衣', '', '39.00', '/upload/goods_img/户外服饰/5db3b8bab267b.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('57', '户外途量工厂专卖店', '户外秋冬季加绒加厚抓绒衣男女摇粒绒保暖抓绒外套开衫冲锋衣内胆', '', '49.00', '/upload/goods_img/户外服饰/5db3b8bae0cb5.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('58', '江门新会馆', '【江门新会馆】caxa断码 两截速干裤女 韩版修身透气徒步快干裤野外登山跑步长裤', '', '50.00', '/upload/goods_img/户外服饰/5db3b8baf06b9.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('59', '宝仕母婴专营店专柜', 'L夏季休闲短裤男宽松5分中裤子男士运动五分裤大码跑步速干沙滩裤', '', '55.00', '/upload/goods_img/户外服饰/5db3b8bb2ba54.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('60', '江门新会馆', '【江门新会馆】caxa修身户外健身速干裤女 快干弹力透气登山大码长裤 弹力户外裤', '', '60.00', '/upload/goods_img/户外服饰/5db3b8bb513ed.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('61', '探路者正江专卖店', '探路者/TOREADt恤女户外夏季快干速干透气运动服TAJG82984', '', '61.00', '/upload/goods_img/户外服饰/5db3b8bb5ac47.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('62', '铁好家居美妆日用百货专营店', '佳钓尼 夏遮阳防晒帽套头面罩透气防紫外线渔夫帽', '', '48.00', '/upload/goods_img/户外服饰/5db3b8bb8e0a3.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('63', '宝仕母婴专营店专柜', '防晒衣男女情侣春夏季防雨风衣超薄透气速干钓鱼防晒服户外皮肤衣MN', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bb9f9e7.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('64', '户外途量工厂专卖店', '城徒 春夏季速干裤男女大码轻薄快干透气户外修身显瘦弹力冲锋裤', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbb3e24.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('65', '宝仕母婴专营店专柜', 'L运动户外夏季速干t恤 男女短袖速干衣快干t恤 吸汗透气', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbe33ff.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('66', '宝仕母婴专营店专柜', 'L健身房教练速干T恤男女 圆领情侣夏季短袖汗衫', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bc1bca2.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('67', '户外途量工厂专卖店', '城徒 冬季正品户外冲锋裤男女抓绒裤保暖防风防水加厚软壳裤登山裤长裤', '', '75.00', '/upload/goods_img/户外服饰/5db3b8bc42dab.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('68', '江门新会馆', '【江门新会馆】caxa修身弹力女款休闲棉裤 户外休闲快干长裤 女士跑步登山健身裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bc96997.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('69', '江门新会馆', '【江门新会馆】caxa休闲修身速干裤 透气轻薄运动裤耐磨健身户外裤多袋裤七分裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bcac92c.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('70', '探路者正江专卖店', '探路者/TOREAD 运动服 短袖户外女运动跑步排汗透气圆领速干T恤TAJF82784', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bcc53b9.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('71', '户外途量工厂专卖店', '冲锋裤男户外秋冬防风防水软壳裤女加绒加厚抓绒裤保暖徒步登山裤', '', '79.00', '/upload/goods_img/户外服饰/5db3b8bd362c1.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('72', '探路者正江专卖店', '探路者/TOREADT恤女 夏户外女式超轻透气速干衣圆领T恤短袖KAJG82352', '', '99.00', '/upload/goods_img/户外服饰/5db3b8bd44554.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('73', '探路者正江专卖店', '探路者/TOREAD 短袖 18春夏新款户外女式圆领速干透气印花短袖T恤TAJG82939', '', '99.00', '/upload/goods_img/户外服饰/5db3b8bd602ab.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('74', '探路者正江专卖店', '探路者/TOREAD夏新款户外运动透气弹力速干女式半袖短袖T恤KAJG82310', '', '99.00', '/upload/goods_img/户外服饰/5db3b8be68f86.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('75', '探路者正江专卖店', '探路者/TOREAD T恤女款 秋季户外短袖女时尚速干透气短袖T恤TAJG82938', '', '99.00', '/upload/goods_img/户外服饰/5db3b8be96a09.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('76', '洋湖轩榭官方旗舰店', '洋湖轩榭 春秋季新款中老年男装连帽冲锋衣爸爸装休闲夹克衫外套男A', '钜惠双十一 感恩惠顾', '126.42', '/upload/goods_img/户外服饰/5db3b8bea6025.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('77', '南城百货专营店', '秋冬季加绒加厚冲锋衣男女三合一可拆卸两件套防水户外情侣登山服', '秋冬季加绒加厚冲锋衣男女三合一可拆卸两件套防水户外情侣登山服', '158.00', '/upload/goods_img/户外服饰/5db3b8bede68a.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('78', '正江服饰专营店', '包邮韵格NT1021男士紧身训练PRO运动健身跑步长袖弹力速干服纯色衣服', '', '59.00', '/upload/goods_img/户外服饰/5db3b8beeb97d.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('79', '流行饰品运动户外器械', '汤河店 户外冲锋裤男女可脱卸秋冬季加绒加厚保暖软壳防风防水登山滑雪裤', '', '179.00', '/upload/goods_img/户外服饰/5db3b8bf07cf9.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('80', '流行饰品运动户外器械', '汤河店 韩国正品vvc防晒衣女经典薄夏季中长款防晒服户外防紫外线皮肤衣', '', '499.00', '/upload/goods_img/户外服饰/5db3b8bf2bf21.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('81', '乐颐汇数码专营店', '荣耀10青春版 幻彩渐变 2400万AI自拍 全网通版4GB+64GB', '2400万AI高清自拍，麒麟710处理器，炫光渐变色', '989.00', '/upload/goods_img/手机数码/5db3b8700e46c.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('82', '乐颐汇数码专营店', '华为/HUAWEI 畅享9 手机 全网通 4GB+128GB', '6.26英寸珍珠屏 4000mAh大电池', '1099.00', '/upload/goods_img/手机数码/5db3b8731cf7b.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('83', '米果商贸专柜', '折叠式平板电脑支架底座懒人手机支架【颜色随机发货】', '', '9.90', '/upload/goods_img/手机数码/5db3b87337179.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('84', '邮乐韵菲专营店', '（亏本促销）车载手机支架双面吸盘式家居懒人多功能通用可弯曲创意手机支架', '', '1.00', '/upload/goods_img/手机数码/5db3b87345fc4.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('85', '麦尚科技专营店', '手机支架懒人支架卡通创意平板电脑桌面支撑座【款式随机】', '', '9.90', '/upload/goods_img/手机数码/5db3b8734f81e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('86', '邮乐韵菲专营店', '无线蓝牙耳机迷你超小苹果安卓通用耳机', '送两条充电线+一个收纳盒', '15.90', '/upload/goods_img/手机数码/5db3b873b60d7.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('87', '万品好易购商城', 'XO NB23 八角宝石锌合金数据线', '产品颜色：黑色  白色 宝石外观 不拘一格;  锌合金 更出色；  2.4A极速充电，高效传输文件', '49.00', '/upload/goods_img/手机数码/5db3b873bf931.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('88', '万品好易购商城', 'XO F1 户外Mini蓝牙音箱 经典挂扣 防水 防尘/防摔 抗干扰性强 无线链接 免提通话', '音量调节/音乐播放、暂停/上下曲切换 语音报号/来电铃声/数据输出/直读SD卡', '99.00', '/upload/goods_img/手机数码/5db3b873d7806.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('89', '万品好易购商城', 'XO  PB39 移动电源 8000mAh', '8000mAh大容量 双输出带LED灯  ； 电源保护, 好用更安全； 智能分流 高效输出', '119.00', '/upload/goods_img/手机数码/5db3b8740878f.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('90', '万品好易购商城', 'XO BS8 运动蓝牙耳机源于经典 加以升级 鲨鱼鳍耳翼 舒适牢固', '源于经典 加以升级； 鲨鱼鳍耳翼 舒适牢固 ； 无惧雨水  防水防汗； 蓝牙4.2版本，深度降噪', '169.00', '/upload/goods_img/手机数码/5db3b87419133.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('91', '万品好易购商城', 'XO BS7 运动蓝牙耳机 深度降噪 通话更清晰 轻松操控 随意切换', '强劲的CSR芯片 提升续航能力； 蓝牙4.1版本，深度降噪，通话更清晰； 霍尔磁控开关，智能感应', '199.00', '/upload/goods_img/手机数码/5db3b8742586e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('92', '万品好易购商城', 'XO A8 蓝牙音箱 智能触控 自由切换 大容量电池 可连续播放约4-6小时 土豪金 星空银 银色', '智能触控，自由切换； 内置1000毫安聚合物电池，全频高清喇叭+低音振膜,可连续播放约4-6小时', '169.00', '/upload/goods_img/手机数码/5db3b874390f2.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('93', '普润家居专营店', 'oppo蓝牙耳机迷你vivo超小隐形运动通用华为无线耳塞超长待机开车', '', '79.00', '/upload/goods_img/手机数码/5db3b874496ae.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('94', '木易生活专柜', '2米超长  美能格  苹果安卓Type-C数据线 2.4A快充电线', '2米超长  美能格  苹果安卓Type-C数据线 2.4A快充电线', '12.90', '/upload/goods_img/手机数码/5db3b874588e2.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('95', '木易生活专柜', '沃晟伦蓝牙耳机M165蓝牙耳机入耳式商务车载便携式4.1*', '沃晟伦蓝牙耳机M165蓝牙耳机入耳式商务车载便携式4.1', '15.90', '/upload/goods_img/手机数码/5db3b8746c166.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('96', '北京信酷数码商城专柜', 'iPhone 苹果原装充电器套装/数据线+充电头电源适配器 通用型', '【全国包邮】 充电套装更优惠', '69.00', '/upload/goods_img/手机数码/5db3b874784b9.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('97', '小牛数码家居专柜', '飞利浦/PHILIPS 多功能可伸缩车载手机支架DLK35002', '多功能可伸缩车载手机支架', '68.00', '/upload/goods_img/手机数码/5db3b87484bf4.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('98', '北京信酷数码商城专柜', '苹果 iphone X /XS MAX/XS/XR/钢化膜 全屏全覆盖 手机贴膜', '', '19.00', '/upload/goods_img/手机数码/5db3b87493e28.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('99', '邮乐萍乡馆', '南孚(NANFU)3V纽扣电池两粒 CR2032/CR2025/CR2016锂电池电子汽车钥匙遥控', '奔驰c200l福特 新蒙迪欧 高尔夫7 新马自达昂克赛拉阿特兹 手表奔驰大众汽车钥匙电池', '9.90', '/upload/goods_img/手机数码/5db3b874a670c.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('100', '信酷小米专营店', '小米（MI） 车载充电器快充版 QC3.0 双口输出 智能温度控制 兼容iOS和Android设备', '小米正品 全国包邮', '89.00', '/upload/goods_img/手机数码/5db3b874b8050.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('101', '北京信酷数码商城专柜', '苹果 iPhone6/6S/6Plus/6SPlus/iPhone7/7P防爆钢化玻璃膜高清手机贴膜', '进口AGC玻璃板！超薄钢化玻璃膜！秒杀国产玻璃！', '26.00', '/upload/goods_img/手机数码/5db3b874c207b.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('102', '北京信酷数码商城专柜', 'OPPO手机原装耳机R11/PLUS入耳式线控r11s/r15耳机 白色盒装', '', '38.80', '/upload/goods_img/手机数码/5db3b874d31ef.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('103', '北京信酷数码商城专柜', '华为（HUAWEI）小天鹅无线蓝牙免提通话音箱4.0 便携户外/车载迷你音响AM08', '音·触即发！360°音效技术，音质真实自然，简洁触控操作，支持蓝牙免提通话。', '95.00', '/upload/goods_img/手机数码/5db3b874e280a.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('104', '北京信酷数码商城专柜', '三星 32G内存卡(CLASS10 48MB/s)  手机内存卡32g MicroSD存储卡', '正品行货 支持专柜验货 实行三包政策 轻放心购买', '95.00', '/upload/goods_img/手机数码/5db3b874edfa5.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('105', '北京信酷数码商城专柜', '华为/HUAWEI 华为快速充电套装 4.5V/5A充电头+type-c线  华为充电器', '支持p20/mate10/9pro/p10plus荣耀10/v10/note10等机型', '98.00', '/upload/goods_img/手机数码/5db3b87504947.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('106', '北京信酷数码商城专柜', '小米（MI）小米手环2（黑色）智能运动 防水 心率监测 计步器 久坐提醒', '正品行货 全国包邮', '159.00', '/upload/goods_img/手机数码/5db3b875133ab.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('107', '信酷小米专营店', '小米活塞耳机 清新版 黑色 蓝色 入耳式手机耳机 通用耳麦', '小米正品 全国包邮', '45.00', '/upload/goods_img/手机数码/5db3b8751ef2e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('108', '信酷小米专营店', '小米支架式自拍杆 灰色 黑色 蓝牙遥控迷你便携带三脚架多功能', '小米正品 全国包邮', '105.00', '/upload/goods_img/手机数码/5db3b875327b2.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('109', '信酷小米专营店', '小米（MI）方盒子蓝牙音箱2 无线迷你随身户外便携客厅家用小音响', '小米正品 全国包邮', '149.00', '/upload/goods_img/手机数码/5db3b87546807.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('110', '信酷小米专营店', '小米（MI）小米运动蓝牙耳机mini 黑色白色 无线蓝牙入耳式运动耳机', '小米正品 全国包邮', '169.00', '/upload/goods_img/手机数码/5db3b8755a85b.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('111', '信酷小米专营店', '小米（MI）小钢炮2代 无线蓝牙便携音箱', '小米正品 全国包邮', '139.00', '/upload/goods_img/手机数码/5db3b87564c6e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('112', '铁好家居美妆日用百货专营店', '公牛BULL 独立3孔位2USB创意魔方插座 1.5米线GN-UUB122【热卖推荐】', '立体集成结构 小巧轻便 五重保护', '67.00', '/upload/goods_img/手机数码/5db3b87575612.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('113', '九洲科瑞数码专营店', '华为 HUAWEI 畅享9 Plus 4GB+128GB', '', '1.00', '/upload/goods_img/手机数码/5db3b8758639e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('114', '九洲科瑞数码专营店', '华为HUAWEI nova4 4800万超广角三摄8GB+128GB', '', '2.00', '/upload/goods_img/手机数码/5db3b875932a9.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('115', '九洲科瑞数码专营店', '华为 HUAWEI P30 Pro 徕卡四摄10倍混合变焦麒麟980芯片屏内指纹 8GB+128G', '', '4.00', '/upload/goods_img/手机数码/5db3b8759d6bb.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('116', '邮乐萍乡馆', '南孚 安卓数据线 NF-LM001 小米华为OPPO三星vivo充电器通用', '', '9.90', '/upload/goods_img/手机数码/5db3b875a923e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('117', '铁好家电数码专营店', '公牛BULL 二合一苹果lighting+micro USB数据线GN-J81N【热卖推荐】', 'MFi官方认证，快速充电，抗折断', '69.00', '/upload/goods_img/手机数码/5db3b875b2e80.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('118', '邮乐萍乡馆', '南孚(NANFU)LR6AA聚能环 5号+7号碱性干电池【共4粒装】', '', '9.90', '/upload/goods_img/手机数码/5db3b875be233.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('119', '岳灵生活专营店', '南孚手机充电宝 10000毫安大容量礼盒装NFCT10', '', '169.00', '/upload/goods_img/手机数码/5db3b875cad56.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('120', '邮乐萍乡馆', '南孚(NANFU)LR03AAA聚能环7号电池碱性干电池12粒装儿童玩具遥控器赛车闹钟智能门锁电池', 'AAA干电池持久电力家用', '27.80', '/upload/goods_img/手机数码/5db3b875d3610.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('121', '中国农垦官方旗舰店', '买2份送一份【中国农垦】黑龙江北大荒  支豆浆粉早餐豆浆粉 非转基因大豆 五谷豆浆粉28g*10袋', '早餐豆粉买2份送一份', '18.00', '/upload/goods_img/特色美食/5db3b8d338ebc.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('122', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒支装豆浆粉（醇豆浆、红枣味可选） 非转基因大豆', '早餐豆粉买2份送一份', '15.00', '/upload/goods_img/特色美食/5db3b8d3432ce.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('123', '牛牛食品专营店', '(8月新货)蒙牛小真果粒125ml*20盒草莓味果粒酸奶小胖丁迷你装', '8月份的新货,超好喝，儿童，果粒，健康营养，', '22.70', '/upload/goods_img/特色美食/5db3b8d34deb1.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('124', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒 支装豆浆粉 麦香甜豆浆粉 28g*10袋', '早餐豆粉买2份送一份', '15.00', '/upload/goods_img/特色美食/5db3b8d3651ce.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('125', '禾煜食品旗舰店', '禾煜 黄冰糖418g包  冰糖土冰糖  煲汤食材', '黄冰糖买2送1', '15.00', '/upload/goods_img/特色美食/5db3b8d66e304.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('126', '新农哥旗舰店', '【新农哥】板栗仁108gx4袋  休闲零食小吃', '', '26.90', '/upload/goods_img/特色美食/5db3b8d6832f9.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('127', '新农哥旗舰店', '新农哥 每日坚果 混合果仁 缤纷坚果仁175g*2盒  休闲零食', '缤纷美味 一吃钟情', '59.90', '/upload/goods_img/特色美食/5db3b8d68e2c4.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('128', '众天蜂蜜邮乐农品旗舰店', '众天山花蜂蜜500g', '秦岭深处 百花酿造而成 最受欢迎的蜂蜜 性价比极高！', '19.90', '/upload/goods_img/特色美食/5db3b8d6a2ed1.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('129', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒 非转基因大豆 豆浆粉 红枣豆浆粉28g*10袋', '早餐豆粉买2份送一份', '18.00', '/upload/goods_img/特色美食/5db3b8d6ae283.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('130', '考拉小哥专营店', '薛小贱 每日坚果25g*1包', '厂家直供、7种混合、日期新鲜', '1.66', '/upload/goods_img/特色美食/5db3b8d6b8e66.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('131', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂五宝茶 益本茶 男人茶养生茶 草本', '【萃涣堂】五宝益本茶 男人茶买2送1五宝茶男人茶枸杞茶玛咖片黄精男肾茶老公八宝茶养生茶 做性福的男人', '19.00', '/upload/goods_img/特色美食/5db3b8d6c8481.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('132', '萃涣堂蒲公英茶专柜', '【滨州馆】寻味山东新鲜现做手工 滨州黑芝麻红枣饼核桃 枸杞传统工艺 香甜可口 10g独立装包邮', '寻味山东 新鲜现做手工滨州黑芝麻红枣饼核桃 枸杞传统工艺 香甜可口 10g独立装包邮', '1.00', '/upload/goods_img/特色美食/5db3b8d6cc302.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('133', '正江食品专营店', '寿全斋  红枣姜茶 姜茶 12g*10条', '', '25.00', '/upload/goods_img/特色美食/5db3b8d6debe7.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('134', '阿坝州理县地方扶贫馆', '四川浓香菜籽油 5升农家非转基因5l纯菜子粮油食用油约10斤植物油', '2019新油，滴滴香浓，四川非转基因纯菜籽油', '66.00', '/upload/goods_img/特色美食/5db3b8d6f246b.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('135', '千岛湖品牌农产品馆', '千岛湖 千岛渔娘 糍粑（4味）200g', '买二赠一 糍粑', '15.00', '/upload/goods_img/特色美食/5db3b8d706ecd.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('136', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂 金菊饮 菊花枸杞茶 菊花茶叶贡菊散装杭枸杞菊花茶非解毒去火清热凉茶', '【滨州馆】萃涣堂 金菊饮 菊花枸杞茶 菊花茶叶贡菊散装杭枸杞菊花茶非解毒去火清热凉茶', '0.50', '/upload/goods_img/特色美食/5db3b8d713dd8.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('137', '果蔻食品专营店', '果蔻 每日坚果B款20g/包简装无礼盒成人儿童孕妇混合果仁坚果零食大礼包', '科学配比  营养美味', '1.39', '/upload/goods_img/特色美食/5db3b8d729985.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('138', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂 黑苦荞茶 5克/袋 苦荞茶正品 大凉山', '【滨州馆】萃涣堂 黑苦荞茶 5克/袋 苦荞茶正品 大凉山', '0.50', '/upload/goods_img/特色美食/5db3b8d736890.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('139', '佳林院红枣旗舰店', '【0.4元/袋佳林院泡茶煮粥煲汤枣圈】山东特产乐陵红枣每袋约12克袋装50袋起拍包邮部分偏远地区除外', '佳林院品牌装，泡茶煮粥枣圈，拼团价0.4元/袋，每袋约12克装，50袋起拍，食用方便，经济实惠！', '0.40', '/upload/goods_img/特色美食/5db3b8d798327.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('140', '果蔻食品专营店', '果蔻 每日坚果25g*1包成人儿童孕妇混合坚果混合果仁小吃零食', '', '1.65', '/upload/goods_img/特色美食/5db3b8d7aa43b.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('141', '萃涣堂蒲公英茶专柜', '【滨州馆】红枣黑糖姜茶大姨妈水姜糖女老姜块生姜姜汁姜汤红糖姜枣茶小袋装25克/袋', '姜味浓,红枣多,顺畅暖暖,效果杠杠“冬吃萝卜夏吃姜。”传统组方真材实料。', '0.90', '/upload/goods_img/特色美食/5db3b8dab8392.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('142', '南阳专区专营店', '南阳西峡现摘金桃黄心猕猴桃15枚 （单枚60g-90g）买一送一 共30枚，合并发一箱', '买一赠一活动', '19.90', '/upload/goods_img/特色美食/5db3b8dac3745.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('143', '果然好口福专柜', '宁 福吉 5斤起拍新疆原味生核桃新货 特产薄皮核桃 坚果炒货休闲零食包邮', '新疆薄皮核桃  送夹子', '9.90', '/upload/goods_img/特色美食/5db3b8daea466.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('144', '刘陶生鲜旗舰店', '刘陶 福建红肉柚子红心蜜柚8.5-9.5斤（3-4个装） 新鲜水果2', '', '25.50', '/upload/goods_img/特色美食/5db3b8db3a40e.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('145', '丹东邮政农特产品专营店', '2019年丹东新鲜板栗4斤东北农家生板栗毛栗子现摘栗子应季水果干', '', '19.90', '/upload/goods_img/特色美食/5db3b8db3a7f6.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('146', '果然好口福专柜', '宁福吉 新疆和田大枣煲粥枣500克包邮', '', '6.60', '/upload/goods_img/特色美食/5db3b8db578d5.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('147', '小呆妞旗舰店', '预售小呆妞四川蒲江金艳黄心猕猴桃90-110g中果24枚 72内小时发货', '关于售后：签收24小时内后台申请退款请提供坏果和快递单合照，会根据实际损坏赔付', '27.90', '/upload/goods_img/特色美食/5db3b8db63c28.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('148', '萃涣堂蒲公英茶专柜', '萃涣堂茉莉绿茶三角茶包袋茉莉花茶小袋装绿茶袋泡冷泡茶包伴手礼花茶茶包组合玫瑰茉莉绿茶袋泡三', '萃涣堂茉莉绿茶三角茶包袋茉莉花茶小袋装绿茶袋泡冷泡茶包', '0.90', '/upload/goods_img/特色美食/5db3b8db71303.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('149', '丹东邮政农特产品专营店', '新鲜现挖番薯红黄心密署农家自种蒸煮粉糯香甜沙地地瓜烤烟署5斤', '', '16.80', '/upload/goods_img/特色美食/5db3b8db862f8.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('150', '川锅壹号旗舰店', '川锅壹号辣白菜228g韩国泡菜下饭菜正宗朝鲜口味拌饭菜版面菜', '酸辣可口 老少皆宜', '5.90', '/upload/goods_img/特色美食/5db3b8dbcdf79.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('151', '福香御旗舰店', '福香御 慢生长2018东北大米雪花米10斤真空包邮色选米', '初霜收割，180天慢生长周期，30天鲜磨直达，大米胚乳含量极为丰富，口感软糯香甜。', '27.90', '/upload/goods_img/特色美食/5db3b8dbdb26c.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('152', '兰州鲜合苑百合特产店专营店', '现包现发100%新鲜正宗兰州市七里河区产兰州鲜百合3年生兰州百合农家甜百合，约16颗百合一斤', '兰州鲜百合，无任何添加剂，宝宝也可以放心食用', '19.90', '/upload/goods_img/特色美食/5db3b8dbe8d2f.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('153', '当季鲜果', '黄金奇异果12枚包邮（中果70-90克，拍2件多送6枚，合并发30枚）金艳黄心猕猴桃新鲜水果', '快递随机，不能指定快递，下单后72小时内发货，下雨天顺延，购买前请阅读售后要求，介意慎拍', '9.90', '/upload/goods_img/特色美食/5db3b8dc0be0c.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('154', '丹东邮政农特产品专营店', '东北特产老品种大米  凤城蓝乡生态米 10斤 珍珠米 非蟹田', '东北特产老品种大米  凤城蓝乡生态米 10斤 珍珠米 非蟹田', '28.80', '/upload/goods_img/特色美食/5db3b8dc17d77.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('155', '川锅壹号旗舰店', '川锅壹号蟹黄酱拌饭酱秃黄油拌面酱蟹粉酱蟹黄膏酱料即食螃蟹酱', '金脂香软 经典美味', '9.90', '/upload/goods_img/特色美食/5db3b8dc2c59c.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('156', '刘陶生鲜旗舰店', '刘陶 云南昭通丑苹果5斤大果（13-15个）新鲜水果', '拼团的亲想更加快的发货，尽量和已经开团的亲拼团购买', '27.00', '/upload/goods_img/特色美食/5db3b8dc365c6.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('157', '福香御旗舰店', '福香御 大米5kg装2018新米圆粒珍珠米寿司香米秋田小町农家东北大米包邮', '', '29.99', '/upload/goods_img/特色美食/5db3b8de5a091.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('158', '刘陶生鲜旗舰店', '刘陶 云南石林人生果圆果净果5斤（25-35个）大果新鲜水果2', '拼团的亲想更加快的发货，尽量和已经开团的亲拼团购买', '25.00', '/upload/goods_img/特色美食/5db3b8de6ec9e.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('159', '刘陶生鲜旗舰店', '刘陶 福建红肉柚子红心蜜柚8.5-9.5斤（3-4个装） 新鲜水果特卖', '', '25.50', '/upload/goods_img/特色美食/5db3b8de7ac09.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('160', '萃涣堂蒲公英茶专柜', '【萃涣堂】 蜜桃乌龙茶  水果茶 三角包共蜜桃白桃乌龙茶袋泡花茶包花', '新品上市!独立三角袋泡茶,携带冲泡更便捷!【萃涣堂】 蜜桃乌龙茶 水果茶 三角包', '0.90', '/upload/goods_img/特色美食/5db3b8de97517.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list` VALUES ('161', '信酷小米专营店', '小米/MIUI 小米电视4S 43英寸人工智能语音网络平板电视 1GB+8GB HDR 4K超高清', '金属机身', '1.00', '/upload/goods_img/大家电/5db3b89a8d174.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('162', '邮乐安阳馆', '【汤阴县积分用户专享】洗衣机XpB—126-9896S', '', '1.00', '/upload/goods_img/大家电/5db3b89a9f288.jpg', '1578206762', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('163', '海信电器旗舰店', '海信（Hisense）HZ39E35A 39英寸高清手机交互 轻薄金属 WIFI人工智能液晶电视机', '', '1.00', '/upload/goods_img/大家电/5db3b89ab61bd.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('164', '邮滋味如皋馆专柜', '创维9公斤变频滚筒洗衣机  型号：F9015NC-炫金   如皋免费送货上门，南通包邮，华东地区配货', '创维洗衣机，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89b52437.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('165', '邮滋味如皋馆专柜', '创维2P定频立式柜机，型号：KFR-50LW/F2DA1A-3（限如皋地区免费送货上门安装）', '创维定频空调，免费上门安装，绝对优惠，每月更有现场特惠活动', '4.00', '/upload/goods_img/大家电/5db3b89b6e95e.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('166', '创维电视官方旗舰店', '创维/SKYWORTH 58H8M 58英寸4K超高清全面屏防蓝光人工智能语音HDR超薄网络液晶电视', '4K超高清，声像自然，一场声觉革新，视觉体验，光学防蓝光，护眼不偏色', '3.00', '/upload/goods_img/大家电/5db3b89b79d10.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('167', '邮乐洛阳', '【洛阳金融积分兑换】TCL 205升 三门电冰箱 （星空银） BC（邮政网点配送）', '', '1.00', '/upload/goods_img/大家电/5db3b89bc11c1.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('168', '邮滋味如皋馆专柜', '创维9公斤全自动波轮洗衣机，型号XQB90-52BAS淡雅银如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，夏季特惠；每月现场有特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89bcfc24.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('169', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】家用洗衣机，图片仅供参考', '', '1.00', '/upload/goods_img/大家电/5db3b89be0d98.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('170', '邮乐安阳馆', '【滑县积分用户专享】创维电器洗衣机9公斤波轮安阳', '', '1.00', '/upload/goods_img/大家电/5db3b89bee474.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('171', '邮乐安阳馆', '美菱3开门冰箱BCD-209M3CX【汤阴县积分兑换专用，其他下单不发货】', '', '1.00', '/upload/goods_img/大家电/5db3b89c06586.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('172', '邮乐安阳馆', '美菱电冰箱209L3CS【安阳县积分兑换用户专用，其他地区发】', '', '1.00', '/upload/goods_img/大家电/5db3b89c16f2a.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('173', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】自动洗衣机 家用洗衣机，图片仅供参考', '', '2.00', '/upload/goods_img/大家电/5db3b89c22e95.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('174', '邮乐安阳馆', '【滑县积分用户专享】创维电器电视50寸4K智能安阳', '', '3.00', '/upload/goods_img/大家电/5db3b89c2bb37.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('175', '邮乐安阳馆', '【安阳县积分用户专享】长虹液晶电视55U1', '', '3.00', '/upload/goods_img/大家电/5db3b89f48109.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('176', '海信电器旗舰店', '海信（Hisense）HZ32E30D 32英寸蓝光高清平板液晶电视机 酒店宾馆卧室推荐', '【海信今日限时特惠-到手价788元！】限量200台！抢完即止！', '749.00', '/upload/goods_img/大家电/5db3b89f51194.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('177', '邮滋味如皋馆专柜', '邮乐特卖：庭美家用消毒柜    型号：YTP-280    如皋免费送货上门，南通包邮，华东地区配送', '庭美消毒柜，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '755.00', '/upload/goods_img/大家电/5db3b89f5ec57.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('178', '吉舜诚商城专柜', '飞利浦（PHILIPS）  19英寸液晶电视机 显示器两用 hdmi高清接口', '19PFF2650', '799.00', '/upload/goods_img/大家电/5db3b89fb14ba.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('179', '创维集团官方旗舰店', '创维/SKYWORTH 32X3 32英寸窄边非智能老人机蓝光高清节能LED平板液晶电视机工程机', '蓝光高清，经典窄边，节能液晶，简单好用，谁用谁知道，实用耐用款', '799.00', '/upload/goods_img/大家电/5db3b89fc8fa8.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('180', '吉舜诚商城专柜', '飞利浦（PHILIPS）22英寸LED高清液晶平板电视机含底座 黑色', '22PFF2650/T3', '899.00', '/upload/goods_img/大家电/5db3b89fd917b.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('181', '创维集团官方旗舰店', '创维/SKYWORTH 32X6 32英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠，高清智能电视，WIFI，酷开系统，10核处理器', '899.00', '/upload/goods_img/大家电/5db3b89fe6086.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('182', '海信电器旗舰店', '海信 (Hisense) HZ32E35A 32英寸AI智能WIFI 轻薄金属 卧室神器高清电视机', '', '899.00', '/upload/goods_img/大家电/5db3b8a0004c2.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('183', '邮滋味如皋馆专柜', '创维邮乐特卖： 32寸液晶电视机，型号：32E381S   如皋免费送货上门，南通包邮，华东地区配货', '创维液晶电视大品牌，夏季特惠；每月现场有特惠活动', '899.00', '/upload/goods_img/大家电/5db3b8a01be30.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('184', '琥麟电器专柜', '海信 XQB60-H3568 6公斤全自动波轮洗衣机', '', '749.00', '/upload/goods_img/大家电/5db3b8a0279b3.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('185', '邮滋味如皋馆专柜', '创维7公斤全自动波轮洗衣机，型号：XQB70-21C淡雅银，如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '928.00', '/upload/goods_img/大家电/5db3b8a0367fe.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('186', '邮滋味如皋馆专柜', '创维单冷冰柜，型号：BD/C-160雅白，如皋地区免费送货上门安装，南通地区包邮，华东地区配货', '创维冰柜，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '999.00', '/upload/goods_img/大家电/5db3b8a042f39.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('187', '创维集团官方旗舰店', '创维（SKYWORTH）32H5 32英寸高清HDR 护眼全面屏 AI人工智能语音 网络WIFI 卧', '高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '999.00', '/upload/goods_img/大家电/5db3b8a0511cd.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('188', '邮滋味如皋馆专柜', '创维/SKYWORTH热水器，型号：DSZF-D5501-80，如皋免费送货上门，南通包邮 创维/', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '999.00', '/upload/goods_img/大家电/5db3b8a07389d.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('189', '琥麟电器专柜', 'Hisense/海信 HB80DA332G8KG公斤大容量家用全自动节能波轮洗衣机', '', '899.00', '/upload/goods_img/大家电/5db3b8a386615.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('190', '琥麟电器专柜', '海信 BCD-163N/B 冰柜冷藏冷冻双温家用商用小型卧式', '', '999.00', '/upload/goods_img/大家电/5db3b8a390a27.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('191', '吉舜诚商城专柜', '东芝（TOSHIBA）  32英寸 蓝光液晶电视 高清平板电视机 东芝电视机', '32L1500C', '1.00', '/upload/goods_img/大家电/5db3b8a69aafd.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('192', '创维集团官方旗舰店', '创维/SKYWORTH 40X6 40英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠！高清智能，10核处理器，可以WIFI上网', '1.00', '/upload/goods_img/大家电/5db3b8a9a6b14.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('193', '甲子商城旗舰店', '康佳/KONKA  LED39E330C 39英寸卧室电视高清蓝光节能平板液晶电视', '', '949.00', '/upload/goods_img/大家电/5db3b8a9b22ae.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('194', '邮乐赣州馆', '【不支持邮乐卡支付】创维-彩电-40E1C 40英寸全高清HDR 护眼全面屏 AI人工智能语音', '', '1.00', '/upload/goods_img/大家电/5db3b8a9cf38d.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('195', '琥麟电器专柜', '海信 BCD-177F/Q 177升 双门冰箱', '', '1.00', '/upload/goods_img/大家电/5db3b8a9f0abd.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('196', '创维集团官方旗舰店', '创维/SKYWORTH 43X6 43英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '【买电视选创维】高清智能，10核处理器，质量上乘，价格厚道，可以Wifi上网', '1.00', '/upload/goods_img/大家电/5db3b8aa1b4b4.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('197', '创维集团官方旗舰店', '创维（SKYWORTH）40H5 40英寸全高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '全高清HDR 护眼全面屏 AI人工智能语音', '1.00', '/upload/goods_img/大家电/5db3b8aa26c4f.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('198', '邮乐安阳馆', '市区积分用户专享】创维平板电视32X6', '', '1.00', '/upload/goods_img/大家电/5db3b8aa31c19.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('199', '吉舜诚商城专柜', '飞利浦（PHILIPS）32英寸新品高清LED电视 接口丰富窄边高清LED液晶平板电视机', '32PHF3282/T3', '1.00', '/upload/goods_img/大家电/5db3b8aa3b85c.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('200', '琥麟电器专柜', '海信 BD/BC-308NU/A 冰柜家用 顶开式卧式商用冷藏冷冻柜', '', '1.00', '/upload/goods_img/大家电/5db3b8aa4931f.jpg', '1572059510', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('201', '明凰服饰专营店', '男女冲锋衣工装棉服外套修身加厚款', '邮乐支持微信，支付宝，网银，邮储卡和银联卡支付。（不同商品请分开下单）', '85.00', '/upload/goods_img/户外服饰/5db3b8b22c022.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('202', '户外途量工厂专卖店', '春夏季运动风衣钓鱼防晒衣男女超薄透气皮肤衣防风外套户外速干潮流衣服情侣款皮肤衣', '大码骑行长袖', '29.90', '/upload/goods_img/户外服饰/5db3b8b23604c.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('203', '探路者正江专卖店', '探路者/TOREAD 冲锋裤 运动裤 秋冬户外软壳裤男透气防风保暖徒步裤KAMG91159', '', '428.00', '/upload/goods_img/户外服饰/5db3b8b25312b.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('204', '探路者正江专卖店', '探路者运动服 探路者冲锋衣 19秋冬户外女式防水透湿套绒冲锋衣TAWH92285', '', '839.00', '/upload/goods_img/户外服饰/5db3b8b25d925.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('205', '好看哒专营店', '防晒衣女中长款薄款防晒服', 'FSY-6387', '45.00', '/upload/goods_img/户外服饰/5db3b8b56628b.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('206', '宝仕母婴专营店专柜', 'L户外皮肤衣防紫外线防晒衣男女夏季超薄透气防晒服运动风衣', '', '75.00', '/upload/goods_img/户外服饰/5db3b8b573966.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('207', '好看哒专营店', '防晒衣女夏季新款韩版连帽系带长袖防晒衣糖果色沙滩户外披肩防晒衣', 'FSY-54', '19.90', '/upload/goods_img/户外服饰/5db3b8b88f380.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('208', '户外途量工厂专卖店', '户外速干T恤男 女休闲跑步运动健身短袖大码情侣快干衣排汗透气', '', '22.80', '/upload/goods_img/户外服饰/5db3b8b8abc8f.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('209', '好看哒专营店', '防晒衣 户外薄款防紫外线印花防晒衣', 'FSY-1736', '25.00', '/upload/goods_img/户外服饰/5db3b8b8c0c84.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('210', '好看哒专营店', '防晒衣夏季女蝙蝠袖连帽拉链短款防晒衣', 'FSY-5423', '35.00', '/upload/goods_img/户外服饰/5db3b8b9b16a1.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('211', '好看哒专营店', '防晒衣男士薄款纯色连帽防晒衣', 'FSY-4167', '35.00', '/upload/goods_img/户外服饰/5db3b8b9bbe9c.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('212', '户外途量工厂专卖店', '城徒 户外春夏单层冲锋衣女防晒衣男轻薄防风钓鱼服透气速干外套长袖衫', '', '35.80', '/upload/goods_img/户外服饰/5db3b8ba1b847.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('213', '好看哒专营店', '防晒衣韩版短款薄款连帽长袖防晒衣', 'FSY-5439', '36.00', '/upload/goods_img/户外服饰/5db3b8ba72314.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('214', '好看哒专营店', '防晒衣女中长款涂鸦薄款防晒衣', 'FSY-5282', '36.00', '/upload/goods_img/户外服饰/5db3b8ba99fd5.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('215', '好看哒专营店', '防晒衣女中长款薄款防晒衣', 'FSY-5456', '37.90', '/upload/goods_img/户外服饰/5db3b8baa8e20.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('216', '户外途量工厂专卖店', '秋冬户外男抓绒衣摇粒绒女外套保暖冲锋衣内胆开衫卫衣', '', '39.00', '/upload/goods_img/户外服饰/5db3b8bab267b.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('217', '户外途量工厂专卖店', '户外秋冬季加绒加厚抓绒衣男女摇粒绒保暖抓绒外套开衫冲锋衣内胆', '', '49.00', '/upload/goods_img/户外服饰/5db3b8bae0cb5.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('218', '江门新会馆', '【江门新会馆】caxa断码 两截速干裤女 韩版修身透气徒步快干裤野外登山跑步长裤', '', '50.00', '/upload/goods_img/户外服饰/5db3b8baf06b9.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('219', '宝仕母婴专营店专柜', 'L夏季休闲短裤男宽松5分中裤子男士运动五分裤大码跑步速干沙滩裤', '', '55.00', '/upload/goods_img/户外服饰/5db3b8bb2ba54.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('220', '江门新会馆', '【江门新会馆】caxa修身户外健身速干裤女 快干弹力透气登山大码长裤 弹力户外裤', '', '60.00', '/upload/goods_img/户外服饰/5db3b8bb513ed.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('221', '探路者正江专卖店', '探路者/TOREADt恤女户外夏季快干速干透气运动服TAJG82984', '', '61.00', '/upload/goods_img/户外服饰/5db3b8bb5ac47.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('222', '铁好家居美妆日用百货专营店', '佳钓尼 夏遮阳防晒帽套头面罩透气防紫外线渔夫帽', '', '48.00', '/upload/goods_img/户外服饰/5db3b8bb8e0a3.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('223', '宝仕母婴专营店专柜', '防晒衣男女情侣春夏季防雨风衣超薄透气速干钓鱼防晒服户外皮肤衣MN', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bb9f9e7.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('224', '户外途量工厂专卖店', '城徒 春夏季速干裤男女大码轻薄快干透气户外修身显瘦弹力冲锋裤', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbb3e24.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('225', '宝仕母婴专营店专柜', 'L运动户外夏季速干t恤 男女短袖速干衣快干t恤 吸汗透气', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbe33ff.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('226', '宝仕母婴专营店专柜', 'L健身房教练速干T恤男女 圆领情侣夏季短袖汗衫', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bc1bca2.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('227', '户外途量工厂专卖店', '城徒 冬季正品户外冲锋裤男女抓绒裤保暖防风防水加厚软壳裤登山裤长裤', '', '75.00', '/upload/goods_img/户外服饰/5db3b8bc42dab.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('228', '江门新会馆', '【江门新会馆】caxa修身弹力女款休闲棉裤 户外休闲快干长裤 女士跑步登山健身裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bc96997.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('229', '江门新会馆', '【江门新会馆】caxa休闲修身速干裤 透气轻薄运动裤耐磨健身户外裤多袋裤七分裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bcac92c.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('230', '探路者正江专卖店', '探路者/TOREAD 运动服 短袖户外女运动跑步排汗透气圆领速干T恤TAJF82784', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bcc53b9.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('231', '户外途量工厂专卖店', '冲锋裤男户外秋冬防风防水软壳裤女加绒加厚抓绒裤保暖徒步登山裤', '', '79.00', '/upload/goods_img/户外服饰/5db3b8bd362c1.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('232', '探路者正江专卖店', '探路者/TOREADT恤女 夏户外女式超轻透气速干衣圆领T恤短袖KAJG82352', '', '99.00', '/upload/goods_img/户外服饰/5db3b8bd44554.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('233', '探路者正江专卖店', '探路者/TOREAD 短袖 18春夏新款户外女式圆领速干透气印花短袖T恤TAJG82939', '', '99.00', '/upload/goods_img/户外服饰/5db3b8bd602ab.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('234', '探路者正江专卖店', '探路者/TOREAD夏新款户外运动透气弹力速干女式半袖短袖T恤KAJG82310', '', '99.00', '/upload/goods_img/户外服饰/5db3b8be68f86.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('235', '探路者正江专卖店', '探路者/TOREAD T恤女款 秋季户外短袖女时尚速干透气短袖T恤TAJG82938', '', '99.00', '/upload/goods_img/户外服饰/5db3b8be96a09.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('236', '洋湖轩榭官方旗舰店', '洋湖轩榭 春秋季新款中老年男装连帽冲锋衣爸爸装休闲夹克衫外套男A', '钜惠双十一 感恩惠顾', '126.42', '/upload/goods_img/户外服饰/5db3b8bea6025.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('237', '南城百货专营店', '秋冬季加绒加厚冲锋衣男女三合一可拆卸两件套防水户外情侣登山服', '秋冬季加绒加厚冲锋衣男女三合一可拆卸两件套防水户外情侣登山服', '158.00', '/upload/goods_img/户外服饰/5db3b8bede68a.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('238', '正江服饰专营店', '包邮韵格NT1021男士紧身训练PRO运动健身跑步长袖弹力速干服纯色衣服', '', '59.00', '/upload/goods_img/户外服饰/5db3b8beeb97d.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('239', '流行饰品运动户外器械', '汤河店 户外冲锋裤男女可脱卸秋冬季加绒加厚保暖软壳防风防水登山滑雪裤', '', '179.00', '/upload/goods_img/户外服饰/5db3b8bf07cf9.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('240', '流行饰品运动户外器械', '汤河店 韩国正品vvc防晒衣女经典薄夏季中长款防晒服户外防紫外线皮肤衣', '', '499.00', '/upload/goods_img/户外服饰/5db3b8bf2bf21.jpg', '1572059516', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('241', '乐颐汇数码专营店', '荣耀10青春版 幻彩渐变 2400万AI自拍 全网通版4GB+64GB', '2400万AI高清自拍，麒麟710处理器，炫光渐变色', '989.00', '/upload/goods_img/手机数码/5db3b8700e46c.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('242', '乐颐汇数码专营店', '华为/HUAWEI 畅享9 手机 全网通 4GB+128GB', '6.26英寸珍珠屏 4000mAh大电池', '1099.00', '/upload/goods_img/手机数码/5db3b8731cf7b.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('243', '米果商贸专柜', '折叠式平板电脑支架底座懒人手机支架【颜色随机发货】', '', '9.90', '/upload/goods_img/手机数码/5db3b87337179.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('244', '邮乐韵菲专营店', '（亏本促销）车载手机支架双面吸盘式家居懒人多功能通用可弯曲创意手机支架', '', '1.00', '/upload/goods_img/手机数码/5db3b87345fc4.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('245', '麦尚科技专营店', '手机支架懒人支架卡通创意平板电脑桌面支撑座【款式随机】', '', '9.90', '/upload/goods_img/手机数码/5db3b8734f81e.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('246', '邮乐韵菲专营店', '无线蓝牙耳机迷你超小苹果安卓通用耳机', '送两条充电线+一个收纳盒', '15.90', '/upload/goods_img/手机数码/5db3b873b60d7.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('247', '万品好易购商城', 'XO NB23 八角宝石锌合金数据线', '产品颜色：黑色  白色 宝石外观 不拘一格;  锌合金 更出色；  2.4A极速充电，高效传输文件', '49.00', '/upload/goods_img/手机数码/5db3b873bf931.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('248', '万品好易购商城', 'XO F1 户外Mini蓝牙音箱 经典挂扣 防水 防尘/防摔 抗干扰性强 无线链接 免提通话', '音量调节/音乐播放、暂停/上下曲切换 语音报号/来电铃声/数据输出/直读SD卡', '99.00', '/upload/goods_img/手机数码/5db3b873d7806.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('249', '万品好易购商城', 'XO  PB39 移动电源 8000mAh', '8000mAh大容量 双输出带LED灯  ； 电源保护, 好用更安全； 智能分流 高效输出', '119.00', '/upload/goods_img/手机数码/5db3b8740878f.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('250', '万品好易购商城', 'XO BS8 运动蓝牙耳机源于经典 加以升级 鲨鱼鳍耳翼 舒适牢固', '源于经典 加以升级； 鲨鱼鳍耳翼 舒适牢固 ； 无惧雨水  防水防汗； 蓝牙4.2版本，深度降噪', '169.00', '/upload/goods_img/手机数码/5db3b87419133.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('251', '万品好易购商城', 'XO BS7 运动蓝牙耳机 深度降噪 通话更清晰 轻松操控 随意切换', '强劲的CSR芯片 提升续航能力； 蓝牙4.1版本，深度降噪，通话更清晰； 霍尔磁控开关，智能感应', '199.00', '/upload/goods_img/手机数码/5db3b8742586e.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('252', '万品好易购商城', 'XO A8 蓝牙音箱 智能触控 自由切换 大容量电池 可连续播放约4-6小时 土豪金 星空银 银色', '智能触控，自由切换； 内置1000毫安聚合物电池，全频高清喇叭+低音振膜,可连续播放约4-6小时', '169.00', '/upload/goods_img/手机数码/5db3b874390f2.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('253', '普润家居专营店', 'oppo蓝牙耳机迷你vivo超小隐形运动通用华为无线耳塞超长待机开车', '', '79.00', '/upload/goods_img/手机数码/5db3b874496ae.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('254', '木易生活专柜', '2米超长  美能格  苹果安卓Type-C数据线 2.4A快充电线', '2米超长  美能格  苹果安卓Type-C数据线 2.4A快充电线', '12.90', '/upload/goods_img/手机数码/5db3b874588e2.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('255', '木易生活专柜', '沃晟伦蓝牙耳机M165蓝牙耳机入耳式商务车载便携式4.1*', '沃晟伦蓝牙耳机M165蓝牙耳机入耳式商务车载便携式4.1', '15.90', '/upload/goods_img/手机数码/5db3b8746c166.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('256', '北京信酷数码商城专柜', 'iPhone 苹果原装充电器套装/数据线+充电头电源适配器 通用型', '【全国包邮】 充电套装更优惠', '69.00', '/upload/goods_img/手机数码/5db3b874784b9.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('257', '小牛数码家居专柜', '飞利浦/PHILIPS 多功能可伸缩车载手机支架DLK35002', '多功能可伸缩车载手机支架', '68.00', '/upload/goods_img/手机数码/5db3b87484bf4.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('258', '北京信酷数码商城专柜', '苹果 iphone X /XS MAX/XS/XR/钢化膜 全屏全覆盖 手机贴膜', '', '19.00', '/upload/goods_img/手机数码/5db3b87493e28.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('259', '邮乐萍乡馆', '南孚(NANFU)3V纽扣电池两粒 CR2032/CR2025/CR2016锂电池电子汽车钥匙遥控', '奔驰c200l福特 新蒙迪欧 高尔夫7 新马自达昂克赛拉阿特兹 手表奔驰大众汽车钥匙电池', '9.90', '/upload/goods_img/手机数码/5db3b874a670c.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('260', '信酷小米专营店', '小米（MI） 车载充电器快充版 QC3.0 双口输出 智能温度控制 兼容iOS和Android设备', '小米正品 全国包邮', '89.00', '/upload/goods_img/手机数码/5db3b874b8050.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('261', '北京信酷数码商城专柜', '苹果 iPhone6/6S/6Plus/6SPlus/iPhone7/7P防爆钢化玻璃膜高清手机贴膜', '进口AGC玻璃板！超薄钢化玻璃膜！秒杀国产玻璃！', '26.00', '/upload/goods_img/手机数码/5db3b874c207b.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('262', '北京信酷数码商城专柜', 'OPPO手机原装耳机R11/PLUS入耳式线控r11s/r15耳机 白色盒装', '', '38.80', '/upload/goods_img/手机数码/5db3b874d31ef.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('263', '北京信酷数码商城专柜', '华为（HUAWEI）小天鹅无线蓝牙免提通话音箱4.0 便携户外/车载迷你音响AM08', '音·触即发！360°音效技术，音质真实自然，简洁触控操作，支持蓝牙免提通话。', '95.00', '/upload/goods_img/手机数码/5db3b874e280a.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('264', '北京信酷数码商城专柜', '三星 32G内存卡(CLASS10 48MB/s)  手机内存卡32g MicroSD存储卡', '正品行货 支持专柜验货 实行三包政策 轻放心购买', '95.00', '/upload/goods_img/手机数码/5db3b874edfa5.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('265', '北京信酷数码商城专柜', '华为/HUAWEI 华为快速充电套装 4.5V/5A充电头+type-c线  华为充电器', '支持p20/mate10/9pro/p10plus荣耀10/v10/note10等机型', '98.00', '/upload/goods_img/手机数码/5db3b87504947.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('266', '北京信酷数码商城专柜', '小米（MI）小米手环2（黑色）智能运动 防水 心率监测 计步器 久坐提醒', '正品行货 全国包邮', '159.00', '/upload/goods_img/手机数码/5db3b875133ab.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('267', '信酷小米专营店', '小米活塞耳机 清新版 黑色 蓝色 入耳式手机耳机 通用耳麦', '小米正品 全国包邮', '45.00', '/upload/goods_img/手机数码/5db3b8751ef2e.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('268', '信酷小米专营店', '小米支架式自拍杆 灰色 黑色 蓝牙遥控迷你便携带三脚架多功能', '小米正品 全国包邮', '105.00', '/upload/goods_img/手机数码/5db3b875327b2.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('269', '信酷小米专营店', '小米（MI）方盒子蓝牙音箱2 无线迷你随身户外便携客厅家用小音响', '小米正品 全国包邮', '149.00', '/upload/goods_img/手机数码/5db3b87546807.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('270', '信酷小米专营店', '小米（MI）小米运动蓝牙耳机mini 黑色白色 无线蓝牙入耳式运动耳机', '小米正品 全国包邮', '169.00', '/upload/goods_img/手机数码/5db3b8755a85b.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('271', '信酷小米专营店', '小米（MI）小钢炮2代 无线蓝牙便携音箱', '小米正品 全国包邮', '139.00', '/upload/goods_img/手机数码/5db3b87564c6e.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('272', '铁好家居美妆日用百货专营店', '公牛BULL 独立3孔位2USB创意魔方插座 1.5米线GN-UUB122【热卖推荐】', '立体集成结构 小巧轻便 五重保护', '67.00', '/upload/goods_img/手机数码/5db3b87575612.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('273', '九洲科瑞数码专营店', '华为 HUAWEI 畅享9 Plus 4GB+128GB', '', '1.00', '/upload/goods_img/手机数码/5db3b8758639e.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('274', '九洲科瑞数码专营店', '华为HUAWEI nova4 4800万超广角三摄8GB+128GB', '', '2.00', '/upload/goods_img/手机数码/5db3b875932a9.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('275', '九洲科瑞数码专营店', '华为 HUAWEI P30 Pro 徕卡四摄10倍混合变焦麒麟980芯片屏内指纹 8GB+128G', '', '4.00', '/upload/goods_img/手机数码/5db3b8759d6bb.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('276', '邮乐萍乡馆', '南孚 安卓数据线 NF-LM001 小米华为OPPO三星vivo充电器通用', '', '9.90', '/upload/goods_img/手机数码/5db3b875a923e.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('277', '铁好家电数码专营店', '公牛BULL 二合一苹果lighting+micro USB数据线GN-J81N【热卖推荐】', 'MFi官方认证，快速充电，抗折断', '69.00', '/upload/goods_img/手机数码/5db3b875b2e80.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('278', '邮乐萍乡馆', '南孚(NANFU)LR6AA聚能环 5号+7号碱性干电池【共4粒装】', '', '9.90', '/upload/goods_img/手机数码/5db3b875be233.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('279', '岳灵生活专营店', '南孚手机充电宝 10000毫安大容量礼盒装NFCT10', '', '169.00', '/upload/goods_img/手机数码/5db3b875cad56.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('280', '邮乐萍乡馆', '南孚(NANFU)LR03AAA聚能环7号电池碱性干电池12粒装儿童玩具遥控器赛车闹钟智能门锁电池', 'AAA干电池持久电力家用', '27.80', '/upload/goods_img/手机数码/5db3b875d3610.jpg', '1572059524', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('281', '中国农垦官方旗舰店', '买2份送一份【中国农垦】黑龙江北大荒  支豆浆粉早餐豆浆粉 非转基因大豆 五谷豆浆粉28g*10袋', '早餐豆粉买2份送一份', '18.00', '/upload/goods_img/特色美食/5db3b8d338ebc.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('282', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒支装豆浆粉（醇豆浆、红枣味可选） 非转基因大豆', '早餐豆粉买2份送一份', '15.00', '/upload/goods_img/特色美食/5db3b8d3432ce.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('283', '牛牛食品专营店', '(8月新货)蒙牛小真果粒125ml*20盒草莓味果粒酸奶小胖丁迷你装', '8月份的新货,超好喝，儿童，果粒，健康营养，', '22.70', '/upload/goods_img/特色美食/5db3b8d34deb1.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('284', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒 支装豆浆粉 麦香甜豆浆粉 28g*10袋', '早餐豆粉买2份送一份', '15.00', '/upload/goods_img/特色美食/5db3b8d3651ce.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('285', '禾煜食品旗舰店', '禾煜 黄冰糖418g包  冰糖土冰糖  煲汤食材', '黄冰糖买2送1', '15.00', '/upload/goods_img/特色美食/5db3b8d66e304.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('286', '新农哥旗舰店', '【新农哥】板栗仁108gx4袋  休闲零食小吃', '', '26.90', '/upload/goods_img/特色美食/5db3b8d6832f9.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('287', '新农哥旗舰店', '新农哥 每日坚果 混合果仁 缤纷坚果仁175g*2盒  休闲零食', '缤纷美味 一吃钟情', '59.90', '/upload/goods_img/特色美食/5db3b8d68e2c4.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('288', '众天蜂蜜邮乐农品旗舰店', '众天山花蜂蜜500g', '秦岭深处 百花酿造而成 最受欢迎的蜂蜜 性价比极高！', '19.90', '/upload/goods_img/特色美食/5db3b8d6a2ed1.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('289', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒 非转基因大豆 豆浆粉 红枣豆浆粉28g*10袋', '早餐豆粉买2份送一份', '18.00', '/upload/goods_img/特色美食/5db3b8d6ae283.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('290', '考拉小哥专营店', '薛小贱 每日坚果25g*1包', '厂家直供、7种混合、日期新鲜', '1.66', '/upload/goods_img/特色美食/5db3b8d6b8e66.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('291', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂五宝茶 益本茶 男人茶养生茶 草本', '【萃涣堂】五宝益本茶 男人茶买2送1五宝茶男人茶枸杞茶玛咖片黄精男肾茶老公八宝茶养生茶 做性福的男人', '19.00', '/upload/goods_img/特色美食/5db3b8d6c8481.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('292', '萃涣堂蒲公英茶专柜', '【滨州馆】寻味山东新鲜现做手工 滨州黑芝麻红枣饼核桃 枸杞传统工艺 香甜可口 10g独立装包邮', '寻味山东 新鲜现做手工滨州黑芝麻红枣饼核桃 枸杞传统工艺 香甜可口 10g独立装包邮', '1.00', '/upload/goods_img/特色美食/5db3b8d6cc302.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('293', '正江食品专营店', '寿全斋  红枣姜茶 姜茶 12g*10条', '', '25.00', '/upload/goods_img/特色美食/5db3b8d6debe7.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('294', '阿坝州理县地方扶贫馆', '四川浓香菜籽油 5升农家非转基因5l纯菜子粮油食用油约10斤植物油', '2019新油，滴滴香浓，四川非转基因纯菜籽油', '66.00', '/upload/goods_img/特色美食/5db3b8d6f246b.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('295', '千岛湖品牌农产品馆', '千岛湖 千岛渔娘 糍粑（4味）200g', '买二赠一 糍粑', '15.00', '/upload/goods_img/特色美食/5db3b8d706ecd.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('296', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂 金菊饮 菊花枸杞茶 菊花茶叶贡菊散装杭枸杞菊花茶非解毒去火清热凉茶', '【滨州馆】萃涣堂 金菊饮 菊花枸杞茶 菊花茶叶贡菊散装杭枸杞菊花茶非解毒去火清热凉茶', '0.50', '/upload/goods_img/特色美食/5db3b8d713dd8.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('297', '果蔻食品专营店', '果蔻 每日坚果B款20g/包简装无礼盒成人儿童孕妇混合果仁坚果零食大礼包', '科学配比  营养美味', '1.39', '/upload/goods_img/特色美食/5db3b8d729985.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('298', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂 黑苦荞茶 5克/袋 苦荞茶正品 大凉山', '【滨州馆】萃涣堂 黑苦荞茶 5克/袋 苦荞茶正品 大凉山', '0.50', '/upload/goods_img/特色美食/5db3b8d736890.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('299', '佳林院红枣旗舰店', '【0.4元/袋佳林院泡茶煮粥煲汤枣圈】山东特产乐陵红枣每袋约12克袋装50袋起拍包邮部分偏远地区除外', '佳林院品牌装，泡茶煮粥枣圈，拼团价0.4元/袋，每袋约12克装，50袋起拍，食用方便，经济实惠！', '0.40', '/upload/goods_img/特色美食/5db3b8d798327.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('300', '果蔻食品专营店', '果蔻 每日坚果25g*1包成人儿童孕妇混合坚果混合果仁小吃零食', '', '1.65', '/upload/goods_img/特色美食/5db3b8d7aa43b.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('301', '萃涣堂蒲公英茶专柜', '【滨州馆】红枣黑糖姜茶大姨妈水姜糖女老姜块生姜姜汁姜汤红糖姜枣茶小袋装25克/袋', '姜味浓,红枣多,顺畅暖暖,效果杠杠“冬吃萝卜夏吃姜。”传统组方真材实料。', '0.90', '/upload/goods_img/特色美食/5db3b8dab8392.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('302', '南阳专区专营店', '南阳西峡现摘金桃黄心猕猴桃15枚 （单枚60g-90g）买一送一 共30枚，合并发一箱', '买一赠一活动', '19.90', '/upload/goods_img/特色美食/5db3b8dac3745.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('303', '果然好口福专柜', '宁 福吉 5斤起拍新疆原味生核桃新货 特产薄皮核桃 坚果炒货休闲零食包邮', '新疆薄皮核桃  送夹子', '9.90', '/upload/goods_img/特色美食/5db3b8daea466.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('304', '刘陶生鲜旗舰店', '刘陶 福建红肉柚子红心蜜柚8.5-9.5斤（3-4个装） 新鲜水果2', '', '25.50', '/upload/goods_img/特色美食/5db3b8db3a40e.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('305', '丹东邮政农特产品专营店', '2019年丹东新鲜板栗4斤东北农家生板栗毛栗子现摘栗子应季水果干', '', '19.90', '/upload/goods_img/特色美食/5db3b8db3a7f6.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('306', '果然好口福专柜', '宁福吉 新疆和田大枣煲粥枣500克包邮', '', '6.60', '/upload/goods_img/特色美食/5db3b8db578d5.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('307', '小呆妞旗舰店', '预售小呆妞四川蒲江金艳黄心猕猴桃90-110g中果24枚 72内小时发货', '关于售后：签收24小时内后台申请退款请提供坏果和快递单合照，会根据实际损坏赔付', '27.90', '/upload/goods_img/特色美食/5db3b8db63c28.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('308', '萃涣堂蒲公英茶专柜', '萃涣堂茉莉绿茶三角茶包袋茉莉花茶小袋装绿茶袋泡冷泡茶包伴手礼花茶茶包组合玫瑰茉莉绿茶袋泡三', '萃涣堂茉莉绿茶三角茶包袋茉莉花茶小袋装绿茶袋泡冷泡茶包', '0.90', '/upload/goods_img/特色美食/5db3b8db71303.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('309', '丹东邮政农特产品专营店', '新鲜现挖番薯红黄心密署农家自种蒸煮粉糯香甜沙地地瓜烤烟署5斤', '', '16.80', '/upload/goods_img/特色美食/5db3b8db862f8.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('310', '川锅壹号旗舰店', '川锅壹号辣白菜228g韩国泡菜下饭菜正宗朝鲜口味拌饭菜版面菜', '酸辣可口 老少皆宜', '5.90', '/upload/goods_img/特色美食/5db3b8dbcdf79.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('311', '福香御旗舰店', '福香御 慢生长2018东北大米雪花米10斤真空包邮色选米', '初霜收割，180天慢生长周期，30天鲜磨直达，大米胚乳含量极为丰富，口感软糯香甜。', '27.90', '/upload/goods_img/特色美食/5db3b8dbdb26c.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('312', '兰州鲜合苑百合特产店专营店', '现包现发100%新鲜正宗兰州市七里河区产兰州鲜百合3年生兰州百合农家甜百合，约16颗百合一斤', '兰州鲜百合，无任何添加剂，宝宝也可以放心食用', '19.90', '/upload/goods_img/特色美食/5db3b8dbe8d2f.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('313', '当季鲜果', '黄金奇异果12枚包邮（中果70-90克，拍2件多送6枚，合并发30枚）金艳黄心猕猴桃新鲜水果', '快递随机，不能指定快递，下单后72小时内发货，下雨天顺延，购买前请阅读售后要求，介意慎拍', '9.90', '/upload/goods_img/特色美食/5db3b8dc0be0c.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('314', '丹东邮政农特产品专营店', '东北特产老品种大米  凤城蓝乡生态米 10斤 珍珠米 非蟹田', '东北特产老品种大米  凤城蓝乡生态米 10斤 珍珠米 非蟹田', '28.80', '/upload/goods_img/特色美食/5db3b8dc17d77.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('315', '川锅壹号旗舰店', '川锅壹号蟹黄酱拌饭酱秃黄油拌面酱蟹粉酱蟹黄膏酱料即食螃蟹酱', '金脂香软 经典美味', '9.90', '/upload/goods_img/特色美食/5db3b8dc2c59c.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('316', '刘陶生鲜旗舰店', '刘陶 云南昭通丑苹果5斤大果（13-15个）新鲜水果', '拼团的亲想更加快的发货，尽量和已经开团的亲拼团购买', '27.00', '/upload/goods_img/特色美食/5db3b8dc365c6.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('317', '福香御旗舰店', '福香御 大米5kg装2018新米圆粒珍珠米寿司香米秋田小町农家东北大米包邮', '', '29.99', '/upload/goods_img/特色美食/5db3b8de5a091.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('318', '刘陶生鲜旗舰店', '刘陶 云南石林人生果圆果净果5斤（25-35个）大果新鲜水果2', '拼团的亲想更加快的发货，尽量和已经开团的亲拼团购买', '25.00', '/upload/goods_img/特色美食/5db3b8de6ec9e.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('319', '刘陶生鲜旗舰店', '刘陶 福建红肉柚子红心蜜柚8.5-9.5斤（3-4个装） 新鲜水果特卖', '', '25.50', '/upload/goods_img/特色美食/5db3b8de7ac09.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('320', '萃涣堂蒲公英茶专柜', '【萃涣堂】 蜜桃乌龙茶  水果茶 三角包共蜜桃白桃乌龙茶袋泡花茶包花', '新品上市!独立三角袋泡茶,携带冲泡更便捷!【萃涣堂】 蜜桃乌龙茶 水果茶 三角包', '0.90', '/upload/goods_img/特色美食/5db3b8de97517.jpg', '1572059535', '0', '2');
INSERT INTO `xy_goods_list` VALUES ('321', '信酷小米专营店', '小米/MIUI 小米电视4S 43英寸人工智能语音网络平板电视 1GB+8GB HDR 4K超高清', '金属机身', '1.00', '/upload/goods_img/大家电/5db3b89a8d174.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('322', '邮乐安阳馆', '【汤阴县积分用户专享】洗衣机XpB—126-9896S', '', '1.00', '/upload/goods_img/大家电/5db3b89a9f288.jpg', '1578206762', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('323', '海信电器旗舰店', '海信（Hisense）HZ39E35A 39英寸高清手机交互 轻薄金属 WIFI人工智能液晶电视机', '', '1.00', '/upload/goods_img/大家电/5db3b89ab61bd.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('324', '邮滋味如皋馆专柜', '创维9公斤变频滚筒洗衣机  型号：F9015NC-炫金   如皋免费送货上门，南通包邮，华东地区配货', '创维洗衣机，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89b52437.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('325', '邮滋味如皋馆专柜', '创维2P定频立式柜机，型号：KFR-50LW/F2DA1A-3（限如皋地区免费送货上门安装）', '创维定频空调，免费上门安装，绝对优惠，每月更有现场特惠活动', '4.00', '/upload/goods_img/大家电/5db3b89b6e95e.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('326', '创维电视官方旗舰店', '创维/SKYWORTH 58H8M 58英寸4K超高清全面屏防蓝光人工智能语音HDR超薄网络液晶电视', '4K超高清，声像自然，一场声觉革新，视觉体验，光学防蓝光，护眼不偏色', '3.00', '/upload/goods_img/大家电/5db3b89b79d10.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('327', '邮乐洛阳', '【洛阳金融积分兑换】TCL 205升 三门电冰箱 （星空银） BC（邮政网点配送）', '', '1.00', '/upload/goods_img/大家电/5db3b89bc11c1.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('328', '邮滋味如皋馆专柜', '创维9公斤全自动波轮洗衣机，型号XQB90-52BAS淡雅银如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，夏季特惠；每月现场有特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89bcfc24.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('329', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】家用洗衣机，图片仅供参考', '', '1.00', '/upload/goods_img/大家电/5db3b89be0d98.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('330', '邮乐安阳馆', '【滑县积分用户专享】创维电器洗衣机9公斤波轮安阳', '', '1.00', '/upload/goods_img/大家电/5db3b89bee474.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('331', '邮乐安阳馆', '美菱3开门冰箱BCD-209M3CX【汤阴县积分兑换专用，其他下单不发货】', '', '1.00', '/upload/goods_img/大家电/5db3b89c06586.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('332', '邮乐安阳馆', '美菱电冰箱209L3CS【安阳县积分兑换用户专用，其他地区发】', '', '1.00', '/upload/goods_img/大家电/5db3b89c16f2a.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('333', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】自动洗衣机 家用洗衣机，图片仅供参考', '', '2.00', '/upload/goods_img/大家电/5db3b89c22e95.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('334', '邮乐安阳馆', '【滑县积分用户专享】创维电器电视50寸4K智能安阳', '', '3.00', '/upload/goods_img/大家电/5db3b89c2bb37.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('335', '邮乐安阳馆', '【安阳县积分用户专享】长虹液晶电视55U1', '', '3.00', '/upload/goods_img/大家电/5db3b89f48109.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('336', '海信电器旗舰店', '海信（Hisense）HZ32E30D 32英寸蓝光高清平板液晶电视机 酒店宾馆卧室推荐', '【海信今日限时特惠-到手价788元！】限量200台！抢完即止！', '749.00', '/upload/goods_img/大家电/5db3b89f51194.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('337', '邮滋味如皋馆专柜', '邮乐特卖：庭美家用消毒柜    型号：YTP-280    如皋免费送货上门，南通包邮，华东地区配送', '庭美消毒柜，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '755.00', '/upload/goods_img/大家电/5db3b89f5ec57.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('338', '吉舜诚商城专柜', '飞利浦（PHILIPS）  19英寸液晶电视机 显示器两用 hdmi高清接口', '19PFF2650', '799.00', '/upload/goods_img/大家电/5db3b89fb14ba.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('339', '创维集团官方旗舰店', '创维/SKYWORTH 32X3 32英寸窄边非智能老人机蓝光高清节能LED平板液晶电视机工程机', '蓝光高清，经典窄边，节能液晶，简单好用，谁用谁知道，实用耐用款', '799.00', '/upload/goods_img/大家电/5db3b89fc8fa8.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('340', '吉舜诚商城专柜', '飞利浦（PHILIPS）22英寸LED高清液晶平板电视机含底座 黑色', '22PFF2650/T3', '899.00', '/upload/goods_img/大家电/5db3b89fd917b.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('341', '创维集团官方旗舰店', '创维/SKYWORTH 32X6 32英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠，高清智能电视，WIFI，酷开系统，10核处理器', '899.00', '/upload/goods_img/大家电/5db3b89fe6086.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('342', '海信电器旗舰店', '海信 (Hisense) HZ32E35A 32英寸AI智能WIFI 轻薄金属 卧室神器高清电视机', '', '899.00', '/upload/goods_img/大家电/5db3b8a0004c2.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('343', '邮滋味如皋馆专柜', '创维邮乐特卖： 32寸液晶电视机，型号：32E381S   如皋免费送货上门，南通包邮，华东地区配货', '创维液晶电视大品牌，夏季特惠；每月现场有特惠活动', '899.00', '/upload/goods_img/大家电/5db3b8a01be30.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('344', '琥麟电器专柜', '海信 XQB60-H3568 6公斤全自动波轮洗衣机', '', '749.00', '/upload/goods_img/大家电/5db3b8a0279b3.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('345', '邮滋味如皋馆专柜', '创维7公斤全自动波轮洗衣机，型号：XQB70-21C淡雅银，如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '928.00', '/upload/goods_img/大家电/5db3b8a0367fe.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('346', '邮滋味如皋馆专柜', '创维单冷冰柜，型号：BD/C-160雅白，如皋地区免费送货上门安装，南通地区包邮，华东地区配货', '创维冰柜，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '999.00', '/upload/goods_img/大家电/5db3b8a042f39.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('347', '创维集团官方旗舰店', '创维（SKYWORTH）32H5 32英寸高清HDR 护眼全面屏 AI人工智能语音 网络WIFI 卧', '高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '999.00', '/upload/goods_img/大家电/5db3b8a0511cd.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('348', '邮滋味如皋馆专柜', '创维/SKYWORTH热水器，型号：DSZF-D5501-80，如皋免费送货上门，南通包邮 创维/', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '999.00', '/upload/goods_img/大家电/5db3b8a07389d.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('349', '琥麟电器专柜', 'Hisense/海信 HB80DA332G8KG公斤大容量家用全自动节能波轮洗衣机', '', '899.00', '/upload/goods_img/大家电/5db3b8a386615.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('350', '琥麟电器专柜', '海信 BCD-163N/B 冰柜冷藏冷冻双温家用商用小型卧式', '', '999.00', '/upload/goods_img/大家电/5db3b8a390a27.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('351', '吉舜诚商城专柜', '东芝（TOSHIBA）  32英寸 蓝光液晶电视 高清平板电视机 东芝电视机', '32L1500C', '1.00', '/upload/goods_img/大家电/5db3b8a69aafd.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('352', '创维集团官方旗舰店', '创维/SKYWORTH 40X6 40英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠！高清智能，10核处理器，可以WIFI上网', '1.00', '/upload/goods_img/大家电/5db3b8a9a6b14.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('353', '甲子商城旗舰店', '康佳/KONKA  LED39E330C 39英寸卧室电视高清蓝光节能平板液晶电视', '', '949.00', '/upload/goods_img/大家电/5db3b8a9b22ae.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('354', '邮乐赣州馆', '【不支持邮乐卡支付】创维-彩电-40E1C 40英寸全高清HDR 护眼全面屏 AI人工智能语音', '', '1.00', '/upload/goods_img/大家电/5db3b8a9cf38d.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('355', '琥麟电器专柜', '海信 BCD-177F/Q 177升 双门冰箱', '', '1.00', '/upload/goods_img/大家电/5db3b8a9f0abd.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('356', '创维集团官方旗舰店', '创维/SKYWORTH 43X6 43英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '【买电视选创维】高清智能，10核处理器，质量上乘，价格厚道，可以Wifi上网', '1.00', '/upload/goods_img/大家电/5db3b8aa1b4b4.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('357', '创维集团官方旗舰店', '创维（SKYWORTH）40H5 40英寸全高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '全高清HDR 护眼全面屏 AI人工智能语音', '1.00', '/upload/goods_img/大家电/5db3b8aa26c4f.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('358', '邮乐安阳馆', '市区积分用户专享】创维平板电视32X6', '', '1.00', '/upload/goods_img/大家电/5db3b8aa31c19.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('359', '吉舜诚商城专柜', '飞利浦（PHILIPS）32英寸新品高清LED电视 接口丰富窄边高清LED液晶平板电视机', '32PHF3282/T3', '1.00', '/upload/goods_img/大家电/5db3b8aa3b85c.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('360', '琥麟电器专柜', '海信 BD/BC-308NU/A 冰柜家用 顶开式卧式商用冷藏冷冻柜', '', '1.00', '/upload/goods_img/大家电/5db3b8aa4931f.jpg', '1572059510', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('361', '明凰服饰专营店', '男女冲锋衣工装棉服外套修身加厚款', '邮乐支持微信，支付宝，网银，邮储卡和银联卡支付。（不同商品请分开下单）', '85.00', '/upload/goods_img/户外服饰/5db3b8b22c022.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('362', '户外途量工厂专卖店', '春夏季运动风衣钓鱼防晒衣男女超薄透气皮肤衣防风外套户外速干潮流衣服情侣款皮肤衣', '大码骑行长袖', '29.90', '/upload/goods_img/户外服饰/5db3b8b23604c.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('363', '探路者正江专卖店', '探路者/TOREAD 冲锋裤 运动裤 秋冬户外软壳裤男透气防风保暖徒步裤KAMG91159', '', '428.00', '/upload/goods_img/户外服饰/5db3b8b25312b.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('364', '探路者正江专卖店', '探路者运动服 探路者冲锋衣 19秋冬户外女式防水透湿套绒冲锋衣TAWH92285', '', '839.00', '/upload/goods_img/户外服饰/5db3b8b25d925.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('365', '好看哒专营店', '防晒衣女中长款薄款防晒服', 'FSY-6387', '45.00', '/upload/goods_img/户外服饰/5db3b8b56628b.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('366', '宝仕母婴专营店专柜', 'L户外皮肤衣防紫外线防晒衣男女夏季超薄透气防晒服运动风衣', '', '75.00', '/upload/goods_img/户外服饰/5db3b8b573966.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('367', '好看哒专营店', '防晒衣女夏季新款韩版连帽系带长袖防晒衣糖果色沙滩户外披肩防晒衣', 'FSY-54', '19.90', '/upload/goods_img/户外服饰/5db3b8b88f380.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('368', '户外途量工厂专卖店', '户外速干T恤男 女休闲跑步运动健身短袖大码情侣快干衣排汗透气', '', '22.80', '/upload/goods_img/户外服饰/5db3b8b8abc8f.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('369', '好看哒专营店', '防晒衣 户外薄款防紫外线印花防晒衣', 'FSY-1736', '25.00', '/upload/goods_img/户外服饰/5db3b8b8c0c84.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('370', '好看哒专营店', '防晒衣夏季女蝙蝠袖连帽拉链短款防晒衣', 'FSY-5423', '35.00', '/upload/goods_img/户外服饰/5db3b8b9b16a1.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('371', '好看哒专营店', '防晒衣男士薄款纯色连帽防晒衣', 'FSY-4167', '35.00', '/upload/goods_img/户外服饰/5db3b8b9bbe9c.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('372', '户外途量工厂专卖店', '城徒 户外春夏单层冲锋衣女防晒衣男轻薄防风钓鱼服透气速干外套长袖衫', '', '35.80', '/upload/goods_img/户外服饰/5db3b8ba1b847.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('373', '好看哒专营店', '防晒衣韩版短款薄款连帽长袖防晒衣', 'FSY-5439', '36.00', '/upload/goods_img/户外服饰/5db3b8ba72314.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('374', '好看哒专营店', '防晒衣女中长款涂鸦薄款防晒衣', 'FSY-5282', '36.00', '/upload/goods_img/户外服饰/5db3b8ba99fd5.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('375', '好看哒专营店', '防晒衣女中长款薄款防晒衣', 'FSY-5456', '37.90', '/upload/goods_img/户外服饰/5db3b8baa8e20.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('376', '户外途量工厂专卖店', '秋冬户外男抓绒衣摇粒绒女外套保暖冲锋衣内胆开衫卫衣', '', '39.00', '/upload/goods_img/户外服饰/5db3b8bab267b.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('377', '户外途量工厂专卖店', '户外秋冬季加绒加厚抓绒衣男女摇粒绒保暖抓绒外套开衫冲锋衣内胆', '', '49.00', '/upload/goods_img/户外服饰/5db3b8bae0cb5.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('378', '江门新会馆', '【江门新会馆】caxa断码 两截速干裤女 韩版修身透气徒步快干裤野外登山跑步长裤', '', '50.00', '/upload/goods_img/户外服饰/5db3b8baf06b9.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('379', '宝仕母婴专营店专柜', 'L夏季休闲短裤男宽松5分中裤子男士运动五分裤大码跑步速干沙滩裤', '', '55.00', '/upload/goods_img/户外服饰/5db3b8bb2ba54.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('380', '江门新会馆', '【江门新会馆】caxa修身户外健身速干裤女 快干弹力透气登山大码长裤 弹力户外裤', '', '60.00', '/upload/goods_img/户外服饰/5db3b8bb513ed.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('381', '探路者正江专卖店', '探路者/TOREADt恤女户外夏季快干速干透气运动服TAJG82984', '', '61.00', '/upload/goods_img/户外服饰/5db3b8bb5ac47.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('382', '铁好家居美妆日用百货专营店', '佳钓尼 夏遮阳防晒帽套头面罩透气防紫外线渔夫帽', '', '48.00', '/upload/goods_img/户外服饰/5db3b8bb8e0a3.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('383', '宝仕母婴专营店专柜', '防晒衣男女情侣春夏季防雨风衣超薄透气速干钓鱼防晒服户外皮肤衣MN', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bb9f9e7.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('384', '户外途量工厂专卖店', '城徒 春夏季速干裤男女大码轻薄快干透气户外修身显瘦弹力冲锋裤', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbb3e24.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('385', '宝仕母婴专营店专柜', 'L运动户外夏季速干t恤 男女短袖速干衣快干t恤 吸汗透气', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbe33ff.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('386', '宝仕母婴专营店专柜', 'L健身房教练速干T恤男女 圆领情侣夏季短袖汗衫', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bc1bca2.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('387', '户外途量工厂专卖店', '城徒 冬季正品户外冲锋裤男女抓绒裤保暖防风防水加厚软壳裤登山裤长裤', '', '75.00', '/upload/goods_img/户外服饰/5db3b8bc42dab.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('388', '江门新会馆', '【江门新会馆】caxa修身弹力女款休闲棉裤 户外休闲快干长裤 女士跑步登山健身裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bc96997.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('389', '江门新会馆', '【江门新会馆】caxa休闲修身速干裤 透气轻薄运动裤耐磨健身户外裤多袋裤七分裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bcac92c.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('390', '探路者正江专卖店', '探路者/TOREAD 运动服 短袖户外女运动跑步排汗透气圆领速干T恤TAJF82784', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bcc53b9.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('391', '户外途量工厂专卖店', '冲锋裤男户外秋冬防风防水软壳裤女加绒加厚抓绒裤保暖徒步登山裤', '', '79.00', '/upload/goods_img/户外服饰/5db3b8bd362c1.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('392', '探路者正江专卖店', '探路者/TOREADT恤女 夏户外女式超轻透气速干衣圆领T恤短袖KAJG82352', '', '99.00', '/upload/goods_img/户外服饰/5db3b8bd44554.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('393', '探路者正江专卖店', '探路者/TOREAD 短袖 18春夏新款户外女式圆领速干透气印花短袖T恤TAJG82939', '', '99.00', '/upload/goods_img/户外服饰/5db3b8bd602ab.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('394', '探路者正江专卖店', '探路者/TOREAD夏新款户外运动透气弹力速干女式半袖短袖T恤KAJG82310', '', '99.00', '/upload/goods_img/户外服饰/5db3b8be68f86.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('395', '探路者正江专卖店', '探路者/TOREAD T恤女款 秋季户外短袖女时尚速干透气短袖T恤TAJG82938', '', '99.00', '/upload/goods_img/户外服饰/5db3b8be96a09.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('396', '洋湖轩榭官方旗舰店', '洋湖轩榭 春秋季新款中老年男装连帽冲锋衣爸爸装休闲夹克衫外套男A', '钜惠双十一 感恩惠顾', '126.42', '/upload/goods_img/户外服饰/5db3b8bea6025.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('397', '南城百货专营店', '秋冬季加绒加厚冲锋衣男女三合一可拆卸两件套防水户外情侣登山服', '秋冬季加绒加厚冲锋衣男女三合一可拆卸两件套防水户外情侣登山服', '158.00', '/upload/goods_img/户外服饰/5db3b8bede68a.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('398', '正江服饰专营店', '包邮韵格NT1021男士紧身训练PRO运动健身跑步长袖弹力速干服纯色衣服', '', '59.00', '/upload/goods_img/户外服饰/5db3b8beeb97d.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('399', '流行饰品运动户外器械', '汤河店 户外冲锋裤男女可脱卸秋冬季加绒加厚保暖软壳防风防水登山滑雪裤', '', '179.00', '/upload/goods_img/户外服饰/5db3b8bf07cf9.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('400', '流行饰品运动户外器械', '汤河店 韩国正品vvc防晒衣女经典薄夏季中长款防晒服户外防紫外线皮肤衣', '', '499.00', '/upload/goods_img/户外服饰/5db3b8bf2bf21.jpg', '1572059516', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('401', '乐颐汇数码专营店', '荣耀10青春版 幻彩渐变 2400万AI自拍 全网通版4GB+64GB', '2400万AI高清自拍，麒麟710处理器，炫光渐变色', '989.00', '/upload/goods_img/手机数码/5db3b8700e46c.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('402', '乐颐汇数码专营店', '华为/HUAWEI 畅享9 手机 全网通 4GB+128GB', '6.26英寸珍珠屏 4000mAh大电池', '1099.00', '/upload/goods_img/手机数码/5db3b8731cf7b.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('403', '米果商贸专柜', '折叠式平板电脑支架底座懒人手机支架【颜色随机发货】', '', '9.90', '/upload/goods_img/手机数码/5db3b87337179.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('404', '邮乐韵菲专营店', '（亏本促销）车载手机支架双面吸盘式家居懒人多功能通用可弯曲创意手机支架', '', '1.00', '/upload/goods_img/手机数码/5db3b87345fc4.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('405', '麦尚科技专营店', '手机支架懒人支架卡通创意平板电脑桌面支撑座【款式随机】', '', '9.90', '/upload/goods_img/手机数码/5db3b8734f81e.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('406', '邮乐韵菲专营店', '无线蓝牙耳机迷你超小苹果安卓通用耳机', '送两条充电线+一个收纳盒', '15.90', '/upload/goods_img/手机数码/5db3b873b60d7.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('407', '万品好易购商城', 'XO NB23 八角宝石锌合金数据线', '产品颜色：黑色  白色 宝石外观 不拘一格;  锌合金 更出色；  2.4A极速充电，高效传输文件', '49.00', '/upload/goods_img/手机数码/5db3b873bf931.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('408', '万品好易购商城', 'XO F1 户外Mini蓝牙音箱 经典挂扣 防水 防尘/防摔 抗干扰性强 无线链接 免提通话', '音量调节/音乐播放、暂停/上下曲切换 语音报号/来电铃声/数据输出/直读SD卡', '99.00', '/upload/goods_img/手机数码/5db3b873d7806.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('409', '万品好易购商城', 'XO  PB39 移动电源 8000mAh', '8000mAh大容量 双输出带LED灯  ； 电源保护, 好用更安全； 智能分流 高效输出', '119.00', '/upload/goods_img/手机数码/5db3b8740878f.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('410', '万品好易购商城', 'XO BS8 运动蓝牙耳机源于经典 加以升级 鲨鱼鳍耳翼 舒适牢固', '源于经典 加以升级； 鲨鱼鳍耳翼 舒适牢固 ； 无惧雨水  防水防汗； 蓝牙4.2版本，深度降噪', '169.00', '/upload/goods_img/手机数码/5db3b87419133.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('411', '万品好易购商城', 'XO BS7 运动蓝牙耳机 深度降噪 通话更清晰 轻松操控 随意切换', '强劲的CSR芯片 提升续航能力； 蓝牙4.1版本，深度降噪，通话更清晰； 霍尔磁控开关，智能感应', '199.00', '/upload/goods_img/手机数码/5db3b8742586e.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('412', '万品好易购商城', 'XO A8 蓝牙音箱 智能触控 自由切换 大容量电池 可连续播放约4-6小时 土豪金 星空银 银色', '智能触控，自由切换； 内置1000毫安聚合物电池，全频高清喇叭+低音振膜,可连续播放约4-6小时', '169.00', '/upload/goods_img/手机数码/5db3b874390f2.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('413', '普润家居专营店', 'oppo蓝牙耳机迷你vivo超小隐形运动通用华为无线耳塞超长待机开车', '', '79.00', '/upload/goods_img/手机数码/5db3b874496ae.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('414', '木易生活专柜', '2米超长  美能格  苹果安卓Type-C数据线 2.4A快充电线', '2米超长  美能格  苹果安卓Type-C数据线 2.4A快充电线', '12.90', '/upload/goods_img/手机数码/5db3b874588e2.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('415', '木易生活专柜', '沃晟伦蓝牙耳机M165蓝牙耳机入耳式商务车载便携式4.1*', '沃晟伦蓝牙耳机M165蓝牙耳机入耳式商务车载便携式4.1', '15.90', '/upload/goods_img/手机数码/5db3b8746c166.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('416', '北京信酷数码商城专柜', 'iPhone 苹果原装充电器套装/数据线+充电头电源适配器 通用型', '【全国包邮】 充电套装更优惠', '69.00', '/upload/goods_img/手机数码/5db3b874784b9.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('417', '小牛数码家居专柜', '飞利浦/PHILIPS 多功能可伸缩车载手机支架DLK35002', '多功能可伸缩车载手机支架', '68.00', '/upload/goods_img/手机数码/5db3b87484bf4.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('418', '北京信酷数码商城专柜', '苹果 iphone X /XS MAX/XS/XR/钢化膜 全屏全覆盖 手机贴膜', '', '19.00', '/upload/goods_img/手机数码/5db3b87493e28.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('419', '邮乐萍乡馆', '南孚(NANFU)3V纽扣电池两粒 CR2032/CR2025/CR2016锂电池电子汽车钥匙遥控', '奔驰c200l福特 新蒙迪欧 高尔夫7 新马自达昂克赛拉阿特兹 手表奔驰大众汽车钥匙电池', '9.90', '/upload/goods_img/手机数码/5db3b874a670c.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('420', '信酷小米专营店', '小米（MI） 车载充电器快充版 QC3.0 双口输出 智能温度控制 兼容iOS和Android设备', '小米正品 全国包邮', '89.00', '/upload/goods_img/手机数码/5db3b874b8050.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('421', '北京信酷数码商城专柜', '苹果 iPhone6/6S/6Plus/6SPlus/iPhone7/7P防爆钢化玻璃膜高清手机贴膜', '进口AGC玻璃板！超薄钢化玻璃膜！秒杀国产玻璃！', '26.00', '/upload/goods_img/手机数码/5db3b874c207b.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('422', '北京信酷数码商城专柜', 'OPPO手机原装耳机R11/PLUS入耳式线控r11s/r15耳机 白色盒装', '', '38.80', '/upload/goods_img/手机数码/5db3b874d31ef.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('423', '北京信酷数码商城专柜', '华为（HUAWEI）小天鹅无线蓝牙免提通话音箱4.0 便携户外/车载迷你音响AM08', '音·触即发！360°音效技术，音质真实自然，简洁触控操作，支持蓝牙免提通话。', '95.00', '/upload/goods_img/手机数码/5db3b874e280a.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('424', '北京信酷数码商城专柜', '三星 32G内存卡(CLASS10 48MB/s)  手机内存卡32g MicroSD存储卡', '正品行货 支持专柜验货 实行三包政策 轻放心购买', '95.00', '/upload/goods_img/手机数码/5db3b874edfa5.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('425', '北京信酷数码商城专柜', '华为/HUAWEI 华为快速充电套装 4.5V/5A充电头+type-c线  华为充电器', '支持p20/mate10/9pro/p10plus荣耀10/v10/note10等机型', '98.00', '/upload/goods_img/手机数码/5db3b87504947.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('426', '北京信酷数码商城专柜', '小米（MI）小米手环2（黑色）智能运动 防水 心率监测 计步器 久坐提醒', '正品行货 全国包邮', '159.00', '/upload/goods_img/手机数码/5db3b875133ab.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('427', '信酷小米专营店', '小米活塞耳机 清新版 黑色 蓝色 入耳式手机耳机 通用耳麦', '小米正品 全国包邮', '45.00', '/upload/goods_img/手机数码/5db3b8751ef2e.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('428', '信酷小米专营店', '小米支架式自拍杆 灰色 黑色 蓝牙遥控迷你便携带三脚架多功能', '小米正品 全国包邮', '105.00', '/upload/goods_img/手机数码/5db3b875327b2.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('429', '信酷小米专营店', '小米（MI）方盒子蓝牙音箱2 无线迷你随身户外便携客厅家用小音响', '小米正品 全国包邮', '149.00', '/upload/goods_img/手机数码/5db3b87546807.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('430', '信酷小米专营店', '小米（MI）小米运动蓝牙耳机mini 黑色白色 无线蓝牙入耳式运动耳机', '小米正品 全国包邮', '169.00', '/upload/goods_img/手机数码/5db3b8755a85b.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('431', '信酷小米专营店', '小米（MI）小钢炮2代 无线蓝牙便携音箱', '小米正品 全国包邮', '139.00', '/upload/goods_img/手机数码/5db3b87564c6e.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('432', '铁好家居美妆日用百货专营店', '公牛BULL 独立3孔位2USB创意魔方插座 1.5米线GN-UUB122【热卖推荐】', '立体集成结构 小巧轻便 五重保护', '67.00', '/upload/goods_img/手机数码/5db3b87575612.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('433', '九洲科瑞数码专营店', '华为 HUAWEI 畅享9 Plus 4GB+128GB', '', '1.00', '/upload/goods_img/手机数码/5db3b8758639e.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('434', '九洲科瑞数码专营店', '华为HUAWEI nova4 4800万超广角三摄8GB+128GB', '', '2.00', '/upload/goods_img/手机数码/5db3b875932a9.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('435', '九洲科瑞数码专营店', '华为 HUAWEI P30 Pro 徕卡四摄10倍混合变焦麒麟980芯片屏内指纹 8GB+128G', '', '4.00', '/upload/goods_img/手机数码/5db3b8759d6bb.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('436', '邮乐萍乡馆', '南孚 安卓数据线 NF-LM001 小米华为OPPO三星vivo充电器通用', '', '9.90', '/upload/goods_img/手机数码/5db3b875a923e.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('437', '铁好家电数码专营店', '公牛BULL 二合一苹果lighting+micro USB数据线GN-J81N【热卖推荐】', 'MFi官方认证，快速充电，抗折断', '69.00', '/upload/goods_img/手机数码/5db3b875b2e80.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('438', '邮乐萍乡馆', '南孚(NANFU)LR6AA聚能环 5号+7号碱性干电池【共4粒装】', '', '9.90', '/upload/goods_img/手机数码/5db3b875be233.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('439', '岳灵生活专营店', '南孚手机充电宝 10000毫安大容量礼盒装NFCT10', '', '169.00', '/upload/goods_img/手机数码/5db3b875cad56.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('440', '邮乐萍乡馆', '南孚(NANFU)LR03AAA聚能环7号电池碱性干电池12粒装儿童玩具遥控器赛车闹钟智能门锁电池', 'AAA干电池持久电力家用', '27.80', '/upload/goods_img/手机数码/5db3b875d3610.jpg', '1572059524', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('441', '中国农垦官方旗舰店', '买2份送一份【中国农垦】黑龙江北大荒  支豆浆粉早餐豆浆粉 非转基因大豆 五谷豆浆粉28g*10袋', '早餐豆粉买2份送一份', '18.00', '/upload/goods_img/特色美食/5db3b8d338ebc.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('442', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒支装豆浆粉（醇豆浆、红枣味可选） 非转基因大豆', '早餐豆粉买2份送一份', '15.00', '/upload/goods_img/特色美食/5db3b8d3432ce.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('443', '牛牛食品专营店', '(8月新货)蒙牛小真果粒125ml*20盒草莓味果粒酸奶小胖丁迷你装', '8月份的新货,超好喝，儿童，果粒，健康营养，', '22.70', '/upload/goods_img/特色美食/5db3b8d34deb1.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('444', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒 支装豆浆粉 麦香甜豆浆粉 28g*10袋', '早餐豆粉买2份送一份', '15.00', '/upload/goods_img/特色美食/5db3b8d3651ce.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('445', '禾煜食品旗舰店', '禾煜 黄冰糖418g包  冰糖土冰糖  煲汤食材', '黄冰糖买2送1', '15.00', '/upload/goods_img/特色美食/5db3b8d66e304.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('446', '新农哥旗舰店', '【新农哥】板栗仁108gx4袋  休闲零食小吃', '', '26.90', '/upload/goods_img/特色美食/5db3b8d6832f9.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('447', '新农哥旗舰店', '新农哥 每日坚果 混合果仁 缤纷坚果仁175g*2盒  休闲零食', '缤纷美味 一吃钟情', '59.90', '/upload/goods_img/特色美食/5db3b8d68e2c4.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('448', '众天蜂蜜邮乐农品旗舰店', '众天山花蜂蜜500g', '秦岭深处 百花酿造而成 最受欢迎的蜂蜜 性价比极高！', '19.90', '/upload/goods_img/特色美食/5db3b8d6a2ed1.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('449', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒 非转基因大豆 豆浆粉 红枣豆浆粉28g*10袋', '早餐豆粉买2份送一份', '18.00', '/upload/goods_img/特色美食/5db3b8d6ae283.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('450', '考拉小哥专营店', '薛小贱 每日坚果25g*1包', '厂家直供、7种混合、日期新鲜', '1.66', '/upload/goods_img/特色美食/5db3b8d6b8e66.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('451', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂五宝茶 益本茶 男人茶养生茶 草本', '【萃涣堂】五宝益本茶 男人茶买2送1五宝茶男人茶枸杞茶玛咖片黄精男肾茶老公八宝茶养生茶 做性福的男人', '19.00', '/upload/goods_img/特色美食/5db3b8d6c8481.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('452', '萃涣堂蒲公英茶专柜', '【滨州馆】寻味山东新鲜现做手工 滨州黑芝麻红枣饼核桃 枸杞传统工艺 香甜可口 10g独立装包邮', '寻味山东 新鲜现做手工滨州黑芝麻红枣饼核桃 枸杞传统工艺 香甜可口 10g独立装包邮', '1.00', '/upload/goods_img/特色美食/5db3b8d6cc302.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('453', '正江食品专营店', '寿全斋  红枣姜茶 姜茶 12g*10条', '', '25.00', '/upload/goods_img/特色美食/5db3b8d6debe7.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('454', '阿坝州理县地方扶贫馆', '四川浓香菜籽油 5升农家非转基因5l纯菜子粮油食用油约10斤植物油', '2019新油，滴滴香浓，四川非转基因纯菜籽油', '66.00', '/upload/goods_img/特色美食/5db3b8d6f246b.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('455', '千岛湖品牌农产品馆', '千岛湖 千岛渔娘 糍粑（4味）200g', '买二赠一 糍粑', '15.00', '/upload/goods_img/特色美食/5db3b8d706ecd.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('456', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂 金菊饮 菊花枸杞茶 菊花茶叶贡菊散装杭枸杞菊花茶非解毒去火清热凉茶', '【滨州馆】萃涣堂 金菊饮 菊花枸杞茶 菊花茶叶贡菊散装杭枸杞菊花茶非解毒去火清热凉茶', '0.50', '/upload/goods_img/特色美食/5db3b8d713dd8.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('457', '果蔻食品专营店', '果蔻 每日坚果B款20g/包简装无礼盒成人儿童孕妇混合果仁坚果零食大礼包', '科学配比  营养美味', '1.39', '/upload/goods_img/特色美食/5db3b8d729985.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('458', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂 黑苦荞茶 5克/袋 苦荞茶正品 大凉山', '【滨州馆】萃涣堂 黑苦荞茶 5克/袋 苦荞茶正品 大凉山', '0.50', '/upload/goods_img/特色美食/5db3b8d736890.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('459', '佳林院红枣旗舰店', '【0.4元/袋佳林院泡茶煮粥煲汤枣圈】山东特产乐陵红枣每袋约12克袋装50袋起拍包邮部分偏远地区除外', '佳林院品牌装，泡茶煮粥枣圈，拼团价0.4元/袋，每袋约12克装，50袋起拍，食用方便，经济实惠！', '0.40', '/upload/goods_img/特色美食/5db3b8d798327.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('460', '果蔻食品专营店', '果蔻 每日坚果25g*1包成人儿童孕妇混合坚果混合果仁小吃零食', '', '1.65', '/upload/goods_img/特色美食/5db3b8d7aa43b.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('461', '萃涣堂蒲公英茶专柜', '【滨州馆】红枣黑糖姜茶大姨妈水姜糖女老姜块生姜姜汁姜汤红糖姜枣茶小袋装25克/袋', '姜味浓,红枣多,顺畅暖暖,效果杠杠“冬吃萝卜夏吃姜。”传统组方真材实料。', '0.90', '/upload/goods_img/特色美食/5db3b8dab8392.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('462', '南阳专区专营店', '南阳西峡现摘金桃黄心猕猴桃15枚 （单枚60g-90g）买一送一 共30枚，合并发一箱', '买一赠一活动', '19.90', '/upload/goods_img/特色美食/5db3b8dac3745.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('463', '果然好口福专柜', '宁 福吉 5斤起拍新疆原味生核桃新货 特产薄皮核桃 坚果炒货休闲零食包邮', '新疆薄皮核桃  送夹子', '9.90', '/upload/goods_img/特色美食/5db3b8daea466.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('464', '刘陶生鲜旗舰店', '刘陶 福建红肉柚子红心蜜柚8.5-9.5斤（3-4个装） 新鲜水果2', '', '25.50', '/upload/goods_img/特色美食/5db3b8db3a40e.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('465', '丹东邮政农特产品专营店', '2019年丹东新鲜板栗4斤东北农家生板栗毛栗子现摘栗子应季水果干', '', '19.90', '/upload/goods_img/特色美食/5db3b8db3a7f6.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('466', '果然好口福专柜', '宁福吉 新疆和田大枣煲粥枣500克包邮', '', '6.60', '/upload/goods_img/特色美食/5db3b8db578d5.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('467', '小呆妞旗舰店', '预售小呆妞四川蒲江金艳黄心猕猴桃90-110g中果24枚 72内小时发货', '关于售后：签收24小时内后台申请退款请提供坏果和快递单合照，会根据实际损坏赔付', '27.90', '/upload/goods_img/特色美食/5db3b8db63c28.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('468', '萃涣堂蒲公英茶专柜', '萃涣堂茉莉绿茶三角茶包袋茉莉花茶小袋装绿茶袋泡冷泡茶包伴手礼花茶茶包组合玫瑰茉莉绿茶袋泡三', '萃涣堂茉莉绿茶三角茶包袋茉莉花茶小袋装绿茶袋泡冷泡茶包', '0.90', '/upload/goods_img/特色美食/5db3b8db71303.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('469', '丹东邮政农特产品专营店', '新鲜现挖番薯红黄心密署农家自种蒸煮粉糯香甜沙地地瓜烤烟署5斤', '', '16.80', '/upload/goods_img/特色美食/5db3b8db862f8.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('470', '川锅壹号旗舰店', '川锅壹号辣白菜228g韩国泡菜下饭菜正宗朝鲜口味拌饭菜版面菜', '酸辣可口 老少皆宜', '5.90', '/upload/goods_img/特色美食/5db3b8dbcdf79.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('471', '福香御旗舰店', '福香御 慢生长2018东北大米雪花米10斤真空包邮色选米', '初霜收割，180天慢生长周期，30天鲜磨直达，大米胚乳含量极为丰富，口感软糯香甜。', '27.90', '/upload/goods_img/特色美食/5db3b8dbdb26c.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('472', '兰州鲜合苑百合特产店专营店', '现包现发100%新鲜正宗兰州市七里河区产兰州鲜百合3年生兰州百合农家甜百合，约16颗百合一斤', '兰州鲜百合，无任何添加剂，宝宝也可以放心食用', '19.90', '/upload/goods_img/特色美食/5db3b8dbe8d2f.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('473', '当季鲜果', '黄金奇异果12枚包邮（中果70-90克，拍2件多送6枚，合并发30枚）金艳黄心猕猴桃新鲜水果', '快递随机，不能指定快递，下单后72小时内发货，下雨天顺延，购买前请阅读售后要求，介意慎拍', '9.90', '/upload/goods_img/特色美食/5db3b8dc0be0c.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('474', '丹东邮政农特产品专营店', '东北特产老品种大米  凤城蓝乡生态米 10斤 珍珠米 非蟹田', '东北特产老品种大米  凤城蓝乡生态米 10斤 珍珠米 非蟹田', '28.80', '/upload/goods_img/特色美食/5db3b8dc17d77.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('475', '川锅壹号旗舰店', '川锅壹号蟹黄酱拌饭酱秃黄油拌面酱蟹粉酱蟹黄膏酱料即食螃蟹酱', '金脂香软 经典美味', '9.90', '/upload/goods_img/特色美食/5db3b8dc2c59c.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('476', '刘陶生鲜旗舰店', '刘陶 云南昭通丑苹果5斤大果（13-15个）新鲜水果', '拼团的亲想更加快的发货，尽量和已经开团的亲拼团购买', '27.00', '/upload/goods_img/特色美食/5db3b8dc365c6.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('477', '福香御旗舰店', '福香御 大米5kg装2018新米圆粒珍珠米寿司香米秋田小町农家东北大米包邮', '', '29.99', '/upload/goods_img/特色美食/5db3b8de5a091.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('478', '刘陶生鲜旗舰店', '刘陶 云南石林人生果圆果净果5斤（25-35个）大果新鲜水果2', '拼团的亲想更加快的发货，尽量和已经开团的亲拼团购买', '25.00', '/upload/goods_img/特色美食/5db3b8de6ec9e.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('479', '刘陶生鲜旗舰店', '刘陶 福建红肉柚子红心蜜柚8.5-9.5斤（3-4个装） 新鲜水果特卖', '', '25.50', '/upload/goods_img/特色美食/5db3b8de7ac09.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('480', '萃涣堂蒲公英茶专柜', '【萃涣堂】 蜜桃乌龙茶  水果茶 三角包共蜜桃白桃乌龙茶袋泡花茶包花', '新品上市!独立三角袋泡茶,携带冲泡更便捷!【萃涣堂】 蜜桃乌龙茶 水果茶 三角包', '0.90', '/upload/goods_img/特色美食/5db3b8de97517.jpg', '1572059535', '0', '3');
INSERT INTO `xy_goods_list` VALUES ('481', '信酷小米专营店', '小米/MIUI 小米电视4S 43英寸人工智能语音网络平板电视 1GB+8GB HDR 4K超高清', '金属机身', '1.00', '/upload/goods_img/大家电/5db3b89a8d174.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('482', '邮乐安阳馆', '【汤阴县积分用户专享】洗衣机XpB—126-9896S', '', '1.00', '/upload/goods_img/大家电/5db3b89a9f288.jpg', '1578206762', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('483', '海信电器旗舰店', '海信（Hisense）HZ39E35A 39英寸高清手机交互 轻薄金属 WIFI人工智能液晶电视机', '', '1.00', '/upload/goods_img/大家电/5db3b89ab61bd.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('484', '邮滋味如皋馆专柜', '创维9公斤变频滚筒洗衣机  型号：F9015NC-炫金   如皋免费送货上门，南通包邮，华东地区配货', '创维洗衣机，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89b52437.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('485', '邮滋味如皋馆专柜', '创维2P定频立式柜机，型号：KFR-50LW/F2DA1A-3（限如皋地区免费送货上门安装）', '创维定频空调，免费上门安装，绝对优惠，每月更有现场特惠活动', '4.00', '/upload/goods_img/大家电/5db3b89b6e95e.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('486', '创维电视官方旗舰店', '创维/SKYWORTH 58H8M 58英寸4K超高清全面屏防蓝光人工智能语音HDR超薄网络液晶电视', '4K超高清，声像自然，一场声觉革新，视觉体验，光学防蓝光，护眼不偏色', '3.00', '/upload/goods_img/大家电/5db3b89b79d10.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('487', '邮乐洛阳', '【洛阳金融积分兑换】TCL 205升 三门电冰箱 （星空银） BC（邮政网点配送）', '', '1.00', '/upload/goods_img/大家电/5db3b89bc11c1.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('488', '邮滋味如皋馆专柜', '创维9公斤全自动波轮洗衣机，型号XQB90-52BAS淡雅银如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，夏季特惠；每月现场有特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89bcfc24.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('489', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】家用洗衣机，图片仅供参考', '', '1.00', '/upload/goods_img/大家电/5db3b89be0d98.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('490', '邮乐安阳馆', '【滑县积分用户专享】创维电器洗衣机9公斤波轮安阳', '', '1.00', '/upload/goods_img/大家电/5db3b89bee474.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('491', '邮乐安阳馆', '美菱3开门冰箱BCD-209M3CX【汤阴县积分兑换专用，其他下单不发货】', '', '1.00', '/upload/goods_img/大家电/5db3b89c06586.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('492', '邮乐安阳馆', '美菱电冰箱209L3CS【安阳县积分兑换用户专用，其他地区发】', '', '1.00', '/upload/goods_img/大家电/5db3b89c16f2a.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('493', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】自动洗衣机 家用洗衣机，图片仅供参考', '', '2.00', '/upload/goods_img/大家电/5db3b89c22e95.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('494', '邮乐安阳馆', '【滑县积分用户专享】创维电器电视50寸4K智能安阳', '', '3.00', '/upload/goods_img/大家电/5db3b89c2bb37.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('495', '邮乐安阳馆', '【安阳县积分用户专享】长虹液晶电视55U1', '', '3.00', '/upload/goods_img/大家电/5db3b89f48109.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('496', '海信电器旗舰店', '海信（Hisense）HZ32E30D 32英寸蓝光高清平板液晶电视机 酒店宾馆卧室推荐', '【海信今日限时特惠-到手价788元！】限量200台！抢完即止！', '749.00', '/upload/goods_img/大家电/5db3b89f51194.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('497', '邮滋味如皋馆专柜', '邮乐特卖：庭美家用消毒柜    型号：YTP-280    如皋免费送货上门，南通包邮，华东地区配送', '庭美消毒柜，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '755.00', '/upload/goods_img/大家电/5db3b89f5ec57.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('498', '吉舜诚商城专柜', '飞利浦（PHILIPS）  19英寸液晶电视机 显示器两用 hdmi高清接口', '19PFF2650', '799.00', '/upload/goods_img/大家电/5db3b89fb14ba.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('499', '创维集团官方旗舰店', '创维/SKYWORTH 32X3 32英寸窄边非智能老人机蓝光高清节能LED平板液晶电视机工程机', '蓝光高清，经典窄边，节能液晶，简单好用，谁用谁知道，实用耐用款', '799.00', '/upload/goods_img/大家电/5db3b89fc8fa8.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('500', '吉舜诚商城专柜', '飞利浦（PHILIPS）22英寸LED高清液晶平板电视机含底座 黑色', '22PFF2650/T3', '899.00', '/upload/goods_img/大家电/5db3b89fd917b.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('501', '创维集团官方旗舰店', '创维/SKYWORTH 32X6 32英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠，高清智能电视，WIFI，酷开系统，10核处理器', '899.00', '/upload/goods_img/大家电/5db3b89fe6086.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('502', '海信电器旗舰店', '海信 (Hisense) HZ32E35A 32英寸AI智能WIFI 轻薄金属 卧室神器高清电视机', '', '899.00', '/upload/goods_img/大家电/5db3b8a0004c2.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('503', '邮滋味如皋馆专柜', '创维邮乐特卖： 32寸液晶电视机，型号：32E381S   如皋免费送货上门，南通包邮，华东地区配货', '创维液晶电视大品牌，夏季特惠；每月现场有特惠活动', '899.00', '/upload/goods_img/大家电/5db3b8a01be30.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('504', '琥麟电器专柜', '海信 XQB60-H3568 6公斤全自动波轮洗衣机', '', '749.00', '/upload/goods_img/大家电/5db3b8a0279b3.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('505', '邮滋味如皋馆专柜', '创维7公斤全自动波轮洗衣机，型号：XQB70-21C淡雅银，如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '928.00', '/upload/goods_img/大家电/5db3b8a0367fe.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('506', '邮滋味如皋馆专柜', '创维单冷冰柜，型号：BD/C-160雅白，如皋地区免费送货上门安装，南通地区包邮，华东地区配货', '创维冰柜，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '999.00', '/upload/goods_img/大家电/5db3b8a042f39.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('507', '创维集团官方旗舰店', '创维（SKYWORTH）32H5 32英寸高清HDR 护眼全面屏 AI人工智能语音 网络WIFI 卧', '高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '999.00', '/upload/goods_img/大家电/5db3b8a0511cd.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('508', '邮滋味如皋馆专柜', '创维/SKYWORTH热水器，型号：DSZF-D5501-80，如皋免费送货上门，南通包邮 创维/', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '999.00', '/upload/goods_img/大家电/5db3b8a07389d.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('509', '琥麟电器专柜', 'Hisense/海信 HB80DA332G8KG公斤大容量家用全自动节能波轮洗衣机', '', '899.00', '/upload/goods_img/大家电/5db3b8a386615.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('510', '琥麟电器专柜', '海信 BCD-163N/B 冰柜冷藏冷冻双温家用商用小型卧式', '', '999.00', '/upload/goods_img/大家电/5db3b8a390a27.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('511', '吉舜诚商城专柜', '东芝（TOSHIBA）  32英寸 蓝光液晶电视 高清平板电视机 东芝电视机', '32L1500C', '1.00', '/upload/goods_img/大家电/5db3b8a69aafd.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('512', '创维集团官方旗舰店', '创维/SKYWORTH 40X6 40英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠！高清智能，10核处理器，可以WIFI上网', '1.00', '/upload/goods_img/大家电/5db3b8a9a6b14.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('513', '甲子商城旗舰店', '康佳/KONKA  LED39E330C 39英寸卧室电视高清蓝光节能平板液晶电视', '', '949.00', '/upload/goods_img/大家电/5db3b8a9b22ae.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('514', '邮乐赣州馆', '【不支持邮乐卡支付】创维-彩电-40E1C 40英寸全高清HDR 护眼全面屏 AI人工智能语音', '', '1.00', '/upload/goods_img/大家电/5db3b8a9cf38d.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('515', '琥麟电器专柜', '海信 BCD-177F/Q 177升 双门冰箱', '', '1.00', '/upload/goods_img/大家电/5db3b8a9f0abd.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('516', '创维集团官方旗舰店', '创维/SKYWORTH 43X6 43英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '【买电视选创维】高清智能，10核处理器，质量上乘，价格厚道，可以Wifi上网', '1.00', '/upload/goods_img/大家电/5db3b8aa1b4b4.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('517', '创维集团官方旗舰店', '创维（SKYWORTH）40H5 40英寸全高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '全高清HDR 护眼全面屏 AI人工智能语音', '1.00', '/upload/goods_img/大家电/5db3b8aa26c4f.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('518', '邮乐安阳馆', '市区积分用户专享】创维平板电视32X6', '', '1.00', '/upload/goods_img/大家电/5db3b8aa31c19.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('519', '吉舜诚商城专柜', '飞利浦（PHILIPS）32英寸新品高清LED电视 接口丰富窄边高清LED液晶平板电视机', '32PHF3282/T3', '1.00', '/upload/goods_img/大家电/5db3b8aa3b85c.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('520', '琥麟电器专柜', '海信 BD/BC-308NU/A 冰柜家用 顶开式卧式商用冷藏冷冻柜', '', '1.00', '/upload/goods_img/大家电/5db3b8aa4931f.jpg', '1572059510', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('521', '明凰服饰专营店', '男女冲锋衣工装棉服外套修身加厚款', '邮乐支持微信，支付宝，网银，邮储卡和银联卡支付。（不同商品请分开下单）', '85.00', '/upload/goods_img/户外服饰/5db3b8b22c022.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('522', '户外途量工厂专卖店', '春夏季运动风衣钓鱼防晒衣男女超薄透气皮肤衣防风外套户外速干潮流衣服情侣款皮肤衣', '大码骑行长袖', '29.90', '/upload/goods_img/户外服饰/5db3b8b23604c.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('523', '探路者正江专卖店', '探路者/TOREAD 冲锋裤 运动裤 秋冬户外软壳裤男透气防风保暖徒步裤KAMG91159', '', '428.00', '/upload/goods_img/户外服饰/5db3b8b25312b.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('524', '探路者正江专卖店', '探路者运动服 探路者冲锋衣 19秋冬户外女式防水透湿套绒冲锋衣TAWH92285', '', '839.00', '/upload/goods_img/户外服饰/5db3b8b25d925.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('525', '好看哒专营店', '防晒衣女中长款薄款防晒服', 'FSY-6387', '45.00', '/upload/goods_img/户外服饰/5db3b8b56628b.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('526', '宝仕母婴专营店专柜', 'L户外皮肤衣防紫外线防晒衣男女夏季超薄透气防晒服运动风衣', '', '75.00', '/upload/goods_img/户外服饰/5db3b8b573966.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('527', '好看哒专营店', '防晒衣女夏季新款韩版连帽系带长袖防晒衣糖果色沙滩户外披肩防晒衣', 'FSY-54', '19.90', '/upload/goods_img/户外服饰/5db3b8b88f380.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('528', '户外途量工厂专卖店', '户外速干T恤男 女休闲跑步运动健身短袖大码情侣快干衣排汗透气', '', '22.80', '/upload/goods_img/户外服饰/5db3b8b8abc8f.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('529', '好看哒专营店', '防晒衣 户外薄款防紫外线印花防晒衣', 'FSY-1736', '25.00', '/upload/goods_img/户外服饰/5db3b8b8c0c84.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('530', '好看哒专营店', '防晒衣夏季女蝙蝠袖连帽拉链短款防晒衣', 'FSY-5423', '35.00', '/upload/goods_img/户外服饰/5db3b8b9b16a1.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('531', '好看哒专营店', '防晒衣男士薄款纯色连帽防晒衣', 'FSY-4167', '35.00', '/upload/goods_img/户外服饰/5db3b8b9bbe9c.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('532', '户外途量工厂专卖店', '城徒 户外春夏单层冲锋衣女防晒衣男轻薄防风钓鱼服透气速干外套长袖衫', '', '35.80', '/upload/goods_img/户外服饰/5db3b8ba1b847.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('533', '好看哒专营店', '防晒衣韩版短款薄款连帽长袖防晒衣', 'FSY-5439', '36.00', '/upload/goods_img/户外服饰/5db3b8ba72314.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('534', '好看哒专营店', '防晒衣女中长款涂鸦薄款防晒衣', 'FSY-5282', '36.00', '/upload/goods_img/户外服饰/5db3b8ba99fd5.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('535', '好看哒专营店', '防晒衣女中长款薄款防晒衣', 'FSY-5456', '37.90', '/upload/goods_img/户外服饰/5db3b8baa8e20.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('536', '户外途量工厂专卖店', '秋冬户外男抓绒衣摇粒绒女外套保暖冲锋衣内胆开衫卫衣', '', '39.00', '/upload/goods_img/户外服饰/5db3b8bab267b.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('537', '户外途量工厂专卖店', '户外秋冬季加绒加厚抓绒衣男女摇粒绒保暖抓绒外套开衫冲锋衣内胆', '', '49.00', '/upload/goods_img/户外服饰/5db3b8bae0cb5.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('538', '江门新会馆', '【江门新会馆】caxa断码 两截速干裤女 韩版修身透气徒步快干裤野外登山跑步长裤', '', '50.00', '/upload/goods_img/户外服饰/5db3b8baf06b9.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('539', '宝仕母婴专营店专柜', 'L夏季休闲短裤男宽松5分中裤子男士运动五分裤大码跑步速干沙滩裤', '', '55.00', '/upload/goods_img/户外服饰/5db3b8bb2ba54.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('540', '江门新会馆', '【江门新会馆】caxa修身户外健身速干裤女 快干弹力透气登山大码长裤 弹力户外裤', '', '60.00', '/upload/goods_img/户外服饰/5db3b8bb513ed.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('541', '探路者正江专卖店', '探路者/TOREADt恤女户外夏季快干速干透气运动服TAJG82984', '', '61.00', '/upload/goods_img/户外服饰/5db3b8bb5ac47.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('542', '铁好家居美妆日用百货专营店', '佳钓尼 夏遮阳防晒帽套头面罩透气防紫外线渔夫帽', '', '48.00', '/upload/goods_img/户外服饰/5db3b8bb8e0a3.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('543', '宝仕母婴专营店专柜', '防晒衣男女情侣春夏季防雨风衣超薄透气速干钓鱼防晒服户外皮肤衣MN', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bb9f9e7.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('544', '户外途量工厂专卖店', '城徒 春夏季速干裤男女大码轻薄快干透气户外修身显瘦弹力冲锋裤', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbb3e24.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('545', '宝仕母婴专营店专柜', 'L运动户外夏季速干t恤 男女短袖速干衣快干t恤 吸汗透气', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbe33ff.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('546', '宝仕母婴专营店专柜', 'L健身房教练速干T恤男女 圆领情侣夏季短袖汗衫', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bc1bca2.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('547', '户外途量工厂专卖店', '城徒 冬季正品户外冲锋裤男女抓绒裤保暖防风防水加厚软壳裤登山裤长裤', '', '75.00', '/upload/goods_img/户外服饰/5db3b8bc42dab.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('548', '江门新会馆', '【江门新会馆】caxa修身弹力女款休闲棉裤 户外休闲快干长裤 女士跑步登山健身裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bc96997.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('549', '江门新会馆', '【江门新会馆】caxa休闲修身速干裤 透气轻薄运动裤耐磨健身户外裤多袋裤七分裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bcac92c.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('550', '探路者正江专卖店', '探路者/TOREAD 运动服 短袖户外女运动跑步排汗透气圆领速干T恤TAJF82784', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bcc53b9.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('551', '户外途量工厂专卖店', '冲锋裤男户外秋冬防风防水软壳裤女加绒加厚抓绒裤保暖徒步登山裤', '', '79.00', '/upload/goods_img/户外服饰/5db3b8bd362c1.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('552', '探路者正江专卖店', '探路者/TOREADT恤女 夏户外女式超轻透气速干衣圆领T恤短袖KAJG82352', '', '99.00', '/upload/goods_img/户外服饰/5db3b8bd44554.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('553', '探路者正江专卖店', '探路者/TOREAD 短袖 18春夏新款户外女式圆领速干透气印花短袖T恤TAJG82939', '', '99.00', '/upload/goods_img/户外服饰/5db3b8bd602ab.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('554', '探路者正江专卖店', '探路者/TOREAD夏新款户外运动透气弹力速干女式半袖短袖T恤KAJG82310', '', '99.00', '/upload/goods_img/户外服饰/5db3b8be68f86.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('555', '探路者正江专卖店', '探路者/TOREAD T恤女款 秋季户外短袖女时尚速干透气短袖T恤TAJG82938', '', '99.00', '/upload/goods_img/户外服饰/5db3b8be96a09.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('556', '洋湖轩榭官方旗舰店', '洋湖轩榭 春秋季新款中老年男装连帽冲锋衣爸爸装休闲夹克衫外套男A', '钜惠双十一 感恩惠顾', '126.42', '/upload/goods_img/户外服饰/5db3b8bea6025.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('557', '南城百货专营店', '秋冬季加绒加厚冲锋衣男女三合一可拆卸两件套防水户外情侣登山服', '秋冬季加绒加厚冲锋衣男女三合一可拆卸两件套防水户外情侣登山服', '158.00', '/upload/goods_img/户外服饰/5db3b8bede68a.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('558', '正江服饰专营店', '包邮韵格NT1021男士紧身训练PRO运动健身跑步长袖弹力速干服纯色衣服', '', '59.00', '/upload/goods_img/户外服饰/5db3b8beeb97d.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('559', '流行饰品运动户外器械', '汤河店 户外冲锋裤男女可脱卸秋冬季加绒加厚保暖软壳防风防水登山滑雪裤', '', '179.00', '/upload/goods_img/户外服饰/5db3b8bf07cf9.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('560', '流行饰品运动户外器械', '汤河店 韩国正品vvc防晒衣女经典薄夏季中长款防晒服户外防紫外线皮肤衣', '', '499.00', '/upload/goods_img/户外服饰/5db3b8bf2bf21.jpg', '1572059516', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('561', '乐颐汇数码专营店', '荣耀10青春版 幻彩渐变 2400万AI自拍 全网通版4GB+64GB', '2400万AI高清自拍，麒麟710处理器，炫光渐变色', '989.00', '/upload/goods_img/手机数码/5db3b8700e46c.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('562', '乐颐汇数码专营店', '华为/HUAWEI 畅享9 手机 全网通 4GB+128GB', '6.26英寸珍珠屏 4000mAh大电池', '1099.00', '/upload/goods_img/手机数码/5db3b8731cf7b.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('563', '米果商贸专柜', '折叠式平板电脑支架底座懒人手机支架【颜色随机发货】', '', '9.90', '/upload/goods_img/手机数码/5db3b87337179.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('564', '邮乐韵菲专营店', '（亏本促销）车载手机支架双面吸盘式家居懒人多功能通用可弯曲创意手机支架', '', '1.00', '/upload/goods_img/手机数码/5db3b87345fc4.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('565', '麦尚科技专营店', '手机支架懒人支架卡通创意平板电脑桌面支撑座【款式随机】', '', '9.90', '/upload/goods_img/手机数码/5db3b8734f81e.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('566', '邮乐韵菲专营店', '无线蓝牙耳机迷你超小苹果安卓通用耳机', '送两条充电线+一个收纳盒', '15.90', '/upload/goods_img/手机数码/5db3b873b60d7.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('567', '万品好易购商城', 'XO NB23 八角宝石锌合金数据线', '产品颜色：黑色  白色 宝石外观 不拘一格;  锌合金 更出色；  2.4A极速充电，高效传输文件', '49.00', '/upload/goods_img/手机数码/5db3b873bf931.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('568', '万品好易购商城', 'XO F1 户外Mini蓝牙音箱 经典挂扣 防水 防尘/防摔 抗干扰性强 无线链接 免提通话', '音量调节/音乐播放、暂停/上下曲切换 语音报号/来电铃声/数据输出/直读SD卡', '99.00', '/upload/goods_img/手机数码/5db3b873d7806.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('569', '万品好易购商城', 'XO  PB39 移动电源 8000mAh', '8000mAh大容量 双输出带LED灯  ； 电源保护, 好用更安全； 智能分流 高效输出', '119.00', '/upload/goods_img/手机数码/5db3b8740878f.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('570', '万品好易购商城', 'XO BS8 运动蓝牙耳机源于经典 加以升级 鲨鱼鳍耳翼 舒适牢固', '源于经典 加以升级； 鲨鱼鳍耳翼 舒适牢固 ； 无惧雨水  防水防汗； 蓝牙4.2版本，深度降噪', '169.00', '/upload/goods_img/手机数码/5db3b87419133.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('571', '万品好易购商城', 'XO BS7 运动蓝牙耳机 深度降噪 通话更清晰 轻松操控 随意切换', '强劲的CSR芯片 提升续航能力； 蓝牙4.1版本，深度降噪，通话更清晰； 霍尔磁控开关，智能感应', '199.00', '/upload/goods_img/手机数码/5db3b8742586e.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('572', '万品好易购商城', 'XO A8 蓝牙音箱 智能触控 自由切换 大容量电池 可连续播放约4-6小时 土豪金 星空银 银色', '智能触控，自由切换； 内置1000毫安聚合物电池，全频高清喇叭+低音振膜,可连续播放约4-6小时', '169.00', '/upload/goods_img/手机数码/5db3b874390f2.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('573', '普润家居专营店', 'oppo蓝牙耳机迷你vivo超小隐形运动通用华为无线耳塞超长待机开车', '', '79.00', '/upload/goods_img/手机数码/5db3b874496ae.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('574', '木易生活专柜', '2米超长  美能格  苹果安卓Type-C数据线 2.4A快充电线', '2米超长  美能格  苹果安卓Type-C数据线 2.4A快充电线', '12.90', '/upload/goods_img/手机数码/5db3b874588e2.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('575', '木易生活专柜', '沃晟伦蓝牙耳机M165蓝牙耳机入耳式商务车载便携式4.1*', '沃晟伦蓝牙耳机M165蓝牙耳机入耳式商务车载便携式4.1', '15.90', '/upload/goods_img/手机数码/5db3b8746c166.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('576', '北京信酷数码商城专柜', 'iPhone 苹果原装充电器套装/数据线+充电头电源适配器 通用型', '【全国包邮】 充电套装更优惠', '69.00', '/upload/goods_img/手机数码/5db3b874784b9.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('577', '小牛数码家居专柜', '飞利浦/PHILIPS 多功能可伸缩车载手机支架DLK35002', '多功能可伸缩车载手机支架', '68.00', '/upload/goods_img/手机数码/5db3b87484bf4.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('578', '北京信酷数码商城专柜', '苹果 iphone X /XS MAX/XS/XR/钢化膜 全屏全覆盖 手机贴膜', '', '19.00', '/upload/goods_img/手机数码/5db3b87493e28.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('579', '邮乐萍乡馆', '南孚(NANFU)3V纽扣电池两粒 CR2032/CR2025/CR2016锂电池电子汽车钥匙遥控', '奔驰c200l福特 新蒙迪欧 高尔夫7 新马自达昂克赛拉阿特兹 手表奔驰大众汽车钥匙电池', '9.90', '/upload/goods_img/手机数码/5db3b874a670c.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('580', '信酷小米专营店', '小米（MI） 车载充电器快充版 QC3.0 双口输出 智能温度控制 兼容iOS和Android设备', '小米正品 全国包邮', '89.00', '/upload/goods_img/手机数码/5db3b874b8050.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('581', '北京信酷数码商城专柜', '苹果 iPhone6/6S/6Plus/6SPlus/iPhone7/7P防爆钢化玻璃膜高清手机贴膜', '进口AGC玻璃板！超薄钢化玻璃膜！秒杀国产玻璃！', '26.00', '/upload/goods_img/手机数码/5db3b874c207b.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('582', '北京信酷数码商城专柜', 'OPPO手机原装耳机R11/PLUS入耳式线控r11s/r15耳机 白色盒装', '', '38.80', '/upload/goods_img/手机数码/5db3b874d31ef.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('583', '北京信酷数码商城专柜', '华为（HUAWEI）小天鹅无线蓝牙免提通话音箱4.0 便携户外/车载迷你音响AM08', '音·触即发！360°音效技术，音质真实自然，简洁触控操作，支持蓝牙免提通话。', '95.00', '/upload/goods_img/手机数码/5db3b874e280a.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('584', '北京信酷数码商城专柜', '三星 32G内存卡(CLASS10 48MB/s)  手机内存卡32g MicroSD存储卡', '正品行货 支持专柜验货 实行三包政策 轻放心购买', '95.00', '/upload/goods_img/手机数码/5db3b874edfa5.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('585', '北京信酷数码商城专柜', '华为/HUAWEI 华为快速充电套装 4.5V/5A充电头+type-c线  华为充电器', '支持p20/mate10/9pro/p10plus荣耀10/v10/note10等机型', '98.00', '/upload/goods_img/手机数码/5db3b87504947.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('586', '北京信酷数码商城专柜', '小米（MI）小米手环2（黑色）智能运动 防水 心率监测 计步器 久坐提醒', '正品行货 全国包邮', '159.00', '/upload/goods_img/手机数码/5db3b875133ab.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('587', '信酷小米专营店', '小米活塞耳机 清新版 黑色 蓝色 入耳式手机耳机 通用耳麦', '小米正品 全国包邮', '45.00', '/upload/goods_img/手机数码/5db3b8751ef2e.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('588', '信酷小米专营店', '小米支架式自拍杆 灰色 黑色 蓝牙遥控迷你便携带三脚架多功能', '小米正品 全国包邮', '105.00', '/upload/goods_img/手机数码/5db3b875327b2.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('589', '信酷小米专营店', '小米（MI）方盒子蓝牙音箱2 无线迷你随身户外便携客厅家用小音响', '小米正品 全国包邮', '149.00', '/upload/goods_img/手机数码/5db3b87546807.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('590', '信酷小米专营店', '小米（MI）小米运动蓝牙耳机mini 黑色白色 无线蓝牙入耳式运动耳机', '小米正品 全国包邮', '169.00', '/upload/goods_img/手机数码/5db3b8755a85b.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('591', '信酷小米专营店', '小米（MI）小钢炮2代 无线蓝牙便携音箱', '小米正品 全国包邮', '139.00', '/upload/goods_img/手机数码/5db3b87564c6e.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('592', '铁好家居美妆日用百货专营店', '公牛BULL 独立3孔位2USB创意魔方插座 1.5米线GN-UUB122【热卖推荐】', '立体集成结构 小巧轻便 五重保护', '67.00', '/upload/goods_img/手机数码/5db3b87575612.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('593', '九洲科瑞数码专营店', '华为 HUAWEI 畅享9 Plus 4GB+128GB', '', '1.00', '/upload/goods_img/手机数码/5db3b8758639e.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('594', '九洲科瑞数码专营店', '华为HUAWEI nova4 4800万超广角三摄8GB+128GB', '', '2.00', '/upload/goods_img/手机数码/5db3b875932a9.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('595', '九洲科瑞数码专营店', '华为 HUAWEI P30 Pro 徕卡四摄10倍混合变焦麒麟980芯片屏内指纹 8GB+128G', '', '4.00', '/upload/goods_img/手机数码/5db3b8759d6bb.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('596', '邮乐萍乡馆', '南孚 安卓数据线 NF-LM001 小米华为OPPO三星vivo充电器通用', '', '9.90', '/upload/goods_img/手机数码/5db3b875a923e.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('597', '铁好家电数码专营店', '公牛BULL 二合一苹果lighting+micro USB数据线GN-J81N【热卖推荐】', 'MFi官方认证，快速充电，抗折断', '69.00', '/upload/goods_img/手机数码/5db3b875b2e80.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('598', '邮乐萍乡馆', '南孚(NANFU)LR6AA聚能环 5号+7号碱性干电池【共4粒装】', '', '9.90', '/upload/goods_img/手机数码/5db3b875be233.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('599', '岳灵生活专营店', '南孚手机充电宝 10000毫安大容量礼盒装NFCT10', '', '169.00', '/upload/goods_img/手机数码/5db3b875cad56.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('600', '邮乐萍乡馆', '南孚(NANFU)LR03AAA聚能环7号电池碱性干电池12粒装儿童玩具遥控器赛车闹钟智能门锁电池', 'AAA干电池持久电力家用', '27.80', '/upload/goods_img/手机数码/5db3b875d3610.jpg', '1572059524', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('601', '中国农垦官方旗舰店', '买2份送一份【中国农垦】黑龙江北大荒  支豆浆粉早餐豆浆粉 非转基因大豆 五谷豆浆粉28g*10袋', '早餐豆粉买2份送一份', '18.00', '/upload/goods_img/特色美食/5db3b8d338ebc.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('602', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒支装豆浆粉（醇豆浆、红枣味可选） 非转基因大豆', '早餐豆粉买2份送一份', '15.00', '/upload/goods_img/特色美食/5db3b8d3432ce.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('603', '牛牛食品专营店', '(8月新货)蒙牛小真果粒125ml*20盒草莓味果粒酸奶小胖丁迷你装', '8月份的新货,超好喝，儿童，果粒，健康营养，', '22.70', '/upload/goods_img/特色美食/5db3b8d34deb1.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('604', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒 支装豆浆粉 麦香甜豆浆粉 28g*10袋', '早餐豆粉买2份送一份', '15.00', '/upload/goods_img/特色美食/5db3b8d3651ce.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('605', '禾煜食品旗舰店', '禾煜 黄冰糖418g包  冰糖土冰糖  煲汤食材', '黄冰糖买2送1', '15.00', '/upload/goods_img/特色美食/5db3b8d66e304.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('606', '新农哥旗舰店', '【新农哥】板栗仁108gx4袋  休闲零食小吃', '', '26.90', '/upload/goods_img/特色美食/5db3b8d6832f9.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('607', '新农哥旗舰店', '新农哥 每日坚果 混合果仁 缤纷坚果仁175g*2盒  休闲零食', '缤纷美味 一吃钟情', '59.90', '/upload/goods_img/特色美食/5db3b8d68e2c4.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('608', '众天蜂蜜邮乐农品旗舰店', '众天山花蜂蜜500g', '秦岭深处 百花酿造而成 最受欢迎的蜂蜜 性价比极高！', '19.90', '/upload/goods_img/特色美食/5db3b8d6a2ed1.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('609', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒 非转基因大豆 豆浆粉 红枣豆浆粉28g*10袋', '早餐豆粉买2份送一份', '18.00', '/upload/goods_img/特色美食/5db3b8d6ae283.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('610', '考拉小哥专营店', '薛小贱 每日坚果25g*1包', '厂家直供、7种混合、日期新鲜', '1.66', '/upload/goods_img/特色美食/5db3b8d6b8e66.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('611', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂五宝茶 益本茶 男人茶养生茶 草本', '【萃涣堂】五宝益本茶 男人茶买2送1五宝茶男人茶枸杞茶玛咖片黄精男肾茶老公八宝茶养生茶 做性福的男人', '19.00', '/upload/goods_img/特色美食/5db3b8d6c8481.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('612', '萃涣堂蒲公英茶专柜', '【滨州馆】寻味山东新鲜现做手工 滨州黑芝麻红枣饼核桃 枸杞传统工艺 香甜可口 10g独立装包邮', '寻味山东 新鲜现做手工滨州黑芝麻红枣饼核桃 枸杞传统工艺 香甜可口 10g独立装包邮', '1.00', '/upload/goods_img/特色美食/5db3b8d6cc302.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('613', '正江食品专营店', '寿全斋  红枣姜茶 姜茶 12g*10条', '', '25.00', '/upload/goods_img/特色美食/5db3b8d6debe7.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('614', '阿坝州理县地方扶贫馆', '四川浓香菜籽油 5升农家非转基因5l纯菜子粮油食用油约10斤植物油', '2019新油，滴滴香浓，四川非转基因纯菜籽油', '66.00', '/upload/goods_img/特色美食/5db3b8d6f246b.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('615', '千岛湖品牌农产品馆', '千岛湖 千岛渔娘 糍粑（4味）200g', '买二赠一 糍粑', '15.00', '/upload/goods_img/特色美食/5db3b8d706ecd.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('616', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂 金菊饮 菊花枸杞茶 菊花茶叶贡菊散装杭枸杞菊花茶非解毒去火清热凉茶', '【滨州馆】萃涣堂 金菊饮 菊花枸杞茶 菊花茶叶贡菊散装杭枸杞菊花茶非解毒去火清热凉茶', '0.50', '/upload/goods_img/特色美食/5db3b8d713dd8.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('617', '果蔻食品专营店', '果蔻 每日坚果B款20g/包简装无礼盒成人儿童孕妇混合果仁坚果零食大礼包', '科学配比  营养美味', '1.39', '/upload/goods_img/特色美食/5db3b8d729985.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('618', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂 黑苦荞茶 5克/袋 苦荞茶正品 大凉山', '【滨州馆】萃涣堂 黑苦荞茶 5克/袋 苦荞茶正品 大凉山', '0.50', '/upload/goods_img/特色美食/5db3b8d736890.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('619', '佳林院红枣旗舰店', '【0.4元/袋佳林院泡茶煮粥煲汤枣圈】山东特产乐陵红枣每袋约12克袋装50袋起拍包邮部分偏远地区除外', '佳林院品牌装，泡茶煮粥枣圈，拼团价0.4元/袋，每袋约12克装，50袋起拍，食用方便，经济实惠！', '0.40', '/upload/goods_img/特色美食/5db3b8d798327.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('620', '果蔻食品专营店', '果蔻 每日坚果25g*1包成人儿童孕妇混合坚果混合果仁小吃零食', '', '1.65', '/upload/goods_img/特色美食/5db3b8d7aa43b.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('621', '萃涣堂蒲公英茶专柜', '【滨州馆】红枣黑糖姜茶大姨妈水姜糖女老姜块生姜姜汁姜汤红糖姜枣茶小袋装25克/袋', '姜味浓,红枣多,顺畅暖暖,效果杠杠“冬吃萝卜夏吃姜。”传统组方真材实料。', '0.90', '/upload/goods_img/特色美食/5db3b8dab8392.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('622', '南阳专区专营店', '南阳西峡现摘金桃黄心猕猴桃15枚 （单枚60g-90g）买一送一 共30枚，合并发一箱', '买一赠一活动', '19.90', '/upload/goods_img/特色美食/5db3b8dac3745.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('623', '果然好口福专柜', '宁 福吉 5斤起拍新疆原味生核桃新货 特产薄皮核桃 坚果炒货休闲零食包邮', '新疆薄皮核桃  送夹子', '9.90', '/upload/goods_img/特色美食/5db3b8daea466.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('624', '刘陶生鲜旗舰店', '刘陶 福建红肉柚子红心蜜柚8.5-9.5斤（3-4个装） 新鲜水果2', '', '25.50', '/upload/goods_img/特色美食/5db3b8db3a40e.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('625', '丹东邮政农特产品专营店', '2019年丹东新鲜板栗4斤东北农家生板栗毛栗子现摘栗子应季水果干', '', '19.90', '/upload/goods_img/特色美食/5db3b8db3a7f6.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('626', '果然好口福专柜', '宁福吉 新疆和田大枣煲粥枣500克包邮', '', '6.60', '/upload/goods_img/特色美食/5db3b8db578d5.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('627', '小呆妞旗舰店', '预售小呆妞四川蒲江金艳黄心猕猴桃90-110g中果24枚 72内小时发货', '关于售后：签收24小时内后台申请退款请提供坏果和快递单合照，会根据实际损坏赔付', '27.90', '/upload/goods_img/特色美食/5db3b8db63c28.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('628', '萃涣堂蒲公英茶专柜', '萃涣堂茉莉绿茶三角茶包袋茉莉花茶小袋装绿茶袋泡冷泡茶包伴手礼花茶茶包组合玫瑰茉莉绿茶袋泡三', '萃涣堂茉莉绿茶三角茶包袋茉莉花茶小袋装绿茶袋泡冷泡茶包', '0.90', '/upload/goods_img/特色美食/5db3b8db71303.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('629', '丹东邮政农特产品专营店', '新鲜现挖番薯红黄心密署农家自种蒸煮粉糯香甜沙地地瓜烤烟署5斤', '', '16.80', '/upload/goods_img/特色美食/5db3b8db862f8.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('630', '川锅壹号旗舰店', '川锅壹号辣白菜228g韩国泡菜下饭菜正宗朝鲜口味拌饭菜版面菜', '酸辣可口 老少皆宜', '5.90', '/upload/goods_img/特色美食/5db3b8dbcdf79.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('631', '福香御旗舰店', '福香御 慢生长2018东北大米雪花米10斤真空包邮色选米', '初霜收割，180天慢生长周期，30天鲜磨直达，大米胚乳含量极为丰富，口感软糯香甜。', '27.90', '/upload/goods_img/特色美食/5db3b8dbdb26c.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('632', '兰州鲜合苑百合特产店专营店', '现包现发100%新鲜正宗兰州市七里河区产兰州鲜百合3年生兰州百合农家甜百合，约16颗百合一斤', '兰州鲜百合，无任何添加剂，宝宝也可以放心食用', '19.90', '/upload/goods_img/特色美食/5db3b8dbe8d2f.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('633', '当季鲜果', '黄金奇异果12枚包邮（中果70-90克，拍2件多送6枚，合并发30枚）金艳黄心猕猴桃新鲜水果', '快递随机，不能指定快递，下单后72小时内发货，下雨天顺延，购买前请阅读售后要求，介意慎拍', '9.90', '/upload/goods_img/特色美食/5db3b8dc0be0c.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('634', '丹东邮政农特产品专营店', '东北特产老品种大米  凤城蓝乡生态米 10斤 珍珠米 非蟹田', '东北特产老品种大米  凤城蓝乡生态米 10斤 珍珠米 非蟹田', '28.80', '/upload/goods_img/特色美食/5db3b8dc17d77.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('635', '川锅壹号旗舰店', '川锅壹号蟹黄酱拌饭酱秃黄油拌面酱蟹粉酱蟹黄膏酱料即食螃蟹酱', '金脂香软 经典美味', '9.90', '/upload/goods_img/特色美食/5db3b8dc2c59c.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('636', '刘陶生鲜旗舰店', '刘陶 云南昭通丑苹果5斤大果（13-15个）新鲜水果', '拼团的亲想更加快的发货，尽量和已经开团的亲拼团购买', '27.00', '/upload/goods_img/特色美食/5db3b8dc365c6.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('637', '福香御旗舰店', '福香御 大米5kg装2018新米圆粒珍珠米寿司香米秋田小町农家东北大米包邮', '', '29.99', '/upload/goods_img/特色美食/5db3b8de5a091.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('638', '刘陶生鲜旗舰店', '刘陶 云南石林人生果圆果净果5斤（25-35个）大果新鲜水果2', '拼团的亲想更加快的发货，尽量和已经开团的亲拼团购买', '25.00', '/upload/goods_img/特色美食/5db3b8de6ec9e.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('639', '刘陶生鲜旗舰店', '刘陶 福建红肉柚子红心蜜柚8.5-9.5斤（3-4个装） 新鲜水果特卖', '', '25.50', '/upload/goods_img/特色美食/5db3b8de7ac09.jpg', '1572059535', '0', '4');
INSERT INTO `xy_goods_list` VALUES ('640', '萃涣堂蒲公英茶专柜', '【萃涣堂】 蜜桃乌龙茶  水果茶 三角包共蜜桃白桃乌龙茶袋泡花茶包花', '新品上市!独立三角袋泡茶,携带冲泡更便捷!【萃涣堂】 蜜桃乌龙茶 水果茶 三角包', '0.90', '/upload/goods_img/特色美食/5db3b8de97517.jpg', '1572059535', '0', '4');

-- ----------------------------
-- Table structure for xy_goods_list_copy
-- ----------------------------
DROP TABLE IF EXISTS `xy_goods_list_copy`;
CREATE TABLE `xy_goods_list_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) NOT NULL COMMENT '商店名称',
  `goods_name` varchar(255) NOT NULL COMMENT '商品名称',
  `goods_info` varchar(255) DEFAULT '' COMMENT '商品描述',
  `goods_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `goods_pic` varchar(120) DEFAULT '' COMMENT '商品展示图片',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '上架状态 0不上架 1上架',
  `cid` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';

-- ----------------------------
-- Records of xy_goods_list_copy
-- ----------------------------
INSERT INTO `xy_goods_list_copy` VALUES ('1', '信酷小米专营店', '小米/MIUI 小米电视4S 43英寸人工智能语音网络平板电视 1GB+8GB HDR 4K超高清', '金属机身', '1.00', '/upload/goods_img/大家电/5db3b89a8d174.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('2', '邮乐安阳馆', '【汤阴县积分用户专享】洗衣机XpB—126-9896S', '', '1.00', '/upload/goods_img/大家电/5db3b89a9f288.jpg', '1578206762', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('3', '海信电器旗舰店', '海信（Hisense）HZ39E35A 39英寸高清手机交互 轻薄金属 WIFI人工智能液晶电视机', '', '1.00', '/upload/goods_img/大家电/5db3b89ab61bd.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('4', '邮滋味如皋馆专柜', '创维9公斤变频滚筒洗衣机  型号：F9015NC-炫金   如皋免费送货上门，南通包邮，华东地区配货', '创维洗衣机，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89b52437.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('5', '邮滋味如皋馆专柜', '创维2P定频立式柜机，型号：KFR-50LW/F2DA1A-3（限如皋地区免费送货上门安装）', '创维定频空调，免费上门安装，绝对优惠，每月更有现场特惠活动', '4.00', '/upload/goods_img/大家电/5db3b89b6e95e.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('6', '创维电视官方旗舰店', '创维/SKYWORTH 58H8M 58英寸4K超高清全面屏防蓝光人工智能语音HDR超薄网络液晶电视', '4K超高清，声像自然，一场声觉革新，视觉体验，光学防蓝光，护眼不偏色', '3.00', '/upload/goods_img/大家电/5db3b89b79d10.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('7', '邮乐洛阳', '【洛阳金融积分兑换】TCL 205升 三门电冰箱 （星空银） BC（邮政网点配送）', '', '1.00', '/upload/goods_img/大家电/5db3b89bc11c1.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('8', '邮滋味如皋馆专柜', '创维9公斤全自动波轮洗衣机，型号XQB90-52BAS淡雅银如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，夏季特惠；每月现场有特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89bcfc24.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('9', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】家用洗衣机，图片仅供参考', '', '1.00', '/upload/goods_img/大家电/5db3b89be0d98.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('10', '邮乐安阳馆', '【滑县积分用户专享】创维电器洗衣机9公斤波轮安阳', '', '1.00', '/upload/goods_img/大家电/5db3b89bee474.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('11', '邮乐安阳馆', '美菱3开门冰箱BCD-209M3CX【汤阴县积分兑换专用，其他下单不发货】', '', '1.00', '/upload/goods_img/大家电/5db3b89c06586.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('12', '邮乐安阳馆', '美菱电冰箱209L3CS【安阳县积分兑换用户专用，其他地区发】', '', '1.00', '/upload/goods_img/大家电/5db3b89c16f2a.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('13', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】自动洗衣机 家用洗衣机，图片仅供参考', '', '2.00', '/upload/goods_img/大家电/5db3b89c22e95.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('14', '邮乐安阳馆', '【滑县积分用户专享】创维电器电视50寸4K智能安阳', '', '3.00', '/upload/goods_img/大家电/5db3b89c2bb37.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('15', '邮乐安阳馆', '【安阳县积分用户专享】长虹液晶电视55U1', '', '3.00', '/upload/goods_img/大家电/5db3b89f48109.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('16', '海信电器旗舰店', '海信（Hisense）HZ32E30D 32英寸蓝光高清平板液晶电视机 酒店宾馆卧室推荐', '【海信今日限时特惠-到手价788元！】限量200台！抢完即止！', '749.00', '/upload/goods_img/大家电/5db3b89f51194.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('17', '邮滋味如皋馆专柜', '邮乐特卖：庭美家用消毒柜    型号：YTP-280    如皋免费送货上门，南通包邮，华东地区配送', '庭美消毒柜，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '755.00', '/upload/goods_img/大家电/5db3b89f5ec57.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('18', '吉舜诚商城专柜', '飞利浦（PHILIPS）  19英寸液晶电视机 显示器两用 hdmi高清接口', '19PFF2650', '799.00', '/upload/goods_img/大家电/5db3b89fb14ba.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('19', '创维集团官方旗舰店', '创维/SKYWORTH 32X3 32英寸窄边非智能老人机蓝光高清节能LED平板液晶电视机工程机', '蓝光高清，经典窄边，节能液晶，简单好用，谁用谁知道，实用耐用款', '799.00', '/upload/goods_img/大家电/5db3b89fc8fa8.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('20', '吉舜诚商城专柜', '飞利浦（PHILIPS）22英寸LED高清液晶平板电视机含底座 黑色', '22PFF2650/T3', '899.00', '/upload/goods_img/大家电/5db3b89fd917b.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('21', '创维集团官方旗舰店', '创维/SKYWORTH 32X6 32英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠，高清智能电视，WIFI，酷开系统，10核处理器', '899.00', '/upload/goods_img/大家电/5db3b89fe6086.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('22', '海信电器旗舰店', '海信 (Hisense) HZ32E35A 32英寸AI智能WIFI 轻薄金属 卧室神器高清电视机', '', '899.00', '/upload/goods_img/大家电/5db3b8a0004c2.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('23', '邮滋味如皋馆专柜', '创维邮乐特卖： 32寸液晶电视机，型号：32E381S   如皋免费送货上门，南通包邮，华东地区配货', '创维液晶电视大品牌，夏季特惠；每月现场有特惠活动', '899.00', '/upload/goods_img/大家电/5db3b8a01be30.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('24', '琥麟电器专柜', '海信 XQB60-H3568 6公斤全自动波轮洗衣机', '', '749.00', '/upload/goods_img/大家电/5db3b8a0279b3.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('25', '邮滋味如皋馆专柜', '创维7公斤全自动波轮洗衣机，型号：XQB70-21C淡雅银，如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '928.00', '/upload/goods_img/大家电/5db3b8a0367fe.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('26', '邮滋味如皋馆专柜', '创维单冷冰柜，型号：BD/C-160雅白，如皋地区免费送货上门安装，南通地区包邮，华东地区配货', '创维冰柜，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '999.00', '/upload/goods_img/大家电/5db3b8a042f39.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('27', '创维集团官方旗舰店', '创维（SKYWORTH）32H5 32英寸高清HDR 护眼全面屏 AI人工智能语音 网络WIFI 卧', '高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '999.00', '/upload/goods_img/大家电/5db3b8a0511cd.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('28', '邮滋味如皋馆专柜', '创维/SKYWORTH热水器，型号：DSZF-D5501-80，如皋免费送货上门，南通包邮 创维/', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '999.00', '/upload/goods_img/大家电/5db3b8a07389d.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('29', '琥麟电器专柜', 'Hisense/海信 HB80DA332G8KG公斤大容量家用全自动节能波轮洗衣机', '', '899.00', '/upload/goods_img/大家电/5db3b8a386615.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('30', '琥麟电器专柜', '海信 BCD-163N/B 冰柜冷藏冷冻双温家用商用小型卧式', '', '999.00', '/upload/goods_img/大家电/5db3b8a390a27.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('31', '吉舜诚商城专柜', '东芝（TOSHIBA）  32英寸 蓝光液晶电视 高清平板电视机 东芝电视机', '32L1500C', '1.00', '/upload/goods_img/大家电/5db3b8a69aafd.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('32', '创维集团官方旗舰店', '创维/SKYWORTH 40X6 40英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠！高清智能，10核处理器，可以WIFI上网', '1.00', '/upload/goods_img/大家电/5db3b8a9a6b14.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('33', '甲子商城旗舰店', '康佳/KONKA  LED39E330C 39英寸卧室电视高清蓝光节能平板液晶电视', '', '949.00', '/upload/goods_img/大家电/5db3b8a9b22ae.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('34', '邮乐赣州馆', '【不支持邮乐卡支付】创维-彩电-40E1C 40英寸全高清HDR 护眼全面屏 AI人工智能语音', '', '1.00', '/upload/goods_img/大家电/5db3b8a9cf38d.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('35', '琥麟电器专柜', '海信 BCD-177F/Q 177升 双门冰箱', '', '1.00', '/upload/goods_img/大家电/5db3b8a9f0abd.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('36', '创维集团官方旗舰店', '创维/SKYWORTH 43X6 43英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '【买电视选创维】高清智能，10核处理器，质量上乘，价格厚道，可以Wifi上网', '1.00', '/upload/goods_img/大家电/5db3b8aa1b4b4.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('37', '创维集团官方旗舰店', '创维（SKYWORTH）40H5 40英寸全高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '全高清HDR 护眼全面屏 AI人工智能语音', '1.00', '/upload/goods_img/大家电/5db3b8aa26c4f.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('38', '邮乐安阳馆', '市区积分用户专享】创维平板电视32X6', '', '1.00', '/upload/goods_img/大家电/5db3b8aa31c19.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('39', '吉舜诚商城专柜', '飞利浦（PHILIPS）32英寸新品高清LED电视 接口丰富窄边高清LED液晶平板电视机', '32PHF3282/T3', '1.00', '/upload/goods_img/大家电/5db3b8aa3b85c.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('40', '琥麟电器专柜', '海信 BD/BC-308NU/A 冰柜家用 顶开式卧式商用冷藏冷冻柜', '', '1.00', '/upload/goods_img/大家电/5db3b8aa4931f.jpg', '1572059510', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('41', '明凰服饰专营店', '男女冲锋衣工装棉服外套修身加厚款', '邮乐支持微信，支付宝，网银，邮储卡和银联卡支付。（不同商品请分开下单）', '85.00', '/upload/goods_img/户外服饰/5db3b8b22c022.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('42', '户外途量工厂专卖店', '春夏季运动风衣钓鱼防晒衣男女超薄透气皮肤衣防风外套户外速干潮流衣服情侣款皮肤衣', '大码骑行长袖', '29.90', '/upload/goods_img/户外服饰/5db3b8b23604c.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('43', '探路者正江专卖店', '探路者/TOREAD 冲锋裤 运动裤 秋冬户外软壳裤男透气防风保暖徒步裤KAMG91159', '', '428.00', '/upload/goods_img/户外服饰/5db3b8b25312b.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('44', '探路者正江专卖店', '探路者运动服 探路者冲锋衣 19秋冬户外女式防水透湿套绒冲锋衣TAWH92285', '', '839.00', '/upload/goods_img/户外服饰/5db3b8b25d925.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('45', '好看哒专营店', '防晒衣女中长款薄款防晒服', 'FSY-6387', '45.00', '/upload/goods_img/户外服饰/5db3b8b56628b.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('46', '宝仕母婴专营店专柜', 'L户外皮肤衣防紫外线防晒衣男女夏季超薄透气防晒服运动风衣', '', '75.00', '/upload/goods_img/户外服饰/5db3b8b573966.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('47', '好看哒专营店', '防晒衣女夏季新款韩版连帽系带长袖防晒衣糖果色沙滩户外披肩防晒衣', 'FSY-54', '19.90', '/upload/goods_img/户外服饰/5db3b8b88f380.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('48', '户外途量工厂专卖店', '户外速干T恤男 女休闲跑步运动健身短袖大码情侣快干衣排汗透气', '', '22.80', '/upload/goods_img/户外服饰/5db3b8b8abc8f.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('49', '好看哒专营店', '防晒衣 户外薄款防紫外线印花防晒衣', 'FSY-1736', '25.00', '/upload/goods_img/户外服饰/5db3b8b8c0c84.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('50', '好看哒专营店', '防晒衣夏季女蝙蝠袖连帽拉链短款防晒衣', 'FSY-5423', '35.00', '/upload/goods_img/户外服饰/5db3b8b9b16a1.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('51', '好看哒专营店', '防晒衣男士薄款纯色连帽防晒衣', 'FSY-4167', '35.00', '/upload/goods_img/户外服饰/5db3b8b9bbe9c.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('52', '户外途量工厂专卖店', '城徒 户外春夏单层冲锋衣女防晒衣男轻薄防风钓鱼服透气速干外套长袖衫', '', '35.80', '/upload/goods_img/户外服饰/5db3b8ba1b847.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('53', '好看哒专营店', '防晒衣韩版短款薄款连帽长袖防晒衣', 'FSY-5439', '36.00', '/upload/goods_img/户外服饰/5db3b8ba72314.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('54', '好看哒专营店', '防晒衣女中长款涂鸦薄款防晒衣', 'FSY-5282', '36.00', '/upload/goods_img/户外服饰/5db3b8ba99fd5.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('55', '好看哒专营店', '防晒衣女中长款薄款防晒衣', 'FSY-5456', '37.90', '/upload/goods_img/户外服饰/5db3b8baa8e20.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('56', '户外途量工厂专卖店', '秋冬户外男抓绒衣摇粒绒女外套保暖冲锋衣内胆开衫卫衣', '', '39.00', '/upload/goods_img/户外服饰/5db3b8bab267b.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('57', '户外途量工厂专卖店', '户外秋冬季加绒加厚抓绒衣男女摇粒绒保暖抓绒外套开衫冲锋衣内胆', '', '49.00', '/upload/goods_img/户外服饰/5db3b8bae0cb5.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('58', '江门新会馆', '【江门新会馆】caxa断码 两截速干裤女 韩版修身透气徒步快干裤野外登山跑步长裤', '', '50.00', '/upload/goods_img/户外服饰/5db3b8baf06b9.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('59', '宝仕母婴专营店专柜', 'L夏季休闲短裤男宽松5分中裤子男士运动五分裤大码跑步速干沙滩裤', '', '55.00', '/upload/goods_img/户外服饰/5db3b8bb2ba54.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('60', '江门新会馆', '【江门新会馆】caxa修身户外健身速干裤女 快干弹力透气登山大码长裤 弹力户外裤', '', '60.00', '/upload/goods_img/户外服饰/5db3b8bb513ed.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('61', '探路者正江专卖店', '探路者/TOREADt恤女户外夏季快干速干透气运动服TAJG82984', '', '61.00', '/upload/goods_img/户外服饰/5db3b8bb5ac47.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('62', '铁好家居美妆日用百货专营店', '佳钓尼 夏遮阳防晒帽套头面罩透气防紫外线渔夫帽', '', '48.00', '/upload/goods_img/户外服饰/5db3b8bb8e0a3.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('63', '宝仕母婴专营店专柜', '防晒衣男女情侣春夏季防雨风衣超薄透气速干钓鱼防晒服户外皮肤衣MN', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bb9f9e7.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('64', '户外途量工厂专卖店', '城徒 春夏季速干裤男女大码轻薄快干透气户外修身显瘦弹力冲锋裤', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbb3e24.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('65', '宝仕母婴专营店专柜', 'L运动户外夏季速干t恤 男女短袖速干衣快干t恤 吸汗透气', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbe33ff.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('66', '宝仕母婴专营店专柜', 'L健身房教练速干T恤男女 圆领情侣夏季短袖汗衫', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bc1bca2.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('67', '户外途量工厂专卖店', '城徒 冬季正品户外冲锋裤男女抓绒裤保暖防风防水加厚软壳裤登山裤长裤', '', '75.00', '/upload/goods_img/户外服饰/5db3b8bc42dab.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('68', '江门新会馆', '【江门新会馆】caxa修身弹力女款休闲棉裤 户外休闲快干长裤 女士跑步登山健身裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bc96997.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('69', '江门新会馆', '【江门新会馆】caxa休闲修身速干裤 透气轻薄运动裤耐磨健身户外裤多袋裤七分裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bcac92c.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('70', '探路者正江专卖店', '探路者/TOREAD 运动服 短袖户外女运动跑步排汗透气圆领速干T恤TAJF82784', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bcc53b9.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('71', '户外途量工厂专卖店', '冲锋裤男户外秋冬防风防水软壳裤女加绒加厚抓绒裤保暖徒步登山裤', '', '79.00', '/upload/goods_img/户外服饰/5db3b8bd362c1.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('72', '探路者正江专卖店', '探路者/TOREADT恤女 夏户外女式超轻透气速干衣圆领T恤短袖KAJG82352', '', '99.00', '/upload/goods_img/户外服饰/5db3b8bd44554.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('73', '探路者正江专卖店', '探路者/TOREAD 短袖 18春夏新款户外女式圆领速干透气印花短袖T恤TAJG82939', '', '99.00', '/upload/goods_img/户外服饰/5db3b8bd602ab.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('74', '探路者正江专卖店', '探路者/TOREAD夏新款户外运动透气弹力速干女式半袖短袖T恤KAJG82310', '', '99.00', '/upload/goods_img/户外服饰/5db3b8be68f86.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('75', '探路者正江专卖店', '探路者/TOREAD T恤女款 秋季户外短袖女时尚速干透气短袖T恤TAJG82938', '', '99.00', '/upload/goods_img/户外服饰/5db3b8be96a09.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('76', '洋湖轩榭官方旗舰店', '洋湖轩榭 春秋季新款中老年男装连帽冲锋衣爸爸装休闲夹克衫外套男A', '钜惠双十一 感恩惠顾', '126.42', '/upload/goods_img/户外服饰/5db3b8bea6025.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('77', '南城百货专营店', '秋冬季加绒加厚冲锋衣男女三合一可拆卸两件套防水户外情侣登山服', '秋冬季加绒加厚冲锋衣男女三合一可拆卸两件套防水户外情侣登山服', '158.00', '/upload/goods_img/户外服饰/5db3b8bede68a.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('78', '正江服饰专营店', '包邮韵格NT1021男士紧身训练PRO运动健身跑步长袖弹力速干服纯色衣服', '', '59.00', '/upload/goods_img/户外服饰/5db3b8beeb97d.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('79', '流行饰品运动户外器械', '汤河店 户外冲锋裤男女可脱卸秋冬季加绒加厚保暖软壳防风防水登山滑雪裤', '', '179.00', '/upload/goods_img/户外服饰/5db3b8bf07cf9.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('80', '流行饰品运动户外器械', '汤河店 韩国正品vvc防晒衣女经典薄夏季中长款防晒服户外防紫外线皮肤衣', '', '499.00', '/upload/goods_img/户外服饰/5db3b8bf2bf21.jpg', '1572059516', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('81', '乐颐汇数码专营店', '荣耀10青春版 幻彩渐变 2400万AI自拍 全网通版4GB+64GB', '2400万AI高清自拍，麒麟710处理器，炫光渐变色', '989.00', '/upload/goods_img/手机数码/5db3b8700e46c.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('82', '乐颐汇数码专营店', '华为/HUAWEI 畅享9 手机 全网通 4GB+128GB', '6.26英寸珍珠屏 4000mAh大电池', '1099.00', '/upload/goods_img/手机数码/5db3b8731cf7b.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('83', '米果商贸专柜', '折叠式平板电脑支架底座懒人手机支架【颜色随机发货】', '', '9.90', '/upload/goods_img/手机数码/5db3b87337179.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('84', '邮乐韵菲专营店', '（亏本促销）车载手机支架双面吸盘式家居懒人多功能通用可弯曲创意手机支架', '', '1.00', '/upload/goods_img/手机数码/5db3b87345fc4.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('85', '麦尚科技专营店', '手机支架懒人支架卡通创意平板电脑桌面支撑座【款式随机】', '', '9.90', '/upload/goods_img/手机数码/5db3b8734f81e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('86', '邮乐韵菲专营店', '无线蓝牙耳机迷你超小苹果安卓通用耳机', '送两条充电线+一个收纳盒', '15.90', '/upload/goods_img/手机数码/5db3b873b60d7.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('87', '万品好易购商城', 'XO NB23 八角宝石锌合金数据线', '产品颜色：黑色  白色 宝石外观 不拘一格;  锌合金 更出色；  2.4A极速充电，高效传输文件', '49.00', '/upload/goods_img/手机数码/5db3b873bf931.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('88', '万品好易购商城', 'XO F1 户外Mini蓝牙音箱 经典挂扣 防水 防尘/防摔 抗干扰性强 无线链接 免提通话', '音量调节/音乐播放、暂停/上下曲切换 语音报号/来电铃声/数据输出/直读SD卡', '99.00', '/upload/goods_img/手机数码/5db3b873d7806.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('89', '万品好易购商城', 'XO  PB39 移动电源 8000mAh', '8000mAh大容量 双输出带LED灯  ； 电源保护, 好用更安全； 智能分流 高效输出', '119.00', '/upload/goods_img/手机数码/5db3b8740878f.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('90', '万品好易购商城', 'XO BS8 运动蓝牙耳机源于经典 加以升级 鲨鱼鳍耳翼 舒适牢固', '源于经典 加以升级； 鲨鱼鳍耳翼 舒适牢固 ； 无惧雨水  防水防汗； 蓝牙4.2版本，深度降噪', '169.00', '/upload/goods_img/手机数码/5db3b87419133.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('91', '万品好易购商城', 'XO BS7 运动蓝牙耳机 深度降噪 通话更清晰 轻松操控 随意切换', '强劲的CSR芯片 提升续航能力； 蓝牙4.1版本，深度降噪，通话更清晰； 霍尔磁控开关，智能感应', '199.00', '/upload/goods_img/手机数码/5db3b8742586e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('92', '万品好易购商城', 'XO A8 蓝牙音箱 智能触控 自由切换 大容量电池 可连续播放约4-6小时 土豪金 星空银 银色', '智能触控，自由切换； 内置1000毫安聚合物电池，全频高清喇叭+低音振膜,可连续播放约4-6小时', '169.00', '/upload/goods_img/手机数码/5db3b874390f2.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('93', '普润家居专营店', 'oppo蓝牙耳机迷你vivo超小隐形运动通用华为无线耳塞超长待机开车', '', '79.00', '/upload/goods_img/手机数码/5db3b874496ae.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('94', '木易生活专柜', '2米超长  美能格  苹果安卓Type-C数据线 2.4A快充电线', '2米超长  美能格  苹果安卓Type-C数据线 2.4A快充电线', '12.90', '/upload/goods_img/手机数码/5db3b874588e2.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('95', '木易生活专柜', '沃晟伦蓝牙耳机M165蓝牙耳机入耳式商务车载便携式4.1*', '沃晟伦蓝牙耳机M165蓝牙耳机入耳式商务车载便携式4.1', '15.90', '/upload/goods_img/手机数码/5db3b8746c166.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('96', '北京信酷数码商城专柜', 'iPhone 苹果原装充电器套装/数据线+充电头电源适配器 通用型', '【全国包邮】 充电套装更优惠', '69.00', '/upload/goods_img/手机数码/5db3b874784b9.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('97', '小牛数码家居专柜', '飞利浦/PHILIPS 多功能可伸缩车载手机支架DLK35002', '多功能可伸缩车载手机支架', '68.00', '/upload/goods_img/手机数码/5db3b87484bf4.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('98', '北京信酷数码商城专柜', '苹果 iphone X /XS MAX/XS/XR/钢化膜 全屏全覆盖 手机贴膜', '', '19.00', '/upload/goods_img/手机数码/5db3b87493e28.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('99', '邮乐萍乡馆', '南孚(NANFU)3V纽扣电池两粒 CR2032/CR2025/CR2016锂电池电子汽车钥匙遥控', '奔驰c200l福特 新蒙迪欧 高尔夫7 新马自达昂克赛拉阿特兹 手表奔驰大众汽车钥匙电池', '9.90', '/upload/goods_img/手机数码/5db3b874a670c.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('100', '信酷小米专营店', '小米（MI） 车载充电器快充版 QC3.0 双口输出 智能温度控制 兼容iOS和Android设备', '小米正品 全国包邮', '89.00', '/upload/goods_img/手机数码/5db3b874b8050.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('101', '北京信酷数码商城专柜', '苹果 iPhone6/6S/6Plus/6SPlus/iPhone7/7P防爆钢化玻璃膜高清手机贴膜', '进口AGC玻璃板！超薄钢化玻璃膜！秒杀国产玻璃！', '26.00', '/upload/goods_img/手机数码/5db3b874c207b.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('102', '北京信酷数码商城专柜', 'OPPO手机原装耳机R11/PLUS入耳式线控r11s/r15耳机 白色盒装', '', '38.80', '/upload/goods_img/手机数码/5db3b874d31ef.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('103', '北京信酷数码商城专柜', '华为（HUAWEI）小天鹅无线蓝牙免提通话音箱4.0 便携户外/车载迷你音响AM08', '音·触即发！360°音效技术，音质真实自然，简洁触控操作，支持蓝牙免提通话。', '95.00', '/upload/goods_img/手机数码/5db3b874e280a.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('104', '北京信酷数码商城专柜', '三星 32G内存卡(CLASS10 48MB/s)  手机内存卡32g MicroSD存储卡', '正品行货 支持专柜验货 实行三包政策 轻放心购买', '95.00', '/upload/goods_img/手机数码/5db3b874edfa5.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('105', '北京信酷数码商城专柜', '华为/HUAWEI 华为快速充电套装 4.5V/5A充电头+type-c线  华为充电器', '支持p20/mate10/9pro/p10plus荣耀10/v10/note10等机型', '98.00', '/upload/goods_img/手机数码/5db3b87504947.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('106', '北京信酷数码商城专柜', '小米（MI）小米手环2（黑色）智能运动 防水 心率监测 计步器 久坐提醒', '正品行货 全国包邮', '159.00', '/upload/goods_img/手机数码/5db3b875133ab.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('107', '信酷小米专营店', '小米活塞耳机 清新版 黑色 蓝色 入耳式手机耳机 通用耳麦', '小米正品 全国包邮', '45.00', '/upload/goods_img/手机数码/5db3b8751ef2e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('108', '信酷小米专营店', '小米支架式自拍杆 灰色 黑色 蓝牙遥控迷你便携带三脚架多功能', '小米正品 全国包邮', '105.00', '/upload/goods_img/手机数码/5db3b875327b2.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('109', '信酷小米专营店', '小米（MI）方盒子蓝牙音箱2 无线迷你随身户外便携客厅家用小音响', '小米正品 全国包邮', '149.00', '/upload/goods_img/手机数码/5db3b87546807.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('110', '信酷小米专营店', '小米（MI）小米运动蓝牙耳机mini 黑色白色 无线蓝牙入耳式运动耳机', '小米正品 全国包邮', '169.00', '/upload/goods_img/手机数码/5db3b8755a85b.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('111', '信酷小米专营店', '小米（MI）小钢炮2代 无线蓝牙便携音箱', '小米正品 全国包邮', '139.00', '/upload/goods_img/手机数码/5db3b87564c6e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('112', '铁好家居美妆日用百货专营店', '公牛BULL 独立3孔位2USB创意魔方插座 1.5米线GN-UUB122【热卖推荐】', '立体集成结构 小巧轻便 五重保护', '67.00', '/upload/goods_img/手机数码/5db3b87575612.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('113', '九洲科瑞数码专营店', '华为 HUAWEI 畅享9 Plus 4GB+128GB', '', '1.00', '/upload/goods_img/手机数码/5db3b8758639e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('114', '九洲科瑞数码专营店', '华为HUAWEI nova4 4800万超广角三摄8GB+128GB', '', '2.00', '/upload/goods_img/手机数码/5db3b875932a9.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('115', '九洲科瑞数码专营店', '华为 HUAWEI P30 Pro 徕卡四摄10倍混合变焦麒麟980芯片屏内指纹 8GB+128G', '', '4.00', '/upload/goods_img/手机数码/5db3b8759d6bb.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('116', '邮乐萍乡馆', '南孚 安卓数据线 NF-LM001 小米华为OPPO三星vivo充电器通用', '', '9.90', '/upload/goods_img/手机数码/5db3b875a923e.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('117', '铁好家电数码专营店', '公牛BULL 二合一苹果lighting+micro USB数据线GN-J81N【热卖推荐】', 'MFi官方认证，快速充电，抗折断', '69.00', '/upload/goods_img/手机数码/5db3b875b2e80.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('118', '邮乐萍乡馆', '南孚(NANFU)LR6AA聚能环 5号+7号碱性干电池【共4粒装】', '', '9.90', '/upload/goods_img/手机数码/5db3b875be233.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('119', '岳灵生活专营店', '南孚手机充电宝 10000毫安大容量礼盒装NFCT10', '', '169.00', '/upload/goods_img/手机数码/5db3b875cad56.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('120', '邮乐萍乡馆', '南孚(NANFU)LR03AAA聚能环7号电池碱性干电池12粒装儿童玩具遥控器赛车闹钟智能门锁电池', 'AAA干电池持久电力家用', '27.80', '/upload/goods_img/手机数码/5db3b875d3610.jpg', '1572059524', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('121', '中国农垦官方旗舰店', '买2份送一份【中国农垦】黑龙江北大荒  支豆浆粉早餐豆浆粉 非转基因大豆 五谷豆浆粉28g*10袋', '早餐豆粉买2份送一份', '18.00', '/upload/goods_img/特色美食/5db3b8d338ebc.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('122', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒支装豆浆粉（醇豆浆、红枣味可选） 非转基因大豆', '早餐豆粉买2份送一份', '15.00', '/upload/goods_img/特色美食/5db3b8d3432ce.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('123', '牛牛食品专营店', '(8月新货)蒙牛小真果粒125ml*20盒草莓味果粒酸奶小胖丁迷你装', '8月份的新货,超好喝，儿童，果粒，健康营养，', '22.70', '/upload/goods_img/特色美食/5db3b8d34deb1.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('124', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒 支装豆浆粉 麦香甜豆浆粉 28g*10袋', '早餐豆粉买2份送一份', '15.00', '/upload/goods_img/特色美食/5db3b8d3651ce.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('125', '禾煜食品旗舰店', '禾煜 黄冰糖418g包  冰糖土冰糖  煲汤食材', '黄冰糖买2送1', '15.00', '/upload/goods_img/特色美食/5db3b8d66e304.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('126', '新农哥旗舰店', '【新农哥】板栗仁108gx4袋  休闲零食小吃', '', '26.90', '/upload/goods_img/特色美食/5db3b8d6832f9.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('127', '新农哥旗舰店', '新农哥 每日坚果 混合果仁 缤纷坚果仁175g*2盒  休闲零食', '缤纷美味 一吃钟情', '59.90', '/upload/goods_img/特色美食/5db3b8d68e2c4.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('128', '众天蜂蜜邮乐农品旗舰店', '众天山花蜂蜜500g', '秦岭深处 百花酿造而成 最受欢迎的蜂蜜 性价比极高！', '19.90', '/upload/goods_img/特色美食/5db3b8d6a2ed1.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('129', '中国农垦官方旗舰店', '【中国农垦】黑龙江 北大荒 非转基因大豆 豆浆粉 红枣豆浆粉28g*10袋', '早餐豆粉买2份送一份', '18.00', '/upload/goods_img/特色美食/5db3b8d6ae283.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('130', '考拉小哥专营店', '薛小贱 每日坚果25g*1包', '厂家直供、7种混合、日期新鲜', '1.66', '/upload/goods_img/特色美食/5db3b8d6b8e66.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('131', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂五宝茶 益本茶 男人茶养生茶 草本', '【萃涣堂】五宝益本茶 男人茶买2送1五宝茶男人茶枸杞茶玛咖片黄精男肾茶老公八宝茶养生茶 做性福的男人', '19.00', '/upload/goods_img/特色美食/5db3b8d6c8481.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('132', '萃涣堂蒲公英茶专柜', '【滨州馆】寻味山东新鲜现做手工 滨州黑芝麻红枣饼核桃 枸杞传统工艺 香甜可口 10g独立装包邮', '寻味山东 新鲜现做手工滨州黑芝麻红枣饼核桃 枸杞传统工艺 香甜可口 10g独立装包邮', '1.00', '/upload/goods_img/特色美食/5db3b8d6cc302.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('133', '正江食品专营店', '寿全斋  红枣姜茶 姜茶 12g*10条', '', '25.00', '/upload/goods_img/特色美食/5db3b8d6debe7.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('134', '阿坝州理县地方扶贫馆', '四川浓香菜籽油 5升农家非转基因5l纯菜子粮油食用油约10斤植物油', '2019新油，滴滴香浓，四川非转基因纯菜籽油', '66.00', '/upload/goods_img/特色美食/5db3b8d6f246b.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('135', '千岛湖品牌农产品馆', '千岛湖 千岛渔娘 糍粑（4味）200g', '买二赠一 糍粑', '15.00', '/upload/goods_img/特色美食/5db3b8d706ecd.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('136', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂 金菊饮 菊花枸杞茶 菊花茶叶贡菊散装杭枸杞菊花茶非解毒去火清热凉茶', '【滨州馆】萃涣堂 金菊饮 菊花枸杞茶 菊花茶叶贡菊散装杭枸杞菊花茶非解毒去火清热凉茶', '0.50', '/upload/goods_img/特色美食/5db3b8d713dd8.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('137', '果蔻食品专营店', '果蔻 每日坚果B款20g/包简装无礼盒成人儿童孕妇混合果仁坚果零食大礼包', '科学配比  营养美味', '1.39', '/upload/goods_img/特色美食/5db3b8d729985.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('138', '萃涣堂蒲公英茶专柜', '【滨州馆】萃涣堂 黑苦荞茶 5克/袋 苦荞茶正品 大凉山', '【滨州馆】萃涣堂 黑苦荞茶 5克/袋 苦荞茶正品 大凉山', '0.50', '/upload/goods_img/特色美食/5db3b8d736890.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('139', '佳林院红枣旗舰店', '【0.4元/袋佳林院泡茶煮粥煲汤枣圈】山东特产乐陵红枣每袋约12克袋装50袋起拍包邮部分偏远地区除外', '佳林院品牌装，泡茶煮粥枣圈，拼团价0.4元/袋，每袋约12克装，50袋起拍，食用方便，经济实惠！', '0.40', '/upload/goods_img/特色美食/5db3b8d798327.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('140', '果蔻食品专营店', '果蔻 每日坚果25g*1包成人儿童孕妇混合坚果混合果仁小吃零食', '', '1.65', '/upload/goods_img/特色美食/5db3b8d7aa43b.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('141', '萃涣堂蒲公英茶专柜', '【滨州馆】红枣黑糖姜茶大姨妈水姜糖女老姜块生姜姜汁姜汤红糖姜枣茶小袋装25克/袋', '姜味浓,红枣多,顺畅暖暖,效果杠杠“冬吃萝卜夏吃姜。”传统组方真材实料。', '0.90', '/upload/goods_img/特色美食/5db3b8dab8392.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('142', '南阳专区专营店', '南阳西峡现摘金桃黄心猕猴桃15枚 （单枚60g-90g）买一送一 共30枚，合并发一箱', '买一赠一活动', '19.90', '/upload/goods_img/特色美食/5db3b8dac3745.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('143', '果然好口福专柜', '宁 福吉 5斤起拍新疆原味生核桃新货 特产薄皮核桃 坚果炒货休闲零食包邮', '新疆薄皮核桃  送夹子', '9.90', '/upload/goods_img/特色美食/5db3b8daea466.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('144', '刘陶生鲜旗舰店', '刘陶 福建红肉柚子红心蜜柚8.5-9.5斤（3-4个装） 新鲜水果2', '', '25.50', '/upload/goods_img/特色美食/5db3b8db3a40e.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('145', '丹东邮政农特产品专营店', '2019年丹东新鲜板栗4斤东北农家生板栗毛栗子现摘栗子应季水果干', '', '19.90', '/upload/goods_img/特色美食/5db3b8db3a7f6.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('146', '果然好口福专柜', '宁福吉 新疆和田大枣煲粥枣500克包邮', '', '6.60', '/upload/goods_img/特色美食/5db3b8db578d5.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('147', '小呆妞旗舰店', '预售小呆妞四川蒲江金艳黄心猕猴桃90-110g中果24枚 72内小时发货', '关于售后：签收24小时内后台申请退款请提供坏果和快递单合照，会根据实际损坏赔付', '27.90', '/upload/goods_img/特色美食/5db3b8db63c28.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('148', '萃涣堂蒲公英茶专柜', '萃涣堂茉莉绿茶三角茶包袋茉莉花茶小袋装绿茶袋泡冷泡茶包伴手礼花茶茶包组合玫瑰茉莉绿茶袋泡三', '萃涣堂茉莉绿茶三角茶包袋茉莉花茶小袋装绿茶袋泡冷泡茶包', '0.90', '/upload/goods_img/特色美食/5db3b8db71303.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('149', '丹东邮政农特产品专营店', '新鲜现挖番薯红黄心密署农家自种蒸煮粉糯香甜沙地地瓜烤烟署5斤', '', '16.80', '/upload/goods_img/特色美食/5db3b8db862f8.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('150', '川锅壹号旗舰店', '川锅壹号辣白菜228g韩国泡菜下饭菜正宗朝鲜口味拌饭菜版面菜', '酸辣可口 老少皆宜', '5.90', '/upload/goods_img/特色美食/5db3b8dbcdf79.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('151', '福香御旗舰店', '福香御 慢生长2018东北大米雪花米10斤真空包邮色选米', '初霜收割，180天慢生长周期，30天鲜磨直达，大米胚乳含量极为丰富，口感软糯香甜。', '27.90', '/upload/goods_img/特色美食/5db3b8dbdb26c.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('152', '兰州鲜合苑百合特产店专营店', '现包现发100%新鲜正宗兰州市七里河区产兰州鲜百合3年生兰州百合农家甜百合，约16颗百合一斤', '兰州鲜百合，无任何添加剂，宝宝也可以放心食用', '19.90', '/upload/goods_img/特色美食/5db3b8dbe8d2f.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('153', '当季鲜果', '黄金奇异果12枚包邮（中果70-90克，拍2件多送6枚，合并发30枚）金艳黄心猕猴桃新鲜水果', '快递随机，不能指定快递，下单后72小时内发货，下雨天顺延，购买前请阅读售后要求，介意慎拍', '9.90', '/upload/goods_img/特色美食/5db3b8dc0be0c.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('154', '丹东邮政农特产品专营店', '东北特产老品种大米  凤城蓝乡生态米 10斤 珍珠米 非蟹田', '东北特产老品种大米  凤城蓝乡生态米 10斤 珍珠米 非蟹田', '28.80', '/upload/goods_img/特色美食/5db3b8dc17d77.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('155', '川锅壹号旗舰店', '川锅壹号蟹黄酱拌饭酱秃黄油拌面酱蟹粉酱蟹黄膏酱料即食螃蟹酱', '金脂香软 经典美味', '9.90', '/upload/goods_img/特色美食/5db3b8dc2c59c.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('156', '刘陶生鲜旗舰店', '刘陶 云南昭通丑苹果5斤大果（13-15个）新鲜水果', '拼团的亲想更加快的发货，尽量和已经开团的亲拼团购买', '27.00', '/upload/goods_img/特色美食/5db3b8dc365c6.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('157', '福香御旗舰店', '福香御 大米5kg装2018新米圆粒珍珠米寿司香米秋田小町农家东北大米包邮', '', '29.99', '/upload/goods_img/特色美食/5db3b8de5a091.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('158', '刘陶生鲜旗舰店', '刘陶 云南石林人生果圆果净果5斤（25-35个）大果新鲜水果2', '拼团的亲想更加快的发货，尽量和已经开团的亲拼团购买', '25.00', '/upload/goods_img/特色美食/5db3b8de6ec9e.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('159', '刘陶生鲜旗舰店', '刘陶 福建红肉柚子红心蜜柚8.5-9.5斤（3-4个装） 新鲜水果特卖', '', '25.50', '/upload/goods_img/特色美食/5db3b8de7ac09.jpg', '1572059535', '0', '1');
INSERT INTO `xy_goods_list_copy` VALUES ('160', '萃涣堂蒲公英茶专柜', '【萃涣堂】 蜜桃乌龙茶  水果茶 三角包共蜜桃白桃乌龙茶袋泡花茶包花', '新品上市!独立三角袋泡茶,携带冲泡更便捷!【萃涣堂】 蜜桃乌龙茶 水果茶 三角包', '0.90', '/upload/goods_img/特色美食/5db3b8de97517.jpg', '1572059535', '0', '1');

-- ----------------------------
-- Table structure for xy_index_msg
-- ----------------------------
DROP TABLE IF EXISTS `xy_index_msg`;
CREATE TABLE `xy_index_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `content` text NOT NULL COMMENT '文本内容',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1平台公告 2平台简介 3抢单规则 4代理合作 5常见问题',
  `addtime` int(10) NOT NULL COMMENT '发表时间',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0发布 1不发布',
  `author` varchar(10) NOT NULL DEFAULT '' COMMENT '作者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='首页内容表';

-- ----------------------------
-- Records of xy_index_msg
-- ----------------------------
INSERT INTO `xy_index_msg` VALUES ('1', '平台公告', '尊敬的会员，您好！关于微信转卡/支付宝转卡，异地转账出现风控问题。由于支付宝，微信属于三方支付软件， 公信部为防止洗黑钱，有此类问题均属于正常现象，请您不用担心，建议您使用手机银行进行充值，简单快捷，祝您生活愉快！', '3', '1582141939', '1', 'admin');
INSERT INTO `xy_index_msg` VALUES ('2', '平台简介', '<p>尊敬的用户</p>\r\n\r\n<p>平台每天都会将需要提高曝光度的商家产品放到平台上，提供给平台用户进行抢单。为了规避网购平台的检测，提高订单的真实性，新用户在抢单前必须先完善个人真实信息，并填写真实的收货地址。 为了有效的帮助商家提升订单成功率， 规避商家被检查到虚假订单的风险，平台将会根据您当前的操作IP，设备型号对当天的订单进行优化匹配。所有订单匹配均需要通过智能云算法实现， 请您耐心等待。</p>', '3', '1582142053', '1', 'admin');
INSERT INTO `xy_index_msg` VALUES ('3', '抢单规则', '<p>尊敬的用户你好</p>\r\n\r\n<p>平台为了防止有人恶意进行洗黑钱或者套现一系列不法行为，会员账户未完成60单以上的提现金额为账户的10%，会员需完成60单方可全额提现，提现审核成功后，到账时间为D+1(次日24点前）到账，具体到账时间以银行为准！</p>', '3', '1582142085', '1', 'admin');
INSERT INTO `xy_index_msg` VALUES ('4', '代理合作', '<p><span><b>平台代理模式</b></span></p>\r\n\r\n<p><span>平台用户可以通过推荐新人成为平台的代理，代理可以获得额外的动态奖励，直推一级用户奖励为一级用户每天所得佣金的16%，二级用户奖励为二级用户每天所得佣金的8%，三级用户奖励为三级用户每天所得佣金4%</span></p>', '3', '1582142009', '1', 'admin');
INSERT INTO `xy_index_msg` VALUES ('5', '常见问题', '<p>这是常见问题的文本</p>\r\n\r\n<p>q:xxx</p>\r\n\r\n<p>a:xxx</p>', '5', '1576043987', '1', 'admin');
INSERT INTO `xy_index_msg` VALUES ('6', '新手指南', '<p>详情可查看客服栏说明，订单发货冻结时间为30分钟，充值提现问题可咨询客服24小时在线，云淘商贸有限公司祝大家新年快乐</p>', '1', '1580219982', '1', 'admin');
INSERT INTO `xy_index_msg` VALUES ('7', '利息宝规则', '', '1', '1582249982', '0', 'admin');
INSERT INTO `xy_index_msg` VALUES ('8', '首页滚动内容', '<p>zzmaku.com 提醒您，这是京淘唯抢单系统V10测试版，程序仅用于测试。请勿用于商业动作。</p>', '1', '1587354385', '0', 'admin');
INSERT INTO `xy_index_msg` VALUES ('9', '抢单备注', '<p>\r\n                平台将订单匹配给用户的同时，平台将该笔订单的信息提交到商家后台，若用户在两分钟之内不提交订单，为了规避网购平台的监管，该笔订单会被冻结。订单冻结后，该笔订单资金也会被冻结，需等待系统24小时后自行解冻，请各位用户知悉。等级VIP模式（如：账上额度10000内每日最高可获得佣金3%，10001--50000可获最高佣金3.5%，50001--100000每日最高可获得4%）</p>', '1', '1258888888', '0', 'admin');
INSERT INTO `xy_index_msg` VALUES ('10', '活动1', '2', '1', '1259999999', '0', 'admin');
INSERT INTO `xy_index_msg` VALUES ('11', '首页弹窗内容', '<p><strong>温馨提醒:</strong></p>\r\n\r\n<p>提现T+1模式&nbsp;&nbsp;&nbsp;次日24点前到账。 提现由MCHAT客服审核（只需首次审核）后发起提现次日24点前到账。感谢您对本平台的支持与厚爱，祝您兼职愉快！</p>', '1', '1584763184', '0', 'admin');
INSERT INTO `xy_index_msg` VALUES ('12', '公司资质', '<p><img alt=\"\" src=\"http://qd6.cn/upload/957266b6a3e5ecb4/50988453d5da587f.png\" style=\"max-width:100%;border:0\" /></p>', '1', '1585074044', '0', 'admin');

-- ----------------------------
-- Table structure for xy_io_log
-- ----------------------------
DROP TABLE IF EXISTS `xy_io_log`;
CREATE TABLE `xy_io_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oid` char(18) NOT NULL,
  `amount` decimal(7,2) NOT NULL COMMENT '支付金额',
  `tran_amount` decimal(7,2) NOT NULL COMMENT '实收金额',
  `type` int(2) NOT NULL DEFAULT '1' COMMENT '1收入(用户充值) 2支出(用户提现)',
  `addtime` int(10) unsigned NOT NULL COMMENT '交易时间',
  PRIMARY KEY (`id`),
  KEY `oid` (`oid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='平台收支记录表';

-- ----------------------------
-- Records of xy_io_log
-- ----------------------------

-- ----------------------------
-- Table structure for xy_level
-- ----------------------------
DROP TABLE IF EXISTS `xy_level`;
CREATE TABLE `xy_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `order_num` int(12) DEFAULT NULL COMMENT '接单限制',
  `num` decimal(18,2) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `bili` decimal(18,4) DEFAULT NULL COMMENT '比例',
  `level` int(11) DEFAULT NULL COMMENT 'd等级',
  `tixian_ci` int(11) DEFAULT NULL COMMENT '提现次数',
  `tixian_min` decimal(18,2) DEFAULT NULL,
  `tixian_max` decimal(18,2) DEFAULT NULL COMMENT '提现最大金额',
  `num_min` decimal(18,2) DEFAULT NULL,
  `cids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tixian_nim_order` int(11) DEFAULT NULL COMMENT '提现最少完成订单数',
  `auto_vip_xu_num` int(11) DEFAULT NULL COMMENT '自动升级vip需要邀请的人',
  `tixian_shouxu` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '0' COMMENT '提现手续费',
  `pic` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xy_level
-- ----------------------------
INSERT INTO `xy_level` VALUES ('1', '白银会员', '20', '0.00', '2020-02-05 17:48:29', '0.0040', '0', '1', '0.00', '100.00', '1.00', '', '4', '0', '0.02', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAAAkCAMAAABBj89wAAAAM1BMVEW1tbWkpKSkpKT+/v7w8PCpqamurq67u7uysrK2trbGxsbX19fBwcHPz8/j4+Ompqajo6NL/veVAAAAA3RSTlNM6OcrP75FAAADkklEQVR4Xn2X2ZLbMAwEnQC8L/3/1waHKUCHMy6r9GCz1QNa2v18Uu+pJ02RZEnUBMniHJIsH5TT4LPe8kfWN0JJRoiCCIowQuAP+fWXvtayswtBl1dC2QqC2AZCOA0Kfyy+CLwrLAY8DZzCzSCLoQncFX4DuiPk4jvyCqGw5vKAZZSfBqmbgSa7jqIrgOipWEG3tcMvwP87crski+F9favpkWN9qip4gpWkBqeCK8iW9wq/DWwfjdG9Qi/RhlDchOMYURFCeL18M7COEkLzJQFkIkz85lvQCnECTN/RxDPTCGxw7agDVKlIAQNgjFoQvikl6PVPQIRpv/Mw4QzqxZuBJtVGmQBNMhID9GsVIcWYEoAWFIiIOfPh7GhCWpIE6Ax8RQMuqQQoAJOSEHpOnezy4oIqAJbAGKh7gyGMJKlqIG812A4EmDsNYBCgwZQZnxVxQaSllx4igtb0qMgQn7oVyAB5H2mQDRIhua2Iigag8TYGNY2eR1YY7czY/QvAG6BKnoAyZbpIgM5UgLXogN0ViQCZAP0SMeCDGCggbUAxAIW3UfUGa7YYxpkQW+MZwyW6+nHQmyuqzxlMngEnAsRIAAkbBLv/+WeNlKmZALsjGbISFGBRwGBSaxVhqB+v31xGkx80A/IKoXaCxa8BU3QXnQZo30MBTGU1ngGSCrYYM9ySCRAYIBgBLFXgji4GaPc7BpRch8ygM2AyZ0Y1QL0YqSWGvTSx12lwSASgBAUoITGg7BnkwoAEADPHQIhA5526b3JkAQXIb0wxh7yeBl0J5QRksi4MiGHC3I841Bsd6RW91ykAoW2DLbABVQHjjACKAFJjQGodYCihAeo24hMRWG3Gxbw5a5bfgRlI3nZRYUIFSkdAgErnTdcH7h8RKJMATMgVAVqmA2ANx/sMABGnvhSQSwPAxhQccvMupAA7KPcsIpAwZ1BBRc6rn8FGkG9PGp0BE1Ljx8McOt062IA3f01FWqozU0VdLiMsTZoQ3QysIz6mzdjPZkm0BCYFOlq4IH0s7/0fljewMff0ePYrxgEed4rXP7gOb6CE+8NfCR7gCR4iqxvi0NVVgAHjQjgVxOEpEJ4G+rIYhDFqYPfsTXAG+hdYvhs4yuvaCvltwAA9ZCGYgr5+KniKAHaMwIxigxaAN7gLvC6+CZ9e/T7y2/T+/052CoLwAtcpm8HfjyP0R0tpA6IvSd6/Z2AGvP4/n19/hpfx27MAAAAASUVORK5CYII=');
INSERT INTO `xy_level` VALUES ('2', '黄金会员', '30', '88.00', '2020-02-05 17:48:29', '0.0040', '1', '1', '0.00', '100.00', '100.00', '', '6', '4', '0.03', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAAAkCAMAAABBj89wAAAATlBMVEXxyozzwXLls2vmsmTvumb////99ej++/b227H77NT00Zr448Lvw3z1w27wuV/ttFnrt2bzvmb90oHns2bptGT4yHPntGr8z3z6zHjqr1KDODylAAAABHRSTlP9TOjnFtbSewAAA/1JREFUeF6Fl4tyozoYg92zvt+4Jmnf/0WPrPw4mGW6wnhIMqOvkg1D1Vf+/v5+vFVES1kovVTRVCfq5+cnUz/QPjc9f9N/Xwr+B6E8Bn+NUbXYi/80zQCoPDUAzHF8pluCoj0BRAwJKo5LgqnZ52fz32gs1n1cpV5CEHsBCEL8p04YC6JIofNtBMWGxgQLRl8EfU4gBe0siL1onMfxa4IhwnIqSQ8dMYCmPzW2RN0C6D8S2tAgHP4kFAKmo6DnSMD56xrcL/Ny6kjTf4b/NGsANBD/TnCOULyH+8NHQTR3hNAxEkH/8i5Ie68lRe//HkDCQwjOIMG3cQCImn8wJtRPQRMK4nfngpLtCteKJEHAb8ZgcpzDO8GiS8BHE7Smv55YkHzXl/oZjGsyDuARcER42Pa7MZg5WUmgrLElY1IsqN0Mc/uYOfUEwah9oyMAuOApa/D6LILpFUlHJaGKUmtBuAQA7Kc9OlqD4CIT7M85mKio2BNspwRQsKyIs2OVsPcOvmhKt6KM8xoBWH+ZoRxAZYgdCboCvbdhkSFnLnJLAbB/zUtbZzBBEvF6BmL3qctvWwNsYBAgiAOElqhWUrRRfYJFb+OUQVEfakToDIISRc6b2A8VcZVlhaHQ77ZatTGyg6DktfZd84xzm/cxf4sgEAIEYc1pGezpiUdA4Q7CDtW8i6l9PuRM6jKO9scirwBIAhMxsyJlLB9HDMVUlJ2q1v4iLHED5H3bYkQ3GYAe4ZLgJMudell5B/9sLspIQsC+4YMAmjkPtb4BLwICZDgDgACiApdSdK2ThhICoEIPpXcCiACwJcEnAgE9QYxrNGZd18g1aCPhIjeAdkEjAAUnBdfEuQXYWVE0diOA9k1MQMRdRYwQjCdgAVP8Z21NmqFoXD4B9mD8LoAeQa30JyGlYEKCrAvJy/sFfAmowUQtgGQsN1K7EEJKuNcQNIWYoyLgSNAjrB79WzyT1hYgKdivMUZnPGqLPKPSEIxQfwjWIWkgAP3HgK+zbeGxl0Q9Ae5juBvn+cx7NZQJpSRzUdIQfClngwceAE+WY0EeDBfPAFlm71L8vL+8koul+NCVOHsm8B5ZMluKgQ8KwFJ87lDzDC4PgL4K40vkgoGTl1VXjdH1uZvhiSnPsJ4J2Fn9DYD+40sklUteFs3jYq8PBMZHtL0F3LxESgC+XoAwJqhg1PaY+DdA9pEgxgTtFkYCDBK6O05GoP/AuAJuIxQMSgKQ0ENUUgCB6j6PATgPgGsEqhQMTvQfM/S/vo4JOuM2wTcJD+lo/G+kI7pYEgPg+Mv/FEGRcLuPDoS46yNBFfcqCWh+Qgz+f9TXQGCEXtL4qk1EF+157pyGAB3x5+t/M0/Jc5v4fv4AAAAASUVORK5CYII=');
INSERT INTO `xy_level` VALUES ('3', '铂金会员', '50', '188.00', '2020-02-05 17:48:29', '0.0040', '2', '3', '0.00', '100.00', '100.00', '', '0', '40', '0.02', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAAAkCAMAAABBj89wAAAAQlBMVEWil8WXjbj///+Ogq+Wi7mNgauaj7yTh7aHe6zSzeD6+vu+t9Lf2+nv7fOxqciek7+Pg7OglsOQhK2kmsbIwtiBc6UBWpS4AAAAAnRSTlPiTGWxUe0AAAPvSURBVHhejZfZbuswEEPTGe2rt/7/r95ZpKjxDdowjmr4gQckG6R9fD16705kRJ61iZAUMEx9h2+S2fe+d74Lx9/6eoi/EIxbACHgpgAc/kI49t7PLqjjEz32/krwI4IiAl2o9pogdPY/2N8KAD8BrI6EoP6aYVsJhGA6aRa0HfhBgv19RwqgCOI/M6D4WwaoN35Q0Y2gCdbOTLATwfb7of70wk82uHV0W5nsf6zgV0FsjnTgJwl2NyO8R4QhuwrCN+6WL/smwT4StHP4n/l8GWFrWSCOAVoQ+py9EH7bYgFkhgSnAi4omkAZWABKGAW5IAVt/MyvFLbUp8oNsI8NMqScMzMiXDK0VISmQK1QEMldCwro9ZlfMxdIQ3AHTEQBVm4xkl2MsWmAs0J1jo7GQxmy/z7cfOZQEJYBTUknAewrQEc4E0RSizAUuSRKA8WEYCqkuHNB9GqJrY9Ozxo+E+RTlDmBfZMgQnEkcow5txwZYK4EVNemRUG6PC3gCzO5fn4WDY4EU5xAXy8JTiBjEg/AH7ZMAF/JFIbktgZkZrpUeu/R4pHjU1kA43qcTKDrLLqBY4BRwJZra5UEwGfOtYVOlLaorULqiLa9yA6EJpgd7REgxp8AHgFZAN2RMJDi5TE/dfjrOhCRkEvp2ZHVBPOjkGDnDUomRQUIYlOAYX8BHvxSsbtFm2BVBMnauQEDTk2QoyS4IqgEUJMIIIlqsOivmzxKAkeurXlrHQFWBAKoegFRoQRsUBjgF0ARATcHNzkKMAAAbgKEICPPjlrOADk33cDwBvOLx3FFxnNBmyaoUPlH5MMgWpvUGg4FsL8cWpEidAN3A8TqvQC2WngOPOjcAU5EjKkh+yAK4GhQ7UsCkiRQ/3cAvxXIjgG+QQ0biuhhxAMxQ+pEQDsSFLgGQMQETbAA51VeAezLAIdEwk0JEaqfN0YBMRp7AfRYcm9tLDASrN8j2TJCEjHgbK0l4HFa43fjYjwZUf2l1AQABdXI5UKPXQWAmv0IIAnUnxERoMbzJyDCTZELSqBKtVxJWrmElTKB+lXH3UywRjhj685dKTuuKBEgl6XIR+aO8pVzO7vn+lsxFm0jWGyHVbWSzPw1YoAi/v/rwtNFB0uq50O/pQ+ikJt+hqUiI2aqebsSzIr6IrDEX1nqre64pAxB8PlWssGMsBKILV8itp7vJXV/73xPcI9gZkkkZzx7i/BGsHr8CbhFWCWNgkT3hqwc6o8BfwesCE9/pwUJYAlxIcSWjTGwU/goAWslmFMvf2EsCSLYNcX/qIeOIIDbvwqqZX+LELT+FWL4hluCr0UQxH5bwZNuGywpIeDNe9Hs1z9uZImrYyEicgAAAABJRU5ErkJggg==');
INSERT INTO `xy_level` VALUES ('4', '钻石会员', '20', '388.00', '2020-02-05 17:48:29', '0.0040', '3', '50', '0.00', '100.00', '500.00', '', '0', '45', null, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAAAkCAMAAABBj89wAAAARVBMVEVocJBaYYZvdZRcY4hhaIxqcJBfZor///9mbI2ytcZ9gp++wc+prMDMztr5+frd3uZ0epdTWoGbn7VXXoTq6++PlK1PVn23O75tAAAAAXRSTlNMP4zV3QAABA9JREFUeF51lgeO60gMRN05B6W9/1GXZEeP/KtlQ/AA9VAsU57PR2otuljXNXV86T8U9yi8k6qLb6q7fCV/LfQi7IiDXtMeDriSPwMA6+50pj+eLo/ns/uLd4Ldn17kzzGAVVO8E+oWwTcGAH5H+I3YBqSHebv2BBvkBZj+bM5oL0GTvwDAZRUeQrQIi7Hsx4j+XfNBZybAqXpFA7KK/Cdi75nvCX5GuH5/kxT61wMHZL8JcN41UwKJgH9HOPYSNMbuAyIRYhHeU9o6AITnnfBE/zMB+dOApFUxUglDu/1ew0gA/iob3gDJnM37jLtcCK7SgIRVyZi0+fN0T6W9ho+Wo4PT5PM8VQO0BLf5o7tq2LbL8mTu2yS+MhSTu0z5GpHUo4VEFp4AUYLYFR3qNsWBAsjhgA5Zb0Dhm98ATyvhMWXVQICegGeDFpwApOciqWw8FGAr6oIA4szgb62/IfMgFBMfUkRAxasDRoRgkkARgPI2wBFMAX9GqTU0gOMv3IJqgSLqAAy9E5CqMe4BMUEdrGWr2TwAwPxVHYdwGfCui+45AmKYcg0wE0hiqFSoRbEAhGDFFFgEyVFwU6HpJ5uhE8bkAfCcu9bC7SXzACGiEIIAI4KDyGkIolzBWRmnLA8B1y2bTXluG6cEg2BNBvuSs6EOHG2C2RWPA8JKkt2kbDYpkFJIC8BbyUQQZ4AEITyzrQCAh0rr+QsAmFbujzgAIIFXiscTKvcE2EdEU5LBkFwxDwKdCYxFKMWZxOhBIIOJl9bc/JG3IAQQZgBG0Z85If/AOJ7HA4CBEICFqmgSLZM9ACB0S3ADGJR6AjusDf8GVAI0htSKOtgAVyj2AoBC4UI43SoApwdKCPmxCu17gtMUtQCV85FAarwWQHQAk/oaAH0QQBCimCBB0WRvUR0AH0/AYKwEWgBARbcDrosA0BUHv2Rc83emKIkK+MgghVSVgz5SiR73QA0CAXRbBuggm1La9/5GACPAUhQQwYKRcyGVG/et2CYfizHB3/hRrB1AJa8IATqNtgw31xI4k4daAjuWKpfk4DMAOGJlhw04YOTIhwjQt7lGTx24E5R6AhnvYCX+rDF3R4ERoovn46uV0sqz4Iwek+9w8v5kfVL2XC3AhtBgoLgEDLPcIkDQylIU0UQ9ozdJAwQI9ev3mVd8Vwuw/F//XiDcCvRnTAxEF/2tnaaJIHf1SkD69teEb/6doClD25z5UHoT3gnkjwSC1optgMEg/3eENacJsLJLzyEtQsvU/QdCdwLCX0/WZU8hXiWT+wQ0m2sBBNsSUOaRYethJyBgj7AgBKBC2QSsGiai6VfNM4GaEbr5akGQuv87A0muDPaVgTroBCpsBVj+FGCPwPYMGNvqV4Yp/vkf+t5wv24grt8AAAAASUVORK5CYII=');

-- ----------------------------
-- Table structure for xy_lixibao
-- ----------------------------
DROP TABLE IF EXISTS `xy_lixibao`;
CREATE TABLE `xy_lixibao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `num` decimal(18,5) DEFAULT NULL,
  `addtime` int(10) DEFAULT NULL,
  `endtime` int(10) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `yuji_num` decimal(18,5) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `is_qu` int(11) DEFAULT '0',
  `shouxu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `real_num` decimal(18,5) DEFAULT '0.00000',
  `is_sy` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xy_lixibao
-- ----------------------------
INSERT INTO `xy_lixibao` VALUES ('1', '20', '100.00000', '1583730697', '1586322697', '1', '0', '3.00000', '3', '0', null, '0.00000', '0');
INSERT INTO `xy_lixibao` VALUES ('2', '20', '100.00000', '1585107189', '1585109338', '1', '0', '1.00000', '1', '1', '1', '0.00000', '-1');
INSERT INTO `xy_lixibao` VALUES ('3', '20', '122.00000', '1585109367', '1585195767', '1', '0', '1.22000', '1', '0', null, '0.00000', '0');

-- ----------------------------
-- Table structure for xy_lixibao_list
-- ----------------------------
DROP TABLE IF EXISTS `xy_lixibao_list`;
CREATE TABLE `xy_lixibao_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `bili` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `min_num` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_num` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addtime` int(10) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `shouxu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xy_lixibao_list
-- ----------------------------
INSERT INTO `xy_lixibao_list` VALUES ('1', '一天', '1', '0.01', '100', '100000', '1583482861', '1', '0.01');
INSERT INTO `xy_lixibao_list` VALUES ('2', '七天体验', '7', '0.002', '100', '10000', '1583482797', '1', '0.02');
INSERT INTO `xy_lixibao_list` VALUES ('3', '一个月体验', '30', '0.001', '100', '1000', '1583482750', '1', '0.03');
INSERT INTO `xy_lixibao_list` VALUES ('4', '一年高收益', '365', '0.05', '10000', '500000', '1583482786', '1', '0.01');

-- ----------------------------
-- Table structure for xy_member_address
-- ----------------------------
DROP TABLE IF EXISTS `xy_member_address`;
CREATE TABLE `xy_member_address` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '收货姓名',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '收货手机',
  `area` varchar(255) NOT NULL COMMENT '地区',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '地址-详情',
  `is_default` tinyint(1) unsigned DEFAULT '0' COMMENT '默认地址',
  `addtime` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_xy_member_address_uid` (`uid`) USING BTREE,
  KEY `index_xy_member_address_is_default` (`is_default`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='会员收货地址';

-- ----------------------------
-- Records of xy_member_address
-- ----------------------------
INSERT INTO `xy_member_address` VALUES ('1', '30', '', '', '', '', '1', '1585498842');
INSERT INTO `xy_member_address` VALUES ('2', '20', '1', '1111111111', '1111111', '1111111', '0', '1585504772');

-- ----------------------------
-- Table structure for xy_message
-- ----------------------------
DROP TABLE IF EXISTS `xy_message`;
CREATE TABLE `xy_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '接收人ID',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT '发送人ID',
  `title` varchar(150) NOT NULL COMMENT '信息标题',
  `content` text NOT NULL COMMENT '正文内容',
  `addtime` int(10) NOT NULL COMMENT '发表时间',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '消息类型 1公告 2通知',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='会员-消息表';

-- ----------------------------
-- Records of xy_message
-- ----------------------------
INSERT INTO `xy_message` VALUES ('1', '0', '0', 'test', '<p>开国大典回填土方回填人人通人王二狗挺好他人代付 方便后面就没有太热情二位非法人突然个体户研究敬业福认为</p>', '1585052063', '3');

-- ----------------------------
-- Table structure for xy_msg
-- ----------------------------
DROP TABLE IF EXISTS `xy_msg`;
CREATE TABLE `xy_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `content` text NOT NULL COMMENT '文本内容',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1平台公告 2平台简介 3抢单规则 4代理合作 5常见问题',
  `addtime` int(10) NOT NULL COMMENT '发表时间',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0发布 1不发布',
  `author` varchar(10) NOT NULL DEFAULT '' COMMENT '作者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of xy_msg
-- ----------------------------

-- ----------------------------
-- Table structure for xy_pay
-- ----------------------------
DROP TABLE IF EXISTS `xy_pay`;
CREATE TABLE `xy_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ico` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `min` double(18,2) DEFAULT NULL,
  `max` double(18,2) DEFAULT NULL,
  `ewm` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xy_pay
-- ----------------------------
INSERT INTO `xy_pay` VALUES ('1', '支付宝快捷支付', 'zfb', '/public/img/alipay.png', '0.01', '10000.00', 'http://qd.cn/upload/a1b496639c89d503/bec5bca9044e1b5d.png', '0', '/index/ctrl/recharge2?type=zfb');
INSERT INTO `xy_pay` VALUES ('2', '微信快捷支付', 'wx', '/public/img/wx.png', '0.01', '10000.00', 'http://qd.cn/upload/a1b496639c89d503/bec5bca9044e1b5d.png', '1', '/index/ctrl/recharge2?type=wx');
INSERT INTO `xy_pay` VALUES ('3', '银行卡转账', 'card', '/public/img/card.png', '102.00', '10000.00', '', '1', '/index/ctrl/recharge');
INSERT INTO `xy_pay` VALUES ('4', '比特币支付', 'bipay', 'https://cdn.fwtqo.cn/static/web/assets/img/logo/weblogo4x.png', '0.01', '10000.00', null, '1', '/index/ctrl/recharge2?type=bipay');
INSERT INTO `xy_pay` VALUES ('5', 'paysapi支付', 'paysapi', 'https://cdn.bearsoftware.net.cn/paysapi/images/logo_red.png', '0.01', '10000.00', 'http://qd.cn/upload/c03e6f88a46358db/0f716faa5667ee36.png', '1', '/index/ctrl/recharge2?type=paysapi');
INSERT INTO `xy_pay` VALUES ('6', 'woai支付', 'woaipay', '/public/img/card.png', '0.01', '10000.00', null, '1', '/index/ctrl/recharge_woaipay');

-- ----------------------------
-- Table structure for xy_reads
-- ----------------------------
DROP TABLE IF EXISTS `xy_reads`;
CREATE TABLE `xy_reads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '消息ID',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '读取时间',
  PRIMARY KEY (`id`),
  KEY `mid-uid` (`mid`,`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='会员-消息读取记录表';

-- ----------------------------
-- Records of xy_reads
-- ----------------------------
INSERT INTO `xy_reads` VALUES ('1', '30', '1', '1582140346');
INSERT INTO `xy_reads` VALUES ('2', '30', '1', '1582140392');

-- ----------------------------
-- Table structure for xy_recharge
-- ----------------------------
DROP TABLE IF EXISTS `xy_recharge`;
CREATE TABLE `xy_recharge` (
  `id` char(18) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `real_name` varchar(15) NOT NULL DEFAULT '' COMMENT '充值姓名',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `num` decimal(12,2) NOT NULL COMMENT '充值金额',
  `type` int(2) NOT NULL DEFAULT '1' COMMENT '支付方式 1微信 2支付宝 3qq',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '打款凭证',
  `addtime` int(10) NOT NULL COMMENT '下单时间',
  `endtime` int(10) NOT NULL DEFAULT '0' COMMENT '处理时间',
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '订单状态 1下单成功 2充值成功 3充值失败',
  `pay_name` varchar(255) DEFAULT NULL,
  `is_vip` int(11) DEFAULT '0',
  `level` int(11) DEFAULT NULL,
  `pay_type` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员-充值表';

-- ----------------------------
-- Records of xy_recharge
-- ----------------------------

-- ----------------------------
-- Table structure for xy_reward_log
-- ----------------------------
DROP TABLE IF EXISTS `xy_reward_log`;
CREATE TABLE `xy_reward_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` char(18) NOT NULL COMMENT '订单号',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '产生交易用户',
  `sid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '交易对象',
  `num` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易数额',
  `lv` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '级差',
  `type` int(2) NOT NULL DEFAULT '0' COMMENT '订单类型 1充值订单(推广返佣) 2交易订单(交易返佣)',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '佣金发放状态 0自动发放 1未发放 2已发放',
  `addtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '处理时间',
  PRIMARY KEY (`id`),
  KEY `oid` (`oid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='订单佣金发放记录表';

-- ----------------------------
-- Records of xy_reward_log
-- ----------------------------
INSERT INTO `xy_reward_log` VALUES ('1', 'UB2003300159471543', '20', '0', '45.40', '0', '2', '0', '1585504826', '0');
INSERT INTO `xy_reward_log` VALUES ('2', 'UB2003311159366848', '20', '0', '99.00', '0', '2', '0', '1585627193', '0');

-- ----------------------------
-- Table structure for xy_script
-- ----------------------------
DROP TABLE IF EXISTS `xy_script`;
CREATE TABLE `xy_script` (
  `script` text NOT NULL COMMENT '代码块',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of xy_script
-- ----------------------------
INSERT INTO `xy_script` VALUES ('', '1');

-- ----------------------------
-- Table structure for xy_shop_goods_cate
-- ----------------------------
DROP TABLE IF EXISTS `xy_shop_goods_cate`;
CREATE TABLE `xy_shop_goods_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '商店名称',
  `bili` varchar(255) NOT NULL COMMENT '商品名称',
  `cate_info` varchar(255) DEFAULT '' COMMENT '商品描述',
  `goods_price` decimal(10,2) DEFAULT NULL COMMENT '商品价格',
  `cate_pic` varchar(120) DEFAULT '' COMMENT '商品展示图片',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `status` int(1) DEFAULT '0' COMMENT '上架状态 0不上架 1上架',
  `min` varchar(255) DEFAULT NULL COMMENT '最小金额限制',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=167 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';

-- ----------------------------
-- Records of xy_shop_goods_cate
-- ----------------------------
INSERT INTO `xy_shop_goods_cate` VALUES ('1', '服装', '0.002', '顶顶顶顶', null, 'http://qd2.cn/upload/4201872b7132c82b/9d3e81fb395d46ff.png', '1583381116', '0', '');
INSERT INTO `xy_shop_goods_cate` VALUES ('2', '汽车', '0', '京东', null, 'http://qd2.cn/upload/4201872b7132c82b/9d3e81fb395d46ff.png', '1583381331', '0', '');
INSERT INTO `xy_shop_goods_cate` VALUES ('3', '零食', '0', '唯品会专区', null, '/statics/img/w.svg', '1583409871', '0', '');
INSERT INTO `xy_shop_goods_cate` VALUES ('166', '美妆', '0', '美妆', null, '', '1583409885', '0', '');
INSERT INTO `xy_shop_goods_cate` VALUES ('4', '装饰品', '0', '111', null, 'http://qd2.cn/upload/4201872b7132c82b/9d3e81fb395d46ff.png', '1583381309', '0', '');

-- ----------------------------
-- Table structure for xy_shop_goods_list
-- ----------------------------
DROP TABLE IF EXISTS `xy_shop_goods_list`;
CREATE TABLE `xy_shop_goods_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) NOT NULL COMMENT '商店名称',
  `goods_name` varchar(255) NOT NULL COMMENT '商品名称',
  `goods_info` varchar(5000) DEFAULT '' COMMENT '商品描述',
  `goods_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `goods_pic` varchar(120) DEFAULT '' COMMENT '商品展示图片',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '上架状态 0不上架 1上架',
  `cid` int(11) DEFAULT '1',
  `is_tj` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=642 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';

-- ----------------------------
-- Records of xy_shop_goods_list
-- ----------------------------
INSERT INTO `xy_shop_goods_list` VALUES ('1', '信酷小米专营店', '小米/MIUI', '<div style=\"width: 100%;text-align: center\"><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/a5DD5WWZwEdT5mZ5dlDi6cttvO6ttidO.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/xtwBtwyzvzwbtj67q0yyyGGTU0U7ttT7.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/aBnF546904l2jfNNv6333926JLe023q3.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/jEKScyUUGyUEaHvhGCX0VVCHQLakvYAI.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/n0HHNe2W0r22H1WEnsS7jCScws2A1sn2.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/V1sFA4X8U6e1MIU44u8fS1u246i88UFM.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/RI11mTdzSRMWOqS68t26d11R1R3jtSto.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/GEn9IIwNfFI9niU6DPZ9npUV6n66FVnI.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/ZgqMP7iIG5SmA5t5qr5WgTz5miPSmB46.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/Bl0YhM95Q9ap1zB5fpF9PZpy9Bp5yyRA.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/xTtA0bmBhaERfSuEdax8bmBtADFxhNn0.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/I8h3ChhD44C2Ed82D2RFeECrO8chr4C2.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/YOFKzjhCdHCduBD8hR9F6EBUeRUh8eHD.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/Mu8HDkr8UCm7h2auDzxjAAkxkKyK80zz.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/pe0wjlww3WZasWllfGKqea02gRusNZ8w.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/d1aWewWIBYBd41BZYy91wyWdO54PP2zA.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/wE6tY2bBef9JFTya3FZz5ROn65PB99Bb.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/AJS9m33GKgGNG9ehAaaMA60JMWeA7he0.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/Ed2w42xIwa9I3OM3zP5i99I98Isx6D9I.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/IP6HzhnZdn8Zt09nLfzduLX8H0X6iXcD.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/IsQ02d5zAZwqqwdWyQPaQnT5Wu05gMsQ.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/M4855SkJn5Nv67c76AmMkJKm5dnj5aKV.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/dYZ4a5BgsjoAsTBt8Q5BSvs7ovJSs7u7.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/izT2DgGND24d744Lg9HDELlnd9L2D8EQ.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/TVWHzwWwwW12WvWE1abFzXHs21epvw9z.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/V35V03d5z5Q2vIVm7QQVi7I8wv2Zw7qo.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/j16T1tje6HGFjfq3q1zf15V113zt55GQ.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/bEHXWUDA2SrsCUhXEYwDWXEYux5kXc5E.jpg\" /><img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/f2870u4uFBUJj0E8SIope5U0Sn4a6Psb.jpg\" /> <img data-lazyloaded=\"true\" src=\"https://wx.hi.cn/attachment/images/3/2019/12/FYmTqmlD0Dgv7RyhEDLtdgGleQ07Vr40.png\" /></div>', '1.00', '/upload/goods_img/大家电/5db3b89a8d174.jpg', '1583402400', '0', '2', '1');
INSERT INTO `xy_shop_goods_list` VALUES ('2', '邮乐安阳馆', '【汤阴县积分用户专享】洗衣机XpB—126-9896S', '', '1.00', '/upload/goods_img/大家电/5db3b89a9f288.jpg', '1578206762', '0', '1', '1');
INSERT INTO `xy_shop_goods_list` VALUES ('3', '海信电器旗舰店', '海信（Hisense）HZ39E35A 39英寸高清手机交互 轻薄金属 WIFI人工智能液晶电视机', '', '1.00', '/upload/goods_img/大家电/5db3b89ab61bd.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('4', '邮滋味如皋馆专柜', '创维9公斤变频滚筒洗衣机  型号：F9015NC-炫金   如皋免费送货上门，南通包邮，华东地区配货', '创维洗衣机，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89b52437.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('5', '邮滋味如皋馆专柜', '创维2P定频立式柜机，型号：KFR-50LW/F2DA1A-3（限如皋地区免费送货上门安装）', '创维定频空调，免费上门安装，绝对优惠，每月更有现场特惠活动', '4.00', '/upload/goods_img/大家电/5db3b89b6e95e.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('6', '创维电视官方旗舰店', '创维/SKYWORTH 58H8M 58英寸4K超高清全面屏防蓝光人工智能语音HDR超薄网络液晶电视', '4K超高清，声像自然，一场声觉革新，视觉体验，光学防蓝光，护眼不偏色', '3.00', '/upload/goods_img/大家电/5db3b89b79d10.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('7', '邮乐洛阳', '【洛阳金融积分兑换】TCL 205升 三门电冰箱 （星空银） BC（邮政网点配送）', '', '1.00', '/upload/goods_img/大家电/5db3b89bc11c1.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('8', '邮滋味如皋馆专柜', '创维9公斤全自动波轮洗衣机，型号XQB90-52BAS淡雅银如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，夏季特惠；每月现场有特惠活动', '1.00', '/upload/goods_img/大家电/5db3b89bcfc24.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('9', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】家用洗衣机，图片仅供参考', '', '1.00', '/upload/goods_img/大家电/5db3b89be0d98.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('10', '邮乐安阳馆', '【滑县积分用户专享】创维电器洗衣机9公斤波轮安阳', '', '1.00', '/upload/goods_img/大家电/5db3b89bee474.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('11', '邮乐安阳馆', '美菱3开门冰箱BCD-209M3CX【汤阴县积分兑换专用，其他下单不发货】', '', '1.00', '/upload/goods_img/大家电/5db3b89c06586.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('12', '邮乐安阳馆', '美菱电冰箱209L3CS【安阳县积分兑换用户专用，其他地区发】', '', '1.00', '/upload/goods_img/大家电/5db3b89c16f2a.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('13', '信阳邮约会', '【限信阳地区积分兑换专用，不对外销售】自动洗衣机 家用洗衣机，图片仅供参考', '', '2.00', '/upload/goods_img/大家电/5db3b89c22e95.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('14', '邮乐安阳馆', '【滑县积分用户专享】创维电器电视50寸4K智能安阳', '', '3.00', '/upload/goods_img/大家电/5db3b89c2bb37.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('15', '邮乐安阳馆', '【安阳县积分用户专享】长虹液晶电视55U1', '', '3.00', '/upload/goods_img/大家电/5db3b89f48109.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('16', '海信电器旗舰店', '海信（Hisense）HZ32E30D 32英寸蓝光高清平板液晶电视机 酒店宾馆卧室推荐', '【海信今日限时特惠-到手价788元！】限量200台！抢完即止！', '749.00', '/upload/goods_img/大家电/5db3b89f51194.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('17', '邮滋味如皋馆专柜', '邮乐特卖：庭美家用消毒柜    型号：YTP-280    如皋免费送货上门，南通包邮，华东地区配送', '庭美消毒柜，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '755.00', '/upload/goods_img/大家电/5db3b89f5ec57.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('18', '吉舜诚商城专柜', '飞利浦（PHILIPS）  19英寸液晶电视机 显示器两用 hdmi高清接口', '19PFF2650', '799.00', '/upload/goods_img/大家电/5db3b89fb14ba.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('19', '创维集团官方旗舰店', '创维/SKYWORTH 32X3 32英寸窄边非智能老人机蓝光高清节能LED平板液晶电视机工程机', '蓝光高清，经典窄边，节能液晶，简单好用，谁用谁知道，实用耐用款', '799.00', '/upload/goods_img/大家电/5db3b89fc8fa8.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('20', '吉舜诚商城专柜', '飞利浦（PHILIPS）22英寸LED高清液晶平板电视机含底座 黑色', '22PFF2650/T3', '899.00', '/upload/goods_img/大家电/5db3b89fd917b.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('21', '创维集团官方旗舰店', '创维/SKYWORTH 32X6 32英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠，高清智能电视，WIFI，酷开系统，10核处理器', '899.00', '/upload/goods_img/大家电/5db3b89fe6086.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('22', '海信电器旗舰店', '海信 (Hisense) HZ32E35A 32英寸AI智能WIFI 轻薄金属 卧室神器高清电视机', '', '899.00', '/upload/goods_img/大家电/5db3b8a0004c2.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('23', '邮滋味如皋馆专柜', '创维邮乐特卖： 32寸液晶电视机，型号：32E381S   如皋免费送货上门，南通包邮，华东地区配货', '创维液晶电视大品牌，夏季特惠；每月现场有特惠活动', '899.00', '/upload/goods_img/大家电/5db3b8a01be30.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('24', '琥麟电器专柜', '海信 XQB60-H3568 6公斤全自动波轮洗衣机', '', '749.00', '/upload/goods_img/大家电/5db3b8a0279b3.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('25', '邮滋味如皋馆专柜', '创维7公斤全自动波轮洗衣机，型号：XQB70-21C淡雅银，如皋免费送货上门，南通包邮，华东地区配送', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '928.00', '/upload/goods_img/大家电/5db3b8a0367fe.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('26', '邮滋味如皋馆专柜', '创维单冷冰柜，型号：BD/C-160雅白，如皋地区免费送货上门安装，南通地区包邮，华东地区配货', '创维冰柜，安全健康专家，免费上门安装，绝对优惠，每月线下更有现场特惠活动', '999.00', '/upload/goods_img/大家电/5db3b8a042f39.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('27', '创维集团官方旗舰店', '创维（SKYWORTH）32H5 32英寸高清HDR 护眼全面屏 AI人工智能语音 网络WIFI 卧', '高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '999.00', '/upload/goods_img/大家电/5db3b8a0511cd.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('28', '邮滋味如皋馆专柜', '创维/SKYWORTH热水器，型号：DSZF-D5501-80，如皋免费送货上门，南通包邮 创维/', '创维家电大品牌，安全可靠，邮乐特惠；每月现场有特惠活动——18862731238', '999.00', '/upload/goods_img/大家电/5db3b8a07389d.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('29', '琥麟电器专柜', 'Hisense/海信 HB80DA332G8KG公斤大容量家用全自动节能波轮洗衣机', '', '899.00', '/upload/goods_img/大家电/5db3b8a386615.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('30', '琥麟电器专柜', '海信 BCD-163N/B 冰柜冷藏冷冻双温家用商用小型卧式', '', '999.00', '/upload/goods_img/大家电/5db3b8a390a27.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('31', '吉舜诚商城专柜', '东芝（TOSHIBA）  32英寸 蓝光液晶电视 高清平板电视机 东芝电视机', '32L1500C', '1.00', '/upload/goods_img/大家电/5db3b8a69aafd.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('32', '创维集团官方旗舰店', '创维/SKYWORTH 40X6 40英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '超值钜惠！高清智能，10核处理器，可以WIFI上网', '1.00', '/upload/goods_img/大家电/5db3b8a9a6b14.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('33', '甲子商城旗舰店', '康佳/KONKA  LED39E330C 39英寸卧室电视高清蓝光节能平板液晶电视', '', '949.00', '/upload/goods_img/大家电/5db3b8a9b22ae.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('34', '邮乐赣州馆', '【不支持邮乐卡支付】创维-彩电-40E1C 40英寸全高清HDR 护眼全面屏 AI人工智能语音', '', '1.00', '/upload/goods_img/大家电/5db3b8a9cf38d.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('35', '琥麟电器专柜', '海信 BCD-177F/Q 177升 双门冰箱', '', '1.00', '/upload/goods_img/大家电/5db3b8a9f0abd.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('36', '创维集团官方旗舰店', '创维/SKYWORTH 43X6 43英寸10核窄边高清 人工智能 网络WIFI 卧室液晶平板电视机', '【买电视选创维】高清智能，10核处理器，质量上乘，价格厚道，可以Wifi上网', '1.00', '/upload/goods_img/大家电/5db3b8aa1b4b4.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('37', '创维集团官方旗舰店', '创维（SKYWORTH）40H5 40英寸全高清HDR 护眼全面屏 AI人工智能语音 网络WIFI', '全高清HDR 护眼全面屏 AI人工智能语音', '1.00', '/upload/goods_img/大家电/5db3b8aa26c4f.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('38', '邮乐安阳馆', '市区积分用户专享】创维平板电视32X6', '', '1.00', '/upload/goods_img/大家电/5db3b8aa31c19.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('39', '吉舜诚商城专柜', '飞利浦（PHILIPS）32英寸新品高清LED电视 接口丰富窄边高清LED液晶平板电视机', '32PHF3282/T3', '1.00', '/upload/goods_img/大家电/5db3b8aa3b85c.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('40', '琥麟电器专柜', '海信 BD/BC-308NU/A 冰柜家用 顶开式卧式商用冷藏冷冻柜', '', '1.00', '/upload/goods_img/大家电/5db3b8aa4931f.jpg', '1572059510', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('41', '明凰服饰专营店', '男女冲锋衣工装棉服外套修身加厚款', '邮乐支持微信，支付宝，网银，邮储卡和银联卡支付。（不同商品请分开下单）', '85.00', '/upload/goods_img/户外服饰/5db3b8b22c022.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('42', '户外途量工厂专卖店', '春夏季运动风衣钓鱼防晒衣男女超薄透气皮肤衣防风外套户外速干潮流衣服情侣款皮肤衣', '大码骑行长袖', '29.90', '/upload/goods_img/户外服饰/5db3b8b23604c.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('43', '探路者正江专卖店', '探路者/TOREAD 冲锋裤 运动裤 秋冬户外软壳裤男透气防风保暖徒步裤KAMG91159', '', '428.00', '/upload/goods_img/户外服饰/5db3b8b25312b.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('44', '探路者正江专卖店', '探路者运动服 探路者冲锋衣 19秋冬户外女式防水透湿套绒冲锋衣TAWH92285', '', '839.00', '/upload/goods_img/户外服饰/5db3b8b25d925.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('45', '好看哒专营店', '防晒衣女中长款薄款防晒服', 'FSY-6387', '45.00', '/upload/goods_img/户外服饰/5db3b8b56628b.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('46', '宝仕母婴专营店专柜', 'L户外皮肤衣防紫外线防晒衣男女夏季超薄透气防晒服运动风衣', '', '75.00', '/upload/goods_img/户外服饰/5db3b8b573966.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('47', '好看哒专营店', '防晒衣女夏季新款韩版连帽系带长袖防晒衣糖果色沙滩户外披肩防晒衣', 'FSY-54', '19.90', '/upload/goods_img/户外服饰/5db3b8b88f380.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('48', '户外途量工厂专卖店', '户外速干T恤男 女休闲跑步运动健身短袖大码情侣快干衣排汗透气', '', '22.80', '/upload/goods_img/户外服饰/5db3b8b8abc8f.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('49', '好看哒专营店', '防晒衣 户外薄款防紫外线印花防晒衣', 'FSY-1736', '25.00', '/upload/goods_img/户外服饰/5db3b8b8c0c84.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('50', '好看哒专营店', '防晒衣夏季女蝙蝠袖连帽拉链短款防晒衣', 'FSY-5423', '35.00', '/upload/goods_img/户外服饰/5db3b8b9b16a1.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('51', '好看哒专营店', '防晒衣男士薄款纯色连帽防晒衣', 'FSY-4167', '35.00', '/upload/goods_img/户外服饰/5db3b8b9bbe9c.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('52', '户外途量工厂专卖店', '城徒 户外春夏单层冲锋衣女防晒衣男轻薄防风钓鱼服透气速干外套长袖衫', '', '35.80', '/upload/goods_img/户外服饰/5db3b8ba1b847.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('53', '好看哒专营店', '防晒衣韩版短款薄款连帽长袖防晒衣', 'FSY-5439', '36.00', '/upload/goods_img/户外服饰/5db3b8ba72314.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('54', '好看哒专营店', '防晒衣女中长款涂鸦薄款防晒衣', 'FSY-5282', '36.00', '/upload/goods_img/户外服饰/5db3b8ba99fd5.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('55', '好看哒专营店', '防晒衣女中长款薄款防晒衣', 'FSY-5456', '37.90', '/upload/goods_img/户外服饰/5db3b8baa8e20.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('56', '户外途量工厂专卖店', '秋冬户外男抓绒衣摇粒绒女外套保暖冲锋衣内胆开衫卫衣', '', '39.00', '/upload/goods_img/户外服饰/5db3b8bab267b.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('57', '户外途量工厂专卖店', '户外秋冬季加绒加厚抓绒衣男女摇粒绒保暖抓绒外套开衫冲锋衣内胆', '', '49.00', '/upload/goods_img/户外服饰/5db3b8bae0cb5.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('58', '江门新会馆', '【江门新会馆】caxa断码 两截速干裤女 韩版修身透气徒步快干裤野外登山跑步长裤', '', '50.00', '/upload/goods_img/户外服饰/5db3b8baf06b9.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('59', '宝仕母婴专营店专柜', 'L夏季休闲短裤男宽松5分中裤子男士运动五分裤大码跑步速干沙滩裤', '', '55.00', '/upload/goods_img/户外服饰/5db3b8bb2ba54.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('60', '江门新会馆', '【江门新会馆】caxa修身户外健身速干裤女 快干弹力透气登山大码长裤 弹力户外裤', '', '60.00', '/upload/goods_img/户外服饰/5db3b8bb513ed.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('61', '探路者正江专卖店', '探路者/TOREADt恤女户外夏季快干速干透气运动服TAJG82984', '', '61.00', '/upload/goods_img/户外服饰/5db3b8bb5ac47.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('62', '铁好家居美妆日用百货专营店', '佳钓尼 夏遮阳防晒帽套头面罩透气防紫外线渔夫帽', '', '48.00', '/upload/goods_img/户外服饰/5db3b8bb8e0a3.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('63', '宝仕母婴专营店专柜', '防晒衣男女情侣春夏季防雨风衣超薄透气速干钓鱼防晒服户外皮肤衣MN', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bb9f9e7.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('64', '户外途量工厂专卖店', '城徒 春夏季速干裤男女大码轻薄快干透气户外修身显瘦弹力冲锋裤', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbb3e24.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('65', '宝仕母婴专营店专柜', 'L运动户外夏季速干t恤 男女短袖速干衣快干t恤 吸汗透气', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bbe33ff.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('66', '宝仕母婴专营店专柜', 'L健身房教练速干T恤男女 圆领情侣夏季短袖汗衫', '', '69.00', '/upload/goods_img/户外服饰/5db3b8bc1bca2.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('67', '户外途量工厂专卖店', '城徒 冬季正品户外冲锋裤男女抓绒裤保暖防风防水加厚软壳裤登山裤长裤', '', '75.00', '/upload/goods_img/户外服饰/5db3b8bc42dab.jpg', '1572059516', '0', '1', null);
INSERT INTO `xy_shop_goods_list` VALUES ('68', '江门新会馆', '【江门新会馆】caxa修身弹力女款休闲棉裤 户外休闲快干长裤 女士跑步登山健身裤', '', '78.00', '/upload/goods_img/户外服饰/5db3b8bc96997.jpg', '1572059516', '0', '1', null);

-- ----------------------------
-- Table structure for xy_shop_order
-- ----------------------------
DROP TABLE IF EXISTS `xy_shop_order`;
CREATE TABLE `xy_shop_order` (
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL COMMENT '商品id',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `price` decimal(15,3) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '上架状态 0不上架 1上架',
  `num` int(11) DEFAULT NULL,
  `price2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id` char(18) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of xy_shop_order
-- ----------------------------
INSERT INTO `xy_shop_order` VALUES ('20', '2', '1583407009', '1.000', '1', '1', '1', 'SP2003052017163927');
INSERT INTO `xy_shop_order` VALUES ('19', '1', '1583410636', '1.000', '1', '2', '2', 'SP2003052017163987');
INSERT INTO `xy_shop_order` VALUES ('20', '1', '1585453110', '1.000', '1', '1', '1', 'SP2003291138308901');
INSERT INTO `xy_shop_order` VALUES ('20', '2', '1585453251', '1.000', '1', '1', '1', 'SP2003291140513132');
INSERT INTO `xy_shop_order` VALUES ('20', '2', '1585453282', '1.000', '2', '1', '1', 'SP2003291141221124');

-- ----------------------------
-- Table structure for xy_users
-- ----------------------------
DROP TABLE IF EXISTS `xy_users`;
CREATE TABLE `xy_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '手机',
  `username` varchar(36) NOT NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(36) NOT NULL DEFAULT '' COMMENT '昵称',
  `pwd` char(40) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(16) NOT NULL DEFAULT '' COMMENT '密码盐',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `signiture` varchar(120) NOT NULL DEFAULT '' COMMENT '个性签名',
  `pwd_error_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '密码错误次数',
  `allow_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '允许登录时间',
  `real_name` varchar(36) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `id_card_num` char(18) NOT NULL DEFAULT '' COMMENT '身份证号码',
  `top_pic` varchar(96) NOT NULL DEFAULT '' COMMENT '身份证正面图',
  `bot_pic` varchar(96) NOT NULL DEFAULT '' COMMENT '身份证背面图',
  `id_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '实名认证状态，0未审核，1审核通过，2审核不通过',
  `invite_code` char(6) NOT NULL DEFAULT '' COMMENT '邀请码',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态，1启用，2禁用',
  `real_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '实名时间',
  `pwd2` char(40) NOT NULL DEFAULT '' COMMENT '提现密码',
  `salt2` char(16) NOT NULL DEFAULT '' COMMENT '提现密码盐',
  `headpic` varchar(3000) NOT NULL DEFAULT '' COMMENT '头像',
  `balance` decimal(15,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `freeze_balance` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '账号冻结金额',
  `login_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否登录状态，1：是，0否',
  `recharge_num` decimal(7,2) NOT NULL DEFAULT '0.00' COMMENT '日充值金额',
  `deposit_num` decimal(7,2) NOT NULL DEFAULT '0.00' COMMENT '日提现金额',
  `deal_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '交易状态，0交易冻结，1停止交易，2等待交易，3交易中',
  `deal_error` tinyint(1) NOT NULL DEFAULT '0' COMMENT '违规次数',
  `deal_reward_count` int(11) NOT NULL DEFAULT '0' COMMENT '奖励交易次数',
  `deal_count` int(4) NOT NULL DEFAULT '0' COMMENT '当日交易次数',
  `deal_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后交易日期(年月日)',
  `active` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '激活状态，0未激活(首次充值发放推广奖励)，1已激活',
  `childs` int(11) NOT NULL DEFAULT '0' COMMENT '直推用户数量',
  `kouchu_balance` decimal(15,2) DEFAULT NULL COMMENT '扣除金额',
  `kouchu_balance_uid` int(11) DEFAULT NULL,
  `show_td` int(11) DEFAULT '1',
  `show_cz` int(11) DEFAULT '1',
  `show_tx` int(11) DEFAULT '1',
  `show_tel` int(11) DEFAULT '1',
  `show_num` int(11) DEFAULT '1',
  `show_tel2` int(11) DEFAULT '1',
  `wx_ewm` varchar(255) DEFAULT NULL,
  `zfb_ewm` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `lixibao_balance` decimal(15,4) DEFAULT '0.0000' COMMENT '利息宝金额',
  `lixibao_dj_balance` decimal(15,4) DEFAULT '0.0000' COMMENT '利息宝冻结金额',
  `ip` varchar(128) DEFAULT NULL,
  `is_jia` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tel` (`tel`),
  UNIQUE KEY `invite_code` (`invite_code`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COMMENT='会员-用户表';

-- ----------------------------
-- Records of xy_users
-- ----------------------------
INSERT INTO `xy_users` VALUES ('20', '13800000000', 'zzmaku.com', '', '64e9cef09c564659f46faaf22ad2a5de413837d6', '8822', '0', '', '0', '0', '', '', '', '', '0', 'BH97KR', '1583483695', '1', '0', '38416425196850b609a73d7cca93ed69e00121a9', '21727', '/static_new6/headimg/38.303cb70.png', '99998.74', '0.00', '1', '0.00', '0.00', '1', '0', '18', '0', '1586880000', '1', '9', '0.00', '0', '1', '1', '1', '1', '1', '1', null, null, '3', '222.0000', '0.0000', '127.0.0.1', '0');
INSERT INTO `xy_users` VALUES ('21', '13800000001', '111', '', '6774930111140147c1d59d55dd01feb6a2401436', '65438', '20', '', '0', '0', '', '', '', '', '0', 'MH7V2W', '1584292840', '1', '0', '', '', '', '55.00', '0.00', '0', '0.00', '0.00', '1', '0', '0', '0', '0', '0', '0', null, null, '1', '1', '1', '1', '1', '1', null, null, '0', '0.0000', '0.0000', null, '0');
INSERT INTO `xy_users` VALUES ('22', '13800000002', '222', '', '979183762e7c8ce54f3a038a611b82500cf8b023', '44317', '20', '', '0', '0', '', '', '', '', '0', 'HXVMUG', '1584292854', '1', '0', '', '', '', '0.00', '0.00', '0', '0.00', '0.00', '1', '0', '0', '0', '0', '0', '0', null, null, '1', '1', '1', '1', '1', '1', null, null, null, '0.0000', '0.0000', null, '0');
INSERT INTO `xy_users` VALUES ('23', '13800000003', '333', '', 'dafdf9a585f81f134c89e61bbcc86bd0a48b5c9e', '30230', '20', '', '0', '0', '', '', '', '', '0', 'PWBESH', '1584292869', '1', '0', '', '', '', '0.00', '0.00', '0', '0.00', '0.00', '1', '0', '0', '0', '0', '0', '0', null, null, '1', '1', '1', '1', '1', '1', null, null, null, '0.0000', '0.0000', null, '0');
INSERT INTO `xy_users` VALUES ('24', '13800000004', '444', '', '2fee1c110a874777cffff477fbb444cd906e2836', '29049', '20', '', '0', '0', '', '', '', '', '0', 'SJZ854', '1584292884', '1', '0', '', '', '', '0.00', '0.00', '0', '0.00', '0.00', '1', '0', '0', '0', '0', '0', '0', null, null, '1', '1', '1', '1', '1', '1', null, null, null, '0.0000', '0.0000', null, '0');
INSERT INTO `xy_users` VALUES ('25', '13800000005', '555', '', '2444ff3ddb9d73348426328ab40fee3a51f6012a', '2154', '20', '', '0', '0', '', '', '', '', '0', 'ESKHQW', '1584292902', '1', '0', '', '', '', '0.00', '0.00', '0', '0.00', '0.00', '1', '0', '0', '0', '0', '0', '0', null, null, '1', '1', '1', '1', '1', '1', null, null, null, '0.0000', '0.0000', null, '0');
INSERT INTO `xy_users` VALUES ('26', '13800000006', '666', '', '28360a528d9e31770bbee982ef8148d7917bbb96', '61630', '20', '', '0', '0', '', '', '', '', '0', 'RMPGUV', '1584292916', '1', '0', '', '', '', '0.00', '0.00', '0', '0.00', '0.00', '1', '0', '0', '0', '0', '0', '0', null, null, '1', '1', '1', '1', '1', '1', null, null, null, '0.0000', '0.0000', null, '0');
INSERT INTO `xy_users` VALUES ('27', '13800000007', '777', '', 'c640ad7cb0509814f3e42db9627f395f5b2bb889', '16738', '20', '', '0', '0', '', '', '', '', '0', 'P6352E', '1584292930', '1', '0', '', '', '', '0.00', '0.00', '0', '0.00', '0.00', '1', '0', '0', '0', '0', '0', '0', null, null, '1', '1', '1', '1', '1', '1', null, null, null, '0.0000', '0.0000', null, '0');
INSERT INTO `xy_users` VALUES ('28', '13800000008', '888', '', 'fc416c9313e4544d45e1290dddd354c414fbf90a', '4061', '20', '', '0', '0', '', '', '', '', '0', 'VQNC85', '1584293015', '1', '0', '', '', '', '0.00', '0.00', '0', '0.00', '0.00', '1', '0', '0', '0', '0', '0', '0', null, null, '1', '1', '1', '1', '1', '1', null, null, null, '0.0000', '0.0000', null, '0');
INSERT INTO `xy_users` VALUES ('29', '13800000009', '999', '', '4c2851298e214ceb2027b335b96a6f7c45818da7', '982', '28', '', '0', '0', '', '', '', '', '0', '4G6ECF', '1584293030', '1', '0', '', '', '', '0.00', '0.00', '0', '0.00', '0.00', '1', '0', '0', '0', '0', '0', '0', null, null, '1', '1', '1', '1', '1', '1', null, null, '0', '0.0000', '0.0000', null, '0');
INSERT INTO `xy_users` VALUES ('30', '13800000011', 'fang', '', '8faf9783a6dc50c90661f518de14165e22a9bbc2', '35532', '0', '', '0', '0', '', '', '', '', '0', 'HCKTUA', '1585100307', '1', '0', 'c18ba8d8cda8217ad038b0ff7200b780e6f50da6', '5631', '', '0.00', '0.00', '1', '0.00', '0.00', '1', '0', '0', '0', '0', '0', '0', null, null, '1', '1', '1', '1', '1', '1', null, null, null, '0.0000', '0.0000', null, '0');

-- ----------------------------
-- Table structure for xy_user_error
-- ----------------------------
DROP TABLE IF EXISTS `xy_user_error`;
CREATE TABLE `xy_user_error` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `addtime` int(11) NOT NULL COMMENT '记录时间',
  `oid` char(18) DEFAULT '' COMMENT '交易单号',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '记录类型 1解封 2违规操作 3冻结',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COMMENT='会员-违规操作记录表';

-- ----------------------------
-- Records of xy_user_error
-- ----------------------------

-- ----------------------------
-- Table structure for xy_verify_msg
-- ----------------------------
DROP TABLE IF EXISTS `xy_verify_msg`;
CREATE TABLE `xy_verify_msg` (
  `tel` char(11) NOT NULL DEFAULT '' COMMENT '用户ID',
  `msg` char(5) NOT NULL DEFAULT '' COMMENT '验证码',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发送时间',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型，1注册,2修改密码，3修改二级密码',
  PRIMARY KEY (`tel`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of xy_verify_msg
-- ----------------------------
