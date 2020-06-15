<?php
/**
 * 后台控制器基类
 */
class BackendAction extends TopAction
{
    protected $_name = '';
    protected $menuid = 0;
    public function _initialize() {
        parent::_initialize();
        $this->_name = $this->getActionName();
        $this->check_priv();
        $this->menuid = $this->_request('menuid', 'trim', 0);
        if ($this->menuid) {
            $sub_menu = D('menu')->sub_menu($this->menuid, $this->big_menu);
            $selected = '';
            foreach ($sub_menu as $key=>$val) {
                $sub_menu[$key]['class'] = '';
                if (MODULE_NAME == $val['module_name'] && ACTION_NAME == $val['action_name'] && strpos(__SELF__, $val['data'])) {
                    $sub_menu[$key]['class'] = $selected = 'on';
                }
            }
            if (empty($selected)) {
                foreach ($sub_menu as $key=>$val) {
                    if (MODULE_NAME == $val['module_name'] && ACTION_NAME == $val['action_name']) {
                        $sub_menu[$key]['class'] = 'on';
                        break;
                    }
                }
            }
            $this->assign('sub_menu', $sub_menu);
        }
        $this->assign('menuid', $this->menuid);

$updata=array(
'status'=>2
);

$lasttime = mktime(0, 0, 0, date("m"), date("d") -25, date("Y"));
$upwhere['status']=1;
$upwhere['add_time'] = array('lt',$lasttime);
$res=M('order')->where($upwhere)->save($updata);

}







    /**
     * 列表页面
     */
    public function index() {
        $map = $this->_search();
        $mod = D($this->_name);
        !empty($mod) && $this->_list($mod, $map);

        $this->display();
    }
    

    public  function getpic($content){
        $soContent = $content;
        $soImages = '~<img [^>]* />~';
        preg_match_all( $soImages, $soContent, $thePics);
        $allPics = count($thePics[0]);
        preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png|jpeg))\"?.+>/i',$thePics[0][0],$match);
        if($allPics>0 && $match[1]!="null"){
   return $match[1];//获取的图片名称
}else{
    return "/static/images/nopic.jpg";
}


}

    /**
     * 添加
     */
    public function add() {
        $mod = D($this->_name);
        
        if (IS_POST) {
        	
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_insert')) {
                $data = $this->_before_insert($data);
                
                
            }

            if(!empty($data['info'])){
			   $data['info']=$this->clearhtml($data['info']); //fre 添加 过滤掉文章中的 html 
			   $contents2=$data['info'];
			   $pic2=$this->getpic($contents2);
			   $data['pic']=$pic2;
			}
			
			if(!empty($data['username'])){
               $data['nickname'] = $data['username'];
           }

           if( $mod->add($data) ){
            if( method_exists($this, '_after_insert')){
                $id = $mod->getLastInsID();
                $this->_after_insert($id);
            }
            IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'add');
            $this->success(L('operation_success'));
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
            $this->error(L('operation_failure'));
        }
    } else {
        $this->assign('open_validator', true);
        if (IS_AJAX) {
            $response = $this->fetch();
            $this->ajaxReturn(1, '', $response);
        } else {
            $this->display();
        }
    }
}

