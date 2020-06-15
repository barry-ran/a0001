<?php
class articleAction extends FirstendAction
{

    public function _initialize()
    {
        parent::_initialize();
        $this->_mod = D('article')->cache(true, 10 * 60);
        $this->_cate_mod = D('article_cate')->cache(true, 10 * 60);
    }

    /**
     * * 首页（全部）
     */
    public function index()
    {
    	$article_cate= $this->_cate_mod->where('status=1')->field('id,name')->select();
	$this->assign('article_cate',$article_cate);
        $cateid = I('cateid'); 
        $this->assign('cateid',$cateid);
		
$page	= I('p',1 ,'intval');
$size	= 16;
$start = $size * ($page - 1);
$cid		= I('cateid','','trim');
$order = 'ordid asc,id desc';
$where['status'] = '1';
if($cid){
 $where['cate_id'] = $cid;
}

$items_list = $this->_mod->where($where)->field('title,cate_id,add_time,id,pic,info')->order($order)->limit($start . ',' . $size)->select();	
$count =$this->_mod->where($where)->count();
$this->assign('total_item',$count);
$this->assign('size',$size);
$pager = $this->_pager($count, $size);
$this->assign('p', $page);
$this->assign('page', $pager->kshow());
if($items_list){
$goodslist=array();
foreach($items_list as $k=>$v){
$goodslist[$k]['id']=$v['id'];
$goodslist[$k]['pic']=$v['pic'];
$goodslist[$k]['cateid']=$v['cate_id'];
$goodslist[$k]['catename']= $this->_cate_mod->where('id='.$v['cate_id'])->getField('name');
$goodslist[$k]['title']=$v['title'];
$goodslist[$k]['add_time']=date('Y-m-d',$v['add_time']);
$goodslist[$k]['infocontent']=cut_html_str($v['info'],80);	
if(C('APP_SUB_DOMAIN_DEPLOY') && C('URL_MODEL')==2){
$goodslist[$k]['linkurl']='/article/view_'.$v['id'];
}else{
$goodslist[$k]['linkurl']=U('/m/article/read',array('id'=>$v['id']));
}
	
}
$this->assign('list',$goodslist);
}
		
		
		
		$catename=$this->_cate_mod->where('id='.$cateid)->getField('name');
		 $this->_config_seo(array(
            'title' => $catename?$catename:'今日头条'
        ));
		
        $this->display();
    }

public function read()
    {
        $id = I('id', '1', 'intval');
        ! $id && $this->_404();
        $help_mod = M('article');
		$hits_data = array('hits'=>array('exp','hits+1'));
		$help_mod->where(array('id'=>$id))->setField($hits_data);
        $help = $help_mod->field('id,title,info,author,seo_title,seo_keys,seo_desc,add_time,cate_id')->find($id);
        $this->_config_seo(array(
            'title' => $help['seo_title']?$help['seo_title']:$help['title'],
            'keywords'=>$help['seo_keys'],
	        'description'=>$help['seo_desc']
        ));
		$help['catename']=$this->_cate_mod->where('id='.$help['cate_id'])->getField('name');   
        $this->assign('info', $help); 
        $orlike = D('items')->cache(true, 10 * 60)->where("title like '%" . $help['author'] . "%' ")
            ->limit('0,4')
            ->order('is_commend desc,id desc')
            ->select();
		 $where=array(
		 'cate_id'=>$help['cate_id'],
		 'id'=>array('neq',$id)
		 );
		$articlelike = $this->_mod->where($where)->field('id,title,pic,add_time,cate_id')->limit('0,5')->order('id desc')->select();
       $article=array();
       foreach($articlelike as $k=>$v){
       	$article[$k]['id']=$v['id'];
		$article[$k]['title']=$v['title'];
		$article[$k]['pic']=$v['pic'];
		$article[$k]['cate_id']=$v['cate_id'];
		$article[$k]['add_time']=$v['add_time'];
		$article[$k]['catename']=$this->_cate_mod->where('id='.$v['cate_id'])->getField('name');   
       }
	    $this->assign('articlelike', $article);
        $this->assign('sellers', $orlike);
        $this->display('read');
    }


}