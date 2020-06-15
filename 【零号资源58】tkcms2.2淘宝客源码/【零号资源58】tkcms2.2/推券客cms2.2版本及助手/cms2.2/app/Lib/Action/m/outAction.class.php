<?php

class outAction extends FirstendAction{
    public function _initialize() {
        parent::_initialize();
		$this->_mod = D('items');
    }

public function index(){
		
$couponurl=I('quanurl', '', 'trim');
 if(!empty($couponurl)){
 	
$quanurl=base64_decode($couponurl);
	 
 }else{
	$id = I('id', '', 'trim');
        $action = I('action');
		$list = $this->_mod->where(array(
                'id' => $id
         ))->Field('quanurl')->find();
         $quanurl=$list['quanurl'];
 }
 
 
	
	if(!empty($quanurl)){
      $this->assign('quanurl',$quanurl);
	 }else{
		echo('<script>alert("此优惠券活动已失效或者过期！");window.location.href="/"</script>');	
	 }

	 $this->display();
	 
     }


	
	
 }


