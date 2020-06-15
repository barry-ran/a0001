<?php
include '../../../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/xml;charset=utf-8");
$ios = explode('/', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : NULL);
$plist = isset($ios[1]) ? $ios[1] : NULL;
$salt = SafeSql(str_replace('.plist', '', $plist));
$id = getfield('salt', 'in_aid', 'in_salt', $salt);
$id or exit('Access denied');
if (IN_DENIED) {
	$ipa = 'https://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'source/pack/upload/install/proxy.php/' . $salt . '.ipa';
} else {
	$GLOBALS['db']->query("delete from " . tname('salt') . " where in_salt='$salt'");
	$app = getfield('app', 'in_app', 'in_id', $id);
	$ipa = getapp($app, 1);
}
$icon = geticon(getfield('app', 'in_icon', 'in_id', $id));
$bid = getfield('app', 'in_bid', 'in_id', $id);
$name = convert_charset(getfield('app', 'in_name', 'in_id', $id));
echo '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>items</key>
	<array>
		<dict>
			<key>assets</key>
			<array>
				<dict>
					<key>kind</key>
					<string>software-package</string>
					<key>url</key>
					<string>' . $ipa . '</string>
				</dict>
				<dict>
					<key>kind</key>
					<string>display-image</string>
					<key>needs-shine</key>
					<true/>
					<key>url</key>
					<string>' . $icon . '</string>
				</dict>
			</array>
			<key>metadata</key>
			<dict>
				<key>bundle-identifier</key>
				<string>' . $bid . '</string>
				<key>bundle-version</key>
				<string>1.0</string>
				<key>kind</key>
				<string>software</string>
				<key>subtitle</key>
				<string>App Subtitle</string>
				<key>title</key>
				<string>' . $name . '</string>
			</dict>
		</dict>
	</array>
</dict>
</plist>';