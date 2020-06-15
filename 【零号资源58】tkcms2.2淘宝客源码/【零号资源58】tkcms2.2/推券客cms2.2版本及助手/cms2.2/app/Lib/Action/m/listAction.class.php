<?php
vendor('taobao.TopSdk');
class listAction extends FirstendAction {
	public function _initialize() {
        parent::_initialize();
        $this->_mod = D('items')->cache(true, 5 * 60);
    }
public function index(){
$page	= I('p',1 ,'intval');
$size	= 60;
$cid		= I('cid','','trim');
$sort	= I('sort', 'new', 'trim');
$start = $size * ($page - 1);
$this->assign('txt_sort', $sort);
$this->assign('cid', $cid);
$key    = trimall(I("k",'','htmlspecialchars'));
$key    = urldecode($key);
$where['status'] = 'underway';
if($key){
 $where['title|tags'] = array( 'like', '%' . $key . '%' );
 $this->assign('k', $key);
}
if($cid){
 $where['cate_id'] = $cid;
}
$order = 'is_commend desc,ordid asc';
switch ($sort){
    		case 'new':
				$order.= ', coupon_start_time DESC';
				break;
			case 'price':
				$order.= ', price DESC';
				break;
			case 'rate':
				$order.= ', quan DESC';
				break;
			case 'hot':
				$order.= ', volume DESC';
				break;
			case 'default':
				$order.= ', '.C('yh_index_sort');
}

$items_list = $this->_mod->where($where)->field('id,pic_url,title,coupon_price,price,quan,shop_type,volume,add_time')->order($order)->limit($start . ',' . $size)->select();	
$count =$this->_mod->where($where)->count();
$pager = $this->_pager($count, $size);
$this->assign('p', $page);
$this->assign('page', $pager->kshow());
$this->assign('total_item', $count);
$this -> assign('page_size',$size);
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
$appkey=trim(C('yh_taobao_appkey'));
$appsecret=trim(C('yh_taobao_appsecret'));
$track_val=cookie('trackid');
if(!empty($track_val)){
$AdzoneId=$track_val;	
}else{
$apppid=trim(C('yh_taobao_pid'));
$apppid=explode('_', $apppid);
$AdzoneId=$apppid[3];
}
$count=count($items_list);
if(!empty($appkey) && !empty($appsecret) && $key && $count<10 && !empty($AdzoneId)){
$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $appsecret;
$c->format = 'json';
$req = new TbkDgItemCouponGetRequest;
$req->setAdzoneId($AdzoneId);
$req->setPlatform("1");
$req->setPageSize("100");
$req->setQ((string)$key);
$req->setPageNo("1");
$resp = $c->execute($req);
$resp = json_decode(json_encode($resp), true);
$resp=$resp['results']['tbk_coupon'];	
//$item=array();
$patterns = "/\d+/";
foreach($resp as $k=>$v){
preg_match_all($patterns,$v['coupon_info'],$arr);
$quan=$arr[0];
//$coupon_price=$item_1['zk_final_price']-$quan;
$goodslist[$k+$count]['quan']=$arr[0][1];
$goodslist[$k+$count]['coupon_click_url']=$v['coupon_click_url'];
$goodslist[$k+$count]['num_iid']=$v['num_iid'];
$goodslist[$k+$count]['title']=$v['title'];
$goodslist[$k+$count]['coupon_price']=$v['zk_final_price']-$goodslist[$k+$count]['quan'];
if($v[$k+$count]['user_type']==1){
$goodslist[$k+$count]['shop_type']='B';	
}else{
$goodslist[$k+$count]['shop_type']='C';	
}
$goodslist[$k+$count]['price']=$v['zk_final_price'];
$goodslist[$k+$count]['volume']=$v['volume'];
$goodslist[$k+$count]['pic_url']=$v['pict_url'];
}
 
}

$this->assign('list',$goodslist);

$cateinfo=$this->_cate_mod->where('id='.$cid)->field('id,name,seo_title,seo_keys,seo_desc')->find();
$this->_config_seo(array(
			'cate_name' => $cateinfo['name'],
            'title' =>$key?'搜索"' . $key . '"的优惠券结果页 - ' . C('yh_site_name'):$cateinfo['name'].'优惠券-'.C('yh_site_name'),
            'keywords' => $cateinfo['seo_keys'],
            'description' => $cateinfo['seo_desc'],
 ));
 
$this->display();

}


	
	
}