public function clearhtml($str){
    $str = preg_replace( "@<script(.*?)</script>@is", "", $str ); 
    $str = preg_replace( "@<iframe(.*?)</iframe>@is", "", $str ); 
    $str = preg_replace( "@<style(.*?)</style>@is", "", $str ); 

    return $str;	
}



    /**
     * 修改
     */
    public function edit()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_update')) {
                $data = $this->_before_update($data);
                
                
            }
            
            if(!empty($data['info'])){
			   $data['info']=$this->clearhtml($data['info']); //fre 添加 过滤掉文章中的 html
			   $contents=$data['info'];
			   $pic=$this->getpic($contents);
			   $data['pic']=$pic;
            }
            
            if(!empty($data['password'])){
                $data['password'] = md5($data['password']);
            }else{
                unset($data['password']);
            }
            
            if (false !== $mod->save($data)) {
                if( method_exists($this, '_after_update')){
                    $id = $data['id'];
                    $this->_after_update($id);
                }
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'edit');
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {

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
    }

    /**
     * ajax修改单个字段值
     */
    public function ajax_edit()
    {
        //AJAX修改数据
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $id = $this->_get($pk, 'intval');
        $field = $this->_get('field', 'trim');
        $val = $this->_get('val', 'trim');
        //允许异步修改的字段列表  放模型里面去 TODO
        $mod->where(array($pk=>$id))->setField($field, $val);
        $this->ajaxReturn(1);
    }

    /**
     * 删除
     */
    public function delete()
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

    /**
     * 获取请求参数生成条件数组
     */
    protected function _search() {
        //生成查询条件
        $mod = D($this->_name);
        $map = array();
        foreach ($mod->getDbFields() as $key => $val) {
            if (substr($key, 0, 1) == '_') {
                continue;
            }
            if ($this->_request($val)) {
                $map[$val] = $this->_request($val);
            }
        }
        return $map;
    }

    /**
     * 列表处理
     *
     * @param obj $model  实例化后的模型
     * @param array $map  条件数据
     * @param string $sort_by  排序字段
     * @param string $order_by  排序方法
     * @param string $field_list 显示字段
     * @param intval $pagesize 每页数据行数
     */
    protected function _list($model, $map = array(), $sort_by='', $order_by='', $field_list='*', $pagesize=50)
    {
        //排序
        $mod_pk = $model->getPk();
       
        if ($this->_request("sort", 'trim')) {
            $sort = $this->_request("sort", 'trim');
        } else if (!empty($sort_by)) {
            $sort = $sort_by;
        } else if ($this->sort) {
            $sort = $this->sort;
        } else {
            $sort = $mod_pk;
        }
        if ($this->_request("order", 'trim')) {
            $order = $this->_request("order", 'trim');
        } else if (!empty($order_by)) {
            $order = $order_by;
        } else if ($this->order) {
            $order = $this->order;
        } else {
            $order = 'DESC';
        }

        if ($pagesize) {
            $count = $model->where($map)->count($mod_pk);
            $pager = new Page($count, $pagesize);
        }
        $select = $model->field($field_list)->where($map)->order($sort . ' ' . $order);
        $this->list_relation && $select->relation(true);
        if ($pagesize) {
            $select->limit($pager->firstRow.','.$pager->listRows);
            $page = $pager->show();
            $this->assign("page", $page);
        }
        $list = $select->select();
        foreach ($list as $k => $v) {
            if($v['uid']){
                $nick = M('user')->field('phone,username')->where("id='".$v['uid']."'")->find();
                $list[$k]['nick'] = $nick['username'];
				$list[$k]['phone'] = $nick['phone'];
            }
        }

        $this->assign('list', $list);
        $this->assign('list_table', true);
    }


 /**
     * 前台分页统一
     */
    protected function _pager($count, $pagesize, $path = null)
    {
        $pager = new Page($count, $pagesize);
        if($path){
            $pager->path = $path;
        }
        $pager->rollPage = 3;
        $pager->setConfig('header', '条记录');
        $pager->setConfig('prev', '上一页');
        $pager->setConfig('next', '下一页');
        $pager->setConfig('first', '第一页');
        $pager->setConfig('last', '最后一页');
        $pager->setConfig('theme', '%upPage% %first% %linkPage% %end% %downPage%');
        return $pager;
    }

    public function check_priv() {
        if (MODULE_NAME == 'attachment') {
            return true;
        }
        if ( (!isset($_SESSION['admin']) || !$_SESSION['admin']) && !in_array(ACTION_NAME, array('login','verify_code')) ) {
            $this->redirect('index/login');
        }
        if($_SESSION['admin']['role_id'] == 1) {
            return true;
        }
        if (in_array(MODULE_NAME, explode(',', 'index'))) {
            return true;
        }
        $menu_mod = M('menu');
        $menu_id = $menu_mod->where(array('module_name'=>MODULE_NAME, 'action_name'=>ACTION_NAME))->getField('id');
        $priv_mod = D('admin_auth');
        $r = $priv_mod->where(array('menu_id'=>$menu_id, 'role_id'=>$_SESSION['admin']['role_id']))->count();
        if (!$r) {
            $this->error(L('_VALID_ACCESS_'));
        }
    }
    
    protected function update_config($new_config, $config_file = '') {
        !is_file($config_file) && $config_file = CONF_PATH . 'index/config.php';
        if (is_writable($config_file)) {
            $config = require $config_file;
            $config = array_merge($config, $new_config);
            file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
            @unlink(RUNTIME_FILE);
            return true;
        } else {
            return false;
        }
    }
}