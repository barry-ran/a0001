
 
CREATE TABLE IF NOT EXISTS `{DBQZ}_config` (
  `k` varchar(32) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `{DBQZ}_config` (`k`, `v`) VALUES
('kfqq', '1482222908'),
('name', '域名授权管理系统'),
('gg1', '小兔资源网_全网精品资源免费共享平台-NH77.CN'),
('gg2', '小兔资源网_全网精品资源免费共享平台-NH77.CN'),
('auth_ma', '0'),
('file_name_x', ''),
('file_name', ''),
('pay_url', 'https://nh777.top//links/A8C1D64C');</explode>

CREATE TABLE IF NOT EXISTS `{DBQZ}_kms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `km` varchar(30) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;</explode>

CREATE TABLE IF NOT EXISTS `{DBQZ}_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `authorization` varchar(30) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;</explode>

INSERT INTO `{DBQZ}_list` (`id`, `url`, `value`, `authorization`, `date`) VALUES
(1, '127.0.0.1', '本地测试', '0', '2017-03-01 00:00:00'),
(2, 'localhost', '本地测试', 'hb6hJlzg7pWBNg98Rimu2aQPQPePP9', '2017-03-02 19:17:02');</explode>

CREATE TABLE IF NOT EXISTS `{DBQZ}_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `cookie` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;</explode>