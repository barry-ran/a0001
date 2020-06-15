<?php

//decode by 精品资源分享网www.xiomao.cn
if (!defined('IN_ROOT')) {
	exit('Access denied');
}
Administrator(3);
$action = SafeRequest("action", "get");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';
echo IN_CHARSET;
echo '" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>应用管理</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
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
	case 'alldel':
		AllDel();
		break;
	case 'keyword':
		$key = SafeRequest("key", "get");
		if (is_numeric($key)) {
			$sql = "select * from " . tname('app') . " where in_id={$key} order by in_addtime desc";
		} else {
			$sql = "select * from " . tname('app') . " where in_name like '%" . $key . "%' or in_uname like '%" . $key . "%' order by in_addtime desc";
		}
		main($sql, 20);
		break;
	default:
		$form = SafeRequest("form", "get");
		if (empty($form)) {
			$sql = "select * from " . tname('app') . " order by in_addtime desc";
		} else {
			$sql = "select * from " . tname('app') . " where in_form='" . $form . "' order by in_addtime desc";
		}
		main($sql, 20);
		break;
}
echo '</body>
</html>
';
function EditBoard($Arr, $url, $arrname)
{
	global $db, $action;
	$one = $db->getone("select in_userid from " . tname('user') . " where in_username='" . $_COOKIE['in_adminname'] . "'");
	$in_name = $Arr[0];
	$in_uname = empty($Arr[1]) && $one ? $_COOKIE['in_adminname'] : $Arr[1];
	$in_type = intval($Arr[2]);
	$in_mnvs = $Arr[3];
	$in_form = $Arr[4];
	$in_size = intval($Arr[5]);
	$in_bid = $Arr[6];
	$in_bsvs = $Arr[7];
	$in_bvs = $Arr[8];
	$in_nick = $Arr[9];
	$in_team = $Arr[10];
	$in_icon = $Arr[11];
	$in_app = $Arr[12];
	$in_kid = intval($Arr[13]);
	$signid = $db->getone("select in_id from " . tname('signlog') . " where in_status=1 and in_aid=" . intval($Arr[14]));
	echo '<script type="text/javascript">
var pop = {
	up: function(scrolling, text, url, width, height, top) {
		layer.open({
			type: 2,
			maxmin: true,
			title: text,
			content: [url, scrolling],
			area: [width, height],
			offset: top,
			shade: false
		});
	}
}
function CheckForm(){
        if(document.form2.in_name.value==""){
            asyncbox.tips("应用名称不能为空，请填写！", "wait", 1000);
            document.form2.in_name.focus();
            return false;
        }
        else if(document.form2.in_uname.value==""){
            asyncbox.tips("所属会员不能为空，请填写！", "wait", 1000);
            document.form2.in_uname.focus();
            return false;
        }
        else if(document.form2.in_app.value==""){
            asyncbox.tips("应用文件不能为空，请填写！", "wait", 1000);
            document.form2.in_app.focus();
            return false;
        }
        else {
            return true;
        }
}
</script>
<div class="container">
<script type="text/javascript">parent.document.title = \'零度分发平台 Board 管理中心 - 应用 - ';
	echo $arrname;
	echo '应用\';if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'应用&nbsp;&raquo;&nbsp;';
	echo $arrname;
	echo '应用\';</script>
<div class="floattop"><div class="itemtitle"><h3>';
	echo $arrname;
	echo '应用</h3><ul class="tab1">
<li><a href="?iframe=app"><span>所有应用</span></a></li>
';
	if ($action == "add") {
		echo "<li class=\"current\">";
	} else {
		echo "<li>";
	}
	echo '<a href="?iframe=app&action=add"><span>新增应用</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<form action="';
	echo $url;
	echo '" method="post" name="form2">
<table class="tb tb2">
<tr><td class="td29">应用名称：<input type="text" class="txt" value="';
	echo $in_name;
	echo '" name="in_name" id="in_name"></td><td class="td29">所属会员：<input type="text" class="txt" value="';
	echo $in_uname;
	echo '" name="in_uname" id="in_uname"></td></tr>
<tr>
<td>版本类型：<select name="in_type" id="in_type">
<option value="0">内测版</option>
<option value="1"';
	if ($in_type == 1) {
		echo " selected";
	}
	echo '>企业版</option>
</select></td>
<td class="td29">版本兼容：<input type="text" class="txt" value="';
	echo $in_mnvs;
	echo '" name="in_mnvs" id="in_mnvs"></td>
</tr>
<tr><td class="td29">应用平台：<input type="text" class="txt" value="';
	echo $in_form;
	echo '" name="in_form" id="in_form"></td><td class="td29">应用大小：<input type="text" class="txt" value="';
	echo $in_size;
	echo '" name="in_size" id="in_size" readonly></td></tr>
<tr><td class="td29">应用标识：<input type="text" class="txt" value="';
	echo $in_bid;
	echo '" name="in_bid" id="in_bid"></td><td class="td29">应用关联：<input type="text" class="txt" value="';
	echo $in_kid;
	echo '" name="in_kid" id="in_kid" onkeyup="this.value=this.value.replace(/[^\\d]/g,\'\')" onbeforepaste="clipboardData.setData(\'text\',clipboardData.getData(\'text\').replace(/[^\\d]/g,\'\'))"></td></tr>
<tr><td class="longtxt">精简版本：<input type="text" class="txt" value="';
	echo $in_bsvs;
	echo '" name="in_bsvs" id="in_bsvs"></td></tr>
<tr><td class="longtxt">详细版本：<input type="text" class="txt" value="';
	echo $in_bvs;
	echo '" name="in_bvs" id="in_bvs"></td></tr>
<tr><td class="longtxt">公司名称：<input type="text" class="txt" value="';
	echo $in_nick;
	echo '" name="in_nick" id="in_nick"></td></tr>
<tr><td class="longtxt">集团信息：<input type="text" class="txt" value="';
	echo $in_team;
	echo '" name="in_team" id="in_team"></td></tr>
<tr><td class="longtxt">图标文件：<input type="text" class="txt" value="';
	echo $in_icon;
	echo '" name="in_icon" id="in_icon"></td>';
	if ($Arr[14]) {
		echo '<td><div class="rssbutton"><input type="button" value="上传图标" onclick="pop.up(\'no\', \'上传图标\', \'source/pack/upload/admin-open-icon.php?id=';
		echo $Arr[14];
		echo '\', \'406px\', \'180px\', \'175px\');" /></div></td>';
	}
	echo '</tr>
<tr><td class="longtxt diffcolor3">应用文件：<input type="text" class="txt" value="';
	echo $in_app;
	echo '" name="in_app" id="in_app"></td><td><div class="rssbutton"><input type="button" value="上传应用" onclick="pop.up(\'no\', \'上传应用\', \'source/pack/upload/admin-open.php\', \'406px\', \'180px\', \'175px\');" /></div></td></tr>
<tr><td><input type="submit" class="btn" name="form2" id="btnsave" value="提交" onclick="return CheckForm();" />';
	if ($signid) {
		echo '<input class="checkbox" type="checkbox" id="signid" name="signid" value="';
		echo $signid;
		echo '" checked /><label for="signid">重置签名</label>';
	}
	echo '</td></tr>
</table>
</form>
</div>


';
}
function main($sql, $size)
{
	global $db, $action;
	$Arr = getpagerow($sql, $size);
	$result = $Arr[1];
	$count = $Arr[2];
	echo '<link href="static/pack/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/fancybox/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="static/pack/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
function CheckAll(form) {
	for (var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name != \'chkall\') {
			e.checked = form.chkall.checked;
		}
	}
        all_save(form);
}
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
function all_save(form){
        if(form.chkall.checked){
		layer.tips(\'删除应用不可逆，请谨慎操作！\', \'#chkall\', {
			tips: 3
		});
        }
}
</script>
<div class="container">
';
	if (empty($action)) {
		echo "<script type=\"text/javascript\">parent.document.title = '零度分发平台 Board 管理中心 - 应用 - 所有应用';if(parent.\$('admincpnav')) parent.\$('admincpnav').innerHTML='应用&nbsp;&raquo;&nbsp;所有应用';</script>";
	}
	echo '';
	if ($action == "keyword") {
		echo "<script type=\"text/javascript\">parent.document.title = '零度分发平台 Board 管理中心 - 应用 - 搜索应用';if(parent.\$('admincpnav')) parent.\$('admincpnav').innerHTML='应用&nbsp;&raquo;&nbsp;搜索应用';</script>";
	}
	echo '<div class="floattop"><div class="itemtitle"><h3>';
	if (empty($action)) {
		echo "所有应用";
	} else {
		if ($action == "keyword") {
			echo "搜索应用";
		}
	}
	echo '</h3><ul class="tab1">
