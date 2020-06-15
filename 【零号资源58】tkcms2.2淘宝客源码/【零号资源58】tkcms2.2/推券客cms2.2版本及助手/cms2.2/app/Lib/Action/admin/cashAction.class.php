<?php
class cashAction extends BackendAction
{
  //  protected $list_relation = true;
    
    public function _initialize()
    {
        parent::_initialize();
        
        $this->_name = 'user_cash';
    }
    
    protected function _search()
    {
        $map = array();
        
        if($_GET['type']){
            $map['type'] = $this->_get('type', 'trim');
        }
        
        if($_GET['keyword']){
            $map['data'] = $this->_get('keyword', 'trim');
        }
        
        return $map;
    }
    
    public function audit()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        
        if(IS_POST){
                
            $id = $this->_post($pk, 'intval');
                
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            
            if (false !== $mod->where(array('id'=>$id))->save($data)) {
                
                $item = $mod->find($id);
                
                if($item['status'] == 1){
                    M('user_cash')->add(array(
                        'uid'=>$item['uid'],
                        'money'=>$item['money'],
                        'type'=>1,
                        'remark'=>'充值：'.$item['money'].'元',
                        'data'=>$item['id'],
                        'create_time'=>NOW_TIME,
                        'status'=>1,
                    ));
                    
                    M('user')->where(array('id'=>$item['uid']))->setInc('money', $item['money']);
                }
                
                
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'audit');
                return $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                return $this->error(L('operation_failure'));
            }
        }
        
        $id = $this->_get($pk, 'intval');
        $info = $mod->find($id);
        $this->assign('info', $info);
        $this->assign('open_validator', true);
        if (IS_AJAX) {
            $response = $this->fetch();
            $this->ajaxReturn(1, '', $response);
        } else {
            $this->display();
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