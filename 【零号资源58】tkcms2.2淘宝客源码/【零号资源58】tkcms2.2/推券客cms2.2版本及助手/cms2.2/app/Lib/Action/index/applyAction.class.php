<?php
class applyAction extends FirstendAction
{

    public function index()
    {
    
	if($this->visitor->is_login){
		
	$this->assign('is_login','yes');
	
	if(IS_POST){
	if($this->visitor->is_login == false){
        	   $url=U('login/index','','');
           redirect($url);
     }
	$code = I('code','','trim');
	$mod=M('apply');
	$name=trimall(I('name','','htmlspecialchars'));
	$alipay=trimall(I('alipay','','htmlspecialchars'));
	$qq=I('qq','','trim');
	
	if(!is_numeric($qq)){
	 $this->ajaxReturn(0, '非法操作');
	}
	
	 if($_SESSION['verify'] != md5($code)){
          return  $this->ajaxReturn(0, '验证码错误');
      }
	
	$data=array(
	'name'=>$name,
	'alipay'=>$alipay,
	'qq'=>$qq,
	'uid'=>$this->visitor->get('id'),
	'add_time'=>NOW_TIME,
	''
	);
	$res=$mod->add($data);
	 if($res){
        return $this->ajaxReturn(1, '申请提交成功，我们会尽快与您联系。', U('user/ucenter'));
      }
        
      $this->ajaxReturn(0, $this->visitor->error);
	
	}
			
			
			
	}
	
	$this->_config_seo(array(
            'title'=>'代理站长申请'
        ));
	
        $this->display();
    }


}