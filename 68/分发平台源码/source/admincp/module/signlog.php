<?php

//decode by 精品资源分享网www.xiomao.cn
if (!defined('IN_ROOT')) {
	exit('Access denied');
}
Administrator(6);
$action = SafeRequest("action", "get");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';
echo IN_CHARSET;
echo '" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>签名记录</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript">
function s(){
        var k=document.getElementById("search").value;
        if(k==""){
                asyncbox.tips("请输入要查询的关键词！", "wait", 1000);
                document.getElementById("search").focus();
                return false;
        }else{
                document.btnsearch.submit();
        }
}
</script>
</head>
<body>
';
switch ($action) {
	case 'keyword':
		$key = SafeRequest("key", "get");
		$sql = "select * from " . tname('signlog') . " where in_aname like '%" . $key . "%' or in_uname like '%" . $key . "%' order by in_addtime desc";
		main($sql, 20);
		break;
	default:
		$status = SafeRequest("status", "get");
		if (is_numeric($status)) {
			$sql = "select * from " . tname('signlog') . " where in_status={$status} order by in_addtime desc";
		} else {
			$sql = "select * from " . tname('signlog') . " order by in_addtime desc";
		}
		main($sql, 20);
		break;
}
echo '</body>
</html>
';
function main($sql, $size)
{
	global $db;
	$Arr = getpagerow($sql, $size);
	$result = $Arr[1];
	$count = $Arr[2];
	echo '<div class="container">
<script type="text/javascript">parent.document.title = \'零度分发平台 Board 管理中心 - 系统 - 签名记录\';if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'系统&nbsp;&raquo;&nbsp;签名记录\';</script>
<div class="floattop"><div class="itemtitle"><h3>签名记录</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">技巧提示</th></tr>
<tr><td class="tipsblock"><ul>
<li>可以输入应用名称、所属会员等关键词进行搜索</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="';
	echo $_SERVER['PHP_SELF'];
	echo '">
<tr><td>
<input type="hidden" name="iframe" value="signlog">
<input type="hidden" name="action" value="keyword">
关键词：<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=signlog">不限状态</option>
<option value="?iframe=signlog&status=1"';
	if (isset($_GET['status']) && $_GET['status'] == 1) {
		echo " selected";
	}
	echo '>正在签名</option>
<option value="?iframe=signlog&status=2"';
	if (isset($_GET['status']) && $_GET['status'] == 2) {
		echo " selected";
	}
	echo '>签名完成</option>
</select>
<input type="button" value="搜索" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<table class="tb tb2">
<tr class="header">
<th>编号</th>
<th>应用名称</th>
<th>所属会员</th>
<th>签名状态</th>
<th>签名证书</th>
<th>签名时间</th>
</tr>
';
	if ($count == 0) {
		echo '<tr><td colspan="2" class="td27">没有签名记录</td></tr>
';
	} else {
		while ($row = $db->fetch_array($result)) {
			echo '<tr class="hover">
<td>';
			echo $row['in_id'];
			echo '</td>
<td><a href="';
			echo getlink($row['in_aid']);
			echo '" target="_blank" class="act">';
			echo str_replace(SafeRequest("key", "get"), '<em class="lightnum">' . SafeRequest("key", "get") . '</em>', $row['in_aname']);
			echo '</a></td>
<td><a href="?iframe=signlog&action=keyword&key=';
			echo $row['in_uname'];
			echo '" class="act">';
			echo str_replace(SafeRequest("key", "get"), '<em class="lightnum">' . SafeRequest("key", "get") . '</em>', $row['in_uname']);
			echo '</a></td>
<td>';
			echo $row['in_status'] > 1 ? '签名完成' : '<em class="lightnum">正在签名</em>';
			echo '</td>
<td>';
			echo $row['in_cert'];
			echo '</td>
<td>';
			if (date('Y-m-d', strtotime($row['in_addtime'])) == date('Y-m-d')) {
				echo '<em class="lightnum">' . $row['in_addtime'] . '</em>';
			} else {
				echo $row['in_addtime'];
			}
			echo '</td>
</tr>
';
		}
	}
	echo '</table>
<table class="tb tb2">
';
	echo $Arr[0];
	echo '</table>
</div>
';
}