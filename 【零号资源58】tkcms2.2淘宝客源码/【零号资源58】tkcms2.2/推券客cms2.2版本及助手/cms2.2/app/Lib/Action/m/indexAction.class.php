<?php

class indexAction extends FirstendAction {

	public function _initialize() {
        parent::_initialize();
        $this->_ad = D('ad')->cache(true, 10 * 60);
        $this->_mod = D('items')->cache(true, 5 * 60);
		$this->_article = D('article')->cache(true, 10 * 60);
		C('DATA_CACHE_TIME',C('yh_site_cachetime'));
    }
	
	
	
public function index() {
$brand=M('brand')->cache(true, 5 * 60)->where('status = 1 and	 recommend = 1')->order('ordid asc')->field('id,logo,brand,remark')->limit(3)->select();
$this->assign('brand', $brand);
$ad = $this->_ad->where(array('status'=>'1'))->order('id desc')->select();
$this->assign('ad_list', $ad);
$cateinfo = $this->_cate_mod->where(array('status'=>1))->select();
$article_list =$this->_article->where('status=1')
            ->field('id,title')
            ->order('ordid asc,id desc')
            ->limit(6)
            ->select();
$this->assign('article_list', $article_list);
$where['quan']=array('gt',20);
$items_list = $this->_mod->field('id,pic_url,title,coupon_price,price,quan,shop_type,volume,add_time')->order('ordid asc,id desc')->limit(60)->select();	
if($items_list){
$today=date('Ymd');
$goodslist=array();
foreach($items_list as $k=>$v){
$goodslist[$k]['id']=$v['id'];
$goodslist[$k]['pic_url']=$v['pic_url'];
$goodslist[$k]['title']=$v['title'];
$goodslist[$k]['coupon_price']=$v['coupon_price'];
$goodslist[$k]['price']=$v['price'];
$goodslist[$k]['quan']=$v['quan'];
$goodslist[$k]['shop_type']=$v['shop_type'];
$goodslist[$k]['volume']=$v['volume'];	
if($today==date('Ymd',$v['add_time'])){
$goodslist[$k]['is_new']=1;	
}else{
$goodslist[$k]['is_new']=0;		
}
if(C('APP_SUB_DOMAIN_DEPLOY')){
$goodslist[$k]['linkurl']=U('/detail/',array('id'=>$v['id']));
}else{
$goodslist[$k]['linkurl']=U('detail/index',array('id'=>$v['id']));
}
	
}
}

$this->assign('list',$goodslist);


$this->_config_seo(C('yh_seo_config.index'));

	$this->display();  	
}


public function cate() {
$ad = $this->_ad->where(array('status'=>'1'))->order('id desc')->select();
$this->assign('ad_list', $ad);
$cateinfo = $this->_cate_mod->where(array('status'=>1))->select();
$article_list =$this->_article->where('status=1')
            ->field('id,title')
            ->order('ordid asc,id desc')
            ->limit(6)
            ->select();
$this->assign('article_list', $article_list);
	$this->_config_seo(C('yh_seo_config.index'));

	$this->display('list/index');  	
}



}