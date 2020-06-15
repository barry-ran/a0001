<?php
namespace PngFile;

require_once 'depng/pngCompote.php';
namespace CFPropertyList;

require_once 'deplist/CFPropertyList.php';
include '../../system/db.class.php';
include '../../system/user.php';
error_reporting(0);
$GLOBALS['userlogined'] or exit('-1');
$id = intval($_GET['id']);
$time = $_GET['time'];
$tmp = '../../../data/tmp/' . $time . '.ipa';
$explode = explode('-', $time);
$icontime = md5($explode[0] . '-' . $explode[1] . '-' . rand(2, pow(2, 24))) . '.png';
$apptime = md5($explode[1] . '-' . $explode[0] . '-' . rand(2, pow(2, 24))) . '.ipa';
is_file('../../../data/attachment/' . $apptime) and exit('-2');
IN_VERIFY > 0 and $GLOBALS['erduo_in_verify'] != 1 and exit('-3');
$dir = '../../../data/tmp/' . $time . '/Payload';
if (is_dir($dir)) {
	$d = NULL;
	$h = opendir($dir);
	while ($f = readdir($h)) {
		if ($f != '.' && $f != '..' && is_dir($dir . '/' . $f)) {
			$d = $dir . '/' . $f;
		}
	}
	closedir($h);
	$info = file_get_contents($d . '/Info.plist');
	$plist = new CFPropertyList();
	$plist->parse($info);
	$plist = $plist->toArray();
	$xml_size = intval($_GET['size']);
	$xml_size + $GLOBALS['erduo_in_spaceuse'] > $GLOBALS['erduo_in_spacetotal'] and exit('-4');
	$xml_name = SafeSql(detect_encoding(isset($plist['CFBundleDisplayName']) ? $plist['CFBundleDisplayName'] : $plist['CFBundleName']));
	$xml_mnvs = SafeSql($plist['MinimumOSVersion']);
	$xml_bid = SafeSql($plist['CFBundleIdentifier']);
	$xml_bsvs = SafeSql($plist['CFBundleShortVersionString']);
	$xml_bvs = SafeSql($plist['CFBundleVersion']);
	if ($xml_size >= 1 && $xml_size <= 10485760){ //0-10M
	  $in_deduct = '1';
	}
	if ($xml_size >= 10485761 && $xml_size <= 52428800){ //10-50M
	  $in_deduct = '1';
	}
	if ($xml_size >= 52428801 && $xml_size <= 104857600){ //50-100M
	  $in_deduct = '2';
	}
	if ($xml_size >= 104857601 && $xml_size <= 314572800){ //100-300M
	  $in_deduct = '3';
	}
	if ($xml_size >= 314572801 && $xml_size <= 629145600){ //300-600M
	  $in_deduct = '6';
	}
	if ($xml_size >= 629145601 && $xml_size <= 1048576000){ //600-1000M
	  $in_deduct = '10';
	}
	if ($xml_size >= 1048576001 && $xml_size <= 1572864000){ //1000-1500M
	  $in_deduct = '15';
	}
	if ($xml_size >= 1572864001){ //大于1500M
	  $in_deduct = '20';
	}	
	if ($id) {
		getfield('app', 'in_uid', 'in_id', $id) == $GLOBALS['erduo_in_userid'] or exit('-5');
		getfield('app', 'in_bid', 'in_id', $id) == $xml_bid and getfield('app', 'in_name', 'in_id', $id) == $xml_name or exit('-6');
	} else {
		$id = $GLOBALS['db']->getone("select in_id from " . tname('app') . " where in_bid='$xml_bid' and in_name='$xml_name' and in_form='iOS' and in_uid=" . $GLOBALS['erduo_in_userid']);
	}
	IN_REMOTE > 0 and fwrite(fopen('../../../data/tmp/' . $time . '.log', 'wb+'), $icontime);
	rename($tmp, '../../../data/attachment/' . $apptime);
	$newfile = '../../../data/attachment/' . $icontime;
	$icon = $plist['CFBundleIcons']['CFBundlePrimaryIcon']['CFBundleIconFiles'];
	if (!$icon) {
		$icon = $plist['CFBundleIconFiles'];
		if (!$icon) {
			$icon = $plist['CFBundleIconFiles~ipad'];
		}
	}
	if (preg_match('/\./', $icon[0])) {
		$cvt = is_file($d . '/' . $icon[0]) ? 'trim' : 'strtolower';
		for ($i = 0; $i < count($icon); $i++) {
			if (is_file($d . '/' . $cvt($icon[$i]))) {
				$big[] = filesize($d . '/' . $cvt($icon[$i]));
				$small[] = filesize($d . '/' . $cvt($icon[$i]));
			}
		}
		rsort($big);
		sort($small);
		for ($p = 0; $p < count($icon); $p++) {
			if ($big[0] == filesize($d . '/' . $cvt($icon[$p]))) {
				$bigfile = $d . '/' . $cvt($icon[$p]);
			}
			if ($small[0] == filesize($d . '/' . $cvt($icon[$p]))) {
				$smallfile = $d . '/' . $cvt($icon[$p]);
			}
		}
	} else {
		$ext = is_file($d . '/' . $icon[0] . '.png') ? '.png' : '@2x.png';
		for ($i = 0; $i < count($icon); $i++) {
			if (is_file($d . '/' . $icon[$i] . $ext)) {
				$big[] = filesize($d . '/' . $icon[$i] . $ext);
				$small[] = filesize($d . '/' . $icon[$i] . $ext);
			}
		}
		rsort($big);
		sort($small);
		for ($p = 0; $p < count($icon); $p++) {
			if ($big[0] == filesize($d . '/' . $icon[$p] . $ext)) {
				$bigfile = is_file($d . '/' . $icon[$p] . '@3x.png') ? $d . '/' . $icon[$p] . '@3x.png' : $d . '/' . $icon[$p] . $ext;
			}
			if ($small[0] == filesize($d . '/' . $icon[$p] . $ext)) {
				$smallfile = preg_match('/AppIcon20x20/', $icon[$p]) ? $d . '/' . $icon[$p] . '@3x.png' : $d . '/' . $icon[$p] . $ext;
			}
		}
	}
	$png = new \PngFile\PngFile($smallfile);
	if (!$png->revertIphone($newfile)) {
		if (!rename($bigfile, $newfile)) {
			if ($plist['CFBundleIconFile']) {
				if (preg_match('/\./', $plist['CFBundleIconFile'])) {
					rename($d . '/' . $plist['CFBundleIconFile'], $newfile);
				} else {
					rename($d . '/' . $plist['CFBundleIconFile'] . '.png', $newfile);
				}
			} else {
				copy('../../../static/app/iOS.png', $newfile);
			}
		}
	}
	$em = file_get_contents($d . '/embedded.mobileprovision');
	$xml_nick = preg_match('/<key>Name<\/key>
([\s\S]+?)<string>([\s\S]+?)<\/string>/', $em, $m) ? SafeSql(mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES')) : '*';
	$xml_type = preg_match('/^iOS Team Provisioning Profile:/', $xml_nick) ? 0 : 1;
	$xml_team = preg_match('/<key>TeamName<\/key>
([\s\S]+?)<string>([\s\S]+?)<\/string>/', $em, $m) ? SafeSql(mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES')) : '*';
	if ($id) {
		$old = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
		@unlink('../../../data/attachment/' . $old['in_icon']);
		@unlink('../../../data/attachment/' . $old['in_app']);
		$GLOBALS['db']->query("update " . tname('user') . " set in_spaceuse=in_spaceuse+$xml_size-" . $old['in_size'] . " where in_userid=" . $GLOBALS['erduo_in_userid']);
		$GLOBALS['db']->query("update " . tname('app') . " set in_deduct='$in_deduct',in_name='$xml_name',in_type=$xml_type,in_size=$xml_size,in_form='iOS',in_mnvs='$xml_mnvs',in_bid='$xml_bid',in_bsvs='$xml_bsvs',in_bvs='$xml_bvs',in_nick='$xml_nick',in_team='$xml_team',in_icon='$icontime',in_app='$apptime',in_addtime='" . date('Y-m-d H:i:s') . "' where in_id=" . $id);
	} else {
		$GLOBALS['db']->query("update " . tname('user') . " set in_spaceuse=in_spaceuse+$xml_size where in_userid=" . $GLOBALS['erduo_in_userid']);
		$GLOBALS['db']->query("Insert " . tname('app') . " (in_deduct,in_name,in_uid,in_uname,in_type,in_size,in_form,in_mnvs,in_bid,in_bsvs,in_bvs,in_nick,in_team,in_icon,in_app,in_hits,in_kid,in_sign,in_resign,in_removead,in_highspeed,in_addtime) values ('$in_deduct','$xml_name'," . $GLOBALS['erduo_in_userid'] . ",'" . $GLOBALS['erduo_in_username'] . "',$xml_type,$xml_size,'iOS','$xml_mnvs','$xml_bid','$xml_bsvs','$xml_bvs','$xml_nick','$xml_team','$icontime','$apptime',0,0,0,0,0,0,'" . date('Y-m-d H:i:s') . "')");
	}
	echo '1';
}