<?php
class articleAction extends FirstendAction
{

    public function _initialize()
    {
        parent::_initialize();
        $this->_mod = D('article')->cache(true, 10 * 60);
        $this->_cate_mod = D('article_cate')->cache(true, 10 * 60);
		$article_cate= $this->_cate_mod->where('status=1')->field('id,name')->select();
	   $this->assign('article_cate',$article_cate);
    }

    /**
     * * 首页（全部）
     */
    public function index()
    {
     $cateid = I('cid'); 
      $this->assign('cateid',$cateid);
		
$page	= I('p',1 ,'intval');
$size	= 10;
$start = $size * ($page - 1);
$cid		= I('cid','','trim');
$order = 'ordid asc,id desc';
$where['status'] = '1';
if($cid){
 $where['cate_id'] = $cid;
}
$prefix = C(DB_PREFIX);
$items_list = $this->_mod->where($where)->field('title,cate_id,add_time,id,pic,info,(select name from '.$prefix.'article_cate where '.$prefix.'article_cate.id = '.$prefix.'article.cate_id) as catename')->order($order)->limit($start . ',' . $size)->select();	
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
$goodslist[$k]['catename']= $v['catename'];
$goodslist[$k]['title']=$v['title'];
$goodslist[$k]['add_time']=date('Y-m-d',$v['add_time']);
$goodslist[$k]['infocontent']=cut_html_str($v['info'],80);	
if(C('APP_SUB_DOMAIN_DEPLOY') && C('URL_MODEL')==2){
$goodslist[$k]['linkurl']='/article/view_'.$v['id'];
}else{
$goodslist[$k]['linkurl']=U('/article/read',array('id'=>$v['id']));
}
	
}

 $orlike = D('items')->cache(true, 10 * 60)
            ->field('id,pic_url,title,coupon_price,price,quan,shop_type,volume,add_time')
            ->limit('0,14')
            ->order('is_commend desc,id desc')
            ->select();
        
 $this->assign('sellers', $orlike);


$this->assign('list',$goodslist);

}
		
		
		 $this->_config_seo(array(
            'title' => '今日头条-'.C('yh_site_name')
        ));
		
        $this->display();
    }

public function read()
    {
        $id = I('id', '1', 'intval');
        ! $id && $this->_404();
        $help_mod = $this->_mod;
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
            ->limit('0,8')
            ->order('is_commend desc,id desc')
            ->select();
//		 $where=array(
//		 'cate_id'=>$help['cate_id'],
//		 'id'=>array('neq',$id)
//		 );
		//$articlelike = $this->_mod->where($where)->field('id,title,pic,add_time,cate_id')->limit('0,5')->order('id desc')->select();
       $article=array();
        $where2['id']     = array('lt',$id);
        $max              = $help_mod->field("max(id)")->where($where2)->order($order)->find();
        $where3['id']     = $max['max(id)'];
        $previous_article = $help_mod->where($where3)->order($order)->find();
        $where4['id']     = array('gt',$id);
        $min              = $help_mod->field("min(id)")->where($where4)->order($order)->find();
        $where5['id']     = $min['min(id)'];
		$array['previous_article'] = $previous_article;
        $array['next_article']     = $next_article;
		  $this  -> assign($array);
        $next_article = $help_mod->where($where5)->order($order)->find();
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