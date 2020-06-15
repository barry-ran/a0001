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
<title>证书管理</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
<script type="text/javascript">
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
function CheckAll(form) {
	for (var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name != \'chkall\') {
			e.checked = form.chkall.checked;
		}
	}
}
</script>
</head>
<body>
';
switch ($action) {
	case 'del':
		Del();
		break;
	case 'editsave':
		EditSave();
		break;
	case 'saveadd':
		SaveAdd();
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
	$sql = "select * from " . tname('cert') . " order by in_id asc";
	$result = $db->query($sql);
	$count = $db->num_rows($db->query(str_replace('*', 'count(*)', $sql)));
	echo '<div class="container">
<script type="text/javascript">parent.document.title = \'零度分发平台 Board 管理中心 - 应用 - 证书管理\';if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'应用&nbsp;&raquo;&nbsp;证书管理\';</script>
<div class="floattop"><div class="itemtitle"><h3>证书管理</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">编辑证书</th></tr>
</table>
<form name="form" method="post" action="?iframe=cert&action=editsave">
<table class="tb tb2">
<tr class="header">
<th>编号</th>
<th>证书标识(.plist)</th>
<th>证书名称(.sh)</th>
<th>证书目录</th>
<th>编辑操作</th>
</tr>
';
	if ($count == 0) {
		echo '<tr><td colspan="2" class="td27">没有证书</td></tr>
';
	} else {
		while ($row = $db->fetch_array($result)) {
			echo '<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" value="';
			echo $row['in_id'];
			echo '">';
			echo $row['in_id'];
			echo '</td>
<td class="td29"><input type="text" name="in_iden';
			echo $row['in_id'];
			echo '" value="';
			echo $row['in_iden'];
			echo '" class="txt" /></td>
<td class="td29"><input type="text" name="in_name';
			echo $row['in_id'];
			echo '" value="';
			echo $row['in_name'];
			echo '" class="txt" /></td>
<td><div class="parentboard"><input type="text" name="in_dir';
			echo $row['in_id'];
			echo '" value="';
			echo $row['in_dir'];
			echo '" class="txt" readonly /></div></td>
<td><input type="button" class="btn" value="删除" onclick="location.href=\'?iframe=cert&action=del&in_id=';
			echo $row['in_id'];
			echo '\'" /></td>
</tr>
';
		}
	}
	echo '</table>
<table class="tb tb2">
<tr><td class="td25"><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form)" /><label for="chkall">全选</label></td><td colspan="15"><div class="fixsel"><input type="submit" class="btn" name="editsave" value="批量修改" /></div></td></tr>
</table>
</form>

