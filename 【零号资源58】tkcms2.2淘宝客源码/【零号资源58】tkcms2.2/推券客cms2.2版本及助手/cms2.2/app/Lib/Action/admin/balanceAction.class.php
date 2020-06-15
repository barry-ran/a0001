<?php
class balanceAction extends BackendAction
{
   // protected $list_relation = true;
    
    public function _initialize()
    {
        parent::_initialize();
        
        $this->_name = 'balance';
    }
    
    protected function _search()
    {
        $map = array();
        
        //$map['type'] = $this->_get('type', 'trim', 'main');
        
        return $map;
    }

    
    public function _before_insert()
    {
        $data['sn'] = date('YmdHis').rand(10000,99999);
        $data['confirm'] = 0;
        $data['create_time']=NOW_TIME;
        $data['status']=0;
        
        return $data;
    }
    
    public function balance_status()
	{

	    $id    = I('id');
	    $money = $this->_param('money', 'trim');
	    $openid   = $this->_param('uid', 'trim');
	    if(!$id){
	        $this->ajaxReturn(0, '操作失败，请稍后再试');
	    }
	    $status = I('status', 0);
	    $row = M('balance')->where(array('id'=>$id))->save(array('status'=>$status));
	    if($row){
	    	$map['id'] = $openid;
	    	$data = array(
		        'frozen'=>array('exp','frozen-'.$money),
		    );
		$row1 = M('user')->where($map)->save($data);
	    	$row2 = M('user_cash')->add(array(
	    		'uid'         =>$openid,
	    		'money'       =>$money,
	    		'remark'      =>'余额提现 : '.$money.'元',
	    		'type'        =>6, 
	    		'create_time' =>time(),
	    		'status'      =>1,
	    	));
	    	if($row2 && $row1){
	    	return 	$this->ajaxReturn(1, '操作成功');
	    	}
	    }
	    
	    
	}

    public function ajax_upload_img() {
        if (!empty($_FILES['img']['name'])) {
            $result = $this->_upload($_FILES['img'], 'charge/');
            if ($result['error']) {
                $this->error(0, $result['info']);
            } else {
                $data['img'] = $result['info'][0]['savename'];
                $this->ajaxReturn(1, L('operation_success'), "/".C( "yh_attach_path" ).'charge/'.$data['img']);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }
}