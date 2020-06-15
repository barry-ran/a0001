<?php
vendor('taobao.TopSdk');
class jumpAction extends FirstendAction
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('nav_curr', 'index');
		$this->_mod = D('items');
        $this->_cate_mod = D('items_cate')->cache(true, 10 * 60);
		if (C('yh_site_cache')) {
            $file = 'items_site';
        }
    }
    /**
     * 商品详细页
     */
    public function index()
    {
        $id = htmlentities(I('item', '', 'trim'));
		$quan=htmlentities(I('quan', '', 'trim'));
		$quanurl=htmlentities(I('quanurl', '', 'trim'));
		 $appkey = trim(C('yh_taobao_appkey'));
         $appsecret = trim(C('yh_taobao_appsecret'));
        if (! empty($appkey) && ! empty($appsecret) && !empty($id)) {
                import('TopSdk', VENDOR_PATH . 'taobao', '.php');
                $c = new TopClient();
                $c->appkey = $appkey;
                $c->secretKey = $appsecret;
                $req = new TbkItemInfoGetRequest();
                $req->setFields("num_iid,user_type,title,seller_id,volume,pict_url,reserve_price,zk_final_price,item_url");
                $req->setPlatform("1");
                $req->setNumIids($id);
                $resp = $c->execute($req);
                $resparr = xmlToArray($resp);
                $newitem = $resparr['results']['n_tbk_item'];
			$this->_config_seo(C('yh_seo_config.item'), array(
            'title' => $newitem['title'],
            'price' =>  $newitem['zk_final_price'],
           // 'quan' => floattostr($item['quan']),
            'coupon_price' => $newitem['zk_final_price'],
            'seo_title' => $newitem['title']
           ));
		   
if(!empty($quan) && !empty($quanurl)){
$api_err='no';
$track_val=cookie('trackid');
$apiurl=$this->tqkapi.'/gconvert';
$track='_'.base64_decode($track_val);
$par_pid=$this->parent_pid();
$npid=str_replace($par_pid,$track,trim(C('yh_taobao_pid')));
if(!empty($track_val)){
$apidata=array(
'tqk_uid'=>$this->tqkuid,
'good_id'=>$item['num_iid'],
'time'=>time(),
'pid'=>$npid
);
}else{
$apidata=array(
'tqk_uid'=>$this->tqkuid,
'good_id'=>$item['num_iid'],
'time'=>time()
);	
	
}
$token=$this->create_token(trim(C('yh_gongju')),$apidata);
$apidata['token']=$token;
$res= $this->_curl($apiurl,$apidata, false);
$res = json_decode($res, true);
$me=$res['quanurl'];
if(strlen($me)>5){
$this->assign('quan', $quan);
$this->assign('quanurl', $me);
}else{
$this->assign('quan', $quan);
$this->assign('quanurl', $quanurl);
$api_err='yes';

}
}
		
 $this->assign('item', $newitem);
				
 }



  $orlike = $this->_mod->limit('0,12')
                    ->order('id desc')
                    ->select();
        $items = array();
        $pagecount = 0;
        foreach ($orlike as $key => $val) {
            $items[$key] = $val;
            $items[$key]['class'] = $this->_mod->status($val['status'], $val['coupon_start_time'], $val['coupon_end_time']);
            $items[$key]['pics'] = $this->pic = D('items')->where(array(
                'id' => $item['id']
            ))->getField('pic_url');
            $items[$key]['titles'] = $this->title = D('items')->where(array(
                'id' => $item['id']
            ))->getField('title');
            $items[$key]['zk'] = round(($val['coupon_price'] / $val['price']) * 10, 1);
            $items[$key]['itemurl'] = C('yh_site_url') . '/item/' . $val['id'] . '.html';
            $items[$key]['jumpurl'] = C('yh_site_url') . '/jump/' . $val['id'] . '.html';
            if (! $val['click_url']) {
                $items[$key]['click_url'] = ""; // U('jump/index',array('id'=>$val['id']));
            }
            if ($val['coupon_start_time'] > time()) {
                $items[$key]['click_url'] = ""; // U('item/index',array('id'=>$val['id']));
                $items[$key]['timeleft'] = $val['coupon_start_time'] - time();
            } else {
                $items[$key]['timeleft'] = $val['coupon_end_time'] - time();
            }
            $items[$key]['cate_name'] = $cate_list['p'][$val['cate_id']]['name'];
            $url = C('yh_site_url') . U('item/index', array(
                'id' => $val['id']
            ));
            $items[$key]['url'] = urlencode($url);
			$items[$key]['quan'] =  floattostr($val['quan']);
            $items[$key]['urltitle'] = urlencode($val['title']);
            $items[$key]['price'] = number_format($val['price'], 1);
            $items[$key]['coupon_price'] = number_format($val['coupon_price'], 1);
            $pagecount ++;
        }

        $this->assign('items_list', $items);
        $this->assign('cate_list', $cate_list); // 分类
if(function_exists('opcache_invalidate')){
$basedir = $_SERVER['DOCUMENT_ROOT']; 
$dir=$basedir.'/data/runtime/Data/coupon/disable_num_iids.php';
$ret=opcache_invalidate($dir,TRUE);
}
		$disable_num_iids = F('coupon/disable_num_iids');
		    if(!$disable_num_iids){
                    $disable_num_iids = array();
             }
			$is=strpos(serialize($disable_num_iids),$id);
            if(empty($is)){
                    $disable_num_iids[] =array(
                    'num_iid'=>$id,
                    'rate'=>10,
                    'zc_id'=>1
					); 
			 F('coupon/disable_num_iids', $disable_num_iids);
			
			 }



       $this->display();
		
    }
}

function floattostr($val)
{
    preg_match("#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o);
    return $o[1] . sprintf('%d', $o[2]) . ($o[3] != '.' ? $o[3] : '');
}
