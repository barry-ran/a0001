<?php
include '../../../system/db.class.php';
close_browse();
$id = intval(SafeRequest("id","get"));
$form = getfield('app','in_form','in_id',$id);
$app = getfield('app','in_app','in_id',$id);
$uid = getfield('app','in_uid','in_id',$id);
$points = getfield('user','in_points','in_userid',$uid);
$points >0 or exit(header('location:'.getlink($id)));
$salt = md5($id.'|'.time().'|'.rand(2,pow(2,24)));
inserttable('salt',array('in_aid'=>$id,'in_salt'=>$salt,'in_time'=>time()));
$GLOBALS['db']->query("update ".tname('app')." set in_hits=in_hits+1 where in_id=".$id);
$GLOBALS['db']->query("update ".tname('user')." set in_points=in_points-1 where in_userid=".$uid);
if($form == 'iOS')
{
	if(substr($app,-13) == '.mobileconfig')
	{
		$GLOBALS['db']->query("delete from ".tname('salt')." where in_salt='$salt'");
		header('location:'.getapp($app,1));
	}
	else
	{
		$plist = 'https://'.$_SERVER['HTTP_HOST'].IN_PATH.'source/pack/upload/install/ios.php/'.$salt.'.plist';
		header('location:itms-services://?action=download-manifest&url='.$plist);
	}
}
else
{
	if(IN_DENIED)
	{
		header('location:'.IN_PATH.'source/pack/upload/install/proxy.php/'.$salt.'.apk');
	}
	else
	{
		$GLOBALS['db']->query("delete from ".tname('salt')." where in_salt='$salt'");
		header('location:'.getapp($app,1));
	}
}
?>