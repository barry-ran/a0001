<?php

//decode by https://www.xiomao.cn/
include 'source/system/config.inc.php';
include 'source/system/function_common.php';
$step = empty($_GET['step']) ? 0 : intval($_GET['step']);
$version = IN_VERSION;
$charset = strtoupper(IN_CHARSET);
$build = IN_BUILD;
$year = date('Y');
$lock = IN_ROOT . './data/install.lock';
if (file_exists($lock)) {
	show_msg('警告！您已经安装过零度分发平台！<br>为了保证数据安全，请立即删除{install.php}文件！<br>如果您想重新安装零度分发平台，请删除{data/install.lock}文件！', 999);
}
$sql = IN_ROOT . './static/install/table.sql';
if (!file_exists($sql)) {
	show_msg('缺少{static/install/table.sql}数据库结构文件，请检查！', 999);
}
$config = IN_ROOT . './source/system/config.inc.php';
if (!@($fp = fopen($config, 'a'))) {
	show_msg('文件{source/system/config.inc.php}读写权限设置错误，请先设置为可写！', 999);
} else {
	@fclose($fp);
}
if (empty($step)) {
	$phpos = PHP_OS;
	$phpversion = PHP_VERSION;
	$attachmentupload = @ini_get('file_uploads') ? '<td class="w pdleft1">' . ini_get('upload_max_filesize') . '</td>' : '<td class="nw pdleft1">unknow</td>';
	if (function_exists('disk_free_space')) {
		$diskspace = '<td class="w pdleft1">' . floor(disk_free_space(IN_ROOT) / 1048576) . 'M</td>';
	} else {
		$diskspace = '<td class="nw pdleft1">unknow</td>';
	}
	$checkok = true;
	$perms = array();
	if (!checkfdperm(IN_ROOT)) {
		$perms['root'] = '<td class="nw pdleft1">不可写</td>';
		$checkok = false;
	} else {
		$perms['root'] = '<td class="w pdleft1">可写</td>';
	}
	if (!checkfdperm(IN_ROOT . './data/')) {
		$perms['data'] = '<td class="nw pdleft1">不可写</td>';
		$checkok = false;
	} else {
		$perms['data'] = '<td class="w pdleft1">可写</td>';
	}
	if (!checkfdperm(IN_ROOT . './source/plugin/')) {
		$perms['plugin'] = '<td class="nw pdleft1">不可写</td>';
		$checkok = false;
	} else {
		$perms['plugin'] = '<td class="w pdleft1">可写</td>';
	}
	if (!checkfdperm(IN_ROOT . './source/system/config.inc.php', 1)) {
		$perms['config'] = '<td class="nw pdleft1">不可写</td>';
		$checkok = false;
	} else {
		$perms['config'] = '<td class="w pdleft1">可写</td>';
	}
	if (is_ssl()) {
		$perms['ssl'] = '<td class="w pdleft1">启用</td>';
	} else {
		$perms['ssl'] = '<td class="nw pdleft1">禁用</td>';
		$checkok = false;
	}
	$check_allow_url_fopen = @ini_get('allow_url_fopen') ? '<td class="w pdleft1">支持</td>' : '<td class="nw pdleft1">不支持</td>';
	$check_pdo_mysql = extension_loaded('pdo_mysql') ? '<td class="w pdleft1">支持</td>' : '<td class="nw pdleft1">不支持</td>';
	show_header();
	print "\t<div class=\"setup step1\">\r\n\t<h2>开始安装</h2>\r\n\t<p>环境以及文件目录权限检查</p>\r\n\t</div>\r\n\t<div class=\"stepstat\">\r\n\t<ul>\r\n\t<li class=\"current\">检查安装环境</li>\r\n\t<li class=\"unactivated\">创建数据库</li>\r\n\t<li class=\"unactivated\">设置后台管理员</li>\r\n\t<li class=\"unactivated last\">安装</li>\r\n\t</ul>\r\n\t<div class=\"stepstatbg stepstat1\"></div>\r\n\t</div>\r\n\t</div>\r\n\t<div class=\"main\">\r\n\t<div class=\"licenseblock\">\r\n\t<div class=\"license\">\r\n\t<h1>产品授权协议 适用于所有用户</h1>\r\n\r\n\t<p>版权所有 (c) 2011-{$year} 零度分发平台保留所有权利。</p>\r\n\r\n\t<p>零度分发平台 是 零度分发平台 推出的一款以PHP语言开发的Web内容管理系统，帮助网站实现一站式服务。</p>\r\n\r\n\t<p>用户须知：本协议是您与零度分发平台之间关于您使用零度分发平台提供的软件产品及服务的法律协议。无论您是个人或组织、盈利与否、用途如何（包括以学习和研究为目的），均需仔细阅读本协议，包括免除或者限制零度分发平台的免责条款及对您的权利限制。请您审阅并接受或不接受本服务条款。如您不同意本服务条款及/或零度分发平台随时对其的修改，您应不使用或主动取消零度分发平台提供的产品。否则，您的任何对零度分发平台产品中的相关服务的注册、登陆、下载、查看等使用行为将被视为您对本服务条款全部的完全接受，包括接受零度分发平台对服务条款随时所做的任何修改。</p>\r\n\r\n\t<p>本服务条款一旦发生变更, 零度分发平台将在网页上公布修改内容。修改后的服务条款一旦在网页上公布即有效代替原来的服务条款。您可随时登陆零度分发平台官方网址查阅最新版服务条款。如果您选择接受本条款，即表示您同意接受协议各项条件的约束。如果您不同意本服务条款，则不能获得使用本服务的权利。您若有违反本条款规定，零度分发平台有权随时中止或终止您对零度分发平台产品的使用资格并保留追究相关法律责任的权利。</p>\r\n\r\n\t<p>在理解、同意、并遵守本协议的全部条款后，方可开始使用零度分发平台产品。您可能与零度分发平台直接签订另一书面协议，以补充或者取代本协议的全部或者任何部分。</p>\r\n\r\n\t<p>零度分发平台拥有本软件的全部知识产权。本软件只供许可协议，并非出售。零度分发平台只允许您在遵守本协议各项条款的情况下复制、下载、安装、使用或者以其他方式受益于本软件的功能或者知识产权。</p>\r\n\r\n\t<h3>I. 协议许可的权利</h3>\r\n\t<ol>\r\n\t&nbsp;  <li>您可以在完全遵守本许可协议的基础上，将本软件应用于非商业用途，而不必支付软件版权许可费用。</li>\r\n\t&nbsp;  <li>您可以在协议规定的约束和限制范围内修改零度分发平台产品源代码(如果被提供的话)或界面风格以适应您的网站要求。</li>\r\n\t&nbsp;  <li>您拥有使用本软件构建的网站中全部会员资料、文章及相关信息的所有权，并独立承担与使用本软件构建的网站内容的审核、注意义务，确保其不侵犯任何人的合法权益，独立承担因使用零度分发平台软件和服务带来的全部责任，若造成零度分发平台或用户损失的，您应予以全部赔偿。</li>\r\n\t&nbsp;  <li>若您需将零度分发平台软件或服务用户商业用途，必须另行获得零度分发平台的书面许可，您在获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持期限、技术支持方式和技术支持内容，自购买时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。</li>\r\n\t&nbsp;  <li>您可以从零度分发平台提供的应用中心服务中下载适合您网站的应用程序，但应向应用程序开发者/所有者支付相应的费用。</li>\r\n\t</ol>\r\n\r\n\t<h3>II. 协议规定的约束和限制</h3>\r\n\t<ol>\r\n\t&nbsp;  <li>未获零度分发平台书面商业授权之前，不得将本软件用于商业用途（包括但不限于企业网站、经营性网站、以营利为目或实现盈利的网站）。购买商业授权请登陆www.零度分发平台.com参考相关说明，也可以发送邮件到web@零度分发平台.com了解详情。</li>\r\n\t&nbsp;  <li>不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。</li>\r\n\t&nbsp;  <li>无论如何，即无论用途如何、是否经过修改或美化、修改程度如何，只要使用零度分发平台产品的整体或任何部分，未经书面许可，页面页脚处的零度分发平台产品名称和零度分发平台下属网站（www.零度分发平台.com、或 www.零度分发平台.net）的链接都必须保留，而不能清除或修改。</li>\r\n\t&nbsp;  <li>禁止在零度分发平台产品的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。</li>\r\n\t&nbsp;  <li>您从应用中心下载的应用程序，未经应用程序开发者/所有者的书面许可，不得对其进行反向工程、反向汇编、反向编译等，不得擅自复制、修改、链接、转载、汇编、发表、出版、发展与之有关的衍生产品、作品等。</li>\r\n\t&nbsp;  <li>如果您未能遵守本协议的条款，您的授权将被终止，所许可的权利将被收回，同时您应承担相应法律责任。</li>\r\n\t</ol>\r\n\r\n\t<h3>III. 有限担保和免责声明</h3>\r\n\t<ol>\r\n\t&nbsp;  <li>本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。</li>\r\n\t&nbsp;  <li>用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。</li>\r\n\t&nbsp;  <li>零度分发平台不对使用本软件构建的网站中的文章或信息承担责任，全部责任由您自行承担。</li>\r\n\t&nbsp;  <li>零度分发平台无法全面监控由第三方上传至应用中心的应用程序，因此不保证应用程序的合法性、安全性、完整性、真实性或品质等；您从应用中心下载应用程序时，同意自行判断并承担所有风险，而不依赖于零度分发平台。但在任何情况下，零度分发平台有权依法停止应用中心服务并采取相应行动，包括但不限于对于相关应用程序进行卸载，暂停服务的全部或部分，保存有关记录，并向有关机关报告。由此对您及第三人可能造成的损失，零度分发平台不承担任何直接、间接或者连带的责任。</li>\r\n\t&nbsp;  <li>零度分发平台对其提供的软件和服务之及时性、安全性、准确性不作担保，由于不可抗力因素、零度分发平台无法控制的因素（包括黑客攻击、停断电等）等造成软件使用和服务中止或终止，而给您造成损失的，您同意放弃追究零度分发平台责任的全部权利。</li>\r\n\t&nbsp;  <li>零度分发平台特别提请您注意，零度分发平台为了保障公司业务发展和调整的自主权，零度分发平台拥有随时经或未经事先通知而修改服务内容、中止或终止部分或全部软件使用和服务的权利，修改会公布于零度分发平台网站相关页面上，一经公布视为通知。 零度分发平台行使修改或中止、终止部分或全部软件使用和服务的权利而造成损失的，零度分发平台不需对您或任何第三方负责。</li>\r\n\t</ol>\r\n\r\n\t<p>有关零度分发平台产品最终用户授权协议、商业授权与技术服务的详细内容，均由零度分发平台独家提供。零度分发平台拥有在不事先通知的情况下，修改授权协议和服务价目表的权利，修改后的协议或价目表对自改变之日起的新授权用户生效。</p>\r\n\r\n\t<p>一旦您开始安装零度分发平台产品，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权利的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。</p>\r\n\r\n\t<p>本许可协议条款的解释，效力及纠纷的解决，适用于中华人民共和国大陆法律。</p>\r\n\r\n\t<p>若您和零度分发平台之间发生任何纠纷或争议，首先应友好协商解决，协商不成的，您在此完全同意将纠纷或争议提交零度分发平台所在地人民法院管辖。零度分发平台拥有对以上各项条款内容的解释权及修改权。</p>\r\n\r\n\t<p>（正文完）</p>\r\n\r\n\t<p align=\"right\">零度分发平台</p>\r\n\t</div>\r\n\t</div>\r\n\t<h2 class=\"title\">环境检查</h2>\r\n\t<table class=\"tb\" style=\"margin:20px 0 20px 55px;\">\r\n\t<tr>\r\n\t<th>项目</th>\r\n\t<th class=\"padleft\">所需配置</th>\r\n\t<th class=\"padleft\">最佳配置</th>\r\n\t<th class=\"padleft\">当前状态</th>\r\n\t</tr>\r\n\t<tr>\r\n\t<td>操作系统</td>\r\n\t<td class=\"padleft\">不限制</td>\r\n\t<td class=\"padleft\">类Unix</td>\r\n\t<td class=\"w pdleft1\">{$phpos}</td>\r\n\t</tr>\r\n\t<tr>\r\n\t<td>PHP 版本</td>\r\n\t<td class=\"padleft\">5.3.x+</td>\r\n\t<td class=\"padleft\">7.0.x+</td>\r\n\t<td class=\"w pdleft1\">{$phpversion}</td>\r\n\t</tr>\r\n\t<tr>\r\n\t<td>附件上传</td>\r\n\t<td class=\"padleft\">允许</td>\r\n\t<td class=\"padleft\">允许</td>\r\n\t{$attachmentupload}\r\n\t</tr>\r\n\t<tr>\r\n\t<td>磁盘空间</td>\r\n\t<td class=\"padleft\">不限制</td>\r\n\t<td class=\"padleft\">不限制</td>\r\n\t{$diskspace}\r\n\t</tr>\r\n\t</table>\r\n\t<h2 class=\"title\">目录、文件权限检查</h2>\r\n\t<table class=\"tb\" style=\"margin:20px 0 20px 55px;width:90%;\">\r\n\t<tr><th>目录文件</th><th class=\"padleft\">所需状态</th><th class=\"padleft\">当前状态</th></tr>\r\n\t<tr><td>./</td><td class=\"w pdleft1\">可写</td>{$perms['root']}</tr>\r\n\t<tr><td>./data/</td><td class=\"w pdleft1\">可写</td>{$perms['data']}</tr>\r\n\t<tr><td>./source/plugin/</td><td class=\"w pdleft1\">可写</td>{$perms['plugin']}</tr>\r\n\t<tr><td>./source/system/config.inc.php</td><td class=\"w pdleft1\">可写</td>{$perms['config']}</tr>\r\n\t</table>\r\n\t<h2 class=\"title\">网络传输协议检查</h2>\r\n\t<table class=\"tb\" style=\"margin:20px 0 20px 55px;width:90%;\">\r\n\t<tr><th>协议名称</th><th class=\"padleft\">所需状态</th><th class=\"padleft\">当前状态</th></tr>\r\n\t<tr><td>HTTPS</td><td class=\"w pdleft1\">启用</td>{$perms['ssl']}</tr>\r\n\t</table>\r\n\t<h2 class=\"title\">扩展、函数依赖性检查</h2>\r\n\t<table class=\"tb\" style=\"margin:20px 0 20px 55px;width:90%;\">\r\n\t<tr>\r\n\t<th>扩展函数</th>\r\n\t<th class=\"padleft\">检查结果</th>\r\n\t<th class=\"padleft\">建议</th>\r\n\t</tr>\r\n\t<tr>\r\n\t<td>allow_url_fopen</td>\r\n\t{$check_allow_url_fopen}\r\n\t<td class=\"padleft\">无</td>\r\n\t</tr>\r\n\t<tr>\r\n\t<td>pdo_mysql</td>\r\n\t{$check_pdo_mysql}\r\n\t<td class=\"padleft\">无</td>\r\n\t</tr>\r\n\t</table>";
	if (!$checkok) {
		echo "<div class=\"btnbox marginbot\"><form method=\"post\" action=\"install.php?step=1\"><input type=\"submit\" value=\"强制继续\"><input type=\"button\" value=\"关闭\" onclick=\"windowclose();\"></form></div>";
	} else {
		print "\t\t<div class=\"btnbox marginbot\">\r\n\t\t<form method=\"post\" action=\"install.php?step=1\">\r\n\t\t<input type=\"submit\" value=\"同意并安装\">\r\n\t\t<input type=\"button\" value=\"不同意\" onclick=\"windowclose();\">\r\n\t\t</form>\r\n\t\t</div>";
	}
	show_footer();
} elseif ($step == 1) {
	show_header();
	print "\t<div class=\"setup step2\">\r\n\t<h2>安装数据库</h2>\r\n\t<p>正在执行数据库安装</p>\r\n\t</div>\r\n\t<div class=\"stepstat\">\r\n\t<ul>\r\n\t<li class=\"unactivated\">检查安装环境</li>\r\n\t<li class=\"current\">创建数据库</li>\r\n\t<li class=\"unactivated\">设置后台管理员</li>\r\n\t<li class=\"unactivated last\">安装</li>\r\n\t</ul>\r\n\t<div class=\"stepstatbg stepstat1\"></div>\r\n\t</div>\r\n\t</div>\r\n\t<div class=\"main\">\r\n\t<form name=\"themysql\" method=\"post\" action=\"install.php?step=2\">\r\n\t<div class=\"desc\"><b>填写数据库信息</b></div>\r\n\t<table class=\"tb2\">\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;数据库主机:</th>\r\n\t<td><input type=\"text\" name=\"dbhost\" value=\"127.0.0.1\" size=\"35\" class=\"txt\"></td>\r\n\t<td>数据库服务器地址，一般为 localhost</td>\r\n\t</tr>\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;数据库名称:</th>\r\n\t<td><input type=\"text\" name=\"dbname\" value=\"test\" size=\"35\" class=\"txt\"></td>\r\n\t<td>如果不存在，则会尝试自动创建</td>\r\n\t</tr>\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;数据库用户名:</th>\r\n\t<td><input type=\"text\" name=\"dbuser\" value=\"root\" size=\"35\" class=\"txt\"></td>\r\n\t<td></td>\r\n\t</tr>\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;数据库密码:</th>\r\n\t<td><input type=\"password\" name=\"dbpw\" value=\"\" size=\"35\" class=\"txt\"></td>\r\n\t<td></td>\r\n\t</tr>\r\n\t</table>\r\n\t<div class=\"desc\"><b>其它可选设置项</b></div>\r\n\t<table class=\"tb2\">\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;数据库表前缀:</th>\r\n\t<td><input type=\"text\" name=\"dbtablepre\" value=\"prefix_\" size=\"35\" class=\"txt\"></td>\r\n\t<td>不能为空，默认为prefix_</td>\r\n\t</tr>\r\n\t</table>\r\n\t<table class=\"tb2\">\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;</th>\r\n\t<td><input type=\"submit\" name=\"submitmysql\" value=\"创建数据库\" onclick=\"return checkmysql();\" class=\"btn\"></td>\r\n\t<td></td>\r\n\t</tr>\r\n\t</table>\r\n\t</form>";
	show_footer();
} elseif ($step == 2) {
	if (!submitcheck('submitmysql')) {
		show_msg('表单验证不符，无法提交！', 999);
	}
	$path = $_SERVER['PHP_SELF'];
	$path = str_replace('install.php', '', strtolower($path));
	$host = SafeRequest("dbhost", "post");
	$name = SafeRequest("dbname", "post");
	$user = SafeRequest("dbuser", "post");
	$pw = SafeRequest("dbpw", "post");
	$tablepre = SafeRequest("dbtablepre", "post");
	$db = install_db_connect($host, $user, $pw);
	$config = file_get_contents("source/system/config.inc.php");
	$config = preg_replace("/'IN_DBHOST', '(.*?)'/", "'IN_DBHOST', '" . $host . "'", $config);
	$config = preg_replace("/'IN_DBNAME', '(.*?)'/", "'IN_DBNAME', '" . $name . "'", $config);
	$config = preg_replace("/'IN_DBUSER', '(.*?)'/", "'IN_DBUSER', '" . $user . "'", $config);
	$config = preg_replace("/'IN_DBPW', '(.*?)'/", "'IN_DBPW', '" . $pw . "'", $config);
	$config = preg_replace("/'IN_DBTABLE', '(.*?)'/", "'IN_DBTABLE', '" . $tablepre . "'", $config);
	$config = preg_replace("/'IN_PATH', '(.*?)'/", "'IN_PATH', '" . $path . "'", $config);
	$ifile = new iFile('source/system/config.inc.php', 'w');
	$ifile->WriteFile($config, 3);
	$havedata = false;
	if (install_db_name($name, $db)) {
		$db = install_db_connect($host, $user, $pw, $name);
		if (install_db_query('SELECT COUNT(*) FROM ' . $tablepre . 'admin', $db, 1)) {
			$havedata = true;
		}
	} elseif (!install_db_query("CREATE DATABASE `{$name}`", $db)) {
		show_msg('设定的数据库无权限操作，请先手工新建后，再执行安装程序！');
	}
	if ($havedata) {
		show_msg('危险！指定的数据库已有数据，如果继续将会清空原有数据！', $step + 1);
	} else {
		show_msg('数据库信息配置成功，即将开始安装数据...', $step + 1, 1);
	}
} elseif ($step == 3) {
	$db = install_db_connect(IN_DBHOST, IN_DBUSER, IN_DBPW, IN_DBNAME, 999);
	install_db_name(IN_DBNAME, $db) or show_msg('数据库连接异常，无法执行！', 999);
	install_db_set(IN_DBCHARSET, $db);
	$table = file_get_contents("static/install/table.sql");
	$table = str_replace(array('prefix_', '{charset}'), array(IN_DBTABLE, IN_DBCHARSET), $table);
	$tablearr = explode(";", $table);
	$sqlarr = explode("{jie}{gou}*/", $table);
	$str = "<p>正在安装数据...</p>{replace}";
	for ($i = 0; $i < count($tablearr) - 1; $i++) {
		install_db_query($tablearr[$i], $db);
	}
	for ($i = 0; $i < count($sqlarr) - 1; $i++) {
		$strsql = explode("/*{shu}{ju}", $sqlarr[$i]);
		$str .= $strsql[1];
	}
	$str = str_replace(array('{biao} `', '` {de}'), array('<p>建立数据表 ', ' ... 成功</p>{replace}'), $str);
	show_header();
	print "\t<div class=\"setup step2\">\r\n\t<h2>安装数据库</h2>\r\n\t<p>正在执行数据库安装</p>\r\n\t</div>\r\n\t<div class=\"stepstat\">\r\n\t<ul>\r\n\t<li class=\"unactivated\">检查安装环境</li>\r\n\t<li class=\"current\">创建数据库</li>\r\n\t<li class=\"unactivated\">设置后台管理员</li>\r\n\t<li class=\"unactivated last\">安装</li>\r\n\t</ul>\r\n\t<div class=\"stepstatbg stepstat1\"></div>\r\n\t</div>\r\n\t</div>\r\n\t<div class=\"main\">\r\n\t<div class=\"notice\" id=\"log\">\r\n\t<div class=\"license\" id=\"loginner\">\r\n\t</div>\r\n\t</div>\r\n\t<div class=\"btnbox margintop marginbot\">\r\n\t<input type=\"button\" value=\"正在安装...\" disabled=\"disabled\">\r\n\t</div>\r\n\t<script type=\"text/javascript\">\r\n\tvar log = \"{$str}\";\r\n\tvar n = 0;\r\n\tvar timer = 0;\r\n\tlog = log.split('{replace}');\r\n\tfunction GoPlay() {\r\n\t\tif (n > log.length-1) {\r\n\t\t        n=-1;\r\n\t\t        clearIntervals();\r\n\t\t}\r\n\t\tif (n > -1) {\r\n\t\t        postcheck(n);\r\n\t\t        n++;\r\n\t\t}\r\n\t}\r\n\tfunction postcheck(n) {\r\n\t\tdocument.getElementById('loginner').innerHTML += log[n];\r\n\t\tdocument.getElementById('log').scrollTop = document.getElementById('log').scrollHeight;\r\n\t}\r\n\tfunction setIntervals() {\r\n\t\ttimer = setInterval('GoPlay()', 100);\r\n\t}\r\n\tfunction clearIntervals() {\r\n\t\tclearInterval(timer);\r\n\t\tlocation.href = \"install.php?step=4\";\r\n\t}\r\n\tsetTimeout(setIntervals, 25);\r\n\t</script>";
	show_footer();
} elseif ($step == 4) {
	show_header();
	print "\t<div class=\"setup step3\">\r\n\t<h2>创建管理员</h2>\r\n\t<p>正在设置后台管理帐号</p>\r\n\t</div>\r\n\t<div class=\"stepstat\">\r\n\t<ul>\r\n\t<li class=\"unactivated\">检查安装环境</li>\r\n\t<li class=\"unactivated\">创建数据库</li>\r\n\t<li class=\"current\">设置后台管理员</li>\r\n\t<li class=\"unactivated last\">安装</li>\r\n\t</ul>\r\n\t<div class=\"stepstatbg stepstat1\"></div>\r\n\t</div>\r\n\t</div>\r\n\t<div class=\"main\">\r\n\t<form name=\"theuser\" method=\"post\" action=\"install.php?step=5\">\r\n\t<div class=\"desc\"><b>填写管理员信息</b></div>\r\n\t<table class=\"tb2\">\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;管理员帐号:</th>\r\n\t<td><input type=\"text\" name=\"uname\" value=\"\" size=\"35\" class=\"txt\"></td>\r\n\t<td>仅限邮箱格式</td>\r\n\t</tr>\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;管理员密码:</th>\r\n\t<td><input type=\"password\" name=\"upw\" value=\"\" size=\"35\" class=\"txt\"></td>\r\n\t<td>密码设置越复杂，安全级别越高</td>\r\n\t</tr>\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;重复密码:</th>\r\n\t<td><input type=\"password\" name=\"upw1\" value=\"\" size=\"35\" class=\"txt\"></td>\r\n\t<td></td>\r\n\t</tr>\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;认证码:</th>\r\n\t<td><input type=\"text\" name=\"ucode\" value=\"\" size=\"35\" class=\"txt\"></td>\r\n\t<td>设置后，可以在后台选择开启或关闭</td>\r\n\t</tr>\r\n\t</table>\r\n\t<table class=\"tb2\">\r\n\t<tr><th class=\"tbopt\" align=\"left\">&nbsp;</th>\r\n\t<td><input type=\"submit\" name=\"submituser\" value=\"创建管理员\" onclick=\"return checkuser();\" class=\"btn\"></td>\r\n\t<td></td>\r\n\t</tr>\r\n\t</table>\r\n\t</form>";
	show_footer();
} elseif ($step == 5) {
	if (!submitcheck('submituser')) {
		show_msg('表单验证不符，无法提交！', 999);
	}
	$db = install_db_connect(IN_DBHOST, IN_DBUSER, IN_DBPW, IN_DBNAME, 999);
	install_db_name(IN_DBNAME, $db) or show_msg('数据库连接异常，无法执行！', 999);
	install_db_set(IN_DBCHARSET, $db);
	$name = SafeRequest("uname", "post");
	$pw = SafeRequest("upw", "post");
	$pw1 = SafeRequest("upw1", "post");
	$code = SafeRequest("ucode", "post");
	$str = file_get_contents("source/system/config.inc.php");
	$str = preg_replace("/'IN_CODE', '(.*?)'/", "'IN_CODE', '" . $code . "'", $str);
	$ifile = new iFile('source/system/config.inc.php', 'w');
	$ifile->WriteFile($str, 3);
	$sql = "insert into `" . tname('admin') . "` (in_adminname,in_adminpassword,in_loginnum,in_islock,in_permission) values ('" . $name . "','" . md5($pw1) . "','0','0','1,2,3,4,5,6,7')";
	$sqls = "insert into `" . tname('user') . "` (in_username,in_userpassword,in_regdate,in_logintime,in_verify,in_islock,in_points,in_spaceuse,in_spacetotal) values ('" . $name . "','" . substr(md5($pw1), 8, 16) . "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "','0','0','" . IN_LOGINPOINTS . "','0','" . IN_REGSPACE * 1048576 . "')";
	$sql1 = "insert into `" . tname('plugin') . "` (in_name,in_dir,in_file,in_type,in_author,in_address,in_addtime) values ('阿里云存储[分发]','App-oss','upload','0','零度分发平台','http://www.零度分发平台.com/','" . date('Y-m-d H:i:s') . "')";
	$sql2 = "insert into `" . tname('plugin') . "` (in_name,in_dir,in_file,in_type,in_author,in_address,in_addtime) values ('七牛云存储[分发]','App-qiniu','upload','0','零度分发平台','http://www.零度分发平台.com/','" . date('Y-m-d H:i:s') . "')";
	if (install_db_query($sql, $db) && install_db_query($sqls, $db) && install_db_query($sql1, $db) && install_db_query($sql2, $db)) {
		fwrite(fopen('data/install.lock', 'wb+'), time());
		show_msg('恭喜！零度分发平台 顺利安装完成！<br>为了保证数据安全，请手动删除{static/install}目录！<br><br>您的后台管理员帐号与前台会员帐号已经成功建立。接下来，您可以：<br><br><a href="index.php" target="_blank">进入网站首页</a><br>或 <a href="admin.php" target="_blank">进入管理后台</a> 以管理员身份对站点参数进行设置！', 999);
	} else {
		show_msg(install_db_error($db), 999);
	}
}
function show_header()
{
	global $version, $charset, $build;
	print "\t<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n\t<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n\t<head>\r\n\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset={$charset}\" />\r\n\t<title>零度分发平台 安装向导</title>\r\n\t<link rel=\"stylesheet\" href=\"./static/install/images/style.css\" type=\"text/css\" media=\"all\" />\r\n\t<link href=\"./static/pack/asynctips/asynctips.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n\t<script type=\"text/javascript\" src=\"./static/pack/asynctips/jquery.min.js\"></script>\r\n\t<script type=\"text/javascript\" src=\"./static/pack/asynctips/asyncbox.v1.4.5.js\"></script>\r\n\t<script type=\"text/javascript\">\r\n\tfunction isEmail(input) {\r\n        \tif (input.match(/^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+\$/)) {\r\n        \t\treturn true;\r\n        \t}\r\n        \treturn false;\r\n\t}\r\n\tfunction windowclose() {\r\n        \tvar browserName = navigator.appName;\r\n        \tif (browserName==\"Microsoft Internet Explorer\") {\r\n        \t\twindow.opener = \"whocares\";\r\n        \t\twindow.opener = null;\r\n        \t\twindow.open('', '_top');\r\n        \t\twindow.close();\r\n        \t} else if (browserName==\"Netscape\") {\r\n        \t\twindow.open('', '_self', '');\r\n        \t\twindow.close();\r\n        \t}\r\n\t}\r\n\tfunction checkmysql() {\r\n        \tif (this.themysql.dbhost.value==\"\") {\r\n        \t\tasyncbox.tips(\"数据库主机不能为空，请填写！\", \"wait\", 1000);\r\n        \t\tthis.themysql.dbhost.focus();\r\n        \t\treturn false;\r\n        \t} else if (this.themysql.dbname.value==\"\") {\r\n        \t\tasyncbox.tips(\"数据库名称不能为空，请填写！\", \"wait\", 1000);\r\n        \t\tthis.themysql.dbname.focus();\r\n        \t\treturn false;\r\n        \t} else if (this.themysql.dbuser.value==\"\") {\r\n        \t\tasyncbox.tips(\"数据库用户名不能为空，请填写！\", \"wait\", 1000);\r\n        \t\tthis.themysql.dbuser.focus();\r\n        \t\treturn false;\r\n        \t} else if (this.themysql.dbpw.value==\"\") {\r\n        \t\tasyncbox.tips(\"数据库密码不能为空，请填写！\", \"wait\", 1000);\r\n        \t\tthis.themysql.dbpw.focus();\r\n        \t\treturn false;\r\n        \t} else if (this.themysql.dbtablepre.value==\"\") {\r\n        \t\tasyncbox.tips(\"数据库表前缀不能为空，请填写！\", \"wait\", 1000);\r\n        \t\tthis.themysql.dbtablepre.focus();\r\n        \t\treturn false;\r\n        \t} else {\r\n        \t\treturn true;\r\n        \t}\r\n\t}\r\n\tfunction checkuser() {\r\n        \tif (this.theuser.uname.value==\"\") {\r\n        \t\tasyncbox.tips(\"管理员帐号不能为空，请填写！\", \"wait\", 1000);\r\n        \t\tthis.theuser.uname.focus();\r\n        \t\treturn false;\r\n        \t} else if (isEmail(this.theuser.uname.value)==false) {\r\n        \t\tasyncbox.tips(\"管理员帐号格式有误，请更改！\", \"error\", 1000);\r\n        \t\tthis.theuser.uname.focus();\r\n        \t\treturn false;\r\n        \t} else if (this.theuser.upw.value==\"\") {\r\n        \t\tasyncbox.tips(\"管理员密码不能为空，请填写！\", \"wait\", 1000);\r\n        \t\tthis.theuser.upw.focus();\r\n        \t\treturn false;\r\n        \t} else if (this.theuser.upw1.value==\"\") {\r\n        \t\tasyncbox.tips(\"重复密码不能为空，请填写！\", \"wait\", 1000);\r\n        \t\tthis.theuser.upw1.focus();\r\n        \t\treturn false;\r\n        \t} else if (this.theuser.upw1.value!==this.theuser.upw.value) {\r\n        \t\tasyncbox.tips(\"两次输入密码不一致，请更改！\", \"error\", 1000);\r\n        \t\tthis.theuser.upw1.focus();\r\n        \t\treturn false;\r\n        \t} else if (this.theuser.ucode.value==\"\") {\r\n        \t\tasyncbox.tips(\"认证码不能为空，请填写！\", \"wait\", 1000);\r\n        \t\tthis.theuser.ucode.focus();\r\n        \t\treturn false;\r\n        \t} else {\r\n        \t\treturn true;\r\n        \t}\r\n\t}\r\n\t</script>\r\n\t</head>\r\n\t<body>\r\n\t<div class=\"container\">\r\n\t<div class=\"header\">\r\n\t<h1>零度分发平台 安装向导</h1>\r\n\t<span>零度分发平台 {$version} 简体中文{$charset} {$build}</span>";
}
function show_footer()
{
	global $year;
	print "\t<div class=\"footer\">&copy;2011 - {$year} <a href=\"http://www.零度分发平台.com/\" target=\"_blank\">零度分发平台</a> Inc.</div>\r\n\t</div>\r\n\t</div>\r\n\t</body>\r\n\t</html>";
}
function show_msg($message, $next = 0, $jump = 0)
{
	$nextstr = '';
	$backstr = '';
	if (empty($next)) {
		$backstr .= "<a href=\"install.php?step=1\">返回上一步</a>";
	} elseif ($next < 999) {
		$url_forward = "install.php?step={$next}";
		if (empty($jump)) {
			$nextstr .= "<a href=\"{$url_forward}\">继续下一步</a>";
			$backstr .= "<a href=\"install.php?step=1\">返回上一步</a>";
		} else {
			$nextstr .= "<a href=\"{$url_forward}\">请稍等...</a><script type=\"text/javascript\">setTimeout(\"location.href='{$url_forward}';\", 1000);</script>";
		}
	}
	show_header();
	print "\t<div class=\"setup\">\r\n\t<h2>安装提示</h2>\r\n\t</div>\r\n\t<div class=\"stepstat\">\r\n\t<ul>\r\n\t<li class=\"unactivated\">检查安装环境</li>\r\n\t<li class=\"unactivated\">创建数据库</li>\r\n\t<li class=\"unactivated\">设置后台管理员</li>\r\n\t<li class=\"current last\">安装</li>\r\n\t</ul>\r\n\t<div class=\"stepstatbg\"></div>\r\n\t</div>\r\n\t</div>\r\n\t<div class=\"main\">\r\n\t<div class=\"desc\" align=\"center\"><b>提示信息</b></div>\r\n\t<table class=\"tb2\">\r\n\t<tr><td class=\"desc\" align=\"center\">{$message}</td>\r\n\t</tr>\r\n\t</table>\r\n\t<div class=\"btnbox marginbot\">{$backstr} {$nextstr}</div>";
	show_footer();
	exit;
}
function checkfdperm($path, $isfile = 0)
{
	if ($isfile) {
		$file = $path;
		$mod = 'a';
	} else {
		$file = $path . './install_tmptest.data';
		$mod = 'w';
	}
	if (!@($fp = fopen($file, $mod))) {
		return false;
	}
	if (!$isfile) {
		fwrite($fp, ' ');
		fclose($fp);
		if (!@unlink($file)) {
			return false;
		}
		if (is_dir($path . './install_tmpdir')) {
			if (!@rmdir($path . './install_tmpdir')) {
				return false;
			}
		}
		if (!@mkdir($path . './install_tmpdir')) {
			return false;
		}
		if (!@rmdir($path . './install_tmpdir')) {
			return false;
		}
	} else {
		fclose($fp);
	}
	return true;
}
function install_db_connect($dbhost, $dbuser, $dbpw, $dbname = '', $next = 0)
{
	if (extension_loaded('pdo_mysql')) {
		try {
			$connect = empty($dbname) ? "mysql:host={$dbhost}" : "mysql:host={$dbhost};dbname={$dbname}";
			return new PDO($connect, $dbuser, $dbpw);
		} catch (PDOException $e) {
			show_msg($e->getMessage(), $next);
		}
	} else {
		return @mysql_connect($dbhost, $dbuser, $dbpw) or show_msg(mysql_error(), $next);
	}
}
function install_db_name($dbname, $handle)
{
	if (extension_loaded('pdo_mysql')) {
		return $handle->query("SHOW TABLES FROM {$dbname}");
	} else {
		return @mysql_select_db($dbname);
	}
}
function install_db_set($charset, $handle)
{
	if (extension_loaded('pdo_mysql')) {
		return $handle->exec("SET NAMES {$charset}");
	} else {
		return mysql_query("SET NAMES {$charset}");
	}
}
function install_db_query($sql, $handle, $type = 0)
{
	if (extension_loaded('pdo_mysql')) {
		if ($type) {
			return $handle->query($sql);
		} else {
			return $handle->exec($sql);
		}
	} else {
		return mysql_query($sql);
	}
}
function install_db_error($handle)
{
	if (extension_loaded('pdo_mysql')) {
		$info = $handle->errorInfo();
		return $info[2];
	} else {
		return mysql_error();
	}
}