<?php
class financeAction extends BackendAction
{

	public function _initialize()
	{
		parent::_initialize();

		$this->_name = 'finance';
		 $this->assign('list_table', true);
		$this->_mod = D('finance');
	}
	

	
public function flist(){
	
$p = I('p', 1, 'intval');
$page_size = 20;

$start = $page_size * ($p - 1);

$mod=M($this->_name);

if($_GET['status']){
	
$where['status']=$this->_get('status', 'trim');
	
 } 


 if($_GET['keyword']){
 	
     $where['uid'] = M('user')->where('phone ='.$this->_get('keyword', 'trim'))->getfield('id');
	 
 }
 
 if($_GET['time_start']){
	
$where['add_time']=$this->_get('time_start', 'trim');
	
 } 
 
 
$prefix = C(DB_PREFIX);
$field = '*,
   (select phone from '.$prefix.'user where '.$prefix.'user.id = '.$prefix.'finance.uid) as phone,
   (select name from '.$prefix.'apply where '.$prefix.'apply.uid = '.$prefix.'finance.uid) as name,
   (select alipay from '.$prefix.'apply where '.$prefix.'apply.uid = '.$prefix.'finance.uid) as alipay';
$rows = $mod->field($field)->where($where)->order('id desc')->limit($start . ',' . $page_size)->select();
$count = $mod->where($where)->count();
$pager = $this->_pager($count, $page_size);
$this->assign('page', $pager->show());
$this->assign('total_item', $count);
$this -> assign('page_size',$page_size);
foreach($rows as $k=>$v){
		$list[$k]['status']=$this->orderstatic($v['status']);
		$list[$k]['status_t']=$v['status'];
		$list[$k]['price']='￥'.$v['price'];
		$list[$k]['mark']=$v['mark'];
		$list[$k]['name']=$v['name'];
		$list[$k]['alipay']=$v['alipay'];
		$list[$k]['income']='￥'.$v['income'];
		$list[$k]['add_time']=$v['add_time'];
		$list[$k]['phone']=$v['phone'];
		$list[$k]['id']=$v['id'];
		$list[$k]['backcash']='￥'.$v['backcash'];
		
}

$this->assign('orderlist',$list);

$this->display();
		
		
}


public function edit_status(){
	
$id = $this->_get('id', 'trim');

if(!empty($id)){
$where=array(
'id'=>$id
);
$data=array(
'status'=>1
);
$res=M('finance')->where($where)->save($data);
if($res){
IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
                $this->success(L('operation_success'));	

}else{
	
 IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
}

	
}



    
	
	
}




public function delete_f()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        if ($ids) {
            if (false !== $mod->delete($ids)) {
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
            $this->error(L('illegal_parameters'));
        }
    }



protected function orderstatic($id){
switch($id){
	case 2 :
	return '待付款';
	break;
	case 1 :
	return '已付款';
	
	default : 
	return '结算异常';
	break;
}
	
}

	
	
	
}


