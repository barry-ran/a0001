<?php
class applyAction extends BackendAction
{

	public function _initialize()
	{
		parent::_initialize();

		$this->_name = 'apply';
	}

	protected function _search()
	{
		$map = array();
		
		if($_GET['keyword']){
			$map['name'] = $this->_get('name', 'trim');
		}
		
		return $map;
	}
	
	public function status()
	{
		$id = I('id');
		if ($id){
			$row = M('apply')->where('id='.$id.'')->setField('status',1);
			if($row){
				$this -> ajaxReturn(1, L('operation_success'));
			} else {
				$this -> ajaxReturn(0, L('illegal_parameters'));
			}
			
		}else{
			$this -> ajaxReturn(0, '该条信息不存在');
		}
	}
	
	
	

}