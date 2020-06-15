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
-- 表的结构 `tqk_brand`
--
DROP TABLE IF EXISTS `tqk_brand`;
CREATE TABLE IF NOT EXISTS `tqk_brand` (
  `id` int(11) NOT NULL,
  `cate_id` smallint(4) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `recommend` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `ordid` mediumint(5) DEFAULT '255',
  `add_time` varchar(20) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;


INSERT INTO `tqk_brand` (`id`, `cate_id`, `logo`, `brand`, `recommend`, `status`, `ordid`, `add_time`, `remark`) VALUES
(7, 14, '/data/upload/avatar/5a2df3e952156.png', '九阳', 1, 1, 255, NULL, '最高可省200元'),
(8, 17, '/data/upload/avatar/5a2df5618446a.png', '波司登', 1, 1, 255, NULL, ''),
(9, 11, '/data/upload/avatar/5a2e14cdbbb50.jpg', '百雀羚', 1, 1, 255, NULL, ''),
(10, 11, '/data/upload/avatar/5a2e14dc6892c.jpg', '佰草集', 1, 1, 255, NULL, ''),
(11, 11, '/data/upload/avatar/5a2e14f00e03c.jpg', '菲诗小铺', 1, 1, 255, NULL, ''),
(12, 13, '/data/upload/avatar/5a2fe38dba8f5.jpg', '苏泊尔', 1, 1, 255, NULL, ''),
(13, 17, '/data/upload/avatar/5a2fe543d3481.jpg', '恒源祥', 1, 1, 255, NULL, ''),
(14, 11, '/data/upload/avatar/5a2fe69461f7b.jpg', '自然堂', 1, 1, 255, NULL, ''),
(15, 9, '/data/upload/avatar/5a3128ad23039.jpg', '百草味', 1, 1, 255, NULL, ''),
(16, 9, '/data/upload/avatar/5a3128d2db7cb.jpg', '良品铺子', 1, 1, 255, NULL, ''),
(17, 9, '/data/upload/avatar/5a3128e4270b1.jpg', '徐福记', 1, 1, 255, NULL, ''),
(18, 9, '/data/upload/avatar/5a3129058c49d.jpg', '盼盼食品', 1, 1, 255, NULL, ''),
(19, 9, '/data/upload/avatar/5a31293e48ee6.jpg', '雀巢', 1, 1, 255, NULL, ''),
(20, 10, '/data/upload/avatar/5a31296944578.jpg', '施华洛世奇', 1, 1, 255, NULL, ''),
(21, 10, '/data/upload/avatar/5a31297eb3c32.jpg', '六福珠宝', 1, 1, 255, NULL, ''),
(22, 10, '/data/upload/avatar/5a31298fa3e41.jpg', '慈元阁', 1, 1, 255, NULL, ''),
(23, 11, '/data/upload/avatar/5a3129b124cea.jpg', '韩后', 1, 1, 255, NULL, ''),
(24, 16, '/data/upload/avatar/5a3129cb05949.jpg', '十月结晶', 1, 1, 255, NULL, ''),
(25, 17, '/data/upload/avatar/5a3129e761a57.jpg', '七匹狼', 1, 1, 255, NULL, ''),
(26, 17, '/data/upload/avatar/5a312a35aaa86.jpg', '雅鹿', 1, 1, 255, NULL, ''),
(27, 17, '/data/upload/avatar/5a312a45b3c5c.jpg', '红豆内衣', 1, 1, 255, NULL, ''),
(28, 18, '/data/upload/avatar/5a312a61012a0.jpg', '特步', 1, 1, 255, NULL, ''),
(29, 18, '/data/upload/avatar/5a312a735447e.jpg', '达芙妮', 1, 1, 255, NULL, ''),
(30, 12, '/data/upload/avatar/5a312a84d9e9b.jpg', '晨光', 1, 1, 255, NULL, ''),
(31, 12, '/data/upload/avatar/5a312a98e3c79.jpg', '得力', 1, 1, 255, NULL, ''),
(32, 15, '/data/upload/avatar/5a312aab01ea9.jpg', '稻草人', 1, 1, 255, NULL, ''),
(33, 15, '/data/upload/avatar/5a312ac130780.jpg', '老人头', 1, 1, 255, NULL, ''),
(34, 14, '/data/upload/avatar/5a312b117e0f6.jpg', '品胜', 1, 1, 255, NULL, ''),
(35, 14, '/data/upload/avatar/5a312b301b3e6.jpg', '罗技', 1, 1, 255, NULL, ''),
(36, 14, '/data/upload/avatar/5a312b551f218.jpg', '海尔', 1, 1, 255, NULL, ''),
(37, 14, '/data/upload/avatar/5a312b6423e16.jpg', '飞利浦', 1, 1, 255, NULL, ''),
(38, 18, '/data/upload/avatar/5a312b8e6e0a2.jpg', '李宁', 1, 1, 255, NULL, ''),
(39, 17, '/data/upload/avatar/5a312c0c17d83.jpg', '迪士尼', 1, 1, 255, NULL, ''),
(40, 11, '/data/upload/avatar/5a312c42d930f.jpg', '美肤宝', 1, 1, 255, NULL, ''),
(41, 11, '/data/upload/avatar/5a312d4c815dd.jpg', '欧莱雅', 1, 1, 255, NULL, ''),
(42, 11, '/data/upload/avatar/5a312d6912935.jpg', '欧诗漫', 1, 1, 255, NULL, '');

--
-- Indexes for table `tqk_brand`
--
ALTER TABLE `tqk_brand`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `tqk_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
  
--
-- 表的结构 `tqk_brand_cate`
--
DROP TABLE IF EXISTS `tqk_brand_cate`;
CREATE TABLE IF NOT EXISTS `tqk_brand_cate` (
  `id` smallint(4) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `pid` smallint(4) unsigned NOT NULL DEFAULT '0',
  `spid` varchar(50) NOT NULL,
  `ordid` smallint(4) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `seo_title` varchar(255) NOT NULL,
  `seo_keys` varchar(255) NOT NULL,
  `seo_desc` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO `tqk_brand_cate` (`id`, `name`, `pid`, `spid`, `ordid`, `status`, `seo_title`, `seo_keys`, `seo_desc`) VALUES
(9, '美食', 0, '0', 255, 1, '', '', ''),
(10, '配饰', 0, '0', 255, 1, '', '', ''),
(11, '美妆', 0, '0', 255, 1, '', '', ''),
(12, '文体', 0, '0', 255, 1, '', '', ''),
(13, '居家', 0, '0', 255, 1, '', '', ''),
(14, '数码电器', 0, '0', 255, 1, '', '', ''),
(15, '箱包', 0, '0', 255, 1, '', '', ''),
(16, '母婴', 0, '0', 255, 1, '', '', ''),
(17, '服装', 0, '0', 255, 1, '', '', ''),
(18, '鞋帽', 0, '0', 255, 1, '', '', '');

ALTER TABLE `tqk_brand_cate`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `tqk_brand_cate`
  MODIFY `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


INSERT INTO `tqk_nav` (`id`, `type`, `name`, `alias`, `link`, `target`, `ordid`, `mod`, `status`) VALUES
(1, 'main', '超级人气榜', 'top100', '/index.php/top100', 1, 2, '', 1),
(2, 'main', '特卖精选', 'jingxuan', '/index.php/jingxuan', 0, 3, '', 1),
(3, 'main', '品牌优惠券', 'brand', '/index.php/brand', 0, 5, '', 1),
(4, 'main', '九块九包邮', 'jiu', '/index.php/jiu', 0, 4, '', 1),
(6, 'main', '优惠券头条', 'article', '/index.php/article/', 0, 255, '', 1),
(7, 'main', '申请代理', 'apply', '/index.php/apply', 0, 255, '', 1),
(8, 'main', '晒单赚积分', 'shaidan', '/index.php/basklist', 0, 255, '', 1);

ALTER TABLE `tqk_nav`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `tqk_nav`
  MODIFY `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
  
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
) ENGINE=MyISAM AUTO_INCREMENT=385 DEFAULT CHARSET=utf8;


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
(371, '积分日志', 368, 'basklist', 'logs', '', '', 0, 255, 1),
(372, '品牌专场', 50, 'brand', 'index', '', '', 0, 255, 1),
(373, '品牌列表', 372, 'brand', 'index', '', '', 0, 255, 1),
(374, '品牌分类', 372, 'brand_cate', 'index', '', '', 0, 255, 1),
(383, '百度链接提交', 331, 'tuisong', 'index', '', '', 0, 255, 1),
(384, '一键推送', 383, 'tuisong', 'index', '', '', 0, 255, 1);

ALTER TABLE `tqk_menu`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `tqk_menu`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=385;