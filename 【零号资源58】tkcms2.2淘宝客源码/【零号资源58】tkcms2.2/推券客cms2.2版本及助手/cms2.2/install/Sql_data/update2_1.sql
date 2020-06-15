-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- Host: localhost
-- Generation Time: 2017-09-12 16:55:27
-- 服务器版本： 5.6.37-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tuiquankecms`
--

-- --------------------------------------------------------

--
-- 表的结构 `tqk_apply`
--
DROP TABLE IF EXISTS `tqk_apply`;
CREATE TABLE IF NOT EXISTS `tqk_apply` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `alipay` varchar(80) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `qq` varchar(12) DEFAULT NULL,
  `add_time` varchar(15) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------
--
-- 表的结构 `tqk_basklist`
--
DROP TABLE IF EXISTS `tqk_basklist`;
CREATE TABLE IF NOT EXISTS `tqk_basklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL COMMENT '//订单id',
  `order_sn` varchar(50) DEFAULT NULL COMMENT '//订单号',
  `content` varchar(255) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `create_time` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `integray` mediumint(5) DEFAULT NULL COMMENT '//积分',
  `type` tinyint(1) DEFAULT '0' COMMENT '//1为精华帖，2为普通帖',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `tqk_basklist_logo`
--
CREATE TABLE IF NOT EXISTS `tqk_basklist_logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `order_sn` varchar(50) DEFAULT NULL,
  `integray` mediumint(5) DEFAULT NULL COMMENT '//积分',
  `remark` varchar(50) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `tqk_finance`
--
DROP TABLE IF EXISTS `tqk_finance`;
CREATE TABLE IF NOT EXISTS `tqk_finance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `add_time` varchar(15) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `backcash` float(10,2) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  `income` float(10,2) DEFAULT NULL,
  `mark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
--
-- 表的结构 `tqk_nav`
--
DROP TABLE IF EXISTS `tqk_nav`;
CREATE TABLE IF NOT EXISTS `tqk_nav` (
  `id` smallint(4) unsigned NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `link` varchar(255) NOT NULL,
  `target` tinyint(1) NOT NULL DEFAULT '1',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `mod` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tqk_nav`
--

