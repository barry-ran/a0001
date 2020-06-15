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
<title>系统用户</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript">
function CheckForm(){
	if(document.form.in_adminname.value==""){
		asyncbox.tips("登录帐号不能为空，请填写！", "wait", 1000);
		document.form.in_adminname.focus();
		return false;
        }
        else {
		return true;
        }
}
function del_msg(href) {
	$.layer({
		shade: [0],
		area: [\'auto\', \'auto\'],
		dialog: {
			msg: \'删除操作不可逆，确认继续？\',
			btns: 2,
			type: 4,
			btn: [\'确认\', \'取消\'],
			yes: function() {
				location.href = href;
			},
			no: function() {
				layer.msg(\'已取消删除\', 1, 0);
			}
		}
	});
}
</script>
</head>
<body>
';
switch ($action) {
	case 'add':
		Add();
		break;
	case 'saveadd':
		SaveAdd();
		break;
	case 'edit':
		Edit();
		break;
	case 'saveedit':
		SaveEdit();
		break;
	case 'islock':
		IsLock();
		break;
	case 'del':
		Del();
		break;
	default:
		main();
		break;
}
echo '</body>
</html>
';
function main()
{
	global $db;
	$sql = "select * from " . tname('admin');
	$result = $db->query($sql);
	$count = $db->num_rows($db->query(str_replace('*', 'count(*)', $sql)));
	echo '<div class="container">
<script type="text/javascript">parent.document.title = \'零度分发平台 Board 管理中心 - 系统 - 系统用户\';if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'系统&nbsp;&raquo;&nbsp;系统用户\';</script>
<div class="floattop"><div class="itemtitle"><h3>系统用户</h3><ul class="tab1">
<li class="current"><a href="?iframe=admin"><span>系统用户</span></a></li>
<li><a href="?iframe=admin&action=add"><span>新增用户</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">用户列表</th></tr>
</table>
<table class="tb tb2">
<tr class="header">
<th>编号</th>
<th>帐号</th>
<th>登录时间</th>
<th>登录次数</th>
<th>状态</th>
<th>编辑操作</th>
</tr>
';
	if ($count == 0) {
		echo '<tr><td colspan="2" class="td27">没有系统用户</td></tr>
';
	}
	if ($result) {
		while ($row = $db->fetch_array($result)) {
			echo '<tr class="hover">
<td class="td25">';
			echo $row['in_adminid'];
			echo '</td>
<td><a href="?iframe=admin&action=edit&in_adminid=';
			echo $row['in_adminid'];
			echo '" class="act">';
			echo $row['in_adminname'];
			echo '</a></td>
<td class="lightnum">';
			echo $row['in_logintime'];
			echo '</td>
<td>';
			echo $row['in_loginnum'];
			echo '</td>
<td>';
			if ($row['in_islock'] == 1) {
				echo '<a href="?iframe=admin&action=islock&in_adminid=';
				echo $row['in_adminid'];
				echo '&in_islock=0&hash=';
				echo $_COOKIE['in_adminpassword'];
				echo '"><img src="static/admincp/css/show_no.gif" /></a>';
			} else {
				echo '<a href="?iframe=admin&action=islock&in_adminid=';
				echo $row['in_adminid'];
				echo '&in_islock=1&hash=';
				echo $_COOKIE['in_adminpassword'];
				echo '"><img src="static/admincp/css/show_yes.gif" /></a>';
			}
			echo '</td>
<td><a href="?iframe=admin&action=edit&in_adminid=';
			echo $row['in_adminid'];
			echo '" class="act">编辑</a><a class="act" style="cursor:pointer" onclick="del_msg(\'?iframe=admin&action=del&in_adminid=';
			echo $row['in_adminid'];
			echo '&hash=';
			echo $_COOKIE['in_adminpassword'];
			echo '\');">删除</a></td>
</tr>
';
		}
	}
	echo '</table>
</div>


';
}
function EditBoard($Arr, $url, $arrname)
{
	$in_adminname = $Arr[0];
	$in_islock = $Arr[1];
	$in_permission = $Arr[2];
	echo '<div class="container">
<script type="text/javascript">parent.document.title = \'零度分发平台 Board 管理中心 - 系统 - ';
	echo $arrname;
	echo '用户\';if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'系统&nbsp;&raquo;&nbsp;';
	echo $arrname;
	echo '用户\';</script>
<div class="floattop"><div class="itemtitle"><h3>';
	echo $arrname;
	echo '用户</h3><ul class="tab1">
<li><a href="?iframe=admin"><span>系统用户</span></a></li>
';
	if ($_GET['action'] == "add") {
		echo "<li class=\"current\">";
	} else {
		echo "<li>";
	}
	echo '<a href="?iframe=admin&action=add"><span>新增用户</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<form action="';
	echo $url;
	echo '" method="post" name="form">
<input type="hidden" name="hash" value="';
	echo $_COOKIE['in_adminpassword'];
	echo '" />
<tr><th colspan="15" class="partition">';
	echo $arrname;
	echo '用户</th></tr>
<tr><td colspan="2" class="td27">登录帐号:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="';
	echo $in_adminname;
	echo '" name="in_adminname" id="in_adminname"></td></tr>
<tr><td colspan="2" class="td27">登录密码:</td></tr>
<tr><td class="vtop rowform"><input type="password" class="txt" name="in_adminpassword" id="in_adminpassword"></td><td class="vtop tips2">';
	if ($_GET['action'] == "edit") {
		echo "不修改请留空";
	}
	echo '</td></tr>
<tr><td colspan="2" class="td27">确认密码:</td></tr>
<tr><td class="vtop rowform"><input type="password" class="txt" name="in_adminpassword1" id="in_adminpassword1"></td></tr>
<tr><td colspan="2" class="td27">权限设置:</td></tr>
<tr>
<td class="vtop"><ul>
';
	if (ergodic_array($in_permission, 1)) {
		echo "<li class=\"checked\">";
	} else {
		echo "<li>";
	}
	echo '<input class="checkbox" type="checkbox" name="in_permission[]" id="value1" value="1"';
	if (ergodic_array($in_permission, 1)) {
		echo " checked";
	}
	echo '><label for="value1">首页</label></li>
';
	if (ergodic_array($in_permission, 2)) {
		echo "<li class=\"checked\">";
	} else {
		echo "<li>";
	}
	echo '<input class="checkbox" type="checkbox" name="in_permission[]" id="value2" value="2"';
	if (ergodic_array($in_permission, 2)) {
		echo " checked";
	}
	echo '><label for="value2">全局</label></li>
';
	if (ergodic_array($in_permission, 3)) {
		echo "<li class=\"checked\">";
	} else {
		echo "<li>";
	}
	echo '<input class="checkbox" type="checkbox" name="in_permission[]" id="value3" value="3"';
	if (ergodic_array($in_permission, 3)) {
		echo " checked";
	}
	echo '><label for="value3">应用</label></li>
';
	if (ergodic_array($in_permission, 4)) {
		echo "<li class=\"checked\">";
	} else {
		echo "<li>";
	}
	echo '<input class="checkbox" type="checkbox" name="in_permission[]" id="value4" value="4"';
	if (ergodic_array($in_permission, 4)) {
		echo " checked";
	}
	echo '><label for="value4">用户</label></li>
';
	if (ergodic_array($in_permission, 5)) {
		echo "<li class=\"checked\">";
	} else {
		echo "<li>";
	}
	echo '<input class="checkbox" type="checkbox" name="in_permission[]" id="value5" value="5"';
	if (ergodic_array($in_permission, 5)) {
		echo " checked";
	}
	echo '><label for="value5">工具</label></li>
';
	if (ergodic_array($in_permission, 6)) {
		echo "<li class=\"checked\">";
	} else {
		echo "<li>";
	}
	echo '<input class="checkbox" type="checkbox" name="in_permission[]" id="value6" value="6"';
	if (ergodic_array($in_permission, 6)) {
		echo " checked";
	}
	echo '><label for="value6">系统</label></li>
';
	if (ergodic_array($in_permission, 7)) {
		echo "<li class=\"checked\">";
	} else {
		echo "<li>";
	}
	echo '<input class="checkbox" type="checkbox" name="in_permission[]" id="value7" value="7"';
	if (ergodic_array($in_permission, 7)) {
		echo " checked";
	}
	echo '><label for="value7">云平台</label></li>
</ul></td>
<td class="vtop"><select name="in_islock" class="ps">
<option value="0"';
	if ($in_islock == 0) {
		echo " selected";
	}
	echo '>激活状态</option>
<option value="1"';
	if ($in_islock == 1) {
		echo " selected";
	}
	echo '>锁定状态</option>
</select></td>
</tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" onclick="return CheckForm();" value="提交" /></div></td></tr>
</form>
</table>
</div>



';
}
function SaveEdit()
{
	global $db;
	if (!submitcheck('hash', 1)) {
		ShowMessage("表单来路不明，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
	}
	$in_adminid = intval(SafeRequest("in_adminid", "get"));
	$in_adminname = SafeRequest("in_adminname", "post");
	$in_adminpassword = SafeRequest("in_adminpassword", "post");
	$in_adminpassword1 = SafeRequest("in_adminpassword1", "post");
	$in_islock = SafeRequest("in_islock", "post");
	$in_permission = RequestBox("in_permission");
	if ($in_adminpassword !== $in_adminpassword1) {
		ShowMessage("编辑失败，两次密码填写不一致！", "history.back(1);", "infotitle3", 3000, 2);
	}
	if ($db->getone("select in_adminid from " . tname('admin') . " where in_adminid<>" . $in_adminid . " and in_adminname='" . $in_adminname . "'")) {
		ShowMessage("编辑出错，该帐号已经存在！", "history.back(1);", "infotitle3", 3000, 2);
	}
	if (empty($in_adminpassword1)) {
		$sql = "update " . tname('admin') . " set in_adminname='" . $in_adminname . "',in_permission='" . $in_permission . "',in_islock=" . $in_islock . " where in_adminid=" . $in_adminid;
	} else {
		$sql = "update " . tname('admin') . " set in_adminpassword='" . md5($in_adminpassword) . "',in_adminname='" . $in_adminname . "',in_permission='" . $in_permission . "',in_islock=" . $in_islock . " where in_adminid=" . $in_adminid;
	}
	$db->query($sql);
	ShowMessage("恭喜您，系统用户编辑成功！重新登录后生效！", $_SERVER['HTTP_REFERER'], "infotitle2", 1000, 1);
}
function Edit()
{
	global $db;
	$in_adminid = intval(SafeRequest("in_adminid", "get"));
	$sql = "select * from " . tname('admin') . " where in_adminid=" . $in_adminid;
	if ($row = $db->getrow($sql)) {
		$Arr = array($row['in_adminname'], $row['in_islock'], $row['in_permission']);
	}
	EditBoard($Arr, "?iframe=admin&action=saveedit&in_adminid=" . $in_adminid, "编辑");
}
function Del()
{
	global $db;
	if (!submitcheck('hash', -1)) {
		ShowMessage("链接来路不明，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
	}
	$in_adminid = intval(SafeRequest("in_adminid", "get"));
	if ($in_adminid == 1) {
		ShowMessage("抱歉，默认帐号不允许删除！", "?iframe=admin", "infotitle3", 3000, 1);
	}
	$sql = "delete from " . tname('admin') . " where in_adminid=" . $in_adminid;
	if ($db->query($sql)) {
		ShowMessage("恭喜您，系统用户删除成功！", "?iframe=admin", "infotitle2", 3000, 1);
	}
}
function SaveAdd()
{
	global $db;
	if (!submitcheck('hash', 1)) {
		ShowMessage("表单来路不明，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
	}
	$in_adminname = SafeRequest("in_adminname", "post");
	$in_adminpassword = SafeRequest("in_adminpassword", "post");
	$in_adminpassword1 = SafeRequest("in_adminpassword1", "post");
	$in_islock = SafeRequest("in_islock", "post");
	$in_permission = RequestBox("in_permission");
	if (empty($in_adminpassword) || $in_adminpassword !== $in_adminpassword1) {
		ShowMessage("新增失败，密码为空或两次密码填写不一致！", "history.back(1);", "infotitle3", 3000, 2);
	}
	if ($db->getone("select in_adminid from " . tname('admin') . " where in_adminname='" . $in_adminname . "'")) {
		ShowMessage("新增出错，该帐号已经存在！", "history.back(1);", "infotitle3", 3000, 2);
	} else {
		$sql = "Insert " . tname('admin') . " (in_adminname,in_adminpassword,in_loginnum,in_islock,in_permission) values ('" . $in_adminname . "','" . md5($in_adminpassword1) . "',0," . $in_islock . ",'" . $in_permission . "')";
		if ($db->query($sql)) {
			ShowMessage("恭喜您，系统用户新增成功！", "?iframe=admin", "infotitle2", 1000, 1);
		} else {
			ShowMessage("新增出错，系统用户新增失败！", "?iframe=admin", "infotitle3", 3000, 1);
		}
	}
}
function Add()
{
	$Arr = array("", "", "");
	EditBoard($Arr, "?iframe=admin&action=saveadd", "新增");
}
function IsLock()
{
	global $db;
	if (!submitcheck('hash', -1)) {
		ShowMessage("链接来路不明，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
	}
	$in_adminid = intval(SafeRequest("in_adminid", "get"));
	$in_islock = intval(SafeRequest("in_islock", "get"));
	$sql = "update " . tname('admin') . " set in_islock=" . $in_islock . " where in_adminid=" . $in_adminid;
	if ($db->query($sql)) {
		ShowMessage("恭喜您，状态切换成功！", "?iframe=admin", "infotitle2", 1000, 1);
	}
}