<?php
class userAction extends BackendAction
{
    //protected $list_relation = true;
    
    public function _initialize()
    {
        parent::_initialize();
        
        $this->_name = 'user';
    }
    

    protected function _search()
    {
        $map = array();
      	($keyword = $this -> _request('keyword', 'trim')) && $map['phone'] = array('like', '%' . $keyword . '%');
        $role = $this -> _param('role');
        if(isset($_GET['role'])){
        	$map['role'] = $role;
        }
        return $map;
    }

    public function _before_index()
    {
        $this->sort = 'id';
        $this->order = 'DESC';
        $big_menu = array(
            'title' => '新增用户',
            'iframe' => U('user/add'),
            'id' => 'add',
            'width' => '500',
            'height' => '200'
        );
        $this->assign('big_menu', $big_menu);
    }
    

    
    public function money()
    {
        if(IS_POST){
            
        }
        
        $this->assign('uid', $this->_get('id', 'intval'));
        
        $this->assign('open_validator', true);
        
        if (IS_AJAX) {
            $response = $this->fetch();
            $this->ajaxReturn(1, '', $response);
        } else {
            $this->display();
        }
    }
    
    public function ajax_check_name()
    {
        $name = $this->_get('username', 'trim');
        $id = $this->_get('id', 'intval');
        
        $where = array(
            'username'=>$name
        );
        
        if($id){
            $where['id'] = array('neq', $id);
        }
        
        if (M('user')->where($where)->field('id')->find()) {
            $this->ajaxReturn(0, L('adboard_already_exists'));
        } else {
            $this->ajaxReturn();
        }
    }
    
    public function ajax_check_phone()
    {
        $phone = $this->_get('phone', 'trim');
        $id = $this->_get('id', 'intval');
        
        $where = array(
            'phone'=>$phone
        );
        
        if($id){
            $where['id'] = array('neq', $id);
        }
        
        if (M('user')->where($where)->field('id')->find()) {
            $this->ajaxReturn(0, L('adboard_already_exists'));
        } else {
            $this->ajaxReturn();
        }
    }
    
	
public function edituser(){
		
if(IS_POST){
$role = $this->_param('role', 'trim');
$password = $this->_param('repassword', 'trim');
$status = $this->_param('status', 'trim');
$where = array(
        'id'=>$this->_param('id', 'trim')
 );
$data['role']=$role;
$data['webmaster']=$this->_param('webmaster', 'trim');
$data['webmaster_pid']=intval($this->_param('webmaster_pid', 'trim'));
$data['webmaster_rate']=intval($this->_param('webmaster_rate', 'trim'));
if($password){
$data['password']=md5($password);
}
$data['last_time']=time();
 $res = M('user')->where($where)->save($data);
 if($res){
return $this->ajaxReturn(1,'修改成功！');
 }else{
 return $this->ajaxReturn(0,'修改失败！');	
	
 }
		
}
		
		
	}
	
	
    public function ajax_check_email()
    {
        $email = $this->_get('email', 'trim');
        $id = $this->_get('id', 'intval');
        
        $where = array(
            'email'=>$email
        );
        
        if($id){
            $where['id'] = array('neq', $id);
        }
        
        if (M('user')->where($where)->field('id')->find()) {
            $this->ajaxReturn(0, L('adboard_already_exists'));
        } else {
            $this->ajaxReturn();
        }
    }
    
    public function ajax_upload_img() {
        if (!empty($_FILES['img']['name'])) {
            $result = $this->_upload($_FILES['img'], 'avatar/');
            if ($result['error']) {
                $this->error(0, $result['info']);
            } else {
                $data['img'] = $result['info'][0]['savename'];
                $this->ajaxReturn(1, L('operation_success'), "/".C( "yh_attach_path" ).'avatar/'.$data['img']);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }
}