-- MySQL dump 10.13  Distrib 5.6.47, for Linux (x86_64)
--
-- Host: localhost    Database: qkg
-- ------------------------------------------------------
-- Server version	5.6.47-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `me_actionlog`
--

DROP TABLE IF EXISTS `me_actionlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_actionlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='操作记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_actionlog`
--

LOCK TABLES `me_actionlog` WRITE;
/*!40000 ALTER TABLE `me_actionlog` DISABLE KEYS */;
INSERT INTO `me_actionlog` VALUES (1,10,'dgadmin','2020-03-02 13:06:49设置初始会员soya12333','123.9.253.238',1583125609,1583125609),(2,10,'dgadmin','2020-03-03 00:02:13新增宠物：生肖幸运狗','117.191.242.254',1583164933,1583164933),(3,10,'dgadmin','2020-03-03 00:03:45新增宠物：生肖幸运猴','117.191.242.254',1583165025,1583165025),(4,10,'dgadmin','2020-03-03 00:04:20新增宠物：生肖幸运猪','117.191.242.254',1583165060,1583165060),(5,10,'dgadmin','2020-03-03 00:04:50新增宠物：生肖幸运马','117.191.242.254',1583165090,1583165090),(6,10,'dgadmin','2020-03-03 00:04:54新增宠物：生肖幸运马','117.191.242.254',1583165094,1583165094),(7,10,'dgadmin','2020-03-03 00:05:03新增宠物：生肖幸运马','117.191.242.254',1583165103,1583165103),(8,10,'dgadmin','2020-03-03 00:05:38新增宠物：生肖幸运马','117.191.242.254',1583165138,1583165138),(9,10,'dgadmin','2020-03-03 00:06:07新增宠物：生肖幸运牛','117.191.242.254',1583165167,1583165167),(10,10,'dgadmin','2020-03-03 00:06:25编辑宠物：生肖幸运兔的信息','117.191.242.254',1583165185,1583165185),(11,10,'dgadmin','2020-03-03 00:06:32编辑宠物：生肖幸运鸡的信息','117.191.242.254',1583165192,1583165192),(12,10,'dgadmin','2020-03-03 00:06:55新增宠物：生肖幸运马','117.191.242.254',1583165215,1583165215),(13,10,'dgadmin','2020-03-03 00:10:28新增宠物：幸运生肖马','117.191.242.254',1583165428,1583165428),(14,10,'dgadmin','2020-03-03 00:12:49新增宠物：生肖幸运马','117.191.242.254',1583165569,1583165569),(15,10,'dgadmin','2020-03-03 09:35:57修改配置参数','223.73.168.248',1583199357,1583199357),(16,10,'dgadmin','2020-03-03 09:45:48编辑新闻：新手指南的信息','223.73.168.248',1583199948,1583199948),(17,10,'dgadmin','2020-03-03 09:46:42编辑新闻：新手指南的信息','223.73.168.248',1583200002,1583200002),(18,10,'dgadmin','2020-03-03 09:47:09编辑新闻：新手指南的信息','223.73.168.248',1583200029,1583200029),(19,10,'dgadmin','2020-03-03 09:51:55修改配置参数','223.73.168.248',1583200315,1583200315),(20,10,'dgadmin','2020-03-03 09:54:15拨发会员：slslslslsl 100 积分','223.73.168.248',1583200455,1583200455),(21,10,'dgadmin','2020-03-03 09:55:29编辑会员：slslslslsl信息','223.73.168.248',1583200529,1583200529),(22,10,'dgadmin','2020-03-03 10:03:57编辑宠物：生肖幸运鼠的信息','223.73.168.248',1583201037,1583201037),(23,10,'dgadmin','2020-03-03 10:10:51拨发会员：slslslslsl 333 推荐收益','223.73.168.248',1583201451,1583201451),(24,10,'dgadmin','2020-03-03 10:10:57发行宠物：生肖幸运鼠数量：1归属用户ID：58','223.73.168.248',1583201457,1583201457),(25,10,'dgadmin','2020-03-03 10:11:16拨发会员：a123456789 100 积分','223.73.168.248',1583201476,1583201476),(26,10,'dgadmin','2020-03-03 10:11:44编辑宠物：生肖幸运鼠的信息','223.73.168.248',1583201504,1583201504),(27,10,'dgadmin','2020-03-03 10:13:44拨发会员：qq123456 100 积分','223.73.168.248',1583201624,1583201624),(28,10,'dgadmin','2020-03-03 10:17:07编辑宠物：生肖幸运鸡的信息','223.73.168.248',1583201827,1583201827),(29,10,'dgadmin','2020-03-03 10:17:26拨发会员：slslslslsl 888 推荐收益','223.73.168.248',1583201846,1583201846),(30,10,'dgadmin','2020-03-03 10:17:37发行宠物：生肖幸运鸡数量：1归属用户ID：58','223.73.168.248',1583201857,1583201857),(31,10,'dgadmin','2020-03-03 10:29:39修改id为：，的直推静态收益配置','223.73.168.248',1583202579,1583202579),(32,10,'dgadmin','2020-03-03 10:35:27修改配置参数','223.73.168.248',1583202927,1583202927),(33,10,'dgadmin','2020-03-03 10:38:24新增管理员6868','223.73.168.248',1583203104,1583203104),(34,10,'dgadmin','2020-03-03 10:40:49删除宠物：2','223.73.168.248',1583203249,1583203249),(35,10,'dgadmin','2020-03-03 10:40:54删除宠物：1','223.73.168.248',1583203254,1583203254),(36,10,'dgadmin','2020-03-03 10:44:17修改管理员zyw888的密码','223.73.168.248',1583203457,1583203457),(37,13,'6868','2020-03-03 18:53:53修改管理员dgadmin的密码','113.86.206.67',1583232833,1583232833),(38,13,'6868','2020-03-03 18:54:10修改管理员zyw888的密码','113.86.206.67',1583232850,1583232850),(39,13,'6868','2020-03-03 19:44:51拨发会员：a123456789 100 推荐收益','113.86.206.67',1583235891,1583235891),(40,13,'6868','2020-03-03 19:55:54拨发会员：a123456789 100 推荐收益','113.86.206.67',1583236554,1583236554),(41,13,'6868','2020-03-03 19:56:27发行宠物：生肖幸运鼠数量：1归属用户ID：40','113.86.206.67',1583236587,1583236587),(42,13,'6868','2020-03-03 20:06:11删除宠物：3','113.86.206.67',1583237171,1583237171),(43,13,'6868','2020-03-03 20:12:55编辑宠物：生肖幸运狗的信息','113.86.206.67',1583237575,1583237575),(44,13,'6868','2020-03-03 20:13:22拨发会员：slslslslsl 1001 推荐收益','113.86.206.67',1583237602,1583237602),(45,13,'6868','2020-03-03 20:13:40发行宠物：生肖幸运狗数量：1归属用户ID：58','113.86.206.67',1583237620,1583237620),(46,13,'6868','2020-03-03 20:15:13拨发会员：slslslslsl 1001 推荐收益','113.86.206.67',1583237713,1583237713),(47,13,'6868','2020-03-03 20:15:54编辑宠物：生肖幸运羊的信息','113.86.206.67',1583237754,1583237754),(48,13,'6868','2020-03-03 20:16:35发行宠物：生肖幸运羊数量：1归属用户ID：58','113.86.206.67',1583237795,1583237795);
/*!40000 ALTER TABLE `me_actionlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_actteam`
--

DROP TABLE IF EXISTS `me_actteam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_actteam` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `min_num` int(11) NOT NULL COMMENT '级别名称',
  `max_num` int(11) DEFAULT NULL COMMENT '等级金额',
  `active_per` decimal(11,6) DEFAULT NULL COMMENT '分红奖比例',
  `shop_per` decimal(11,6) DEFAULT '0.000000' COMMENT '分红奖层级',
  `branch_id` int(11) DEFAULT NULL COMMENT '分公司id',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_actteam`
--

LOCK TABLES `me_actteam` WRITE;
/*!40000 ALTER TABLE `me_actteam` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_actteam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_admin`
--

DROP TABLE IF EXISTS `me_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL COMMENT '分公司id',
  `authids` text COLLATE utf8_unicode_ci,
  `last_login_at` int(11) DEFAULT NULL,
  `login_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `app_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '管理员登录验证',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`phone`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT COMMENT='后台管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_admin`
--

LOCK TABLES `me_admin` WRITE;
/*!40000 ALTER TABLE `me_admin` DISABLE KEYS */;
INSERT INTO `me_admin` VALUES (8,'sss','t5Tx0nlsI4G2-AnXLPnCYCVxetMm4mUN','$2y$13$VQx4jMRqJXjxzwPMBsWF5eMbsAXvpMnnf1riwkf1P075hO8Zj0OSi','','13276040871',10,'262051476@qq.com',0,'1,2,3,4,17,18,20,31,32,47,59,60,61,81,82,83,86,88,89,92,121,129,138,142,143,144,145,146,147,148,149,152,154,155,158,160,164,188,189,191,193,194,195,196,197,198,199,200,201,202,204,205,206,208,210,211,212,213,214,215,216,217,218,219',1566922197,'183.250.213.63',1506583595,1566922197,'561892e360bddd839c321de46feb69a3'),(10,'dgadmin','FNPQzgGDhaomil0vnTHPOO-OudOlYuPp','$2y$13$4oDOcTWV9jYsEMxstbHiQOWanNqVdrFtGfba5mE4m.O0q2AoeZ0LO',NULL,'13505059384',10,'13505059384@localhost.com',NULL,'1,2,3,4,17,18,20,31,32,47,59,60,61,81,82,83,86,88,89,92,121,129,138,142,143,144,145,146,147,148,149,152,154,155,158,160,164,188,189,191,193,194,195,196,197,198,199,200,201,202,204,205,206,208,210,211,212,213,214,215,216,217,218,219',1583198876,'223.73.168.248',1563179773,1583232833,'8061451789058dba9f61d4709cf995a6'),(12,'zyw888','2ZOcfDAMRffbzISEVwEdgAH0oD3lY2mr','$2y$13$yWCEA7WS2pLZQBrVatsZXOyGt0.sNS6ClKYdbbgy3/iSPdbMe2MBS',NULL,'18950059876',10,'264511564+61964@qq.com',NULL,'3,4,17,18,20,31,32,47,59,60,61,81,82,83,86,88,89,92,121,129,138,142,143,144,145,146,147,148,149,152,154,155,158,160,164,188,189,191,193,194,195,196,197,198,199,200,201,202,204,205,206,208,210,211,212,213,214,215,216,217,218,219',1568597643,'117.30.104.169',1566978510,1583232850,'7c8ca352a17c9637aa4c8fdfdb5b48a2'),(13,'6868','iirdoAxbmLpx2HTMVWEBlTie3lj1MMjg','$2y$13$YTQI4dt8tsR.8/ZzQgPgX.LTJT3wRasfsPpQwkfFpGOsZXTdTEskC',NULL,'13145645678',10,'13505059381@localhost.com',NULL,'1,2,3,4,17,18,20,31,32,47,59,60,61,81,82,83,86,88,89,92,121,129,138,142,143,144,145,146,147,148,149,152,154,155,158,160,164,188,189,191,193,194,195,196,197,198,199,200,201,202,204,205,206,208,210,211,212,213,214,215,216,217,218,219',1583236040,'113.86.206.67',1583203104,1583236040,'a317988598ec215773b9d5fbe21bf754');
/*!40000 ALTER TABLE `me_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_advertisement`
--

DROP TABLE IF EXISTS `me_advertisement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_advertisement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL COMMENT '轮播广告',
  `url` varchar(255) NOT NULL COMMENT '链接',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `content` varchar(255) NOT NULL COMMENT '标题',
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_advertisement`
--

LOCK TABLES `me_advertisement` WRITE;
/*!40000 ALTER TABLE `me_advertisement` DISABLE KEYS */;
INSERT INTO `me_advertisement` VALUES (7,'http://dgdata.tmf520.cn/upload/app/b0619ff75a45648ac37144dd7f815593.jpg','',1564641174,'轮播1',1564641174),(8,'http://dgdata.tmf520.cn/upload/app/e4044943ab70af57ea1ae6a9c1d2e5e1.jpg','',1564641191,'轮播2',1564641191);
/*!40000 ALTER TABLE `me_advertisement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_applypurchase`
--

DROP TABLE IF EXISTS `me_applypurchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_applypurchase` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '申购订单表ID',
  `userid` int(11) DEFAULT NULL COMMENT '用户ID',
  `username` varchar(50) DEFAULT NULL COMMENT '用户名',
  `wallet_token` varchar(255) DEFAULT NULL COMMENT '公有链钱包地址',
  `number` decimal(20,2) DEFAULT '0.00' COMMENT '申购数量',
  `totalamount` decimal(20,2) DEFAULT '0.00' COMMENT '总支出',
  `miner_fee` decimal(20,2) DEFAULT '0.00' COMMENT '手续费(旷工费)',
  `miner_rate` decimal(20,2) DEFAULT '0.00' COMMENT '手续费率(矿工费率)',
  `coin_price` decimal(20,2) DEFAULT '0.00' COMMENT '数字货币价格',
  `coin_type` varchar(255) DEFAULT NULL COMMENT '数字货币类型',
  `status` int(2) DEFAULT NULL COMMENT '订单状态: 0. 申购中, 1. 申购已完成, 2. 申购未成功',
  `created_at` int(11) DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) DEFAULT '0' COMMENT '更新时间',
  `add_label` varchar(255) DEFAULT NULL COMMENT '地址标签',
  `branch_id` int(11) DEFAULT NULL COMMENT '分公司id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_applypurchase`
--

LOCK TABLES `me_applypurchase` WRITE;
/*!40000 ALTER TABLE `me_applypurchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_applypurchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_area`
--

DROP TABLE IF EXISTS `me_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(100) NOT NULL COMMENT '地区名称',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_area`
--

LOCK TABLES `me_area` WRITE;
/*!40000 ALTER TABLE `me_area` DISABLE KEYS */;
INSERT INTO `me_area` VALUES (1,'中国',1481288299,1481288299),(2,'印度',1481288311,1481288311),(3,'印度尼西亚',1481288330,1481288330),(4,'台湾',1481288360,1481288360),(5,'泰国',1481288375,1481288375),(6,'澳大利亚',1481288402,1481288402),(7,'美国',1481288418,1481288418),(8,'英国',1481288426,1481288426),(9,'香港',1481288443,1481288443),(10,'马来西亚',1481288460,1481288460);
/*!40000 ALTER TABLE `me_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_area_code`
--

DROP TABLE IF EXISTS `me_area_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_area_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '国家区号的id',
  `code` text,
  `country` varchar(50) DEFAULT NULL COMMENT '国家名',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_area_code`
--

LOCK TABLES `me_area_code` WRITE;
/*!40000 ALTER TABLE `me_area_code` DISABLE KEYS */;
INSERT INTO `me_area_code` VALUES (1,'86','中国'),(2,'44','英国'),(3,'61','澳大利亚'),(4,'91','印度'),(5,'66','泰国'),(6,'49','德国'),(7,'62','印度尼西亚'),(8,'855','柬埔寨'),(9,'60','马来西亚'),(10,'856','老挝'),(11,'852','香港'),(12,'81','日本'),(13,'65','新加坡'),(14,'63','菲律宾'),(15,'886','台湾'),(16,'1','美国'),(17,'82','韩国'),(18,'853','澳门'),(19,'84','越南'),(20,'90','土耳其'),(21,'880','孟加拉国	'),(22,'39','意大利'),(23,'43','奥地利'),(24,'506','哥斯达黎加'),(25,'34','西班牙');
/*!40000 ALTER TABLE `me_area_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_article`
--

DROP TABLE IF EXISTS `me_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `typeid` int(11) NOT NULL COMMENT '所属类别',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `content` longtext NOT NULL COMMENT '内容',
  `title_en` varchar(100) NOT NULL COMMENT '英文标题',
  `content_en` longtext NOT NULL COMMENT '英文内容',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` text COMMENT '摘要',
  `thumb` varchar(100) DEFAULT NULL COMMENT '缩略图',
  `flags` set('a','b','c','h','f','s','p','j') DEFAULT NULL COMMENT '自定义属性',
  `author` varchar(30) DEFAULT NULL COMMENT '作者',
  `referer` varchar(50) DEFAULT NULL COMMENT '来源',
  `senddate` int(11) DEFAULT NULL COMMENT '发布日期',
  `audit` tinyint(4) NOT NULL DEFAULT '0' COMMENT '审核',
  `audit_at` int(11) DEFAULT NULL COMMENT '审核时间',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `branch_id` int(11) DEFAULT '0' COMMENT '分公司id',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='文章表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_article`
--

LOCK TABLES `me_article` WRITE;
/*!40000 ALTER TABLE `me_article` DISABLE KEYS */;
INSERT INTO `me_article` VALUES (4,43,'新手指南','<p><span style=\"color: rgb(255, 0, 0); font-family: 楷体,楷体_GB2312,SimKai;\">操作流程:</span></p><p><span style=\"color: rgb(255, 0, 0); font-family: 楷体,楷体_GB2312,SimKai;\">1、扫描推荐人二维码注册，注册成功后实名认证成功充值积分既可激活游戏！&nbsp;</span></p><p><span style=\"color: rgb(255, 0, 0); font-family: 楷体,楷体_GB2312,SimKai;\">2、添加支付宝和微信收款码或者银行卡号（提示:必须添加2种收款方式，上传的收款方式无法修改，请谨慎操作！)</span></p><p><span style=\"color: rgb(255, 0, 0); font-family: 楷体,楷体_GB2312,SimKai;\">3、在实名认证栏，填上真实姓名和相符的身份证号码，24小时之内系统自动审核（提示:必须完成收款方式绑定才可实名认证！）</span></p><p><span style=\"color: rgb(255, 0, 0); font-family: 楷体,楷体_GB2312,SimKai;\">4、积分获取方法:1.向推荐人购买直接转入。2.联系客服充值！</span></p><p><span style=\"color: rgb(255, 0, 0); font-family: 楷体,楷体_GB2312,SimKai;\">5、预约需消耗积分，到领养场次时间点击抢购，领养未成功的积分会在次日退回您的账户；不预约直接抢购会消耗双倍积分！</span></p><p><span style=\"color: rgb(255, 0, 0); font-family: 楷体,楷体_GB2312,SimKai;\">6、领养成功后到领养记录查看，并按照转让方提供的收款方式付款，上传付款凭证，等待确认即可，付款时间为2小时之内！（注意:超过2个小时未付款的，系统将封禁领养方账户，封禁的账户在次日凌晨0点之前联系客服解封，封禁超过24小时之后将永久锁定，请大家规范操作。）情节严重的将永久封禁！</span></p><p><span style=\"color: rgb(255, 0, 0); font-family: 楷体,楷体_GB2312,SimKai;\">7、当领养方上传的付款凭证为虚假截图时，转让方可以发起申诉，等待客服审核，一旦核实将封禁领养方账户！转让方未成功转让的生肖将在第二天的同一时间场次继续自动转让！</span></p><p><span style=\"color: rgb(255, 0, 0); font-family: 楷体,楷体_GB2312,SimKai;\">8、每天凌晨1点前系统自动结算您领养生肖收益，当生肖合约到期，系统会在当天该场次自动挂卖，当天到期的生肖会显示在“待转让”区域！</span></p><p><span style=\"color: rgb(255, 0, 0); font-family: 楷体,楷体_GB2312,SimKai;\">9、当您领养的生肖价格超过领养时段的最高价格时，自动升级到相对应的生肖时间场次转让！（生肖超出自身最高金额时，超出的金额也会变成相对应价格的生肖）</span></p><p><br/></p>','l','<p>l</p><br/>',NULL,NULL,'error',NULL,NULL,NULL,1583200029,0,NULL,0,0,1566065915,1583200029);
/*!40000 ALTER TABLE `me_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_bank`
--

DROP TABLE IF EXISTS `me_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(100) NOT NULL COMMENT '银行名称',
  `en_name` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='银行类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_bank`
--

LOCK TABLES `me_bank` WRITE;
/*!40000 ALTER TABLE `me_bank` DISABLE KEYS */;
INSERT INTO `me_bank` VALUES (1,'华南银行','HNB',1481721271,1481721271),(2,'合作金库银行','TCB',1481721296,1481721296),(3,'国泰世华银行','CUB',1481721316,1481721316),(4,'中国银行','BOC',1484451318,1484451318),(5,'中国农业银行','ABC',1484451348,1484451348),(6,'中国建设银行','CCB',1484451361,1484451361),(7,'中国工商银行','ICBC',1484451380,1484451380),(8,'中国交通银行','BCM',1493778150,1493778150),(9,'中国平安银行','PAB',1493778155,1493778155),(10,'招商银行','CMB',1493789872,1493789872);
/*!40000 ALTER TABLE `me_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_bank_realname`
--

DROP TABLE IF EXISTS `me_bank_realname`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_bank_realname` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '存银行卡四要素 表的id',
  `userid` int(11) NOT NULL COMMENT '会员id',
  `username` varchar(255) DEFAULT NULL COMMENT '会员名称',
  `name` varchar(255) DEFAULT NULL COMMENT '银行卡的账户名（真实姓名）',
  `phoneNo` varchar(50) DEFAULT NULL COMMENT '开通银行卡的手机号',
  `idNo` varchar(50) DEFAULT NULL COMMENT '开通银行卡的身份证号',
  `bankName` varchar(255) DEFAULT NULL COMMENT '银行卡名称',
  `bankKind` varchar(255) DEFAULT NULL COMMENT '银行卡种类',
  `bankType` varchar(255) DEFAULT NULL COMMENT '银行卡类型',
  `bankCode` varchar(255) DEFAULT NULL COMMENT '银行简称',
  `cardNo` varchar(50) DEFAULT NULL COMMENT '银行卡号',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `is_success` int(10) DEFAULT '0' COMMENT '是否认证成功,0:待认证  1认证失败 2认证成功',
  `reason` varchar(255) DEFAULT NULL COMMENT '认证失败原因',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_bank_realname`
--

LOCK TABLES `me_bank_realname` WRITE;
/*!40000 ALTER TABLE `me_bank_realname` DISABLE KEYS */;
INSERT INTO `me_bank_realname` VALUES (1,128,'zgz992290','郑光座','','350425199201043112',NULL,NULL,NULL,NULL,'',1566921426,2,NULL),(2,163,'zpl26612','周培龙','','350724199402231531',NULL,NULL,NULL,NULL,'',1566954598,2,NULL),(3,72,'qq104134','李琪','','510723200009191123',NULL,NULL,NULL,NULL,'',1566956369,2,NULL),(4,196,'sh5089809','徐道志','','350724199808192018',NULL,NULL,NULL,NULL,'',1566957347,2,NULL),(5,184,'yjz62412','叶金璋','','350783199610094092',NULL,NULL,NULL,NULL,'',1566957892,2,NULL),(6,302,'zixin3475','李鑫','','230624199101131752',NULL,NULL,NULL,NULL,'',1566959060,2,NULL),(7,1,'qck900210','薛雷','','341226199104122630',NULL,NULL,NULL,NULL,'',1566960137,2,NULL),(8,227,'aniuge11','吴峰','','302305198806054809',NULL,NULL,NULL,NULL,'',1567007494,2,NULL),(9,313,'ldy161616','李大勇','','141033199910270094',NULL,NULL,NULL,NULL,'',1567070974,2,NULL),(10,355,'wh71203671','王辉','','371312199710146416',NULL,NULL,NULL,NULL,'',1567130751,2,NULL),(11,448,'xiaoyang7700','杨连文','','350425198205111026',NULL,NULL,NULL,NULL,'',1567225573,2,NULL),(12,17,'zyw900831','郑严文','','350600199008310518',NULL,NULL,NULL,NULL,'',1567315694,2,NULL),(13,492,'liu574937933','刘庆龙','','411503199112201718',NULL,NULL,NULL,NULL,'',1567343207,2,NULL),(14,568,'mdb127131','毛德宝','','452702200101132671',NULL,NULL,NULL,NULL,'',1567428398,2,NULL),(15,585,'mwd55870','张文龙','','429006199611198235',NULL,NULL,NULL,NULL,'',1567494776,2,NULL),(16,571,'xiaofeng','冯俊豪','','411323199211054412',NULL,NULL,NULL,NULL,'',1567500347,2,NULL),(17,612,'smq102328','孙明琼','','51302819891018372X',NULL,NULL,NULL,NULL,'',1567565459,2,NULL),(18,633,'cwl330268862','陈旺梁','','350425198504232012',NULL,NULL,NULL,NULL,'',1567649595,0,NULL),(19,724,'qwertyui','王飞','','141033199906200018',NULL,NULL,NULL,NULL,'',1567686760,0,NULL),(20,769,'zgb1422581','郑光斌','','350600198906230896',NULL,NULL,NULL,NULL,'',1567686808,2,NULL),(21,804,'yao1422835','姚春春','','350600199305230652',NULL,NULL,NULL,NULL,'',1567687112,2,NULL),(22,849,'yangbing123','杨兵','','510922198910085896',NULL,NULL,NULL,NULL,'',1567737855,0,NULL),(23,872,'f1346519637','姜福蓉','','360481199711033021',NULL,NULL,NULL,NULL,'',1567752930,2,NULL),(24,282,'cdl00001','陈某某','','350583199910105511',NULL,NULL,NULL,NULL,'',1567839694,0,NULL),(25,970,'z06030711','钟君君','','350689198807110596',NULL,NULL,NULL,NULL,'',1568286866,2,NULL),(26,58,'slslslslsl','周文攀','','61072620020503651x',NULL,NULL,NULL,NULL,'',1583200696,2,NULL),(27,40,'a123456789','卜刀一','','440881123456789874',NULL,NULL,NULL,NULL,'',1583201351,2,NULL),(28,106,'qq123456','鹿晗','','440881199906254452',NULL,NULL,NULL,NULL,'',1583201442,2,NULL);
/*!40000 ALTER TABLE `me_bank_realname` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_car`
--

DROP TABLE IF EXISTS `me_car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(200) DEFAULT NULL COMMENT '等级名称',
  `en_name` varchar(200) DEFAULT NULL COMMENT '英语名称',
  `img` varchar(200) DEFAULT NULL COMMENT '矿机图片',
  `level` varchar(50) DEFAULT NULL COMMENT '等级',
  `out_times` int(10) DEFAULT '0' COMMENT '过期天数',
  `price` decimal(20,4) DEFAULT NULL COMMENT '价格',
  `award_per` decimal(20,4) DEFAULT NULL COMMENT '加速释放比例',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_car`
--

LOCK TABLES `me_car` WRITE;
/*!40000 ALTER TABLE `me_car` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_care_order`
--

DROP TABLE IF EXISTS `me_care_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_care_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sell_id` int(11) NOT NULL COMMENT '出售ID',
  `userid` int(11) NOT NULL COMMENT '买家id',
  `username` varchar(50) DEFAULT NULL COMMENT '买家账号',
  `num` decimal(11,2) DEFAULT '0.00' COMMENT '购买数量',
  `price` decimal(11,0) DEFAULT '0' COMMENT '价格',
  `my_num` decimal(11,2) DEFAULT '0.00' COMMENT '购买后账号拥有数量',
  `remain_num` decimal(11,0) DEFAULT '0' COMMENT '出售后剩余数量',
  `ip` varchar(100) DEFAULT NULL COMMENT 'ip',
  `note` text COMMENT '备注',
  `status` int(2) DEFAULT '1' COMMENT '1：成功，2：待处理，3：失败',
  `type` int(2) DEFAULT '1' COMMENT '订单类型（1：普通订单，2：预约订单）',
  `is_gold` int(2) DEFAULT '0' COMMENT '是否金钻会员（0：否，1：是）',
  `created_at` int(11) DEFAULT '0' COMMENT '创建时间',
  `buy_time` int(11) DEFAULT '0' COMMENT '交易时间',
  `updated_at` int(11) DEFAULT '0' COMMENT '更新时间',
  `branch_id` int(11) DEFAULT NULL COMMENT '分公司id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_care_order`
--

LOCK TABLES `me_care_order` WRITE;
/*!40000 ALTER TABLE `me_care_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_care_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_care_price_record`
--

DROP TABLE IF EXISTS `me_care_price_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_care_price_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `price` decimal(20,4) NOT NULL COMMENT '创富积分价格',
  `adminid` int(11) DEFAULT NULL COMMENT '管理员ID',
  `adminname` varchar(100) DEFAULT NULL COMMENT '管理员账号',
  `note` varchar(255) DEFAULT NULL COMMENT '说明',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `created_at` int(11) DEFAULT NULL COMMENT '修改时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_care_price_record`
--

LOCK TABLES `me_care_price_record` WRITE;
/*!40000 ALTER TABLE `me_care_price_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_care_price_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_coins`
--

DROP TABLE IF EXISTS `me_coins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_coins` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(200) NOT NULL COMMENT '货币名称',
  `en_name` varchar(200) DEFAULT NULL COMMENT '英语名称',
  `price` decimal(20,4) NOT NULL DEFAULT '0.0000' COMMENT '人民币价格',
  `img` varchar(200) DEFAULT NULL COMMENT '货币图片',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `baseVolume` decimal(20,4) DEFAULT '0.0000' COMMENT '成交量',
  `percentChange` decimal(20,4) DEFAULT '0.0000' COMMENT '涨跌百分比',
  `us_price` decimal(20,4) DEFAULT '0.0000' COMMENT '美元价格',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_coins`
--

LOCK TABLES `me_coins` WRITE;
/*!40000 ALTER TABLE `me_coins` DISABLE KEYS */;
INSERT INTO `me_coins` VALUES (1,'比特币','BTC',35943.8400,'http://bbacdn.chinafjjdkj.cn/upload/app/6b84f43c9cc9ec86dbb8305b8796b60c.png',1555492694,1555667021,7198.7139,-0.0382,5232.0000),(2,'以太币','ETH',1186.4490,'http://bbacdn.chinafjjdkj.cn/upload/app/6b84f43c9cc9ec86dbb8305b8796b60c.png',1541946441,1555667021,67590.6967,1.1954,172.7000),(3,'柚子币','EOS',37.4271,'http://bbacdn.chinafjjdkj.cn/upload/app/6b84f43c9cc9ec86dbb8305b8796b60c.png',1541946549,1555667023,2718305.9825,-0.1558,5.4479),(4,'泰达币','USDT',47.1282,'http://bbacdn.chinafjjdkj.cn/upload/app/6b84f43c9cc9ec86dbb8305b8796b60c.png',1541946468,1555667024,0.0000,0.7300,6.8600),(9,'瑞波币','XRP',2.2733,'http://bbacdn.chinafjjdkj.cn/upload/app/6b84f43c9cc9ec86dbb8305b8796b60c.png',NULL,1555667025,8369742.3245,-1.8101,0.3309);
/*!40000 ALTER TABLE `me_coins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_dcaredata`
--

DROP TABLE IF EXISTS `me_dcaredata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_dcaredata` (
  `id` int(1) NOT NULL COMMENT '最近1周K线图数据ID',
  `dtime` varchar(50) DEFAULT NULL COMMENT '最近1周具体日期',
  `first` decimal(20,4) DEFAULT NULL COMMENT '开盘价',
  `last` decimal(20,4) DEFAULT NULL COMMENT '收盘价',
  `high` decimal(20,4) DEFAULT NULL COMMENT '最高价',
  `low` decimal(20,4) DEFAULT NULL COMMENT '最低价',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_dcaredata`
--

LOCK TABLES `me_dcaredata` WRITE;
/*!40000 ALTER TABLE `me_dcaredata` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_dcaredata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_dictionary`
--

DROP TABLE IF EXISTS `me_dictionary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_dictionary` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `column_id` int(11) DEFAULT '0' COMMENT '父级ID',
  `name` varchar(100) DEFAULT NULL COMMENT '字典名称',
  `description` varchar(200) DEFAULT NULL COMMENT '字典描述',
  `min` float DEFAULT NULL COMMENT '最小值',
  `max` float DEFAULT NULL COMMENT '最大值',
  `sortid` int(11) DEFAULT '0' COMMENT '排序ID',
  `icon` varchar(100) DEFAULT NULL COMMENT '图标路径',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='通用信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_dictionary`
--

LOCK TABLES `me_dictionary` WRITE;
/*!40000 ALTER TABLE `me_dictionary` DISABLE KEYS */;
INSERT INTO `me_dictionary` VALUES (10,0,'应用类型','应用类型',NULL,NULL,0,'hash/ad/1465797123_2918.png',1465346983,1465797123),(11,10,'手机APP','',NULL,NULL,1082,NULL,1465347008,1465347046),(12,10,'网页','',NULL,NULL,1081,NULL,1465347035,1465347046),(13,0,'图片尺寸','',NULL,NULL,0,'',1465802846,1465805664),(14,13,'300x500','',NULL,NULL,1907,'',1465802869,1465805643),(15,0,'友情链接分类','',NULL,NULL,0,'',1465875613,1465875613),(24,13,'100x100','',NULL,NULL,1908,'',1470232074,1470232074),(25,0,'静态资源文件类型','',NULL,NULL,0,'',1470300142,1470300142),(26,0,'允许访问静态地址','',NULL,NULL,0,'',1470300162,1470300162),(27,25,'php','',NULL,NULL,1660,'',1470300214,1470300214),(28,25,'json','',NULL,NULL,1661,'',1470300223,1470300223),(29,26,'http://metools.cn/','',NULL,NULL,1205,'',1470300246,1470301979),(30,0,'静态资源目录','',NULL,NULL,0,'',1470300532,1470300532),(31,30,'statics','',NULL,NULL,1905,'',1470300673,1470358280),(33,13,'2000x450','',NULL,NULL,1910,'',1471240504,1471248493),(40,0,'新闻类别','新闻类别',NULL,NULL,0,'',1480772062,1480772062),(42,40,'系统公告',NULL,NULL,NULL,1727,NULL,1556162014,1556162014),(43,40,'新手指南',NULL,NULL,NULL,1727,NULL,1556162014,1556162014);
/*!40000 ALTER TABLE `me_dictionary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_dirctory`
--

DROP TABLE IF EXISTS `me_dirctory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_dirctory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '目录名称',
  `title` varchar(100) NOT NULL COMMENT '目录说明',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='文件管理表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_dirctory`
--

LOCK TABLES `me_dirctory` WRITE;
/*!40000 ALTER TABLE `me_dirctory` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_dirctory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_dirfile`
--

DROP TABLE IF EXISTS `me_dirfile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_dirfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '目录ID',
  `name` varchar(100) NOT NULL COMMENT '文件名称',
  `title` varchar(100) NOT NULL COMMENT '文件说明',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='目录管理文件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_dirfile`
--

LOCK TABLES `me_dirfile` WRITE;
/*!40000 ALTER TABLE `me_dirfile` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_dirfile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_dt_award`
--

DROP TABLE IF EXISTS `me_dt_award`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_dt_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userid` int(11) NOT NULL COMMENT '会员id',
  `username` varchar(50) NOT NULL COMMENT '会员账号',
  `amount` decimal(11,4) DEFAULT '0.0000' COMMENT '奖励数量',
  `event_type` int(2) NOT NULL COMMENT '事件类型1 => "成为正式会员送的签到奖励",\r\n        2 => "成为正式会员推荐人获得奖励",',
  `status` int(2) DEFAULT '2' COMMENT '状态（1：已领取，2：未领取）',
  `note` text COMMENT '备注',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `click_time` int(11) DEFAULT NULL COMMENT '获取时间',
  `branch_id` int(11) DEFAULT NULL COMMENT '分公司id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='会员奖励记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_dt_award`
--

LOCK TABLES `me_dt_award` WRITE;
/*!40000 ALTER TABLE `me_dt_award` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_dt_award` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_email_code`
--

DROP TABLE IF EXISTS `me_email_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_email_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL COMMENT '邮箱',
  `code` varchar(10) NOT NULL COMMENT '验证码',
  `create_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `ip` varchar(100) DEFAULT NULL COMMENT 'IP地址',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='邮箱验证码';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_email_code`
--

LOCK TABLES `me_email_code` WRITE;
/*!40000 ALTER TABLE `me_email_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_email_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_email_config`
--

DROP TABLE IF EXISTS `me_email_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_email_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '邮箱配置表的id',
  `host` varchar(255) DEFAULT NULL COMMENT '转发服务器域名',
  `port` varchar(255) DEFAULT NULL COMMENT '端口号',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱地址',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `is_active` int(2) DEFAULT '1' COMMENT '是否启用，1：启用，2：不启用',
  `encryption` varchar(255) DEFAULT NULL COMMENT '加密方式',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_email_config`
--

LOCK TABLES `me_email_config` WRITE;
/*!40000 ALTER TABLE `me_email_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_email_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_exrate`
--

DROP TABLE IF EXISTS `me_exrate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_exrate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `currency` varchar(100) NOT NULL COMMENT '货币',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `receipt_rate` float NOT NULL COMMENT '进货率',
  `drawal_rate` float NOT NULL COMMENT '提款率',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_exrate`
--

LOCK TABLES `me_exrate` WRITE;
/*!40000 ALTER TABLE `me_exrate` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_exrate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_faq`
--

DROP TABLE IF EXISTS `me_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `content` longtext NOT NULL COMMENT '内容',
  `title_en` varchar(100) NOT NULL COMMENT '英文标题',
  `content_en` longtext NOT NULL COMMENT '英文内容',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` text COMMENT '摘要',
  `thumb` varchar(100) DEFAULT NULL COMMENT '缩略图',
  `flags` set('a','b','c','h','f','s','p','j') DEFAULT '' COMMENT '自定义属性',
  `author` varchar(30) DEFAULT NULL COMMENT '作者',
  `referer` varchar(50) DEFAULT NULL COMMENT '来源',
  `senddate` int(11) DEFAULT NULL COMMENT '发布日期',
  `audit` tinyint(4) NOT NULL DEFAULT '0' COMMENT '审核',
  `audit_at` int(11) DEFAULT NULL COMMENT '审核时间',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `branch_id` int(11) DEFAULT '0' COMMENT '分公司id',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='常见问题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_faq`
--

LOCK TABLES `me_faq` WRITE;
/*!40000 ALTER TABLE `me_faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_flink`
--

DROP TABLE IF EXISTS `me_flink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_flink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL COMMENT '所属分类',
  `webname` varchar(50) NOT NULL COMMENT '网站名称',
  `url` varchar(50) NOT NULL COMMENT '网站地址',
  `logo` varchar(100) DEFAULT NULL COMMENT '网站LOGO',
  `email` varchar(50) DEFAULT NULL COMMENT '站长Email',
  `introduce` text COMMENT '网站简况',
  `sortid` tinyint(4) DEFAULT NULL COMMENT '排序位置',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='友情链接表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_flink`
--

LOCK TABLES `me_flink` WRITE;
/*!40000 ALTER TABLE `me_flink` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_flink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_grade`
--

DROP TABLE IF EXISTS `me_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(200) DEFAULT NULL COMMENT '等级名称',
  `transaction_sum` decimal(11,4) DEFAULT NULL COMMENT 'C2C累计购买数量',
  `recommend_sum` int(11) DEFAULT NULL COMMENT '推荐正式会员人数',
  `fans_sum` int(11) DEFAULT NULL COMMENT '正式会员团队粉丝',
  `performance_sum` decimal(11,4) DEFAULT NULL COMMENT '业绩（团队总BBA）',
  `frees_sum` decimal(11,4) DEFAULT NULL COMMENT '累计定存自由区数量',
  `promote_sum` decimal(11,4) DEFAULT NULL COMMENT '晋级奖励',
  `static_sum` decimal(11,4) DEFAULT NULL COMMENT '无现代静态收益',
  `dynamic_sum` decimal(11,4) DEFAULT NULL COMMENT '平级动态收益',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='会员等级表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_grade`
--

LOCK TABLES `me_grade` WRITE;
/*!40000 ALTER TABLE `me_grade` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_grade_record`
--

DROP TABLE IF EXISTS `me_grade_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_grade_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userid` int(11) NOT NULL COMMENT '会员id',
  `username` varchar(50) NOT NULL COMMENT '会员账号',
  `old_grade_id` int(11) NOT NULL COMMENT '原等级id',
  `old_grade_name` varchar(50) DEFAULT NULL COMMENT '原等级名称',
  `new_grade_id` int(11) NOT NULL COMMENT '新等级id',
  `new_grade_name` varchar(50) DEFAULT NULL COMMENT '新等级名称',
  `note` text COMMENT '备注',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_grade_record`
--

LOCK TABLES `me_grade_record` WRITE;
/*!40000 ALTER TABLE `me_grade_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_grade_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_guide`
--

DROP TABLE IF EXISTS `me_guide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_guide` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `content` longtext NOT NULL COMMENT '内容',
  `title_en` varchar(100) NOT NULL COMMENT '英文标题',
  `content_en` longtext NOT NULL COMMENT '英文内容',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` text COMMENT '摘要',
  `thumb` varchar(100) DEFAULT NULL COMMENT '缩略图',
  `flags` set('a','b','c','h','f','s','p','j') DEFAULT '' COMMENT '自定义属性',
  `author` varchar(30) DEFAULT NULL COMMENT '作者',
  `referer` varchar(50) DEFAULT NULL COMMENT '来源',
  `senddate` int(11) DEFAULT NULL COMMENT '发布日期',
  `audit` tinyint(4) NOT NULL DEFAULT '0' COMMENT '审核',
  `audit_at` int(11) DEFAULT NULL COMMENT '审核时间',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `branch_id` int(11) DEFAULT '0' COMMENT '分公司id',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='新手指南表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_guide`
--

LOCK TABLES `me_guide` WRITE;
/*!40000 ALTER TABLE `me_guide` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_guide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_hcaredata`
--

DROP TABLE IF EXISTS `me_hcaredata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_hcaredata` (
  `id` int(11) NOT NULL COMMENT '最近12小时价格走势数据ID',
  `hprice` decimal(20,4) DEFAULT NULL COMMENT '每2小时价格',
  `htime` varchar(50) DEFAULT NULL COMMENT '每2小时的具体时间',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_hcaredata`
--

LOCK TABLES `me_hcaredata` WRITE;
/*!40000 ALTER TABLE `me_hcaredata` DISABLE KEYS */;
INSERT INTO `me_hcaredata` VALUES (1,1.1000,'05:00:00',1535965388,1535965388),(2,2.5000,'07:00:00',1535965388,1535965388),(3,3.8000,'09:00:00',1535965388,1535965388),(4,4.9000,'11:00:00',1535965388,1535965388),(5,6.8000,'13:00:00',1535965388,1535965388),(6,7.8000,'15:00:00',1535965388,1535965388);
/*!40000 ALTER TABLE `me_hcaredata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_image`
--

DROP TABLE IF EXISTS `me_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picpath` varchar(200) NOT NULL COMMENT '图片路径',
  `size` varchar(20) NOT NULL COMMENT '图片尺寸',
  `apptype` tinyint(4) NOT NULL COMMENT '应用类型',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='图片资源';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_image`
--

LOCK TABLES `me_image` WRITE;
/*!40000 ALTER TABLE `me_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_level`
--

DROP TABLE IF EXISTS `me_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(200) DEFAULT NULL COMMENT '等级名称',
  `buy_min` decimal(11,4) NOT NULL COMMENT 'C2C累计购买数量（最少）',
  `profit` decimal(11,4) DEFAULT NULL COMMENT '基数',
  `increase` decimal(11,4) DEFAULT NULL COMMENT '增长比例',
  `round` int(11) DEFAULT NULL COMMENT '累计购买轮数',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='定存静态收益级别表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_level`
--

LOCK TABLES `me_level` WRITE;
/*!40000 ALTER TABLE `me_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_lt_award`
--

DROP TABLE IF EXISTS `me_lt_award`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_lt_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `layer_num` int(10) DEFAULT '0' COMMENT '代数',
  `award_per` decimal(10,4) DEFAULT NULL COMMENT '静态收益百分比',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='静态收益表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_lt_award`
--

LOCK TABLES `me_lt_award` WRITE;
/*!40000 ALTER TABLE `me_lt_award` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_lt_award` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_mcaredata`
--

DROP TABLE IF EXISTS `me_mcaredata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_mcaredata` (
  `id` int(11) NOT NULL COMMENT '最近一小时交易数据ID',
  `mprice` decimal(20,4) DEFAULT NULL COMMENT '每10分钟价格',
  `mtime` varchar(50) DEFAULT NULL COMMENT '每10分钟的具体时间',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_mcaredata`
--

LOCK TABLES `me_mcaredata` WRITE;
/*!40000 ALTER TABLE `me_mcaredata` DISABLE KEYS */;
INSERT INTO `me_mcaredata` VALUES (1,1.1000,'16:02:00',1535965336,1535965336),(2,2.5000,'16:12:00',1535965336,1535965336),(3,3.8000,'16:22:00',1535965336,1535965336),(4,4.9000,'16:32:00',1535965336,1535965336),(5,6.8000,'16:42:00',1535965336,1535965336),(6,7.8000,'16:52:00',1535965336,1535965336);
/*!40000 ALTER TABLE `me_mcaredata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_mgmt`
--

DROP TABLE IF EXISTS `me_mgmt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_mgmt` (
  `name` varchar(50) NOT NULL COMMENT '名称',
  `ismenu` tinyint(1) DEFAULT '0' COMMENT '导航菜单',
  `shortcut` tinyint(1) DEFAULT '0' COMMENT '快捷方式',
  `shorttype` tinyint(1) DEFAULT '0' COMMENT '快捷类型',
  `menuname` varchar(20) DEFAULT NULL COMMENT '菜单说明',
  `module` varchar(20) DEFAULT NULL COMMENT '模型名称',
  `description` varchar(100) DEFAULT NULL COMMENT '功能描述',
  `controller` varchar(50) DEFAULT NULL COMMENT '控制器名称',
  `depends` varchar(50) DEFAULT '0' COMMENT '依赖菜单',
  `isallowed` tinyint(1) DEFAULT '0' COMMENT '是否共用',
  `sortid` tinyint(4) DEFAULT NULL COMMENT '排序',
  `breadcrumbs` text COMMENT '操作位置',
  `icon` varchar(100) DEFAULT NULL COMMENT '图标',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='菜单配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_mgmt`
--

LOCK TABLES `me_mgmt` WRITE;
/*!40000 ALTER TABLE `me_mgmt` DISABLE KEYS */;
INSERT INTO `me_mgmt` VALUES ('Admin',1,0,NULL,'管理员设置','','后台管理员功能类别',NULL,'0',0,NULL,NULL,'',NULL,NULL),('Createfile',0,0,NULL,'静态资源访问的控制','','静态资源访问，全部规划到该控制器中执行',NULL,'0',1,NULL,NULL,'',NULL,NULL),('Dict',0,0,NULL,'字典管理','','存储常规应用的级联数据',NULL,'0',1,NULL,NULL,'',NULL,NULL),('File',0,0,NULL,'文件管理','','用于存储常规文件及静态资源文件',NULL,'0',1,NULL,NULL,'',NULL,NULL),('Flink',0,0,NULL,'友情链接','','存储友情链接数据',NULL,'0',1,NULL,NULL,'',NULL,NULL),('Image',0,0,NULL,'图片管理','','管理图片资源文件',NULL,'0',1,NULL,NULL,'',NULL,NULL),('Mgmt',1,0,NULL,'菜单管理','','用于导入控制器及方法，管理控制器、菜单设置。',NULL,'0',1,NULL,NULL,'',NULL,NULL),('Site',0,0,NULL,'应用默认控制器','','应用启动控制器',NULL,'0',1,NULL,NULL,'',NULL,NULL),('Staticfile',0,0,NULL,'静态资源','','将网站中一些常规，不经常变得的数据，提前查询读取到文件中保存。优化网站访问速度',NULL,'0',1,NULL,NULL,'',NULL,NULL),('System',1,0,NULL,'系统设置','','系统设置',NULL,'0',1,NULL,NULL,'',NULL,NULL),('Ajaxlist',0,0,0,'',NULL,'ajax查询管理员信息','Admin','-1',1,NULL,'','',NULL,NULL),('Ajaxperlist',0,0,0,'',NULL,'ajax查询权限记录','Admin','-1',1,NULL,'','',NULL,NULL),('list',1,0,0,'管理员列表',NULL,'后台管理员列表','Admin','-1',0,NULL,'[\r\n{\"label\":\"管理员设置\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('delete',0,0,0,'删除管理员',NULL,'删除管理员','Admin','-1',0,NULL,'','',NULL,NULL),('create',0,0,0,'添加管理员',NULL,'添加管理员','Admin','list--Admin',0,NULL,'[\r\n{\"label\":\"添加管理员\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('update',0,0,0,'编辑管理员',NULL,'编辑管理员','Admin','-1',0,NULL,'[\r\n{\"label\":\"编辑管理员\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('perlist',0,0,0,'权限列表',NULL,'查询权限信息','Admin','-1',0,NULL,'[\r\n{\"label\":\"权限列表\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('createper',0,0,0,'添加权限',NULL,'添加权限','Admin','perlist--Admin',0,NULL,'[\r\n{\"label\":\"添加权限\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('updateper',0,0,0,'编辑权限',NULL,'编辑权限','Admin','perlist--Admin',0,NULL,'[\r\n{\"label\":\"编辑权限\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('deleteper',0,0,0,'删除权限',NULL,'删除权限','Admin','-1',0,NULL,'','',NULL,NULL),('Update',0,0,0,'编辑控制器',NULL,'编辑控制器','Mgmt','-1',1,NULL,'[\r\n{\"label\":\"控制器列表\",\"url\":\"mgmt/list\"},\r\n{\"label\":\"更新控制器\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Updateact',0,0,0,'更新控制器方法',NULL,'更新控制器方法','Mgmt','-1',1,NULL,'[\r\n{\"label\":\"控制器列表\",\"url\":\"mgmt/list\"},\r\n{\"label\":\"方法列表\",\"url\":\"mgmt/alist\",\"params\":\"controller\"},\r\n{\"label\":\"更新方法\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Importcontroller',0,0,0,'导入控制器',NULL,'导入控制器','Mgmt','-1',1,NULL,'','',NULL,NULL),('Importact',0,0,0,'',NULL,'导入控制的相应方法','Mgmt','-1',1,NULL,'','',NULL,NULL),('Ajaxlist',0,0,0,'',NULL,'ajax控制器列表信息','Mgmt','-1',1,NULL,'','',NULL,NULL),('Ajaxalist',0,0,0,'',NULL,'ajax控制器的方法信息','Mgmt','-1',1,NULL,'','',NULL,NULL),('list',1,0,0,'控制器列表',NULL,'查询控制器信息','Mgmt','-1',1,NULL,'[\r\n{\"label\":\"控制器列表\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('alist',0,0,0,'',NULL,'方法列表','Mgmt','-1',1,NULL,'[\r\n{\"label\":\"控制器列表\",\"url\":\"mgmt/list\"},\r\n{\"label\":\"方法列表\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('commonlist',0,0,1,'常用工具',NULL,'常用工具列表','Mgmt','-1',1,NULL,'[\r\n{\"label\":\"常用工具\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('systemlist',0,0,0,'系统设置',NULL,'系统设置列表项','Mgmt','-1',1,NULL,'[\r\n{\"label\":\"系统设置\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('workbench',0,0,0,NULL,NULL,NULL,'Mgmt','0',1,NULL,NULL,NULL,NULL,NULL),('Ajaxlist',0,0,0,'',NULL,'ajax查询字典列表数据','Dict','-1',1,NULL,'','',NULL,NULL),('Sort',0,0,0,'',NULL,'对字典子项进行排序，方便管理。','Dict','-1',1,NULL,'','',NULL,NULL),('create',0,1,1,'添加字典',NULL,'添加字典','Dict','-1',1,NULL,'[\r\n{\"label\":\"添加字典\",\"url\":\"dict/create\"}\r\n]','',NULL,NULL),('update',0,0,1,'更新字典',NULL,'更新字典','Dict','-1',1,NULL,'[\r\n{\"label\":\"更新字典\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('createChild',0,0,1,'添加字段子项',NULL,'添加字段子项','Dict','-1',1,NULL,'[\r\n{\"label\":\"添加字典\",\"url\":\"dict/create\"},\r\n{\"label\":\"添加子项\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('updateChild',0,0,1,'编辑字典子项',NULL,'编辑字典子项','Dict','-1',1,NULL,'[\r\n{\"label\":\"添加字典\",\"url\":\"dict/create\"},\r\n{\"label\":\"编辑子项\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Ajaxdirlist',0,0,0,'',NULL,'ajax查询目录列表数据','File','-1',1,NULL,'','',NULL,NULL),('Ajaxfilelist',0,0,0,'',NULL,'ajax查询目录下的文件列表数据','File','-1',1,NULL,'','',NULL,NULL),('Deletefile',0,0,0,'',NULL,'删除文件','File','-1',1,NULL,'','',NULL,NULL),('Deletedir',0,0,0,'',NULL,'删除目录','File','-1',1,NULL,'','',NULL,NULL),('dirlist',0,1,1,'目录列表',NULL,'查询所有目录信息','File','-1',1,NULL,'[{\r\n\"label\":\"目录列表\",\"url\":\"javascript:;\"\r\n}]','',NULL,NULL),('createdir',0,0,1,'添加目录',NULL,'创建新目录','File','-1',1,NULL,'[\r\n{\"label\":\"添加目录\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('updatedir',0,0,1,'更新目录',NULL,'对需要编辑的目录进行修改','File','-1',1,NULL,'[\r\n{\"label\":\"目录列表\",\"url\":\"file/dirlist\"},\r\n{\"label\":\"更新目录\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('filelist',0,0,1,'文件列表',NULL,'存储相关目录下的静态资源文件','File','-1',1,NULL,'[\r\n{\"label\":\"目录列表\",\"url\":\"file/dirlist\"},\r\n{\"label\":\"文件列表\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('createfile',0,0,1,'添加文件',NULL,'创建相关的资源文件','File','-1',1,NULL,'[\r\n{\"label\":\"目录列表\",\"url\":\"file/dirlist\"},\r\n{\"label\":\"文件列表\",\"url\":\"file/filelist\",\"params\":\"cid\"},\r\n{\"label\":\"添加文件\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('updatefile',0,0,1,'更新文件',NULL,'编辑需要修改的文件','File','-1',1,NULL,'[\r\n{\"label\":\"目录列表\",\"url\":\"file/dirlist\"},\r\n{\"label\":\"文件列表\",\"url\":\"file/filelist\",\"params\":\"cid\"},\r\n{\"label\":\"更新文件\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Ajaxlist',0,0,0,'',NULL,'ajax查询友情链接数据','Flink','-1',1,NULL,'','',NULL,NULL),('list',0,1,1,'友情列表',NULL,'友情链接信息数据','Flink','-1',1,NULL,'[\r\n{\"label\":\"友情列表\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('create',0,0,1,'添加友情链接',NULL,'添加友情链接','Flink','-1',1,NULL,'[\r\n{\"label\":\"添加友情链接\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('update',0,0,1,'',NULL,'编辑友情链接','Flink','-1',1,NULL,'[\r\n{\"label\":\"友情列表\",\"url\":\"flink/list\"},\r\n{\"label\":\"编辑友情链接\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('delete',0,0,0,'',NULL,'删除友情记录','Flink','-1',1,NULL,'','',NULL,NULL),('Ajaxlist',0,0,0,'',NULL,'ajax查询图片资源数据','Image','-1',1,NULL,'','',NULL,NULL),('list',0,1,1,'图片列表',NULL,'查询图片资源信息','Image','-1',1,NULL,'[\r\n{\"label\":\"图片列表\",\"url\":\"image/list\"}\r\n]','',NULL,NULL),('create',0,0,1,'添加图片',NULL,'添加图片资源','Image','-1',1,NULL,'[\r\n{\"label\":\"添加图片\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('delete',0,0,0,'',NULL,'删除图片资源及文件','Image','-1',1,NULL,'','',NULL,NULL),('Index',0,0,0,'应用窗体首页',NULL,'窗体首页显示','Site','-1',1,NULL,'','',NULL,NULL),('Login',0,0,0,'应用登陆窗口',NULL,'应用登陆窗口','Site','-1',1,NULL,'','',NULL,NULL),('Logout',0,0,0,'退出登录',NULL,'退出登录','Site','-1',1,NULL,'','',NULL,NULL),('error',0,0,0,'错误跳转控制器',NULL,'错误跳转控制器','Site','-1',1,NULL,'','',NULL,NULL),('Ajaxlist',0,0,0,'ajax查询数据',NULL,'ajax查询数据','.','-1',1,NULL,'','',NULL,NULL),('Makefile',0,0,0,'生成文件',NULL,'生成文件','Staticfile','-1',1,NULL,'','',NULL,NULL),('list',0,1,1,'静态资源',NULL,'静态资源列表信息','Staticfile','-1',1,NULL,'[\r\n{\"label\":\"静态资源\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('create',0,0,0,'添加资源文件',NULL,'添加资源文件','Staticfile','-1',1,NULL,'[\r\n{\"label\":\"静态资源\",\"url\":\"staticfile/list\"},\r\n{\"label\":\"添加资源文件\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('update',0,0,1,'编辑资源文件',NULL,'编辑资源文件','Staticfile','-1',1,NULL,'[\r\n{\"label\":\"静态资源\",\"url\":\"staticfile/list\"},\r\n{\"label\":\"编辑资源文件\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Sitesetting',0,0,2,'站点设置',NULL,'网站基本信息设置','System','-1',1,NULL,'[\r\n{\"label\":\"站点设置\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Utf8tounicode',0,1,2,'中文转换unicode',NULL,'中文转换unicode','System','-1',1,NULL,'[\r\n{\"label\":\"中文转换unicode\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Stat',1,0,NULL,'',NULL,'',NULL,'0',0,NULL,NULL,NULL,NULL,NULL),('Service',1,0,NULL,'客户服务',NULL,'客户服务',NULL,'0',0,NULL,NULL,NULL,NULL,NULL),('Article',1,0,NULL,'新闻中心',NULL,'新闻发布功能','','0',0,NULL,NULL,NULL,NULL,NULL),('Regist',1,0,NULL,'会员管理','','会员相关信息',NULL,'0',0,NULL,NULL,'',NULL,NULL),('initcreate',1,0,0,'设置初始会员',NULL,'设置初始会员','Regist','-1',0,NULL,'[\r\n{\"label\":\"设置初始会员\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Taskparams',1,0,0,'参数配置',NULL,'参数配置','System','-1',0,NULL,'[\r\n{\"label\":\"参数配置\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Ajaxlist',0,0,0,'ajax获取会员信息列表',NULL,'ajax获取会员信息列表','Regist','-1',1,NULL,'','',NULL,NULL),('list',1,0,0,'会员列表',NULL,'会员信息列表','Regist','-1',0,NULL,'[\r\n{\"label\":\"会员管理\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('update',0,0,0,'编辑会员',NULL,'编辑会员信息','Regist','list--Regist',0,NULL,'[\r\n{\"label\":\"会员列表\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('detail',0,0,0,'查看会员详情',NULL,'查看会员详细信息','Regist','list--Regist',0,NULL,'[\r\n{\"label\":\"查看详情\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Level',1,0,NULL,'交易管理','','交易配置',NULL,'0',0,NULL,NULL,'error',NULL,NULL),('create',0,0,0,'添加级别',NULL,'配置管理--添加级别','Level','list--Level',0,NULL,'[\r\n{\"label\":\"添加级别\",\"url\":\"javascript:;\"}\r\n]',NULL,NULL,NULL),('Hcg',0,0,0,'拨发龙珠',NULL,'拨发龙珠','Regist','-1',0,NULL,NULL,NULL,NULL,NULL),('Ajaxlist',0,0,0,'ajax查询新闻信息',NULL,'ajax查询新闻信息','Article','-1',1,NULL,NULL,NULL,NULL,NULL),('list',1,0,0,'新闻列表',NULL,'新闻信息列表','Article','-1',0,NULL,NULL,NULL,NULL,NULL),('create',0,0,0,'添加新闻',NULL,'添加新闻','Article','-1',0,NULL,'[\r\n{\"label\":\"添加新闻\",\"url\":\"javascript:;\"}\r\n]',NULL,NULL,NULL),('update',0,0,0,'编辑新闻',NULL,'编辑新闻','Article','-1',0,NULL,'[\r\n{\"label\":\"编辑新闻\",\"url\":\"javascript:;\"}\r\n]',NULL,NULL,NULL),('delete',0,0,0,'删除新闻',NULL,'删除新闻','Article','-1',0,NULL,NULL,NULL,NULL,NULL),('Ajaxlist',0,0,0,'ajax查询客户问题记录',NULL,'ajax查询客户问题记录','Service','-1',1,NULL,NULL,NULL,NULL,NULL),('list',1,0,0,'投诉建议记录',NULL,'投诉建议记录','Service','-1',0,NULL,'[\r\n{\"label\":\"投诉建议记录\",\"url\":\"javascript:;\"}\r\n]',NULL,NULL,NULL),('replay',0,0,0,'管理回复',NULL,'管理回复','Service','-1',0,NULL,NULL,NULL,NULL,NULL),('awardrecode',1,0,0,'会员账户记录',NULL,'会员管理--会员账户记录','Regist','-1',0,NULL,'[\r\n{\"label\":\"会员账户记录\",\"url\":\"javascript:;\"}\r\n]',NULL,NULL,NULL),('Ajaxawardrecode',0,0,0,'ajax会员账户记录',NULL,'ajax会员账户记录','Regist','-1',1,NULL,NULL,NULL,NULL,NULL),('Reducehcg',0,0,0,'扣除龙珠',NULL,'扣除龙珠','Regist','-1',0,NULL,NULL,NULL,NULL,NULL),('Ajaxamounttrade',0,0,0,'ajax交易记录',NULL,'ajax交易记录','Regist','-1',1,NULL,NULL,NULL,NULL,NULL),('advertisement',1,0,0,'轮播图发布列表',NULL,'轮播图发布列表','Article','-1',0,NULL,'[\r\n{\"label\":\"轮播图发布列表\",\"url\":\"javascript:;\"}\r\n]',NULL,NULL,NULL),('Ajaxadvertisement',0,0,0,'ajax轮播图列表',NULL,'ajax轮播图列表','Article','-1',1,NULL,NULL,NULL,NULL,NULL),('addadvertisement',0,0,0,'添加轮播图',NULL,'添加轮播图','Article','-1',0,NULL,'[\r\n{\"label\":\"添加轮播图\",\"url\":\"javascript:;\"}\r\n]',NULL,NULL,NULL),('deleteadv',0,0,0,'删除轮播图',NULL,'删除轮播图','Article','-1',0,NULL,NULL,NULL,NULL,NULL),('usercar',1,0,0,'会员加速器明细',NULL,'会员加速器明细','Regist','-1',0,NULL,NULL,NULL,NULL,NULL),('Ajaxusercar',0,0,0,'ajax会员加速器明细',NULL,'ajax会员加速器明细','Regist','-1',1,NULL,NULL,NULL,NULL,NULL),('car',1,0,0,'加速器配置',NULL,'配置管理--加速器配置','Level','-1',0,NULL,NULL,NULL,NULL,NULL),('Ajaxcar',0,0,0,'ajax查加速器列表',NULL,'ajax查询加速器列表','Level','-1',1,NULL,NULL,NULL,NULL,NULL),('updatecar',0,0,0,'编辑加速器',NULL,'编辑加速器','Level','car--Level',0,NULL,NULL,NULL,NULL,NULL),('careprice',1,0,0,'数字资产价格配置列表',NULL,'数字资产价格配置列表','Level','-1',0,NULL,NULL,NULL,NULL,NULL),('Ajaxcareprice',0,0,0,'ajax数字资产价格配置列表',NULL,'ajax数字资产价格配置列表','Level','-1',1,NULL,NULL,NULL,NULL,NULL),('createcareprice',0,0,0,'修改数字资产价格',NULL,'修改数字资产价格','Level','-1',0,NULL,NULL,NULL,NULL,NULL),('updataadminpwd',1,0,0,'修改管理员密码',NULL,'修改管理员密码','Admin','-1',0,NULL,NULL,NULL,NULL,NULL),('addeuarticle',0,0,0,'添加新闻英语信息',NULL,'添加新闻英语信息','Article','list--Article',0,NULL,NULL,NULL,NULL,NULL),('actionlog',1,0,0,'管理员日志',NULL,'管理员日志','Admin','-1',0,NULL,NULL,NULL,NULL,NULL),('Ajaxactionlog',0,0,0,'Ajax管理员日志',NULL,'Ajax管理员日志','Admin','-1',1,NULL,NULL,NULL,NULL,NULL),('overtimeop',0,0,0,'超时订单处理',NULL,'超时订单处理','Regist','overtimeop--Regist',0,NULL,NULL,NULL,NULL,NULL),('ltaward',1,0,0,'直推静态收益',NULL,'直推静态收益','Level','-1',0,NULL,NULL,NULL,NULL,NULL),('Ajaxltaward',0,0,0,'ajax流通奖励配置',NULL,'ajax流通奖励配置','Level','-1',1,NULL,NULL,NULL,NULL,NULL),('updateltaward',0,0,0,'编辑流通奖',NULL,'编辑流通奖','Level','ltaward--Level',0,NULL,NULL,NULL,NULL,NULL),('spreadlist',1,0,0,'推广赠送积分配置','','配置管理--积分赠送列表','Level','-1',0,NULL,'[\r\n{\"label\":\"级别配置\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Ajaxspreadlist',0,0,0,'ajax查询推广赠送积分数据','','ajax查询推广赠送积分数据','Level','-1',1,NULL,'','',NULL,NULL),('spreadupdate',0,0,0,'编辑赠送积分数量','','配置管理--编辑赠送积分数量','Level','spreadlist--Level',0,NULL,'[\r\n{\"label\":\"编辑级别\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Currency',1,0,NULL,'LKC管理','','LKC配置','','0',0,NULL,'','',NULL,NULL),('Ajaxlist',0,0,0,'ajax查询数字资产数据','','ajax查询数字资产级别数据','Currency','-1',1,NULL,'','',NULL,NULL),('update',0,0,0,'编辑数字资产级别','','编辑数字资产级别','Currency','list--Currency',0,NULL,'[\r\n{\"label\":\"编辑级别\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('sellcare',1,0,0,'出售LKC列表','','出售LKC列表','Currency','-1',0,NULL,'[\r\n{\"label\":\"LKC价格配置\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Ajaxsellcare',0,0,0,'ajax出售数字资产列表','','ajax出售数字资产列表','Currency','-1',1,NULL,'','',NULL,NULL),('createsellcare',0,0,0,'出售LKC','','出售LKC','Currency','-1',0,NULL,'','',NULL,NULL),('careprice',1,0,0,'LKC价格配置列表','','LKC价格配置列表','Currency','-1',0,NULL,'','',NULL,NULL),('Ajaxcareprice',0,0,0,'ajax数字资产价格配置列表','','ajax数字资产价格配置列表','Currency','-1',1,NULL,'','',NULL,NULL),('createcareprice',0,0,0,'修改LKC价格','','修改LKC价格','Currency','-1',0,NULL,'','',NULL,NULL),('list',1,0,0,'LKC级别配置','','LKC级别配置列表','Currency','-1',0,NULL,'[\r\n{\"label\":\"LKC配置\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('grade',0,0,0,'会员等级配置','','会员等级配置','Regist','-1',0,NULL,'','error',NULL,NULL),('Ajaxgrade',0,0,0,'Ajax会员等级配置','','Ajax会员等级配置','Regist','-1',1,NULL,'','',NULL,NULL),('updategrade',0,0,0,'编辑会员等级','','编辑会员等级','Regist','grade--Other',0,NULL,'','',NULL,NULL),('Taskparams',1,0,0,'LKC参数配置','','LKC参数配置','Currency','-1',0,NULL,'[\r\n{\"label\":\"LKC参数配置\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('Applypurchase',1,0,NULL,'申购管理',NULL,'申购管理',NULL,'0',0,NULL,NULL,NULL,NULL,NULL),('applypurchaselist',1,0,0,'申购列表',NULL,'申购管理--申购列表','Applypurchase','-1',0,NULL,NULL,NULL,NULL,NULL),('Ajaxapplypurchase',0,0,0,'ajax申购列表',NULL,'ajax申购列表','Applypurchase','-1',1,NULL,NULL,NULL,NULL,NULL),('Taskparams',1,0,0,'交易参数配置','','交易参数配置','Level','-1',0,NULL,'[\r\n{\"label\":\"交易参数配置\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('Taskparams',1,0,0,'申购参数配置','','申购参数配置','Applypurchase','-1',0,NULL,'[\r\n{\"label\":\"申购参数配置\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('amounttrade',1,0,0,'交易记录',NULL,'会员管理--交易记录','Regist','-1',0,NULL,'[\r\n{\"label\":\"会员管理\",\"url\":\"javascript:;\"}\r\n]','',NULL,NULL),('finishorder',0,0,0,'申购完成',NULL,'申购完成','Applypurchase','-1',0,NULL,NULL,NULL,NULL,NULL),('dealfail',0,0,0,'申购未成功',NULL,'申购未成功','Applypurchase','-1',0,NULL,NULL,NULL,NULL,NULL),('batchop',1,0,0,'批量查询封号',NULL,'会员管理--批量查询封号','Regist','-1',0,NULL,'[\r\n{\"label\":\"会员管理\",\"url\":\"javascript:;\"}\r\n]',NULL,NULL,NULL),('Ajaxbatchoplist',0,0,0,'ajax清理无用账户',NULL,'ajax清理无用账户','Regist','-1',1,NULL,NULL,NULL,NULL,NULL),('batchsuspend',0,0,0,'批量封号',NULL,'批量封号','Regist','batchsuspend--Regist',0,NULL,NULL,NULL,NULL,NULL),('batchrelease',0,0,0,'批量解封',NULL,'批量解封','Regist','batchrelease--Regist',0,NULL,NULL,NULL,NULL,NULL),('getunlogin',1,0,0,'清理无用账户',NULL,'会员管理--清理无用账户','Regist','-1',0,NULL,'[\r\n{\"label\":\"会员管理\",\"url\":\"javascript:;\"}\r\n]',NULL,NULL,NULL),('Ajaxbatchoplist',0,0,0,'ajax批量查询封号',NULL,'ajax批量查询封号','Regist','-1',1,NULL,NULL,NULL,NULL,NULL),('batchunloginsuspend',0,0,0,'批量封无用账号',NULL,'批量封无用账号','Regist','batchunloginsuspend--Regist',0,NULL,NULL,NULL,NULL,NULL),('batchunloginrelease',0,0,0,'批量解封无用账号',NULL,'批量解封无用账号','Regist','batchrelease--Regist',0,NULL,NULL,NULL,NULL,NULL),('contactlist',0,0,0,'联系会员',NULL,'联系会员','Service','-1',0,NULL,'','error',NULL,NULL),('createcontanct',0,0,0,'创建联系会员',NULL,'创建联系会员','Service','contactlist-Service',0,NULL,NULL,NULL,NULL,NULL),('Getmenus',0,0,0,NULL,NULL,NULL,'Createfile','0',0,NULL,NULL,NULL,NULL,NULL),('Getdicts',0,0,0,NULL,NULL,NULL,'Createfile','0',0,NULL,NULL,NULL,NULL,NULL),('GetPublicAuth',0,0,0,NULL,NULL,NULL,'Createfile','0',0,NULL,NULL,NULL,NULL,NULL),('Faq',1,0,NULL,'常见问题管理','','常见问题相关',NULL,'0',0,NULL,NULL,'error',NULL,NULL),('Ajaxlist',0,0,0,'ajax获取常见问题列表',NULL,'ajax获取常见问题列表','Faq','-1',1,NULL,'','error',NULL,NULL),('Delete',0,0,0,'删除常见问题',NULL,'删除常见问题','Faq','-1',0,NULL,'','error',NULL,NULL),('list',0,0,0,'常见问题列表',NULL,'常见问题列表','Faq','-1',0,NULL,'[\r\n{\"label\":\"常见问题管理\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('update',0,0,0,'编辑常见问题',NULL,'编辑常见问题','Faq','-1',0,NULL,'[\r\n{\"label\":\"编辑常见问题\",\"url\":\"faq/update\"}\r\n]','error',NULL,NULL),('create',0,0,0,'添加常见问题',NULL,'添加常见问题','Faq','-1',0,NULL,'[\r\n{\"label\":\"添加常见问题\",\"url\":\"faq/create\"}\r\n]','error',NULL,NULL),('Guide',1,0,NULL,'新手指南','','新手指南相关',NULL,'0',0,NULL,NULL,'error',NULL,NULL),('Ajaxlist',0,0,0,'ajax获取新手指南列表',NULL,'ajax获取新手指南列表','Guide','-1',1,NULL,'','error',NULL,NULL),('Delete',0,0,0,'删除新手指南',NULL,'删除新手指南','Guide','-1',0,NULL,'','error',NULL,NULL),('list',0,0,0,'新手指南列表',NULL,'新手指南列表','Guide','-1',0,NULL,'[\r\n{\"label\":\"新手指南管理\",\"url\":\"javascript;\"}\r\n]','error',NULL,NULL),('update',0,0,0,'编辑新手指南',NULL,'编辑新手指南','Guide','-1',0,NULL,'[\r\n{\"label\":\"编辑新手指南\",\"url\":\"guide/update\"}\r\n]','error',NULL,NULL),('create',0,0,0,'添加新手指南',NULL,'添加新手指南','Guide','-1',0,NULL,'[\r\n{\"label\":\"添加新手指南\",\"url\":\"guide/create\"}\r\n]','error',NULL,NULL),('semiautomatch',0,0,0,'手动撮合',NULL,'手动撮合','Regist','-1',0,NULL,NULL,NULL,NULL,NULL),('Zodiac',1,0,NULL,'宠物管理','宠物管理','宠物相关设置',NULL,'0',0,NULL,NULL,'error',NULL,NULL),('Ajaxlist',0,0,0,'神龙列表数据',NULL,'神龙列表数据','Zodiac','-1',0,NULL,'','error',NULL,NULL),('list',1,0,0,'宠物列表',NULL,'宠物列表','Zodiac','-1',0,NULL,'[\r\n{\"label\":\"神龙管理\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('update',0,0,0,'编辑神龙',NULL,'编辑神龙','Zodiac','list--Zodiac',0,NULL,'[\r\n{\"label\":\"编辑飞龙\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('create',0,0,0,'添加神龙',NULL,'添加神龙','Zodiac','list--Zodiac',0,NULL,'[\r\n{\"label\":\"添加飞龙\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('Ajaxgradelist',0,0,0,'神龙等级列表数据',NULL,'神龙等级列表数据','Zodiac','-1',0,NULL,'','error',NULL,NULL),('grade_list',0,0,0,'神龙等级管理',NULL,'神龙等级管理','Zodiac','-1',0,NULL,'[\r\n{\"label\":\"神龙等级管理\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('updategrade',0,0,0,'编辑神龙等级',NULL,'编辑神龙等级','Zodiac','grade_list--Zodiac',0,NULL,'[\r\n{\"label\":\"编辑飞龙等级\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('release_zodiac',1,0,0,'发行宠物',NULL,'发行神龙','Zodiac','-1',0,NULL,'[\r\n{\"label\":\"发行神龙\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('Ajaxreleaselist',0,0,0,'发行神龙数据',NULL,'发行神龙数据','Zodiac','-1',0,NULL,'','error',NULL,NULL),('release_list',1,0,0,'发行宠物列表',NULL,'发行宠物列表','Zodiac','-1',0,NULL,'[\r\n{\"label\":\"发行神龙列表\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('createaward',0,0,0,'新增推荐收益',NULL,'新增推荐收益','Level','-1',0,NULL,NULL,NULL,NULL,NULL),('deleteaward',0,0,0,'删除推荐收益',NULL,'删除推荐收益','Level','-1',0,NULL,NULL,NULL,NULL,NULL),('Releasezodiac',0,0,0,'拆分产品',NULL,'拆分产品','Zodiac','release_list--Zodiac',0,NULL,'[\r\n{\"label\":\"拆分产品\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('Uploginpass',0,0,0,NULL,NULL,NULL,'System','0',0,NULL,NULL,NULL,NULL,NULL),('Ajaxchecksign',0,0,0,NULL,NULL,NULL,'Regist','0',0,NULL,NULL,NULL,NULL,NULL),('Ajaxlist',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('Ajaxgrade',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('Ajaxsellcare',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('Ajaxtradenum',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('sellcare',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('createsellcare',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('tradenum',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('updatetradenum',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('grade',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('updategrade',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('Ajaxrechargelist',0,0,0,'积分充值记录ajax',NULL,'积分充值记录ajax','Regist','-1',0,NULL,'','error',NULL,NULL),('Ajaxunloginlist',0,0,0,NULL,NULL,NULL,'Regist','0',0,NULL,NULL,NULL,NULL,NULL),('recharge_record',1,0,0,'龙珠充值记录',NULL,'龙珠充值记录','Regist','-1',0,NULL,'[\r\n{\"label\":\"积分充值记录\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('apply_list',1,0,0,'宠物预约列表',NULL,'宠物预约列表','Zodiac','-1',0,NULL,'[{\"label\":\"神龙预约列表\",\"url\":\"javascript:;\"}]','error',NULL,NULL),('lock_get',0,0,0,'限制抢购',NULL,'限制抢购','Zodiac','apply_list--Zodiac',0,NULL,NULL,NULL,NULL,NULL),('unlock_get',0,0,0,'解除限制抢购',NULL,'解除限制抢购','Zodiac','apply_list--Zodiac',0,NULL,NULL,NULL,NULL,NULL),('Ajaxcertificationlist',0,0,0,'批量实名认证列表',NULL,'批量实名认证列表','Regist','certification--Regist',0,NULL,'[\r\n{\"label\":\"批量实名认证列表\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('agreed',0,0,0,'审核通过',NULL,'审核通过','Regist','certification--Regist',0,NULL,'[\r\n{\"label\":\"管理员设置\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('certification',1,0,0,'批量实名认证',NULL,'批量实名认证','Regist','-1',0,NULL,'[\r\n{\"label\":\"批量实名认证\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('delete',0,0,0,'删除神龙',NULL,'删除神龙','Zodiac','list--Zodiac',0,NULL,NULL,NULL,NULL,NULL),('disagree',0,0,0,'审核驳回',NULL,'审核驳回','Regist','certification--Regist',0,NULL,NULL,NULL,NULL,NULL),('Ajaxuserzodiac',0,0,0,NULL,NULL,NULL,'Zodiac','0',0,NULL,NULL,NULL,NULL,NULL),('Ajaxapplylist',0,0,0,NULL,NULL,NULL,'Zodiac','0',0,NULL,NULL,NULL,NULL,NULL),('Deleteuserzodiac',0,0,0,'删除用户神龙',NULL,'删除用户神龙','Zodiac','user_zodiac--Zodiac',0,NULL,'[\r\n{\"label\":\"删除用户神龙\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('Endeleteuserzodiac',0,0,0,'还原用户神龙',NULL,'还原用户神龙','Zodiac','user_zodiac--Zodiac',0,NULL,'[\r\n{\"label\":\"还原用户神龙\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('user_zodiac',1,0,0,'用户宠物列表',NULL,'用户宠物列表','Zodiac','-1',0,NULL,'[\r\n{\"label\":\"用户神龙列表\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('Care',0,0,0,'拨发推广收益',NULL,'拨发推广收益','Regist','-1',0,NULL,NULL,NULL,NULL,NULL),('Reducecare',0,0,0,'扣除推广收益',NULL,'扣除推广收益','Regist','-1',0,NULL,NULL,NULL,NULL,NULL),('Ajaxnotification',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('Ajaxsmscode',0,0,0,NULL,NULL,NULL,'Level','0',0,NULL,NULL,NULL,NULL,NULL),('notification',1,0,0,'交易消息列表',NULL,'交易消息列表','Level','-1',0,NULL,'[\r\n{\"label\":\"交易消息列表\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('smscode',1,0,0,'验证码短信列表',NULL,'验证码短信列表','Level','-1',0,NULL,'[\r\n{\"label\":\"验证码短信列表\",\"url\":\"javascript:;\"}\r\n]','error',NULL,NULL),('restepay',0,0,0,'重置收款方式',NULL,'重置收款方式','Regist','-1',0,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `me_mgmt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_notification`
--

DROP TABLE IF EXISTS `me_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '消息推送表ID',
  `order_id` int(11) DEFAULT NULL COMMENT '订单ID',
  `out_userid` int(11) DEFAULT NULL COMMENT '卖家ID',
  `out_username` varchar(50) DEFAULT NULL COMMENT '卖出会员账号',
  `in_userid` int(11) DEFAULT NULL COMMENT '买家ID',
  `in_username` varchar(50) DEFAULT NULL COMMENT '买入会员账号',
  `msg_type` int(2) DEFAULT NULL COMMENT '消息类型, 1: 确认付款，2：确认收款',
  `isread` int(2) DEFAULT NULL COMMENT '消息状态, 1: 未读, 2: 已读',
  `status` int(2) DEFAULT NULL COMMENT '状态 0、订单已挂出；1、买家已下单；2、买家已付款；3、订单已成交；4、订单已取消；5、付款已超时；6、收款已超时；7、卖家已下单; 8、卖家申诉中; 9、卖家申诉成功; 10、付款超时，订单取消;',
  `type` int(2) DEFAULT NULL COMMENT '交易类型  1、买入；2、卖出；',
  `method` int(2) DEFAULT NULL COMMENT '交易方式, 1: 现金交易, 2: 余额交易',
  `order_type` int(2) DEFAULT NULL COMMENT '订单类型, 1: 余额订单; 2:LKC订单',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间(已读时间)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='交易消息记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_notification`
--

LOCK TABLES `me_notification` WRITE;
/*!40000 ALTER TABLE `me_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_permission`
--

DROP TABLE IF EXISTS `me_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '权限名称',
  `authitems` text NOT NULL COMMENT '包含方法',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='权限配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_permission`
--

LOCK TABLES `me_permission` WRITE;
/*!40000 ALTER TABLE `me_permission` DISABLE KEYS */;
INSERT INTO `me_permission` VALUES (1,'添加、编辑管理员','admin-list,admin-create,admin-update',1478703394,1478703394),(2,'删除管理员','admin-delete',1478703418,1478703418),(3,'添加、编辑权限','admin-perlist,admin-createper,admin-updateper',1478703436,1478703436),(4,'删除权限','admin-deleteper',1478703511,1478703511),(17,'新闻中心','article-list,article-create,article-update',1480771573,1480771944),(18,'删除新闻','article-delete',1480771955,1480771955),(20,'会员管理','regist-list,regist-update,regist-detail',1522802732,1522803504),(31,'留言记录','service-list',1524552082,1524552082),(32,'管理回复','service-replay',1524552092,1524552092),(47,'会员管理--交易记录','regist-amounttrade',1524813274,1524813274),(59,'轮播图发布列表','article-advertisement,article-addadvertisement',1526299876,1526299876),(60,'添加轮播图','article-addadvertisement',1526299900,1526299900),(61,'删除轮播图','article-deleteadv',1526300881,1526300881),(81,'修改管理员密码','admin-updataadminpwd',1527730935,1527730935),(82,'添加新闻英语信息','article-addeuarticle',1528341226,1528341226),(83,'参数配置','system-taskparams',1528371852,1528371852),(86,'管理员日志','admin-actionlog',1528790967,1528790967),(88,'会员管理--会员账户记录','regist-awardrecode',1528795513,1528795513),(89,'超时订单处理','regist-overtimeop',1530498403,1530498403),(92,'编辑流通奖','level-updateltaward',1531463334,1531463334),(121,'余额参数配置','level-taskparams',1535963111,1535963111),(129,'设置初始会员','regist-initcreate',1535968729,1535968729),(138,'全局参数配置','level-taskparams',1536890376,1536890376),(142,'会员管理--批量查询封号','regist-batchop',1538997584,1538997584),(143,'批量封号','regist-batchsuspend',1538997599,1538997599),(144,'批量解封','regist-batchrelease',1538997611,1538997611),(145,'会员管理--清理无用账户','regist-getunlogin',1539347840,1539347840),(146,'批量封无用账号','regist-batchunloginsuspend',1539347850,1539347850),(147,'批量解封无用账号','regist-batchunloginrelease',1539347860,1539347860),(148,'联系会员','service-contactlist',1542019142,1542019142),(149,'创建联系会员','service-createcontanct',1542019152,1542019152),(152,'直推静态收益','level-ltaward',1554195712,1554195712),(154,'常见问题管理','faq-delete,faq-list,faq-update,faq-create',1554262561,1554262561),(155,'新手指南管理','guide-delete,guide-list,guide-update,guide-create',1554274216,1554274216),(158,'会员等级配置','regist-grade',1555405249,1555405249),(160,'编辑会员等级','regist-updategrade',1555405467,1555405467),(164,'手动撮合','regist-semiautomatch',1556001202,1556001202),(188,'新增推荐收益','level-createaward',1562655003,1562655003),(189,'删除推荐收益','level-deleteaward',1562655232,1562655232),(191,'拆分产品','zodiac-releasezodiac',1562816615,1562816615),(193,'拨发龙珠','regist-hcg',1564040350,1564040350),(194,'扣除龙珠','regist-reducehcg',1564040369,1564040369),(195,'神龙预约列表','zodiac-apply_list',1564040829,1564040829),(196,'限制抢购','zodiac-lock_get',1564040840,1564040840),(197,'解除限制抢购','zodiac-unlock_get',1564040852,1564040852),(198,'神龙列表数据','zodiac-ajaxlist',1564049131,1564049131),(199,'神龙九子列表','zodiac-list',1564049145,1564049145),(200,'编辑神龙','zodiac-update',1564049158,1564049158),(201,'添加神龙','zodiac-create',1564049171,1564049171),(202,'神龙等级列表数据','zodiac-ajaxgradelist',1564049217,1564049217),(204,'发行神龙','zodiac-release_zodiac',1564049246,1564049246),(205,'发行神龙数据','zodiac-ajaxreleaselist',1564049259,1564049259),(206,'发行神龙列表','zodiac-release_list',1564049274,1564049274),(208,'批量实名认证','regist-certification',1564111540,1564111540),(210,'审核通过','regist-agreed',1564377047,1564377047),(211,'审核驳回','regist-disagree',1564377058,1564377058),(212,'用户神龙列表','zodiac-user_zodiac',1564454785,1564454785),(213,'删除用户神龙','zodiac-deleteuserzodiac',1564454797,1564454797),(214,'还原用户神龙','zodiac-endeleteuserzodiac',1564454808,1564454808),(215,'拨发推广收益','regist-care',1564582644,1564582644),(216,'扣除推广收益','regist-reducecare',1564582659,1564582659),(217,'交易消息列表','level-notification',1564652261,1564652261),(218,'验证码短信列表','level-smscode',1564652272,1564652272),(219,'重置收款方式','regist-restepay',1564656627,1564656627);
/*!40000 ALTER TABLE `me_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_recharge`
--

DROP TABLE IF EXISTS `me_recharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_recharge` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `userid` int(10) DEFAULT NULL COMMENT '用户id',
  `username` int(10) DEFAULT NULL COMMENT '用户账号(手机号)',
  `hcg` decimal(10,2) DEFAULT '0.00' COMMENT '充值积分',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '充值面额',
  `scale` decimal(10,2) DEFAULT '0.00' COMMENT '充值比例',
  `created_at` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='在线充值表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_recharge`
--

LOCK TABLES `me_recharge` WRITE;
/*!40000 ALTER TABLE `me_recharge` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_recharge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_register_award`
--

DROP TABLE IF EXISTS `me_register_award`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_register_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `number` int(11) DEFAULT '0' COMMENT '推荐人数',
  `present_integral` decimal(11,2) DEFAULT NULL COMMENT '赠送积分',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_register_award`
--

LOCK TABLES `me_register_award` WRITE;
/*!40000 ALTER TABLE `me_register_award` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_register_award` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_sell_care`
--

DROP TABLE IF EXISTS `me_sell_care`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_sell_care` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sell_num` decimal(11,2) DEFAULT '0.00' COMMENT '总出售数量',
  `remain_num` decimal(11,0) DEFAULT '0' COMMENT '剩余数量',
  `img` varchar(250) DEFAULT NULL COMMENT '图片',
  `admin_id` int(11) NOT NULL COMMENT '管理员id',
  `admin_name` varchar(50) DEFAULT NULL COMMENT '管理员账号',
  `note` text COMMENT '备注',
  `ip` varchar(100) DEFAULT NULL COMMENT 'IP',
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '状态（1：预热中，2：进行中，3：已结束）',
  `sell_time` int(11) NOT NULL COMMENT '出售时间',
  `lv_limit` decimal(11,4) DEFAULT '0.0000' COMMENT '免费会员购买额度',
  `lv0_limit` decimal(11,4) DEFAULT '0.0000' COMMENT 'lv0会员购买额度',
  `lv1_limit` decimal(11,4) DEFAULT '0.0000' COMMENT 'lv1会员购买额度',
  `lv2_limit` decimal(11,4) DEFAULT '0.0000' COMMENT 'lv2会员购买额度',
  `lv3_limit` decimal(11,4) DEFAULT '0.0000' COMMENT 'lv3会员购买额度',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `created_at` int(11) DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) DEFAULT '0' COMMENT '更新时间',
  `branch_id` int(11) DEFAULT NULL COMMENT '分公司id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_sell_care`
--

LOCK TABLES `me_sell_care` WRITE;
/*!40000 ALTER TABLE `me_sell_care` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_sell_care` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_send_currency`
--

DROP TABLE IF EXISTS `me_send_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_send_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `in_userid` int(11) NOT NULL COMMENT '转入会员ID',
  `in_username` varchar(50) DEFAULT NULL COMMENT '转入会员账号',
  `out_userid` int(11) NOT NULL COMMENT '转出会员ID',
  `out_username` varchar(50) DEFAULT NULL COMMENT '转出会员账号',
  `amount` decimal(20,4) NOT NULL DEFAULT '0.0000' COMMENT '转出LKC数量',
  `service_charge` decimal(20,4) DEFAULT '0.0000' COMMENT '手续费',
  `actual_amount` decimal(20,4) DEFAULT '0.0000' COMMENT '实际转出数量',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `branch_id` int(4) DEFAULT NULL COMMENT '分公司id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_send_currency`
--

LOCK TABLES `me_send_currency` WRITE;
/*!40000 ALTER TABLE `me_send_currency` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_send_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_share_rewards`
--

DROP TABLE IF EXISTS `me_share_rewards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_share_rewards` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `amount` int(11) DEFAULT NULL COMMENT '分享人数',
  `algebra` int(11) DEFAULT NULL COMMENT '奖励伞下代数',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_share_rewards`
--

LOCK TABLES `me_share_rewards` WRITE;
/*!40000 ALTER TABLE `me_share_rewards` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_share_rewards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_sms_code`
--

DROP TABLE IF EXISTS `me_sms_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_sms_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL COMMENT '手机号码',
  `code` varchar(10) NOT NULL COMMENT '验证码',
  `create_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `ip` varchar(100) DEFAULT NULL COMMENT 'IP地址',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='手机验证码表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_sms_code`
--

LOCK TABLES `me_sms_code` WRITE;
/*!40000 ALTER TABLE `me_sms_code` DISABLE KEYS */;
INSERT INTO `me_sms_code` VALUES (1,'13798531344','632143',1583160442,'27.27.218.169'),(2,'13267891774','220780',1583165888,'112.96.197.80'),(3,'17512801585','914862',1583197453,'112.96.69.100'),(4,'15697598521','738490',1583197897,'112.96.139.42'),(5,'15697598521','549988',1583198412,'112.96.139.42'),(6,'15697598521','896853',1583198570,'112.96.139.42'),(7,'16620994189','388394',1583198684,'112.96.139.42');
/*!40000 ALTER TABLE `me_sms_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_snap_judgment`
--

DROP TABLE IF EXISTS `me_snap_judgment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_snap_judgment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zodiacid` int(11) NOT NULL COMMENT '神龙id',
  `status` int(10) DEFAULT NULL COMMENT '状态（0：未抢购；1：抢购成功； 2：抢购失败）',
  `issue_id` varchar(30) DEFAULT NULL COMMENT '发行表id',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `created_at` int(11) NOT NULL COMMENT '抢购时间',
  `updated_at` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `issue_id` (`issue_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='抢购记录判断表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_snap_judgment`
--

LOCK TABLES `me_snap_judgment` WRITE;
/*!40000 ALTER TABLE `me_snap_judgment` DISABLE KEYS */;
INSERT INTO `me_snap_judgment` VALUES (1,1,2,'58_1583201055',58,1583201055,1583201055),(2,1,1,'40_1583202029',40,1583201516,1583201516),(3,1,2,'106_1583201628',106,1583201628,1583201628),(4,4,1,'40_1583238006',40,1583237810,1583237810);
/*!40000 ALTER TABLE `me_snap_judgment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_static_file`
--

DROP TABLE IF EXISTS `me_static_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_static_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `http` int(11) NOT NULL COMMENT '访问地址',
  `action` varchar(255) NOT NULL COMMENT '访问方法',
  `params` text COMMENT '参数',
  `dir` int(11) NOT NULL COMMENT '存储目录',
  `filename` varchar(50) NOT NULL COMMENT '文件名称',
  `filetype` int(11) NOT NULL COMMENT '文件类型',
  `frequency` int(11) NOT NULL DEFAULT '0' COMMENT '执行频率',
  `description` varchar(255) DEFAULT NULL COMMENT '文件描述',
  `flag` tinyint(1) DEFAULT '0' COMMENT '文件是否存在',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `unqiue` (`filename`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='常规文件存储表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_static_file`
--

LOCK TABLES `me_static_file` WRITE;
/*!40000 ALTER TABLE `me_static_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_static_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_stock_price_record`
--

DROP TABLE IF EXISTS `me_stock_price_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_stock_price_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `price` decimal(20,4) NOT NULL DEFAULT '1.0000' COMMENT 'BBA价格',
  `total` decimal(20,4) DEFAULT '0.0000' COMMENT '当前总交易额',
  `times` int(11) DEFAULT '0' COMMENT '上涨次数',
  `adminid` int(11) DEFAULT NULL COMMENT '管理员ID',
  `adminname` varchar(100) DEFAULT NULL COMMENT '管理员账号',
  `note` varchar(255) DEFAULT NULL COMMENT '说明',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `created_at` int(11) DEFAULT NULL COMMENT '修改时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统时价表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_stock_price_record`
--

LOCK TABLES `me_stock_price_record` WRITE;
/*!40000 ALTER TABLE `me_stock_price_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_stock_price_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_trade_num`
--

DROP TABLE IF EXISTS `me_trade_num`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_trade_num` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `areaid` int(2) DEFAULT NULL COMMENT '挂买/挂卖数量区间 id, 1: B1区，2: B2区, 3: B3区',
  `areaname` varchar(5) DEFAULT NULL COMMENT '区间名称',
  `min` decimal(20,0) DEFAULT '0' COMMENT '此区间最低数量',
  `max` decimal(20,0) DEFAULT '0' COMMENT '此区间最高数量',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='买卖区间表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_trade_num`
--

LOCK TABLES `me_trade_num` WRITE;
/*!40000 ALTER TABLE `me_trade_num` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_trade_num` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user`
--

DROP TABLE IF EXISTS `me_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `level_id` int(11) DEFAULT '0' COMMENT '用户静态收益级别ID',
  `grade_id` int(2) DEFAULT '1' COMMENT '等级id',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '最后登陆IP',
  `status` int(2) NOT NULL DEFAULT '10',
  `isactivate` int(11) DEFAULT '0' COMMENT '会员是否实名认证（0：否，1：是）',
  `issend` int(11) DEFAULT '0' COMMENT '解封次数',
  `issell` int(11) DEFAULT '0' COMMENT '是否禁止交易，0：否，1：是',
  `isout` int(11) DEFAULT '0' COMMENT '是否出局 0：否 1：是',
  `iseal` int(11) DEFAULT '0' COMMENT '是否被封, 0 : 正常, 1: 被封',
  `last_login_at` int(11) DEFAULT NULL COMMENT '最后登陆时间',
  `invite_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邀请码',
  `mycode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '自身邀请码',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `out_limit` decimal(20,4) DEFAULT '0.0000' COMMENT '母币转出额度',
  `start` int(2) DEFAULT '5' COMMENT '信用星级',
  `is_turn_reg` int(2) DEFAULT '0' COMMENT '母币是否能够转出',
  `app_token` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'app交互验证',
  `share_qrcode` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '分享二维码地址',
  `sendin_qrcode` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '转入二维码路径',
  `register_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '注册时的IP',
  `overtime_num` int(2) DEFAULT '0' COMMENT '交易超时次数，达到3次，直接禁止交易，默认为0',
  `except_num` int(2) DEFAULT '0' COMMENT '交易被申诉异常次数，达到3次，直接禁止交易，默认为0',
  `branch_id` int(11) DEFAULT '0' COMMENT '分区ID',
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '国籍',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user`
--

LOCK TABLES `me_user` WRITE;
/*!40000 ALTER TABLE `me_user` DISABLE KEYS */;
INSERT INTO `me_user` VALUES (1,'soya12333',0,1,'ravOcxVAL8YX8P4FxsR8W9ukliMltisL','$2y$13$yfXLZ5cFni7soo1tdj1Xz.qosXI2ts3UopKsvjBszuJw26n64e10e','$2y$13$sC.VZjPdzgtpzTw60lsSr.gaP8ozxKSkznPZLs.NKt1MuGTq/Bonm','mByHjQGbqFJQMu_i6TkJzDFeILvkSkSB_1583125608','117.191.242.254',10,0,0,0,0,0,1583255601,NULL,'CUR8Sc',1583125608,1583255601,0.0000,5,0,'4f7545a0e03dd45e506ca08174c334f6',NULL,NULL,NULL,0,0,0,''),(40,'a123456789',1,1,'UmefR3jmh7tloMdjNRXOazr2NhdGuHLh','$2y$13$psy/yKrt10LpVOAYJiZBt.XgCbjc.P/oDRlhH91MKe/5MlqWriUaO','$2y$13$Z/rB1zlW7heiITJrAzb4KOtSVUKpYcWu5Iy4Pk.FGSlv91FBQpdBS','Y7wmc-VSfXk38iKGgba2doKo8nqKqpT5_1583166293','112.96.173.77',10,1,0,0,0,0,1583246860,'CUR8Sc','C9cfBt',1583166293,1583246860,0.0000,5,0,'5d018479d0aac0db2e27525cd006dd25',NULL,NULL,'112.96.197.80',0,0,0,''),(58,'slslslslsl',1,1,'ICnBDiP0BrTPhgpBQ__SEcEQ1cTtwJqB','$2y$13$wOC7cIU2oFDNMAYLjmjBDebhiuQ91ONOQT0gko6NU37AyxuVy.D72','$2y$13$Dnk6VjXawfLqZW8gxtAZXOGexuEnrfyhN618W1iv9ndue6cx2Kzny','MUekC9hQauAwR_J242j90uYvT_eJziri_1583197499','112.96.69.100',10,1,0,0,0,0,1583255659,'CUR8Sc','4qPuT6',1583197499,1583255659,0.0000,5,0,'cb8bd9b0084c1a9633a730e02569d629',NULL,NULL,'112.96.69.100',0,0,0,''),(90,'b2177227',0,1,'HPYdmIMgzoYHhZ7gr94BjkxpX-NVqAlt','$2y$13$iphlV4yUEq2FPJ88BzWmhut5Jq1Ebmhc0ACbTuMrxXPtWZV4eulPi','$2y$13$BdXuXVHfcizWE/DPDlpie.o9NdaU87b3brM/hdNB6S7qg2n7dOBOa','5Af67XtIn9T_jTITDE9eQlJislSYZOTQ_1583197921','112.96.139.42',10,0,0,0,0,0,1583197921,'CUR8Sc','1O581s',1583197921,1583197921,0.0000,5,0,'',NULL,NULL,'112.96.139.42',0,0,0,''),(106,'qq123456',1,1,'l814Bzb6N9av3Nmm217va_qNfQ_I1zSS','$2y$13$VToKO/X0dWp9ypARYcbV5uXUOjZHAyNsoHeWNfDnYXooMhfH5KN1S','$2y$13$8nHb0iNWLswnxw7At9GvCu7mjlOM9nwvm5QDeQVVzHa1/ivxkLVIu','YnxCXMBhaO4g_Fez4NQHS6xXZCEGPWbj_1583198757','112.96.139.42',10,1,0,0,0,0,1583201686,'CUR8Sc','yYrRN5',1583198757,1583201686,0.0000,5,0,'e05fc1745b31c88e8a169a84284281a5',NULL,NULL,'112.96.139.42',0,0,0,'');
/*!40000 ALTER TABLE `me_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_amount_trade`
--

DROP TABLE IF EXISTS `me_user_amount_trade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_amount_trade` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `in_userid` int(11) DEFAULT NULL COMMENT '买入会员id',
  `in_username` varchar(50) DEFAULT NULL COMMENT '买入会员账号',
  `out_userid` int(11) DEFAULT NULL COMMENT '卖出会员id',
  `out_username` varchar(50) DEFAULT NULL COMMENT '卖出会员账号',
  `amount` decimal(20,4) DEFAULT '0.0000' COMMENT '实际交易额',
  `samount` decimal(20,4) DEFAULT '0.0000' COMMENT '交易总额',
  `number` decimal(20,4) NOT NULL COMMENT '余额交易数量',
  `price` decimal(20,4) NOT NULL COMMENT '用户设置价格',
  `sysprice` decimal(20,4) NOT NULL COMMENT '系统时价',
  `terrace_fee` decimal(11,4) DEFAULT '0.0000' COMMENT '平台手续费率(未使用)',
  `discount_fee` decimal(11,4) DEFAULT '0.0000' COMMENT '折扣优惠费率(未使用)',
  `type` int(2) NOT NULL COMMENT '交易类型  1、买入；2、卖出；',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '交易状态 0、订单已挂出；1、买家已下单；2、买家已付款；3、订单已成交；4、订单已取消；5、付款已超时；6、收款已超时；7、卖家已下单; 8、卖家申诉中; 9、卖家申诉成功; 10、付款超时，订单取消;',
  `traded_at` int(11) DEFAULT '0' COMMENT '交易时间',
  `created_at` int(11) DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) DEFAULT '0' COMMENT '更新时间',
  `method` int(2) DEFAULT '0' COMMENT '交易方式, 1: 线下, 2: 线上',
  `order_type` int(2) DEFAULT '0' COMMENT '订单类型, 1: BBA订单',
  `wallet_token` varchar(66) DEFAULT NULL COMMENT '钱包地址',
  `bank` varchar(30) DEFAULT NULL COMMENT '银行名称',
  `bank_num` varchar(30) DEFAULT NULL COMMENT '银行卡号',
  `realname` varchar(50) DEFAULT NULL COMMENT '银行户名',
  `alipay` varchar(100) DEFAULT NULL COMMENT '支付宝账号',
  `wechat` varchar(100) DEFAULT NULL COMMENT '微信账号',
  `phone` varchar(20) DEFAULT NULL COMMENT '卖家联系电话',
  `picture` varchar(255) DEFAULT NULL COMMENT '付款凭证',
  `alipay_img` varchar(200) DEFAULT NULL COMMENT '支付宝收款码',
  `wechat_img` varchar(200) DEFAULT NULL COMMENT '微信收款码',
  `branch_id` int(4) DEFAULT NULL COMMENT '分公司id',
  `old_order_id` int(11) DEFAULT NULL COMMENT '拆分前原订单ID',
  `areaid` int(2) DEFAULT NULL COMMENT '发行表id\r\n',
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='交易记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_amount_trade`
--

LOCK TABLES `me_user_amount_trade` WRITE;
/*!40000 ALTER TABLE `me_user_amount_trade` DISABLE KEYS */;
INSERT INTO `me_user_amount_trade` VALUES (1,40,'a123456789',58,'slslslslsl',333.0000,333.0000,1.0000,0.0000,0.0000,0.0000,0.0000,1,4,1583201516,1583201516,1583201516,1,1,'',NULL,NULL,NULL,NULL,NULL,'17512801585',NULL,NULL,NULL,NULL,NULL,1,'等待买家付款'),(2,40,'a123456789',58,'slslslslsl',799.0000,799.0000,1.0000,0.0000,0.0000,0.0000,0.0000,1,4,1583237810,1583237810,1583237810,1,1,'',NULL,NULL,NULL,NULL,NULL,'17512801585',NULL,NULL,NULL,NULL,NULL,5,'等待买家付款');
/*!40000 ALTER TABLE `me_user_amount_trade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_bank`
--

DROP TABLE IF EXISTS `me_user_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_bank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` int(11) NOT NULL COMMENT '会员id',
  `username` varchar(50) NOT NULL COMMENT '会员名称',
  `truename` varchar(50) DEFAULT '' COMMENT '真实姓名',
  `bank_number` varchar(50) NOT NULL COMMENT '银行卡号',
  `sub_bank` varchar(20) DEFAULT NULL COMMENT '开户支行',
  `bank` varchar(50) NOT NULL COMMENT '银行名称',
  `phone` varchar(20) NOT NULL COMMENT '持卡人手机号',
  `zmpath` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '银行卡正面路径',
  `fmpath` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '银行卡反面路径',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '状态(1: 正常, 2: 已删除)',
  `isdefault` int(11) DEFAULT '1' COMMENT '是否为默认,2是默认',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户银行卡表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_bank`
--

LOCK TABLES `me_user_bank` WRITE;
/*!40000 ALTER TABLE `me_user_bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_user_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_car`
--

DROP TABLE IF EXISTS `me_user_car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userid` int(11) NOT NULL COMMENT '会员id',
  `username` varchar(50) DEFAULT NULL COMMENT '会员账号',
  `car_id` int(11) NOT NULL COMMENT '矿机id',
  `car_name` varchar(50) DEFAULT NULL COMMENT '矿机名称',
  `en_car_name` varchar(50) DEFAULT NULL COMMENT '英语名称',
  `car_level` varchar(50) DEFAULT NULL COMMENT '矿机等级',
  `car_img` varchar(200) DEFAULT NULL COMMENT '矿机图片',
  `car_price` decimal(20,4) DEFAULT '0.0000' COMMENT '矿机购买价格',
  `out_num` int(11) DEFAULT '0' COMMENT '过期天数',
  `get_num` int(11) DEFAULT '0' COMMENT '已加速天数',
  `award_per` decimal(11,6) DEFAULT '0.000000' COMMENT '加速比例',
  `status` int(11) DEFAULT '0' COMMENT '矿机状态(0：未过期，1：已过期）',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `ip` varchar(50) DEFAULT NULL COMMENT 'IP',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_car`
--

LOCK TABLES `me_user_car` WRITE;
/*!40000 ALTER TABLE `me_user_car` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_user_car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_conver`
--

DROP TABLE IF EXISTS `me_user_conver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_conver` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userid` int(11) NOT NULL COMMENT '会员id',
  `username` varchar(50) DEFAULT NULL COMMENT '会员账号',
  `hcg_amount` decimal(20,4) DEFAULT '0.0000' COMMENT '积分数量',
  `cash_amount` decimal(20,4) DEFAULT '0.0000' COMMENT '余额',
  `branch_id` int(11) DEFAULT NULL COMMENT '分公司id',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_conver`
--

LOCK TABLES `me_user_conver` WRITE;
/*!40000 ALTER TABLE `me_user_conver` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_user_conver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_freeze`
--

DROP TABLE IF EXISTS `me_user_freeze`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_freeze` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(50) DEFAULT NULL COMMENT '用户账号',
  `level_id` int(11) DEFAULT '0' COMMENT '挖矿等级',
  `amount` decimal(20,4) DEFAULT '0.0000' COMMENT '挖矿数量',
  `profit` decimal(20,4) DEFAULT '0.0000' COMMENT '累计收益',
  `days` int(11) DEFAULT '0' COMMENT '连续领取天数',
  `expire` int(2) DEFAULT '0' COMMENT '是否到期（0：否 1：是 2：提前取出）',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='挖矿记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_freeze`
--

LOCK TABLES `me_user_freeze` WRITE;
/*!40000 ALTER TABLE `me_user_freeze` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_user_freeze` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_profile`
--

DROP TABLE IF EXISTS `me_user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `icon` varchar(200) DEFAULT 'img/header.png' COMMENT '头像',
  `username` varchar(50) DEFAULT '' COMMENT '姓名',
  `quhao` varchar(10) DEFAULT '86' COMMENT '国家区号',
  `phone` varchar(20) DEFAULT '' COMMENT '手机号',
  `mobile_only` text COMMENT '手机唯一标识',
  `email` varchar(100) DEFAULT NULL COMMENT '电邮地址',
  `alipay` varchar(100) DEFAULT NULL COMMENT '支付宝',
  `alipay_img` varchar(255) DEFAULT NULL COMMENT '支付宝收款码',
  `wechat` varchar(100) DEFAULT NULL COMMENT '微信号',
  `wechat_img` varchar(255) DEFAULT NULL COMMENT '微信收款码',
  `truename` varchar(50) DEFAULT '' COMMENT '真实姓名',
  `idcard` varchar(25) DEFAULT NULL COMMENT '身份证',
  `wallet_token` varchar(66) DEFAULT NULL COMMENT '钱包地址(不使用)',
  `referrerid` int(11) DEFAULT NULL COMMENT '推荐人id',
  `referrer` varchar(50) DEFAULT NULL COMMENT '推荐人',
  `tier` int(11) DEFAULT '0' COMMENT '层级',
  `node` text COMMENT '节点',
  `up_referrer_id` text COMMENT '多代上级推荐人id',
  `down_team_id` text COMMENT '多代下级id',
  `sec` varchar(100) DEFAULT NULL COMMENT 'sec收款账号',
  `sec_img` varchar(255) DEFAULT NULL COMMENT 'sec收款码',
  `sec_name` varchar(50) DEFAULT NULL COMMENT 'sec收款姓名',
  `wechat_name` varchar(50) DEFAULT NULL COMMENT '微信收款姓名',
  `alipay_name` varchar(50) DEFAULT NULL COMMENT '支付宝收款姓名',
  `created_at` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `userid` (`userid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户认证表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_profile`
--

LOCK TABLES `me_user_profile` WRITE;
/*!40000 ALTER TABLE `me_user_profile` DISABLE KEYS */;
INSERT INTO `me_user_profile` VALUES (1,1,'img/header.png','soya12333','86','17777777777',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'veftoQq96kd96m00V4GgNowDKoSv4REgT',NULL,NULL,0,'1',NULL,'40-58-90-106',NULL,NULL,NULL,NULL,NULL,1583125609),(2,40,'img/header.png','a123456789','86','13267891774',NULL,'','111','http://testshop.tmf520.cn/upload/app/85b0e6fbed238a880e9bfdd138563acd.png','111','http://testshop.tmf520.cn/upload/app/dfe38312964ed97df8f09e621166a922.png','','440881123456789874','WlFJHQwZzCKmoijxjR4QUZWgJqh1e3mL',1,'soya12333',1,'1-1','1',NULL,NULL,NULL,NULL,'永给','永不',1583166293),(3,58,'img/header.png','slslslslsl','86','17512801585',NULL,NULL,'5576678','http://testshop.tmf520.cn/upload/app/e25fd538cccf85e0035bc64a2e0b017d.jpeg','2588','http://testshop.tmf520.cn/upload/app/7de1b422dc194b259b709bdf7d4b4fcc.jpeg','周文攀','61072620020503651x','EAOqEMZQyINlZQch4gMfAhnxTqlAgZvl',1,'soya12333',1,'1-2','1',NULL,NULL,NULL,NULL,'都不听','阿鲁',1583197499),(4,90,'img/header.png','b2177227','86','15697598521',NULL,'',NULL,NULL,NULL,NULL,'',NULL,'3tbUSB3I0Y4M7rWuRVKlaJUtn7l6725x',1,'soya12333',1,'1-3','1',NULL,NULL,NULL,NULL,NULL,NULL,1583197921),(5,106,'img/header.png','qq123456','86','16620994189',NULL,'','85258866','http://testshop.tmf520.cn/upload/app/925542f099d9b110e58409895a128a97.png','842888','http://testshop.tmf520.cn/upload/app/52d5f05d02323f8d1f0a6c598adc0c84.png','','440881199906254452','QEShtFGag2drUEKt3Tua6GzEWfJv1dXW',1,'soya12333',1,'1-4','1',NULL,NULL,NULL,NULL,'我看看','镇楼',1583198757);
/*!40000 ALTER TABLE `me_user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_server`
--

DROP TABLE IF EXISTS `me_user_server`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_server` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(100) NOT NULL COMMENT '提问标题',
  `content` text COMMENT '提问内容',
  `replay` text COMMENT '回复内容',
  `userid` int(11) NOT NULL COMMENT '提问会员ID',
  `username` varchar(100) NOT NULL COMMENT '用户名称',
  `adminid` int(11) DEFAULT NULL COMMENT '管理员ID',
  `adminname` varchar(100) DEFAULT NULL COMMENT '管理员名称',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `picture` varchar(255) DEFAULT NULL COMMENT '上传问题图片',
  `branch_id` int(11) DEFAULT NULL COMMENT '分公司id',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `replayd_at` int(11) DEFAULT NULL COMMENT '回复时间',
  `type` int(2) NOT NULL COMMENT '类型1：建议2：超时申请  3：订单申诉  4：联系客服',
  `order_id` int(11) DEFAULT NULL COMMENT '超时订单id',
  `isread` int(2) DEFAULT NULL COMMENT '消息状态（1：未读 2：已读）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户意见表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_server`
--

LOCK TABLES `me_user_server` WRITE;
/*!40000 ALTER TABLE `me_user_server` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_user_server` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_sign`
--

DROP TABLE IF EXISTS `me_user_sign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_sign` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userid` int(11) DEFAULT NULL COMMENT '用户id',
  `username` varchar(50) DEFAULT NULL COMMENT '用户账号',
  `amount` decimal(20,4) DEFAULT '0.0000' COMMENT '签到释放BBA数量',
  `type` int(2) DEFAULT '0' COMMENT '类型（1：日常签到 2：挖矿签到 3：后台赠送签到）',
  `freeze_id` int(11) DEFAULT NULL COMMENT '挖矿记录id',
  `sign_time` int(11) DEFAULT '0' COMMENT '签到时间',
  `ip` varchar(200) DEFAULT NULL COMMENT 'IP',
  `award_id` int(11) DEFAULT NULL COMMENT '奖励表id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员签到记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_sign`
--

LOCK TABLES `me_user_sign` WRITE;
/*!40000 ALTER TABLE `me_user_sign` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_user_sign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_stock_trade`
--

DROP TABLE IF EXISTS `me_user_stock_trade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_stock_trade` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `in_userid` int(11) DEFAULT NULL COMMENT '买入会员ID',
  `in_username` varchar(50) DEFAULT NULL COMMENT '买入会员账号',
  `out_userid` int(11) DEFAULT NULL COMMENT '卖出会员ID',
  `out_username` varchar(255) DEFAULT NULL COMMENT '卖出会员账号',
  `number` decimal(20,4) NOT NULL COMMENT '交易数量',
  `re_num` decimal(20,4) DEFAULT NULL COMMENT '剩余数量',
  `price` decimal(20,4) DEFAULT NULL COMMENT '交易价格',
  `sysprice` decimal(20,4) DEFAULT NULL COMMENT '系统时价',
  `transprice` decimal(20,4) DEFAULT NULL COMMENT '交易总金额',
  `re_transprice` decimal(20,4) DEFAULT NULL COMMENT '交易手续费比例',
  `status` int(2) DEFAULT '0' COMMENT '交易状态 0、挂单成功；1、交易完成；2、交易失败',
  `type` int(2) NOT NULL COMMENT '交易类型  1、买入； 2、卖出； 3、系统交易订单；',
  `created_at` varchar(20) DEFAULT NULL COMMENT '创建时间',
  `traded_at` varchar(20) DEFAULT NULL COMMENT '交易时间',
  `update_at` varchar(20) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='会员交易表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_stock_trade`
--

LOCK TABLES `me_user_stock_trade` WRITE;
/*!40000 ALTER TABLE `me_user_stock_trade` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_user_stock_trade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_transform`
--

DROP TABLE IF EXISTS `me_user_transform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_transform` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `in_userid` int(11) NOT NULL COMMENT '转入会员ID',
  `in_username` varchar(50) DEFAULT NULL COMMENT '转入会员账号',
  `out_userid` int(11) NOT NULL COMMENT '转出会员ID',
  `out_username` varchar(50) DEFAULT NULL COMMENT '转出会员账号',
  `amount` decimal(20,4) NOT NULL DEFAULT '0.0000' COMMENT '转出积分数量',
  `cash_amount` decimal(20,4) DEFAULT '0.0000' COMMENT '获得余额数量',
  `hcg_amount` decimal(20,4) DEFAULT '0.0000' COMMENT '获得数量(未使用)',
  `award` decimal(20,4) DEFAULT '0.0000' COMMENT '奖励数量',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `branch_id` int(4) DEFAULT NULL COMMENT '分公司id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='转出记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_transform`
--

LOCK TABLES `me_user_transform` WRITE;
/*!40000 ALTER TABLE `me_user_transform` DISABLE KEYS */;
INSERT INTO `me_user_transform` VALUES (1,313,'ldy161616',196,'sh5089809',300.0000,0.0000,0.0000,0.0000,1567071125,1567071125,NULL),(2,585,'mwd55870',568,'mdb127131',40.0000,0.0000,0.0000,0.0000,1567495688,1567495688,NULL),(3,585,'mwd55870',568,'mdb127131',40.0000,0.0000,0.0000,0.0000,1567495689,1567495689,NULL),(4,568,'mdb127131',585,'mwd55870',40.0000,0.0000,0.0000,0.0000,1567495841,1567495841,NULL),(5,568,'mdb127131',585,'mwd55870',45.0000,0.0000,0.0000,0.0000,1567562033,1567562033,NULL);
/*!40000 ALTER TABLE `me_user_transform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_wallet`
--

DROP TABLE IF EXISTS `me_user_wallet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_wallet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL COMMENT '会员ID',
  `hcg_wa` decimal(20,4) DEFAULT '0.0000' COMMENT '龙珠',
  `cash_wa` decimal(20,4) DEFAULT '0.0000' COMMENT 'dragon',
  `care_wa` decimal(20,4) DEFAULT '0.0000' COMMENT '推广收益',
  `total_buy` decimal(20,4) DEFAULT '0.0000' COMMENT '累计购买数量',
  `kmd` decimal(20,4) NOT NULL DEFAULT '0.0000' COMMENT 'kmd',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `userid` (`userid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户钱包表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_wallet`
--

LOCK TABLES `me_user_wallet` WRITE;
/*!40000 ALTER TABLE `me_user_wallet` DISABLE KEYS */;
INSERT INTO `me_user_wallet` VALUES (1,1,0.0000,0.0000,0.0000,0.0000,0.0000),(2,40,90.0000,0.0000,0.0000,0.0000,0.0000),(3,58,100.0000,0.0000,202.0000,0.0000,0.0000),(4,90,0.0000,0.0000,0.0000,0.0000,0.0000),(5,106,100.0000,0.0000,0.0000,0.0000,0.0000);
/*!40000 ALTER TABLE `me_user_wallet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_wallet_record`
--

DROP TABLE IF EXISTS `me_user_wallet_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_wallet_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `userid` int(11) NOT NULL COMMENT '会员ID',
  `amount` decimal(20,4) NOT NULL COMMENT '发生金额',
  `event_type` int(11) NOT NULL COMMENT '事件类型 必须填，模型有类型，0 => ''全部'', 1 => "系统拨发", 2 => "系统扣除", 3 => "交易", 4 => ''无限代静态收益'', 5 => ''平级动态收益'', 14 => ''注册推荐奖励'',16 => ''开始挖矿'', 17 => "挖矿收益", 18 =>''静态收益'', 23 => ''结束挖矿'', 28=> ''晋级奖励'' , 29 => ''签到赠送BBA到永久区'', 30 => ''成为正式会员推荐人获得奖励''',
  `pay_type` int(11) NOT NULL COMMENT '交易类型（1: 收入, 2: 支出, 3: 系统交易订单）',
  `wallet_type` int(11) NOT NULL COMMENT '钱包类型（0 => ''全部'', 2 => "BBA", 6 => ''自由区'' , 7 => ''永久区''）',
  `wallet_amount` decimal(20,4) NOT NULL DEFAULT '0.0000' COMMENT '钱包总额  队长使用',
  `note` varchar(255) NOT NULL COMMENT '描述',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `ip` varchar(100) NOT NULL COMMENT '会员IP地址',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '记录读取状态',
  `branch_id` int(11) DEFAULT NULL COMMENT '分公司id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='账目记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_wallet_record`
--

LOCK TABLES `me_user_wallet_record` WRITE;
/*!40000 ALTER TABLE `me_user_wallet_record` DISABLE KEYS */;
INSERT INTO `me_user_wallet_record` VALUES (1,58,100.0000,1,1,1,100.0000,'平台拨发积分(100)',1583200455,1583200455,'223.73.168.248',1,0),(2,58,333.0000,1,1,3,333.0000,'平台拨发推荐收益(333)',1583201451,1583201451,'223.73.168.248',1,0),(3,58,333.0000,11,2,3,0.0000,'后台发布宠物,扣除推广收益',1583201457,1583201457,'223.73.168.248',1,NULL),(4,40,100.0000,1,1,1,100.0000,'平台拨发积分(100)',1583201476,1583201476,'223.73.168.248',1,0),(5,40,2.0000,9,2,1,98.0000,'抢购飞龙ID：1，无预约，冻结积分2',1583201516,1583201516,'223.73.168.248',1,NULL),(6,106,100.0000,1,1,1,100.0000,'平台拨发积分(100)',1583201624,1583201624,'223.73.168.248',1,0),(7,106,10.0000,6,2,1,90.0000,'预约飞龙ID：5，冻结积分10',1583201710,1583201710,'112.96.139.42',1,NULL),(8,58,888.0000,1,1,3,888.0000,'平台拨发推荐收益(888)',1583201846,1583201846,'223.73.168.248',1,0),(9,58,888.0000,11,2,3,0.0000,'后台发布宠物,扣除推广收益',1583201857,1583201857,'223.73.168.248',1,NULL),(10,40,100.0000,1,1,3,100.0000,'平台拨发推荐收益(100)',1583235891,1583235891,'113.86.206.67',1,0),(11,40,100.0000,2,2,3,98.0000,'平台扣除推荐收益(100)',1583236031,1583236031,'113.86.206.67',1,0),(12,40,100.0000,1,1,3,100.0000,'平台拨发推荐收益(100)',1583236554,1583236554,'113.86.206.67',1,0),(13,40,100.0000,11,2,3,0.0000,'后台发布宠物,扣除推广收益',1583236587,1583236587,'113.86.206.67',1,NULL),(14,58,1001.0000,1,1,3,1001.0000,'平台拨发推荐收益(1001)',1583237602,1583237602,'113.86.206.67',1,0),(15,58,1001.0000,11,2,3,0.0000,'后台发布宠物,扣除推广收益',1583237620,1583237620,'113.86.206.67',1,NULL),(16,58,1001.0000,1,1,3,1001.0000,'平台拨发推荐收益(1001)',1583237713,1583237713,'113.86.206.67',1,0),(17,58,799.0000,11,2,3,202.0000,'后台发布宠物,扣除推广收益',1583237795,1583237795,'113.86.206.67',1,NULL),(18,40,8.0000,9,2,1,90.0000,'抢购飞龙ID：4，无预约，冻结积分8',1583237810,1583237810,'112.96.65.231',1,NULL),(19,106,10.0000,10,1,1,100.0000,'未抢购/抢购失败返还积分',1583251501,1583251501,'43.226.156.71',1,NULL);
/*!40000 ALTER TABLE `me_user_wallet_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_user_zodiac`
--

DROP TABLE IF EXISTS `me_user_zodiac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_user_zodiac` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `userid` int(11) DEFAULT NULL COMMENT '用户id',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `issue_id` int(11) DEFAULT NULL COMMENT '生肖发布表id',
  `zodiac_id` int(10) DEFAULT NULL COMMENT '生肖id',
  `zodiac_grade_id` int(10) DEFAULT NULL COMMENT '生肖等级id',
  `old_hcg` decimal(10,3) DEFAULT '0.000' COMMENT '生肖价格(原价)',
  `hcg` decimal(10,3) DEFAULT NULL COMMENT '生肖价格(现价)',
  `created_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `due` int(10) DEFAULT '0' COMMENT '生肖周期',
  `award` decimal(10,2) DEFAULT NULL COMMENT '收益比例',
  `over_time` int(10) DEFAULT NULL COMMENT '过期时间',
  `is_rack` int(10) DEFAULT '0' COMMENT '是否上架(0:未上架, 1:已上架)',
  `is_overtime` int(10) DEFAULT '0' COMMENT '是否过期(0:未过期, 1:已过期)',
  `updated_at` int(10) DEFAULT NULL COMMENT '更新时间',
  `rise_num` int(10) DEFAULT '0' COMMENT '增值次数',
  `source` int(10) NOT NULL COMMENT '来源(0: 抢购 1:推广收益提取/后台发布 )',
  `allow_rack` int(10) NOT NULL DEFAULT '0' COMMENT '是否允许出售(0:允许 1:不允许)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='生肖领养表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_user_zodiac`
--

LOCK TABLES `me_user_zodiac` WRITE;
/*!40000 ALTER TABLE `me_user_zodiac` DISABLE KEYS */;
INSERT INTO `me_user_zodiac` VALUES (1,58,'slslslslsl',1,1,NULL,333.000,333.000,1583201457,1,5.00,1583201457,1,1,1583201457,1,1,1),(2,58,'slslslslsl',2,2,NULL,888.000,888.000,1583201857,2,10.00,1583201857,1,1,1583201857,2,1,1),(3,40,'a123456789',3,1,NULL,100.000,100.000,1583236587,1,5.00,1583236587,1,1,1583236587,1,1,1),(4,58,'slslslslsl',4,5,NULL,1001.000,1001.000,1583237620,7,10.00,1583237620,1,1,1583237620,7,1,0),(5,58,'slslslslsl',5,4,NULL,799.000,799.000,1583237795,7,18.00,1583237795,1,1,1583237795,7,1,0);
/*!40000 ALTER TABLE `me_user_zodiac` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_wallet_address`
--

DROP TABLE IF EXISTS `me_wallet_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_wallet_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户钱包地址id',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `coinname` varchar(20) DEFAULT NULL COMMENT '币种名称',
  `wallet_token` varchar(50) DEFAULT NULL COMMENT '钱包地址',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户钱包地址表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_wallet_address`
--

LOCK TABLES `me_wallet_address` WRITE;
/*!40000 ALTER TABLE `me_wallet_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_wallet_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_withdraw`
--

DROP TABLE IF EXISTS `me_withdraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_withdraw` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `userid` int(10) DEFAULT NULL COMMENT '用户id',
  `username` int(10) DEFAULT NULL COMMENT '用户账号(手机号)',
  `care_wa` decimal(10,2) DEFAULT '0.00' COMMENT '提现积分',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '提现面额',
  `scale` decimal(10,2) DEFAULT '0.00' COMMENT '提现比例',
  `created_at` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='提现记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_withdraw`
--

LOCK TABLES `me_withdraw` WRITE;
/*!40000 ALTER TABLE `me_withdraw` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_withdraw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_zodiac`
--

DROP TABLE IF EXISTS `me_zodiac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_zodiac` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL COMMENT '生肖名称',
  `begin_at_hour` int(4) NOT NULL COMMENT '开抢时间（时）',
  `begin_at_minu` int(4) NOT NULL COMMENT '开抢时间（分）',
  `end_at_hour` int(4) NOT NULL COMMENT '结束时间（时）',
  `end_at_minu` int(4) NOT NULL COMMENT '结束时间（分）',
  `created_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `is_show` int(10) DEFAULT '1' COMMENT '是否显示(0:不显示,1:显示)',
  `picture` varchar(255) DEFAULT NULL COMMENT '图片',
  `subscribe` int(10) DEFAULT NULL COMMENT '预约花费',
  `seckill` int(10) DEFAULT NULL COMMENT '抢购花费',
  `fee` int(11) DEFAULT '0' COMMENT '手续费',
  `due` int(11) DEFAULT NULL COMMENT '周期',
  `click_num` int(10) DEFAULT '0' COMMENT '活跃度',
  `award` decimal(11,0) DEFAULT NULL COMMENT '收益比例',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `issue_num` int(11) DEFAULT '0' COMMENT '发行数量',
  `hcg_min` int(10) NOT NULL DEFAULT '0' COMMENT '神龙价格下限',
  `hcg_max` int(10) NOT NULL DEFAULT '0' COMMENT '神龙价格上限',
  `kmd` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '可挖KMD',
  `cash` int(10) NOT NULL DEFAULT '0' COMMENT 'dragon数量',
  `kill_num` int(10) NOT NULL DEFAULT '0' COMMENT '今日抢购次数',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='生肖表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_zodiac`
--

LOCK TABLES `me_zodiac` WRITE;
/*!40000 ALTER TABLE `me_zodiac` DISABLE KEYS */;
INSERT INTO `me_zodiac` VALUES (1,'生肖幸运鼠',10,0,10,30,1563779065,1,'http://lucky.axwbw.cn/annex/storage/20191107/086c521c3e03360bd3e9fe31ae33d45a.png',1,2,0,1,1,5,1583201504,16,100,500,0.00,1,0),(2,'生肖幸运鸡',10,20,10,40,1563779229,1,'http://lucky.axwbw.cn/annex/storage/20191107/3d7c8d5136ff82d91d229b76dd0c55fa.png',2,4,0,2,15,10,1583201827,18,501,1000,0.00,2,0),(3,'生肖幸运兔',13,31,14,0,1563779263,1,'http://lucky.axwbw.cn/annex/storage/20191107/973780687e675aba5149cddef9d94bb6.png',1,2,0,1,10,10,1583165185,18,200,350,0.00,10,0),(4,'生肖幸运羊',20,10,20,40,1563779313,1,'http://lucky.axwbw.cn/annex/storage/20191107/9c0635c40905e372e8c4ab86d4cb7ab2.png',4,8,0,7,20,18,1583237754,10,751,1000,0.00,18,0),(5,'生肖幸运狗',20,0,20,30,1583164933,1,'http://testshop.tmf520.cn/upload/app/dea13da3cf617dc0e55c5eaf992baedb.png',10,30,0,7,11,10,1583237575,1,1000,5000,0.00,30,0),(6,'生肖幸运猴',14,30,15,0,1583165025,1,'http://testshop.tmf520.cn/upload/app/710e5d6834b5e836b056958630aebfa4.png',10,40,0,7,10,10,1583165025,0,1000,5000,0.00,40,0),(7,'生肖幸运猪',15,30,16,0,1583165060,1,'http://testshop.tmf520.cn/upload/app/4b409a9acbe7c64d56f697451113a0af.png',10,50,0,7,10,10,1583165060,0,1000,5000,0.00,50,0);
/*!40000 ALTER TABLE `me_zodiac` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_zodiac_apply`
--

DROP TABLE IF EXISTS `me_zodiac_apply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_zodiac_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '预约结果（0预约中，1未抢到）',
  `userid` int(11) NOT NULL COMMENT '预约用户id',
  `zodiac_id` int(11) NOT NULL COMMENT '生肖表id',
  `zodiac_grade_id` int(11) DEFAULT NULL COMMENT '生肖等级表id',
  `created_at` int(11) NOT NULL COMMENT '预约时间',
  `status` int(10) DEFAULT '0' COMMENT '预约状态，0预约成功，1已完成 ',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `ip` varchar(100) DEFAULT NULL COMMENT '预约ip',
  `money` decimal(20,2) DEFAULT '0.00' COMMENT '预约冻结的金额',
  `moneyed` decimal(20,2) DEFAULT '0.00' COMMENT '抢购失败返还金额',
  `islock` int(10) NOT NULL DEFAULT '0' COMMENT '是否被限制抢购(0:否 ; 1:是)',
  `kill_status` int(10) NOT NULL DEFAULT '0' COMMENT '抢购状态(0:未抢购/抢购失败 ; 1:抢购成功 )',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='预约记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_zodiac_apply`
--

LOCK TABLES `me_zodiac_apply` WRITE;
/*!40000 ALTER TABLE `me_zodiac_apply` DISABLE KEYS */;
INSERT INTO `me_zodiac_apply` VALUES (1,106,5,NULL,1583201710,1,1583201710,'112.96.139.42',0.00,10.00,0,0);
/*!40000 ALTER TABLE `me_zodiac_apply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_zodiac_grade`
--

DROP TABLE IF EXISTS `me_zodiac_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_zodiac_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) DEFAULT NULL COMMENT '生肖等级名称',
  `hcg_min` int(11) DEFAULT NULL COMMENT '生肖价格上限',
  `hcg_max` int(11) DEFAULT NULL COMMENT '生肖价格上限',
  `cash_min` int(11) DEFAULT NULL COMMENT 'dragon下限',
  `cash_max` int(11) DEFAULT NULL COMMENT 'dragon上限',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='生肖等级表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_zodiac_grade`
--

LOCK TABLES `me_zodiac_grade` WRITE;
/*!40000 ALTER TABLE `me_zodiac_grade` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_zodiac_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_zodiac_issue`
--

DROP TABLE IF EXISTS `me_zodiac_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_zodiac_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `zodiac_id` int(11) NOT NULL COMMENT '生肖表id',
  `zodiac_name` varchar(100) NOT NULL COMMENT '生肖名称',
  `zodiac_grade_id` int(11) DEFAULT NULL COMMENT '生肖等级表id',
  `zodiac_grade_name` varchar(100) DEFAULT NULL COMMENT '生肖等级名称',
  `hcg` decimal(10,3) NOT NULL COMMENT '发行价格',
  `cash` decimal(10,3) DEFAULT NULL COMMENT '发行生肖币',
  `issel` int(11) NOT NULL DEFAULT '0' COMMENT '是否可以卖出（0：待匹配，1：完结 ,2：成长中,3:限制出售）',
  `created_at` int(11) DEFAULT NULL COMMENT '发行时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `belong_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属用户id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='生肖发行表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_zodiac_issue`
--

LOCK TABLES `me_zodiac_issue` WRITE;
/*!40000 ALTER TABLE `me_zodiac_issue` DISABLE KEYS */;
INSERT INTO `me_zodiac_issue` VALUES (1,1,'生肖幸运鼠',NULL,NULL,333.000,1.000,3,1583201457,1583201516,58),(2,2,'生肖幸运鸡',NULL,NULL,888.000,2.000,3,1583201857,1583201857,58),(3,1,'生肖幸运鼠',NULL,NULL,100.000,1.000,3,1583236587,1583236587,40),(4,5,'生肖幸运狗',NULL,NULL,1001.000,30.000,0,1583237620,1583237620,58),(5,4,'生肖幸运羊',NULL,NULL,799.000,18.000,0,1583237795,1583237810,58);
/*!40000 ALTER TABLE `me_zodiac_issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_ztsl_award`
--

DROP TABLE IF EXISTS `me_ztsl_award`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_ztsl_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `award` decimal(10,2) DEFAULT '0.00' COMMENT '增值量',
  `zodiac_id` int(10) DEFAULT NULL COMMENT '神龙id',
  `zodiac_name` varchar(50) DEFAULT NULL COMMENT '神龙名称',
  `userid` int(10) DEFAULT NULL COMMENT '用户id',
  `created_at` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_ztsl_award`
--

LOCK TABLES `me_ztsl_award` WRITE;
/*!40000 ALTER TABLE `me_ztsl_award` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_ztsl_award` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-04  1:30:03