';
	if (empty($action)) {
		echo "<li class=\"current\">";
	} else {
		echo "<li>";
	}
	echo '<a href="?iframe=app"><span>所有应用</span></a></li>
<li><a href="?iframe=app&action=add"><span>新增应用</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">技巧提示</th></tr>
<tr><td class="tipsblock"><ul>
';
	if (empty($action)) {
		echo "<li>以下是所有的应用</li>";
	} elseif ($action == "keyword") {
		echo "<li>以下是搜索“" . SafeRequest("key", "get") . "”的应用</li>";
	}
	echo '<li>可以输入编号、应用名称、所属会员等关键词进行搜索</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="';
	echo $_SERVER['PHP_SELF'];
	echo '">
<tr><td>
<input type="hidden" name="iframe" value="app">
<input type="hidden" name="action" value="keyword">
关键词：<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=app">不限平台</option>
<option value="?iframe=app&form=iOS"';
	if (isset($_GET['form']) && $_GET['form'] == 'iOS') {
		echo " selected";
	}
	echo '>iOS</option>
<option value="?iframe=app&form=Android"';
	if (isset($_GET['form']) && $_GET['form'] == 'Android') {
		echo " selected";
	}
	echo '>Android</option>
</select>
<input type="button" value="搜索" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<form name="form" method="post" action="?iframe=app&action=alldel">
<table class="tb tb2">
<tr class="header">
<th>编号</th>
<th>应用图标</th>
<th>应用名称</th>
<th>应用平台</th>
<th>所属会员</th>
<th>企业签名</th>
<th>更新时间</th>
<th>安装统计</th>
<th>编辑操作</th>
</tr>
';
	if ($count == 0) {
		echo '<tr><td colspan="2" class="td27">没有应用</td></tr>
';
	}
	if ($result) {
		while ($row = $db->fetch_array($result)) {
			echo '<script type="text/javascript">$(document).ready(function(){$("#thumb';
			echo $row['in_id'];
			echo '").fancybox({\'overlayColor\':\'#000\',\'overlayOpacity\':0.1,\'overlayShow\':true,\'transitionIn\':\'elastic\',\'transitionOut\':\'elastic\'});});</script>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" id="in_id" value="';
			echo $row['in_id'];
			echo '">';
			echo $row['in_id'];
			echo '</td>
<td><a href="';
			echo geticon($row['in_icon']);
			echo '" id="thumb';
			echo $row['in_id'];
			echo '"><img src="';
			echo geticon($row['in_icon']);
			echo '" onerror="this.src=\'static/app/';
			echo $row['in_form'];
			echo '.png\'" width="25" height="25" /></a></td>
<td><a href="';
			echo getlink($row['in_id']);
			echo '" target="_blank" class="act">';
			echo str_replace(SafeRequest("key", "get"), '<em class="lightnum">' . SafeRequest("key", "get") . '</em>', $row['in_name']);
			echo '</a></td>
<td>';
			echo $row['in_form'];
			echo '</td>
<td><a href="?iframe=app&action=keyword&key=';
			echo $row['in_uname'];
			echo '" class="act">';
			echo str_replace(SafeRequest("key", "get"), '<em class="lightnum">' . SafeRequest("key", "get") . '</em>', $row['in_uname']);
			echo '</a></td>
<td>';
			if ($row['in_sign']) {
				echo '<em class="lightnum">已开通(' . $row['in_resign'] . ')</em>';
			} else {
				echo '未开通';
			}
			echo '</td>
<td>';
			if (date('Y-m-d', strtotime($row['in_addtime'])) == date('Y-m-d')) {
				echo '<em class="lightnum">' . $row['in_addtime'] . '</em>';
			} else {
				echo date('Y-m-d', strtotime($row['in_addtime']));
			}
			echo '</td>
<td>';
			echo $row['in_hits'];
			echo '</td>
<td><a href="?iframe=app&action=edit&in_id=';
			echo $row['in_id'];
			echo '" class="act">编辑</a></td>
</tr>
';
		}
	}
	echo '</table>
