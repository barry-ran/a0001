<?php
class indexAction extends FirstendAction
{
    public function _initialize()
    {
        parent::_initialize();
        $reurl=$_SERVER['REQUEST_URI'];
        $reurl=str_replace('item','detail',$reurl);
        $reurl=str_replace('cate','list/index',$reurl);
        if($this->isMobile()){
          redirect(C('yh_headerm_html').$reurl);	
      }
      $this->_mod = D('items')->cache(true, 5 * 60);
      $this->_ad = D('ad')->cache(true, 10 * 60);
      C('DATA_CACHE_TIME', C('yh_site_cachetime'));
      $topad=$this->_ad->where('status=2')->find();
      if($topad){
          $this->assign('topad',$topad);
      }
  }

  public function  index(){
   $ad = $this->_ad->where(array(
    'status' => '0'
    ))
   ->order('id desc')
   ->select();
   $this->assign('ad_list', $ad);
   $brand_cate=M('brand_cate')->cache(true, 10 * 60)->field('id,name')->where('status=1')->order('ordid asc')->select();
   if($brand_cate){
   	$field='id,logo,brand,cate_id';
    $sql='';
    $si=0;
	$k=0;
	foreach($brand_cate as $k=>$v){
	if($si==0){
         $sql='(SELECT '.$field.' from '.C("DB_PREFIX").'brand where cate_id='. $v['id'] .' and status=1 order by ordid asc limit 18)';
        }else{
            $sql=$sql.' union all (SELECT '.$field.' from '.C("DB_PREFIX").'brand where cate_id='. $v['id'] .' and status=1 order by ordid asc limit 18)';		
        }
        $si++;	
		
       $cate[$v['id']]['id']=$v['id'];
       $cate[$v['id']]['name']=$v['name'];
		
	}
	$Model = M();
    $list=$Model->cache(true, 10 * 60)->query($sql);
	 $cateid=0;
    $pi=0;
    foreach($list as $p){
        $newsale[$p['cate_id']][$pi]['logo']=$p['logo'];
        $newsale[$p['cate_id']][$pi]['brand']=$p['brand'];
        $newsale	[$p['cate_id']][$pi]['id']=$p['id'];
        $pi++;
    }
    foreach($brand_cate as $i=>$c){
        $product[$k]['brandlist']=$newsale[$c['id']];
        $product[$k]['name']=$cate[$c['id']]['name'];
        $product[$k]['cid']=$cate[$c['id']]['id'];
        $k++;
    }
	
	 $this->assign('brand', $product);
   	
   }
   
   
   $today_wh['pass'] = '1';
   $today_wh['isshow'] = '1';	
   $today_wh['status'] = 'underway';
   $today_str = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
   $tomorr_str = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
   $today_wh['add_time'] = array(
    array(
        'egt',
        $today_str
        ),
    array(
        'elt',
        $tomorr_str
        )
    );
   $today_list=$this->_mod->where($today_wh)->field('id,pic_url,title,coupon_price,price,quan,shop_type,volume,add_time')->order('is_commend desc,id desc,volume desc')->limit(5)->select();
   $this->assign('today_list',$today_list);	
   $where=array(
    'pass'=>1,
    'isshow'=>1,
    'status'=>'underway'
    );
   $count=$this->_mod->where($where)->count();
   $this->assign('total_item', $count);
   $order = '(quan/price)*100 DESC,ordid asc';
   $jingxuan=$this->_mod->where($where)->field('id,pic_url,title,coupon_price,price,quan,shop_type,volume,add_time')->order($order)->limit(5)->select();
   $this->assign('jingxuan',$jingxuan);	
   $top=$this->_mod->where($where)->field('id,pic_url,title,coupon_price,price,quan,shop_type,volume,add_time')->order('volume desc')->limit(6)->select();
   $this->assign('top',$top);
    $where=array(
    'pass'=>1,
    'isshow'=>1,
    'quan'=>array('gt',20),
    'status'=>'underway'
    );
    $prolist=$this->_mod->where($where)->field('id,pic_url,title,coupon_price,price,quan,shop_type,volume')->order('id desc')->limit(40)->select();
    $this->assign('products',$prolist);

$article_list = M('article')->where('status=1')
->order('ordid asc,id desc')
->field('title,cate_id,add_time,id,pic,info')
->limit(4)
->select();
if($article_list ){
    $goodslist=array();
    foreach($article_list as $k=>$v){
        $goodslist[$k]['id']=$v['id'];
        $goodslist[$k]['pic']=$v['pic'];
        $goodslist[$k]['cateid']=$v['cate_id'];
        $goodslist[$k]['title']=$v['title'];
        $goodslist[$k]['add_time']=date('Y-m-d',$v['add_time']);
        $goodslist[$k]['infocontent']=cut_html_str($v['info'],80);	
        if(C('APP_SUB_DOMAIN_DEPLOY') && C('URL_MODEL') == 2){
            $goodslist[$k]['linkurl']='/article/view_'.$v['id'];
        }else{
            $goodslist[$k]['linkurl']=U('/article/read',array('id'=>$v['id']));
        }
        
    }
    $this->assign('list',$goodslist);
}

$this->_config_seo(C('yh_seo_config.index'));
$this->display();
}



}