INSERT INTO `tqk_nav` (`id`, `type`, `name`, `alias`, `link`, `target`, `ordid`, `mod`, `status`) VALUES
(1, 'main', '超级人气榜', 'top100', '/index.php/top100', 1, 2, '', 1),
(2, 'main', '特卖精选', 'jingxuan', '/index.php/jingxuan', 0, 3, '', 1),
(3, 'main', '二十元封顶', 'ershi', '/index.php/ershi', 0, 5, '', 1),
(4, 'main', '九块九包邮', 'jiu', '/index.php/jiu', 0, 4, '', 1),
(6, 'main', '优惠券头条', 'article', '/index.php/article/', 0, 255, '', 1),
(7, 'main', '申请代理', 'apply', '/index.php/apply', 0, 255, '', 1),
(8, 'main', '晒单赚积分', 'basklist', '/index.php/basklist', 0, 255, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tqk_menu`
--
DROP TABLE IF EXISTS `tqk_menu`;
CREATE TABLE IF NOT EXISTS `tqk_menu` (
  `id` smallint(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `module_name` varchar(20) NOT NULL,
  `action_name` varchar(20) NOT NULL,
  `data` varchar(120) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `often` tinyint(1) NOT NULL DEFAULT '0',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `display` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=366 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- 转存表中的数据 `tqk_menu`
--

INSERT INTO `tqk_menu` (`id`, `name`, `pid`, `module_name`, `action_name`, `data`, `remark`, `often`, `ordid`, `display`) VALUES
(1, '网站管理', 0, 'setting', 'index', '', '', 0, 1, 1),
(2, '核心设置', 1, 'setting', 'index', '', '', 0, 1, 1),
(3, '首页参数', 151, 'setting', 'index', '&type=site', '', 0, 1, 1),
(6, '菜单管理', 2, 'menu', 'index', '', '', 0, 4, 1),
(7, '新增', 6, 'menu', 'add', '', '', 0, 0, 0),
(8, '编辑', 6, 'menu', 'edit', '', '', 0, 0, 0),
(9, '删除', 6, 'menu', 'delete', '', '', 0, 0, 0),
(14, '友情链接', 288, 'link', 'index', '', '', 0, 2, 1),
(15, '友情链接', 338, 'link', 'index', '', '', 0, 0, 1),
(17, '新增', 15, 'link', 'add', '', '', 0, 0, 0),
(18, '编辑', 15, 'link', 'edit', '', '', 0, 0, 0),
(19, '删除', 15, 'link', 'delete', '', '', 0, 0, 0),
(31, '数据库管理', 331, 'backup', 'index', '', '', 0, 2, 1),
(32, '数据备份', 31, 'backup', 'index', '', '', 0, 0, 1),
(33, '数据恢复', 31, 'backup', 'restore', '', '', 0, 0, 1),
(34, '清理缓存', 2, 'cache', 'index', '', '', 1, 0, 0),
(50, '数据管理', 0, 'content', 'index', '', '', 0, 2, 1),
(51, '商品管理', 50, 'article', 'index', '', '', 0, 2, 1),
(52, '商品管理', 51, 'items', 'index', '', '', 0, 2, 1),
(54, '编辑', 52, 'article', 'edit', '', '', 0, 3, 0),
(56, '商品分类', 292, 'items_cate', 'index', '', '', 0, 6, 1),
(60, '管理员管理', 1, 'admin', 'index', '', '', 0, 3, 1),
(61, '管理员管理', 60, 'admin', 'index', '', '', 0, 1, 1),
(62, '新增', 61, 'admin', 'add', '', '', 0, 0, 0),
(63, '编辑', 61, 'admin', 'edit', '', '', 0, 0, 0),
(64, '删除', 61, 'admin', 'delete', '', '', 0, 0, 0),
(65, '分组管理', 60, 'admin_role', 'index', '', '', 0, 2, 1),
(66, '新增', 65, 'admin_role', 'add', '', '', 0, 0, 0),
(148, '站点设置', 2, 'setting', 'index', '', '', 0, 0, 1),
(150, '删除', 149, 'user', 'delete', '', '', 0, 5, 0),
(151, '首页设置', 1, 'nav', 'index', '', '', 0, 1, 1),
(152, '导航设置', 151, 'nav', 'index', '&type=main', '', 0, 2, 1),
(275, 'Logo设置', 151, 'setting', 'index', '&type=other', '', 0, 3, 1),
(277, '商品管理', 52, 'items', 'index', '', '', 0, 1, 1),
(278, '文章管理', 155, 'article', 'index', '', '', 0, 1, 1),
(282, 'SEO设置', 2, 'seo', 'url', '', '', 0, 2, 1),
(283, 'URL静态化', 282, 'seo', 'url', '', '', 0, 255, 1),
(284, '页面SEO', 282, 'seo', 'page', '', '', 0, 255, 1),
(292, '商品分类', 50, 'fenlei', 'index', '', '', 0, 3, 1),
(302, '清空数据', 51, 'items', 'clear', '', '', 0, 4, 1),
(305, '过期商品', 51, 'items', 'outtime', '', '', 0, 3, 1),
(307, '一键延时', 51, 'items', 'key_addtime', '', '', 0, 5, 1),
(249, '添加商品', 51, 'items', 'add', '', '', 0, 1, 1),
(323, '商品分类', 249, 'items_cate', 'ajax_getchilds', '', '', 0, 255, 0),
(324, '一键获取商品', 249, 'items', 'ajaxgetid', '', '', 0, 255, 1),
(328, '升级数据库', 31, 'backup', 'upsql', '', '', 0, 255, 1),
(331, '工具', 0, 'plugin', 'index', '', '', 0, 7, 1),
(338, '其他设置', 1, 'plugin', 'Link', '', '', 0, 255, 1),
(295, '帮助文件', 338, 'help', 'index', '', '', 0, 1, 1),
(12, '广告管理', 151, 'ad', 'index', '', '', 0, 4, 1),
(23, '新增', 12, 'ad', 'add', '', '', 0, 0, 0),
(24, '编辑', 12, 'ad', 'edit', '', '', 0, 0, 0),
(25, '删除', 12, 'ad', 'delete', '', '', 0, 0, 0),
(348, '内容管理', 0, 'article', 'index', '', '', 0, 255, 1),
(349, '文章管理', 348, 'article', 'index', '', '', 0, 255, 1),
(350, '文章列表', 349, 'article', 'index', '', '', 0, 255, 1),
(351, '文章分类', 349, 'article_cate', 'index', '', '', 0, 255, 1),
(359, '公众号直播管理', 331, 'zhibo', 'index', '', '', 0, 255, 1),
(356, '用户管理', 0, 'user', 'index', '', '', 0, 255, 1),
(357, '用户列表', 356, 'user', 'index', '', '', 0, 255, 1),
(358, '用户管理', 357, 'user', 'index', '', '', 0, 255, 1),
(360, '直播配置', 359, 'zhibo', 'setting', '', '', 0, 255, 1),
(361, '红包管理', 359, 'hongbao', 'index', '', '', 0, 255, 1),
(363, '财务管理', 356, 'charge', 'index', '', '', 0, 255, 1),
(364, '余额提现', 363, 'balance', 'index', '', '', 0, 255, 1),
(365, '财务日志', 363, 'cash', 'index', '', '', 0, 255, 1),
(366, '订单管理', 363, 'order', 'index', '', '', 0, 255, 1),
(367, '站长申请', 357, 'apply', 'index', '', '', 0, 255, 1),
(368, '晒单管理', 348, 'basklist', 'index', '', '', 0, 255, 1),
(369, '晒单列表', 368, 'basklist', 'index', '', '', 0, 255, 1),
(370, '站长分成', 363, 'finance', 'flist', '', '', 0, 255, 1),
(371, '积分日志', 368, 'basklist', 'logs', '', '', 0, 255, 1);


-- --------------------------------------------------------
--
-- 表的结构 `tqk_order`
--

ALTER TABLE  `tqk_order` CHANGE  `uid`  `uid` INT( 10 ) NULL DEFAULT  '0';

ALTER TABLE  `tqk_order` ADD  `goods_iid` VARCHAR( 15 ) NULL AFTER  `up_time` ,
ADD  `goods_title` VARCHAR( 160 ) NULL AFTER  `goods_iid` ,
ADD  `goods_num` INT( 3 ) NULL AFTER  `goods_title` ,
ADD  `ad_id` INT( 10 ) NULL AFTER  `goods_num` ,
ADD  `ad_name` VARCHAR( 80 ) NULL AFTER  `ad_id` ,
ADD  `goods_rate` VARCHAR( 10 ) NULL AFTER  `ad_name` ,
ADD  `income` FLOAT( 10, 2 ) NULL AFTER  `goods_rate` ;


ALTER TABLE  `tqk_user` ADD  `webmaster` TINYINT( 1 ) NULL DEFAULT  '0',
ADD  `webmaster_pid` VARCHAR( 12 ) NULL ,
ADD  `webmaster_rate` INT( 5 ) NULL ;

ALTER TABLE `tqk_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tqk_nav`
--
ALTER TABLE `tqk_nav`
  ADD PRIMARY KEY (`id`);
