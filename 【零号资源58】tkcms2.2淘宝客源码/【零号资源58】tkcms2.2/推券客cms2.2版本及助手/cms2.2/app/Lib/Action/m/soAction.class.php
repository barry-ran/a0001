<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('Asia/Shanghai');
vendor('taobao.TopSdk');
class soAction extends FirstendAction
{
	
public function _initialize()
{
parent::_initialize();
$this->_userdomain=str_replace('/index.php/m','',C('yh_headerm_html'));
$this->_userappkey=C('yh_gongju');
$this->_pcdomain=C('yh_site_url');
$this->_avatar=C('yh_site_zhibo');

}


public function index(){
$this->assign('status','yes');
if(IS_POST){

$text = I('key','','trim');
 $url=$this->tqkapi."/sold";
 $data=array(
 'key'=>$this->_userappkey,
 'time'=>time(),
 'tqk_uid'=>	$this->tqkuid,
 'k'=>$text,
 'pid'=>$this->agent_pid()
 );
 $data=$this->_curl($url,$data,true);
 $result=json_decode($data,true);

if($result['status']=='1'){
$this->assign('list',$result['data']);	
}else{
$this->assign('status','no');	
}
 	
}

if($this->_avatar){
$this->assign('avatar',$this->_avatar);	
}else{
$this->assign('avatar','/static/images/default_photo.gif');	
}

$this->display();
}








}




?>