<table class="tb tb2">
<tr><th class="partition">新增证书</th></tr>
</table>
<form method="post" action="?iframe=cert&action=saveadd">
<table class="tb tb2">
<tr>
<td>证书标识</td>
<td><input type="text" class="txt" name="in_iden" id="in_iden" style="margin:0;width:200px"></td>
<td>证书名称</td>
<td><input type="text" class="txt" name="in_name" id="in_name" style="margin:0;width:200px"></td>
<td>证书目录</td>
<td><input type="text" class="txt" name="in_dir" id="in_dir" style="margin:0;width:100px"></td>
</tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" id="btnadd" name="saveadd" class="btn" value="新增" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="pop.up(\'no\', \'上传证书\', \'source/pack/upload/cert-open.php\', \'406px\', \'180px\', \'175px\');" class="addtr">上传(证书目录.mobileprovision)自动新增</a></div></td></tr>
</table>
</form>

<table class="tb tb2">
<tr><th class="partition">描述验证</th></tr>
</table>
<table class="tb tb2">
<tr>
<td>chain.crt</td>
<td><input type="text" value="';
	echo is_file('data/cert/chain.crt') ? '修改于 ' . date('Y-m-d H:i:s', filemtime('data/cert/chain.crt')) : '未找到 data/cert/chain.crt 文件';
	echo '" class="txt" style="margin:0;width:200px" readonly /></td>
<td>domain.crt</td>
<td><input type="text" value="';
	echo is_file('data/cert/domain.crt') ? '修改于 ' . date('Y-m-d H:i:s', filemtime('data/cert/domain.crt')) : '未找到 data/cert/domain.crt 文件';
	echo '" class="txt" style="margin:0;width:200px" readonly /></td>
<td>domain.key</td>
<td><input type="text" value="';
	echo is_file('data/cert/domain.key') ? '修改于 ' . date('Y-m-d H:i:s', filemtime('data/cert/domain.key')) : '未找到 data/cert/domain.key 文件';
	echo '" class="txt" style="margin:0;width:200px" readonly /></td>
</tr>
<tr><td colspan="15"><div class="fixsel"><a href="javascript:void(0)" onclick="pop.up(\'no\', \'上传证书\', \'source/pack/upload/signed-open.php\', \'406px\', \'180px\', \'175px\');" class="addtr">上传</a>&nbsp;&nbsp;(一般为Apache环境的SSL证书，请将三个文件分别更改为以上命名并压缩成zip文件再上传)</div></td></tr>
</table>
</div>


';
}
function SaveAdd()
{
	global $db;
	if (!submitcheck('saveadd')) {
		ShowMessage("表单验证不符，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
	}
	$in_iden = SafeRequest("in_iden", "post");
	$in_name = SafeRequest("in_name", "post");
	$in_dir = SafeRequest("in_dir", "post");
	if (empty($in_iden)) {
		ShowMessage("新增出错，证书标识不能为空！", "?iframe=cert", "infotitle3", 1000, 1);
	}
	if (empty($in_name)) {
		ShowMessage("新增出错，证书名称不能为空！", "?iframe=cert", "infotitle3", 1000, 1);
	}
	if (empty($in_dir)) {
		ShowMessage("新增出错，证书目录不能为空！", "?iframe=cert", "infotitle3", 1000, 1);
	}
	$in_id = $db->getone("select in_id from " . tname('cert') . " where in_dir='{$in_dir}'");
	if ($in_id) {
		$db->query("update " . tname('cert') . " set in_iden='{$in_iden}',in_name='{$in_name}' where in_id=" . $in_id);
	} else {
		$db->query("Insert " . tname('cert') . " (in_iden,in_name,in_dir) values ('{$in_iden}','{$in_name}','{$in_dir}')");
	}
	ShowMessage("恭喜您，证书新增成功！", "?iframe=cert", "infotitle2", 1000, 1);
}
function EditSave()
{
	global $db;
	if (!submitcheck('editsave')) {
		ShowMessage("表单验证不符，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
	}
	$in_id = RequestBox("in_id");
	if ($in_id == 0) {
		ShowMessage("修改失败，请先勾选要编辑的证书！", "?iframe=cert", "infotitle3", 3000, 1);
	} else {
		$ID = explode(',', $in_id);
		for ($i = 0; $i < count($ID); $i++) {
			$in_iden = SafeRequest("in_iden" . $ID[$i], "post");
			$in_name = SafeRequest("in_name" . $ID[$i], "post");
			$in_dir = SafeRequest("in_dir" . $ID[$i], "post");
			if (empty($in_iden)) {
				ShowMessage("修改出错，证书标识不能为空！", "?iframe=cert", "infotitle3", 1000, 1);
			}
			if (empty($in_name)) {
				ShowMessage("修改出错，证书名称不能为空！", "?iframe=cert", "infotitle3", 1000, 1);
			}
			if (empty($in_dir)) {
				ShowMessage("修改出错，证书目录不能为空！", "?iframe=cert", "infotitle3", 1000, 1);
			}
			$db->query("update " . tname('cert') . " set in_iden='{$in_iden}',in_name='{$in_name}',in_dir='{$in_dir}' where in_id=" . $ID[$i]);
		}
		ShowMessage("恭喜您，证书批量修改成功！", "?iframe=cert", "infotitle2", 3000, 1);
	}
}
function Del()
{
	global $db;
	$in_id = intval(SafeRequest("in_id", "get"));
	$in_dir = $db->getone("select in_dir from " . tname('cert') . " where in_id=" . $in_id);
	@unlink('data/cert/' . $in_dir . '.zip');
	$db->query("delete from " . tname('cert') . " where in_id=" . $in_id);
	ShowMessage("恭喜您，证书删除成功！", "?iframe=cert", "infotitle2", 3000, 1);
}