<?php
class mx_admin extends spModel
{
    var $pk="admin_id";
    var $table="mx_admin";

    var $verifier_login=array(
         "rules"=>array(
            'admin_name'=>array(
               'notnull'=>TRUE,
               'minlength'=>2,
               'maxlength'=>12,
            ),
            'admin_password'=>array(
                'notnull'=>TRUE,
                'minlength'=>3,
                'maxlength'=>90,
            ),
         ),
         
         "messages"=>array(
            'admin_name'=>array(
               'notnull'=>"用户名不能为空！",
               'minlength'=>"用户名最小不能少于2个字符",
               'maxlength'=>"用户名最大不能大于12个字符"
            ),
             'admin_password'=>array(
               'notnull'=>"密码不能为空！",
               'minlength'=>"密码最小不能少于3个字符",
               'maxlength'=>"密码最大不能大于90个字符",
             ),
         ),
    );


    public function userlogin($us_name,$us_password){
        $conditions=array(
           'admin_name'=>$us_name,
           'admin_password'=>$us_password,
        );
        	if( $result = $this->find($conditions) ){ 
			spClass('spAcl')->set($result['aclname']); 
			$_SESSION["userinfo"] = $result; 
			return true;
		}else{
			return false;
		}
    }
  
      	public function acljump(){ 
		$url = spUrl("main","index");
		echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>function sptips(){alert(\"您没有权限进行此操作，请登录！\");location.href=\"{$url}\";}</script></head><body onload=\"sptips()\"></body></html>";
		exit;
	}
}
?>