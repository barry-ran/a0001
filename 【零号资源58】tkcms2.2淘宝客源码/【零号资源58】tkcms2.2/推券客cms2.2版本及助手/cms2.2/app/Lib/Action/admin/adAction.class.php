<?php
class adAction extends BackendAction {
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('ad');
    }


    public function _before_index() {
        $big_menu = array(
            'title' => L('ad_add'),
            'iframe' => U('ad/add'),
            'id' => 'add',
            'width' => '520',
            'height' => '151',
        );
        $this->assign('big_menu', $big_menu);
		$this->assign('img_dir', '/data/upload/site/');

        $res = $this->_mod->select();
        $this->assign('board_list', $res);
    }

    public function _before_add() {
        $this->assign('ad_type_arr', $this->_ad_type);
    }
	
    public function _before_edit() {
        $id = $this->_get('id', 'intval');
        $board_id = $this->_mod->where(array('id'=>$id))->getField('board_id');
        $board_info = $this->_adboard_mod->field('name,width,height')->where(array('id'=>$board_id))->find();
        $this->assign('board_info', $board_info);
        $this->assign('ad_type_arr', $this->_ad_type);
    }

    public function ajax_upload_img() {
        if (!empty($_FILES['img']['name'])) {
            $result = $this->_upload($_FILES['img'], 'site/');
            if ($result['error']) {
                $this->error(0, $result['info']);
            } else {
                $data['img'] = $result['info'][0]['savename'];
                $this->ajaxReturn(1, L('operation_success'), "/".C( "yh_attach_path" ).'site/'.$data['img']);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }
}