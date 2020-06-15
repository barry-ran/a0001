<?php
function saveSetting($k, $v) {
    global $DB;
    $v = addslashes($v);
    return $DB->query("REPLACE INTO " . DBQZ . "_config SET v='$v',k='$k'");
}
function msg($content, $ret) {
    if ($ret == 1) {
        $ret = "history.go(-1);</script>";
    } else {
        $ret = "window.location.href='" . $ret . "';</script>";
    }
    exit("<script language='javascript'>alert('$content');$ret</script>");
}
function iflogin($cookie) {
session_start();
	if(isset($_COOKIE[DBQZ . "_cookie"])&&time()>$_COOKIE[DBQZ . "_cookie"]+3600*24*14){
		return true;
	}else{
		return false;
	}
}

function getkm($len = 20){
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$strlen = strlen($str);
	$randstr = "";
	for ($i = 0; $i < $len; $i++) {
		$randstr .= $str[mt_rand(0, $strlen - 1)];
	}
	return $randstr;
}

function getnum($len = 1){
	$str = "1234567890";
	$strlen = strlen($str);
	$randstr = "";
	for ($i = 0; $i < $len; $i++) {
		$randstr .= $str[mt_rand(0, $strlen - 1)];
	}
	return $randstr;
}

function real_ip() {
    $ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] AS $xip) {
            if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                $ip = $xip;
                break;
            }
        }
    }
    return $ip;
}

function defense($string, $force = 0, $strip = FALSE) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = defense($val, $force, $strip);
			}
		} else {
			$string = addslashes($strip ? stripslashes($string) : $string);
		}
	}
	return $string;
}

function get_ip_city($ip) {
    $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=';
    @$city = get_curl($url . $ip);
    $city = json_decode($city, true);
    if ($city['city']) {
        $location = $city['province'] . $city['city'];
    } else {
        $location = $city['province'];
    }
    if ($location) {
        return $location;
    } else {
        return false;
    }
}

?>
