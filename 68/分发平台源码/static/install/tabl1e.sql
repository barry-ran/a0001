-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2020-03-17 20:21:40
-- 服务器版本： 5.5.62-log
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `www_la96m_cn`
--

-- --------------------------------------------------------

--
-- 表的结构 `codepay_order`
--

CREATE TABLE `codepay_order` (
  `id` int(11) UNSIGNED NOT NULL,
  `pay_id` varchar(50) NOT NULL COMMENT '用户ID或订单ID',
  `money` decimal(6,2) UNSIGNED NOT NULL COMMENT '实际金额',
  `price` decimal(6,2) UNSIGNED NOT NULL COMMENT '原价',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `pay_no` varchar(100) NOT NULL COMMENT '流水号',
  `param` varchar(200) DEFAULT NULL COMMENT '自定义参数',
  `pay_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `pay_tag` varchar(100) NOT NULL DEFAULT '0' COMMENT '金额的备注',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `creat_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `up_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用于区分是否已经处理';

--
-- 转存表中的数据 `codepay_order`
--

INSERT INTO `codepay_order` (`id`, `pay_id`, `money`, `price`, `type`, `pay_no`, `param`, `pay_time`, `pay_tag`, `status`, `creat_time`, `up_time`) VALUES
(1, '777@qq.com', '10.00', '10.00', 3, '7318872914743953435', NULL, 1544957235, '0', 2, 1544957235, '2018-12-16 10:47:15');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_admin`
--

CREATE TABLE `prefix_admin` (
  `in_adminid` int(11) NOT NULL,
  `in_adminname` varchar(255) NOT NULL,
  `in_adminpassword` varchar(255) NOT NULL,
  `in_loginip` varchar(255) DEFAULT NULL,
  `in_loginnum` int(11) NOT NULL,
  `in_logintime` datetime DEFAULT NULL,
  `in_islock` int(11) NOT NULL,
  `in_permission` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `prefix_admin`
--

INSERT INTO `prefix_admin` (`in_adminid`, `in_adminname`, `in_adminpassword`, `in_loginip`, `in_loginnum`, `in_logintime`, `in_islock`, `in_permission`) VALUES
(1, '1787601777@qq.com', '789846edfc537bdd1e315f1abfcd8785', '121.16.167.90', 3, '2020-03-17 19:57:21', 0, '1,2,3,4,5,6,7'),
(4, '1787601777@qq.com', '789846edfc537bdd1e315f1abfcd8785', NULL, 0, NULL, 0, '1,2,3,4,5,6,7');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_app`
--

CREATE TABLE `prefix_app` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_name` varchar(255) NOT NULL,
  `in_bid` varchar(255) DEFAULT NULL,
  `in_mnvs` varchar(255) DEFAULT NULL,
  `in_bsvs` varchar(255) DEFAULT NULL,
  `in_bvs` varchar(255) DEFAULT NULL,
  `in_type` int(11) NOT NULL,
  `in_nick` varchar(255) DEFAULT NULL,
  `in_team` varchar(255) DEFAULT NULL,
  `in_form` varchar(255) DEFAULT NULL,
  `in_icon` varchar(255) DEFAULT NULL,
  `in_app` varchar(255) NOT NULL,
  `in_hits` int(11) NOT NULL,
  `in_deduct` int(11) NOT NULL,
  `in_size` bigint(20) NOT NULL,
  `in_kid` int(11) NOT NULL,
  `in_sign` int(11) NOT NULL,
  `in_resign` int(11) NOT NULL,
  `in_link` varchar(255) DEFAULT NULL,
  `in_removead` int(11) NOT NULL,
  `in_highspeed` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_apps`
--

CREATE TABLE `prefix_apps` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) DEFAULT NULL,
  `in_uname` varchar(255) DEFAULT NULL,
  `in_name` varchar(255) DEFAULT NULL,
  `in_bid` varchar(255) DEFAULT NULL,
  `in_mnvs` varchar(255) DEFAULT NULL,
  `in_bsvs` varchar(255) DEFAULT NULL,
  `in_bvs` varchar(255) DEFAULT NULL,
  `in_type` int(11) DEFAULT NULL,
  `in_nick` varchar(255) DEFAULT NULL,
  `in_team` varchar(255) DEFAULT NULL,
  `in_form` varchar(255) DEFAULT NULL,
  `in_icon` varchar(255) DEFAULT NULL,
  `in_plist` varchar(255) DEFAULT NULL,
  `in_hits` int(11) DEFAULT NULL,
  `in_size` varchar(255) DEFAULT NULL,
  `in_kid` int(11) DEFAULT NULL,
  `in_sign` int(11) DEFAULT NULL,
  `in_resign` int(11) DEFAULT NULL,
  `in_link` varchar(255) DEFAULT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_app_copy`
--

CREATE TABLE `prefix_app_copy` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_name` varchar(255) NOT NULL,
  `in_bid` varchar(255) DEFAULT NULL,
  `in_mnvs` varchar(255) DEFAULT NULL,
  `in_bsvs` varchar(255) DEFAULT NULL,
  `in_bvs` varchar(255) DEFAULT NULL,
  `in_type` int(11) NOT NULL,
  `in_nick` varchar(255) DEFAULT NULL,
  `in_team` varchar(255) DEFAULT NULL,
  `in_form` varchar(255) DEFAULT NULL,
  `in_icon` varchar(255) DEFAULT NULL,
  `in_plist` varchar(255) NOT NULL,
  `in_hits` int(11) NOT NULL,
  `in_size` varchar(255) DEFAULT NULL,
  `in_kid` int(11) NOT NULL,
  `in_sign` int(11) NOT NULL,
  `in_resign` int(11) NOT NULL,
  `in_link` varchar(255) DEFAULT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_buylog`
--

CREATE TABLE `prefix_buylog` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_title` varchar(255) NOT NULL,
  `in_tid` int(11) NOT NULL,
  `in_money` int(11) NOT NULL,
  `in_lock` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_cert`
--

CREATE TABLE `prefix_cert` (
  `in_id` int(11) NOT NULL,
  `in_iden` varchar(255) NOT NULL,
  `in_name` varchar(255) NOT NULL,
  `in_dir` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_key`
--

CREATE TABLE `prefix_key` (
  `in_id` int(11) NOT NULL,
  `in_tid` int(11) NOT NULL,
  `in_code` varchar(255) NOT NULL,
  `in_state` int(11) NOT NULL,
  `in_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_mail`
--

CREATE TABLE `prefix_mail` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_ucode` varchar(255) NOT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_order`
--

CREATE TABLE `prefix_order` (
  `id` int(11) UNSIGNED NOT NULL,
  `pay_id` varchar(50) NOT NULL COMMENT '用户ID或订单ID',
  `money` decimal(6,2) UNSIGNED NOT NULL COMMENT '实际金额',
  `price` decimal(6,2) UNSIGNED NOT NULL COMMENT '原价',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `pay_no` varchar(100) NOT NULL COMMENT '流水号',
  `param` varchar(200) DEFAULT NULL COMMENT '自定义参数',
  `pay_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `pay_tag` varchar(100) NOT NULL DEFAULT '0' COMMENT '金额的备注',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `creat_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `up_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用于区分是否已经处理';

-- --------------------------------------------------------

--
-- 表的结构 `prefix_paylog`
--

CREATE TABLE `prefix_paylog` (
  `in_id` int(11) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_title` varchar(255) NOT NULL,
  `in_points` int(11) NOT NULL,
  `in_money` int(11) NOT NULL,
  `in_lock` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `prefix_paylog`
--

INSERT INTO `prefix_paylog` (`in_id`, `in_uid`, `in_uname`, `in_title`, `in_points`, `in_money`, `in_lock`, `in_addtime`) VALUES
(1, 176, '942956788@qq.com', '176-1560337391', 1000, 10, 1, '2019-06-12 19:03:11'),
(2, 21, '1787601777@qq.com', '21-1562941898', 10000, 90, 1, '2019-07-12 22:31:38');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_plugin`
--

CREATE TABLE `prefix_plugin` (
  `in_id` int(11) NOT NULL,
  `in_name` varchar(255) NOT NULL,
  `in_dir` varchar(255) NOT NULL,
  `in_file` varchar(255) NOT NULL,
  `in_type` int(11) NOT NULL,
  `in_author` varchar(255) DEFAULT NULL,
  `in_address` varchar(255) DEFAULT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `prefix_plugin`
--

INSERT INTO `prefix_plugin` (`in_id`, `in_name`, `in_dir`, `in_file`, `in_type`, `in_author`, `in_address`, `in_addtime`) VALUES
(1, '阿里云存储[分发]', 'App-oss', 'upload', 0, 'BEES', 'https://www.021163.cn/', '2019-02-25 13:05:56'),
(2, '七牛云存储[分发]', 'App-qiniu', 'upload', 0, 'BEES', 'https://www.021163.cn/', '2019-02-25 13:05:56'),
(3, '阿里云存储[分发]', 'App-oss', 'upload', 0, 'EarDev', '/', '2020-03-17 19:18:32'),
(4, '七牛云存储[分发]', 'App-qiniu', 'upload', 0, 'EarDev', '/', '2020-03-17 19:18:32'),
(5, '阿里云存储[分发]', 'App-oss', 'upload', 0, 'EarDev', 'http://www.eardev.com/', '2020-03-17 19:35:58'),
(6, '七牛云存储[分发]', 'App-qiniu', 'upload', 0, 'EarDev', 'http://www.eardev.com/', '2020-03-17 19:35:58');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_salt`
--

CREATE TABLE `prefix_salt` (
  `in_id` int(11) NOT NULL,
  `in_aid` int(11) NOT NULL,
  `in_salt` varchar(255) NOT NULL,
  `in_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_secret`
--

CREATE TABLE `prefix_secret` (
  `in_id` int(11) NOT NULL,
  `in_site` varchar(255) NOT NULL,
  `in_md5` varchar(255) NOT NULL,
  `in_endtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_sign`
--

CREATE TABLE `prefix_sign` (
  `in_id` int(11) NOT NULL,
  `in_aid` int(11) NOT NULL,
  `in_aname` varchar(255) DEFAULT NULL,
  `in_replace` varchar(255) DEFAULT NULL,
  `in_ssl` varchar(255) NOT NULL,
  `in_site` varchar(255) NOT NULL,
  `in_path` varchar(255) NOT NULL,
  `in_ipa` varchar(255) NOT NULL,
  `in_status` int(11) NOT NULL,
  `in_cert` varchar(255) NOT NULL,
  `in_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_signlog`
--

CREATE TABLE `prefix_signlog` (
  `in_id` int(11) NOT NULL,
  `in_aid` int(11) NOT NULL,
  `in_aname` varchar(255) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_status` int(11) NOT NULL,
  `in_step` varchar(255) NOT NULL,
  `in_percent` int(11) NOT NULL,
  `in_cert` varchar(255) NOT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_user`
--

CREATE TABLE `prefix_user` (
  `in_userid` int(11) NOT NULL,
  `in_username` varchar(255) NOT NULL,
  `in_userpassword` varchar(255) NOT NULL,
  `in_nick` varchar(255) DEFAULT NULL,
  `in_card` varchar(255) DEFAULT NULL,
  `in_mobile` varchar(255) DEFAULT NULL,
  `in_qq` varchar(255) DEFAULT NULL,
  `in_firm` varchar(255) DEFAULT NULL,
  `in_job` varchar(255) DEFAULT NULL,
  `in_regdate` datetime DEFAULT NULL,
  `in_loginip` varchar(255) DEFAULT NULL,
  `in_logintime` datetime DEFAULT NULL,
  `in_verify` int(11) NOT NULL,
  `in_islock` int(11) NOT NULL,
  `in_points` int(11) NOT NULL,
  `in_spaceuse` bigint(20) NOT NULL,
  `in_spacetotal` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `prefix_user`
--

INSERT INTO `prefix_user` (`in_userid`, `in_username`, `in_userpassword`, `in_nick`, `in_card`, `in_mobile`, `in_qq`, `in_firm`, `in_job`, `in_regdate`, `in_loginip`, `in_logintime`, `in_verify`, `in_islock`, `in_points`, `in_spaceuse`, `in_spacetotal`) VALUES
(1088, '1787601777@qq.com', 'fc537bdd1e315f1a', NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-17 19:53:30', '121.16.167.90', '2020-03-17 19:53:30', 0, 0, 10, 2591490, 1073741824);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_webview`
--

CREATE TABLE `prefix_webview` (
  `in_id` int(11) NOT NULL,
  `in_tid` int(11) NOT NULL,
  `in_title` varchar(255) DEFAULT NULL,
  `in_url` varchar(255) NOT NULL,
  `in_img` varchar(255) NOT NULL,
  `in_ext` varchar(255) NOT NULL,
  `in_status` int(11) NOT NULL,
  `in_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_webviewlog`
--

CREATE TABLE `prefix_webviewlog` (
  `in_id` int(11) NOT NULL,
  `in_tid` int(11) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_title` varchar(255) NOT NULL,
  `in_url` varchar(255) NOT NULL,
  `in_img` varchar(255) NOT NULL,
  `in_ext` varchar(255) NOT NULL,
  `in_status` int(11) NOT NULL,
  `in_step` varchar(255) NOT NULL,
  `in_percent` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_webviewsecret`
--

CREATE TABLE `prefix_webviewsecret` (
  `in_id` int(11) NOT NULL,
  `in_site` varchar(255) NOT NULL,
  `in_md5` varchar(255) NOT NULL,
  `in_endtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codepay_order`
--
ALTER TABLE `codepay_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `main` (`pay_id`,`pay_time`,`money`,`type`,`pay_tag`),
  ADD UNIQUE KEY `pay_no` (`pay_no`,`type`);

--
-- Indexes for table `prefix_admin`
--
ALTER TABLE `prefix_admin`
  ADD PRIMARY KEY (`in_adminid`);

--
-- Indexes for table `prefix_app`
--
ALTER TABLE `prefix_app`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_apps`
--
ALTER TABLE `prefix_apps`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_app_copy`
--
ALTER TABLE `prefix_app_copy`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_buylog`
--
ALTER TABLE `prefix_buylog`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_cert`
--
ALTER TABLE `prefix_cert`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_key`
--
ALTER TABLE `prefix_key`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_mail`
--
ALTER TABLE `prefix_mail`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_order`
--
ALTER TABLE `prefix_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `main` (`pay_id`,`pay_time`,`money`,`type`,`pay_tag`),
  ADD UNIQUE KEY `pay_no` (`pay_no`,`type`);

--
-- Indexes for table `prefix_paylog`
--
ALTER TABLE `prefix_paylog`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_plugin`
--
ALTER TABLE `prefix_plugin`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_salt`
--
ALTER TABLE `prefix_salt`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_secret`
--
ALTER TABLE `prefix_secret`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_sign`
--
ALTER TABLE `prefix_sign`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_signlog`
--
ALTER TABLE `prefix_signlog`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_user`
--
ALTER TABLE `prefix_user`
  ADD PRIMARY KEY (`in_userid`);

--
-- Indexes for table `prefix_webview`
--
ALTER TABLE `prefix_webview`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_webviewlog`
--
ALTER TABLE `prefix_webviewlog`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `prefix_webviewsecret`
--
ALTER TABLE `prefix_webviewsecret`
  ADD PRIMARY KEY (`in_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `codepay_order`
--
ALTER TABLE `codepay_order`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `prefix_admin`
--
ALTER TABLE `prefix_admin`
  MODIFY `in_adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `prefix_app`
--
ALTER TABLE `prefix_app`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2049;

--
-- 使用表AUTO_INCREMENT `prefix_apps`
--
ALTER TABLE `prefix_apps`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- 使用表AUTO_INCREMENT `prefix_app_copy`
--
ALTER TABLE `prefix_app_copy`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- 使用表AUTO_INCREMENT `prefix_buylog`
--
ALTER TABLE `prefix_buylog`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- 使用表AUTO_INCREMENT `prefix_cert`
--
ALTER TABLE `prefix_cert`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- 使用表AUTO_INCREMENT `prefix_key`
--
ALTER TABLE `prefix_key`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3480;

--
-- 使用表AUTO_INCREMENT `prefix_mail`
--
ALTER TABLE `prefix_mail`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- 使用表AUTO_INCREMENT `prefix_order`
--
ALTER TABLE `prefix_order`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=551;

--
-- 使用表AUTO_INCREMENT `prefix_paylog`
--
ALTER TABLE `prefix_paylog`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `prefix_plugin`
--
ALTER TABLE `prefix_plugin`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `prefix_salt`
--
ALTER TABLE `prefix_salt`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `prefix_secret`
--
ALTER TABLE `prefix_secret`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- 使用表AUTO_INCREMENT `prefix_sign`
--
ALTER TABLE `prefix_sign`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1732;

--
-- 使用表AUTO_INCREMENT `prefix_signlog`
--
ALTER TABLE `prefix_signlog`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- 使用表AUTO_INCREMENT `prefix_user`
--
ALTER TABLE `prefix_user`
  MODIFY `in_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1089;

--
-- 使用表AUTO_INCREMENT `prefix_webview`
--
ALTER TABLE `prefix_webview`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `prefix_webviewlog`
--
ALTER TABLE `prefix_webviewlog`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `prefix_webviewsecret`
--
ALTER TABLE `prefix_webviewsecret`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