<table class="tb tb2">
<tr><td><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form);" /><label for="chkall">全选</label> &nbsp;&nbsp; <input type="submit" name="form" class="btn" value="批量删除" /></td></tr>
';
	echo $Arr[0];
	echo '</table>
</form>
</div>



';
}
function AllDel()
{
	global $db;
	if (!submitcheck('form')) {
		ShowMessage("表单验证不符，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
	}
	$in_id = RequestBox("in_id");
	if ($in_id == 0) {
		ShowMessage("批量删除失败，请先勾选要删除的应用！", $_SERVER['HTTP_REFERER'], "infotitle3", 3000, 1);
	} else {
		$query = $db->query("select * from " . tname('app') . " where in_id in ({$in_id})");
		while ($row = $db->fetch_array($query)) {
			$db->query("update " . tname('user') . " set in_spaceuse=in_spaceuse-" . $row['in_size'] . " where in_userid=" . $row['in_uid']);
			@unlink('data/attachment/' . str_replace('.png', '.mobileprovision', substr($row['in_icon'], -36)));
			@unlink('data/attachment/' . $row['in_icon']);
			@unlink('data/attachment/' . $row['in_app']);
		}
		$sql = "delete from " . tname('app') . " where in_id in ({$in_id})";
		if ($db->query($sql)) {
			$db->query("delete from " . tname('salt') . " where in_aid in ({$in_id})");
			$db->query("delete from " . tname('signlog') . " where in_aid in ({$in_id})");
			ShowMessage("恭喜您，应用批量删除成功！", $_SERVER['HTTP_REFERER'], "infotitle2", 3000, 1);
		}
	}
}
function Edit()
{
	global $db;
	$in_id = intval(SafeRequest("in_id", "get"));
	$sql = "select * from " . tname('app') . " where in_id=" . $in_id;
	if ($row = $db->getrow($sql)) {
		$Arr = array($row['in_name'], $row['in_uname'], $row['in_type'], $row['in_mnvs'], $row['in_form'], $row['in_size'], $row['in_bid'], $row['in_bsvs'], $row['in_bvs'], $row['in_nick'], $row['in_team'], $row['in_icon'], $row['in_app'], $row['in_kid'], $in_id);
	}
	EditBoard($Arr, "?iframe=app&action=saveedit&in_id=" . $in_id, "编辑");
}
function Add()
{
	$Arr = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
	EditBoard($Arr, "?iframe=app&action=saveadd", "新增");
}
function SaveAdd()
{
	global $db;
	if (!submitcheck('form2')) {
		ShowMessage("表单验证不符，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
	}
	$in_name = SafeRequest("in_name", "post");
	$in_uname = SafeRequest("in_uname", "post");
	$in_type = SafeRequest("in_type", "post");
	$in_mnvs = SafeRequest("in_mnvs", "post");
	$in_form = SafeRequest("in_form", "post");
	$in_size = intval(SafeRequest("in_size", "post"));
	$in_bid = SafeRequest("in_bid", "post");
	$in_bsvs = SafeRequest("in_bsvs", "post");
	$in_bvs = SafeRequest("in_bvs", "post");
	$in_nick = SafeRequest("in_nick", "post");
	$in_team = SafeRequest("in_team", "post");
	$in_icon = SafeRequest("in_icon", "post");
	$in_app = SafeRequest("in_app", "post");
	$in_kid = intval(SafeRequest("in_kid", "post"));
	$result = $db->query("select * from " . tname('user') . " where in_username='{$in_uname}'");
	if ($row = $db->fetch_array($result)) {
		$db->query("update " . tname('user') . " set in_spaceuse=in_spaceuse+{$in_size} where in_userid=" . $row['in_userid']);
		$db->query("Insert " . tname('app') . " (in_name,in_uid,in_uname,in_type,in_size,in_form,in_mnvs,in_bid,in_bsvs,in_bvs,in_nick,in_team,in_icon,in_app,in_hits,in_kid,in_sign,in_resign,in_removead,in_highspeed,in_addtime) values ('{$in_name}'," . $row['in_userid'] . ",'" . $row['in_username'] . "',{$in_type},{$in_size},'{$in_form}','{$in_mnvs}','{$in_bid}','{$in_bsvs}','{$in_bvs}','{$in_nick}','{$in_team}','{$in_icon}','{$in_app}',0,{$in_kid},0,0,0,0,'" . date('Y-m-d H:i:s') . "')");
		ShowMessage("恭喜您，应用新增成功！", "?iframe=app", "infotitle2", 1000, 1);
	} else {
		ShowMessage("新增失败，所属会员不存在！", "history.back(1);", "infotitle3", 3000, 2);
	}
}
function SaveEdit()
{
	global $db;
	if (!submitcheck('form2')) {
		ShowMessage("表单验证不符，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
	}
	$in_id = intval(SafeRequest("in_id", "get"));
	$in_name = SafeRequest("in_name", "post");
	$in_uname = SafeRequest("in_uname", "post");
	$in_type = SafeRequest("in_type", "post");
	$in_mnvs = SafeRequest("in_mnvs", "post");
	$in_form = SafeRequest("in_form", "post");
	$in_size = intval(SafeRequest("in_size", "post"));
	$in_bid = SafeRequest("in_bid", "post");
	$in_bsvs = SafeRequest("in_bsvs", "post");
	$in_bvs = SafeRequest("in_bvs", "post");
	$in_nick = SafeRequest("in_nick", "post");
	$in_team = SafeRequest("in_team", "post");
	$in_icon = SafeRequest("in_icon", "post");
	$in_app = SafeRequest("in_app", "post");
	$in_kid = intval(SafeRequest("in_kid", "post"));
	$signid = intval(SafeRequest("signid", "post"));
	$result = $db->query("select * from " . tname('user') . " where in_username='{$in_uname}'");
	if ($row = $db->fetch_array($result)) {
		$old = $db->getrow("select * from " . tname('app') . " where in_id=" . $in_id);
		if ($in_icon !== $old['in_icon']) {
			@unlink('data/attachment/' . str_replace('.png', '.mobileprovision', substr($old['in_icon'], -36)));
			@unlink('data/attachment/' . $old['in_icon']);
		}
		if ($in_app !== $old['in_app']) {
			@unlink('data/attachment/' . $old['in_app']);
			$db->query("update " . tname('user') . " set in_spaceuse=in_spaceuse-" . $old['in_size'] . " where in_userid=" . $old['in_uid']);
			$db->query("update " . tname('user') . " set in_spaceuse=in_spaceuse+{$in_size} where in_userid=" . $row['in_userid']);
		} elseif ($row['in_userid'] !== $old['in_uid']) {
			$db->query("update " . tname('user') . " set in_spaceuse=in_spaceuse-" . $old['in_size'] . " where in_userid=" . $old['in_uid']);
			$db->query("update " . tname('user') . " set in_spaceuse=in_spaceuse+{$in_size} where in_userid=" . $row['in_userid']);
		}
		$signid and updatetable('signlog', array('in_status' => 2), array('in_id' => $signid));
		$db->query("update " . tname('app') . " set in_name='{$in_name}',in_uid=" . $row['in_userid'] . ",in_uname='" . $row['in_username'] . "',in_type={$in_type},in_size={$in_size},in_form='{$in_form}',in_mnvs='{$in_mnvs}',in_bid='{$in_bid}',in_bsvs='{$in_bsvs}',in_bvs='{$in_bvs}',in_nick='{$in_nick}',in_team='{$in_team}',in_icon='{$in_icon}',in_app='{$in_app}',in_kid={$in_kid},in_addtime='" . date('Y-m-d H:i:s') . "' where in_id=" . $in_id);
		ShowMessage("恭喜您，应用编辑成功！", $_SERVER['HTTP_REFERER'], "infotitle2", 1000, 1);
	} else {
		ShowMessage("编辑失败，所属会员不存在！", "history.back(1);", "infotitle3", 3000, 2);
	}
}